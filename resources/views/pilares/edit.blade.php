@extends('layouts.app')

@section('title', 'Editar Pilar Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Editar Pilar Estratégico - {{ $pilar->nome }}</h5>
            <a href="{{ route('planos.show', $pilar->plano_estrategico_id) }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('pilares.update', $pilar->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label fw-semibold">Nome do Pilar</label>
                    <input type="text" 
                           name="nome" 
                           id="nome"
                           value="{{ old('nome', $pilar->nome) }}" 
                           class="form-control @error('nome') is-invalid @enderror"
                           placeholder="Ex: Inovação e Tecnologia" 
                           required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="objetivo" class="form-label fw-semibold">Objetivo</label>
                    <textarea name="objetivo" 
                             id="objetivo" 
                             class="form-control @error('objetivo') is-invalid @enderror"
                             rows="3"
                             placeholder="Descreva o objetivo deste pilar"
                             required>{{ old('objetivo', $pilar->objetivo) }}</textarea>
                    @error('objetivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta" class="form-label fw-semibold">Meta</label>
                    <textarea name="meta" 
                             id="meta" 
                             class="form-control @error('meta') is-invalid @enderror"
                             rows="2"
                             placeholder="Defina a meta a ser alcançada"
                             required>{{ old('meta', $pilar->meta) }}</textarea>
                    @error('meta')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="indicador" class="form-label fw-semibold">Indicador</label>
                    <input type="text" 
                           name="indicador" 
                           id="indicador"
                           value="{{ old('indicador', $pilar->indicador) }}" 
                           class="form-control @error('indicador') is-invalid @enderror"
                           placeholder="Ex: Percentual de conclusão" 
                           required>
                    @error('indicador')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="data_inicio" class="form-label fw-semibold">Data de Início</label>
                        <input type="date" 
                               name="data_inicio" 
                               id="data_inicio"
                               value="{{ old('data_inicio', $pilar->data_inicio->format('Y-m-d')) }}" 
                               class="form-control @error('data_inicio') is-invalid @enderror" 
                               required>
                        @error('data_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="data_fim" class="form-label fw-semibold">Data de Término</label>
                        <input type="date" 
                               name="data_fim" 
                               id="data_fim"
                               value="{{ old('data_fim', $pilar->data_fim->format('Y-m-d')) }}" 
                               class="form-control @error('data_fim') is-invalid @enderror" 
                               required>
                        @error('data_fim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $pilar->plano_estrategico_id) }}" 
                       class="btn btn-outline-secondary me-2">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        <i class="bi bi-save"></i> Atualizar Pilar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
