<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcaoEstrategica;

class AcaoEstrategicaSeeder extends Seeder
{
    public function run(): void
    {
        AcaoEstrategica::create([
            'pilar_estrategico_id' => 1,
            'descricao' => 'Implantar sistema de monitoramento de desempenho institucional.',
            'responsavel' => 'Departamento de Planejamento',
            'prazo' => '2025-09-30',
        ]);

        AcaoEstrategica::create([
            'pilar_estrategico_id' => 2,
            'descricao' => 'Capacitar 100% da equipe em metodologias ágeis.',
            'responsavel' => 'Setor de Recursos Humanos',
            'prazo' => '2025-12-15',
        ]);
    }
}
