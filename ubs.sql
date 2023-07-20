-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2023 at 10:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ubs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_closed` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `business_id`, `name`, `account_number`, `account_details`, `account_type_id`, `note`, `created_by`, `is_closed`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'Tide Bank', '20378125', '[{\"label\":\"Sort code\",\"value\":\"040605\"},{\"label\":\"Account Name\",\"value\":\"Unipuller Ltd\"},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null},{\"label\":null,\"value\":null}]', 0, NULL, 6, 0, NULL, '2023-05-13 13:20:12', '2023-05-13 13:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `account_transactions`
--

CREATE TABLE `account_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `account_id` int(11) NOT NULL,
  `type` enum('debit','credit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_type` enum('opening_balance','fund_transfer','deposit') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(22,4) NOT NULL,
  `reff_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `transaction_payment_id` int(11) DEFAULT NULL,
  `transfer_transaction_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_transactions`
--

INSERT INTO `account_transactions` (`id`, `account_id`, `type`, `sub_type`, `amount`, `reff_no`, `operation_date`, `created_by`, `transaction_id`, `transaction_payment_id`, `transfer_transaction_id`, `note`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'credit', NULL, '20.0000', NULL, '2023-07-17 18:17:13', 6, 26, 7, NULL, NULL, '2023-07-17 18:01:33', '2023-07-17 17:17:13', '2023-07-17 18:01:33'),
(2, 1, 'credit', NULL, '20.0000', NULL, '2023-07-17 18:18:43', 6, 27, 8, NULL, NULL, NULL, '2023-07-17 18:03:37', '2023-07-17 18:03:37'),
(3, 1, 'credit', NULL, '0.5000', NULL, '2023-07-17 19:14:07', 6, 28, 9, NULL, NULL, NULL, '2023-07-17 18:14:07', '2023-07-17 18:14:07'),
(4, 1, 'credit', NULL, '20.0000', NULL, '2023-07-18 12:32:10', 6, 22, 14, NULL, NULL, NULL, '2023-07-18 11:33:42', '2023-07-18 11:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `account_types`
--

CREATE TABLE `account_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_account_type_id` int(11) DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account_types`
--

INSERT INTO `account_types` (`id`, `name`, `parent_account_type_id`, `business_id`, `created_at`, `updated_at`) VALUES
(1, 'Bank details', 1, 6, '2023-05-13 13:20:43', '2023-05-13 13:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `event`, `business_id`, `causer_id`, `causer_type`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-17 07:18:03', '2023-03-17 07:18:03'),
(2, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-17 07:36:24', '2023-03-17 07:36:24'),
(3, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-17 07:36:48', '2023-03-17 07:36:48'),
(4, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-17 07:50:49', '2023-03-17 07:50:49'),
(5, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-17 08:03:21', '2023-03-17 08:03:21'),
(6, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-18 07:48:28', '2023-03-18 07:48:28'),
(7, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-19 06:18:20', '2023-03-19 06:18:20'),
(8, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-24 14:18:05', '2023-03-24 14:18:05'),
(9, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-24 18:38:56', '2023-03-24 18:38:56'),
(10, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-24 19:13:09', '2023-03-24 19:13:09'),
(11, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-25 11:44:20', '2023-03-25 11:44:20'),
(12, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-25 11:48:01', '2023-03-25 11:48:01'),
(13, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-25 11:51:00', '2023-03-25 11:51:00'),
(14, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-25 18:57:51', '2023-03-25 18:57:51'),
(15, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-25 19:42:18', '2023-03-25 19:42:18'),
(16, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-25 20:05:08', '2023-03-25 20:05:08'),
(17, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-25 19:01:12', '2023-03-25 19:01:12'),
(18, 'default', 'edited', 6, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Polash Mia\"}', NULL, '2023-03-25 21:29:32', '2023-03-25 21:29:32'),
(19, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-27 02:07:53', '2023-03-27 02:07:53'),
(20, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-27 02:14:10', '2023-03-27 02:14:10'),
(21, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-27 02:14:47', '2023-03-27 02:14:47'),
(22, 'default', 'added', 7, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Shahed Ahmed\"}', NULL, '2023-03-27 02:20:59', '2023-03-27 02:20:59'),
(23, 'default', 'added', 8, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Afzal Hossain\"}', NULL, '2023-03-27 03:12:44', '2023-03-27 03:12:44'),
(24, 'default', 'login', 8, 'App\\User', NULL, 6, 8, 'App\\User', '[]', NULL, '2023-03-27 04:14:38', '2023-03-27 04:14:38'),
(25, 'default', 'edited', 8, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Afzal Hossain\"}', NULL, '2023-03-27 04:23:11', '2023-03-27 04:23:11'),
(26, 'default', 'edited', 7, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Shahed Ahmed\"}', NULL, '2023-03-27 04:24:01', '2023-03-27 04:24:01'),
(27, 'default', 'edited', 8, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Afzal Hossain\"}', NULL, '2023-03-27 04:35:37', '2023-03-27 04:35:37'),
(28, 'default', 'edited', 7, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Shahed Ahmed\"}', NULL, '2023-03-27 04:36:16', '2023-03-27 04:36:16'),
(29, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-27 15:32:21', '2023-03-27 15:32:21'),
(30, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-27 15:33:34', '2023-03-27 15:33:34'),
(31, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-27 15:34:02', '2023-03-27 15:34:02'),
(32, 'default', 'added', 9, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Shahadat Hossain\"}', NULL, '2023-03-27 15:36:54', '2023-03-27 15:36:54'),
(33, 'default', 'login', 9, 'App\\User', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-03-27 15:39:09', '2023-03-27 15:39:09'),
(34, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-28 08:05:32', '2023-03-28 08:05:32'),
(35, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-28 17:13:15', '2023-03-28 17:13:15'),
(36, 'default', 'added', 3, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-28 17:24:49', '2023-03-28 17:24:49'),
(37, 'default', 'login', 10, 'App\\User', NULL, 6, 10, 'App\\User', '[]', NULL, '2023-03-28 17:27:27', '2023-03-28 17:27:27'),
(38, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-28 18:30:25', '2023-03-28 18:30:25'),
(39, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-29 14:33:55', '2023-03-29 14:33:55'),
(40, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-30 01:28:13', '2023-03-30 01:28:13'),
(42, 'default', 'added', 1, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"in_progress\"}}', NULL, '2023-03-30 02:58:17', '2023-03-30 02:58:17'),
(43, 'default', 'edited', 1, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"in_progress\"},\"old\":{\"status\":\"in_progress\"}}', NULL, '2023-03-30 03:08:13', '2023-03-30 03:08:13'),
(44, 'default', 'edited', 1, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"in_progress\"},\"old\":{\"status\":\"in_progress\"}}', NULL, '2023-03-30 03:12:21', '2023-03-30 03:12:21'),
(45, 'default', 'added', 2, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"in_progress\"}}', NULL, '2023-03-30 04:21:44', '2023-03-30 04:21:44'),
(46, 'default', 'login', 9, 'App\\User', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-03-30 04:26:06', '2023-03-30 04:26:06'),
(47, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-30 04:27:19', '2023-03-30 04:27:19'),
(48, 'default', 'edited', 1, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"in_progress\"},\"old\":{\"status\":\"in_progress\"}}', NULL, '2023-03-30 04:32:23', '2023-03-30 04:32:23'),
(49, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-30 04:34:06', '2023-03-30 04:34:06'),
(50, 'default', 'login', 9, 'App\\User', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-03-30 04:34:53', '2023-03-30 04:34:53'),
(51, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-03-30 05:04:42', '2023-03-30 05:04:42'),
(53, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-30 07:27:33', '2023-03-30 07:27:33'),
(54, 'default', 'login', 9, 'App\\User', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-03-30 10:46:24', '2023-03-30 10:46:24'),
(55, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-30 10:54:35', '2023-03-30 10:54:35'),
(56, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-31 04:57:07', '2023-03-31 04:57:07'),
(57, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-31 05:08:08', '2023-03-31 05:08:08'),
(58, 'default', 'logout', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-31 05:10:35', '2023-03-31 05:10:35'),
(59, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-31 05:11:46', '2023-03-31 05:11:46'),
(60, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-03-31 05:13:56', '2023-03-31 05:13:56'),
(61, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-31 05:48:02', '2023-03-31 05:48:02'),
(62, 'default', 'login', 9, 'App\\User', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-03-31 05:50:17', '2023-03-31 05:50:17'),
(63, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-03-31 22:27:43', '2023-03-31 22:27:43'),
(64, 'default', 'login', 9, 'App\\User', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-03-31 22:51:47', '2023-03-31 22:51:47'),
(65, 'default', 'edited', 9, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Shahadat Hossain\"}', NULL, '2023-03-31 23:00:27', '2023-03-31 23:00:27'),
(66, 'default', 'added', 6, 'App\\Contact', NULL, 6, 9, 'App\\User', '[]', NULL, '2023-04-01 00:19:35', '2023-04-01 00:19:35'),
(67, 'default', 'added', 1, 'App\\Transaction', NULL, 6, 9, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":-999982496565}}', NULL, '2023-04-01 00:22:47', '2023-04-01 00:22:47'),
(68, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-01 10:55:44', '2023-04-01 10:55:44'),
(69, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-01 15:05:55', '2023-04-01 15:05:55'),
(70, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-01 18:56:17', '2023-04-01 18:56:17'),
(71, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-02 00:00:43', '2023-04-02 00:00:43'),
(72, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-02 14:24:29', '2023-04-02 14:24:29'),
(73, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-02 14:56:59', '2023-04-02 14:56:59'),
(74, 'default', 'added', 9, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-02 15:09:20', '2023-04-02 15:09:20'),
(75, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-02 17:34:08', '2023-04-02 17:34:08'),
(76, 'default', 'added', 10, 'App\\Contact', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-02 17:38:05', '2023-04-02 17:38:05'),
(77, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-04-02 18:46:33', '2023-04-02 18:46:33'),
(78, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-04-02 18:50:31', '2023-04-02 18:50:31'),
(79, 'default', 'logout', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-04-02 18:50:39', '2023-04-02 18:50:39'),
(80, 'default', 'created', 1, 'App\\DocumentAndNote', 'created', NULL, 6, 'App\\User', '[]', NULL, '2023-04-02 19:23:40', '2023-04-02 19:23:40'),
(81, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-02 23:23:24', '2023-04-02 23:23:24'),
(82, 'default', 'login', 7, 'App\\User', NULL, 6, 7, 'App\\User', '[]', NULL, '2023-04-03 06:16:28', '2023-04-03 06:16:28'),
(83, 'default', 'login', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-03 06:38:56', '2023-04-03 06:38:56'),
(84, 'default', 'deleted', 2, 'App\\DocumentAndNote', 'deleted', NULL, 7, 'App\\User', '[]', NULL, '2023-04-03 06:51:39', '2023-04-03 06:51:39'),
(85, 'default', 'added', 14, 'App\\Contact', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-03 08:24:16', '2023-04-03 08:24:16'),
(86, 'default', 'added', 27, 'App\\Contact', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-03 12:12:49', '2023-04-03 12:12:49'),
(87, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-03 13:21:14', '2023-04-03 13:21:14'),
(88, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-03 23:48:38', '2023-04-03 23:48:38'),
(89, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-04 13:19:02', '2023-04-04 13:19:02'),
(90, 'default', 'created', 3, 'Modules\\Project\\Entities\\Project', 'created', NULL, 5, 'App\\User', '{\"attributes\":{\"name\":\"new test project\",\"text\":null}}', NULL, '2023-04-04 13:31:28', '2023-04-04 13:31:28'),
(91, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-05 23:45:15', '2023-04-05 23:45:16'),
(92, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 11:07:43', '2023-04-07 11:07:43'),
(93, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:12:25', '2023-04-07 11:12:25'),
(94, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:14:03', '2023-04-07 11:14:03'),
(95, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:14:41', '2023-04-07 11:14:41'),
(96, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:18:19', '2023-04-07 11:18:19'),
(97, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 11:19:31', '2023-04-07 11:19:31'),
(98, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 11:20:05', '2023-04-07 11:20:05'),
(99, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:21:04', '2023-04-07 11:21:04'),
(100, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:24:59', '2023-04-07 11:24:59'),
(101, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:25:31', '2023-04-07 11:25:31'),
(102, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 11:26:58', '2023-04-07 11:26:58'),
(103, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:33:26', '2023-04-07 11:33:26'),
(104, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:35:43', '2023-04-07 11:35:43'),
(105, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:39:09', '2023-04-07 11:39:09'),
(106, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:39:49', '2023-04-07 11:39:49'),
(107, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 11:40:27', '2023-04-07 11:40:27'),
(108, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 11:43:02', '2023-04-07 11:43:02'),
(109, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:43:17', '2023-04-07 11:43:17'),
(110, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:48:54', '2023-04-07 11:48:54'),
(111, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:49:39', '2023-04-07 11:49:39'),
(112, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 11:52:13', '2023-04-07 11:52:13'),
(113, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 12:12:37', '2023-04-07 12:12:37'),
(114, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 13:05:27', '2023-04-07 13:05:27'),
(115, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 13:43:29', '2023-04-07 13:43:29'),
(116, 'default', 'login', 5, 'App\\User', NULL, 6, 5, 'App\\User', '[]', NULL, '2023-04-07 13:43:46', '2023-04-07 13:43:46'),
(117, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 13:46:46', '2023-04-07 13:46:46'),
(118, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 23:07:05', '2023-04-07 23:07:05'),
(119, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-07 23:07:38', '2023-04-07 23:07:38'),
(120, 'default', 'login', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-07 23:15:56', '2023-04-07 23:15:56'),
(121, 'default', 'added', 3, 'Modules\\Essentials\\Entities\\ToDo', NULL, 5, 5, 'App\\User', '{\"attributes\":{\"status\":\"on_hold\"}}', NULL, '2023-04-08 01:32:28', '2023-04-08 01:32:28'),
(122, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-09 01:57:47', '2023-04-09 01:57:47'),
(123, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-09 02:01:19', '2023-04-09 02:01:19'),
(124, 'default', 'added', 24, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Pabel Hanif\"}', NULL, '2023-04-13 12:17:57', '2023-04-13 12:17:57'),
(125, 'default', 'added', 25, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Trinath Saha\"}', NULL, '2023-04-13 12:28:33', '2023-04-13 12:28:33'),
(126, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-13 13:15:52', '2023-04-13 13:15:52'),
(127, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-13 19:49:43', '2023-04-13 19:49:43'),
(128, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-13 20:29:13', '2023-04-13 20:29:13'),
(129, 'default', 'added', 4, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"completed\"}}', NULL, '2023-04-14 16:04:56', '2023-04-14 16:04:56'),
(130, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-14 16:07:17', '2023-04-14 16:07:17'),
(131, 'default', 'created', 4, 'Modules\\Project\\Entities\\Project', 'created', NULL, 6, 'App\\User', '{\"attributes\":{\"name\":\"Study Abroad Consultancy\",\"text\":null}}', NULL, '2023-04-22 23:48:50', '2023-04-22 23:48:50'),
(132, 'default', 'settings_updated', 4, 'Modules\\Project\\Entities\\Project', NULL, NULL, 6, 'App\\User', '{\"from\":{\"enable_timelog\":1,\"enable_invoice\":1,\"enable_notes_documents\":1,\"members_crud_task\":0,\"members_crud_note\":0,\"members_crud_timelog\":0,\"task_view\":\"list_view\",\"task_id_prefix\":\"#\"},\"to\":{\"task_view\":\"kanban\",\"enable_timelog\":1,\"enable_notes_documents\":1,\"enable_invoice\":1,\"members_crud_task\":0,\"members_crud_note\":0,\"members_crud_timelog\":0,\"task_id_prefix\":\"#\"}}', NULL, '2023-04-22 23:54:18', '2023-04-22 23:54:18'),
(133, 'default', 'settings_updated', 4, 'Modules\\Project\\Entities\\Project', NULL, NULL, 6, 'App\\User', '{\"from\":{\"task_view\":\"kanban\",\"enable_timelog\":1,\"enable_notes_documents\":1,\"enable_invoice\":1,\"members_crud_task\":0,\"members_crud_note\":0,\"members_crud_timelog\":0,\"task_id_prefix\":\"#\"},\"to\":{\"task_view\":\"kanban\",\"enable_timelog\":1,\"enable_notes_documents\":1,\"enable_invoice\":1,\"members_crud_task\":1,\"members_crud_note\":1,\"members_crud_timelog\":1,\"task_id_prefix\":\"#\"}}', NULL, '2023-04-22 23:56:06', '2023-04-22 23:56:06'),
(134, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 19:30:39', '2023-04-24 19:30:39'),
(135, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 19:48:46', '2023-04-24 19:48:46'),
(136, 'default', 'logout', 27, 'App\\User', NULL, 7, 27, 'App\\User', '[]', NULL, '2023-04-25 00:20:03', '2023-04-25 00:20:03'),
(137, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 20:03:27', '2023-04-24 20:03:27'),
(138, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-24 20:09:38', '2023-04-24 20:09:38'),
(139, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 20:28:41', '2023-04-24 20:28:41'),
(140, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 21:19:56', '2023-04-24 21:19:56'),
(141, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 21:21:33', '2023-04-24 21:21:33'),
(142, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-24 21:23:19', '2023-04-24 21:23:19'),
(143, 'default', 'logout', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-24 21:45:25', '2023-04-24 21:45:25'),
(144, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 21:47:18', '2023-04-24 21:47:18'),
(145, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-04-24 21:48:12', '2023-04-24 21:48:12'),
(146, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 21:57:30', '2023-04-24 21:57:30'),
(147, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-24 22:14:40', '2023-04-24 22:14:40'),
(148, 'default', 'logout', 23, 'App\\User', NULL, 5, 23, 'App\\User', '[]', NULL, '2023-04-24 22:23:27', '2023-04-24 22:23:27'),
(149, 'default', 'added', 3, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"final_total\":911378650}}', NULL, '2023-04-25 14:40:42', '2023-04-25 14:40:42'),
(150, 'default', 'added', 4, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":100000000}}', NULL, '2023-04-25 15:52:50', '2023-04-25 15:52:50'),
(151, 'default', 'added', 5, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":100000000}}', NULL, '2023-04-25 15:54:02', '2023-04-25 15:54:02'),
(152, 'default', 'added', 6, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":100000000}}', NULL, '2023-04-25 15:56:09', '2023-04-25 15:56:09'),
(153, 'default', 'added', 7, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":100000000}}', NULL, '2023-04-25 15:58:09', '2023-04-25 15:58:09'),
(154, 'default', 'added', 8, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":100000000}}', NULL, '2023-04-25 16:19:38', '2023-04-25 16:19:38'),
(155, 'default', 'added', 9, 'App\\Transaction', NULL, 6, 10, 'App\\User', '[]', NULL, '2023-04-25 19:26:46', '2023-04-25 19:26:46'),
(156, 'default', 'edited', 9, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-25 19:58:12', '2023-04-25 19:58:12'),
(157, 'default', 'edited', 9, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-25 20:00:07', '2023-04-25 20:00:07'),
(158, 'default', 'shipping_edited', 9, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"update_note\":null}', NULL, '2023-04-25 20:02:19', '2023-04-25 20:02:19'),
(159, 'default', 'shipping_edited', 9, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"update_note\":null}', NULL, '2023-04-25 20:03:16', '2023-04-25 20:03:16'),
(160, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-26 21:13:35', '2023-04-26 21:13:35'),
(161, 'default', 'logout', 10, 'App\\User', NULL, 6, 10, 'App\\User', '[]', NULL, '2023-04-26 21:22:16', '2023-04-26 21:22:16'),
(162, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-27 19:20:57', '2023-04-27 19:20:57'),
(163, 'default', 'added', 29, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Sheikh Nayan\"}', NULL, '2023-04-27 20:14:50', '2023-04-27 20:14:50'),
(164, 'default', 'added', 30, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Miss Huma Ismail\"}', NULL, '2023-04-27 20:33:34', '2023-04-27 20:33:34'),
(165, 'default', 'added', 31, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Muzammil Shahzad\"}', NULL, '2023-04-27 20:37:51', '2023-04-27 20:37:51'),
(166, 'default', 'edited', 29, 'App\\User', NULL, 6, 6, 'App\\User', '{\"name\":\"Mr Sheikh Nayan\"}', NULL, '2023-04-27 20:39:14', '2023-04-27 20:39:14'),
(167, 'default', 'created', 3, 'App\\DocumentAndNote', 'created', NULL, 6, 'App\\User', '[]', NULL, '2023-04-27 20:42:09', '2023-04-27 20:42:09'),
(168, 'default', 'added', 5, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 29, 'App\\User', '{\"attributes\":{\"status\":\"new\"}}', NULL, '2023-04-27 22:25:25', '2023-04-27 22:25:25'),
(169, 'default', 'added', 6, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 29, 'App\\User', '{\"attributes\":{\"status\":\"new\"}}', NULL, '2023-04-27 22:31:50', '2023-04-27 22:31:50'),
(170, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-27 23:50:37', '2023-04-27 23:50:37'),
(171, 'default', 'logout', 29, 'App\\User', NULL, 6, 29, 'App\\User', '[]', NULL, '2023-04-28 04:42:29', '2023-04-28 04:42:29'),
(172, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-28 05:13:38', '2023-04-28 05:13:38'),
(173, 'default', 'added', 33, 'App\\Contact', NULL, 6, 30, 'App\\User', '[]', NULL, '2023-04-28 08:16:25', '2023-04-28 08:16:25'),
(174, 'default', 'added', 7, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 30, 'App\\User', '{\"attributes\":{\"status\":\"completed\"}}', NULL, '2023-04-28 08:24:34', '2023-04-28 08:24:34'),
(175, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-28 11:48:18', '2023-04-28 11:48:18'),
(176, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-28 11:48:35', '2023-04-28 11:48:35'),
(177, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-28 11:48:51', '2023-04-28 11:48:51'),
(178, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-28 17:43:06', '2023-04-28 17:43:06'),
(179, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-29 01:33:40', '2023-04-29 01:33:40'),
(180, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-29 10:02:53', '2023-04-29 10:02:53'),
(181, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-04-30 22:17:00', '2023-04-30 22:17:00'),
(182, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-04-30 22:17:53', '2023-04-30 22:17:53'),
(183, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-05-03 22:30:00', '2023-05-03 22:30:00'),
(184, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-05-03 22:31:12', '2023-05-03 22:31:12'),
(185, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-05-03 22:31:46', '2023-05-03 22:31:46'),
(186, 'default', 'added', 35, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-05-13 12:15:47', '2023-05-13 12:15:47'),
(187, 'default', 'added', 10, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":75}}', NULL, '2023-05-13 12:29:52', '2023-05-13 12:29:52'),
(188, 'default', 'edited', 10, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"payment_status\":\"due\",\"final_total\":75},\"old\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":\"75.0000\"}}', NULL, '2023-05-13 12:55:43', '2023-05-13 12:55:43'),
(189, 'default', 'added', 11, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":75}}', NULL, '2023-05-13 13:00:29', '2023-05-13 13:00:29'),
(190, 'default', 'edited', 10, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"payment_status\":\"due\",\"final_total\":75},\"old\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"payment_status\":\"due\",\"final_total\":\"75.0000\"}}', NULL, '2023-05-13 13:15:02', '2023-05-13 13:15:02'),
(191, 'default', 'edited', 10, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"proforma\",\"payment_status\":\"due\",\"final_total\":\"75.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"payment_status\":\"due\",\"final_total\":\"75.0000\"}}', NULL, '2023-05-13 13:36:40', '2023-05-13 13:36:40'),
(192, 'default', 'added', 12, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":75}}', NULL, '2023-05-13 13:39:33', '2023-05-13 13:39:33'),
(193, 'default', 'added', 13, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":75}}', NULL, '2023-05-13 13:41:00', '2023-05-13 13:41:00'),
(194, 'default', 'added', 14, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":75}}', NULL, '2023-05-13 13:42:30', '2023-05-13 13:42:30'),
(195, 'default', 'added', 8, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"new\"}}', NULL, '2023-05-16 23:48:38', '2023-05-16 23:48:38'),
(196, 'default', 'edited', 8, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"new\"},\"old\":{\"status\":\"new\"}}', NULL, '2023-05-16 23:56:52', '2023-05-16 23:56:52'),
(197, 'default', 'edited', 8, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"new\"},\"old\":{\"status\":\"new\"}}', NULL, '2023-05-17 00:01:09', '2023-05-17 00:01:09'),
(198, 'default', 'edited', 8, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"new\"},\"old\":{\"status\":\"new\"}}', NULL, '2023-05-17 00:11:06', '2023-05-17 00:11:06'),
(199, 'default', 'created', 5, 'Modules\\Project\\Entities\\Project', 'created', NULL, 6, 'App\\User', '{\"attributes\":{\"name\":\"Unipuller IT project\",\"text\":null}}', NULL, '2023-05-24 21:44:58', '2023-05-24 21:44:58'),
(200, 'default', 'created', 1, 'Modules\\Project\\Entities\\ProjectTask', 'created', NULL, 6, 'App\\User', '{\"attributes\":{\"name\":null,\"text\":null}}', NULL, '2023-05-24 21:48:02', '2023-05-24 21:48:02'),
(201, 'default', 'created', 2, 'Modules\\Project\\Entities\\ProjectTask', 'created', NULL, 6, 'App\\User', '{\"attributes\":{\"name\":null,\"text\":null}}', NULL, '2023-05-24 21:53:10', '2023-05-24 21:53:10'),
(202, 'default', 'created', 4, 'App\\DocumentAndNote', 'created', NULL, 6, 'App\\User', '[]', NULL, '2023-05-24 21:54:24', '2023-05-24 21:54:24'),
(203, 'default', 'created', 5, 'App\\DocumentAndNote', 'created', NULL, 6, 'App\\User', '[]', NULL, '2023-05-24 21:58:39', '2023-05-24 21:58:39'),
(204, 'default', 'added', 15, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":540}}', NULL, '2023-05-25 07:48:50', '2023-05-25 07:48:50'),
(205, 'default', 'added', 16, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":500}}', NULL, '2023-06-03 09:48:36', '2023-06-03 09:48:36'),
(206, 'default', 'added', 9, 'Modules\\Essentials\\Entities\\ToDo', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"status\":\"new\"}}', NULL, '2023-06-12 12:13:04', '2023-06-12 12:13:04'),
(207, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-06-16 20:56:12', '2023-06-16 20:56:12'),
(208, 'default', 'added', 17, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":200}}', NULL, '2023-06-18 10:22:07', '2023-06-18 10:22:07'),
(209, 'default', 'added', 18, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":1616000000}}', NULL, '2023-06-19 14:23:25', '2023-06-19 14:23:25'),
(210, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-06-23 11:46:52', '2023-06-23 11:46:52'),
(211, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-06-26 17:40:57', '2023-06-26 17:40:57'),
(212, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-06-30 10:38:52', '2023-06-30 10:38:52'),
(213, 'default', 'added', 19, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":405.5}}', NULL, '2023-06-30 14:25:31', '2023-06-30 14:25:31'),
(214, 'default', 'added', 39, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-14 17:52:36', '2023-07-14 17:52:36'),
(215, 'default', 'added', 20, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":80}}', NULL, '2023-07-14 18:07:01', '2023-07-14 18:07:01'),
(216, 'default', 'added', 21, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":80}}', NULL, '2023-07-14 18:13:36', '2023-07-14 18:13:36'),
(217, 'default', 'sell_deleted', 21, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":21,\"invoice_no\":\"0007\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":\"80.0000\"}}', NULL, '2023-07-14 18:14:36', '2023-07-14 18:14:36'),
(218, 'default', 'sell_deleted', 20, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":20,\"invoice_no\":\"0006\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"80.0000\"}}', NULL, '2023-07-14 18:14:43', '2023-07-14 18:14:43'),
(219, 'default', 'added', 22, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":80}}', NULL, '2023-07-14 18:18:17', '2023-07-14 18:18:17'),
(220, 'default', 'added', 40, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-15 16:07:55', '2023-07-15 16:07:55'),
(221, 'default', 'added', 23, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":85.5}}', NULL, '2023-07-15 16:30:39', '2023-07-15 16:30:39'),
(222, 'default', 'added', 41, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-15 16:36:17', '2023-07-15 16:36:17'),
(223, 'default', 'added', 24, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":63}}', NULL, '2023-07-15 16:37:57', '2023-07-15 16:37:57'),
(224, 'default', 'added', 42, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-15 16:54:52', '2023-07-15 16:54:52'),
(225, 'default', 'added', 25, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":297}}', NULL, '2023-07-15 16:56:54', '2023-07-15 16:56:54'),
(226, 'default', 'added', 43, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-17 17:14:03', '2023-07-17 17:14:03'),
(227, 'default', 'added', 26, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":239.19999999999999}}', NULL, '2023-07-17 17:17:13', '2023-07-17 17:17:13'),
(228, 'default', 'added', 27, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":299}}', NULL, '2023-07-17 17:18:43', '2023-07-17 17:18:43'),
(229, 'default', 'sell_deleted', 26, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":26,\"invoice_no\":\"0012\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"239.2000\"}}', NULL, '2023-07-17 18:01:33', '2023-07-17 18:01:33'),
(230, 'default', 'edited', 27, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":299},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"299.0000\"}}', NULL, '2023-07-17 18:03:37', '2023-07-17 18:03:37'),
(231, 'default', 'added', 44, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-17 18:12:29', '2023-07-17 18:12:29'),
(232, 'default', 'added', 28, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":95}}', NULL, '2023-07-17 18:14:07', '2023-07-17 18:14:07'),
(233, 'default', 'payment_edited', 28, 'App\\Transaction', NULL, 6, NULL, NULL, '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"95.0000\"},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"95.0000\"}}', NULL, '2023-07-17 18:25:05', '2023-07-17 18:25:05'),
(234, 'default', 'added', 29, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":70}}', NULL, '2023-07-17 18:31:37', '2023-07-17 18:31:37'),
(235, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-17 18:32:43', '2023-07-17 18:32:43'),
(236, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-17 18:34:50', '2023-07-17 18:34:50'),
(237, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-17 18:35:05', '2023-07-17 18:35:05'),
(238, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-17 22:19:13', '2023-07-17 22:19:13'),
(239, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-07-17 22:41:17', '2023-07-17 22:41:17'),
(240, 'default', 'added', 30, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":4.4000000000000004}}', NULL, '2023-07-17 22:57:53', '2023-07-17 22:57:53'),
(241, 'default', 'payment_edited', 30, 'App\\Transaction', NULL, 6, NULL, NULL, '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"paid\",\"final_total\":\"4.4000\"},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":\"4.4000\"}}', NULL, '2023-07-17 23:00:23', '2023-07-17 23:00:23'),
(242, 'default', 'email_notification_sent', 30, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 00:20:01', '2023-07-18 00:20:01'),
(243, 'default', 'added', 31, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":76}}', NULL, '2023-07-18 00:21:47', '2023-07-18 00:21:47'),
(244, 'default', 'added', 32, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":76}}', NULL, '2023-07-18 00:23:07', '2023-07-18 00:23:07'),
(245, 'default', 'email_notification_sent', 31, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 00:24:32', '2023-07-18 00:24:32'),
(246, 'default', 'email_notification_sent', 32, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 00:25:15', '2023-07-18 00:25:15'),
(247, 'default', 'edited', 25, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":297},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":\"297.0000\"}}', NULL, '2023-07-18 10:53:38', '2023-07-18 10:53:38'),
(248, 'default', 'email_notification_sent', 4, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 11:24:19', '2023-07-18 11:24:19'),
(249, 'default', 'email_notification_sent', 3, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 11:25:24', '2023-07-18 11:25:24'),
(250, 'default', 'email_notification_sent', 5, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 11:27:47', '2023-07-18 11:27:47'),
(251, 'default', 'edited', 22, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":80},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":\"80.0000\"}}', NULL, '2023-07-18 11:32:10', '2023-07-18 11:32:10'),
(252, 'default', 'edited', 22, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":80},\"old\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"partial\",\"final_total\":\"80.0000\"}}', NULL, '2023-07-18 11:33:42', '2023-07-18 11:33:42'),
(253, 'default', 'email_notification_sent', 6, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 14:53:38', '2023-07-18 14:53:38'),
(254, 'default', 'added', 45, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:07:12', '2023-07-18 15:07:12'),
(255, 'default', 'email_notification_sent', 7, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:08:36', '2023-07-18 15:08:36'),
(256, 'default', 'email_notification_sent', 8, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:12:16', '2023-07-18 15:12:16'),
(257, 'default', 'email_notification_sent', 9, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:28:05', '2023-07-18 15:28:05'),
(258, 'default', 'added', 46, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:31:24', '2023-07-18 15:31:24'),
(259, 'default', 'email_notification_sent', 10, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:32:35', '2023-07-18 15:32:35'),
(260, 'default', 'added', 47, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:36:03', '2023-07-18 15:36:03'),
(261, 'default', 'email_notification_sent', 11, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:37:18', '2023-07-18 15:37:18'),
(262, 'default', 'added', 48, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:39:54', '2023-07-18 15:39:54'),
(263, 'default', 'email_notification_sent', 12, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:40:56', '2023-07-18 15:40:56'),
(264, 'default', 'added', 49, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:43:02', '2023-07-18 15:43:02'),
(265, 'default', 'email_notification_sent', 13, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:44:30', '2023-07-18 15:44:30'),
(266, 'default', 'added', 50, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:47:15', '2023-07-18 15:47:15'),
(267, 'default', 'email_notification_sent', 14, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:48:38', '2023-07-18 15:48:38'),
(268, 'default', 'added', 51, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:50:02', '2023-07-18 15:50:02'),
(269, 'default', 'email_notification_sent', 15, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:51:19', '2023-07-18 15:51:19'),
(270, 'default', 'added', 52, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:56:29', '2023-07-18 15:56:29'),
(271, 'default', 'email_notification_sent', 16, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 15:57:17', '2023-07-18 15:57:17'),
(272, 'default', 'added', 53, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 16:09:40', '2023-07-18 16:09:40'),
(273, 'default', 'email_notification_sent', 17, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 16:11:02', '2023-07-18 16:11:02'),
(274, 'default', 'added', 54, 'App\\Contact', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 16:12:16', '2023-07-18 16:12:16'),
(275, 'default', 'email_notification_sent', 18, 'App\\Transaction', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 16:13:15', '2023-07-18 16:13:15'),
(276, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-18 20:42:44', '2023-07-18 20:42:44'),
(277, 'default', 'logout', 28, 'App\\User', NULL, 6, 28, 'App\\User', '[]', NULL, '2023-07-18 21:43:21', '2023-07-18 21:43:21'),
(278, 'default', 'added', 33, 'App\\Transaction', NULL, 6, 10, 'App\\User', '[]', NULL, '2023-07-18 21:46:24', '2023-07-18 21:46:24'),
(279, 'default', 'logout', 10, 'App\\User', NULL, 6, 10, 'App\\User', '[]', NULL, '2023-07-18 21:54:04', '2023-07-18 21:54:04'),
(280, 'default', 'logout', 15, 'App\\User', NULL, 6, 15, 'App\\User', '[]', NULL, '2023-07-18 21:54:23', '2023-07-18 21:54:23'),
(281, 'default', 'status_updated', 33, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"from\":\"ordered\",\"to\":\"partial\"}', NULL, '2023-07-18 22:02:36', '2023-07-18 22:02:36'),
(282, 'default', 'added', 34, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"payment_status\":\"due\"}}', NULL, '2023-07-18 22:10:29', '2023-07-18 22:10:29'),
(283, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-19 00:02:01', '2023-07-19 00:02:01'),
(284, 'default', 'added', 35, 'App\\Transaction', NULL, 6, 34, 'App\\User', '[]', NULL, '2023-07-19 00:05:14', '2023-07-19 00:05:14'),
(285, 'default', 'logout', 34, 'App\\User', NULL, 6, 34, 'App\\User', '[]', NULL, '2023-07-19 00:06:11', '2023-07-19 00:06:11'),
(286, 'default', 'logout', 6, 'App\\User', NULL, 6, 6, 'App\\User', '[]', NULL, '2023-07-19 00:12:54', '2023-07-19 00:12:54'),
(287, 'default', 'added', 36, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":70}}', NULL, '2023-07-19 04:19:31', '2023-07-19 04:19:31'),
(288, 'default', 'sell_deleted', 11, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":11,\"invoice_no\":\"Dtraft2023\\/0005\",\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":\"75.0000\"}}', NULL, '2023-07-19 04:23:44', '2023-07-19 04:23:44'),
(289, 'default', 'sell_deleted', 19, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":19,\"invoice_no\":\"Dtraft2023\\/0013\",\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":\"405.5000\"}}', NULL, '2023-07-19 04:24:21', '2023-07-19 04:24:21'),
(290, 'default', 'sell_deleted', 17, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":17,\"invoice_no\":\"Dtraft2023\\/0011\",\"attributes\":{\"type\":\"sell\",\"status\":\"draft\",\"sub_status\":\"quotation\",\"final_total\":\"200.0000\"}}', NULL, '2023-07-19 04:24:29', '2023-07-19 04:24:29'),
(291, 'default', 'sell_deleted', 5, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"id\":5,\"invoice_no\":\"0002\",\"attributes\":{\"type\":\"sell\",\"status\":\"final\",\"payment_status\":\"due\",\"final_total\":\"100000000.0000\"}}', NULL, '2023-07-19 04:25:30', '2023-07-19 04:25:30'),
(292, 'default', 'added', 37, 'App\\Transaction', NULL, 6, 6, 'App\\User', '{\"attributes\":{\"type\":\"sell_return\",\"final_total\":0}}', NULL, '2023-07-19 04:28:01', '2023-07-19 04:28:01'),
(293, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-07-19 12:49:03', '2023-07-19 12:49:03'),
(294, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-07-20 05:47:42', '2023-07-20 05:47:42'),
(295, 'default', 'logout', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-07-20 09:20:08', '2023-07-20 09:20:08'),
(296, 'default', 'login', 5, 'App\\User', NULL, 5, 5, 'App\\User', '[]', NULL, '2023-07-20 15:28:59', '2023-07-20 15:28:59');

-- --------------------------------------------------------

--
-- Table structure for table `arrival_sections`
--

CREATE TABLE `arrival_sections` (
  `id` int(5) NOT NULL,
  `title` varchar(500) NOT NULL,
  `header` varchar(500) NOT NULL,
  `photo` varchar(300) NOT NULL,
  `status` tinyint(5) NOT NULL DEFAULT 0,
  `position` tinyint(5) NOT NULL DEFAULT 0,
  `created_at` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `arrival_sections`
--

INSERT INTO `arrival_sections` (`id`, `title`, `header`, `photo`, `status`, `position`, `created_at`, `updated_at`) VALUES
(3, 'MEN COLLECTION', 'New Autumn Arrival 2021', '164370899567png.png', 0, 0, '2022-02-01 03:03:51.000000', '2023-03-06 21:42:13.000000'),
(4, 'NEW FASHION', 'New Autumn Arrival 2022', '164371008182png.png', 0, 1, '2022-02-01 04:08:01.000000', '2023-03-06 21:42:09.000000');

-- --------------------------------------------------------

--
-- Table structure for table `barcodes`
--

CREATE TABLE `barcodes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `width` double(22,4) DEFAULT NULL,
  `height` double(22,4) DEFAULT NULL,
  `paper_width` double(22,4) DEFAULT NULL,
  `paper_height` double(22,4) DEFAULT NULL,
  `top_margin` double(22,4) DEFAULT NULL,
  `left_margin` double(22,4) DEFAULT NULL,
  `row_distance` double(22,4) DEFAULT NULL,
  `col_distance` double(22,4) DEFAULT NULL,
  `stickers_in_one_row` int(11) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_continuous` tinyint(1) NOT NULL DEFAULT 0,
  `stickers_in_one_sheet` int(11) DEFAULT NULL,
  `business_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `waiter_id` int(10) UNSIGNED DEFAULT NULL,
  `table_id` int(10) UNSIGNED DEFAULT NULL,
  `correspondent_id` int(11) DEFAULT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `booking_start` datetime NOT NULL,
  `booking_end` datetime NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `booking_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `contact_id`, `waiter_id`, `table_id`, `correspondent_id`, `business_id`, `location_id`, `booking_start`, `booking_end`, `created_by`, `booking_status`, `booking_note`, `created_at`, `updated_at`) VALUES
(1, 28, NULL, NULL, NULL, 5, 1, '2023-04-11 06:40:00', '2023-04-14 06:40:00', 23, 'waiting', 'need to discuss about software srs', '2023-04-11 00:40:40', '2023-04-11 00:40:40'),
(2, 33, NULL, NULL, 6, 6, 2, '2023-04-28 09:15:00', '2023-04-29 09:15:00', 30, 'booked', 'lets meet up', '2023-04-28 08:16:33', '2023-04-28 08:16:33'),
(3, 43, NULL, NULL, 6, 6, 2, '2023-07-18 12:18:00', '2023-07-31 12:18:00', 6, 'booked', 'Property booking service\r\ncustomer details\r\n\r\nMd Tuhin\r\nNaderhasantuhin121@gmail.com\r\nPsw \r\nChef\r\nTower hamlets rooms/ 1 bed house newham or any other please \r\nThis month any time', '2023-07-18 11:22:26', '2023-07-18 11:22:26'),
(5, 42, NULL, NULL, NULL, 6, 2, '2023-07-18 12:18:00', '2023-07-31 12:18:00', 6, 'booked', 'riad553@yahoo.com\r\nRiad\r\nStudent department \r\nJune 2024\r\nRatil service \r\nBudget depends not more than 1500\r\nAugust 1\r\nRiad\r\nRiad Kaisar\r\n2 bed is okay with two family', '2023-07-18 11:27:33', '2023-07-18 11:27:33'),
(6, 39, NULL, NULL, 6, 6, 2, '2023-07-18 15:51:00', '2023-08-31 15:52:00', 6, 'booked', 'Name: Yeasin Arafath Sunny\r\nOccupation: care worker\r\nBudget: 400\r\nMoving date: September 1st\r\nPreferred area: hoping to get in Zone 2 if not than anywhere near a train station\r\nI would expect inside zone 2-4', '2023-07-18 14:53:33', '2023-07-18 14:53:33'),
(9, 45, NULL, 1, 6, 6, 2, '2023-07-18 16:26:00', '2023-08-31 16:27:00', 6, 'booked', 'On skilled worker visa, working as a Researcher at a university in central London\r\n- Whitechapel, Shadwell, upton park, Stratford, mile end, bethnal green, camden, leyton other areas within zone3/4\r\n- 800-900 per month\r\n-moving: August/ September \r\nWe are a small family with a kid (1 year 3 month), we can share with a small family or couples.', '2023-07-18 15:27:54', '2023-07-18 15:27:54'),
(10, 46, NULL, 2, NULL, 6, 2, '2023-07-18 16:26:00', '2023-08-31 16:27:00', 6, 'booked', 'Your residency status: dependent \r\nYour occupation: Customers assistant \r\nPreferred area for property: Stepney gree, mile end, bow road.\r\nBudget: 2200 (3/4 bed room flat) 700 (share house)\r\nMoving date: 1st September \r\nShort details of your requirements:', '2023-07-18 15:32:24', '2023-07-18 15:32:24'),
(11, 47, NULL, 2, NULL, 6, 2, '2023-07-18 16:26:00', '2023-07-31 16:27:00', 6, 'booked', 'Md Saidur Rahman \r\nsaidurshahin96@gmail.com\r\n07904074059\r\nGraduate Visa\r\nWork in Tesco \r\nEast London \r\n1st August 2023', '2023-07-18 15:37:00', '2023-07-18 15:37:00'),
(12, 48, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-08-31 16:27:00', 6, 'booked', 'Your residency status: student visa\r\nVisa Expiry date (if relevant): 2026\r\nName of the University(if student): london south bank university \r\nYour occupation: student and part time job\r\nPreferred area for property: mile end, bow road\r\nBudget: 2000-2200 for 3 bed\r\nMoving date: September \r\nShort details of your requirements:', '2023-07-18 15:40:49', '2023-07-18 15:40:49'),
(13, 49, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-07-31 16:27:00', 6, 'booked', 'Rafikul Haque rony\r\nRafikulhaqueroni@gmail.com\r\n07438437994\r\n 2028\r\nWork permit \r\n300/400\r\n01/08/23\r\nSingle room', '2023-07-18 15:44:23', '2023-07-18 15:44:23'),
(14, 50, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-07-31 16:27:00', 6, 'booked', 'Visa expire date: 07 july 2025\r\nOccupation : kitchen  assistant \r\nBudget :2000\r\nArea preferred:upton park, menor park, Whitechapel, east London any area\r\nMoving date: from August \r\nSort requirement :2 or 3 bed room houss', '2023-07-18 15:48:29', '2023-07-18 15:48:29'),
(15, 51, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-07-21 16:27:00', 6, 'booked', 'I am Bangladeshi. I am student of University of essex, colchester but i live in manor park now. I m looking for a couple room from next month. \r\n My budget is £700-750. Location: east London, like Whitechapel, beathnal green, stepney, upton park, east ham, poplar. Bomely by bow.\r\nMashuda\r\nMashuda Islam Chompa\r\nPlease help me for a house i need immediately.🙏', '2023-07-18 15:51:08', '2023-07-18 15:51:08'),
(16, 52, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-08-01 16:27:00', 6, 'booked', 'our residency status:Student \r\nName of the University(if student):BPP University \r\nPreferred area for property:\r\nBudget:380-420\r\nMoving date:\r\nMuhebbul\r\nActually i need a single room only for me\r\nMuhebbul\r\nMuhebbul Islam Tanmoy\r\nMoving date:4/5 th August', '2023-07-18 15:57:11', '2023-07-18 15:57:11'),
(17, 53, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-09-01 16:27:00', 6, 'booked', 'Pls let me know \r\nMe and my husband looking for a double room or a studio flat', '2023-07-18 16:10:55', '2023-07-18 16:10:55'),
(18, 54, NULL, 1, NULL, 6, 2, '2023-07-18 16:26:00', '2023-07-25 16:27:00', 6, 'booked', 'En-suits room', '2023-07-18 16:13:08', '2023-07-18 16:13:08'),
(19, 3, NULL, NULL, NULL, 6, 2, '2023-07-18 22:47:00', '2023-07-19 22:47:00', 10, 'waiting', 'please', '2023-07-18 21:47:29', '2023-07-18 21:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `use_for_repair` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'brands to be used on repair module',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `business_id`, `name`, `description`, `created_by`, `use_for_repair`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'Bata', NULL, 6, 0, NULL, '2023-04-01 19:00:35', '2023-04-01 19:00:35'),
(2, 6, 'UBS', NULL, 6, 0, NULL, '2023-04-13 19:56:35', '2023-04-13 19:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE `business` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `tax_number_1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_label_1` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_number_2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_label_2` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_label_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_label_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_sales_tax` int(10) UNSIGNED DEFAULT NULL,
  `default_profit_percent` double(5,2) NOT NULL DEFAULT 0.00,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `time_zone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Asia/Kolkata',
  `fy_start_month` tinyint(4) NOT NULL DEFAULT 1,
  `accounting_method` enum('fifo','lifo','avco') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fifo',
  `default_sales_discount` decimal(5,2) DEFAULT NULL,
  `sell_price_tax` enum('includes','excludes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'includes',
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sku_prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_product_expiry` tinyint(1) NOT NULL DEFAULT 0,
  `expiry_type` enum('add_expiry','add_manufacturing') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'add_expiry',
  `on_product_expiry` enum('keep_selling','stop_selling','auto_delete') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'keep_selling',
  `stop_selling_before` int(11) NOT NULL COMMENT 'Stop selling expied item n days before expiry',
  `enable_tooltip` tinyint(1) NOT NULL DEFAULT 1,
  `purchase_in_diff_currency` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Allow purchase to be in different currency then the business currency',
  `purchase_currency_id` int(10) UNSIGNED DEFAULT NULL,
  `p_exchange_rate` decimal(20,3) NOT NULL DEFAULT 1.000,
  `transaction_edit_days` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `stock_expiry_alert_days` int(10) UNSIGNED NOT NULL DEFAULT 30,
  `keyboard_shortcuts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pos_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manufacturing_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_api_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_skipped_orders` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_wh_oc_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_wh_ou_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_wh_od_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_wh_or_secret` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `essentials_settings` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weighing_scale_setting` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'used to store the configuration of weighing scale',
  `enable_brand` tinyint(1) NOT NULL DEFAULT 1,
  `enable_category` tinyint(1) NOT NULL DEFAULT 1,
  `enable_sub_category` tinyint(1) NOT NULL DEFAULT 1,
  `enable_price_tax` tinyint(1) NOT NULL DEFAULT 1,
  `enable_purchase_status` tinyint(1) DEFAULT 1,
  `enable_lot_number` tinyint(1) NOT NULL DEFAULT 0,
  `default_unit` int(11) DEFAULT NULL,
  `enable_sub_units` tinyint(1) NOT NULL DEFAULT 0,
  `enable_racks` tinyint(1) NOT NULL DEFAULT 0,
  `enable_row` tinyint(1) NOT NULL DEFAULT 0,
  `enable_position` tinyint(1) NOT NULL DEFAULT 0,
  `enable_editing_product_from_purchase` tinyint(1) NOT NULL DEFAULT 1,
  `sales_cmsn_agnt` enum('logged_in_user','user','cmsn_agnt') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_addition_method` tinyint(1) NOT NULL DEFAULT 1,
  `enable_inline_tax` tinyint(1) NOT NULL DEFAULT 1,
  `currency_symbol_placement` enum('before','after') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'before',
  `enabled_modules` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'm/d/Y',
  `time_format` enum('12','24') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '24',
  `currency_precision` tinyint(4) NOT NULL DEFAULT 2,
  `quantity_precision` tinyint(4) NOT NULL DEFAULT 2,
  `ref_no_prefixes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme_color` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `repair_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crm_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_rp` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `rp_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `amount_for_unit_rp` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `min_order_total_for_rp` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `max_rp_per_order` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `redeem_amount_per_unit_rp` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `min_order_total_for_redeem` decimal(22,4) NOT NULL DEFAULT 1.0000 COMMENT 'rp is the short form of reward points',
  `min_redeem_point` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `max_redeem_point` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `rp_expiry_period` int(11) DEFAULT NULL COMMENT 'rp is the short form of reward points',
  `rp_expiry_type` enum('month','year') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'year' COMMENT 'rp is the short form of reward points',
  `email_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_labels` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `common_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`id`, `name`, `currency_id`, `start_date`, `tax_number_1`, `tax_label_1`, `tax_number_2`, `tax_label_2`, `code_label_1`, `code_1`, `code_label_2`, `code_2`, `default_sales_tax`, `default_profit_percent`, `owner_id`, `time_zone`, `fy_start_month`, `accounting_method`, `default_sales_discount`, `sell_price_tax`, `logo`, `sku_prefix`, `enable_product_expiry`, `expiry_type`, `on_product_expiry`, `stop_selling_before`, `enable_tooltip`, `purchase_in_diff_currency`, `purchase_currency_id`, `p_exchange_rate`, `transaction_edit_days`, `stock_expiry_alert_days`, `keyboard_shortcuts`, `pos_settings`, `manufacturing_settings`, `woocommerce_api_settings`, `woocommerce_skipped_orders`, `woocommerce_wh_oc_secret`, `woocommerce_wh_ou_secret`, `woocommerce_wh_od_secret`, `woocommerce_wh_or_secret`, `essentials_settings`, `weighing_scale_setting`, `enable_brand`, `enable_category`, `enable_sub_category`, `enable_price_tax`, `enable_purchase_status`, `enable_lot_number`, `default_unit`, `enable_sub_units`, `enable_racks`, `enable_row`, `enable_position`, `enable_editing_product_from_purchase`, `sales_cmsn_agnt`, `item_addition_method`, `enable_inline_tax`, `currency_symbol_placement`, `enabled_modules`, `date_format`, `time_format`, `currency_precision`, `quantity_precision`, `ref_no_prefixes`, `theme_color`, `created_by`, `repair_settings`, `crm_settings`, `enable_rp`, `rp_name`, `amount_for_unit_rp`, `min_order_total_for_rp`, `max_rp_per_order`, `redeem_amount_per_unit_rp`, `min_order_total_for_redeem`, `min_redeem_point`, `max_redeem_point`, `rp_expiry_period`, `rp_expiry_type`, `email_settings`, `sms_settings`, `custom_labels`, `common_settings`, `is_active`, `created_at`, `updated_at`) VALUES
(5, 'Unipuller', 2, '2023-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.00, 5, 'Europe/London', 4, 'fifo', '9.00', 'includes', '1680632835_chocolate-cupcakes.jpg', NULL, 0, 'add_expiry', 'keep_selling', 0, 1, 0, NULL, '1.000', 30, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"recent_product_quantity\":\"f2\",\"weighing_scale\":null,\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"add_new_product\":\"f4\"}}', '{\"amount_rounding_method\":null,\"cmmsn_calculation_type\":\"invoice_value\",\"razor_pay_key_id\":null,\"razor_pay_key_secret\":null,\"stripe_public_key\":null,\"stripe_secret_key\":null,\"cash_denominations\":null,\"enable_cash_denomination_on\":\"pos_screen\",\"disable_pay_checkout\":0,\"disable_draft\":0,\"disable_express_checkout\":0,\"hide_product_suggestion\":0,\"hide_recent_trans\":0,\"disable_discount\":0,\"disable_order_tax\":0,\"is_pos_subtotal_editable\":0}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"label_prefix\":null,\"product_sku_length\":\"4\",\"qty_length\":\"3\",\"qty_length_decimal\":\"2\"}', 1, 1, 1, 1, 1, 0, NULL, 0, 0, 0, 0, 1, NULL, 1, 0, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\",\"account\",\"tables\",\"modifiers\",\"service_staff\",\"booking\",\"kitchen\",\"subscription\",\"types_of_service\"]', 'd-m-Y', '24', 2, 2, '{\"purchase\":\"PO\",\"purchase_return\":null,\"purchase_requisition\":null,\"purchase_order\":null,\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"expense_payment\":null,\"business_location\":\"BL\",\"username\":null,\"subscription\":null,\"draft\":null,\"sales_order\":null}', NULL, NULL, NULL, '{\"order_request_prefix\":\"OR-\",\"enable_order_request\":1}', 0, NULL, '999999999999999999.9999', '999999999999999999.9999', NULL, '999999999999999999.9999', '999999999999999999.9999', NULL, NULL, NULL, 'year', '{\"mail_driver\":\"smtp\",\"mail_host\":null,\"mail_port\":null,\"mail_username\":\"sheikh\",\"mail_password\":\"Nayan1010!@\",\"mail_encryption\":null,\"mail_from_address\":null,\"mail_from_name\":null}', '{\"sms_service\":\"other\",\"nexmo_key\":null,\"nexmo_secret\":null,\"nexmo_from\":null,\"twilio_sid\":null,\"twilio_token\":null,\"twilio_from\":null,\"url\":null,\"send_to_param_name\":\"to\",\"msg_param_name\":\"text\",\"request_method\":\"post\",\"header_1\":null,\"header_val_1\":null,\"header_2\":null,\"header_val_2\":null,\"header_3\":null,\"header_val_3\":null,\"param_1\":null,\"param_val_1\":null,\"param_2\":null,\"param_val_2\":null,\"param_3\":null,\"param_val_3\":null,\"param_4\":null,\"param_val_4\":null,\"param_5\":null,\"param_val_5\":null,\"param_6\":null,\"param_val_6\":null,\"param_7\":null,\"param_val_7\":null,\"param_8\":null,\"param_val_8\":null,\"param_9\":null,\"param_val_9\":null,\"param_10\":null,\"param_val_10\":null}', '{\"payments\":{\"custom_pay_1\":null,\"custom_pay_2\":null,\"custom_pay_3\":null,\"custom_pay_4\":null,\"custom_pay_5\":null,\"custom_pay_6\":null,\"custom_pay_7\":null},\"contact\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null},\"product\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"location\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"user\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase_shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"sell\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"types_of_service\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null}}', '{\"default_credit_limit\":null,\"default_datatable_page_entries\":\"25\"}', 1, '2023-03-17 01:17:15', '2023-07-17 22:36:04'),
(6, 'Unipuller', 2, '2023-03-25', '438 5100 09', 'VAT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10.00, 6, 'Europe/London', 5, 'fifo', '10.00', 'includes', '1682438264_uni logo.png', NULL, 1, 'add_expiry', 'stop_selling', 3, 1, 0, NULL, '1.000', 30, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"recent_product_quantity\":\"f2\",\"weighing_scale\":null,\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"add_new_product\":\"f4\"}}', '{\"amount_rounding_method\":null,\"enable_msp\":\"1\",\"allow_overselling\":\"1\",\"enable_sales_order\":\"1\",\"cmmsn_calculation_type\":\"invoice_value\",\"enable_payment_link\":\"1\",\"razor_pay_key_id\":null,\"razor_pay_key_secret\":null,\"stripe_public_key\":\"pk_live_51Mh0IlK8fIrCHSSqaSgz5WBBLzFAQvneNJG3BiCNNy4jt1pIotJFWMOmMnyNxczZy2ltbiDlX9cXODcUu41HI687002cc9ysEz\",\"stripe_secret_key\":\"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\",\"is_pos_subtotal_editable\":\"1\",\"enable_transaction_date\":\"1\",\"enable_weighing_scale\":\"1\",\"show_invoice_scheme\":\"1\",\"show_invoice_layout\":\"1\",\"print_on_suspend\":\"1\",\"show_pricing_on_product_sugesstion\":\"1\",\"cash_denominations\":null,\"enable_cash_denomination_on\":\"all_screens\",\"disable_pay_checkout\":0,\"disable_draft\":0,\"disable_express_checkout\":0,\"hide_product_suggestion\":0,\"hide_recent_trans\":0,\"disable_discount\":0,\"disable_order_tax\":0}', '{\"ref_no_prefix\":null,\"disable_editing_ingredient_qty\":false,\"enable_updating_product_price\":true}', '{\"woocommerce_app_url\":null,\"woocommerce_consumer_key\":\"Unipuller\",\"woocommerce_consumer_secret\":\"@Newyear23\",\"location_id\":\"2\",\"default_tax_class\":null,\"product_tax_type\":\"inc\",\"default_selling_price_group\":null,\"sync_description_as\":\"both\",\"product_fields_for_create\":[\"category\",\"quantity\",\"weight\",\"image\",\"description\"],\"manage_stock_for_create\":\"none\",\"in_stock_for_create\":\"none\",\"product_fields_for_update\":[\"name\",\"price\",\"category\",\"quantity\",\"weight\",\"image\",\"description\"],\"manage_stock_for_update\":\"none\",\"in_stock_for_update\":\"none\",\"order_statuses\":{\"pending\":null,\"processing\":null,\"on-hold\":null,\"completed\":null,\"cancelled\":null,\"refunded\":null,\"failed\":null,\"shipped\":null},\"shipping_statuses\":{\"pending\":null,\"processing\":null,\"on-hold\":null,\"completed\":null,\"cancelled\":null,\"refunded\":null,\"failed\":null,\"shipped\":null},\"woocommerce_wh_oc_secret\":null,\"woocommerce_wh_ou_secret\":null,\"woocommerce_wh_od_secret\":null,\"woocommerce_wh_or_secret\":null}', NULL, NULL, NULL, NULL, NULL, '{\"leave_ref_no_prefix\":null,\"leave_instructions\":null,\"payroll_ref_no_prefix\":null,\"essentials_todos_prefix\":null,\"grace_before_checkin\":\"30\",\"grace_after_checkin\":\"30\",\"grace_before_checkout\":\"10\",\"grace_after_checkout\":\"10\",\"is_location_required\":1,\"calculate_sales_target_commission_without_tax\":0}', '{\"label_prefix\":null,\"product_sku_length\":\"8\",\"qty_length\":\"3\",\"qty_length_decimal\":\"2\"}', 1, 1, 1, 1, 1, 1, 2, 1, 1, 1, 1, 1, 'user', 1, 1, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\",\"account\",\"tables\",\"modifiers\",\"service_staff\",\"booking\",\"subscription\",\"types_of_service\"]', 'd-m-Y', '24', 2, 2, '{\"purchase\":\"P\",\"purchase_return\":\"PR\",\"purchase_requisition\":\"P-RQ\",\"purchase_order\":\"PO\",\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"expense_payment\":\"EP\",\"business_location\":\"BL\",\"username\":\"User\",\"subscription\":\"Subs\",\"draft\":\"Dtraft\",\"sales_order\":\"SO\"}', 'blue', NULL, NULL, '{\"order_request_prefix\":\"OR-\",\"enable_order_request\":1}', 1, 'Reward', '150.0000', '100.0000', NULL, '1.0000', '1.0000', NULL, NULL, 2, 'year', '{\"mail_driver\":\"smtp\",\"mail_host\":\"smtp.unipuller.com\",\"mail_port\":\"465\",\"mail_username\":\"no-reply@unipuller.com\",\"mail_password\":\"Sf|`1qjdy{(-\",\"mail_encryption\":\"ssl\",\"mail_from_address\":\"no-reply@unipuller.com\",\"mail_from_name\":\"Unipuller\"}', '{\"sms_service\":\"other\",\"nexmo_key\":null,\"nexmo_secret\":null,\"nexmo_from\":null,\"twilio_sid\":null,\"twilio_token\":null,\"twilio_from\":null,\"url\":null,\"send_to_param_name\":\"to\",\"msg_param_name\":\"text\",\"request_method\":\"post\",\"header_1\":null,\"header_val_1\":null,\"header_2\":null,\"header_val_2\":null,\"header_3\":null,\"header_val_3\":null,\"param_1\":null,\"param_val_1\":null,\"param_2\":null,\"param_val_2\":null,\"param_3\":null,\"param_val_3\":null,\"param_4\":null,\"param_val_4\":null,\"param_5\":null,\"param_val_5\":null,\"param_6\":null,\"param_val_6\":null,\"param_7\":null,\"param_val_7\":null,\"param_8\":null,\"param_val_8\":null,\"param_9\":null,\"param_val_9\":null,\"param_10\":null,\"param_val_10\":null}', '{\"payments\":{\"custom_pay_1\":null,\"custom_pay_2\":null,\"custom_pay_3\":null,\"custom_pay_4\":null,\"custom_pay_5\":null,\"custom_pay_6\":null,\"custom_pay_7\":null},\"contact\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null,\"custom_field_7\":null,\"custom_field_8\":null,\"custom_field_9\":null,\"custom_field_10\":null},\"product\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"location\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"user\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"purchase_shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"sell\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null},\"shipping\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null},\"types_of_service\":{\"custom_field_1\":null,\"custom_field_2\":null,\"custom_field_3\":null,\"custom_field_4\":null,\"custom_field_5\":null,\"custom_field_6\":null}}', '{\"enable_product_warranty\":\"1\",\"default_credit_limit\":null,\"enable_purchase_order\":\"1\",\"enable_purchase_requisition\":\"1\",\"default_datatable_page_entries\":\"1000\"}', 1, '2023-03-26 00:30:53', '2023-07-18 15:15:33'),
(7, 'test', 1, '2023-04-23', 'sdf', 'sdf', 'sdf', 'sdf', NULL, NULL, NULL, NULL, NULL, 25.00, 27, 'Asia/Kolkata', 1, 'fifo', NULL, 'includes', '1682364806_9212ba55c174a1d751cd85056302d47c_large.png', NULL, 0, 'add_expiry', 'keep_selling', 0, 1, 0, NULL, '1.000', 30, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"recent_product_quantity\":\"f2\",\"add_new_product\":\"f4\"}}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, 1, 1, 1, 0, NULL, 0, 0, 0, 0, 1, NULL, 1, 0, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\"]', 'm/d/Y', '24', 2, 2, '{\"purchase\":\"PO\",\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"business_location\":\"BL\"}', NULL, NULL, NULL, NULL, 0, NULL, '1.0000', '1.0000', NULL, '1.0000', '1.0000', NULL, NULL, NULL, 'year', NULL, NULL, NULL, NULL, 1, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(8, 'Faizan Ahmad', 1, '2023-06-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.00, 33, 'Asia/Kolkata', 1, 'fifo', NULL, 'includes', NULL, NULL, 0, 'add_expiry', 'keep_selling', 0, 1, 0, NULL, '1.000', 30, 30, '{\"pos\":{\"express_checkout\":\"shift+e\",\"pay_n_ckeckout\":\"shift+p\",\"draft\":\"shift+d\",\"cancel\":\"shift+c\",\"edit_discount\":\"shift+i\",\"edit_order_tax\":\"shift+t\",\"add_payment_row\":\"shift+r\",\"finalize_payment\":\"shift+f\",\"recent_product_quantity\":\"f2\",\"add_new_product\":\"f4\"}}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 1, 1, 1, 1, 0, NULL, 0, 0, 0, 0, 1, NULL, 1, 0, 'before', '[\"purchases\",\"add_sale\",\"pos_sale\",\"stock_transfers\",\"stock_adjustment\",\"expenses\"]', 'm/d/Y', '24', 2, 2, '{\"purchase\":\"PO\",\"stock_transfer\":\"ST\",\"stock_adjustment\":\"SA\",\"sell_return\":\"CN\",\"expense\":\"EP\",\"contacts\":\"CO\",\"purchase_payment\":\"PP\",\"sell_payment\":\"SP\",\"business_location\":\"BL\"}', NULL, NULL, NULL, NULL, 0, NULL, '1.0000', '1.0000', NULL, '1.0000', '1.0000', NULL, NULL, NULL, 'year', NULL, NULL, NULL, NULL, 1, '2023-06-13 01:20:59', '2023-06-13 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `business_locations`
--

CREATE TABLE `business_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` char(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_scheme_id` int(10) UNSIGNED NOT NULL,
  `invoice_layout_id` int(10) UNSIGNED NOT NULL,
  `sale_invoice_layout_id` int(11) DEFAULT NULL,
  `selling_price_group_id` int(11) DEFAULT NULL,
  `print_receipt_on_invoice` tinyint(1) DEFAULT 1,
  `receipt_printer_type` enum('browser','printer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'browser',
  `printer_id` int(11) DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_products` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `default_payment_accounts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_locations`
--

INSERT INTO `business_locations` (`id`, `business_id`, `location_id`, `name`, `landmark`, `country`, `state`, `city`, `zip_code`, `invoice_scheme_id`, `invoice_layout_id`, `sale_invoice_layout_id`, `selling_price_group_id`, `print_receipt_on_invoice`, `receipt_printer_type`, `printer_id`, `mobile`, `alternate_number`, `email`, `website`, `featured_products`, `is_active`, `default_payment_accounts`, `custom_field1`, `custom_field2`, `custom_field3`, `custom_field4`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'BL0001', 'Test', '438', 'Bangladesh', 'Dhaka', 'Dhaka', '1206', 1, 1, 1, NULL, 1, 'browser', NULL, '', '', '', '', NULL, 1, '{\"cash\":{\"is_enabled\":1,\"account\":null},\"card\":{\"is_enabled\":1,\"account\":null},\"cheque\":{\"is_enabled\":1,\"account\":null},\"bank_transfer\":{\"is_enabled\":1,\"account\":null},\"other\":{\"is_enabled\":1,\"account\":null},\"custom_pay_1\":{\"is_enabled\":1,\"account\":null},\"custom_pay_2\":{\"is_enabled\":1,\"account\":null},\"custom_pay_3\":{\"is_enabled\":1,\"account\":null},\"custom_pay_4\":{\"is_enabled\":1,\"account\":null},\"custom_pay_5\":{\"is_enabled\":1,\"account\":null},\"custom_pay_6\":{\"is_enabled\":1,\"account\":null},\"custom_pay_7\":{\"is_enabled\":1,\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(2, 6, 'BL0001', 'Unipuller', 'Unit 1a, Nagpal House, 1 Gunthorpe', 'United Kingdom', 'England', 'London', 'E1 7RG', 2, 3, 2, NULL, 1, 'browser', NULL, '07460497454', NULL, 'info@unipuller.com', 'https://unipuller.com/', NULL, 1, '{\"cash\":{\"is_enabled\":\"1\",\"account\":null},\"card\":{\"is_enabled\":\"1\",\"account\":\"1\"},\"cheque\":{\"is_enabled\":\"1\",\"account\":null},\"bank_transfer\":{\"is_enabled\":\"1\",\"account\":\"1\"},\"other\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_1\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_2\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_3\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_4\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_5\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_6\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_7\":{\"is_enabled\":\"1\",\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2023-03-26 00:30:53', '2023-07-17 17:46:30'),
(3, 7, 'BL0001', 'test', 'Test', 'Bangladesh', 'Dhaka', 'Mirpur', '1216', 3, 4, 4, NULL, 1, 'browser', NULL, '01915426458', '', '', 'https://test.com', NULL, 1, '{\"cash\":{\"is_enabled\":1,\"account\":null},\"card\":{\"is_enabled\":1,\"account\":null},\"cheque\":{\"is_enabled\":1,\"account\":null},\"bank_transfer\":{\"is_enabled\":1,\"account\":null},\"other\":{\"is_enabled\":1,\"account\":null},\"custom_pay_1\":{\"is_enabled\":1,\"account\":null},\"custom_pay_2\":{\"is_enabled\":1,\"account\":null},\"custom_pay_3\":{\"is_enabled\":1,\"account\":null},\"custom_pay_4\":{\"is_enabled\":1,\"account\":null},\"custom_pay_5\":{\"is_enabled\":1,\"account\":null},\"custom_pay_6\":{\"is_enabled\":1,\"account\":null},\"custom_pay_7\":{\"is_enabled\":1,\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(4, 8, 'BL0001', 'Faizan Ahmad', 'abc', 'pakistan', 'punjab', 'multan', '61', 4, 5, 5, NULL, 1, 'browser', NULL, '03026644634', '03106644634', '', '', NULL, 1, '{\"cash\":{\"is_enabled\":1,\"account\":null},\"card\":{\"is_enabled\":1,\"account\":null},\"cheque\":{\"is_enabled\":1,\"account\":null},\"bank_transfer\":{\"is_enabled\":1,\"account\":null},\"other\":{\"is_enabled\":1,\"account\":null},\"custom_pay_1\":{\"is_enabled\":1,\"account\":null},\"custom_pay_2\":{\"is_enabled\":1,\"account\":null},\"custom_pay_3\":{\"is_enabled\":1,\"account\":null},\"custom_pay_4\":{\"is_enabled\":1,\"account\":null},\"custom_pay_5\":{\"is_enabled\":1,\"account\":null},\"custom_pay_6\":{\"is_enabled\":1,\"account\":null},\"custom_pay_7\":{\"is_enabled\":1,\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(5, 6, 'BL0002', 'Study Abroad Consultancy', 'Dhaka', 'Bangladesh', 'Bangladesh', 'Dhaka', '1200', 2, 3, 3, NULL, 1, 'browser', NULL, '+447460497454', NULL, 'info@unipuller.com', 'topedugroup.co.uk', NULL, 1, '{\"cash\":{\"is_enabled\":\"1\",\"account\":null},\"card\":{\"is_enabled\":\"1\",\"account\":null},\"cheque\":{\"is_enabled\":\"1\",\"account\":null},\"bank_transfer\":{\"is_enabled\":\"1\",\"account\":null},\"other\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_1\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_2\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_3\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_4\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_5\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_6\":{\"is_enabled\":\"1\",\"account\":null},\"custom_pay_7\":{\"is_enabled\":\"1\",\"account\":null}}', NULL, NULL, NULL, NULL, NULL, '2023-07-18 17:45:13', '2023-07-18 17:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `cash_denominations`
--

CREATE TABLE `cash_denominations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `amount` decimal(22,4) NOT NULL,
  `total_count` int(11) NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_registers`
--

CREATE TABLE `cash_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('close','open') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `closed_at` datetime DEFAULT NULL,
  `closing_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `total_card_slips` int(11) NOT NULL DEFAULT 0,
  `total_cheques` int(11) NOT NULL DEFAULT 0,
  `denominations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closing_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_registers`
--

INSERT INTO `cash_registers` (`id`, `business_id`, `location_id`, `user_id`, `status`, `closed_at`, `closing_amount`, `total_card_slips`, `total_cheques`, `denominations`, `closing_note`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 8, 'open', NULL, '0.0000', 0, 0, NULL, NULL, '2023-03-27 04:16:00', '2023-03-27 04:16:05'),
(2, 6, 2, 9, 'close', '2023-04-01 00:23:23', '10000.0000', 0, 0, NULL, NULL, '2023-03-31 22:53:00', '2023-04-01 00:23:23'),
(3, 6, 2, 6, 'open', NULL, '0.0000', 0, 0, NULL, NULL, '2023-04-01 19:04:00', '2023-04-01 19:04:26'),
(4, 5, 1, 5, 'open', NULL, '0.0000', 0, 0, NULL, NULL, '2023-04-24 20:09:00', '2023-04-24 20:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `cash_register_transactions`
--

CREATE TABLE `cash_register_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `cash_register_id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `pay_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('debit','credit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cash_register_transactions`
--

INSERT INTO `cash_register_transactions` (`id`, `cash_register_id`, `amount`, `pay_method`, `type`, `transaction_type`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 1, '1000.0000', 'cash', 'credit', 'initial', NULL, '2023-03-27 04:16:05', '2023-03-27 04:16:05'),
(2, 2, '100.0000', 'cash', 'credit', 'initial', NULL, '2023-03-31 22:53:13', '2023-03-31 22:53:13'),
(3, 3, '500.0000', 'cash', 'credit', 'initial', NULL, '2023-04-01 19:04:26', '2023-04-01 19:04:26'),
(4, 4, '1000.0000', 'cash', 'credit', 'initial', NULL, '2023-04-24 20:09:21', '2023-04-24 20:09:21'),
(5, 3, '100000000.0000', 'cash', 'credit', 'sell', 4, '2023-04-25 15:52:50', '2023-04-25 15:52:50'),
(6, 3, '100000000.0000', 'cash', 'credit', 'sell', 6, '2023-04-25 15:56:09', '2023-04-25 15:56:09'),
(7, 3, '100000000.0000', 'cash', 'credit', 'sell', 7, '2023-04-25 15:58:09', '2023-04-25 15:58:09'),
(8, 3, '100000000.0000', 'cash', 'credit', 'sell', 8, '2023-04-25 16:19:38', '2023-04-25 16:19:38'),
(11, 3, '20.0000', 'cash', 'credit', 'sell', 27, '2023-07-17 17:18:43', '2023-07-17 17:18:43'),
(12, 3, '20.0000', 'cash', 'debit', 'refund', 27, '2023-07-17 18:03:37', '2023-07-17 18:03:37'),
(13, 3, '20.0000', 'bank_transfer', 'credit', 'sell', 27, '2023-07-17 18:03:37', '2023-07-17 18:03:37'),
(14, 3, '0.5000', 'card', 'credit', 'sell', 28, '2023-07-17 18:14:07', '2023-07-17 18:14:07'),
(15, 3, '5.0000', 'cash', 'credit', 'sell', 31, '2023-07-18 00:21:47', '2023-07-18 00:21:47'),
(16, 3, '20.0000', 'cash', 'credit', 'sell', 25, '2023-07-18 10:53:38', '2023-07-18 10:53:38'),
(17, 3, '20.0000', 'cash', 'credit', 'sell', 22, '2023-07-18 11:32:10', '2023-07-18 11:32:10'),
(18, 3, '20.0000', 'cash', 'debit', 'refund', 22, '2023-07-18 11:33:42', '2023-07-18 11:33:42'),
(19, 3, '20.0000', 'bank_transfer', 'credit', 'sell', 22, '2023-07-18 11:33:42', '2023-07-18 11:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `short_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_cat_id` int(11) DEFAULT NULL,
  `category_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `business_id`, `short_code`, `parent_id`, `created_by`, `woocommerce_cat_id`, `category_type`, `description`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Marketing', 6, 'marketing', 0, 6, NULL, 'hrm_department', NULL, NULL, '2023-03-27 03:34:34', '2023-03-27 03:34:17', '2023-03-27 03:34:34'),
(2, 'Sales', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 03:34:29', '2023-03-27 03:34:29'),
(3, 'Marketing', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 03:34:45', '2023-03-27 03:34:45'),
(4, 'Agent', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, '2023-03-27 04:20:56', '2023-03-27 03:36:17', '2023-03-27 04:20:56'),
(5, 'HR', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 03:36:35', '2023-03-27 03:36:35'),
(6, 'Study abroad consultancy', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 03:36:47', '2023-03-27 03:36:47'),
(7, 'Ast. Manager', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 03:39:29', '2023-03-27 03:39:29'),
(8, 'Manager', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 03:39:49', '2023-03-27 03:39:49'),
(9, 'Sr officer', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, '2023-03-27 04:18:41', '2023-03-27 04:17:38', '2023-03-27 04:18:41'),
(10, 'Junior executive', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:18:10', '2023-03-27 04:18:10'),
(11, 'Sr Executive', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:18:34', '2023-03-27 04:18:34'),
(12, 'Board member', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:18:58', '2023-03-27 04:18:58'),
(13, 'Adviser', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:19:09', '2023-03-27 04:19:23'),
(14, 'Director', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:19:46', '2023-03-27 04:19:46'),
(15, 'Agent', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:20:06', '2023-03-27 04:20:06'),
(16, 'Graduate agent', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-27 04:20:26', '2023-03-27 04:20:26'),
(17, 'Accounting', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 04:21:33', '2023-03-27 04:21:33'),
(18, 'Operation', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 04:21:45', '2023-03-27 04:21:45'),
(19, 'Business development', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-03-27 04:22:09', '2023-03-27 04:22:09'),
(20, 'Partner boarding', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:52:02', '2023-03-30 01:52:02'),
(21, 'Study Abroad Consultancy', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:52:14', '2023-03-30 01:52:14'),
(22, 'UIT (Uni-IT)', 6, NULL, 0, 6, NULL, 'project', 'This is technology department of Unipuller', NULL, '2023-03-30 02:18:59', '2023-03-30 01:53:09', '2023-03-30 02:18:59'),
(23, 'E-commerce', 6, NULL, 0, 6, NULL, 'project', 'E-commerce department', NULL, NULL, '2023-03-30 01:53:47', '2023-03-30 01:53:47'),
(24, 'Products sourcing', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:54:02', '2023-03-30 01:54:02'),
(25, 'Service business', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:54:57', '2023-03-30 01:54:57'),
(26, 'Doctor boarding', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:55:16', '2023-03-30 01:55:16'),
(27, 'Engineer boarding', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:55:33', '2023-03-30 01:55:33'),
(28, 'Car booking', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:56:07', '2023-03-30 01:56:07'),
(29, 'Rental', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:56:30', '2023-03-30 01:56:30'),
(30, 'Marketing', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 01:56:42', '2023-03-30 01:56:42'),
(31, 'HR & training consultancy', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:01:19', '2023-03-30 02:01:19'),
(32, 'Business registrations', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:01:35', '2023-03-30 02:01:35'),
(33, 'Business Policy & strategy formulation', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:01:56', '2023-03-30 02:01:56'),
(34, 'Research', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:02:09', '2023-03-30 02:02:09'),
(35, 'Freelancing', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:02:21', '2023-03-30 02:02:21'),
(36, 'Business analyst', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:02:34', '2023-03-30 02:02:34'),
(37, 'Real estate', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:02:53', '2023-03-30 02:02:53'),
(38, 'Architectural design', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:03:07', '2023-03-30 02:03:07'),
(39, 'Land business', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:03:19', '2023-03-30 02:03:19'),
(40, 'Loan', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:03:37', '2023-03-30 02:03:37'),
(41, 'Painting Business', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:03:48', '2023-03-30 02:03:48'),
(42, 'Builder', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:03:59', '2023-03-30 02:03:59'),
(43, 'Renovating', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:04:09', '2023-03-30 02:04:09'),
(44, 'Plumber', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:04:21', '2023-03-30 02:04:21'),
(45, 'Carpenter', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:04:33', '2023-03-30 02:04:33'),
(46, 'Floor tiles seller', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:04:51', '2023-03-30 02:04:51'),
(47, 'Construction material supplier', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:05:04', '2023-03-30 02:05:04'),
(48, 'Interior design', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:05:16', '2023-03-30 02:05:16'),
(49, 'Graphic design', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:05:32', '2023-03-30 02:05:32'),
(50, 'Video production', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:05:46', '2023-03-30 02:05:46'),
(51, 'Photography', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:06:00', '2023-03-30 02:06:00'),
(52, 'Furniture', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:06:15', '2023-03-30 02:06:15'),
(53, 'Finance', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:06:31', '2023-03-30 02:06:31'),
(54, 'Investment', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:07:48', '2023-03-30 02:07:48'),
(55, 'Operations', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:08:02', '2023-03-30 02:08:02'),
(56, 'Event management', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:08:13', '2023-03-30 02:08:13'),
(57, 'Accountancy', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:08:25', '2023-03-30 02:08:25'),
(58, 'Supplier', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:08:41', '2023-03-30 02:08:41'),
(59, 'Bucher', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:08:52', '2023-03-30 02:08:52'),
(60, 'Electronics', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:09:03', '2023-03-30 02:09:03'),
(61, 'Computer', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:09:14', '2023-03-30 02:09:14'),
(62, 'Mobile', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:09:24', '2023-03-30 02:09:24'),
(63, 'Motor-cycle supplier', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:09:36', '2023-03-30 02:09:36'),
(64, 'By-cycle supplier', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:09:48', '2023-03-30 02:09:48'),
(65, 'Grocery', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:10:07', '2023-03-30 02:10:07'),
(66, 'Beauty', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:10:18', '2023-03-30 02:10:18'),
(67, 'Hardware', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:10:29', '2023-03-30 02:10:29'),
(68, 'Machine', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:10:41', '2023-03-30 02:10:41'),
(69, 'Paper', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:10:53', '2023-03-30 02:10:53'),
(70, 'Book', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:11:04', '2023-03-30 02:11:04'),
(71, 'Educational', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:11:13', '2023-03-30 02:11:13'),
(72, 'Oil', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:11:26', '2023-03-30 02:11:26'),
(73, 'Production', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:11:50', '2023-03-30 02:11:50'),
(74, 'Import', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:12:04', '2023-03-30 02:12:04'),
(75, 'Export', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:12:23', '2023-03-30 02:12:23'),
(76, 'Legal', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:12:34', '2023-03-30 02:12:34'),
(77, 'Technology', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:13:02', '2023-03-30 02:13:02'),
(78, 'Fashion', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:13:27', '2023-03-30 02:13:27'),
(79, 'Grocery', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:13:49', '2023-03-30 02:13:49'),
(80, 'Tutoring', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:14:03', '2023-03-30 02:14:03'),
(81, 'Resume writing', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:14:16', '2023-03-30 02:14:16'),
(82, 'Travels', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:14:40', '2023-03-30 02:14:40'),
(83, 'Tourism', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:14:56', '2023-03-30 02:14:56'),
(84, 'Car', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:15:12', '2023-03-30 02:15:12'),
(85, 'Bike', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:15:28', '2023-03-30 02:15:28'),
(86, 'Dance', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:15:45', '2023-03-30 02:15:45'),
(87, 'Sport & Fitness', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:16:04', '2023-03-30 02:16:04'),
(88, 'Motivational & Influencing', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:16:20', '2023-03-30 02:16:20'),
(89, 'Religious', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:16:38', '2023-03-30 02:16:38'),
(90, 'Meditation', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:16:58', '2023-03-30 02:16:58'),
(91, 'Career development', 6, NULL, 0, 6, NULL, 'project', NULL, NULL, NULL, '2023-03-30 02:17:16', '2023-03-30 02:17:16'),
(92, 'Brand Ambassador', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-30 02:20:18', '2023-03-30 02:20:18'),
(93, 'Freelancer', 6, NULL, 0, 6, NULL, 'hrm_designation', NULL, NULL, NULL, '2023-03-30 02:21:11', '2023-03-30 02:21:11'),
(94, 'Facebook', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:49:44', '2023-04-01 00:49:44'),
(95, 'Google', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:49:54', '2023-04-01 00:49:54'),
(96, 'Personal contact', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:50:10', '2023-04-01 00:50:10'),
(97, 'Instagram', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:50:22', '2023-04-01 00:50:22'),
(98, 'Linkedin', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:50:32', '2023-04-01 00:50:32'),
(99, 'Ticktok', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:50:47', '2023-04-01 00:50:47'),
(100, 'Others', 6, NULL, 0, 6, NULL, 'source', NULL, NULL, NULL, '2023-04-01 00:51:10', '2023-04-01 00:51:10'),
(101, 'test', 5, NULL, 0, 5, NULL, 'life_stage', 'test description', NULL, NULL, '2023-04-07 13:51:03', '2023-04-07 13:51:03'),
(102, 'Web Development', 6, NULL, 0, 6, NULL, 'product', NULL, NULL, NULL, '2023-04-13 19:53:12', '2023-04-13 19:53:12'),
(103, 'Study Abroad Consultancy', 6, NULL, 0, 6, NULL, 'product', NULL, NULL, NULL, '2023-04-13 19:53:24', '2023-04-13 19:53:24'),
(104, 'Rental', 6, NULL, 0, 6, NULL, 'product', NULL, NULL, NULL, '2023-04-13 19:53:36', '2023-04-13 19:53:36'),
(105, 'Export', 6, NULL, 0, 6, NULL, 'product', NULL, NULL, NULL, '2023-04-13 19:53:47', '2023-04-13 19:53:47'),
(106, 'Import', 6, NULL, 0, 6, NULL, 'product', NULL, NULL, NULL, '2023-04-13 19:53:57', '2023-04-13 19:53:57'),
(107, 'Technology', 6, NULL, 0, 6, NULL, 'hrm_department', NULL, NULL, NULL, '2023-04-27 20:31:07', '2023-04-27 20:31:07'),
(108, 'Marketing service', 6, NULL, 0, 6, NULL, 'product', NULL, NULL, NULL, '2023-05-13 12:19:10', '2023-05-13 12:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `categorizables`
--

CREATE TABLE `categorizables` (
  `category_id` int(11) NOT NULL,
  `categorizable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorizable_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorizables`
--

INSERT INTO `categorizables` (`category_id`, `categorizable_type`, `categorizable_id`) VALUES
(71, 'Modules\\Project\\Entities\\Project', 4),
(61, 'Modules\\Project\\Entities\\Project', 5),
(71, 'Modules\\Project\\Entities\\Project', 4),
(61, 'Modules\\Project\\Entities\\Project', 5),
(71, 'Modules\\Project\\Entities\\Project', 4),
(61, 'Modules\\Project\\Entities\\Project', 5),
(71, 'Modules\\Project\\Entities\\Project', 4),
(61, 'Modules\\Project\\Entities\\Project', 5);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_business_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `tax_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternate_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_term_number` int(11) DEFAULT NULL,
  `pay_term_type` enum('days','months') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_limit` decimal(22,4) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `converted_by` int(11) DEFAULT NULL,
  `converted_on` datetime DEFAULT NULL,
  `balance` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `total_rp` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `total_rp_used` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `total_rp_expired` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_custom_field_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_export` tinyint(1) NOT NULL DEFAULT 0,
  `export_custom_field_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_custom_field_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_custom_field_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_custom_field_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_custom_field_5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `export_custom_field_6` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL,
  `crm_source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crm_life_stage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field6` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field7` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field8` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field9` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field10` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `business_id`, `type`, `supplier_business_name`, `name`, `prefix`, `first_name`, `middle_name`, `last_name`, `email`, `contact_id`, `contact_status`, `tax_number`, `city`, `state`, `country`, `address_line_1`, `address_line_2`, `zip_code`, `dob`, `mobile`, `landline`, `alternate_number`, `pay_term_number`, `pay_term_type`, `credit_limit`, `created_by`, `converted_by`, `converted_on`, `balance`, `total_rp`, `total_rp_used`, `total_rp_expired`, `is_default`, `shipping_address`, `shipping_custom_field_details`, `is_export`, `export_custom_field_1`, `export_custom_field_2`, `export_custom_field_3`, `export_custom_field_4`, `export_custom_field_5`, `export_custom_field_6`, `position`, `customer_group_id`, `crm_source`, `crm_life_stage`, `custom_field1`, `custom_field2`, `custom_field3`, `custom_field4`, `custom_field5`, `custom_field6`, `custom_field7`, `custom_field8`, `custom_field9`, `custom_field10`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'customer', NULL, 'Walk-In Customer', NULL, NULL, NULL, NULL, NULL, 'CO0001', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '0.0000', 5, NULL, NULL, '0.0000', 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(2, 6, 'customer', NULL, 'Walk-In Customer', NULL, NULL, NULL, NULL, NULL, 'CO0001', 'inactive', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '0.0000', 6, NULL, NULL, '0.0000', 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-26 00:30:53', '2023-04-02 15:10:52'),
(3, 6, 'both', 'Farsight Global Ltd', '', NULL, NULL, NULL, NULL, 'info@farsightglobal.co.uk', 'CO0002', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+4407448581280', NULL, '+4407448581280', NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-28 17:24:49', '2023-03-28 17:24:49'),
(4, 6, 'lead', 'Rainbow Factory Bangladesh', 'mr Afzal bbc Hossain', 'mr', 'Afzal', 'bbc', 'Hossain', 'rainbowfactorybangladesh@gmail.com', 'CO0003', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+8801622931140', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 06:09:19', '2023-03-31 06:09:19'),
(5, 6, 'lead', 'Rainbow Factory Bangladesh', 'mr Afzal bbc Hossain', 'mr', 'Afzal', 'bbc', 'Hossain', 'rainbowfactorybangladesh@gmail.com', 'CO0004', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+8801622931140', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-01 00:35:03', '2023-03-31 06:09:21', '2023-04-01 00:35:03'),
(6, 6, 'customer', NULL, 'Mr POLASH MIA', 'Mr', 'POLASH', NULL, 'MIA', 'tanzimhassanp@gmail.com', 'CO0005', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1995-05-11', '07460497454', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-01 00:19:35', '2023-04-01 00:19:35'),
(7, 6, 'lead', NULL, 'Miss Mridula  Islam', 'Miss', 'Mridula', NULL, 'Islam', 'mridulai62@gmail.com', 'CO0006', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-01 00:33:11', '2023-04-01 00:33:11'),
(8, 6, 'lead', NULL, 'Mr Sonjit Kumar Das', 'Mr', 'Sonjit', 'Kumar', 'Das', 'sonjitkumar2@gmail.com', 'CO0007', 'active', NULL, 'Dhaka', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, '01781249540', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-01 14:35:24', '2023-04-01 14:35:24'),
(9, 6, 'supplier', 'Timerni', '', NULL, NULL, NULL, NULL, 'info@timerni.com', 'CO0008', 'active', NULL, 'Portsmouth', 'Hampshire', 'United Kingdom', NULL, NULL, 'PO1 2QF', NULL, '07554823078', '02380528262', NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, '1-2 Hampshire Terrace, Portsmouth, PO1 2QF', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 15:09:20', '2023-04-02 15:09:20'),
(10, 5, 'supplier', 'test business', '', NULL, NULL, NULL, NULL, 'trinath@trinathtech.com', '4556415641', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01620621910', NULL, '01751867845', NULL, NULL, NULL, 5, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 17:38:05', '2023-04-02 17:38:05'),
(11, 6, 'lead', 'Boost Education Service', '   ', NULL, NULL, NULL, NULL, 'info@boosteducationservice.co.uk', 'CO0009', 'active', NULL, 'London', 'London', 'United Kingdom', '11 Beaufort Court, Admirals Way', 'Canary Wharf', 'E14 9XL', NULL, '02033189380', '02033189380', NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '95', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 18:57:14', '2023-04-02 18:57:14'),
(12, 6, 'lead', NULL, 'Mr Niaj  ', 'Mr', 'Niaj', NULL, NULL, 'mamamojapailam913@gmail.com', 'CO0010', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01322064403', NULL, NULL, NULL, NULL, NULL, 9, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 19:47:02', '2023-04-02 19:47:02'),
(13, 6, 'lead', 'Dress Mart', '   ', NULL, NULL, NULL, NULL, 'imdressmart@gmail.com', 'CO0011', 'active', NULL, 'Dhaka', 'Dhaka', 'Bangladesh', NULL, NULL, '1000', NULL, '01747261310', NULL, '01747261325', NULL, NULL, NULL, 7, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-03 07:01:13', '2023-04-03 07:01:13'),
(14, 5, 'supplier', 'test business details', '', NULL, NULL, NULL, NULL, 'trinath@trinathtech.com', 'c00016', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01620621910', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-03 08:24:15', '2023-04-03 08:24:15'),
(27, 5, 'supplier', NULL, '', NULL, NULL, NULL, NULL, NULL, 'c000032', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01515151515', NULL, '00011112222', NULL, NULL, NULL, 5, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-03 12:12:49', '2023-04-03 12:12:49'),
(28, 5, 'lead', 'test trinath business', ' test trinath ', NULL, 'test', 'trinath', NULL, NULL, 'CO0005', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00000221111', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-07 13:09:09', '2023-04-07 14:00:52'),
(29, 6, 'lead', NULL, 'Mr Saeeduzzaman  ', 'Mr', 'Saeeduzzaman', NULL, NULL, 'saeed.humanist@gmail.com', 'CO0012', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+44 7599 610065', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '96', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 20:24:53', '2023-04-13 20:24:53'),
(30, 7, 'customer', NULL, 'Walk-In Customer', NULL, NULL, NULL, NULL, NULL, 'CO0001', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '0.0000', 27, NULL, NULL, '0.0000', 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(31, 6, 'lead', 'test', '   ', NULL, NULL, NULL, NULL, NULL, 'CO0013', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01715426458', NULL, NULL, NULL, NULL, NULL, 29, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-27 21:45:17', '2023-04-27 21:45:17'),
(32, 6, 'lead', 'test2', '   ', NULL, NULL, NULL, NULL, NULL, 'CO0014', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01715426458', NULL, NULL, NULL, NULL, NULL, 29, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-27 21:46:31', '2023-04-27 21:46:31'),
(33, 6, 'customer', NULL, 'mr jhn doe', 'mr', 'jhn', NULL, 'doe', 'raxy4jid@mailinator.com', 'CO0015', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-12', '03333333335', NULL, '03333333335', NULL, NULL, NULL, 30, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-28 08:16:25', '2023-04-28 08:16:25'),
(34, 6, 'lead', 'Furnicom', '   ', NULL, NULL, NULL, NULL, 'hossain.moynul@gmail.com', 'CO0016', 'active', NULL, 'Dhaka', NULL, 'Bangladesh', NULL, NULL, NULL, NULL, '+8801713064663', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-29 19:09:19', '2023-04-29 19:09:19'),
(35, 6, 'customer', 'Alexa A ltd', '', NULL, NULL, NULL, NULL, 'alexander.l.alexiev@gmail.com', 'CO0017', 'active', '2830420512', 'London', NULL, 'United Kingdom', '72 Grove Green Rd', NULL, 'E11 4Ej', NULL, '07599004668', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, '72 Grove Green Rd, London E11 4EJ', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-13 12:15:47', '2023-05-13 12:15:47'),
(36, 8, 'customer', NULL, 'Walk-In Customer', NULL, NULL, NULL, NULL, NULL, 'CO0001', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, '0.0000', 33, NULL, NULL, '0.0000', 0, 0, 0, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(37, 6, 'lead', NULL, 'Mr Mathilde  ', 'Mr', 'Mathilde', NULL, NULL, 'taja@gmail.com', 'CO0018', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+447460497454', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100', NULL, 'https://www.spareroom.co.uk/flatshare/flatmate_detail.pl?flatshare_id=16765417&search_id=1225083465&city_id=&summarised_location_matching_gs_id=14&flatshare_type=wanted&search_results=%2Fflat', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-15 18:36:42', '2023-06-15 18:36:42'),
(38, 6, 'lead', NULL, ' jj  ', NULL, 'jj', NULL, NULL, 'uniou@fjds', 'CO0019', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '00', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-16 21:26:16', '2023-06-16 21:26:16'),
(39, 6, 'customer', NULL, 'Mr Arafat Sunny', 'Mr', 'Arafat', NULL, 'Sunny', 'yeasinarafathsunny@gmail.com', 'CO0020', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+44 7479 305987', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-14 17:52:36', '2023-07-14 17:52:36'),
(40, 6, 'customer', NULL, 'Mrs Shilu', 'Mrs', 'Shilu', NULL, NULL, 'tnshilu@gmail.com', 'CO0021', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+880 1790-142812', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 16:07:55', '2023-07-15 16:07:55'),
(41, 6, 'customer', NULL, 'Mr Aryan', 'Mr', 'Aryan', NULL, NULL, 'aryanalviy6@gmail.com', 'CO0022', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07404108098', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 16:36:17', '2023-07-15 16:36:17'),
(42, 6, 'customer', NULL, 'Mr Riad Kaisar', 'Mr', 'Riad', NULL, 'Kaisar', 'riad553@yahoo.com', 'CO0023', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07459821850', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 1, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-15 16:54:52', '2023-07-15 16:56:54'),
(43, 6, 'customer', NULL, 'Mr Tuhin', 'Mr', 'Tuhin', NULL, NULL, 'naderhasantuhin121@gmail.com', 'CO0024', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+44 7542 765148', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 1, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 17:14:03', '2023-07-17 18:01:33'),
(44, 6, 'customer', NULL, 'Mr Polash', 'Mr', 'Polash', NULL, NULL, 'polashtex89@gmail.com', 'CO0025', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '+447460497454', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 18:12:29', '2023-07-17 18:12:29'),
(45, 6, 'customer', NULL, 'Mr Shafiur Rahaman', 'Mr', 'Shafiur', NULL, 'Rahaman', 'rahamanpt@gmail.com', 'CO0026', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07438571829', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:07:12', '2023-07-18 15:07:12'),
(46, 6, 'customer', NULL, 'Mr Humayoun Rasid Tarek', 'Mr', 'Humayoun', 'Rasid', 'Tarek', 'humayounrasidtarek@gmail.com', 'CO0027', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07930277463', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:31:24', '2023-07-18 15:31:24'),
(47, 6, 'customer', NULL, 'Mr Saidur Rahaman', 'Mr', 'Saidur', NULL, 'Rahaman', 'saidurshahin96@gmail.com', 'CO0028', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07904074059', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:36:03', '2023-07-18 15:36:03'),
(48, 6, 'customer', NULL, 'Mr Mahmud Hossain', 'Mr', 'Mahmud', NULL, 'Hossain', 'mahmudhossainamin@gmail.com', 'CO0029', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07403538998', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:39:54', '2023-07-18 15:39:54'),
(49, 6, 'customer', NULL, 'Mr Rafikul Haque rony', 'Mr', 'Rafikul', NULL, 'Haque rony', 'Rafikulhaqueroni@gmail.com', 'CO0030', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07438437994', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:43:02', '2023-07-18 15:43:02'),
(50, 6, 'customer', NULL, 'Mr Reajul Islam', 'Mr', 'Reajul', NULL, 'Islam', 'riazul.email@gmail.com', 'CO0031', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07404932924', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:47:15', '2023-07-18 15:47:15'),
(51, 6, 'customer', NULL, 'Miss Mashuda Begum', 'Miss', 'Mashuda', NULL, 'Begum', 'mashudabegum974@gmail.com', 'CO0032', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07917020966', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:50:02', '2023-07-18 15:50:02'),
(52, 6, 'customer', NULL, 'Mr Muhebbul Islam Tanmoy', 'Mr', 'Muhebbul', 'Islam', 'Tanmoy', 'mi1971tanmoy@gmail.com', 'CO0033', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07949539426', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 15:56:29', '2023-07-18 15:56:29'),
(53, 6, 'customer', NULL, 'Miss Jannat Juhi Nizam', 'Miss', 'Jannat', 'Juhi', 'Nizam', 'juhinzam0002@gmail.com', 'CO0034', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07466056966', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 16:09:40', '2023-07-18 16:09:40'),
(54, 6, 'customer', NULL, 'Mrs Nusrat Rahman', 'Mrs', 'Nusrat', NULL, 'Rahman', 'nusratrahmanniloy@gmail.com', 'CO0035', 'active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07424045674', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, '0.0000', 0, 0, 0, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 16:12:16', '2023-07-18 16:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT '',
  `tax` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `tax`, `status`) VALUES
(1, 'AF', 'Afghanistan', 0, 0),
(2, 'AL', 'Albania', 0, 0),
(3, 'DZ', 'Algeria', 0, 0),
(4, 'DS', 'American Samoa', 0, 0),
(5, 'AD', 'Andorra', 0, 0),
(6, 'AO', 'Angola', 0, 0),
(7, 'AI', 'Anguilla', 0, 0),
(8, 'AQ', 'Antarctica', 0, 0),
(9, 'AG', 'Antigua and Barbuda', 0, 0),
(10, 'AR', 'Argentina', 0, 0),
(11, 'AM', 'Armenia', 0, 0),
(12, 'AW', 'Aruba', 0, 0),
(13, 'AU', 'Australia', 0, 0),
(14, 'AT', 'Austria', 0, 0),
(15, 'AZ', 'Azerbaijan', 0, 0),
(16, 'BS', 'Bahamas', 0, 0),
(17, 'BH', 'Bahrain', 0, 0),
(18, 'BD', 'Bangladesh', 0, 1),
(19, 'BB', 'Barbados', 0, 0),
(20, 'BY', 'Belarus', 0, 0),
(21, 'BE', 'Belgium', 0, 0),
(22, 'BZ', 'Belize', 0, 0),
(23, 'BJ', 'Benin', 0, 0),
(24, 'BM', 'Bermuda', 0, 0),
(25, 'BT', 'Bhutan', 0, 0),
(26, 'BO', 'Bolivia', 0, 0),
(27, 'BA', 'Bosnia and Herzegovina', 0, 0),
(28, 'BW', 'Botswana', 0, 0),
(29, 'BV', 'Bouvet Island', 0, 0),
(30, 'BR', 'Brazil', 0, 0),
(31, 'IO', 'British Indian Ocean Territory', 0, 0),
(32, 'BN', 'Brunei Darussalam', 0, 0),
(33, 'BG', 'Bulgaria', 0, 0),
(34, 'BF', 'Burkina Faso', 0, 0),
(35, 'BI', 'Burundi', 0, 0),
(36, 'KH', 'Cambodia', 0, 0),
(37, 'CM', 'Cameroon', 0, 0),
(38, 'CA', 'Canada', 0, 0),
(39, 'CV', 'Cape Verde', 0, 0),
(40, 'KY', 'Cayman Islands', 0, 0),
(41, 'CF', 'Central African Republic', 0, 0),
(42, 'TD', 'Chad', 0, 0),
(43, 'CL', 'Chile', 0, 0),
(44, 'CN', 'China', 0, 0),
(45, 'CX', 'Christmas Island', 0, 0),
(46, 'CC', 'Cocos (Keeling) Islands', 0, 0),
(47, 'CO', 'Colombia', 0, 0),
(48, 'KM', 'Comoros', 0, 0),
(49, 'CD', 'Democratic Republic of the Congo', 0, 0),
(50, 'CG', 'Republic of Congo', 0, 0),
(51, 'CK', 'Cook Islands', 0, 0),
(52, 'CR', 'Costa Rica', 0, 0),
(53, 'HR', 'Croatia (Hrvatska)', 0, 0),
(54, 'CU', 'Cuba', 0, 0),
(55, 'CY', 'Cyprus', 0, 0),
(56, 'CZ', 'Czech Republic', 0, 0),
(57, 'DK', 'Denmark', 0, 0),
(58, 'DJ', 'Djibouti', 0, 0),
(59, 'DM', 'Dominica', 0, 0),
(60, 'DO', 'Dominican Republic', 0, 0),
(61, 'TP', 'East Timor', 0, 0),
(62, 'EC', 'Ecuador', 0, 0),
(63, 'EG', 'Egypt', 0, 0),
(64, 'SV', 'El Salvador', 0, 0),
(65, 'GQ', 'Equatorial Guinea', 0, 0),
(66, 'ER', 'Eritrea', 0, 0),
(67, 'EE', 'Estonia', 0, 0),
(68, 'ET', 'Ethiopia', 0, 0),
(69, 'FK', 'Falkland Islands (Malvinas)', 0, 0),
(70, 'FO', 'Faroe Islands', 0, 0),
(71, 'FJ', 'Fiji', 0, 0),
(72, 'FI', 'Finland', 0, 0),
(73, 'FR', 'France', 0, 0),
(74, 'FX', 'France, Metropolitan', 0, 0),
(75, 'GF', 'French Guiana', 0, 0),
(76, 'PF', 'French Polynesia', 0, 0),
(77, 'TF', 'French Southern Territories', 0, 0),
(78, 'GA', 'Gabon', 0, 0),
(79, 'GM', 'Gambia', 0, 0),
(80, 'GE', 'Georgia', 0, 0),
(81, 'DE', 'Germany', 0, 0),
(82, 'GH', 'Ghana', 0, 0),
(83, 'GI', 'Gibraltar', 0, 0),
(84, 'GK', 'Guernsey', 0, 0),
(85, 'GR', 'Greece', 0, 0),
(86, 'GL', 'Greenland', 0, 0),
(87, 'GD', 'Grenada', 0, 0),
(88, 'GP', 'Guadeloupe', 0, 0),
(89, 'GU', 'Guam', 0, 0),
(90, 'GT', 'Guatemala', 0, 0),
(91, 'GN', 'Guinea', 0, 0),
(92, 'GW', 'Guinea-Bissau', 0, 0),
(93, 'GY', 'Guyana', 0, 0),
(94, 'HT', 'Haiti', 0, 0),
(95, 'HM', 'Heard and Mc Donald Islands', 0, 0),
(96, 'HN', 'Honduras', 0, 0),
(97, 'HK', 'Hong Kong', 0, 0),
(98, 'HU', 'Hungary', 0, 0),
(99, 'IS', 'Iceland', 0, 0),
(100, 'IN', 'India', 0, 0),
(101, 'IM', 'Isle of Man', 0, 0),
(102, 'ID', 'Indonesia', 0, 0),
(103, 'IR', 'Iran (Islamic Republic of)', 0, 0),
(104, 'IQ', 'Iraq', 0, 0),
(105, 'IE', 'Ireland', 0, 0),
(106, 'IL', 'Israel', 0, 0),
(107, 'IT', 'Italy', 0, 0),
(108, 'CI', 'Ivory Coast', 0, 0),
(109, 'JE', 'Jersey', 0, 0),
(110, 'JM', 'Jamaica', 0, 0),
(111, 'JP', 'Japan', 0, 0),
(112, 'JO', 'Jordan', 0, 0),
(113, 'KZ', 'Kazakhstan', 0, 0),
(114, 'KE', 'Kenya', 0, 0),
(115, 'KI', 'Kiribati', 0, 0),
(116, 'KP', 'Korea, Democratic People\'s Republic of', 0, 0),
(117, 'KR', 'Korea, Republic of', 0, 0),
(118, 'XK', 'Kosovo', 0, 0),
(119, 'KW', 'Kuwait', 0, 0),
(120, 'KG', 'Kyrgyzstan', 0, 0),
(121, 'LA', 'Lao People\'s Democratic Republic', 0, 0),
(122, 'LV', 'Latvia', 0, 0),
(123, 'LB', 'Lebanon', 0, 0),
(124, 'LS', 'Lesotho', 0, 0),
(125, 'LR', 'Liberia', 0, 0),
(126, 'LY', 'Libyan Arab Jamahiriya', 0, 0),
(127, 'LI', 'Liechtenstein', 0, 0),
(128, 'LT', 'Lithuania', 0, 0),
(129, 'LU', 'Luxembourg', 0, 0),
(130, 'MO', 'Macau', 0, 0),
(131, 'MK', 'North Macedonia', 0, 0),
(132, 'MG', 'Madagascar', 0, 0),
(133, 'MW', 'Malawi', 0, 0),
(134, 'MY', 'Malaysia', 0, 0),
(135, 'MV', 'Maldives', 0, 0),
(136, 'ML', 'Mali', 0, 0),
(137, 'MT', 'Malta', 0, 0),
(138, 'MH', 'Marshall Islands', 0, 0),
(139, 'MQ', 'Martinique', 0, 0),
(140, 'MR', 'Mauritania', 0, 0),
(141, 'MU', 'Mauritius', 0, 0),
(142, 'TY', 'Mayotte', 0, 0),
(143, 'MX', 'Mexico', 0, 0),
(144, 'FM', 'Micronesia, Federated States of', 0, 0),
(145, 'MD', 'Moldova, Republic of', 0, 0),
(146, 'MC', 'Monaco', 0, 0),
(147, 'MN', 'Mongolia', 0, 0),
(148, 'ME', 'Montenegro', 0, 0),
(149, 'MS', 'Montserrat', 0, 0),
(150, 'MA', 'Morocco', 0, 0),
(151, 'MZ', 'Mozambique', 0, 0),
(152, 'MM', 'Myanmar', 0, 0),
(153, 'NA', 'Namibia', 0, 0),
(154, 'NR', 'Nauru', 0, 0),
(155, 'NP', 'Nepal', 0, 0),
(156, 'NL', 'Netherlands', 0, 0),
(157, 'AN', 'Netherlands Antilles', 0, 0),
(158, 'NC', 'New Caledonia', 0, 0),
(159, 'NZ', 'New Zealand', 0, 0),
(160, 'NI', 'Nicaragua', 0, 0),
(161, 'NE', 'Niger', 0, 0),
(162, 'NG', 'Nigeria', 0, 0),
(163, 'NU', 'Niue', 0, 0),
(164, 'NF', 'Norfolk Island', 0, 0),
(165, 'MP', 'Northern Mariana Islands', 0, 0),
(166, 'NO', 'Norway', 0, 0),
(167, 'OM', 'Oman', 0, 0),
(168, 'PK', 'Pakistan', 0, 0),
(169, 'PW', 'Palau', 0, 0),
(170, 'PS', 'Palestine', 0, 0),
(171, 'PA', 'Panama', 0, 0),
(172, 'PG', 'Papua New Guinea', 0, 0),
(173, 'PY', 'Paraguay', 0, 0),
(174, 'PE', 'Peru', 0, 0),
(175, 'PH', 'Philippines', 0, 0),
(176, 'PN', 'Pitcairn', 0, 0),
(177, 'PL', 'Poland', 0, 0),
(178, 'PT', 'Portugal', 0, 0),
(179, 'PR', 'Puerto Rico', 0, 0),
(180, 'QA', 'Qatar', 0, 0),
(181, 'RE', 'Reunion', 0, 0),
(182, 'RO', 'Romania', 0, 0),
(183, 'RU', 'Russian Federation', 0, 0),
(184, 'RW', 'Rwanda', 0, 0),
(185, 'KN', 'Saint Kitts and Nevis', 0, 0),
(186, 'LC', 'Saint Lucia', 0, 0),
(187, 'VC', 'Saint Vincent and the Grenadines', 0, 0),
(188, 'WS', 'Samoa', 0, 0),
(189, 'SM', 'San Marino', 0, 0),
(190, 'ST', 'Sao Tome and Principe', 0, 0),
(191, 'SA', 'Saudi Arabia', 0, 0),
(192, 'SN', 'Senegal', 0, 0),
(193, 'RS', 'Serbia', 0, 0),
(194, 'SC', 'Seychelles', 0, 0),
(195, 'SL', 'Sierra Leone', 0, 0),
(196, 'SG', 'Singapore', 0, 0),
(197, 'SK', 'Slovakia', 0, 0),
(198, 'SI', 'Slovenia', 0, 0),
(199, 'SB', 'Solomon Islands', 0, 0),
(200, 'SO', 'Somalia', 0, 0),
(201, 'ZA', 'South Africa', 0, 0),
(202, 'GS', 'South Georgia South Sandwich Islands', 0, 0),
(203, 'SS', 'South Sudan', 0, 0),
(204, 'ES', 'Spain', 0, 0),
(205, 'LK', 'Sri Lanka', 0, 0),
(206, 'SH', 'St. Helena', 0, 0),
(207, 'PM', 'St. Pierre and Miquelon', 0, 0),
(208, 'SD', 'Sudan', 0, 0),
(209, 'SR', 'Suriname', 0, 0),
(210, 'SJ', 'Svalbard and Jan Mayen Islands', 0, 0),
(211, 'SZ', 'Swaziland', 0, 0),
(212, 'SE', 'Sweden', 0, 0),
(213, 'CH', 'Switzerland', 0, 0),
(214, 'SY', 'Syrian Arab Republic', 0, 0),
(215, 'TW', 'Taiwan', 0, 0),
(216, 'TJ', 'Tajikistan', 0, 0),
(217, 'TZ', 'Tanzania, United Republic of', 0, 0),
(218, 'TH', 'Thailand', 0, 0),
(219, 'TG', 'Togo', 0, 0),
(220, 'TK', 'Tokelau', 0, 0),
(221, 'TO', 'Tonga', 0, 0),
(222, 'TT', 'Trinidad and Tobago', 0, 0),
(223, 'TN', 'Tunisia', 0, 0),
(224, 'TR', 'Turkey', 0, 0),
(225, 'TM', 'Turkmenistan', 0, 0),
(226, 'TC', 'Turks and Caicos Islands', 0, 0),
(227, 'TV', 'Tuvalu', 0, 0),
(228, 'UG', 'Uganda', 0, 0),
(229, 'UA', 'Ukraine', 0, 0),
(230, 'AE', 'United Arab Emirates', 0, 0),
(231, 'GB', 'United Kingdom', 0, 1),
(232, 'US', 'United States', 0, 0),
(233, 'UM', 'United States minor outlying islands', 0, 0),
(234, 'UY', 'Uruguay', 0, 0),
(235, 'UZ', 'Uzbekistan', 0, 0),
(236, 'VU', 'Vanuatu', 0, 0),
(237, 'VA', 'Vatican City State', 2, 0),
(238, 'VE', 'Venezuela', 0, 0),
(239, 'VN', 'Vietnam', 0, 0),
(240, 'VG', 'Virgin Islands (British)', 0, 0),
(241, 'VI', 'Virgin Islands (U.S.)', 0, 0),
(242, 'WF', 'Wallis and Futuna Islands', 0, 0),
(243, 'EH', 'Western Sahara', 0, 0),
(244, 'YE', 'Yemen', 0, 0),
(245, 'ZM', 'Zambia', 5, 0),
(246, 'ZW', 'Zimbabwe', 36, 0);

-- --------------------------------------------------------

--
-- Table structure for table `crm_call_logs`
--

CREATE TABLE `crm_call_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `call_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_campaigns`
--

CREATE TABLE `crm_campaigns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campaign_type` enum('sms','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_on` datetime DEFAULT NULL,
  `contact_ids` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_campaigns`
--

INSERT INTO `crm_campaigns` (`id`, `business_id`, `name`, `campaign_type`, `subject`, `email_body`, `sms_body`, `sent_on`, `contact_ids`, `additional_info`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, 'tax payment', 'email', 'khkjhk', '<p>khkjkh</p>', NULL, NULL, '[\"4\"]', '{\"to\":\"lead\",\"trans_activity\":\"has_transactions\",\"in_days\":null}', 9, '2023-03-31 06:17:55', '2023-03-31 06:17:55'),
(2, 5, 'Research', 'email', 'Welcome to OSS', '<p>Testing</p>', NULL, NULL, '[\"1\"]', '{\"to\":\"customer\",\"trans_activity\":\"has_transactions\",\"in_days\":null}', 5, '2023-04-01 10:57:19', '2023-04-01 10:57:19'),
(3, 6, 'Domain and Hosting offer', 'email', 'Domain and Hosting offer', NULL, NULL, NULL, '[\"4\",\"7\",\"8\",\"11\"]', '{\"to\":\"lead\",\"trans_activity\":\"has_transactions\",\"in_days\":null}', 6, '2023-04-02 19:12:34', '2023-04-02 19:12:34'),
(4, 6, 'Domain and hosting offer', 'sms', NULL, NULL, 'hi if you can refer us a company who needs business management software then you will get 40% commission. Please look at your surroundings and just let us know.', '2023-04-02 19:15:04', '[\"4\",\"7\",\"8\",\"11\"]', '{\"to\":\"lead\",\"trans_activity\":\"has_transactions\",\"in_days\":null}', 6, '2023-04-02 19:15:04', '2023-04-02 19:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `crm_followup_invoices`
--

CREATE TABLE `crm_followup_invoices` (
  `follow_up_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_lead_users`
--

CREATE TABLE `crm_lead_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_lead_users`
--

INSERT INTO `crm_lead_users` (`id`, `contact_id`, `user_id`) VALUES
(1, 4, 9),
(2, 5, 9),
(3, 7, 6),
(4, 8, 9),
(5, 11, 6),
(6, 7, 8),
(7, 12, 9),
(8, 11, 7),
(9, 13, 6),
(10, 13, 7),
(11, 28, 5),
(12, 29, 7),
(13, 29, 24),
(14, 31, 6),
(15, 32, 29),
(16, 34, 6),
(17, 37, 6),
(18, 38, 6);

-- --------------------------------------------------------

--
-- Table structure for table `crm_proposals`
--

CREATE TABLE `crm_proposals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_proposals`
--

INSERT INTO `crm_proposals` (`id`, `business_id`, `contact_id`, `subject`, `body`, `sent_by`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 'twst', '<p>stst</p>', 6, '2023-04-24 22:10:33', '2023-04-24 22:10:33'),
(2, 6, 6, 'twst', '<p>would you ---?</p>', 6, '2023-07-18 22:52:40', '2023-07-18 22:52:40'),
(3, 6, 6, 'Love', '<p>Hi there</p>', 6, '2023-07-18 22:54:20', '2023-07-18 22:54:20');

-- --------------------------------------------------------

--
-- Table structure for table `crm_proposal_templates`
--

CREATE TABLE `crm_proposal_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_proposal_templates`
--

INSERT INTO `crm_proposal_templates` (`id`, `business_id`, `subject`, `body`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, 'test', '<p>test</p>', 5, '2023-04-24 21:47:58', '2023-04-24 21:47:58'),
(2, 6, 'twst', '<p>stst</p>', 6, '2023-04-24 21:51:38', '2023-04-24 21:51:38'),
(3, 6, 'hi', '<p>fvv</p>', 6, '2023-04-26 01:41:37', '2023-04-26 01:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `crm_schedules`
--

CREATE TABLE `crm_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_type` enum('call','sms','meeting','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `allow_notification` tinyint(1) NOT NULL DEFAULT 1,
  `notify_via` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notify_before` int(11) DEFAULT NULL,
  `notify_type` enum('minute','hour','day') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hour',
  `created_by` int(11) NOT NULL,
  `is_recursive` tinyint(1) NOT NULL DEFAULT 0,
  `recursion_days` int(11) DEFAULT NULL,
  `followup_additional_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_up_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_up_by_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_schedules`
--

INSERT INTO `crm_schedules` (`id`, `business_id`, `contact_id`, `title`, `status`, `start_datetime`, `end_datetime`, `description`, `schedule_type`, `allow_notification`, `notify_via`, `notify_before`, `notify_type`, `created_by`, `is_recursive`, `recursion_days`, `followup_additional_info`, `follow_up_by`, `follow_up_by_value`, `created_at`, `updated_at`) VALUES
(1, 6, 4, 'Sunday meet up', 'scheduled', '2023-04-02 06:11:00', '2023-04-05 06:11:00', '<p>dhkdjajla</p>', 'call', 1, '{\"sms\":0,\"mail\":1}', 30, 'minute', 9, 0, NULL, NULL, NULL, NULL, '2023-03-31 06:13:28', '2023-03-31 06:13:28'),
(2, 6, 32, 'test followup', 'open', '2023-04-27 22:55:00', '2023-04-27 22:55:00', '<p>yt</p>', 'call', 0, '{\"sms\":0,\"mail\":1}', NULL, 'minute', 29, 0, NULL, NULL, NULL, NULL, '2023-04-27 21:55:06', '2023-04-27 21:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `crm_schedule_logs`
--

CREATE TABLE `crm_schedule_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `log_type` enum('call','sms','meeting','email') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crm_schedule_users`
--

CREATE TABLE `crm_schedule_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `crm_schedule_users`
--

INSERT INTO `crm_schedule_users` (`id`, `schedule_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, NULL, NULL),
(2, 2, 29, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thousand_separator` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimal_separator` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `country`, `currency`, `code`, `symbol`, `thousand_separator`, `decimal_separator`, `created_at`, `updated_at`) VALUES
(1, 'Bangladesh', 'Taka', 'BDT', '৳', ',', '.', NULL, NULL),
(2, 'United Kingdom', 'Pound Sterling', 'GBP', '£', ',', '.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_groups`
--

CREATE TABLE `customer_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(5,2) NOT NULL,
  `price_calculation_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'percentage',
  `selling_price_group_id` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_groups`
--

INSERT INTO `customer_groups` (`id`, `business_id`, `name`, `amount`, `price_calculation_type`, `selling_price_group_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, '10% discount', -10.00, 'percentage', NULL, 6, '2023-04-02 23:30:35', '2023-04-02 23:30:35'),
(2, 6, 'Wholesale Silver', -500.00, 'selling_price_group', 5, 6, '2023-04-02 23:32:12', '2023-04-02 23:46:34'),
(3, 6, '15% discount', -15.00, 'percentage', NULL, 6, '2023-04-02 23:32:38', '2023-04-02 23:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_configurations`
--

CREATE TABLE `dashboard_configurations` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `configuration` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `discount_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `starts_at` datetime DEFAULT NULL,
  `ends_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `spg` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Applicable in specified selling price group only. Use of applicable_in_spg column is discontinued',
  `applicable_in_cg` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount_variations`
--

CREATE TABLE `discount_variations` (
  `discount_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_and_notes`
--

CREATE TABLE `document_and_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `notable_id` int(11) NOT NULL,
  `notable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heading` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_and_notes`
--

INSERT INTO `document_and_notes` (`id`, `business_id`, `notable_id`, `notable_type`, `heading`, `description`, `is_private`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, 4, 'App\\Contact', 'hi', '<p>please have a look at this file</p>', 0, 6, '2023-04-02 19:23:40', '2023-04-02 19:23:40'),
(3, 6, 30, 'App\\User', 'CV', NULL, 0, 6, '2023-04-27 20:42:09', '2023-04-27 20:42:09'),
(4, 6, 5, 'Modules\\Project\\Entities\\Project', 'Bugs follow up', '<p>https://docs.google.com/spreadsheets/d/15_j7uT3ndyLSAN1eCC3j7CLCb8G43ghXJEJ4-EkwuJc/edit#gid=0</p>', 0, 6, '2023-05-24 21:54:24', '2023-05-24 21:54:24'),
(5, 6, 5, 'Modules\\Project\\Entities\\Project', 'Web doc', '<p>Find out web doc for feature details</p>', 0, 6, '2023-05-24 21:58:39', '2023-05-24 21:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_allowances_and_deductions`
--

CREATE TABLE `essentials_allowances_and_deductions` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('allowance','deduction') COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(22,4) NOT NULL,
  `amount_type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci NOT NULL,
  `applicable_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_attendances`
--

CREATE TABLE `essentials_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `clock_in_time` datetime DEFAULT NULL,
  `clock_out_time` datetime DEFAULT NULL,
  `essentials_shift_id` int(11) DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_in_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_out_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_in_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clock_out_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_attendances`
--

INSERT INTO `essentials_attendances` (`id`, `user_id`, `business_id`, `clock_in_time`, `clock_out_time`, `essentials_shift_id`, `ip_address`, `clock_in_note`, `clock_out_note`, `clock_in_location`, `clock_out_location`, `created_at`, `updated_at`) VALUES
(1, 29, 6, '2023-04-27 22:32:40', '2023-04-28 05:42:19', 2, '103.144.201.99', 'Started attending through the system', 'Contact login and lead generation part is completed', 'Gulshan 2, Gulshan, Dhaka, Dhaka Metropolitan, Dhaka District, Dhaka Division, 1213, Bangladesh', 'City Club Grounds, Begum Rokeya Sharani, Mirpur 12, Mirpur 11, Mirpur 12, Dhaka, Dhaka Metropolitan, Dhaka District, Dhaka Division, 1216, Bangladesh', '2023-04-27 21:32:40', '2023-04-28 04:42:19'),
(2, 6, 6, '2023-04-30 17:01:26', '2023-04-30 23:43:18', 2, '2a02:6b6d:857:0:3771:37aa:e0bb:27e', 'Business system model documentation', NULL, 'Wealden House, Talwin Street, Bromley-by-Bow, Bow, London Borough of Tower Hamlets, London, Greater London, England, E3 3EB, United Kingdom', 'Bracken House, Compton Close, Bow Common, Poplar, London Borough of Tower Hamlets, London, Greater London, England, E3 3RS, United Kingdom', '2023-04-30 16:01:26', '2023-04-30 22:43:18'),
(3, 30, 6, '2023-05-02 16:08:12', '2023-05-02 16:30:42', 1, '39.40.53.239', 'home page sections', NULL, 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'I-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-02 15:08:12', '2023-05-02 15:30:42'),
(4, 30, 6, '2023-05-03 09:16:45', '2023-05-03 13:58:11', 1, '39.40.53.239', 'working on the homepage sections', 'search bar after scrolling --done \r\nresponsive last menu bar \r\ncolor changed navbar\r\nactivated popular categories with service_category \r\nfooter designed and responsive\r\nworking on services cards (continue)', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sarwar Road, H-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-03 08:16:45', '2023-05-03 12:58:11'),
(5, 30, 6, '2023-05-03 14:43:29', '2023-05-03 18:18:00', 1, '39.40.53.239', 'setting services cards', 'study card, top deal , buy and sell cards completed', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sarwar Road, H-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-03 13:43:29', '2023-05-03 17:18:00'),
(6, 30, 6, '2023-05-04 07:03:44', '2023-05-04 14:11:13', 1, '39.40.53.239', 'working on the remaining components of the home page', NULL, 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-04 06:03:44', '2023-05-04 13:11:13'),
(7, 30, 6, '2023-05-04 15:00:06', '2023-05-04 16:33:16', 1, '39.40.53.239', 'real-estate and ubs section', 'real-estate and recruitment completed', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-04 14:00:06', '2023-05-04 15:33:16'),
(8, 30, 6, '2023-05-08 04:58:59', '2023-05-08 13:07:34', 1, '39.40.53.239', 'home page', 'updated homepage, added new section removed existing sections', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-08 03:58:59', '2023-05-08 12:07:34'),
(9, 30, 6, '2023-05-09 09:54:52', '2023-05-09 15:10:59', 1, '39.40.53.239', 'contact us page, privcy page , linknig', 'home page updated , privacy page updated working on contact us', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-09 08:54:52', '2023-05-09 14:10:59'),
(10, 30, 6, '2023-05-11 07:23:57', '2023-05-11 12:25:18', 1, '39.40.53.239', 'contact us page', 'privacy activated , contactus selects  activated working on backend', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-11 06:23:57', '2023-05-11 11:25:18'),
(11, 30, 6, '2023-05-11 13:36:51', '2023-05-11 14:14:10', 1, '39.40.53.239', 'contactus backend', NULL, 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-11 12:36:51', '2023-05-11 13:14:10'),
(12, 30, 6, '2023-05-12 12:02:59', '2023-05-12 14:32:09', 1, '39.40.53.239', 'contact us backend', NULL, 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-12 11:02:59', '2023-05-12 13:32:09'),
(13, 30, 6, '2023-05-12 19:03:08', '2023-05-12 20:47:06', 1, '39.40.53.239', NULL, 'contact us completed , terms and condtion checked', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-12 18:03:08', '2023-05-12 19:47:06'),
(14, 30, 6, '2023-05-15 07:58:41', '2023-05-15 13:26:34', 1, '39.40.50.154', 'shop', NULL, 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-15 06:58:41', '2023-05-15 12:26:34'),
(15, 30, 6, '2023-05-16 11:56:17', '2023-05-16 16:40:33', 1, '84.239.49.243', 'checking home pgae css issues', 'updated the responsive issues, checked every thing so far now , udpated the shop page content', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-16 10:56:17', '2023-05-16 15:40:33'),
(16, 30, 6, '2023-05-16 17:13:03', '2023-05-16 17:50:53', 1, '84.239.49.243', 'updatin gshop design as per equested', 'shoping card continue', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-16 16:13:03', '2023-05-16 16:50:53'),
(17, 30, 6, '2023-05-16 19:09:45', '2023-05-16 19:56:50', 1, '84.239.49.243', 'compeleting shop card', 'code updated shop, linking of pages', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-16 18:09:45', '2023-05-16 18:56:50'),
(18, 30, 6, '2023-05-17 06:57:38', '2023-05-17 11:02:21', 1, '84.239.49.210', 'responsiveness issues', 'live responsive issues', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-17 05:57:38', '2023-05-17 10:02:21'),
(19, 30, 6, '2023-05-17 11:17:32', '2023-05-17 11:35:13', 1, '84.239.49.210', 'links issue', NULL, 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-17 10:17:32', '2023-05-17 10:35:13'),
(20, 30, 6, '2023-05-19 08:15:16', '2023-05-19 14:34:44', 1, '84.239.49.244', 'home page issues', 'links have been updated\r\nfew new images were added to the product folder \r\nstar meetup data updated to dynamic \r\nsmall changes on shop detail page', 'Agha Shahi (9th) Avenue, G-9/4, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Agha Shahi (9th) Avenue, G-9/4, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-19 07:15:16', '2023-05-19 13:34:44'),
(21, 30, 6, '2023-05-22 07:49:05', '2023-05-22 14:02:30', 1, '84.239.49.192', 'product issue: a product added is not being displayed in the list', NULL, 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-22 06:49:05', '2023-05-22 13:02:30'),
(22, 30, 6, '2023-05-23 06:58:04', '2023-05-23 12:03:36', 1, '84.239.49.224', 'checking issues on live', 'issues on the home page and service page \r\npdf file', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nawaz Colony, Palm City, Chaklala Cantonment, Rawalpindi District, Punjab, 46222, Pakistan', '2023-05-23 05:58:04', '2023-05-23 11:03:36'),
(23, 30, 6, '2023-05-24 09:18:23', '2023-05-24 14:55:18', 1, '84.239.49.224', NULL, 'updated my code provided by mizamil \r\nadd product with service and product (field for product adn service is added )\r\nsearch field for service is added (removed search for navbar)\r\nadded the sorting for country and cites changed the css\r\nservices and prodcut button on the service archeive page updated', 'Nawaz Colony, Palm City, Chaklala Cantonment, Rawalpindi District, Punjab, 46222, Pakistan', 'Agha Shahi (9th) Avenue, G-9/4, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-24 08:18:23', '2023-05-24 13:55:18'),
(24, 30, 6, '2023-05-25 07:16:30', '2023-05-25 11:35:44', 1, '84.239.49.224', NULL, 'uploading work on git \r\nno further task were performed as there will be conflicts', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-25 06:16:30', '2023-05-25 10:35:44'),
(25, 30, 6, '2023-05-25 11:36:41', '2023-05-25 12:54:05', 1, '84.239.49.224', 'cloing and updating local repository', 'downloaded the new project from git and installed it', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'F.G.School, Gali 87, G-9/4, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-25 10:36:41', '2023-05-25 11:54:05'),
(26, 30, 6, '2023-05-26 07:06:15', '2023-05-26 13:30:20', 1, '84.239.49.249', NULL, 'solved all design issues and contact us page address isues discussied about the structure of the category and services archeive sortings', 'Sattar restuarent T&T Market ISB., Street 28, G-8/4, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', 'Nazir Automobiles, Street 14, G-8, Islamabad, Islamabad Capital Territory, 44000, Pakistan', '2023-05-26 06:06:15', '2023-05-26 12:30:20'),
(27, 6, 6, '2023-06-07 23:42:38', '2023-06-07 23:42:48', 2, '2a02:6b6d:8d6:0:a05e:39d7:7cdf:33c1', NULL, NULL, 'Wealden House, Talwin Street, Bromley-by-Bow, Bow, London Borough of Tower Hamlets, London, Greater London, England, E3 3EB, United Kingdom', 'Wealden House, Talwin Street, Bromley-by-Bow, Bow, London Borough of Tower Hamlets, London, Greater London, England, E3 3EB, United Kingdom', '2023-06-07 22:42:38', '2023-06-07 22:42:48'),
(28, 6, 6, '2023-06-12 12:22:37', '2023-06-15 19:55:39', 2, '92.40.168.145', NULL, NULL, 'Whitechapel High Street, Gunthorpe Street, Spitalfields, Whitechapel, London Borough of Tower Hamlets, London, Greater London, England, E1 7RG, United Kingdom', 'Whitechapel High Street, Gunthorpe Street, Spitalfields, Whitechapel, London Borough of Tower Hamlets, London, Greater London, England, E1 7RG, United Kingdom', '2023-06-12 11:22:37', '2023-06-15 18:55:39'),
(29, 6, 6, '2023-06-16 23:11:27', '2023-06-16 23:18:01', 2, '2a02:6b6d:8d6:0:4c8c:60ba:4f8b:ccd6', NULL, NULL, 'Wealden House, Talwin Street, Bromley-by-Bow, Bow, London Borough of Tower Hamlets, London, Greater London, England, E3 3EB, United Kingdom', 'Wealden House, Talwin Street, Bromley-by-Bow, Bow, London Borough of Tower Hamlets, London, Greater London, England, E3 3EB, United Kingdom', '2023-06-16 22:11:27', '2023-06-16 22:18:01'),
(30, 6, 6, '2023-06-18 16:58:14', '2023-06-19 18:17:55', 2, '2a02:6b6d:8d6:0:d42d:2796:3e95:44d5', NULL, NULL, 'Wealden House, Talwin Street, Bromley-by-Bow, Bow, London Borough of Tower Hamlets, London, Greater London, England, E3 3EB, United Kingdom', 'Newcastle University, Central Motorway East, Haymarket, Newcastle upon Tyne, North of Tyne, England, NE1 7RU, United Kingdom', '2023-06-18 15:58:14', '2023-06-19 17:17:55');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_documents`
--

CREATE TABLE `essentials_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_documents`
--

INSERT INTO `essentials_documents` (`id`, `business_id`, `user_id`, `type`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 'document', '1680935141_mocha-cupcake.jpg', 'test data', '2023-04-08 01:25:42', '2023-04-08 01:25:42'),
(2, 6, 30, 'document', '1682670537_1682634328_593687313_home page.pdf', 'this iscool', '2023-04-28 08:28:57', '2023-04-28 08:28:57');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_document_shares`
--

CREATE TABLE `essentials_document_shares` (
  `id` int(10) UNSIGNED NOT NULL,
  `document_id` int(11) NOT NULL,
  `value_type` enum('user','role') COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_document_shares`
--

INSERT INTO `essentials_document_shares` (`id`, `document_id`, `value_type`, `value`, `created_at`, `updated_at`) VALUES
(1, 2, 'user', 30, '2023-04-28 08:29:44', '2023-04-28 08:29:44'),
(2, 2, 'role', 11, '2023-04-28 08:29:44', '2023-04-28 08:29:44');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_holidays`
--

CREATE TABLE `essentials_holidays` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `business_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_kb`
--

CREATE TABLE `essentials_kb` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kb_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'id from essentials_kb table',
  `share_with` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'public, private, only_with',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_kb_users`
--

CREATE TABLE `essentials_kb_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kb_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_leaves`
--

CREATE TABLE `essentials_leaves` (
  `id` int(10) UNSIGNED NOT NULL,
  `essentials_leave_type_id` int(11) DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `ref_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_leave_types`
--

CREATE TABLE `essentials_leave_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `leave_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_leave_count` int(11) DEFAULT NULL,
  `leave_count_interval` enum('month','year') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_messages`
--

CREATE TABLE `essentials_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_messages`
--

INSERT INTO `essentials_messages` (`id`, `business_id`, `user_id`, `message`, `location_id`, `created_at`, `updated_at`) VALUES
(1, 6, 30, 'this is for tseting', 2, '2023-04-28 08:31:27', '2023-04-28 08:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_payroll_groups`
--

CREATE TABLE `essentials_payroll_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL COMMENT 'payroll for work location',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'due',
  `gross_total` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_payroll_group_transactions`
--

CREATE TABLE `essentials_payroll_group_transactions` (
  `payroll_group_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_reminders`
--

CREATE TABLE `essentials_reminders` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `repeat` enum('one_time','every_day','every_week','every_month') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_shifts`
--

CREATE TABLE `essentials_shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('fixed_shift','flexible_shift') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed_shift',
  `business_id` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `is_allowed_auto_clockout` tinyint(1) NOT NULL DEFAULT 0,
  `auto_clockout_time` time DEFAULT NULL,
  `holidays` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_shifts`
--

INSERT INTO `essentials_shifts` (`id`, `name`, `type`, `business_id`, `start_time`, `end_time`, `is_allowed_auto_clockout`, `auto_clockout_time`, `holidays`, `created_at`, `updated_at`) VALUES
(1, 'Part-time', 'flexible_shift', 6, NULL, NULL, 1, '23:30:00', '[\"sunday\",\"saturday\"]', '2023-04-27 21:31:12', '2023-05-24 21:42:40'),
(2, 'Full time', 'flexible_shift', 6, NULL, NULL, 1, '23:30:00', NULL, '2023-04-27 21:31:39', '2023-04-30 16:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_todos_users`
--

CREATE TABLE `essentials_todos_users` (
  `todo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_todos_users`
--

INSERT INTO `essentials_todos_users` (`todo_id`, `user_id`) VALUES
(1, 7),
(2, 9),
(3, 5),
(4, 24),
(5, 30),
(6, 31),
(7, 6),
(8, 30),
(9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `essentials_todo_comments`
--

CREATE TABLE `essentials_todo_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_todo_comments`
--

INSERT INTO `essentials_todo_comments` (`id`, `comment`, `task_id`, `comment_by`, `created_at`, `updated_at`) VALUES
(3, 'Thanks Huma, I\'ll let you know the feedback. Thanks!', 7, 6, '2023-05-16 23:43:14', '2023-05-16 23:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_to_dos`
--

CREATE TABLE `essentials_to_dos` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `task` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `task_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_hours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_to_dos`
--

INSERT INTO `essentials_to_dos` (`id`, `business_id`, `task`, `date`, `end_date`, `task_id`, `description`, `status`, `estimated_hours`, `priority`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, 'Supplier sourcing', '2023-03-30 02:49:00', '2023-03-31 02:57:00', '2023/0001', '<p>Dear concern,&nbsp;</p>\r\n<p>Please follow the departments to source supplier from BD market. We need at least one supplier for each departments.&nbsp;</p>\r\n<ul class=\"product-categories\">\r\n<li class=\"cat-item cat-parent\"><a id=\"cat\" class=\"category-link\" href=\"https://unipuller.com/service_category/beauty\">Beauty</a></li>\r\n<li class=\"cat-item cat-parent\"><a id=\"cat\" class=\"category-link\" href=\"https://unipuller.com/service_category/hardware\">Hardware</a></li>\r\n<li class=\"cat-item cat-parent\"><a id=\"cat\" class=\"category-link\" href=\"https://unipuller.com/service_category/production\">Production</a></li>\r\n<li class=\"cat-item cat-parent\"><a id=\"cat\" class=\"category-link\" href=\"https://unipuller.com/service_category/export\">Export</a></li>\r\n<li class=\"cat-item cat-parent\"><a id=\"cat\" class=\"category-link\" href=\"https://unipuller.com/service_category/electronics\">Electronics</a></li>\r\n</ul>\r\n<p>Techniques to find out them:</p>\r\n<p>To find out them, use google map. In google map searchbar just write what you want to find. Example: In the searchbar write \"beauty products supplier in dhaka\" ( this will show you all the supplier from dhaka) but to find more supplier, devide city in small area. like, Uttara, badda. Because google map does not show many result at a same time.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Save data:&nbsp;</p>\r\n<p>After collecting data from google map search, you must save them and submit here so that we can upload those data in our databased to find them easily next time. You can watch youtube video on how to collect their data <a href=\"https://www.youtube.com/watch?v=iNy4kfyzK-k\" target=\"_blank\" rel=\"noopener\">here.</a></p>\r\n<p>To collect their data in bulk, you need to use instant-data-scraper in your browser. You can download that extension from <a href=\"https://chrome.google.com/webstore/detail/instant-data-scraper/ofaokhiedipichpaobibbnahnkdoiiah\" target=\"_blank\" rel=\"noopener\">here.&nbsp;</a></p>\r\n<p>Data submission:&nbsp;</p>\r\n<p>After data collection you must submit your data <a href=\"todo\" target=\"_blank\" rel=\"noopener\">here </a>otherwise your attendance will not be completed as it is one of your vital responsibilites. In the header of submission, must write Data sheet (including name of data category).&nbsp;</p>', 'in_progress', NULL, 'urgent', 6, '2023-03-30 02:58:17', '2023-03-30 03:12:21'),
(2, 6, 'Supplier sourcing', '2023-03-30 04:01:00', '2023-04-01 04:21:00', '2023/0002', '<p>Dear concern,&nbsp;</p>\r\n<p>Please follow the departments to source supplier from BD market. We need at least one supplier for each departments.&nbsp;</p>\r\n<ul class=\"product-categories\">\r\n<li class=\"cat-item cat-parent\"><a id=\"cat\" class=\"category-link\" href=\"https://unipuller.com/service_category/fashion-businesses\">Fashion businesses</a></li>\r\n<li class=\"cat-item cat-parent\">Sari supplier</li>\r\n<li class=\"cat-item cat-parent\">Lungi supplier</li>\r\n<li class=\"cat-item cat-parent\">3pc supplier</li>\r\n<li class=\"cat-item cat-parent\">Jeans supplier</li>\r\n<li class=\"cat-item cat-parent\">shirt supplier</li>\r\n<li class=\"cat-item cat-parent\">knit fashion supplier</li>\r\n<li class=\"cat-item cat-parent\">woven fashion supplier</li>\r\n<li class=\"cat-item cat-parent\">Panjabi supplier</li>\r\n<li class=\"cat-item cat-parent\">Borkha Supplier</li>\r\n</ul>\r\n<p>Techniques to find out them:</p>\r\n<p>To find out them, use google map. In google map searchbar just write what you want to find. Example: In the searchbar write \"beauty products supplier in dhaka\" ( this will show you all the supplier from dhaka) but to find more supplier, devide city in small area. like, Uttara, badda. Because google map does not show many result at a same time.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Save data:&nbsp;</p>\r\n<p>After collecting data from google map search, you must save them and submit here so that we can upload those data in our databased to find them easily next time. You can watch youtube video on how to collect their data <a href=\"https://www.youtube.com/watch?v=iNy4kfyzK-k\" target=\"_blank\" rel=\"noopener\">here.</a></p>\r\n<p>To collect their data in bulk, you need to use instant-data-scraper in your browser. You can download that extension from <a href=\"https://chrome.google.com/webstore/detail/instant-data-scraper/ofaokhiedipichpaobibbnahnkdoiiah\" target=\"_blank\" rel=\"noopener\">here.&nbsp;</a></p>\r\n<p>Data submission:&nbsp;</p>\r\n<p>After data collection you must submit your data <a href=\"todo\" target=\"_blank\" rel=\"noopener\">here </a>otherwise your attendance will not be completed as it is one of your vital responsibilites. In the header of submission, must write Data sheet (including name of data category).&nbsp;</p>', 'in_progress', NULL, 'urgent', 6, '2023-03-30 04:21:44', '2023-03-30 04:21:44'),
(3, 5, 'this is test task', '2023-04-08 07:31:00', NULL, '2023/0001', '<p>loream ipsum text</p>', 'on_hold', '15', 'high', 5, '2023-04-08 01:32:28', '2023-04-08 01:32:28'),
(4, 6, 'Supplier sourcing', '2023-04-15 17:04:00', '2023-04-20 17:04:00', '2023/0003', '<p>jk</p>', 'completed', NULL, 'urgent', 6, '2023-04-14 16:04:56', '2023-04-14 16:04:56'),
(5, 6, 'HomePage Design', '2023-04-27 23:20:00', '2023-04-28 23:22:00', '2023/0004', '<p>Design the Unipuller homepage as the pdf provided below.</p>\r\n<p>If you have any queries or want to have a meeting regarding the provided task to you please mail me at <a href=\"mailto:nayan@unipuller\">nayan@unipuller.com&nbsp;&nbsp;</a></p>\r\n<p>And please check your mail regularly</p>\r\n<p>&nbsp;</p>', 'new', NULL, 'high', 29, '2023-04-27 22:25:25', '2023-04-27 22:25:25'),
(6, 6, 'Design News Module and Company Header Module', '2023-04-27 23:25:00', '2023-04-28 23:26:00', '2023/0005', '<p>Attend meeting at sharp 9.30 in your local time in this link i will explain you the task briefly</p>\r\n<p>&nbsp;</p>\r\n<p><a href=\"https://meet.google.com/zmw-yzrg-swt\">https://meet.google.com/zmw-yzrg-swt</a><br /><br />in case i am not responsing in the link please call me in whatsapp in +8801980265838</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>', 'new', NULL, 'high', 29, '2023-04-27 22:31:50', '2023-04-27 22:31:50'),
(7, 6, 'check the homepage design', '2023-04-28 09:22:00', '2023-05-01 09:23:00', '2023/0006', NULL, 'completed', NULL, 'medium', 30, '2023-04-28 08:24:34', '2023-04-28 08:24:34'),
(8, 6, 'Daily work', '2023-05-17 00:43:00', NULL, '2023/0007', '<p>Hello,</p>\r\n<p>Please follow the link to see your daily tasks.</p>\r\n<p>Thanks</p>\r\n<table style=\"border-collapse: collapse; width: 112.909%;\" border=\"1\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 8.89625%; text-align: center;\">Serial</td>\r\n<td style=\"width: 10.6071%; text-align: center;\">Title</td>\r\n<td style=\"width: 18.819%; text-align: center;\">Description</td>\r\n<td style=\"width: 48.4162%; text-align: center;\">Links</td>\r\n<td style=\"width: 13.3444%; text-align: center;\">Platform</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 8.89625%;\">1.</td>\r\n<td style=\"width: 10.6071%;\">Single service page design</td>\r\n<td style=\"width: 18.819%;\">Please create a&nbsp; new service from vendor dashboard and show all the fields on the frontend that we have in the backend. In backend title, short description, descriptionm, image, category, types, price and mandatory fields and all others are optional.&nbsp;</td>\r\n<td style=\"width: 48.4162%;\">https://unipuller.com/service/details/1</td>\r\n<td style=\"width: 13.3444%;\">Unipuller</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 8.89625%;\">2.</td>\r\n<td style=\"width: 10.6071%;\">&nbsp;</td>\r\n<td style=\"width: 18.819%;\">all services and products must have delivery location mandatory . like city, country&nbsp;</td>\r\n<td style=\"width: 48.4162%;\">&nbsp;</td>\r\n<td style=\"width: 13.3444%;\">Unipuller</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 8.89625%;\">3</td>\r\n<td style=\"width: 10.6071%;\">all the disput related links need to connect with dupute and new querry services requires to open a ticket</td>\r\n<td style=\"width: 18.819%;\">we have both dispue and ticket options at the backend so please connect them on shop page and all others</td>\r\n<td style=\"width: 48.4162%;\">&nbsp;</td>\r\n<td style=\"width: 13.3444%;\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 8.89625%;\">&nbsp;</td>\r\n<td style=\"width: 10.6071%;\">&nbsp;</td>\r\n<td style=\"width: 18.819%;\">&nbsp;</td>\r\n<td style=\"width: 48.4162%;\">&nbsp;</td>\r\n<td style=\"width: 13.3444%;\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 8.89625%;\">&nbsp;</td>\r\n<td style=\"width: 10.6071%;\">&nbsp;</td>\r\n<td style=\"width: 18.819%;\">&nbsp;</td>\r\n<td style=\"width: 48.4162%;\">&nbsp;</td>\r\n<td style=\"width: 13.3444%;\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"width: 8.89625%;\">&nbsp;</td>\r\n<td style=\"width: 10.6071%;\">&nbsp;</td>\r\n<td style=\"width: 18.819%;\">&nbsp;</td>\r\n<td style=\"width: 48.4162%;\">&nbsp;</td>\r\n<td style=\"width: 13.3444%;\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>', 'new', NULL, 'high', 6, '2023-05-16 23:48:38', '2023-05-17 00:11:06'),
(9, 6, 'Partnership offer follow up list', '2023-06-12 13:00:00', NULL, '2023/0008', '<p>The steps of information that need to follow up in the conversation with partners.</p>\r\n<p>Checklist:&nbsp;</p>\r\n<ol>\r\n<li>I\'m Polash, Sr marketing executive of Unipuller, London. We are working in diferent business areas as sales and marketing partner. We have few clients who are looking for properties. Some of them are lookin for rent and some of them are looking for buy. We\'re helpin our clients in finding their properties and we\'re also working with agencies to find out more landlords. In that case we help our lients by providing properties as rent or sale and collaborating with agencies by investing some certain revenue in their marketing.&nbsp;</li>\r\n</ol>\r\n<p>Example: If you give one room rent to our client, our company will pay your company minimum &pound;50 so that you can invest that money in the market to find more landlords and develop your business.</p>\r\n<ol>\r\n<li>Do you have rooms/flat/house for rent/sell?</li>\r\n<li>What we need? only your requirements- and update</li>\r\n<li>&nbsp;</li>\r\n</ol>\r\n<p>&nbsp;</p>', 'new', NULL, 'high', 6, '2023-06-12 12:13:04', '2023-06-12 12:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `essentials_user_allowance_and_deductions`
--

CREATE TABLE `essentials_user_allowance_and_deductions` (
  `user_id` int(11) NOT NULL,
  `allowance_deduction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_user_sales_targets`
--

CREATE TABLE `essentials_user_sales_targets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `target_start` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `target_end` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `commission_percent` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `essentials_user_shifts`
--

CREATE TABLE `essentials_user_shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `essentials_shift_id` int(11) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `essentials_user_shifts`
--

INSERT INTO `essentials_user_shifts` (`id`, `user_id`, `essentials_shift_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 29, 2, '2023-04-27', '2024-12-31', '2023-04-27 21:32:26', '2023-04-28 17:46:43'),
(2, 30, 1, '2023-04-28', '2024-12-31', '2023-04-27 21:35:07', '2023-04-27 21:35:07'),
(3, 31, 1, '2023-04-28', '2024-12-31', '2023-04-27 21:35:07', '2023-04-27 21:35:07'),
(4, 6, 2, '2023-04-01', '2024-12-31', '2023-04-27 21:35:46', '2023-04-27 21:35:46'),
(5, 7, 2, '2023-04-01', '2024-12-31', '2023-04-27 21:35:46', '2023-04-27 21:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

CREATE TABLE `expense_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_sub_taxes`
--

CREATE TABLE `group_sub_taxes` (
  `group_tax_id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_layouts`
--

CREATE TABLE `invoice_layouts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `header_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no_prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_no_prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_heading_line1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_heading_line2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_heading_line3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_heading_line4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_heading_line5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_heading_not_paid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_heading_paid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotation_heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_off_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_due_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_client_id` tinyint(1) NOT NULL DEFAULT 0,
  `client_id_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_tax_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_time` tinyint(1) NOT NULL DEFAULT 1,
  `show_brand` tinyint(1) NOT NULL DEFAULT 0,
  `show_sku` tinyint(1) NOT NULL DEFAULT 1,
  `show_cat_code` tinyint(1) NOT NULL DEFAULT 1,
  `show_expiry` tinyint(1) NOT NULL DEFAULT 0,
  `show_lot` tinyint(1) NOT NULL DEFAULT 0,
  `show_image` tinyint(1) NOT NULL DEFAULT 0,
  `show_sale_description` tinyint(1) NOT NULL DEFAULT 0,
  `sales_person_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_sales_person` tinyint(1) NOT NULL DEFAULT 0,
  `table_product_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_qty_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_unit_price_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_subtotal_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cat_code_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_logo` tinyint(1) NOT NULL DEFAULT 0,
  `show_business_name` tinyint(1) NOT NULL DEFAULT 0,
  `show_location_name` tinyint(1) NOT NULL DEFAULT 1,
  `show_landmark` tinyint(1) NOT NULL DEFAULT 1,
  `show_city` tinyint(1) NOT NULL DEFAULT 1,
  `show_state` tinyint(1) NOT NULL DEFAULT 1,
  `show_zip_code` tinyint(1) NOT NULL DEFAULT 1,
  `show_country` tinyint(1) NOT NULL DEFAULT 1,
  `show_mobile_number` tinyint(1) NOT NULL DEFAULT 1,
  `show_alternate_number` tinyint(1) NOT NULL DEFAULT 0,
  `show_email` tinyint(1) NOT NULL DEFAULT 0,
  `show_tax_1` tinyint(1) NOT NULL DEFAULT 1,
  `show_tax_2` tinyint(1) NOT NULL DEFAULT 0,
  `show_barcode` tinyint(1) NOT NULL DEFAULT 0,
  `show_payments` tinyint(1) NOT NULL DEFAULT 0,
  `show_customer` tinyint(1) NOT NULL DEFAULT 0,
  `customer_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission_agent_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_commission_agent` tinyint(1) NOT NULL DEFAULT 0,
  `show_reward_point` tinyint(1) NOT NULL DEFAULT 0,
  `highlight_color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `common_settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `business_id` int(10) UNSIGNED NOT NULL,
  `show_letter_head` tinyint(1) NOT NULL DEFAULT 0,
  `letter_head` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_qr_code` tinyint(1) NOT NULL DEFAULT 0,
  `qr_code_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `design` varchar(190) COLLATE utf8mb4_unicode_ci DEFAULT 'classic',
  `cn_heading` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'cn = credit note',
  `cn_no_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cn_amount_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_tax_headings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_previous_bal` tinyint(1) NOT NULL DEFAULT 0,
  `prev_bal_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_return_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_custom_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_custom_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_custom_fields` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_layouts`
--

INSERT INTO `invoice_layouts` (`id`, `name`, `header_text`, `invoice_no_prefix`, `quotation_no_prefix`, `invoice_heading`, `sub_heading_line1`, `sub_heading_line2`, `sub_heading_line3`, `sub_heading_line4`, `sub_heading_line5`, `invoice_heading_not_paid`, `invoice_heading_paid`, `quotation_heading`, `sub_total_label`, `discount_label`, `tax_label`, `total_label`, `round_off_label`, `total_due_label`, `paid_label`, `show_client_id`, `client_id_label`, `client_tax_label`, `date_label`, `date_time_format`, `show_time`, `show_brand`, `show_sku`, `show_cat_code`, `show_expiry`, `show_lot`, `show_image`, `show_sale_description`, `sales_person_label`, `show_sales_person`, `table_product_label`, `table_qty_label`, `table_unit_price_label`, `table_subtotal_label`, `cat_code_label`, `logo`, `show_logo`, `show_business_name`, `show_location_name`, `show_landmark`, `show_city`, `show_state`, `show_zip_code`, `show_country`, `show_mobile_number`, `show_alternate_number`, `show_email`, `show_tax_1`, `show_tax_2`, `show_barcode`, `show_payments`, `show_customer`, `customer_label`, `commission_agent_label`, `show_commission_agent`, `show_reward_point`, `highlight_color`, `footer_text`, `module_info`, `common_settings`, `is_default`, `business_id`, `show_letter_head`, `letter_head`, `show_qr_code`, `qr_code_fields`, `design`, `cn_heading`, `cn_no_label`, `cn_amount_label`, `table_tax_headings`, `show_previous_bal`, `prev_bal_label`, `change_return_label`, `product_custom_fields`, `contact_custom_fields`, `location_custom_fields`, `created_at`, `updated_at`) VALUES
(1, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 1, 5, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(2, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 0, 6, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-03-26 00:30:53', '2023-03-25 19:23:08'),
(3, 'Unipuller-logo', NULL, 'Invoice No.', 'Quotation number', 'Invoice', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Subtotal', 'Discount', 'Tax', 'Total', 'Round Off', 'Due', 'Total paid', 1, NULL, NULL, 'Date', NULL, 1, 1, 1, 0, 1, 1, 1, 1, NULL, 1, 'Product', 'Quantity', 'Unit Price', 'Subtotal', 'HSN', '1683982019_uni logo.png', 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 'Customer', 'Commission Agent', 1, 0, '#000000', '<p>Thanks for your cooperation</p>', '{\"types_of_service\":{\"types_of_service_label\":\"Service type\",\"show_types_of_service\":\"1\"},\"service_staff\":{\"show_service_staff\":\"1\",\"service_staff_label\":\"Service staff\"}}', '{\"proforma_heading\":\"Proforma invoice\",\"sales_order_heading\":\"Sales Order\",\"due_date_label\":\"Due Date\",\"show_due_date\":\"1\",\"total_quantity_label\":\"Total Quantity\",\"item_discount_label\":\"Discount\",\"discounted_unit_price_label\":\"Price after discount\",\"show_warranty_name\":\"1\",\"show_warranty_exp_date\":\"1\",\"total_items_label\":null,\"show_total_in_words\":\"1\",\"num_to_word_format\":\"international\",\"tax_summary_label\":null}', 1, 6, 0, '1679772188_Banner.png', 0, '[\"business_name\",\"address\",\"invoice_no\",\"invoice_datetime\",\"subtotal\",\"total_amount\",\"total_tax\",\"customer_name\",\"invoice_url\"]', 'classic', 'Credit Note', 'Reference No', 'Credit Amount', NULL, 1, NULL, 'Change Return', NULL, NULL, NULL, '2023-03-25 19:23:08', '2023-07-17 18:21:24'),
(4, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 1, 7, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(5, 'Default', NULL, 'Invoice No.', NULL, 'Invoice', NULL, NULL, NULL, NULL, NULL, '', '', NULL, 'Subtotal', 'Discount', 'Tax', 'Total', NULL, 'Total Due', 'Total Paid', 0, NULL, NULL, 'Date', NULL, 1, 0, 1, 1, 0, 0, 0, 0, NULL, 0, 'Product', 'Quantity', 'Unit Price', 'Subtotal', NULL, NULL, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 'Customer', NULL, 0, 0, '#000000', '', NULL, NULL, 1, 8, 0, NULL, 0, NULL, 'classic', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '2023-06-13 01:20:59', '2023-06-13 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_schemes`
--

CREATE TABLE `invoice_schemes` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scheme_type` enum('blank','year') COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_number` int(11) DEFAULT NULL,
  `invoice_count` int(11) NOT NULL DEFAULT 0,
  `total_digits` int(11) DEFAULT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_schemes`
--

INSERT INTO `invoice_schemes` (`id`, `business_id`, `name`, `scheme_type`, `prefix`, `start_number`, `invoice_count`, `total_digits`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 5, 'Default', 'blank', '', 1, 0, 4, 1, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(2, 6, 'Default', 'blank', '', 1, 16, 4, 1, '2023-03-26 00:30:53', '2023-07-18 00:21:47'),
(3, 7, 'Default', 'blank', '', 1, 0, 4, 1, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(4, 8, 'Default', 'blank', '', 1, 0, 4, 1, '2023-06-13 01:20:59', '2023-06-13 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(191) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `language` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `rtl` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `is_default`, `language`, `file`, `name`, `rtl`) VALUES
(1, 1, 'English', '1605519199OsGO7B86.json', '1605519199OsGO7B86', 0),
(2, 0, 'العربية', '1605417339xudF5Fq7.json', '1605417339xudF5Fq7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` int(11) DEFAULT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `woocommerce_media_id` int(11) DEFAULT NULL,
  `model_media_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `business_id`, `file_name`, `description`, `uploaded_by`, `model_type`, `woocommerce_media_id`, `model_media_type`, `model_id`, `created_at`, `updated_at`) VALUES
(1, 6, '1680146505_931031990_Partner Business offers and policy online file.pdf', NULL, 6, 'Modules\\Essentials\\Entities\\ToDo', NULL, NULL, 2, '2023-03-30 04:21:45', '2023-03-30 04:21:45'),
(2, 6, '1680147144_1798246295_Partner Business offers and policy online file.pdf', NULL, 6, 'Modules\\Essentials\\Entities\\ToDo', NULL, NULL, 1, '2023-03-30 04:32:24', '2023-03-30 04:32:24'),
(3, 6, '1680372226_1876708310_logo.png', NULL, 6, 'App\\Variation', NULL, NULL, 1, '2023-04-01 19:03:46', '2023-04-01 19:03:46'),
(4, 6, '1680458041_1114136268_vlcsnap-2022-12-31-15h52m11s389.png', NULL, 7, 'App\\User', NULL, NULL, 7, '2023-04-02 18:54:01', '2023-04-02 18:54:01'),
(5, 6, '1680459770_1115540926_2.png', NULL, 6, 'App\\DocumentAndNote', NULL, NULL, 1, '2023-04-02 19:23:40', '2023-04-02 19:23:40'),
(6, 6, '1680475998_1915836976_61D403A9-43FE-475A-9913-66FE200634E8.jpeg', NULL, 6, 'App\\Variation', NULL, NULL, 2, '2023-04-02 23:53:18', '2023-04-02 23:53:18'),
(8, 5, '1680935552_979179662_mocha-cupcake (1).jpg', NULL, 5, 'Modules\\Essentials\\Entities\\ToDo', NULL, NULL, 3, '2023-04-08 01:32:32', '2023-04-08 01:32:32'),
(9, 6, '1682628119_442587156_Huma_Ismail_Resume-1.pdf', NULL, 6, 'App\\DocumentAndNote', NULL, NULL, 3, '2023-04-27 20:42:09', '2023-04-27 20:42:09'),
(10, 6, '1682634328_593687313_home page.pdf', NULL, 29, 'Modules\\Essentials\\Entities\\ToDo', NULL, NULL, 5, '2023-04-27 22:25:28', '2023-04-27 22:25:28'),
(12, 6, '1684965506_951888328_NEW web.pdf', NULL, 6, 'App\\DocumentAndNote', NULL, NULL, 5, '2023-05-24 21:58:39', '2023-05-24 21:58:39'),
(14, 6, '1689438114_102383473_logo blue.png', NULL, 6, 'App\\Variation', NULL, NULL, 4, '2023-07-15 16:21:54', '2023-07-15 16:21:54'),
(15, 6, '1689438166_1271350580_logo blue.png', NULL, 6, 'App\\Variation', NULL, NULL, 6, '2023-07-15 16:22:46', '2023-07-15 16:22:46'),
(16, 6, '1689438206_620401797_logo blue.png', NULL, 6, 'App\\Variation', NULL, NULL, 5, '2023-07-15 16:23:26', '2023-07-15 16:23:26'),
(17, 6, '1689614119_1645703165_logo bluee.png', NULL, 6, 'App\\Variation', NULL, NULL, 7, '2023-07-17 17:15:19', '2023-07-17 17:15:19');

-- --------------------------------------------------------

--
-- Table structure for table `mfg_ingredient_groups`
--

CREATE TABLE `mfg_ingredient_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mfg_recipes`
--

CREATE TABLE `mfg_recipes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `instructions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `waste_percent` decimal(10,2) NOT NULL DEFAULT 0.00,
  `ingredients_cost` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `extra_cost` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `production_cost_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'percentage',
  `total_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `final_price` decimal(22,4) NOT NULL,
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mfg_recipe_ingredients`
--

CREATE TABLE `mfg_recipe_ingredients` (
  `id` int(10) UNSIGNED NOT NULL,
  `mfg_recipe_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(11) NOT NULL,
  `mfg_ingredient_group_id` int(11) DEFAULT NULL,
  `quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `waste_percent` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `sub_unit_id` int(11) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2017_07_05_071953_create_currencies_table', 1),
(9, '2017_07_05_073658_create_business_table', 1),
(10, '2017_07_22_075923_add_business_id_users_table', 1),
(11, '2017_07_23_113209_create_brands_table', 1),
(12, '2017_07_26_083429_create_permission_tables', 1),
(13, '2017_07_26_110000_create_tax_rates_table', 1),
(14, '2017_07_26_122313_create_units_table', 1),
(15, '2017_07_27_075706_create_contacts_table', 1),
(16, '2017_08_04_071038_create_categories_table', 1),
(17, '2017_08_08_115903_create_products_table', 1),
(18, '2017_08_09_061616_create_variation_templates_table', 1),
(19, '2017_08_09_061638_create_variation_value_templates_table', 1),
(20, '2017_08_10_061146_create_product_variations_table', 1),
(21, '2017_08_10_061216_create_variations_table', 1),
(22, '2017_08_19_054827_create_transactions_table', 1),
(23, '2017_08_31_073533_create_purchase_lines_table', 1),
(24, '2017_10_15_064638_create_transaction_payments_table', 1),
(25, '2017_10_31_065621_add_default_sales_tax_to_business_table', 1),
(26, '2017_11_20_051930_create_table_group_sub_taxes', 1),
(27, '2017_11_20_063603_create_transaction_sell_lines', 1),
(28, '2017_11_21_064540_create_barcodes_table', 1),
(29, '2017_11_23_181237_create_invoice_schemes_table', 1),
(30, '2017_12_25_122822_create_business_locations_table', 1),
(31, '2017_12_25_160253_add_location_id_to_transactions_table', 1),
(32, '2017_12_25_163227_create_variation_location_details_table', 1),
(33, '2018_01_04_115627_create_sessions_table', 1),
(34, '2018_01_05_112817_create_invoice_layouts_table', 1),
(35, '2018_01_06_112303_add_invoice_scheme_id_and_invoice_layout_id_to_business_locations', 1),
(36, '2018_01_08_104124_create_expense_categories_table', 1),
(37, '2018_01_08_123327_modify_transactions_table_for_expenses', 1),
(38, '2018_01_09_111005_modify_payment_status_in_transactions_table', 1),
(39, '2018_01_09_111109_add_paid_on_column_to_transaction_payments_table', 1),
(40, '2018_01_25_172439_add_printer_related_fields_to_business_locations_table', 1),
(41, '2018_01_27_184322_create_printers_table', 1),
(42, '2018_01_30_181442_create_cash_registers_table', 1),
(43, '2018_01_31_125836_create_cash_register_transactions_table', 1),
(44, '2018_02_07_173326_modify_business_table', 1),
(45, '2018_02_08_105425_add_enable_product_expiry_column_to_business_table', 1),
(46, '2018_02_08_111027_add_expiry_period_and_expiry_period_type_columns_to_products_table', 1),
(47, '2018_02_08_131118_add_mfg_date_and_exp_date_purchase_lines_table', 1),
(48, '2018_02_08_155348_add_exchange_rate_to_transactions_table', 1),
(49, '2018_02_09_124945_modify_transaction_payments_table_for_contact_payments', 1),
(50, '2018_02_12_113640_create_transaction_sell_lines_purchase_lines_table', 1),
(51, '2018_02_12_114605_add_quantity_sold_in_purchase_lines_table', 1),
(52, '2018_02_13_183323_alter_decimal_fields_size', 1),
(53, '2018_02_14_161928_add_transaction_edit_days_to_business_table', 1),
(54, '2018_02_15_161032_add_document_column_to_transactions_table', 1),
(55, '2018_02_17_124709_add_more_options_to_invoice_layouts', 1),
(56, '2018_02_19_111517_add_keyboard_shortcut_column_to_business_table', 1),
(57, '2018_02_19_121537_stock_adjustment_move_to_transaction_table', 1),
(58, '2018_02_20_165505_add_is_direct_sale_column_to_transactions_table', 1),
(59, '2018_02_21_105329_create_system_table', 1),
(60, '2018_02_23_100549_version_1_2', 1),
(61, '2018_02_23_125648_add_enable_editing_sp_from_purchase_column_to_business_table', 1),
(62, '2018_02_26_103612_add_sales_commission_agent_column_to_business_table', 1),
(63, '2018_02_26_130519_modify_users_table_for_sales_cmmsn_agnt', 1),
(64, '2018_02_26_134500_add_commission_agent_to_transactions_table', 1),
(65, '2018_02_27_121422_add_item_addition_method_to_business_table', 1),
(66, '2018_02_27_170232_modify_transactions_table_for_stock_transfer', 1),
(67, '2018_03_05_153510_add_enable_inline_tax_column_to_business_table', 1),
(68, '2018_03_06_210206_modify_product_barcode_types', 1),
(69, '2018_03_13_181541_add_expiry_type_to_business_table', 1),
(70, '2018_03_16_113446_product_expiry_setting_for_business', 1),
(71, '2018_03_19_113601_add_business_settings_options', 1),
(72, '2018_03_26_125334_add_pos_settings_to_business_table', 1),
(73, '2018_03_26_165350_create_customer_groups_table', 1),
(74, '2018_03_27_122720_customer_group_related_changes_in_tables', 1),
(75, '2018_03_29_110138_change_tax_field_to_nullable_in_business_table', 1),
(76, '2018_03_29_115502_add_changes_for_sr_number_in_products_and_sale_lines_table', 1),
(77, '2018_03_29_134340_add_inline_discount_fields_in_purchase_lines', 1),
(78, '2018_03_31_140921_update_transactions_table_exchange_rate', 1),
(79, '2018_04_03_103037_add_contact_id_to_contacts_table', 1),
(80, '2018_04_03_122709_add_changes_to_invoice_layouts_table', 1),
(81, '2018_04_09_135320_change_exchage_rate_size_in_business_table', 1),
(82, '2018_04_17_123122_add_lot_number_to_business', 1),
(83, '2018_04_17_160845_add_product_racks_table', 1),
(84, '2018_04_20_182015_create_res_tables_table', 1),
(85, '2018_04_24_105246_restaurant_fields_in_transaction_table', 1),
(86, '2018_04_24_114149_add_enabled_modules_business_table', 1),
(87, '2018_04_24_133704_add_modules_fields_in_invoice_layout_table', 1),
(88, '2018_04_27_132653_quotation_related_change', 1),
(89, '2018_05_02_104439_add_date_format_and_time_format_to_business', 1),
(90, '2018_05_02_111939_add_sell_return_to_transaction_payments', 1),
(91, '2018_05_14_114027_add_rows_positions_for_products', 1),
(92, '2018_05_14_125223_add_weight_to_products_table', 1),
(93, '2018_05_14_164754_add_opening_stock_permission', 1),
(94, '2018_05_15_134729_add_design_to_invoice_layouts', 1),
(95, '2018_05_16_183307_add_tax_fields_invoice_layout', 1),
(96, '2018_05_18_191956_add_sell_return_to_transaction_table', 1),
(97, '2018_05_21_131349_add_custom_fileds_to_contacts_table', 1),
(98, '2018_05_21_131607_invoice_layout_fields_for_sell_return', 1),
(99, '2018_05_21_131949_add_custom_fileds_and_website_to_business_locations_table', 1),
(100, '2018_05_22_123527_create_reference_counts_table', 1),
(101, '2018_05_22_154540_add_ref_no_prefixes_column_to_business_table', 1),
(102, '2018_05_24_132620_add_ref_no_column_to_transaction_payments_table', 1),
(103, '2018_05_24_161026_add_location_id_column_to_business_location_table', 1),
(104, '2018_05_25_180603_create_modifiers_related_table', 1),
(105, '2018_05_29_121714_add_purchase_line_id_to_stock_adjustment_line_table', 1),
(106, '2018_05_31_114645_add_res_order_status_column_to_transactions_table', 1),
(107, '2018_06_05_103530_rename_purchase_line_id_in_stock_adjustment_lines_table', 1),
(108, '2018_06_05_111905_modify_products_table_for_modifiers', 1),
(109, '2018_06_06_110524_add_parent_sell_line_id_column_to_transaction_sell_lines_table', 1),
(110, '2018_06_07_152443_add_is_service_staff_to_roles_table', 1),
(111, '2018_06_07_182258_add_image_field_to_products_table', 1),
(112, '2018_06_13_133705_create_bookings_table', 1),
(113, '2018_06_15_173636_add_email_column_to_contacts_table', 1),
(114, '2018_06_27_182835_add_superadmin_related_fields_business', 1),
(115, '2018_07_10_101913_add_custom_fields_to_products_table', 1),
(116, '2018_07_17_103434_add_sales_person_name_label_to_invoice_layouts_table', 1),
(117, '2018_07_17_163920_add_theme_skin_color_column_to_business_table', 1),
(118, '2018_07_24_160319_add_lot_no_line_id_to_transaction_sell_lines_table', 1),
(119, '2018_07_25_110004_add_show_expiry_and_show_lot_colums_to_invoice_layouts_table', 1),
(120, '2018_07_25_172004_add_discount_columns_to_transaction_sell_lines_table', 1),
(121, '2018_07_26_124720_change_design_column_type_in_invoice_layouts_table', 1),
(122, '2018_07_26_170424_add_unit_price_before_discount_column_to_transaction_sell_line_table', 1),
(123, '2018_07_28_103614_add_credit_limit_column_to_contacts_table', 1),
(124, '2018_08_08_110755_add_new_payment_methods_to_transaction_payments_table', 1),
(125, '2018_08_08_122225_modify_cash_register_transactions_table_for_new_payment_methods', 1),
(126, '2018_08_14_104036_add_opening_balance_type_to_transactions_table', 1),
(127, '2018_09_04_155900_create_accounts_table', 1),
(128, '2018_09_06_114438_create_selling_price_groups_table', 1),
(129, '2018_09_06_154057_create_variation_group_prices_table', 1),
(130, '2018_09_07_102413_add_permission_to_access_default_selling_price', 1),
(131, '2018_09_07_134858_add_selling_price_group_id_to_transactions_table', 1),
(132, '2018_09_10_112448_update_product_type_to_single_if_null_in_products_table', 1),
(133, '2018_09_10_152703_create_account_transactions_table', 1),
(134, '2018_09_10_173656_add_account_id_column_to_transaction_payments_table', 1),
(135, '2018_09_19_123914_create_notification_templates_table', 1),
(136, '2018_09_22_110504_add_sms_and_email_settings_columns_to_business_table', 1),
(137, '2018_09_24_134942_add_lot_no_line_id_to_stock_adjustment_lines_table', 1),
(138, '2018_09_26_105557_add_transaction_payments_for_existing_expenses', 1),
(139, '2018_09_27_111609_modify_transactions_table_for_purchase_return', 1),
(140, '2018_09_27_131154_add_quantity_returned_column_to_purchase_lines_table', 1),
(141, '2018_10_02_131401_add_return_quantity_column_to_transaction_sell_lines_table', 1),
(142, '2018_10_03_104918_add_qty_returned_column_to_transaction_sell_lines_purchase_lines_table', 1),
(143, '2018_10_03_185947_add_default_notification_templates_to_database', 1),
(144, '2018_10_09_153105_add_business_id_to_transaction_payments_table', 1),
(145, '2018_10_16_135229_create_permission_for_sells_and_purchase', 1),
(146, '2018_10_22_114441_add_columns_for_variable_product_modifications', 1),
(147, '2018_10_22_134428_modify_variable_product_data', 1),
(148, '2018_10_30_181558_add_table_tax_headings_to_invoice_layout', 1),
(149, '2018_10_31_122619_add_pay_terms_field_transactions_table', 1),
(150, '2018_10_31_161328_add_new_permissions_for_pos_screen', 1),
(151, '2018_10_31_174752_add_access_selected_contacts_only_to_users_table', 1),
(152, '2018_10_31_175627_add_user_contact_access', 1),
(153, '2018_10_31_180559_add_auto_send_sms_column_to_notification_templates_table', 1),
(154, '2018_11_02_171949_change_card_type_column_to_varchar_in_transaction_payments_table', 1),
(155, '2018_11_08_105621_add_role_permissions', 1),
(156, '2018_11_26_114135_add_is_suspend_column_to_transactions_table', 1),
(157, '2018_11_28_104410_modify_units_table_for_multi_unit', 1),
(158, '2018_11_28_170952_add_sub_unit_id_to_purchase_lines_and_sell_lines', 1),
(159, '2018_11_29_115918_add_primary_key_in_system_table', 1),
(160, '2018_12_03_185546_add_product_description_column_to_products_table', 1),
(161, '2018_12_06_114937_modify_system_table_and_users_table', 1),
(162, '2018_12_13_160007_add_custom_fields_display_options_to_invoice_layouts_table', 1),
(163, '2018_12_14_103307_modify_system_table', 1),
(164, '2018_12_18_133837_add_prev_balance_due_columns_to_invoice_layouts_table', 1),
(165, '2018_12_18_170656_add_invoice_token_column_to_transaction_table', 1),
(166, '2018_12_20_133639_add_date_time_format_column_to_invoice_layouts_table', 1),
(167, '2018_12_21_120659_add_recurring_invoice_fields_to_transactions_table', 1),
(168, '2018_12_24_154933_create_notifications_table', 1),
(169, '2019_01_08_112015_add_document_column_to_transaction_payments_table', 1),
(170, '2019_01_10_124645_add_account_permission', 1),
(171, '2019_01_16_125825_add_subscription_no_column_to_transactions_table', 1),
(172, '2019_01_28_111647_add_order_addresses_column_to_transactions_table', 1),
(173, '2019_02_13_173821_add_is_inactive_column_to_products_table', 1),
(174, '2019_02_19_103118_create_discounts_table', 1),
(175, '2019_02_21_120324_add_discount_id_column_to_transaction_sell_lines_table', 1),
(176, '2019_02_21_134324_add_permission_for_discount', 1),
(177, '2019_03_04_170832_add_service_staff_columns_to_transaction_sell_lines_table', 1),
(178, '2019_03_09_102425_add_sub_type_column_to_transactions_table', 1),
(179, '2019_03_09_124457_add_indexing_transaction_sell_lines_purchase_lines_table', 1),
(180, '2019_03_12_120336_create_activity_log_table', 1),
(181, '2019_03_15_132925_create_media_table', 1),
(182, '2019_05_08_130339_add_indexing_to_parent_id_in_transaction_payments_table', 1),
(183, '2019_05_10_132311_add_missing_column_indexing', 1),
(184, '2019_05_14_091812_add_show_image_column_to_invoice_layouts_table', 1),
(185, '2019_05_25_104922_add_view_purchase_price_permission', 1),
(186, '2019_06_17_103515_add_profile_informations_columns_to_users_table', 1),
(187, '2019_06_18_135524_add_permission_to_view_own_sales_only', 1),
(188, '2019_06_19_112058_add_database_changes_for_reward_points', 1),
(189, '2019_06_28_133732_change_type_column_to_string_in_transactions_table', 1),
(190, '2019_07_13_111420_add_is_created_from_api_column_to_transactions_table', 1),
(191, '2019_07_15_165136_add_fields_for_combo_product', 1),
(192, '2019_07_19_103446_add_mfg_quantity_used_column_to_purchase_lines_table', 1),
(193, '2019_07_22_152649_add_not_for_selling_in_product_table', 1),
(194, '2019_07_29_185351_add_show_reward_point_column_to_invoice_layouts_table', 1),
(195, '2019_08_08_162302_add_sub_units_related_fields', 1),
(196, '2019_08_26_133419_update_price_fields_decimal_point', 1),
(197, '2019_09_02_160054_remove_location_permissions_from_roles', 1),
(198, '2019_09_03_185259_add_permission_for_pos_screen', 1),
(199, '2019_09_04_163141_add_location_id_to_cash_registers_table', 1),
(200, '2019_09_04_184008_create_types_of_services_table', 1),
(201, '2019_09_06_131445_add_types_of_service_fields_to_transactions_table', 1),
(202, '2019_09_09_134810_add_default_selling_price_group_id_column_to_business_locations_table', 1),
(203, '2019_09_12_105616_create_product_locations_table', 1),
(204, '2019_09_17_122522_add_custom_labels_column_to_business_table', 1),
(205, '2019_09_18_164319_add_shipping_fields_to_transactions_table', 1),
(206, '2019_09_19_170927_close_all_active_registers', 1),
(207, '2019_09_23_161906_add_media_description_cloumn_to_media_table', 1),
(208, '2019_10_18_155633_create_account_types_table', 1),
(209, '2019_10_22_163335_add_common_settings_column_to_business_table', 1),
(210, '2019_10_29_132521_add_update_purchase_status_permission', 1),
(211, '2019_11_09_110522_add_indexing_to_lot_number', 1),
(212, '2019_11_19_170824_add_is_active_column_to_business_locations_table', 1),
(213, '2019_11_21_162913_change_quantity_field_types_to_decimal', 1),
(214, '2019_11_25_160340_modify_categories_table_for_polymerphic_relationship', 1),
(215, '2019_12_02_105025_create_warranties_table', 1),
(216, '2019_12_03_180342_add_common_settings_field_to_invoice_layouts_table', 1),
(217, '2019_12_05_183955_add_more_fields_to_users_table', 1),
(218, '2019_12_06_174904_add_change_return_label_column_to_invoice_layouts_table', 1),
(219, '2019_12_11_121307_add_draft_and_quotation_list_permissions', 1),
(220, '2019_12_12_180126_copy_expense_total_to_total_before_tax', 1),
(221, '2019_12_19_181412_make_alert_quantity_field_nullable_on_products_table', 1),
(222, '2019_12_25_173413_create_dashboard_configurations_table', 1),
(223, '2020_01_08_133506_create_document_and_notes_table', 1),
(224, '2020_01_09_113252_add_cc_bcc_column_to_notification_templates_table', 1),
(225, '2020_01_16_174818_add_round_off_amount_field_to_transactions_table', 1),
(226, '2020_01_28_162345_add_weighing_scale_settings_in_business_settings_table', 1),
(227, '2020_02_18_172447_add_import_fields_to_transactions_table', 1),
(228, '2020_03_13_135844_add_is_active_column_to_selling_price_groups_table', 1),
(229, '2020_03_16_115449_add_contact_status_field_to_contacts_table', 1),
(230, '2020_03_26_124736_add_allow_login_column_in_users_table', 1),
(231, '2020_04_13_154150_add_feature_products_column_to_business_loactions', 1),
(232, '2020_04_15_151802_add_user_type_to_users_table', 1),
(233, '2020_04_22_153905_add_subscription_repeat_on_column_to_transactions_table', 1),
(234, '2020_04_28_111436_add_shipping_address_to_contacts_table', 1),
(235, '2020_06_01_094654_add_max_sale_discount_column_to_users_table', 1),
(236, '2020_06_12_162245_modify_contacts_table', 1),
(237, '2020_06_22_103104_change_recur_interval_default_to_one', 1),
(238, '2020_07_09_174621_add_balance_field_to_contacts_table', 1),
(239, '2020_07_23_104933_change_status_column_to_varchar_in_transaction_table', 1),
(240, '2020_09_07_171059_change_completed_stock_transfer_status_to_final', 1),
(241, '2020_09_21_123224_modify_booking_status_column_in_bookings_table', 1),
(242, '2020_09_22_121639_create_discount_variations_table', 1),
(243, '2020_10_05_121550_modify_business_location_table_for_invoice_layout', 1),
(244, '2020_10_16_175726_set_status_as_received_for_opening_stock', 1),
(245, '2020_10_23_170823_add_for_group_tax_column_to_tax_rates_table', 1),
(246, '2020_11_04_130940_add_more_custom_fields_to_contacts_table', 1),
(247, '2020_11_10_152841_add_cash_register_permissions', 1),
(248, '2020_11_17_164041_modify_type_column_to_varchar_in_contacts_table', 1),
(249, '2020_12_18_181447_add_shipping_custom_fields_to_transactions_table', 1),
(250, '2020_12_22_164303_add_sub_status_column_to_transactions_table', 1),
(251, '2020_12_24_153050_add_custom_fields_to_transactions_table', 1),
(252, '2020_12_28_105403_add_whatsapp_text_column_to_notification_templates_table', 1),
(253, '2020_12_29_165925_add_model_document_type_to_media_table', 1),
(254, '2021_02_08_175632_add_contact_number_fields_to_users_table', 1),
(255, '2021_02_11_172217_add_indexing_for_multiple_columns', 1),
(256, '2021_02_23_122043_add_more_columns_to_customer_groups_table', 1),
(257, '2021_02_24_175551_add_print_invoice_permission_to_all_roles', 1),
(258, '2021_03_03_162021_add_purchase_order_columns_to_purchase_lines_and_transactions_table', 1),
(259, '2021_03_11_120229_add_sales_order_columns', 1),
(260, '2021_03_16_120705_add_business_id_to_activity_log_table', 1),
(261, '2021_03_16_153427_add_code_columns_to_business_table', 1),
(262, '2021_03_18_173308_add_account_details_column_to_accounts_table', 1),
(263, '2021_03_18_183119_add_prefer_payment_account_columns_to_transactions_table', 1),
(264, '2021_03_22_120810_add_more_types_of_service_custom_fields', 1),
(265, '2021_03_24_183132_add_shipping_export_custom_field_details_to_contacts_table', 1),
(266, '2021_03_25_170715_add_export_custom_fields_info_to_transactions_table', 1),
(267, '2021_04_15_063449_add_denominations_column_to_cash_registers_table', 1),
(268, '2021_05_22_083426_add_indexing_to_account_transactions_table', 1),
(269, '2021_07_08_065808_add_additional_expense_columns_to_transaction_table', 1),
(270, '2021_07_13_082918_add_qr_code_columns_to_invoice_layouts_table', 1),
(271, '2021_07_21_061615_add_fields_to_show_commission_agent_in_invoice_layout', 1),
(272, '2021_08_13_105549_add_crm_contact_id_to_users_table', 1),
(273, '2021_08_25_114932_add_payment_link_fields_to_transaction_payments_table', 1),
(274, '2021_09_01_063110_add_spg_column_to_discounts_table', 1),
(275, '2021_09_03_061528_modify_cash_register_transactions_table', 1),
(276, '2021_10_05_061658_add_source_column_to_transactions_table', 1),
(277, '2021_12_16_121851_add_parent_id_column_to_expense_categories_table', 1),
(278, '2022_04_14_075120_add_payment_type_column_to_transaction_payments_table', 1),
(279, '2022_04_21_083327_create_cash_denominations_table', 1),
(280, '2022_05_10_055307_add_delivery_date_column_to_transactions_table', 1),
(281, '2022_06_13_123135_add_currency_precision_and_quantity_precision_fields_to_business_table', 1),
(282, '2022_06_28_133342_add_secondary_unit_columns_to_products_sell_line_purchase_lines_tables', 1),
(283, '2022_07_13_114307_create_purchase_requisition_related_columns', 1),
(284, '2022_08_25_132707_add_service_staff_timer_fields_to_products_and_users_table', 1),
(285, '2023_01_28_114255_add_letter_head_column_to_invoice_layouts_table', 1),
(286, '2023_02_11_161510_add_event_column_to_activity_log_table', 1),
(287, '2023_02_11_161511_add_batch_uuid_column_to_activity_log_table', 1),
(288, '2023_03_02_170312_add_provider_to_oauth_clients_table', 1),
(289, '2018_06_27_185405_create_packages_table', 2),
(290, '2018_06_28_182803_create_subscriptions_table', 2),
(291, '2018_07_17_182021_add_rows_to_system_table', 2),
(292, '2018_07_19_131721_add_options_to_packages_table', 2),
(293, '2018_08_17_155534_add_min_termination_alert_days', 2),
(294, '2018_08_28_105945_add_business_based_username_settings_to_system_table', 2),
(295, '2018_08_30_105906_add_superadmin_communicator_logs_table', 2),
(296, '2018_11_02_130636_add_custom_permissions_to_packages_table', 2),
(297, '2018_11_05_161848_add_more_fields_to_packages_table', 2),
(298, '2018_12_10_124621_modify_system_table_values_null_default', 2),
(299, '2019_05_10_135434_add_missing_database_column_indexes', 2),
(300, '2019_08_16_115300_create_superadmin_frontend_pages_table', 2),
(301, '2018_10_01_151252_create_documents_table', 3),
(302, '2018_10_02_151803_create_document_shares_table', 3),
(303, '2018_10_09_134558_create_reminders_table', 3),
(304, '2018_11_16_170756_create_to_dos_table', 3),
(305, '2019_02_22_120329_essentials_messages', 3),
(306, '2019_02_22_161513_add_message_permissions', 3),
(307, '2019_03_29_164339_add_essentials_version_to_system_table', 3),
(308, '2019_05_17_153306_create_essentials_leave_types_table', 3),
(309, '2019_05_17_175921_create_essentials_leaves_table', 3),
(310, '2019_05_21_154517_add_essentials_settings_columns_to_business_table', 3),
(311, '2019_05_21_181653_create_table_essentials_attendance', 3),
(312, '2019_05_30_110049_create_essentials_payrolls_table', 3),
(313, '2019_06_04_105723_create_essentials_holidays_table', 3),
(314, '2019_06_28_134217_add_payroll_columns_to_transactions_table', 3),
(315, '2019_08_26_103520_add_approve_leave_permission', 3),
(316, '2019_08_27_103724_create_essentials_allowance_and_deduction_table', 3),
(317, '2019_08_27_105236_create_essentials_user_allowances_and_deductions', 3),
(318, '2019_09_20_115906_add_more_columns_to_essentials_to_dos_table', 3),
(319, '2019_09_23_120439_create_essentials_todo_comments_table', 3),
(320, '2019_12_05_170724_add_hrm_columns_to_users_table', 3),
(321, '2019_12_09_105809_add_allowance_and_deductions_permission', 3),
(322, '2020_03_28_152838_create_essentials_shift_table', 3),
(323, '2020_03_30_162029_create_user_shifts_table', 3),
(324, '2020_03_31_134558_add_shift_id_to_attendance_table', 3),
(325, '2020_11_05_105157_modify_todos_date_column_type', 3),
(326, '2020_11_11_174852_add_end_time_column_to_essentials_reminders_table', 3),
(327, '2020_11_26_170527_create_essentials_kb_table', 3),
(328, '2020_11_30_112615_create_essentials_kb_users_table', 3),
(329, '2021_02_12_185514_add_clock_in_location_to_essentials_attendances_table', 3),
(330, '2021_02_16_190203_add_essentials_module_indexing', 3),
(331, '2021_02_27_133448_add_columns_to_users_table', 3),
(332, '2021_03_04_174857_create_payroll_groups_table', 3),
(333, '2021_03_04_175025_create_payroll_group_transactions_table', 3),
(334, '2021_03_09_123914_add_auto_clockout_to_essentials_shifts', 3),
(335, '2021_06_17_121451_add_location_id_to_table', 3),
(336, '2021_09_28_091541_create_essentials_user_sales_targets_table', 3),
(337, '2018_10_10_110400_add_module_version_to_system_table', 4),
(338, '2018_10_10_122845_add_woocommerce_api_settings_to_business_table', 4),
(339, '2018_10_10_162041_add_woocommerce_category_id_to_categories_table', 4),
(340, '2018_10_11_173839_create_woocommerce_sync_logs_table', 4),
(341, '2018_10_16_123522_add_woocommerce_tax_rate_id_column_to_tax_rates_table', 4),
(342, '2018_10_23_111555_add_woocommerce_attr_id_column_to_variation_templates_table', 4),
(343, '2018_12_03_163945_add_woocommerce_permissions', 4),
(344, '2019_02_18_154414_change_woocommerce_sync_logs_table', 4),
(345, '2019_04_19_174129_add_disable_woocommerce_sync_column_to_products_table', 4),
(346, '2019_06_08_132440_add_woocommerce_wh_oc_secret_column_to_business_table', 4),
(347, '2019_10_01_171828_add_woocommerce_media_id_columns', 4),
(348, '2020_09_07_124952_add_woocommerce_skipped_orders_fields_to_business_table', 4),
(349, '2021_02_16_190608_add_woocommerce_module_indexing', 4),
(350, '2020_03_19_130231_add_contact_id_to_users_table', 5),
(351, '2020_03_27_133605_create_schedules_table', 5),
(352, '2020_03_27_133628_create_schedule_users_table', 5),
(353, '2020_03_30_112834_create_schedule_logs_table', 5),
(354, '2020_04_02_182331_add_crm_module_version_to_system_table', 5),
(355, '2020_04_08_153231_modify_cloumn_in_contacts_table', 5),
(356, '2020_04_09_101052_create_lead_users_table', 5),
(357, '2020_04_16_114747_create_crm_campaigns_table', 5),
(358, '2021_01_07_155757_add_followup_additional_info_column_to_crm_schedules_table', 5),
(359, '2021_02_02_140021_add_additional_info_to_crm_campaigns_table', 5),
(360, '2021_02_02_173651_add_new_columns_to_contacts_table', 5),
(361, '2021_02_04_120439_create_call_logs_table', 5),
(362, '2021_02_08_172047_add_mobile_name_column_to_crm_call_logs_table', 5),
(363, '2021_02_16_190038_add_crm_module_indexing', 5),
(364, '2021_02_19_120846_create_crm_followup_invoices', 5),
(365, '2021_02_22_132125_add_follow_up_by_to_crm_schedules_table', 5),
(366, '2021_03_24_160736_add_department_and_designation_to_users_table', 5),
(367, '2021_06_15_152924_create_proposal_templates_table', 5),
(368, '2021_06_16_114448_add_recursive_fields_to_crm_schedules_table', 5),
(369, '2021_06_16_125740_create_proposals_table', 5),
(370, '2021_09_24_065738_add_crm_settings_column_to_business_table', 5),
(371, '2020_09_29_184909_add_product_catalogue_version', 6),
(372, '2019_11_12_163135_create_projects_table', 7),
(373, '2019_11_12_164431_create_project_members_table', 7),
(374, '2019_11_14_112230_create_project_tasks_table', 7),
(375, '2019_11_14_112258_create_project_task_members_table', 7),
(376, '2019_11_18_154617_create_project_task_comments_table', 7),
(377, '2019_11_19_134807_create_project_time_logs_table', 7),
(378, '2019_12_11_102549_add_more_fields_in_transactions_table', 7),
(379, '2019_12_11_102735_create_invoice_lines_table', 7),
(380, '2020_01_07_172852_add_project_permissions', 7),
(381, '2020_01_08_115422_add_project_module_version_to_system_table', 7),
(382, '2020_07_10_114514_set_location_id_on_existing_invoice', 7),
(383, '2019_07_15_114211_add_manufacturing_module_version_to_system_table', 8),
(384, '2019_07_15_114403_create_mfg_recipes_table', 8),
(385, '2019_07_18_180217_add_production_columns_to_transactions_table', 8),
(386, '2019_07_26_110753_add_manufacturing_settings_column_to_business_table', 8),
(387, '2019_07_26_170450_add_manufacturing_permissions', 8),
(388, '2019_08_08_110035_create_mfg_recipe_ingredients_table', 8),
(389, '2019_08_08_172837_add_recipe_add_edit_permissions', 8),
(390, '2019_08_12_114610_add_ingredient_waste_percent_columns', 8),
(391, '2019_11_05_115136_create_ingredient_groups_table', 8),
(392, '2020_02_22_120303_add_column_to_mfg_recipe_ingredients_table', 8),
(393, '2020_08_19_103831_add_production_cost_type_to_recipe_and_transaction_table', 8),
(394, '2019_03_07_155813_make_repair_statuses_table', 9),
(395, '2019_03_08_120634_add_repair_columns_to_transactions_table', 9),
(396, '2019_03_14_182704_add_repair_permissions', 9),
(397, '2019_03_29_110241_add_repair_version_column_to_system_table', 9),
(398, '2019_04_12_113901_add_repair_settings_column_to_business_table', 9),
(399, '2020_05_05_125008_create_device_models_table', 9),
(400, '2020_05_06_103135_add_repair_model_id_column_to_products_table', 9),
(401, '2020_07_11_120308_add_columns_to_repair_statuses_table', 9),
(402, '2020_07_31_130737_create_job_sheets_table', 9),
(403, '2020_08_07_124241_add_job_sheet_id_to_transactions_table', 9),
(404, '2020_08_22_104640_add_email_template_field_to_repair_status_table', 9),
(405, '2020_10_19_131934_add_job_sheet_custom_fields_to_repair_job_sheets_table', 9),
(406, '2020_11_25_111050_add_parts_column_to_repair_job_sheets_table', 9),
(407, '2020_12_30_101842_add_use_for_repair_column_to_brands_table', 9),
(408, '2021_02_16_190423_add_repair_module_indexing', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(32, 'App\\User', 6),
(32, 'App\\User', 7),
(32, 'App\\User', 8),
(32, 'App\\User', 9),
(32, 'App\\User', 25),
(32, 'App\\User', 29),
(32, 'App\\User', 30),
(32, 'App\\User', 31);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(9, 'App\\User', 5),
(11, 'App\\User', 6),
(13, 'App\\User', 7),
(13, 'App\\User', 8),
(13, 'App\\User', 9),
(13, 'App\\User', 24),
(13, 'App\\User', 25),
(13, 'App\\User', 29),
(13, 'App\\User', 30),
(13, 'App\\User', 31),
(14, 'App\\User', 27),
(16, 'App\\User', 33);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('06c7e84e-60b7-4ded-bb93-bcd864d2544f', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 30, '{\"assigned_by\":29,\"task_id\":\"2023\\/0004\",\"id\":5}', '2023-04-28 04:52:07', '2023-04-27 22:25:25', '2023-04-28 04:52:07'),
('0cfc35f0-fa22-46e3-8df8-30c6f5517bfd', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 7, '{\"assigned_by\":6,\"task_id\":\"2023\\/0001\",\"id\":1}', '2023-03-31 05:14:30', '2023-03-30 02:58:17', '2023-03-31 05:14:30'),
('5025c750-e51e-489c-9549-75a586902d53', 'Modules\\Project\\Notifications\\NewProjectAssignedNotification', 'App\\User', 31, '{\"project_id\":5}', '2023-05-29 06:49:17', '2023-05-24 21:44:58', '2023-05-29 06:49:17'),
('6aeaae61-deb6-4e70-8ec2-6f28c1411a86', 'Modules\\Essentials\\Notifications\\DocumentShareNotification', 'App\\User', 30, '{\"document_id\":2,\"document_name\":\"1682670537_1682634328_593687313_home page.pdf\",\"shared_by_name\":\"Miss Huma Ismail\",\"shared_by_id\":30,\"document_type\":\"document\"}', '2023-04-28 08:30:06', '2023-04-28 08:29:44', '2023-04-28 08:30:06'),
('7a12f42f-4cea-4879-a2be-d580ad3ebaf8', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 6, '{\"assigned_by\":30,\"task_id\":\"2023\\/0006\",\"id\":7}', '2023-04-28 11:40:00', '2023-04-28 08:24:34', '2023-04-28 11:40:00'),
('7b27308c-43c2-4f3c-9824-b21e25135aa6', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 31, '{\"assigned_by\":29,\"task_id\":\"2023\\/0005\",\"id\":6}', '2023-04-28 04:26:55', '2023-04-27 22:31:50', '2023-04-28 04:26:55'),
('9150093c-772d-4aba-98fc-d6c6eb5d4c1c', 'Modules\\Project\\Notifications\\NewProjectAssignedNotification', 'App\\User', 30, '{\"project_id\":5}', '2023-05-29 06:29:04', '2023-05-24 21:44:58', '2023-05-29 06:29:04'),
('b58d5b6b-cb1f-4111-8321-25d2371bf3c6', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 9, '{\"assigned_by\":6,\"task_id\":\"2023\\/0002\",\"id\":2}', '2023-03-30 10:55:33', '2023-03-30 04:21:44', '2023-03-30 10:55:33'),
('bbd15d1b-8f09-4d21-92e1-719f6c3aed37', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 24, '{\"assigned_by\":6,\"task_id\":\"2023\\/0003\",\"id\":4}', NULL, '2023-04-14 16:04:56', '2023-04-14 16:04:56'),
('e2b960b1-4995-4ea3-8b9a-e4033c67d568', 'Modules\\Essentials\\Notifications\\NewTaskNotification', 'App\\User', 30, '{\"assigned_by\":6,\"task_id\":\"2023\\/0007\",\"id\":8}', '2023-05-29 06:29:04', '2023-05-16 23:48:38', '2023-05-29 06:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `notification_templates`
--

CREATE TABLE `notification_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `template_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_send` tinyint(1) NOT NULL DEFAULT 0,
  `auto_send_sms` tinyint(1) NOT NULL DEFAULT 0,
  `auto_send_wa_notif` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_templates`
--

INSERT INTO `notification_templates` (`id`, `business_id`, `template_for`, `email_body`, `sms_body`, `whatsapp_text`, `subject`, `cc`, `bcc`, `auto_send`, `auto_send_sms`, `auto_send_wa_notif`, `created_at`, `updated_at`) VALUES
(1, 5, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(2, 5, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(3, 5, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(4, 5, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(5, 5, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(6, 5, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(7, 5, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(8, 5, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(9, 5, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(10, 5, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(11, 6, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(12, 6, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(13, 6, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(14, 6, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(15, 6, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(16, 6, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(17, 6, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(18, 6, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(19, 6, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(20, 6, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(21, 7, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(22, 7, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(23, 7, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(24, 7, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(25, 7, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(26, 7, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(27, 7, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(28, 7, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(29, 7, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(30, 7, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(31, 8, 'new_sale', '<p>Dear {contact_name},</p>\n\n                    <p>Your invoice number is {invoice_number}<br />\n                    Total amount: {total_amount}<br />\n                    Paid amount: {received_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(32, 8, 'payment_received', '<p>Dear {contact_name},</p>\n\n                <p>We have received a payment of {received_amount}</p>\n\n                <p>{business_logo}</p>', 'Dear {contact_name}, We have received a payment of {received_amount}. {business_name}', NULL, 'Payment Received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(33, 8, 'payment_reminder', '<p>Dear {contact_name},</p>\n\n                    <p>This is to remind you that you have pending payment of {due_amount}. Kindly pay it as soon as possible.</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, You have pending payment of {due_amount}. Kindly pay it as soon as possible. {business_name}', NULL, 'Payment Reminder, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(34, 8, 'new_booking', '<p>Dear {contact_name},</p>\n\n                    <p>Your booking is confirmed</p>\n\n                    <p>Date: {start_time} to {end_time}</p>\n\n                    <p>Table: {table}</p>\n\n                    <p>Location: {location}</p>\n\n                    <p>{business_logo}</p>', 'Dear {contact_name}, Your booking is confirmed. Date: {start_time} to {end_time}, Table: {table}, Location: {location}', NULL, 'Booking Confirmed - {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(35, 8, 'new_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'Dear {contact_name}, We have a new order with reference number {order_ref_number}. Kindly process the products as soon as possible. {business_name}', NULL, 'New Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(36, 8, 'payment_paid', '<p>Dear {contact_name},</p>\n\n                    <p>We have paid amount {paid_amount} again invoice number {order_ref_number}.<br />\n                    Kindly note it down.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have paid amount {paid_amount} again invoice number {order_ref_number}.\n                    Kindly note it down. {business_name}', NULL, 'Payment Paid, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(37, 8, 'items_received', '<p>Dear {contact_name},</p>\n\n                    <p>We have received all items from invoice reference number {order_ref_number}. Thank you for processing it.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'We have received all items from invoice reference number {order_ref_number}. Thank you for processing it. {business_name}', NULL, 'Items received, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(38, 8, 'items_pending', '<p>Dear {contact_name},<br />\n                    This is to remind you that we have not yet received some items from invoice reference number {order_ref_number}. Please process it as soon as possible.</p>\n\n                    <p>{business_name}<br />\n                    {business_logo}</p>', 'This is to remind you that we have not yet received some items from invoice reference number {order_ref_number} . Please process it as soon as possible.{business_name}', NULL, 'Items Pending, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(39, 8, 'new_quotation', '<p>Dear {contact_name},</p>\n\n                    <p>Your quotation number is {invoice_number}<br />\n                    Total amount: {total_amount}</p>\n\n                    <p>Thank you for shopping with us.</p>\n\n                    <p>{business_logo}</p>\n\n                    <p>&nbsp;</p>', 'Dear {contact_name}, Thank you for shopping with us. {business_name}', NULL, 'Thank you from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(40, 8, 'purchase_order', '<p>Dear {contact_name},</p>\n\n                    <p>We have a new purchase order with reference number {order_ref_number}. The respective invoice is attached here with.</p>\n\n                    <p>{business_logo}</p>', 'We have a new purchase order with reference number {order_ref_number}. {business_name}', NULL, 'New Purchase Order, from {business_name}', NULL, NULL, 0, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_count` int(11) NOT NULL COMMENT 'No. of Business Locations, 0 = infinite option.',
  `user_count` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `bookings` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable bookings',
  `kitchen` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable kitchen',
  `order_screen` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable order_screen',
  `tables` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Enable/Disable tables',
  `invoice_count` int(11) NOT NULL,
  `interval` enum('days','months','years') COLLATE utf8mb4_unicode_ci NOT NULL,
  `interval_count` int(11) NOT NULL,
  `trial_days` int(11) NOT NULL,
  `price` decimal(22,4) NOT NULL,
  `custom_permissions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `is_one_time` tinyint(1) NOT NULL DEFAULT 0,
  `enable_custom_link` tinyint(1) NOT NULL DEFAULT 0,
  `custom_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_link_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `location_count`, `user_count`, `product_count`, `bookings`, `kitchen`, `order_screen`, `tables`, `invoice_count`, `interval`, `interval_count`, `trial_days`, `price`, `custom_permissions`, `created_by`, `sort_order`, `is_active`, `is_private`, `is_one_time`, `enable_custom_link`, `custom_link`, `custom_link_text`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Startup', 'This package is for those who want to sell their products and services online with Unipuller. This package also include HRM software access.', 2, 0, 0, 0, 0, 0, 0, 0, 'months', 2, 0, '0.0000', '{\"essentials_module\":\"1\"}', 5, 1, 1, 0, 0, 0, '', '', NULL, '2023-03-25 22:28:59', '2023-03-27 06:39:36'),
(2, 'Growing', 'This package is for those who want to sell their products and services online with Unipuller. This package also include Full CRM and Project management software access.', 2, 0, 0, 0, 0, 0, 0, 0, 'months', 2, 0, '0.0000', '{\"crm_module\":\"1\",\"essentials_module\":\"1\",\"project_module\":\"1\"}', 5, 1, 1, 0, 0, 0, '', '', NULL, '2023-03-25 22:51:58', '2023-03-27 06:40:29'),
(3, 'Business solution', 'This package is for manufacturing companies to sell their products and services online with Unipuller.', 2, 0, 0, 0, 0, 0, 0, 0, 'months', 2, 0, '0.0000', '{\"crm_module\":\"1\",\"essentials_module\":\"1\",\"manufacturing_module\":\"1\",\"project_module\":\"1\",\"woocommerce_module\":\"1\"}', 5, 1, 1, 0, 0, 0, '', '', NULL, '2023-03-25 22:59:43', '2023-03-27 06:41:19'),
(4, 'Repair solutions', 'This package is for repairing solutions providers', 2, 0, 0, 0, 0, 0, 0, 0, 'months', 2, 0, '0.0000', '{\"crm_module\":\"1\",\"essentials_module\":\"1\",\"productcatalogue_module\":\"1\",\"project_module\":\"1\",\"repair_module\":\"1\"}', 5, 1, 1, 0, 0, 0, '', '', NULL, '2023-03-25 23:05:35', '2023-03-27 06:42:01'),
(5, 'Restaurant Pack', 'This project is for the Restaurant business', 2, 0, 0, 0, 0, 0, 0, 0, 'months', 2, 0, '0.0000', '{\"manufacturing_module\":\"1\",\"productcatalogue_module\":\"1\",\"woocommerce_module\":\"1\"}', 5, 1, 1, 0, 0, 0, '', '', NULL, '2023-03-25 23:09:19', '2023-03-27 06:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shahed.unipuller@gmail.com', '$2y$10$Vb.xYPoxJuQc4lMc9MbsjOWao3kQsIJJqKZ9mBs20bm/NM5P64v4.', '2023-03-28 11:56:35');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'profit_loss_report.view', 'web', '2023-03-17 00:33:14', NULL),
(2, 'direct_sell.access', 'web', '2023-03-17 00:33:14', NULL),
(3, 'product.opening_stock', 'web', '2023-03-17 00:33:20', '2023-03-17 00:33:20'),
(4, 'crud_all_bookings', 'web', '2023-03-17 00:33:21', '2023-03-17 00:33:21'),
(5, 'crud_own_bookings', 'web', '2023-03-17 00:33:21', '2023-03-17 00:33:21'),
(6, 'access_default_selling_price', 'web', '2023-03-17 00:33:24', '2023-03-17 00:33:24'),
(7, 'purchase.payments', 'web', '2023-03-17 00:33:26', '2023-03-17 00:33:26'),
(8, 'sell.payments', 'web', '2023-03-17 00:33:26', '2023-03-17 00:33:26'),
(9, 'edit_product_price_from_sale_screen', 'web', '2023-03-17 00:33:26', '2023-03-17 00:33:26'),
(10, 'edit_product_discount_from_sale_screen', 'web', '2023-03-17 00:33:26', '2023-03-17 00:33:26'),
(11, 'roles.view', 'web', '2023-03-17 00:33:27', '2023-03-17 00:33:27'),
(12, 'roles.create', 'web', '2023-03-17 00:33:27', '2023-03-17 00:33:27'),
(13, 'roles.update', 'web', '2023-03-17 00:33:27', '2023-03-17 00:33:27'),
(14, 'roles.delete', 'web', '2023-03-17 00:33:27', '2023-03-17 00:33:27'),
(15, 'account.access', 'web', '2023-03-17 00:33:29', '2023-03-17 00:33:29'),
(16, 'discount.access', 'web', '2023-03-17 00:33:29', '2023-03-17 00:33:29'),
(17, 'view_purchase_price', 'web', '2023-03-17 00:33:30', '2023-03-17 00:33:30'),
(18, 'view_own_sell_only', 'web', '2023-03-17 00:33:31', '2023-03-17 00:33:31'),
(19, 'edit_product_discount_from_pos_screen', 'web', '2023-03-17 00:33:33', '2023-03-17 00:33:33'),
(20, 'edit_product_price_from_pos_screen', 'web', '2023-03-17 00:33:33', '2023-03-17 00:33:33'),
(21, 'access_shipping', 'web', '2023-03-17 00:33:34', '2023-03-17 00:33:34'),
(22, 'purchase.update_status', 'web', '2023-03-17 00:33:34', '2023-03-17 00:33:34'),
(23, 'list_drafts', 'web', '2023-03-17 00:33:35', '2023-03-17 00:33:35'),
(24, 'list_quotations', 'web', '2023-03-17 00:33:35', '2023-03-17 00:33:35'),
(25, 'view_cash_register', 'web', '2023-03-17 00:33:39', '2023-03-17 00:33:39'),
(26, 'close_cash_register', 'web', '2023-03-17 00:33:39', '2023-03-17 00:33:39'),
(27, 'print_invoice', 'web', '2023-03-17 00:33:42', '2023-03-17 00:33:42'),
(28, 'sell.view', 'web', NULL, NULL),
(29, 'sell.create', 'web', NULL, NULL),
(30, 'sell.update', 'web', NULL, NULL),
(31, 'sell.delete', 'web', NULL, NULL),
(32, 'access_all_locations', 'web', NULL, NULL),
(33, 'location.1', 'web', '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(34, 'modules.view', 'web', NULL, NULL),
(35, 'essentials.create_message', 'web', '2023-03-19 06:35:33', '2023-03-19 06:35:33'),
(36, 'essentials.view_message', 'web', '2023-03-19 06:35:33', '2023-03-19 06:35:33'),
(37, 'essentials.approve_leave', 'web', '2023-03-19 06:35:34', '2023-03-19 06:35:34'),
(38, 'essentials.assign_todos', 'web', '2023-03-19 06:35:34', '2023-03-19 06:35:34'),
(39, 'essentials.add_allowance_and_deduction', 'web', '2023-03-19 06:35:34', '2023-03-19 06:35:34'),
(40, 'woocommerce.syc_categories', 'web', '2023-03-19 07:39:01', '2023-03-19 07:39:01'),
(41, 'woocommerce.sync_products', 'web', '2023-03-19 07:39:01', '2023-03-19 07:39:01'),
(42, 'woocommerce.sync_orders', 'web', '2023-03-19 07:39:01', '2023-03-19 07:39:01'),
(43, 'woocommerce.map_tax_rates', 'web', '2023-03-19 07:39:01', '2023-03-19 07:39:01'),
(44, 'woocommerce.access_woocommerce_api_settings', 'web', '2023-03-19 07:39:02', '2023-03-19 07:39:02'),
(45, 'project.create_project', 'web', '2023-03-24 19:51:34', '2023-03-24 19:51:34'),
(46, 'project.edit_project', 'web', '2023-03-24 19:51:34', '2023-03-24 19:51:34'),
(47, 'project.delete_project', 'web', '2023-03-24 19:51:34', '2023-03-24 19:51:34'),
(48, 'manufacturing.access_recipe', 'web', '2023-03-24 19:57:14', '2023-03-24 19:57:14'),
(49, 'manufacturing.access_production', 'web', '2023-03-24 19:57:14', '2023-03-24 19:57:14'),
(50, 'manufacturing.add_recipe', 'web', '2023-03-24 19:57:14', '2023-03-24 19:57:14'),
(51, 'manufacturing.edit_recipe', 'web', '2023-03-24 19:57:14', '2023-03-24 19:57:14'),
(52, 'repair.create', 'web', '2023-03-25 11:48:54', '2023-03-25 11:48:54'),
(53, 'repair.update', 'web', '2023-03-25 11:48:54', '2023-03-25 11:48:54'),
(54, 'repair.view', 'web', '2023-03-25 11:48:54', '2023-03-25 11:48:54'),
(55, 'repair.delete', 'web', '2023-03-25 11:48:54', '2023-03-25 11:48:54'),
(56, 'repair_status.update', 'web', '2023-03-25 11:48:54', '2023-03-25 11:48:54'),
(57, 'repair_status.access', 'web', '2023-03-25 11:48:54', '2023-03-25 11:48:54'),
(58, 'location.2', 'web', '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(59, 'view_export_buttons', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(60, 'user.view', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(61, 'user.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(62, 'user.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(63, 'supplier.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(64, 'supplier.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(65, 'supplier.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(66, 'customer.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(67, 'customer.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(68, 'customer.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(69, 'product.view', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(70, 'product.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(71, 'product.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(72, 'product.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(73, 'purchase.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(74, 'purchase.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(75, 'purchase.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(76, 'edit_purchase_payment', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(77, 'delete_purchase_payment', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(78, 'purchase_requisition.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(79, 'purchase_requisition.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(80, 'purchase_order.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(81, 'purchase_order.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(82, 'purchase_order.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(83, 'edit_pos_payment', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(84, 'view_paid_sells_only', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(85, 'view_due_sells_only', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(86, 'view_partial_sells_only', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(87, 'view_overdue_sells_only', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(88, 'direct_sell.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(89, 'direct_sell.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(90, 'view_commission_agent_sell', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(91, 'edit_sell_payment', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(92, 'delete_sell_payment', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(93, 'access_types_of_service', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(94, 'access_sell_return', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(95, 'access_own_sell_return', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(96, 'edit_invoice_number', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(97, 'so.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(98, 'so.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(99, 'so.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(100, 'draft.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(101, 'draft.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(102, 'quotation.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(103, 'quotation.delete', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(104, 'access_pending_shipments_only', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(105, 'access_commission_agent_shipping', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(106, 'brand.view', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(107, 'brand.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(108, 'brand.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(109, 'tax_rate.view', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(110, 'tax_rate.create', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(111, 'tax_rate.update', 'web', '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(112, 'unit.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(113, 'unit.create', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(114, 'unit.update', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(115, 'category.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(116, 'category.create', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(117, 'category.update', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(118, 'purchase_n_sell_report.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(119, 'contacts_report.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(120, 'stock_report.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(121, 'trending_product_report.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(122, 'register_report.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(123, 'sales_representative.view', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(124, 'view_product_stock_value', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(125, 'expense.add', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(126, 'expense.edit', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(127, 'expense.delete', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(128, 'dashboard.data', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(129, 'edit_account_transaction', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(130, 'crm.access_contact_login', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(131, 'crm.access_sources', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(132, 'crm.access_life_stage', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(133, 'crm.access_proposal', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(134, 'essentials.crud_leave_type', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(135, 'essentials.allow_users_for_attendance_from_web', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(136, 'essentials.allow_users_for_attendance_from_api', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(137, 'essentials.view_allowance_and_deduction', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(138, 'essentials.view_all_payroll', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(139, 'essentials.create_payroll', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(140, 'essentials.update_payroll', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(141, 'essentials.add_todos', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(142, 'essentials.edit_todos', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(143, 'essentials.delete_todos', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(144, 'essentials.access_sales_target', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(145, 'job_sheet.create', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(146, 'job_sheet.edit', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(147, 'job_sheet.delete', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(148, 'supplier.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(149, 'customer.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(150, 'customer_irrespective_of_sell', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(151, 'view_own_purchase', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(152, 'purchase_requisition.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(153, 'purchase_order.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(154, 'so.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(155, 'draft.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(156, 'quotation.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(157, 'access_own_shipping', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(158, 'view_own_expense', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(159, 'crm.access_own_schedule', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(160, 'crm.access_all_leads', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(161, 'crm.access_own_campaigns', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(162, 'essentials.crud_own_leave', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(163, 'essentials.view_own_attendance', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(164, 'repair.view_own', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(165, 'job_sheet.view_assigned', 'web', '2023-03-27 04:34:16', '2023-03-27 04:34:16'),
(166, 'user.delete', 'web', '2023-03-27 04:36:46', '2023-03-27 04:36:46'),
(167, 'brand.delete', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(168, 'tax_rate.delete', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(169, 'unit.delete', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(170, 'category.delete', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(171, 'expense_report.view', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(172, 'business_settings.access', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(173, 'barcode_settings.access', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(174, 'invoice_settings.access', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(175, 'access_printers', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(176, 'delete_account_transaction', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(177, 'essentials.crud_department', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(178, 'crm.access_own_leads', 'web', '2023-03-27 04:44:00', '2023-03-27 04:44:00'),
(179, 'selling_price_group.1', 'web', '2023-04-02 23:35:17', '2023-04-02 23:35:17'),
(180, 'selling_price_group.2', 'web', '2023-04-02 23:35:43', '2023-04-02 23:35:43'),
(181, 'selling_price_group.3', 'web', '2023-04-02 23:36:03', '2023-04-02 23:36:03'),
(182, 'selling_price_group.4', 'web', '2023-04-02 23:39:12', '2023-04-02 23:39:12'),
(183, 'selling_price_group.5', 'web', '2023-04-02 23:40:34', '2023-04-02 23:40:34'),
(184, 'selling_price_group.6', 'web', '2023-04-02 23:43:14', '2023-04-02 23:43:14'),
(185, 'selling_price_group.7', 'web', '2023-04-02 23:43:27', '2023-04-02 23:43:27'),
(186, 'selling_price_group.8', 'web', '2023-04-02 23:44:27', '2023-04-02 23:44:27'),
(187, 'selling_price_group.9', 'web', '2023-04-02 23:44:46', '2023-04-02 23:44:46'),
(188, 'location.3', 'web', '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(189, 'location.4', 'web', '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(190, 'location.5', 'web', '2023-07-18 17:45:13', '2023-07-18 17:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `pjt_invoice_lines`
--

CREATE TABLE `pjt_invoice_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `task` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(22,4) NOT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `quantity` decimal(22,4) NOT NULL,
  `total` decimal(22,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pjt_invoice_lines`
--

INSERT INTO `pjt_invoice_lines` (`id`, `transaction_id`, `task`, `description`, `rate`, `tax_rate_id`, `quantity`, `total`, `created_at`, `updated_at`) VALUES
(1, 2, 'consultancy', NULL, '100.0000', NULL, '5.0000', '50000.0000', '2023-04-22 23:52:17', '2023-04-22 23:52:17'),
(2, 2, 'documentation', NULL, '500.0000', NULL, '1.0000', '50000.0000', '2023-04-22 23:52:17', '2023-04-22 23:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `pjt_projects`
--

CREATE TABLE `pjt_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `status` enum('not_started','in_progress','on_hold','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `settings` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pjt_projects`
--

INSERT INTO `pjt_projects` (`id`, `business_id`, `name`, `contact_id`, `status`, `lead_id`, `start_date`, `end_date`, `description`, `created_by`, `settings`, `created_at`, `updated_at`) VALUES
(3, 5, 'new test project', 1, 'in_progress', 5, '2023-04-01 00:00:00', '2023-04-20 00:00:00', '<p>new test project description</p>', 5, '{\"enable_timelog\":1,\"enable_invoice\":1,\"enable_notes_documents\":1,\"members_crud_task\":0,\"members_crud_note\":0,\"members_crud_timelog\":0,\"task_view\":\"list_view\",\"task_id_prefix\":\"#\"}', '2023-04-04 13:31:28', '2023-04-04 13:31:28'),
(4, 6, 'Study Abroad Consultancy', NULL, 'in_progress', 6, '2023-04-24 00:00:00', '2023-04-25 00:00:00', '<p>testing project</p>', 6, '{\"task_view\":\"kanban\",\"enable_timelog\":1,\"enable_notes_documents\":1,\"enable_invoice\":1,\"members_crud_task\":1,\"members_crud_note\":1,\"members_crud_timelog\":1,\"task_id_prefix\":\"#\"}', '2023-04-22 23:48:50', '2023-04-22 23:56:06'),
(5, 6, 'Unipuller IT project', NULL, 'in_progress', 6, '2023-05-24 00:00:00', '2023-06-30 00:00:00', '<p>This project is for the website and other software development.&nbsp;</p>', 6, '{\"enable_timelog\":1,\"enable_invoice\":1,\"enable_notes_documents\":1,\"members_crud_task\":0,\"members_crud_note\":0,\"members_crud_timelog\":0,\"task_view\":\"list_view\",\"task_id_prefix\":\"#\"}', '2023-05-24 21:44:58', '2023-05-24 21:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `pjt_project_members`
--

CREATE TABLE `pjt_project_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pjt_project_members`
--

INSERT INTO `pjt_project_members` (`id`, `project_id`, `user_id`) VALUES
(6, 3, 5),
(7, 4, 6),
(8, 5, 30),
(9, 5, 31),
(10, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `pjt_project_tasks`
--

CREATE TABLE `pjt_project_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `task_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `priority` enum('low','medium','high','urgent') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `status` enum('completed','not_started','in_progress','on_hold','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not_started',
  `custom_field_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pjt_project_tasks`
--

INSERT INTO `pjt_project_tasks` (`id`, `business_id`, `project_id`, `task_id`, `subject`, `start_date`, `due_date`, `priority`, `description`, `created_by`, `status`, `custom_field_1`, `custom_field_2`, `custom_field_3`, `custom_field_4`, `created_at`, `updated_at`) VALUES
(1, 6, 5, '#1', 'SMTP setup', '2023-05-25 00:00:00', '2023-05-25 00:00:00', 'urgent', '<p>Please setup smtp for unipuller</p>', 6, 'not_started', NULL, NULL, NULL, NULL, '2023-05-24 21:48:02', '2023-05-24 21:48:02'),
(2, 6, 5, '#2', 'SMTP', '2023-05-25 00:00:00', '2023-05-26 00:00:00', 'medium', '<p>SMTP setup</p>', 6, 'in_progress', NULL, NULL, NULL, NULL, '2023-05-24 21:53:10', '2023-05-24 21:53:10');

-- --------------------------------------------------------

--
-- Table structure for table `pjt_project_task_comments`
--

CREATE TABLE `pjt_project_task_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_task_id` int(10) UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `commented_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pjt_project_task_members`
--

CREATE TABLE `pjt_project_task_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pjt_project_task_members`
--

INSERT INTO `pjt_project_task_members` (`id`, `project_task_id`, `user_id`) VALUES
(1, 1, 31),
(2, 2, 31);

-- --------------------------------------------------------

--
-- Table structure for table `pjt_project_time_logs`
--

CREATE TABLE `pjt_project_time_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `project_task_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `printers`
--

CREATE TABLE `printers` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection_type` enum('network','windows','linux') COLLATE utf8mb4_unicode_ci NOT NULL,
  `capability_profile` enum('default','simple','SP2000','TEP-200M','P822D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `char_per_line` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `type` enum('single','variable','modifier','combo') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` int(11) UNSIGNED DEFAULT NULL,
  `secondary_unit_id` int(11) DEFAULT NULL,
  `sub_unit_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `sub_category_id` int(10) UNSIGNED DEFAULT NULL,
  `tax` int(10) UNSIGNED DEFAULT NULL,
  `tax_type` enum('inclusive','exclusive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable_stock` tinyint(1) NOT NULL DEFAULT 0,
  `alert_quantity` decimal(22,4) DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_type` enum('C39','C128','EAN13','EAN8','UPCA','UPCE') COLLATE utf8mb4_unicode_ci DEFAULT 'C128',
  `expiry_period` decimal(4,2) DEFAULT NULL,
  `expiry_period_type` enum('days','months') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_sr_no` tinyint(1) NOT NULL DEFAULT 0,
  `weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_custom_field1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_custom_field2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_custom_field3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_custom_field4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_media_id` int(11) DEFAULT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_product_id` int(11) DEFAULT NULL,
  `woocommerce_disable_sync` tinyint(1) NOT NULL DEFAULT 0,
  `preparation_time_in_minutes` int(11) DEFAULT NULL,
  `warranty_id` int(11) DEFAULT NULL,
  `is_inactive` tinyint(1) NOT NULL DEFAULT 0,
  `repair_model_id` int(10) UNSIGNED DEFAULT NULL,
  `not_for_selling` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `business_id`, `type`, `unit_id`, `secondary_unit_id`, `sub_unit_ids`, `brand_id`, `category_id`, `sub_category_id`, `tax`, `tax_type`, `enable_stock`, `alert_quantity`, `sku`, `barcode_type`, `expiry_period`, `expiry_period_type`, `enable_sr_no`, `weight`, `product_custom_field1`, `product_custom_field2`, `product_custom_field3`, `product_custom_field4`, `image`, `woocommerce_media_id`, `product_description`, `created_by`, `woocommerce_product_id`, `woocommerce_disable_sync`, `preparation_time_in_minutes`, `warranty_id`, `is_inactive`, `repair_model_id`, `not_for_selling`, `created_at`, `updated_at`) VALUES
(3, 'Web Development for property management', 6, 'single', 2, NULL, NULL, 2, 102, NULL, NULL, 'exclusive', 0, '0.0000', '0003', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '1681416421_uni logo.png', NULL, '<p>This is a web development service for creating a SaaS featured property management system. This is a combination of many relative features which is based on customization in an existant source code according to the customer\'s requirements.&nbsp;</p>', 6, NULL, 0, NULL, NULL, 0, NULL, 0, '2023-04-13 20:07:01', '2023-04-13 20:07:01'),
(4, 'Markeing consultancy', 6, 'single', 2, NULL, NULL, NULL, 108, NULL, NULL, 'exclusive', 0, '0.0000', '0004', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '1683980515_evnents and tourism banner.jpg', NULL, NULL, 6, NULL, 0, NULL, NULL, 0, NULL, 0, '2023-05-13 12:21:55', '2023-07-15 16:21:54'),
(5, 'Letting service-room', 6, 'single', 2, NULL, NULL, NULL, 108, NULL, NULL, 'exclusive', 0, '0.0000', '0005', 'C128', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, '1689438206_logo blue.png', NULL, '<p>Service includes:</p>\r\n<ol>\r\n<li>Finding properties on behalf of Tenant.</li>\r\n<li>Scheduling booking for the inspection of properties</li>\r\n<li>Processing documents for the tenancy agreement with landlord</li>\r\n<li>Customers will get 3 free physical property viewings</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p>Cost includes: Our consultancy fee for finding your dream home&mdash;</p>\r\n<ol>\r\n<li>&pound;20 is booking fee of total service cost which need to be paid upfront. Rest of the service fee required to be paid after getting property.</li>\r\n<li>The booking fee includes 10 virtual property viewings from our property lists</li>\r\n<li>&nbsp;&pound;95 (per room)</li>\r\n</ol>', 6, NULL, 0, NULL, NULL, 0, NULL, 0, '2023-07-14 18:00:49', '2023-07-15 16:23:26'),
(6, 'Tanant Service-Seat', 6, 'single', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0006', 'C128', '12.00', 'months', 0, NULL, NULL, NULL, NULL, NULL, '1689438166_logo blue.png', NULL, '<p>Service includes:</p>\r\n<ol>\r\n<li>Finding properties on behalf of Tenant.</li>\r\n<li>Scheduling booking for the inspection of properties</li>\r\n<li>Processing documents for the tenancy agreement with landlord</li>\r\n<li>Customers will get 3 free physical property viewings</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p>Cost includes: Our consultancy fee for finding your dream home&mdash;</p>\r\n<ol>\r\n<li>&pound;20 is booking fee of total service cost which need to be paid upfront. Rest of the service fee required to be paid after getting property.</li>\r\n<li>The booking fee includes 10 virtual property viewings from our property lists</li>\r\n<li>&pound;70 (per seat)</li>\r\n</ol>', 6, NULL, 0, NULL, NULL, 0, NULL, 0, '2023-07-15 16:14:33', '2023-07-15 16:22:46'),
(7, 'Tanant Service-Flat', 6, 'single', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0007', 'C128', '12.00', 'months', 0, NULL, NULL, NULL, NULL, NULL, '1689438054_logo bluee.png', NULL, '<p>Service includes:</p>\r\n<ol>\r\n<li>Finding properties on behalf of Tenant.</li>\r\n<li>Scheduling booking for the inspection of properties</li>\r\n<li>Processing documents for the tenancy agreement with landlord</li>\r\n<li>Customers will get 3 free physical property viewings</li>\r\n</ol>\r\n<p>&nbsp;</p>\r\n<p>Cost includes: Our consultancy fee for finding your dream home&mdash;</p>\r\n<ol>\r\n<li>&pound;20 is booking fee of total service cost which need to be paid upfront. Rest of the service fee required to be paid after getting property.</li>\r\n<li>The booking fee includes 10 virtual property viewings from our property lists</li>\r\n<li>&pound;297 (per flat)</li>\r\n</ol>', 6, NULL, 0, NULL, NULL, 0, NULL, 0, '2023-07-15 16:20:54', '2023-07-17 17:15:19'),
(8, 'test', 6, 'single', 2, NULL, NULL, NULL, NULL, NULL, NULL, 'exclusive', 1, NULL, '0008', 'C128', '12.00', 'months', 0, NULL, NULL, NULL, NULL, NULL, '1689634256_logo blue.png', NULL, NULL, 6, NULL, 0, NULL, NULL, 0, NULL, 0, '2023-07-17 22:50:56', '2023-07-17 22:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_locations`
--

CREATE TABLE `product_locations` (
  `product_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_locations`
--

INSERT INTO `product_locations` (`product_id`, `location_id`) VALUES
(1, 2),
(2, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_racks`
--

CREATE TABLE `product_racks` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `rack` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `row` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_racks`
--

INSERT INTO `product_racks` (`id`, `business_id`, `location_id`, `product_id`, `rack`, `row`, `position`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 1, NULL, NULL, NULL, '2023-04-01 19:03:46', '2023-04-01 19:03:46'),
(2, 6, 2, 2, NULL, NULL, NULL, '2023-04-02 23:53:18', '2023-04-02 23:53:18'),
(3, 6, 2, 3, NULL, NULL, NULL, '2023-04-13 20:07:01', '2023-04-13 20:07:01'),
(4, 6, 2, 4, NULL, NULL, NULL, '2023-05-13 12:21:55', '2023-07-15 16:21:54'),
(5, 6, 2, 5, NULL, NULL, NULL, '2023-07-14 18:00:49', '2023-07-15 16:23:26'),
(6, 6, 2, 6, NULL, NULL, NULL, '2023-07-15 16:14:33', '2023-07-15 16:22:46'),
(7, 6, 2, 7, NULL, NULL, NULL, '2023-07-15 16:20:54', '2023-07-17 17:15:19'),
(8, 6, 2, 8, NULL, NULL, NULL, '2023-07-17 22:50:56', '2023-07-17 22:57:17');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` int(10) UNSIGNED NOT NULL,
  `variation_template_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `is_dummy` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `variation_template_id`, `name`, `product_id`, `is_dummy`, `created_at`, `updated_at`) VALUES
(3, NULL, 'DUMMY', 3, 1, '2023-04-13 20:07:01', '2023-04-13 20:07:01'),
(4, NULL, 'DUMMY', 4, 1, '2023-05-13 12:21:55', '2023-05-13 12:21:55'),
(5, NULL, 'DUMMY', 5, 1, '2023-07-14 18:00:49', '2023-07-14 18:00:49'),
(6, NULL, 'DUMMY', 6, 1, '2023-07-15 16:14:33', '2023-07-15 16:14:33'),
(7, NULL, 'DUMMY', 7, 1, '2023-07-15 16:20:54', '2023-07-15 16:20:54'),
(8, NULL, 'DUMMY', 8, 1, '2023-07-17 22:50:56', '2023-07-17 22:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_lines`
--

CREATE TABLE `purchase_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `pp_without_discount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Purchase price before inline discounts',
  `discount_percent` decimal(5,2) NOT NULL DEFAULT 0.00 COMMENT 'Inline discount percentage',
  `purchase_price` decimal(22,4) NOT NULL,
  `purchase_price_inc_tax` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `item_tax` decimal(22,4) NOT NULL COMMENT 'Tax for one quantity',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `purchase_requisition_line_id` int(11) DEFAULT NULL,
  `purchase_order_line_id` int(11) DEFAULT NULL,
  `quantity_sold` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Quanity sold from this purchase line',
  `quantity_adjusted` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Quanity adjusted in stock adjustment from this purchase line',
  `quantity_returned` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `po_quantity_purchased` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `mfg_quantity_used` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `mfg_date` date DEFAULT NULL,
  `exp_date` date DEFAULT NULL,
  `lot_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(191) NOT NULL,
  `user_id` int(191) NOT NULL,
  `product_id` int(191) NOT NULL,
  `service_id` int(191) UNSIGNED DEFAULT NULL,
  `review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint(2) NOT NULL,
  `review_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reference_counts`
--

CREATE TABLE `reference_counts` (
  `id` int(10) UNSIGNED NOT NULL,
  `ref_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_count` int(11) NOT NULL,
  `business_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reference_counts`
--

INSERT INTO `reference_counts` (`id`, `ref_type`, `ref_count`, `business_id`, `created_at`, `updated_at`) VALUES
(1, 'contacts', 5, 5, '2023-03-17 01:17:16', '2023-04-07 13:09:09'),
(2, 'business_location', 1, 5, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(3, 'contacts', 35, 6, '2023-03-26 00:30:53', '2023-07-18 16:12:16'),
(4, 'business_location', 2, 6, '2023-03-26 00:30:53', '2023-07-18 17:45:13'),
(5, 'essentials_todos', 8, 6, '2023-03-30 02:58:17', '2023-06-12 12:13:04'),
(6, 'draft', 16, 6, '2023-04-01 00:22:47', '2023-07-19 04:19:31'),
(7, 'essentials_todos', 1, 5, '2023-04-08 01:32:28', '2023-04-08 01:32:28'),
(8, 'contacts', 1, 7, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(9, 'business_location', 1, 7, '2023-04-25 00:03:27', '2023-04-25 00:03:27'),
(10, 'sell_payment', 14, 6, '2023-04-25 15:52:50', '2023-07-18 11:32:10'),
(11, 'crm_order_request', 3, 6, '2023-04-25 19:26:46', '2023-07-19 00:05:14'),
(12, 'contacts', 1, 8, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(13, 'business_location', 1, 8, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(14, 'expense', 1, 6, '2023-07-18 22:10:29', '2023-07-18 22:10:29'),
(15, 'sell_return', 1, 6, '2023-07-19 04:28:01', '2023-07-19 04:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `repair_device_models`
--

CREATE TABLE `repair_device_models` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `repair_checklist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `device_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_job_sheets`
--

CREATE TABLE `repair_job_sheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `job_sheet_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_type` enum('carry_in','pick_up','on_site') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pick_up_on_site_addr` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `device_id` int(10) UNSIGNED DEFAULT NULL,
  `device_model_id` int(10) UNSIGNED DEFAULT NULL,
  `checklist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_pwd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_pattern` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `product_configuration` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `defects` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_condition` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_staff` int(10) UNSIGNED DEFAULT NULL,
  `comment_by_ss` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'comment made by technician',
  `estimated_cost` decimal(22,4) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `parts` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repair_statuses`
--

CREATE TABLE `repair_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `is_completed_status` tinyint(1) NOT NULL DEFAULT 0,
  `sms_template` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_product_modifier_sets`
--

CREATE TABLE `res_product_modifier_sets` (
  `modifier_set_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL COMMENT 'Table use to store the modifier sets applicable for a product'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_tables`
--

CREATE TABLE `res_tables` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `res_tables`
--

INSERT INTO `res_tables` (`id`, `business_id`, `location_id`, `name`, `description`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 'Regular Service', 'Regular services are coming with same features that premium services have. The delivery time for regular service is normally lengthy than the premium service.', 6, NULL, '2023-07-18 15:21:34', '2023-07-18 15:21:34'),
(2, 6, 2, 'Normal service', NULL, 6, NULL, '2023-07-18 15:22:31', '2023-07-18 15:22:31'),
(3, 6, 2, 'Premium Service', NULL, 6, NULL, '2023-07-18 15:24:56', '2023-07-18 15:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `is_service_staff` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `business_id`, `is_default`, `is_service_staff`, `created_at`, `updated_at`) VALUES
(9, 'Admin#5', 'web', 5, 1, 0, '2023-03-17 01:17:15', '2023-03-17 01:17:15'),
(10, 'Cashier#5', 'web', 5, 0, 0, '2023-03-17 01:17:15', '2023-03-17 01:17:15'),
(11, 'Admin#6', 'web', 6, 1, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(12, 'Cashier#6', 'web', 6, 0, 0, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(13, 'Employee#6', 'web', 6, 0, 1, '2023-03-27 04:34:15', '2023-03-27 04:34:15'),
(14, 'Admin#7', 'web', 7, 1, 0, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(15, 'Cashier#7', 'web', 7, 0, 0, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(16, 'Admin#8', 'web', 8, 1, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(17, 'Cashier#8', 'web', 8, 0, 0, '2023-06-13 01:20:59', '2023-06-13 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 13),
(3, 13),
(5, 13),
(6, 13),
(7, 13),
(8, 13),
(9, 13),
(10, 13),
(11, 13),
(12, 13),
(16, 13),
(17, 13),
(18, 13),
(19, 13),
(20, 13),
(22, 13),
(25, 10),
(25, 12),
(25, 13),
(25, 15),
(25, 17),
(26, 10),
(26, 12),
(26, 13),
(26, 15),
(26, 17),
(27, 13),
(28, 10),
(28, 12),
(28, 13),
(28, 15),
(28, 17),
(29, 10),
(29, 12),
(29, 13),
(29, 15),
(29, 17),
(30, 10),
(30, 12),
(30, 13),
(30, 15),
(30, 17),
(31, 10),
(31, 12),
(31, 13),
(31, 15),
(31, 17),
(32, 10),
(32, 15),
(32, 17),
(35, 13),
(36, 13),
(38, 13),
(45, 13),
(46, 13),
(48, 13),
(49, 13),
(50, 13),
(51, 13),
(52, 13),
(53, 13),
(55, 13),
(56, 13),
(57, 13),
(60, 13),
(61, 13),
(62, 13),
(63, 13),
(64, 13),
(66, 13),
(67, 13),
(69, 13),
(70, 13),
(71, 13),
(72, 13),
(73, 13),
(74, 13),
(75, 13),
(76, 13),
(77, 13),
(78, 13),
(79, 13),
(80, 13),
(81, 13),
(82, 13),
(83, 13),
(84, 13),
(85, 13),
(86, 13),
(87, 13),
(88, 13),
(89, 13),
(90, 13),
(91, 13),
(92, 13),
(93, 13),
(94, 13),
(95, 13),
(96, 13),
(97, 13),
(98, 13),
(99, 13),
(100, 13),
(101, 13),
(102, 13),
(103, 13),
(104, 13),
(105, 13),
(106, 13),
(107, 13),
(112, 13),
(113, 13),
(115, 13),
(116, 13),
(120, 13),
(121, 13),
(125, 13),
(126, 13),
(127, 13),
(128, 13),
(130, 13),
(134, 13),
(135, 13),
(136, 13),
(141, 13),
(142, 13),
(145, 13),
(146, 13),
(147, 13),
(148, 13),
(149, 13),
(150, 13),
(151, 13),
(152, 13),
(153, 13),
(154, 13),
(155, 13),
(156, 13),
(157, 13),
(158, 13),
(159, 13),
(161, 13),
(162, 13),
(163, 13),
(164, 13),
(165, 13),
(178, 13);

-- --------------------------------------------------------

--
-- Table structure for table `selling_price_groups`
--

CREATE TABLE `selling_price_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `selling_price_groups`
--

INSERT INTO `selling_price_groups` (`id`, `name`, `description`, `business_id`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Basic', '20%', 6, 1, NULL, '2023-04-02 23:35:17', '2023-04-02 23:41:08'),
(2, 'Silver', '15%', 6, 1, NULL, '2023-04-02 23:35:43', '2023-04-02 23:39:25'),
(3, 'Gold', '10%', 6, 1, NULL, '2023-04-02 23:36:03', '2023-04-02 23:42:39'),
(4, 'Wholesale', '5%', 6, 1, NULL, '2023-04-02 23:39:12', '2023-04-02 23:39:12'),
(5, 'Wholesale silver', '7%', 6, 1, NULL, '2023-04-02 23:40:34', '2023-04-02 23:41:58'),
(6, 'Normal', '25', 6, 1, NULL, '2023-04-02 23:43:14', '2023-04-02 23:43:14'),
(7, 'Service', '30', 6, 1, NULL, '2023-04-02 23:43:27', '2023-04-02 23:43:27'),
(8, 'Service +', '35', 6, 1, NULL, '2023-04-02 23:44:27', '2023-04-02 23:44:27'),
(9, 'Tech', '40', 6, 1, NULL, '2023-04-02 23:44:46', '2023-04-02 23:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `sell_line_warranties`
--

CREATE TABLE `sell_line_warranties` (
  `sell_line_id` int(11) NOT NULL,
  `warranty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(191) UNSIGNED NOT NULL,
  `subtitle_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle_anime` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_size` varchar(50) DEFAULT NULL,
  `title_color` varchar(50) DEFAULT NULL,
  `title_anime` varchar(50) DEFAULT NULL,
  `details_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_size` varchar(50) DEFAULT NULL,
  `details_color` varchar(50) DEFAULT NULL,
  `details_anime` varchar(50) DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text DEFAULT NULL,
  `language_id` int(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `subtitle_text`, `subtitle_size`, `subtitle_color`, `subtitle_anime`, `title_text`, `title_size`, `title_color`, `title_anime`, `details_text`, `details_size`, `details_color`, `details_anime`, `photo`, `position`, `link`, `language_id`) VALUES
(8, 'Best Accessories', '24', '#1f224f', 'slideInUp', 'Get Up to 40% Off', '60', '#1f224f', 'slideInDown', 'Gadget for everyday to make your life more interesting and easier even smarter.', '16', '#1f224f', 'slideInLeft', '16474305667png.png', 'left', 'https://unipuller.com/category', 1),
(9, 'Fresh Foods', '24', '#1f224f', 'slideInUp', 'Get Up to 40% Off', '60', '#1f224f', 'slideInDown', 'Buy the best Organic Food for your Healthy Future and Family.', '16', '#1f224f', 'slideInDown', '164743050917png.png', 'left', 'https://unipuller.com/category', 1),
(10, 'Best Furniture', '24', '#1f224f', 'slideInUp', 'Get Up to 40% Off', '60', '#1f224f', 'slideInDown', 'Furniture must have personality, as well as be beautiful and make your home Gorgeous.', '16', '#1f224f', 'slideInRight', '164743055618png.png', 'left', 'https://unipuller.com/category', 1),
(11, 'عالم الموضة', '24', '#1f224f', 'slideInUp', 'الحصول على ما يصل إلى 40 ٪ من', '60', '#1f224f', 'slideInDown', 'تسليط الضوء على شخصيتك وإلقاء نظرة على هذه الأزياء الرائعة والرائعة.', '16', '#1f224f', 'slideInLeft', '1639306988Slider3jpg.jpg', 'left', 'Unipuller.com', 2),
(12, 'عالم الموضة', '24', '#1f224f', 'slideInUp', 'الحصول على ما يصل إلى 40 ٪ من', '60', '#1f224f', 'slideInDown', 'تسليط الضوء على شخصيتك وإلقاء نظرة على هذه الأزياء الرائعة والرائعة.', '16', '#1f224f', 'slideInDown', '1639307153slider4jpg.jpg', 'center', 'Unipuller.com', 2),
(13, 'عالم الموضة', '24', '#1f224f', 'slideInUp', 'الحصول على ما يصل إلى 40 ٪ من', '60', '#1f224f', 'slideInDown', 'تسليط الضوء على شخصيتك وإلقاء نظرة على هذه الأزياء الرائعة والرائعة.', '16', '#1f224f', 'slideInRight', '1639307213slider5jpg.jpg', 'left', 'Unipuller.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE `stars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_folder` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`, `type`, `details`, `image_url`, `image_folder`, `image_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Sarah', 'Actor', '                                With a stellar career in the world of cinema, this charismatic individual has captivated audiences worldwide with their exceptional talent and magnetic on-screen presence.\r\n', 'assets/front/images/star-meetup/cel-1.png', 'star-meetup', 'cel-1.png', 1, NULL, NULL),
(4, 'Noah', 'Actor', '                                Born with a natural inclination for the performing arts, our film star\'s journey began with a deep passion for storytelling and a desire to bring characters to life. They embarked on their path to stardom by honing their acting skills through rigorous training\r\n\r\n', 'assets/front/images/star-meetup/cel-2.png', 'star-meetup', 'cel-2.png', 1, NULL, NULL),
(5, 'Billie', 'Backetball Player', '                                With a stellar career in the world of cinema, this charismatic individual has captivated audiences worldwide with their exceptional talent and magnetic on-screen presence.\r\n', 'assets/front/images/star-meetup/cel-3.png', 'star-meetup', 'cel-3.png', 1, NULL, NULL),
(6, 'Kaneeu Reeve', 'Actor', '                                With a stellar career in the world of cinema, this charismatic individual has captivated audiences worldwide with their exceptional talent and magnetic on-screen presence.\r\n', 'assets/front/images/star-meetup/cel-4.png', 'star-meetup', 'cel-4.png', 1, NULL, NULL),
(7, 'Arriana', 'Singer', '                                With a stellar career in the world of cinema, this charismatic individual has captivated audiences worldwide with their exceptional talent and magnetic on-screen presence.\r\n', 'assets/front/images/star-meetup/cel-5.png', 'star-meetup', 'cel-5.png', 1, NULL, NULL),
(8, 'Foana', 'Actor', '                                Born with a natural inclination for the performing arts, our film star\'s journey began with a deep passion for storytelling and a desire to bring characters to life. They embarked on their path to stardom by honing their acting skills through rigorous training\r\n\r\n', 'assets/front/images/star-meetup/cel-6.png', 'star-meetup', 'cel-6.png', 1, NULL, NULL),
(9, 'Seeme', 'Actor', '                                With a stellar career in the world of cinema, this charismatic individual has captivated audiences worldwide with their exceptional talent and magnetic on-screen presence.\r\n', 'assets/front/images/star-meetup/cel-7.png', 'star-meetup', 'cel-7.png', 1, NULL, NULL),
(10, 'Starlin', 'Singer', '                                With a stellar career in the world of cinema, this charismatic individual has captivated audiences worldwide with their exceptional talent and magnetic on-screen presence.\r\n', 'assets/front/images/star-meetup/cel-8.png', 'star-meetup', 'cel-8.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `state` varchar(111) DEFAULT NULL,
  `tax` double NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `owner_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `state`, `tax`, `status`, `owner_id`) VALUES
(2, 245, 'New Youk', 2, 1, 0),
(4, 246, 'Virginia', 4, 1, 0),
(5, 237, 'Sancta Sedes', 0, 1, 0),
(6, 246, 'Harare', 0, 1, 0),
(7, 245, 'Lusaka', 0, 1, 0),
(8, 244, 'Zinjibar', 0, 1, 0),
(9, 244, 'Mukalla', 0, 1, 0),
(10, 243, 'Smara', 0, 1, 0),
(11, 243, 'Hawza', 0, 1, 0),
(12, 242, 'Vaitupu', 0, 1, 0),
(13, 242, 'Leava', 0, 1, 0),
(14, 18, 'Dhaka', 0, 1, 0),
(15, 18, 'Comilla', 0, 1, 0),
(16, 1, 'Kabul', 0, 1, 0),
(17, 1, 'Kapisa', 0, 1, 0),
(18, 2, 'Fier', 0, 1, 0),
(19, 2, 'Korce', 0, 1, 0),
(20, 13, 'Victoria', 0, 1, 0),
(21, 13, 'Tasmania', 0, 1, 0),
(22, 14, 'Vienna', 0, 1, 0),
(23, 14, 'Styria', 0, 1, 0),
(24, 20, 'Brest Oblast', 0, 1, 0),
(25, 20, 'Vitebsk Oblast', 0, 1, 0),
(26, 100, 'Assam', 0, 1, 0),
(27, 100, 'Bihar', 0, 1, 0),
(28, 100, 'Bombay', 0, 1, 0),
(29, 183, 'Adygea', 0, 1, 0),
(30, 183, 'Buryatia', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustments_temp`
--

CREATE TABLE `stock_adjustments_temp` (
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stock_adjustment_lines`
--

CREATE TABLE `stock_adjustment_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(22,4) NOT NULL,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price` decimal(22,4) DEFAULT NULL COMMENT 'Last purchase unit price',
  `removed_purchase_line` int(11) DEFAULT NULL,
  `lot_no_line_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `trial_end_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `package_price` decimal(22,4) NOT NULL,
  `package_details` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_id` int(10) UNSIGNED NOT NULL,
  `paid_via` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('approved','waiting','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'waiting',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `business_id`, `package_id`, `start_date`, `trial_end_date`, `end_date`, `package_price`, `package_details`, `created_id`, `paid_via`, `payment_transaction_id`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2023-03-27', '2023-05-27', '2023-05-27', '0.0000', '{\"location_count\":2,\"user_count\":0,\"product_count\":0,\"invoice_count\":0,\"name\":\"Startup\",\"essentials_module\":\"1\"}', 5, NULL, 'FREE', 'approved', NULL, '2023-03-27 02:12:54', '2023-03-27 02:12:54'),
(2, 5, 3, '2023-05-28', '2023-07-28', '2023-07-28', '0.0000', '{\"location_count\":2,\"user_count\":0,\"product_count\":0,\"invoice_count\":0,\"name\":\"Business solution\",\"crm_module\":\"1\",\"essentials_module\":\"1\",\"manufacturing_module\":\"1\",\"project_module\":\"1\",\"woocommerce_module\":\"1\"}', 5, NULL, 'FREE', 'approved', NULL, '2023-03-27 02:13:11', '2023-03-27 02:13:11'),
(3, 6, 3, '2023-03-27', '2023-05-27', '2023-05-27', '0.0000', '{\"location_count\":2,\"user_count\":0,\"product_count\":0,\"invoice_count\":0,\"name\":\"Business solution\",\"crm_module\":\"1\",\"essentials_module\":\"1\",\"manufacturing_module\":\"1\",\"project_module\":\"1\",\"woocommerce_module\":\"1\"}', 6, NULL, 'FREE', 'approved', NULL, '2023-03-27 02:15:48', '2023-03-27 02:15:48'),
(4, 7, 3, '2023-04-25', '2023-06-25', '2023-06-25', '0.0000', '{\"location_count\":2,\"user_count\":0,\"product_count\":0,\"invoice_count\":0,\"name\":\"Business solution\",\"crm_module\":\"1\",\"essentials_module\":\"1\",\"manufacturing_module\":\"1\",\"project_module\":\"1\",\"woocommerce_module\":\"1\"}', 27, NULL, 'FREE', 'approved', NULL, '2023-04-25 00:04:15', '2023-04-25 00:04:15'),
(5, 6, 3, '2023-06-03', '2023-08-03', '2023-08-03', '0.0000', '{\"location_count\":2,\"user_count\":0,\"product_count\":0,\"invoice_count\":0,\"name\":\"Business solution\",\"crm_module\":\"1\",\"essentials_module\":\"1\",\"manufacturing_module\":\"1\",\"project_module\":\"1\",\"woocommerce_module\":\"1\"}', 6, NULL, 'FREE', 'approved', NULL, '2023-06-03 09:46:37', '2023-06-03 09:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_communicator_logs`
--

CREATE TABLE `superadmin_communicator_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `superadmin_frontend_pages`
--

CREATE TABLE `superadmin_frontend_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_shown` tinyint(1) NOT NULL,
  `menu_order` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `key`, `value`) VALUES
(1, 'db_version', '5.0'),
(2, 'default_business_active_status', '1'),
(4, 'app_currency_id', '1'),
(5, 'invoice_business_name', 'Unipuller'),
(6, 'invoice_business_landmark', 'Unit 1a, Nagpal house, 1 Gunthorpe Steet'),
(7, 'invoice_business_zip', 'E1 7RG'),
(8, 'invoice_business_state', 'London'),
(9, 'invoice_business_city', 'London'),
(10, 'invoice_business_country', 'United Kingdom'),
(11, 'email', 'superadmin@example.com'),
(12, 'package_expiry_alert_days', '5'),
(13, 'enable_business_based_username', '0'),
(14, 'superadmin_version', '4.0'),
(15, 'essentials_version', '4.0'),
(16, 'woocommerce_version', '4.0'),
(18, 'crm_version', '1.4'),
(19, 'productcatalogue_version', '0.6'),
(20, 'project_version', '1.6'),
(21, 'manufacturing_version', '2.1'),
(22, 'repair_version', '1.5'),
(23, 'superadmin_register_tc', '<p>By clicking here, you\'re giving your consent for the terms and policies of Unipuller Business Solutions</p>'),
(24, 'welcome_email_subject', 'Welcome to Unipuller'),
(25, 'welcome_email_body', '<p>Thanks fou joining us and choosing us as your technology provider.&nbsp;</p>'),
(26, 'additional_js', NULL),
(27, 'additional_css', NULL),
(28, 'offline_payment_details', NULL),
(29, 'superadmin_enable_register_tc', '1'),
(30, 'allow_email_settings_to_businesses', '0'),
(31, 'enable_new_business_registration_notification', '1'),
(32, 'enable_new_subscription_notification', '1'),
(33, 'enable_welcome_email', '1'),
(34, 'enable_offline_payment', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(22,4) NOT NULL,
  `is_tax_group` tinyint(1) NOT NULL DEFAULT 0,
  `for_tax_group` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) UNSIGNED NOT NULL,
  `woocommerce_tax_rate_id` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED DEFAULT NULL,
  `res_table_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fields to restaurant module',
  `res_waiter_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'fields to restaurant module',
  `res_order_status` enum('received','cooked','served') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_quotation` tinyint(1) NOT NULL DEFAULT 0,
  `payment_status` enum('paid','due','partial') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adjustment_type` enum('normal','abnormal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_id` int(11) UNSIGNED DEFAULT NULL,
  `customer_group_id` int(11) DEFAULT NULL COMMENT 'used to add customer group while selling',
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_repeat_on` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` datetime NOT NULL,
  `total_before_tax` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Total before the purchase/invoice tax, this includeds the indivisual product tax',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `tax_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `discount_type` enum('fixed','percentage') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` decimal(22,4) DEFAULT 0.0000,
  `rp_redeemed` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `rp_redeemed_amount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'rp is the short form of reward points',
  `shipping_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `shipping_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivered_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charges` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `shipping_custom_field_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_custom_field_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_custom_field_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_custom_field_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_custom_field_5` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_export` tinyint(1) NOT NULL DEFAULT 0,
  `export_custom_fields_info` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `round_off_amount` decimal(22,4) NOT NULL DEFAULT 0.0000 COMMENT 'Difference of rounded total and actual total',
  `additional_expense_key_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_expense_value_1` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_expense_value_2` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_expense_value_3` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `additional_expense_key_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_expense_value_4` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `final_total` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `expense_category_id` int(10) UNSIGNED DEFAULT NULL,
  `expense_sub_category_id` int(11) DEFAULT NULL,
  `expense_for` int(10) UNSIGNED DEFAULT NULL,
  `commission_agent` int(11) DEFAULT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_direct_sale` tinyint(1) NOT NULL DEFAULT 0,
  `is_suspend` tinyint(1) NOT NULL DEFAULT 0,
  `exchange_rate` decimal(20,3) NOT NULL DEFAULT 1.000,
  `total_amount_recovered` decimal(22,4) DEFAULT NULL COMMENT 'Used for stock adjustment.',
  `transfer_parent_id` int(11) DEFAULT NULL,
  `return_parent_id` int(11) DEFAULT NULL,
  `opening_stock_product_id` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `repair_completed_on` datetime DEFAULT NULL,
  `repair_warranty_id` int(11) DEFAULT NULL,
  `repair_brand_id` int(11) DEFAULT NULL,
  `repair_status_id` int(11) DEFAULT NULL,
  `repair_model_id` int(11) DEFAULT NULL,
  `repair_job_sheet_id` int(10) UNSIGNED DEFAULT NULL,
  `repair_defects` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair_serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair_checklist` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair_security_pwd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair_security_pattern` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `repair_due_date` datetime DEFAULT NULL,
  `repair_device_id` int(11) DEFAULT NULL,
  `repair_updates_notif` tinyint(1) NOT NULL DEFAULT 0,
  `mfg_parent_production_purchase_id` int(11) DEFAULT NULL,
  `mfg_wasted_units` decimal(22,4) DEFAULT NULL,
  `mfg_production_cost` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `mfg_production_cost_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'percentage',
  `mfg_is_final` tinyint(1) NOT NULL DEFAULT 0,
  `crm_is_order_request` tinyint(1) NOT NULL DEFAULT 0,
  `woocommerce_order_id` int(11) DEFAULT NULL,
  `essentials_duration` decimal(8,2) NOT NULL,
  `essentials_duration_unit` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `essentials_amount_per_unit_duration` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `essentials_allowances` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `essentials_deductions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_requisition_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefer_payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefer_payment_account` int(11) DEFAULT NULL,
  `sales_order_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_order_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_batch` int(11) DEFAULT NULL,
  `import_time` datetime DEFAULT NULL,
  `types_of_service_id` int(11) DEFAULT NULL,
  `packing_charge` decimal(22,4) DEFAULT NULL,
  `packing_charge_type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_custom_field_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_custom_field_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_custom_field_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_custom_field_4` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_custom_field_5` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_custom_field_6` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_created_from_api` tinyint(1) NOT NULL DEFAULT 0,
  `rp_earned` int(11) NOT NULL DEFAULT 0 COMMENT 'rp is the short form of reward points',
  `order_addresses` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `recur_interval` double(22,4) DEFAULT NULL,
  `recur_interval_type` enum('days','months','years') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recur_repetitions` int(11) DEFAULT NULL,
  `recur_stopped_on` datetime DEFAULT NULL,
  `recur_parent_id` int(11) DEFAULT NULL,
  `invoice_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_term_number` int(11) DEFAULT NULL,
  `pay_term_type` enum('days','months') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pjt_project_id` int(10) UNSIGNED DEFAULT NULL,
  `pjt_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price_group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `business_id`, `location_id`, `res_table_id`, `res_waiter_id`, `res_order_status`, `type`, `sub_type`, `status`, `sub_status`, `is_quotation`, `payment_status`, `adjustment_type`, `contact_id`, `customer_group_id`, `invoice_no`, `ref_no`, `source`, `subscription_no`, `subscription_repeat_on`, `transaction_date`, `total_before_tax`, `tax_id`, `tax_amount`, `discount_type`, `discount_amount`, `rp_redeemed`, `rp_redeemed_amount`, `shipping_details`, `shipping_address`, `delivery_date`, `shipping_status`, `delivered_to`, `shipping_charges`, `shipping_custom_field_1`, `shipping_custom_field_2`, `shipping_custom_field_3`, `shipping_custom_field_4`, `shipping_custom_field_5`, `additional_notes`, `staff_note`, `is_export`, `export_custom_fields_info`, `round_off_amount`, `additional_expense_key_1`, `additional_expense_value_1`, `additional_expense_key_2`, `additional_expense_value_2`, `additional_expense_key_3`, `additional_expense_value_3`, `additional_expense_key_4`, `additional_expense_value_4`, `final_total`, `expense_category_id`, `expense_sub_category_id`, `expense_for`, `commission_agent`, `document`, `is_direct_sale`, `is_suspend`, `exchange_rate`, `total_amount_recovered`, `transfer_parent_id`, `return_parent_id`, `opening_stock_product_id`, `created_by`, `repair_completed_on`, `repair_warranty_id`, `repair_brand_id`, `repair_status_id`, `repair_model_id`, `repair_job_sheet_id`, `repair_defects`, `repair_serial_no`, `repair_checklist`, `repair_security_pwd`, `repair_security_pattern`, `repair_due_date`, `repair_device_id`, `repair_updates_notif`, `mfg_parent_production_purchase_id`, `mfg_wasted_units`, `mfg_production_cost`, `mfg_production_cost_type`, `mfg_is_final`, `crm_is_order_request`, `woocommerce_order_id`, `essentials_duration`, `essentials_duration_unit`, `essentials_amount_per_unit_duration`, `essentials_allowances`, `essentials_deductions`, `purchase_requisition_ids`, `prefer_payment_method`, `prefer_payment_account`, `sales_order_ids`, `purchase_order_ids`, `custom_field_1`, `custom_field_2`, `custom_field_3`, `custom_field_4`, `import_batch`, `import_time`, `types_of_service_id`, `packing_charge`, `packing_charge_type`, `service_custom_field_1`, `service_custom_field_2`, `service_custom_field_3`, `service_custom_field_4`, `service_custom_field_5`, `service_custom_field_6`, `is_created_from_api`, `rp_earned`, `order_addresses`, `is_recurring`, `recur_interval`, `recur_interval_type`, `recur_repetitions`, `recur_stopped_on`, `recur_parent_id`, `invoice_token`, `pay_term_number`, `pay_term_type`, `pjt_project_id`, `pjt_title`, `selling_price_group_id`, `created_at`, `updated_at`) VALUES
(1, 6, 2, NULL, 7, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 6, NULL, '2023/0001', '', NULL, NULL, NULL, '2023-04-01 00:14:00', '999999999999999999.9999', NULL, '0.0000', 'percentage', '99999.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '-999982496565.0000', NULL, NULL, NULL, 6, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '0bb1485a64dc7cec4ac0d37770adc695', NULL, NULL, NULL, NULL, 0, '2023-04-01 00:22:47', '2023-04-01 00:22:47'),
(2, 6, 2, NULL, NULL, NULL, 'sell', 'project_invoice', 'draft', NULL, 0, 'due', NULL, 6, NULL, '2023/0002', NULL, NULL, NULL, NULL, '2023-04-26 00:00:00', '10000000.0000', NULL, '0.0000', NULL, '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '1000000000.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 'Consultancy', NULL, '2023-04-22 23:52:17', '2023-04-22 23:52:17'),
(3, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', NULL, 0, NULL, NULL, 2, NULL, '2023/0003', '', NULL, NULL, NULL, '2023-04-25 15:39:00', '1001515000.0000', NULL, '0.0000', 'percentage', '9.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '911378650.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-04-25 14:40:42', '2023-04-25 14:40:42'),
(4, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'paid', NULL, 2, NULL, '0001', '', NULL, NULL, NULL, '2023-04-25 16:52:00', '100000000.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '100000000.0000', NULL, NULL, NULL, 6, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-04-25 15:52:50', '2023-04-25 15:52:50'),
(6, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'paid', NULL, 2, NULL, '0003', '', NULL, NULL, NULL, '2023-04-25 16:55:00', '100000000.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '100000000.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-04-25 15:56:09', '2023-04-25 15:56:09'),
(7, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'paid', NULL, 2, NULL, '0004', '', NULL, NULL, NULL, '2023-04-25 16:57:00', '100000000.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '100000000.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2023-04-25 15:58:09', '2023-04-25 15:58:09'),
(8, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'paid', NULL, 2, NULL, '0005', '', NULL, NULL, NULL, '2023-04-25 17:19:00', '100000000.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '100000000.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 666666, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '67702a09ff1b25fa390560527bc37825', NULL, NULL, NULL, NULL, 0, '2023-04-25 16:19:38', '2023-04-25 21:02:28'),
(9, 6, 2, NULL, NULL, NULL, 'sales_order', NULL, 'partial', NULL, 0, NULL, NULL, 3, NULL, 'OR-2023/0001', '', NULL, NULL, NULL, '2023-04-25 20:26:00', '2000000000.0000', NULL, '0.0000', NULL, '0.0000', 0, '0.0000', '21', '12', NULL, 'delivered', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', 'taz', '100.0000', NULL, '0.0000', 'train', '200.0000', NULL, '0.0000', '2000000300.0000', NULL, NULL, NULL, NULL, NULL, 1, 0, '1.000', NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 1, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, '[\"9\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 19:26:46', '2023-04-25 20:03:16'),
(10, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'proforma', 1, 'due', NULL, 35, NULL, 'Dtraft2023/0004', '', NULL, NULL, NULL, '2023-05-13 13:28:00', '75.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, '72 Grove Green Rd, London E11 4EJ', NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '75.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '9681cdb926941ea2b1a33b54af8f61e4', NULL, NULL, NULL, NULL, NULL, '2023-05-13 12:29:52', '2023-05-13 13:36:40'),
(12, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 35, NULL, 'Dtraft2023/0006', '', NULL, NULL, NULL, '2023-05-13 14:15:00', '75.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, '72 Grove Green Rd, London E11 4EJ', NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '75.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '5bb9bf405d20cc8c31779ca4fad4b30a', NULL, NULL, NULL, NULL, NULL, '2023-05-13 13:39:33', '2023-05-13 13:39:33'),
(13, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 35, NULL, 'Dtraft2023/0007', '', NULL, NULL, NULL, '2023-05-13 14:39:00', '75.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, '72 Grove Green Rd, London E11 4EJ', NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '75.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '269b311cd236b466c3427832a9fc1dd8', NULL, NULL, NULL, NULL, NULL, '2023-05-13 13:41:00', '2023-05-13 13:41:00'),
(14, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 35, NULL, 'Dtraft2023/0008', '', NULL, NULL, NULL, '2023-05-13 14:41:00', '75.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, '72 Grove Green Rd, London E11 4EJ', NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '75.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'a53b15c434a58a78cf3776257ce76d4c', NULL, NULL, NULL, NULL, NULL, '2023-05-13 13:42:30', '2023-05-13 13:42:30'),
(15, 6, 2, NULL, 31, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 35, NULL, 'Dtraft2023/0009', '', NULL, NULL, NULL, '2023-05-25 08:47:00', '540.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, '72 Grove Green Rd, London E11 4EJ', NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '540.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '0bc238db8eb7941f654dec9b5122e15d', NULL, NULL, NULL, NULL, NULL, '2023-05-25 07:48:50', '2023-05-25 07:48:50'),
(16, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 35, NULL, 'Dtraft2023/0010', '', NULL, NULL, NULL, '2023-06-03 10:46:00', '500.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, '72 Grove Green Rd, London E11 4EJ', NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '500.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'cf4cbc16eeff6ed03e0c82c5c3f81e0d', NULL, NULL, NULL, NULL, NULL, '2023-06-03 09:48:36', '2023-06-03 09:48:36'),
(18, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 3, NULL, 'Dtraft2023/0012', '', NULL, NULL, NULL, '2023-06-19 15:22:00', '1616000000.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '1616000000.0000', NULL, NULL, NULL, NULL, NULL, 1, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'ccdef2026e82bb81437da63659babe1d', NULL, NULL, NULL, NULL, NULL, '2023-06-19 14:23:25', '2023-06-19 14:23:25'),
(22, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'partial', NULL, 39, NULL, '0008', '', NULL, NULL, NULL, '2023-07-14 19:14:00', '80.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'Service includes:\r\n•    Finding properties on behalf of Tenant\r\n•    Scheduling booking for the inspection of properties\r\n•    Processing documents for the tenancy agreement with landlord\r\n\r\nCost includes: Our consultancy fee for finding your dream home—\r\n•    Property dealing time 30 days\r\n•    £20 is booking fee. (The booking fee includes 3 properties viewing. If failed to do so 100% money refunded after property dealing period)\r\n•    £80 (per room) and £300 (per flat)\r\n\r\nCompany Bank details:\r\nAccount Name: Unipuller Ltd\r\nAccount Number: 20378125\r\nSort code: 04-06-05', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '80.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'de14593d08381097264aed2a23b69af7', NULL, NULL, NULL, NULL, NULL, '2023-07-14 18:18:16', '2023-07-18 11:33:42'),
(23, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'due', NULL, 40, NULL, '0009', '', NULL, NULL, NULL, '2023-07-15 17:27:00', '95.0000', NULL, '0.0000', 'percentage', '10.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'Service includes: \r\n1.	Finding properties on behalf of Tenant. \r\n2.	Scheduling booking for the inspection of properties \r\n3.	Processing documents for the tenancy agreement with landlord \r\n4.	Customers will get 3 free physical property viewings \r\n\r\nCost includes: Our consultancy fee for finding your dream home— \r\n1.	£20 is booking fee of total service cost which need to be paid upfront. Rest of the service fee required to be paid after getting property. \r\n2.	The booking fee includes 10 virtual property viewings from our property lists \r\n3.	£70 (per seat) £95 (per room) and £297 (per flat) \r\n\r\nContract duration: \r\nUnipuller is committed to provide premium service within promised time. The time that Unipuller is committing to provide service will be considered as service duration agreement.\r\n•	Property dealing time 30 days\r\n\r\n\r\nTerms and conditions: \r\nTerms and conditions are some rules and regulations set by Unipuller in which customers are agreed to abide by. Any future disputes and conflicts will be resolved according to the terms and conditions.\r\n1.	Once customers paid the booking fee, the service will be activated and will remain active next 30 days\r\n2.	Customers can cancel their bookings withing 24 hours\r\n3.	Booking cancellation time will be counted from the time of payment to point of time when cancellation will be confirmed.\r\n4.	Due service fee will be paid by customer after getting the property \r\n5.	If booking time exceed 24 hours and customer cancel the service, then customer will not be eligible for the refund of booking fees \r\n6.	Customer will get 10 virtual viewings of properties \r\n7.	Customer will have to pay booking fee again if they exceed their virtual view allowance\r\n8.	3 free physical property viewings will not be considered for booking fee refund\r\n9.	Customers will not be eligible for refund of booking fee once they exceed the virtual property viewings allowance\r\n10.	 Customer will get 100% money refund If we fail to provide 10 virtual property viewing \r\n\r\nRefund of service fee:\r\n1.	Eligible customers will get booking fee refund after agreed service providing time (30 days)\r\n2.	Customers who cancelled booking within 24 hours will get refund withing 7 working days\r\n\r\nCompany Bank details: \r\nAccount Name: Unipuller Ltd \r\nAccount Number: 20378125 \r\nSort code: 04-06-05', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '85.5000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'd90a7954dcbe9aba00c55dc8bf61a3e7', NULL, NULL, NULL, NULL, NULL, '2023-07-15 16:30:39', '2023-07-15 16:30:39'),
(24, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'due', NULL, 41, NULL, '0010', '', NULL, NULL, NULL, '2023-07-15 17:30:00', '70.0000', NULL, '0.0000', 'percentage', '10.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'Service includes: \r\n1.	Finding properties on behalf of Tenant. \r\n2.	Scheduling booking for the inspection of properties \r\n3.	Processing documents for the tenancy agreement with landlord \r\n4.	Customers will get 3 free physical property viewings \r\n\r\nCost includes: Our consultancy fee for finding your dream home— \r\n1.	£20 is booking fee of total service cost which need to be paid upfront. Rest of the service fee required to be paid after getting property. \r\n2.	The booking fee includes 10 virtual property viewings from our property lists \r\n3.	£70 (per seat) £95 (per room) and £297 (per flat) \r\n\r\nContract duration: \r\nUnipuller is committed to provide premium service within promised time. The time that Unipuller is committing to provide service will be considered as service duration agreement.\r\n•	Property dealing time 30 days\r\n\r\n\r\nTerms and conditions: \r\nTerms and conditions are some rules and regulations set by Unipuller in which customers are agreed to abide by. Any future disputes and conflicts will be resolved according to the terms and conditions.\r\n1.	Once customers paid the booking fee, the service will be activated and will remain active next 30 days\r\n2.	Customers can cancel their bookings withing 24 hours\r\n3.	Booking cancellation time will be counted from the time of payment to point of time when cancellation will be confirmed.\r\n4.	Due service fee will be paid by customer after getting the property \r\n5.	If booking time exceed 24 hours and customer cancel the service, then customer will not be eligible for the refund of booking fees \r\n6.	Customer will get 10 virtual viewings of properties \r\n7.	Customer will have to pay booking fee again if they exceed their virtual view allowance\r\n8.	3 free physical property viewings will not be considered for booking fee refund\r\n9.	Customers will not be eligible for refund of booking fee once they exceed the virtual property viewings allowance\r\n10.	 Customer will get 100% money refund If we fail to provide 10 virtual property viewing \r\n\r\nRefund of service fee:\r\n1.	Eligible customers will get booking fee refund after agreed service providing time (30 days)\r\n2.	Customers who cancelled booking within 24 hours will get refund withing 7 working days\r\n\r\nCompany Bank details: \r\nAccount Name: Unipuller Ltd \r\nAccount Number: 20378125 \r\nSort code: 04-06-05', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '63.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'c9acc997a7f6cf20077993c4ad065617', NULL, NULL, NULL, NULL, 0, '2023-07-15 16:37:56', '2023-07-15 16:37:57'),
(25, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'partial', NULL, 42, NULL, '0011', '', NULL, NULL, NULL, '2023-07-15 17:37:00', '297.0000', NULL, '0.0000', 'fixed', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'Service includes: \r\n1.	Finding properties on behalf of Tenant. \r\n2.	Scheduling booking for the inspection of properties \r\n3.	Processing documents for the tenancy agreement with landlord \r\n4.	Customers will get 3 free physical property viewings \r\n\r\nCost includes: Our consultancy fee for finding your dream home— \r\n1.	£20 is booking fee of total service cost which need to be paid upfront. Rest of the service fee required to be paid after getting property. \r\n2.	The booking fee includes 10 virtual property viewings from our property lists \r\n3.	£70 (per seat) £95 (per room) and £297 (per flat) \r\n\r\nContract duration: \r\nUnipuller is committed to provide premium service within promised time. The time that Unipuller is committing to provide service will be considered as service duration agreement.\r\n•	Property dealing time 30 days\r\n\r\n\r\nTerms and conditions: \r\nTerms and conditions are some rules and regulations set by Unipuller in which customers are agreed to abide by. Any future disputes and conflicts will be resolved according to the terms and conditions.\r\n1.	Once customers paid the booking fee, the service will be activated and will remain active next 30 days\r\n2.	Customers can cancel their bookings withing 24 hours\r\n3.	Booking cancellation time will be counted from the time of payment to point of time when cancellation will be confirmed.\r\n4.	Due service fee will be paid by customer after getting the property \r\n5.	If booking time exceed 24 hours and customer cancel the service, then customer will not be eligible for the refund of booking fees \r\n6.	Customer will get 10 virtual viewings of properties \r\n7.	Customer will have to pay booking fee again if they exceed their virtual view allowance\r\n8.	3 free physical property viewings will not be considered for booking fee refund\r\n9.	Customers will not be eligible for refund of booking fee once they exceed the virtual property viewings allowance\r\n10.	 Customer will get 100% money refund If we fail to provide 10 virtual property viewing \r\n\r\nRefund of service fee:\r\n1.	Eligible customers will get booking fee refund after agreed service providing time (30 days)\r\n2.	Customers who cancelled booking within 24 hours will get refund withing 7 working days\r\n\r\nCompany Bank details: \r\nAccount Name: Unipuller Ltd \r\nAccount Number: 20378125 \r\nSort code: 04-06-05', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '297.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '1d859827b21bf3f876f05c13aea8c39d', NULL, NULL, NULL, NULL, NULL, '2023-07-15 16:56:54', '2023-07-18 10:53:38'),
(27, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'partial', NULL, 43, NULL, '0013', '', NULL, NULL, NULL, '2023-07-17 18:17:00', '299.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'All our services are premium and to get the service, customers need to pay booking fee upfront. Once customers\r\npaid the booking fee, their service will be activated for next 30 days. We are promised to deliver the service within\r\n30 days.\r\nRefund:\r\n• Against £10 booking fee, you will get 5 virtual/physical property viewings\r\n• Customers can cancel bookings within 24 hours from booking time and get 100% money refund within 7\r\nworking days\r\n• If customers cancel booking after 24 hours, then they will not be eligible for the refund\r\n• Customers will get 100% fee refund if they don’t receive 5 virtual/physical properties viewing within\r\ncontract duration.', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '299.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'e5a7c97cc93bd42305c998c4cd03160c', NULL, NULL, NULL, NULL, NULL, '2023-07-17 17:18:43', '2023-07-17 18:03:37'),
(28, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'paid', NULL, 44, NULL, '0014', '', NULL, NULL, NULL, '2023-07-17 19:11:00', '95.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'Unit 1a, Nagpal House, 1 Gunthorpe, E1 7RG', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '95.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'b21718b28c68e6f7861708973afbf13f', NULL, NULL, NULL, NULL, 0, '2023-07-17 18:14:07', '2023-07-17 22:55:05'),
(29, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 2, NULL, 'Dtraft2023/0014', '', NULL, NULL, NULL, '2023-07-17 19:27:00', '70.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '70.0000', NULL, NULL, NULL, NULL, NULL, 1, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, 'fa5687a0b3c218256a778a110a58721a', NULL, NULL, NULL, NULL, NULL, '2023-07-17 18:31:37', '2023-07-17 18:31:37'),
(30, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'paid', NULL, 6, NULL, '0015', '', NULL, NULL, NULL, '2023-07-17 23:57:00', '5.5000', NULL, '0.0000', 'percentage', '20.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '4.4000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '6e1b67ed070d20bfbefd9d4f2b717b04', NULL, NULL, NULL, NULL, NULL, '2023-07-17 22:57:53', '2023-07-18 03:30:23'),
(31, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'final', NULL, 0, 'partial', NULL, 6, NULL, '0016', '', NULL, NULL, NULL, '2023-07-18 01:20:00', '95.0000', NULL, '0.0000', 'percentage', '20.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '76.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '4a731989c11f60d3dd6c3373618d0d8b', NULL, NULL, NULL, NULL, NULL, '2023-07-18 00:21:47', '2023-07-18 00:21:47'),
(32, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 44, NULL, 'Dtraft2023/0015', '', NULL, NULL, NULL, '2023-07-18 01:21:00', '95.0000', NULL, '0.0000', 'percentage', '20.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '76.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '93145088931abbdcbb6a40928962012d', NULL, NULL, NULL, NULL, NULL, '2023-07-18 00:23:07', '2023-07-18 00:23:07'),
(33, 6, 2, NULL, NULL, NULL, 'sales_order', NULL, 'partial', NULL, 0, NULL, NULL, 3, NULL, 'OR-2023/0002', '', NULL, NULL, NULL, '2023-07-18 22:46:24', '405.5000', NULL, '0.0000', NULL, '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, 'jkhkjk', NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '405.5000', NULL, NULL, NULL, NULL, NULL, 1, 0, '1.000', NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 1, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 21:46:24', '2023-07-18 22:02:36'),
(34, 6, 2, NULL, NULL, NULL, 'expense', NULL, 'final', NULL, 0, 'due', NULL, NULL, NULL, NULL, 'EP2023/0001', NULL, NULL, NULL, '2023-07-18 23:06:00', '50.0000', NULL, '0.0000', NULL, '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '50.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 22:10:29', '2023-07-18 22:10:29'),
(35, 6, 2, NULL, NULL, NULL, 'sales_order', NULL, 'ordered', NULL, 0, NULL, NULL, 6, NULL, 'OR-2023/0003', '', NULL, NULL, NULL, '2023-07-19 01:05:14', '405.5000', NULL, '0.0000', NULL, '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '405.5000', NULL, NULL, NULL, NULL, NULL, 1, 0, '1.000', NULL, NULL, NULL, NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 1, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-19 00:05:14', '2023-07-19 00:05:14'),
(36, 6, 2, NULL, NULL, NULL, 'sell', NULL, 'draft', 'quotation', 1, NULL, NULL, 44, NULL, 'Dtraft2023/0016', '', NULL, NULL, NULL, '2023-07-19 05:15:00', '70.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '70.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '0.0000', 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, 1.0000, 'days', 0, NULL, NULL, '9f7eb9edde923dc005b2bcf6496d0e64', NULL, NULL, NULL, NULL, NULL, '2023-07-19 04:19:31', '2023-07-19 04:19:31'),
(37, 6, 2, NULL, NULL, NULL, 'sell_return', NULL, 'final', NULL, 0, 'paid', NULL, 6, NULL, 'CN2023/0001', NULL, NULL, NULL, NULL, '2023-07-19 05:26:00', '0.0000', NULL, '0.0000', 'percentage', '0.0000', 0, '0.0000', NULL, NULL, NULL, NULL, NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', NULL, '0.0000', '0.0000', NULL, NULL, NULL, NULL, NULL, 0, 0, '1.000', NULL, NULL, 31, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '0.0000', 'percentage', 0, 0, NULL, '0.00', NULL, '0.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-19 04:28:01', '2023-07-19 04:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_payments`
--

CREATE TABLE `transaction_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(11) UNSIGNED DEFAULT NULL,
  `business_id` int(11) DEFAULT NULL,
  `is_return` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Used during sales to return the change',
  `amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_month` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_security` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `paid_through_link` tinyint(1) NOT NULL DEFAULT 0,
  `gateway` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_advance` tinyint(1) NOT NULL DEFAULT 0,
  `payment_for` int(11) DEFAULT NULL COMMENT 'stores the contact id',
  `parent_id` int(11) DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_ref_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_payments`
--

INSERT INTO `transaction_payments` (`id`, `transaction_id`, `business_id`, `is_return`, `amount`, `method`, `payment_type`, `transaction_no`, `card_transaction_number`, `card_number`, `card_type`, `card_holder_name`, `card_month`, `card_year`, `card_security`, `cheque_number`, `bank_account_number`, `paid_on`, `created_by`, `paid_through_link`, `gateway`, `is_advance`, `payment_for`, `parent_id`, `note`, `document`, `payment_ref_no`, `account_id`, `created_at`, `updated_at`) VALUES
(1, 4, 6, 0, '100000000.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 16:52:50', 6, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2023/0001', NULL, '2023-04-25 15:52:50', '2023-04-25 15:52:50'),
(2, 6, 6, 0, '100000000.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 16:56:09', 6, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2023/0002', NULL, '2023-04-25 15:56:09', '2023-04-25 15:56:09'),
(3, 7, 6, 0, '100000000.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 16:58:09', 6, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2023/0003', NULL, '2023-04-25 15:58:09', '2023-04-25 15:58:09'),
(4, 8, 6, 0, '100000000.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 17:19:38', 6, 0, NULL, 0, 2, NULL, NULL, NULL, 'SP2023/0004', NULL, '2023-04-25 16:19:38', '2023-04-25 16:19:38'),
(5, 9, 6, 0, '100.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 20:59:00', 6, 0, NULL, 0, 3, NULL, NULL, NULL, 'SP2023/0005', NULL, '2023-04-25 20:00:07', '2023-04-25 20:00:07'),
(8, 27, 6, 0, '20.0000', 'bank_transfer', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 18:18:43', 6, 0, NULL, 0, 43, NULL, NULL, NULL, 'SP2023/0008', 1, '2023-07-17 17:18:43', '2023-07-17 18:03:37'),
(9, 28, 6, 0, '0.5000', 'card', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 19:14:07', 6, 0, NULL, 0, 44, NULL, NULL, NULL, 'SP2023/0009', 1, '2023-07-17 18:14:07', '2023-07-17 18:14:07'),
(10, 28, 6, 0, '94.5000', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-17 23:55:05', NULL, 1, 'stripe', 0, 44, NULL, 'ch_3NUw6VK8fIrCHSSq1QC5h6IO', NULL, 'SP2023/0010', NULL, '2023-07-17 22:55:05', '2023-07-17 22:55:05'),
(11, 30, 6, 0, '4.4000', 'cash', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 04:30:23', NULL, 1, 'stripe', 0, 6, NULL, 'ch_3NV0OvK8fIrCHSSq0xAIABRe', NULL, 'SP2023/0011', NULL, '2023-07-18 03:30:23', '2023-07-18 03:30:23'),
(12, 31, 6, 0, '5.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 01:21:47', 6, 0, NULL, 0, 6, NULL, NULL, NULL, 'SP2023/0012', NULL, '2023-07-18 00:21:47', '2023-07-18 00:21:47'),
(13, 25, 6, 0, '20.0000', 'cash', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 11:53:38', 6, 0, NULL, 0, 42, NULL, NULL, NULL, 'SP2023/0013', NULL, '2023-07-18 10:53:38', '2023-07-18 10:53:38'),
(14, 22, 6, 0, '20.0000', 'bank_transfer', NULL, NULL, NULL, NULL, 'credit', NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-18 12:32:10', 6, 0, NULL, 0, 39, NULL, NULL, NULL, 'SP2023/0014', 1, '2023-07-18 11:32:10', '2023-07-18 11:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sell_lines`
--

CREATE TABLE `transaction_sell_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `transaction_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `mfg_waste_percent` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `secondary_unit_quantity` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `quantity_returned` decimal(20,4) NOT NULL DEFAULT 0.0000,
  `unit_price_before_discount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price` decimal(22,4) DEFAULT NULL COMMENT 'Sell price excluding tax',
  `line_discount_type` enum('fixed','percentage') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_discount_amount` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `unit_price_inc_tax` decimal(22,4) DEFAULT NULL COMMENT 'Sell price including tax',
  `item_tax` decimal(22,4) NOT NULL COMMENT 'Tax for one quantity',
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `lot_no_line_id` int(11) DEFAULT NULL,
  `sell_line_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woocommerce_line_items_id` int(11) DEFAULT NULL,
  `so_line_id` int(11) DEFAULT NULL,
  `so_quantity_invoiced` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `res_service_staff_id` int(11) DEFAULT NULL,
  `res_line_order_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_sell_line_id` int(11) DEFAULT NULL,
  `children_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'Type of children for the parent, like modifier or combo',
  `sub_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_sell_lines`
--

INSERT INTO `transaction_sell_lines` (`id`, `transaction_id`, `product_id`, `variation_id`, `quantity`, `mfg_waste_percent`, `secondary_unit_quantity`, `quantity_returned`, `unit_price_before_discount`, `unit_price`, `line_discount_type`, `line_discount_amount`, `unit_price_inc_tax`, `item_tax`, `tax_id`, `discount_id`, `lot_no_line_id`, `sell_line_note`, `woocommerce_line_items_id`, `so_line_id`, `so_quantity_invoiced`, `res_service_staff_id`, `res_line_order_status`, `parent_sell_line_id`, `children_type`, `sub_unit_id`, `created_at`, `updated_at`) VALUES
(11, 10, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '75.0000', '75.0000', 'fixed', '0.0000', '75.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-05-13 12:29:52', '2023-05-13 13:15:02'),
(13, 12, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '75.0000', '75.0000', 'fixed', '0.0000', '75.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-05-13 13:39:33', '2023-05-13 13:39:33'),
(14, 13, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '75.0000', '75.0000', 'fixed', '0.0000', '75.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-05-13 13:41:00', '2023-05-13 13:41:00'),
(15, 14, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '75.0000', '75.0000', 'fixed', '0.0000', '75.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-05-13 13:42:30', '2023-05-13 13:42:30'),
(16, 15, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '540.0000', '540.0000', 'fixed', '0.0000', '540.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-05-25 07:48:50', '2023-05-25 07:48:50'),
(17, 16, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '500.0000', '500.0000', 'fixed', '0.0000', '500.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-06-03 09:48:36', '2023-06-03 09:48:36'),
(19, 18, 3, 3, '1.0000', '0.0000', '0.0000', '0.0000', '1616000000.0000', '1616000000.0000', 'fixed', '0.0000', '1616000000.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-06-19 14:23:25', '2023-06-19 14:23:25'),
(23, 22, 5, 5, '1.0000', '0.0000', '0.0000', '0.0000', '80.0000', '80.0000', 'fixed', '0.0000', '80.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-14 18:18:17', '2023-07-18 11:33:42'),
(24, 23, 5, 5, '1.0000', '0.0000', '0.0000', '0.0000', '95.0000', '95.0000', 'fixed', '0.0000', '95.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-15 16:30:39', '2023-07-15 16:30:39'),
(25, 24, 6, 6, '1.0000', '0.0000', '0.0000', '0.0000', '70.0000', '70.0000', 'fixed', '0.0000', '70.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-15 16:37:56', '2023-07-15 16:37:56'),
(26, 25, 7, 7, '1.0000', '0.0000', '0.0000', '0.0000', '297.0000', '297.0000', 'fixed', '0.0000', '297.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-15 16:56:54', '2023-07-18 10:53:38'),
(28, 27, 7, 7, '1.0000', '0.0000', '0.0000', '0.0000', '299.0000', '299.0000', 'fixed', '0.0000', '299.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-17 17:18:43', '2023-07-17 18:03:37'),
(29, 28, 5, 5, '1.0000', '0.0000', '0.0000', '0.0000', '95.0000', '95.0000', 'fixed', '0.0000', '95.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-17 18:14:07', '2023-07-17 18:14:07'),
(30, 29, 6, 6, '1.0000', '0.0000', '0.0000', '0.0000', '70.0000', '70.0000', 'fixed', '0.0000', '70.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-17 18:31:37', '2023-07-17 18:31:37'),
(31, 30, 8, 8, '1.0000', '0.0000', '0.0000', '0.0000', '5.5000', '5.5000', 'fixed', '0.0000', '5.5000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-17 22:57:53', '2023-07-17 22:57:53'),
(32, 31, 5, 5, '1.0000', '0.0000', '0.0000', '0.0000', '95.0000', '95.0000', 'fixed', '0.0000', '95.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-18 00:21:47', '2023-07-19 04:28:01'),
(33, 32, 5, 5, '1.0000', '0.0000', '0.0000', '0.0000', '95.0000', '95.0000', 'fixed', '0.0000', '95.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-18 00:23:07', '2023-07-18 00:23:07'),
(34, 33, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '405.5000', '405.5000', 'fixed', '0.0000', '405.5000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-18 21:46:24', '2023-07-18 21:46:24'),
(35, 35, 4, 4, '1.0000', '0.0000', '0.0000', '0.0000', '405.5000', '405.5000', 'fixed', '0.0000', '405.5000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-19 00:05:14', '2023-07-19 00:05:14'),
(36, 36, 6, 6, '1.0000', '0.0000', '0.0000', '0.0000', '70.0000', '70.0000', 'fixed', '0.0000', '70.0000', '0.0000', NULL, NULL, NULL, '', NULL, NULL, '0.0000', NULL, NULL, NULL, '', NULL, '2023-07-19 04:19:31', '2023-07-19 04:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_sell_lines_purchase_lines`
--

CREATE TABLE `transaction_sell_lines_purchase_lines` (
  `id` int(10) UNSIGNED NOT NULL,
  `sell_line_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id from transaction_sell_lines',
  `stock_adjustment_line_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'id from stock_adjustment_lines',
  `purchase_line_id` int(10) UNSIGNED NOT NULL COMMENT 'id from purchase_lines',
  `quantity` decimal(22,4) NOT NULL,
  `qty_returned` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_sell_lines_purchase_lines`
--

INSERT INTO `transaction_sell_lines_purchase_lines` (`id`, `sell_line_id`, `stock_adjustment_line_id`, `purchase_line_id`, `quantity`, `qty_returned`, `created_at`, `updated_at`) VALUES
(1, 25, NULL, 0, '1.0000', '0.0000', '2023-07-15 16:37:57', '2023-07-15 16:37:57'),
(2, 26, NULL, 0, '1.0000', '0.0000', '2023-07-15 16:56:54', '2023-07-15 16:56:54'),
(4, 28, NULL, 0, '1.0000', '0.0000', '2023-07-17 17:18:43', '2023-07-17 17:18:43'),
(5, 31, NULL, 0, '1.0000', '0.0000', '2023-07-17 22:57:53', '2023-07-17 22:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `types_of_services`
--

CREATE TABLE `types_of_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(11) NOT NULL,
  `location_price_group` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packing_charge` decimal(22,4) DEFAULT NULL,
  `packing_charge_type` enum('fixed','percent') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enable_custom_fields` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types_of_services`
--

INSERT INTO `types_of_services` (`id`, `name`, `description`, `business_id`, `location_price_group`, `packing_charge`, `packing_charge_type`, `enable_custom_fields`, `created_at`, `updated_at`) VALUES
(1, 'Study Abroad Consultancy', NULL, 6, '{\"2\":\"0\"}', '0.0000', 'fixed', 1, '2023-03-31 23:44:27', '2023-03-31 23:44:27'),
(2, 'UIT', NULL, 6, '{\"2\":\"0\"}', '0.0000', 'fixed', 0, '2023-03-31 23:45:15', '2023-03-31 23:45:15'),
(3, 'General', NULL, 6, '{\"2\":\"0\"}', '0.0000', 'fixed', 0, '2023-04-01 00:14:10', '2023-04-01 00:14:10'),
(4, 'Marketing Consultancy', NULL, 6, '{\"2\":\"0\"}', '0.0000', 'fixed', 0, '2023-05-13 11:43:22', '2023-05-13 11:43:22'),
(5, 'Tenancy service', NULL, 6, '{\"2\":\"0\"}', '0.0000', 'fixed', 0, '2023-07-18 12:06:39', '2023-07-18 12:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `actual_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allow_decimal` tinyint(1) NOT NULL,
  `base_unit_id` int(11) DEFAULT NULL,
  `base_unit_multiplier` decimal(20,4) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `business_id`, `actual_name`, `short_name`, `allow_decimal`, `base_unit_id`, `base_unit_multiplier`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, 'Pieces', 'Pc(s)', 0, NULL, NULL, 5, NULL, '2023-03-17 01:17:16', '2023-03-17 01:17:16'),
(2, 6, 'Pieces', 'Pc(s)', 0, NULL, NULL, 6, NULL, '2023-03-26 00:30:53', '2023-03-26 00:30:53'),
(3, 7, 'Pieces', 'Pc(s)', 0, NULL, NULL, 27, NULL, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(4, 8, 'Pieces', 'Pc(s)', 0, NULL, NULL, 33, NULL, '2023-06-13 01:20:59', '2023-06-13 01:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `surname` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `contact_no` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_id` int(10) UNSIGNED DEFAULT NULL,
  `essentials_department_id` int(11) DEFAULT NULL,
  `essentials_designation_id` int(11) DEFAULT NULL,
  `essentials_salary` decimal(22,4) DEFAULT NULL,
  `essentials_pay_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `essentials_pay_cycle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_at` datetime DEFAULT NULL COMMENT 'Service staff avilable at. Calculated from product preparation_time_in_minutes',
  `paused_at` datetime DEFAULT NULL COMMENT 'Service staff available time paused at, Will be nulled on resume.',
  `max_sales_discount_percent` decimal(5,2) DEFAULT NULL,
  `allow_login` tinyint(1) NOT NULL DEFAULT 1,
  `status` enum('active','inactive','terminated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `crm_contact_id` int(10) UNSIGNED DEFAULT NULL,
  `is_cmmsn_agnt` tinyint(1) NOT NULL DEFAULT 0,
  `cmmsn_percent` decimal(4,2) NOT NULL DEFAULT 0.00,
  `selected_contacts` tinyint(1) NOT NULL DEFAULT 0,
  `dob` date DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` enum('married','unmarried','divorced') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_media_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_media_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_field_4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proof_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proof_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `crm_department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Contact person''s department',
  `crm_designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Contact person''s designation',
  `location_id` int(11) DEFAULT NULL COMMENT 'user primary work location',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `surname`, `first_name`, `last_name`, `username`, `email`, `password`, `language`, `contact_no`, `address`, `remember_token`, `business_id`, `essentials_department_id`, `essentials_designation_id`, `essentials_salary`, `essentials_pay_period`, `essentials_pay_cycle`, `available_at`, `paused_at`, `max_sales_discount_percent`, `allow_login`, `status`, `crm_contact_id`, `is_cmmsn_agnt`, `cmmsn_percent`, `selected_contacts`, `dob`, `gender`, `marital_status`, `blood_group`, `contact_number`, `alt_number`, `family_number`, `fb_link`, `twitter_link`, `social_media_1`, `social_media_2`, `permanent_address`, `current_address`, `guardian_name`, `custom_field_1`, `custom_field_2`, `custom_field_3`, `custom_field_4`, `bank_details`, `id_proof_name`, `id_proof_number`, `crm_department`, `crm_designation`, `location_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 'user', 'Mr', 'Trinath', 'Saha', 'admin', 'admin@gmail.com', '$2y$10$ZJUgxnQR54MA0gwiqoW58u8oDy7uMe4XAYnVxWhlA9eQpzypA60/W', 'en', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 10, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-17 01:17:15', '2023-03-17 01:17:15'),
(6, 'user', 'Mr', 'Polash', 'Mia', 'Unipuller', 'unipullerltd@gmail.com', '$2y$10$ouNkGD9uG97B0qZaNHuukO/SLOGqE6rOQRhEFJOfqAQfpdbruI3ri', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, 'month', NULL, NULL, NULL, '10.00', 1, 'active', NULL, 0, '10.00', 0, NULL, 'male', 'unmarried', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-26 00:30:53', '2023-03-25 21:29:32'),
(7, 'user', 'Mr', 'Shahed', 'Ahmed', 'Shahed', 'shahed.unipuller@gmail.com', '$2y$10$WXVHoI3DU1DV7OiL5YBz9.ef34diAoBCpXUoPuZr3f4wZOfKee.WW', 'en', NULL, NULL, NULL, 6, 19, 7, '5000.0000', 'month', NULL, NULL, NULL, '999.99', 1, 'active', NULL, 0, '99.99', 0, NULL, 'male', 'married', 'B+', '+8801893466346', NULL, NULL, 'https://www.facebook.com/profile.php?id=100087855957009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, 2, NULL, '2023-03-27 02:20:59', '2023-04-02 18:54:01'),
(8, 'user', 'Mr', 'Afzal', 'Hossain', 'Afzal', 'afzaljnups@gmail.com', '$2y$10$FTOrlB4dEWd9VXktlJ6g3.k.HlagVSUDt4HnyWJ6kWgf7GscL7SiK', 'en', NULL, NULL, 'wLspMNP0Hfi7cS2m4mRdSpxzGjeY7j04amCzvmrwOVkscl4ucKV87YQ3LUy1', 6, 3, 15, '0.0000', 'month', NULL, NULL, NULL, '999.99', 1, 'active', NULL, 0, '99.99', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, 2, NULL, '2023-03-27 03:12:44', '2023-03-27 04:35:37'),
(9, 'user', 'Mr', 'Shahadat', 'Hossain', 'Shahadat', 'shahdathossain583@gmail.com', '$2y$10$UHW82i1a0SHId2YnxiEEl.gtON8MW6teFBIJjemaKPZRWJZaIveHK', 'en', NULL, NULL, '5B9nxdaxfB0nCx1Lz2P1tBSSXLfPjhUY6eSUC4rWDzHFRD68fC4Cwp0eUv7t', 6, 19, 10, NULL, 'month', NULL, NULL, NULL, '10.00', 1, 'active', NULL, 0, '10.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, 2, NULL, '2023-03-27 15:36:54', '2023-03-31 23:00:27'),
(10, 'user_customer', 'Mr', 'Ruhul', 'Alam', 'Ruhul', 'ruhulalam1214@gmail.com', '$2y$10$Qa0.r2EjC6k6zyDIsXDWheNjlTcZJaTCWV30FRrrjla45LDLXcXyu', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 3, 0, '0.00', 0, NULL, NULL, NULL, NULL, '+44 7830 328885', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Business development', 'Director', NULL, NULL, '2023-03-28 17:24:49', '2023-04-25 19:07:36'),
(11, 'user', 'Mr', 'Afzal', 'Hossain', NULL, 'afzaljnups@gmail.com', NULL, 'en', '+8801764073169', NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, 1, '5.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-30 01:35:13', '2023-03-30 01:36:25'),
(12, 'user_customer', 'Mr', 'Ruhul', 'gsd', 'shahajd', NULL, '$2y$10$mrZnfNPOx/wTi4Jb4HyPtuaJttcqmandPDL6Sa.FnPaO.WC.Ys7pe', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 4, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-03-31 06:09:19', '2023-03-31 06:09:19'),
(14, 'user_customer', 'Mr', 'Dr Shah', 'Siddiqui', 'Siddiqui', 'shah.siddiqui@timerni.com', '$2y$10$CJP9f.PUU2qcu6Xq4pbZdelnoGVwLOjlM3k58HWAI9BeOvBNoxB6K', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 9, 0, '0.00', 0, NULL, NULL, NULL, NULL, '07554823078', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'AI Technology', 'Director', NULL, NULL, '2023-04-02 15:09:20', '2023-04-02 15:09:20'),
(15, 'user_customer', 'Mr', 'Dr Mohammad', 'Shafiq', 'Shafiq', 'shafiq.london@gmail.com', '$2y$10$b1wwRCAX.iLHkyWPmRYhi.f.VEpfonLdloU3VR91vh4FH3I6EtA2K', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 11, 0, '0.00', 0, NULL, NULL, NULL, NULL, '07757408797', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Education consultancy service', 'Director', NULL, NULL, '2023-04-02 18:57:14', '2023-04-26 21:22:06'),
(16, 'user_customer', 'Mr', 'Niaj', NULL, 'Niaj0007', 'mamamojapailam913@gmail.com', '$2y$10$HRV12.rrqmksN5mywkkPo.B5RrmZjd9WZaO7gFFZ14Y5ZJbgXLMO2', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 12, 0, '0.00', 0, NULL, NULL, NULL, NULL, '01322064403', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-02 19:47:02', '2023-04-02 19:47:02'),
(17, 'user_customer', 'Mr', 'Dress', 'Mart', 'Dressmart', 'imdressmart@gmail.com', '$2y$10$qx3S8.ffDZYE9ZevPO.uI.sAlzqv8nMLGYCf3AxcAwIRQ5SJlD5PK', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 13, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, '01747261325', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-03 07:01:13', '2023-04-03 07:01:13'),
(21, 'user_customer', 'mr', 'new', 'test', NULL, 'newtest@gmail.com', NULL, 'en', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'active', NULL, 0, '0.00', 0, NULL, NULL, NULL, NULL, '00011122211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'newtest', 'test', NULL, NULL, '2023-04-03 12:12:49', '2023-04-03 12:12:49'),
(23, 'user_customer', 'test', 'test', 'trinath', 'testtrinath', 'testtrinath@gmail.com', '$2y$10$7zEEEazWvWaB4Ut3yQA6jeHxLyhrNaUzi5NoGQ3oGLzr.EnfW3wGe', 'en', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 28, 0, '0.00', 0, NULL, NULL, NULL, NULL, '00001112222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-07 10:49:59', '2023-04-24 21:23:10'),
(24, 'user', 'Mr', 'Pabel', 'Hanif', 'Pabel', 'bondhupabel@gmail.com', '$2y$10$7X3sTEl2Ef6H7a16JeyKTOggyJ5nxrzkAbajYElBpFYu4aSh.cwzq', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, 'month', NULL, NULL, NULL, NULL, 1, 'active', NULL, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 12:17:57', '2023-04-13 12:17:57'),
(25, 'user', 'Mr', 'Trinath', 'Saha', 'Trinath', 'trinathsaha.cse@gmail.com', '$2y$10$RMcSIL1TGt0idJk.plecguacOFQx1GVtnFhkJXE3t4aRyfJ706htS', 'en', NULL, NULL, NULL, 6, 18, 11, NULL, 'month', NULL, NULL, NULL, NULL, 1, 'active', NULL, 0, '0.00', 0, NULL, 'male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 12:28:33', '2023-04-13 12:28:33'),
(26, 'user_customer', 'Mr', 'Saeeduzzaman', NULL, 'Saeed', 'saeed.humanist@gmail.com', '$2y$10$7bla.fgFI8bsWz/lBn/42O8IAfl.m3MuVp8FLotgvanlLXkTA3nIa', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 29, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-13 20:24:53', '2023-04-13 20:24:53'),
(27, 'user', 's', 's', 's', 'sheikh', 'nman0171@gmail.com', '$2y$10$ed4h9I2AWknitGEuLhXI0efVPGF/i0JUM3nYwx4KFjUxPE8ui2Om.', 'en', NULL, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', NULL, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 00:03:26', '2023-04-25 00:03:26'),
(28, 'user_customer', 'Mrs', 'Mridula', 'Islam', 'Mridula', 'mridulai62@gmail.com', '$2y$10$Id9EiXOq48tz.ttc4XBW8uk0jKpUSQ9oQ04mXSlDb5AF2OwVJfnmq', 'en', NULL, NULL, 'UVwvEkqat8AKtAlVRZDCUKeB5pDDgxJ9HWDjA3hUzEz1yqpRuVy88bHFT1WM', 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 7, 0, '0.00', 0, NULL, NULL, NULL, NULL, '00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-04-25 19:14:47', '2023-04-25 19:14:47'),
(29, 'user', 'Mr', 'Sheikh', 'Nayan', 'Nayan', 'nayan@unipuller.com', '$2y$10$0k7AOhebgh113dQKt8FbG.029H4Y.5cyTX3e1fm327CucHVM2IKvO', 'en', NULL, NULL, NULL, 6, 107, 10, '250.0000', 'month', NULL, NULL, NULL, '5.00', 1, 'active', NULL, 0, '5.00', 0, NULL, 'male', 'married', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, 2, NULL, '2023-04-27 20:14:50', '2023-04-27 20:39:14'),
(30, 'user', 'Miss', 'Huma', 'Ismail', 'Huma123', 'huma@unipuller.com', '$2y$10$oAZ.elx6V5kKm5yCHJd2YuK/C3K1E9nBiIhcopsVCC/K5SLKg5xwy', 'en', NULL, NULL, NULL, 6, 107, 10, '100.0000', 'month', NULL, NULL, NULL, '5.00', 1, 'active', NULL, 0, '5.00', 0, NULL, 'female', 'unmarried', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, 2, NULL, '2023-04-27 20:33:34', '2023-04-27 20:33:34'),
(31, 'user', 'Mr', 'Muzammil', 'Shahzad', 'Muzammil', 'Muzammil@unipuller.com', '$2y$10$EOFrpvxAY/Qi0.u4e0m3suPYd4pbjUYlCihW5Eraas9kbHeIsMf2S', 'en', NULL, NULL, 'Ppuo11HPNhn9W4K2SExLowtrGi2y82J00tOwefFtOTVmhUrCl3PYeradSfCI', 6, 107, 10, '100.0000', 'month', NULL, NULL, NULL, '5.00', 1, 'active', NULL, 0, '5.00', 0, NULL, 'male', 'unmarried', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"account_holder_name\":null,\"account_number\":null,\"bank_name\":null,\"bank_code\":null,\"branch\":null,\"tax_payer_id\":null}', NULL, NULL, NULL, NULL, 2, NULL, '2023-04-27 20:37:51', '2023-04-27 20:37:51'),
(32, 'user_customer', 'Miss', 'Moynul', 'Hossain', 'Moynul', NULL, '$2y$10$bghq87RTg3iqU.sQAD9z5.5m4HVmhwxksjk093GDpIdaeuOCd8zRi', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 34, 0, '0.00', 0, NULL, NULL, NULL, NULL, '+8801713064663', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Business development', 'Director', NULL, NULL, '2023-04-29 19:09:19', '2023-04-29 19:09:19'),
(33, 'user', 'Mr', 'Faizan', 'Ahmad', 'faiz6644', 'faizcs2k17@gmail.com', '$2y$10$dMk5DPnJONKahaiehJN.Z.3AUx7L8Gm2A32bnFuSJrZeGBf4PIdnu', 'en', NULL, NULL, 'sKw2f4H4AHyDzvFuRYNEWmsnd1lDPgdUWEvInSqSIyR6J8sdRvNATquDZZY7', 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', NULL, 0, '0.00', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-13 01:20:59', '2023-06-13 01:20:59'),
(34, 'user_customer', 'Mr', 'Polash', 'Mia', 'Polash', 'tanzimhassanp@gmail.com', '$2y$10$hVqMRdnB9V59biySCxBuLON.vcaVU.PZDq6fvvdJox2qoBhHPJODC', 'en', NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'active', 6, 0, '0.00', 0, NULL, NULL, NULL, NULL, '+447460497454', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-19 00:01:25', '2023-07-19 00:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_contact_access`
--

CREATE TABLE `user_contact_access` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_contact_access`
--

INSERT INTO `user_contact_access` (`id`, `user_id`, `contact_id`) VALUES
(1, 6, 3),
(2, 7, 3),
(3, 7, 6),
(4, 6, 9),
(5, 7, 9),
(6, 5, 10),
(7, 5, 14),
(20, 5, 27),
(21, 6, 35),
(22, 6, 39),
(23, 6, 40),
(24, 6, 42);

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `sub_sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_variation_id` int(10) UNSIGNED NOT NULL,
  `woocommerce_variation_id` int(11) DEFAULT NULL,
  `variation_value_id` int(11) DEFAULT NULL,
  `default_purchase_price` decimal(22,4) DEFAULT NULL,
  `dpp_inc_tax` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `profit_percent` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `default_sell_price` decimal(22,4) DEFAULT NULL,
  `sell_price_inc_tax` decimal(22,4) DEFAULT NULL COMMENT 'Sell price including tax',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `combo_variations` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Contains the combo variation details'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `name`, `product_id`, `sub_sku`, `product_variation_id`, `woocommerce_variation_id`, `variation_value_id`, `default_purchase_price`, `dpp_inc_tax`, `profit_percent`, `default_sell_price`, `sell_price_inc_tax`, `created_at`, `updated_at`, `deleted_at`, `combo_variations`) VALUES
(3, 'DUMMY', 3, '0003', 3, NULL, NULL, '160000.0000', '16000000.0000', '10000.0000', '1616000000.0000', '1616000000.0000', '2023-04-13 20:07:01', '2023-04-13 20:07:01', NULL, '[]'),
(4, 'DUMMY', 4, '0004', 4, NULL, NULL, '405.5000', '405.5000', '0.0000', '405.5000', '405.5000', '2023-05-13 12:21:55', '2023-07-15 16:21:54', NULL, '[]'),
(5, 'DUMMY', 5, '0005', 5, NULL, NULL, '95.0000', '95.0000', '0.0000', '95.0000', '95.0000', '2023-07-14 18:00:49', '2023-07-15 16:23:26', NULL, '[]'),
(6, 'DUMMY', 6, '0006', 6, NULL, NULL, '70.0000', '70.0000', '0.0000', '70.0000', '70.0000', '2023-07-15 16:14:33', '2023-07-15 16:22:46', NULL, '[]'),
(7, 'DUMMY', 7, '0007', 7, NULL, NULL, '299.0000', '299.0000', '0.0000', '299.0000', '299.0000', '2023-07-15 16:20:54', '2023-07-17 17:15:19', NULL, '[]'),
(8, 'DUMMY', 8, '0008', 8, NULL, NULL, '5.0000', '5.0000', '10.0000', '5.5000', '5.5000', '2023-07-17 22:50:56', '2023-07-17 22:57:17', NULL, '[]');

-- --------------------------------------------------------

--
-- Table structure for table `variation_group_prices`
--

CREATE TABLE `variation_group_prices` (
  `id` int(10) UNSIGNED NOT NULL,
  `variation_id` int(10) UNSIGNED NOT NULL,
  `price_group_id` int(10) UNSIGNED NOT NULL,
  `price_inc_tax` decimal(22,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_location_details`
--

CREATE TABLE `variation_location_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_variation_id` int(10) UNSIGNED NOT NULL COMMENT 'id from product_variations table',
  `variation_id` int(10) UNSIGNED NOT NULL,
  `location_id` int(10) UNSIGNED NOT NULL,
  `qty_available` decimal(22,4) NOT NULL DEFAULT 0.0000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variation_location_details`
--

INSERT INTO `variation_location_details` (`id`, `product_id`, `product_variation_id`, `variation_id`, `location_id`, `qty_available`, `created_at`, `updated_at`) VALUES
(1, 6, 6, 6, 2, '-1.0000', '2023-07-15 16:37:57', '2023-07-15 16:37:57'),
(2, 7, 7, 7, 2, '-2.0000', '2023-07-15 16:56:54', '2023-07-17 18:01:33'),
(3, 8, 8, 8, 2, '-1.0000', '2023-07-17 22:57:53', '2023-07-17 22:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `variation_templates`
--

CREATE TABLE `variation_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(10) UNSIGNED NOT NULL,
  `woocommerce_attr_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variation_value_templates`
--

CREATE TABLE `variation_value_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation_template_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warranties`
--

CREATE TABLE `warranties` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `duration_type` enum('days','months','years') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `woocommerce_sync_logs`
--

CREATE TABLE `woocommerce_sync_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `business_id` int(11) NOT NULL,
  `sync_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `operation_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `woocommerce_sync_logs`
--

INSERT INTO `woocommerce_sync_logs` (`id`, `business_id`, `sync_type`, `operation_type`, `data`, `details`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 6, 'orders', NULL, NULL, NULL, 6, '2023-05-24 23:13:50', '2023-05-24 23:13:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounts_business_id_index` (`business_id`),
  ADD KEY `accounts_account_type_id_index` (`account_type_id`),
  ADD KEY `accounts_created_by_index` (`created_by`);

--
-- Indexes for table `account_transactions`
--
ALTER TABLE `account_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_transactions_account_id_index` (`account_id`),
  ADD KEY `account_transactions_transaction_id_index` (`transaction_id`),
  ADD KEY `account_transactions_transaction_payment_id_index` (`transaction_payment_id`),
  ADD KEY `account_transactions_transfer_transaction_id_index` (`transfer_transaction_id`),
  ADD KEY `account_transactions_created_by_index` (`created_by`),
  ADD KEY `account_transactions_type_index` (`type`),
  ADD KEY `account_transactions_sub_type_index` (`sub_type`),
  ADD KEY `account_transactions_operation_date_index` (`operation_date`);

--
-- Indexes for table `account_types`
--
ALTER TABLE `account_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `account_types_parent_account_type_id_index` (`parent_account_type_id`),
  ADD KEY `account_types_business_id_index` (`business_id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `arrival_sections`
--
ALTER TABLE `arrival_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barcodes_business_id_foreign` (`business_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_contact_id_foreign` (`contact_id`),
  ADD KEY `bookings_business_id_foreign` (`business_id`),
  ADD KEY `bookings_created_by_foreign` (`created_by`),
  ADD KEY `bookings_table_id_index` (`table_id`),
  ADD KEY `bookings_waiter_id_index` (`waiter_id`),
  ADD KEY `bookings_location_id_index` (`location_id`),
  ADD KEY `bookings_booking_status_index` (`booking_status`),
  ADD KEY `bookings_correspondent_id_index` (`correspondent_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_business_id_foreign` (`business_id`),
  ADD KEY `brands_created_by_foreign` (`created_by`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_owner_id_foreign` (`owner_id`),
  ADD KEY `business_currency_id_foreign` (`currency_id`),
  ADD KEY `business_default_sales_tax_foreign` (`default_sales_tax`);

--
-- Indexes for table `business_locations`
--
ALTER TABLE `business_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_locations_business_id_index` (`business_id`),
  ADD KEY `business_locations_invoice_scheme_id_foreign` (`invoice_scheme_id`),
  ADD KEY `business_locations_invoice_layout_id_foreign` (`invoice_layout_id`),
  ADD KEY `business_locations_sale_invoice_layout_id_index` (`sale_invoice_layout_id`),
  ADD KEY `business_locations_selling_price_group_id_index` (`selling_price_group_id`),
  ADD KEY `business_locations_receipt_printer_type_index` (`receipt_printer_type`),
  ADD KEY `business_locations_printer_id_index` (`printer_id`);

--
-- Indexes for table `cash_denominations`
--
ALTER TABLE `cash_denominations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_denominations_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_registers_business_id_foreign` (`business_id`),
  ADD KEY `cash_registers_user_id_foreign` (`user_id`),
  ADD KEY `cash_registers_location_id_index` (`location_id`);

--
-- Indexes for table `cash_register_transactions`
--
ALTER TABLE `cash_register_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cash_register_transactions_cash_register_id_foreign` (`cash_register_id`),
  ADD KEY `cash_register_transactions_transaction_id_index` (`transaction_id`),
  ADD KEY `cash_register_transactions_type_index` (`type`),
  ADD KEY `cash_register_transactions_transaction_type_index` (`transaction_type`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_business_id_foreign` (`business_id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_parent_id_index` (`parent_id`),
  ADD KEY `categories_woocommerce_cat_id_index` (`woocommerce_cat_id`);

--
-- Indexes for table `categorizables`
--
ALTER TABLE `categorizables`
  ADD KEY `categorizables_categorizable_type_categorizable_id_index` (`categorizable_type`,`categorizable_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_business_id_foreign` (`business_id`),
  ADD KEY `contacts_created_by_foreign` (`created_by`),
  ADD KEY `contacts_type_index` (`type`),
  ADD KEY `contacts_contact_status_index` (`contact_status`),
  ADD KEY `contacts_crm_source_index` (`crm_source`),
  ADD KEY `contacts_crm_life_stage_index` (`crm_life_stage`),
  ADD KEY `contacts_converted_by_index` (`converted_by`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crm_call_logs`
--
ALTER TABLE `crm_call_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_call_logs_business_id_index` (`business_id`),
  ADD KEY `crm_call_logs_user_id_index` (`user_id`),
  ADD KEY `crm_call_logs_contact_id_index` (`contact_id`),
  ADD KEY `crm_call_logs_created_by_index` (`created_by`);

--
-- Indexes for table `crm_campaigns`
--
ALTER TABLE `crm_campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_campaigns_business_id_foreign` (`business_id`),
  ADD KEY `crm_campaigns_created_by_index` (`created_by`);

--
-- Indexes for table `crm_lead_users`
--
ALTER TABLE `crm_lead_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_lead_users_user_id_index` (`user_id`),
  ADD KEY `crm_lead_users_contact_id_index` (`contact_id`);

--
-- Indexes for table `crm_proposals`
--
ALTER TABLE `crm_proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_proposals_business_id_foreign` (`business_id`),
  ADD KEY `crm_proposals_contact_id_foreign` (`contact_id`),
  ADD KEY `crm_proposals_sent_by_index` (`sent_by`);

--
-- Indexes for table `crm_proposal_templates`
--
ALTER TABLE `crm_proposal_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_proposal_templates_business_id_foreign` (`business_id`),
  ADD KEY `crm_proposal_templates_created_by_index` (`created_by`);

--
-- Indexes for table `crm_schedules`
--
ALTER TABLE `crm_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_schedules_created_by_index` (`created_by`),
  ADD KEY `crm_schedules_business_id_index` (`business_id`),
  ADD KEY `crm_schedules_contact_id_index` (`contact_id`),
  ADD KEY `crm_schedules_schedule_type_index` (`schedule_type`),
  ADD KEY `crm_schedules_notify_type_index` (`notify_type`);

--
-- Indexes for table `crm_schedule_logs`
--
ALTER TABLE `crm_schedule_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_schedule_logs_schedule_id_foreign` (`schedule_id`),
  ADD KEY `crm_schedule_logs_created_by_index` (`created_by`);

--
-- Indexes for table `crm_schedule_users`
--
ALTER TABLE `crm_schedule_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `crm_schedule_users_schedule_id_foreign` (`schedule_id`),
  ADD KEY `crm_schedule_users_user_id_index` (`user_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_groups_business_id_foreign` (`business_id`),
  ADD KEY `customer_groups_created_by_index` (`created_by`),
  ADD KEY `customer_groups_price_calculation_type_index` (`price_calculation_type`),
  ADD KEY `customer_groups_selling_price_group_id_index` (`selling_price_group_id`);

--
-- Indexes for table `dashboard_configurations`
--
ALTER TABLE `dashboard_configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dashboard_configurations_business_id_foreign` (`business_id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discounts_business_id_index` (`business_id`),
  ADD KEY `discounts_brand_id_index` (`brand_id`),
  ADD KEY `discounts_category_id_index` (`category_id`),
  ADD KEY `discounts_location_id_index` (`location_id`),
  ADD KEY `discounts_priority_index` (`priority`),
  ADD KEY `discounts_spg_index` (`spg`);

--
-- Indexes for table `discount_variations`
--
ALTER TABLE `discount_variations`
  ADD KEY `discount_variations_discount_id_index` (`discount_id`),
  ADD KEY `discount_variations_variation_id_index` (`variation_id`);

--
-- Indexes for table `document_and_notes`
--
ALTER TABLE `document_and_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_and_notes_business_id_index` (`business_id`),
  ADD KEY `document_and_notes_notable_id_index` (`notable_id`),
  ADD KEY `document_and_notes_created_by_index` (`created_by`);

--
-- Indexes for table `essentials_allowances_and_deductions`
--
ALTER TABLE `essentials_allowances_and_deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_allowances_and_deductions_business_id_index` (`business_id`);

--
-- Indexes for table `essentials_attendances`
--
ALTER TABLE `essentials_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_attendances_user_id_index` (`user_id`),
  ADD KEY `essentials_attendances_business_id_index` (`business_id`),
  ADD KEY `essentials_attendances_essentials_shift_id_index` (`essentials_shift_id`);

--
-- Indexes for table `essentials_documents`
--
ALTER TABLE `essentials_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essentials_document_shares`
--
ALTER TABLE `essentials_document_shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_document_shares_document_id_index` (`document_id`),
  ADD KEY `essentials_document_shares_value_type_index` (`value_type`);

--
-- Indexes for table `essentials_holidays`
--
ALTER TABLE `essentials_holidays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_holidays_business_id_index` (`business_id`),
  ADD KEY `essentials_holidays_location_id_index` (`location_id`);

--
-- Indexes for table `essentials_kb`
--
ALTER TABLE `essentials_kb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_kb_business_id_index` (`business_id`),
  ADD KEY `essentials_kb_parent_id_index` (`parent_id`),
  ADD KEY `essentials_kb_created_by_index` (`created_by`);

--
-- Indexes for table `essentials_kb_users`
--
ALTER TABLE `essentials_kb_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_kb_users_kb_id_index` (`kb_id`),
  ADD KEY `essentials_kb_users_user_id_index` (`user_id`);

--
-- Indexes for table `essentials_leaves`
--
ALTER TABLE `essentials_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_leaves_essentials_leave_type_id_index` (`essentials_leave_type_id`),
  ADD KEY `essentials_leaves_business_id_index` (`business_id`),
  ADD KEY `essentials_leaves_user_id_index` (`user_id`);

--
-- Indexes for table `essentials_leave_types`
--
ALTER TABLE `essentials_leave_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_leave_types_business_id_index` (`business_id`);

--
-- Indexes for table `essentials_messages`
--
ALTER TABLE `essentials_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_messages_business_id_index` (`business_id`),
  ADD KEY `essentials_messages_user_id_index` (`user_id`),
  ADD KEY `essentials_messages_location_id_index` (`location_id`);

--
-- Indexes for table `essentials_payroll_groups`
--
ALTER TABLE `essentials_payroll_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essentials_payroll_group_transactions`
--
ALTER TABLE `essentials_payroll_group_transactions`
  ADD KEY `essentials_payroll_group_transactions_payroll_group_id_foreign` (`payroll_group_id`);

--
-- Indexes for table `essentials_reminders`
--
ALTER TABLE `essentials_reminders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_reminders_business_id_index` (`business_id`),
  ADD KEY `essentials_reminders_user_id_index` (`user_id`);

--
-- Indexes for table `essentials_shifts`
--
ALTER TABLE `essentials_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_shifts_type_index` (`type`),
  ADD KEY `essentials_shifts_business_id_index` (`business_id`);

--
-- Indexes for table `essentials_todo_comments`
--
ALTER TABLE `essentials_todo_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_todo_comments_task_id_index` (`task_id`),
  ADD KEY `essentials_todo_comments_comment_by_index` (`comment_by`);

--
-- Indexes for table `essentials_to_dos`
--
ALTER TABLE `essentials_to_dos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_to_dos_status_index` (`status`),
  ADD KEY `essentials_to_dos_priority_index` (`priority`),
  ADD KEY `essentials_to_dos_created_by_index` (`created_by`),
  ADD KEY `essentials_to_dos_business_id_index` (`business_id`),
  ADD KEY `essentials_to_dos_task_id_index` (`task_id`);

--
-- Indexes for table `essentials_user_allowance_and_deductions`
--
ALTER TABLE `essentials_user_allowance_and_deductions`
  ADD KEY `essentials_user_allowance_and_deductions_user_id_index` (`user_id`),
  ADD KEY `allow_deduct_index` (`allowance_deduction_id`);

--
-- Indexes for table `essentials_user_sales_targets`
--
ALTER TABLE `essentials_user_sales_targets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `essentials_user_shifts`
--
ALTER TABLE `essentials_user_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `essentials_user_shifts_user_id_index` (`user_id`),
  ADD KEY `essentials_user_shifts_essentials_shift_id_index` (`essentials_shift_id`);

--
-- Indexes for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_categories_business_id_foreign` (`business_id`);

--
-- Indexes for table `group_sub_taxes`
--
ALTER TABLE `group_sub_taxes`
  ADD KEY `group_sub_taxes_group_tax_id_foreign` (`group_tax_id`),
  ADD KEY `group_sub_taxes_tax_id_foreign` (`tax_id`);

--
-- Indexes for table `invoice_layouts`
--
ALTER TABLE `invoice_layouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_layouts_business_id_foreign` (`business_id`);

--
-- Indexes for table `invoice_schemes`
--
ALTER TABLE `invoice_schemes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_schemes_business_id_foreign` (`business_id`),
  ADD KEY `invoice_schemes_scheme_type_index` (`scheme_type`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_business_id_index` (`business_id`),
  ADD KEY `media_uploaded_by_index` (`uploaded_by`),
  ADD KEY `media_woocommerce_media_id_index` (`woocommerce_media_id`);

--
-- Indexes for table `mfg_ingredient_groups`
--
ALTER TABLE `mfg_ingredient_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mfg_recipes`
--
ALTER TABLE `mfg_recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mfg_recipes_product_id_index` (`product_id`),
  ADD KEY `mfg_recipes_variation_id_index` (`variation_id`);

--
-- Indexes for table `mfg_recipe_ingredients`
--
ALTER TABLE `mfg_recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mfg_recipe_ingredients_mfg_recipe_id_foreign` (`mfg_recipe_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `notification_templates`
--
ALTER TABLE `notification_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pjt_invoice_lines`
--
ALTER TABLE `pjt_invoice_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_invoice_lines_transaction_id_foreign` (`transaction_id`),
  ADD KEY `pjt_invoice_lines_tax_rate_id_index` (`tax_rate_id`);

--
-- Indexes for table `pjt_projects`
--
ALTER TABLE `pjt_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_projects_business_id_index` (`business_id`),
  ADD KEY `pjt_projects_contact_id_index` (`contact_id`),
  ADD KEY `pjt_projects_lead_id_index` (`lead_id`),
  ADD KEY `pjt_projects_created_by_index` (`created_by`);

--
-- Indexes for table `pjt_project_members`
--
ALTER TABLE `pjt_project_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_project_members_project_id_foreign` (`project_id`),
  ADD KEY `pjt_project_members_user_id_index` (`user_id`);

--
-- Indexes for table `pjt_project_tasks`
--
ALTER TABLE `pjt_project_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_project_tasks_project_id_foreign` (`project_id`),
  ADD KEY `pjt_project_tasks_business_id_index` (`business_id`),
  ADD KEY `pjt_project_tasks_created_by_index` (`created_by`);

--
-- Indexes for table `pjt_project_task_comments`
--
ALTER TABLE `pjt_project_task_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_project_task_comments_project_task_id_foreign` (`project_task_id`);

--
-- Indexes for table `pjt_project_task_members`
--
ALTER TABLE `pjt_project_task_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_project_task_members_project_task_id_foreign` (`project_task_id`),
  ADD KEY `pjt_project_task_members_user_id_index` (`user_id`);

--
-- Indexes for table `pjt_project_time_logs`
--
ALTER TABLE `pjt_project_time_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pjt_project_time_logs_project_id_foreign` (`project_id`),
  ADD KEY `pjt_project_time_logs_project_task_id_foreign` (`project_task_id`),
  ADD KEY `pjt_project_time_logs_user_id_index` (`user_id`),
  ADD KEY `pjt_project_time_logs_created_by_index` (`created_by`);

--
-- Indexes for table `printers`
--
ALTER TABLE `printers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `printers_business_id_foreign` (`business_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_tax_foreign` (`tax`),
  ADD KEY `products_name_index` (`name`),
  ADD KEY `products_business_id_index` (`business_id`),
  ADD KEY `products_unit_id_index` (`unit_id`),
  ADD KEY `products_created_by_index` (`created_by`),
  ADD KEY `products_warranty_id_index` (`warranty_id`),
  ADD KEY `products_type_index` (`type`),
  ADD KEY `products_tax_type_index` (`tax_type`),
  ADD KEY `products_barcode_type_index` (`barcode_type`),
  ADD KEY `products_secondary_unit_id_index` (`secondary_unit_id`),
  ADD KEY `products_woocommerce_product_id_index` (`woocommerce_product_id`),
  ADD KEY `products_woocommerce_media_id_index` (`woocommerce_media_id`),
  ADD KEY `products_repair_model_id_index` (`repair_model_id`);

--
-- Indexes for table `product_locations`
--
ALTER TABLE `product_locations`
  ADD KEY `product_locations_product_id_index` (`product_id`),
  ADD KEY `product_locations_location_id_index` (`location_id`);

--
-- Indexes for table `product_racks`
--
ALTER TABLE `product_racks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_racks_business_id_index` (`business_id`),
  ADD KEY `product_racks_location_id_index` (`location_id`),
  ADD KEY `product_racks_product_id_index` (`product_id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_name_index` (`name`),
  ADD KEY `product_variations_product_id_index` (`product_id`);

--
-- Indexes for table `purchase_lines`
--
ALTER TABLE `purchase_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_lines_transaction_id_foreign` (`transaction_id`),
  ADD KEY `purchase_lines_product_id_foreign` (`product_id`),
  ADD KEY `purchase_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `purchase_lines_tax_id_foreign` (`tax_id`),
  ADD KEY `purchase_lines_sub_unit_id_index` (`sub_unit_id`),
  ADD KEY `purchase_lines_lot_number_index` (`lot_number`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reference_counts`
--
ALTER TABLE `reference_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_counts_business_id_index` (`business_id`);

--
-- Indexes for table `repair_device_models`
--
ALTER TABLE `repair_device_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_device_models_business_id_index` (`business_id`),
  ADD KEY `repair_device_models_brand_id_index` (`brand_id`),
  ADD KEY `repair_device_models_device_id_index` (`device_id`),
  ADD KEY `repair_device_models_created_by_index` (`created_by`);

--
-- Indexes for table `repair_job_sheets`
--
ALTER TABLE `repair_job_sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_job_sheets_business_id_index` (`business_id`),
  ADD KEY `repair_job_sheets_location_id_index` (`location_id`),
  ADD KEY `repair_job_sheets_contact_id_index` (`contact_id`),
  ADD KEY `repair_job_sheets_brand_id_index` (`brand_id`),
  ADD KEY `repair_job_sheets_device_id_index` (`device_id`),
  ADD KEY `repair_job_sheets_device_model_id_index` (`device_model_id`),
  ADD KEY `repair_job_sheets_status_id_index` (`status_id`),
  ADD KEY `repair_job_sheets_service_staff_index` (`service_staff`),
  ADD KEY `repair_job_sheets_created_by_index` (`created_by`);

--
-- Indexes for table `repair_statuses`
--
ALTER TABLE `repair_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `res_product_modifier_sets`
--
ALTER TABLE `res_product_modifier_sets`
  ADD KEY `res_product_modifier_sets_modifier_set_id_foreign` (`modifier_set_id`);

--
-- Indexes for table `res_tables`
--
ALTER TABLE `res_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `res_tables_business_id_foreign` (`business_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_business_id_foreign` (`business_id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `selling_price_groups`
--
ALTER TABLE `selling_price_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selling_price_groups_business_id_foreign` (`business_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_adjustment_lines`
--
ALTER TABLE `stock_adjustment_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustment_lines_product_id_foreign` (`product_id`),
  ADD KEY `stock_adjustment_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `stock_adjustment_lines_transaction_id_index` (`transaction_id`),
  ADD KEY `stock_adjustment_lines_lot_no_line_id_index` (`lot_no_line_id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_business_id_foreign` (`business_id`),
  ADD KEY `subscriptions_package_id_index` (`package_id`),
  ADD KEY `subscriptions_created_id_index` (`created_id`);

--
-- Indexes for table `superadmin_communicator_logs`
--
ALTER TABLE `superadmin_communicator_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superadmin_frontend_pages`
--
ALTER TABLE `superadmin_frontend_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tax_rates_business_id_foreign` (`business_id`),
  ADD KEY `tax_rates_created_by_foreign` (`created_by`),
  ADD KEY `tax_rates_woocommerce_tax_rate_id_index` (`woocommerce_tax_rate_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_tax_id_foreign` (`tax_id`),
  ADD KEY `transactions_business_id_index` (`business_id`),
  ADD KEY `transactions_type_index` (`type`),
  ADD KEY `transactions_contact_id_index` (`contact_id`),
  ADD KEY `transactions_transaction_date_index` (`transaction_date`),
  ADD KEY `transactions_created_by_index` (`created_by`),
  ADD KEY `transactions_location_id_index` (`location_id`),
  ADD KEY `transactions_expense_for_foreign` (`expense_for`),
  ADD KEY `transactions_expense_category_id_index` (`expense_category_id`),
  ADD KEY `transactions_sub_type_index` (`sub_type`),
  ADD KEY `transactions_return_parent_id_index` (`return_parent_id`),
  ADD KEY `type` (`type`),
  ADD KEY `transactions_status_index` (`status`),
  ADD KEY `transactions_sub_status_index` (`sub_status`),
  ADD KEY `transactions_res_table_id_index` (`res_table_id`),
  ADD KEY `transactions_res_waiter_id_index` (`res_waiter_id`),
  ADD KEY `transactions_res_order_status_index` (`res_order_status`),
  ADD KEY `transactions_payment_status_index` (`payment_status`),
  ADD KEY `transactions_discount_type_index` (`discount_type`),
  ADD KEY `transactions_commission_agent_index` (`commission_agent`),
  ADD KEY `transactions_transfer_parent_id_index` (`transfer_parent_id`),
  ADD KEY `transactions_types_of_service_id_index` (`types_of_service_id`),
  ADD KEY `transactions_packing_charge_type_index` (`packing_charge_type`),
  ADD KEY `transactions_recur_parent_id_index` (`recur_parent_id`),
  ADD KEY `transactions_selling_price_group_id_index` (`selling_price_group_id`),
  ADD KEY `transactions_delivery_date_index` (`delivery_date`),
  ADD KEY `transactions_woocommerce_order_id_index` (`woocommerce_order_id`),
  ADD KEY `transactions_pjt_project_id_foreign` (`pjt_project_id`),
  ADD KEY `transactions_repair_model_id_index` (`repair_model_id`),
  ADD KEY `transactions_repair_warranty_id_index` (`repair_warranty_id`),
  ADD KEY `transactions_repair_brand_id_index` (`repair_brand_id`),
  ADD KEY `transactions_repair_status_id_index` (`repair_status_id`),
  ADD KEY `transactions_repair_device_id_index` (`repair_device_id`),
  ADD KEY `transactions_repair_job_sheet_id_index` (`repair_job_sheet_id`);

--
-- Indexes for table `transaction_payments`
--
ALTER TABLE `transaction_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_payments_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_payments_created_by_index` (`created_by`),
  ADD KEY `transaction_payments_parent_id_index` (`parent_id`),
  ADD KEY `transaction_payments_payment_type_index` (`payment_type`);

--
-- Indexes for table `transaction_sell_lines`
--
ALTER TABLE `transaction_sell_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_sell_lines_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_sell_lines_product_id_foreign` (`product_id`),
  ADD KEY `transaction_sell_lines_variation_id_foreign` (`variation_id`),
  ADD KEY `transaction_sell_lines_tax_id_foreign` (`tax_id`),
  ADD KEY `transaction_sell_lines_children_type_index` (`children_type`),
  ADD KEY `transaction_sell_lines_parent_sell_line_id_index` (`parent_sell_line_id`),
  ADD KEY `transaction_sell_lines_line_discount_type_index` (`line_discount_type`),
  ADD KEY `transaction_sell_lines_discount_id_index` (`discount_id`),
  ADD KEY `transaction_sell_lines_lot_no_line_id_index` (`lot_no_line_id`),
  ADD KEY `transaction_sell_lines_sub_unit_id_index` (`sub_unit_id`),
  ADD KEY `transaction_sell_lines_woocommerce_line_items_id_index` (`woocommerce_line_items_id`);

--
-- Indexes for table `transaction_sell_lines_purchase_lines`
--
ALTER TABLE `transaction_sell_lines_purchase_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sell_line_id` (`sell_line_id`),
  ADD KEY `stock_adjustment_line_id` (`stock_adjustment_line_id`),
  ADD KEY `purchase_line_id` (`purchase_line_id`);

--
-- Indexes for table `types_of_services`
--
ALTER TABLE `types_of_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `types_of_services_business_id_index` (`business_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `units_business_id_foreign` (`business_id`),
  ADD KEY `units_created_by_foreign` (`created_by`),
  ADD KEY `units_base_unit_id_index` (`base_unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_business_id_foreign` (`business_id`),
  ADD KEY `users_user_type_index` (`user_type`),
  ADD KEY `users_essentials_department_id_index` (`essentials_department_id`),
  ADD KEY `users_essentials_designation_id_index` (`essentials_designation_id`),
  ADD KEY `users_crm_contact_id_index` (`crm_contact_id`);

--
-- Indexes for table `user_contact_access`
--
ALTER TABLE `user_contact_access`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_contact_access_user_id_index` (`user_id`),
  ADD KEY `user_contact_access_contact_id_index` (`contact_id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variations_product_id_foreign` (`product_id`),
  ADD KEY `variations_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `variations_name_index` (`name`),
  ADD KEY `variations_sub_sku_index` (`sub_sku`),
  ADD KEY `variations_variation_value_id_index` (`variation_value_id`),
  ADD KEY `variations_woocommerce_variation_id_index` (`woocommerce_variation_id`);

--
-- Indexes for table `variation_group_prices`
--
ALTER TABLE `variation_group_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_group_prices_variation_id_foreign` (`variation_id`),
  ADD KEY `variation_group_prices_price_group_id_foreign` (`price_group_id`);

--
-- Indexes for table `variation_location_details`
--
ALTER TABLE `variation_location_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_location_details_location_id_foreign` (`location_id`),
  ADD KEY `variation_location_details_product_id_index` (`product_id`),
  ADD KEY `variation_location_details_product_variation_id_index` (`product_variation_id`),
  ADD KEY `variation_location_details_variation_id_index` (`variation_id`);

--
-- Indexes for table `variation_templates`
--
ALTER TABLE `variation_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_templates_business_id_foreign` (`business_id`),
  ADD KEY `variation_templates_woocommerce_attr_id_index` (`woocommerce_attr_id`);

--
-- Indexes for table `variation_value_templates`
--
ALTER TABLE `variation_value_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_value_templates_name_index` (`name`),
  ADD KEY `variation_value_templates_variation_template_id_index` (`variation_template_id`);

--
-- Indexes for table `warranties`
--
ALTER TABLE `warranties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `warranties_business_id_index` (`business_id`),
  ADD KEY `warranties_duration_type_index` (`duration_type`);

--
-- Indexes for table `woocommerce_sync_logs`
--
ALTER TABLE `woocommerce_sync_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account_transactions`
--
ALTER TABLE `account_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `account_types`
--
ALTER TABLE `account_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `arrival_sections`
--
ALTER TABLE `arrival_sections`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `barcodes`
--
ALTER TABLE `barcodes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `business_locations`
--
ALTER TABLE `business_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cash_denominations`
--
ALTER TABLE `cash_denominations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_registers`
--
ALTER TABLE `cash_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cash_register_transactions`
--
ALTER TABLE `cash_register_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `crm_call_logs`
--
ALTER TABLE `crm_call_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_campaigns`
--
ALTER TABLE `crm_campaigns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crm_lead_users`
--
ALTER TABLE `crm_lead_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `crm_proposals`
--
ALTER TABLE `crm_proposals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crm_proposal_templates`
--
ALTER TABLE `crm_proposal_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crm_schedules`
--
ALTER TABLE `crm_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `crm_schedule_logs`
--
ALTER TABLE `crm_schedule_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crm_schedule_users`
--
ALTER TABLE `crm_schedule_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_groups`
--
ALTER TABLE `customer_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dashboard_configurations`
--
ALTER TABLE `dashboard_configurations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_and_notes`
--
ALTER TABLE `document_and_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `essentials_allowances_and_deductions`
--
ALTER TABLE `essentials_allowances_and_deductions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_attendances`
--
ALTER TABLE `essentials_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `essentials_documents`
--
ALTER TABLE `essentials_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `essentials_document_shares`
--
ALTER TABLE `essentials_document_shares`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `essentials_holidays`
--
ALTER TABLE `essentials_holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_kb`
--
ALTER TABLE `essentials_kb`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_kb_users`
--
ALTER TABLE `essentials_kb_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_leaves`
--
ALTER TABLE `essentials_leaves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_leave_types`
--
ALTER TABLE `essentials_leave_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_messages`
--
ALTER TABLE `essentials_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `essentials_payroll_groups`
--
ALTER TABLE `essentials_payroll_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_reminders`
--
ALTER TABLE `essentials_reminders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_shifts`
--
ALTER TABLE `essentials_shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `essentials_todo_comments`
--
ALTER TABLE `essentials_todo_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `essentials_to_dos`
--
ALTER TABLE `essentials_to_dos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `essentials_user_sales_targets`
--
ALTER TABLE `essentials_user_sales_targets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `essentials_user_shifts`
--
ALTER TABLE `essentials_user_shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_categories`
--
ALTER TABLE `expense_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_layouts`
--
ALTER TABLE `invoice_layouts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice_schemes`
--
ALTER TABLE `invoice_schemes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `mfg_ingredient_groups`
--
ALTER TABLE `mfg_ingredient_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mfg_recipes`
--
ALTER TABLE `mfg_recipes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mfg_recipe_ingredients`
--
ALTER TABLE `mfg_recipe_ingredients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409;

--
-- AUTO_INCREMENT for table `notification_templates`
--
ALTER TABLE `notification_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `pjt_invoice_lines`
--
ALTER TABLE `pjt_invoice_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pjt_projects`
--
ALTER TABLE `pjt_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pjt_project_members`
--
ALTER TABLE `pjt_project_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pjt_project_tasks`
--
ALTER TABLE `pjt_project_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pjt_project_task_comments`
--
ALTER TABLE `pjt_project_task_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pjt_project_task_members`
--
ALTER TABLE `pjt_project_task_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pjt_project_time_logs`
--
ALTER TABLE `pjt_project_time_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `printers`
--
ALTER TABLE `printers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_racks`
--
ALTER TABLE `product_racks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase_lines`
--
ALTER TABLE `purchase_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reference_counts`
--
ALTER TABLE `reference_counts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `repair_device_models`
--
ALTER TABLE `repair_device_models`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair_job_sheets`
--
ALTER TABLE `repair_job_sheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `repair_statuses`
--
ALTER TABLE `repair_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `res_tables`
--
ALTER TABLE `res_tables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `selling_price_groups`
--
ALTER TABLE `selling_price_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(191) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `stars`
--
ALTER TABLE `stars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `stock_adjustment_lines`
--
ALTER TABLE `stock_adjustment_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `superadmin_communicator_logs`
--
ALTER TABLE `superadmin_communicator_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superadmin_frontend_pages`
--
ALTER TABLE `superadmin_frontend_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `transaction_payments`
--
ALTER TABLE `transaction_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaction_sell_lines`
--
ALTER TABLE `transaction_sell_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `transaction_sell_lines_purchase_lines`
--
ALTER TABLE `transaction_sell_lines_purchase_lines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `types_of_services`
--
ALTER TABLE `types_of_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_contact_access`
--
ALTER TABLE `user_contact_access`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variation_group_prices`
--
ALTER TABLE `variation_group_prices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `variation_location_details`
--
ALTER TABLE `variation_location_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `variation_templates`
--
ALTER TABLE `variation_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variation_value_templates`
--
ALTER TABLE `variation_value_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warranties`
--
ALTER TABLE `warranties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `woocommerce_sync_logs`
--
ALTER TABLE `woocommerce_sync_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barcodes`
--
ALTER TABLE `barcodes`
  ADD CONSTRAINT `barcodes_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brands_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `business_currency_id_foreign` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`),
  ADD CONSTRAINT `business_default_sales_tax_foreign` FOREIGN KEY (`default_sales_tax`) REFERENCES `tax_rates` (`id`),
  ADD CONSTRAINT `business_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `business_locations`
--
ALTER TABLE `business_locations`
  ADD CONSTRAINT `business_locations_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_locations_invoice_layout_id_foreign` FOREIGN KEY (`invoice_layout_id`) REFERENCES `invoice_layouts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `business_locations_invoice_scheme_id_foreign` FOREIGN KEY (`invoice_scheme_id`) REFERENCES `invoice_schemes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_registers`
--
ALTER TABLE `cash_registers`
  ADD CONSTRAINT `cash_registers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cash_registers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cash_register_transactions`
--
ALTER TABLE `cash_register_transactions`
  ADD CONSTRAINT `cash_register_transactions_cash_register_id_foreign` FOREIGN KEY (`cash_register_id`) REFERENCES `cash_registers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_campaigns`
--
ALTER TABLE `crm_campaigns`
  ADD CONSTRAINT `crm_campaigns_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_lead_users`
--
ALTER TABLE `crm_lead_users`
  ADD CONSTRAINT `crm_lead_users_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_proposals`
--
ALTER TABLE `crm_proposals`
  ADD CONSTRAINT `crm_proposals_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `crm_proposals_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_proposal_templates`
--
ALTER TABLE `crm_proposal_templates`
  ADD CONSTRAINT `crm_proposal_templates_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_schedules`
--
ALTER TABLE `crm_schedules`
  ADD CONSTRAINT `crm_schedules_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_schedule_logs`
--
ALTER TABLE `crm_schedule_logs`
  ADD CONSTRAINT `crm_schedule_logs_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `crm_schedules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `crm_schedule_users`
--
ALTER TABLE `crm_schedule_users`
  ADD CONSTRAINT `crm_schedule_users_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `crm_schedules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_groups`
--
ALTER TABLE `customer_groups`
  ADD CONSTRAINT `customer_groups_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dashboard_configurations`
--
ALTER TABLE `dashboard_configurations`
  ADD CONSTRAINT `dashboard_configurations_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `essentials_kb`
--
ALTER TABLE `essentials_kb`
  ADD CONSTRAINT `essentials_kb_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `essentials_kb` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `essentials_payroll_group_transactions`
--
ALTER TABLE `essentials_payroll_group_transactions`
  ADD CONSTRAINT `essentials_payroll_group_transactions_payroll_group_id_foreign` FOREIGN KEY (`payroll_group_id`) REFERENCES `essentials_payroll_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expense_categories`
--
ALTER TABLE `expense_categories`
  ADD CONSTRAINT `expense_categories_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_sub_taxes`
--
ALTER TABLE `group_sub_taxes`
  ADD CONSTRAINT `group_sub_taxes_group_tax_id_foreign` FOREIGN KEY (`group_tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_sub_taxes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_layouts`
--
ALTER TABLE `invoice_layouts`
  ADD CONSTRAINT `invoice_layouts_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_schemes`
--
ALTER TABLE `invoice_schemes`
  ADD CONSTRAINT `invoice_schemes_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mfg_recipe_ingredients`
--
ALTER TABLE `mfg_recipe_ingredients`
  ADD CONSTRAINT `mfg_recipe_ingredients_mfg_recipe_id_foreign` FOREIGN KEY (`mfg_recipe_id`) REFERENCES `mfg_recipes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjt_invoice_lines`
--
ALTER TABLE `pjt_invoice_lines`
  ADD CONSTRAINT `pjt_invoice_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjt_project_members`
--
ALTER TABLE `pjt_project_members`
  ADD CONSTRAINT `pjt_project_members_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `pjt_projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjt_project_tasks`
--
ALTER TABLE `pjt_project_tasks`
  ADD CONSTRAINT `pjt_project_tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `pjt_projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjt_project_task_comments`
--
ALTER TABLE `pjt_project_task_comments`
  ADD CONSTRAINT `pjt_project_task_comments_project_task_id_foreign` FOREIGN KEY (`project_task_id`) REFERENCES `pjt_project_tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjt_project_task_members`
--
ALTER TABLE `pjt_project_task_members`
  ADD CONSTRAINT `pjt_project_task_members_project_task_id_foreign` FOREIGN KEY (`project_task_id`) REFERENCES `pjt_project_tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pjt_project_time_logs`
--
ALTER TABLE `pjt_project_time_logs`
  ADD CONSTRAINT `pjt_project_time_logs_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `pjt_projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pjt_project_time_logs_project_task_id_foreign` FOREIGN KEY (`project_task_id`) REFERENCES `pjt_project_tasks` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `printers`
--
ALTER TABLE `printers`
  ADD CONSTRAINT `printers_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_repair_model_id_foreign` FOREIGN KEY (`repair_model_id`) REFERENCES `repair_device_models` (`id`),
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_tax_foreign` FOREIGN KEY (`tax`) REFERENCES `tax_rates` (`id`),
  ADD CONSTRAINT `products_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_lines`
--
ALTER TABLE `purchase_lines`
  ADD CONSTRAINT `purchase_lines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_lines_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_lines_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `repair_device_models`
--
ALTER TABLE `repair_device_models`
  ADD CONSTRAINT `repair_device_models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `repair_device_models_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repair_device_models_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `repair_device_models_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `repair_job_sheets`
--
ALTER TABLE `repair_job_sheets`
  ADD CONSTRAINT `repair_job_sheets_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `repair_job_sheets_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repair_job_sheets_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `repair_job_sheets_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `repair_job_sheets_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `repair_job_sheets_device_model_id_foreign` FOREIGN KEY (`device_model_id`) REFERENCES `repair_device_models` (`id`),
  ADD CONSTRAINT `repair_job_sheets_service_staff_foreign` FOREIGN KEY (`service_staff`) REFERENCES `users` (`id`);

--
-- Constraints for table `res_product_modifier_sets`
--
ALTER TABLE `res_product_modifier_sets`
  ADD CONSTRAINT `res_product_modifier_sets_modifier_set_id_foreign` FOREIGN KEY (`modifier_set_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `res_tables`
--
ALTER TABLE `res_tables`
  ADD CONSTRAINT `res_tables_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `roles_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `selling_price_groups`
--
ALTER TABLE `selling_price_groups`
  ADD CONSTRAINT `selling_price_groups_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_adjustment_lines`
--
ALTER TABLE `stock_adjustment_lines`
  ADD CONSTRAINT `stock_adjustment_lines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustment_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stock_adjustment_lines_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD CONSTRAINT `tax_rates_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tax_rates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_expense_category_id_foreign` FOREIGN KEY (`expense_category_id`) REFERENCES `expense_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_expense_for_foreign` FOREIGN KEY (`expense_for`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `business_locations` (`id`),
  ADD CONSTRAINT `transactions_pjt_project_id_foreign` FOREIGN KEY (`pjt_project_id`) REFERENCES `pjt_projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_repair_job_sheet_id_foreign` FOREIGN KEY (`repair_job_sheet_id`) REFERENCES `repair_job_sheets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_payments`
--
ALTER TABLE `transaction_payments`
  ADD CONSTRAINT `transaction_payments_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_sell_lines`
--
ALTER TABLE `transaction_sell_lines`
  ADD CONSTRAINT `transaction_sell_lines_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax_rates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_sell_lines_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `units`
--
ALTER TABLE `units`
  ADD CONSTRAINT `units_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `units_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_crm_contact_id_foreign` FOREIGN KEY (`crm_contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variations`
--
ALTER TABLE `variations`
  ADD CONSTRAINT `variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variations_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_group_prices`
--
ALTER TABLE `variation_group_prices`
  ADD CONSTRAINT `variation_group_prices_price_group_id_foreign` FOREIGN KEY (`price_group_id`) REFERENCES `selling_price_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variation_group_prices_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_location_details`
--
ALTER TABLE `variation_location_details`
  ADD CONSTRAINT `variation_location_details_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `business_locations` (`id`),
  ADD CONSTRAINT `variation_location_details_variation_id_foreign` FOREIGN KEY (`variation_id`) REFERENCES `variations` (`id`);

--
-- Constraints for table `variation_templates`
--
ALTER TABLE `variation_templates`
  ADD CONSTRAINT `variation_templates_business_id_foreign` FOREIGN KEY (`business_id`) REFERENCES `business` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_value_templates`
--
ALTER TABLE `variation_value_templates`
  ADD CONSTRAINT `variation_value_templates_variation_template_id_foreign` FOREIGN KEY (`variation_template_id`) REFERENCES `variation_templates` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
