<?php

$conex = mysqli_connect("localhost", "root", "", "sisadmedu");

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

if (isset($_GET['id_usuario'])) {
    $idUsuario = $_GET['id_usuario'];

    
    $sqlEliminar = "DELETE FROM usuarios WHERE id_usuario = $idUsuario";
    if (mysqli_query($conex, $sqlEliminar)) {

        header("location:usuarios.php");
        exit();
    } else {
        echo "Error al eliminar el usuario de la base de datos: " . mysqli_error($conex);
    }
} else {
    echo "ID de usuario no proporcionado.";
}

mysqli_close($conex);
?>