<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginUsuario;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contrasena' => 'required',
        ]);

        $usuario = LoginUsuario::where('correo_electronico', $request->correo_electronico)->first();

        if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
            Auth::login($usuario);

            // ✅ Envía mensaje de éxito a la sesión
            return redirect()->intended('/')
                ->with('success', 'Bienvenido, has iniciado sesión correctamente');
        }

        // Si fallan las credenciales
        return back()->with('error', 'Credenciales incorrectas');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        // Invalida la sesión actual y regenera el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
