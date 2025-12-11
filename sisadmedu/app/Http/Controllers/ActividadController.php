<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
{
    // ---------------------------
    // CREAR (muestra formulario)
    // ---------------------------
    public function crear(Request $request)
    {
        return view('actividades.create', [
            'actividad' => null,
            'asignacion_id' => $request->asignacion_id,
            'periodo_id' => $request->periodo_id,
            'grado_id' => $request->grado_id,
            'materia_id' => $request->materia_id,
        ]);
    }

    // ---------------------------
    // GUARDAR NUEVA ACTIVIDAD
    // ---------------------------
    public function guardar(Request $request)
    {
        // Validación de campos
        $request->validate([
            'asignacion_id' => 'required|integer',
            'periodo_id' => 'required|integer',
            'descripcion' => 'required|string|max:255',
        ], [
            'descripcion.required' => 'La descripción de la actividad es obligatoria.'
        ]);

        // Crear actividad
        Actividad::create([
            'asignacion_id' => $request->asignacion_id,
            'periodo_id'    => $request->periodo_id,
            'descripcion'   => $request->descripcion
        ]);

        // Redirigir al listado de notas con filtros aplicados
        return redirect()->route('notas.index', [
            'grado_id' => $request->grado_id,
            'materia_id' => $request->materia_id,
            'periodo_id' => $request->periodo_id,
        ])->with('success', 'Actividad registrada correctamente.');
    }

    // ---------------------------
    // EDITAR (muestra formulario con datos)
    // ---------------------------
    public function editar($id)
    {
        $actividad = Actividad::findOrFail($id);

        return view('actividades.create', [
            'actividad' => $actividad,
            'asignacion_id' => $actividad->asignacion_id,
            'periodo_id' => $actividad->periodo_id,
            'modo' => 'editar'
        ]);
    }

    // ---------------------------
    // ACTUALIZAR ACTIVIDAD
    // ---------------------------
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255'
        ]);

        $actividad = Actividad::findOrFail($id);
        $actividad->descripcion = $request->descripcion;
        $actividad->save();

        // Actualizar descripción en detalle_notas
        DB::table('detalle_notas')
            ->where('actividad_id', $actividad->id)
            ->update(['descripcion' => $actividad->descripcion]);

        return back()->with('success', 'Actividad actualizada correctamente.');
    }
}
