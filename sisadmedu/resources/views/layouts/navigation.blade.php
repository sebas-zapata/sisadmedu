<nav class="navbar navbar-expand-lg navbar-sisadmedu shadow-sm">
  <div class="container-fluid">
    <!-- Logo y nombre -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo" class="rounded-circle me-2" width="40" height="40">
      <span class="fw-bold text-white fs-5">SISADMEDU</span>
    </a>

    <!-- Botón hamburguesa en móviles -->
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Menú izquierdo -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- Dropdown Módulos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Módulos
          </a>
          <ul class="dropdown-menu shadow-sm">
            <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a></li>
            <li><a class="dropdown-item" href="{{ route('usuarios.index') }}">Usuarios</a></li>
            <!-- Agrega más módulos aquí -->
          </ul>
        </li>
      </ul>

      <!-- Menú derecho -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->correo_electronico }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li>
              <form action="{{ route('logout') }}" method="POST" class="px-3">
                @csrf
                <button class="btn btn-danger btn-sm w-100" type="submit">Cerrar sesión</button>
              </form>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>
