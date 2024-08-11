-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2024 at 04:17 PM
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
-- Database: `lovelee`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `pname` varchar(100) NOT NULL,
  `pcolour` varchar(20) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `product_id`, `pname`, `pcolour`, `price`, `quantity`, `image`) VALUES
(10, 'P009', 'Sunshine Love', 'yellow', 100, 1, 'img/F9_Sunshine Love.png'),
(11, 'P019', 'Summer Basket', 'pink', 100, 1, 'img/F19_Summer Basket.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telephone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `method` varchar(50) NOT NULL,
  `choices` varchar(20) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `pcolour` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `name`, `telephone`, `email`, `address`, `method`, `choices`, `pname`, `pcolour`, `quantity`, `price`, `image`) VALUES
(1, 'lee cy', '123', 'chiayinlee03@gmail.com', 'nilai florist street', '', 'Shipping', 'Latte', 'blue', 1, 238, 'img/F11_Latte.png'),
(2, 'Kong Owen', '123', 'doubii03@gmail.com', 'nilai florist street', '', 'Shipping', 'Latte', 'blue', 1, 238, 'img/F11_Latte.png'),
(3, 'Kong cy', '123', 'chiayinlee03@gmail.com', 'gemas', '', 'Shipping', 'Sunshine Love', 'yellow', 1, 100, 'img/F9_Sunshine Love.png'),
(3, 'Kong cy', '123', 'chiayinlee03@gmail.com', 'gemas', '', 'Shipping', 'Summer Basket', 'pink', 1, 100, 'img/F19_Summer Basket.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `price`, `category`, `image`) VALUES
('P001', 'Grand Love', 138, 'LoveRomance', 'img/F1_Grand Love.png'),
('P002', 'Mystique', 295, 'Graduation', 'img/F2_Mystique.png'),
('P003', 'Joyful Baby', 150, 'Birthday', 'img/F3_Joyful Baby.png'),
('P004', 'The Kate', 150, 'Birthday', 'img/F4_The Kate.png'),
('P005', 'More Than One Thousand', 160, 'LoveRomance', 'img/F5_More than one thousand.png'),
('P006', 'Lovely Bundle', 184, 'Birthday', 'img/F6_Lovely Bundle.png'),
('P007', 'Best Wishes', 168, 'Birthday', 'img/F7_Best Wishes.png'),
('P008', 'Da Vincci', 138, 'LoveRomance', 'img/F8_Da Vincci.png'),
('P009', 'Sunshine Love', 100, 'Graduation', 'img/F9_Sunshine Love.png'),
('P010', 'Eternal Love', 450, 'LoveRomance', 'img/F10_Eternal Love.png'),
('P011', 'Latte', 238, 'Birthday', 'img/F11_Latte.png'),
('P012', 'Destiny Touch', 130, 'LoveRomance', 'img/F12_Destiny Touch.png'),
('P013', 'Love with Bunny', 140, 'Birthday', 'img/F13_Love With Bunny.png'),
('P014', 'Zara', 128, 'LoveRomance', 'img/F14_Zara.png'),
('P015', 'Healing Harmony', 128, 'CareSupport', 'img/F15_Healing Harmony.png'),
('P016', 'Peace In White', 288, 'CareSupport', 'img/F16_Peace In White.png'),
('P017', 'Modern Visit', 190, 'CareSupport', 'img/F17_Modern Visit.png'),
('P018', 'Desire', 120, 'CareSupport', 'img/F18_Desire.png'),
('P019', 'Summer Basket', 100, 'CareSupport', 'img/F19_Summer Basket.png'),
('P020', 'A New Day', 250, 'CareSupport', 'img/F20_A New Day.png'),
('P021', 'LED Light', 12, 'AddOn', 'img/F21_LED Light.png'),
('P022', 'Ferrero Roche', 24, 'AddOn', 'img/F22_Ferror Roche.png'),
('P023', 'American Brown Bear', 35, 'AddOn', 'img/F23_American Brown Bear.png'),
('P024', 'Helium Balloon', 70, 'AddOn', 'img/F24_Helium Ballon.png'),
('P025', 'Big Dino', 115, 'AddOn', 'img/F25_Big Dino.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `telephone` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `name`, `telephone`, `email`, `address`, `password`) VALUES
(1, 'chiayin', '0177136533', 'chiayinlee03@gmail.com', 'jalan ria 6,taman gembira', 'abc123'),
(2, 'moi', '0123456789', 'i21020661@student.newinti.edu.my', 'gemas', 'abc123'),
(3, 'Owen', '0172340223', 'owen03@gmail.com', 'johor bahru', 'abc123'),
(4, 'doubii', '0129448336', 'doubii03@gmail.com', 'gemas', 'abc123'),
(5, 'admin', '079481992', 'lovelee@gmail.com', 'nilai florist street', 'admin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
