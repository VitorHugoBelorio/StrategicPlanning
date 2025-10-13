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
            $table->string('what');
            $table->string('why');
            $table->string('who')->nullable();
            $table->string('when')->nullable();
            $table->string('where')->nullable();
            $table->text('how')->nullable();
            $table->string('how_much')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acoes_estrategicas');
    }
};
