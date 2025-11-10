<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cronograma;

class CronogramaSeeder extends Seeder
{
    public function run(): void
    {
        Cronograma::create([
            'plano_estrategico_id' => 1,
            'atividade' => 'Diagnóstico e planejamento detalhado',
            'responsavel' => 'Gerente de Planejamento',
            'data_inicio' => '2025-01-10',
            'data_fim' => '2025-03-15',
            'status' => 'Concluído',
        ]);

        Cronograma::create([
            'plano_estrategico_id' => 1,
            'atividade' => 'Implementação das ações estratégicas',
            'responsavel' => 'Diretoria Executiva',
            'data_inicio' => '2025-04-01',
            'data_fim' => '2026-12-31',
            'status' => 'Em andamento',
        ]);
    }
}
