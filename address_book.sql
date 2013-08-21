-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2012 at 10:54 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `address_book`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `address` varchar(40) NOT NULL,
  `registration_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`user_id`, `firstname`, `lastname`, `phonenumber`, `address`, `registration_date`) VALUES
(18, 'Δημήτρης', 'Κωσταράς', '2106121920', 'Γράμμου 72 Μαρούσι', '2012-01-16 19:55:42'),
(19, 'dimitris', 'kostaras', '6977564685', 'gramou 74 marousi', '0000-00-00 00:00:00'),
(21, 'giannis', 'lostaras', '2106121920', 'gsafddgdg', '2012-01-24 21:43:36'),
(22, 'dimitris', 'kots', '2104355967', 'ddgdgh', '2012-02-05 19:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` char(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `registration_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `registration_date`) VALUES
(8, 'dimitris2', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'dikostaras@yahoo.gr', '2012-01-24 22:18:00'),
(9, 'dimitris18', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'dikostaras@gmail.com', '2012-01-24 22:19:31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
