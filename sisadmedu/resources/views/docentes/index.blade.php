@extends('layouts.gestion')

@section('titulo')
Docentes <i class="fas fa-chalkboard-teacher"></i>
@endsection

@section('acciones')
    <x-boton-principal href="{{ route('docentes.create') }}">
        <i class="fas fa-chalkboard-teacher"></i>
    </x-boton-principal>
@endsection

@section('filtros')
    <input
        type="text"
        class="form-control"
        id="filtroDocentes"
        placeholder="Filtrar por documento"
        pattern="[0-9]*"
        title="Solo números">
@endsection


@section('tabla')
<table class="table table-striped table-hover align-middle" id="tabla-docentes">
    <thead class="thead-sisadmedu text-center">
        <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Correo Electrónico</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($docentes as $docente)
        <tr data-documento="{{ $docente->usuario->documento }}">
            <td>{{ $docente->id }}</td>
            <td>{{ $docente->usuario->documento }}</td>
            <td>{{ $docente->primer_nombre }} {{ $docente->segundo_nombre }}</td>
            <td>{{ $docente->primer_apellido }} {{ $docente->segundo_apellido }}</td>
            <td>{{ $docente->usuario->correo_electronico }}</td>
            <td>
                <x-boton-accion tipo="ver" href="{{ route('docentes.show', $docente->id) }}" />
                <x-boton-accion tipo="editar" href="{{ route('docentes.edit', $docente->id) }}" />
                <form action="{{ route('docentes.destroy', $docente->id) }}" data-docente="{{ $docente->primer_nombre }} {{ $docente->segundo_nombre }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <x-boton-accion tipo="eliminar" type="button" class="btn-eliminar-docentes">
                    </x-boton-accion>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center text-muted">No hay docentes registrados <i class="fas fa-user-slash"></i>.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection