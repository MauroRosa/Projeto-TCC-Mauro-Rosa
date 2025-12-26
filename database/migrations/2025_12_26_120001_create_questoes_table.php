<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionario_id')->constrained('questionarios')->onDelete('cascade');
            $table->text('enunciado');
            $table->string('imagem_url')->nullable();
            $table->text('alternativa_a');
            $table->text('alternativa_b');
            $table->text('alternativa_c');
            $table->text('alternativa_d');
            $table->text('alternativa_e');
            $table->char('resposta_correta', 1); // A, B, C, D ou E
            $table->string('conteudo_linguistico');
            $table->integer('ordem')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questoes');
    }
};