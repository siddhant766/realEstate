-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 10:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `j`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `property_name` varchar(255) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_email`, `property_name`, `appointment_date`, `appointment_time`, `message`) VALUES
(1, 'janhvigupta5555@gmail.com', 'KH', '2025-04-16', '03:33:00', 'hii i want to buy you');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` int(11) NOT NULL,
  `inquiry_type` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `max_price` decimal(15,2) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `inquiry_type`, `user_type`, `first_name`, `last_name`, `email`, `phone`, `city`, `zip_code`, `property_type`, `max_price`, `bedrooms`, `bathrooms`, `message`, `submission_date`) VALUES
(1, 'delhi', 'buyer', 'we4', 'wfew', 'fweewg@gmail.com', '1234567890', 'mumbai', '123456', 'apartment', 1234.00, 2, 2, '123456', '2025-04-14 13:48:43'),
(2, 'mumbai', 'buyer', 'fef', 'wewfwa', 'fasd@gmail.com', '1234567890', 'mumbai', '234567', 'apartment', 123.00, 1, 3, 'qdwfegrhtyds', '2025-04-14 15:42:08'),
(3, 'jaipur', 'buyer', 'vaishnavi', 'gupta', 'vaishnavi@gmail.com', '8840178778', 'jaipur', '123234', 'house', 81209.00, 1, 1, 'BFIH;wgf', '2025-04-14 17:28:22'),
(4, 'bengaluru', 'buyer', 'dhanshree', 'gupta', 'dhanshree@gmail.com', '8840178778', 'bengaluru', '357858', 'villa', 778990.00, 4, 2, '6euiol', '2025-04-15 06:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `property_type` varchar(50) NOT NULL,
  `images` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `seller_id`, `title`, `description`, `price`, `location`, `property_type`, `images`, `created_at`) VALUES
(1, 1, 'cbgre', 'rgresga', 4354.00, 'fsdg', 'house', '[\"uploads\\/properties\\/67f2be7ed82aa.jpg\"]', '2025-04-06 17:48:46'),
(3, 1, 'lkhg', 'jvjv', 234.00, 'cc', 'house', '', '2025-04-06 18:08:09'),
(6, 1, 'faew', 'feaw', 123.00, '12', 'house', '[\"uploads\\/properties\\/67fd2e24e1e2a.jpg\"]', '2025-04-14 15:47:48'),
(7, 9, 'ihyldge', 'wekhbf;', 446577.00, 'delhi', 'house', '[\"uploads\\/properties\\/67fd467f9fe40.jpeg\"]', '2025-04-14 17:31:43'),
(8, 11, 'villa', 'i want to sell', 5789.00, 'banars', 'land', '[\"uploads\\/properties\\/67fdfff2eb750.jpeg\"]', '2025-04-15 06:42:58'),
(9, 15, 'hd;v;', 'CHVSL.;', 55555.00, 'HYDERBAAD', 'villa', '[\"uploads\\/properties\\/67fea676efde4.jpeg\"]', '2025-04-15 18:33:26'),
(10, 15, 'KH', 'KH', 77777.00, 'mumbai', 'apartment', '[\"uploads\\/properties\\/67fea6a61a875.jpeg\"]', '2025-04-15 18:34:14');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `property_id`, `purchase_date`) VALUES
(1, 2, 1, '2025-04-06 18:37:56'),
(2, 2, 3, '2025-04-06 18:39:56'),
(3, 5, 1, '2025-04-06 19:03:27'),
(4, 5, 3, '2025-04-06 19:04:10'),
(12, 14, 8, '2025-04-15 16:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('buyer','seller') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 's', 's@gmail.com', '$2y$10$b6QP3niJvHGQ/AnkUnyB8Ofkg8cCz8.KohaNgJRlnUhuje.0oMEEe', 'seller', '2025-04-06 17:48:03'),
(2, 'b', 'b@gmail.com', '$2y$10$ilgzJJZk3v8uDaknclS/weaxJ5VK4siR2YrlD9Y6IO8S8kIGAfti6', 'buyer', '2025-04-06 18:09:32'),
(3, 'janhvi', 'janhvi@gmail.com', '$2y$10$cO7UZN6HQCKgev5Wy3H5vu.Ndignsl4OLbXswZOQ05X3fqYhZY26C', 'seller', '2025-04-06 18:48:32'),
(4, 'jjj', 'j@gmail.com', '$2y$10$C7PLaY30xkXYV9keDf42Zuz2jzMfq48t5WQ2lH0vYDeMhYnSp91B2', 'seller', '2025-04-06 18:58:37'),
(5, 'p', 'p@gmail.com', '$2y$10$r86BECm7WcrLxHsVoK3H2uztYn.igqyG3PTVMY9Gyx1pAsMpx9OWe', 'buyer', '2025-04-06 19:02:23'),
(6, 'r', 'r@gmail.com', '$2y$10$EwRDiCJYw.IipZmxZf8HYeExxo9w3m90igXOEYcAiYLqKD996XXjq', 'buyer', '2025-04-14 11:45:40'),
(7, 'shreyu', 'as@gmail.com', '$2y$10$fWtlDiMOE3DRwkvTwUbjwuBZSSOBw/96HRv2L4ALcda3oK5HB5gVS', 'buyer', '2025-04-14 17:20:00'),
(8, 'vaishnavi', 'vaishnavi@gmail.com', '$2y$10$VIAKZoXUcYhgdkJBiPoBN.dgh0gpvTbA238Jsvcb/GOuYNkSTBrJ6', 'buyer', '2025-04-14 17:25:36'),
(9, 'sweety', 'sweety@gmail.com', '$2y$10$afXCEznqUmSwkyBzqMKTa.W6YqU1OYy9p0UTgPLfY.wawTPMmg./a', 'seller', '2025-04-14 17:30:32'),
(10, 'dhanshree', 'dhanshree@gmail.com', '$2y$10$MrvPjPr84NPqEsNY6CR69.zTHxb5/lIlQR9Xjb2QJ059Gs0kNE1ki', 'buyer', '2025-04-15 06:37:55'),
(11, 'sid', 'sid@gmail.com', '$2y$10$hHhFTuy3hK.NiCJ7lCz04eBiDPFloRS1NmRAPYtDsVTb9RFyXQlJC', 'seller', '2025-04-15 06:41:38'),
(12, 'pranshu', 'a@gmail.com', '$2y$10$qUeANbfzQyVckVAL323SvesvilkGYuPS9uceYAbDYwfyg28mXb0jO', 'buyer', '2025-04-15 12:11:18'),
(13, 'pp', 'aa@gmail.com', '$2y$10$oPr5dm5q2E7LQzyYA5a5UeoD4Il8rNx9EfmcQEbCEBIkbV5OS2yP6', 'buyer', '2025-04-15 12:12:51'),
(14, 'Janhvi Gupta', 'janhvigupta5555@gmail.com', '$2y$10$CH8yvnYseMTu893iL2KYMOaRlN3gDyXaHO8R889uzW8OwWx4iZb1a', 'buyer', '2025-04-15 12:50:16'),
(15, 'ss', 'ss@gmail.com', '$2y$10$ytB.d8A.sU5iKEdJCTLDFOU.HJYkYqsrROsVMXJu56ypGw5tIWyNm', 'seller', '2025-04-15 18:13:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
