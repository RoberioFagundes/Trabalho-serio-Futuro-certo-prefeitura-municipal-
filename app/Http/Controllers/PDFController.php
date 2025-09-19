<?php

namespace App\Http\Controllers;

use App\Models\Agendamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Gera e baixa um PDF de teste.
     */
    public function gerar($id)
    {
        // Você pode trocar o conteúdo por uma view
      $agendamento = Agendamento::with('pessoa')->findOrFail($id);
        // Carrega uma view Blade ou gera direto no código

        // dd($agendamento);
         $pdf = PDF::loadView('pdf.protocolo', [
            'agendamento'
            => $agendamento
            
        ])->setPaper('a4', 'portrait')->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('relatorio.pdf');
    }
}
