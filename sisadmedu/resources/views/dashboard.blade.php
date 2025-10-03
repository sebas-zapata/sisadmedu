@extends('layouts.app')

@section('contenido')
    <div class="contenedor">
        {{-- Identificamos al usuario autenticado NO TOCAR --}}
        @php
            /** @var LoginUsuario $usuario */
            $usuario = Auth::user();
        @endphp
        {{-- Mensaje de bienvenida --}}
        <div class="alert shadow-sm d-flex align-items-center justify-content-center mb-4"
            style="background-color: #4B0082; color: #fff; font-size: 1.2rem; border-radius: 10px;">
            <i class="fas fa-handshake me-2 fa-lg"></i>
            <div>
                Bienvenido <strong>{{ $usuario->nombres }}</strong>, estás en el panel del rol
                <strong>{{ $usuario->rol->nombre }}</strong>.
            </div>
        </div>


        {{-- Tarjeta de módulos --}}
        <div class="contenedor-dashboard mb-4">
            @if (session('debe_cambiar_contrasena'))
                <div class="position-fixed top-0 end-0 p-3" style="z-index: 1100">
                    <div id="toastContrasena" class="toast show align-items-center text-bg-light border-0 shadow-lg"
                        role="alert" aria-live="assertive" aria-atomic="true">

                        <div class="d-flex">
                            <div class="toast-body d-flex align-items-center">
                                <i class="fa-solid fa-triangle-exclamation me-2 fa-lg"></i>
                                <span>
                                    <b>{{ Auth::user()->nombres }}</b>, cambia tu contraseña por seguridad.
                                </span>
                                <a href="{{ route('cambiar_contraseña') }}" class="module-button btn-sm">
                                    Cambiar
                                </a>
                            </div>

                            <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Cerrar"></button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="encabezado-dashboard">
                <h2>
                    <i class="fas fa-graduation-cap"></i> Áreas Académicas
                </h2>
            </div>
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-4 p-4">
                @if (
                    ($usuario->rol && $usuario->rol->nombre === 'Administrador') ||
                        $usuario->rol->nombre === 'Coordinador' ||
                        $usuario->rol->nombre === 'Rector' ||
                        $usuario->rol->nombre === 'Secretaria')
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
                @endif
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
                @if (
                    ($usuario->rol && $usuario->rol->nombre === 'Administrador') ||
                        $usuario->rol->nombre === 'Coordinador' ||
                        $usuario->rol->nombre === 'Rector' ||
                        $usuario->rol->nombre === 'Secretaria')
                    <div class="module">
                        <p class="module-title"><i class="fa-solid fa-calendar-days"></i> Horarios</p>
                        <p class="module-total">
                            Total: <strong>{{ $totalHorarios }}</strong>
                        </p>
                        <a class="module-button" href="{{ route('horarios.index') }}">
                            <i class="fas fa-sign-in-alt"></i> Horarios
                        </a>
                    </div>
                    <div class="module">
                        <p class="module-title"><i class="fa-solid fa-calendar-days"></i> Materias</p>
                        <p class="module-total">
                            Total: <strong>{{ $totalHorarios }}</strong>
                        </p>
                        <a class="module-button" href="{{ route('materias.index') }}">
                            <i class="fas fa-book"></i> Materias
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- Fila de dos columnas con gráficas --}}
        <div class="row">
            {{-- Gráfico de pastel --}}
            <div class="col-md-5 mb-4">
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
            <div class="col-md-7 mb-4">
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
        <div id="datos-dashboard" data-estudiantes="{{ $totalEstudiantes }}" data-usuarios="{{ $totalUsuarios }}"
            data-docentes="{{ $totalDocentes }}" data-grados="{{ $totalGrados }}" data-horarios="{{ $totalHorarios }}"
            data-materia="{{ $totalMaterias }}">
        </div>

    </div>
@endsection
