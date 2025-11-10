<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObjetivoEstrategico;

class ObjetivoEstrategicoSeeder extends Seeder
{
    public function run(): void
    {
        ObjetivoEstrategico::create([
            'plano_estrategico_id' => 1,
            'descricao' => 'Melhorar a eficiência organizacional em 30% até o final de 2026.',
            'especifico' => 'Revisar e otimizar processos internos.',
            'mensuravel' => 'Acompanhar indicadores de produtividade e retrabalho.',
            'atingivel' => 'Através de treinamentos e implementação de ferramentas digitais.',
            'relevante' => 'Contribui diretamente para a sustentabilidade da instituição.',
            'tempo_definido' => 'Janeiro de 2025 a Dezembro de 2026.',
        ]);
    }
}
