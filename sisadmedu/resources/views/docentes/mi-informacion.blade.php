@extends('layouts.show')

@section('titulo', 'Información del Docente')

@section('informacion')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- ENCABEZADO --}}
        <div class="card-header text-white d-flex align-items-center justify-content-between" style="background-color: #461c68;">
            <div>
                <i class="fa-solid fa-chalkboard-teacher fa-lg me-2"></i>
                <span class="fw-bold fs-5">Mi Información Personal</span>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i> Volver al Panel
            </a>
        </div>

        {{-- AVATAR --}}
        <div class="text-center py-4 bg-light">
            <img src="{{ Avatar::create($docente->primer_nombre . ' ' . $docente->primer_apellido)->toBase64() }}"
                alt="Avatar"
                class="rounded-circle shadow-sm border border-3"
                style="border-color: #461c68;"
                width="110"
                height="110">

            <h4 class="mt-3 mb-0 fw-bold text-dark">
                {{ $docente->primer_nombre_docente }}
                {{ $docente->segundo_nombre_docente }}
                {{ $docente->primer_apellido_docente }}
                {{ $docente->segundo_apellido_docente }}
            </h4>

            <span class="badge mt-2 px-3 py-2 fs-6 text-white" style="background-color: #461c68;">
                Documento: {{ $usuario->documento }}
            </span>
        </div>

        {{-- CONTENIDO PRINCIPAL --}}
        <div class="card-body bg-light">

            {{-- TABS --}}
            <ul class="nav nav-tabs border-0 mb-4" id="infoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-dark" id="usuario-tab" data-bs-toggle="tab" data-bs-target="#usuario" type="button" role="tab" aria-controls="usuario" aria-selected="true">
                        <i style="color: #461c68;" class="fa-solid fa-id-card me-2"></i>Usuario
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="docente-tab" data-bs-toggle="tab" data-bs-target="#docente" type="button" role="tab" aria-controls="docente" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-chalkboard-user me-2"></i>Docente
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-dark" id="asignaciones-tab" data-bs-toggle="tab" data-bs-target="#asignaciones" type="button" role="tab" aria-controls="asignaciones" aria-selected="false">
                        <i style="color: #461c68;" class="fa-solid fa-book me-2"></i>Asignaciones
                    </button>
                </li>
            </ul>

            {{-- CONTENIDO DE LOS TABS --}}
            <div class="tab-content" id="infoTabsContent">

                {{-- TAB USUARIO --}}
                <div class="tab-pane fade show active" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-user me-2"></i>Información del Usuario
                        </div>
                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Correo electrónico:</strong> {{ $usuario->correo_electronico }}</div>
                                <div class="col-md-6 mb-2"><strong>Celular:</strong> {{ $usuario->celular ?? 'No registrado' }}</div>
                                <div class="col-md-6 mb-2"><strong>Rol:</strong> Docente</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB DOCENTE --}}
                <div class="tab-pane fade" id="docente" role="tabpanel" aria-labelledby="docente-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-chalkboard-user me-2"></i>Información del Docente
                        </div>

                        <div class="card-body bg-white">
                            <div class="row">
                                <div class="col-md-6 mb-2"><strong>Nombre completo:</strong>
                                    {{ $docente->primer_nombre }} {{ $docente->segundo_nombre }} {{ $docente->primer_apellido }} {{ $docente->segundo_apellido }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Fecha de nacimiento:</strong>
                                    {{ \Carbon\Carbon::parse($docente->fecha_nacimiento)->format('d/m/Y') }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Teléfono:</strong>
                                    {{ $docente->telefono ?? 'No registrado' }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Dirección:</strong>
                                    {{ $docente->direccion ?? 'No registrada' }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Estado civil:</strong>
                                    {{ $docente->estado_civil ?? 'No registrado' }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Especialización:</strong>
                                    {{ $docente->especializacion ?? 'No registrada' }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Años de experiencia:</strong>
                                    {{ $docente->anios_experiencia ?? '0' }} años
                                </div>

                                <div class="col-md-6 mb-2"><strong>Fecha de ingreso:</strong>
                                    {{ \Carbon\Carbon::parse($docente->fecha_ingreso)->format('d/m/Y') }}
                                </div>

                                <div class="col-md-6 mb-2"><strong>Tipo de contrato:</strong>
                                    {{ ucfirst($docente->tipo_contrato) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- TAB ASIGNACIONES --}}
                <div class="tab-pane fade" id="asignaciones" role="tabpanel" aria-labelledby="asignaciones-tab">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header fw-bold text-white" style="background-color: #461c68;">
                            <i class="fa-solid fa-book me-2"></i>Grados y Materias Asignadas
                        </div>
                        <div class="card-body bg-white">
                            @if ($asignaciones->isEmpty())
                            <div class="alert alert-warning text-center">No tienes materias asignadas.</div>
                            @else
                            <table class="table table-bordered table-striped text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Grado</th>
                                        <th>Materia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asignaciones as $asignacion)
                                    <tr>
                                        <td>{{ $asignacion->grado->nombre_grado }}</td>
                                        <td>{{ $asignacion->materia->descripcion }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection