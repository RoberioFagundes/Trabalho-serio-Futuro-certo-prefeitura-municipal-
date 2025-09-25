<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
         $atendimentos = Atendimento::when($request->filled('search'), function ($query) use ($request) {
                $query->where('nome', 'like', '%' . $request->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->simplePaginate(2); // Paginação de 10 itens por página

        return view('secretaria.sistema.atendimento.index', ['atendimentos' => $atendimentos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('atendimentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'data_hora_inicio' => 'required|date',
            'data_hora_fim' => 'nullable|date|after_or_equal:data_hora_inicio',
            'fila_id' => 'required|exists:filas,id',
            'user_id' => 'required|exists:users,id',
        ]);
        Atendimento::create($validated);
        return redirect()->route('atendimentos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atendimento $atendimento)
    {
        //
        return view('atendimentos.show', compact('atendimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atendimento $atendimento)
    {
        //
        return view('atendimentos.edit', compact('atendimento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atendimento $atendimento)
    {
        //
        $validated = $request->validate([
            'data_hora_inicio' => 'required|date',
            'data_hora_fim' => 'nullable|date|after_or_equal:data_hora_inicio',
            'fila_id' => 'required|exists:filas,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $atendimento->update($validated);
        return redirect()->route('atendimentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atendimento $atendimento)
    {
        //
        $atendimento->delete();
        return redirect()->route('atendimentos.index');
    }
}
