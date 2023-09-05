-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05 سبتمبر 2023 الساعة 18:26
-- إصدار الخادم: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mutah_form`
--

-- --------------------------------------------------------

--
-- بنية الجدول `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `answer` text NOT NULL,
  `files` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `question_id`, `created_at`, `updated_at`, `answer`, `files`) VALUES
(117, 3, 1, '2023-09-04 23:36:15', '2023-09-04 23:36:15', '[\"123\",\"234\",\"-90 %\"]', '[\"\\/uploads\\/63527986ahmad othman alhashlamoun_test form (3).xls\",\"\\/uploads\\/468280712023-09-05_test form.xls\",\"\\/uploads\\/47592468ahmad othman alhashlamoun_test form (2).xls\",\"\\/uploads\\/83703641ahmad othman alhashlamoun_test form (1).xls\",\"\\/uploads\\/69523049ahmad othman alhashlamoun_test form.xls\"]'),
(118, 3, 2, '2023-09-04 23:36:15', '2023-09-04 23:36:15', 'نصىضثهخضتص', '[\"\\/uploads\\/7971628924959200Bill52820039.png\",\"\\/uploads\\/57353116ahmad othman alhashlamoun_test form (3).xls\",\"\\/uploads\\/147398832023-09-05_test form.xls\",\"\\/uploads\\/51497393ahmad othman alhashlamoun_test form (2).xls\",\"\\/uploads\\/92377140ahmad othman alhashlamoun_test form (1).xls\",\"\\/uploads\\/39035371ahmad othman alhashlamoun_test form.xls\"]'),
(119, 3, 3, '2023-09-04 23:36:15', '2023-09-04 23:36:15', '[\"435\",\"234\",\"46 %\"]', '[\"\\/uploads\\/31193284ahmad othman alhashlamoun_test form (1).xls\"]'),
(120, 3, 1, '2023-09-05 09:24:29', '2023-09-05 09:24:29', '[\"56\",\"5\",\"91 %\"]', '[\"\\/uploads\\/63527986ahmad othman alhashlamoun_test form (3).xls\",\"\\/uploads\\/468280712023-09-05_test form.xls\",\"\\/uploads\\/47592468ahmad othman alhashlamoun_test form (2).xls\",\"\\/uploads\\/83703641ahmad othman alhashlamoun_test form (1).xls\",\"\\/uploads\\/69523049ahmad othman alhashlamoun_test form.xls\"]'),
(121, 3, 2, '2023-09-05 09:24:29', '2023-09-05 09:24:29', 'hyugyuhuy', '[\"\\/uploads\\/7971628924959200Bill52820039.png\",\"\\/uploads\\/57353116ahmad othman alhashlamoun_test form (3).xls\",\"\\/uploads\\/147398832023-09-05_test form.xls\",\"\\/uploads\\/51497393ahmad othman alhashlamoun_test form (2).xls\",\"\\/uploads\\/92377140ahmad othman alhashlamoun_test form (1).xls\",\"\\/uploads\\/39035371ahmad othman alhashlamoun_test form.xls\"]'),
(122, 3, 3, '2023-09-05 09:24:29', '2023-09-05 09:24:29', '[\"561\",\"25\",\"95 %\"]', '[\"\\/uploads\\/31193284ahmad othman alhashlamoun_test form (1).xls\"]');

-- --------------------------------------------------------

--
-- بنية الجدول `answer_checker`
--

CREATE TABLE `answer_checker` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `answer_checker`
--

INSERT INTO `answer_checker` (`id`, `user_id`, `form_id`, `created_at`) VALUES
(1, 1, 1, '2023-09-04 21:51:53'),
(3, 3, 1, '2023-09-05 09:24:29');

-- --------------------------------------------------------

--
-- بنية الجدول `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '0=>public\r\n1=>professors\r\n2=> custom',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `forms`
--

INSERT INTO `forms` (`id`, `title`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test form', 0, 0, '2023-09-01 15:10:37', '2023-09-01 15:10:37'),
(2, 'title eeee', 2, 1, '2023-09-01 15:52:04', '2023-09-01 15:52:04'),
(3, 'title eeee', 0, 1, '2023-09-01 15:52:23', '2023-09-01 15:52:23'),
(4, 'title eeee', 0, 1, '2023-09-01 16:11:53', '2023-09-01 16:11:53'),
(5, 'asdsad', 2, 1, '2023-09-02 10:31:50', '2023-09-02 10:31:50'),
(6, 'asdsad', 2, 1, '2023-09-02 10:32:50', '2023-09-02 10:32:50'),
(7, '5654tg45t', 2, 1, '2023-09-02 10:33:54', '2023-09-02 10:33:54'),
(8, 'asdqw32132', 2, 1, '2023-09-02 10:42:56', '2023-09-02 10:42:56');

-- --------------------------------------------------------

--
-- بنية الجدول `indecators`
--

CREATE TABLE `indecators` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `indecators`
--

INSERT INTO `indecators` (`id`, `form_id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'test indicatorasdsa', 0, '2023-09-01 16:46:14', '2023-09-01 16:46:14'),
(2, 1, 'uiuwewie', 1, '2023-09-02 10:08:27', '2023-09-02 10:08:27');

-- --------------------------------------------------------

--
-- بنية الجدول `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `indecator_id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1=> precenteg\r\n0=> text/number',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `questions`
--

INSERT INTO `questions` (`id`, `question`, `indecator_id`, `role`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'asdasd 32', 1, 2, 1, 1, '2023-09-01 17:12:41', '2023-09-01 17:12:41'),
(2, 'j3ioje32id', 1, 0, 0, 1, '2023-09-02 11:51:31', '2023-09-02 11:51:31'),
(3, '3emiwdoisd', 2, 0, 1, 1, '2023-09-02 11:51:43', '2023-09-02 11:51:43');

-- --------------------------------------------------------

--
-- بنية الجدول `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `equation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `setting`
--

INSERT INTO `setting` (`id`, `equation`, `created_at`, `updated_at`) VALUES
(1, '((x - y) / x) * 100', '2023-09-02 14:39:43', '2023-09-02 14:39:43');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `university_number` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `university_number`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin123567', 'admin@admin.com', 12345, '12345', 1, 1, '2023-09-01 12:56:51', '2023-09-01 12:56:51'),
(2, 'test', 'test@test.com', 12345, '12345', 0, 1, '2023-09-01 12:57:22', '2023-09-01 12:57:22'),
(3, 'ahmad othman alhashlamoun', NULL, 123456, '123456', 0, 1, '2023-09-01 14:46:49', '2023-09-01 14:46:49'),
(4, 'testing', NULL, 999999, '999999', 0, 1, '2023-09-04 20:59:41', '2023-09-04 20:59:41'),
(5, 'admin 123', NULL, 12345, '12345', 0, 1, '2023-09-05 15:35:25', '2023-09-05 15:35:25');

-- --------------------------------------------------------

--
-- بنية الجدول `users_role_forms`
--

CREATE TABLE `users_role_forms` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users_role_forms`
--

INSERT INTO `users_role_forms` (`id`, `user_id`, `form_id`) VALUES
(29, 1, 7),
(30, 2, 7),
(31, 3, 7),
(32, 2, 8),
(33, 3, 8),
(35, 1, 2),
(36, 2, 2),
(45, 2, 1),
(46, 3, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `users_role_questions`
--

CREATE TABLE `users_role_questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users_role_questions`
--

INSERT INTO `users_role_questions` (`id`, `user_id`, `question_id`) VALUES
(21, 3, 4),
(22, 2, 4),
(23, 2, 4),
(24, 3, 4),
(25, 3, 4),
(31, 2, 1),
(32, 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer_checker`
--
ALTER TABLE `answer_checker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indecators`
--
ALTER TABLE `indecators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role_forms`
--
ALTER TABLE `users_role_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_role_questions`
--
ALTER TABLE `users_role_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `answer_checker`
--
ALTER TABLE `answer_checker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `indecators`
--
ALTER TABLE `indecators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_role_forms`
--
ALTER TABLE `users_role_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `users_role_questions`
--
ALTER TABLE `users_role_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
