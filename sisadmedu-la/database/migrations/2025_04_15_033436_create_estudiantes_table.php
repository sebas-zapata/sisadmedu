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
            $table->bigInteger('id_documento_estudiante', true)->unique('id_documento_estudiante');
            $table->bigInteger('codigo_estudiante')->unique('codigo_estudiante');
            $table->string('primer_nombre_estudiante')->nullable();
            $table->string('segundo_nombre_estudiante')->nullable();
            $table->string('primer_apellido_estudiante')->nullable();
            $table->string('segundo_apellido_estudiante')->nullable();
            $table->integer('edad_estudiante')->nullable();
            $table->date('fecha_nacimiento_estudiante')->nullable();
            $table->string('celular_estudiante', 50)->nullable()->unique('celular_estudiante');
            $table->string('telefono_estudiante', 50)->nullable()->unique('telefono_estudiante');
            $table->string('correo_electronico_estudiante')->nullable()->unique('correo_electronico_estudiante');
            $table->string('direccion_estudiante')->nullable();
            $table->date('fecha_matricula');
            $table->date('fecha_retiro')->nullable();
            $table->bigInteger('acudientes_id_documento_acudiente')->index('fk_estudiantes_acudientes1_idx');
            $table->integer('tipo_documento_codigo_tipo_documento')->index('fk_estudiantes_tipo_documento1_idx');
            $table->integer('grupo_id_grupo');
            $table->integer('grupo_grado_id_grado');
            $table->integer('grupo_grado_sede_id_sede');

            $table->index(['grupo_id_grupo', 'grupo_grado_id_grado', 'grupo_grado_sede_id_sede'], 'fk_estudiantes_grupo1_idx');
            $table->primary(['id_documento_estudiante', 'grupo_id_grupo', 'grupo_grado_id_grado', 'grupo_grado_sede_id_sede']);
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
