@extends('layouts.show')
@section('titulo')
@endsection
@section('informacion')
<div class="text-center">
    <img src="{{ Avatar::create($docente->primer_nombre . ' ' . $docente->segundo_nombre . ' ' . $docente->primer_apellido . ' ' . $docente->segundo_apellido)->toBase64() }}" alt="Avatar" class="rounded-circle shadow mb-3" width="100" height="100">
    <h4 class="fw-bold mb-0">{{ $docente->primer_nombre }} {{ $docente->segundo_nombre }} {{ $docente->primer_apellido }} {{ $docente->segundo_apellido }}</h4>
    <hr class="my-4">
</div>
<div class="row mb-3">
    <div class="col-md-6 mb-3 text-center">
        <i class="fa-solid fa-key text-light"></i>
        <strong>Identificador:</strong>
        <p class="mb-0">{{ $docente->id }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-id-card me-2 text-light"></i>
        <strong>Documento:</strong>
        <p class="mb-0">{{ $docente->documento }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-envelope me-2 text-light"></i>
        <strong>Correo Electrónico:</strong>
        <p class="mb-0">{{ $docente->correo_electronico }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-book me-2 text-light"></i>
        <strong>Materia Asignada:</strong>
        <p class="mb-0">{{ $docente->materia->descripcion }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-book me-2 text-light"></i>
        <strong>Tipo de Documento:</strong>
        <p class="mb-0">{{ $docente->tipoDocumento->descripcion }}</p>
    </div>



    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-plus me-2 text-light"></i>
        <strong>Fecha de creación:</strong>
        <p class="mb-0">{{ $docente->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-alt me-2 text-light"></i>
        <strong>Última actualización:</strong>
        <p class="mb-0">{{ $docente->updated_at->format('d/m/Y H:i') }}</p>
    </div>


</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <x-boton-principal href="{{ route('docentes.index') }}">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </x-boton-principal>
    <x-boton-principal href="{{ route('docentes.edit', $docente->id) }}">
        <i class="fas fa-edit me-1"></i> Editar
    </x-boton-principal>
</div>
@endsection
