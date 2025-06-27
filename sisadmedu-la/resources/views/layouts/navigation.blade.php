<nav class="navbar navbar-expand-lg navbar-sisadmedu shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="{{route ('dashboard')}}">
      <img src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo" class="rounded-circle me-2" width="40" height="40">
      <span class="text-white fw-bold">SISADMEDU</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Módulos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('usuarios.index')}}">Usuarios</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>