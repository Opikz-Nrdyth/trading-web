-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2025 at 04:21 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trading`
--

-- --------------------------------------------------------

--
-- Table structure for table `amounts`
--

CREATE TABLE `amounts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` bigint NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_user` bigint UNSIGNED NOT NULL,
  `noted` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amounts`
--

INSERT INTO `amounts` (`id`, `user_id`, `amount`, `type`, `status`, `from_user`, `noted`, `created_at`, `updated_at`) VALUES
(1, 4, 50000, 'bonus', 'success', 1, '<p>Bonus Pertama</p>', '2025-04-23 06:11:33', '2025-04-23 06:11:33'),
(2, 4, 500000, 'bonus', 'success', 1, '<p>Topup</p>', '2025-04-23 07:28:16', '2025-04-23 07:28:16'),
(3, 4, -40, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 07:28:41', '2025-04-23 07:28:41'),
(4, 4, 40, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-04-23 07:29:35', '2025-04-23 07:29:35'),
(5, 4, -515573, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 07:33:44', '2025-04-23 07:33:44'),
(6, 4, -3441697, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 08:01:07', '2025-04-23 08:01:07'),
(7, 4, 3441697, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-04-23 08:02:49', '2025-04-23 08:02:49'),
(8, 4, -3441697, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 08:03:13', '2025-04-23 08:03:13'),
(9, 4, 3441697, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-04-23 08:03:37', '2025-04-23 08:03:37'),
(10, 4, -32080, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 08:06:45', '2025-04-23 08:06:45'),
(11, 4, 32080, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-04-23 08:23:15', '2025-04-23 08:23:15'),
(12, 4, -3441697, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 08:23:44', '2025-04-23 08:23:44'),
(13, 4, 3441697, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-04-23 08:26:07', '2025-04-23 08:26:07'),
(14, 4, -34417, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 08:26:28', '2025-04-23 08:26:28'),
(15, 4, 34417, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-04-23 08:28:15', '2025-04-23 08:28:15'),
(16, 4, -34417, 'withdraw', 'success', 4, 'Withdraw Balance', '2025-04-23 08:29:05', '2025-04-23 08:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `cripto_currencies`
--

CREATE TABLE `cripto_currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cripto_currencies`
--

INSERT INTO `cripto_currencies` (`id`, `currency_code`, `currency_name`, `currency_logo`, `created_at`, `updated_at`) VALUES
(1, 'BTC', 'BITCOIN', '/images/bitcoin.png', '2025-04-23 06:06:16', '2025-04-23 06:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `currency_name`, `currency_logo`, `created_at`, `updated_at`) VALUES
(2, 'SGD', 'Singapore Dollar', 'images/01JSHHJZJAVKFY1B14NX10FT5J.png', '2025-04-23 07:42:17', '2025-04-23 07:42:17'),
(3, 'AED', 'United Arab Emirates Dirham', 'images/01JSHJ0WCS1XN6HPQR3KFH2AT6.png', '2025-04-23 07:49:52', '2025-04-23 07:49:52');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `package` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('success','canceled','pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

CREATE TABLE `kycs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_17_011350_create_user_data_table', 1),
(6, '2025_01_17_022256_create_kycs_table', 1),
(7, '2025_01_17_030514_create_investments_table', 1),
(8, '2025_01_17_122755_create_networks_table', 1),
(9, '2025_01_17_122756_create_settings_table', 1),
(10, '2025_01_17_131648_create_news_table', 1),
(11, '2025_01_17_140844_create_faqs_table', 1),
(12, '2025_01_17_142127_create_testimonials_table', 1),
(13, '2025_01_17_999999_create_amounts_table', 1),
(14, '2025_01_18_030222_create_notifications_table', 1),
(15, '2025_01_19_115333_create_packages_table', 1),
(16, '2025_01_19_117543_create_trades_table', 1),
(17, '2025_01_20_150414_create_withdrawals_table', 1),
(18, '2025_01_24_042650_create_currencies_table', 1),
(19, '2025_01_24_043617_create_cripto_currencies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` bigint UNSIGNED NOT NULL,
  `child` bigint UNSIGNED NOT NULL,
  `mother` bigint UNSIGNED NOT NULL,
  `mother_id` bigint UNSIGNED DEFAULT NULL,
  `join_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('publish','pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('info','warning','error') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('read','unread') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '4', 'Welcome Wulan Dian Agustina', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-04-23 06:09:47', '2025-04-23 06:09:47'),
(2, '4', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-23 07:29:35', '2025-04-23 07:29:35'),
(3, '4', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-04-23 07:34:20', '2025-04-23 07:34:20'),
(4, '4', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-23 08:02:49', '2025-04-23 08:02:49'),
(5, '4', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-23 08:03:37', '2025-04-23 08:03:37'),
(6, '4', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-23 08:23:15', '2025-04-23 08:23:15'),
(7, '4', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-23 08:26:07', '2025-04-23 08:26:07'),
(8, '4', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-23 08:28:15', '2025-04-23 08:28:15');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_contract` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_contract` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_wd` decimal(15,2) NOT NULL,
  `min_tf` decimal(15,2) NOT NULL,
  `fee` decimal(15,2) NOT NULL,
  `telegram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_logo`, `min_wd`, `min_tf`, `fee`, `telegram`, `created_at`, `updated_at`) VALUES
(1, 'Opik Studio', 'logos/01JSHJMF1XRHHRG272VARKNQ0C.png', '1000.00', '100000.00', '2.00', 'te.me/6282328035237', '2025-04-23 06:06:16', '2025-04-23 08:00:34');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('publish','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `market` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trx` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_id` bigint UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_stake` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Success','Pendding') COLLATE utf8mb4_unicode_ci NOT NULL,
  `win_lost` enum('Win','Lost') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_view` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `password_view`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin', '2025-04-23 06:06:14', '$2y$12$doq5eD8Y5KwKlTVbD5VE.uiNOH2V150cQ2JNK1r51u1CIGEsy9sl.', NULL, NULL, '2025-04-23 06:06:15', '2025-04-23 06:06:15'),
(4, 'Wulan Dian Agustina', 'wulan@gmail.com', 'User', NULL, '$2y$12$GNwFJM6fnttX199aSv48P.Zleof.NtXfHyqiN0pPOxBr6S80AQ6C2', NULL, NULL, '2025-04-23 06:09:46', '2025-04-23 07:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referals` bigint UNSIGNED DEFAULT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bitcoin_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `members` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `referals`, `profile_image`, `username`, `address`, `country`, `phone_number`, `bitcoin_address`, `bank_number`, `bank_name`, `type_currency`, `members`, `created_at`, `updated_at`) VALUES
(2, 4, NULL, NULL, 'wulan', NULL, NULL, NULL, NULL, NULL, NULL, 'AED', '0', '2025-04-23 06:09:47', '2025-04-23 07:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `currency_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_withdraw` decimal(15,2) NOT NULL,
  `fee` decimal(15,2) NOT NULL,
  `status` enum('pending','success','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `currency_type`, `bank_number`, `user_bank`, `pass_bank`, `pin_bank`, `amount_withdraw`, `fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'SGD (Singapure Dollar)', '589845829989', 'Tes', 'BRI', '-', '40.00', '0.00', 'failed', '2025-04-23 07:28:41', '2025-04-23 07:29:35'),
(2, 4, 'SGD (Singapure Dollar)', '589845829989', 'Tes', 'BRI', '-', '515572.95', '0.00', 'success', '2025-04-23 07:33:44', '2025-04-23 07:34:20'),
(3, 4, 'SGD (Singapure Dollar)', '589845829989', 'Tes', 'BRI', '-', '3441696.67', '0.00', 'failed', '2025-04-23 08:01:07', '2025-04-23 08:02:49'),
(4, 4, 'AED (United Arab Emirates Dirham)', '589845829989', 'Tes', 'BRI', '-', '3441696.67', '0.00', 'failed', '2025-04-23 08:03:13', '2025-04-23 08:03:37'),
(5, 4, 'AED (United Arab Emirates Dirham)', '589845829989', 'Tes', 'BRI', '-', '32079.73', '0.00', 'failed', '2025-04-23 08:06:45', '2025-04-23 08:23:15'),
(6, 4, 'AED (United Arab Emirates Dirham)', '589845829989', 'Tes', 'BRI', '-', '3441696.67', '0.00', 'failed', '2025-04-23 08:23:44', '2025-04-23 08:26:07'),
(7, 4, 'AED (United Arab Emirates Dirham)', '589845829989', 'Tes', 'BRI', '-', '34416.97', '0.00', 'failed', '2025-04-23 08:26:28', '2025-04-23 08:28:15'),
(8, 4, 'AED (United Arab Emirates Dirham)', '589845829989', 'Pinz', 'BRI', '-', '34416.97', '0.00', 'pending', '2025-04-23 08:29:05', '2025-04-23 08:29:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amounts`
--
ALTER TABLE `amounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amounts_user_id_foreign` (`user_id`),
  ADD KEY `amounts_from_user_foreign` (`from_user`);

--
-- Indexes for table `cripto_currencies`
--
ALTER TABLE `cripto_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faqs_title_unique` (`title`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_user_id_foreign` (`user_id`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kycs_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `networks_child_foreign` (`child`),
  ADD KEY `networks_mother_id_foreign` (`mother_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_user_id_foreign` (`user_id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trades_user_id_foreign` (`user_id`),
  ADD KEY `trades_package_id_foreign` (`package_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_data_username_unique` (`username`),
  ADD KEY `user_data_referals_foreign` (`referals`),
  ADD KEY `user_data_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawals_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amounts`
--
ALTER TABLE `amounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cripto_currencies`
--
ALTER TABLE `cripto_currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amounts`
--
ALTER TABLE `amounts`
  ADD CONSTRAINT `amounts_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kycs`
--
ALTER TABLE `kycs`
  ADD CONSTRAINT `kycs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `networks`
--
ALTER TABLE `networks`
  ADD CONSTRAINT `networks_child_foreign` FOREIGN KEY (`child`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `networks_mother_id_foreign` FOREIGN KEY (`mother_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trades`
--
ALTER TABLE `trades`
  ADD CONSTRAINT `trades_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trades_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_referals_foreign` FOREIGN KEY (`referals`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
