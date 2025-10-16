@extends('layouts.app')

@section('title', 'Detalhes do Plano Estratégico')

@section('content')
<div class="container py-5">
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

    {{-- Seção do Diagnóstico Estratégico --}}
    <div class="card shadow-sm border-0">
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
</div>
@endsection
