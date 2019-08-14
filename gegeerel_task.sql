-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 14, 2019 at 11:22 PM
-- Server version: 5.6.40
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gegeerel_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Үндсэн', 'ndsen', 'Үндсэн ажил үүргүүд багтана.', '2016-09-09 00:01:18', '2016-09-11 11:55:20'),
(2, 'Нэмэлт', 'nemelt', 'Нэмэлт ажил үүргүүд багтана.', '2016-09-11 11:55:37', '2016-09-11 11:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `commands`
--

CREATE TABLE `commands` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commands`
--

INSERT INTO `commands` (`id`, `number`, `name`, `start_date`, `pdf`, `category`, `created_at`, `updated_at`) VALUES
(7, 'A/404', 'Ажилд авах тухай', '2016-09-11', '/tmp/phpMZBuCb', 0, '2016-09-11 11:50:55', '2016-09-11 11:50:55'),
(8, 'Б/1', 'Шагнал олгох тухай', '2016-09-12', '/tmp/php4kMiNf', 1, '2016-09-11 14:02:21', '2016-09-12 10:56:39'),
(9, 'B/1', 'Цэцэрлэг барих тухай', '2016-09-11', '/tmp/phpTKIMUw', 2, '2016-09-11 14:03:14', '2016-09-11 14:03:14'),
(10, 'A405', 'Ажил авах тухай', '2016-09-19', '/tmp/php50I2QR', 0, '2016-09-19 18:33:59', '2016-09-19 18:33:59'),
(11, 'a711', 'хөрөнгө гаргах тухай', '2016-09-21', '/tmp/phpNmE6gn', 0, '2016-09-21 15:00:26', '2016-09-21 15:00:26'),
(12, '786', 'стандарт шаардлага батлах тухай', '2016-09-21', '/tmp/phpapG8jG', 0, '2016-09-21 15:06:19', '2016-09-21 15:06:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_01_15_105324_create_roles_table', 2),
('2015_01_15_114412_create_role_user_table', 2),
('2015_01_26_115212_create_permissions_table', 2),
('2015_01_26_115523_create_permission_role_table', 2),
('2015_02_09_132439_create_permission_user_table', 2),
('2015_08_09_083049_create_categories_table', 3),
('2015_08_09_171931_create_tasks_table', 4),
('2015_08_15_113523_create_task_user_table', 5),
('2015_08_16_190023_create_task_note_table', 6),
('2016_09_10_204050_create_commands_table', 7),
('2016_09_12_093410_create_posts_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `text`, `source`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Хурал', '<p>202 Тоотод хуралтай. Бүгд ирнэ үү.</p>', 'Тамгийн газар', 0, '2016-09-12 10:29:47', '2016-09-12 11:01:05'),
(2, 'Хурал хойшлогдлоо', '<p>2016 оны 09 сарын 18 -ны хурал 19нд болж хойшлогдлоо.</p>', 'Тамгийн газар', 1, '2016-09-12 10:42:24', '2016-09-12 11:01:12'),
(3, 'баяр наадмын комисс хуралдах', '<p><i><b></b>хурлын комисс дууд</i><b><i></i></b><i>ах<b></b></i></p>', 'ТГ', 1, '2016-09-22 05:02:09', '2016-09-22 05:02:09'),
(4, 'хувь хүний хөгжил сургалт', '<p>дэвтэртэй ирэх</p>', 'хүний нөөц', 1, '2016-09-22 07:17:16', '2016-09-22 07:17:16'),
(5, 'борлуулалт ба шинжилгээ', '<p>зөвхөн борлуулалтын ажилчид&nbsp;</p>', 'МА', 1, '2016-09-26 02:10:03', '2016-09-26 02:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', '', 8, '2015-08-08 13:07:20', '2016-09-10 20:38:14'),
(2, 'Client', 'client', '', 1, '2015-08-08 13:07:33', '2015-08-08 13:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2015-08-25 08:41:53', '2015-08-25 08:41:53'),
(2, 2, 2, '2016-09-09 20:44:14', '2016-09-09 20:44:14'),
(3, 2, 3, '2016-09-09 20:52:25', '2016-09-09 20:52:25'),
(4, 2, 4, '2016-09-21 13:21:39', '2016-09-21 13:21:39'),
(5, 2, 5, '2016-09-21 13:23:06', '2016-09-21 13:23:06'),
(6, 2, 6, '2016-09-21 13:25:16', '2016-09-21 13:25:16'),
(7, 2, 7, '2016-09-21 13:27:18', '2016-09-21 13:27:18'),
(8, 2, 8, '2016-09-21 13:32:07', '2016-09-21 13:32:07'),
(9, 2, 9, '2016-09-21 13:33:47', '2016-09-21 13:33:47'),
(10, 2, 10, '2016-09-21 13:36:08', '2016-09-21 13:36:08'),
(11, 2, 11, '2016-09-21 13:37:49', '2016-09-21 13:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `priority` smallint(5) UNSIGNED NOT NULL DEFAULT '1',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `category_id`, `start_date`, `due_date`, `status`, `priority`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Тэнхимийн хурал', 1, '2016-09-16', '2016-09-16', 2, 3, '', '2016-09-09 00:01:54', '2016-09-09 20:54:38'),
(2, 'тайлан', 1, '2016-09-22', '2016-09-23', 2, 1, '<p>тайлан өгөх</p>', '2016-09-22 05:19:28', '2016-09-22 05:59:57'),
(3, 'судалгаа хийх', 2, '2016-09-22', '2016-09-28', 1, 2, '<p>үнийн судалгааг хийх</p>', '2016-09-22 05:38:46', '2016-09-22 05:38:46'),
(4, 'Баасанжаргал', 2, '2016-09-22', '2016-09-24', 2, 2, '<p>шинэ жил зохион байгуулах</p>', '2016-09-22 06:34:50', '2016-09-22 06:48:21');

-- --------------------------------------------------------

--
-- Table structure for table `task_note`
--

CREATE TABLE `task_note` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_note`
--

INSERT INTO `task_note` (`id`, `user_id`, `task_id`, `note`, `created_at`, `updated_at`) VALUES
(1, 6, 2, 'захиалга өгөх', '2016-09-22 05:59:51', '2016-09-22 05:59:51'),
(2, 8, 4, 'hi\r\n', '2016-09-22 06:47:22', '2016-09-22 06:47:22'),
(3, 8, 4, 'bag burfuuleh', '2016-09-22 06:47:45', '2016-09-22 06:47:45');

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `user_id`, `task_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 6, 2),
(5, 9, 3),
(6, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@tss.com', '$2y$10$pMOHljX2LzDEmGFW5w60vOiYaqMcsSA1GfZ8Gcl20GGATItdSx7iK', 'UVQeEpeRymlHseYpz3ExT8DSsHqBD10uyp1wc5LHCiksJS9Dnb90L9ea0bwA', '2015-08-25 08:41:53', '2016-10-11 13:29:34'),
(2, 'Будхүү', 'Budkhuuo0310@yahoo.com', '$2y$10$FSQ33TOkq.fdKn/A4F/0zuApmOLBjzhvyafP6/aHcrdUCrysvXoi.', 'kMTBJO3hi3oz64xZsPIipOdR1gq6xDlciF65vRBKXvLGbxPne5yBu27lWziF', '2016-09-09 20:44:14', '2016-09-22 07:13:38'),
(3, 'Отгончимэг', 'Otgoo@yahoo.com', '$2y$10$QE29qHm7SgnbXU9QiLB//uXCS/R.Yg94gMIAJY/bOS96YxMJESzuK', '2GQxFADjr1ykbAJS7CULgzfWv1rKAqxXGlzhPrLK59kWGbgTbgEXQiKUyDIL', '2016-09-09 20:52:25', '2016-10-07 00:15:37'),
(4, 'саран', 'sara@mail.ru', '$2y$10$PiPBNFDPgCwIC.1gBpHchOectynaRX56FH6sShWY3nDwS6OLyV8cq', NULL, '2016-09-21 13:21:39', '2016-09-21 13:21:39'),
(5, 'Батнаран', 'bat@yahoo.com', '$2y$10$bHdVFOOUyM4ksdIMzkuXK.xPlPcPDa4CqOsQNTSwa2EgQkfrsNJO.', 'gS2ezvXkRJYO0vjPjseo038LR16Lylj4bQJA5LFHCgFxgjTwJ4m1BBIYcoyW', '2016-09-21 13:23:06', '2016-09-22 06:08:30'),
(6, 'Өлзийханд', 'ulzii@mail.ru', '$2y$10$KpKi1EliFO45Ke5D8E8Kg.RWVhNRGflalb9qzsgCnUL3hMOVEYfSi', 'uq6yv3hNTrN36JvHYQhqXkTm0dOt3wpSz7iKVf3GKC589ZG46NB3mVFwmzs2', '2016-09-21 13:25:16', '2016-09-26 02:11:51'),
(7, 'Энхзул', 'zulaa_tg@yahoo.com', '$2y$10$wc4Pz6ZiEDTRzUN2lLE1auFR7ge0/qcA1EsIkCblKIkJ/cyVC1gaC', 'vJLFM8PsCX41P0EhZu01JhwUbrMIdIiWZdZ8LjHaF7Z79DLpCzyPIPM3KYbs', '2016-09-21 13:27:18', '2016-09-22 07:34:21'),
(8, 'Баасанжаргал', 'baaska0220@yahoo.com', '$2y$10$U/AZNRt4rbPQcA3M3jAdJeFjdAIGgtcMqpwr3ZwC5u47lWdtJ8lN2', 'BceHGaQlibNu3j6Gq5S2Ud0hK7qxbL1Fe4bS8cy9kMzcV3Zl60Nh9f0q4R6l', '2016-09-21 13:32:07', '2016-09-22 06:48:57'),
(9, 'Отгон', 'otgonbg@mail.ru', '$2y$10$lLkm.5eb0yHaR2PwI35wbOXSjupqtJjuCLO4/5ZriiNXBOrx4rG/y', NULL, '2016-09-21 13:33:47', '2016-09-21 13:33:47'),
(10, 'Мөнхзул', 'zul_596@yahoo.com', '$2y$10$Uz.DWWU8LZAj3mq61QFfeeDXOR5BlciXZj.NdA1q9yvwNSght8KeK', '1q6GtphX92HKGSxXmzbUFHGKyxgRA13NqleTWSu2K5Cm30YyPmHgFVMKMqMC', '2016-09-21 13:36:08', '2016-09-22 07:51:15'),
(11, 'Хишигтуяа', 'hishgee@yahoo.com', '$2y$10$WaVGmr3hZcu5AZJ8lb9xsuMYOQ4gIXIFCbc6wsUoAcrazuq9wSNe.', NULL, '2016-09-21 13:37:49', '2016-09-21 13:37:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commands`
--
ALTER TABLE `commands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_note`
--
ALTER TABLE `task_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_note_user_id_index` (`user_id`),
  ADD KEY `task_note_task_id_index` (`task_id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_user_user_id_index` (`user_id`),
  ADD KEY `task_user_task_id_index` (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `commands`
--
ALTER TABLE `commands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task_note`
--
ALTER TABLE `task_note`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_note`
--
ALTER TABLE `task_note`
  ADD CONSTRAINT `task_note_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_note_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
