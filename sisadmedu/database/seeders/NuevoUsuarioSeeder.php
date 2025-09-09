<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoginUsuario;
use Illuminate\Support\Facades\Hash;
class NuevoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoginUsuario::create([
            'documento' => '1038480603',
            'nombres' => 'Brandon Adrian',
            'apellidos' => 'Mercado Lambraño',
            'correo_electronico' => 'brandonadrian707@gmail.com',
            'telefono' => '3042841413',
            'contrasena' => Hash::make('brandon_adrian707'), // ¡Importante: encriptar!
            'rol_id' => 1,
            'tipo_documento_id' => 1,
        ]);
    }
}
