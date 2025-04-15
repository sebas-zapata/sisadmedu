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
        Schema::table('materia_has_grupo', function (Blueprint $table) {
            $table->foreign(['grupo_id_grupo', 'grupo_grado_id_grado'], 'fk_materia_has_grupo_grupo1')->references(['id_grupo', 'grado_id_grado'])->on('grupo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['materia_id_materia', 'materia_docentes_id_documento_docente'], 'fk_materia_has_grupo_materia1')->references(['id_materia', 'docentes_id_documento_docente'])->on('materia')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materia_has_grupo', function (Blueprint $table) {
            $table->dropForeign('fk_materia_has_grupo_grupo1');
            $table->dropForeign('fk_materia_has_grupo_materia1');
        });
    }
};
