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
        Schema::create('asistencia', function (Blueprint $table) {
            $table->integer('id_asistencia', true)->unique('id_asistencia');
            $table->string('lunes', 3)->nullable();
            $table->string('martes', 3)->nullable();
            $table->string('miercoles', 3)->nullable();
            $table->string('jueves', 3)->nullable();
            $table->string('viernes', 3)->nullable();
            $table->bigInteger('estudiantes_id_documento_estudiante')->index('fk_asistencia_estudiantes1_idx');

            $table->primary(['id_asistencia', 'estudiantes_id_documento_estudiante']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};
