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
            // Eliminar el campo codigo_docente
            $table->dropColumn('codigo_docente');

            // Cambiar tipo de dato del campo documento
            $table->bigInteger('documento')->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            // Restaurar el campo eliminado
            $table->string('codigo_docente')->unique();

            // Volver el campo documento a varchar(255)
            $table->string('documento')->nullable()->change();
        });
    }
};
