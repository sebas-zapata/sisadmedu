<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        //  Eliminar duplicados de "Cédula de Ciudadanía"
        DB::table('tipos_documento')->where('id', 1)->delete();

        //  Eliminar duplicados de "Tarjeta de Identidad"
        DB::table('tipos_documento')->where('id', 2)->delete();
    }

    public function down(): void
    {
        //  Volver a insertar en caso de rollback
        DB::table('tipos_documento')->insert([
            [
                'id' => 1,
                'descripcion' => 'Cedula de ciudadania.',
                'created_at' => null,
                'updated_at' => null,
            ],
            [
                'id' => 2,
                'descripcion' => 'Tarjeta de identidad.',
                'created_at' => '2025-08-04 12:07:59',
                'updated_at' => '2025-08-04 12:07:59',
            ],
        ]);
    }
};

