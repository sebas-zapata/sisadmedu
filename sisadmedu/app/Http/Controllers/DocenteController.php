<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\TipoDocumento;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Estudiante;
use App\Models\Asignacion;
use App\Models\Grado;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function index()
    {

        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para crear docentes.');
        }

        $docentes = Docente::with('usuario')->get();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para crear docentes.');
        }

        $tipoDocumentos = TipoDocumento::all();
        return view('docentes.create', compact('tipoDocumentos'));
    }

    public function store(Request $request)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para crear docentes.');
        }

        $request->validate([
            'documento' => 'required|string|max:255|unique:usuarios,documento',
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico',
            'celular' => 'required|string|max:20|unique:usuarios,celular',

            // Relacionales
            'id_tipo_documento' => 'required|exists:tipos_documento,id',

            // Nuevos campos de docentes
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:50',
            'especializacion' => 'required|string|max:255',
            'anios_experiencia' => 'required|integer|min:0',
            'fecha_ingreso' => 'required|date',
            'tipo_contrato' => 'required|in:Planta,Catedrático,Temporal',
        ], [
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'El documento ya está registrado.',

            'primer_nombre.required' => 'El primer nombre es obligatorio.',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',

            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email' => 'Debes ingresar un correo válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',

            'celular.required' => 'El celular es obligatorio.',
            'celular.unique' => 'El celular ya está registrado.',

            'id_tipo_documento.required' => 'El tipo de documento es obligatorio.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',

            'estado_civil.required' => 'El estado civil es obligatorio.',

            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
            'fecha_ingreso.date' => 'La fecha de ingreso no es válida.',

            'direccion.required' => 'La dirección es obligatoria.',
            'especializacion.required' => 'La especialización es obligatoria.',
            'anios_experiencia.required' => 'Los años de experiencia son obligatorios.',

            'tipo_contrato.required' => 'El tipo de contrato es obligatorio.',
            'tipo_contrato.in' => 'El tipo de contrato debe ser Planta, Catedrático o Temporal.',
        ]);


        DB::beginTransaction();

        try {
            // obtener id del rol docente (evita usar números mágicos)
            $rolDocente = Rol::where('nombre', 'Docente')->first();
            $rolId = $rolDocente ? $rolDocente->id : 8; // fallback si no existe

            // 1️⃣ Crear usuario (documento y celular se guardan en usuarios)
            $usuario = Usuario::create([
                'documento' => $request->documento,
                'celular' => $request->celular, // nuevo campo
                'nombres' => trim($request->primer_nombre . ' ' . $request->segundo_nombre),
                'apellidos' => trim($request->primer_apellido . ' ' . $request->segundo_apellido),
                'correo_electronico' => $request->correo_electronico,
                'contrasena' => Hash::make($request->documento), // contraseña inicial = documento
                'rol_id' => $rolId,
                'tipo_documento_id' => $request->id_tipo_documento,
            ]);

            // 2️⃣ Crear docente y vincular usuario (sin 'documento' ni 'celular' en docentes)
            Docente::create([
                'usuario_id' => $usuario->id,
                'id_tipo_documento' => $request->id_tipo_documento,
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                // Nuevos campos
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'estado_civil' => $request->estado_civil,
                'especializacion' => $request->especializacion,
                'anios_experiencia' => $request->anios_experiencia,
                'fecha_ingreso' => $request->fecha_ingreso,
                'tipo_contrato' => $request->tipo_contrato,
            ]);

            DB::commit();

            return redirect()->route('docentes.index')->with('success', 'Docente creado y usuario vinculado exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            // devuelve con input para no perder lo escrito y muestra el error
            return back()->withInput()->withErrors(['error' => 'Error al crear docente: ' . $e->getMessage()]);
        }
    }




    public function show(string $id)
    {
        $docente = Docente::with(['tipoDocumento', 'usuario'])->findOrFail($id);
        return view('docentes.show', compact('docente'));
    }

    public function edit($id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para editar docentes.');
        }

        $docente = Docente::with(['tipoDocumento', 'usuario'])->findOrFail($id);
        $documentos = TipoDocumento::all();
        return view('docentes.edit', compact('docente', 'documentos'));
    }

    public function update(Request $request, $id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para editar docentes.');
        }

        $docente = Docente::with('usuario')->findOrFail($id);
        $request->validate([
            'documento' => 'required|string|max:255|unique:usuarios,documento,' . $docente->usuario->id,
            'primer_nombre' => 'required|string|max:255',
            'segundo_nombre' => 'nullable|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'nullable|string|max:255',
            'correo_electronico' => 'required|string|email|max:255|unique:usuarios,correo_electronico,' . $docente->usuario->id,
            'celular' => 'required|string|max:20|unique:usuarios,celular,' . $docente->usuario->id,

            // Relacionales
            'id_tipo_documento' => 'required|exists:tipos_documento,id',

            // Nuevos campos de docentes
            'fecha_nacimiento' => 'required|date',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:50',
            'especializacion' => 'required|string|max:255',
            'anios_experiencia' => 'required|integer|min:0',
            'fecha_ingreso' => 'required|date',
            'tipo_contrato' => 'required|in:Planta,Catedrático,Temporal',
        ], [
            'documento.required' => 'El documento es obligatorio.',
            'documento.unique' => 'El documento ya está registrado.',

            'primer_nombre.required' => 'El primer nombre es obligatorio.',
            'primer_apellido.required' => 'El primer apellido es obligatorio.',

            'correo_electronico.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico.email' => 'Debes ingresar un correo válido.',
            'correo_electronico.unique' => 'El correo electrónico ya está registrado.',

            'celular.required' => 'El celular es obligatorio.',
            'celular.unique' => 'El celular ya está registrado.',

            'id_tipo_documento.required' => 'El tipo de documento es obligatorio.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida.',
            'fecha_ingreso.date' => 'La fecha de ingreso no es válida.',

            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date' => 'La fecha de ingreso no es válida.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres.',
            'especializacion.max' => 'La especialización no puede superar los 255 caracteres.',

            'estado_civil.required' => 'El estado civil es obligatorio.',
            'estado_civil.max' => 'El estado civil no puede superar los 50 caracteres.',

            'especializacion.required' => 'La especialización es obligatoria.',

            'anios_experiencia.required' => 'Los años de experiencia son obligatorios.',
            'anios_experiencia.integer' => 'Los años de experiencia deben ser un número.',
            'anios_experiencia.min' => 'Los años de experiencia no pueden ser negativos.',
            'anios_experiencia.integer' => 'Los años de experiencia deben ser un número.',

            'tipo_contrato.required' => 'El tipo de contrato es obligatorio.',
            'tipo_contrato.in' => 'El tipo de contrato debe ser Planta, Catedrático o Temporal.',
        ]);

        DB::beginTransaction();

        try {
            // 1️⃣ Actualizar docente (incluye nuevos campos)
            $docente->update([
                'id_tipo_documento' => $request->id_tipo_documento,
                'primer_nombre' => $request->primer_nombre,
                'segundo_nombre' => $request->segundo_nombre,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,


                // Nuevos campos
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'telefono' => $request->telefono,
                'direccion' => $request->direccion,
                'estado_civil' => $request->estado_civil,
                'especializacion' => $request->especializacion,
                'anios_experiencia' => $request->anios_experiencia,
                'fecha_ingreso' => $request->fecha_ingreso,
                'tipo_contrato' => $request->tipo_contrato,
            ]);

            // 2️⃣ Actualizar usuario vinculado
            $docente->usuario->update([
                'documento' => $request->documento,
                'celular' => $request->celular,
                'nombres' => trim($request->primer_nombre . ' ' . $request->segundo_nombre),
                'apellidos' => trim($request->primer_apellido . ' ' . $request->segundo_apellido),
                'correo_electronico' => $request->correo_electronico,
                'tipo_documento_id' => $request->id_tipo_documento,
            ]);

            DB::commit();

            return redirect()->route('docentes.index')->with('success', 'Docente y usuario actualizados exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar docente: ' . $e->getMessage()]);
        }
    }




    public function destroy(string $id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para eliminar docentes.');
        }

        $docente = Docente::with('usuario')->findOrFail($id);

        DB::transaction(function () use ($docente) {
            $docente->usuario()->delete(); // eliminar usuario vinculado
            $docente->delete();
        });

        return redirect()->route('docentes.index')->with('success', 'Docente y usuario eliminados exitosamente.');
    }

    public function verInformacion()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();

        // Cargar al docente con sus asignaciones, grados y materias
        $docente = Docente::with(['usuario', 'asignaciones.grado', 'asignaciones.materia'])
            ->where('usuario_id', $usuario->id)
            ->first();

        // Verificar si existe un docente asociado
        if (!$docente) {
            return redirect()->back()->with('error', 'No se encontró información del docente.');
        }

        // Obtener las asignaciones del docente
        $asignaciones = $docente->asignaciones;

        // Retornar la vista con toda la información
        return view('docentes.mi-informacion', compact('usuario', 'docente', 'asignaciones'));
    }



    public function verEstudiantes(Request $request)
    {
        $usuario = Auth::user();
        $docente = $usuario->docente;

        if (!$docente) {
            return redirect()->back()->with('error', 'No se encontró información del docente.');
        }

        // 🔹 Obtener todos los grados asignados al docente
        $asignaciones = $docente->asignaciones()->with('grado')->get();

        if ($asignaciones->isEmpty()) {
            return redirect()->back()->with('error', 'No tienes grados asignados.');
        }

        // 🔹 Grados únicos (puede tener varias materias por el mismo grado)
        $grados = $asignaciones->pluck('grado')->unique('id');

        // 🔹 Verificar si se seleccionó un grado desde el select
        $gradoSeleccionado = $request->input('grado_id');

        $estudiantes = collect(); // vacío por defecto

        if ($gradoSeleccionado) {
            $estudiantes = Estudiante::where('id_grado', $gradoSeleccionado)
                ->with('grado')
                ->get();
        }

        return view('docentes.estudiantes-asignados', compact('usuario', 'docente', 'grados', 'estudiantes', 'gradoSeleccionado'));
    }

    public function verAsignaturas(Request $request)
    {
        // 🔹 Obtener el usuario autenticado
        $usuario = Auth::user();

        // 🔹 Buscar el docente asociado al usuario autenticado
        $docente = Docente::where('usuario_id', $usuario->id)->first();

        if (!$docente) {
            return back()->with('error', 'No se encontró un docente asociado a este usuario.');
        }

        // 🔹 Obtener todos los grados asignados al docente
        $grados = Grado::whereIn(
            'id',
            Asignacion::where('docente_id', $docente->id)->pluck('grado_id')
        )->get();

        // 🔹 Capturar el grado seleccionado desde el filtro
        $gradoSeleccionado = $request->input('grado_id');

        // 🔹 Consultar las asignaciones del docente (filtradas si hay grado seleccionado)
        $asignacionesQuery = Asignacion::with(['materia', 'grado.estudiantes.usuario'])
            ->where('docente_id', $docente->id);

        if ($gradoSeleccionado) {
            $asignacionesQuery->where('grado_id', $gradoSeleccionado);
        }

        $asignaciones = $asignacionesQuery->get();

        // 🔹 Mapear los datos para pasarlos a la vista
        $materiasAsignadas = $asignaciones->map(function ($asignacion) {
            return [
                'materia' => $asignacion->materia->descripcion,
                'grado' => $asignacion->grado->nombre_grado,
                'estudiantes' => $asignacion->grado->estudiantes->map(function ($estudiante) {
                    return [
                        'documento' => $estudiante->usuario->documento ?? '—',
                        'matricula' => $estudiante->matricula ?? '—',
                        'nombre' => trim(
                            $estudiante->primer_nombre_estudiante . ' ' .
                                $estudiante->segundo_nombre_estudiante . ' ' .
                                $estudiante->primer_apellido_estudiante . ' ' .
                                $estudiante->segundo_apellido_estudiante
                        ),
                        'grado' => $estudiante->grado->nombre_grado ?? '—',
                    ];
                }),
            ];
        });

        // 🔹 Retornar la vista con los datos necesarios
        return view('docentes.materias-asignadas', compact('materiasAsignadas', 'grados', 'gradoSeleccionado'));
    }
}
