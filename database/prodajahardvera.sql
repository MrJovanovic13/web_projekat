-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: prodajahardvera.mysql.database.azure.com
-- Generation Time: Jun 20, 2022 at 01:14 AM
-- Server version: 8.0.28
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodajahardvera`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'All categories'),
(9, 'Graphics Cards'),
(10, 'SSD'),
(11, 'RAM'),
(24, 'Fan'),
(25, 'CPU');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` int NOT NULL,
  `additional info` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`order_id`, `product_id`, `amount`, `additional info`) VALUES
(38, 29, 1, NULL),
(38, 34, 1, NULL),
(38, 50, 1, NULL),
(39, 28, 1, NULL),
(40, 27, 1, NULL),
(41, 21, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `date_time` datetime NOT NULL,
  `message_content` text NOT NULL,
  `ticket_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `date_time`, `message_content`, `ticket_id`) VALUES
(44, 8, '2022-06-20 01:04:36', 'Please help me I am waiting for so long my product didn&#039;t arrive yet.', 20),
(45, 10, '2022-06-20 01:06:59', 'Your product is currently in transit, it should be delivered by tomorrow evening.', 20),
(46, 8, '2022-06-20 01:07:32', 'Thank you for the update, I am eagerly awaiting my order.', 20),
(47, 21, '2022-06-20 01:08:32', 'Hello, I can&#039;t wait to receive my GPU. Is there a possibility that I pay extra to get next day delivery?', 21),
(48, 5, '2022-06-20 01:09:02', 'I will contact our supplier and update you if anything can be done.', 21),
(49, 20, '2022-06-20 01:11:10', 'Hello, ram that I bought is not working. Can I return it?', 22),
(50, 5, '2022-06-20 01:11:51', 'Hello, please bring ram with the warranty to one of our nearest stores and we will continue the process there.', 22);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `date` date NOT NULL,
  `user_id` int NOT NULL,
  `additional_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `date`, `user_id`, `additional_info`) VALUES
(38, '2022-06-20', 8, NULL),
(39, '2022-06-20', 8, NULL),
(40, '2022-06-20', 21, NULL),
(41, '2022-06-20', 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `date` date NOT NULL,
  `time` time NOT NULL,
  `order_id` int NOT NULL,
  `status_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`date`, `time`, `order_id`, `status_id`) VALUES
('2022-06-20', '01:03:58', 38, 1),
('2022-06-20', '01:04:07', 39, 1),
('2022-06-20', '01:07:59', 40, 1),
('2022-06-20', '01:10:43', 41, 1),
('2022-06-20', '01:12:03', 41, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `price` float NOT NULL,
  `imgUrl` varchar(255) NOT NULL,
  `in_stock` tinyint(1) DEFAULT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `imgUrl`, `in_stock`, `category_id`) VALUES
(19, 'RX 5700 XT', 'Latest generation AMD graphics card.', 199, '5700xt.jpg', 1, 9),
(20, 'Samsung 970 EVO', 'Latest generation SAMSUNG nvme ssd drive.', 99, '970evo.jpg', 1, 10),
(21, 'HyperX Fury 8GB', 'Latest generation Kingston RAM stick with 8GB capacity.', 79, 'hyperx8gb.jpg', 1, 11),
(27, 'GTX 3080', 'Graphics card that delivers ultra performance.', 999, 'gtx3080.jpg', 1, 9),
(28, 'GTX 1660TI', 'Mid tier GPU able to run all modern titles.', 299, 'gtx1660ti.jpg', 1, 9),
(29, 'Corsair 2x16GB KIT', 'Corsair premium high speed RAM sticks.', 149, 'Corsair32GB.jpg', 1, 11),
(30, 'Kingston DDR4 32GB', '32GB Stick for Beast mode performance.', 229, 'fury32gb.jpg', 1, 9),
(31, 'Kingston 480GB RBG', 'Kingston&#039;s premium RGB high speed SSD.', 109, 'Kingston480GB.jpg', 1, 10),
(32, 'Riing 3x RGB Fan', 'Triple premium RGB fans for triple the fun.', 89, '3xfanrgb.jpg', 1, 24),
(33, 'RX 6800', 'Amd&#039;s (actual) latest gen GPU with high speed memory.', 999, 'RX6800.png', 1, 9),
(34, 'Intel Core i7 9700K', 'High performance 8 core CPU. The intel way.', 349, 'i7-9700K.png', 1, 25),
(35, 'GTX 3090', 'Nvidia&#039;s cream of the crop graphics card.', 2999, 'gtx3090.jpg', 1, 9),
(36, 'Ryzen 3600X', 'Ryzen 3rd generation CPU', 249, '3600x.png', 1, 25),
(37, 'Ryzen 5600x', 'Ryzen 5th generation CPU', 299, '5600x.jpg', 1, 25),
(38, 'Frio Extreme Silent 14', 'Thermaltake cooling solution for Extreme cases.', 99, 'extremeFan.jpg', 1, 24),
(39, 'Samsung 500GB ssd', 'Samsung&#039;s budget ssd solution', 89, '870evo.jpg', 1, 10),
(50, 'Intel code i7 7700k', 'Intel&#039;s 7th generation CPU.', 499, 'i7-7700k.png', 1, 25),
(51, 'XPG Spectrix 16GB', 'Adata 16GB Premium ram stick', 119, 'adata16gb.jpg', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Processing'),
(2, 'On hold'),
(3, 'Completed'),
(4, 'Sent'),
(5, 'Cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int NOT NULL,
  `name` varchar(127) NOT NULL,
  `user_sender` int NOT NULL,
  `is_open` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `name`, `user_sender`, `is_open`) VALUES
(20, 'Product not arriving', 8, 0),
(21, 'Faster shipping', 21, 1),
(22, 'Problem with RAM', 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(25) NOT NULL,
  `surname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `address` varchar(25) NOT NULL,
  `location` varchar(25) NOT NULL,
  `user_level` int NOT NULL,
  `postcode` varchar(14) NOT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `phone_number`, `address`, `location`, `user_level`, `postcode`, `dob`) VALUES
(5, 'Nikola', 'Jovanovic', 'mrjovanovic13@yahoo.com', 'MrJovanovic', '909d17bf59c7b2b6b67a5c3d21599a7d78cfa8b4', '0381586436', 'SCHLOSSSTRASSE 20', 'London', 2, '83115', '1994-12-12'),
(8, 'Marko', 'Markovic', 'regular@user.com', 'test66', 'aa81758539f79d43461525bf86691e0994b23ccd', '66666', 'test66', 'test66', 0, '666', '2009-06-01'),
(9, 'Luka', 'Lukic', 'manager@user.com', 'manager', 'aa81758539f79d43461525bf86691e0994b23ccd', '0381586436', 'SCHLOSSSTRASSE 20', 'London', 1, '83115', '2005-06-07'),
(10, 'Nebojsa', 'Lukic', 'admin@user.com', 'adminsam', 'aa81758539f79d43461525bf86691e0994b23ccd', '0381586436', 'SCHLOSSSTRASSE 20', 'asdasdsad', 2, '83115', '2006-06-07'),
(20, 'Milica', 'Mitic', 'mica@yahoo.com', 'milica', 'aa81758539f79d43461525bf86691e0994b23ccd', '6326234', 'kralja milana', 'Nis', 0, '18000', '1999-06-02'),
(21, 'Aleksandra', 'Stevic', 'aleksandra@gmail.com', 'Aleksandra', 'aa81758539f79d43461525bf86691e0994b23ccd', '6723634323', 'Cara dusana', 'Beograd', 0, '104104', '1999-06-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`time`,`order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_status`
--
ALTER TABLE `order_status`
  ADD CONSTRAINT `order_status_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_status_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
