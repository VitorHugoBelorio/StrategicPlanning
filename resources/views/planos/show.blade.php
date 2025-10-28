@extends('layouts.app')

@section('title', 'Detalhes do Plano Estratégico')

@section('content')
<div class="container py-5">

    {{-- Seção: Plano Estratégico --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">{{ $plano->titulo }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Visão:</strong> {{ $plano->visao }}</p>
            <p><strong>Missão:</strong> {{ $plano->missao }}</p>
            <p><strong>Valores:</strong> {{ $plano->valores }}</p>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-warning text-white me-2">
                    <i class="bi bi-pencil"></i> Editar Plano
                </a>
                <a href="{{ route('planos.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    {{-- Seção: Diagnóstico Estratégico --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Diagnóstico Estratégico</h5>

            @if($plano->diagnostico)
                <a href="{{ route('diagnosticos.edit', $plano->diagnostico->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-pencil-square"></i> Editar Diagnóstico
                </a>
            @else
                <a href="{{ route('diagnosticos.create', $plano->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Criar Diagnóstico
                </a>
            @endif
        </div>

        <div class="card-body">
            @if($plano->diagnostico)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success">Pontos Fortes</h6>
                        <p>{{ $plano->diagnostico->pontos_fortes ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-danger">Pontos Fracos</h6>
                        <p>{{ $plano->diagnostico->pontos_fracos ?? '—' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Oportunidades</h6>
                        <p>{{ $plano->diagnostico->oportunidades ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-warning">Ameaças</h6>
                        <p>{{ $plano->diagnostico->ameacas ?? '—' }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-clipboard-x display-6 d-block mb-2"></i>
                    Nenhum diagnóstico cadastrado para este plano.
                </div>
            @endif
        </div>
    </div>

    {{-- Seção: Objetivos Estratégicos --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Objetivos Estratégicos</h5>
            <a href="{{ route('objetivos.create', $plano->id) }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Novo Objetivo
            </a>
        </div>

        <div class="card-body">
            @if($plano->objetivos->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-flag display-6 d-block mb-2"></i>
                    Nenhum objetivo estratégico cadastrado ainda.
                </div>
            @else
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Descrição</th>
                            <th>Específico</th>
                            <th>Mensurável</th>
                            <th>Atingível</th>
                            <th>Relevante</th>
                            <th>Tempo Definido</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plano->objetivos as $objetivo)
                            <tr>
                                <td>{{ $objetivo->descricao }}</td>
                                <td>{{ $objetivo->especifico ?? '—' }}</td>
                                <td>{{ $objetivo->mensuravel ?? '—' }}</td>
                                <td>{{ $objetivo->atingivel ?? '—' }}</td>
                                <td>{{ $objetivo->relevante ?? '—' }}</td>
                                <td>{{ $objetivo->tempo_definido ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('objetivos.edit', $objetivo->id) }}" class="btn btn-outline-warning btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('objetivos.destroy', $objetivo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja excluir este objetivo?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

{{-- Seção: Pilares Estratégicos --}}
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Pilares Estratégicos</h5>
        <a href="{{ route('pilares.create', $plano->id) }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle"></i> Novo Pilar
        </a>
    </div>

    <div class="card-body">
        @if($plano->pilares->isEmpty())
            <div class="text-center py-4 text-muted">
                <i class="bi bi-diagram-3 display-6 d-block mb-2"></i>
                Nenhum pilar estratégico cadastrado ainda.
            </div>
        @else
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plano->pilares as $pilar)
                        <tr>
                            <td>
                                <a href="{{ route('pilares.show', $pilar->id) }}" class="text-decoration-none text-dark">
                                    {{ $pilar->nome }}
                                </a>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('pilares.edit', $pilar->id) }}" 
                                   class="btn btn-outline-warning btn-sm" 
                                   title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('pilares.destroy', $pilar->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-outline-danger btn-sm" 
                                            onclick="return confirm('Deseja excluir este pilar estratégico?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection
