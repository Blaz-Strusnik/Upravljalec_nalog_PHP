-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 22. jan 2022 ob 16.06
-- Različica strežnika: 10.4.22-MariaDB
-- Različica PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `udelezenec95`
--

-- --------------------------------------------------------

--
-- Struktura tabele `naloge`
--

CREATE TABLE `naloge` (
  `id` bigint(20) NOT NULL,
  `naloga` varchar(750) DEFAULT NULL,
  `opravljena` int(2) NOT NULL DEFAULT 0,
  `dt` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `naloge`
--

INSERT INTO `naloge` (`id`, `naloga`, `opravljena`, `dt`) VALUES
(1, 'računalništvo', 1, '2022-01-13 16:00:00'),
(2, 'računalništvo 2', 1, '2022-01-14 18:00:00'),
(3, 'računalništvo', 0, '2022-01-27 15:24:22'),
(4, 'računalništvo', 0, '2022-01-27 15:24:22'),
(5, 'računalništvo', 1, '2022-01-15 19:00:00');

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `userid` mediumint(6) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `registration_date` datetime NOT NULL,
  `loged_in` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`userid`, `first_name`, `last_name`, `email`, `password`, `registration_date`, `loged_in`) VALUES
(28, 'Blaz', 'Blaz', 'b@b.b', '$2y$10$jwmlRYinCHMzClZUERG4zuPOhteY843sB96BIO/tuKrW2SW0fU6ze', '2022-01-21 16:24:53', 0),
(29, 'g', 'g', 'g@g.g', '$2y$10$7RhnXMdxMqfSDSV3r08y.OHooy5IbOS7GMGepLqaRCbeahtgPfBne', '2022-01-22 13:59:03', 0),
(31, 'j', 'j', 'j@j.j', '$2y$10$P41G0Bly92yXtftIWtgoNeqQcFnfup/i6U.gYBjdGXtHNTq2ohhKC', '2022-01-22 14:07:25', 0);

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `naloge`
--
ALTER TABLE `naloge`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `naloge`
--
ALTER TABLE `naloge`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `userid` mediumint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
