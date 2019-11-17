-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2019 at 07:17 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quipux`
--
CREATE DATABASE IF NOT EXISTS `quipux` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `quipux`;

-- --------------------------------------------------------

--
-- Table structure for table `estudiantes`
--

DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE `estudiantes` (
  `codigo_estudiante` int(11) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tipo_documento` varchar(45) DEFAULT NULL,
  `numero_documento` varchar(45) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `fecha_nacimiento` datetime DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`codigo_estudiante`, `id_rol`, `username`, `password`, `tipo_documento`, `numero_documento`, `nombres`, `apellidos`, `sexo`, `fecha_nacimiento`, `direccion`, `ciudad`, `telefono`, `correo`) VALUES
(2019001, 1, 'kismu', '$2y$10$X70QdM6kGMahJiSCbaDRyOXEq7Ya08tltps7.ZC/OW3W4M8/sKFze', 'ti', '1001137897', 'Juan fernando', 'Araque Agudelo', 'masculino', '2001-11-01 00:00:00', 'casdasd', 'Medellin', '1231242312', 'kismu35891@gmail.com'),
(2019002, 2, 'kismusito', '$2y$10$Q/oyT8ubrkdxiSZ.0h8aEeV8uSyRxK/5iNUvfaKRUTodHtjiKKiCG', 'ti', '1001137897', 'Mateo Araque', 'Soto', 'masculino', '2001-11-01 00:00:00', 'Cll 107B N 32-26', 'medellin', '3054445993', 'areinger@example.net');

-- --------------------------------------------------------

--
-- Table structure for table `grados`
--

DROP TABLE IF EXISTS `grados`;
CREATE TABLE `grados` (
  `idgrado` int(11) NOT NULL,
  `codigo_estudiante` int(11) DEFAULT NULL,
  `year_grado` year(4) DEFAULT NULL,
  `grado` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `nota_promedio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grados`
--

INSERT INTO `grados` (`idgrado`, `codigo_estudiante`, `year_grado`, `grado`, `estado`, `nota_promedio`) VALUES
(1, 2019002, 2019, 20191106, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE `grupos` (
  `codigo_grupo` int(11) NOT NULL,
  `nombre_profesor` varchar(45) DEFAULT NULL,
  `jornada` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupos`
--

INSERT INTO `grupos` (`codigo_grupo`, `nombre_profesor`, `jornada`) VALUES
(20191106, 'Jorge Cano', 'tarde');

-- --------------------------------------------------------

--
-- Table structure for table `grupos_has_estudiantes`
--

DROP TABLE IF EXISTS `grupos_has_estudiantes`;
CREATE TABLE `grupos_has_estudiantes` (
  `grupos_codigo_grupo` int(11) NOT NULL,
  `estudiantes_codigo_estudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grupos_has_estudiantes`
--

INSERT INTO `grupos_has_estudiantes` (`grupos_codigo_grupo`, `estudiantes_codigo_estudiante`) VALUES
(20191106, 2019002);

-- --------------------------------------------------------

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
CREATE TABLE `materias` (
  `codigo_materia` varchar(20) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `profesor` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materias`
--

INSERT INTO `materias` (`codigo_materia`, `nombre`, `profesor`) VALUES
('NAT001', 'Quimica', 'Maria Lily');

-- --------------------------------------------------------

--
-- Table structure for table `materias_has_grupos`
--

DROP TABLE IF EXISTS `materias_has_grupos`;
CREATE TABLE `materias_has_grupos` (
  `materias_codigo_materia` varchar(20) NOT NULL,
  `grupos_codigo_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materias_has_grupos`
--

INSERT INTO `materias_has_grupos` (`materias_codigo_materia`, `grupos_codigo_grupo`) VALUES
('NAT001', 20191106);

-- --------------------------------------------------------

--
-- Table structure for table `notas`
--

DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `idnota` int(11) NOT NULL,
  `codigo_materia` varchar(45) DEFAULT NULL,
  `codigo_estudiante` int(11) DEFAULT NULL,
  `parcial` float DEFAULT NULL,
  `final` float DEFAULT NULL,
  `promedio` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notas_has_notas`
--

DROP TABLE IF EXISTS `notas_has_notas`;
CREATE TABLE `notas_has_notas` (
  `id` int(11) NOT NULL,
  `notas_materia` varchar(45) NOT NULL,
  `notas_estudiante` int(11) NOT NULL,
  `nota` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idrol` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idrol`, `name`) VALUES
(1, 'administrador'),
(2, 'estudiante');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`codigo_estudiante`),
  ADD KEY `rol_estudiante_idx` (`id_rol`);

--
-- Indexes for table `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`idgrado`),
  ADD KEY `grupo_estudiante_idx` (`codigo_estudiante`),
  ADD KEY `grado_grupo_idx` (`grado`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`codigo_grupo`);

--
-- Indexes for table `grupos_has_estudiantes`
--
ALTER TABLE `grupos_has_estudiantes`
  ADD PRIMARY KEY (`grupos_codigo_grupo`,`estudiantes_codigo_estudiante`),
  ADD KEY `fk_grupos_has_estudiantes_estudiantes1_idx` (`estudiantes_codigo_estudiante`),
  ADD KEY `fk_grupos_has_estudiantes_grupos1_idx` (`grupos_codigo_grupo`);

--
-- Indexes for table `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`codigo_materia`);

--
-- Indexes for table `materias_has_grupos`
--
ALTER TABLE `materias_has_grupos`
  ADD PRIMARY KEY (`materias_codigo_materia`,`grupos_codigo_grupo`),
  ADD KEY `fk_materias_has_grupos_grupos1_idx` (`grupos_codigo_grupo`),
  ADD KEY `fk_materias_has_grupos_materias1_idx` (`materias_codigo_materia`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idnota`),
  ADD KEY `materia_nota_idx` (`codigo_materia`),
  ADD KEY `estudiante_nota_idx` (`codigo_estudiante`);

--
-- Indexes for table `notas_has_notas`
--
ALTER TABLE `notas_has_notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notas_has_notas_notas1_idx` (`notas_materia`),
  ADD KEY `fk_notas_has_notas_notas2_idx` (`notas_estudiante`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idrol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grados`
--
ALTER TABLE `grados`
  MODIFY `idgrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `idnota` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notas_has_notas`
--
ALTER TABLE `notas_has_notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `rol_estudiante` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`idrol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grados`
--
ALTER TABLE `grados`
  ADD CONSTRAINT `grado_grupo` FOREIGN KEY (`grado`) REFERENCES `grupos` (`codigo_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `grupo_estudiante` FOREIGN KEY (`codigo_estudiante`) REFERENCES `estudiantes` (`codigo_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `grupos_has_estudiantes`
--
ALTER TABLE `grupos_has_estudiantes`
  ADD CONSTRAINT `fk_grupos_has_estudiantes_estudiantes1` FOREIGN KEY (`estudiantes_codigo_estudiante`) REFERENCES `estudiantes` (`codigo_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grupos_has_estudiantes_grupos1` FOREIGN KEY (`grupos_codigo_grupo`) REFERENCES `grupos` (`codigo_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `materias_has_grupos`
--
ALTER TABLE `materias_has_grupos`
  ADD CONSTRAINT `fk_materias_has_grupos_grupos1` FOREIGN KEY (`grupos_codigo_grupo`) REFERENCES `grupos` (`codigo_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_materias_has_grupos_materias1` FOREIGN KEY (`materias_codigo_materia`) REFERENCES `materias` (`codigo_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `estudiante_nota` FOREIGN KEY (`codigo_estudiante`) REFERENCES `estudiantes` (`codigo_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `materia_nota` FOREIGN KEY (`codigo_materia`) REFERENCES `materias` (`codigo_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notas_has_notas`
--
ALTER TABLE `notas_has_notas`
  ADD CONSTRAINT `fk_notas_has_notas_notas1` FOREIGN KEY (`notas_materia`) REFERENCES `notas` (`codigo_materia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_notas_has_notas_notas2` FOREIGN KEY (`notas_estudiante`) REFERENCES `notas` (`codigo_estudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
