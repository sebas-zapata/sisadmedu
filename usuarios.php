<?php
$conex = mysqli_connect("localhost", "root", "", "sisadmedu");

if (!$conex) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Listado de Usuarios y Roles</title>
</head>
<body>

    <header>
        <h1>Gestión de Usuarios</h1>
        <p>Visualización de los datos de usuarios y sus roles asociados.</p>
    </header>

    <main>
        <section>
            <h2 class="titulo-gestion-usuarios">Tabla de Usuarios</h2>
            <table>
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

                    $query = "SELECT * FROM usuarios";
                    $resultado = mysqli_query($conex, $query);

                    if (mysqli_num_rows($resultado) > 0) {
                        
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td data-label='ID Usuario'>" . $row['id_usuario'] . "</td>";
                            echo "<td data-label='Documento'>" . $row['documento_usuario'] . "</td>";
                            echo "<td data-label='Nombres'>" . $row['nombres_usuario'] . "</td>";
                            echo "<td data-label='Apellidos'>" . $row['apellidos_usuario'] . "</td>";
                            echo "<td data-label='Correo Electrónico'>" . $row['correo_electronico_usuario'] . "</td>";
                            echo "<td data-label='Teléfono'>" . $row['telefono_usuario'] . "</td>";
                            echo "<td data-label='Rol'>" . $row['id_rol'] . "</td>";
                            echo "<td data-label='Editar'><a href='#' class='btn btn-edit'>Editar</a></td>";
                            echo "<td data-label='Eliminar'><a href='eliminar_usuarios.php' class='btn btn-delete' >Eliminar</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No hay usuarios registrados</td></tr>";
                    }

                    mysqli_free_result($resultado);
                    mysqli_close($conex);
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Gestión de Usuarios y Roles</p>
    </footer>

</body>
</html>
