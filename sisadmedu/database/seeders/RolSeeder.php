<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Administrador',
            'Rector',
            'Coordinador',
            'Secretaria',
            'Acudiente',
            'Docente',
            'Estudiante', // nuevo rol
        ];

        foreach ($roles as $rol) {
            Rol::firstOrCreate(['nombre' => $rol]);
        }
    }
}
