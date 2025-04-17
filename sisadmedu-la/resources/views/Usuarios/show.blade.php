@extends('layouts.app')

@section('content')
<div class="container-show">
    <h1>Detalle del Usuario <br>{{ $usuario->nombres_usuario}} {{ $usuario->apellidos_usuario}}</h1>

    <div class="info-row">
        <div class="info-column">
            <p><strong>ID:</strong> {{ $usuario->id_usuario }}</p>
            <p><strong>Tipo de Documento:</strong> {{ $usuario->tipoDocumento->descripcion_tipo_documento ?? 'No asignado' }}</p>
            <p><strong>Número de Documento:</strong> {{ $usuario->documento_usuario }}</p>
            <p><strong>Nombres:</strong> {{ $usuario->nombres_usuario }}</p>
            <p><strong>Apellidos:</strong> {{ $usuario->apellidos_usuario }}</p>
        </div>
        <div class="info-column">
            <p><strong>Teléfono:</strong> {{ $usuario->telefono_usuario }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $usuario->correo_electronico_usuario }}</p>
            <p><strong>Rol:</strong> {{ $usuario->rol->rol ?? 'No asignado' }}</p>
            <p><strong>Grupo:</strong> {{ $usuario->grupo->nombre_grupo ?? 'No asignado' }}</p>
            <p><strong>Fecha de Registro:</strong> {{ $usuario->fecha_registro }}</p>
        </div>
    </div>

    <div class="actions-show">
        <a class="btn-guardar" href="{{ route('usuarios.edit', $usuario->id_usuario) }}"><i class="fas fa-edit"></i> Editar Usuario</a>
        <a class="btn-cancelar" href="{{ route('usuarios.index') }}"><i class="fas fa-arrow-left"></i> Volver</a>
    </div>
</div>
@endsection