-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 03, 2020 at 09:37 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `command_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(30) NOT NULL,
  `Middle_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `Signature` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `ProfilePic` varchar(200) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `privileged_Status` varchar(30) NOT NULL,
  `Restriction` varchar(50) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administration`
--

INSERT INTO `administration` (`Sno`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Signature`, `Username`, `Email`, `Phone`, `Password`, `ProfilePic`, `Status`, `privileged_Status`, `Restriction`) VALUES
(10, 'KISOTECH', '', 'DIGITAL', 'Male', '', 'kwadoski', 'chikwadosearch@yahoo.com', '08068409402', 'chikwado', '', 'Super Administrator', 'None', 'Activated');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `classID` int(11) NOT NULL AUTO_INCREMENT,
  `className` varchar(30) NOT NULL,
  `FormTeacher` varchar(50) NOT NULL,
  PRIMARY KEY (`classID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `className`, `FormTeacher`) VALUES
(1, 'JSS 1', ' '),
(2, 'JSS 2', ' '),
(3, 'JSS 3', ' '),
(4, 'SSS 1', 'Taiwo166'),
(5, 'SSS 2', ' '),
(6, 'SSS 3', 'Jackson167'),
(7, 'GRADUATED STUDENT', ' '),
(10, 'SSS 3A', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `class_promotion`
--

DROP TABLE IF EXISTS `class_promotion`;
CREATE TABLE IF NOT EXISTS `class_promotion` (
  `Sno` int(50) NOT NULL AUTO_INCREMENT,
  `Promote_From` varchar(50) NOT NULL,
  `Promote_To` varchar(50) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_promotion`
--

INSERT INTO `class_promotion` (`Sno`, `Promote_From`, `Promote_To`) VALUES
(1, 'JSS 1', 'JSS 2'),
(2, 'JSS 2', 'JSS 3'),
(3, 'JSS 3', 'SSS 1'),
(4, 'SSS 1', 'SSS 2'),
(5, 'SSS 2', 'SSS 3'),
(6, 'SSS 3', 'GRADUATED STUDENT');

-- --------------------------------------------------------

--
-- Table structure for table `pinlogin`
--

DROP TABLE IF EXISTS `pinlogin`;
CREATE TABLE IF NOT EXISTS `pinlogin` (
  `serial` int(11) NOT NULL AUTO_INCREMENT,
  `PinCode` bigint(30) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `Class` varchar(30) NOT NULL,
  `Session` varchar(30) NOT NULL,
  `Term` varchar(30) NOT NULL,
  `LoginCount` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
CREATE TABLE IF NOT EXISTS `privileges` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `AdminUsername` varchar(30) NOT NULL,
  `StudentManagement` varchar(30) NOT NULL,
  `AddEditStudents` varchar(30) NOT NULL,
  `AdminManagement` varchar(30) NOT NULL,
  `ResultManagement` varchar(30) NOT NULL,
  `siteManagement` varchar(30) NOT NULL,
  `PinManagement` varchar(30) NOT NULL,
  `Settings` varchar(30) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privileges`
--

INSERT INTO `privileges` (`Sno`, `AdminUsername`, `StudentManagement`, `AddEditStudents`, `AdminManagement`, `ResultManagement`, `siteManagement`, `PinManagement`, `Settings`) VALUES
(1, 'kwadoski', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `registered_subjects`
--

DROP TABLE IF EXISTS `registered_subjects`;
CREATE TABLE IF NOT EXISTS `registered_subjects` (
  `SerialNo` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(30) NOT NULL,
  `subjectID` varchar(30) NOT NULL,
  `StudentID` varchar(30) NOT NULL,
  `StudentReg` varchar(50) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `School` varchar(50) NOT NULL,
  `current_class` varchar(50) NOT NULL,
  PRIMARY KEY (`SerialNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

DROP TABLE IF EXISTS `remark`;
CREATE TABLE IF NOT EXISTS `remark` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `remark` varchar(200) NOT NULL,
  `StudentID` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `term` varchar(11) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(30) NOT NULL,
  `StudentReg` varchar(50) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `subjectID` int(30) NOT NULL,
  `school_session` varchar(30) NOT NULL,
  `Term` varchar(30) NOT NULL,
  `class` varchar(30) NOT NULL,
  `CA1` int(30) NOT NULL,
  `CA2` int(30) NOT NULL,
  `CA3` int(30) NOT NULL,
  `Exam` int(30) NOT NULL,
  `Total` int(30) NOT NULL,
  `Average` decimal(5,2) NOT NULL,
  `Grade` varchar(30) NOT NULL,
  `Remark` varchar(50) NOT NULL,
  `Teacher` varchar(30) NOT NULL,
  `Publish` varchar(30) NOT NULL,
  `Promotion_Status` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Sno`),
  KEY `Promotion_Status_4` (`Promotion_Status`),
  KEY `Promotion_Status_5` (`Promotion_Status`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result_marks`
--

DROP TABLE IF EXISTS `result_marks`;
CREATE TABLE IF NOT EXISTS `result_marks` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `School` varchar(50) NOT NULL,
  `session` varchar(30) NOT NULL,
  `term` varchar(30) NOT NULL,
  `CA1` int(30) NOT NULL,
  `CA2` int(30) NOT NULL,
  `CA3` int(30) NOT NULL,
  `Exam` int(30) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_marks`
--

INSERT INTO `result_marks` (`Sno`, `School`, `session`, `term`, `CA1`, `CA2`, `CA3`, `Exam`) VALUES
(1, 'Senior Secondary School', '', '', 0, 0, 0, 0),
(2, 'Junior Secondary School', '', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resumption_date`
--

DROP TABLE IF EXISTS `resumption_date`;
CREATE TABLE IF NOT EXISTS `resumption_date` (
  `Sno` int(30) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `term` varchar(30) NOT NULL,
  `session` varchar(50) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_session`
--

DROP TABLE IF EXISTS `school_session`;
CREATE TABLE IF NOT EXISTS `school_session` (
  `sessionID` int(30) NOT NULL AUTO_INCREMENT,
  `sessionName` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  PRIMARY KEY (`sessionID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_session`
--

INSERT INTO `school_session` (`sessionID`, `sessionName`, `Status`) VALUES
(1, '2018/2019', ' '),
(2, '2019/2020', 'Current'),
(3, '2020/2021', ' '),
(4, '2021/2022', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `sitemanager`
--

DROP TABLE IF EXISTS `sitemanager`;
CREATE TABLE IF NOT EXISTS `sitemanager` (
  `Id` int(30) NOT NULL AUTO_INCREMENT,
  `tag` varchar(50) NOT NULL,
  `Content` varchar(300) NOT NULL,
  `content_for_integer` int(30) NOT NULL,
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sitemanager`
--

INSERT INTO `sitemanager` (`Id`, `tag`, `Content`, `content_for_integer`, `link`) VALUES
(1, 'Front_Page_Background', '1603228792_1599260747_bg.jpg', 0, ''),
(2, 'Heading', 'Check Result', 0, ''),
(3, 'Annoucement', '', 0, ''),
(9, 'Student_Login', 'Activated', 0, ''),
(4, 'school_logo', '1605650144_first-logo.png', 0, ''),
(8, 'favicon', '1605423059_Screenshot_1.png', 0, ''),
(5, 'school_stamp', '1605651875_login.png', 0, ''),
(6, 'principal_remark', 'What a wonder Term!!!!!!', 0, ''),
(7, 'resumption_date', '22/09/2022', 0, ''),
(10, 'pin_number_of_times', '', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `sporthouse`
--

DROP TABLE IF EXISTS `sporthouse`;
CREATE TABLE IF NOT EXISTS `sporthouse` (
  `houseID` int(30) NOT NULL AUTO_INCREMENT,
  `houseName` varchar(50) NOT NULL,
  PRIMARY KEY (`houseID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sporthouse`
--

INSERT INTO `sporthouse` (`houseID`, `houseName`) VALUES
(1, 'Green'),
(3, 'Yellow'),
(4, 'Blue'),
(5, 'Red'),
(14, 'Pink');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(30) NOT NULL,
  `MiddleName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Class` varchar(30) NOT NULL,
  `session` varchar(30) NOT NULL,
  `Term` varchar(30) NOT NULL,
  `SportHouse` varchar(30) NOT NULL,
  `ProfilePic` varchar(200) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `DOB` varchar(30) NOT NULL,
  `RegNum` varchar(100) NOT NULL,
  `State_Of_Origin` varchar(30) NOT NULL,
  `LGA` varchar(50) NOT NULL,
  `Phone` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Address` text NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `subjectID` int(11) NOT NULL AUTO_INCREMENT,
  `subjectName` varchar(30) NOT NULL,
  PRIMARY KEY (`subjectID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectID`, `subjectName`) VALUES
(1, 'Civic Education'),
(2, 'Igbo'),
(3, 'English Language'),
(4, 'Mathematics'),
(5, 'Chemistry'),
(6, 'Chemistry Practicals'),
(7, 'Physics'),
(8, 'Physics Practicals'),
(9, 'Geography'),
(10, 'Computer Studies'),
(11, 'Biology'),
(12, 'Agricultural Science'),
(13, 'Biology Practical'),
(14, 'French Language');

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

DROP TABLE IF EXISTS `term`;
CREATE TABLE IF NOT EXISTS `term` (
  `Sno` int(11) NOT NULL AUTO_INCREMENT,
  `Term` varchar(30) NOT NULL,
  `Status` varchar(30) NOT NULL,
  PRIMARY KEY (`Sno`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`Sno`, `Term`, `Status`) VALUES
(1, 'First', ' '),
(2, 'Second', ' '),
(3, 'Third', 'Current'),
(4, 'Annual Result', 'Activated');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results` ADD FULLTEXT KEY `Promotion_Status` (`Promotion_Status`);
ALTER TABLE `results` ADD FULLTEXT KEY `Promotion_Status_2` (`Promotion_Status`);
ALTER TABLE `results` ADD FULLTEXT KEY `Promotion_Status_3` (`Promotion_Status`);
ALTER TABLE `results` ADD FULLTEXT KEY `Promotion_Status_6` (`Promotion_Status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
