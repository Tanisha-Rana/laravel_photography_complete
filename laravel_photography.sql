-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2026 at 03:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_photography`
--

-- --------------------------------------------------------

--
-- Table structure for table `advance_payments`
--

CREATE TABLE `advance_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_mode` enum('upi','card','netbanking') DEFAULT NULL,
  `payment_status` enum('success','failed','pending') NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slot_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `appointment_date` date NOT NULL,
  `status` enum('selected','booked','cancelled') NOT NULL DEFAULT 'selected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_tasks`
--

CREATE TABLE `assigned_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `editor_id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `task_description` text DEFAULT NULL,
  `status` enum('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assigned_tasks`
--

INSERT INTO `assigned_tasks` (`id`, `editor_id`, `booking_id`, `task_description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'check all photos and edit all', 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text DEFAULT NULL,
  `blog_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photographer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `catalogue_id` varchar(150) DEFAULT NULL,
  `slot_id` bigint(20) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `venue_type` varchar(50) DEFAULT NULL,
  `venue_address` varchar(255) DEFAULT NULL,
  `addons` varchar(255) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `advance_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `extra_charges` decimal(10,2) DEFAULT 0.00,
  `admin_note` text DEFAULT NULL,
  `booking_status` enum('pending','approved','confirm','completed','cancelled') DEFAULT 'pending',
  `payment_status` enum('partial','paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `razorpay_order_id` varchar(255) DEFAULT NULL,
  `razorpay_payment_id` varchar(255) DEFAULT NULL,
  `razorpay_signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `photographer_id`, `client_id`, `category_id`, `package_id`, `catalogue_id`, `slot_id`, `appointment_date`, `venue_type`, `venue_address`, `addons`, `total_amount`, `coupon_code`, `advance_amount`, `remaining_amount`, `extra_charges`, `admin_note`, `booking_status`, `payment_status`, `razorpay_order_id`, `razorpay_payment_id`, `razorpay_signature`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1, NULL, 1, NULL, NULL, NULL, NULL, 6499.00, NULL, 2999.00, 2000.00, 1500.00, NULL, 'confirm', 'partial', NULL, NULL, NULL, NULL, '2026-03-29 20:12:56'),
(2, 2, NULL, 1, 1, '2', 1, '2026-04-10', 'studio', NULL, 'BTS Reel:2000,Raw data in mini session:2000', 8999.00, NULL, 0.00, 0.00, 0.00, NULL, 'confirm', 'unpaid', NULL, NULL, NULL, '2026-03-29 04:30:19', '2026-03-29 04:34:20'),
(3, 1, NULL, 1, 1, '2', 2, '2026-04-18', 'studio', NULL, 'Extra Props:1000,Additional Setup:3000', 8999.00, NULL, 0.00, 0.00, 0.00, NULL, 'confirm', 'unpaid', NULL, NULL, NULL, '2026-03-29 04:35:11', '2026-03-29 04:35:45'),
(4, 1, NULL, 1, 1, '2', 1, '2026-04-10', 'home', '25/2 ranchod park soc.isanpur ahmedabad', 'Extra Props:1000,Premium Photo Album:4000', 14999.00, NULL, 0.00, 0.00, 1500.00, NULL, 'confirm', 'partial', NULL, NULL, NULL, '2026-03-29 04:53:55', '2026-03-29 05:13:29'),
(5, 1, NULL, 3, 3, '4', 1, '2026-04-05', 'home', 'isanpur', 'Makeup & hair:2000', 11999.00, NULL, 0.00, 0.00, 1500.00, NULL, 'cancelled', 'partial', NULL, NULL, NULL, '2026-03-29 10:46:14', '2026-03-29 10:50:04'),
(6, 1, 3, 1, 1, '3', 1, '2026-04-05', 'studio', NULL, '', 4999.00, NULL, 0.00, 0.00, 0.00, NULL, 'confirm', 'unpaid', NULL, NULL, NULL, '2026-03-29 11:22:20', '2026-03-29 11:23:26'),
(7, NULL, 3, 1, 1, '3', 2, '2026-04-16', 'studio', NULL, '', 4999.00, NULL, 0.00, 0.00, 0.00, NULL, 'pending', 'unpaid', NULL, NULL, NULL, '2026-03-29 20:06:07', '2026-03-29 20:06:07'),
(8, NULL, 3, 1, 1, '3', 1, '2026-04-06', 'studio', NULL, '', 4999.00, NULL, 0.00, 0.00, 0.00, NULL, 'pending', 'unpaid', NULL, NULL, NULL, '2026-03-30 01:52:12', '2026-03-30 01:52:12'),
(9, NULL, 9, 1, 1, '3', 1, '2026-04-19', 'studio', NULL, '', 6499.00, NULL, 0.00, 0.00, 1500.00, NULL, 'cancelled', 'partial', NULL, NULL, NULL, '2026-04-11 07:19:47', '2026-04-11 07:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `catalogues`
--

CREATE TABLE `catalogues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `catalogue_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogues`
--

INSERT INTO `catalogues` (`id`, `category_id`, `catalogue_name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Little Ms. Poser', '“Little Ms. Poser” is an adorable catalogue capturing kids’ playful poses and charming expressions. Each photo beautifully reflects innocence and creates timeless memories.', '1773903794_img.jpeg', 'active', '2026-03-19 01:33:14', '2026-03-19 01:33:14'),
(3, 1, 'Kabir', 'newborn baby shoot', '1774800388_img.jpeg', 'active', '2026-03-29 10:36:28', '2026-03-29 10:36:28'),
(4, 3, 'Traditional Maternity', 'Traditional Maternity', '1774800516_img.jpeg', 'active', '2026-03-29 10:38:36', '2026-03-29 10:38:36'),
(5, 4, 'Shah family moments', 'Shah family moments', '1774835235_img.jpeg', 'active', '2026-03-29 20:17:15', '2026-03-29 20:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `status` enum('active','unactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New Born', '1773903603_img.png', 'active', '2026-03-19 01:30:03', '2026-03-19 01:30:03'),
(2, 'Kids', '1773903636_img.png', 'active', '2026-03-19 01:30:36', '2026-03-19 01:30:36'),
(3, 'Maternity', '1773903656_img.png', 'active', '2026-03-19 01:30:57', '2026-03-19 01:30:57'),
(4, 'Family', '1773903678_img.png', 'active', '2026-03-19 01:31:18', '2026-03-19 01:31:18');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('unblock','block') DEFAULT 'unblock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Riddhi Gandharv', 'riddhigandharav@gmail.com', '9874561230', '$2y$12$SqAXHea.7MuN6TG5StMpbuyd31fv2DFAERCEbM5cf1sApb.uZcJra', 'unblock', '2026-03-22 08:58:10', '2026-03-22 08:58:10'),
(3, 'Tanisha Rana', 'tanvirana2316@gmail.com', '7894561230', '$2y$12$H8mDPd5Z5vSla5B.5b0CEuMyBLmuBcy9DiSasbHCfu1sVQZu/8M/S', 'unblock', '2026-03-22 23:15:28', '2026-03-29 21:31:11'),
(5, 'John Doe', 'john@gmail.com', '9999999999', '$2y$12$nwyRf/45RerBv7N8SJB.Xexsxg1zjwDmAaX7THZgDnRJmhNDo6Lcy', 'unblock', '2026-03-22 23:30:16', '2026-03-22 23:30:16'),
(6, 'Bhumika Rana', 'ranakushal4611@gmail.com', '9904827838', '$2y$12$KKpw4ZxrjiFJAERKPWR3qutN93uZHPa.xMPZYJVAL1lw7FXynnSFO', 'unblock', '2026-03-29 03:47:39', '2026-03-29 03:47:39'),
(7, 'priyank rana', 'priyanksrana@gmail.com', '4569871230', '$2y$12$pk1DfUzd2WFZ/P.CmDD4KeYyj3z2vKlvageHUSPzGcSl7FP3UR8Gm', 'unblock', '2026-03-29 10:15:46', '2026-03-29 10:15:46'),
(9, 'kushal rana', 'kushal@gmail.com', '78963254100', '$2y$12$1PJrgj5h5qt5nxjA98YUrezKtvh3kQ0anTLSgwn5DQgmSAZgoxDVO', 'unblock', '2026-04-11 07:18:30', '2026-04-11 07:18:30');

-- --------------------------------------------------------

--
-- Table structure for table `client_albums`
--

CREATE TABLE `client_albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `album_name` varchar(100) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `album_link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `discount_type` enum('percentage','fixed') NOT NULL,
  `discount_value` decimal(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `editors`
--

CREATE TABLE `editors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `status` enum('block','unblock') NOT NULL DEFAULT 'unblock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `editors`
--

INSERT INTO `editors` (`id`, `name`, `email`, `phone`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pratham rana', 'pratham@gmail.com', '4563258963', '1234', 'unblock', '2026-03-30 04:21:04', '2026-03-30 04:21:18'),
(2, 'Aman Rana', 'ranaman@gmail.com', '6325417890', '1234', 'unblock', '2026-03-30 04:20:30', '2026-03-30 04:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('new','responded','closed') NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enquiries`
--

INSERT INTO `enquiries` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Riddhi Gandharv', 'riddhigandharav@gmail.com', 'Kids', 'About themes', 'new', '2026-03-19 08:06:47', '2026-03-19 08:06:47'),
(2, 'Riddhi Gandharv', 'riddhigandharav@gmail.com', 'Kids', 'About themes', 'new', '2026-03-19 08:07:51', '2026-03-19 08:07:51'),
(3, 'Riddhi Gandharv', 'riddhigandharav@gmail.com', 'Kids', 'About themes', 'new', '2026-03-19 08:11:49', '2026-03-19 08:11:49'),
(4, 'Riddhi Gandharva', 'riddhigandharav@gmail.com', 'Kids', '“I would like to enquire about a kids photoshoot.\r\nPlease share details about themes, pricing, and availability.”', 'new', '2026-03-19 08:18:37', '2026-03-19 08:18:37'),
(5, 'Riddhi Gandharva', 'riddhigandharav@gmail.com', 'Kids', '“I would like to enquire about a kids photoshoot.\r\nPlease share details about themes, pricing, and availability.”', 'new', '2026-03-19 08:19:34', '2026-03-19 08:19:34'),
(6, 'Riddhi Gandharva', 'riddhigandharav@gmail.com', 'Kids', '“I want to plan a photoshoot for my child.\r\nPlease let me know the available themes and charges.”', 'new', '2026-03-19 08:21:31', '2026-03-19 08:21:31'),
(7, 'Tanisha Rana', 'tanvirana2316@gmail.com', 'Kids', '“I want to plan a photoshoot for my child.\r\nPlease let me know the available themes and charges.”', 'new', '2026-03-19 08:22:36', '2026-03-19 08:22:36'),
(8, 'Riddhi Gandharva', 'riddhigandharav@gmail.com', 'Kids', 'About Photoshoot and Timing', 'new', '2026-03-22 08:11:36', '2026-03-22 08:11:36'),
(9, 'Riddhi Gandharva', 'riddhigandharav@gmail.com', 'Kids', 'About KIds', 'new', '2026-03-22 08:13:34', '2026-03-22 08:13:34'),
(10, 'Riddhi Gandharva', 'riddhigandharav@gmail.com', 'Maternity', 'About Maternity', 'new', '2026-03-22 08:14:34', '2026-03-22 08:14:34'),
(11, 'Tanisha Rana', 'tanvirana2316@gmail.com', 'New Born', 'About New Born', 'new', '2026-03-22 08:15:57', '2026-03-22 08:15:57');

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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `booking_id`, `rating`, `comment`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 'Excellent service\r\n', NULL, NULL),
(2, 4, 5, 'Loved the pictures\r\n', '2026-03-30 02:48:45', '2026-03-30 02:48:45');

-- --------------------------------------------------------

--
-- Table structure for table `full_payments`
--

CREATE TABLE `full_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_mode` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catalogue_id` bigint(20) UNSIGNED NOT NULL,
  `image` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `catalogue_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, '177390606448.jpg', 'active', '2026-03-19 02:11:04', '2026-03-19 02:11:04'),
(4, 1, '177390838432.jpg', 'active', '2026-03-19 02:11:04', '2026-03-19 02:49:44'),
(5, 4, '177483549752.jpg', 'active', '2026-03-29 20:21:37', '2026-03-29 20:21:37'),
(6, 4, '177483549765.jpg', 'active', '2026-03-29 20:21:37', '2026-03-29 20:21:37');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(50) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_03_13_065153_create_categories_table', 1),
(6, '2026_03_13_065154_create_clients_table', 1),
(7, '2026_03_13_065154_create_slots_table', 1),
(8, '2026_03_13_065155_create_catalogues_table', 1),
(9, '2026_03_13_065155_create_photographers_table', 1),
(10, '2026_03_13_065156_create_appointments_table', 1),
(11, '2026_03_13_065156_create_packages_table', 1),
(12, '2026_03_13_065157_create_advance_payments_table', 1),
(13, '2026_03_13_065157_create_bookings_table', 1),
(14, '2026_03_13_065158_create_feedback_table', 1),
(15, '2026_03_13_065158_create_full_payments_table', 1),
(16, '2026_03_13_065159_create_galleries_table', 1),
(17, '2026_03_13_065200_create_invoices_table', 1),
(18, '2026_03_13_065200_create_notifications_table', 1),
(19, '2026_03_13_070214_create_enquiries_table', 1),
(20, '2026_03_13_070215_create_blogs_table', 1),
(21, '2026_03_13_070215_create_coupons_table', 1),
(22, '2026_03_13_070216_create_support_tickets_table', 1),
(23, '2026_03_16_063154_create_contacts_table', 1),
(24, '2026_03_16_063236_create_editors_table', 1),
(25, '2026_03_16_063431_create_assigned_tasks_table', 1),
(26, '2026_03_16_063755_create_client_albums_table', 1),
(27, '2026_03_20_101342_rename_appointment_id_to_client_id_in_bookings_table', 2),
(28, '2026_03_23_051652_create_otps_table', 3),
(29, '2026_03_26_000001_add_missing_fields_to_bookings_table', 4),
(30, '2026_03_29_095839_make_client_id_nullable_in_bookings_table', 4),
(31, '2026_03_29_164109_finalize_notifications_table', 5),
(33, '2026_03_30_015241_add_group_id_to_galleries_table', 6),
(34, '2026_03_30_020024_change_image_to_text_in_galleries_table', 7),
(35, '2026_04_11_124758_add_razorpay_fields_to_bookings_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'client',
  `message` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `is_read` enum('yes','no') NOT NULL DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `user_role`, `message`, `title`, `url`, `is_read`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'A new booking request has been received (ID: 6)', 'New Booking Received', '/booking_management', 'no', '2026-03-29 11:22:20', '2026-03-29 11:22:20'),
(2, 3, 'client', 'Your booking request has been received and is under review.', 'Booking Received', '/mybooking', 'yes', '2026-03-29 11:22:20', '2026-03-29 21:32:26'),
(3, 3, 'client', 'Your booking status has been updated to approved', 'Booking Status Updated', '/mybooking', 'yes', '2026-03-29 11:23:09', '2026-03-29 21:32:26'),
(4, NULL, 'admin', 'A new booking request has been received (ID: 7)', 'New Booking Received', '/booking_management', 'no', '2026-03-29 20:06:07', '2026-03-29 20:06:07'),
(5, 3, 'client', 'Your booking request has been received and is under review.', 'Booking Received', '/mybooking', 'yes', '2026-03-29 20:06:07', '2026-03-29 21:32:26'),
(6, NULL, 'admin', 'Payment received for booking ID: 1', 'Payment Received', '/booking_management', 'no', '2026-03-29 20:12:56', '2026-03-29 20:12:56'),
(7, 3, 'client', 'Thank you! Your payment is confirmed and booking is now active.', 'Payment Confirmed', '/mybooking', 'yes', '2026-03-29 20:12:56', '2026-03-29 21:32:26'),
(8, NULL, 'admin', 'A new booking request has been received (ID: 8)', 'New Booking Received', '/booking_management', 'no', '2026-03-30 01:52:13', '2026-03-30 01:52:13'),
(9, 3, 'client', 'Your booking request has been received and is under review.', 'Booking Received', '/mybooking', 'no', '2026-03-30 01:52:13', '2026-03-30 01:52:13'),
(10, NULL, 'admin', 'A new booking request has been received (ID: 9)', 'New Booking Received', '/booking_management', 'no', '2026-04-11 07:19:47', '2026-04-11 07:19:47'),
(11, 9, 'client', 'Your booking request has been received and is under review.', 'Booking Received', '/mybooking', 'yes', '2026-04-11 07:19:47', '2026-04-11 07:46:55'),
(12, 9, 'client', 'Your booking status has been updated to approved', 'Booking Status Updated', '/mybooking', 'yes', '2026-04-11 07:20:16', '2026-04-11 07:46:55'),
(13, NULL, 'admin', 'Payment received for booking ID: 9', 'Payment Received', '/booking_management', 'no', '2026-04-11 07:43:49', '2026-04-11 07:43:49'),
(14, 9, 'client', 'Thank you! Your payment is confirmed and booking is now active.', 'Payment Confirmed', '/mybooking', 'yes', '2026-04-11 07:43:49', '2026-04-11 07:46:55'),
(15, NULL, 'admin', 'Booking ID: 9 has been cancelled by the client.', 'Booking Cancelled By Client', '/booking_management', 'no', '2026-04-11 07:46:50', '2026-04-11 07:46:50'),
(16, 9, 'client', 'You have cancelled your booking request (ID: 9).', 'Booking Cancelled', '/mybooking', 'yes', '2026-04-11 07:46:50', '2026-04-11 07:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `otps`
--

CREATE TABLE `otps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `otp` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `otps`
--

INSERT INTO `otps` (`id`, `phone`, `email`, `otp`, `type`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'tanvirana2316@gmail.com', '276567', 'forgot', '2026-03-29 21:37:43', '2026-03-29 21:32:43', '2026-03-29 21:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `max_catelogues` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `category_id`, `package_name`, `price`, `max_catelogues`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mini Session', 4999.00, 1, 'Includes 1 theme\r\n30-minute session\r\n10 high-resolution edited images\r\nProps and accessories provided', '2026-03-19 23:20:04', '2026-03-19 23:44:10'),
(2, 1, 'Silver Package', 9999.00, 3, '2 setups + parents\' portrait (plain background)\r\n15 high-resolution edited images\r\nIncludes a photobook\r\nProps and accessories provided\r\nAll raw photos included', '2026-03-19 23:29:16', '2026-03-19 23:29:16'),
(3, 3, 'mini session', 4999.00, 1, '1 setup (plain backdrop)\r\n\r\n30-minute session\r\n\r\n10 high-resolution edited images\r\n\r\n1 gown\r\n\r\nPartner included\r\n\r\nProps & accessories included', '2026-03-29 10:42:13', '2026-03-29 10:42:13'),
(4, 3, 'Silver', 9999.00, 3, 'Silver', '2026-03-29 10:42:51', '2026-03-29 10:42:51');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photographers`
--

CREATE TABLE `photographers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photographers`
--

INSERT INTO `photographers` (`id`, `name`, `email`, `password`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'akshay rana', 'akhsay@gmail.com', '$2y$12$6uSzCpatjF.ZOmWOvb01.eCRnvF.hzIfgCOpwej85648zyJIGRqrO', '9638527410', 'active', '2026-03-26 00:24:10', '2026-03-29 10:03:56'),
(2, 'kushal rana', 'kushal@gmail.com', '$2y$12$BQr85wZeMWfGkdVsTMeq4eQIoK2k9UbxdxLkgJhPOpeoB68DuXfAC', '7896541230', 'active', '2026-03-26 00:24:44', '2026-03-29 10:03:46'),
(3, 'bharat patel', 'bharat@gmail.com', '$2y$12$BkBK57aW39BcH7hR32o8VOMG1RlCo2AoRf.YGJKmV4sGSGGl4Nh4W', '4567899632', 'active', '2026-03-29 10:04:35', '2026-03-29 10:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE `slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slot_name` varchar(50) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slots`
--

INSERT INTO `slots` (`id`, `slot_name`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 'morning', '09:00:00', '11:00:00', 'active', '2026-03-26 01:05:56', '2026-03-26 01:05:56'),
(2, 'noon', '01:00:00', '04:00:00', 'active', '2026-03-26 01:06:45', '2026-03-26 01:06:45'),
(3, 'evening', '05:00:00', '07:30:00', 'active', '2026-03-26 01:07:58', '2026-03-26 01:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `admin_reply` text DEFAULT NULL,
  `status` enum('open','replied','closed') NOT NULL DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advance_payments_appointment_id_foreign` (`appointment_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_slot_id_foreign` (`slot_id`),
  ADD KEY `appointments_client_id_foreign` (`client_id`);

--
-- Indexes for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_tasks_editor_id_foreign` (`editor_id`),
  ADD KEY `assigned_tasks_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_category_id_foreign` (`category_id`),
  ADD KEY `bookings_package_id_foreign` (`package_id`),
  ADD KEY `bookings_client_id_foreign` (`client_id`);

--
-- Indexes for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogues_category_id_foreign` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `client_albums`
--
ALTER TABLE `client_albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_albums_client_id_foreign` (`client_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `editors`
--
ALTER TABLE `editors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `editors_email_unique` (`email`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `full_payments`
--
ALTER TABLE `full_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_payments_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_catalogue_id_foreign` (`catalogue_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_booking_id_foreign` (`booking_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_client_id_foreign` (`user_id`);

--
-- Indexes for table `otps`
--
ALTER TABLE `otps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packages_category_id_foreign` (`category_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `photographers`
--
ALTER TABLE `photographers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `photographers_email_unique` (`email`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `support_tickets_client_id_foreign` (`client_id`);

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
-- AUTO_INCREMENT for table `advance_payments`
--
ALTER TABLE `advance_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `catalogues`
--
ALTER TABLE `catalogues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_albums`
--
ALTER TABLE `client_albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `editors`
--
ALTER TABLE `editors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `full_payments`
--
ALTER TABLE `full_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `otps`
--
ALTER TABLE `otps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `photographers`
--
ALTER TABLE `photographers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advance_payments`
--
ALTER TABLE `advance_payments`
  ADD CONSTRAINT `advance_payments_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `appointments_slot_id_foreign` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`);

--
-- Constraints for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD CONSTRAINT `assigned_tasks_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  ADD CONSTRAINT `assigned_tasks_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `editors` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `bookings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `bookings_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Constraints for table `catalogues`
--
ALTER TABLE `catalogues`
  ADD CONSTRAINT `catalogues_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `client_albums`
--
ALTER TABLE `client_albums`
  ADD CONSTRAINT `client_albums_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `full_payments`
--
ALTER TABLE `full_payments`
  ADD CONSTRAINT `full_payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_catalogue_id_foreign` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD CONSTRAINT `support_tickets_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
