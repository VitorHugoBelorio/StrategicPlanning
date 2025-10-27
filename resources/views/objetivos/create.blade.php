@extends('layouts.app')

@section('title', 'Novo Objetivo Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Novo Objetivo Estratégico - {{ $plano->titulo }}</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('objetivos.store', $plano->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Descrição Geral</label>
                    <textarea name="descricao" class="form-control @error('descricao') is-invalid @enderror" rows="3" placeholder="Descreva o objetivo de forma geral">{{ old('descricao') }}</textarea>
                    @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Específico</label>
                        <textarea name="especifico" class="form-control" rows="2" placeholder="Quem fará / O que será feito / Onde">{{ old('especifico') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Mensurável</label>
                        <textarea name="mensuravel" class="form-control" rows="2" placeholder="Como será medido o sucesso?">{{ old('mensuravel') }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Atingível</label>
                        <textarea name="atingivel" class="form-control" rows="2" placeholder="É possível alcançar com os recursos disponíveis?">{{ old('atingivel') }}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Relevante</label>
                        <textarea name="relevante" class="form-control" rows="2" placeholder="Por que esse objetivo é importante?">{{ old('relevante') }}</textarea>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tempo Definido</label>
                    <input type="text" name="tempo_definido" class="form-control" placeholder="Ex: Até dezembro de 2026" value="{{ old('tempo_definido') }}">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $plano->id) }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary fw-semibold">Salvar Objetivo</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
