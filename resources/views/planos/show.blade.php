@extends('layouts.app')

@section('title', 'Detalhes do Plano Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">{{ $plano->titulo }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Visão:</strong> {{ $plano->visao }}</p>
            <p><strong>Missão:</strong> {{ $plano->missao }}</p>
            <p><strong>Valores:</strong> {{ $plano->valores }}</p>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-warning text-white me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="{{ route('planos.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
