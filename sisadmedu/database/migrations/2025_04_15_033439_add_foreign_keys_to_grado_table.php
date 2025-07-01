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
        Schema::table('grado', function (Blueprint $table) {
            $table->foreign(['sede_id_sede'], 'fk_grado_sede1')->references(['id_sede'])->on('sede')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('grado', function (Blueprint $table) {
            $table->dropForeign('fk_grado_sede1');
        });
    }
};
