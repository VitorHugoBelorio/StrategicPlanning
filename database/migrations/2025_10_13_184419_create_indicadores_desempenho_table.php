<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('indicadores_desempenho', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planos_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');
            $table->string('nome');
            $table->string('meta')->nullable();
            $table->string('valor_atual')->nullable();
            $table->string('unidade')->nullable();
            $table->enum('status', ['em_andamento', 'atingido', 'não_atingido'])->default('em_andamento');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('indicadores_desempenho');
    }
};
