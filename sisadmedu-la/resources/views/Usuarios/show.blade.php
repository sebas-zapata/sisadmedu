@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalle del Usuario</h1>
    
    <div class="card">
        <div class="card-header">
            <strong>{{ $usuario->nombres_usuario }} {{ $usuario->apellidos_usuario }}</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID:</strong> {{ $usuario->id_usuario }}</p>
                    <p><strong>Tipo de Documento:</strong> {{ $usuario->tipoDocumento->descripcion_tipo_documento ?? 'No asignado' }}</p>
                    <p><strong>Número de Documento:</strong> {{ $usuario->documento_usuario }}</p>
                    <p><strong>Nombres:</strong> {{ $usuario->nombres_usuario }}</p>
                    <p><strong>Apellidos:</strong> {{ $usuario->apellidos_usuario }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Teléfono:</strong> {{ $usuario->telefono_usuario }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $usuario->correo_electronico_usuario }}</p>
                    <p><strong>Rol:</strong> {{ $usuario->rol->rol ?? 'No asignado' }}</p>
                    <p><strong>Grupo:</strong> {{ $usuario->grupo->nombre_grupo ?? 'No asignado' }}</p>
                    <p><strong>Fecha de Registro:</strong> {{ $usuario->fecha_registro }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a class="btn btn-primary" href="{{ route('usuarios.edit', $usuario->id_usuario) }}">Editar</a>
            <a class="btn btn-secondary" href="{{ route('usuarios.index') }}">Volver</a>
        </div>
    </div>
</div>
@endsection