<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoginUsuario;


class LoginController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    // Verifica si el usuario ya está autenticado
    // Si está autenticado, redirige al dashboard
    // Si no, muestra el formulario de inicio de sesión
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }



    // Método para manejar el inicio de sesión
    // Validación de las credenciales del usuario
    // Si las credenciales son correctas, se inicia sesión
    // Si las credenciales son incorrectas, se redirige de vuelta con un mensaje
    // de error
    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email',
            'contrasena' => 'required',
        ]);

        $usuario = LoginUsuario::where('correo_electronico', $request->correo_electronico)->first();

        if ($usuario && Hash::check($request->contrasena, $usuario->contrasena)) {
            Auth::login($usuario);

            return redirect()->intended('/')
                ->with('success', 'Bienvenido, has iniciado sesión correctamente');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }


    // Método para cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        // Invalida la sesión actual y regenera el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente');
    }
}
