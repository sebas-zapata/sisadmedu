<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('estudiante_id')
                  ->constrained('estudiantes')
                  ->onDelete('cascade');
            $table->foreignId('asignacion_id')
                  ->constrained('asignaciones')
                  ->onDelete('cascade');
            $table->date('fecha');
            $table->enum('estado', ['presente', 'ausente', 'tarde', 'excusa'])
                  ->default('presente');
            $table->text('observacion')->nullable();
            $table->timestamps();

            // Evita duplicar registros del mismo estudiante el mismo día en la misma clase
            $table->unique(['estudiante_id', 'asignacion_id', 'fecha']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
