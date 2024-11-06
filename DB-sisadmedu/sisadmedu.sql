-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 15:45:55
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisadmedu`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acudientes`
--

CREATE TABLE `acudientes` (
  `id_documento_acudiente` bigint(20) NOT NULL,
  `codigo_acudiente` bigint(20) NOT NULL,
  `primer_nombre_acudiente` varchar(255) DEFAULT NULL,
  `segundo_nombre_acudiente` varchar(255) DEFAULT NULL,
  `primer_apellido_acudiente` varchar(255) DEFAULT NULL,
  `segundo_apellido_acudiente` varchar(255) DEFAULT NULL,
  `celular_acudiente` varchar(50) DEFAULT NULL,
  `telefono_acudiente` varchar(50) DEFAULT NULL,
  `direccion_acudiente` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(255) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_retiro` date NOT NULL,
  `tipo_documento_codigo_tipo_documento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `acudientes`
--

INSERT INTO `acudientes` (`id_documento_acudiente`, `codigo_acudiente`, `primer_nombre_acudiente`, `segundo_nombre_acudiente`, `primer_apellido_acudiente`, `segundo_apellido_acudiente`, `celular_acudiente`, `telefono_acudiente`, `direccion_acudiente`, `correo_electronico`, `fecha_registro`, `fecha_retiro`, `tipo_documento_codigo_tipo_documento`) VALUES
(1, 1001, 'Juan', 'Pablo', 'G?mez', 'Mart?nez', '3001234567', '1234567', 'Calle 1 #10-20', 'correo_ejemplo@email.com', '2023-01-01', '0000-00-00', 1),
(2, 1002, 'Ana', 'Mar?a', 'L?pez', 'Hern?ndez', '3109876543', '7654321', 'Carrera 2 #30-15', 'ana@gmail.com', '2023-01-02', '0000-00-00', 1),
(3, 1003, 'Carlos', NULL, 'Ram?rez', 'Jim?nez', '3201122334', '2345678', 'Avenida 3 #40-25', NULL, '2023-01-03', '0000-00-00', 2),
(4, 1004, 'Sof?a', 'Isabel', 'Torres', 'Cruz', '3304455667', '3456789', 'Transversal 4 #50-35', NULL, '2023-01-04', '0000-00-00', 2),
(5, 1005, 'Luis', NULL, 'Mendoza', 'Salazar', '3405566778', '4567890', 'Diagonal 5 #60-45', NULL, '2023-01-05', '0000-00-00', 1),
(6, 1006, 'Mar?a', 'Jos?', 'Hern?ndez', 'Alvarez', '3506677889', '5678901', 'Carrera 6 #70-55', NULL, '2023-01-06', '0000-00-00', 1),
(7, 1007, 'Andr?s', NULL, 'Vargas', 'Garc?a', '3607788990', '6789012', 'Avenida 7 #80-65', NULL, '2023-01-07', '0000-00-00', 2),
(8, 1008, 'Luc?a', 'Estefan?a', 'Cruz', 'Torres', '3708899001', '7890123', 'Calle 8 #90-75', NULL, '2023-01-08', '0000-00-00', 2),
(9, 1009, 'Diego', NULL, 'Alvarez', 'Mora', '3809900112', '8901234', 'Transversal 9 #100-85', NULL, '2023-01-09', '0000-00-00', 1),
(10, 1010, 'Valentina', 'Paola', 'Castillo', 'Ram?rez', '3901011223', '9012345', 'Diagonal 10 #110-95', NULL, '2023-01-10', '0000-00-00', 1),
(123456789, 0, 'Juan', NULL, 'P?rez', NULL, NULL, '3001234567', 'Calle Falsa 123', NULL, '0000-00-00', '0000-00-00', 1),
(123456790, 1, 'john', 'james', 'londoño', 'tinoco', '123456789', '1234567890', 'x,.nvbzdujghb xjdgn', NULL, '2024-10-30', '2024-10-31', 1),
(123456794, 2, 'kwfnv', 'ljvnf', 'mvfnfakh', 'xkbvz', '0987654321', '098765432', 'xnvbzsh', 'kbhvash@gmail.com', '2024-10-30', '2024-10-31', 1);

--
-- Disparadores `acudientes`
--
DELIMITER $$
CREATE TRIGGER `after_acudiente_insert` AFTER INSERT ON `acudientes` FOR EACH ROW BEGIN
    INSERT INTO usuarios (
        documento_usuario,
        nombres_usuario,
        apellidos_usuario,
        correo_electronico_usuario,  
        telefono_usuario,
        contrasena_usuario,
        activo,
        eliminar,
        fecha_registro,
        rol_id_rol,
        tipo_documento_codigo_tipo_documento,
        grupo_id_grupo,
        rol_id_rol1
    ) VALUES (
        NEW.id_documento_acudiente,
        NEW.primer_nombre_acudiente,
        CONCAT(NEW.primer_apellido_acudiente, ' ', NEW.segundo_apellido_acudiente),
        NEW.correo_electronico,  
        NEW.telefono_acudiente,
        'default_password',
        1,
        0,
        NOW(),
        (SELECT id_rol FROM rol WHERE rol = 'ACUDIENTE'),
        NEW.tipo_documento_codigo_tipo_documento,
        1,
        (SELECT id_rol FROM rol WHERE rol = 'ESTUDIANTE')
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(20) NOT NULL,
  `lunes` varchar(3) DEFAULT NULL,
  `martes` varchar(3) DEFAULT NULL,
  `miercoles` varchar(3) DEFAULT NULL,
  `jueves` varchar(3) DEFAULT NULL,
  `viernes` varchar(3) DEFAULT NULL,
  `estudiantes_id_documento_estudiante` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `estudiantes_id_documento_estudiante`) VALUES
(2, 'A', 'A', 'P', 'P', 'A', 102),
(3, 'P', 'A', 'A', 'A', 'P', 103),
(4, 'P', 'P', 'P', 'P', 'P', 104),
(5, 'A', 'A', 'A', 'A', 'A', 105),
(6, 'P', 'A', 'P', 'A', 'P', 106),
(7, 'A', 'P', 'P', 'P', 'A', 107),
(8, 'P', 'A', 'A', 'A', 'P', 108),
(9, 'A', 'P', 'A', 'A', 'A', 109),
(10, 'P', 'P', 'P', 'A', 'P', 110);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_educativo`
--

CREATE TABLE `centro_educativo` (
  `id_centro_educativo` int(11) NOT NULL,
  `nombre_centro_educativo` varchar(255) NOT NULL,
  `direccion_centro_educativo` varchar(255) NOT NULL,
  `telefono_centro_educativo` varchar(20) NOT NULL,
  `correo_electronico_centro_educativo` varchar(255) NOT NULL,
  `sector_centro_educativo` varchar(255) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `centro_educativo`
--

INSERT INTO `centro_educativo` (`id_centro_educativo`, `nombre_centro_educativo`, `direccion_centro_educativo`, `telefono_centro_educativo`, `correo_electronico_centro_educativo`, `sector_centro_educativo`, `fecha_registro`) VALUES
(1, 'Colegio San Juan', 'Calle 10 #10-10', '3000000000', 'info@colegiosanjuan.edu.co', 'Urbano', '2024-01-01'),
(2, 'Instituto T?cnico', 'Calle 20 #20-20', '3000000001', 'info@institutotecnico.edu.co', 'Rural', '2024-01-01'),
(3, 'Escuela Primaria', 'Calle 30 #30-30', '3000000002', 'info@escuelaprimaria.edu.co', 'Urbano', '2024-01-01'),
(4, 'Colegio El Saber', 'Calle 40 #40-40', '3000000003', 'info@colegioelsaber.edu.co', 'Urbano', '2024-01-01'),
(5, 'Liceo San Jos?', 'Calle 50 #50-50', '3000000004', 'info@liceosanjose.edu.co', 'Rural', '2024-01-01'),
(6, 'Centro Educativo Los Pinos', 'Calle 60 #60-60', '3000000005', 'info@lospinos.edu.co', 'Urbano', '2024-01-01'),
(7, 'Academia de Artes', 'Calle 70 #70-70', '3000000006', 'info@academiadeartes.edu.co', 'Urbano', '2024-01-01'),
(8, 'Colegio T?cnico Superior', 'Calle 80 #80-80', '3000000007', 'info@colegiotecnicosuperior.edu.co', 'Rural', '2024-01-01'),
(9, 'Instituto de Ciencias', 'Calle 90 #90-90', '3000000008', 'info@institutodeciencias.edu.co', 'Urbano', '2024-01-01'),
(10, 'Escuela de Idiomas', 'Calle 100 #100-100', '3000000009', 'info@escueladeidiomas.edu.co', 'Urbano', '2024-01-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_documento_docente` bigint(12) NOT NULL,
  `codigo_docente` bigint(20) NOT NULL,
  `primer_nombre_docente` varchar(255) DEFAULT NULL,
  `segundo_nombre_docente` varchar(255) DEFAULT NULL,
  `primer_apellido_docente` varchar(255) DEFAULT NULL,
  `segundo_apellido_docente` varchar(255) DEFAULT NULL,
  `correo_electronico_docente` varchar(255) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `tipo_documento_codigo_tipo_documento` int(13) NOT NULL,
  `grupo_id_grupo` int(20) NOT NULL,
  `grupo_grado_id_grado` int(20) NOT NULL,
  `sede_id_sede` int(20) NOT NULL,
  `telefono_docente` bigint(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_documento_docente`, `codigo_docente`, `primer_nombre_docente`, `segundo_nombre_docente`, `primer_apellido_docente`, `segundo_apellido_docente`, `correo_electronico_docente`, `fecha_registro`, `fecha_retiro`, `tipo_documento_codigo_tipo_documento`, `grupo_id_grupo`, `grupo_grado_id_grado`, `sede_id_sede`, `telefono_docente`) VALUES
(101, 1, 'Juan', 'Pablo', 'Garc?a', 'Mart?nez', 'juan.garcia@email.com', '2024-01-01', NULL, 1, 1, 1, 1, NULL),
(102, 2, 'Mar?a', 'Jos?', 'L?pez', 'R?os', 'maria.lopez@email.com', '2024-01-02', NULL, 1, 1, 1, 1, NULL),
(103, 3, 'Carlos', 'Andr?s', 'Fern?ndez', 'P?rez', 'carlos.fernandez@email.com', '2024-01-03', NULL, 1, 1, 1, 1, NULL),
(104, 4, 'Ana', 'Luc?a', 'Torres', 'Hern?ndez', 'ana.torres@email.com', '2024-01-04', NULL, 1, 1, 1, 1, NULL),
(105, 5, 'Diego', NULL, 'Ram?rez', 'S?nchez', 'diego.ramirez@email.com', '2024-01-05', NULL, 1, 1, 1, 1, NULL),
(106, 6, 'Laura', 'Isabel', 'Gonz?lez', 'Cruz', 'laura.gonzalez@email.com', '2024-01-06', NULL, 1, 1, 1, 1, NULL),
(107, 7, 'Luis', 'Fernando', 'Morales', 'Vargas', 'luis.morales@email.com', '2024-01-07', NULL, 1, 1, 1, 1, NULL),
(108, 8, 'Sara', NULL, 'Castillo', 'Mendoza', 'sara.castillo@email.com', '2024-01-08', NULL, 1, 1, 1, 1, NULL),
(109, 9, 'David', 'Alejandro', 'Jim?nez', 'Salazar', 'david.jimenez@email.com', '2024-01-09', NULL, 1, 1, 1, 1, NULL),
(110, 10, 'Valentina', 'Andrea', 'Ocampo', 'G?mez', 'valentina.ocampo@email.com', '2024-01-10', NULL, 1, 1, 1, 1, NULL),
(131, 106, 'Sof?a', 'Mariana', 'P?rez', 'Mart?nez', 'sofia.perez@email.com', '2024-10-30', NULL, 1, 1, 1, 1, 3101234567),
(132, 107, 'Felipe', 'Andr?s', 'Hern?ndez', 'G?mez', 'felipe.hernandez@email.com', '2024-10-30', NULL, 1, 1, 1, 1, 3102345678),
(133, 108, 'Camila', 'Isabel', 'Jim?nez', 'Cruz', 'camila.jimenez@email.com', '2024-10-30', NULL, 1, 1, 1, 1, 3103456789),
(134, 109, 'Diego', 'Fernando', 'Mora', 'Su?rez', 'diego.mora@email.com', '2024-10-30', NULL, 1, 1, 1, 1, 3104567890),
(135, 110, 'Sara', 'Gabriela', 'Salazar', 'Daza', 'sara.salazar@email.com', '2024-10-30', NULL, 1, 1, 1, 1, 3105678901);

--
-- Disparadores `docentes`
--
DELIMITER $$
CREATE TRIGGER `after_docente_insert` AFTER INSERT ON `docentes` FOR EACH ROW BEGIN
    INSERT INTO usuarios (
        documento_usuario,
        nombres_usuario,
        apellidos_usuario,
        correo_electronico_usuario,
        contrasena_usuario,
        activo,
        eliminar,
        fecha_registro,
        rol_id_rol,
        tipo_documento_codigo_tipo_documento,
        grupo_id_grupo,
        rol_id_rol1
    ) VALUES (
        NEW.id_documento_docente,
        NEW.primer_nombre_docente,
        NEW.primer_apellido_docente,
        NEW.correo_electronico_docente,
        'default_password',                
        1,                                 
        0,                                 
        NOW(),
        (SELECT id_rol FROM rol WHERE rol = 'DOCENTE'),
        NEW.tipo_documento_codigo_tipo_documento,
        NEW.grupo_id_grupo,
        (SELECT id_rol FROM rol WHERE rol = 'DOCENTE')  
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_docentes` AFTER INSERT ON `docentes` FOR EACH ROW BEGIN
    DECLARE existing_user INT;

    
    SELECT COUNT(*) INTO existing_user 
    FROM usuarios 
    WHERE documento_usuario = NEW.id_documento_docente OR telefono_usuario = NEW.telefono_docente;

    IF existing_user = 0 THEN
        INSERT INTO usuarios (documento_usuario, nombres_usuario, apellidos_usuario, correo_electronico_usuario, telefono_usuario, fecha_registro, rol_id_rol, tipo_documento_codigo_tipo_documento)
        VALUES (NEW.id_documento_docente, NEW.primer_nombre_docente, NEW.primer_apellido_docente, NEW.correo_electronico_docente, NEW.telefono_docente, NEW.fecha_registro, 4, NEW.tipo_documento_codigo_tipo_documento);
    ELSE
        
        UPDATE usuarios
        SET nombres_usuario = NEW.primer_nombre_docente,
            apellidos_usuario = NEW.primer_apellido_docente,
            correo_electronico_usuario = NEW.correo_electronico_docente,
            telefono_usuario = NEW.telefono_docente,
            fecha_registro = NEW.fecha_registro,
            rol_id_rol = 4,
            tipo_documento_codigo_tipo_documento = NEW.tipo_documento_codigo_tipo_documento
        WHERE documento_usuario = NEW.id_documento_docente OR telefono_usuario = NEW.telefono_docente;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_documento_estudiante` bigint(12) NOT NULL,
  `codigo_estudiante` bigint(20) NOT NULL,
  `primer_nombre_estudiante` varchar(255) DEFAULT NULL,
  `segundo_nombre_estudiante` varchar(255) DEFAULT NULL,
  `primer_apellido_estudiante` varchar(255) DEFAULT NULL,
  `segundo_apellido_estudiante` varchar(255) DEFAULT NULL,
  `edad_estudiante` int(3) DEFAULT NULL,
  `fecha_nacimiento_estudiante` date DEFAULT NULL,
  `celular_estudiante` varchar(50) DEFAULT NULL,
  `telefono_estudiante` varchar(50) DEFAULT NULL,
  `correo_electronico_estudiante` varchar(255) DEFAULT NULL,
  `direccion_estudiante` varchar(255) DEFAULT NULL,
  `fecha_matricula` date NOT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `acudientes_id_documento_acudiente` bigint(12) NOT NULL,
  `tipo_documento_codigo_tipo_documento` int(13) NOT NULL,
  `grupo_id_grupo` int(20) NOT NULL,
  `grupo_grado_id_grado` int(20) NOT NULL,
  `grupo_grado_sede_id_sede` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_documento_estudiante`, `codigo_estudiante`, `primer_nombre_estudiante`, `segundo_nombre_estudiante`, `primer_apellido_estudiante`, `segundo_apellido_estudiante`, `edad_estudiante`, `fecha_nacimiento_estudiante`, `celular_estudiante`, `telefono_estudiante`, `correo_electronico_estudiante`, `direccion_estudiante`, `fecha_matricula`, `fecha_retiro`, `acudientes_id_documento_acudiente`, `tipo_documento_codigo_tipo_documento`, `grupo_id_grupo`, `grupo_grado_id_grado`, `grupo_grado_sede_id_sede`) VALUES
(102, 1002, 'Mar?a', 'Fernanda', 'L?pez', 'Mart?nez', 14, '2010-07-22', '3002345678', '4442345678', 'maria.lopez@example.com', 'Calle 2 #34-56', '2024-01-15', NULL, 2, 1, 1, 1, 1),
(103, 1003, 'Carlos', 'Andr?s', 'G?mez', 'Hern?ndez', 16, '2008-09-15', '3003456789', '4443456789', 'carlos.gomez@example.com', 'Calle 3 #45-67', '2024-01-15', NULL, 3, 1, 1, 1, 1),
(104, 1004, 'Ana', 'Mar?a', 'Ram?rez', 'Torres', 15, '2009-01-20', '3004567890', '4444567890', 'ana.ramirez@example.com', 'Calle 4 #56-78', '2024-01-15', NULL, 4, 1, 1, 1, 1),
(105, 1005, 'Diego', 'Fernando', 'Cruz', 'R?os', 17, '2007-05-25', '3005678901', '4445678901', 'diego.cruz@example.com', 'Calle 5 #67-89', '2024-01-15', NULL, 5, 1, 1, 1, 1),
(106, 1006, 'Sof?a', 'Isabella', 'Torres', 'P?rez', 16, '2008-11-30', '3006789012', '4446789012', 'sofia.torres@example.com', 'Calle 6 #78-90', '2024-01-15', NULL, 6, 1, 1, 1, 1),
(107, 1007, 'Felipe', 'Andr?s', 'Mendoza', 'S?nchez', 14, '2010-06-14', '3007890123', '4447890123', 'felipe.mendoza@example.com', 'Calle 7 #89-01', '2024-01-15', NULL, 7, 1, 1, 1, 1),
(108, 1008, 'Valentina', 'Sof?a', 'Moreno', 'Gonz?lez', 15, '2009-04-18', '3008901234', '4448901234', 'valentina.moreno@example.com', 'Calle 8 #90-12', '2024-01-15', NULL, 8, 1, 1, 1, 1),
(109, 1009, 'Gabriel', 'Alejandro', 'Mora', 'Jim?nez', 14, '2010-08-02', '3009012345', '4449012345', 'gabriel.mora@example.com', 'Calle 9 #01-23', '2024-01-15', NULL, 9, 1, 1, 1, 1),
(110, 1010, 'Camila', 'Andrea', 'Salazar', 'Hern?ndez', 15, '2009-02-16', '3000123456', '4440123456', 'camila.salazar@example.com', 'Calle 10 #12-34', '2024-01-15', NULL, 10, 1, 1, 1, 1);

--
-- Disparadores `estudiantes`
--
DELIMITER $$
CREATE TRIGGER `after_estudiante_insert` AFTER INSERT ON `estudiantes` FOR EACH ROW BEGIN
    INSERT INTO usuarios (
        documento_usuario, 
        nombres_usuario, 
        apellidos_usuario, 
        correo_electronico_usuario, 
        telefono_usuario, 
        contrasena_usuario, 
        activo, 
        eliminar, 
        fecha_registro, 
        rol_id_rol, 
        tipo_documento_codigo_tipo_documento, 
        grupo_id_grupo
    ) VALUES (
        NEW.codigo_estudiante, 
        NEW.primer_nombre_estudiante, 
        NEW.primer_apellido_estudiante, 
        NEW.correo_electronico_estudiante, 
        NEW.celular_estudiante, 
        'default_password',  
        1,                  
        0,                  
        NOW(),              
        (SELECT id_rol FROM rol WHERE rol = 'ESTUDIANTE'), 
        NEW.tipo_documento_codigo_tipo_documento, 
        NEW.grupo_id_grupo
    );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_estudiante` AFTER INSERT ON `estudiantes` FOR EACH ROW BEGIN
    DECLARE rol_id INT;

    
    SELECT id_rol INTO rol_id FROM rol WHERE rol = 'ESTUDIANTE';

    
    INSERT INTO usuarios
        (documento_usuario, nombres_usuario, apellidos_usuario, correo_electronico_usuario, telefono_usuario, contrasena_usuario, activo, eliminar, fecha_registro, rol_id_rol, tipo_documento_codigo_tipo_documento, grupo_id_grupo)
    VALUES
        (NEW.codigo_estudiante,
         CONCAT(NEW.primer_nombre_estudiante, ' ', NEW.segundo_nombre_estudiante),
         CONCAT(NEW.primer_apellido_estudiante, ' ', NEW.segundo_apellido_estudiante),
         NEW.correo_electronico_estudiante,
         NEW.celular_estudiante,
         'contrasena123',
         1,
         0,
         CURDATE(),
         rol_id,
         NEW.tipo_documento_codigo_tipo_documento,
         NEW.grupo_id_grupo);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `id_grado` int(11) NOT NULL,
  `nombre_grado` varchar(255) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `nombre_grado`, `sede_id_sede`) VALUES
(1, 'Primer Grado', 1),
(2, 'Segundo Grado', 1),
(3, 'Tercer Grado', 1),
(4, 'Cuarto Grado', 2),
(5, 'Quinto Grado', 2),
(6, 'Sexto Grado', 3),
(7, 'S?ptimo Grado', 3),
(8, 'Octavo Grado', 4),
(9, 'Noveno Grado', 4),
(10, 'D?cimo Grado', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre_grupo` varchar(255) NOT NULL,
  `fecha_registro` datetime DEFAULT current_timestamp(),
  `grado_id_grado` int(11) NOT NULL,
  `grado_sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nombre_grupo`, `fecha_registro`, `grado_id_grado`, `grado_sede_id_sede`) VALUES
(1, 'Grupo A', '2024-10-30 11:00:21', 1, 1),
(2, 'Grupo B', '2024-10-30 11:00:21', 1, 1),
(3, 'Grupo C', '2024-10-30 11:00:21', 2, 1),
(4, 'Grupo D', '2024-10-30 11:00:21', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_contrasena`
--

CREATE TABLE `historia_contrasena` (
  `id_historia_contrasena` int(12) NOT NULL,
  `historia_contrasena` varchar(255) NOT NULL,
  `usuarios_id_usuario` int(20) NOT NULL,
  `usuarios_rol_id_rol` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historia_contrasena`
--

INSERT INTO `historia_contrasena` (`id_historia_contrasena`, `historia_contrasena`, `usuarios_id_usuario`, `usuarios_rol_id_rol`) VALUES
(4, 'default_password', 12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(11) NOT NULL,
  `descripcion_materia` varchar(255) NOT NULL,
  `docentes_id_documento_docente` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `descripcion_materia`, `docentes_id_documento_docente`) VALUES
(7, 'Arte', 107),
(2, 'Ciencias', 102),
(6, 'Educaci?n F?sica', 106),
(10, 'F?sica', 110),
(4, 'Geograf?a', 104),
(3, 'Historia', 103),
(5, 'Lengua Espa?ola', 105),
(8, 'M?sica', 108),
(1, 'Matem?ticas', 101),
(9, 'Qu?mica', 109);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia_has_grupo`
--

CREATE TABLE `materia_has_grupo` (
  `materia_id_materia` int(11) NOT NULL,
  `materia_docentes_id_documento_docente` bigint(20) NOT NULL,
  `grupo_id_grupo` int(11) NOT NULL,
  `grupo_grado_id_grado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia_has_grupo`
--

INSERT INTO `materia_has_grupo` (`materia_id_materia`, `materia_docentes_id_documento_docente`, `grupo_id_grupo`, `grupo_grado_id_grado`) VALUES
(1, 101, 1, 1),
(2, 102, 1, 1),
(3, 103, 2, 1),
(3, 103, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE `nota` (
  `id_nota` smallint(6) NOT NULL,
  `nota` float DEFAULT NULL,
  `tema_id_tema` int(11) NOT NULL,
  `tema_materia_id_materia` int(11) NOT NULL,
  `estudiantes_id_documento_estudiante` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`id_nota`, `nota`, `tema_id_tema`, `tema_materia_id_materia`, `estudiantes_id_documento_estudiante`) VALUES
(2, 3.8, 1, 1, 102),
(3, 5, 2, 2, 103),
(4, 4.2, 2, 2, 104),
(5, 3.6, 1, 1, 105),
(6, 4, 2, 2, 106),
(7, 2.9, 1, 1, 107),
(8, 4.7, 2, 2, 108),
(9, 3.3, 2, 2, 109),
(10, 4.8, 2, 2, 110);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(12) NOT NULL,
  `rol` enum('ESTUDIANTE','DOCENTE','ACUDIENTE','RECTOR','ADMINISTRADOR','COORDINADOR') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'RECTOR'),
(3, 'COORDINADOR'),
(4, 'DOCENTE'),
(5, 'ACUDIENTE'),
(6, 'ESTUDIANTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(255) NOT NULL,
  `direccion_sede` varchar(255) NOT NULL,
  `telefono_sede` varchar(20) NOT NULL,
  `correo_electronico_sede` varchar(255) NOT NULL,
  `sector_sede` varchar(255) NOT NULL,
  `centro_educativo_id_centro_educativo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre_sede`, `direccion_sede`, `telefono_sede`, `correo_electronico_sede`, `sector_sede`, `centro_educativo_id_centro_educativo`) VALUES
(1, 'Sede Centro', 'Calle 101 #1-1', '3001111111', 'sede1@colegiosanjuan.edu.co', 'Urbano', 1),
(2, 'Sede Norte', 'Calle 202 #2-2', '3002222222', 'sede2@colegiosanjuan.edu.co', 'Urbano', 1),
(3, 'Sede Sur', 'Calle 303 #3-3', '3003333333', 'sede3@colegiosanjuan.edu.co', 'Rural', 2),
(4, 'Sede Occidente', 'Calle 404 #4-4', '3004444444', 'sede4@colegiosanjuan.edu.co', 'Urbano', 3),
(5, 'Sede Oriente', 'Calle 505 #5-5', '3005555555', 'sede5@colegiosanjuan.edu.co', 'Urbano', 4),
(6, 'Sede El Lago', 'Calle 606 #6-6', '3006666666', 'sede6@colegiosanjuan.edu.co', 'Urbano', 5),
(7, 'Sede La Esperanza', 'Calle 707 #7-7', '3007777777', 'sede7@colegiosanjuan.edu.co', 'Rural', 6),
(8, 'Sede San Vicente', 'Calle 808 #8-8', '3008888888', 'sede8@colegiosanjuan.edu.co', 'Urbano', 7),
(9, 'Sede La Libertad', 'Calle 909 #9-9', '3009999999', 'sede9@colegiosanjuan.edu.co', 'Urbano', 8),
(10, 'Sede El Futuro', 'Calle 1000 #10-10', '3010000000', 'sede10@colegiosanjuan.edu.co', 'Urbano', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimientos`
--

CREATE TABLE `seguimientos` (
  `id_seguimiento` int(11) NOT NULL,
  `descripcion_seguimiento` varchar(255) NOT NULL,
  `fecha_seguimiento` date NOT NULL,
  `estudiantes_id_documento_estudiante` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `seguimientos`
--

INSERT INTO `seguimientos` (`id_seguimiento`, `descripcion_seguimiento`, `fecha_seguimiento`, `estudiantes_id_documento_estudiante`) VALUES
(2, 'Evaluaci?n de habilidades sociales', '2023-01-16', 102),
(3, 'Informe de comportamiento', '2023-01-17', 103),
(4, 'Reuni?n con padres', '2023-01-18', 104),
(5, 'An?lisis de progreso', '2023-01-19', 105),
(6, 'Recomendaciones para mejora', '2023-01-20', 106),
(7, 'Seguimiento de asistencia', '2023-01-21', 107),
(8, 'Informe de actividades extracurriculares', '2023-01-22', 108),
(9, 'Evaluaci?n de resultados', '2023-01-23', 109),
(10, 'Plan de intervenci?n', '2023-01-24', 110);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `id_tema` int(11) NOT NULL,
  `descripcion_tema` varchar(255) DEFAULT NULL,
  `materia_id_materia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`id_tema`, `descripcion_tema`, `materia_id_materia`) VALUES
(1, '?lgebra', 1),
(2, 'Ecosistemas', 2),
(3, 'Revoluci?n Francesa', 3),
(4, 'Mapas Pol?ticos', 4),
(5, 'Gram?tica', 5),
(6, 'F?tbol', 6),
(7, 'Pintura', 7),
(8, 'Teor?a Musical', 8),
(9, 'Reacciones Qu?micas', 9),
(10, 'Cinem?tica', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `codigo_tipo_documento` int(11) NOT NULL,
  `descripcion_tipo_documento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`codigo_tipo_documento`, `descripcion_tipo_documento`) VALUES
(1, 'C?dula de Ciudadan?a'),
(3, 'Pasaporte'),
(4, 'Registro Civil'),
(2, 'Tarjeta de Identidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(20) NOT NULL,
  `documento_usuario` int(13) DEFAULT NULL,
  `nombres_usuario` varchar(255) DEFAULT NULL,
  `apellidos_usuario` varchar(255) DEFAULT NULL,
  `telefono_usuario` varchar(15) DEFAULT NULL,
  `contrasena_usuario` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `eliminar` tinyint(1) NOT NULL,
  `fecha_registro` date NOT NULL,
  `rol_id_rol` int(12) NOT NULL,
  `tipo_documento_codigo_tipo_documento` int(13) NOT NULL,
  `grupo_id_grupo` int(20) NOT NULL,
  `rol_id_rol1` int(12) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `correo_electronico_usuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `documento_usuario`, `nombres_usuario`, `apellidos_usuario`, `telefono_usuario`, `contrasena_usuario`, `activo`, `eliminar`, `fecha_registro`, `rol_id_rol`, `tipo_documento_codigo_tipo_documento`, `grupo_id_grupo`, `rol_id_rol1`, `id_rol`, `correo_electronico_usuario`) VALUES
(1, 123456789, 'Juan', 'P?rez', '2147483647', 'default_password', 1, 0, '2024-10-30', 5, 1, 1, 6, NULL, NULL),
(7, 131, 'Sof?a', 'P?rez', '3101234567', 'default_password', 1, 0, '2024-10-30', 4, 1, 1, 4, NULL, NULL),
(8, 132, 'Felipe', 'Hern?ndez', '3102345678', 'default_password', 1, 0, '2024-10-30', 4, 1, 1, 4, NULL, NULL),
(9, 133, 'Camila', 'Jim?nez', '3103456789', 'default_password', 1, 0, '2024-10-30', 4, 1, 1, 4, NULL, NULL),
(10, 134, 'Diego', 'Mora', '3104567890', 'default_password', 1, 0, '2024-10-30', 4, 1, 1, 4, NULL, NULL),
(11, 135, 'Sara', 'Salazar', '3105678901', 'default_password', 1, 0, '2024-10-30', 4, 1, 1, 4, NULL, NULL),
(12, 123456790, 'john', 'londoño', '1234567890', 'default_password1', 1, 0, '2024-10-30', 5, 1, 1, 6, NULL, NULL),
(13, 123456794, 'kwfnv', 'mvfnfakh xkbvz', '098765432', 'default_password', 1, 0, '2024-10-30', 5, 1, 1, 6, NULL, 'kbhvash@gmail.com');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `before_update_contrasena` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
    IF OLD.contrasena_usuario != NEW.contrasena_usuario THEN
        INSERT INTO historia_contrasena (
            historia_contrasena,
            usuarios_id_usuario
        )
        VALUES (
            OLD.contrasena_usuario,
            OLD.id_usuario
        );
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_docentes_materias`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_docentes_materias` (
`id_documento_docente` bigint(12)
,`codigo_docente` bigint(20)
,`primer_nombre_docente` varchar(255)
,`segundo_nombre_docente` varchar(255)
,`primer_apellido_docente` varchar(255)
,`segundo_apellido_docente` varchar(255)
,`correo_electronico_docente` varchar(255)
,`descripcion_materia` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_estudiantes_grados`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_estudiantes_grados` (
`id_documento_estudiante` bigint(12)
,`codigo_estudiante` bigint(20)
,`primer_nombre_estudiante` varchar(255)
,`segundo_nombre_estudiante` varchar(255)
,`primer_apellido_estudiante` varchar(255)
,`segundo_apellido_estudiante` varchar(255)
,`edad_estudiante` int(3)
,`correo_electronico_estudiante` varchar(255)
,`nombre_grado` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_usuario_roles`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_usuario_roles` (
`id_usuario` int(20)
,`documento_usuario` int(13)
,`nombres_usuario` varchar(255)
,`apellidos_usuario` varchar(255)
,`correo_electronico_usuario` varchar(255)
,`telefono_usuario` varchar(15)
,`nombre_rol` enum('ESTUDIANTE','DOCENTE','ACUDIENTE','RECTOR','ADMINISTRADOR','COORDINADOR')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_docentes_materias`
--
DROP TABLE IF EXISTS `vista_docentes_materias`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_docentes_materias`  AS SELECT `docentes`.`id_documento_docente` AS `id_documento_docente`, `docentes`.`codigo_docente` AS `codigo_docente`, `docentes`.`primer_nombre_docente` AS `primer_nombre_docente`, `docentes`.`segundo_nombre_docente` AS `segundo_nombre_docente`, `docentes`.`primer_apellido_docente` AS `primer_apellido_docente`, `docentes`.`segundo_apellido_docente` AS `segundo_apellido_docente`, `docentes`.`correo_electronico_docente` AS `correo_electronico_docente`, `materia`.`descripcion_materia` AS `descripcion_materia` FROM (`docentes` join `materia` on(`docentes`.`id_documento_docente` = `materia`.`docentes_id_documento_docente`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_estudiantes_grados`
--
DROP TABLE IF EXISTS `vista_estudiantes_grados`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_estudiantes_grados`  AS SELECT `estudiantes`.`id_documento_estudiante` AS `id_documento_estudiante`, `estudiantes`.`codigo_estudiante` AS `codigo_estudiante`, `estudiantes`.`primer_nombre_estudiante` AS `primer_nombre_estudiante`, `estudiantes`.`segundo_nombre_estudiante` AS `segundo_nombre_estudiante`, `estudiantes`.`primer_apellido_estudiante` AS `primer_apellido_estudiante`, `estudiantes`.`segundo_apellido_estudiante` AS `segundo_apellido_estudiante`, `estudiantes`.`edad_estudiante` AS `edad_estudiante`, `estudiantes`.`correo_electronico_estudiante` AS `correo_electronico_estudiante`, `grado`.`nombre_grado` AS `nombre_grado` FROM (`estudiantes` join `grado` on(`estudiantes`.`grupo_grado_id_grado` = `grado`.`id_grado`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_usuario_roles`
--
DROP TABLE IF EXISTS `vista_usuario_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_usuario_roles`  AS SELECT `usuarios`.`id_usuario` AS `id_usuario`, `usuarios`.`documento_usuario` AS `documento_usuario`, `usuarios`.`nombres_usuario` AS `nombres_usuario`, `usuarios`.`apellidos_usuario` AS `apellidos_usuario`, `usuarios`.`correo_electronico_usuario` AS `correo_electronico_usuario`, `usuarios`.`telefono_usuario` AS `telefono_usuario`, `rol`.`rol` AS `nombre_rol` FROM (`usuarios` join `rol` on(`usuarios`.`rol_id_rol` = `rol`.`id_rol`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  ADD PRIMARY KEY (`id_documento_acudiente`),
  ADD UNIQUE KEY `codigo_acudiente_index` (`codigo_acudiente`),
  ADD UNIQUE KEY `celular_acudiente_index` (`celular_acudiente`),
  ADD UNIQUE KEY `telefono_acudiente_index` (`telefono_acudiente`),
  ADD UNIQUE KEY `direccion_acudiente_index` (`direccion_acudiente`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`),
  ADD KEY `fk_acudientes_tipo_documento1_idx` (`tipo_documento_codigo_tipo_documento`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`,`estudiantes_id_documento_estudiante`),
  ADD UNIQUE KEY `id_asistencia` (`id_asistencia`),
  ADD KEY `fk_asistencia_estudiantes1_idx` (`estudiantes_id_documento_estudiante`);

--
-- Indices de la tabla `centro_educativo`
--
ALTER TABLE `centro_educativo`
  ADD PRIMARY KEY (`id_centro_educativo`),
  ADD UNIQUE KEY `telefono_centro_educativo_index` (`telefono_centro_educativo`),
  ADD UNIQUE KEY `correo_electronico_centro_educativo_index` (`correo_electronico_centro_educativo`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_documento_docente`,`grupo_id_grupo`,`grupo_grado_id_grado`),
  ADD UNIQUE KEY `codigo_docente` (`codigo_docente`),
  ADD UNIQUE KEY `id_documento_docente` (`id_documento_docente`),
  ADD UNIQUE KEY `correo_electronico_docente` (`correo_electronico_docente`),
  ADD KEY `fk_docentes_tipo_documento1_idx` (`tipo_documento_codigo_tipo_documento`),
  ADD KEY `fk_docentes_grupo1_idx` (`grupo_id_grupo`,`grupo_grado_id_grado`),
  ADD KEY `fk_docentes_sede1_idx` (`sede_id_sede`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_documento_estudiante`,`grupo_id_grupo`,`grupo_grado_id_grado`,`grupo_grado_sede_id_sede`),
  ADD UNIQUE KEY `codigo_estudiante` (`codigo_estudiante`),
  ADD UNIQUE KEY `id_documento_estudiante` (`id_documento_estudiante`),
  ADD UNIQUE KEY `celular_estudiante` (`celular_estudiante`),
  ADD UNIQUE KEY `telefono_estudiante` (`telefono_estudiante`),
  ADD UNIQUE KEY `correo_electronico_estudiante` (`correo_electronico_estudiante`),
  ADD KEY `fk_estudiantes_acudientes1_idx` (`acudientes_id_documento_acudiente`),
  ADD KEY `fk_estudiantes_tipo_documento1_idx` (`tipo_documento_codigo_tipo_documento`),
  ADD KEY `fk_estudiantes_grupo1_idx` (`grupo_id_grupo`,`grupo_grado_id_grado`,`grupo_grado_sede_id_sede`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`id_grado`,`sede_id_sede`),
  ADD KEY `fk_grado_sede1_idx` (`sede_id_sede`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`,`grado_id_grado`,`grado_sede_id_sede`),
  ADD KEY `fk_grupo_grado1_idx` (`grado_id_grado`,`grado_sede_id_sede`);

--
-- Indices de la tabla `historia_contrasena`
--
ALTER TABLE `historia_contrasena`
  ADD PRIMARY KEY (`id_historia_contrasena`),
  ADD KEY `fk_historia_contrasena_usuarios1_idx` (`usuarios_id_usuario`,`usuarios_rol_id_rol`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`,`docentes_id_documento_docente`),
  ADD UNIQUE KEY `id_materia` (`id_materia`),
  ADD UNIQUE KEY `descripcion_materia` (`descripcion_materia`),
  ADD KEY `fk_materia_docentes1_idx` (`docentes_id_documento_docente`);

--
-- Indices de la tabla `materia_has_grupo`
--
ALTER TABLE `materia_has_grupo`
  ADD PRIMARY KEY (`materia_id_materia`,`materia_docentes_id_documento_docente`,`grupo_id_grupo`,`grupo_grado_id_grado`),
  ADD KEY `fk_materia_has_grupo_grupo1_idx` (`grupo_id_grupo`,`grupo_grado_id_grado`),
  ADD KEY `fk_materia_has_grupo_materia1_idx` (`materia_id_materia`,`materia_docentes_id_documento_docente`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`,`tema_id_tema`,`tema_materia_id_materia`,`estudiantes_id_documento_estudiante`),
  ADD UNIQUE KEY `id_nota` (`id_nota`),
  ADD KEY `fk_nota_tema1_idx` (`tema_id_tema`,`tema_materia_id_materia`),
  ADD KEY `fk_nota_estudiantes1_idx` (`estudiantes_id_documento_estudiante`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`),
  ADD UNIQUE KEY `telefono_sede_index` (`telefono_sede`),
  ADD UNIQUE KEY `correo_electronico_sede_index` (`correo_electronico_sede`),
  ADD KEY `fk_sede_centro_educativo_idx` (`centro_educativo_id_centro_educativo`);

--
-- Indices de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD PRIMARY KEY (`id_seguimiento`,`estudiantes_id_documento_estudiante`),
  ADD UNIQUE KEY `id_seguimiento` (`id_seguimiento`),
  ADD KEY `fk_seguimientos_estudiantes1_idx` (`estudiantes_id_documento_estudiante`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`id_tema`,`materia_id_materia`),
  ADD UNIQUE KEY `id_tema` (`id_tema`),
  ADD KEY `fk_tema_materia1_idx` (`materia_id_materia`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`codigo_tipo_documento`),
  ADD UNIQUE KEY `descripcion_tipo_documento_index` (`descripcion_tipo_documento`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`,`rol_id_rol`,`grupo_id_grupo`,`rol_id_rol1`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `documento_usuario` (`documento_usuario`),
  ADD UNIQUE KEY `telefono_usuario` (`telefono_usuario`),
  ADD KEY `fk_usuarios_tipo_documento1_idx` (`tipo_documento_codigo_tipo_documento`),
  ADD KEY `fk_usuarios_grupo1_idx` (`grupo_id_grupo`),
  ADD KEY `fk_usuarios_rol1_idx` (`rol_id_rol1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acudientes`
--
ALTER TABLE `acudientes`
  MODIFY `id_documento_acudiente` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123456795;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `centro_educativo`
--
ALTER TABLE `centro_educativo`
  MODIFY `id_centro_educativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_documento_docente` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_documento_estudiante` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `historia_contrasena`
--
ALTER TABLE `historia_contrasena`
  MODIFY `id_historia_contrasena` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `id_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acudientes`
--
ALTER TABLE `acudientes`
  ADD CONSTRAINT `fk_acudientes_tipo_documento1` FOREIGN KEY (`tipo_documento_codigo_tipo_documento`) REFERENCES `tipo_documento` (`codigo_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_estudiantes1` FOREIGN KEY (`estudiantes_id_documento_estudiante`) REFERENCES `estudiantes` (`id_documento_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD CONSTRAINT `fk_docentes_grupo1` FOREIGN KEY (`grupo_id_grupo`,`grupo_grado_id_grado`) REFERENCES `grupo` (`id_grupo`, `grado_id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_sede1` FOREIGN KEY (`sede_id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docentes_tipo_documento1` FOREIGN KEY (`tipo_documento_codigo_tipo_documento`) REFERENCES `tipo_documento` (`codigo_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `fk_estudiantes_acudientes1` FOREIGN KEY (`acudientes_id_documento_acudiente`) REFERENCES `acudientes` (`id_documento_acudiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiantes_grupo1` FOREIGN KEY (`grupo_id_grupo`,`grupo_grado_id_grado`,`grupo_grado_sede_id_sede`) REFERENCES `grupo` (`id_grupo`, `grado_id_grado`, `grado_sede_id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiantes_tipo_documento1` FOREIGN KEY (`tipo_documento_codigo_tipo_documento`) REFERENCES `tipo_documento` (`codigo_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `fk_grado_sede1` FOREIGN KEY (`sede_id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `fk_grupo_grado1` FOREIGN KEY (`grado_id_grado`,`grado_sede_id_sede`) REFERENCES `grado` (`id_grado`, `sede_id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `historia_contrasena`
--
ALTER TABLE `historia_contrasena`
  ADD CONSTRAINT `fk_historia_contrasena_usuarios1` FOREIGN KEY (`usuarios_id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `fk_materia_docentes1` FOREIGN KEY (`docentes_id_documento_docente`) REFERENCES `docentes` (`id_documento_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `materia_has_grupo`
--
ALTER TABLE `materia_has_grupo`
  ADD CONSTRAINT `fk_materia_has_grupo_grupo1` FOREIGN KEY (`grupo_id_grupo`,`grupo_grado_id_grado`) REFERENCES `grupo` (`id_grupo`, `grado_id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materia_has_grupo_materia1` FOREIGN KEY (`materia_id_materia`,`materia_docentes_id_documento_docente`) REFERENCES `materia` (`id_materia`, `docentes_id_documento_docente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `fk_nota_estudiantes1` FOREIGN KEY (`estudiantes_id_documento_estudiante`) REFERENCES `estudiantes` (`id_documento_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_tema1` FOREIGN KEY (`tema_id_tema`,`tema_materia_id_materia`) REFERENCES `tema` (`id_tema`, `materia_id_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `fk_sede_centro_educativo` FOREIGN KEY (`centro_educativo_id_centro_educativo`) REFERENCES `centro_educativo` (`id_centro_educativo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimientos`
--
ALTER TABLE `seguimientos`
  ADD CONSTRAINT `fk_seguimientos_estudiantes1` FOREIGN KEY (`estudiantes_id_documento_estudiante`) REFERENCES `estudiantes` (`id_documento_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `fk_tema_materia1` FOREIGN KEY (`materia_id_materia`) REFERENCES `materia` (`id_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_grupo1` FOREIGN KEY (`grupo_id_grupo`) REFERENCES `grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_rol1` FOREIGN KEY (`rol_id_rol1`) REFERENCES `rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_tipo_documento1` FOREIGN KEY (`tipo_documento_codigo_tipo_documento`) REFERENCES `tipo_documento` (`codigo_tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
