-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 24-Out-2017 às 00:36
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `caern_bd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `caern_ponto`
--

CREATE TABLE `caern_ponto` (
  `id_ponto` int(11) NOT NULL,
  `log_ponto` decimal(10,6) NOT NULL,
  `lat_ponto` decimal(10,7) NOT NULL,
  `rua_ponto` varchar(100) NOT NULL,
  `estado_ponto` varchar(60) NOT NULL,
  `cidade_ponto` varchar(60) DEFAULT NULL
) NGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caern_ponto`
--

INSERT INTO `caern_ponto` (`id_ponto`, `log_ponto`, `lat_ponto`, `rua_ponto`, `estado_ponto`, `cidade_ponto`) VALUES
(52, '-35.240449', '-5.7158140', 'Rua dos Imigrantes', 'Rio Grande do Norte', 'Natal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caern_usuario`
--

CREATE TABLE `caern_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(60) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caern_usuario`
--

INSERT INTO `caern_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`) VALUES
(10, 'francisco', 'frandosax@gmail.com', '19908894'),
(11, 'jacky souto', 'jacquelinesouto43@gmail.com', 'ja1234'),
(12, 'handerson', 'handersonsylva@gmail.com', 'han123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caern_vazamento`
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
) NGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caern_vazamento`
--

INSERT INTO `caern_vazamento` (`id_vazamento`, `descricao_vazamento`, `status_vazamento`, `data_vazamento`, `gravidade_vazamento`, `tempo_vazamento`, `fk_id_ponto`, `fk_id_usuario`) VALUES
(45, 'teste descricao 1', 1, '2016-01-12', 'leve', 0, 52, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_vaz`
--

CREATE TABLE `comentarios_vaz` (
  `id_comentario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `comentario` varchar(200) NOT NULL
) NGINE=InnoDB DEFAULT CHARSET=utf8;
-- --------------------------------------------------------

--
-- Estrutura da tabela `tokens`
--

CREATE TABLE `tokens` (
  `id_token` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tokens`
--

INSERT INTO `tokens` (`id_token`, `token`, `fk_usuario`) VALUES
(6, '59ee4aa3d3198', 10),
(7, '59ee4b089fce2', 12),
(8, '59ee6c874e8ac', 10),
(9, '59ee6cefde6ac', 10),
(10, '59ee6d39efaaa', 10),
(11, '59ee6da0af574', 10);

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
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id_token`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `caern_ponto`
--
ALTER TABLE `caern_ponto`
  MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `caern_usuario`
--
ALTER TABLE `caern_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `caern_vazamento`
--
ALTER TABLE `caern_vazamento`
  MODIFY `id_vazamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `comentarios_vaz`
--
ALTER TABLE `comentarios_vaz`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `caern_vazamento`
--
ALTER TABLE `caern_vazamento`
  ADD CONSTRAINT `caern_vazamento_ibfk_1` FOREIGN KEY (`fk_id_ponto`) REFERENCES `caern_ponto` (`id_ponto`),
  ADD CONSTRAINT `caern_vazamento_ibfk_2` FOREIGN KEY (`fk_id_usuario`) REFERENCES `caern_usuario` (`id_usuario`);

--
-- Limitadores para a tabela `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `caern_usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
