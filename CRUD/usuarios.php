<?php
session_start(); // Inicia la sesión
require 'conexion.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <link rel="shortcut icon" href="../img/Logo SISADMEDU.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Usuarios</title>
</head>

<body>

    <header class="bg-light p-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
            <div class="container-fluid">
                <!-- Título del módulo -->
                <a class="navbar-brand" href="usuarios.php">
                    <h5 class="m-0"><i class="fa-solid fa-users"></i> Usuarios</h5>
                </a>

                <!-- Botón para colapsar el menú en pantallas pequeñas -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido del menú -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <!-- Opciones desplegables -->
                        <li class="nav-item dropdown">
                            <a
                                class=" dropdown-toggle btn btn-opciones p-2"
                                href="#"
                                id="userOptionsDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Opciones
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userOptionsDropdown">
                                <li><a class="dropdown-item link-panel" href="../admin.php"><i class="fas fa-gauge-high"></i>
                                        Panel de Administración</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a class="btn m-3 p-2 btn-registrar-usuarios" href="./registro-usuarios.php"><i class="fa-solid fa-user-plus"></i> Añadir usuario</a>
                    <section>
                        <h2 class="titulo-gestion-usuarios">Tabla de usuarios <i class="fa-solid fa-users"></i></h2>
                        <div class="table-responsive">
                        <table class="table table-striped table-hover text-center">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID Usuario</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
                                    <th>Rol</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Verifica si hay un mensaje en la sesión
                                if (isset($_SESSION['mensaje'])) {
                                    $tipo = $_SESSION['mensaje']['tipo']; // 'success', 'error', 'info', etc.
                                    $titulo = $_SESSION['mensaje']['titulo'];
                                    $texto = $_SESSION['mensaje']['texto'];

                                    // Muestra la alerta con SweetAlert
                                    echo "
           <script>
               Swal.fire({
                   icon: '$tipo',
                   title: '$titulo',
                   text: '$texto',
                   confirmButtonColor: '#461c68',
                   confirmButtonText: 'Aceptar',
                   width:'500px',
                   timer: 4000,
               });
           </script>
           ";

                                    // Elimina el mensaje de la sesión
                                    unset($_SESSION['mensaje']);
                                }

                                try {
                                    // Consulta para obtener los usuarios y sus roles
                                    $query = "SELECT usuarios.id_usuario, usuarios.documento_usuario, usuarios.nombres_usuario, 
             usuarios.apellidos_usuario, usuarios.correo_electronico_usuario, 
            usuarios.telefono_usuario, rol.rol AS rol 
            FROM usuarios 
            INNER JOIN rol ON usuarios.rol_id_rol1 = rol.id_rol";

                                    // Preparar y ejecutar la consulta
                                    $stmt = $pdo->prepare($query);
                                    $stmt->execute();

                                    // Obtener los resultados
                                    $usuarios = $stmt->fetchAll();

                                    if (count($usuarios) > 0) {
                                        foreach ($usuarios as $row) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['id_usuario']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['documento_usuario']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['nombres_usuario']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['apellidos_usuario']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['correo_electronico_usuario']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['telefono_usuario']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['rol']) . "</td>";
                                            echo "<td>
                    <div class='d-flex justify-content-around'>
                        <a href='editar_usuarios.php?id_usuario=" . $row['id_usuario'] . "' class='btn btn-edit mx-1 p-2' title='Editar'>
                            <i class='fa-solid fa-user-pen'></i>
                            Editar
                        </a>
                        <a onclick=\"eliminar(event, 'eliminar_usuarios.php?id_usuario=" . $row['id_usuario'] . "');\" 
                           class='btn btn-delete mx-1 p-2' 
                           href='#' 
                           title='Eliminar'>
                            <i class='fa-solid fa-user-minus'></i>
                             Eliminar
                        </a>
                    </div>
                  </td>";

                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' class='text-center'><h4>No hay usuarios registrados <i class='fa-solid fa-user-xmark'></i></h4></td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='8' class='text-center'>Error al cargar los usuarios: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </main>
    <script src="../js/eliminar-usuario.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>