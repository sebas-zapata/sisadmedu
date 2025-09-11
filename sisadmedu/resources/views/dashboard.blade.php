@extends('layouts.app')

@section('contenido')
<div class="container card w-100">
    <div class="card-header">
        <h2>
   <i class="fas fa-graduation-cap"></i> Áreas Académicas
</h2>
@if(session('debe_cambiar_contrasena'))
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
    <div id="alertaContrasena" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Estás usando la contraseña por defecto. 
                <a href="{{ route('cambiar_contraseña') }}" class="fw-bold text-decoration-underline text-light">Cámbiala aquí</a>.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
        </div>
    </div>
</div>
@endif
    </div>
    <div class="card-body">

        <div class="module">
            <p class="module-title"><i class="fas fa-users"></i> Gestión de Usuarios</p>
            <p class="module-description">Administración de los datos de los estudiantes, incluyendo registros y notas.</p>
            <a class="module-button" href="{{ route('usuarios.index') }}">
                 <i class="fas fa-sign-in-alt"></i> Usuarios
            </a>
        </div>

        <div class="module">
            <p class="module-title"><i class="fas fa-chalkboard-teacher"></i> Gestión de Docentes</p>
            <p class="module-description">Control de los docentes, asignaturas, horarios y más.</p>
            <a class="module-button" href="{{ route('docentes.index') }}">
                <i class="fas fa-sign-in-alt"></i> Docentes
            </a>
        </div>

        <div class="module">
            <p class="module-title"><i class="fas fa-layer-group"></i> Gestión de Grados</p>
            <p class="module-description">Gestión de los grados y su asignación a estudiantes y docentes.</p>
            <a class="module-button" href="{{ route('grados.index') }}">
                <i class="fas fa-sign-in-alt"></i> Grados
            </a>
        </div>

        <div class="module">
            <p class="module-title"><i class="fas fa-user-graduate"></i> Estudiantes</p>
            <p class="module-description">Gestión de los estudiantes, incluyendo registros y notas.</p>
            <a class="module-button" href="{{ route('estudiantes.index') }}">
                <i class="fas fa-sign-in-alt"></i> Estudiantes
            </a>
        </div>

    </div>
</div>


@endsection