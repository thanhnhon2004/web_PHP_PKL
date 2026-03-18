-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2026 at 03:55 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dack`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 3, 'chư pưh', '2026-02-07 05:05:59', '2026-03-14 01:09:03');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photographer_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `image`, `photographer_name`, `created_at`, `updated_at`) VALUES
(1, 'Wedding Photography 2024', '1770454154_wedding-photography-2024.JPG', 'Phan Hoàng Linh', '2026-01-21 17:42:37', '2026-02-07 01:49:14'),
(2, 'Landscape Vietnam', '1770463645_landscape-vietnam.jpg', 'Kim Trúc', '2026-01-21 17:42:37', '2026-02-07 04:27:25'),
(3, 'Street Photography Saigon', '1770463809_street-photography-saigon.jpg', 'Trương Hoàng Nam', '2026-01-21 17:42:37', '2026-02-07 04:30:09');

-- --------------------------------------------------------

--
-- Table structure for table `album_images`
--

CREATE TABLE `album_images` (
  `id` bigint UNSIGNED NOT NULL,
  `album_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album_images`
--

INSERT INTO `album_images` (`id`, `album_id`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 1, '1770455401_69870169a5081.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(2, 1, '1770455404_6987016c02428.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(3, 1, '1770455406_6987016e28643.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(4, 1, '1770455408_6987017099445.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(5, 1, '1770455411_69870173165e1.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(6, 1, '1770455413_69870175c4875.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(7, 1, '1770455416_698701789d63c.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(8, 1, '1770455419_6987017bbf1e0.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(9, 1, '1770455422_6987017e9778a.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(10, 1, '1770455425_6987018191d19.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(11, 1, '1770455428_698701848a23f.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(12, 1, '1770455431_6987018777a46.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(13, 1, '1770455434_6987018a58fee.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(14, 1, '1770455437_6987018d7dfcd.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(15, 1, '1770455439_6987018fc6f57.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(16, 1, '1770455442_698701924845d.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(17, 1, '1770455444_69870194c1caa.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(18, 1, '1770455447_698701974bdf6.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(19, 1, '1770455449_69870199b77c4.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(20, 1, '1770455452_6987019c25a0f.JPG', '2026-02-07 02:10:54', '2026-02-07 02:10:54'),
(21, 2, '1770455615_6987023fd4197.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(22, 2, '1770455617_69870241e90cd.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(23, 2, '1770455620_6987024415bcc.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(24, 2, '1770455622_6987024645e10.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(25, 2, '1770455624_6987024868143.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(26, 2, '1770455626_6987024a94c7f.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(27, 2, '1770455628_6987024cbe7c8.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(28, 2, '1770455630_6987024ee1fe2.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(29, 2, '1770455633_69870251183ba.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(30, 2, '1770455635_698702532971c.JPG', '2026-02-07 02:13:57', '2026-02-07 02:13:57'),
(31, 3, '1770464085_69872355a662e.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(32, 3, '1770464088_698723584fbc9.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(33, 3, '1770464090_6987235ae87c9.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(34, 3, '1770464093_6987235d92852.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(35, 3, '1770464096_698723604922d.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(36, 3, '1770464099_6987236301a6f.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(37, 3, '1770464101_6987236588d83.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(38, 3, '1770464104_698723680ab55.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(39, 3, '1770464106_6987236a919fe.JPG', '2026-02-07 04:35:09', '2026-02-07 04:35:09'),
(40, 1, '1772079551_699fc9bf5f2d6.png', '2026-02-25 21:19:15', '2026-02-25 21:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Canon', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(2, 'Nikon', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(3, 'Sony', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(4, 'Fujifilm', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(5, 'Panasonic', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(6, 'Olympus', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(7, 'Leica', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(8, 'DJI', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(9, ' Manfrotto ', NULL, NULL),
(10, 'Benro', NULL, NULL),
(11, 'Godox', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2026-01-21 17:44:02', '2026-01-21 17:44:02'),
(2, 3, '2026-02-07 04:55:04', '2026-02-07 04:55:04'),
(3, 4, '2026-02-07 06:26:44', '2026-02-07 06:26:44'),
(4, 2, '2026-02-25 06:28:55', '2026-02-25 06:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(9, 4, 15, 1, '2026-02-25 06:29:34', '2026-02-25 06:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Máy ảnh', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(2, 'Ống kính', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(4, 'Đèn flash', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(5, 'Tripod & Gimbal', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(6, 'Túi đựng', '2026-01-21 17:42:37', '2026-01-21 17:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_roles_table', 1),
(2, '0000_01_01_000001_create_brands_table', 1),
(3, '0001_01_01_000000_create_users_table', 1),
(4, '0001_01_01_000001_create_cache_table', 1),
(5, '0001_01_01_000002_create_jobs_table', 1),
(6, '2024_01_08_000001_create_categories_table', 1),
(7, '2024_01_08_000002_create_products_table', 1),
(8, '2024_01_08_000003_create_product_images_table', 1),
(9, '2024_01_08_000004_create_albums_table', 1),
(10, '2024_01_08_000005_create_album_images_table', 1),
(11, '2024_01_08_000006_create_cart_table', 1),
(12, '2024_01_08_000007_create_cart_items_table', 1),
(13, '2024_01_08_000008_create_orders_table', 1),
(14, '2024_01_08_000009_create_order_items_table', 1),
(15, '2024_01_08_000010_create_addresses_table', 1),
(16, '2026_02_07_000001_fix_album_images_column_name', 2),
(17, '2026_02_07_085910_fix_album_images_column_name', 3),
(18, '2026_02_07_121811_add_otp_columns_to_users_table', 3),
(19, '2024_03_02_add_payment_fields_to_orders_table', 4),
(20, '2024_03_02_create_payment_histories_table', 5),
(21, '2026_03_12_000001_create_return_requests_table', 6),
(22, '2026_03_12_000002_alter_orders_status_add_returning', 7),
(23, '2026_03_14_000002_create_reviews_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','cancelled','returning') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_status` enum('pending','completed','failed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `transaction_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `payment_status`, `transaction_no`, `transaction_date`, `created_at`, `updated_at`) VALUES
(1, 1, 55000000.00, 'pending', 'pending', NULL, NULL, '2026-01-21 18:24:04', '2026-01-21 18:24:04'),
(2, 1, 3759000.00, 'pending', 'pending', NULL, NULL, '2026-02-07 04:43:41', '2026-02-07 04:43:41'),
(3, 3, 1253000.00, 'cancelled', 'pending', NULL, NULL, '2026-02-07 05:12:51', '2026-03-11 20:01:56'),
(4, 4, 1359600.00, 'pending', 'pending', NULL, NULL, '2026-02-07 06:27:23', '2026-02-07 06:27:23'),
(5, 3, 2719200.00, 'completed', 'pending', NULL, NULL, '2026-02-25 05:33:03', '2026-02-25 05:35:47'),
(6, 1, 2719200.00, 'pending', 'pending', NULL, NULL, '2026-02-25 21:18:02', '2026-02-25 21:18:02'),
(7, 1, 1359600.00, 'pending', 'pending', NULL, NULL, '2026-03-02 03:16:15', '2026-03-02 03:16:15'),
(8, 1, 1359600.00, 'pending', 'pending', NULL, NULL, '2026-03-02 03:19:04', '2026-03-02 03:19:04'),
(9, 1, 1359600.00, 'pending', 'pending', NULL, NULL, '2026-03-02 03:21:27', '2026-03-02 03:21:27'),
(10, 3, 1359600.00, 'cancelled', 'pending', NULL, NULL, '2026-03-11 17:55:12', '2026-03-11 17:58:22'),
(11, 3, 6453000.00, 'cancelled', 'pending', NULL, NULL, '2026-03-11 18:34:21', '2026-03-11 20:02:05'),
(12, 3, 3561200.00, 'pending', 'pending', NULL, NULL, '2026-03-11 18:38:27', '2026-03-11 18:38:27'),
(13, 3, 1359600.00, 'pending', 'pending', NULL, NULL, '2026-03-11 18:42:57', '2026-03-11 18:42:57'),
(14, 3, 34490000.00, 'pending', 'pending', NULL, NULL, '2026-03-11 18:46:49', '2026-03-11 18:46:49'),
(15, 3, 1359600.00, 'cancelled', 'pending', NULL, NULL, '2026-03-11 20:10:56', '2026-03-13 07:54:25'),
(16, 3, 1253000.00, 'cancelled', 'pending', NULL, NULL, '2026-03-13 07:16:19', '2026-03-13 07:43:49'),
(17, 3, 1359600.00, 'returning', 'pending', NULL, NULL, '2026-03-13 08:10:18', '2026-03-13 08:11:09'),
(18, 3, 1253000.00, 'pending', 'pending', NULL, NULL, '2026-03-17 07:06:50', '2026-03-17 07:06:50'),
(19, 3, 1253000.00, 'pending', 'pending', NULL, NULL, '2026-03-17 07:07:31', '2026-03-17 07:07:31'),
(20, 3, 1359600.00, 'pending', 'pending', NULL, NULL, '2026-03-17 07:09:28', '2026-03-17 07:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 2, 14, 1253000.00, 3, '2026-02-07 04:43:41', '2026-02-07 04:43:41'),
(3, 3, 14, 1253000.00, 1, '2026-02-07 05:12:51', '2026-02-07 05:12:51'),
(4, 4, 15, 1359600.00, 1, '2026-02-07 06:27:23', '2026-02-07 06:27:23'),
(5, 5, 15, 1359600.00, 2, '2026-02-25 05:33:03', '2026-02-25 05:33:03'),
(6, 6, 15, 1359600.00, 2, '2026-02-25 21:18:02', '2026-02-25 21:18:02'),
(7, 7, 15, 1359600.00, 1, '2026-03-02 03:16:15', '2026-03-02 03:16:15'),
(8, 8, 15, 1359600.00, 1, '2026-03-02 03:19:04', '2026-03-02 03:19:04'),
(9, 9, 15, 1359600.00, 1, '2026-03-02 03:21:27', '2026-03-02 03:21:27'),
(10, 10, 15, 1359600.00, 1, '2026-03-11 17:55:12', '2026-03-11 17:55:12'),
(11, 11, 19, 6453000.00, 1, '2026-03-11 18:34:21', '2026-03-11 18:34:21'),
(12, 12, 16, 3561200.00, 1, '2026-03-11 18:38:27', '2026-03-11 18:38:27'),
(13, 13, 15, 1359600.00, 1, '2026-03-11 18:42:57', '2026-03-11 18:42:57'),
(14, 14, 63, 34490000.00, 1, '2026-03-11 18:46:49', '2026-03-11 18:46:49'),
(15, 15, 15, 1359600.00, 1, '2026-03-11 20:10:56', '2026-03-11 20:10:56'),
(16, 16, 14, 1253000.00, 1, '2026-03-13 07:16:19', '2026-03-13 07:16:19'),
(17, 17, 15, 1359600.00, 1, '2026-03-13 08:10:18', '2026-03-13 08:10:18'),
(18, 18, 14, 1253000.00, 1, '2026-03-17 07:06:50', '2026-03-17 07:06:50'),
(19, 19, 14, 1253000.00, 1, '2026-03-17 07:07:31', '2026-03-17 07:07:31'),
(20, 20, 15, 1359600.00, 1, '2026-03-17 07:09:28', '2026-03-17 07:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_histories`
--

CREATE TABLE `payment_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `transaction_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` enum('vnpay','paypal','stripe','bank_transfer') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vnpay',
  `status` enum('pending','processing','completed','failed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `amount` decimal(12,2) NOT NULL,
  `response_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_message` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_histories`
--

INSERT INTO `payment_histories` (`id`, `order_id`, `transaction_no`, `method`, `status`, `amount`, `response_code`, `response_message`, `metadata`, `created_at`, `updated_at`) VALUES
(1, 8, NULL, 'vnpay', 'pending', 1359600.00, NULL, 'Payment initiated', NULL, '2026-03-02 03:19:09', '2026-03-02 03:19:09'),
(2, 9, NULL, 'vnpay', 'pending', 1359600.00, NULL, 'Payment initiated', NULL, '2026-03-02 03:21:42', '2026-03-02 03:21:42'),
(3, 9, NULL, 'vnpay', 'pending', 1359600.00, NULL, 'Payment initiated', NULL, '2026-03-02 03:21:47', '2026-03-02 03:21:47'),
(4, 9, NULL, 'vnpay', 'pending', 1359600.00, NULL, 'Payment initiated', NULL, '2026-03-02 03:22:01', '2026-03-02 03:22:01'),
(5, 10, NULL, 'vnpay', 'pending', 1359600.00, NULL, 'Payment initiated', NULL, '2026-03-11 17:56:02', '2026-03-11 17:56:02'),
(6, 20, NULL, 'vnpay', 'pending', 1359600.00, NULL, 'Payment initiated', NULL, '2026-03-17 07:09:40', '2026-03-17 07:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `brand_id`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(14, 'Canon EOS 5D Mark IV', 1253000.00, 'Là một chiếc DSLR full-frame chuyên nghiệp, \r\nrất được các nhiếp ảnh gia chuyên nghiệp sử dụng trong nhiều năm. \r\nMáy có cảm biến 30.4 MP Full-Frame CMOS, khả năng chụp ảnh chất lượng cao, màu sắc chính xác và dải tương phản rộng. \r\nHệ thống lấy nét tự động nhanh và chính xác, phù hợp nhiều thể loại như chân dung, cưới hỏi, phong cảnh và sản phẩm. Máy cũng hỗ trợ quay video 4K cùng nhiều chế độ phơi sáng khác nhau.', '1770261526_canon-eos-5d-mark-iv.jpg', 1, 1, 10, '2026-02-04 20:18:46', '2026-02-04 20:18:46'),
(15, 'Canon EOS R5', 1359600.00, 'Là máy ảnh mirrorless full-frame cao cấp của Canon, nổi bật với cảm biến ~45 MP và công nghệ lấy nét Dual Pixel CMOS AF rất mạnh mẽ.\r\n Máy hỗ trợ quay video 8K, thích hợp cả nhiếp ảnh lẫn quay phim chuyên nghiệp.\r\n Với thiết kế gọn nhẹ hơn DSLR truyền thống, R5 là lựa chọn tuyệt vời cho những ai muốn kết hợp ảnh tĩnh lẫn video chất lượng cao.', '1770261597_canon-eos-r5.jpg', 1, 1, 2, '2026-02-04 20:19:57', '2026-02-04 20:19:57'),
(16, 'Canon EOS R6 Mark II', 3561200.00, 'Một mirrorless full-frame hybrid mạnh mẽ, nổi bật ở khả năng chụp liên tiếp nhanh (lên đến 40 fps) và lấy nét tự động cực tốt.\r\n Máy cân bằng giữa chụp ảnh và quay phim, hỗ trợ video chất lượng cao, cùng ổn định hình ảnh in-body (IBIS) giúp giảm rung khi cầm tay. \r\nĐây là lựa chọn đáng giá nếu bạn cần một máy toàn năng hơn mức phổ thông nhưng không quá đắt.', '1770261674_canon-eos-r6-mark-ii.jpg', 1, 1, 4, '2026-02-04 20:21:14', '2026-02-04 20:21:14'),
(17, 'Canon EOS 90D', 5000000.00, 'Là máy ảnh DSLR cảm biến APS-C mạnh mẽ thuộc phân khúc bán chuyên. EOS 90D có cảm biến độ phân giải cao (~32.5 MP), chụp ảnh sắc nét, tốc độ chụp nhanh và pin lâu, phù hợp người mới nâng cấp từ máy phổ thông muốn chất lượng tốt hơn. Máy cũng phù hợp với thể loại ảnh thể thao, động vật hay chụp phong cảnh', '1770261736_canon-eos-90d.jpg', 1, 1, 3, '2026-02-04 20:22:16', '2026-02-04 20:22:16'),
(18, 'Fujifilm X‑E4 Mirrorless Camera', 25600000.00, 'Đây là một trong những máy ảnh Fujifilm được yêu thích nhờ thiết kế nhỏ gọn, nhẹ và hiện đại với cảm biến ~26 MP. Máy ghi video 4K, có màn hình lật thuận tiện cho vlog/selfie và giao diện thân thiện người dùng. Phù hợp cả chụp ảnh du lịch, chân dung hoặc sáng tạo nội dung', '1770261841_fujifilm-xe4-mirrorless-camera.jpg', 4, 1, 7, '2026-02-04 20:24:01', '2026-02-04 20:24:01'),
(19, 'Fujifilm X‑Pro1 Mirrorless', 6453000.00, 'Dòng X-Pro series nổi tiếng với phong cách ảnh cổ điển và trải nghiệm “rangefinder-style”. X-Pro1 mặc dù là phiên bản đời đầu nhưng vẫn được nhiều người thích bởi thiết kế hoài cổ, đặc điểm chụp ảnh đường phố và chân dung rất ấn tượng. Đây là lựa chọn lý tưởng nếu bạn thích cảm giác “nhiếp ảnh truyền thống” pha lẫn hiện đại.', '1770261895_fujifilm-xpro1-mirrorless-camera.jpg', 1, 1, 5, '2026-02-04 20:24:55', '2026-02-04 20:58:34'),
(20, 'Fujifilm X‑ half Digital Camera', 6354000.00, 'Đây là lựa chọn máy compact đơn giản hơn, dễ dùng với khả năng chụp ảnh đẹp hơn smartphone, phù hợp người mới bắt đầu hoặc như máy phụ trong những chuyến đi. Dù không mạnh như mirrorless X-series, model này mang đặc trưng màu sắc “film-like” của Fujifilm', '1770261949_fujifilm-x-half-digital-camera.jpg', 1, 1, 5, '2026-02-04 20:25:49', '2026-02-04 20:25:49'),
(22, 'Máy ảnh Nikon Z6 III', 1326000.00, 'Một trong những máy ảnh mirrorless full-frame nổi bật của Nikon với cảm biến mạnh, khả năng quay video 6K/4K và tốc độ chụp nhanh.\r\nHệ thống lấy nét tự động rộng, AI nhận diện chủ thể hỗ trợ cả người lẫn động vật.\r\nThích hợp với cả nhiếp ảnh chuyên nghiệp và quay video nghiêm túc, từ phong cảnh đến sự kiện, thể thao hay chân dung cao cấp', '1770262147_may-anh-nikon-z6-iii.jpg', 2, 1, 8, '2026-02-04 20:29:07', '2026-02-04 20:29:07'),
(24, 'Nikon Z9', 99900000.00, 'Máy ảnh mirrorless chuyên nghiệp, cảm biến 45.7MP, chụp liên tục 20fps', '1770263529_nikon-z9.jpg', 2, 1, 8, '2026-02-04 20:34:41', '2026-02-04 20:52:09'),
(25, 'Sony A7 IV', 62000000.00, 'Máy ảnh Full-frame đa năng, 33MP, quay video 4K 60fps', '1770263656_sony-a7-iv.jpg', 3, 1, 20, '2026-02-04 20:34:41', '2026-02-04 20:54:16'),
(26, 'Fujifilm X-T5', 48000000.00, 'Máy ảnh APS-C 40MP với thiết kế cổ điển, chất lượng màu Fujifilm', '1770263707_fujifilm-x-t5.jpg', 4, 1, 12, '2026-02-04 20:34:41', '2026-02-04 20:55:07'),
(28, 'Nikon Z 85mm f/1.8 S', 19900000.00, 'Ống kính chân dung với khẩu độ lớn, chất lượng hình ảnh tuyệt vời', '1770263731_nikon-z-85mm-f18-s.jpg', 2, 2, 25, '2026-02-04 20:34:41', '2026-02-04 20:55:31'),
(35, 'Panasonic Lumix S5 II', 47000000.00, 'Máy ảnh full-frame, lấy nét pha lai, quay 6K', '1770263671_panasonic-lumix-s5-ii.jpg', 5, 1, 11, '2026-02-04 20:34:41', '2026-02-04 20:54:31'),
(38, 'OM SYSTEM OM-5', 32000000.00, 'Máy ảnh MFT chống thời tiết, gọn nhẹ, đa dụng', '1770263595_om-system-om-5.jpg', 6, 1, 10, '2026-02-04 20:34:41', '2026-02-04 20:53:15'),
(40, 'Nikon Z9', 99900000.00, 'Máy ảnh mirrorless chuyên nghiệp, cảm biến 45.7MP, chụp liên tục 20fps', '1770262990_nikon-z9.jpg', 2, 1, 8, '2026-02-04 20:35:46', '2026-02-04 20:43:10'),
(41, 'Sony A7 IV', 62000000.00, 'Máy ảnh Full-frame đa năng, 33MP, quay video 4K 60fps', '1770263167_sony-a7-iv.jpg', 3, 1, 20, '2026-02-04 20:35:46', '2026-02-04 20:46:07'),
(42, 'Fujifilm X-T5', 48000000.00, 'Máy ảnh APS-C 40MP với thiết kế cổ điển, chất lượng màu Fujifilm', '1770263138_fujifilm-x-t5.jpg', 4, 1, 12, '2026-02-04 20:35:46', '2026-02-04 20:45:38'),
(44, 'Nikon Z 85mm f/1.8 S', 19900000.00, 'Ống kính chân dung với khẩu độ lớn, chất lượng hình ảnh tuyệt vời', '1770263126_nikon-z-85mm-f18-s.jpg', 2, 2, 25, '2026-02-04 20:35:46', '2026-02-04 20:45:26'),
(45, 'Sony FE 70-200mm f/2.8 GM II', 68000000.00, 'Ống kính tele zoom chuyên nghiệp thế hệ mới', '1770263068_sony-fe-70-200mm-f28-gm-ii.jpg', 3, 2, 10, '2026-02-04 20:35:46', '2026-02-04 20:44:28'),
(49, 'Sony ZV-E1', 56000000.00, 'Máy ảnh vlog full-frame nhỏ gọn, tối ưu quay video', '1770263184_sony-zv-e1.jpg', 3, 1, 10, '2026-02-04 20:35:46', '2026-02-04 20:46:24'),
(51, 'Panasonic Lumix GH6', 52000000.00, 'Máy ảnh Micro Four Thirds, quay 5.7K, chống rung mạnh', '1770263260_panasonic-lumix-gh6.jpg', 5, 1, 18, '2026-02-04 20:35:46', '2026-02-04 20:47:40'),
(52, 'Panasonic Lumix S1R', 83000000.00, 'Máy ảnh full-frame 47MP, chất lượng ảnh tĩnh vượt trội', '1770263273_panasonic-lumix-s1r.jpg', 5, 1, 30, '2026-02-04 20:35:46', '2026-02-04 20:47:53'),
(53, 'Olympus OM-D E-M10 Mark IV', 20000000.00, 'Máy ảnh MFT nhỏ gọn, phù hợp du lịch và người mới', '1770263307_olympus-om-d-e-m10-mark-iv.jpg', 6, 1, 22, '2026-02-04 20:35:46', '2026-02-04 20:48:27'),
(54, 'Olympus OM-D E-M1 Mark III', 42000000.00, 'Máy ảnh MFT chuyên nghiệp, chụp liên tục nhanh', '1770263104_olympus-om-d-e-m1-mark-iii.jpg', 6, 1, 11, '2026-02-04 20:35:46', '2026-02-04 20:45:04'),
(55, 'OM SYSTEM OM-5', 32000000.00, 'Máy ảnh MFT chống thời tiết, gọn nhẹ, đa dụng', '1770263320_om-system-om-5.jpg', 6, 1, 18, '2026-02-04 20:35:46', '2026-02-04 20:48:40'),
(56, 'Leica SL2', 98000000.00, 'Máy ảnh full-frame 47MP, thân máy chắc chắn, chống thời tiết', '1770263227_leica-sl2.jpg', 7, 1, 9, '2026-02-04 20:35:46', '2026-02-04 20:47:07'),
(57, 'Leica D-Lux 7', 32000000.00, 'Máy ảnh compact cảm biến lớn, ống kính Leica DC', '1770263417_leica-d-lux-7.jpg', 7, 1, 23, '2026-02-04 20:35:46', '2026-02-04 20:50:17'),
(60, 'Sony FE 70‑200mm f/2.8 GM OSS', 49999000.00, 'Zoom tele chuyên nghiệp của Sony G-Master, khẩu lớn f/2.8 cho ảnh sắc nét, bokeh đẹp. Tuyệt vời cho thể thao, chân dung và sự kiện.', '1770451741_sony-fe-70200mm-f28-gm-oss.jpg', 3, 2, 5, '2026-02-07 01:09:01', '2026-02-07 01:09:01'),
(61, 'Sony FE 600mm f/4 GM OSS', 35339000.00, 'Siêu tele 600 mm — lý tưởng chụp động vật hoang dã và thể thao ở xa. Chất lượng quang học đỉnh cao từ Sony.', '1770451826_sony-fe-600mm-f4-gm-oss.jpg', 3, 2, 6, '2026-02-07 01:10:26', '2026-02-07 01:10:26'),
(62, 'Canon 3447C005 Super Telephoto', 61790000.00, 'Ống kính siêu tele cho Canon, phù hợp chụp thiên nhiên, chim, thể thao từ xa.', '1770451897_canon-3447c005-super-telephoto.jpg', 1, 2, 9, '2026-02-07 01:11:37', '2026-02-07 01:11:37'),
(63, 'Canon 4318C005 Zoom Lens', 34490000.00, 'Ống zoom tiêu chuẩn dùng với nhiều dòng Canon — hữu ích khi đi du lịch, chụp đời thường.', '1770452001_canon-4318c005-zoom-lens.jpg', 1, 2, 6, '2026-02-07 01:13:21', '2026-02-07 01:13:21'),
(64, 'Sigma 18‑50mm f/2.8 DC DN', 12390000.00, NULL, '1770452130_sigma-1850mm-f28-dc-dn.jpg', 4, 2, 4, '2026-02-07 01:15:30', '2026-02-07 01:15:30'),
(65, 'Nikon AF‑S Nikkor 35mm f/1.4G', 28000000.00, 'Zoom tele linh hoạt cho hệ Nikon Z với chất lượng quang học tốt và khẩu lớn f/2.8.', '1770452194_nikon-afs-nikkor-35mm-f14g.jpg', 2, 2, 8, '2026-02-07 01:16:34', '2026-02-07 01:16:34'),
(66, 'Manfrotto MT055CXPRO4 Carbon Fiber Tripod', 12000000.00, 'Tripod carbon cao cấp, rất chắc và nhẹ, phù hợp chụp phong cảnh, chân dung & phơi sáng lâu', '1770452992_manfrotto-mt055cxpro4-carbon-fiber-tripod.jpg', 9, 5, 5, '2026-02-07 01:29:52', '2026-02-07 01:29:52'),
(67, 'Benro SuperSlim Carbon Fiber Tripod', 10500000.00, 'Chân tripod carbon gọn nhẹ cho du lịch và chụp ngoài trời.', '1770453061_benro-superslim-carbon-fiber-tripod.jpg', 10, 5, 6, '2026-02-07 01:31:01', '2026-02-07 01:31:01'),
(68, 'Godox Litemons RGB Pocket-Size LED Video Light', 486000.00, 'Đèn LED nhỏ gọn gắn hotshoe, thay đổi màu & nhiệt độ ánh sáng cho video/ảnh.', '1770453131_godox-litemons-rgb-pocket-size-led-video-light.jpg', 11, 4, 6, '2026-02-07 01:32:11', '2026-02-07 01:32:11'),
(69, 'Peak Design Everyday Backpack 20L', 9000000.00, 'Túi ba lô cao cấp thiết kế cho nhiếp ảnh gia chuyên nghiệp & du lịch. Có thể chứa body + nhiều ống kính, laptop 15″ và phụ kiện. Chất liệu bền, chống mưa nhẹ, nhiều ngăn thông minh giúp bạn phân chia gear dễ dàng và truy cập nhanh trong mọi tình huống chụp. Đây là một trong những lựa chọn “all-in-one” tốt nhất hiện nay, được rất nhiều thợ chọn vì độ linh hoạt và phong cách hiện đại', '1770453290_peak-design-everyday-backpack-20l.jpg', 8, 6, 15, '2026-02-07 01:34:50', '2026-02-07 01:34:50'),
(70, 'Lowepro Fastpack Pro BP 250 AW III', 2229000.00, 'Ba lô máy ảnh phổ biến trong cộng đồng nhiếp ảnh gia tầm trung — vừa có ngăn chính chứa body + lens + phụ kiện, vừa có ngăn riêng cho máy tính bảng/laptop nhỏ. Thiết kế tiện dụng, dây đeo chắc và khả năng bảo vệ thiết bị tốt với lớp đệm dày. Đây là lựa chọn rất “value-for-money” cho người chụp ảnh thường xuyên đi lại hoặc làm việc ngoài trời', '1770453345_lowepro-fastpack-pro-bp-250-aw-iii.jpg', 9, 6, 5, '2026-02-07 01:35:45', '2026-02-07 01:35:45');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_requests`
--

CREATE TABLE `return_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_ids` json NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` json DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `admin_reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_requests`
--

INSERT INTO `return_requests` (`id`, `order_id`, `user_id`, `product_ids`, `reason`, `images`, `status`, `admin_reason`, `created_at`, `updated_at`) VALUES
(1, 15, 3, '[\"15\"]', 'hàng xấu', '[\"returns/cHl5sddCTmGrRDhXuFZ5cey9CS6dnnkL4vcKbW5j.jpg\"]', 'pending', NULL, '2026-03-11 20:50:23', '2026-03-11 20:50:23'),
(2, 15, 3, '[\"15\"]', 'hàng xấu', '[\"returns/VykzFQqnCfSwSqVrDdlwtPTQcU0C696UGeGjUwnl.jpg\"]', 'rejected', 'vi phạm hợp đồng', '2026-03-11 20:52:19', '2026-03-13 07:45:31'),
(3, 16, 3, '[\"14\"]', 'lỗi sản phẩm', '[\"returns/0xPYOXQCvvH74KSWhH1rhM0GhAlIEFysjRZ8JcBi.jpg\"]', 'approved', NULL, '2026-03-13 07:17:51', '2026-03-13 07:40:44'),
(4, 16, 3, '[\"14\"]', 'trả hàng', '[\"returns/9PPiiZ44bkrf5VeVU7amcgw1bxlpyBYAZkVoNt98.jpg\"]', 'approved', NULL, '2026-03-13 07:43:33', '2026-03-13 07:43:49'),
(5, 15, 3, '[\"15\"]', 'abc', '[\"returns/kvpoeVVvEed87zD4jdQLuyoVevM6I6meBK8SeDDF.jpg\"]', 'approved', NULL, '2026-03-13 07:50:35', '2026-03-13 07:54:25'),
(6, 17, 3, '[\"15\"]', 'g', '[\"returns/srvTKpiqZ3MnXPtOmyeyDsk4YrEQige4XkKRzphI.png\"]', 'pending', NULL, '2026-03-13 08:11:09', '2026-03-13 08:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `rating` tinyint NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `images` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `order_id`, `rating`, `comment`, `images`, `created_at`, `updated_at`) VALUES
(1, 3, 15, 5, 3, 'hàng đẹp chất lượng', '[]', '2026-03-14 00:15:22', '2026-03-14 00:15:22'),
(2, 3, 15, 5, 5, 'abc', '[]', '2026-03-14 00:22:30', '2026-03-14 00:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(2, 'user', '2026-01-21 17:42:37', '2026-01-21 17:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4UcSelXpbQ2U9aed11dgwuUPMjW1rSAaqsNgQi0u', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHdNOXR0UWd4cmtxQjVQeDZQYWd1TlFxdzR0eEJIR05ZWWNvVTBHZiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1773805890),
('7EncVVeT1gBTONEJlwnUoV0cA7X7lWSmOdeQqKsn', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieGFaTFh1NE5iZ3c2QTNHN2M0eExGTWZQc092TGNzOTlmYmNkNHNGUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9kYWNrLnRlc3QiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1773801173),
('ImzVsoK8Fn2UadW4TlzRTWlULHfQELsvkPKVCws3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVnJSRnBwSzc5YjIxUGRhdVI3TThFcHJSZ0p2OVpialJ0SklGcG5NQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9kYWNrLnRlc3QvYWRtaW4vb3JkZXJzIjtzOjU6InJvdXRlIjtzOjE4OiJhZG1pbi5vcmRlcnMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1773758396);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `otp_code` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `status` enum('active','locked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `role_id` bigint UNSIGNED NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `otp_code`, `otp_expires_at`, `password`, `phone`, `birthday`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin CameraMan', 'admin@cameramam.com', NULL, NULL, NULL, '$2y$12$rN8jXEFyOxxe3bqDwYHrH.OEHA27DRpVeHGl.6jbI3pXidny1CFSO', '0901234567', NULL, 'active', 1, '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(2, 'Nguyễn Văn A', 'user@example.com', NULL, NULL, NULL, '$2y$12$./HQ4NhtADoF5ophsox8i.6rwAIKgLzEw1Pm6s4K5ymHZv7A.xaZe', '0912345678', '1995-05-15', 'active', 2, '2026-01-21 17:42:37', '2026-01-21 17:42:37'),
(3, 'đỗ thành nhơn43', 'thanhnhon2k4@gmail.com', NULL, NULL, NULL, '$2y$12$lmRz/pY0aToLHFcul20OD.qkcDX7vINjN3QuxxIhwK0CVdxrpm1Dy', '03579438112', '2025-12-27', 'active', 2, '2026-02-07 04:54:56', '2026-03-14 01:14:01'),
(4, 'đỗ thành nhơn', 'nhonthanh882@gmail.com', NULL, NULL, NULL, '$2y$12$xDpPvE5sIPpsOnYBuTTtUOim3ohm9QqdcmzyXuRt0JuAx2Bv5443S', '0357943811', '2026-01-29', 'active', 2, '2026-02-07 05:37:18', '2026-02-07 05:41:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_images`
--
ALTER TABLE `album_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_images_album_id_foreign` (`album_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_histories_transaction_no_unique` (`transaction_no`),
  ADD KEY `payment_histories_transaction_no_index` (`transaction_no`),
  ADD KEY `payment_histories_order_id_index` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_requests_order_id_foreign` (`order_id`),
  ADD KEY `return_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `album_images`
--
ALTER TABLE `album_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment_histories`
--
ALTER TABLE `payment_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_requests`
--
ALTER TABLE `return_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `album_images`
--
ALTER TABLE `album_images`
  ADD CONSTRAINT `album_images_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_histories`
--
ALTER TABLE `payment_histories`
  ADD CONSTRAINT `payment_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_requests`
--
ALTER TABLE `return_requests`
  ADD CONSTRAINT `return_requests_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `return_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
