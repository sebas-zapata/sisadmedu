@extends('layouts.show')

@section('titulo')
Mi Información
@endsection

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Encabezado --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-user-graduate fa-lg me-2"></i>
                <span class="fw-bold fs-5">Mi Información Personal</span>
            </div>
        </div>

        {{-- Avatar del estudiante --}}
        <div class="text-center py-4 bg-light">
            <img src="{{ Avatar::create($usuario->nombres . ' ' . $usuario->apellidos)->toBase64() }}"
                alt="Avatar"
                class="rounded-circle shadow-sm border border-3"
                style="border-color: #461c68;"
                width="110"
                height="110">

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                {{ $usuario->nombres }}
                {{ $estudiante->apellidos }}
            </h4>

            <span class="badge mt-2 px-3 py-2 fs-6 text-white" style="background-color: #461c68;">
                Rol: {{ $usuario->rol->nombre }}
            </span>
        </div>

        {{-- Tabs --}}
        <div class="card-body bg-light">
            <ul class="nav nav-tabs border-0 mb-4" id="infoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="usuario-tab" data-bs-toggle="tab" data-bs-target="#usuario" type="button" role="tab">
                        <i style="color: #461c68;" class="fa-solid fa-id-card me-2"></i>Acudiente
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="estudiante-tab" data-bs-toggle="tab" data-bs-target="#estudiante" type="button" role="tab">
                        <i style="color: #461c68;" class="fa-solid fa-graduation-cap me-2"></i>Estudiante Asignado
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="infoTabsContent">

                {{-- Usuario (Acudiente) --}}
                <div class="tab-pane fade show active" id="usuario" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-user-tie me-2"></i>Información del Acudiente
                        </div>

                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $usuario->documento }}</div>
                                <div class="col-md-6 mb-2"><strong>Nombres:</strong> {{ $usuario->nombres }}</div>
                                <div class="col-md-6 mb-2"><strong>Apellidos:</strong> {{ $usuario->apellidos }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo:</strong> {{ $usuario->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $usuario->celular ?? 'No registrado' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Estudiante asignado --}}
                <div class="tab-pane fade" id="estudiante" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-graduation-cap me-2"></i>Información del Estudiante Asignado
                        </div>

                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Nombre:</strong>
                                    {{ $estudiante->primer_nombre_estudiante }}
                                    {{ $estudiante->segundo_nombre_estudiante }}
                                </div>
                                <div class="col-md-6 mb-2"><strong>Apellido:</strong>
                                    {{ $estudiante->primer_apellido_estudiante }}
                                    {{ $estudiante->segundo_apellido_estudiante }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Matrícula:</strong> {{ $estudiante->matricula }}</div>
                                <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $estudiante->usuario->documento }}</div>
                                <div class="col-md-6 mb-2"><strong>Edad:</strong> {{ $estudiante->edad_estudiante }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo:</strong> {{ $estudiante->usuario->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Grado:</strong> {{ $estudiante->grado->nombre_grado ?? 'Sin grado' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> {{-- tab-content --}}
        </div> {{-- card-body --}}
    </div>
</div>
@endsection