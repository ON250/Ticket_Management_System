-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2019 at 09:54 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tickectbdf`
--
CREATE DATABASE IF NOT EXISTS `tickectbdf` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tickectbdf`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `admin_fname` varchar(100) COLLATE utf8_bin NOT NULL,
  `admin_lname` varchar(100) COLLATE utf8_bin NOT NULL,
  `admin_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `admin_telephone` varchar(500) COLLATE utf8_bin NOT NULL,
  `admin_adress` varchar(500) COLLATE utf8_bin NOT NULL,
  `admin_status` int(11) NOT NULL,
  `admin_pin` int(11) NOT NULL,
  `admin_password` varchar(200) COLLATE utf8_bin NOT NULL,
  `c_date` datetime NOT NULL,
  `photoprofile` varchar(3000) COLLATE utf8_bin NOT NULL DEFAULT 'u.png',
  `location` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `admin_fname`, `admin_lname`, `admin_email`, `admin_telephone`, `admin_adress`, `admin_status`, `admin_pin`, `admin_password`, `c_date`, `photoprofile`, `location`, `type`) VALUES
(1, 'Olivier', 'NSANZABEGA', 'olivier.nsanzabega@ulk.ac.rw', '+250784323969', 'Kagugu', 1, 1, '158601328f3577e257ae7f5dd6b13bcef3f195fc', '2019-04-26 04:13:14', 'img/IMG_0872.JPG', 1, 123),
(2, 'Admin HQ', 'Admin', 'admin@bdf.rw', '0788454193', 'REMERA', 1, 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-04-26 05:14:13', 'u.png', 1, 0),
(3, 'DAIDDO', 'RUCYAHANA', 'd.rucyahana@bdf.rw', '0788536828', 'Kigali/Rwanda', 1, 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-04-26 17:46:40', 'img/IMG_1666.JPG', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `departID` int(11) NOT NULL AUTO_INCREMENT,
  `depart_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`departID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departID`, `depart_name`) VALUES
(1, 'CEO OFFICE'),
(2, 'FINANCE'),
(3, 'ADVISORY'),
(4, 'Monitoring& Evalution'),
(5, 'RISK'),
(6, 'AUDIT'),
(7, 'HR & Admin'),
(8, 'MARKETING'),
(9, 'Branch Coordination'),
(10, 'BRANCHES'),
(11, 'FUND'),
(12, 'IT');

-- --------------------------------------------------------

--
-- Table structure for table `end_users`
--

CREATE TABLE IF NOT EXISTS `end_users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `user_fname` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_lname` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_telephone` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_adress` varchar(100) COLLATE utf8_bin NOT NULL,
  `user_status` int(11) NOT NULL,
  `user_department` int(11) NOT NULL,
  `user_branch` int(11) NOT NULL,
  `user_pin` int(11) NOT NULL,
  `user_password` varchar(100) COLLATE utf8_bin NOT NULL,
  `c_date` datetime NOT NULL,
  `photoprofile` varchar(3000) COLLATE utf8_bin NOT NULL DEFAULT 'u.png',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `end_users`
--

INSERT INTO `end_users` (`userID`, `user_fname`, `user_lname`, `user_email`, `user_telephone`, `user_adress`, `user_status`, `user_department`, `user_branch`, `user_pin`, `user_password`, `c_date`, `photoprofile`) VALUES
(1, 'Patrick ', 'Nahimana', 'patrick@gmail.com', '0784123645', 'Gisozi', 1, 1, 2, 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-04-11 19:54:24', 'img/UGMF5039.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `locationID` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `location_name`) VALUES
(1, 'BDF HQ\r\n'),
(2, 'KICUKIRO Branch\r\n'),
(3, 'GASABO Branch\r\n'),
(4, 'NYARUGENGE Branch \r\n'),
(5, 'GISAGARA Branch'),
(6, 'HUYE Branch'),
(7, 'NYAMAGABE Branch\r\n'),
(8, 'MUHANGA Branch\r\n'),
(9, 'RUHANGO Branch\r\n'),
(10, 'NYARUGURU Branch\r\n'),
(11, 'KAMONYI Branch\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `mailbox`
--

CREATE TABLE IF NOT EXISTS `mailbox` (
  `mailID` int(11) NOT NULL AUTO_INCREMENT,
  `requestID` int(11) NOT NULL,
  `ticketID` varchar(1100) COLLATE utf8_bin NOT NULL,
  `sid` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subject` varchar(3000) COLLATE utf8_bin NOT NULL,
  `message` longtext COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `c_date` datetime NOT NULL,
  PRIMARY KEY (`mailID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mailbox`
--

INSERT INTO `mailbox` (`mailID`, `requestID`, `ticketID`, `sid`, `category`, `subject`, `message`, `type`, `c_date`) VALUES
(1, 1, 'T00001', 1, 3, 'Problem of Scanner', '<p>I do need help</p>', 1, '2019-04-26 17:34:46'),
(2, 1, 'T00001', 1, 3, '', 'Hey                 \r\n               ', 3, '2019-04-26 17:35:06'),
(3, 1, 'T00001', 2, 1, '', 'Hello! I hope IT team will help you very soon                 \r\n               ', 3, '2019-04-26 17:36:18'),
(4, 1, 'T00001', 2, 1, '', 'Plz help this people', 2, '2019-04-26 17:37:56'),
(5, 1, 'T00001', 1, 2, '', 'Hello I will do it this afternoon                 \r\n               ', 3, '2019-04-26 17:38:55'),
(6, 1, 'T00001', 1, 2, '', 'I''m working on it                   \r\n               ', 3, '2019-04-26 17:43:04'),
(7, 1, 'T00001', 1, 2, '', '      I am almost done     \r\n               ', 3, '2019-04-26 17:43:34'),
(8, 1, 'T00001', 1, 1, '', 'Hello Guys........!                 \r\n               ', 3, '2019-04-27 11:24:10'),
(9, 1, 'T00001', 1, 1, '', 'My thanks goes to Supporting team                 \r\n               ', 3, '2019-04-27 11:25:42'),
(10, 1, 'T00001', 1, 1, '', 'My thanks goes to Supporting team                 \r\n               ', 3, '2019-04-27 11:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `requestID` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_no` varchar(100) COLLATE utf8_bin NOT NULL,
  `ticket_category` int(11) NOT NULL,
  `request_subject` varchar(500) COLLATE utf8_bin NOT NULL,
  `request_details` text COLLATE utf8_bin NOT NULL,
  `sentBy` int(11) NOT NULL,
  `sentCategory` int(11) NOT NULL,
  `branchLocation` int(11) NOT NULL,
  `sentOn` datetime NOT NULL,
  `assignBy` int(11) NOT NULL,
  `assignTo` int(11) NOT NULL,
  `assignComment` text COLLATE utf8_bin NOT NULL,
  `assignOn` datetime NOT NULL,
  `feedBackOn` datetime NOT NULL,
  `feedBackComment` text COLLATE utf8_bin NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`requestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`requestID`, `ticket_no`, `ticket_category`, `request_subject`, `request_details`, `sentBy`, `sentCategory`, `branchLocation`, `sentOn`, `assignBy`, `assignTo`, `assignComment`, `assignOn`, `feedBackOn`, `feedBackComment`, `status`) VALUES
(1, 'T00001', 5, 'Problem of Scanner', '<p>I do need help</p>', 1, 0, 2, '2019-04-26 17:34:46', 2, 1, 'Plz help this people', '2019-04-26 17:37:56', '2019-04-26 17:44:11', 'Done', 3);

-- --------------------------------------------------------

--
-- Table structure for table `subadmin`
--

CREATE TABLE IF NOT EXISTS `subadmin` (
  `subAdminID` int(11) NOT NULL AUTO_INCREMENT,
  `subAdmin_fname` varchar(100) COLLATE utf8_bin NOT NULL,
  `subAdmin_lname` varchar(100) COLLATE utf8_bin NOT NULL,
  `subAdmin_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `subAdmin_telephone` varchar(100) COLLATE utf8_bin NOT NULL,
  `subAdmin_adress` varchar(100) COLLATE utf8_bin NOT NULL,
  `subAdmin_status` int(11) NOT NULL,
  `subAdmin_pin` int(11) NOT NULL,
  `subAdmin_password` varchar(100) COLLATE utf8_bin NOT NULL,
  `c_date` datetime NOT NULL,
  `photoprofile` varchar(3000) COLLATE utf8_bin NOT NULL DEFAULT 'u.png',
  `subAdmin_qualification` varchar(3000) COLLATE utf8_bin NOT NULL,
  `location` int(11) NOT NULL,
  PRIMARY KEY (`subAdminID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `subadmin`
--

INSERT INTO `subadmin` (`subAdminID`, `subAdmin_fname`, `subAdmin_lname`, `subAdmin_email`, `subAdmin_telephone`, `subAdmin_adress`, `subAdmin_status`, `subAdmin_pin`, `subAdmin_password`, `c_date`, `photoprofile`, `subAdmin_qualification`, `location`) VALUES
(1, 'Olivier', 'Nsanza', 'olivier.nsanza@gmail.com', '0784123645', 'Gisozi/Kigali', 1, 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '2019-04-26 17:33:34', 'u.png', 'Network', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickect_category`
--

CREATE TABLE IF NOT EXISTS `tickect_category` (
  `ticket_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_category_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `ticket_category_description` varchar(100) COLLATE utf8_bin NOT NULL,
  `c_date` datetime NOT NULL,
  PRIMARY KEY (`ticket_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tickect_category`
--

INSERT INTO `tickect_category` (`ticket_category_id`, `ticket_category_name`, `ticket_category_description`, `c_date`) VALUES
(1, 'Hadware Device Fault\r\n', 'Printer\r\n', '2019-03-14 07:16:21'),
(2, 'Hadware Device Fault', 'Laptop\r\n', '2019-03-14 07:16:25'),
(3, 'Hadware Device Fault\r\n', 'scanner\r\n', '2019-03-14 07:19:19'),
(4, 'Hadware Device Fault\r\n', 'Switch\r\n', '2019-03-14 07:19:19'),
(5, 'Hadware Device Fault\r\n', 'Phone\r\n', '2019-03-14 12:31:33'),
(6, 'Hadware Device Fault\r\n', 'other\r\n', '2019-03-14 12:31:40'),
(7, 'Network connection\r\n', '', '0000-00-00 00:00:00'),
(8, 'Web Application \r\n', '', '2019-03-14 13:34:34'),
(9, 'Focus I\r\n', '', '2019-03-14 13:34:34'),
(10, 'Globodox\r\n', '', '2019-03-14 13:33:33'),
(11, 'TeamMate\r\n', '', '2019-03-14 13:33:33'),
(12, 'Outlook\r\n', '', '2019-03-14 14:36:39'),
(13, 'Antivirus\r\n', '', '2019-03-14 14:36:39'),
(14, 'Others\r\n', '', '2019-03-14 13:35:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
