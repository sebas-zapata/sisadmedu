@extends('layouts.show')

@section('titulo', 'Detalle de Asignación')

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Encabezado con color institucional --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-link fa-lg me-2"></i>
                <span class="fw-bold fs-5">Detalle de Asignación</span>
            </div>
            <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Información principal --}}
        <div class="card-body bg-light">
            <div class="text-center mb-4">
                <img src="{{ Avatar::create($asignacion->docente->primer_nombre . ' ' . $asignacion->docente->primer_apellido)->toBase64() }}" 
                     alt="Avatar Docente" 
                     class="rounded-circle shadow-sm border border-3"
                     style="border-color: #461c68;"
                     width="110" 
                     height="110">
                <h4 class="mt-3 mb-0 fw-bold text-dark">
                    {{ $asignacion->docente->primer_nombre }} {{ $asignacion->docente->primer_apellido }}
                </h4>
                <span class="badge mt-2 px-3 py-2 fs-6 text-white" style="background-color: #461c68;">
                    Docente asignado
                </span>
            </div>

            {{-- Tarjeta de detalles --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                    <i class="fa-solid fa-info-circle me-2"></i>Información de la Asignación
                </div>
                <div class="card-body bg-white">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <strong>Materia:</strong> {{ $asignacion->materia->descripcion }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Grado:</strong> {{ $asignacion->grado->nombre_grado }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Año lectivo:</strong> {{ $asignacion->anio_lectivo }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Fecha de creación:</strong> {{ $asignacion->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Última actualización:</strong> {{ $asignacion->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
