-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2024 a las 02:14:59
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
-- Base de datos: `healthpet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Medicamento', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'Alimento', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 'Accesorio', '2024-11-13 05:55:56', '2024-11-13 05:55:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedidos`
--

CREATE TABLE `detalle_pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pedido_id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  `tipo_pago_id` bigint(20) UNSIGNED NOT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedidos`
--

INSERT INTO `detalle_pedidos` (`id`, `pedido_id`, `id_producto`, `cantidad`, `precio`, `subtotal`, `descuento`, `tipo_pago_id`, `nota`, `created_at`, `updated_at`) VALUES
(1, 1, 57, 1, 43750, 33875, 21875, 3, '', '2024-11-13 10:35:01', '2024-11-13 10:35:01'),
(2, 1, 47, 1, 12000, 33875, 0, 3, '', '2024-11-13 10:35:01', '2024-11-13 10:35:01'),
(3, 2, 57, 1, 43750, 41875, 21875, 3, '', '2024-11-15 01:01:42', '2024-11-15 01:01:42'),
(4, 2, 54, 1, 20000, 41875, 0, 3, '', '2024-11-15 01:01:42', '2024-11-15 01:01:42'),
(5, 3, 50, 1, 22500, 22500, 0, 3, 'Pedido prueba', '2024-11-17 23:47:59', '2024-11-17 23:47:59'),
(6, 4, 50, 2, 22500, 45000, 0, 3, 'pe', '2024-11-18 00:11:34', '2024-11-18 00:11:34'),
(7, 5, 50, 2, 22500, 45000, 0, 3, 'Pedido prueba', '2024-11-18 00:11:50', '2024-11-18 00:11:50'),
(8, 6, 57, 1, 43750, 21875, 21875, 3, 'Pedido prueba', '2024-11-18 01:58:51', '2024-11-18 01:58:51'),
(9, 7, 57, 1, 43750, 21875, 21875, 3, 'Pedido prueba con seguimiento del pedido', '2024-11-18 01:59:31', '2024-11-18 01:59:31'),
(10, 8, 48, 4, 13000, 52000, 0, 3, 'fsd', '2024-11-22 05:02:44', '2024-11-22 05:02:44'),
(11, 9, 48, 1, 13000, 13000, 0, 3, 'aaaaaa', '2024-11-22 08:15:18', '2024-11-22 08:15:18'),
(12, 10, 48, 1, 13000, 13000, 0, 3, 'aaa', '2024-11-22 08:17:14', '2024-11-22 08:17:14'),
(13, 11, 48, 4, 13000, 52000, 0, 3, 'prueba', '2024-11-23 02:54:03', '2024-11-23 02:54:03'),
(14, 12, 48, 5, 13000, 65000, 0, 3, 'prueba', '2024-11-23 02:59:17', '2024-11-23 02:59:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `tipo_venta` varchar(255) NOT NULL,
  `id_presentacion` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `venta_id`, `id_producto`, `tipo_venta`, `id_presentacion`, `cantidad`, `precio_unitario`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'completo', 1, 1, 12000, '2024-11-13 10:31:36', '2024-11-13 10:31:36'),
(2, 1, 54, 'completo', 1, 1, 20000, '2024-11-13 10:31:36', '2024-11-13 10:31:36'),
(3, 2, 36, 'completo', 1, 3, 30000, '2024-11-13 10:32:55', '2024-11-13 10:32:55'),
(4, 2, 13, 'completo', 1, 1, 80000, '2024-11-13 10:32:55', '2024-11-13 10:32:55'),
(5, 3, 10, 'completo', 1, 1, 12000, '2024-11-15 01:20:01', '2024-11-15 01:20:01'),
(6, 4, 34, 'completo', 1, 1, 12000, '2024-11-18 00:30:25', '2024-11-18 00:30:25'),
(7, 5, 1, 'completo', 1, 5, 12000, '2024-11-20 04:56:00', '2024-11-20 04:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_web`
--

CREATE TABLE `detalle_web` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `contenido_neto` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_web`
--

INSERT INTO `detalle_web` (`id`, `id_producto`, `marca`, `descripcion`, `contenido_neto`, `created_at`, `updated_at`) VALUES
(1, 58, 'Feliz', 'Alimento para gatos con problemas de obesidad', 85.00, '2024-11-13 09:20:12', '2024-11-13 09:20:12'),
(2, 47, 'Kong Classic', 'Juguete', 1.00, '2024-11-13 09:23:00', '2024-11-13 09:23:00'),
(4, 48, 'Kong Classic', 'juguete', 1.00, '2024-11-13 10:24:46', '2024-11-13 10:24:46'),
(5, 50, 'HILLS C/D', 'HILLS C/D PERRO 3 KG', 3.00, '2024-11-13 10:25:28', '2024-11-13 10:25:28'),
(6, 51, 'HILLS C/D', 'HILLS C/D PERRO 3 KG', 3.00, '2024-11-13 10:26:02', '2024-11-13 10:26:02'),
(7, 52, 'HILLS C/D', 'HILLS C/D GATO 1,5 KG', 2.00, '2024-11-13 10:26:49', '2024-11-13 10:26:49'),
(8, 53, 'HILLS C/D', 'HILLS C/D GATO 8 KG', 8.00, '2024-11-13 10:27:25', '2024-11-13 10:27:25'),
(9, 54, 'ROYAL CANIN', 'ROYAL CANIN GATO 1,5 KG', 2.00, '2024-11-13 10:28:09', '2024-11-13 10:28:09'),
(10, 57, 'ROYAL CANIN', 'ROYAL CANIN PERRO 7,5 KG', 8.00, '2024-11-13 10:29:09', '2024-11-13 10:29:09'),
(11, 61, 'ejemplo', 'ejemplo web', 15.00, '2024-11-18 00:24:57', '2024-11-18 00:24:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deudas`
--

CREATE TABLE `deudas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `venta_id` bigint(20) UNSIGNED NOT NULL,
  `monto_adeudado` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `deudas`
--

INSERT INTO `deudas` (`id`, `venta_id`, `monto_adeudado`, `estado`, `created_at`, `updated_at`) VALUES
(1, 2, 0, 1, '2024-11-13 10:32:55', '2024-11-22 05:09:20'),
(2, 3, 0, 1, '2024-11-15 01:20:01', '2024-11-15 01:26:48'),
(3, 4, 0, 1, '2024-11-18 00:30:25', '2024-11-18 00:34:31'),
(4, 5, 14000, 0, '2024-11-20 04:56:00', '2024-11-20 04:56:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Perro', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'Gato', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 'Otro', '2024-11-13 05:55:56', '2024-11-13 05:55:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '0001_01_01_000003_create_especie_table', 1),
(5, '0001_01_01_000004_create_categoria_table', 1),
(6, '0001_01_01_000005_create_presentacion_table', 1),
(7, '0001_01_01_000006_create_unidad_table', 1),
(8, '0001_01_01_000007_create_producto_table', 1),
(9, '0001_01_01_000008_create_tipo_pago_table', 1),
(10, '0001_01_01_000009_create_detalle_web_table', 1),
(11, '0001_01_01_000010_create_pedidos_table', 1),
(12, '0001_01_01_000011_create_detalle_pedidos_table', 1),
(13, '2024_10_08_013724_create_ventas_table', 1),
(14, '2024_10_08_015815_create_detalle_ventas_table', 1),
(15, '2024_10_08_231726_create_deudas_table', 1),
(16, '2024_10_18_014457_create_pagos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deuda_id` bigint(20) UNSIGNED NOT NULL,
  `monto_pagado` int(11) NOT NULL,
  `monto_restante` int(11) NOT NULL,
  `tipo_pago_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `deuda_id`, `monto_pagado`, `monto_restante`, `tipo_pago_id`, `created_at`, `updated_at`) VALUES
(1, 1, 100000, 70000, 3, '2024-11-13 10:32:55', '2024-11-13 10:32:55'),
(2, 1, 10000, 60000, 3, '2024-11-13 10:33:21', '2024-11-13 10:33:21'),
(3, 2, 6000, 6000, 3, '2024-11-15 01:20:01', '2024-11-15 01:20:01'),
(4, 2, 6000, 0, 3, '2024-11-15 01:26:48', '2024-11-15 01:26:48'),
(5, 3, 10000, 2000, 1, '2024-11-18 00:30:25', '2024-11-18 00:30:25'),
(6, 3, 2000, 0, 1, '2024-11-18 00:34:31', '2024-11-18 00:34:31'),
(7, 4, 40000, 14000, 1, '2024-11-20 04:56:00', '2024-11-20 04:56:00'),
(8, 1, 60000, 0, 1, '2024-11-22 05:09:20', '2024-11-22 05:09:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `telefono_cliente` varchar(255) NOT NULL,
  `estado_pedido` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `monto_pagado` int(11) DEFAULT NULL,
  `estado_pago` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `nombre_cliente`, `email_cliente`, `telefono_cliente`, `estado_pedido`, `total`, `monto_pagado`, `estado_pago`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Agustin Rodriguez', 'ag.rodriguez@gmail.com', '+56993804823', 4, 55750, 33875, 1, '2024-11-13 10:35:01', '2024-11-15 01:30:29'),
(2, NULL, 'jhbugug', 'kuitkf@gmail.com', '+56964353493', 2, 63750, 41875, 1, '2024-11-15 01:01:42', '2024-11-22 08:10:21'),
(3, NULL, 'agustin', 'agustin@mail.com', '+56945258235', 4, 22500, 22500, 2, '2024-11-17 23:47:59', '2024-11-22 05:07:49'),
(4, NULL, 'Agustin', 'agustin@mail.com', '+56912345678', 0, 45000, 45000, 0, '2024-11-18 00:11:34', '2024-11-18 00:11:34'),
(5, NULL, 'Agustin', 'agustin@mail.com', '+56912345678', 5, 45000, 45000, 2, '2024-11-18 00:11:50', '2024-11-18 00:36:39'),
(6, NULL, 'agustin', 'agustin@mail.com', '+56912121212', 0, 43750, 21875, 0, '2024-11-18 01:58:51', '2024-11-18 01:58:51'),
(7, NULL, 'agustin', 'agustin@mail.com', '+56912121212', 4, 43750, 21875, 1, '2024-11-18 01:59:31', '2024-11-18 02:04:03'),
(8, NULL, 'twet', 'as@sdas', '+56932323232', 0, 52000, 52000, 0, '2024-11-22 05:02:44', '2024-11-22 05:02:44'),
(9, NULL, 'agustin', 'agustin@mail.com', '+56912121212', 2, 13000, 13000, 2, '2024-11-22 08:15:18', '2024-11-22 08:16:31'),
(10, NULL, 'asdasd', 'agustin@mail.com', '+56912121212', 0, 13000, 0, 0, '2024-11-22 08:17:14', '2024-11-22 08:18:02'),
(11, NULL, 'agustin', 'agustin@mail.com', '+56912121212', 0, 52000, 52000, 0, '2024-11-23 02:54:03', '2024-11-23 02:54:03'),
(12, NULL, 'agustin', 'agustin@mail.com', '+56912121212', 0, 65000, 65000, 0, '2024-11-23 02:59:17', '2024-11-23 02:59:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentacion`
--

CREATE TABLE `presentacion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_categoria` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `presentacion`
--

INSERT INTO `presentacion` (`id`, `id_categoria`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'comprimidos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 1, 'inyectable', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 1, 'granel', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(4, 2, 'Seco', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(5, 2, 'Humedo', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(6, 2, 'Snack', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(7, 3, 'juguete', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(8, 3, 'estetica e higiene', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(9, 3, 'ropa', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(10, 3, 'otro', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(11, 1, 'Jarabe', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `codigo` int(11) NOT NULL,
  `precio_de_compra` int(11) NOT NULL,
  `precio_de_venta` int(11) NOT NULL,
  `precio_fraccionado` int(11) DEFAULT NULL,
  `id_especie` bigint(20) UNSIGNED DEFAULT NULL,
  `id_unidad` bigint(20) UNSIGNED DEFAULT NULL,
  `id_presentacion` bigint(20) UNSIGNED DEFAULT NULL,
  `id_categoria` bigint(20) UNSIGNED DEFAULT NULL,
  `stock_unidades` int(11) DEFAULT NULL,
  `stock_total_ml` int(11) DEFAULT NULL,
  `ml_por_unidad` int(11) DEFAULT NULL,
  `stock_total_comprimidos` int(11) DEFAULT NULL,
  `comprimidos_por_caja` int(11) DEFAULT NULL,
  `vende_a_granel` tinyint(1) NOT NULL DEFAULT 0,
  `unidades_por_envase` int(11) DEFAULT NULL,
  `unidades_granel_total` int(11) DEFAULT NULL,
  `mostrar_web` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_de_vencimiento` timestamp NULL DEFAULT NULL,
  `cantidad_minima_requerida` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `imagen`, `descripcion`, `codigo`, `precio_de_compra`, `precio_de_venta`, `precio_fraccionado`, `id_especie`, `id_unidad`, `id_presentacion`, `id_categoria`, `stock_unidades`, `stock_total_ml`, `ml_por_unidad`, `stock_total_comprimidos`, `comprimidos_por_caja`, `vende_a_granel`, `unidades_por_envase`, `unidades_granel_total`, `mostrar_web`, `fecha_de_vencimiento`, `cantidad_minima_requerida`, `created_at`, `updated_at`) VALUES
(1, 'alerdrag', NULL, 'Antihistamínico para mascotas', 1001, 9600, 12000, 0, 1, 2, 1, 1, 1, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 10, '2024-11-13 08:20:05', '2024-11-23 01:26:41'),
(3, 'amoxicilina + ac. clavu 500 comprimidos', NULL, 'Antibiótico en comprimidos para infecciones bacterianas', 1003, 8000, 10000, 0, 1, 2, 1, 1, 1, NULL, NULL, 500, 500, 0, NULL, NULL, 0, NULL, 10, '2024-11-13 09:04:11', '2024-11-23 01:26:50'),
(4, 'AMOXICILINA + AC. CLAVU 875', NULL, 'Antibiótico en comprimidos para infecciones bacterianas', 1004, 9600, 12000, NULL, 1, 2, 1, 1, 100, NULL, NULL, 100, NULL, 0, NULL, NULL, 0, '2028-01-01 06:00:00', 5, '2024-11-13 09:04:11', '2024-11-13 09:04:11'),
(5, 'apoquel 3,6', NULL, 'Medicamento para el alivio de la dermatitis alérgica', 1005, 32800, 41000, 0, 1, 2, 1, 1, 1, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 3, '2024-11-13 09:04:11', '2024-11-23 01:26:58'),
(6, 'APOQUEL 16', NULL, 'Medicamento para el alivio de la dermatitis alérgica', 1006, 39200, 49000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', 3, '2024-11-13 09:04:11', '2024-11-13 09:04:11'),
(7, 'APOQUEL 5,4', NULL, 'Medicamento para el alivio de la dermatitis alérgica', 1007, 36000, 45000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', 3, '2024-11-13 09:04:11', '2024-11-13 09:04:11'),
(8, 'AEROCAMARA CAJA BLANCA', NULL, 'Dispositivo de administración para inhaladores', 1008, 9600, 12000, NULL, 1, 4, 1, 1, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-08-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(9, 'AEROCAMARA CAJA CELESTE', NULL, 'Dispositivo de administración para inhaladores', 1009, 4000, 5000, NULL, 1, 4, 1, 1, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-08-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(10, 'APETICAT', NULL, 'Estimulante del apetito para gatos', 1010, 9600, 12000, NULL, 2, 2, 1, 1, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-15 01:24:41'),
(11, 'APETIPET', NULL, 'Estimulante del apetito para mascotas', 1011, 8640, 10800, NULL, 1, 2, 1, 1, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(12, 'ARTRITAB', NULL, 'Suplemento para el alivio de la artritis en mascotas', 1012, 29520, 36900, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-12-01 07:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(13, 'AVENTI CKD CANINE POLVO', NULL, 'Suplemento para soporte renal en perros', 1013, 64000, 80000, NULL, 1, 2, 1, 1, 19, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-01-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 10:32:55'),
(14, 'AVENTI CKD FELINE POLVO', NULL, 'Suplemento para soporte renal en gatos', 1014, 68000, 85000, NULL, 2, 2, 1, 1, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-01-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(15, 'AVERTEX', NULL, 'Antiparasitario para el control de pulgas y garrapatas', 1015, 3200, 4000, NULL, 1, 3, 1, 1, 10, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-05-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(16, 'BEAPHAR COLLAR ANTIFUGAS', NULL, 'Collar antiparasitario para perros y gatos', 1016, 8000, 10000, NULL, 1, 4, 1, 1, 5, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-02-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(17, 'BETAMOX LA', NULL, 'Antibiótico de acción prolongada para infecciones en mascotas', 1017, 12800, 16000, NULL, 1, 2, 1, 1, 50, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-11-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(18, 'BIOSOL P', NULL, 'Antibiótico de amplio espectro en polvo', 1018, 8000, 10000, NULL, 1, 2, 1, 1, 100, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-01-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(19, 'BRAVECTO 250 MG', NULL, 'Antiparasitario oral para perros de hasta 10 kg', 1019, 27200, 34000, NULL, 1, 3, 1, 1, 5, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-07-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(20, 'BRAVECTO 500 MG', NULL, 'Antiparasitario oral para perros de hasta 20 kg', 1020, 32000, 40000, NULL, 1, 3, 1, 1, 5, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-07-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(21, 'BRAVECTO 1000 MG', NULL, 'Antiparasitario oral para perros de hasta 40 kg', 1021, 39200, 49000, NULL, 1, 3, 1, 1, 5, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-07-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(22, 'CANIDERM SHAMPOO', NULL, 'Shampoo medicinal para el tratamiento de piel sensible', 1022, 9600, 12000, NULL, 1, 4, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(23, 'CARPRODYL F 50 MG', NULL, 'Analgésico y antiinflamatorio para perros', 1023, 16800, 21000, NULL, 1, 2, 1, 1, 10, NULL, NULL, 50, NULL, 0, NULL, NULL, 0, '2025-10-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(24, 'CEFASEPTIN 300 MG', NULL, 'Antibiótico para infecciones bacterianas en perros', 1024, 17600, 22000, NULL, 1, 2, 1, 1, 20, NULL, NULL, 300, NULL, 0, NULL, NULL, 0, '2026-03-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(25, 'CEFASEPTIN 75 MG', NULL, 'Antibiótico para infecciones bacterianas en perros y gatos', 1025, 6400, 8000, NULL, 1, 2, 1, 1, 20, NULL, NULL, 75, NULL, 0, NULL, NULL, 0, '2026-03-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(26, 'CIMALGEX 80 MG', NULL, 'Analgésico y antiinflamatorio para perros', 1026, 19200, 24000, NULL, 1, 2, 1, 1, 30, NULL, NULL, 80, NULL, 0, NULL, NULL, 0, '2025-12-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(27, 'CORTAVANCE SPRAY 76 ML', NULL, 'Spray para el tratamiento de alergias y dermatitis en perros', 1027, 12000, 15000, NULL, 1, 4, 1, 1, 1, NULL, 76, NULL, NULL, 0, NULL, NULL, 0, '2025-11-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(28, 'DERMOSCENT BIOBALM', NULL, 'Bálsamo protector para el cuidado de la piel en perros', 1028, 14400, 18000, NULL, 1, 4, 1, 1, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-10-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(29, 'DEXAFORT INY', NULL, 'Antiinflamatorio inyectable para el tratamiento de inflamaciones severas', 1029, 12800, 16000, NULL, 1, 2, 1, 1, 10, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-02-01 07:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(30, 'DOLVIT CARDIO DOG', NULL, 'Suplemento para soporte cardíaco en perros', 1030, 28000, 35000, NULL, 1, 2, 1, 1, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(31, 'DOLVIT CARDIO CAT', NULL, 'Suplemento para soporte cardíaco en gatos', 1031, 30000, 37500, NULL, 2, 2, 1, 1, 15, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(32, 'EFFIPRO SPOT-ON CAT', NULL, 'Antiparasitario para el control de pulgas y garrapatas en gatos', 1032, 8000, 10000, NULL, 2, 3, 1, 1, 10, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-08-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(33, 'EFFIPRO SPRAY 100 ML', NULL, 'Spray antiparasitario para el control de pulgas y garrapatas en perros y gatos', 1033, 10400, 13000, NULL, 1, 3, 1, 1, 10, NULL, 100, NULL, NULL, 0, NULL, NULL, 0, '2025-08-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(34, 'ENROFLOXACINA 100 MG', NULL, 'Antibiótico de amplio espectro para infecciones bacterianas', 1034, 9600, 12000, NULL, 1, 2, 1, 1, 49, NULL, NULL, 100, NULL, 0, NULL, NULL, 0, '2026-01-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-18 00:30:25'),
(35, 'EQUILAC SHAMPOO 500 ML', NULL, 'Shampoo especializado para el cuidado de la piel de caballos', 1035, 15200, 19000, NULL, 3, 4, 1, 1, 20, NULL, 500, NULL, NULL, 0, NULL, NULL, 0, '2026-03-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(36, 'EQUIPUR MAGNESIUM', NULL, 'Suplemento mineral para la relajación muscular en caballos', 1036, 24000, 30000, NULL, 3, 2, 1, 1, 12, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-05-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 10:32:55'),
(37, 'FIPROX 67 MG', NULL, 'Antiparasitario externo en pipetas para gatos', 1037, 10400, 13000, NULL, 2, 3, 1, 1, 10, NULL, NULL, 67, NULL, 0, NULL, NULL, 0, '2025-08-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(38, 'FORTIFLEX 375', NULL, 'Condroprotector para el soporte articular en perros de tamaño mediano', 1038, 23200, 29000, NULL, 1, 2, 1, 1, 20, NULL, NULL, 375, NULL, 0, NULL, NULL, 0, '2026-04-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(39, 'FORTIFLEX 525', NULL, 'Condroprotector para el soporte articular en perros de gran tamaño', 1039, 28000, 35000, NULL, 1, 2, 1, 1, 20, NULL, NULL, 525, NULL, 0, NULL, NULL, 0, '2026-04-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(40, 'GABAPENTINA 50 MG', NULL, 'Analgésico y anticonvulsivante para el manejo del dolor en perros', 1040, 7200, 9000, NULL, 1, 2, 1, 1, 30, NULL, NULL, 50, NULL, 0, NULL, NULL, 0, '2025-12-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(41, 'GABAPENTINA 100 MG', NULL, 'Analgésico y anticonvulsivante para el manejo del dolor en perros', 1041, 10400, 13000, NULL, 1, 2, 1, 1, 30, NULL, NULL, 100, NULL, 0, NULL, NULL, 0, '2025-12-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(42, 'HEPATO PROTECT', NULL, 'Suplemento para soporte hepático en perros y gatos', 1042, 21600, 27000, NULL, 1, 2, 1, 1, 15, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-02-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(43, 'HIPERMUNE', NULL, 'Inmunoestimulante para mejorar las defensas naturales en mascotas', 1043, 17600, 22000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-12-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(44, 'ICOFEN 20 MG', NULL, 'Antihelmíntico para el control de parásitos internos en perros y gatos', 1044, 3200, 4000, NULL, 1, 3, 1, 1, 100, NULL, NULL, 20, NULL, 0, NULL, NULL, 0, '2025-10-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(45, 'IMIDAFLEA SPRAY 250 ML', NULL, 'Antiparasitario externo en spray para perros y gatos', 1045, 10400, 13000, NULL, 1, 3, 1, 1, 5, NULL, 250, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(47, 'kong classic talla m', 'productos/1731482653_D_NQ_NP_738019-MLC45426898216_042021-O.jpg', 'Juguete para perros, diseñado para morder y rellenar con premios', 1047, 9600, 12000, 0, 1, 5, 1, 1, 4, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 0, '2024-11-13 09:20:05', '2024-11-15 01:13:09'),
(48, 'kong classic talla l', 'productos/1731482686_D_NQ_NP_738019-MLC45426898216_042021-O.jpg', 'Juguete para perros, diseñado para morder y rellenar con premios', 1048, 10400, 13000, 0, 1, 5, 1, 1, 49, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-22 08:16:31'),
(49, 'enrofloxacina 50 mg', NULL, 'Antibiótico para infecciones bacterianas en perros y gatos', 10674, 5000, 6250, 0, 1, 2, 1, 1, 100, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 09:16:49'),
(50, 'hills c/d perro 3 kg', 'productos/1731482727_Hills-CD-Urinary-Care-Perro-3.85-Kg.jpg', 'Alimento veterinario para perros con problemas urinarios', 1567, 18000, 22500, 0, 2, 3, 1, 1, 12, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-18 00:12:55'),
(51, 'hills c/d perro 7,5 kg', 'productos/1731482762_Hills-CD-Urinary-Care-Perro-3.85-Kg.jpg', 'Alimento veterinario para perros con problemas urinarios', 185, 38000, 47500, 0, 2, 3, 1, 1, 15, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:26:02'),
(52, 'hills c/d gato 1,5 kg', 'productos/1731482809_Hills-cd-Urinary-Care-Felino-3.jpg', 'Alimento veterinario para gatos con problemas urinarios', 1854, 15000, 18750, 0, 2, 3, 1, 1, 10, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:26:49'),
(53, 'hills c/d gato 3,5 kg', 'productos/1731482845_Hills-cd-Urinary-Care-Felino-3.jpg', 'Alimento veterinario para gatos con problemas urinarios', 33456, 29000, 36250, 0, 2, 3, 1, 1, 10, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:27:25'),
(54, 'royal canin gato 1,5 kg', 'productos/1731482889_Royal-Canin-Kitten-Sterilised-3.5Kg-_F_.jpg', 'Alimento veterinario para gatos con problemas digestivos', 3468, 16000, 20000, 0, 2, 3, 1, 1, 8, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-15 01:05:13'),
(57, 'royal canin perro 7,5 kg', 'productos/1731482949_7896181218937.png.jpg', 'Alimento veterinario para perros con problemas digestivos', 13489, 35000, 43750, 0, 2, 3, 1, 1, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:30:16'),
(58, 'felix classic con atún 85 gr', 'productos/1731482966_Alimento-humedo-gato-sensaciones-de-atun-en-salsa-85-g.jpg', 'Alimento para gatos con problemas de obesidad', 3422, 11000, 13750, 0, 2, 3, 5, 2, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:29:26'),
(61, 'ejemplo', 'productos/1731878696_pata-perro.png', 'producto de prueba', 123123, 3000, 6000, 1000, 3, 2, 1, 1, 15, NULL, NULL, 75, 5, 0, NULL, NULL, 1, NULL, 1, '2024-11-18 00:22:31', '2024-11-18 00:24:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Eg3UJjti4oW6YywH1WoYztKIz21emswW0IcnjDFh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:132.0) Gecko/20100101 Firefox/132.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0dGSW9aZDJwb2JtQnlxcEY3eGdjZGl3SHJCdjl4ZG96MTZuWEdZeCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZXRzaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1732315886),
('lyiGKMBIH4SuVcwA5VM6y458Pt77pR9jNtwtguV6', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:132.0) Gecko/20100101 Firefox/132.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTVJQWNCV3QzV25NNTI2M0pJWXZTd200c0Y0cGFibXZLZFFJRWJTZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbmljaW8tc2VzaW9uIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1732320230);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Efectivo', 'Pago en efectivo', NULL, NULL),
(2, 'Tarjeta de Crédito', 'Pago con tarjeta de crédito', NULL, NULL),
(3, 'Tarjeta de Débito', 'Pago con tarjeta de débito', NULL, NULL),
(4, 'Transferencia Bancaria', 'Pago mediante transferencia bancaria', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'miligramos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'gramos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 'kilogramos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(4, 'mililitros', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(5, 'litros', '2024-11-13 05:55:56', '2024-11-13 05:55:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `movile` int(11) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `movile`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(11, 'Test User', 'test@example.com', '2024-11-13 05:55:56', '$2y$12$N2abbkKXUt1OHwekk6UHMeOPdRpxyfqmQqDj0k2Xgw544adm9fREG', NULL, 'admin', 'AWCw8PKmz5zrRRO8TirXgmSjmyEyfXQqflAQfy0YpfNx9ydZm6HBS8l9gWTL', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(12, 'agustin', 'agustins@mail.com', NULL, '$2y$12$ptorsKI0t0jmpsta3GXdBuqamBA6hoVwf5OhwZfOHJjQ0W9jMEVxG', 12121212, 'user', NULL, '2024-11-18 00:39:27', '2024-11-18 00:39:27'),
(13, 'agustino', 'agustincapoeira@gmail.com', NULL, '$2y$12$8LAYR4d0g1X9bRu7cbJp4.12yG9riFZPO2DvOipaVAig2bnNfvLc2', 12121212, 'user', NULL, '2024-11-19 06:36:40', '2024-11-19 06:36:40'),
(14, 'agustino', 'agustin4234@mail.com', NULL, '$2y$12$m5x4wSJtuuEH0.QLuBcULuNz6FtkFN0LYcspxytAEJbpcoNTVmlti', 12312312, 'user', NULL, '2024-11-19 06:51:59', '2024-11-19 06:51:59'),
(15, 'asdas', 'asdasd@dasd', NULL, '$2y$12$AAXIRxjBtF4S2ifN6royMekUHw06lweqSvB5h57Tpy6jyg4ozIENm', 11111111, 'user', NULL, '2024-11-19 07:00:10', '2024-11-19 07:00:10'),
(16, 'asdsa', 'asd@dasda', NULL, '$2y$12$kFy7ZEJBdx1ctDsXez9UgejbwPxjTHRuwbDaZ75dlZYMqxdAJh43K', 12312312, 'user', NULL, '2024-11-19 07:04:55', '2024-11-19 07:04:55'),
(17, 'agustino', 'agustin1@mail.com', NULL, '$2y$12$9OosDFywuBtBhlYzT2dyD.GgBdD1YkKiFUsAIkp2uMSvPRPX.x43a', 12121212, 'user', NULL, '2024-11-20 09:16:26', '2024-11-20 09:16:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha_venta` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre_vendedor` varchar(255) DEFAULT NULL,
  `nombre_cliente` varchar(255) DEFAULT NULL,
  `rut_cliente` int(11) DEFAULT NULL,
  `numero_cliente` int(11) DEFAULT NULL,
  `email_cliente` varchar(255) DEFAULT NULL,
  `subtotal` int(11) NOT NULL,
  `tipo_pago_id` bigint(20) UNSIGNED NOT NULL,
  `descuento` int(11) DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `monto_pagado` int(11) DEFAULT NULL,
  `estado_pago` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha_venta`, `nombre_vendedor`, `nombre_cliente`, `rut_cliente`, `numero_cliente`, `email_cliente`, `subtotal`, `tipo_pago_id`, `descuento`, `nota`, `monto_pagado`, `estado_pago`, `total`, `created_at`, `updated_at`) VALUES
(1, '2024-11-13 10:31:36', 'nombre vendedor', 'Carlos cortez', 208793772, 64353493, 'carlozy384@gmail.com', 32000, 3, 0, NULL, 32000, 1, 32000, '2024-11-13 10:31:36', '2024-11-13 10:31:36'),
(2, '2024-11-22 02:09:20', 'nombre vendedor', 'Maria bahamondes', 206042974, 98279384, 'maria@gmail.com', 170000, 3, 0, 'Deuda', 100000, 1, 170000, '2024-11-13 10:32:55', '2024-11-22 05:09:20'),
(3, '2024-11-14 22:26:48', 'nombre vendedor', 'carlos', 208793772, 64353493, 'carlos@gmail.com', 12000, 3, NULL, 'asdasda', 6000, 1, 12000, '2024-11-15 01:20:01', '2024-11-15 01:26:48'),
(4, '2024-11-17 21:34:31', 'nombre vendedor', 'agustin', 202965504, 12121212, 'agustin@mail.com', 12000, 1, 0, 'registrara deuda', 10000, 1, 12000, '2024-11-18 00:30:25', '2024-11-18 00:34:31'),
(5, '2024-11-20 04:56:00', 'nombre vendedor', 'juanito', 202965504, 98989898, 'agusti@mail.com', 60000, 1, 10, 'deuda de 14 lucas v', 40000, 0, 54000, '2024-11-20 04:56:00', '2024-11-20 04:56:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_pedidos_pedido_id_foreign` (`pedido_id`),
  ADD KEY `detalle_pedidos_tipo_pago_id_foreign` (`tipo_pago_id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_ventas_venta_id_foreign` (`venta_id`),
  ADD KEY `detalle_ventas_id_producto_foreign` (`id_producto`);

--
-- Indices de la tabla `detalle_web`
--
ALTER TABLE `detalle_web`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalle_web_id_producto_foreign` (`id_producto`);

--
-- Indices de la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deudas_venta_id_foreign` (`venta_id`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagos_deuda_id_foreign` (`deuda_id`),
  ADD KEY `pagos_tipo_pago_id_foreign` (`tipo_pago_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidos_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presentacion_id_categoria_foreign` (`id_categoria`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `producto_codigo_unique` (`codigo`),
  ADD KEY `producto_id_especie_foreign` (`id_especie`),
  ADD KEY `producto_id_unidad_foreign` (`id_unidad`),
  ADD KEY `producto_id_presentacion_foreign` (`id_presentacion`),
  ADD KEY `producto_id_categoria_foreign` (`id_categoria`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo_pago_nombre_unique` (`nombre`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_tipo_pago_id_foreign` (`tipo_pago_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_web`
--
ALTER TABLE `detalle_web`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `deudas`
--
ALTER TABLE `deudas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `presentacion`
--
ALTER TABLE `presentacion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedidos`
--
ALTER TABLE `detalle_pedidos`
  ADD CONSTRAINT `detalle_pedidos_pedido_id_foreign` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `detalle_pedidos_tipo_pago_id_foreign` FOREIGN KEY (`tipo_pago_id`) REFERENCES `tipo_pago` (`id`);

--
-- Filtros para la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD CONSTRAINT `detalle_ventas_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_ventas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_web`
--
ALTER TABLE `detalle_web`
  ADD CONSTRAINT `detalle_web_id_producto_foreign` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `deudas`
--
ALTER TABLE `deudas`
  ADD CONSTRAINT `deudas_venta_id_foreign` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_deuda_id_foreign` FOREIGN KEY (`deuda_id`) REFERENCES `deudas` (`id`),
  ADD CONSTRAINT `pagos_tipo_pago_id_foreign` FOREIGN KEY (`tipo_pago_id`) REFERENCES `tipo_pago` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `presentacion`
--
ALTER TABLE `presentacion`
  ADD CONSTRAINT `presentacion_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_id_categoria_foreign` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `producto_id_especie_foreign` FOREIGN KEY (`id_especie`) REFERENCES `especie` (`id`),
  ADD CONSTRAINT `producto_id_presentacion_foreign` FOREIGN KEY (`id_presentacion`) REFERENCES `presentacion` (`id`),
  ADD CONSTRAINT `producto_id_unidad_foreign` FOREIGN KEY (`id_unidad`) REFERENCES `unidad` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_tipo_pago_id_foreign` FOREIGN KEY (`tipo_pago_id`) REFERENCES `tipo_pago` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
