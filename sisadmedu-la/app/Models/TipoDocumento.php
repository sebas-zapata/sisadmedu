<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipo_documento';
    protected $primaryKey = 'codigo_tipo_documento';
    public $timestamps = false;

    protected $fillable = [
        'descripcion_tipo_documento'
    ];

    // Relación con usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'tipo_documento_codigo_tipo_documento', 'codigo_tipo_documento');
    }
}