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
        Schema::create('estudiantes', function (Blueprint $table) {
        $table->id('id_documento_estudiante');
        $table->string('codigo_estudiante')->unique();
        $table->string('primer_nombre_estudiante');
        $table->string('segundo_nombre_estudiante')->nullable();
        $table->string('primer_apellido_estudiante');
        $table->string('segundo_apellido_estudiante')->nullable();
        $table->unsignedTinyInteger('edad_estudiante');
        $table->date('fecha_nacimiento_estudiante');
        $table->string('celular_estudiante')->nullable();
        $table->string('telefono_estudiante')->nullable();
        $table->string('correo_electronico_estudiante')->unique();
        $table->string('direccion_estudiante');
        $table->unsignedBigInteger('id_grado');
        $table->timestamps();

        $table->foreign('id_grado')->references('id')->on('grados')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
