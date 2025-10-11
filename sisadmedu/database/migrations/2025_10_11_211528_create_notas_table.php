<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('asignacion_id'); // materia + grado + docente
            $table->unsignedBigInteger('periodo_id');
            $table->decimal('promedio', 5, 2)->nullable();
            $table->timestamps();

            // Relaciones
            $table->foreign('estudiante_id')->references('id')->on('estudiantes')->onDelete('cascade');
            $table->foreign('asignacion_id')->references('id')->on('asignaciones')->onDelete('cascade');
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
