-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 10, 2025 at 03:48 PM
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
(42, 3, 150000, 'bonus', 'success', 1, '<p>Tes</p>', '2025-05-06 06:23:12', '2025-05-06 06:38:34'),
(43, 2, 30000, 'bonus', 'success', 1, '<p>oke</p>', '2025-05-06 06:36:51', '2025-05-06 06:36:51'),
(44, 3, -150, 'withdraw', 'success', 3, 'Withdraw Balance', '2025-05-06 06:46:08', '2025-05-06 06:46:36'),
(45, 3, 150, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-05-06 06:46:36', '2025-05-06 06:46:36'),
(46, 3, -150000, 'withdraw', 'success', 3, 'Withdraw Balance', '2025-05-06 06:57:58', '2025-05-06 06:59:07'),
(47, 3, 150000, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-05-06 06:59:07', '2025-05-06 06:59:07'),
(48, 2, 50000, 'bonus', 'success', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 07:12:47', '2025-05-06 07:19:03'),
(49, 3, -50000, 'transfer', 'success', 3, 'Mengirim Saldo ke users', '2025-05-06 07:12:47', '2025-05-06 07:19:18'),
(50, 3, 100000, 'bonus', 'success', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 07:18:23', '2025-05-06 07:18:47'),
(51, 3, -100000, 'transfer', 'success', 3, 'Mengirim Saldo ke opikzz', '2025-05-06 07:18:23', '2025-05-06 07:18:55'),
(52, 3, 300000, 'deposit', 'success', 3, 'Deposit Saldo', '2025-05-06 07:19:49', '2025-05-06 07:20:33'),
(53, 2, 400000, 'bonus', 'success', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 09:59:49', '2025-05-06 10:06:21'),
(54, 3, -400000, 'transfer', 'success', 3, 'Mengirim Saldo ke users', '2025-05-06 09:59:50', '2025-05-06 10:06:30'),
(55, 3, 400000, 'deposit', 'success', 3, 'Deposit Saldo', '2025-05-06 10:06:46', '2025-05-06 10:06:56'),
(56, 3, -50000, 'withdraw', 'pending', 3, 'Withdraw Balance', '2025-05-06 10:07:19', '2025-05-06 10:07:19'),
(57, 3, 1344624473, 'bonus', 'success', 1, '<p>oke</p>', '2025-05-06 10:17:03', '2025-05-06 10:17:03'),
(58, 3, -1344974479, 'withdraw', 'success', 3, 'Withdraw Balance', '2025-05-06 10:36:16', '2025-05-06 10:37:16'),
(59, 3, 1344974479, 'refund', 'success', 1, 'Refund of Rejected Withdrawal', '2025-05-06 10:37:16', '2025-05-06 10:37:16'),
(60, 2, 30007809, 'bonus', 'pending', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 10:50:27', '2025-05-06 10:50:27'),
(61, 3, -30007809, 'transfer', 'pending', 3, 'Mengirim Saldo ke users', '2025-05-06 10:50:27', '2025-05-06 10:50:27'),
(62, 2, 293383, 'bonus', 'pending', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 10:51:24', '2025-05-06 10:51:24'),
(63, 3, -293383, 'transfer', 'pending', 3, 'Mengirim Saldo ke users', '2025-05-06 10:51:24', '2025-05-06 10:51:24'),
(64, 2, 1314673277, 'bonus', 'pending', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 10:54:06', '2025-05-06 10:54:06'),
(65, 3, -1314673277, 'transfer', 'pending', 3, 'Mengirim Saldo ke users', '2025-05-06 10:54:06', '2025-05-06 10:54:06'),
(66, 3, 1000000000, 'bonus', 'success', 1, '<p>tes</p><p><br></p>', '2025-05-06 10:55:04', '2025-05-06 10:56:08'),
(67, 2, 1000000000, 'bonus', 'success', 3, 'Menerima Saldo dari Tofiq', '2025-05-06 10:56:21', '2025-05-11 08:21:06'),
(68, 3, -1000000000, 'transfer', 'success', 3, 'Mengirim Saldo ke users', '2025-05-06 10:56:21', '2025-05-11 08:21:19'),
(69, 3, 4495842, 'bonus', 'success', 1, '<p>Bonus</p>', '2025-05-11 08:23:12', '2025-05-11 08:23:12');

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
(1, 'BTC', 'BITCOIN', '/images/bitcoin.png', '2025-04-24 20:12:23', '2025-04-24 20:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `currency_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `currency_name`, `country`, `currency_logo`, `created_at`, `updated_at`) VALUES
(1, 'SGD', 'Singapure Dollar', 'Singapure', '/images/singapore.png', '2025-04-24 20:12:21', '2025-04-24 20:12:21'),
(2, 'AED', 'Uni Emirates Arab Dirham', 'Uni Emirates Arab', 'images/01JSQYPY3QS2HECT3QE3HA8BMH.png', '2025-04-25 19:27:05', '2025-04-25 19:27:05'),
(3, 'IDR', 'Indonesia Rupiah', 'Indonesia', 'images/01JTHRQNX6AEV75M7JK9EHPK60.png', '2025-05-05 20:02:53', '2025-05-05 20:02:53');

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

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(4, 'How does the Referral Program work?', 'Earn rewards by inviting friends with your unique Referral Link. When they sign up and trade, you\'ll receive commissions credited directly to your Bonus balance. It\'s that simple to start earning more with Vonda Crypto\'s community program.', '2025-06-10 15:18:27', '2025-06-10 15:20:26'),
(5, 'What is the \"Bonus\" balance and how can I earn it?', 'Your Bonus balance is the total of all rewards earned from referrals and promotions. Note that some bonuses may have specific conditions that must be met before they can be withdrawn or used. Check the details for each bonus you receive.', '2025-06-10 15:21:18', '2025-06-10 15:21:18'),
(7, 'What is the \"Investment\" feature listed in the menu?', 'The \"Investment\" section offers specialized products beyond regular trading. Here you can find opportunities like staking to earn passive rewards on your assets or joining automated portfolio plans for strategic, long-term growth.', '2025-06-10 15:23:13', '2025-06-10 15:23:13'),
(8, 'Why is it important to complete the \"KYC\" process?', 'Completing KYC verifies your identity, protecting your account from fraud. It is a mandatory security step required by regulations. A verified KYC status is necessary to unlock full platform features, including higher withdrawal limits.', '2025-06-10 15:24:00', '2025-06-10 15:24:00'),
(9, 'How are my \"Profits\" on the dashboard calculated?', 'Your \"Profits\" figure shows your realized gains or losses from completed trades only. This number is updated after you close a position and does not include the unrealized profit or loss from your currently open trades.', '2025-06-10 15:24:53', '2025-06-10 15:24:53'),
(10, 'What is the \"Transfer\" function in the \"Wallet\" menu?', 'Use the \"Transfer\" function to instantly send funds to other Vonda Crypto users.', '2025-06-10 15:26:07', '2025-06-10 15:26:07'),
(11, 'What methods can I use to \"Add Balance\" to my wallet?', 'To fund your account, use the \"Add Balance\" feature. You can deposit crypto directly from an external wallet to your unique Vonda Crypto address. by waiting for verification from the admin and payment through the admin guide.', '2025-06-10 15:27:56', '2025-06-10 15:27:56'),
(12, 'What is the standard process for making a “Withdrawal”?', 'Go to “Wallet” then “Withdrawal”. Select the asset and amount, then carefully enter the recipient address.', '2025-06-10 15:30:21', '2025-06-10 15:30:21');

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

--
-- Dumping data for table `kycs`
--

INSERT INTO `kycs` (`id`, `user_id`, `photo`, `identity`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'kyc/2dB9yaXWvYKMnrkaqeCvcsWXvg34ezIGLWPLjwky.png', 'kyc/SU3XQSkD7wcYqdMQjvKBi4yqLtGkYDvVjkbFmyUp.png', 'success', '2025-05-05 22:40:05', '2025-05-05 22:46:57');

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
(5, '2025_01_17_011349_create_currencies_table', 1),
(6, '2025_01_17_011350_create_user_data_table', 1),
(7, '2025_01_17_022256_create_kycs_table', 1),
(8, '2025_01_17_030514_create_investments_table', 1),
(9, '2025_01_17_122755_create_networks_table', 1),
(10, '2025_01_17_122756_create_settings_table', 1),
(11, '2025_01_17_131648_create_news_table', 1),
(12, '2025_01_17_140844_create_faqs_table', 1),
(14, '2025_01_17_999999_create_amounts_table', 1),
(15, '2025_01_18_030222_create_notifications_table', 1),
(16, '2025_01_19_115333_create_packages_table', 1),
(17, '2025_01_19_117543_create_trades_table', 1),
(18, '2025_01_20_150414_create_withdrawals_table', 1),
(19, '2025_01_24_043617_create_cripto_currencies_table', 1),
(20, '2025_01_17_142127_create_testimonials_table', 2);

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

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `thumbnail`, `title`, `content`, `author`, `status`, `created_at`, `updated_at`) VALUES
(1, 'news/01JTJD2JV6B8172QBZ2Q0MYBHH.jpg', 'Mata Uang Asia Melemah, Dolar Stabil di Tengah Ketidakpastian Tarif Jelang Rapat Fed', '<p>Investing.com — Sebagian besar mata uang Asia melemah pada hari Selasa, sementara dolar stabil di tengah ketidakpastian yang berlanjut mengenai pembicaraan perdagangan AS-China, dengan antisipasi pertemuan Federal Reserve minggu ini juga mulai berpengaruh.</p><p>Volume perdagangan regional dibatasi oleh libur pasar di Jepang dan Korea Selatan, sementara pasar China dibuka kembali setelah libur Hari Buruh. Yuan menguat tajam dalam perdagangan catch-up, sekaligus mendapat keuntungan dari meningkatnya spekulasi mengenai pembicaraan perdagangan AS-China.</p><p>Dolar stabil setelah mendapatkan kembali beberapa posisinya minggu ini, meskipun greenback masih mengalami kerugian besar selama lebih dari tiga bulan terakhir. Komentar dari Presiden AS Donald Trump dan kabinetnya tidak banyak mengurangi ketidakpastian mengenai rencana tarifnya.</p><p>Pasangan yen Jepang <a href=\"https://id.investing.com/currencies/usd-jpy\"><span style=\"text-decoration: underline;\">USDJPY</span></a> sedikit naik pada hari Selasa, begitu juga dengan pasangan won Korea Selatan <a href=\"https://id.investing.com/currencies/usd-krw\"><span style=\"text-decoration: underline;\">USDKRW</span></a>.</p><p>Dolar Taiwan adalah yang berkinerja terburuk di Asia, dengan pasangan <a href=\"https://id.investing.com/currencies/usd-twd\"><span style=\"text-decoration: underline;\">USDTWD</span></a> melonjak 3,7% setelah anjlok ke level terendah dalam dua tahun pada sesi-sesi terakhir. Mata uang ini berada di pusat potensi pelepasan posisi long-dolar di antara mata uang Asia, yang juga dapat mendukung unit lain di kawasan ini.</p><p>Pasangan rupee India <a href=\"https://id.investing.com/currencies/usd-inr\"><span style=\"text-decoration: underline;\">USDINR</span></a> naik 0,1%, sementara pasangan dolar Singapura <a href=\"https://id.investing.com/currencies/usd-sgd\"><span style=\"text-decoration: underline;\">USDSGD</span></a> naik 0,4%. Pasangan dolar Australia <a href=\"https://id.investing.com/currencies/aud-usd\"><span style=\"text-decoration: underline;\">AUDUSD</span></a> turun 0,2% setelah mencatat kenaikan kuat minggu lalu.</p><h2><strong>Yuan China meroket ke level tertinggi 6 minggu didorong harapan pembicaraan dagang</strong></h2><p>Pasangan onshore yuan China melesat ke level terkuatnya dalam lebih dari enam minggu saat perdagangan dilanjutkan setelah libur Hari Buruh.</p><p>Pasangan yuan <a href=\"https://id.investing.com/currencies/usd-cny\"><span style=\"text-decoration: underline;\">USDCNY</span></a> turun 0,6% menjadi 7,2302 yuan, level terendahnya sejak akhir Maret. Mata uang ini sebagian besar menguat melampaui <a href=\"https://id.investing.com/economic-calendar/caixin-services-pmi-596\"><span style=\"text-decoration: underline;\">data purchasing managers swasta</span></a> yang menunjukkan aktivitas jasa tumbuh kurang dari yang diharapkan pada April.</p><p>Mata uang ini terutama didorong oleh sinyal Beijing bahwa mereka sedang mengevaluasi proposal dari pejabat AS untuk pembicaraan perdagangan, setelah AS dan China terlibat dalam perselisihan perdagangan yang sengit pada April.</p><p>China telah meminta AS untuk menurunkan tarifnya sebelum dialog dapat berlangsung, sementara Presiden Donald Trump mengisyaratkan bahwa dia hanya akan menurunkan tarif pada China jika Beijing datang ke meja perundingan terlebih dahulu.</p><p>Trump mengatakan pada hari Senin bahwa China sangat membutuhkan kesepakatan perdagangan, sementara Menteri Keuangan Scott Bessent mengatakan dia yakin bahwa pembicaraan akan berlangsung dalam beberapa minggu mendatang.</p><h2><strong>Dolar stabil menjelang pertemuan Fed</strong></h2><p><a href=\"https://id.investing.com/indices/usdollar\"><span style=\"text-decoration: underline;\">Indeks dolar</span></a> dan <a href=\"https://id.investing.com/currencies/us-dollar-index\"><span style=\"text-decoration: underline;\">futures indeks dolar</span></a> bergerak sedikit dalam perdagangan Asia, stabil setelah mencatat beberapa kenaikan dalam sesi-sesi terakhir.</p><p>Namun greenback masih mengalami kerugian besar selama tiga bulan terakhir, karena para pedagang khawatir tentang dampak ekonomi dari kebijakan Trump. Tren ini diperburuk oleh pelepasan posisi long dolar secara bertahap, terutama di Asia, di tengah menurunnya kepercayaan terhadap ekonomi AS. Serangkaian data ekonomi yang lemah juga membebani.</p><p>Fokus minggu ini sepenuhnya pada kesimpulan <a href=\"https://id.investing.com/economic-calendar/fed-interest-rate-decision-168\"><span style=\"text-decoration: underline;\">pertemuan Fed</span></a> pada hari Rabu, di mana bank sentral secara luas diperkirakan akan mempertahankan suku bunga tidak berubah di tengah ketidakpastian ekonomi yang meningkat dan inflasi yang lengket.</p><p>Fokus juga akan pada komentar dari Ketua Fed Jerome Powell, di tengah tekanan berulang dari Presiden Trump agar Powell menurunkan suku bunga.</p><p><em>Artikel ini diterjemahkan dengan bantuan kecerdasan buatan. Untuk informasi lebih lanjut, mohon pelajari Syarat dan Ketentuan kami.</em></p>', '1', 'publish', '2025-05-06 08:58:21', '2025-05-06 08:58:21'),
(2, 'news/01JV4DRH5PFFW58EM0BGS4QQ3D.jpg', 'Bitcoin price today: down at $102.4k after US-China tariff truce; US CPI awaited', '<p>Investing.com-- <a href=\"https://ng.investing.com/crypto/bitcoin\">Bitcoin</a> fell further on Tuesday amid profit-taking above the key $100,000 mark, though optimism over the temporary U.S.-China trade truce continued to provide some support.</p><p>The world’s largest cryptocurrency fell 1.9% to $102,363.0 by 02:03 ET (06:03 GMT).</p><p>The token saw sharp gains last week as it blew past the coveted $100k level on optimism around easing trade tensions. It reached above $105,000 last week.</p><p>However, investors booked profits ahead of key U.S. inflation data due later in the day.</p><h2><strong>Investors digest US-China tariff deal, US SEC plans for new crypto rules</strong></h2><p>The U.S. and China said on Monday they have agreed to temporarily lower soaring tariffs placed on each other.</p><p>The U.S. will reduce its tariff on Beijing from 145% to 30%, while China will lower its retaliatory tariff from 125% to 10%, both for 90 days.</p><p>The announcement came via a joint statement following trade talks in Switzerland over the weekend.</p><p>Adding to the optimism, President Donald Trump on Monday signed an executive order slashing tariffs on low-value, or De Minimis imports from China, to 54% from 120%, while keeping a flat $100 fee in place.</p><p>On the regulatory front, investors also digested Chair of the Securities and Exchange Commission Paul Atkins’ detailed plans to introduce new rules for crypto tokens covering a myriad of factors, including token distributions and exemptions.</p><h2><strong>Crypto firms eye US listing amid favorable policies</strong></h2><p>American Bitcoin, a cryptocurrency mining firm co-founded by Eric Trump and Donald Trump Jr., announced plans to go public through an all-stock merger with Gryphon Digital <a href=\"https://ng.investing.com/indices/mining\">Mining</a>. The combined entity will list on Nasdaq.</p><p>This move aligns with President Donald Trump’s pro-crypto regulatory stance, which has encouraged similar ventures to enter U.S. capital markets.</p><p>In other news, the Financial Times reported on Tuesday that Hong Kong-based crypto investor Animoca Brands is planning a stock market listing in New York.</p><h2><strong>KindlyMD shares skyrocket on Nakamoto merger, close up 251%</strong></h2><p>Kindly MD Inc (NASDAQ:<a href=\"https://ng.investing.com/equities/kindly-md\">KDLY</a>) shares hit an all-time high of $31.45 on Monday, surging over 600% after the healthcare company announced a merger with Bitcoin investment firm Nakamoto Holdings to launch a Bitcoin treasury strategy.</p><p>By close, KindlyMD’s stock pared its gains to 251% to end at $13.69.</p><h2><strong>Crypto price today: altcoins decline; Dogecoin, Polygon lead losses</strong></h2><p>Altcoins were largely mixed on Monday, with most declining much more than Bitcoin.</p><p>World no.2 crypto <a href=\"https://ng.investing.com/crypto/ethereum\">Ethereum</a> fell 2.5% to $2,456.57.</p><p>World no. 3 crypto <a href=\"https://ng.investing.com/crypto/xrp\">XRP</a> jumped 4.5% to $2.5071.</p><p><a href=\"https://ng.investing.com/crypto/solana\">Solana</a> declined 3%, while <a href=\"https://ng.investing.com/crypto/cardano\">Cardano</a> lost 3.5%, and <a href=\"https://ng.investing.com/crypto/polygon\">Polygon</a> slumped 4%.</p><p>Among meme tokens, <a href=\"https://ng.investing.com/crypto/dogecoin\">Dogecoin</a> plunged 7.8%, while <a href=\"https://ng.investing.com/crypto/official-trump\">$TRUMP</a> declined nearly 10%.</p>', '1', 'publish', '2025-05-13 08:56:40', '2025-05-13 08:56:40');

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
(1, '2', 'Welcome Users', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-04-24 20:13:32', '2025-04-24 20:13:32'),
(2, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-26 10:34:21', '2025-04-26 10:34:21'),
(3, '2', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-04-26 10:49:54', '2025-04-26 10:49:54'),
(4, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-27 21:33:09', '2025-04-27 21:33:09'),
(5, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-27 21:38:57', '2025-04-27 21:38:57'),
(6, '2', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-04-27 21:40:52', '2025-04-27 21:40:52'),
(7, '2', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-04-27 21:42:23', '2025-04-27 21:42:23'),
(8, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-04-27 21:48:34', '2025-04-27 21:48:34'),
(9, '2', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-04-27 21:49:24', '2025-04-27 21:49:24'),
(10, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 20:04:52', '2025-05-05 20:04:52'),
(11, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 20:42:45', '2025-05-05 20:42:45'),
(12, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 20:45:01', '2025-05-05 20:45:01'),
(13, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 21:01:04', '2025-05-05 21:01:04'),
(14, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 21:25:45', '2025-05-05 21:25:45'),
(15, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 21:57:20', '2025-05-05 21:57:20'),
(16, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 21:58:05', '2025-05-05 21:58:05'),
(17, '2', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-05-05 22:02:29', '2025-05-05 22:02:29'),
(18, '2', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-05-05 22:02:44', '2025-05-05 22:02:44'),
(19, '2', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-05-05 22:04:55', '2025-05-05 22:04:55'),
(20, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 22:11:38', '2025-05-05 22:11:38'),
(21, '2', 'Withdraw', 'Your withdraw has been approved', 'info', 'unread', '2025-05-05 22:12:38', '2025-05-05 22:12:38'),
(22, '2', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'unread', '2025-05-05 22:13:46', '2025-05-05 22:13:46'),
(23, '3', 'Welcome Tofiq', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'read', '2025-05-05 22:26:58', '2025-05-07 04:26:36'),
(24, '3', 'KYC', 'Your kyc has been approved', 'info', 'read', '2025-05-05 22:46:57', '2025-05-07 04:26:36'),
(25, '3', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'read', '2025-05-06 06:46:36', '2025-05-07 04:26:36'),
(26, '3', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'read', '2025-05-06 06:59:07', '2025-05-07 04:26:36'),
(27, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-05-06 07:18:47', '2025-05-07 04:26:36'),
(28, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-05-06 07:18:55', '2025-05-07 04:26:36'),
(29, '2', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-05-06 07:19:03', '2025-05-06 07:19:03'),
(30, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-05-06 07:19:18', '2025-05-07 04:26:36'),
(31, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-05-06 07:20:33', '2025-05-07 04:26:36'),
(32, '2', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-05-06 10:06:21', '2025-05-06 10:06:21'),
(33, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-05-06 10:06:30', '2025-05-07 04:26:36'),
(34, '3', 'Balance', 'Your balance has been approved', 'info', 'read', '2025-05-06 10:06:56', '2025-05-07 04:26:36'),
(35, '3', 'you get bonus balance', 'you get additional balance from admin', 'info', 'read', '2025-05-06 10:17:03', '2025-05-07 04:26:36'),
(36, '3', 'Withdraw', 'Your withdraw has been reject!, Try again leter', 'error', 'read', '2025-05-06 10:37:16', '2025-05-07 04:26:36'),
(37, '3', 'you get bonus balance', 'you get additional balance from admin', 'info', 'read', '2025-05-06 10:55:03', '2025-05-07 04:26:36'),
(38, '2', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-05-11 08:21:06', '2025-05-11 08:21:06'),
(39, '3', 'Balance', 'Your balance has been approved', 'info', 'unread', '2025-05-11 08:21:19', '2025-05-11 08:21:19'),
(40, '3', 'you get bonus balance', 'you get additional balance from admin', 'info', 'unread', '2025-05-11 08:23:11', '2025-05-11 08:23:11'),
(41, '4', 'Welcome kosem koe', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-05-13 10:26:23', '2025-05-13 10:26:23'),
(42, '5', 'Welcome kina saudarika', 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀', 'info', 'unread', '2025-05-13 10:31:05', '2025-05-13 10:31:05');

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
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_logo`, `min_wd`, `min_tf`, `fee`, `telegram`, `email`, `address`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'Vonda Crypto', 'logos/01JXCZ6ZTD7M8R8RAJSG5CGAQF.png', '50000.00', '50000.00', '0.00', 'https://te.me/hdud73hnd', 'opikzstudio@gmail.com', NULL, '082328035237', '2025-04-24 20:12:22', '2025-06-10 15:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('publish','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `position` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonial` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `user_id`, `status`, `position`, `testimonial`, `created_at`, `updated_at`) VALUES
(1, 3, 'publish', 'SEO Opik Studio', 'Dalam penyebutannya, FAQ sering dibaca sebagai huruf terpisah, yaitu “eff-ay-cue”. Biasanya, kamu dapat menemukan FAQ dalam situs web, aplikasi dan sebuah email campaign.', '2025-05-10 13:23:45', '2025-05-10 13:23:45'),
(2, 2, 'publish', 'Hedge Fund Analyst', 'The Systematic Trader transformed my approach to cryptocurrency markets. The real-time analytics and customizable alerts have helped me capture opportunities I would have otherwise missed. My portfolio has grown by 32% since joining this platform.', '2025-05-13 09:51:43', '2025-05-13 09:51:43');

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
(1, 'Admin', 'admin@gmail.com', 'Admin', '2025-04-24 20:12:21', '$2y$12$U98RmqN32JHwiu7OcVj.aOf6mWHqhTSAp76XF9HaW/zsWVU/qNm8i', 'Admin123', NULL, '2025-04-24 20:12:21', '2025-05-05 20:58:36'),
(2, 'Users', 'user@gmail.com', 'User', NULL, '$2y$12$HmsJi3FaovUxn8vFwVhr/eZCqZB/vs4HLJi2VIvVbBJNViM6SRPSS', '12345678', NULL, '2025-04-24 20:13:31', '2025-05-05 22:09:53'),
(3, 'Tofiq', 'opik@gmail.com', 'User', '2025-05-05 22:46:57', '$2y$12$0L8sv8btLOOtDEE.fJ9wyOHxa8/trQnZRPFQdw43fOlGGDgV8nBZ2', 'OpikOnk123', NULL, '2025-05-05 22:26:58', '2025-05-06 10:17:40'),
(4, 'kosem koe', 'kosem@gmail.com', 'User', NULL, '$2y$12$PAji46cGzjD1r/Uel0OegOJgc5CL0uTEsZO1MWiU4pfSsYYdiFl6C', 'Kosem123', NULL, '2025-05-13 10:26:23', '2025-05-13 10:26:23'),
(5, 'kina saudarika', 'kina@gmail.com', 'User', NULL, '$2y$12$ZL6QRXx6P7R/D0Ox2jz9bObVq5k73NY9BMNbAkFZDCRbssKBLB1oC', 'kina12345', NULL, '2025-05-13 10:31:05', '2025-05-13 10:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `referals` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 1, '1', NULL, 'admin', NULL, 'Indonesia', NULL, NULL, NULL, NULL, 'IDR', '1', '2025-04-24 20:12:21', '2025-05-05 20:58:36'),
(2, 2, NULL, 'profile/EHnCwJdRusawh2miK0hjP8Z82VSuQ7EOfhgJcoDQ.png', 'users', 'Jalan tes', 'Uni Emirates Arab', '0489383783', 'bejfewkjnfkew', '8734832784329', 'BNI', 'AED', '0', '2025-04-24 20:13:31', '2025-05-05 22:19:37'),
(3, 3, NULL, 'profile/nTT9yh0VBjwf2A3GUzswoSwL2sBlenyOJgjlkTaB.svg', 'opikzz', 'tes jalan sehat', 'Indonesia', '082328035237', 'jbcdkjbsekj', '76347836', 'BNI', 'AED', NULL, '2025-05-05 22:26:58', '2025-05-13 10:31:05'),
(4, 4, 'opikzz', NULL, 'kosem', NULL, NULL, NULL, NULL, NULL, NULL, 'IDR', NULL, '2025-05-13 10:26:23', '2025-05-13 10:26:23'),
(5, 5, 'opikzz', NULL, 'kina', NULL, NULL, NULL, NULL, NULL, NULL, 'IDR', NULL, '2025-05-13 10:31:05', '2025-05-13 10:31:05');

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
(20, 3, 'IDR(Indonesia Rupiah)', '76347836', 'opikzz', '76347836', '-', '150.00', '0.00', 'failed', '2025-05-06 06:46:08', '2025-05-06 06:46:36'),
(21, 3, 'IDR(Indonesia Rupiah)', '76347836', 'opikzz', '76347836', '-', '150000.00', '0.00', 'failed', '2025-05-06 06:57:58', '2025-05-06 06:59:07'),
(22, 3, 'IDR(Indonesia Rupiah)', '76347836', 'opikzz', 'BNI', '-', '50000.00', '0.00', 'pending', '2025-05-06 10:07:19', '2025-05-06 10:07:19'),
(23, 3, 'AED(Uni Emirates Arab Dirham)', '76347836', 'opikzz', 'BNI', '-', '1344974479.48', '0.00', 'failed', '2025-05-06 10:36:16', '2025-05-06 10:37:16');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
