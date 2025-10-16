@extends('layouts.app')

@section('title', 'Meus Planos Estratégicos')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">Meus Planos Estratégicos</h2>
        <a href="{{ route('planos.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Novo Plano
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($planos->isEmpty())
        <div class="text-center py-5 text-muted">
            <i class="bi bi-journal-x display-5 d-block mb-2"></i>
            Nenhum plano cadastrado ainda.
        </div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Visão</th>
                            <th>Missão</th>
                            <th>Valores</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($planos as $plano)
                            <tr>
                                <td>{{ $plano->titulo }}</td>
                                <td>{{ Str::limit($plano->visao, 40) }}</td>
                                <td>{{ Str::limit($plano->missao, 40) }}</td>
                                <td>{{ Str::limit($plano->valores, 40) }}</td>
                                <td class="text-end">
                                    {{-- Ver Detalhes do Plano --}}
                                    <a href="{{ route('planos.show', $plano->id) }}" 
                                       class="btn btn-outline-primary btn-sm" title="Ver Detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Editar Plano --}}
                                    <a href="{{ route('planos.edit', $plano->id) }}" 
                                       class="btn btn-outline-warning btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    {{-- Excluir Plano --}}
                                    <form action="{{ route('planos.destroy', $plano->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm" 
                                                onclick="return confirm('Tem certeza que deseja excluir este plano?')" 
                                                title="Excluir">
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
    @endif
</div>
@endsection
