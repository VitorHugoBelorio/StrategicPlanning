<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanoEstrategico;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function gerarPDF($id)
    {
        $plano = PlanoEstrategico::with([
            'diagnostico',
            'objetivos',
            'pilares.tasks',
            'indicadores'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('relatorios.plano', compact('plano'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download("Relatorio_Plano_{$plano->titulo}.pdf");
    }
}
