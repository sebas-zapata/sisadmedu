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
        Schema::create('grupo', function (Blueprint $table) {
            $table->integer('id_grupo', true);
            $table->string('nombre_grupo');
            $table->dateTime('fecha_registro')->nullable()->useCurrent();
            $table->integer('grado_id_grado');
            $table->integer('grado_sede_id_sede');

            $table->index(['grado_id_grado', 'grado_sede_id_sede'], 'fk_grupo_grado1_idx');
            $table->primary(['id_grupo', 'grado_id_grado', 'grado_sede_id_sede']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo');
    }
};
