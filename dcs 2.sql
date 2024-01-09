-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2024 at 04:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `finals_exam`
--

CREATE TABLE `finals_exam` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `finals_exam_score` int(11) DEFAULT NULL,
  `finals_exam_total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finals_exam`
--

INSERT INTO `finals_exam` (`id`, `option_selected`, `finals_exam_score`, `finals_exam_total`) VALUES
(1, 'finalsExam', 90, 140);

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `overall_total` int(11) DEFAULT NULL,
  `number_of_participants` int(11) DEFAULT NULL,
  `weighted_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `option_selected`, `overall_total`, `number_of_participants`, `weighted_total`) VALUES
(28, 'classParticipation', 118, 17, 1.44),
(29, 'classParticipation', 118, 17, 1.44);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `country` varchar(20) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active | 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `email`, `gender`, `country`, `created`, `modified`, `status`) VALUES
(3, 'cha', 'Char', '2323@gmail.com', 'Female', 'Philippines', '2023-12-03 10:19:49', '2023-12-03 19:49:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `midterm`
--

CREATE TABLE `midterm` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `midterm_exam_score` float DEFAULT NULL,
  `midterm_exam_total` float DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `midterm`
--

INSERT INTO `midterm` (`id`, `option_selected`, `midterm_exam_score`, `midterm_exam_total`, `weight`) VALUES
(4, 'midtermExam', 80, 100, 16.00);

-- --------------------------------------------------------

--
-- Table structure for table `output_portfolio`
--

CREATE TABLE `output_portfolio` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `overall_total_score` double DEFAULT NULL,
  `overall_num_works` double DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `num_of_works_1` float DEFAULT NULL,
  `score_1` float DEFAULT NULL,
  `num_of_works_2` float DEFAULT NULL,
  `score_2` float DEFAULT NULL,
  `num_of_works_3` float DEFAULT NULL,
  `score_3` float DEFAULT NULL,
  `num_of_works_4` float DEFAULT NULL,
  `score_4` float DEFAULT NULL,
  `num_of_works_5` float DEFAULT NULL,
  `score_5` float DEFAULT NULL,
  `num_of_works_6` float DEFAULT NULL,
  `score_6` float DEFAULT NULL,
  `num_of_works_7` float DEFAULT NULL,
  `score_7` float DEFAULT NULL,
  `num_of_works_8` float DEFAULT NULL,
  `score_8` float DEFAULT NULL,
  `num_of_works_9` float DEFAULT NULL,
  `score_9` float DEFAULT NULL,
  `num_of_works_10` float DEFAULT NULL,
  `score_10` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `output_portfolio`
--

INSERT INTO `output_portfolio` (`id`, `option_selected`, `overall_total_score`, `overall_num_works`, `weight`, `num_of_works_1`, `score_1`, `num_of_works_2`, `score_2`, `num_of_works_3`, `score_3`, `num_of_works_4`, `score_4`, `num_of_works_5`, `score_5`, `num_of_works_6`, `score_6`, `num_of_works_7`, `score_7`, `num_of_works_8`, `score_8`, `num_of_works_9`, `score_9`, `num_of_works_10`, `score_10`) VALUES
(3, 'outputPortfolio', 20, 20, 25.00, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `output_portfolio2`
--

CREATE TABLE `output_portfolio2` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `num_of_works_1` int(11) DEFAULT NULL,
  `score_1` int(11) DEFAULT NULL,
  `num_of_works_2` int(11) DEFAULT NULL,
  `score_2` int(11) DEFAULT NULL,
  `num_of_works_3` int(11) DEFAULT NULL,
  `score_3` int(11) DEFAULT NULL,
  `num_of_works_4` int(11) DEFAULT NULL,
  `score_4` int(11) DEFAULT NULL,
  `num_of_works_5` int(11) DEFAULT NULL,
  `score_5` int(11) DEFAULT NULL,
  `num_of_works_6` int(11) DEFAULT NULL,
  `score_6` int(11) DEFAULT NULL,
  `num_of_works_7` int(11) DEFAULT NULL,
  `score_7` int(11) DEFAULT NULL,
  `num_of_works_8` int(11) DEFAULT NULL,
  `score_8` int(11) DEFAULT NULL,
  `num_of_works_9` int(11) DEFAULT NULL,
  `score_9` int(11) DEFAULT NULL,
  `num_of_works_10` int(11) DEFAULT NULL,
  `score_10` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `output_portfolio2`
--

INSERT INTO `output_portfolio2` (`id`, `option_selected`, `num_of_works_1`, `score_1`, `num_of_works_2`, `score_2`, `num_of_works_3`, `score_3`, `num_of_works_4`, `score_4`, `num_of_works_5`, `score_5`, `num_of_works_6`, `score_6`, `num_of_works_7`, `score_7`, `num_of_works_8`, `score_8`, `num_of_works_9`, `score_9`, `num_of_works_10`, `score_10`) VALUES
(2, 'outputPortfolio', 4, 4, 4, 4, 4, 4, 44, 4, 44, 4, 4, 4, 4, 4, 4, 4, 44, 44, 44, 4);

-- --------------------------------------------------------

--
-- Table structure for table `performance_after_midterm`
--

CREATE TABLE `performance_after_midterm` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `overall_total` int(11) DEFAULT NULL,
  `number_of_participants` int(11) DEFAULT NULL,
  `weighted_total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `performance_after_midterm`
--

INSERT INTO `performance_after_midterm` (`id`, `option_selected`, `overall_total`, `number_of_participants`, `weighted_total`) VALUES
(4, 'classParticipation', 15, 5, 3.33),
(5, 'quizzesExams', NULL, NULL, NULL),
(6, 'outputPortfolio', NULL, NULL, NULL),
(7, 'outputPortfolio', NULL, NULL, NULL),
(8, 'finalsExam', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `quiz1_score` float NOT NULL DEFAULT 0,
  `quiz1_total` float NOT NULL DEFAULT 0,
  `quiz2_score` float NOT NULL DEFAULT 0,
  `quiz2_total` float NOT NULL DEFAULT 0,
  `quiz3_score` float NOT NULL DEFAULT 0,
  `quiz3_total` float NOT NULL DEFAULT 0,
  `quiz4_score` float NOT NULL DEFAULT 0,
  `quiz4_total` float NOT NULL DEFAULT 0,
  `quiz5_score` float NOT NULL DEFAULT 0,
  `quiz5_total` float NOT NULL DEFAULT 0,
  `quiz6_score` float NOT NULL DEFAULT 0,
  `quiz6_total` float NOT NULL DEFAULT 0,
  `quiz7_score` float NOT NULL DEFAULT 0,
  `quiz7_total` float NOT NULL DEFAULT 0,
  `quiz8_score` float NOT NULL DEFAULT 0,
  `quiz8_total` float NOT NULL DEFAULT 0,
  `quiz9_score` float NOT NULL DEFAULT 0,
  `quiz9_total` float NOT NULL DEFAULT 0,
  `quiz10_score` float NOT NULL DEFAULT 0,
  `quiz10_total` float NOT NULL DEFAULT 0,
  `total_quiz_score` int(11) DEFAULT NULL,
  `total_quiz_total` int(11) DEFAULT NULL,
  `total_weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `option_selected`, `quiz1_score`, `quiz1_total`, `quiz2_score`, `quiz2_total`, `quiz3_score`, `quiz3_total`, `quiz4_score`, `quiz4_total`, `quiz5_score`, `quiz5_total`, `quiz6_score`, `quiz6_total`, `quiz7_score`, `quiz7_total`, `quiz8_score`, `quiz8_total`, `quiz9_score`, `quiz9_total`, `quiz10_score`, `quiz10_total`, `total_quiz_score`, `total_quiz_total`, `total_weight`) VALUES
(3, 'quizzesExams', 5, 5, 5, 5, 5, 5, 5, 5, 5, 2, 5, 5, 5, 5, 5, 5, 5, 5, 5, 20, 47, 65, 10.85),
(5, 'quizzesExams', 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 4, 44, 44, 4, 4, 4, 4, 40, 120, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `quiz2`
--

CREATE TABLE `quiz2` (
  `id` int(11) NOT NULL,
  `option_selected` varchar(255) DEFAULT NULL,
  `quiz1_score` float NOT NULL DEFAULT 0,
  `quiz1_total` float NOT NULL DEFAULT 0,
  `quiz2_score` float NOT NULL DEFAULT 0,
  `quiz2_total` float NOT NULL DEFAULT 0,
  `quiz3_score` float NOT NULL DEFAULT 0,
  `quiz3_total` float NOT NULL DEFAULT 0,
  `quiz4_score` float NOT NULL DEFAULT 0,
  `quiz4_total` float NOT NULL DEFAULT 0,
  `quiz5_score` float NOT NULL DEFAULT 0,
  `quiz5_total` float NOT NULL DEFAULT 0,
  `quiz6_score` float NOT NULL DEFAULT 0,
  `quiz6_total` float NOT NULL DEFAULT 0,
  `quiz7_score` float NOT NULL DEFAULT 0,
  `quiz7_total` float NOT NULL DEFAULT 0,
  `quiz8_score` float NOT NULL DEFAULT 0,
  `quiz8_total` float NOT NULL DEFAULT 0,
  `quiz9_score` float NOT NULL DEFAULT 0,
  `quiz9_total` float NOT NULL DEFAULT 0,
  `quiz10_score` float NOT NULL DEFAULT 0,
  `quiz10_total` float NOT NULL DEFAULT 0,
  `total_quiz_score` int(11) DEFAULT NULL,
  `total_quiz_total` int(11) DEFAULT NULL,
  `total_weight` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz2`
--

INSERT INTO `quiz2` (`id`, `option_selected`, `quiz1_score`, `quiz1_total`, `quiz2_score`, `quiz2_total`, `quiz3_score`, `quiz3_total`, `quiz4_score`, `quiz4_total`, `quiz5_score`, `quiz5_total`, `quiz6_score`, `quiz6_total`, `quiz7_score`, `quiz7_total`, `quiz8_score`, `quiz8_total`, `quiz9_score`, `quiz9_total`, `quiz10_score`, `quiz10_total`, `total_quiz_score`, `total_quiz_total`, `total_weight`) VALUES
(3, 'quizzesExams', 2, 3, 15, 5, 0, 2, 7, 15, 6, 15, 5, 10, 20, 10, 10, 16, 20, 20, 10, 15, 70, 136, 29.14);

-- --------------------------------------------------------

--
-- Table structure for table `tblattendance`
--

CREATE TABLE `tblattendance` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `attendance_status` enum('Present','Late','Absent') DEFAULT NULL,
  `attendance_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) DEFAULT NULL,
  `day_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `year_level` int(11) NOT NULL,
  `class_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `qr_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `time` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `subject_code` varchar(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `qr_code_filename` varchar(255) DEFAULT NULL,
  `day_name` varchar(20) DEFAULT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `class_type` varchar(50) NOT NULL,
  `valid_day` int(11) NOT NULL,
  `valid_time_start` time DEFAULT NULL,
  `valid_time_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`id`, `professor_id`, `day_id`, `course_id`, `section_id`, `year_level`, `class_date`, `start_time`, `end_time`, `qr_code`, `created_at`, `time`, `time_end`, `subject_code`, `subject_name`, `qr_code_filename`, `day_name`, `qr_code_path`, `class_type`, `valid_day`, `valid_time_start`, `valid_time_end`) VALUES
(90, 2, 1, 1, 1, 1, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0?q\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATX????m?@ف??R0\"?N??量Y???\0?w??=w?Z???<T???-?L/θO?g??[٩s?ܞ?Q??7?{????g??ڿ?7\Z?w?l????^?Zܞ?.c??:>%????w.*g??x???&??(??e-ނ??A?r?+??dO??A?W????_e?ۇs5?P?uzk?όj??', '2023-12-20 08:32:39', '10:00:00', '11:00:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_90.png', '1', 1, NULL, NULL),
(91, 1, 1, 1, 1, 4, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0#{\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATH???э1D?????opr?oXE^??*?0??UY=0ƻ?*)U}?yv@#{?9e_?\r?h?x?RR????+ʜ[??????vC??_?w??W??Ǥ???a???????E2W?x@?????Q??????\'?	{?Z???w9:????kϰ=?oi#{9?4??5mXX????C', '2024-01-07 11:26:01', '19:25:00', '19:26:00', 'sds', 'ssd', NULL, NULL, 'qrcodes/class_91.png', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblclasstype`
--

CREATE TABLE `tblclasstype` (
  `id` int(11) NOT NULL,
  `class_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblclasstype`
--

INSERT INTO `tblclasstype` (`id`, `class_type`) VALUES
(1, 'Lecture'),
(2, 'Lecture with Lab');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`course_id`, `course_name`) VALUES
(1, 'BSIT'),
(2, 'BSCS');

-- --------------------------------------------------------

--
-- Table structure for table `tbldays`
--

CREATE TABLE `tbldays` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldays`
--

INSERT INTO `tbldays` (`day_id`, `day_name`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `tblprofessors`
--

CREATE TABLE `tblprofessors` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblprofessors`
--

INSERT INTO `tblprofessors` (`id`, `last_name`, `first_name`, `middle_name`, `email`) VALUES
(1, 'Tyrell', 'Bowen', 'A', 'Bowen.Tyrell@gmail.com'),
(2, 'Forteza', 'Jollyvher', 'Alamo', 'fortezajollyvher3@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tblsection`
--

CREATE TABLE `tblsection` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsection`
--

INSERT INTO `tblsection` (`section_id`, `section_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'H'),
(9, 'I');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `student_number` int(9) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` int(11) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `last_name`, `first_name`, `middle_name`, `student_number`, `course`, `year`, `section`) VALUES
(1, 'Dominguez', 'Robinn', 'May', 202010123, 'BSIT', 4, 'A'),
(2, 'Vermosa', 'Victor', 'Anastacio', 202010124, 'BSIT', 4, 'A'),
(3, 'Serkis', 'Vice', 'Mariano', 202010125, 'BSIT', 3, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `tblyearlvl`
--

CREATE TABLE `tblyearlvl` (
  `id` int(11) NOT NULL,
  `yr_lvl` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblyearlvl`
--

INSERT INTO `tblyearlvl` (`id`, `yr_lvl`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user2`
--

CREATE TABLE `user2` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(3) NOT NULL,
  `email` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `otp_creation_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `code`, `otp_creation_time`) VALUES
(57, 'Cha', 'valdezcharliet@gmail.com', '25d55ad283aa400af464c76d713c07ad', '', '2023-12-05 06:22:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finals_exam`
--
ALTER TABLE `finals_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `midterm`
--
ALTER TABLE `midterm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `output_portfolio`
--
ALTER TABLE `output_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `output_portfolio2`
--
ALTER TABLE `output_portfolio2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_after_midterm`
--
ALTER TABLE `performance_after_midterm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz2`
--
ALTER TABLE `quiz2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `qr_code` (`qr_code`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `year_lvl_id` (`year_level`);

--
-- Indexes for table `tblclasstype`
--
ALTER TABLE `tblclasstype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbldays`
--
ALTER TABLE `tbldays`
  ADD PRIMARY KEY (`day_id`);

--
-- Indexes for table `tblprofessors`
--
ALTER TABLE `tblprofessors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsection`
--
ALTER TABLE `tblsection`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblyearlvl`
--
ALTER TABLE `tblyearlvl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user2`
--
ALTER TABLE `user2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finals_exam`
--
ALTER TABLE `finals_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `midterm`
--
ALTER TABLE `midterm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `output_portfolio`
--
ALTER TABLE `output_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `output_portfolio2`
--
ALTER TABLE `output_portfolio2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `performance_after_midterm`
--
ALTER TABLE `performance_after_midterm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz2`
--
ALTER TABLE `quiz2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tblclasstype`
--
ALTER TABLE `tblclasstype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblprofessors`
--
ALTER TABLE `tblprofessors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblsection`
--
ALTER TABLE `tblsection`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblyearlvl`
--
ALTER TABLE `tblyearlvl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user2`
--
ALTER TABLE `user2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblattendance`
--
ALTER TABLE `tblattendance`
  ADD CONSTRAINT `tblattendance_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `tblclass` (`id`),
  ADD CONSTRAINT `tblattendance_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `tblstudents` (`id`);

--
-- Constraints for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD CONSTRAINT `tblclass_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `tblprofessors` (`id`),
  ADD CONSTRAINT `tblclass_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`),
  ADD CONSTRAINT `tblclass_ibfk_3` FOREIGN KEY (`section_id`) REFERENCES `tblsection` (`section_id`),
  ADD CONSTRAINT `tblclass_ibfk_4` FOREIGN KEY (`year_level`) REFERENCES `tblyearlvl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
