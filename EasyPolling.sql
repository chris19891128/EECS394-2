-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 11 月 09 日 18:35
-- 服务器版本: 5.6.12
-- PHP 版本: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `EasyPolling`
--
CREATE DATABASE IF NOT EXISTS `EasyPolling` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `EasyPolling`;

-- --------------------------------------------------------

--
-- 表的结构 `Answer`
--

CREATE TABLE IF NOT EXISTS `Answer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Poll_ID` varchar(11) DEFAULT NULL,
  `Answer` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `Answer`
--

INSERT INTO `Answer` (`ID`, `Poll_ID`, `Answer`) VALUES
(7, 'u6al', '4'),
(8, 'u6al', '3'),
(9, 'u6al', '3'),
(10, 'u6al', '3'),
(11, 'o46z', '3'),
(12, 'o46z', '2'),
(13, 'o46z', '4'),
(14, 'y2sx', '2');

-- --------------------------------------------------------

--
-- 表的结构 `Poll`
--

CREATE TABLE IF NOT EXISTS `Poll` (
  `ID` varchar(11) NOT NULL,
  `Content` longtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `Poll`
--

INSERT INTO `Poll` (`ID`, `Content`) VALUES
('1kub', '{question: "What is your gender?", answer:["Male", "Female"]}'),
('2lqb', '{question: "test", answer:["1"]}'),
('5a0b', '{question: "Test", answer:["01", "124"]}'),
('60t9', '{question: "what&#39;s that?", answer:["wawa", "lala", "hehe", "hehe3", "hehe1"]}'),
('7m66', '{question: "Test AGain", answer:["A", "B", "C", "D"]}'),
('9nxy', '{question: "what is your name?", answer:["vance", "hehe", "lala", "wuwu", "xixi"]}'),
('cqgo', '{question: "Test", answer:["O1", "O2"]}'),
('gyg2', '{question: "What&#39;s your favorite color?", answer:["Red", "Green"]}'),
('o46z', '{question: "what&#39;s the time?", answer:["11:00", "12:00", "1:00", "2:00", "3:00", ""]}'),
('u6al', '{question: "what is your name?", answer:["lala", "houhou", "xixi", "hehe", "haha"]}'),
('y2sx', '{question: "nihao?", answer:["nihao1", "nihao2", "nihao3", "nihao4", "nihao5"]}');

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `Users`
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
