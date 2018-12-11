-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Czas generowania: 11 Gru 2018, 07:30
-- Wersja serwera: 5.7.24
-- Wersja PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `api`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `api_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `brand`
--

INSERT INTO `brand` (`id`, `api_id`, `name`) VALUES
(7, 70905, '7UP'),
(8, 70933, 'A&W Root Beer');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'tester', 'tester', 'tester@example.com', 'tester@example.com', 1, NULL, '$2y$13$TI4HP8e5ZDQWxPAWaNeFK.aJSN.d9VtsNOB2xMk4qaKQbBwgbX0ZC', '2018-12-11 08:28:45', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `metric`
--

CREATE TABLE `metric` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `metric`
--

INSERT INTO `metric` (`id`, `name`) VALUES
(1, 'offline.scoreVolume.value');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `metric_value`
--

CREATE TABLE `metric_value` (
  `id` int(11) NOT NULL,
  `metric_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `value` decimal(18,10) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `value_interval` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `metric_value`
--

INSERT INTO `metric_value` (`id`, `metric_id`, `brand_id`, `value`, `start_date`, `end_date`, `value_interval`) VALUES
(73, 1, 7, '50.0171682406', '2018-08-27 00:00:00', '2018-09-02 23:59:59', 0),
(74, 1, 7, '50.4793587259', '2018-09-03 00:00:00', '2018-09-09 23:59:59', 0),
(75, 1, 7, '50.4758710539', '2018-09-10 00:00:00', '2018-09-16 23:59:59', 0),
(76, 1, 7, '49.3245291770', '2018-09-17 00:00:00', '2018-09-23 23:59:59', 0),
(77, 1, 7, '50.7435497863', '2018-09-24 00:00:00', '2018-09-30 23:59:59', 0),
(78, 1, 8, '65.8560752468', '2018-08-27 00:00:00', '2018-09-02 23:59:59', 0),
(79, 1, 8, '65.7074692020', '2018-09-03 00:00:00', '2018-09-09 23:59:59', 0),
(80, 1, 8, '64.8546223974', '2018-09-10 00:00:00', '2018-09-16 23:59:59', 0),
(81, 1, 8, '63.2921412283', '2018-09-17 00:00:00', '2018-09-23 23:59:59', 0),
(82, 1, 8, '64.2722824868', '2018-09-24 00:00:00', '2018-09-30 23:59:59', 0),
(83, 1, 7, '50.2080953967', '2018-09-01 00:00:00', '2018-09-30 23:59:59', 1),
(84, 1, 8, '64.7965181123', '2018-09-01 00:00:00', '2018-09-30 23:59:59', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20181210070421'),
('20181210230546');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indeksy dla tabeli `metric`
--
ALTER TABLE `metric`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `metric_value`
--
ALTER TABLE `metric_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9E2BA7A1A952D583` (`metric_id`),
  ADD KEY `IDX_9E2BA7A144F5D008` (`brand_id`);

--
-- Indeksy dla tabeli `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `metric`
--
ALTER TABLE `metric`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `metric_value`
--
ALTER TABLE `metric_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `metric_value`
--
ALTER TABLE `metric_value`
  ADD CONSTRAINT `FK_9E2BA7A144F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `FK_9E2BA7A1A952D583` FOREIGN KEY (`metric_id`) REFERENCES `metric` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
