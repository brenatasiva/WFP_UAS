-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 03:58 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wfp_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Asus', NULL, NULL),
(2, 'Acer', NULL, NULL),
(3, 'Dell', NULL, NULL),
(4, 'Lenovo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `unit`, `created_at`, `updated_at`) VALUES
(1, 'Laptop', 'laptop', NULL, NULL, NULL),
(2, 'Ram', 'sparepart', 'GB', NULL, NULL),
(3, 'Battery', 'sparepart', 'mAh', NULL, NULL),
(4, 'SSD', 'sparepart', 'GB', NULL, NULL),
(5, 'HDD', 'sparepart', 'GB', NULL, NULL),
(6, 'Mouse', 'accessories', NULL, NULL, NULL),
(7, 'Keyboard', 'accessories', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `created_at`, `updated_at`, `product_id`) VALUES
(1, 'laptop/laptop3.jpg', NULL, NULL, 1),
(2, 'laptop/laptop1.jpg', NULL, NULL, 1),
(3, 'laptop/laptop4.jpg', NULL, NULL, 1),
(4, 'laptop/laptop2.jpg', NULL, NULL, 1),
(5, 'laptop/laptop4.jpg', NULL, NULL, 2),
(6, 'laptop/laptop2.jpg', NULL, NULL, 2),
(7, 'laptop/laptop3.jpg', NULL, NULL, 2),
(8, 'laptop/laptop1.jpg', NULL, NULL, 2),
(11, 'laptop/laptop3.jpg', NULL, NULL, 3),
(12, 'laptop/laptop1.jpg', NULL, NULL, 3),
(13, 'laptop/laptop4.jpg', NULL, NULL, 4),
(14, 'laptop/laptop1.jpg', NULL, NULL, 4),
(15, 'laptop/laptop3.jpg', NULL, NULL, 4),
(16, 'laptop/laptop2.jpg', NULL, NULL, 4),
(17, 'laptop/laptop4.jpg', NULL, NULL, 5),
(18, 'laptop/laptop3.jpg', NULL, NULL, 5),
(19, 'laptop/laptop2.jpg', NULL, NULL, 5),
(20, 'laptop/laptop1.jpg', NULL, NULL, 5),
(21, 'laptop/laptop4.jpg', NULL, NULL, 6),
(22, 'laptop/laptop3.jpg', NULL, NULL, 6),
(23, 'laptop/laptop1.jpg', NULL, NULL, 6),
(24, 'laptop/laptop2.jpg', NULL, NULL, 6),
(25, 'laptop/laptop4.jpg', NULL, NULL, 7),
(26, 'laptop/laptop1.jpg', NULL, NULL, 7),
(27, 'laptop/laptop2.jpg', NULL, NULL, 7),
(28, 'laptop/laptop3.jpg', NULL, NULL, 7),
(29, 'laptop/laptop1.jpg', NULL, NULL, 8),
(30, 'laptop/laptop4.jpg', NULL, NULL, 8),
(31, 'laptop/laptop3.jpg', NULL, NULL, 8),
(32, 'laptop/laptop2.jpg', NULL, NULL, 8),
(33, 'laptop/laptop3.jpg', NULL, NULL, 9),
(34, 'laptop/laptop1.jpg', NULL, NULL, 9),
(35, 'laptop/laptop4.jpg', NULL, NULL, 9),
(36, 'laptop/laptop2.jpg', NULL, NULL, 9),
(37, 'laptop/laptop4.jpg', NULL, NULL, 10),
(38, 'laptop/laptop2.jpg', NULL, NULL, 10),
(39, 'laptop/laptop3.jpg', NULL, NULL, 10),
(40, 'laptop/laptop1.jpg', NULL, NULL, 10),
(45, 'ram/ram2.jpg', NULL, NULL, 13),
(46, 'ram/ram1.jpg', NULL, NULL, 13),
(49, 'ram/ram1.jpg', NULL, NULL, 15),
(50, 'ram/ram2.jpg', NULL, NULL, 15),
(51, 'battery/battery1.jpg', NULL, NULL, 16),
(52, 'battery/battery1.jpg', NULL, NULL, 17),
(53, 'battery/battery1.jpg', NULL, NULL, 18),
(54, 'battery/battery1.jpg', NULL, NULL, 19),
(55, 'battery/battery1.jpg', NULL, NULL, 20),
(62, 'hdd/hdd3.jpg', NULL, NULL, 24),
(63, 'hdd/hdd2.jpg', NULL, NULL, 24),
(64, 'hdd/hdd1.jpg', NULL, NULL, 24),
(65, 'hdd/hdd2.jpg', NULL, NULL, 25),
(66, 'hdd/hdd1.jpg', NULL, NULL, 25),
(67, 'hdd/hdd3.jpg', NULL, NULL, 25),
(68, 'hdd/hdd3.jpg', NULL, NULL, 26),
(69, 'hdd/hdd2.jpg', NULL, NULL, 26),
(70, 'hdd/hdd1.jpg', NULL, NULL, 26),
(71, 'mouse/mouse2.jpg', NULL, NULL, 27),
(72, 'mouse/mouse1.jpg', NULL, NULL, 27),
(73, 'mouse/mouse2.jpg', NULL, NULL, 28),
(74, 'mouse/mouse1.jpg', NULL, NULL, 28),
(75, 'keyboard/kboard2.jpg', NULL, NULL, 29),
(76, 'keyboard/kboard3.jpg', NULL, NULL, 29),
(77, 'keyboard/kboard1.jpg', NULL, NULL, 29),
(78, 'keyboard/kboard1.jpg', NULL, NULL, 30),
(79, 'keyboard/kboard2.jpg', NULL, NULL, 30),
(80, 'keyboard/kboard3.jpg', NULL, NULL, 30),
(83, 'laptop/1203202106591561a9c043b9864wesson-wang-y0_vFxOHayg-unsplash.jpg', '2021-12-02 23:59:15', '2021-12-02 23:59:15', 3),
(84, 'ssd/1203202108363161a9d70f71276ssd1.jpg', '2021-12-03 01:36:31', '2021-12-03 01:36:31', 31),
(85, 'ssd/1203202108363161a9d70f72773ssd2.jpg', '2021-12-03 01:36:31', '2021-12-03 01:36:31', 31),
(86, 'mouse/1203202108435661a9d8cc13e06mouse1.jpg', '2021-12-03 01:43:56', '2021-12-03 01:43:56', 32),
(87, 'hdd/1203202108594961a9dc85e124ahdd2.jpg', '2021-12-03 01:59:49', '2021-12-03 01:59:49', 33),
(88, 'hdd/1203202108594961a9dc85e27c1hdd3.jpg', '2021-12-03 01:59:49', '2021-12-03 01:59:49', 33),
(89, 'laptop/1203202109032261a9dd5a98b7elaptop3.jpg', '2021-12-03 02:03:22', '2021-12-03 02:03:22', 34),
(90, 'laptop/1203202109032261a9dd5a9a01alaptop4.jpg', '2021-12-03 02:03:22', '2021-12-03 02:03:22', 34),
(91, 'laptop/1203202109032261a9dd5a9ae15wesson-wang-y0_vFxOHayg-unsplash.jpg', '2021-12-03 02:03:22', '2021-12-03 02:03:22', 34),
(92, 'ssd/1203202110282261a9f146017adssd1.jpg', '2021-12-03 03:28:22', '2021-12-03 03:28:22', 35);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_11_27_163354_create_brands_table', 1),
(2, '2021_11_27_163423_create_categories_table', 1),
(3, '2021_11_27_163444_create_roles_table', 1),
(4, '2021_11_27_163456_create_users_table', 1),
(5, '2021_11_27_163503_create_products_table', 1),
(6, '2021_11_27_163521_create_images_table', 1),
(7, '2021_11_27_163534_create_transactions_table', 1),
(8, '2021_11_27_163612_create_transaction_details_table', 1),
(9, '2021_11_27_164411_add_rolesid_to_users_table', 1),
(10, '2021_11_27_164648_add_cateogryid_brandid_to_products_table', 1),
(11, '2021_11_27_164900_add_productsid_to_images_table', 1),
(12, '2021_11_27_172129_add_productid__userid_to_transactions_table', 1),
(13, '2021_11_27_175456_add_productid_transactionid_to_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  `spec` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `stock`, `price`, `spec`, `created_at`, `updated_at`, `category_id`, `brand_id`) VALUES
(1, '9fS1DUtTdB', 30, 18500000, '4;108;15;2400', NULL, '2021-12-02 11:10:05', 1, 1),
(2, 'ROG', 27, 15500000, '8;32;18;13000', NULL, '2021-12-03 02:54:46', 1, 2),
(3, 'zzsw5HU84u', 23, 19400000, '2;32;15;6000', NULL, NULL, 1, 2),
(4, 'HtHpWLhCFz', 20, 16000000, '4;20.7;19;2400', NULL, NULL, 1, 3),
(5, '4km09xDQSR', 25, 18800000, '64;6;20;6000', NULL, NULL, 1, 2),
(6, 'ZOcj7mXyqZ', 28, 19000000, '2;20.7;20;13000', NULL, NULL, 1, 4),
(7, 'KYh0uGlaNG', 20, 19000000, '4;108;19;2400', NULL, NULL, 1, 4),
(8, 'ArprVwmS3O', 24, 19000000, '8;8;10;13000', NULL, NULL, 1, 3),
(9, 'TVlj7V65WH', 21, 17300000, '2;48;14;6000', NULL, NULL, 1, 4),
(10, 'd3blBc7G6M', 25, 19100000, '16;6;15;6000', NULL, NULL, 1, 3),
(13, 'xjio9O9xkt', 21, 2400000, '2', NULL, NULL, 2, 3),
(15, 'jms307Mp39', 21, 1700000, '32', NULL, NULL, 2, 4),
(16, 'TCCtZiOuF7', 24, 1600000, '2400', NULL, NULL, 3, 1),
(17, 'sZN6zcX7oV', 23, 1400000, '2400', NULL, NULL, 3, 4),
(18, 'YHzIbdR0bR', 26, 1900000, '2400', NULL, NULL, 3, 1),
(19, '2fQozXvYTC', 22, 1500000, '2400', NULL, NULL, 3, 2),
(20, 'UToKWUsjws', 29, 1200000, '6000', NULL, NULL, 3, 3),
(24, '8OAr9jkHcZ', 28, 500000, '512', NULL, NULL, 5, 4),
(25, '54HTA1eU45', 22, 700000, '128', NULL, NULL, 5, 2),
(26, 'ZEvo9Hbbfh', 25, 200000, '512', NULL, NULL, 5, 1),
(27, 'RmR9W1AO3o', 29, 100000, 'Wireless', NULL, NULL, 6, 2),
(28, 'QRW9YCLBRI', 25, 300000, 'Wireless', NULL, NULL, 6, 4),
(29, '2hvD0Nt5Rj', 21, 700000, 'Cable', NULL, NULL, 7, 2),
(30, 'rUA3jlWYzC', 28, 80000, 'Wireless', NULL, NULL, 7, 2),
(31, 'Adata XPG', 90, 1100000, '960', '2021-12-03 01:36:31', '2021-12-03 01:36:31', 4, 2),
(32, 'Mouse Robot', 23, 150000, ';;;;Wireless', '2021-12-03 01:43:56', '2021-12-03 01:43:56', 6, 2),
(33, 'Samsung HDD', 52, 1100000, '1024', '2021-12-03 01:59:49', '2021-12-03 01:59:49', 5, 2),
(34, 'Swift 3', 23, 20000000, '16;20;9;4400', '2021-12-03 02:03:22', '2021-12-03 02:54:46', 1, 2),
(35, 'Samsung EVO 1 TERA', 99, 2500000, '1024', '2021-12-03 03:28:21', '2021-12-03 03:28:21', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Pegawai', NULL, NULL),
(3, 'Member', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `status`, `total`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'diterima', 93000000, '2021-12-02 09:15:08', '2021-12-03 03:03:36', 3),
(2, 'ditolak', 99000000, '2021-12-02 11:09:12', '2021-12-02 11:10:05', 3),
(3, 'pending', 66500000, '2021-12-03 02:54:46', '2021-12-03 02:54:46', 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`, `product_id`, `transaction_id`) VALUES
(1, 6, 15500000, 93000000, NULL, NULL, 2, 1),
(2, 2, 18500000, 37000000, NULL, NULL, 1, 2),
(3, 4, 15500000, 62000000, NULL, NULL, 2, 2),
(4, 3, 15500000, 46500000, NULL, NULL, 2, 3),
(5, 1, 20000000, 20000000, NULL, NULL, 34, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`, `status`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'edongoran', '$2y$10$kYUMxGClUk5jtYxqjC2Iqu5k5gEp/r9GXuWCi7tg5ME76iUyEOQw6', 'Nyoman Zulkarnain', 'active', NULL, NULL, 1),
(2, 'melinda34', '$2y$10$J2q5TUzkooyOCeWXBl5KtOMKYG2zrbDLFGzCC3KDHSfVkbNvyu5W2', 'Damu Rama Lazuardi S.Ked', 'active', NULL, NULL, 2),
(3, 'kania85', '$2y$10$syFIfVePU4bWohrRiDvXe.dzbX8dPki8QvARQts6enrMeSFPm0Q8G', 'Elvina Prastuti S.Psi', 'active', NULL, NULL, 3),
(4, 'james', '$2y$10$hWzj8VOXYWU9AOn0.Y/xruZpIws5m/8XQyIR3dQxXwR3FWGQcD6L2', 'james gough', 'active', '2021-12-03 02:52:42', '2021-12-03 02:52:42', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_foreign` (`product_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_details_product_id_foreign` (`product_id`),
  ADD KEY `transaction_details_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `transaction_details_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
