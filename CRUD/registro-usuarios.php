<?php

require 'conexion.php';

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.min.css">
    <title>Registrar usuario</title>
</head>

<body>
    <div class="container mt-2">

        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Formulario -->
                <form class="formulario-registro p-4 rounded m-2" id="registroForm" action="crear_usuario.php" method="POST" autocomplete="off">
                    <a class="btn px-4 m-3 btn-volver" href="./usuarios.php"><i class="fa-solid fa-arrow-left"></i></a>
                    <h2 class="text-center text-light mb-5">Registro de Usuarios <i class="fa-solid fa-user-plus"></i></h2>

                    <!-- Selección de Tipo de Documento -->
                    <div class="form-floating mb-4">
                        <select class="form-select" name="tipo_documento_codigo_tipo_documento" id="tipo_documento">
                            <option value="" selected>Seleccione un tipo de documento</option>
                            <?php
                            try {
                                $consulta = $pdo->query("SELECT codigo_tipo_documento, descripcion_tipo_documento FROM tipo_documento");
                                while ($tipo_documento = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <option value="<?php echo $tipo_documento['codigo_tipo_documento']; ?>">
                                        <?php echo $tipo_documento['descripcion_tipo_documento']; ?>
                                    </option>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "<p>Error al cargar tipos de documento: " . $e->getMessage() . "</p>";
                            }
                            ?>
                        </select>
                        <span class="text-danger small error" id="tipoDocumentoError"></span>
                    </div>

                    <!-- Número de Documento -->
                    <div class="form-floating mb-4">
                        <input type="number" class="form-control" id="documento" name="documento_usuario" placeholder="Número de documento">
                        <label for="documento"> Número de Documento</label>
                        <span class="text-danger small error" id="docError"></span>
                    </div>

                    <!-- Nombres -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="nombre" name="nombres_usuario" placeholder="Nombres">
                        <label for="nombre">Nombres</label>
                        <span class="text-danger small error" id="nombreError"></span>
                    </div>

                    <!-- Apellidos -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="apellidos" name="apellidos_usuario" placeholder="Apellidos">
                        <label for="apellidos">Apellidos</label>
                        <span class="text-danger small error" id="apellidosError"></span>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="email" name="correo_electronico_usuario" placeholder="Correo electrónico">
                        <label for="email">Correo Electrónico</label>
                        <span class="text-danger small error" id="emailError"></span>
                    </div>

                    <!-- Número de Teléfono -->
                    <div class="form-floating mb-4">
                        <input type="tel" class="form-control" id="telefono" name="telefono_usuario" placeholder="Número de teléfono">
                        <label for="telefono">Número de Teléfono</label>
                        <span class="text-danger small error" id="telefonoError"></span>
                    </div>

                    <!-- Contraseña -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="contrasena_usuario" placeholder="Contraseña">
                        <label for="password">Contraseña</label>
                        <span class="text-danger small error" id="passwordError"></span>
                    </div>

                    <!-- Selección de Rol -->
                    <div class="form-floating mb-4">
                        <select class="form-select" id="rol" name="id_rol">
                            <option value="" selected>Seleccione un rol</option>
                            <?php
                            try {
                                $consulta = $pdo->query("SELECT * FROM rol");
                                while ($rol = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <option value="<?php echo $rol['id_rol']; ?>">
                                        <?php echo $rol['rol']; ?>
                                    </option>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "<p>Error al cargar roles: " . $e->getMessage() . "</p>";
                            }
                            ?>
                        </select>
                        <span class="text-danger small error" id="rolError"></span>
                    </div>

                    <!-- Selección de Grupo -->
                    <div class="mb-3" id="grupoContainer" style="display: none;">
                        <label for="grupo" class="form-label text-light">Grupo</label>
                        <select class="form-control" name="id_grupo" id="grupo">

                            <?php
                            try {
                                $consulta = $pdo->query("SELECT * FROM grupo");
                                while ($grupo = $consulta->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                    <option value="<?php echo $grupo['id_grupo']; ?>">
                                        <?php echo $grupo['nombre_grupo']; ?>
                                    </option>
                            <?php
                                }
                            } catch (PDOException $e) {
                                echo "<p>Error al cargar grupos: " . $e->getMessage() . "</p>";
                            }
                            ?>
                        </select>
                        <span class="text-danger small error" id="grupoError"></span>
                    </div>

                    <!-- Botón de Enviar -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-guardar w-100 p-3">Guardar <i class="fa-solid fa-user-plus"></i></button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script src="../js/validar-registro-usuarios.js"></script>
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.4/dist/sweetalert2.all.min.js"></script>
    <script>
        const rolSelect = document.getElementById('rol');
        const grupoContainer = document.getElementById('grupoContainer');

        rolSelect.addEventListener('change', () => {
            const selectedOption = rolSelect.options[rolSelect.selectedIndex].text.toLowerCase();
            if (selectedOption === 'estudiante') {
                grupoContainer.style.display = 'block';
            } else {
                grupoContainer.style.display = 'none';
            }
        });
    </script>
</body>

</html>