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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id_usuario', true)->unique('id_usuario');
            $table->integer('documento_usuario')->nullable()->unique('documento_usuario');
            $table->string('nombres_usuario')->nullable();
            $table->string('apellidos_usuario')->nullable();
            $table->string('telefono_usuario', 15)->nullable()->unique('telefono_usuario');
            $table->string('contrasena_usuario')->nullable();
            $table->timestamp('fecha_registro')->useCurrent();
            $table->integer('rol_id_rol');
            $table->integer('tipo_documento_codigo_tipo_documento')->index('fk_usuarios_tipo_documento1_idx');
            $table->integer('grupo_id_grupo')->index('fk_usuarios_grupo1_idx');
            $table->integer('rol_id_rol1')->index('fk_usuarios_rol1_idx');
            $table->integer('id_rol')->nullable();
            $table->string('correo_electronico_usuario')->nullable();

            $table->primary(['id_usuario', 'rol_id_rol', 'grupo_id_grupo', 'rol_id_rol1']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
