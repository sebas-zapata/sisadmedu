@extends('layouts.show')

@section('titulo')

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Encabezado con color institucional --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-book fa-lg me-2"></i>
                <span class="fw-bold fs-5">{{ $materia->descripcion }}</span>
            </div>
            <a href="{{ route('materias.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver
            </a>
        </div>

        {{-- Cuerpo principal --}}
        <div class="card-body bg-light">
            <div class="text-center mb-4">
                <h4 class="fw-bold text-dark mb-1">
                    <i class="fa-solid fa-chalkboard-teacher me-2" style="color: #461c68;"></i>
                    Docentes que imparten esta materia
                </h4>
                <hr class="w-50 mx-auto">
            </div>

            {{-- Tabla de docentes --}}
            @if($materia->docentes->isEmpty())
                <div class="alert text-center rounded-3 shadow-sm">
                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                    No hay docentes asignados a esta materia.
                </div>
            @else
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-hover table-bordered align-middle mb-0 bg-white">
                        <thead class="text-white text-center" style="background-color: #461c68;">
                            <tr>
                                <th style="width: 15%">ID Documento</th>
                                <th style="width: 25%">Nombres</th>
                                <th style="width: 25%">Apellidos</th>
                                <th style="width: 35%">Correo Electrónico</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($materia->docentes as $doc)
                            <tr>
                                <td class="fw-bold">{{ $doc->usuario->documento ?? 'N/A' }}</td>
                                <td>{{ $doc->primer_nombre }} {{ $doc->segundo_nombre }}</td>
                                <td>{{ $doc->primer_apellido }} {{ $doc->segundo_apellido }}</td>
                                <td>{{ $doc->usuario->correo_electronico ?? 'Sin correo' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
