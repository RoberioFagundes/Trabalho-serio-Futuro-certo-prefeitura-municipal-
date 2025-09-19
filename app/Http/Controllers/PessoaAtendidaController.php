<?php

namespace App\Http\Controllers;

use App\Models\PessoaAtendida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PessoaAtendidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pessoasAtendidas = PessoaAtendida::all();
        return view('pessoas_atendidas.index', compact('pessoasAtendidas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pessoas_atendidas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'atendimento_id' => 'required|exists:atendimentos,id',
            'quantidade_pessoas' => 'required|integer|min:1',
            'valor_atendido' => 'required|numeric|min:0',
        ]);
        PessoaAtendida::create($validated);
        return redirect()->route('pessoas_atendidas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PessoaAtendida $pessoaAtendida)
    {
        //
        return view('pessoas_atendidas.show', compact('pessoaAtendida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PessoaAtendida $pessoaAtendida)
    {
        //
        return view('pessoas_atendidas.edit', compact('pessoaAtendida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PessoaAtendida $pessoaAtendida)
    {
        //
        $validated = $request->validate([
            'atendimento_id' => 'required|exists:atendimentos,id',
            'quantidade_pessoas' => 'required|integer|min:1',
            'valor_atendido' => 'required|numeric|min:0',
        ]);
        $pessoaAtendida->update($validated);
        return redirect()->route('pessoas_atendidas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PessoaAtendida $pessoaAtendida)
    {
        //
        $pessoaAtendida->delete();
        return redirect()->route('pessoas_atendidas.index');
    }
}
