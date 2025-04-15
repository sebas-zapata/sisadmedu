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
        Schema::table('docentes', function (Blueprint $table) {
            $table->foreign(['grupo_id_grupo', 'grupo_grado_id_grado'], 'fk_docentes_grupo1')->references(['id_grupo', 'grado_id_grado'])->on('grupo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['sede_id_sede'], 'fk_docentes_sede1')->references(['id_sede'])->on('sede')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tipo_documento_codigo_tipo_documento'], 'fk_docentes_tipo_documento1')->references(['codigo_tipo_documento'])->on('tipo_documento')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropForeign('fk_docentes_grupo1');
            $table->dropForeign('fk_docentes_sede1');
            $table->dropForeign('fk_docentes_tipo_documento1');
        });
    }
};
