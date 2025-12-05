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
        </div>

        {{-- Información principal --}}
        <div class="card-body bg-light">
            @php
                $docente = $docentes->firstWhere('id', $asignacion['docenteId']);
                $materia = $materias->firstWhere('id', $asignacion['materiaId']);
                $grado   = $grados->firstWhere('id', $asignacion['gradoId']);
            @endphp

            <div class="text-center mb-4">
                <img src="{{ Avatar::create(
                        $docente ? $docente->primer_nombre . ' ' . $docente->primer_apellido : 'Docente'
                    )->toBase64() }}" 
                     alt="Avatar Docente" 
                     class="rounded-circle shadow-sm border border-3"
                     style="border-color: #461c68;"
                     width="110" 
                     height="110">
                <h4 class="mt-3 mb-0 fw-bold text-dark">
                    {{ $docente ? $docente->primer_nombre . ' ' . $docente->primer_apellido : 'Desconocido' }}
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
                            <strong>Materia:</strong> {{ $materia ? $materia->descripcion : 'Desconocida' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Grado:</strong> {{ $grado ? $grado->nombre_grado : 'Desconocido' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Año lectivo:</strong> {{ $asignacion['anioLectivo'] }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Fecha de creación:</strong> {{ $asignacion['createdAt'] ?? 'N/A' }}
                        </div>
                        <div class="col-md-6 mb-2">
                            <strong>Última actualización:</strong> {{ $asignacion['updatedAt'] ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
