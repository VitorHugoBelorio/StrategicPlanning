@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Tasks do Pilar: {{ $pilar->nome }}</h2>
        <div>
            <a href="{{ route('planos.show', $pilar->plano_estrategico_id) }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Voltar ao Plano
            </a>
            <a href="{{ route('tasks.create', $pilar->id) }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Nova Task
            </a>
        </div>
    </div>

    @if($tasks->isEmpty())
        <div class="alert alert-info">
            Nenhuma task cadastrada neste pilar.
        </div>
    @else
        @foreach(['em_andamento', 'pendente', 'concluida', 'cancelada'] as $status)
            @if(isset($tasks[$status]))
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">{{ ucfirst(str_replace('_', ' ', $status)) }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Prioridade</th>
                                        <th>Responsável</th>
                                        <th>Prazo</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks[$status] as $task)
                                        <tr>
                                            <td>{{ $task->titulo }}</td>
                                            <td>
                                                <span class="badge bg-{{ $task->prioridade === 'alta' ? 'danger' : ($task->prioridade === 'media' ? 'warning' : 'success') }}">
                                                    {{ ucfirst($task->prioridade) }}
                                                </span>
                                            </td>
                                            <td>{{ $task->responsavel->name }}</td>
                                            <td>{{ $task->data_fim->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                            type="button" 
                                                            data-bs-toggle="dropdown">
                                                        Status
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="pendente">
                                                                <button type="submit" class="dropdown-item">Pendente</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="em_andamento">
                                                                <button type="submit" class="dropdown-item">Em Andamento</button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('tasks.update-status', $task->id) }}" method="POST">
                                                                @csrf
                                                                @method('PATCH')
                                                                <input type="hidden" name="status" value="concluida">
                                                                <button type="submit" class="dropdown-item">Concluída</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <a href="{{ route('tasks.edit', $task->id) }}" 
                                                   class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" 
                                                      method="POST" 
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Tem certeza que deseja excluir esta task?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
@endsection