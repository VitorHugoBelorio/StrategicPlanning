<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IndicadorDesempenho;

class IndicadorDesempenhoSeeder extends Seeder
{
    public function run(): void
    {
        IndicadorDesempenho::create([
            'plano_estrategico_id' => 1,
            'nome' => 'Taxa de Execução das Ações',
            'meta' => 'Concluir 90% das ações até o final de 2026.',
            'resultado_atual' => '45%',
            'frequencia_avaliacao' => 'Semestral',
        ]);

        IndicadorDesempenho::create([
            'plano_estrategico_id' => 1,
            'nome' => 'Satisfação dos Colaboradores',
            'meta' => 'Alcançar índice de 85% de satisfação.',
            'resultado_atual' => '73%',
            'frequencia_avaliacao' => 'Anual',
        ]);
    }
}
