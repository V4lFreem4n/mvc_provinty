-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 23:11:32
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
-- Base de datos: `provintybd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_evento`
--

CREATE TABLE `categoria_evento` (
  `id` int(11) NOT NULL,
  `nombre_categoria_evento` varchar(100) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_preventa` decimal(10,2) NOT NULL,
  `ID_Evento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_evento`
--

INSERT INTO `categoria_evento` (`id`, `nombre_categoria_evento`, `precio_venta`, `precio_preventa`, `ID_Evento`) VALUES
(14, 'SUPER VIP', 11.00, 111.00, 23),
(15, 'VIP', 22.00, 222.00, 23),
(16, 'PALCO VIP', 33.00, 333.00, 23),
(17, 'SUPER VIP', 112.00, 223.00, 24),
(18, 'VIP', 133.00, 333.00, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `documento_identidad` int(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `apellido`, `documento_identidad`, `fecha_nacimiento`, `correo`, `contrasena`) VALUES
(1, 'Alejandro', 'Pérez', 72423362, '2002-08-13', 'alejandro@alejandro', 'victor12345**');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID_Compra` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Fecha_Compra` datetime DEFAULT current_timestamp(),
  `Total_Sin_IGV` decimal(10,2) DEFAULT NULL,
  `Total_IGV` decimal(10,2) DEFAULT NULL,
  `Metodo_Pago` enum('Tarjeta','Transferencia','Efectivo') DEFAULT NULL,
  `Estado_Compra` enum('Pendiente','Completada','Cancelada') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `ID_Detalle` int(11) NOT NULL,
  `ID_Compra` int(11) DEFAULT NULL,
  `ID_Ticket` int(11) DEFAULT NULL,
  `Precio_Unitario` decimal(10,2) DEFAULT NULL,
  `Cantidad` int(11) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_eventos`
--

CREATE TABLE `estadisticas_eventos` (
  `ID_Estadistica` int(11) NOT NULL,
  `ID_Evento` int(11) DEFAULT NULL,
  `Datos_Estadisticos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Datos_Estadisticos`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `ID_Evento` int(11) NOT NULL,
  `Titulo` varchar(100) NOT NULL,
  `Aforo` int(11) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
  `terminos_condiciones` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `Artista_Autor` varchar(100) DEFAULT NULL,
  `Fecha_Evento` datetime DEFAULT NULL,
  `Fecha_Creacion` datetime DEFAULT current_timestamp(),
  `Estado_Publicacion` enum('Publicado','Borrador','Cancelado') DEFAULT 'Borrador',
  `visibilidad` varchar(255) DEFAULT NULL,
  `organizador` varchar(255) DEFAULT NULL,
  `contacto_organizador` varchar(255) DEFAULT NULL,
  `politica_cancelacion` text DEFAULT NULL,
  `f_actualizacion` date DEFAULT NULL,
  `f_borrado` date DEFAULT NULL,
  `hora_borrado` time DEFAULT NULL,
  `ubicacion` varchar(100) DEFAULT NULL,
  `activoPospuesto` varchar(20) DEFAULT NULL,
  `horaInicioEvento` time DEFAULT NULL,
  `horaFinEvento` time DEFAULT NULL,
  `redes` varchar(150) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`ID_Evento`, `Titulo`, `Aforo`, `Foto`, `Descripcion`, `terminos_condiciones`, `Artista_Autor`, `Fecha_Evento`, `Fecha_Creacion`, `Estado_Publicacion`, `visibilidad`, `organizador`, `contacto_organizador`, `politica_cancelacion`, `f_actualizacion`, `f_borrado`, `hora_borrado`, `ubicacion`, `activoPospuesto`, `horaInicioEvento`, `horaFinEvento`, `redes`, `id_usuario`) VALUES
(23, 'Purizaca Pérez', 4444, 'WhatsApp Image 2024-10-14 at 1.02.52 PM.jpeg', 'ffffff', '[\"xxxxxxxxxxx\",\"yyyyy yyyyyyy\"]', '', '2024-11-01 00:00:00', '2024-11-18 00:00:00', 'Publicado', 'Privado', 'sadasd', 'asdasd', NULL, NULL, NULL, NULL, 'Moscú2', NULL, '18:16:00', '19:16:00', '4444', 51),
(24, 'evento victor', 444, 'WhatsApp Image 2024-09-30 at 10.53.10 AM.jpeg', 'descripcion del evento', '[\"No perros\",\"No alcohol\"]', '', '2024-11-01 00:00:00', '2024-11-18 00:00:00', 'Publicado', 'Privado', 'UEFA', '444444', NULL, NULL, NULL, NULL, 'sdfsdfsdf', NULL, '20:53:00', '21:53:00', 'redes 1', 54);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interacciones`
--

CREATE TABLE `interacciones` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `valoracion` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_acciones`
--

CREATE TABLE `log_acciones` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `accion` enum('activado','desactivado') NOT NULL,
  `fecha_accion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `ID_Permiso` int(11) NOT NULL,
  `Funcion_Permiso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`ID_Permiso`, `Funcion_Permiso`) VALUES
(1, 'CREAR EVENTO'),
(2, 'EDITAR EVENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID_Rol` int(11) NOT NULL,
  `Nombre_Rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_Rol`, `Nombre_Rol`) VALUES
(1, 'Administrador'),
(2, 'Promotor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_permisos`
--

CREATE TABLE `roles_permisos` (
  `ID_Rol` int(11) NOT NULL,
  `ID_Permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `ID_Ticket` int(11) NOT NULL,
  `ID_Evento` int(11) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Fecha_Compra` datetime DEFAULT current_timestamp(),
  `Tipo_Entrada` enum('General','VIP','Estudiante') DEFAULT NULL,
  `Codigo_Ticket` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `numero_telefono` char(9) NOT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `password`, `rol`, `dni`, `correo`, `numero_telefono`, `foto_url`, `activo`, `fecha_creacion`) VALUES
(51, 'victor', '$2y$10$nF9ysh86oBb1DzIzKvVydOzzodokSE6xOMkvnPL0KfHlqW3w0Zok6', 1, '12333333', 'correo@correo', '931231231', NULL, 1, '2024-11-11 21:43:53'),
(52, 'Alejandro', '$2y$10$YJGA9FE1woffZvO5KqNjfe14Rtg93y4oB17vdwbmjuGaXlB.OfUwy', 2, '23333333', 'victor@victor', '999999966', NULL, 1, '2024-11-11 21:45:07'),
(53, 'admin', '$2y$10$UoudodYYrt0X9ohkn4gEFO7c1i/XyJOTiQxWaHPhOTUGouzBa12My', 0, '72423362', 'admin@admin', '789456123', 'admin.png', 1, '2024-11-18 21:24:58'),
(54, 'Alonso', '$2y$10$omgsR1dMlqN8xIHtcXDSI.YlZ3kLPULOmnIbqnW0pGodpDXRWeOEe', 2, '13333335', 'alonso@alonso', '983654321', NULL, 1, '2024-11-18 21:47:48'),
(55, 'Yamill', '$2y$10$e43MeLNSoxvUgKoHczOInuraxHEFN/5vIT9otD15k79JmhXQ6WJK.', 1, '12423123', 'yamill@yamill', '941111111', NULL, 1, '2024-11-18 21:49:06');

--
-- Disparadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `trigger_activacion_usuario` AFTER UPDATE ON `usuarios` FOR EACH ROW BEGIN
    IF NEW.activo != OLD.activo THEN
        INSERT INTO log_acciones (usuario_id, accion)
        VALUES (NEW.id, IF(NEW.activo, 'activado', 'desactivado'));
    END IF;
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Evento` (`ID_Evento`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID_Compra`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`ID_Detalle`),
  ADD KEY `ID_Compra` (`ID_Compra`),
  ADD KEY `ID_Ticket` (`ID_Ticket`);

--
-- Indices de la tabla `estadisticas_eventos`
--
ALTER TABLE `estadisticas_eventos`
  ADD PRIMARY KEY (`ID_Estadistica`),
  ADD KEY `ID_Evento` (`ID_Evento`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID_Evento`),
  ADD KEY `id` (`id_usuario`);

--
-- Indices de la tabla `interacciones`
--
ALTER TABLE `interacciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indices de la tabla `log_acciones`
--
ALTER TABLE `log_acciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`ID_Permiso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD PRIMARY KEY (`ID_Rol`,`ID_Permiso`),
  ADD KEY `ID_Permiso` (`ID_Permiso`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID_Ticket`),
  ADD KEY `ID_Evento` (`ID_Evento`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD UNIQUE KEY `numero_telefono` (`numero_telefono`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `ID_Compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `ID_Detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_eventos`
--
ALTER TABLE `estadisticas_eventos`
  MODIFY `ID_Estadistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `ID_Evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `log_acciones`
--
ALTER TABLE `log_acciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `ID_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID_Ticket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categoria_evento`
--
ALTER TABLE `categoria_evento`
  ADD CONSTRAINT `llaveForarena1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventos` (`ID_Evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `detallecompra_ibfk_1` FOREIGN KEY (`ID_Compra`) REFERENCES `compras` (`ID_Compra`),
  ADD CONSTRAINT `detallecompra_ibfk_2` FOREIGN KEY (`ID_Ticket`) REFERENCES `tickets` (`ID_Ticket`);

--
-- Filtros para la tabla `estadisticas_eventos`
--
ALTER TABLE `estadisticas_eventos`
  ADD CONSTRAINT `estadisticas_eventos_ibfk_1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventos` (`ID_Evento`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `relacion_usuario_evento` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `interacciones`
--
ALTER TABLE `interacciones`
  ADD CONSTRAINT `relacion_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `relacion_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`ID_Evento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `log_acciones`
--
ALTER TABLE `log_acciones`
  ADD CONSTRAINT `log_acciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `roles` (`ID_Rol`),
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`ID_Permiso`) REFERENCES `permisos` (`ID_Permiso`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventos` (`ID_Evento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
