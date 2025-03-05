-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th5 12, 2022 lúc 10:36 PM
-- Phiên bản máy phục vụ: 8.0.26-0ubuntu0.20.04.2
-- Phiên bản PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `1dg`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `actions`
--

CREATE TABLE `actions` (
  `id` int NOT NULL,
  `id_social` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `actions`
--

INSERT INTO `actions` (`id`, `id_social`, `name`, `code`, `slug`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tăng Like Bài Viết', 'bufflike', 'like-post-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(2, 1, 'Tăng Like Bài Viết', 'likepost', 'like-post-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(3, 1, 'Tăng Sub/Follow FB Cá Nhân', 'follow', 'follow-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(4, 1, 'Tăng Like/Follow Fanpage', 'likepage', 'like-fanpage-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(5, 1, 'Tăng Bình Luận Bài Viết', 'buffcomment', 'comment-post-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(6, 1, 'Tăng Like Bình Luận', 'likecomment', 'like-comment-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(7, 1, 'Tăng Chia Sẻ Bài Viết', 'sharepost', 'share-post-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(8, 1, 'Tăng Đánh Giá Fanpage', 'reviewfanpage', 'review-fanpage-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(9, 1, 'Tăng Mắt Live Stream', 'eyelivestream', 'mat-livestream-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(10, 1, 'Tăng Thành Viên Nhóm', 'membergroup', 'member-group-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(11, 1, 'Vip Like Bài Viết Facebook', 'viplikeService', 'vip-like-facebook', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(12, 2, 'Tăng Like Instagram', 'likeinstagram', 'like-instagram', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(13, 2, 'Tăng Comment Instagram', 'commentinstagram', 'comment-instagram', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(14, 2, 'Tăng Follow Instagram', 'followinstagram', 'follow-instagram', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(15, 3, 'Tăng Tim Tiktok', 'timtiktok', 'tim-tiktok', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(16, 3, 'Tăng Follow Tiktok', 'followtiktok', 'follow-tiktok', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(17, 3, 'Tăng View Tiktok', 'viewtiktok', 'view-tiktok', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(18, 4, 'Tăng Like Sản Phẩm', 'likeshopee', 'like-shopee', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36'),
(19, 4, 'Tăng Follow Shopee', 'followshopee', 'follow-shopee', '', 1, '2021-06-28 08:56:36', '2021-06-28 08:56:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin_level` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `email`, `name`, `password`, `admin_level`, `created_at`, `updated_at`) VALUES
(56789, 'social@gmail.com', 'Admin', '$2y$10$/42vjOehSFF3rn2HGdB6XeuSK.BpdihJf2Rsp70Sw8dlL3Dj57G.m', 99999, '2020-07-17 01:58:46', '2020-07-17 01:58:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` int NOT NULL,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parent` int UNSIGNED NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu` int UNSIGNED NOT NULL,
  `depth` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rel` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT 'dofollow',
  `target` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '_self'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cash_flows`
--

CREATE TABLE `cash_flows` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int DEFAULT '0',
  `type` text,
  `total_cash` double NOT NULL,
  `cash` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `cash_flows`
--

INSERT INTO `cash_flows` (`id`, `user_id`, `order_id`, `type`, `total_cash`, `cash`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 'Add order', 2.094, '-0.08', '2022-04-24 15:56:18', NULL),
(3, 3, 1, 'Canceled', 2.174, '+0.08', '2022-04-24 16:26:28', NULL),
(6, 3, 0, 'DEPOSIT', 2.174, '+2.174', '2022-04-25 00:49:57', '2022-04-25 00:49:57'),
(7, 3, 0, 'DEPOSIT', 4.348, '+2.174', '2022-04-25 00:50:05', '2022-04-25 00:50:05'),
(9, 3, 3, 'Add order', 4.956, '-0.044', '2022-04-25 15:45:15', '2022-04-25 15:45:15'),
(10, 3, 4, 'Add order', 4.908, '-0.048', '2022-04-25 16:47:01', '2022-04-25 16:47:01'),
(11, 4, 0, 'DEPOSIT', 2.174, '+2.174', '2022-04-26 13:55:52', '2022-04-26 13:55:52'),
(12, 4, 5, 'Add order', 2.094, '-0.08', '2022-04-26 14:04:53', '2022-04-26 14:04:53'),
(13, 4, 6, 'Add order', 2.014, '-0.08', '2022-04-26 14:20:52', '2022-04-26 14:20:52'),
(14, 4, 7, 'Add order', 1.934, '-0.08', '2022-04-26 14:20:52', '2022-04-26 14:20:52'),
(15, 3, 8, 'Add order', 4.828, '-0.08', '2022-04-26 16:14:46', '2022-04-26 16:14:46'),
(16, 9, 0, 'DEPOSIT', 0.097, '+0.097', '2022-04-27 21:33:07', '2022-04-27 21:33:07'),
(17, 3, 9, 'Add order', 4.78, '-0.048', '2022-04-28 15:51:24', '2022-04-28 15:51:24'),
(18, 3, 12, 'Add order', 0, '-0', '2022-05-12 14:25:33', '2022-05-12 14:25:33'),
(19, 3, 13, 'Add order', 4.7349, '-0.0451', '2022-05-12 14:30:41', '2022-05-12 14:30:41'),
(20, 3, 14, 'Add order', 4.735, '-0.045', '2022-05-12 15:26:37', '2022-05-12 15:26:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `category_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name_lang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `category_line` double NOT NULL,
  `category_type` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2',
  `status` int NOT NULL DEFAULT '1',
  `category_secret` enum('1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '2',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `name_lang`, `category_line`, `category_type`, `status`, `category_secret`, `created_at`, `updated_at`) VALUES
(9, 'Facebook - Post Likes | Tăng likes bài viết', NULL, 0, '2', 1, '2', '2022-05-12 13:09:24', '2022-05-12 13:09:24'),
(11, 'Facebook - 𝐕𝐈𝐄𝐓 𝐍𝐀𝐌 🇻🇳', NULL, 0, '2', 1, '2', '2022-05-12 13:29:22', '2022-05-12 13:29:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configs`
--

CREATE TABLE `configs` (
  `id` int NOT NULL,
  `convert_vnd` int NOT NULL,
  `convert_usd` int NOT NULL,
  `type_money` varchar(255) DEFAULT NULL,
  `key_1dg` text,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_forget_pass_otp`
--

CREATE TABLE `customer_forget_pass_otp` (
  `id` int NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `otp_mail` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `email_jobs`
--

CREATE TABLE `email_jobs` (
  `id` int NOT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `email_jobs`
--

INSERT INTO `email_jobs` (`id`, `user_id`, `content`, `status`, `created_at`, `updated_at`) VALUES
(2, 225, '7', 1, '2021-06-13 22:08:45', '2021-06-14 00:47:05'),
(3, 225, '7_94', 1, '2021-06-13 22:09:33', '2021-06-14 00:23:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message_telegrams`
--

CREATE TABLE `message_telegrams` (
  `id` int UNSIGNED NOT NULL,
  `brand_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2017_08_11_073824_create_menus_wp_table', 2),
(10, '2017_08_11_074006_create_menu_items_wp_table', 2),
(11, '2020_07_15_140148_create_admins_table', 2),
(12, '2020_07_15_140305_create_orders_table', 2),
(13, '2020_07_16_032604_create_setting_table', 2),
(14, '2020_07_17_014519_create_transactions_table', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  `api_orderid` int NOT NULL DEFAULT '0',
  `order_error` text NOT NULL,
  `order_detail` text NOT NULL,
  `order_api` int NOT NULL DEFAULT '0',
  `api_serviceid` int NOT NULL DEFAULT '0',
  `api_charge` double DEFAULT NULL,
  `api_currencycharge` double NOT NULL DEFAULT '1',
  `order_profit` double NOT NULL,
  `order_quantity` double NOT NULL,
  `order_extras` text NOT NULL,
  `order_charge` double DEFAULT NULL,
  `dripfeed` enum('1','2','3') DEFAULT '1' COMMENT '2 -> ON, 1 -> OFF',
  `dripfeed_id` double NOT NULL DEFAULT '0',
  `subscriptions_id` double NOT NULL DEFAULT '0',
  `subscriptions_type` enum('1','2') NOT NULL DEFAULT '1' COMMENT '2 -> ON, 1 -> OFF',
  `dripfeed_totalcharges` double DEFAULT NULL,
  `dripfeed_runs` double DEFAULT NULL,
  `dripfeed_delivery` double NOT NULL DEFAULT '0',
  `dripfeed_interval` double DEFAULT NULL,
  `dripfeed_totalquantity` double DEFAULT NULL,
  `dripfeed_status` enum('active','completed','canceled') NOT NULL DEFAULT 'active',
  `order_url` text NOT NULL,
  `order_start` double NOT NULL DEFAULT '0',
  `order_finish` double NOT NULL DEFAULT '0',
  `order_remains` double NOT NULL DEFAULT '0',
  `order_create` datetime NOT NULL,
  `order_status` enum('pending','inprogress','completed','partial','processing','canceled') NOT NULL DEFAULT 'pending',
  `subscriptions_status` enum('active','paused','completed','canceled','expired','limit') NOT NULL DEFAULT 'active',
  `subscriptions_username` text,
  `subscriptions_posts` double DEFAULT NULL,
  `subscriptions_delivery` double NOT NULL DEFAULT '0',
  `subscriptions_delay` double DEFAULT NULL,
  `subscriptions_min` double DEFAULT NULL,
  `subscriptions_max` double DEFAULT NULL,
  `subscriptions_expiry` date DEFAULT NULL,
  `last_check` datetime NOT NULL,
  `order_where` enum('site','api') NOT NULL DEFAULT 'site',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `service_id`, `api_orderid`, `order_error`, `order_detail`, `order_api`, `api_serviceid`, `api_charge`, `api_currencycharge`, `order_profit`, `order_quantity`, `order_extras`, `order_charge`, `dripfeed`, `dripfeed_id`, `subscriptions_id`, `subscriptions_type`, `dripfeed_totalcharges`, `dripfeed_runs`, `dripfeed_delivery`, `dripfeed_interval`, `dripfeed_totalquantity`, `dripfeed_status`, `order_url`, `order_start`, `order_finish`, `order_remains`, `order_create`, `order_status`, `subscriptions_status`, `subscriptions_username`, `subscriptions_posts`, `subscriptions_delivery`, `subscriptions_delay`, `subscriptions_min`, `subscriptions_max`, `subscriptions_expiry`, `last_check`, `order_where`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, '{\"error\":\"API is Disable for this user or User Not Found! Contact the Support\"}', '{\"error\":\"API is Disable for this user or User Not Found! Contact the Support\"}', 7, 9, 0, 1, 0, 111, '', 0.0257853, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://cfun6868.xyz', 0, 0, 0, '2022-04-11 15:42:31', 'pending', 'active', '', 0, 0, 0, 0, 0, '1970-01-01', '2022-04-11 15:42:31', 'site', '2022-05-12 03:07:45', NULL),
(2, 1, 1, 0, '{\"error\":\"API is Disable for this user or User Not Found! Contact the Support\"}', '{\"error\":\"API is Disable for this user or User Not Found! Contact the Support\"}', 7, 9, 0, 1, 0, 111, '', 0.0257853, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://cfun6868.xyz', 0, 0, 0, '2022-04-11 15:53:26', 'pending', 'active', '', 0, 0, 0, 0, 0, '1970-01-01', '2022-04-11 15:53:26', 'site', '2022-05-12 03:07:45', NULL),
(3, 1, 11, 0, '-', '', 0, 0, NULL, 1, 0.555, 111, '', 0.555, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://cfun6868.xyz', 0, 0, 0, '2022-04-11 15:54:08', 'completed', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 15:54:08', 'site', '2022-05-12 03:07:45', NULL),
(4, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.0257853, 111, '', 0.0257853, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://cfun6868.xyz', 0, 0, 0, '2022-04-11 15:56:24', 'completed', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 15:56:24', 'site', '2022-05-12 03:07:45', NULL),
(5, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.0515706, 167, '', 0.0387941, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://cfun6868.xyz', 0, 0, 55, '2022-04-11 16:06:01', 'partial', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 16:06:01', 'site', '2022-05-12 03:07:45', NULL),
(6, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.0773559, 333, '', 0.0773559, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://cfun6868.xyz', 0, 0, 0, '2022-04-11 16:07:05', 'completed', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 16:07:05', 'site', '2022-05-12 03:07:45', NULL),
(7, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.011615, 50, '', 0.011615, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'cheapestsmmscript', 0, 0, 0, '2022-04-11 17:08:57', 'pending', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 17:08:57', 'site', '2022-05-12 03:07:45', NULL),
(8, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.011615, 50, '', 0.011615, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'Akkaka', 0, 0, 0, '2022-04-11 17:15:10', 'inprogress', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 17:15:10', 'site', '2022-05-12 03:07:45', NULL),
(9, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.2323, 1000, '', 0.2323, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://www.youtube.com/watch?v=sXa8ylsdaE4&amp;list=RDMM&amp;index=7', 0, 0, 0, '2022-04-11 17:18:13', 'completed', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 17:18:13', 'site', '2022-05-12 03:07:45', NULL),
(10, 1, 1, 0, '-', '', 0, 0, 0, 1, 0, 0, '', 0, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'Am', 0, 0, 50, '2022-04-11 17:41:58', 'canceled', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-11 17:41:58', 'site', '2022-05-12 03:07:45', NULL),
(11, 1, 1, 0, '-', '', 0, 0, NULL, 1, 0.4646, 2000, '', 0.4646, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://www.youtube.com/c/AutomotiveLifeTV', 0, 0, 0, '2022-04-15 18:06:37', 'inprogress', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-04-15 18:06:37', 'site', '2022-05-12 03:07:45', NULL),
(14, 3, 64, 5496078, '-', '{\"order\":5496078}', 6, 382, NULL, 1, 60, 60, '', 0.045, '1', 0, 0, '1', NULL, NULL, 0, NULL, NULL, 'active', 'https://www.facebook.com/shoptheme.com.vn/posts/168901258839099', 0, 0, 0, '2022-05-12 22:26:37', 'pending', 'active', NULL, NULL, 0, NULL, NULL, NULL, NULL, '2022-05-12 22:26:37', 'site', '2022-05-12 15:26:37', '2022-05-12 15:26:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderss`
--

CREATE TABLE `orderss` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `service` text,
  `service_id` int NOT NULL,
  `start` int NOT NULL,
  `link` text,
  `charge` varchar(255) DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `quantity` int NOT NULL,
  `remains` int NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `orderss`
--

INSERT INTO `orderss` (`id`, `user_id`, `order_id`, `service`, `service_id`, `start`, `link`, `charge`, `note`, `quantity`, `remains`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 'Facebook Likes Việt Nam | Max 100k | Speed 100-500 likes/days', 382, 0, 'asdasdsad', '0.0000000000', '', 100, 100, 'Canceled', '2022-04-24 14:01:42', '2022-04-24 14:05:49'),
(3, 3, 5373050, 'Tăng Likes bài viết Facebook', 338, 0, 'https://www.facebook.com/shoptheme.com.vn/posts/165418855854006', '0.044', '', 55, 0, 'Completed', '2022-04-25 15:45:15', '2022-04-25 17:07:40'),
(4, 3, 5373362, 'Tăng Love bài viết Facebook', 339, 55, 'https://www.facebook.com/shoptheme.com.vn/posts/165418855854006', '0.048', '', 60, 0, 'Completed', '2022-04-25 16:47:01', '2022-04-25 17:19:36'),
(5, 4, 5380824, 'Tăng Likes bài viết Facebook', 338, 5, 'https://www.facebook.com/photo/?fbid=124434115764252&set=a.101721751368822', '0.08', '', 100, 0, 'Completed', '2022-04-26 14:04:53', '2022-04-26 15:15:02'),
(6, 4, 5380911, 'Tăng Likes bài viết Facebook', 338, 110, 'https://www.facebook.com/photo/?fbid=124434115764252&set=a.101721751368822', '0.08', '', 100, 0, 'Completed', '2022-04-26 14:20:52', '2022-04-26 15:15:02'),
(7, 4, 5380912, 'Tăng Likes bài viết Facebook', 338, 9, 'https://https://www.facebook.com/xuannam.truong.752/posts/101734294700901', '0.08', '', 100, 0, 'Completed', '2022-04-26 14:20:52', '2022-04-26 15:15:01'),
(8, 3, 5381703, 'Tăng Likes bài viết Facebook', 338, 10, 'https://www.facebook.com/shoptheme.com.vn/posts/165418855854006', '0.08', '', 100, 0, 'Completed', '2022-04-26 16:14:46', '2022-04-26 17:15:01'),
(9, 3, 5398283, 'Tăng Likes bài viết Facebook', 338, 30, 'https://www.facebook.com/tinhto28/posts/3216926758592681', '0.048', '', 60, 0, 'Completed', '2022-04-28 15:51:24', '2022-04-28 17:15:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` int NOT NULL,
  `name` text,
  `details` text,
  `options` text,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int NOT NULL,
  `method_type` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `min` int NOT NULL,
  `max` int NOT NULL,
  `passphrase` text NOT NULL,
  `usd` text NOT NULL,
  `merchant_website` text,
  `fee` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `providers`
--

CREATE TABLE `providers` (
  `id` int NOT NULL,
  `name` text,
  `url` text,
  `apikey` text,
  `balance` varchar(244) NOT NULL DEFAULT '0',
  `currency` varchar(255) DEFAULT NULL,
  `limit_balance` double NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `providers`
--

INSERT INTO `providers` (`id`, `name`, `url`, `apikey`, `balance`, `currency`, `limit_balance`, `status`, `created_at`, `updated_at`) VALUES
(3, '1dg.me', 'http://1dg.me/api/v2', '1db4c77e76f3e2709690f29407c87824', '1.372', 'USD', 0, 1, '2022-05-05 14:56:50', '2022-05-05 15:23:35'),
(5, '1kview.com', 'https://1kview.com/api/v2', '2b593c58e795da7984a626e8135d3cbc', '0.0000000', 'USD', 0, 1, '2022-05-05 15:17:50', '2022-05-05 15:26:03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reactions`
--

CREATE TABLE `reactions` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `reactions`
--

INSERT INTO `reactions` (`id`, `name`, `code`, `image`, `status`) VALUES
(1, 'Thích', 'like', '', 1),
(2, 'Yêu thích', 'love', '', 1),
(3, 'Thương thương', 'favourite', '', 1),
(4, 'Haha', 'haha', '', 1),
(5, 'Wow', 'wow', '', 1),
(6, 'Buồn', 'sad', '', 1),
(7, 'Phẫn nộ', 'angry', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `service_api` int NOT NULL DEFAULT '0',
  `mode` int NOT NULL DEFAULT '1',
  `api_service` int NOT NULL DEFAULT '0',
  `api_servicetype` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2',
  `api_detail` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `service_line` double NOT NULL,
  `service_type` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2',
  `service_package` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `service_name` text NOT NULL,
  `service_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `service_price` double NOT NULL DEFAULT '0',
  `sync_price` int NOT NULL DEFAULT '0',
  `sync_rate` int NOT NULL DEFAULT '0',
  `service_min` double NOT NULL,
  `sync_min` int NOT NULL DEFAULT '0',
  `service_max` double NOT NULL,
  `sync_max` int DEFAULT '0',
  `service_dripfeed` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `service_autotime` double NOT NULL DEFAULT '0',
  `service_autopost` double NOT NULL DEFAULT '0',
  `service_speed` enum('1','2','3','4') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `want_username` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '1',
  `service_secret` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '2',
  `price_type` enum('normal','percent','amount') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'normal',
  `price_cal` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `start_count` enum('none','instagram_follower','instagram_photo','') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `speed_per_day` text,
  `quality` text,
  `guarantee` text,
  `start_time` text,
  `instagram_private` enum('1','2') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name_lang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `description_lang` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `cancel_type` int NOT NULL DEFAULT '1',
  `refill_type` int NOT NULL DEFAULT '1',
  `refill_time` int NOT NULL DEFAULT '0',
  `sync_lastcheck` varchar(225) DEFAULT NULL,
  `provider_lastcheck` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `service_api`, `mode`, `api_service`, `api_servicetype`, `api_detail`, `category_id`, `service_line`, `service_type`, `service_package`, `service_name`, `service_description`, `service_price`, `sync_price`, `sync_rate`, `service_min`, `sync_min`, `service_max`, `sync_max`, `service_dripfeed`, `service_autotime`, `service_autopost`, `service_speed`, `want_username`, `service_secret`, `price_type`, `price_cal`, `start_count`, `speed_per_day`, `quality`, `guarantee`, `start_time`, `instagram_private`, `name_lang`, `description_lang`, `cancel_type`, `refill_type`, `refill_time`, `sync_lastcheck`, `provider_lastcheck`, `created_at`, `updated_at`) VALUES
(63, 6, 1, 222, '2', '{\"min\":100,\"max\":10000,\"rate\":1.3,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Facebook Likes Việt Nam | Max 10k | 10K likes/giờ', NULL, 1.96, 0, 0, 100, 0, 10000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Facebook Likes Việt Nam | Max 10k | 10K likes/giờ\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(64, 6, 1, 382, '2', '{\"min\":50,\"max\":100000,\"rate\":0.5,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Facebook Likes Việt Nam | Max 100k | Speed 100-500 likes/days', NULL, 0.75, 0, 0, 50, 0, 100000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Facebook Likes Việt Nam | Max 100k | Speed 100-500 likes/days\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(65, 6, 1, 338, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng Likes bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng Likes bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(66, 6, 1, 340, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng Care bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng Care bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(67, 6, 1, 339, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng Love bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng Love bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(68, 6, 1, 343, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng Sad bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng Sad bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(69, 6, 1, 344, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng Angry bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng Angry bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(70, 6, 1, 342, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng WoW bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng WoW bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(71, 6, 1, 341, '2', '{\"min\":50,\"max\":1000,\"rate\":0.8,\"currency\":\"USD\"}', 9, 1, '2', '1', 'Tăng HaHa bài viết Facebook', NULL, 1.21, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"Tăng HaHa bài viết Facebook\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:09:49', '2022-05-12 13:09:49'),
(74, 7, 1, 388, '2', '{\"min\":\"100\",\"max\":\"100000\",\"rate\":\"0.27\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©🅿⭐⭐Likes bài đăng 2 - rẻ nhất thế giới / Like Post', NULL, 0.41, 0, 0, 100, 0, 100000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©🅿⭐⭐Likes bài đăng 2 - rẻ nhất thế giới / Like Post\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(75, 7, 1, 500, '2', '{\"min\":\"50\",\"max\":\"20000\",\"rate\":\"1.34\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©🅿⭐⭐Facebook Likes bài đăng 2 - rẻ nhất thế giới / Like Post - Fast', NULL, 2.02, 0, 0, 50, 0, 20000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©🅿⭐⭐Facebook Likes bài đăng 2 - rẻ nhất thế giới / Like Post - Fast\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(76, 7, 1, 568, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"0.35\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©🅿⭐⭐Facebook Likes bài đăng 3', NULL, 0.53, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©🅿⭐⭐Facebook Likes bài đăng 3\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(77, 7, 1, 46, '2', '{\"min\":\"100\",\"max\":\"5000\",\"rate\":\"1.00\",\"currency\":\"USD\"}', 11, 1, '2', '1', '⭐⭐Likes bài đăng 1', NULL, 1.5, 0, 0, 100, 0, 5000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"⭐⭐Likes bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(78, 7, 1, 377, '2', '{\"min\":\"1000\",\"max\":\"10000\",\"rate\":\"0.70\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©⭐⭐Follow trang cá nhân ít tụt / Profile follow less drop', NULL, 1.05, 0, 0, 1000, 0, 10000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©⭐⭐Follow trang cá nhân ít tụt / Profile follow less drop\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(79, 7, 1, 641, '2', '{\"min\":\"1000\",\"max\":\"10000\",\"rate\":\"0.13\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©⭐⭐Follow trang cá nhân ít tụt / Profile follow less drop - Fast', NULL, 0.2, 0, 0, 1000, 0, 10000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©⭐⭐Follow trang cá nhân ít tụt / Profile follow less drop - Fast\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(80, 7, 1, 553, '2', '{\"min\":\"1000\",\"max\":\"200000\",\"rate\":\"1.35\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©⭐⭐Follow trang cá nhân ít tụt / Profile follow less drop - Fast', NULL, 2.03, 0, 0, 1000, 0, 200000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©⭐⭐Follow trang cá nhân ít tụt / Profile follow less drop - Fast\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(81, 7, 1, 10, '2', '{\"min\":\"100\",\"max\":\"10000\",\"rate\":\"2.00\",\"currency\":\"USD\"}', 11, 1, '2', '1', '⭐⭐Follow trang cá nhân 1', NULL, 3, 0, 0, 100, 0, 10000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"⭐⭐Follow trang cá nhân 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(82, 7, 1, 303, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"0.85\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©Yêu thích bài đăng 1', NULL, 1.28, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©Yêu thích bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(83, 7, 1, 304, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"0.85\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©Haha bài đăng 1', NULL, 1.28, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©Haha bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(84, 7, 1, 305, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"0.85\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©Wow bài đăng 1', NULL, 1.28, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©Wow bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(85, 7, 1, 306, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"1.00\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©Thương thương bài đăng 1', NULL, 1.5, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©Thương thương bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(86, 7, 1, 307, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"0.85\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©Buồn bài đăng 1', NULL, 1.28, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©Buồn bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52'),
(87, 7, 1, 308, '2', '{\"min\":\"50\",\"max\":\"1000\",\"rate\":\"0.88\",\"currency\":\"USD\"}', 11, 1, '2', '1', '🅰©Phẫn nộ bài đăng 1', NULL, 1.32, 0, 0, 50, 0, 1000, 0, '1', 0, 0, '1', '1', '2', 'normal', NULL, 'none', NULL, NULL, NULL, NULL, '1', '{\"en\":\"🅰©Phẫn nộ bài đăng 1\"}', NULL, 1, 1, 0, NULL, NULL, '2022-05-12 13:29:52', '2022-05-12 13:29:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `servicess`
--

CREATE TABLE `servicess` (
  `id` int NOT NULL,
  `provider_id` int NOT NULL,
  `status` int DEFAULT '1',
  `catid` int NOT NULL,
  `cat` text,
  `name` text,
  `rate` double NOT NULL,
  `min` int NOT NULL,
  `max` int NOT NULL,
  `feature_quality` text,
  `feature_start` text,
  `feature_speed` text,
  `feature_refill` text,
  `desc` text,
  `type` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `servicess`
--

INSERT INTO `servicess` (`id`, `provider_id`, `status`, `catid`, `cat`, `name`, `rate`, `min`, `max`, `feature_quality`, `feature_start`, `feature_speed`, `feature_refill`, `desc`, `type`, `created_at`, `updated_at`) VALUES
(41, 0, 0, 8, 'Instagram Followers', 'Instagram Real Followers | Max 1M | 20K/days | 365 Days Refill', 1, 100, 500000, '⭐⭐⭐⭐⭐', 'Instant', '20000', '365 days refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">Start: 0 - 15 Min</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">Speed: 20K - 50K / Day</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">Quality: Real Mixed</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">Refill: 365 Days</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">Drop Ratio : 5-15%</p><p class=\"p2\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; min-height: 15px; color: rgb(0, 0, 0);\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(43, 0, 0, 9, 'Instagram Likes', 'Instagram Likes | Max 50K | Speed 50K/hour', 0.08, 10, 50000, '⭐⭐⭐⭐⭐', 'Instant', '50k/hours', 'NO', '<p>Real Looking Likes and Best Quality ( Maximum Profile Accounts )</p><p>50,000 Likes Per Hour.</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(107, 0, 0, 14, 'Tiktok', 'TikTok Views | Max 1M | 100k-1M/days | INSTANT', 0.02, 100, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100K+', '30 days', '<p>Order link form: https://www.tiktok.com/@rvlreview/video/6966881150279175426</p><p><br></p>', 'Default', '2022-05-04 00:00:05', '2022-05-09 14:00:10'),
(153, 0, 0, 9, 'Instagram Likes', 'Instagram Real Like | Tốc độ 50k/ngày', 0.15, 100, 5000, '⭐⭐⭐⭐⭐', 'Lập tức', '5000', '-', '<br>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(219, 0, 0, 51, 'Facebook | Tăng mắt Live Stream', 'Tăng mắt Live Stream Facebook - Duy trì 30 phút', 2.5, 50, 2000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Là dịch vụ hỗ trợ chạy tăng mắt live stream cho video của bạn&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Bội số order là 50&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Mắt live stream sẽ được duy trì trong 30 phút&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Hệ thống chỉ tăng mắt live stream. Không có lượt xem sau khi kết thúc live stream.&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Order bằng bằng link video&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Ví dụ :&nbsp;<a href=\"https://www.facebook.com/phimhoathinh.BH/videos/357134865528354\" target=\"_blank\" style=\"color: rgb(88, 103, 221); outline-style: none !important; outline-width: initial !important;\">https://www.facebook.com/phimhoathinh.BH/videos/357134865528354</a>&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(220, 0, 0, 51, 'Facebook | Tăng mắt Live Stream', 'Tăng mắt Live Stream Facebook - Duy trì 60 phút', 4.5, 50, 2000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Là dịch vụ hỗ trợ chạy tăng mắt live stream cho video của bạn&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Bội số order là 50&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Mắt live stream sẽ được duy trì trong 60 phút&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Hệ thống chỉ tăng mắt live stream. Không có lượt xem sau khi kết thúc live stream.&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Order bằng bằng link video&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Ví dụ :&nbsp;<a href=\"https://www.facebook.com/phimhoathinh.BH/videos/357134865528354\" target=\"_blank\" style=\"color: rgb(88, 103, 221); outline-style: none !important; outline-width: initial !important;\">https://www.facebook.com/phimhoathinh.BH/videos/357134865528354</a></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(221, 0, 0, 51, 'Facebook | Tăng mắt Live Stream', 'Tăng mắt Live Stream Facebook - Duy trì 90 phút', 6.5, 50, 2000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Là dịch vụ hỗ trợ chạy tăng mắt live stream cho video của bạn&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Bội số order là 50&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Mắt live stream sẽ được duy trì trong 90 phút&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Hệ thống chỉ tăng mắt live stream. Không có lượt xem sau khi kết thúc live stream.&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Order bằng bằng link video&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Ví dụ :&nbsp;<a href=\"https://www.facebook.com/phimhoathinh.BH/videos/357134865528354\" target=\"_blank\" style=\"color: rgb(88, 103, 221); outline-style: none !important; outline-width: initial !important;\">https://www.facebook.com/phimhoathinh.BH/videos/357134865528354</a>&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(222, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Facebook Likes Việt Nam | Max 10k | 10K likes/giờ', 1.3, 100, 10000, '⭐⭐⭐⭐⭐', '0-1h', '10k/h', '-', '<p><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\">-&nbsp;<span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">Tốc độ: 10k/giờ (Đơn hàng càng lớn, tốc độ tăng lên càng nhanh)</span></font></p><p><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\"><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">- Likes từ các tài khoản FB thật VN</span></font></p><p><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\"><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">- Có thể bị tụt 10-20% sau khi hoàn thành</span></font></p><p><font color=\"#000000\" style=\"background-color: rgb(255, 255, 255);\"><span style=\"font-family: &quot;Open Sans&quot;, sans-serif;\">- Các bài viết không bật likes công khai sẽ không được hoàn tiền.&nbsp;</span></font></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(224, 0, 0, 51, 'Facebook | Tăng mắt Live Stream', 'Tăng mắt Live Stream Facebook - Duy trì 120 phút', 8.5, 50, 2000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Là dịch vụ hỗ trợ chạy tăng mắt live stream cho video của bạn&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Bội số order là 50&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Mắt live stream sẽ được duy trì trong 120 phút&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Hệ thống chỉ tăng mắt live stream. Không có lượt xem sau khi kết thúc live stream.&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Order bằng bằng link video&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Ví dụ :&nbsp;<a href=\"https://www.facebook.com/phimhoathinh.BH/videos/357134865528354\" target=\"_blank\" style=\"color: rgb(88, 103, 221); outline-style: none !important; outline-width: initial !important;\">https://www.facebook.com/phimhoathinh.BH/videos/357134865528354</a>&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(225, 0, 0, 51, 'Facebook | Tăng mắt Live Stream', 'Tăng mắt Live Stream Facebook - Duy trì 180 phút', 13, 50, 2000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Là dịch vụ hỗ trợ chạy tăng mắt live stream cho video của bạn&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Bội số order là 50&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Mắt live stream sẽ được duy trì trong 180 phút&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Hệ thống chỉ tăng mắt live stream. Không có lượt xem sau khi kết thúc live stream.&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Order bằng bằng link video&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Ví dụ :&nbsp;<a href=\"https://www.facebook.com/phimhoathinh.BH/videos/357134865528354\" target=\"_blank\" style=\"color: rgb(88, 103, 221); outline-style: none !important; outline-width: initial !important;\">https://www.facebook.com/phimhoathinh.BH/videos/357134865528354</a>&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(270, 0, 0, 1, 'YouTube Views', 'Youtube Views and Short Views | Views from device mobile | 2-8 minutes watchtime', 1.5, 1000, 40000, '⭐⭐⭐⭐⭐', '0-24 hours', '1k - 5k', 'Lifetime', '<p>- Mua từ 3k trở lên được tặng likes và 1k views&nbsp;</p><p>- Views từ thiết bị di động&nbsp;</p><p>- Thời gian xem 2 - 8 phút&nbsp;</p><p>- Views toàn thế giới&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(288, 0, 0, 1, 'YouTube Views', 'YouTube Views | Views from social network | Time views 1-6 minutes |  Speed 50k-300k/days', 1.3, 1000, 1000000, '⭐⭐⭐⭐⭐', 'Instant', '50k+', 'Lifetime', '<p>- Views đến từ các mạng xã hội twitter, facebook ...&nbsp;</p><p>- Thời gian xem 1-6 phút&nbsp;</p><p>- Người xem đến từ thế giới</p><p>- Không dùng được cho video công chiếu và video phát live, video chặn quốc gia, giới hạn độ tuổi. Không hoàn tiền nếu cố tình order các loại video này.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(293, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất chỉ định | Thời gian xem 60 phút | Bảo hành 30 ngày', 5.434, 200, 5000, '⭐⭐⭐⭐⭐', 'Lập tức', '600 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 1 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 60+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 1 tiếng : 1000 lượt xem = 1000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 1 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 1 hours to get the best effect.</p><p>- Watch time : 60+ minutes&nbsp;</p><p>- If you use video length 1 hours + : 1000 views = 1000+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(294, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn tìm kiếm chỉ định | Thời gian xem 60 phút | Bảo hành 30 ngày', 5.434, 200, 5000, '⭐⭐⭐⭐⭐', 'Lập tức', '600 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 1 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 60+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 1 tiếng : 1000 lượt xem = 1000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 1 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 1 hours to get the best effect.</p><p>- Watch time : 60+ minutes&nbsp;</p><p>- If you use video length 1 hours + : 1000 views = 1000+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(295, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn mạng xã hội | Thời gian xem 60 phút | Bảo hành 30 ngày', 5.434, 200, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '600 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 1 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 60+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 1 tiếng : 1000 lượt xem = 1000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 1 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 1 hours to get the best effect.</p><p>- Watch time : 60+ minutes&nbsp;</p><p>- If you use video length 1 hours + : 1000 views = 1000+ hours</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(296, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn MIX | Thời gian xem 60 phút | Bảo hành 30 ngày', 5.434, 200, 5000, '⭐⭐⭐⭐⭐', 'Lập tức', '600 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 1 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 60+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 1 tiếng : 1000 lượt xem = 1000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 1 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 1 hours to get the best effect.</p><p>- Watch time : 60+ minutes&nbsp;</p><p>- If you use video length 1 hours + : 1000 views = 1000+ hours</p>', 'Special 1', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(297, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất chỉ định | Thời gian xem 120 phút | Bảo hành 30 ngày', 8.695, 200, 3000, '⭐⭐⭐⭐⭐', 'Lập tức', '1200 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 2 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 120+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 2 tiếng : 1000 lượt xem = 2000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 2 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 2 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 2 hours to get the best effect.</p><p>- Watch time : 120+ minutes&nbsp;</p><p>- If you use video length 2 hours + : 1000 views = 2000+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(298, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn tìm kiếm chỉ định | Thời gian xem 120 phút | Bảo hành 30 ngày', 8.695, 200, 3000, '⭐⭐⭐⭐⭐', 'Lập tức', '1200 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 2 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 120+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 2 tiếng : 1000 lượt xem = 2000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 2 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 2 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 2 hours to get the best effect.</p><p>- Watch time : 120+ minutes&nbsp;</p><p>- If you use video length 2 hours + : 1000 views = 2000+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(299, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn mạng xã hội | Thời gian xem 120 phút | Bảo hành 30 ngày', 8.695, 200, 3000, '⭐⭐⭐⭐⭐', 'Lập tức', '1200 giờ', '30 ngày', '<div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"color: rgb(100, 108, 154); font-family: inherit; font-size: 14px; white-space: pre-wrap; position: relative; direction: ltr;\"><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; position: relative; direction: ltr;\"><span style=\"background-color: rgb(255, 0, 0); color: rgb(255, 255, 255);\">- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm. </span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; position: relative; direction: ltr;\"><span style=\"background-color: rgb(255, 0, 0); color: rgb(255, 255, 255); font-family: inherit;\">- Không order cùng lúc nhiều dịch vụ trên một video.</span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\">- Sử dụng video dài hơn 2 tiếng để được hiệu quả tốt nhất. </span><br></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\">- Thời gian mỗi lượt xem : 120+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h. </span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\">- Nếu bạn sử dụng video có độ dài hơn 2 tiếng : 1000 lượt xem = 2000+ giờ xem </span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\"><i><b>Mẹo nhỏ :</b></i> bạn có thể sử dụng nhiều video có độ dài hơn 2 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h. </span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\">- Ví dụ : Sử dụng 2 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h. </span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\">-------------------------------------------------------------</span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\">- Use videos longer than 2 hours to get the best effect.<br></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\"><span style=\"font-family: inherit;\">- Watch time : 120+ minutes </span></div><div data-offset-key=\"852eu-0-0\" class=\"_1mf _1mj\" style=\"font-family: inherit; color: rgb(28, 30, 33); position: relative; direction: ltr;\">- If you use video length 2 hours + : <span style=\"font-family: inherit;\">1000 views = 2000+ hours</span></div></div>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(300, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn MIX | Thời gian xem 120 phút | Bảo hành 30 ngày', 8.695, 200, 3000, '⭐⭐⭐⭐⭐', 'Lập tức', '1200 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 2 tiếng để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 120+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 2 tiếng : 1000 lượt xem = 2000+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 2 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 2 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 2 hours to get the best effect.</p><p>- Watch time : 120+ minutes&nbsp;</p><p>- If you use video length 2 hours + : 1000 views = 2000+ hours</p>', 'Special 1', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(301, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 9999999, 1000000, 1000000, '1000000', '1000000', '1000000', '1000000', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(302, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 9999999, 1000000, 1000000, '1000000', '1000000', '1000000', '1000000', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(305, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'Youtube Live Stream Views | 100 - 300 mắt live trong 24H', 3.5, 1000, 3000, '-', '10-15 phút', '-', '-', '<span style=\"background-color: rgb(255, 255, 255);\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">If you order 1000 views, then the Avg Concurrent 100-300 will stay for 24 hours</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">If you order 2000 views, then the Avg Concurrent 300-600 will stay for 24 hours</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">If you order 3000 views, then the Avg Concurrent 600-1000 will stay for 24 hours</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• Start Time:0-5min</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• 100% Real Human YouTube Viewers!</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• User Interactions Included</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• includes LIKES</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• Windows Desktop Watch Page</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• 100% Unique Traffic</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• Social Referrers</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• World-Wide Viewers</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• Must be Unrestricted &amp; Open for ALL countries</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• Over-Delivery Guaranteed</span><br style=\"padding: 0px; margin: 0px; color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\"><span style=\"color: rgb(0, 0, 0); font-family: Karla, sans-serif; font-size: medium;\">• No Cancellation can be done after order started</span></span><br>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(314, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất chỉ định | Thời gian xem 30 phút | Bảo hành 30 ngày', 3.26, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '300 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 30 phút để được hiệu quả tốt nhất.</p><p>- Thời gian mỗi lượt xem : 30+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.</p><p>- Nếu bạn sử dụng video có độ dài hơn 30 phút : 1000 lượt xem = 500+ giờ xem</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 30 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 30 minutes to get the best effect.</p><p>- Watch time : 30+ minutes</p><p>- If you use video length 30+ minutes : 1000 views = 500+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(315, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn tìm kiếm chỉ định | Thời gian xem 30 phút | Bảo hành 30 ngày', 3.26, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '300 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 30 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 30+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 30 phút : 1000 lượt xem = 500+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 30 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 30 minutes to get the best effect.</p><p>- Watch time : 30+ minutes&nbsp;</p><p>- If you use video length 30+ minutes : 1000 views = 500+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(316, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn mạng xã hội | Thời gian xem 30 phút | Bảo hành 30 ngày', 3.26, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '300 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 30 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 30+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 30 phút : 1000 lượt xem = 500+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 30 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 30 minutes to get the best effect.</p><p>- Watch time : 30+ minutes&nbsp;</p><p>- If you use video length 30+ minutes : 1000 views = 500+ hours</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(317, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn MIX | Thời gian xem 30 phút | Bảo hành 30 ngày', 3.26, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '300 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 30 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 30+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 30 phút : 1000 lượt xem = 500+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 30 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 30 minutes to get the best effect.</p><p>- Watch time : 30+ minutes&nbsp;</p><p>- If you use video length 30+ minutes : 1000 views = 500+ hours</p>', 'Special 1', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(321, 0, 0, 9, 'Instagram Likes', 'Instagram Likes  | 10k/hour | 30 days warranty', 0.12, 10, 30000, '⭐⭐⭐⭐⭐', 'Instant', '10k/hours', '30 days', '<p>Speed:10K/hour</p><p>Guarantee: 30 Days</p><p>Drop: Less</p><p><br></p><p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(323, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất chỉ định | Thời gian xem 15 phút | Bảo hành 30 ngày', 1.9, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '150 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 15 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 15+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 15 phút : 1000 lượt xem = 250+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 15 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 8 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 15 minutes to get the best effect.</p><p>- Watch time : 15+ minutes&nbsp;</p><p>- If you use video length 15+ minutes : 1000 views = 250+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(324, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn tìm kiếm chỉ định | Thời gian xem 15 phút | Bảo hành 30 ngày', 1.9, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '150 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 15 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 15+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 15 phút : 1000 lượt xem = 250+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 15 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 8 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 15 minutes to get the best effect.</p><p>- Watch time : 15+ minutes&nbsp;</p><p>- If you use video length 15+ minutes : 1000 views = 250+ hours</p><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><p><br></p>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(325, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn mạng xã hội | Thời gian xem 15 phút | Bảo hành 30 ngày', 1.9, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '150 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 15 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 15+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 15 phút : 1000 lượt xem = 250+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 15 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 8 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 15 minutes to get the best effect.</p><p>- Watch time : 15+ minutes&nbsp;</p><p>- If you use video length 15+ minutes : 1000 views = 250+ hours</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(326, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn MIX | Thời gian xem 15 phút | Bảo hành 30 ngày', 1.9, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '150 giờ', '30 ngày', '<p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Sử dụng video dài hơn 15 phút để được hiệu quả tốt nhất.&nbsp;</p><p>- Thời gian mỗi lượt xem : 15+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</p><p>- Nếu bạn sử dụng video có độ dài hơn 15 phút : 1000 lượt xem = 250+ giờ xem&nbsp;</p><p><strong><em>Mẹo nhỏ :</em></strong> bạn có thể sử dụng nhiều video có độ dài hơn 15 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</p><p>- Ví dụ : Sử dụng 8 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</p><p>-------------------------------------------------------------</p><p>- Use videos longer than 15 minutes to get the best effect.</p><p>- Watch time : 15+ minutes&nbsp;</p><p>- If you use video length 15+ minutes : 1000 views = 250+ hours</p>', 'Special 1', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(327, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 9999999, 1000000, 1000000, '1000000', '1000000', '1000000', '1000000', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(332, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất tự nhiên | Thời gian xem 15 phút | Bảo hành 30 ngày', 1.9, 300, 10000, '', '', '', '', '<p><strong>Views đề xuất từ các video nội dung giải trí có lượt xem khủng từ vài triệu views cho đến tỷ views.&nbsp;</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 15 phút để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 15+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 15 phút : 1000 lượt xem = 250+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 15 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 8 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 15 minutes to get the best effect.</strong></p><p><strong>- Watch time : 15+ minutes&nbsp;</strong></p><p><strong>- If you use video length 15+ minutes&nbsp;: 1000 views = 250+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(333, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất tự nhiên | Thời gian xem 30 phút | Bảo hành 30 ngày', 3.26, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '300 giờ', '30 ngày', '<p><strong>Views đề xuất từ các video nội dung giải trí có lượt xem khủng từ vài triệu views cho đến tỷ views.&nbsp;</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 30 phút để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 30+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 30 phút : 1000 lượt xem = 500+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 30 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 30 minutes to get the best effect.</strong></p><p><strong>- Watch time : 30+ minutes&nbsp;</strong></p><p><strong>- If you use video length 30+ minutes : 1000 views = 500+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(334, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất tự nhiên | Thời gian xem 60 phút | Bảo hành 30 ngày', 5.434, 200, 5000, '⭐⭐⭐⭐⭐', 'Lập tức', '600 giờ', '30 ngày', '<p><strong>Views đề xuất từ các video nội dung giải trí có lượt xem khủng từ vài triệu views cho đến tỷ views.&nbsp;</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 1 tiếng để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 60+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 1 tiếng : 1000 lượt xem = 1000+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 1 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 1 hours to get the best effect.</strong></p><p><strong>- Watch time : 60+ minutes&nbsp;</strong></p><p><strong>- If you use video length 1 hours + : 1000 views = 1000+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(335, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn đề xuất tự nhiên | Thời gian xem 120 phút | Bảo hành 30 ngày', 8.695, 200, 3000, '⭐⭐⭐⭐⭐', 'Lập tức', '1200 giờ', '30 ngày', '<p><strong>Views đề xuất từ các video nội dung giải trí có lượt xem khủng từ vài triệu views cho đến tỷ views.&nbsp;</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 2 tiếng để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 120+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 2 tiếng : 1000 lượt xem = 2000+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 2 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 2 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 2 hours to get the best effect.</strong></p><p><strong>- Watch time : 120+ minutes&nbsp;</strong></p><p><strong>- If you use video length 120+ minutes + : 1000 views = 2000+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(337, 0, 0, 1, 'YouTube Views', 'Youtube Views | Random Suggest  | 10 minutes watchtime | 30 days refill', 1.5, 300, 10000, '⭐⭐⭐⭐⭐', 'Instant', '600', '30 days refill', '<p>Views đề xuất từ các video nội dung giải trí có lượt xem khủng từ vài triệu views cho đến tỷ views.&nbsp;</p><p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Thời gian xem 10+ phút&nbsp;</p><p>- Tốc độ 600 views/video/ngày</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10');
INSERT INTO `servicess` (`id`, `provider_id`, `status`, `catid`, `cat`, `name`, `rate`, `min`, `max`, `feature_quality`, `feature_start`, `feature_speed`, `feature_refill`, `desc`, `type`, `created_at`, `updated_at`) VALUES
(338, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng Likes bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>Start time: 0-10 minutes </b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>Speed per Day: 1000 Emoticon </b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>Minimum Order: 50 </b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>Maximum Order: 1,000 </b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>-Strictly No Refund for Wrong format links or if orders drop of fb updates</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>-Strictly No Refund for Wrong non-public ids</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</b></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><b>Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</b></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(339, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng Love bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Start time: 0-10 minutes</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Speed per Day: 1000 Emoticon</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Minimum Order: 50</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Maximum Order: 1,000</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong format links or if orders drop of fb updates</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong non-public ids</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(340, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng Care bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Start time: 0-10 minutes</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Speed per Day: 1000 Emoticon</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Minimum Order: 50</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Maximum Order: 1,000</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong format links or if orders drop of fb updates</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong non-public ids</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(341, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng HaHa bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Start time: 0-10 minutes</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Speed per Day: 1000 Emoticon</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Minimum Order: 50</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Maximum Order: 1,000</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong format links or if orders drop of fb updates</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong non-public ids</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(342, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng WoW bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Start time: 0-10 minutes</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Speed per Day: 1000 Emoticon</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Minimum Order: 50</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Maximum Order: 1,000</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong format links or if orders drop of fb updates</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong non-public ids</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(343, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng Sad bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Start time: 0-10 minutes</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Speed per Day: 1000 Emoticon</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Minimum Order: 50</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Maximum Order: 1,000</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong format links or if orders drop of fb updates</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong non-public ids</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(344, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Tăng Angry bài viết Facebook', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Lập tức', '1000', 'No refill', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Start time: 0-10 minutes</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Speed per Day: 1000 Emoticon</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Minimum Order: 50</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Maximum Order: 1,000</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">We will forgo refunds for ids that are dead, or deleted, hidden, or posts without like buttons.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Old orders can only be completed so that new orders can be placed, otherwise the quantity purchased will be lost, and will not be processed.</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly We do not accept fb.me [ shortened link] , No refund if you add such links</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong format links or if orders drop of fb updates</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-Strictly No Refund for Wrong non-public ids</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">-purchase quantity must be a multiple of 50,100, otherwise it will subtract the odd part by itself and run</span></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><span style=\"font-weight: 600;\">Does not support warranty, may not upload enough quantity, for example buy 1000 Emoticon can only get 800-1000 Emoticon</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(357, 0, 0, 62, 'FACEBOOK | GÓI THÁNG | Vip Likes', 'Vip Likes - Tự động tăng likes khi đăng bài viết Facebook theo tháng', 60, 50, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p>- Dịch vụ trả phí 1 lần và sử dụng trong 30 ngày.</p><p>- Nhận likes tự động - Tối đa 5 post/ngày</p><p>- Likes tự động lên khi bạn đăng bài lên trang cá nhân Facebook hoặc Page</p><p>- Nhập số lượng là 1 trong những số lượng sau: 50, 100, 150, 200, 250, 300, 500, 750, 1000, 1500, 2000, 3000, 5000, 7500, 10000</p><p>- Likes hoạt động từ 7h - 23h mỗi ngày.</p><p>- Likes có thể bị tụt một ít sau một thời gian</p><p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(365, 0, 0, 64, '♪♪♪ Lên tick nghệ sĩ cho kênh Youtube ♪♪♪', '♪♪♪ Lên tick nghệ sĩ cho kênh Youtube ♪♪♪  Hoàn thành trong 24 giờ', 40, 1000, 1000, '⭐⭐⭐⭐⭐', '0-24', '-', 'Không bảo hành', '<p><img src=\"https://i.imgur.com/b14R8Ki.png\"></p><p><br></p><p>&nbsp;<strong>Bước 1: </strong>Các bạn phải add một trong các email dưới đây làm \"Người quản lý\" để bên mình lên tick nghệ sĩ cho kênh các bạn&nbsp;</p><ul><li>thuytien.thi@gmail.com</li><li>bear.luxury1996@gmail.com</li><li>thanhcansamson@gmail.com</li><li>mr.dung1103@gmail.com</li><li>miusun401@gmail.com</li><li>vhviet90@gmail.com</li><li>aromantic.mylove@gmail.com</li><li>meongoz.tieuthu95@gmail.com</li><li>thanhhuytoday@gmail.com</li><li>hooanhnam@gmail.com</li></ul><p>- Video hướng dẫn add email quản trị viên cho kênh :&nbsp;<a href=\"https://www.youtube.com/watch?v=KxVdgj9ugxY\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.youtube.com/watch?v=KxVdgj9ugxY</a></p><p><br></p><p><strong>Bước 2: </strong>Sau khi add email \"Người quản lý\" các bạn tiến hành đặt đơn hàng trên site 1DG.ME&nbsp;</p><p><br></p><p><span style=\"color: rgb(63, 66, 84);\">- Nhập link kênh của bạn khi order + email bạn đã add Người quản lý</span></p><p><br></p><p><img src=\"https://i.imgur.com/dWoPTXb.png\"></p><p>Ví dụ :&nbsp;<a href=\"https://www.youtube.com/channel/UCShABCh9Tu8VIZumj7QLQOA\" rel=\"noopener noreferrer\" target=\"_blank\">https://www.youtube.com/channel/UCShABCh9Tu8VIZumj7QLQOA</a>&nbsp;+&nbsp;<span style=\"color: rgb(0, 0, 0);\">thuytien.thi@gmail.com</span></p><p>- Sau khi đơn hàng hoàn thành các bạn có thể xoá mail Người quản lý bên mình ra khỏi kênh.&nbsp;</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(366, 0, 0, 1, 'YouTube Views', 'Youtube Views | Suggest from top 50 video trending US | 10 Minutes watchtime | Refill 30 days', 1.5, 300, 10000, '⭐⭐⭐⭐⭐', 'Instant', '600', '30 days refill', '<p>Views đề xuất từ top 50 video trending US.&nbsp;</p><p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Thời gian xem 10+ phút&nbsp;</p><p>- Tốc độ 600 views/video/ngày</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(369, 0, 0, 1, 'YouTube Views', 'Youtube Views | Custom Suggest | 10 minutes watchtime | 30 days refill', 1.5, 300, 10000, '⭐⭐⭐⭐⭐', 'Instant', '600', '30 days refill', '<h2><br></h2><p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Thời gian xem 10+ phút&nbsp;</p><p>- Tốc độ 600 views/video/ngày</p><p><br></p><p>Đề xuất chỉ định là gì ?&nbsp;</p><h2><br></h2><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><h2><br></h2>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(373, 0, 0, 5, 'YouTube Comment', 'YouTube Custom Comments | 1500/days | Nodrop', 4.5, 5, 1500, '⭐⭐⭐⭐⭐', 'Instant', '1500', '30 days refill', '<p>- Nhập mỗi dòng 1 comment&nbsp;</p><p>- Import each line 1 comment</p>', 'Custom Comments', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(381, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'YouTube Views - Live Stream Views | Dành cho video Live Stream', 1.4, 1000, 1000000, '⭐⭐⭐⭐⭐', 'Lập tức', '-', '-', '<p>&nbsp;Lưu ý : Video phải bật chế độ nhúng mới có thể chạy được views&nbsp;</p><p>START ( 0 - 20 mins )</p><p>-MONETIZABLE | REAL</p><p>- 100% Real Human YouTube Users Viewers</p><p>- 100% Unique Traffic</p><p>- World-Wide Viewers</p><p>- Avg Concurrent and watch-time based on live stream content</p><p>- Video must Unrestricted , embed must enabled</p><p>NOTE :</p><p>- Views are spread over the time to deliver live viewers so that they stay for atleast 30 mins - 2H</p><p>Ex : You order 1000 views, then ,1000 live viewers will spread over the time in 30 mins - 2H+.</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(382, 0, 0, 52, 'Facebook - Post Likes | Tăng likes bài viết', 'Facebook Likes Việt Nam | Max 100k | Speed 100-500 likes/days', 0.5, 50, 100000, '⭐⭐⭐⭐⭐', 'Lập tức', '100-500', '-', '<p>- Likes từ FB VN</p><p>- Có thể bị tụt 5-15% sau khi hoàn thành&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(389, 0, 0, 6, 'YouTube Likes | Dislikes | Favorite | Other Services', 'Youtube Comment Likes | UPVOTES | Super Instant | Max 100K', 1, 20, 100000, '⭐⭐⭐⭐⭐', 'Lập tức', '50000', '30 days refill', '<p>Copy link ở phần thời gian bình luận để order&nbsp;</p><p><img src=\"https://i.ibb.co/fSZv55p/Screen-Shot-2021-07-21-at-15-53-37.png\"></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(391, 0, 0, 1, 'YouTube Views', 'Youtube Views | Source Homepage | 10 minutes watchtime | Refill 30 days', 1.5, 300, 10000, '⭐⭐⭐⭐⭐', 'Instant', '600', '30 days refill', '<p>Views nguồn từ trang chủ Youtube</p><p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Thời gian xem 10+ phút&nbsp;</p><p>- Tốc độ 600 views/video/ngày</p><p><br></p><h2><img src=\"https://i.ibb.co/qj9jdry/Screen-Shot-2021-07-29-at-21-05-15.png\"></h2>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(392, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn từ trang chủ Youtube | Thời gian xem 15 phút | Bảo hành 30 ngày', 1.9, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '600', '30 ngày', '<p><strong>Views nguồn từ trang chủ Youtube</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 15 phút để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 15+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 15 phút : 1000 lượt xem = 250+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 15 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 8 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 15 minutes to get the best effect.</strong></p><p><strong>- Watch time : 15+ minutes&nbsp;</strong></p><p><strong>- If you use video length 15+ minutes&nbsp;: 1000 views = 250+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(393, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn từ trang chủ Youtube | Thời gian xem 30 phút | Bảo hành 30 ngày', 3.26, 300, 10000, '⭐⭐⭐⭐⭐', 'Lập tức', '600', '30 ngày', '<p><strong>Views nguồn từ trang chủ Youtube</strong></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 30 phút để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 30+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 30 phút : 1000 lượt xem = 500+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 30 phút trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 2000 views. Thì chỉ cần 4 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 30 minutes to get the best effect.</strong></p><p><strong>- Watch time : 30+ minutes&nbsp;</strong></p><p><strong>- If you use video length 30+ minutes : 1000 views = 500+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(394, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn từ trang chủ Youtube | Thời gian xem 60 phút | Bảo hành 30 ngày', 5.434, 200, 5000, '⭐⭐⭐⭐⭐', 'Lập tức', '600', '30 ngày', '<p><strong>Views nguồn từ trang chủ Youtube</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 1 tiếng để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 60+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 1 tiếng : 1000 lượt xem = 1000+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 1 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 4 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 1 hours to get the best effect.</strong></p><p><strong>- Watch time : 60+ minutes&nbsp;</strong></p><p><strong>- If you use video length 1 hours + : 1000 views = 1000+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(395, 0, 0, 59, 'YouTube Views 4000H từ thiết bị Di động - Bảo hành 30 ngày', 'Views 4000H | Nguồn từ trang chủ Youtube | Thời gian xem 120 phút | Bảo hành 30 ngày', 8.695, 200, 3000, '⭐⭐⭐⭐⭐', 'Lập tức', '600', '30 ngày', '<p><strong>Views nguồn từ trang chủ Youtube</strong></p><p><br></p><p><strong>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</strong></p><p><strong>- Không order cùng lúc nhiều dịch vụ trên một video.</strong></p><p><strong>- Sử dụng video dài hơn 2 tiếng để được hiệu quả tốt nhất.&nbsp;</strong></p><p><strong>- Thời gian mỗi lượt xem : 120+ phút . Quý khách tự cân đối số lượng views cần mua để đủ 4000h.&nbsp;</strong></p><p><strong>- Nếu bạn sử dụng video có độ dài hơn 2 tiếng : 1000 lượt xem = 2000+ giờ xem&nbsp;</strong></p><p><strong><em>Mẹo nhỏ :</em> bạn có thể sử dụng nhiều video có độ dài hơn 2 tiếng trong cùng một kênh để order có thể rút ngắn thời gian hoàn thành 4000h.&nbsp;</strong></p><p><strong>- Ví dụ : Sử dụng 2 video trong cùng 1 kênh. Mỗi video order hơn 1000 views. Thì chỉ cần 2 ngày là hoàn thành 4000h.&nbsp;</strong></p><p><strong>-------------------------------------------------------------</strong></p><p><strong>- Use videos longer than 2 hours to get the best effect.</strong></p><p><strong>- Watch time : 120+ minutes&nbsp;</strong></p><p><strong>- If you use video length 120+ minutes + : 1000 views = 2000+ hours</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(398, 0, 0, 11, 'Facebook - Page Likes | Tăng likes Fanpage', 'Tăng Likes và Followers cho Fangage Facebook | 5k/ngày', 1.4, 100, 100000, '⭐⭐⭐⭐⭐', 'Lập tức', '5000+', '7 ngày', '<p>Tăng Likes và followers cho Fangage Facebook&nbsp;</p><p>Nguồn tài khoản: Việt Nam</p><p>Tốc độ: 5000/ ngày</p><p>Có thể bị tụt sau khi hoàn thành 5-10%</p><p>-------</p><p>- Lưu ý khi tăng Likes Page (Để tránh bị hủy đăng Page):</p><p>Page mới tạo chưa đủ 30 ngày hoặc Page mới đổi tên chưa đủ 15 ngày không nên tăng</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(412, 0, 0, 67, 'Youtube HR Views - Days', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐Suggest - 15 minutes ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 999999, 1000000, 1000000, '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(421, 0, 0, 3, 'YouTube Subscribers', 'Youtube Subscribes | Speed 500-3000/days | Min 100 | Max 100k |  Refill 30 days | Bonus views', 27, 100, 10000, '⭐⭐⭐⭐⭐', 'Instant', '500-3000', '30 days', '<p>- Order bằng link kênh hoặc link video&nbsp;</p><p>- Bật hiện sub khi order&nbsp;</p><p>- Kênh phải có ít nhất 1 video. Video phải bật cho phép nhúng</p><p>- Đơn hàng hoàn thành bạn mới có thể order thêm sub cho cùng một kênh.&nbsp;</p><p>- No cancel, no partial.&nbsp;</p><p>- Có thể bị tụt 5% sau một thời gian.&nbsp;</p><p>- Các đơn hàng sau khi hoàn thành sẽ được hệ thống tự động quét bù lại theo lịch trình sau 2,4,7,15,30 ngày.</p><p>- Sub nguồn từ người dùng thật Châu Á&nbsp;</p><p>Mẹo: Sau khi tăng người đăng ký, vui lòng đợi 5 ngày để Youtube cập nhật đầy đủ dữ liệu tổng quan, sau đó bạn có thể kích hoạt chương trình đối tác và bật kiếm tiền cho kênh Youtube của mình. Việc kích hoạt chương trình đối tác ngay sau khi đạt đủ người đăng ký có thể dẫn đến khả năng bị Youtube từ chối.</p><p>***Cơ chế và chính sách tăng lượt đăng ký cho Youtube của chúng tôi ***</p><p>- Số lượng tôi thiểu để đặt hàng là 100 người đăng ký và tối đa có thể lên đến 100,000.&nbsp;</p><p><br></p><p>- Tốc độ hiện tại của chúng tôi là 500 đến 1000 / ngày, và chúng tôi sẽ thông báo cho bạn khi tốc độ tăng lên hoặc giảm đi.</p><p><br></p><p>- Chi tiết về liên kết đặt hàng: Bạn có thể đặt hàng thông qua liên kết kênh Youtube hoặc liên kết video. Các video hoặc kênh có thiết lập giới hạn độ tuổi, quốc gia, ẩn người đăng ký hoặc bất kỳ thiết lập chặn nào khác sẽ không thể đặt hàng ( Hệ thống sẽ hoàn trả tiền cho bạn ngay lập tức hoặc sau một vài giờ nếu đơn hàng bị hủy).</p><p><br></p><p><strong>+&nbsp;Cơ chế cung cấp subs của chúng tôi:&nbsp;</strong></p><p><br></p><p>- Ví dụ: Khi bạn đặt hàng 100 subs, sau vài giờ kênh của bạn có thể nhận đủ 100 subs, hoặc đôi khi Youtube báo rằng bạn chỉ nhận được 80 hoặc 90 subs...</p><p>Đừng lo lắng!, lúc này, trạng thái đơn hàng của bạn vẫn là đang chạy, và có thể bạn thấy subs không tiếp tục tăng lên, hệ thống chúng tôi đã tính toán và tăng lượt đăng ký cho bạn đầy đủ, nhưng Youtube kiểm soát rất ngặt người đăng ký trên nền tảng của họ, có thể họ sẽ đưa một số lượt đăng ký vào danh sách kiểm tra, và thời gian này khoảng 48 giờ, sau đó khi đó Youtube sẽ cập nhật đầy đủ subs cho bạn.</p><p><br></p><p>- Chúng tôi nói về tốc độ, nó vẫn sẽ là 500 đến 1000 :&nbsp;Bởi nếu bạn thực hiện đặt hàng 1000 lượt đăng ký, bạn sẽ nhận gần đủ 1000 subs trong khoảng 24 giờ, nhưng bạn vẫn mất 48 giờ để Youtube cập nhật đầy đủ. ( Sau khi bạn nhận đầy đủ subs, hệ thống kiểm tra tự động của chúng tôi sẽ chuyển trạng thái đơn của bạn là hoàn thành, chúng tôi vẫn theo dõi nó trong một vài tuần tiếp theo )&nbsp;</p><p><br></p><p>* Chúng tôi biết việc này là rất bất cập cho bạn, nhưng lượt đăng ký của chúng tôi là an toàn và là người đăng ký thật sự.</p><p><br></p><p>* Lưu ý: Cùng một kênh, bạn không thể đặt hàng khi các đơn hàng cũ có trạng thái running, bạn cần chờ các đơn hàng cũ hoàn thành để có thể tiếp tục đặt hàng</p><p><br></p><p><br></p><p>English:</p><p><br></p><p><strong>*** Mechanism and policy to increase subscribers for our Youtube ***</strong></p><p><br></p><p>- The minimum order quantity is 100 subscribers and the maximum can be up to 100,000.</p><p><br></p><p>- Subscribers speed is 500 to 1000/day, and we will notify you when the rate increases or decreases.</p><p><br></p><p>- Order link details: You can order through Youtube channel or video links. Videos or channels with age, country restrictions,&nbsp;hidden subscribers or any other blocking settings will not be able to order (The system will refund you immediately or after a few hours if order is cancelled).</p><p><br></p><p><strong>+ Our subscribers supply mechanism:</strong></p><p><br></p><p>- For example: When you order 100 subs, after a few hours your channel can get enough 100 subs, or sometimes Youtube will notify that you only get 80 or 90 subs...</p><p>Don\'t worry!, at this point, your order status is still \"running\", and you may see that the subs are not continuing to increase, but our system has calculated and increased fully the subscribers for you. Youtube strictly controls the subscribers on its platform. Maybe Youtube will put some subscribers on the checklist, and the time is about 48 hours, then it will fully update the subscribers for you.</p><p><br></p><p>- Regarding the speed, it will still be 500 to 1000 : If you make an order of 1000 subscribers, you will get almost 500 to ~1000 subs in about 24 hours, but it still takes 48 hours for Youtube to update fully. (Once you receive all the subs, our automated checking system will update your order status&nbsp;to be completed, we will still follow it for the next few weeks)</p><p><br></p><p>* We know this is inconvenient for you, but our subscribers are real and safe.</p><p><br></p><p>* Note: On the same channel, you can\'t place an order when old orders have a running status, you need to wait for old orders to complete to be able to continue ordering</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(426, 0, 0, 66, 'Telegram', 'Telegram Channel/Group Members | Max 300k', 1.3, 100, 300000, '⭐⭐⭐⭐⭐', 'Lập tức', '100000', '-', '<p>- Order link dạng&nbsp;<a href=\"https://t.me/test666612\" target=\"_blank\">https://t.me/test666612</a></p><p>- Tỉ lệ tụt là 5-20%&nbsp;</p><p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(427, 0, 0, 66, 'Telegram', 'Telegram Channel/Group Members | Max 400k', 1.4, 100, 400000, '⭐⭐⭐⭐⭐', 'Lập tức', '50000', '-', '<p style=\"font-family: Poppins, Helvetica, sans-serif;\">- Order link dạng&nbsp;<a href=\"https://t.me/test666612\" target=\"_blank\">https://t.me/test666612</a></p><p style=\"font-family: Poppins, Helvetica, sans-serif;\">- Tỉ lệ tụt là 5-10%&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(430, 0, 0, 14, 'Tiktok', 'Ads Tiktok | Speed 100k - 500k/days', 0.4, 50000, 50000000, '⭐⭐⭐⭐⭐', '0-6 hours', '100k - 500k', 'Lifetime', '<p>- Dịch vụ chạy quảng cáo cho video Tiktok của bạn. Video của bạn sẽ nhận được lượt xem, tim, chia sẽ và người theo dõi .</p><p>- Để đặt hàng vui lòng lấy mã quảng cáo video của bạn theo hướng dẫn video bên dưới&nbsp;</p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"//www.youtube.com/embed/J8mqMel7OL8\" height=\"360\" width=\"640\"></iframe><p><br></p><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"//player.vimeo.com/video/601780948\" height=\"360\" width=\"640\"></iframe><p><br></p><p>Sau khi copy mã này bạn tiến hành đặt hàng&nbsp;</p><p><img src=\"https://i.ibb.co/yYxgtvB/Screen-Shot-2021-09-10-at-10-28-52.png\"></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10');
INSERT INTO `servicess` (`id`, `provider_id`, `status`, `catid`, `cat`, `name`, `rate`, `min`, `max`, `feature_quality`, `feature_start`, `feature_speed`, `feature_refill`, `desc`, `type`, `created_at`, `updated_at`) VALUES
(432, 0, 0, 1, 'YouTube Views', 'Youtube views | Source Suggest + Home + Search | 10 Minutes Watchtime| Bonus Likes | Speed 3k+ views/day', 1.5, 1000, 20000, '⭐⭐⭐⭐⭐', 'Lập tức', '3000+', 'Lifetime', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(439, 0, 0, 14, 'Tiktok', 'Tiktok Ads Targeting Country [Vietnam] | Speed 50k-500k/days', 0.4, 20000, 10000000, '⭐⭐⭐⭐⭐', '0-6h', '50k-500k', 'Lifetime', '<p style=\"font-family: Poppins, Helvetica, sans-serif;\">- Dịch vụ chạy quảng cáo cho video Tiktok của bạn. Video của bạn sẽ nhận được lượt xem, tim, chia sẽ và người theo dõi .</p><p style=\"font-family: Poppins, Helvetica, sans-serif;\">- Để đặt hàng vui lòng lấy mã quảng cáo video của bạn theo hướng dẫn video bên dưới&nbsp;</p><p style=\"font-family: Poppins, Helvetica, sans-serif;\"><iframe frameborder=\"0\" src=\"http://www.youtube.com/embed/J8mqMel7OL8\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe></p><p style=\"font-family: Poppins, Helvetica, sans-serif;\"><iframe webkitallowfullscreen=\"\" mozallowfullscreen=\"\" allowfullscreen=\"\" frameborder=\"0\" src=\"http://player.vimeo.com/video/601780948\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe><br></p><p style=\"font-family: Poppins, Helvetica, sans-serif;\">Sau khi copy mã này bạn tiến hành đặt hàng&nbsp;</p><p style=\"font-family: Poppins, Helvetica, sans-serif;\"><img src=\"https://i.ibb.co/yYxgtvB/Screen-Shot-2021-09-10-at-10-28-52.png\" style=\"width: 703.75px;\"></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(453, 0, 0, 55, 'Private', 'Test api', 0.000001, 1, 1, '-', '-', '-', '-', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(456, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | Speed 50k-100k/days', 1, 200, 1000000, '⭐⭐⭐⭐⭐', '0-1 hours', '50k - 100k', '30 days', '<p><span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: medium; background-color: rgb(255, 255, 255);\">Starting time: 0 - 1h</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: medium; background-color: rgb(255, 255, 255);\">Speed: 50K - 100K/day</span></p><p><span style=\"color: rgb(0, 0, 0); font-family: Arial; font-size: medium; background-color: rgb(255, 255, 255);\">- Order link same :&nbsp;</span><span style=\"font-family: Poppins, Helvetica, sans-serif;\">https://www.facebook.com/box.ThaoNari/videos/863590057674778/</span></p><p><span style=\"color: rgb(255, 255, 255); font-family: &quot;Helvetica Neue&quot;; font-size: 15px;\">2 1</span></p><p><span style=\"color: rgb(255, 255, 255); font-family: &quot;Helvetica Neue&quot;; font-size: 15px;\">8662, 218242</span></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(457, 0, 0, 51, 'Facebook | Tăng mắt Live Stream', 'Tăng mắt Live Stream Facebook - Duy trì 240 phút', 16, 50, 2000, '⭐⭐⭐⭐⭐', 'Lập tức', '10000', '-', '<p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Là dịch vụ hỗ trợ chạy tăng mắt live stream cho video của bạn&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Bội số order là 50&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Mắt live stream sẽ được duy trì trong 240 phút&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Hệ thống chỉ tăng mắt live stream. Không có lượt xem sau khi kết thúc live stream.&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">- Order bằng bằng link video&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Ví dụ :&nbsp;<a href=\"https://www.facebook.com/phimhoathinh.BH/videos/357134865528354\" target=\"_blank\" style=\"color: rgb(88, 103, 221); outline-style: none !important; outline-width: initial !important;\">https://www.facebook.com/phimhoathinh.BH/videos/357134865528354</a>&nbsp;</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(458, 0, 0, 50, 'Facebook - Followers | Tăng người theo dõi', 'FACEBOOK Profile Followers | Speed 20k+/day | Max 2M', 0.9, 1000, 1000000, '⭐⭐⭐⭐⭐', 'Lập tức', '10k - 50k', '30 days', '<p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><br></p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">- We will refuse to issue refunds for ids that are dead, or deleted, hidden</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">- Purchase quantity must be a multiple of 100</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">- Otherwise it will subtract the odd part by itself and run</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">- We accept all orders, if the link is wrong we will refund</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\">- Orders cannot be canceled for any reason</p><p class=\"p1\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; line-height: normal; font-family: &quot;Helvetica Neue&quot;; color: rgb(0, 0, 0);\"><br></p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\">Để tăng được người theo dõi các bạn vui lòng thiết lập theo hướng dẫn video bên dưới&nbsp;</p><p style=\"color: rgb(100, 108, 154); font-family: &quot;Open Sans&quot;, sans-serif;\"><iframe frameborder=\"0\" src=\"http://www.youtube.com/embed/wj37W2iHG5M\" width=\"640\" height=\"360\" class=\"note-video-clip\"></iframe></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(460, 0, 0, 1, 'YouTube Views', 'Youtube Views | Real User | Speed 500k+/days | No warranty', 0.7, 1000, 1000000, '⭐⭐⭐⭐⭐', '1-12 hours', '500k+', 'No warranty', '<p>- Start: 5 minutes-12h</p><p>- Speed: 500k+/Day</p><p>- Source: Real users, Your Videos will be embedded on social networks, websites, applications all over the world.</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(461, 0, 0, 6, 'YouTube Likes | Dislikes | Favorite | Other Services', 'Youtube Likes | Speed 100k/day | Max 100k (Server 1)', 1.2, 25, 100000, '⭐⭐⭐⭐⭐', 'Instant', '100k', '30 days', '<p><strong>- 100k/day Speed.</strong></p><p><strong>- We can also deliver In 5-6hrs On special Request.</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(463, 0, 0, 1, 'YouTube Views', 'Youtube View Native Ads | Speed 500k+/days | Min 10K', 1.5, 10000, 20000000, '⭐⭐⭐⭐⭐', '1-8hours', '500k+', '30 days', '<p><strong>- Start time: 5 minutes - 8 hours.</strong></p><p><strong>- Speed: 500k+/Day</strong></p><p><strong>- Types of views: Advertise videos on magazines and online newspapers around the world. Real users will watch your videos.</strong></p><p><strong>- Video will get channel subscriptions, video likes, dislikes from real users worldwide.</strong></p><p><strong>- Very good for the channel, effective advertising equivalent to Google adwords discovery.</strong></p><p><strong>- Views are guaranteed for 5 years, (no decrease in views in the past 5 years).</strong></p><p><br></p><p><strong>**Note**</strong></p><p><strong>Required conditions for the video:</strong></p><p><strong>- Video can be public or unlisted But Video must be Open to all countries worldwide is not allowed to block any country.</strong></p><p><strong>- Video must allow embedding.</strong></p><p><strong>- Videos must not infringe copyright without permission or they will be automatically blocked by Youtube in some countries that hold copyright. If we find a video that violates one of the above, the order will be automatically completed and no refunds will be issued. we will complete the order and not refund.</strong></p><p><strong>⚡Speed: Complete within 24-48 hours For all orders under 5 Million Views (Orders need higher speed than 2M/D, please order at ID: 5310)</strong></p><ul><li>Min 20k, Max 10M</li><li>Reffil 30 Day**(Nodrop 30 days youtube views will never be dropped again)</li><li>Types of views: Advertise videos on magazines and online newspapers around the world. Real users will watch your videos.</li><li>Video will get channel subscriptions, video likes, dislikes from real users worldwide.</li><li>Very good for the channel, effective advertising equivalent to Google adwords discovery.</li><li>Very good for channel growth.</li><li>Recommended channels are lost.</li></ul><p>⚡NOTE⚡NOTE⚡NOTE⚡</p><p>Cases Not Covered by Warranty:</p><p>- Your video has a starting number of 5k views and you launch our non drop service as 3k but then the video is below 3k views we will guarantee. However, if the video has more than 3k views, it will not be covered by the warranty because we cannot be sure that your old views will not be dropped.</p><p>- Your video has a starting number of 100K views and you order us 50k views nodrop. after completion your video has 150k views but then your video drops below 100k views also will not be covered by warranty because we can\'t be sure that your old views are not dropped</p><p>- Simply put, old views of dropped videos will not be guaranteed.</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(467, 0, 0, 1, 'YouTube Views', 'Youtube View Native Ads | Speed 1M+/days | Min 5K', 1.3, 5000, 3000000, '⭐⭐⭐⭐⭐', '0-8 hours', '2M+', '30 days refill', '<p><strong>- Start time: 5 minutes - 8 hours.</strong></p><p><strong>- Speed: 1M+/Day</strong></p><p><strong>- Types of views: Advertise videos on magazines and online newspapers around the world. Real users will watch your videos.</strong></p><p><strong>- Video will get channel subscriptions, video likes, dislikes from real users worldwide.</strong></p><p><strong>- Very good for the channel, effective advertising equivalent to Google adwords discovery.</strong></p><p><strong>- Views are guaranteed for 5 years, (no decrease in views in the past 5 years).</strong></p><p><br></p><p>**Note**</p><p>Required conditions for the video:</p><p>- Video can be public or unlisted But Video must be Open to all countries worldwide is not allowed to block any country.</p><p>- Video must allow embedding.</p><p>- Videos must not infringe copyright without permission or they will be automatically blocked by Youtube in some countries that hold copyright. If we find a video that violates one of the above, the order will be automatically completed and no refunds will be issued. we will complete the order and not refund.</p><p>⚡Speed: Complete within 24-48 hours For all orders under 5 Million Views (Orders need higher speed than 2M/D, please order at ID: 5310)</p><ul><li>Min 20k, Max 10M</li><li>Reffil 30 Day**(Nodrop 30 days youtube views will never be dropped again)</li><li>Types of views: Advertise videos on magazines and online newspapers around the world. Real users will watch your videos.</li><li>Video will get channel subscriptions, video likes, dislikes from real users worldwide.</li><li>Very good for the channel, effective advertising equivalent to Google adwords discovery.</li><li>Very good for channel growth.</li><li>Recommended channels are lost.</li></ul><p>⚡NOTE⚡NOTE⚡NOTE⚡</p><p>Cases Not Covered by Warranty:</p><p>- Your video has a starting number of 5k views and you launch our non drop service as 3k but then the video is below 3k views we will guarantee. However, if the video has more than 3k views, it will not be covered by the warranty because we cannot be sure that your old views will not be dropped.</p><p>- Your video has a starting number of 100K views and you order us 50k views nodrop. after completion your video has 150k views but then your video drops below 100k views also will not be covered by warranty because we can\'t be sure that your old views are not dropped</p><p>- Simply put, old views of dropped videos will not be guaranteed.</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(469, 0, 0, 1, 'YouTube Views', 'Package 10K-100K Views For 20-30 video of the channel | Bonus Likes, Subs | Time views 2-8 minutes | Guarantee Lifetime', 1.4, 10000, 100000, '⭐⭐⭐⭐⭐', '0-24h', '1k-5k/video/day', 'Lifetime', '<p>- Đặt hàng bằng link kênh&nbsp;</p><p>- Sau khi đặt hàng các video trong kênh của bạn sẽ được tăng views, likes, sub (20-30 video mới nhất của kênh bạn)</p><p>- Nguồn views từ thiết bị di động, toàn thế giới.&nbsp;</p><p>- Trong thời gian đặt hàng nếu bạn upload video mới hệ thống sẽ tăng views cho video mới của bạn trong vòng 1-24h.&nbsp;</p><p>-------------------------------------------</p><p>- Order by channel link</p><p>- After ordering the videos in your channel will be increased views, likes, subs (20-30 latest videos of your channel)</p><p>- Source views from mobile devices, worldwide.</p><p>- During the order period, if you upload a new video, the system will increase views for your new video within 1-24 hours.</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(470, 0, 0, 1, 'YouTube Views', 'Youtube Views | Custom Search | 10 minutes watchtime | 30 days refill', 1.5, 300, 10000, '⭐⭐⭐⭐⭐', 'Instant', '600', '30 days refill', '<h2><br></h2><p>- Hệ thống không có bộ đếm riêng nên chỉ dựa vào số views bắt đầu và kết thúc trên video để tính views nên trong quá trình chạy views có views tự nhiên lẫn vào hệ thống sẽ không chịu trách nhiệm.&nbsp;</p><p>- Không order cùng lúc nhiều dịch vụ trên một video.</p><p>- Thời gian xem 10+ phút&nbsp;</p><p>- Tốc độ 600 views/video/ngày</p><p><br></p><p>Tìm kiếm chỉ định là gì ?&nbsp;</p><h2><br></h2><iframe class=\"ql-video\" frameborder=\"0\" allowfullscreen=\"true\" src=\"https://www.facebook.com/plugins/video.php?href=www.facebook.com%2Fmotdanga%2Fvideos%2F1307864612936497&amp;show_text=0&amp;width=560\" height=\"301\" width=\"560\"></iframe><h2><br></h2>', 'Special', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(471, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 9999999, 9999999, 9999999, '9999999', '9999999', '9999999', '9999999', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(473, 0, 0, 6, 'YouTube Likes | Dislikes | Favorite | Other Services', 'Youtube Likes | Speed 250k/day | Max 300k', 1.4, 50, 300000, '⭐⭐⭐⭐⭐', 'Instant', '250k', '30 days refill', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">START: INSTANT</span><br style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">SPEED: 250K/DAY</span><br style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">DROP: NON DROP</span><br style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 14px; background-color: rgb(245, 245, 245);\">GUARANTEE: 30 DAYS REFİLL (BUTTON ENABLED)</span><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(474, 0, 0, 66, 'Telegram', 'Telegram Post Views | Last 1', 0.1, 50, 300000, '⭐⭐⭐⭐⭐', 'Instant', '300K', 'No refill', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(475, 0, 0, 66, 'Telegram', 'Telegram Post Views | Last 5', 0.4, 50, 300000, '⭐⭐⭐⭐⭐', 'Instant', '300K', 'No refill', '', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(476, 0, 0, 66, 'Telegram', 'Telegram Post Views | Last 10', 0.8, 50, 300000, '⭐⭐⭐⭐⭐', 'Instant', '300K', 'No refill', '', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(477, 0, 0, 66, 'Telegram', 'Telegram Post Views | Last 100', 5, 50, 300000, '⭐⭐⭐⭐⭐', 'Instant', '300K', 'No refill', '', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(480, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 13-15 minutes watch times |  1-Days views', 1.14, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 1 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 13-15 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 1 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(481, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 13-15 minutes watch times |  2-Days views', 2.28, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 2 day.</strong></p><p><br></p><p>- Start time : Instant</p><p>- Retention : 13-15 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 2 day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(482, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 13-15 minutes watch times |  3-Days views', 3.42, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 3 day.</strong></p><p><br></p><p>- Start time : Instant</p><p>- Retention : 13-15 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 3 day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(483, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 13-15 minutes watch times |  4-Days views', 4.56, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 4 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 13-15 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 4 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(484, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 13-15 minutes watch times |  5-Days views', 5.7, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 5 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 13-15 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 5 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(485, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 13-15 minutes watch times |  10-Days views', 11.4, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 10 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 13-15 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 10 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(486, 0, 0, 67, 'Youtube HR Views - Days', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐Suggest - 30 minutes ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 999999, 1000000, 1000000, '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(487, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 28-30 minutes watch times |  1-Days views', 1.956, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 1 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 28-30 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 1 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(488, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 28-30 minutes watch times |  2-Days views', 3.912, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 2 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 28-30 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 2 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(489, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 28-30 minutes watch times | 3-Days views', 5.868, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 3 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 28-30 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 3 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(490, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 28-30 minutes watch times |  4-Days views', 7.824, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 4 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 28-30 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 4 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(491, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 28-30 minutes watch times |  5-Days views', 9.78, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 5 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 28-30 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 5 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(492, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 28-30 minutes watch times |  10-Days views', 19.56, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 10 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 28-30 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 10 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(493, 0, 0, 67, 'Youtube HR Views - Days', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐Suggest - 60 minutes ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 999999, 1000000, 1000000, '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(494, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  1-Days views', 3.26, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 1 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 1 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(495, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  2-Days views', 6.52, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 2 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 2 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(496, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  3-Days views', 9.78, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 3 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 3 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(497, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  4-Days views', 13.04, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 4 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 4 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(498, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  5-Days views', 16.3, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 5 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 5 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(499, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  10-Days views', 32.6, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 10 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 10 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(500, 0, 0, 67, 'Youtube HR Views - Days', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐Suggest - 120 minutes ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 999999, 1000000, 1000000, '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '⭐⭐⭐⭐⭐', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(501, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 110-120 minutes watch times |  1-Days views', 5.217, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 1 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 110-120 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 1 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(502, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 110-120 minutes watch times |  2-Days views', 10.434, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p>This service has its own counter. You will get 400-600 views for your video within 2 day.</p><p><br></p><p>- Start time : Instant</p><p>- Retention : 110-120 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 2 day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(503, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 110-120 minutes watch times |  3-Days views', 15.651, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p>This service has its own counter. You will get 400-600 views for your video within 3 day.</p><p><br></p><p>- Start time : Instant</p><p>- Retention : 110-120 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 3day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(504, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 110-120 minutes watch times |  4-Days views', 20.868, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p>This service has its own counter. You will get 400-600 views for your video within 4 day.</p><p><br></p><p>- Start time : Instant</p><p>- Retention : 110-120 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 4 day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(505, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 110-120 minutes watch times |  5-Days views', 26.085, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p>This service has its own counter. You will get 400-600 views for your video within 5 day.</p><p><br></p><p>- Start time : Instant</p><p>- Retention : 110-120 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 5 day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(506, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 110-120 minutes watch times |  10-Days views', 52.17, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p>This service has its own counter. You will get 400-600 views for your video within 10 day.</p><p><br></p><p>- Start time : Instant</p><p>- Retention : 110-120 minutes&nbsp;</p><p>- Speed : 400-600 views/days</p><p>- Guarantee : Lifetime&nbsp;</p><p>- Traffic source : suggest&nbsp;</p><p><br></p><p>* Enter the amount of 1000 corresponding to 10 day of running views.&nbsp;</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(515, 0, 0, 53, 'Facebook - Shares | Tăng lượt chia sẻ', 'Facebook Real Share Việt Nam | Speed ​​10 - 20k Share/Days', 20, 30, 100000, '⭐⭐⭐⭐⭐', '0-1 hours', '10k-50k', 'No refill', '<p>Start time: 0-60 minutes&nbsp;</p><p>Minimum Order: 30&nbsp;</p><p>Maximum Order: 100,000&nbsp;</p><p>--purchase quantity must be a multiple of 10, otherwise it will subtract the odd part by itself and run</p><p>--Increase personal shares</p><p>--nick shares posts on their profile</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(518, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  6-Days views', 19.56, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 6 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 6 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(519, 0, 0, 67, 'Youtube HR Views - Days', 'Youtube HR Views | Source Suggest | 58-60 minutes watch times |  8-Days views', 26.08, 1000, 1000, '⭐⭐⭐⭐⭐', 'Instant', '400-600', 'Lifetime', '<p><strong>This service has its own counter. You will get 400-600 views for your video within 8 day.</strong></p><p><br></p><p><strong>- Start time : Instant</strong></p><p><strong>- Retention : 58-60 minutes&nbsp;</strong></p><p><strong>- Speed : 400-600 views/days</strong></p><p><strong>- Guarantee : Lifetime&nbsp;</strong></p><p><strong>- Traffic source : suggest&nbsp;</strong></p><p><br></p><p><strong>* Enter the amount of 1000 corresponding to 8 day of running views.&nbsp;</strong></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(523, 0, 0, 8, 'Instagram Followers', 'Instagram Followers | VIET NAM | Speed 10-30K/day', 1.2, 50, 50000, '⭐⭐⭐⭐⭐', 'Instant', '10k', 'No Refill', '<p>- Drop 5-10%</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(524, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | Speed 5k - 30k/days', 0.75, 500, 1000000, '⭐⭐⭐⭐⭐', '0-2h', '5k-30k', '30 days', '<p>0-2h start</p><p>5- 30K speed</p><p>--We will refuse to issue refunds for ids that are dead, or deleted, hidden--</p><p>--min : 500 view =&gt; max : 1000000 view</p><p>--purchase quantity must be a multiple of 100, otherwise it will subtract the odd part by itself and run--</p><p><br></p><p>We accept all orders, if the link is wrong we will refund</p><p>Orders cannot be canceled for any reason</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(526, 0, 0, 1, 'YouTube Views', 'Youtube views | Source Suggest + Home + Search | 60 Minutes Watchtime| Bonus Likes | Speed 3k+ views/day', 6, 1000, 50000, '⭐⭐⭐⭐⭐', 'Instant', '3000', 'Lifetime', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(536, 0, 0, 6, 'YouTube Likes | Dislikes | Favorite | Other Services', 'Youtube Likes | Speed 50k/days | No Guarantee', 0.6, 10, 100000, '⭐⭐⭐⭐⭐', 'Instant', '50000', 'No refill', '<p>Instant Start</p><p>NO Refill</p><p>Fast 50k Per Day Speed</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(537, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'Youtube Live Stream |  Live Stable Upto 30+ Minutes', 1.6, 5000, 200000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Instant Start</p><p>Live Stable For 30+ Minutes</p><p>30 Minutes Live CONCURRENT Stable</p><p>( Buyer will Get 1000-2000 Live View For 30 Minutes, Instant Start )</p><p>If Buyer Place 5000 Quantity Order : He Will Get 1000-2000 Live Views</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(539, 0, 0, 1, 'YouTube Views', 'Youtube Views + Bonus Likes | Source: Suggested | Less Drop | No Refill | 3k+/day', 0.7, 150, 1000000, '⭐⭐⭐⭐⭐', 'Instant', '3k+', 'No refill', '<p>No Cancel/No Refund/No Refill</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(542, 0, 0, 14, 'Tiktok', 'TikTok Real Followers | Max 200K | 10K/Day | Best Services | 30 Days Refill', 2, 100, 200000, '⭐⭐⭐⭐⭐', '0-1 hours', '10000', '30 days', '<p>START: 0-1 HOURS</p><p>SPEED: 5K-7K/DAY</p><p>DROP: 5-20%&nbsp;</p><p>GUARANTEE: 30 days</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(549, 0, 0, 50, 'Facebook - Followers | Tăng người theo dõi', 'FB Profile Followers [VIET NAM] [ Max 1000k] [ 300k/day] [ 30 Days guarantee]', 0.7, 500, 100000, '⭐⭐⭐⭐⭐', 'Instant', '20K', '30 days', '<p>- We will refuse to issue refunds for ids that are dead, or deleted, hidden</p><p>- Purchase quantity must be a multiple of 100</p><p>- Otherwise it will subtract the odd part by itself and run</p><p>- We accept all orders, if the link is wrong we will refund</p><p>- Orders cannot be canceled for any reason</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(550, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'REAL ADS - RAV™ LiveStream Views', 3.5, 100, 100000, '⭐⭐⭐⭐⭐', 'Instant', '-', 'No refill', '<p>• RAV™ - Real Active Views**</p><p>• INSTANT START</p><p>• 100% Real Human YouTube Users Viewers!</p><p>• Delete protection - on video/channel termination get auto-Full/Partial refund</p><p>• Windows Desktop &amp; Mobile Watch Page Views</p><p>• 100% Unique Traffic that can be monetized!</p><p>• World-Wide Viewers</p><p>• Video ust be Unrestricted &amp; Open for ALL countries</p><p>• Random Retention (based on viewer interest in the livestream!)</p><p>• Avg Concurrent and watch-time is based on livestream content</p><p>• Cancel any Time with Full/Partial Refund</p><p>• Over-Delivery Guaranteed</p><p>• views can be delivered to an embed disabled livestream videos</p><p>• Traffic Sources: Direct Advertisement</p><p><br></p><p><br></p><p>*Service offered as is with no refill/refund guarantee!</p><p>** Livestream views may include real user engagements - your video may get some daily likes/dislikes, chat comments, shares, subscribers</p><p>all made by real YouTube users that we do not control!</p><p>*** livestream views will register as playbacks on the livestream stats (YouTube Studio) but may not register in full on the \'regular\' offline recorded version of the video stats.</p><p>we can\'t grantee the total watch-time or amount of concurrent viewers only total of unique views that sent during the campaign.</p><p><br></p><p>https://i.gyazo.com/254bce6afe96bd5149fd290c06bbec94.png</p><p>https://i.gyazo.com/9f78659c94df658ba6b56344ae540bf2.png</p><p>https://i.gyazo.com/610ea2c7078ae94d3a439969f0e93d15.png</p><p>(picture shown is for illustration purpose only. actual product may vary due to product enhancement)</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(551, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'REAL ADS - RAV™ Pre-Premiere Waiting Viewers', 3.5, 1000, 100000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>• RAV™ - Real Active Views Pre-Premiere Waiting Views**</p><p>• INSTANT START</p><p>• 100% Real Human YouTube Users Pre-Premiere Viewers!</p><p>• Windows Desktop &amp; Mobile Watch Page Views</p><p>• 100% Unique Traffic can be monetize!</p><p>• World-Wide Viewers</p><p>• Must be Unrestricted &amp; Open for ALL countries</p><p>• Random Retention</p><p>• Avg Concurrent and watch-time based on Pre-Premiere content</p><p>• Cancel any Time with Full/Partial Refund</p><p>• Over-Delivery Guaranteed</p><p>• views can be send to embed disabled Pre-Premiere videos</p><p>• Traffic Sources: Direct Advertisement (Real ADS)</p><p><br></p><p>* Service offered as is with no refill/refund guarantee!</p><p>** views may include real user engagements - your video may get some likes/dislikes, chat comments, shares, subscribers</p><p>all made by real YouTube users that we do not control!</p><p>*** note that ONLY some of the Pre-Premiere Waiting visitors will turn into viewers if the premiere broadcast will start during the campaign time-frame. (some visitors will wait but leave the watch-page before the video turn into live, those will not get registered as livestream viewers or as YouTube views)</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(554, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 3 Seconds | Monetizable | Max 1M | Speed: 100K-200K/Day', 0.8, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(555, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 10 Seconds | Monetizable | Max 1M | Speed: 100K-200K/Day', 0.85, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(556, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 15 Seconds | Monetizable | Max 1M | Speed: 100K-200K/Day', 0.9, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(557, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 30 Seconds | Monetizable | Max 1M | Speed: 100K-200K/Day', 1, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(558, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 1 Minutes | Monetizable | Max 1M | Speed: 100K-200K/Day', 1.2, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(559, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 3 Minutes | Monetizable | Max 1M | Speed: 100K-200K/Day', 2.1, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(560, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 6 Minutes | Monetizable | Max 1M | Speed: 100K-200K/Day', 2.6, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(561, 0, 0, 13, 'Facebook - Video Views', 'Facebook Video Views | 10 Minutes | Monetizable | Max 1M | Speed: 100K-200K/Day', 4, 500, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k-200k', 'No refill', NULL, 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(562, 0, 0, 53, 'Facebook - Shares | Tăng lượt chia sẻ', 'Facebook Share | Speed ​​50k Share/Days', 1.4, 100, 500000, '', 'Instant', '50k', '-', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(567, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '[VIP] YouTube Live Stream Views | Stable viewers for 30 minutes', 17, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers</p><p>Viewers will watch for 30 minutes.</p><p><br></p><p>Buyer Will Get 30 Minutes Live</p><p><br></p><p>( if Buyer Place 1000 Quantity, He will Get 1000 Live Viewer For 30 Minutes</p><p><br></p><p>Real viewers (sometimes they can stay for a longer period).</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(568, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '[VIP] YouTube Live Stream Views | Stable viewers for 60 minutes', 35, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers</p><p>Viewers will watch for 60 minutes.</p><p><br></p><p>Buyer Will Get 60 Minutes Live</p><p><br></p><p>( if Buyer Place 1000 Quantity, He will Get 1000 Live Viewer For 60 Minutes</p><p><br></p><p>Real viewers (sometimes they can stay for a longer period).</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(569, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '[VIP] YouTube Live Stream Views | Stable viewers for 3 hours', 90, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers</p><p>Viewers will watch for 3 hours.</p><p><br></p><p>Buyer Will Get 3 hours Live</p><p><br></p><p>( if Buyer Place 1000 Quantity, He will Get 1000 Live Viewer For 3 hours</p><p><br></p><p>Real viewers (sometimes they can stay for a longer period).</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(570, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '[VIP] YouTube Live Stream Views | Stable viewers for 6 hours', 180, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers</p><p>Viewers will watch for 6 hours.</p><p><br></p><p>Buyer Will Get 6 hours Live</p><p><br></p><p>( if Buyer Place 1000 Quantity, He will Get 1000 Live Viewer For 6 hours</p><p><br></p><p>Real viewers (sometimes they can stay for a longer period).</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(571, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '[VIP] YouTube Live Stream Views | Stable viewers for 12 hours', 360, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers</p><p>Viewers will watch for 12 hours.</p><p><br></p><p>Buyer Will Get 12 hours&nbsp;Live</p><p><br></p><p>( if Buyer Place 1000 Quantity, He will Get 1000 Live Viewer For 12 hours</p><p><br></p><p>Real viewers (sometimes they can stay for a longer period).</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(572, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', '[VIP] YouTube Live Stream Views | Stable viewers for 24 hours', 700, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers</p><p>Viewers will watch for 24 hours.</p><p><br></p><p>Buyer Will Get 24 hours&nbsp;Live</p><p><br></p><p>( if Buyer Place 1000 Quantity, He will Get 1000 Live Viewer For 24 hours</p><p><br></p><p>Real viewers (sometimes they can stay for a longer period).</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(573, 0, 0, 55, 'Private', 'views social', 10.869, 1000, 1000, '-', '-', '-', '-', '<p><br></p>', 'Default', '2022-05-03 15:00:04', '2022-05-09 14:00:10'),
(574, 0, 0, 14, 'Tiktok', 'Tiktok Likes | Max 500 | Super fast | Refill 30 days', 0.5, 10, 500, '⭐⭐⭐⭐⭐', 'Instant', '500', '30 days', '<p>Instant Start</p><p>Min 10 and Max 500</p><p>High-Quality Tik Tok Likes</p><p>30 Days Refill</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10');
INSERT INTO `servicess` (`id`, `provider_id`, `status`, `catid`, `cat`, `name`, `rate`, `min`, `max`, `feature_quality`, `feature_start`, `feature_speed`, `feature_refill`, `desc`, `type`, `created_at`, `updated_at`) VALUES
(575, 0, 0, 14, 'Tiktok', 'Tiktok Followers | Max 200k | No refill', 1.5, 100, 200000, '⭐⭐⭐⭐⭐', 'Instant', '5k - 7k', 'No refill', '<p>No Guarantee But no drop has been encountered in this service</p><p>Speed: 5-8k/Day</p><p>Mixed Quality Accounts</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(576, 0, 0, 14, 'Tiktok', 'TikTok Followers | Real+No drop+Fast | Max 100k | No refill', 0.6, 10, 100000, '⭐⭐⭐⭐⭐', 'Instant', '5k - 7k', 'No refill', '<p>Start time : Instant</p><p>Non drop</p><p>Minimum : 100</p><p>Max : 100000</p><p>Superfast service</p><p>No refill</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(577, 0, 0, 14, 'Tiktok', 'TikTok Likes | Max 1K | Instant Start | 1K/Hour', 0.8, 50, 1000, '⭐⭐⭐⭐⭐', 'Instant', '1k/hours', '30 days', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(578, 0, 0, 1, 'YouTube Views', 'Youtube views | Source Suggest + Home + Search | 30 Minutes Watchtime| Bonus Likes | Speed 3k+ views/day', 3.2, 1000, 20000, '⭐⭐⭐⭐⭐', 'Instant', '3000+', 'Lifetime', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(579, 0, 0, 50, 'Facebook - Followers | Tăng người theo dõi', 'Facebook Page Followers | 10k - 50k/day | Max 100k', 1.2, 1000, 100000, '⭐⭐⭐⭐⭐', '0 - 6 hours', '10k-50k', '30 days', '<ul><li>Start time: 120 - 720 minutes&nbsp;</li><li>Speed per Day: 10,000 - 50,000 Followers&nbsp;</li><li>30 Days Refill Guarantee&nbsp;</li><li>Minimum Order: 1000&nbsp;</li><li>Maximum Order: 100,000&nbsp;</li><li>Request facebook nick to publicly turn on the tracking number, open the tracking button, and have at least 1 follower&nbsp;</li><li>in case of running, arbitrarily turn off the display of tracking number, arbitrarily turn off the tracking button will not be refunded</li><li>If the running order is not run any more, otherwise there won\'t be enough quantity already running</li><li>purchase quantity must be a multiple of 100, valid example, quantity: 600, 1000, 1100, 1300, 3500&nbsp;</li><li>Total oder 100,000 Followers</li></ul><p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(580, 0, 0, 14, 'Tiktok', 'TikTok Video Views Super Fast [ Max 100M ] [ 0.025$ ]', 0.05, 50, 100000000, '⭐⭐⭐⭐⭐', 'Instant', '1M', '30 days', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(581, 0, 0, 14, 'Tiktok', 'TikTok Likes | Best Quality | Max: 10K | Day 20K/30K', 1.7, 100, 30000, '⭐⭐⭐⭐⭐', 'Instant', '20000', 'No refill', '<p>- Start: 5 min</p><p>- Speed : 20K/30K Per Day</p><p>- Drop : No</p><p>- Quality: Real users (with avatars, many with videos).</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(582, 0, 0, 14, 'Tiktok', 'TikTok Shares | Max 1M | 100k/day | 30 days Guarantee', 1.2, 10, 70000, '⭐⭐⭐⭐⭐', 'Instant', '100K', '30 days', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(583, 0, 0, 8, 'Instagram Followers', 'Instagram Followers | Speed 20k/days | Guarantee 30 days', 0.5, 10, 100000, '⭐⭐⭐⭐⭐', 'Instant', '50K', '90 days', '<p>Accounts with Avatars and Posts.</p><p>Auto-Refill up to 100% within a month.</p><p>Current speed: 26,890 per hour.</p><p>Drop Ratio is: ~14%</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(586, 0, 0, 14, 'Tiktok', 'TikTok Real Likes | Max 200K | 20k/days | 30 days refill', 3, 10, 200000, '⭐⭐⭐⭐⭐', 'Instant', '20K', '30 days', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(587, 0, 0, 14, 'Tiktok', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 999999, 99999999, 99999999, '', '', '', '', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(588, 0, 0, 14, 'Tiktok', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 99999999, 99999999, 99999999, '', '', '', '', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(590, 0, 0, 14, 'Tiktok', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 9999999999, 2147483647, 2147483647, '', '', '', '', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(591, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'Youtube Live Stream | Instant Start | Stable 40-50 Minutes', 0.7, 2000, 200000, '⭐⭐⭐⭐⭐', 'Instant', '-', '-', '<ul><li>Youtube Live Stream in Lowest Rate in Market</li></ul><p><br></p><ul><li>Min 2000 And Max 200k</li><li>Live Stream Start in 5-7 Minutes on Average</li><li>Once Stream Start</li><li>Live Number Will Increase Slowly And it will Stable For Upto 50+ Minutes</li></ul><p><br></p><ul><li>Live Wil increase Upto 200+ Live Viewer on 2000 Stream Order</li></ul><p><br></p><ul><li>Buyer Will Get Upto 10% Live Viewer For Upto 50 Minutes</li><li>( ALL Record is on Our Testing and Estimation it can increase or decrease according to Youtube Update )</li><li>( Increment by 100, Do Not Place 2150 or 2650 Order Like this )</li></ul>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(593, 0, 0, 1, 'YouTube Views', 'Youtube Views | 15k/Day | Bonus likes | 60 Days Refill', 0.9, 100, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '10k-15k', '60 days', '<p>Special Views Bonus 3-4% Likes</p><p>Instant start</p><p>No fall -- 60D refill</p><p>Min speed 7K /day</p><p>max speed 15k/day</p><p>Source: Internal</p><p>Retention: 30 Sec - 1min</p><p>( We Send 20-30% Extra Views Automatically If We Find Any Drop Issue - But We Do not take Guarantee For Extra Views,</p><p>If Buyer Place 1000 Order He Get 1200-1300 Views: If 200 Views Drop Buyer Won\'t Get Refill for Extra Views )</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(594, 0, 0, 1, 'YouTube Views', 'Youtube views Social | Speed 100k-300k/Days | 60 Days Refill', 1.3, 20000, 2000000, '⭐⭐⭐⭐⭐', '0-6 hours', '100k-300k', '60 days', '<ul><li>Start time: 0 - 6 hours</li><li>Speed: 100k-300k/day (usually 300k/day)</li><li>Guarantee: 60 days.</li></ul><p>- This is a video ad view on social networks, social platforms are our partners, the view comes entirely from real users, the video will receive a certain number of interactions depending on the viewer. video perception of your video content.</p><p>- We don\'t have our own view counter, order completion is based entirely on video views. and we are not responsible and do not deal with any further cases when the video has had enough views compared to the starting number.</p><p>- The warranty only covers the number of views ordered from the first order and only our views. for example: your video has 10k views and you order this service 20k views after completing the video with 30k views or more but then the video is reduced to 30k then we will not be responsible. We will make sure the video always has 20k views.</p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(597, 0, 0, 6, 'YouTube Likes | Dislikes | Favorite | Other Services', 'Youtube Community Post Likes', 2, 10, 100000, '⭐⭐⭐⭐⭐', 'Instant', '10k', '30 days', '<ul><li>Don\'t Put a Video link</li><li>This Service is only for youtube Community Post</li></ul><p>( Example: https://www.youtube.com/post/Ugkxz088jmpsfc1f-lVhPQHektZJvKfY_HU2 )</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(598, 0, 0, 66, 'Telegram', 'Telegram Positive Reaction + Views | Max 500K | Day 50K', 0.3, 20, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50k', 'No', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - ❤️ to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(600, 0, 0, 1, 'YouTube Views', 'Youtube views | Source Suggest + Home + Search | 15 Minutes Watchtime| Bonus Likes | Speed 3k+ views/day', 2, 1000, 20000, '⭐⭐⭐⭐⭐', 'Instant', '3000', 'Lifetime', '<p><br></p>', 'Default', '2022-04-19 10:27:46', '2022-05-09 14:00:10'),
(601, 0, 0, 6, 'YouTube Likes | Dislikes | Favorite | Other Services', 'Youtube Likes | Speed 100k/day | Max 100k (Server 2)', 0.8, 10, 100000, '⭐⭐⭐⭐⭐', 'Instant', '100K', '30 days', '<p><br></p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(602, 0, 0, 8, 'Instagram Followers', 'Instagram Followers | 50K/Day | 99 days warranty', 0.8, 10, 5000000, '⭐⭐⭐⭐⭐', 'Instant', '50k', '99 days', '<p>Service id 602 is The Most Selling Service on Our website</p><p>( We Complete Daily 5000+ Orders in this Single Service )</p><p><br></p><p>Speed 50K/day</p><p>HQ Followers</p><p><span style=\"color: rgb(205, 205, 222);\">Guarantee</span>: 99 Days</p><p>Drop Ratio Below 0.5%</p>', 'Default', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(603, 0, 0, 5, 'YouTube Comment', 'Youtube Custom Comments | Max 50k | WorldWide | Instant Start', 6, 10, 50000, '⭐⭐⭐⭐⭐', 'Instant', '10k', 'NO', '<p><br></p>', 'Custom Comments', '2022-04-19 10:27:47', '2022-05-09 14:00:10'),
(604, 0, 0, 1, 'YouTube Views', 'Youtube Views Social | Speed 150k-200k/Day | 60 days warranty', 1, 1000, 2000000, '⭐⭐⭐⭐⭐', '0-6 hours', '150k-200k', '60 days', '<p>Start time: 5 Minutes - 5h</p><p>Speed: 150k-200k/day (usually 150k/day)</p><p>Guarantee: 60 days.</p><p>Min orders: 2k</p><p>Max orders: 2M</p><p>- This is a video ad view on social networks, social platforms are our partners, the view comes entirely from real users, the video will receive a certain number of interactions depending on the viewer. video perception of your video content.</p><p>- We don\'t have our own view counter, order completion is based entirely on video views. and we are not responsible and do not deal with any further cases when the video has had enough views compared to the starting number.</p><p>- The warranty only covers the number of views ordered from the first order and only our views. for example: your video has 10k views and you order this service 20k views after completing the video with 30k views or more but then the video is reduced to 30k then we will not be responsible. We will make sure the video always has 20k views.</p>', 'Default', '2022-04-19 10:27:36', '2022-05-09 14:00:10'),
(605, 0, 0, 14, 'Tiktok', 'TikTok Likes | Max 1k | Instant with 30 Days Guarantee', 0.7, 100, 1000, '⭐⭐⭐⭐⭐', 'Instant', '1000', '30 days', '<p><br></p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(606, 0, 0, 66, 'Telegram', 'Telegram Reaction | Likes + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Likes to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(607, 0, 0, 66, 'Telegram', 'Telegram Reaction | Dislikes + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Dislikes to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(608, 0, 0, 66, 'Telegram', 'Telegram Reaction | ❤️ + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - ❤️ to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(609, 0, 0, 66, 'Telegram', 'Telegram Reaction | sit + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - sit to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(610, 0, 0, 66, 'Telegram', 'Telegram Reaction | Hot + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Hot to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(611, 0, 0, 66, 'Telegram', 'Telegram Reaction | Nausea + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Nausea to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(612, 0, 0, 66, 'Telegram', 'Telegram Reaction |  Firework + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Firework to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(613, 0, 0, 66, 'Telegram', 'Telegram Reaction |  Sad + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Sad to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(614, 0, 0, 66, 'Telegram', 'Telegram Reaction | Bright eyes + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Bright eyes to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(615, 0, 0, 66, 'Telegram', 'Telegram Reaction | Scared + Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Scared to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(616, 0, 0, 66, 'Telegram', 'Telegram Reaction | Smile+ Views | Max 500K | Day 50K', 0.25, 10, 500000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Smile to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(617, 0, 0, 66, 'Telegram', 'Telegram Positive Reaction + Views | Max 1M | 50 Future Post', 25, 100, 1000000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Random Positive to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(618, 0, 0, 66, 'Telegram', 'Telegram Negative Reaction + Views | Max 1M | 50 Future Post', 25, 100, 1000000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Random negative to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(619, 0, 0, 66, 'Telegram', 'Telegram Negative Reaction + Views | Max 500K | Day 50K', 0.3, 20, 500000, '⭐⭐⭐⭐⭐', 'Instant', '10', '30 days', '<p>Example Link: https://t.me/Your_Channel_ID/2</p><p>- Start : 0-10 Munites</p><p>- Reaction - Random negative to the post.</p><p>- Automatically increase views!</p><p>- Please check the correctness of the entered link!</p><p><br></p><p>Notes:</p><p>• When the service is busy, the starting speed of the process changes.</p><p>• Do not place the second order on the same link before your order is completed in the system.</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(620, 0, 0, 66, 'Telegram', '⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐ Telegram Reactions + Views ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐', 99999999, 99999999, 99999999, '⭐⭐⭐⭐⭐', 'Instant', '10', '30 days', '<p>⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐ Telegram Reactions + Views ⭐⭐⭐⭐⭐⭐⭐⭐⭐⭐</p>', 'Default', '2022-04-24 07:06:35', '2022-05-09 14:00:10'),
(621, 0, 0, 14, 'Tiktok', 'TikTok Likes | Max 10K | Speed 1K/Hr | Refill 30D', 0.9, 100, 10000, '⭐⭐⭐⭐⭐', 'Instant', '1k/hours', '30 days', '<p><br></p>', 'Default', '2022-04-28 01:00:10', '2022-05-09 14:00:10'),
(622, 0, 0, 68, 'Twitter', 'Twitter Followers | Max 500K | 30 Day Refill | Speed 50k/days', 3.2, 100, 500000, '⭐⭐⭐⭐⭐', 'Instant', '100K', '30 days', '<p>Example Link: https://twitter.com/username</p><p>- Start: 0-1 Hours</p><p>- Speed : 50K/day</p><p>- Drop: %10</p><p>- 30 Day Refill</p><p>- Cancel button: Yes</p><p>- Description: Different real accounts.</p>', 'Default', '2022-04-28 02:00:04', '2022-05-09 14:00:10'),
(623, 0, 0, 2, 'YouTube LIVE Viewers | LiveStream | Pre-Premiere', 'YouTube Live Stream Views [Fast service] ( 30 Minutes Live CONCURRENT Stable )', 15, 500, 50000, '⭐⭐⭐⭐⭐', 'Instant', '50K', 'NO', '<p>Concurrent means: If you order 1000 then you will have 1000 viewers watching your live the whole period!</p><p><br></p><p>Viewers will watch for 30 minutes.</p>', 'Default', '2022-04-29 15:00:04', '2022-05-09 14:00:10'),
(624, 0, 0, 1, 'YouTube Views', 'YouTube Views | Source : Facebook | Country : Vietnam | Speed 50k+/day', 1.4, 1000, 1000000, '⭐⭐⭐⭐⭐', 'Instant', '50k+', '30 days', '<ul><li>Traffic Source : Facebook</li><li>Retention : 1-6 minutes</li><li>Country : 95% Vietnam</li></ul><p><br></p>', 'Default', '2022-05-01 05:00:04', '2022-05-09 14:00:10'),
(625, 0, 0, 68, 'Twitter', 'Twitter Likes | Max 50K | Super Instant | Daily Speed 40k', 1.5, 100, 50000, '⭐⭐⭐⭐⭐', 'Instant', '40K', 'NO', '<p><br></p>', 'Default', '2022-05-01 07:00:04', '2022-05-09 14:00:10'),
(626, 0, 0, 68, 'Twitter', 'Twitter Likes | Max 50K | 30 Day Refill | Day 30K/40K', 1.6, 100, 300000, '⭐⭐⭐⭐⭐', '0-1 hours', '50K', '30 days', '<p><br></p>', 'Default', '2022-05-01 08:00:04', '2022-05-09 14:00:10'),
(627, 0, 0, 68, 'Twitter', 'Twitter Turkish Retweet | Max: 1.5K | Fast', 3, 10, 2000, '⭐⭐⭐⭐⭐', 'Instant', '1500', 'NO', '<p><br></p>', 'Default', '2022-05-01 10:00:04', '2022-05-09 14:00:10'),
(628, 0, 0, 13, 'Facebook - Video Views', 'Facebook Views  | Speed 100k+/hour', 0.9, 1000, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '100k/hours', '30 days', '<p><br></p>', 'Default', '2022-05-02 00:00:05', '2022-05-09 14:00:10'),
(629, 0, 0, 8, 'Instagram Followers', 'Instagram Followers | Best Quality | 99 Days Guaranteed | 1 Million Followers in Just 7 Days', 0.4, 10, 1000000, '⭐⭐⭐⭐⭐', 'Instant', '150k/day', '99 days', '<p><br></p>', 'Default', '2022-05-02 01:00:04', '2022-05-09 14:00:10'),
(630, 0, 0, 48, 'Youtube Adword Views [ Google Ads ]', 'Youtube Real Adwords View + 100K Likes | Min 500K  | Fast Approval', 1, 500000, 100000000, '⭐⭐⭐⭐⭐', 'Instant', '1M', 'Lifetime', '<ul><li>Video Must Below 10 Minutes</li><li>Approval within 2-3 hour</li><li>Order Will COMPLETE Within 24 Hours</li><li>Report Will Be Provided ( If Needed )</li><li>100% Real Genuine Source - Youtube Advertisement</li><li>Life Time Guaranteed</li><li>500K Order Will get 50K Bonus Liukes</li><li>1M Order Will Get 100K Bonus Likes</li></ul>', 'Default', '2022-05-03 13:00:03', '2022-05-09 14:00:10'),
(631, 0, 0, 14, 'Tiktok', 'TikTok  Views | Real Engaging | Speed 10M/day', 0.07, 100, 5000000, '⭐⭐⭐⭐⭐', 'Instant', '10M', 'NO', '<ul><li>100% Real Engaging TikTok Views</li><li>Tiktok Trending Views</li><li>High Chance to Get in Trend</li><li>http://tiktok.com/trending</li><li>Place Big Order to Get in Trending.</li></ul><p>Order link form: https://www.tiktok.com/@rvlreview/video/6966881150279175426</p><p><br></p>', 'Default', '2022-05-03 16:00:08', '2022-05-09 14:00:10'),
(632, 0, 0, 50, 'Facebook - Followers | Tăng người theo dõi', 'FB Profile Followers | Max 5M | 1-2M/Day | 7 Days Guarantee', 0.5, 500, 5000000, '⭐⭐⭐⭐⭐', 'Instant', '1M', '7 days', '<ul><li>The service is only for Facebook profiles.</li></ul>', 'Default', '2022-05-03 14:00:04', '2022-05-09 14:00:10'),
(635, 0, 0, 14, 'Tiktok', 'TikTok Shares | Max 100k | REAL | 10k/days | INSTANT', 0.5, 30, 100000, '⭐⭐⭐⭐⭐', 'Instant', '10K', 'NO', '<p><br></p>', 'Default', '2022-05-04 04:00:06', '2022-05-09 14:00:10'),
(636, 0, 0, 14, 'Tiktok', 'TikTok Shares | Max 100k | 30 days Guarantee |100k/days | INSTANT', 0.06, 100, 50000000, '⭐⭐⭐⭐⭐', 'Instant', '100K', '30 days', '<p><br></p>', 'Default', '2022-05-04 03:00:04', '2022-05-09 14:00:10'),
(637, 0, 0, 65, 'Facebook | Tăng thành viên nhóm', 'Facebook Group Member [VIET NAM]', 1.4, 1000, 10000000, '⭐⭐⭐⭐⭐', 'Instant', '3000', 'NO', '<ul><li>Mem clone VIP </li><li>Có avata </li><li>Có bạn bè </li><li>Lên trong ngày </li><li>Tốc độ 3k/1 Day </li></ul>', 'Default', '2022-05-05 10:00:23', '2022-05-09 14:00:10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `service_api`
--

CREATE TABLE `service_api` (
  `id` int NOT NULL,
  `type_api` varchar(255) DEFAULT NULL,
  `api_name` varchar(225) NOT NULL,
  `api_url` text NOT NULL,
  `api_key` varchar(225) NOT NULL,
  `api_type` int NOT NULL,
  `api_limit` double NOT NULL DEFAULT '0',
  `api_alert` enum('1','2') NOT NULL DEFAULT '2' COMMENT '2 -> Gönder, 1 -> Gönderildi',
  `balance` float DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `service_api`
--

INSERT INTO `service_api` (`id`, `type_api`, `api_name`, `api_url`, `api_key`, `api_type`, `api_limit`, `api_alert`, `balance`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(6, 'urlencoded', '1dg.me', 'http://1dg.me/api/v2', '57a9a87929c2d021ba2933302c75a8eb', 1, 2, '2', 1.324, 'USD', 1, '2022-05-09 15:05:05', '2022-05-12 15:32:28'),
(7, 'json', '1kview.com', 'https://1kview.com/api/v2\r\n', '148e83f2134675994adcb8c3cd76e38f', 1, 0, '2', 2.07273, 'USD', 1, '2022-05-09 15:05:05', '2022-05-12 15:32:28'),
(18, 'json', 'smmlite.com', 'https://smmlite.com/api/v2', '7f1cc9cde2b9595409eaa693415b0762', 1, 0, '2', 0, 'USD', 1, '2022-05-09 16:41:34', '2022-05-12 15:32:26'),
(19, 'urlencoded', 'autofb.net', 'https://autofb.net/api/v2', '0b0afe394fc6c0b4a69dfb7eda9e4316', 1, 0, '2', 0, 'USD', 1, '2022-05-11 23:30:21', '2022-05-12 00:07:17'),
(20, 'urlencoded', 'smmred.com', 'https://smmred.com/api/v2', 'cc36a78551d31a6c15d6f52a245f949f', 1, 0, '2', 0, 'USD', 1, '2022-05-11 23:57:48', '2022-05-12 15:32:25'),
(21, 'urlencoded', '10ksub.com', 'https://10ksub.com/api/v2', 'a800555374c1190485cfc91b31378b1a', 1, 0, '2', 0, 'USD', 1, '2022-05-11 23:58:48', '2022-05-12 15:32:24'),
(22, 'urlencoded', 'fans4biz.com', 'https://fans4biz.com/api', 'cac66c8a216a10c534b3a4b60906d7da', 1, 0, '2', 0, NULL, 1, '2022-05-12 00:06:29', '2022-05-12 00:06:29');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int NOT NULL,
  `name_setting` varchar(2000) DEFAULT NULL,
  `value_setting` mediumtext,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `name_setting`, `value_setting`, `created`, `updated`, `status`) VALUES
(309, 'e-bike', 'a:6:{i:0;a:2:{s:5:\"email\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:5:\"email\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:5:\"email\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";}}i:1;a:2:{s:11:\"url-sitemap\";s:52:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0L3NpdGVtYXAtaW5kZXgv\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:11:\"url-sitemap\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:52:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0L3NpdGVtYXAtaW5kZXgv\";s:11:\"url-sitemap\";s:52:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0L3NpdGVtYXAtaW5kZXgv\";}}i:2;a:2:{s:8:\"url-home\";s:36:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0Lw==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:8:\"url-home\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:36:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0Lw==\";s:8:\"url-home\";s:36:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0Lw==\";}}i:3;a:2:{s:13:\"seo-title-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:13:\"seo-title-add\";s:10:\"tdr_choise\";s:9:\"muti_line\";s:9:\"tdr_value\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:13:\"seo-title-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";}}i:4;a:2:{s:16:\"seo-keywords-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:16:\"seo-keywords-add\";s:10:\"tdr_choise\";s:9:\"muti_line\";s:9:\"tdr_value\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:16:\"seo-keywords-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";}}i:5;a:2:{s:19:\"seo-description-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:19:\"seo-description-add\";s:10:\"tdr_choise\";s:9:\"muti_line\";s:9:\"tdr_value\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:19:\"seo-description-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";}}}', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `panel_name` varchar(255) DEFAULT NULL,
  `site_currency` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `site_maintenance` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ticket_system` int NOT NULL,
  `registration_page` int NOT NULL,
  `skype_area` int NOT NULL,
  `name_secret` int NOT NULL,
  `terms_checkbox` int NOT NULL,
  `neworder_terms` int NOT NULL,
  `resetpass` int NOT NULL,
  `service_list` int NOT NULL,
  `auto_refill` int NOT NULL,
  `avarage` int NOT NULL,
  `ser_sync` int NOT NULL,
  `sms_verify` int NOT NULL,
  `mail_verify` int NOT NULL,
  `custom_header` varchar(255) DEFAULT NULL,
  `custom_footer` varchar(255) DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `socials`
--

CREATE TABLE `socials` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `socials`
--

INSERT INTO `socials` (`id`, `name`, `code`, `status`) VALUES
(1, 'Facebook', 'facebook', 1),
(2, 'Instagram', 'instagram', 1),
(3, 'Tiktok', 'tiktok', 1),
(4, 'Shopee', 'shopee', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `id_customer` int NOT NULL,
  `id_profile` int NOT NULL,
  `id_order` int NOT NULL,
  `id_promotion` int NOT NULL,
  `coin_purchase` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `transaction_time` datetime NOT NULL,
  `type` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(191) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `trash` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `balance` double DEFAULT '0',
  `spent` double NOT NULL,
  `level` int NOT NULL DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `key_api` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `debit_limit` double DEFAULT NULL,
  `balance_type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `user_type` enum('1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `balance`, `spent`, `level`, `name`, `email`, `email_verified_at`, `key_api`, `debit_limit`, `balance_type`, `user_type`, `currency`, `provider_id`, `provider`, `birthday`, `phone`, `password`, `remember_token`, `address`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 1, 'Minh', 'mtuan2356@gmail.com', NULL, NULL, NULL, '2', '2', NULL, NULL, NULL, NULL, NULL, '$2y$10$0pDzH0.qAs/VB1o8yIkyWucUVRIU2.khw573fZUvZhuFa45aPHA.W', NULL, NULL, NULL, 0, '2021-06-21 21:10:30', '2022-05-11 17:10:13'),
(2, 0, 0, 1, 'mtuan23561', 'mtuan23561@gmail.com', NULL, NULL, NULL, '2', '2', NULL, NULL, NULL, NULL, NULL, '$2y$10$RgpBtj4mAWbFGL5HM7B6l.dZEcFZp8CyPbYvmwY7rCezj6lKHWNWO', NULL, NULL, NULL, 0, '2022-04-19 00:18:16', '2022-04-19 00:18:16'),
(3, 4.78, 0, 1, 'mtuan23562', 'mtuan23562@gmail.com', NULL, 'vuj8YXO5MeXStxnRUFFClLPdLeR3eC6tkKT2jAdw', NULL, '2', '2', NULL, NULL, NULL, NULL, NULL, '$2y$10$55YmjrMuiBxRKS0mRzosL.504PrklRZmdVYnN0Lb.A8WGsBROiuza', 'VIPCUJvsWQxg3FIFzxijBPz262r0Rbk2gta22VFoqxpww4QokcvMUjXN9v26', NULL, NULL, 0, '2022-04-19 00:21:01', '2022-04-28 16:21:22'),
(4, 1.934, 0, 1, 'Xuan nam', 'xuannamtruong43@gmail.com', NULL, NULL, NULL, '2', '2', NULL, NULL, NULL, NULL, NULL, '$2y$10$2awuHNSU6dwin/488Iauh.TaeIFsGh1K8fj639E8bL5xr4gkj4CM6', '1KBeEqgmUg4rawddyVYJZP0DEnxua6Bih7bLmUZSXwjqjK7RamjdYoU2LeZR', NULL, NULL, 0, '2022-04-19 02:53:23', '2022-04-26 14:20:52'),
(5, 0, 0, 1, 'dzadm', 'tesila8159@xasems.com', NULL, NULL, NULL, '2', '1', NULL, NULL, NULL, NULL, NULL, '$2y$10$wAC/1sPAyL5qTexTQD/hv.Ey3SD9Va.DWNwulsItikTECa970.hca', NULL, NULL, NULL, 0, '2022-04-19 06:08:44', '2022-05-11 15:22:07'),
(7, 0, 0, 1, 'akakkakaj', 'Kskakska@jjjss.ckdj', NULL, NULL, NULL, '2', '1', NULL, NULL, NULL, NULL, NULL, '$2y$10$JSUJ7tOxpIgdPERWmKq93OkV1hT4pGwJb.ohVttcNfNoCjbKBPK6C', NULL, NULL, NULL, 0, '2022-04-21 03:38:20', '2022-05-11 15:22:02'),
(8, 0, 0, 1, 'test', 'test@gmail.com', NULL, NULL, NULL, '2', '2', NULL, NULL, NULL, NULL, NULL, '$2y$10$FMOS0s5uAHPd4rNecS1du.3TmoHvEcdV0y7a/w6Ycw/GIWMgLywim', NULL, NULL, NULL, 0, '2022-04-24 16:27:35', '2022-04-24 16:27:35'),
(9, 0.097, 0, 1, '1kview 1', 'forwork@nguyentuannam.com', NULL, 'VaVl8gLHTMTo1xoQXGpQt9KYpcHdyr7k2Gad6AiJ', NULL, '1', '2', NULL, NULL, NULL, NULL, NULL, '$2y$10$7nHTsXm1nf72uncHa.Jzze5fWUYFXREw6kA9OqjI6bS9q1yt6H2Sa', '1C8NLH6uxufBHfZHyZCwigE0WRBky87dF1GNEBqsOMuaw8YkqslT97v78S2T', NULL, NULL, 0, '2022-04-27 20:47:17', '2022-05-11 17:03:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_prices`
--

CREATE TABLE `user_prices` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `service_id` int NOT NULL,
  `service_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Đang đổ dữ liệu cho bảng `user_prices`
--

INSERT INTO `user_prices` (`id`, `user_id`, `service_id`, `service_price`) VALUES
(1, 5, 992, 76),
(2, 3, 1, 0.88),
(3, 9, 17, 22.79),
(4, 9, 21, 2.4),
(5, 8, 21, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin_menus`
--
ALTER TABLE `admin_menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cash_flows`
--
ALTER TABLE `cash_flows`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_forget_pass_otp`
--
ALTER TABLE `customer_forget_pass_otp`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `email_jobs`
--
ALTER TABLE `email_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `message_telegrams`
--
ALTER TABLE `message_telegrams`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `api_orderid` (`api_orderid`),
  ADD KEY `order_api` (`order_api`),
  ADD KEY `api_serviceid` (`api_serviceid`);

--
-- Chỉ mục cho bảng `orderss`
--
ALTER TABLE `orderss`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `servicess`
--
ALTER TABLE `servicess`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `service_api`
--
ALTER TABLE `service_api`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user_prices`
--
ALTER TABLE `user_prices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56790;

--
-- AUTO_INCREMENT cho bảng `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `cash_flows`
--
ALTER TABLE `cash_flows`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `configs`
--
ALTER TABLE `configs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customer_forget_pass_otp`
--
ALTER TABLE `customer_forget_pass_otp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `email_jobs`
--
ALTER TABLE `email_jobs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `message_telegrams`
--
ALTER TABLE `message_telegrams`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `orderss`
--
ALTER TABLE `orderss`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `providers`
--
ALTER TABLE `providers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT cho bảng `servicess`
--
ALTER TABLE `servicess`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=638;

--
-- AUTO_INCREMENT cho bảng `service_api`
--
ALTER TABLE `service_api`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `user_prices`
--
ALTER TABLE `user_prices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
