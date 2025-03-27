-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 03:57 AM
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
-- Database: `enrollmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo_url`, `created_at`) VALUES
(1, 'Nike', 'path_to_logo/nike_logo.png', '2025-03-26 17:14:54'),
(2, 'Adidas', 'path_to_logo/adidas_logo.png', '2025-03-26 17:14:54'),
(3, 'Puma', 'path_to_logo/puma_logo.png', '2025-03-26 17:14:54'),
(4, 'Skechers', 'path_to_logo/skechers_logo.png', '2025-03-26 17:14:54'),
(5, 'Deckers Brands', 'path_to_logo/deckers_logo.png', '2025-03-26 17:14:54'),
(6, 'VF Corporation', 'path_to_logo/vf_corp_logo.png', '2025-03-26 17:14:54'),
(7, 'Wolverine World Wide', 'path_to_logo/wolverine_logo.png', '2025-03-26 17:14:54'),
(8, 'Crocs', 'path_to_logo/crocs_logo.png', '2025-03-26 17:14:54'),
(9, 'ASICS Corporation', 'path_to_logo/asics_logo.png', '2025-03-26 17:14:54'),
(10, 'ABC-Mart', 'path_to_logo/abc_mart_logo.png', '2025-03-26 17:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(8, 2, 77, 1, '2025-03-26 22:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `quantity`, `status`, `order_date`) VALUES
(1, 2, 54, 2, 'Delivery', '2025-03-26 21:58:54'),
(2, 2, 55, 3, 'Pending', '2025-03-26 21:58:54'),
(3, 2, 76, 1, 'Pending', '2025-03-26 22:06:02'),
(4, 2, 77, 3, 'Pending', '2025-03-26 22:24:50'),
(5, 2, 54, 4, 'Pending', '2025-03-26 22:28:12'),
(6, 2, 83, 1, 'Pending', '2025-03-26 22:30:55'),
(7, 2, 52, 6, 'Pending', '2025-03-26 22:32:46'),
(9, 2, 52, 1, 'Pending', '2025-03-26 23:19:11'),
(10, 2, 55, 2, 'Pending', '2025-03-26 23:20:28'),
(11, 2, 54, 2, 'Pending', '2025-03-26 23:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `image` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_removed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `brand_id`, `image`, `created_at`, `updated_at`, `is_removed`) VALUES
(51, 'Nike Air Max 270', 'Nike Air Max 270 with lightweight and breathable design.', 7500.00, 50, 1, 'uploads/1.jpg', '2025-03-26 18:18:30', '2025-03-26 19:56:26', 1),
(52, 'Nike Air Force 1', 'Classic and stylish leather sneaker from Nike.', 6000.00, 100, 1, 'uploads/2.png', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(53, 'Nike ZoomX Vaporfly', 'High-performance running shoe designed for speed.', 12500.00, 30, 1, 'uploads/3.png', '2025-03-26 18:18:30', '2025-03-26 19:58:08', 1),
(54, 'Nike Free Run 5.0', 'Comfortable and flexible running shoes for everyday use.', 5500.00, 60, 1, 'uploads/4.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(55, 'Nike React Infinity Run', 'Cushioned running shoes to reduce injuries during runs.', 8000.00, 40, 1, 'uploads/5.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(56, 'Adidas UltraBoost', 'Comfortable running shoe with Boost cushioning technology.', 9000.00, 70, 2, 'uploads/6.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(57, 'Adidas NMD R1', 'Stylish sneaker with responsive cushioning for all-day wear.', 7000.00, 80, 2, 'uploads/7.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(58, 'Adidas Yeezy Boost 350', 'High-fashion sneaker designed by Kanye West.', 11000.00, 20, 2, 'uploads/8.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(59, 'Adidas Stan Smith', 'Classic tennis shoe with minimalist design.', 4500.00, 100, 2, 'uploads/9.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(60, 'Adidas Gazelle', 'Iconic low-top sneaker with soft suede material.', 5000.00, 50, 2, 'uploads/10.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(61, 'Puma Suede Classic', 'Suede classic shoes for stylish everyday wear.', 4500.00, 60, 3, 'uploads/11.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(62, 'Puma RS-X', 'Bold design with enhanced comfort and cushioning for runners.', 5500.00, 75, 3, 'uploads/12.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(63, 'Puma Clyde', 'Signature basketball sneaker worn by Walt Frazier.', 4800.00, 40, 3, 'uploads/13.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(64, 'Puma Future Rider', 'Retro-inspired running shoe with modern features.', 5000.00, 65, 3, 'uploads/14.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(65, 'Puma Cali', 'Casual lifestyle sneaker with sleek, trendy design.', 4800.00, 50, 3, 'uploads/15.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(66, 'Skechers D’Lites', 'Casual and comfortable shoes for everyday wear.', 3500.00, 80, 4, 'uploads/16.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(67, 'Skechers Go Walk 5', 'Lightweight and cushioned walking shoes.', 4200.00, 60, 4, 'uploads/17.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(68, 'Skechers Max Cushioning', 'High-performance shoes with maximum cushioning for running.', 5000.00, 55, 4, 'uploads/18.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(69, 'Skechers Energy', 'Classic slip-on sneakers for comfort and support.', 3750.00, 90, 4, 'uploads/19.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(70, 'Skechers On-the-Go', 'Comfortable sandals for a relaxed fit and feel.', 2700.00, 50, 4, 'uploads/20.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(71, 'Hoka One One Bondi 7', 'Running shoes with exceptional cushioning and comfort.', 9000.00, 45, 5, 'uploads/21.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(72, 'Teva Hurricane XLT2', 'Durable sandals for outdoor activities and hiking.', 3800.00, 60, 5, 'uploads/22.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(73, 'UGG Classic Short', 'Classic winter boots made with soft sheepskin.', 7500.00, 30, 5, 'uploads/23.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(74, 'Sanuk Yoga Sling', 'Comfortable sandals designed for ultimate relaxation.', 2300.00, 100, 5, 'uploads/24.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(75, 'Keen Newport H2', 'Outdoor sandals designed for water activities.', 4500.00, 50, 5, 'uploads/25.jpg', '2025-03-26 18:18:30', '2025-03-26 18:18:30', 0),
(76, 'as', 'sdfsf', 500.00, 67, 1, '7.jpg', '2025-03-26 18:56:56', '2025-03-26 18:56:56', 0),
(77, 'Nike Blazer Mid \'77', 'A vintage-inspired high-top sneaker with suede details and a timeless basketball design.', 8000.00, 50, 1, '27.jpg', '2025-03-26 19:01:41', '2025-03-26 19:01:41', 0),
(78, 'Nike Blazer Mid \'77', 'A vintage-inspired high-top sneaker with suede details and a timeless basketball design.', 8000.00, 50, 1, '27.jpg', '2025-03-26 19:04:35', '2025-03-26 19:04:35', 0),
(79, 'asdsaf', 'edgdg', 50.00, 45, 1, '15.jpg', '2025-03-26 19:07:19', '2025-03-26 19:07:19', 0),
(80, 'asdsaf', 'edgdg', 50.00, 45, 1, '15.jpg', '2025-03-26 19:07:52', '2025-03-26 19:07:52', 0),
(81, 'asdsaf', 'edgdg', 50.00, 45, 1, '15.jpg', '2025-03-26 19:10:27', '2025-03-26 19:10:27', 0),
(82, 'sdsdf', 'dfssd', 500.00, 4, 1, '16.jpg', '2025-03-26 19:10:41', '2025-03-26 19:10:41', 0),
(83, 'asdas', 'dsf', 500.00, 534, 1, '10.jpg', '2025-03-26 20:10:39', '2025-03-26 20:10:39', 0),
(84, 'asdas', 'dsf', 500.00, 534, 1, '10.jpg', '2025-03-26 20:12:51', '2025-03-26 20:12:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `birthday` date NOT NULL,
  `verification` int(11) NOT NULL DEFAULT 0,
  `profilePicture` longblob DEFAULT NULL,
  `role` varchar(50) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `firstName`, `lastName`, `email`, `password`, `phoneNumber`, `gender`, `birthday`, `verification`, `profilePicture`, `role`, `createdAt`) VALUES
(1, 'dwdadade', 'cdv', 'admin@gmail.com', 'yawaka', '1234', 'Female', '2025-02-05', 0, NULL, 'admin', '2025-02-24 15:03:48'),
(2, 'jade', 'muz', 'jedjed@gmail.com', 'yawaka', '12345', 'Female', '2025-02-14', 0, NULL, 'user', '2025-02-24 15:20:08'),
(3, 'jade', 'munez', 'hala@gmail.com', 'yawakayawaka', '738492', 'Female', '2025-03-10', 0, NULL, 'user', '2025-03-06 15:53:27'),
(4, 'jade', 'munez', 'jadejade@gmail.com', 'yawaka', '24234', 'Female', '2025-04-03', 0, NULL, 'user', '2025-03-26 15:07:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`userId`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
