<?php

namespace Database\Seeders;

use App\Models\LoginUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsuarioSeeder extends Seeder
{

    // Registra un usuario administrador por defecto
    public function run(): void
    {
            LoginUsuario::create([
            'documento' => '1011392720',
            'nombres' => 'Juan Sebastian',
            'apellidos' => 'Zapata Suarez',
            'correo_electronico' => 'zapatajuan351@gmail.com',
            'telefono' => '3225550261',
            'contrasena' => Hash::make('1011392720'), // ¡Importante: encriptar!
            'rol_id' => 1, // Asegúrate de que exista el rol con ID 1
            'tipo_documento_id' => 1, // Asegúrate de que exista el tipo de documento con ID 1
        ]);
    }
}
