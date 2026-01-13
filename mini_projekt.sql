-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2026 at 01:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `reset_token_hash` varchar(255) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `reset_token_hash`, `reset_token_expires_at`, `password`) VALUES
(1, 'Raimond302', 'raimondseniut302@gmail.com', NULL, NULL, '$2y$10$joQNI0yspya0rEDb2g4RC.fESdAZ/dJ3/DGez0ESvO8qtwEzeZRfi'),
(2, 'Raimond304', 'rajmond2015@gmail.com', 'dde69e5df05e7aa237c6133ce1e664562c4c62125fe0dc4d21fa5860f1c32e41', '2026-01-13 12:31:39', '$2y$10$KzN/Ppdraw8lCUvynSMxseXKAC5zxoA/crd4o3UVkQSht0mIgkap.'),
(9, 'Witold123', 'witold@gmail.com', NULL, NULL, '$2y$10$kmmPneVO/0w8J3CalFDKrOU/So46MPJMbB6exZuU/s6EbEvU3Uo1O'),
(10, 'a', 'a@gmail.com', NULL, NULL, '$2y$10$Y/Z/FQjv7mpbQQKh41UEIe33IEJQMI4Lqnqz8yKbVHUZD6cFHHBZC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
