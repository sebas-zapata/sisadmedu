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
        Schema::table('grados', function (Blueprint $table) {
            // Agregar columnas nivel y grupo
            $table->unsignedInteger('nivel_grado')->after('id');
            $table->unsignedInteger('grupo_grado')->after('nivel_grado');

            // Eliminar el nombre_grado actual para reemplazarlo por uno generado
            $table->dropColumn('nombre_grado');

            // Crear nombre_grado generado automáticamente (nivel-grupo)
            $table->string('nombre_grado')->virtualAs("CONCAT(nivel_grado, '-', grupo_grado)");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grados', function (Blueprint $table) {
            $table->dropColumn(['nivel_grado', 'grupo_grado', 'nombre_grado']);
            $table->string('nombre_grado')->unique();
        });
    }
};
