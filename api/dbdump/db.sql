
-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Czas generowania: 10 Gru 2018, 12:41
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
(23, 1, 7, '50.0171682406', '2018-08-27 02:00:00', '2018-09-03 01:59:59', 0),
(24, 1, 7, '50.4793587259', '2018-09-03 02:00:00', '2018-09-10 01:59:59', 0),
(25, 1, 7, '50.4758710539', '2018-09-10 02:00:00', '2018-09-17 01:59:59', 0),
(26, 1, 7, '49.3245291770', '2018-09-17 02:00:00', '2018-09-24 01:59:59', 0),
(27, 1, 7, '50.7435497863', '2018-09-24 02:00:00', '2018-10-01 01:59:59', 0),
(28, 1, 8, '65.8560752468', '2018-08-27 02:00:00', '2018-09-03 01:59:59', 0),
(29, 1, 8, '65.7074692020', '2018-09-03 02:00:00', '2018-09-10 01:59:59', 0),
(30, 1, 8, '64.8546223974', '2018-09-10 02:00:00', '2018-09-17 01:59:59', 0),
(31, 1, 8, '63.2921412283', '2018-09-17 02:00:00', '2018-09-24 01:59:59', 0),
(32, 1, 8, '64.2722824868', '2018-09-24 02:00:00', '2018-10-01 01:59:59', 0);

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
('20181210070421');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT dla tabeli `metric`
--
ALTER TABLE `metric`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `metric_value`
--
ALTER TABLE `metric_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
