<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Asignacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class AsistenciaController extends Controller
{
    /**
     * Muestra el listado de asistencias del docente autenticado.
     */
    public function index()
    {
        $docente = Auth::user()->docente;

        // Obtiene todas las asistencias de las asignaciones del docente
        $asistencias = Asistencia::whereHas('asignacion', function ($query) use ($docente) {
            $query->where('docente_id', $docente->id);
        })
            ->with(['estudiante', 'asignacion'])
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('asistencias.index', compact('asistencias'));
    }

    /**
     * Muestra el formulario para tomar asistencia de una asignatura específica.
     */
    public function create($asignacion_id)
    {
        $asignacion = Asignacion::with(['grado.estudiantes'])->findOrFail($asignacion_id);
        $estudiantes = $asignacion->grado->estudiantes;

        return view('asistencias.create', compact('asignacion', 'estudiantes'));
    }

    /**
     * Guarda la asistencia tomada por el docente.
     */
    public function store(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:asignaciones,id',
            'asistencias' => 'required|array',
            'asistencias.*.estudiante_id' => 'required|exists:estudiantes,id',
            'asistencias.*.estado' => 'required|in:presente,ausente,tarde,excusa',
            'asistencias.*.justificacion' => 'nullable|in:si,no',
            'asistencias.*.observacion' => 'nullable|string|max:255',
        ]);

        foreach ($request->asistencias as $asistenciaData) {
            Asistencia::updateOrCreate(
                [
                    'asignacion_id' => $request->asignacion_id,
                    'estudiante_id' => $asistenciaData['estudiante_id'],
                    'fecha' => $request->fecha ?? date('Y-m-d'),
                ],
                [
                    'estado' => $asistenciaData['estado'],
                    'justificacion' => $asistenciaData['justificacion'] ?? null,
                    'observacion' => $asistenciaData['observacion'] ?? null,
                ]
            );
        }

        return redirect()->route('docente.asignaturas', ['grado_id' => Asignacion::find($request->asignacion_id)->grado_id])
            ->with('success', 'Asistencia registrada correctamente.');
    }


    /**
     * Muestra los detalles de una asistencia específica (opcional).
     */
    public function show($id)
    {
        $asistencia = Asistencia::with(['estudiante', 'asignacion'])->findOrFail($id);
        return view('asistencias.show', compact('asistencia'));
    }

    /**
     * Permite editar una asistencia (por ejemplo, justificar una falta).
     */
    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        return view('asistencias.edit', compact('asistencia'));
    }

    /**
     * Actualiza una asistencia (por ejemplo, marcar como justificada).
     */
    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:presente,ausente,tarde,excusa',
            'justificada' => 'boolean',
            'observacion' => 'nullable|string',
        ]);

        $asistencia->update([
            'estado' => $request->estado,
            'justificada' => $request->boolean('justificada'),
            'observacion' => $request->observacion,
        ]);

        return redirect()
            ->route('asistencias.index')
            ->with('success', 'Asistencia actualizada correctamente.');
    }

    /**
     * Elimina un registro de asistencia (opcional, según políticas del sistema).
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()
            ->route('asistencias.index')
            ->with('success', 'Registro de asistencia eliminado correctamente.');
    }

    public function porAsignacion($id, Request $request)
    {
        $asignacion = Asignacion::with(['grado.estudiantes', 'materia'])->findOrFail($id);

        // Fecha seleccionada o por defecto hoy
        $fecha = $request->input('fecha', date('Y-m-d'));

        // Obtener asistencias de ese día
        $asistenciasExistentes = Asistencia::where('asignacion_id', $id)
            ->whereDate('fecha', $fecha)
            ->get()
            ->keyBy('estudiante_id');

        $estudiantes = $asignacion->grado->estudiantes;

        return view('asistencias.porAsignacion', compact('asignacion', 'estudiantes', 'fecha', 'asistenciasExistentes'));
    }

    public function reporteMensual(Request $request, $asignacionId)
    {
        $asignacion = Asignacion::with(['grado.estudiantes.usuario', 'materia'])->findOrFail($asignacionId);

        $mes = $request->input('mes', date('m'));
        $anio = $request->input('anio', date('Y'));

        $fechaInicio = Carbon::createFromDate($anio, $mes, 1);
        $fechaFin = $fechaInicio->copy()->endOfMonth();

        $asistencias = Asistencia::where('asignacion_id', $asignacionId)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get()
            ->groupBy('estudiante_id');

        $diasDelMes = [];
        for ($dia = 1; $dia <= $fechaFin->day; $dia++) {
            $diasDelMes[] = $dia;
        }

        return view('asistencias.reporte-mensual', compact('asignacion', 'mes', 'anio', 'diasDelMes', 'asistencias'));
    }

    
}
