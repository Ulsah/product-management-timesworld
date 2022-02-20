-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 20, 2022 at 11:13 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor` bigint(20) NOT NULL,
  `booked_by` bigint(20) DEFAULT NULL,
  `usertype` enum('Registered','Guest') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Guest',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Requested','Confirmed','Declined','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Requested',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctor`, `booked_by`, `usertype`, `name`, `email`, `date`, `time`, `reason`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 26, 29, 'Registered', 'zeb', 'zeb@ghost.crew', '2022-02-21', '15:50:00', NULL, 'Declined', '', '2022-02-20 03:52:10', '2022-02-20 04:17:02'),
(2, 24, 28, 'Registered', 'kanan', 'kanan@ghost.crew', '2022-02-21', '15:00:00', 'cancer', 'Declined', '', '2022-02-20 03:53:35', '2022-02-20 07:41:22'),
(3, 24, NULL, 'Guest', 'ulsah', 'ul@gmail.com', '2022-02-21', '14:00:00', NULL, 'Completed', '1', '2022-02-20 04:21:59', '2022-02-20 08:25:02'),
(4, 24, 1, 'Registered', 'Ulsah Dan', 'udalexk@gmail.com', '2022-02-21', '14:00:00', NULL, 'Completed', '2', '2022-02-20 04:39:51', '2022-02-20 08:26:57'),
(5, 24, 29, 'Registered', 'zeb', 'zeb@ghost.crew', '2022-02-21', '15:00:00', 'aah', 'Completed', '3', '2022-02-20 08:19:23', '2022-02-20 08:26:58'),
(6, 24, NULL, 'Guest', 'Gust', 'guest@gmail.com', '2022-02-21', '15:00:00', NULL, 'Completed', '4', '2022-02-20 09:42:27', '2022-02-20 10:07:28'),
(7, 24, NULL, 'Guest', 'Gust', 'guest@gmail.com', '2022-02-21', '15:00:00', NULL, 'Declined', '', '2022-02-20 09:43:44', '2022-02-20 09:46:54'),
(8, 24, NULL, 'Guest', 'Tanisha Kane', 'popelyged@mailinator.com', '2006-12-20', '04:06:00', 'Maxime totam eos bl', 'Declined', '', '2022-02-20 09:46:11', '2022-02-20 09:49:09'),
(9, 2, 3, 'Registered', 'Luna', 'luna@gmail.com', '1982-10-14', '09:27:00', 'Iste ut assumenda el', 'Requested', NULL, '2022-02-20 09:47:21', '2022-02-20 09:47:21'),
(10, 24, 29, 'Registered', 'zeb', 'zeb@ghost.crew', '2022-02-22', '10:06:00', NULL, 'Confirmed', '1', '2022-02-20 10:06:05', '2022-02-20 10:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_report_migration`
--

CREATE TABLE `appointment_report_migration` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2022_02_19_190332_create_appointments_table', 1),
(6, '2022_02_20_153844_create_appointment_report_migration', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Admin','Doctor','User') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ulsah Dan', 'udalexk@gmail.com', NULL, '$2y$10$Eqj7lhMEjmOLC.OGm8Pv7.cilFoU7HfRzG8pYNe4skRkKT0qW6g5i', 'Admin', NULL, '2022-02-19 14:05:14', '2022-02-19 15:59:23'),
(2, 'Enes Sipovic', 'enes@blasters.com', NULL, '$2y$10$N5vziA5yKo2zG2k0UcA4P.79X3Uoj/RWfnlJRo8YTK/HThXDjhAq.', 'Doctor', NULL, '2022-02-19 16:09:43', '2022-02-19 16:19:49'),
(3, 'Luna', 'luna@gmail.com', NULL, '$2y$10$/vELiQidmP2.5KbPxGTlkOasWQAdFTPcFCXAULwDzEhfE/Drw7/8C', 'User', NULL, '2022-02-19 16:10:15', '2022-02-19 16:10:15'),
(24, 'Sabine', 'sabine@ghost.crew', NULL, '$2y$10$iNG.nMUAiKY0VE4NAWCjRuBODgqLgi5vGeSri4DokBRQYgHzyiyIy', 'Doctor', NULL, '2022-02-19 16:47:42', '2022-02-19 16:47:42'),
(26, 'Hera', 'hera@ghost.crew', NULL, '$2y$10$rhfVilDCJ2tmY8w0PpqgMuZwyLyLzJFWuYVzgBr82j1CEfw5O4cpy', 'Doctor', NULL, '2022-02-19 16:49:13', '2022-02-19 16:49:13'),
(27, 'ezra', 'ezra@ghost.crew', NULL, '$2y$10$vnTOBomEQvK1bRq9xaZnh.htGDtNaOfchy6eLWStdmp6hyVBR0Scq', 'User', NULL, '2022-02-19 16:49:58', '2022-02-19 16:49:58'),
(28, 'kanan', 'kanan@ghost.crew', NULL, '$2y$10$T2yJ7mbw1DqLCAvoy.LB.u8xPE4eGrVHLhz2XJu.wY1OLjh1mM6eu', 'Admin', NULL, '2022-02-19 16:50:22', '2022-02-19 16:50:22'),
(29, 'zeb', 'zeb@ghost.crew', NULL, '$2y$10$94KE8Muym4a2oWLNNpdshutgkyYyGAQBIN69I3uXe/Sg1Lovlov4C', 'User', NULL, '2022-02-19 16:50:52', '2022-02-19 16:50:52'),
(30, 'Ahsoka', 'a@ghost.crew', NULL, '$2y$10$5xwfLYB/m/y1QBDEJ6yLHeG5JelFJ5NnNOYPFA3Nb4q.Kn1gjG.Sa', 'Admin', NULL, '2022-02-19 16:51:08', '2022-02-19 16:51:08'),
(31, 'Dolorum aliqua Repe', 'tedo@mailinator.com', NULL, '$2y$10$ynJaqCdsMPY2AAas5gR9MeAw..ILqipr9PAVQrZdMx7FOBoeZ2oQ.', 'Doctor', NULL, '2022-02-19 16:51:16', '2022-02-19 16:51:16'),
(32, 'Qui minus voluptatem', 'jynyhubal@mailinator.com', NULL, '$2y$10$j8obBZryq890YnDgODwh7eaFwxppeg/dLBd2Jg0pDUlF5bf.yo70m', 'User', NULL, '2022-02-19 16:51:23', '2022-02-19 16:51:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_report_migration`
--
ALTER TABLE `appointment_report_migration`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `appointment_report_migration`
--
ALTER TABLE `appointment_report_migration`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
