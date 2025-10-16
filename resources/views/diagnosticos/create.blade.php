@extends('layouts.app')

@section('title', 'Novo Diagnóstico Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Diagnóstico Estratégico - {{ $plano->titulo }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('diagnosticos.store', $plano->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pontos Fortes</label>
                    <textarea name="pontos_fortes" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pontos Fracos</label>
                    <textarea name="pontos_fracos" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Oportunidades</label>
                    <textarea name="oportunidades" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ameaças</label>
                    <textarea name="ameacas" class="form-control" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Diagnóstico</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
