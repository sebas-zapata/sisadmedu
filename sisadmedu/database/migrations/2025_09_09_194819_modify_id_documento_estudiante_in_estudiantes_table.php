<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Paso 1: quitar AUTO_INCREMENT y PRIMARY KEY manualmente
        DB::statement('ALTER TABLE estudiantes MODIFY id_documento_estudiante BIGINT(20) NULL;');
        DB::statement('ALTER TABLE estudiantes DROP PRIMARY KEY;');

        // Paso 2: agregar nueva columna id como primary key autoincrement
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
        });
    }

    public function down(): void
    {
        Schema::table('estudiantes', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        DB::statement('ALTER TABLE estudiantes MODIFY id_documento_estudiante BIGINT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY;');
    }
};
