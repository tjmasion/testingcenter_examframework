-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2017 at 09:45 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guidancedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `usertype` enum('admin','student','guidance','testing') NOT NULL,
  `client_num` int(11) DEFAULT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `idnum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `usertype`, `client_num`, `fname`, `lname`, `status`, `idnum`) VALUES
(1, 'admin', 'admin101', 'admin', NULL, 'Ann', 'Ares', 'active', 0),
(2, 'guidance', 'guidance', 'guidance', NULL, 'Jomari', 'Saragena', 'active', 0),
(3, 'testing', 'testing', 'testing', NULL, 'Arany', 'Jatayna', 'active', 0),
(4, '12100469', '12100469', 'student', 1, 'Jomari', 'Saragena', 'active', 0),
(5, '12104690', '12104690', 'student', 2, 'Marie', 'Skeete', 'active', 0),
(6, 'osas', 'osas', 'testing', NULL, 'osas', 'osas', 'active', 0),
(7, '14567813', '14567813', 'student', 3, 'Marjorie', 'Saragena', 'active', 0),
(8, 'guidance102', 'guidance102', 'testing', NULL, 'Gerald', 'Huanwho', 'active', 0),
(9, '16456713', '16456713', 'student', 4, 'Tj', 'Masion', 'active', 0),
(10, 'gwapoko', 'gwapoko', 'guidance', NULL, 'Gwapo', 'Masion', 'active', 13451);

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `log_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` enum('edit account','reset result','add account','remove exam','reactivate account','reactivate student','deactivate account','activate exam','create exam','deactivate student','add exam','deactivate exam','edit exam','add student','print record','print report','take exam','edit information') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`log_id`, `account_id`, `date`, `action`) VALUES
(1, 1, '2017-02-17 03:05:47', 'add account'),
(2, 1, '2017-02-17 03:06:21', 'add account'),
(3, 3, '2017-02-17 03:08:17', 'add student'),
(4, 3, '2017-02-17 03:09:00', 'add student'),
(5, 1, '2017-02-17 03:09:57', 'add account'),
(6, 6, '2017-02-16 16:00:00', 'add exam'),
(7, 6, '2017-02-16 16:00:00', 'add exam'),
(8, 6, '2017-02-17 16:00:00', 'add exam'),
(9, 6, '2017-02-17 16:00:00', 'add exam'),
(10, 6, '2017-02-17 17:39:54', 'deactivate student'),
(11, 6, '2017-02-17 16:00:00', 'add exam'),
(12, 6, '2017-02-17 17:40:43', 'deactivate student'),
(13, 6, '2017-02-17 17:40:56', 'deactivate student'),
(14, 6, '2017-02-22 16:00:00', 'add exam'),
(15, 6, '2017-02-22 16:00:00', 'add exam'),
(16, 6, '2017-02-22 16:00:00', 'add exam'),
(17, 2, '2017-02-23 02:32:17', 'add student'),
(18, 2, '2017-02-23 02:32:35', 'add exam'),
(19, 2, '2017-02-23 02:32:58', 'add exam'),
(20, 1, '2017-02-23 02:54:45', 'add account'),
(21, 1, '2017-02-23 02:57:35', 'edit account'),
(22, 1, '2017-02-23 02:57:41', 'deactivate account'),
(23, 1, '2017-02-23 02:57:45', 'reactivate account'),
(24, 2, '2017-02-23 02:59:43', 'add student'),
(25, 2, '2017-02-23 02:59:51', 'add exam'),
(26, 2, '2017-02-23 02:59:56', 'add exam'),
(27, 2, '2017-02-23 03:00:04', 'add exam'),
(28, 2, '2017-02-23 03:00:24', 'edit information'),
(29, 3, '2017-02-23 03:02:19', 'deactivate student'),
(30, 3, '2017-02-23 03:02:27', 'reactivate student'),
(31, 3, '2017-02-23 03:02:41', 'add exam'),
(32, 3, '2017-02-23 03:03:28', 'deactivate student'),
(33, 3, '2017-02-23 03:03:35', 'deactivate student'),
(34, 3, '2017-02-23 03:03:40', 'reactivate student'),
(35, 1, '2017-02-23 03:04:18', 'edit account'),
(36, 6, '2017-02-23 03:46:01', 'deactivate student'),
(37, 6, '2017-02-22 16:00:00', 'add exam'),
(38, 1, '2017-02-27 02:20:35', 'add account');

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `choices_id` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `choice` varchar(30) NOT NULL,
  `point_equivalent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`choices_id`, `exam_num`, `choice`, `point_equivalent`) VALUES
(1, 1, 'yes', 1),
(2, 1, 'no', 0),
(3, 2, 'A', 2),
(4, 2, 'B', 3),
(5, 3, 'A', 1),
(6, 3, 'B', 2),
(7, 4, 'a', 1),
(8, 4, 'b', 2),
(9, 4, 'c', 3);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_num` int(11) NOT NULL,
  `id_num` int(11) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `course` char(10) NOT NULL,
  `yrlvl` enum('1','2','3','4','5') NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_num`, `id_num`, `lname`, `fname`, `mname`, `course`, `yrlvl`, `sex`, `email`, `status`) VALUES
(1, 12100469, 'Saragena', 'Jomari', 'Cabajar', 'BSICT', '1', 'male', 'jomarzsaragenz@yahoo.com', 'active'),
(2, 12104690, 'Skeete', 'Marie', 'Cabajar', 'BSPh', '1', 'female', 'jomarisaragenaofficial@gmail.com', 'active'),
(3, 14567813, 'Saragena', 'Marjorie', 'Cabajar', 'BSBA MM', '3', 'male', 'marjoriesaragena@yahoo.com', 'active'),
(4, 16456713, 'Masionwho', 'Tj', 'Rodriguez', 'BSICT', '3', 'male', 'masionrodriguez@yahoo.com', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `exam_num` int(11) NOT NULL,
  `client_num` int(11) NOT NULL,
  `ref_num` int(11) NOT NULL,
  `status` enum('finish','unfinish') NOT NULL,
  `container_num` int(11) NOT NULL,
  `con` enum('active','delete') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `container`
--

INSERT INTO `container` (`exam_num`, `client_num`, `ref_num`, `status`, `container_num`, `con`) VALUES
(1, 1, 1, 'finish', 1, 'active'),
(1, 2, 2, 'finish', 2, 'active'),
(1, 1, 3, 'unfinish', 3, 'delete'),
(1, 2, 4, 'unfinish', 4, 'delete'),
(1, 1, 5, 'unfinish', 5, 'delete'),
(2, 1, 6, 'finish', 6, 'active'),
(2, 2, 7, 'finish', 7, 'active'),
(3, 1, 8, 'finish', 8, 'active'),
(1, 3, 9, 'unfinish', 9, 'active'),
(3, 3, 10, 'unfinish', 10, 'active'),
(3, 4, 11, 'unfinish', 11, 'active'),
(2, 4, 12, 'unfinish', 12, 'active'),
(1, 4, 13, 'unfinish', 13, 'delete'),
(1, 2, 14, 'unfinish', 14, 'delete'),
(4, 4, 15, 'finish', 15, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `counter_num` int(11) NOT NULL,
  `client_num` int(11) NOT NULL,
  `datelimit` date NOT NULL,
  `frequency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`counter_num`, `client_num`, `datelimit`, `frequency`) VALUES
(1, 1, '2017-01-01', 3),
(2, 2, '2017-01-01', 2),
(3, 3, '2017-01-01', 2),
(4, 4, '2017-01-01', 3);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `coursecode` varchar(10) NOT NULL,
  `cdescrip` varchar(150) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `coursecode`, `cdescrip`, `status`) VALUES
(1, 'BSA', 'BS Architecture', 0),
(2, 'BSLA', 'BS Landscape Architecture', 0),
(3, 'BSID', 'BS Interior Design', 0),
(4, 'BF AA', 'B Fine Arts m: Advertising Arts', 0),
(5, 'BFA FD', 'B Fine Arts m: Fashion Design', 0),
(6, 'BFA PA', 'B Fine Arts m: Painting Arts', 0),
(7, 'BFA C', 'B Fine Arts m: Cinema', 0),
(8, 'BSB', 'BS Biology', 0),
(9, 'BSES', 'BS Environmental Science', 0),
(10, 'BSMB', 'BS Marine Biology', 0),
(11, 'BSC', 'BS Chemistry', 0),
(12, 'BSCS', 'BS Computer Science', 0),
(13, 'BSIT', 'BS Information Technology', 0),
(14, 'BSICT', 'BS Information and Communication Technology', 0),
(15, 'ACT MMT', 'Associate Computer Technology sp: Multi Media Tec ', 0),
(16, 'BAAL', 'BA Applied Linguistics ', 0),
(17, 'BAL', 'BA Literature', 0),
(18, 'BAC M', 'BA Communication m: Media', 0),
(19, 'BAC CC', 'BA Communication m: Corporate Communication', 0),
(20, 'BLIS', 'B Library and Information Sciences', 0),
(21, 'BSM', 'BS Mathematics', 0),
(22, 'BP', 'B Philosophy', 0),
(23, 'BSAP', 'BS Applied Physics', 0),
(24, 'BSP', 'BS Psychology', 0),
(25, 'BAA', 'BA Anthropology', 0),
(26, 'BAH', 'BA History', 0),
(27, 'BAS', 'BA Sociology', 0),
(28, 'BSN', 'BS Nursing', 0),
(29, 'BSND', 'BS Nutrition and Dietetics', 0),
(30, 'BSPh', 'BS Pharmacy', 0),
(31, 'BSCPS', 'BS Clinical Pharmaceutical Sciences', 0),
(32, 'BL', 'B Law', 0),
(33, 'BAPS IRFS', 'BA Political Science m: International Relations & Foreign Services', 0),
(34, 'BAPS LPS', 'BA Political Science m: Law and Policy Studies', 0),
(35, 'BAPS PTS', 'BA Political Science m: Political Theory and Systems', 0),
(36, 'BAPS PMD', 'BA Political Science m: Public Management and Development', 0),
(37, 'BSAC', 'BS Accountancy', 0),
(38, 'BSACT', 'BS Accounting Technology', 0),
(39, 'BSE', 'BS Entrepreneurship', 0),
(40, 'BSREM', 'BS Real Estate Management', 0),
(41, 'BSBA ERM', 'BS Business Administration m: Executive Resource Management', 0),
(42, 'BSBA FM', 'BS Business Administration m: Financial Management', 0),
(43, 'BSBA HRDM', 'BS Business Administration m: Human Resource Development Management', 0),
(44, 'BSBA MM', 'BS Business Administration m: Marketing Management', 0),
(45, 'BSBA OM', 'BS Business Administration m: Operations Management', 0),
(46, 'BSE B', 'BS Economics t: Business', 0),
(47, 'BSE LP', 'BS Economics t: Law and Politics', 0),
(48, 'BSE SS', 'BS Economics t: Social Science', 0),
(49, 'BSE S', 'BS Economics t: Statistics', 0),
(50, 'BSHRM', 'BS Hotel and Restaurant Management', 0),
(51, 'BTM', 'B Tourism Management', 0),
(52, 'BEE', 'B Elementary Education', 0),
(53, 'BEEC', 'B Education in Early Childhood', 0),
(54, 'BESE', 'B Education in Special Education', 0),
(55, 'BSE E', 'B Secondary Education m: English', 0),
(56, 'BSE RVE', 'B Secondary Education m: Religious and Values Education', 0),
(57, 'BPE SPE', 'B Physical Education m: School Physical Education', 0),
(58, 'BSE M', 'B Secondary Education m: Mathematics', 0),
(59, 'BSE PM', 'B Secondary Education m: Physics-Mathematics', 0),
(60, 'BSE PC', 'B Secondary Education m: Physics-Chemistry', 0),
(61, 'BSE BC', 'B Secondary Education m: Biology-Chemistry', 0),
(62, 'BSChe', 'BS Chemical Engineering', 0),
(63, 'BSCE', 'BS Civil Engineering', 0),
(64, 'BSCompE', 'BS Computer Engineering', 0),
(65, 'BSEE', 'BS Electrical Engineering', 0),
(66, 'BSECE', 'BS Electronics and Communications Engineering', 0),
(67, 'BSIE', 'BS Industrial Engineering', 0),
(68, 'BSME', 'BS Mechanical Engineering', 0),
(69, 'BSCrim', 'BSCRIM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `exam_num` int(11) NOT NULL,
  `exam_name` varchar(100) NOT NULL,
  `no_of_takers` int(11) NOT NULL,
  `date_create` date NOT NULL,
  `status` enum('active','deactivated') NOT NULL,
  `descrip` text NOT NULL,
  `timelimit` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_num`, `exam_name`, `no_of_takers`, `date_create`, `status`, `descrip`, `timelimit`, `total`) VALUES
(1, 'IQ', 0, '2017-02-17', 'active', 'ASD\r\n', 60, 2),
(2, 'Sample 1', 1, '2017-02-22', 'active', 'instructions', 1, 2),
(3, 'Sample 2', 2, '2017-02-22', 'active', 'sample', 120, 1),
(4, 'shuffle test', 0, '2017-02-23', 'active', 'test', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `question` text NOT NULL,
  `subexam_num` int(11) NOT NULL,
  `item_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `exam_num`, `question`, `subexam_num`, `item_no`) VALUES
(1, 1, '1+1?', 1, 1),
(2, 1, '1+1+1?', 1, 2),
(3, 2, '?', 2, 1),
(4, 3, '???', 3, 1),
(5, 4, 'test1', 4, 1),
(6, 4, 'test2', 4, 2),
(7, 4, 'test3', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `normgen`
--

CREATE TABLE `normgen` (
  `norm_id` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `normgen`
--

INSERT INTO `normgen` (`norm_id`, `exam_num`, `min`, `max`, `name`) VALUES
(1, 1, 2, 2, 'High'),
(2, 1, 1, 1, 'LOW'),
(3, 2, 1, 5, 'Low'),
(4, 3, 1, 3, 'Low'),
(5, 3, 4, 7, 'high'),
(6, 4, 1, 5, 'low'),
(7, 4, 6, 9, 'hihg');

-- --------------------------------------------------------

--
-- Table structure for table `normsub`
--

CREATE TABLE `normsub` (
  `norm_id` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `subexam_num` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `normsub`
--

INSERT INTO `normsub` (`norm_id`, `exam_num`, `subexam_num`, `min`, `max`, `name`) VALUES
(1, 1, 1, 2, 2, 'HIGH'),
(2, 1, 1, 1, 1, 'LOW'),
(3, 2, 2, 1, 5, 'Low'),
(4, 3, 3, 1, 2, 'low'),
(5, 3, 3, 3, 7, 'high'),
(6, 4, 4, 1, 5, 'low'),
(7, 4, 4, 6, 9, 'hihg');

-- --------------------------------------------------------

--
-- Table structure for table `referral`
--

CREATE TABLE `referral` (
  `ref_num` int(11) NOT NULL,
  `client_num` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `referral`
--

INSERT INTO `referral` (`ref_num`, `client_num`, `date`) VALUES
(1, 1, '2017-02-17'),
(2, 2, '2017-02-17'),
(3, 1, '2017-02-18'),
(4, 2, '2017-02-18'),
(5, 1, '2017-02-18'),
(6, 1, '2017-02-23'),
(7, 2, '2017-02-23'),
(8, 1, '2017-02-23'),
(9, 3, '2017-02-23'),
(10, 3, '2017-02-23'),
(11, 4, '2017-02-23'),
(12, 4, '2017-02-23'),
(13, 4, '2017-02-23'),
(14, 2, '2017-02-23'),
(15, 4, '2017-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `total_takers` int(11) NOT NULL,
  `soe_takers` int(11) NOT NULL,
  `sas_takers` int(11) NOT NULL,
  `sbe_takers` int(11) NOT NULL,
  `shcp_takers` int(11) NOT NULL,
  `slg_takers` int(11) NOT NULL,
  `soed_takers` int(11) NOT NULL,
  `firstyear_takers` int(11) NOT NULL,
  `secondyear_takers` int(11) NOT NULL,
  `thirdyear_takers` int(11) NOT NULL,
  `fourthyear_takers` int(11) NOT NULL,
  `fifthyear_takers` int(11) NOT NULL,
  `semester` enum('First Semester','Second Semester') NOT NULL,
  `schoolyear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `resultgen`
--

CREATE TABLE `resultgen` (
  `resultgen_num` int(11) NOT NULL,
  `ref_num` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `result` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `eval` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultgen`
--

INSERT INTO `resultgen` (`resultgen_num`, `ref_num`, `exam_num`, `total`, `result`, `date`, `eval`) VALUES
(1, 1, 1, 1, 'LOW', '2017-02-17', ''),
(2, 2, 1, 2, 'High', '2017-02-17', 'asdasdasdasda'),
(3, 6, 2, 2, 'Low', '2017-02-22', ''),
(4, 7, 2, 2, 'Low', '2017-02-22', ''),
(5, 8, 3, 1, 'Low', '2017-02-22', ''),
(6, 15, 4, 3, 'low', '2017-02-23', '');

-- --------------------------------------------------------

--
-- Table structure for table `resultsub`
--

CREATE TABLE `resultsub` (
  `resultsub_num` int(11) NOT NULL,
  `ref_num` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `subexam_num` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `result` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resultsub`
--

INSERT INTO `resultsub` (`resultsub_num`, `ref_num`, `exam_num`, `subexam_num`, `total`, `result`) VALUES
(1, 1, 1, 1, 1, 'LOW'),
(2, 2, 1, 1, 2, 'HIGH'),
(3, 6, 2, 2, 2, 'Low'),
(4, 7, 2, 2, 2, 'Low'),
(5, 8, 3, 3, 1, 'low'),
(6, 15, 4, 4, 3, 'low');

-- --------------------------------------------------------

--
-- Table structure for table `subexam`
--

CREATE TABLE `subexam` (
  `subexam_num` int(11) NOT NULL,
  `exam_num` int(11) NOT NULL,
  `subexam_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subexam`
--

INSERT INTO `subexam` (`subexam_num`, `exam_num`, `subexam_name`) VALUES
(1, 1, 'MATH'),
(2, 2, '111'),
(3, 3, 'ppp'),
(4, 4, 'subexam1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `client_num` (`client_num`);

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`choices_id`),
  ADD KEY `choices_ibfk_3` (`exam_num`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_num`);

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`container_num`),
  ADD KEY `exam_num` (`exam_num`),
  ADD KEY `client_num` (`client_num`),
  ADD KEY `ref_num` (`ref_num`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`counter_num`),
  ADD KEY `client_num` (`client_num`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`exam_num`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `subexam_num` (`subexam_num`),
  ADD KEY `exam_num` (`exam_num`);

--
-- Indexes for table `normgen`
--
ALTER TABLE `normgen`
  ADD PRIMARY KEY (`norm_id`),
  ADD KEY `exam_num` (`exam_num`);

--
-- Indexes for table `normsub`
--
ALTER TABLE `normsub`
  ADD PRIMARY KEY (`norm_id`),
  ADD KEY `exam_num` (`exam_num`),
  ADD KEY `subexam_num` (`subexam_num`);

--
-- Indexes for table `referral`
--
ALTER TABLE `referral`
  ADD PRIMARY KEY (`ref_num`),
  ADD KEY `fk_Perreferral` (`client_num`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `resultgen`
--
ALTER TABLE `resultgen`
  ADD PRIMARY KEY (`resultgen_num`),
  ADD KEY `exam_num` (`exam_num`),
  ADD KEY `ref_num` (`ref_num`);

--
-- Indexes for table `resultsub`
--
ALTER TABLE `resultsub`
  ADD PRIMARY KEY (`resultsub_num`),
  ADD KEY `ref_num` (`ref_num`),
  ADD KEY `subexam_num` (`subexam_num`),
  ADD KEY `exam_num` (`exam_num`);

--
-- Indexes for table `subexam`
--
ALTER TABLE `subexam`
  ADD PRIMARY KEY (`subexam_num`),
  ADD KEY `exam_num` (`exam_num`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `choices_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `container_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `counter_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `exam_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `normgen`
--
ALTER TABLE `normgen`
  MODIFY `norm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `normsub`
--
ALTER TABLE `normsub`
  MODIFY `norm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `referral`
--
ALTER TABLE `referral`
  MODIFY `ref_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resultgen`
--
ALTER TABLE `resultgen`
  MODIFY `resultgen_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `resultsub`
--
ALTER TABLE `resultsub`
  MODIFY `resultsub_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subexam`
--
ALTER TABLE `subexam`
  MODIFY `subexam_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`client_num`) REFERENCES `client` (`client_num`);

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `activitylog_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`);

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_3` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`);

--
-- Constraints for table `container`
--
ALTER TABLE `container`
  ADD CONSTRAINT `container_ibfk_1` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`),
  ADD CONSTRAINT `container_ibfk_2` FOREIGN KEY (`client_num`) REFERENCES `client` (`client_num`),
  ADD CONSTRAINT `container_ibfk_3` FOREIGN KEY (`ref_num`) REFERENCES `referral` (`ref_num`);

--
-- Constraints for table `counter`
--
ALTER TABLE `counter`
  ADD CONSTRAINT `counter_ibfk_1` FOREIGN KEY (`client_num`) REFERENCES `client` (`client_num`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`subexam_num`) REFERENCES `subexam` (`subexam_num`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`);

--
-- Constraints for table `normgen`
--
ALTER TABLE `normgen`
  ADD CONSTRAINT `normgen_ibfk_1` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`);

--
-- Constraints for table `normsub`
--
ALTER TABLE `normsub`
  ADD CONSTRAINT `normsub_ibfk_1` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`),
  ADD CONSTRAINT `normsub_ibfk_2` FOREIGN KEY (`subexam_num`) REFERENCES `subexam` (`subexam_num`);

--
-- Constraints for table `referral`
--
ALTER TABLE `referral`
  ADD CONSTRAINT `fk_Perreferral` FOREIGN KEY (`client_num`) REFERENCES `client` (`client_num`);

--
-- Constraints for table `resultgen`
--
ALTER TABLE `resultgen`
  ADD CONSTRAINT `resultgen_ibfk_1` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`),
  ADD CONSTRAINT `resultgen_ibfk_2` FOREIGN KEY (`ref_num`) REFERENCES `referral` (`ref_num`);

--
-- Constraints for table `resultsub`
--
ALTER TABLE `resultsub`
  ADD CONSTRAINT `resultsub_ibfk_1` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`),
  ADD CONSTRAINT `resultsub_ibfk_3` FOREIGN KEY (`ref_num`) REFERENCES `referral` (`ref_num`),
  ADD CONSTRAINT `resultsub_ibfk_5` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`);

--
-- Constraints for table `subexam`
--
ALTER TABLE `subexam`
  ADD CONSTRAINT `subexam_ibfk_1` FOREIGN KEY (`exam_num`) REFERENCES `exam` (`exam_num`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
