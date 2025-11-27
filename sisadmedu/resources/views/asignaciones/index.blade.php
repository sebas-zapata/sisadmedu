@extends('layouts.gestion')

@section('titulo')
Asignaciones <i class="fa-solid fa-link"></i>
@endsection

@section('acciones')
@if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
<x-boton-principal href="{{ route('asignaciones.create') }}">
    <i class="fa-solid fa-link"></i>
</x-boton-principal>
@endif
@endsection

@section('filtros')
<input
    type="text"
    id="filtroAsignaciones"
    class="form-control"
    placeholder="Docente o materia">
@endsection


@section('tabla')
<table class="table table-striped table-hover align-middle" id="tabla-asignaciones">
    <thead>
        <tr class="text-center">
            <th>ID</th>
            <th>Docente</th>
            <th>Materia</th>
            <th>Grado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($asignaciones as $asignacion)
        <tr data-docente="{{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}"
            data-materia="{{ $asignacion->materia->descripcion }}">
            <td>{{ $asignacion->id }}</td>
            <td>{{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}</td>
            <td>{{ $asignacion->materia->descripcion }}</td>
            <td>{{ $asignacion->grado->nombre_grado }}</td>
            <td class="text-center">
                {{-- Ver siempre disponible --}}
                <x-boton-accion tipo="ver" href="{{ route('asignaciones.show', $asignacion->id) }}" />

                {{-- Editar y eliminar solo si NO es docente --}}
                @if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
                <x-boton-accion tipo="editar" href="{{ route('asignaciones.edit', $asignacion->id) }}" />
                <form action="{{ route('asignaciones.destroy', $asignacion->id) }}" method="POST"
                    class="d-inline-block"
                    data-docente="{{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}"
                    data-materia="{{ $asignacion->materia->descripcion }}">
                    @csrf
                    @method('DELETE')
                    <x-boton-accion tipo="eliminar" type="button" class="btn-eliminar-asignacion" />
                </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">
                No hay asignaciones registradas <i class="fa-solid fa-link"></i>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection