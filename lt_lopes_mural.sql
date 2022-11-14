-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13/11/2022 às 16:31
-- Versão do servidor: 5.7.39-0ubuntu0.18.04.2
-- Versão do PHP: 7.4.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lt_lopes_mural`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `guidance`
--

CREATE TABLE `guidance` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `guidance`
--

INSERT INTO `guidance` (`id`, `title`, `created_at`) VALUES
(1, 'Heterossexual', '2022-11-09 09:52:58'),
(2, 'Bissexual', '2022-11-09 09:53:09'),
(3, 'Lésbica Ativa-indiscreta', '2022-11-09 10:07:47'),
(4, 'Lésbica Ativa-discreta', '2022-11-09 09:53:39'),
(5, 'Lésbica Passiva', '2022-11-09 09:53:47'),
(6, 'Homossexual  Ativo', '2022-11-09 10:20:02'),
(7, 'Homossexual Passivo-discreto', '2022-11-09 09:54:01'),
(8, 'Homossexual Passivo indiscreto', '2022-11-09 09:54:06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `interest`
--

CREATE TABLE `interest` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `interest`
--

INSERT INTO `interest` (`id`, `title`, `created_at`) VALUES
(1, 'Conversar', '2022-11-09 10:49:23'),
(2, 'Namorar', '2022-11-09 10:49:29'),
(3, 'Conhecer Alguém (Lugar Público)', '2022-11-09 10:49:53'),
(4, 'Sexo Casual', '2022-11-09 10:50:01'),
(5, 'Primeiro Sexo', '2022-11-09 10:50:10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mural`
--

CREATE TABLE `mural` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(30) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `guidance` varchar(80) DEFAULT NULL,
  `interest` varchar(80) DEFAULT NULL,
  `color` varchar(10) NOT NULL,
  `complement` text,
  `message` longtext NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `mode` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `mode`, `created_at`) VALUES
(1, 'Admin', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 0, '2022-11-13 20:05:43');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `guidance`
--
ALTER TABLE `guidance`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `mural`
--
ALTER TABLE `mural`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `guidance`
--
ALTER TABLE `guidance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mural`
--
ALTER TABLE `mural`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
