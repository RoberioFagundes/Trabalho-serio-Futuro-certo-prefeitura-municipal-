<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        //
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pessoas,email',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);
        Pessoa::create($validated);
        return redirect()->route('pessoas.index');
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
        //
        return view('pessoas.edit', compact('pessoa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        //
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pessoas,email,' . $pessoa->id,
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);
        $pessoa->update($validated);
        return redirect()->route('pessoas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        //
        $pessoa->delete();
        return redirect()->route('pessoas.index');
    }
}
