-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2013 at 08:58 PM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enterpriseappstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `apikeys`
--

DROP TABLE IF EXISTS `apikeys`;
CREATE TABLE `apikeys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `key` varchar(40) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `apikeys`
--


-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `identifier` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `platform` tinyint(2) unsigned NOT NULL,
  `version` varchar(15) NOT NULL,
  `size` bigint(20) unsigned NOT NULL DEFAULT '0',
  `sort` int(5) unsigned NOT NULL DEFAULT '1000',
  `config` text NOT NULL,
  `location` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`identifier`,`platform`,`sort`),
  KEY `version` (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications`
--


-- --------------------------------------------------------

--
-- Table structure for table `applications_attachments`
--

DROP TABLE IF EXISTS `applications_attachments`;
CREATE TABLE `applications_attachments` (
  `application_id` bigint(20) unsigned NOT NULL,
  `attachment_id` bigint(20) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`attachment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications_attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `applications_categories`
--

DROP TABLE IF EXISTS `applications_categories`;
CREATE TABLE `applications_categories` (
  `application_id` bigint(20) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications_categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `applications_groups`
--

DROP TABLE IF EXISTS `applications_groups`;
CREATE TABLE `applications_groups` (
  `application_id` bigint(20) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `applications_groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint(20) unsigned DEFAULT NULL,
  `application_identifier` varchar(150) NOT NULL,
  `application_platform` tinyint(2) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filetype_id` int(11) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `application_id` (`application_id`,`name`,`created`,`modified`),
  KEY `application_identifier` (`application_identifier`),
  KEY `application_platform` (`application_platform`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `created` (`created`,`modified`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`, `created`, `modified`) VALUES
(1, 'Travel', '', 'icon-plane', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Health', '', 'icon-ambulance', '0000-00-00 00:00:00', '2013-11-11 16:44:16'),
(3, 'Photography', '', 'icon-camera', '0000-00-00 00:00:00', '2013-11-11 15:15:34'),
(4, 'Games', '', 'icon-fighter-jet', '0000-00-00 00:00:00', '2013-11-11 15:15:51'),
(5, 'Legal', '', 'icon-legal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Utilities', '', 'icon-lightbulb', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Android', 'Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.', 'icon-android', '0000-00-00 00:00:00', '2013-11-12 10:36:17'),
(8, 'Finance', '', 'icon-money', '0000-00-00 00:00:00', '2013-11-11 15:15:59'),
(9, 'Apple', '', 'icon-apple', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Retro', '', 'icon-camera-retro', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE `downloads` (
  `application_id` bigint(20) unsigned NOT NULL,
  `created` datetime NOT NULL,
  KEY `application_id` (`application_id`,`created`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `downloads`
--


-- --------------------------------------------------------

--
-- Table structure for table `filetypes`
--

DROP TABLE IF EXISTS `filetypes`;
CREATE TABLE `filetypes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `mime` varchar(25) NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `icon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mime` (`mime`,`allowed`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `filetypes`
--

INSERT INTO `filetypes` (`id`, `mime`, `allowed`, `icon`) VALUES
(1, 'pdf', 1, 'icon-edit'),
(2, 'word', 1, 'icon-print');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `all_versions_available` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`,`created`,`modified`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `groups_users`
--

DROP TABLE IF EXISTS `groups_users`;
CREATE TABLE `groups_users` (
  `group_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `user_id` (`group_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_users`
--


-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `application_id` bigint(20) unsigned NOT NULL,
  `action` varchar(3) NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  KEY `application_id` (`application_id`,`action`,`created`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--


-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

DROP TABLE IF EXISTS `ideas`;
CREATE TABLE `ideas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(80) NOT NULL,
  `area` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`,`area`),
  KEY `created` (`created`,`modified`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ideas`
--


-- --------------------------------------------------------

--
-- Table structure for table `signings`
--

DROP TABLE IF EXISTS `signings`;
CREATE TABLE `signings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `certificate` varchar(250) NOT NULL,
  `password` varchar(150) NOT NULL,
  `provisioning` varchar(250) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created` (`created`,`modified`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signings`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `company` varchar(80) NOT NULL,
  `password_token` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nickname` (`username`,`email`,`password`),
  KEY `role` (`role`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created`, `modified`, `firstname`, `lastname`, `company`, `password_token`) VALUES
(1, 'admin', 'admin@example.com', '3a37e68dd29ea23ff7fc9cf009da7bef9a13a5f4', 'owner', '2013-11-21 20:32:29', '2013-11-21 20:32:29', 'Super', 'Admin', 'Company', '');
