-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 20, 2023 at 04:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restolaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `qte_produit` int(11) NOT NULL DEFAULT 1,
  `cart_option_product_selected_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`id`, `cart_id`, `product_id`, `qte_produit`, `cart_option_product_selected_id`, `created_at`, `updated_at`) VALUES
(15, 19, 4, 1, 3, '2023-07-10 01:49:52', '2023-07-10 01:49:52'),
(16, 21, 4, 1, 5, '2023-07-10 01:51:59', '2023-07-10 01:51:59'),
(17, 23, 4, 1, 6, '2023-07-10 01:53:09', '2023-07-10 01:53:09'),
(18, 25, 4, 1, 7, '2023-07-10 01:55:35', '2023-07-10 01:55:35'),
(19, 27, 4, 1, 8, '2023-07-10 01:57:01', '2023-07-10 01:57:01'),
(20, 28, 4, 1, 9, '2023-07-10 01:57:29', '2023-07-10 01:57:29'),
(21, 29, 4, 1, 10, '2023-07-10 01:58:12', '2023-07-10 01:58:12'),
(22, 30, 4, 1, 11, '2023-07-10 01:59:35', '2023-07-10 01:59:35'),
(23, 34, 23, 1, NULL, '2023-07-10 02:04:10', '2023-07-10 02:04:10'),
(24, 34, 3, 1, NULL, '2023-07-10 02:04:10', '2023-07-10 02:04:10'),
(25, 34, 4, 1, 12, '2023-07-10 02:04:10', '2023-07-10 02:04:10'),
(26, 36, 3, 1, NULL, '2023-07-10 02:06:31', '2023-07-10 02:06:31'),
(27, 36, 4, 1, 13, '2023-07-10 02:06:32', '2023-07-10 02:06:32'),
(28, 36, 4, 1, 14, '2023-07-10 02:06:32', '2023-07-10 02:06:32'),
(29, 37, 4, 1, 15, '2023-07-10 02:08:45', '2023-07-10 02:08:45'),
(30, 37, 4, 1, 16, '2023-07-10 02:08:46', '2023-07-10 02:08:46'),
(31, 38, 4, 1, 17, '2023-07-10 02:13:47', '2023-07-10 02:13:47'),
(32, 38, 4, 1, 18, '2023-07-10 02:13:47', '2023-07-10 02:13:47'),
(33, 38, 13, 1, NULL, '2023-07-10 02:13:47', '2023-07-10 02:13:47'),
(34, 39, 4, 1, NULL, '2023-07-17 00:40:59', '2023-07-17 00:40:59'),
(35, 39, 4, 1, 19, '2023-07-17 00:41:01', '2023-07-17 00:41:01'),
(36, 39, 4, 1, 20, '2023-07-17 00:41:01', '2023-07-17 00:41:01'),
(37, 41, 4, 1, NULL, '2023-07-19 18:21:17', '2023-07-19 18:21:17'),
(38, 41, 23, 1, NULL, '2023-07-19 18:21:17', '2023-07-19 18:21:17'),
(39, 41, 3, 1, NULL, '2023-07-19 18:21:18', '2023-07-19 18:21:18'),
(40, 42, 4, 1, NULL, '2023-07-19 18:22:32', '2023-07-19 18:22:32'),
(41, 42, 23, 1, NULL, '2023-07-19 18:22:32', '2023-07-19 18:22:32'),
(42, 42, 3, 1, NULL, '2023-07-19 18:22:32', '2023-07-19 18:22:32'),
(43, 43, 4, 1, NULL, '2023-07-19 18:23:10', '2023-07-19 18:23:10'),
(44, 43, 23, 1, NULL, '2023-07-19 18:23:11', '2023-07-19 18:23:11'),
(45, 43, 3, 1, NULL, '2023-07-19 18:23:11', '2023-07-19 18:23:11'),
(46, 44, 4, 1, NULL, '2023-07-19 18:23:33', '2023-07-19 18:23:33'),
(47, 44, 23, 1, NULL, '2023-07-19 18:23:33', '2023-07-19 18:23:33'),
(48, 44, 3, 1, NULL, '2023-07-19 18:23:33', '2023-07-19 18:23:33'),
(49, 45, 4, 1, NULL, '2023-07-19 18:23:48', '2023-07-19 18:23:48'),
(50, 45, 23, 1, NULL, '2023-07-19 18:23:48', '2023-07-19 18:23:48'),
(51, 45, 3, 1, NULL, '2023-07-19 18:23:48', '2023-07-19 18:23:48'),
(52, 46, 4, 1, NULL, '2023-07-19 18:26:01', '2023-07-19 18:26:01'),
(53, 46, 23, 1, NULL, '2023-07-19 18:26:02', '2023-07-19 18:26:02'),
(54, 46, 3, 1, NULL, '2023-07-19 18:26:02', '2023-07-19 18:26:02'),
(55, 47, 4, 1, NULL, '2023-07-19 18:27:18', '2023-07-19 18:27:18'),
(56, 47, 23, 1, NULL, '2023-07-19 18:27:18', '2023-07-19 18:27:18'),
(57, 47, 3, 1, NULL, '2023-07-19 18:27:19', '2023-07-19 18:27:19'),
(58, 48, 4, 1, NULL, '2023-07-19 18:27:20', '2023-07-19 18:27:20'),
(59, 48, 23, 1, NULL, '2023-07-19 18:27:20', '2023-07-19 18:27:20'),
(60, 48, 3, 1, NULL, '2023-07-19 18:27:20', '2023-07-19 18:27:20'),
(61, 49, 4, 1, NULL, '2023-07-19 18:27:36', '2023-07-19 18:27:36'),
(62, 49, 23, 1, NULL, '2023-07-19 18:27:36', '2023-07-19 18:27:36'),
(63, 49, 3, 1, NULL, '2023-07-19 18:27:36', '2023-07-19 18:27:36'),
(64, 50, 4, 1, NULL, '2023-07-19 18:27:41', '2023-07-19 18:27:41'),
(65, 50, 23, 1, NULL, '2023-07-19 18:27:41', '2023-07-19 18:27:41'),
(66, 50, 3, 1, NULL, '2023-07-19 18:27:41', '2023-07-19 18:27:41'),
(67, 51, 4, 1, NULL, '2023-07-19 18:28:11', '2023-07-19 18:28:11'),
(68, 52, 23, 1, NULL, '2023-07-19 18:28:52', '2023-07-19 18:28:52'),
(69, 53, 23, 1, NULL, '2023-07-19 18:30:40', '2023-07-19 18:30:40'),
(70, 54, 23, 1, NULL, '2023-07-19 18:31:05', '2023-07-19 18:31:05'),
(71, 55, 23, 1, NULL, '2023-07-19 18:31:28', '2023-07-19 18:31:28'),
(72, 56, 23, 1, NULL, '2023-07-19 18:31:47', '2023-07-19 18:31:47'),
(73, 57, 23, 1, NULL, '2023-07-19 18:32:06', '2023-07-19 18:32:06'),
(74, 58, 23, 1, NULL, '2023-07-19 18:32:46', '2023-07-19 18:32:46'),
(75, 59, 23, 1, NULL, '2023-07-19 18:32:54', '2023-07-19 18:32:54'),
(76, 61, 3, 1, NULL, '2023-07-19 20:57:51', '2023-07-19 20:57:51'),
(77, 62, 3, 1, NULL, '2023-07-19 21:07:30', '2023-07-19 21:07:30'),
(78, 62, 3, 1, NULL, '2023-07-19 21:07:30', '2023-07-19 21:07:30'),
(79, 62, 4, 1, NULL, '2023-07-19 21:07:30', '2023-07-19 21:07:30'),
(80, 62, 11, 1, NULL, '2023-07-19 21:07:30', '2023-07-19 21:07:30'),
(81, 62, 10, 1, NULL, '2023-07-19 21:07:30', '2023-07-19 21:07:30'),
(82, 62, 12, 1, NULL, '2023-07-19 21:07:31', '2023-07-19 21:07:31'),
(83, 63, 3, 1, NULL, '2023-07-19 21:24:24', '2023-07-19 21:24:24'),
(84, 63, 3, 1, NULL, '2023-07-19 21:24:24', '2023-07-19 21:24:24'),
(85, 63, 4, 1, NULL, '2023-07-19 21:24:24', '2023-07-19 21:24:24'),
(86, 63, 11, 1, NULL, '2023-07-19 21:24:24', '2023-07-19 21:24:24'),
(87, 63, 10, 1, NULL, '2023-07-19 21:24:24', '2023-07-19 21:24:24'),
(88, 63, 12, 1, NULL, '2023-07-19 21:24:25', '2023-07-19 21:24:25'),
(89, 63, 4, 1, NULL, '2023-07-19 21:24:25', '2023-07-19 21:24:25'),
(90, 64, 3, 1, NULL, '2023-07-19 21:32:47', '2023-07-19 21:32:47'),
(91, 64, 3, 1, NULL, '2023-07-19 21:32:47', '2023-07-19 21:32:47'),
(92, 64, 4, 1, NULL, '2023-07-19 21:32:47', '2023-07-19 21:32:47'),
(93, 64, 11, 1, NULL, '2023-07-19 21:32:48', '2023-07-19 21:32:48'),
(94, 64, 10, 1, NULL, '2023-07-19 21:32:48', '2023-07-19 21:32:48'),
(95, 64, 12, 1, NULL, '2023-07-19 21:32:50', '2023-07-19 21:32:50'),
(96, 64, 4, 1, NULL, '2023-07-19 21:32:50', '2023-07-19 21:32:50'),
(97, 65, 3, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(98, 65, 3, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(99, 65, 4, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(100, 65, 11, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(101, 65, 10, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(102, 65, 12, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(103, 65, 4, 1, NULL, '2023-07-19 22:15:19', '2023-07-19 22:15:19'),
(104, 66, 23, 1, NULL, '2023-07-19 22:16:38', '2023-07-19 22:16:38'),
(105, 67, 4, 1, 21, '2023-07-19 22:22:05', '2023-07-19 22:22:05'),
(106, 68, 3, 1, NULL, '2023-07-19 23:40:22', '2023-07-19 23:40:22'),
(107, 69, 3, 1, NULL, '2023-07-19 23:57:35', '2023-07-19 23:57:35'),
(108, 73, 4, 1, NULL, '2023-07-20 00:29:54', '2023-07-20 00:29:54'),
(109, 75, 11, 1, NULL, '2023-07-20 00:51:22', '2023-07-20 00:51:22'),
(110, 75, 12, 1, NULL, '2023-07-20 00:51:22', '2023-07-20 00:51:22'),
(111, 75, 15, 1, NULL, '2023-07-20 00:51:23', '2023-07-20 00:51:23'),
(112, 75, 23, 1, NULL, '2023-07-20 00:51:23', '2023-07-20 00:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `cart_option_produits_selected`
--

CREATE TABLE `cart_option_produits_selected` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(11) UNSIGNED NOT NULL,
  `qte_option_selected` int(11) NOT NULL,
  `prix_total_option` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_option_produits_selected`
--

INSERT INTO `cart_option_produits_selected` (`id`, `cart_id`, `product_id`, `option_id`, `qte_option_selected`, `prix_total_option`, `created_at`, `updated_at`) VALUES
(1, 17, 4, 1, 1, 6.00, '2023-07-10 01:47:51', '2023-07-10 01:47:51'),
(2, 18, 4, 1, 1, 6.00, '2023-07-10 01:48:45', '2023-07-10 01:48:45'),
(3, 19, 4, 1, 1, 6.00, '2023-07-10 01:49:51', '2023-07-10 01:49:51'),
(4, 20, 4, 1, 1, 6.00, '2023-07-10 01:51:40', '2023-07-10 01:51:40'),
(5, 21, 4, 1, 1, 6.00, '2023-07-10 01:51:59', '2023-07-10 01:51:59'),
(6, 23, 4, 1, 1, 6.00, '2023-07-10 01:53:08', '2023-07-10 01:53:08'),
(7, 25, 4, 1, 1, 6.00, '2023-07-10 01:55:34', '2023-07-10 01:55:34'),
(8, 27, 4, 1, 1, 6.00, '2023-07-10 01:57:01', '2023-07-10 01:57:01'),
(9, 28, 4, 1, 1, 6.00, '2023-07-10 01:57:29', '2023-07-10 01:57:29'),
(10, 29, 4, 1, 1, 6.00, '2023-07-10 01:58:12', '2023-07-10 01:58:12'),
(11, 30, 4, 1, 1, 6.00, '2023-07-10 01:59:35', '2023-07-10 01:59:35'),
(12, 34, 4, 1, 1, 6.00, '2023-07-10 02:04:10', '2023-07-10 02:04:10'),
(13, 36, 4, 1, 1, 6.00, '2023-07-10 02:06:32', '2023-07-10 02:06:32'),
(14, 36, 4, 2, 1, 8.00, '2023-07-10 02:06:32', '2023-07-10 02:06:32'),
(15, 37, 4, 1, 1, 6.00, '2023-07-10 02:08:45', '2023-07-10 02:08:45'),
(16, 37, 4, 2, 1, 8.00, '2023-07-10 02:08:46', '2023-07-10 02:08:46'),
(17, 38, 4, 1, 1, 6.00, '2023-07-10 02:13:47', '2023-07-10 02:13:47'),
(18, 38, 4, 2, 1, 8.00, '2023-07-10 02:13:47', '2023-07-10 02:13:47'),
(19, 39, 4, 1, 1, 6.00, '2023-07-17 00:41:00', '2023-07-17 00:41:00'),
(20, 39, 4, 2, 1, 8.00, '2023-07-17 00:41:01', '2023-07-17 00:41:01'),
(21, 67, 4, 1, 1, 6.00, '2023-07-19 22:22:05', '2023-07-19 22:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `cart_user`
--

CREATE TABLE `cart_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `prix_total` decimal(8,2) NOT NULL DEFAULT 0.00,
  `methode_paiement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `mode_livraison` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `statut_paiement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_user`
--

INSERT INTO `cart_user` (`id`, `user_id`, `restaurant_id`, `prix_total`, `methode_paiement`, `mode_livraison`, `statut_paiement`, `created_at`, `updated_at`) VALUES
(11, 32, 11, 1011.00, '1', '1', 'Pending', '2023-07-10 01:39:50', '2023-07-10 01:39:50'),
(12, 32, 11, 1012.00, '1', '1', 'Pending', '2023-07-10 01:41:04', '2023-07-10 01:41:04'),
(13, 32, 11, 1013.00, '1', '1', 'Pending', '2023-07-10 01:42:01', '2023-07-10 01:42:01'),
(14, 32, 11, 1014.00, '1', '1', 'Pending', '2023-07-10 01:44:43', '2023-07-10 01:44:43'),
(15, 32, 11, 1015.00, '1', '1', 'Pending', '2023-07-10 01:45:28', '2023-07-10 01:45:28'),
(16, 32, 11, 1016.00, '1', '1', 'Pending', '2023-07-10 01:45:40', '2023-07-10 01:45:40'),
(17, 32, 11, 1017.00, '1', '1', 'Pending', '2023-07-10 01:47:51', '2023-07-10 01:47:51'),
(18, 32, 11, 1018.00, '1', '1', 'Pending', '2023-07-10 01:48:44', '2023-07-10 01:48:44'),
(19, 32, 11, 1019.00, '1', '1', 'Pending', '2023-07-10 01:49:51', '2023-07-10 01:49:51'),
(20, 32, 11, 1020.00, '1', '1', 'Pending', '2023-07-10 01:51:40', '2023-07-10 01:51:40'),
(21, 32, 11, 1021.00, '1', '1', 'Pending', '2023-07-10 01:51:59', '2023-07-10 01:51:59'),
(22, 32, 11, 1022.00, '1', '1', 'Pending', '2023-07-10 01:52:27', '2023-07-10 01:52:27'),
(23, 32, 11, 1023.00, '1', '1', 'Pending', '2023-07-10 01:53:08', '2023-07-10 01:53:08'),
(24, 32, 11, 1024.00, '1', '1', 'Pending', '2023-07-10 01:54:23', '2023-07-10 01:54:23'),
(25, 32, 11, 1025.00, '1', '1', 'Pending', '2023-07-10 01:55:34', '2023-07-10 01:55:34'),
(26, 32, 11, 1026.00, '1', '1', 'Pending', '2023-07-10 01:55:53', '2023-07-10 01:55:53'),
(27, 32, 11, 1027.00, '1', '1', 'Pending', '2023-07-10 01:57:01', '2023-07-10 01:57:01'),
(28, 32, 11, 1028.00, '1', '1', 'Pending', '2023-07-10 01:57:29', '2023-07-10 01:57:29'),
(29, 32, 11, 1029.00, '1', '1', 'Pending', '2023-07-10 01:58:12', '2023-07-10 01:58:12'),
(30, 32, 11, 1030.00, '1', '1', 'Pending', '2023-07-10 01:59:35', '2023-07-10 01:59:35'),
(31, 32, 11, 1031.00, '1', '1', 'Pending', '2023-07-10 01:59:58', '2023-07-10 01:59:58'),
(32, 32, 11, 1032.00, '1', '1', 'Pending', '2023-07-10 02:00:14', '2023-07-10 02:00:14'),
(33, 32, 11, 1033.00, '1', '1', 'Pending', '2023-07-10 02:00:40', '2023-07-10 02:00:40'),
(34, 32, 11, 1034.00, '1', '1', 'Pending', '2023-07-10 02:04:10', '2023-07-10 02:04:10'),
(35, 32, 11, 1035.00, '1', '1', 'Pending', '2023-07-10 02:05:12', '2023-07-10 02:05:12'),
(36, 32, 11, 1036.00, '1', '1', 'Pending', '2023-07-10 02:06:31', '2023-07-10 02:06:31'),
(37, 32, 11, 1037.00, '1', '1', 'Pending', '2023-07-10 02:08:45', '2023-07-10 02:08:45'),
(38, 32, 11, 1038.00, '1', '1', 'Pending', '2023-07-10 02:13:46', '2023-07-10 02:13:46'),
(39, 32, 11, 1039.00, '1', '1', 'Pending', '2023-07-17 00:40:59', '2023-07-17 00:40:59'),
(40, 32, 11, 1040.00, '1', '1', 'Pending', '2023-07-17 00:57:31', '2023-07-17 00:57:31'),
(41, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:21:17', '2023-07-19 18:21:17'),
(42, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:22:32', '2023-07-19 18:22:32'),
(43, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:23:10', '2023-07-19 18:23:10'),
(44, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:23:32', '2023-07-19 18:23:32'),
(45, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:23:48', '2023-07-19 18:23:48'),
(46, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:26:01', '2023-07-19 18:26:02'),
(47, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:27:18', '2023-07-19 18:27:19'),
(48, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:27:20', '2023-07-19 18:27:20'),
(49, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:27:36', '2023-07-19 18:27:37'),
(50, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:27:40', '2023-07-19 18:27:41'),
(51, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:28:11', '2023-07-19 18:28:12'),
(52, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:28:52', '2023-07-19 18:28:52'),
(53, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:30:40', '2023-07-19 18:30:40'),
(54, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:31:05', '2023-07-19 18:31:05'),
(55, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:31:28', '2023-07-19 18:31:28'),
(56, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 18:31:47', '2023-07-19 18:31:47'),
(57, 32, 11, 100.00, '1', '1', 'Pending', '2023-07-19 18:32:06', '2023-07-19 18:32:06'),
(58, 32, 11, 100.00, '1', '1', 'Pending', '2023-07-19 18:32:45', '2023-07-19 18:32:46'),
(59, 32, 11, 100.00, '1', '1', 'Pending', '2023-07-19 18:32:54', '2023-07-19 18:32:54'),
(60, 32, 11, 0.00, '1', '1', 'Pending', '2023-07-19 20:56:49', '2023-07-19 20:56:49'),
(61, 32, 11, 100.00, '1', '1', 'Pending', '2023-07-19 20:57:51', '2023-07-19 20:57:51'),
(62, 32, 11, 1343.00, '1', '1', 'Pending', '2023-07-19 21:07:30', '2023-07-19 21:07:31'),
(63, 32, 11, 2443.00, '1', '1', 'Pending', '2023-07-19 21:24:24', '2023-07-19 21:24:25'),
(64, 32, 11, 2443.00, '1', '1', 'Pending', '2023-07-19 21:32:47', '2023-07-19 21:32:51'),
(65, 32, 11, 2443.00, NULL, NULL, 'Pending', '2023-07-19 22:15:18', '2023-07-19 22:15:19'),
(66, 32, 11, 100.00, NULL, NULL, 'Pending', '2023-07-19 22:16:38', '2023-07-19 22:16:38'),
(67, 32, 11, 1100.00, NULL, NULL, 'Pending', '2023-07-19 22:22:05', '2023-07-19 22:22:05'),
(68, 32, 11, 1200.00, '5', '5', 'Pending', '2023-07-19 23:40:22', '2023-07-19 23:40:22'),
(69, 32, 11, 100.00, '5', '5', 'Pending', '2023-07-19 23:57:35', '2023-07-19 23:57:35'),
(70, 32, 11, 0.00, '5', '5', 'Pending', '2023-07-19 23:58:38', '2023-07-19 23:58:38'),
(71, 32, 11, 0.00, '5', '5', 'Pending', '2023-07-20 00:01:34', '2023-07-20 00:01:34'),
(72, 32, 11, 0.00, '6', '5', 'Pending', '2023-07-20 00:23:53', '2023-07-20 00:23:53'),
(73, 32, 11, 1100.00, '5', '5', 'Pending', '2023-07-20 00:29:54', '2023-07-20 00:29:54'),
(74, 32, 11, 0.00, '5', '5', 'Pending', '2023-07-20 00:48:10', '2023-07-20 00:48:10'),
(75, 32, 11, 139.00, '5', '5', 'Pending', '2023-07-20 00:51:22', '2023-07-20 00:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `date_creation`, `created_at`, `updated_at`, `owner_id`) VALUES
(1, 'categrie0123456', '2023-05-22 17:32:27', '2023-05-22 17:32:27', '2023-06-05 15:08:04', 32),
(2, 'categrie222', '2023-05-22 20:04:11', '2023-05-22 20:04:11', '2023-05-22 20:04:11', 32),
(3, 'cat003', '2023-05-23 21:05:46', '2023-05-23 21:05:46', '2023-06-05 12:29:43', 32),
(4, 'categrie444', '2023-05-23 21:05:49', '2023-05-23 21:05:49', '2023-05-23 21:05:49', 32),
(5, 'caty5', '2023-05-23 21:05:53', '2023-05-23 21:05:53', '2023-05-23 21:05:53', 32),
(6, 'categrie666', '2023-05-23 21:05:56', '2023-05-23 21:05:56', '2023-05-23 21:05:56', 32),
(8, 'cat0001', '2023-06-05 15:08:50', '2023-06-05 15:08:50', '2023-06-05 15:08:50', 32),
(10, 'sandwich', '2023-06-05 15:09:27', '2023-06-05 15:09:27', '2023-06-05 15:09:27', 32),
(11, 'malfou', '2023-06-10 18:41:30', '2023-06-10 18:41:30', '2023-06-10 18:41:30', 32),
(12, 'malfouf2', '2023-06-10 19:03:09', '2023-06-10 19:03:09', '2023-06-10 20:52:38', 32),
(13, 'downtown', '2023-06-10 19:32:06', '2023-06-10 19:32:06', '2023-06-10 19:32:19', 32),
(14, 'categorie_test', '2023-06-10 20:52:49', '2023-06-10 20:52:49', '2023-06-10 20:52:49', 32),
(15, 'downtown123', '2023-06-10 20:54:20', '2023-06-10 20:54:20', '2023-06-10 20:54:20', 32),
(16, 'categrie01234560', '2023-06-10 20:55:41', '2023-06-10 20:55:41', '2023-06-10 20:55:41', 32),
(17, 'test_08', '2023-06-21 22:02:10', '2023-06-21 22:02:10', '2023-06-21 22:02:10', 32);

-- --------------------------------------------------------

--
-- Table structure for table `categories_restaurant`
--

CREATE TABLE `categories_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories_restaurant`
--

INSERT INTO `categories_restaurant` (`id`, `name`, `restaurant_id`, `created_at`, `updated_at`) VALUES
(16, 'malfouf2', 11, '2023-06-16 17:57:41', '2023-06-16 17:57:41'),
(17, 'categrie0123456', 11, '2023-06-16 23:09:33', '2023-06-16 23:09:33'),
(18, 'categrie0123456', 55, '2023-06-16 23:14:58', '2023-06-16 23:14:58'),
(19, 'categrie0123456', 53, '2023-06-16 23:17:11', '2023-06-16 23:17:11'),
(20, 'categrie444', 52, '2023-06-16 23:38:31', '2023-06-16 23:38:31'),
(21, 'categrie222', 11, '2023-06-16 23:45:22', '2023-06-16 23:45:22'),
(22, 'downtown', 11, '2023-06-16 23:46:57', '2023-06-16 23:46:57'),
(23, 'sandwich', 11, '2023-06-16 23:47:12', '2023-06-16 23:47:12'),
(24, 'caty5', 52, '2023-06-16 23:48:03', '2023-06-16 23:48:03'),
(25, 'categrie666', 55, '2023-06-16 23:52:51', '2023-06-16 23:52:51');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNum1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNum2` varchar(255) NOT NULL,
  `localisation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `url_platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phoneNum1`, `phoneNum2`, `localisation`, `logo`, `url_platform`, `date`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(11, 'down town', '147852', '', 'ariana', '/storage/images/X7Tx1JKp8Y9VZtkwXvs2u6cBohWb9nf0pNnJO2HN.png', 'downtown.localhost:8000', '2023-06-05 16:15:05', '1', 32, '2023-06-05 15:15:05', '2023-06-05 15:15:05'),
(52, 'test_logo_horaire', '12365400', '98563244', 'residance narjess 1', 'http://localhost:8000/storage/images/VbnKr4C1ZxAacPycRTPsAg1IDJuUP3F8azfhFPmR.png', 'test_logo_horaire.localhost:8000', '2023-06-20 02:17:47', '1', 104, '2023-06-20 01:17:47', '2023-06-20 01:17:47'),
(53, 'logo_l', '12365407', '36985215', 'residance narjess 1', 'http://localhost:8000/storage/images/oLVe3EzNEisSymJPW7PexicUHnOOQa0Uo7NEdG5m.png', 'logo_l.localhost:8000', '2023-06-20 02:21:29', '1', 105, '2023-06-20 01:21:29', '2023-06-20 01:21:29'),
(55, 'laravel_resto_v6', '12365466', '36985200', 'residance narjess 1', 'http://localhost:8000/storage/images/aNyIdpUTdPmT1or9RR1eSLPwCjUBBZIPzkQ5vfUp.jpg', 'laravel_resto_v6.localhost:8000', '2023-06-20 22:34:19', '1', 107, '2023-06-20 21:34:19', '2023-06-20 21:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `client_postal_codes`
--

CREATE TABLE `client_postal_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `postal_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_postal_codes`
--

INSERT INTO `client_postal_codes` (`id`, `client_id`, `postal_code`, `created_at`, `updated_at`) VALUES
(35, 11, '203', '2023-06-20 01:17:47', '2023-06-20 01:17:47'),
(36, 53, '2222', '2023-06-20 01:21:29', '2023-06-20 01:21:29'),
(38, 55, '1003', '2023-06-20 21:34:19', '2023-06-20 21:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `client_restaurant`
--

CREATE TABLE `client_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verification` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `famille_options`
--

CREATE TABLE `famille_options` (
  `id` int(11) NOT NULL,
  `nom_famille_option` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `owner_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `famille_options`
--

INSERT INTO `famille_options` (`id`, `nom_famille_option`, `type`, `created_at`, `updated_at`, `owner_id`) VALUES
(1, 'Pain au choix', 'simple', '2023-05-29 22:04:57', '2023-06-10 19:27:48', 1),
(2, 'Nature', 'simple', '2023-05-29 22:04:57', '2023-06-10 19:27:48', 1),
(3, 'Piquant', 'simple', '2023-05-29 22:04:57', '2023-06-10 19:27:48', 1),
(4, 'Légumes au choix', 'multiple', '2023-05-29 22:04:57', '2023-06-10 19:27:48', 1),
(5, 'Sauces au choix', 'simple', '2023-05-29 22:04:57', '2023-06-10 19:27:48', 1),
(6, 'Brochettes au choix', 'simple', '2023-05-29 22:04:57', '2023-06-10 19:27:48', 1),
(8, 'boisson gazeuse', 'qte', '2023-05-31 23:34:14', '2023-06-10 19:27:48', 1),
(9, 'testQte2', 'qte', '2023-06-05 12:45:37', '2023-06-10 19:27:48', 1),
(10, 'frite', 'qte', '2023-06-10 18:44:02', '2023-06-10 18:44:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `famille_options_restaurant`
--

CREATE TABLE `famille_options_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_famille_option` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_rest_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `famille_options_restaurant`
--

INSERT INTO `famille_options_restaurant` (`id`, `nom_famille_option`, `type`, `created_at`, `updated_at`, `owner_id`, `categorie_rest_id`) VALUES
(1, 'Aubergine Grillée', 'simple', '2023-06-16 23:44:34', '2023-06-16 23:44:34', 11, 0),
(2, 'test', 'multiple', '2023-06-16 23:55:18', '2023-06-16 23:55:18', 11, 0),
(3, 'Légumes au choix', 'multiple', '2023-06-16 23:56:16', '2023-06-16 23:56:16', 11, 0),
(4, 'Légumes au choix', 'multiple', '2023-06-16 23:56:16', '2023-06-16 23:56:16', 11, 0),
(5, 'Légumes au choix', 'multiple', '2023-06-17 00:03:39', '2023-06-17 00:03:39', 11, 0),
(6, 'Poivron Grillé test ', 'simple', '2023-06-17 00:05:37', '2023-06-17 00:05:37', 11, 0),
(7, 'Poivron Grillé', 'multiple', '2023-06-17 00:07:21', '2023-06-17 00:07:21', 11, 0),
(8, 'Légumes au choix', 'multiple', '2023-06-17 00:07:21', '2023-06-17 00:07:21', 11, 0),
(9, 'Légumes au choix', 'multiple', '2023-06-17 00:19:48', '2023-06-17 00:19:48', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `horaires`
--

CREATE TABLE `horaires` (
  `id` int(11) NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `heure_ouverture` time NOT NULL,
  `heure_fermeture` time NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `horaires`
--

INSERT INTO `horaires` (`id`, `client_id`, `heure_ouverture`, `heure_fermeture`, `date_debut`, `date_fin`, `created_at`, `updated_at`) VALUES
(43, 52, '01:00:00', '06:00:00', '2024-01-01', '2028-01-01', '2023-06-20 01:17:47', '2023-06-20 01:17:47'),
(44, 53, '01:00:00', '06:00:00', '2023-01-01', '2026-01-01', '2023-06-20 01:21:29', '2023-06-20 01:21:29'),
(46, 55, '01:00:00', '06:00:00', '2023-01-01', '2026-01-01', '2023-06-20 21:34:19', '2023-06-20 21:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `jour_ferier`
--

CREATE TABLE `jour_ferier` (
  `id` int(11) NOT NULL,
  `jour` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jour_ferier`
--

INSERT INTO `jour_ferier` (`id`, `jour`, `client_id`, `created_at`, `updated_at`) VALUES
(22, 'Jeudi', 52, '2023-06-20 01:17:47', '2023-06-20 01:17:47'),
(23, 'Mardi', 53, '2023-06-20 01:21:29', '2023-06-20 01:21:29'),
(24, 'Mercredi', 54, '2023-06-20 21:30:33', '2023-06-20 21:30:33'),
(25, 'Mercredi', 55, '2023-06-20 21:34:19', '2023-06-20 21:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `livraisons`
--

CREATE TABLE `livraisons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_methode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livraisons`
--

INSERT INTO `livraisons` (`id`, `type_methode`, `created_at`, `updated_at`) VALUES
(11, 'livraison test', '2023-06-05 12:56:34', '2023-06-05 12:56:34'),
(12, 'azrg', '2023-06-05 12:59:30', '2023-06-05 12:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `livraison_restaurant`
--

CREATE TABLE `livraison_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `livraison_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livraison_restaurant`
--

INSERT INTO `livraison_restaurant` (`id`, `restaurant_id`, `livraison_id`, `created_at`, `updated_at`) VALUES
(5, 11, 11, '2023-07-19 23:01:47', '2023-07-19 23:01:47'),
(6, 11, 12, '2023-07-19 23:13:27', '2023-07-19 23:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_05_14_143553_client', 1),
(3, '2023_05_16_150403_create_settings_table', 1),
(4, '2023_05_19_112255_create_users_table', 1),
(5, '2023_05_19_131912_create_categories_table', 1),
(6, '2023_05_19_132212_create_produits_table', 1),
(7, '2023_05_19_132442_create_user_product_table', 1),
(8, '2023_05_20_151139_create_user_product_table', 2),
(9, '2023_05_22_153247_create_clients_table', 2),
(10, '2023_05_22_155108_create_horaire_table', 2),
(11, '2023_05_22_160603_add_user_id_to_horaires_table', 2),
(12, '2023_05_22_161702_add_user_id_to_clients_table', 2),
(13, '2023_05_23_224056_add_period_columns_to_horaires_table', 3),
(14, '2023_05_30_150615_add_owner_to_produits', 4),
(15, '2023_06_01_215505_add_restaurant_id_to_carte_user', 5),
(16, '2023_06_01_215723_add_restaurant_id_to_carte_users', 6),
(17, '2023_06_01_224104_create_cart_details_table', 7),
(18, '2023_06_01_225106_create_cart_user_table', 8),
(19, '2023_06_01_225340_create_cart_details_table', 9),
(20, '2023_06_01_230959_create_cart_detail_table', 10),
(21, '2023_06_01_231230_add_qte_produit_to_cart_details_table', 11),
(22, '2023_05_29_012135_create_cart_user_table', 12),
(26, '2023_06_04_154026_create_mode_paiements_table', 15),
(27, '2023_06_04_154738_create_livraisons_table', 16),
(28, '2023_06_04_154746_create_paiements_table', 16),
(29, '2023_06_03_213926_create_client_restaurant_table', 17),
(30, '2023_06_04_174618_create_livraisons_table', 18),
(31, '2023_06_04_174618_create_mode_paiements_table', 18),
(32, '2023_06_04_210548_create_phone_table', 19),
(33, '2023_06_10_170440_create_client_postal_codes_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `famille_option_id` int(11) DEFAULT NULL,
  `nom_option` varchar(255) DEFAULT NULL,
  `prix` decimal(8,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `owner_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `famille_option_id`, `nom_option`, `prix`, `created_at`, `updated_at`, `owner_id`) VALUES
(1, 4, 'Aubergine Grillée', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(2, 4, 'Oignon Grillé', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(3, 4, 'Poivron Grillé', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(4, 4, 'Tomate Grillée', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(5, 4, 'Carotte Grillée', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(6, 5, 'Sauce Piquante', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(7, 5, 'Sauce À L\'ail', 12.00, '2023-05-29 22:06:09', '2023-06-15 08:45:40', 1),
(8, 5, 'Sauce Aux Herbes', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(9, 5, 'Sauce Mex', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(10, 5, 'Sauce Au Curry', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(12, 5, 'Sauce Mayonnaise', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(13, 5, 'Sauce Barbecue', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(14, 5, 'Harissa', 0.00, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(15, 6, 'Viande De Boeuf Hachée', 6.50, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(16, 6, 'Steak De Poulet Hachée', 4.40, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(17, 6, 'Blanc De Poulet Grillé', 4.70, '2023-05-29 22:06:09', '2023-06-10 19:28:28', 1),
(20, 8, 'COCKA', 4.00, '2023-06-02 03:53:57', '2023-06-10 19:28:28', 1),
(21, 8, 'FANTA', 4.00, '2023-06-02 03:53:57', '2023-06-10 19:28:28', 1),
(22, 6, 'testfinale', 666.00, '2023-06-02 03:10:47', '2023-06-10 19:28:28', 1),
(23, 8, 'APPLA', 123.00, '2023-06-02 10:22:26', '2023-06-10 19:28:28', 1),
(24, 1, 'testPainOption', 5.00, '2023-06-05 12:46:10', '2023-06-10 19:28:28', 1),
(25, 1, 'testfinaleOption', 9.00, '2023-06-05 12:46:37', '2023-06-10 19:28:28', 1),
(26, 1, 'pain', 3.00, '2023-06-15 08:09:26', '2023-06-15 08:09:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options_restaurant`
--

CREATE TABLE `options_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_option` varchar(255) NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `famille_option_id_rest` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options_restaurant`
--

INSERT INTO `options_restaurant` (`id`, `nom_option`, `prix`, `famille_option_id_rest`, `created_at`, `updated_at`) VALUES
(1, 'test_option_num_1', 6.00, 7, '2023-07-04 20:42:06', '2023-07-04 20:42:06'),
(2, 'test_option_num_2', 8.00, 7, '2023-07-04 20:42:06', '2023-07-04 20:42:06'),
(3, 'aaaaaaaaaa', 55.00, 6, '2023-07-07 01:41:06', '2023-07-07 01:41:06');

-- --------------------------------------------------------

--
-- Table structure for table `paiement`
--

CREATE TABLE `paiement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_methode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiement`
--

INSERT INTO `paiement` (`id`, `type_methode`, `created_at`, `updated_at`) VALUES
(3, 'paiment01', '2023-06-04 23:25:23', '2023-06-04 23:33:58'),
(4, 'paiment2', '2023-06-04 23:25:27', '2023-06-04 23:25:27'),
(5, 'paiment3', '2023-06-04 23:25:29', '2023-06-04 23:25:29'),
(6, '684589', '2023-06-05 11:41:02', '2023-06-05 11:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `paiment_restaurant`
--

CREATE TABLE `paiment_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED NOT NULL,
  `paiment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paiment_restaurant`
--

INSERT INTO `paiment_restaurant` (`id`, `restaurant_id`, `paiment_id`, `created_at`, `updated_at`) VALUES
(5, 11, 3, '2023-07-19 23:02:06', '2023-07-19 23:02:06'),
(6, 11, 3, '2023-07-19 23:13:03', '2023-07-19 23:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_num` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phone`
--

INSERT INTO `phone` (`id`, `phone_num`, `user_id`, `created_at`, `updated_at`) VALUES
(19, '53551146', 108, '2023-06-21 20:54:36', '2023-06-21 20:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_produit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `categorie_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom_produit`, `description`, `url_image`, `prix`, `categorie_id`, `status`, `created_at`, `updated_at`, `owner_id`) VALUES
(14, 'qdfqfgProduct 1010', 'cat555', 'uploads/2.jpeg', 8.99, 5, 1, '2023-05-30 16:13:03', '2023-06-01 19:57:34', 1),
(16, 'Product edit', 'cat010101', 'uploads/3.jpeg', 15.99, 1, 1, '2023-05-30 16:13:41', '2023-06-15 07:51:27', 1),
(17, 'Product 3', 'cat020202', 'uploads/3.jpeg', 8.99, 2, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(18, 'Product 4', 'cat020202', 'uploads/3.jpeg', 12.99, 2, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(19, 'Product 5', 'cat3333', 'uploads/3.jpeg', 9.99, 3, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(20, 'Product 6', 'cat3333', 'uploads/4.jpeg', 14.99, 3, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(21, 'Product 7', 'cat4444', 'uploads/4.jpeg', 11.99, 4, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(22, 'Product 8', 'cat4444', 'uploads/4.jpeg', 16.99, 4, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(23, 'Product 9', 'cat555', 'uploads/4.jpeg', 7.99, 5, 1, '2023-05-30 16:13:41', '2023-05-30 16:13:41', 1),
(24, 'Product 1', 'cat010101', 'uploads/4.jpeg', 10.99, 1, 1, '2023-05-30 16:13:57', '2023-05-30 16:13:57', 1),
(25, 'Product 2', 'cat010101', 'uploads/5.jpeg', 15.99, 1, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(26, 'Product 3', 'cat020202', 'uploads/5.jpeg', 8.99, 2, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(27, 'Product 4', 'cat020202', 'uploads/5.jpeg', 12.99, 2, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(28, 'Product 5', 'cat3333', 'uploads/5.jpeg', 9.99, 3, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(29, 'Product 6', 'cat3333', 'uploads/5.jpeg', 14.99, 3, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(30, 'Product 7', 'cat4444', 'uploads/5.jpeg', 11.99, 4, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(31, 'Product 8', 'cat4444', 'uploads/6.jpeg', 16.99, 4, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(32, 'Product 9', 'cat555', 'uploads/6.jpeg', 7.99, 5, 1, '2023-05-30 16:14:28', '2023-05-30 16:14:28', 1),
(33, 'Product 2', 'cat010101', 'uploads/6.jpeg', 15.99, 1, 1, '2023-05-30 16:14:34', '2023-05-30 16:14:34', 1),
(34, 'Product 3', 'cat020202', 'uploads/6.jpeg', 8.99, 2, 1, '2023-05-30 16:14:41', '2023-05-30 16:14:41', 1),
(35, 'Product 4', 'cat020202', 'uploads/6.jpeg', 12.99, 2, 1, '2023-05-30 16:14:47', '2023-05-30 16:14:47', 1),
(36, 'Product 5', 'cat3333', 'uploads/8.jpeg', 9.99, 3, 1, '2023-05-30 16:14:53', '2023-05-30 16:14:53', 1),
(37, 'Product 6', 'cat3333', 'uploads/8.jpeg', 14.99, 3, 1, '2023-05-30 16:15:03', '2023-05-30 16:15:03', 1),
(38, 'Product 7', 'cat4444', 'uploads/8.jpeg', 11.99, 4, 1, '2023-05-30 16:15:07', '2023-05-30 16:15:07', 1),
(39, 'Product 8', 'cat4444', 'uploads/8.jpeg', 16.99, 4, 1, '2023-05-30 16:15:12', '2023-05-30 16:15:12', 1),
(40, 'Product 9', 'cat555', 'uploads/8.jpeg', 7.99, 5, 1, '2023-05-30 16:15:15', '2023-05-30 16:15:15', 1),
(62, '41', '41', 'uploads/1685487976.jpeg', 41.00, 1, 1, '2023-05-30 22:06:16', '2023-05-30 22:06:16', 1),
(63, '42', '42', 'uploads/1685488065.jpeg', 42.00, 1, 1, '2023-05-30 22:07:45', '2023-05-30 22:07:45', 1),
(64, 'sandwich A', 'sandwich sandwich sandwich sandwich', 'uploads/1685488336.jpeg', 99.00, 1, 1, '2023-05-30 22:12:16', '2023-05-30 22:12:16', 1),
(65, 'onefam', 'onefam', 'uploads/1685488973.jpeg', 3.00, 2, 1, '2023-05-30 22:22:53', '2023-05-30 22:22:53', 1),
(67, '564654', 'ytfuy', 'uploads/1685489444.jpeg', 56.00, 1, 1, '2023-05-30 22:30:44', '2023-05-30 22:30:44', 1),
(68, 'prodFailed', 'prodFailed', 'uploads/1685972401.png', 159.00, 4, 1, '2023-06-05 12:40:01', '2023-06-05 12:40:01', 1),
(69, '147852', '147852 147852', 'uploads/1685972701.png', 147852.00, 6, 1, '2023-06-05 12:45:01', '2023-06-05 12:45:01', 1),
(70, 'sandwich thon', 'sandwich thon', 'uploads/1685981504.png', 6.00, 10, 1, '2023-06-05 15:11:44', '2023-06-05 15:11:44', 1),
(71, 'prod1', '15963', 'uploads/1686013738.jpg', 4.00, 1, 1, '2023-06-06 00:08:58', '2023-06-06 00:08:58', 1),
(72, 'prod155845', '6846846', 'uploads/1686013758.jpg', 159.00, 1, 1, '2023-06-06 00:09:18', '2023-06-06 00:09:18', 1),
(73, 'downtown', 'downtown', 'uploads/1686429909.png', 100.00, 12, 1, '2023-06-10 19:45:09', '2023-06-10 19:45:09', 1),
(74, 'downtown', 'downtown', 'uploads/1686429909.png', 100.00, 12, 1, '2023-06-10 19:45:09', '2023-06-10 19:45:09', 1),
(77, 'paincake', 'qsqsq', 'uploads/1686654465.png', 4.00, 2, 1, '2023-06-13 09:07:45', '2023-06-13 09:07:45', 1),
(78, 'paincake', 'dfsdfsdsf', 'uploads/1686742809.png', 4.00, 10, 1, '2023-06-14 09:40:09', '2023-06-14 09:40:09', 1),
(79, 'paincake', 'sddsfds', 'uploads/1686742893.jfif', 212.00, 3, 0, '2023-06-14 09:41:33', '2023-06-14 09:41:33', 1),
(80, 'paincake', 'aaaaa', 'uploads/1686743205.jfif', 12121.00, 1, 1, '2023-06-14 09:46:45', '2023-06-14 09:46:45', 1),
(81, 'paincake123', 'aaaaa', 'uploads/1686821367.jfif', 12.00, 1, 0, '2023-06-15 07:29:27', '2023-06-15 07:53:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produits_famille_option`
--

CREATE TABLE `produits_famille_option` (
  `id` int(11) NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `famille_option_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits_famille_option`
--

INSERT INTO `produits_famille_option` (`id`, `produit_id`, `famille_option_id`, `created_at`, `updated_at`) VALUES
(73, 73, 5, '2023-05-30 23:12:16', '2023-05-30 23:12:16'),
(76, 74, 8, '2023-05-30 23:19:49', '2023-05-30 23:19:49'),
(77, 65, 5, '2023-05-30 23:22:53', '2023-05-30 23:22:53'),
(78, 65, 20, '2023-05-30 23:22:53', '2023-05-30 23:22:53'),
(116, 67, 4, '2023-05-30 23:30:44', '2023-05-30 23:30:44'),
(117, 67, 2, '2023-05-30 23:30:44', '2023-05-30 23:30:44'),
(118, 67, 3, '2023-05-30 23:30:44', '2023-05-30 23:30:44'),
(119, 67, 4, '2023-05-30 23:30:44', '2023-05-30 23:30:44'),
(300, 14, 3, '2023-06-01 20:57:10', '2023-06-01 20:57:10'),
(301, 14, 17, '2023-06-01 20:57:10', '2023-06-01 20:57:10'),
(304, 14, 4, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(305, 14, 5, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(306, 14, 6, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(307, 14, 7, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(308, 14, 8, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(309, 14, 9, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(310, 14, 10, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(312, 14, 12, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(313, 14, 13, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(314, 14, 14, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(315, 14, 15, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(316, 14, 16, '2023-06-02 04:10:25', '2023-06-02 04:10:25'),
(317, 68, 2, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(318, 68, 3, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(319, 68, 4, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(320, 68, 5, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(321, 68, 6, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(322, 68, 8, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(323, 68, 20, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(324, 68, 21, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(325, 68, 22, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(326, 68, 23, '2023-06-05 13:40:01', '2023-06-05 13:40:01'),
(327, 69, 1, '2023-06-05 13:45:01', '2023-06-05 13:45:01'),
(328, 69, 2, '2023-06-05 13:45:01', '2023-06-05 13:45:01'),
(329, 69, 3, '2023-06-05 13:45:01', '2023-06-05 13:45:01'),
(330, 69, 4, '2023-06-05 13:45:01', '2023-06-05 13:45:01'),
(331, 69, 1, '2023-06-05 13:45:01', '2023-06-05 13:45:01'),
(332, 70, 1, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(333, 70, 4, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(334, 70, 24, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(335, 70, 25, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(336, 70, 1, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(337, 70, 2, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(338, 70, 3, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(339, 70, 4, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(340, 70, 5, '2023-06-05 16:11:44', '2023-06-05 16:11:44'),
(341, 71, 4, '2023-06-06 01:08:58', '2023-06-06 01:08:58'),
(342, 71, 4, '2023-06-06 01:08:58', '2023-06-06 01:08:58'),
(344, 77, 2, '2023-06-13 11:07:45', '2023-06-13 11:07:45'),
(345, 78, 6, '2023-06-14 11:40:09', '2023-06-14 11:40:09'),
(346, 79, 9, '2023-06-14 11:41:33', '2023-06-14 11:41:33'),
(347, 79, 10, '2023-06-14 11:41:33', '2023-06-14 11:41:33'),
(348, 80, 2, '2023-06-14 11:46:45', '2023-06-14 11:46:45'),
(349, 81, 1, '2023-06-15 07:29:27', '2023-06-15 07:29:27'),
(350, 81, 2, '2023-06-15 07:29:27', '2023-06-15 07:29:27'),
(351, 81, 3, '2023-06-15 07:29:27', '2023-06-15 07:29:27'),
(352, 81, 4, '2023-06-15 07:29:27', '2023-06-15 07:29:27'),
(353, 16, 1, '2023-06-15 09:51:27', '2023-06-15 09:51:27'),
(354, 16, 4, '2023-06-15 09:51:27', '2023-06-15 09:51:27'),
(355, 16, 5, '2023-06-15 09:51:27', '2023-06-15 09:51:27'),
(356, 81, 10, '2023-06-15 09:52:08', '2023-06-15 09:52:08'),
(357, 81, 9, '2023-06-15 09:52:52', '2023-06-15 09:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `produits_restaurant`
--

CREATE TABLE `produits_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_produit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `categorie_rest_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produits_restaurant`
--

INSERT INTO `produits_restaurant` (`id`, `nom_produit`, `description`, `url_image`, `prix`, `categorie_rest_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'testInfo', 'downtown', 'uploads/2.jpeg', 100, 16, 1, '2023-06-16 17:57:41', '2023-06-16 17:57:41'),
(4, 'downtown140', 'downtowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntowndowntown', 'uploads/2.jpeg', 1100, 16, 1, '2023-06-16 17:58:09', '2023-06-16 17:58:09'),
(10, 'Product edit', 'cat010101', 'uploads/2.jpeg', 16, 17, 1, '2023-06-16 23:21:37', '2023-06-16 23:21:37'),
(11, 'Product edit', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:33:32', '2023-06-16 23:33:32'),
(12, 'Product 1', 'cat010101', 'uploads/4.jpeg', 11, 17, 1, '2023-06-16 23:33:32', '2023-06-16 23:33:32'),
(13, 'Product edit', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:34:17', '2023-06-16 23:34:17'),
(14, 'Product 1', 'cat010101', 'uploads/4.jpeg', 11, 17, 1, '2023-06-16 23:35:53', '2023-06-16 23:35:53'),
(15, 'paincake123', 'aaaaa', 'uploads/4.jpeg', 12, 17, 1, '2023-06-16 23:36:42', '2023-06-16 23:36:42'),
(16, 'paincake123', 'aaaaa', 'uploads/4.jpeg', 12, 17, 1, '2023-06-16 23:37:22', '2023-06-16 23:37:22'),
(17, '564654', 'ytfuy', 'uploads/4.jpeg', 56, 17, 1, '2023-06-16 23:43:53', '2023-06-16 23:43:53'),
(18, 'Product edit', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:44:34', '2023-06-16 23:44:34'),
(19, 'Product 1', 'cat010101', 'uploads/4.jpeg', 11, 17, 1, '2023-06-16 23:44:34', '2023-06-16 23:44:34'),
(20, 'Product 2', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:44:34', '2023-06-16 23:44:34'),
(21, 'Product 3', 'cat020202', 'uploads/4.jpeg', 9, 21, 1, '2023-06-16 23:45:22', '2023-06-16 23:45:22'),
(22, 'Product 2', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:46:02', '2023-06-16 23:46:02'),
(23, 'downtown', 'downtown', 'uploads/4.jpeg', 100, 16, 1, '2023-06-16 23:46:17', '2023-06-16 23:46:17'),
(24, 'sandwich thon', 'sandwich thon', 'uploads/4.jpeg', 6, 23, 1, '2023-06-16 23:47:12', '2023-06-16 23:47:12'),
(25, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-16 23:48:03', '2023-06-16 23:48:03'),
(26, '147852', '147852 147852', 'uploads/4.jpeg', 147852, 25, 1, '2023-06-16 23:52:51', '2023-06-16 23:52:51'),
(27, 'Product 4', 'cat020202', 'uploads/4.jpeg', 13, 21, 1, '2023-06-16 23:53:55', '2023-06-16 23:53:55'),
(28, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-16 23:54:42', '2023-06-16 23:54:42'),
(29, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-16 23:55:18', '2023-06-16 23:55:18'),
(30, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-16 23:55:18', '2023-06-16 23:55:18'),
(31, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-16 23:55:18', '2023-06-16 23:55:18'),
(32, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-16 23:55:18', '2023-06-16 23:55:18'),
(33, 'Product edit', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(34, 'Product 1', 'cat010101', 'uploads/4.jpeg', 11, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(35, 'Product 2', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(36, 'Product 2', 'cat010101', 'uploads/4.jpeg', 16, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(37, '41', '41', 'uploads/4.jpeg', 41, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(38, '42', '42', 'uploads/4.jpeg', 42, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(39, 'sandwich A', 'sandwich sandwich sandwich sandwich', 'uploads/4.jpeg', 99, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(40, '564654', 'ytfuy', 'uploads/4.jpeg', 56, 17, 1, '2023-06-16 23:56:16', '2023-06-16 23:56:16'),
(41, 'Product 3', 'cat020202', 'uploads/4.jpeg', 9, 21, 1, '2023-06-16 23:58:18', '2023-06-16 23:58:18'),
(42, 'Product 4', 'cat020202', 'uploads/4.jpeg', 13, 21, 1, '2023-06-16 23:58:18', '2023-06-16 23:58:18'),
(43, 'Product 3', 'cat020202', 'uploads/4.jpeg', 9, 21, 1, '2023-06-16 23:58:18', '2023-06-16 23:58:18'),
(44, 'Product 4', 'cat020202', 'uploads/4.jpeg', 13, 21, 1, '2023-06-16 23:58:18', '2023-06-16 23:58:18'),
(45, 'Product 3', 'cat020202', 'uploads/4.jpeg', 9, 21, 1, '2023-06-16 23:58:18', '2023-06-16 23:58:18'),
(46, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-16 23:58:31', '2023-06-16 23:58:31'),
(47, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-17 00:03:39', '2023-06-17 00:03:39'),
(48, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-17 00:05:37', '2023-06-17 00:05:37'),
(49, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-17 00:07:21', '2023-06-17 00:07:21'),
(50, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:07:21', '2023-06-17 00:07:21'),
(51, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:07:40', '2023-06-17 00:07:40'),
(52, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:07:40', '2023-06-17 00:07:40'),
(53, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:09:57', '2023-06-17 00:09:57'),
(54, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:09:57', '2023-06-17 00:09:57'),
(55, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:11:57', '2023-06-17 00:11:57'),
(56, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:11:57', '2023-06-17 00:11:57'),
(57, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:14:11', '2023-06-17 00:14:11'),
(58, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:14:11', '2023-06-17 00:14:11'),
(59, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:15:50', '2023-06-17 00:15:50'),
(60, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:15:57', '2023-06-17 00:15:57'),
(61, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-17 00:17:34', '2023-06-17 00:17:34'),
(62, 'qdfqfgProduct 1010', 'cat555', 'uploads/4.jpeg', 9, 24, 1, '2023-06-17 00:19:48', '2023-06-17 00:19:48'),
(63, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:19:48', '2023-06-17 00:19:48'),
(64, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:19:48', '2023-06-17 00:19:48'),
(65, 'Product 9', 'cat555', 'uploads/4.jpeg', 8, 24, 1, '2023-06-17 00:19:48', '2023-06-17 00:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `produit_familleoptions_restaurant`
--

CREATE TABLE `produit_familleoptions_restaurant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produit_rest` bigint(20) UNSIGNED NOT NULL,
  `id_familleoptions_rest` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produit_familleoptions_restaurant`
--

INSERT INTO `produit_familleoptions_restaurant` (`id`, `id_produit_rest`, `id_familleoptions_rest`, `created_at`, `updated_at`) VALUES
(1, 4, 7, '2023-07-04 20:59:47', '2023-07-04 20:59:47'),
(2, 4, 6, '2023-07-04 20:59:47', '2023-07-04 20:59:47');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `restaurant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `restaurant_id`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin HelloData', 'adminadmin@example.com', '$2y$10$zRjq9nJhU0kHDK7lPxsIKOPopUjH7N0XcGfuArTQ5bz3sa45qIkMy', NULL, 1, '2023-05-22 17:13:24', '2023-06-05 18:58:15'),
(4, 'admin', 'admin@exemple.com', '$2y$10$uYFf.Mc6M9gw6AdXR5owfOvNbElyMNyJom7k2HeXQmyW4OjKkIfEO', NULL, 1, '2023-05-26 23:19:53', '2023-05-26 23:19:53'),
(32, 'down town', 'downtown@example.com', '$2y$10$7HDLDV9yPkHvm7z8tALPy.TAtMO59GMvU6rZtrayuu6NVgeilO3nu', NULL, 0, '2023-06-05 15:15:05', '2023-06-05 15:15:05'),
(104, 'test_logo_horaire', 'test_logo_horaire@example.com', '$2y$10$.UvBYNtBM7sl.7OjQYSYGOhzKazisDjEUvqDyDh0EybkVdjEM0a8G', NULL, 0, '2023-06-20 01:17:46', '2023-06-20 01:17:46'),
(105, 'logo_l', 'logo_l@example.com', '$2y$10$8ypdlObTjfcoo9IQKOeXuegQpYpo4pi1OPnxeYWIkHz767oHz5JFe', NULL, 0, '2023-06-20 01:21:29', '2023-06-20 01:21:29'),
(107, 'laravel_resto_v6', 'laravel_resto_v6@exemple.com', '$2y$10$LebbaorSmG953q/p/S3vI.erD7VaMiGtau816TNUUc1RlG97PqtHO', NULL, 0, '2023-06-20 21:34:19', '2023-06-20 21:34:19'),
(108, 'zezerf', 'downtownclient@example.com', '$2y$10$1iYYqImQRwo9ukc8ERs0GOBXnc2CwfhBipTPUr6Bt2qYnYi/ZivHW', 11, 3, '2023-06-21 20:54:36', '2023-06-21 20:54:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_product`
--

CREATE TABLE `user_product` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_product`
--

INSERT INTO `user_product` (`user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(32, 26, '2023-06-06 00:25:05', '2023-06-06 00:25:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_details_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_details_product_id_foreign` (`product_id`),
  ADD KEY `cart_details_cart_option_product_selected_id_foreign` (`cart_option_product_selected_id`);

--
-- Indexes for table `cart_option_produits_selected`
--
ALTER TABLE `cart_option_produits_selected`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_option_produits_selected_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_option_produits_selected_product_id_foreign` (`product_id`),
  ADD KEY `cart_option_produits_selected_option_id_foreign` (`option_id`);

--
-- Indexes for table `cart_user`
--
ALTER TABLE `cart_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_user_user_id_foreign` (`user_id`),
  ADD KEY `cart_user_restaurant_id_foreign` (`restaurant_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `categories_restaurant`
--
ALTER TABLE `categories_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `client_postal_codes`
--
ALTER TABLE `client_postal_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_postal_codes_client_id_foreign` (`client_id`);

--
-- Indexes for table `client_restaurant`
--
ALTER TABLE `client_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_restaurant_email_unique` (`email`);

--
-- Indexes for table `famille_options`
--
ALTER TABLE `famille_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `famille_options_restaurant`
--
ALTER TABLE `famille_options_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `horaires`
--
ALTER TABLE `horaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `jour_ferier`
--
ALTER TABLE `jour_ferier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `livraison_restaurant`
--
ALTER TABLE `livraison_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_restaurant_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `livraison_id` (`livraison_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `famille_option_id` (`famille_option_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `options_restaurant`
--
ALTER TABLE `options_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `famille_option_id_rest` (`famille_option_id_rest`);

--
-- Indexes for table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_methode` (`type_methode`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `paiment_restaurant`
--
ALTER TABLE `paiment_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_restaurant_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `paiment_id` (`paiment_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone`
--
ALTER TABLE `phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone_user_id_foreign` (`user_id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_categorie_id_foreign` (`categorie_id`),
  ADD KEY `produits_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `produits_famille_option`
--
ALTER TABLE `produits_famille_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produit_id` (`produit_id`),
  ADD KEY `famille_option_id` (`famille_option_id`);

--
-- Indexes for table `produits_restaurant`
--
ALTER TABLE `produits_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_rest_id` (`categorie_rest_id`);

--
-- Indexes for table `produit_familleoptions_restaurant`
--
ALTER TABLE `produit_familleoptions_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_restautant_id` (`id_produit_rest`),
  ADD KEY `id_familleoptions_rest` (`id_familleoptions_rest`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_restaurant_id_foreign` (`restaurant_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `user_product`
--
ALTER TABLE `user_product`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `user_product_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `cart_option_produits_selected`
--
ALTER TABLE `cart_option_produits_selected`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `cart_user`
--
ALTER TABLE `cart_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `categories_restaurant`
--
ALTER TABLE `categories_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `client_postal_codes`
--
ALTER TABLE `client_postal_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `client_restaurant`
--
ALTER TABLE `client_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `famille_options`
--
ALTER TABLE `famille_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `famille_options_restaurant`
--
ALTER TABLE `famille_options_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `horaires`
--
ALTER TABLE `horaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `jour_ferier`
--
ALTER TABLE `jour_ferier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `livraison_restaurant`
--
ALTER TABLE `livraison_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `options_restaurant`
--
ALTER TABLE `options_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paiment_restaurant`
--
ALTER TABLE `paiment_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone`
--
ALTER TABLE `phone`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `produits_famille_option`
--
ALTER TABLE `produits_famille_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT for table `produits_restaurant`
--
ALTER TABLE `produits_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `produit_familleoptions_restaurant`
--
ALTER TABLE `produit_familleoptions_restaurant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_details_cart_option_product_selected_id_foreign` FOREIGN KEY (`cart_option_product_selected_id`) REFERENCES `cart_option_produits_selected` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `produits_restaurant` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_option_produits_selected`
--
ALTER TABLE `cart_option_produits_selected`
  ADD CONSTRAINT `cart_option_produits_selected_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `cart_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_option_produits_selected_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `produits_restaurant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_option` FOREIGN KEY (`option_id`) REFERENCES `options_restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_user`
--
ALTER TABLE `cart_user`
  ADD CONSTRAINT `cart_user_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories_restaurant`
--
ALTER TABLE `categories_restaurant`
  ADD CONSTRAINT `restautant_id` FOREIGN KEY (`restaurant_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_postal_codes`
--
ALTER TABLE `client_postal_codes`
  ADD CONSTRAINT `client_postal_codes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `famille_options`
--
ALTER TABLE `famille_options`
  ADD CONSTRAINT `famille_options_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `famille_options_restaurant`
--
ALTER TABLE `famille_options_restaurant`
  ADD CONSTRAINT `restaurant_id` FOREIGN KEY (`owner_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `horaires`
--
ALTER TABLE `horaires`
  ADD CONSTRAINT `horaires_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `livraison_restaurant`
--
ALTER TABLE `livraison_restaurant`
  ADD CONSTRAINT `livraison_restaurant_ibfk_1` FOREIGN KEY (`livraison_id`) REFERENCES `livraisons` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `livraison_restaurant_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`famille_option_id`) REFERENCES `famille_options` (`id`),
  ADD CONSTRAINT `options_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `options_restaurant`
--
ALTER TABLE `options_restaurant`
  ADD CONSTRAINT `options_restaurant_ibfk_1` FOREIGN KEY (`famille_option_id_rest`) REFERENCES `famille_options_restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `paiment_restaurant`
--
ALTER TABLE `paiment_restaurant`
  ADD CONSTRAINT `paiment_restaurant_ibfk_1` FOREIGN KEY (`paiment_id`) REFERENCES `paiement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paiment_restaurant_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `phone_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produits_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produits_famille_option`
--
ALTER TABLE `produits_famille_option`
  ADD CONSTRAINT `produits` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produits_famille_option_ibfk_1` FOREIGN KEY (`famille_option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produits_restaurant`
--
ALTER TABLE `produits_restaurant`
  ADD CONSTRAINT `produits_restaurant_ibfk_1` FOREIGN KEY (`categorie_rest_id`) REFERENCES `categories_restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produit_familleoptions_restaurant`
--
ALTER TABLE `produit_familleoptions_restaurant`
  ADD CONSTRAINT `options_id` FOREIGN KEY (`id_familleoptions_rest`) REFERENCES `famille_options_restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produits_restautant_id` FOREIGN KEY (`id_produit_rest`) REFERENCES `produits_restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_restaurant_id_foreign` FOREIGN KEY (`restaurant_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `user_product`
--
ALTER TABLE `user_product`
  ADD CONSTRAINT `user_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_product_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
