<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\PilarEstrategico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Lista todas as tasks de uma trilha específica.
     */
    public function index($pilarId)
    {
        $pilar = PilarEstrategico::findOrFail($pilarId);
        
        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $tasks = $pilar->tasks()
            ->orderBy('prioridade', 'desc')
            ->orderBy('data_inicio', 'asc')
            ->get()
            ->groupBy('status');

        return view('tasks.index', compact('pilar', 'tasks'));
    }

    /**
     * Mostra o formulário de criação de task.
     */
    public function create($pilarId)
    {
        $pilar = PilarEstrategico::findOrFail($pilarId);
        
        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $usuarios = User::all(); // Para selecionar o responsável
        return view('tasks.create', compact('pilar', 'usuarios'));
    }

    /**
     * Salva uma nova task.
     */
    public function store(Request $request, $pilarId)
    {
        $pilar = PilarEstrategico::findOrFail($pilarId);
        
        if ($pilar->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|in:baixa,media,alta',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'responsavel_id' => 'required|exists:users,id'
        ]);

        Task::create([
            'pilar_estrategico_id' => $pilar->id,
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prioridade' => $request->prioridade,
            'status' => 'pendente',
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
            'responsavel_id' => $request->responsavel_id
        ]);

        return redirect()->route('pilares.show', $pilar->id)
            ->with('success', 'Task criada com sucesso!');
    }

    /**
     * Mostra o formulário de edição de task.
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->pilarEstrategico->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $usuarios = User::all();
        return view('tasks.edit', compact('task', 'usuarios'));
    }

    /**
     * Atualiza uma task existente.
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->pilarEstrategico->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|in:baixa,media,alta',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after:data_inicio',
            'responsavel_id' => 'required|exists:users,id'
        ]);

        $task->update($request->all());

        return redirect()->route('pilares.show', $task->pilar_estrategico_id)
            ->with('success', 'Task atualizada com sucesso!');
    }

    /**
     * Atualiza o status de uma task.
     */
    public function updateStatus(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->pilarEstrategico->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'status' => 'required|in:pendente,em_andamento,concluida,cancelada'
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }

    /**
     * Remove uma task.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        
        if ($task->pilarEstrategico->plano->user_id !== Auth::id()) {
            abort(403, 'Acesso negado.');
        }

        $task->delete();

        return redirect()->route('pilares.show', $task->pilar_estrategico_id)
            ->with('success', 'Task excluída com sucesso!');
    }
}
