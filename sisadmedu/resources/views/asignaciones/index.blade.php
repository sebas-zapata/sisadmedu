@extends('layouts.show')

@section('titulo', 'Listado de Asignaciones')

@section('informacion')
<div class="container py-4">
    <h2 class="text-center text-light mb-4">@yield('titulo')</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('asignaciones.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Asignación
        </a>
    </div>

    @if($asignaciones->isEmpty())
        <div class="alert alert-warning text-center">No hay asignaciones registradas.</div>
    @else
        <div class="table-responsive shadow-lg rounded">
            <table class="table table-striped table-bordered">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Docente</th>
                        <th>Materia</th>
                        <th>Grado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($asignaciones as $asignacion)
                        <tr>
                            <td>{{ $asignacion->id }}</td>
                            <td>{{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}</td>
                            <td>{{ $asignacion->materia->descripcion }}</td>
                            <td>{{ $asignacion->grado->nombre_grado }}</td>
                            <td>
                                <a href="{{ route('asignaciones.show', $asignacion->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('asignaciones.edit', $asignacion->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('asignaciones.destroy', $asignacion->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta asignación?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
