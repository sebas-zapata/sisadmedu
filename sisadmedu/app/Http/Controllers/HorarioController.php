<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Grado;
use App\Models\Materia;
use App\Models\Horario;

class HorarioController extends Controller
{
    // Listar grados con estado de horario
    public function index()
    {
        $grados = Grado::withCount('horarios')->get();
        return view('horarios.index', compact('grados'));
    }

    // Formulario para crear horario de un grado
    public function create(Request $request)
    {
        if (!$request->has('grado')) {
            return redirect()->route('horarios.index')->with('error', 'Debes seleccionar un grado para crear un horario.');
        }

        $gradoSeleccionado = Grado::findOrFail($request->grado);
        $materias = Materia::all();

        $bloques = [
            ['inicio' => '06:00', 'fin' => '07:38'],
            ['inicio' => '07:38', 'fin' => '09:15'],
            ['descanso' => true, 'inicio' => '09:15', 'fin' => '09:45'],
            ['inicio' => '09:45', 'fin' => '10:45'],
            ['inicio' => '10:45', 'fin' => '11:45'],
        ];

        return view('horarios.create', compact('materias', 'gradoSeleccionado', 'bloques'));
    }

    // Guardar nuevo horario
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_grado'    => 'required|exists:grados,id',
            'materias'    => 'required|array',
            'hora_inicio' => 'required|array',
            'hora_fin'    => 'required|array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $id_grado = $request->id_grado;

        if (Horario::where('id_grado', $id_grado)->exists()) {
            return back()->withErrors(['id_grado' => 'Este grado ya tiene un horario asignado.'])->withInput();
        }

        $errores = $this->validarHorario($request);

        if (!empty($errores)) {
            return back()->withErrors($errores)->withInput();
        }

        $this->guardarHorario($request, $id_grado);

        return redirect()->route('horarios.index')->with('success', 'Horario guardado correctamente.');
    }

    // Mostrar horario de un grado
    public function show($id)
    {
        $grado = Grado::findOrFail($id);
        $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $descanso = ['inicio' => '09:15', 'fin' => '09:45'];

        $raw = Horario::where('id_grado', $id)
            ->with('materia')
            ->orderByRaw("FIELD(dia, 'Lunes','Martes','Miércoles','Jueves','Viernes')")
            ->orderBy('hora_inicio')
            ->get();

        $horarios = [];
        foreach ($dias as $dia) {
            $grupo = $raw->where('dia', $dia)->values();

            $bloques = collect();
            $descansoInsertado = false;

            foreach ($grupo as $clase) {
                // Insertar descanso automáticamente
                if (!$descansoInsertado && $clase->hora_inicio >= $descanso['inicio']) {
                    $bloques->push((object)[
                        'materia'     => null,
                        'es_descanso' => true,
                        'hora_inicio' => $descanso['inicio'],
                        'hora_fin'    => $descanso['fin'],
                    ]);
                    $descansoInsertado = true;
                }

                $bloques->push((object)[
                    'materia'     => $clase->materia,
                    'es_descanso' => false,
                    'hora_inicio' => $clase->hora_inicio,
                    'hora_fin'    => $clase->hora_fin,
                ]);
            }

            // Si el descanso no fue insertado
            if (!$descansoInsertado) {
                $bloques->push((object)[
                    'materia'     => null,
                    'es_descanso' => true,
                    'hora_inicio' => $descanso['inicio'],
                    'hora_fin'    => $descanso['fin'],
                ]);
            }

            $horarios[$dia] = $bloques;
        }

        return view('horarios.show', compact('grado', 'horarios', 'dias'));
    }

    // Editar horario
    public function edit($id)
    {
        $grado = Grado::findOrFail($id);
        $materias = Materia::all();

        // Agrupar por día
        $horarios = Horario::where('id_grado', $id)->with('materia')->get()->groupBy('dia');

        $bloques = [
            ['inicio' => '06:00', 'fin' => '07:38'],
            ['inicio' => '07:38', 'fin' => '09:15'],
            ['descanso' => true, 'inicio' => '09:15', 'fin' => '09:45'],
            ['inicio' => '09:45', 'fin' => '10:45'],
            ['inicio' => '10:45', 'fin' => '11:45'],
        ];

        return view('horarios.edit', compact('grado', 'materias', 'horarios', 'bloques'));
    }

    // Actualizar horario
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'materias'    => 'required|array',
            'hora_inicio' => 'required|array',
            'hora_fin'    => 'required|array',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $grado = Grado::findOrFail($id);

        // Borrar horario anterior
        Horario::where('id_grado', $id)->delete();

        $errores = $this->validarHorario($request);

        if (!empty($errores)) {
            return back()->withErrors($errores)->withInput();
        }

        $this->guardarHorario($request, $id);

        return redirect()->route('horarios.index')->with('success', 'Horario actualizado correctamente.');
    }

    // Eliminar horario
    public function destroy($id)
    {
        $grado = Grado::findOrFail($id);
        Horario::where('id_grado', $id)->delete();

        return redirect()->route('horarios.index')->with('success', 'Horario eliminado correctamente.');
    }

    // -------------------------------
    // Funciones auxiliares de negocio
    // -------------------------------

    private function validarHorario(Request $request)
    {
        $errores = [];
        $descanso = ['inicio' => '09:15', 'fin' => '09:45'];

        foreach ($request->materias as $dia => $materiasDelDia) {
            foreach ($materiasDelDia as $i => $materiaId) {
                $horaInicio = $request->hora_inicio[$dia][$i] ?? null;
                $horaFin = $request->hora_fin[$dia][$i] ?? null;

                if ($materiaId) {
                    // Validar hora inicio y fin
                    if (!$horaInicio || !$horaFin) {
                        $errores["hora.$dia.$i"] = "Debe definir hora de inicio y fin.";
                        continue;
                    }

                    if ($horaFin <= $horaInicio) {
                        $errores["hora_fin.$dia.$i"] = "La hora de fin debe ser mayor a la de inicio.";
                    }

                    // Validar conflicto de materia en otros grados
                    $conflicto = Horario::where('dia', $dia)
                        ->where('id_materia', $materiaId)
                        ->where(function ($q) use ($horaInicio, $horaFin) {
                            $q->whereBetween('hora_inicio', [$horaInicio, $horaFin])
                                ->orWhereBetween('hora_fin', [$horaInicio, $horaFin])
                                ->orWhere(function ($q2) use ($horaInicio, $horaFin) {
                                    $q2->where('hora_inicio', '<=', $horaInicio)
                                        ->where('hora_fin', '>=', $horaFin);
                                });
                        })
                        ->exists();

                    if ($conflicto) {
                        $materiaNombre = Materia::find($materiaId)->descripcion;
                        $errores["materias.$dia.$i"] = "La materia $materiaNombre ya está asignada el $dia de $horaInicio a $horaFin en otro grado.";
                    }

                    // Validar descanso
                    if ($horaInicio < $descanso['inicio'] && $horaFin > $descanso['inicio'] && $horaFin <= $descanso['fin']) {
                        $errores["materias.$dia.$i"] = "Este bloque se superpone con el descanso de $descanso[inicio] a $descanso[fin].";
                    }
                }
            }
        }

        return $errores;
    }

    private function guardarHorario(Request $request, $id_grado)
    {
        foreach ($request->materias as $dia => $materiasDelDia) {
            foreach ($materiasDelDia as $i => $materiaId) {
                $horaInicio = $request->hora_inicio[$dia][$i] ?? null;
                $horaFin = $request->hora_fin[$dia][$i] ?? null;

                if ($materiaId && $horaInicio && $horaFin) {
                    Horario::create([
                        'id_grado'    => $id_grado,
                        'id_materia'  => $materiaId,
                        'dia'         => $dia,
                        'hora_inicio' => $horaInicio,
                        'hora_fin'    => $horaFin,
                    ]);
                }
            }
        }
    }
}
