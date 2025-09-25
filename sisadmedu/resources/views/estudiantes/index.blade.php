@extends('layouts.gestion')
@section('titulo')
Estudiantes <i class="fas fa-user-graduate"></i>
@endsection
@section('boton-registrar')
<x-boton-principal href="{{ route('estudiantes.create') }}">
    <i class="fas fa-user-graduate"></i>
</x-boton-principal>
{{-- Input de búsqueda --}}
<div class="mb-3">
    <input type="text" id="filtroEstudiantes" class="form-control" placeholder="Filtrar por nombre" pattern="[A-Za-z\s]*" title="Solo letras">
</div>
@endsection


@section('tabla')
<table class="table table-striped table-hover align-middle" id="tabla-estudiantes">
    <thead>
        <tr>
            <th>ID</th>
            <th>Matricula</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Grado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($estudiantes as $estudiante)
        <tr data-nombre="{{ strtolower($estudiante->primer_nombre_estudiante . ' ' . $estudiante->segundo_nombre_estudiante . ' ' . $estudiante->primer_apellido_estudiante . ' ' . $estudiante->segundo_apellido_estudiante) }}">
            <td>{{ $estudiante->id }}</td>
            <td>{{ $estudiante->matricula }}</td>
            <td>{{ $estudiante->documento_estudiante }}</td>
            <td>{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->segundo_nombre_estudiante }}</td>
            <td>{{ $estudiante->primer_apellido_estudiante }} {{ $estudiante->segundo_apellido_estudiante }}</td>
            <td>{{ $estudiante->grado->nombre_grado }}</td>
            <td>
                <x-boton-accion tipo="ver" href="{{ route('estudiantes.show', $estudiante) }}" />
                <x-boton-accion tipo="editar" href="{{ route('estudiantes.edit', $estudiante) }}" />
                <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST" class="d-inline-block" data-estudiante="{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->primer_apellido_estudiante }}">
                    @csrf
                    @method('DELETE')
                    <x-boton-accion tipo="eliminar" type="submit" class="btn-eliminar-estudiantes" />
                </form>
                {{-- Botón Generar Constancia PDF --}}
                <x-boton-accion tipo="descargar" href="{{ route('pdf.constancia', $estudiante->id) }}" />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center text-muted">No hay estudiantes registrados <i class="fas fa-user-graduate"></i>.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
