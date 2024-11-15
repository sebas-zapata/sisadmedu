<?php
$conex = mysqli_connect("localhost", "root", "", "sisadmedu");

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tipo_documento = mysqli_real_escape_string($conex, $_POST['tipo_documento_codigo_tipo_documento']);
    $documento_usuario = mysqli_real_escape_string($conex, $_POST['documento_usuario']);
    $nombres_usuario = mysqli_real_escape_string($conex, $_POST['nombres_usuario']);
    $apellidos_usuario = mysqli_real_escape_string($conex, $_POST['apellidos_usuario']);
    $correo_electronico_usuario = mysqli_real_escape_string($conex, $_POST['correo_electronico_usuario']);
    $telefono_usuario = mysqli_real_escape_string($conex, $_POST['telefono_usuario']);
    $contraseña_usuario = mysqli_real_escape_string($conex, $_POST['contrasena_usuario']);
    $contraseña_usuario = hash('sha512', $contraseña_usuario);
    $id_rol = mysqli_real_escape_string($conex, $_POST['id_rol']);

    
    $consulta_correo = "SELECT * FROM usuarios WHERE correo_electronico_usuario = '$correo_electronico_usuario'";
    $resultado_correo = mysqli_query($conex, $consulta_correo);

    if (mysqli_num_rows($resultado_correo) > 0) {
        echo "<script>alert('El correo ya existe. Por favor, ingrese otro.');window.location='registro-usuarios.php'</script>";
    } else {
       
        $insertar = "INSERT INTO usuarios (`tipo_documento_codigo_tipo_documento`, `documento_usuario`, `nombres_usuario`, `apellidos_usuario`, `correo_electronico_usuario`, `telefono_usuario`, `contrasena_usuario`, `rol_id_rol1`) VALUES ('$tipo_documento', '$documento_usuario', '$nombres_usuario', '$apellidos_usuario', '$correo_electronico_usuario', '$telefono_usuario', '$contraseña_usuario', '$id_rol')";
        $resultado = mysqli_query($conex, $insertar);

        if ($resultado) {
            header("location: usuarios.php"); 
            exit();
        } else {
            echo 'Error, no se pudo crear la cuenta';
        }
    }
}
?>