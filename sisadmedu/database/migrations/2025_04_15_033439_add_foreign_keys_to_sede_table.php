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
        Schema::table('sede', function (Blueprint $table) {
            $table->foreign(['centro_educativo_id_centro_educativo'], 'fk_sede_centro_educativo')->references(['id_centro_educativo'])->on('centro_educativo')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sede', function (Blueprint $table) {
            $table->dropForeign('fk_sede_centro_educativo');
        });
    }
};
