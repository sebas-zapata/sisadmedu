<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\TipoDocumento;
use App\Models\Docente;
use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    // Listar estudiantes y sus grados
    public function index()
    {

        $estudiantes = Estudiante::with(['usuario', 'grado'])->get();
        return view('estudiantes.index', compact('estudiantes'));
    }


    // Mostrar el formulario para crear un nuevo estudiante y asignar un grado
    public function create()
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }


        $tiposDocumentos = TipoDocumento::all();
        $grados = Grado::all();
        return view('estudiantes.create', compact('tiposDocumentos', 'grados'));
    }

    // Guardar un nuevo estudiante
    public function store(Request $request)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $request->validate([
            'documento_estudiante' => 'required|string|max:20|unique:usuarios,documento',
            'primer_nombre_estudiante' => 'required|string|max:50',
            'segundo_nombre_estudiante' => 'nullable|string|max:50',
            'primer_apellido_estudiante' => 'required|string|max:50',
            'segundo_apellido_estudiante' => 'nullable|string|max:50',
            'edad_estudiante' => 'required|integer',
            'fecha_nacimiento_estudiante' => 'required|date',
            'celular_estudiante' => 'required|max:15|unique:usuarios,celular',
            'telefono_estudiante' => 'nullable|string|max:15',
            'correo_electronico_estudiante' => 'required|email|max:100|unique:usuarios,correo_electronico',
            'direccion_estudiante' => 'required|max:255',
            'id_grado' => 'required|exists:grados,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
            'acudiente_id' => 'required|exists:usuarios,id',
        ], [
            'documento_estudiante.required' => 'El número de documento es obligatorio.',
            'documento_estudiante.string' => 'El número de documento debe ser una cadena de texto.',
            'documento_estudiante.max' => 'El número de documento no puede superar los 20 caracteres.',
            'documento_estudiante.unique' => 'Este número de documento ya está registrado.',

            'primer_nombre_estudiante.required' => 'El primer nombre es obligatorio.',
            'primer_nombre_estudiante.string' => 'El primer nombre debe ser una cadena de texto.',
            'primer_nombre_estudiante.max' => 'El primer nombre no puede superar los 50 caracteres.',

            'segundo_nombre_estudiante.string' => 'El segundo nombre debe ser una cadena de texto.',
            'segundo_nombre_estudiante.max' => 'El segundo nombre no puede superar los 50 caracteres.',

            'primer_apellido_estudiante.required' => 'El primer apellido es obligatorio.',
            'primer_apellido_estudiante.string' => 'El primer apellido debe ser una cadena de texto.',
            'primer_apellido_estudiante.max' => 'El primer apellido no puede superar los 50 caracteres.',

            'segundo_apellido_estudiante.string' => 'El segundo apellido debe ser una cadena de texto.',
            'segundo_apellido_estudiante.max' => 'El segundo apellido no puede superar los 50 caracteres.',

            'edad_estudiante.required' => 'La edad es obligatoria.',
            'edad_estudiante.integer' => 'La edad debe ser un número entero.',
            'edad_estudiante.min' => 'La edad mínima permitida es 1 año.',

            'fecha_nacimiento_estudiante.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento_estudiante.date' => 'La fecha de nacimiento debe tener un formato válido.',

            'celular_estudiante.required' => 'El celular es obligatorio.',
            'celular_estudiante.unique' => 'Este celular ya está registrado.',
            'celular_estudiante.string' => 'El celular debe ser una cadena de texto.',
            'celular_estudiante.max' => 'El celular no puede superar los 15 caracteres.',

            'telefono_estudiante.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono_estudiante.max' => 'El teléfono no puede superar los 15 caracteres.',

            'correo_electronico_estudiante.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico_estudiante.email' => 'El correo electrónico debe tener un formato válido.',
            'correo_electronico_estudiante.max' => 'El correo electrónico no puede superar los 100 caracteres.',
            'correo_electronico_estudiante.unique' => 'Este correo electrónico ya está registrado.',

            'direccion_estudiante.required' => 'La dirección es obligatoria.',
            'direccion_estudiante.string' => 'La dirección debe ser una cadena de texto.',
            'direccion_estudiante.max' => 'La dirección no puede superar los 255 caracteres.',

            'id_grado.required' => 'El grado es obligatorio.',
            'id_grado.exists' => 'El grado seleccionado no es válido.',

            'id_tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'id_tipo_documento.exists' => 'El tipo de documento seleccionado no es válido.',

            'acudiente_id.exists' => 'El acudiente seleccionado no es válido.',
            'acudiente_id.required' => 'Debes seleccionar un acudiente si deseas registrar un nuevo estudiante.',
        ]);



        DB::beginTransaction();

        try {
            // Crear usuario con rol estudiante
            $rolEstudiante = Rol::where('nombre', 'Estudiante')->firstOrFail();

            $usuario = Usuario::create([
                'documento' => $request->documento_estudiante,
                'nombres' => trim($request->primer_nombre_estudiante . ' ' . $request->segundo_nombre_estudiante),
                'apellidos' => trim($request->primer_apellido_estudiante . ' ' . $request->segundo_apellido_estudiante),
                'correo_electronico' => $request->correo_electronico_estudiante,
                'celular' => $request->celular_estudiante,
                'contrasena' => Hash::make($request->documento_estudiante),
                'rol_id' => $rolEstudiante->id,
                'tipo_documento_id' => $request->id_tipo_documento,
            ]);

            // Crear estudiante (ya sin documento, correo ni celular)
            $estudiante = Estudiante::create([
                'usuario_id' => $usuario->id,
                'id_tipo_documento' => $request->id_tipo_documento,
                'primer_nombre_estudiante' => $request->primer_nombre_estudiante,
                'segundo_nombre_estudiante' => $request->segundo_nombre_estudiante,
                'primer_apellido_estudiante' => $request->primer_apellido_estudiante,
                'segundo_apellido_estudiante' => $request->segundo_apellido_estudiante,
                'edad_estudiante' => $request->edad_estudiante,
                'fecha_nacimiento_estudiante' => $request->fecha_nacimiento_estudiante,
                'telefono_estudiante' => $request->telefono_estudiante,
                'direccion_estudiante' => $request->direccion_estudiante,
                'id_grado' => $request->id_grado,
                'id_acudiente' => $request->acudiente_id,
            ]);

            $estudiante->matricula = 'MAT-' . date('Y') . '-' . str_pad($estudiante->id, 4, '0', STR_PAD_LEFT);
            $estudiante->save();

            if ($request->filled('acudiente_id')) {
                $estudiante->acudientes()->syncWithoutDetaching([$request->input('acudiente_id')]);
            }

            DB::commit();
            return redirect()->route('estudiantes.index')
                ->with('success', 'Estudiante creado exitosamente con matrícula: ' . $estudiante->matricula);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear estudiante: ' . $e->getMessage()]);
        }
    }

    // Mostrar los detalles de un estudiante específico
    public function show($id)
    {
        $estudiante = Estudiante::with(['grado', 'tipoDocumento', 'acudientes.rol'])
            ->findOrFail($id);

        // cargo relaciones útiles para la vista
        $estudiante = Estudiante::with(['observaciones.docente', 'acudientes'])->findOrFail($id);

        // traigo todos los docentes para el select
        $docentes = Docente::select('id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido')
            ->orderBy('primer_nombre')
            ->get();

        return view('estudiantes.show', compact('estudiante', 'docentes'));
    }

    // Mostrar el formulario para editar un estudiante y su grado
    public function edit(Estudiante $estudiante)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $grados = Grado::all();
        $tiposDocumentos = TipoDocumento::all();
        return view('estudiantes.edit', compact('estudiante', 'grados', 'tiposDocumentos'));
    }

    // Actualizar un estudiante
    public function update(Request $request, Estudiante $estudiante)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }


        $request->validate([
            'documento_estudiante' => 'required|string|max:20|unique:usuarios,documento,' . $estudiante->usuario_id,
            'primer_nombre_estudiante' => 'required|string|max:50',
            'segundo_nombre_estudiante' => 'nullable|string|max:50',
            'primer_apellido_estudiante' => 'required|string|max:50',
            'segundo_apellido_estudiante' => 'nullable|string|max:50',
            'edad_estudiante' => 'required|integer|min:1',
            'fecha_nacimiento_estudiante' => 'required|date',
            'celular_estudiante' => 'required|string|max:15|unique:usuarios,celular,' . $estudiante->usuario_id,
            'telefono_estudiante' => 'nullable|string|max:15',
            'correo_electronico_estudiante' => 'required|email|max:100|unique:usuarios,correo_electronico,' . $estudiante->usuario_id,
            'direccion_estudiante' => 'required|string|max:255',
            'id_grado' => 'required|exists:grados,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ], [
            'documento_estudiante.required' => 'El número de documento es obligatorio.',
            'documento_estudiante.string' => 'El número de documento debe ser una cadena de texto.',
            'documento_estudiante.max' => 'El número de documento no puede superar los 20 caracteres.',
            'documento_estudiante.unique' => 'Este número de documento ya está registrado.',

            'primer_nombre_estudiante.required' => 'El primer nombre es obligatorio.',
            'primer_nombre_estudiante.string' => 'El primer nombre debe ser una cadena de texto.',
            'primer_nombre_estudiante.max' => 'El primer nombre no puede superar los 50 caracteres.',

            'segundo_nombre_estudiante.string' => 'El segundo nombre debe ser una cadena de texto.',
            'segundo_nombre_estudiante.max' => 'El segundo nombre no puede superar los 50 caracteres.',

            'primer_apellido_estudiante.required' => 'El primer apellido es obligatorio.',
            'primer_apellido_estudiante.string' => 'El primer apellido debe ser una cadena de texto.',
            'primer_apellido_estudiante.max' => 'El primer apellido no puede superar los 50 caracteres.',

            'segundo_apellido_estudiante.string' => 'El segundo apellido debe ser una cadena de texto.',
            'segundo_apellido_estudiante.max' => 'El segundo apellido no puede superar los 50 caracteres.',

            'edad_estudiante.required' => 'La edad es obligatoria.',
            'edad_estudiante.integer' => 'La edad debe ser un número entero.',
            'edad_estudiante.min' => 'La edad mínima permitida es 1 año.',

            'fecha_nacimiento_estudiante.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento_estudiante.date' => 'La fecha de nacimiento debe tener un formato válido.',

            'celular_estudiante.required' => 'El celular es obligatorio.',
            'celular_estudiante.string' => 'El celular debe ser una cadena de texto.',
            'celular_estudiante.max' => 'El celular no puede superar los 15 caracteres.',

            'telefono_estudiante.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono_estudiante.max' => 'El teléfono no puede superar los 15 caracteres.',

            'correo_electronico_estudiante.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico_estudiante.email' => 'El correo electrónico debe tener un formato válido.',
            'correo_electronico_estudiante.max' => 'El correo electrónico no puede superar los 100 caracteres.',
            'correo_electronico_estudiante.unique' => 'Este correo electrónico ya está registrado.',

            'direccion_estudiante.required' => 'La dirección es obligatoria.',
            'direccion_estudiante.string' => 'La dirección debe ser una cadena de texto.',
            'direccion_estudiante.max' => 'La dirección no puede superar los 255 caracteres.',

            'id_grado.required' => 'El grado es obligatorio.',
            'id_grado.exists' => 'El grado seleccionado no es válido.',

            'id_tipo_documento.required' => 'El tipo de documento es obligatorio.',
            'id_tipo_documento.exists' => 'El tipo de documento seleccionado no es válido.',
        ]);

        DB::beginTransaction();

        try {
            //  Actualizar estudiante
            $estudiante->update([
                'primer_nombre_estudiante' => $request->primer_nombre_estudiante,
                'segundo_nombre_estudiante' => $request->segundo_nombre_estudiante,
                'primer_apellido_estudiante' => $request->primer_apellido_estudiante,
                'segundo_apellido_estudiante' => $request->segundo_apellido_estudiante,
                'edad_estudiante' => $request->edad_estudiante,
                'fecha_nacimiento_estudiante' => $request->fecha_nacimiento_estudiante,
                'telefono_estudiante' => $request->telefono_estudiante,
                'direccion_estudiante' => $request->direccion_estudiante,
                'id_grado' => $request->id_grado,
                'id_tipo_documento' => $request->id_tipo_documento,
            ]);

            // Actualizar usuario vinculado
            if ($estudiante->usuario) {
                $estudiante->usuario->update([
                    'documento' => $request->documento_estudiante,
                    'nombres' => trim($request->primer_nombre_estudiante . ' ' . $request->segundo_nombre_estudiante),
                    'apellidos' => trim($request->primer_apellido_estudiante . ' ' . $request->segundo_apellido_estudiante),
                    'correo_electronico' => $request->correo_electronico_estudiante,
                    'celular' => $request->celular_estudiante,
                    'tipo_documento_id' => $request->id_tipo_documento,
                ]);
            }

            if ($request->filled('acudiente_id')) {
                $estudiante->acudientes()->sync([$request->input('acudiente_id')]);
            } else {
                $estudiante->acudientes()->detach();
            }

            DB::commit();
            return redirect()->route('estudiantes.index')->with('success', 'Estudiante y usuario actualizados exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al actualizar estudiante: ' . $e->getMessage()]);
        }
    }

    public function destroy(Estudiante $estudiante)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante', 'Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }


        DB::beginTransaction();

        try {
            // Elimina primero el usuario vinculado si existe
            if ($estudiante->usuario) {
                $estudiante->usuario->delete();
            }

            // Luego elimina al estudiante
            $estudiante->delete();

            DB::commit();

            return redirect()->route('estudiantes.index')->with('success', 'Estudiante y usuario eliminados exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al eliminar estudiante: ' . $e->getMessage()]);
        }
    }

public function miInformacion()
{
    $usuario = Auth::user();

    // Traer estudiante con sus acudientes
    $estudiante = $usuario->estudiante;

    if (!$estudiante) {
        return redirect()->back()->with('error', 'No se encontró la información del estudiante.');
    }

    // Traer el primer acudiente asignado
    $acudiente = $estudiante->acudientes->first(); // null si no tiene acudiente

    return view('estudiantes.mi_informacion', compact('usuario', 'estudiante', 'acudiente'));
}

}
