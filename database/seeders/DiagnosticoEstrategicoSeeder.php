<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DiagnosticoEstrategico;

class DiagnosticoEstrategicoSeeder extends Seeder
{
    public function run(): void
    {
        DiagnosticoEstrategico::create([
            'plano_estrategico_id' => 1,
            'pontos_fortes' => 'Equipe com alta qualificação e forte engajamento.',
            'pontos_fracos' => 'Processos internos ainda pouco padronizados.',
            'oportunidades' => 'Crescimento da demanda por soluções estratégicas digitais.',
            'ameacas' => 'Mudanças econômicas e tecnológicas rápidas.',
        ]);
    }
}
