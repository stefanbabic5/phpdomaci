-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 06:53 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pozoriste`
--
CREATE DATABASE IF NOT EXISTS `pozoriste` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pozoriste`;

-- --------------------------------------------------------

--
-- Table structure for table `predstava`
--

DROP TABLE IF EXISTS `predstava`;
CREATE TABLE `predstava` (
  `id` bigint(20) NOT NULL,
  `naziv` varchar(40) DEFAULT NULL,
  `trajanje` int(11) DEFAULT NULL,
  `ocena` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predstava`
--

INSERT INTO `predstava` (`id`, `naziv`, `trajanje`, `ocena`) VALUES
(13, 'Veliki Getsbi', 120, '9.20'),
(14, 'Turandot', 100, '8.30'),
(16, 'Dolce Vita', 90, '7.77');

-- --------------------------------------------------------

--
-- Table structure for table `raspored`
--

DROP TABLE IF EXISTS `raspored`;
CREATE TABLE `raspored` (
  `id` bigint(20) NOT NULL,
  `predstava_id` bigint(20) DEFAULT NULL,
  `scena_id` bigint(20) DEFAULT NULL,
  `cena` decimal(7,2) DEFAULT NULL,
  `datum` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `raspored`
--

INSERT INTO `raspored` (`id`, `predstava_id`, `scena_id`, `cena`, `datum`) VALUES
(15, 13, 1, '1500.00', '2023-01-24 20:00:00'),
(16, 14, 1, '1000.00', '2023-01-26 21:00:00'),
(17, 16, 2, '777.00', '2023-01-14 19:00:00'),
(18, 16, 2, '777.00', '2023-01-23 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `scena`
--

DROP TABLE IF EXISTS `scena`;
CREATE TABLE `scena` (
  `id` bigint(20) NOT NULL,
  `naziv` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scena`
--

INSERT INTO `scena` (`id`, `naziv`) VALUES
(1, 'Velika scena'),
(2, 'Mala scena');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `predstava`
--
ALTER TABLE `predstava`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raspored`
--
ALTER TABLE `raspored`
  ADD PRIMARY KEY (`id`),
  ADD KEY `predstava_id` (`predstava_id`),
  ADD KEY `scena_id` (`scena_id`);

--
-- Indexes for table `scena`
--
ALTER TABLE `scena`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `predstava`
--
ALTER TABLE `predstava`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `raspored`
--
ALTER TABLE `raspored`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `scena`
--
ALTER TABLE `scena`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `raspored`
--
ALTER TABLE `raspored`
  ADD CONSTRAINT `raspored_ibfk_1` FOREIGN KEY (`predstava_id`) REFERENCES `predstava` (`id`),
  ADD CONSTRAINT `raspored_ibfk_2` FOREIGN KEY (`scena_id`) REFERENCES `scena` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
