@extends('layouts.app')

@section('title', 'Detalhes do Plano Estratégico')

@section('content')
<div class="container py-5">

    {{-- Seção: Plano Estratégico --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">{{ $plano->titulo }}</h5>
        </div>
        <div class="card-body">
            <p><strong>Visão:</strong> {{ $plano->visao }}</p>
            <p><strong>Missão:</strong> {{ $plano->missao }}</p>
            <p><strong>Valores:</strong> {{ $plano->valores }}</p>

            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-warning text-white me-2">
                    <i class="bi bi-pencil"></i> Editar Plano
                </a>
                <a href="{{ route('planos.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>

    {{-- Seção: Diagnóstico Estratégico --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Diagnóstico Estratégico</h5>

            @if($plano->diagnostico)
                <a href="{{ route('diagnosticos.edit', $plano->diagnostico->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-pencil-square"></i> Editar Diagnóstico
                </a>
            @else
                <a href="{{ route('diagnosticos.create', $plano->id) }}" class="btn btn-light btn-sm">
                    <i class="bi bi-plus-circle"></i> Criar Diagnóstico
                </a>
            @endif
        </div>

        <div class="card-body">
            @if($plano->diagnostico)
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-success">Pontos Fortes</h6>
                        <p>{{ $plano->diagnostico->pontos_fortes ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-danger">Pontos Fracos</h6>
                        <p>{{ $plano->diagnostico->pontos_fracos ?? '—' }}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Oportunidades</h6>
                        <p>{{ $plano->diagnostico->oportunidades ?? '—' }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-warning">Ameaças</h6>
                        <p>{{ $plano->diagnostico->ameacas ?? '—' }}</p>
                    </div>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-clipboard-x display-6 d-block mb-2"></i>
                    Nenhum diagnóstico cadastrado para este plano.
                </div>
            @endif
        </div>
    </div>

    {{-- Seção: Objetivos Estratégicos --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Objetivos Estratégicos</h5>
            <a href="{{ route('objetivos.create', $plano->id) }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Novo Objetivo
            </a>
        </div>

        <div class="card-body">
            @if($plano->objetivos->isEmpty())
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-flag display-6 d-block mb-2"></i>
                    Nenhum objetivo estratégico cadastrado ainda.
                </div>
            @else
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Descrição</th>
                            <th>Específico</th>
                            <th>Mensurável</th>
                            <th>Atingível</th>
                            <th>Relevante</th>
                            <th>Tempo Definido</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plano->objetivos as $objetivo)
                            <tr>
                                <td>{{ $objetivo->descricao }}</td>
                                <td>{{ $objetivo->especifico ?? '—' }}</td>
                                <td>{{ $objetivo->mensuravel ?? '—' }}</td>
                                <td>{{ $objetivo->atingivel ?? '—' }}</td>
                                <td>{{ $objetivo->relevante ?? '—' }}</td>
                                <td>{{ $objetivo->tempo_definido ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('objetivos.edit', $objetivo->id) }}" class="btn btn-outline-warning btn-sm" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('objetivos.destroy', $objetivo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Deseja excluir este objetivo?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Seção: Pilares Estratégicos --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pilares Estratégicos</h5>
            <a href="{{ route('pilares.create', $plano->id) }}" class="btn btn-light btn-sm">
                <i class="bi bi-plus-circle"></i> Novo Pilar
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Pilar</th>
                            <th class="text-center">Progresso</th>
                            <th class="text-center">Tasks</th>
                            <th class="text-center">Peso (total/concl.)</th>
                            <th class="text-center">Período</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plano->pilares as $pilar)
                            <tr>
                                <td>
                                    <strong>{{ $pilar->nome }}</strong><br>
                                    <small class="text-muted">{{ Str::limit($pilar->objetivo, 100) }}</small>
                                </td>

                                <td class="text-center" style="min-width:180px;">
                                    <div class="mb-1">
                                        <span class="badge bg-{{ $pilar->progresso >= 100 ? 'success' : 'primary' }}">
                                            {{ number_format($pilar->progresso, 0) }}%
                                        </span>
                                    </div>
                                    <div class="progress" style="height:8px;">
                                        <div class="progress-bar bg-success" role="progressbar"
                                             style="width: {{ $pilar->progresso }}%;" aria-valuenow="{{ $pilar->progresso }}"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </td>

                                <td class="text-center">
                                    {{ $pilar->tasks->where('status', 'concluida')->count() }}/{{ $pilar->tasks->count() }}
                                </td>

                                <td class="text-center">
                                    {{ $pilar->tasks->sum('peso') ?? 0 }}/{{ $pilar->tasks->where('status', 'concluida')->sum('peso') ?? 0 }}
                                </td>

                                <td class="text-center">
                                    {{ optional($pilar->data_inicio)->format('Y-m-d') ?? '-' }} — {{ optional($pilar->data_fim)->format('Y-m-d') ?? '-' }}
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('pilares.show', $pilar->id) }}" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-kanban"></i> Ver
                                    </a>
                                    <a href="{{ route('pilares.edit', $pilar->id) }}" class="btn btn-sm btn-outline-warning ms-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pilares.destroy', $pilar->id) }}" method="POST" class="d-inline ms-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja excluir este pilar estratégico?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Nenhum pilar estratégico definido ainda.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Seção: Indicador de Desempenho (compacto) --}}
    <div class="card shadow-sm border-0 mt-4 indicator-compact">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Indicador de Desempenho</h5>
            <a href="{{ route('indicadores.painel', $plano->id) }}" class="btn btn-light btn-sm">
                <i class="bi bi-bar-chart"></i> Ver Detalhes
            </a>
        </div>

        <div class="card-body py-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-4">
                    <h6 class="mb-1">Progresso Geral</h6>
                    <div class="progress mb-2" style="height:10px;">
                        <div id="progressoGeralBar" class="progress-bar bg-success" role="progressbar" style="width:0%">0%</div>
                    </div>
                    <p class="small text-muted mb-0">Peso concluído / peso total do plano</p>

                    <ul class="list-unstyled small text-muted mt-3 mb-0" id="pilaresLegenda">
                        <!-- preenchido via JS -->
                    </ul>
                </div>

                <div class="col-md-8">
                    <div class="d-flex gap-2">
                        <div class="flex-fill">
                            <canvas id="chartProgressoPilares" height="140"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* compacta a seção de indicadores para não ocupar tanto espaço */
.indicator-compact .card-body { padding-top: 0.75rem; padding-bottom: 0.75rem; }
.indicator-compact #pilaresLegenda li { line-height: 1.1; }
@media (max-width: 767px) {
    .indicator-compact .card-body { padding: 0.5rem; }
    .indicator-compact canvas { height: 120px !important; }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const url = "{{ route('indicadores.chart', $plano->id) }}";

    fetch(url)
        .then(res => res.json())
        .then(data => {
            const progresso = data.plano?.progresso_percent ?? 0;
            const bar = document.getElementById('progressoGeralBar');
            if (bar) {
                bar.style.width = progresso + '%';
                bar.textContent = progresso + '%';
            }

            const legenda = document.getElementById('pilaresLegenda');
            if (legenda && Array.isArray(data.pilares)) {
                legenda.innerHTML = data.pilares.map(p =>
                    `<li class="mb-1"><strong>${p.nome}</strong> — ${p.progresso_percent}% <span class="text-muted">(${p.concluidas}/${p.total_tasks})</span></li>`
                ).join('');
            }

            // Chart: progresso por pilar
            const ctx1 = document.getElementById('chartProgressoPilares')?.getContext('2d');
            if (ctx1) {
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: data.charts?.labels || [],
                        datasets: [{
                            label: 'Progresso (%)',
                            data: data.charts?.progresso_por_pilar || [],
                            backgroundColor: 'rgba(25,135,84,0.85)'
                        }]
                    },
                    options: { responsive: true, scales: { y: { beginAtZero: true, max: 100 } } }
                });
            }

            // Chart: tasks por período
            const ctx2 = document.getElementById('chartTasksPeriodo')?.getContext('2d');
            if (ctx2) {
                new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: data.period_distribution?.labels || [],
                        datasets: [{
                            label: 'Tasks por mês',
                            data: data.period_distribution?.counts || [],
                            borderColor: 'rgba(13,110,253,0.9)',
                            backgroundColor: 'rgba(13,110,253,0.15)',
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: { responsive: true, scales: { y: { beginAtZero: true } } }
                });
            }
        })
        .catch(err => {
            console.error('Erro ao carregar dados de indicadores:', err);
        });
});
</script>
@endpush

@endsection
