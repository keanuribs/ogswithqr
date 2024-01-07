-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 12:57 PM
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
-- Database: `dcs2`
--

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
(2, 'Laboratory');

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
-- Indexes for table `members`
--
ALTER TABLE `members`
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
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
