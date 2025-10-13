<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('objetivos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');
            $table->text('descricao');
            $table->text('especifico')->nullable();
            $table->text('mensuravel')->nullable();
            $table->text('atingivel')->nullable();
            $table->text('relevante')->nullable();
            $table->text('tempo_definido')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('objetivos_estrategicos');
    }
};

