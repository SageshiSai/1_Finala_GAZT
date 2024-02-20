-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-02-2024 a las 22:55:24
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
-- Base de datos: `editorial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `EditorialID` int(11) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Ciudad` varchar(100) DEFAULT NULL,
  `Pais` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`EditorialID`, `Nombre`, `Ciudad`, `Pais`) VALUES
(1, 'Random House', 'Nueva York', 'Estados Unidos'),
(2, 'Penguin Books', 'Londres', 'Reino Unido'),
(3, 'Alfaguara', 'Madrid', 'España'),
(4, 'Anagrama', 'Barcelona', 'España'),
(5, 'Kodansha', 'Tokio', 'Japón'),
(6, 'Seix Barral', 'Barcelona', 'Paisos Catalans'),
(7, 'Katakrak', 'Iruñea', 'Euskal Herria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `LibroID` int(11) NOT NULL,
  `Titulo` varchar(255) DEFAULT NULL,
  `AutorID` int(11) DEFAULT NULL,
  `EditorialID` int(11) DEFAULT NULL,
  `AñoPublicacion` int(11) DEFAULT NULL,
  `ISBN` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`LibroID`, `Titulo`, `AutorID`, `EditorialID`, `AñoPublicacion`, `ISBN`) VALUES
(1, 'Cien años de soledad', 1, 1, 1967, '9780140184999'),
(2, 'Norwegian Wood', 2, 5, 1987, '9784062034402'),
(3, 'Harry Potter y la piedra filosofal', 3, 2, 1997, '9788498387087'),
(4, 'La casa de los espíritus', 4, 3, 1982, '9788432205200'),
(5, '1984', 5, 4, 1949, '9780141036144'),
(6, 'La mujer habitada ', 6, 6, 1988, '9788432212888'),
(7, 'La pequeña emoción', 6, NULL, 2025, NULL),
(8, 'El sentir de las moscas', 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_trabajadoras`
--

CREATE TABLE `personas_trabajadoras` (
  `AutorID` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Nacionalidad` varchar(100) DEFAULT NULL,
  `Autor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `personas_trabajadoras`
--

INSERT INTO `personas_trabajadoras` (`AutorID`, `Usuario`, `Contraseña`, `Nombre`, `Nacionalidad`, `Autor`) VALUES
(1, 'Gabi', '$2y$10$IX3xeqRK09ymAUKqM4HS8ObWhDmGF1AjqK1MQJpc3lQDvxVq9iHuu', 'Gabriel García Márquez', 'Colombiana', 1),
(2, 'Murakami', '$2y$10$.l2c.172OibTO8g5natEWuT1WmzsXzCjAuzGm6emloehpSCilMWp.', 'Haruki Murakami', 'Japonesa', 1),
(3, 'JK', '$2y$10$ePk4o1yVfSVzJfxIP3hdDO7noDucLLYL.mQSM7fO3fGn2nUbpCOq.', 'J.K. Rowling', 'Británica', 1),
(4, 'Isa', '$2y$10$tOG9BxCwD7U6CvmyNXRY9OP4yFwIvi5XFP8XFQDcqDa4NPaVuRN/6', 'Isabel Allende', 'Chilena', 1),
(5, 'George', '$2y$10$T.AVCDraHSCAKI9S.x6mmODIaRfLVkDkA3zNiwbjQVrfa3lZreJE2', 'George Orwell', 'Británica', 1),
(6, 'Gio', '$2y$10$OxjSrmExJa8koCOluoKdmOtBQpOCKNvBrfVqHUm0cfx1XImm45zb2', 'Gioconda Belli', 'Nicaragua', 1),
(7, 'Ane', '$2y$10$7UqUWkYGZEP3C7tVC85ifOt1MfoRDrMsq.PTRp5nuElfcTTvnF5ny', 'Ane Osa', 'Euskal Herria', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`EditorialID`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`LibroID`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `AutorID` (`AutorID`),
  ADD KEY `EditorialID` (`EditorialID`);

--
-- Indices de la tabla `personas_trabajadoras`
--
ALTER TABLE `personas_trabajadoras`
  ADD PRIMARY KEY (`AutorID`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `LibroID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`AutorID`) REFERENCES `personas_trabajadoras` (`AutorID`),
  ADD CONSTRAINT `libros_ibfk_2` FOREIGN KEY (`EditorialID`) REFERENCES `editoriales` (`EditorialID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
