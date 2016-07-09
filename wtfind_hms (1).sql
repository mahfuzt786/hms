-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2016 at 05:24 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wtfind_hms`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

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
(32, '2016-07-08 14:49:09', 1, '127.0.0.1');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `userId` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
MODIFY `userLoginId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
