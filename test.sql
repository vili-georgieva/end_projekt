-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Време на генериране: 12 яну 2025 в 16:14
-- Версия на сървъра: 8.0.40-0ubuntu0.24.04.1
-- Версия на PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `test`
--

-- --------------------------------------------------------

--
-- Структура на таблица `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `text` varchar(200) NOT NULL,
  `photoname` varchar(50) NOT NULL,
  `photodir` varchar(225) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `news`
--

INSERT INTO `news` (`id`, `text`, `photoname`, `photodir`, `date`) VALUES
(6, 'Sql Join', 'small_join.png', '../uploads/news/small_join.png', '2025-01-12');

-- --------------------------------------------------------

--
-- Структура на таблица `reg`
--

CREATE TABLE `reg` (
  `salutation` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `usernme` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `passwort` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `reg`
--

INSERT INTO `reg` (`salutation`, `firstname`, `lastname`, `usernme`, `email`, `passwort`, `isAdmin`) VALUES
('Mr', 'ad', 'ad', 'ad', 'ad@ad', '$2y$10$ZNF.HSmTQmGrRuhYYQcFRejlHyDf14M5kBFCvnBRbKyyjz2.czLPC', 0),
('Ms', 'Velichka', 'Georgieva', 'admin', 'admin@admin', '$2y$10$VciUhm6B9Ry6qMtcUWej1uENHDTZb6rTfXfh2771i6nXcAXUakA/u', 1),
('Mr', 'v', 'v', 'v', 'v@v', '$2y$10$S2Rlxdzstkb1k.GBXJVudezmw3GGz9qldpEVlvGYq8UOv6csrVeYa', 0);

-- --------------------------------------------------------

--
-- Структура на таблица `rooms`
--

CREATE TABLE `rooms` (
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `breakfast` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `parking` varchar(10) NOT NULL,
  `pets` varchar(100) NOT NULL,
  `id` int NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Схема на данните от таблица `rooms`
--

INSERT INTO `rooms` (`checkin`, `checkout`, `breakfast`, `parking`, `pets`, `id`, `status`, `date`, `email`) VALUES
('2024-12-04', '2024-12-14', 'No', 'Yes', 'done', 13, 'new', '2024-12-30 19:18:48', 's@s'),
('2025-01-16', '2025-01-23', 'Yes', 'No', 'in progress', 14, 'new', '2025-01-09 09:37:01', 's@s'),
('2025-01-14', '2025-01-30', 'No', 'No', '', 15, 'done', '2025-01-12 09:33:21', 'v@v'),
('2025-01-14', '2025-01-23', 'Yes', 'Yes', 'd', 16, 'in progress', '2025-01-12 09:36:59', 'admin@admin');

--
-- Indexes for dumped tables
--

--
-- Индекси за таблица `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индекси за таблица `reg`
--
ALTER TABLE `reg`
  ADD UNIQUE KEY `email` (`email`);

--
-- Индекси за таблица `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
