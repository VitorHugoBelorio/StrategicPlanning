@extends('layouts.app')

@section('title', 'Editar Pilar Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Editar Pilar Estratégico</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('pilares.update', $pilar->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nome do Pilar</label>
                    <input type="text" 
                           name="nome" 
                           value="{{ old('nome', $pilar->nome) }}" 
                           class="form-control @error('nome') is-invalid @enderror" 
                           required>
                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $pilar->plano_estrategico_id) }}" class="btn btn-outline-secondary me-2">
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-warning text-white">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
