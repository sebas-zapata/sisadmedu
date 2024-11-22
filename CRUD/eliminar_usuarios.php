<?php

require 'conexion.php';

if (isset($_GET['id_usuario'])) {
    $idUsuario = $_GET['id_usuario'];

    try {
        // Consulta preparada para eliminar el usuario
        $sqlEliminar = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sqlEliminar);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: usuarios.php");
            exit();
        } else {
            echo "Error al eliminar el usuario de la base de datos.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID de usuario no proporcionado.";
}