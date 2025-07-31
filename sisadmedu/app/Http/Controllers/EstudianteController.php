<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use App\Models\Grado;

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
        return view('estudiantes.create', compact('grados'));
    }

    // Guardar un nuevo estudiante y asignar un grado
    public function store(Request $request)
    {
        $request->validate([
            'id_documento_estudiante' => 'required|string|max:20|unique:estudiantes',
            'codigo_estudiante' => 'required|string|max:10',
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
            'id_grado' => 'required|exists:grados,id', // Validar que el grado exista
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
        $grados = Grado::all(); // Obtener todos los grados para el formulario
        return view('estudiantes.edit', compact('estudiante', 'grados'));
    }


    // Actualizar un estudiante y su grado
    public function update(Request $request, Estudiante $estudiante)
    {
        $request->validate([
            'id_documento_estudiante' => 'required|string|max:20|unique:estudiantes,id_documento_estudiante,' . $estudiante->id_documento_estudiante,
            'codigo_estudiante' => 'required|string|max:10',
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
            'id_grado' => 'required|exists:grados,id', // Validar que el grado exista
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
