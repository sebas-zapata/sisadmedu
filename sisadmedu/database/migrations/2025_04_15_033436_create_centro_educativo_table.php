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
        Schema::create('centro_educativo', function (Blueprint $table) {
            $table->integer('id_centro_educativo', true);
            $table->string('nombre_centro_educativo');
            $table->string('direccion_centro_educativo');
            $table->string('telefono_centro_educativo', 20)->unique('telefono_centro_educativo_index');
            $table->string('correo_electronico_centro_educativo')->unique('correo_electronico_centro_educativo_index');
            $table->string('sector_centro_educativo');
            $table->date('fecha_registro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_educativo');
    }
};
