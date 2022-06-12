-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-02-2022 a las 07:50:21
-- Versión del servidor: 5.7.33
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendam2022`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Alimentos'),
(2, 'Electrodomésticos'),
(3, 'Moda'),
(7, 'FUTBOL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `usr` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombres`, `apellidos`, `cedula`, `usr`, `pwd`) VALUES
(1, 'Erick', 'Chinchin', '1755122866', 'erick', '2022'),
(2, 'Santiago', 'Chinchin', '1755122866', 'san', '123'),
(3, 'Alisson', 'Cajamarca', '17554255966', 'ali', '123'),
(4, 'Martin', 'Vaca', '1755128966', 'a', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `id` int(10) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `precioVenta` decimal(50,0) NOT NULL,
  `importe` decimal(50,0) NOT NULL,
  `idFactura` int(10) NOT NULL,
  `idProductos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`id`, `cantidad`, `precioVenta`, `importe`, `idFactura`, `idProductos`) VALUES
(1, 2, '15', '30', 1, 2),
(2, 2, '45', '90', 2, 11),
(3, 2, '45', '90', 2, 12),
(4, 1, '700', '700', 2, 8),
(5, 3, '700', '2100', 3, 8),
(6, 10, '1', '10', 3, 2),
(7, 1, '1', '1', 4, 2),
(8, 2, '1', '2', 5, 2),
(10, 1, '700', '700', 6, 8),
(11, 1, '1', '1', 6, 2),
(12, 1, '1', '1', 7, 2),
(13, 1, '1', '1', 9, 2),
(14, 1, '1', '1', 10, 2),
(15, 1, '700', '700', 11, 8),
(16, 2, '45', '90', 11, 11),
(17, 2, '45', '90', 11, 12),
(18, 15, '1', '15', 11, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(10) NOT NULL,
  `fecha` date NOT NULL,
  `subtotal` decimal(50,0) NOT NULL,
  `iva` decimal(50,0) NOT NULL,
  `apagar` decimal(50,0) NOT NULL,
  `idClientes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `fecha`, `subtotal`, `iva`, `apagar`, `idClientes`) VALUES
(1, '2022-02-01', '30', '0', '30', 1),
(2, '2022-02-20', '880', '106', '986', 2),
(3, '2022-02-21', '2110', '253', '2363', 3),
(4, '2022-02-21', '1', '0', '1', 2),
(5, '2022-02-21', '2', '0', '2', 3),
(6, '2022-02-21', '701', '84', '785', 2),
(7, '2022-02-21', '1', '0', '1', 2),
(8, '2022-02-21', '0', '0', '0', 2),
(9, '2022-02-21', '1', '0', '1', 2),
(10, '2022-02-21', '1', '0', '1', 2),
(11, '2022-02-21', '895', '107', '1002', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `detalle` varchar(50) NOT NULL,
  `precio` decimal(25,0) NOT NULL,
  `stock` int(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `idCategoria` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `detalle`, `precio`, `stock`, `foto`, `idCategoria`) VALUES
(2, 'Oreo', 'Galleta ', '1', 20, 'oreo.png', 1),
(8, 'TV', 'Plasma ', '700', 2, 'tv.png', 2),
(10, 'Camisa', 'Manga larga', '3', 3, 'camisa.png', 3),
(11, 'Camiseta', 'Club FC Barcelona ', '45', 10, 'BarcelonaFC.png', 7),
(12, 'Camiseta', 'PSG', '45', 5, 'psg.png', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `usr` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `usr`, `pass`) VALUES
(2, 'Santiago', 'admin', 'a', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Productos_DetalleFac` (`idProductos`),
  ADD KEY `Factura_DetalleFac` (`idFactura`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Clientes_Factura` (`idClientes`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Categoria_productos` (`idCategoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `Factura_DetalleFac` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Productos_DetalleFac` FOREIGN KEY (`idProductos`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `Clientes_Factura` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `Categoria_productos` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
