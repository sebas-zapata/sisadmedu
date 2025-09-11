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
            // Renombrar la columna id_estudiante a id
            $table->renameColumn('id_estudiante', 'id');
        });

        Schema::table('estudiantes', function (Blueprint $table) {
            // Asegurar que sea BIGINT UNSIGNED (equivalente a BIGINT(20))
            $table->unsignedBigInteger('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            // Revertir: volver a id_estudiante
            $table->renameColumn('id', 'id_estudiante');
        });

        Schema::table('estudiantes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_estudiante')->change();
        });
    }
};
