<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota_id',
        'nombre_detalle', // Ej: "Taller 1", "Parcial", "Examen Final"
        'valor',           // Ej: 4.2
    ];

    /**
     * 🔹 Relación con la nota principal
     */
    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }
}
