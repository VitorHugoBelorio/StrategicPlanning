<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('diagnosticos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plano_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');
            $table->text('pontos_fortes')->nullable();
            $table->text('pontos_fracos')->nullable();
            $table->text('oportunidades')->nullable();
            $table->text('ameacas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('diagnosticos_estrategicos');
    }
};
