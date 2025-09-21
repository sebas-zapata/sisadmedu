@extends('layouts.show')

@section('informacion')
<div class="text-center">
    <img src="{{ Avatar::create($estudiante->primer_nombre_estudiante . ' ' . $estudiante->segundo_nombre_estudiante . ' ' . $estudiante->primer_apellido_estudiante . ' ' . $estudiante->segundo_apellido_estudiante)->toBase64() }}"
        alt="Avatar"
        class="rounded-circle shadow mb-3"
        width="100"
        height="100">
    <h4 class="fw-bold mb-0">
        {{ $estudiante->primer_nombre_estudiante }}
        {{ $estudiante->segundo_nombre_estudiante }}
        {{ $estudiante->primer_apellido_estudiante }}
        {{ $estudiante->segundo_apellido_estudiante }}
    </h4>
    <hr class="my-4">
</div>

<div class="row mb-3">
    <div class="col-md-6 mb-3 text-center">
        <i class="fa-solid fa-key text-light"></i>
        <strong>Identificador:</strong>
        <p class="mb-0">{{ $estudiante->id }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-file-signature text-light"></i>
        <strong>Matricula:</strong>
        <p class="mb-0">{{ $estudiante->matricula }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-id-card me-2 text-light"></i>
        <strong>Documento:</strong>
        <p class="mb-0">{{ $estudiante->documento_estudiante }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-envelope me-2 text-light"></i>
        <strong>Correo Electrónico:</strong>
        <p class="mb-0">{{ $estudiante->correo_electronico_estudiante ?? 'No registrado' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-graduation-cap me-2 text-light"></i>
        <strong>Grado:</strong>
        <p class="mb-0">{{ $estudiante->grado->nombre_grado }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-id-card-alt me-2 text-light"></i>
        <strong>Tipo de Documento:</strong>
        <p class="mb-0">{{ $estudiante->tipoDocumento->descripcion }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-phone me-2 text-light"></i>
        <strong>Teléfono:</strong>
        <p class="mb-0">{{ $estudiante->telefono_estudiante ?? 'No registrado' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-mobile-alt me-2 text-light"></i>
        <strong>Celular:</strong>
        <p class="mb-0">{{ $estudiante->celular_estudiante ?? 'No registrado' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-map-marker-alt me-2 text-light"></i>
        <strong>Dirección:</strong>
        <p class="mb-0">{{ $estudiante->direccion_estudiante ?? 'No registrada' }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-birthday-cake me-2 text-light"></i>
        <strong>Fecha de Nacimiento:</strong>
        <p class="mb-0">{{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento_estudiante)->format('d/m/Y') }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-user-clock me-2 text-light"></i>
        <strong>Edad:</strong>
        <p class="mb-0">{{ $estudiante->edad_estudiante }} años</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-plus me-2 text-light"></i>
        <strong>Fecha de creación:</strong>
        <p class="mb-0">{{ $estudiante->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="col-md-6 mb-3 text-center">
        <i class="fas fa-calendar-alt me-2 text-light"></i>
        <strong>Última actualización:</strong>
        <p class="mb-0">{{ $estudiante->updated_at->format('d/m/Y H:i') }}</p>
    </div>
</div>

<hr class="my-4">

{{-- Mostrar acudientes solo si existen --}}
@if($estudiante->acudientes && $estudiante->acudientes->isNotEmpty())
<div class="mt-4">
    <h5 class="fw-bold text-center text-light">Acudientes Asignados</h5>

    <div class="list-group">
        @foreach($estudiante->acudientes as $acudiente)
        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div>
                <h6 class="fw-bold mb-1">
                    {{ $acudiente->nombres }} {{ $acudiente->apellidos }}
                </h6>
                <small class="text-muted d-block">
                    <strong>ID:</strong> {{ $acudiente->id }} |
                    <strong>Documento:</strong> {{ $acudiente->documento }}
                </small>
                <small class="text-muted d-block">
                    <strong>Teléfono:</strong> {{ $acudiente->telefono ?? 'No registrado' }}
                </small>
                <small class="text-muted d-block">
                    <strong>Correo:</strong> {{ $acudiente->correo_electronico ?? 'No registrado' }}
                </small>
            </div>
            <span class="badge bg-dark rounded-pill">
                Acudiente
            </span>
        </div>
        @endforeach
    </div>

</div>
@else
<p class="text-center text-muted">Este estudiante aún no tiene acudientes asignados.</p>
@endif


<div class="d-flex justify-content-end gap-2 mt-4">
    <x-boton-principal href="{{ route('estudiantes.index') }}">
        <i class="fas fa-arrow-left me-1"></i> Volver
    </x-boton-principal>
    <x-boton-principal href="{{ route('estudiantes.edit', $estudiante->id) }}">
        <i class="fas fa-edit me-1"></i> Editar
    </x-boton-principal>
</div>
@endsection