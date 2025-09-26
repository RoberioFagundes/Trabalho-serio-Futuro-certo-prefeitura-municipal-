<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\EnderecoCidadao;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('nome'); // pega o valor do input do form

        $pessoas = Pessoa::when($search, function ($query, $search) {
            $query->where('nome', 'like', '%' . $search . '%');
        })
            ->orderBy('nome')
            ->paginate(10);

        return view('secretaria.sistema.Pessoa.index', [
            'pessoas' => $pessoas,
            'nome' => $search,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('secretaria.sistema.Pessoa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // 1️⃣ Valida os dados obrigatórios
            $validated = $request->validate([
                'nomeInput'   => 'required|string|max:255',
                'TelefoneInput'   => 'required|string|max:11',
                'bairroInput'    => 'required|string|max:255',
                'ruaInput'    => 'required|string|max:255',
                'cidadeInput' => 'required|string|max:100',
                'estadoInput' => 'required|string|max:2',
                'RgInput' => 'required|string|max:15',
                'dataInput' => 'required',
                // 'cep'    => 'required|string|max:9',
            ]);

            // 2️⃣ Cria a pessoa
            $pessoa = Pessoa::create([
                'nome'            => $request->input('nomeInput'),
                'telefone'        => $request->input('TelefoneInput'),
                'cpf'             => $request->input('cpfInput'), // <-- vai funcionar se o name do input for cpfInput
                'rg'              => $request->input('RgInput'),
                'data_nascimento' => $request->input('dataInput'),
                'cartao_sus'      => $request->input('SusInput'),
                'user_id'         => auth()->user()->id,
            ]);

            // 3️⃣ Cria o endereço vinculado à pessoa
            EnderecoCidadao::create([
                'pessoa_id' => $pessoa->id, // pega o ID gerado automaticamente
                'rua'       => $validated['ruaInput'],
                'bairro'       => $validated['bairroInput'],
                'cidade'    => $validated['cidadeInput'],
                'estado'    => $validated['estadoInput'],
                // 'cep'       => $validated['cep'],
            ]);

            /* Se tudo deu certo, chama DB::commit() → confirma as mudanças no banco
         Se algo deu errado, chama DB::rollBack() → cancela tudo que foi feito
        */

            DB::commit();

            return redirect()->route('pessoas.index')->with('success', 'Pessoa e endereço cadastrados com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['erro' => 'Erro ao salvar: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        //
        return view('pessoas.show', compact('pessoa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
       
        //carrega o relacionamento endereco_cidadaos 
        $pessoa->load('endereco_cidadaos');

        // dd($pessoa);
        return view('secretaria.sistema.Pessoa.edit', ['pessoaDados'=>$pessoa]);
    }

    /**
     * Update the specified resource in storage.
     */
     // Atualizar pessoa + endereço
    public function update(Request $request, Pessoa $pessoa)
    {
        $validated = $request->validate([
             'nomeInput'   => 'required|string|max:255',
                'TelefoneInput'   => 'required|',
                'bairroInput'    => 'required|string|max:255',
                'ruaInput'    => 'required|string|max:255',
                'cidadeInput' => 'required|string|max:100',
                'estadoInput' => 'required|',
                'RgInput' => 'required|string|max:15',
                'dataInput' => 'required',
        ]);

        DB::transaction(function () use ($validated, $pessoa, $request) {
            $pessoa->update([
                 'nomeInput'   => 'required|string|max:255',
                'TelefoneInput'   => 'required|string|max:11',
                'bairroInput'    => 'required|string|max:255',
                'ruaInput'    => 'required|string|max:255',
                'cidadeInput' => 'required|string|max:100',
                'estadoInput' => 'required|string|max:2',
                'RgInput' => 'required|string|max:15',
                'dataInput' => 'required',
            ]);

            // Atualiza ou cria o endereço
            $pessoa->endereco_cidadaos()->updateOrCreate(
                ['pessoa_id' => $pessoa->id],
                [
                    'rua' => $validated['rua'] ?? null,
                    'cidade' => $validated['cidade'] ?? null,
                    'estado' => $validated['estado'] ?? null,
                    'bairro' => $validated['bairro'] ?? null,
                ]
            );
        });

        return redirect()->route('pessoas.index')->with('success', 'Pessoa atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // Deletar pessoa + endereço
    public function destroy(Pessoa $pessoa)
    {
        DB::transaction(function () use ($pessoa) {
            $pessoa->endereco_cidadaos()->delete();
            $pessoa->delete();
        });

        return redirect()->route('pessoas.index')->with('success', 'Pessoa deletada com sucesso!');
    }
}
