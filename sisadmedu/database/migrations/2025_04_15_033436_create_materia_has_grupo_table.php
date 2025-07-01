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
        Schema::create('materia_has_grupo', function (Blueprint $table) {
            $table->integer('materia_id_materia');
            $table->bigInteger('materia_docentes_id_documento_docente');
            $table->integer('grupo_id_grupo');
            $table->integer('grupo_grado_id_grado');

            $table->index(['grupo_id_grupo', 'grupo_grado_id_grado'], 'fk_materia_has_grupo_grupo1_idx');
            $table->index(['materia_id_materia', 'materia_docentes_id_documento_docente'], 'fk_materia_has_grupo_materia1_idx');
            $table->primary(['materia_id_materia', 'materia_docentes_id_documento_docente', 'grupo_id_grupo', 'grupo_grado_id_grado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materia_has_grupo');
    }
};
