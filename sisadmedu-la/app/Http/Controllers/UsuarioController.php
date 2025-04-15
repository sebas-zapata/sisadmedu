<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\TipoDocumento;
use App\Models\Rol;
use App\Models\Grupo;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar lista de usuarios
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Mostrar formulario para crear usuario
     */
    public function create()
    {
        $tiposDocumento = TipoDocumento::all();
        $roles = Rol::all();
        $grupos = Grupo::all();
        
        return view('usuarios.create', compact('tiposDocumento', 'roles', 'grupos'));
    }

    /**
     * Almacenar nuevo usuario
     */
    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'documento_usuario' => 'required|unique:usuarios',
            'nombres_usuario' => 'required',
            'apellidos_usuario' => 'required',
            'telefono_usuario' => 'required|unique:usuarios',
            'contrasena_usuario' => 'required',
            'rol_id_rol' => 'required',
            'tipo_documento_codigo_tipo_documento' => 'required',
            'correo_electronico_usuario' => 'required|email'
        ]);
        
        // Preparar los datos del usuario
        $datos = $request->all();
        
        // Encriptar contraseña
        $datos['contrasena_usuario'] = Hash::make($request->contrasena_usuario);
        
        // Asignar grupo solo si es estudiante
        $rolEstudiante = Rol::where('rol', 'Estudiante')->first();
        if ($request->rol_id_rol == $rolEstudiante->id_rol) {
            $datos['grupo_id_grupo'] = $request->grupo_id_grupo;
        } else {
            $datos['grupo_id_grupo'] = null;
        }
        
        // Asignar valores de los otros campos de rol para mantener integridad
        $datos['rol_id_rol1'] = $request->rol_id_rol;
        $datos['id_rol'] = $request->rol_id_rol;
        
        // Crear usuario
        Usuario::create($datos);
        
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente');
    }

    /**
     * Mostrar un usuario específico
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Mostrar formulario para editar usuario
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $tiposDocumento = TipoDocumento::all();
        $roles = Rol::all();
        $grupos = Grupo::all();
        
        return view('usuarios.edit', compact('usuario', 'tiposDocumento', 'roles', 'grupos'));
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, $id)
    {
        // Validación
        $request->validate([
            'documento_usuario' => 'required|unique:usuarios,documento_usuario,' . $id . ',id_usuario',
            'nombres_usuario' => 'required',
            'apellidos_usuario' => 'required',
            'telefono_usuario' => 'required|unique:usuarios,telefono_usuario,' . $id . ',id_usuario',
            'rol_id_rol' => 'required',
            'tipo_documento_codigo_tipo_documento' => 'required',
            'correo_electronico_usuario' => 'required|email'
        ]);
        
        $usuario = Usuario::findOrFail($id);
        $datos = $request->all();
        
        // Si se proporciona una nueva contraseña, encriptarla
        if (!empty($request->contrasena_usuario)) {
            $datos['contrasena_usuario'] = Hash::make($request->contrasena_usuario);
        } else {
            // Mantener la contraseña actual
            $datos['contrasena_usuario'] = $usuario->contrasena_usuario;
        }
        
        // Asignar grupo solo si es estudiante
        $rolEstudiante = Rol::where('rol', 'Estudiante')->first();
        if ($request->rol_id_rol == $rolEstudiante->id_rol) {
            $datos['grupo_id_grupo'] = $request->grupo_id_grupo;
        } else {
            $datos['grupo_id_grupo'] = null;
        }
        
        // Actualizar los otros campos de rol
        $datos['rol_id_rol1'] = $request->rol_id_rol;
        $datos['id_rol'] = $request->rol_id_rol;
        
        $usuario->update($datos);
        
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Eliminar usuario
     */
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado correctamente');
    }
}
