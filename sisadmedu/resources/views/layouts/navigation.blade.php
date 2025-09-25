@include('layouts.offcanvas')
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
      <!-- Menú derecho -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">

        <!-- Botón que abre el offcanvas -->
        <li class="nav-item me-2 mt-2">
          <button class="btn btn-light text-dark btn-sm mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="menuOffcanvas">
            <i class="fas fa-bars"></i> Panel
          </button>
        </li>

        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle me-2"></i>{{ Auth::user()->nombres }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li>
              <a class="btn btn-secondary btn-sm d-block m-auto w-50" href="{{ route('perfil.edit') }}">
                <i class="fas fa-user-circle"></i> Perfil
              </a>
            </li>
            <hr>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="px-3">
                @csrf
                <button class="btn btn-danger btn-sm w-100" type="submit"><i class="fas fa-sign-out-alt"></i>
                  Cerrar sesión
                </button>
              </form>
            </li>
          </ul>
        </li>
        @endif
      </ul>
    </div>
  </div>
</nav>