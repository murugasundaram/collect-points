-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2022 at 04:26 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nick_name` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 2,
  `is_support_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nick_name`, `role`, `is_support_admin`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Muruga', 1, 0, 'sgdms123@gmail.com', NULL, '$2y$10$/IUTR1Vh8.ltl89cU5h0ROyJJpPz442Fc5wIxb1bUFUHyPQ5YfdKi', NULL, '2022-02-26 21:47:03', '2022-02-26 21:47:03'),
(2, 'Praveen A', 'Praveen', 2, 0, 'praveen@est.com', NULL, '$2y$10$OvKIQTIgty/GqvoxMjvbaOJjvEdJcKLkZRKk2gjFRXN4qmoZdKrwS', NULL, '2022-02-26 22:28:50', '2022-02-26 22:28:50'),
(3, 'Karthick Ravikumar', 'Karthick', 2, 0, 'karthik@est.com', NULL, '$2y$10$KHHnPUfLPFz/4u2P4IvRhedJjKjUXKLVpOG55AVdQIDSug5Xg4Mo6', NULL, '2022-02-26 22:35:01', '2022-02-26 22:35:01'),
(4, 'Deepak Manoharan', 'Deepak', 2, 0, 'deepak@est.com', NULL, '$2y$10$5xHiN7m7kJNDvOyPR/tk2exedWmcwOZQHM3fumrINfb1URsK8V/nK', NULL, '2022-02-26 22:35:38', '2022-02-26 22:35:38'),
(5, 'Samuel Raja', 'Sam', 2, 0, 'sam@est.com', NULL, '$2y$10$FVi3NuxZ4cHjT8WS/SY9ROmJ/LOXShOm/qrFRNt7KofbmIn8sUaeG', NULL, '2022-02-26 22:36:10', '2022-02-26 22:36:10'),
(6, 'Velmurugan M', 'Vel', 2, 0, 'vel@est.com', NULL, '$2y$10$/IUTR1Vh8.ltl89cU5h0ROyJJpPz442Fc5wIxb1bUFUHyPQ5YfdKi', NULL, '2022-02-26 22:36:49', '2022-02-26 22:36:49'),
(7, 'Prabha L', 'Prabha', 2, 0, 'prabha@est.com', NULL, '$2y$10$0TYn/2Gq7LzKhNEJUePrYungls/5lN8hmCNkgNNykOUXV3PfPOdbu', NULL, '2022-02-26 22:37:23', '2022-02-26 22:37:23'),
(8, 'Tester', 'Giri', 2, 1, 'giri@est.com', NULL, '$2y$10$L7/N7SL4PsuALtvBF3paIeL2JVP0CM.xhUXKEBRXPUjyy6mfGMq1i', NULL, '2022-02-26 22:37:57', '2022-02-26 22:37:57'),
(9, 'Jeffirn WSM', 'Jeff', 2, 0, 'jeff@est.com', NULL, '$2y$10$k10OsYh340YbbFRSNp9sruiq9vFha1xRpXiEmBFnqTcJtOocJYDUa', NULL, '2022-02-26 22:38:32', '2022-02-26 22:38:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
