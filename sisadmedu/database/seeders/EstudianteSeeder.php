<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstudianteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Estudiante::create([
            'id_documento_estudiante' => '123456789',
            'codigo_estudiante' => 'EST001',
            'primer_nombre_estudiante' => 'Juan',
            'segundo_nombre_estudiante' => 'Carlos',
            'primer_apellido_estudiante' => 'Pérez',
            'segundo_apellido_estudiante' => 'López',
            'edad_estudiante' => 20,
            'fecha_nacimiento_estudiante' => '2005-05-15',
            'celular_estudiante' => '3001234567',
            'telefono_estudiante' => '1234567',
            'correo_electronico_estudiante' => 'juan.perez@example.com',
            'direccion_estudiante' => 'Calle Falsa 123',
            'id_grado' => 1,
            'id_tipo_documento' => 1,
        ]);
    }
}
