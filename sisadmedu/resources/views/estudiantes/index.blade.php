@extends('layouts.gestion')
@section('titulo')
    Estudiantes <i class="fas fa-user-graduate"></i>
@endsection

@section('boton-registrar')
    @if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
        <x-boton-principal href="{{ route('estudiantes.create') }}">
            <i class="fas fa-user-graduate"></i>
        </x-boton-principal>
    @endif
    {{-- Input de búsqueda --}}
    <div class="mb-3">
        <input type="text" id="filtroEstudiantes" class="form-control" placeholder="Filtrar por documento" pattern="">
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
                <tr
                    data-nombre="{{ strtolower($estudiante->primer_nombre_estudiante . ' ' . $estudiante->segundo_nombre_estudiante . ' ' . $estudiante->primer_apellido_estudiante . ' ' . $estudiante->segundo_apellido_estudiante) }}">
                    <td>{{ $estudiante->id }}</td>
                    <td>{{ $estudiante->matricula }}</td>
                    <td>{{ $estudiante->usuario->documento }}</td>
                    <td>{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->segundo_nombre_estudiante }}</td>
                    <td>{{ $estudiante->primer_apellido_estudiante }} {{ $estudiante->segundo_apellido_estudiante }}</td>
                    <td>{{ $estudiante->grado->nombre_grado }}</td>
                    <td>
                        {{-- Ver siempre disponible --}}
                        <x-boton-accion tipo="ver" href="{{ route('estudiantes.show', $estudiante) }}" />

                        {{-- Editar y eliminar solo si NO es docente --}}
                        @if (Auth::user()->rol->nombre !== 'Docente' && Auth::user()->rol->nombre !== 'Estudiante')
                            <x-boton-accion tipo="editar" href="{{ route('estudiantes.edit', $estudiante) }}" />
                            <form action="{{ route('estudiantes.destroy', $estudiante) }}" method="POST"
                                class="d-inline-block"
                                data-estudiante="{{ $estudiante->primer_nombre_estudiante }} {{ $estudiante->primer_apellido_estudiante }}">
                                @csrf
                                @method('DELETE')
                                <x-boton-accion tipo="eliminar" type="submit" class="btn-eliminar-estudiantes" />
                            </form>
                        @endif

                        {{-- Botón Generar Constancia PDF (esto lo pueden ver todos si quieres) --}}
                        <x-boton-accion tipo="descargar" href="{{ route('pdf.constancia', $estudiante->id) }}" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">No hay estudiantes registrados <i
                            class="fas fa-user-graduate"></i>.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
