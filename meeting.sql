-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 08, 2013 at 04:19 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `meeting`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `meeting_list`
-- 

CREATE TABLE `meeting_list` (
  `id` int(11) NOT NULL auto_increment,
  `strdate` date NOT NULL,
  `enddate` date NOT NULL,
  `strtime` time NOT NULL,
  `endtime` time NOT NULL,
  `room` int(5) NOT NULL,
  `room_type` int(5) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `qty` int(5) NOT NULL,
  `user` int(5) NOT NULL,
  `conduct` varchar(1) collate utf8_unicode_ci NOT NULL,
  `conduct_1` varchar(1) collate utf8_unicode_ci NOT NULL,
  `conduct_2` varchar(1) collate utf8_unicode_ci NOT NULL,
  `conduct_3` varchar(1) collate utf8_unicode_ci NOT NULL,
  `conduct_2_qty` int(2) NOT NULL,
  `conduct_3_qty` int(2) NOT NULL,
  `budget` varchar(1) collate utf8_unicode_ci NOT NULL,
  `mstatus` varchar(1) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `meeting_list`
-- 

INSERT INTO `meeting_list` VALUES (1, '2013-02-08', '2013-02-08', '08:00:00', '12:00:00', 1, 1, 'ทดสอบการจองห้องประชุมใหญ่', 50, 1, 'Y', '', '', '', 0, 0, '1', 'Y');
INSERT INTO `meeting_list` VALUES (2, '2013-02-08', '2013-02-08', '08:00:00', '16:00:00', 2, 1, 'ทดสอบการจองห้อง ครั้งที่สอง', 30, 1, 'N', 'Y', 'Y', 'Y', 2, 2, '1', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `meeting_room`
-- 

CREATE TABLE `meeting_room` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `status` varchar(1) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `meeting_room`
-- 

INSERT INTO `meeting_room` VALUES (1, 'ห้องประชุมใหญ่', 'Y');
INSERT INTO `meeting_room` VALUES (2, 'ห้องประชุมกลาง', 'Y');
INSERT INTO `meeting_room` VALUES (3, 'ห้องประชุมเล็ก', 'Y');

-- --------------------------------------------------------

-- 
-- Table structure for table `meeting_room_type`
-- 

CREATE TABLE `meeting_room_type` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `meeting_room_type`
-- 

INSERT INTO `meeting_room_type` VALUES (1, 'ประชุม');
INSERT INTO `meeting_room_type` VALUES (2, 'อบรม');
INSERT INTO `meeting_room_type` VALUES (3, 'คณะศึกษาดูงาน');
INSERT INTO `meeting_room_type` VALUES (4, 'อื่นๆ');

-- --------------------------------------------------------

-- 
-- Table structure for table `member`
-- 

CREATE TABLE `member` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(15) collate utf8_unicode_ci NOT NULL,
  `password` varchar(15) collate utf8_unicode_ci NOT NULL,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `status` varchar(10) collate utf8_unicode_ci NOT NULL,
  `active` varchar(1) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `member`
-- 

INSERT INTO `member` VALUES (1, 'admin', 'admin', 'ผู้ดูแลระบบ', 'admin', 'Y');
