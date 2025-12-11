<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Asignacion;
use App\Models\Periodo;
use App\Models\Nota;
use App\Models\DetalleNota;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{
    public function notasEstudiante(Request $request)
    {
        // Usuario logueado (LoginUsuario)
        $usuario = Auth::user();

        // Obtener el estudiante relacionado
        $estudiante = $usuario->estudiante;

        // Obtener el grado del estudiante
        $grado_id = $estudiante->id_grado;


        // Filtros opcionales
        $asignacion_id = $request->get('asignacion_id');
        $periodo_id = $request->get('periodo_id');

        // Obtener las materias del grado
        $materias = Asignacion::with('materia')
            ->where('grado_id', $grado_id)
            ->when($asignacion_id, fn($q) => $q->where('id', $asignacion_id))
            ->get();

        // Obtener periodos activos
        $periodos = Periodo::where('activo', 1)->get();

        $notasExistentes = [];

        foreach ($materias as $asignacion) {
            // Obtener notas del estudiante para esta asignación
            $notasDB = Nota::with('detalles')
                ->where('estudiante_id', $estudiante->id)
                ->where('asignacion_id', $asignacion->id)
                ->when($periodo_id, fn($q) => $q->where('periodo_id', $periodo_id))
                ->get()
                ->keyBy('periodo_id');

            foreach ($periodos as $periodo) {
                if (!$notasDB->has($periodo->id)) {
                    // Si no hay notas en este periodo → null
                    $notasExistentes[$asignacion->id][$periodo->id] = null;
                    continue;
                }

                $nota = $notasDB[$periodo->id];

                // Convertir detalles en array simple y forzar valor con 1 decimal
                $detalles = $nota->detalles->map(fn($d) => [
                    'nombre_detalle' => $d->descripcion,
                    'valor' => number_format($d->valor, 1, '.', '') // 1 decimal
                ])->toArray();

                $notasExistentes[$asignacion->id][$periodo->id] = [
                    'promedio' => number_format($nota->promedio, 1, '.', ''), // 1 decimal
                    'detalles' => $detalles
                ];
            }
        }

        return view('estudiantes.notas', compact(
            'estudiante',
            'materias',
            'periodos',
            'notasExistentes',
            'asignacion_id',
            'periodo_id'
        ));
    }
    public function notasEstudiantePorId(Request $request, $id)
    {
        // Usuario logueado
        $usuario = Auth::user();

        // Verificar que el usuario sea un acudiente
        if ($usuario->rol->nombre !== 'Acudiente') {
            abort(403, 'No autorizado');
        }

        // Verificar que el estudiante pertenece al acudiente
        $acudiente = $usuario->acudiente;

        // Obtener el estudiante
        $estudiante = Estudiante::findOrFail($id);

        // Obtener el grado
        $grado_id = $estudiante->id_grado;

        // Filtros opcionales
        $asignacion_id = $request->get('asignacion_id');
        $periodo_id = $request->get('periodo_id');

        // Materias del grado
        $materias = Asignacion::with('materia')
            ->where('grado_id', $grado_id)
            ->when($asignacion_id, fn($q) => $q->where('id', $asignacion_id))
            ->get();

        // Periodos activos
        $periodos = Periodo::where('activo', 1)->get();

        $notasExistentes = [];

        foreach ($materias as $asignacion) {

            $notasDB = Nota::with('detalles')
                ->where('estudiante_id', $estudiante->id)
                ->where('asignacion_id', $asignacion->id)
                ->when($periodo_id, fn($q) => $q->where('periodo_id', $periodo_id))
                ->get()
                ->keyBy('periodo_id');

            foreach ($periodos as $periodo) {

                if (!$notasDB->has($periodo->id)) {
                    $notasExistentes[$asignacion->id][$periodo->id] = null;
                    continue;
                }

                $nota = $notasDB[$periodo->id];

                $detalles = $nota->detalles->map(fn($d) => [
                    'nombre_detalle' => $d->descripcion,
                    'valor' => number_format($d->valor, 1, '.', '')
                ])->toArray();

                $notasExistentes[$asignacion->id][$periodo->id] = [
                    'promedio' => number_format($nota->promedio, 1, '.', ''),
                    'detalles' => $detalles
                ];
            }
        }

        return view('estudiantes.notas', compact(
            'estudiante',
            'materias',
            'periodos',
            'notasExistentes',
            'asignacion_id',
            'periodo_id'
        ));
    }

    public function descargarBoletin(Request $request)
    {
        $estudiante_id = $request->get('estudiante_id');
        if (!$estudiante_id) {
            abort(404, 'Estudiante no especificado.');
        }

        $estudiante = Estudiante::findOrFail($estudiante_id);

        $periodo_id = $request->get('periodo_id');

        if (!$periodo_id) {
            abort(404, 'Periodo no recibido');
        }

        $periodo = Periodo::findOrFail($periodo_id);

        // TODAS LAS MATERIAS DEL GRADO
        $materias = Asignacion::with('materia')
            ->where('grado_id', $estudiante->id_grado)
            ->get();

        $notasExistentes = [];

        foreach ($materias as $asignacion) {

            $nota = Nota::with('detalles')
                ->where('estudiante_id', $estudiante->id)
                ->where('asignacion_id', $asignacion->id)
                ->where('periodo_id', $periodo_id)
                ->first();

            $detalles = $nota
                ? $nota->detalles->map(fn($d) => [
                    'nombre_detalle' => $d->descripcion,
                    'valor' => $d->valor
                ])->toArray()
                : [];

            $notasExistentes[$asignacion->id] = [
                'promedio' => $nota->promedio ?? null,
                'detalles' => $detalles
            ];
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.boletin', compact(
            'estudiante',
            'materias',
            'periodo',
            'notasExistentes'
        ));

        return $pdf->download(
            'Boletin_' . $estudiante->primer_nombre_estudiante .
                '_' . $estudiante->primer_apellido .
                '_Periodo_' . $periodo->numero_periodo . '.pdf'
        );
    }





    public function create($estudiante_id, $asignacion_id)
    {
        $estudiante = Estudiante::findOrFail($estudiante_id);
        $asignacion = Asignacion::with('materia')->findOrFail($asignacion_id);
        $periodos = Periodo::where('activo', 1)->get();

        // Obtener notas existentes
        $notasDB = Nota::with('detalles')
            ->where('estudiante_id', $estudiante_id)
            ->where('asignacion_id', $asignacion_id)
            ->get()
            ->keyBy('periodo_id');

        // Armar estructura de salida limpia para el JS
        $notasExistentes = [];

        foreach ($periodos as $periodo) {

            if (!$notasDB->has($periodo->id)) {
                // El periodo NO tiene notas → enviar null
                $notasExistentes[$periodo->id] = null;
                continue;
            }

            $nota = $notasDB[$periodo->id];

            // Obtener los detalles y convertirlos a array simple
            $detalles = $nota->detalles->map(function ($d) {
                return [
                    'nombre_detalle' => $d->descripcion,
                    'valor' => $d->valor
                ];
            })->toArray();

            // Calcular promedio real (sumar valores y dividir entre cantidad real)
            $promedio = 0;
            if (count($detalles) > 0) {
                $suma = array_sum(array_column($detalles, 'valor'));
                $promedio = $suma / count($detalles);
            }

            // Máximo 4 detalles → si tiene menos llena con vacíos en el frontend
            $notasExistentes[$periodo->id] = [
                'nota_id' => $nota->id,
                'promedio' => $nota->promedio,
                'detalles' => $detalles
            ];
        }

        return view('notas.create', compact(
            'estudiante',
            'asignacion',
            'periodos',
            'notasExistentes'
        ));
    }


    public function store(Request $request)
    {
        // Validación
        $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'asignacion_id' => 'required|exists:asignaciones,id',
            'periodo_id' => 'required|exists:periodos,id',

            'detalles.*.nombre_detalle' => 'nullable|string',
            'detalles.*.valor' => 'nullable|numeric|min:0|max:5',
        ]);

        // Buscar o crear la nota del periodo
        $nota = Nota::firstOrCreate(
            [
                'estudiante_id' => $request->estudiante_id,
                'asignacion_id' => $request->asignacion_id,
                'periodo_id' => $request->periodo_id,
            ],
            ['promedio' => 0]
        );

        // Eliminar detalles anteriores (si está actualizando)
        $nota->detalles()->delete();

        $total = 0;
        $count = 0;

        // Recorrer los 4 detalles enviados desde el formulario
        foreach ($request->detalles as $detalle) {

            // Si no escribió nada, se ignora
            if (
                empty($detalle['nombre_detalle']) &&
                (empty($detalle['valor']) && $detalle['valor'] !== "0")
            ) {
                continue;
            }

            // Insertar detalle
            DetalleNota::create([
                'nota_id' => $nota->id,
                'descripcion' => $detalle['nombre_detalle'],
                'valor' => number_format($detalle['valor'], 1),
            ]);

            // Sumar para el promedio
            $total += $detalle['valor'];
            $count++;
        }

        // Calcular promedio
        $nota->promedio = $count > 0 ? number_format($total / $count, 1) : 0;
        $nota->save();

        return redirect()
            ->route('docente.asignaturas', ['grado_id' => $nota->estudiante->id_grado])
            ->with('success', 'Notas registradas/actualizadas correctamente.');
    }
}
