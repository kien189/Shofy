-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2024 at 07:25 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `variant_id`, `created_at`, `updated_at`, `quantity`) VALUES
(19, 6, 7, 10, NULL, NULL, '4');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('hideen','active','','') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`, `updated_at`, `description`, `image`) VALUES
(1, 'Headphones', 'active', NULL, NULL, 'Headphones', 'product-cat-1.png'),
(2, 'Mobile Phone', 'active', NULL, NULL, 'Mobile Phone', 'product-cat-2.png'),
(3, 'CPU Heat Pipes', 'active', NULL, NULL, 'CPU Heat Pipes', 'product-cat-3.png'),
(4, 'Smart Watch', 'active', NULL, NULL, 'Smart Watch', 'product-cat-4.png'),
(5, 'With Bluetooth', 'active', NULL, NULL, 'With Bluetooth', 'product-cat-5.png');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `reply_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `product_id`, `content`, `rating`, `reply_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Designed very similarly to the nearly double priced Galaxy tab S6, with the only removal being.', 3, NULL, '2024-10-21 16:27:00', '2024-10-21 16:27:00'),
(3, 6, 1, 'This review is for the Samsung Tab S6 Lite, 64gb wifi in blue. purchased this product performed', 4, NULL, '2024-10-21 17:18:49', '2024-10-21 17:18:49'),
(4, 6, 2, 'Designed very similarly to the nearly double priced Galaxy tab S6, with the only removal being.', 4, NULL, '2024-10-22 08:02:43', '2024-10-22 08:02:43'),
(5, 6, 2, 'This review is for the Samsung Tab S6 Lite, 64gb wifi in blue. purchased this product performed', 2, NULL, '2024-10-22 08:03:05', '2024-10-22 08:03:05'),
(6, 6, 7, 'Not bad', 4, NULL, '2024-10-23 17:13:40', '2024-10-23 17:13:40'),
(7, 6, 1, 'not bad', 2, NULL, '2024-10-23 17:44:14', '2024-10-23 17:44:14');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `title` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `quantity` int NOT NULL,
  `status` enum('Active','Expired','Future Plan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `coupon_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` enum('Free Shipping','Percentage','Fixed Amount') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `coupon_value` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `name`, `start_date`, `end_date`, `quantity`, `status`, `coupon_code`, `type`, `coupon_value`, `created_at`, `updated_at`) VALUES
(2, 'Giảm 50k cho đơn hàng đầu tiên !.', '2024-10-29', '2024-11-01', 40, 'Active', 'Voucher_50k', 'Fixed Amount', 50, '2024-10-22 07:35:47', '2024-10-22 07:35:47'),
(3, 'Giảm 10%', '2024-10-23', '2024-10-26', 8, 'Active', 'Voucher_10%', 'Percentage', 10, '2024-10-22 07:41:57', '2024-10-22 07:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `product_id`, `quantity`, `updated_at`, `created_at`) VALUES
(8, 6, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `variant_id` int NOT NULL,
  `quantity` int NOT NULL,
  `order_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`id`, `user_id`, `product_id`, `variant_id`, `quantity`, `order_id`, `created_at`, `updated_at`) VALUES
(10, 6, 1, 1, 6, 6, '2024-10-23 14:31:06', '2024-10-23 14:31:06'),
(11, 6, 1, 2, 2, 6, '2024-10-23 14:31:06', '2024-10-23 14:31:06'),
(12, 6, 2, 3, 3, 7, '2024-10-23 14:35:47', '2024-10-23 14:35:47'),
(13, 6, 5, 7, 3, 7, '2024-10-23 14:35:47', '2024-10-23 14:35:47'),
(14, 6, 5, 8, 4, 7, '2024-10-23 14:35:47', '2024-10-23 14:35:47'),
(15, 6, 1, 1, 2, 8, '2024-10-23 17:04:58', '2024-10-23 17:04:58'),
(16, 6, 2, 3, 6, 9, '2024-10-23 17:06:21', '2024-10-23 17:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `amount` int NOT NULL,
  `note` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Confirmed','Shipped','Delivered','Canceled') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `name`, `email`, `phone`, `address`, `user_id`, `amount`, `note`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Nguyễn Văn Kiên  ', 'kien18092004@gmail.com', '335580379', 'Đội 4 , Thôn Sơn Đồng , Xã Tiên Phương ', 6, 3850, '', 'Delivered', '2024-10-23 14:31:06', '2024-10-23 14:31:06'),
(7, 'Nguyễn Văn Kiên  ', 'kien18092004@gmail.com', '335580379', 'Đội 4 , Thôn Sơn Đồng , Xã Tiên Phương ', 6, 6040, '', 'Delivered', '2024-10-23 14:35:47', '2024-10-23 14:35:47'),
(8, 'Nguyễn Văn Kiên  ', 'kien18092004@gmail.com', '335580379', 'Đội 4 , Thôn Sơn Đồng , Xã Tiên Phương ', 6, 960, '', 'Pending', '2024-10-23 17:04:58', '2024-10-23 17:04:58'),
(9, 'Nguyễn Văn Kiên  ', 'kien18092004@gmail.com', '335580379', 'Đội 4 , Thôn Sơn Đồng , Xã Tiên Phương ', 6, 2880, '', 'Pending', '2024-10-23 17:06:21', '2024-10-23 17:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `category_id` int NOT NULL,
  `salePrice` float NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `price`, `category_id`, `salePrice`, `slug`, `description`) VALUES
(1, 'Galaxy Tab S6 Lite 10.4-inch Android Tablet 128GB.', '6704253c9e8de-product-1.jpg', 450, 1, 420, 'galaxy-tab-s6-lite-10-4-inch-android-tablet-128gb', '<p>Galaxy A8 tablet</p><h3>Your world at a glance</h3><figure class=\"image image-style-side\"><img style=\"aspect-ratio:500/427;\" src=\"assets/img/product/details/desc/product-details-desc-1.jpg\" alt=\"\" width=\"500\" height=\"427\"></figure><p>With a slim design, a vibrant entertainment system, and<br>outstanding performance, the new Galaxy Tab A7 is a stylish new<br>companion for your life.Dive head-first into the things you love,<br>and easily share your favorite moments. Learn, explore, connect<br>and be inspired.</p><h3>Draw inspiration with S Pen</h3><p>S Pen is a bundle of writing instruments in one. Its natural grip,<br>low latency and impressive pressure sensitivity will make it your go-to for everything from drawing to editing documents. And S Pen won\'t get misplaced thanks.</p><p>&nbsp;</p><p><img src=\"assets/img/product/details/desc/product-details-desc-2.jpg\" alt=\"\" width=\"590\" height=\"394\"></p><h3>Carry with<br>Confidence and style</h3><p>Wrap your tablet in a sleek case that\'s as stylish as it is convenient. Galaxy Tab S6 Lite Book Cover folds around and clings magnetically, so you can easily gear up as you\'re headed out the door. There\'s even a compartment for S pen, so you can be sure it doesn\'t get left behind.</p><h3>Speed Memory Power = Epic Races</h3><p><img src=\"assets/img/product/details/desc/product-details-desc-3.jpg\" alt=\"\" width=\"792\" height=\"364\"></p>'),
(2, 'Professional Camera 4K Digital Video Camera.', '6718f99ead361-product-4.jpg', 247, 1, 420, 'professional-camera-4k-digital-video-camera', '<h3><a href=\"product-details.html\">Professional Camera 4K Digital Video Camera.</a></h3>'),
(3, 'Professional Camera 4K Digital Video Camera.', '6718f9b474347-product-4.jpg', 247, 2, 420, 'professional-camera-4k-digital-video-camera', '<p>Professional Camera 4K Digital Video Camera.</p>'),
(4, 'Mini Portable Mobile Phone Powerbank for iphone.', '6718fae8ce84b-product-5-3.jpg', 500, 4, 485, 'mini-portable-mobile-phone-powerbank-for-iphone', '<p>Mini Portable Mobile Phone Powerbank for iphone.</p>'),
(5, 'Mini Portable PD 22.5W Fast Charging Powerbank.', '6718fb6b52cfc-product-5.jpg', 500, 5, 450, 'mini-portable-pd-22-5w-fast-charging-powerbank', '<p>Mini Portable PD 22.5W Fast Charging Powerbank.</p>'),
(6, ' True Wireless Noise Cancelling Earbuds with Apple. ', '6718fbf282de9-product-7.jpg', 450, 5, 430, 'true-wireless-noise-cancelling-earbuds-with-apple', '<p>True Wireless Noise Cancelling Earbuds with Apple.&nbsp;</p>'),
(7, 'Microsoft Surface Pro 8-13\" Touchscreen.', '6718fc993af41-product-13.jpg', 500, 2, 485, 'microsoft-surface-pro-8-13-touchscreen', '<p>Microsoft Surface Pro 8-13\" Touchscreen.</p>'),
(8, 'Tracker with IP67 Waterproof Pedometer Smart watch.', '6718fce273bd6-product-8.jpg', 500, 1, 485, 'tracker-with-ip67-waterproof-pedometer-smart-watch', '<p>Tracker with IP67 Waterproof Pedometer Smart watch.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `product_gallery`
--

CREATE TABLE `product_gallery` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_gallery`
--

INSERT INTO `product_gallery` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(6, 1, '670425d931b74-product-details-main-1.jpg', NULL, NULL),
(7, 1, '670425d9321dd-product-details-main-2.jpg', NULL, NULL),
(8, 1, '670425d93284b-product-details-main-3.jpg', NULL, NULL),
(9, 1, '670425d9332fb-product-details-main-4.jpg', NULL, NULL),
(11, 3, '6711422105d20-product-related-3.jpg', NULL, NULL),
(13, 2, '671157b5649a4-product-related-1.jpg', NULL, NULL),
(14, 2, '671157b566f23-product-related-2.jpg', NULL, NULL),
(15, 2, '671157b56856a-product-related-3.jpg', NULL, NULL),
(16, 2, '671157b5698cb-product-related-4.jpg', NULL, NULL),
(17, 4, '6718fae8d10f3-product-5-3.jpg', NULL, NULL),
(18, 5, '6718fb6b546a2-product-5.jpg', NULL, NULL),
(19, 6, '6718fbf284b69-product-7.jpg', NULL, NULL),
(20, 7, '6718fc993d2c4-product-13.jpg', NULL, NULL),
(21, 8, '6718fce275881-product-8.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variant`
--

CREATE TABLE `product_variant` (
  `id` int NOT NULL,
  `price` int NOT NULL,
  `sale_price` int NOT NULL,
  `variant_color_id` int NOT NULL,
  `variant_size_id` int NOT NULL,
  `quantity` int NOT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variant`
--

INSERT INTO `product_variant` (`id`, `price`, `sale_price`, `variant_color_id`, `variant_size_id`, `quantity`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 485, 480, 8, 2, 55, 1, NULL, NULL),
(2, 500, 485, 9, 2, 66, 1, NULL, NULL),
(3, 850, 480, 8, 4, 44, 2, NULL, NULL),
(4, 600, 541, 9, 4, 55, 3, NULL, NULL),
(5, 850, 800, 8, 1, 55, 4, NULL, NULL),
(6, 800, 750, 9, 4, 44, 4, NULL, NULL),
(7, 850, 800, 8, 1, 12, 5, NULL, NULL),
(8, 600, 550, 9, 2, 22, 5, NULL, NULL),
(9, 600, 550, 8, 2, 55, 6, NULL, NULL),
(10, 850, 800, 8, 1, 11, 7, NULL, NULL),
(11, 950, 900, 9, 2, 22, 7, NULL, NULL),
(12, 850, 800, 8, 2, 22, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `role_type` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'user', 'Người dùng', '2024-09-24 11:30:35', '2024-09-24 11:30:35'),
(2, 'admin', 'Quản trị viên', '2024-09-25 14:52:31', '2024-09-25 14:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` int DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int DEFAULT NULL,
  `gender` enum('male','female','others') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `address`, `email`, `phone`, `password`, `role_id`, `gender`) VALUES
(6, 'Nguyễn Văn Kiên  ', NULL, 'Đội 4 , Thôn Sơn Đồng , Xã Tiên Phương ', 'kien18092004@gmail.com', 335580379, '$2y$10$GHfu.aD6zwexzGMUTrqOhuhOkugsUsd.n2Dn1hntvj4E2igX2X0z6', 2, 'female'),
(7, 'Nguyễn Văn B', NULL, 'Đội 4 , Thôn Sơn Đồng , Xã Tiên Phương  ', 'kiennvph42983@gmail.com', 337955330, '$2y$10$vqzk85Pkfc9vatHAbQaU6e9lvN7t2pqmrq2EIvffwKJ2TJosPayAy', 1, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `variant_color`
--

CREATE TABLE `variant_color` (
  `id` int NOT NULL,
  `color_code` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant_color`
--

INSERT INTO `variant_color` (`id`, `color_code`, `color_name`, `created_at`, `updated_at`) VALUES
(8, '#000000', 'Đen ', NULL, NULL),
(9, '#FFFFFF', 'Trắng ', NULL, NULL),
(10, '#0000FF', 'Xanh ', NULL, NULL),
(11, '#FFC0CB', 'Hồng ', NULL, NULL),
(12, '#FF0000', 'Đỏ ', NULL, NULL),
(13, '#FFFF00', 'Vàng ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant_size`
--

CREATE TABLE `variant_size` (
  `id` int NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `variant_size`
--

INSERT INTO `variant_size` (`id`, `size`, `created_at`, `updated_at`) VALUES
(1, '64GB', NULL, NULL),
(2, '128GB', NULL, NULL),
(3, '256GB', NULL, NULL),
(4, '512GB', NULL, NULL),
(5, '1T', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `oder_ibfk_1` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_id` (`variant_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `variant_size_id` (`variant_size_id`),
  ADD KEY `variant_color_id` (`variant_color_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `variant_color`
--
ALTER TABLE `variant_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variant_size`
--
ALTER TABLE `variant_size`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_gallery`
--
ALTER TABLE `product_gallery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_variant`
--
ALTER TABLE `product_variant`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `variant_color`
--
ALTER TABLE `variant_color`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `variant_size`
--
ALTER TABLE `variant_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`id`);

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `oder`
--
ALTER TABLE `oder`
  ADD CONSTRAINT `oder_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order_detail` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `oder_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `oder_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `oder_ibfk_4` FOREIGN KEY (`variant_id`) REFERENCES `product_variant` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `product_gallery`
--
ALTER TABLE `product_gallery`
  ADD CONSTRAINT `product_gallery_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `product_variant`
--
ALTER TABLE `product_variant`
  ADD CONSTRAINT `product_variant_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_variant_ibfk_2` FOREIGN KEY (`variant_size_id`) REFERENCES `variant_size` (`id`),
  ADD CONSTRAINT `product_variant_ibfk_3` FOREIGN KEY (`variant_color_id`) REFERENCES `variant_color` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
