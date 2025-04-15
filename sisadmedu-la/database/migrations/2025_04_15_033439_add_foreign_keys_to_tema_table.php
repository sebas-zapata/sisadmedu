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
        Schema::table('tema', function (Blueprint $table) {
            $table->foreign(['materia_id_materia'], 'fk_tema_materia1')->references(['id_materia'])->on('materia')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tema', function (Blueprint $table) {
            $table->dropForeign('fk_tema_materia1');
        });
    }
};
