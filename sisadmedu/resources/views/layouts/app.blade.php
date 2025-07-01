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

    {{-- Tu hoja de estilos personalizada --}}
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boton-principal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boton-accion.css') }}" rel="stylesheet">
</head>

<body>

    {{-- Barra de Navegación personalizada --}}
    @include('layouts.navigation')

    {{-- Contenido principal --}}
    <main class="container-fluid py-4">
        @yield('content')
    </main>

    {{-- Bootstrap JS (opcional si usas navbar o modales) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert para mensajes --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- JS --}}
    <script src="{{ asset('js/confirmacion-eliminar.js') }}"></script>
    <script src="{{ asset('js/validar-usuario.js') }}"></script>
    <script src="{{ asset('js/validar-editar-usuario.js') }}"></script>

    {{-- Mensajes de éxito con SweetAlert --}}
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mensaje = @json(session('success'));
            let icono = 'success';
            let titulo = '¡Éxito!';

            if (mensaje.includes('eliminado')) {
                titulo = 'Eliminado';
            } else if (mensaje.includes('actualizado')) {
                titulo = 'Actualizado';
            } else if (mensaje.includes('creado')) {
                titulo = 'Creado';
            }

            Swal.fire({
                title: titulo,
                text: mensaje,
                icon: icono,
                confirmButtonColor: '#461c68',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
    @endif

</body>

</html>