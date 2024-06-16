-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/05/2024 às 04:57
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ifilmes_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios_tb`
--

CREATE TABLE `anuncios_tb` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(2000) NOT NULL,
  `imagem_link` varchar(2000) NOT NULL,
  `posto_por` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastrar_filmes`
--

CREATE TABLE `cadastrar_filmes` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(2000) NOT NULL,
  `posto_por` varchar(255) NOT NULL,
  `imagem_link` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastrar_matriculas`
--

CREATE TABLE `cadastrar_matriculas` (
  `id` int(255) NOT NULL,
  `matricula_solici` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes_tb`
--

CREATE TABLE `filmes_tb` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(2000) NOT NULL,
  `SorN` bit(1) NOT NULL,
  `quanto_votos` int(11) NOT NULL DEFAULT 0,
  `posto_por` varchar(255) NOT NULL,
  `imagem_link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela dos Filmes ';

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_tb`
--

CREATE TABLE `login_tb` (
  `id` int(255) NOT NULL,
  `matricula` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `login_tb`
--

INSERT INTO `login_tb` (`id`, `matricula`) VALUES
(1, '19111413'),
(2, '2022110091010017');

-- --------------------------------------------------------

--
-- Estrutura para tabela `votos_usuarios`
--

CREATE TABLE `votos_usuarios` (
  `id` int(255) NOT NULL,
  `filme_id` int(255) DEFAULT NULL,
  `matricula` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios_tb`
--
ALTER TABLE `anuncios_tb`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cadastrar_filmes`
--
ALTER TABLE `cadastrar_filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cadastrar_matriculas`
--
ALTER TABLE `cadastrar_matriculas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `filmes_tb`
--
ALTER TABLE `filmes_tb`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login_tb`
--
ALTER TABLE `login_tb`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `votos_usuarios`
--
ALTER TABLE `votos_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_voto` (`filme_id`,`matricula`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios_tb`
--
ALTER TABLE `anuncios_tb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cadastrar_filmes`
--
ALTER TABLE `cadastrar_filmes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `cadastrar_matriculas`
--
ALTER TABLE `cadastrar_matriculas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `filmes_tb`
--
ALTER TABLE `filmes_tb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `login_tb`
--
ALTER TABLE `login_tb`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `votos_usuarios`
--
ALTER TABLE `votos_usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
