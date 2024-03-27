-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 06:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sticketsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `AdminuserName` varchar(20) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `UserType` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `UserType`) VALUES
(2, 'Admin', 'admin', 1234596321, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-01-04 18:30:00', 1),
(3, 'Anuj kumar', 'akr305', 1234567891, 'ak@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2024-01-06 18:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `AddedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `categoryName`, `creationDate`, `AddedBy`) VALUES
(9, 'Technical', '2023-12-26 06:21:26', 2),
(10, 'Installation', '2024-01-18 18:12:44', 2),
(11, 'Bugs', '2024-01-18 18:12:57', 2),
(12, 'Billing', '2024-01-18 18:13:12', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblknowledgebase`
--

CREATE TABLE `tblknowledgebase` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL,
  `titleName` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `addedBy` int(11) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblknowledgebase`
--

INSERT INTO `tblknowledgebase` (`id`, `categoryName`, `titleName`, `description`, `addedBy`, `postingDate`) VALUES
(1, 'Installation', 'How to Install the script', 'Download the Script, Then unzip the file. After that copy the script folder and paste the htdocs. Now create a database and import the SQL file.', 2, '2024-01-20 18:30:00'),
(3, 'Bugs', 'Test title Test title Test title Test title', 'This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. This is for testing purposes. ', 2, '2024-01-21 16:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbltickethistory`
--

CREATE TABLE `tbltickethistory` (
  `id` int(11) NOT NULL,
  `ticketID` int(11) DEFAULT NULL,
  `ticketNo` varchar(255) DEFAULT NULL,
  `ticketDescription` longtext DEFAULT NULL,
  `supportFile` varchar(255) DEFAULT NULL,
  `ticketStatus` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `remarkBy` varchar(255) DEFAULT NULL,
  `officialId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltickethistory`
--

INSERT INTO `tbltickethistory` (`id`, `ticketID`, `ticketNo`, `ticketDescription`, `supportFile`, `ticketStatus`, `postingDate`, `remarkBy`, `officialId`) VALUES
(1, 1, '202401-0001', 'This is for test', 'ae1af9bebe6fc5338ac6f34e4e1a17261705492072.pdf', NULL, '2024-01-17 11:47:52', 'User', NULL),
(2, 1, '202401-0001', 'This is for test', 'ae1af9bebe6fc5338ac6f34e4e1a17261705492091.pdf', NULL, '2024-01-17 11:48:11', 'User', NULL),
(3, 1, '202401-0001', 'This is for test', 'ae1af9bebe6fc5338ac6f34e4e1a17261705492245.pdf', NULL, '2024-01-17 11:50:45', 'User', NULL),
(4, 1, '202401-0001', 'Ticket has been closed.', '30677a2e568f972b32432f6f3bbc49e51705810192.pdf', 'Resolved', '2024-01-21 04:09:52', 'Admin', 2),
(5, 2, '202401-0002', 'We are working on it. It will resolve soon.', '', 'In Process', '2024-01-21 07:45:42', 'Admin', 2),
(7, 2, '202401-0002', 'Ticket resolved', '30677a2e568f972b32432f6f3bbc49e51705842917.pdf', 'Resolved', '2024-01-21 13:15:17', 'Admin', 2),
(8, 4, '202401-0004', 'We will fix this issue soon.', '', 'In Process', '2024-01-21 13:36:39', 'Admin', 2),
(9, 4, '202401-0004', 'I am sharing the scrrneshot', '1383b44c5b5394dd380b0b5f4991de7d1705844237.png', NULL, '2024-01-21 13:37:17', 'User', NULL),
(10, 4, '202401-0004', 'Issue resolved', '30677a2e568f972b32432f6f3bbc49e51705844258.pdf', 'Resolved', '2024-01-21 13:37:38', 'Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbltickets`
--

CREATE TABLE `tbltickets` (
  `id` int(11) NOT NULL,
  `ticketNo` varchar(255) DEFAULT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `emailId` varchar(255) DEFAULT NULL,
  `ticketCategory` varchar(255) DEFAULT NULL,
  `ticketSubject` varchar(255) DEFAULT NULL,
  `ticketDescription` longtext DEFAULT NULL,
  `supportFile` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `ticketStatus` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbltickets`
--

INSERT INTO `tbltickets` (`id`, `ticketNo`, `fullName`, `emailId`, `ticketCategory`, `ticketSubject`, `ticketDescription`, `supportFile`, `priority`, `ticketStatus`, `creationDate`) VALUES
(1, '202401-0001', 'dfggd', 'dfsdf@gmail.vom', 'Technical', 'fsdfdsgf', '<p>This is for testing.&nbsp;<span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span><span style=\"font-size: 1rem;\">This is for testing.&nbsp;</span></p>', 'b49b5d8a60f6a2ed0e960b32b1c69baa1705294282.png', '1', 'Resolved', '2024-01-15 04:51:22'),
(2, '202401-0002', 'dfggd', 'dfsdf@gmail.vom', 'Technical', 'fsdfdsgf', '<p>this is for testing.</p>', 'b49b5d8a60f6a2ed0e960b32b1c69baa1705310854.png', '3', 'Resolved', '2024-01-15 09:27:34'),
(3, '202401-0003', 'dasd', 'dasdsa@gmail.com', 'Technical', 'werwertw', '<p><b>twetewt&nbsp; rwe r wer wer&nbsp;</b></p>', '2ad9d236cba203370bbebb447a7043ff1705387677.pdf', '2', NULL, '2024-01-16 06:47:57'),
(4, '202401-0004', 'Amit', 'amit12@gmail.com', 'Installation', 'Regarding Installation ', '<p>I am facing some issue with installation. I need support</p>', '30677a2e568f972b32432f6f3bbc49e51705843999.pdf', '2', 'Resolved', '2024-01-21 13:33:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblknowledgebase`
--
ALTER TABLE `tblknowledgebase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltickethistory`
--
ALTER TABLE `tbltickethistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltickets`
--
ALTER TABLE `tbltickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblknowledgebase`
--
ALTER TABLE `tblknowledgebase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbltickethistory`
--
ALTER TABLE `tbltickethistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbltickets`
--
ALTER TABLE `tbltickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
