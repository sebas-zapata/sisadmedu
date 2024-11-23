<?php
session_start(); // Inicia la sesión
require 'conexion.php'; // Asegúrate de que este archivo contenga la instancia PDO en $pdo

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recuperar los valores del formulario
    $tipo_documento = $_POST['tipo_documento_codigo_tipo_documento'];
    $documento_usuario = $_POST['documento_usuario'];
    $nombres_usuario = $_POST['nombres_usuario'];
    $apellidos_usuario = $_POST['apellidos_usuario'];
    $correo_electronico_usuario = $_POST['correo_electronico_usuario'];
    $telefono_usuario = $_POST['telefono_usuario'];
    $contraseña_usuario = hash('sha512', $_POST['contrasena_usuario']); // Hashear la contraseña
    $id_rol = $_POST['id_rol'];
    $id_grupo = $_POST['id_grupo'];

    try {
        // Verificar si el correo electrónico ya existe
        $sql_correo = "SELECT COUNT(*) FROM usuarios WHERE correo_electronico_usuario = :correo";
        $stmt_correo = $pdo->prepare($sql_correo);
        $stmt_correo->execute(['correo' => $correo_electronico_usuario]);

        if ($stmt_correo->fetchColumn() > 0) {
            $_SESSION['mensaje'] = [
                'tipo' => 'info',
                'titulo' => 'Algo ocurrio',
                'texto' => 'El correo ya existe. Por favor, ingrese otro.'
            ];
            header("Location: usuarios.php");
            exit();
        }

        // Verificar si el documento ya existe
        $sql_documento = "SELECT COUNT(*) FROM usuarios WHERE documento_usuario = :documento";
        $stmt_documento = $pdo->prepare($sql_documento);
        $stmt_documento->execute(['documento' => $documento_usuario]);

        if ($stmt_documento->fetchColumn() > 0) {
            $_SESSION['mensaje'] = [
                'tipo' => 'info',
                'titulo' => 'Algo ocurrio',
                'texto' => 'El documento ya existe. Por favor, ingrese otro.'
            ];
            header("Location: usuarios.php");
            exit();
        }

        // Verificar si el teléfono ya existe
        $sql_telefono = "SELECT COUNT(*) FROM usuarios WHERE telefono_usuario = :telefono";
        $stmt_telefono = $pdo->prepare($sql_telefono);
        $stmt_telefono->execute(['telefono' => $telefono_usuario]);

        if ($stmt_telefono->fetchColumn() > 0) {
            $_SESSION['mensaje'] = [
                'tipo' => 'info',
                'titulo' => 'Algo ocurrio',
                'texto' => 'El teléfono ya existe. Por favor, ingrese otro.'
            ];
            header("Location: usuarios.php");
            exit();
        }

        // Insertar datos del usuario en la base de datos
        $sql_insertar = "INSERT INTO usuarios (
            tipo_documento_codigo_tipo_documento, 
            documento_usuario, 
            nombres_usuario, 
            apellidos_usuario, 
            correo_electronico_usuario, 
            telefono_usuario, 
            contrasena_usuario, 
            rol_id_rol1, 
            grupo_id_grupo
        ) VALUES (
            :tipo_documento, 
            :documento, 
            :nombres, 
            :apellidos, 
            :correo, 
            :telefono, 
            :contrasena, 
            :rol, 
            :grupo
        )";

        $stmt_insertar = $pdo->prepare($sql_insertar);
        $resultado = $stmt_insertar->execute([
            'tipo_documento' => $tipo_documento,
            'documento' => $documento_usuario,
            'nombres' => $nombres_usuario,
            'apellidos' => $apellidos_usuario,
            'correo' => $correo_electronico_usuario,
            'telefono' => $telefono_usuario,
            'contrasena' => $contraseña_usuario,
            'rol' => $id_rol,
            'grupo' => $id_grupo,
        ]);

        if ($resultado) {
            $_SESSION['mensaje'] = [
                'tipo' => 'success',
                'titulo' => 'Correcto',
                'texto' => 'El usuario se ha registrado exitosamente.'
            ];
            header("Location: usuarios.php");
            exit();
        } else {
            $_SESSION['mensaje'] = [
                'tipo' => 'error',
                'titulo' => 'Ocurrio un error',
                'texto' => 'No se registro el usuario.'
            ];
            header("Location: usuarios.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
