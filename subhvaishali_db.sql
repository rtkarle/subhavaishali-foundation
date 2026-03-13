-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2025 at 08:04 AM
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
-- Database: `subhvaishali_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password_hash`, `created_at`) VALUES
(1, 'mayur_thoke', '$2y$10$45ioazGPvPPeGr3cjMMOleIbdQXBaI9HsiYO/MZwF.hEP/8g0HWC6', '2025-11-21 06:35:15');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `razorpay_order_id` varchar(100) DEFAULT NULL,
  `razorpay_payment_id` varchar(100) DEFAULT NULL,
  `razorpay_signature` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` enum('PENDING','SUCCESS','FAILED') DEFAULT 'PENDING',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `razorpay_order_id`, `razorpay_payment_id`, `razorpay_signature`, `name`, `email`, `phone`, `amount`, `status`, `created_at`) VALUES
(1, 'order_RiFQxuX5bWNEB2', 'pay_RiFRWBw2fKRPy3', 'd075461a15983917012963f0fab6e10ce7ed173ddeefc71c0e230a6b629486ca', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 10, 'SUCCESS', '2025-11-21 03:49:58'),
(2, 'order_RiHP1uRdOuQtle', 'pay_RiHPJlwhphvnYy', 'a667bf093f5e2a517deb9d164c8ef41224a457ed6c3a51e6290fd7094ea7a02f', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 1000, 'SUCCESS', '2025-11-21 05:45:31'),
(3, 'order_RiHSd2sraO1Ue0', 'pay_RiHSqWysFyz0eI', 'b9e32aca1a37b848098c1fc4855c0deaad2e5699ccaa07ccc188cd97c9b8b77b', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 1000, 'SUCCESS', '2025-11-21 05:48:55'),
(4, 'order_RiHYPqwnQxBTs8', 'pay_RiHYjiFApqRb5H', '66893b66650439c60539a1b67f8296967edfc2166daebf5130bcc9f02d002cf0', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 1000, 'SUCCESS', '2025-11-21 05:54:24'),
(5, 'order_RiHbyfS3Q22ElJ', 'pay_RiHc9hvO1d27Y0', 'ea94b8eaca7be5bd464cba74c77a02f8a520df057adff70484e31e1d3c8effcc', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 500, 'SUCCESS', '2025-11-21 05:57:46'),
(6, 'order_RiIOorEdohw7Bx', 'pay_RiIP4ZwP1hOljd', 'd00c0c5ea712524d017a126b781bb944460b575992fffc1b242eb372b9b65250', 'Renuka', 'rtkarle03@gmail.com', '7387830337', 250, 'SUCCESS', '2025-11-21 06:44:01'),
(7, 'order_RiIlxjdivZvTpA', 'pay_RiImD1LMjphPUa', '7ec5c7820c21a119272c5e964d1a339bfa6fb95b847f0052a6df12445b0be3d3', 'Mayur Thoke', 'rtkarle03@gmail.com', '7387830337', 1000, 'SUCCESS', '2025-11-21 07:05:55'),
(8, 'order_RiNqNTb7Ljhwaf', 'pay_RiNqeyd44VdlIE', '7a445116ea84243fcaa6e22b714dcf69ed19d9af2ff08aa743b471105ed39458', 'Renuka', 'rtkarle03@gmail.com', '7387830337', 250, 'SUCCESS', '2025-11-21 12:03:34'),
(9, 'order_RieD5tH6Srzs9V', 'pay_RieDRkCPg3zXKi', 'b7eb7441981c1204cb04ae597de8eecea1286ad8d755ce168cc22d31fdc1d4af', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'SUCCESS', '2025-11-22 04:04:10'),
(10, 'order_RieHy892hNj2Bq', NULL, NULL, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'PENDING', '2025-11-22 04:08:47'),
(11, 'order_RieI2RofSvW8D3', NULL, NULL, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'PENDING', '2025-11-22 04:08:51'),
(12, 'order_RieI2nvkyqJ8fn', NULL, NULL, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'PENDING', '2025-11-22 04:08:51'),
(13, 'order_RieI34nXwlEfsE', NULL, NULL, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'PENDING', '2025-11-22 04:08:51'),
(14, 'order_RieI38DGaSqeDK', NULL, NULL, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'PENDING', '2025-11-22 04:08:51'),
(15, 'order_RieI39HFhC9rn3', 'pay_RieIDSLee1WDN2', '6eb115f6feeaf688ac0b5d14e1d2b9fe4ed5ce5f5e3454aca966130ff114c5fd', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'SUCCESS', '2025-11-22 04:08:51'),
(16, 'order_RieREcwnGhuOVT', 'pay_RieReByb0eLg0C', '6c6f43d066ba6bbda2d126b8fdab5da5aab634be0702efdce9d516d164de969a', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 100, 'SUCCESS', '2025-11-22 04:17:33'),
(17, 'order_RiebFq7pzXlpHT', 'pay_RiebP2rwyxQRyx', '0dd250cfc94f8302ae00ac9b20a69d159fb7bd676ae9218cf4d05b01a83cf820', 'Mayur Thoke', 'rtkarle03@gmail.com', '7387830337', 100, 'SUCCESS', '2025-11-22 04:27:02'),
(18, 'order_RieelQy19G6DVK', 'pay_Rief1T6YRfTziD', 'bff09a7d34dd8372908eec22503f495ddad7cf64c8e144da045c07eeb6e9833c', 'Mayur Thoke', 'rtkarle03@gmail.com', '7387830337', 100, 'SUCCESS', '2025-11-22 04:30:22'),
(19, 'order_RienA7lGBeEYP8', 'pay_RienJsmpvNqKi9', 'eb0577bacdda6f91841362f57d5ee1eddc1ebeb49b68f8c7f672701f88e9f8ce', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 1000, 'SUCCESS', '2025-11-22 04:38:19'),
(20, 'order_RigrHNZJT15neC', 'pay_RigrSdtKana7T8', 'd47820f4acd268fe1a2dd89d0492a1be1a5ee80075769cba4db65c22caede3b2', 'Renuka', 'rtkarle03@gmail.com', '7387830337', 100, 'SUCCESS', '2025-11-22 06:39:36'),
(21, 'order_Rigy5YbvGOxh64', 'pay_RigyEoHMsVZ3Gm', '7dcdf30ab92f708a5d24d5406d66170302fefebd23cde48eb9d8e9a95a36c8a8', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 250, 'SUCCESS', '2025-11-22 06:46:03'),
(22, 'order_Rih32KXVnbFQGn', 'pay_Rih3ByD5v9OuM3', '3193a992eea5bd14bc037c5bd7938515c5e53dd2e9958043e46471df887de84b', 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', '7387830337', 250, 'SUCCESS', '2025-11-22 06:50:44');

-- --------------------------------------------------------

--
-- Table structure for table `donations_details`
--

CREATE TABLE `donations_details` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `screenshot` varchar(300) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `phone` varchar(20) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations_details`
--

INSERT INTO `donations_details` (`id`, `name`, `email`, `amount`, `screenshot`, `status`, `created_at`, `phone`, `payment_method`, `transaction_id`, `message`) VALUES
(1, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', 1, 'uploads/donation_1763799662_6210.png', 'APPROVED', '2025-11-22 08:21:02', NULL, NULL, NULL, NULL),
(2, 'Mayur Thoke', 'mthoke69@gmail.com', 100, 'uploads/donation_1763800464_7264.png', 'APPROVED', '2025-11-22 08:34:24', NULL, NULL, NULL, NULL),
(3, 'Mayur Thoke', 'mthoke69@gmail.com', 100, 'uploads/donation_1763800690_2312.png', 'PENDING', '2025-11-22 08:38:10', NULL, NULL, NULL, NULL),
(4, 'Renuka Tukaram Karle', 'rtkarle03@gmail.com', 100, 'uploads/donation_1763959354_2985.png', 'APPROVED', '2025-11-24 04:42:34', '7387830337', 'UPI', '73248892931', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `middleName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `aadhar` varchar(50) DEFAULT NULL,
  `profession` varchar(100) DEFAULT NULL,
  `collegeName` varchar(200) DEFAULT NULL,
  `adYear` varchar(10) DEFAULT NULL,
  `currentYear` varchar(20) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `tehsil` varchar(100) DEFAULT NULL,
  `ug` varchar(200) DEFAULT NULL,
  `home` varchar(150) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `post` varchar(150) DEFAULT NULL,
  `addrCountry` varchar(100) DEFAULT NULL,
  `addrState` varchar(100) DEFAULT NULL,
  `addrDistrict` varchar(100) DEFAULT NULL,
  `taluka` varchar(150) DEFAULT NULL,
  `panFile` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `middleName`, `lastName`, `email`, `password_hash`, `mobile`, `gender`, `dob`, `aadhar`, `profession`, `collegeName`, `adYear`, `currentYear`, `course`, `country`, `state`, `district`, `city`, `tehsil`, `ug`, `home`, `pincode`, `post`, `addrCountry`, `addrState`, `addrDistrict`, `taluka`, `panFile`, `google_id`, `created_at`) VALUES
(1, 'Renuka', NULL, 'Karle', 'rtkarle03@gmail.com', '$2y$10$i24hyRQ18P6rfCcv.m7hVuerm7abMEP81KjZxWV7.laerRxvsy.F.', '7387830337', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1763398921_Screenshot (195).png', NULL, '2025-11-17 17:02:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations_details`
--
ALTER TABLE `donations_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `donations_details`
--
ALTER TABLE `donations_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
