-- ph... SQLINES DEMO ***
-- ve... SQLINES DEMO ***
-- SQLINES DEMO *** admin.net/
--
-- Se... SQLINES DEMO ***
-- SQLINES DEMO *** ión: 03-12-2024 a las 02:02:32
-- SQLINES DEMO *** idor: 10.4.32-MariaDB
-- SQLINES DEMO *** 8.2.12

/* SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; */
START TRANSACTION;
time_zone := "+00:00";


/* SQLINES DEMO *** ARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/* SQLINES DEMO *** ARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/* SQLINES DEMO *** LLATION_CONNECTION=@@COLLATION_CONNECTION */;
/* SQLINES DEMO *** tf8mb4 */;

--
-- SQLINES DEMO *** ealthpet`
--

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `cache`
--

-- SQLINES FOR EVALUATION USE ONLY (14 DAYS)
CREATE TABLE cache (
  key varchar(255) NOT NULL,
  value mediumtext NOT NULL,
  expiration int NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `cache_locks`
--

CREATE TABLE cache_locks (
  key varchar(255) NOT NULL,
  owner varchar(255) NOT NULL,
  expiration int NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `categoria`
--

CREATE TABLE categoria (
  id bigint CHECK (id > 0) NOT NULL,
  nombre varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `categoria`
--

INSERT INTO categoria (id, nombre, created_at, updated_at) VALUES
(1, 'Medicamento', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'Alimento', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 'Accesorio', '2024-11-13 05:55:56', '2024-11-13 05:55:56');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `detalle_pedidos`
--

CREATE TABLE detalle_pedidos (
  id bigint CHECK (id > 0) NOT NULL,
  pedido_id bigint CHECK (pedido_id > 0) NOT NULL,
  id_producto bigint CHECK (id_producto > 0) NOT NULL,
  cantidad int NOT NULL,
  precio int NOT NULL,
  subtotal int NOT NULL,
  descuento int DEFAULT NULL,
  tipo_pago_id bigint CHECK (tipo_pago_id > 0) NOT NULL,
  nota varchar(255) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `detalle_pedidos`
--

INSERT INTO detalle_pedidos (id, pedido_id, id_producto, cantidad, precio, subtotal, descuento, tipo_pago_id, nota, created_at, updated_at) VALUES
(1, 1, 57, 1, 43750, 33875, 21875, 3, '', '2024-11-13 10:35:01', '2024-11-13 10:35:01'),
(2, 1, 47, 1, 12000, 33875, 0, 3, '', '2024-11-13 10:35:01', '2024-11-13 10:35:01'),
(3, 2, 50, 2, 22500, 45000, 0, 3, '2', '2024-11-16 06:05:53', '2024-11-16 06:05:53'),
(4, 3, 48, 1, 13000, 13000, 0, 3, '', '2024-11-21 22:05:45', '2024-11-21 22:05:45'),
(5, 4, 48, 1, 13000, 13000, 0, 3, '', '2024-11-22 02:12:18', '2024-11-22 02:12:18'),
(6, 5, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 06:22:11', '2024-11-22 06:22:11'),
(7, 6, 51, 1, 47500, 47500, 0, 3, '', '2024-11-22 06:33:42', '2024-11-22 06:33:42'),
(8, 7, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 21:49:25', '2024-11-22 21:49:25'),
(9, 8, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 21:58:33', '2024-11-22 21:58:33'),
(10, 9, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:00:30', '2024-11-22 22:00:30'),
(11, 10, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:07:09', '2024-11-22 22:07:09'),
(12, 11, 51, 1, 47500, 47500, 0, 3, '2', '2024-11-22 22:09:48', '2024-11-22 22:09:48'),
(13, 12, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:14:14', '2024-11-22 22:14:14'),
(14, 13, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:18:34', '2024-11-22 22:18:34'),
(15, 14, 51, 1, 47500, 47500, 0, 3, '', '2024-11-22 22:20:17', '2024-11-22 22:20:17'),
(16, 15, 51, 1, 47500, 47500, 0, 3, '', '2024-11-22 22:21:18', '2024-11-22 22:21:18'),
(17, 16, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:23:48', '2024-11-22 22:23:48'),
(18, 17, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:28:37', '2024-11-22 22:28:37'),
(19, 18, 50, 1, 22500, 22500, 0, 3, '', '2024-11-22 22:30:05', '2024-11-22 22:30:05'),
(20, 19, 50, 1, 22500, 22500, 0, 3, '', '2024-11-23 00:12:17', '2024-11-23 00:12:17'),
(21, 20, 50, 1, 22500, 22500, 0, 3, '', '2024-11-23 00:17:13', '2024-11-23 00:17:13'),
(22, 21, 51, 1, 47500, 47500, 0, 3, '', '2024-11-23 00:20:10', '2024-11-23 00:20:10'),
(23, 22, 50, 1, 22500, 22500, 0, 3, '', '2024-11-23 00:21:52', '2024-11-23 00:21:52'),
(24, 23, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:25:00', '2024-11-23 00:25:00'),
(25, 24, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:26:00', '2024-11-23 00:26:00'),
(26, 25, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:27:05', '2024-11-23 00:27:05'),
(27, 26, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:31:27', '2024-11-23 00:31:27'),
(28, 27, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:38:15', '2024-11-23 00:38:15'),
(29, 28, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:43:12', '2024-11-23 00:43:12'),
(30, 29, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 00:43:13', '2024-11-23 00:43:13'),
(31, 30, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 01:09:16', '2024-11-23 01:09:16'),
(32, 31, 48, 2, 13000, 26000, 0, 3, '', '2024-11-23 01:48:48', '2024-11-23 01:48:48'),
(33, 32, 50, 1, 22500, 22500, 0, 3, '', '2024-11-23 02:10:58', '2024-11-23 02:10:58'),
(34, 33, 58, 1, 13750, 13750, 0, 3, '', '2024-11-23 02:15:58', '2024-11-23 02:15:58'),
(35, 34, 58, 1, 13750, 13750, 0, 3, '', '2024-11-23 02:18:55', '2024-11-23 02:18:55'),
(36, 35, 50, 2, 22500, 45000, 0, 3, '', '2024-11-23 02:19:58', '2024-11-23 02:19:58'),
(37, 36, 48, 1, 13000, 13000, 0, 3, '', '2024-11-23 02:28:32', '2024-11-23 02:28:32'),
(38, 37, 48, 1, 13000, 13000, 0, 3, 'qasdqw', '2024-11-23 02:35:21', '2024-11-23 02:35:21');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `detalle_ventas`
--

CREATE TABLE detalle_ventas (
  id bigint CHECK (id > 0) NOT NULL,
  venta_id bigint CHECK (venta_id > 0) NOT NULL,
  id_producto bigint CHECK (id_producto > 0) NOT NULL,
  tipo_venta varchar(255) NOT NULL,
  id_presentacion int DEFAULT NULL,
  cantidad int NOT NULL,
  precio_unitario int NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `detalle_ventas`
--

INSERT INTO detalle_ventas (id, venta_id, id_producto, tipo_venta, id_presentacion, cantidad, precio_unitario, created_at, updated_at) VALUES
(3, 2, 36, 'completo', 1, 3, 30000, '2024-11-13 10:32:55', '2024-11-13 10:32:55'),
(4, 2, 13, 'completo', 1, 1, 80000, '2024-11-13 10:32:55', '2024-11-13 10:32:55'),
(5, 1, 1, 'completo', 1, 1, 12000, '2024-11-21 03:48:49', '2024-11-21 03:48:49'),
(6, 1, 54, 'completo', 1, 1, 20000, '2024-11-21 03:48:49', '2024-11-21 03:48:49'),
(7, 1, 1, 'completo', 1, 1, 12000, '2024-11-21 03:48:49', '2024-11-21 03:48:49');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `detalle_web`
--

CREATE TABLE detalle_web (
  id bigint CHECK (id > 0) NOT NULL,
  id_producto bigint CHECK (id_producto > 0) NOT NULL,
  marca varchar(255) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL,
  contenido_neto decimal(8,2) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `detalle_web`
--

INSERT INTO detalle_web (id, id_producto, marca, descripcion, contenido_neto, created_at, updated_at) VALUES
(1, 58, 'Feliz', 'Alimento para gatos con problemas de obesidad', 85.00, '2024-11-13 09:20:12', '2024-11-13 09:20:12'),
(2, 47, 'Kong Classic', 'Jueguete para perro adulto', 1.00, '2024-11-13 09:23:00', '2024-11-23 01:12:12'),
(4, 48, 'Kong Classic', 'juguete', 1.00, '2024-11-13 10:24:46', '2024-11-13 10:24:46'),
(5, 50, 'HILLS C/D', 'HILLS C/D PERRO 3 KG', 3.00, '2024-11-13 10:25:28', '2024-11-13 10:25:28'),
(6, 51, 'HILLS C/D', 'HILLS C/D PERRO 3 KG', 3.00, '2024-11-13 10:26:02', '2024-11-13 10:26:02'),
(7, 52, 'HILLS C/D', 'HILLS C/D GATO 1,5 KG', 2.00, '2024-11-13 10:26:49', '2024-11-13 10:26:49'),
(8, 53, 'HILLS C/D', 'HILLS C/D GATO 8 KG', 8.00, '2024-11-13 10:27:25', '2024-11-13 10:27:25'),
(9, 54, 'ROYAL CANIN', 'ROYAL CANIN GATO 1,5 KG', 2.00, '2024-11-13 10:28:09', '2024-11-13 10:28:09'),
(10, 57, 'ROYAL CANIN', 'ROYAL CANIN PERRO 7,5 KG', 8.00, '2024-11-13 10:29:09', '2024-11-13 10:29:09');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `deudas`
--

CREATE TABLE deudas (
  id bigint CHECK (id > 0) NOT NULL,
  venta_id bigint CHECK (venta_id > 0) NOT NULL,
  monto_adeudado int NOT NULL,
  estado smallint NOT NULL DEFAULT 0,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `deudas`
--

INSERT INTO deudas (id, venta_id, monto_adeudado, estado, created_at, updated_at) VALUES
(1, 2, 0, 1, '2024-11-13 10:32:55', '2024-11-23 01:14:05'),
(2, 1, 0, 1, '2024-11-21 03:48:49', '2024-11-21 03:52:55');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `especie`
--

CREATE TABLE especie (
  id bigint CHECK (id > 0) NOT NULL,
  nombre varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `especie`
--

INSERT INTO especie (id, nombre, created_at, updated_at) VALUES
(1, 'Perro', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'Gato', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 'Otro', '2024-11-13 05:55:56', '2024-11-13 05:55:56');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `failed_jobs`
--

CREATE TABLE failed_jobs (
  id bigint CHECK (id > 0) NOT NULL,
  uuid varchar(255) NOT NULL,
  connection text NOT NULL,
  queue text NOT NULL,
  payload text NOT NULL,
  exception text NOT NULL,
  failed_at timestamp(0) NOT NULL DEFAULT current_timestamp()
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `jobs`
--

CREATE TABLE jobs (
  id bigint CHECK (id > 0) NOT NULL,
  queue varchar(255) NOT NULL,
  payload text NOT NULL,
  attempts smallint CHECK (attempts > 0) NOT NULL,
  reserved_at int CHECK (reserved_at > 0) DEFAULT NULL,
  available_at int CHECK (available_at > 0) NOT NULL,
  created_at int CHECK (created_at > 0) NOT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `job_batches`
--

CREATE TABLE job_batches (
  id varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  total_jobs int NOT NULL,
  pending_jobs int NOT NULL,
  failed_jobs int NOT NULL,
  failed_job_ids text NOT NULL,
  options mediumtext DEFAULT NULL,
  cancelled_at int DEFAULT NULL,
  created_at int NOT NULL,
  finished_at int DEFAULT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `migrations`
--

CREATE TABLE migrations (
  id int CHECK (id > 0) NOT NULL,
  migration varchar(255) NOT NULL,
  batch int NOT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `migrations`
--

INSERT INTO migrations (id, migration, batch) VALUES
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

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `pagos`
--

CREATE TABLE pagos (
  id bigint CHECK (id > 0) NOT NULL,
  deuda_id bigint CHECK (deuda_id > 0) NOT NULL,
  monto_pagado int NOT NULL,
  monto_restante int NOT NULL,
  tipo_pago_id bigint CHECK (tipo_pago_id > 0) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `pagos`
--

INSERT INTO pagos (id, deuda_id, monto_pagado, monto_restante, tipo_pago_id, created_at, updated_at) VALUES
(1, 1, 100000, 70000, 3, '2024-11-13 10:32:55', '2024-11-13 10:32:55'),
(2, 1, 10000, 60000, 3, '2024-11-13 10:33:21', '2024-11-13 10:33:21'),
(3, 2, 120000, -108000, 3, '2024-11-21 03:52:13', '2024-11-21 03:52:13'),
(4, 2, 120000, -228000, 3, '2024-11-21 03:52:37', '2024-11-21 03:52:37'),
(5, 2, 228000, -456000, 3, '2024-11-21 03:52:55', '2024-11-21 03:52:55'),
(6, 3, 20000, 21000, 3, '2024-11-22 00:11:25', '2024-11-22 00:11:25'),
(7, 1, 60000, 0, 3, '2024-11-23 01:14:05', '2024-11-23 01:14:05');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `password_reset_tokens`
--

CREATE TABLE password_reset_tokens (
  email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL
) ;

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `pedidos`
--

CREATE TABLE pedidos (
  id bigint CHECK (id > 0) NOT NULL,
  user_id bigint CHECK (user_id > 0) DEFAULT NULL,
  nombre_cliente varchar(255) NOT NULL,
  email_cliente varchar(255) NOT NULL,
  telefono_cliente varchar(255) NOT NULL,
  estado_pedido int NOT NULL,
  total int NOT NULL,
  monto_pagado int DEFAULT NULL,
  estado_pago int DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `pedidos`
--

INSERT INTO pedidos (id, user_id, nombre_cliente, email_cliente, telefono_cliente, estado_pedido, total, monto_pagado, estado_pago, created_at, updated_at) VALUES
(1, NULL, 'Agustin Rodriguez', 'ag.rodriguez@gmail.com', '+56993804823', 4, 55750, 33875, 1, '2024-11-13 10:35:01', '2024-11-23 01:14:51'),
(2, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 0, 45000, 45000, 0, '2024-11-16 06:05:53', '2024-11-16 06:05:53'),
(3, NULL, 'perro', 'kanye@gmail.com', '+56911111111', 2, 13000, 13000, 2, '2024-11-21 22:05:45', '2024-11-22 02:11:47'),
(4, NULL, 'elcarlo', 'asdas@gmail.com', '+56911111111', 2, 13000, 13000, 2, '2024-11-22 02:12:18', '2024-11-22 02:12:46'),
(5, 12, 'Carlos', 'ca.cortez@duocuc.cl', '64353493', 2, 22500, 22500, 2, '2024-11-22 06:22:11', '2024-11-22 06:22:42'),
(6, 12, 'Carlos', 'ca.cortez@duocuc.cl', '64353493', 2, 47500, 47500, 2, '2024-11-22 06:33:42', '2024-11-22 06:34:12'),
(7, NULL, 'Carlos Manolo', 'ca.cortez@duocuc.cl', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 21:49:25', '2024-11-22 21:50:01'),
(8, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 21:58:33', '2024-11-22 21:58:57'),
(9, NULL, 'peo', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 22:00:30', '2024-11-22 22:01:08'),
(10, NULL, 'carloooos', 'ca.cortez@duocuc.cl', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 22:07:09', '2024-11-22 22:07:32'),
(11, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 47500, 47500, 2, '2024-11-22 22:09:48', '2024-11-22 22:10:27'),
(12, NULL, 'asdasd', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 22:14:14', '2024-11-22 22:14:35'),
(13, NULL, 'perro', 'ca.cortez@duocuc.cl', '+56911111111', 2, 22500, 22500, 2, '2024-11-22 22:18:34', '2024-11-22 22:18:55'),
(14, NULL, 'perro', 'ca.cortez@duocuc.cl', '+56964353493', 2, 47500, 47500, 2, '2024-11-22 22:20:17', '2024-11-22 22:20:36'),
(15, NULL, 'peo', 'ca.cortez@duocuc.cl', '+56964353493', 2, 47500, 47500, 2, '2024-11-22 22:21:18', '2024-11-22 22:21:54'),
(16, NULL, 'Producto de prueba', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 22:23:48', '2024-11-22 22:24:15'),
(17, NULL, 'peo', 'ca.cortez@duocuc.cl', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 22:28:37', '2024-11-22 22:29:00'),
(18, NULL, 'peo', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-22 22:30:05', '2024-11-22 22:30:29'),
(19, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 0, 22500, 22500, 0, '2024-11-23 00:12:17', '2024-11-23 00:12:17'),
(20, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-23 00:17:13', '2024-11-23 00:18:13'),
(21, NULL, 'peo', 'kanye@gmail.com', '+56964353493', 2, 47500, 47500, 2, '2024-11-23 00:20:10', '2024-11-23 00:20:31'),
(22, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-23 00:21:52', '2024-11-23 00:22:14'),
(23, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 00:25:00', '2024-11-23 00:25:19'),
(24, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 00:26:00', '2024-11-23 00:26:18'),
(25, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 00:27:05', '2024-11-23 00:27:32'),
(26, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 00:31:27', '2024-11-23 00:31:46'),
(27, NULL, 'peo', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 00:38:15', '2024-11-23 00:38:35'),
(28, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 0, 13000, 13000, 0, '2024-11-23 00:43:12', '2024-11-23 00:43:12'),
(29, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 00:43:13', '2024-11-23 00:43:38'),
(30, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 0, 13000, 13000, 0, '2024-11-23 01:09:16', '2024-11-23 01:09:16'),
(31, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 26000, 26000, 2, '2024-11-23 01:48:48', '2024-11-23 01:49:09'),
(32, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 22500, 22500, 2, '2024-11-23 02:10:58', '2024-11-23 02:11:21'),
(33, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13750, 13750, 2, '2024-11-23 02:15:58', '2024-11-23 02:16:21'),
(34, NULL, 'perro', 'kanye@gmail.com', '+56964353493', 2, 13750, 13750, 2, '2024-11-23 02:18:55', '2024-11-23 02:19:15'),
(35, NULL, 'peo', 'ca.cortez@duocuc.cl', '+56964353493', 2, 45000, 45000, 2, '2024-11-23 02:19:58', '2024-11-23 02:20:27'),
(36, NULL, 'perro', 'ca.cortez@duocuc.cl', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 02:28:32', '2024-11-23 02:28:54'),
(37, NULL, 'Producto de prueba', 'kanye@gmail.com', '+56964353493', 2, 13000, 13000, 2, '2024-11-23 02:35:21', '2024-11-23 02:35:50');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `presentacion`
--

CREATE TABLE presentacion (
  id bigint CHECK (id > 0) NOT NULL,
  id_categoria bigint CHECK (id_categoria > 0) NOT NULL,
  nombre varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `presentacion`
--

INSERT INTO presentacion (id, id_categoria, nombre, created_at, updated_at) VALUES
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

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `producto`
--

CREATE TABLE producto (
  id bigint CHECK (id > 0) NOT NULL,
  nombre varchar(255) NOT NULL,
  imagen varchar(255) DEFAULT NULL,
  descripcion varchar(255) DEFAULT NULL,
  codigo int NOT NULL,
  precio_de_compra int NOT NULL,
  precio_de_venta int NOT NULL,
  precio_fraccionado int DEFAULT NULL,
  id_especie bigint CHECK (id_especie > 0) DEFAULT NULL,
  id_unidad bigint CHECK (id_unidad > 0) DEFAULT NULL,
  id_presentacion bigint CHECK (id_presentacion > 0) DEFAULT NULL,
  id_categoria bigint CHECK (id_categoria > 0) DEFAULT NULL,
  stock_unidades int DEFAULT NULL,
  stock_total_ml int DEFAULT NULL,
  ml_por_unidad int DEFAULT NULL,
  stock_total_comprimidos int DEFAULT NULL,
  comprimidos_por_caja int DEFAULT NULL,
  vende_a_granel smallint NOT NULL DEFAULT 0,
  unidades_por_envase int DEFAULT NULL,
  unidades_granel_total int DEFAULT NULL,
  mostrar_web smallint NOT NULL DEFAULT 0,
  fecha_de_vencimiento timestamp(0) NULL DEFAULT NULL,
  cantidad_minima_requerida int DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `producto`
--

INSERT INTO producto (id, nombre, imagen, descripcion, codigo, precio_de_compra, precio_de_venta, precio_fraccionado, id_especie, id_unidad, id_presentacion, id_categoria, stock_unidades, stock_total_ml, ml_por_unidad, stock_total_comprimidos, comprimidos_por_caja, vende_a_granel, unidades_por_envase, unidades_granel_total, mostrar_web, fecha_de_vencimiento, cantidad_minima_requerida, created_at, updated_at) VALUES
(1, 'alerdrag', NULL, 'Antihistamínico para mascotas', 1001, 9600, 12000, 0, 1, 2, 1, 1, 15, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 10, '2024-11-13 08:20:05', '2024-11-21 04:02:55'),
(5, 'APOQUEL 3,6', NULL, 'Medicamento para el alivio de la dermatitis alérgica', 1005, 32800, 41000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', 3, '2024-11-13 09:04:11', '2024-11-23 01:05:21'),
(6, 'APOQUEL 16', NULL, 'Medicamento para el alivio de la dermatitis alérgica', 1006, 39200, 49000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', 3, '2024-11-13 09:04:11', '2024-11-13 09:04:11'),
(7, 'APOQUEL 5,4', NULL, 'Medicamento para el alivio de la dermatitis alérgica', 1007, 36000, 45000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', 3, '2024-11-13 09:04:11', '2024-11-13 09:04:11'),
(8, 'AEROCAMARA CAJA BLANCA', NULL, 'Dispositivo de administración para inhaladores', 1008, 9600, 12000, NULL, 1, 4, 1, 1, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-08-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(9, 'AEROCAMARA CAJA CELESTE', NULL, 'Dispositivo de administración para inhaladores', 1009, 4000, 5000, NULL, 1, 4, 1, 1, 1, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-08-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(10, 'APETICAT', NULL, 'Estimulante del apetito para gatos', 1010, 9600, 12000, NULL, 2, 2, 1, 1, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(11, 'APETIPET', NULL, 'Estimulante del apetito para mascotas', 1011, 8640, 10800, NULL, 1, 2, 1, 1, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-06-01 08:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(12, 'ARTRITAB', NULL, 'Suplemento para el alivio de la artritis en mascotas', 1012, 29520, 36900, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-12-01 07:46:34', NULL, '2024-11-13 08:20:05', '2024-11-13 08:20:05'),
(13, 'AVENTI CKD CANINE POLVO', NULL, 'Suplemento para soporte renal en perros', 1013, 64000, 80000, NULL, 1, 2, 1, 1, 21, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-01-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-21 03:49:26'),
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
(34, 'ENROFLOXACINA 100 MG', NULL, 'Antibiótico de amplio espectro para infecciones bacterianas', 1034, 9600, 12000, NULL, 1, 2, 1, 1, 50, NULL, NULL, 100, NULL, 0, NULL, NULL, 0, '2026-01-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(35, 'EQUILAC SHAMPOO 500 ML', NULL, 'Shampoo especializado para el cuidado de la piel de caballos', 1035, 15200, 19000, NULL, 3, 4, 1, 1, 20, NULL, 500, NULL, NULL, 0, NULL, NULL, 0, '2026-03-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(36, 'EQUIPUR MAGNESIUM', NULL, 'Suplemento mineral para la relajación muscular en caballos', 1036, 24000, 30000, NULL, 3, 2, 1, 1, 18, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-05-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-21 03:49:26'),
(37, 'FIPROX 67 MG', NULL, 'Antiparasitario externo en pipetas para gatos', 1037, 10400, 13000, NULL, 2, 3, 1, 1, 10, NULL, NULL, 67, NULL, 0, NULL, NULL, 0, '2025-08-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(38, 'FORTIFLEX 375', NULL, 'Condroprotector para el soporte articular en perros de tamaño mediano', 1038, 23200, 29000, NULL, 1, 2, 1, 1, 20, NULL, NULL, 375, NULL, 0, NULL, NULL, 0, '2026-04-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(39, 'FORTIFLEX 525', NULL, 'Condroprotector para el soporte articular en perros de gran tamaño', 1039, 28000, 35000, NULL, 1, 2, 1, 1, 20, NULL, NULL, 525, NULL, 0, NULL, NULL, 0, '2026-04-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(40, 'GABAPENTINA 50 MG', NULL, 'Analgésico y anticonvulsivante para el manejo del dolor en perros', 1040, 7200, 9000, NULL, 1, 2, 1, 1, 30, NULL, NULL, 50, NULL, 0, NULL, NULL, 0, '2025-12-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(41, 'GABAPENTINA 100 MG', NULL, 'Analgésico y anticonvulsivante para el manejo del dolor en perros', 1041, 10400, 13000, NULL, 1, 2, 1, 1, 30, NULL, NULL, 100, NULL, 0, NULL, NULL, 0, '2025-12-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(42, 'HEPATO PROTECT', NULL, 'Suplemento para soporte hepático en perros y gatos', 1042, 21600, 27000, NULL, 1, 2, 1, 1, 15, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2026-02-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(43, 'HIPERMUNE', NULL, 'Inmunoestimulante para mejorar las defensas naturales en mascotas', 1043, 17600, 22000, NULL, 1, 2, 1, 1, 30, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-12-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(44, 'ICOFEN 20 MG', NULL, 'Antihelmíntico para el control de parásitos internos en perros y gatos', 1044, 3200, 4000, NULL, 1, 3, 1, 1, 100, NULL, NULL, 20, NULL, 0, NULL, NULL, 0, '2025-10-01 06:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(45, 'IMIDAFLEA SPRAY 250 ML', NULL, 'Antiparasitario externo en spray para perros y gatos', 1045, 10400, 13000, NULL, 1, 3, 1, 1, 5, NULL, 250, NULL, NULL, 0, NULL, NULL, 0, '2025-09-01 07:00:00', NULL, '2024-11-13 09:20:05', '2024-11-13 09:20:05'),
(47, 'kong classic talla xl', 'productos/1731482653_D_NQ_NP_738019-MLC45426898216_042021-O.jpg', 'Juguete para perros, diseñado para morder y rellenar con premios', 1047, 9600, 12000, 0, 1, NULL, 7, 3, 20, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, NULL, 10, '2024-11-13 09:20:05', '2024-11-23 01:12:12'),
(48, 'kong classic talla l', 'productos/1731482686_D_NQ_NP_738019-MLC45426898216_042021-O.jpg', 'Juguete para perros, diseñado para morder y rellenar con premios', 1048, 10400, 13000, 0, 1, 5, 1, 1, 38, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-23 02:35:50'),
(49, 'enrofloxacina 50 mg', NULL, 'Antibiótico para infecciones bacterianas en perros y gatos', 10674, 5000, 6250, 0, 1, 2, 1, 1, 100, NULL, NULL, 0, NULL, 0, NULL, NULL, 0, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 09:16:49'),
(50, 'hills c/d perro 3 kg', 'productos/1731482727_Hills-CD-Urinary-Care-Perro-3.85-Kg.jpg', 'Alimento veterinario para perros con problemas urinarios', 1567, 18000, 22500, 0, 2, 3, 1, 1, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 5, '2024-11-13 09:20:05', '2024-11-23 02:43:39'),
(51, 'hills c/d perro 7,5 kg', 'productos/1731482762_Hills-CD-Urinary-Care-Perro-3.85-Kg.jpg', 'Alimento veterinario para perros con problemas urinarios', 185, 38000, 47500, 0, 2, 3, 1, 1, 10, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-23 00:20:31'),
(52, 'hills c/d gato 1,5 kg', 'productos/1731482809_Hills-cd-Urinary-Care-Felino-3.jpg', 'Alimento veterinario para gatos con problemas urinarios', 1854, 15000, 18750, 0, 2, 3, 1, 1, 10, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:26:49'),
(53, 'hills c/d gato 3,5 kg', 'productos/1731482845_Hills-cd-Urinary-Care-Felino-3.jpg', 'Alimento veterinario para gatos con problemas urinarios', 33456, 29000, 36250, 0, 2, 3, 1, 1, 10, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:27:25'),
(54, 'royal canin gato 1,5 kg', 'productos/1731482889_Royal-Canin-Kitten-Sterilised-3.5Kg-_F_.jpg', 'Alimento veterinario para gatos con problemas digestivos', 3468, 16000, 20000, 0, 2, 3, 1, 1, 16, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-21 04:02:55'),
(57, 'royal canin perro 7,5 kg', 'productos/1731482949_7896181218937.png.jpg', 'Alimento veterinario para perros con problemas digestivos', 13489, 35000, 43750, 0, 2, 3, 1, 1, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-13 10:30:16'),
(58, 'felix classic con atún 85 gr', 'productos/1731482966_Alimento-humedo-gato-sensaciones-de-atun-en-salsa-85-g.jpg', 'Alimento para gatos con problemas de obesidad', 3422, 11000, 13750, 0, 2, 3, 4, 2, 18, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, NULL, 0, '2024-11-13 09:20:05', '2024-11-23 02:19:15');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `sessions`
--

CREATE TABLE sessions (
  id varchar(255) NOT NULL,
  user_id bigint CHECK (user_id > 0) DEFAULT NULL,
  ip_address varchar(45) DEFAULT NULL,
  user_agent text DEFAULT NULL,
  payload text NOT NULL,
  last_activity int NOT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `sessions`
--

INSERT INTO sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES
('yZaEpoRg32aQ3xtmkd95WVf8Qbk9eSy4ltkjU0nD', 11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidXlIN0Z2VU40QVhYWlVFYVpUekJNb1RpYURoQ08xdDh1dDYydDBTdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTE7fQ==', 1733177492);

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `tipo_pago`
--

CREATE TABLE tipo_pago (
  id bigint CHECK (id > 0) NOT NULL,
  nombre varchar(255) NOT NULL,
  descripcion text DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `tipo_pago`
--

INSERT INTO tipo_pago (id, nombre, descripcion, created_at, updated_at) VALUES
(1, 'Efectivo', 'Pago en efectivo', NULL, NULL),
(2, 'Tarjeta de Crédito', 'Pago con tarjeta de crédito', NULL, NULL),
(3, 'Tarjeta de Débito', 'Pago con tarjeta de débito', NULL, NULL),
(4, 'Transferencia Bancaria', 'Pago mediante transferencia bancaria', NULL, NULL);

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `unidad`
--

CREATE TABLE unidad (
  id bigint CHECK (id > 0) NOT NULL,
  nombre varchar(255) NOT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `unidad`
--

INSERT INTO unidad (id, nombre, created_at, updated_at) VALUES
(1, 'miligramos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'gramos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(3, 'kilogramos', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(4, 'mililitros', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(5, 'litros', '2024-11-13 05:55:56', '2024-11-13 05:55:56');

-- SQLINES DEMO *** ---------------------------------------

--
-- SQLINES DEMO *** la para la tabla `users`
--

CREATE TABLE users (
  id bigint CHECK (id > 0) NOT NULL,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  email_verified_at timestamp(0) NULL DEFAULT NULL,
  password varchar(255) NOT NULL,
  movile int DEFAULT NULL,
  role varchar(255) NOT NULL DEFAULT 'user',
  remember_token varchar(100) DEFAULT NULL,
  created_at timestamp(0) NULL DEFAULT NULL,
  updated_at timestamp(0) NULL DEFAULT NULL
) ;

--
-- SQLINES DEMO *** para la tabla `users`
--

INSERT INTO users (id, name, email, email_verified_at, password, movile, role, remember_token, created_at, updated_at) VALUES
(1, 'Dr. Geovany Hintz', 'dion.tromp@example.org', '2024-11-13 05:55:55', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'editor', 'mNHa9qM3JD', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(2, 'Amara Kunde', 'zlarkin@example.net', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'user', '2Pl3sCHka2', '2024-11-13 05:55:56', '2024-11-23 01:15:40'),
(3, 'Kamryn O'Keefe', 'wrussel@example.com', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'current_user', '0lf26GlSYC', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(4, 'Monica Donnelly', 'sipes.imani@example.com', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'editor', 'A91aJsbsXR', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(5, 'Prof. Ariel Ledner', 'jose52@example.org', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'admin', 'X04tXVk0ky', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(6, 'Karina Sawayn I', 'doris38@example.com', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'current_user', 'poTkr3D5lT', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(7, 'Mr. Edwardo Windler Jr.', 'cole.jada@example.com', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'admin', 'LUbNRXba2C', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(8, 'Ruben Kling', 'nbernhard@example.net', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'editor', 's40ZBkAuAD', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(9, 'Dale Barton', 'sauer.roberto@example.net', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'admin', 'kzFQHSt3KC', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(10, 'Cecelia Flatley', 'idaugherty@example.net', '2024-11-13 05:55:56', '$2y$12$xoE3I9Z3/OQGmYRnlx0OaeeVbWQD82cZCVhb19xLWx7FuMokJDxY2', NULL, 'current_user', 'EQbIzjZW5W', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(11, 'Test Current_user', 'test@example.com', '2024-11-13 05:55:56', '$2y$12$N2abbkKXUt1OHwekk6UHMeOPdRpxyfqmQqDj0k2Xgw544adm9fREG', NULL, 'admin', 'vXiey8acyqHoQe7ddOyEhLMKGOo6AUADSN8soVofTU50w5ityR0CLiBupdHc', '2024-11-13 05:55:56', '2024-11-13 05:55:56'),
(12, 'Carlos', 'ca.cortez@duocuc.cl', NULL, '$2y$12$eG9FOR0W2rZv0olP.n2HauqKOxHIj5erIGfSKfZqFQURK1/RDp2DW', 64353493, 'current_user', 'GUzPpxiIqVdfu279YBBNb72Y314C5eJUoa3eWN5RulDxCC1GRez03Ksc6qSh', '2024-11-21 04:11:40', '2024-11-21 04:11:40');

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
(1, '2024-10-21 00:52:13', 'nombre vendedor', 'Carlos cortez', 208793772, 64353493, 'carlozy384@gmail.com', 44000, 2, 0, NULL, 32000, 1, 44000, '2024-11-21 03:48:49', '2024-11-21 03:52:13'),
(2, '2024-11-22 22:14:05', 'nombre vendedor', 'Maria bahamondes', 206042974, 98279384, 'maria@gmail.com', 170000, 3, 0, 'Deuda', 100000, 1, 170000, '2024-11-13 10:32:55', '2024-11-23 01:14:05'),
(3, '2024-08-21 20:04:49', 'nombre vendedor', 'Fernanda cerda', 208793772, 96435349, 'carlozy384@gmail.com', 10000, 3, 0, NULL, 10000, 1, 10000, '2024-11-21 22:04:49', '2024-11-21 22:04:49'),
(4, '2024-11-21 19:27:23', 'nombre vendedor', 'ksdfkd', 111111111, NULL, NULL, 10000, 3, 0, NULL, 10000, 1, 10000, '2024-11-21 22:27:23', '2024-11-21 22:27:23'