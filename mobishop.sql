-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 03:15 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobishop`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminnavlinks`
--

CREATE TABLE `adminnavlinks` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adminnavlinks`
--

INSERT INTO `adminnavlinks` (`id`, `name`, `href`) VALUES
(1, 'Users', 'print-users.php'),
(2, 'Devices', 'print-devices.php'),
(5, 'Brands', 'print-brands.php'),
(6, 'Operating systems', 'print-operating-systems.php'),
(7, 'Orders', 'print-orders.php'),
(8, 'Messages', 'print-messages.php');

-- --------------------------------------------------------

--
-- Table structure for table `authorsocials`
--

CREATE TABLE `authorsocials` (
  `id` int(11) NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authorsocials`
--

INSERT INTO `authorsocials` (`id`, `icon`, `href`, `color`) VALUES
(1, 'fab fa-facebook', 'https://www.facebook.com/bojan.maksimovic.908', '#3d6eff'),
(2, 'fab fa-instagram', 'https://www.instagram.com/bojanm___/', '#ff24f8'),
(3, 'fab fa-twitter', 'https://twitter.com/bojanm_', '#17e4ff');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'Apple'),
(2, 'Honor'),
(3, 'Huawei'),
(4, 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `contactmessages`
--

CREATE TABLE `contactmessages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contactmessages`
--

INSERT INTO `contactmessages` (`message_id`, `user_id`, `email`, `name`, `message`, `date`) VALUES
(1, NULL, 'bojan@gmail.com', 'Bojan', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2021-03-02 11:52:59'),
(2, 4, 'bojan77@gmail.com', 'Bojan Maksimović', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', '2021-03-02 11:52:59'),
(6, 15, 'bojan@gmail.com', 'Bojan Maksimović', 'cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc', '2021-03-03 21:17:37'),
(8, NULL, 'examplename@example.com', 'Dsadsad', 'Dsdadsaddsadasdasdasd', '2021-04-04 12:50:04');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `device_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `os` int(11) DEFAULT NULL,
  `brand` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`device_id`, `name`, `image`, `os`, `brand`, `price`, `active`) VALUES
(1, 'APPLE iPhone XS 512GB Silver MT9M2SE/A', 'iPhone_XS_512GB_Silver.png', 2, 1, 1500, 1),
(2, 'HONOR 10 64GB Phantom Green 7800429', 'HONOR_10_64GB_Phantom_Green.png', 1, 2, 350, 1),
(3, 'APPLE iPhone 11 Pro Max 256GB Space gray', 'iPhone_11_Pro_Max_256GB_Space_gray.png', 2, 1, 1600, 1),
(4, 'HUAWEI P30 Lite 256GB Breathing Crystal', 'HUAWEI_P30_Lite_256GB_Breathing_Crystal.png', 1, 3, 350, 1),
(5, 'APPLE iPhone 12 64GB Blue', 'iPhone_12_64GB_Blue.png', 2, 1, 1100, 1),
(6, 'HUAWEI Y5p 32GB Midnight Black', 'HUAWEI_Y5p_32GB_Midnight_black.png', 1, 3, 110, 1),
(7, 'HONOR 8A 32GB Black 51093WGU', 'HONOR_8A_32GB_Black.png', 1, 2, 140, 1),
(8, 'SAMSUNG GALAXY Z FLIP 256GB Mirror Black SM-F700FZ', 'SAMSUNG_GALAXY_Z_FLIP_256GB_Mirror_black.png', 1, 4, 1200, 1),
(9, 'SAMSUNG GALAXY A20s 32GB Blue SM-A207FZBDEUF', 'SAMSUNG_GALAXY_A20s_32GB_Blue.png', 1, 4, 200, 1),
(10, 'APPLE iPhone 11 Pro Max 64GB Green MWHH2SE/A', 'iPhone_11_Pro_Max_64GB_Green.png', 2, 1, 1350, 1),
(11, 'HONOR 9A 64GB Black', 'HONOR_9A_64GB_Black.png', 1, 2, 170, 1),
(12, 'HONOR 20 128GB Midnight black 51093VCM', 'HONOR_20_128GB_Midnight_black.png', 1, 2, 400, 1),
(13, 'HUAWEI Y6p 64GB Emerald Green', 'HUAWEI_Y6p_64GB_Emerald_Green.png', 1, 3, 190, 1),
(14, 'HUAWEI P40 Pro 256GB Black', 'HUAWEI_P40_Pro_256GB_Black.png', 1, 3, 1200, 1),
(15, 'SAMSUNG GALAXY A20e 32GB DS Orange SM-A202FZODSEE', 'SAMSUNG_GALAXY_A20e_32GB_DS_Orange.png', 1, 4, 410, 1),
(16, 'SAMSUNG GALAXY A21s 32GB Blue SM-A217FZBNEUF', 'SAMSUNG_GALAXY_A21s_32GB_Blue.png', 1, 4, 200, 1),
(17, 'APPLE iPhone SE 128GB Red', 'iPhone_SE_128GB_Red.png', 2, 1, 650, 1),
(18, 'APPLE iPhone 11 Pro Max 256GB Gold', 'iPhone_11_Pro_Max_256GB_Gold.png', 2, 1, 1600, 1),
(19, 'HUAWEI P30 Lite 256GB Midnight Black', 'HUAWEI_P30_Lite_256GB_Midnight_Black.png', 1, 3, 350, 1),
(20, 'SAMSUNG GALAXY S20 Ultra Cloud White', 'SAMSUNG_GALAXY_S20_Ultra_Cloud_White.png', 1, 4, 1400, 1),
(21, 'HUAWEI P Smart (2021) 128GB Blush Gold', 'HUAWEI_P_Smart_(2021)_128GB_Blush_gold.png', 1, 3, 240, 1),
(22, 'HONOR 7S 16GB Black 51094ABU', 'HONOR_7S_16GB_Black.png', 1, 2, 90, 1),
(23, 'SAMSUNG GALAXY NOTE 20 Mystic Grey SM-N980FZAGEUF', 'SAMSUNG_GALAXY_NOTE_20_Mystic_Grey.png', 1, 4, 1100, 1),
(24, 'HONOR 9S 32GB Black', 'HONOR_9S_32GB_Black.png', 1, 2, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `operatingsystems`
--

CREATE TABLE `operatingsystems` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `operatingsystems`
--

INSERT INTO `operatingsystems` (`id`, `name`) VALUES
(1, 'Android'),
(2, 'iOS');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL DEFAULT 0,
  `device_price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `device_id`, `device_price`, `quantity`) VALUES
(3, 2, 350, 5),
(3, 3, 1600, 1),
(3, 4, 350, 2),
(4, 15, 410, 2),
(4, 17, 650, 1),
(5, 7, 140, 3),
(5, 11, 170, 1),
(5, 12, 400, 1),
(6, 2, 350, 1),
(6, 3, 1600, 1),
(6, 5, 1100, 1),
(7, 4, 350, 1),
(7, 6, 110, 2),
(8, 5, 1100, 1),
(13, 4, 350, 2),
(13, 6, 110, 1),
(14, 1, 1500, 1),
(14, 3, 1600, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `buyer_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `buyer_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total_price` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `buyer_name`, `buyer_email`, `buyer_address`, `total_price`, `date`) VALUES
(3, 15, 'Bojan Maksimović', 'bojan@gmail.com', 'Cingrijina 13', 4050, '2021-02-26 23:00:00'),
(4, 15, 'Bojan Maksimović', 'bojan@gmail.com', 'Cingrijina 13', 1470, '2021-02-26 23:00:00'),
(5, 2, 'Bojan Maksimović', 'bojan@gmail.com', 'Ljubljanska 11', 990, '2021-02-27 23:00:00'),
(6, 15, 'Bojan Maksimovic', 'bojan@gmail.com', 'Ljubljanska 11', 3050, '2021-02-27 23:00:00'),
(7, 15, 'Bojan Maksimović', 'bojan@gmail.com', 'Cingrijina 13', 570, '2021-02-27 23:00:00'),
(8, 2, 'Bojan Maksimović', 'bojan@gmail.com', 'Cingrijina 13', 1100, '2021-02-28 23:00:00'),
(13, NULL, 'Bojan Maksimović', 'bojan1234@gmail.com', 'Cingrijina 13', 810, '2021-03-03 11:07:38'),
(14, NULL, 'Bojan Maksimović', 'bojan1234@gmail.com', 'Cingrijina 13', 3100, '2021-03-03 16:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `pagelinks`
--

CREATE TABLE `pagelinks` (
  `page_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pagelinks`
--

INSERT INTO `pagelinks` (`page_id`, `name`, `href`) VALUES
(1, 'Home', 'index.php'),
(2, 'Devices', 'devices.php'),
(3, 'Contact', 'contact.php'),
(4, 'Author', 'author.php');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'regular'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `sliderimages`
--

CREATE TABLE `sliderimages` (
  `image_id` int(11) NOT NULL,
  `image` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sliderimages`
--

INSERT INTO `sliderimages` (`image_id`, `image`) VALUES
(1, 'slide1'),
(2, 'slide2'),
(3, 'slide3');

-- --------------------------------------------------------

--
-- Table structure for table `sociallinks`
--

CREATE TABLE `sociallinks` (
  `social_id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `href` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sociallinks`
--

INSERT INTO `sociallinks` (`social_id`, `name`, `icon`, `href`) VALUES
(1, 'Facebook', 'fab fa-facebook', 'https://www.facebook.com/bojan.maksimovic.908'),
(2, 'Instagram', 'fab fa-instagram', 'https://www.instagram.com/bojanm___/'),
(3, 'Twitter', 'fab fa-twitter', 'https://twitter.com/bojanm_'),
(4, 'Documentation', 'fas fa-file', 'assets/documentation/documentation.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `user_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`user_id`, `answer`) VALUES
(2, 4),
(4, 3),
(5, 1),
(6, 5),
(10, 5),
(11, 4),
(13, 2),
(15, 5),
(38, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `active`) VALUES
(2, 'bojan55', 'bojan@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(3, 'bojan66', 'bojan66@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 0),
(4, 'bojan77', 'bojan77@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(5, 'bojan88', 'bojan88@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(6, 'bojan99', 'bojan99@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(7, 'bojan11', 'bojan11@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(8, 'bojan22', 'bojan22@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(9, 'bojan33', 'bojan33@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(10, 'bojan111', 'bojan111@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(11, 'bojan222', 'bojan222@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(12, 'bojan333', 'bojan333@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(13, 'bojan444', 'bojan444@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(15, 'admin', 'admin@gmail.com', '61cc0e405f4b518d264c089ac8b642ef', 2, 1),
(27, 'bojan44', 'bojan44@gmail.com', '180c89c9d53ed6cfdfd1da1ef88893f0', 1, 1),
(38, 'korisnik123', 'korisnik123@gmail.com', 'da349d45d3359d9b3b3d6a97c53f4928', 1, 1),
(39, 'petar', 'petar@gmail.com', 'ba850ed8d86b2cd722dab2ab88778e06', 1, 1),
(40, 'Persida', 'persida@gmail.com', '126f130148835ebd665308b60904b324', 1, 1),
(41, 'test_', 'luka.lukic@ict.edu.rs', '4f1b975ec7c35c20e901e8a1064a8980', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminnavlinks`
--
ALTER TABLE `adminnavlinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorsocials`
--
ALTER TABLE `authorsocials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `contactmessages`
--
ALTER TABLE `contactmessages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `os` (`os`),
  ADD KEY `brand` (`brand`);

--
-- Indexes for table `operatingsystems`
--
ALTER TABLE `operatingsystems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`order_id`,`device_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pagelinks`
--
ALTER TABLE `pagelinks`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliderimages`
--
ALTER TABLE `sliderimages`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `sociallinks`
--
ALTER TABLE `sociallinks`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminnavlinks`
--
ALTER TABLE `adminnavlinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `authorsocials`
--
ALTER TABLE `authorsocials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contactmessages`
--
ALTER TABLE `contactmessages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `operatingsystems`
--
ALTER TABLE `operatingsystems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pagelinks`
--
ALTER TABLE `pagelinks`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sliderimages`
--
ALTER TABLE `sliderimages`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sociallinks`
--
ALTER TABLE `sociallinks`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
