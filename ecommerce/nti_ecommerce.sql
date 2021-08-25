-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 02:47 PM
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
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `street` varchar(100) NOT NULL,
  `building` varchar(100) NOT NULL,
  `floor` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=>not active',
  `notes` text DEFAULT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `street`, `building`, `floor`, `flat`, `status`, `notes`, `region_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'nozaha5', 'A5', '105', '605', 1, 'gamb elm7ta5', 3, 19, '2021-08-24 12:28:01', '2021-08-24 13:54:00'),
(2, 'korba', '55', '2', '4', 1, NULL, 2, 19, '2021-08-24 12:28:01', '2021-08-24 12:50:25'),
(3, 'shar3 elharm', '20', '5', '5', 1, NULL, 5, 18, '2021-08-24 12:28:01', '2021-08-24 13:36:02');

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
(2, 'Apple', 'Apple.gp', 1, '2021-08-19 11:18:54', '2021-08-19 11:18:54'),
(3, 'LG', 'lg.png', 1, '2021-08-25 07:47:15', '2021-08-25 07:47:15');

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
(11, 'home kitchen', 'office.png', 0, '2021-08-19 10:28:55', '2021-08-25 07:35:30'),
(12, 'health', 'tv.png', 1, '2021-08-25 07:13:51', '2021-08-25 07:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 => active , 0=> not',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cairo', 1, '2021-08-24 12:23:06', '2021-08-24 12:23:06'),
(2, 'Alex', 1, '2021-08-24 12:23:06', '2021-08-24 12:23:06'),
(3, 'Giza', 1, '2021-08-24 12:23:06', '2021-08-24 12:23:06'),
(4, 'Aswan', 1, '2021-08-24 12:23:06', '2021-08-24 12:23:06');

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
  `brand_id` int(10) UNSIGNED DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `details`, `status`, `quantity`, `brand_id`, `subcategory_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(1, 'laptop sam', '25000.00', '6.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 1, 1, 2, 1, 1, '2021-08-19 09:36:54', '2021-08-25 12:18:55'),
(2, 'laptop samsung', '15000.00', '5.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 1, 0, 1, 1, 1, '2021-08-19 09:37:59', '2021-08-25 09:29:54'),
(3, 'laptop samsung 256 GBYTE', '20000.00', '4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 1, 100, 1, 1, 1, '2021-08-19 09:37:59', '2021-08-25 09:29:51'),
(4, 'Samsung', '15000.00', '1.jpg', 'mobile Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 1, 10, 1, 2, 1, '2021-08-25 07:46:58', '2021-08-25 09:29:49'),
(5, 'iphone 12', '25000.00', '2.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 20, 2, 2, 1, '2021-08-25 07:46:58', '2021-08-25 09:29:58'),
(6, 'LG TV', '10000.00', '3.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\n', 1, 5, 3, 3, 1, '2021-08-25 07:46:58', '2021-08-25 09:29:46'),
(7, 'tea', '50.00', '10.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\n', 1, 5, NULL, 8, 1, '2021-08-25 11:03:26', '2021-08-25 11:09:26');

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
-- Stand-in structure for view `products_ratings`
-- (See below for the actual view)
--
CREATE TABLE `products_ratings` (
`id` int(10) unsigned
,`name` varchar(1000)
,`price` decimal(8,2)
,`image` varchar(255)
,`details` text
,`status` tinyint(1)
,`quantity` int(10)
,`brand_id` int(10) unsigned
,`subcategory_id` int(10) unsigned
,`supplier_id` int(10) unsigned
,`created_at` timestamp
,`updated_at` timestamp
,`brand_name` varchar(100)
,`subcategory_name` varchar(100)
,`category_name` varchar(50)
,`category_id` int(10) unsigned
,`reviews_count` bigint(21)
,`reviews_avg` decimal(4,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=>active,0=>not active',
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `distance` int(5) NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `status`, `longitude`, `latitude`, `distance`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Madent-naser', 1, 30.15, 30.25, 10, 1, '2021-08-24 12:24:59', '2021-08-24 12:24:59'),
(2, 'Maser-gdeda', 1, 32.2153, 31.232, 8, 1, '2021-08-24 12:24:59', '2021-08-24 12:24:59'),
(3, 'Maadi', 1, 31.8, 30.66, 3, 1, '2021-08-24 12:24:59', '2021-08-24 12:24:59'),
(4, 'Somaha', 1, 31.25, 30.55, 3, 2, '2021-08-24 12:24:59', '2021-08-24 12:24:59'),
(5, 'Haram', 1, 23.6, 22.5, 7, 3, '2021-08-24 12:24:59', '2021-08-24 12:24:59'),
(6, 'Faisl', 1, 33.6, 33.2, 1, 3, '2021-08-24 12:24:59', '2021-08-24 12:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment` text DEFAULT NULL,
  `value` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`product_id`, `user_id`, `comment`, `value`, `created_at`, `updated_at`) VALUES
(2, 5, 'good', 5, '2021-08-25 11:33:43', '2021-08-25 11:33:43'),
(2, 9, NULL, 3, '2021-08-25 11:33:43', '2021-08-25 11:35:04'),
(5, 3, 'ww7sh', 3, '2021-08-25 11:33:43', '2021-08-25 11:34:20'),
(5, 8, NULL, 4, '2021-08-25 11:33:43', '2021-08-25 11:33:43'),
(5, 18, 'gamed', 2, '2021-08-25 11:33:43', '2021-08-25 11:33:43'),
(7, 5, NULL, 1, '2021-08-25 11:33:43', '2021-08-25 11:35:21');

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
(2, 'mobiles', 'mobile.jpg', 1, 1, '2021-08-18 10:56:12', '2021-08-25 07:41:05'),
(3, 'tv', 'default.jpg', 1, 1, '2021-08-18 10:56:12', '2021-08-19 10:26:46'),
(4, 'chepsi', 'chepsi', 1, 10, '2021-08-19 10:27:46', '2021-08-19 10:27:46'),
(5, 'cheese', 'cheese.png', 1, 10, '2021-08-19 10:27:46', '2021-08-19 10:27:46'),
(6, 'skin care', 'camera.jpg', 1, 12, '2021-08-19 10:28:19', '2021-08-25 07:16:15'),
(7, 'hair care', 'hair.png', 0, 12, '2021-08-25 07:16:34', '2021-08-25 07:41:09'),
(8, 'drinks', '5.png', 1, 10, '2021-08-25 11:04:08', '2021-08-25 11:04:08');

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
(1, 'layla', '01144895434', 'soaad@gmail.com', '123456', NULL, 'default.jpg', 2, 'f', '2021-08-17 11:24:37', '2021-08-24 07:47:01'),
(2, 'ghalya', '01144895457', 'toqaya@gmail.com', '987564321', NULL, 'default.jpg', 3, 'f', '2021-08-16 11:24:37', '2021-08-22 11:28:00'),
(3, 'androw', '951251515', 'androw@gmail.com', '75321495', 99652, 'default.jpg', 2, 'm', '2021-08-15 11:24:37', '2021-08-19 08:56:22'),
(4, 'ah', '1144556632', 'ahmed@gmail.com', '123456ahned', NULL, 'default.jpg', 1, 'm', '2021-08-18 11:27:32', '2021-08-19 12:02:59'),
(5, 'marina', '1145556632', 'marina@gmail.com', 'marina', NULL, 'default.jpg', 1, 'f', '2021-08-18 11:28:59', '2021-08-22 11:28:03'),
(6, 'mohamed', '1144556772', 'mohamed@gmail.com', 'mohamed', 12345, 'default.jpg', 2, 'm', '2021-08-18 11:28:59', '2021-08-19 08:56:03'),
(7, 'mahmoed', 'NULL', 'may@gmail.com', 'may', NULL, 'default.jpg', 2, 'f', '2021-08-18 11:30:12', '2021-08-22 11:28:05'),
(8, 'galal', '01000498488', 'galal@gmail.com', 'galal123456', NULL, 'default.jpg', 2, 'm', '2021-08-18 11:32:28', '2021-08-19 11:47:53'),
(9, 'gamal', '98765432155', 'baher@gmail.com', '123456', 12345, 'default.jpg', 1, 'm', '2021-08-18 11:36:26', '2021-08-19 11:47:57'),
(18, 'baher', '01144895431', 'SoadAhmed1498@gmail.com', 'acd40b815cc1336dd2e11011b6697dc3b4be9adb', 39123, 'default.jpg', 1, 'm', '2021-08-23 08:24:52', '2021-08-24 12:09:23'),
(19, ' Galal Husseny', '01153805974', 'galal.husseny@gmail.com', 'fe012728adea02cdc41c5deb4cbe79d6e8b57d26', 92606, 'default.jpg', 1, 'm', '2021-08-24 12:26:06', '2021-08-24 12:26:15');

-- --------------------------------------------------------

--
-- Structure for view `productswithbrands`
--
DROP TABLE IF EXISTS `productswithbrands`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `productswithbrands`  AS   (select `products`.`name` AS `product_name`,`products`.`price` AS `price`,`products`.`image` AS `image`,`brands`.`name` AS `brand_name`,`subcategories`.`name` AS `subcateogry_name`,`categories`.`name` AS `cateogry_name`,`suppliers`.`name` AS `supplier_name` from ((((`products` join `brands` on(`products`.`brand_id` = `brands`.`id`)) left join `subcategories` on(`subcategories`.`id` = `products`.`subcategory_id`)) left join `suppliers` on(`suppliers`.`id` = `products`.`supplier_id`)) left join `categories` on(`categories`.`id` = `subcategories`.`category_id`)))  ;

-- --------------------------------------------------------

--
-- Structure for view `products_ratings`
--
DROP TABLE IF EXISTS `products_ratings`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_ratings`  AS   (select `products`.`id` AS `id`,`products`.`name` AS `name`,`products`.`price` AS `price`,`products`.`image` AS `image`,`products`.`details` AS `details`,`products`.`status` AS `status`,`products`.`quantity` AS `quantity`,`products`.`brand_id` AS `brand_id`,`products`.`subcategory_id` AS `subcategory_id`,`products`.`supplier_id` AS `supplier_id`,`products`.`created_at` AS `created_at`,`products`.`updated_at` AS `updated_at`,`brands`.`name` AS `brand_name`,`subcategories`.`name` AS `subcategory_name`,`categories`.`name` AS `category_name`,`categories`.`id` AS `category_id`,count(`reviews`.`product_id`) AS `reviews_count`,if(round(avg(`reviews`.`value`),0) is null,0,round(avg(`reviews`.`value`),0)) AS `reviews_avg` from ((((`products` left join `brands` on(`brands`.`id` = `products`.`brand_id`)) left join `subcategories` on(`subcategories`.`id` = `products`.`subcategory_id`)) left join `categories` on(`categories`.`id` = `subcategories`.`category_id`)) left join `reviews` on(`reviews`.`product_id` = `products`.`id`)) group by `products`.`id`)  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_regions_fk` (`region_id`),
  ADD KEY `users_addresses_fk` (`user_id`);

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
-- Indexes for table `cities`
--
ALTER TABLE `cities`
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
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regions_cities_FK` (`city_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `reviews_users_fk` (`user_id`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_regions_fk` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`),
  ADD CONSTRAINT `users_addresses_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_cities_FK` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_products_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
