@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between text-light align-items-center mb-3">
        <h2>Gestión de Usuarios <i class="fas fa-users"></i></h2>
    </div>

    <div class="container-fluid p-3 contenedor-componente">
        <a href="{{ route('usuarios.create') }}" class="btn btn-sm btn-guardar rounded-2">
            <i class="fas fa-user-plus"></i> Nuevo Usuario
        </a>
        <div class="table-responsive text-center">
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
                    @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->documento }}</td>
                        <td>{{ $usuario->nombres }}</td>
                        <td>{{ $usuario->apellidos }}</td>
                        <td>{{ $usuario->correo_electronico }}</td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->rol->nombre ?? 'Sin rol' }}</td>
                        <td>
                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-sm btn-view m-1 rounded-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-edit m-1 rounded-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline-block form-eliminar">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-delete m-1 btn-confirmar-eliminar rounded-2">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection