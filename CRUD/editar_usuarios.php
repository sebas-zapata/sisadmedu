<?php
$conex = mysqli_connect("localhost", "root", "", "sisadmedu");

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_GET['id_usuario'])) {
    $idUsuario = $_GET['id_usuario'];
    
    // Consultar los datos del usuario por su ID
    $sql = "SELECT * FROM usuarios WHERE id_usuario = $idUsuario";
    $resultado = mysqli_query($conex, $sql);
    
    // Verificar si se encontró el usuario
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
    } else {
        echo "Usuario no encontrado.";
        exit(); // Salir si no se encuentra el usuario
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario de edición y sanitizarlos
        $tipo_documento = mysqli_real_escape_string($conex, $_POST['tipo_documento_codigo_tipo_documento']);
        $documento_usuario = mysqli_real_escape_string($conex, $_POST['documento_usuario']);
        $nombres_usuario = mysqli_real_escape_string($conex, $_POST['nombres_usuario']);
        $apellidos_usuario = mysqli_real_escape_string($conex, $_POST['apellidos_usuario']);
        $correo_electronico_usuario = mysqli_real_escape_string($conex, $_POST['correo_electronico_usuario']);
        $telefono_usuario = mysqli_real_escape_string($conex, $_POST['telefono_usuario']);
        $id_rol = mysqli_real_escape_string($conex, $_POST['id_rol']);
        
        
        // Actualizar los datos del usuario en la base de datos
        $sqlUpdate = "UPDATE usuarios SET tipo_documento_codigo_tipo_documento = '$tipo_documento', documento_usuario = '$documento_usuario', nombres_usuario = '$nombres_usuario', apellidos_usuario = '$apellidos_usuario', correo_electronico_usuario = '$correo_electronico_usuario', telefono_usuario = '$telefono_usuario', rol_id_rol1 = '$id_rol' WHERE id_usuario = $idUsuario";
        mysqli_query($conex, $sqlUpdate);
        
        // Redirigir a la página principal después de la edición
        header("Location: usuarios.php");
        exit();
    }
} else {
    echo "ID de usuario no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="">
    <title>Editar Usuario</title>
</head>
<body class="">
    <div class="">
        <form method="post">
            <h2>Editar Usuario</h2>

            <label for="id_grupo">Tipo de Documento:</label>
            <select class="form-control" name="tipo_documento_codigo_tipo_documento">
                <?php
                $consulta_documento = "SELECT * FROM tipo_documento";
                $resultado_documento = mysqli_query($conex, $consulta_documento);
                while($tipo_documento = mysqli_fetch_assoc($resultado_documento)) {
                    $selected = isset($usuario['tipo_documento_codigo_tipo_documento']) && $tipo_documento['codigo_tipo_documento'] == $usuario['tipo_documento_codigo_tipo_documento'] ? "selected" : "";
                    echo "<option value='" . $tipo_documento['codigo_tipo_documento'] . "' $selected>" . $tipo_documento['descripcion_tipo_documento'] . "</option>";
                }
                ?>
            </select>
            <br>
            
            <label for="documento_usuario">Documento:</label>
            <input class="form-control" type="text" name="documento_usuario" value="<?php echo isset($usuario['documento_usuario']) ? $usuario['documento_usuario'] : ''; ?>"><br>

            <label for="nombres_usuario">Nombres:</label>
            <input class="form-control" type="text" name="nombres_usuario" value="<?php echo isset($usuario['nombres_usuario']) ? $usuario['nombres_usuario'] : ''; ?>"><br>

            <label for="apellidos_usuario">Apellidos:</label>
            <input class="form-control" type="text" name="apellidos_usuario" value="<?php echo isset($usuario['apellidos_usuario']) ? $usuario['apellidos_usuario'] : ''; ?>"><br>

            <label for="correo_electronico_usuario">Correo:</label>
            <input class="form-control" type="email" name="correo_electronico_usuario" value="<?php echo isset($usuario['correo_electronico_usuario']) ? $usuario['correo_electronico_usuario'] : ''; ?>"><br>

            <label for="telefono_usuario">Teléfono:</label>
            <input class="form-control" type="text" name="telefono_usuario" value="<?php echo isset($usuario['telefono_usuario']) ? $usuario['telefono_usuario'] : ''; ?>"><br>

            <label for="id_rol">Rol:</label>
            <select class="form-control" name="id_rol">
                <?php
                $consulta_rol = "SELECT * FROM rol";
                $resultado_rol = mysqli_query($conex, $consulta_rol);
                while($rol = mysqli_fetch_assoc($resultado_rol)) {
                    $selected = isset($usuario['rol_id_rol1']) && $rol['id_rol'] == $usuario['rol_id_rol1'] ? "selected" : "";
                    echo "<option value='" . $rol['id_rol'] . "' $selected>" . $rol['rol'] . "</option>";
                }
                ?>
            </select><br>

            

            <button class="" type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
