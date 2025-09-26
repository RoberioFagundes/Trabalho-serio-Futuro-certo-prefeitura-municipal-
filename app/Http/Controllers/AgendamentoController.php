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
use Carbon\Carbon;

use function Laravel\Prompts\table;

class AgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Consulta unificada: busca agendamentos e junta dados da pessoa
        $agendamentos = Agendamento::join('pessoas', 'pessoas.id', '=', 'agendamentos.pessoa_id')
            ->when($request->filled('nome'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('pessoas.nome', 'like', '%' . $request->nome . '%')
                        ->orWhere('agendamentos.data_hora', 'like', '%' . $request->nome . '%');
                });
            })
            ->select(
                'agendamentos.*',
                'pessoas.nome as pessoa_nome' // traz o nome da pessoa junto
            )
            ->orderBy('agendamentos.data_hora')
            ->simplePaginate(2);

        return view('secretaria.sistema.agendamento.index', [
            'agendamentos' => $agendamentos,
            'nome'         => $request->nome
        ]);
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
        // 1. Validação
        $validated = $request->validate([
            'nomeInput'      => 'required|string|max:255',
            'cpfInput'       => 'required|string|max:14',
            'telefoneInput'  => 'nullable|string|max:20',
            'estadoInput'    => 'required|string|max:50',
            'cidadeInput'    => 'required|string|max:100',
            'bairroInput'    => 'required|string|max:100',
            'ruaInput'       => 'required|string|max:255',
            'dataInput'      => 'required|date',
            'horaInput'      => 'required',
            'observacaoInput' => 'required|string|max:255',
            'arquivoInput'   => 'nullable|file|max:2048',
        ]);

        $data = \Carbon\Carbon::parse($validated['dataInput']);

        // 2. Bloqueio de feriados
        if (\DB::table('feriados')->whereDate('data', $data)->exists()) {
            return redirect()->back()
                ->withErrors(['dataInput' => 'Não é permitido agendar em feriados.'])
                ->withInput();
        }

        // 3. Bloqueio de finais de semana
        if ($data->isWeekend()) {
            return redirect()->back()
                ->withErrors(['dataInput' => 'Não é permitido agendar em sábados ou domingos.'])
                ->withInput();
        }

        // ✅ Garante que existe usuário logado
        if (!auth()->check()) {
            return redirect()->route('login')
                ->withErrors('Você precisa estar logado para cadastrar uma pessoa.');
        }



        $pessoa = Pessoa::create([
            'nome'      => $validated['nomeInput'],
            'cpf'       => $validated['cpfInput'],
            'telefone'  => $validated['telefoneInput'],
            'user_id'   => auth()->id(), // ✅ use ->id, não o objeto inteiro
        ]);

    

        // 5. Cria endereço
        EnderecoCidadao::create([
            'estado'    => $validated['estadoInput'],
            'cidade'    => $validated['cidadeInput'],
            'bairro'    => $validated['bairroInput'],
            'rua'       => $validated['ruaInput'],
            'pessoa_id' => $pessoa->id,
        ]);

        // 6. Verifica agendamento duplicado
        $agendamentoExistente = Agendamento::where('pessoa_id', $pessoa->id)
            ->whereDate('data_hora', $data->toDateString())
            ->where('hora', $validated['horaInput'])
            ->first();

        if ($agendamentoExistente) {
            return redirect()->back()
                ->withErrors(['dataInput' => 'Já existe um agendamento para esta pessoa neste dia e horário.'])
                ->withInput();
        }

        // 7. Cria agendamento
        $agendamento = new Agendamento();
        $agendamento->data_hora  = $data->toDateString();
        $agendamento->hora       = $validated['horaInput'];
        $agendamento->observacoes = $validated['observacaoInput'];
        $agendamento->user_id    = auth()->id();
        $agendamento->pessoa_id  = $pessoa->id;

        // 8. Upload do arquivo (se existir)
        if ($request->hasFile('arquivoInput')) {
            $file = $request->file('arquivoInput');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $safeName = \Illuminate\Support\Str::slug($originalName);
            $extension = $file->getClientOriginalExtension();
            $fileName = $safeName . '-' . time() . '.' . $extension;

            $path = $file->storeAs('uploads/agendamentos', $fileName, 'public');
            $agendamento->arquivo = $path; // salva caminho completo
        }

        $agendamento->save();

        return redirect()
            ->route('agendamentos.index')
            ->with('sucesso_agendamento', 'Agendamento cadastrado com sucesso!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Agendamento $agendamentos)
    {
        //
        return view('secretaria.sistema.agendamento.index', compact('agendamentos'));
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

        return view("secretaria.sistema.Remarcacao.create", compact('agendamento'));
    }

    public function remarcacaoStory(Request $request)
    {
        $remarcacao = new AgendamentoHistory();
        $remarcacao->agendamento_id = $request->agendamento_id;
        $remarcacao->nova_data = $request->dataNova;
        $remarcacao->nova_hora = $request->horaNova;
        $remarcacao->motivo = $request->MotivoInput;
        $remarcacao->user_id = auth()->user()->id;
        $remarcacao->save();

        return redirect()
            ->route('marcacao.index')->with('sucesso-remarcacao', 'Re-marcado com sucesso ');
    }

    public function remarcacaoDestoy($id)
    {
        $remarcacao = AgendamentoHistory::findOrFail($id);
        $remarcacao->delete();

        return redirect()
            ->route('marcacao.index')
            ->with('delete-remarcacao', 'apagado com sucesso');
    }

    public function remarcacao()
    {
        $remarcacao = AgendamentoHistory::all();

        return view('secretaria.sistema.Remarcacao.index', compact('remarcacao'));
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

    public function remarcacao_edit($id)
    {

        $agendamento_history = AgendamentoHistory::findOrFail($id);


        return view('secretaria.sistema.Remarcacao.edite', compact('agendamento_history'));
    }
    public function remarcacao_update(Request $request, AgendamentoHistory $agendamento_history)
    {
        // Validação dos campos que você quer permitir alterar
        $validated = $request->validate([
            'nova_data' => 'required|date',
            'nova_hora' => 'required',
            'motivo' => 'nullable|string|max:255',
        ]);


        // Atualiza o registro no banco
        $agendamento_history->update($validated);

        // Redireciona para a lista ou página desejada
        return redirect()
            ->route('marcacao.index')
            ->with('success', 'Remarcação atualizada com sucesso!');
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
            ->with('success', 'Agendamento removido com sucesso!');
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
