@extends('layouts.show')

@section('titulo'   )

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        
        {{-- Encabezado con color institucional --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-user fa-lg me-2"></i>
                <span class="fw-bold fs-5">Información del Usuario</span>
            </div>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Avatar y nombre principal --}}
        <div class="text-center py-4 bg-light">
            <img src="{{ Avatar::create($usuario->nombres . ' ' . $usuario->apellidos)->toBase64() }}"
                 alt="Avatar de {{ $usuario->nombres }}"
                 class="rounded-circle shadow-sm border border-3"
                 style="border-color: #461c68;"
                 width="110"
                 height="110">

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                {{ $usuario->nombres }} {{ $usuario->apellidos }}
            </h4>

            <span class="badge mt-2 px-3 py-2 fs-6 text-white" style="background-color: #461c68;">
                Rol: {{ $usuario->rol->nombre ?? 'Sin rol' }}
            </span>
        </div>

        {{-- Contenido con tabs --}}
        <div class="card-body bg-light">
            <ul class="nav nav-tabs border-0 mb-4" id="usuarioTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                        <i style="color: #461c68;" class="fa-solid fa-id-card me-2"></i>Información General
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="tiempo-tab" data-bs-toggle="tab" data-bs-target="#tiempo" type="button" role="tab" aria-controls="tiempo" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-calendar-alt me-2"></i>Tiempos
                    </button>
                </li>
                @if($usuario->rol && $usuario->rol->nombre === 'Acudiente')
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="acudiente-tab" data-bs-toggle="tab" data-bs-target="#acudiente" type="button" role="tab" aria-controls="acudiente" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-children me-2"></i>Estudiantes Asignados
                    </button>
                </li>
                @endif
            </ul>

            <div class="tab-content" id="usuarioTabsContent">

                {{-- Información general --}}
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-id-card me-2"></i>Datos Personales
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Identificador:</strong> #{{ $usuario->id }}</div>
                                <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $usuario->documento }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo electrónico:</strong> {{ $usuario->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $usuario->celular }}</div>
                                <div class="col-md-6 mb-2"><strong>Tipo de documento:</strong> {{ $usuario->tipoDocumento->descripcion ?? 'Sin tipo' }}</div>
                                <div class="col-md-6 mb-2"><strong>Rol:</strong> {{ $usuario->rol->nombre ?? 'Sin rol' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Información de fechas --}}
                <div class="tab-pane fade" id="tiempo" role="tabpanel" aria-labelledby="tiempo-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-calendar-alt me-2"></i>Tiempos del Registro
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Fecha de creación:</strong> {{ $usuario->created_at->format('d/m/Y H:i') }}</div>
                                <div class="col-md-6 mb-2"><strong>Última actualización:</strong> {{ $usuario->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="acudiente" role="tabpanel" aria-labelledby="acudiente-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-children me-2"></i>Estudiantes Asignados
                        </div>
                        <div class="card-body bg-white">
                            @if($usuario->estudiantes->isEmpty())
                                <p class="text-muted text-center">Este acudiente aún no tiene estudiantes asignados.</p>
                            @else
                                <div class="list-group">
                                    @foreach($usuario->estudiantes as $estudiante)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="fw-bold mb-1">
                                                {{ $estudiante->primer_nombre_estudiante }}
                                                {{ $estudiante->segundo_nombre_estudiante }}
                                                {{ $estudiante->primer_apellido_estudiante }}
                                                {{ $estudiante->segundo_apellido_estudiante }}
                                            </h6>
                                            <small class="text-muted">
                                                Documento: {{ $estudiante->usuario->documento }} | Matrícula: {{ $estudiante->matricula }}
                                            </small>
                                        </div>
                                        <span class="badge text-white rounded-pill" style="background-color: #461c68;">
                                            {{ $estudiante->grado->nombre_grado ?? 'Sin grado' }}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
