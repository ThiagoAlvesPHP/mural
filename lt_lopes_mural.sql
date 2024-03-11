-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 08-Fev-2024 às 18:54
-- Versão do servidor: 8.0.36-0ubuntu0.22.04.1
-- versão do PHP: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Estrutura da tabela `guidance`
--

CREATE TABLE `guidance` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `guidance`
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
-- Estrutura da tabela `interest`
--

CREATE TABLE `interest` (
  `id` int NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `interest`
--

INSERT INTO `interest` (`id`, `title`, `created_at`) VALUES
(1, 'Conversar', '2022-11-09 10:49:23'),
(2, 'Namorar', '2022-11-09 10:49:29'),
(3, 'Conhecer Alguém (Lugar Público)', '2022-11-09 10:49:53'),
(4, 'Sexo Casual', '2022-11-09 10:50:01'),
(5, 'Primeiro Sexo', '2022-11-09 10:50:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mural`
--

CREATE TABLE `mural` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_valid` tinyint(1) NOT NULL DEFAULT '0',
  `whatsapp` varchar(30) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `guidance_id` int DEFAULT NULL,
  `guidance` varchar(80) DEFAULT NULL,
  `interest_id` int NOT NULL,
  `interest` varchar(80) DEFAULT NULL,
  `color` varchar(10) NOT NULL,
  `complement` text,
  `message` longtext NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `is_old` tinyint(1) NOT NULL DEFAULT '0',
  `is_infinite` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `mural`
--

INSERT INTO `mural` (`id`, `name`, `email`, `city`, `photo`, `photo_valid`, `whatsapp`, `age`, `guidance_id`, `guidance`, `interest_id`, `interest`, `color`, `complement`, `message`, `status`, `is_old`, `is_infinite`, `created_at`) VALUES
(280, 'Thiago', 'thioalves@gmail.com', 'Brusque', 'assets/img/mural/cb15a432d5739dee4a52ca913ccce2ec.jpg', 1, '(47)99280-0841', 37, 1, 'Heterossexual - [Para o Sexo o OPOSTO]', 2, 'Namorar', '#0a71c0', NULL, 'OLÁ, MEU NOME É Thiago, TENHO POR ORIENTAÇÃO SEXUAL A CLASSIFICAÇÃO 1:Heterossexual - [Para o Sexo o OPOSTO], MINHA IDADE É 37 ANOS. E AQUI VÃO OS MEUS CONTATOS PARA NOS LIGARMOS: thioalves@gmail.com / WHATSAPP: (47)99280-0841, TENHO INTERESSE EM 2:Namorar, RESIDO EM Brusque .', 1, 0, 0, '2024-02-07 22:46:47'),
(281, 'Thiago Alves', 'thioalves@gmail.com', 'Brusque', 'assets/img/mural/884973f755008a9a0f83e97f673d5cad.jpg', 1, '(47)99280-0841', 37, 1, 'Heterossexual - [Para o Sexo o OPOSTO]', 3, 'Conhecer Alguém (Lugar Público)', '#ff194e', NULL, 'ME CHAMO Thiago Alves, SOU 1:Heterossexual - [Para o Sexo o OPOSTO], TENHO 37 ANOS, MEU E-MAIL É: thioalves@gmail.com / MEU WHATSAPP É: (47)99280-0841, E ESTOU AFIM DE: 3:Conhecer Alguém (Lugar Público), VIVO EM Brusque.', 1, 0, 0, '2024-02-07 22:45:27');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `mode` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `mode`, `created_at`) VALUES
(1, 'Admin', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 0, '2023-05-26 04:22:02');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `guidance`
--
ALTER TABLE `guidance`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mural`
--
ALTER TABLE `mural`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `guidance`
--
ALTER TABLE `guidance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mural`
--
ALTER TABLE `mural`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
