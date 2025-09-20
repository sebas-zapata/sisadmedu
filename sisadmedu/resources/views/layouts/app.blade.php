<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISADMEDU</title>

    {{-- Ícono del navegador --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Bootstrap CSS desde CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome (íconos) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    {{-- estilos personalizados --}}
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boton-principal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boton-accion.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/login.css') }}" rel="stylesheet">

    {{-- Meta tags para evitar caché --}}
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

</head>

<body>


    {{-- Barra de Navegación personalizada --}}
    @if (!isset($ocultarNavbar) || !$ocultarNavbar)
    @include('layouts.navigation')
    @endif

    {{-- Contenido principal --}}
        @yield('contenido')
    </main>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
    <div id="session-success" data-mensaje="{{ session('success') }}"></div>
    @endif

    
    {{-- SweetAlert para alertas personalizadas --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Chart.js para gráficos --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    {{-- Scripts personalizados --}}
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="{{ asset('js/graficos/graficos.js') }}"></script>
    <script src="{{ asset('js/usuarios/validar-usuario.js') }}"></script>
    <script src="{{ asset('js/alertas.js') }}"></script>
    <script src="{{ asset('js/login/validacion-login.js') }}"></script>
    <script src="{{ asset('js/login/validacion-logout.js') }}"></script>
    <script src="{{ asset('js/particles-js/particles-config.js') }}"></script>
    <script src="{{ asset('js/docentes/confirmar-eliminar-docentes.js') }}"></script>
    <script src="{{ asset('js/usuarios/confirmar-eliminar-usuarios.js') }}"></script>
    <script src="{{ asset('js/docentes/validar-docente.js')}}"></script>
    <script src="{{ asset('js/grados/confirmar-eliminar-grados.js') }}"></script>
    <script src="{{ asset('js/grados/validar-grado.js') }}"></script>
    <script src="{{ asset('js/estudiantes/validar-estudiante.js') }}"></script>
    <script src="{{ asset('js/grados/validar-grado.js') }}"></script>
    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')

</body>

</html>