<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoRecuperacionMail;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    // 1. Mostrar formulario para ingresar el correo
    public function showEmailForm()
    {
        return view('auth.forgot-password');
    }

    // 2. Enviar código inicial
    public function sendCode(Request $request)
    {
        $request->validate(
            [
                'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
            ],
            [
                'correo_electronico.required' => 'El correo electrónico es obligatorio.',
                'correo_electronico.email'    => 'Ingresa un correo electrónico válido.',
                'correo_electronico.exists'   => 'No existe una cuenta con este correo electrónico.',
            ]
        );

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        //  Generar y enviar código
        $this->generateAndSendCode($user);

        // Guardamos el correo en sesión
        session(['email' => $user->correo_electronico]);

        return redirect()->route('password.verify.form')
            ->with('success', 'Se ha enviado un código de verificación a tu correo.');
    }

    // Método privado para no repetir código
    private function generateAndSendCode($user)
    {
        $code = rand(100000, 999999);

        $user->reset_code = $code;
        $user->reset_code_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        Mail::to($user->correo_electronico)->send(new CodigoRecuperacionMail($user, $code));
    }

    // 3. Mostrar formulario para ingresar el código
    public function showVerifyForm()
    {
        $email = session('email');
        return view('auth.verify-code', compact('email'));
    }

    // 4. Verificar código
    public function verifyCode(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
            'code' => 'required|digits:6',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)->first();

        if (!$user || $user->reset_code !== $request->code || Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()->withErrors(['code' => 'El código no es válido o ha expirado.'])->withInput();
        }

        // Guardar correo y código en sesión para reset
        session(['email' => $user->correo_electronico, 'code' => $request->code]);

        return redirect()->route('password.reset.form');
    }

    // 5. Mostrar formulario para nueva contraseña
    public function showResetForm()
    {
        $email = session('email');
        $code = session('code');
        return view('auth.reset-password', compact('email', 'code'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|email|exists:usuarios,correo_electronico',
            'code' => 'required|digits:6',
            'contrasena' => 'required|min:6|confirmed',
        ]);

        $user = Usuario::where('correo_electronico', $request->correo_electronico)
            ->where('reset_code', $request->code)
            ->first();

        if (!$user || Carbon::now()->greaterThan($user->reset_code_expires_at)) {
            return back()
                ->withErrors(['code' => 'El código no es válido o ha expirado.'])
                ->withInput();
        }

        if ($request->contrasena === $user->documento) {
            return back()
                ->withErrors(['contrasena' => 'La contraseña no puede ser igual a tu documento.'])
                ->withInput();
        }

        $user->contrasena = Hash::make($request->contrasena);
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Tu contraseña ha sido restablecida correctamente.');
    }
}
