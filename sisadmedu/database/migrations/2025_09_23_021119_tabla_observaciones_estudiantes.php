<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('observaciones', function (Blueprint $table) {
            $table->id();
            
            // Relación con estudiante
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')
                  ->references('id')->on('estudiantes')
                  ->onDelete('cascade');

            // Relación con docente
            $table->unsignedBigInteger('docente_id');
            $table->foreign('docente_id')
                  ->references('id')->on('docentes')
                  ->onDelete('cascade');

            // Campos de la observación
            $table->enum('tipo', ['academica', 'comportamental', 'otra'])->default('academica');
            $table->text('descripcion');
            $table->date('fecha')->default(now());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observaciones');
    }
};

