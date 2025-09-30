<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Primero nos aseguramos de que no exista ya una FK
            if (Schema::hasColumn('usuarios', 'tipo_documento_id')) {
                $table->foreign('tipo_documento_id')
                      ->references('id')
                      ->on('tipos_documento') // <- aquí el nombre correcto
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['tipo_documento_id']);
        });
    }
};
