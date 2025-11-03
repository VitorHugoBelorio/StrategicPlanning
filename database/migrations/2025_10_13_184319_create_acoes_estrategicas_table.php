<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('acoes_estrategicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pilar_estrategico_id')->constrained('pilares_estrategicos')->onDelete('cascade');

            // Campos já existentes (mantidos para compatibilidade)
            $table->string('what')->nullable();
            $table->string('why')->nullable();
            $table->string('who')->nullable();
            $table->string('when')->nullable();
            $table->string('where')->nullable();
            $table->text('how')->nullable();
            $table->string('how_much')->nullable();

            // Novos campos esperados pelo seeder
            $table->text('descricao')->nullable();
            $table->string('responsavel')->nullable();
            $table->date('prazo')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acoes_estrategicas');
    }
};
