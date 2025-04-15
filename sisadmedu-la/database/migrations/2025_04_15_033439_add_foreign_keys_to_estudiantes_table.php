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
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->foreign(['acudientes_id_documento_acudiente'], 'fk_estudiantes_acudientes1')->references(['id_documento_acudiente'])->on('acudientes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['grupo_id_grupo', 'grupo_grado_id_grado', 'grupo_grado_sede_id_sede'], 'fk_estudiantes_grupo1')->references(['id_grupo', 'grado_id_grado', 'grado_sede_id_sede'])->on('grupo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tipo_documento_codigo_tipo_documento'], 'fk_estudiantes_tipo_documento1')->references(['codigo_tipo_documento'])->on('tipo_documento')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropForeign('fk_estudiantes_acudientes1');
            $table->dropForeign('fk_estudiantes_grupo1');
            $table->dropForeign('fk_estudiantes_tipo_documento1');
        });
    }
};
