<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pilares_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_estrategico_id')
                  ->constrained('planos_estrategicos')
                  ->onDelete('cascade');
            $table->string('nome');
            $table->text('objetivo');
            $table->text('meta');
            $table->string('indicador');
            $table->datetime('data_inicio');
            $table->datetime('data_fim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pilares_estrategicos');
    }
};
