-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 11:46 AM
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
-- Database: `example-app`
--

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_23_110509_create_pages_table', 1),
(6, '2024_05_27_112453_create_theme_options_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `parent_id` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `hidden` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `user_id`, `name`, `status`, `parent_id`, `level`, `hidden`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'Main Page', '0', '0', '0', NULL, '2024-06-17 03:57:54', '2024-06-18 07:16:17', NULL),
(2, '1', 'Sub Page', '1', '1', '1', NULL, '2024-06-17 04:35:43', '2024-06-18 04:03:41', NULL),
(3, '3', 'Sub Page', '1', '4', '1', NULL, '2024-06-20 04:12:44', '2024-06-20 04:13:59', NULL),
(4, '3', 'Main Page', '1', '0', '0', NULL, '2024-06-20 04:13:26', '2024-06-20 04:13:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `theme_options`
--

CREATE TABLE `theme_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `site_favicon` varchar(255) DEFAULT NULL,
  `site_logo` varchar(255) DEFAULT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `theme_options`
--

INSERT INTO `theme_options` (`id`, `user_id`, `site_favicon`, `site_logo`, `site_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 'http://localhost:8000/images/site_favicon/1718616204_1716460144_avatar5.png', 'http://localhost:8000/images/site_logo/1718616204_1718362437_1717398374_avatar4.png', 'test', '2024-06-17 03:53:24', '2024-06-17 03:53:24', NULL),
(2, '2', 'http://localhost:8000/images/site_favicon/1718623488_1718362437_1717398374_avatar4.png', 'http://localhost:8000/images/site_logo/1718623488_1716460144_avatar5.png', 'sd', '2024-06-17 05:54:48', '2024-06-17 05:54:48', NULL);

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
  `profile_image` varchar(2000) DEFAULT NULL,
  `dashboard_image` varchar(2000) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `dashboard_image`, `gender`, `phone`, `about_us`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'parth andhariya', 'pja@gmail.com', NULL, '$2y$10$8sphw0Ly0KIxlcE/KwOKDevzh2E49n1a1Q/UhnK98kVbPKPXhmnZ.', 'http://127.0.0.1:8000/images/1718362437_1717398374_avatar4.png', 'http://localhost:8000/images/dashboard_image/1718610417_loginpage1.png', 'Male', '8866269039', 'sgsdgdsg', NULL, '2024-06-14 05:14:42', '2024-06-17 05:06:32'),
(2, 'Test Name', 'apj@gmail.com', NULL, '$2y$10$HpAOeNKx0XxB89nicxmEfeemKYrmM6e/tL1nD5mNDPPuoyOJOPBci', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-17 05:12:06', '2024-06-17 05:12:06'),
(3, 'New Test Name', 'newtestname@abc.com', NULL, '$2y$10$IExIKU./0KXjOB/olHNKMObB0r/dsVP4SFSVoKsxY8Za9i8lS12dC', 'http://localhost:8000/images/1718876421_avatar.png', NULL, NULL, NULL, NULL, NULL, '2024-06-20 04:07:55', '2024-06-20 04:10:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `theme_options`
--
ALTER TABLE `theme_options`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theme_options`
--
ALTER TABLE `theme_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
