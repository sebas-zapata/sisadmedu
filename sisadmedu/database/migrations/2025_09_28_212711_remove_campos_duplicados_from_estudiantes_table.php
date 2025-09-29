<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Eliminar el índice único de correo electrónico (es el único que existe)
            $table->dropUnique('estudiantes_correo_electronico_estudiante_unique');

            // Eliminar columnas duplicadas
            $table->dropColumn([
                'documento_estudiante',
                'celular_estudiante',
                'correo_electronico_estudiante',
            ]);
        });
    }

    public function down()
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Restaurar columnas eliminadas
            $table->bigInteger('documento_estudiante')->nullable();
            $table->string('celular_estudiante')->nullable();
            $table->string('correo_electronico_estudiante', 255)->unique()->nullable();
        });
    }
};
