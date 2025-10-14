<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('diagnosticos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planos_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');
            $table->text('missao');
            $table->text('visao');
            $table->json('forcas')->nullable();
            $table->json('fraquezas')->nullable();
            $table->json('oportunidades')->nullable();
            $table->json('ameacas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosticos_estrategicos');
    }
};
