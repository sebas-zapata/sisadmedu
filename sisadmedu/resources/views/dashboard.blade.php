@extends('layouts.app')

@section('contenido')
<div class="container card w-100">
    <div class="card-header">
        <h2>Módulos del Sistema</h2>
    </div>
    <div class="card-body">

        <div class="module">
            <p class="module-title"><i class="fas fa-users"></i> Gestión de Usuarios</p>
            <p class="module-description">Administración de los datos de los estudiantes, incluyendo registros y notas.</p>
            <a class="module-button" href="{{ route('usuarios.index') }}">
                <i class="fas fa-arrow-right"></i> Usuarios
            </a>
        </div>

        <div class="module">
            <p class="module-title"><i class="fas fa-chalkboard-teacher"></i> Gestión de Docentes</p>
            <p class="module-description">Control de los docentes, asignaturas, horarios y más.</p>
            <a class="module-button" href="{{ route('docentes.index') }}">
                <i class="fas fa-arrow-right"></i> Docentes
            </a>
        </div>

        <div class="module">
            <p class="module-title"><i class="fas fa-layer-group"></i> Gestión de Grados</p>
            <p class="module-description">Gestión de los grados y su asignación a estudiantes y docentes.</p>
            <a class="module-button" href="{{ route('usuarios.index') }}">
                <i class="fas fa-arrow-right"></i> Grados
            </a>
        </div>

        <div class="module">
            <p class="module-title"><i class="fas fa-chart-line"></i> Informes Académicos</p>
            <p class="module-description">Generación de informes sobre el rendimiento y asistencia de los estudiantes.</p>
            <a class="module-button" href="{{ route('usuarios.index') }}">
                <i class="fas fa-arrow-right"></i> Informes
            </a>
        </div>

    </div>
</div>


@endsection