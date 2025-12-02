<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Observacion;
use Illuminate\Support\Facades\Auth;
use App\Mail\ObservacionNotificacionMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Estudiante;
use App\Models\Docente;

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
            $request->validate(
                [
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
                ]
            );

            $docenteId = $request->docente_id;
        }

        // Guardar observación
        $observacion = Observacion::create([
            'estudiante_id' => $request->estudiante_id,
            'docente_id'    => $docenteId,
            'tipo'          => $request->tipo,
            'descripcion'   => $request->descripcion,
        ]);

        // Obtener acudiente relacionado al estudiante
        $estudiante = $observacion->estudiante;
        // Obtener el primer acudiente del estudiante
        $acudiente = $estudiante->acudientes->first();

        if ($acudiente && $acudiente->correo_electronico) {
            Mail::to($acudiente->correo_electronico)
                ->send(new ObservacionNotificacionMail($observacion));
        }

        return redirect()->back()->with('success', 'Observación registrada exitosamente y enviada al acudiente.');
    }

    public function misObservaciones()
    {
        $usuario = Auth::user();

        // Obtener el estudiante relacionado
        $estudiante = $usuario->estudiante;

        // Consultar las observaciones de ese estudiante
        $observaciones = $estudiante->observaciones()
            ->with('docente.usuario')
            ->get();

        // Obtener el total de observaciones  
        $totalObservaciones = $observaciones->count();

        // Ahora sí pasamos las dos variables
        return view('estudiantes.observaciones', compact('estudiante', 'observaciones', 'totalObservaciones'));
    }

    public function destroy(Request $request, $id)
    {
        $observacion = Observacion::findOrFail($id);
        $observacion->delete();

        return redirect()->to('/docente/estudiante/' . $request->estudiante_id)
            ->with('success', 'Observación eliminada correctamente');
    }

    public function acudienteObservacionesEstudiante()
    {
        $usuario = Auth::user();

        // Obtener los estudiantes asignados a este acudiente
        $estudiantes = $usuario->estudiantes; // devuelve una colección

        // Verificar si tiene al menos un estudiante
        if ($estudiantes->isEmpty()) {
            return redirect()->back()->with('error', 'No tienes estudiantes asignados.');
        }

        // Si quieres mostrar solo el primero (o podrías adaptar para mostrar todos)
        $estudiante = $estudiantes->first();

        // Obtener las observaciones de ese estudiante
        $observaciones = $estudiante->observaciones()
            ->with('docente.usuario')
            ->get();

        // Obtener el total de observaciones  
        $totalObservaciones = $observaciones->count();

        // Retornar la vista específica para el acudiente
        return view('acudiente.observaciones-estudiante', compact('estudiante', 'observaciones', 'totalObservaciones'));
    }
}
