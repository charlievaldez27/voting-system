-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2020 at 02:31 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ssc_voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(20) NOT NULL,
  `voters_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `voters_id`) VALUES
(1, 0),
(2, 0),
(3, 48),
(4, 49),
(5, 66);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addvoters`
--

CREATE TABLE `tbl_addvoters` (
  `uid` bigint(254) NOT NULL,
  `studentID` bigint(254) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(20) NOT NULL,
  `MI` varchar(1) NOT NULL,
  `Suffix` varchar(10) NOT NULL,
  `Level` varchar(20) NOT NULL,
  `Program` varchar(50) NOT NULL,
  `Gender` enum('Male','Female','Others','') NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `yearlevel` varchar(50) NOT NULL,
  `Status` enum('Enrolled','Not Enrolled','','') NOT NULL,
  `user_image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addvoters`
--

INSERT INTO `tbl_addvoters` (`uid`, `studentID`, `Firstname`, `Lastname`, `MI`, `Suffix`, `Level`, `Program`, `Gender`, `email`, `password`, `yearlevel`, `Status`, `user_image`) VALUES
(48, 30000000002, 'Charlie', 'Valdez', 'L', '', 'Tertiary', 'BSHM', 'Male', 'charlie@gmail.com', 'charlie3', 'II', 'Enrolled', 'image/received_1126474730864640.jpeg'),
(49, 30000000004, 'Jennifer Joyce', 'Malaiba', 'M', '', 'Tertiary', 'BSIT', 'Female', 'joyce@gmail.com', 'joyce', 'III', 'Enrolled', 'image/'),
(50, 20000000002, 'Brent Yzrael', 'Agaton', 'H', '', 'Tertiary', 'BSIT', 'Male', 'brent@gmail.com', 'brent', 'III', 'Enrolled', ''),
(51, 30000000007, 'Leomar', 'Del Rosario', 'A', '', 'Tertiary', 'BSTM', 'Male', 'leomar@gmail.com', 'leomar', 'IV', 'Enrolled', ''),
(61, 50000000001, 'Lorie', 'Magpantay', 'G', '', 'Tertiary', 'BSIT', 'Female', 'lorie@gmail.com', 'lorie', 'I', 'Enrolled', ''),
(62, 90909097787, 'Charlie', 'Valdez', 'L', '', 'Tertiary', 'BSBA', 'Male', 'charlie33@gmail.com', 'charlie33', 'III', 'Enrolled', ''),
(63, 4636346345436, 'dfgd', 'fhdfhdfhd', 'f', '', 'Senior High', 'CulArts', 'Male', 'a@a.a', 'aaaaa', '', 'Enrolled', ''),
(64, 909090977874, 'fsdfsf', 'fsdf', 'd', 'fd', 'Senior High', 'BSTRM', 'Male', 'fsdfs@fd.s', 'fdfdgfdg', 'I', 'Enrolled', ''),
(65, 90909097765, 'Charlie=/', 'rere', 'r', '', 'Tertiary', 'BSBA', 'Male', 'fdf@sf.ds', 'fsf', 'II', 'Enrolled', ''),
(66, 43434343434343, 'Charlie', 'Valdez', 'f', '', 'Senior High', 'ABM', 'Male', 'ff@f.f', 'ff', 'Grade 12', 'Enrolled', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminlogin`
--

CREATE TABLE `tbl_adminlogin` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_adminlogin`
--

INSERT INTO `tbl_adminlogin` (`user_id`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'admin1', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ajaxposition`
--

CREATE TABLE `tbl_ajaxposition` (
  `id` int(11) NOT NULL,
  `Level` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Representatives` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ajaxposition`
--

INSERT INTO `tbl_ajaxposition` (`id`, `Level`, `Category`, `Representatives`) VALUES
(1, 'Senior High', 'SHS-Normal', ''),
(2, 'Senior High', 'SHS-Representatives', 'ICT'),
(3, 'Senior High', 'SHS-Representatives', 'CulArts'),
(4, 'Senior High', 'SHS-Representatives', 'ABM'),
(5, 'Tertiary', 'Tertiary-Normal', ''),
(6, 'Tertiary', 'Tertiary-Representatives', 'BSIT'),
(7, 'Tertiary', 'Tertiary-Representatives', 'BSTM'),
(8, 'Tertiary', 'Tertiary-Representatives', 'BSHM'),
(9, 'Tertiary', 'Tertiary-Representatives', 'BSBA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

CREATE TABLE `tbl_level` (
  `lvlid` int(10) NOT NULL,
  `Level` enum('Senior High','Tertiary','','') NOT NULL,
  `Yearlevel` enum('Grade 11','Grade 12','I','II','III','IV') NOT NULL,
  `Program` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_level`
--

INSERT INTO `tbl_level` (`lvlid`, `Level`, `Yearlevel`, `Program`) VALUES
(1, 'Senior High', 'Grade 11', 'ICT'),
(2, 'Senior High', 'Grade 11', 'CulArts'),
(3, 'Senior High', 'Grade 11', 'ABM'),
(4, 'Senior High', 'Grade 12', 'ICT'),
(5, 'Senior High', 'Grade 12', 'CulArts'),
(6, 'Senior High', 'Grade 12', 'ABM'),
(7, 'Tertiary', 'I', 'BSBM'),
(8, 'Tertiary', 'I', 'BSIT'),
(9, 'Tertiary', 'I', 'BSTM'),
(10, 'Tertiary', 'I', 'BSBA'),
(11, 'Tertiary', 'II', 'BSHM'),
(12, 'Tertiary', 'II', 'BSIT'),
(13, 'Tertiary', 'II', 'BSTM'),
(14, 'Tertiary', 'II', 'BSBA'),
(15, 'Tertiary', 'III', 'BSHM'),
(16, 'Tertiary', 'III', 'BSIT'),
(17, 'Tertiary', 'III', 'BSTM'),
(18, 'Tertiary', 'III', 'BSBA'),
(19, 'Tertiary', 'IV', 'BSHM'),
(20, 'Tertiary', 'IV', 'BSIT'),
(21, 'Tertiary', 'IV', 'BSTM'),
(22, 'Tertiary', 'IV', 'BSBA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nominees`
--

CREATE TABLE `tbl_nominees` (
  `id` bigint(20) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `Level` varchar(50) NOT NULL,
  `partylist` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `studentid` bigint(20) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `MI` varchar(10) NOT NULL,
  `Suffix` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` enum('I','II','III','IV') NOT NULL,
  `Cprofile` varchar(1000) NOT NULL,
  `Status` enum('Active','Inactive','','') NOT NULL,
  `C_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nominees`
--

INSERT INTO `tbl_nominees` (`id`, `schoolyear`, `Level`, `partylist`, `position`, `studentid`, `Firstname`, `Lastname`, `MI`, `Suffix`, `course`, `year`, `Cprofile`, `Status`, `C_image`) VALUES
(55, '2020-2021', 'Tertiary', 'PETMALU Party', 'Vice President', 20000000002, 'Brent Yzrael', 'Agaton', 'H', '', 'BSIT', 'III', '', 'Active', 'image/FB954534-953F-4EBD-A09A-FFA41F95FB3F.JPG'),
(56, '2020-2021', 'Tertiary', 'PETMALU Party', 'Secretary', 20000000003, 'Mau', 'Villasanta', 'A', '', 'BSHM', 'II', '', 'Active', 'image/CEC2699A-BFDB-454A-B861-B1514A7AE917.JPG'),
(57, '2020-2021', 'Tertiary', 'PETMALU Party', 'Assistant Secretary', 20000000004, 'Mae', 'Bangate', 'A', '', 'BSBA', '', '', 'Active', 'image/A12D5996-C35B-4E9A-AC0C-0683AE7FC6CD.JPG'),
(58, '2020-2021', 'Tertiary', 'PETMALU Party', 'Treasurer', 20000000005, 'Gerald', 'Ramilo', 'A', '', 'BSHM', 'II', '', 'Active', 'image/DC6FC40C-BCD7-4587-BFCF-B89C4A942A20.JPG'),
(59, '2020-2021', 'Tertiary', 'PETMALU Party', 'Auditor', 20000000006, 'Ericka', 'Panergo', 'A', '', 'BSTRM', 'II', '', 'Active', 'image/45608345_2375998809139195_8512464505945456640_n.jpg'),
(60, '2020-2021', 'Tertiary', 'PETMALU Party', 'PIO', 20000000007, 'Judith', 'Tabale', 'A', '', 'BSBA', 'II', '', 'Active', 'image/2DA2F6F2-5003-40BD-AD06-FB8168178D60.JPG'),
(61, '2020-2021', 'Tertiary', 'PETMALU Party', 'IT Representative 1', 20000000008, 'Patrick', 'Obera', 'A', '', 'BSIT', 'I', '', 'Active', 'image/C3A7C4FE-8BA1-4F30-9272-40D9B1ED2F05.JPG'),
(63, '2020-2021', 'Tertiary', 'PETMALU Party', 'IT Reprensentative 2', 20000000009, 'Jessica', 'Ras', 'A', '', 'BSIT', 'II', '', 'Active', 'image/Lunox Libra.jpg'),
(64, '2020-2021', 'Tertiary', 'PETMALU Party', 'BA Reprensentative 1', 20000000010, 'Marinela', 'De Sagun', 'R', '', 'BSBA', 'II', '', 'Active', 'image/4274F452-D764-4B61-9A5B-B64E8E0ADB13.JPG'),
(65, '2020-2021', 'Tertiary', 'PETMALU Party', 'BA Reprensentative 2', 20000000011, 'Jayvee', 'Apiado', 'A', '', 'BSBA', 'II', '', 'Active', 'image/450BB92C-5264-4108-81B8-4382465AB254.JPG'),
(66, '2020-2021', 'Tertiary', 'PETMALU Party', 'HM Reprensentative 1', 20000000012, 'Jayson', 'Magsino', 'A', '', 'BSHM', 'I', '', 'Active', 'image/068664DB-D115-4362-AD9F-AD0CFA954532.JPG'),
(67, '2020-2021', 'Tertiary', 'PETMALU Party', 'HM Reprensentative 2', 20000000013, 'Angelo', 'Casalme', 'A', '', 'BSHM', 'III', '', 'Active', 'image/A593DC9B-54B4-4BED-BFE6-2E35DCB2BEB6.JPG'),
(68, '2020-2021', 'Tertiary', 'PETMALU Party', 'TRM Reprensentative 1', 20000000014, 'Mylene', 'Salvador', 'A', '', 'BSTRM', 'II', '', 'Active', 'image/258B565E-3393-4EBB-BB63-FB299FDE725B.JPG'),
(69, '2020-2021', 'Tertiary', 'PETMALU Party', 'TRM Reprensentative 2', 20000000015, 'Jubilee', 'Lara', '', '', 'BSTRM', 'II', '', 'Active', 'image/9778C996-759D-47A7-AD16-B652AFDB7112.JPG'),
(70, '2020-2021', 'Tertiary', 'PETMALU Party', 'President', 20000000001, 'Sherome', 'Yolangco', 'A', '', 'BSBA', 'II', '', 'Active', 'image/99839D1A-0EB5-404F-BF44-FE02D2D4478C.JPG'),
(71, '2020-2021', 'Tertiary', 'Liberal Party', 'President', 30000000001, 'Marvin', 'Ayag', 'A', '', 'BSIT', 'III', '', 'Active', 'image/IMG_0051.JPG'),
(72, '2020-2021', 'Tertiary', 'Liberal Party', 'Secretary', 3000000003, 'Jhia', 'Vertudazo', 'A', '', 'BSIT', 'III', '', 'Active', 'image/20882772_1969673026645356_7704881961038666399_n.jpg'),
(73, '2020-2021', 'Tertiary', 'Liberal Party', 'Vice President', 30000000002, 'Charlie', 'Valdez', 'L', '', 'BSIT', 'III', '', 'Active', 'image/Lunox Libra.jpg'),
(74, '2020-2021', 'Tertiary', 'Liberal Party', 'Assistant Secretary', 30000000004, 'Lassy', 'Sebastian', 'A', '', 'BSIT', 'III', '', 'Active', 'image/IMG_0047.JPG'),
(75, '2020-2021', 'Tertiary', 'Liberal Party', 'Treasurer', 30000000005, 'Jennifer Joyce', '', 'M', '', 'BSIT', 'III', '', 'Active', 'image/Lunox Libra.jpg'),
(76, '2020-2021', 'Tertiary', 'Liberal Party', 'Auditor', 30000000006, 'Jeffrey', 'Castillejo', 'A', '', 'BSIT', 'IV', '', 'Active', 'image/IMG_0049.JPG'),
(77, '2020-2021', 'Tertiary', 'Liberal Party', 'PIO', 30000000007, 'Leomar', 'Del Rosario', 'A', '', 'BSIT', 'III', '', 'Active', 'image/IMG_0045.JPG'),
(78, '2020-2021', 'Tertiary', 'Liberal Party', 'IT Representative 1', 30000000008, 'Gian', 'Elep', 'A', '', 'BSIT', 'III', '', 'Active', 'image/IMG_0046.JPG'),
(79, '2020-2021', 'Tertiary', 'Liberal Party', 'IT Reprensentative 2', 30000000009, 'Leonilo', 'Cacao', 'A', '', 'BSIT', 'III', '', 'Active', 'image/IMG_0048.JPG'),
(80, '2020-2021', 'Tertiary', 'Liberal Party', 'BA Reprensentative 1', 30000000010, 'Ellie', 'Cruz', 'M', '', 'BSBA', 'I', '', 'Active', 'image/75481643_10157176324558025_1322458470963740672_n.jpg'),
(81, '2020-2021', 'Tertiary', 'Liberal Party', 'BA Reprensentative 2', 30000000011, 'Andrew', 'Cruz', 'M', '', 'BSBA', 'I', '', 'Active', 'image/75481643_10157176324558025_1322458470963740672_n.jpg'),
(82, '2020-2021', 'Tertiary', 'Liberal Party', 'HM Reprensentative 1', 30000000012, 'Junard', 'Filomeno', 'A', '', 'BSHM', 'III', '', 'Active', 'image/13680899_125509737886534_5197459163221743620_n.jpg'),
(83, '2020-2021', 'Tertiary', 'Liberal Party', 'HM Reprensentative 2', 30000000013, 'Divine', 'Ogsigmer', 'A', '', 'BSHM', 'III', '', 'Active', 'image/17458119_1264699116912105_4462340587131319204_n.jpg'),
(85, '2020-2021', 'Tertiary', 'Liberal Party', 'TRM Reprensentative 1', 30000000014, 'John', 'Smith', 'A', '', 'BSTRM', 'II', '', 'Active', 'image/Lunox Libra.jpg'),
(92, '2020-2021', 'Tertiary', 'Liberal Party', 'TRM Reprensentative 2', 30000000015, 'Ann', 'Robinson', 'A', '', 'BSHM', 'III', 'fgfdg', 'Active', 'image/Lunox Libra.jpg'),
(93, '2020-2021', 'Senior High', 'Liberal Party', 'rte', 3453453434639, 'Charlie', 'fhdfhdfhd', 'f', '', 'CulArts', '', 'dfsdfs', 'Active', 'image/received_482950345789749.jpeg'),
(94, '2020-2021', 'Senior High', 'Nationalist Party', 'President', 52352352353535, 'rrtet', 'tet', 'et', '', 'ABM', '', 'etert', 'Active', 'image/received_1073490312840672.jpeg'),
(95, '2020-2021', 'Senior High', 'PETMALU Party', 'Vice-President', 53253523535353, 'rewrwe', 'rwrwe', 'e', '', 'CulArts', '', 'ere', 'Active', 'image/received_1126474730864640.jpeg'),
(96, '2020-2021', 'Senior High', 'Nationalist Party', 'fgjgf', 52352352353532, 'rertr', 'rte', 'rtr', '', 'ABM', '', 'rtert', 'Active', 'image/received_2144256715866903.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_partylist`
--

CREATE TABLE `tbl_partylist` (
  `PartylistID` bigint(20) NOT NULL,
  `PartylistName` varchar(200) NOT NULL,
  `Status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_partylist`
--

INSERT INTO `tbl_partylist` (`PartylistID`, `PartylistName`, `Status`) VALUES
(7, 'Liberal Party', 'Active'),
(9, 'Nationalist Party', 'Active'),
(12, 'PETMALU Party', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_position`
--

CREATE TABLE `tbl_position` (
  `PositionID` bigint(20) NOT NULL,
  `position` varchar(200) NOT NULL,
  `Level` enum('Senior High','Tertiary','','') NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Representatives` varchar(50) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `Status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_position`
--

INSERT INTO `tbl_position` (`PositionID`, `position`, `Level`, `Category`, `Representatives`, `schoolyear`, `Status`) VALUES
(1, 'President', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(2, 'Vice President', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(3, 'Secretary', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(4, 'Assistant Secretary', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(5, 'Treasurer', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(6, 'Auditor', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(7, 'PIO', 'Tertiary', 'Normal', '', '2020-2021', 'Active'),
(8, 'IT Representative 1', 'Tertiary', 'Representative', 'BSIT', '2020-2021', 'Active'),
(9, 'IT Reprensentative 2', 'Tertiary', 'Representative', 'BSIT', '2020-2021', 'Active'),
(10, 'BA Reprensentative 1', 'Tertiary', 'Representative', 'BSBA', '2020-2021', 'Active'),
(11, 'BA Reprensentative 2', 'Tertiary', 'Representative', 'BSBA', '2020-2021', 'Active'),
(12, 'HM Reprensentative 1', 'Tertiary', 'Representative', 'BSHM', '2020-2021', 'Active'),
(13, 'HM Reprensentative 2', 'Tertiary', 'Representative', 'BSHM', '2020-2021', 'Active'),
(14, 'TRM Reprensentative 1', 'Tertiary', 'Representative', 'BSTM', '2020-2021', 'Active'),
(15, 'TRM Reprensentative 2', 'Tertiary', 'Representative', 'BSTM', '2020-2021', 'Active'),
(16, 'fgjgf', 'Senior High', 'Normal', '', '2020-2021', 'Active'),
(17, 'President', 'Senior High', 'Normal', '', '2020-2021', 'Active'),
(18, 'Vice-President', 'Senior High', 'Normal', '', '2020-2021', 'Active'),
(19, 'rte', 'Senior High', 'SHS-Representatives', 'ABM', '2020-2021', 'Active'),
(20, 'cresident', 'Tertiary', 'Normal', '', '2020-2021', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_program`
--

CREATE TABLE `tbl_program` (
  `id` int(11) NOT NULL,
  `program` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_program`
--

INSERT INTO `tbl_program` (`id`, `program`) VALUES
(1, 'BSIT'),
(2, 'BSHM'),
(3, 'BSTRM'),
(4, 'BSBA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schoolyear`
--

CREATE TABLE `tbl_schoolyear` (
  `id` bigint(20) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `Status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_schoolyear`
--

INSERT INTO `tbl_schoolyear` (`id`, `schoolyear`, `Status`) VALUES
(17, '2020-2021', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_secyears`
--

CREATE TABLE `tbl_secyears` (
  `secyearsid` int(20) NOT NULL,
  `secondaryyears` enum('Tertiary','Senior High','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_secyears`
--

INSERT INTO `tbl_secyears` (`secyearsid`, `secondaryyears`) VALUES
(1, 'Tertiary'),
(2, 'Senior High');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shsprogram`
--

CREATE TABLE `tbl_shsprogram` (
  `shsprogramid` int(50) NOT NULL,
  `shsprogram` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shsprogram`
--

INSERT INTO `tbl_shsprogram` (`shsprogramid`, `shsprogram`) VALUES
(1, 'ABM'),
(2, 'CulArts'),
(3, 'ICT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_yearlevel`
--

CREATE TABLE `tbl_yearlevel` (
  `IDyearlevel` int(11) NOT NULL,
  `yearlevel` enum('I','II','III','IV') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(200) NOT NULL,
  `schoolyear` varchar(9) NOT NULL,
  `position` varchar(60) NOT NULL,
  `candidate_id` int(50) NOT NULL,
  `voters_id` int(50) NOT NULL,
  `fullname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `schoolyear`, `position`, `candidate_id`, `voters_id`, `fullname`) VALUES
(1971, '2020-2021', 'g', 87, 49, '  '),
(1972, '2020-2021', 'g', 87, 49, '  '),
(1973, '2020-2021', 'g', 87, 49, '  '),
(1974, '2019-2020', 'President', 71, 49, ''),
(1975, '2019-2020', 'Vice President', 73, 49, ''),
(1976, '2019-2020', 'Secretary', 0, 49, ''),
(1977, '2019-2020', 'Assistant Secretary', 0, 49, ''),
(1978, '2019-2020', 'Treasurer', 0, 49, ''),
(1979, '2019-2020', 'Auditor', 0, 49, ''),
(1980, '2019-2020', 'PIO', 0, 49, ''),
(1981, '2019-2020', '', 0, 49, ''),
(1982, '2019-2020', '', 0, 49, ''),
(1983, '2019-2020', 'President', 71, 63, ''),
(1984, '2019-2020', 'Vice President', 73, 63, ''),
(1985, '2019-2020', 'Secretary', 72, 63, ''),
(1986, '2019-2020', 'Assistant Secretary', 74, 63, ''),
(1987, '2019-2020', 'Treasurer', 75, 63, ''),
(1988, '2019-2020', 'Auditor', 76, 63, ''),
(1989, '2019-2020', 'PIO', 77, 63, ''),
(1990, '2019-2020', '', 80, 63, ''),
(1991, '2019-2020', '', 81, 63, ''),
(1992, '2019-2020', 'President', 70, 48, ''),
(1993, '2019-2020', 'Vice President', 0, 48, ''),
(1994, '2019-2020', 'Secretary', 0, 48, ''),
(1995, '2019-2020', 'Assistant Secretary', 0, 48, ''),
(1996, '2019-2020', 'Treasurer', 0, 48, ''),
(1997, '2019-2020', 'Auditor', 0, 48, ''),
(1998, '2019-2020', 'PIO', 0, 48, ''),
(1999, '2019-2020', '', 0, 48, ''),
(2000, '2019-2020', '', 0, 48, ''),
(2001, '2019-2020', 'fgjgf', 0, 66, ''),
(2002, '2019-2020', '', 93, 66, ''),
(2003, '2019-2020', 'fgjgf', 0, 66, ''),
(2004, '2019-2020', '', 93, 66, ''),
(2005, '2019-2020', 'fgjgf', 0, 66, ''),
(2006, '2019-2020', '', 93, 66, ''),
(2007, '2019-2020', 'President', 0, 48, ''),
(2008, '2019-2020', 'Vice President', 0, 48, ''),
(2009, '2019-2020', 'Secretary', 0, 48, ''),
(2010, '2019-2020', 'Assistant Secretary', 0, 48, ''),
(2011, '2019-2020', 'Treasurer', 0, 48, ''),
(2012, '2019-2020', 'Auditor', 0, 48, ''),
(2013, '2019-2020', 'PIO', 0, 48, ''),
(2014, '2019-2020', 'cresident', 0, 48, ''),
(2015, '2019-2020', '', 0, 48, ''),
(2016, '2019-2020', '', 83, 48, ''),
(2017, '2019-2020', 'President', 0, 48, ''),
(2018, '2019-2020', 'Vice President', 0, 48, ''),
(2019, '2019-2020', 'Secretary', 0, 48, ''),
(2020, '2019-2020', 'Assistant Secretary', 0, 48, ''),
(2021, '2019-2020', 'Treasurer', 0, 48, ''),
(2022, '2019-2020', 'Auditor', 0, 48, ''),
(2023, '2019-2020', 'PIO', 0, 48, ''),
(2024, '2019-2020', 'cresident', 0, 48, ''),
(2025, '2019-2020', '', 0, 48, ''),
(2026, '2019-2020', '', 67, 48, ''),
(2027, '2019-2020', 'fgjgf', 0, 66, ''),
(2028, '2019-2020', '', 93, 66, ''),
(2029, '2019-2020', 'President', 0, 48, ''),
(2030, '2019-2020', 'Vice President', 0, 48, ''),
(2031, '2019-2020', 'Secretary', 0, 48, ''),
(2032, '2019-2020', 'Assistant Secretary', 0, 48, ''),
(2033, '2019-2020', 'Treasurer', 0, 48, ''),
(2034, '2019-2020', 'Auditor', 0, 48, ''),
(2035, '2019-2020', 'PIO', 0, 48, ''),
(2036, '2019-2020', 'cresident', 0, 48, ''),
(2037, '2019-2020', '', 0, 48, ''),
(2038, '2019-2020', '', 83, 48, ''),
(2039, '2019-2020', 'fgjgf', 0, 66, ''),
(2040, '2019-2020', '', 93, 66, ''),
(2041, '2019-2020', 'fgjgf', 0, 66, ''),
(2042, '2019-2020', '', 93, 66, ''),
(2043, '2019-2020', 'fgjgf', 0, 66, ''),
(2044, '2019-2020', '', 93, 66, ''),
(2045, '2019-2020', 'fgjgf', 0, 66, ''),
(2046, '2019-2020', '', 93, 66, ''),
(2047, '2019-2020', 'fgjgf', 0, 66, ''),
(2048, '2019-2020', '', 93, 66, ''),
(2049, '2019-2020', 'fgjgf', 0, 66, ''),
(2050, '2019-2020', '', 93, 66, ''),
(2051, '2019-2020', 'fgjgf', 0, 66, ''),
(2052, '2019-2020', '', 93, 66, ''),
(2053, '2019-2020', 'fgjgf', 0, 66, ''),
(2054, '2019-2020', '', 0, 66, ''),
(2055, '2019-2020', 'fgjgf', 0, 66, ''),
(2056, '2019-2020', '', 93, 66, ''),
(2057, '2019-2020', 'fgjgf', 0, 66, ''),
(2058, '2019-2020', '', 93, 66, ''),
(2059, '2019-2020', 'fgjgf', 0, 66, ''),
(2060, '2019-2020', '', 93, 66, ''),
(2061, '2019-2020', 'fgjgf', 0, 66, ''),
(2062, '2019-2020', '', 93, 66, ''),
(2063, '2019-2020', 'fgjgf', 96, 66, ''),
(2064, '2019-2020', '', 93, 66, ''),
(2065, '2019-2020', 'fgjgf', 96, 66, ''),
(2066, '2019-2020', 'President', 94, 66, ''),
(2067, '2019-2020', 'Vice-President', 95, 66, ''),
(2068, '2019-2020', '', 93, 66, ''),
(2069, '2019-2020', 'fgjgf', 96, 66, ''),
(2070, '2019-2020', 'President', 94, 66, ''),
(2071, '2019-2020', 'Vice-President', 95, 66, ''),
(2072, '2019-2020', '', 93, 66, ''),
(2073, '2019-2020', 'fgjgf', 96, 66, ''),
(2074, '2019-2020', 'President', 94, 66, ''),
(2075, '2019-2020', 'Vice-President', 95, 66, ''),
(2076, '2019-2020', '', 93, 66, ''),
(2077, '2019-2020', 'fgjgf', 96, 66, ''),
(2078, '2019-2020', 'President', 94, 66, ''),
(2079, '2019-2020', 'Vice-President', 95, 66, ''),
(2080, '2019-2020', '', 93, 66, ''),
(2081, '2019-2020', 'fgjgf', 96, 66, ''),
(2082, '2019-2020', 'President', 94, 66, ''),
(2083, '2019-2020', 'Vice-President', 95, 66, ''),
(2084, '2019-2020', '', 93, 66, ''),
(2085, '2019-2020', 'fgjgf', 96, 66, ''),
(2086, '2019-2020', 'President', 0, 66, ''),
(2087, '2019-2020', 'Vice-President', 0, 66, ''),
(2088, '2019-2020', '', 0, 66, ''),
(2089, '2019-2020', 'fgjgf', 96, 66, ''),
(2090, '2019-2020', 'President', 0, 66, ''),
(2091, '2019-2020', 'Vice-President', 0, 66, ''),
(2092, '2019-2020', '', 0, 66, ''),
(2093, '2019-2020', 'fgjgf', 96, 66, ''),
(2094, '2019-2020', 'President', 0, 66, ''),
(2095, '2019-2020', 'Vice-President', 0, 66, ''),
(2096, '2019-2020', '', 0, 66, ''),
(2097, '2019-2020', 'fgjgf', 96, 66, ''),
(2098, '2019-2020', 'President', 0, 66, ''),
(2099, '2019-2020', 'Vice-President', 0, 66, ''),
(2100, '2019-2020', '', 0, 66, ''),
(2101, '2019-2020', 'fgjgf', 96, 66, ''),
(2102, '2019-2020', 'President', 0, 66, ''),
(2103, '2019-2020', 'Vice-President', 0, 66, ''),
(2104, '2019-2020', '', 0, 66, ''),
(2105, '2019-2020', 'fgjgf', 96, 66, ''),
(2106, '2019-2020', 'President', 94, 66, ''),
(2107, '2019-2020', 'Vice-President', 95, 66, ''),
(2108, '2019-2020', '', 93, 66, ''),
(2109, '2019-2020', 'fgjgf', 96, 66, ''),
(2110, '2019-2020', 'President', 94, 66, ''),
(2111, '2019-2020', 'Vice-President', 95, 66, ''),
(2112, '2019-2020', '', 93, 66, ''),
(2113, '2020-2021', 'President', 70, 65, ''),
(2114, '2020-2021', 'Vice President', 0, 65, ''),
(2115, '2020-2021', 'Secretary', 0, 65, ''),
(2116, '2020-2021', 'Assistant Secretary', 0, 65, ''),
(2117, '2020-2021', 'Treasurer', 0, 65, ''),
(2118, '2020-2021', 'Auditor', 0, 65, ''),
(2119, '2020-2021', 'PIO', 0, 65, ''),
(2120, '2020-2021', 'cresident', 0, 65, ''),
(2121, '2020-2021', '', 0, 65, ''),
(2122, '2020-2021', '', 0, 65, ''),
(2123, '2020-2021', 'President', 70, 48, ''),
(2124, '2020-2021', 'Vice President', 55, 48, ''),
(2125, '2020-2021', 'Secretary', 56, 48, ''),
(2126, '2020-2021', 'Assistant Secretary', 57, 48, ''),
(2127, '2020-2021', 'Treasurer', 58, 48, ''),
(2128, '2020-2021', 'Auditor', 59, 48, ''),
(2129, '2020-2021', 'PIO', 60, 48, ''),
(2130, '2020-2021', 'cresident', 0, 48, ''),
(2131, '2020-2021', '', 66, 48, ''),
(2132, '2020-2021', '', 67, 48, ''),
(2133, '2020-2021', 'President', 70, 48, ''),
(2134, '2020-2021', 'Vice President', 55, 48, ''),
(2135, '2020-2021', 'Secretary', 56, 48, ''),
(2136, '2020-2021', 'Assistant Secretary', 57, 48, ''),
(2137, '2020-2021', 'Treasurer', 58, 48, ''),
(2138, '2020-2021', 'Auditor', 59, 48, ''),
(2139, '2020-2021', 'PIO', 60, 48, ''),
(2140, '2020-2021', 'cresident', 0, 48, ''),
(2141, '2020-2021', '', 66, 48, ''),
(2142, '2020-2021', '', 67, 48, ''),
(2143, '2020-2021', 'President', 70, 48, ''),
(2144, '2020-2021', 'Vice President', 55, 48, ''),
(2145, '2020-2021', 'Secretary', 56, 48, ''),
(2146, '2020-2021', 'Assistant Secretary', 57, 48, ''),
(2147, '2020-2021', 'Treasurer', 0, 48, ''),
(2148, '2020-2021', 'Auditor', 0, 48, ''),
(2149, '2020-2021', 'PIO', 0, 48, ''),
(2150, '2020-2021', 'cresident', 0, 48, ''),
(2151, '2020-2021', '', 0, 48, ''),
(2152, '2020-2021', '', 0, 48, ''),
(2153, '2020-2021', 'President', 70, 49, ''),
(2154, '2020-2021', 'Vice President', 0, 49, ''),
(2155, '2020-2021', 'Secretary', 0, 49, ''),
(2156, '2020-2021', 'Assistant Secretary', 0, 49, ''),
(2157, '2020-2021', 'Treasurer', 0, 49, ''),
(2158, '2020-2021', 'Auditor', 0, 49, ''),
(2159, '2020-2021', 'PIO', 0, 49, ''),
(2160, '2020-2021', 'cresident', 0, 49, ''),
(2161, '2020-2021', '', 61, 49, ''),
(2162, '2020-2021', '', 63, 49, ''),
(2163, '2020-2021', 'fgjgf', 96, 66, ''),
(2164, '2020-2021', 'President', 0, 66, ''),
(2165, '2020-2021', 'Vice-President', 0, 66, ''),
(2166, '2020-2021', '', 0, 66, ''),
(2167, '2020-2021', 'fgjgf', 0, 66, ''),
(2168, '2020-2021', 'President', 0, 66, ''),
(2169, '2020-2021', 'Vice-President', 0, 66, ''),
(2170, '2020-2021', '', 93, 66, ''),
(2171, '2020-2021', 'fgjgf', 96, 66, ''),
(2172, '2020-2021', 'President', 94, 66, ''),
(2173, '2020-2021', 'Vice-President', 95, 66, ''),
(2174, '2020-2021', '', 93, 66, ''),
(2175, '2020-2021', 'fgjgf', 96, 66, ''),
(2176, '2020-2021', 'President', 94, 66, ''),
(2177, '2020-2021', 'Vice-President', 95, 66, ''),
(2178, '2020-2021', '', 93, 66, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_addvoters`
--
ALTER TABLE `tbl_addvoters`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `tbl_adminlogin`
--
ALTER TABLE `tbl_adminlogin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_ajaxposition`
--
ALTER TABLE `tbl_ajaxposition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD PRIMARY KEY (`lvlid`);

--
-- Indexes for table `tbl_nominees`
--
ALTER TABLE `tbl_nominees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_partylist`
--
ALTER TABLE `tbl_partylist`
  ADD PRIMARY KEY (`PartylistID`);

--
-- Indexes for table `tbl_position`
--
ALTER TABLE `tbl_position`
  ADD PRIMARY KEY (`PositionID`);

--
-- Indexes for table `tbl_program`
--
ALTER TABLE `tbl_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_secyears`
--
ALTER TABLE `tbl_secyears`
  ADD PRIMARY KEY (`secyearsid`);

--
-- Indexes for table `tbl_shsprogram`
--
ALTER TABLE `tbl_shsprogram`
  ADD PRIMARY KEY (`shsprogramid`);

--
-- Indexes for table `tbl_yearlevel`
--
ALTER TABLE `tbl_yearlevel`
  ADD PRIMARY KEY (`IDyearlevel`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_addvoters`
--
ALTER TABLE `tbl_addvoters`
  MODIFY `uid` bigint(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `tbl_adminlogin`
--
ALTER TABLE `tbl_adminlogin`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_ajaxposition`
--
ALTER TABLE `tbl_ajaxposition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_level`
--
ALTER TABLE `tbl_level`
  MODIFY `lvlid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_nominees`
--
ALTER TABLE `tbl_nominees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `tbl_partylist`
--
ALTER TABLE `tbl_partylist`
  MODIFY `PartylistID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_position`
--
ALTER TABLE `tbl_position`
  MODIFY `PositionID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_program`
--
ALTER TABLE `tbl_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_schoolyear`
--
ALTER TABLE `tbl_schoolyear`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_secyears`
--
ALTER TABLE `tbl_secyears`
  MODIFY `secyearsid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_shsprogram`
--
ALTER TABLE `tbl_shsprogram`
  MODIFY `shsprogramid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2179;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
