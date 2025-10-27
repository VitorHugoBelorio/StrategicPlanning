<?php

namespace App\Http\Controllers;

use App\Models\PlanoEstrategico;
use App\Models\ObjetivoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetivoEstrategicoController extends Controller
{
    public function index($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        $objetivos = $plano->objetivos;
        return view('objetivos.index', compact('plano', 'objetivos'));
    }

    public function create($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        return view('objetivos.create', compact('plano'));
    }

    public function store(Request $request, $planoId)
    {
        $request->validate([
            'descricao' => 'required|string|max:1000',
            'especifico' => 'nullable|string|max:1000',
            'mensuravel' => 'nullable|string|max:1000',
            'atingivel' => 'nullable|string|max:1000',
            'relevante' => 'nullable|string|max:1000',
            'tempo_definido' => 'nullable|string|max:255',
        ]);

        ObjetivoEstrategico::create([
            'plano_estrategico_id' => $planoId,
            'descricao' => $request->descricao,
            'especifico' => $request->especifico,
            'mensuravel' => $request->mensuravel,
            'atingivel' => $request->atingivel,
            'relevante' => $request->relevante,
            'tempo_definido' => $request->tempo_definido,
        ]);

        return redirect()->route('planos.show', $planoId)
            ->with('success', 'Objetivo estratégico criado com sucesso!');
    }

    public function edit($id)
    {
        $objetivo = ObjetivoEstrategico::findOrFail($id);
        return view('objetivos.edit', compact('objetivo'));
    }

    public function update(Request $request, $id)
    {
        $objetivo = ObjetivoEstrategico::findOrFail($id);

        $request->validate([
            'descricao' => 'required|string|max:1000',
            'especifico' => 'nullable|string|max:1000',
            'mensuravel' => 'nullable|string|max:1000',
            'atingivel' => 'nullable|string|max:1000',
            'relevante' => 'nullable|string|max:1000',
            'tempo_definido' => 'nullable|string|max:255',
        ]);

        $objetivo->update($request->only([
            'descricao', 'especifico', 'mensuravel', 'atingivel', 'relevante', 'tempo_definido'
        ]));

        $planoId = $objetivo->plano_estrategico_id;

        return redirect()->route('planos.show', $planoId)
            ->with('success', 'Objetivo estratégico atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $objetivo = ObjetivoEstrategico::findOrFail($id);
        $planoId = $objetivo->plano_estrategico_id;
        $objetivo->delete();

        return redirect()->route('planos.show', $planoId)
            ->with('success', 'Objetivo estratégico excluído com sucesso!');
    }
}
