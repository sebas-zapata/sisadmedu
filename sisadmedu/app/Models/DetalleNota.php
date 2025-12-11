<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleNota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota_id',
        'actividad_id',
        'descripcion',
        'valor',
    ];


    public function nota()
    {
        return $this->belongsTo(Nota::class);
    }

    public function actividad()
    {
        return $this->belongsTo(Actividad::class);
    }


    public function getValorAttribute($value)
    {
        return number_format($value, 1);
    }
}
