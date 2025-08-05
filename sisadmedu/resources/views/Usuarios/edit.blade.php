@extends('layouts.form')

@section('titulo-formulario')
    Editar Usuario <i class="fas fa-user-edit"></i>
@endsection

@section('id-form', 'formulario-usuario')

@section('ruta-accion', route('usuarios.update', $usuario->id))

@section('metodo')
    @method('PUT')
@endsection

@section('campos-formulario')
<div class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="documento" id="documento"
            class="form-control @error('documento') is-invalid @enderror"
            placeholder="Documento" value="{{ old('documento', $usuario->documento) }}">
        @error('documento')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <input type="text" name="nombres" id="nombres"
            class="form-control @error('nombres') is-invalid @enderror"
            placeholder="Nombres" value="{{ old('nombres', $usuario->nombres) }}">
        @error('nombres')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <input type="text" name="apellidos" id="apellidos"
            class="form-control @error('apellidos') is-invalid @enderror"
            placeholder="Apellidos" value="{{ old('apellidos', $usuario->apellidos) }}">
        @error('apellidos')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <input type="email" name="correo_electronico" id="correo_electronico"
            class="form-control @error('correo_electronico') is-invalid @enderror"
            placeholder="Correo Electrónico" value="{{ old('correo_electronico', $usuario->correo_electronico) }}">
        @error('correo_electronico')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <input type="text" name="telefono" id="telefono"
            class="form-control @error('telefono') is-invalid @enderror"
            placeholder="Teléfono" value="{{ old('telefono', $usuario->telefono) }}">
        @error('telefono')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <input type="password" name="contrasena" id="contrasena"
            class="form-control @error('contrasena') is-invalid @enderror"
            placeholder="Nueva Contraseña (opcional)">
        @error('contrasena')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <select name="rol_id" id="rol_id"
            class="form-select @error('rol_id') is-invalid @enderror">
            <option disabled selected>Selecciona un rol</option>
            @foreach($roles as $rol)
                <option value="{{ $rol->id }}" {{ old('rol_id', $usuario->rol_id) == $rol->id ? 'selected' : '' }}>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>
        @error('rol_id')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4">
        <select name="tipo_documento_id" id="tipo_documento_id"
            class="form-select @error('tipo_documento_id') is-invalid @enderror">
            <option disabled selected>Selecciona tipo de documento</option>
            @foreach($tiposDocumento as $tipo)
                <option value="{{ $tipo->id }}" {{ old('tipo_documento_id', $usuario->tipo_documento_id) == $tipo->id ? 'selected' : '' }}>
                    {{ $tipo->descripcion }}
                </option>
            @endforeach
        </select>
        @error('tipo_documento_id')
            <div class="text-danger mt-1 px-2 py-1" style="background-color: #ffe6e6; border-radius: 4px;">{{ $message }}</div>
        @enderror
    </div>
</div>

@endsection

@section('botones-formulario')
    <x-boton-principal href="{{ route('usuarios.index') }}">
        <i class="fas fa-arrow-left"></i> Cancelar
    </x-boton-principal>
    <x-boton-principal type="submit">
        <i class="fa-solid fa-rotate-right"></i> Actualizar
    </x-boton-principal>
@endsection
