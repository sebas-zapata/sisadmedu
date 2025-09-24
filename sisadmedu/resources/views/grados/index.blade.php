@extends('layouts.gestion')
@section('titulo')
Grados <i class="fas fa-graduation-cap"></i>
@endsection
@section('boton-registrar')
<x-boton-principal href="{{ route('grados.create') }}">
    <i class="fas fa-layer-group"></i>
</x-boton-principal>
@endsection
@section('tabla')
<table class="table table-striped table-hover align-middle">
    <thead class="thead-sisadmedu text-center">
        <tr>
            <th>ID</th>
            <th>Nivel grado</th>
            <th>Grupo grado</th>
            <th>Nombre del Grado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($grados as $grado)
        <tr>
            <td>{{ $grado->id }}</td>
            <td>{{ $grado->nivel_grado }}</td>
            <td>{{ $grado->grupo_grado }}</td>
            <td>{{ $grado->nombre_grado }}</td>
            <td>
                <x-boton-accion tipo="ver" href="{{ route('grados.show', $grado) }}" />
                <x-boton-accion tipo="editar" href="{{ route('grados.edit', $grado) }}" />
                <form action="{{ route('grados.destroy', $grado) }}" data-grado="{{ $grado->nombre_grado }}" method="post" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <x-boton-accion tipo="eliminar" type="button" class="btn-eliminar-grados" />
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10" class="text-center text-muted">No hay grados registrados <i class="fas fa-graduation-cap"></i>.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@section('paginacion')
    {{ $grados->links() }}
@endsection
@endsection