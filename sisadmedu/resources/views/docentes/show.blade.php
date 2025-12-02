@extends('layouts.show')

@section('titulo', 'Información del Docente')

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Encabezado con color institucional --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-chalkboard-teacher fa-lg me-2"></i>
                <span class="fw-bold fs-5">Información del Docente</span>
            </div>
        </div>

        {{-- Avatar y nombre principal --}}
        <div class="text-center py-4 bg-light">
            <img src="{{ Avatar::create($docente->primer_nombre . ' ' . $docente->segundo_nombre . ' ' . $docente->primer_apellido . ' ' . $docente->segundo_apellido)->toBase64() }}"
                 alt="Avatar"
                 class="rounded-circle shadow-sm border border-3"
                 style="border-color: #461c68;"
                 width="110"
                 height="110">

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                {{ $docente->primer_nombre }} {{ $docente->segundo_nombre }} {{ $docente->primer_apellido }} {{ $docente->segundo_apellido }}
            </h4>
        </div>

        {{-- Tabs de contenido --}}
        <div class="card-body bg-light">
            <ul class="nav nav-tabs border-0 mb-4" id="docenteTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">
                        <i style="color: #461c68;" class="fa-solid fa-id-card me-2"></i>Datos Generales
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="profesional-tab" data-bs-toggle="tab" data-bs-target="#profesional" type="button" role="tab" aria-controls="profesional" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-graduation-cap me-2"></i>Información Profesional
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="tiempos-tab" data-bs-toggle="tab" data-bs-target="#tiempos" type="button" role="tab" aria-controls="tiempos" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-calendar-alt me-2"></i>Tiempos y Contrato
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="docenteTabsContent">

                {{-- Tab 1: Datos generales --}}
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-id-card me-2"></i>Datos Generales
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Identificador:</strong> #{{ $docente->id }}</div>
                                <div class="col-md-6 mb-2"><strong>Documento:</strong> {{ $docente->usuario->documento }}</div>
                                <div class="col-md-6 mb-2"><strong>Tipo de Documento:</strong> {{ $docente->tipoDocumento->descripcion ?? 'Sin tipo' }}</div>
                                <div class="col-md-6 mb-2"><strong>Correo Electrónico:</strong> {{ $docente->usuario->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $docente->usuario->celular }}</div>
                                <div class="col-md-6 mb-2"><strong>Dirección:</strong> {{ $docente->direccion }}</div>
                                <div class="col-md-6 mb-2"><strong>Estado Civil:</strong> {{ $docente->estado_civil }}</div>
                                <div class="col-md-6 mb-2"><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($docente->fecha_nacimiento)->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab 2: Información profesional --}}
                <div class="tab-pane fade" id="profesional" role="tabpanel" aria-labelledby="profesional-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-user-graduate me-2"></i>Información Profesional
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Especialización:</strong> {{ $docente->especializacion ?? 'No registrada' }}</div>
                                <div class="col-md-6 mb-2"><strong>Años de Experiencia:</strong> {{ $docente->anios_experiencia ?? 'No especificado' }}</div>
            
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tab 3: Fechas y contrato --}}
                <div class="tab-pane fade" id="tiempos" role="tabpanel" aria-labelledby="tiempos-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-calendar-alt me-2"></i>Tiempos y Contrato
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Fecha de Ingreso:</strong> {{ \Carbon\Carbon::parse($docente->fecha_ingreso)->format('d/m/Y') }}</div>
                                <div class="col-md-6 mb-2"><strong>Tipo de Contrato:</strong> {{ $docente->tipo_contrato ?? 'No especificado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Fecha de Creación:</strong> {{ $docente->created_at->format('d/m/Y H:i') }}</div>
                                <div class="col-md-6 mb-2"><strong>Última Actualización:</strong> {{ $docente->updated_at->format('d/m/Y H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
