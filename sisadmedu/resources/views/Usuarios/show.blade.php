@extends('layouts.app')

@section('contenido')
<div class="container py-4">
    <h2 class="text-center text-light">Detalles del Usuario <i class="fas fa-user-circle me-2"></i></h2>
    <hr>

<div class="card shadow-lg border-0 rounded-4 p-4">
    <div class="text-center">
        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle shadow mb-3" width="100" height="100">
        <h4 class="fw-bold mb-0">{{ $usuario->nombres }} {{ $usuario->apellidos }}</h4>
        <p class="text-muted">{{ $usuario->rol->nombre ?? 'Sin rol' }}</p>
        <hr class="my-4">
    </div>

    <div class="row mb-3">
        <div class="col-md-6 mb-3 text-center">
            <i class="fas fa-id-card me-2 text-light"></i>
            <strong>Documento:</strong>
            <p class="mb-0">{{ $usuario->documento }}</p>
        </div>

        <div class="col-md-6 mb-3 text-center">
            <i class="fas fa-envelope me-2 text-light"></i>
            <strong>Correo electrónico:</strong>
            <p class="mb-0">{{ $usuario->correo_electronico }}</p>
        </div>

        <div class="col-md-6 mb-3 text-center">
            <i class="fas fa-phone me-2 text-light"></i>
            <strong>Teléfono:</strong>
            <p class="mb-0">{{ $usuario->telefono }}</p>
        </div>

        <div class="col-md-6 mb-3 text-center">
            <i class="fas fa-id-badge me-2 text-light"></i>
            <strong>Tipo de documento:</strong>
            <p class="mb-0">{{ $usuario->tipoDocumento->descripcion ?? 'Sin tipo' }}</p>
        </div>

        <div class="col-md-6 mb-3 text-center">
            <i class="fas fa-calendar-plus me-2 text-light"></i>
            <strong>Fecha de creación:</strong>
            <p class="mb-0">{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="col-md-6 mb-3 text-center">
            <i class="fas fa-calendar-alt me-2 text-light"></i>
            <strong>Última actualización:</strong>
            <p class="mb-0">{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <x-boton-principal href="{{ route('usuarios.index') }}">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </x-boton-principal>
        <x-boton-principal href="{{ route('usuarios.edit', $usuario->id) }}">
            <i class="fas fa-edit me-1"></i> Editar
        </x-boton-principal>
    </div>
</div>

</div>
@endsection