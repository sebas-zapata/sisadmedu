@extends('layouts.app')

@section('contenido')
<div class="contenedor">
    {{-- Identificamos al usuario autenticado NO TOCAR --}}
    @php
    /** @var LoginUsuario $usuario */
    $usuario = Auth::user();
    @endphp

    <div class="alert d-flex align-items-center justify-content-center text-light shadow-lg border-0 mb-4 p-3"
        style="background: linear-gradient(135deg, #5a2d82, #7f4dbf); border-radius: 12px;">
        <i class="fas fa-handshake me-3 fa-2x" style="color: #ffff;"></i>
        <div class="text-center">
            <span class="fw-semibold">Bienvenido</span>
            <strong style="color:#ffff">{{ $usuario->nombres }}</strong>, estás en el panel del rol
            <strong class="text-uppercase" style="color:#ffff">{{ $usuario->rol->nombre }}</strong>.
        </div>
    </div>



    {{-- Tarjeta de módulos --}}
    <div class="contenedor-dashboard mb-4">
        @if (session('debe_cambiar_contrasena'))
        <div class="toast-container position-fixed top-0 end-0 p-2 p-md-3" style="z-index: 1100;">
            <div class="toast show text-bg-light border-0 shadow-lg" style="max-width: 400px; min-width: 280px;" role="alert" aria-live="assertive" aria-atomic="true">

                <!-- Toast body -->
                <div class="toast-body p-2 p-sm-3">

                    <!-- Contenido principal: icono + texto -->
                    <div class="d-flex align-items-start align-items-sm-center gap-2 mb-2 mb-sm-3">
                        <i class="fa-solid fa-triangle-exclamation fa-lg text-dark flex-shrink-0 mt-1 mt-sm-0"></i>
                        <span class="flex-grow-1 small">
                            <b>{{ Auth::user()->nombres }}</b>, cambia tu contraseña por seguridad.
                        </span>
                    </div>

                    <!-- Botones -->
                    <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                        <a href="{{ route('cambiar_contraseña') }}" class="btn boton-toast-contraseña btn-sm text-white">
                            <i class="fa-solid fa-key me-1"></i>Cambiar
                        </a>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">
                            <i class="fa-solid fa-xmark me-1"></i>Cerrar
                        </button>
                    </div>

                </div>
            </div>
        </div>
        @endif


        <div class="encabezado-dashboard">
            <h2>
                <i class="fas fa-graduation-cap"></i> Áreas Académicas
            </h2>
        </div>

        <div class="d-flex flex-wrap justify-content-center align-items-stretch gap-1">

            {{-- SOLO Administrador, Coordinador, Rector y Secretaria --}}
            @if ($usuario->rol && in_array($usuario->rol->nombre, ['Administrador', 'Rector', 'Secretaria']))
            <div class="module">
                <p class="module-title"><i class="fas fa-users"></i> Gestión de Usuarios</p>
                <p class="module-total">Total: <strong>{{ $totalUsuarios }}</strong></p>
                <a class="module-button" href="{{ route('usuarios.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Usuarios
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-chalkboard-teacher"></i> Gestión de Docentes</p>
                <p class="module-total">Total: <strong>{{ $totalDocentes }}</strong></p>
                <a class="module-button" href="{{ route('docentes.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Docentes
                </a>
            </div>
            @endif

            {{-- SOLO Administrador --}}
            @if ($usuario->rol && $usuario->rol->nombre === 'Administrador')
            <div class="module">
                <p class="module-title"><i class="fas fa-layer-group"></i> Gestión de Grados</p>
                <p class="module-total">Total: <strong>{{ $totalGrados }}</strong></p>
                <a class="module-button" href="{{ route('grados.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Grados
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-user-graduate"></i> Estudiantes</p>
                <p class="module-total">Total: <strong>{{ $totalEstudiantes }}</strong></p>
                <a class="module-button" href="{{ route('estudiantes.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Estudiantes
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fa-solid fa-calendar-days"></i> Horarios</p>
                <p class="module-total">Total: <strong>{{ $totalHorarios }}</strong></p>
                <a class="module-button" href="{{ route('horarios.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Horarios
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-book"></i> Materias</p>
                <p class="module-total">Total: <strong>{{ $totalMaterias }}</strong></p>
                <a class="module-button" href="{{ route('materias.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Materias
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fa-solid fa-link"></i> Asignacion <br> materia a Docentes</p>
                <p class="module-total">Total: <strong>{{ $totalAsignaciones ?? 0 }}</strong></p>
                <a class="module-button" href="{{ route('asignaciones.index') }}">
                    <i class="fas fa-sign-in-alt"></i> Asignaciones
                </a>
            </div>
            @endif

            {{-- SOLO Estudiantes --}}
            @if ($usuario->rol && $usuario->rol->nombre === 'Estudiante')
            <div class="module">
                <p class="module-title"><i class="fa-solid fa-calendar"></i> Mi Horario</p>
                <p class="module-total">Consulta tu horario</p>
                <a class="module-button" href="{{ route('estudiante.horario') }}">
                    <i class="fas fa-eye"></i> Ver Horario
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fa-solid fa-calendar"></i> Observaciones</p>
                <p class="module-total">Consulta tus observaciones</p>
                <a class="module-button" href="{{ route('estudiante.observaciones') }}">
                    <i class="fas fa-eye"></i> Ver Observaciones
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fa-solid fa-user-graduate"></i> Mi Informacion</p>
                <p class="module-total">Consulta tu informacion</p>
                <a class="module-button" href="{{ route('estudiante.informacion') }}">
                    <i class="fas fa-eye"></i> Ver Informacion
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fa-solid fa-certificate"></i> Generar certificado</p>
                <p class="module-total">Documento de estudio</p>
                <a class="module-button" href="{{ route('pdf.consultar') }}">
                    <i class="fas fa-eye"></i> Ver Certificado
                </a>
            </div>
            @endif

            @if($usuario->rol && $usuario->rol->nombre == "Docente")
            <div class="module">
                <p class="module-title"><i class="fa-solid fa-user"></i>
                    Mi Informacion</p>
                <p class="module-total">Consulta tu informacion como docente</p>
                <a class="module-button" href="{{ route('docente.informacion') }}">
                    <i class="fas fa-eye"></i> Ver Informacion
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fa-solid fa-user-graduate"></i> Mis Grados Asignados</p>
                <p class="module-total">Consulta tus grados asignados</p>
                <a class="module-button" href="{{ route('docente.estudiantes') }}">
                    <i class="fas fa-eye"></i> Ver Grados
                </a>
            </div>

            <div class="module">
                <p class="module-title"><i class="fas fa-book"></i> Mis Asignaturas</p>
                <p class="module-total">Consulta tus asignaturas</p>
                <a class="module-button" href="{{ route('docente.asignaturas') }}">
                    <i class="fas fa-eye"></i> Ver Asignaturas
                </a>
            </div>
            @endif

        </div>
    </div>

    {{-- SOLO ADMINISTRADOR: Gráficas --}}
    @if ($usuario->rol && $usuario->rol->nombre === 'Administrador')
    <div class="row">
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
    @endif

    {{-- Contenedor de datos --}}
    <div id="datos-dashboard"
        data-estudiantes="{{ $totalEstudiantes }}"
        data-usuarios="{{ $totalUsuarios }}"
        data-docentes="{{ $totalDocentes }}"
        data-grados="{{ $totalGrados }}"
        data-horarios="{{ $totalHorarios }}"
        data-materias="{{ $totalMaterias }}"
        data-asignaciones="{{ $totalAsignaciones }}">
    </div>
</div>
@endsection