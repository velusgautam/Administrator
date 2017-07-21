-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2014 at 02:19 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `administrator`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_application_form`
--

DROP TABLE IF EXISTS `admin_application_form`;
CREATE TABLE IF NOT EXISTS `admin_application_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_code` int(5) NOT NULL,
  `admin_no` varchar(10) NOT NULL,
  `admission_date` date NOT NULL,
  `academic_year` varchar(25) NOT NULL,
  `name` varchar(15) NOT NULL,
  `nationality` varchar(15) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `placeofbirth` varchar(15) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `caste` varchar(15) NOT NULL,
  `mothertongue` varchar(15) NOT NULL,
  `whethersct` varchar(15) NOT NULL,
  `talukdist` varchar(15) NOT NULL,
  `father_name` varchar(15) NOT NULL,
  `father_qualification` varchar(15) NOT NULL,
  `father_occupation` varchar(15) NOT NULL,
  `mother_name` varchar(15) NOT NULL,
  `mother_qualification` varchar(15) NOT NULL,
  `mother_occupation` varchar(15) NOT NULL,
  `noofbro` varchar(15) NOT NULL,
  `noofsis` varchar(15) NOT NULL,
  `standard_leaving` varchar(15) NOT NULL,
  `prev_school` text NOT NULL,
  `tcdate` varchar(15) NOT NULL,
  `annual_income` varchar(15) NOT NULL,
  `permanent_address` text NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `resi_no` varchar(15) NOT NULL,
  `office_no` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `admin_application_form`
--

INSERT INTO `admin_application_form` (`id`, `school_code`, `admin_no`, `admission_date`, `academic_year`, `name`, `nationality`, `gender`, `dob`, `placeofbirth`, `religion`, `caste`, `mothertongue`, `whethersct`, `talukdist`, `father_name`, `father_qualification`, `father_occupation`, `mother_name`, `mother_qualification`, `mother_occupation`, `noofbro`, `noofsis`, `standard_leaving`, `prev_school`, `tcdate`, `annual_income`, `permanent_address`, `mobile_no`, `resi_no`, `office_no`, `email`) VALUES
(10, 5, '2121', '2014-06-11', '2015-2016', 'Neeraj', 'Indian', 'Male', '0000-00-00', 'Bangalore', '', '', 'Malayalam', 'No', 'bangalore', 'Sasi', 'Engineer', 'Software Engine', '', 'Engineer', 'Software Engine', '21', '21', '10', 'English', '12/12/2012', '1000000', 'Bangalore, Kollam', '919898998988', '98989898989', '889898', 'kansdkasnkd@aknkas.com'),
(11, 5, '2121', '2014-06-11', '2014-2015', 'Velu', 'Indian', 'Male', '2014-06-18', 'Bangalore', 'Hindu', 'Ezhava', 'Malayalam', 'No', 'Bangalore', 'Subra', 'Engineer', 'Software Engine', 'Sasikala', 'Engineer', 'Software Engine', '21', '21', 'PRE KG', 'English', '12/12/2012', '1000000', 'Bangalore, Kollam', '91989899898', '98989898989', '889898', 'kansdkasnkd@aknkas.com');

-- --------------------------------------------------------

--
-- Table structure for table `admin_class`
--

DROP TABLE IF EXISTS `admin_class`;
CREATE TABLE IF NOT EXISTS `admin_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin_class`
--

INSERT INTO `admin_class` (`class_id`, `class_name`, `status`) VALUES
(1, 'PRE KG', 0),
(2, 'KG', 0),
(3, 'UKG', 0),
(4, 'CLASS I', 0),
(5, 'CLASS II', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_class_mapping`
--

DROP TABLE IF EXISTS `admin_class_mapping`;
CREATE TABLE IF NOT EXISTS `admin_class_mapping` (
  `class_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `division_id` int(5) NOT NULL,
  `stream_id` int(5) NOT NULL COMMENT '1:ICSE 2:STATE',
  `schl_id` int(11) NOT NULL,
  PRIMARY KEY (`class_map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `admin_class_mapping`
--

INSERT INTO `admin_class_mapping` (`class_map_id`, `class_id`, `division_id`, `stream_id`, `schl_id`) VALUES
(38, 1, 1, 1, 5),
(39, 1, 4, 1, 5),
(40, 3, 1, 1, 5),
(41, 3, 1, 2, 5),
(42, 4, 1, 2, 5),
(43, 1, 1, 1, 6),
(92, 1, 1, 1, 2),
(93, 1, 2, 1, 2),
(112, 1, 4, 1, 8),
(113, 1, 1, 2, 8),
(114, 1, 4, 2, 8),
(115, 2, 2, 1, 8),
(116, 2, 4, 1, 8),
(117, 2, 1, 2, 8),
(118, 3, 1, 1, 8),
(119, 3, 4, 2, 8),
(120, 1, 1, 1, 3),
(121, 1, 2, 1, 3),
(122, 1, 1, 2, 3),
(123, 1, 2, 2, 3),
(124, 2, 1, 1, 3),
(125, 2, 2, 1, 3),
(126, 2, 1, 2, 3),
(127, 2, 2, 2, 3),
(128, 3, 1, 1, 3),
(129, 3, 2, 1, 3),
(130, 4, 1, 1, 3),
(131, 4, 2, 1, 3),
(132, 5, 1, 1, 3),
(133, 5, 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `admin_db_backup`
--

DROP TABLE IF EXISTS `admin_db_backup`;
CREATE TABLE IF NOT EXISTS `admin_db_backup` (
  `backup_id` int(11) NOT NULL AUTO_INCREMENT,
  `backup_name` varchar(250) NOT NULL,
  `backup_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`backup_id`),
  UNIQUE KEY `backup_name` (`backup_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `admin_db_backup`
--

INSERT INTO `admin_db_backup` (`backup_id`, `backup_name`, `backup_time`) VALUES
(7, 'db-backup--01-07-2014sql', '2014-07-02 01:13:37'),
(12, 'db-backup--01-07-2014.sql', '2014-07-02 01:17:06'),
(13, 'db-backup--06-07-2014.sql', '2014-07-06 17:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `admin_division`
--

DROP TABLE IF EXISTS `admin_division`;
CREATE TABLE IF NOT EXISTS `admin_division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `division_name` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin_division`
--

INSERT INTO `admin_division` (`division_id`, `division_name`, `status`) VALUES
(1, 'A', 0),
(2, 'B', 0),
(3, 'C', 0),
(4, 'D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_fees`
--

DROP TABLE IF EXISTS `admin_fees`;
CREATE TABLE IF NOT EXISTS `admin_fees` (
  `fee_id` int(11) NOT NULL AUTO_INCREMENT,
  `fee_name` varchar(150) NOT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY (`fee_id`),
  UNIQUE KEY `fee_id` (`fee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin_fees`
--

INSERT INTO `admin_fees` (`fee_id`, `fee_name`, `status`) VALUES
(1, 'TUITION FEE', 0),
(2, 'COMPUTER FEE', 0),
(3, 'EXAM FEE', 0),
(4, 'SMART CLASS', 0),
(5, 'HOBBY CLASS', 0),
(6, 'ALUMNI FEES', 0),
(7, 'FEE RECEIPT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_fee_mapping`
--

DROP TABLE IF EXISTS `admin_fee_mapping`;
CREATE TABLE IF NOT EXISTS `admin_fee_mapping` (
  `fee_map_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(5) NOT NULL,
  `fee_id` int(4) NOT NULL,
  `fee_amount` varchar(5) NOT NULL,
  `schl_id` int(4) NOT NULL,
  PRIMARY KEY (`fee_map_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Table For Fee School Setting' AUTO_INCREMENT=100 ;

--
-- Dumping data for table `admin_fee_mapping`
--

INSERT INTO `admin_fee_mapping` (`fee_map_id`, `class_id`, `fee_id`, `fee_amount`, `schl_id`) VALUES
(66, 1, 1, '150', 3),
(67, 1, 2, '200', 3),
(90, 1, 1, '300', 5),
(91, 1, 2, '400', 5),
(92, 1, 3, '500', 5),
(93, 1, 4, '200', 5),
(94, 1, 5, '600', 5),
(95, 1, 6, '800', 5),
(96, 1, 7, '10', 5),
(97, 2, 1, '300', 5),
(98, 2, 2, '600', 5),
(99, 2, 3, '700', 5);

-- --------------------------------------------------------

--
-- Table structure for table `admin_school`
--

DROP TABLE IF EXISTS `admin_school`;
CREATE TABLE IF NOT EXISTS `admin_school` (
  `schl_id` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(200) NOT NULL,
  `school_code` varchar(20) NOT NULL,
  `school_address` text NOT NULL,
  `published` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`schl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `admin_school`
--

INSERT INTO `admin_school` (`schl_id`, `school_name`, `school_code`, `school_address`, `published`) VALUES
(1, 'St Marks Public School', 'SMPS', 'No. 37, 1st Main, 3rd Phase, JP Nagar, Bangalore - 560078', 1),
(2, 'Sai Vidya Kendra', 'SVK', 'No. 724, 18th Main, 38th Cross, 4th T Block, Jayanagar, Bangalore - 560041', 1),
(3, 'Diana Memorial High School', 'DMHS', 'No. 45/46, 4th Main, Vijaya Layout, Arakere, Bangalore - 560076', 1),
(4, 'Little Millennium - Vijaya Bank Layout', 'LMVBL', '#993, D.C. Halli Main Road, MSRS Nagar, Vijaya Bank Layout, Bangalore - 560076', 1),
(5, 'Little Millennium - Bilekahalli', 'LMBLK', 'A5, Ranka Villa, Ranka Colony, Bilekahalli, Bangalore - 560076', 1),
(6, 'Little Millennium - Hulimavu', 'LMHUL', 'SOS Childrens Villages of India, SOS Post, Doddakammanahalli Main Road, Hulimavu, Bangalore - 560076', 1),
(7, 'Mothers Touch - Vijaya Bank Layout', 'MTVBL', '#993, D.C. Halli Main Road, MSRS Nagar, Vijaya Bank Layout, Bangalore - 560076', 1),
(8, 'Mothers Touch - Bilekahalli', 'MTBLK', 'A5, Ranka Villa, Ranka Colony Road, Bilekahalli, Bangalore - 560076', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_student`
--

DROP TABLE IF EXISTS `admin_student`;
CREATE TABLE IF NOT EXISTS `admin_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `schl_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `stream_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `student_name` varchar(300) NOT NULL,
  `transfer_tc` int(11) NOT NULL,
  `transfer_mc` int(11) NOT NULL,
  `transfer_cc` int(11) NOT NULL,
  `fresh_bc` int(11) NOT NULL,
  `fresh_cc` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `registered_by` varchar(200) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `admin_student`
--

INSERT INTO `admin_student` (`student_id`, `application_id`, `schl_id`, `date`, `academic_year`, `stream_id`, `class_id`, `division_id`, `student_name`, `transfer_tc`, `transfer_mc`, `transfer_cc`, `fresh_bc`, `fresh_cc`, `status`, `registered_by`) VALUES
(10, 10, 5, '2014-07-01 00:00:00', '2015-2016', 1, 1, 1, 'NEERAJ', 0, 0, 0, 0, 0, 1, 'swaroop'),
(11, 10, 5, '2014-07-01 00:00:00', '2015-2016', 1, 1, 1, 'NEERAJ', 1, 1, 1, 0, 0, 1, 'swaroop');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `schl_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `login` datetime NOT NULL,
  `logout` datetime NOT NULL,
  `date` date NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`uid`, `name`, `username`, `password`, `schl_id`, `role_name`, `role_id`, `login`, `logout`, `date`, `phone_number`) VALUES
(1, 'Gautam', 'wixziAdmin', 'e6e061838856bf47e1de730719fb2609', -1, 'Administrator', 1, '2014-01-22 23:44:20', '2014-05-31 17:27:21', '0000-00-00', '919387879787'),
(22, 'Swaroop', 'swaroop', 'e6e061838856bf47e1de730719fb2609', -1, 'Administrator', 1, '2014-07-06 17:35:20', '2014-07-03 21:10:03', '2014-01-21', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
