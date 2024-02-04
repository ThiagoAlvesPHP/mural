-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 04/02/2024 às 11:07
-- Versão do servidor: 5.7.23-23
-- Versão do PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `murald43_mural`
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
(1, 'Heterossexual - [Para o Sexo o OPOSTO]', '2023-07-18 12:40:56'),
(2, 'Bissexual - [Para QUALQUER dos Sexos]', '2023-07-18 12:41:16'),
(3, 'Lésbica Ativa-indiscreta - [para o mesmo Sexo]', '2023-07-18 12:41:28'),
(4, 'Lésbica Ativa-discreta - [para o mesmo Sexo]', '2023-07-18 12:41:45'),
(5, 'Lésbica Passiva - [para o mesmo Sexo]', '2023-07-18 12:41:58'),
(6, 'Homossexual  Ativo - [para o mesmo Sexo]', '2023-07-18 12:42:12'),
(7, 'Homossexual Passivo-discreto - [para o mesmo Sexo]', '2023-07-18 12:42:27'),
(8, 'Homossexual Passivo indiscreto - [para o mesmo Sexo]', '2023-07-18 12:42:47'),
(9, 'Hetero+comCuriosidade - [Para o MESMO Sexo]', '2023-07-18 12:43:05');

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

--
-- Despejando dados para a tabela `mural`
--

INSERT INTO `mural` (`id`, `name`, `email`, `whatsapp`, `age`, `guidance`, `interest`, `color`, `complement`, `message`, `status`, `created_at`) VALUES
(268, 'okjUvbBWJwP', 'angela.dolittle1984@yahoo.com', 'arScIgqMUXlyYHFT', 0, 'Hetero+comCuriosidade - [Para o MESMO Sexo]', 'Primeiro Sexo', '#443d3d', 'deBgFNPvDEapyq', 'OI, ME CHAMO okjUvbBWJwP, MINHA ORIENTAÇÃO SEXUAL É Hetero+comCuriosidade - [Para o MESMO Sexo], TENHO AxtcmgHM ANOS. MEU E-MAIL É: angela.dolittle1984@yahoo.com / E MEU WHATSAPP É: arScIgqMUXlyYHFT, TENHO INTERESSE EM Primeiro Sexo.', 1, '2024-01-29 23:26:32'),
(269, 'okjUvbBWJwP', 'angela.dolittle1984@yahoo.com', 'arScIgqMUXlyYHFT', 0, 'Hetero+comCuriosidade - [Para o MESMO Sexo]', 'Primeiro Sexo', '#443d3d', 'deBgFNPvDEapyq', 'OI, ME CHAMO okjUvbBWJwP, MINHA ORIENTAÇÃO SEXUAL É Hetero+comCuriosidade - [Para o MESMO Sexo], TENHO AxtcmgHM ANOS. MEU E-MAIL É: angela.dolittle1984@yahoo.com / E MEU WHATSAPP É: arScIgqMUXlyYHFT, TENHO INTERESSE EM Primeiro Sexo.', 1, '2024-01-29 23:26:35');

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
(1, 'Admin', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 0, '2023-05-26 04:22:02');

--
-- Índices para tabelas despejadas
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
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `guidance`
--
ALTER TABLE `guidance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mural`
--
ALTER TABLE `mural`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
