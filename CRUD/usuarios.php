<?php
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
    <title>Usuarios y Roles</title>
</head>

<body>

    <header>
        <h1>Gestión de Usuarios</h1>
        <p>Visualización de los datos de usuarios y sus roles asociados.</p>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <a class="btn m-3 btn-registrar-usuarios" href="./registro-usuarios.php"><i class="fa-solid fa-user-plus"></i></a>
                    <section>
                        <h2 class="titulo-gestion-usuarios">Tabla de usuarios <i class="fa-solid fa-users"></i></h2>
                        <table class="text-center">
                            <thead>
                                <tr>
                                    <th>ID Usuario</th>
                                    <th>Documento</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
                                    <th>Rol</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
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
                                            echo "<td data-label='ID Usuario'>" . htmlspecialchars($row['id_usuario']) . "</td>";
                                            echo "<td data-label='Documento'>" . htmlspecialchars($row['documento_usuario']) . "</td>";
                                            echo "<td data-label='Nombres'>" . htmlspecialchars($row['nombres_usuario']) . "</td>";
                                            echo "<td data-label='Apellidos'>" . htmlspecialchars($row['apellidos_usuario']) . "</td>";
                                            echo "<td data-label='Correo Electrónico'>" . htmlspecialchars($row['correo_electronico_usuario']) . "</td>";
                                            echo "<td data-label='Teléfono'>" . htmlspecialchars($row['telefono_usuario']) . "</td>";
                                            echo "<td data-label='Rol'>" . htmlspecialchars($row['rol']) . "</td>";
                                            echo "<td data-label='Editar'><a href='editar_usuarios.php?id_usuario=" . $row['id_usuario'] . "' class='btn px-4 btn-edit'><i class='fa-solid fa-user-pen'></i></a></td>";
                                            echo "<td data-label='Eliminar'><a onclick=\"return eliminar();\" class='btn px-4 btn-delete' href='eliminar_usuarios.php?id_usuario=" . $row['id_usuario'] . "'><i class='fa-solid fa-user-minus'></i></a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='10'><h4>No hay usuarios registrados <i class='fa-solid fa-user-xmark'></i><h4></td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='9'>Error al cargar los usuarios: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
                                }
                                ?>

                            </tbody>

                        </table>
                    </section>

                </div>
            </div>
        </div>
    </main>
</body>

</html>