-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2013 at 01:24 AM
-- Server version: 5.6.12
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `EasyPolling`
--
CREATE DATABASE IF NOT EXISTS `EasyPolling` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `EasyPolling`;

-- --------------------------------------------------------

--
-- Table structure for table `Answer`
--

CREATE TABLE IF NOT EXISTS `Answer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Poll_ID` int(11) DEFAULT NULL,
  `Answer` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Poll`
--

CREATE TABLE IF NOT EXISTS `Poll` (
  `ID` varchar(11) NOT NULL,
  `Content` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Poll`
--

INSERT INTO `Poll` (`ID`, `Content`) VALUES
('1kub', '{question: "What is your gender?", answer:["Male", "Female"]}'),
('2lqb', '{question: "test", answer:["1"]}'),
('5a0b', '{question: "Test", answer:["01", "124"]}'),
('7m66', '{question: "Test AGain", answer:["A", "B", "C", "D"]}'),
('cqgo', '{question: "Test", answer:["O1", "O2"]}'),
('gyg2', '{question: "What&#39;s your favorite color?", answer:["Red", "Green"]}');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `username`, `password`) VALUES
(1, 'yuchaozh', '4262485789'),
(2, 'yuchao', '123'),
(3, '123', '321'),
(4, '222', '222'),
(5, 'lalalala', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
