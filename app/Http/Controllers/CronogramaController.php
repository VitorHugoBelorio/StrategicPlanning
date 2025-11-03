<?php

namespace App\Http\Controllers;

use App\Models\Cronograma;
use App\Models\PlanoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CronogramaController extends Controller
{
    public function index()
    {
        $cronogramas = Cronograma::orderBy('created_at', 'desc')->paginate(15);
        return view('cronogramas.index', compact('cronogramas'));
    }

    public function create()
    {
        $planos = PlanoEstrategico::orderBy('id')->get();
        return view('cronogramas.create', compact('planos'));
    }

    public function store(Request $request)
    {
        $rules = [
            'plano_estrategico_id' => 'required|exists:planos_estrategicos,id',
            'mes' => 'nullable|integer|min:1|max:12',
            'descricao' => 'nullable|string',
            'atividade' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'nullable|string|max:50',
        ];

        $data = $request->validate($rules);

        try {
            Cronograma::create($data);
            return redirect()->route('cronogramas.index')->with('success', 'Cronograma criado com sucesso.');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => 'Erro ao salvar: ' . $e->getMessage()]);
        }
    }

    public function show(Cronograma $cronograma)
    {
        return view('cronogramas.show', ['cronograma' => $cronograma]);
    }

    public function edit(Cronograma $cronograma)
    {
        $planos = PlanoEstrategico::orderBy('id')->get();
        return view('cronogramas.edit', compact('cronograma', 'planos'));
    }

    public function update(Request $request, Cronograma $cronograma)
    {
        $rules = [
            'plano_estrategico_id' => 'required|exists:planos_estrategicos,id',
            'mes' => 'nullable|integer|min:1|max:12',
            'descricao' => 'nullable|string',
            'atividade' => 'nullable|string',
            'responsavel' => 'nullable|string|max:255',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after_or_equal:data_inicio',
            'status' => 'nullable|string|max:50',
        ];

        $data = $request->validate($rules);

        try {
            $cronograma->update($data);
            return redirect()->route('cronogramas.show', $cronograma)->with('success', 'Cronograma atualizado com sucesso.');
        } catch (QueryException $e) {
            return back()->withInput()->withErrors(['error' => 'Erro ao atualizar: ' . $e->getMessage()]);
        }
    }

    public function destroy(Cronograma $cronograma)
    {
        try {
            $cronograma->delete();
            return redirect()->route('cronogramas.index')->with('success', 'Cronograma removido com sucesso.');
        } catch (QueryException $e) {
            return back()->withErrors(['error' => 'Erro ao deletar: ' . $e->getMessage()]);
        }
    }
}

