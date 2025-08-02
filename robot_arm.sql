-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 02 أغسطس 2025 الساعة 00:49
-- إصدار الخادم: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `robot_arm`
--

-- --------------------------------------------------------

--
-- بنية الجدول `poses`
--

DROP TABLE IF EXISTS `poses`;
CREATE TABLE IF NOT EXISTS `poses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `motor1` int(11) NOT NULL,
  `motor2` int(11) NOT NULL,
  `motor3` int(11) NOT NULL,
  `motor4` int(11) NOT NULL,
  `motor5` int(11) NOT NULL,
  `motor6` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- إرجاع أو استيراد بيانات الجدول `poses`
--

INSERT INTO `poses` (`id`, `motor1`, `motor2`, `motor3`, `motor4`, `motor5`, `motor6`, `status`) VALUES
(1, 100, 90, 90, 90, 90, 90, 0),
(2, 100, 90, 90, 107, 90, 90, 0),
(3, 117, 144, 98, 107, 90, 101, 0),
(4, 117, 144, 98, 147, 132, 101, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
