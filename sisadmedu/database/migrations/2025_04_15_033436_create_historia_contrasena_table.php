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
        Schema::create('historia_contrasena', function (Blueprint $table) {
            $table->integer('id_historia_contrasena', true);
            $table->string('historia_contrasena');
            $table->integer('usuarios_id_usuario');
            $table->integer('usuarios_rol_id_rol');

            $table->index(['usuarios_id_usuario', 'usuarios_rol_id_rol'], 'fk_historia_contrasena_usuarios1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historia_contrasena');
    }
};
