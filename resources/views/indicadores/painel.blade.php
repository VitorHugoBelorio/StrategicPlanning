@extends('layouts.app')

@section('title', 'Painel de Indicadores - ' . ($plano->titulo ?? 'Plano'))

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Painel de Indicadores — {{ $plano->titulo }}</h3>
        <a href="{{ route('planos.show', $plano->id) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Voltar ao Plano
        </a>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Progresso Geral</h6>

                    <div class="d-flex align-items-center mb-2">
                        <div class="me-3">
                            <div class="display-6 fw-bold text-success">
                                {{ data_get($metrics, 'plano.progresso_percent', 0) }}%
                            </div>
                        </div>
                        <div class="flex-fill">
                            <div class="progress mb-2" style="height:12px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: {{ data_get($metrics, 'plano.progresso_percent', 0) }}%">
                                </div>
                            </div>
                            <small class="text-muted">Peso concluído / peso total do plano</small>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between small text-muted">
                        <div>
                            <strong>{{ data_get($metrics, 'plano.total_tasks', 0) }}</strong>
                            <div>Tasks totais</div>
                        </div>
                        <div>
                            <strong>{{ data_get($metrics, 'plano.peso_total', 0) }}</strong>
                            <div>Peso total</div>
                        </div>
                        <div>
                            <strong>{{ data_get($metrics, 'plano.peso_concluido', 0) }}</strong>
                            <div>Peso concluído</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h6 class="card-title">Gráficos</h6>

                    <div class="mb-3">
                        <canvas id="chartProgressoPilares" style="width:100%; height:260px;"></canvas>
                    </div>

                    <div>
                        <canvas id="chartTasksPeriodo" style="width:100%; height:160px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h6 class="mb-0">Pilares — Detalhamento</h6>
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
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($metrics['pilares'] ?? [] as $p)
                            <tr>
                                <td>
                                    <strong>{{ $p['nome'] }}</strong><br>
                                    <small class="text-muted">
                                        {{ Str::limit( optional($plano->pilares->firstWhere('id', $p['id']))->objetivo ?? '', 80) }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $p['progresso_percent'] >= 100 ? 'success' : 'primary' }}">
                                        {{ $p['progresso_percent'] }}%
                                    </span>
                                </td>
                                <td class="text-center">
                                    {{ $p['concluidas'] }}/{{ $p['total_tasks'] }}
                                </td>
                                <td class="text-center">
                                    {{ $p['peso_total'] }}/{{ $p['peso_concluido'] }}
                                </td>
                                <td class="text-center">
                                    {{ $p['data_inicio'] ?? '-' }} — {{ $p['data_fim'] ?? '-' }}
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('pilares.show', $p['id']) }}" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-kanban"></i> Ver
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Nenhum pilar encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- carregar Chart.js via CDN (colocado no stack para garantir execução após layout) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    try {
        const metrics = @json($metrics ?? []);
        console.log('Indicadores metrics (raw):', metrics);

        // Progresso por pilar (bar)
        const labels = Array.isArray(metrics.charts?.labels) ? metrics.charts.labels : [];
        const progressoData = Array.isArray(metrics.charts?.progresso_por_pilar) ? metrics.charts.progresso_por_pilar : [];

        const canvas1 = document.getElementById('chartProgressoPilares');
        if (canvas1 && labels.length && window.Chart) {
            const ctx1 = canvas1.getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Progresso (%)',
                        data: progressoData,
                        backgroundColor: labels.map(() => 'rgba(25,135,84,0.85)'),
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true, max: 100 } },
                    plugins: { legend: { display: false } }
                }
            });
        } else if (canvas1) {
            const ctx1 = canvas1.getContext('2d');
            ctx1.clearRect(0,0,canvas1.width,canvas1.height);
            ctx1.fillStyle = '#6c757d';
            ctx1.font = '14px Arial';
            ctx1.fillText('Sem dados disponíveis para o gráfico de progresso', 10, 30);
        }

        // Tasks por período (line)
        const periodLabels = Array.isArray(metrics.period_distribution?.labels) ? metrics.period_distribution.labels : [];
        const periodCounts = Array.isArray(metrics.period_distribution?.counts) ? metrics.period_distribution.counts : [];

        const canvas2 = document.getElementById('chartTasksPeriodo');
        if (canvas2 && periodLabels.length && window.Chart) {
            const ctx2 = canvas2.getContext('2d');
            new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: periodLabels,
                    datasets: [{
                        label: 'Tasks por mês',
                        data: periodCounts,
                        borderColor: 'rgba(13,110,253,0.9)',
                        backgroundColor: 'rgba(13,110,253,0.12)',
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: { y: { beginAtZero: true } },
                    plugins: { legend: { display: false } }
                }
            });
        } else if (canvas2) {
            const ctx2 = canvas2.getContext('2d');
            ctx2.clearRect(0,0,canvas2.width,canvas2.height);
            ctx2.fillStyle = '#6c757d';
            ctx2.font = '14px Arial';
            ctx2.fillText('Sem dados de tarefas por período', 10, 30);
        }
    } catch (err) {
        console.error('Erro ao renderizar gráficos de indicadores:', err);
    }
});
</script>

<style>
#chartProgressoPilares, #chartTasksPeriodo {
    width: 100% !important;
    display: block;
}
.card .card-body canvas { min-height: 120px; }
</style>
@endpush