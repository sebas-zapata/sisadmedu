<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('historia_contrasena', function (Blueprint $table) {
            $table->foreign(['usuarios_id_usuario'], 'fk_historia_contrasena_usuarios1')->references(['id_usuario'])->on('usuarios')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historia_contrasena', function (Blueprint $table) {
            $table->dropForeign('fk_historia_contrasena_usuarios1');
        });
    }
};
