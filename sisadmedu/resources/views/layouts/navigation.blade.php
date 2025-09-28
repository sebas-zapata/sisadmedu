@include('layouts.offcanvas')
<nav class="navbar navbar-expand-lg navbar-sisadmedu shadow-sm">
  <div class="container-fluid d-flex justify-content-between align-items-center">

    <!-- Logo centrado -->
    <a class="navbar-brand mx-auto d-flex align-items-center text-white fw-bold" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo"
        class="rounded-circle me-2" width="60" height="60">
    </a>

    <!-- Botón hamburguesa que abre el offcanvas -->
    <button class="btn mt-3 me-2 btn-hamburguesa" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <i class="fas fa-align-left fs-4"></i>
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
            <i class="fas fa-user-circle me-2 fs-5"></i>
            <span>{{ Auth::user()->nombres }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2" aria-labelledby="navbarDropdownMenuLink">
            <!-- Perfil -->
            <li>
              <a class="dropdown-item rounded-2 d-flex align-items-center py-2" href="{{ route('perfil.edit') }}">
                <i class="fas fa-user-circle me-2 icono-perfil"></i>
                Perfil
              </a>
            </li>

            <li>
              <hr class="dropdown-divider my-2">
            </li>

            <!-- Cerrar sesión -->
            <li>
              <form action="{{ route('logout') }}" method="POST" class="px-1">
                @csrf
                <button class="btn btn-sm w-100 d-flex align-items-center justify-content-center gap-2 btn-logout" type="submit">
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