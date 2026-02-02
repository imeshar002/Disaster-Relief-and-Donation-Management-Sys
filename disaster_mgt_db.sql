-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2026 at 09:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disaster_mgt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `beneficiary`
--

CREATE TABLE `beneficiary` (
  `BeneficiaryID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `ContactNo` varchar(15) DEFAULT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beneficiary`
--

INSERT INTO `beneficiary` (`BeneficiaryID`, `Name`, `ContactNo`, `Location`) VALUES
(1, 'Saman Silva', '0712345678', 'Kandy Relief Camp 1'),
(2, 'Sithumini Gamage', '0711111111', 'Colombo relief camp'),
(3, 'A D Kelum', '0722222222', 'Kandy relief camp 2'),
(4, 'Nayani Silva', '0733333333', 'Galle Town Hall');

-- --------------------------------------------------------

--
-- Table structure for table `distribution`
--

CREATE TABLE `distribution` (
  `DistributionID` int(11) NOT NULL,
  `DistributionTimeStamp` datetime NOT NULL,
  `DistributionLocation` varchar(100) NOT NULL,
  `BeneficiaryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distribution`
--

INSERT INTO `distribution` (`DistributionID`, `DistributionTimeStamp`, `DistributionLocation`, `BeneficiaryID`) VALUES
(3, '2026-01-25 15:00:00', 'Kandy Relief Camp 1', 1),
(4, '2026-01-27 16:00:00', 'Community Center Bandarawela', 3),
(5, '2026-01-27 17:00:00', 'Galle Town Hall', 4),
(6, '2026-01-27 23:52:00', 'Kandy Relief Camp 1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `distributionitem`
--

CREATE TABLE `distributionitem` (
  `DistributionItemID` int(11) NOT NULL,
  `QuantityDistributed` int(11) NOT NULL,
  `ItemID` int(11) DEFAULT NULL,
  `DistributionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `distributionitem`
--

INSERT INTO `distributionitem` (`DistributionItemID`, `QuantityDistributed`, `ItemID`, `DistributionID`) VALUES
(1, 5, 3, 3),
(2, 10, 4, 5),
(3, 2, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `DonationID` int(11) NOT NULL,
  `DonationTimeStamp` datetime NOT NULL,
  `DonorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation`
--

INSERT INTO `donation` (`DonationID`, `DonationTimeStamp`, `DonorID`) VALUES
(10, '2026-01-27 10:00:00', 17),
(11, '2026-01-27 11:00:00', 18),
(12, '2026-01-27 12:00:00', 19);

-- --------------------------------------------------------

--
-- Table structure for table `donationitem`
--

CREATE TABLE `donationitem` (
  `DonationItemID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `DonationID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `DonorID` int(11) NOT NULL,
  `DonorName` varchar(100) NOT NULL,
  `ContactNo` varchar(15) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `DonorType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`DonorID`, `DonorName`, `ContactNo`, `Address`, `DonorType`) VALUES
(17, 'Saman Lakmal', '0712345678', 'Colombo', 'Individual'),
(18, 'Bright Org Ltd', '0119876543', 'Main Street, Kandy', 'Organization'),
(19, 'Kamala Perera', '0771234567', 'Galle', 'Individual');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `InventoryID` int(11) NOT NULL,
  `LastUpdatedTimeStamp` datetime NOT NULL,
  `CurrentStock` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`InventoryID`, `LastUpdatedTimeStamp`, `CurrentStock`, `ItemID`) VALUES
(2, '2026-01-27 14:00:00', 100, 4),
(3, '2026-01-27 14:30:00', 50, 3),
(4, '2026-01-27 15:00:00', 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `Unit` varchar(50) DEFAULT NULL,
  `Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `ItemName`, `Unit`, `Category`) VALUES
(2, 'cereal', '5 packs', 'cereal'),
(3, 'Rice', 'kg', 'Food'),
(4, 'Water Bottle', 'liters', 'Drink'),
(5, 'Blanket', 'piece', 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `Role`) VALUES
(6, 'admin', 'admin123', 'Admin'),
(7, 'staff1', 'staff123', 'Staff'),
(8, 'staff2', 'staff456', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beneficiary`
--
ALTER TABLE `beneficiary`
  ADD PRIMARY KEY (`BeneficiaryID`);

--
-- Indexes for table `distribution`
--
ALTER TABLE `distribution`
  ADD PRIMARY KEY (`DistributionID`),
  ADD KEY `fk_beneficiary` (`BeneficiaryID`);

--
-- Indexes for table `distributionitem`
--
ALTER TABLE `distributionitem`
  ADD PRIMARY KEY (`DistributionItemID`),
  ADD KEY `fk_distributionitem_distribution` (`DistributionID`),
  ADD KEY `fk_distributionitem_item` (`ItemID`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`DonationID`),
  ADD KEY `fk_donor` (`DonorID`);

--
-- Indexes for table `donationitem`
--
ALTER TABLE `donationitem`
  ADD PRIMARY KEY (`DonationItemID`),
  ADD KEY `fk_donation` (`DonationID`),
  ADD KEY `fk_item` (`ItemID`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`DonorID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`InventoryID`),
  ADD KEY `fk_inventory_item` (`ItemID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beneficiary`
--
ALTER TABLE `beneficiary`
  MODIFY `BeneficiaryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `distribution`
--
ALTER TABLE `distribution`
  MODIFY `DistributionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `distributionitem`
--
ALTER TABLE `distributionitem`
  MODIFY `DistributionItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `DonationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `donationitem`
--
ALTER TABLE `donationitem`
  MODIFY `DonationItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `DonorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `InventoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribution`
--
ALTER TABLE `distribution`
  ADD CONSTRAINT `fk_beneficiary` FOREIGN KEY (`BeneficiaryID`) REFERENCES `beneficiary` (`BeneficiaryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `distributionitem`
--
ALTER TABLE `distributionitem`
  ADD CONSTRAINT `fk_distributionitem_distribution` FOREIGN KEY (`DistributionID`) REFERENCES `distribution` (`DistributionID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_distributionitem_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `fk_donor` FOREIGN KEY (`DonorID`) REFERENCES `donor` (`DonorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donationitem`
--
ALTER TABLE `donationitem`
  ADD CONSTRAINT `fk_donation` FOREIGN KEY (`DonationID`) REFERENCES `donation` (`DonationID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fk_inventory_item` FOREIGN KEY (`ItemID`) REFERENCES `item` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
