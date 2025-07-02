-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table admin_project.admin_users
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`),
  UNIQUE KEY `admin_users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.admin_users: ~7 rows (approximately)
INSERT INTO `admin_users` (`id`, `name`, `username`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
	(3, 'Admin', 'admin', 'admin@example.com', '$2y$12$cHd6oq7yYiD9N5LLrF6KXu.CBb/o7ChX1bRynZwBhy6XZyMtG2aFC', 1, NULL, '2025-06-25 01:37:42', '2025-06-25 01:37:42'),
	(7, 'Ahmed', 'ahmed', 'ahmedmujtaba858@gmail.com', '$2y$12$2gTYcJvBC5TNBuSIvKlOIOF6pNDvNvx3k/pdXCXrc9v6f3jjmJc3q', 1, NULL, '2025-06-25 02:06:51', '2025-06-25 02:06:51'),
	(8, 'bleh', 'blehbleh', '123@example.com', '$2y$12$7mK4OrS0L/FX7mR7SHTnzOLMMpguyr3o8Fgv0h6ajuO/XvzDhdgCO', 1, NULL, '2025-06-25 04:31:58', '2025-06-26 02:01:07'),
	(13, 'admin1', 'admin1', 'admin1@example.com', '$2y$12$l0UA7aok0fcKq8sXMCaMBuUuKyd0Z3SPyBlHMUqyqmAe7dPCJm.J6', 0, NULL, '2025-06-30 04:01:48', '2025-06-30 04:01:48'),
	(14, 'admin2', 'admin2', 'admin2@example.com', '$2y$12$PTDp3EZo8vMHXTLJzPbj7uenTe2EU/wSzKbIiBCix8ZQynfXlGGqK', 0, NULL, '2025-06-30 04:02:04', '2025-06-30 04:02:04'),
	(15, 'rider', 'rider', 'rider@example.com', '$2y$12$VuBHZCF/k6tufhBlq4VLV.iTR06S1F/pO6DLhdCske9v7aznGJnRa', 0, NULL, '2025-06-30 04:11:39', '2025-06-30 04:11:39'),
	(16, 'rider2', 'rider2', 'rider2@example.com', '$2y$12$VTnVz7eV/tdAMPEUmUovNey1cy9/aFjTLouaynPeH8E9k/6/gac0C', 0, NULL, '2025-06-30 04:11:57', '2025-06-30 04:11:57'),
	(17, 'anas', 'anas123', 'anas@example.com', '$2y$12$bxzLlBnIqvpEAiTPlO1tCe7p3RYa4umG4VEnZZ37tyLWDLUdUZk2S', 1, NULL, '2025-06-30 23:59:28', '2025-06-30 23:59:28');

-- Dumping structure for table admin_project.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.cache: ~0 rows (approximately)

-- Dumping structure for table admin_project.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.cache_locks: ~0 rows (approximately)

-- Dumping structure for table admin_project.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table admin_project.forms
CREATE TABLE IF NOT EXISTS `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.forms: ~0 rows (approximately)

-- Dumping structure for table admin_project.imageform
CREATE TABLE IF NOT EXISTS `imageform` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `imageform_sku_unique` (`sku`),
  UNIQUE KEY `imageform_barcode_unique` (`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.imageform: ~6 rows (approximately)
INSERT INTO `imageform` (`id`, `name`, `image`, `description`, `price`, `sku`, `barcode`, `qty`, `created_at`, `updated_at`) VALUES
	(1, 'thumbtacks', '1749798182.jpg', '34534', 21312.00, '213', '272921', 1230, '2025-06-13 02:03:02', '2025-06-13 02:03:56'),
	(2, 'Chips', '1749798200.jpg', 'sdvkrfew', 2321.00, '122321', '21311323', 23232, '2025-06-13 02:03:20', '2025-06-13 02:03:56'),
	(3, 'Plunger', '1750057210.jpg', '234322', 213.00, '356', '342575724', 233, '2025-06-16 02:00:10', '2025-06-16 09:55:21'),
	(4, 'Mehran', '1750057246.jpg', 'boss', 2132.00, '23434', '23453295230', 3242, '2025-06-16 02:00:46', '2025-06-16 02:00:46'),
	(5, 'Naheed', '1750057275.png', 'naheed', 1.00, '2421', '3234124123', 2412, '2025-06-16 02:01:15', '2025-06-16 02:01:15'),
	(6, 'Trident', '1750057301.jpg', 'jsfndf', 242.00, '324234', '12412341243241234', 2420, '2025-06-16 02:01:41', '2025-06-16 09:55:21');

-- Dumping structure for table admin_project.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.jobs: ~0 rows (approximately)

-- Dumping structure for table admin_project.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.job_batches: ~0 rows (approximately)

-- Dumping structure for table admin_project.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.migrations: ~13 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(8, '0001_01_01_000000_create_users_table', 1),
	(9, '0001_01_01_000001_create_cache_table', 1),
	(10, '0001_01_01_000002_create_jobs_table', 1),
	(11, '2025_06_10_065613_create_forms_table', 1),
	(12, '2025_06_10_075240_create_imageform_table', 1),
	(13, '2025_06_13_051229_create_pos_table', 1),
	(14, '2025_06_13_055811_create_positems_table', 1),
	(15, '2025_06_20_061630_create_orders_table', 2),
	(16, '2025_06_23_052945_create_personal_access_tokens_table', 3),
	(17, '2025_06_24_132249_add_address_to_orders_table', 4),
	(18, '2025_06_25_051034_create_admin_users_table', 5),
	(25, '2025_06_25_000001_add_picker_id_to_orders_table', 6),
	(26, '2025_06_27_000001_add_packer_id_to_orders_table', 6),
	(27, '2025_06_30_000001_create_roles_and_user_roles_tables', 7),
	(28, '2025_06_30_000003_add_rider_id_to_orders', 8);

-- Dumping structure for table admin_project.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `original_id` bigint(20) unsigned NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`address`)),
  `phone` varchar(255) DEFAULT NULL,
  `picker_id` bigint(20) unsigned DEFAULT NULL,
  `packer_id` bigint(20) unsigned DEFAULT NULL,
  `rider_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_picker_id_foreign` (`picker_id`),
  KEY `orders_packer_id_foreign` (`packer_id`),
  KEY `orders_rider_id_foreign` (`rider_id`),
  CONSTRAINT `orders_packer_id_foreign` FOREIGN KEY (`packer_id`) REFERENCES `admin_users` (`id`),
  CONSTRAINT `orders_picker_id_foreign` FOREIGN KEY (`picker_id`) REFERENCES `admin_users` (`id`),
  CONSTRAINT `orders_rider_id_foreign` FOREIGN KEY (`rider_id`) REFERENCES `admin_users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.orders: ~5 rows (approximately)
INSERT INTO `orders` (`id`, `original_id`, `customer_name`, `customer_email`, `status`, `total_amount`, `items`, `created_at`, `updated_at`, `address`, `phone`, `picker_id`, `packer_id`, `rider_id`) VALUES
	(48, 14, 'Ahmed Mujtaba', 'ahmedmujtaba858@gmail.com', 'placed', 484.00, '[{"product_id":6,"quantity":2,"price":242,"discount":0}]', '2025-06-30 23:55:11', '2025-06-30 23:55:11', '{"street":"Apartment 7C Block 5 Sector J Askari V Malir Cantt","city":null,"state":"CA","country":"US","zip_code":"75070","phone":"03323241562"}', NULL, NULL, NULL, NULL),
	(49, 15, 'Ahmed Mujtaba', 'ahmedmujtaba858@gmail.com', 'shipped', 213.00, '[{"product_id":3,"quantity":1,"price":213,"discount":0}]', '2025-06-30 23:55:11', '2025-06-30 23:58:11', '{"street":"Apartment 7C Block 5 Sector J Askari V Malir Cantt","city":null,"state":"CA","country":"US","zip_code":"75070","phone":"03323241562"}', NULL, 13, 14, 15),
	(50, 16, 'Ahmed Mujtaba', 'ahmedmujtaba858@gmail.com', 'shipped', 213.00, '[{"product_id":3,"quantity":1,"price":213,"discount":0}]', '2025-06-30 23:55:11', '2025-06-30 23:58:11', '{"street":"Apartment 7C Block 5 Sector J Askari V Malir Cantt","city":null,"state":"CA","country":"US","zip_code":"75070","phone":"03323241562"}', NULL, 13, 14, 15),
	(51, 17, 'Ahmed Mujtaba', 'ahmedmujtaba858@gmail.com', 'shipped', 213.00, '[{"product_id":3,"quantity":1,"price":213,"discount":0}]', '2025-06-30 23:55:12', '2025-07-02 03:46:55', '{"street":"Apartment 7C Block 5 Sector J Askari V Malir Cantt","city":null,"state":"CA","country":"US","zip_code":"75070","phone":"03323241562"}', NULL, 13, 14, 16),
	(52, 18, 'Ahmed Mujtaba', 'ahmedmujtaba858@gmail.com', 'placed', 1.00, '[{"product_id":5,"quantity":1,"price":1,"discount":0}]', '2025-06-30 23:55:12', '2025-06-30 23:55:12', '{"street":"Apartment 7C Block 5 Sector J Askari V Malir Cantt","city":null,"state":"CA","country":"US","zip_code":"75070","phone":"03323241562"}', NULL, NULL, NULL, NULL);

-- Dumping structure for table admin_project.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table admin_project.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table admin_project.pos
CREATE TABLE IF NOT EXISTS `pos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(255) NOT NULL DEFAULT 'completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pos_payment_id_unique` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.pos: ~2 rows (approximately)
INSERT INTO `pos` (`id`, `payment_id`, `total_amount`, `tax_amount`, `discount`, `payment_status`, `created_at`, `updated_at`) VALUES
	(1, 1000, 2321.00, 348.15, 0.00, 'completed', '2025-06-13 02:03:28', '2025-06-13 02:03:28'),
	(2, 1001, 23633.00, 3544.95, 0.00, 'completed', '2025-06-13 02:03:56', '2025-06-13 02:03:56'),
	(3, 1002, 455.00, 68.25, 0.00, 'completed', '2025-06-16 09:55:21', '2025-06-16 09:55:21');

-- Dumping structure for table admin_project.positems
CREATE TABLE IF NOT EXISTS `positems` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pos_id` bigint(20) unsigned NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `positems_pos_id_foreign` (`pos_id`),
  CONSTRAINT `positems_pos_id_foreign` FOREIGN KEY (`pos_id`) REFERENCES `pos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.positems: ~5 rows (approximately)
INSERT INTO `positems` (`id`, `pos_id`, `item_name`, `quantity`, `price`, `total`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Chips', 1, 2321.00, 2321.00, '2025-06-13 02:03:28', '2025-06-13 02:03:28'),
	(2, 2, 'thumbtacks', 1, 21312.00, 21312.00, '2025-06-13 02:03:56', '2025-06-13 02:03:56'),
	(3, 2, 'Chips', 1, 2321.00, 2321.00, '2025-06-13 02:03:56', '2025-06-13 02:03:56'),
	(4, 3, 'Trident', 1, 242.00, 242.00, '2025-06-16 09:55:21', '2025-06-16 09:55:21'),
	(5, 3, 'Plunger', 1, 213.00, 213.00, '2025-06-16 09:55:21', '2025-06-16 09:55:21');

-- Dumping structure for table admin_project.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.roles: ~4 rows (approximately)
INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
	(1, 'Picker', 'picker', '2025-06-30 03:57:39', '2025-06-30 03:57:39'),
	(2, 'Packer', 'packer', '2025-06-30 03:57:39', '2025-06-30 03:57:39'),
	(3, 'Admin', 'admin', '2025-06-30 03:57:39', '2025-06-30 03:57:39'),
	(4, 'Rider', 'rider', '2025-06-30 04:09:33', '2025-06-30 04:09:33');

-- Dumping structure for table admin_project.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('Zm1aXel0jN2YAtSFCbwU1VzzF67ObOZOCXmm9hck', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNmJwWTJ2VkNVUEFrR3V6YmVxMmNVUFZlQUlwMUl5WmtocGN0RHNIYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MTp7aTowO3M6NzoibWVzc2FnZSI7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9teWFkbWluLmxvY2FsL3NoaXBwaW5nIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O30=', 1751446015);

-- Dumping structure for table admin_project.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Test User', 'test@example.com', '2025-06-30 03:50:17', '$2y$12$kLX56YLHP9UvXsZKxoEa5OaxbbChomR65Dl6keW9VPFB9CaIOQb82', 'ZeWxXr6PCf', '2025-06-30 03:50:17', '2025-06-30 03:50:17');

-- Dumping structure for table admin_project.user_roles
CREATE TABLE IF NOT EXISTS `user_roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_roles_user_id_foreign` (`user_id`),
  KEY `user_roles_role_id_foreign` (`role_id`),
  CONSTRAINT `user_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admin_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table admin_project.user_roles: ~4 rows (approximately)
INSERT INTO `user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
	(1, 13, 1, NULL, NULL),
	(2, 14, 2, NULL, NULL),
	(3, 15, 4, NULL, NULL),
	(4, 16, 4, NULL, NULL);

-- Dumping structure for table myshop.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.cache: ~0 rows (approximately)

-- Dumping structure for table myshop.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.cache_locks: ~0 rows (approximately)

-- Dumping structure for table myshop.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_customer_id_foreign` (`customer_id`),
  CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.carts: ~8 rows (approximately)
INSERT INTO `carts` (`id`, `session_id`, `customer_id`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'r47GNdQTORfOgPBNvNoDqhG9MU3xKREosMO3Ufn3', NULL, 'active', '2025-06-24 07:48:48', '2025-06-24 07:48:48'),
	(8, 'kDZgOSP34z88bTktKXBVgOceAtnL5HtkDX3P9hBD', NULL, 'active', '2025-06-25 04:01:10', '2025-06-25 04:01:10'),
	(13, 'J1Emq7DMjzv5CJubC4edonwE80kns8IDPQxRvm57', NULL, 'active', '2025-06-25 23:49:52', '2025-06-25 23:49:52'),
	(18, 'IxMUjMozYEXP0isaJO4c7uGXIazY7isFtFhVa3Dp', NULL, 'active', '2025-06-30 03:28:30', '2025-06-30 03:28:30'),
	(22, 'cuCBAjAQdZT1D2xQhuS6hUkBiWBQUS1iYSjBYS2h', NULL, 'active', '2025-06-30 23:47:19', '2025-06-30 23:47:19'),
	(24, '0FCwp8zRueg8CP2YHoMM7CZclZBxjQOlGrFEs7Mi', NULL, 'active', '2025-06-30 23:48:33', '2025-06-30 23:48:33'),
	(26, 'HItbjtC37yTPgef67KPTPJs3KkhjGIUepwWJk4Ue', NULL, 'active', '2025-07-02 03:31:53', '2025-07-02 03:31:53'),
	(27, 'PYjmclYrMhPCo2MYtDYUkYE1aRkFTlATC8QoIhVZ', 1, 'active', '2025-07-02 03:39:43', '2025-07-02 03:39:43');

-- Dumping structure for table myshop.cart_items
CREATE TABLE IF NOT EXISTS `cart_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_items_cart_id_foreign` (`cart_id`),
  CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.cart_items: ~2 rows (approximately)
INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `price`, `discount`, `created_at`, `updated_at`) VALUES
	(20, 26, 4, 1, 2132.00, NULL, '2025-07-02 03:36:53', '2025-07-02 03:36:53');

-- Dumping structure for table myshop.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `database_name` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.categories: ~4 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `slug`, `database_name`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'Women', 'women', 'imageform', 1, NULL, NULL),
	(2, 'Men', 'men', 'imageform', 1, NULL, NULL),
	(3, 'Kids', 'kids', 'imageform', 1, NULL, NULL),
	(4, 'Accessories', 'accessories', 'imageform', 1, NULL, NULL);

-- Dumping structure for table myshop.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.customers: ~0 rows (approximately)
INSERT INTO `customers` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Ahmed Mujtaba', 'ahmedmujtaba858@gmail.com', '$2y$12$RX6ostxVBMUnfguPd8p/UusSxqKq9oxfnNg.ZZgoqkAGYKk6BpGMq', NULL, '2025-06-24 07:49:13', '2025-06-24 07:49:13');

-- Dumping structure for table myshop.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table myshop.imageform
CREATE TABLE IF NOT EXISTS `imageform` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `imageform_sku_unique` (`sku`),
  UNIQUE KEY `imageform_barcode_unique` (`barcode`),
  UNIQUE KEY `imageform_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.imageform: ~6 rows (approximately)
INSERT INTO `imageform` (`id`, `name`, `slug`, `image`, `description`, `price`, `sku`, `barcode`, `qty`, `created_at`, `updated_at`, `category_id`) VALUES
	(1, 'thumbtacks', 'thumbtacks', '1749798182.jpg', '34534', 21312.00, '213', '272921', 1230, '2025-06-13 02:03:02', '2025-06-13 02:03:56', 1),
	(2, 'Chips', 'chips', '1749798200.jpg', 'sdvkrfew', 2321.00, '122321', '21311323', 23232, '2025-06-13 02:03:20', '2025-06-13 02:03:56', 1),
	(3, 'Plunger', 'plunger', '1750057210.jpg', '234322', 213.00, '356', '342575724', 234, '2025-06-16 02:00:10', '2025-06-16 02:00:10', 2),
	(4, 'Mehran', 'mehran', '1750057246.jpg', 'boss', 2132.00, '23434', '23453295230', 3242, '2025-06-16 02:00:46', '2025-06-16 02:00:46', 2),
	(5, 'Naheed', 'naheed', '1750057275.png', 'naheed', 1.00, '2421', '3234124123', 2412, '2025-06-16 02:01:15', '2025-06-16 02:01:15', 3),
	(6, 'Trident', 'trident', '1750057301.jpg', 'jsfndf', 242.00, '324234', '12412341243241234', 2421, '2025-06-16 02:01:41', '2025-06-16 02:01:41', 4);

-- Dumping structure for table myshop.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.jobs: ~0 rows (approximately)

-- Dumping structure for table myshop.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.job_batches: ~0 rows (approximately)

-- Dumping structure for table myshop.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.migrations: ~14 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_06_19_000000_create_customers_table', 1),
	(5, '2025_06_16_072617_create_categories_table', 1),
	(6, '2025_06_18_000001_create_orders_table', 1),
	(7, '2025_06_18_000002_create_order_items_table', 1),
	(8, '2025_06_23_053647_create_personal_access_tokens_table', 1),
	(9, '2024_06_18_create_carts_table', 2),
	(10, '2024_06_19_add_customer_id_to_orders', 2),
	(11, '2024_06_19_create_add_customer_id_to_carts_table', 2),
	(12, '2025_06_17_062646_update_imageform_add_slug_column', 2),
	(13, '2025_06_17_062831_update_existing_imageform_slugs', 2),
	(14, '2025_06_18_044422_create_cart_items_table', 2);

-- Dumping structure for table myshop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) NOT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `status` enum('draft','placed','completed','cancelled') NOT NULL DEFAULT 'draft',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_customer_id_foreign` (`customer_id`),
  CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.orders: ~5 rows (approximately)
INSERT INTO `orders` (`id`, `session_id`, `customer_id`, `status`, `first_name`, `last_name`, `email`, `phone`, `address`, `city`, `state`, `country`, `zip_code`, `notes`, `total_amount`, `created_at`, `updated_at`) VALUES
	(14, 't9vcKVcHRlREBTxMBRhddZoDvUbBZ1JgTdmUF3dX', 1, 'placed', 'Ahmed', 'Mujtaba', 'ahmedmujtaba858@gmail.com', '03323241562', 'Apartment 7C Block 5 Sector J Askari V Malir Cantt', NULL, 'CA', 'US', '75070', NULL, 484.00, '2025-06-30 03:28:51', '2025-06-30 03:28:52'),
	(15, 't9vcKVcHRlREBTxMBRhddZoDvUbBZ1JgTdmUF3dX', 1, 'placed', 'Ahmed', 'Mujtaba', 'ahmedmujtaba858@gmail.com', '03323241562', 'Apartment 7C Block 5 Sector J Askari V Malir Cantt', NULL, 'CA', 'US', '75070', NULL, 213.00, '2025-06-30 03:42:00', '2025-06-30 03:42:00'),
	(16, 't9vcKVcHRlREBTxMBRhddZoDvUbBZ1JgTdmUF3dX', 1, 'placed', 'Ahmed', 'Mujtaba', 'ahmedmujtaba858@gmail.com', '03323241562', 'Apartment 7C Block 5 Sector J Askari V Malir Cantt', NULL, 'CA', 'US', '75070', NULL, 213.00, '2025-06-30 04:02:35', '2025-06-30 04:02:35'),
	(17, 't9vcKVcHRlREBTxMBRhddZoDvUbBZ1JgTdmUF3dX', 1, 'placed', 'Ahmed', 'Mujtaba', 'ahmedmujtaba858@gmail.com', '03323241562', 'Apartment 7C Block 5 Sector J Askari V Malir Cantt', NULL, 'CA', 'US', '75070', NULL, 213.00, '2025-06-30 04:15:53', '2025-06-30 04:15:53'),
	(18, 'MLmNCirjlnchvkW1uTUHD7vgj3IihdlvzCTlV5il', 1, 'placed', 'Ahmed', 'Mujtaba', 'ahmedmujtaba858@gmail.com', '03323241562', 'Apartment 7C Block 5 Sector J Askari V Malir Cantt', NULL, 'CA', 'US', '75070', NULL, 1.00, '2025-06-30 23:49:53', '2025-06-30 23:49:53'),
	(19, 'PYjmclYrMhPCo2MYtDYUkYE1aRkFTlATC8QoIhVZ', 1, 'placed', 'Ahmed', 'Mujtaba', 'ahmedmujtaba858@gmail.com', '03323241562', 'Apartment 7C Block 5 Sector J Askari V Malir Cantt', NULL, 'CA', 'US', '75070', NULL, 2132.00, '2025-07-02 03:39:41', '2025-07-02 03:39:41');

-- Dumping structure for table myshop.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_index` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.order_items: ~4 rows (approximately)
INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `discount`, `created_at`, `updated_at`) VALUES
	(15, 14, 6, 2, 242.00, NULL, '2025-06-30 03:28:51', '2025-06-30 03:28:51'),
	(16, 15, 3, 1, 213.00, NULL, '2025-06-30 03:42:00', '2025-06-30 03:42:00'),
	(17, 16, 3, 1, 213.00, NULL, '2025-06-30 04:02:35', '2025-06-30 04:02:35'),
	(18, 17, 3, 1, 213.00, NULL, '2025-06-30 04:15:53', '2025-06-30 04:15:53'),
	(19, 18, 5, 1, 1.00, NULL, '2025-06-30 23:49:53', '2025-06-30 23:49:53'),
	(20, 19, 4, 1, 2132.00, NULL, '2025-07-02 03:39:41', '2025-07-02 03:39:41');

-- Dumping structure for table myshop.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table myshop.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table myshop.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.sessions: ~4 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('FlTfDgLPdWMWxegUSd1byxzco6DoFVCzzFrbnXjr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWdVZW5yZmV2U3ZyNlZaT3Y1c21NVHJSeklKeWlMVFE2YUd6REpjVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjA6Imh0dHA6Ly9teWFkbWluLmxvY2FsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1751445114),
	('MLmNCirjlnchvkW1uTUHD7vgj3IihdlvzCTlV5il', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicGkwMDV6cElHdEthZGZjZ0NORzA4clFhemxTWHpNdlExcmRlQUY2USI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTk6Imh0dHA6Ly9teXNob3AubG9jYWwiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1751346015),
	('PYjmclYrMhPCo2MYtDYUkYE1aRkFTlATC8QoIhVZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic01yeDNLa0xhTjZVQ29neUFXMVczTWZYRG1aSHA2VGphc2thR2FNbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9teXNob3AubG9jYWwvY2FydC9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1751445593),
	('t9vcKVcHRlREBTxMBRhddZoDvUbBZ1JgTdmUF3dX', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM3hEWGFUdmlLNEx2dG1RdnFLeDJMeXFSRm5JWmZDVENVOFVJQ085dCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9teXNob3AubG9jYWwvY2FydC9pdGVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1751274953);

-- Dumping structure for table myshop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table myshop.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
