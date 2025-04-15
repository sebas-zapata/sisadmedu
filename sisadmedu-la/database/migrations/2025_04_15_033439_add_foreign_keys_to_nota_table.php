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
        Schema::table('nota', function (Blueprint $table) {
            $table->foreign(['estudiantes_id_documento_estudiante'], 'fk_nota_estudiantes1')->references(['id_documento_estudiante'])->on('estudiantes')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['tema_id_tema', 'tema_materia_id_materia'], 'fk_nota_tema1')->references(['id_tema', 'materia_id_materia'])->on('tema')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nota', function (Blueprint $table) {
            $table->dropForeign('fk_nota_estudiantes1');
            $table->dropForeign('fk_nota_tema1');
        });
    }
};
