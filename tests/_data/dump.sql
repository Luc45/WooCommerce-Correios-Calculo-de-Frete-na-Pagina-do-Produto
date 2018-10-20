-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 20, 2018 at 09:00 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cfpp`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_commentmeta`
--

CREATE TABLE `wp_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_comments`
--

CREATE TABLE `wp_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_comments`
--

INSERT INTO `wp_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2018-09-23 12:27:57', '2018-09-23 12:27:57', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_links`
--

CREATE TABLE `wp_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `link_rating` int(11) NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_options`
--

CREATE TABLE `wp_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_options`
--

INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'http://cfpp.localhost', 'yes'),
(2, 'home', 'http://cfpp.localhost', 'yes'),
(3, 'blogname', 'cfpp', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'lucas.b@onthegosystems.com', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/index.php/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:158:{s:24:\"^wc-auth/v([1]{1})/(.*)?\";s:63:\"index.php?wc-auth-version=$matches[1]&wc-auth-route=$matches[2]\";s:22:\"^wc-api/v([1-3]{1})/?$\";s:51:\"index.php?wc-api-version=$matches[1]&wc-api-route=/\";s:24:\"^wc-api/v([1-3]{1})(.*)?\";s:61:\"index.php?wc-api-version=$matches[1]&wc-api-route=$matches[2]\";s:17:\"index.php/shop/?$\";s:27:\"index.php?post_type=product\";s:47:\"index.php/shop/feed/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:42:\"index.php/shop/(feed|rdf|rss|rss2|atom)/?$\";s:44:\"index.php?post_type=product&feed=$matches[1]\";s:34:\"index.php/shop/page/([0-9]{1,})/?$\";s:45:\"index.php?post_type=product&paged=$matches[1]\";s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:57:\"index.php/category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:52:\"index.php/category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:52:\"index.php?category_name=$matches[1]&feed=$matches[2]\";s:33:\"index.php/category/(.+?)/embed/?$\";s:46:\"index.php?category_name=$matches[1]&embed=true\";s:45:\"index.php/category/(.+?)/page/?([0-9]{1,})/?$\";s:53:\"index.php?category_name=$matches[1]&paged=$matches[2]\";s:42:\"index.php/category/(.+?)/wc-api(/(.*))?/?$\";s:54:\"index.php?category_name=$matches[1]&wc-api=$matches[3]\";s:27:\"index.php/category/(.+?)/?$\";s:35:\"index.php?category_name=$matches[1]\";s:54:\"index.php/tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:49:\"index.php/tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?tag=$matches[1]&feed=$matches[2]\";s:30:\"index.php/tag/([^/]+)/embed/?$\";s:36:\"index.php?tag=$matches[1]&embed=true\";s:42:\"index.php/tag/([^/]+)/page/?([0-9]{1,})/?$\";s:43:\"index.php?tag=$matches[1]&paged=$matches[2]\";s:39:\"index.php/tag/([^/]+)/wc-api(/(.*))?/?$\";s:44:\"index.php?tag=$matches[1]&wc-api=$matches[3]\";s:24:\"index.php/tag/([^/]+)/?$\";s:25:\"index.php?tag=$matches[1]\";s:55:\"index.php/type/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:50:\"index.php/type/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?post_format=$matches[1]&feed=$matches[2]\";s:31:\"index.php/type/([^/]+)/embed/?$\";s:44:\"index.php?post_format=$matches[1]&embed=true\";s:43:\"index.php/type/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?post_format=$matches[1]&paged=$matches[2]\";s:25:\"index.php/type/([^/]+)/?$\";s:33:\"index.php?post_format=$matches[1]\";s:65:\"index.php/product-category/(.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:60:\"index.php/product-category/(.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_cat=$matches[1]&feed=$matches[2]\";s:41:\"index.php/product-category/(.+?)/embed/?$\";s:44:\"index.php?product_cat=$matches[1]&embed=true\";s:53:\"index.php/product-category/(.+?)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_cat=$matches[1]&paged=$matches[2]\";s:35:\"index.php/product-category/(.+?)/?$\";s:33:\"index.php?product_cat=$matches[1]\";s:62:\"index.php/product-tag/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:57:\"index.php/product-tag/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?product_tag=$matches[1]&feed=$matches[2]\";s:38:\"index.php/product-tag/([^/]+)/embed/?$\";s:44:\"index.php?product_tag=$matches[1]&embed=true\";s:50:\"index.php/product-tag/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?product_tag=$matches[1]&paged=$matches[2]\";s:32:\"index.php/product-tag/([^/]+)/?$\";s:33:\"index.php?product_tag=$matches[1]\";s:45:\"index.php/product/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:55:\"index.php/product/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:75:\"index.php/product/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:70:\"index.php/product/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:70:\"index.php/product/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:51:\"index.php/product/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:34:\"index.php/product/([^/]+)/embed/?$\";s:40:\"index.php?product=$matches[1]&embed=true\";s:38:\"index.php/product/([^/]+)/trackback/?$\";s:34:\"index.php?product=$matches[1]&tb=1\";s:58:\"index.php/product/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:53:\"index.php/product/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:46:\"index.php?product=$matches[1]&feed=$matches[2]\";s:46:\"index.php/product/([^/]+)/page/?([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&paged=$matches[2]\";s:53:\"index.php/product/([^/]+)/comment-page-([0-9]{1,})/?$\";s:47:\"index.php?product=$matches[1]&cpage=$matches[2]\";s:43:\"index.php/product/([^/]+)/wc-api(/(.*))?/?$\";s:48:\"index.php?product=$matches[1]&wc-api=$matches[3]\";s:49:\"index.php/product/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:60:\"index.php/product/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:42:\"index.php/product/([^/]+)(?:/([0-9]+))?/?$\";s:46:\"index.php?product=$matches[1]&page=$matches[2]\";s:34:\"index.php/product/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:44:\"index.php/product/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:64:\"index.php/product/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:59:\"index.php/product/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:59:\"index.php/product/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:40:\"index.php/product/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:12:\"robots\\.txt$\";s:18:\"index.php?robots=1\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:42:\"index.php/feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:37:\"index.php/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:18:\"index.php/embed/?$\";s:21:\"index.php?&embed=true\";s:30:\"index.php/page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:37:\"index.php/comment-page-([0-9]{1,})/?$\";s:39:\"index.php?&page_id=25&cpage=$matches[1]\";s:27:\"index.php/wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:51:\"index.php/comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:46:\"index.php/comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:27:\"index.php/comments/embed/?$\";s:21:\"index.php?&embed=true\";s:36:\"index.php/comments/wc-api(/(.*))?/?$\";s:29:\"index.php?&wc-api=$matches[2]\";s:54:\"index.php/search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:49:\"index.php/search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:30:\"index.php/search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:42:\"index.php/search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:39:\"index.php/search/(.+)/wc-api(/(.*))?/?$\";s:42:\"index.php?s=$matches[1]&wc-api=$matches[3]\";s:24:\"index.php/search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:57:\"index.php/author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:52:\"index.php/author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:33:\"index.php/author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:45:\"index.php/author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:42:\"index.php/author/([^/]+)/wc-api(/(.*))?/?$\";s:52:\"index.php?author_name=$matches[1]&wc-api=$matches[3]\";s:27:\"index.php/author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:79:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:74:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:55:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:67:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:64:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:82:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&wc-api=$matches[5]\";s:49:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:66:\"index.php/([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:61:\"index.php/([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:42:\"index.php/([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:54:\"index.php/([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:51:\"index.php/([0-9]{4})/([0-9]{1,2})/wc-api(/(.*))?/?$\";s:66:\"index.php?year=$matches[1]&monthnum=$matches[2]&wc-api=$matches[4]\";s:36:\"index.php/([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:53:\"index.php/([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:48:\"index.php/([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:29:\"index.php/([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:41:\"index.php/([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:38:\"index.php/([0-9]{4})/wc-api(/(.*))?/?$\";s:45:\"index.php?year=$matches[1]&wc-api=$matches[3]\";s:23:\"index.php/([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:68:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:78:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:98:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:93:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:93:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:74:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:63:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$\";s:91:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true\";s:67:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$\";s:85:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1\";s:87:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:82:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:75:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]\";s:82:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]\";s:72:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/wc-api(/(.*))?/?$\";s:99:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&wc-api=$matches[6]\";s:72:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:83:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:71:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]\";s:57:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:67:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:87:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:82:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:82:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:63:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:74:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:61:\"index.php/([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:48:\"index.php/([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:37:\"index.php/.?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:47:\"index.php/.?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:67:\"index.php/.?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"index.php/.?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"index.php/.?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:43:\"index.php/.?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:26:\"index.php/(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:30:\"index.php/(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:50:\"index.php/(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:45:\"index.php/(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:38:\"index.php/(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:45:\"index.php/(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:35:\"index.php/(.?.+?)/wc-api(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&wc-api=$matches[3]\";s:38:\"index.php/(.?.+?)/order-pay(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&order-pay=$matches[3]\";s:43:\"index.php/(.?.+?)/order-received(/(.*))?/?$\";s:57:\"index.php?pagename=$matches[1]&order-received=$matches[3]\";s:35:\"index.php/(.?.+?)/orders(/(.*))?/?$\";s:49:\"index.php?pagename=$matches[1]&orders=$matches[3]\";s:39:\"index.php/(.?.+?)/view-order(/(.*))?/?$\";s:53:\"index.php?pagename=$matches[1]&view-order=$matches[3]\";s:38:\"index.php/(.?.+?)/downloads(/(.*))?/?$\";s:52:\"index.php?pagename=$matches[1]&downloads=$matches[3]\";s:41:\"index.php/(.?.+?)/edit-account(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-account=$matches[3]\";s:41:\"index.php/(.?.+?)/edit-address(/(.*))?/?$\";s:55:\"index.php?pagename=$matches[1]&edit-address=$matches[3]\";s:44:\"index.php/(.?.+?)/payment-methods(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&payment-methods=$matches[3]\";s:42:\"index.php/(.?.+?)/lost-password(/(.*))?/?$\";s:56:\"index.php?pagename=$matches[1]&lost-password=$matches[3]\";s:44:\"index.php/(.?.+?)/customer-logout(/(.*))?/?$\";s:58:\"index.php?pagename=$matches[1]&customer-logout=$matches[3]\";s:47:\"index.php/(.?.+?)/add-payment-method(/(.*))?/?$\";s:61:\"index.php?pagename=$matches[1]&add-payment-method=$matches[3]\";s:50:\"index.php/(.?.+?)/delete-payment-method(/(.*))?/?$\";s:64:\"index.php?pagename=$matches[1]&delete-payment-method=$matches[3]\";s:55:\"index.php/(.?.+?)/set-default-payment-method(/(.*))?/?$\";s:69:\"index.php?pagename=$matches[1]&set-default-payment-method=$matches[3]\";s:41:\"index.php/.?.+?/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:52:\"index.php/.?.+?/attachment/([^/]+)/wc-api(/(.*))?/?$\";s:51:\"index.php?attachment=$matches[1]&wc-api=$matches[3]\";s:34:\"index.php/(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:4:{i:0;s:31:\"query-monitor/query-monitor.php\";i:1;s:105:\"woo-correios-calculo-de-frete-na-pagina-do-produto/woo-correios-calculo-de-frete-na-pagina-do-produto.php\";i:2;s:45:\"woocommerce-correios/woocommerce-correios.php\";i:3;s:27:\"woocommerce/woocommerce.php\";}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'storefront', 'yes'),
(41, 'stylesheet', 'storefront', 'yes'),
(42, 'comment_whitelist', '1', 'yes'),
(43, 'blacklist_keys', '', 'no'),
(44, 'comment_registration', '0', 'yes'),
(45, 'html_type', 'text/html', 'yes'),
(46, 'use_trackback', '0', 'yes'),
(47, 'default_role', 'subscriber', 'yes'),
(48, 'db_version', '38590', 'yes'),
(49, 'uploads_use_yearmonth_folders', '1', 'yes'),
(50, 'upload_path', '', 'yes'),
(51, 'blog_public', '1', 'yes'),
(52, 'default_link_category', '2', 'yes'),
(53, 'show_on_front', 'page', 'yes'),
(54, 'tag_base', '', 'yes'),
(55, 'show_avatars', '1', 'yes'),
(56, 'avatar_rating', 'G', 'yes'),
(57, 'upload_url_path', '', 'yes'),
(58, 'thumbnail_size_w', '150', 'yes'),
(59, 'thumbnail_size_h', '150', 'yes'),
(60, 'thumbnail_crop', '1', 'yes'),
(61, 'medium_size_w', '300', 'yes'),
(62, 'medium_size_h', '300', 'yes'),
(63, 'avatar_default', 'mystery', 'yes'),
(64, 'large_size_w', '1024', 'yes'),
(65, 'large_size_h', '1024', 'yes'),
(66, 'image_default_link_type', 'none', 'yes'),
(67, 'image_default_size', '', 'yes'),
(68, 'image_default_align', '', 'yes'),
(69, 'close_comments_for_old_posts', '0', 'yes'),
(70, 'close_comments_days_old', '14', 'yes'),
(71, 'thread_comments', '1', 'yes'),
(72, 'thread_comments_depth', '5', 'yes'),
(73, 'page_comments', '0', 'yes'),
(74, 'comments_per_page', '50', 'yes'),
(75, 'default_comments_page', 'newest', 'yes'),
(76, 'comment_order', 'asc', 'yes'),
(77, 'sticky_posts', 'a:0:{}', 'yes'),
(78, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(79, 'widget_text', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(80, 'widget_rss', 'a:2:{i:1;a:0:{}s:12:\"_multiwidget\";i:1;}', 'yes'),
(81, 'uninstall_plugins', 'a:0:{}', 'no'),
(82, 'timezone_string', '', 'yes'),
(83, 'page_for_posts', '26', 'yes'),
(84, 'page_on_front', '25', 'yes'),
(85, 'default_post_format', '0', 'yes'),
(86, 'link_manager_enabled', '0', 'yes'),
(87, 'finished_splitting_shared_terms', '1', 'yes'),
(88, 'site_icon', '0', 'yes'),
(89, 'medium_large_size_w', '768', 'yes'),
(90, 'medium_large_size_h', '0', 'yes'),
(91, 'wp_page_for_privacy_policy', '3', 'yes'),
(92, 'show_comments_cookies_opt_in', '0', 'yes'),
(93, 'initial_db_version', '38590', 'yes'),
(94, 'wp_user_roles', 'a:7:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:114:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}s:8:\"customer\";a:2:{s:4:\"name\";s:8:\"Customer\";s:12:\"capabilities\";a:1:{s:4:\"read\";b:1;}}s:12:\"shop_manager\";a:2:{s:4:\"name\";s:12:\"Shop manager\";s:12:\"capabilities\";a:92:{s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:4:\"read\";b:1;s:18:\"read_private_pages\";b:1;s:18:\"read_private_posts\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_posts\";b:1;s:10:\"edit_pages\";b:1;s:20:\"edit_published_posts\";b:1;s:20:\"edit_published_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"edit_private_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:17:\"edit_others_pages\";b:1;s:13:\"publish_posts\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_posts\";b:1;s:12:\"delete_pages\";b:1;s:20:\"delete_private_pages\";b:1;s:20:\"delete_private_posts\";b:1;s:22:\"delete_published_pages\";b:1;s:22:\"delete_published_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:19:\"delete_others_pages\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:17:\"moderate_comments\";b:1;s:12:\"upload_files\";b:1;s:6:\"export\";b:1;s:6:\"import\";b:1;s:10:\"list_users\";b:1;s:18:\"manage_woocommerce\";b:1;s:24:\"view_woocommerce_reports\";b:1;s:12:\"edit_product\";b:1;s:12:\"read_product\";b:1;s:14:\"delete_product\";b:1;s:13:\"edit_products\";b:1;s:20:\"edit_others_products\";b:1;s:16:\"publish_products\";b:1;s:21:\"read_private_products\";b:1;s:15:\"delete_products\";b:1;s:23:\"delete_private_products\";b:1;s:25:\"delete_published_products\";b:1;s:22:\"delete_others_products\";b:1;s:21:\"edit_private_products\";b:1;s:23:\"edit_published_products\";b:1;s:20:\"manage_product_terms\";b:1;s:18:\"edit_product_terms\";b:1;s:20:\"delete_product_terms\";b:1;s:20:\"assign_product_terms\";b:1;s:15:\"edit_shop_order\";b:1;s:15:\"read_shop_order\";b:1;s:17:\"delete_shop_order\";b:1;s:16:\"edit_shop_orders\";b:1;s:23:\"edit_others_shop_orders\";b:1;s:19:\"publish_shop_orders\";b:1;s:24:\"read_private_shop_orders\";b:1;s:18:\"delete_shop_orders\";b:1;s:26:\"delete_private_shop_orders\";b:1;s:28:\"delete_published_shop_orders\";b:1;s:25:\"delete_others_shop_orders\";b:1;s:24:\"edit_private_shop_orders\";b:1;s:26:\"edit_published_shop_orders\";b:1;s:23:\"manage_shop_order_terms\";b:1;s:21:\"edit_shop_order_terms\";b:1;s:23:\"delete_shop_order_terms\";b:1;s:23:\"assign_shop_order_terms\";b:1;s:16:\"edit_shop_coupon\";b:1;s:16:\"read_shop_coupon\";b:1;s:18:\"delete_shop_coupon\";b:1;s:17:\"edit_shop_coupons\";b:1;s:24:\"edit_others_shop_coupons\";b:1;s:20:\"publish_shop_coupons\";b:1;s:25:\"read_private_shop_coupons\";b:1;s:19:\"delete_shop_coupons\";b:1;s:27:\"delete_private_shop_coupons\";b:1;s:29:\"delete_published_shop_coupons\";b:1;s:26:\"delete_others_shop_coupons\";b:1;s:25:\"edit_private_shop_coupons\";b:1;s:27:\"edit_published_shop_coupons\";b:1;s:24:\"manage_shop_coupon_terms\";b:1;s:22:\"edit_shop_coupon_terms\";b:1;s:24:\"delete_shop_coupon_terms\";b:1;s:24:\"assign_shop_coupon_terms\";b:1;}}}', 'yes'),
(95, 'fresh_site', '0', 'yes'),
(96, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(97, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(98, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'sidebars_widgets', 'a:8:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:8:\"header-1\";a:0:{}s:8:\"footer-1\";a:0:{}s:8:\"footer-2\";a:0:{}s:8:\"footer-3\";a:0:{}s:8:\"footer-4\";a:0:{}s:13:\"array_version\";i:3;}', 'yes'),
(102, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(104, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(105, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'cron', 'a:13:{i:1540070885;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1540072581;a:1:{s:32:\"woocommerce_cancel_unpaid_orders\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:2:{s:8:\"schedule\";b:0;s:4:\"args\";a:0:{}}}}i:1540080000;a:1:{s:27:\"woocommerce_scheduled_sales\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1540080286;a:1:{s:33:\"woocommerce_cleanup_personal_data\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1540080298;a:1:{s:30:\"woocommerce_tracker_send_event\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1540081685;a:2:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1540081686;a:1:{s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1540091087;a:1:{s:24:\"woocommerce_cleanup_logs\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1540101888;a:1:{s:28:\"woocommerce_cleanup_sessions\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1540125185;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1540147669;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1541073600;a:1:{s:25:\"woocommerce_geoip_updater\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:7:\"monthly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:2635200;}}}s:7:\"version\";i:2;}', 'yes'),
(112, 'theme_mods_twentyseventeen', 'a:2:{s:18:\"custom_css_post_id\";i:-1;s:16:\"sidebars_widgets\";a:2:{s:4:\"time\";i:1537706517;s:4:\"data\";a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:6:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";i:3;s:10:\"archives-2\";i:4;s:12:\"categories-2\";i:5;s:6:\"meta-2\";}s:9:\"sidebar-2\";a:0:{}s:9:\"sidebar-3\";a:0:{}}}}', 'yes'),
(116, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:1:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:6:\"latest\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.9.8.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-4.9.8.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-4.9.8-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-4.9.8-new-bundled.zip\";s:7:\"partial\";b:0;s:8:\"rollback\";b:0;}s:7:\"current\";s:5:\"4.9.8\";s:7:\"version\";s:5:\"4.9.8\";s:11:\"php_version\";s:5:\"5.2.4\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"4.7\";s:15:\"partial_version\";s:0:\"\";}}s:12:\"last_checked\";i:1540063076;s:15:\"version_checked\";s:5:\"4.9.8\";s:12:\"translations\";a:0:{}}', 'no'),
(127, 'can_compress_scripts', '0', 'no'),
(147, 'woocommerce_store_address', 'Rua Sagitário', 'yes'),
(148, 'woocommerce_store_address_2', '427', 'yes'),
(149, 'woocommerce_store_city', 'Belo Horizonte', 'yes'),
(150, 'woocommerce_default_country', 'BR:MG', 'yes'),
(151, 'woocommerce_store_postcode', '30360230', 'yes'),
(152, 'woocommerce_allowed_countries', 'all', 'yes'),
(153, 'woocommerce_all_except_countries', '', 'yes'),
(154, 'woocommerce_specific_allowed_countries', '', 'yes'),
(155, 'woocommerce_ship_to_countries', '', 'yes'),
(156, 'woocommerce_specific_ship_to_countries', '', 'yes'),
(157, 'woocommerce_default_customer_address', 'geolocation', 'yes'),
(158, 'woocommerce_calc_taxes', 'no', 'yes'),
(159, 'woocommerce_enable_coupons', 'yes', 'yes'),
(160, 'woocommerce_calc_discounts_sequentially', 'no', 'no'),
(161, 'woocommerce_currency', 'BRL', 'yes'),
(162, 'woocommerce_currency_pos', 'left', 'yes'),
(163, 'woocommerce_price_thousand_sep', '.', 'yes'),
(164, 'woocommerce_price_decimal_sep', ',', 'yes'),
(165, 'woocommerce_price_num_decimals', '2', 'yes'),
(166, 'woocommerce_shop_page_id', '5', 'yes'),
(167, 'woocommerce_cart_redirect_after_add', 'no', 'yes'),
(168, 'woocommerce_enable_ajax_add_to_cart', 'yes', 'yes'),
(169, 'woocommerce_weight_unit', 'kg', 'yes'),
(170, 'woocommerce_dimension_unit', 'cm', 'yes'),
(171, 'woocommerce_enable_reviews', 'yes', 'yes'),
(172, 'woocommerce_review_rating_verification_label', 'yes', 'no'),
(173, 'woocommerce_review_rating_verification_required', 'no', 'no'),
(174, 'woocommerce_enable_review_rating', 'yes', 'yes'),
(175, 'woocommerce_review_rating_required', 'yes', 'no'),
(176, 'woocommerce_manage_stock', 'yes', 'yes'),
(177, 'woocommerce_hold_stock_minutes', '60', 'no'),
(178, 'woocommerce_notify_low_stock', 'yes', 'no'),
(179, 'woocommerce_notify_no_stock', 'yes', 'no'),
(180, 'woocommerce_stock_email_recipient', 'lucas.b@onthegosystems.com', 'no'),
(181, 'woocommerce_notify_low_stock_amount', '2', 'no'),
(182, 'woocommerce_notify_no_stock_amount', '0', 'yes'),
(183, 'woocommerce_hide_out_of_stock_items', 'no', 'yes'),
(184, 'woocommerce_stock_format', '', 'yes'),
(185, 'woocommerce_file_download_method', 'force', 'no'),
(186, 'woocommerce_downloads_require_login', 'no', 'no'),
(187, 'woocommerce_downloads_grant_access_after_payment', 'yes', 'no'),
(188, 'woocommerce_prices_include_tax', 'no', 'yes'),
(189, 'woocommerce_tax_based_on', 'shipping', 'yes'),
(190, 'woocommerce_shipping_tax_class', 'inherit', 'yes'),
(191, 'woocommerce_tax_round_at_subtotal', 'no', 'yes'),
(192, 'woocommerce_tax_classes', 'Reduced rate\nZero rate', 'yes'),
(193, 'woocommerce_tax_display_shop', 'excl', 'yes'),
(194, 'woocommerce_tax_display_cart', 'excl', 'yes'),
(195, 'woocommerce_price_display_suffix', '', 'yes'),
(196, 'woocommerce_tax_total_display', 'itemized', 'no'),
(197, 'woocommerce_enable_shipping_calc', 'yes', 'no'),
(198, 'woocommerce_shipping_cost_requires_address', 'no', 'yes'),
(199, 'woocommerce_ship_to_destination', 'billing', 'no'),
(200, 'woocommerce_shipping_debug_mode', 'no', 'yes'),
(201, 'woocommerce_enable_guest_checkout', 'yes', 'no'),
(202, 'woocommerce_enable_checkout_login_reminder', 'no', 'no'),
(203, 'woocommerce_enable_signup_and_login_from_checkout', 'no', 'no'),
(204, 'woocommerce_enable_myaccount_registration', 'no', 'no'),
(205, 'woocommerce_registration_generate_username', 'yes', 'no'),
(206, 'woocommerce_registration_generate_password', 'yes', 'no'),
(207, 'woocommerce_erasure_request_removes_order_data', 'no', 'no'),
(208, 'woocommerce_erasure_request_removes_download_data', 'no', 'no'),
(209, 'recently_activated', 'a:0:{}', 'yes'),
(210, 'woocommerce_registration_privacy_policy_text', 'Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our [privacy_policy].', 'yes'),
(212, 'woocommerce_checkout_privacy_policy_text', 'Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our [privacy_policy].', 'yes'),
(214, 'woocommerce_delete_inactive_accounts', 'a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}', 'no'),
(215, 'woocommerce_trash_pending_orders', '', 'no'),
(216, 'woocommerce_trash_failed_orders', '', 'no'),
(217, 'woocommerce_trash_cancelled_orders', '', 'no'),
(218, 'woocommerce_anonymize_completed_orders', 'a:2:{s:6:\"number\";s:0:\"\";s:4:\"unit\";s:6:\"months\";}', 'no'),
(219, 'woocommerce_email_from_name', 'cfpp', 'no'),
(220, 'woocommerce_email_from_address', 'lucas.b@onthegosystems.com', 'no'),
(221, 'woocommerce_email_header_image', '', 'no'),
(222, 'woocommerce_email_footer_text', '{site_title}', 'no'),
(223, 'woocommerce_email_base_color', '#96588a', 'no'),
(224, 'woocommerce_email_background_color', '#f7f7f7', 'no'),
(225, 'woocommerce_email_body_background_color', '#ffffff', 'no'),
(226, 'woocommerce_email_text_color', '#3c3c3c', 'no'),
(227, 'woocommerce_cart_page_id', '6', 'yes'),
(228, 'woocommerce_checkout_page_id', '7', 'yes'),
(229, 'woocommerce_myaccount_page_id', '8', 'yes'),
(230, 'woocommerce_terms_page_id', '', 'no'),
(231, 'woocommerce_force_ssl_checkout', 'no', 'yes'),
(232, 'woocommerce_unforce_ssl_checkout', 'no', 'yes'),
(233, 'woocommerce_checkout_pay_endpoint', 'order-pay', 'yes'),
(234, 'woocommerce_checkout_order_received_endpoint', 'order-received', 'yes'),
(235, 'woocommerce_myaccount_add_payment_method_endpoint', 'add-payment-method', 'yes'),
(236, 'woocommerce_myaccount_delete_payment_method_endpoint', 'delete-payment-method', 'yes'),
(237, 'woocommerce_myaccount_set_default_payment_method_endpoint', 'set-default-payment-method', 'yes'),
(238, 'woocommerce_myaccount_orders_endpoint', 'orders', 'yes'),
(239, 'woocommerce_myaccount_view_order_endpoint', 'view-order', 'yes'),
(240, 'woocommerce_myaccount_downloads_endpoint', 'downloads', 'yes'),
(241, 'woocommerce_myaccount_edit_account_endpoint', 'edit-account', 'yes'),
(242, 'woocommerce_myaccount_edit_address_endpoint', 'edit-address', 'yes'),
(243, 'woocommerce_myaccount_payment_methods_endpoint', 'payment-methods', 'yes'),
(244, 'woocommerce_myaccount_lost_password_endpoint', 'lost-password', 'yes'),
(245, 'woocommerce_logout_endpoint', 'customer-logout', 'yes'),
(246, 'woocommerce_api_enabled', 'no', 'yes'),
(247, 'woocommerce_single_image_width', '600', 'yes'),
(248, 'woocommerce_thumbnail_image_width', '300', 'yes'),
(249, 'woocommerce_checkout_highlight_required_fields', 'yes', 'yes'),
(250, 'woocommerce_demo_store', 'no', 'no'),
(253, '_transient_woocommerce_webhook_ids', 'a:0:{}', 'yes'),
(254, 'widget_woocommerce_widget_cart', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(255, 'widget_woocommerce_layered_nav_filters', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(256, 'widget_woocommerce_layered_nav', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(257, 'widget_woocommerce_price_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(258, 'widget_woocommerce_product_categories', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(259, 'widget_woocommerce_product_search', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(260, 'widget_woocommerce_product_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(261, 'widget_woocommerce_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(262, 'widget_woocommerce_recently_viewed_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(263, 'widget_woocommerce_top_rated_products', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(264, 'widget_woocommerce_recent_reviews', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(265, 'widget_woocommerce_rating_filter', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(266, 'woocommerce_permalinks', 'a:5:{s:12:\"product_base\";s:7:\"product\";s:13:\"category_base\";s:16:\"product-category\";s:8:\"tag_base\";s:11:\"product-tag\";s:14:\"attribute_base\";s:0:\"\";s:22:\"use_verbose_page_rules\";b:0;}', 'yes'),
(267, '_transient_wc_attribute_taxonomies', 'a:0:{}', 'yes'),
(268, 'current_theme_supports_woocommerce', 'yes', 'yes'),
(269, 'woocommerce_queue_flush_rewrite_rules', 'no', 'yes'),
(271, 'woocommerce_meta_box_errors', 'a:0:{}', 'yes'),
(272, 'woocommerce_admin_notices', 'a:1:{i:0;s:20:\"no_secure_connection\";}', 'yes'),
(275, 'cfpp_options', 'a:5:{s:15:\"metodos_entrega\";a:2:{i:0;s:24:\"WC_Correios_Shipping_PAC\";i:1;s:26:\"WC_Correios_Shipping_SEDEX\";}s:19:\"exibir_frete_gratis\";s:4:\"true\";s:22:\"exibir_retirar_em_maos\";s:4:\"true\";s:12:\"cor_do_botao\";s:7:\"#03a9f4\";s:12:\"cor_do_texto\";s:7:\"#FFFFFF\";}', 'yes'),
(277, 'default_product_cat', '15', 'yes'),
(283, 'woocommerce_product_type', 'both', 'yes'),
(284, 'woocommerce_sell_in_person', '1', 'yes'),
(285, 'woocommerce_allow_tracking', 'no', 'yes'),
(287, 'woocommerce_ppec_paypal_settings', 'a:2:{s:16:\"reroute_requests\";b:0;s:5:\"email\";s:26:\"lucas.b@onthegosystems.com\";}', 'yes'),
(288, 'woocommerce_cheque_settings', 'a:1:{s:7:\"enabled\";s:3:\"yes\";}', 'yes'),
(289, 'woocommerce_bacs_settings', 'a:1:{s:7:\"enabled\";s:2:\"no\";}', 'yes'),
(290, 'woocommerce_cod_settings', 'a:1:{s:7:\"enabled\";s:3:\"yes\";}', 'yes'),
(291, 'wc_ppec_version', '1.6.3', 'yes'),
(297, '_transient_shipping-transient-version', '1539832802', 'yes'),
(298, 'woocommerce_flat_rate_1_settings', 'a:3:{s:5:\"title\";s:9:\"Flat rate\";s:10:\"tax_status\";s:7:\"taxable\";s:4:\"cost\";s:2:\"10\";}', 'yes'),
(299, 'woocommerce_flat_rate_2_settings', 'a:3:{s:5:\"title\";s:9:\"Flat rate\";s:10:\"tax_status\";s:7:\"taxable\";s:4:\"cost\";s:3:\"300\";}', 'yes'),
(301, 'current_theme', 'Storefront', 'yes'),
(302, 'theme_mods_storefront', 'a:3:{i:0;b:0;s:18:\"nav_menu_locations\";a:0:{}s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(303, 'theme_switched', '', 'yes'),
(304, 'storefront_nux_fresh_site', '0', 'yes'),
(305, 'woocommerce_catalog_rows', '4', 'yes'),
(306, 'woocommerce_catalog_columns', '3', 'yes'),
(307, 'woocommerce_maybe_regenerate_images_hash', '27acde77266b4d2a3491118955cb3f66', 'yes'),
(317, 'storefront_nux_dismissed', '1', 'yes'),
(318, 'storefront_nux_guided_tour', '1', 'yes'),
(322, '_transient_product_query-transient-version', '1539896688', 'yes'),
(324, 'product_cat_children', 'a:0:{}', 'yes'),
(327, '_transient_product-transient-version', '1539896688', 'yes'),
(401, '_transient_timeout_wc_product_loop308c1537706862', '1540317151', 'no'),
(402, '_transient_wc_product_loop308c1537706862', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:38;i:1;i:37;i:2;i:36;i:3;i:35;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(403, '_transient_timeout_wc_product_loopa5b41537706862', '1540317152', 'no'),
(404, '_transient_wc_product_loopa5b41537706862', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(405, '_transient_timeout_wc_product_loop1a121537706862', '1540317152', 'no'),
(406, '_transient_wc_product_loop1a121537706862', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:27;i:1;i:28;i:2;i:29;i:3;i:30;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(407, '_transient_timeout_wc_product_loop952e1537706862', '1540317153', 'no'),
(408, '_transient_wc_product_loop952e1537706862', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:1:{i:0;i:27;}s:5:\"total\";i:1;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(409, '_transient_timeout_wc_product_loop73ac1537706862', '1540317153', 'no'),
(410, '_transient_wc_product_loop73ac1537706862', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:1:{i:0;i:27;}s:5:\"total\";i:1;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(411, '_transient_timeout_wc_shipping_method_count_1_1537706936', '1540317429', 'no'),
(412, '_transient_wc_shipping_method_count_1_1537706936', '4', 'no'),
(436, 'woocommerce_version', '3.4.5', 'yes'),
(437, 'woocommerce_db_version', '3.4.5', 'yes'),
(496, '_transient_timeout_wc_product_loop308c1537828658', '1540569071', 'no'),
(497, '_transient_wc_product_loop308c1537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:38;i:1;i:37;i:2;i:36;i:3;i:35;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(499, '_transient_timeout_wc_product_loopa5b41537828658', '1540569072', 'no'),
(500, '_transient_wc_product_loopa5b41537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(501, '_transient_timeout_wc_product_loop1a121537828658', '1540569072', 'no'),
(502, '_transient_wc_product_loop1a121537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:27;i:1;i:28;i:2;i:29;i:3;i:30;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(505, '_transient_timeout_wc_product_loop952e1537828658', '1540569073', 'no'),
(507, '_transient_wc_product_loop952e1537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:1:{i:0;i:27;}s:5:\"total\";i:1;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(509, '_transient_timeout_wc_product_loop73ac1537828658', '1540569074', 'no'),
(510, '_transient_wc_product_loop73ac1537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:28;i:1;i:27;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(532, '_transient_timeout_wc_product_loop5fc81537828658', '1540734153', 'no'),
(533, '_transient_wc_product_loop5fc81537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:1:{i:0;i:27;}s:5:\"total\";i:1;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:2;s:12:\"current_page\";i:1;}', 'no'),
(534, '_transient_timeout_wc_product_loopa47f1537828658', '1540734153', 'no');
INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(535, '_transient_wc_product_loopa47f1537828658', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:27;i:1;i:28;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(564, '_transient_timeout_wc_shipping_method_count_0_1537706936', '1540735313', 'no'),
(565, '_transient_wc_shipping_method_count_0_1537706936', '4', 'no'),
(578, '_transient_timeout_wc_shipping_method_count_1_1538154337', '1540746401', 'no'),
(579, '_transient_wc_shipping_method_count_1_1538154337', '6', 'no'),
(591, '_transient_timeout_wc_shipping_method_count_0_1538154337', '1540769004', 'no'),
(592, '_transient_wc_shipping_method_count_0_1538154337', '6', 'no'),
(597, 'woocommerce_free_shipping_7_settings', 'a:3:{s:5:\"title\";s:13:\"Free shipping\";s:8:\"requires\";s:0:\"\";s:10:\"min_amount\";s:0:\"\";}', 'yes'),
(605, '_transient_timeout_wc_shipping_method_count_1_1538177042', '1540769131', 'no'),
(606, '_transient_wc_shipping_method_count_1_1538177042', '7', 'no'),
(641, '_transient_timeout_wc_shipping_method_count_0_1538177042', '1540925015', 'no'),
(642, '_transient_wc_shipping_method_count_0_1538177042', '7', 'no'),
(646, '_transient_timeout_wc_shipping_method_count_1_1538333053', '1540925202', 'no'),
(647, '_transient_wc_shipping_method_count_1_1538333053', '7', 'no'),
(654, '_transient_timeout_wc_shipping_method_count_1_1538336891', '1540928935', 'no'),
(655, '_transient_wc_shipping_method_count_1_1538336891', '7', 'no'),
(659, '_transient_timeout_wc_shipping_method_count_1_1538337533', '1540929588', 'no'),
(660, '_transient_wc_shipping_method_count_1_1538337533', '7', 'no'),
(666, '_transient_timeout_wc_shipping_method_count_1_1538340524', '1540932583', 'no'),
(667, '_transient_wc_shipping_method_count_1_1538340524', '7', 'no'),
(670, '_transient_timeout_wc_shipping_method_count_0_1538340524', '1540935793', 'no'),
(671, '_transient_wc_shipping_method_count_0_1538340524', '7', 'no'),
(674, 'woocommerce_flat_rate_8_settings', 'a:3:{s:5:\"title\";s:9:\"Flat rate\";s:10:\"tax_status\";s:7:\"taxable\";s:4:\"cost\";s:2:\"50\";}', 'yes'),
(678, '_transient_timeout_wc_shipping_method_count_1_1538343810', '1540935842', 'no'),
(679, '_transient_wc_shipping_method_count_1_1538343810', '8', 'no'),
(682, '_transient_timeout_wc_shipping_method_count_0_1538343810', '1540939802', 'no'),
(683, '_transient_wc_shipping_method_count_0_1538343810', '8', 'no'),
(687, '_transient_timeout_wc_shipping_method_count_1_1538347816', '1540939861', 'no'),
(688, '_transient_wc_shipping_method_count_1_1538347816', '8', 'no'),
(689, '_transient_timeout_wc_shipping_method_count_0_1538347816', '1540940172', 'no'),
(690, '_transient_wc_shipping_method_count_0_1538347816', '8', 'no'),
(694, '_transient_timeout_wc_shipping_method_count_1_1538348223', '1540940357', 'no'),
(695, '_transient_wc_shipping_method_count_1_1538348223', '8', 'no'),
(699, 'woocommerce_correios-pac_3_settings', 'a:24:{s:7:\"enabled\";s:3:\"yes\";s:5:\"title\";s:3:\"PAC\";s:16:\"behavior_options\";s:0:\"\";s:15:\"origin_postcode\";s:8:\"30360230\";s:17:\"shipping_class_id\";s:2:\"-1\";s:18:\"show_delivery_time\";s:2:\"no\";s:15:\"additional_time\";s:1:\"0\";s:3:\"fee\";s:0:\"\";s:17:\"optional_services\";s:0:\"\";s:14:\"receipt_notice\";s:3:\"yes\";s:9:\"own_hands\";s:3:\"yes\";s:13:\"declare_value\";s:3:\"yes\";s:15:\"service_options\";s:0:\"\";s:11:\"custom_code\";s:0:\"\";s:12:\"service_type\";s:12:\"conventional\";s:5:\"login\";s:0:\"\";s:8:\"password\";s:0:\"\";s:16:\"package_standard\";s:0:\"\";s:14:\"minimum_height\";s:1:\"2\";s:13:\"minimum_width\";s:2:\"11\";s:14:\"minimum_length\";s:2:\"16\";s:12:\"extra_weight\";s:0:\"\";s:7:\"testing\";s:0:\"\";s:5:\"debug\";s:2:\"no\";}', 'yes'),
(710, '_transient_timeout_wc_shipping_method_count_1_1538348579', '1540940697', 'no'),
(711, '_transient_wc_shipping_method_count_1_1538348579', '8', 'no'),
(715, '_transient_timeout_wc_shipping_method_count_1_1538349525', '1540941568', 'no'),
(716, '_transient_wc_shipping_method_count_1_1538349525', '8', 'no'),
(728, '_transient_timeout_wc_shipping_method_count_1_1538349708', '1540941741', 'no'),
(729, '_transient_wc_shipping_method_count_1_1538349708', '8', 'no'),
(741, '_transient_timeout_wc_shipping_method_count_0_1538349708', '1540954617', 'no'),
(742, '_transient_wc_shipping_method_count_0_1538349708', '8', 'no'),
(745, '_transient_timeout_wc_shipping_method_count_1_1538362630', '1540954686', 'no'),
(746, '_transient_wc_shipping_method_count_1_1538362630', '8', 'no'),
(767, '_transient_timeout_wc_product_loop5fc81538364589', '1540957476', 'no'),
(768, '_transient_wc_product_loop5fc81538364589', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:1:{i:0;i:27;}s:5:\"total\";i:1;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:2;s:12:\"current_page\";i:1;}', 'no'),
(769, '_transient_timeout_wc_product_loopa47f1538364589', '1540957476', 'no'),
(770, '_transient_wc_product_loopa47f1538364589', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:27;i:1;i:28;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(782, '_transient_timeout_wc_product_loop5fc81538366146', '1540958231', 'no'),
(783, '_transient_wc_product_loop5fc81538366146', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:1:{i:0;i:27;}s:5:\"total\";i:1;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:2;s:12:\"current_page\";i:1;}', 'no'),
(784, '_transient_timeout_wc_product_loopa47f1538366146', '1540958231', 'no'),
(785, '_transient_wc_product_loopa47f1538366146', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:27;i:1;i:28;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(849, '_transient_timeout_wc_product_children_27', '1540960031', 'no'),
(850, '_transient_wc_product_children_27', 'a:2:{s:3:\"all\";a:2:{i:0;i:45;i:1;i:46;}s:7:\"visible\";a:2:{i:0;i:45;i:1;i:46;}}', 'no'),
(851, '_transient_timeout_wc_var_prices_27', '1542488766', 'no'),
(852, '_transient_wc_var_prices_27', '{\"version\":\"1539896688\",\"0a781c6fa8af6febf14d01abf00d55af\":{\"price\":{\"45\":\"80.00\",\"46\":\"80000.00\"},\"regular_price\":{\"45\":\"80.00\",\"46\":\"80000.00\"},\"sale_price\":{\"45\":\"80.00\",\"46\":\"80000.00\"}}}', 'no'),
(857, '_transient_timeout_wc_shipping_method_count_0_1538362630', '1540960238', 'no'),
(858, '_transient_wc_shipping_method_count_0_1538362630', '8', 'no'),
(871, '_transient_timeout_wc_shipping_method_count_0_1538368340', '1540960788', 'no'),
(872, '_transient_wc_shipping_method_count_0_1538368340', '8', 'no'),
(876, '_transient_timeout_wc_shipping_method_count_1_1538369018', '1540961205', 'no'),
(877, '_transient_wc_shipping_method_count_1_1538369018', '8', 'no'),
(883, '_transient_timeout_wc_product_loop308c1538368027', '1541021663', 'no'),
(884, '_transient_wc_product_loop308c1538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:38;i:1;i:37;i:2;i:36;i:3;i:35;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(885, '_transient_timeout_wc_product_loopa5b41538368027', '1541021663', 'no'),
(886, '_transient_wc_product_loopa5b41538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(887, '_transient_timeout_wc_product_loop1a121538368027', '1541021663', 'no'),
(888, '_transient_wc_product_loop1a121538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:27;i:1;i:28;i:2;i:29;i:3;i:30;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(891, '_transient_timeout_wc_product_loopc8d51538368027', '1541021664', 'no'),
(892, '_transient_wc_product_loopc8d51538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(893, '_transient_timeout_wc_product_loop73ac1538368027', '1541021664', 'no'),
(894, '_transient_wc_product_loop73ac1538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:28;i:1;i:27;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(898, '_transient_timeout_wc_product_loop040c1538368027', '1541452864', 'no'),
(899, '_transient_wc_product_loop040c1538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:38;i:1;i:37;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:2;s:12:\"current_page\";i:1;}', 'no'),
(900, '_transient_timeout_wc_product_loopa47f1538368027', '1541452865', 'no'),
(901, '_transient_wc_product_loopa47f1538368027', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:27;i:1;i:28;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(939, '_transient_timeout_wc_shipping_method_count_0_1538369018', '1541770801', 'no'),
(940, '_transient_wc_shipping_method_count_0_1538369018', '8', 'no'),
(960, 'woocommerce_flat_rate_9_settings', 'a:3:{s:5:\"title\";s:9:\"Flat rate\";s:10:\"tax_status\";s:7:\"taxable\";s:4:\"cost\";s:3:\"500\";}', 'yes'),
(968, '_transient_timeout_wc_shipping_method_count_1_1539186712', '1541778745', 'no'),
(969, '_transient_wc_shipping_method_count_1_1539186712', '9', 'no'),
(993, '_transient_timeout_wc_shipping_method_count_0_1539186712', '1541778948', 'no'),
(994, '_transient_wc_shipping_method_count_0_1539186712', '9', 'no'),
(998, '_transient_timeout_wc_shipping_method_count_1_1539186953', '1541779004', 'no'),
(999, '_transient_wc_shipping_method_count_1_1539186953', '9', 'no'),
(1001, '_transient_timeout_wc_shipping_method_count_0_1539186953', '1541784983', 'no'),
(1002, '_transient_wc_shipping_method_count_0_1539186953', '9', 'no'),
(1006, '_transient_timeout_wc_shipping_method_count_1_1539194424', '1541786490', 'no'),
(1007, '_transient_wc_shipping_method_count_1_1539194424', '10', 'no'),
(1024, '_transient_timeout_wc_product_loop040c1539186768', '1541798513', 'no'),
(1025, '_transient_wc_product_loop040c1539186768', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:38;i:1;i:37;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:2;s:12:\"current_page\";i:1;}', 'no'),
(1026, '_transient_timeout_wc_product_loopa47f1539186768', '1541798513', 'no'),
(1027, '_transient_wc_product_loopa47f1539186768', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:3:{i:0;i:27;i:1;i:28;i:2;i:29;}s:5:\"total\";i:3;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1028, '_transient_timeout_wc_shipping_method_count_0_1539194424', '1541798572', 'no'),
(1029, '_transient_wc_shipping_method_count_0_1539194424', '10', 'no'),
(1030, 'woocommerce_correios-carta-registrada_10_settings', 'a:13:{s:7:\"enabled\";s:3:\"yes\";s:5:\"title\";s:16:\"Carta Registrada\";s:16:\"behavior_options\";s:0:\"\";s:14:\"shipping_class\";s:14:\"produtos-leves\";s:18:\"show_delivery_time\";s:3:\"yes\";s:15:\"additional_time\";s:1:\"6\";s:12:\"extra_weight\";s:1:\"0\";s:3:\"fee\";s:0:\"\";s:17:\"optional_services\";s:0:\"\";s:14:\"receipt_notice\";s:2:\"no\";s:9:\"own_hands\";s:2:\"no\";s:7:\"testing\";s:0:\"\";s:5:\"debug\";s:2:\"no\";}', 'yes'),
(1034, '_transient_timeout_wc_shipping_method_count_1_1539206613', '1541798656', 'no'),
(1035, '_transient_wc_shipping_method_count_1_1539206613', '10', 'no'),
(1048, '_transient_timeout_wc_shipping_method_count_0_1539206613', '1541799524', 'no'),
(1049, '_transient_wc_shipping_method_count_0_1539206613', '10', 'no'),
(1053, '_transient_timeout_wc_shipping_method_count_1_1539207706', '1541799738', 'no'),
(1054, '_transient_wc_shipping_method_count_1_1539207706', '10', 'no'),
(1055, '_transient_timeout_wc_shipping_method_count_0_1539207706', '1541800676', 'no'),
(1056, '_transient_wc_shipping_method_count_0_1539207706', '10', 'no'),
(1066, '_transient_timeout_wc_shipping_method_count_1_1539214640', '1541806684', 'no'),
(1067, '_transient_wc_shipping_method_count_1_1539214640', '10', 'no'),
(1073, '_transient_timeout_wc_product_loop308c1539213334', '1541861682', 'no'),
(1074, '_transient_wc_product_loop308c1539213334', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:38;i:1;i:37;i:2;i:36;i:3;i:35;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1077, '_transient_timeout_wc_product_loopa5b41539213334', '1541861683', 'no'),
(1078, '_transient_wc_product_loopa5b41539213334', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1079, '_transient_timeout_wc_product_loop1a121539213334', '1541861683', 'no'),
(1080, '_transient_wc_product_loop1a121539213334', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:27;i:1;i:28;i:2;i:29;i:3;i:30;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1084, '_transient_timeout_wc_product_loopc8d51539213334', '1541861683', 'no'),
(1085, '_transient_wc_product_loopc8d51539213334', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1086, '_transient_timeout_wc_product_loop73ac1539213334', '1541861683', 'no'),
(1087, '_transient_wc_product_loop73ac1539213334', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:3:{i:0;i:29;i:1;i:28;i:2;i:27;}s:5:\"total\";i:3;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1128, '_transient_timeout_external_ip_address_10.0.2.2', '1540409044', 'no'),
(1129, '_transient_external_ip_address_10.0.2.2', '201.80.0.128', 'no'),
(1131, '_transient_timeout_external_ip_address_127.0.0.1', '1540409046', 'no'),
(1132, '_transient_external_ip_address_127.0.0.1', '201.80.0.128', 'no'),
(1157, '_site_transient_timeout_browser_11d9a73fb38b2f1c4799e1f5e17c7b14', '1540430893', 'no'),
(1158, '_site_transient_browser_11d9a73fb38b2f1c4799e1f5e17c7b14', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:13:\"68.0.3440.106\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(1175, '_transient_timeout_wc_shipping_method_count_0_1539214640', '1542418107', 'no'),
(1176, '_transient_wc_shipping_method_count_0_1539214640', '10', 'no'),
(1187, '_transient_timeout_wc_product_loop308c1539831036', '1542424565', 'no'),
(1188, '_transient_wc_product_loop308c1539831036', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:38;i:1;i:37;i:2;i:36;i:3;i:35;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1189, '_transient_timeout_wc_product_loopa5b41539831036', '1542424566', 'no'),
(1190, '_transient_wc_product_loopa5b41539831036', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1191, '_transient_timeout_wc_product_loop1a121539831036', '1542424566', 'no'),
(1192, '_transient_wc_product_loop1a121539831036', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:27;i:1;i:28;i:2;i:29;i:3;i:30;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1195, '_transient_timeout_wc_product_loopc8d51539831036', '1542424566', 'no'),
(1196, '_transient_wc_product_loopc8d51539831036', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1197, '_transient_timeout_wc_product_loop73ac1539831036', '1542424566', 'no'),
(1198, '_transient_wc_product_loop73ac1539831036', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:3:{i:0;i:29;i:1;i:28;i:2;i:27;}s:5:\"total\";i:3;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1202, '_transient_timeout_wc_shipping_method_count_1_1539832802', '1542424841', 'no'),
(1203, '_transient_wc_shipping_method_count_1_1539832802', '10', 'no'),
(1226, '_transient_wc_count_comments', 'O:8:\"stdClass\":7:{s:14:\"total_comments\";i:1;s:3:\"all\";i:1;s:8:\"approved\";s:1:\"1\";s:9:\"moderated\";i:0;s:4:\"spam\";i:0;s:5:\"trash\";i:0;s:12:\"post-trashed\";i:0;}', 'yes'),
(1229, '_transient_timeout_wc_term_counts', '1542656946', 'no'),
(1230, '_transient_wc_term_counts', 'a:4:{i:16;s:1:\"4\";i:17;s:1:\"4\";i:18;s:1:\"4\";i:15;s:0:\"\";}', 'no'),
(1233, '_transient_timeout_wc_product_loop308c1539896688', '1542489598', 'no'),
(1234, '_transient_wc_product_loop308c1539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:38;i:1;i:37;i:2;i:36;i:3;i:35;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1235, '_transient_timeout_wc_product_loopa5b41539896688', '1542489599', 'no'),
(1236, '_transient_wc_product_loopa5b41539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1237, '_transient_timeout_wc_product_loop1a121539896688', '1542489599', 'no'),
(1238, '_transient_wc_product_loop1a121539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:4:{i:0;i:27;i:1;i:28;i:2;i:29;i:3;i:30;}s:5:\"total\";i:4;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1239, '_transient_timeout_wc_products_onsale', '1542489599', 'no'),
(1240, '_transient_wc_products_onsale', 'a:0:{}', 'no'),
(1241, '_transient_timeout_wc_product_loopc8d51539896688', '1542489599', 'no'),
(1242, '_transient_wc_product_loopc8d51539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:0:{}s:5:\"total\";i:0;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1243, '_transient_timeout_wc_product_loop73ac1539896688', '1542489599', 'no'),
(1244, '_transient_wc_product_loop73ac1539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:3:{i:0;i:29;i:1;i:28;i:2;i:27;}s:5:\"total\";i:3;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no'),
(1250, '_site_transient_timeout_theme_roots', '1540064823', 'no'),
(1251, '_site_transient_theme_roots', 'a:4:{s:10:\"storefront\";s:7:\"/themes\";s:13:\"twentyfifteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:13:\"twentysixteen\";s:7:\"/themes\";}', 'no'),
(1254, '_transient_timeout__woocommerce_helper_updates', '1540106224', 'no'),
(1255, '_transient__woocommerce_helper_updates', 'a:4:{s:4:\"hash\";s:32:\"d751713988987e9331980363e24189ce\";s:7:\"updated\";i:1540063024;s:8:\"products\";a:0:{}s:6:\"errors\";a:1:{i:0;s:10:\"http-error\";}}', 'no'),
(1256, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1540063076;s:7:\"checked\";a:4:{s:31:\"query-monitor/query-monitor.php\";s:5:\"3.1.1\";s:27:\"woocommerce/woocommerce.php\";s:5:\"3.4.5\";s:45:\"woocommerce-correios/woocommerce-correios.php\";s:5:\"3.7.1\";s:105:\"woo-correios-calculo-de-frete-na-pagina-do-produto/woo-correios-calculo-de-frete-na-pagina-do-produto.php\";s:5:\"3.0.5\";}s:8:\"response\";a:1:{s:27:\"woocommerce/woocommerce.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:25:\"w.org/plugins/woocommerce\";s:4:\"slug\";s:11:\"woocommerce\";s:6:\"plugin\";s:27:\"woocommerce/woocommerce.php\";s:11:\"new_version\";s:5:\"3.4.7\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/woocommerce/\";s:7:\"package\";s:59:\"http://downloads.wordpress.org/plugin/woocommerce.3.4.7.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/woocommerce/assets/icon-256x256.png?rev=1440831\";s:2:\"1x\";s:64:\"https://ps.w.org/woocommerce/assets/icon-128x128.png?rev=1440831\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:67:\"https://ps.w.org/woocommerce/assets/banner-1544x500.png?rev=1629184\";s:2:\"1x\";s:66:\"https://ps.w.org/woocommerce/assets/banner-772x250.png?rev=1629184\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"4.9.8\";s:12:\"requires_php\";b:0;s:13:\"compatibility\";O:8:\"stdClass\":0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:3:{s:31:\"query-monitor/query-monitor.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:27:\"w.org/plugins/query-monitor\";s:4:\"slug\";s:13:\"query-monitor\";s:6:\"plugin\";s:31:\"query-monitor/query-monitor.php\";s:11:\"new_version\";s:5:\"3.1.1\";s:3:\"url\";s:44:\"https://wordpress.org/plugins/query-monitor/\";s:7:\"package\";s:61:\"http://downloads.wordpress.org/plugin/query-monitor.3.1.1.zip\";s:5:\"icons\";a:1:{s:7:\"default\";s:64:\"https://s.w.org/plugins/geopattern-icon/query-monitor_525f62.svg\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:69:\"https://ps.w.org/query-monitor/assets/banner-1544x500.png?rev=1629576\";s:2:\"1x\";s:68:\"https://ps.w.org/query-monitor/assets/banner-772x250.png?rev=1731469\";}s:11:\"banners_rtl\";a:0:{}}s:45:\"woocommerce-correios/woocommerce-correios.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:34:\"w.org/plugins/woocommerce-correios\";s:4:\"slug\";s:20:\"woocommerce-correios\";s:6:\"plugin\";s:45:\"woocommerce-correios/woocommerce-correios.php\";s:11:\"new_version\";s:5:\"3.7.1\";s:3:\"url\";s:51:\"https://wordpress.org/plugins/woocommerce-correios/\";s:7:\"package\";s:68:\"http://downloads.wordpress.org/plugin/woocommerce-correios.3.7.1.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:73:\"https://ps.w.org/woocommerce-correios/assets/icon-256x256.png?rev=1356952\";s:2:\"1x\";s:73:\"https://ps.w.org/woocommerce-correios/assets/icon-128x128.png?rev=1356952\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:76:\"https://ps.w.org/woocommerce-correios/assets/banner-1544x500.png?rev=1356952\";s:2:\"1x\";s:75:\"https://ps.w.org/woocommerce-correios/assets/banner-772x250.png?rev=1356952\";}s:11:\"banners_rtl\";a:0:{}}s:105:\"woo-correios-calculo-de-frete-na-pagina-do-produto/woo-correios-calculo-de-frete-na-pagina-do-produto.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:64:\"w.org/plugins/woo-correios-calculo-de-frete-na-pagina-do-produto\";s:4:\"slug\";s:50:\"woo-correios-calculo-de-frete-na-pagina-do-produto\";s:6:\"plugin\";s:105:\"woo-correios-calculo-de-frete-na-pagina-do-produto/woo-correios-calculo-de-frete-na-pagina-do-produto.php\";s:11:\"new_version\";s:5:\"2.3.3\";s:3:\"url\";s:81:\"https://wordpress.org/plugins/woo-correios-calculo-de-frete-na-pagina-do-produto/\";s:7:\"package\";s:92:\"http://downloads.wordpress.org/plugin/woo-correios-calculo-de-frete-na-pagina-do-produto.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:103:\"https://ps.w.org/woo-correios-calculo-de-frete-na-pagina-do-produto/assets/icon-256x256.png?rev=1844330\";s:2:\"1x\";s:103:\"https://ps.w.org/woo-correios-calculo-de-frete-na-pagina-do-produto/assets/icon-128x128.png?rev=1844330\";}s:7:\"banners\";a:2:{s:2:\"2x\";s:106:\"https://ps.w.org/woo-correios-calculo-de-frete-na-pagina-do-produto/assets/banner-1544x500.jpg?rev=1844330\";s:2:\"1x\";s:105:\"https://ps.w.org/woo-correios-calculo-de-frete-na-pagina-do-produto/assets/banner-772x250.jpg?rev=1844330\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no'),
(1257, '_transient_timeout_wc_report_sales_by_date', '1540155381', 'no'),
(1258, '_transient_wc_report_sales_by_date', 'a:56:{s:32:\"d421a3ee985afb429effce3ff9a00fa3\";a:0:{}s:32:\"b4e4510bd1ffcf2fbbf2983eb1d9eaeb\";a:0:{}s:32:\"a2d7f508964d86a4383d13c4bc54ecbc\";a:0:{}s:32:\"63d58328572c9cb1f1502a5e91676b6e\";N;s:32:\"5e2388e7197fc9d1f095d13d38aa3434\";a:0:{}s:32:\"717adf373052432a55c6caa27c38da96\";a:0:{}s:32:\"e6504da7bc58fc5307a24906d7dcad56\";a:0:{}s:32:\"15b4d19b2e1735763b6ee84b567702fb\";a:0:{}s:32:\"cf7da1e6d31bc21226a8d1ac4b05cabb\";a:0:{}s:32:\"25cb3ec43db5f4311e4a4387305cf4e7\";a:0:{}s:32:\"32bb7be93385ee44bc7461cc6be6934c\";a:0:{}s:32:\"1fb61cf4d9dce3177b3b01552a21277c\";N;s:32:\"20be0c0e8a107b9b7422082fae5d9062\";a:0:{}s:32:\"f7b5452d18bb2b2513f380a05213898d\";a:0:{}s:32:\"cc41df53782074265b323864cffb0daa\";a:0:{}s:32:\"0ecf19f53dee0a988be36be2ff9ba94c\";a:0:{}s:32:\"78485cb6c9332cf9ff34569011b6a99f\";a:0:{}s:32:\"5eb6637070f7d8b3c615353fcf02481c\";a:0:{}s:32:\"8093ca7b21f0eec69118cf32830eea7a\";a:0:{}s:32:\"7ec6baa02f3a5001f6402b163456b48f\";N;s:32:\"1080566cdc2b435d5129611c4d635282\";a:0:{}s:32:\"95914e069b0f43d27493b5a04931d46c\";a:0:{}s:32:\"cf9ba0b54b789c9f7ef0fd611ad66df5\";a:0:{}s:32:\"45db34dc126c81aeeda5a111827c112a\";a:0:{}s:32:\"5bfbfe75e8dfece3da2762501f232448\";a:0:{}s:32:\"09352ca4fcf3f628d41fcc1ba209f804\";a:0:{}s:32:\"b2b89cca155239a132a183c5d819a089\";a:0:{}s:32:\"26bb6c347f5429cab5e245f802386500\";N;s:32:\"1e9777fe7647bddebd80bbc82d2c4123\";a:0:{}s:32:\"40111d0dd9c8b016ea4fa9506a5d038b\";a:0:{}s:32:\"b0c7fbabde64051769e2f04a467b96f3\";a:0:{}s:32:\"acff8660c7e1d6cbc57aa3a457a03d4b\";a:0:{}s:32:\"f12c59ebe7bf2a87ef5d333b9b79832f\";a:0:{}s:32:\"792b1eb3b057ec82bd29c061d073f905\";a:0:{}s:32:\"9360e86a0d5cb87f0c28df41fbb0e4a7\";a:0:{}s:32:\"41debb5adefa970bea7fa167329c810d\";N;s:32:\"c6041b4064bb071fb00fef2e86964a1f\";a:0:{}s:32:\"9a8df5d58e2f8fe47082957bb1d71763\";a:0:{}s:32:\"2a1b2ebe8983e3a8bcbfe679f8fb9f7f\";a:0:{}s:32:\"bd564099db6f8beec5d987be7d0a0744\";a:0:{}s:32:\"4303c7ecb9afb3c373acb887d01125d2\";a:0:{}s:32:\"284a9f058c3e370fe768b5be7fc6f4e3\";a:0:{}s:32:\"bec5bc371eddf32382168c66a1d019ac\";a:0:{}s:32:\"dab3b68c36b9f235f78c55a8b2b2dc1b\";N;s:32:\"83e2cb6a57137a68d4f6ebf928c37bc4\";a:0:{}s:32:\"8ef04010992db5a7956313b6505fda33\";a:0:{}s:32:\"6dfaa94ae6495c8951fdf178fb272180\";a:0:{}s:32:\"74d3a29022bf8e0a6fa2741029bcda93\";a:0:{}s:32:\"890eca3b19cb7d1b72cefab43ef1344d\";a:0:{}s:32:\"411a9aca71c3cfa3eb3257d74cde892e\";a:0:{}s:32:\"4195905385039eb2bb8e8f3a4443a5f5\";a:0:{}s:32:\"e4d4c286fa02ba9c66c281d8b570ddb9\";N;s:32:\"9f6a38f300d5d671e8815fb4f099e95b\";a:0:{}s:32:\"1482c710c5e9ae9937bf6787e3c86499\";a:0:{}s:32:\"32e0e83ec6decfcac5439adb0005437a\";a:0:{}s:32:\"5cdec99ad222e84684b0e3fd40aa0568\";a:0:{}}', 'no'),
(1259, '_transient_timeout_wc_admin_report', '1540149436', 'no'),
(1260, '_transient_wc_admin_report', 'a:1:{s:32:\"0d865ae31619110d5a4c6083f86d4796\";a:0:{}}', 'no'),
(1261, '_transient_timeout_wc_low_stock_count', '1542655036', 'no'),
(1262, '_transient_wc_low_stock_count', '0', 'no'),
(1263, '_transient_timeout_wc_outofstock_count', '1542655036', 'no'),
(1264, '_transient_wc_outofstock_count', '0', 'no'),
(1265, '_site_transient_timeout_community-events-8bac0d0c00b306fcefe8b80278c82ccf', '1540106241', 'no'),
(1266, '_site_transient_community-events-8bac0d0c00b306fcefe8b80278c82ccf', 'a:2:{s:8:\"location\";a:1:{s:2:\"ip\";s:8:\"10.0.2.0\";}s:6:\"events\";a:0:{}}', 'no'),
(1267, '_site_transient_update_themes', 'O:8:\"stdClass\":4:{s:12:\"last_checked\";i:1540063066;s:7:\"checked\";a:4:{s:10:\"storefront\";s:5:\"2.3.3\";s:13:\"twentyfifteen\";s:3:\"2.0\";s:15:\"twentyseventeen\";s:3:\"1.7\";s:13:\"twentysixteen\";s:3:\"1.5\";}s:8:\"response\";a:1:{s:10:\"storefront\";a:4:{s:5:\"theme\";s:10:\"storefront\";s:11:\"new_version\";s:5:\"2.3.4\";s:3:\"url\";s:40:\"https://wordpress.org/themes/storefront/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/theme/storefront.2.3.4.zip\";}}s:12:\"translations\";a:0:{}}', 'no'),
(1268, '_site_transient_timeout_browser_ca81f4584823fbff592e88470c6a057c', '1540667849', 'no'),
(1269, '_site_transient_browser_ca81f4584823fbff592e88470c6a057c', 'a:10:{s:4:\"name\";s:6:\"Chrome\";s:7:\"version\";s:12:\"70.0.3538.67\";s:8:\"platform\";s:7:\"Windows\";s:10:\"update_url\";s:29:\"https://www.google.com/chrome\";s:7:\"img_src\";s:43:\"http://s.w.org/images/browsers/chrome.png?1\";s:11:\"img_src_ssl\";s:44:\"https://s.w.org/images/browsers/chrome.png?1\";s:15:\"current_version\";s:2:\"18\";s:7:\"upgrade\";b:0;s:8:\"insecure\";b:0;s:6:\"mobile\";b:0;}', 'no'),
(1270, '_transient_timeout_dash_v2_88ae138922fe95674369b1cb3d215a2b', '1540106259', 'no'),
(1271, '_transient_dash_v2_88ae138922fe95674369b1cb3d215a2b', '<div class=\"rss-widget\"><p><strong>RSS Error:</strong> WP HTTP Error: cURL error 28: Operation timed out after 10000 milliseconds with 0 bytes received</p></div><div class=\"rss-widget\"><p><strong>RSS Error:</strong> WP HTTP Error: cURL error 28: Connection timed out after 10001 milliseconds</p></div>', 'no'),
(1273, '_transient_is_multi_author', '0', 'yes'),
(1274, '_transient_timeout_wc_related_29', '1540149539', 'no'),
(1275, '_transient_wc_related_29', 'a:1:{s:50:\"limit=3&exclude_ids%5B0%5D=0&exclude_ids%5B1%5D=29\";a:3:{i:0;s:2:\"27\";i:1;s:2:\"28\";i:2;s:2:\"30\";}}', 'no'),
(1276, '_transient_timeout_wc_featured_products', '1542656946', 'no'),
(1277, '_transient_wc_featured_products', 'a:0:{}', 'no'),
(1278, '_transient_timeout_wc_product_loop040c1539896688', '1542656946', 'no'),
(1279, '_transient_wc_product_loop040c1539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:2:{i:0;i:38;i:1;i:37;}s:5:\"total\";i:2;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:2;s:12:\"current_page\";i:1;}', 'no'),
(1280, '_transient_timeout_wc_product_loopa47f1539896688', '1542656946', 'no'),
(1281, '_transient_wc_product_loopa47f1539896688', 'O:8:\"stdClass\":5:{s:3:\"ids\";a:3:{i:0;i:27;i:1;i:28;i:2;i:29;}s:5:\"total\";i:3;s:11:\"total_pages\";i:1;s:8:\"per_page\";i:4;s:12:\"current_page\";i:1;}', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `wp_postmeta`
--

CREATE TABLE `wp_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_postmeta`
--

INSERT INTO `wp_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default'),
(3, 9, '_wp_attached_file', '2018/09/beanie.jpg'),
(4, 9, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:18:\"2018/09/beanie.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"beanie-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"beanie-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"beanie-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:18:\"beanie-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(5, 9, '_starter_content_theme', 'storefront'),
(7, 10, '_wp_attached_file', '2018/09/belt.jpg'),
(8, 10, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:16:\"2018/09/belt.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:16:\"belt-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:16:\"belt-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:16:\"belt-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:16:\"belt-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(9, 10, '_starter_content_theme', 'storefront'),
(11, 11, '_wp_attached_file', '2018/09/cap.jpg'),
(12, 11, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:15:\"2018/09/cap.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:15:\"cap-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:15:\"cap-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:15:\"cap-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:15:\"cap-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(13, 11, '_starter_content_theme', 'storefront'),
(15, 12, '_wp_attached_file', '2018/09/hoodie-with-logo.jpg'),
(16, 12, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:28:\"2018/09/hoodie-with-logo.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:28:\"hoodie-with-logo-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:28:\"hoodie-with-logo-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:28:\"hoodie-with-logo-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(17, 12, '_starter_content_theme', 'storefront'),
(19, 13, '_wp_attached_file', '2018/09/hoodie-with-pocket.jpg'),
(20, 13, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:30:\"2018/09/hoodie-with-pocket.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:30:\"hoodie-with-pocket-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:30:\"hoodie-with-pocket-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:30:\"hoodie-with-pocket-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(21, 13, '_starter_content_theme', 'storefront'),
(23, 14, '_wp_attached_file', '2018/09/hoodie-with-zipper.jpg'),
(24, 14, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:800;s:6:\"height\";i:800;s:4:\"file\";s:30:\"2018/09/hoodie-with-zipper.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:30:\"hoodie-with-zipper-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:30:\"hoodie-with-zipper-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:30:\"hoodie-with-zipper-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(25, 14, '_starter_content_theme', 'storefront'),
(27, 15, '_wp_attached_file', '2018/09/hoodie.jpg'),
(28, 15, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:18:\"2018/09/hoodie.jpg\";s:5:\"sizes\";a:3:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"hoodie-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"hoodie-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"hoodie-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(29, 15, '_starter_content_theme', 'storefront'),
(31, 16, '_wp_attached_file', '2018/09/long-sleeve-tee.jpg'),
(32, 16, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:27:\"2018/09/long-sleeve-tee.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:27:\"long-sleeve-tee-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:27:\"long-sleeve-tee-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:27:\"long-sleeve-tee-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:27:\"long-sleeve-tee-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(33, 16, '_starter_content_theme', 'storefront'),
(35, 17, '_wp_attached_file', '2018/09/polo.jpg'),
(36, 17, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:800;s:4:\"file\";s:16:\"2018/09/polo.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:16:\"polo-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:16:\"polo-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:16:\"polo-768x767.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:767;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:16:\"polo-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(37, 17, '_starter_content_theme', 'storefront'),
(39, 18, '_wp_attached_file', '2018/09/sunglasses.jpg'),
(40, 18, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:22:\"2018/09/sunglasses.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:22:\"sunglasses-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:22:\"sunglasses-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:22:\"sunglasses-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:22:\"sunglasses-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(41, 18, '_starter_content_theme', 'storefront'),
(43, 19, '_wp_attached_file', '2018/09/tshirt.jpg'),
(44, 19, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:18:\"2018/09/tshirt.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:18:\"tshirt-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:18:\"tshirt-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:18:\"tshirt-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:18:\"tshirt-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(45, 19, '_starter_content_theme', 'storefront'),
(47, 20, '_wp_attached_file', '2018/09/vneck-tee.jpg'),
(48, 20, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:800;s:4:\"file\";s:21:\"2018/09/vneck-tee.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:21:\"vneck-tee-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:21:\"vneck-tee-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:21:\"vneck-tee-768x767.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:767;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:21:\"vneck-tee-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(49, 20, '_starter_content_theme', 'storefront'),
(51, 21, '_wp_attached_file', '2018/09/hero.jpg'),
(52, 21, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:3795;s:6:\"height\";i:2355;s:4:\"file\";s:16:\"2018/09/hero.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:16:\"hero-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:16:\"hero-300x186.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:186;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:16:\"hero-768x477.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:477;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:5:\"large\";a:4:{s:4:\"file\";s:17:\"hero-1024x635.jpg\";s:5:\"width\";i:1024;s:6:\"height\";i:635;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(53, 21, '_starter_content_theme', 'storefront'),
(55, 22, '_wp_attached_file', '2018/09/accessories.jpg'),
(56, 22, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:23:\"2018/09/accessories.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:23:\"accessories-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:23:\"accessories-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:23:\"accessories-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:23:\"accessories-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(57, 22, '_starter_content_theme', 'storefront'),
(59, 23, '_wp_attached_file', '2018/09/tshirts.jpg'),
(60, 23, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:801;s:6:\"height\";i:801;s:4:\"file\";s:19:\"2018/09/tshirts.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"tshirts-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"tshirts-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:19:\"tshirts-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:19:\"tshirts-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(61, 23, '_starter_content_theme', 'storefront'),
(63, 24, '_wp_attached_file', '2018/09/hoodies.jpg'),
(64, 24, '_wp_attachment_metadata', 'a:5:{s:5:\"width\";i:800;s:6:\"height\";i:800;s:4:\"file\";s:19:\"2018/09/hoodies.jpg\";s:5:\"sizes\";a:4:{s:9:\"thumbnail\";a:4:{s:4:\"file\";s:19:\"hoodies-150x150.jpg\";s:5:\"width\";i:150;s:6:\"height\";i:150;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:6:\"medium\";a:4:{s:4:\"file\";s:19:\"hoodies-300x300.jpg\";s:5:\"width\";i:300;s:6:\"height\";i:300;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:12:\"medium_large\";a:4:{s:4:\"file\";s:19:\"hoodies-768x768.jpg\";s:5:\"width\";i:768;s:6:\"height\";i:768;s:9:\"mime-type\";s:10:\"image/jpeg\";}s:29:\"woocommerce_thumbnail_preview\";a:4:{s:4:\"file\";s:19:\"hoodies-324x324.jpg\";s:5:\"width\";i:324;s:6:\"height\";i:324;s:9:\"mime-type\";s:10:\"image/jpeg\";}}s:10:\"image_meta\";a:12:{s:8:\"aperture\";s:1:\"0\";s:6:\"credit\";s:0:\"\";s:6:\"camera\";s:0:\"\";s:7:\"caption\";s:0:\"\";s:17:\"created_timestamp\";s:1:\"0\";s:9:\"copyright\";s:0:\"\";s:12:\"focal_length\";s:1:\"0\";s:3:\"iso\";s:1:\"0\";s:13:\"shutter_speed\";s:1:\"0\";s:5:\"title\";s:0:\"\";s:11:\"orientation\";s:1:\"0\";s:8:\"keywords\";a:0:{}}}'),
(65, 24, '_starter_content_theme', 'storefront'),
(67, 25, '_thumbnail_id', '21'),
(68, 25, '_wp_page_template', 'template-homepage.php'),
(70, 25, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(72, 26, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(73, 27, '_thumbnail_id', '9'),
(75, 27, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(76, 28, '_thumbnail_id', '10'),
(78, 28, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(79, 29, '_thumbnail_id', '11'),
(81, 29, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(82, 30, '_thumbnail_id', '18'),
(84, 30, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(85, 31, '_thumbnail_id', '12'),
(87, 31, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(88, 32, '_thumbnail_id', '13'),
(90, 32, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(91, 33, '_thumbnail_id', '14'),
(93, 33, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(94, 34, '_thumbnail_id', '15'),
(96, 34, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(97, 35, '_thumbnail_id', '16'),
(99, 35, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(100, 36, '_thumbnail_id', '17'),
(102, 36, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(103, 37, '_thumbnail_id', '19'),
(105, 37, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(106, 38, '_thumbnail_id', '20'),
(108, 38, '_customize_changeset_uuid', '12519e69-1ac1-493e-afe5-708fd5341ac9'),
(109, 27, '_wc_review_count', '0'),
(110, 27, '_wc_rating_count', 'a:0:{}'),
(111, 27, '_wc_average_rating', '0'),
(112, 27, '_sku', ''),
(115, 27, '_sale_price_dates_from', ''),
(116, 27, '_sale_price_dates_to', ''),
(117, 27, 'total_sales', '0'),
(118, 27, '_tax_status', 'taxable'),
(119, 27, '_tax_class', ''),
(120, 27, '_manage_stock', 'no'),
(121, 27, '_backorders', 'no'),
(122, 27, '_sold_individually', 'no'),
(123, 27, '_weight', '10'),
(124, 27, '_length', '15'),
(125, 27, '_width', '15'),
(126, 27, '_height', '15'),
(127, 27, '_upsell_ids', 'a:0:{}'),
(128, 27, '_crosssell_ids', 'a:0:{}'),
(129, 27, '_purchase_note', ''),
(130, 27, '_default_attributes', 'a:0:{}'),
(131, 27, '_virtual', 'no'),
(132, 27, '_downloadable', 'no'),
(133, 27, '_product_image_gallery', ''),
(134, 27, '_download_limit', '-1'),
(135, 27, '_download_expiry', '-1'),
(136, 27, '_stock', NULL),
(137, 27, '_stock_status', 'instock'),
(138, 27, '_product_version', '3.4.5'),
(140, 28, '_wc_review_count', '0'),
(141, 28, '_wc_rating_count', 'a:0:{}'),
(142, 28, '_wc_average_rating', '0'),
(143, 29, '_wc_review_count', '0'),
(144, 29, '_wc_rating_count', 'a:0:{}'),
(145, 29, '_wc_average_rating', '0'),
(146, 30, '_wc_review_count', '0'),
(147, 30, '_wc_rating_count', 'a:0:{}'),
(148, 30, '_wc_average_rating', '0'),
(149, 31, '_wc_review_count', '0'),
(150, 31, '_wc_rating_count', 'a:0:{}'),
(151, 31, '_wc_average_rating', '0'),
(152, 32, '_wc_review_count', '0'),
(153, 32, '_wc_rating_count', 'a:0:{}'),
(154, 32, '_wc_average_rating', '0'),
(155, 33, '_wc_review_count', '0'),
(156, 33, '_wc_rating_count', 'a:0:{}'),
(157, 33, '_wc_average_rating', '0'),
(158, 34, '_wc_review_count', '0'),
(159, 34, '_wc_rating_count', 'a:0:{}'),
(160, 34, '_wc_average_rating', '0'),
(161, 35, '_wc_review_count', '0'),
(162, 35, '_wc_rating_count', 'a:0:{}'),
(163, 35, '_wc_average_rating', '0'),
(164, 36, '_wc_review_count', '0'),
(165, 36, '_wc_rating_count', 'a:0:{}'),
(166, 36, '_wc_average_rating', '0'),
(167, 37, '_wc_review_count', '0'),
(168, 37, '_wc_rating_count', 'a:0:{}'),
(169, 37, '_wc_average_rating', '0'),
(170, 38, '_wc_review_count', '0'),
(171, 38, '_wc_rating_count', 'a:0:{}'),
(172, 38, '_wc_average_rating', '0'),
(173, 39, '_wp_trash_meta_status', 'publish'),
(174, 39, '_wp_trash_meta_time', '1537706713'),
(175, 27, '_edit_lock', '1538370071:1'),
(176, 27, '_edit_last', '1'),
(177, 42, '_edit_last', '1'),
(178, 42, '_edit_lock', '1537728339:1'),
(179, 42, '_wp_page_template', 'default'),
(180, 28, '_edit_lock', '1537828519:1'),
(181, 28, '_edit_last', '1'),
(182, 28, '_sku', ''),
(183, 28, '_regular_price', '5'),
(184, 28, '_sale_price', ''),
(185, 28, '_sale_price_dates_from', ''),
(186, 28, '_sale_price_dates_to', ''),
(187, 28, 'total_sales', '0'),
(188, 28, '_tax_status', 'taxable'),
(189, 28, '_tax_class', ''),
(190, 28, '_manage_stock', 'no'),
(191, 28, '_backorders', 'no'),
(192, 28, '_sold_individually', 'no'),
(193, 28, '_weight', ''),
(194, 28, '_length', ''),
(195, 28, '_width', ''),
(196, 28, '_height', ''),
(197, 28, '_upsell_ids', 'a:0:{}'),
(198, 28, '_crosssell_ids', 'a:0:{}'),
(199, 28, '_purchase_note', ''),
(200, 28, '_default_attributes', 'a:0:{}'),
(201, 28, '_virtual', 'no'),
(202, 28, '_downloadable', 'no'),
(203, 28, '_product_image_gallery', ''),
(204, 28, '_download_limit', '-1'),
(205, 28, '_download_expiry', '-1'),
(206, 28, '_stock', NULL),
(207, 28, '_stock_status', 'instock'),
(208, 28, '_product_version', '3.4.5'),
(209, 28, '_price', '5'),
(210, 27, '_product_attributes', 'a:1:{s:4:\"kits\";a:6:{s:4:\"name\";s:4:\"Kits\";s:5:\"value\";s:22:\"Kit com 3 | Kit com 10\";s:8:\"position\";i:0;s:10:\"is_visible\";i:1;s:12:\"is_variation\";i:1;s:11:\"is_taxonomy\";i:0;}}'),
(211, 45, '_variation_description', ''),
(212, 45, '_sku', ''),
(213, 45, '_regular_price', '80'),
(214, 45, '_sale_price', ''),
(215, 45, '_sale_price_dates_from', ''),
(216, 45, '_sale_price_dates_to', ''),
(217, 45, 'total_sales', '0'),
(218, 45, '_tax_status', 'taxable'),
(219, 45, '_tax_class', 'parent'),
(220, 45, '_manage_stock', 'no'),
(221, 45, '_backorders', 'no'),
(222, 45, '_sold_individually', 'no'),
(223, 45, '_weight', ''),
(224, 45, '_length', ''),
(225, 45, '_width', ''),
(226, 45, '_height', ''),
(227, 45, '_upsell_ids', 'a:0:{}'),
(228, 45, '_crosssell_ids', 'a:0:{}'),
(229, 45, '_purchase_note', ''),
(230, 45, '_default_attributes', 'a:0:{}'),
(231, 45, '_virtual', 'no'),
(232, 45, '_downloadable', 'no'),
(233, 45, '_product_image_gallery', ''),
(234, 45, '_download_limit', '-1'),
(235, 45, '_download_expiry', '-1'),
(236, 45, '_stock', NULL),
(237, 45, '_stock_status', 'instock'),
(238, 45, '_wc_average_rating', '0'),
(239, 45, '_wc_rating_count', 'a:0:{}'),
(240, 45, '_wc_review_count', '0'),
(241, 45, '_downloadable_files', 'a:0:{}'),
(242, 45, 'attribute_kits', 'Kit com 3'),
(243, 45, '_price', '80'),
(244, 45, '_product_version', '3.4.5'),
(245, 46, '_variation_description', ''),
(246, 46, '_sku', ''),
(247, 46, '_regular_price', '80000'),
(248, 46, '_sale_price', ''),
(249, 46, '_sale_price_dates_from', ''),
(250, 46, '_sale_price_dates_to', ''),
(251, 46, 'total_sales', '0'),
(252, 46, '_tax_status', 'taxable'),
(253, 46, '_tax_class', 'parent'),
(254, 46, '_manage_stock', 'no'),
(255, 46, '_backorders', 'no'),
(256, 46, '_sold_individually', 'no'),
(257, 46, '_weight', ''),
(258, 46, '_length', ''),
(259, 46, '_width', ''),
(260, 46, '_height', ''),
(261, 46, '_upsell_ids', 'a:0:{}'),
(262, 46, '_crosssell_ids', 'a:0:{}'),
(263, 46, '_purchase_note', ''),
(264, 46, '_default_attributes', 'a:0:{}'),
(265, 46, '_virtual', 'no'),
(266, 46, '_downloadable', 'no'),
(267, 46, '_product_image_gallery', ''),
(268, 46, '_download_limit', '-1'),
(269, 46, '_download_expiry', '-1'),
(270, 46, '_stock', NULL),
(271, 46, '_stock_status', 'instock'),
(272, 46, '_wc_average_rating', '0'),
(273, 46, '_wc_rating_count', 'a:0:{}'),
(274, 46, '_wc_review_count', '0'),
(275, 46, '_downloadable_files', 'a:0:{}'),
(276, 46, 'attribute_kits', 'Kit com 10'),
(277, 46, '_price', '80000'),
(278, 46, '_product_version', '3.4.5'),
(285, 27, '_price', '80'),
(286, 27, '_price', '80000'),
(287, 27, '_regular_price', ''),
(288, 27, '_sale_price', ''),
(289, 29, '_edit_lock', '1539904427:1'),
(290, 29, '_edit_last', '1'),
(291, 29, '_sku', ''),
(292, 29, '_regular_price', '15'),
(293, 29, '_sale_price', ''),
(294, 29, '_sale_price_dates_from', ''),
(295, 29, '_sale_price_dates_to', ''),
(296, 29, 'total_sales', '0'),
(297, 29, '_tax_status', 'taxable'),
(298, 29, '_tax_class', ''),
(299, 29, '_manage_stock', 'no'),
(300, 29, '_backorders', 'no'),
(301, 29, '_sold_individually', 'no'),
(302, 29, '_weight', '0.5'),
(303, 29, '_length', '50'),
(304, 29, '_width', '11'),
(305, 29, '_height', '11'),
(306, 29, '_upsell_ids', 'a:0:{}'),
(307, 29, '_crosssell_ids', 'a:0:{}'),
(308, 29, '_purchase_note', ''),
(309, 29, '_default_attributes', 'a:0:{}'),
(310, 29, '_virtual', 'no'),
(311, 29, '_downloadable', 'no'),
(312, 29, '_product_image_gallery', ''),
(313, 29, '_download_limit', '-1'),
(314, 29, '_download_expiry', '-1'),
(315, 29, '_stock', NULL),
(316, 29, '_stock_status', 'instock'),
(317, 29, '_product_version', '3.4.5'),
(318, 29, '_price', '15');

-- --------------------------------------------------------

--
-- Table structure for table `wp_posts`
--

CREATE TABLE `wp_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_posts`
--

INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2018-09-23 12:27:57', '2018-09-23 12:27:57', 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2018-09-23 12:27:57', '2018-09-23 12:27:57', '', 0, 'http://cfpp.localhost?p=1', 0, 'post', '', 1),
(2, 1, '2018-09-23 12:27:57', '2018-09-23 12:27:57', 'This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:\n\n<blockquote>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</blockquote>\n\n...or something like this:\n\n<blockquote>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</blockquote>\n\nAs a new WordPress user, you should go to <a href=\"http://cfpp.localhostwp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2018-09-23 12:27:57', '2018-09-23 12:27:57', '', 0, 'http://cfpp.localhost?page_id=2', 0, 'page', '', 0),
(3, 1, '2018-09-23 12:27:57', '2018-09-23 12:27:57', '<h2>Who we are</h2><p>Our website address is: http://cfpp.localhost.</p><h2>What personal data we collect and why we collect it</h2><h3>Comments</h3><p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><h3>Media</h3><p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><h3>Contact forms</h3><h3>Cookies</h3><p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><p>If you have an account and you log in to this site, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><h3>Embedded content from other websites</h3><p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><h3>Analytics</h3><h2>Who we share your data with</h2><h2>How long we retain your data</h2><p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><h2>What rights you have over your data</h2><p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><h2>Where we send your data</h2><p>Visitor comments may be checked through an automated spam detection service.</p><h2>Your contact information</h2><h2>Additional information</h2><h3>How we protect your data</h3><h3>What data breach procedures we have in place</h3><h3>What third parties we receive data from</h3><h3>What automated decision making and/or profiling we do with user data</h3><h3>Industry regulatory disclosure requirements</h3>', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2018-09-23 12:27:57', '2018-09-23 12:27:57', '', 0, 'http://cfpp.localhost?page_id=3', 0, 'page', '', 0),
(5, 1, '2018-09-23 12:40:46', '2018-09-23 12:40:46', '', 'Shop', '', 'publish', 'closed', 'closed', '', 'shop', '', '', '2018-09-23 12:40:46', '2018-09-23 12:40:46', '', 0, 'http://cfpp.localhost/index.php/shop/', 0, 'page', '', 0),
(6, 1, '2018-09-23 12:40:47', '2018-09-23 12:40:47', '[woocommerce_cart]', 'Cart', '', 'publish', 'closed', 'closed', '', 'cart', '', '', '2018-09-23 12:40:47', '2018-09-23 12:40:47', '', 0, 'http://cfpp.localhost/index.php/cart/', 0, 'page', '', 0),
(7, 1, '2018-09-23 12:40:48', '2018-09-23 12:40:48', '[woocommerce_checkout]', 'Checkout', '', 'publish', 'closed', 'closed', '', 'checkout', '', '', '2018-09-23 12:40:48', '2018-09-23 12:40:48', '', 0, 'http://cfpp.localhost/index.php/checkout/', 0, 'page', '', 0),
(8, 1, '2018-09-23 12:40:49', '2018-09-23 12:40:49', '[woocommerce_my_account]', 'My account', '', 'publish', 'closed', 'closed', '', 'my-account', '', '', '2018-09-23 12:40:49', '2018-09-23 12:40:49', '', 0, 'http://cfpp.localhost/index.php/my-account/', 0, 'page', '', 0),
(9, 1, '2018-09-23 12:43:42', '2018-09-23 12:43:42', '', 'Beanie', '', 'inherit', 'open', 'closed', '', 'beanie-image', '', '', '2018-09-23 12:43:42', '2018-09-23 12:43:42', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/beanie.jpg', 0, 'attachment', 'image/jpeg', 0),
(10, 1, '2018-09-23 12:43:44', '2018-09-23 12:43:44', '', 'Belt', '', 'inherit', 'open', 'closed', '', 'belt-image', '', '', '2018-09-23 12:43:44', '2018-09-23 12:43:44', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/belt.jpg', 0, 'attachment', 'image/jpeg', 0),
(11, 1, '2018-09-23 12:43:46', '2018-09-23 12:43:46', '', 'Cap', '', 'inherit', 'open', 'closed', '', 'cap-image', '', '', '2018-09-23 12:43:46', '2018-09-23 12:43:46', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/cap.jpg', 0, 'attachment', 'image/jpeg', 0),
(12, 1, '2018-09-23 12:43:47', '2018-09-23 12:43:47', '', 'Hoodie with Logo', '', 'inherit', 'open', 'closed', '', 'hoodie-with-logo-image', '', '', '2018-09-23 12:43:47', '2018-09-23 12:43:47', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/hoodie-with-logo.jpg', 0, 'attachment', 'image/jpeg', 0),
(13, 1, '2018-09-23 12:43:48', '2018-09-23 12:43:48', '', 'Hoodie with Pocket', '', 'inherit', 'open', 'closed', '', 'hoodie-with-pocket-image', '', '', '2018-09-23 12:43:48', '2018-09-23 12:43:48', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/hoodie-with-pocket.jpg', 0, 'attachment', 'image/jpeg', 0),
(14, 1, '2018-09-23 12:43:49', '2018-09-23 12:43:49', '', 'Hoodie with Zipper', '', 'inherit', 'open', 'closed', '', 'hoodie-with-zipper-image', '', '', '2018-09-23 12:43:49', '2018-09-23 12:43:49', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/hoodie-with-zipper.jpg', 0, 'attachment', 'image/jpeg', 0),
(15, 1, '2018-09-23 12:43:50', '2018-09-23 12:43:50', '', 'Hoodie', '', 'inherit', 'open', 'closed', '', 'hoodie-image', '', '', '2018-09-23 12:43:50', '2018-09-23 12:43:50', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/hoodie.jpg', 0, 'attachment', 'image/jpeg', 0),
(16, 1, '2018-09-23 12:43:51', '2018-09-23 12:43:51', '', 'Long Sleeve Tee', '', 'inherit', 'open', 'closed', '', 'long-sleeve-tee-image', '', '', '2018-09-23 12:43:51', '2018-09-23 12:43:51', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/long-sleeve-tee.jpg', 0, 'attachment', 'image/jpeg', 0),
(17, 1, '2018-09-23 12:43:52', '2018-09-23 12:43:52', '', 'Polo', '', 'inherit', 'open', 'closed', '', 'polo-image', '', '', '2018-09-23 12:43:52', '2018-09-23 12:43:52', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/polo.jpg', 0, 'attachment', 'image/jpeg', 0),
(18, 1, '2018-09-23 12:43:54', '2018-09-23 12:43:54', '', 'Sunglasses', '', 'inherit', 'open', 'closed', '', 'sunglasses-image', '', '', '2018-09-23 12:43:54', '2018-09-23 12:43:54', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/sunglasses.jpg', 0, 'attachment', 'image/jpeg', 0),
(19, 1, '2018-09-23 12:43:55', '2018-09-23 12:43:55', '', 'Tshirt', '', 'inherit', 'open', 'closed', '', 'tshirt-image', '', '', '2018-09-23 12:43:55', '2018-09-23 12:43:55', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/tshirt.jpg', 0, 'attachment', 'image/jpeg', 0),
(20, 1, '2018-09-23 12:43:56', '2018-09-23 12:43:56', '', 'Vneck Tshirt', '', 'inherit', 'open', 'closed', '', 'vneck-tee-image', '', '', '2018-09-23 12:43:56', '2018-09-23 12:43:56', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/vneck-tee.jpg', 0, 'attachment', 'image/jpeg', 0),
(21, 1, '2018-09-23 12:43:57', '2018-09-23 12:43:57', '', 'Hero', '', 'inherit', 'open', 'closed', '', 'hero-image', '', '', '2018-09-23 12:43:57', '2018-09-23 12:43:57', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/hero.jpg', 0, 'attachment', 'image/jpeg', 0),
(22, 1, '2018-09-23 12:43:58', '2018-09-23 12:43:58', '', 'Accessories', '', 'inherit', 'open', 'closed', '', 'accessories-image', '', '', '2018-09-23 12:43:58', '2018-09-23 12:43:58', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/accessories.jpg', 0, 'attachment', 'image/jpeg', 0),
(23, 1, '2018-09-23 12:43:59', '2018-09-23 12:43:59', '', 'T-shirts', '', 'inherit', 'open', 'closed', '', 'tshirts-image', '', '', '2018-09-23 12:43:59', '2018-09-23 12:43:59', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/tshirts.jpg', 0, 'attachment', 'image/jpeg', 0),
(24, 1, '2018-09-23 12:44:00', '2018-09-23 12:44:00', '', 'Hoodies', '', 'inherit', 'open', 'closed', '', 'hoodies-image', '', '', '2018-09-23 12:44:00', '2018-09-23 12:44:00', '', 0, 'http://cfpp.localhost/wp-content/uploads/2018/09/hoodies.jpg', 0, 'attachment', 'image/jpeg', 0),
(25, 1, '2018-09-23 12:44:01', '2018-09-23 12:44:01', 'This is your homepage which is what most visitors will see when they first visit your shop.\n\nYou can change this text by editing the &quot;Welcome&quot; page via the &quot;Pages&quot; menu in your dashboard.', 'Welcome', '', 'publish', 'closed', 'closed', '', 'welcome', '', '', '2018-09-23 12:44:01', '2018-09-23 12:44:01', '', 0, 'http://cfpp.localhost/?page_id=25', 0, 'page', '', 0),
(26, 1, '2018-09-23 12:44:03', '2018-09-23 12:44:03', '', 'Blog', '', 'publish', 'closed', 'closed', '', 'blog', '', '', '2018-09-23 12:44:03', '2018-09-23 12:44:03', '', 0, 'http://cfpp.localhost/?page_id=26', 0, 'page', '', 0),
(27, 1, '2018-09-23 12:44:05', '2018-09-23 12:44:05', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Beanie', '', 'publish', 'open', 'closed', '', 'beanie', '', '', '2018-10-01 04:27:07', '2018-10-01 04:27:07', '', 0, 'http://cfpp.localhost/?p=27', 0, 'product', '', 0),
(28, 1, '2018-09-23 12:44:10', '2018-09-23 12:44:10', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Belt', '', 'publish', 'open', 'closed', '', 'belt', '', '', '2018-09-24 22:37:38', '2018-09-24 22:37:38', '', 0, 'http://cfpp.localhost/?p=28', 0, 'product', '', 0),
(29, 1, '2018-09-23 12:44:15', '2018-09-23 12:44:15', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Cap', '', 'publish', 'open', 'closed', '', 'cap', '', '', '2018-10-18 21:04:48', '2018-10-18 21:04:48', '', 0, 'http://cfpp.localhost/?p=29', 0, 'product', '', 0),
(30, 1, '2018-09-23 12:44:19', '2018-09-23 12:44:19', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Sunglasses', '', 'publish', 'open', 'closed', '', 'sunglasses', '', '', '2018-09-23 12:44:21', '2018-09-23 12:44:21', '', 0, 'http://cfpp.localhost/?p=30', 0, 'product', '', 0),
(31, 1, '2018-09-23 12:44:24', '2018-09-23 12:44:24', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Hoodie with Logo', '', 'publish', 'open', 'closed', '', 'hoodie-with-logo', '', '', '2018-09-23 12:44:28', '2018-09-23 12:44:28', '', 0, 'http://cfpp.localhost/?p=31', 0, 'product', '', 0),
(32, 1, '2018-09-23 12:44:31', '2018-09-23 12:44:31', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Hoodie with Pocket', '', 'publish', 'open', 'closed', '', 'hoodie-with-pocket', '', '', '2018-09-23 12:44:35', '2018-09-23 12:44:35', '', 0, 'http://cfpp.localhost/?p=32', 0, 'product', '', 0),
(33, 1, '2018-09-23 12:44:38', '2018-09-23 12:44:38', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Hoodie with Zipper', '', 'publish', 'open', 'closed', '', 'hoodie-with-zipper', '', '', '2018-09-23 12:44:40', '2018-09-23 12:44:40', '', 0, 'http://cfpp.localhost/?p=33', 0, 'product', '', 0),
(34, 1, '2018-09-23 12:44:42', '2018-09-23 12:44:42', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Hoodie', '', 'publish', 'open', 'closed', '', 'hoodie', '', '', '2018-09-23 12:44:45', '2018-09-23 12:44:45', '', 0, 'http://cfpp.localhost/?p=34', 0, 'product', '', 0),
(35, 1, '2018-09-23 12:44:48', '2018-09-23 12:44:48', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Long Sleeve Tee', '', 'publish', 'open', 'closed', '', 'long-sleeve-tee', '', '', '2018-09-23 12:44:50', '2018-09-23 12:44:50', '', 0, 'http://cfpp.localhost/?p=35', 0, 'product', '', 0),
(36, 1, '2018-09-23 12:44:52', '2018-09-23 12:44:52', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Polo', '', 'publish', 'open', 'closed', '', 'polo', '', '', '2018-09-23 12:44:55', '2018-09-23 12:44:55', '', 0, 'http://cfpp.localhost/?p=36', 0, 'product', '', 0),
(37, 1, '2018-09-23 12:44:57', '2018-09-23 12:44:57', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Tshirt', '', 'publish', 'open', 'closed', '', 'tshirt', '', '', '2018-09-23 12:45:00', '2018-09-23 12:45:00', '', 0, 'http://cfpp.localhost/?p=37', 0, 'product', '', 0),
(38, 1, '2018-09-23 12:45:03', '2018-09-23 12:45:03', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.', 'Vneck Tshirt', '', 'publish', 'open', 'closed', '', 'vneck-tee', '', '', '2018-09-23 12:45:07', '2018-09-23 12:45:07', '', 0, 'http://cfpp.localhost/?p=38', 0, 'product', '', 0),
(39, 1, '2018-09-23 12:43:42', '2018-09-23 12:43:42', '{\n    \"nav_menus_created_posts\": {\n        \"value\": [\n            9,\n            10,\n            11,\n            12,\n            13,\n            14,\n            15,\n            16,\n            17,\n            18,\n            19,\n            20,\n            21,\n            22,\n            23,\n            24,\n            25,\n            26,\n            27,\n            28,\n            29,\n            30,\n            31,\n            32,\n            33,\n            34,\n            35,\n            36,\n            37,\n            38\n        ],\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-09-23 12:43:42\"\n    },\n    \"show_on_front\": {\n        \"starter_content\": true,\n        \"value\": \"page\",\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-09-23 12:43:16\"\n    },\n    \"page_on_front\": {\n        \"starter_content\": true,\n        \"value\": 25,\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-09-23 12:43:16\"\n    },\n    \"page_for_posts\": {\n        \"starter_content\": true,\n        \"value\": 26,\n        \"type\": \"option\",\n        \"user_id\": 1,\n        \"date_modified_gmt\": \"2018-09-23 12:43:16\"\n    }\n}', '', '', 'trash', 'closed', 'closed', '', '12519e69-1ac1-493e-afe5-708fd5341ac9', '', '', '2018-09-23 12:43:42', '2018-09-23 12:43:42', '', 0, 'http://cfpp.localhost/?p=39', 0, 'customize_changeset', '', 0),
(40, 1, '2018-09-23 12:44:01', '2018-09-23 12:44:01', 'This is your homepage which is what most visitors will see when they first visit your shop.\n\nYou can change this text by editing the &quot;Welcome&quot; page via the &quot;Pages&quot; menu in your dashboard.', 'Welcome', '', 'inherit', 'closed', 'closed', '', '25-revision-v1', '', '', '2018-09-23 12:44:01', '2018-09-23 12:44:01', '', 25, 'http://cfpp.localhost/index.php/2018/09/23/25-revision-v1/', 0, 'revision', '', 0),
(41, 1, '2018-09-23 12:44:03', '2018-09-23 12:44:03', '', 'Blog', '', 'inherit', 'closed', 'closed', '', '26-revision-v1', '', '', '2018-09-23 12:44:03', '2018-09-23 12:44:03', '', 26, 'http://cfpp.localhost/index.php/2018/09/23/26-revision-v1/', 0, 'revision', '', 0),
(42, 1, '2018-09-23 18:48:00', '2018-09-23 18:48:00', 'Goriloide', 'Javali', '', 'publish', 'closed', 'closed', '', 'javali', '', '', '2018-09-23 18:48:00', '2018-09-23 18:48:00', '', 0, 'http://cfpp.localhost/?page_id=42', 0, 'page', '', 0),
(43, 1, '2018-09-23 18:48:00', '2018-09-23 18:48:00', 'Goriloide', 'Javali', '', 'inherit', 'closed', 'closed', '', '42-revision-v1', '', '', '2018-09-23 18:48:00', '2018-09-23 18:48:00', '', 42, 'http://cfpp.localhost/index.php/2018/09/23/42-revision-v1/', 0, 'revision', '', 0),
(45, 1, '2018-10-01 04:19:21', '2018-10-01 04:19:21', '', 'Beanie - Kit com 3', '', 'publish', 'closed', 'closed', '', 'beanie-kit-com-3', '', '', '2018-10-01 04:20:12', '2018-10-01 04:20:12', '', 27, 'http://cfpp.localhost/index.php/product/beanie/', 1, 'product_variation', '', 0),
(46, 1, '2018-10-01 04:19:21', '2018-10-01 04:19:21', '', 'Beanie - Kit com 10', '', 'publish', 'closed', 'closed', '', 'beanie-kit-com-10', '', '', '2018-10-01 04:27:06', '2018-10-01 04:27:06', '', 27, 'http://cfpp.localhost/index.php/product/beanie/', 2, 'product_variation', '', 0),
(48, 1, '2018-10-20 19:18:47', '0000-00-00 00:00:00', '', 'Auto Draft', '', 'auto-draft', 'open', 'open', '', '', '', '', '2018-10-20 19:18:47', '0000-00-00 00:00:00', '', 0, 'http://cfpp.localhost/?p=48', 0, 'post', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_termmeta`
--

CREATE TABLE `wp_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_termmeta`
--

INSERT INTO `wp_termmeta` (`meta_id`, `term_id`, `meta_key`, `meta_value`) VALUES
(1, 16, 'thumbnail_id', '22'),
(2, 16, 'product_count_product_cat', '4'),
(3, 17, 'thumbnail_id', '24'),
(4, 17, 'product_count_product_cat', '4'),
(5, 18, 'thumbnail_id', '23'),
(6, 18, 'product_count_product_cat', '4');

-- --------------------------------------------------------

--
-- Table structure for table `wp_terms`
--

CREATE TABLE `wp_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_terms`
--

INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0),
(2, 'simple', 'simple', 0),
(3, 'grouped', 'grouped', 0),
(4, 'variable', 'variable', 0),
(5, 'external', 'external', 0),
(6, 'exclude-from-search', 'exclude-from-search', 0),
(7, 'exclude-from-catalog', 'exclude-from-catalog', 0),
(8, 'featured', 'featured', 0),
(9, 'outofstock', 'outofstock', 0),
(10, 'rated-1', 'rated-1', 0),
(11, 'rated-2', 'rated-2', 0),
(12, 'rated-3', 'rated-3', 0),
(13, 'rated-4', 'rated-4', 0),
(14, 'rated-5', 'rated-5', 0),
(15, 'Uncategorized', 'uncategorized', 0),
(16, 'Accessories', 'accessories', 0),
(17, 'Hoodies', 'hoodies', 0),
(18, 'Tshirts', 'tshirts', 0),
(19, 'Produtos Leves', 'produtos-leves', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_relationships`
--

CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_relationships`
--

INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0),
(27, 4, 0),
(27, 16, 0),
(28, 2, 0),
(28, 16, 0),
(29, 2, 0),
(29, 16, 0),
(30, 16, 0),
(31, 17, 0),
(32, 17, 0),
(33, 17, 0),
(34, 17, 0),
(35, 18, 0),
(36, 18, 0),
(37, 18, 0),
(38, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_term_taxonomy`
--

CREATE TABLE `wp_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `count` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_term_taxonomy`
--

INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1),
(2, 2, 'product_type', '', 0, 2),
(3, 3, 'product_type', '', 0, 0),
(4, 4, 'product_type', '', 0, 1),
(5, 5, 'product_type', '', 0, 0),
(6, 6, 'product_visibility', '', 0, 0),
(7, 7, 'product_visibility', '', 0, 0),
(8, 8, 'product_visibility', '', 0, 0),
(9, 9, 'product_visibility', '', 0, 0),
(10, 10, 'product_visibility', '', 0, 0),
(11, 11, 'product_visibility', '', 0, 0),
(12, 12, 'product_visibility', '', 0, 0),
(13, 13, 'product_visibility', '', 0, 0),
(14, 14, 'product_visibility', '', 0, 0),
(15, 15, 'product_cat', '', 0, 0),
(16, 16, 'product_cat', 'A short category description', 0, 4),
(17, 17, 'product_cat', 'A short category description', 0, 4),
(18, 18, 'product_cat', 'A short category description', 0, 4),
(19, 19, 'product_shipping_class', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_usermeta`
--

CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_usermeta`
--

INSERT INTO `wp_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'admin'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'wp_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'wp_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', 'wp496_privacy'),
(15, 1, 'show_welcome_panel', '0'),
(16, 1, 'session_tokens', 'a:2:{s:64:\"dd79c6f23e3385f4c0b768ab69991693d6d29883488a2ea57bf8b866370a8d5f\";a:4:{s:10:\"expiration\";i:1540069446;s:2:\"ip\";s:8:\"10.0.2.2\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36\";s:5:\"login\";i:1539896646;}s:64:\"d37534ae943f8da6fa6cecf7c1baed0d197fc3f027c78af376e3ff514f599c0a\";a:4:{s:10:\"expiration\";i:1540235823;s:2:\"ip\";s:8:\"10.0.2.2\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36\";s:5:\"login\";i:1540063023;}}'),
(17, 1, 'wp_dashboard_quick_press_last_post_id', '48'),
(18, 1, 'show_try_gutenberg_panel', '0'),
(19, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:8:\"10.0.2.0\";}'),
(20, 1, '_woocommerce_persistent_cart_1', 'a:1:{s:4:\"cart\";a:1:{s:32:\"6ea9ab1baa0efb9e19094440c317e21b\";a:11:{s:3:\"key\";s:32:\"6ea9ab1baa0efb9e19094440c317e21b\";s:10:\"product_id\";i:29;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:2;s:9:\"data_hash\";s:32:\"b5c1d5ca8bae6d4896cf1807cdf763f0\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:0:{}s:5:\"total\";a:0:{}}s:13:\"line_subtotal\";d:30;s:17:\"line_subtotal_tax\";i:0;s:10:\"line_total\";d:30;s:8:\"line_tax\";i:0;}}}'),
(21, 1, 'wc_last_active', '1539993600');

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE `wp_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES
(1, 'admin', '$P$Bo76l7y1GN8nmqb6G5NBCzwiMxH7an.', 'admin', 'lucas.b@onthegosystems.com', '', '2018-09-23 12:27:50', '', 0, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_download_log`
--

CREATE TABLE `wp_wc_download_log` (
  `download_log_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip_address` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_wc_webhooks`
--

CREATE TABLE `wp_wc_webhooks` (
  `webhook_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `delivery_url` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `secret` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `topic` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_created_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_version` smallint(4) NOT NULL,
  `failure_count` smallint(10) NOT NULL DEFAULT '0',
  `pending_delivery` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_api_keys`
--

CREATE TABLE `wp_woocommerce_api_keys` (
  `key_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `permissions` varchar(10) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `consumer_key` char(64) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `consumer_secret` char(43) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `nonces` longtext COLLATE utf8mb4_unicode_520_ci,
  `truncated_key` char(7) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `last_access` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_attribute_taxonomies`
--

CREATE TABLE `wp_woocommerce_attribute_taxonomies` (
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `attribute_label` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `attribute_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `attribute_orderby` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `attribute_public` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_downloadable_product_permissions`
--

CREATE TABLE `wp_woocommerce_downloadable_product_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `download_id` varchar(36) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `order_key` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_email` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `downloads_remaining` varchar(9) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `access_granted` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access_expires` datetime DEFAULT NULL,
  `download_count` bigint(20) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_log`
--

CREATE TABLE `wp_woocommerce_log` (
  `log_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL,
  `level` smallint(4) NOT NULL,
  `source` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `context` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_order_itemmeta`
--

CREATE TABLE `wp_woocommerce_order_itemmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_order_items`
--

CREATE TABLE `wp_woocommerce_order_items` (
  `order_item_id` bigint(20) UNSIGNED NOT NULL,
  `order_item_name` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `order_item_type` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `order_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_payment_tokenmeta`
--

CREATE TABLE `wp_woocommerce_payment_tokenmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `payment_token_id` bigint(20) UNSIGNED NOT NULL,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_payment_tokens`
--

CREATE TABLE `wp_woocommerce_payment_tokens` (
  `token_id` bigint(20) UNSIGNED NOT NULL,
  `gateway_id` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_sessions`
--

CREATE TABLE `wp_woocommerce_sessions` (
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `session_key` char(32) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `session_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `session_expiry` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_woocommerce_sessions`
--

INSERT INTO `wp_woocommerce_sessions` (`session_id`, `session_key`, `session_value`, `session_expiry`) VALUES
(355, '1', 'a:13:{s:4:\"cart\";s:410:\"a:1:{s:32:\"6ea9ab1baa0efb9e19094440c317e21b\";a:11:{s:3:\"key\";s:32:\"6ea9ab1baa0efb9e19094440c317e21b\";s:10:\"product_id\";i:29;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:2;s:9:\"data_hash\";s:32:\"b5c1d5ca8bae6d4896cf1807cdf763f0\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:0:{}s:5:\"total\";a:0:{}}s:13:\"line_subtotal\";d:30;s:17:\"line_subtotal_tax\";i:0;s:10:\"line_total\";d:30;s:8:\"line_tax\";i:0;}}\";s:11:\"cart_totals\";s:406:\"a:15:{s:8:\"subtotal\";s:5:\"30.00\";s:12:\"subtotal_tax\";d:0;s:14:\"shipping_total\";s:5:\"10.00\";s:12:\"shipping_tax\";d:0;s:14:\"shipping_taxes\";a:0:{}s:14:\"discount_total\";d:0;s:12:\"discount_tax\";d:0;s:19:\"cart_contents_total\";s:5:\"30.00\";s:17:\"cart_contents_tax\";d:0;s:19:\"cart_contents_taxes\";a:0:{}s:9:\"fee_total\";s:4:\"0.00\";s:7:\"fee_tax\";d:0;s:9:\"fee_taxes\";a:0:{}s:5:\"total\";s:5:\"40.00\";s:9:\"total_tax\";d:0;}\";s:15:\"applied_coupons\";s:6:\"a:0:{}\";s:22:\"coupon_discount_totals\";s:6:\"a:0:{}\";s:26:\"coupon_discount_tax_totals\";s:6:\"a:0:{}\";s:21:\"removed_cart_contents\";s:856:\"a:2:{s:32:\"6ea9ab1baa0efb9e19094440c317e21b\";a:11:{s:3:\"key\";s:32:\"6ea9ab1baa0efb9e19094440c317e21b\";s:10:\"product_id\";i:29;s:12:\"variation_id\";i:0;s:9:\"variation\";a:0:{}s:8:\"quantity\";i:24;s:9:\"data_hash\";s:32:\"b5c1d5ca8bae6d4896cf1807cdf763f0\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:0:{}s:5:\"total\";a:0:{}}s:13:\"line_subtotal\";d:360;s:17:\"line_subtotal_tax\";i:0;s:10:\"line_total\";d:360;s:8:\"line_tax\";i:0;}s:32:\"38416b267cca5c39c2a1bdb41841bcce\";a:11:{s:3:\"key\";s:32:\"38416b267cca5c39c2a1bdb41841bcce\";s:10:\"product_id\";i:27;s:12:\"variation_id\";i:45;s:9:\"variation\";a:1:{s:14:\"attribute_kits\";s:9:\"Kit com 3\";}s:8:\"quantity\";i:1;s:9:\"data_hash\";s:32:\"5e6cb4abb1dd34c5574389d20fcda6e6\";s:13:\"line_tax_data\";a:2:{s:8:\"subtotal\";a:0:{}s:5:\"total\";a:0:{}}s:13:\"line_subtotal\";d:80;s:17:\"line_subtotal_tax\";i:0;s:10:\"line_total\";d:80;s:8:\"line_tax\";i:0;}}\";s:22:\"shipping_for_package_0\";s:956:\"a:2:{s:12:\"package_hash\";s:40:\"wc_ship_256b9379330fedc1308445f15a23b820\";s:5:\"rates\";a:3:{s:11:\"flat_rate:1\";O:16:\"WC_Shipping_Rate\":2:{s:7:\"\0*\0data\";a:6:{s:2:\"id\";s:11:\"flat_rate:1\";s:9:\"method_id\";s:9:\"flat_rate\";s:11:\"instance_id\";i:1;s:5:\"label\";s:9:\"Flat rate\";s:4:\"cost\";s:5:\"10.00\";s:5:\"taxes\";a:0:{}}s:12:\"\0*\0meta_data\";a:1:{s:5:\"Items\";s:13:\"Cap &times; 2\";}}s:15:\"free_shipping:5\";O:16:\"WC_Shipping_Rate\":2:{s:7:\"\0*\0data\";a:6:{s:2:\"id\";s:15:\"free_shipping:5\";s:9:\"method_id\";s:13:\"free_shipping\";s:11:\"instance_id\";i:5;s:5:\"label\";s:13:\"Free shipping\";s:4:\"cost\";s:4:\"0.00\";s:5:\"taxes\";a:0:{}}s:12:\"\0*\0meta_data\";a:1:{s:5:\"Items\";s:13:\"Cap &times; 2\";}}s:14:\"local_pickup:6\";O:16:\"WC_Shipping_Rate\":2:{s:7:\"\0*\0data\";a:6:{s:2:\"id\";s:14:\"local_pickup:6\";s:9:\"method_id\";s:12:\"local_pickup\";s:11:\"instance_id\";i:6;s:5:\"label\";s:12:\"Local pickup\";s:4:\"cost\";s:4:\"0.00\";s:5:\"taxes\";a:0:{}}s:12:\"\0*\0meta_data\";a:1:{s:5:\"Items\";s:13:\"Cap &times; 2\";}}}}\";s:25:\"previous_shipping_methods\";s:92:\"a:1:{i:0;a:3:{i:0;s:11:\"flat_rate:1\";i:1;s:15:\"free_shipping:5\";i:2;s:14:\"local_pickup:6\";}}\";s:22:\"shipping_method_counts\";s:14:\"a:1:{i:0;i:3;}\";s:8:\"customer\";s:714:\"a:26:{s:2:\"id\";s:1:\"1\";s:13:\"date_modified\";s:0:\"\";s:8:\"postcode\";s:0:\"\";s:4:\"city\";s:0:\"\";s:9:\"address_1\";s:0:\"\";s:7:\"address\";s:0:\"\";s:9:\"address_2\";s:0:\"\";s:5:\"state\";s:0:\"\";s:7:\"country\";s:2:\"BR\";s:17:\"shipping_postcode\";s:0:\"\";s:13:\"shipping_city\";s:0:\"\";s:18:\"shipping_address_1\";s:0:\"\";s:16:\"shipping_address\";s:0:\"\";s:18:\"shipping_address_2\";s:0:\"\";s:14:\"shipping_state\";s:0:\"\";s:16:\"shipping_country\";s:2:\"BR\";s:13:\"is_vat_exempt\";s:0:\"\";s:19:\"calculated_shipping\";s:0:\"\";s:10:\"first_name\";s:0:\"\";s:9:\"last_name\";s:0:\"\";s:7:\"company\";s:0:\"\";s:5:\"phone\";s:0:\"\";s:5:\"email\";s:26:\"lucas.b@onthegosystems.com\";s:19:\"shipping_first_name\";s:0:\"\";s:18:\"shipping_last_name\";s:0:\"\";s:16:\"shipping_company\";s:0:\"\";}\";s:10:\"wc_notices\";N;s:29:\"shipping_for_package_contents\";s:357:\"a:2:{s:12:\"package_hash\";s:40:\"wc_ship_d0daf304fca63cb4edc59b0714c4f33e\";s:5:\"rates\";a:1:{s:11:\"flat_rate:2\";O:16:\"WC_Shipping_Rate\":2:{s:7:\"\0*\0data\";a:6:{s:2:\"id\";s:11:\"flat_rate:2\";s:9:\"method_id\";s:9:\"flat_rate\";s:11:\"instance_id\";i:2;s:5:\"label\";s:9:\"Flat rate\";s:4:\"cost\";s:6:\"300.00\";s:5:\"taxes\";a:0:{}}s:12:\"\0*\0meta_data\";a:1:{s:5:\"Items\";s:0:\"\";}}}}\";s:23:\"chosen_shipping_methods\";s:29:\"a:1:{i:0;s:11:\"flat_rate:1\";}\";}', 1540235838);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zones`
--

CREATE TABLE `wp_woocommerce_shipping_zones` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `zone_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `zone_order` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_woocommerce_shipping_zones`
--

INSERT INTO `wp_woocommerce_shipping_zones` (`zone_id`, `zone_name`, `zone_order`) VALUES
(1, 'Brazil', 1),
(2, 'Rio de Janeiro', 2),
(3, 'Bairros Belo Horizonte', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zone_locations`
--

CREATE TABLE `wp_woocommerce_shipping_zone_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_woocommerce_shipping_zone_locations`
--

INSERT INTO `wp_woocommerce_shipping_zone_locations` (`location_id`, `zone_id`, `location_code`, `location_type`) VALUES
(4, 2, 'BR:RJ', 'state'),
(5, 1, 'BR', 'country'),
(6, 3, '30360-230', 'postcode');

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_shipping_zone_methods`
--

CREATE TABLE `wp_woocommerce_shipping_zone_methods` (
  `zone_id` bigint(20) UNSIGNED NOT NULL,
  `instance_id` bigint(20) UNSIGNED NOT NULL,
  `method_id` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `method_order` bigint(20) UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_woocommerce_shipping_zone_methods`
--

INSERT INTO `wp_woocommerce_shipping_zone_methods` (`zone_id`, `instance_id`, `method_id`, `method_order`, `is_enabled`) VALUES
(1, 1, 'flat_rate', 3, 1),
(0, 2, 'flat_rate', 1, 1),
(1, 3, 'correios-pac', 1, 1),
(1, 4, 'correios-sedex', 2, 1),
(1, 5, 'free_shipping', 4, 1),
(1, 6, 'local_pickup', 5, 1),
(2, 7, 'free_shipping', 1, 1),
(2, 8, 'flat_rate', 2, 1),
(3, 9, 'flat_rate', 1, 1),
(3, 10, 'correios-carta-registrada', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_tax_rates`
--

CREATE TABLE `wp_woocommerce_tax_rates` (
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_country` varchar(2) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `tax_rate_state` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `tax_rate` varchar(8) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `tax_rate_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `tax_rate_priority` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_compound` int(1) NOT NULL DEFAULT '0',
  `tax_rate_shipping` int(1) NOT NULL DEFAULT '1',
  `tax_rate_order` bigint(20) UNSIGNED NOT NULL,
  `tax_rate_class` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wp_woocommerce_tax_rate_locations`
--

CREATE TABLE `wp_woocommerce_tax_rate_locations` (
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `location_code` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `tax_rate_id` bigint(20) UNSIGNED NOT NULL,
  `location_type` varchar(40) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_comments`
--
ALTER TABLE `wp_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10)),
  ADD KEY `woo_idx_comment_type` (`comment_type`);

--
-- Indexes for table `wp_links`
--
ALTER TABLE `wp_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indexes for table `wp_options`
--
ALTER TABLE `wp_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`);

--
-- Indexes for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_posts`
--
ALTER TABLE `wp_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_terms`
--
ALTER TABLE `wp_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indexes for table `wp_term_relationships`
--
ALTER TABLE `wp_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indexes for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indexes for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indexes for table `wp_users`
--
ALTER TABLE `wp_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_login_key` (`user_login`),
  ADD KEY `user_nicename` (`user_nicename`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `wp_wc_download_log`
--
ALTER TABLE `wp_wc_download_log`
  ADD PRIMARY KEY (`download_log_id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `timestamp` (`timestamp`);

--
-- Indexes for table `wp_wc_webhooks`
--
ALTER TABLE `wp_wc_webhooks`
  ADD PRIMARY KEY (`webhook_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_woocommerce_api_keys`
--
ALTER TABLE `wp_woocommerce_api_keys`
  ADD PRIMARY KEY (`key_id`),
  ADD KEY `consumer_key` (`consumer_key`),
  ADD KEY `consumer_secret` (`consumer_secret`);

--
-- Indexes for table `wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `wp_woocommerce_attribute_taxonomies`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `attribute_name` (`attribute_name`(20));

--
-- Indexes for table `wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `wp_woocommerce_downloadable_product_permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `download_order_key_product` (`product_id`,`order_id`,`order_key`(16),`download_id`),
  ADD KEY `download_order_product` (`download_id`,`order_id`,`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `wp_woocommerce_log`
--
ALTER TABLE `wp_woocommerce_log`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `wp_woocommerce_order_itemmeta`
--
ALTER TABLE `wp_woocommerce_order_itemmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `order_item_id` (`order_item_id`),
  ADD KEY `meta_key` (`meta_key`(32));

--
-- Indexes for table `wp_woocommerce_order_items`
--
ALTER TABLE `wp_woocommerce_order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `wp_woocommerce_payment_tokenmeta`
--
ALTER TABLE `wp_woocommerce_payment_tokenmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `payment_token_id` (`payment_token_id`),
  ADD KEY `meta_key` (`meta_key`(32));

--
-- Indexes for table `wp_woocommerce_payment_tokens`
--
ALTER TABLE `wp_woocommerce_payment_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wp_woocommerce_sessions`
--
ALTER TABLE `wp_woocommerce_sessions`
  ADD PRIMARY KEY (`session_key`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `wp_woocommerce_shipping_zones`
--
ALTER TABLE `wp_woocommerce_shipping_zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `wp_woocommerce_shipping_zone_locations`
--
ALTER TABLE `wp_woocommerce_shipping_zone_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `location_type_code` (`location_type`(10),`location_code`(20));

--
-- Indexes for table `wp_woocommerce_shipping_zone_methods`
--
ALTER TABLE `wp_woocommerce_shipping_zone_methods`
  ADD PRIMARY KEY (`instance_id`);

--
-- Indexes for table `wp_woocommerce_tax_rates`
--
ALTER TABLE `wp_woocommerce_tax_rates`
  ADD PRIMARY KEY (`tax_rate_id`),
  ADD KEY `tax_rate_country` (`tax_rate_country`),
  ADD KEY `tax_rate_state` (`tax_rate_state`(2)),
  ADD KEY `tax_rate_class` (`tax_rate_class`(10)),
  ADD KEY `tax_rate_priority` (`tax_rate_priority`);

--
-- Indexes for table `wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `wp_woocommerce_tax_rate_locations`
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `tax_rate_id` (`tax_rate_id`),
  ADD KEY `location_type_code` (`location_type`(10),`location_code`(20));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_commentmeta`
--
ALTER TABLE `wp_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_comments`
--
ALTER TABLE `wp_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_links`
--
ALTER TABLE `wp_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_options`
--
ALTER TABLE `wp_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1283;

--
-- AUTO_INCREMENT for table `wp_postmeta`
--
ALTER TABLE `wp_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=319;

--
-- AUTO_INCREMENT for table `wp_posts`
--
ALTER TABLE `wp_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `wp_termmeta`
--
ALTER TABLE `wp_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wp_terms`
--
ALTER TABLE `wp_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wp_term_taxonomy`
--
ALTER TABLE `wp_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `wp_usermeta`
--
ALTER TABLE `wp_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `wp_users`
--
ALTER TABLE `wp_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wp_wc_download_log`
--
ALTER TABLE `wp_wc_download_log`
  MODIFY `download_log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_wc_webhooks`
--
ALTER TABLE `wp_wc_webhooks`
  MODIFY `webhook_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_api_keys`
--
ALTER TABLE `wp_woocommerce_api_keys`
  MODIFY `key_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_attribute_taxonomies`
--
ALTER TABLE `wp_woocommerce_attribute_taxonomies`
  MODIFY `attribute_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_downloadable_product_permissions`
--
ALTER TABLE `wp_woocommerce_downloadable_product_permissions`
  MODIFY `permission_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_log`
--
ALTER TABLE `wp_woocommerce_log`
  MODIFY `log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_order_itemmeta`
--
ALTER TABLE `wp_woocommerce_order_itemmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_order_items`
--
ALTER TABLE `wp_woocommerce_order_items`
  MODIFY `order_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_payment_tokenmeta`
--
ALTER TABLE `wp_woocommerce_payment_tokenmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_payment_tokens`
--
ALTER TABLE `wp_woocommerce_payment_tokens`
  MODIFY `token_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_sessions`
--
ALTER TABLE `wp_woocommerce_sessions`
  MODIFY `session_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zones`
--
ALTER TABLE `wp_woocommerce_shipping_zones`
  MODIFY `zone_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zone_locations`
--
ALTER TABLE `wp_woocommerce_shipping_zone_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wp_woocommerce_shipping_zone_methods`
--
ALTER TABLE `wp_woocommerce_shipping_zone_methods`
  MODIFY `instance_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wp_woocommerce_tax_rates`
--
ALTER TABLE `wp_woocommerce_tax_rates`
  MODIFY `tax_rate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wp_woocommerce_tax_rate_locations`
--
ALTER TABLE `wp_woocommerce_tax_rate_locations`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wp_wc_download_log`
--
ALTER TABLE `wp_wc_download_log`
  ADD CONSTRAINT `fk_wc_download_log_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `wp_woocommerce_downloadable_product_permissions` (`permission_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
