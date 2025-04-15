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
        Schema::create('materia', function (Blueprint $table) {
            $table->integer('id_materia', true)->unique('id_materia');
            $table->string('descripcion_materia')->unique('descripcion_materia');
            $table->bigInteger('docentes_id_documento_docente')->index('fk_materia_docentes1_idx');

            $table->primary(['id_materia', 'docentes_id_documento_docente']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia');
    }
};
