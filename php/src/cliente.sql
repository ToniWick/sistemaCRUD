-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 11-04-2022 a las 10:43:36
-- Versión del servidor: 8.0.28
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `movieStream3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `correo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `celular` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nombre` varchar(40) NOT NULL,
  `pApellido` varchar(100) NOT NULL,
  `sApellido` varchar(100) NOT NULL,
  `nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `username`, `correo`, `celular`, `nombre`, `pApellido`, `sApellido`, `nacimiento`) VALUES
(4, 'jose rios', 'jose@hotmail.com', '6185469576', 'Jose', 'Rios', 'Ramirez', NULL),
(5, 'antonio34', 'antoisdf@sdfs.com', '6548156757', 'Antonio', 'Rios', 'Sanchez', NULL),
(6, 'nacho14', 'nacholoco@hotmail.com', '6183464852', 'Ignacio', 'Flores', 'Triana', NULL),
(7, 'Joshua56', 'destroyer@gmail.com', '6184952046', 'Joshua', 'Estrada', 'Perez', '1998-07-06'),
(8, 'Raul45', 'raulin@hotmail.com', '6186400450', 'Raul', 'Antuna', 'Sanchez', '2000-04-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
