<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = ['id_grado', 'id_materia', 'id_docente', 'dia', 'hora_inicio', 'hora_fin'];

    public function grado()
    {
        return $this->belongsTo(Grado::class, 'id_grado');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }
}
