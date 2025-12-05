<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AsignacionService;
use App\Models\Docente;
use App\Models\Materia;
use App\Models\Grado;
use Illuminate\Support\Facades\Auth;

class AsignacionController extends Controller
{
    protected $service;

    public function __construct(AsignacionService $service)
    {
        $this->service = $service;

        // Middleware para restringir acceso según el rol
        $this->middleware(function ($request, $next) {
            if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
                return redirect()->route('dashboard')
                    ->with('error', 'No tienes permisos para acceder a las asignaciones.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        // Asignaciones desde el microservicio
        $asignaciones = $this->service->listar();

        // Datos locales de la BD
        $docentes = Docente::with('usuario')->get();
        $materias = Materia::all();
        $grados   = Grado::all(); // ← Faltaba esto

        return view('asignaciones.index', compact('asignaciones', 'docentes', 'materias', 'grados'));
    }



    /** MOSTRAR FORMULARIO DE CREACIÓN */
    public function create()
    {
        $docentes = Docente::with('usuario')->get();
        $materias = Materia::all();
        $grados   = Grado::all();

        return view('asignaciones.create', compact('docentes', 'materias', 'grados'));
    }

    /** GUARDAR NUEVA ASIGNACIÓN */
    public function store(Request $request)
    {
        // Validación de campos locales
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'grado_id'   => 'required|exists:grados,id',
        ]);

        $anioActual = date('Y');

        /** VALIDACIÓN CONTRA MICROSERVICIO (duplicados y conflictos) */
        $asignaciones = $this->service->listar();

        // Duplicado exacto
        $duplicado = $asignaciones->contains(function ($a) use ($request, $anioActual) {
            return $a['docenteId'] == $request->docente_id &&
                $a['materiaId'] == $request->materia_id &&
                $a['gradoId']   == $request->grado_id &&
                $a['anioLectivo'] == $anioActual;
        });

        if ($duplicado) {
            return back()->withInput()->withErrors([
                'error' => 'Ya existe una asignación para ese docente, materia y grado en el año lectivo actual.'
            ]);
        }

        // Conflicto: misma materia+grado con otro docente
        $conflicto = $asignaciones->contains(function ($a) use ($request, $anioActual) {
            return $a['materiaId'] == $request->materia_id &&
                $a['gradoId']   == $request->grado_id &&
                $a['anioLectivo'] == $anioActual &&
                $a['docenteId'] != $request->docente_id;
        });

        if ($conflicto) {
            return back()->withInput()->withErrors([
                'error' => 'Esa materia ya está asignada a otro docente en ese grado y año lectivo.'
            ]);
        }

        /** CREAR EN EL MICROSERVICIO */
        $this->service->crear([
            'docenteId'   => $request->docente_id,
            'materiaId'   => $request->materia_id,
            'gradoId'     => $request->grado_id,
            'anioLectivo' => $anioActual,
        ]);

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación creada correctamente.');
    }

    /** MOSTRAR DETALLE */
    public function show($id)
    {
        $asignacion = $this->service->obtener($id);
        $docentes = Docente::with('usuario')->get();
        $materias = Materia::all();
        $grados   = Grado::all();

        return view('asignaciones.show', compact('asignacion', 'docentes', 'materias', 'grados'));
    }


    /** FORMULARIO DE EDICIÓN */
    public function edit($id)
    {
        $asignacion = $this->service->obtener($id);
        $docentes = Docente::with('usuario')->get();
        $materias = Materia::all();
        $grados   = Grado::all();

        return view('asignaciones.edit', compact('asignacion', 'docentes', 'materias', 'grados'));
    }

    /** ACTUALIZAR ASIGNACIÓN */
    public function update(Request $request, $id)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'materia_id' => 'required|exists:materias,id',
            'grado_id'   => 'required|exists:grados,id',
        ]);

        $anioActual = date('Y');
        $asignaciones = $this->service->listar();

        /** VALIDACIONES COMO ANTES PERO EXCLUYENDO EL ACTUAL */

        // Duplicado exacto
        $duplicado = $asignaciones->contains(function ($a) use ($request, $anioActual, $id) {
            return $a['id'] != $id &&
                $a['docenteId'] == $request->docente_id &&
                $a['materiaId'] == $request->materia_id &&
                $a['gradoId']   == $request->grado_id &&
                $a['anioLectivo'] == $anioActual;
        });

        if ($duplicado) {
            return back()->withInput()->withErrors([
                'error' => 'Ya existe otra asignación con esa combinación en el año lectivo.'
            ]);
        }

        // Conflicto: misma materia + grado asignado a otro docente
        $conflicto = $asignaciones->contains(function ($a) use ($request, $anioActual, $id) {
            return $a['id'] != $id &&
                $a['materiaId'] == $request->materia_id &&
                $a['gradoId']   == $request->grado_id &&
                $a['anioLectivo'] == $anioActual &&
                $a['docenteId'] != $request->docente_id;
        });

        if ($conflicto) {
            return back()->withInput()->withErrors([
                'error' => 'La materia ya está asignada a otro docente para este grado y año lectivo.'
            ]);
        }

        /** ACTUALIZAR EN EL MICROSERVICIO */
        $this->service->actualizar($id, [
            'docenteId'   => $request->docente_id,
            'materiaId'   => $request->materia_id,
            'gradoId'     => $request->grado_id,
            'anioLectivo' => $anioActual,
        ]);

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación actualizada correctamente.');
    }

    /** ELIMINAR */
    public function destroy($id)
    {
        $ok = $this->service->eliminar($id);

        if (!$ok) {
            return back()->withErrors(['error' => 'No se pudo eliminar la asignación.']);
        }

        return redirect()->route('asignaciones.index')
            ->with('success', 'Asignación eliminada.');
    }
}
