<?php

namespace App\Http\Controllers;

use App\Models\ReAgendamento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReAgendamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $reAgendamentos = ReAgendamento::all();
        return view('re_agendamentos.index', compact('reAgendamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('re_agendamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'data_hora' => 'required|date',
            'motivo' => 'nullable|string',
            'agendamento_id' => 'required|exists:agendamentos,id',
        ]);
        ReAgendamento::create($validated);
        return redirect()->route('re_agendamentos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReAgendamento $reAgendamento)
    {
        //
        return view('re_agendamentos.show', compact('reAgendamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReAgendamento $reAgendamento)
    {
        //
        return view('re_agendamentos.edit', compact('reAgendamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReAgendamento $reAgendamento)
    {
        //
        $validated = $request->validate([
            'data_hora' => 'required|date',
            'motivo' => 'nullable|string',
            'agendamento_id' => 'required|exists:agendamentos,id',
        ]);
        $reAgendamento->update($validated);
        return redirect()->route('re_agendamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReAgendamento $reAgendamento)
    {
        //
        $reAgendamento->delete();
        return redirect()->route('re_agendamentos.index');
    }
}
