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
        'documento',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo_electronico',
        'id_materia',
        'id_tipo_documento',
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento', 'id');
    }

}
