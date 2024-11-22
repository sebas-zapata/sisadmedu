<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los valores de los campos del formulario
    $tipo_documento = $_POST['tipo_documento_codigo_tipo_documento'];
    $documento_usuario = $_POST['documento_usuario'];
    $nombres_usuario = $_POST['nombres_usuario'];
    $apellidos_usuario = $_POST['apellidos_usuario'];
    $correo_electronico_usuario = $_POST['correo_electronico_usuario'];
    $telefono_usuario = $_POST['telefono_usuario'];
    $contraseña_usuario = hash('sha512', $_POST['contrasena_usuario']); // Hashear contraseña
    $id_rol = $_POST['id_rol'];
    $id_grupo = $_POST['id_grupo'];

    try {
        // Verificar si el correo electrónico ya existe
        $sql_correo = "SELECT COUNT(*) FROM usuarios WHERE correo_electronico_usuario = :correo";
        $stmt_correo = $pdo->prepare($sql_correo);
        $stmt_correo->execute(['correo' => $correo_electronico_usuario]);

        if ($stmt_correo->fetchColumn() > 0) {
            echo "<script>alert('El correo ya existe. Por favor, ingrese otro.');window.location='registro-usuarios.php'</script>";
<<<<<<< HEAD
        } else {
            // Verificar si el documento ya existe
            $consulta_documento = "SELECT * FROM usuarios WHERE documento_usuario = '$documento_usuario'";
            $resultado_documento = mysqli_query($conex, $consulta_documento);

            if (mysqli_num_rows($resultado_documento) > 0) {
                echo "<script>alert('El documento ya existe. Por favor, ingrese otro.');window.location='registro-usuarios.php'</script>";
            } else {
                // Verificar si el teléfono ya existe
                $consulta_telefono = "SELECT * FROM usuarios WHERE telefono_usuario = '$telefono_usuario'";
                $resultado_telefono = mysqli_query($conex, $consulta_telefono);

                if (mysqli_num_rows($resultado_telefono) > 0) {
                    echo "<script>alert('El teléfono ya existe. Por favor, ingrese otro.');window.location='registro-usuarios.php'</script>";
                } else {
                    // Insertar datos del usuario en la base de datos
                    $insertar = "INSERT INTO usuarios (`tipo_documento_codigo_tipo_documento`, `documento_usuario`, `nombres_usuario`, `apellidos_usuario`, `correo_electronico_usuario`, `telefono_usuario`, `contrasena_usuario`, `rol_id_rol1`, `grupo_id_grupo`) VALUES ('$tipo_documento', '$documento_usuario', '$nombres_usuario', '$apellidos_usuario', '$correo_electronico_usuario', '$telefono_usuario', '$contraseña_usuario', '$id_rol', '$id_grupo')";
                    $resultado = mysqli_query($conex, $insertar);

                    if ($resultado) {
                        echo "<script>alert('Usuario registrado exitosamente');</script>";
                        header("location:usuarios.php");
                        exit();
                    } else {
                        echo 'Error, no se pudo crear la cuenta';
                    }
                }
            }
=======
            exit();
>>>>>>> 4f1c23c9fcda39368396ad473b1ad37d34feb8a7
        }

        // Verificar si el documento ya existe
        $sql_documento = "SELECT COUNT(*) FROM usuarios WHERE documento_usuario = :documento";
        $stmt_documento = $pdo->prepare($sql_documento);
        $stmt_documento->execute(['documento' => $documento_usuario]);

        if ($stmt_documento->fetchColumn() > 0) {
            echo "<script>alert('El documento ya existe. Por favor, ingrese otro.');window.location='registro-usuarios.php'</script>";
            exit();
        }

        // Verificar si el teléfono ya existe
        $sql_telefono = "SELECT COUNT(*) FROM usuarios WHERE telefono_usuario = :telefono";
        $stmt_telefono = $pdo->prepare($sql_telefono);
        $stmt_telefono->execute(['telefono' => $telefono_usuario]);

        if ($stmt_telefono->fetchColumn() > 0) {
            echo "<script>alert('El teléfono ya existe. Por favor, ingrese otro.');window.location='registro-usuarios.php'</script>";
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
            header("Location: usuarios.php");
            exit();
        } else {
            echo 'Error, no se pudo crear la cuenta';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>