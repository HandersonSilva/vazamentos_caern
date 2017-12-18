-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 18-Dez-2017 às 12:40
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caern_ponto`
--

INSERT INTO `caern_ponto` (`id_ponto`, `log_ponto`, `lat_ponto`, `rua_ponto`, `estado_ponto`, `cidade_ponto`) VALUES
(2, '-35.194922', '-5.7871630', 'Rua Trairi', 'Rio Grande do Norte', 'Natal'),
(3, '-35.197395', '-5.7797960', 'Rua Almirante Barroso', 'Rio Grande do Norte', 'Natal'),
(4, '-35.273151', '-5.7509430', 'Rua Joana Elisa Fernandes', 'Rio Grande do Norte', 'Natal'),
(5, '-35.280704', '-5.7663140', 'Rua Santa Luzia', 'Rio Grande do Norte', 'SÃ£o GonÃ§alo do Amarante');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caern_usuario`
--

CREATE TABLE `caern_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(60) NOT NULL,
  `email_usuario` varchar(45) NOT NULL,
  `senha_usuario` varchar(150) NOT NULL,
  `img_perfil` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caern_usuario`
--

INSERT INTO `caern_usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `img_perfil`) VALUES
(8, 'felipe silva', 'felipesilva@gmail.com', 'feli123', 'felipe.jpg'),
(9, 'fran_oliver_sx', 'frandosax@gmail.com', 'f1r2a3', 'fran.jpg'),
(10, 'caern_vazamentos', 'caern_vaz@com.br', 'caern123', 'fundo.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caern_vazamento`
--

INSERT INTO `caern_vazamento` (`id_vazamento`, `descricao_vazamento`, `status_vazamento`, `data_vazamento`, `gravidade_vazamento`, `tempo_vazamento`, `fk_id_ponto`, `fk_id_usuario`) VALUES
(2, 'teste de cadastro de novo vazamento', 0, '2017-12-05', 'Grave', 0, 2, 9),
(3, 'vazamento com residuos de esgoto', 1, '2017-12-19', 'Grave', 0, 3, 9),
(4, 'teste descriÃ§Ã£o de vazamento usuario 2', 1, '2017-09-13', 'medio', 0, 4, 8),
(5, 'teste caern', 0, '2017-12-12', 'leve', 0, 5, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_vaz`
--

CREATE TABLE `comentarios_vaz` (
  `id_comentario` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `comentario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tokens`
--

CREATE TABLE `tokens` (
  `id_token` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `tempo_token` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tokens`
--

INSERT INTO `tokens` (`id_token`, `token`, `fk_usuario`, `tempo_token`) VALUES
(1, '5a33fd7463e6d', 9, '2017-12-15 13:51:00'),
(2, '5a33fdefc1946', 9, '2017-12-15 13:53:00'),
(3, '5a33fe9be8bc7', 9, '2017-12-15 13:55:00'),
(4, '5a33fef6241a9', 9, '2017-12-15 13:57:00'),
(5, '5a33ff27ee3c0', 9, '2017-12-15 13:58:00'),
(6, '5a3400b4445fa', 9, '2017-12-15 14:04:00'),
(7, '5a3404b349c4d', 9, '2017-12-15 14:21:00'),
(8, '5a340510a13f4', 9, '2017-12-15 14:23:00'),
(9, '5a37a881c300a', 9, '2017-12-18 08:37:00');

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
  MODIFY `id_ponto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `caern_usuario`
--
ALTER TABLE `caern_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `caern_vazamento`
--
ALTER TABLE `caern_vazamento`
  MODIFY `id_vazamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comentarios_vaz`
--
ALTER TABLE `comentarios_vaz`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
