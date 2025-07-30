<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $fillable = [
        'codigo_docente',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo_electronico',
        'id_materia'
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }
}
