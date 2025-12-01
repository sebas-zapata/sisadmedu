@extends('layouts.show')

@section('titulo')

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Encabezado con color institucional --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-user-graduate fa-lg me-2"></i>
                <span class="fw-bold fs-5">Información del Estudiante</span>
            </div>
        </div>

        {{-- Avatar y nombre --}}
        <div class="text-center py-4 bg-light">
            <img src="{{ Avatar::create($estudiante->primer_nombre_estudiante . ' ' . $estudiante->segundo_nombre_estudiante . ' ' . $estudiante->primer_apellido_estudiante . ' ' . $estudiante->segundo_apellido_estudiante)->toBase64() }}"
                alt="Avatar"
                class="rounded-circle shadow-sm border border-3"
                style="border-color: #461c68;"
                width="110"
                height="110">

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                {{ $estudiante->primer_nombre_estudiante }}
                {{ $estudiante->segundo_nombre_estudiante }}
                {{ $estudiante->primer_apellido_estudiante }}
                {{ $estudiante->segundo_apellido_estudiante }}
            </h4>

            <span class="badge mt-2 px-3 py-2 fs-6 text-white" style="background-color: #461c68;">
                Estudiante de {{ $estudiante->grado->nombre_grado }}
            </span>
        </div>

        {{-- Tabs --}}
        <div class="card-body bg-light">
            <ul class="nav nav-tabs border-0 mb-4" id="estudianteTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                        <i style="color:#461c68;" class="fa-solid fa-id-card me-2"></i>Datos Generales
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="acudientes-tab" data-bs-toggle="tab" data-bs-target="#acudientes" type="button" role="tab" aria-controls="acudientes" aria-selected="false">
                        <i style="color:#461c68;" class="fa-solid fa-user-friends me-2"></i>Acudientes
                    </button>
                </li>
                @if (Auth::check())
                @if (Auth::user()->rol->nombre === 'Docente')
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="observaciones-tab" data-bs-toggle="tab" data-bs-target="#observaciones" type="button" role="tab" aria-controls="observaciones" aria-selected="false">
                        <i style="color:#461c68;" class="fa-solid fa-clipboard-list me-2"></i>Observaciones
                    </button>
                </li>
                @endif
                @endif

            </ul>

            <div class="tab-content" id="estudianteTabsContent">
                {{-- Datos Generales --}}
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color:#461c68;">
                            <i class="fa-solid fa-id-card me-2"></i>Datos Generales
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>ID:</strong> #{{ $estudiante->id }}</div>
                                <div class="col-md-6 mb-2"><strong>Matrícula:</strong> {{ $estudiante->matricula }}</div>
                                <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $estudiante->usuario->documento }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo Electrónico:</strong> {{ $estudiante->usuario->correo_electronico ?? 'No registrado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Grado:</strong> {{ $estudiante->grado->nombre_grado }}</div>
                                <div class="col-md-6 mb-2"><strong>Tipo de Documento:</strong> {{ $estudiante->tipoDocumento->descripcion }}</div>
                                <div class="col-md-6 mb-2"><strong>Teléfono:</strong> {{ $estudiante->telefono_estudiante ?? 'No registrado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $estudiante->usuario->celular ?? 'No registrado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Dirección:</strong> {{ $estudiante->direccion_estudiante ?? 'No registrada' }}</div>
                                <div class="col-md-6 mb-2"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento_estudiante)->format('d/m/Y') }}</div>
                                <div class="col-md-6 mb-2"><strong>Edad:</strong> {{ $estudiante->edad_estudiante }} años</div>
                                <div class="col-md-6 mb-2"><strong>Fecha de creación:</strong> {{ $estudiante->created_at->format('d/m/Y H:i') }}</div>
                                <div class="col-md-6 mb-2"><strong>Última actualización:</strong> {{ $estudiante->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Acudientes --}}
                <div class="tab-pane fade" id="acudientes" role="tabpanel" aria-labelledby="acudientes-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color:#461c68;">
                            <i class="fa-solid fa-user-friends me-2"></i>Acudientes Asignados
                        </div>
                        <div class="card-body bg-white">
                            @if($estudiante->acudientes && $estudiante->acudientes->isNotEmpty())
                            <div class="list-group">
                                @foreach($estudiante->acudientes as $acudiente)
                                <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $acudiente->nombres }} {{ $acudiente->apellidos }}</h6>
                                        <small class="text-muted d-block"><strong>ID:</strong> {{ $acudiente->id }} | <strong>Documento:</strong> {{ $acudiente->documento }}</small>
                                        <small class="text-muted d-block"><strong>Celular:</strong> {{ $acudiente->celular ?? 'No registrado' }}</small>
                                        <small class="text-muted d-block"><strong>Correo:</strong> {{ $acudiente->correo_electronico ?? 'No registrado' }}</small>
                                    </div>
                                    <span class="badge bg-dark rounded-pill">Acudiente</span>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <p class="text-center text-muted">Este estudiante aún no tiene acudientes asignados.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="tab-pane fade text-center" id="observaciones" role="tabpanel" aria-labelledby="observaciones-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color:#461c68;">
                            <i class="fa-solid fa-clipboard-list me-2"></i>Observaciones
                        </div>
                        <div class="card-body bg-white">
                            <x-boton-principal type="button" data-bs-toggle="modal" data-bs-target="#modalObservacion">
                                <i class="fas fa-comment-medical me-1"></i> Agregar Observación
                            </x-boton-principal>

                            <x-boton-principal type="button" data-bs-toggle="modal" data-bs-target="#modalVerObservaciones">
                                <i class="fas fa-eye me-1"></i> Ver Observaciones
                            </x-boton-principal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Partial con los modales --}}
@include('estudiantes.partials._modales_observaciones')

@endsection

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new bootstrap.Modal(document.getElementById('modalObservacion')).show();
    });
</script>
@endif