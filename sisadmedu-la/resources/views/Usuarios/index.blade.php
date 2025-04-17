@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <h1 class="title text-center">Usuarios</h1> -->


    <a href="{{ route('dashboard') }}" class="btn-panel">
        <i class="fas fa-tachometer-alt"></i> Panel
    </a>
    <a href="{{ route('usuarios.create') }}" class="btn-nuevo-usuario">
        <i class="fas fa-user-plus"></i> Crear Nuevo Usuario
    </a>
    <div class="table-container">
        <table class="users-table">
            <thead class="thead-table">
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
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
                    <td class="actions">
                        <a href="{{ route('usuarios.show', $usuario->id_usuario) }}" class="btn btn-view"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" class="btn inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar"><i class="fas fa-trash-alt"></i></button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection