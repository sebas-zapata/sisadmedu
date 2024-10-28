<?php 
$conex = mysqli_connect("localhost","root","","sisadmedu");

if (!$conex) {
    die("Error en la conexión: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estilos.css">
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
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = " SELECT * FROM usuarios INNER JOIN rol ON usuarios.id_rol = rol.id_rol";
                    $resultado = mysqli_query($conex,$sql);
                    while($fila = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td ><?php echo $fila['id_usuario'] ?></td>
                        <td ><?php echo $fila['documento_usuario'] ?></td>
                        <td ><?php echo $fila['nombres_usuario'] ?></td>
                        <td ><?php echo $fila['apellidos_usuario'] ?></td>
                        <td><?php echo $fila['correo_electronico_usuario'] ?></td>
                        <td><?php echo $fila['telefono_usuario'] ?></td>
                        <td ><?php echo $fila['contraseña_usuario'] ?></td>
                        <td><?php echo $fila['id_usuario'] ?></td>
                        <td >
                            <a href="" class="btn btn-edit">Editar</a>
                        </td>
                        <td>
                            <a href="" class="btn btn-delete">Eliminar</a>
                        </td>
                    </tr>
                    <?php 
                    }
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
