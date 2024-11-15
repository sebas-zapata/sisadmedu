<?php
$conex = mysqli_connect("localhost", "root", "", "sisadmedu");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/Logo SISADMEDU.jpg" type="image/x-icon">
    <link rel="shortcut icon" href="../img/Logo SISADMEDU.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilos-formularios.css?v=<?php echo time(); ?>">
    <title>Registrar usuario</title>
</head>

<body>
    <div class="container mt-2">
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Formulario -->
                <form class="formulario-registro p-4 rounded m-2" id="registroForm" action="crear_usuario.php" method="POST" autocomplete="off">
                <a class="btn btn-volver" href="./usuarios.php">Volver</a>
                    <h2 class="text-center text-light mb-5">Registro de Usuarios</h2> <!-- Título agregado -->
                    <!-- Selección de Tipo de Documento -->
                    <div class="mb-3">
                        <label for="tipo_documento" class="form-label text-light">Tipo de Documento</label>
                        <select class="form-select" name="tipo_documento_codigo_tipo_documento" id="tipo_documento" required>
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
                    </div>

                    <!-- Número de Documento -->
                    <div class="mb-3">
                        <label for="documento" class="form-label text-light">Número de Documento</label>
                        <input type="text" class="form-control" id="documento" name="documento_usuario" placeholder="Número de documento">
                        <span class="text-danger small" id="docError"></span>
                    </div>

                    <!-- Nombres -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label text-light">Nombres</label>
                        <input type="text" class="form-control" id="nombre" name="nombres_usuario" placeholder="Nombres">
                        <span class="text-danger small" id="nombreError"></span>
                    </div>

                    <!-- Apellidos -->
                    <div class="mb-3">
                        <label for="apellidos" class="form-label text-light">Apellidos</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos_usuario" placeholder="Apellidos">
                        <span class="text-danger small" id="apellidosError"></span>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-light">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="correo_electronico_usuario" placeholder="Correo electrónico">
                        <span class="text-danger small" id="emailError"></span>
                    </div>

                    <!-- Número de Teléfono -->
                    <div class="mb-3">
                        <label for="telefono" class="form-label text-light">Número de Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono_usuario" placeholder="Número de teléfono">
                        <span class="text-danger small" id="telefonoError"></span>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label text-light">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="contrasena_usuario" placeholder="Contraseña">
                        <span class="text-danger small" id="passwordError"></span>
                    </div>

                    <!-- Selección de Rol -->
                    <div class="mb-3">
                        <label for="rol" class="form-label text-light">Rol</label>
                        <select class="form-select" id="rol" name="id_rol">
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
                        <span class="text-danger small" id="rolError"></span>
                    </div>

                    <!-- Botón de Enviar -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-guardar w-100 p-3">Registrar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/validar-registro-usuarios.js"></script>
</body>

</html>