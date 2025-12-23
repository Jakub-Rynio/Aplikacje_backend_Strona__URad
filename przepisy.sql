-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2025 at 09:59 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `przepisy`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `autor` varchar(500) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `przepis_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `data` date NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `moderatorzy`
--

CREATE TABLE `moderatorzy` (
  `login` varchar(40) NOT NULL,
  `password` varchar(260) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `moderatorzy`
--

INSERT INTO `moderatorzy` (`login`, `password`, `active`) VALUES
('jakub', '$2y$10$1cYO/KxbI8QgOTmKOWesFO3uFsCP72ruoMoWJvFBxj2DBlib1MiV6', 1),
('JRR', '$2y$10$ELTsZ2Nc2Ac.YOvv1O5CbOLmEb5IrzH/EJdkqhKjjNd4Rfzht5Y0q', 1),
('JRR2', '$2y$10$hN9X.2qJjrslPQT08XpDa.BCh9HX2y9Q9Pqg/KKrJndLMNtCH9POa', 1),
('root', '$2y$10$vNBSLQLjpHfj8bvYHyJuYeaahUae1jNfI.wtFlhDds8UJJoRPzFeK', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przepisy`
--

CREATE TABLE `przepisy` (
  `tytul` varchar(50) NOT NULL,
  `kategoria` varchar(50) NOT NULL,
  `obrazek` varchar(300) DEFAULT NULL,
  `tresc` mediumtext NOT NULL,
  `dodane_przez` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `data` date NOT NULL,
  `opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kom_i_wpis` (`przepis_id`);

--
-- Indeksy dla tabeli `moderatorzy`
--
ALTER TABLE `moderatorzy`
  ADD PRIMARY KEY (`login`);

--
-- Indeksy dla tabeli `przepisy`
--
ALTER TABLE `przepisy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wpis_i_mod` (`dodane_przez`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `przepisy`
--
ALTER TABLE `przepisy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentarze`
--
ALTER TABLE `komentarze`
  ADD CONSTRAINT `kom_i_wpis` FOREIGN KEY (`przepis_id`) REFERENCES `przepisy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `przepisy`
--
ALTER TABLE `przepisy`
  ADD CONSTRAINT `wpis_i_mod` FOREIGN KEY (`dodane_przez`) REFERENCES `moderatorzy` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
