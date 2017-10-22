-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Dim 22 Octobre 2017 à 13:51
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
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `slug` varchar(200) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `is_tagged` enum('no','yes') NOT NULL DEFAULT 'no',
  `active_from` datetime NOT NULL,
  `active_to` datetime DEFAULT NULL,
  `facebook_shares` int(11) NOT NULL,
  `twitter_shares` int(11) NOT NULL,
  `pinterest_shares` int(11) NOT NULL,
  `googleplus_shares` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_tagged` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
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
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8mb4_unicode_ci NOT NULL,
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

--
-- Contenu de la table `log_activities`
--

INSERT INTO `log_activities` (`id`, `title`, `description`, `subject_id`, `subject_type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Login', 'Admin Admin s\'est Connecté.', NULL, NULL, 1, '2017-10-11 08:05:29', '2017-10-11 08:05:29');

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

--
-- Contenu de la table `log_logins`
--

INSERT INTO `log_logins` (`id`, `username`, `status`, `role`, `client_ip`, `client_agent`, `created_at`) VALUES
(1, 'admin@mail.com', 'success', 'admin', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:57.0) Gecko/20100101 Firefox/57.0', '2017-10-11 08:05:29');

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
(3, '2017_06_17_071843_create_log_logins_table', 1),
(4, '2017_06_17_113455_create_log_activities_table', 1),
(5, '2017_06_17_142413_create_log_admin_activities_table', 1),
(6, '2017_06_18_143920_create_navigation_admin_table', 1),
(7, '2017_06_18_175402_create_user_invites_table', 1),
(8, '2017_06_18_201544_create_navigation_admin_role_pivot_table', 1),
(9, '2017_06_19_060927_create_navigation_website_table', 1),
(10, '2017_06_19_122044_create_roles_table', 1),
(11, '2017_06_19_122132_create_role_user_pivot_table', 1),
(12, '2017_06_20_103224_create_notifications_table', 1),
(13, '2017_06_20_112814_create_changelogs_table', 1),
(14, '2017_06_20_114920_create_testimonials_table', 1),
(15, '2017_06_20_120924_create_countries_table', 1),
(16, '2017_06_20_124039_create_provinces_table', 1),
(17, '2017_06_20_124058_create_cities_table', 1),
(18, '2017_06_20_124120_create_suburbs_table', 1),
(19, '2017_06_20_164159_create_feedback_contact_us_table', 1),
(20, '2017_06_21_101323_create_banners_table', 1),
(21, '2017_07_04_175040_create_subscription_plans_table', 1),
(22, '2017_07_04_175120_create_subscription_plan_features_table', 1),
(23, '2017_07_05_094620_create_subscription_plan_feature_subscription_plan_pivot_table', 1),
(24, '2017_07_05_143321_create_tags_table', 1),
(25, '2017_07_08_094112_create_faq_categories_table', 1),
(26, '2017_07_08_102625_create_faqs_table', 1),
(27, '2017_07_10_152224_create_article_categories_table', 1),
(28, '2017_07_10_165218_create_articles_table', 1),
(29, '2016_05_09_154236_create_tags_table', 2);

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
(1, 'Tableau de Bord', 'Tableau de Bord', '/', '/admin', 'dashboard', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 0, 0, '2017-09-20 08:53:54', '2017-09-21 09:12:13', NULL, 0, 1, NULL),
(2, 'Analytics', 'Google Analytics', 'analytics', '/admin/analytics', 'line-chart', NULL, NULL, NULL, NULL, NULL, NULL, 9, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:19', NULL, 0, 1, NULL),
(3, 'Sommaire', 'Sommaire Analytics', '/', '/admin/analytics', 'star-half-o', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 2, 2, '2017-09-20 08:53:54', '2017-10-07 08:09:01', NULL, 0, 1, NULL),
(4, 'Périphériques', 'Périphériques', 'devices', '/admin/analytics/devices', 'tablet', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 2, 2, '2017-09-20 08:53:54', '2017-10-07 08:10:38', NULL, 0, 1, NULL),
(5, 'Démographique', 'Démographique', 'demographics', '/admin/analytics/demographics', 'map-marker', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 2, 2, '2017-09-20 08:53:54', '2017-10-07 08:03:38', NULL, 0, 1, NULL),
(6, 'Visites et Références', 'Visites et Références', 'visits-and-referrals', '/admin/analytics/visits-and-referrals', 'cloud', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 2, 2, '2017-09-20 08:53:54', '2017-10-07 08:08:04', NULL, 0, 1, NULL),
(7, 'Interêts', 'Par Intérêts', 'interests', '/admin/analytics/interests', 'heart', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 2, 2, '2017-09-20 08:53:54', '2017-10-07 08:04:54', NULL, 0, 1, NULL),
(8, 'Activités', 'Dernières activités', 'latest-activity', '/admin/latest-activity', 'history', NULL, NULL, NULL, NULL, NULL, NULL, 10, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:19', NULL, 0, 1, NULL),
(9, 'Website', 'Dernières activités Website', 'website', '/admin/latest-activity/website', 'home', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 8, 8, '2017-09-20 08:53:54', '2017-10-07 08:07:33', NULL, 0, 0, NULL),
(10, 'Admin', 'Dernières activités', 'admin', '/admin/latest-activity/admin', 'lock', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 8, 8, '2017-09-20 08:53:54', '2017-10-07 08:01:08', NULL, 0, 0, NULL),
(11, 'Commentaires', 'Commentaires', 'testimonials', '/admin/general/testimonials', 'commenting-o', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 17, 17, '2017-09-20 08:53:54', '2017-10-07 08:02:53', NULL, 0, 1, NULL),
(12, 'Locations', 'Locations', 'locations', '/admin/general/locations', 'globe', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 17, 17, '2017-09-20 08:53:54', '2017-10-07 08:05:19', NULL, 0, 0, NULL),
(13, 'Pays', 'Pays', 'countries', '/admin/general/locations/countries', 'map-marker', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 12, 12, '2017-09-20 08:53:54', '2017-10-07 08:11:10', NULL, 0, 1, NULL),
(14, 'Département', 'Départements', 'provinces', '/admin/general/locations/provinces', 'map-marker', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 12, 12, '2017-09-20 08:53:54', '2017-10-07 08:03:49', NULL, 0, 1, NULL),
(15, 'Ville', 'Commune', 'cities', '/admin/general/locations/cities', 'map-marker', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 12, 12, '2017-09-20 08:53:54', '2017-10-07 08:08:18', NULL, 0, 1, NULL),
(16, 'Rue', 'Rue', 'suburbs', '/admin/general/locations/suburbs', 'map-marker', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 12, 12, '2017-09-20 08:53:54', '2017-10-07 08:10:07', NULL, 0, 1, NULL),
(17, 'Général', 'Général Website', 'general', '/admin/general', 'cubes', NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:48', NULL, 0, 1, NULL),
(18, 'Rapports', 'Rapports de Contact', 'reports', '/admin/reports', 'bar-chart', NULL, NULL, NULL, NULL, NULL, NULL, 7, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:19', NULL, 0, 1, NULL),
(19, 'Sommaire', 'Sommaire rapports', 'summary', '/admin/reports/summary', 'align-left', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 18, 18, '2017-09-20 08:53:54', '2017-10-07 08:08:45', NULL, 0, 1, NULL),
(20, 'Contact', 'Contact', 'contact-us', '/admin/reports/contact-us', 'comments-o', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 18, 18, '2017-09-20 08:53:54', '2017-10-07 08:03:23', NULL, 0, 1, NULL),
(21, 'Configurations', 'Configurations', 'settings', '/admin/settings', 'cogs', NULL, NULL, NULL, NULL, NULL, NULL, 8, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:19', NULL, 0, 1, NULL),
(22, 'Website', 'Configurations Website', 'website', '/admin/settings/website', 'unlock-alt', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 21, 21, '2017-09-20 08:53:54', '2017-10-07 08:06:24', NULL, 0, 0, NULL),
(23, 'Admin', 'Configurations', 'admin', '/admin/settings/admin', 'lock', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 21, 21, '2017-09-20 08:53:54', '2017-10-07 08:17:36', NULL, 0, 0, NULL),
(24, 'Navigation', 'Navigation Website', 'navigation', '/admin/settings/website/navigation', 'align-center', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 22, 22, '2017-09-20 08:53:54', '2017-10-07 08:05:50', NULL, 0, 0, NULL),
(25, 'Changelogs', '', 'changelogs', '/admin/settings/website/changelogs', 'file-text-o', '', '', '', '', '', '', 2, 0, 22, 22, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(26, 'Navigation', '', 'navigation', '/admin/settings/admin/navigation', 'align-center', 'Help', '', '', '', '', '', 1, 0, 23, 23, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(27, 'Administrateurs', 'Administrateurs', 'users', '/admin/settings/admin/users', 'users', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 23, 23, '2017-09-20 08:53:54', '2017-09-21 09:10:43', NULL, 0, 1, NULL),
(28, 'Admin Invites', '', 'invites', '/admin/settings/admin/users/invites', '', '', '', '', '', '', '', 1, 1, 27, 27, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(29, 'Profil', 'Modifier votre Profil', 'profile', '/admin/profile', 'user', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:11:37', NULL, 0, 1, NULL),
(30, 'Ordre de Navigation', 'Ordre de Navigation', 'order', '/admin/settings/admin/navigation/order', 'list-ol', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 26, 26, '2017-09-20 08:53:54', '2017-09-21 09:30:04', NULL, 0, 1, NULL),
(31, 'Ordre de Navigation', 'Ordre de Navigation Website', 'order', '/admin/settings/website/navigation/order', 'list-ol', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 24, 24, '2017-09-20 08:53:54', '2017-10-07 08:07:00', NULL, 0, 1, NULL),
(32, 'Carrousel Accueil', 'Slider Accueil', 'banners', '/admin/general/banners', 'image', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 17, 17, '2017-09-20 08:53:54', '2017-10-07 08:02:09', NULL, 0, 1, NULL),
(33, 'Souscriptions', 'Plans de Souscription', 'subscription-plans', '/admin/settings/website/subscription-plans', 'money', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 22, 22, '2017-09-20 08:53:54', '2017-09-21 09:28:25', NULL, 0, 1, NULL),
(34, 'Rôles', 'Roles', 'roles', '/admin/settings/roles', 'universal-access', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 21, 21, '2017-09-20 08:53:54', '2017-09-21 09:11:07', NULL, 0, 1, NULL),
(35, 'Fonctionnalités', 'Fonctionnalités', 'features', '/admin/settings/website/subscription-plans/features', 'tags', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 33, 33, '2017-09-20 08:53:54', '2017-09-21 09:13:26', NULL, 0, 1, NULL),
(36, 'Réalisations', 'Réalisations', 'blog', '/admin/blog', 'newspaper-o', NULL, NULL, NULL, NULL, NULL, NULL, 3, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:19', NULL, 0, 1, NULL),
(37, 'Réalisations', 'Réalisations', 'articles', '/admin/blog/articles', 'list', NULL, NULL, NULL, NULL, NULL, 'Pour ajouter des images à la réalisation, il suffit de se servir du bouton \"Image\" <i class=\"faf fa-picture-o\"></i> présent dans la barre d\'outil de l\'éditeur de texte.', 2, 0, 36, 36, '2017-09-20 08:53:54', '2017-10-07 08:09:25', NULL, 0, 1, NULL),
(38, 'Catégories', 'Catégories des réalisations', 'categories', '/admin/blog/categories', 'cubes', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 36, 36, '2017-09-20 08:53:54', '2017-10-07 08:02:25', NULL, 0, 1, NULL),
(39, 'Etiquettes', 'Etiquettes', 'tags', '/admin/general/tags', 'tags', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 17, 17, '2017-09-20 08:53:54', '2017-10-07 08:04:01', NULL, 0, 1, NULL),
(40, 'FAQ', 'FAQ', 'faqs', '/admin/faqs', 'question', NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-07 08:12:47', NULL, 0, 1, NULL),
(41, 'FAQ Questions', 'FAQ Questions', NULL, '/admin/faqs', 'question', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, 40, 40, '2017-09-20 08:53:54', '2017-10-07 08:04:26', NULL, 0, 0, NULL),
(42, 'Catégories', 'Catégories FAQ', 'categories', '/admin/faqs/categories', 'cubes', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 40, 40, '2017-09-20 08:53:54', '2017-10-07 08:17:05', NULL, 0, 1, NULL),
(43, 'Paramètres', 'Paramètres', 'parameters', '/admin/settings/parameters', 'cog', NULL, NULL, NULL, NULL, NULL, NULL, 4, 0, 21, 21, '2017-09-22 07:23:32', '2017-10-04 07:29:56', NULL, 1, 1, NULL),
(44, 'Actualités', 'Actualités', 'actus', '/admin/actus', 'cube', NULL, NULL, NULL, 'Choisissez bien votre titre.', NULL, NULL, 4, 0, 0, 0, '2017-10-02 08:43:05', '2017-10-07 08:12:19', NULL, 1, 1, NULL);

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
(1, 1, 2, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(2, 2, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(3, 2, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(4, 3, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(5, 3, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(6, 4, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(7, 4, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(8, 5, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(9, 5, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(10, 6, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(11, 6, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(12, 7, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(13, 7, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(14, 8, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(15, 9, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(16, 10, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(17, 11, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(18, 12, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(19, 13, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(20, 14, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(21, 15, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(22, 16, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(23, 17, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(24, 18, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(25, 19, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(26, 20, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(27, 21, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(28, 22, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(29, 23, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(30, 24, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(31, 25, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(32, 26, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(33, 27, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(34, 28, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(35, 29, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(36, 30, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(37, 31, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(38, 32, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(39, 33, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(40, 34, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(41, 35, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(42, 36, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(43, 37, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(44, 38, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(45, 39, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(46, 40, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(47, 41, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(48, 42, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(49, 43, 4, '2017-09-22 07:23:32', '2017-09-22 07:23:32'),
(50, 43, 2, '2017-09-22 07:23:32', '2017-09-22 07:23:32'),
(51, 44, 4, '2017-10-02 08:43:05', '2017-10-02 08:43:05'),
(52, 44, 2, '2017-10-02 08:43:05', '2017-10-02 08:43:05'),
(54, 45, 4, '2017-10-02 15:19:39', '2017-10-02 15:19:39'),
(55, 45, 2, '2017-10-02 15:19:39', '2017-10-02 15:19:39'),
(56, 45, 5, '2017-10-02 15:19:39', '2017-10-02 15:19:39'),
(57, 43, 5, '2017-10-04 07:29:56', '2017-10-04 07:29:56'),
(58, 8, 2, '2017-10-07 07:59:06', '2017-10-07 07:59:06'),
(60, 10, 2, '2017-10-07 08:01:08', '2017-10-07 08:01:08'),
(61, 2, 2, '2017-10-07 08:01:28', '2017-10-07 08:01:28'),
(62, 32, 2, '2017-10-07 08:02:09', '2017-10-07 08:02:09'),
(63, 38, 2, '2017-10-07 08:02:25', '2017-10-07 08:02:25'),
(64, 11, 2, '2017-10-07 08:02:53', '2017-10-07 08:02:53'),
(65, 21, 2, '2017-10-07 08:03:08', '2017-10-07 08:03:08'),
(66, 20, 2, '2017-10-07 08:03:23', '2017-10-07 08:03:23'),
(67, 5, 2, '2017-10-07 08:03:38', '2017-10-07 08:03:38'),
(68, 14, 2, '2017-10-07 08:03:49', '2017-10-07 08:03:49'),
(69, 39, 2, '2017-10-07 08:04:02', '2017-10-07 08:04:02'),
(70, 40, 2, '2017-10-07 08:04:15', '2017-10-07 08:04:15'),
(71, 41, 2, '2017-10-07 08:04:26', '2017-10-07 08:04:26'),
(72, 17, 2, '2017-10-07 08:04:42', '2017-10-07 08:04:42'),
(73, 7, 2, '2017-10-07 08:04:54', '2017-10-07 08:04:54'),
(74, 12, 2, '2017-10-07 08:05:19', '2017-10-07 08:05:19'),
(75, 24, 2, '2017-10-07 08:05:50', '2017-10-07 08:05:50'),
(76, 22, 2, '2017-10-07 08:06:24', '2017-10-07 08:06:24'),
(77, 31, 2, '2017-10-07 08:07:00', '2017-10-07 08:07:00'),
(78, 9, 2, '2017-10-07 08:07:33', '2017-10-07 08:07:33'),
(79, 6, 2, '2017-10-07 08:08:04', '2017-10-07 08:08:04'),
(80, 15, 2, '2017-10-07 08:08:18', '2017-10-07 08:08:18'),
(81, 19, 2, '2017-10-07 08:08:45', '2017-10-07 08:08:45'),
(82, 3, 2, '2017-10-07 08:09:01', '2017-10-07 08:09:01'),
(83, 37, 2, '2017-10-07 08:09:25', '2017-10-07 08:09:25'),
(84, 36, 2, '2017-10-07 08:09:53', '2017-10-07 08:09:53'),
(85, 16, 2, '2017-10-07 08:10:07', '2017-10-07 08:10:07'),
(86, 18, 2, '2017-10-07 08:10:22', '2017-10-07 08:10:22'),
(87, 4, 2, '2017-10-07 08:10:38', '2017-10-07 08:10:38'),
(88, 29, 3, '2017-10-07 08:10:56', '2017-10-07 08:10:56'),
(89, 29, 2, '2017-10-07 08:10:56', '2017-10-07 08:10:56'),
(90, 29, 5, '2017-10-07 08:10:56', '2017-10-07 08:10:56'),
(91, 29, 1, '2017-10-07 08:10:56', '2017-10-07 08:10:56'),
(92, 13, 2, '2017-10-07 08:11:10', '2017-10-07 08:11:10'),
(93, 42, 2, '2017-10-07 08:17:05', '2017-10-07 08:17:05');

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
(1, 'Accueil', 'Accueil', 'Accueil', 'Accueil', '/', '', 'home', 1, 1, 0, NULL, 0, 0, 0, '2017-09-20 08:53:54', '2017-10-06 14:24:36', NULL, 0, 1, NULL),
(2, 'A Propos', 'À Propos', 'À Propos', 'A Propos de l\'entreprise', 'a-propos', '/a-propos', 'question', 1, 4, 0, NULL, 0, 0, 0, '2017-09-20 08:53:54', '2017-09-29 09:16:54', NULL, 0, 1, NULL),
(3, 'Contact', 'Contact', 'Contact', 'Contact', 'contact', '/contact', NULL, 1, 6, 0, NULL, 0, 0, 0, '2017-09-20 08:53:54', '2017-09-29 09:16:51', NULL, 0, 1, NULL),
(4, 'Autres Pages', 'Autres Pages', 'Autres Pages', 'Autres Pages', 'pages', '/pages', 'file', 1, 7, 0, NULL, 0, 0, 0, '2017-09-20 08:53:54', '2017-09-21 18:10:38', NULL, 0, 1, NULL),
(5, 'Pricing', 'Pricing', 'Pricing', 'Pricing', 'pricing', '/pricing', 'euro', 0, 6, 0, NULL, 1, 0, 0, '2017-09-20 08:53:54', '2017-09-21 18:02:34', NULL, 0, 1, NULL),
(6, '1 Column Page', '1 Column Page', '1 Column Page', '1 Column Page', '1-column', '/pages/1-column', '', 1, 1, 0, NULL, 0, 4, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(7, '2 Column Page', '2 Column Page', '2 Column Page', '2 Column Page', '2-column', '/pages/2-column', '', 1, 2, 0, NULL, 0, 4, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(8, '3 Column Page', '3 Column Page', '3 Column Page', '3 Column Page', '3-column', '/pages/3-column', '', 1, 3, 0, NULL, 0, 4, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(9, '4 Column Page', '4 Column Page', '4 Column Page', '4 Column Page', '4-column', '/pages/4-column', '', 1, 4, 0, NULL, 0, 4, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(10, 'Changelog', 'Changelog', 'Changelog', 'Changelog', 'changelog', '/changelog', NULL, 0, 5, 0, NULL, 1, 0, 0, '2017-09-20 08:53:54', '2017-09-21 18:02:12', NULL, 0, 1, NULL),
(11, 'Commentaires', 'Commentaires', 'Commentaires', 'Commentaires', 'commentaires', '/commentaires', NULL, 1, 3, 0, NULL, 0, 0, 0, '2017-09-20 08:53:54', '2017-09-29 09:16:54', NULL, 0, 1, NULL),
(12, 'FAQ', 'FAQ', 'FAQ', 'FAQ', 'faq', '/faq', 'question', 1, 5, 0, NULL, 0, 0, 0, '2017-09-21 18:22:13', '2017-09-29 09:16:54', NULL, 1, 1, NULL),
(13, 'Réalisations', 'Toutes les réalisations', 'Réalisations', 'Toutes les réalisations', 'realisations', '/realisations', 'cubes', 1, 2, 0, NULL, 0, 0, 0, '2017-09-25 13:11:37', '2017-09-29 09:16:54', NULL, 1, 1, NULL),
(14, 'Charpentes', 'Charpentes', 'Charpentes', 'Charpentes', 'charpentes', '/realisations/charpentes', NULL, 1, 1, 0, NULL, 0, 13, 13, '2017-09-25 13:12:18', '2017-09-29 09:16:51', NULL, 1, 1, NULL),
(15, 'Terrasses', 'Terrasses', 'Terrasses', 'Terrasses', 'terrasses', '/realisations/terrasses', NULL, 1, 2, 0, NULL, 0, 13, 13, '2017-09-25 13:13:12', '2017-09-29 09:16:51', NULL, 1, 1, NULL);

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
  `id` int(11) NOT NULL,
  `params` varchar(20) NOT NULL,
  `value` text NOT NULL,
  `deleted_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `parameters`
--

INSERT INTO `parameters` (`id`, `params`, `value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'keywords', '[\"mots\",\"clé\"]', '0000-00-00 00:00:00', '2017-09-22 00:00:00', '2017-10-04 12:11:37'),
(2, 'description', '\"Description Description Description Description Description Description Description  Description  Description  Description\"', '0000-00-00 00:00:00', '2017-09-23 00:00:00', '2017-10-06 17:29:14'),
(3, 'horaires', '{\"open1_lundi\":\"10h00\",\"close1_lundi\":\"12h00\",\"open2_lundi\":\"14h00\",\"close2_lundi\":\"18h00\",\"open1_mardi\":\"10h00\",\"close1_mardi\":\"12h00\",\"open2_mardi\":\"14h00\",\"close2_mardi\":\"18h00\",\"open1_mercredi\":\"10h00\",\"close1_mercredi\":\"12h00\",\"open2_mercredi\":\"ferm\\u00e9\",\"close2_mercredi\":null,\"open1_jeudi\":\"10h00\",\"close1_jeudi\":\"12h00\",\"open2_jeudi\":\"14h00\",\"close2_jeudi\":\"18h00\",\"open1_vendredi\":\"10h00\",\"close1_vendredi\":\"12h00\",\"open2_vendredi\":\"14h00\",\"close2_vendredi\":\"18h00\",\"open1_samedi\":\"10h00\",\"close1_samedi\":\"12h00\",\"open2_samedi\":\"ferm\\u00e9\",\"close2_samedi\":null}', '0000-00-00 00:00:00', '2017-09-23 00:00:00', '2017-10-04 11:33:28'),
(4, 'infos', '{\"nom\":\"NOM\",\"prenom\":\"PRENOM\",\"societe\":\"Starter WICOD\",\"slogan\":null,\"siret\":\"123456789 12345\",\"statut\":\"SARL\",\"capital\":null,\"telfixe\":\"03 12 34 56 78\",\"telmobile\":\"06 12 34 56 78\",\"rue\":\"Rue\",\"cp\":\"88220\",\"ville\":\"Arches\",\"region\":\"Vosges\",\"longitude\":\"48.118004\",\"latitude\":\"6.528363\"}', '0000-00-00 00:00:00', '2017-09-23 00:00:00', '2017-10-08 18:45:41'),
(5, 'socials', '{\"facebookappid\":\"12345678\",\"twitterpage\":\"@\"}', '0000-00-00 00:00:00', '2017-09-25 00:00:00', '2017-10-04 11:34:08');

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
(1, 'user', 'Website', '/', 'website', NULL, '2017-09-20 08:53:53', '2017-09-20 08:53:53', NULL, 0, 0, NULL),
(2, 'user-secret', 'Basic Admin', '/admin', 'admin', NULL, '2017-09-20 08:53:53', '2017-09-20 08:53:53', NULL, 0, 0, NULL),
(3, 'user-circle', 'Analytics', '/admin', 'analytics', NULL, '2017-09-20 08:53:53', '2017-09-20 08:53:53', NULL, 0, 0, NULL),
(4, 'user-secret', 'Admin', '/admin', 'admin_super', NULL, '2017-09-20 08:53:53', '2017-09-20 08:53:53', NULL, 0, 0, NULL),
(5, 'universal-access', 'Développeur', '/admin', 'developer', NULL, '2017-09-20 08:53:53', '2017-09-20 08:53:53', NULL, 0, 0, NULL);

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
(2, 4, 1, '2017-09-20 08:53:53', '2017-09-20 08:53:53'),
(10, 2, 3, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(13, 5, 4, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(15, 3, 1, '2017-10-02 15:25:25', '2017-10-02 15:25:25'),
(16, 2, 1, '2017-10-02 15:25:25', '2017-10-02 15:25:25'),
(18, 5, 1, '2017-10-07 07:39:07', '2017-10-07 07:39:07'),
(19, 1, 1, '2017-10-07 07:39:07', '2017-10-07 07:39:07'),
(20, 3, 5, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(21, 1, 6, '2017-09-20 08:53:54', '2017-09-20 08:53:54'),
(22, 4, 2, '2017-10-07 07:38:22', '2017-10-07 07:38:22'),
(23, 2, 2, '2017-10-07 07:38:22', '2017-10-07 07:38:22'),
(24, 3, 2, '2017-10-07 07:38:22', '2017-10-07 07:38:22'),
(25, 1, 2, '2017-10-07 07:38:22', '2017-10-07 07:38:22'),
(26, 5, 2, '2017-10-07 07:38:22', '2017-10-07 07:38:22');

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
(1, 0, 'Basic', '', '19', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(2, 1, 'Plus', '', '99', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(3, 0, 'Ultra', '', '199', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL);

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
(1, '<strong>1</strong> User', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(2, '<strong>5</strong> Projects', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(3, '<strong>Unlimited</strong> Email Accounts', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(4, '<strong>10GB</strong> Disk Space', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(5, '<strong>100GB</strong> Monthly Bandwidth', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(6, '<strong>10</strong> User', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(7, '<strong>500</strong> Projects', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(8, '<strong>Unlimited</strong> Email Accounts', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(9, '<strong>1000GB</strong> Disk Space', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(10, '<strong>10000GB</strong> Monthly Bandwidth', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(11, '<strong>Unlimted</strong> Users', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(12, '<strong>Unlimited</strong> Projects', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(13, '<strong>Unlimited</strong> Email Accounts', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(14, '<strong>10000GB</strong> Disk Space', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL),
(15, '<strong>Unlimited</strong> Monthly Bandwidth', '2017-09-20 08:53:54', '2017-09-20 08:53:54', NULL, 0, 0, NULL);

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

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `cellphone`, `telephone`, `image`, `gender`, `born_at`, `password`, `password_updated_at`, `remember_token`, `confirmation_token`, `logged_in_at`, `created_at`, `updated_at`, `confirmed_at`, `deleted_by`, `deleted_at`) VALUES
(1, 'Admin', 'Admin', 'admin@mail.com', '01 23 45 67 89', NULL, '3b9f681fce9f44460a07a66ba5b4ebb77b07f81b.png', 'Mr', NULL, '$2y$10$Her1jzgk3ULP.1RtOUtjCOXiaWUOCOaJN4gkJ0GjmsIm/D01Wf7i6', NULL, 'EZ0lryS9rc9anaDQFvM9IhsIUKNil5aX8a5WLaAyo2T1TDPZC9IoxiWktZN4', NULL, '2017-10-11 08:05:29', '2017-09-20 08:53:54', '2017-10-11 08:05:29', '2017-09-20 08:53:54', NULL, NULL),
(2, 'BasicAdmin', 'Basic', 'basic-admin@mail.com', '0123456789', NULL, '', 'Mme', NULL, '$2y$10$Her1jzgk3ULP.1RtOUtjCOXiaWUOCOaJN4gkJ0GjmsIm/D01Wf7i6', NULL, 'h8gjHVzTTAIpsaJamvdZldtjJQJgz3zYgla5so9bbnf5UYRdms4jHITIWIY6', NULL, '2017-10-07 08:13:13', '2017-09-20 08:53:54', '2017-10-07 08:20:51', '2017-09-20 08:53:54', NULL, NULL),
(3, 'Developer', 'Developer', 'developer@mail.com', '0123456789', NULL, '', 'Mme', NULL, '$2y$10$Her1jzgk3ULP.1RtOUtjCOXiaWUOCOaJN4gkJ0GjmsIm/D01Wf7i6', NULL, 'hoSmDxzPyy7rES7AwGKeHQwTo2bwcb6MkpVMf71POyOOIQ4oMM4EWMTfvVQh', NULL, '2017-10-07 07:52:39', '2017-09-20 08:53:54', '2017-10-07 07:52:39', '2017-09-20 08:53:54', NULL, NULL),
(4, 'Analytics', 'Analytics', 'analytics@mail.com', '0123456789', NULL, '', 'Mr', NULL, '$2y$10$Her1jzgk3ULP.1RtOUtjCOXiaWUOCOaJN4gkJ0GjmsIm/D01Wf7i6', NULL, 'sLYixfMx6XU9Ge7fjbEksVWIKVKgqy5E6zUr6RYFsptf4FNorQad2pNxWs0U', NULL, '2017-10-07 07:53:03', '2017-09-20 08:53:54', '2017-10-07 07:53:03', '2017-09-20 08:53:54', NULL, NULL),
(5, 'Website', 'Website', 'website@mail.com', '0123456789', NULL, '', 'Mr', NULL, '$2y$10$Her1jzgk3ULP.1RtOUtjCOXiaWUOCOaJN4gkJ0GjmsIm/D01Wf7i6', NULL, 'rWwC2nrOVbg5zRr3QhDU4Sb7PR6Y5ljbk1PomqumaHh00N2qDM9B20N1szM2', NULL, '2017-10-07 07:53:27', '2017-09-20 08:53:54', '2017-10-07 07:53:27', '2017-09-20 08:53:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_invites`
--

CREATE TABLE `user_invites` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invited_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
  ADD UNIQUE KEY `id` (`id`);

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `log_admin_activities`
--
ALTER TABLE `log_admin_activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `log_logins`
--
ALTER TABLE `log_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `navigation_admin`
--
ALTER TABLE `navigation_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT pour la table `navigation_admin_role`
--
ALTER TABLE `navigation_admin_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT pour la table `navigation_website`
--
ALTER TABLE `navigation_website`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `user_invites`
--
ALTER TABLE `user_invites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `taggables`
--
ALTER TABLE `taggables`
  ADD CONSTRAINT `taggables_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
