-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2021 at 02:52 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nti_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>ative,0=>not active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'samsung', 'sam.png', 1, '2021-08-19 09:36:11', '2021-08-19 09:36:11'),
(2, 'Apple', 'Apple.gp', 1, '2021-08-19 11:18:54', '2021-08-19 11:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`user_id`, `product_id`, `quantity`) VALUES
(3, 1, 5),
(3, 2, 2),
(3, 3, 1),
(4, 1, 4),
(4, 2, 5),
(5, 3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1+active,0=>not actice',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'electronic', 'default.png', 1, '2021-08-18 10:55:10', '2021-08-18 11:45:31'),
(10, 'supermarket', 'supermarket.png', 1, '2021-08-19 10:27:02', '2021-08-19 10:27:02'),
(11, 'office', 'office.png', 1, '2021-08-19 10:28:55', '2021-08-19 10:28:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '1=>Avtive,0=>Not Active',
  `quantity` int(10) DEFAULT 1,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `details`, `status`, `quantity`, `brand_id`, `subcategory_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'laptop', '25000.00', 'lap.png', NULL, 1, 1, 2, 1, 1, '2021-08-19 09:36:54', '2021-08-19 11:38:58'),
(2, 'laptop samsung', '15000.00', 'len.png', NULL, 1, 1, 1, 1, 1, '2021-08-19 09:37:59', '2021-08-19 09:37:59'),
(3, 'laptop samsung 256 GBYTE', '20000.00', '20.png', NULL, 1, 1, 1, 1, 1, '2021-08-19 09:37:59', '2021-08-19 09:37:59');

-- --------------------------------------------------------

--
-- Stand-in structure for view `productswithbrands`
-- (See below for the actual view)
--
CREATE TABLE `productswithbrands` (
`product_name` varchar(1000)
,`price` decimal(8,2)
,`image` varchar(255)
,`brand_name` varchar(100)
,`subcateogry_name` varchar(100)
,`cateogry_name` varchar(50)
,`supplier_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=> not active',
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `image`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'laptops', 'default.jpg', 1, 1, '2021-08-18 10:56:12', '2021-08-19 10:26:40'),
(2, 'mobiles', 'mobile.jpg', 0, 1, '2021-08-18 10:56:12', '2021-08-19 10:26:43'),
(3, 'tv', 'default.jpg', 1, 1, '2021-08-18 10:56:12', '2021-08-19 10:26:46'),
(4, 'chepsi', 'chepsi', 1, 10, '2021-08-19 10:27:46', '2021-08-19 10:27:46'),
(5, 'cheese', 'cheese.png', 1, 10, '2021-08-19 10:27:46', '2021-08-19 10:27:46'),
(6, 'camera', 'camera.jpg', 1, NULL, '2021-08-19 10:28:19', '2021-08-19 10:28:19');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` int(5) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '2=>not verified , 1 -> verified',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `phone`, `email`, `password`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ahmed', '01144895434', 'ahmed@gmail.com', '123456', NULL, 2, '2021-08-19 09:36:42', '2021-08-19 09:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(5) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '2=>not verified,1=>verified',
  `gender` varchar(1) NOT NULL DEFAULT 'm',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`, `code`, `image`, `status`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'layla', '01144895434', 'soaad@gmail.com', '123456', NULL, 'default.jpg', 2, 'f', '2021-08-17 11:24:37', '2021-08-22 11:27:59'),
(2, 'ghalya', '01144895457', 'toqaya@gmail.com', '987564321', NULL, 'default.jpg', 3, 'f', '2021-08-16 11:24:37', '2021-08-22 11:28:00'),
(3, 'androw', '951251515', 'androw@gmail.com', '75321495', 99652, 'default.jpg', 2, 'm', '2021-08-15 11:24:37', '2021-08-19 08:56:22'),
(4, 'ah', '1144556632', 'ahmed@gmail.com', '123456ahned', NULL, 'default.jpg', 1, 'm', '2021-08-18 11:27:32', '2021-08-19 12:02:59'),
(5, 'marina', '1145556632', 'marina@gmail.com', 'marina', NULL, 'default.jpg', 1, 'f', '2021-08-18 11:28:59', '2021-08-22 11:28:03'),
(6, 'mohamed', '1144556772', 'mohamed@gmail.com', 'mohamed', 12345, 'default.jpg', 2, 'm', '2021-08-18 11:28:59', '2021-08-19 08:56:03'),
(7, 'mahmoed', 'NULL', 'may@gmail.com', 'may', NULL, 'default.jpg', 2, 'f', '2021-08-18 11:30:12', '2021-08-22 11:28:05'),
(8, 'galal', '01000498488', 'galal@gmail.com', 'galal123456', NULL, 'default.jpg', 2, 'm', '2021-08-18 11:32:28', '2021-08-19 11:47:53'),
(9, 'gamal', '98765432155', 'baher@gmail.com', '123456', 12345, 'default.jpg', 1, 'm', '2021-08-18 11:36:26', '2021-08-19 11:47:57'),
(15, ' Galal Husseny', '01153805974', 'galal.husseny@gmail.com', 'fe012728adea02cdc41c5deb4cbe79d6e8b57d26', 22216, 'default.jpg', 2, 'm', '2021-08-22 12:39:37', '2021-08-22 12:39:37');

-- --------------------------------------------------------

--
-- Structure for view `productswithbrands`
--
DROP TABLE IF EXISTS `productswithbrands`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productswithbrands`  AS   (select `products`.`name` AS `product_name`,`products`.`price` AS `price`,`products`.`image` AS `image`,`brands`.`name` AS `brand_name`,`subcategories`.`name` AS `subcateogry_name`,`categories`.`name` AS `cateogry_name`,`suppliers`.`name` AS `supplier_name` from ((((`products` join `brands` on(`products`.`brand_id` = `brands`.`id`)) left join `subcategories` on(`subcategories`.`id` = `products`.`subcategory_id`)) left join `suppliers` on(`suppliers`.`id` = `products`.`supplier_id`)) left join `categories` on(`categories`.`id` = `subcategories`.`category_id`)))  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `carts_products_fk` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_brands_fk` (`brand_id`),
  ADD KEY `products_suppliers_fk` (`supplier_id`),
  ADD KEY `products_subcategories_fk` (`subcategory_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategories_categories_fk` (`category_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone.unique` (`phone`),
  ADD UNIQUE KEY `email.unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email.unique` (`email`),
  ADD UNIQUE KEY `phone.unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `carts_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brands_fk` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_subcategories_fk` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `products_suppliers_fk` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
