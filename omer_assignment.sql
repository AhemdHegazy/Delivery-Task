-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2022 at 09:39 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omer_assignment`
--

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin','delivery') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('new','approved','shipped','outForDelivery','delivered') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_id` bigint(20) UNSIGNED DEFAULT NULL,
  `lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `role`, `email`, `email_verified_at`, `password`, `barcode`, `status`, `tracking_code`, `delivery_id`, `lat`, `lng`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Delivery', '+99605042602254', 'Al Ryad', 'delivery', 'omer@delivery.com', '2022-04-29 10:37:22', '$2y$10$QoaWZDCJu273mVQhOJZzi.NsY68nOcobfk6pPA9SKKZMvNylaEoMu', NULL, NULL, NULL, NULL, NULL, NULL, 'rXVARKgn1x2w73uXuAF0hjC2QmwFQL42xMW8Q26gw2UccfpcnRBkfrsQ5C4l', '2022-04-29 10:37:22', '2022-04-29 16:04:05'),
(2, 'qw', '56165', 'Al Ryad', 'admin', 'omer@admin.com', '2022-04-29 10:37:22', '$2y$10$QoaWZDCJu273mVQhOJZzi.NsY68nOcobfk6pPA9SKKZMvNylaEoMu', NULL, NULL, NULL, NULL, NULL, NULL, 'jC5pkZMcjlV4rOnjbGVf7dJqDiZnmVr06r6Yzpzu24mqy3i04KpMr0QWzMC7', '2022-04-29 10:37:22', '2022-04-29 16:04:13'),
(3, 'Xandra Estrada', '+1 (881) 338-3674', 'Repudiandae veniam', 'user', 'humuby@mailinator.com', NULL, '$2y$10$eqieuPAoOB4E9YfcMlqrYeE7CrIn5tbJpS1VUPbPBJxKUiYN8/Y9q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 10:48:19', '2022-04-29 10:48:19'),
(4, 'Theodore Levine', '+1 (359) 431-8643', 'Tempore possimus q', 'user', 'kimuzah@mailinator.com', NULL, '$2y$10$9WV0p4b1t9SK8QW/.714rOogL2agkmumfc1ImYy5ePMqHkAVibJ1O', NULL, 'delivered', 'ABCDEF', 1, '26.130281666093587', '32.03211507060638', 'UFoXG08cERs7ekMMxHkZcNtcIViXK406CL9nIGFjiUhVSBd3vwH6uLUcccDH', '2022-04-29 10:54:27', '2022-04-29 18:19:16'),
(5, 'Stephanie Romero', '+1 (176) 453-8603', 'Temporibus consequat', 'user', 'kelefeciz@mailinator.com', NULL, '$2y$10$QoaWZDCJu273mVQhOJZzi.NsY68nOcobfk6pPA9SKKZMvNylaEoMu', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-04-29 10:56:41', '2022-04-29 10:56:41'),
(6, 'Hiroko Flowers', '+1 (877) 179-9806', 'Qui enim error aliqu', 'user', 'tori@mailinator.com', NULL, '$2y$10$fhAfyCKEmVHSARnDNh7aburmCsYJezWguyGbNrE.mxsCS6RWqhRLe', NULL, 'outForDelivery', '6ce9f7df-f4eb-4b49-9934-0465e58ae996', 1, '26.130281666093587', '32.03211507060638', NULL, '2022-04-29 11:22:20', '2022-04-29 18:19:28'),
(7, 'Catherine Greene', '+1 (654) 721-3395', 'Ipsum modi Nam in ex', 'user', 'fybape@mailinator.com', NULL, '$2y$10$JTmo3MHvvIR5QRrkroAaL.oGIDd82iDhqomElVYv0AIEh3fHSowAG', NULL, NULL, NULL, 1, NULL, NULL, '7InonOKujTnASFNfOxQFKYmxF5I27hS2OXejoaeorkwGCutoDbWVfDKUnTmp', '2022-04-29 12:25:57', '2022-04-29 12:25:57'),
(8, 'Dakota Moss', '+1 (736) 393-2553', 'HM6W+352، شارع الجلاء، الكبش، قسم ثان سوهاج، سوهاج، مصر', 'user', 'robufe@mailinator.com', NULL, '$2y$10$9f/HmMAAgpACLBT6ArNH0O4og91n1E4zOBtuKEmEgmYHYX8v5Ck2i', NULL, 'delivered', '339bf4da-4fa6-4eff-a621-6908cd5b8292', 1, '26.560085663639455', '31.695377602742838', 'drIVrk3UANtQ0Akc6E3pG3HZAgnUWweJ5b01MRQUQd9OsWn0hiw9xPhhzGAP', '2022-04-29 12:41:39', '2022-04-29 19:24:02'),
(9, 'Wynne Velez', '+1 (901) 745-4316', 'Maxime amet culpa', 'user', 'wymez@mailinator.com', NULL, '$2y$10$uXyMUmrVSIBkmQ7fhzA5OeW9VKiR0B5JbUeRhxMCXSgG2nhbMD8JG', NULL, 'outForDelivery', 'e8273401-6a55-49a1-83f2-17776fa72ab0', NULL, NULL, NULL, NULL, '2022-04-29 13:38:04', '2022-04-29 13:38:45'),
(10, 'Stewart Conley', '+1 (708) 847-3679', 'Quis esse molestias', 'user', 'taxyv@mailinator.com', NULL, '$2y$10$ptkYM.tpcz4L2QbPnncnNupur3cxsQEuZcVGk7AWxdmNzCLU7oNri', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 14:19:17', '2022-04-29 14:19:17'),
(11, 'Colt Barlow', '+1 (207) 233-8586', 'Est tempora aut in v', 'user', 'hopumun@mailinator.com', NULL, '$2y$10$Rc7W4jRRW4Q6aBq//UylL.z40Z/uWLRbgAUD6d0DoyJ/gpiWmRDkm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 14:19:22', '2022-04-29 14:19:22'),
(12, 'Brett Carrillo', '+1 (143) 592-6149', 'Inventore optio id', 'user', 'pajatyxidu@mailinator.com', NULL, '$2y$10$sffJhJv7eb9IWQXhr1BUfe3w/8IM0TkKhj.p3LdLH8KDmkrWur4ke', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 14:19:30', '2022-04-29 14:19:30'),
(15, 'Imelda Sargent', '+1 (639) 164-3427', 'Est eum est culpa a', 'delivery', 'quxyr@mailinator.com', NULL, '$2y$10$sKMs9vxIYl7a9ReSR8a8COUKdTuqwXqaOhxZW9lfG.z/2ns1MiNha', NULL, NULL, NULL, 1, NULL, NULL, NULL, '2022-04-29 16:04:53', '2022-04-29 16:04:53'),
(16, 'Sloane Lowe', '+1 (616) 103-2269', 'Quia sunt facilis vo', 'user', 'supehac@mailinator.com', NULL, '$2y$10$j.M0Y19jL9W8O7BgaSZwi.aQZ8r6ugevssBBeamHen/6SkBm1/GAq', NULL, 'new', '7794cdf6-bcf3-4060-97a0-7c9d2b2f7788', NULL, NULL, NULL, NULL, '2022-04-29 18:19:50', '2022-04-29 18:19:52'),
(17, 'Omer Khaled', '+1 (499) 281-4969', 'Qui nihil pariatur', 'user', 'omer@mailinator.com', NULL, '$2y$10$.EKVHEn3VGtnTmn7WNeLFO9fM6kPERvJJkoXZlJUCOiaKuW3ePubm', NULL, 'delivered', '2a8b52fb-729e-4fa3-a52f-aee35bd8d4a7', 1, '25.395373066139502', '47.211624882900715', NULL, '2022-04-29 19:34:18', '2022-04-29 19:37:30'),
(18, 'Alexa Robbins', '+1 (311) 309-6802', 'Fugiat numquam labo', 'delivery', 'magi@mailinator.com', NULL, '$2y$10$Wy3XDYyA90ti6ikxuToin.XC8tOLtuxWmiYMFP8vOjHI3yFIOUeRu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-29 19:36:53', '2022-04-29 19:36:53');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
