<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
        DB::table('roles')->where('nombre', 'Coordinador')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        DB::table('roles')->insert([
            'nombre' => 'Coordinador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
