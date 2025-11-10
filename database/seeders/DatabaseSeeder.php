<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            #PlanoEstrategicoSeeder::class,
            #DiagnosticoEstrategicoSeeder::class,
            #ObjetivoEstrategicoSeeder::class,
            #PilarEstrategicoSeeder::class,
            #AcaoEstrategicaSeeder::class,
            #CronogramaSeeder::class,
            #IndicadorDesempenhoSeeder::class,
            #RiscoSeeder::class,
        ]);
    }
}