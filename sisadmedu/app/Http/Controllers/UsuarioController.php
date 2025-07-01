<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with(['rol', 'tipoDocumento'])->get(); // 👈 Sin 'grupo'
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        $tiposDocumento = TipoDocumento::all();
        return view('usuarios.create', compact('roles', 'tiposDocumento')); // 👈 Sin $grupos
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento' => 'required|unique:usuarios',
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios',
            'telefono' => 'required|unique:usuarios',
            'contrasena' => 'required|min:6',
            'rol_id' => 'required|exists:roles,id',
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
        ]);

        $datos = $request->all();
        $datos['contrasena'] = Hash::make($request->contrasena);

        Usuario::create($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $usuario = Usuario::with(['rol', 'tipoDocumento'])->findOrFail($id); // 👈 Sin 'grupo'
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        $tiposDocumento = TipoDocumento::all();
        return view('usuarios.edit', compact('usuario', 'roles', 'tiposDocumento')); // 👈 Sin $grupos
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'documento' => 'required|unique:usuarios,documento,' . $id,
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . $id,
            'telefono' => 'required|unique:usuarios,telefono,' . $id,
            'rol_id' => 'required|exists:roles,id',
            'tipo_documento_id' => 'required|exists:tipos_documento,id',
        ]);

        $datos = $request->all();

        if ($request->filled('contrasena')) {
            $datos['contrasena'] = Hash::make($request->contrasena);
        } else {
            $datos['contrasena'] = $usuario->contrasena;
        }

        $usuario->update($datos);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
