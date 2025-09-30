@extends('layouts.gestion')

@section('titulo')
    Grados <i class="fas fa-layer-group"></i>
@endsection

@section('boton-registrar')
    {{-- Solo administradores pueden crear --}}
    @if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
        <x-boton-principal href="{{ route('grados.create') }}">
            <i class="fas fa-plus"></i>
        </x-boton-principal>
    @endif
@endsection

@section('tabla')
    <table class="table table-striped table-hover align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Grado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($grados as $grado)
                <tr>
                    <td>{{ $grado->id }}</td>
                    <td>{{ $grado->nombre_grado }}</td>
                    <td>
                        {{-- Ver siempre disponible --}}
                        <x-boton-accion tipo="ver" href="{{ route('grados.show', $grado) }}" />

                        {{-- Editar y eliminar solo si NO es docente ni estudiante --}}
                        @if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
                            <x-boton-accion tipo="editar" href="{{ route('grados.edit', $grado) }}" />
                            <form action="{{ route('grados.destroy', $grado) }}" method="POST"
                                class="d-inline-block"
                                data-grado="{{ $grado->nombre_grado }}">
                                @csrf
                                @method('DELETE')
                                <x-boton-accion tipo="eliminar" type="submit" class="btn-eliminar-grados" />
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">No hay grados registrados <i class="fas fa-layer-group"></i>.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
