-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2025 at 08:24 PM
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
-- Database: `ajps`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajps.reservations`
--

CREATE TABLE `ajps.reservations` (
  `first_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone` int(50) NOT NULL,
  `prefered_date` date NOT NULL,
  `location` varchar(250) NOT NULL,
  `tatto_info` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `artworks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`artworks`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`id`, `fullname`, `contact_number`, `email`, `description`, `profile_photo`, `cover_photo`, `artworks`, `created_at`, `updated_at`) VALUES
(1, 'pabs', 'asdd', 'pablo@gmail.comm', NULL, NULL, NULL, NULL, '2025-10-14 10:07:03', '2025-10-14 10:18:03'),
(2, 'Cara Nicolas', '09122109970', 'pablojhay321@gmail.com', NULL, NULL, NULL, NULL, '2025-10-14 10:30:22', '2025-10-14 10:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `artists_old`
--

CREATE TABLE `artists_old` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bio` varchar(250) DEFAULT NULL,
  `profile_picture` varchar(250) DEFAULT NULL,
  `cover_photo` varchar(250) DEFAULT NULL,
  `artworks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`artworks`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artists_old`
--

INSERT INTO `artists_old` (`id`, `fullname`, `contact_number`, `email`, `description`, `profile_photo`, `created_at`, `updated_at`, `bio`, `profile_picture`, `cover_photo`, `artworks`) VALUES
(5, 'Cara Nicolas', '09122109971', 'pablojhay321@gmail.com', NULL, NULL, '2025-10-01 16:22:53', '2025-10-11 12:24:57', 'dddasd', NULL, NULL, NULL),
(6, 'asd', 'ddda', 'asd@asd', NULL, NULL, '2025-10-11 12:16:18', '2025-10-11 12:37:53', 'asd', NULL, NULL, NULL),
(8, 'asd', 'asd', 'admin@example.com', NULL, NULL, '2025-10-11 12:35:57', '2025-10-11 12:35:57', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `artist_pages`
--

CREATE TABLE `artist_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_photo` varchar(255) DEFAULT NULL,
  `image_path` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artwork_images`
--

CREATE TABLE `artwork_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `artist_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `service` varchar(50) NOT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` varchar(50) DEFAULT NULL,
  `instruction` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `first_name`, `last_name`, `email`, `phone`, `service`, `preferred_date`, `preferred_time`, `instruction`, `status`, `created_at`, `updated_at`) VALUES
(8, 'jayson', 'pablo', 'try', '123123', 'try', '2025-09-17', '10pm', 'asd', 'Cancelled', '2025-09-16 01:52:53', NULL),
(82, 'asd', 'asd', 'asd@asd', 'asd', 'asd', '2025-10-10', '02:50', 'ayaw nya daw', 'Cancelled', '2025-10-01 19:51:08', '2025-10-01 19:51:08'),
(83, 'asdasd', 'asd', 'asd@asdasd', 'asd', 'asd', '2025-10-17', '13:00', 'asd', 'Cancelled', '2025-10-01 19:58:32', '2025-10-01 19:58:47'),
(84, 'dasd', 'asd', 'pablo@gmail.com', 'asd', 'asd', '2025-10-10', '14:59', 'dasd', 'Cancelled', '2025-10-01 19:59:25', '2025-10-01 19:59:35'),
(85, 'asd', 'asd', 'asd@asdasd', 'asd', 'asd', '2025-10-10', '03:59', 'asd', 'Cancelled', '2025-10-01 20:00:01', '2025-10-01 20:06:04'),
(86, 'dasd', 'asd', 'pablo@gmail.com', 'asd', 'asd', '2025-10-15', '12:08', 'asd', 'Approved', '2025-10-01 20:06:40', '2025-10-01 20:07:11'),
(87, 'asd', 'sd', 'pablo@pablo', 'asd', 'asd', '2025-10-06', '12:11', 'asd', 'Cancelled', '2025-10-01 20:08:19', '2025-10-01 20:08:37'),
(88, 'asd', 'asd', 'asd@asdasd', 'asd', 'asd', '2025-10-10', '12:23', NULL, 'Cancelled', '2025-10-01 20:23:55', '2025-10-01 20:24:23'),
(89, 'asd', 'asd', 'asd@asd', 'asd', 'asd', '2025-10-17', '14:24', NULL, 'Cancelled', '2025-10-01 20:24:39', '2025-10-01 20:24:43'),
(90, 'asd', 'asd', 'pablo@gmail.com', 'asd', 'asd', '2025-10-16', '15:24', 'try', 'Approved', '2025-10-01 20:25:01', '2025-10-01 20:57:32'),
(91, 'asd', 'asd', 'asd@asdasd', 'asd', 'asd', '2025-10-24', '13:05', 'asd', 'Approved', '2025-10-01 21:02:24', '2025-10-01 21:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_reports`
--

CREATE TABLE `delivery_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `date_receive` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_reports`
--

INSERT INTO `delivery_reports` (`id`, `company_name`, `item_name`, `quantity`, `cost_price`, `date_receive`, `created_at`, `updated_at`) VALUES
(1, 'malupi', 'item2', 23, 200.00, '2025-10-06', '2025-10-05 05:57:40', '2025-10-05 05:57:40'),
(2, 'malupi', 'item1', 200, 1.00, '2025-10-06', '2025-10-05 06:25:21', '2025-10-05 06:25:21'),
(3, 'd', 'item1', 2, 2.00, '2025-10-15', '2025-10-05 06:25:55', '2025-10-05 06:25:55'),
(4, 'malupitx', 'item2', 50, 200.00, '2025-10-15', '2025-10-05 06:27:10', '2025-10-05 06:27:10'),
(5, 'malupi', 'item1', 33, 200.00, '2025-10-09', '2025-10-05 07:30:55', '2025-10-05 07:30:55'),
(6, 'malupi', 'item2', 200, 500.00, '2025-10-07', '2025-10-05 07:36:08', '2025-10-05 07:36:08'),
(7, 'admin', 'Jayson', 600, 200.00, '2025-10-12', '2025-10-10 12:04:08', '2025-10-10 12:04:08'),
(8, 'admin', 'Jayson', 1000, 800.00, '2025-10-10', '2025-10-10 12:19:12', '2025-10-10 12:19:12'),
(9, 'malupitx', 'asd', 200, 600.00, '2025-10-12', '2025-10-11 09:56:11', '2025-10-11 09:56:11'),
(10, 'admin', 'Super Admin', 70, 700.00, '2025-10-12', '2025-10-11 11:58:02', '2025-10-11 11:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `category`, `cost_price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'dd', 'asd', 500.00, 5, '0000-00-00 00:00:00', '2025-09-30 09:46:07'),
(2, 'item1', 'earings', 200.00, 10, '2025-09-30 09:08:30', '2025-09-30 09:46:02'),
(3, 'item1', 'earings', 222.00, 2, '2025-09-30 09:44:50', '2025-09-30 09:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `cost_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `selling_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `product_name`, `category`, `cost_price`, `selling_price`, `quantity`, `created_at`, `updated_at`, `photo`, `title`, `description`) VALUES
(1, 'item1', 'earings', 200.00, 200.00, 333, '2025-10-05 07:30:55', '2025-10-11 11:01:18', '/images/about/shopitem/1760209278_Screenshot 2025-07-02 214739.png', NULL, 'trydd'),
(2, 'item2', 'earingss', 500.00, 600.00, 200, '2025-10-05 07:36:08', '2025-10-11 11:04:09', '/images/about/shopitem/1760209449_Screenshot 2025-07-02 173503.png', 'asd', 'dd'),
(4, 'Jayson', 'earings', 200.00, 400.00, 600, '2025-10-10 12:04:08', '2025-10-11 11:48:56', '/images/about/shopitem/1760212136_Screenshot 2025-08-22 202009.png', NULL, 'asdd'),
(5, 'Jayson', 'earingss', 800.00, 300.00, 5000, '2025-10-10 12:19:12', '2025-10-11 09:50:18', '/storage/uploads/inventory/1760205018_Screenshot 2025-01-24 162230.png', NULL, 'pablo'),
(6, 'asd', 'asd', 600.00, 300.00, 200, '2025-10-11 09:56:11', '2025-10-11 10:03:46', NULL, NULL, 'asd'),
(7, 'Dapat easy lang pab', 'asd', 700.00, 23.00, 70, '2025-10-11 11:58:02', '2025-10-11 11:58:45', '/images/about/shopitem/1760212725_Screenshot 2025-08-23 025739.png', NULL, 'kahit magkano');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(9, '2025_08_30_113941_create_reservations_table', 2),
(10, '2025_09_01_164558_add_role_to_users_table', 3),
(11, '2025_09_20_104345_create_products_table', 4),
(12, '2025_09_21_093038_create_suppliers_table', 5),
(13, '2025_09_30_164543_create_equipment_table', 6),
(14, '2025_10_01_194321_create_artists_table', 7),
(15, '2025_10_01_202202_create_artist_pages_table', 8),
(16, '2025_10_04_112248_create_inventories_table', 9),
(17, '2025_10_11_201412_create_artwork_images_table', 10),
(18, '2025_10_13_182706_create_tattogallery_table', 11),
(19, '2025_10_13_184945_create_tattoogallery_table', 12),
(20, '2025_10_13_185637_create_tattoogallery_table', 13),
(21, '2025_10_13_190756_create_tattoo_galleries_table', 14),
(22, '2025_10_13_192350_create_tattoo_galleries_table', 15),
(23, '2025_10_14_125137_create_piercing_galleries_table', 16),
(25, '2025_10_14_140942_add_piercingimages_to_piercing_galleries_table', 17),
(26, '2025_10_14_141120_create_piercing_galleries_table', 17),
(27, '2025_10_14_174646_add_artworks_to_artists_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `piercing_galleries`
--

CREATE TABLE `piercing_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `headertitle` varchar(255) DEFAULT NULL,
  `listheader` varchar(255) DEFAULT NULL,
  `piercingimages` longtext DEFAULT NULL,
  `pricelistimages` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `piercing_galleries`
--

INSERT INTO `piercing_galleries` (`id`, `headertitle`, `listheader`, `piercingimages`, `pricelistimages`, `created_at`, `updated_at`) VALUES
(6, 'Piercing Collections & Info', 'Piercing Price List & Jewelry', '\"[\\\"1760457072_output.jpg\\\",\\\"1760457092_output1.jpg\\\",\\\"1760457102_output2.jpg\\\",\\\"1760457164_output4.jpg\\\"]\"', '\"[\\\"1760457072_pl1.jpeg\\\",\\\"1760457092_pl2.jpeg\\\",\\\"1760457102_pl3.jpeg\\\"]\"', '2025-10-14 07:51:12', '2025-10-14 07:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `cost_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `cost_price`, `selling_price`, `created_at`, `updated_at`) VALUES
(1, 'item1', 'earings', 200.00, 300.00, NULL, '2025-09-20 03:25:58'),
(2, 'item2', 'earingss', 200.00, 1500.00, NULL, '2025-10-01 18:43:44'),
(4, 'Jayson', 'earings', 200.00, 400.00, '2025-10-06 20:14:12', '2025-10-06 20:14:12'),
(5, 'Jayson', 'earingss', 200.00, 400.00, '2025-10-10 12:18:17', '2025-10-10 12:18:17'),
(6, 'asd', 'asd', 44.00, 44.00, '2025-10-11 09:55:31', '2025-10-11 09:55:31'),
(7, 'Super Admin', 'asd', 200.00, 400.00, '2025-10-11 11:57:19', '2025-10-11 11:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `preferred_time` time DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `instruction` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dfZqLGdMqcDI9X5UHxWAFAqPkxAjp09fH9R6XSEt', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDJ5cU51NXB3dm93ejhjRWVURVN6Y2hUMnNWOWdyOU9sS2c4R2IyRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9waWVyY2luZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760549791),
('DpSCtlZaaAVTg7QQzbOgI6XErC8iqFmo7oHCL2ZY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjhsczJGMldVdXVNWXVDTlczWEVETXRoYnZiQkI3SGRreDRUQm9iQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760537537),
('ePXKd77qZTcDv4z7n7sJxChPgd1rzA4iVY9m1wc1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTJUWkpPUDlacWM0dXphYmJlSjY0Y0NzeVRoa1F5V1ZMQjhnVVNsYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9waWVyY2luZyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1760466670),
('QWfckkdhcTUFMs6MBa1DgTn1ofcUw9JHrWkbPNjW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiZFlJVzJucE5IN1VRM3Q5RDZSWjFXaUFjdTV6VHVjN3Nkc2U3eklZOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaG9wIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjg7czo5OiJ1c2VyX25hbWUiO3M6NToicGFibG8iO3M6MTA6InVzZXJfZW1haWwiO3M6MTY6InBhYmxvQGdtYWlsLmNvbW0iO3M6OToidXNlcl9yb2xlIjtzOjExOiJzdXBlcl9hZG1pbiI7czoxOToic3VwZXJhZG1pbl92ZXJpZmllZCI7YjoxO30=', 1760466756);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company_name`, `address`, `contact`, `created_at`, `updated_at`) VALUES
(1, 'jassen', 'malupi', 'kahit saand', '09122109970', NULL, '2025-10-01 18:43:00'),
(3, 'd', 'd', 'd', 'dd', '2025-09-21 02:04:03', '2025-10-01 18:42:45'),
(5, 'dsd', 'sd', 'asd', 'asd', '2025-10-04 03:44:20', '2025-10-04 03:44:20'),
(6, 'opablo', 'malupitx', 'zxc', 'asd', '2025-10-04 03:52:02', '2025-10-04 03:52:02'),
(7, 'Super Admin', 'admin', 'ads', '09122109970', '2025-10-10 12:03:39', '2025-10-10 12:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `tattoallery`
--

CREATE TABLE `tattoallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headertitle` varchar(255) DEFAULT NULL,
  `tattooimages` varchar(255) DEFAULT NULL,
  `listheader` varchar(255) DEFAULT NULL,
  `pricelistimages` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tattoogallery`
--

CREATE TABLE `tattoogallery` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headertitle` varchar(255) DEFAULT NULL,
  `tattooimages` varchar(255) DEFAULT NULL,
  `listheader` varchar(255) DEFAULT NULL,
  `pricelistimages` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tattoo_galleries`
--

CREATE TABLE `tattoo_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headertitle` varchar(255) NOT NULL,
  `tattooimages` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tattooimages`)),
  `listheader` varchar(255) NOT NULL,
  `pricelistimages` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tattoo_galleries`
--

INSERT INTO `tattoo_galleries` (`id`, `headertitle`, `tattooimages`, `listheader`, `pricelistimages`, `created_at`, `updated_at`) VALUES
(30, 'ART OF BODY TATTOO GALLERY', '\"[\\\"1760456961_tatt1.jpeg\\\"]\"', 'Price List', '\"[\\\"1760456961_pl1.jpeg\\\"]\"', '2025-10-14 07:49:21', '2025-10-14 07:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'Super Admin', 'pablo@pablo', NULL, '$2y$12$Osuuu1ujYMbkhdLs7lV5f.iAV49VdWAEkf5sH3yiiVApyTwUDICx.', 'super_admin', NULL, '2025-09-01 09:14:24', '2025-10-01 19:28:37'),
(8, 'pablo', 'pablo@gmail.comm', NULL, 'pablo', 'super_admin', NULL, NULL, NULL),
(15, 'Jaysons', 'pablojhay321@gmail.com', NULL, '$2y$12$MxZSD78/9eOi6250ZCgH2.zL/UEwj8q5x5Q/3OH9jX8eF4.0DNM3C', 'admin', NULL, '2025-10-01 18:40:55', '2025-10-01 18:43:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `artists_old`
--
ALTER TABLE `artists_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artists_email_unique` (`email`);

--
-- Indexes for table `artist_pages`
--
ALTER TABLE `artist_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist_pages_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `artwork_images`
--
ALTER TABLE `artwork_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artwork_images_artist_id_foreign` (`artist_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `delivery_reports`
--
ALTER TABLE `delivery_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `piercing_galleries`
--
ALTER TABLE `piercing_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tattoallery`
--
ALTER TABLE `tattoallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tattoogallery`
--
ALTER TABLE `tattoogallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tattoo_galleries`
--
ALTER TABLE `tattoo_galleries`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artists_old`
--
ALTER TABLE `artists_old`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `artwork_images`
--
ALTER TABLE `artwork_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `delivery_reports`
--
ALTER TABLE `delivery_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `piercing_galleries`
--
ALTER TABLE `piercing_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tattoallery`
--
ALTER TABLE `tattoallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tattoogallery`
--
ALTER TABLE `tattoogallery`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tattoo_galleries`
--
ALTER TABLE `tattoo_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist_pages`
--
ALTER TABLE `artist_pages`
  ADD CONSTRAINT `artist_pages_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists_old` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `artwork_images`
--
ALTER TABLE `artwork_images`
  ADD CONSTRAINT `artwork_images_artist_id_foreign` FOREIGN KEY (`artist_id`) REFERENCES `artists_old` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
