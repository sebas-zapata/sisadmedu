<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Observacion;

class ObservacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'docente_id'    => 'required|exists:docentes,id',
            'tipo'          => 'required|string',
            'descripcion'   => 'required|string',
        ]);

        Observacion::create([
            'estudiante_id' => $request->estudiante_id,
            'docente_id'    => $request->docente_id,
            'tipo'          => $request->tipo,
            'descripcion'   => $request->descripcion,
            'fecha'         => now(),
        ]);

        return redirect()->back()->with('success', 'Observación registrada correctamente.');
    }
}
