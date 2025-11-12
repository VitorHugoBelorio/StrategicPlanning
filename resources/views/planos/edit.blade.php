@extends('layouts.app')

@section('title', 'Editar Plano Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Editar Plano Estratégico</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('planos.update', $plano->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Título</label>
                    <input type="text" name="titulo" class="form-control" value="{{ $plano->titulo }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Visão</label>
                    <textarea name="visao" class="form-control" rows="2" required>{{ $plano->visao }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Missão</label>
                    <textarea name="missao" class="form-control" rows="2" required>{{ $plano->missao }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Valores</label>
                    <textarea name="valores" class="form-control" rows="2" required>{{ $plano->valores }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $plano->id) }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
