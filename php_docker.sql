-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: May 06, 2024 at 11:37 AM
-- Server version: 8.4.0
-- PHP Version: 8.2.8
use php_docker;
RUN docker-php-ext-install mysqli 
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_docker`
--

-- --------------------------------------------------------

--
-- Table structure for table `Clients`
--

CREATE TABLE `Clients` (
  `ClientID` varchar(5) NOT NULL,
  `NumberOfOrders` int DEFAULT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Location` varchar(50) DEFAULT NULL,
  `ClientDiscount` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Clients`
--

INSERT INTO `Clients` (`ClientID`, `NumberOfOrders`, `PhoneNumber`, `Location`, `ClientDiscount`) VALUES
('C_01', NULL, '555-123-4567', 'NY', 10),
('C_02', NULL, '555-987-6543', 'MO', 5),
('C_03', NULL, '555-555-1212', 'KY', 3),
('C_04', NULL, '555-888-9999', 'FL', 5),
('C_05', NULL, '555-444-3333', 'CO', 4),
('C_06', NULL, '555-777-8888', 'MA', 6);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `OrderID` varchar(10) NOT NULL,
  `ClientID` varchar(5) DEFAULT NULL,
  `ProductID` varchar(5) DEFAULT NULL,
  `ProductQuantity` int DEFAULT NULL,
  `TotalSale` decimal(10,2) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ProductOrders`
--

CREATE TABLE `ProductOrders` (
  `ProductID` varchar(5) NOT NULL,
  `OrderID` varchar(10) NOT NULL,
  `ProductQuantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ProductID` varchar(5) NOT NULL,
  `CostPerUnit` decimal(8,2) DEFAULT NULL,
  `QuantityInStock` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ProductID`, `CostPerUnit`, `QuantityInStock`) VALUES
('P_01', 10.00, 123),
('P_02', 14.00, 450),
('P_03', 13.00, 342),
('P_04', 9.00, 30),
('P_05', 7.00, 55),
('P_06', 15.00, 67);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `ClientID` (`ClientID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `ProductOrders`
--
ALTER TABLE `ProductOrders`
  ADD PRIMARY KEY (`ProductID`,`OrderID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ProductID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`ClientID`) REFERENCES `Clients` (`ClientID`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`);

--
-- Constraints for table `ProductOrders`
--
ALTER TABLE `ProductOrders`
  ADD CONSTRAINT `ProductOrders_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
