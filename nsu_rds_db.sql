-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2021 at 05:21 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsu_rds_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(5) NOT NULL,
  `USERNAME` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `USERNAME`, `PASSWORD`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `trace_id` int(10) NOT NULL,
  `course_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_to` int(11) DEFAULT NULL,
  `is_present` bit(1) DEFAULT NULL,
  `at_which_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`trace_id`, `course_id`, `submitted_by`, `given_to`, `is_present`, `at_which_date`) VALUES
(1, 'CSE311', 'MKN1', 2011188642, b'0', '2021-12-18'),
(2, 'CSE311', 'MKN1', 2011084642, b'1', '2021-12-18'),
(3, 'CSE311', 'MKN1', 1721084642, b'1', '2021-12-18'),
(4, 'CSE311', 'MKN1', 2011188642, b'0', '2021-12-18'),
(5, 'CSE311', 'MKN1', 2011084642, b'1', '2021-12-18'),
(6, 'CSE311', 'MKN1', 1721084642, b'1', '2021-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `course_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer_status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`course_id`, `course_name`, `offer_status`) VALUES
('CSE311', 'Database Systems', b'1'),
('CSE323', 'Operating System', b'1'),
('CSE332', 'Computer Organization and Architecture', b'1'),
('CSE373', 'Design and Analysis of Algorithms', b'1'),
('MAT120', 'Calculus I', b'1'),
('MAT130', 'Calculus II', b'1'),
('MAT350', 'Engineering Mathematics', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `USERNAME` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`USERNAME`, `PASSWORD`) VALUES
('AUZ', '12345'),
('MKN1', '123456789'),
('SMH2', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_profile`
--

CREATE TABLE `faculty_profile` (
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_name` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_reg_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citizenship` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculty_profile`
--

INSERT INTO `faculty_profile` (`name`, `initial`, `department_name`, `phone_number`, `nid`, `birth_reg_no`, `dob`, `gender`, `citizenship`) VALUES
('Asad Uz Zaman', 'AUZ', 'PHY', '1234564', '123456745', '12345675545', '2021-12-06', 'M', 'Canadian'),
('Mostafa kamal nasir', 'MKN1', 'ECE', '01711111111', '1111111111', '99999999999', '1979-11-11', 'M', 'Bangladeshi'),
('Syed Hussain Mahmud', 'SMH2', 'ECE', '1234567', '121324354', '232543624325', '2021-12-01', 'M', 'Bangladeshi');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `trace_id` int(10) NOT NULL,
  `course_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_to` int(11) DEFAULT NULL,
  `grade_value` decimal(2,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`trace_id`, `course_id`, `submitted_by`, `given_to`, `grade_value`) VALUES
(8, 'CSE311', 'MKN1', 2011188642, '4.0'),
(10, 'CSE311', 'MKN1', 1721084642, '3.7'),
(11, 'CSE332', 'MKN1', 2011084642, '4.0'),
(12, 'CSE311', 'MKN1', 2011084642, '3.3');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `settings_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `settings_value` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`settings_name`, `settings_value`) VALUES
('advising_state', '0');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `USERNAME` int(11) NOT NULL,
  `PASSWORD` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`USERNAME`, `PASSWORD`) VALUES
(1721084642, '12345'),
(1911110642, '12345'),
(2011084642, '12345'),
(2011111111, '12345'),
(2011188642, '12345'),
(2022222222, '12345');

-- --------------------------------------------------------

--
-- Table structure for table `student_profile`
--

CREATE TABLE `student_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_name` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `degree` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `credits` int(5) NOT NULL,
  `cgpa` decimal(4,2) DEFAULT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_reg_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `citizenship` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_profile`
--

INSERT INTO `student_profile` (`id`, `name`, `fathers_name`, `mothers_name`, `department_name`, `degree`, `credits`, `cgpa`, `phone_number`, `nid`, `birth_reg_no`, `dob`, `gender`, `citizenship`) VALUES
(1721084642, 'XYZ ABC', 'GHJ ABC', 'IOS ABC', 'ECE', 'CSE', 100, '2.50', '1212121212', '1212121212121212', '12121212121212', '2021-12-06', 'F', 'Bangladeshi'),
(1911110642, 'sdsd sdsd sdsd', 'sdsd sdsds', 'sdsd sdsdsdsd', 'ECE', 'sds', 100, '4.00', '121212121234', '121212121234121212121234121212121234', '121212121234121212121234', '2021-12-02', 'M', 'Bangladeshi'),
(2011084642, 'Md Sahadul Hasan Arian', 'Md Abdul Wahab', 'Mrs Rabia Wahab', 'ECE', 'CSE', 66, '1.00', '1212343', '32325452354443454', '323254523544434542323', '2021-11-03', 'M', 'Bangladeshi'),
(2011111111, 'sdfsdf sdfasdfsd', 'sdfsadf asdfsdf', 'sdfsadf asdfasdf', 'sds', 'sdd', 100, '2.50', '12345672', '1234567212345672', '123456721234567212345672', '2021-12-02', 'M', 'Bangladeshi'),
(2011188642, 'Faisal Ahmed Sifat', 'Md. Nurur Zaman', 'Mst. Josna Begum', 'ECE', 'CSE', 47, '3.10', '01887397067', '123456789', '987654321', '2000-09-04', 'M', 'Bangladeshi'),
(2022222222, 'wsdfsdf sdfsdf', 'sdfs sfsfds sdfsdf', 'sfsdfsd sdfsdf ssd', 'PHY', 'sds', 88, '1.00', '23232', '23232232323223', '232322323232232323223', '2021-12-06', 'M', 'Bangladeshi');

-- --------------------------------------------------------

--
-- Table structure for table `taking`
--

CREATE TABLE `taking` (
  `trace_id` int(10) NOT NULL,
  `course_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_is_taking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taking`
--

INSERT INTO `taking` (`trace_id`, `course_id`, `who_is_taking`) VALUES
(1, 'CSE311', 2011188642),
(2, 'CSE311', 2011084642),
(3, 'CSE311', 1721084642),
(4, 'CSE332', 2011188642),
(5, 'CSE332', 2011084642);

-- --------------------------------------------------------

--
-- Table structure for table `teaches`
--

CREATE TABLE `teaches` (
  `course_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `who_is_teaching` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teaches`
--

INSERT INTO `teaches` (`course_id`, `who_is_teaching`) VALUES
('CSE373', 'AUZ'),
('MAT350', 'AUZ'),
('CSE311', 'MKN1'),
('CSE323', 'MKN1'),
('CSE332', 'MKN1'),
('MAT120', 'SMH2'),
('MAT130', 'SMH2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`trace_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `given_to` (`given_to`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`course_id`),
  ADD UNIQUE KEY `course_id` (`course_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`USERNAME`) USING BTREE;

--
-- Indexes for table `faculty_profile`
--
ALTER TABLE `faculty_profile`
  ADD PRIMARY KEY (`initial`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD UNIQUE KEY `birth_reg_no` (`birth_reg_no`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`trace_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `given_to` (`given_to`),
  ADD KEY `submitted_by` (`submitted_by`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`settings_name`) USING BTREE;

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`USERNAME`) USING BTREE;

--
-- Indexes for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nid` (`nid`),
  ADD UNIQUE KEY `birth_reg_no` (`birth_reg_no`);

--
-- Indexes for table `taking`
--
ALTER TABLE `taking`
  ADD PRIMARY KEY (`trace_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `who_is_taking` (`who_is_taking`);

--
-- Indexes for table `teaches`
--
ALTER TABLE `teaches`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `who_is_teaching` (`who_is_teaching`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `trace_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `trace_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `taking`
--
ALTER TABLE `taking`
  MODIFY `trace_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`),
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`given_to`) REFERENCES `student_profile` (`id`),
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`submitted_by`) REFERENCES `faculty_profile` (`initial`);

--
-- Constraints for table `faculty_profile`
--
ALTER TABLE `faculty_profile`
  ADD CONSTRAINT `faculty_profile_ibfk_1` FOREIGN KEY (`initial`) REFERENCES `faculties` (`USERNAME`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`given_to`) REFERENCES `student_profile` (`id`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`submitted_by`) REFERENCES `faculty_profile` (`initial`);

--
-- Constraints for table `student_profile`
--
ALTER TABLE `student_profile`
  ADD CONSTRAINT `student_profile_ibfk_1` FOREIGN KEY (`id`) REFERENCES `students` (`USERNAME`);

--
-- Constraints for table `taking`
--
ALTER TABLE `taking`
  ADD CONSTRAINT `taking_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`),
  ADD CONSTRAINT `taking_ibfk_2` FOREIGN KEY (`who_is_taking`) REFERENCES `student_profile` (`id`);

--
-- Constraints for table `teaches`
--
ALTER TABLE `teaches`
  ADD CONSTRAINT `teaches_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`),
  ADD CONSTRAINT `teaches_ibfk_2` FOREIGN KEY (`who_is_teaching`) REFERENCES `faculty_profile` (`initial`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
