-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 05-Mar-2022 às 12:45
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `memeCreator`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `meme`
--

CREATE TABLE `meme` (
  `id` int(11) NOT NULL,
  `imagemMeme` longtext NOT NULL,
  `idTemplate` int(11) NOT NULL,
  `idUtilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `width` float NOT NULL,
  `height` float NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  `idUtilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id` int(11) NOT NULL,
  `primeiroNome` varchar(60) NOT NULL,
  `ultimoNome` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL DEFAULT '/resources/imagesPerfil/noPhotoPerfil.png',
  `password` varchar(255) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `online` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `meme`
--
ALTER TABLE `meme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilizador` (`idUtilizador`),
  ADD KEY `idTemplate` (`idTemplate`);

--
-- Índices para tabela `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUtilizador` (`idUtilizador`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `meme`
--
ALTER TABLE `meme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `meme`
--
ALTER TABLE `meme`
  ADD CONSTRAINT `meme_ibfk_1` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`id`),
  ADD CONSTRAINT `meme_ibfk_2` FOREIGN KEY (`idTemplate`) REFERENCES `template` (`id`);

--
-- Limitadores para a tabela `template`
--
ALTER TABLE `template`
  ADD CONSTRAINT `template_ibfk_1` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`id`),
  ADD CONSTRAINT `template_ibfk_2` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`id`),
  ADD CONSTRAINT `template_ibfk_3` FOREIGN KEY (`idUtilizador`) REFERENCES `utilizador` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
