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
        <p class="mb-0">{{ $docente->usuario->documento }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-envelope me-2 text-light"></i>
        <strong>Correo Electrónico:</strong>
        <p class="mb-0">{{ $docente->usuario->correo_electronico }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-book me-2 text-light"></i>
        <strong>Tipo de Documento:</strong>
        <p class="mb-0">{{ $docente->tipoDocumento->descripcion }}</p>
    </div>

     <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-mobile-alt me-2 text-light"></i>
        <strong>Celular:</strong>
        <p class="mb-0">{{ $docente->usuario->celular}}</p>
    </div>

   <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-birthday-cake me-2 text-light"></i>
        <strong>Fecha de Nacimiento:</strong>
        <p class="mb-0">{{ $docente->fecha_nacimiento }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-map-marker-alt me-2 text-light"></i>
        <strong>Dirección:</strong>
        <p class="mb-0">{{ $docente->direccion }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-ring me-2 text-light"></i>
        <strong>Estado Civil:</strong>
        <p class="mb-0">{{ $docente->estado_civil }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-graduation-cap me-2 text-light"></i>
        <strong>Especialización:</strong>
        <p class="mb-0">{{ $docente->especializacion }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-briefcase me-2 text-light"></i>
        <strong>Años de Experiencia:</strong>
        <p class="mb-0">{{ $docente->anios_experiencia }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-check me-2 text-light"></i>
        <strong>Fecha de Ingreso:</strong>
        <p class="mb-0">{{ $docente->fecha_ingreso }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-times me-2 text-light"></i>
        <strong>Tipo de contrato:</strong>
        <p class="mb-0">{{ $docente->tipo_contrato}}</p>
    </div>

    {{-- 🔹 Fechas de sistema --}}
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
