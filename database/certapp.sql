-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-04-2023 a las 06:26:25
-- Versión del servidor: 10.11.2-MariaDB
-- Versión de PHP: 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `certapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificados`
--

CREATE TABLE `certificados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consecutivo` varchar(100) NOT NULL,
  `tercero` bigint(20) UNSIGNED DEFAULT NULL,
  `equipo` bigint(20) UNSIGNED DEFAULT NULL,
  `competencia` bigint(20) UNSIGNED NOT NULL,
  `tipo` varchar(80) DEFAULT NULL,
  `capacidad` varchar(80) DEFAULT NULL,
  `datos` text DEFAULT NULL,
  `activo` binary(1) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `certificados`
--

INSERT INTO `certificados` (`id`, `consecutivo`, `tercero`, `equipo`, `competencia`, `tipo`, `capacidad`, `datos`, `activo`, `fecha_inicio`, `fecha_fin`, `created_at`, `updated_at`) VALUES
(2, 'SIG-CP-12-001', 2, NULL, 2, NULL, NULL, '{\"tercero\":{\"id\":2,\"nombres\":\"Brandon Yesid\",\"apellidos\":\"Joaqui Ojeda\",\"tipo_de_documento\":\"CC\",\"nid\":\"1107084473\",\"telefono\":\"3154016116\",\"correo\":\"brandonjoaqui@gmail.com\",\"direccion\":\"av7oe no 8-06\",\"fecha_nacimiento\":\"1994-09-13\",\"foto_carne\":\"1\",\"created_at\":\"2023-04-20T06:19:23.000000Z\",\"updated_at\":\"2023-04-25T01:39:57.000000Z\"},\"equipo\":null,\"competencia\":{\"id\":2,\"descripcion\":\"Operador de maquinaria para movimiento de tierra\",\"descripcion_corta\":\"Operador de maquinaria para movimiento de tierra\",\"ambito\":\"PERSONAS\",\"normatividad\":\"ISO\\/7130 2013\",\"esquema\":\"ESQ-CP-12\",\"activo\":1,\"created_at\":\"2023-04-20T18:58:59.000000Z\",\"updated_at\":\"2023-04-24T22:59:32.000000Z\"}}', 0x31, '2023-04-08', '2023-04-25', '2023-04-24 12:56:45', '2023-04-25 03:37:47'),
(3, 'SIG-CP-12-002', NULL, 1, 4, 'Minicargador', '1253kg', '{\"tercero\":null,\"equipo\":{\"id\":1,\"placa\":\"ekt30e\",\"serie\":null,\"descripcion\":\"qwesad asda\",\"capacidad\":\"12 t\",\"created_at\":\"2023-04-20T06:46:55.000000Z\",\"updated_at\":\"2023-04-25T05:26:46.000000Z\"},\"competencia\":{\"id\":4,\"descripcion\":\"Grua\",\"descripcion_corta\":\"grua\",\"ambito\":\"EQUIPOS\",\"normatividad\":\"asme 2016.9 numeral xxxx\",\"esquema\":\"ESQ-CP-13\",\"activo\":1,\"created_at\":\"2023-04-25T03:22:31.000000Z\",\"updated_at\":\"2023-04-25T03:22:31.000000Z\"}}', 0x31, '2023-04-08', '2023-04-25', '2023-04-24 12:56:45', '2023-04-25 05:27:01'),
(4, 'SIG-CP-12-001', 2, NULL, 2, 'Minicargador', '12 t', '{\"tercero\":{\"id\":2,\"nombres\":\"Brandon Yesid\",\"apellidos\":\"Joaqui Ojeda\",\"tipo_de_documento\":\"CC\",\"nid\":\"1107084473\",\"telefono\":\"3154016116\",\"correo\":\"brandonjoaqui@gmail.com\",\"direccion\":\"av7oe no 8-06\",\"fecha_nacimiento\":\"1994-09-13\",\"foto_carne\":\"1\",\"created_at\":\"2023-04-20T06:19:23.000000Z\",\"updated_at\":\"2023-04-25T01:39:57.000000Z\"},\"equipo\":null,\"competencia\":{\"id\":2,\"descripcion\":\"Operador de maquinaria para movimiento de tierra\",\"descripcion_corta\":\"Operador de maquinaria para movimiento de tierra\",\"ambito\":\"PERSONAS\",\"normatividad\":\"ISO\\/7130 2013\",\"esquema\":\"ESQ-CP-12\",\"activo\":1,\"created_at\":\"2023-04-20T18:58:59.000000Z\",\"updated_at\":\"2023-04-24T22:59:32.000000Z\"}}', 0x31, '2023-04-27', '2023-04-29', '2023-04-25 03:56:22', '2023-04-25 04:14:55'),
(5, 'SIG-CP-12-004', NULL, 3, 4, NULL, NULL, '{\"tercero\":null,\"equipo\":{\"id\":3,\"placa\":\"yml77e\",\"serie\":null,\"descripcion\":\"moto\",\"capacidad\":\"5t\",\"created_at\":\"2023-04-25T05:23:16.000000Z\",\"updated_at\":\"2023-04-25T05:23:16.000000Z\"},\"competencia\":{\"id\":4,\"descripcion\":\"Grua\",\"descripcion_corta\":\"grua\",\"ambito\":\"EQUIPOS\",\"normatividad\":\"asme 2016.9 numeral xxxx\",\"esquema\":\"ESQ-CP-13\",\"activo\":1,\"created_at\":\"2023-04-25T03:22:31.000000Z\",\"updated_at\":\"2023-04-25T03:22:31.000000Z\"}}', 0x31, '2023-04-25', '2023-04-26', '2023-04-25 05:23:47', '2023-04-25 05:23:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `id` bigint(20) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `descripcion_corta` varchar(200) DEFAULT NULL,
  `ambito` varchar(80) NOT NULL,
  `normatividad` text DEFAULT NULL,
  `esquema` text DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id`, `descripcion`, `descripcion_corta`, `ambito`, `normatividad`, `esquema`, `activo`, `created_at`, `updated_at`) VALUES
(2, 'Operador de maquinaria para movimiento de tierra', 'Operador de maquinaria para movimiento de tierra', 'PERSONAS', 'ISO/7130 2013', 'ESQ-CP-12', 1, '2023-04-20 18:58:59', '2023-04-24 22:59:32'),
(3, NULL, NULL, '', NULL, NULL, 1, '2023-04-24 12:39:48', '2023-04-24 12:39:48'),
(4, 'Grua', 'grua', 'EQUIPOS', 'asme 2016.9 numeral xxxx', 'ESQ-CP-13', 1, '2023-04-25 03:22:31', '2023-04-25 03:22:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `placa` varchar(80) DEFAULT NULL,
  `serie` varchar(80) DEFAULT NULL,
  `descripcion` varchar(120) NOT NULL,
  `capacidad` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `placa`, `serie`, `descripcion`, `capacidad`, `created_at`, `updated_at`) VALUES
(1, 'ekt30e', NULL, 'qwesad asda', '12 t', '2023-04-20 06:46:55', '2023-04-25 05:26:46'),
(2, NULL, NULL, 'Operador de grua montada sobre camión', NULL, '2023-04-20 07:08:10', '2023-04-20 07:08:10'),
(3, 'yml77e', NULL, 'moto', '5t', '2023-04-25 05:23:16', '2023-04-25 05:23:16');

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
-- Estructura de tabla para la tabla `media_files`
--

CREATE TABLE `media_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `path` text NOT NULL,
  `url` varchar(400) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `media_files`
--

INSERT INTO `media_files` (`id`, `path`, `url`, `created_at`, `updated_at`) VALUES
(1, '202304/41570j1dZwbJcKdMf69trX7GJwVGrI7v1QqGO8m6.jpg', 'http://certapp.dev.com:8080/mediafiles_storage/202304/41570j1dZwbJcKdMf69trX7GJwVGrI7v1QqGO8m6.jpg', '2023-04-24 22:18:22', '2023-04-24 22:18:22');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terceros`
--

CREATE TABLE `terceros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(80) NOT NULL,
  `tipo_de_documento` varchar(10) NOT NULL,
  `nid` varchar(20) NOT NULL,
  `telefono` varchar(120) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `foto_carne` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `terceros`
--

INSERT INTO `terceros` (`id`, `nombres`, `apellidos`, `tipo_de_documento`, `nid`, `telefono`, `correo`, `direccion`, `fecha_nacimiento`, `foto_carne`, `created_at`, `updated_at`) VALUES
(2, 'Brandon Yesid', 'Joaqui Ojeda', 'CC', '1107084473', '3154016116', 'brandonjoaqui@gmail.com', 'av7oe no 8-06', '1994-09-13', '1', '2023-04-20 06:19:23', '2023-04-25 01:39:57');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', NULL, '$2y$10$12.ECu8SVz8M0sbPzuqf4eRO9bTUEU2.CesCGbh7HY7oYQMCowb.O', 'EbJNaEJUP3F16H3RWPNabEF1Ic1Qh7nnWIYsBHJqw33eocT456oA0SLSU92O', '2023-04-19 01:22:05', '2023-04-19 01:22:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `certificados`
--
ALTER TABLE `certificados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `media_files`
--
ALTER TABLE `media_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `terceros`
--
ALTER TABLE `terceros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `certificados`
--
ALTER TABLE `certificados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `media_files`
--
ALTER TABLE `media_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `terceros`
--
ALTER TABLE `terceros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
