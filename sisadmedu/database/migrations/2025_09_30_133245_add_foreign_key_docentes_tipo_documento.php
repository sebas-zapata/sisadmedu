<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            // Cambiar id_tipo_documento a unsignedBigInteger para que sea compatible
            $table->unsignedBigInteger('id_tipo_documento')->change();

            // Crear la foreign key con la tabla tipos_documento
            $table->foreign('id_tipo_documento')
                  ->references('id')
                  ->on('tipos_documento')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropForeign(['id_tipo_documento']);
            // Volver a int si quieres deshacer el cambio
            $table->integer('id_tipo_documento')->change();
        });
    }
};
