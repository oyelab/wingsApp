-- -------------------------------------------------------------
-- TablePlus 6.1.8(574)
--
-- https://tableplus.com/
--
-- Database: webadmin_laravel
-- Generation Time: 2024-10-20 21:49:24.3690
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
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `price` int DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products_clone`;
CREATE TABLE `products_clone` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `sale` decimal(5,2) DEFAULT NULL,
  `categories` json NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `specifications` json DEFAULT NULL,
  `images` json NOT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` json DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `og_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `specifications`;
CREATE TABLE `specifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `specifications_old`;
CREATE TABLE `specifications_old` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `title`, `slug`, `image`, `parent_id`, `description`, `created_at`, `updated_at`, `status`, `order`, `views`) VALUES
(22, 'Wings Edited', 'wings-edited', 'wings-edited.jpg', NULL, 'This is our custom edited Product category', '2024-10-19 09:56:36', '2024-10-19 21:40:20', 2, 5, NULL),
(24, 'Product order 2', 'product-order-2', 'product-order-2.jpg', NULL, 'Description', '2024-10-19 10:01:41', '2024-10-19 10:28:20', 2, 3, NULL),
(25, 'Product 2', 'product-2', 'product-2.jpg', NULL, 'Description', '2024-10-19 10:07:01', '2024-10-19 20:39:47', 0, NULL, NULL),
(26, 'By Replaced Product', 'by-replaced-product', 'by-replaced-product.jpg', NULL, 'This is!', '2024-10-19 10:08:02', '2024-10-19 10:08:02', 1, 2, NULL);

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(69, 22, 68, NULL, NULL),
(70, 24, 68, NULL, NULL),
(71, 25, 68, NULL, NULL),
(72, 26, 68, NULL, NULL),
(73, 22, 67, NULL, NULL),
(74, 24, 67, NULL, NULL),
(75, 25, 67, NULL, NULL),
(76, 26, 67, NULL, NULL),
(77, 22, 66, NULL, NULL),
(78, 22, 54, NULL, NULL);

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
(18, '2024_10_19_103738_create_sections_table', 8);

INSERT INTO `products` (`id`, `title`, `slug`, `price`, `sale`, `description`, `specifications`, `images`, `meta_title`, `keywords`, `meta_desc`, `og_image`, `status`, `created_at`, `updated_at`, `views`) VALUES
(41, 'Official Home Jersey 2024  Bangladesh National Football Team', 'official-home-jersey-2024-bangladesh-national-football-team', 700, 25, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Official Home Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Bangladesh National Football Team</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">This is the Current official Home Jersey of the Bangladesh National Football Team, The Premium Quality Authentic Jersey is smooth and comfortable. The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', NULL, '[\"official-home-jersey-2024-bangladesh-national-football-team-1.jpg\", \"official-home-jersey-2024-bangladesh-national-football-team-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 12:43:56', '2024-10-17 20:14:45', 0),
(42, 'Maradona 10  Concept Fan Jersey 2024', 'maradona-10-concept-fan-jersey-2024', 600, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Maradona 10</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"maradona-10-concept-fan-jersey-2024-1.jpg\", \"maradona-10-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 13:30:17', '2024-10-17 20:07:39', 0),
(43, 'Football King Pele! Concept Fan jersey 2024', 'football-king-pele-concept-fan-jersey-2024', 600, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Football King Pele!</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Concept Fan jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"football-king-pele-concept-fan-jersey-2024-1.jpg\", \"football-king-pele-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 13:57:52', '2024-10-18 10:09:23', 0),
(44, 'MANCHESTER IS BLUE!!  MANCHESTER CITY CONCEPT', 'manchester-is-blue-manchester-city-concept', 600, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><span style=\"background-color: var(--bs-card-bg); text-align: var(--bs-body-text-align);\">#Manchester is Blue!!</span><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Manchester City Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"2\", \"4\"]', '[\"manchester-is-blue-manchester-city-concept-1.jpg\", \"manchester-is-blue-manchester-city-concept-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-15 14:15:03', '2024-10-17 20:03:24', 0),
(45, 'GLORY GLORY MAN UNITED!!  MANCHESTER UNITED  CONCEPT FAN JERSEY 2024', 'glory-glory-man-united-manchester-united-concept-fan-jersey-2024', 600, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">GLORY GLORY MAN UNITED!!</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">MANCHESTER UNITED</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">CONCEPT FAN JERSEY 2024</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">#Glory Glory Man United!!</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">#Manchester United Concept Fan Jersey 2024</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"glory-glory-man-united-manchester-united-concept-fan-jersey-2024-1.jpg\", \"glory-glory-man-united-manchester-united-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-16 05:39:49', '2024-10-17 20:00:33', 0),
(46, 'VISCA BARÇA!! FC BARCELONA CONCEPT FAN JERSEY 2024', 'visca-barca-fc-barcelona-concept-fan-jersey-2024', 600, NULL, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Visca Barça!!</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#FC Barcelona Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"visca-barca-fc-barcelona-concept-fan-jersey-2024-1.jpg\", \"visca-barca-fc-barcelona-concept-fan-jersey-2024-2.jpg\"]', NULL, NULL, NULL, 'new-this-is-product-title-og.jpg', 1, '2024-10-16 05:53:59', '2024-10-17 19:58:40', 0),
(54, 'Hala Madrid - Real Madrid Concept Fan Jersey', 'hala-madrid-real-madrid-concept-fan-jersey', 700, 25, '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Hala Madrid!!</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b>#Real Madrid Concept Fan Jersey 2024</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\"><b><br></b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">Premium Quality Authentic Jersey is smooth and comfortable.</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-size-adjust: none; font-kerning: auto; font-optical-sizing: auto; font-feature-settings: normal; font-variation-settings: normal; font-variant-position: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: Helvetica;\">The Jersey is made with 95% polyester and 5% synthetic fabric, which gives it a soft and stretchy feel. The Regular fit and Circular Hem make it flattering and easy to wear.</p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"hala-madrid-real-madrid-concept-fan-jersey-1.jpg\", \"hala-madrid-real-madrid-concept-fan-jersey-2.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-16 11:54:10', '2024-10-19 20:36:55', 0),
(66, 'Black and White Kit for Chesham FC', 'black-and-white-kit-for-chesham-fc', 800, NULL, '<p><span style=\"font-size: 14.8px;\">Striking the perfect balance of tradition and flair! Check out the new black and white kit for Chesham FC, crafted by Wings Sportswear. ⚽️💥&nbsp;&nbsp;</span></p><p><span style=\"font-size: 14.8px;\">#OnTheRise #NewBeginnings #CheshamFC #WingsSportswear #NewKit</span></p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"black-and-white-kit-for-chesham-fc-1.jpg\"]', NULL, NULL, NULL, NULL, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38', 0),
(67, 'Striking purple and white look', 'striking-purple-and-white-look', 800, 25, '<h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\">Striking purple and white look</font></span></b></h1><h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\"><br></font></span></b></h1><h1 class=\"\"><b><span style=\"font-size: 14.8px; font-family: Arial; background-color: rgb(156, 0, 255);\"><font color=\"#ffffff\"><br></font></span></b></h1><p><span style=\"font-size: 14.8px;\">We look forward to working for your team and are committed to providing your team with the highest quality, contemporary, creatively designed sportswear. Please get in touch with us. We are waiting for you.</span></p><p><span style=\"font-size: 14.8px;\">#OldMansFC #KitReveal #WingsSportswear</span></p>', '[\"1\", \"2\", \"3\", \"4\", \"5\"]', '[\"striking-purple-and-white-look-4.jpg\", \"striking-purple-and-white-look-5.jpg\", \"striking-purple-and-white-look-6.jpg\", \"striking-purple-and-white-look-7.jpg\"]', NULL, NULL, NULL, NULL, 1, '2024-10-19 01:06:43', '2024-10-20 14:04:09', 0),
(68, 'Old Man\'s FC Official Jersey', 'old-mans-fc-official-jersey', 1000, NULL, '<p><span style=\"font-size: 14.8px;\">Old Man\'s FC is ready to turn heads with our brand-new kit design! 🟣⚪️</span></p><p><span style=\"font-size: 14.8px;\"><br></span></p><p><span style=\"font-size: 14.8px;\">Say hello to our striking purple and white look, crafted with care by Wings Sportswear. We can’t wait to hit the pitch in style—are you ready to join us? Let the games begin!</span></p><p><span style=\"font-size: 14.8px;\"><br></span></p><p><span style=\"font-size: 14.8px;\">#OldMansFC #KitReveal #WingsSportswear</span></p>', '[\"1\", \"2\", \"3\", \"4\"]', '[\"old-mans-fc-official-jersey-1.jpg\"]', NULL, NULL, NULL, 'old-mans-fc-official-jersey-og.jpg', 1, '2024-10-19 01:09:48', '2024-10-20 15:01:21', 3);

INSERT INTO `products_clone` (`id`, `title`, `slug`, `price`, `sale`, `categories`, `description`, `specifications`, `images`, `meta_title`, `keywords`, `meta_desc`, `og_image`, `status`, `created_at`, `updated_at`) VALUES
(25, 'new product title updated', 'new-product-title-updated', 100, NULL, '[\"2\", \"3\"]', '<p>new description</p>', '[\"2\", \"3\"]', '[\"new-product-title-1.jpg\"]', NULL, '[null]', NULL, 'new-product-title-updated-og.jpg', 1, '2024-10-14 21:11:08', '2024-10-16 10:07:22'),
(26, 'New product with status', 'new-product-with-status', 100, NULL, '[\"1\", \"2\", \"3\"]', '<p>New description</p>', '[\"1\", \"2\"]', '[\"new-product-with-status-1.jpg\"]', NULL, '[null]', NULL, NULL, 0, '2024-10-14 22:09:07', '2024-10-16 06:05:51'),
(27, 'New product with status published', 'new-product-with-status-published', 699, NULL, '[\"1\", \"2\", \"3\"]', '<p>New description</p>', '[\"1\", \"2\"]', '[\"new-product-with-status-published-1.jpg\"]', NULL, '[\"abnc\"]', NULL, NULL, 1, '2024-10-14 22:09:56', '2024-10-16 09:57:23'),
(29, 'Barcelona Jersey | Concept Jersey', 'barcelona-jersey-concept-jersey', 600, NULL, '[\"1\", \"2\"]', '<h3 style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(17, 17, 17);\" class=\"\"><b>Styled for the ‘70s. Loved in the ‘80s. </b></h3><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(17, 17, 17);\"><br></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\">Classic in the ‘90s. Ready for the future. </span><span style=\"background-color: rgb(255, 255, 0);\">The Nike Blazer Mid ’77 delivers a timeless design that’s easy to wear.</span><font color=\"#111111\"> Its unbelievably crisp leather upper breaks in beautifully and pairs with bold retro branding and luscious suede accents for a premium feel. </font></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><font color=\"#111111\"><br></font></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><font color=\"#111111\"><br></font></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><font color=\"#111111\"><br></font></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><font color=\"#111111\"><br></font></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><font color=\"#111111\">Exposed foam on the tongue and a special midsole finish make it look like you’ve just pulled them from the history books. <a href=\"https://oyelab.com\" target=\"_blank\">Go ahead, perfect your outfit.</a></font></p><p><br style=\"box-sizing: inherit; color: rgb(17, 17, 17); font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\"></p><ul class=\"css-1vql4bw eru6lik0 nds-list\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; list-style: none; color: rgb(17, 17, 17);\"><li data-testid=\"product-description-color-description\" style=\"box-sizing: inherit; margin: 0px 0px 0px 27px; padding-top: 0px; padding-right: 0px; padding-bottom: var(--podium-cds-size-spacing-xs); padding-left: 0px; border: 0px; font: var(--podium-cds-typography-body1); vertical-align: baseline; list-style: disc;\">Shown:&nbsp;White/Sail/Peach/Black</li><li data-testid=\"product-description-style-color\" style=\"box-sizing: inherit; margin: 0px 0px 0px 27px; padding-top: 0px; padding-right: 0px; padding-bottom: var(--podium-cds-size-spacing-xs); padding-left: 0px; border: 0px; font: var(--podium-cds-typography-body1); vertical-align: baseline; list-style: disc;\">Style:&nbsp;CZ1055-100</li></ul>', '[\"1\", \"2\", \"3\"]', '[\"barcelona-jersey-concept-jersey-1.jpg\", \"barcelona-jersey-concept-jersey-2.jpg\", \"barcelona-jersey-concept-jersey-3.jpg\", \"barcelona-jersey-concept-jersey-4.jpg\", \"barcelona-jersey-concept-jersey-5.jpg\", \"barcelona-jersey-concept-jersey-6.jpg\"]', 'Meta Title', '[\"abc,new tag\"]', 'Meta description', 'barcelona-jersey-concept-jersey-og.jpg', 1, '2024-10-15 09:52:08', '2024-10-15 09:52:08'),
(30, 'Barcelona Jersey', 'barcelona-jersey', 800, NULL, '[\"2\", \"3\"]', '<h1 style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(17, 17, 17);\" class=\"\"><b>Styled for the ‘70s. </b></h1><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(17, 17, 17);\"><br></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\">Loved in the ‘80s. Classic in the ‘90s. Ready for the future. <a href=\"https://oyelab.com\" target=\"_blank\">The Nike</a> Blazer Mid ’77 delivers a timeless design that’s easy to wear. Its unbelievably crisp leather upper breaks in beautifully and pairs with bold retro branding and luscious suede accents for a premium feel.&nbsp;</span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\">Exposed foam on the tongue and a special midsole finish make it look like you’ve just pulled them from the history books. </span><span style=\"background-color: rgb(255, 255, 0);\">Go ahead, perfect your outfit.</span></p><p><br style=\"box-sizing: inherit; color: rgb(17, 17, 17); font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\"></p><ul class=\"css-1vql4bw eru6lik0 nds-list\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; list-style: none; color: rgb(17, 17, 17);\"><li data-testid=\"product-description-color-description\" style=\"box-sizing: inherit; margin: 0px 0px 0px 27px; padding-top: 0px; padding-right: 0px; padding-bottom: var(--podium-cds-size-spacing-xs); padding-left: 0px; border: 0px; font: var(--podium-cds-typography-body1); vertical-align: baseline; list-style: disc;\">Shown:&nbsp;White/Sail/Peach/Black</li><li data-testid=\"product-description-style-color\" style=\"box-sizing: inherit; margin: 0px 0px 0px 27px; padding-top: 0px; padding-right: 0px; padding-bottom: var(--podium-cds-size-spacing-xs); padding-left: 0px; border: 0px; font: var(--podium-cds-typography-body1); vertical-align: baseline; list-style: disc;\">Style:&nbsp;CZ1055-100</li></ul>', '[\"1\", \"2\", \"3\", \"4\"]', '[\"barcelona-jersey-1.jpg\", \"barcelona-jersey-2.jpg\", \"barcelona-jersey-3.jpg\", \"barcelona-jersey-4.jpg\", \"barcelona-jersey-5.jpg\"]', NULL, '[null]', NULL, 'barcelona-jersey-og.jpg', 1, '2024-10-15 10:18:32', '2024-10-16 05:33:58'),
(31, 'Barcelona Jersey | Visca', 'barcelona-jersey-visca', 600, NULL, '[\"2\", \"3\"]', '<h1 style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(17, 17, 17);\" class=\"\"><b>Styled for the ‘70s. </b></h1><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline; color: rgb(17, 17, 17);\"><br></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\">Loved in the ‘80s. Classic in the ‘90s. Ready for the future. <a href=\"https://oyelab.com\" target=\"_blank\">The Nike</a> Blazer Mid ’77 delivers a timeless design that’s easy to wear. Its unbelievably crisp leather upper breaks in beautifully and pairs with bold retro branding and luscious suede accents for a premium feel.&nbsp;</span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\"><br></span></p><p class=\"nds-text css-pxxozx e1yhcai00 text-align-start appearance-body1 color-primary weight-regular\" data-testid=\"product-description\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-size: 16px; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; vertical-align: baseline;\"><span style=\"color: rgb(17, 17, 17);\">Exposed foam on the tongue and a special midsole finish make it look like you’ve just pulled them from the history books. </span><span style=\"background-color: rgb(255, 255, 0);\">Go ahead, perfect your outfit.</span></p><p><br style=\"box-sizing: inherit; color: rgb(17, 17, 17); font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\"></p><ul class=\"css-1vql4bw eru6lik0 nds-list\" style=\"box-sizing: inherit; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-variant-alternates: inherit; font-variant-position: inherit; font-stretch: inherit; font-size: 16px; line-height: inherit; font-family: &quot;Helvetica Now Text&quot;, Helvetica, Arial, sans-serif; font-optical-sizing: inherit; font-size-adjust: inherit; font-kerning: inherit; font-feature-settings: inherit; font-variation-settings: inherit; vertical-align: baseline; list-style: none; color: rgb(17, 17, 17);\"><li data-testid=\"product-description-color-description\" style=\"box-sizing: inherit; margin: 0px 0px 0px 27px; padding-top: 0px; padding-right: 0px; padding-bottom: var(--podium-cds-size-spacing-xs); padding-left: 0px; border: 0px; font: var(--podium-cds-typography-body1); vertical-align: baseline; list-style: disc;\">Shown:&nbsp;White/Sail/Peach/Black</li><li data-testid=\"product-description-style-color\" style=\"box-sizing: inherit; margin: 0px 0px 0px 27px; padding-top: 0px; padding-right: 0px; padding-bottom: var(--podium-cds-size-spacing-xs); padding-left: 0px; border: 0px; font: var(--podium-cds-typography-body1); vertical-align: baseline; list-style: disc;\">Style:&nbsp;CZ1055-100</li></ul>', '[\"1\", \"2\", \"3\", \"4\"]', '[\"barcelona-jersey-visca-1.jpg\", \"barcelona-jersey-visca-2.jpg\", \"barcelona-jersey-visca-5.jpg\"]', NULL, '[null]', NULL, 'barcelona-jersey-visca-og.jpg', 1, '2024-10-15 10:25:07', '2024-10-16 05:31:09'),
(32, 'Bacelona Jersey', 'bacelona-jersey', 120, NULL, '[\"1\", \"2\", \"3\"]', '<p><span style=\"font-size: 14.8px;\">barcelona-jersey description</span><br></p>', '[\"1\", \"2\", \"3\"]', '[\"bacelona-jersey-1.jpg\", \"bacelona-jersey-2.jpg\", \"bacelona-jersey-3.jpg\", \"bacelona-jersey-4.jpg\", \"bacelona-jersey-5.jpg\"]', 'this is title', '[\"tags,new prodcut\"]', 'this is description', 'bacelona-jersey-og.jpg', 1, '2024-10-15 10:26:22', '2024-10-16 05:33:00'),
(35, 'Hala Madrid | Real madrid official jersey', 'hala-madrid-real-madrid-official-jersey', 700, NULL, '[\"1\", \"2\"]', '<p>description</p>', '[\"1\", \"2\", \"3\"]', '[\"hala-madrid-real-madrid-official-jersey-1.jpg\", \"hala-madrid-real-madrid-official-jersey-2.jpg\", \"hala-madrid-real-madrid-official-jersey-3.jpg\", \"hala-madrid-real-madrid-official-jersey-4.jpg\", \"hala-madrid-real-madrid-official-jersey-5.jpg\", \"hala-madrid-real-madrid-official-jersey-6.jpg\", \"hala-madrid-real-madrid-official-jersey-7.jpg\", \"hala-madrid-real-madrid-official-jersey-8.jpg\", \"hala-madrid-real-madrid-official-jersey-9.jpg\"]', 'This is meta title', '[\"ABc,new\"]', 'description', 'hala-madrid-real-madrid-official-jersey-og.jpg', 1, '2024-10-15 11:03:01', '2024-10-15 11:03:01'),
(36, 'Hala Madrid | Real madrid official jersey | Another', 'hala-madrid-real-madrid-official-jersey-another', 700, 20.00, '[\"1\", \"2\"]', '<p>description</p>', '[\"1\", \"2\", \"3\"]', '[\"hala-madrid-real-madrid-official-jersey-another-1.jpg\", \"hala-madrid-real-madrid-official-jersey-another-2.jpg\", \"hala-madrid-real-madrid-official-jersey-another-3.jpg\", \"hala-madrid-real-madrid-official-jersey-another-4.jpg\", \"hala-madrid-real-madrid-official-jersey-another-5.jpg\", \"hala-madrid-real-madrid-official-jersey-another-6.jpg\", \"hala-madrid-real-madrid-official-jersey-another-7.jpg\", \"hala-madrid-real-madrid-official-jersey-another-8.jpg\", \"hala-madrid-real-madrid-official-jersey-another-9.jpg\"]', 'This is meta title', '[\"new,hala madrid\"]', 'description', 'hala-madrid-real-madrid-official-jersey-another-og.jpg', 0, '2024-10-15 11:04:24', '2024-10-15 11:04:24'),
(37, 'new', 'new', 100, NULL, '[\"2\"]', '<p>abc</p>', '[\"2\", \"3\"]', '[\"new-1.jpg\"]', 'abc', '[\"abc,ac\"]', 'abc', NULL, 1, '2024-10-15 11:21:38', '2024-10-15 11:21:38'),
(38, 'abc new title barca', 'abc-new-title-barca', 50, NULL, '[\"2\"]', '<p><br></p>', NULL, '[\"abc-new-title-barca-1.jpg\"]', NULL, '[null]', NULL, NULL, 1, '2024-10-15 11:30:25', '2024-10-16 10:27:18'),
(39, 'abc zero', 'abc-zero', 220, NULL, '[\"1\", \"2\"]', '<p><br></p>', NULL, '[\"abc-zero-1.jpg\"]', NULL, '[null]', NULL, NULL, 1, '2024-10-15 11:36:22', '2024-10-15 11:36:22'),
(40, 'akash', 'akash', 220, NULL, '[\"2\", \"3\"]', '<p><br></p>', NULL, '[\"akash-1.jpg\", \"akash-2.jpg\", \"akash-3.jpg\", \"akash-4.jpg\"]', NULL, '[null]', NULL, NULL, 1, '2024-10-15 11:38:56', '2024-10-15 11:38:56'),
(41, 'abc a', 'abc-a', 1, NULL, '[\"1\", \"2\", \"3\"]', '<p><br></p>', NULL, '[\"abc-a-1.jpg\"]', NULL, '[\"abc\"]', NULL, NULL, 1, '2024-10-15 12:43:56', '2024-10-15 12:43:56'),
(42, 'axp', 'axp', 200, 50.00, '[\"2\", \"3\"]', '<p>ok</p>', NULL, '[\"axp-1.jpg\"]', NULL, '[\"abc,keyword\"]', NULL, NULL, 1, '2024-10-15 13:30:17', '2024-10-15 13:30:17'),
(43, 'abc new title sok', 'abc-new-title-sok', 220, NULL, '[\"1\", \"2\"]', '<p>description</p>', NULL, '[\"abc-new-title-sok-1.jpg\", \"abc-new-title-sok-2.jpg\", \"abc-new-title-sok-3.jpg\", \"abc-new-title-sok-4.jpg\", \"abc-new-title-sok-5.jpg\"]', NULL, '[null]', NULL, NULL, 1, '2024-10-15 13:57:52', '2024-10-15 13:57:52'),
(44, 'product title', 'product-title', 200, 20.00, '[\"2\", \"3\"]', '<p><br></p>', '[\"2\", \"4\"]', '[\"product-title-1.jpg\"]', NULL, '[null]', NULL, NULL, 1, '2024-10-15 14:15:03', '2024-10-15 14:15:03'),
(45, 'Title', 'title', 120, NULL, '[\"2\", \"3\"]', '<p>description</p>', '[\"4\", \"5\"]', '[\"product-title-1.jpg\"]', 'title', '[\"abc,tag\"]', NULL, NULL, 1, '2024-10-16 05:39:49', '2024-10-16 05:39:49'),
(46, 'New This is product title', 'new-this-is-product-title', 120, NULL, '[\"2\", \"3\"]', '<p>this is description</p>', '[\"2\", \"3\"]', '[\"new-this-is-product-title-1.jpg\", \"new-this-is-product-title-2.jpg\", \"new-this-is-product-title-3.jpg\"]', 'title', '[null]', NULL, 'new-this-is-product-title-og.jpg', 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(47, 'BarcaAction Djersy', 'barcaaction-djersy', 120, NULL, '[\"2\", \"3\", \"4\"]', '<p>any description</p>', '[\"2\", \"3\"]', '[\"barcaaction-djersy-1.jpg\"]', NULL, '[null]', NULL, 'barcaaction-djersy-og.jpg', 0, '2024-10-16 08:37:47', '2024-10-16 11:23:52'),
(49, 'status check', 'status-check', 220, NULL, '[\"3\", \"4\"]', '<p>descritpion</p>', '[\"3\"]', '[\"status-check-1.jpg\"]', NULL, NULL, NULL, NULL, 0, '2024-10-16 10:36:17', '2024-10-16 11:24:43');

INSERT INTO `quantities` (`id`, `product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(181, 41, 1, 100, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(182, 41, 2, 200, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(183, 41, 3, 300, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(184, 41, 4, 400, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(185, 41, 5, 100, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(186, 41, 6, 50, '2024-10-15 12:43:56', '2024-10-17 20:10:57'),
(187, 42, 1, 100, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(188, 42, 2, 100, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(189, 42, 3, 100, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(190, 42, 4, 50, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(191, 42, 5, 50, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(192, 42, 6, 50, '2024-10-15 13:30:17', '2024-10-17 20:07:39'),
(193, 43, 1, 200, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(194, 43, 2, 100, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(195, 43, 3, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(196, 43, 4, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(197, 43, 5, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(198, 43, 6, 0, '2024-10-15 13:57:52', '2024-10-17 20:04:59'),
(199, 44, 1, 200, '2024-10-15 14:15:03', '2024-10-15 14:15:03'),
(200, 44, 2, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(201, 44, 3, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(202, 44, 4, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(203, 44, 5, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(204, 44, 6, 0, '2024-10-15 14:15:03', '2024-10-17 20:02:11'),
(205, 45, 1, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(206, 45, 2, 200, '2024-10-16 05:39:49', '2024-10-16 05:39:49'),
(207, 45, 3, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(208, 45, 4, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(209, 45, 5, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(210, 45, 6, 0, '2024-10-16 05:39:49', '2024-10-17 20:00:33'),
(211, 46, 1, 100, '2024-10-16 05:53:59', '2024-10-17 19:58:40'),
(212, 46, 2, 220, '2024-10-16 05:53:59', '2024-10-16 05:53:59'),
(213, 46, 3, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(214, 46, 4, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(215, 46, 5, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(216, 46, 6, 0, '2024-10-16 05:53:59', '2024-10-16 10:16:14'),
(283, 54, 1, 200, '2024-10-16 21:47:37', '2024-10-17 19:55:56'),
(284, 54, 2, 200, '2024-10-16 21:47:37', '2024-10-17 19:55:56'),
(285, 54, 3, 100, '2024-10-16 21:47:37', '2024-10-17 19:55:56'),
(286, 54, 4, 100, '2024-10-16 21:47:37', '2024-10-17 19:55:56'),
(287, 54, 5, 50, '2024-10-16 21:47:37', '2024-10-17 19:55:56'),
(288, 54, 6, 25, '2024-10-16 21:47:37', '2024-10-17 19:55:56'),
(295, 66, 1, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38'),
(296, 66, 2, 200, '2024-10-19 01:03:45', '2024-10-19 01:03:45'),
(297, 66, 3, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38'),
(298, 66, 4, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38'),
(299, 66, 5, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38'),
(300, 66, 6, 0, '2024-10-19 01:03:45', '2024-10-19 20:36:38'),
(301, 67, 1, 0, '2024-10-19 01:06:43', '2024-10-19 12:23:55'),
(302, 67, 2, 200, '2024-10-19 01:06:43', '2024-10-19 01:06:43'),
(303, 67, 3, 100, '2024-10-19 01:06:43', '2024-10-19 01:06:43'),
(304, 67, 4, 0, '2024-10-19 01:06:43', '2024-10-19 12:23:55'),
(305, 67, 5, 0, '2024-10-19 01:06:43', '2024-10-19 12:23:55'),
(306, 67, 6, 0, '2024-10-19 01:06:43', '2024-10-19 12:23:55'),
(307, 68, 1, 0, '2024-10-19 01:09:48', '2024-10-19 01:10:12'),
(308, 68, 2, 100, '2024-10-19 01:09:48', '2024-10-19 01:09:48'),
(309, 68, 3, 0, '2024-10-19 01:09:48', '2024-10-19 01:10:12'),
(310, 68, 4, 0, '2024-10-19 01:09:48', '2024-10-19 01:10:12'),
(311, 68, 5, 0, '2024-10-19 01:09:48', '2024-10-19 01:10:12'),
(312, 68, 6, 0, '2024-10-19 01:09:48', '2024-10-19 01:10:12');

INSERT INTO `sections` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Latest', NULL, NULL),
(2, 'Popular', NULL, NULL),
(3, 'Trending', NULL, NULL),
(4, 'Sale', NULL, NULL),
(5, 'Portfolio 1', NULL, NULL),
(6, 'Portfolio 2', NULL, NULL);

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'S', NULL, NULL),
(2, 'M', NULL, NULL),
(3, 'L', NULL, NULL),
(4, 'XL', NULL, NULL),
(5, 'XXL', NULL, NULL),
(6, 'XXXL', NULL, NULL);

INSERT INTO `sliders` (`id`, `title`, `order`, `status`, `image`, `created_at`, `updated_at`) VALUES
(33, 'Keep Flying', NULL, 0, 'keep-flying.jpg', '2024-10-18 22:07:35', '2024-10-20 13:59:50'),
(36, 'Wings Edited', 5, 1, 'wings-edited.png', '2024-10-19 00:04:14', '2024-10-19 06:04:56'),
(37, 'Get Our Customised Sportwear', 2, 1, 'get-our-customised-sportwear.jpg', '2024-10-19 00:12:44', '2024-10-19 06:06:13'),
(38, 'Mohammedan Banner', 3, 1, 'mohammedan-banner.png', '2024-10-19 00:25:51', '2024-10-19 06:04:43'),
(39, 'New Slider', 1, 1, 'new-slider.jpg', '2024-10-20 13:59:50', '2024-10-20 13:59:50');

INSERT INTO `specifications` (`id`, `item`, `created_at`, `updated_at`) VALUES
(1, 'Fully Digital Sublimation Printed.', NULL, NULL),
(2, 'Export Quality Double Knitted Fabrics', NULL, NULL),
(3, '150 GSM.', NULL, NULL),
(4, 'Regular Fit, Raglan Sleeve, Crew Neck.', NULL, NULL),
(5, 'Twin Needle Topstitch Swing.', NULL, NULL);

INSERT INTO `specifications_old` (`id`, `item`, `created_at`, `updated_at`) VALUES
(1, 'Fully Digital Sublimation Printed.', NULL, NULL),
(2, 'Export Quality Double Knitted Fabrics', NULL, NULL),
(3, '150 GSM.', NULL, NULL),
(4, 'Regular Fit, Raglan Sleeve, Crew Neck.', NULL, NULL),
(5, 'Twin Needle Topstitch Swing.', NULL, NULL);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@themesbrand.com', NULL, '$2y$10$O85YZelI.z8.UI3Pjk9zi.DPwC8xwN5p.bgvpowSZmtJIIe75c2gW', NULL, '2024-10-13 07:10:32', '2024-10-13 07:10:32'),
(2, 'Faisal', 'me@faisal.one', NULL, '$2y$10$zCzYfpLZR3NrRw4fW0mkp.ONCdNDKmbS6xDPNmH.ffcuplMUMgcwG', NULL, '2024-10-14 14:04:50', '2024-10-14 14:04:50');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;