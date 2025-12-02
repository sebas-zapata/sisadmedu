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
            <img src="{{ Avatar::create($estudiante->primer_nombre_estudiante . ' ' . $estudiante->primer_apellido_estudiante)->toBase64() }}"
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
                Matrícula: {{ $estudiante->matricula }}
            </span>
        </div>

        {{-- Tabs --}}
        <div class="card-body bg-light">
            <ul class="nav nav-tabs border-0 mb-4" id="infoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="usuario-tab" data-bs-toggle="tab" data-bs-target="#usuario" type="button" role="tab" aria-controls="usuario" aria-selected="true">
                        <i style="color: #461c68;" class="fa-solid fa-id-card me-2"></i>Usuario
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="estudiante-tab" data-bs-toggle="tab" data-bs-target="#estudiante" type="button" role="tab" aria-controls="estudiante" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-graduation-cap me-2"></i>Estudiante
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="adicional-tab" data-bs-toggle="tab" data-bs-target="#adicional" type="button" role="tab" aria-controls="adicional" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-circle-info me-2"></i>Adicional
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="acudiente-tab" data-bs-toggle="tab" data-bs-target="#acudiente" type="button" role="tab" aria-controls="acudiente" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-user-tie me-2"></i>Acudiente
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="infoTabsContent">
                {{-- Usuario --}}
                <div class="tab-pane fade show active" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-id-card me-2"></i>Información del Usuario
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $usuario->documento }}</div>
                                <div class="col-md-6 mb-2"><strong>Nombres:</strong> {{ $usuario->nombres }}</div>
                                <div class="col-md-6 mb-2"><strong>Apellidos:</strong> {{ $usuario->apellidos }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo:</strong> {{ $usuario->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $usuario->celular }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Estudiante --}}
                <div class="tab-pane fade" id="estudiante" role="tabpanel" aria-labelledby="estudiante-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-graduation-cap me-2"></i>Información del Estudiante
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Grado:</strong> {{ $estudiante->grado->nombre_grado ?? 'No asignado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Edad:</strong> {{ $estudiante->edad_estudiante }} años</div>
                                <div class="col-md-6 mb-2"><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($estudiante->fecha_nacimiento_estudiante)->format('d/m/Y') }}</div>
                                <div class="col-md-6 mb-2"><strong>Teléfono:</strong> {{ $estudiante->telefono_estudiante ?? 'No registrado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Dirección:</strong> {{ $estudiante->direccion_estudiante }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Adicional --}}
                <div class="tab-pane fade" id="adicional" role="tabpanel" aria-labelledby="adicional-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-circle-info me-2"></i>Información adicional
                        </div>
                        <div class="card-body bg-white">
                            <p><strong>Última actualización:</strong> {{ $estudiante->updated_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Cuenta vinculada:</strong> {{ $usuario->correo_electronico }}</p>
                        </div>
                    </div>
                </div>

                {{-- Acudiente --}}
                <div class="tab-pane fade" id="acudiente" role="tabpanel" aria-labelledby="acudiente-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-user-tie me-2"></i>Información del Acudiente
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Nombres:</strong> {{ $acudiente->nombres }}</div>
                                <div class="col-md-6 mb-2"><strong>Apellidos:</strong> {{ $acudiente->apellidos }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo:</strong> {{ $acudiente->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $acudiente->celular ?? 'No registrado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Rol:</strong> {{ $acudiente->rol->nombre ?? 'No asignado' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
