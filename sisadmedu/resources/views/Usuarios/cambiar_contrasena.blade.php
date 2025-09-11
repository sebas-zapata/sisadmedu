{{-- resources/views/usuarios/cambiar_contrasena.blade.php --}}
@extends('layouts.form')

@section('titulo-formulario')
    Cambiar Contraseña <i class="fas fa-key"></i>
@endsection

@section('id-form', 'formulario-cambiar-contrasena')

@section('ruta-accion', route('actualizar_contraseña'))

{{-- Para futuros PUT en edición --}}
@section('metodo')
    {{-- @method('PUT') --}}
@endsection

{{-- CAMPOS DEL FORMULARIO --}}
@section('campos-formulario')

    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <!-- Nueva contraseña -->
    <div class="form-floating mb-3">
        <input type="password" name="nueva_contrasena" id="nueva_contrasena"
               class="form-control @error('nueva_contrasena') is-invalid @enderror"
               placeholder="Nueva Contraseña" required>
        <label for="nueva_contrasena">Nueva Contraseña</label>
        @error('nueva_contrasena')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Confirmar contraseña -->
    <div class="form-floating mb-3">
        <input type="password" name="nueva_contrasena_confirmation" id="nueva_contrasena_confirmation"
               class="form-control @error('nueva_contrasena_confirmation') is-invalid @enderror"
               placeholder="Confirmar Contraseña" required>
        <label for="nueva_contrasena_confirmation">Confirmar Contraseña</label>
        @error('nueva_contrasena_confirmation')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">
                {{ $message }}
            </div>
        @enderror
    </div>

@endsection

{{-- BOTONES DEL FORMULARIO --}}
@section('botones-formulario')
    <x-boton-principal type="submit">
        <i class="fas fa-save"></i> Actualizar Contraseña
    </x-boton-principal>
@endsection
