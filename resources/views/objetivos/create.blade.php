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
                    <label class="form-label fw-semibold">Título</label>
                    <input type="text" name="titulo" placeholder="Ex: Aumentar a produção em 20% nos próximos 12 meses" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
                    <div class="form-text text-muted">Resuma o objetivo em uma frase curta e direta.</div>
                    @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Descrição</label>
                    <textarea name="descricao" placeholder="Descreva o objetivo com detalhes: contexto, motivação e escopo." class="form-control @error('descricao') is-invalid @enderror" rows="3">{{ old('descricao') }}</textarea>
                    <div class="form-text text-muted">Explique o que o objetivo envolve e por que é importante.</div>
                    @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Específico</label>
                        <input type="text" name="especifico" placeholder="Quem fará / Onde / O que exatamente será feito" class="form-control" value="{{ old('especifico') }}">
                        <div class="form-text text-muted">Detalhe exatamente o que será alcançado (quem, o quê, onde).</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Mensurável</label>
                        <input type="text" name="mensuravel" placeholder="Ex: +20% vendas, redução de custos em R$" class="form-control" value="{{ old('mensuravel') }}">
                        <div class="form-text text-muted">Como você vai medir o sucesso? número, porcentagem, índice.</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Atingível</label>
                        <input type="text" name="atingivel" placeholder="Recursos/competências necessárias — é realista?" class="form-control" value="{{ old('atingivel') }}">
                        <div class="form-text text-muted">Indique se o objetivo é realista e quais recursos são necessários.</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Relevante</label>
                        <input type="text" name="relevante" placeholder="Por que isso importa para a organização?" class="form-control" value="{{ old('relevante') }}">
                        <div class="form-text text-muted">Explique a importância estratégica do objetivo.</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tempo Definido</label>
                    <input type="text" name="tempo_definido" placeholder="Ex: 12 meses / até 2026-12-31" class="form-control" value="{{ old('tempo_definido') }}">
                    <div class="form-text text-muted">Período para alcançar o objetivo (prazo claro).</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Prazo</label>
                    <input type="text" name="prazo" placeholder="Ex: 2025-10-31 ou Q4 2025" class="form-control" value="{{ old('prazo') }}">
                    <div class="form-text text-muted">Data limite ou período (pode ser uma data ou trimestre).</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Indicador de Sucesso</label>
                    <input type="text" name="indicador_sucesso" placeholder="Ex: aumento de 20% nas vendas mensais / NPS ≥ 70" class="form-control" value="{{ old('indicador_sucesso') }}">
                    <div class="form-text text-muted">Métrica específica que indica que o objetivo foi atingido.</div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('planos.show', $plano->id) }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection