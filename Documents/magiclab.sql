-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2015 at 12:38 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `magiclab`
--
CREATE DATABASE IF NOT EXISTS `magiclab` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `magiclab`;

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE IF NOT EXISTS `Account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1: company, 2: user',
  `status` tinyint(4) DEFAULT '1' COMMENT '0: not activated, 1: activated',
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `CompanyProfile`
--

CREATE TABLE IF NOT EXISTS `CompanyProfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountId` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_cp_acc_idx` (`accountId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserProfile`
--

CREATE TABLE IF NOT EXISTS `UserProfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountId` int(11) NOT NULL,
  `firstName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0: female, 1: male, 3: undefined',
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountId_UNIQUE` (`accountId`),
  KEY `fk_up_acc_idx` (`accountId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `CompanyProfile`
--
ALTER TABLE `CompanyProfile`
  ADD CONSTRAINT `fk_cp_acc` FOREIGN KEY (`accountId`) REFERENCES `Account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `UserProfile`
--
ALTER TABLE `UserProfile`
  ADD CONSTRAINT `fk_up_acc` FOREIGN KEY (`accountId`) REFERENCES `Account` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
