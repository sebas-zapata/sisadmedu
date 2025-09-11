@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('contenido')

{{-- Mensaje de error --}}
@if(session('error'))
<div id="session-error" data-error="{{ session('error') }}"></div>
@endif
<div class="login-container">
    <div id="particles-js"></div>

    <div class="login-box">
        {{-- Logo --}}
        <img src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo SISADMEDU" class="mb-3">

        {{-- Nombre del sistema y bienvenida --}}
        <h2 class="fw-bold">SISADMEDU</h2>
        <p class="text-muted mb-4">Bienvenido, por favor ingresa tus credenciales.</p>

        {{-- Formulario de acceso --}}
        <form id="loginForm" action="{{ route('login.post') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" placeholder="Correo electrónico" value="{{ old('correo_electronico') }}">
                <label for="correo_electronico">Correo electrónico</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
                <label for="contrasena">Contraseña</label>
            </div>
            <button class="btn-login w-100" type="submit">
                Acceder
            </button>
        </form>

        {{-- Link de recuperación y seguridad --}}
        <hr>
        <div class="mt-4 text-center small text-muted">
           <a class="text-decoration-none">¿Olvidaste tu contraseña?</a>
            <div class="mt-2">
                <i class="fas fa-lock me-1"></i> Conexión segura
            </div>
        </div>
    </div>

</div>
@endsection