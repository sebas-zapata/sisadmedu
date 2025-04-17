<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISADMEDU</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    {{-- Estilos de Vite (si usas Laravel Breeze, Jetstream o Tailwind directamente) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    {{-- Barra de Navegación personalizada --}}
    @include('layouts.navigation')

    {{-- Contenido principal --}}
    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/confirmacion-eliminar.js') }}"></script>
    @if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const mensaje = "{{ session('success') }}";
        let icono = 'success';
        let titulo = '¡Éxito!';

        if (mensaje.includes('eliminado')) {
            icono = 'success';
            titulo = 'Eliminado';
        } else if (mensaje.includes('actualizado')) {
            icono = 'success';
            titulo = 'Actualizado';
        } else if (mensaje.includes('creado')) {
            icono = 'success';
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