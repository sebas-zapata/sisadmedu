<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Asignacion;
use App\Models\Periodo;
use App\Models\Nota;
use App\Models\DetalleNota;

class NotaController extends Controller
{
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
