<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periodo;

class PeriodoSeeder extends Seeder
{

    public function run()
    {
        $periodos = [
            ['nombre_periodo' => 'Primer Periodo', 'numero_periodo' => 1, 'fecha_inicio' => '2025-01-01', 'fecha_fin' => '2025-03-31', 'activo' => 1],
            ['nombre_periodo' => 'Segundo Periodo', 'numero_periodo' => 2, 'fecha_inicio' => '2025-04-01', 'fecha_fin' => '2025-06-30', 'activo' => 1],
            ['nombre_periodo' => 'Tercer Periodo', 'numero_periodo' => 3, 'fecha_inicio' => '2025-07-01', 'fecha_fin' => '2025-09-30', 'activo' => 1],
            ['nombre_periodo' => 'Cuarto Periodo', 'numero_periodo' => 4, 'fecha_inicio' => '2025-10-01', 'fecha_fin' => '2025-12-31', 'activo' => 1],
        ];

        foreach ($periodos as $periodo) {
            Periodo::create($periodo);
        }
    }
}
