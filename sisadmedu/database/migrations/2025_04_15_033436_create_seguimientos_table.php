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
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->integer('id_seguimiento', true)->unique('id_seguimiento');
            $table->string('descripcion_seguimiento');
            $table->date('fecha_seguimiento');
            $table->bigInteger('estudiantes_id_documento_estudiante')->index('fk_seguimientos_estudiantes1_idx');

            $table->primary(['id_seguimiento', 'estudiantes_id_documento_estudiante']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
