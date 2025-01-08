-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 02:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_tracer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Reyjohn Frias', 'reyjohn@gmail.com', '$2y$12$GuQFLU8lRKn.99nEaRlS.OVQ0xUsDBzpWI0TN6WcPr6kaPjgNIAIm', '2025-01-02 03:37:53', '2025-01-02 03:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `announcement_title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `announcement_title`, `start_date`, `end_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 'PSU Cooking Competition Alumni Edition', '2025-06-14', '2025-06-15', 'Venue: City Mall', 'Active', '2025-01-03 05:26:53', '2025-01-03 04:27:30'),
(5, 'Two Day Alumni Camp', '2025-02-10', '2025-02-11', 'PSU GROUNDS VENUE', 'Active', '2025-01-03 03:22:40', '2025-01-03 03:22:40'),
(6, 'PSU Alumni Rakrakan Festival!', '2025-04-07', '2025-04-07', 'PSU GROUNDS VENUE.', 'Active', '2025-01-03 03:24:28', '2025-01-03 05:22:30'),
(7, 'Hello PSUians', '2025-02-08', '2025-02-17', 'La Union, Philippines', 'Active', '2025-01-03 03:37:04', '2025-01-03 03:46:03'),
(8, 'Text Day', '2025-04-07', '2025-04-11', 'Lets Go PSUians!', 'Active', '2025-01-03 03:46:40', '2025-01-03 04:37:52'),
(9, 'Mass', '2025-02-06', '2025-02-06', 'St Pius Church Urbiz', 'Active', '2025-01-03 04:29:04', '2025-01-03 04:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_code`, `created_at`, `updated_at`) VALUES
(1, 'Bachelor of Science in Information Technology', 'BSIT', '2025-01-02 11:43:16', '2025-01-02 11:43:16'),
(2, 'Bachelor of Science in Office Administration', 'BSOA', '2025-01-03 05:42:58', '2025-01-03 05:42:58'),
(3, 'Bachelor of Science in Hospitality Management', 'BSHM', '2025-01-03 05:44:18', '2025-01-03 05:44:18'),
(4, 'Bachelor of Science in Business Administration', 'BSBA', '2025-01-03 05:44:46', '2025-01-03 05:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `employment_answers`
--

CREATE TABLE `employment_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employment_questions_ID` bigint(20) UNSIGNED NOT NULL,
  `user_ID` bigint(20) UNSIGNED NOT NULL,
  `user_employment_status_ID` bigint(20) UNSIGNED NOT NULL,
  `answer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employment_answers`
--

INSERT INTO `employment_answers` (`id`, `employment_questions_ID`, `user_ID`, `user_employment_status_ID`, `answer`, `created_at`, `updated_at`) VALUES
(1, 21, 4, 1, 'Advance or further study', '2025-01-02 15:50:59', '2025-01-02 15:51:04'),
(2, 21, 4, 1, 'Family concern and decided not to find a job', '2025-01-02 15:51:05', '2025-01-02 15:51:08'),
(3, 1, 4, 2, 'Regular or Permanent', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(4, 2, 4, 2, 'Professionals', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(5, 3, 4, 2, 'JM', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(6, 5, 4, 2, 'Education', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(7, 6, 4, 2, 'Local', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(8, 7, 4, 2, 'Yes', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(9, 8, 4, 2, 'Salaries and Benefits', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(10, 8, 4, 2, 'Career Challenge', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(11, 10, 4, 2, 'Career Challenge', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(12, 10, 4, 2, 'Related to special skill', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(13, 9, 4, 2, 'Yes', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(14, 11, 4, 2, 'Salaries and Benefits', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(15, 12, 4, 2, '7 to 11 months', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(16, 13, 4, 2, 'Recommended by someone', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(17, 14, 4, 2, '7 to 11 months', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(18, 15, 4, 2, 'Professional, Technical or Supervisory', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(19, 16, 4, 2, 'Professional, Technical or Supervisory', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(20, 17, 4, 2, 'Php 5,000.00 to less than Php 10,000.00', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(21, 18, 4, 2, 'Yes', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(22, 19, 4, 2, 'Communication Skills', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(23, 19, 4, 2, 'Human Relations Skills', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(24, 20, 4, 2, 'NA', '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(25, 22, 1, 3, 'Advance or further study', '2025-01-02 19:50:05', '2025-01-02 19:50:05'),
(26, 22, 1, 3, 'Family concern and decided not to find a job', '2025-01-02 19:50:05', '2025-01-02 19:50:05'),
(27, 22, 1, 3, 'Health-related reason(s)', '2025-01-02 19:50:05', '2025-01-02 19:50:05'),
(28, 21, 1, 4, 'Advance or further study', '2025-01-02 19:51:10', '2025-01-02 19:51:10'),
(29, 21, 1, 4, 'Family concern and decided not to find a job', '2025-01-02 19:51:10', '2025-01-02 19:51:10'),
(30, 21, 1, 4, 'Health-related reason(s)', '2025-01-02 19:51:10', '2025-01-02 19:51:10'),
(31, 21, 1, 5, 'Advance or further study', '2025-01-02 19:52:08', '2025-01-02 19:52:08'),
(32, 21, 1, 5, 'Family concern and decided not to find a job', '2025-01-02 19:52:08', '2025-01-02 19:52:08'),
(33, 21, 1, 5, 'Health-related reason(s)', '2025-01-02 19:52:08', '2025-01-02 19:52:08'),
(34, 21, 1, 5, 'Lack of work experience', '2025-01-02 19:52:08', '2025-01-02 19:52:08'),
(35, 1, 1, 6, 'Regular or Permanent', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(36, 2, 1, 6, 'Technicians and Associate Professionals', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(37, 3, 1, 6, 'PSU San Carlos', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(38, 5, 1, 6, 'Education', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(39, 6, 1, 6, 'Local', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(40, 7, 1, 6, 'Yes', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(41, 8, 1, 6, 'Salaries and Benefits', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(42, 8, 1, 6, 'Career Challenge', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(43, 8, 1, 6, 'Related to special skill', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(44, 8, 1, 6, 'Related to course or program of study', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(45, 9, 1, 6, 'Yes', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(46, 10, 1, 6, 'Salaries and Benefits', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(47, 10, 1, 6, 'Career Challenge', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(48, 10, 1, 6, 'Related to special skill', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(49, 11, 1, 6, 'Proximity to residence', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(50, 11, 1, 6, 'Other', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(51, 12, 1, 6, '1 to 6 months', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(52, 13, 1, 6, 'As walk-in applicant', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(53, 14, 1, 6, '1 to 6 months', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(54, 15, 1, 6, 'Professional, Technical or Supervisory', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(55, 16, 1, 6, 'Professional, Technical or Supervisory', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(56, 17, 1, 6, 'Php 20,000.00 to less than Php 25,000.00', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(57, 18, 1, 6, 'Yes', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(58, 19, 1, 6, 'Communication Skills', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(59, 19, 1, 6, 'Human Relations Skills', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(60, 19, 1, 6, 'Problem-solving Skills', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(61, 19, 1, 6, 'Critical Thinking Skills', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(62, 20, 1, 6, 'NA', '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(69, 21, 4, 12, 'Advance or further study', '2025-01-07 03:15:42', '2025-01-07 03:15:42'),
(70, 21, 4, 12, 'Family concern and decided not to find a job', '2025-01-07 03:15:42', '2025-01-07 03:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `employment_questions`
--

CREATE TABLE `employment_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `questions` varchar(255) NOT NULL,
  `employment_status_ID` bigint(20) UNSIGNED NOT NULL,
  `question_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employment_questions`
--

INSERT INTO `employment_questions` (`id`, `questions`, `employment_status_ID`, `question_type`, `created_at`, `updated_at`) VALUES
(1, 'Present Employment Status', 1, 'radio', '2025-01-02 12:24:59', '2025-01-02 12:24:59'),
(2, 'Present occupation (Use the following Phil. Standard Occupational Classification (PSOC), 1992 classification)', 1, 'radio', '2025-01-02 12:24:59', '2025-01-02 12:24:59'),
(3, 'Name of Company or Organization including Address', 1, 'text', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(4, 'Upload your company ID', 1, 'file', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(5, 'Major line of business of the company you are presently employed in. Please choose one only.', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(6, 'Place of Work', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(7, 'Is this your FIRST job after college? If NO, proceed to Questions 26 and 27.', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(8, 'What are the reasons for staying on the job? You may check more than one answer.', 1, 'checkbox', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(9, 'Is your FIRST job related to the course you took up in college?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(10, 'What were your reasons for accepting the job? You may choose more than one answer.', 1, 'checkbox', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(11, 'What were your reasons for changing the job? You may check more than one answer.', 1, 'checkbox', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(12, 'How long did you stay in your FIRST job?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(13, 'How did you find your FIRST job?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(14, 'How long did it take you to land your FIRST job?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(15, 'What is your job level position in your FIRST job?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(16, 'What is your job level position in your PRESENT job?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(17, 'What is your initial gross monthly earning in your FIRST job after college?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(18, 'Was the curriculum you had in college relevant to your FIRST job?', 1, 'radio', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(19, 'What competencies learned in college did you find very useful in your FIRST job? You may check more than one answer.', 1, 'checkbox', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(20, 'List down suggestions to further improve your course curriculum', 1, 'text', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(21, 'Please state reason(s) why you are not yet employed. You may check more than one answer.', 2, 'checkbox', '2025-01-02 04:54:28', '2025-01-02 04:54:28'),
(22, 'Please state reason(s) why you are not yet employed. You may check more than one answer.', 3, 'checkbox', '2025-01-02 04:54:28', '2025-01-02 04:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `employment_statuses`
--

CREATE TABLE `employment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employment_statuses`
--

INSERT INTO `employment_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Employed', '2025-01-02 13:40:01', '2025-01-02 13:40:01'),
(2, 'Unemployed', '2025-01-02 13:40:01', '2025-01-02 13:40:01'),
(3, 'NeverEmployed', '2025-01-02 13:40:35', '2025-01-02 13:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `employment_status_questions`
--

CREATE TABLE `employment_status_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employment_questions_ID` bigint(20) UNSIGNED NOT NULL,
  `employment_status_ID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employment_status_questions`
--

INSERT INTO `employment_status_questions` (`id`, `employment_questions_ID`, `employment_status_ID`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(2, 2, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(3, 3, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(4, 4, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(5, 5, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(6, 6, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(7, 7, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(8, 8, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(9, 9, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(10, 10, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(11, 11, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(12, 12, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(13, 13, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(14, 14, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(15, 15, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(16, 16, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(17, 17, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(18, 18, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(19, 19, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(20, 20, 1, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(21, 21, 2, '2025-01-02 05:45:03', '2025-01-02 05:45:03'),
(22, 21, 3, '2025-01-02 05:45:03', '2025-01-02 05:45:03');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `admin_ID` bigint(20) UNSIGNED NOT NULL,
  `new_value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`new_value`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `title`, `description`, `admin_ID`, `new_value`, `created_at`, `updated_at`) VALUES
(2, 'Changed Alumni Status.', 'Alumni status with student number of 21-SC-1496 changed to Archived', 1, NULL, '2025-01-02 23:54:30', '2025-01-02 23:54:30'),
(3, 'Changed Alumni Status.', 'Alumni status with student number of 21-SC-1496 changed to Active', 1, NULL, '2025-01-02 23:55:32', '2025-01-02 23:55:32'),
(4, 'Changed Announcement Status.', 'Announcement status with ID of 2 changed to Active', 1, NULL, '2025-01-03 01:54:34', '2025-01-03 01:54:34'),
(5, 'Changed Announcement Status.', 'Announcement status with ID of 1 changed to Active', 1, NULL, '2025-01-03 01:54:53', '2025-01-03 01:54:53'),
(6, 'Announcement Deleted.', 'Announcement deleted with an ID of 2', 1, NULL, '2025-01-03 02:13:31', '2025-01-03 02:13:31'),
(7, 'Announcement Deleted.', 'Announcement deleted with an ID of 4', 1, NULL, '2025-01-03 02:19:01', '2025-01-03 02:19:01'),
(8, 'New Announcement Created.', 'Announcement created with an ID of 5', 1, NULL, '2025-01-03 03:22:40', '2025-01-03 03:22:40'),
(9, 'New Announcement Created.', 'Announcement created with an ID of 6', 1, NULL, '2025-01-03 03:24:28', '2025-01-03 03:24:28'),
(10, 'New Announcement Created.', 'Announcement created with an ID of 7', 1, NULL, '2025-01-03 03:37:04', '2025-01-03 03:37:04'),
(11, 'New Announcement Created.', 'Announcement created with an ID of 8', 1, NULL, '2025-01-03 03:46:41', '2025-01-03 03:46:41'),
(12, 'New Announcement Created.', 'Announcement created with an ID of 9', 1, NULL, '2025-01-03 04:29:04', '2025-01-03 04:29:04'),
(13, 'Announcement Updated.', 'Announcement updated with ID of 8', 1, '{\"announcement_title\":\"Text Day\",\"start_date\":\"2025-04-07\",\"end_date\":\"2025-04-11\",\"description\":\"Lets Go PSUians!\"}', '2025-01-03 04:37:52', '2025-01-03 04:37:52'),
(14, 'Changed Alumni Status', 'Alumni status with student number 21-SC-1496 changed from Active to Archived', 1, '{\"student_ID\":\"21-SC-1496\",\"previous_status\":\"Active\",\"new_status\":\"Archived\"}', '2025-01-03 04:41:52', '2025-01-03 04:41:52'),
(15, 'Changed Alumni Status', 'Alumni status with student number 21-SC-1496 changed from Archived to Active', 1, '{\"student_ID\":\"21-SC-1496\",\"previous_status\":\"Archived\",\"new_status\":\"Active\"}', '2025-01-03 04:42:07', '2025-01-03 04:42:07'),
(16, 'Announcement Updated.', 'Announcement updated with ID of 3', 1, '{\"announcement_title\":\"PSU Cooking Competition Alumni Edition\",\"start_date\":\"2025-06-14\",\"end_date\":\"2025-06-15\",\"description\":\"Venue: City Mall\"}', '2025-01-03 05:21:38', '2025-01-03 05:21:38'),
(17, 'Announcement Updated.', 'Announcement updated with ID of 6', 1, '{\"announcement_title\":\"PSU Alumni Rakrakan Festival\",\"start_date\":\"2025-04-07\",\"end_date\":\"2025-04-07\",\"description\":\"PSU GROUNDS VENUE.\"}', '2025-01-03 05:22:14', '2025-01-03 05:22:14'),
(18, 'Announcement Updated.', 'Announcement updated with ID of 6', 1, '{\"announcement_title\":\"PSU Alumni Rakrakan Festival!\",\"start_date\":\"2025-04-07\",\"end_date\":\"2025-04-07\",\"description\":\"PSU GROUNDS VENUE.\"}', '2025-01-03 05:22:30', '2025-01-03 05:22:30'),
(19, 'New Course Created', 'Course \"Bachelor of Science in Office Administration\" with code \"BSOA\" was created.', 1, '{\"course_name\":\"Bachelor of Science in Office Administration\",\"course_code\":\"BSOA\",\"updated_at\":\"2025-01-03T13:42:58.000000Z\",\"created_at\":\"2025-01-03T13:42:58.000000Z\",\"id\":2}', '2025-01-03 05:42:58', '2025-01-03 05:42:58'),
(20, 'New Course Created', 'Course \"Bachelor of Science in Hospitality Management\" with code \"BSHM\" was created.', 1, '{\"course_name\":\"Bachelor of Science in Hospitality Management\",\"course_code\":\"BSHM\",\"updated_at\":\"2025-01-03T13:44:18.000000Z\",\"created_at\":\"2025-01-03T13:44:18.000000Z\",\"id\":3}', '2025-01-03 05:44:18', '2025-01-03 05:44:18'),
(21, 'New Course Created', 'Course \"Bachelor of Science in Business Administration\" with code \"BSBA\" was created.', 1, '{\"course_name\":\"Bachelor of Science in Business Administration\",\"course_code\":\"BSBA\",\"updated_at\":\"2025-01-03T13:44:46.000000Z\",\"created_at\":\"2025-01-03T13:44:46.000000Z\",\"id\":4}', '2025-01-03 05:44:46', '2025-01-03 05:44:46'),
(22, 'New Course Created', 'Course \"Bachelor of Secondary Education\" with code \"BSE\" was created.', 1, '{\"course_name\":\"Bachelor of Secondary Education\",\"course_code\":\"BSE\",\"updated_at\":\"2025-01-03T13:46:59.000000Z\",\"created_at\":\"2025-01-03T13:46:59.000000Z\",\"id\":5}', '2025-01-03 05:46:59', '2025-01-03 05:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2024_12_27_114458_create_courses_table', 1),
(4, '2024_12_27_114724_create_employment_statuses_table', 1),
(5, '2024_12_27_114725_create_users_table', 1),
(6, '2024_12_27_114726_create_employment__questions_table', 1),
(7, '2024_12_27_1147356_create_user_employment_statuses_table', 1),
(8, '2024_12_27_115000_create_employment__status__questions_table', 1),
(10, '2024_12_28_030342_create_personal_access_tokens_table', 1),
(11, '2024_12_28_060736_create_admins_table', 1),
(12, '2024_12_29_101926_drop_table_users', 1),
(13, '2025_01_02_033951_notifications_table', 1),
(14, '2025_01_02_111259_question_choices_table', 1),
(15, '2024_12_27_115001_create_employment_answers_table', 2),
(16, '2025_01_03_052017_create_announcements_table', 3),
(17, '2025_01_03_074340_create_logs_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_ID` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(4, 'App\\Models\\User', 2, 'alumnitracer', 'a43ef5ff8c4f2224446e237e02f48125d4ad8c3a92c96d1696d005ed3ce8a49b', '[\"*\"]', NULL, NULL, '2025-01-02 04:12:23', '2025-01-02 04:12:23'),
(5, 'App\\Models\\User', 3, 'alumnitracer', 'd069120b5603691cebd55c4f6abed8cf6da199f567f78a07065811b7c4b8b88c', '[\"*\"]', NULL, NULL, '2025-01-02 04:13:42', '2025-01-02 04:13:42'),
(13, 'App\\Models\\Admin', 1, 'alumnitracer', '039369d26461b25f370285cf7cd148cdfbf552b0ec02bca840e3b4084898d924', '[\"*\"]', '2025-01-07 17:16:41', NULL, '2025-01-02 18:01:01', '2025-01-07 17:16:41'),
(19, 'App\\Models\\User', 1, 'alumnitracer', 'ba283ef19790d8c2e90df65ec184dc7daf88d97ab428d72c6dbdcaf62f7382ef', '[\"*\"]', '2025-01-02 20:23:48', NULL, '2025-01-02 19:53:34', '2025-01-02 20:23:48'),
(21, 'App\\Models\\User', 4, 'alumnitracer', 'fbee1067b0e7c743083e5a3002b31c0748b01e8b4aef82f8941e4c6af8a54b98', '[\"*\"]', '2025-01-07 04:54:16', NULL, '2025-01-07 03:56:41', '2025-01-07 04:54:16'),
(23, 'App\\Models\\User', 5, 'alumnitracer', 'b7a76215cd374124ad442c1384c2e0ca35de991bf49f9efd91ef239c3192ed5a', '[\"*\"]', '2025-01-07 07:03:28', NULL, '2025-01-07 07:03:26', '2025-01-07 07:03:28'),
(25, 'App\\Models\\User', 18, 'alumnitracer', '1c8fb3734124d257cff4da55e8fd1e9ab2a2b90814daf6951f648f3fc49f5e21', '[\"*\"]', '2025-01-07 07:15:29', NULL, '2025-01-07 07:15:28', '2025-01-07 07:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `question_choices`
--

CREATE TABLE `question_choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employment_questions_ID` bigint(20) UNSIGNED NOT NULL,
  `choices` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_choices`
--

INSERT INTO `question_choices` (`id`, `employment_questions_ID`, `choices`, `created_at`, `updated_at`) VALUES
(1, 1, 'Regular or Permanent', '2025-01-02 12:28:11', '2025-01-02 12:28:11'),
(2, 1, 'Temporary', '2025-01-02 12:28:11', '2025-01-02 12:28:11'),
(3, 1, 'Casual', '2025-01-02 12:59:01', '2025-01-02 12:59:05'),
(4, 1, 'Contractual', '2025-01-02 12:59:07', '2025-01-02 12:59:10'),
(5, 1, 'Self-employed', '2025-01-02 12:59:11', '2025-01-02 12:59:14'),
(6, 2, 'Officials of Government and Special - Interest Organizations, Corporate Executive, Managers, Managing Proprietors and Supervisors', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(7, 2, 'Professionals', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(8, 2, 'Technicians and Associate Professionals', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(9, 2, 'Clerks', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(10, 2, 'Service workers and Shop and Market Sales Workers', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(11, 2, 'Farmers, Forestry, Workers, and Fisherman', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(12, 2, 'Trades, and Related Workers', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(13, 2, 'Plant and Machine Operators, and Assemblers', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(14, 2, 'Laborers and Unskilled Workers', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(15, 2, 'Special Occupation', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(16, 2, 'Other', '2025-01-02 05:01:12', '2025-01-02 05:01:12'),
(17, 5, 'Agriculture, Hunting, and Forestry', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(18, 5, 'Fishing', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(19, 5, 'Mining and Quarrying', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(20, 5, 'Manufacturing', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(21, 5, 'Electricity, Gas, and Water Supply', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(22, 5, 'Construction', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(23, 5, 'Wholesale and Retail Trade, Repair of motor vehicles, motorcycles and personal household goods', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(24, 5, 'Hotels and Restaurants', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(25, 5, 'Transport Storage and Communication', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(26, 5, 'Financial Intermediation', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(27, 5, 'Real State, Renting, and Business Activities', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(28, 5, 'Public Administration and Defense; Compulsory Social Security', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(29, 5, 'Education', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(30, 5, 'Health and Social Work', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(31, 5, 'Other community, Social and Personal Service Activities', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(32, 5, 'Private Households with Employed Persons', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(33, 5, 'Extra-territorial Organizations and Bodies', '2025-01-02 05:02:50', '2025-01-02 05:02:50'),
(34, 6, 'Local', '2025-01-02 05:03:32', '2025-01-02 05:03:32'),
(35, 6, 'Abroad', '2025-01-02 05:03:32', '2025-01-02 05:03:32'),
(36, 7, 'Yes', '2025-01-02 05:03:58', '2025-01-02 05:03:58'),
(37, 7, 'No', '2025-01-02 05:03:58', '2025-01-02 05:03:58'),
(38, 8, 'Salaries and Benefits', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(39, 8, 'Career Challenge', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(40, 8, 'Related to special skill', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(41, 8, 'Related to course or program of study', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(42, 8, 'Proximity to residence', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(43, 8, 'Peer influence', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(44, 8, 'Family influence', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(45, 8, 'Other', '2025-01-02 05:27:19', '2025-01-02 05:27:19'),
(54, 9, 'Yes', '2025-01-02 05:30:11', '2025-01-02 05:30:11'),
(55, 9, 'No', '2025-01-02 05:30:11', '2025-01-02 05:30:11'),
(56, 10, 'Salaries and Benefits', '2025-01-02 05:30:38', '2025-01-02 05:30:38'),
(57, 10, 'Career Challenge', '2025-01-02 05:30:38', '2025-01-02 05:30:38'),
(58, 10, 'Related to special skill', '2025-01-02 05:30:38', '2025-01-02 05:30:38'),
(59, 10, 'Proximity to residence', '2025-01-02 05:30:38', '2025-01-02 05:30:38'),
(60, 10, 'Other', '2025-01-02 05:30:38', '2025-01-02 05:30:38'),
(61, 11, 'Salaries and Benefits', '2025-01-02 05:31:15', '2025-01-02 05:31:15'),
(62, 11, 'Career Challenge', '2025-01-02 05:31:15', '2025-01-02 05:31:15'),
(63, 11, 'Related to special skill', '2025-01-02 05:31:15', '2025-01-02 05:31:15'),
(64, 11, 'Proximity to residence', '2025-01-02 05:31:15', '2025-01-02 05:31:15'),
(65, 11, 'Other', '2025-01-02 05:31:15', '2025-01-02 05:31:15'),
(66, 12, 'Less than a month', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(67, 12, '1 to 6 months', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(68, 12, '7 to 11 months', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(69, 12, '1 year to less than 2 years', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(70, 12, '2 years to less than 3 years', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(71, 12, '3 years to less than 4 years', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(72, 12, 'Other', '2025-01-02 05:33:30', '2025-01-02 05:33:30'),
(73, 13, 'Response to an advertisement', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(74, 13, 'As walk-in applicant', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(75, 13, 'Recommended by someone', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(76, 13, 'Information from friends', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(77, 13, 'Arranged by school\'s job placement officer', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(78, 13, 'Family business', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(79, 13, 'Job fair or Public Employment Service Office (PESO)', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(80, 13, 'Other', '2025-01-02 05:34:15', '2025-01-02 05:34:15'),
(81, 14, 'Less than a month', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(82, 14, '1 to 6 months', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(83, 14, '7 to 11 months', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(84, 14, '1 year to less than 2 years', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(85, 14, '2 years to less than 3 years', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(86, 14, '3 years to less than 4 years', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(87, 14, 'Other', '2025-01-02 05:34:58', '2025-01-02 05:34:58'),
(88, 15, 'Rank or Clerical', '2025-01-02 05:35:42', '2025-01-02 05:35:42'),
(89, 15, 'Professional, Technical or Supervisory', '2025-01-02 05:35:42', '2025-01-02 05:35:42'),
(90, 15, 'Managerial or Executive', '2025-01-02 05:35:42', '2025-01-02 05:35:42'),
(91, 15, 'Self-employed', '2025-01-02 05:35:42', '2025-01-02 05:35:42'),
(92, 16, 'Rank or Clerical', '2025-01-02 05:36:00', '2025-01-02 05:36:00'),
(93, 16, 'Professional, Technical or Supervisory', '2025-01-02 05:36:00', '2025-01-02 05:36:00'),
(94, 16, 'Managerial or Executive', '2025-01-02 05:36:00', '2025-01-02 05:36:00'),
(95, 16, 'Self-employed', '2025-01-02 05:36:00', '2025-01-02 05:36:00'),
(96, 17, 'Below Php 5,000.00', '2025-01-02 05:36:42', '2025-01-02 05:36:42'),
(97, 17, 'Php 5,000.00 to less than Php 10,000.00', '2025-01-02 05:36:42', '2025-01-02 05:36:42'),
(98, 17, 'Php 10,000.00 to less than Php 15,000.00', '2025-01-02 05:36:42', '2025-01-02 05:36:42'),
(99, 17, 'Php 15,000.00 to less than Php 20,000.00', '2025-01-02 05:36:42', '2025-01-02 05:36:42'),
(100, 17, 'Php 20,000.00 to less than Php 25,000.00', '2025-01-02 05:36:42', '2025-01-02 05:36:42'),
(101, 17, 'Php 25,000.00 and above', '2025-01-02 05:36:42', '2025-01-02 05:36:42'),
(102, 18, 'Yes', '2025-01-02 05:37:09', '2025-01-02 05:37:09'),
(103, 18, 'No', '2025-01-02 05:37:09', '2025-01-02 05:37:09'),
(104, 19, 'Communication Skills', '2025-01-02 05:38:58', '2025-01-02 05:38:58'),
(105, 19, 'Human Relations Skills', '2025-01-02 05:38:58', '2025-01-02 05:38:58'),
(106, 19, 'Entrepreneurial Skills', '2025-01-02 05:38:58', '2025-01-02 05:38:58'),
(107, 19, 'Problem-solving Skills', '2025-01-02 05:38:58', '2025-01-02 05:38:58'),
(108, 19, 'Critical Thinking Skills', '2025-01-02 05:38:58', '2025-01-02 05:38:58'),
(109, 19, 'Other', '2025-01-02 05:38:58', '2025-01-02 05:38:58'),
(110, 21, 'Advance or further study', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(111, 21, 'Family concern and decided not to find a job', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(112, 21, 'Health-related reason(s)', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(113, 21, 'Lack of work experience', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(114, 21, 'No job opportunity', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(115, 21, 'Did not look for a job', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(116, 21, 'Other', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(124, 22, 'Advance or further study', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(125, 22, 'Family concern and decided not to find a job', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(126, 22, 'Health-related reason(s)', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(127, 22, 'Lack of work experience', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(128, 22, 'No job opportunity', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(129, 22, 'Did not look for a job', '2025-01-02 05:39:37', '2025-01-02 05:39:37'),
(130, 22, 'Other', '2025-01-02 05:39:37', '2025-01-02 05:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `student_ID` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `contact_number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Deactivated',
  `course_ID` bigint(20) UNSIGNED NOT NULL,
  `region` varchar(255) DEFAULT NULL,
  `province` varchar(25) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `honors` varchar(255) DEFAULT NULL,
  `prof_exams` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`prof_exams`)),
  `remember_token` varchar(100) DEFAULT NULL,
  `activation_token` varchar(255) DEFAULT NULL,
  `is_activated` tinyint(1) NOT NULL DEFAULT 0,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `student_ID`, `sex`, `birthday`, `contact_number`, `address`, `civil_status`, `email`, `email_verified_at`, `password`, `status`, `course_ID`, `region`, `province`, `location`, `specialization`, `year`, `honors`, `prof_exams`, `remember_token`, `activation_token`, `is_activated`, `token_expires_at`, `created_at`, `updated_at`) VALUES
(1, 'Erjian', 'Arambulo', 'Soriano', '21-SC-1495', 'male', '2003-08-05', '09685144938', '633 Mabini St. Poblacion', 'Single', 'erjiansoriano05@gmail.com', NULL, '$2y$12$e/uf44SSn/bl5h39XDJYJ.VR5vFf59dIelKcDmEatjM1HkM1CqfAW', 'Active', 1, NULL, NULL, NULL, 'Web and Mobile', '2025', NULL, NULL, NULL, NULL, 0, NULL, '2025-01-02 04:08:33', '2025-01-02 04:08:33'),
(4, 'John Henderson', 'Gueleng', 'Gelido', '21-SC-1496', 'male', '2003-01-01', '09053310265', 'Mabini St., Poblacion Urbiztondo, Pangasinan Philippines', 'Single', 'johngelido@gmail.com', NULL, '$2y$12$eOjhbPgqsllo2eOVAMBYQe9luERI6/BtDXt9GXmNCpOf5Uo2qG0oi', 'Active', 1, 'Region 1', 'Pangasinan', 'City', 'Web and Mobile', '2025', 'NA', NULL, NULL, NULL, 0, NULL, '2025-01-02 04:15:19', '2025-01-07 04:15:02'),
(5, 'John Bryan', 'Resuello', 'Tisado', '21-SC-2024', 'Male', '2003-01-01', '9885576646', 'San Carlos City', 'Single', 'johnbryantisado', NULL, '$2y$12$tNJaxGrjzuDNC7oQIesqR..dWQA4ox9qGME6SERFtInKL2Eyd45TK', 'Deactivated', 1, 'Region 1', 'Pangasinan', 'City', 'Web', '2025', NULL, NULL, NULL, NULL, 0, NULL, '2025-01-07 04:46:57', '2025-01-07 04:46:57'),
(18, 'Renalyn', 'Aquino', 'Aquino', '21-SC-2025', 'Female', '2003-01-01', '9778226354', 'San Carlos City', 'Single', 'renalyn@mail.com', NULL, '$2y$12$xW3xikD0k9NgDdqZBJga3.9duWZUfOJWTr0SfMw3W67ilnfnIb2d.', 'Active', 1, 'Region 1', 'Pangasinan', 'City', 'Web', '2025', NULL, NULL, NULL, NULL, 0, NULL, '2025-01-07 06:26:27', '2025-01-07 07:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_employment_statuses`
--

CREATE TABLE `user_employment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employment_status_ID` bigint(20) UNSIGNED NOT NULL,
  `user_ID` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_employment_statuses`
--

INSERT INTO `user_employment_statuses` (`id`, `employment_status_ID`, `user_ID`, `created_at`, `updated_at`) VALUES
(1, 2, 4, '2025-01-02 07:42:46', '2025-01-02 08:31:32'),
(2, 1, 4, '2025-01-02 18:15:43', '2025-01-02 18:15:43'),
(3, 3, 1, '2025-01-02 19:50:05', '2025-01-02 19:50:05'),
(4, 2, 1, '2025-01-02 19:51:10', '2025-01-02 19:51:10'),
(5, 2, 1, '2025-01-02 19:52:08', '2025-01-02 19:52:08'),
(6, 1, 1, '2025-01-02 19:56:47', '2025-01-02 19:56:47'),
(12, 2, 4, '2025-01-07 03:15:42', '2025-01-07 03:15:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_answers`
--
ALTER TABLE `employment_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employment_answers_employment_questions_id_foreign` (`employment_questions_ID`),
  ADD KEY `employment_answers_user_id_foreign` (`user_ID`),
  ADD KEY `employment_answers_user_employment_status_id_foreign` (`user_employment_status_ID`);

--
-- Indexes for table `employment_questions`
--
ALTER TABLE `employment_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_statuses`
--
ALTER TABLE `employment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_status_questions`
--
ALTER TABLE `employment_status_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employment_status_questions_employment_questions_id_foreign` (`employment_questions_ID`),
  ADD KEY `employment_status_questions_employment_status_id_foreign` (`employment_status_ID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_admin_id_foreign` (`admin_ID`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_admin_id_foreign` (`admin_ID`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_choices_employment_questions_id_foreign` (`employment_questions_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_student_ID_unique` (`student_ID`),
  ADD KEY `users_course_id_foreign` (`course_ID`);

--
-- Indexes for table `user_employment_statuses`
--
ALTER TABLE `user_employment_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_employment_statuses_employment_status_id_foreign` (`employment_status_ID`),
  ADD KEY `user_employment_statuses_user_id_foreign` (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employment_answers`
--
ALTER TABLE `employment_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `employment_questions`
--
ALTER TABLE `employment_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `employment_statuses`
--
ALTER TABLE `employment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employment_status_questions`
--
ALTER TABLE `employment_status_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `question_choices`
--
ALTER TABLE `question_choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_employment_statuses`
--
ALTER TABLE `user_employment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employment_answers`
--
ALTER TABLE `employment_answers`
  ADD CONSTRAINT `employment_answers_employment_questions_id_foreign` FOREIGN KEY (`employment_questions_ID`) REFERENCES `employment_status_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employment_answers_user_employment_status_id_foreign` FOREIGN KEY (`user_employment_status_ID`) REFERENCES `user_employment_statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employment_answers_user_id_foreign` FOREIGN KEY (`user_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employment_status_questions`
--
ALTER TABLE `employment_status_questions`
  ADD CONSTRAINT `employment_status_questions_employment_questions_id_foreign` FOREIGN KEY (`employment_questions_ID`) REFERENCES `employment_questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employment_status_questions_employment_status_id_foreign` FOREIGN KEY (`employment_status_ID`) REFERENCES `employment_statuses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_admin_id_foreign` FOREIGN KEY (`admin_ID`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_admin_id_foreign` FOREIGN KEY (`admin_ID`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_choices`
--
ALTER TABLE `question_choices`
  ADD CONSTRAINT `question_choices_employment_questions_id_foreign` FOREIGN KEY (`employment_questions_ID`) REFERENCES `employment_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_course_id_foreign` FOREIGN KEY (`course_ID`) REFERENCES `courses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_employment_statuses`
--
ALTER TABLE `user_employment_statuses`
  ADD CONSTRAINT `user_employment_statuses_employment_status_id_foreign` FOREIGN KEY (`employment_status_ID`) REFERENCES `employment_statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_employment_statuses_user_id_foreign` FOREIGN KEY (`user_ID`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
