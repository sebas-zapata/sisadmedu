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
            'celular_estudiante' => 'nullable|string|max:15',
            'telefono_estudiante' => 'nullable|string|max:15',
            'correo_electronico_estudiante' => 'nullable|email|max:100',
            'direccion_estudiante' => 'nullable|string|max:255',
            'id_grado' => 'required|exists:grados,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ]);

        Estudiante::create($request->all());

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado exitosamente.');
    }

    // Mostrar los detalles de un estudiante específico y su grado
    public function show(Estudiante $estudiante)
    {
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
            'celular_estudiante' => 'nullable|string|max:15',
            'telefono_estudiante' => 'nullable|string|max:15',
            'correo_electronico_estudiante' => 'nullable|email|max:100',
            'direccion_estudiante' => 'nullable|string|max:255',
            'id_grado' => 'required|exists:grados,id',
            'id_tipo_documento' => 'required|exists:tipos_documento,id',
        ]);

        $estudiante->update($request->all());

        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado exitosamente.');
    }

    // Eliminar un estudiante
    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado exitosamente.');
    }
}
