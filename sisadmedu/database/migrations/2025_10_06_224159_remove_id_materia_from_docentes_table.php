<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->dropForeign(['id_materia']); // si existe una FK
            $table->dropColumn('id_materia');
        });
    }

    public function down()
    {
        Schema::table('docentes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_materia')->nullable();
            $table->foreign('id_materia')->references('id')->on('materias');
        });
    }
};
