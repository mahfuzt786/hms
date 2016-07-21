-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2016 at 03:00 PM
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
  `drugs_manufacturing_date` varchar(50) NOT NULL,
  `drugs_expiry_date` varchar(50) NOT NULL,
  `drugs_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `drugs_status` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`drugs_id`, `drugs_cat_id`, `drugs_name`, `drugs_description`, `drugs_price`, `drugs_company`, `drugs_quantity`, `drugs_manufacturing_date`, `drugs_expiry_date`, `drugs_entry_date`, `drugs_status`) VALUES
(1, 1, 'Some Vitamin', 'Vitamin C', 250, 'WalknetFunctions', 100, '12/3/13', '18/9/18', '2016-07-18 17:57:47', 'a'),
(2, 4, 'Nicip Plus', 'Paracetamol Tablet for Fever', 10, 'ITC', 300, '20/1/12', '16/2/16', '2016-07-19 15:21:37', 'e'),
(3, 0, 'nice', 'nice tablets for fever and cold', 12, 'r and d company ltd.', 14, '13/04/2018', '100', '2016-07-21 09:42:27', 'a'),
(4, 7, 'livsav plus', 'liver tonic', 130, 'Gayetri company', 15, '24/10/2018', '200', '2016-07-21 09:48:38', 'a'),
(5, 8, 'citricoto', 'alergy lotion', 140, 'citric acid ltd', 100, '07/09/2015', '20/07/2017', '2016-07-21 09:52:37', 'a'),
(6, 6, 'blueberry', 'antacid for accidity', 140, 'ss company', 100, '16/06/2015', '21/09/2017', '2016-07-21 10:03:09', 'a'),
(7, 4, 'sss', 'sssss', 0, 'sss', 12, '06/07/2016', '27/07/2016', '2016-07-21 10:03:55', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `drugscategory`
--

CREATE TABLE IF NOT EXISTS `drugscategory` (
`drugs_cat_id` int(100) NOT NULL,
  `drugs_cat` varchar(100) NOT NULL,
  `drugs_cat_desc` varchar(100) NOT NULL,
  `drugs_cat_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugscategory`
--

INSERT INTO `drugscategory` (`drugs_cat_id`, `drugs_cat`, `drugs_cat_desc`, `drugs_cat_date`) VALUES
(1, 'Vitamin Tabs', 'Vitamin Tablets', '2016-07-17 17:26:46'),
(4, 'Paracetamol', 'Paracetamol tablets and syprup', '2016-07-17 19:41:16'),
(5, 'Pain Killers', 'Pain Killers tablets and injection\n', '2016-07-17 20:07:45'),
(6, 'Anta Acid', 'Anta Acidic Syprup for acidity\n', '2016-07-18 17:08:20'),
(7, 'Liver Syrup', 'Liver Syrup and Tablets', '2016-07-18 17:10:23'),
(8, 'Allergy', 'Allergic Tabs', '2016-07-18 17:12:00');

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
(1, 'admin@wtf.ind.in', 'Achinta', 'Bhattacharjee', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
`userLoginId` int(11) NOT NULL,
  `loginDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userId` int(11) NOT NULL,
  `remote_addr` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

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
(33, '2016-07-08 15:28:23', 1, '127.0.0.1'),
(34, '2016-07-08 18:12:22', 1, '127.0.0.1'),
(35, '2016-07-08 18:12:29', 1, '127.0.0.1'),
(36, '2016-07-08 18:12:29', 1, '127.0.0.1'),
(37, '2016-07-08 18:12:30', 1, '127.0.0.1'),
(38, '2016-07-08 18:44:34', 1, '127.0.0.1'),
(39, '2016-07-08 19:13:08', 1, '127.0.0.1'),
(40, '2016-07-08 19:20:23', 1, '127.0.0.1'),
(41, '2016-07-10 16:16:09', 1, '127.0.0.1'),
(42, '2016-07-10 16:54:18', 1, '127.0.0.1'),
(43, '2016-07-10 19:19:26', 1, '127.0.0.1'),
(44, '2016-07-14 14:40:59', 1, '127.0.0.1'),
(45, '2016-07-14 14:46:22', 1, '127.0.0.1'),
(46, '2016-07-14 20:20:26', 1, '127.0.0.1'),
(47, '2016-07-14 20:20:29', 1, '127.0.0.1'),
(48, '2016-07-14 20:20:29', 1, '127.0.0.1'),
(49, '2016-07-14 20:20:30', 1, '127.0.0.1'),
(50, '2016-07-14 20:20:32', 1, '127.0.0.1'),
(51, '2016-07-14 20:22:30', 1, '127.0.0.1'),
(52, '2016-07-14 20:22:34', 1, '127.0.0.1'),
(53, '2016-07-14 20:22:36', 1, '127.0.0.1'),
(54, '2016-07-14 20:22:39', 1, '127.0.0.1'),
(55, '2016-07-14 20:22:41', 1, '127.0.0.1'),
(56, '2016-07-14 20:22:44', 1, '127.0.0.1'),
(57, '2016-07-15 09:12:32', 1, '127.0.0.1'),
(58, '2016-07-15 09:12:32', 1, '127.0.0.1'),
(59, '2016-07-15 09:16:08', 1, '127.0.0.1'),
(60, '2016-07-15 09:59:44', 1, '127.0.0.1'),
(61, '2016-07-15 16:26:14', 1, '127.0.0.1'),
(62, '2016-07-15 16:38:35', 1, '127.0.0.1'),
(63, '2016-07-16 16:27:08', 1, '127.0.0.1'),
(64, '2016-07-16 16:27:26', 1, '127.0.0.1'),
(65, '2016-07-17 05:31:45', 1, '127.0.0.1'),
(66, '2016-07-17 06:52:12', 1, '127.0.0.1'),
(67, '2016-07-17 06:55:24', 1, '127.0.0.1'),
(68, '2016-07-17 06:55:53', 1, '127.0.0.1'),
(69, '2016-07-17 06:56:25', 1, '127.0.0.1'),
(70, '2016-07-17 10:50:46', 1, '127.0.0.1'),
(71, '2016-07-17 13:45:15', 1, '127.0.0.1'),
(72, '2016-07-17 13:45:56', 1, '127.0.0.1'),
(73, '2016-07-17 16:32:41', 1, '127.0.0.1'),
(74, '2016-07-17 16:34:44', 1, '127.0.0.1'),
(75, '2016-07-17 19:55:07', 1, '127.0.0.1'),
(76, '2016-07-18 05:35:33', 1, '127.0.0.1'),
(77, '2016-07-18 06:45:45', 1, '127.0.0.1'),
(78, '2016-07-18 13:57:36', 1, '127.0.0.1'),
(79, '2016-07-19 11:09:27', 1, '127.0.0.1'),
(80, '2016-07-19 12:54:54', 1, '127.0.0.1'),
(81, '2016-07-20 13:42:46', 1, '127.0.0.1'),
(82, '2016-07-20 17:10:27', 1, '127.0.0.1'),
(83, '2016-07-20 17:54:38', 1, '127.0.0.1'),
(84, '2016-07-20 18:06:29', 1, '127.0.0.1'),
(85, '2016-07-21 07:10:27', 1, '127.0.0.1'),
(86, '2016-07-21 09:41:29', 1, '127.0.0.1');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
MODIFY `drugs_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `drugscategory`
--
ALTER TABLE `drugscategory`
MODIFY `drugs_cat_id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
MODIFY `userLoginId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
