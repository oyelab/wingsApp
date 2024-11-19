-- -------------------------------------------------------------
-- TablePlus 6.1.8(574)
--
-- https://tableplus.com/
--
-- Database: webadmin_laravel
-- Generation Time: 2024-11-20 04:44:28.4680
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
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `category_parent`;
CREATE TABLE `category_parent` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `child_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_parent_category_id_foreign` (`child_id`),
  KEY `category_parent_parent_id_foreign` (`category_id`),
  CONSTRAINT `category_parent_category_id_foreign` FOREIGN KEY (`child_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_parent_parent_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE `category_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_product_product_id_foreign` (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `subcategory_id` (`subcategory_id`),
  CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` tinyint DEFAULT '1',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `product_review`;
CREATE TABLE `product_review` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `review_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_review_product_id_foreign` (`product_id`),
  KEY `product_review_review_id_product_id_unique` (`review_id`,`product_id`) USING BTREE,
  CONSTRAINT `product_review_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_review_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=345 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` decimal(10,1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_user_id_foreign` (`user_id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopeMethod` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `voucher` decimal(10,2) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `vouchers`;
CREATE TABLE `vouchers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int NOT NULL,
  `max_product` int DEFAULT NULL,
  `min_quantity` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vouchers_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `title`, `slug`, `image`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Wings Edited', 'wings-edited', 'wings-edited.png', 'Discover our exclusive selection of meticulously crafted products, refined to reflect the essence of Wings. Every piece in this collection is carefully edited to offer you the finest quality and unique style that stands out.', 1, '2024-10-19 09:56:36', '2024-11-16 18:03:56'),
(2, 'Official Jersey', 'official-jersey', 'official-jersey.png', 'Our official jersey will be displayed here.', 1, '2024-11-16 17:57:36', '2024-11-16 17:57:36'),
(3, 'Concept Jersey', 'concept-jersey', 'unofficial-jersey.png', 'Our unofficial jersey will be displayed here.', 1, '2024-11-16 17:57:36', '2024-11-17 04:22:07'),
(27, 'Football', 'football', 'football.png', 'Football jersey collections', 1, '2024-11-16 03:20:18', '2024-11-17 04:23:36'),
(37, 'Cricket', 'cricket', 'cricket.png', 'Cricket jersey collections.', 1, '2024-11-17 04:35:08', '2024-11-17 04:35:08');

INSERT INTO `category_parent` (`id`, `child_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 27, 1, NULL, NULL),
(2, 27, 2, NULL, NULL),
(26, 27, 3, NULL, NULL),
(27, 37, 1, NULL, NULL),
(28, 37, 2, NULL, NULL);

INSERT INTO `category_product` (`id`, `category_id`, `subcategory_id`, `product_id`, `created_at`, `updated_at`) VALUES
(99, 3, 27, 67, NULL, NULL),
(102, 2, 27, 66, NULL, NULL),
(103, 3, 27, 54, NULL, NULL),
(104, 3, 27, 46, NULL, NULL),
(105, 2, 27, 45, NULL, NULL),
(106, 2, 27, 44, NULL, NULL),
(107, 2, 27, 43, NULL, NULL),
(108, 2, 27, 42, NULL, NULL),
(109, 2, 37, 41, NULL, NULL),
(110, 1, 27, 76, NULL, NULL),
(111, 1, 37, 68, NULL, NULL);

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
(39, 79, 'ws139ddc0c', NULL, 'Pending', 100.00, 5, 534, NULL, NULL, NULL, '2024-11-05 21:48:04', '2024-11-05 21:48:04'),
(40, 80, 'ws100fbb65', NULL, 'Pending', 100.00, 1, 298, 3069, NULL, NULL, '2024-11-12 23:38:21', '2024-11-12 23:38:21'),
(41, 81, 'ws7e2119e7', NULL, 'Pending', 100.00, 39, 640, 10859, NULL, NULL, '2024-11-13 00:54:19', '2024-11-13 00:54:19'),
(42, 82, 'ws88e21b6f', NULL, 'Pending', 100.00, 62, 714, 14044, NULL, NULL, '2024-11-13 00:54:59', '2024-11-13 00:54:59'),
(43, 83, 'ws96931d9f', NULL, 'Pending', 100.00, 1, 1070, 20924, NULL, NULL, '2024-11-13 00:56:25', '2024-11-13 00:56:25'),
(44, 84, 'wsdb2641af', 'DT131124N7QQAL', 'Pending', 120.00, 62, 166, NULL, NULL, NULL, '2024-11-13 00:58:55', '2024-11-13 23:59:49'),
(45, 85, 'ws4fa6c456', NULL, 'Pending', 100.00, 39, 641, 4744, NULL, NULL, '2024-11-13 01:03:22', '2024-11-13 01:03:22'),
(46, 86, 'ws8871e781', NULL, 'Pending', 100.00, 34, 933, 15202, NULL, NULL, '2024-11-13 01:11:06', '2024-11-13 01:11:06'),
(47, 87, 'wsd4d8d45d', NULL, 'Pending', 100.00, 39, 640, 4742, NULL, NULL, '2024-11-13 12:14:58', '2024-11-13 12:14:58'),
(48, 88, 'ws1060ecd9', NULL, 'Pending', 100.00, 1, 1070, 20924, NULL, NULL, '2024-11-13 17:28:46', '2024-11-13 17:28:46'),
(49, 89, 'ws22c45e73', NULL, 'Pending', 100.00, 39, 641, NULL, NULL, NULL, '2024-11-13 17:32:11', '2024-11-13 17:32:11'),
(50, 90, 'ws2121187f', NULL, 'Pending', 100.00, 1, 1070, NULL, NULL, NULL, '2024-11-13 17:50:04', '2024-11-13 17:50:04'),
(51, 91, 'wscfc3cfd8', NULL, 'Pending', 100.00, 1, 1070, NULL, NULL, NULL, '2024-11-13 18:01:17', '2024-11-13 18:01:17'),
(52, 92, 'wsbaf3f45f', NULL, 'Pending', 100.00, 1, 1070, NULL, NULL, NULL, '2024-11-13 19:09:54', '2024-11-13 19:09:54'),
(53, 93, 'ws2d51f997', NULL, 'Pending', 100.00, 1, 1070, NULL, NULL, NULL, '2024-11-13 19:16:26', '2024-11-13 19:16:26'),
(54, 94, 'ws612003c5', NULL, 'Pending', 100.00, 1, 1070, NULL, NULL, NULL, '2024-11-13 19:17:43', '2024-11-13 19:17:43'),
(55, 95, 'ws37da5431', NULL, 'Pending', 100.00, 1, 1066, NULL, NULL, NULL, '2024-11-13 19:19:55', '2024-11-13 19:19:55'),
(56, 96, 'ws8de5dc66', NULL, 'Pending', 100.00, 1, 298, NULL, NULL, NULL, '2024-11-13 19:21:49', '2024-11-13 19:21:49'),
(57, 97, 'wsf12ceb1e', NULL, 'Pending', 100.00, 1, 303, NULL, NULL, NULL, '2024-11-13 19:27:37', '2024-11-13 19:27:37'),
(58, 98, 'wsb169f06f', NULL, 'Pending', 100.00, 39, 641, 10869, NULL, NULL, '2024-11-14 00:11:08', '2024-11-14 00:11:08'),
(59, 99, 'ws8ca81994', NULL, 'Pending', 100.00, 34, 931, 15143, NULL, NULL, '2024-11-14 02:32:37', '2024-11-14 02:32:37'),
(60, 100, 'wsf8d013ab', NULL, 'Pending', 100.00, 39, 642, NULL, NULL, NULL, '2024-11-14 03:12:20', '2024-11-14 03:12:20'),
(61, 102, 'wsfbf91628', NULL, 'Pending', 100.00, 62, 714, 18821, NULL, NULL, '2024-11-14 03:35:20', '2024-11-14 03:35:20'),
(62, 103, 'ws3313d070', NULL, 'Pending', 120.00, 62, 166, NULL, NULL, NULL, '2024-11-14 03:43:22', '2024-11-14 03:43:22'),
(63, 104, 'wsf2b8dd83', NULL, 'Pending', 120.00, 39, 590, NULL, NULL, NULL, '2024-11-14 03:45:47', '2024-11-14 03:45:47'),
(64, 105, 'wsd3e07b60', NULL, 'Pending', 120.00, 39, 641, NULL, NULL, NULL, '2024-11-15 02:24:41', '2024-11-15 02:24:41'),
(65, 106, 'wsc3524f03', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-15 03:50:24', '2024-11-15 03:50:24'),
(66, 107, 'ws81926583', NULL, 'Pending', 100.00, 39, 642, NULL, NULL, NULL, '2024-11-15 21:37:41', '2024-11-15 21:37:41'),
(67, 108, 'ws2d6fb3a2', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-15 21:39:25', '2024-11-15 21:39:25'),
(68, 109, 'wse7d35879', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-15 21:52:16', '2024-11-15 21:52:16'),
(69, 110, 'ws6b6510da', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-15 21:55:02', '2024-11-15 21:55:02'),
(70, 111, 'ws22ede10b', NULL, 'Pending', 120.00, 39, 641, NULL, NULL, NULL, '2024-11-16 01:39:30', '2024-11-16 01:39:30'),
(71, 112, 'wsd9980178', NULL, 'Pending', 120.00, 39, 641, NULL, NULL, NULL, '2024-11-16 01:41:13', '2024-11-16 01:41:13'),
(72, 114, 'ws6daac1b9', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-16 01:52:34', '2024-11-16 01:52:34'),
(73, 115, 'wsf905c3a4', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-16 02:05:02', '2024-11-16 02:05:02'),
(74, 116, 'ws157d61a0', NULL, 'Pending', 100.00, 44, 872, NULL, NULL, NULL, '2024-11-16 02:13:13', '2024-11-16 02:13:13'),
(75, 117, 'ws94bfc635', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-16 02:14:36', '2024-11-16 02:14:36'),
(76, 118, 'ws2711777c', NULL, 'Pending', 100.00, 62, 166, NULL, NULL, NULL, '2024-11-17 22:50:19', '2024-11-17 22:50:19'),
(77, 119, 'wse769455b', NULL, 'Pending', 100.00, 39, 643, 10866, NULL, NULL, '2024-11-19 03:56:53', '2024-11-19 03:56:53'),
(78, 120, 'ws20ca5236', NULL, 'Pending', 100.00, 39, 642, NULL, NULL, NULL, '2024-11-19 10:10:51', '2024-11-19 10:10:51'),
(79, 121, 'wsb3b69871', NULL, 'Pending', 100.00, 39, 640, NULL, NULL, NULL, '2024-11-20 01:40:15', '2024-11-20 01:40:15');

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
(40, '2024_10_29_001533_create_deliveries_table', 24),
(41, '2024_11_14_011215_create_vouchers_table', 25),
(42, '2024_11_17_025258_create_category_parent_table', 26),
(43, '2024_11_20_002822_create_reviews_table', 27),
(44, '2024_11_20_011128_create_product_review_table', 28);

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
(114, 80, 68, 3, 1, NULL, NULL),
(115, 81, 54, 5, 1, NULL, NULL),
(116, 82, 68, 4, 1, NULL, NULL),
(117, 83, 67, 4, 1, NULL, NULL),
(118, 84, 67, 4, 1, NULL, NULL),
(119, 85, 54, 3, 1, NULL, NULL),
(120, 86, 54, 3, 1, NULL, NULL),
(122, 88, 54, 5, 1, NULL, NULL),
(123, 89, 54, 5, 1, NULL, NULL),
(124, 90, 68, 4, 1, NULL, NULL),
(125, 91, 67, 1, 1, NULL, NULL),
(128, 94, 68, 4, 1, NULL, NULL),
(129, 95, 68, 4, 1, NULL, NULL),
(130, 96, 68, 4, 1, NULL, NULL),
(131, 97, 68, 4, 1, NULL, NULL),
(132, 98, 68, 1, 2, NULL, NULL),
(133, 98, 68, 3, 2, NULL, NULL),
(134, 98, 68, 4, 2, NULL, NULL),
(138, 102, 43, 2, 5, NULL, NULL),
(139, 102, 45, 2, 5, NULL, NULL),
(140, 103, 68, 1, 5, NULL, NULL),
(141, 103, 68, 2, 5, NULL, NULL),
(142, 103, 68, 3, 4, NULL, NULL),
(143, 104, 68, 1, 5, NULL, NULL),
(144, 104, 68, 2, 5, NULL, NULL),
(145, 104, 68, 3, 4, NULL, NULL),
(146, 105, 68, 1, 4, NULL, NULL),
(147, 105, 68, 2, 4, NULL, NULL),
(150, 106, 68, 1, 4, NULL, NULL),
(151, 106, 68, 2, 4, NULL, NULL),
(154, 106, 67, 1, 1, NULL, NULL),
(155, 107, 45, 2, 1, NULL, NULL),
(158, 110, 68, 2, 1, NULL, NULL),
(160, 111, 67, 1, 2, NULL, NULL),
(162, 112, 68, 1, 2, NULL, NULL),
(163, 112, 67, 1, 3, NULL, NULL),
(164, 114, 68, 1, 1, NULL, NULL),
(165, 115, 68, 1, 1, NULL, NULL),
(166, 116, 67, 1, 3, NULL, NULL),
(167, 116, 54, 1, 2, NULL, NULL),
(168, 117, 54, 1, 5, NULL, NULL),
(169, 118, 67, 2, 1, NULL, NULL),
(170, 119, 76, 1, 1, NULL, NULL),
(171, 120, 68, 2, 1, NULL, NULL),
(172, 121, 68, 2, 1, NULL, NULL),
(173, 121, 66, 2, 1, NULL, NULL);

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
(79, 'ws139ddc0c', NULL, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 2, 1, '2024-11-05 21:48:04', '2024-11-05 21:48:23'),
(80, 'ws100fbb65', 2, 'Kayum', 'kayum@ezzetech.com', '01710541718', 'Barabhita, Kishoreganj, Nilphamari', 3, 1, '2024-11-12 23:38:21', '2024-11-12 23:39:45'),
(81, 'ws7e2119e7', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-13 00:54:19', '2024-11-13 00:54:19'),
(82, 'ws88e21b6f', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-11-13 00:54:59', '2024-11-13 00:55:05'),
(83, 'ws96931d9f', 2, 'Faisal Hasan', 'faisalone.bd@gmail.com', '01710541719', '49, Software Technology Park, Jana Tower', 3, 1, '2024-11-13 00:56:25', '2024-11-13 00:56:31'),
(84, 'wsdb2641af', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 3, 1, '2024-11-13 00:58:55', '2024-11-13 23:59:49'),
(85, 'ws4fa6c456', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 3, 1, '2024-11-13 01:03:22', '2024-11-13 01:03:28'),
(86, 'ws8871e781', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 5, 1, '2024-11-13 01:11:06', '2024-11-13 01:11:13'),
(87, 'wsd4d8d45d', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 6, 1, '2024-11-13 12:14:58', '2024-11-13 12:15:49'),
(88, 'ws1060ecd9', 2, 'Faisal Hasan', 'faisalone.bd@gmail.com', '01710541719', '49, Software Technology Park, Jana Tower', 0, 1, '2024-11-13 17:28:46', '2024-11-13 17:28:46'),
(89, 'ws22c45e73', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 5, 1, '2024-11-13 17:32:11', '2024-11-13 17:40:59'),
(90, 'ws2121187f', NULL, 'Hasan', 'me@faisal.one', '01710541719', '159/16/B', 5, 1, '2024-11-13 17:50:04', '2024-11-13 17:50:11'),
(91, 'wscfc3cfd8', NULL, 'Faisal Hasan', 'faisalone.bd@gmail.com', '01710541719', '49, Software Technology Park, Jana Tower', 5, 1, '2024-11-13 18:01:17', '2024-11-13 18:02:02'),
(92, 'wsbaf3f45f', 2, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 0, 1, '2024-11-13 19:09:54', '2024-11-13 19:09:54'),
(93, 'ws2d51f997', 2, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 6, 1, '2024-11-13 19:16:26', '2024-11-13 19:16:34'),
(94, 'ws612003c5', 2, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 6, 1, '2024-11-13 19:17:43', '2024-11-13 19:17:49'),
(95, 'ws37da5431', 2, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 6, 1, '2024-11-13 19:19:55', '2024-11-13 19:20:09'),
(96, 'ws8de5dc66', 2, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 6, 1, '2024-11-13 19:21:49', '2024-11-13 19:21:55'),
(97, 'wsf12ceb1e', 2, 'Shapon Ahmed', 'info.wings2024@gmail.com', '01886424141', '77, South Mugda, Mugdapara', 5, 1, '2024-11-13 19:27:37', '2024-11-13 19:27:40'),
(98, 'wsb169f06f', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-14 00:11:08', '2024-11-14 00:11:16'),
(99, 'ws8ca81994', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 0, 1, '2024-11-14 02:32:37', '2024-11-14 02:32:37'),
(100, 'wsf8d013ab', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-14 03:12:20', '2024-11-14 03:12:20'),
(101, 'ws577ae918', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-14 03:30:23', '2024-11-14 03:30:23'),
(102, 'wsfbf91628', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 5, 1, '2024-11-14 03:35:20', '2024-11-14 03:37:42'),
(103, 'ws3313d070', NULL, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 6, 1, '2024-11-14 03:43:22', '2024-11-14 03:43:32'),
(104, 'wsf2b8dd83', NULL, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-14 03:45:47', '2024-11-14 03:45:47'),
(105, 'wsd3e07b60', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-15 02:24:41', '2024-11-15 02:24:41'),
(106, 'wsc3524f03', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-15 03:50:24', '2024-11-15 03:50:24'),
(107, 'ws81926583', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-15 21:37:41', '2024-11-15 21:37:41'),
(108, 'ws2d6fb3a2', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-15 21:39:24', '2024-11-15 21:39:34'),
(109, 'wse7d35879', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-15 21:52:16', '2024-11-15 21:52:25'),
(110, 'ws6b6510da', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-15 21:55:02', '2024-11-15 21:55:09'),
(111, 'ws22ede10b', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-16 01:39:30', '2024-11-16 01:39:39'),
(112, 'wsd9980178', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-16 01:41:13', '2024-11-16 01:41:23'),
(113, 'ws00b12ced', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 0, 1, '2024-11-16 01:51:58', '2024-11-16 01:51:58'),
(114, 'ws6daac1b9', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-16 01:52:34', '2024-11-16 01:53:43'),
(115, 'wsf905c3a4', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-16 02:05:02', '2024-11-16 02:05:08'),
(116, 'ws157d61a0', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-16 02:13:13', '2024-11-16 02:13:20'),
(117, 'ws94bfc635', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-16 02:14:36', '2024-11-16 02:14:42'),
(118, 'ws2711777c', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'House: 180/E, Road: 3, Lakeview Abashik Area', 2, 1, '2024-11-17 22:50:19', '2024-11-17 22:50:29'),
(119, 'wse769455b', 5, 'Shapon Ahmed', 'abc@xyz.com', '01722255467', 'Barabhita', 2, 1, '2024-11-19 03:56:53', '2024-11-19 03:57:02'),
(120, 'ws20ca5236', NULL, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-19 10:10:51', '2024-11-19 10:10:58'),
(121, 'wsb3b69871', 2, 'Faisal Hasan', 'me@faisal.one', '01710541719', 'Uttar Barabhita, Barabhita, Kishoreganj', 2, 1, '2024-11-20 01:40:15', '2024-11-20 01:40:23');

INSERT INTO `pages` (`id`, `title`, `slug`, `image`, `content`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about', NULL, '<p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 1, 1, NULL, NULL),
(2, 'Contact US', 'contact', '', 'Description of Contact US', 1, 1, '2024-10-19 09:56:36', '2024-11-16 18:03:56'),
(3, 'Privacy Policy', 'privacy-policy', NULL, '<p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 1, 1, NULL, NULL),
(4, 'Terms & Conditions', 'terms-conditions', '', '<p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 1, 1, '2024-11-16 17:57:36', '2024-11-17 04:22:07'),
(5, 'Refund & Return Policy', 'refund-return-policy', NULL, '<p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 1, 1, NULL, NULL),
(6, 'Submit Your Idea', 'submit-idea', NULL, '<h4>Orders &amp; Payment</h4><h4>How do I check my order status?\n</h4><p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 2, 1, NULL, NULL),
(7, 'Affiliate Program', 'affiliate', NULL, '<h4>Orders &amp; Payment</h4><h4>How do I check my order status?\n</h4><p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 2, 1, NULL, NULL),
(8, 'Career', 'career', NULL, '<h4>Orders &amp; Payment</h4><h4>How do I check my order status?\n</h4><p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 2, 1, NULL, NULL),
(9, 'Blog', 'blog', NULL, '<h4>Orders &amp; Payment</h4><h4>How do I check my order status?\n</h4><p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 2, 1, NULL, NULL),
(10, 'Help', 'help', NULL, '<h4>Orders &amp; Payment</h4><h4>How do I check my order status?\n</h4><p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 2, 1, NULL, NULL),
(11, 'FAQ', 'faq', '', '<h4>Orders &amp; Payment</h4><h4>How do I check my order status?\n</h4><p>\n											To check the status of your order,\n											including processing and shipping\n											updates, click here. You can check\n											your order status by logging in to\n											your My Account or by entering your\n											order number, email address and\n											billing zip code. Please note, once\n											your order has shipped, you will\n											receive an email with a tracking\n											number for all shipping and delivery\n											updates. For more information and\n											step-by-step instructions on how to\n											check your order, click here.\n										</p>', 3, 1, '2024-11-16 17:57:36', '2024-11-16 17:57:36');

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('hello@oyelab.com', '$2y$10$x.5iUoK1em11HyR9M1xF8.aMfI53iIU7AyfLNNJewGlkiWtBo2WDS', '2024-10-21 08:38:21'),
('me@faisal.one', '$2y$10$5lwbQG1uK3GegD9yAYFEHe/xOg9eW.90YVKYw46Tk7.wAxm6/Z.9i', '2024-10-21 08:21:20');

INSERT INTO `product_review` (`id`, `review_id`, `product_id`, `created_at`, `updated_at`) VALUES
(15, 11, 68, NULL, NULL),
(16, 12, 68, NULL, NULL),
(17, 13, 68, NULL, NULL),
(18, 14, 68, NULL, NULL),
(19, 15, 68, NULL, NULL),
(20, 16, 68, NULL, NULL),
(21, 16, 41, NULL, NULL),
(22, 17, 68, NULL, NULL);

INSERT INTO `products` (`id`, `title`, `slug`, `price`, `sale`, `description`, `specifications`, `images`, `meta_title`, `keywords`, `meta_desc`, `og_image`, `status`, `created_at`, `updated_at`, `views`) VALUES
(41, 'Official Home Jersey 2024  Bangladesh National Football Team', 'official-home-jersey-2024-bangladesh-national-football-team', 700.00, 25, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Official Home Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Bangladesh National Football Team</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">This is the Current official Home Jersey of the Bangladesh National Football Team, The Premium Quality Authentic Jersey is smooth and comfortable. The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', NULL, '[\"official-home-jersey-2024-bangladesh-national-football-team-1.jpg\", \"official-home-jersey-2024-bangladesh-national-football-team-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 12:43:56', '2024-11-18 19:03:52', 106),
(42, 'Maradona 10  Concept Fan Jersey 2024', 'maradona-10-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Maradona 10</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"maradona-10-concept-fan-jersey-2024-1.jpg\", \"maradona-10-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 13:30:17', '2024-11-18 00:51:17', 50),
(43, 'Football King Pele! Concept Fan jersey 2024', 'football-king-pele-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Football King Pele!</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Concept Fan jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"football-king-pele-concept-fan-jersey-2024-1.jpg\", \"football-king-pele-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 13:57:52', '2024-11-18 00:51:07', 10),
(44, 'MANCHESTER IS BLUE!!  MANCHESTER CITY CONCEPT', 'manchester-is-blue-manchester-city-concept', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Manchester is Blue!!</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Manchester City Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"2\", \"4\"]', '[\"manchester-is-blue-manchester-city-concept-1.jpg\", \"manchester-is-blue-manchester-city-concept-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 14:15:03', '2024-11-18 00:50:59', 15),
(45, 'GLORY GLORY MAN UNITED!!  MANCHESTER UNITED  CONCEPT FAN JERSEY 2024', 'glory-glory-man-united-manchester-united-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">GLORY GLORY MAN UNITED!!</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">MANCHESTER UNITED</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">CONCEPT FAN JERSEY 2024</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">#Glory Glory Man United!!</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">#Manchester United Concept Fan Jersey 2024</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"glory-glory-man-united-manchester-united-concept-fan-jersey-2024-1.jpg\", \"glory-glory-man-united-manchester-united-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-16 05:39:49', '2024-11-18 04:45:35', 40),
(46, 'VISCA BARÇA!! FC BARCELONA CONCEPT FAN JERSEY 2024', 'visca-barca-fc-barcelona-concept-fan-jersey-2024', 600.00, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Visca Barça!!</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#FC Barcelona Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"visca-barca-fc-barcelona-concept-fan-jersey-2024-1.jpg\", \"visca-barca-fc-barcelona-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, 'new-this-is-product-title-og.jpg', 1, '2024-10-16 05:53:59', '2024-11-19 22:53:27', 31),
(54, 'Hala Madrid - Real Madrid Concept Fan Jersey', 'hala-madrid-real-madrid-concept-fan-jersey', 700.00, 25, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Hala Madrid!!</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Real Madrid Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"hala-madrid-real-madrid-concept-fan-jersey-1.jpg\", \"hala-madrid-real-madrid-concept-fan-jersey-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-16 11:54:10', '2024-11-18 02:45:28', 53),
(66, 'Black and White Kit for Chesham FC', 'black-and-white-kit-for-chesham-fc', 800.00, NULL, '<p><span style=\"font-size: 14.8px;\">Striking the perfect balance of tradition and flair! Check out the new black and white kit for Chesham FC, crafted by Wings Sportswear. ⚽️💥&nbsp;&nbsp;</span></p><p><span style=\"font-size: 14.8px;\">#OnTheRise #NewBeginnings #CheshamFC #WingsSportswear #NewKit</span></p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"black-and-white-kit-for-chesham-fc-1.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-19 01:03:45', '2024-11-20 01:39:58', 15),
(67, 'Striking purple and white look', 'striking-purple-and-white-look', 1500.50, 25, '<h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\">Striking purple and white look</font></span></b></h1><h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\"><br></font></span></b></h1><h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\"><br></font></span></b></h1><p><span style=\"font-size: 14.8px;\">We look forward to working for your team and are committed to providing your team with the highest quality, contemporary, creatively designed sportswear. Please get in touch with us. We are waiting for you.</span></p><p><span style=\"font-size: 14.8px;\">#OldMansFC #KitReveal #WingsSportswear</span></p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"striking-purple-and-white-look-4.jpg\", \"striking-purple-and-white-look-5.jpg\", \"striking-purple-and-white-look-6.jpg\", \"striking-purple-and-white-look-7.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-19 01:06:43', '2024-11-19 22:55:14', 53),
(68, 'Old Man\'s FC Official Jersey', 'old-mans-fc-official-jersey', 2550.00, NULL, '<p><span style=\"font-size: 14.8px;\">Old Man\'s FC is ready to turn heads with our brand-new kit design! 🟣⚪️</span></p><p><span style=\"font-size: 14.8px;\"><br></span></p><p><span style=\"font-size: 14.8px;\">Say hello to our striking purple and white look, crafted with care by Wings Sportswear. We can’t wait to hit the pitch in style—are you ready to join us? Let the games begin!</span></p><p><span style=\"font-size: 14.8px;\"><br></span></p><p><span style=\"font-size: 14.8px;\">#OldMansFC #KitReveal #WingsSportswear</span></p>', '[\"1\", \"2\", \"3\", \"4\"]', '[\"old-mans-fc-official-jersey-1.jpg\"]', NULL, NULL, NULL, 'old-mans-fc-official-jersey-og.jpg', 1, '2024-10-19 01:09:48', '2024-11-20 01:39:38', 27),
(76, 'Bangladesh Football Jersey', 'bangladesh-football-jersey', NULL, NULL, '<p>This is jersey insert test.</p>', '[\"1\", \"2\", \"3\", \"5\"]', '[\"bangladesh-football-jersey-1.jpg\"]', 'This is meta title', '[\"meta title\"]', NULL, 'bangladesh-football-jersey-og.jpg', 1, '2024-11-17 18:57:23', '2024-11-20 01:39:46', NULL);

INSERT INTO `quantities` (`id`, `product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(181, 41, 1, 1000, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(182, 41, 2, 1000, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(183, 41, 3, 1000, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(184, 41, 4, 1000, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(185, 41, 5, 1000, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(187, 42, 1, 1000, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(188, 42, 2, 1000, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(189, 42, 3, 1000, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(190, 42, 4, 1000, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(191, 42, 5, 1000, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(193, 43, 1, 1000, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(194, 43, 2, 1000, '2024-10-15 13:57:52', '2024-11-14 03:37:42'),
(195, 43, 3, 1000, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(196, 43, 4, 1000, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(197, 43, 5, 1000, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(199, 44, 1, 1000, '2024-10-15 14:15:03', '2024-10-15 14:15:03'),
(200, 44, 2, 1000, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(201, 44, 3, 1000, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(202, 44, 4, 1000, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(203, 44, 5, 1000, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(205, 45, 1, 1000, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(206, 45, 2, 999, '2024-10-16 05:39:49', '2024-11-15 21:37:41'),
(207, 45, 3, 1000, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(208, 45, 4, 1000, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(209, 45, 5, 1000, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(211, 46, 1, 1000, '2024-10-16 05:53:59', '2024-10-17 19:58:40'),
(212, 46, 2, 1000, '2024-10-16 05:53:59', '2024-10-16 05:53:59'),
(213, 46, 3, 1000, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(214, 46, 4, 1000, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(215, 46, 5, 1000, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(283, 54, 1, 993, '2024-10-16 21:47:37', '2024-11-16 02:14:36'),
(284, 54, 2, 1000, '2024-10-16 21:47:37', '2024-10-31 02:03:56'),
(285, 54, 3, 1000, '2024-10-16 21:47:37', '2024-11-13 01:11:06'),
(286, 54, 4, 1000, '2024-10-16 21:47:37', '2024-11-02 01:51:44'),
(287, 54, 5, 1000, '2024-10-16 21:47:37', '2024-11-13 17:32:11'),
(295, 66, 1, 1000, '2024-10-19 01:03:45', '2024-10-31 02:00:40'),
(296, 66, 2, 999, '2024-10-19 01:03:45', '2024-11-20 01:40:15'),
(297, 66, 3, 1000, '2024-10-19 01:03:45', '2024-11-02 02:55:38'),
(298, 66, 4, 1000, '2024-10-19 01:03:45', '2024-11-02 19:30:40'),
(299, 66, 5, 1000, '2024-10-19 01:03:45', '2024-10-31 14:56:32'),
(301, 67, 1, 991, '2024-10-19 01:06:43', '2024-11-16 02:13:13'),
(302, 67, 2, 999, '2024-10-19 01:06:43', '2024-11-17 22:50:19'),
(303, 67, 3, 1000, '2024-10-19 01:06:43', '2024-10-31 05:07:35'),
(304, 67, 4, 1000, '2024-10-19 01:06:43', '2024-11-13 00:58:55'),
(307, 68, 1, 983, '2024-10-19 01:09:48', '2024-11-16 02:05:02'),
(308, 68, 2, 984, '2024-10-19 01:09:48', '2024-11-20 01:40:15'),
(309, 68, 3, 996, '2024-10-19 01:09:48', '2024-11-14 03:45:47'),
(310, 68, 4, 1000, '2024-10-19 01:09:48', '2024-11-14 00:11:08'),
(338, 68, 5, 0, '2024-11-17 18:55:38', '2024-11-17 18:55:38'),
(339, 67, 5, 0, '2024-11-17 18:56:19', '2024-11-17 18:56:19'),
(340, 76, 1, NULL, '2024-11-17 18:57:23', '2024-11-19 23:37:15'),
(341, 76, 2, NULL, '2024-11-17 18:57:23', '2024-11-19 23:37:15'),
(342, 76, 3, NULL, '2024-11-17 18:57:23', '2024-11-19 23:37:15'),
(343, 76, 4, NULL, '2024-11-17 18:57:23', '2024-11-19 23:37:15'),
(344, 76, 5, NULL, '2024-11-17 18:57:23', '2024-11-19 23:37:15');

INSERT INTO `reviews` (`id`, `user_id`, `content`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(11, 2, 'Wings Sportswear is fantastic! The breathable fabric keeps me cool during workouts, and the fit is spot-on. Plus, the designs are super stylish. After several washes, it still looks new. Highly recommend it for both gym and casual wear!', 4.0, 1, '2024-11-20 03:13:32', '2024-11-20 03:13:32'),
(12, 2, 'I love Wings Sportswear! It’s comfortable, durable, and perfect for high-intensity training. The sweat-wicking feature works like magic. However, sizes run a bit small, so go up a size. Great value overall!', 4.0, 1, '2024-11-20 03:14:03', '2024-11-20 03:14:03'),
(13, 2, 'Amazing quality at an affordable price! Wings Sportswear fits great and feels light even during long workouts. The designs are trendy too. A must-try for fitness enthusiasts!', 5.0, 1, '2024-11-20 03:14:17', '2024-11-20 03:14:17'),
(14, 2, 'Wings Sportswear exceeded my expectations. The fabric feels premium, and it holds up well after multiple washes. Perfect for running and gym sessions. Sizing could be better, though.', 4.0, 1, '2024-11-20 03:14:37', '2024-11-20 03:14:37'),
(15, 2, 'Super comfortable and stylish! Wings Sportswear gives great support without feeling restrictive. It’s my go-to for all activities, from yoga to jogging. Highly recommend!', 5.0, 1, '2024-11-20 03:14:48', '2024-11-20 03:14:48'),
(16, 2, 'Wings Sportswear combines comfort and functionality perfectly. The sweat-wicking material works wonders during hot days. Fits a bit snug, but still great. Will buy again!', 4.0, 1, '2024-11-20 03:14:59', '2024-11-20 03:14:59'),
(17, 5, 'The best sportswear I’ve tried! Lightweight, durable, and perfect for every activity. Wings Sportswear is a game-changer for my fitness routine.', 5.0, 1, '2024-11-20 03:45:33', '2024-11-20 03:45:33'),
(18, 5, 'The best sportswear I’ve tried! Lightweight, durable, and perfect for every activity. Wings Sportswear is a game-changer for my fitness routine.', 4.0, 1, '2024-11-20 03:50:19', '2024-11-20 03:50:19'),
(19, 5, 'Excellent for outdoor runs! Wings Sportswear keeps me dry and cool throughout. The sleek design adds extra points. Definitely recommend it to anyone active!', 5.0, 1, '2024-11-20 03:51:01', '2024-11-20 03:51:01'),
(20, 5, 'Excellent for outdoor runs! Wings Sportswear keeps me dry and cool throughout. The sleek design adds extra points. Definitely recommend it to anyone active!', 5.0, 1, '2024-11-20 03:51:55', '2024-11-20 03:51:55'),
(21, 5, 'Excellent for outdoor runs! Wings Sportswear keeps me dry and cool throughout. The sleek design adds extra points. Definitely recommend it to anyone active!', 5.0, 1, '2024-11-20 03:52:19', '2024-11-20 03:52:19');

INSERT INTO `sections` (`id`, `title`, `scopeMethod`, `slug`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Latest Arrival, Ready to Fly!', 'getLatestProducts', 'latest', 'latest', 1, NULL, NULL),
(2, 'Top Picks, Always in Style!', 'getTopOrders', 'topPicks', 'topPicks', 1, NULL, NULL),
(3, 'On Trend, On Point!', 'getTrending', 'trending', 'trending', 1, NULL, NULL),
(9, 'All Eyes on it!', 'getMostViewed', 'mostViewed', 'mostViewed', 1, NULL, NULL),
(10, 'Hot Deals, Just for You!', 'getOfferProducts', 'hotDeals', 'hotDeals', 1, NULL, NULL);

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

INSERT INTO `transactions` (`id`, `ref`, `order_id`, `val_id`, `subtotal`, `amount`, `shipping_charge`, `order_total`, `order_discount`, `voucher`, `payment_status`, `card_type`, `store_amount`, `card_no`, `bank_tran_id`, `status`, `tran_date`, `error`, `currency`, `card_issuer`, `card_brand`, `card_sub_brand`, `card_issuer_country`, `card_issuer_country_code`, `store_id`, `verify_sign`, `verify_key`, `verify_sign_sha2`, `currency_type`, `currency_amount`, `currency_rate`, `base_fair`, `value_a`, `value_b`, `value_c`, `value_d`, `subscription_id`, `risk_level`, `risk_title`, `created_at`, `updated_at`) VALUES
(149, 'ws0291e79c', 48, '2410317273382xskWRHpMbvs6g', 0.00, 2700.00, 150.00, 2550.00, NULL, NULL, 1, 'BKASH-BKash', 2632.50, NULL, '24103172733q5lcaEwqZbezOw0', 'VALID', '2024-10-31 07:27:29', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '85eaa4b16e6b72faf06b126a5a57c825', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'ca2872b94f19c5ad06e7b6ac39a6e002a2cf007e56d1861be43a0fa2fda89632', 'BDT', 2700.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 07:27:29', '2024-10-31 07:27:36'),
(150, 'wscf89a6ea', 49, '241031123641BkP83AfMTSktsR3', 0.00, 150.00, 150.00, 5100.00, NULL, NULL, 0, 'NAGAD-Nagad', 146.25, NULL, '2410311236411NyJRWCqFLHL7HR', 'VALID', '2024-10-31 12:36:33', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '30fd59db360b90f69ffee4637074b035', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '9b9ae4815ea58b4e71e8996c9da61bf025a222237c8ccb680105da5b78f6796e', 'BDT', 150.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 12:36:32', '2024-10-31 12:36:43'),
(151, 'ws487026dd', 50, '24103113392501xP2jPdaBLChko', 0.00, 1990.00, 65.00, 1925.00, NULL, NULL, 1, 'BKASH-BKash', 1940.25, NULL, '2410311339250vps3IyMUdvle3m', 'VALID', '2024-10-31 13:39:18', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '356191aa21c8697b2567ad236fad16f4', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'aaf4f0d314b2b155628402f097351dd7a54b04c5c8275d558df4c3f9e1630204', 'BDT', 1990.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 13:39:17', '2024-10-31 13:39:27'),
(152, 'ws4825a388', 51, '2410311403330cKZKtA1szQBTsD', 0.00, 60.00, 60.00, 1125.00, NULL, NULL, 0, 'NAGAD-Nagad', 58.50, NULL, '2410311403331l6G9p5dXWn6LxX', 'VALID', '2024-10-31 14:03:28', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'b449c21e9b211219a8dba9d0645d7d5c', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '00d2e340e46489fd541cedb04cc37cd249fa2dcc0d24ce5427dd5fbabc4f9da7', 'BDT', 60.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:03:28', '2024-10-31 14:03:36'),
(153, 'wsda6262ea', 52, '241031140641e1GSmWAzDvXQilX', 0.00, 2650.00, 100.00, 2550.00, NULL, NULL, 1, 'NAGAD-Nagad', 2583.75, NULL, '241031140641PIEx6KFWUD56tgW', 'VALID', '2024-10-31 14:06:37', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '15201569716508c9e8674b9e0f2e185e', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '279303181749129f758a36fabf8334bb1a0f9d6eff006f7ff58a246987aa704b', 'BDT', 2650.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:06:36', '2024-10-31 14:06:43'),
(154, 'ws8d304b42', 53, '2410311411510DHbIiZXkXzx657', 0.00, 625.00, 100.00, 525.00, NULL, NULL, 1, 'BKASH-BKash', 609.38, NULL, '241031141151jcCmGoyiRWYdpFs', 'VALID', '2024-10-31 14:11:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6b253d312cf90e9b4c8bba39b55cd98f', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0c02189f382485c4a3fd02f2eaabf2513503e51ba320b5724f3e86d614f67c57', 'BDT', 625.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:11:44', '2024-10-31 14:11:55'),
(155, 'wsb3576180', 54, '241031141729xUQ900hwm7LEJnm', 0.00, 100.00, 100.00, 2550.00, NULL, NULL, 0, 'DBBLMOBILEB-Dbbl Mobile Banking', 97.50, NULL, '2410311417297krJyhYmJAACfLF', 'VALID', '2024-10-31 14:17:24', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '62d2505bd25f13a0036f1f3cb655846b', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0fdddacdab17a3e8691de3651b598d7df853bc379cb4c18d5c1b7ea46047dfcb', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:17:24', '2024-10-31 14:17:31'),
(156, 'ws62c27af3', 55, '241031142724p9YJHNSdFmBizMm', 0.00, 2610.00, 60.00, 2550.00, NULL, NULL, 1, 'NAGAD-Nagad', 2544.75, NULL, '24103114272406FXPbkV5NgxzYS', 'VALID', '2024-10-31 14:27:20', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '213ac538851e4b3deb2c5d696f8c6895', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'd93364bdd18c191432c9bfc52d60ce0eea1ac371444b6f8ded2cc5a0bdc4d4f6', 'BDT', 2610.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:27:20', '2024-10-31 14:27:26'),
(157, 'ws2f74a55a', 56, '24103114331815WGrx0dAr7TMcL', 0.00, 1700.00, 100.00, 1600.00, NULL, NULL, 1, 'BKASH-BKash', 1657.50, NULL, '241031143318ppg1OnD4fw4HLM3', 'VALID', '2024-10-31 14:32:57', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6b01c63e3855a0a0c05fc8bfff55097a', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '8b960fe9f44b7d1d69180d6bf6fc7ff28db65af3300f5c90467b87d942cfd0a2', 'BDT', 1700.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:32:57', '2024-10-31 14:33:20'),
(158, 'ws71c050df', 57, '241031144008Wg3OR0izZXgYQ8T', 0.00, 1700.00, 100.00, 1600.00, NULL, NULL, 1, 'DBBLMOBILEB-Dbbl Mobile Banking', 1657.50, NULL, '241031144008aXypgncZrJDJqJP', 'VALID', '2024-10-31 14:40:00', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '15f2656bb9ffedf4a87670e7b0206c2a', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '63e4c518733b3b7170abfcc170c09cc75d4483c90348ee8920dc2c8b900557d0', 'BDT', 1700.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:40:00', '2024-10-31 14:40:10'),
(159, 'wsf9251b4b', 58, '241031144452inNQhnLF0zzStzU', 0.00, 2275.00, 100.00, 2175.00, NULL, NULL, 1, 'BKASH-BKash', 2218.13, NULL, '241031144452ua8usYaRubTPBHJ', 'VALID', '2024-10-31 14:44:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '54ac90d9d1407f4deb8a6ba839957516', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '36cbbd7d71caa19914d334d9a86502de0a763ad48d8e13ecf5423dc7c74c1d94', 'BDT', 2275.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:44:45', '2024-10-31 14:44:55'),
(160, 'ws4ad63334', 59, '2410311451431V3vlQEHAuucG3u', 0.00, 100.00, 100.00, 1125.00, NULL, NULL, 0, 'BKASH-BKash', 97.50, NULL, '241031145143prNg9p3WM4HydA1', 'VALID', '2024-10-31 14:51:30', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'bb23027e0631595bd6e1fa7e818484dd', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0468e9b6fcac0643d826dc46c0b9c28d805fb2612872df12f1714b46bf443442', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:51:30', '2024-10-31 14:51:46'),
(161, 'wsd9289064', 60, '2410311456401xZxKhZcZgNyh44', 0.00, 100.00, 100.00, 800.00, NULL, NULL, 0, 'NAGAD-Nagad', 97.50, NULL, '2410311456400zOjaOREXk8uJm5', 'VALID', '2024-10-31 14:56:32', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '05d0a0cc54bffe8c673e46ff1be0dbe0', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'df706c89c8217c1577e19d939bc86433a6b29cf9c089839b1bced6f2f10008a7', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 14:56:32', '2024-10-31 14:56:43'),
(162, 'wsc518a856', 61, '241031165354OYqmzcNKbpkTUlP', 0.00, 100.00, 100.00, 2550.00, NULL, NULL, 0, 'BKASH-BKash', 97.50, NULL, '241031165354pFdPLWp49Lkm0EN', 'VALID', '2024-10-31 16:53:36', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'f2f19603e03fc774daccb22628e27502', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '836847f041d982439e0cf7e8fadb404bed2cd3497d2e78f2acaa67ec2750cec1', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 16:53:36', '2024-10-31 16:53:56'),
(163, 'wscf6e9301', 62, '2410311659410o54Sb0WhkgAPK7', 0.00, 100.00, 100.00, 800.00, NULL, NULL, 0, 'DBBLMOBILEB-Dbbl Mobile Banking', 97.50, NULL, '24103116594118eI6x2DN91qMFZ', 'VALID', '2024-10-31 16:59:28', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '8e272d5bbdea114e305002deea019af7', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '12aa7d0be7db78e7c040c9228c4707afc5295f398209bc98d0b454ffeab78013', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-10-31 16:59:28', '2024-10-31 16:59:43'),
(164, 'ws89b5d26d', 63, NULL, NULL, NULL, 100.00, 2550.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31 17:09:37', '2024-10-31 17:09:37'),
(165, 'ws1f0ee3db', 64, NULL, NULL, NULL, 100.00, 7650.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31 17:13:03', '2024-10-31 17:13:03'),
(166, 'ws72c03900', 65, NULL, NULL, NULL, 100.00, 7650.00, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-31 17:13:21', '2024-10-31 17:13:21'),
(167, 'ws577e3447', 66, '2411012347220FG14lp390T6oSz', 0.00, 100.00, 100.00, 2775.00, NULL, NULL, 0, 'NAGAD-Nagad', 97.50, NULL, '2411012347220BsCD1vf8TYWsHV', 'VALID', '2024-11-01 23:47:09', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6e3842aefc088ba01c8d0091b53c33db', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'dd25adf4c3041663aafc708d5498764bbdd6034990972d2becf58f7c0d9de99e', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-01 23:47:07', '2024-11-01 23:47:25'),
(168, 'ws69e31a59', 67, '241101235338ulY1qG2sUzyHyy5', 0.00, 1000.00, 100.00, 900.00, NULL, NULL, 1, 'BKASH-BKash', 975.00, NULL, '2411012353380ljft4bpiW9XwfZ', 'VALID', '2024-11-01 23:53:30', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'abd4ac5be4d8cb09cab9ce589287309c', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'ae32129e36456692962580da019b7937f9fefff83f318338415974228a76af14', 'BDT', 1000.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-01 23:53:30', '2024-11-01 23:53:42'),
(169, 'ws7f5a5c61', 68, '24110202444twUzZUax34aLIHB', 0.00, 900.00, 100.00, 800.00, NULL, NULL, 1, 'NAGAD-Nagad', 877.50, NULL, '24110202444iKrYx3T9UBRaxVJ', 'VALID', '2024-11-02 00:24:37', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '2ebaced4df164781b389e188ef764d3f', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '07b8c67882e1bdb93c24879e5cb0904ae28ae94464616476c01e537026e42b17', 'BDT', 900.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:24:36', '2024-11-02 00:24:46'),
(170, 'wsb07dbe78', 69, '24110202641eUqTN7ID5E93ytz', 0.00, 100.00, 100.00, 525.00, NULL, NULL, 0, 'DBBLMOBILEB-Dbbl Mobile Banking', 97.50, NULL, '241102026410qbV8vxeAs0ZKJm', 'VALID', '2024-11-02 00:26:35', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'eb6c91eb13de745cd2c99632c78a5ede', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'd4463cc2e8979ff7ef0b73eabf96b731d09508cc67273c2148ca8dd4ceb61cfc', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:26:35', '2024-11-02 00:26:43'),
(171, 'ws8e383164', 70, '24110204255TgbkLL4gYFCEhAd', 0.00, 900.00, 100.00, 800.00, NULL, NULL, 1, 'NAGAD-Nagad', 877.50, NULL, '241102042551rpGuEXvjLq6yp8', 'VALID', '2024-11-02 00:42:49', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '75440355f323b458b7b76b0ac720af37', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '1986f3bb1bde833b08228982ff3ab5068c38ae482985bd0c66087f3926fecd11', 'BDT', 900.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:42:49', '2024-11-02 00:42:58'),
(172, 'ws510f1952', 71, '241102057461fv6H2sgWsCwRmc', 0.00, 1225.00, 100.00, 1125.00, 500.00, NULL, 1, 'NAGAD-Nagad', 1194.38, NULL, '241102057461sTizqc2AC4okJv', 'VALID', '2024-11-02 00:57:41', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '2283001862b64bdaa9dc66690414b4f8', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '4637518e84121fdcb879bccd33c37ad9a42641afbfe69420a6ecc9feed8f7c73', 'BDT', 1225.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 00:57:40', '2024-11-02 00:57:49'),
(173, 'ws02299bde', 72, '241102146291adOTYAPGxZ4VBW', NULL, 60.00, 60.00, 3300.00, NULL, NULL, 0, 'NAGAD-Nagad', 58.50, NULL, '24110214629nENnrIXmVBaC8qK', 'VALID', '2024-11-02 01:46:00', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'b111d783c0e1436427b0f7237d1bafa2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'c087f1f6081a7fe9f8264ca0987aee00d07aad4644bed818f20d26b0ae6ae409', 'BDT', 60.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 01:45:59', '2024-11-02 15:44:12'),
(174, 'ws421d9884', 74, '241102151511ohUvmAnu6PJNjw', 0.00, 100.00, 100.00, 3300.00, 1101.00, NULL, 0, 'BKASH-BKash', 97.50, NULL, '241102151511Q81hg9eqCHXXj4', 'VALID', '2024-11-02 01:51:45', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '93c433cca59bf171d57a3650931277e9', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '455f5806ef8efec2f2364ec70f1e0cf4b569f59f3c7b53c0c33bfa9abe81db55', 'BDT', 100.00, 1.0000, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 01:51:44', '2024-11-02 01:52:26'),
(175, 'ws0ade7ca0', 75, '24110225544z9apgHIoGitiEKV', 2200.00, 100.00, 100.00, 1850.00, 350.00, NULL, 0, 'NAGAD-Nagad', 97.50, NULL, '241102255440sfCZoOrUC6d9Jp', 'VALID', '2024-11-02 02:55:38', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'c25f3ec58076fee257f6a2297295c706', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '1640941f277c8ccf17608d47ac2f8b1179d6f2c28f4726e222f4afc567176839', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 02:55:38', '2024-11-02 02:56:33'),
(176, 'wsb8a2c6d6', 76, '2411021930520KU3Jfxbnv280HC', 800.00, 900.00, 100.00, 800.00, 0.00, NULL, 1, 'DBBLMOBILEB-Dbbl Mobile Banking', 877.50, NULL, '241102193052lN2GY9mSD7ZVtTG', 'VALID', '2024-11-02 19:30:41', NULL, 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'ae127f09fdaaedce72f978219b4dfcdd', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '7fcc076a903de77bb6a5053e620b0e2210ac55992ab94438f6cdc8c1e3f23440', 'BDT', 900.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-02 19:30:40', '2024-11-02 19:30:55'),
(177, 'wsda6f7c62', 77, '2411031602027wEwje8pSAv86N5', 1800.00, 100.00, 100.00, 900.00, 900.00, NULL, 0, 'NAGAD-Nagad', 97.50, NULL, '2411031602021GRhd4NUvhoV2X8', 'VALID', '2024-11-03 16:01:34', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'd0b5f3267af5e7e157d74913604618d2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '056fb21498e8a1cbdb2ac76e609298f64bbbb89c55f75e054f34131b9b52c0af', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-03 16:01:33', '2024-11-03 16:02:05'),
(178, 'wsd3339530', 78, '241105195110NcAfa5jMApkvmQX', 1800.00, 100.00, 100.00, 900.00, 900.00, NULL, 0, 'VISA-Dutch Bangla', 97.50, '432155******3964', '24110519511014bdAFGxhaDOjFL', 'VALID', '2024-11-05 19:50:23', NULL, 'BDT', 'STANDARD CHARTERED BANK', 'VISA', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '772d7d1edaa6c106e99dcc08eef69068', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '082cb15f1e52d37d250e873972b3275b09faf9bd5ba2d5079559718518faa0fc', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-05 19:50:22', '2024-11-05 19:51:13'),
(179, 'ws139ddc0c', 79, '2411052148210zznL6nle7g0HIo', 1800.00, 100.00, 100.00, 900.00, 900.00, NULL, 0, 'BKASH-BKash', 97.50, NULL, '2411052148215TSIB3dMVHUwoWZ', 'VALID', '2024-11-05 21:48:04', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'be164ef3140a1e1740461c126f6ec4e2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '8028da51dab8e8c53d81349de1b8e98074da15a1d8dffffd8457027b69fd6b9e', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-05 21:48:04', '2024-11-05 21:48:23'),
(180, 'ws100fbb65', 80, NULL, 2550.00, NULL, 100.00, 2550.00, 0.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-12 23:38:21', '2024-11-12 23:38:21'),
(181, 'ws7e2119e7', 81, NULL, 700.00, NULL, 100.00, 525.00, 175.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 00:54:19', '2024-11-13 00:54:19'),
(182, 'ws88e21b6f', 82, NULL, 2550.00, NULL, 100.00, 2550.00, 0.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 00:54:59', '2024-11-13 00:54:59'),
(183, 'ws96931d9f', 83, NULL, 1500.50, NULL, 100.00, 1125.00, 375.50, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 00:56:25', '2024-11-13 00:56:25'),
(184, 'wsdb2641af', 84, '24111305859NzMNGwDpXjlRwGf', 1500.50, 100.00, 100.00, 1125.00, 375.50, NULL, 0, 'BKASH-BKash', 97.50, NULL, '24111305859QUqIxy4WLUS6b2F', 'VALID', '2024-11-13 00:58:55', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '68babff7130d12214736999e49977060', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'c75b841c80bc7ca3ad254bd1d6d3976fff65fbf74219a6d8d23fb75a0e4f4baa', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-13 00:58:55', '2024-11-13 00:59:02'),
(185, 'ws4fa6c456', 85, NULL, 700.00, NULL, 100.00, 525.00, 175.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 01:03:22', '2024-11-13 01:03:22'),
(186, 'ws8871e781', 86, NULL, 700.00, 100.00, 100.00, 525.00, 175.00, NULL, 0, NULL, NULL, NULL, '24111311111lClJ0JYCeMII7Qh', 'FAILED', '2024-11-13 01:11:06', 'Insufficient balance', 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '9f14cbc2521b893eb65faabd5c349c1c', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '6733c550d8a5206ef766d8d5845cc0be165f04aecd8b19f90c1feb65103362e2', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 01:11:06', '2024-11-13 01:11:13'),
(187, 'wsd4d8d45d', 87, NULL, 1800.00, 100.00, 100.00, 900.00, 900.00, NULL, 0, NULL, NULL, NULL, '2411131215471UPhZTHY5hx4BqC', 'FAILED', '2024-11-13 12:14:58', 'Unattempted or Expired', 'BDT', 'AB Bank Limited', 'IB', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '319f7fe3201f481391313f526b10b523', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', 'd15e4477af7e47a9db28314ce90f1efc84d498a0e6cfc8ee6a0aab9eae49b99b', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 12:14:58', '2024-11-13 12:15:49'),
(188, 'ws1060ecd9', 88, NULL, 700.00, NULL, 100.00, 525.00, 175.00, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 17:28:46', '2024-11-13 17:28:46'),
(189, 'ws22c45e73', 89, NULL, 700.00, 100.00, 100.00, 525.00, 175.00, NULL, 0, NULL, NULL, NULL, '24111317321924OWlBCrJMDBMiX', 'FAILED', '2024-11-13 17:32:11', '3D Security Validation Failed', 'BDT', 'DBBL Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '1f4ddcb72a1d5327d9ffb89c501e534a', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '133592544c804f2dd677eb7f19163ef7a61b72c93efcd29237b40fed3802c728', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 17:32:11', '2024-11-13 17:40:59'),
(190, 'ws2121187f', 90, NULL, 2550.00, 2650.00, 100.00, 2550.00, 0.00, NULL, 1, NULL, NULL, NULL, '2411131750090EAPvtkWfL6k8QJ', 'FAILED', '2024-11-13 17:50:05', '3D Security Validation Failed', 'BDT', 'AB Bank Limited', 'IB', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'aeb77137d9b02d287e5c2fe13f75adc7', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', 'f88f795d5191d26fda35e3a022bd4fdab63fe167e53a714e5698c8062b695eb7', 'BDT', 2650.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 17:50:04', '2024-11-13 17:50:11'),
(191, 'wscfc3cfd8', 91, NULL, 1500.50, 1225.00, 100.00, 1125.00, 375.50, NULL, 1, NULL, NULL, NULL, NULL, 'CANCELLED', '2024-11-13 18:01:17', 'Cancelled by User', 'BDT', NULL, NULL, NULL, NULL, NULL, 'oyela6716c98c030ab', '15dbb97df670ef43859ac29d31512389', 'amount,bank_tran_id,base_fair,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '8ba3b0c8a88e242abd497bfebc7f9d6af6beb2c27c14ef971e48e2b15868aa69', 'BDT', 1225.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 18:01:17', '2024-11-13 18:02:02'),
(192, 'wsbaf3f45f', 92, NULL, 1800.00, NULL, 100.00, 900.00, 900.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 19:09:54', '2024-11-13 19:09:54'),
(193, 'ws2d51f997', 93, NULL, 1800.00, 1000.00, 100.00, 900.00, 900.00, NULL, 1, NULL, NULL, NULL, '241113191632USbvtmfW2902bX1', 'FAILED', '2024-11-13 19:16:27', 'Do not honor', 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '5384d93331eaa5618e06f2dc8876f09d', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '22fdfd161e3e68683984ce76ecb026b9262dcf7f7c0ccbd68c9ff8bc0378f6d6', 'BDT', 1000.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 19:16:26', '2024-11-13 19:16:34'),
(194, 'ws612003c5', 94, NULL, 2550.00, 100.00, 100.00, 2550.00, 0.00, NULL, 0, NULL, NULL, NULL, '241113191748KqKuwJz9bO8QLGP', 'FAILED', '2024-11-13 19:17:43', 'Suspicious Transaction', 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '4f67a1cf9f777654467c154259079487', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '9df3bd666fda27db91ebe64009c3886434df0214e68e626ab3c777f1b73fbe52', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 19:17:43', '2024-11-13 19:17:49'),
(195, 'ws37da5431', 95, NULL, 2550.00, 100.00, 100.00, 2550.00, 0.00, NULL, 0, NULL, NULL, NULL, '2411131920070euK8pthyfnHIm7', 'FAILED', '2024-11-13 19:19:55', 'Unattempted or Expired', 'BDT', 'TAB', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'f07dac3d5c05957278b5d056632a481f', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '9534d228c31a4807d847fa4a2f772b0720fb9ed0666fd6d5fee59cd385258d21', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 19:19:55', '2024-11-13 19:20:09'),
(196, 'ws8de5dc66', 96, NULL, 2550.00, 2650.00, 100.00, 2550.00, 0.00, NULL, 1, NULL, NULL, NULL, '2411131921531BFEHFQvxJgpWkO', 'FAILED', '2024-11-13 19:21:49', 'Invalid CVV', 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '4042df42973eec0ed1316a3c825e69e8', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '2b200b612a67bf59c0921b0d83e91fd66ef56a0d14a05e41d9a04b311f331bd7', 'BDT', 2650.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 19:21:49', '2024-11-13 19:21:55'),
(197, 'wsf12ceb1e', 97, NULL, 2550.00, 100.00, 100.00, 2550.00, 0.00, NULL, 0, NULL, NULL, NULL, NULL, 'CANCELLED', '2024-11-13 19:27:37', 'Cancelled by User', 'BDT', NULL, NULL, NULL, NULL, NULL, 'oyela6716c98c030ab', 'cc9bdb91ea1f69841aa8133220c80745', 'amount,bank_tran_id,base_fair,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '7e1ef0df89befed995298abea04f8b3a2b9894106b3bfd530ee08f224190b905', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-13 19:27:37', '2024-11-13 19:27:40'),
(198, 'wsb169f06f', 98, '241114011140W4kjz13LfF0Lac', 15300.00, 100.00, 100.00, 15300.00, 0.00, NULL, 0, 'BKASH-BKash', 97.50, NULL, '241114011140DV7NY7wrPcF1vA', 'VALID', '2024-11-14 00:11:09', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '4fb27eb51ea2300f120004772c69ca7c', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '95dbd5a7a5a0525777424fba176768dec35045132364d1ae64af9a4b1d00e01a', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-14 00:11:08', '2024-11-14 00:11:16'),
(199, 'ws8ca81994', 99, NULL, 1800.00, NULL, 100.00, 900.00, 900.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14 02:32:37', '2024-11-14 02:32:37'),
(200, 'wsf8d013ab', 100, NULL, 9000.00, NULL, 100.00, 4500.00, 4500.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14 03:12:20', '2024-11-14 03:12:20'),
(201, 'ws577ae918', 101, NULL, 14400.00, NULL, 100.00, 9900.00, 4500.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14 03:30:23', '2024-11-14 03:30:23'),
(202, 'wsfbf91628', 102, NULL, 15000.00, 100.00, 100.00, 10500.00, 4500.00, NULL, 0, NULL, NULL, NULL, NULL, 'CANCELLED', '2024-11-14 03:35:20', 'Cancelled by User', 'BDT', NULL, NULL, NULL, NULL, NULL, 'oyela6716c98c030ab', '85b75fcdf746fb34e620ff53f321c2f0', 'amount,bank_tran_id,base_fair,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '1b6054a54af4d329692bf805eeaf78d492943ce16c8aa6acda07f7894d8ed943', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14 03:35:20', '2024-11-14 03:37:42'),
(203, 'ws3313d070', 103, NULL, 35700.00, 35820.00, 120.00, 35700.00, 0.00, NULL, 1, NULL, NULL, NULL, '24111434330156mEYDk1LWTSLu', 'FAILED', '2024-11-14 03:43:22', 'Issuer Bank Declined', 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '6209f34ab500224a8a10ee3261b48d62', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,status,store_id,tran_date,tran_id,value_a,value_b,value_c,value_d', '32cf463c7817aa58301cc3d0bb74234911496c42b04db4a5269b8130ffa333ab', 'BDT', 35820.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14 03:43:22', '2024-11-14 03:43:32'),
(204, 'wsf2b8dd83', 104, NULL, 35700.00, NULL, 120.00, 35700.00, 0.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-14 03:45:47', '2024-11-14 03:45:47'),
(205, 'wsd3e07b60', 105, NULL, 42000.00, NULL, 120.00, 42000.00, 0.00, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-15 02:24:41', '2024-11-15 02:24:41'),
(206, 'wsc3524f03', 106, NULL, 45300.50, NULL, 100.00, 40394.95, 375.50, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-15 03:50:24', '2024-11-15 03:50:24'),
(207, 'ws81926583', 107, NULL, 600.00, NULL, 100.00, 600.00, 0.00, 60.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-15 21:37:41', '2024-11-15 21:37:41'),
(208, 'ws2d6fb3a2', 108, '2411152139321rhyrnVygoorXPO', 1800.00, 1720.00, 100.00, 1800.00, 0.00, 180.00, 1, 'NAGAD-Nagad', 1677.00, NULL, '241115213932Dz4EnntMnr5YPbB', 'VALID', '2024-11-15 21:39:25', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '59dd0139b48bdbef7a37f746fa7584a1', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'a690263e34b618912d7d8e454d50f276522b2c2c5b6e9f5b6e2aca34b513f778', 'BDT', 1720.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-15 21:39:24', '2024-11-15 21:39:34'),
(209, 'wse7d35879', 109, '241115215222VYexeQvJCwXRqrd', 1800.00, 1720.00, 100.00, 1620.00, 0.00, 180.00, 1, 'BKASH-BKash', 1677.00, NULL, '24111521522209hBYtrk6nbXyxs', 'VALID', '2024-11-15 21:52:17', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '16ce77f232cae25371db433092afb211', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '12d850a3a9bfe198f8cbd4b2c73c511d0aa40fb8c3261b813a938600cf7bdd8b', 'BDT', 1720.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-15 21:52:16', '2024-11-15 21:52:25'),
(210, 'ws6b6510da', 110, '241115215506htX660rUoZyZyY7', 2550.00, 2395.00, 100.00, 2295.00, 0.00, 255.00, 1, 'BKASH-BKash', 2335.13, NULL, '2411152155061uNogt7iSrCa4RZ', 'VALID', '2024-11-15 21:55:02', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '740b2a775ecbc31a3b4d6ace590dd5b0', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '6e1bab52150c5c867a028e6427722b6b4b9b229375f550ab5f6a840bc060fac2', 'BDT', 2395.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-15 21:55:02', '2024-11-15 21:55:09'),
(211, 'ws22ede10b', 111, '241116139371ZetTH5iH1rxjPc', 8401.00, 120.00, 120.00, 6885.00, 751.00, 765.00, 0, 'BKASH-BKash', 117.00, NULL, '241116139371yQ04qAvEoeODRn', 'VALID', '2024-11-16 01:39:31', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '9bcd925cddaebf6fe8a7289b36f3d538', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '67e10d667df9711b742db332e707ab372746233d65b692089d97b2a20f6358a2', 'BDT', 120.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-16 01:39:30', '2024-11-16 01:39:39'),
(212, 'wsd9980178', 112, '24111614121kqKaZlZzuiYC8w2', 9601.50, 7747.50, 120.00, 7627.50, 1126.50, 847.50, 1, 'BKASH-BKash', 7553.81, NULL, '241116141210yy1EtRvh7CyQEy', 'VALID', '2024-11-16 01:41:13', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '55735f33d0e45074f3030468f0b31671', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'e247bb5f3a358e41a36a069c647bde8d0c894ea7db398c22d1286f02d2681038', 'BDT', 7747.50, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-16 01:41:13', '2024-11-16 01:41:23'),
(213, 'ws6daac1b9', 114, '241116152390bpdcetlc43D03i', 2550.00, 2650.00, 100.00, 2550.00, 0.00, NULL, 1, 'NAGAD-Nagad', 2583.75, NULL, '241116152390XXFzFNwMChRhUy', 'VALID', '2024-11-16 01:52:35', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '7428087957855ca64902edbbbfba6a18', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '11750f74bc2d8c130db38608804d2adbf5ad09f297f773850f48bfbc4b74a2f2', 'BDT', 2650.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-16 01:52:34', '2024-11-16 01:53:43'),
(214, 'wsf905c3a4', 115, '24111620506X74qwFWqvTKSx17', 2550.00, 100.00, 100.00, 2550.00, NULL, NULL, 0, 'BKASH-BKash', 97.50, NULL, '2411162050688Q0WeaHAKM9qNV', 'VALID', '2024-11-16 02:05:02', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'bcf5c9292c35fe94110bf5c1d371ac54', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '68f8bdaef92be0b14abd26721f3929671db6f7a3e68a9c07b2dd8c83df2ae909', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-16 02:05:02', '2024-11-16 02:05:08'),
(215, 'ws157d61a0', 116, '24111621317z0K1N3LAMD4wV4i', 5901.50, 4082.50, 100.00, 3982.50, 1476.50, 442.50, 1, 'BKASH-BKash', 3980.44, NULL, '241116213171kTLTPPGVywxdeR', 'VALID', '2024-11-16 02:13:13', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '0c4cd80b935790152137c1d216fa8f82', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', 'c6ab8bbb18fe403be05e9224fa58af69f4faeea736eb4cfbc04c5664289324f7', 'BDT', 4082.50, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-16 02:13:13', '2024-11-16 02:13:20'),
(216, 'ws94bfc635', 117, '241116214401zhuMwb1WpV2SiB', 3500.00, 100.00, 100.00, 2625.00, 875.00, NULL, 0, 'BKASH-BKash', 97.50, NULL, '24111621440XoMsBFv2feTEDOU', 'VALID', '2024-11-16 02:14:36', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'e4129998328981b33e0f032827027503', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '0dbe982fae3f6c6a24bbe6b7abc032ddfb89f1c04ae82346c2c1f3a11224741b', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-16 02:14:36', '2024-11-16 02:14:42'),
(217, 'ws2711777c', 118, '2411172250271tZlb2hF1Q5CLMC', 1500.50, 1225.00, 100.00, 1125.00, 375.50, NULL, 1, 'NAGAD-Nagad', 1194.38, NULL, '241117225027L6d3NLDBOV0o0tS', 'VALID', '2024-11-17 22:50:20', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '9ab0dd91cb2b364b9e6d1996686a9ff7', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '6ed9f205779bf6a4d8aeb1ff499f7ff7b017caa64abf64153d97644054ea12da', 'BDT', 1225.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-17 22:50:19', '2024-11-17 22:50:29'),
(218, 'wse769455b', 119, '24111935659vpfVONlrLleqDrE', 100.00, 200.00, 100.00, 100.00, NULL, NULL, 1, 'NAGAD-Nagad', 195.00, NULL, '24111935659m0PHCKGk15qNDZK', 'VALID', '2024-11-19 03:56:53', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '01008e938c67119f6a59b4c4a337537d', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '30f8def057d87cf11bd911978d2c44a389e5a2443ef223bfbe79cb940a7c8443', 'BDT', 200.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-19 03:56:53', '2024-11-19 03:57:02'),
(219, 'ws20ca5236', 120, '2411191010550O8cMqPbaDJN75l', 2550.00, 2650.00, 100.00, 2550.00, NULL, NULL, 1, 'NAGAD-Nagad', 2583.75, NULL, '241119101055Vm3KrL9NZLfTxlM', 'VALID', '2024-11-19 10:10:51', NULL, 'BDT', 'Nagad', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', 'eb11fc77e34b7cfa06e4b3fe6a93a0c2', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '13e673fd25050f3a927e45025b89c4598be94552b3859880ac269ba9266f22af', 'BDT', 2650.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-19 10:10:51', '2024-11-19 10:10:58'),
(220, 'wsb3b69871', 121, '24112014020U0Rxy28ApHoP7WK', 3350.00, 100.00, 100.00, 3350.00, NULL, NULL, 0, 'BKASH-BKash', 97.50, NULL, '24112014020rNZ8RovSGHnhQ2E', 'VALID', '2024-11-20 01:40:15', NULL, 'BDT', 'BKash Mobile Banking', 'MOBILEBANKING', 'Classic', 'Bangladesh', 'BD', 'oyela6716c98c030ab', '195d778a20b6e5e5844b314267e82ca1', 'amount,bank_tran_id,base_fair,card_brand,card_issuer,card_issuer_country,card_issuer_country_code,card_no,card_sub_brand,card_type,currency,currency_amount,currency_rate,currency_type,error,risk_level,risk_title,status,store_amount,store_id,tran_date,tran_id,val_id,value_a,value_b,value_c,value_d', '3f6d30e7d05e12219362b073857af3ed5e700055794fbc8ca2480b8993a882cc', 'BDT', 100.00, 1.0000, 0.00, NULL, NULL, NULL, NULL, NULL, 0, 'Safe', '2024-11-20 01:40:15', '2024-11-20 01:40:23');

INSERT INTO `users` (`id`, `name`, `phone`, `city`, `zone`, `area`, `country`, `zip`, `avatar`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Faisal', '+8801710541719', 'Nilphamari', 'Kishoreganj', 'Barabhita', 'Bangladesh', '5320', 'user_2_1732055968.jpg', 1, 'me@faisal.one', NULL, '$2y$10$zCzYfpLZR3NrRw4fW0mkp.ONCdNDKmbS6xDPNmH.ffcuplMUMgcwG', 'tSHC7P2yhkp7AUNU7tzlkSjd7zOYWSe5sRLMFtSXJw8y1qDMRCAbVWP5lxlT', '2024-10-14 14:04:50', '2024-11-20 04:39:28'),
(3, 'Faisal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'hello@oyelab.com', NULL, '$2y$10$XcTdlG7v5jZue3mgV/9nPuCncYLGTgUU7QIk6AqM7jI4Go256A/Z2', NULL, '2024-10-21 08:32:27', '2024-10-21 08:32:27'),
(4, 'Faisal Hasan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'abc@xyz.com', NULL, '$2y$10$jUDcKZ1Dr7lD2oMF8Z/jveywmrHpYl3gathlrT2JU34ofwv1Yxzc.', NULL, '2024-10-27 11:59:39', '2024-10-27 11:59:39'),
(5, 'Shapon Ahmed', '01886424141', 'Dhaka', 'Mugda', 'Mugda', 'Bangladesh', '1200', 'user_5_1732055306.jpeg', 0, 'wings@shapon.com', NULL, '$2y$10$EtfUpHmPIeuO1iXmxV89A.YlTpkmXy6A3bR/QwdgxomvoHn/WKtD6', NULL, '2024-11-19 03:52:17', '2024-11-20 04:28:26'),
(6, 'Fahmeed', '01783290065', 'Rangpur', 'Nilphamari', 'Kishoreganj', 'Bangladesh', '5320', 'user_6_1732056120.jpg', 0, 'babai@faisal.one', NULL, '$2y$10$MZnY/og8t8rFBQuyLuYO7.8JOCX6eoBManv/vxvkyBSqZvEXFBGwG', NULL, '2024-11-20 04:40:25', '2024-11-20 04:42:00');

INSERT INTO `vouchers` (`id`, `code`, `discount`, `max_product`, `min_quantity`, `status`, `created_at`, `updated_at`) VALUES
(2, 'WINGSBULK10', 10, 2, 5, 1, '2024-11-14 01:48:31', '2024-11-14 01:48:31');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;