<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('planos_estrategicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('area_interesse');
            $table->text('objetivo_geral');
            $table->integer('prazo_meses')->default(6);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planos_estrategicos');
    }
};
