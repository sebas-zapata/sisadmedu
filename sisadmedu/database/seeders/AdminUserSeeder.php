<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LoginUsuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoginUsuario::create([
            'documento' => '12345678910',
            'nombres' => 'Admin',
            'apellidos' => 'Admin',
            'correo_electronico' => 'admin@example.com',
            'celular' => '3001234567',
            'contrasena' => Hash::make('admin9090'), // ¡Importante: encriptar!
            'rol_id' => 10, // Asegúrate de que exista el rol con ID 1
            'tipo_documento_id' => 3, // Asegúrate de que exista el tipo de documento con ID 1
        ]);
    }
}
