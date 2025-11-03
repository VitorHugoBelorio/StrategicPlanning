<?php

namespace App\Http\Controllers;

use App\Models\AcaoEstrategica;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class AcaoEstrategicaController extends Controller
{
    public function index()
    {
        $acoes = AcaoEstrategica::orderBy('created_at', 'desc')->paginate(15);
        return view('acoes_estrategicas.index', compact('acoes'));
    }

    public function create()
    {
        // Certifique-se de fornecer os pilares na view para popular um select
        // ex: $pilares = PilarEstrategico::all();
        return view('acoes_estrategicas.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'pilar_estrategico_id' => 'required|exists:pilares_estrategicos,id',
            'what' => 'nullable|string|max:255',
            'why' => 'nullable|string|max:255',
            'who' => 'nullable|string|max:255',
            'when' => 'nullable|string|max:255',
            'where' => 'nullable|string|max:255',
            'how' => 'nullable|string',
            'how_much' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
            'prazo' => 'nullable|date',
        ];

        $data = $request->validate($rules);

        try {
            AcaoEstrategica::create($data);
            return redirect()->route('acoes_estrategicas.index')
                ->with('success', 'Ação estratégica criada com sucesso.');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => 'Erro ao salvar: ' . $e->getMessage()]);
        }
    }

    public function show(AcaoEstrategica $acaoEstrategica)
    {
        return view('acoes_estrategicas.show', ['acao' => $acaoEstrategica]);
    }

    public function edit(AcaoEstrategica $acaoEstrategica)
    {
        // Forneça também os pilares se precisar alterar o pilar
        return view('acoes_estrategicas.edit', ['acao' => $acaoEstrategica]);
    }

    public function update(Request $request, AcaoEstrategica $acaoEstrategica)
    {
        $rules = [
            'pilar_estrategico_id' => 'required|exists:pilares_estrategicos,id',
            'what' => 'nullable|string|max:255',
            'why' => 'nullable|string|max:255',
            'who' => 'nullable|string|max:255',
            'when' => 'nullable|string|max:255',
            'where' => 'nullable|string|max:255',
            'how' => 'nullable|string',
            'how_much' => 'nullable|string|max:255',
            'descricao' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
            'prazo' => 'nullable|date',
        ];

        $data = $request->validate($rules);

        try {
            $acaoEstrategica->update($data);
            return redirect()->route('acoes_estrategicas.show', $acaoEstrategica)
                ->with('success', 'Ação estratégica atualizada com sucesso.');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => 'Erro ao atualizar: ' . $e->getMessage()]);
        }
    }

    public function destroy(AcaoEstrategica $acaoEstrategica)
    {
        try {
            $acaoEstrategica->delete();
            return redirect()->route('acoes_estrategicas.index')
                ->with('success', 'Ação estratégica removida com sucesso.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Erro ao deletar: ' . $e->getMessage()]);
        }
    }
}

