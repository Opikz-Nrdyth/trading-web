-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2024 at 04:10 PM
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
-- Database: `tradergo`
--

-- --------------------------------------------------------

--
-- Table structure for table `crypto_coins`
--

CREATE TABLE `crypto_coins` (
  `coin_name` varchar(100) NOT NULL,
  `coin_symbol` varchar(10) NOT NULL,
  `logo_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crypto_coins`
--

INSERT INTO `crypto_coins` (`coin_name`, `coin_symbol`, `logo_url`) VALUES
('aave', 'AAVE/USD', '/Assets/Images/CryptocurrencyIcons/aave.svg'),
('cardano', 'ADA/USD', '/Assets/Images/CryptocurrencyIcons/cardano.svg'),
('algorand', 'ALGO/USD', '/Assets/Images/CryptocurrencyIcons/algorand.svg'),
('cosmos', 'ATOM/USD', '/Assets/Images/CryptocurrencyIcons/cosmos.svg'),
('avalanche', 'AVAX/USD', '/Assets/Images/CryptocurrencyIcons/avalanche.svg'),
('axie-infinity', 'AXS/USD', '/Assets/Images/CryptocurrencyIcons/axie-infinity.svg'),
('bitcoin-cash', 'BCH/USD', '/Assets/Images/CryptocurrencyIcons/bitcoin-cash.svg'),
('binance-coin', 'BNB/USD', '/Assets/Images/CryptocurrencyIcons/binance-coin.svg'),
('bitcoin-sv', 'BSV/USD', '/Assets/Images/CryptocurrencyIcons/bitcoin-sv.svg'),
('bitcoin', 'BTC/USD', '/Assets/Images/CryptocurrencyIcons/bitcoin.svg'),
('pancakeswap', 'CAKE/USD', '/Assets/Images/CryptocurrencyIcons/pancakeswap.svg'),
('compound', 'COMP/USD', '/Assets/Images/CryptocurrencyIcons/compound.svg'),
('crypto-com-coin', 'CRO/USD', '/Assets/Images/CryptocurrencyIcons/crypto-com-coin.svg'),
('curve-dao-token', 'CRV/USD', '/Assets/Images/CryptocurrencyIcons/curve-dao-token.svg'),
('dogecoin', 'DOGE/USD', '/Assets/Images/CryptocurrencyIcons/dogecoin.svg'),
('polkadot', 'DOT/USD', '/Assets/Images/CryptocurrencyIcons/polkadot.svg'),
('eos', 'EOS/USD', '/Assets/Images/CryptocurrencyIcons/eos.svg'),
('ethereum-classic', 'ETC/USD', '/Assets/Images/CryptocurrencyIcons/ethereum-classic.svg'),
('ethereum', 'ETH/USD', '/Assets/Images/CryptocurrencyIcons/ethereum.svg'),
('filecoin', 'FIL/USD', '/Assets/Images/CryptocurrencyIcons/filecoin.svg'),
('flow', 'FLOW/USD', '/Assets/Images/CryptocurrencyIcons/flow.svg'),
('fantom', 'FTM/USD', '/Assets/Images/CryptocurrencyIcons/fantom.svg'),
('hedera-hashgraph', 'HBAR/USD', '/Assets/Images/CryptocurrencyIcons/hedera-hashgraph.svg'),
('internet-computer', 'ICP/USD', '/Assets/Images/CryptocurrencyIcons/internet-computer.svg'),
('klaytn', 'KLAY/USD', '/Assets/Images/CryptocurrencyIcons/klaytn.svg'),
('chainlink', 'LINK/USD', '/Assets/Images/CryptocurrencyIcons/chainlink.svg'),
('litecoin', 'LTC/USD', '/Assets/Images/CryptocurrencyIcons/litecoin.svg'),
('decentraland', 'MANA/USD', '/Assets/Images/CryptocurrencyIcons/decentraland.svg'),
('polygon', 'MATIC/USD', '/Assets/Images/CryptocurrencyIcons/polygon.svg'),
('iota', 'MIOTA/USD', '/Assets/Images/CryptocurrencyIcons/iota.svg'),
('maker', 'MKR/USD', '/Assets/Images/CryptocurrencyIcons/maker.svg'),
('near-protocol', 'NEAR/USD', '/Assets/Images/CryptocurrencyIcons/near-protocol.svg'),
('neo', 'NEO/USD', '/Assets/Images/CryptocurrencyIcons/neo.svg'),
('okb', 'OKB/USD', '/Assets/Images/CryptocurrencyIcons/okb.svg'),
('quant', 'QNT/USD', '/Assets/Images/CryptocurrencyIcons/quant.svg'),
('raydium', 'RAY/USD', '/Assets/Images/CryptocurrencyIcons/raydium.svg'),
('the-sandbox', 'SAND/USD', '/Assets/Images/CryptocurrencyIcons/the-sandbox.svg'),
('shiba-inu', 'SHIB/USD', '/Assets/Images/CryptocurrencyIcons/shiba-inu.svg'),
('solana', 'SOL/USD', '/Assets/Images/CryptocurrencyIcons/solana.svg'),
('theta', 'THETA/USD', '/Assets/Images/CryptocurrencyIcons/theta.svg'),
('tron', 'TRX/USD', '/Assets/Images/CryptocurrencyIcons/tron.svg'),
('uniswap', 'UNI/USD', '/Assets/Images/CryptocurrencyIcons/uniswap.svg'),
('usd-coin', 'USDC/USD', '/Assets/Images/CryptocurrencyIcons/usd-coin.svg'),
('tether', 'USDT/USD', '/Assets/Images/CryptocurrencyIcons/tether.svg'),
('vechain', 'VET/USD', '/Assets/Images/CryptocurrencyIcons/vechain.svg'),
('wrapped-bitcoin', 'WBTC/USD', '/Assets/Images/CryptocurrencyIcons/wrapped-bitcoin.svg'),
('stellar', 'XLM/USD', '/Assets/Images/CryptocurrencyIcons/stellar.svg'),
('monero', 'XMR/USD', '/Assets/Images/CryptocurrencyIcons/monero.svg'),
('xrp', 'XRP/USD', '/Assets/Images/CryptocurrencyIcons/xrp.svg'),
('tezos', 'XTZ/USD', '/Assets/Images/CryptocurrencyIcons/tezos.svg'),
('zcash', 'ZEC/USD', '/Assets/Images/CryptocurrencyIcons/zcash.svg');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','completed') NOT NULL,
  `telegram_chat_id` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `transaction_type` enum('buy','sell') NOT NULL,
  `coin_symbol` varchar(10) NOT NULL,
  `amount` decimal(18,8) NOT NULL,
  `price_at_transaction` decimal(18,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','client') NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gender` enum('laki-laki','perempuan') NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `work` varchar(250) NOT NULL,
  `capital_amount` decimal(15,2) DEFAULT '0.00',
  `saldo_awal` varchar(30) NOT NULL,
  `saldo_tambahan` varchar(30) NOT NULL,
  `bonus_member` varchar(30) NOT NULL,
  `saldo_akhir` varchar(30) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `quotes` text NOT NULL,
  `quotes_withdaw_fail` text NOT NULL,
  `account_status` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nominal_type` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `name`, `address`, `gender`, `phone_number`, `work`, `capital_amount`, `saldo_awal`, `saldo_tambahan`, `bonus_member`, `saldo_akhir`, `profile_picture`, `quotes`, `quotes_withdaw_fail`, `account_status`, `nominal_type`, `created_at`, `updated_at`) VALUES
(7785975, 'mimin@gmail.com', '1234', 'admin', 'Admin Trading', 'Babadan Pangkur Ngawi', 'perempuan', '082328035237', 'Programmer', '0.00', '', '', '', '', '/Assets/Images/foto-profile.png', 'Good', '', 'notactive', '', '2024-11-01 03:53:31', '2024-11-07 16:29:20'),
(31781449, 'andira@gmail.com', '1234', 'client', 'andira', 'jakarta', 'perempuan', '0823484488', 'sales', '300000.00', '', '', '', '', '/Assets/Images/profile/31781449.png', 'lorem belu dia akses', '', '500000', '', '2024-11-07 16:32:02', '2024-11-07 16:33:52'),
(79549298, 'moli@gmail.com', '1234', 'client', 'Moli Comel', 'Tidak Tau', 'laki-laki', '039847', 'Turu', '764877.00', '1000000', '10000', '0', '1010000', '/Assets/Images/profile/79549298.png', 'Good', 'Yang sabar ya guys', 'active', 'USD', '2024-11-04 18:51:53', '2024-11-13 16:08:48'),
(79995750, 't@gmail.com', '1234', 'client', 'Opikz', 'udicjnc', 'laki-laki', '03987477', 'oieu', '99000.00', '', '', '', '', '/Assets/Images/profile/79995750.png', '', '', '', '', '2024-11-04 13:20:16', '2024-11-04 15:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama_payment` varchar(250) NOT NULL,
  `method` varchar(250) NOT NULL,
  `number_payment` varchar(250) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','completed') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `user_id`, `nama_payment`, `method`, `number_payment`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(4943775, 79995750, 'Tofiq Nrdyth', 'DANA', '0283777636', '100000.00', 'completed', '2024-11-04 15:46:54', '2024-11-04 17:34:39'),
(6816825, 31781449, 'andira', 'BCA', '1234567890', '200000.00', 'completed', '2024-11-07 16:33:52', '2024-11-10 16:09:55'),
(17429867, 79995750, 'Tofiq', 'BCA', '0394773', '1000.00', 'completed', '2024-11-04 15:50:32', '2024-11-10 16:10:06'),
(25278773, 79549298, 'Opik', 'Bank Mandiri', '837746462', '0.00', 'completed', '2024-11-10 16:03:35', '2024-11-10 16:09:57'),
(25869611, 79549298, 'Opik', 'GoPay', '1827362', '1.00', 'completed', '2024-11-10 16:04:51', '2024-11-10 16:09:59'),
(40491297, 79549298, 'Opikz', 'Bank Mandiri', '273652651', '78372.00', 'completed', '2024-11-10 16:09:32', '2024-11-10 16:10:00'),
(43500447, 79549298, 'Opik', 'Bank Mandiri', '1234', '1.00', 'pending', '2024-11-13 14:58:22', '2024-11-13 14:58:22'),
(56088699, 79549298, 'ooieie', 'Sea Bank', '8938373', '0.00', 'completed', '2024-11-10 16:05:50', '2024-11-10 16:10:03'),
(56468108, 79549298, 'Opikz', 'Bank Mandiri', '123445737', '5.00', 'pending', '2024-11-13 14:57:52', '2024-11-13 14:57:52'),
(58558401, 79549298, 'Moli Yooooooooo', 'GoPay', '838276166', '156744.00', 'pending', '2024-11-10 16:10:40', '2024-11-10 16:10:40'),
(61243050, 7785975, 'Tofiq Nur Hidayat', 'BRI', '938474783763', '300000.00', 'completed', '2024-11-02 16:16:18', '2024-11-02 16:17:14'),
(98426982, 79995750, 'Opik', 'BCA', '1234567890', '100000.00', 'completed', '2024-11-04 15:33:07', '2024-11-04 19:02:46'),
(334426647, 7785975, 'Tofiq Nur Hidayat', 'Dana', '082328035237', '30000.00', 'completed', '2024-11-01 17:02:52', '2024-11-02 15:56:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crypto_coins`
--
ALTER TABLE `crypto_coins`
  ADD PRIMARY KEY (`coin_symbol`),
  ADD UNIQUE KEY `coin_symbol` (`coin_symbol`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `coin_symbol` (`coin_symbol`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89030018;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334426648;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`coin_symbol`) REFERENCES `crypto_coins` (`coin_symbol`);

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
