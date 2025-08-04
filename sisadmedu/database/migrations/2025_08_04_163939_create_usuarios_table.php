<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID principal autoincremental (bigint unsigned)
            $table->string('documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('correo_electronico')->unique();
            $table->string('telefono')->nullable();
            $table->string('contrasena');

            // Relaciones
            $table->Integer('rol_id');
            $table->unsignedBigInteger('tipo_documento_id');

            // Claves foráneas
            $table->foreign('rol_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade'); // o restrict/nullOnDelete según lo que necesites

            $table->foreign('tipo_documento_id')
                  ->references('id')->on('tipos_documento')
                  ->onDelete('cascade'); // o cascade/nullOnDelete según lógica

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

