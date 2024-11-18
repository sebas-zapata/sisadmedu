<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="./img/Logo SISADMEDU.jpg" type="image/x-icon">
    <title>Panel - Administrador</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex">
                <!-- Barra lateral -->
                <div class="offcanvas offcanvas-start dashboard" tabindex="-1" id="sidebar"
                    aria-labelledby="sidebarLabel">
                    <div class="offcanvas-header">
                        <h1 class="offcanvas-title text-light" id="sidebarLabel">Panel</h1>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active text-light" href="#">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="#">Reportes</a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-dark">
                                        <li><a class="dropdown-item active" href="#">Perfil</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="#">Cerrar sesion</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Contenido principal -->
                <div class="flex-grow-1">
                    <!-- Botón para mostrar/ocultar la barra lateral -->
                    <nav class="navbar navbar-light bg-dark">
                        <div class="container-fluid">
                            <button class="btn btn-panel" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#sidebar" aria-controls="sidebar">
                                Panel
                            </button>
                            <span class="navbar-brand mb-0 h1 text-light">Dashboard</span>
                            <img class="logo" src="./img/Logo SISADMEDU.jpg" alt="Logo">
                        </div>
                    </nav>

                    <!-- Tarjetas -->
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white tarjeta mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Usuarios</h5>
                                        <p class="card-text">Número total: 120</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white tarjeta mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Ventas</h5>
                                        <p class="card-text">Ingresos: $15,000</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white tarjeta mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Alertas</h5>
                                        <p class="card-text">3 nuevas alertas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white tarjeta mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Alertas</h5>
                                        <p class="card-text">3 nuevas alertas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white tarjeta mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Alertas</h5>
                                        <p class="card-text">3 nuevas alertas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white tarjeta mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title">Alertas</h5>
                                        <p class="card-text">3 nuevas alertas</p>
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