-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 02:10 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation_process`
--

CREATE TABLE `allocation_process` (
  `id` int(1) NOT NULL,
  `process` int(2) NOT NULL,
  `news` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocation_process`
--

INSERT INTO `allocation_process` (`id`, `process`, `news`) VALUES
(1, 2, 'Hello Student your first Round started.....');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `contact_no` varchar(14) NOT NULL,
  `admin` int(1) DEFAULT NULL,
  `enable` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `name`, `password`, `email`, `contact_no`, `admin`, `enable`) VALUES
(157, 'apurva maheta', '157', 'aam@aam.com', '123456798', 0, 1),
(454, 'sitharth shah', '454', 'sfas@ass.in', '1684123', 0, 1),
(4545, 'admin', 'admin', 'admin@admin.com', '1548151515', 1, 1),
(12121, 'hariom pandya', '12121', 'asdf@AF.in', '565465151', 0, 1),
(45454, 'abcd', '45454545', 'kjhkjg@lkj.kjh', '98765465', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `leader` int(6) UNSIGNED NOT NULL,
  `mem1` int(6) DEFAULT NULL,
  `mem2` int(6) DEFAULT NULL,
  `mem3` int(6) DEFAULT NULL,
  `average` float NOT NULL,
  `project` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`leader`, `mem1`, `mem2`, `mem3`, `average`, `project`) VALUES
(1123, 1478, 1122, 1234, 8.8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `project_id` int(6) UNSIGNED NOT NULL,
  `faculty` int(6) NOT NULL,
  `definition` varchar(25) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `enable` int(1) DEFAULT NULL,
  `selected` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `faculty`, `definition`, `description`, `enable`, `selected`) VALUES
(123, 4545, 'Online Leave Management ', 'Online Leave Management', 1, 0),
(159, 4545, 'Resume Generation', 'Automatic Resume Generation (Admin)', 1, 0),
(456, 4545, 'Resort Management system', 'Resort Management system', 1, 0),
(768, 4545, 'Face Mask Detection ', 'Face Mask Detection using Facial Recognization', 0, 0),
(789, 4545, 'Resume Generation', 'Automatic Resume Generation (Admin)', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `p_1123`
--

CREATE TABLE `p_1123` (
  `no` int(5) UNSIGNED NOT NULL,
  `project_id` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(6) UNSIGNED NOT NULL,
  `faculty` int(6) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `cpi` float NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `birthdate` varchar(10) NOT NULL,
  `participate` int(1) DEFAULT NULL,
  `leader` int(6) DEFAULT NULL,
  `allocated` int(1) DEFAULT NULL,
  `email` varchar(35) NOT NULL,
  `contact_no` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `faculty`, `password`, `cpi`, `first_name`, `last_name`, `birthdate`, `participate`, `leader`, `allocated`, `email`, `contact_no`) VALUES
(1122, 4545, '987654321', 8.5, 'haresh', 'karena', '1997-07-04', 1, 1123, 0, 'hsk@yg.vom', '123456789'),
(1123, 4545, '1996-11-13', 9.3, 'yug', 'ver', '1996-11-13', 1, 1123, 0, 'yug@gmail.com', '1234567890'),
(1234, 4545, 'jaganivatsal', 8.9, 'vatsal', 'jagani', '08/08/1996', 1, 1123, 0, 'vatsal@g.com', '132654987'),
(1478, 4545, 'mohit', 8.5, 'mohit', 'jain', '01/01/1996', 1, 1123, 0, 'moja@abc.abc', '159654123'),
(4563, 4545, 'keval', 7.9, 'keval', 'dhol', '01/11/1996', 1, 0, 0, 'kkdhol@gg.gg', '7899787987'),
(5678, 4545, 'hiren', 7.9, 'hiren', 'italiya', '02/11/1996', 1, 0, 0, 'hiren@n.in', '156489732'),
(6547, 4545, 'akshit', 9.2, 'akshit', 'jariwala', '01/01/1996', 1, 0, 0, 'aks@a.co', '645654654'),
(7561, 4545, 'sahdev', 8.8, 'sahdev', 'herma', '16/09/1997', 0, 0, 0, 'sid@sid.sid', '159785315');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation_process`
--
ALTER TABLE `allocation_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`leader`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `p_1123`
--
ALTER TABLE `p_1123`
  ADD UNIQUE KEY `no` (`no`),
  ADD UNIQUE KEY `project_id` (`project_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=790;
--
-- AUTO_INCREMENT for table `p_1123`
--
ALTER TABLE `p_1123`
  MODIFY `no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
