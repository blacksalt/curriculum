-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 26, 2011 at 11:53 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `curriculum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `salt`) VALUES
(4, 'admin', 'dc6e70e46f0b34249f53140b9f5f56a5173018f5', '998885173bbf185b96bd1192993241a54bf67f39');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE IF NOT EXISTS `college` (
  `college_id` int(11) NOT NULL AUTO_INCREMENT,
  `college_name` varchar(50) NOT NULL,
  PRIMARY KEY (`college_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`) VALUES
(1, 'College of Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(20) NOT NULL,
  `college_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `college_id`) VALUES
(1, 'BS Computer Science', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prereq`
--

CREATE TABLE IF NOT EXISTS `prereq` (
  `parent` int(11) NOT NULL,
  `prereq` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prereq`
--

INSERT INTO `prereq` (`parent`, `prereq`) VALUES
(10, 4),
(11, 5),
(15, 10),
(16, 12),
(17, 4),
(22, 15),
(24, 11),
(23, 10),
(23, 17);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(50) NOT NULL,
  `units` int(11) NOT NULL,
  `sem` varchar(6) NOT NULL,
  `var` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `course_id`, `alias`, `name`, `details`, `units`, `sem`, `var`) VALUES
(1, 1, 'GE1', 'GE1 (AH Comm in Eng)', '', 3, 'sem1-1', 1),
(2, 1, 'GE2', 'GE2 (MST)', '', 3, 'sem1-1', 1),
(3, 1, 'GE3', 'GE 3 (SSP)', '', 3, 'sem1-1', 1),
(4, 1, 'MATH17', 'Math 17', 'Algebra and Trigonometry', 5, 'sem1-1', 0),
(5, 1, 'CS11', 'CS 11', 'Computer Programming 1', 3, 'sem1-1', 0),
(6, 1, 'PE1', 'PE', '', 2, 'sem1-1', 1),
(7, 1, 'GE4', 'GE4 (AH Comm in Eng)', '', 3, 'sem1-2', 1),
(8, 1, 'GE5', 'GE5 (MST)', '', 3, 'sem1-2', 1),
(9, 1, 'GE6', 'GE6 (SSP Philo/Logical Analysis)', '', 3, 'sem1-2', 1),
(10, 1, 'MATH53', 'Math 53', 'Elementary Analysis 1', 5, 'sem1-2', 0),
(11, 1, 'CS12', 'CS 12', 'Computer Programming 2', 3, 'sem1-2', 0),
(12, 1, 'PE2', 'PE', '', 2, 'sem1-2', 1),
(13, 1, 'GE7', 'GE7 (AH Comm in Eng)', '', 3, 'sem2-1', 1),
(14, 1, 'GE8', 'GE 8 (SSP)', '', 3, 'sem2-1', 1),
(15, 1, 'MATH54', 'Math 54', 'Elementary Analysis 2', 5, 'sem2-1', 0),
(16, 1, 'CS21', 'CS 21', 'Assembly Language and Computer Organization', 3, 'sem2-1', 0),
(17, 1, 'PHYSICS71', 'Physics 71', 'Elementary Physics 1', 4, 'sem2-1', 0),
(18, 1, 'PE3', 'PE', '', 2, 'sem2-1', 1),
(19, 1, 'NSTP1', 'NSTP 1', '', 3, 'sem2-1', 1),
(20, 1, 'GE9', 'GE 9 (MST)', '', 3, 'sem2-2', 1),
(21, 1, 'GE10', 'GE 10 (SSP)', '', 3, 'sem2-2', 1),
(22, 1, 'MATH55', 'Math 55', 'Elementary Analysis 3', 3, 'sem2-2', 0),
(23, 1, 'MATH157', 'Math 157', 'Discreet Math for CS', 3, 'sem2-2', 0),
(24, 1, 'CS32', 'CS 32', 'Algorithms and Data Structures', 3, 'sem2-2', 0),
(25, 1, 'PHYSICS72', 'Physics 72', 'Elementary Physics 2', 4, 'sem2-2', 0),
(26, 1, 'PE4', 'PE', '', 2, 'sem2-2', 1),
(27, 1, 'NSTP2', 'NSTP 2', '', 3, 'sem2-2', 1);

