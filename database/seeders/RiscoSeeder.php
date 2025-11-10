<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Risco;

class RiscoSeeder extends Seeder
{
    public function run(): void
    {
        Risco::create([
            'plano_estrategico_id' => 1,
            'descricao' => 'Rotatividade de pessoal pode afetar continuidade das ações.',
            'probabilidade' => 'Alta',
            'impacto' => 'Médio',
            'estrategia_mitigacao' => 'Implementar plano de retenção e valorização profissional.',
        ]);

        Risco::create([
            'plano_estrategico_id' => 1,
            'descricao' => 'Mudanças orçamentárias podem comprometer a execução do plano.',
            'probabilidade' => 'Média',
            'impacto' => 'Alto',
            'estrategia_mitigacao' => 'Prever reserva financeira e priorizar ações críticas.',
        ]);
    }
}
