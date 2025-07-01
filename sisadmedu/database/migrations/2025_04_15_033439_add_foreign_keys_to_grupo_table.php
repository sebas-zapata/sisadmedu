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
        Schema::table('grupo', function (Blueprint $table) {
            $table->foreign(['grado_id_grado', 'grado_sede_id_sede'], 'fk_grupo_grado1')->references(['id_grado', 'sede_id_sede'])->on('grado')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grupo', function (Blueprint $table) {
            $table->dropForeign('fk_grupo_grado1');
        });
    }
};
