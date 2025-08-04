<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{
    // Importar el trait HasFactory para usar las fábricas de Eloquent
    use HasFactory;
    // Definición de la tabla
    protected $table = 'docentes';
    // Definición de la clave primaria
    protected $primaryKey = 'id';

    // definir campos que se pueden asignar masivamente
    protected $fillable = [
        'codigo_docente',
        'documento',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'correo_electronico',
        'id_materia',
        'id_tipo_documento'
    ];

    // Relación con el modelo de Materia
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'id_materia', 'id');
    }

    // Relación con el modelo de TipoDocumento
    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento', 'id');
    }
}
