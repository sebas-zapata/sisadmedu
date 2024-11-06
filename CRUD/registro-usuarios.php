<?php
$conex = mysqli_connect("localhost", "root", "", "sisadmedu");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/Logo SISADMEDU.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/estilos-formularios.css">
    <title>Formulario de Registro - SISADMEDU</title>
</head>

<body>
    <div class="form-container">
        <div class="logo">
            <img src="../img/Logo SISADMEDU.jpg" alt="Logo del Sistema">
        </div>
        <h2>Registro de usuarios</h2>
        <form id="registroForm" action="crear_usuario.php" method="POST" autocomplete="off">
            <select class="form-control" name="tipo_documento_codigo_tipo_documento" id="tipo_documento" required>
                <?php
                $consulta = "SELECT codigo_tipo_documento, descripcion_tipo_documento FROM tipo_documento";
                $resultado = mysqli_query($conex, $consulta);
                while ($tipo_documento = mysqli_fetch_array($resultado)) {
                ?>
                    <option value="<?php echo $tipo_documento['codigo_tipo_documento']; ?>">
                        <?php echo $tipo_documento['descripcion_tipo_documento']; ?>
                    </option>
                <?php
                }
                ?>
            </select>

            <input type="text" id="documento" name="documento_usuario" placeholder="Numero de documento">
            <span class="error" id="docError"></span>
            <input type="text" id="nombre" name="nombres_usuario" placeholder="Nombres">
            <span class="error" id="nombreError"></span>
            <input type="text" id="apellidos" name="apellidos_usuario" placeholder="Apellidos">
            <span class="error" id="apellidosError"></span>
            <input type="email" id="email" name="correo_electronico_usuario" placeholder="Correo electrónico">
            <span class="error" id="emailError"></span>
            <input type="tel" id="telefono" name="telefono_usuario" placeholder="Número de teléfono">
            <span class="error" id="telefonoError"></span>
            <input type="password" id="password" name="contrasena_usuario" placeholder="Contraseña">
            <span class="error" id="passwordError"></span>
            <select class="form-control" id="rol" name="id_rol" required>
                <?php
                $consulta = "SELECT * FROM rol";
                $resultado = mysqli_query($conex, $consulta);
                while ($rol = mysqli_fetch_array($resultado)) {
                ?>
                    <option value="<?php echo $rol['id_rol']; ?>">
                        <?php echo $rol['rol']; ?>
                    </option>
                <?php
                }
                ?>
            </select>


            <select class="form-control" name="id_grupo">
                <?php
                $consulta = "SELECT * FROM grupo";
                $resultado = mysqli_query($conex, $consulta);
                while ($id_grupo = mysqli_fetch_array($resultado)) {
                ?>
                    <option value="<?php echo $id_grupo['id_grupo'] ?>"> <?php echo $id_grupo['nombre_grupo'] ?></option>
                <?php
                }
                ?>
            </select>
            <span class="error" id="rolError"></span>
            <input type="submit" value="Registrarse">
        </form>
    </div>
    <script src=""></script>
</body>

</html>