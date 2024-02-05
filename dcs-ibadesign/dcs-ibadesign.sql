-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 08:19 AM
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
-- Database: `dcs-try`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_list`
--

CREATE TABLE `academic_list` (
  `academic_id` int(30) NOT NULL,
  `year` varchar(255) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=Pending,1=Start,2=Closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_list`
--

INSERT INTO `academic_list` (`academic_id`, `year`, `semester`, `status`) VALUES
(1, '2023-2024', 'FIRST', 1),
(2, '2023-2024', 'SECOND', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `courses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `courses`) VALUES
(1, 'BSIT'),
(2, 'BSCS');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_number` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `middle_name` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `major` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_number`, `user_id`, `middle_name`, `semester`, `course`, `section`, `school_year`, `status`, `major`, `address`) VALUES
(20201412, 44, 'T', 'FIRST', '1', '1', '2023-2024', '1', 'N/A', 'B1L18');

-- --------------------------------------------------------

--
-- Table structure for table `student_section`
--

CREATE TABLE `student_section` (
  `section_id` int(11) NOT NULL,
  `section` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_section`
--

INSERT INTO `student_section` (`section_id`, `section`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F'),
(7, 'G'),
(8, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `student_status`
--

CREATE TABLE `student_status` (
  `status_id` int(11) NOT NULL,
  `stud_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_status`
--

INSERT INTO `student_status` (`status_id`, `stud_status`) VALUES
(1, 'REGULAR'),
(2, 'IRREGULAR');

-- --------------------------------------------------------

--
-- Table structure for table `student_year`
--

CREATE TABLE `student_year` (
  `year_id` int(11) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_year`
--

INSERT INTO `student_year` (`year_id`, `year`) VALUES
(1, 'FIRST'),
(2, 'SECOND'),
(3, 'THIRD'),
(4, 'FOURTH');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `sched_code` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_desc` varchar(255) NOT NULL,
  `units` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `sched_code`, `course_code`, `course_desc`, `units`, `time`, `day`, `room`) VALUES
(1, '202311044', 'DCIT65A', 'SOCIAL AND PROFESSIONAL ISSUES', '3', '12:00-14:00 / 14:00-15:00', 'T / T', 'CL 6 / CL 6'),
(2, '202311045', 'ITEC111', 'IT ELECTIVE 3', '3', '07:00-09:00 / 13:00-16:00', 'TH / S', 'LR 2 / A-304');

-- --------------------------------------------------------

--
-- Table structure for table `subject_registration`
--

CREATE TABLE `subject_registration` (
  `id` int(11) NOT NULL,
  `student_number` int(11) DEFAULT NULL,
  `sched_code` varchar(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_registration`
--

INSERT INTO `subject_registration` (`id`, `student_number`, `sched_code`, `course_code`, `course_desc`) VALUES
(1, 20201412, '202311044', 'DCIT65A', 'SOCIAL AND PROFESSIONAL ISSUES'),
(2, 20201412, '202311044', 'DCIT65A', 'SOCIAL AND PROFESSIONAL ISSUES'),
(3, 20201412, '202311045', 'ITEC111', 'IT ELECTIVE 3'),
(4, 20201412, '202311044', 'DCIT65A', 'SOCIAL AND PROFESSIONAL ISSUES'),
(5, 20201412, '202311045', 'ITEC111', 'IT ELECTIVE 3'),
(6, 20201412, '202311044', 'DCIT65A', 'SOCIAL AND PROFESSIONAL ISSUES'),
(7, 20201412, '202311045', 'ITEC111', 'IT ELECTIVE 3');

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

--
-- Dumping data for table `tblattendance`
--

INSERT INTO `tblattendance` (`id`, `class_id`, `student_id`, `attendance_status`, `attendance_time`) VALUES
(26, 96, 1, 'Late', '2024-01-10 01:40:28'),
(32, 96, 1, 'Present', '2024-01-12 00:00:00'),
(33, 96, 1, 'Late', '2024-01-12 00:05:00'),
(34, 96, 2, 'Absent', '2024-01-12 01:00:00'),
(35, 96, 2, 'Present', '2024-01-12 01:05:00'),
(36, 96, 3, 'Late', '2024-01-12 02:00:00');

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
(91, 1, 1, 1, 1, 4, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0#{\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATH???э1D?????opr?oXE^??*?0??UY=0ƻ?*)U}?yv@#{?9e_?\r?h?x?RR????+ʜ[??????vC??_?w??W??Ǥ???a???????E2W?x@?????Q??????\'?	{?Z???w9:????kϰ=?oi#{9?4??5mXX????C', '2024-01-07 11:26:01', '19:25:00', '19:26:00', 'sds', 'ssd', NULL, NULL, 'qrcodes/class_91.png', '1', 1, NULL, NULL),
(92, 1, 1, 1, 1, 1, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0#{\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATH???[r1???%7?Ѓ6???e??r??????T)#?o-iJ??X}??6fs?6?W4ڊz?i??P%?8???ma??~5?Q{??????jV??$?(ύ H?H?x??Q????^?V???\nq?$???\n#aD&?{;??i????yM{/???&a2.(Ď.\"??P\n^??Be????\"', '2024-01-09 12:06:11', '20:00:00', '21:00:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_92.png', '1', 1, NULL, NULL),
(93, 1, 1, 1, 1, 4, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0#{\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATH???ۍAɀ??$?j????#???9??yFDdvuFt??x?H?;k?Xs?\\???Xf?E#jL??????/Lujl??H???D????m??IN(?*ɖ??͍?4/??4?N??!???3?y??C^??e?d?+???m?TI(?(?5{?{C G?X(?MTG!???}', '2024-01-09 12:36:57', '20:00:00', '21:00:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_93.png', '1', 1, NULL, NULL),
(94, 2, 1, 1, 1, 1, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0?q\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATX????m?0D????Lf? ??A?2?ϝ??ٛ;v??<??????}?\"?]?E_?]>?k?????qK?lA}?崛%s?\r????????????Hjv????C-n??\\?`???S⢐??C???IR??M%?K6?W??k\r?%?t??#S?iM??W??qʠ 0%?????q$??d:ye?', '2024-01-09 14:13:12', '06:00:00', '07:00:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_94.png', '1', 1, NULL, NULL),
(95, 2, 3, 1, 1, 4, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0?q\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATX???[nQC????ށ??K?~?f?g???y13????û?yU??{?????r?F????#??k???];¿k???ȯ?l^???????W>????_?]*?\"5???1??΁?Z???.+???Գ\rF????a?T??`??+??6??V-~?Kx%?D?&B??y??}??O', '2024-01-10 01:08:52', '09:00:00', '10:00:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_95.png', '1', 3, NULL, NULL),
(96, 1, 3, 1, 1, 4, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0?q\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATX????m?0????ߒ?\"???^{E??\0??????,vv??R?????%E?3g<T?\n?x?????.??z???=?sf-w?~7??]+]???/?\r?`?_????d_??SX%?ĝ#?j_4???????:?ډ???}??Ux???(=֗?q*Ti?y?E?\'=y?*S?.??$.??q???rX5?%', '2024-01-10 01:21:21', '09:00:00', '10:00:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_96.png', '1', 3, NULL, NULL),
(97, 1, 1, 1, 1, 1, NULL, NULL, NULL, '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0\0?\0\0\0?\0\0\0#{\0\0\0PLTE\0\0\0????ٟ?\0\0\0	pHYs\0\0?\0\0??+\0\0?IDATH????qA?????TXkg??$???<a???UU]?骩?U?:Ҟ?????֋\0???(D?@ ?O?va\r6????@n?t??g7????~1?Q%??/?~P?[?9xf??;͍*??8/=p??͋F???\rP?A~?O?yY?-AG??W?l??P?{?g?Z㬾R??)Â?}??*=?h??', '2024-02-03 15:23:40', '11:11:00', '12:12:00', 'CVSU101', 'CVSU history', NULL, NULL, 'qrcodes/class_97.png', '1', 1, NULL, NULL);

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
-- Table structure for table `tblstudentclass`
--

CREATE TABLE `tblstudentclass` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `tbl_lecture`
--

CREATE TABLE `tbl_lecture` (
  `id` int(11) NOT NULL,
  `selectedStudentId` int(11) DEFAULT NULL,
  `studentNumber` int(11) DEFAULT NULL,
  `finalgrade` decimal(5,2) DEFAULT NULL,
  `consolidated` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lecture`
--

INSERT INTO `tbl_lecture` (`id`, `selectedStudentId`, `studentNumber`, `finalgrade`, `consolidated`) VALUES
(1, 2, 202010124, NULL, 0.00),
(2, 2, 202010124, NULL, 1.00),
(3, 2, 202010124, NULL, 1.00),
(4, 2, 202010124, 90.00, 1.75),
(8, 2, 202010124, 0.00, 0.00),
(9, 3, 202010125, 0.00, 0.00),
(10, 2, 202010124, 0.00, 0.00),
(11, 2, 202010124, 0.00, 0.00),
(12, 1, 202010123, 93.00, 1.50),
(16, 1, 0, 0.00, 0.00),
(17, 1, 202010123, 0.00, 0.00),
(18, 1, 0, 0.00, 0.00),
(19, 1, 0, 0.00, 0.00),
(20, 1, 0, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlab`
--

CREATE TABLE `tbl_wlab` (
  `id` int(11) NOT NULL,
  `selectedStudentId` int(11) DEFAULT NULL,
  `studentNumber` int(11) DEFAULT NULL,
  `finalGrade` decimal(5,2) DEFAULT NULL,
  `consolidated` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_wlab`
--

INSERT INTO `tbl_wlab` (`id`, `selectedStudentId`, `studentNumber`, `finalGrade`, `consolidated`) VALUES
(1, 2, 202010124, 0.00, 0.00);

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
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` enum('Faculty','Admin','Student') NOT NULL,
  `code` text NOT NULL,
  `otp_creation_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`, `roles`, `code`, `otp_creation_time`) VALUES
(37, 'Fa', 'Culty', 'kebasa2669@telvetto.com', '25d55ad283aa400af464c76d713c07ad', 'Faculty', '', '2024-01-14 07:13:18'),
(39, 'Valdez', 'Cha', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Admin', '', '2024-01-14 07:24:00'),
(44, 'Cha', 'Ribs', 'keanuribs04@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'Student', '', '2024-01-16 14:07:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_list`
--
ALTER TABLE `academic_list`
  ADD PRIMARY KEY (`academic_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_number`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `student_section`
--
ALTER TABLE `student_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `student_status`
--
ALTER TABLE `student_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student_year`
--
ALTER TABLE `student_year`
  ADD PRIMARY KEY (`year_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_registration`
--
ALTER TABLE `subject_registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_number` (`student_number`);

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
-- Indexes for table `tblstudentclass`
--
ALTER TABLE `tblstudentclass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_student_id` (`id`);

--
-- Indexes for table `tblyearlvl`
--
ALTER TABLE `tblyearlvl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lecture`
--
ALTER TABLE `tbl_lecture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `selectedStudentId` (`selectedStudentId`);

--
-- Indexes for table `tbl_wlab`
--
ALTER TABLE `tbl_wlab`
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
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_list`
--
ALTER TABLE `academic_list`
  MODIFY `academic_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_section`
--
ALTER TABLE `student_section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student_status`
--
ALTER TABLE `student_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_year`
--
ALTER TABLE `student_year`
  MODIFY `year_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject_registration`
--
ALTER TABLE `subject_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblattendance`
--
ALTER TABLE `tblattendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

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
-- AUTO_INCREMENT for table `tblstudentclass`
--
ALTER TABLE `tblstudentclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `subject_registration`
--
ALTER TABLE `subject_registration`
  ADD CONSTRAINT `subject_registration_ibfk_1` FOREIGN KEY (`student_number`) REFERENCES `students` (`student_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
