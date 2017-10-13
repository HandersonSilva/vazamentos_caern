-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2017 at 03:53 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_caern`
--

-- --------------------------------------------------------

--
-- Table structure for table `caern_ponto`
--

CREATE TABLE `caern_ponto` (
  `id_ponto` int(11) NOT NULL,
  `log_ponto` decimal(10,6) NOT NULL,
  `lat_ponto` decimal(10,7) NOT NULL,
  `rua_ponto` varchar(100) NOT NULL,
  `estado_ponto` varchar(60) NOT NULL,
  `cidade_ponto` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caern_ponto`
--


-- --------------------------------------------------------

--
-- Table structure for table `caern_usuario`
--

CREATE TABLE `caern_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(60) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caern_usuario`
--

-- --------------------------------------------------------

--
-- Table structure for table `caern_vazamento`
--

CREATE TABLE `caern_vazamento` (
  `id_vazamento` int(11) NOT NULL,
  `descricao_vazamento` text NOT NULL,
  `status_vazamento` int(11) NOT NULL DEFAULT '0' COMMENT '0 = reclamação fechada\n1 = reclamação aberta\n',
  `data_vazamento` date NOT NULL,
  `gravidade_vazamento` varchar(50) NOT NULL,
  `tempo_vazamento` int(11) DEFAULT NULL,
  `fk_id_ponto` int(11) NOT NULL,
  `fk_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `caern_vazamento`
--

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_vaz`
--

CREATE TABLE `comentarios_vaz` (
  `id_comentario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comentarios_vaz`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `caern_ponto`
--
ALTER TABLE `caern_ponto`
  ADD PRIMARY KEY (`id_ponto`);

--
-- Indexes for table `caern_usuario`
--
ALTER TABLE `caern_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `caern_vazamento`
--
ALTER TABLE `caern_vazamento`
  ADD PRIMARY KEY (`id_vazamento`),
  ADD KEY `fk_id_ponto` (`fk_id_ponto`),
  ADD KEY `fk_id_usuario` (`fk_id_usuario`);

--
-- Indexes for table `comentarios_vaz`
--
ALTER TABLE `comentarios_vaz`
  ADD PRIMARY KEY (`id_comentario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caern_ponto`
--
ALTER TABLE `caern_ponto`
  MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `caern_usuario`
--
ALTER TABLE `caern_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `caern_vazamento`
--
ALTER TABLE `caern_vazamento`
  MODIFY `id_vazamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `comentarios_vaz`
--
ALTER TABLE `comentarios_vaz`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `caern_vazamento`
--
ALTER TABLE `caern_vazamento`
  ADD CONSTRAINT `caern_vazamento_ibfk_1` FOREIGN KEY (`fk_id_ponto`) REFERENCES `caern_ponto` (`id_ponto`),
  ADD CONSTRAINT `caern_vazamento_ibfk_2` FOREIGN KEY (`fk_id_usuario`) REFERENCES `caern_usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
