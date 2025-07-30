<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function edit()
    {
        $usuario = Auth::user();
        return view('perfil.edit', compact('usuario'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'correo_electronico' => 'required|email|unique:usuarios,correo_electronico,' . Auth::id(),
            'telefono' => 'required|unique:usuarios,telefono,' . Auth::id(),
            'contrasena' => 'nullable|min:6',
        ]);
        
        $usuario = Auth::user();
        dd($usuario);

        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->correo_electronico = $request->correo_electronico;
        $usuario->telefono = $request->telefono;

        if ($request->filled('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
        }

        $usuario->save();
        return redirect()->route('perfil.edit')->with('success', 'Perfil actualizado correctamente.');
    }
}

