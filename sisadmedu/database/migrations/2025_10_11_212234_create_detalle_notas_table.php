<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_notas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nota_id');
            $table->string('descripcion')->nullable(); // Ejemplo: "Taller 1", "Examen", "Participación"
            $table->decimal('valor', 5, 2);
            $table->timestamps();

            // Relaciones
            $table->foreign('nota_id')->references('id')->on('notas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_notas');
    }
};
