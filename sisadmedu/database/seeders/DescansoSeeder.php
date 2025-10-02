<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Descanso;

class DescansoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Descanso::create([
            'hora_inicio' => '09:15',
            'hora_fin' => '09:45',
        ]);
    }
}
