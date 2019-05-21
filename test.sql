-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2019 at 12:54 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `type`, `value`) VALUES
(1, 'Language', 'English'),
(2, 'Genre', 'Action'),
(3, 'Language', 'Hindi'),
(4, 'Genre', 'Comedy');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `length_in_minutes` int(11) DEFAULT NULL,
  `release_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `title`, `description`, `image`, `length_in_minutes`, `release_date`) VALUES
(1, 'Jurassic World', 'A movie about dinosaurs', NULL, 90, '2015-06-14 00:00:00'),
(2, 'Kick', 'Salman Khan movie', NULL, 120, '2014-04-11 00:00:00'),
(3, 'Total Dhamal', 'Comedy movie ', NULL, 96, '2018-06-15 00:00:00'),
(4, 'Uri', 'A film on surgical strike', NULL, 98, '2018-04-27 00:00:00'),
(5, 'Hum Apke Hai Kaun ', 'One of the old movie', NULL, 110, '2012-03-16 00:00:00'),
(6, 'Dil', 'A hindi movie', NULL, 123, '2017-12-15 00:00:00'),
(7, 'Titanic', 'An english movie', NULL, 109, '1998-04-10 00:00:00'),
(8, 'Run', 'An hindi movie', NULL, 88, '2008-04-11 00:00:00'),
(9, 'Dilwale', 'Shahrukh khan film', NULL, 114, '2005-02-04 00:00:00'),
(10, 'Josh', 'Film shot in goa', NULL, 123, '1999-07-16 00:00:00'),
(11, 'Kaho Na Pyaar Hai', 'An Hrithik Roshan movie', NULL, 101, '1995-07-21 00:00:00'),
(12, 'Sanju', 'Sanjay Dutt biopic', NULL, 105, '2018-05-18 00:00:00'),
(13, 'Fast and Furious', 'An english movie ', NULL, 90, '2014-04-11 00:00:00'),
(14, 'Supernova', 'An optional movie', NULL, 86, '2017-09-22 00:00:00'),
(15, 'Special 26', 'Based on true story', NULL, 119, '2016-05-13 00:00:00'),
(16, 'Satyagraha', 'A good hindi movie', NULL, 94, '2015-04-17 00:00:00'),
(17, 'Dhamaal', 'Another comedy movie', NULL, 105, '2014-12-26 00:00:00'),
(18, 'Munna Bhai MBBS', 'A film on gandhigiri.', NULL, 128, '2009-05-15 00:00:00'),
(19, 'Sajan', 'An blockbuster hindi movie.', NULL, 115, '1995-01-20 00:00:00'),
(20, 'Border', 'Film on Indian soldiers', NULL, 130, '2002-11-08 00:00:00'),
(21, 'Jodha Akbar', 'Film based on Indian king.', NULL, 112, '2007-02-16 00:00:00'),
(22, '3 Idiots', 'Film on engineering students', NULL, 116, '2014-04-25 00:00:00'),
(23, 'Rang De Basanti', 'Film related to Indian freedom struggle', NULL, 95, '2008-04-18 00:00:00'),
(24, 'Deewar', 'A movie well watched by many people', NULL, 78, '1984-04-27 00:00:00'),
(25, 'Sholay', 'Blockbuster movie form 70\'s', NULL, 93, '1974-09-20 00:00:00'),
(26, 'Refugee', 'A film on border conflicts', NULL, 97, '2000-06-16 00:00:00'),
(27, 'PK', 'Film related to aliens', NULL, 106, '2017-09-08 00:00:00'),
(28, 'Black', 'One of the good movie', NULL, 79, '2011-03-25 00:00:00'),
(29, 'Singham', 'Film on policeman and crime', NULL, 93, '2016-06-24 00:00:00'),
(30, 'Simbha', 'Film related to crime in cities', NULL, 101, '2018-12-21 00:00:00'),
(31, 'Soldier', 'Film based on a soldier story', NULL, 104, '1999-05-07 00:00:00'),
(32, 'Yuva', 'Movie related to youth', NULL, 110, '2008-06-20 00:00:00'),
(33, 'Devdas', 'Film related to ancient history', NULL, 109, '2015-04-03 00:00:00'),
(34, 'Bajirao Mastani', 'Film related to ancient Indian king', NULL, 136, '2018-09-21 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`id`, `category_id`, `movie_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 1, 3),
(6, 3, 15),
(7, 4, 7),
(8, 3, 16),
(9, 1, 4),
(10, 2, 14),
(11, 1, 16),
(12, 4, 30),
(13, 2, 20),
(14, 3, 31),
(15, 4, 32),
(16, 1, 34),
(17, 2, 18),
(18, 3, 9),
(19, 4, 7),
(20, 3, 27),
(21, 1, 2),
(22, 1, 5),
(23, 1, 6),
(24, 1, 7),
(25, 1, 8),
(26, 1, 9),
(27, 1, 10),
(28, 1, 17),
(29, 1, 18),
(30, 1, 19),
(31, 1, 20),
(32, 1, 12),
(33, 1, 13),
(34, 1, 14),
(35, 1, 15),
(36, 1, 21),
(37, 1, 22),
(38, 1, 23),
(39, 1, 24),
(40, 1, 25),
(41, 1, 26),
(42, 1, 27),
(43, 1, 28),
(44, 1, 29),
(45, 1, 30),
(46, 1, 31),
(47, 1, 32),
(48, 1, 33);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
