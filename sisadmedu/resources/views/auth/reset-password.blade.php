@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Restablecer contraseña')

@section('contenido')
<div class="login-container">
    <div class="login-box">
        <h2 class="fw-bold">Restablecer contraseña</h2>
        <p class="text-muted mb-4">Ingresa tu nueva contraseña para tu cuenta.</p>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.reset') }}" method="POST">
            @csrf
            <input type="hidden" name="correo_electronico" value="{{ $email }}">
            <input type="hidden" name="code" value="{{ $code }}">

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Nueva contraseña" required>
                <label for="contrasena">Nueva contraseña</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="contrasena_confirmation" name="contrasena_confirmation" placeholder="Confirmar contraseña" required>
                <label for="contrasena_confirmation">Confirmar contraseña</label>
            </div>

            <button class="btn-login w-100" type="submit">Restablecer contraseña</button>
        </form>

        <hr>
        <div class="mt-3 text-center small">
            <a href="{{ route('login') }}" class="text-decoration-none">Volver al inicio de sesión</a>
        </div>
    </div>
</div>
@endsection
