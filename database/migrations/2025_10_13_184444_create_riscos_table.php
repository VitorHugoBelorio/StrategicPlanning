<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('riscos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planos_estrategico_id')->constrained('planos_estrategicos')->onDelete('cascade');
            $table->text('descricao');
            $table->text('plano_contingencia')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riscos');
    }
};
