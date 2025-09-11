<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LoginUsuario;
use Illuminate\Support\Facades\Hash;

class OtroUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoginUsuario::create([
            'documento' => '1033278272',
            'nombres' => 'Brandon',
            'apellidos' => 'Mercado',
            'correo_electronico' => 'brandonadri03@gmail.com',
            'telefono' => '3224976331',
            'contrasena' => Hash::make('brandon123'), // encriptada
            'rol_id' => 2,
            'tipo_documento_id' => 1,
        ]);
    }
}
