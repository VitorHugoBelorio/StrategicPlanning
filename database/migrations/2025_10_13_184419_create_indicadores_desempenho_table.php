<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicador_desempenhos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');

            $table->string('nome');
            $table->text('meta')->nullable();
            $table->string('resultado_atual')->nullable();
            $table->string('frequencia_avaliacao')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicador_desempenhos');
    }
};
