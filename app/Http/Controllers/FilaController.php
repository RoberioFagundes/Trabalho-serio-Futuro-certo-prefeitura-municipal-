<?php

namespace App\Http\Controllers;

use App\Models\Fila;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $filas = Fila::all();
        return view('secretaria.sistema.fila.index', compact('filas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view ('secretaria.sistema.fila.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Conta o total de pessoas já cadastradas (opcional)
    $totalPessoas = Fila::count();

    // Descobre o último número usado e incrementa +1
    $ultimoNumero = Fila::max('numero') ?? 0;
    $proximoNumero = $ultimoNumero + 1;

    $fila = new Fila();
    $fila->nome = $request->nomeCidadaoFila;
    $fila->descricao = $request->descricaoCidadaoFila;
    $fila->numero = $proximoNumero; // número correto (INT)
    $fila->preferencia = $request->preferencia;
    $fila->motivo_preferencia=$request->motivo_atendimento_preferencial;
    $fila->qtd_pessoas = $totalPessoas + 1; // soma +1 pois está entrando mais uma pessoa
    $fila->user_id = auth()->id();
    $fila->agendamento_id = $request->agendamento_id;
    $fila->save();

    return redirect()->route('filas.index')
                 ->with('success', 'Pessoa adicionada à fila com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fila $fila)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fila $fila)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fila $fila)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fila $fila)
    {
        //
    }
}
