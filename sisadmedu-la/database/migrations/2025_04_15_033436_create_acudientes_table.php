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
        Schema::create('acudientes', function (Blueprint $table) {
            $table->bigInteger('id_documento_acudiente', true);
            $table->bigInteger('codigo_acudiente')->unique('codigo_acudiente_index');
            $table->string('primer_nombre_acudiente')->nullable();
            $table->string('segundo_nombre_acudiente')->nullable();
            $table->string('primer_apellido_acudiente')->nullable();
            $table->string('segundo_apellido_acudiente')->nullable();
            $table->string('celular_acudiente', 50)->nullable()->unique('celular_acudiente_index');
            $table->string('telefono_acudiente', 50)->nullable()->unique('telefono_acudiente_index');
            $table->string('direccion_acudiente')->nullable()->unique('direccion_acudiente_index');
            $table->string('correo_electronico')->nullable()->unique('correo_electronico');
            $table->date('fecha_registro');
            $table->date('fecha_retiro');
            $table->integer('tipo_documento_codigo_tipo_documento')->index('fk_acudientes_tipo_documento1_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acudientes');
    }
};
