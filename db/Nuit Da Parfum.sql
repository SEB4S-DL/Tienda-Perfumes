-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-04-2025 a las 09:20:48
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
-- Base de datos: `tienda_sena`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Unisex'),
(2, 'Hombre'),
(3, 'Mujer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedido`
--

CREATE TABLE `lineas_pedido` (
  `id` int(255) NOT NULL,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_pedido`
--

INSERT INTO `lineas_pedido` (`id`, `pedido_id`, `producto_id`, `unidades`, `precio`) VALUES
(1, 2, 1, 2, 450000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

CREATE TABLE `lineas_pedidos` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `pedido_id`, `producto_id`, `unidades`, `precio`) VALUES
(1, 4, 1, 6, 450000.00),
(2, 5, 1, 6, 450000.00),
(3, 6, 1, 20, 450000.00),
(4, 7, 1, 5, 450000.00),
(5, 8, 1, 10, 450000.00),
(6, 9, 1, 1, 450000.00),
(7, 10, 2, 1, 90000.00),
(8, 11, 5, 1, 600000.00),
(9, 11, 4, 5, 1200000.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `usuario_id`, `provincia`, `localidad`, `direccion`, `coste`, `estado`, `fecha`, `hora`) VALUES
(1, 2, 'caldas', 'chinchina', 'vrda el lembo', 900000.00, 'entregado', '2025-04-20', '19:50:52'),
(2, 2, 'caldas', 'chinchina', 'vrda el lembo', 900000.00, 'entregado', '2025-04-20', '19:55:43'),
(3, 2, 'RISARALDA', 'SANTAROSADECABAL', 'LA HERMOSA', 2700000.00, 'entregado', '2025-04-20', '20:00:03'),
(4, 2, 'RISARALDA', 'SANTAROSADECABAL', 'LA HERMOSA', 2700000.00, 'entregado', '2025-04-20', '20:02:09'),
(5, 2, 'RISARALDA', 'SANTAROSADECABAL', 'vrda el lembo', 2700000.00, 'entregado', '2025-04-20', '20:03:09'),
(6, 2, 'ANTIOQUIA', 'MEDELLIN', 'EL POBLADO', 9000000.00, 'entregado', '2025-04-20', '20:55:18'),
(7, 3, 'ANTIOQUIA', 'chinchina', 'LA HERMOSA', 2250000.00, 'entregado', '2025-04-20', '21:34:55'),
(8, 2, 'CHOCO', 'BELEN', 'EL POBLADO', 4500000.00, 'entregado', '2025-04-20', '21:58:17'),
(9, 2, 'CHOCO2', 'chinchina', 'LA HERMOSA', 450000.00, 'entregado', '2025-04-20', '22:36:50'),
(10, 2, 'caldas', 'SANTAROSADECABAL', 'EL POBLADO', 90000.00, 'entregado', '2025-04-20', '23:18:20'),
(11, 2, 'CALDAS', 'Manizales', 'cra 5 #12-34', 6600000.00, 'entregado', '2025-04-21', '01:16:15');

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
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `precio_oferta` decimal(10,2) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `fecha`, `imagen`, `precio_oferta`, `activo`) VALUES
(1, 3, 'Chanell', 'perfume femenino sexy', 450000.00, 500, '2025-04-21', '../uploads/sports-car-mountains-retrowave-synthwave-4k-wallpaper-uhdpaper.com-233@0@k.jpg', NULL, 0),
(2, 2, 'LAP', 'Perfume masculino para atraer embritas', 90000.00, 100, '2025-04-21', '../uploads/Captura.PNG', NULL, 0),
(3, 2, 'SwissArmy', 'Perfume Masculino', 250000.00, 20, '2025-04-21', 'img_6805cab5f2b2f5.96196111.jpg', NULL, 0),
(4, 2, 'Antonio Banderas', 'King of Seduction es una elegante afirmación de la masculinidad. Las líneas de corte sencillas y gruesas del cristal destilan calidad y fuerza. El tapón cuadrangular corona el frasco con un toque final de sofisticación. El seductor aroma de las especias destaca en el fondo con un suave acorde de cuero, bañado en refinadas notas amaderadas de vetiver y musgo. La delicada selección de los aromas realza la potencia y personalidad del perfume. El símbolo de un ganador con un poder de seducción absoluto.', 1200000.00, 10, '2025-04-21', 'img_6805da3dc56f02.29088444.jpg', NULL, 1),
(5, 3, 'CH INSIGNIA LIMITED', 'CH Insignia Limited Edition Eau de Parfum de Carolina Herrera es una fragancia exclusiva y elegante que rinde homenaje a la artesanía y el lujo.', 600000.00, 50, '2025-04-21', 'img_6805e231ab20f0.59385031.jpg', NULL, 1),
(6, 1, 'HUMOR TRANSFORMA', 'Combina perfectamente la alegría de las notas frutales y las especies, la fluidez de las notas acuosas y el cuerpo de las notas amaderadas.  Esta es una fragancia diversa y electrizante,que se transforma durante su uso.', 200000.00, 50, '2025-04-21', 'img_6805e61ee72582.91241705.jpg', NULL, 1);

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
  `rol` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `imagen`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', NULL),
(2, 'sebas', 'duque', 'duquelopezsebastian796@gmail.com', '$2y$10$cS4ZAxjPd0oEihVRYg8n0uPlqzb2fNmHNQCqgOL/ruHHflFD0JYxS', 'admin', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0\0\0\0\0\0\0?\0\0?caBX\0\0?jumb\0\0\0jumdc2pa\0\0?\0\0?\08?qc2pa\0\0\07jumb\0\0\0Hjumdc2ma\0\0?\0\0?\08?qurn:c2pa::540d006e-8a53-462f-a010-75bb0dac3390\0\0\0?jumb\0\0\0)jumdc2as\0\0?\0\0?\08?qc2pa.assertions\0\0\0jumb\0\0\0)jumdcbor\0\0?\0\0?\08?qc2pa.actions.v'),
(3, 'usuario', 'duque', 'prueba1@gmail.com', '$2y$10$n8EUZvyeiBthwApS9OoToeX5aRHH9VLM8NjtQN0h2ocHwOvfXzXFy', 'user', NULL),
(4, 'Usuario2', 'Lopez', 'prueba2@gmail.com', '$2y$10$bd1OAw46klg2mVQ1HeYID.AcHMRhYATVGfylX4yWdnc4B8bOGm9Eq', 'user', NULL),
(5, 'Usuario3', 'tres', 'prueba3@gmail.com', '$2y$10$dv44K0f/2GmZzt97m0ey7elWH.oTH5paFMgJUR7PhyK.Z.vCd4mwW', 'user', '6805ecb1c345a_fantasy-style-galaxy-background.jpg'),
(7, 'admin', 'admin', 'admin@admin1.com', '$2y$10$u39uZ4eJKOwThDDljf8GP.c1UQV8tH7Sn0ynMJP7xSyteAcOXUBm.', 'admin', '6805f11e78d41_boss-administrator-head-avatar-profile-icon-with-tie-symbol-illustration-vector.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineas_pedido`
--
ALTER TABLE `lineas_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_pedido` (`pedido_id`),
  ADD KEY `fk_linea_producto` (`producto_id`);

--
-- Indices de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `lineas_pedido`
--
ALTER TABLE `lineas_pedido`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedido`
--
ALTER TABLE `lineas_pedido`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `lineas_pedidos_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lineas_pedidos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

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
