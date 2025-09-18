@extends('layouts.app')

@section('contenido')
<div class="container">

    {{-- Tarjeta de módulos --}}
    <div class="card w-100 mb-4">
        <div class="card-header">
            <h2>
                <i class="fas fa-graduation-cap"></i> Áreas Académicas
            </h2>
        </div>
        <div class="card-body d-flex flex-wrap justify-content-between">
            <div class="module">
                <p class="module-title"><i class="fas fa-users"></i> Gestión de Usuarios</p>
                    <p class="module-total">
                Total: <strong>{{ $totalUsuarios }}</strong>
                </p>
                <a class="module-button" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Usuarios
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-chalkboard-teacher"></i> Gestión de Docentes</p>
                    <p class="module-total">
                Total: <strong>{{ $totalDocentes }}</strong>
                </p>
                <a class="module-button" href="{{ route('docentes.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Docentes
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-layer-group"></i> Gestión de Grados</p>
                    <p class="module-total">
                        Total: <strong>{{ $totalGrados }}</strong>
                </p>
                <a class="module-button" href="{{ route('grados.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Grados
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-user-graduate"></i> Estudiantes</p>
                <p class="module-total">
                    Total: <strong>{{ $totalEstudiantes }}</strong>
                </p>
                <a class="module-button" href="{{ route('estudiantes.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Estudiantes
                </a>
            </div>
        </div>
    </div>

    {{-- Fila de dos columnas con gráficas --}}
    <div class="row">
        {{-- Gráfico de barras --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-white">
                    <strong class="module-title">Resumen General</strong>
                </div>
                <div class="card-body" style="height: 350px;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Gráfico de pastel --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-light titulo">
                    <strong class="module-title">Distribución de Registros</strong>
                </div>
                <div class="card-body" style="height: 350px;">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Gráfico de líneas --}}
<div class="col-md-4 mb-4">
    <div class="card shadow-sm">
        <div class="card-header bg-light text-white">
            <strong class="module-title">Evolución</strong>
        </div>
        <div class="card-body" style="height: 350px;">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</div>

    </div>

    {{-- Contenedor de datos --}}
    <div 
        id="datos-dashboard"
        data-estudiantes="{{ $totalEstudiantes }}"
        data-usuarios="{{ $totalUsuarios }}"
        data-docentes="{{ $totalDocentes }}"
        data-grados="{{ $totalGrados }}">
    </div>

</div>
@endsection
