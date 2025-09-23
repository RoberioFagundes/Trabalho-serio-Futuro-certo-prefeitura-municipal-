<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use App\Http\Controllers\Controller;
use App\Models\AgendamentoHistories;
use App\Models\AgendamentoHistory;
use App\Models\Fila;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\EnderecoCidadao;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $agendamentos = Agendamento::orderBy('data_hora')->paginate(10);


        $Pessoa = Pessoa::when(request()->has('nome'), function ($whenQuery) {
            $whenQuery->where('nome', 'like', '%' . request()->nome . '%');
        })->get();

        return view(
            'secretaria.sistema.agendamento.index',
            compact('agendamentos', 'Pessoa')
        )->with('sucesso-agendamento', "Agendamento Cadastro com Sucesso");
    }


    public function create()
    {
        //
        return view('secretaria.sistema.agendamento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //    dd($request->all());
        // $validated = $request->validate([
        //     'nome' => 'required|nome'

        // ]);

        $pessoa = new Pessoa();
        $pessoa->nome = $request->nomeInput;
        $pessoa->cpf = $request->cpf;
        $pessoa->data_nascimento = $request->data_nascimento;
        $pessoa->telefone = $request->telefoneInput;
        $pessoa->user_id = auth()->user()->id;
        $pessoa->cpf = $request->cpfInput;
        $pessoa->save();

        $enderecoCidadao = new EnderecoCidadao();
        $enderecoCidadao->estado = $request->estadoInput;
        $enderecoCidadao->cidade = $request->cidadeInput;
        $enderecoCidadao->bairro = $request->bairroInput;
        $enderecoCidadao->rua = $request->ruaInput;
        $enderecoCidadao->pessoa_id = $pessoa->id;
        $enderecoCidadao->save();




        $agendamento = new Agendamento();
        $agendamento->data_hora = $request->dataInput;
        $agendamento->hora = $request->horaInput;
        $agendamento->observacoes = $request->observacaoInput;
        $agendamento->user_id = auth()->user()->id;
        $agendamento->pessoa_id = $pessoa->id;
        // 4. Verificar se um novo arquivo foi enviado
        // 3. Upload de arquivo (se enviado)
        if ($request->hasFile('arquivoInput')) {
            $file = $request->file('arquivoInput');

            // Deleta o antigo se existir
            if ($agendamento && $agendamento->arquivo && Storage::disk('public')->exists($agendamento->arquivo)) {
                Storage::disk('public')->delete($agendamento->arquivo);
            }

            // Gera nome único preservando o original
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = Str::slug($originalName); // remove caracteres estranhos
            $extension = $file->getClientOriginalExtension();
            $fileName = $safeName . '-' . time() . '.' . $extension;

            // Salva o arquivo
            $path = $file->storeAs('uploads/agendamentos', $fileName, 'public');

            // Salva o caminho e o nome original no banco
            $dados['arquivo'] = $path;
            $dados['arquivo_nome'] = $file->getClientOriginalName(); // nome original para exibir

            $agendamento->arquivo = $fileName;
        }

        $agendamento->save();

        $agendamentos = Agendamento::orderBy('data_hora')->paginate(10);


        $Pessoa = Pessoa::when(request()->has('nome'), function ($whenQuery) {
            $whenQuery->where('nome', 'like', '%' . request()->nome . '%');
        })->get();


        return redirect()
            ->route('agendamentos.index')
            ->with('sucesso_agendamento', 'Agendamento cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamento)
    {
        //
        return view('agendamentos.show', compact('agendamento'));
    }

    /**
     *para criar o formulario de remarcação eu vou salvo os dados aqui 
     */
    public function edit(Agendamento $agendamento)
    {
        /*
        Aqui está errado, porque $agendamento já é um modelo do tipo Agendamento.
        Você está passando ele para findOrFail() que espera um ID.
        O correto seria:
        */
       
        return view("secretaria.sistema.Remarcacao.create",compact('agendamento'));
        
    }

    public function remarcacaoStory(Request $request){
        $remarcacao = new AgendamentoHistory();
        $remarcacao->agendamento_id=$request->agendamento_id;
        $remarcacao->nova_data = $request->dataNova;
        $remarcacao->nova_hora = $request->horaNova;
        $remarcacao->motivo = $request->MotivoInput;
        $remarcacao->user_id = auth()->user()->id;
        $remarcacao->save();

        return redirect()
        ->route('marcacao.index')->with('sucesso-remarcacao','Re-marcado com sucesso ');
    }

    public function remarcacao(){
        $remarcacao = AgendamentoHistory::all();

        return view ('secretaria.sistema.Remarcacao.index',compact('remarcacao'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agendamento $agendamento)
    {
        //
        $validated = $request->validate([
            'data_hora' => 'required|date',
            'local' => 'required|string|max:255',
            'observacoes' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'pessoa_id' => 'required|exists:pessoas,id',
        ]);
        $agendamento->update($validated);
        return redirect()->route('agendamentos.index');
    }

    /**
     * Rota específica para remarcar agendamento
     */
    public function remarcar(Request $request, Agendamento $agendamento)
    {
        // Valida os dados enviados pelo formulário
        $validated = $request->validate([
            'nova_data' => 'required|date',              // A nova data é obrigatória e deve ser uma data válida
            'nova_hora' => 'required',                   // A nova hora é obrigatória
            'motivo_remarcacao' => 'nullable|string|max:255', // O motivo é opcional, deve ser string e até 255 caracteres
        ]);

        // Atualiza os campos principais do agendamento
        $agendamento->update([
            'data' => $validated['nova_data'],           // Atualiza a data
            'hora' => $validated['nova_hora'],          // Atualiza a hora
            'motivo_remarcacao' => $validated['motivo_remarcacao'], // Atualiza o motivo da remarcação
        ]);

        // Registra o histórico da remarcação
        $agendamento->historicos()->create([
            'nova_data' => $validated['nova_data'],     // Salva a nova data no histórico
            'nova_hora' => $validated['nova_hora'],     // Salva a nova hora no histórico
            'motivo' => $validated['motivo_remarcacao'], // Salva o motivo no histórico
            'user_id' => auth()->id(),                  // Salva o usuário que realizou a remarcação
        ]);

        // Redireciona de volta para a página de edição do agendamento com uma mensagem de sucesso
        return redirect()->route('agendamentos.edit', $agendamento->id)
            ->with('success', 'Agendamento remarcado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agendamento $agendamento)
    {
        $agendamento->delete();

        return redirect()->route('agendamentos.index')
            ->with('success', 'Agendamento excluído com sucesso!');
    }

    public function gerar($id)
    {
        // Busca o agendamento
        $agendamento = Agendamento::with('pessoa')->findOrFail($id);

        $pdf = PDF::loadView('pdf.protocolo', [
            'agendamento'
            => $agendamento

        ])->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);

        // Faz o download
        return $pdf->download('protocolo-' . $agendamento->id . '.pdf');
    }

    public function adicionandoFila($id)
    {
        $agendamentoCidadao = Agendamento::find($id);

        // dd($agendamentoCidadao);


        return view('secretaria.sistema.fila.create', compact('agendamentoCidadao'));
    }
}
