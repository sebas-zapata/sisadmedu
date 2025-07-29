@extends('layouts.app')

@section('content')
<div class="container-fluid p-2">
    <h2 class="text-center text-light">Gestión de Usuarios <i class="fas fa-users"></i></h2>

    <div class="container-fluid p-3 contenedor-componente">
        <x-boton-principal href="{{ route('usuarios.create') }}">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </x-boton-principal>

        <div class="table-responsive text-center m-1">
            <table class="table table-striped table-hover align-middle">
                <thead class="thead-sisadmedu text-center">
                    <tr>
                        <th>ID</th>
                        <th>Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Asumiendo que $usuarios es una colección de usuarios pasados desde el controlador --}}
                    @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->documento }}</td>
                        <td>{{ $usuario->nombres }}</td>
                        <td>{{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->correo_electronico }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
                        <td>
                            <x-boton-accion tipo="ver" href="{{ route('usuarios.show', $usuario->id) }}" />
                            <x-boton-accion tipo="editar" href="{{ route('usuarios.edit', $usuario->id) }}" />
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')

                                <x-boton-accion tipo="eliminar" type="button" class="btn-eliminar">
                                </x-boton-accion>
                            </form>


                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection