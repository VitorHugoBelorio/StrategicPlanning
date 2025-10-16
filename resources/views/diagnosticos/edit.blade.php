@extends('layouts.app')

@section('title', 'Editar Diagnóstico Estratégico')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Editar Diagnóstico Estratégico</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('diagnosticos.update', $diagnostico->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pontos Fortes</label>
                    <textarea name="pontos_fortes" class="form-control" rows="3">{{ old('pontos_fortes', $diagnostico->pontos_fortes) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pontos Fracos</label>
                    <textarea name="pontos_fracos" class="form-control" rows="3">{{ old('pontos_fracos', $diagnostico->pontos_fracos) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Oportunidades</label>
                    <textarea name="oportunidades" class="form-control" rows="3">{{ old('oportunidades', $diagnostico->oportunidades) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ameaças</label>
                    <textarea name="ameacas" class="form-control" rows="3">{{ old('ameacas', $diagnostico->ameacas) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    {{-- Voltar para os detalhes do plano associado --}}
                    <a href="{{ route('planos.show', $diagnostico->plano_estrategico_id) }}" 
                       class="btn btn-outline-secondary me-2">
                        Voltar
                    </a>

                    <button type="submit" class="btn btn-warning text-white fw-semibold">
                        Atualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
