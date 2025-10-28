@extends('layouts.app')

@section('title', 'Novo Pilar Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Novo Pilar Estratégico - {{ $plano->titulo }}</h5>
            <a href="{{ route('planos.show', $plano->id) }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Voltar
            </a>
        </div>

        <div class="card-body">
            <form action="{{ route('pilares.store', $plano->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label fw-semibold">Nome do Pilar</label>
                    <input 
                        type="text" 
                        name="nome" 
                        id="nome" 
                        class="form-control @error('nome') is-invalid @enderror"
                        placeholder="Ex: Inovação e Tecnologia"
                        value="{{ old('nome') }}"
                        required
                    >
                    <div class="form-text text-muted">
                        Escolha um nome que represente um dos principais focos estratégicos do plano.
                    </div>
                    @error('nome') 
                        <div class="invalid-feedback">{{ $message }}</div> 
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $plano->id) }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Salvar Pilar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
