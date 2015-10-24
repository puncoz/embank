-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 26, 2014 at 06:54 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `embank`
--
CREATE DATABASE IF NOT EXISTS `embank` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `embank`;

-- --------------------------------------------------------

--
-- Table structure for table `embank_recharge`
--

CREATE TABLE IF NOT EXISTS `embank_recharge` (
  `recharge_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `recharge_pin` char(9) NOT NULL,
  `recharge_denomination` int(11) NOT NULL,
  `recharge_by` varchar(15) NOT NULL DEFAULT 'false',
  `recharge_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`recharge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `embank_recharge`
--

INSERT INTO `embank_recharge` (`recharge_id`, `recharge_pin`, `recharge_denomination`, `recharge_by`, `recharge_date`) VALUES
(1, '999999998', 50, '9849020094', '2014-08-26 04:38:18'),
(2, '888888888', 100, '9849020094', '2014-08-26 05:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `embank_session`
--

CREATE TABLE IF NOT EXISTS `embank_session` (
  `session_id` varchar(64) NOT NULL,
  `ip_address` varchar(64) NOT NULL,
  `user_agent` varchar(128) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_data` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `embank_session`
--

INSERT INTO `embank_session` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('dd64dee5091b5c78398b29d2e107da26', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('d79aa04b50809269860b8accd0d3cadf', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('98a161d3fca4cd4aa290d30f7f74af03', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', 'a:2:{s:9:"user_data";s:0:"";s:28:"flash:new:embank_mob_reg_num";s:10:"9849057718";}'),
('b143c683e8572b17ae053f3b67ac9057', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('27a5fa9bba38f25c7a3b21089154ff4d', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('b872e7de45535fd8f209de6433ba91ef', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', 'a:2:{s:9:"user_data";s:0:"";s:28:"flash:new:embank_mob_reg_num";s:10:"9849057718";}'),
('53826545ff4d29a873848bd88631744a', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('ecf259511a5fb9a363eaa3325ca60f1c', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('cabf9cfc9b649d3288b8d8a96a172693', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('5e7d669fc44d78212c69bfa7a3465383', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', 'a:2:{s:9:"user_data";s:0:"";s:28:"flash:new:embank_mob_reg_num";s:10:"9849057718";}'),
('a04623974900aca7ac4198abf9cefb45', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('0285d28629cb227356b3c930d1933f89', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('9578fabddd3454fc044f68f48864b23c', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('0af06ef6859d770db6efd70d6d31edf6', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', 'a:2:{s:9:"user_data";s:0:"";s:28:"flash:new:embank_mob_reg_num";s:10:"9849057718";}'),
('9cd08bf43723ea967b4a43cdaa567333', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', ''),
('0c785430fcfd5dfef7d6ae8cde9a0dc8', '::1', 'Mozilla/5.0 (Windows NT 6.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mobNum` char(10) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `balance` float NOT NULL DEFAULT '0',
  `reg_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` varchar(15) NOT NULL,
  `user_role` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mobNum` (`mobNum`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `mobNum`, `user_password`, `balance`, `reg_time`, `status`, `user_role`) VALUES
(5, '9849020094', '370c614bcdff3fbd908ff5dec4dd76e9f476962975baa54a0e8a8257a84e5dd1e36149f6aa712258f5c4838824aa4bab361c72667279d001bf994b1db9145f10', 1820, '2014-08-20 02:10:43', 'active', 'user'),
(6, '9849057718', '370c614bcdff3fbd908ff5dec4dd76e9f476962975baa54a0e8a8257a84e5dd1e36149f6aa712258f5c4838824aa4bab361c72667279d001bf994b1db9145f10', 1310, '0000-00-00 00:00:00', 'active', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
