<?php
session_start();
require 'conexion.php';

if (isset($_GET['id_usuario'])) {
    $idUsuario = $_GET['id_usuario'];

    try {
        // Consultar los datos del usuario por su ID
        $sql = "SELECT * FROM usuarios WHERE id_usuario = :id_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario
        if (!$usuario) {
            echo "Usuario no encontrado.";
            exit(); // Salir si no se encuentra el usuario
        }

        // Si el formulario ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario de edición y sanitizarlos
            $tipo_documento = $_POST['tipo_documento_codigo_tipo_documento'];
            $documento_usuario = $_POST['documento_usuario'];
            $nombres_usuario = $_POST['nombres_usuario'];
            $apellidos_usuario = $_POST['apellidos_usuario'];
            $correo_electronico_usuario = $_POST['correo_electronico_usuario'];
            $telefono_usuario = $_POST['telefono_usuario'];
            $id_rol = $_POST['id_rol'];

            // Actualizar los datos del usuario en la base de datos usando una consulta preparada
            $sqlUpdate = "UPDATE usuarios SET tipo_documento_codigo_tipo_documento = :tipo_documento, 
                        documento_usuario = :documento_usuario, 
                        nombres_usuario = :nombres_usuario, 
                        apellidos_usuario = :apellidos_usuario, 
                        correo_electronico_usuario = :correo_electronico_usuario, 
                        telefono_usuario = :telefono_usuario, 
                        rol_id_rol1 = :id_rol 
                        WHERE id_usuario = :id_usuario";

            $stmtUpdate = $pdo->prepare($sqlUpdate);
            $stmtUpdate->bindParam(':tipo_documento', $tipo_documento, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':documento_usuario', $documento_usuario, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':nombres_usuario', $nombres_usuario, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':apellidos_usuario', $apellidos_usuario, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':correo_electronico_usuario', $correo_electronico_usuario, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':telefono_usuario', $telefono_usuario, PDO::PARAM_STR);
            $stmtUpdate->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
            $stmtUpdate->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);

            if ($stmtUpdate->execute()) {
                // Redirigir a la página principal después de la edición
                $_SESSION['mensaje'] = [
                    'tipo' => 'success',
                    'titulo' => 'Correcto',
                    'texto' => 'Usuario actualizado exitosamente.'
                ];
                header("Location: usuarios.php");
                exit();
            } else {
                echo "Error al actualizar los datos del usuario.";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirigir a la página si se intenta acceder sin un id definido
    $_SESSION['mensaje'] = [
        'tipo' => 'info',
        'titulo' => 'Informacion',
        'texto' => 'Acceso denegado.'
    ];
    header("Location: usuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/Logo SISADMEDU.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/estilos-formularios.css?v=<?php echo time(); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Editar usuario</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" class="formulario-editar p-4 rounded m-2" id="editForm">
                    <a class="btn px-4 m-3 btn-volver" href="./usuarios.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <h2 class="text-light text-center mb-4">Editar Usuario <i class='fa-solid fa-user-pen'></i></h2>
                    <hr>

                    <div class="form-floating mb-4">
                        <select id="tipo_documento" class="form-select" name="tipo_documento_codigo_tipo_documento">
                            <?php
                            // Consulta para obtener los tipos de documento
                            $consulta_documento = "SELECT * FROM tipo_documento";
                            $stmtDocumento = $pdo->prepare($consulta_documento);
                            $stmtDocumento->execute();
                            while ($tipo_documento = $stmtDocumento->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $tipo_documento['codigo_tipo_documento'] == $usuario['tipo_documento_codigo_tipo_documento'] ? "selected" : "";
                                echo "<option value='" . $tipo_documento['codigo_tipo_documento'] . "' $selected>" . $tipo_documento['descripcion_tipo_documento'] . "</option>";
                            }
                            ?>
                        </select>
                        <span class="text-danger small error" id="tipoDocError"></span>
                    </div>

                    <div class="form-floating mb-4">
                        <input id="documento_usuario" class="form-control m-auto" type="text" name="documento_usuario" value="<?php echo isset($usuario['documento_usuario']) ? $usuario['documento_usuario'] : ''; ?>">
                        <label for="documento_usuario">Documento:</label>
                        <span class="text-danger small error" id="docError"></span>
                    </div>

                    <div class="form-floating mb-4">
                        <input id="nombres_usuario" class="form-control m-auto" type="text" name="nombres_usuario" value="<?php echo isset($usuario['nombres_usuario']) ? $usuario['nombres_usuario'] : ''; ?>">
                        <label for="nombres_usuario">Nombres:</label>
                        <span class="text-danger small error" id="nombreError"></span>
                    </div>

                    <div class="form-floating mb-4">
                        <input id="apellidos_usuario" class="form-control m-auto" type="text" name="apellidos_usuario" value="<?php echo isset($usuario['apellidos_usuario']) ? $usuario['apellidos_usuario'] : ''; ?>">
                        <label for="apellidos_usuario">Apellidos:</label>
                        <span class="text-danger small error" id="apellidoError"></span>
                    </div>

                    <div class="form-floating mb-4">
                        <input id="correo_electronico_usuario" class="form-control m-auto" type="email" name="correo_electronico_usuario" value="<?php echo isset($usuario['correo_electronico_usuario']) ? $usuario['correo_electronico_usuario'] : ''; ?>">
                        <label for="correo_electronico_usuario">Correo:</label>
                        <span class="text-danger small error" id="correoError"></span>
                    </div>

                    <div class="form-floating mb-4">
                        <input id="telefono_usuario" class="form-control m-auto" type="text" name="telefono_usuario" value="<?php echo isset($usuario['telefono_usuario']) ? $usuario['telefono_usuario'] : ''; ?>">
                        <label for="telefono_usuario">Teléfono:</label>
                        <span class="text-danger small error" id="telefonoError"></span>
                    </div>

                    <div class="form-floating mb-4">
                        <select id="id_rol" class="form-select" name="id_rol">
                            <?php
                            // Consulta para obtener los roles
                            $consulta_rol = "SELECT * FROM rol";
                            $stmtRol = $pdo->prepare($consulta_rol);
                            $stmtRol->execute();
                            while ($rol = $stmtRol->fetch(PDO::FETCH_ASSOC)) {
                                $selected = $rol['id_rol'] == $usuario['rol_id_rol1'] ? "selected" : "";
                                echo "<option value='" . $rol['id_rol'] . "' $selected>" . $rol['rol'] . "</option>";
                            }
                            ?>
                        </select>
                        <span class="text-danger small error" id="rolError"></span>
                    </div>
                    <button class="btn btn-guardar w-100 p-3" type="submit">Editar <i class='fa-solid fa-user-pen'></i></button>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/validar-editar-usuarios.js"></script>
</body>

</html>