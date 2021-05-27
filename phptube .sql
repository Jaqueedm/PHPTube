-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2021 a las 21:41:17
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `phptube`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuarios_id` int(11) NOT NULL,
  `usuarios_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_ip` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_ultimo_login` timestamp NULL DEFAULT NULL,
  `usuario_nombre` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuarios_imagen` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuarios_id`, `usuarios_fecha`, `usuarios_email`, `usuarios_password`, `usuarios_ip`, `usuarios_ultimo_login`, `usuario_nombre`, `usuarios_imagen`) VALUES
(8, '2021-05-24 18:04:14', 'dianithamayo@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '::1', '2021-05-25 21:43:25', 'diana', ''),
(9, '2021-05-24 18:05:56', 'dianithamay@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '::1', NULL, '', ''),
(10, '2021-05-24 19:06:12', 'alejandro@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '::1', NULL, '', ''),
(11, '2021-05-25 01:03:26', 'dianit@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', '::1', NULL, 'diana', ''),
(12, '2021-05-25 14:54:52', 'd@gmail.com', '', '::1', '2021-05-26 01:15:54', 'diana', 'archivo/WhatsApp Image 2020-12-26 at 1.49.12 PM.jpeg'),
(13, '2021-05-25 21:28:52', 'diana@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '::1', NULL, 'Jaque', 'archivo/De-olho-noIMCGIF.gif'),
(14, '2021-05-27 02:24:28', 'prueba@gmail.com', 'morenomayo', '::1', NULL, 'Soy Prueba', 'archivo/1614574199209 (1).png');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usuarios_y_videos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `usuarios_y_videos` (
`usuarios_email` varchar(60)
,`usuario_nombre` varchar(20)
,`videos_url` varchar(200)
,`usuarios_password` varchar(60)
,`usuarios_ip` varchar(30)
,`usuarios_ultimo_login` timestamp
,`usuarios_imagen` varchar(200)
,`videos_usuario_id` int(6)
,`videos_fecha` timestamp
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `videos_id` int(6) NOT NULL,
  `videos_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `videos_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `videos_usuario_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`videos_id`, `videos_fecha`, `videos_url`, `videos_usuario_id`) VALUES
(10, '2021-05-27 15:40:11', 'archivo/VID-20200628-WA0008.mp4', 14),
(11, '2021-05-27 18:58:18', 'archivo/VID-20200628-WA0008.mp4', 14);

-- --------------------------------------------------------

--
-- Estructura para la vista `usuarios_y_videos`
--
DROP TABLE IF EXISTS `usuarios_y_videos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `usuarios_y_videos`  AS  select `usuarios`.`usuarios_email` AS `usuarios_email`,`usuarios`.`usuario_nombre` AS `usuario_nombre`,`videos`.`videos_url` AS `videos_url`,`usuarios`.`usuarios_password` AS `usuarios_password`,`usuarios`.`usuarios_ip` AS `usuarios_ip`,`usuarios`.`usuarios_ultimo_login` AS `usuarios_ultimo_login`,`usuarios`.`usuarios_imagen` AS `usuarios_imagen`,`videos`.`videos_usuario_id` AS `videos_usuario_id`,`videos`.`videos_fecha` AS `videos_fecha` from (`videos` join `usuarios` on((`videos`.`videos_usuario_id` = `usuarios`.`usuarios_id`))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuarios_id`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`videos_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `videos_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
