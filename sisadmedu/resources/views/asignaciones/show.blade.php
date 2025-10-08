@extends('layouts.show')

@section('titulo')

@section('informacion')
<div class="text-center">
    <img src="{{ Avatar::create($asignacion->docente->primer_nombre . ' ' . $asignacion->docente->primer_apellido)->toBase64() }}" 
        alt="Avatar Docente" 
        class="rounded-circle shadow mb-3" 
        width="100" 
        height="100">
    <h4 class="fw-bold mb-0">{{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}</h4>
    <hr class="my-4">
</div>

<div class="row mb-3">
    <div class="col-md-6 mb-3 text-center">
        <i class="fa-solid fa-book text-light"></i>
        <strong>Materia:</strong>
        <p class="mb-0">{{ $asignacion->materia->descripcion }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fa-solid fa-school text-light"></i>
        <strong>Grado:</strong>
        <p class="mb-0">{{ $asignacion->grado->nombre_grado }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fa-solid fa-calendar-days text-light"></i>
        <strong>Año lectivo:</strong>
        <p class="mb-0">{{ $asignacion->anio_lectivo }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-plus me-2 text-light"></i>
        <strong>Fecha de creación:</strong>
        <p class="mb-0">{{ $asignacion->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-alt me-2 text-light"></i>
        <strong>Última actualización:</strong>
        <p class="mb-0">{{ $asignacion->updated_at->format('d/m/Y H:i') }}</p>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <x-boton-principal href="{{ route('asignaciones.index') }}">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </x-boton-principal>

    <x-boton-principal href="{{ route('asignaciones.edit', $asignacion->id) }}">
        <i class="fas fa-edit me-1"></i> Editar
    </x-boton-principal>
</div>
@endsection
