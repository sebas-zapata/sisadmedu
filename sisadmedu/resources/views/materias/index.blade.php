@extends('layouts.gestion')

@section('titulo')
<i class="fas fa-book"></i> Materias
@endsection

@section('boton-registrar')
{{-- Solo administradores pueden crear materias --}}
@if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
<div class="container-fluid d-flex justify-content-between flex-wrap align-items-center gap-2 mb-3">
    <x-boton-principal href="{{ route('materias.create') }}">
        <i class="fas fa-book"></i>
    </x-boton-principal>
    <!-- Input de búsqueda -->
    <div>
        <input
            type="text"
            class="form-control w-75"
            id="filtroMaterias"
            placeholder="Asignatura">
    </div>
</div>
@endif
@endsection

@section('tabla')
<table id="tabla-materias" class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($materias as $materia)
        <tr data-nombre="{{ $materia->descripcion }}">
            <td>{{ $materia->id }}</td>
            <td>{{ $materia->descripcion }}</td>
            <td>
                {{-- Ver siempre disponible --}}
                <x-boton-accion tipo="ver" href="{{ route('materias.show', $materia) }}" />

                {{-- Editar y eliminar solo si NO es docente ni estudiante --}}
                @if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
                <x-boton-accion tipo="editar" href="{{ route('materias.edit', $materia) }}" />
                <form action="{{ route('materias.destroy', $materia) }}" method="POST"
                    class="d-inline-block"
                    data-materia="{{ $materia->descripcion }}">
                    @csrf
                    @method('DELETE')
                    <x-boton-accion tipo="eliminar" type="button" class="btn-eliminar-materias" />
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center text-muted">No hay materias registradas <i class="fas fa-book"></i>.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection