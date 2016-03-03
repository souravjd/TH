-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2016 at 05:22 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `th`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookedseat`
--

CREATE TABLE IF NOT EXISTS `bookedseat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `seat_location` varchar(255) NOT NULL,
  `seat_no` varchar(255) NOT NULL,
  `fare` varchar(255) NOT NULL,
  `pnr_no` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `travel_date` varchar(255) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `book_status` enum('0','1','2') NOT NULL COMMENT '0-unreserved,1-reserved,2-cancelled ',
  PRIMARY KEY (`id`),
  KEY `seat_id` (`seat_location`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bookedseat`
--


-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(256) NOT NULL,
  `bus_number` varchar(32) NOT NULL COMMENT 'Bus number plate',
  `bus_routes` varchar(1024) NOT NULL,
  `route_price` varchar(1024) NOT NULL COMMENT 'price related to routes columns',
  `days` varchar(1024) NOT NULL,
  `time` time NOT NULL,
  `bus_details` varchar(1024) NOT NULL COMMENT 'Bus Type & Details',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bus_status` varchar(16) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `bus_number`, `bus_routes`, `route_price`, `days`, `time`, `bus_details`, `doe`, `bus_status`, `owner`) VALUES
(1, 'Jain Bus', 'PB02J1934', '1,', '360', '1,1,1,1,1,1,1,', '11:00:00', 'Mercedes Benz A/C (2+2)', '2016-02-25 16:06:30', 'active', 1),
(2, 'Liberty Travels', 'PB12N1243', '1,', '400', '1,1,1,1,1,1,1,', '13:00:00', 'Mercedes A/C Semisleeper (2+2)', '2016-02-13 15:26:02', 'active', 1),
(3, 'Amr to dlh Volvo', 'PB05G4950', '2,', '815', '1,1,1,1,1,1,1', '15:45:00', 'Volvo (2+2)', '2016-02-25 21:42:32', 'active', 1),
(4, 'Jal to delhi Volvo', 'PB08D6856', '3,', '685', '1,1,1,1,1,1,1', '19:00:00', 'Volvo (2+2)', '2016-02-25 21:42:32', 'active', 1),
(5, 'Lud to del (2+2)', 'PB11Y6794', '4,', '580', '1,1,1,1,1,1,1,', '06:45:00', 'Volvo (2+2)', '2016-02-26 23:24:41', 'active', 1),
(6, 'Lud to del (2+2)', 'PB11Y8475', '4,', '580', '1,1,1,1,1,1,1,', '10:00:00', 'Volvo (2+2)', '2016-02-26 23:29:02', 'active', 1),
(7, 'Lud to Del (2+2)', 'PB11Y6757', '4,', '580', '1,1,1,1,1,1,1,', '15:00:00', 'Volvo (2+2)', '2016-02-26 23:29:02', 'active', 1),
(8, 'Kap to Del (2+2)', 'PB13F4638', '5,', '730', '1,1,1,1,1,1,1,', '18:40:00', 'Volvo (2+2)', '2016-02-26 23:36:26', 'active', 3),
(9, 'Del to Jal (2+2)', 'DL03H7894', '6,', '685', '1,1,1,1,1,1,1,', '16:40:00', 'Volvo (2+2)', '2016-02-26 23:36:26', 'active', 4),
(10, 'DEL to KAP (2+2)', 'DL04D4859', '7,', '720', '1,1,1,1,1,1,1,', '06:00:00', 'Volvo (2+2)', '2016-02-26 23:42:39', 'active', 4),
(11, 'DEL to JAL (2+2)', 'DL05T4937', '6,', '685', '1,1,1,1,1,1,1,', '08:50:00', 'Volvo (2+2)', '2016-02-26 23:42:39', 'active', 4),
(12, 'DEL to LUD (2+2)', 'DL02H3594', '8,', '580', '1,1,1,1,1,1,1,', '17:30:00', 'Volvo (2+2)', '2016-02-26 23:44:48', 'active', 4),
(13, 'DEL to LUD (2+2)', 'DL02H8946', '8,', '580', '1,1,1,1,1,1,1,', '23:15:00', 'Volvo (2+2)', '2016-02-26 23:44:48', 'active', 4),
(14, 'Del to Jal (2+2)', 'DL08Y8746', '6,', '685', '1,1,1,1,1,1,1,', '00:30:00', 'Volvo (2+2)', '2016-02-26 23:47:20', 'active', 4),
(15, 'Del to Amr (2+2)', 'PB08D4564', '9,', '815,', '1,1,1,1,1,1,1,', '19:30:00', 'Volvo (2+2)', '2016-02-26 23:47:20', 'active', 4);

-- --------------------------------------------------------

--
-- Table structure for table `passengerlist`
--

CREATE TABLE IF NOT EXISTS `passengerlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seatnum` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `fare` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `passengerlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `point_id` int(11) NOT NULL AUTO_INCREMENT,
  `point_name` varchar(256) NOT NULL,
  `point_status` varchar(16) NOT NULL DEFAULT 'active',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `e_by` int(11) NOT NULL,
  PRIMARY KEY (`point_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`point_id`, `point_name`, `point_status`, `doe`, `e_by`) VALUES
(1, 'ludhiana', 'active', '2016-02-07 15:39:02', 1),
(2, 'amritsar', 'active', '2016-02-07 15:39:02', 1),
(3, 'jalandhar', 'active', '2016-02-07 15:39:02', 1),
(4, 'phagwara', 'active', '2016-02-07 15:39:02', 1),
(5, 'ambala', 'active', '2016-02-07 15:39:02', 1),
(6, 'kurukshetra', 'active', '2016-02-07 15:39:02', 1),
(7, 'chandigarh', 'active', '2016-02-07 15:39:02', 1),
(8, 'muktsar', 'active', '2016-02-07 15:39:02', 1),
(9, 'panipat', 'active', '2016-02-07 15:39:02', 1),
(10, 'delhi', 'active', '2016-02-25 21:10:54', 1),
(11, 'kapurthala', 'active', '2016-02-25 21:10:54', 1),
(12, 'Nakodar', 'active', '2016-02-26 23:30:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `route_id` int(11) NOT NULL AUTO_INCREMENT,
  `starting_point` int(11) NOT NULL,
  `ending_point` int(11) NOT NULL,
  `mid_points` varchar(1024) NOT NULL,
  `via` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL COMMENT 'in Rs',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(16) NOT NULL DEFAULT 'inactive',
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `starting_point`, `ending_point`, `mid_points`, `via`, `price`, `doe`, `status`, `owner`) VALUES
(1, 2, 1, '2,3,4,1,', 0, 360, '2016-02-07 15:23:16', 'active', 1),
(2, 2, 10, '2,3,1,10,', 0, 815, '2016-02-25 23:07:44', 'active', 1),
(3, 3, 10, '3,1,10,', 0, 685, '2016-02-25 23:07:44', 'active', 2),
(4, 1, 10, '1,10,', 0, 580, '2016-02-26 23:24:01', 'active', 1),
(5, 11, 10, '11,12,1,10,', 0, 730, '2016-02-26 23:32:59', 'active', 3),
(6, 10, 3, '10,1,3,', 0, 685, '2016-02-26 23:32:59', 'active', 4),
(7, 10, 11, '10,1,3,11', 0, 720, '2016-02-26 23:38:45', 'active', 4),
(8, 10, 1, '10,1,', 0, 580, '2016-02-26 23:38:45', 'active', 4),
(9, 10, 2, '10,1,3,2,', 0, 815, '2016-02-26 23:39:31', 'active', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_mail` varchar(128) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `user_name` varchar(64) DEFAULT NULL,
  `user_doj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_state` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_mail`, `user_password`, `user_name`, `user_doj`, `user_state`) VALUES
(1, 'demo@demo.demo', 'demo', 'Demo User', '2015-12-20 19:05:45', 1),
(2, 'testaccount@test.com', 'password', 'Test Account', '2016-01-14 17:38:25', 1);
