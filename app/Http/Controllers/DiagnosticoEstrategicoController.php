<?php

namespace App\Http\Controllers;

use App\Models\DiagnosticoEstrategico;
use App\Models\PlanoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosticoEstrategicoController extends Controller
{
    public function create($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        return view('diagnosticos.create', compact('plano'));
    }

    public function store(Request $request, $planoId)
    {
        $request->validate([
            'pontos_fortes' => 'nullable|string',
            'pontos_fracos' => 'nullable|string',
            'oportunidades' => 'nullable|string',
            'ameacas' => 'nullable|string',
        ]);

        DiagnosticoEstrategico::create([
            'plano_estrategico_id' => $planoId,
            'pontos_fortes' => $request->pontos_fortes,
            'pontos_fracos' => $request->pontos_fracos,
            'oportunidades' => $request->oportunidades,
            'ameacas' => $request->ameacas,
        ]);

        return redirect()->route('planos.index')->with('success', 'Diagnóstico criado com sucesso!');
    }

    public function edit($id)
    {
        $diagnostico = DiagnosticoEstrategico::findOrFail($id);
        return view('diagnosticos.edit', compact('diagnostico'));
    }

    public function update(Request $request, $id)
    {
        $diagnostico = DiagnosticoEstrategico::findOrFail($id);

        $diagnostico->update($request->only(['pontos_fortes', 'pontos_fracos', 'oportunidades', 'ameacas']));

        return redirect()->route('planos.index')->with('success', 'Diagnóstico atualizado com sucesso!');
    }

    public function show($id)
    {
        $diagnostico = DiagnosticoEstrategico::with('plano')->findOrFail($id);
        return view('diagnosticos.show', compact('diagnostico'));
    }

}
