<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cronogramas', function (Blueprint $table) {
            $table->id();
            // Corrigido para o nome esperado pelo seeder
            $table->foreignId('plano_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');

            // Campos originais mantidos, agora opcionais
            $table->integer('mes')->nullable();
            $table->text('descricao')->nullable();

            // Campos esperados pelo seeder
            $table->text('atividade')->nullable();
            $table->string('responsavel')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cronogramas');
    }
};
