-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 07:50 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `picknride_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `role_id`, `name`, `email`, `phone`, `password`, `profile_pic`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'malik ateeq', 'malik@gmail.com', NULL, '$2y$10$lCujjfEFFLpQUjvZSO1Fpen25A5fgwj3JiEhsRbGbP1cyvuaE6dpi', 'user.png', NULL, '2019-06-17 06:48:06', '2019-06-17 06:48:06'),
(2, 2, 'Saad Ullah', 'saad@gmail.com', NULL, '$2y$10$SKtN0Zjpkc16liRfmk8Nn.o0hD6QPhJj4opwZ.TQRO0P9SMD7/8kG', 'user.png', NULL, '2019-06-17 06:48:07', '2019-06-17 06:48:07'),
(3, 3, 'Khalid Raza', 'khalid@gmail.com', NULL, '$2y$10$kHqSErS05fDzyABf.ttF9.NENrZ.kJaAXWvcuGfonvWN0xDMV09uO', 'user.png', NULL, '2019-06-17 06:48:07', '2019-06-17 06:48:07');

-- --------------------------------------------------------

--
-- Table structure for table `directions`
--

CREATE TABLE `directions` (
  `direction_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `origin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startAddr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endAddr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routeOf` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wayPoints` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stops` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `directions`
--

INSERT INTO `directions` (`direction_id`, `user_id`, `origin`, `destination`, `startAddr`, `endAddr`, `distance`, `duration`, `routeOf`, `wayPoints`, `stops`, `created_at`, `updated_at`) VALUES
(1, 1, '33.5650702,73.0168982', '33.6844104,73.0478922', 'Unnamed Road, Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', 'Unnamed Road, Islamabad, Islamabad Capital Territory, Pakistan', '20', '50', 'driver', NULL, NULL, '2019-06-17 06:49:44', '2019-06-17 06:49:44'),
(2, 5, '33.5650702,73.0168982', '24.8607333,67.0011246', 'Unnamed Road, Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', '2, Napier Quarter, Karachi, Karachi City, Sindh, Pakistan', '1376', '1399', 'driver', NULL, NULL, '2019-06-17 06:52:13', '2019-06-17 06:52:13'),
(3, 5, '33.5650702,73.0168982', '33.6844104,73.0478922', '693 Lane Number 2, Quaid-e-Azam Colony Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', 'Unnamed Road, Islamabad, Islamabad Capital Territory, Pakistan', '20', '50', 'rider', NULL, 'Unnamed Road, Islamabad, Islamabad Capital Territory, Pakistan |', '2019-06-17 06:53:36', '2019-06-17 06:53:36'),
(4, 7, '33.5650702,73.0168982', '36.3171667,74.6495252', '693 Lane Number 2, Quaid-e-Azam Colony Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', 'College Road, Garelt', '575', '818', 'rider', NULL, 'College Road, Garelt |', '2019-06-17 06:57:22', '2019-06-17 06:57:22'),
(5, 8, '33.5650702,73.0168982', '34.0153499,71.5252936', '693 Lane Number 2, Quaid-e-Azam Colony Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', 'Gula Baba Rd, Tahkal, Peshawar, Khyber Pakhtunkhwa, Pakistan', '202', '312', 'rider', NULL, 'Gula Baba Rd, Tahkal, Peshawar, Khyber Pakhtunkhwa, Pakistan |', '2019-06-17 06:59:04', '2019-06-17 06:59:04'),
(6, 6, '33.5650702,73.0168982', '34.0153499,71.5252936', '693 Lane Number 2, Quaid-e-Azam Colony Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', 'Gula Baba Rd, Tahkal, Peshawar, Khyber Pakhtunkhwa, Pakistan', '202', '312', 'driver', NULL, NULL, '2019-06-17 06:59:44', '2019-06-17 06:59:44'),
(7, 1, '33.5650702,73.0168982', '33.6844104,73.0478922', '693 Lane Number 2, Quaid-e-Azam Colony Quaid e Azam Colony, Rawalpindi, Punjab, Pakistan', 'Unnamed Road, Islamabad, Islamabad Capital Territory, Pakistan', '20', '50', 'rider', NULL, 'Unnamed Road, Islamabad, Islamabad Capital Territory, Pakistan |', '2019-06-28 06:49:22', '2019-06-28 06:49:22');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `driver_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `direction_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`driver_id`, `role_id`, `info_id`, `direction_id`, `name`, `email`, `phone`, `profile_pic`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 'John Doe', 'driver@gmail.com', '03123456874', '1561727710.png', '$2y$10$SJNG0gAdu9sPdR6HnfXe9O00fPEcDZKyp5xIOCk0NubkNzqOzEfVe', NULL, '2019-06-17 06:48:07', '2019-06-28 09:18:02'),
(2, 5, NULL, NULL, 'Khan Sab', 'b@gmail.com', NULL, 'user.png', '$2y$10$7xqWeZn3euXNkQoWgjr4Xu3xx4a6iS/quOZ4jPONxyWXKuDsoyYxG', NULL, '2019-06-17 06:48:07', '2019-06-17 06:48:07'),
(3, 6, NULL, NULL, 'Khan Sab', 'c@gmail.com', NULL, 'user.png', '$2y$10$MtaI91cbZSImyo38Ar95Zu0jv.GZ2zIwI8JPISer65udJuoX2.UM6', NULL, '2019-06-17 06:48:08', '2019-06-17 06:48:08'),
(4, 7, NULL, NULL, 'Khan Sab', 'd@gmail.com', NULL, 'user.png', '$2y$10$pxZl1koeZ9EMEQSwQur.wOF.j7bYePJ5vJBQr3cuLuveyAUdUXC0G', NULL, '2019-06-17 06:48:08', '2019-06-17 06:48:08'),
(5, 12, 2, 2, 'driver1', 'driver1@gmail.com', '12311234323', '1560772373.jpeg', '$2y$10$7rfRVe0Zkees8GCNwSafw.wxUiJnE4N9f79u7ieavn/OZyzYL2are', NULL, '2019-06-17 06:51:54', '2019-06-17 06:52:53'),
(6, 17, 3, 6, 'driver4', 'driver4@gmail.com', '23453245432', '1560772814.jpeg', '$2y$10$ckMYNm3qw5tmpEL44o5NEOcjds2HeAlAaJbWr3fOBfCRcG98p2oQi', NULL, '2019-06-17 06:59:31', '2019-06-17 07:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `conversation_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_id` int(10) UNSIGNED NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `conversation_id`, `image`, `receiver_id`, `message`, `created_at`, `updated_at`) VALUES
(5, 8, '4_8', NULL, 4, 'done', '2019-06-28 07:14:38', '2019-06-28 07:14:38'),
(6, 8, '4_8', NULL, 4, 'sent', '2019-06-28 07:19:06', '2019-06-28 07:19:06'),
(7, 8, '4_8', NULL, 4, 'done', '2019-06-28 07:19:15', '2019-06-28 07:19:15'),
(8, 8, '4_8', NULL, 4, 'test', '2019-06-28 07:19:56', '2019-06-28 07:19:56'),
(9, 4, '4_8', NULL, 8, 'ok', '2019-06-28 08:12:59', '2019-06-28 08:12:59'),
(10, 4, '4_8', NULL, 8, 'received', '2019-06-28 08:13:12', '2019-06-28 08:13:12'),
(11, 8, '4_8', NULL, 4, 'test', '2019-06-28 08:30:25', '2019-06-28 08:30:25'),
(12, 8, '4_8', NULL, 4, 'ok', '2019-06-28 08:34:03', '2019-06-28 08:34:03'),
(13, 8, '4_8', NULL, 4, 'm', '2019-06-28 08:38:05', '2019-06-28 08:38:05'),
(14, 8, '4_8', NULL, 4, 'a', '2019-06-28 08:38:08', '2019-06-28 08:38:08'),
(15, 8, '4_8', NULL, 4, 'l', '2019-06-28 08:38:12', '2019-06-28 08:38:12'),
(16, 8, '4_8', NULL, 4, 'o', '2019-06-28 08:38:59', '2019-06-28 08:38:59'),
(17, 8, '4_8', NULL, 4, 'v', '2019-06-28 08:39:04', '2019-06-28 08:39:04'),
(18, 8, '4_8', NULL, 4, 'f', '2019-06-28 08:39:25', '2019-06-28 08:39:25'),
(19, 8, '4_8', NULL, 4, 'g', '2019-06-28 08:42:12', '2019-06-28 08:42:12'),
(20, 8, '4_8', NULL, 4, 'test', '2019-06-28 08:42:49', '2019-06-28 08:42:49'),
(21, 8, '4_8', NULL, 4, 'asdaasdas', '2019-06-28 08:51:40', '2019-06-28 08:51:40'),
(22, 8, '4_8', NULL, 4, 'go', '2019-06-28 09:18:58', '2019-06-28 09:18:58'),
(23, 4, '4_8', NULL, 8, 'get', '2019-06-28 09:19:03', '2019-06-28 09:19:03'),
(24, 4, '4_8', NULL, 8, 'send', '2019-06-28 09:24:45', '2019-06-28 09:24:45'),
(25, 8, '4_8', NULL, 4, 'received', '2019-06-28 09:25:00', '2019-06-28 09:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_02_26_210547_create_admins_table', 1),
(3, '2019_02_26_210728_create_drivers_table', 1),
(4, '2019_02_26_214508_create_users_table', 1),
(5, '2019_03_07_120134_create_directions_table', 1),
(6, '2019_03_07_120217_create_rideinfo_table', 1),
(7, '2019_04_04_080819_create_riders_table', 1),
(8, '2019_04_21_103234_create_ride_preferences_table', 1),
(9, '2019_05_19_143151_create_messages_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rideinfo`
--

CREATE TABLE `rideinfo` (
  `info_id` int(10) UNSIGNED NOT NULL,
  `total_seats` int(11) DEFAULT NULL,
  `reserved_seats` int(11) DEFAULT NULL,
  `v_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fare` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passengers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Male/Female',
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rideinfo`
--

INSERT INTO `rideinfo` (`info_id`, `total_seats`, `reserved_seats`, `v_type`, `fare`, `passengers`, `departure_time`, `arrival_time`, `description`, `created_at`, `updated_at`) VALUES
(1, 11, 6, 'van', NULL, 'male/female', '02:00:00', '16:00:00', NULL, '2019-06-17 06:50:27', '2019-06-17 06:50:27'),
(2, 15, 5, 'bus', NULL, 'male', '14:01:00', '14:01:00', NULL, '2019-06-17 06:52:32', '2019-06-17 06:52:32'),
(3, 7, 3, 'car', NULL, 'female', '15:01:00', '14:01:00', NULL, '2019-06-17 07:00:05', '2019-06-17 07:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `riders`
--

CREATE TABLE `riders` (
  `rider_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `direction_id` int(11) DEFAULT NULL,
  `pref_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `riders`
--

INSERT INTO `riders` (`rider_id`, `role_id`, `direction_id`, `pref_id`, `name`, `email`, `phone`, `profile_pic`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 8, 7, NULL, 'Peter Mckinnon', 'rider@gmail.com', '03112345678', '1561727691.png', '$2y$10$hgjus4Q4ihy8p1nM2eYGTusWwqrP0HLTe9A2JIsuBAxKp0kp2KtNG', NULL, '2019-06-17 06:48:08', '2019-06-28 09:18:14'),
(2, 9, NULL, NULL, 'Khan Sab', 'f@gmail.com', NULL, 'user.png', '$2y$10$VjxhBu59BQ9Tok4UEhrPh.BoMcjgR9gHdZaGn7HeXI5MWWxHOCBZu', NULL, '2019-06-17 06:48:08', '2019-06-17 06:48:08'),
(3, 10, NULL, NULL, 'Khan Sab', 'g@gmail.com', NULL, 'user.png', '$2y$10$azPINxKKAWY.YjahxW5GSuHIcHOMA3X9tc385CKZHk.xcldsQ/YNa', NULL, '2019-06-17 06:48:09', '2019-06-17 06:48:09'),
(4, 11, NULL, NULL, 'Khan Sab', 'h@gmail.com', NULL, 'user.png', '$2y$10$Ws6N7RbIuem6V96I82hT..iGw/4VHAkuZrsRgDeG.EkvNQC3HgSqK', NULL, '2019-06-17 06:48:09', '2019-06-17 06:48:09'),
(5, 13, 3, 1, 'rider1', 'riderdriver1@gmail.com', '12334656576846', '1560772482.png', '$2y$10$RQyA5Pe2S/tNezzFWPzcZe0pFVQaZzGh.KAf9wGKeCp7sxbHaBxUi', NULL, '2019-06-17 06:53:20', '2019-06-17 06:54:42'),
(6, 14, NULL, NULL, 'driver2', 'driver2@gmail.com', NULL, 'user.png', '$2y$10$osTeQGT1/wQTHImpGyl6qe0O1/8vUFcgbuLyg8xJv83UNa7UfiR3e', NULL, '2019-06-17 06:55:52', '2019-06-17 06:55:52'),
(7, 15, 4, 2, 'rider2', 'rider2@gmail.com', '123235345456245', '1560772675.png', '$2y$10$ISeET0AhlwoBN2YGnV6xa.zOEipPeUfvL5QbZ13tT.lsNJqjkQnYu', NULL, '2019-06-17 06:56:49', '2019-06-17 06:57:55'),
(8, 16, 5, 3, 'rider3', 'rider3@gmail.com', '123423556654321', '1560772712.jpeg', '$2y$10$zrCD6Z9ZaNN5TbiEV3lbxeTLVodUikPH0eeg.ACR.GRkfp6yVi2xS', NULL, '2019-06-17 06:58:16', '2019-06-17 06:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `ride_preferences`
--

CREATE TABLE `ride_preferences` (
  `pref_id` int(10) UNSIGNED NOT NULL,
  `v_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fare` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `passengers` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Male/Female',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ride_preferences`
--

INSERT INTO `ride_preferences` (`pref_id`, `v_type`, `fare`, `departure_time`, `arrival_time`, `passengers`, `created_at`, `updated_at`) VALUES
(1, 'car', NULL, '14:01:00', '02:01:00', 'Male/Female', '2019-06-17 06:53:50', '2019-06-17 06:53:50'),
(2, 'car', NULL, '01:01:00', '14:00:00', 'Male/Female', '2019-06-17 06:57:37', '2019-06-17 06:57:37'),
(3, 'van', NULL, '02:01:00', '05:00:00', 'Male/Female', '2019-06-17 06:58:45', '2019-06-17 06:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'malik ateeq', 'malik@gmail.com', '$2y$10$vTRzmgQeZEjTunfXGiEFH.OzpL9Zxv4VrWJtlHJx4TIO.hyAd7kgC', 'qpdj130EHvn7Xdiew8QyFPGFvKUyFpP0T1uPWon36i3AyzJgs26OgzexqVas', '2019-06-17 06:48:06', '2019-06-17 06:48:06'),
(2, 'admin', 'Saad Ullah', 'saad@gmail.com', '$2y$10$WAsCqfVMzGuieEB.SWlc4eylgUxWy8oOUhYS4EWy/ZlYakCQVRuYe', NULL, '2019-06-17 06:48:06', '2019-06-17 06:48:06'),
(3, 'admin', 'Khalid Raza', 'khalid@gmail.com', '$2y$10$IhA5MoSKIlcYv8nfuCFLDuN/pqtF6coS4XzSAaw7fSlY.bhkQV7u2', NULL, '2019-06-17 06:48:07', '2019-06-17 06:48:07'),
(4, 'driver', 'John Doe', 'driver@gmail.com', '$2y$10$SJNG0gAdu9sPdR6HnfXe9O00fPEcDZKyp5xIOCk0NubkNzqOzEfVe', 'vFDvC5hloSxbp7lq2NdfsCkdZOfsLue3HmHKGtwMoizeIFtRtB483kCm7KkG', '2019-06-17 06:48:07', '2019-06-28 09:18:02'),
(5, 'driver', 'Khan Saab', 'b@gmail.com', '$2y$10$gQ/9.eAdG1Cvo5ONJJKSve5gZtJT2/n6alqFcaAB2WyTJkB0ACZw6', NULL, '2019-06-17 06:48:07', '2019-06-17 06:48:07'),
(6, 'driver', 'Khan Saab', 'c@gmail.com', '$2y$10$6vrEnG7FJlzEd7vXipTOhOpWNLHmpx6zyEx5NagyG98OkVOlRv2Pe', NULL, '2019-06-17 06:48:07', '2019-06-17 06:48:07'),
(7, 'driver', 'Khan Saab', 'd@gmail.com', '$2y$10$w4SZ.9eXbuK7fUrQnoh6OO8TXLIGxFxza8jsHuZqVGEP7mnhdwhg.', NULL, '2019-06-17 06:48:08', '2019-06-17 06:48:08'),
(8, 'rider', 'Peter Mckinnon', 'rider@gmail.com', '$2y$10$hgjus4Q4ihy8p1nM2eYGTusWwqrP0HLTe9A2JIsuBAxKp0kp2KtNG', 'KVHL3kFED4Sj8uPJcqe6lm1wEi88OpJLf1aFtXb5WQVIRx6kFFHI56yKqpAB', '2019-06-17 06:48:08', '2019-06-28 09:18:14'),
(9, 'rider', 'Khan Saab', 'f@gmail.com', '$2y$10$FDGWPERStHB7qWWmDDvHsuUs105klUSPQQM92vpRm4HjQAsI4AZ4q', NULL, '2019-06-17 06:48:08', '2019-06-17 06:48:08'),
(10, 'rider', 'Khan Saab', 'g@gmail.com', '$2y$10$PNLu4DQChkpsgG7S.4KppegAFRZ9cBgTy4pWDJOWDLGauMhREVE4i', NULL, '2019-06-17 06:48:08', '2019-06-17 06:48:08'),
(11, 'rider', 'Khan Saab', 'h@gmail.com', '$2y$10$ho0WQzhhP73W7w2ye.kBqONbWOCxudHKVZOedn2YD.RSbDbRkCapK', NULL, '2019-06-17 06:48:09', '2019-06-17 06:48:09'),
(12, 'driver', 'driver1', 'driver1@gmail.com', '$2y$10$7rfRVe0Zkees8GCNwSafw.wxUiJnE4N9f79u7ieavn/OZyzYL2are', 'iEab0pRCvXziG33sxiqvkbPpBW8qe4XLB5h39rJFYk8DriFR6dE8KKGNuLom', '2019-06-17 06:51:54', '2019-06-17 06:51:54'),
(13, 'rider', 'rider1', 'riderdriver1@gmail.com', '$2y$10$RQyA5Pe2S/tNezzFWPzcZe0pFVQaZzGh.KAf9wGKeCp7sxbHaBxUi', '5I6ZAvxNfTb0iVwuDOaJ6aWCMGbyoDfQk5tvghNrxtm3Ym3DAAQT6GbqhLpG', '2019-06-17 06:53:20', '2019-06-17 06:53:20'),
(14, 'rider', 'driver2', 'driver2@gmail.com', '$2y$10$UVEx6Ztj5l5lIORqZhBteeO8M1qzYh3yLM6htzOJvkKVnFKQ4JyKu', 'XglhXgdQ8IT42gUxuwp5PVWobKdeKJDKwzk8fNU5brA29oGwmNJjmEyqK1PW', '2019-06-17 06:55:52', '2019-06-17 06:55:52'),
(15, 'rider', 'rider2', 'rider2@gmail.com', '$2y$10$ISeET0AhlwoBN2YGnV6xa.zOEipPeUfvL5QbZ13tT.lsNJqjkQnYu', 'xO17nhRxjZG7yrxOxSmzD1c8BHzNyiswEwkDoN1O9CRlmAqYJrHMQJskSAr5', '2019-06-17 06:56:49', '2019-06-17 06:56:49'),
(16, 'rider', 'rider3', 'rider3@gmail.com', '$2y$10$zrCD6Z9ZaNN5TbiEV3lbxeTLVodUikPH0eeg.ACR.GRkfp6yVi2xS', 'NTqZ2SqFkey1LjTNkILUOME2eCg4eukZQdYnpJDDtCfhV8xlgNAvUbTcoWaM', '2019-06-17 06:58:16', '2019-06-17 06:58:16'),
(17, 'driver', 'driver4', 'driver4@gmail.com', '$2y$10$ckMYNm3qw5tmpEL44o5NEOcjds2HeAlAaJbWr3fOBfCRcG98p2oQi', 'NJFPVAZ8JnbCAAA6QFNQEYza5l93NGePD7QfCs7DNMGB33kQPckZj5iIu8O3', '2019-06-17 06:59:31', '2019-06-17 06:59:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`direction_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `drivers_email_unique` (`email`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `rideinfo`
--
ALTER TABLE `rideinfo`
  ADD PRIMARY KEY (`info_id`);

--
-- Indexes for table `riders`
--
ALTER TABLE `riders`
  ADD PRIMARY KEY (`rider_id`),
  ADD UNIQUE KEY `riders_email_unique` (`email`);

--
-- Indexes for table `ride_preferences`
--
ALTER TABLE `ride_preferences`
  ADD PRIMARY KEY (`pref_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `directions`
--
ALTER TABLE `directions`
  MODIFY `direction_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `driver_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rideinfo`
--
ALTER TABLE `rideinfo`
  MODIFY `info_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riders`
--
ALTER TABLE `riders`
  MODIFY `rider_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ride_preferences`
--
ALTER TABLE `ride_preferences`
  MODIFY `pref_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
