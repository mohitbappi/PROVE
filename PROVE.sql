-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2019 at 06:15 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PROVE`
--

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE `Company` (
  `Company_id` int(11) NOT NULL,
  `Company_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Domain` varchar(100) COLLATE utf8_bin NOT NULL,
  `Owner` varchar(100) COLLATE utf8_bin NOT NULL,
  `City` varchar(100) COLLATE utf8_bin NOT NULL,
  `Country` varchar(100) COLLATE utf8_bin NOT NULL,
  `Est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `Department_id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Member`
--

CREATE TABLE `Member` (
  `Member_id` int(11) NOT NULL,
  `Company_id` int(11) NOT NULL,
  `Name` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `Email` varchar(100) COLLATE utf8_bin NOT NULL,
  `Address` varchar(100) COLLATE utf8_bin NOT NULL,
  `Phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `Password` varchar(500) COLLATE utf8_bin NOT NULL,
  `Department_id` int(11) NOT NULL,
  `Leader_id` int(11) NOT NULL,
  `Role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `Role_id` int(11) NOT NULL,
  `Role_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Create_member` int(11) NOT NULL,
  `Create_Task` int(11) NOT NULL,
  `Create_Department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE `Score` (
  `Score_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Company_id` int(11) NOT NULL,
  `Department_id` int(11) NOT NULL,
  `Points` int(11) NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Task`
--

CREATE TABLE `Task` (
  `Task_id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Description` varchar(1000) COLLATE utf8_bin NOT NULL,
  `Points` int(11) NOT NULL,
  `Member_id_created` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Member_id_assigned` int(11) NOT NULL,
  `Super_task_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Company`
--
ALTER TABLE `Company`
  ADD PRIMARY KEY (`Company_id`);

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`Department_id`),
  ADD KEY `FK_1` (`Company_id`);

--
-- Indexes for table `Member`
--
ALTER TABLE `Member`
  ADD PRIMARY KEY (`Member_id`),
  ADD KEY `FK_2` (`Company_id`),
  ADD KEY `FK_3` (`Department_id`),
  ADD KEY `FK_4` (`Role_id`),
  ADD KEY `FK_5` (`Leader_id`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD PRIMARY KEY (`Role_id`);

--
-- Indexes for table `Score`
--
ALTER TABLE `Score`
  ADD PRIMARY KEY (`Score_id`),
  ADD KEY `FK_6` (`Company_id`),
  ADD KEY `FK_7` (`Department_id`),
  ADD KEY `FK_8` (`Member_id`);

--
-- Indexes for table `Task`
--
ALTER TABLE `Task`
  ADD PRIMARY KEY (`Task_id`),
  ADD KEY `FK_9` (`Member_id_created`),
  ADD KEY `FK_10` (`Super_task_id`),
  ADD KEY `FK_11` (`Member_id_assigned`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Company`
--
ALTER TABLE `Company`
  MODIFY `Company_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Department`
--
ALTER TABLE `Department`
  MODIFY `Department_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Member`
--
ALTER TABLE `Member`
  MODIFY `Member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `Role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Score`
--
ALTER TABLE `Score`
  MODIFY `Score_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `Task_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Department`
--
ALTER TABLE `Department`
  ADD CONSTRAINT `FK_1` FOREIGN KEY (`Company_id`) REFERENCES `Company` (`Company_id`);

--
-- Constraints for table `Member`
--
ALTER TABLE `Member`
  ADD CONSTRAINT `FK_2` FOREIGN KEY (`Company_id`) REFERENCES `Company` (`Company_id`),
  ADD CONSTRAINT `FK_3` FOREIGN KEY (`Department_id`) REFERENCES `Department` (`Department_id`),
  ADD CONSTRAINT `FK_4` FOREIGN KEY (`Role_id`) REFERENCES `Role` (`Role_id`),
  ADD CONSTRAINT `FK_5` FOREIGN KEY (`Leader_id`) REFERENCES `Member` (`Member_id`);

--
-- Constraints for table `Score`
--
ALTER TABLE `Score`
  ADD CONSTRAINT `FK_6` FOREIGN KEY (`Company_id`) REFERENCES `Company` (`Company_id`),
  ADD CONSTRAINT `FK_7` FOREIGN KEY (`Department_id`) REFERENCES `Department` (`Department_id`),
  ADD CONSTRAINT `FK_8` FOREIGN KEY (`Member_id`) REFERENCES `Member` (`Member_id`);

--
-- Constraints for table `Task`
--
ALTER TABLE `Task`
  ADD CONSTRAINT `FK_10` FOREIGN KEY (`Super_task_id`) REFERENCES `Task` (`Task_id`),
  ADD CONSTRAINT `FK_11` FOREIGN KEY (`Member_id_assigned`) REFERENCES `Member` (`Member_id`),
  ADD CONSTRAINT `FK_9` FOREIGN KEY (`Member_id_created`) REFERENCES `Member` (`Member_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
