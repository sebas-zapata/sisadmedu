<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;

class MateriaController extends Controller
{
    public function index()
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $materias = Materia::orderBy('id', 'desc')->get();
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        return view('materias.create');
    }

    public function store(Request $request)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $request->validate(
            [
                'descripcion' => 'required|string|max:255|unique:materias,descripcion',
            ],
            [
                'descripcion.required' => 'La descripción es obligatoria.',
                'descripcion.string' => 'La descripción debe ser un texto válido.',
                'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
                'descripcion.unique' => 'Esta descripción ya existe, por favor ingrese otra.',
            ]
        );

        Materia::create([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('materias.index')
                         ->with('success', 'Materia creada correctamente.');
    }

    public function show($id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $materia = Materia::with('docentes')->findOrFail($id); // cargamos los docentes relacionados
        return view('materias.show', compact('materia'));
    }

    public function edit($id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $materia = Materia::findOrFail($id);
        return view('materias.edit', compact('materia'));
    }

    public function update(Request $request, $id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }

        $materia = Materia::findOrFail($id);

        $request->validate(
            [
                'descripcion' => 'required|string|max:255|unique:materias,descripcion,' . $materia->id,
            ],
            [
                'descripcion.required' => 'La descripción es obligatoria.',
                'descripcion.string' => 'La descripción debe ser un texto válido.',
                'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
                'descripcion.unique' => 'Esta descripción ya existe, por favor ingrese otra.',
            ]
        );

        $materia->update([
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('materias.index')
                         ->with('success', 'Materia actualizada correctamente.');
    }

    public function destroy($id)
    {
        if (in_array(Auth::user()->rol->nombre, ['Docente', 'Estudiante','Acudiente'])) {
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permisos para realizar esta acción.');
        }
        
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect()->route('materias.index')
                         ->with('success', 'Materia eliminada correctamente.');
    }
}
