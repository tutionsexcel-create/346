-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2026 at 10:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exceltdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `content`, `status`, `created_at`) VALUES
(1, '<hr>About Excel Tuition\'s<br><br>At Excel Tuitions.com, we believe every student possesses unique potential that can be unlocked with the right guidance, personal attention, and learning environment. Established with a vision to make quality education accessible and effective, we specialize in delivering high-quality, flexible, and affordable home and online tuition tailored to meet each student\'s specific academic goals.<br><br>Our Mission<br><br>To empower students with confidence and strong foundational knowledge by providing convenient, personalized, and high-standard academic support—both online and offline—ensuring every learner achieves academic excellence without compromising on convenience or affordability.<br><br>Our Core Philosophies &amp; Value Pillars<br><br>Personalized Pedagogy: No two students learn at the exact same pace. Our experienced tutors assess each student\'s learning style, strengths, and areas for growth to craft customized lesson plans that yield real progress.<br><br>Flexibility &amp; Convenience: We adapt to busy family routines. Whether you prefer tutors coming to your home or structured live interactive online sessions, we schedule classes at times that suit you best.<br><br>Affordable Excellence: Premium private education shouldn\'t be out of reach. We offer highly competitive, transparent pricing models to ensure quality home tuition remains accessible to every family.<br><br>Safe &amp; Supportive Environment: We maintain a comfortable learning atmosphere—offering both 1-on-1 private tutoring and small group sessions—that encourages active participation, open questioning, and steady skill-building.<br><br>1. School Level (Classes 5th to 10th)<br><br>Building strong foundational concepts across SSC, CBSE, and ICSE boards. We focus on conceptual clarity, regular practice, and thorough preparation for school assessments and board exams.<br><br>2. Intermediate Level (I &amp; II Year)<br><br>Specialized subject tutoring for Junior and Senior Intermediate streams:<br><br>Mathematics &amp; Physical Sciences: Maths, Physics, Chemistry<br><br>Biological Sciences: Botany, Zoology<br><br>Languages: English, Hindi, Sanskrit<br><br>3. Engineering Stream (1st to 4th Year)<br><br>In-depth technical guidance for undergraduate engineering students across all semesters and major specializations:<br><br>First-Year Fundamentals (Engineering Mathematics, Physics, Programming)<br><br>Core Discipline Subjects (Computer Science, ECE, EEE, Mechanical, Civil)<br><br>Exam Preparation &amp; Backlog Clearance Support<br><br>Modes of Learning<br><br>Learning Mode<br><br>Features &amp; Benefits<br><br>Offline Home Tuition\'s<br><br>In-person guidance in the comfort and safety of your home. Direct supervision, face-to-face interaction, and minimal distraction.<br><br>Online Live Classes<br><br>Interactive digital whiteboards, screen sharing, and recorded sessions. Access expert tutors regardless of geographic limitations.<br><br>Why Choose Excel Tuition\'s?<br><br>Vetted &amp; Verified Tutors: Experienced subject matter experts selected through a stringent screening process.<br><br>Continuous Progress Monitoring: Regular tests, performance feedback, and direct communication with parents to track academic growth.<br><br>Structured Backlog &amp; Remedial Coaching: Dedicated focus on clearing complex concepts and overcoming academic bottlenecks.', 1, '2026-10-05 14:43:25');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uid`, `pwd`, `status`) VALUES
(1, 'rajan', '$2y$10$hkOvROSgTp4YcuV9zu/0HezmbAm6g8MxC9hFfkUZpUNbzKjmRaHQO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_logins`
--

CREATE TABLE `admin_logins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_logins`
--

INSERT INTO `admin_logins` (`id`, `username`, `login_time`, `logout_time`) VALUES
(1, 'rajan', '2024-12-02 22:12:34', NULL),
(2, 'rajan', '2024-12-02 22:20:59', '2024-12-02 22:50:14'),
(3, 'rajan', '2024-12-02 22:50:56', '2024-12-02 22:52:19'),
(4, 'rajan', '2024-12-02 22:52:36', '2024-12-02 22:53:15'),
(5, 'rajan', '2024-12-02 22:54:05', '2024-12-02 22:54:31'),
(6, 'rajan', '2024-12-02 22:54:38', '2024-12-02 22:55:38'),
(7, 'rajan', '2024-12-02 22:55:46', '2024-12-02 23:04:59'),
(8, 'rajan', '2024-12-02 23:05:06', NULL),
(9, 'rajan', '2024-12-03 01:37:46', NULL),
(10, 'rajan', '2024-12-09 07:50:29', '2024-12-09 08:02:25'),
(11, 'rajan', '2025-04-03 01:30:03', NULL),
(12, 'rajan', '2025-04-03 01:30:25', '2025-04-03 21:09:20'),
(13, 'rajan', '2026-10-03 12:43:27', '2026-10-03 12:44:13'),
(14, 'rajan', '2026-10-03 12:45:39', '2026-10-03 12:51:33'),
(15, 'rajan', '2026-10-04 01:10:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_tab`
--

CREATE TABLE `course_tab` (
  `id` int(11) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `faculty_id` int(10) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `time1_from` time NOT NULL,
  `time1_to` time NOT NULL,
  `time2_from` time NOT NULL,
  `time2_to` time NOT NULL,
  `time3_from` time NOT NULL,
  `time3_to` time NOT NULL,
  `time4_from` time NOT NULL,
  `time4_to` time NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty_logins`
--

CREATE TABLE `faculty_logins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_logins`
--

INSERT INTO `faculty_logins` (`id`, `username`, `login_time`, `logout_time`) VALUES
(1, 'srisoultech@gmail.com', '2024-12-06 05:53:42', NULL),
(2, 'srisoultech@gmail.com', '2024-12-06 05:55:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_registration`
--

CREATE TABLE `faculty_registration` (
  `id` int(11) NOT NULL,
  `tname` varchar(255) NOT NULL,
  `tfname` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone1` varchar(10) NOT NULL,
  `phone2` varchar(10) DEFAULT NULL,
  `subjects` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `aadharno` varchar(12) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_active` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email_verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_registration`
--

INSERT INTO `faculty_registration` (`id`, `tname`, `tfname`, `designation`, `qualification`, `gender`, `email`, `password`, `phone1`, `phone2`, `subjects`, `photo`, `address`, `aadharno`, `token`, `is_active`, `created_at`, `email_verified`) VALUES
(6, 'Rama Krishna Thangallapally', 'Krishna', 'Assistant Professor', 'PhD', 'Male', 'srisoultech@gmail.com', '$2y$10$dPMaTGQiS1MjbBWTRbPXb..Gn0HunCen34yywzP/ZlxdLL.W/sbtm', '9391461065', '', 'Mathematics, Physics, Chemistry', 'timages/6752d07cac428_TRK-NEW.jpg', '6-2-506, Nalgonda, Telangana', '123456789123', '', 'Active', '2024-12-06 10:22:52', 1),
(7, 'Rama', 'Krishna', 'Assistant Professor', 'PhD', 'Male', 'trk@gmail.com', '$2y$10$3/uhuO0rcEzX0lBaUCCtqOQ7d0ksJqO18vW.9Z7s0AgTWY63DmL.i', '9391461065', '', 'Computer Science, Mathematics, Physics', 'timages/67549a12c6307_g2.jpg', '6-2-506, Nalgonda, Telangana', '235546789123', '6271c4db4366cef2a3e7bdec5f44945b', 'Active', '2024-12-07 18:55:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_schedule`
--

CREATE TABLE `faculty_schedule` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty_schedule`
--

INSERT INTO `faculty_schedule` (`id`, `faculty_id`, `faculty_name`, `subject`, `schedule_date`, `schedule_time`, `created_at`) VALUES
(1, 7, '', 'Computer Science', '2025-01-11', '23:00:00', '2025-01-11 13:32:55'),
(2, 7, '', 'Computer Science', '2025-01-11', '09:04:00', '2025-01-11 13:34:58'),
(3, 7, '', 'Mathematics', '2025-01-11', '10:12:00', '2025-01-11 13:38:32'),
(4, 7, '', 'Computer Science', '2025-01-11', '11:25:00', '2025-01-11 13:55:51'),
(5, 7, '', 'Computer Science', '2025-01-11', '11:25:00', '2025-01-11 13:58:40'),
(6, 7, '', 'Computer Science', '2025-01-23', '07:34:00', '2025-01-11 13:58:54'),
(7, 7, '', 'Mathematics', '2025-01-11', '11:30:00', '2025-01-11 14:00:24'),
(8, 7, '', 'Mathematics', '2025-01-11', '11:30:00', '2025-01-11 14:01:33'),
(9, 7, '', 'Computer Science', '2025-01-12', '09:36:00', '2025-01-11 14:06:23'),
(10, 7, '', 'Mathematics', '2025-02-06', '11:37:00', '2025-01-11 14:07:21'),
(11, 7, '', 'Computer Science', '2025-01-23', '09:37:00', '2025-01-11 14:07:58');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `schedule_date` date NOT NULL,
  `from_time` time NOT NULL,
  `to_time` time NOT NULL,
  `slot_status` varchar(20) DEFAULT 'Available',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `schedule_date`, `from_time`, `to_time`, `slot_status`, `created_at`, `updated_at`) VALUES
(1, '2024-12-10', '09:00:00', '10:00:00', 'Available', '2024-12-10 04:29:11', '2024-12-10 04:29:11'),
(2, '2024-12-11', '11:00:00', '12:00:00', 'Available', '2024-12-10 04:29:11', '2024-12-10 04:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE `student_registration` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `syllabus` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_registration`
--

INSERT INTO `student_registration` (`id`, `uname`, `password`, `sname`, `fname`, `mobile`, `email`, `category`, `education`, `syllabus`, `subject`, `address`, `gender`, `status`, `created_at`, `token`, `photo`) VALUES
(6, 'trk', '$2y$10$bYX1eQEcDwjzahYRex5ChejBQf7wEA4RqBDjNwWAJohsk52fUt7RG', 'Ramakrishna Thangallapally', 'krishna', '9391461065', 'hlcnalgonda@gmail.com', 'OC', 'Inter-I', 'SSC', 'Maths,Physics,Chemistry,English,Hindi', 'Nalgonda', 'Male', 'Active', '2024-11-27 11:09:06', 'bf0cd10b88036c9a61234a5960856d60', 'simages/g2.jpg'),
(7, 'trkadmin', '$2y$10$Hy7zOCeQcvmB/QdWf7u7iurhiKyrX.O8WLxjKMeSKKRo.bW3rbByO', 'Krishna', 'Rama', '9391461065', 'hlcnalgonda@gmail.com', 'BC-B', '', 'CBSE', 'Physics,Zoology', '', 'Male', 'Inactive', '2024-11-27 13:09:55', 'ab24a55b4d4e3a098499d91cdff09da8', 'Array'),
(9, 'rama', '$2y$10$FHgQj9LupVEsXXh6cr/ecO7.3k/OzzGqOwLZfdFpTVqv76kliOsOi', 'Ramakrishna Thangallapally ', 'krishna', '9391461065', 'rama@gmail.com', 'BC-B', '10th', 'CBSE', 'Maths,Physics,Chemistry', 'nalgonda', 'Male', 'Inactive', '2024-11-28 02:12:48', '8fee1f31b77ae07a446eea0b410428ad', 'simages/6747d1a046f02_g2.jpg'),
(10, 'trk2', '$2y$10$KIQB9d67O39qpLctufEqFOoDysBuB51xxVMkHQY0z5TZ3tn0nkYxS', 'Krishna', 'Rama', '9703002456', 'trk@gmail.com', 'BC-B', 'Inter-I', 'CBSE', 'Chemistry,Computer Science,Physics', 'Nalgonda', 'Male', 'Active', '2024-12-07 19:04:52', '2c3d4db3ce590ee689005834aaff78e6', 'simages/67549c54c2c5e_g2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_schedule`
--

CREATE TABLE `student_schedule` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `faculty_schedule_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_time` time NOT NULL,
  `status` enum('booked','pending') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_schedule`
--

INSERT INTO `student_schedule` (`id`, `student_id`, `faculty_schedule_id`, `subject`, `schedule_date`, `schedule_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Computer Science', '2025-01-11', '23:00:00', 'booked', '2025-01-29 15:19:27', '2025-01-29 15:19:27'),
(2, 6, 13, 'Computer Science', '2025-01-31', '04:18:00', 'booked', '2025-01-29 17:44:33', '2025-01-29 17:44:33'),
(3, 6, 10, 'Mathematics', '2025-02-06', '11:41:00', 'booked', '2025-01-29 18:42:25', '2025-01-29 18:42:25'),
(4, 6, 14, 'Mathematics', '2025-01-31', '02:02:00', 'booked', '2025-01-30 13:57:13', '2025-01-30 13:57:13'),
(5, 6, 15, 'Mathematics', '2025-02-02', '03:58:00', 'booked', '2025-01-30 13:59:37', '2025-01-30 13:59:37');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `created_at`, `status`) VALUES
(1, 'Chemistry', '2024-12-03 07:04:01', 1),
(2, 'Mathematics', '2024-12-03 07:06:41', 1),
(3, 'Social', '2024-12-03 07:09:24', 1),
(4, 'Physics', '2024-12-03 07:24:39', 1),
(5, 'Zoology', '2024-12-03 08:37:08', 1),
(8, 'NEET', '2025-04-03 05:01:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tuition_tab`
--

CREATE TABLE `tuition_tab` (
  `id` int(11) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `total_duration` varchar(255) NOT NULL,
  `time1_from` time NOT NULL,
  `time1_to` time NOT NULL,
  `time2_from` time NOT NULL,
  `time2_to` time NOT NULL,
  `time3_from` time NOT NULL,
  `time3_to` time NOT NULL,
  `time4_from` time NOT NULL,
  `time4_to` time NOT NULL,
  `student_id` int(10) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `logout_time` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `username`, `login_time`, `logout_time`, `ip_address`) VALUES
(1, 'trkadmin', '2024-11-26 11:41:59', '2024-11-26 11:43:16', NULL),
(2, 'trkadmin', '2024-11-26 11:43:34', '2024-11-26 11:43:46', NULL),
(3, 'trkadmin', '2024-11-26 22:03:51', '2024-11-26 22:07:24', NULL),
(4, 'trkadmin', '2024-11-26 22:09:13', '2024-11-26 22:09:21', NULL),
(5, 'trkadmin', '2024-11-26 22:09:36', '2024-11-26 22:13:39', NULL),
(6, 'hlcnalgonda@gmail.com', '2024-11-27 05:00:26', '2024-11-27 05:11:46', NULL),
(7, 'trkadmin', '2024-11-27 21:07:23', '2024-11-27 21:13:11', NULL),
(8, 'trkadmin', '2024-11-27 21:13:18', '2024-11-27 21:17:47', NULL),
(9, 'rama', '2024-11-27 21:46:37', '2024-11-27 21:46:52', NULL),
(10, 'trk', '2024-12-02 09:45:20', '2024-12-02 09:45:26', NULL),
(11, 'trk', '2024-12-05 09:39:44', NULL, NULL),
(12, 'trk', '2024-12-05 20:33:58', '2024-12-05 20:35:24', NULL),
(13, 'trk', '2024-12-06 05:57:18', '2024-12-06 06:00:52', NULL),
(14, 'srisoultech@gmail.com', '2024-12-06 06:01:09', NULL, NULL),
(15, 'srisoultech@gmail.com', '2024-12-06 06:03:51', NULL, NULL),
(16, 'srisoultech@gmail.com', '2024-12-06 06:07:10', '2024-12-06 06:10:33', NULL),
(17, 'trk', '2024-12-06 06:13:21', '2024-12-06 06:15:57', NULL),
(18, 'srisoultech@gmail.com', '2024-12-06 10:46:08', '2024-12-06 05:38:48', '::1'),
(19, 'trk', '2024-12-06 11:08:55', '2024-12-06 05:39:19', '::1'),
(20, 'trk', '2024-12-06 11:09:31', '2024-12-06 05:39:45', '::1'),
(21, 'trk', '2024-12-06 11:09:57', '2024-12-06 05:40:03', '::1'),
(22, 'trk', '2024-12-06 11:11:29', '2024-12-06 11:11:44', '::1'),
(23, 'trk', '2024-12-06 12:06:09', '2024-12-06 12:06:30', '::1'),
(24, 'trk', '2024-12-06 12:06:45', '2024-12-06 12:23:25', '::1'),
(25, 'trk', '2024-12-06 12:24:10', '2024-12-06 12:26:58', '::1'),
(26, 'trk', '2024-12-06 12:27:07', '2024-12-06 12:27:51', '::1'),
(27, 'trk', '2024-12-06 12:27:59', NULL, '::1'),
(28, 'trk', '2024-12-06 13:21:20', '2024-12-06 13:35:01', '::1'),
(29, 'trk', '2024-12-06 13:35:25', '2024-12-06 17:22:36', '::1'),
(30, 'trk', '2024-12-06 17:22:44', NULL, '::1'),
(31, 'trk', '2024-12-07 06:58:15', '2024-12-07 18:38:05', '::1'),
(32, 'trk', '2024-12-07 10:26:27', '2024-12-07 18:38:05', '::1'),
(33, 'srisoultech@gmail.com', '2024-12-07 18:39:56', '2024-12-07 18:51:59', '::1'),
(34, 'trk@gmail.com', '2024-12-07 18:56:02', '2024-12-07 18:56:37', '::1'),
(35, 'srisoultech@gmail.com', '2024-12-07 19:48:13', '2024-12-11 01:49:33', '::1'),
(36, 'srisoultech@gmail.com', '2024-12-09 12:32:52', '2024-12-09 13:20:07', '::1'),
(37, 'srisoultech@gmail.com', '2024-12-09 13:32:03', '2024-12-09 23:30:45', '::1'),
(38, 'trk', '2024-12-09 23:30:53', NULL, '::1'),
(39, 'srisoultech@gmail.com', '2024-12-10 23:56:23', '2024-12-10 23:57:37', '::1'),
(40, 'trk', '2024-12-10 23:57:44', '2024-12-10 23:59:37', '::1'),
(41, 'srisoultech@gmail.com', '2024-12-10 23:59:48', '2024-12-11 01:49:33', '::1'),
(42, 'trk', '2024-12-11 01:49:40', '2024-12-11 10:49:40', '::1'),
(43, 'trk@gmail.com', '2024-12-11 10:49:54', '2024-12-11 10:50:32', '::1'),
(44, 'srisoultech@gmail.com', '2024-12-11 10:50:43', NULL, '::1'),
(45, 'trk@gmail.com', '2025-01-11 12:51:31', '2025-01-11 12:52:08', '::1'),
(46, 'trk', '2025-01-11 12:52:39', '2025-01-11 12:53:52', '::1'),
(47, 'trk@gmail.com', '2025-01-11 12:54:05', '2025-01-11 12:55:16', '::1'),
(48, 'trk@gmail.com', '2025-01-11 13:03:23', '2025-01-12 12:56:09', '::1'),
(49, 'trk', '2025-01-11 13:03:38', '2025-01-11 13:22:15', '::1'),
(50, 'trk@gmail.com', '2025-01-11 13:22:32', '2025-01-11 14:53:50', '::1'),
(51, 'trk@gmail.com', '2025-01-11 14:54:28', '2025-01-12 12:56:09', '::1'),
(52, 'trk@gmail.com', '2025-01-13 00:02:39', '2025-01-13 00:02:45', '::1'),
(53, 'trk', '2025-01-13 00:02:53', '2025-01-13 00:03:10', '::1'),
(54, 'trk', '2025-02-09 01:43:27', NULL, '::1'),
(55, 'trk@gmail.com', '2025-02-09 01:43:50', '2025-02-09 01:55:55', '::1'),
(56, 'trk', '2025-02-09 01:53:29', NULL, '127.0.0.1'),
(57, 'trk@gmail.com', '2025-02-09 01:55:43', '2025-02-09 01:55:55', '127.0.0.1'),
(58, 'trk', '2025-02-09 01:56:05', '2025-02-09 01:56:24', '127.0.0.1'),
(59, 'trk', '2025-02-09 01:58:54', '2025-02-09 02:10:31', '::1'),
(60, 'trk', '2025-02-09 02:06:38', '2025-02-09 02:06:54', '::1'),
(61, 'trk', '2025-03-19 08:30:08', NULL, '::1'),
(62, 'trk@gmail.com', '2025-03-19 08:30:43', '2025-03-19 08:31:25', '::1'),
(63, 'trk', '2025-03-19 08:31:48', NULL, '::1'),
(64, 'trk@gmail.com', '2025-03-19 08:33:42', '2025-03-19 08:34:06', '::1'),
(65, 'trk', '2025-03-19 08:38:19', NULL, '::1'),
(66, 'trk@gmail.com', '2025-03-19 08:39:29', '2025-03-19 08:40:53', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_logins`
--
ALTER TABLE `admin_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_tab`
--
ALTER TABLE `course_tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_logins`
--
ALTER TABLE `faculty_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_registration`
--
ALTER TABLE `faculty_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `aadharno` (`aadharno`);

--
-- Indexes for table `faculty_schedule`
--
ALTER TABLE `faculty_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `student_registration`
--
ALTER TABLE `student_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- Indexes for table `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tuition_tab`
--
ALTER TABLE `tuition_tab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_logins`
--
ALTER TABLE `admin_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `course_tab`
--
ALTER TABLE `course_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty_logins`
--
ALTER TABLE `faculty_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty_registration`
--
ALTER TABLE `faculty_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `faculty_schedule`
--
ALTER TABLE `faculty_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_registration`
--
ALTER TABLE `student_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_schedule`
--
ALTER TABLE `student_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tuition_tab`
--
ALTER TABLE `tuition_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `faculty_schedule`
--
ALTER TABLE `faculty_schedule`
  ADD CONSTRAINT `faculty_schedule_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty_registration` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
