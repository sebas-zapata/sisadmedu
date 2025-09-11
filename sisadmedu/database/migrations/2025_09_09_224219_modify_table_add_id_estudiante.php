<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Quitar AUTO_INCREMENT del campo actual
        DB::statement('ALTER TABLE estudiantes MODIFY documento_estudiante BIGINT UNSIGNED NOT NULL;');

        // 2. Quitar la primary key de codigo
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropPrimary();
        });

        // 3. Agregar el nuevo campo id_estudiante como AUTO_INCREMENT + PK
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id_estudiante')->first();
        });
    }

    public function down(): void
    {
        // 1. Eliminar el nuevo campo
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropColumn('id_estudiante');
        });

        // 2. Restaurar codigo como PK + AUTO_INCREMENT
        DB::statement('ALTER TABLE estudiantes MODIFY documento_estudiante BIGINT UNSIGNED NOT NULL AUTO_INCREMENT;');

        Schema::table('estudiantes', function (Blueprint $table) {
            $table->primary('documento_estudiante');
        });
    }
};
