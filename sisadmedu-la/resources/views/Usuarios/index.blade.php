@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">Lista de Usuarios</h1>

    <a href="{{ route('usuarios.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4">
        Crear Nuevo Usuario
    </a>

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Documento</th>
                    <th class="py-3 px-6 text-left">Nombres</th>
                    <th class="py-3 px-6 text-left">Apellidos</th>
                    <th class="py-3 px-6 text-left">Teléfono</th>
                    <th class="py-3 px-6 text-left">Correo Electrónico</th>
                    <th class="py-3 px-6 text-left">Rol</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 dark:text-gray-200 text-sm font-light">
                @foreach ($usuarios as $usuario)
                <tr class="border-b border-gray-200 dark:border-gray-700 dark:hover:bg-gray-600">
                    <td class="py-3 px-6">{{ $usuario->id_usuario }}</td>
                    <td class="py-3 px-6">{{ $usuario->documento_usuario }}</td>
                    <td class="py-3 px-6">{{ $usuario->nombres_usuario }}</td>
                    <td class="py-3 px-6">{{ $usuario->apellidos_usuario }}</td>
                    <td class="py-3 px-6">{{ $usuario->telefono_usuario }}</td>
                    <td class="py-3 px-6">{{ $usuario->correo_electronico_usuario }}</td>
                    <td class="py-3 px-6">{{ $usuario->rol->rol ?? 'No asignado' }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('usuarios.show', $usuario->id_usuario) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Ver</a>
                            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Editar</a>
                            <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este usuario?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
