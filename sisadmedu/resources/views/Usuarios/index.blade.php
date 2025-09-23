@extends('layouts.gestion')

@section('titulo')
Usuarios <i class="fas fa-users"></i>
@endsection
@section('boton-registrar')
<x-boton-principal href="{{ route('usuarios.create') }}">
    <i class="fas fa-user-plus"></i>
</x-boton-principal>
<x-boton-accion tipo="descargar" href="{{ route('usuarios.pdf') }}" >
</x-boton-accion>
@endsection
@section('tabla')
            <table class="table table-striped table-hover align-middle" id="usuarios">
                <thead class="thead-sisadmedu text-center">
                    <tr>
                        <th>ID</th>
                        <th>Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->documento }}</td>
                        <td>{{ $usuario->nombres }}</td>
                        <td>{{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->correo_electronico }}</td>
                        <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
                        <td>
                            <x-boton-accion tipo="ver" href="{{ route('usuarios.show', $usuario->id) }}" />
                            <x-boton-accion tipo="editar" href="{{ route('usuarios.edit', $usuario->id) }}" />
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" data-usuario="{{ $usuario->nombres }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')

                                <x-boton-accion tipo="eliminar" type="button" class="btn-eliminar-usuarios">
                                </x-boton-accion>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted">No hay usuarios registrados <i class="fas fa-user-slash"></i>.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
@endsection