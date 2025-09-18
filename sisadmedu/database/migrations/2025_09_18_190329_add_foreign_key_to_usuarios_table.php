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
        Schema::table('usuarios', function (Blueprint $table) {
            $table->integer('rol_id')->change();
            // Crear la llave foránea
            $table->foreign('rol_id')
                ->references('id')  // Columna en la tabla roles
                ->on('roles')           // Tabla roles
                ->onDelete('cascade');  // Opcional: si borras el rol, borra el usuario

        });
    }

    /**x|
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            // Eliminar la llave foránea
            $table->dropForeign(['rol_id']);
            // Eliminar la llave foránea
            $table->dropForeign(['rol_id']);
        });
    }
};
