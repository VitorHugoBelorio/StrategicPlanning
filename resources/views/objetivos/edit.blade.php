@extends('layouts.app')

@section('title', 'Editar Objetivo Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Editar Objetivo Estratégico</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('objetivos.update', $objetivo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Título</label>
                    <input type="text" name="titulo" value="{{ old('titulo', $objetivo->titulo) }}" class="form-control @error('titulo') is-invalid @enderror" required>
                    @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Descrição</label>
                    <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3">{{ old('descricao', $objetivo->descricao) }}</textarea>
                    @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Específico</label>
                        <input type="text" name="especifico" value="{{ old('especifico', $objetivo->especifico) }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Mensurável</label>
                        <input type="text" name="mensuravel" value="{{ old('mensuravel', $objetivo->mensuravel) }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Atingível</label>
                        <input type="text" name="atingivel" value="{{ old('atingivel', $objetivo->atingivel) }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Relevante</label>
                        <input type="text" name="relevante" value="{{ old('relevante', $objetivo->relevante) }}" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tempo Definido</label>
                    <input type="text" name="tempo_definido" value="{{ old('tempo_definido', $objetivo->tempo_definido) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Prazo</label>
                    <input type="text" name="prazo" value="{{ old('prazo', $objetivo->prazo) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Indicador de Sucesso</label>
                    <input type="text" name="indicador_sucesso" value="{{ old('indicador_sucesso', $objetivo->indicador_sucesso) }}" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $objetivo->plano_estrategico_id) }}" class="btn btn-outline-secondary me-2">Voltar</a>
                    <button type="submit" class="btn btn-warning text-white">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
