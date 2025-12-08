-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2025 at 02:09 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

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

--
-- Dumping data for table `komentarze`
--

INSERT INTO `komentarze` (`autor`, `active`, `przepis_id`, `content`, `data`, `id`) VALUES
('test', 0, 4, 'testsart', '2025-12-01', 1),
('janusz', 1, 6, 'tatatatat', '2025-12-01', 2),
('aaa', 1, 6, 'aaaaa', '2025-12-01', 3),
('AAAAAAAANIA', 1, 4, 'ATATATATATATATATATATATTATAT', '2025-12-01', 4),
('jam', 1, 3, 'tresc komentarza', '2025-12-02', 5);

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
('jakub', '$2y$10$4lZx6pqzDVd9DMEA1FQyx.V83wsXgeNCOBDGzxn3dC5B92Zj3LD8i', 1),
('JRR', '$2y$10$kglLvoxWYvWZCvTEVf0RqeR1q6H6sAVZfUMsNaOpvPZYW8NUX6wIW', 1),
('kuba', '$2y$10$CuI9IoBI6pEeSFBkDBEWyeiwrrcgCeNMtvhQNVFzh11LXyPQgpqnS', 1),
('Root', 'root', 1),
('Root2', 'root', 1);

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
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `przepisy`
--

INSERT INTO `przepisy` (`tytul`, `kategoria`, `obrazek`, `tresc`, `dodane_przez`, `id`, `active`) VALUES
('test', 'taka', '1764588116_692d7a54d3b8d.jpg', 'tressssssssssssssccccc', 'kuba', 3, 1),
('test', 'taka', '1764588220_692d7abc79c88.jpg', 'tressssssssssssssccccc', 'kuba', 4, 1),
('NOWY', 'KAT', '1764597570_692d9f42d1e18.jpg', 'rasdsdfsdfsdf', 'kuba', 6, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `przepisy`
--
ALTER TABLE `przepisy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
