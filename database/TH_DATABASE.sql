-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2016 at 10:58 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `th`
--
DROP DATABASE `th`;
CREATE DATABASE IF NOT EXISTS `th` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `th`;

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

DROP TABLE IF EXISTS `bus`;
CREATE TABLE IF NOT EXISTS `bus` (
  `bus_id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(256) NOT NULL,
  `bus_number` varchar(32) NOT NULL COMMENT 'Bus number plate',
  `bus_routes` varchar(1024) NOT NULL,
  `route_price` varchar(1024) NOT NULL COMMENT 'price related to routes columns',
  `days` varchar(1024) NOT NULL,
  `bus_details` varchar(1024) NOT NULL COMMENT 'Bus Type & Details',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bus_status` varchar(16) NOT NULL,
  `owner` int(11) NOT NULL,
  PRIMARY KEY (`bus_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Truncate table before insert `bus`
--

TRUNCATE TABLE `bus`;
--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_name`, `bus_number`, `bus_routes`, `route_price`, `days`, `bus_details`, `doe`, `bus_status`, `owner`) VALUES
(1, 'Jain Bus', 'PB02J1934', '1,', '360,', '1,1,1,1,1,1,1,', 'Mercedes Benz A/C (2+2)', '2016-02-07 10:36:30', 'active', 1),
(2, 'Liberty Travels', 'PB12N1243', '1,', '400,', '1,1,1,1,1,1,1,', 'Mercedes A/C Semisleeper (2+2)', '2016-02-13 09:56:02', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `point_id` int(11) NOT NULL AUTO_INCREMENT,
  `point_name` varchar(256) NOT NULL,
  `point_status` varchar(16) NOT NULL DEFAULT 'active',
  `doe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `e_by` int(11) NOT NULL,
  PRIMARY KEY (`point_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Truncate table before insert `points`
--

TRUNCATE TABLE `points`;
--
-- Dumping data for table `points`
--

INSERT INTO `points` (`point_id`, `point_name`, `point_status`, `doe`, `e_by`) VALUES
(1, 'ludhiana', 'active', '2016-02-07 10:09:02', 1),
(2, 'amritsar', 'active', '2016-02-07 10:09:02', 1),
(3, 'jalandhar', 'active', '2016-02-07 10:09:02', 1),
(4, 'phagwara', 'active', '2016-02-07 10:09:02', 1),
(5, 'ambala', 'active', '2016-02-07 10:09:02', 1),
(6, 'kurukshetra', 'active', '2016-02-07 10:09:02', 1),
(7, 'chandigarh', 'active', '2016-02-07 10:09:02', 1),
(8, 'muktsar', 'active', '2016-02-07 10:09:02', 1),
(9, 'panipat', 'active', '2016-02-07 10:09:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncate table before insert `routes`
--

TRUNCATE TABLE `routes`;
--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`route_id`, `starting_point`, `ending_point`, `mid_points`, `via`, `price`, `doe`, `status`, `owner`) VALUES
(1, 2, 1, '2,3,4,1,', 0, 360, '2016-02-07 09:53:16', 'active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
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
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_mail`, `user_password`, `user_name`, `user_doj`, `user_state`) VALUES
(1, 'demo@demo.demo', 'demo', 'Demo User', '2015-12-20 13:35:45', 1),
(2, 'testaccount@test.com', 'password', 'Test Account', '2016-01-14 12:08:25', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
