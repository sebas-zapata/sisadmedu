<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('acudiente_estudiante', function (Blueprint $table) {
            $table->id();

            // Relacion con la tabla usuarios (acudientes)
            $table->unsignedBigInteger('acudiente_id');
            $table->foreign('acudiente_id')
                  ->references('id')->on('usuarios')
                  ->onDelete('cascade');

            // Relacion con la tabla estudiantes
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')
                  ->references('id')->on('estudiantes')
                  ->onDelete('cascade');

            $table->timestamps();

            // Evitar duplicados (un acudiente no se repita con el mismo estudiante)
            $table->unique(['acudiente_id', 'estudiante_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acudiente_estudiante');
    }
};

