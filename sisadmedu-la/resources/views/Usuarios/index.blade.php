<!-- resources/views/usuarios/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Usuarios</h1>
    
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Documento</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Rol</th>
                <th width="280px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id_usuario }}</td>
                <td>{{ $usuario->documento_usuario }}</td>
                <td>{{ $usuario->nombres_usuario }}</td>
                <td>{{ $usuario->apellidos_usuario }}</td>
                <td>{{ $usuario->telefono_usuario }}</td>
                <td>{{ $usuario->correo_electronico_usuario }}</td>
                <td>{{ $usuario->rol->rol ?? 'No asignado' }}</td>
                <td>
                    <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('usuarios.show', $usuario->id_usuario) }}">Ver</a>
                        <a class="btn btn-primary" href="{{ route('usuarios.edit', $usuario->id_usuario) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection