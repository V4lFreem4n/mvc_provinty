-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2024 a las 22:59:03
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
  `Precio_Entrada` decimal(10,2) DEFAULT NULL,
  `Precio_Preventa` decimal(10,2) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `Descripcion` text DEFAULT NULL,
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
  `hora_borrado` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`ID_Evento`, `Titulo`, `Aforo`, `Precio_Entrada`, `Precio_Preventa`, `Foto`, `Descripcion`, `Artista_Autor`, `Fecha_Evento`, `Fecha_Creacion`, `Estado_Publicacion`, `visibilidad`, `organizador`, `contacto_organizador`, `politica_cancelacion`, `f_actualizacion`, `f_borrado`, `hora_borrado`) VALUES
(6, 'Casa', 123, 10.00, 100.00, 'imagen', 'descreipcion', 'Beneficiosa', '2024-10-10 00:00:00', '2024-10-10 00:00:00', 'Publicado', 'Público', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'caassa', 444, 10.00, 100.00, 'imagen', 'descripcion', 'grupo 5', '2024-10-04 00:00:00', '2024-10-04 00:00:00', 'Cancelado', 'Público', NULL, NULL, NULL, NULL, '2024-10-16', '22:56:10'),
(8, 'casitaaaa', 44, 10.00, 100.00, 'imagen', 'TTTTT', 'GFGF', '2024-10-03 00:00:00', '2024-10-03 00:00:00', 'Publicado', 'Público', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `ID_Usuario` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellido` varchar(50) NOT NULL,
  `Rol` int(11) DEFAULT NULL,
  `Contraseña` varchar(255) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `Fecha_Creacion_Cuenta` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre`, `Apellido`, `Rol`, `Contraseña`, `DNI`, `Fecha_Creacion_Cuenta`) VALUES
(1, 'Víctor', 'Purizaca', 1, 'victor123victor123**', '72423362', '2024-10-16 11:12:12'),
(2, 'Alejandro', 'Alejandro', 1, '$2y$10$o3l8WHmeUNAGccV4jmpwJuxkPBW0zvIPZML1G0DFqU7eDqZBuh9T.', '32413123', '0000-00-00 00:00:00'),
(3, 'sadasd', 'sadasd', 1, '$2y$10$WABBTd5SAssuyAy/trPLHOlKN5XkCiRTY9QSGifihOXLKhtFWzlSm', '32413123', '0000-00-00 00:00:00'),
(4, 'Víctor Alejandro', 'Víctor Alejandro', 1, '$2y$10$5H6mKVOWrWaLNmDyV2UFXu4WzruxSiPUIIZvfdMJyBUquMiIypFha', '72424233', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

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
  ADD PRIMARY KEY (`ID_Evento`);

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
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD KEY `Rol` (`Rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
  MODIFY `ID_Evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`);

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
-- Filtros para la tabla `roles_permisos`
--
ALTER TABLE `roles_permisos`
  ADD CONSTRAINT `roles_permisos_ibfk_1` FOREIGN KEY (`ID_Rol`) REFERENCES `roles` (`ID_Rol`),
  ADD CONSTRAINT `roles_permisos_ibfk_2` FOREIGN KEY (`ID_Permiso`) REFERENCES `permisos` (`ID_Permiso`);

--
-- Filtros para la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`ID_Evento`) REFERENCES `eventos` (`ID_Evento`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`Rol`) REFERENCES `roles` (`ID_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
