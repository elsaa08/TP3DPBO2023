-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 10:18 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `id_agensi` int(11) NOT NULL,
  `agensi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`id_agensi`, `agensi`) VALUES
(1, 'American Entertaiment'),
(2, 'Hybe Labels'),
(3, 'YG Ent'),
(4, 'JYP Entertaiment'),
(6, 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(11) NOT NULL,
  `album` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `album`) VALUES
(2, 'FML'),
(3, 'The Second step : chapter three'),
(4, 'D-Day'),
(5, 'Attacca'),
(6, 'RED'),
(8, 'Heng:garae'),
(9, 'Sunrise'),
(10, 'Manifesto: Day 1');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id_music` int(11) NOT NULL,
  `musik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id_music`, `musik`) VALUES
(2, 'Super'),
(3, 'VolKno'),
(4, 'Haegeum'),
(5, 'I Knew you were trouble'),
(7, 'Shout Out'),
(8, 'Rock With You'),
(10, 'I Wish'),
(11, 'Thank You'),
(12, 'Congratulations English ver');

-- --------------------------------------------------------

--
-- Table structure for table `producer`
--

CREATE TABLE `producer` (
  `producer_id` int(11) NOT NULL,
  `producer_foto` varchar(255) NOT NULL,
  `producer_nama` varchar(255) NOT NULL,
  `producer_age` int(11) NOT NULL,
  `music_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `agencies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `producer`
--

INSERT INTO `producer` (`producer_id`, `producer_foto`, `producer_nama`, `producer_age`, `music_id`, `album_id`, `agencies`) VALUES
(2, 'uzi.jpg', 'Woozi svt', 26, 10, 8, 2),
(8, 'SUGA.jpg', 'Suga BTS', 29, 4, 4, 2),
(9, 'taylor.jpg', 'Taylor Swift', 30, 5, 6, 1),
(10, '896941004cde98f16c5c905afbcf6be2.jpg', 'Choi Hyunsuk', 23, 3, 3, 3),
(13, '7ff6c78b5b2d0795378bcaa85622775a.jpg', 'Asahi', 22, 11, 3, 3),
(14, 'wonpil.jpg', 'Wonpil Day6', 28, 12, 9, 4),
(15, 'd683f7b75c49b68bb532561935fa64af.jpg', 'Elsa Nabiilah', 70, 8, 5, 2),
(16, '57d8d781b08873c673cb94efa5a0bce3.jpg', 'Capekk', 20, 7, 10, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`id_agensi`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id_music`);

--
-- Indexes for table `producer`
--
ALTER TABLE `producer`
  ADD PRIMARY KEY (`producer_id`),
  ADD KEY `agensi` (`agencies`),
  ADD KEY `musik` (`music_id`),
  ADD KEY `album` (`album_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `id_agensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id_music` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `producer`
--
ALTER TABLE `producer`
  MODIFY `producer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `producer`
--
ALTER TABLE `producer`
  ADD CONSTRAINT `agensi` FOREIGN KEY (`agencies`) REFERENCES `agencies` (`id_agensi`),
  ADD CONSTRAINT `album` FOREIGN KEY (`album_id`) REFERENCES `album` (`id_album`),
  ADD CONSTRAINT `musik` FOREIGN KEY (`music_id`) REFERENCES `music` (`id_music`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
