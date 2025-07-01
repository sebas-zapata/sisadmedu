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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreign(['grupo_id_grupo'], 'fk_usuarios_grupo1')->references(['id_grupo'])->on('grupo')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['rol_id_rol1'], 'fk_usuarios_rol1')->references(['id_rol'])->on('rol')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tipo_documento_codigo_tipo_documento'], 'fk_usuarios_tipo_documento1')->references(['codigo_tipo_documento'])->on('tipo_documento')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign('fk_usuarios_grupo1');
            $table->dropForeign('fk_usuarios_rol1');
            $table->dropForeign('fk_usuarios_tipo_documento1');
        });
    }
};
