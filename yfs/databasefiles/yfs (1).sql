-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 06:03 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `event_id` int(20) NOT NULL,
  `event_name` varchar(80) NOT NULL,
  `Event_Description` varchar(1000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `vol_count` int(20) NOT NULL,
  `benefit` varchar(100) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `loc_lat` varchar(50) NOT NULL,
  `loc_long` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer`
--

CREATE TABLE `volunteer` (
  `volunteer_id` int(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `phone_no` int(100) NOT NULL,
  `email` int(11) NOT NULL,
  `loc_lat` varchar(100) NOT NULL,
  `loc_long` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_on` date NOT NULL,
  `role_flag` int(3) NOT NULL COMMENT 'Admin-1, Others-0',
  `preferences` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer`
--

INSERT INTO `volunteer` (`volunteer_id`, `first_name`, `last_name`, `display_name`, `phone_no`, `email`, `loc_lat`, `loc_long`, `gender`, `password`, `created_on`, `role_flag`, `preferences`) VALUES
(1, 'Manish', 'Sadhu', 'Manish Sadhu', 2147483647, 0, '10.100', '10.10000', 'M', '30e535568de1f9231e7d9df0f4a5a44d', '2018-07-14', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `v_checkin`
--

CREATE TABLE `v_checkin` (
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `checkin` timestamp NOT NULL,
  `checkout` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `volunteer`
--
ALTER TABLE `volunteer`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `phone_no` (`phone_no`),
  ADD UNIQUE KEY `volunteer_id` (`volunteer_id`);

--
-- Indexes for table `v_checkin`
--
ALTER TABLE `v_checkin`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `volunteer`
--
ALTER TABLE `volunteer`
  MODIFY `volunteer_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
