<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('docentes')->insert([
            [
                'codigo_docente' => 'DOC001',
                'documento' => '1011392720',
                'primer_nombre' => 'Jairo',
                'segundo_nombre' => 'Jesus',
                'primer_apellido' => 'Zapata',
                'segundo_apellido' => 'Hincapie',
                'correo_electronico' => 'jairojesus987@.com',
                'id_materia' => 1, // Asegúrate de que exista la materia con ID 1
                'id_tipo_documento' => 1, // Asegúrate de que exista el tipo de documento con ID 1
            ],
            // Puedes agregar más docentes aquí si es necesario
        ]);
    }
}
