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
        Schema::create('nota', function (Blueprint $table) {
            $table->smallInteger('id_nota', true)->unique('id_nota');
            $table->float('nota')->nullable();
            $table->integer('tema_id_tema');
            $table->integer('tema_materia_id_materia');
            $table->bigInteger('estudiantes_id_documento_estudiante')->index('fk_nota_estudiantes1_idx');

            $table->index(['tema_id_tema', 'tema_materia_id_materia'], 'fk_nota_tema1_idx');
            $table->primary(['id_nota', 'tema_id_tema', 'tema_materia_id_materia', 'estudiantes_id_documento_estudiante']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota');
    }
};
