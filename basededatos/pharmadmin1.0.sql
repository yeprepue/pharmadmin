-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2020 a las 23:10:27
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pharmadmin`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultarProductos` ()  begin

  SELECT * from productos;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'Categoría 1', 'Categoría de prueba 1.', 1, NULL, NULL),
(2, 'Categoría 2', 'Categoría de prueba 2.', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `cliente`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'Cliente 1', 1, '2020-04-28 19:47:23', '2020-04-28 19:47:23'),
(2, 'Cliente 2', 1, '2020-04-28 19:47:23', '2020-04-28 19:47:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datoscontacto`
--

CREATE TABLE `datoscontacto` (
  `id` int(11) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp(),
  `personas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `datoscontacto`
--

INSERT INTO `datoscontacto` (`id`, `direccion`, `correo`, `telefono`, `estado`, `fechacreacion`, `fechaactualizacion`, `personas_id`) VALUES
(1, 'Calle 57b sur #65-23', 'jscardona42@gmail.com', '3222463081', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(2, 'Cra 89 sur #54-85', 'yaky0723@gmail.com', '3102458156', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(3, 'Dirección 1', 'jscardona42@gmail.com', '3222463081', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Dirección 1', 'jscardona42@gmail.com', '3222463081', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'Dirección 1', 'yaky0723@gmail.com', '3102458156', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2),
(6, 'calle 54 sur # 45-16', 'juan@gmail.com', '3222463069', NULL, '2020-04-29 00:55:57', '2020-04-29 00:55:57', 3),
(10, 'calle 54 sur # 45-16', 'juancalores@gmail.com', '3222463081', NULL, '2020-05-04 20:29:35', '2020-05-04 20:29:35', 7),
(12, 'calle falsa 123', 'marco@gmail.com', '1234567', NULL, '2020-05-13 14:35:43', '2020-05-13 14:35:43', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefacturas`
--

CREATE TABLE `detallefacturas` (
  `id` int(11) NOT NULL,
  `facturas_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `precioventa` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `montopago` double NOT NULL,
  `detalleproductos_id` int(11) NOT NULL,
  `personas_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detallefacturas`
--

INSERT INTO `detallefacturas` (`id`, `facturas_id`, `fecha`, `precioventa`, `cantidad`, `montopago`, `detalleproductos_id`, `personas_id`, `estado`) VALUES
(1, 6, '2020-05-11 22:17:59', 2500, 1, 0, 1, 1, 1),
(2, 6, '2020-05-11 22:17:59', 10000, 1, 0, 3, 1, 1),
(3, 6, '2020-05-11 22:17:59', 2800, 1, 0, 2, 1, 1),
(4, 7, '2020-05-11 22:23:01', 2500, 2, 40000, 1, 1, 1),
(5, 7, '2020-05-11 22:23:01', 10000, 2, 40000, 3, 1, 1),
(6, 8, '2020-05-11 22:29:56', 2500, 4, 50000, 1, 1, 1),
(7, 8, '2020-05-11 22:29:56', 10000, 4, 50000, 3, 1, 1),
(8, 9, '2020-05-11 22:35:37', 2500, 1, 50000, 1, 1, 1),
(9, 9, '2020-05-11 22:35:37', 10000, 1, 50000, 3, 1, 1),
(10, 10, '2020-05-11 22:36:44', 2500, 11, 200000, 1, 1, 1),
(11, 10, '2020-05-11 22:36:44', 10000, 11, 200000, 3, 1, 1),
(12, 11, '2020-05-11 22:39:55', 2500, 1, 20000, 1, 1, 1),
(13, 12, '2020-05-12 18:07:18', 2500, 1, 50000, 1, 1, 1),
(14, 13, '2020-05-12 19:41:25', 2500, 5, 120000, 1, 1, 1),
(15, 13, '2020-05-12 19:41:25', 10000, 3, 120000, 3, 1, 1),
(16, 13, '2020-05-12 19:41:25', 2800, 10, 120000, 2, 1, 1),
(17, 13, '2020-05-12 19:41:25', 2500, 2, 120000, 1, 1, 1),
(18, 13, '2020-05-12 19:41:25', 2500, 1, 120000, 1, 1, 1),
(19, 13, '2020-05-12 19:41:25', 2800, 1, 120000, 2, 1, 1),
(20, 13, '2020-05-12 19:41:25', 2800, 1, 120000, 2, 1, 1),
(21, 13, '2020-05-12 19:41:25', 2800, 4, 120000, 2, 1, 1),
(22, 13, '2020-05-12 19:41:25', 10000, 1, 120000, 3, 1, 1),
(23, 17, '2020-05-16 15:38:27', 2500, 10, 70000, 1, 1, 1),
(24, 17, '2020-05-16 15:38:27', 10000, 4, 70000, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedidos`
--

CREATE TABLE `detallepedidos` (
  `id` int(11) NOT NULL,
  `pedidos_id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `precioventa` double NOT NULL,
  `cantidad` int(11) NOT NULL,
  `detalleproductos_id` int(11) NOT NULL,
  `personas_id` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleproductos`
--

CREATE TABLE `detalleproductos` (
  `id` int(11) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp(),
  `codigobarras` varchar(100) DEFAULT NULL,
  `productos_id` int(11) NOT NULL,
  `medidas_id` int(11) NOT NULL,
  `numerotipos_id` int(11) NOT NULL,
  `numeromedidas_id` int(11) NOT NULL,
  `marcas_id` int(11) NOT NULL,
  `tipoproductos_id` int(11) NOT NULL,
  `precioventa` double DEFAULT NULL,
  `preciocompra` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleproductos`
--

INSERT INTO `detalleproductos` (`id`, `estado`, `fechacreacion`, `fechaactualizacion`, `codigobarras`, `productos_id`, `medidas_id`, `numerotipos_id`, `numeromedidas_id`, `marcas_id`, `tipoproductos_id`, `precioventa`, `preciocompra`) VALUES
(1, 1, '2020-04-28 20:22:49', '2020-04-28 20:22:49', '1111111111', 1, 2, 1, 1, 1, 1, 2500, 2000),
(2, 1, '2020-04-28 20:22:49', '2020-04-28 20:22:49', '2222222222', 1, 2, 2, 1, 1, 1, 2800, 2100),
(3, 1, '2020-05-05 19:13:14', '2020-05-05 19:13:14', '3333333333', 2, 2, 1, 2, 2, 2, 10000, 9000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `fecha`, `estado`) VALUES
(1, '2020-05-11 22:07:38', 1),
(2, '2020-05-11 22:09:33', 1),
(3, '2020-05-11 22:16:28', 1),
(4, '2020-05-11 22:16:54', 1),
(5, '2020-05-11 22:17:17', 1),
(6, '2020-05-11 22:17:59', 1),
(7, '2020-05-11 22:23:01', 1),
(8, '2020-05-11 22:29:56', 1),
(9, '2020-05-11 22:35:36', 1),
(10, '2020-05-11 22:36:44', 1),
(11, '2020-05-11 22:39:55', 1),
(12, '2020-05-12 18:07:18', 1),
(13, '2020-05-13 19:41:25', 1),
(16, '2020-05-13 15:56:55', 1),
(17, '2020-05-16 15:38:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacias`
--

CREATE TABLE `farmacias` (
  `id` int(11) NOT NULL,
  `farmacia` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `clientes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `farmacias`
--

INSERT INTO `farmacias` (`id`, `farmacia`, `estado`, `fechacreacion`, `fechaactualizacion`, `clientes_id`) VALUES
(1, 'Farmacia 1', 1, '2020-04-28 19:48:13', '2020-04-28 19:48:13', 1),
(2, 'Farmacia 2', 1, '2020-04-28 19:48:13', '2020-04-28 19:48:13', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `detalleproductos_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `detalleproductos_id`, `cantidad`, `fecha`) VALUES
(1, 1, 10, '2020-05-14 17:45:05'),
(2, 2, 10, '2020-05-14 17:45:05'),
(3, 3, 10, '2020-05-14 17:45:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `marca`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'MK', 1, NULL, NULL),
(2, 'PROFARM', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `medida` varchar(10) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `medida`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'lts', 1, NULL, NULL),
(2, 'gr', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `modulo` varchar(100) NOT NULL,
  `enlace` varchar(50) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `modulo`, `enlace`, `icono`, `orden`, `fechacreacion`, `fechaactualizacion`, `estado`) VALUES
(1, 'Productos', 'cproducto', '<i class=\"nav-icon fas fa-users\"></i>', 3, '2020-05-19 17:41:32', '2020-05-19 17:41:32', 1),
(2, 'Roles', 'crol', '<i class=\"nav-icon fas fa-users\"></i>', 4, '2020-05-19 17:41:32', '2020-05-19 17:41:32', 1),
(3, 'Categorías', 'ccategoria', '<i class=\"nav-icon fas fa-users\"></i>', 1, '2020-05-19 18:27:02', '2020-05-19 18:27:02', 1),
(4, 'Movimientos', '', '<i class=\"nav-icon fas fa-users\"></i>', 2, '2020-05-19 18:57:27', '2020-05-19 18:57:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeromedidas`
--

CREATE TABLE `numeromedidas` (
  `id` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `numeromedidas`
--

INSERT INTO `numeromedidas` (`id`, `numero`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, '10', 1, NULL, NULL),
(2, '20', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numerotipos`
--

CREATE TABLE `numerotipos` (
  `id` int(11) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `numerotipos`
--

INSERT INTO `numerotipos` (`id`, `numero`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, '10', 1, NULL, NULL),
(2, '20', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `fecha`, `estado`) VALUES
(1, '2020-05-12 20:31:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(100) NOT NULL,
  `roles_id` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `tipodocumentos_id` int(11) NOT NULL,
  `documento` varchar(15) DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL,
  `usuario` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `estado` int(11) DEFAULT 1,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp(),
  `roles_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombres`, `apellidos`, `tipodocumentos_id`, `documento`, `fechanacimiento`, `usuario`, `clave`, `estado`, `fechacreacion`, `fechaactualizacion`, `roles_id`) VALUES
(1, 'Johan Sebastian', 'Cardona Gomez', 1, '1012377024', '1991-05-07', 'jscardona42', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, NULL, NULL, 1),
(2, 'Yaky', 'Sanchez Cardozo', 1, '1110263261', '1998-01-23', 'yaky0723', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, NULL, NULL, 2),
(3, 'Juan Carlos', 'Sorín', 1, '1014578854', '2020-04-02', 'juan42', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1, '2020-04-29 00:55:56', '2020-04-29 00:55:56', 2),
(7, 'Juan Carlos', 'Lores', 1, '1014578854', '2020-05-09', 'jscardona42', '8cb2237d0679ca88db6464eac60da96345513964', 1, '2020-05-04 20:29:35', '2020-05-04 20:29:35', 2),
(9, 'Marco Aurelio', 'Bonaparte', 1, '123467890', '2020-05-11', 'marco42', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, '2020-05-13 14:35:43', '2020-05-13 14:35:43', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personasfarmacias`
--

CREATE TABLE `personasfarmacias` (
  `id` int(11) NOT NULL,
  `personas_id` int(11) NOT NULL,
  `farmacias_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personasfarmacias`
--

INSERT INTO `personasfarmacias` (`id`, `personas_id`, `farmacias_id`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 1, 1, 1, '2020-04-28 20:39:49', '2020-04-28 20:39:49'),
(2, 2, 1, 1, '2020-04-28 20:39:49', '2020-04-28 20:39:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `categorias_id` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `producto`, `estado`, `categorias_id`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'Acetaminofén', 1, 1, '2020-04-28 20:06:06', '2020-04-28 20:06:06'),
(2, 'Ibuprofeno', 1, 1, '2020-04-28 20:06:06', '2020-04-28 20:06:06'),
(3, 'Dolex', 1, 1, '2020-05-19 00:39:04', '2020-05-19 00:39:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(80) NOT NULL,
  `estado` int(11) DEFAULT 1,
  `fechacreacion` timestamp NULL DEFAULT current_timestamp(),
  `fechaactualizacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'Administrador', 1, NULL, NULL),
(2, 'Usuario', 0, NULL, NULL),
(3, 'Supervisor3', 0, '2020-04-30 22:04:19', '2020-04-30 22:04:19'),
(4, 'Supervisor', 0, '2020-05-01 01:25:36', '2020-05-01 01:25:36'),
(34, 'Gerente', 0, '2020-05-02 20:52:41', '2020-05-02 20:52:41'),
(35, 'Director', 1, '2020-05-02 20:53:48', '2020-05-02 20:53:48'),
(36, 'Servicio de aseo', 1, '2020-05-02 20:54:16', '2020-05-02 20:54:16'),
(37, 'Operario', 1, '2020-05-02 20:54:26', '2020-05-02 20:54:26'),
(38, 'Especialista', 1, '2020-05-02 20:54:36', '2020-05-02 20:54:36'),
(39, 'Desarrollador', 1, '2020-05-02 20:54:42', '2020-05-02 20:54:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `submodulos`
--

CREATE TABLE `submodulos` (
  `id` int(11) NOT NULL,
  `submodulo` varchar(100) NOT NULL,
  `modulos_id` int(11) NOT NULL,
  `enlace` varchar(50) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  `fechacreacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fechactualizacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `submodulos`
--

INSERT INTO `submodulos` (`id`, `submodulo`, `modulos_id`, `enlace`, `icono`, `orden`, `fechacreacion`, `fechactualizacion`, `estado`) VALUES
(1, 'Facturas', 4, 'cfactura', '<i class=\"far fa-circle nav-icon\"></i>', 2, '2020-05-19 18:33:42', '2020-05-19 18:33:42', 1),
(2, 'Pedidos', 4, 'cpedido', '<i class=\"far fa-circle nav-icon\"></i>', 1, '2020-05-19 18:59:02', '2020-05-19 18:59:02', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumentos`
--

CREATE TABLE `tipodocumentos` (
  `id` int(11) NOT NULL,
  `tipodocumento` varchar(45) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp(6) NULL DEFAULT NULL,
  `fechaactualizacion` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipodocumentos`
--

INSERT INTO `tipodocumentos` (`id`, `tipodocumento`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'Cédula de ciudadanía', 1, NULL, NULL),
(2, 'Tarjeta de identidad', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproductos`
--

CREATE TABLE `tipoproductos` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `fechacreacion` timestamp(6) NULL DEFAULT NULL,
  `fechaactualizacion` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoproductos`
--

INSERT INTO `tipoproductos` (`id`, `tipo`, `estado`, `fechacreacion`, `fechaactualizacion`) VALUES
(1, 'Cápsula', 1, NULL, NULL),
(2, 'Tableta', 1, NULL, NULL);

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
-- Indices de la tabla `datoscontacto`
--
ALTER TABLE `datoscontacto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_datoscontacto_personas1_idx` (`personas_id`);

--
-- Indices de la tabla `detallefacturas`
--
ALTER TABLE `detallefacturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personas_id` (`personas_id`),
  ADD KEY `facturas_id` (`facturas_id`),
  ADD KEY `detalleproductos_id` (`detalleproductos_id`);

--
-- Indices de la tabla `detallepedidos`
--
ALTER TABLE `detallepedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personas_id` (`personas_id`),
  ADD KEY `pedidos_id` (`pedidos_id`),
  ADD KEY `detalleproductos_id` (`detalleproductos_id`);

--
-- Indices de la tabla `detalleproductos`
--
ALTER TABLE `detalleproductos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalleproductos_productos1_idx` (`productos_id`),
  ADD KEY `fk_detalleproductos_medidas1_idx` (`medidas_id`),
  ADD KEY `fk_detalleproductos_numerotipos1_idx` (`numerotipos_id`),
  ADD KEY `fk_detalleproductos_numeromedidas1_idx` (`numeromedidas_id`),
  ADD KEY `fk_detalleproductos_marcas1_idx` (`marcas_id`),
  ADD KEY `fk_detalleproductos_tipoproductos1_idx` (`tipoproductos_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `farmacias`
--
ALTER TABLE `farmacias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clientes_id` (`clientes_id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalleproductos_id` (`detalleproductos_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `numeromedidas`
--
ALTER TABLE `numeromedidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `numerotipos`
--
ALTER TABLE `numerotipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_personas_tipodocumentos_idx` (`tipodocumentos_id`),
  ADD KEY `fk_personas_roles1_idx` (`roles_id`);

--
-- Indices de la tabla `personasfarmacias`
--
ALTER TABLE `personasfarmacias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personas_id` (`personas_id`),
  ADD KEY `farmacias_id` (`farmacias_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_productos_categorias1_idx` (`categorias_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipodocumentos`
--
ALTER TABLE `tipodocumentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipoproductos`
--
ALTER TABLE `tipoproductos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `datoscontacto`
--
ALTER TABLE `datoscontacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `detallefacturas`
--
ALTER TABLE `detallefacturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `detallepedidos`
--
ALTER TABLE `detallepedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleproductos`
--
ALTER TABLE `detalleproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `farmacias`
--
ALTER TABLE `farmacias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `numeromedidas`
--
ALTER TABLE `numeromedidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `numerotipos`
--
ALTER TABLE `numerotipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `personasfarmacias`
--
ALTER TABLE `personasfarmacias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `submodulos`
--
ALTER TABLE `submodulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipodocumentos`
--
ALTER TABLE `tipodocumentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipoproductos`
--
ALTER TABLE `tipoproductos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `datoscontacto`
--
ALTER TABLE `datoscontacto`
  ADD CONSTRAINT `fk_datoscontacto_personas1` FOREIGN KEY (`personas_id`) REFERENCES `personas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallefacturas`
--
ALTER TABLE `detallefacturas`
  ADD CONSTRAINT `detallefacturas_ibfk_1` FOREIGN KEY (`facturas_id`) REFERENCES `facturas` (`id`),
  ADD CONSTRAINT `detallefacturas_ibfk_2` FOREIGN KEY (`personas_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `detallefacturas_ibfk_3` FOREIGN KEY (`detalleproductos_id`) REFERENCES `detalleproductos` (`id`);

--
-- Filtros para la tabla `detallepedidos`
--
ALTER TABLE `detallepedidos`
  ADD CONSTRAINT `detallepedidos_ibfk_1` FOREIGN KEY (`pedidos_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detallepedidos_ibfk_2` FOREIGN KEY (`personas_id`) REFERENCES `personas` (`id`),
  ADD CONSTRAINT `detallepedidos_ibfk_3` FOREIGN KEY (`detalleproductos_id`) REFERENCES `detalleproductos` (`id`);

--
-- Filtros para la tabla `detalleproductos`
--
ALTER TABLE `detalleproductos`
  ADD CONSTRAINT `fk_detalleproductos_marcas1` FOREIGN KEY (`marcas_id`) REFERENCES `marcas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleproductos_medidas1` FOREIGN KEY (`medidas_id`) REFERENCES `medidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleproductos_numeromedidas1` FOREIGN KEY (`numeromedidas_id`) REFERENCES `numeromedidas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleproductos_numerotipos1` FOREIGN KEY (`numerotipos_id`) REFERENCES `numerotipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleproductos_productos1` FOREIGN KEY (`productos_id`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleproductos_tipoproductos1` FOREIGN KEY (`tipoproductos_id`) REFERENCES `tipoproductos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `farmacias`
--
ALTER TABLE `farmacias`
  ADD CONSTRAINT `farmacias_ibfk_1` FOREIGN KEY (`clientes_id`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`detalleproductos_id`) REFERENCES `detalleproductos` (`id`);

--
-- Filtros para la tabla `personas`
--
ALTER TABLE `personas`
  ADD CONSTRAINT `fk_personas_roles1` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personas_tipodocumentos` FOREIGN KEY (`tipodocumentos_id`) REFERENCES `tipodocumentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personasfarmacias`
--
ALTER TABLE `personasfarmacias`
  ADD CONSTRAINT `personasfarmacias_ibfk_1` FOREIGN KEY (`personas_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personasfarmacias_ibfk_2` FOREIGN KEY (`farmacias_id`) REFERENCES `farmacias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
