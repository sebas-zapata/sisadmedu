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
        Schema::table('docentes', function (Blueprint $table) {
            $table->date('fecha_nacimiento')->nullable()->after('segundo_apellido'); // Fecha de nacimiento
            $table->string('telefono', 20)->nullable()->after('fecha_nacimiento');   // Teléfono de contacto
            $table->string('direccion', 255)->nullable()->after('telefono');         // Dirección
            $table->string('estado_civil', 50)->nullable()->after('direccion');      // Estado civil
            $table->string('especializacion', 255)->nullable()->after('estado_civil'); // Especialización
            $table->integer('anios_experiencia')->nullable()->after('especializacion'); // Años de experiencia
            $table->date('fecha_ingreso')->nullable()->after('anios_experiencia');   // Fecha de ingreso
            $table->enum('tipo_contrato', ['Planta', 'Catedrático', 'Temporal'])->default('Planta')->after('fecha_ingreso'); // Tipo de contrato
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_nacimiento',
                'telefono',
                'direccion',
                'estado_civil',
                'especializacion',
                'anios_experiencia',
                'fecha_ingreso',
                'tipo_contrato'
            ]);
        });
    }
};

