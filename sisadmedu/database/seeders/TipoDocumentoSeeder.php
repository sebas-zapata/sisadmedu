<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('tipos_documento')->insert([
            [
                'descripcion' => 'Cédula de Ciudadanía',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'descripcion' => 'Tarjeta de Identidad',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'descripcion' => 'Pasaporte',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'descripcion' => 'Cédula de Extranjería',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'descripcion' => 'Registro Civil',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}

