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
    public function index()
    {
        $docente = Auth::user()->docente;

        $asistencias = Asistencia::whereHas('asignacion', function ($query) use ($docente) {
            $query->where('docente_id', $docente->id);
        })
            ->with(['estudiante', 'asignacion'])
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('asistencias.index', compact('asistencias'));
    }

    public function create($asignacion_id)
    {
        $asignacion = Asignacion::with(['grado.estudiantes'])->findOrFail($asignacion_id);
        $estudiantes = $asignacion->grado->estudiantes;

        return view('asistencias.create', compact('asignacion', 'estudiantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asignacion_id' => 'required|exists:asignaciones,id',
            'fecha' => 'required|date',
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
                    'fecha' => $request->input('fecha'),
                ],
                [
                    'estado' => $asistenciaData['estado'],
                    'justificada' => $asistenciaData['justificacion'] === 'si',
                    'observacion' => $asistenciaData['observacion'] ?? null,
                ]
            );
        }

        // Después de guardar, volver a la vista de asignaciones del docente
        $gradoId = Asignacion::find($request->asignacion_id)->grado_id;

        return redirect()->route('docente.asignaturas', [
            'grado_id' => $gradoId
        ])->with('success', 'Asistencia registrada correctamente.');
    }



    public function show($id)
    {
        $asistencia = Asistencia::with(['estudiante', 'asignacion'])->findOrFail($id);
        return view('asistencias.show', compact('asistencia'));
    }

    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        return view('asistencias.edit', compact('asistencia'));
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:presente,ausente,tarde,excusa',
            'justificada' => 'boolean',
            'observacion' => 'nullable|string|max:255',
        ]);

        $asistencia->update([
            'estado' => $request->estado,
            'justificada' => $request->boolean('justificada'),
            'observacion' => $request->observacion,
        ]);

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia actualizada correctamente.');
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();

        return redirect()->route('asistencias.index')
            ->with('success', 'Registro de asistencia eliminado correctamente.');
    }

    public function porAsignacion($id, Request $request)
    {
        $asignacion = Asignacion::with(['grado.estudiantes', 'materia'])->findOrFail($id);

        //  Determinar la fecha a mostrar
        if (!$request->has('fecha')) {
            // Si no se envió fecha, buscar la última registrada y avanzar un día
            $ultimaFecha = Asistencia::where('asignacion_id', $id)
                ->orderBy('fecha', 'desc')
                ->value('fecha');

            $fecha = $ultimaFecha
                ? Carbon::parse($ultimaFecha)->addDay()->format('Y-m-d')
                : date('Y-m-d'); // si no hay registros, usar hoy
        } else {
            // Si se seleccionó fecha en el input, usar esa
            $fecha = $request->input('fecha');
        }

        //  Traer asistencias de ese día
        $asistenciasExistentes = Asistencia::where('asignacion_id', $id)
            ->whereDate('fecha', $fecha)
            ->get()
            ->keyBy('estudiante_id');

        $estudiantes = $asignacion->grado->estudiantes;

        return view('asistencias.porAsignacion', compact(
            'asignacion',
            'estudiantes',
            'fecha',
            'asistenciasExistentes'
        ));
    }




    public function reporteMensual(Request $request, $asignacionId)
    {
        $asignacion = Asignacion::with(['grado.estudiantes.usuario', 'materia'])->findOrFail($asignacionId);

        $mes = $request->input('mes', date('m'));
        $anio = $request->input('anio', date('Y'));

        $fechaInicio = Carbon::createFromDate($anio, $mes, 1)->startOfMonth();
        $fechaFin = $fechaInicio->copy()->endOfMonth();

        $asistencias = Asistencia::where('asignacion_id', $asignacionId)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get()
            ->groupBy('estudiante_id');

        $diasDelMes = [];
        for ($dia = 1; $dia <= $fechaFin->day; $dia++) {
            $diasDelMes[] = $dia;
        }

        return view('asistencias.reporte-mensual', compact(
            'asignacion',
            'mes',
            'anio',
            'diasDelMes',
            'asistencias'
        ));
    }
}
