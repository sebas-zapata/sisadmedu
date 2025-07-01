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
        Schema::create('rol', function (Blueprint $table) {
            $table->integer('id_rol', true)->unique('id_rol');
            $table->enum('rol', ['ESTUDIANTE', 'DOCENTE', 'ACUDIENTE', 'RECTOR', 'ADMINISTRADOR', 'COORDINADOR'])->nullable();

            $table->primary(['id_rol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol');
    }
};
