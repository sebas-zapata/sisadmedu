<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // eliminar un rol específico
            DB::table('roles')->where('nombre', 'Invitado')->delete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {

            DB::table('roles')->insert([
                'nombre' => 'Invitado',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
};
