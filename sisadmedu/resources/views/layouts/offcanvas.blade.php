<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel"><i class="fas fa-user-circle me-2"></i>{{ Auth::user()->rol->nombre }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <hr>
    </div>
    <!-- Sidebar -->
    <div class="offcanvas-body text-white p-0">
        <ul class="nav flex-column py-3">
            {{-- Solo Administrador puede ver Usuarios --}}
            @if(Auth::user()->rol_id == 1)
            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-users me-2"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            @endif

            <li class="nav-item">
                <a href="{{ route('docentes.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    <span>Docentes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('estudiantes.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-user-graduate me-2"></i>
                    <span>Estudiantes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('grados.index') }}" class="nav-link text-white d-flex align-items-center px-3 py-2">
                    <i class="fas fa-layer-group me-2"></i>
                    <span>Grados</span>
                </a>
            </li>

            <!-- Agrega más módulos aquí -->
        </ul>
    </div>


</div>