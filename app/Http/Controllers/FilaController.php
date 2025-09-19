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
        return view('filas.index', compact('filas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
