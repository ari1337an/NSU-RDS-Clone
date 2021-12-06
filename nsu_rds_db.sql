-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 09:14 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
-- Table structure for table `attandance`
--

CREATE TABLE `attandance` (
  `trace_id` int(10) NOT NULL,
  `course_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `submitted_by` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `given_to` int(11) DEFAULT NULL,
  `is_present` bit(1) DEFAULT NULL,
  `at_which_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('CSE311', 'Database Systems', b'1');

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
('MKN1', '123456789');

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
('Mostafa kamal nasir', 'MKN1', 'ECE', '01711111111', '1111111111', '99999999999', '1979-11-11', 'M', 'Bangladeshi');

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
(1911110642, '12345'),
(2011188642, '12345');

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
(2011188642, 'Faisal Ahmed Sifat', 'Md. Nurur Zaman', 'Mst. Josna Begum', 'ECE', 'CSE', 47, '3.10', '01887397067', '123456789', '987654321', '2000-09-04', 'M', 'Bangladeshi');

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
(1, 'CSE311', 2011188642);

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
('CSE311', 'MKN1');

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
-- Indexes for table `attandance`
--
ALTER TABLE `attandance`
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
-- AUTO_INCREMENT for table `attandance`
--
ALTER TABLE `attandance`
  MODIFY `trace_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `trace_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taking`
--
ALTER TABLE `taking`
  MODIFY `trace_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attandance`
--
ALTER TABLE `attandance`
  ADD CONSTRAINT `attandance_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`course_id`),
  ADD CONSTRAINT `attandance_ibfk_2` FOREIGN KEY (`given_to`) REFERENCES `student_profile` (`id`),
  ADD CONSTRAINT `attandance_ibfk_3` FOREIGN KEY (`submitted_by`) REFERENCES `faculty_profile` (`initial`);

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
