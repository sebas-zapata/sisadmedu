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
        Schema::create('sede', function (Blueprint $table) {
            $table->integer('id_sede', true);
            $table->string('nombre_sede');
            $table->string('direccion_sede');
            $table->string('telefono_sede', 20)->unique('telefono_sede_index');
            $table->string('correo_electronico_sede')->unique('correo_electronico_sede_index');
            $table->string('sector_sede');
            $table->integer('centro_educativo_id_centro_educativo')->index('fk_sede_centro_educativo_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sede');
    }
};
