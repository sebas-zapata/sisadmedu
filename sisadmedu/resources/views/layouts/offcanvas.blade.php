<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">
            <i class="fas fa-user-tie"></i> {{ Auth::user()->rol->nombre }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <hr>
    </div>

    <!-- Sidebar -->
    <div class="offcanvas-body text-white p-0">
        <ul class="nav flex-column py-3">

            {{-- SOLO ADMINISTRADOR --}}
            @if(Auth::user()->rol->nombre === "Administrador")
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-users me-2"></i>
                    <span>Usuarios</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('docentes.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    <span>Docentes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('estudiantes.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-user-graduate me-2"></i>
                    <span>Estudiantes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('grados.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-layer-group me-2"></i>
                    <span>Grados</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('horarios.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fa-solid fa-calendar-days me-2"></i>
                    <span>Horarios</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('materias.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-book me-2"></i>
                    <span>Materias</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('asignaciones.index') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fa-solid fa-link"></i>
                    <span>Asignacion materia a Docentes</span>
                </a>
            </li>
            @endif

            {{-- Permisos para Estudiante --}}
            @if(Auth::user()->rol->nombre === "Estudiante")
            <li class="nav-item">
                <a href="{{ route('estudiante.horario') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fa-solid fa-calendar me-2"></i>
                    <span>Mi Horario</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('estudiante.observaciones') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fa-solid fa-book me-2"></i>
                    <span>Observaciones</span>
                </a>
            </li>
            @endif
            {{-- Permisos para Docente --}}
            @if(Auth::user()->rol->nombre === "Docente")
            <li class="nav-item">
                <a href="{{ route('docente.informacion') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fa-solid fa-user"></i>
                    <span>Mi Informacion</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('docente.estudiantes') }}" class="link-modulo nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span>Grados Asignados</span>
                </a>
            </li>
            @endif

            <!-- Aquí puedes agregar más módulos según roles -->
        </ul>
    </div>
</div>