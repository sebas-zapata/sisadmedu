@php($ocultarNavbar = true)
@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('contenido')
{{-- Cargar loader oculto --}}
@include('auth.partials._loader_sistema')

{{-- Mensaje de error general de autenticación --}}
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

        {{-- Mensaje dinámico de bienvenida o error --}}
        @if(session('error'))
        <div class="alert alert-danger text-center mb-4" role="alert">
            {{ session('error') }}
        </div>
        @else
        <p class="text-muted small mb-4">
            <i class="fas fa-graduation-cap text-secondary"></i>
            Bienvenido al <strong>Sistema Académico.</strong> <br> Accede con tus credenciales institucionales.
        </p>

        @endif



        {{-- Formulario de acceso --}}
        <form id="loginForm" action="{{ route('login.post') }}" method="POST" autocomplete="off">
            @csrf

            {{-- Correo electrónico --}}
            <div class="form-floating mb-3">
                <input type="text"
                    class="form-control @error('correo_electronico') is-invalid @enderror"
                    id="correo_electronico"
                    name="correo_electronico"
                    placeholder="Correo electrónico"
                    value="{{ old('correo_electronico') }}"
                    >
                <label for="correo_electronico">Correo electrónico</label>

                @error('correo_electronico')
                <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Contraseña --}}
            <div class="form-floating mb-4">
                <input type="password"
                    class="form-control @error('contrasena') is-invalid @enderror"
                    id="contrasena"
                    name="contrasena"
                    placeholder="Contraseña">
                <label for="contrasena">Contraseña</label>
                <i id="togglePassword" class="fa-solid fa-eye"
                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none;"></i>
                @error('contrasena')
                <div class="text-danger mt-1 px-2 py-1" style="background-color:#ffe6e6; border-radius:4px;">
                    {{ $message }}
                </div>
                @enderror
            </div>

            {{-- Botón de acceso --}}
            <button class="btn-login w-100" id="btnAcceder" type="submit">
                <i class="fas fa-sign-in-alt me-2"></i> Acceder
            </button>
        </form>

        {{-- Link de recuperación y seguridad --}}
        <hr>
        <div class="mt-4 text-center small text-muted">
            <a class="text-decoration-none" id="btnAcceder" href="{{ route('password.forgot') }}">
                ¿Olvidaste tu contraseña?
            </a>

            <div class="mt-2">
                <i class="fas fa-lock me-1"></i> Conexión segura
            </div>
        </div>
    </div>
</div>
@endsection