@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Recuperar contraseña')

@section('contenido')
<div class="login-container">
    <div id="particles-js"></div>
    <div class="login-box">
        <h2 class="fw-bold">¿Olvidaste tu contraseña?</h2>
        <p class="text-muted mb-4">Ingresa tu correo electrónico y te enviaremos un código de verificación.</p>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.send.code') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Correo electrónico" required>
                <label for="correo_electronico">Correo electrónico</label>
            </div>

            <button class="btn-login w-100" type="submit">Enviar código</button>
        </form>

        <hr>
        <div class="mt-3 text-center small">
            <a href="{{ route('login') }}" class="text-decoration-none">Volver al inicio de sesión</a>
        </div>
    </div>
</div>
@endsection
