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
        Schema::create('grado', function (Blueprint $table) {
            $table->integer('id_grado', true);
            $table->string('nombre_grado');
            $table->integer('sede_id_sede')->index('fk_grado_sede1_idx');

            $table->primary(['id_grado', 'sede_id_sede']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado');
    }
};
