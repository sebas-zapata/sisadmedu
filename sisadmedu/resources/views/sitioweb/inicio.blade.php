<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('images/Logo SISADMEDU.jpg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/web-site/css/estilos.css') }}">
    <title>Inicio | SISADMEDU</title>
</head>

<body>
    {{-- Cargar loader oculto --}}
    @include('auth.partials._loader_web')
    <div class="contenedor-principal">
        <header>
            <!-- <header> -->
            <nav class="navbar navbar-expand-lg w-100" id="inicio">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route ('inicio') }}"><img class="logo" src="{{ asset('images/Logo SISADMEDU.jpg') }}" alt="Logo SISADMEDU"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link links-encabezado" aria-current="page" href="#inicio"><i class="fa-solid fa-house"></i>
                                    Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links-encabezado" href="#acerca"><i class="fa-solid fa-circle-info"></i>
                                    Acerca de nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link links-encabezado" href="#contactanos"><i class="fa-solid fa-envelope"></i>
                                    Contactanos</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <!-- </header> -->
        <main>
            <article class="articulo-1" id="inicio">
                <section class="seccion-1">
                    <h1 class="titulo-seccion-1">BIENVENIDO A <strong>SISADMEDU</strong></h1>
                    <p class="descripcion-seccion-1">
                        Explore y descubra más sobre nosotros para aumentar su confianza <br> en el uso de nuestro
                        sistema administrador educativo.
                    </p>
                    <a class="btn-mas-informacion" id="btnAcceder" href="{{ route ('login')}}"><i class="fa-solid fa-right-to-bracket"></i>
                        Acceder al sistema</a>
                </section>
                <section>
                    <img class="imagen-birrete" src="{{ asset('images/imagen-birrete.png') }}" alt="Birrete">
                </section>
            </article>
            <h1 class="titulo-articulo-2">Acerca de nosotros</h1>
            <article class="articulo-2" id="acerca">
                <section class="seccion-2">
                    <div class="contenedor-icono">
                        <i class="iconos-acerca-de-nosotros fa-solid fa-circle-check"></i>
                    </div>
                    <h3 class="titulo-acerca-de-nosotros">Objetivo</h3>
                    <p class="parrafo-acerca-de-nosotros">
                        Nuestro objetivo es diseñar un sistema que sea altamente intuitivo y accesible para todos los
                        usuarios. Nos esforzamos por ofrecer una interfaz visualmente atractiva y fácil de navegar.
                        Además, nos centramos en garantizar una optimización superior para un rendimiento eficiente y
                        una experiencia de usuario fluida.</p>
                </section>
                <section class="seccion-3">
                    <div class="contenedor-icono">
                        <i class="iconos-acerca-de-nosotros fa-solid fa-flag"></i>
                    </div>
                    <h3 class="titulo-acerca-de-nosotros">Mision</h3>
                    <p class="parrafo-acerca-de-nosotros">
                        Nuestra misión es ofrecer un sistema que sea intuitivo y accesible para todos los usuarios,
                        garantizando una experiencia agradable y eficiente. Nos comprometemos a proporcionar una
                        plataforma altamente optimizada, que permita a los usuarios realizar sus tareas de manera rápida
                        y sin complicaciones, asegurando así su completa satisfacción.
                    </p>
                </section>
                <section class="seccion-4">
                    <div class="contenedor-icono">
                        <i class="iconos-acerca-de-nosotros fa-solid fa-star"></i>
                    </div>
                    <h3 class="titulo-acerca-de-nosotros">Vision</h3>
                    <p class="parrafo-acerca-de-nosotros">
                        Nuestro objetivo es implementar nuestro sistema en todos los centros educativos del país,
                        demostrando que es significativamente más fácil de usar que los sistemas existentes.
                    </p>
                </section>
            </article>
            <article class="articulo-3">
                <section class="seccion-5">
                    <h3 class="titulo-seccion-5">¿Quienes somos?</h3>
                    <p class="parrafo-seccion-5">
                        Somos un equipo de desarrolladores dedicados a crear el mejor sistema educativo del país.
                        Nuestro objetivo es ofrecer una plataforma fácil de usar para todos, mejorando la calidad y el
                        rendimiento de los sistemas existentes. Queremos transformar la educación mediante soluciones
                        innovadoras y eficientes.
                    </p>
                </section>
                <section class="seccion-6">
                    <img class="imagen-quienes-somos" src="{{ asset('images/Quienes somos.jpg') }}" alt="Imagen quienes somos">
                </section>
            </article>
            <article class="articulo-4" id="contactanos">
                <section class="seccion-7">
                    <h3 class="titulo-seccion-7">Contactanos</h3>
                    <p class="parrafo-seccion-7">
                        Si experimenta algún inconveniente, por favor no dude en enviar un mensaje a nuestro equipo <br>
                        de soporte.
                    </p>
                    <form method="post" class="formulario-contacto mx-auto" id="formularioContacto" autocomplete="off" style="max-width: 450px;">

                        <!-- Nombre completo -->
                        <div class="form-floating mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="nombreCompleto"
                                name="nombreCompleto"
                                placeholder="Nombre completo">
                            <label for="nombreCompleto">Nombre completo</label>
                        </div>

                        <!-- Correo electrónico -->
                        <div class="form-floating mb-3">
                            <input
                                type="email"
                                class="form-control"
                                id="correoElectronico"
                                name="correoElectronico"
                                placeholder="Correo electrónico">
                            <label for="correoElectronico">Correo electrónico</label>
                        </div>

                        <!-- Mensaje -->
                        <div class="form-floating mb-3">
                            <textarea
                                class="form-control"
                                placeholder="Escribe tu mensaje"
                                id="mensaje"
                                name="mensaje"
                                style="height: 120px"></textarea>
                            <label for="mensaje">Mensaje</label>
                        </div>

                        <!-- Botón -->
                        <button class="btn-formulario-contacto w-100 m-auto py-2" type="submit">
                            Enviar mensaje
                        </button>

                    </form>
                </section>
            </article>
            <button id="btnScrollTop"> <i class="fa-solid fa-arrow-up"></i></button>
        </main>
        <footer>
            © 2025 SISADMEDU. todos los derechos reservados.
        </footer>
    </div>
    <script src="{{ asset('js/sitio-web/validar-formulario-sitio-web.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/loader/loader.js')}}"></script>
    <script src="{{ asset('js/boton-flotante-scroll.js')}}"></script>
    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>