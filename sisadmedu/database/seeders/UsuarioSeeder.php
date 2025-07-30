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
            'documento' => '123456789',
            'nombres' => 'Sebastián',
            'apellidos' => 'Zapata',
            'correo_electronico' => 'admin@example.com',
            'telefono' => '3001234567',
            'contrasena' => Hash::make('password123'), // ¡Importante: encriptar!
            'rol_id' => 1, // Asegúrate de que exista el rol con ID 1
        ]);
    }
}
