-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2016 at 06:05 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wtfindin_hms`
--

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE IF NOT EXISTS `division` (
`div_id` int(10) NOT NULL,
  `div_name` varchar(50) NOT NULL,
  `div_address` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`div_id`, `div_name`, `div_address`) VALUES
(1, 'Borsillah', 'Borsillah Tea Estate, Sivsagar'),
(2, 'Moran', 'Moran, Dibrugarh');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
`d_id` int(100) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `d_designation` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`d_id`, `d_name`, `d_designation`) VALUES
(1, 'Syed Mahfuzul Mazid', 'MD Gynecologist'),
(2, 'Rajiv Saikia', 'MD Medicine');

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE IF NOT EXISTS `drugs` (
`drugs_id` int(100) NOT NULL,
  `drugs_cat_id` int(100) NOT NULL,
  `drugs_name` varchar(100) NOT NULL,
  `drugs_description` varchar(200) NOT NULL,
  `drugs_price` int(30) NOT NULL,
  `drugs_company` varchar(100) NOT NULL,
  `drugs_quantity` int(100) NOT NULL,
  `drugs_manufacturing_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `drugs_expiry_date` timestamp NULL DEFAULT NULL,
  `drugs_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isAvailable` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drugs_id`, `drugs_cat_id`, `drugs_name`, `drugs_description`, `drugs_price`, `drugs_company`, `drugs_quantity`, `drugs_manufacturing_date`, `drugs_expiry_date`, `drugs_entry_date`, `isAvailable`) VALUES
(1, 7, 'Livosin', 'liver tonic', 120, 'livosin', 99, '2015-05-19 18:30:00', '2018-09-13 18:30:00', '2016-07-27 15:35:31', 'Y'),
(2, 7, 'livsav plus', 'liver tonic', 140, 'livsav gayetri', 140, '2013-03-13 18:30:00', '2017-07-03 18:30:00', '2016-07-27 15:26:54', 'Y'),
(3, 4, 'nice', 'paracetamol for fever and cold', 3, 'paracetamol', 98, '2015-09-03 18:30:00', '2017-08-14 18:30:00', '2016-07-27 15:35:31', 'Y'),
(4, 9, 'quinine', 'fever', 30, 'alley', 60, '2014-07-21 18:30:00', '2016-07-11 18:30:00', '2016-07-27 15:31:09', 'N'),
(5, 7, 'Livsav plus', 'liver tonic', 120, 'livsav plus', 100, '2016-07-30 18:25:21', '2016-07-29 18:30:00', '2016-07-30 18:25:21', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `drugscategory`
--

CREATE TABLE IF NOT EXISTS `drugscategory` (
`drugs_cat_id` int(100) NOT NULL,
  `drugs_cat` varchar(100) NOT NULL,
  `drugs_cat_desc` varchar(100) NOT NULL,
  `drugs_cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugscategory`
--

INSERT INTO `drugscategory` (`drugs_cat_id`, `drugs_cat`, `drugs_cat_desc`, `drugs_cat_date`) VALUES
(4, 'Paracetamol', 'Paracetamol tablets and syprup', '2016-07-17 14:11:16'),
(5, 'Pain Killers', 'Pain Killers tablets and injection\n', '2016-07-17 14:37:45'),
(7, 'Liver Syrup', 'Liver Syrup and Tablets', '2016-07-18 11:40:23'),
(8, 'Allergy', 'Allergic Tabs', '2016-07-18 11:42:00'),
(9, 'injection', 'liquid', '2016-07-27 15:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`e_id` int(100) NOT NULL,
  `e_emp_id` varchar(100) NOT NULL,
  `division` int(10) NOT NULL,
  `book` enum('1','2','3') NOT NULL,
  `pf_id` varchar(100) NOT NULL,
  `e_des_id` int(100) NOT NULL,
  `e_name` varchar(100) NOT NULL,
  `e_salary` int(100) NOT NULL,
  `e_age` int(3) NOT NULL,
  `e_gender` enum('male','female') NOT NULL,
  `e_address` varchar(100) NOT NULL,
  `isActive` enum('Y','N') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`e_id`, `e_emp_id`, `division`, `book`, `pf_id`, `e_des_id`, `e_name`, `e_salary`, `e_age`, `e_gender`, `e_address`, `isActive`) VALUES
(1, 'EMP1001', 1, '1', 'PF1001', 1, 'Debojit Deori', 10000, 27, 'male', 'Sonari Court Colony, Sibsagar', 'Y'),
(2, 'EMP1002', 2, '2', 'PF1002', 2, 'Manash Jyoti Gogoi', 9000, 27, 'male', 'Meteka Gaon, Sibsagar', 'Y'),
(3, 'EMP1003', 3, '3', 'PF1003', 3, 'Sridevi Karmakar', 5000, 30, 'female', 'Borsillah Tea Estate', 'Y'),
(4, 'EMP1004', 2, '2', 'PF1004', 2, 'Rajiv Saikia', 10000, 27, 'male', 'Dibrugarh', 'Y'),
(5, 'EMP1005', 1, '2', 'PF1005', 3, 'Hariya', 5000, 30, 'male', 'Dibrugarh', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `employee_designation`
--

CREATE TABLE IF NOT EXISTS `employee_designation` (
`e_des_id` int(100) NOT NULL,
  `e_des` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_designation`
--

INSERT INTO `employee_designation` (`e_des_id`, `e_des`) VALUES
(2, 'Asst. Manager'),
(3, 'Labour'),
(1, 'Manager');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE IF NOT EXISTS `prescription` (
`p_id` int(100) NOT NULL,
  `doctor_id` int(100) NOT NULL,
  `patient_type` enum('inPatient','outPatient') NOT NULL DEFAULT 'inPatient',
  `employee_id` varchar(100) NOT NULL,
  `empName` varchar(100) NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_remark` varchar(100) NOT NULL,
  `p_note` varchar(100) NOT NULL,
  `updateDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`p_id`, `doctor_id`, `patient_type`, `employee_id`, `empName`, `p_date`, `p_remark`, `p_note`, `updateDate`) VALUES
(1, 2, 'inPatient', 'EMP1003', 'Sridevi Karmakar', '2016-07-27 15:35:31', 'nil', 'nil', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescription_drugs`
--

CREATE TABLE IF NOT EXISTS `prescription_drugs` (
`pdId` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `drug_id` int(11) NOT NULL,
  `drugCatId` int(11) NOT NULL,
  `addedQuantity` varchar(45) NOT NULL DEFAULT '1',
  `drugs_total` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_drugs`
--

INSERT INTO `prescription_drugs` (`pdId`, `p_id`, `drug_id`, `drugCatId`, `addedQuantity`, `drugs_total`) VALUES
(1, 1, 1, 7, '1', '120.00'),
(2, 1, 3, 4, '2', '6.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`userId` int(5) NOT NULL,
  `loginId` varchar(100) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `loginId`, `first_name`, `last_name`, `password`) VALUES
(1, 'admin@wtf.ind.in', 'Rajiv', 'Saikia', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
`userLoginId` int(11) NOT NULL,
  `loginDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `remote_addr` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`userLoginId`, `loginDate`, `userId`, `remote_addr`) VALUES
(1, '2016-07-07 17:33:15', 1, '127.0.0.1'),
(2, '2016-07-07 17:59:11', 1, '127.0.0.1'),
(3, '2016-07-07 18:09:45', 1, '127.0.0.1'),
(4, '2016-07-07 18:45:40', 1, '127.0.0.1'),
(5, '2016-07-07 18:47:15', 1, '127.0.0.1'),
(6, '2016-07-07 18:47:30', 1, '127.0.0.1'),
(7, '2016-07-07 18:56:08', 1, '127.0.0.1'),
(8, '2016-07-07 18:57:53', 1, '127.0.0.1'),
(9, '2016-07-07 19:01:56', 1, '127.0.0.1'),
(10, '2016-07-07 19:02:19', 1, '127.0.0.1'),
(11, '2016-07-07 19:03:31', 1, '127.0.0.1'),
(12, '2016-07-07 19:29:45', 1, '127.0.0.1'),
(13, '2016-07-07 19:30:49', 1, '127.0.0.1'),
(14, '2016-07-07 19:31:17', 1, '127.0.0.1'),
(15, '2016-07-07 19:40:21', 1, '127.0.0.1'),
(16, '2016-07-07 19:43:00', 1, '127.0.0.1'),
(17, '2016-07-07 19:46:58', 1, '127.0.0.1'),
(18, '2016-07-08 08:41:07', 1, '127.0.0.1'),
(19, '2016-07-08 10:33:23', 1, '127.0.0.1'),
(20, '2016-07-08 10:51:52', 1, '127.0.0.1'),
(21, '2016-07-08 11:01:38', 1, '127.0.0.1'),
(22, '2016-07-08 11:01:48', 1, '127.0.0.1'),
(23, '2016-07-08 11:01:53', 1, '127.0.0.1'),
(24, '2016-07-08 11:07:01', 1, '127.0.0.1'),
(25, '2016-07-08 12:11:31', 1, '127.0.0.1'),
(26, '2016-07-08 12:12:02', 1, '127.0.0.1'),
(27, '2016-07-08 14:14:42', 1, '127.0.0.1'),
(28, '2016-07-08 14:15:40', 1, '127.0.0.1'),
(29, '2016-07-08 14:41:07', 1, '127.0.0.1'),
(30, '2016-07-08 14:42:17', 1, '127.0.0.1'),
(31, '2016-07-08 14:46:31', 1, '127.0.0.1'),
(32, '2016-07-08 14:49:09', 1, '127.0.0.1'),
(33, '2016-07-09 06:40:46', 1, '::1'),
(34, '2016-07-18 06:06:32', 1, '::1'),
(35, '2016-07-18 06:48:41', 1, '::1'),
(36, '2016-07-18 08:15:07', 1, '::1'),
(37, '2016-07-21 11:01:40', 1, '127.0.0.1'),
(38, '2016-07-21 11:12:29', 1, '127.0.0.1'),
(39, '2016-07-21 12:40:52', 1, '127.0.0.1'),
(40, '2016-07-21 12:48:41', 1, '::1'),
(41, '2016-07-21 13:07:03', 1, '::1'),
(42, '2016-07-22 17:32:44', 1, '::1'),
(43, '2016-07-23 02:20:19', 1, '::1'),
(44, '2016-07-24 05:13:38', 1, '::1'),
(45, '2016-07-24 08:18:24', 1, '127.0.0.1'),
(46, '2016-07-24 13:09:40', 1, '::1'),
(47, '2016-07-26 17:09:52', 1, '127.0.0.1'),
(48, '2016-07-27 11:22:58', 1, '192.168.50.2'),
(49, '2016-07-27 11:27:21', 1, '192.168.50.2'),
(50, '2016-07-27 11:32:07', 1, '192.168.50.2'),
(51, '2016-07-27 15:10:54', 1, '127.0.0.1'),
(52, '2016-07-29 15:19:02', 1, '127.0.0.1'),
(53, '2016-07-29 15:22:52', 1, '127.0.0.1'),
(54, '2016-07-30 17:03:25', 1, '127.0.0.1'),
(55, '2016-07-31 13:43:50', 1, '127.0.0.1'),
(56, '2016-07-31 17:47:04', 1, '127.0.0.1'),
(57, '2016-08-01 17:58:43', 1, '127.0.0.1'),
(58, '2016-08-01 18:08:08', 1, '127.0.0.1'),
(59, '2016-08-01 18:51:03', 1, '127.0.0.1'),
(60, '2016-08-01 19:40:05', 1, '127.0.0.1'),
(61, '2016-08-02 05:37:27', 1, '127.0.0.1'),
(62, '2016-08-02 11:29:03', 1, '127.0.0.1'),
(63, '2016-08-02 14:35:27', 1, '127.0.0.1'),
(64, '2016-08-02 14:35:28', 1, '127.0.0.1'),
(65, '2016-08-02 15:04:18', 1, '127.0.0.1'),
(66, '2016-08-03 03:50:19', 1, '127.0.0.1'),
(67, '2016-08-03 09:56:34', 1, '127.0.0.1'),
(68, '2016-08-03 14:17:09', 1, '127.0.0.1'),
(69, '2016-08-03 14:17:31', 1, '127.0.0.1'),
(70, '2016-08-03 14:20:07', 1, '127.0.0.1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `division`
--
ALTER TABLE `division`
 ADD PRIMARY KEY (`div_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
 ADD PRIMARY KEY (`d_id`), ADD UNIQUE KEY `d_designation` (`d_designation`);

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
 ADD PRIMARY KEY (`drugs_id`);

--
-- Indexes for table `drugscategory`
--
ALTER TABLE `drugscategory`
 ADD PRIMARY KEY (`drugs_cat_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`e_id`), ADD UNIQUE KEY `e_emp_id` (`e_emp_id`);

--
-- Indexes for table `employee_designation`
--
ALTER TABLE `employee_designation`
 ADD PRIMARY KEY (`e_des_id`), ADD UNIQUE KEY `e_des` (`e_des`);

--
-- Indexes for table `prescription`
--
ALTER TABLE `prescription`
 ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `prescription_drugs`
--
ALTER TABLE `prescription_drugs`
 ADD PRIMARY KEY (`pdId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
 ADD PRIMARY KEY (`userLoginId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `division`
--
ALTER TABLE `division`
MODIFY `div_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
MODIFY `d_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
MODIFY `drugs_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `drugscategory`
--
ALTER TABLE `drugscategory`
MODIFY `drugs_cat_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `e_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employee_designation`
--
ALTER TABLE `employee_designation`
MODIFY `e_des_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `prescription`
--
ALTER TABLE `prescription`
MODIFY `p_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `prescription_drugs`
--
ALTER TABLE `prescription_drugs`
MODIFY `pdId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
MODIFY `userLoginId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
