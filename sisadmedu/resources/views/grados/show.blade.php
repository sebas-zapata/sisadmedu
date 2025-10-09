@extends('layouts.show')

@section('titulo')
@endsection

@section('informacion')
<div class="container py-4">

    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        {{-- 🔹 Encabezado --}}
        <div class="card-header d-flex justify-content-between align-items-center text-white" style="background-color: #461c68;">
            <span class="fw-bold fs-5">
                <i class="fas fa-graduation-cap me-2"></i> Estudiantes del grado {{ $grado->nombre_grado }}
            </span>
            <a href="{{ route('grados.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- 🔹 Contenido --}}
        <div class="card-body bg-light">
            @if($grado->estudiantes->isEmpty())
                <div class="alert alert-warning text-center mb-0" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    No hay estudiantes registrados en este grado.
                </div>
            @else
                {{-- 🔸 Campo de búsqueda --}}
                <div class="input-group mb-4">
                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                    <input
                        type="text"
                        class="form-control"
                        id="filtroNombre"
                        placeholder="Buscar estudiante por nombre o apellido..."
                        pattern="[A-Za-z\s]*"
                    >
                </div>

                {{-- 🔸 Listado de estudiantes --}}
                <div class="row" id="listaEstudiantes">
                    @foreach($grado->estudiantes as $est)
                    <div class="columna-estudiante col-md-6 col-lg-4 mb-4" 
                        data-nombre="{{ strtolower($est->primer_nombre_estudiante . ' ' . $est->primer_apellido_estudiante) }}">
                        
                        {{-- Tarjeta del estudiante --}}
                        <div class="tarjeta-estudiante card h-100 border-0 shadow-sm rounded-4 overflow-hidden" style="background-color: #f8f9fa;">
                            {{-- Encabezado degradado --}}
                            <div class="card-header text-center text-white fw-bold"
                                style="background: linear-gradient(90deg, #4b0082, #7a1fa2);">
                                {{ $est->primer_nombre_estudiante }} {{ $est->primer_apellido_estudiante }}
                                <div><small class="text-white-50">Matrícula: {{ $est->matricula }}</small></div>
                            </div>

                            {{-- Cuerpo --}}
                            <div class="card-body text-center">
                                <p class="mb-2">
                                    <i class="fas fa-id-badge text-primary"></i>
                                    <strong>Documento:</strong> {{ $est->usuario->documento }}
                                </p>
                                <p class="mb-2">
                                    <i class="fas fa-calendar-alt text-success"></i>
                                    <strong>Edad:</strong> {{ $est->edad_estudiante }} años
                                </p>
                                <p class="mb-0">
                                    <i class="fas fa-envelope text-danger"></i>
                                    <strong>Correo:</strong> {{ $est->usuario->correo_electronico }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
