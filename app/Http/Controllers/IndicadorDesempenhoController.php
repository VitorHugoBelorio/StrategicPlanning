<?php

namespace App\Http\Controllers;

use App\Models\PlanoEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class IndicadorDesempenhoController extends Controller
{
    /**
     * Retorna a view parcial (ou página) com os dados de indicadores para um plano.
     * Esta action pode ser incluída em planos/show.blade.php via @include ou chamada via AJAX.
     */
    public function painel($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())
            ->with(['pilares.tasks.responsavel'])
            ->findOrFail($planoId);

        $metrics = $this->computePlanoMetrics($plano);

        return view('indicadores.painel', compact('plano', 'metrics'));
    }

    /**
     * Endpoint JSON para gráficos (Chart.js, etc).
     */
    public function chartData($planoId)
    {
        $plano = PlanoEstrategico::where('user_id', Auth::id())->with('pilares.tasks')->findOrFail($planoId);

        $metrics = $this->computePlanoMetrics($plano);

        return response()->json($metrics);
    }

    /**
     * Calcula métricas agregadas do plano e por pilar.
     * Retorna uma estrutura simples para consumo por views e charts.
     */
    protected function computePlanoMetrics(PlanoEstrategico $plano): array
    {
        $pilaresData = [];
        $totalPesoPlano = 0;
        $pesoConcluidoPlano = 0;
        $totalTasksPlano = 0;
        $concluidasPlano = 0;

        foreach ($plano->pilares as $pilar) {
            $tasks = $pilar->tasks;
            $pesoTotal = $tasks->sum(function($t){ return $t->peso ?? 0; });
            $pesoConcluido = $tasks->where('status', 'concluida')->sum(function($t){ return $t->peso ?? 0; });
            $totalTasks = $tasks->count();
            $concluidas = $tasks->where('status', 'concluida')->count();

            $progressoPilar = $pesoTotal > 0 ? ($pesoConcluido / $pesoTotal) * 100 : 0;

            $pilaresData[] = [
                'id' => $pilar->id,
                'nome' => $pilar->nome,
                'progresso_percent' => round($progressoPilar, 2),
                'peso_total' => $pesoTotal,
                'peso_concluido' => $pesoConcluido,
                'total_tasks' => $totalTasks,
                'concluidas' => $concluidas,
                'data_inicio' => optional($pilar->data_inicio)?->toDateString(),
                'data_fim' => optional($pilar->data_fim)?->toDateString(),
            ];

            $totalPesoPlano += $pesoTotal;
            $pesoConcluidoPlano += $pesoConcluido;
            $totalTasksPlano += $totalTasks;
            $concluidasPlano += $concluidas;
        }

        $progressoGeralPlano = $totalPesoPlano > 0 ? ($pesoConcluidoPlano / $totalPesoPlano) * 100 : 0;

        // Distribuição temporal simples: tasks por mês (início do plano até fim)
        $periodDistribution = $this->tasksByMonth($plano);

        return [
            'plano' => [
                'id' => $plano->id,
                'titulo' => $plano->titulo,
                'progresso_percent' => round($progressoGeralPlano, 2),
                'peso_total' => $totalPesoPlano,
                'peso_concluido' => $pesoConcluidoPlano,
                'total_tasks' => $totalTasksPlano,
                'concluidas' => $concluidasPlano,
            ],
            'pilares' => $pilaresData,
            // Dados prontos para charts:
            'charts' => [
                'labels' => collect($pilaresData)->pluck('nome'),
                'progresso_por_pilar' => collect($pilaresData)->pluck('progresso_percent'),
                'tarefas_por_pilar' => collect($pilaresData)->pluck('total_tasks'),
            ],
            'period_distribution' => $periodDistribution,
        ];
    }

    /**
     * Monta distribuição de tasks por mês para o plano (retorna labels e counts).
     */
    protected function tasksByMonth(PlanoEstrategico $plano): array
    {
        $allTasks = $plano->pilares->flatMap->tasks;

        if ($allTasks->isEmpty()) {
            return ['labels' => [], 'counts' => []];
        }

        // período entre menor data_inicio e maior data_fim das tasks / pilares
        $min = $allTasks->min(function($t){ return $t->data_inicio ? $t->data_inicio->startOfMonth() : null; }) ?? Carbon::now()->startOfMonth();
        $max = $allTasks->max(function($t){ return $t->data_fim ? $t->data_fim->endOfMonth() : null; }) ?? Carbon::now()->endOfMonth();

        $min = Carbon::parse($min)->startOfMonth();
        $max = Carbon::parse($max)->endOfMonth();

        $labels = [];
        $counts = [];

        for ($date = $min->copy(); $date->lte($max); $date->addMonth()) {
            $label = $date->format('M/Y');
            $labels[] = $label;

            $count = $allTasks->filter(function($t) use ($date) {
                // conta tasks cujo período intersecta o mês
                if (!$t->data_inicio || !$t->data_fim) return false;
                return !($t->data_fim->lt($date->copy()->startOfMonth()) || $t->data_inicio->gt($date->copy()->endOfMonth()));
            })->count();

            $counts[] = $count;
        }

        return ['labels' => $labels, 'counts' => $counts];
    }

    // Métodos CRUD opcionais para persistir indicadores podem ser adicionados aqui
}
