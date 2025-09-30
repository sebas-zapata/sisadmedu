<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Observacion;
use Illuminate\Support\Facades\Auth;

class ObservacionController extends Controller
{
    public function store(Request $request)
    {
        // Si el usuario logueado es docente
        if (Auth::user()->rol->nombre === 'Docente' && Auth::user()->docente) {
            $request->validate(
                [
                    'estudiante_id' => 'required|exists:estudiantes,id',
                    'tipo'          => 'required|string',
                    'descripcion'   => 'required|string',
                ],
                [
                    'estudiante_id.required' => 'El campo estudiante es obligatorio.',
                    'estudiante_id.exists'   => 'El estudiante seleccionado no existe.',
                    'tipo.required'          => 'El campo tipo es obligatorio.',
                    'descripcion.required'   => 'El campo descripción es obligatorio.',
                ]
            );

            $docenteId = Auth::user()->docente->id;
        }
        // Si es admin u otro rol
        else {
            $request->validate([
                'estudiante_id' => 'required|exists:estudiantes,id',
                'docente_id'    => 'required|exists:docentes,id',
                'tipo'          => 'required|string',
                'descripcion'   => 'required|string',
            ],
        [
                'estudiante_id.required' => 'El campo estudiante es obligatorio.',
                'estudiante_id.exists'   => 'El estudiante seleccionado no existe.',
                'docente_id.required'    => 'El campo docente es obligatorio.',
                'docente_id.exists'      => 'El docente seleccionado no existe.',
                'tipo.required'          => 'El campo tipo es obligatorio.',
                'descripcion.required'   => 'El campo descripción es obligatorio.',
            ]);

            $docenteId = $request->docente_id;
        }

        // Guardar observación
        Observacion::create([
            'estudiante_id' => $request->estudiante_id,
            'docente_id'    => $docenteId,
            'tipo'          => $request->tipo,
            'descripcion'   => $request->descripcion,
        ]);

        return redirect()->back()->with('success', 'Observación registrada exitosamente.');
    }
}
