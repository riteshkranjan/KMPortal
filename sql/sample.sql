-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 05, 2012 at 10:02 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8
-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 06, 2012 at 10:22 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carat_analysis`
--
USE `carat_analysis`;

-- 

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carat_analysis`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_name`
--

CREATE TABLE IF NOT EXISTS `app_name2` (
  `app_id` int(50) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(50) DEFAULT NULL,
  `app_desc` varchar(10000) DEFAULT NULL,
  `app_intf_diagram` varchar(100) DEFAULT NULL,
  `FULLFORM` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;


INSERT INTO `app_name2` (`app_id`, `app_name`, `app_desc`, `app_intf_diagram`, `FULLFORM`) VALUES
(2, 'CDFIS', 'CDFIS is a common data interface system.', 'CDFIS.jpg', 'CDFIS : Common Data File Interface Solutions');