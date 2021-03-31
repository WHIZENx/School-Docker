-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 25, 2021 at 12:54 PM
-- Server version: 8.0.23
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` char(6) NOT NULL,
  `grade` char(1) DEFAULT NULL,
  `program` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `coursename` text,
  `credit` int NOT NULL,
  `teacherid` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `grade`, `program`, `coursename`, `credit`, `teacherid`) VALUES
('ค11101', '1', 'ภาคปกติ', 'คณิตศาสตร์ 1', 3, '10006'),
('ค12101', '2', 'ภาคปกติ', 'คณิตศาสตร์ 2', 3, '10006'),
('ง11101', '1', 'ภาคปกติ', 'การงานอาชีพและเทคโนโลยี 1', 3, '10004'),
('ง12101', '2', 'ภาคปกติ', 'การงานอาชีพและเทคโนโลยี 2', 3, '10004'),
('ท11101', '1', 'ภาคปกติ', 'ภาษาไทย 1', 3, '10002'),
('ท12101', '2', 'ภาคปกติ', 'ภาษาไทย 2', 3, '10002'),
('พ11101', '1', 'ภาคปกติ', 'สุขศึกษา และพลศึกษา 1', 1, '10005'),
('พ12101', '2', 'ภาคปกติ', 'สุขศึกษา และพลศึกษา 2', 1, '10005'),
('ว11101', '1', 'ภาคปกติ', 'วิทยาศาสตร์ 1', 3, '10001'),
('ว12101', '2', 'ภาคปกติ', 'วิทยาศาสตร์ 2', 3, '10001'),
('ศ11101', '1', 'ภาคปกติ', 'ศิลปะ 1', 3, '10007'),
('ศ12101', '2', 'ภาคปกติ', 'ศิลปะ 2', 3, '10007'),
('ส11101', '1', 'ภาคปกติ', 'สังคมศึกษา ศาสนาและวัฒนธรรม 1', 3, '10003'),
('ส11102', '1', 'ภาคปกติ', 'ประวัติศาสตร์ 1', 3, '10003'),
('ส12101', '2', 'ภาคปกติ', 'สังคมศึกษา ศาสนาและวัฒนธรรม 2', 3, '10003'),
('ส12102', '2', 'ภาคปกติ', 'ประวัติศาสตร์ 2', 3, '10003'),
('อ11101', '1', 'ภาคปกติ', 'ภาษาอังกฤษ 1', 3, '10008'),
('อ12101', '2', 'ภาคปกติ', 'ภาษาอังกฤษ 2', 3, '10008');

-- --------------------------------------------------------

--
-- Table structure for table `detail_score`
--

CREATE TABLE `detail_score` (
  `scoreid` varchar(20) NOT NULL,
  `normal_score` int NOT NULL,
  `midterm_score` int NOT NULL,
  `final_score` int NOT NULL,
  `grade` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_score`
--

INSERT INTO `detail_score` (`scoreid`, `normal_score`, `midterm_score`, `final_score`, `grade`) VALUES
('2020_1_11112_ค11101', 50, 20, 10, '4.0'),
('2020_1_11113_ค11101', 40, 20, 5, '2.5'),
('2020_1_11114_ค11101', 50, 0, 0, '1.0'),
('2020_1_11112_ง11101', 50, 25, 25, '4.0'),
('2020_1_11113_ง11101', 30, 10, 10, '1.0'),
('2020_1_11114_ง11101', 50, 10, 1, '2.0'),
('2020_1_11112_ท11101', 50, 25, 25, '4.0'),
('2020_1_11113_ท11101', 40, 20, 10, '3.0'),
('2020_1_11114_ท11101', 0, 0, 0, '0.0'),
('2020_1_11112_พ11101', 0, 0, 0, '0.0'),
('2020_1_11113_พ11101', 0, 0, 0, ''),
('2020_1_11114_พ11101', 0, 0, 0, ''),
('2020_1_11111_ค11101', 50, 25, 4, '3.5'),
('2020_1_11112_ส11102', 50, 25, 25, '4.0'),
('2020_1_11113_ส11102', 30, 10, 10, '1.0'),
('2020_1_11114_ส11102', 0, 0, 0, ''),
('2020_1_11112_อ11101', 20, 25, 10, '1.5'),
('2020_1_11113_อ11101', 30, 5, 10, '0.0'),
('2020_1_11114_อ11101', 0, 0, 0, ''),
('2020_1_11113_ว11101', 0, 0, 0, ''),
('2020_1_11114_ว11101', 0, 0, 0, ''),
('2020_1_11112_พ12101', 4, 0, 0, ''),
('2020_1_11113_พ12101', 0, 0, 0, ''),
('2020_1_11114_พ12101', 0, 0, 0, ''),
('2020_1_11112_ค12101', 5, 10, 20, '1.0'),
('2020_1_11113_ค12101', 0, 0, 0, ''),
('2020_1_11114_ค12101', 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `grade_c`
--

CREATE TABLE `grade_c` (
  `GradeNo` char(1) NOT NULL,
  `studentID` char(5) NOT NULL,
  `RoomNumber` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grade_c`
--

INSERT INTO `grade_c` (`GradeNo`, `studentID`, `RoomNumber`) VALUES
('3', '11111', '5'),
('1', '11112', '1'),
('1', '11113', '1'),
('1', '11114', '1'),
('4', '11115', '4'),
('2', '11116', '2');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` varchar(20) NOT NULL,
  `SemesterNo` char(1) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `gradeno` char(1) NOT NULL,
  `roomname` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `SemesterNo`, `Year`, `gradeno`, `roomname`) VALUES
('2020_1_1_1', '1', '2020', '1', '1'),
('2020_1_2_1', '1', '2020', '2', '1'),
('2020_1_3_5', '1', '2020', '3', '5');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_detail`
--

CREATE TABLE `schedule_detail` (
  `idschedule` varchar(20) NOT NULL,
  `timeno` char(1) NOT NULL,
  `dayno` char(1) NOT NULL,
  `courseid` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule_detail`
--

INSERT INTO `schedule_detail` (`idschedule`, `timeno`, `dayno`, `courseid`) VALUES
('2020_1_1_1', '1', '1', 'ค12101'),
('2020_1_1_1', '2', '1', 'ท11101'),
('2020_1_1_1', '3', '1', 'ค11101'),
('2020_1_1_1', '4', '1', 'พ11101'),
('2020_1_1_1', '5', '1', 'พ12101'),
('2020_1_1_1', '6', '1', 'ส11102'),
('2020_1_1_1', '1', '2', 'ส11101'),
('2020_1_1_1', '2', '2', 'ค12101'),
('2020_1_1_1', '3', '2', 'ส12101'),
('2020_1_1_1', '4', '2', 'ง12101'),
('2020_1_1_1', '5', '2', 'ส11101'),
('2020_1_1_1', '6', '2', 'ง12101'),
('2020_1_1_1', '1', '3', 'ค11101'),
('2020_1_1_1', '2', '3', 'ส11102'),
('2020_1_1_1', '3', '3', 'ว11101'),
('2020_1_1_1', '4', '3', 'ส12102'),
('2020_1_1_1', '5', '3', 'ง11101'),
('2020_1_1_1', '6', '3', 'ส11102'),
('2020_1_1_1', '1', '4', 'ท12101'),
('2020_1_1_1', '2', '4', 'ส12102'),
('2020_1_1_1', '3', '4', 'ค12101'),
('2020_1_1_1', '4', '4', 'พ11101'),
('2020_1_1_1', '5', '4', 'ส12102'),
('2020_1_1_1', '6', '4', 'ศ12101'),
('2020_1_1_1', '1', '5', 'ส12101'),
('2020_1_1_1', '2', '5', 'ว11101'),
('2020_1_1_1', '3', '5', 'ศ11101'),
('2020_1_1_1', '4', '5', 'อ11101'),
('2020_1_1_1', '5', '5', 'อ11101'),
('2020_1_1_1', '6', '5', 'อ12101'),
('2020_1_3_5', '1', '1', 'ท11101'),
('2020_1_3_5', '2', '1', 'ง12101'),
('2020_1_3_5', '3', '1', 'ส11102'),
('2020_1_3_5', '4', '1', 'ส12102'),
('2020_1_3_5', '5', '1', 'อ11101'),
('2020_1_3_5', '6', '1', 'ค11101'),
('2020_1_3_5', '1', '2', 'ค12101'),
('2020_1_3_5', '2', '2', 'พ11101'),
('2020_1_3_5', '3', '2', 'ว11101'),
('2020_1_3_5', '4', '2', 'ส11101'),
('2020_1_3_5', '5', '2', 'พ12101'),
('2020_1_3_5', '6', '2', 'ศ12101'),
('2020_1_3_5', '1', '3', 'ว11101'),
('2020_1_3_5', '2', '3', 'ศ11101'),
('2020_1_3_5', '3', '3', 'ส11101'),
('2020_1_3_5', '4', '3', 'ส11102'),
('2020_1_3_5', '5', '3', 'ส12101'),
('2020_1_3_5', '6', '3', 'ส11102'),
('2020_1_3_5', '1', '4', 'ส12102'),
('2020_1_3_5', '2', '4', 'อ11101'),
('2020_1_3_5', '3', '4', 'ค11101'),
('2020_1_3_5', '4', '4', 'ค11101'),
('2020_1_3_5', '5', '4', 'ค12101'),
('2020_1_3_5', '6', '4', 'ค12101'),
('2020_1_3_5', '1', '5', 'ส11102'),
('2020_1_3_5', '2', '5', 'ว12101'),
('2020_1_3_5', '3', '5', 'พ12101'),
('2020_1_3_5', '4', '5', 'ว11101'),
('2020_1_3_5', '5', '5', 'ส12101'),
('2020_1_3_5', '6', '5', 'พ12101'),
('2020_1_2_1', '1', '1', 'ท12101'),
('2020_1_2_1', '2', '1', 'พ11101'),
('2020_1_2_1', '3', '1', 'ว11101'),
('2020_1_2_1', '4', '1', 'ว11101'),
('2020_1_2_1', '5', '1', 'พ12101'),
('2020_1_2_1', '6', '1', 'ว12101'),
('2020_1_2_1', '1', '2', 'ว11101'),
('2020_1_2_1', '2', '2', 'ท11101'),
('2020_1_2_1', '3', '2', 'ศ12101'),
('2020_1_2_1', '4', '2', 'ง12101'),
('2020_1_2_1', '5', '2', 'ส11102'),
('2020_1_2_1', '6', '2', 'ส11102'),
('2020_1_2_1', '1', '3', 'ศ12101'),
('2020_1_2_1', '2', '3', 'ศ11101'),
('2020_1_2_1', '3', '3', 'ท12101'),
('2020_1_2_1', '4', '3', 'ส11102'),
('2020_1_2_1', '5', '3', 'ส11102'),
('2020_1_2_1', '6', '3', 'ส12101'),
('2020_1_2_1', '1', '4', 'ท11101'),
('2020_1_2_1', '2', '4', 'อ11101'),
('2020_1_2_1', '3', '4', 'ว12101'),
('2020_1_2_1', '4', '4', 'ส12101'),
('2020_1_2_1', '5', '4', 'ว12101'),
('2020_1_2_1', '6', '4', 'ส11102'),
('2020_1_2_1', '1', '5', 'อ11101'),
('2020_1_2_1', '2', '5', 'ส11101'),
('2020_1_2_1', '3', '5', 'ท12101'),
('2020_1_2_1', '4', '5', 'ส11102'),
('2020_1_2_1', '5', '5', 'ท11101'),
('2020_1_2_1', '6', '5', 'ศ11101');

-- --------------------------------------------------------

--
-- Table structure for table `score`
--

CREATE TABLE `score` (
  `scoreid` varchar(20) NOT NULL,
  `studentid` char(5) NOT NULL,
  `courseid` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `score`
--

INSERT INTO `score` (`scoreid`, `studentid`, `courseid`) VALUES
('2020_1_11111_ค11101', '11111', 'ค11101'),
('2020_1_11112_ค11101', '11112', 'ค11101'),
('2020_1_11112_ค12101', '11112', 'ค12101'),
('2020_1_11112_ง11101', '11112', 'ง11101'),
('2020_1_11112_ท11101', '11112', 'ท11101'),
('2020_1_11112_พ11101', '11112', 'พ11101'),
('2020_1_11112_พ12101', '11112', 'พ12101'),
('2020_1_11112_ว11101', '11112', 'ว11101'),
('2020_1_11112_ส11102', '11112', 'ส11102'),
('2020_1_11112_อ11101', '11112', 'อ11101'),
('2020_1_11113_ค11101', '11113', 'ค11101'),
('2020_1_11113_ค12101', '11113', 'ค12101'),
('2020_1_11113_ง11101', '11113', 'ง11101'),
('2020_1_11113_ท11101', '11113', 'ท11101'),
('2020_1_11113_พ11101', '11113', 'พ11101'),
('2020_1_11113_พ12101', '11113', 'พ12101'),
('2020_1_11113_ว11101', '11113', 'ว11101'),
('2020_1_11113_ส11102', '11113', 'ส11102'),
('2020_1_11113_อ11101', '11113', 'อ11101'),
('2020_1_11114_ค11101', '11114', 'ค11101'),
('2020_1_11114_ค12101', '11114', 'ค12101'),
('2020_1_11114_ง11101', '11114', 'ง11101'),
('2020_1_11114_ท11101', '11114', 'ท11101'),
('2020_1_11114_พ11101', '11114', 'พ11101'),
('2020_1_11114_พ12101', '11114', 'พ12101'),
('2020_1_11114_ว11101', '11114', 'ว11101'),
('2020_1_11114_ส11102', '11114', 'ส11102'),
('2020_1_11114_อ11101', '11114', 'อ11101');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `SemID` varchar(5) NOT NULL,
  `SemesterNo` char(1) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `Year` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`SemID`, `SemesterNo`, `Year`) VALUES
('20201', '1', '2020'),
('20202', '2', '2020'),
('20211', '1', '2021'),
('20212', '2', '2021');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `username` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`username`, `password`) VALUES
('s1234', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` char(5) NOT NULL,
  `ntitle` text NOT NULL,
  `stdfname` text NOT NULL,
  `stdlname` text NOT NULL,
  `address` text NOT NULL,
  `birthday` date NOT NULL,
  `phone` text NOT NULL,
  `pname` text NOT NULL,
  `pphone` text NOT NULL,
  `disease` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `start_year` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `ntitle`, `stdfname`, `stdlname`, `address`, `birthday`, `phone`, `pname`, `pphone`, `disease`, `start_year`, `status`) VALUES
('11111', 'เด็กชาย', 'สรายุธ', 'สุขใจ', 'ต.บ้านเปิง อ.หางดง จ.ลำพูน 50000', '2004-10-19', '0823152486', 'นายจิรศักดิ์ สุขใจ', '0862143025', 'โรคหัวใจ', '2018', 'Active'),
('11112', 'เด็กชาย', 'วิรุษ', 'หงศ์พักดี', 'ต.สันผักหวาน อ.สันปูเลือย จ.เชียงใหม่ 50000', '2005-10-14', '0850123648', 'นายพลูไทย หงศ์พักดี', '063254189', NULL, '2018', 'Active'),
('11113', 'เด็กชาย', 'นิติ', 'มามีสุข', 'ต.หนองป่า อ.เมือง จ.กรุงเทพ 50020', '2020-10-06', '0963254162', 'นายวิรุษ มามีสุข', '0750216325', NULL, '2018', 'Active'),
('11114', 'เด็กชาย', 'ณัฐนุช', 'อุตราศาสตร์', 'ต.ไตรมาทย์ อ.สุขสม จ.เลย 12030', '2005-10-07', '0864521523', 'นางสามสุธิมา อุตราศาสตร์', '084652136', NULL, '2018', 'Active'),
('11115', 'เด็กหญิง', 'วิรุดิษา', 'นามวงศ์', 'ต.แม่สาย อ.แม่ริม จ.เชียงใหม่ 50100', '2002-06-12', '0855423165', 'นายวิราษ นามวงศ์', '0854123655', NULL, '2018', 'Active'),
('11116', 'เด็กชาย', 'นายก', 'สามารถ', 'ต.แม่แตง อ.แม่ริม จ.เชียงใหม่ 50100', '2020-10-09', '0123456789', 'นายมา', '0123456789', NULL, '2018', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherid` char(5) NOT NULL,
  `password` varchar(60) NOT NULL,
  `Tfname` text NOT NULL,
  `Tlname` text NOT NULL,
  `BDate` date NOT NULL,
  `title` text NOT NULL,
  `start_work` date NOT NULL,
  `email` text,
  `address` text,
  `groupc` text NOT NULL,
  `disease` text,
  `phone` varchar(10) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherid`, `password`, `Tfname`, `Tlname`, `BDate`, `title`, `start_work`, `email`, `address`, `groupc`, `disease`, `phone`, `status`) VALUES
('10001', '$2y$10$WZUFbFq74mvTcijLSMdPSeD/OnCQ4rW1eS0fmO3fIR5f9IkDIYgPy', 'วิจักร', 'อังอาชา', '1992-10-29', 'นาย', '2018-10-10', 'vijak_ungasha1992@gmail.com', '111 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'วิทยาศาสตร์', NULL, '0992858442', 'Active'),
('10002', '$2y$10$T.XG7x/RV9IjXm0Lij7rdOpNCdq.2RuUqJ5ps0fZ0OtIro0u0U8TO', 'ขณิฌา', 'พาสุข', '1992-07-10', 'นางสาว', '2018-11-01', 'kanicha_pasuk1992@gmail.com', '112 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'ภาษาไทย', NULL, '0995958442', 'Active'),
('10003', '$2y$10$LB9jXLrxb1hqL9aW.kYQ7uAFkGDFaci5qlH4rHTc./VIG9dnySDfm', 'กชกร', 'แซ่มี', '1987-05-27', 'นาย', '2018-12-10', 'kochakorn_saemee1987@gmail.com', '113 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'สังคมศึกษา ศาสนาและวัฒนธรรม', NULL, '0992851991', 'Active'),
('10004', '$2y$10$RMFcAYWdxsjlUBcUFh3urOHIr3CIhwveJaqZUsuFFKYRoRQLVna6m', 'ชนสร', 'พรประดับ', '1990-07-07', 'นางสาว', '2019-01-05', 'chanasorn_pornpradub1990@gmail.com', '114 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'การงานอาชีพและเทคโนโลยี', NULL, '0991918442', 'Active'),
('10005', '$2y$10$u8poM5/iXnxMxAZDemxDGOpbj4I3ytSuHrnWSknBvWuW5/3cZvc/G', 'ธนานนท์', 'คนใจดี', '1986-09-08', 'นาย', '2019-02-14', 'tananon_konjaidee1986@gmail.com', '115 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'สุขศึกษาและพลศึกษา', NULL, '0662858442', 'Active'),
('10006', '$2y$10$fMuq9rxZTGJSDpduAhOZcOMho9Z/mfp/2jfW03a1/VVCoyGuquOuC', 'นิพจน์', 'สิบลักษณ์', '1988-06-14', 'นาย', '2019-03-08', 'nipod_sibluc1988@gmail.com', '116 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'คณิตศาสตร์', NULL, '0882858442', 'Active'),
('10007', '$2y$10$le5GV9/T7vxcmOyt3rv0pO34L0Y4Q3spZRMuNB37ZRohQgHqFs.TC', 'สุพรรณ', 'จันทร์ทอง', '1993-10-29', 'นาย', '2019-04-26', 'supan_junthong1993@gmail.com', '117 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'ศิลปะ', NULL, '0832858442', 'Active'),
('10008', '$2y$10$S9.MgfaKzhSDsleCKX3DYerXmG/Xav2iK9QbYxgMMqJXmVfmX1hoq', 'กฤษณี', 'สีสุข', '1991-10-29', 'นางสาว', '2019-05-01', 'gissanee_srisuk1991@gmail.com', '118 ต.สุเทพ อ.เมืองเชียงใหม่ จ.เชียงใหม่ 50200', 'ภาษาอังกฤษ', NULL, '0632858442', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`),
  ADD KEY `grade` (`grade`),
  ADD KEY `teacherid` (`teacherid`);

--
-- Indexes for table `detail_score`
--
ALTER TABLE `detail_score`
  ADD KEY `scoreid` (`scoreid`);

--
-- Indexes for table `grade_c`
--
ALTER TABLE `grade_c`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `gradeno` (`gradeno`,`roomname`);

--
-- Indexes for table `schedule_detail`
--
ALTER TABLE `schedule_detail`
  ADD KEY `timeno` (`timeno`),
  ADD KEY `dayno` (`dayno`),
  ADD KEY `courseid` (`courseid`),
  ADD KEY `idschedule` (`idschedule`);

--
-- Indexes for table `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`scoreid`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`SemID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`username`(10));

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
