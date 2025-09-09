<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Renombrar la columna
            $table->renameColumn('id_documento_estudiante', 'documento_estudiante');
        });

        Schema::table('estudiantes', function (Blueprint $table) {
            // Asegurarse de que el campo sea único
            $table->bigInteger('documento_estudiante')->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Quitar restricción única y volver al nombre anterior
            $table->dropUnique(['documento_estudiante']);
            $table->renameColumn('documento_estudiante', 'id_documento_estudiante');
        });
    }
};
