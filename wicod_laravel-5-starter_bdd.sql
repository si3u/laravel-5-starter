-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 23 Octobre 2017 à 19:32
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `github_package_starter_bpo`
--

-- --------------------------------------------------------

--
-- Structure de la table `actus`
--

CREATE TABLE `actus` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_tagged` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_from` timestamp NULL DEFAULT NULL,
  `active_to` timestamp NULL DEFAULT NULL,
  `total_views` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `facebook_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `twitter_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `pinterest_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `googleplus_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_tagged` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_from` timestamp NULL DEFAULT NULL,
  `active_to` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `total_views` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `facebook_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `twitter_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `pinterest_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `googleplus_shares` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article_categories`
--

CREATE TABLE `article_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active_from` timestamp NULL DEFAULT NULL,
  `active_to` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `changelogs`
--

CREATE TABLE `changelogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_at` date NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_level` smallint(6) DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_level` smallint(6) NOT NULL DEFAULT '10',
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dropzone`
--

CREATE TABLE `dropzone` (
  `id` int(10) UNSIGNED NOT NULL,
  `relation_id` int(10) UNSIGNED NOT NULL,
  `relation_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_read` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `helpful_yes` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `helpful_no` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `list_order` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feedback_contact_us`
--

CREATE TABLE `feedback_contact_us` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `client_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_agent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `log_activities`
--

CREATE TABLE `log_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `log_admin_activities`
--

CREATE TABLE `log_admin_activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `before` text COLLATE utf8mb4_unicode_ci,
  `after` text COLLATE utf8mb4_unicode_ci,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `log_logins`
--

CREATE TABLE `log_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_agent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_05_09_154236_create_tags_table', 1),
(4, '2017_06_17_071843_create_log_logins_table', 1),
(5, '2017_06_17_113455_create_log_activities_table', 1),
(6, '2017_06_17_142413_create_log_admin_activities_table', 1),
(7, '2017_06_18_143920_create_navigation_admin_table', 1),
(9, '2017_06_18_201544_create_navigation_admin_role_pivot_table', 2),
(10, '2017_06_19_060927_create_navigation_website_table', 2),
(11, '2017_06_19_122044_create_roles_table', 2),
(12, '2017_06_19_122132_create_role_user_pivot_table', 2),
(13, '2017_06_20_103224_create_notifications_table', 2),
(14, '2017_06_20_112814_create_changelogs_table', 2),
(15, '2017_06_20_114920_create_testimonials_table', 2),
(16, '2017_06_20_120924_create_countries_table', 2),
(17, '2017_06_20_124039_create_provinces_table', 2),
(18, '2017_06_20_124058_create_cities_table', 2),
(19, '2017_06_20_124120_create_suburbs_table', 2),
(20, '2017_06_20_164159_create_feedback_contact_us_table', 2),
(21, '2017_06_21_101323_create_banners_table', 2),
(22, '2017_07_04_175040_create_subscription_plans_table', 2),
(23, '2017_07_04_175120_create_subscription_plan_features_table', 2),
(24, '2017_07_05_094620_create_subscription_plan_feature_subscription_plan_pivot_table', 2),
(25, '2017_07_08_094112_create_faq_categories_table', 2),
(26, '2017_07_08_102625_create_faqs_table', 2),
(27, '2017_07_10_152224_create_article_categories_table', 2),
(28, '2017_07_10_165218_create_articles_table', 2),
(29, '2017_10_06_165218_create_actus_table', 2),
(30, '2017_10_06_165218_create_dropzone_table', 2),
(31, '2017_10_06_165219_create_parameters_table', 2),
(32, '2017_06_18_175402_create_user_invites_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `navigation_admin`
--

CREATE TABLE `navigation_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `help_index_title` text COLLATE utf8mb4_unicode_ci,
  `help_index_content` text COLLATE utf8mb4_unicode_ci,
  `help_create_title` text COLLATE utf8mb4_unicode_ci,
  `help_create_content` text COLLATE utf8mb4_unicode_ci,
  `help_edit_title` text COLLATE utf8mb4_unicode_ci,
  `help_edit_content` text COLLATE utf8mb4_unicode_ci,
  `list_order` int(11) NOT NULL DEFAULT '999',
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `url_parent_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `navigation_admin`
--

INSERT INTO `navigation_admin` (`id`, `title`, `description`, `slug`, `url`, `icon`, `help_index_title`, `help_index_content`, `help_create_title`, `help_create_content`, `help_edit_title`, `help_edit_content`, `list_order`, `is_hidden`, `parent_id`, `url_parent_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Tableau de Bord', 'Tableau de Bord', '/', '/admin', 'dashboard', '', '', '', '', '', '', 1, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(2, 'Analytics', 'Google Analytics', 'analytics', '/admin/analytics', 'line-chart', '', '', '', '', '', '', 2, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(3, 'Sommaire', '', '', '/admin/analytics', 'star-half-o', '', '', '', '', '', '', 1, 0, 2, 2, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(4, 'Périphériques', '', 'devices', '/admin/analytics/devices', 'tablet', '', '', '', '', '', '', 2, 0, 2, 2, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(5, 'Démographique', '', 'demographics', '/admin/analytics/demographics', 'female', '', '', '', '', '', '', 5, 0, 2, 2, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(6, 'Visites and Références', '', 'visits-and-referrals', '/admin/analytics/visits-and-referrals', 'cloud', '', '', '', '', '', '', 3, 0, 2, 2, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(7, 'Intérêts', '', 'interests', '/admin/analytics/interests', 'heart', '', '', '', '', '', '', 4, 0, 2, 2, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(8, 'Dernières activités', 'Dernières activités', 'latest-activity', '/admin/latest-activity', 'history', '', '', '', '', '', '', 3, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(9, 'Website', '', 'website', '/admin/latest-activity/website', 'home', '', '', '', '', '', '', 1, 0, 8, 8, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(10, 'Administration', 'Administration', 'admin', '/admin/latest-activity/admin', 'lock', '', '', '', '', '', '', 2, 0, 8, 8, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(11, 'Commentaires', 'Commentaires', 'testimonials', '/admin/general/testimonials', 'commenting-o', '', '', '', '', '', '', 3, 0, 17, 17, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(12, 'Locations', '', 'locations', '/admin/general/locations', 'globe', '', '', '', '', '', '', 4, 0, 17, 17, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(13, 'Pays', 'Pays', 'countries', '/admin/general/locations/countries', 'map-marker', '', '', '', '', '', '', 4, 0, 12, 12, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(14, 'Régions', 'Régions', 'provinces', '/admin/general/locations/provinces', 'map-marker', '', '', '', '', '', '', 3, 0, 12, 12, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(15, 'Villes', '', 'cities', '/admin/general/locations/cities', 'map-marker', '', '', '', '', '', '', 2, 0, 12, 12, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(16, 'Rues', '', 'suburbs', '/admin/general/locations/suburbs', 'map-marker', '', '', '', '', '', '', 1, 0, 12, 12, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(17, 'Général', 'Général Website', 'general', '/admin/general', 'cubes', '', '', '', '', '', '', 5, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(18, 'Rapports', '', 'reports', '/admin/reports', 'bar-chart', '', '', '', '', '', '', 7, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(19, 'Sommaire', '', 'summary', '/admin/reports/summary', 'align-left', '', '', '', '', '', '', 1, 0, 18, 18, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(20, 'Contact', '', 'contact-us', '/admin/reports/contact-us', 'comments-o', '', '', '', '', '', '', 2, 0, 18, 18, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(21, 'Paramètres', '', 'settings', '/admin/settings', 'cogs', '', '', '', '', '', '', 8, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(22, 'Website', '', 'website', '/admin/settings/website', 'unlock-alt', '', '', '', '', '', '', 1, 0, 21, 21, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(23, 'Administration', '', 'admin', '/admin/settings/admin', 'lock', '', '', '', '', '', '', 2, 0, 21, 21, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(24, 'Navigation', '', 'navigation', '/admin/settings/website/navigation', 'align-center', '', '', '', '', '', '', 1, 0, 22, 22, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(25, 'Changelogs', '', 'changelogs', '/admin/settings/website/changelogs', 'file-text-o', '', '', '', '', '', '', 2, 0, 22, 22, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(26, 'Navigation', '', 'navigation', '/admin/settings/admin/navigation', 'align-center', '', '', '', '', '', '', 1, 0, 23, 23, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(27, 'Administrateurs', '', 'users', '/admin/settings/admin/users', 'users', '', '', '', '', '', '', 2, 0, 23, 23, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(28, 'Admin Invités', '', 'invites', '/admin/settings/admin/users/invites', '', '', '', '', '', '', '', 1, 1, 27, 27, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(29, 'Profil', '', 'profile', '/admin/profile', 'user', '', '', '', '', '', '', 9, 1, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(30, 'Ordre de Navigation', 'Ordre de Navigation', 'order', '/admin/settings/admin/navigation/order', 'list-ol', '', '', '', '', '', '', 1, 1, 26, 26, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(31, 'Ordre de Navigation', 'Ordre de Navigation', 'order', '/admin/settings/website/navigation/order', 'list-ol', '', '', '', '', '', '', 1, 1, 24, 24, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(32, 'Bannières', 'Bannières', 'banners', '/admin/general/banners', 'image', '', '', '', '', '', '', 2, 0, 17, 17, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(33, 'Souscription Plans', 'Souscription Plans', 'subscription-plans', '/admin/settings/website/subscription-plans', 'money', '', '', '', '', '', '', 3, 0, 22, 22, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(34, 'Rôles', 'Rôles', 'roles', '/admin/settings/roles', 'universal-access', '', '', '', '', '', '', 3, 0, 21, 21, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(35, 'Fonctionnalités', 'Fonctionnalités', 'features', '/admin/settings/website/subscription-plans/features', 'tags', '', '', '', '', '', '', 1, 0, 33, 33, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(36, 'Réalisations', 'Réalisations', 'blog', '/admin/blog', 'newspaper-o', '', '', '', '', '', '', 4, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(37, 'Articles', 'Articles', 'articles', '/admin/blog/articles', 'newspaper-o', '', '', '', '', '', '', 1, 0, 36, 36, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(38, 'Catégories', 'Catégories', 'categories', '/admin/blog/categories', 'cubes', '', '', '', '', '', '', 2, 0, 36, 36, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(39, '&Eacute ', 'tiquettes', 'Tags', 'tags', '/admin/general/tags', '', '', '', '', '', '', 0, 1, 0, 17, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(40, 'FAQ', 'FAQ', 'faqs', '/admin/faqs', 'question', '', '', '', '', '', '', 6, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(41, 'FAQ Questions', 'FAQ Questions', '', '/admin/faqs', 'question', '', '', '', '', '', '', 2, 0, 40, 40, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(42, 'Catégories', 'Catégories', 'categories', '/admin/faqs/categories', 'cubes', '', '', '', '', '', '', 1, 0, 40, 40, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(43, 'Paramètres', 'Paramètres', 'parameters', '/admin/settings/parameters', 'cog', '', '', '', '', '', '', 4, 0, 21, 21, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(44, 'Actualités', 'Actualités', 'actus', '/admin/actus', 'cube', '', '', '', '', '', '', 4, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `navigation_admin_role`
--

CREATE TABLE `navigation_admin_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `navigation_admin_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `navigation_admin_role`
--

INSERT INTO `navigation_admin_role` (`id`, `navigation_admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(2, 2, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(3, 2, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(4, 3, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(5, 3, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(6, 4, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(7, 4, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(8, 5, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(9, 5, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(10, 6, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(11, 6, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(12, 7, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(13, 7, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(14, 8, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(15, 9, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(16, 10, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(17, 11, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(18, 12, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(19, 13, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(20, 14, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(21, 15, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(22, 16, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(23, 17, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(24, 18, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(25, 19, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(26, 20, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(27, 21, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(28, 22, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(29, 23, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(30, 24, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(31, 25, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(32, 26, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(33, 27, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(34, 28, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(35, 29, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(36, 30, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(37, 31, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(38, 32, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(39, 33, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(40, 34, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(41, 35, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(42, 36, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(43, 37, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(44, 38, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(45, 39, 17, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(46, 40, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(47, 41, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(48, 42, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(49, 43, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(50, 44, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24');

-- --------------------------------------------------------

--
-- Structure de la table `navigation_website`
--

CREATE TABLE `navigation_website` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `html_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `html_description` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_main` int(11) DEFAULT NULL,
  `list_main_order` int(11) DEFAULT NULL,
  `is_footer` int(11) DEFAULT NULL,
  `list_footer_order` int(11) DEFAULT NULL,
  `is_hidden` int(11) NOT NULL DEFAULT '0',
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `url_parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `navigation_website`
--

INSERT INTO `navigation_website` (`id`, `title`, `description`, `html_title`, `html_description`, `slug`, `url`, `icon`, `is_main`, `list_main_order`, `is_footer`, `list_footer_order`, `is_hidden`, `parent_id`, `url_parent_id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'Accueil', 'Accueil', 'Accueil', 'Accueil', '/', '', '', 1, 1, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(2, 'A Propos', 'A Propos', 'A Propos', 'A Propos', 'A-propos', '/a-propos', '', 1, 2, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(3, 'Contact', 'Contact', 'Contact', 'Contact', 'contact', '/contact', '', 1, 3, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(4, 'Other Pages', 'Other Pages', 'Other Pages', 'Other Pages', 'pages', '/pages', '', 1, 7, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(5, 'Pricing', 'Pricing', 'Pricing', 'Pricing', 'pricing', '/pricing', '', 1, 4, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(6, '1 Column Page', '1 Column Page', '1 Column Page', '1 Column Page', '1-column', '/pages/1-column', '', 1, 1, 0, NULL, 0, 4, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(7, '2 Column Page', '2 Column Page', '2 Column Page', '2 Column Page', '2-column', '/pages/2-column', '', 1, 2, 0, NULL, 0, 4, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(8, '3 Column Page', '3 Column Page', '3 Column Page', '3 Column Page', '3-column', '/pages/3-column', '', 1, 3, 0, NULL, 0, 4, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(9, '4 Column Page', '4 Column Page', '4 Column Page', '4 Column Page', '4-column', '/pages/4-column', '', 1, 4, 0, NULL, 0, 4, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(10, 'Changelog', 'Changelog', 'Changelog', 'Changelog', 'changelog', '/changelog', '', 1, 6, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(11, 'Commentaires', 'Commentaires', 'Commentaires', 'Commentaires', 'commentaires', '/commentaires', '', 1, 5, 0, NULL, 0, 0, 0, '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parameters`
--

CREATE TABLE `parameters` (
  `id` int(10) UNSIGNED NOT NULL,
  `params` char(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` datetime NOT NULL,
  `updated_by` datetime NOT NULL,
  `deleted_by` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `parameters`
--

INSERT INTO `parameters` (`id`, `params`, `value`, `deleted_at`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'keywords', '[\"mot\",\"mots\",\"deux mots\"]', NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'description', '\"Description Description Description Description Description Description Description\"', NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'horaires', '{\"open1_lundi\":\"10h00\",\"close1_lundi\":\"12h00\",\"open2_lundi\":\"14h00\",\"close2_lundi\":\"18h00\",\"open1_mardi\":\"10h00\",\"close1_mardi\":\"12h00\",\"open2_mardi\":\"14h00\",\"close2_mardi\":\"18h00\",\"open1_mercredi\":\"10h00\",\"close1_mercredi\":\"12h00\",\"open2_mercredi\":\"ferm\\\\u00e9\",\"close2_mercredi\":null,\"open1_jeudi\":\"10h00\",\"close1_jeudi\":\"12h00\",\"open2_jeudi\":\"14h00\",\"close2_jeudi\":\"18h00\",\"open1_vendredi\":\"10h00\",\"close1_vendredi\":\"12h00\",\"open2_vendredi\":\"14h00\",\"close2_vendredi\":\"18h00\",\"open1_samedi\":\"10h00\",\"close1_samedi\":\"12h00\",\"open2_samedi\":\"ferm\\\\u00e9\",\"close2_samedi\":null}', NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'infos', '{\"nom\":\"NOM\",\"prenom\":\"PRENOM\",\"societe\":\"SOCIETE\",\"slogan\":null,\"siret\":\"123456789 12345\",\"statut\":\"STATUT\",\"capital\":\"36\",\"telfixe\":\"01 23 45 67 89\",\"telmobile\":null,\"rue\":\"\",\"cp\":\"\",\"ville\":\"\",\"region\":\"\",\"longitude\":\"47.99567438543637\",\"latitude\":\"6.595046332478518\"}', NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'socials', '{\"facebookappid\":\"12345678\",\"twitterpage\":\"@twitterpage\"}', NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_level` smallint(6) DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyword` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `roles`
--

INSERT INTO `roles` (`id`, `icon`, `name`, `slug`, `keyword`, `summary`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'user', 'Website', '/', 'website', NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, 0, 0, NULL),
(2, 'user-secret', 'Basic Admin', '/admin', 'admin', NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, 0, 0, NULL),
(3, 'user-circle', 'Analytics', '/admin', 'analytics', NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, 0, 0, NULL),
(4, 'user-secret', 'Admin', '/admin', 'admin_super', NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, 0, 0, NULL),
(5, 'universal-access', 'Developer', '/admin', 'developer', NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(2, 4, 1, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(3, 5, 1, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(4, 3, 1, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(5, 2, 2, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(6, 4, 2, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(7, 5, 2, '2017-10-23 17:30:23', '2017-10-23 17:30:23'),
(8, 2, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(9, 4, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(10, 5, 3, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(11, 2, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(12, 4, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24'),
(13, 5, 4, '2017-10-23 17:30:24', '2017-10-23 17:30:24');

-- --------------------------------------------------------

--
-- Structure de la table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `subscription_plans`
--

INSERT INTO `subscription_plans` (`id`, `is_featured`, `title`, `summary`, `cost`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 0, 'Basic', '', '19', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(2, 1, 'Plus', '', '99', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(3, 0, 'Ultra', '', '199', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `subscription_plan_features`
--

CREATE TABLE `subscription_plan_features` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `subscription_plan_features`
--

INSERT INTO `subscription_plan_features` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, '<strong>1</strong> User', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(2, '<strong>5</strong> Projects', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(3, '<strong>Unlimited</strong> Email Accounts', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(4, '<strong>10GB</strong> Disk Space', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(5, '<strong>100GB</strong> Monthly Bandwidth', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(6, '<strong>10</strong> User', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(7, '<strong>500</strong> Projects', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(8, '<strong>Unlimited</strong> Email Accounts', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(9, '<strong>1000GB</strong> Disk Space', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(10, '<strong>10000GB</strong> Monthly Bandwidth', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(11, '<strong>Unlimted</strong> Users', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(12, '<strong>Unlimited</strong> Projects', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(13, '<strong>Unlimited</strong> Email Accounts', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(14, '<strong>10000GB</strong> Disk Space', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL),
(15, '<strong>Unlimited</strong> Monthly Bandwidth', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `subscription_plan_feature_pivot`
--

CREATE TABLE `subscription_plan_feature_pivot` (
  `id` int(10) UNSIGNED NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL DEFAULT '999',
  `subscription_plan_feature_id` int(10) UNSIGNED NOT NULL,
  `subscription_plan_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `subscription_plan_feature_pivot`
--

INSERT INTO `subscription_plan_feature_pivot` (`id`, `list_order`, `subscription_plan_feature_id`, `subscription_plan_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 1),
(5, 5, 5, 1),
(6, 1, 5, 2),
(7, 2, 6, 2),
(8, 3, 7, 2),
(9, 4, 8, 2),
(10, 5, 9, 2),
(11, 6, 10, 2),
(12, 1, 10, 3),
(13, 2, 11, 3),
(14, 3, 12, 3),
(15, 4, 13, 3),
(16, 5, 14, 3),
(17, 6, 15, 3);

-- --------------------------------------------------------

--
-- Structure de la table `suburbs`
--

CREATE TABLE `suburbs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zoom_level` smallint(6) DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taggables`
--

CREATE TABLE `taggables` (
  `id` int(10) UNSIGNED NOT NULL,
  `taggable_id` int(10) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rgt` int(11) DEFAULT NULL,
  `depth` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `list_order` int(10) UNSIGNED NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cellphone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sound` tinyint(1) NOT NULL DEFAULT '1',
  `born_at` date DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `cellphone`, `telephone`, `image`, `gender`, `sound`, `born_at`, `password`, `password_updated_at`, `remember_token`, `confirmation_token`, `logged_in_at`, `created_at`, `updated_at`, `confirmed_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Admin', 'Admin', 'admin@mail.com', '01 23 45 67 89', NULL, NULL, 'male', 1, NULL, '$2y$10$I5zvOuIpsrZebOSxihRqN.agkafw7RRUWn8lac1rCNAI5aMsau6Qa', NULL, NULL, NULL, NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, NULL),
(2, 'Ben-Piet', 'O\'Callaghan', 'bpocallaghan@gmail.com', '123456789', NULL, NULL, 'ninja', 1, NULL, '$2y$10$EdQmlF38HMeVUTGK/7Rxt.sexWL4oZlRLTmaVcSx8GB4j38ioshZq', NULL, NULL, NULL, NULL, '2017-10-23 17:30:23', '2017-10-23 17:30:23', '2017-10-23 17:30:23', NULL, NULL),
(3, 'Github', 'Administrator', 'github@bpocallaghan.co.za', '123456789', NULL, NULL, 'male', 1, NULL, '$2y$10$rDMvuP5c1Hmi67ynzbzEGuLnLfTjkKrXbjqOCHKYfT2UiAJl.qmmW', NULL, NULL, NULL, NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, NULL),
(4, 'Admin', 'Laravel Starter', 'admin@laravel-admin.dev', '123456789', NULL, NULL, 'male', 1, NULL, '$2y$10$pV7kp4NvCcMGrqrchy2upup1IqRtINvewmiBjhpeR5DQ30uTJCUyC', NULL, NULL, NULL, NULL, '2017-10-23 17:30:24', '2017-10-23 17:30:24', '2017-10-23 17:30:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_invites`
--

CREATE TABLE `user_invites` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invited_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `claimed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actus`
--
ALTER TABLE `actus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `actus_id_unique` (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articles_id_unique` (`id`);

--
-- Index pour la table `article_categories`
--
ALTER TABLE `article_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `article_categories_id_unique` (`id`),
  ADD KEY `article_categories_name_index` (`name`);

--
-- Index pour la table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_id_unique` (`id`);

--
-- Index pour la table `changelogs`
--
ALTER TABLE `changelogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `changelogs_id_unique` (`id`),
  ADD KEY `changelogs_version_index` (`version`),
  ADD KEY `changelogs_date_at_index` (`date_at`);

--
-- Index pour la table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_id_unique` (`id`);

--
-- Index pour la table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_id_unique` (`id`);

--
-- Index pour la table `dropzone`
--
ALTER TABLE `dropzone`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dropzone_id_unique` (`id`),
  ADD KEY `dropzone_relation_id_index` (`relation_id`);

--
-- Index pour la table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faqs_id_unique` (`id`),
  ADD KEY `faqs_question_index` (`question`),
  ADD KEY `faqs_slug_index` (`slug`),
  ADD KEY `faqs_category_id_index` (`category_id`);

--
-- Index pour la table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_categories_id_unique` (`id`),
  ADD KEY `faq_categories_name_index` (`name`);

--
-- Index pour la table `feedback_contact_us`
--
ALTER TABLE `feedback_contact_us`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feedback_contact_us_id_unique` (`id`);

--
-- Index pour la table `log_activities`
--
ALTER TABLE `log_activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log_activities_id_unique` (`id`),
  ADD KEY `log_activities_subject_id_index` (`subject_id`),
  ADD KEY `log_activities_subject_type_index` (`subject_type`),
  ADD KEY `log_activities_user_id_index` (`user_id`);

--
-- Index pour la table `log_admin_activities`
--
ALTER TABLE `log_admin_activities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log_admin_activities_id_unique` (`id`),
  ADD KEY `log_admin_activities_subject_id_index` (`subject_id`),
  ADD KEY `log_admin_activities_subject_type_index` (`subject_type`),
  ADD KEY `log_admin_activities_user_id_index` (`user_id`);

--
-- Index pour la table `log_logins`
--
ALTER TABLE `log_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log_logins_id_unique` (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `navigation_admin`
--
ALTER TABLE `navigation_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `navigation_admin_id_unique` (`id`);

--
-- Index pour la table `navigation_admin_role`
--
ALTER TABLE `navigation_admin_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `navigation_admin_role_id_unique` (`id`),
  ADD KEY `navigation_admin_role_navigation_admin_id_index` (`navigation_admin_id`),
  ADD KEY `navigation_admin_role_role_id_index` (`role_id`);

--
-- Index pour la table `navigation_website`
--
ALTER TABLE `navigation_website`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `navigation_website_id_unique` (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Index pour la table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parameters_id_unique` (`id`),
  ADD UNIQUE KEY `parameters_params_unique` (`params`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provinces_id_unique` (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_id_unique` (`id`),
  ADD UNIQUE KEY `roles_keyword_unique` (`keyword`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_user_id_unique` (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Index pour la table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_plans_id_unique` (`id`);

--
-- Index pour la table `subscription_plan_features`
--
ALTER TABLE `subscription_plan_features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_plan_features_id_unique` (`id`);

--
-- Index pour la table `subscription_plan_feature_pivot`
--
ALTER TABLE `subscription_plan_feature_pivot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscription_plan_feature_pivot_id_unique` (`id`);

--
-- Index pour la table `suburbs`
--
ALTER TABLE `suburbs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suburbs_id_unique` (`id`);

--
-- Index pour la table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taggables_taggable_id_index` (`taggable_id`),
  ADD KEY `taggables_taggable_type_index` (`taggable_type`),
  ADD KEY `taggables_tag_id_index` (`tag_id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`),
  ADD UNIQUE KEY `tags_name_unique` (`name`);

--
-- Index pour la table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `testimonials_id_unique` (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_index` (`id`);

--
-- Index pour la table `user_invites`
--
ALTER TABLE `user_invites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_invites_id_unique` (`id`),
  ADD UNIQUE KEY `user_invites_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actus`
--
ALTER TABLE `actus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `article_categories`
--
ALTER TABLE `article_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `changelogs`
--
ALTER TABLE `changelogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `dropzone`
--
ALTER TABLE `dropzone`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `feedback_contact_us`
--
ALTER TABLE `feedback_contact_us`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `log_activities`
--
ALTER TABLE `log_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `log_admin_activities`
--
ALTER TABLE `log_admin_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `log_logins`
--
ALTER TABLE `log_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `navigation_admin`
--
ALTER TABLE `navigation_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `navigation_admin_role`
--
ALTER TABLE `navigation_admin_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `navigation_website`
--
ALTER TABLE `navigation_website`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `subscription_plans`
--
ALTER TABLE `subscription_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `subscription_plan_features`
--
ALTER TABLE `subscription_plan_features`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `subscription_plan_feature_pivot`
--
ALTER TABLE `subscription_plan_feature_pivot`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `suburbs`
--
ALTER TABLE `suburbs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user_invites`
--
ALTER TABLE `user_invites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `dropzone`
--
ALTER TABLE `dropzone`
  ADD CONSTRAINT `dropzone_relation_id_foreign` FOREIGN KEY (`relation_id`) REFERENCES `actus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
