<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./img/Logo SISADMEDU.jpg" type="image/x-icon">
    <title>Panel | Administrador</title>
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="d-flex flex-column flex-lg-row w-100">
                <!-- Barra lateral -->
                <div class="offcanvas offcanvas-start dashboard" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
                    <div class="offcanvas-header">
                        <h1 class="offcanvas-title text-light" id="sidebarLabel"><i class="fas fa-bars me-2"></i> Panel</h1>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column">
                            <!-- Configuración General -->
                            <li class="nav-item mb-2">
                                <a class="nav-link text-light" href="#">
                                    <i class="fas fa-sliders-h me-2"></i> Configuración General
                                </a>
                            </li>

                            <!-- Notificaciones -->
                            <li class="nav-item mb-2">
                                <a class="nav-link text-light" href="#">
                                    <i class="fas fa-bell me-2"></i> Notificaciones
                                </a>
                            </li>

                            <!-- Calendario -->
                            <li class="nav-item mb-2">
                                <a class="nav-link text-light" href="#">
                                    <i class="fas fa-calendar-alt me-2"></i> Calendario
                                </a>
                            </li>

                            <!-- Estadísticas -->
                            <li class="nav-item mb-2">
                                <a class="nav-link text-light" href="#">
                                    <i class="fas fa-chart-pie me-2"></i> Estadísticas
                                </a>
                            </li>

                            <!-- Documentación -->
                            <li class="nav-item mb-2">
                                <a class="nav-link text-light" href="#">
                                    <i class="fas fa-book me-2"></i> Documentación
                                </a>
                            </li>

                            <!-- Soporte Técnico -->
                            <li class="nav-item mb-2">
                                <a class="nav-link text-light" href="#">
                                    <i class="fas fa-life-ring me-2"></i> Soporte Técnico
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>


                <!-- Contenido principal -->
                <div class="flex-grow-1">
                    <!-- Botón para mostrar/ocultar la barra lateral -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
                        <div class="container-fluid">
                            <!-- Botón Panel -->
                            <button class="btn btn-panel me-3 px-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                                <i class="fas fa-bars"></i>
                            </button>

                            <!-- Branding -->
                            <a class="navbar-brand" href="admin.php">
                                <i class="fas fa-gauge-high"></i> Dashboard
                            </a>

                            <!-- Botón Hamburguesa -->
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <!-- Contenido del Navbar -->
                            <div class="collapse navbar-collapse" id="navbarResponsive">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item dropdown">
                                        <!-- Dropdown Usuario -->
                                        <a class="nav-link dropdown-toggle d-flex align-items-center btn-perfil" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fas fa-user-circle me-2"></i> Usuario
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                            <li><a class="dropdown-item link-perfil" href="#">Perfil</a></li>
                                            <li><a class="dropdown-item link-perfil" href="#">Configuraciones</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item link-perfil" href="#">Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <!-- Tarjetas -->
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-white tarjeta mb-3 hover-card">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <!-- Icono principal del módulo -->
                                        <i class="fa-solid fa-users fa-3x mb-3"></i>

                                        <!-- Título de la tarjeta -->
                                        <h5 class="card-title">Usuarios</h5>

                                        <!-- Descripción del módulo -->
                                        <p class="card-text">Número total: 5</p>

                                        <!-- Enlace al módulo -->
                                        <a href="./CRUD/usuarios.php" class="btn btn-link text-white mt-3 d-flex align-items-center">
                                            Ir al módulo <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white tarjeta mb-3 hover-card">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <!-- Icono principal del módulo -->
                                        <i class="fa-solid fa-chalkboard-teacher fa-3x mb-3"></i>

                                        <!-- Título de la tarjeta -->
                                        <h5 class="card-title">Docentes</h5>

                                        <!-- Descripción del módulo -->
                                        <p class="card-text">Número total: 0</p>

                                        <!-- Enlace al módulo -->
                                        <a href="/usuarios" class="btn btn-link text-white mt-3 d-flex align-items-center">
                                            Ir al módulo <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white tarjeta mb-3 hover-card">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <!-- Icono principal del módulo -->
                                        <i class="fa-solid fa-user-graduate fa-3x mb-3"></i>

                                        <!-- Título de la tarjeta -->
                                        <h5 class="card-title">Estudiantes</h5>

                                        <!-- Descripción del módulo -->
                                        <p class="card-text">Número total: 0</p>

                                        <!-- Enlace al módulo -->
                                        <a href="/usuarios" class="btn btn-link text-white mt-3 d-flex align-items-center">
                                            Ir al módulo <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-white tarjeta mb-3 hover-card">
                                    <div class="card-body d-flex flex-column align-items-center">
                                        <!-- Icono principal del módulo -->
                                        <i class="fa-solid fa-school fa-3x mb-3"></i>

                                        <!-- Título de la tarjeta -->
                                        <h5 class="card-title">Sedes</h5>

                                        <!-- Descripción del módulo -->
                                        <p class="card-text">Número total: 0</p>

                                        <!-- Enlace al módulo -->
                                        <a href="/usuarios" class="btn btn-link text-white mt-3 d-flex align-items-center">
                                            Ir al módulo <i class="fa-solid fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>