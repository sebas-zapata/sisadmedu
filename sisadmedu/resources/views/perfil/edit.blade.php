{{-- resources/views/usuarios/perfil.blade.php --}}
@extends('layouts.form')

@section('titulo-formulario')
<i class="fas fa-user-edit"></i> Editar informacion
@endsection

@section('id-form', 'form-editar-perfil')

@section('ruta-accion', route('perfil.update'))

@section('metodo')
@method('PUT')
@endsection

@section('campos-formulario')
<div class="row">
    <div class="col-12 mb-1 p-1 text-center">
        <img src="{{ Avatar::create($usuario->nombres . ' ' . $usuario->apellidos)->toBase64() }}"
            alt="Avatar de {{ $usuario->nombres }}"
            class="rounded-circle shadow-sm border border-3"
            style="border-color: #461c68;"
            width="110"
            height="110">
        <h4 class="mt-3 mb-0 fw-bold text-dark">
            {{ $usuario->nombres }} {{ $usuario->apellidos }}
        </h4>
        <span class="badge mt-2 px-3 py-2 fs-6 text-white" style="background-color: #461c68;">
            Rol: {{ $usuario->rol->nombre ?? 'Sin rol' }}
        </span>
    </div>
    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" name="nombres" id="nombres"
                class="form-control @error('nombres') is-invalid @enderror"
                value="{{ old('nombres', $usuario->nombres) }}" required>
            <label for="nombres">Nombres</label>
            @error('nombres')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" name="apellidos" id="apellidos"
                class="form-control @error('apellidos') is-invalid @enderror"
                value="{{ old('apellidos', $usuario->apellidos) }}" required>
            <label for="apellidos">Apellidos</label>
            @error('apellidos')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="email" name="correo_electronico" id="correo_electronico_perfil"
                class="form-control @error('correo_electronico') is-invalid @enderror"
                value="{{ old('correo_electronico', $usuario->correo_electronico) }}" required>
            <label for="correo_electronico">No disponible</label>
            @error('correo_electronico')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating mb-3">
            <input type="text" name="celular" id="celular" class="form-control @error('celular') is-invalid @enderror" value="{{ old('celular', $usuario->celular) }}" required>
            <label for="celular">Celular</label>
            @error('celular')
            <div class="text-danger mt-1 px-2 py-1"
                style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="contrasena" id="contrasena"
                class="form-control @error('contrasena') is-invalid @enderror"
                placeholder="Dejar en blanco si no deseas cambiarla">
            <label for="contrasena">Contraseña (opcional)</label>
            @error('contrasena')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" name="contrasena_confirmation" id="contrasena_confirmation"
                class="form-control @error('contrasena_confirmation') is-invalid @enderror"
                placeholder="Repite la contraseña">
            <label for="contrasena_confirmation">Confirmar contraseña</label>
            @error('contrasena_confirmation')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>


@endsection

@section('botones-formulario')
<x-boton-principal href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
    <i class="fas fa-arrow-left"></i> Volver
</x-boton-principal>

<x-boton-principal type="submit">
    <i class="fas fa-user-plus"></i> Guardar
</x-boton-principal>
@endsection