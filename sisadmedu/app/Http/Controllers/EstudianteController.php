<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\Grado;
use App\Models\TipoDocumento;

class EstudianteController extends Controller
{
    // Listar estudiantes y sus grados
    public function index()
    {
        $estudiantes = Estudiante::with('grado')->paginate(5);
        return view('estudiantes.index', compact('estudiantes'));
    }

    // Mostrar el formulario para crear un nuevo estudiante y asignar un grado
    public function create()
    {
        $grados = Grado::all(); // Obtener todos los grados para el formulario
        $tiposDocumentos = TipoDocumento::all(); // Obtener todos los tipos de documento
        return view('estudiantes.create', compact('grados', 'tiposDocumentos'));
    }

    // Guardar un nuevo estudiante y asignar un grado
    public function store(Request $request)
    {
        $request->validate([
            'documento_estudiante' => 'required|string|max:20|unique:estudiantes,documento_estudiante',
            'primer_nombre_estudiante' => 'required|string|max:50',
            'segundo_nombre_estudiante' => 'nullable|string|max:50',
            'primer_apellido_estudiante' => 'required|string|max:50',
            'segundo_apellido_estudiante' => 'nullable|string|max:50',
            'edad_estudiante' => 'required|integer|min:1',
            'fecha_nacimiento_estudiante' => 'required|date',
            'celular_estudiante' => 'required|string|max:15',
            'telefono_estudiante' => 'required|string|max:15',
            'correo_electronico_estudiante' => 'required|email|max:100|unique:estudiantes,correo_electronico_estudiante',
            'direccion_estudiante' => 'required|string|max:255',
            'id_grado' => 'required|exists:grados,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
            'acudiente_id' => 'nullable|exists:usuarios,id',
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

            'telefono_estudiante.required' => 'El teléfono es obligatorio.',
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
        ]);



        // guardamos el estudiante sin matricula aca
        $estudiante = Estudiante::create($request->all());

        // Generamos la matrícula única (ejemplo: MAT-2025-0001)
        $estudiante->matricula = 'MAT-' . date('Y') . '-' . str_pad($estudiante->id, 4, '0', STR_PAD_LEFT);

        // Guardamos el cambio
        $estudiante->save();

        if ($request->filled('acudiente_id')) {
            // Añade la relación si no existe (no rompe otras relaciones)
            $estudiante->acudientes()->syncWithoutDetaching([$request->input('acudiente_id')]);
        }

        return redirect()->route('estudiantes.index')
            ->with('success', 'Estudiante creado exitosamente con matrícula: ' . $estudiante->matricula);
    }

    // Mostrar los detalles de un estudiante específico y su grado
    public function show($id)
    {
        $estudiante = Estudiante::with(['grado', 'tipoDocumento', 'acudientes.rol'])
            ->findOrFail($id);

        return view('estudiantes.show', compact('estudiante'));
    }

    // Mostrar el formulario para editar un estudiante y su grado
    public function edit(Estudiante $estudiante)
    {
        $grados = Grado::all();
        $tiposDocumentos = TipoDocumento::all();
        return view('estudiantes.edit', compact('estudiante', 'grados', 'tiposDocumentos'));
    }

    // Actualizar un estudiante y su grado
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'documento_estudiante' => 'required|string|max:20|unique:estudiantes,documento_estudiante,' . $estudiante->id,
            'primer_nombre_estudiante' => 'required|string|max:50',
            'segundo_nombre_estudiante' => 'nullable|string|max:50',
            'primer_apellido_estudiante' => 'required|string|max:50',
            'segundo_apellido_estudiante' => 'nullable|string|max:50',
            'edad_estudiante' => 'required|integer|min:1',
            'fecha_nacimiento_estudiante' => 'required|date',
            'celular_estudiante' => 'required|string|max:15',
            'telefono_estudiante' => 'required|string|max:15',
            'correo_electronico_estudiante' => 'required|email|max:100|unique:estudiantes,correo_electronico_estudiante,' . $estudiante->id,
            'direccion_estudiante' => 'required|string|max:255',
            'id_grado' => 'required|exists:grados,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
            'acudiente_id' => 'nullable|exists:usuarios,id',
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

            'telefono_estudiante.required' => 'El teléfono es obligatorio.',
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



        $estudiante->update($request->all());

        if ($request->filled('acudiente_id')) {
            // Reemplaza las relaciones actuales por la seleccionada
            $estudiante->acudientes()->sync([$request->input('acudiente_id')]);
        } else {
            // Si no selecciona ninguno, quita todas las relaciones (opcional)
            $estudiante->acudientes()->detach();
        }

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente.');
    }

    // Eliminar un estudiante
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente.');
    }
}
