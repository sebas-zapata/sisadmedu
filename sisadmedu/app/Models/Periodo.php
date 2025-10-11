<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nota;

class Periodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_periodo',
        'numero_periodo',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];

    // Un periodo puede tener muchas notas
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
