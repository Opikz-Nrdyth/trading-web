-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 31 Jan 2025 pada 23.14
-- Versi server: 10.6.20-MariaDB-cll-lve
-- Versi PHP: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiosmyid_trading`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `amounts`
--

CREATE TABLE `amounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `from_user` bigint(20) UNSIGNED NOT NULL,
  `noted` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `amounts`
--

INSERT INTO `amounts` (`id`, `user_id`, `amount`, `type`, `status`, `from_user`, `noted`, `created_at`, `updated_at`) VALUES
(1, 3, 300000, 'deposit', 'success', 3, 'Deposit Saldo', '2025-01-24 19:39:45', '2025-01-24 19:40:04'),
(2, 3, 239298, 'deposit', 'success', 3, 'Deposit Saldo', '2025-01-24 19:56:52', '2025-01-24 19:57:40'),
(11, 18, 1000000, 'topup', 'success', 1, '<p>ok</p>', '2025-01-27 07:42:20', '2025-01-27 07:42:20'),
(12, 18, 2000000, 'profits', 'success', 1, '<p>OK</p>', '2025-01-27 07:48:00', '2025-01-27 07:48:00'),
(13, 18, 1000000, 'bonus', 'success', 1, '<p>OK</p>', '2025-01-27 07:49:19', '2025-01-27 07:49:19'),
(14, 23, 1000000, 'topup', 'pending', 1, '<p>0k</p>', '2025-01-27 08:35:47', '2025-01-27 09:39:56'),
(15, 19, 1000000, 'topup', 'success', 1, '<p>Ok</p>', '2025-01-27 22:54:36', '2025-01-27 22:54:36'),
(16, 30, 4000000, 'topup', 'success', 1, 'Ok', '2025-01-28 00:29:55', '2025-01-28 00:29:55'),
(17, 30, 147000000, 'profits', 'success', 1, '<p>Ok</p>', '2025-01-28 00:31:40', '2025-01-28 09:21:35'),
(18, 30, 100000000, 'deposit', 'pending', 30, 'Deposit Saldo', '2025-01-28 09:23:31', '2025-01-28 09:23:31'),
(19, 30, -150002000, 'withdraw', 'success', 30, 'Withdraw Balance', '2025-01-28 19:30:50', '2025-01-28 19:30:50'),
(20, 3, -9030, 'withdraw', 'success', 3, 'Withdraw Balance', '2025-01-29 07:07:22', '2025-01-29 07:07:22'),
(21, 30, 5000, 'bonus', 'success', 30, 'Withdraw Balance', '2025-01-29 08:01:14', '2025-01-29 08:05:52'),
(23, 3, 100000, 'bonus', 'success', 1, '<p>Bonus User Baru</p>', '2025-01-31 07:46:38', '2025-01-31 07:46:38'),
(24, 3, 50000, 'profits', 'success', 1, '<p>Profit Pertama kamu ciieeee...</p>', '2025-01-31 07:49:42', '2025-01-31 07:49:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cripto_currencies`
--

CREATE TABLE `cripto_currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cripto_currencies`
--

INSERT INTO `cripto_currencies` (`id`, `currency_code`, `currency_name`, `currency_logo`, `created_at`, `updated_at`) VALUES
(1, 'BTC', 'BITCOIN', 'images/bitcoin.png', '2025-01-23 21:41:21', '2025-01-23 21:41:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `currency_logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `currency_name`, `currency_logo`, `created_at`, `updated_at`) VALUES
(2, 'SGD', 'Singapure Dollar', 'images/01JJBZEZJ5H6J0FGC07ZPZWM21.png', '2025-01-24 03:59:26', '2025-01-24 03:59:26'),
(3, 'IDR', 'Indonesia Rupiah', 'images/01JJC27XVNQT3RCAPR6GSQECTH.png', '2025-01-24 04:48:01', '2025-01-31 08:04:24'),
(4, 'MYR', 'Malaysia Ringgit', 'images/01JJYEH09X7ZKHG63E6VCVR1RF.png', '2025-01-31 08:09:01', '2025-01-31 08:09:01'),
(5, 'SAR', 'Saudi Arabian', 'images/01JJYEM1RV5KGYWW3XMAQ4048T.png', '2025-01-31 08:10:41', '2025-01-31 08:10:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'What are the additional fees?', 'There are no additional fees charged.', '2025-01-19 22:49:32', '2025-01-19 22:49:32'),
(2, 'When does the market open for trading investment?', 'The forex market is open 24 hours daily in several parts of the globe, from 5 p.m. EST on Sunday until 4 p.m. EST on Friday. the flexibility of the forex to trade invest over 24 hours is due partially to different international time zones.', '2025-01-19 22:51:29', '2025-01-19 22:51:29'),
(3, 'How to manage my risk?', 'The limit orders and the stop-loss orders are the most common risk management tools in Forex Trading Investment. A limit order helps to restrict the minimum price to be received or a maximum price to be paid. Stop-loss orders are used to set a position to', '2025-01-19 22:54:58', '2025-01-19 22:54:58'),
(4, 'What type of account do you offer?', 'We have a wide range of account types. You can explore the account types here and choose the one that suits you.', '2025-01-19 22:55:29', '2025-01-19 22:55:29'),
(5, 'Is there any minimum trading investment volume?', 'You can trade with as low as few dollars using our micro-accounts', '2025-01-19 22:55:56', '2025-01-19 22:55:56'),
(6, 'What is spread?', 'Spread is a difference between the bid and ask price of the base currency.', '2025-01-19 22:56:23', '2025-01-19 22:56:23'),
(7, 'How can I open a trading investment account?', 'You can open two types of accounts- Demo account and live account. In the demo account, you will get virtual money through with you can trade and learn virtually. In live account first, you need to deposit funds to trade  invest', '2025-01-19 22:56:53', '2025-01-19 22:56:53'),
(8, 'How to login to the trading investment platform?', 'Upon registering you will get a username and password through which you can log in into your account.', '2025-01-19 22:57:17', '2025-01-19 22:57:17'),
(9, 'Is any document required to open an account with Daxtradefx?', 'To open an account following documents will be required: –\nIdentification proof like passport or driving license.\nResidential proof', '2025-01-19 22:57:46', '2025-01-19 22:57:46'),
(10, 'How many accounts can I open?', 'Daxtradefx offers three base currencies in which you can trade invest. You can have multiple accounts for each base currency.', '2025-01-19 22:58:11', '2025-01-19 22:58:11'),
(11, 'What leverage is applied to my account?', 'Your account can have a maximum of 1:1000 leverage.', '2025-01-19 22:58:30', '2025-01-19 22:58:30'),
(12, 'How can I verify my account?', 'To verify your account, you need to submit a government-issued id and address proof.', '2025-01-19 22:58:50', '2025-01-19 22:58:50'),
(13, 'How can I open an account?', 'To open an account with Daxtradefx you need to provide us with some necessary information and submit some identification documents.', '2025-01-19 22:59:10', '2025-01-19 22:59:10'),
(14, 'How can I deposit funds into my account?', 'First, you need to go through our security and identification documents and then you can deposit funds into your account using a variety of different methods including bank transfer, bitcoin & many more.', '2025-01-19 22:59:47', '2025-01-19 22:59:47'),
(15, 'How can I withdraw money?', 'To do so you need to fill our security and identification documents and select the amount you wish to withdraw.', '2025-01-19 23:00:31', '2025-01-19 23:00:31'),
(19, 'Do you offer Islamic accounts?', 'Yes, we do offer it.\n', '2025-01-20 10:57:16', '2025-01-20 10:57:16'),
(20, 'What spreads do you offers?', 'We offer variable spreads that may be as low as 0.0 pips. We have got no re-quoting: our clients are given directly the value that our system receives.', '2025-01-20 10:57:33', '2025-01-20 10:57:33'),
(21, 'What leverage do you offer?', 'Leverage offered for Daxtradefx trading accounts is up to 1:1000 depending on the account type.', '2025-01-20 10:57:51', '2025-01-20 10:57:51'),
(22, 'Do you allow scalping?', 'Yes, we allow scalping.', '2025-01-20 10:58:10', '2025-01-20 10:58:10'),
(23, 'What is stop loss?', 'Stop-loss is an order for closing a previously opened position at a price less profitable for the client than the worth at the time of placing the stop loss. Stop loss could be a limit that you simply set to your order.\nOnce this limit is reached, your or', '2025-01-20 10:58:36', '2025-01-20 10:58:36'),
(24, 'Do you allow hedging?', 'Yes, we do. You are liberated to hedge your positions on your trading investment account. Hedging takes place after you open a protracted and a brief position on the identical instrument simultaneously. once you open a BUY and a SELL position on the ident', '2025-01-20 10:59:01', '2025-01-20 10:59:01'),
(25, 'Can I change my leverage? If yes then how?', 'Yes, under the My Account tab, you can change the leverage, and then press the Change Leverage button in our Members section. That is the instant leverage change method.', '2025-01-20 10:59:20', '2025-01-20 10:59:20'),
(26, 'I still have questions.', 'For further queries, you can contact us on our email and contact no.\n', '2025-01-20 10:59:40', '2025-01-20 10:59:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `investments`
--

CREATE TABLE `investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` enum('success','canceled','pending') NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `investments`
--

INSERT INTO `investments` (`id`, `user_id`, `package`, `amount`, `status`, `invoice`, `created_at`, `updated_at`) VALUES
(1, 3, 'BASIC', '100000.0909331', 'pending', 'INV-679459FA20709', '2025-01-24 20:26:50', '2025-01-24 20:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kycs`
--

CREATE TABLE `kycs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) NOT NULL,
  `identity` varchar(255) NOT NULL,
  `status` enum('pending','success','failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kycs`
--

INSERT INTO `kycs` (`id`, `user_id`, `photo`, `identity`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'kyc/vzBqEFrbFGkUhwU8GjtlIS936HKs9iXO171ZEcFL.jpg', 'kyc/NqnTaCMdHLsOG9u23RAUrT89KSeIaQjvYs7C814a.jpg', 'failed', '2025-01-25 09:38:31', '2025-01-28 07:16:28'),
(2, 19, 'kyc/Sn3jLHtn3u0PeplopFoa5LjiZlJKPNXcVwp2ZteA.jpg', 'kyc/PtAdavKM9gOF57CoLVe5xY90jtXRNhnfj5ITeEYq.jpg', 'success', '2025-01-27 18:54:18', '2025-01-30 19:07:05'),
(3, 30, 'kyc/QFfWWol5QdQo9LFQRsUbe1KJ9XzPEkPHLVEZlG4e.jpg', 'kyc/t7Sg52vaTgBHXdhLT8Dn9szLmV0c5wVrmVK4dg7j.jpg', 'success', '2025-01-28 00:35:26', '2025-01-28 09:16:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(9, '2025_01_17_131648_create_news_table', 1),
(10, '2025_01_17_140844_create_faqs_table', 1),
(11, '2025_01_17_142127_create_testimonials_table', 1),
(12, '2025_01_17_999999_create_amounts_table', 1),
(13, '2025_01_18_030222_create_notifications_table', 1),
(14, '2025_01_19_115333_create_packages_table', 1),
(15, '2025_01_19_117543_create_trades_table', 1),
(16, '2025_01_20_150414_create_withdrawals_table', 1),
(17, '2025_01_24_031914_create_settings_table', 2),
(18, '2025_01_24_042650_create_currencies_table', 3),
(19, '2025_01_24_043617_create_cripto_currencies_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `networks`
--

CREATE TABLE `networks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `child` bigint(20) UNSIGNED NOT NULL,
  `mother` bigint(20) UNSIGNED NOT NULL,
  `mother_id` bigint(20) UNSIGNED DEFAULT NULL,
  `join_date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `status` enum('publish','pending') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `type` enum('info','warning','error') NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-01-24 19:40:04', '2025-01-25 03:56:38'),
(2, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-01-24 19:57:35', '2025-01-25 03:56:38'),
(3, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-01-24 19:57:40', '2025-01-25 03:56:38'),
(4, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-01-24 20:07:17', '2025-01-25 03:56:38'),
(5, '2', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-01-24 20:07:22', '2025-01-24 20:07:22'),
(6, '3', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'read', '2025-01-24 20:11:18', '2025-01-25 03:56:38'),
(7, '3', 'Withdraw', 'Your withdraw has been approved', 'info', 'read', '2025-01-24 20:16:30', '2025-01-25 03:56:38'),
(8, '3', 'Withdraw', 'Your withdraw has been approved', 'info', 'read', '2025-01-24 20:16:38', '2025-01-25 03:56:38'),
(9, '14', 'Welcome Ahmad likuon', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-25 05:30:49', '2025-01-25 05:30:49'),
(10, '15', 'Welcome Riyan Suhada', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-25 05:32:51', '2025-01-25 05:32:51'),
(11, '3', 'KYC', 'Your kyc has been reject', 'error', 'read', '2025-01-25 09:48:29', '2025-01-31 08:02:07'),
(12, '16', 'Welcome Muh Belajar Sukses ', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-25 19:30:57', '2025-01-25 19:30:57'),
(13, '17', 'Welcome Anime putri ', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-25 20:16:07', '2025-01-25 20:16:07'),
(14, '18', 'Welcome Askari jaya', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-26 22:24:37', '2025-01-26 22:24:37'),
(15, '19', 'Welcome Bismillahirrahmanirrahim', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'read', '2025-01-26 23:21:03', '2025-01-27 04:04:26'),
(16, '20', 'Welcome DoeJhon', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'read', '2025-01-27 01:27:55', '2025-01-27 01:30:31'),
(17, '23', 'Welcome Aranti', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-27 08:30:20', '2025-01-27 08:30:20'),
(18, '24', 'Welcome Moli', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-27 08:57:37', '2025-01-27 08:57:37'),
(19, '25', 'Welcome Moli', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-27 09:06:19', '2025-01-27 09:06:19'),
(20, '29', 'Welcome Moli', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-27 09:33:01', '2025-01-27 09:33:01'),
(21, '30', 'Welcome Saya belajar', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'read', '2025-01-28 00:26:01', '2025-01-28 00:46:03'),
(22, '3', 'KYC', 'Your kyc has been reject', 'error', 'read', '2025-01-28 07:16:28', '2025-01-31 08:02:07'),
(23, '30', 'Withdraw', 'Your withdraw has been approved', 'info', 'read', '2025-01-29 08:01:59', '2025-01-29 08:02:52'),
(24, '19', 'KYC', 'Your kyc has been approved', 'info', 'unread', '2025-01-30 19:07:05', '2025-01-30 19:07:05'),
(25, '41', 'Welcome User1', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-01-31 03:48:53', '2025-01-31 03:48:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan` varchar(255) NOT NULL,
  `min_amount` varchar(255) NOT NULL,
  `max_amount` varchar(255) NOT NULL,
  `min_contract` varchar(255) NOT NULL,
  `max_contract` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `plan`, `min_amount`, `max_amount`, `min_contract`, `max_contract`, `created_at`, `updated_at`) VALUES
(1, 'BASIC', '300000', '5000000', '3', '7', '2025-01-19 23:01:30', '2025-01-29 18:35:53'),
(2, 'BRONZE', '100000', '1000000', '2', '12', '2025-01-19 23:03:39', '2025-01-24 19:05:13'),
(3, 'SILVER', '100000', '1000000', '2', '12', '2025-01-19 23:04:08', '2025-01-24 19:05:13'),
(4, 'GOLD', '100000', '1000000', '2', '12', '2025-01-19 23:04:48', '2025-01-24 19:05:13'),
(5, 'PLATINUM', '100000', '1000000', '2', '12', '2025-01-19 23:05:15', '2025-01-24 19:05:13'),
(6, 'DIAMOND', '100000', '1000000', '2', '12', '2025-01-19 23:05:39', '2025-01-24 19:05:13'),
(7, 'CROWN', '100000', '1000000', '2', '12', '2025-01-19 23:06:00', '2025-01-24 19:05:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) NOT NULL,
  `min_wd` decimal(15,2) NOT NULL,
  `min_tf` decimal(15,2) NOT NULL,
  `fee` int(11) NOT NULL,
  `telegram` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_logo`, `min_wd`, `min_tf`, `fee`, `telegram`, `created_at`, `updated_at`) VALUES
(1, 'INTERNASIONAL SUCCESS', 'logos/01JJYHY9MS3082PXNKDKY4YAJF.png', 10000.00, 500.00, 30, 'https://wa.me/82328035237', '2025-01-23 21:38:50', '2025-01-31 09:08:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('publish','pending') NOT NULL DEFAULT 'publish',
  `testimonial` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trades`
--

CREATE TABLE `trades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `market` varchar(255) NOT NULL,
  `trx` varchar(255) NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `rate_stake` varchar(255) NOT NULL,
  `rate_end` varchar(255) NOT NULL,
  `status` enum('Success','Pendding') NOT NULL,
  `win_lost` enum('Win','Lost') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `view_password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `view_password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin', '2025-01-20 08:16:22', '$2y$12$ehADPduluBATS6eGMcb8/usMH39aELGgm7I0VoBJd64NizpK/ExEe', NULL, 'snqxHZD5v6pKM2MIJYDa0rMXwtd31Nrwnr0XV2Xg41EREUq3zM0EQaeTY0EO', '2025-01-20 08:16:23', '2025-01-20 08:16:23'),
(3, 'Opikzz', 'opik@gmail.com', 'User', '2025-01-23 07:12:22', '$2y$12$ljZNyOZJTCbnoKoKu8Ri9uQxBCgrYru/GwaY2MDUiJferhRTHtoLe', 'OpikOnk123', NULL, '2025-01-19 23:41:34', '2025-01-31 08:11:19'),
(9, 'Jhon Doe', 'jhondoe@gmail.com', 'User', NULL, '$2y$12$dqixG2CnRC2uXMJW3wVja.ncwvrn5agYi9bnnx3SsqlJyxjeDtHiO', NULL, NULL, '2025-01-21 02:48:27', '2025-01-27 08:24:57'),
(13, 'Riyan Suhada', 'riyan@gmail.com', 'User', NULL, '$2y$12$Q51dKo2qyGm8BSthUBSs2.NshS49c///s7IAFGlKOLjdkRaBiYHli', NULL, NULL, '2025-01-25 05:27:57', '2025-01-25 05:27:57'),
(14, 'Ahmad likuon', 'likuon7@gmail.com', 'User', NULL, '$2y$12$TET1s6ZjSRM6hAxq6ZQazeauwbTq4oTzrDVIfahC5Urof2cb/hC2i', NULL, 'UfgPjiFayoFlzLX4h578hNzkABOZmmzcpn90C6FXIRpWUVJaLqC9Qy5iWOMr', '2025-01-25 05:30:49', '2025-01-25 05:30:49'),
(15, 'Riyan Suhada', 'riyan2@gmail.com', 'User', NULL, '$2y$12$SfphOevHJ.fGJ4XfcI0cY..KmbFUBbYI3dTFjTy.ObKMwWtFdoh4q', NULL, NULL, '2025-01-25 05:31:02', '2025-01-25 05:31:02'),
(16, 'Muh Belajar Sukses ', 'belajarsukses13579@gmail.com', 'User', NULL, '$2y$12$vjimKTPiOGo2IGCEEBVRpO2DAVBvd6HFYwmyVVp..R9ZmCpTwgzNm', NULL, '31xXUWeJPdCMf7zzHbbSC8PJdiS2j2FbK7T7PtQK3vSWnZsgCA1ZVl46cKNU', '2025-01-25 19:30:57', '2025-01-25 19:30:57'),
(17, 'Anime putri ', 'anime@gmail.com', 'User', NULL, '$2y$12$q5HurrUNvP7FTAbr1GxO..tspAFt/UY4XdiLqVgoji/i3j6soHyiC', NULL, NULL, '2025-01-25 20:16:07', '2025-01-25 20:16:07'),
(18, 'Askari jaya', 'askar@gmail.com', 'User', NULL, '$2y$12$TC0c/xjB1G.n.LrQO9z8CeAqqA6M3n74X6mYPezjCYMXC9lvhb6/.', NULL, NULL, '2025-01-26 22:24:37', '2025-01-26 22:24:37'),
(19, 'Bismillahirrahmanirrahim', 'gokugoal7@gmail.com', 'User', '2025-01-30 19:07:05', '$2y$12$z7wDOnYW0mPH./.LIVU1FeEbhl.JnSNuB2F3jIgzPdxlBKR3vKM36', 'Jhon12345', 'fzQQibZJc2lUEFKeazKUSYZZEDDXAZJe9eW1W9TQGutW4whNyMUxoauwf28J', '2025-01-26 23:21:03', '2025-01-30 19:07:05'),
(20, 'DoeJhon', 'doejhon@gmail.com', 'User', NULL, '$2y$12$/.brLb6YtMoEodx7XCbe8eVJ8rzxw18zwU7WCZn7jDStizt.4tXrO', NULL, NULL, '2025-01-27 01:27:55', '2025-01-27 01:27:55'),
(21, 'Rika', 'rika@gmail.com', 'User', NULL, '$2y$12$SNIzLDAo8LJZJ8RgJujhKudEfIhn7JaHUOZvQdvAIJBwD1irPSZ4e', NULL, NULL, '2025-01-27 07:58:39', '2025-01-27 07:58:39'),
(22, 'Rika', 'rika1@gmail.com', 'User', NULL, '$2y$12$azR1XxFe5lNPmzQQh.0p9.kCqiMN7O/GKkybyANZNolFTjbvLaOwC', NULL, NULL, '2025-01-27 08:28:01', '2025-01-27 08:28:01'),
(23, 'Aranti', 'aryanti@gmail.com', 'User', NULL, '$2y$12$sK8VuNlnBwSA7eQTeY9yO.5KPj873t0TN8LndRAqw0VuuFDLnh5aK', 'Aryanti123', NULL, '2025-01-27 08:30:20', '2025-01-28 06:54:24'),
(30, 'Saya belajar', 'saya@gmail.com', 'User', NULL, '$2y$12$fOyOtajydBqWxZPF76kirOQNQWGjSHyjS6CfBy8ANge3ICnPeOQ1u', 'saya12345', 'AamOowIbp1m2HSpTdvFzxsGcgJP2Hr4wzl0zAPV5eltnFaEmiY13CtdoM6N4', '2025-01-28 00:26:01', '2025-01-30 20:10:52'),
(37, 'Aldi', 'aldi@gmail.com', 'User', NULL, '$2y$12$BFkObMuoJWVpocB1nrOXVuI8Th39JAU0LcOfBW0pyuY8SOY/D5hF2', NULL, NULL, '2025-01-30 22:43:26', '2025-01-30 22:43:26'),
(38, 'oke', 'oke@gmail.com', 'User', NULL, '$2y$12$DNXAfC9eI.RUCyjwAM2e9evvKkHZqm4gleWjhbszEbVlKUKeQIEOu', NULL, NULL, '2025-01-31 03:41:38', '2025-01-31 03:41:38'),
(39, 'oke', 'oke2@gmail.com', 'User', NULL, '$2y$12$mSQ1.or32G1OIbnWbXvObuI6OQs76v3yo3u5iERllH3H9nRqoCsgS', NULL, NULL, '2025-01-31 03:45:20', '2025-01-31 03:45:20'),
(40, 'Oke3', 'oke3@gmail.com', 'User', NULL, '$2y$12$LeKViYF8CGrh/4DVnpn/xuBV1noIg4Y3XshkdwOD4sjJV2pM52I0S', NULL, NULL, '2025-01-31 03:45:54', '2025-01-31 03:45:54'),
(41, 'User1', 'user1@gmail.com', 'User', NULL, '$2y$12$6K9TngNsGuZ2oYXS0gRWyuCi5edxqVb5dwnnim/6.loHJ1IrWyzE2', 'OpikOnk123', NULL, '2025-01-31 03:48:53', '2025-01-31 03:48:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_data`
--

CREATE TABLE `user_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `referals` varchar(255) DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `bitcoin_address` varchar(255) DEFAULT NULL,
  `bank_number` varchar(255) DEFAULT NULL,
  `bank_name` varchar(20) DEFAULT NULL,
  `members` varchar(255) DEFAULT NULL,
  `type_currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_data`
--

INSERT INTO `user_data` (`id`, `user_id`, `referals`, `profile_image`, `username`, `address`, `country`, `phone_number`, `bitcoin_address`, `bank_number`, `bank_name`, `members`, `type_currency`, `created_at`, `updated_at`) VALUES
(2, 3, '', 'profile/GWoaDVSmMbPFen20WeiEPXbiv6YLbKz2AM29BGB6.jpg', 'Opikkz', 'Ngawi', 'Thailand', '082328035237', NULL, NULL, NULL, '100', 'SAR', '2025-01-19 23:41:34', '2025-01-31 08:11:19'),
(3, 9, 'Opikz', NULL, 'Jhon', NULL, NULL, NULL, NULL, NULL, NULL, '100', '', '2025-01-21 02:48:27', '2025-01-27 08:24:57'),
(6, 14, NULL, 'profile/ePrKwt2ZhIEVf17Nmb3GACkjzlbmuULAYbE8u1YK.png', 'Likuon', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-25 05:30:49', '2025-01-25 09:53:15'),
(7, 15, NULL, NULL, 'Riyan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-25 05:32:50', '2025-01-25 05:32:50'),
(8, 16, NULL, NULL, 'Belajar Sukses ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-25 19:30:57', '2025-01-25 19:30:57'),
(9, 17, NULL, NULL, 'anime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-25 20:16:07', '2025-01-25 20:16:07'),
(10, 18, NULL, 'profile/iZuvJ5JGYJdCbHO2TW88VIQJ2tRozRTqog3m1rsn.jpg', 'Aska', NULL, NULL, NULL, NULL, NULL, NULL, '100', '', '2025-01-26 22:24:37', '2025-01-27 07:53:20'),
(11, 19, NULL, 'profile/QUHBMEtCRGas74QyUPO9NoJNxkJHeJ8kkWkxiJyE.jpg', 'Bismillah ', 'Jl.mangonsidi kalbar', 'Indonesia', '+62811432765', NULL, NULL, NULL, '100', 'SGD', '2025-01-26 23:21:03', '2025-01-29 06:03:55'),
(12, 20, NULL, NULL, 'Does', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-27 01:27:55', '2025-01-27 07:11:36'),
(13, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-27 07:58:39', '2025-01-27 07:58:39'),
(14, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '2025-01-27 08:28:01', '2025-01-27 08:28:01'),
(15, 23, NULL, 'profile/VnqV5V2Ev0eoVYaTq93AQjw8ytRTVQwNnYmq2KR3.png', 'Aryanti', 'jl muh soleh', 'Indonesia', '082283833879', NULL, NULL, NULL, '200', 'SGD', '2025-01-27 08:30:20', '2025-01-28 06:54:24'),
(22, 30, NULL, 'profile/nGji2iX63oqAUN7V58ZFUu2fdsJI7u8uLY9DT9Li.jpg', 'Sayabelajar', 'Jl batal kalbar', 'Indonesia', '08113216578', NULL, NULL, NULL, '19179', 'IDR', '2025-01-28 00:26:01', '2025-01-30 20:10:52'),
(23, 41, NULL, NULL, 'user1@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '0', 'IDR', '2025-01-31 03:48:53', '2025-01-31 03:48:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `currency_type` varchar(255) NOT NULL,
  `bank_number` varchar(255) NOT NULL,
  `user_bank` varchar(255) NOT NULL,
  `pass_bank` varchar(255) NOT NULL,
  `pin_bank` varchar(255) DEFAULT NULL,
  `amount_withdraw` decimal(15,2) NOT NULL,
  `fee` decimal(15,2) NOT NULL,
  `status` enum('pending','success','failed') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `currency_type`, `bank_number`, `user_bank`, `pass_bank`, `pin_bank`, `amount_withdraw`, `fee`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'SGD (Singapure Dollar)', '1FfmbHfnpaZjKFvyi1okTjJJusN455paPH', 'opikz', 'Opik1234', '1234', 59824.41, 0.84, 'failed', '2025-01-24 20:09:43', '2025-01-24 20:11:18'),
(2, 3, 'SGD (Singapure Dollar)', '1FfmbHfnpaZjKFvyi1okTjJJusN455paPH', 'Opikz', 'opik1234', '1234', 59824.41, 10000.25, 'success', '2025-01-24 20:13:40', '2025-01-24 20:16:38'),
(3, 3, 'SGD (Singapure Dollar)', '1FfmbHfnpaZjKFvyi1okTjJJusN455paPH', 'Opikzz', 'opik123', '1234', 358946.46, 10000.25, 'success', '2025-01-24 20:14:55', '2025-01-24 20:16:30'),
(4, 30, 'IDR (Indonesia Rupiah)', 'BRI', 'Sayabelajar', '12345677', '120954', 150000000.00, 2000.00, 'pending', '2025-01-28 19:30:50', '2025-01-28 19:30:50'),
(5, 3, 'SGD (Singapure Dollar)', '328736263557672', 'Opikzzzzz', 'BNI', NULL, 9000.00, 30.00, 'pending', '2025-01-29 07:07:22', '2025-01-29 07:07:22'),
(6, 30, 'SGD (Singapure Dollar)', '7012472153', 'Saya belajar ', 'BNI', NULL, 8000.00, 30.00, 'success', '2025-01-29 08:01:14', '2025-01-29 08:01:59');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `amounts`
--
ALTER TABLE `amounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `amounts_user_id_foreign` (`user_id`),
  ADD KEY `amounts_from_user_foreign` (`from_user`);

--
-- Indeks untuk tabel `cripto_currencies`
--
ALTER TABLE `cripto_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faqs_title_unique` (`title`);

--
-- Indeks untuk tabel `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `investments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kycs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `networks_child_foreign` (`child`),
  ADD KEY `networks_mother_id_foreign` (`mother_id`);

--
-- Indeks untuk tabel `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trades_user_id_foreign` (`user_id`),
  ADD KEY `trades_package_id_foreign` (`package_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_data_username_unique` (`username`),
  ADD KEY `user_data_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawals_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `amounts`
--
ALTER TABLE `amounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `cripto_currencies`
--
ALTER TABLE `cripto_currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `networks`
--
ALTER TABLE `networks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `trades`
--
ALTER TABLE `trades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `amounts`
--
ALTER TABLE `amounts`
  ADD CONSTRAINT `amounts_from_user_foreign` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `amounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kycs`
--
ALTER TABLE `kycs`
  ADD CONSTRAINT `kycs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `networks`
--
ALTER TABLE `networks`
  ADD CONSTRAINT `networks_child_foreign` FOREIGN KEY (`child`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `networks_mother_id_foreign` FOREIGN KEY (`mother_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trades`
--
ALTER TABLE `trades`
  ADD CONSTRAINT `trades_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `trades_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_data`
--
ALTER TABLE `user_data`
  ADD CONSTRAINT `user_data_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
