<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">{{ Auth::user()->rol->nombre }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <hr>
    </div>
    <div class="offcanvas-body">
        <div class="dropdown mt-3">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dropdown Módulos -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-th-large me-1"></i> Módulos
                    </a>
                    <ul class="dropdown-menu shadow-sm">
                        {{-- Solo Administrador puede ver Usuarios --}}
                        @if(Auth::user()->rol_id == 1)
                        <li><a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="fas fa-users me-2"></i> Usuarios</a></li>
                        @endif
                        <li><a class="dropdown-item" href="{{ route('docentes.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i> Docentes</a></li>
                        <li><a class="dropdown-item" href="{{ route('estudiantes.index') }}"><i class="fas fa-user-graduate me-2"></i> Estudiantes</a></li>
                        <li><a class="dropdown-item" href="{{ route('grados.index') }}"><i class="fas fa-layer-group me-2"></i> Grados</a></li>
                        <!-- Agrega más módulos aquí -->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>