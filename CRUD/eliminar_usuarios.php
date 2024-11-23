<?php
session_start();
require 'conexion.php';

if (isset($_GET['id_usuario'])) {
    $idUsuario = $_GET['id_usuario'];

    try {
        // Consulta preparada para eliminar el usuario
        $sqlEliminar = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sqlEliminar);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = [
                'tipo' => 'success',
                'titulo' => 'Correcto',
                'texto' => 'Usuario eliminado exitosamente.'
            ];
            header("Location: usuarios.php");
            exit();
        } else {
            $_SESSION['mensaje'] = [
                'tipo' => 'error',
                'titulo' => 'Algo ocurrio',
                'texto' => 'No se elimino el usuario.'
            ];
            header("Location: usuarios.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'titulo' => 'Algo ocurrio',
        'texto' => 'ID de usuario no proporcionado.'
    ];
    header("Location: usuarios.php");
    exit();
}