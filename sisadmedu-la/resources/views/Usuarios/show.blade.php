@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-light">Detalles del Usuario <i class="fas fa-user-circle me-2"></i></h2>
    <hr>

    <div class="card shadow rounded-4 border-0">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>ID:</strong></p>
                    <p>{{ $usuario->id }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Documento:</strong></p>
                    <p>{{ $usuario->documento }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Nombre completo:</strong></p>
                    <p>{{ $usuario->nombres }} {{ $usuario->apellidos }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Correo electrónico:</strong></p>
                    <p>{{ $usuario->correo_electronico }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Teléfono:</strong></p>
                    <p>{{ $usuario->telefono }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Rol:</strong></p>
                    <p>{{ $usuario->rol->nombre ?? 'Sin rol' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Tipo de documento:</strong></p>
                    <p>{{ $usuario->tipoDocumento->descripcion ?? 'Sin tipo' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Fecha de creación:</strong></p>
                    <p>{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1 text-muted"><strong>Última actualización:</strong></p>
                    <p>{{ $usuario->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        <x-boton-principal href="{{ route('usuarios.index') }}">
            <i class="fas fa-arrow-left me-1"></i> Volver al listado
        </x-boton-principal>
        <x-boton-principal href="{{ route('usuarios.edit', $usuario->id) }}">
            <i class="fas fa-edit"></i> Editar usuario
        </x-boton-principal>
    </div>
</div>
@endsection