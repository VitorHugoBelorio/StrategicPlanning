<?php

namespace App\Http\Controllers;

use App\Models\PilarEstrategico;
use App\Models\PlanoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PilarEstrategicoController extends Controller
{
    /**
     * Exibe a lista de pilares de um plano estratégico específico.
     */
    public function index($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        $pilares = $plano->pilares;
        return view('pilares.index', compact('plano', 'pilares'));
    }

    /**
     * Exibe o formulário de criação de um novo pilar.
     */
    public function create($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);
        return view('pilares.create', compact('plano'));
    }

    /**
     * Armazena um novo pilar no banco.
     */
    public function store(Request $request, $planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->findOrFail($planoId);

        $request->validate([
            'nome' => 'required|string|max:255',
            'objetivo' => 'required|string',
            'meta' => 'required|string',
            'indicador' => 'required|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
        ]);

        PilarEstrategico::create([
            'plano_estrategico_id' => $plano->id,
            'nome' => $request->nome,
            'objetivo' => $request->objetivo,
            'meta' => $request->meta,
            'indicador' => $request->indicador,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
        ]);

        return redirect()->route('planos.show', $plano->id)
            ->with('success', 'Pilar estratégico criado com sucesso!');
    }

    /**
     * Exibe os detalhes de um pilar específico com sua trilha de tasks.
     */
    public function show($id)
    {
        $pilar = PilarEstrategico::findOrFail($id);
        
        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        // Organiza as tasks por status
        $tasks = $pilar->tasks()
            ->orderBy('prioridade', 'desc')
            ->orderBy('data_fim', 'asc')
            ->get()
            ->groupBy('status');

        // Retorna a view com as tasks agrupadas
        return view('pilares.show', compact('pilar', 'tasks'));
    }

    /**
     * Exibe um relatório de progresso da trilha.
     */
    public function relatorioProgresso($id)
    {
        $pilar = PilarEstrategico::findOrFail($id);
        
        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $tasks = $pilar->tasks;
        
        $analise = [
            'total_tasks' => $tasks->count(),
            'concluidas' => $tasks->where('status', 'concluida')->count(),
            'em_andamento' => $tasks->where('status', 'em_andamento')->count(),
            'pendentes' => $tasks->where('status', 'pendente')->count(),
            'peso_total' => $tasks->sum(function($task) { return $task->peso; }),
            'peso_concluido' => $tasks->where('status', 'concluida')
                                     ->sum(function($task) { return $task->peso; }),
            'progresso' => $pilar->progresso,
            'prazo_medio' => $tasks->where('status', 'concluida')
                                  ->avg(function($task) {
                                      return $task->data_inicio->diffInDays($task->data_fim);
                                  })
        ];

        return view('pilares.relatorio', compact('pilar', 'analise'));
    }

    /**
     * Exibe o formulário de edição de um pilar.
     */
    public function edit($id)
    {
        $pilar = PilarEstrategico::findOrFail($id);

        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        return view('pilares.edit', compact('pilar'));
    }

    /**
     * Atualiza um pilar existente.
     */
    public function update(Request $request, $id)
    {
        $pilar = PilarEstrategico::findOrFail($id);

        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'objetivo' => 'required|string',
            'meta' => 'required|string',
            'indicador' => 'required|string',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
        ]);

        $pilar->update($request->all());

        return redirect()->route('planos.show', $pilar->plano->id)
            ->with('success', 'Pilar estratégico atualizado com sucesso!');
    }

    /**
     * Remove um pilar do banco.
     */
    public function destroy($id)
    {
        $pilar = PilarEstrategico::findOrFail($id);

        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $pilar->delete();

        return redirect()->route('planos.show', $pilar->plano->id)
            ->with('success', 'Pilar estratégico excluído com sucesso!');
    }
}
