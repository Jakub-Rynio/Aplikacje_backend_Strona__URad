-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 10:10 AM
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
-- Dumping data for table `przepisy`
--

INSERT INTO `przepisy` (`tytul`, `kategoria`, `obrazek`, `tresc`, `dodane_przez`, `id`, `active`, `data`, `opis`) VALUES
('test', 'taka', '1764588116_692d7a54d3b8d.jpg', 'tressssssssssssssccccc', 'kuba', 3, 1, '2025-12-01', NULL),
('test', 'taka', '1764588220_692d7abc79c88.jpg', 'tressssssssssssssccccc', 'kuba', 4, 1, '2025-12-01', NULL),
('NOWY', 'KAT', '1764597570_692d9f42d1e18.jpg', 'rasdsdfsdfsdf', 'kuba', 6, 1, '2025-12-01', NULL),
('Lorem Ipsum', 'zupa', '1765439694_693a78ce325b1.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis venenatis eros, gravida finibus augue dignissim vitae. Mauris bibendum dui aliquet odio lobortis, id convallis dolor efficitur. Sed et felis consectetur sapien imperdiet tempor mollis eget dolor. Suspendisse convallis nisl ac enim tincidunt, eget ultrices magna ultricies. Aenean rutrum commodo quam vitae finibus. Donec mollis sagittis imperdiet. Proin metus diam, volutpat non commodo vel, sagittis quis lectus. Pellentesque in fermentum est, porta porta est. Quisque tempus augue lacinia, tincidunt nunc sit amet, malesuada tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum dignissim, quam sit amet accumsan fringilla, felis nulla euismod neque, id consectetur enim nisl id mauris. Nullam placerat pharetra leo sed elementum. Curabitur feugiat, orci ac dictum pellentesque, ligula nunc porta tellus, id maximus lectus massa id nisi.\r\n\r\nAenean lacus leo, faucibus vitae efficitur sed, volutpat eu lacus. Nulla ultrices aliquam felis vel tempor. Cras pulvinar elit vitae felis commodo rutrum. Vivamus euismod risus pharetra, tempor massa eget, mollis magna. Nullam condimentum urna sed neque laoreet, id commodo libero luctus. Cras viverra diam et lorem hendrerit, vel imperdiet mi interdum. Nullam fringilla malesuada leo quis sagittis. Phasellus porta quam id mauris cursus maximus.\r\n\r\nNunc iaculis luctus metus. Proin rhoncus consectetur quam ut pellentesque. Sed neque orci, egestas in quam eget, scelerisque sagittis nulla. Nam sit amet justo ac diam pulvinar gravida iaculis eu arcu. Nunc purus sem, pulvinar eget mauris non, blandit imperdiet tortor. Mauris at leo non ante luctus scelerisque a eget tellus. Aliquam erat volutpat. Nullam efficitur libero ac ex bibendum, eget eleifend diam bibendum. Sed id ipsum molestie, cursus sem varius, congue justo. Curabitur facilisis diam et aliquam condimentum. Quisque ut fermentum erat, a elementum odio. Maecenas eu vestibulum justo, at fermentum est.\r\n\r\nQuisque ac maximus urna, sed aliquam lectus. Maecenas at tristique lectus. Nam fermentum nisl ut ligula pharetra gravida. Nulla sollicitudin fermentum fringilla. Mauris fermentum orci et tellus lacinia tempor. Maecenas ultricies, dui ac ullamcorper auctor, sapien tellus interdum arcu, a rhoncus augue felis molestie dui. Aliquam convallis purus orci, eu interdum urna viverra eu. Nunc et lacus quis ante eleifend sagittis. Quisque rhoncus quam non rutrum dictum. Praesent eget lacus euismod, iaculis diam et, ultricies nunc. Etiam suscipit dignissim nisi, eget ornare risus fringilla sit amet. Cras dignissim, velit vitae scelerisque porta, orci augue dignissim lorem, et finibus felis justo nec dolor.\r\n\r\nInteger malesuada eu arcu sagittis placerat. Nulla non vehicula urna. Curabitur auctor condimentum ex, at blandit ligula pretium at. Nullam eget ipsum et nisi dignissim sollicitudin. Nunc felis ex, faucibus id sem ultrices, hendrerit egestas nibh. Curabitur lacus odio, ultricies vel pulvinar ac, vehicula nec turpis. Duis est odio, malesuada quis lacus in, semper dictum erat. Ut ut consequat ex, ut efficitur justo. Maecenas vel viverra ligula. Donec rutrum condimentum urna, vel eleifend orci lacinia quis. Vestibulum viverra aliquet tortor at pellentesque. Sed sodales ultricies turpis ut elementum. Curabitur vitae sapien nec tellus convallis vestibulum.', 'kuba', 7, 1, '2025-12-01', NULL),
('TEST DATY', 'DATA i opis', '1765443933_693a895db23f9.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mattis venenatis eros, gravida finibus augue dignissim vitae. Mauris bibendum dui aliquet odio lobortis, id convallis dolor efficitur. Sed et felis consectetur sapien imperdiet tempor mollis eget dolor. Suspendisse convallis nisl ac enim tincidunt, eget ultrices magna ultricies. Aenean rutrum commodo quam vitae finibus. Donec mollis sagittis imperdiet. Proin metus diam, volutpat non commodo vel, sagittis quis lectus. Pellentesque in fermentum est, porta porta est. Quisque tempus augue lacinia, tincidunt nunc sit amet, malesuada tellus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vestibulum dignissim, quam sit amet accumsan fringilla, felis nulla euismod neque, id consectetur enim nisl id mauris. Nullam placerat pharetra leo sed elementum. Curabitur feugiat, orci ac dictum pellentesque, ligula nunc porta tellus, id maximus lectus massa id nisi.\r\n\r\nAenean lacus leo, faucibus vitae efficitur sed, volutpat eu lacus. Nulla ultrices aliquam felis vel tempor. Cras pulvinar elit vitae felis commodo rutrum. Vivamus euismod risus pharetra, tempor massa eget, mollis magna. Nullam condimentum urna sed neque laoreet, id commodo libero luctus. Cras viverra diam et lorem hendrerit, vel imperdiet mi interdum. Nullam fringilla malesuada leo quis sagittis. Phasellus porta quam id mauris cursus maximus.\r\n\r\nNunc iaculis luctus metus. Proin rhoncus consectetur quam ut pellentesque. Sed neque orci, egestas in quam eget, scelerisque sagittis nulla. Nam sit amet justo ac diam pulvinar gravida iaculis eu arcu. Nunc purus sem, pulvinar eget mauris non, blandit imperdiet tortor. Mauris at leo non ante luctus scelerisque a eget tellus. Aliquam erat volutpat. Nullam efficitur libero ac ex bibendum, eget eleifend diam bibendum. Sed id ipsum molestie, cursus sem varius, congue justo. Curabitur facilisis diam et aliquam condimentum. Quisque ut fermentum erat, a elementum odio. Maecenas eu vestibulum justo, at fermentum est.\r\n\r\nQuisque ac maximus urna, sed aliquam lectus. Maecenas at tristique lectus. Nam fermentum nisl ut ligula pharetra gravida. Nulla sollicitudin fermentum fringilla. Mauris fermentum orci et tellus lacinia tempor. Maecenas ultricies, dui ac ullamcorper auctor, sapien tellus interdum arcu, a rhoncus augue felis molestie dui. Aliquam convallis purus orci, eu interdum urna viverra eu. Nunc et lacus quis ante eleifend sagittis. Quisque rhoncus quam non rutrum dictum. Praesent eget lacus euismod, iaculis diam et, ultricies nunc. Etiam suscipit dignissim nisi, eget ornare risus fringilla sit amet. Cras dignissim, velit vitae scelerisque porta, orci augue dignissim lorem, et finibus felis justo nec dolor.\r\n\r\nInteger malesuada eu arcu sagittis placerat. Nulla non vehicula urna. Curabitur auctor condimentum ex, at blandit ligula pretium at. Nullam eget ipsum et nisi dignissim sollicitudin. Nunc felis ex, faucibus id sem ultrices, hendrerit egestas nibh. Curabitur lacus odio, ultricies vel pulvinar ac, vehicula nec turpis. Duis est odio, malesuada quis lacus in, semper dictum erat. Ut ut consequat ex, ut efficitur justo. Maecenas vel viverra ligula. Donec rutrum condimentum urna, vel eleifend orci lacinia quis. Vestibulum viverra aliquet tortor at pellentesque. Sed sodales ultricies turpis ut elementum. Curabitur vitae sapien nec tellus convallis vestibulum.', 'kuba', 8, 1, '2025-12-11', 'JESTEM OPISEM I OPISUJE TEGO TU POSTA');

--
-- Indeksy dla zrzutów tabel
--

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
-- AUTO_INCREMENT for table `przepisy`
--
ALTER TABLE `przepisy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `przepisy`
--
ALTER TABLE `przepisy`
  ADD CONSTRAINT `wpis_i_mod` FOREIGN KEY (`dodane_przez`) REFERENCES `moderatorzy` (`login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
