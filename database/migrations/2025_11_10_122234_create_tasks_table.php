<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pilar_estrategico_id')
                  ->constrained('pilares_estrategicos')
                  ->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->enum('status', [
                'pendente',
                'em_andamento',
                'concluida',
                'cancelada'
            ])->default('pendente');
            $table->enum('prioridade', ['baixa', 'media', 'alta'])
                  ->default('media');
            $table->datetime('data_inicio');
            $table->datetime('data_fim');
            $table->foreignId('responsavel_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};