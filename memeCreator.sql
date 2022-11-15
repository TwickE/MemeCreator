-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 15-Nov-2022 às 21:48
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

--
-- Extraindo dados da tabela `meme`
--

INSERT INTO `meme` (`id`, `imagemMeme`, `idTemplate`, `idUtilizador`) VALUES
(42, '/resources/imagesMemes/6210cf18c7c57-1645268760.png', 45, 3),
(43, '/resources/imagesMemes/6210d032ecb9d-1645269042.png', 52, 2),
(44, '/resources/imagesMemes/6210d16074ed4-1645269344.png', 49, 2),
(45, '/resources/imagesMemes/6210d1e3aead1-1645269475.png', 51, 2),
(46, '/resources/imagesMemes/6210d30e88134-1645269774.png', 51, 4),
(47, '/resources/imagesMemes/6210d454d96c8-1645270100.png', 50, 4),
(48, '/resources/imagesMemes/6210d4e3e844e-1645270243.png', 47, 4),
(57, '/resources/imagesMemes/633c9a866457d-1664916102.png', 53, 1);

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

--
-- Extraindo dados da tabela `template`
--

INSERT INTO `template` (`id`, `nome`, `imagem`, `width`, `height`, `ativo`, `idUtilizador`) VALUES
(45, 'Drake Hotline Bling', '/resources/imagesTemplates/61fd326a0bc40-1643983466.jpg', 1200, 1200, 1, 3),
(47, 'Distracted Boyfriend', '/resources/imagesTemplates/61fd3282e77b9-1643983490.jpg', 1200, 800, 1, 3),
(49, 'Left Exit 12 Off Ramp', '/resources/imagesTemplates/61fd329ca0e03-1643983516.jpg', 804, 767, 1, 3),
(50, 'UNO Draw 25 Cards', '/resources/imagesTemplates/6210cbd4ab877-1645267924.jpg', 500, 494, 1, 3),
(51, 'Two Buttons', '/resources/imagesTemplates/6210cbea5f813-1645267946.jpg', 600, 908, 1, 3),
(52, 'Running Away Balloon', '/resources/imagesTemplates/6210cc0f9bc5f-1645267983.jpg', 761, 1024, 1, 3),
(53, 'Buff Doge VS Cheems', '/resources/imagesTemplates/6210cc3e22a9b-1645268030.png', 937, 720, 1, 3),
(57, 'fhgsfdghdfg', '/resources/imagesTemplates/6220bb7a1bad8-1646312314.png', 450, 450, 0, 1),
(58, 'gsgsdfb', '/resources/imagesTemplates/6220eb080b19c-1646324488.jpg', 500, 375, 1, 5);

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

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id`, `primeiroNome`, `ultimoNome`, `email`, `imagem`, `password`, `admin`, `online`) VALUES
(1, 'Frederico', 'Silva', 'fredericosilva2002@hotmail.com', '/resources/imagesPerfil/6220d85f934cf-1646319711.png', 'a5fd082755127b5daae6214a2f58e537', 1, 0),
(2, 'Paulo', 'Sousa', 'paulosousa@gmail.com', '/resources/imagesPerfil/61f6d746c6f9b-1643566918.jpg', 'a5fd082755127b5daae6214a2f58e537', 0, 0),
(3, 'Carolina', 'Duarte', 'carolinaduarte@gmail.com', '/resources/imagesPerfil/620d71dbbb569-1645048283.png', '95ceac3aaefd369c4afc8150d7f274be', 1, 0),
(4, 'Fernando', 'Soares', 'fernandosoares@gmail.com', '/resources/imagesPerfil/noPhotoPerfil.png', '95ceac3aaefd369c4afc8150d7f274be', 0, 0),
(5, 'José', 'Neves', 'joseneves@gmail.com', '/resources/imagesPerfil/6220ea7d5cf9a-1646324349.png', '95ceac3aaefd369c4afc8150d7f274be', 1, 0),
(6, 'João', 'Miguel', 'joaomiquel@gmail.com', '/resources/images/imagesPerfil/noPhotoPerfil.png', '95ceac3aaefd369c4afc8150d7f274be', 0, 0),
(7, 'Miguel', 'Soares', 'miguelsoares@gmail.com', '/resources/imagesPerfil/noPhotoPerfil.png', '95ceac3aaefd369c4afc8150d7f274be', 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

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
