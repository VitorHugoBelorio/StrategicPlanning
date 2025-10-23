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
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'nullable|string|max:100',
            'indicador_sucesso' => 'nullable|string|max:255',
        ]);

        ObjetivoEstrategico::create([
            'plano_estrategico_id' => $planoId,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prazo' => $request->prazo,
            'indicador_sucesso' => $request->indicador_sucesso,
        ]);

        return redirect()->route('planos.show', $planoId)->with('success', 'Objetivo estratégico criado com sucesso!');
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
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prazo' => 'nullable|string|max:100',
            'indicador_sucesso' => 'nullable|string|max:255',
        ]);

        $objetivo->update($request->only(['titulo', 'descricao', 'prazo', 'indicador_sucesso']));

        $planoId = $objetivo->plano_estrategico_id;
        return redirect()->route('planos.show', $planoId)->with('success', 'Objetivo estratégico atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $objetivo = ObjetivoEstrategico::findOrFail($id);
        $planoId = $objetivo->plano_estrategico_id;
        $objetivo->delete();

        return redirect()->route('planos.show', $planoId)->with('success', 'Objetivo estratégico excluído com sucesso!');
    }
}
