-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2022 at 04:27 PM
-- Server version: 10.4.27-MariaDB-1:10.4.27+maria~ubu2004-log
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GeniePoints`
--

-- --------------------------------------------------------

--
-- Table structure for table `progress_orders`
--

CREATE TABLE `progress_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `progress_orders`
--

INSERT INTO `progress_orders` (`id`, `user_id`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2022-02-27 03:38:02', '2022-10-19 09:19:47'),
(2, 2, 1, '2022-02-27 03:38:02', '2022-10-11 12:47:14'),
(3, 3, 2, '2022-02-27 03:38:02', '2022-10-11 12:47:14'),
(4, 4, 6, '2022-02-27 03:38:02', '2022-10-19 09:19:47'),
(5, 5, 5, '2022-02-27 03:38:02', '2022-10-19 09:19:47'),
(6, 6, 8, '2022-02-27 03:38:02', '2022-08-30 09:17:11'),
(7, 7, 9, '2022-02-27 03:38:02', '2022-05-13 12:02:26'),
(8, 8, 7, '2022-02-27 03:38:02', '2022-10-11 12:46:53'),
(9, 9, 3, '2022-02-27 03:38:02', '2022-10-19 09:19:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `progress_orders`
--
ALTER TABLE `progress_orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `progress_orders`
--
ALTER TABLE `progress_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
