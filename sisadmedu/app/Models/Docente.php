<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'usuario_id',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'id_tipo_documento',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'estado_civil',
        'especializacion',
        'anios_experiencia',
        'fecha_ingreso',
        'tipo_contrato'
    ];

    // Relaciones

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

    public function materias()
    {
        return $this->belongsToMany(Materia::class, 'asignaciones', 'docente_id', 'materia_id')
            ->withPivot('grado_id', 'anio_lectivo')
            ->withTimestamps();
    }


    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'id_tipo_documento');
    }

    public function observaciones()
    {
        return $this->hasMany(Observacion::class, 'docente_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function loginUsuario()
    {
        return $this->belongsTo(LoginUsuario::class, 'usuario_id');
    }
}
