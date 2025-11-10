<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PilarEstrategico;

class PilarEstrategicoSeeder extends Seeder
{
    public function run(): void
    {
        $pilares = [
            ['plano_estrategico_id' => 1, 'nome' => 'Gestão e Governança'],
            ['plano_estrategico_id' => 1, 'nome' => 'Desenvolvimento Humano'],
            ['plano_estrategico_id' => 1, 'nome' => 'Inovação e Tecnologia'],
        ];

        foreach ($pilares as $p) {
            PilarEstrategico::create($p);
        }
    }
}
