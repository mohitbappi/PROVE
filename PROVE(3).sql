-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2019 at 07:01 PM
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

--
-- Dumping data for table `Company`
--

INSERT INTO `Company` (`Company_id`, `Company_name`, `Domain`, `Owner`, `City`, `Country`, `Est`) VALUES
(1, 'jj', 'jj', 'jj', 'jj', 'jj', 122),
(2, 'sdfjl', 'slfjsd', 'sdlkjfsd', 'sdjflds', 'dslfj', 9999),
(3, 'itios', 'itios', 'krish', 'indore', 'india', 1997),
(4, 'zensor', 'zensor', 'rishi', 'fdsf', 'klsfj', 999),
(5, 'ZONO', 'hwd', 'Helena', 'Mumbai', 'India', 1998),
(6, 'rivita', 'rv', 'Rahul', 'Mumbai', 'India', 1999);

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `Department_id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`Department_id`, `Name`, `Company_id`) VALUES
(2, 'dddd', 4),
(3, 'something', 3),
(4, 'HR', 5),
(5, 'DESIGN', 5),
(6, 'PROMOTION', 5),
(7, 'DESIGN', 6),
(8, 'HR', 6),
(9, 'PROMOTION', 6);

-- --------------------------------------------------------

--
-- Table structure for table `Member`
--

CREATE TABLE `Member` (
  `Member_id` int(11) NOT NULL,
  `id` varchar(50) COLLATE utf8_bin NOT NULL,
  `Company_id` int(11) NOT NULL,
  `Name` varchar(100) COLLATE utf8_bin NOT NULL,
  `DOB` date NOT NULL,
  `Email` varchar(100) COLLATE utf8_bin NOT NULL,
  `Address` varchar(100) COLLATE utf8_bin NOT NULL,
  `Phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `Password` varchar(500) COLLATE utf8_bin NOT NULL,
  `Department_id` int(11) DEFAULT NULL,
  `Leader_id` int(11) DEFAULT NULL,
  `Role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Member`
--

INSERT INTO `Member` (`Member_id`, `id`, `Company_id`, `Name`, `DOB`, `Email`, `Address`, `Phone`, `Password`, `Department_id`, `Leader_id`, `Role_id`) VALUES
(1, '001', 2, '0', '2019-04-01', 'saa@gmma.com', 'sdfldksj', '9999999999', '4f2a91d6913739834ec9c3d4f9203534', NULL, NULL, NULL),
(2, '001', 3, '0', '2019-04-03', 'krishlalwani1@gmail.com', 'ksljfslkdjf', '9999999999', '4f2a91d6913739834ec9c3d4f9203534', NULL, NULL, NULL),
(3, '001', 4, '0', '2019-04-04', 'abc@xyz.com', 'sldfjdslf', '1234567890', '4f2a91d6913739834ec9c3d4f9203534', NULL, NULL, NULL),
(4, '010', 4, 'miti', '2019-04-04', 'miti@kesh.com', 'dslkfjlksdf', '9999999999', '4f2a91d6913739834ec9c3d4f9203534', 2, 3, 2),
(5, '002', 5, 'Helena', '1990-03-19', 'helena@gmail.com', 'Delhi', '9876543210', '4f2a91d6913739834ec9c3d4f9203534', NULL, NULL, NULL),
(6, '201', 5, 'Aman', '1992-05-05', 'aman@yahoo.com', 'Indore', '9780765432', '4f2a91d6913739834ec9c3d4f9203534', 5, 5, 6),
(7, '202', 5, 'rohit', '1996-08-19', 'rohit@ymail.com', 'Dubai', '9777786543', '4f2a91d6913739834ec9c3d4f9203534', 5, 6, 7),
(8, '001', 6, 'Rahul', '1981-03-10', 'rahul@gmail.com', 'Mumbai', '9876543210', '4f2a91d6913739834ec9c3d4f9203534', NULL, NULL, NULL),
(9, '101', 6, 'Aman', '1997-04-10', 'aman@yahoo.com', 'Indore', '9999988888', '4f2a91d6913739834ec9c3d4f9203534', 7, 8, 10),
(10, '102', 6, 'aditya', '1999-04-21', 'aditya@gmail.com', 'Indore', '6666677777', '4f2a91d6913739834ec9c3d4f9203534', 7, 9, 11);

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `Role_id` int(11) NOT NULL,
  `Role_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `Create_member` int(11) NOT NULL,
  `Create_Task` int(11) NOT NULL,
  `Create_Department` int(11) NOT NULL,
  `Company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Role`
--

INSERT INTO `Role` (`Role_id`, `Role_name`, `Create_member`, `Create_Task`, `Create_Department`, `Company_id`) VALUES
(1, 'hod', 1, 0, 0, 0),
(2, 'hiii', 1, 0, 0, 4),
(3, 'vc', 1, 1, 0, 4),
(4, 'CEO', 1, 1, 1, 5),
(5, 'CTO', 1, 1, 1, 5),
(6, 'TEAM LEAD', 0, 1, 0, 5),
(7, 'SOFTWARE ENGG', 0, 1, 0, 5),
(8, 'CEO', 1, 1, 1, 6),
(9, 'CTO', 1, 1, 0, 6),
(10, 'TEAM LEAD', 0, 1, 0, 6),
(11, 'SOFTWARE ENGG', 0, 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE `Score` (
  `Score_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Company_id` int(11) NOT NULL,
  `Points` int(11) NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Score`
--

INSERT INTO `Score` (`Score_id`, `Member_id`, `Company_id`, `Points`, `Time`) VALUES
(5, 7, 5, 100, '2019-03-07 00:00:00'),
(6, 7, 5, 200, '2019-04-07 00:00:00'),
(7, 10, 6, 100, '2019-04-07 00:00:00');

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
  `Super_task_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Task`
--

INSERT INTO `Task` (`Task_id`, `Name`, `Description`, `Points`, `Member_id_created`, `Status`, `Member_id_assigned`, `Super_task_id`) VALUES
(2, 'sdfdsf', 'sdffsdf', 33, 3, 0, 3, NULL),
(3, 'sdfdsf', 'sdffsdf', 44, 3, 0, 4, NULL),
(4, 'sdfssss', 'sssssss', 1, 3, 0, 3, NULL),
(5, 'sdfssss', 'sssssss', 2, 3, 0, 4, NULL),
(6, 'sdfssss', 'sssssss', 3, 3, 0, 4, NULL),
(8, 'Create a web page', 'new webpage for companys website', 100, 6, 2, 7, NULL),
(9, 'create db', 'create db', 200, 6, 2, 7, NULL),
(10, 'Create a web page', 'Create a web page', 100, 9, 2, 10, NULL);

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
  MODIFY `Company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Department`
--
ALTER TABLE `Department`
  MODIFY `Department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Member`
--
ALTER TABLE `Member`
  MODIFY `Member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `Role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Score`
--
ALTER TABLE `Score`
  MODIFY `Score_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Task`
--
ALTER TABLE `Task`
  MODIFY `Task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
