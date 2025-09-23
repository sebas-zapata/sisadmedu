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
        Schema::table('observaciones', function (Blueprint $table) {
            // Eliminar la columna 'fecha'
            $table->dropColumn('fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('observaciones', function (Blueprint $table) {
            // Volver a agregar la columna 'fecha' si es necesario
            $table->date('fecha')->nullable();
        });
    }
};
