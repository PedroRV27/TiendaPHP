-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2025 a las 02:09:00
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
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Camisas'),
(2, 'Pantalones'),
(3, 'Sudaderas'),
(4, 'zapatillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

CREATE TABLE `lineas_pedidos` (
  `id` int(255) NOT NULL,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`) VALUES
(1, 1, 4, 1),
(2, 2, 7, 1),
(3, 3, 4, 1),
(4, 3, 7, 1),
(5, 4, 11, 1),
(6, 5, 13, 1),
(7, 6, 4, 1),
(8, 7, 4, 1),
(9, 8, 12, 1),
(10, 9, 12, 1),
(11, 10, 11, 1),
(12, 11, 11, 1),
(13, 12, 1, 1),
(14, 13, 1, 1),
(15, 14, 12, 1),
(16, 15, 13, 1),
(17, 16, 4, 1),
(18, 17, 3, 1),
(19, 18, 11, 1),
(20, 19, 4, 1),
(21, 20, 12, 1),
(22, 21, 11, 1),
(23, 22, 1, 1),
(24, 23, 12, 2),
(25, 24, 15, 1),
(26, 25, 15, 1),
(27, 26, 4, 1),
(28, 27, 4, 1),
(29, 28, 4, 1),
(30, 29, 7, 1),
(31, 30, 4, 1),
(32, 31, 4, 1),
(33, 32, 8, 1),
(34, 33, 8, 11),
(60, 57, 4, 1),
(61, 58, 15, 1),
(62, 59, 8, 1),
(63, 60, 3, 1),
(64, 61, 8, 1),
(65, 62, 15, 1),
(66, 63, 15, 1),
(67, 64, 15, 1),
(68, 65, 7, 1),
(69, 66, 7, 1),
(70, 67, 8, 1),
(71, 68, 7, 1),
(72, 69, 4, 1),
(73, 70, 4, 1),
(74, 71, 7, 1),
(75, 72, 8, 1),
(76, 73, 7, 1),
(77, 74, 7, 1),
(78, 75, 8, 1),
(79, 76, 15, 1),
(80, 77, 15, 1),
(81, 78, 11, 1),
(82, 79, 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `coste` float(200,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `provincia`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`) VALUES
(1, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-07', '18:00:44'),
(2, 1, 'Granada', 'guadix', 'Pasaje velazquez 1', 100.00, 'confirmed', '2023-06-07', '18:01:02'),
(3, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1100.00, 'confirmed', '2023-06-10', '18:28:44'),
(4, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '17:22:34'),
(5, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 75.00, 'confirmed', '2023-06-11', '17:44:12'),
(6, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '17:46:06'),
(7, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '17:46:28'),
(8, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 400.00, 'confirmed', '2023-06-11', '17:47:29'),
(9, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 400.00, 'confirmed', '2023-06-11', '18:06:38'),
(10, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '18:22:40'),
(11, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '18:24:54'),
(12, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 100.00, 'confirmed', '2023-06-11', '18:30:29'),
(13, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 100.00, 'confirmed', '2023-06-11', '18:30:56'),
(14, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 400.00, 'confirmed', '2023-06-11', '18:31:08'),
(15, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 75.00, 'confirmed', '2023-06-11', '18:31:24'),
(16, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '18:39:09'),
(17, 3, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 50.00, 'confirmed', '2023-06-11', '18:40:31'),
(18, 3, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '18:49:57'),
(19, 3, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '18:50:16'),
(20, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 400.00, 'confirmed', '2023-06-11', '18:56:17'),
(21, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-11', '18:59:13'),
(22, 2, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 100.00, 'confirmed', '2023-06-11', '19:34:02'),
(23, 4, 'Granada', 'Guadix', 'Pedro De Mendoza 17 ', 800.00, 'confirmed', '2023-06-12', '10:27:45'),
(24, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 12.00, 'confirmed', '2023-06-12', '20:09:01'),
(25, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 12.00, 'confirmed', '2023-06-14', '13:20:45'),
(26, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-14', '13:22:06'),
(27, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-14', '13:23:01'),
(28, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-14', '13:26:47'),
(29, 1, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 100.00, 'confirmed', '2023-06-14', '13:31:22'),
(30, 9, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-14', '13:38:12'),
(31, 10, 'Granada', 'Guadix', 'Pedro De Mendoza 17 1A', 1000.00, 'confirmed', '2023-06-14', '13:39:47'),
(32, 12, 'andalucia', 'gaudi', 'calle n1', 70.00, 'confirmed', '2024-06-06', '03:43:59'),
(33, 12, 'andalucia', 'gaudi', 'calle n1', 770.00, 'confirmed', '2024-06-06', '03:44:28'),
(57, 28, 'Granada', 'guadix', 'calle n1', 1000.00, 'confirmed', '2025-02-25', '18:56:29'),
(58, 28, 'Granada', 'guadix', 'calle n1', 12.00, 'confirmed', '2025-02-25', '18:57:07'),
(59, 28, 'Granada', 'guadix', 'calle n1', 70.00, 'confirmed', '2025-02-25', '19:11:46'),
(60, 28, 'Granada', 'guadix', 'calle n1', 50.00, 'confirmed', '2025-02-25', '19:18:19'),
(61, 28, 'Granada', 'guadix', 'calle n1', 70.00, 'confirmed', '2025-02-25', '19:21:15'),
(62, 28, 'Granada', 'guadix', 'calle n1', 12.00, 'confirmed', '2025-02-25', '19:52:48'),
(63, 29, 'andalucia', 'guadix', 'calle n1', 12.00, 'confirmed', '2025-02-25', '19:54:48'),
(64, 29, 'Granada', 'guadix', 'calle n1', 12.00, 'confirmed', '2025-02-25', '19:55:25'),
(65, 29, 'Granada', 'guadix', 'calle n1', 100.00, 'confirmed', '2025-02-25', '20:00:21'),
(66, 29, 'Granada', 'guadix', 'calle n1', 100.00, 'confirmed', '2025-02-25', '21:43:39'),
(67, 28, 'Granada', 'guadix', 'calle n1', 70.00, 'confirmed', '2025-02-25', '21:44:36'),
(68, 30, 'andalucia', 'guadix', 'calle n1', 100.00, 'confirmed', '2025-02-25', '21:51:19'),
(69, 28, 'andalucia', 'guadix', 'calle n1', 1000.00, 'confirmed', '2025-02-25', '22:05:46'),
(70, 28, 'andalucia', 'guadix', 'calle n1', 1000.00, 'confirmed', '2025-02-25', '23:53:38'),
(71, 28, 'Granada', 'guadix', 'calle n1', 100.00, 'confirmed', '2025-02-25', '23:57:18'),
(72, 28, 'Granada', 'guadix', 'calle n1', 70.00, 'confirmed', '2025-02-25', '23:57:41'),
(73, 28, 'andalucia', 'guadix', 'calle n1', 100.00, 'confirmed', '2025-02-26', '00:00:20'),
(74, 30, 'Granada', 'guadix', 'calle n1', 100.00, 'confirmed', '2025-02-26', '00:08:25'),
(75, 28, 'Granada', 'guadix', 'calle n1', 70.00, 'confirmed', '2025-02-26', '00:09:59'),
(76, 30, 'Granada', 'guadix', 'calle n1', 12.00, 'confirmed', '2025-02-26', '00:16:29'),
(77, 28, 'Granada', 'guadix', 'calle n1', 12.00, 'confirmed', '2025-02-26', '22:04:43'),
(78, 28, 'Granada', 'guadix', 'Bdo Fdo', 1000.00, 'confirmed', '2025-03-01', '01:57:00'),
(79, 30, 'Granada', 'guadix', 'Bdo Fdo', 1000.00, 'confirmed', '2025-03-01', '01:58:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(255) NOT NULL,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(1, 2, 'Pantalones Carhartt', NULL, 100.00, 9, 'no', '2023-06-23', 'carhartt.jpg'),
(2, 2, 'Pantalones Dickies', NULL, 100.00, 4, 'no', '2023-06-20', 'dickies.jpg'),
(3, 2, 'Pantalones Tommy', NULL, 50.00, 8, 'si', '2023-06-24', 'tommy.jpg'),
(4, 1, 'Camisa Gucci', NULL, 1000.00, 5, 'si', '2023-06-20', 'gucci.jpg'),
(7, 1, 'Camisa Ralph Lauren', NULL, 100.00, 4, 'si', '2023-06-15', 'ralf.jpg'),
(8, 1, 'Camisa Scalpers', '', 70.00, 5, 'si', '2023-06-09', 'scalper.jpg'),
(11, 3, 'Sudadera Off White', 'Sudadera off-white', 1000.00, 98, 'no', '2023-06-23', 'offwhite.jpg'),
(12, 3, 'Sudadera Supreme', NULL, 400.00, 0, 'si', '2023-06-21', 'sudaderasupreme.jpg'),
(13, 3, 'Sudadera North Face', NULL, 75.00, 17, 'si', '2023-06-24', 'north.jpg'),
(15, 4, 'chanclas', 'Chanclas de marca', 12.00, 10, NULL, '2023-06-12', 'chanclas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`) VALUES
(1, '', '', '', '$2y$04$2CtAOEP1uNohrKHFlSyMDOzPPUK4ixt345KinA8RTDMus6JKEhqbS', 'user'),
(2, 'prueba', 'prueba', 'asd', '$2y$04$m0oUHqFujTLWXrg779ZsGOHJaCd/zzYPQfHTqSBrWJpz4rjQm/axi', 'user'),
(3, 'asd', 'asd', 'asd@gmail.com', '$2y$04$yvBm7u/HpGUz4W/XrSy6y..mzgzi8AEP9YINhMJa.GLAqyrpDINb6', 'user'),
(4, 'prueba1', 'prueba1', 'prueba1@gmail.com', '$2y$04$3y4QJ2MjNtzSGFewBe7oCO.4QgbyAxI2jyyGcKputZ5zmePOZDs5O', 'user'),
(9, 'prueb12312', 'prueb12312', 'prueb12312@gmail.com', '$2y$04$N/X/lhN1hJJS4JbLk4.5OO0tpHvxB7QG7LsZ9lQXt88R9e/mzX5gO', 'user'),
(10, 'Pruebafd', 'Pruebafd', 'Pruebafd@gmail.com', '$2y$04$IBZP24j7sccdtnZ3N8lqf.eOA6UhMHey2AQgOxfZpFGyMxYyO7h1G', 'user'),
(12, 'Juan', 'pelaes', 'pedro@gmail.com', '$2y$04$wfNi.p38PDoZ4WRSK/izFuC2OMwZPp8eGvtcp2QSjCO5/cShCHzMO', 'user'),
(15, 'Juan', 'pelaes', 'pacopelaes@gmail.com', '$2y$04$jaw5Im5IzmTrA112dN12xeeHz0R2e7I6ZR2m/.n.rJrjO9FUlpAqW', 'user'),
(28, 'Juan', 'pelas', 'pedrorovi27@gmail.com', '$2y$04$dRQaiNrs47XmMkW7.neMbO5i3z8hHO3BGbGQHW3Yp8WGh7GBjwl22', 'admin'),
(29, 'pedro', 'pelaes', 'pedro27rovi@gmail.com', '$2y$04$AKMPjHMGS6JrETFjXPuySeBJfzlbU6ZuvPMuR.SM1/qGnbvrHh5eC', 'user'),
(30, 'pedro', 'rodriguez', 'rosaypedro_vi@outlook.com', '$2y$04$N6qcE7909MsN4oRWtuQvG.umG1dPJm7JmyTj8f/AGGsct.2LwMKZ2', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_pedido` (`pedido_id`),
  ADD KEY `fk_linea_producto` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_usuario` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
