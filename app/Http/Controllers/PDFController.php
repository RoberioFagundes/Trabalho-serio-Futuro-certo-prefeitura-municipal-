<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Gera e baixa um PDF de teste.
     */
    public function gerar()
    {
        // Você pode trocar o conteúdo por uma view
        $agendamento = [
            'titulo' => 'Relatório de Teste',
            'mensagem' => 'Este PDF foi gerado com sucesso!'
        ];

        // Carrega uma view Blade ou gera direto no código
        $pdf = Pdf::loadView('pdf.protocolo', $agendamento);

        return $pdf->download('relatorio.pdf');
    }
}
