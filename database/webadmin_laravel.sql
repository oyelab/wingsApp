-- -------------------------------------------------------------
-- TablePlus 6.1.8(574)
--
-- https://tableplus.com/
--
-- Database: webadmin_laravel
-- Generation Time: 2024-11-12 10:03:52.3870
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `order` int DEFAULT NULL,
  `views` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`),
  CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_product_category_id_foreign` (`category_id`),
  KEY `category_product_product_id_foreign` (`product_id`),
  CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE `deliveries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `order_ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consignment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `delivery_fee` decimal(8,2) DEFAULT NULL,
  `recipient_city` int DEFAULT NULL,
  `recipient_zone` int DEFAULT NULL,
  `recipient_area` int DEFAULT NULL,
  `special_instruction` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `item_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deliveries_order_id_foreign` (`order_id`),
  CONSTRAINT `deliveries_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `size_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_product_order_id_foreign` (`order_id`),
  KEY `order_product_product_id_foreign` (`product_id`),
  KEY `order_product_size_id_foreign` (`size_id`),
  CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_product_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `terms` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `sale` int DEFAULT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `specifications` json DEFAULT NULL,
  `images` json NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` json DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `quantities`;
CREATE TABLE `quantities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `size_id` bigint unsigned NOT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quantities_product_id_foreign` (`product_id`),
  KEY `quantities_size_id_foreign` (`size_id`),
  CONSTRAINT `quantities_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quantities_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_v1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_v2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_links` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE `sizes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE `sliders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sliders_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `specifications`;
CREATE TABLE `specifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ref` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint unsigned NOT NULL,
  `val_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `shipping_charge` decimal(10,2) DEFAULT NULL,
  `order_total` decimal(10,2) DEFAULT NULL,
  `order_discount` decimal(10,2) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_amount` decimal(10,2) DEFAULT NULL,
  `card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_tran_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tran_date` timestamp NULL DEFAULT NULL,
  `error` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_issuer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_sub_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_issuer_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_issuer_country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `verify_sign_sha2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_amount` decimal(10,2) DEFAULT NULL,
  `currency_rate` decimal(10,4) DEFAULT NULL,
  `base_fair` decimal(10,2) DEFAULT NULL,
  `value_a` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `risk_level` int DEFAULT NULL,
  `risk_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `transactions_ref_idx` (`ref`) USING BTREE,
  KEY `order_id` (`order_id`),
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `title`, `slug`, `image`, `parent_id`, `description`, `created_at`, `updated_at`, `status`, `order`, `views`) VALUES
(22, 'Wings Edited', 'wings-edited', 'wings-edited.png', NULL, 'Discover our exclusive selection of meticulously crafted products, refined to reflect the essence of Wings. Every piece in this collection is carefully edited to offer you the finest quality and unique style that stands out.', '2024-10-19 09:56:36', '2024-11-03 23:45:16', 1, 3, NULL),
(24, 'Product order 2', 'product-order-2', 'product-order-2.jpg', NULL, 'Description', '2024-10-19 10:01:41', '2024-10-19 10:28:20', 2, 1, NULL),
(26, 'By Replaced Product', 'by-replaced-product', 'by-replaced-product.jpg', NULL, 'This is!', '2024-10-19 10:08:02', '2024-10-19 10:08:02', 1, 2, NULL);

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(69, 22, 68, NULL, NULL),
(70, 24, 68, NULL, NULL),
(72, 26, 68, NULL, NULL),
(73, 22, 67, NULL, NULL),
(74, 24, 67, NULL, NULL),
(76, 26, 67, NULL, NULL),
(77, 22, 66, NULL, NULL),
(78, 22, 54, NULL, NULL),
(79, 22, 69, NULL, NULL);

INSERT INTO `deliveries` (`id`, `order_id`, `order_ref`, `consignment_id`, `order_status`, `delivery_fee`, `recipient_city`, `recipient_zone`, `recipient_area`, `special_instruction`, `item_description`, `created_at`, `updated_at`) VALUES
(11, 48, 'ws0291e79c', 'DT311024GKS57B', 'Pending', 130.00, 1, 1070, 20924, NULL, NULL, '2024-10-31 07:27:29', '2024-10-31 07:45:05'),
(12, 49, 'wscf89a6ea', 'DT311024UZR4YJ', 'Pending', 130.00, 1, 298, 3069, NULL, NULL, '2024-10-31 12:36:32', '2024-10-31 13:46:07'),
(13, 50, 'ws487026dd', 'DT311024PYEUBY', 'Pending', 145.00, 39, 640, 10859, NULL, NULL, '2024-10-31 13:39:17', '2024-10-31 13:40:42'),
(14, 51, 'ws4825a388', 'DT311024LVDUJQ', 'Pending', 60.00, 52, 156, 13193, NULL, NULL, '2024-10-31 14:03:28', '2024-10-31 14:05:38'),
(15, 52, 'wsda6262ea', 'DT311024EHSUHK', 'Pending', 110.00, 1, 298, 3069, NULL, NULL, '2024-10-31 14:06:36', '2024-10-31 14:07:40'),
(16, 53, 'ws8d304b42', 'DT311024WW74GL', 'Pending', 110.00, 1, 1070, 20924, NULL, NULL, '2024-10-31 14:11:44', '2024-10-31 14:12:33'),
(17, 54, 'wsb3576180', 'DT311024KBMZMJ', 'Pending', 120.00, 39, 640, 10859, NULL, NULL, '2024-10-31 14:17:24', '2024-10-31 14:20:52'),
(18, 55, 'ws62c27af3', 'DT311024Q74D54', 'Pending', 60.00, 52, 156, 13180, NULL, NULL, '2024-10-31 14:27:20', '2024-10-31 14:27:37'),
(19, 56, 'ws2f74a55a', 'DT311024LUQZRA', 'Pending', 110.00, 1, 298, NULL, NULL, NULL, '2024-10-31 14:32:57', '2024-10-31 14:34:22'),
(20, 57, 'ws71c050df', 'DT311024AAPEV5', 'Pending', 110.00, 1, 298, NULL, NULL, NULL, '2024-10-31 14:40:00', '2024-10-31 14:40:54'),
(21, 58, 'wsf9251b4b', 'DT3110246SSNM4', 'Pending', 110.00, 1, 298, 3069, NULL, NULL, '2024-10-31 14:44:45', '2024-10-31 14:45:48'),
(22, 59, 'ws4ad63334', 'DT311024J7PWTY', 'Pending', 110.00, 1, 298, NULL, NULL, NULL, '2024-10-31 14:51:30', '2024-10-31 14:52:21'),
(23, 60, 'wsd9289064', 'DT311024KW6HCL', 'Pending', 120.00, 14, 503, 10086, NULL, NULL, '2024-10-31 14:56:32', '2024-10-31 14:57:19'),
(24, 61, 'wsc518a856', 'DT3110242AR77B', 'Pending', 120.00, 39, 641, 10869, NULL, NULL, '2024-10-31 16:53:36', '2024-10-31 16:55:09'),
(25, 62, 'wscf6e9301', 'DT311024YDN6T4', 'Pending', 110.00, 1, 317, NULL, NULL, NULL, '2024-10-31 16:59:28', '2024-10-31 17:00:34'),
(26, 63, 'ws89b5d26d', NULL, 'Pending', 100.00, 39, 140, NULL, NULL, NULL, '2024-10-31 17:09:37', '2024-10-31 17:09:37'),
(27, 66, 'ws577e3447', NULL, 'Pending', 100.00, 39, 643, NULL, NULL, NULL, '2024-11-01 23:47:07', '2024-11-01 23:47:07'),
(28, 67, 'ws69e31a59', 'DT011124SDEPQQ', 'Pending', 120.00, 39, 643, 10866, NULL, NULL, '2024-11-01 23:53:30', '2024-11-01 23:55:12'),
(29, 68, 'ws7f5a5c61', NULL, 'Pending', 100.00, 39, 640, 4742, NULL, NULL, '2024-11-02 00:24:36', '2024-11-02 00:24:36'),
(30, 69, 'wsb07dbe78', NULL, 'Pending', 100.00, 39, 640, 10859, NULL, NULL, '2024-11-02 00:26:35', '2024-11-02 00:26:35'),
(31, 70, 'ws8e383164', NULL, 'Pending', 100.00, 62, 714, 18821, NULL, NULL, '2024-11-02 00:42:49', '2024-11-02 00:42:49'),
(32, 71, 'ws510f1952', NULL, 'Pending', 100.00, 39, 640, 4742, NULL, NULL, '2024-11-02 00:57:40', '2024-11-02 00:57:40'),
(33, 72, 'ws02299bde', NULL, 'Pending', 60.00, 52, 156, 13193, NULL, NULL, '2024-11-02 01:45:59', '2024-11-02 01:45:59'),
(34, 74, 'ws421d9884', NULL, 'Pending', 100.00, 39, 640, 10859, NULL, NULL, '2024-11-02 01:51:44', '2024-11-02 01:51:44'),
(35, 75, 'ws0ade7ca0', NULL, 'Pending', 100.00, 34, 933, 15202, NULL, NULL, '2024-11-02 02:55:38', '2024-11-02 02:55:38'),
(36, 76, 'wsb8a2c6d6', 'DT021124MVPYJJ', 'Pending', 120.00, 39, 643, 10866, NULL, NULL, '2024-11-02 19:30:40', '2024-11-02 20:38:47'),
(37, 77, 'wsda6f7c62', NULL, 'Pending', 100.00, 39, 640, 10859, NULL, NULL, '2024-11-03 16:01:33', '2024-11-03 16:01:33'),
(38, 78, 'wsd3339530', NULL, 'Pending', 100.00, 1, 298, NULL, NULL, NULL, '2024-11-05 19:50:22', '2024-11-05 19:50:22'),
(39, 79, 'ws139ddc0c', NULL, 'Pending', 100.00, 5, 534, NULL, NULL, NULL, '2024-11-05 21:48:04', '2024-11-05 21:48:04');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_12_193908_create_categories_table', 1),
(7, '2024_10_12_213004_create_products_table', 1),
(8, '2024_10_12_213005_create_ sizes_table', 1),
(9, '2024_10_12_213010_create_ quantities_table', 1),
(10, '2024_10_14_164451_create_specefications_table', 2),
(11, '2024_10_12_213006_create_products_table', 3),
(12, '2024_10_12_213011_create_ quantities_table', 3),
(13, '2024_10_14_164451_create_specifications_table', 4),
(14, '2024_10_16_111400_create_category_product_table', 4),
(15, '2024_10_18_143254_create_sliders_table', 5),
(16, '2024_10_19_075559_add_views_count_to_products_table', 6),
(17, '2024_10_19_080020_add_views_count_to_products_table', 7),
(18, '2024_10_19_103738_create_sections_table', 8),
(19, '2024_10_20_083049_create_customers_table', 9),
(20, '2024_10_20_083404_create_orders_table', 9),
(21, '2024_10_22_102807_create_site_settings_table', 10),
(22, '2024_10_23_112915_create_admin_orders_table', 11),
(23, '2024_10_23_200558_create_order_items_table', 12),
(24, '2024_10_23_200727_create_addresses_table', 13),
(25, '2024_10_23_200808_create_payments_table', 13),
(26, '2024_10_20_083404_create_order_table', 14),
(27, '2024_10_20_083404_creates_orders_table', 15),
(28, '2024_10_23_200558_create_order_item_table', 16),
(29, '2024_10_23_200727_create_addresse_table', 16),
(30, '2024_10_23_200808_create_payment_table', 16),
(32, '2024_10_24_174751_create_transactions_table', 17),
(33, '2024_10_25_173148_create_order_product_table', 18),
(34, '2024_10_20_083049_create_customerss_table', 19),
(35, '2024_10_26_230150_add_customer_id_to_orders_table', 20),
(36, '2024_10_25_173148_create_order_products_table', 21),
(37, '2024_10_25_173148_create_order_productss_table', 22),
(38, '2024_10_27_233458_create_orders_table', 22),
(39, '2024_10_25_173144_create_order_products_table', 23),
(40, '2024_10_29_001533_create_deliveries_table', 24);

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(78, 48, 68, 1, 1, NULL, NULL),
(79, 49, 68, 1, 1, NULL, NULL),
(80, 49, 68, 2, 1, NULL, NULL),
(81, 50, 67, 4, 1, NULL, NULL),
(82, 50, 66, 4, 1, NULL, NULL),
(83, 51, 67, 1, 1, NULL, NULL),
(84, 52, 68, 4, 1, NULL, NULL),
(85, 53, 54, 4, 1, NULL, NULL),
(86, 54, 68, 1, 1, NULL, NULL),
(87, 55, 68, 2, 1, NULL, NULL),
(88, 56, 66, 3, 2, NULL, NULL),
(89, 57, 66, 3, 2, NULL, NULL),
(90, 58, 67, 4, 1, NULL, NULL),
(91, 58, 54, 5, 2, NULL, NULL),
(92, 59, 67, 4, 1, NULL, NULL),
(93, 60, 66, 5, 1, NULL, NULL),
(94, 61, 68, 2, 1, NULL, NULL),
(95, 62, 66, 4, 1, NULL, NULL),
(96, 63, 68, 2, 1, NULL, NULL),
(97, 66, 67, 1, 2, NULL, NULL),
(98, 66, 54, 3, 1, NULL, NULL),
(99, 67, 69, 1, 1, NULL, NULL),
(100, 68, 66, 3, 1, NULL, NULL),
(101, 69, 54, 4, 1, NULL, NULL),
(102, 70, 66, 4, 1, NULL, NULL),
(103, 71, 67, 4, 1, NULL, NULL),
(104, 72, 67, 4, 2, NULL, NULL),
(105, 72, 54, 4, 2, NULL, NULL),
(106, 74, 67, 4, 2, NULL, NULL),
(107, 74, 54, 4, 2, NULL, NULL),
(108, 75, 66, 3, 1, NULL, NULL),
(109, 75, 54, 5, 2, NULL, NULL),
(110, 76, 66, 4, 1, NULL, NULL),
(111, 77, 69, 2, 1, NULL, NULL),
(112, 78, 69, 2, 1, NULL, NULL),
(113, 79, 69, 1, 1, NULL, NULL);

INSERT INTO `orders` (`id`, `ref`, `user_id`, `name`, `email`, `phone`, `address`, `status`, `terms`, `created_at`, `updated_at`) VALUES
(48, 'ws0291e79c', 2, 'Faisal Hasan', 'faisalone.bd@gmail.com', '01710541719', '49, Software Technology Park, Jana Tower', 3, 1, '2024-10-31 07:27:29', '2024-10-31 07:27:48'),
(49, 'wscf89a6ea', NULL, 'Faisal Hasan', 'abc@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-10-31 12:36:32', '2024-10-31 13:46:07'),
(50, 'ws487026dd', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 13:39:17', '2024-10-31 13:40:42'),
(51, 'ws4825a388', 2, 'Faisal Hasan', 'faisal@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 14:03:28', '2024-10-31 14:04:34'),
(52, 'wsda6262ea', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-10-31 14:06:36', '2024-10-31 14:07:40'),
(53, 'ws8d304b42', 2, 'Faisal Hasan', 'faisalone.bd@gmail.com', '01710541719', '49, Software Technology Park, Jana Tower', 3, 1, '2024-10-31 14:11:44', '2024-10-31 14:12:04'),
(54, 'wsb3576180', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 14:17:24', '2024-10-31 14:17:44'),
(55, 'ws62c27af3', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-10-31 14:27:20', '2024-10-31 14:27:37'),
(56, 'ws2f74a55a', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 14:32:57', '2024-10-31 14:34:22'),
(57, 'ws71c050df', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-10-31 14:40:00', '2024-10-31 14:40:54'),
(58, 'wsf9251b4b', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 14:44:45', '2024-10-31 14:45:48'),
(59, 'ws4ad63334', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 14:51:30', '2024-10-31 14:52:21'),
(60, 'wsd9289064', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 14:56:32', '2024-10-31 14:57:19'),
(61, 'wsc518a856', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-10-31 16:53:36', '2024-10-31 16:55:09'),
(62, 'wscf6e9301', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-10-31 16:59:28', '2024-10-31 17:00:34'),
(63, 'ws89b5d26d', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-10-31 17:09:37', '2024-10-31 17:09:37'),
(64, 'ws1f0ee3db', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-10-31 17:13:03', '2024-10-31 17:13:03'),
(65, 'ws72c03900', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-10-31 17:13:21', '2024-10-31 17:13:21'),
(66, 'ws577e3447', NULL, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-01 23:47:07', '2024-11-01 23:47:25'),
(67, 'ws69e31a59', NULL, 'Alifa Akter', 'alifatelco@gmail.com', '01783290065', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-11-01 23:53:30', '2024-11-01 23:55:12'),
(68, 'ws7f5a5c61', NULL, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-02 00:24:36', '2024-11-02 00:24:46'),
(69, 'wsb07dbe78', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-02 00:26:35', '2024-11-02 00:26:43'),
(70, 'ws8e383164', 2, 'Faisal', 'abc@xyz.com', '01710541719', 'Barabhita', 2, 1, '2024-11-02 00:42:49', '2024-11-02 00:42:58'),
(71, 'ws510f1952', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-02 00:57:40', '2024-11-02 00:57:49'),
(72, 'ws02299bde', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-02 01:45:59', '2024-11-02 15:44:12'),
(73, 'ws46b0b96b', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-02 01:50:09', '2024-11-02 01:50:09'),
(74, 'ws421d9884', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-02 01:51:44', '2024-11-02 01:52:26'),
(75, 'ws0ade7ca0', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 2, 1, '2024-11-02 02:55:38', '2024-11-02 02:56:33'),
(76, 'wsb8a2c6d6', NULL, 'Pairul Islam', 'pairul@gmail.com', '01722255467', 'Barabhita, Kishoreganj', 3, 1, '2024-11-02 19:30:40', '2024-11-02 20:38:47'),
(77, 'wsda6f7c62', NULL, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-03 16:01:33', '2024-11-03 16:02:05'),
(78, 'wsd3339530', NULL, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 2, 1, '2024-11-05 19:50:22', '2024-11-05 19:51:13'),
(79, 'ws139ddc0c', NULL, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 2, 1, '2024-11-05 21:48:04', '2024-11-05 21:48:23');

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('hello@oyelab.com', '$2y$10$x.5iUoK1em11HyR9M1xF8.aMfI53iIU7AyfLNNJewGlkiWtBo2WDS', '2024-10-21 08:38:21'),
('me@faisal.one', '$2y$10$5lwbQG1uK3GegD9yAYFEHe/xOg9eW.90YVKYw46Tk7.wAxm6/Z.9i', '2024-10-21 08:21:20');

INSERT INTO `products` (`id`, `title`, `slug`, `price`, `sale`, `description`, `specifications`, `images`, `meta_title`, `keywords`, `meta_desc`, `og_image`, `status`, `created_at`, `updated_at`, `views`) VALUES
(41, 'Official Home Jersey 2024  Bangladesh National Football Team', 'official-home-jersey-2024-bangladesh-national-football-team', 700.00, 25, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Official Home Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Bangladesh National Football Team</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">This is the Current official Home Jersey of the Bangladesh National Football Team, The Premium Quality Authentic Jersey is smooth and comfortable. The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', NULL, '[\"official-home-jersey-2024-bangladesh-national-football-team-1.jpg\", \"official-home-jersey-2024-bangladesh-national-football-team-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 12:43:56', '2024-10-17 20:14:45', 100),
(42, 'Maradona 10  Concept Fan Jersey 2024', 'maradona-10-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Maradona 10</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"maradona-10-concept-fan-jersey-2024-1.jpg\", \"maradona-10-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 13:30:17', '2024-10-17 20:07:39', 50),
(43, 'Football King Pele! Concept Fan jersey 2024', 'football-king-pele-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Football King Pele!</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Concept Fan jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"football-king-pele-concept-fan-jersey-2024-1.jpg\", \"football-king-pele-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 13:57:52', '2024-10-18 10:09:23', 10),
(44, 'MANCHESTER IS BLUE!!  MANCHESTER CITY CONCEPT', 'manchester-is-blue-manchester-city-concept', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Manchester is Blue!!</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Manchester City Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"2\", \"4\"]', '[\"manchester-is-blue-manchester-city-concept-1.jpg\", \"manchester-is-blue-manchester-city-concept-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 14:15:03', '2024-10-17 20:03:24', 15),
(45, 'GLORY GLORY MAN UNITED!!  MANCHESTER UNITED  CONCEPT FAN JERSEY 2024', 'glory-glory-man-united-manchester-united-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">GLORY GLORY MAN UNITED!!</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">MANCHESTER UNITED</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">CONCEPT FAN JERSEY 2024</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">#Glory Glory Man United!!</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">#Manchester United Concept Fan Jersey 2024</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"glory-glory-man-united-manchester-united-concept-fan-jersey-2024-1.jpg\", \"glory-glory-man-united-manchester-united-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-16 05:39:49', '2024-10-17 20:00:33', 20),
(46, 'VISCA BARÇA!! FC BARCELONA CONCEPT FAN JERSEY 2024', 'visca-barca-fc-barcelona-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Visca Barça!!</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#FC Barcelona Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"visca-barca-fc-barcelona-concept-fan-jersey-2024-1.jpg\", \"visca-barca-fc-barcelona-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, 'new-this-is-product-title-og.jpg', 1, '2024-10-16 05:53:59', '2024-10-17 19:58:40', 30),
(54, 'Hala Madrid - Real Madrid Concept Fan Jersey', 'hala-madrid-real-madrid-concept-fan-jersey', 700.00, 25, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Hala Madrid!!</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Real Madrid Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"hala-madrid-real-madrid-concept-fan-jersey-1.jpg\", \"hala-madrid-real-madrid-concept-fan-jersey-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-16 11:54:10', '2024-10-19 20:36:55', 50),
(66, 'Black and White Kit for Chesham FC', 'black-and-white-kit-for-chesham-fc', 800.00, NULL, '<p><span style=\"font-size: 14.8px;\">Striking the perfect balance of tradition and flair! Check out the new black and white kit for Chesham FC, crafted by Wings Sportswear. ⚽️💥&nbsp;&nbsp;</span></p><p><span style=\"font-size: 14.8px;\">#OnTheRise #NewBeginnings #CheshamFC #WingsSportswear #NewKit</span></p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"black-and-white-kit-for-chesham-fc-1.jpg\"]', NULL, NULL, NULL, NULL, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38', 10),
(67, 'Striking purple and white look', 'striking-purple-and-white-look', 1500.50, 25, '<h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\">Striking purple and white look</font></span></b></h1><h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\"><br></font></span></b></h1><h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\"><br></font></span></b></h1><p><span style=\"font-size: 14.8px;\">We look forward to working for your team and are committed to providing your team with the highest quality, contemporary, creatively designed sportswear. Please get in touch with us. We are waiting for you.</span></p><p><span style=\"font-size: 14.8px;\">#OldMansFC #KitReveal #WingsSportswear</span></p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"striking-purple-and-white-look-4.jpg\", \"striking-purple-and-white-look-5.jpg\", \"striking-purple-and-white-look-6.jpg\", \"striking-purple-and-white-look-7.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-19 01:06:43', '2024-10-23 10:55:53', 11),
(68, 'Old Man\'s FC Official Jersey', 'old-mans-fc-official-jersey', 2550.00, NULL, '<p><span style=\"font-size: 14.8px;\">Old Man\'s FC is ready to turn heads with our brand-new kit design! 🟣⚪️</span></p><p><span style=\"font-size: 14.8px;\"><br></span></p><p><span style=\"font-size: 14.8px;\">Say hello to our striking purple and white look, crafted with care by Wings Sportswear. We can’t wait to hit the pitch in style—are you ready to join us? Let the games begin!</span></p><p><span style=\"font-size: 14.8px;\"><br></span></p><p><span style=\"font-size: 14.8px;\">#OldMansFC #KitReveal #WingsSportswear</span></p>', '[\"1\", \"2\", \"3\", \"4\"]', '[\"old-mans-fc-official-jersey-1.jpg\"]', NULL, NULL, NULL, 'old-mans-fc-official-jersey-og.jpg', 1, '2024-10-19 01:09:48', '2024-10-23 10:26:32', 3),
(69, 'This is new product with testing issues!', 'this-is-new-product-with-testing-issues', 1800.00, 50, '<p>New Description</p>', NULL, '[\"this-is-new-product-with-testing-issues-1.jpg\", \"this-is-new-product-with-testing-issues-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-21 10:47:48', '2024-10-26 15:11:33', NULL);

INSERT INTO `quantities` (`id`, `product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(181, 41, 1, 100, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(182, 41, 2, 200, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(183, 41, 3, 300, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(184, 41, 4, 400, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(185, 41, 5, 100, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(187, 42, 1, 100, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(188, 42, 2, 100, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(189, 42, 3, 100, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(190, 42, 4, 50, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(191, 42, 5, 50, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(193, 43, 1, 200, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(194, 43, 2, 100, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(195, 43, 3, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(196, 43, 4, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(197, 43, 5, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(199, 44, 1, 200, '2024-10-15 14:15:03', '2024-10-15 14:15:03'),
(200, 44, 2, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(201, 44, 3, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(202, 44, 4, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(203, 44, 5, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(205, 45, 1, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(206, 45, 2, 200, '2024-10-16 05:39:49', '2024-10-16 05:39:49'),
(207, 45, 3, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(208, 45, 4, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(209, 45, 5, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(211, 46, 1, 100, '2024-10-16 05:53:59', '2024-10-17 19:58:40'),
(212, 46, 2, 220, '2024-10-16 05:53:59', '2024-10-16 05:53:59'),
(213, 46, 3, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(214, 46, 4, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(215, 46, 5, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(283, 54, 1, 0, '2024-10-16 21:47:37', '2024-10-31 02:00:40'),
(284, 54, 2, 9, '2024-10-16 21:47:37', '2024-10-31 02:03:56'),
(285, 54, 3, 9, '2024-10-16 21:47:37', '2024-11-01 23:47:07'),
(286, 54, 4, 3, '2024-10-16 21:47:37', '2024-11-02 01:51:44'),
(287, 54, 5, 5, '2024-10-16 21:47:37', '2024-11-02 02:55:38'),
(295, 66, 1, 0, '2024-10-19 01:03:45', '2024-10-31 02:00:40'),
(296, 66, 2, 8, '2024-10-19 01:03:45', '2024-10-31 02:03:56'),
(297, 66, 3, 0, '2024-10-19 01:03:45', '2024-11-02 02:55:38'),
(298, 66, 4, 5, '2024-10-19 01:03:45', '2024-11-02 19:30:40'),
(299, 66, 5, 3, '2024-10-19 01:03:45', '2024-10-31 14:56:32'),
(301, 67, 1, 7, '2024-10-19 01:06:43', '2024-11-01 23:47:07'),
(302, 67, 2, 0, '2024-10-19 01:06:43', '2024-10-31 05:07:35'),
(303, 67, 3, 0, '2024-10-19 01:06:43', '2024-10-31 05:07:35'),
(304, 67, 4, 2, '2024-10-19 01:06:43', '2024-11-02 01:51:44'),
(307, 68, 1, 6, '2024-10-19 01:09:48', '2024-10-31 14:17:24'),
(308, 68, 2, 0, '2024-10-19 01:09:48', '2024-10-31 17:09:37'),
(309, 68, 3, 10, '2024-10-19 01:09:48', '2024-10-30 23:11:10'),
(310, 68, 4, 8, '2024-10-19 01:09:48', '2024-10-31 14:06:36'),
(313, 69, 1, 7, '2024-10-21 10:47:48', '2024-11-05 21:48:04'),
(314, 69, 2, 7, '2024-10-21 10:47:48', '2024-11-05 19:50:22'),
(315, 69, 3, 10, '2024-10-21 10:47:48', '2024-10-21 10:47:48'),
(316, 69, 4, 10, '2024-10-21 10:47:48', '2024-10-30 01:44:52'),
(317, 69, 5, 10, '2024-10-21 10:47:48', '2024-10-30 01:44:52');

INSERT INTO `sections` (`id`, `title`, `slug`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Latest', 'latest', 'latest', 1, NULL, NULL),
(2, 'Top Picks', 'top-picks', 'top_picks', 1, NULL, NULL),
(3, 'Trending', 'trending', 'trending', 1, NULL, NULL),
(9, 'Most Viewed', 'most-viewed', 'most_viewed', 1, NULL, NULL);

INSERT INTO `site_settings` (`id`, `title`, `description`, `keywords`, `og_image`, `logo_v1`, `logo_v2`, `favicon`, `email`, `phone`, `address`, `social_links`, `created_at`, `updated_at`) VALUES
(10, 'Wings Sportswear', 'Innovative sportswear that blends cutting-edge technology with sleek design. For athletes and active individuals who demand more. Discover high-performance apparel that supports your journey to greatness.', 'Wings, Sportswear, Jersey, Shop, Sports Shop, Sports Market, Buy Jersey, Sell Jersey', 'wings-preview.jpg', 'logo-dark.svg', 'logo-light.svg', 'favicon.ico', 'hello@wingssportswear.shop', '01886424141', 'South Mugda, Mugdapara, Dhaka-1214', '\"[{\\\"platform\\\":\\\"Facebook\\\",\\\"username\\\":\\\"Wingsbd00\\\"},{\\\"platform\\\":\\\"Instagram\\\",\\\"username\\\":\\\"wingssportswearbd\\\"},{\\\"platform\\\":\\\"X\\\",\\\"username\\\":\\\"wingssportswearbd\\\"},{\\\"platform\\\":\\\"YouTube\\\",\\\"username\\\":\\\"wingssportswear\\\"}]\"', '2024-10-22 18:44:41', '2024-10-22 21:46:38');

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'S', NULL, NULL),
(2, 'M', NULL, NULL),
(3, 'L', NULL, NULL),
(4, 'XL', NULL, NULL),
(5, 'XXL', NULL, NULL);

INSERT INTO `sliders` (`id`, `title`, `order`, `status`, `image`, `created_at`, `updated_at`) VALUES
(33, 'Keep Flying', NULL, 0, 'keep-flying.jpg', '2024-10-18 22:07:35', '2024-10-20 13:59:50'),
(36, 'Wings Edited', 3, 1, 'wings-edited.png', '2024-10-19 00:04:14', '2024-10-20 22:01:06'),
(37, 'Get Our Customised Sportwear', 2, 1, 'get-our-customised-sportwear.jpg', '2024-10-19 00:12:44', '2024-10-19 06:06:13'),
(38, 'Mohammedan Banner', 5, 1, 'mohammedan-banner.png', '2024-10-19 00:25:51', '2024-10-20 22:01:12'),
(39, 'New Slider', NULL, 0, 'new-slider.jpg', '2024-10-20 13:59:50', '2024-10-20 21:57:18'),
(40, 'Test Slider', 1, 1, 'test-slider.jpg', '2024-10-20 21:56:10', '2024-10-20 21:57:18');

INSERT INTO `specifications` (`id`, `item`, `created_at`, `updated_at`) VALUES
(1, 'Fully Digital Sublimation Printed.', NULL, NULL),
(2, 'Export Quality Double Knitted Fabrics', NULL, NULL),
(3, '150 GSM.', NULL, NULL),
(4, 'Regular Fit, Raglan Sleeve, Crew Neck.', NULL, NULL),
(5, 'Twin Needle Topstitch Swing.', NULL, NULL);

INSERT INTO `transactions` (`id`, `ref`, `order_id`, `val_id`, `subtotal`, `amount`, `shipping_charge`, `order_total`, `order_discount`, `payment_status`, `card_type`, `store_amount`, `card_no`, `bank_tran_id`, `status`, `tran_date`, `error`, `currency`, `card_issuer`, `card_brand`, `card_sub_brand`, `card_issuer_country`, `card_issuer_country_code`, `store_id`, `verify_sign`, `verify_key`, `verify_sign_sha2`, `currency_type`, `currency_amount`, `currency_rate`, `base_fair`, `value_a`, `value_b`, `value_c`, `value_d`, `subscription_id`, `risk_level`, `risk_title`, `created_at`, `updated_at`) VALUES
(149, 'ws0291e79c', 48, '2410317273382xskWRHpMbvs6g', 0.00, 2700.00, 150.00, 2550.00, NULL, 1, 'BKASH-BKash', 2632.50, NULL, '24103172733q5lcaEwqZbezOw0', 'VALID', '2024-10-31 07:27:29', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '85eaa4b16e6b72faf06b126a5a57c825', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'ca2872b94f19c5ad06e7b6ac39a6e002a2cf007e56d1861be43a0fa2fda89632', 'BDT', 2700.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 07:27:29', '2024-10-31 07:27:36'),
(150, 'wscf89a6ea', 49, '241031123641BkP83AfMTSktsR3', 0.00, 150.00, 150.00, 5100.00, NULL, 0, 'NAGAD-Nagad', 146.25, NULL, '2410311236411NyJRWCqFLHL7HR', 'VALID', '2024-10-31 12:36:33', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '30fd59db360b90f69ffee4637074b035', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '9b9ae4815ea58b4e71e8996c9da61bf025a222237c8ccb680105da5b78f6796e', 'BDT', 150.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 12:36:32', '2024-10-31 12:36:43'),
(151, 'ws487026dd', 50, '24103113392501xP2jPdaBLChko', 0.00, 1990.00, 65.00, 1925.00, NULL, 1, 'BKASH-BKash', 1940.25, NULL, '2410311339250vps3IyMUdvle3m', 'VALID', '2024-10-31 13:39:18', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '356191aa21c8697b2567ad236fad16f4', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'aaf4f0d314b2b155628402f097351dd7a54b04c5c8275d558df4c3f9e1630204', 'BDT', 1990.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 13:39:17', '2024-10-31 13:39:27'),
(152, 'ws4825a388', 51, '2410311403330cKZKtA1szQBTsD', 0.00, 60.00, 60.00, 1125.00, NULL, 0, 'NAGAD-Nagad', 58.50, NULL, '2410311403331l6G9p5dXWn6LxX', 'VALID', '2024-10-31 14:03:28', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'b449c21e9b211219a8dba9d0645d7d5c', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '00d2e340e46489fd541cedb04cc37cd249fa2dcc0d24ce5427dd5fbabc4f9da7', 'BDT', 60.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:03:28', '2024-10-31 14:03:36'),
(153, 'wsda6262ea', 52, '241031140641e1GSmWAzDvXQilX', 0.00, 2650.00, 100.00, 2550.00, NULL, 1, 'NAGAD-Nagad', 2583.75, NULL, '241031140641PIEx6KFWUD56tgW', 'VALID', '2024-10-31 14:06:37', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '15201569716508c9e8674b9e0f2e185e', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '279303181749129f758a36fabf8334bb1a0f9d6eff006f7ff58a246987aa704b', 'BDT', 2650.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:06:36', '2024-10-31 14:06:43'),
(154, 'ws8d304b42', 53, '2410311411510DHbIiZXkXzx657', 0.00, 625.00, 100.00, 525.00, NULL, 1, 'BKASH-BKash', 609.38, NULL, '241031141151jcCmGoyiRWYdpFs', 'VALID', '2024-10-31 14:11:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6b253d312cf90e9b4c8bba39b55cd98f', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0c02189f382485c4a3fd02f2eaabf2513503e51ba320b5724f3e86d614f67c57', 'BDT', 625.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:11:44', '2024-10-31 14:11:55'),
(155, 'wsb3576180', 54, '241031141729xUQ900hwm7LEJnm', 0.00, 100.00, 100.00, 2550.00, NULL, 0, 'DBBLMOBILEB-Dbbl Mobile Banking', 97.50, NULL, '2410311417297krJyhYmJAACfLF', 'VALID', '2024-10-31 14:17:24', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '62d2505bd25f13a0036f1f3cb655846b', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0fdddacdab17a3e8691de3651b598d7df853bc379cb4c18d5c1b7ea46047dfcb', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:17:24', '2024-10-31 14:17:31'),
(156, 'ws62c27af3', 55, '241031142724p9YJHNSdFmBizMm', 0.00, 2610.00, 60.00, 2550.00, NULL, 1, 'NAGAD-Nagad', 2544.75, NULL, '24103114272406FXPbkV5NgxzYS', 'VALID', '2024-10-31 14:27:20', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '213ac538851e4b3deb2c5d696f8c6895', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'd93364bdd18c191432c9bfc52d60ce0eea1ac371444b6f8ded2cc5a0bdc4d4f6', 'BDT', 2610.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:27:20', '2024-10-31 14:27:26'),
(157, 'ws2f74a55a', 56, '24103114331815WGrx0dAr7TMcL', 0.00, 1700.00, 100.00, 1600.00, NULL, 1, 'BKASH-BKash', 1657.50, NULL, '241031143318ppg1OnD4fw4HLM3', 'VALID', '2024-10-31 14:32:57', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6b01c63e3855a0a0c05fc8bfff55097a', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '8b960fe9f44b7d1d69180d6bf6fc7ff28db65af3300f5c90467b87d942cfd0a2', 'BDT', 1700.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:32:57', '2024-10-31 14:33:20'),
(158, 'ws71c050df', 57, '241031144008Wg3OR0izZXgYQ8T', 0.00, 1700.00, 100.00, 1600.00, NULL, 1, 'DBBLMOBILEB-Dbbl Mobile Banking', 1657.50, NULL, '241031144008aXypgncZrJDJqJP', 'VALID', '2024-10-31 14:40:00', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '15f2656bb9ffedf4a87670e7b0206c2a', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '63e4c518733b3b7170abfcc170c09cc75d4483c90348ee8920dc2c8b900557d0', 'BDT', 1700.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:40:00', '2024-10-31 14:40:10'),
(159, 'wsf9251b4b', 58, '241031144452inNQhnLF0zzStzU', 0.00, 2275.00, 100.00, 2175.00, NULL, 1, 'BKASH-BKash', 2218.13, NULL, '241031144452ua8usYaRubTPBHJ', 'VALID', '2024-10-31 14:44:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '54ac90d9d1407f4deb8a6ba839957516', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '36cbbd7d71caa19914d334d9a86502de0a763ad48d8e13ecf5423dc7c74c1d94', 'BDT', 2275.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:44:45', '2024-10-31 14:44:55'),
(160, 'ws4ad63334', 59, '2410311451431V3vlQEHAuucG3u', 0.00, 100.00, 100.00, 1125.00, NULL, 0, 'BKASH-BKash', 97.50, NULL, '241031145143prNg9p3WM4HydA1', 'VALID', '2024-10-31 14:51:30', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'bb23027e0631595bd6e1fa7e818484dd', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0468e9b6fcac0643d826dc46c0b9c28d805fb2612872df12f1714b46bf443442', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:51:30', '2024-10-31 14:51:46'),
(161, 'wsd9289064', 60, '2410311456401xZxKhZcZgNyh44', 0.00, 100.00, 100.00, 800.00, NULL, 0, 'NAGAD-Nagad', 97.50, NULL, '2410311456400zOjaOREXk8uJm5', 'VALID', '2024-10-31 14:56:32', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '05d0a0cc54bffe8c673e46ff1be0dbe0', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'df706c89c8217c1577e19d939bc86433a6b29cf9c089839b1bced6f2f10008a7', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:56:32', '2024-10-31 14:56:43'),
(162, 'wsc518a856', 61, '241031165354OYqmzcNKbpkTUlP', 0.00, 100.00, 100.00, 2550.00, NULL, 0, 'BKASH-BKash', 97.50, NULL, '241031165354pFdPLWp49Lkm0EN', 'VALID', '2024-10-31 16:53:36', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'f2f19603e03fc774daccb22628e27502', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '836847f041d982439e0cf7e8fadb404bed2cd3497d2e78f2acaa67ec2750cec1', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 16:53:36', '2024-10-31 16:53:56'),
(163, 'wscf6e9301', 62, '2410311659410o54Sb0WhkgAPK7', 0.00, 100.00, 100.00, 800.00, NULL, 0, 'DBBLMOBILEB-Dbbl Mobile Banking', 97.50, NULL, '24103116594118eI6x2DN91qMFZ', 'VALID', '2024-10-31 16:59:28', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '8e272d5bbdea114e305002deea019af7', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '12aa7d0be7db78e7c040c9228c4707afc5295f398209bc98d0b454ffeab78013', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 16:59:28', '2024-10-31 16:59:43'),
(164, 'ws89b5d26d', 63, NULL, NULL, NULL, 100.00, 2550.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31 17:09:37', '2024-10-31 17:09:37'),
(165, 'ws1f0ee3db', 64, NULL, NULL, NULL, 100.00, 7650.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31 17:13:03', '2024-10-31 17:13:03'),
(166, 'ws72c03900', 65, NULL, NULL, NULL, 100.00, 7650.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31 17:13:21', '2024-10-31 17:13:21'),
(167, 'ws577e3447', 66, '2411012347220FG14lp390T6oSz', 0.00, 100.00, 100.00, 2775.00, NULL, 0, 'NAGAD-Nagad', 97.50, NULL, '2411012347220BsCD1vf8TYWsHV', 'VALID', '2024-11-01 23:47:09', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6e3842aefc088ba01c8d0091b53c33db', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'dd25adf4c3041663aafc708d5498764bbdd6034990972d2becf58f7c0d9de99e', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-01 23:47:07', '2024-11-01 23:47:25'),
(168, 'ws69e31a59', 67, '241101235338ulY1qG2sUzyHyy5', 0.00, 1000.00, 100.00, 900.00, NULL, 1, 'BKASH-BKash', 975.00, NULL, '2411012353380ljft4bpiW9XwfZ', 'VALID', '2024-11-01 23:53:30', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'abd4ac5be4d8cb09cab9ce589287309c', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'ae32129e36456692962580da019b7937f9fefff83f318338415974228a76af14', 'BDT', 1000.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-01 23:53:30', '2024-11-01 23:53:42'),
(169, 'ws7f5a5c61', 68, '24110202444twUzZUax34aLIHB', 0.00, 900.00, 100.00, 800.00, NULL, 1, 'NAGAD-Nagad', 877.50, NULL, '24110202444iKrYx3T9UBRaxVJ', 'VALID', '2024-11-02 00:24:37', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '2ebaced4df164781b389e188ef764d3f', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '07b8c67882e1bdb93c24879e5cb0904ae28ae94464616476c01e537026e42b17', 'BDT', 900.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:24:36', '2024-11-02 00:24:46'),
(170, 'wsb07dbe78', 69, '24110202641eUqTN7ID5E93ytz', 0.00, 100.00, 100.00, 525.00, NULL, 0, 'DBBLMOBILEB-Dbbl Mobile Banking', 97.50, NULL, '241102026410qbV8vxeAs0ZKJm', 'VALID', '2024-11-02 00:26:35', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'eb6c91eb13de745cd2c99632c78a5ede', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'd4463cc2e8979ff7ef0b73eabf96b731d09508cc67273c2148ca8dd4ceb61cfc', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:26:35', '2024-11-02 00:26:43'),
(171, 'ws8e383164', 70, '24110204255TgbkLL4gYFCEhAd', 0.00, 900.00, 100.00, 800.00, NULL, 1, 'NAGAD-Nagad', 877.50, NULL, '241102042551rpGuEXvjLq6yp8', 'VALID', '2024-11-02 00:42:49', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '75440355f323b458b7b76b0ac720af37', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '1986f3bb1bde833b08228982ff3ab5068c38ae482985bd0c66087f3926fecd11', 'BDT', 900.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:42:49', '2024-11-02 00:42:58'),
(172, 'ws510f1952', 71, '241102057461fv6H2sgWsCwRmc', 0.00, 1225.00, 100.00, 1125.00, 500.00, 1, 'NAGAD-Nagad', 1194.38, NULL, '241102057461sTizqc2AC4okJv', 'VALID', '2024-11-02 00:57:41', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '2283001862b64bdaa9dc66690414b4f8', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '4637518e84121fdcb879bccd33c37ad9a42641afbfe69420a6ecc9feed8f7c73', 'BDT', 1225.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:57:40', '2024-11-02 00:57:49'),
(173, 'ws02299bde', 72, '241102146291adOTYAPGxZ4VBW', NULL, 60.00, 60.00, 3300.00, NULL, 0, 'NAGAD-Nagad', 58.50, NULL, '24110214629nENnrIXmVBaC8qK', 'VALID', '2024-11-02 01:46:00', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'b111d783c0e1436427b0f7237d1bafa2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'c087f1f6081a7fe9f8264ca0987aee00d07aad4644bed818f20d26b0ae6ae409', 'BDT', 60.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 01:45:59', '2024-11-02 15:44:12'),
(174, 'ws421d9884', 74, '241102151511ohUvmAnu6PJNjw', 0.00, 100.00, 100.00, 3300.00, 1101.00, 0, 'BKASH-BKash', 97.50, NULL, '241102151511Q81hg9eqCHXXj4', 'VALID', '2024-11-02 01:51:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '93c433cca59bf171d57a3650931277e9', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '455f5806ef8efec2f2364ec70f1e0cf4b569f59f3c7b53c0c33bfa9abe81db55', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 01:51:44', '2024-11-02 01:52:26'),
(175, 'ws0ade7ca0', 75, '24110225544z9apgHIoGitiEKV', 2200.00, 100.00, 100.00, 1850.00, 350.00, 0, 'NAGAD-Nagad', 97.50, NULL, '241102255440sfCZoOrUC6d9Jp', 'VALID', '2024-11-02 02:55:38', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'c25f3ec58076fee257f6a2297295c706', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '1640941f277c8ccf17608d47ac2f8b1179d6f2c28f4726e222f4afc567176839', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 02:55:38', '2024-11-02 02:56:33'),
(176, 'wsb8a2c6d6', 76, '2411021930520KU3Jfxbnv280HC', 800.00, 900.00, 100.00, 800.00, 0.00, 1, 'DBBLMOBILEB-Dbbl Mobile Banking', 877.50, NULL, '241102193052lN2GY9mSD7ZVtTG', 'VALID', '2024-11-02 19:30:41', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'ae127f09fdaaedce72f978219b4dfcdd', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '7fcc076a903de77bb6a5053e620b0e2210ac55992ab94438f6cdc8c1e3f23440', 'BDT', 900.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 19:30:40', '2024-11-02 19:30:55'),
(177, 'wsda6f7c62', 77, '2411031602027wEwje8pSAv86N5', 1800.00, 100.00, 100.00, 900.00, 900.00, 0, 'NAGAD-Nagad', 97.50, NULL, '2411031602021GRhd4NUvhoV2X8', 'VALID', '2024-11-03 16:01:34', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'd0b5f3267af5e7e157d74913604618d2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '056fb21498e8a1cbdb2ac76e609298f64bbbb89c55f75e054f34131b9b52c0af', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-03 16:01:33', '2024-11-03 16:02:05'),
(178, 'wsd3339530', 78, '241105195110NcAfa5jMApkvmQX', 1800.00, 100.00, 100.00, 900.00, 900.00, 0, 'VISA-Dutch Bangla', 97.50, '432155******3964', '24110519511014bdAFGxhaDOjFL', 'VALID', '2024-11-05 19:50:23', NULL, 'BDT', 'STANDARD CHARTERED BANK', 'VISA', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '772d7d1edaa6c106e99dcc08eef69068', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '082cb15f1e52d37d250e873972b3275b09faf9bd5ba2d5079559718518faa0fc', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-05 19:50:22', '2024-11-05 19:51:13'),
(179, 'ws139ddc0c', 79, '2411052148210zznL6nle7g0HIo', 1800.00, 100.00, 100.00, 900.00, 900.00, 0, 'BKASH-BKash', 97.50, NULL, '2411052148215TSIB3dMVHUwoWZ', 'VALID', '2024-11-05 21:48:04', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'be164ef3140a1e1740461c126f6ec4e2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '8028da51dab8e8c53d81349de1b8e98074da15a1d8dffffd8457027b69fd6b9e', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-05 21:48:04', '2024-11-05 21:48:23');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Faisal', 'me@faisal.one', NULL, '$2y$10$zCzYfpLZR3NrRw4fW0mkp.ONCdNDKmbS6xDPNmH.ffcuplMUMgcwG', 'feZSeZ1Ui8QF0fyD4vbq8ydY4FoTVdIouXXURPt2xUmx9KqkBoRi9UXq5icu', '2024-10-14 14:04:50', '2024-10-14 14:04:50'),
(3, 'Faisal', 'hello@oyelab.com', NULL, '$2y$10$XcTdlG7v5jZue3mgV/9nPuCncYLGTgUU7QIk6AqM7jI4Go256A/Z2', NULL, '2024-10-21 08:32:27', '2024-10-21 08:32:27'),
(4, 'Faisal Hasan', 'abc@xyz.com', NULL, '$2y$10$jUDcKZ1Dr7lD2oMF8Z/jveywmrHpYl3gathlrT2JU34ofwv1Yxzc.', NULL, '2024-10-27 11:59:39', '2024-10-27 11:59:39');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;