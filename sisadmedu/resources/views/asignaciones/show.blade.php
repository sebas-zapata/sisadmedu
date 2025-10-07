@extends('layouts.show')

@section('titulo', 'Detalles de la Asignación')

@section('informacion')
<div class="container py-4">
    <h2 class="text-center text-light">@yield('titulo')</h2>

    <div class="shadow-lg p-4 bg-dark text-light rounded mt-4">
        <h5 class="fw-bold mb-3 text-info">
            <i class="fas fa-chalkboard-teacher"></i> Información de la Asignación
        </h5>

        <div class="mb-3">
            <strong>Docente:</strong>
            <p>{{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}</p>
        </div>

        <div class="mb-3">
            <strong>Grado:</strong>
            <p>{{ $asignacion->grado->nombre_grado }}</p>
        </div>

        <div class="mb-3">
            <strong>Materia:</strong>
            <p>{{ $asignacion->materia->descripcion }}</p>
        </div>

        <div class="mb-3">
            <strong>Fecha de creación:</strong>
            <p>{{ $asignacion->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="mb-3">
            <strong>Última actualización:</strong>
            <p>{{ $asignacion->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <a href="{{ route('asignaciones.edit', $asignacion->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>
        </div>
    </div>
</div>
@endsection
