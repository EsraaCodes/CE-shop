-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2024 at 01:51 PM
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
-- Database: `ce`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Women', 'Elegant apparel '),
(2, 'Men', 'Timeless fashion '),
(3, 'Bags', 'Luxury bags '),
(4, 'Beauty', 'Luxurious beauty '),
(5, 'Home Decor', 'Elegant touches ');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price_at_order` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `quantity`, `price_at_order`) VALUES
(19, 26, 1, 59.99),
(20, 26, 1, 59.99),
(35, 26, 1, 59.99);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `total_price`) VALUES
(20, 19, 1, 59.99),
(21, 20, 1, 59.99),
(22, 35, 27, 59.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `subcategory` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `SizesAvailable` varchar(50) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `subcategory`, `price`, `image`, `SizesAvailable`, `stock_quantity`, `category_id`) VALUES
(1, 'Dress 1', 'Dresses', 59.99, 'dress1.jpg', 'S, M, L, XL', 0, 1),
(2, 'Dress 2', 'Dresses', 79.99, 'dress2.jpg', 'S, M, L, XL', 41, 1),
(3, 'Dress 3', 'Dresses', 49.99, 'dress3.jpg', 'S, M, L, XL', 0, 1),
(4, 'Dress 4', 'Dresses', 59.99, 'dress4.jpg', 'S, M, L, XL', 55, 1),
(5, 'Dress 5', 'Dresses', 70.00, 'dress5.jpg', 'S, M, L, XL', 39, 1),
(6, 'Dress 6', 'Dresses', 50.00, 'dress6.jpg', 'S, M, L, XL', 35, 1),
(7, 'Hoodie 1', 'Hoodies', 30.00, 'hoodie1.jpg', 'S, M, L, XL', 69, 1),
(8, 'Hoodie 2', 'Hoodies', 28.90, 'hoodie2.jpg', 'S, M, L, XL', 65, 1),
(9, 'Hoodie 3', 'Hoodies', 33.00, 'hoodie3.jpg', 'S, M, L, XL', 60, 1),
(10, 'Sweater 1', 'Sweaters', 26.90, 's1.jpg', 'S, M, L, XL', 55, 1),
(11, 'Sweater 2', 'Sweaters', 28.90, 's2.jpg', 'S, M, L, XL', 50, 1),
(12, 'Sweater 3', 'Sweaters', 25.00, 's3.jpg', 'S, M, L, XL', 45, 1),
(13, 'Pant 1', 'Pants', 44.00, 'pant1.jpg', 'S, M, L, XL', 65, 1),
(14, 'Pant 2', 'Pants', 40.50, 'pant2.jpg', 'S, M, L, XL', 59, 1),
(15, 'Pant 3', 'Pants', 39.99, 'pant3.jpg', 'S, M, L, XL', 79, 1),
(16, 'Pant 4', 'Pants', 34.80, 'pant4.jpg', 'S, M, L, XL', 50, 1),
(17, 'Pant 5', 'Pants', 30.45, 'pant5.jpg', 'S, M, L, XL', 45, 1),
(18, 'Pant 6', 'Pants', 29.33, 'pant6.jpg', 'S, M, L, XL', 40, 1),
(19, 'Skirt 1', 'Skirts', 40.00, 'skirt1.jpg', 'S, M, L, XL', 60, 1),
(20, 'Skirt 2', 'Skirts', 38.99, 'skirt2.jpg', 'S, M, L, XL', 55, 1),
(21, 'Skirt 3', 'Skirts', 49.99, 'skirt3.jpg', 'S, M, L, XL', 50, 1),
(22, 'Skirt 4', 'Skirts', 29.00, 'skirt4.jpg', 'S, M, L, XL', 45, 1),
(23, 'Skirt 5', 'Skirts', 35.99, 'skirt5.jpg', 'S, M, L, XL', 39, 1),
(24, 'Skirt 6', 'Skirts', 42.50, 'skirt6.jpg', 'S, M, L, XL', 45, 1),
(25, 'Shirt 1', 'Shirt', 39.99, 'shirt1.jpg', 'S,M,L,XL', 100, 2),
(26, 'Shirt 2', 'Shirt', 49.99, 'shirt2.jpg', 'S,M,L,XL', 0, 2),
(27, 'Shirt 3', 'Shirt', 59.99, 'shirt3.jpg', 'S,M,L,XL', 119, 2),
(28, 'Shirt 4', 'Shirt', 59.99, 'shirt4.jpg', 'S,M,L,XL', 90, 2),
(29, 'Shirt 5', 'Shirt', 59.99, 'shirt5.jpg', 'S,M,L,XL', 80, 2),
(30, 'Shirt 6', 'Shirt', 59.99, 'shirt6.jpg', 'S,M,L,XL', 110, 2),
(31, 'Pants 1', 'Pants', 59.99, 'bottom1.jpg', 'S,M,L,XL', 120, 2),
(32, 'Pants 2', 'Pants', 65.99, 'bottom2.jpg', 'S,M,L,XL', 130, 2),
(33, 'Pants 3', 'Pants', 65.99, 'bottom3.jpg', 'S,M,L,XL', 140, 2),
(34, 'Pants 4', 'Pants', 65.99, 'bottom4.jpg', 'S,M,L,XL', 100, 2),
(35, 'Pants 5', 'Pants', 65.99, 'bottom5.jpg', 'S,M,L,XL', 90, 2),
(36, 'Pants 6', 'Pants', 65.99, 'bottom6.jpg', 'S,M,L,XL', 110, 2),
(37, 'Sportswear 1', 'Sportswear', 75.99, 'sports1.jpg', 'S,M,L,XL', 100, 2),
(38, 'Sportswear 2', 'Sportswear', 80.99, 'sports2.jpg', 'S,M,L,XL', 120, 2),
(39, 'Sportswear 3', 'Sportswear', 85.99, 'sports3.jpg', 'S,M,L,XL', 110, 2),
(40, 'Sportswear 4', 'Sportswear', 90.99, 'sports4.jpg', 'S,M,L,XL', 90, 2),
(41, 'Sportswear 5', 'Sportswear', 125.99, 'sports5.jpg', 'S,M,L,XL', 79, 2),
(42, 'Sportswear 6', 'Sportswear', 135.99, 'sports6.jpg', 'S,M,L,XL', 70, 2),
(43, 'Our Birkin Bag', 'Luxury', 300.00, 'bag1.png', 'One Size', 100, 3),
(44, 'Chanel Classic Flap Bag', 'Luxury', 200.00, 'bag2.png', 'One Size', 150, 3),
(45, 'Christian Dior Tote Bag', 'Luxury', 110.00, 'bag3.png', 'One Size', 119, 3),
(46, 'Bottega Bag', 'Luxury', 85.00, 'bag4.png', 'One Size', 197, 3),
(47, 'Jacquemus Bags', 'Luxury', 95.00, 'bag5.png', 'One Size', 129, 3),
(48, 'Dior Saddle Bag', 'Luxury', 70.00, 'bag6.png', 'One Size', 90, 3),
(49, 'Marc Jacobs The Tote Bag', 'Luxury', 150.00, 'bag7.png', 'One Size', 160, 3),
(50, 'Celine Cabas Tote Bag', 'Luxury', 450.00, 'bag8.png', 'One Size', 80, 3),
(51, 'Refreshing Face Mask', 'Skincare', 25.70, 'face-mask.jpg', 'One Size', 98, 4),
(52, 'Face Serum Package', 'Skincare', 35.25, 'serum-package.jpg', 'One Size', 118, 4),
(53, 'Moisturizer', 'Skincare', 29.99, 'moistrurizer.jpg', 'One Size', 150, 4),
(54, 'Face Repair Cream', 'Skincare', 29.99, 'Repair-cream.jpg', 'One Size', 110, 4),
(55, 'Face Wash Package', 'Skincare', 29.99, 'face-wash.jpg', 'One Size', 200, 4),
(56, 'Vitamin C Serum', 'Skincare', 39.99, 'vitamineC-serum.jpg', 'One Size', 130, 4),
(57, 'Face Powder', 'Makeup - Face', 24.99, 'facepowder.jpg', 'One Size', 180, 4),
(58, 'Blush', 'Makeup - Face', 24.99, 'blush.jpg', 'One Size', 149, 4),
(59, 'Foundation', 'Makeup - Face', 27.57, 'foundation.jpg', 'One Size', 170, 4),
(60, 'YSL Mascara', 'Makeup - Eyes', 18.99, 'mascara.jpg', 'One Size', 140, 4),
(61, 'Eyeshadow Palette', 'Makeup - Eyes', 22.50, 'eyeshadow.jpg', 'One Size', 160, 4),
(62, 'Eyeliner', 'Makeup - Eyes', 12.00, 'eyeliner.jpg', 'One Size', 200, 4),
(63, 'Chanel Nude Lipstick', 'Makeup - Lips', 18.00, 'lipstick.jpg', 'One Size', 180, 4),
(64, 'Lip Gloss', 'Makeup - Lips', 15.80, 'lipgloss.jpg', 'One Size', 190, 4),
(65, 'Lipliner Set', 'Makeup - Lips', 14.50, 'lipliner.jpg', 'One Size', 200, 4),
(66, 'Flower String Light', 'Lighting & LED', 9.99, 'flowerlight.jpg', 'One Size', 100, 5),
(67, 'Dynamic Water Ripple Lamp', 'Lighting & LED', 14.90, 'waterlamp.jpg', 'One Size', 49, 5),
(68, 'String Led Lights', 'Lighting & LED', 12.30, 'led.jpg', 'One Size', 75, 5),
(69, 'Colorful Candles', 'Bedroom Accessories', 14.35, 'candles.jpg', 'One Size', 200, 5),
(70, 'Crystal Planet Ball', 'Bedroom Accessories', 6.50, 'planetball.jpg', 'One Size', 150, 5),
(71, 'String Led Lights', 'Bedroom Accessories', 11.99, 'tulipcubes.jpg', 'One Size', 120, 5),
(72, 'Calm and Harmonic Prints', 'Wall Art', 18.99, 'beigeposters.jpg', 'One Size', 80, 5),
(73, 'Random Arts', 'Wall Art', 17.50, 'randomarts.jpg', 'One Size', 60, 5),
(74, 'Pink Posters Set', 'Wall Art', 18.33, 'pinkposters.jpg', 'One Size', 90, 5),
(75, 'Lunch Box Set', 'Storage & Organization', 25.65, 'lunchbox.jpg', 'One Size', 100, 5),
(76, 'Storage Jars', 'Storage & Organization', 12.99, 'storagejar.jpg', 'One Size', 200, 5),
(77, 'Round Vegetable Organizer', 'Storage & Organization', 17.49, 'vegorganizer.jpg', 'One Size', 150, 5),
(78, '3-Pieces Set', 'Kitchen Accessories', 15.75, 'set.jpg', 'One Size', 180, 5),
(79, '10 Spoon Pieces', 'Kitchen Accessories', 10.35, 'spoons.jpg', 'One Size', 119, 5),
(80, 'Toast Plate', 'Kitchen Accessories', 2.33, 'toastplate.jpg', 'One Size', 250, 5);

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `sale_percentage` int(11) DEFAULT NULL,
  `sale_type` varchar(50) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_items`
--

INSERT INTO `sale_items` (`product_id`, `product_name`, `original_price`, `sale_price`, `sale_percentage`, `sale_type`, `image_url`, `size`) VALUES
(1, 'TheNorthFace Jacket', 80.00, 40.00, 50, '50% Off', 'images/50sale1.jpg', NULL),
(2, 'Elegant White Dress', 300.00, 150.00, 50, '50% Off', 'images/50sale2.jpg', NULL),
(3, 'Saint Laurent Shoulder Bag', 280.00, 140.00, 50, '50% Off', 'images/50sale4.jpg', NULL),
(4, 'Full-Package Skin Treatment', 60.00, 30.00, 50, '50% Off', 'images/50sale3.jpg', NULL),
(5, 'Oversized Trenchcoat', 100.00, 70.00, 30, '30% Off', 'images/30sale1.jpg', NULL),
(6, 'Sky High Mascara', 20.00, 17.00, 30, '30% Off', 'images/30sale2.jpg', NULL),
(7, 'Flutter Lights', 14.00, 10.00, 30, '30% Off', 'images/30sale3.jpg', NULL),
(8, 'Lightweight Small Bag', NULL, 20.00, NULL, 'Buy 1 Get 1 Free', 'images/get1freesale1.jpg', NULL),
(9, 'Cozy Hoodie', NULL, 60.00, NULL, 'Buy 1 Get 1 Free', 'images/bogo3.jpg', 'S,M,L,XL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `role`) VALUES
(21, 'Esraa.nj@gmail.com', '$2y$10$HsYsBsmgM.lGT0II6J0v2uK6Lmq/WVu/S9kJkYqV2dHRL6g384nVy', 'admin'),
(25, 'Celine.al@gmail.com', '$2y$10$aYRrLV2TAKxqzSz2mZquLeDNi7/nfDaUJ7cjnXIolWBj5VV1OD/pu', 'admin'),
(26, 'user1@gmail.com', '$2y$10$j2RgOHKGxBuoopCnwjIL7uYZkOESx.pkCy94FdzgRZrQQGR8FSDkS', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
