<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanoEstrategico;

class PlanoEstrategicoSeeder extends Seeder
{
    public function run(): void
    {
        PlanoEstrategico::create([
            'user_id' => 1,
            'titulo' => 'Plano Estratégico 2025-2026 - Desenvolvimento Organizacional',
            'visao' => 'Ser referência em planejamento e execução estratégica no setor público e privado.',
            'missao' => 'Apoiar organizações na definição de metas e ações que promovam crescimento sustentável.',
            'valores' => 'Ética, Inovação, Transparência e Comprometimento.',
        ]);
    }
}
