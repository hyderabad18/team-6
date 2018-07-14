-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 01:37 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `Event_ID` int(10) NOT NULL,
  `Event_Name` varchar(20) NOT NULL,
  `Event_Desc` varchar(30) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Vol_Count` int(10) NOT NULL,
  `Benefit` int(10) NOT NULL,
  `Loc_Name` varchar(30) NOT NULL,
  `Loc_Lat` varchar(30) NOT NULL,
  `Loc_Long` varchar(30) NOT NULL,
  `Start_Date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `End_Date` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`Event_ID`, `Event_Name`, `Event_Desc`, `Type`, `Vol_Count`, `Benefit`, `Loc_Name`, `Loc_Lat`, `Loc_Long`, `Start_Date`, `End_Date`) VALUES
(1, 'chiguru', 'event', 'educational', 5, 10, 'jubliehills', '23', '34', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `temp_enrollment`
--

CREATE TABLE `temp_enrollment` (
  `User_ID` varchar(20) NOT NULL,
  `Event_ID` int(10) NOT NULL,
  `Time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `Volunteer_Name` varchar(20) NOT NULL,
  `Phone_no` int(10) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `User_ID` varchar(30) NOT NULL,
  `Loc_Name` varchar(100) NOT NULL,
  `Loc_Lat` varchar(100) NOT NULL,
  `Loc_Long` varchar(100) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`Volunteer_Name`, `Phone_no`, `Email`, `User_ID`, `Loc_Name`, `Loc_Lat`, `Loc_Long`, `Password`) VALUES
('0', 88888888, '0', '0', 'Jubileehills', 'sajdas', 'awws', 'amulya'),
('0', 55548888, '0', '0', 'Banjarahills', 'sajdas', 'awws', 'sahithi'),
('amulya', 88888888, 'devi.amulya72@gmail.com', 'amulya', '', '', '', 'amulya'),
('siddharth', 764647844, 'jnklgll@gmail.com', 'siddharth', '', '', '', 'siddharth');

-- --------------------------------------------------------

--
-- Table structure for table `v_checkin`
--

CREATE TABLE `v_checkin` (
  `User_ID` varchar(30) NOT NULL,
  `Event_ID` int(10) NOT NULL,
  `Date` date NOT NULL,
  `Check_IN` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `Check_out` timestamp(6) NOT NULL DEFAULT '0000-00-00 00:00:00.000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `v_checkin`
--

INSERT INTO `v_checkin` (`User_ID`, `Event_ID`, `Date`, `Check_IN`, `Check_out`) VALUES
('amulya', 1, '2018-07-09', '2018-07-08 15:00:13.000000', '2018-07-30 01:00:00.000000'),
('amulya', 1, '2018-07-09', '2018-07-08 15:00:13.000000', '2018-07-30 01:00:00.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`Event_ID`);

--
-- Indexes for table `temp_enrollment`
--
ALTER TABLE `temp_enrollment`
  ADD UNIQUE KEY `user_ID` (`User_ID`),
  ADD UNIQUE KEY `event_ID` (`Event_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
