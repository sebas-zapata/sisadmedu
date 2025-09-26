@include('layouts.offcanvas')
<nav class="navbar navbar-expand-lg navbar-sisadmedu shadow-sm">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Logo centrado -->
    <a class="navbar-brand mx-auto d-flex align-items-center text-white fw-bold" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo"
        class="rounded-circle me-2" width="60" height="60">
    </a>
    
    <!-- Botón hamburguesa que abre el offcanvas -->
    <button class="btn text-white mt-3 me-2" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <i class="fas fa-bars fs-4"></i>
    </button>


    <!-- Botón colapsable (en móviles) -->
    <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">

        <!-- Dropdown Perfil -->
        @if(Auth::check())
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white fw-semibold d-flex align-items-center" href="#"
            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->nombres }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdownMenuLink">
            <li>
              <a class="dropdown-item" href="{{ route('perfil.edit') }}">
                <i class="fas fa-user-circle me-2"></i> Perfil
              </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('logout') }}" method="POST" class="px-3">
                @csrf
                <button class="btn btn-danger btn-sm w-100" type="submit">
                  <i class="fas fa-sign-out-alt"></i> Cerrar sesión
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
