-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 07:52 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utopians_dashboard`
--
CREATE DATABASE IF NOT EXISTS `utopians_dashboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `utopians_dashboard`;

-- --------------------------------------------------------

--
-- Table structure for table `exam_name`
--

DROP TABLE IF EXISTS `exam_name`;
CREATE TABLE `exam_name` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_name`
--

INSERT INTO `exam_name` (`id`, `name`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'تحديد مستوى', 0, 0, 0, NULL, '2018-05-01 05:13:47', NULL, NULL),
(2, 'امتحان 1', 0, 0, 0, NULL, '2018-05-01 06:40:44', NULL, NULL),
(3, 'سلس', 0, 0, 0, NULL, '2018-05-01 06:45:11', NULL, NULL),
(4, '45tg5t', 0, 0, 0, NULL, NULL, NULL, NULL),
(5, 'erter333', 0, 0, 0, NULL, '2018-05-01 06:40:16', NULL, NULL),
(6, 'صضث', 0, 0, 0, NULL, NULL, NULL, NULL),
(7, 'werew', 0, 0, 0, NULL, NULL, NULL, NULL),
(8, 'werewثثثث', 0, 0, 0, NULL, NULL, NULL, NULL),
(9, ']]]', 0, 0, 0, NULL, NULL, NULL, NULL),
(10, 'rwe33', 0, 0, 0, NULL, NULL, NULL, NULL),
(11, 'werewr3223', 0, 0, 0, NULL, NULL, NULL, NULL),
(12, 'ملئ فراغ', 0, 0, 0, NULL, NULL, NULL, NULL),
(13, 'يبليقف', 0, 0, 0, NULL, NULL, NULL, NULL),
(14, '234', 0, 0, 0, NULL, NULL, NULL, NULL),
(15, '12321', 0, 0, 0, NULL, NULL, NULL, NULL),
(16, 'تجريب', 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_name_index`
--

DROP TABLE IF EXISTS `exam_name_index`;
CREATE TABLE `exam_name_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_name_id` int(10) UNSIGNED NOT NULL,
  `exam_type` int(10) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_percent` double(5,2) NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_name_index`
--

INSERT INTO `exam_name_index` (`id`, `exam_name_id`, `exam_type`, `date`, `code`, `period`, `exam_percent`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 0, '2018-05-25 12:00:00', '2017', '180', 0.00, 0, 0, 0, NULL, '2018-05-25 06:01:48', NULL, NULL),
(2, 1, 0, '2018-05-17 00:00:00', '8596', '120', 0.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(3, 2, 0, '2018-01-01 00:00:00', '7004', '90', 0.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(4, 4, 0, '2018-01-01 00:00:00', '9226', '90', 0.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(5, 14, 0, '2018-01-25 00:00:00', '6143', '90', 0.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(6, 1, 0, '2018-05-25 14:00:00', '9269', '90', 0.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(7, 16, 0, '2018-05-23 11:30:00', '9214', '90', 100.00, 0, 0, 0, NULL, '2018-05-23 05:47:49', NULL, NULL),
(8, 16, 0, '2018-05-24 14:45:00', '4361', '180', 100.00, 0, 0, 0, NULL, '2018-05-24 08:52:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_name_index_questions`
--

DROP TABLE IF EXISTS `exam_name_index_questions`;
CREATE TABLE `exam_name_index_questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_name_index_id` int(11) NOT NULL,
  `question_types_id` int(11) NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `answer2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `answer3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `answer4` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `correct_answer1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `correct_answer2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `correct_answer3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'محجوز يرجى حذفه',
  `question_percent` double(4,2) NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_name_index_questions`
--

INSERT INTO `exam_name_index_questions` (`id`, `exam_name_index_id`, `question_types_id`, `text`, `link`, `file`, `answer_type`, `answer1`, `answer2`, `answer3`, `answer4`, `correct_answer1`, `correct_answer2`, `correct_answer3`, `question_percent`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(12, 1, 9, 'كيف كان يعيش طائر النورس', NULL, NULL, 'اختيار متعدد من متعدد', 'بر', 'بحر', 'تراب', 'سمير', 'بحر', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 40.00, 0, 0, 0, NULL, '2018-05-24 04:33:01', NULL, NULL),
(13, 1, 9, 'ملف', NULL, NULL, 'ملف', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'بحر', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 12.00, 0, 0, 0, NULL, '2018-05-24 04:33:01', NULL, NULL),
(14, 1, 9, 'نص', NULL, NULL, 'نص', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'نص', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 12.00, 0, 0, 0, NULL, '2018-05-24 04:33:01', NULL, NULL),
(15, 1, 9, 'صح أم خطأ', NULL, NULL, 'صح أم خطأ', 'True', 'False', 'Not given', 'محجوز يرجى حذفه', 'True', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 12.00, 0, 0, 0, NULL, '2018-05-24 04:33:01', NULL, NULL),
(16, 1, 8, 'فيديو', 'https://www.youtube.com/watch?v=4Zzl7N0rnCg', NULL, 'نص', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'ف', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 12.00, 0, 0, 0, NULL, '2018-05-24 04:33:01', NULL, NULL),
(17, 1, 7, 'صورة', NULL, '15269743695359034.jpg', 'نص', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'ثقف', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 12.00, 0, 0, 0, NULL, '2018-05-24 04:33:01', NULL, NULL),
(18, 7, 7, 'ماهي هذه الصورة', NULL, '1527059062938576609.jpg', 'نص', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'غير محددة', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(19, 7, 8, 'ماهو هذا الفيديو', 'https://www.youtube.com/watch?v=lpFg6tl0qP0', '15270591331039938326.jpg', 'اختيار واحد من متعدد', 'اجابة 1', 'اجابة 2', 'اجابة 3', 'اجابة 4', 'اجابة 2', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(20, 7, 9, 'كيف يمكن للحيوان التأقلم', NULL, '15270591871495545984.jpg', 'اختيار متعدد من متعدد', 'اجابة 1', 'اجابة 2', 'اجابة 3', 'اجابة 4', 'اجابة 2', 'اجابة 3', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(21, 7, 9, 'ماهو البطريق', NULL, '15270592061303822104.jpg', 'صح أم خطأ', 'True', 'False', 'Not given', 'محجوز يرجى حذفه', 'True', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(22, 7, 9, 'صثقثق', NULL, NULL, 'اختيار متعدد من متعدد', '1', '2', '3', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(23, 7, 9, '2434', NULL, NULL, 'اختيار واحد من متعدد', '123', '22', '33', 'محجوز يرجى حذفه', NULL, 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(24, 8, 9, 'س1', NULL, NULL, 'اختيار واحد من متعدد', 'ج1', 'ج2', 'ج3', 'محجوز يرجى حذفه', 'ج2', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(25, 8, 9, 'س2', NULL, NULL, 'اختيار متعدد من متعدد', 'جو1', 'جو2', 'جو3', 'جو4', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(26, 8, 9, 'س3', NULL, NULL, 'ملف', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(27, 8, 9, 'س4', NULL, NULL, 'نص', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', NULL, 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL),
(28, 8, 9, 'س5', NULL, NULL, 'صح أم خطأ', 'True', 'False', 'Not given', 'محجوز يرجى حذفه', 'True', 'محجوز يرجى حذفه', 'محجوز يرجى حذفه', 10.00, 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_name_index_questions_users`
--

DROP TABLE IF EXISTS `exam_name_index_questions_users`;
CREATE TABLE `exam_name_index_questions_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_name_index_questions_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `answer` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_name_index_questions_users`
--

INSERT INTO `exam_name_index_questions_users` (`id`, `exam_name_index_questions_id`, `user_id`, `answer`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(47, 13, 13, '15269957061005688991.jpg', 0, 0, 0, NULL, NULL, NULL, NULL),
(48, 17, 13, 'were', 0, 0, 0, NULL, NULL, NULL, NULL),
(49, 26, 13, '15270661741665830921.jpg', 0, 0, 0, NULL, NULL, NULL, NULL),
(50, 13, 13, '1527239374307426661.jpg', 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_name_index_users`
--

DROP TABLE IF EXISTS `exam_name_index_users`;
CREATE TABLE `exam_name_index_users` (
  `id` int(11) NOT NULL,
  `exam_name_index_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` double(4,2) NOT NULL DEFAULT '0.00',
  `result_status` int(11) NOT NULL DEFAULT '0',
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `updated_by` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exam_name_index_users`
--

INSERT INTO `exam_name_index_users` (`id`, `exam_name_index_id`, `user_id`, `result`, `result_status`, `trash`, `active`, `block`, `updated_by`, `created_by`, `updated_at`, `created_at`, `remember_token`) VALUES
(20, 1, 13, 0.00, 0, 0, 0, 0, NULL, NULL, '2018-05-22 10:28:35', '2018-05-22 13:27:44', NULL),
(21, 7, 13, 0.00, 0, 0, 0, 0, NULL, NULL, '2018-05-23 07:07:01', '2018-05-23 07:07:01', NULL),
(22, 8, 13, 0.00, 0, 0, 0, 0, NULL, NULL, '2018-05-23 09:02:11', '2018-05-23 09:02:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_level` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `user_level`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'سمير', '2', 0, 0, 0, '2018-05-17 03:26:51', '2018-05-17 03:26:51', NULL, NULL),
(2, 'سمير1', '2', 0, 0, 0, '2018-05-17 03:30:31', '2018-05-17 03:30:31', NULL, NULL),
(3, '2-1', '2', 0, 0, 0, NULL, NULL, NULL, NULL),
(4, '2-2', '2', 0, 0, 0, NULL, NULL, NULL, NULL),
(5, '2-3', '2', 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_timing`
--

DROP TABLE IF EXISTS `group_timing`;
CREATE TABLE `group_timing` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `day` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` time NOT NULL,
  `group_timing_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'يرجى إضافة الرابط',
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_timing`
--

INSERT INTO `group_timing` (`id`, `group_id`, `day`, `time`, `group_timing_link`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'Thursday', '02:00:00', 'https://telegram.org/tour/groups', 0, 0, 0, '2018-05-17 03:26:52', '2018-05-29 06:58:05', NULL, NULL),
(2, 2, 'Thursday', '00:00:00', 'https://telegram.org/tour/groups', 0, 0, 0, '2018-05-17 03:30:31', '2018-05-17 03:30:31', NULL, NULL),
(3, 4, 'Thursday', '00:00:00', 'https://telegram.org/tour/groups', 0, 0, 0, '2018-05-18 03:50:15', '2018-05-18 03:50:15', NULL, NULL),
(4, 5, 'Thursday', '00:00:00', 'https://telegram.org/tour/groups', 0, 0, 0, '2018-05-18 03:50:30', '2018-05-18 03:50:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_timing_attendees`
--

DROP TABLE IF EXISTS `group_timing_attendees`;
CREATE TABLE `group_timing_attendees` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_timing_id` int(10) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `available` int(11) NOT NULL DEFAULT '0',
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_timing_attendees`
--

INSERT INTO `group_timing_attendees` (`id`, `group_timing_id`, `user_id`, `available`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 4, 13, 1, 0, 0, 0, NULL, '2018-05-29 06:40:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_user`
--

DROP TABLE IF EXISTS `group_user`;
CREATE TABLE `group_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_user`
--

INSERT INTO `group_user` (`id`, `user_id`, `group_id`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 13, 1, 0, 0, 0, '2018-05-17 03:26:52', '2018-05-17 03:26:52', NULL, NULL),
(2, 15, 1, 0, 0, 0, '2018-05-17 03:30:31', '2018-05-17 03:30:31', NULL, NULL),
(3, 16, 1, 0, 0, 0, '2018-05-18 03:50:15', '2018-05-18 03:50:15', NULL, NULL),
(4, 13, 5, 0, 0, 0, '2018-05-18 03:50:30', '2018-05-18 03:50:30', NULL, NULL),
(5, 12, 5, 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons_archive`
--

DROP TABLE IF EXISTS `lessons_archive`;
CREATE TABLE `lessons_archive` (
  `id` int(10) UNSIGNED NOT NULL,
  `lessons_index_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons_archive`
--

INSERT INTO `lessons_archive` (`id`, `lessons_index_id`, `date`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, '2018-05-03', 1, 0, 0, NULL, '2018-05-15 06:24:43', NULL, NULL),
(2, 1, '1985-12-03', 1, 0, 0, NULL, '2018-05-14 07:40:28', NULL, NULL),
(3, 1, '2018-09-17', 1, 0, 0, NULL, '2018-05-14 07:44:50', NULL, NULL),
(4, 1, '2018-09-18', 0, 0, 0, NULL, '2018-05-17 06:09:11', NULL, NULL),
(5, 1, '2018-09-17', 0, 1, 0, NULL, '2018-05-17 05:22:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons_archive_files`
--

DROP TABLE IF EXISTS `lessons_archive_files`;
CREATE TABLE `lessons_archive_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `lessons_archive_id` int(11) NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons_archive_files`
--

INSERT INTO `lessons_archive_files` (`id`, `lessons_archive_id`, `file`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 4, '1261494861516', 1, 0, 0, NULL, '2018-05-15 06:25:08', NULL, NULL),
(2, 4, '15263746231662729512.docx', 0, 0, 0, NULL, NULL, NULL, NULL),
(3, 4, '1526376003312395961.JPG', 0, 0, 0, NULL, NULL, NULL, NULL),
(4, 4, '1526376087626011884.JPG', 0, 0, 0, NULL, NULL, NULL, NULL),
(5, 4, '15263761031601751057.JPG', 0, 0, 0, NULL, NULL, NULL, NULL),
(6, 4, '15263761401812772286.docx', 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lessons_index`
--

DROP TABLE IF EXISTS `lessons_index`;
CREATE TABLE `lessons_index` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lessons_index`
--

INSERT INTO `lessons_index` (`id`, `name`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, '2-1', 0, 0, 0, NULL, '2018-05-14 07:46:30', NULL, NULL),
(2, 'الأول', 1, 0, 0, NULL, '2018-05-14 04:58:56', NULL, NULL),
(3, '2-2', 0, 0, 0, NULL, NULL, NULL, NULL),
(4, '2-3', 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(16, '2014_10_12_000000_create_users_table', 1),
(17, '2014_10_12_100000_create_password_resets_table', 1),
(18, '2018_04_27_112300_create_roles_table', 1),
(19, '2018_04_27_112630_create_role_user_table', 1),
(20, '2018_04_29_093726_create_groups_table', 1),
(21, '2018_04_29_093757_create_group_user_table', 1),
(22, '2018_04_29_093815_create_group_timing_table', 1),
(23, '2018_04_29_093934_create_group_timing_attendees_table', 1),
(24, '2018_04_29_094002_create_exam_name_table', 1),
(25, '2018_04_29_094024_create_exam_name_index_table', 1),
(26, '2018_04_29_094106_create_exam_name_index_questions_table', 1),
(27, '2018_04_29_094123_create_exam_name_index_questions_u_table', 1),
(28, '2018_04_29_094158_create_lessons_index_table', 1),
(29, '2018_04_29_094226_create_lessons_archive_table', 1),
(30, '2018_04_29_094241_create_lessons_archive_files_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `question_types`
--

DROP TABLE IF EXISTS `question_types`;
CREATE TABLE `question_types` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_types`
--

INSERT INTO `question_types` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `trash`, `active`, `block`, `remember_token`) VALUES
(7, 'صورة', NULL, NULL, '2018-05-22 05:50:10', '2018-05-22 05:50:10', 0, 0, 0, NULL),
(8, 'فيديو', NULL, NULL, '2018-05-22 05:50:10', '2018-05-22 05:50:10', 0, 0, 0, NULL),
(9, 'نص', NULL, NULL, '2018-05-22 05:50:10', '2018-05-22 05:50:10', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_by`, `updated_by`, `trash`, `active`, `block`, `created_at`, `updated_at`) VALUES
(1, 'Student', 'طالب', NULL, NULL, 0, 0, 0, NULL, NULL),
(2, 'Volunteer', 'متطوع', NULL, NULL, 0, 0, 0, NULL, NULL),
(3, 'teacher assistant', '', NULL, NULL, 0, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 3, 13, 0, 0, 0, NULL, NULL, NULL, NULL),
(3, 1, 16, 0, 0, 0, NULL, NULL, NULL, NULL),
(4, 1, 17, 0, 0, 0, NULL, NULL, NULL, NULL),
(5, 1, 18, 0, 0, 0, NULL, NULL, NULL, NULL),
(6, 1, 19, 0, 0, 0, NULL, NULL, NULL, NULL),
(7, 1, 21, 0, 0, 0, NULL, NULL, NULL, NULL),
(8, 1, 22, 0, 0, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `english_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arabic_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` int(1) NOT NULL,
  `birthdate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `university` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trash` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `block` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `english_name`, `arabic_name`, `gender`, `birthdate`, `email`, `password`, `facebook_link`, `university`, `specialization`, `country`, `city`, `level`, `trash`, `active`, `block`, `created_at`, `updated_at`, `created_by`, `updated_by`, `remember_token`) VALUES
(12, 'Sarah Mohammad', 'سارة محمد', 2, '23-12-1990', 's@gmail.com', '$2y$10$XSJC4k0/28yxcJPqhTXt2eWY0yBCL57JRBLbQaa9tEFwv8.sjmGJC', 'http://facebook.com/', 'Tishreen', 'IT', 'Syria', 'Tartus', '1', 0, 0, 0, '2018-05-12 15:28:47', '2018-05-12 15:28:47', NULL, NULL, NULL),
(13, 'wew', '213', 1, 'ewq', 'admin@example.com', '$2y$10$/tbCiEY9sajp7g85nOZUI.pv95Quni6H4dnJ7pENRm04YJLWdvRAy', 'we', '', 'we', 'we', 'we', NULL, 0, 0, 0, NULL, '2018-05-17 06:30:26', NULL, NULL, 'DVZdtQwhx7ougib5cG7ScsNYBp8SJjRxz9JbsoxGULuywMrI0m5ufS8KuQVl'),
(15, 'ubay', 'أبي', 1, '1991-01-01', 'ubay@example.com', '$2y$10$nbI45WexrZw6RwnRwPkvpeitrZxtKSoAtWDzsL8wS0SG5GSenjQNy', 'https://www.facebook.com/ahmad.hboubate', 'Damascus TCC', 'Computer Networks', 'Syria', 'Damascus', '1', 0, 0, 0, '2018-05-16 08:52:18', '2018-05-16 08:52:18', NULL, NULL, 'fN9bXevg4cfurLxf2HUOWA2rjMyVJTsVHjSGcrH6lvo0uBAEbJsHrTp4ocrr'),
(16, 'mohamed', 'محمد', 1, '1990-01-01', 'mohamed@example.com', '$2y$10$HCZ/rLaKsfh7IG9wh1KnkOWeJLuuzSBAUW4kGPSnjPoekcY/8yNNu', '3ewrewrewr12rfewrwerewr32', 'ewr', 'rew', 'rer', 'wer', NULL, 0, 0, 0, '2018-05-16 08:58:48', '2018-05-17 06:30:23', NULL, NULL, 'mnvDe3AFcCeV7b2q84aAQtsmhRSbYCyNDyYgSNXYnfYMk5k8IuFNjk3GySji'),
(17, 'smeer', 'بسيب', 1, '1991-10-10', 'smeer@example.com', '$2y$10$ZZQGuvzTytGZpHCA8/I9cOO/FTLs1Pc8d/6kQshdlUIdTGeZTHDmO', 'grewterwtwerewreewrer', 'were', 'rewr', 'ewrew', 'rewrewr', NULL, 0, 0, 1, '2018-05-16 09:05:10', '2018-05-18 03:58:54', NULL, NULL, 'ep0R2FSYGNsEXZyTEkqWViMYe9tVM8Dsxo3syDxnyIVHtnEk5dBeiscr0p1A'),
(18, 'adddd', 'addd', 1, '1991-01-01', 'adddd@example.com', '$2y$10$hgRY/.V4W/MPmF6kNVXVFubcWpn0b8xN5mrGCJcOIX7b8sb.iE7Mm', 'wererewrewrwerew', 'wererew', 'werer', 'werer', 'wer', NULL, 0, 0, 0, '2018-05-16 09:07:00', '2018-05-17 06:22:43', NULL, NULL, 'YMdG7as6H31ib6VJJHQSBLRSU3776oxtX8MlP6kqKapNgvuxP6NBuMq7MoOl'),
(19, 'adad', '12312', 1, '1991-10-10', 'ewre@example.com', '$2y$10$rcscxSplVFNxaEmFTOOmremEcv94tDlw8ZbhCQEH3mNNrJ0vFKWRG', 'werwereererw234324', 'werewrwe', 'werwer', 'wer', 'were', NULL, 0, 0, 0, '2018-05-16 09:12:44', '2018-05-16 09:12:44', NULL, NULL, 'QXVfCoQ0bwRHt8lgs0Uc5Y3o5NWasyY5mJU1tyl6R8OIcAjdk67UQ496Dlai'),
(20, 'qwerqwer', '12342', 1, '1992-10-10', 'rfgrgrt@ererwe.com', '$2y$10$XAfz8127Tj0qBkWkiQ.8UOLjZ4sxy0/CbTeM9uIUxYFvrev3mt.2i', 'eretretertretr', 'wertt', 'wret', 'weter', 'wert', NULL, 0, 1, 0, NULL, NULL, NULL, NULL, NULL),
(21, 'qwerqwer1', '12342', 1, '1992-10-10', 'rfgrgrt1@ererwe.com', '$2y$10$KgBB.bp8s1EdFl19ohjTqu6XjPk8UMA8k55dCPINiZxzuGB74JPIy', 'eretretertretr', 'wertt', 'wret', 'weter', 'wert', '3', 0, 0, 0, NULL, '2018-05-17 06:23:18', NULL, NULL, NULL),
(22, 'qwerqwer11', '12342', 1, '1992-10-10', 'rfgrgrt11@ererwe.com', '$2y$10$AApuXzc.NQ0hQEKlUg2o1.6Igl0t6DKzlSiwTO99kRFn4vR/xrqz2', 'eretretertretr', 'wertt', 'wret', 'weter', 'wert', '2', 0, 1, 0, NULL, NULL, NULL, NULL, 'nZHLJ6z4y5PBQNcc02hpqzt0ms6t31KAo7tmh0a9twa3amQTY1b61sHRiJGo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam_name`
--
ALTER TABLE `exam_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_name_index`
--
ALTER TABLE `exam_name_index`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_name_index_questions`
--
ALTER TABLE `exam_name_index_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_name_index_questions_users`
--
ALTER TABLE `exam_name_index_questions_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_name_index_users`
--
ALTER TABLE `exam_name_index_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_timing`
--
ALTER TABLE `group_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_timing_attendees`
--
ALTER TABLE `group_timing_attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons_archive`
--
ALTER TABLE `lessons_archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons_archive_files`
--
ALTER TABLE `lessons_archive_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons_index`
--
ALTER TABLE `lessons_index`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `question_types`
--
ALTER TABLE `question_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD UNIQUE KEY `email` (`email`(13)),
  ADD UNIQUE KEY `id` (`id`,`email`(13)),
  ADD UNIQUE KEY `email_2` (`email`(30));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam_name`
--
ALTER TABLE `exam_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `exam_name_index`
--
ALTER TABLE `exam_name_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `exam_name_index_questions`
--
ALTER TABLE `exam_name_index_questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `exam_name_index_questions_users`
--
ALTER TABLE `exam_name_index_questions_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `exam_name_index_users`
--
ALTER TABLE `exam_name_index_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_timing`
--
ALTER TABLE `group_timing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group_timing_attendees`
--
ALTER TABLE `group_timing_attendees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_user`
--
ALTER TABLE `group_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lessons_archive`
--
ALTER TABLE `lessons_archive`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lessons_archive_files`
--
ALTER TABLE `lessons_archive_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lessons_index`
--
ALTER TABLE `lessons_index`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `question_types`
--
ALTER TABLE `question_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
