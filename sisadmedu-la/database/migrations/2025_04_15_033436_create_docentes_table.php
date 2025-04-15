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
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigInteger('id_documento_docente', true)->unique('id_documento_docente');
            $table->bigInteger('codigo_docente')->unique('codigo_docente');
            $table->string('primer_nombre_docente')->nullable();
            $table->string('segundo_nombre_docente')->nullable();
            $table->string('primer_apellido_docente')->nullable();
            $table->string('segundo_apellido_docente')->nullable();
            $table->string('correo_electronico_docente')->nullable()->unique('correo_electronico_docente');
            $table->date('fecha_registro');
            $table->date('fecha_retiro')->nullable();
            $table->integer('tipo_documento_codigo_tipo_documento')->index('fk_docentes_tipo_documento1_idx');
            $table->integer('grupo_id_grupo');
            $table->integer('grupo_grado_id_grado');
            $table->integer('sede_id_sede')->index('fk_docentes_sede1_idx');
            $table->bigInteger('telefono_docente')->nullable();

            $table->index(['grupo_id_grupo', 'grupo_grado_id_grado'], 'fk_docentes_grupo1_idx');
            $table->primary(['id_documento_docente', 'grupo_id_grupo', 'grupo_grado_id_grado']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docentes');
    }
};
