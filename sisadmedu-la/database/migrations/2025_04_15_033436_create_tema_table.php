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
        Schema::create('tema', function (Blueprint $table) {
            $table->integer('id_tema', true)->unique('id_tema');
            $table->string('descripcion_tema')->nullable();
            $table->integer('materia_id_materia')->index('fk_tema_materia1_idx');

            $table->primary(['id_tema', 'materia_id_materia']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema');
    }
};
