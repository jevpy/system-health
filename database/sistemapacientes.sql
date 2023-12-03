-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2023 a las 04:54:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemapacientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camillas`
--

CREATE TABLE `camillas` (
  `camilla_id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(50) NOT NULL,
  `grupo` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camillas`
--

INSERT INTO `camillas` (`camilla_id`, `numero`, `grupo`) VALUES
(12, 'Camilla 1', 2),
(13, 'Camilla 2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `grupo_id` int(10) UNSIGNED NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`grupo_id`, `nombre_grupo`) VALUES
(1, 'Grupo 1'),
(2, 'Grupo 2'),
(3, 'Grupo 3'),
(4, 'Sin Grupo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_x_video`
--

CREATE TABLE `grupo_x_video` (
  `gxv_id` int(10) UNSIGNED NOT NULL,
  `video` int(10) UNSIGNED DEFAULT NULL,
  `grupo` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupo_x_video`
--

INSERT INTO `grupo_x_video` (`gxv_id`, `video`, `grupo`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 7, 3),
(6, 12, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permiso_id` int(10) UNSIGNED NOT NULL,
  `permiso_nombre` varchar(50) NOT NULL,
  `permiso_descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`permiso_id`, `permiso_nombre`, `permiso_descripcion`) VALUES
(1, 'Acceso a todo el sistema', 'Puede: seleccionar, agregar, editar y eliminar un administrador, seleccionar, agregar, editar y eliminar uno o todos los pacientes, seleccionar, agregar, editar y eliminar uno todo el personal, seleccionar, agregar, editar o eliminar los videos'),
(2, 'Acceso lectura y escritura', 'Puede: agregar, eliminar o editar a los pacientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_x_rol`
--

CREATE TABLE `permisos_x_rol` (
  `pxr_id` int(10) UNSIGNED NOT NULL,
  `rol_id` int(10) UNSIGNED DEFAULT NULL,
  `permiso_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos_x_rol`
--

INSERT INTO `permisos_x_rol` (`pxr_id`, `rol_id`, `permiso_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `rol_id` int(10) UNSIGNED NOT NULL,
  `rol_nombre` varchar(50) NOT NULL,
  `rol_descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`rol_id`, `rol_nombre`, `rol_descripcion`) VALUES
(1, 'admin', 'Es el administrador del sistema'),
(2, 'personal', 'Es el encargado de atender al paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_x_usuario`
--

CREATE TABLE `roles_x_usuario` (
  `rxu_id` int(10) UNSIGNED NOT NULL,
  `usuario` int(10) UNSIGNED DEFAULT NULL,
  `rol` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles_x_usuario`
--

INSERT INTO `roles_x_usuario` (`rxu_id`, `usuario`, `rol`) VALUES
(1, 1, 1),
(9, 9, 1),
(40, 46, 2),
(41, 47, 2),
(48, 54, 2),
(72, 78, 2),
(84, 90, 2),
(85, 91, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `timesSession` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `username`, `nombre`, `apellido`, `password`, `correo`, `timesSession`) VALUES
(1, 'admin', 'Juan Pedro', 'Alvarez Carrasco', '', 'admin@gmail.com', 0),
(9, 'fdss', 'dsf', 'fsdf', 'fsdf', 'exam@gmail.com', NULL),
(46, '01020304', 'Lucas', 'Gimenez', 'lucas', 'exam2@gmail.com', NULL),
(47, '11111111', 'Carlos Juan', 'Gonzales Perez', 'carlos', 'exam3@gmail.com', NULL),
(54, '12345678', 'Juana', 'Juarez', 'juana', 'exam4@gmail.com', NULL),
(78, '00000000', 'Sixto', 'Martinez', '1234', 'exam5@gmail.com', NULL),
(90, '76140329', 'Jean Pierre André', 'Ayala Viera', 'RXJoalR5MnV1WnBrREpSTStBNXI1UT09', 'jeanpiav14@gmail.com', NULL),
(91, '22222222', 'Sonam', 'Personal', 'cWNyZUVBbHlJRWJmMEt6QVczUFdxZz09', 'jevpy14@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video`
--

CREATE TABLE `video` (
  `video_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `nombre_video` varchar(50) DEFAULT NULL,
  `descripcion_video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `video`
--

INSERT INTO `video` (`video_id`, `url`, `nombre_video`, `descripcion_video`) VALUES
(1, 'https://drive.google.com/file/d/1rank29rFmMOtuTYdwLk4NOSonmAGP-IS/preview', 'videos-1', 'Este es el video 1'),
(2, 'https://drive.google.com/file/d/1knVUAhTcxNVUs7kfo0fSHh4YVIqhCfpr/preview', 'video-2', 'Este es el video 22'),
(3, 'https://drive.google.com/file/d/12G31OW4H2cRu8yyYyKfROxN610TijwVj/view', 'video-3', 'Este es el video 3'),
(7, 'https://drive.google.com/file/d/1lPVR72Gp6e9XACYjzmohoh6pCtJ3VfWE/view', 'video 4', 'Este es el video 4'),
(12, 'https://drive.google.com/file/d/1hFf7cPsTb_BcS-_KPwxM6RM6EBIZKzu-/view', 'video 5', 'Este es el video  5');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camillas`
--
ALTER TABLE `camillas`
  ADD PRIMARY KEY (`camilla_id`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`grupo_id`);

--
-- Indices de la tabla `grupo_x_video`
--
ALTER TABLE `grupo_x_video`
  ADD PRIMARY KEY (`gxv_id`),
  ADD KEY `video_id` (`video`),
  ADD KEY `grupo_id` (`grupo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`permiso_id`);

--
-- Indices de la tabla `permisos_x_rol`
--
ALTER TABLE `permisos_x_rol`
  ADD PRIMARY KEY (`pxr_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `permiso_id` (`permiso_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `roles_x_usuario`
--
ALTER TABLE `roles_x_usuario`
  ADD PRIMARY KEY (`rxu_id`),
  ADD KEY `usuario_id` (`usuario`),
  ADD KEY `rol_id` (`rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `password` (`password`) USING BTREE;

--
-- Indices de la tabla `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD UNIQUE KEY `url` (`url`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `camillas`
--
ALTER TABLE `camillas`
  MODIFY `camilla_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `grupo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `grupo_x_video`
--
ALTER TABLE `grupo_x_video`
  MODIFY `gxv_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permiso_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permisos_x_rol`
--
ALTER TABLE `permisos_x_rol`
  MODIFY `pxr_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `rol_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles_x_usuario`
--
ALTER TABLE `roles_x_usuario`
  MODIFY `rxu_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT de la tabla `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `camillas`
--
ALTER TABLE `camillas`
  ADD CONSTRAINT `camillas_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`grupo_id`);

--
-- Filtros para la tabla `grupo_x_video`
--
ALTER TABLE `grupo_x_video`
  ADD CONSTRAINT `grupo_x_video_ibfk_1` FOREIGN KEY (`video`) REFERENCES `video` (`video_id`),
  ADD CONSTRAINT `grupo_x_video_ibfk_2` FOREIGN KEY (`grupo`) REFERENCES `grupo` (`grupo_id`);

--
-- Filtros para la tabla `permisos_x_rol`
--
ALTER TABLE `permisos_x_rol`
  ADD CONSTRAINT `permisos_x_rol_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`rol_id`),
  ADD CONSTRAINT `permisos_x_rol_ibfk_2` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`permiso_id`);

--
-- Filtros para la tabla `roles_x_usuario`
--
ALTER TABLE `roles_x_usuario`
  ADD CONSTRAINT `roles_x_usuario_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `roles_x_usuario_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `roles` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
