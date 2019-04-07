-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: shareddb-m.hosting.stackcp.net
-- Generation Time: Mar 27, 2019 at 05:25 PM
-- Server version: 10.2.18-MariaDB-log
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `INR`
--

CREATE TABLE `INR` (
  `id` int(10) UNSIGNED NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `INR` decimal(3,1) NOT NULL,
  `Mon` tinyint(2) NOT NULL,
  `Tue` tinyint(2) NOT NULL,
  `Wed` tinyint(2) NOT NULL,
  `Thu` tinyint(2) NOT NULL,
  `Fri` tinyint(2) NOT NULL,
  `Sat` tinyint(2) NOT NULL,
  `Sun` tinyint(2) NOT NULL,
  `Total` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `INR`
--
ALTER TABLE `INR`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `INR`
--
ALTER TABLE `INR`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
