-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: mysql
-- Thời gian đã tạo: Th6 28, 2021 lúc 09:26 AM
-- Phiên bản máy phục vụ: 5.7.32
-- Phiên bản PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mualike`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `actions`
--

CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `id_social` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `admin_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `email`, `name`, `password`, `admin_level`, `created_at`, `updated_at`) VALUES
(56789, 'test@gmail.com', 'Admin', '$2y$10$/42vjOehSFF3rn2HGdB6XeuSK.BpdihJf2Rsp70Sw8dlL3Dj57G.m', 99999, '2020-07-17 01:58:46', '2020-07-17 01:58:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menus`
--

CREATE TABLE `admin_menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin_menu_items`
--

CREATE TABLE `admin_menu_items` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sort` int(11) NOT NULL DEFAULT '0',
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu` int(10) UNSIGNED NOT NULL,
  `depth` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rel` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'dofollow',
  `target` varchar(10) COLLATE utf8_unicode_ci DEFAULT '_self'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_forget_pass_otp`
--

CREATE TABLE `customer_forget_pass_otp` (
  `id` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `otp_mail` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `email_jobs`
--

CREATE TABLE `email_jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message_telegrams`
--

CREATE TABLE `message_telegrams` (
  `id` int(10) UNSIGNED NOT NULL,
  `brand_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
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
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `reaction_id` int(11) NOT NULL,
  `reaction` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_link` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `fanpage_id` int(11) NOT NULL,
  `guarantee` double NOT NULL DEFAULT '0',
  `number_seeding` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `coin` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `number_done` int(11) NOT NULL,
  `number_rest` int(11) NOT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `comments` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `name_setting` varchar(2000) DEFAULT NULL,
  `value_setting` mediumtext,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `setting`
--

INSERT INTO `setting` (`id`, `name_setting`, `value_setting`, `created`, `updated`, `status`) VALUES
(308, 'e-bike', 'a:20:{i:0;a:2:{s:7:\"fanpage\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:7:\"fanpage\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";s:7:\"fanpage\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";}}i:1;a:2:{s:8:\"facebook\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:8:\"facebook\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";s:8:\"facebook\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";}}i:2;a:2:{s:7:\"youtube\";s:32:\"aHR0cHM6Ly93d3cueW91dHViZS5jb20=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:7:\"youtube\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:32:\"aHR0cHM6Ly93d3cueW91dHViZS5jb20=\";s:7:\"youtube\";s:32:\"aHR0cHM6Ly93d3cueW91dHViZS5jb20=\";}}i:3;a:2:{s:9:\"instagram\";s:36:\"aHR0cHM6Ly93d3cuaW5zdGFncmFtLmNvbQ==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:9:\"instagram\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:36:\"aHR0cHM6Ly93d3cuaW5zdGFncmFtLmNvbQ==\";s:9:\"instagram\";s:36:\"aHR0cHM6Ly93d3cuaW5zdGFncmFtLmNvbQ==\";}}i:4;a:2:{s:3:\"lat\";s:16:\"MTguNjkxMjkzNg==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:3:\"lat\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:16:\"MTguNjkxMjkzNg==\";s:3:\"lat\";s:16:\"MTguNjkxMjkzNg==\";}}i:5;a:2:{s:4:\"long\";s:16:\"MTA1LjY4MDY4MzY=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:4:\"long\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:16:\"MTA1LjY4MDY4MzY=\";s:4:\"long\";s:16:\"MTA1LjY4MDY4MzY=\";}}i:6;a:2:{s:10:\"emailadmin\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:10:\"emailadmin\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:10:\"emailadmin\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";}}i:7;a:2:{s:7:\"toemail\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:7:\"toemail\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:7:\"toemail\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";}}i:8;a:2:{s:11:\"title-email\";s:28:\"TGnDqm4gaOG7hyBNdWEgTGlrZQ==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:11:\"title-email\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:28:\"TGnDqm4gaOG7hyBNdWEgTGlrZQ==\";s:11:\"title-email\";s:28:\"TGnDqm4gaOG7hyBNdWEgTGlrZQ==\";}}i:9;a:2:{s:10:\"note-email\";s:140:\"Q+G6o20gxqFuIGLhuqFuIMSRw6MgbGnDqm4gaOG7hyDEkeG6v24gY2jDum5nIHTDtGkuIENow7puZyB0w7RpIHPhur0gbGnDqm4gbOG6oWMgbOG6oWkgduG7m2kgYuG6oW4gc2F1IQ==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:10:\"note-email\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:140:\"Q+G6o20gxqFuIGLhuqFuIMSRw6MgbGnDqm4gaOG7hyDEkeG6v24gY2jDum5nIHTDtGkuIENow7puZyB0w7RpIHPhur0gbGnDqm4gbOG6oWMgbOG6oWkgduG7m2kgYuG6oW4gc2F1IQ==\";s:10:\"note-email\";s:140:\"Q+G6o20gxqFuIGLhuqFuIMSRw6MgbGnDqm4gaOG7hyDEkeG6v24gY2jDum5nIHTDtGkuIENow7puZyB0w7RpIHPhur0gbGnDqm4gbOG6oWMgbOG6oWkgduG7m2kgYuG6oW4gc2F1IQ==\";}}i:10;a:2:{s:10:\"name-admin\";s:12:\"TXVhIExpa2U=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:10:\"name-admin\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:12:\"TXVhIExpa2U=\";s:10:\"name-admin\";s:12:\"TXVhIExpa2U=\";}}i:11;a:2:{s:7:\"addrees\";s:32:\"aHR0cHM6Ly9zaG9wdGhlbWUuY29tLnZu\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:7:\"addrees\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:32:\"aHR0cHM6Ly9zaG9wdGhlbWUuY29tLnZu\";s:7:\"addrees\";s:32:\"aHR0cHM6Ly9zaG9wdGhlbWUuY29tLnZu\";}}i:12;a:2:{s:12:\"name-company\";s:16:\"U2hvcCBUaGVtZQ==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:12:\"name-company\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:16:\"U2hvcCBUaGVtZQ==\";s:12:\"name-company\";s:16:\"U2hvcCBUaGVtZQ==\";}}i:13;a:2:{s:5:\"email\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:5:\"email\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";s:5:\"email\";s:24:\"bXVhbGlrZUBnbWFpbC5jb20=\";}}i:14;a:2:{s:11:\"url-sitemap\";s:52:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0L3NpdGVtYXAtaW5kZXgv\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:11:\"url-sitemap\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:52:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0L3NpdGVtYXAtaW5kZXgv\";s:11:\"url-sitemap\";s:52:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0L3NpdGVtYXAtaW5kZXgv\";}}i:15;a:2:{s:8:\"url-home\";s:36:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0Lw==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:8:\"url-home\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:36:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0Lw==\";s:8:\"url-home\";s:36:\"aHR0cHM6Ly93d3cubXVhbGlrZS50ZXN0Lw==\";}}i:16;a:2:{s:9:\"m-fanpage\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:9:\"m-fanpage\";s:10:\"tdr_choise\";s:4:\"line\";s:9:\"tdr_value\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";s:9:\"m-fanpage\";s:56:\"aHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL2dyb3Vwcy9tdWFsaWtlLw==\";}}i:17;a:2:{s:13:\"seo-title-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:13:\"seo-title-add\";s:10:\"tdr_choise\";s:9:\"muti_line\";s:9:\"tdr_value\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:13:\"seo-title-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";}}i:18;a:2:{s:16:\"seo-keywords-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:16:\"seo-keywords-add\";s:10:\"tdr_choise\";s:9:\"muti_line\";s:9:\"tdr_value\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:16:\"seo-keywords-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";}}i:19;a:2:{s:19:\"seo-description-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:9:\"group_tdr\";a:4:{s:8:\"tdr_name\";s:19:\"seo-description-add\";s:10:\"tdr_choise\";s:9:\"muti_line\";s:9:\"tdr_value\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";s:19:\"seo-description-add\";s:44:\"TXVhIExpa2UgbXVhIGLDoW4gbGlrZSBnacOhIHLhurs=\";}}}', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `socials`
--

CREATE TABLE `socials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_promotion` int(11) NOT NULL,
  `coin_purchase` text COLLATE utf8_unicode_ci,
  `transaction_time` datetime NOT NULL,
  `type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trash` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coin` int(11) DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `about_me` text CHARACTER SET utf8,
  `provider_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `provider` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `phone` varchar(11) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `coin`, `level`, `name`, `email`, `email_verified_at`, `about_me`, `provider_id`, `provider`, `birthday`, `phone`, `password`, `remember_token`, `address`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Minh', 'mtuan2356@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$TLavkU14gjlRKUODr03NQuL6XTvWJv8KhrntDkDKmrtnw7UUT6esS', NULL, NULL, NULL, 0, '2021-06-21 21:10:30', '2021-06-21 21:10:30');

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
-- Chỉ mục cho bảng `setting`
--
ALTER TABLE `setting`
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
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56790;

--
-- AUTO_INCREMENT cho bảng `admin_menus`
--
ALTER TABLE `admin_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `admin_menu_items`
--
ALTER TABLE `admin_menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `customer_forget_pass_otp`
--
ALTER TABLE `customer_forget_pass_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `email_jobs`
--
ALTER TABLE `email_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `message_telegrams`
--
ALTER TABLE `message_telegrams`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;

--
-- AUTO_INCREMENT cho bảng `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
