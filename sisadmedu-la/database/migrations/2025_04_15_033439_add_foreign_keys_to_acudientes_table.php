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
        Schema::table('acudientes', function (Blueprint $table) {
            $table->foreign(['tipo_documento_codigo_tipo_documento'], 'fk_acudientes_tipo_documento1')->references(['codigo_tipo_documento'])->on('tipo_documento')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acudientes', function (Blueprint $table) {
            $table->dropForeign('fk_acudientes_tipo_documento1');
        });
    }
};
