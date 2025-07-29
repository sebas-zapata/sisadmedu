@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-light">Editar Usuario <i class="fas fa-edit"></i></h2>
    <hr>
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" id="formulario-usuario">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="documento" id="documento" class="form-control"
                    placeholder="Documento" value="{{ old('documento', $usuario->documento) }}">
                <label for="documento">Documento</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="nombres" id="nombres" class="form-control"
                    placeholder="Nombres" value="{{ old('nombres', $usuario->nombres) }}">
                <label for="nombres">Nombres</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="apellidos" id="apellidos" class="form-control"
                    placeholder="Apellidos" value="{{ old('apellidos', $usuario->apellidos) }}">
                <label for="apellidos">Apellidos</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <input type="email" name="correo_electronico" id="correo_electronico" class="form-control"
                    placeholder="Correo Electrónico" value="{{ old('correo_electronico', $usuario->correo_electronico) }}">
                <label for="correo_electronico">Correo Electrónico</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="text" name="telefono" id="telefono" class="form-control"
                    placeholder="Teléfono" value="{{ old('telefono', $usuario->telefono) }}">
                <label for="telefono">Teléfono</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-floating">
                <input type="password" name="contrasena" id="contrasena" class="form-control"
                    placeholder="Nueva Contraseña">
                <label for="contrasena">Nueva Contraseña (opcional)</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-floating">
                <select name="rol_id" id="rol_id" class="form-select" required>
                    <option disabled>Selecciona un rol</option>
                    {{-- Asumiendo que $roles es una colección de roles pasados desde el controlador --}}
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ $usuario->rol_id == $rol->id ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
                <label for="rol_id">Rol</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-floating">
                <select name="tipo_documento_id" id="tipo_documento_id" class="form-select">
                    <option disabled>Selecciona un tipo</option>
                    {{-- Asumiendo que $tiposDocumento es una colección de tipos de documento pasados desde el controlador --}}
                    @foreach($tiposDocumento as $tipo)
                        <option value="{{ $tipo->id }}" {{ $usuario->tipo_documento_id == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->descripcion }}
                        </option>
                    @endforeach
                </select>
                <label for="tipo_documento_id">Tipo de Documento</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <x-boton-principal href="{{ route('usuarios.index') }}">
            <i class="fas fa-arrow-left"></i> Cancelar
        </x-boton-principal>
        <x-boton-principal type="submit">
            <i class="fa-solid fa-rotate-right"></i> Actualizar
        </x-boton-principal>
    </div>
</form>

</div>
@endsection