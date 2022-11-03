-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 03, 2022 at 06:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `primavera`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `UnitNo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Email`, `PhoneNumber`, `Address`, `PostalCode`, `UnitNo`) VALUES
(50, 'Aung Khant Zaw', 'akhantz250@gmail.com', '88493966', 'Aung Khant Zaw', '666888', '#1-111'),
(51, 'Jimmy', 'jman123@yahoo.com.sg', '123', 'Jimmy', '123', '123'),
(52, 'Aung Khant Zaw', 'akhantz250@gmail.com', '8849 3966', 'Aung Khant Zaw', '123', ''),
(53, 'Aung Khant Zaw', 'akhantz250@gmail.com', '88493966', 'Aung Khant Zaw', '698543', ''),
(54, 'Dave', 'dave52@gmail.com', '88776655', 'Dave', '999888', '#4-10');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MenuID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Price` decimal(4,2) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`MenuID`, `Name`, `Description`, `Price`, `Category`, `ImageURL`) VALUES
(1, 'Shrimp Scampi Pasta', '', '18.00', 'mains', 'shrimp-scampi-pasta'),
(2, 'Seafood Pasta', '', '21.00', 'mains', 'seafood-pasta'),
(3, 'Pesto Pasta', '', '14.00', 'mains', 'pesto-pasta'),
(4, 'Carbonara', '', '16.00', 'mains', 'carbonara-pasta'),
(5, 'Bolognese', '', '16.00', 'mains', 'bolognese-pasta'),
(6, 'Mushroom Risotto', '', '14.00', 'mains', 'mushroom-risotto'),
(7, 'Lasagna', '', '17.00', 'mains', 'lasagna'),
(8, 'Ravioli', '', '15.00', 'mains', 'ravioli'),
(9, 'Tomato Gnocchi', '', '15.00', 'mains', 'tomato-gnocchi'),
(10, 'Beef Tagliatelle', '', '20.00', 'mains', 'beef-tagliatelle'),
(11, 'Chicken Alfredo', '', '18.00', 'mains', 'chicken-alfredo'),
(12, 'Asparagus Salad', '', '7.00', 'starters', 'asparagus-salad'),
(13, 'Bruschetta', '', '9.00', 'starters', 'bruschetta'),
(14, 'Caprese Salad', '', '8.00', 'starters', 'caprese-salad'),
(15, 'Minestrone', '', '11.00', 'starters', 'minestrone'),
(16, 'Panzanella', '', '9.00', 'starters', 'panzanella'),
(17, 'Prosciutoo e Melone', '', '7.00', 'starters', 'prosciutto-e-melone'),
(18, 'Pappa al Pomodoro', '', '8.00', 'starters', 'pappa-al-pomodoro'),
(19, 'Baked Eggs', '', '6.00', 'starters', 'baked-eggs'),
(20, 'Salmon Carpaccio', '', '12.00', 'starters', 'salmon-carpaccio'),
(21, 'Almond Cake', '', '6.00', 'desserts', 'almond-cake'),
(22, 'Cannoli', '', '9.00', 'desserts', 'cannoli'),
(23, 'Lava Cake', '', '10.00', 'desserts', 'lava-cake'),
(24, 'Panna Cotta', '', '8.00', 'desserts', 'panna-cotta'),
(25, 'Ricotta Cheesecake', '', '9.00', 'desserts', 'ricotta-cheesecake'),
(26, 'Tiramisu', '', '10.00', 'desserts', 'tiramisu'),
(27, 'Aranciata', '', '5.00', 'drinks', 'aranciata'),
(28, 'Limonata', '', '5.00', 'drinks', 'limonata'),
(29, 'Coke', '', '3.00', 'drinks', 'coke'),
(30, 'Sprite', '', '3.00', 'drinks', 'sprite'),
(31, 'Ice Lemon Tea', '', '3.00', 'drinks', 'ice-lemon-tea'),
(32, 'Green Tea', '', '3.00', 'drinks', 'green-tea');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `OrderItemID` int(11) NOT NULL,
  `MenuID` int(11) NOT NULL,
  `OrderID` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitPrice` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`OrderItemID`, `MenuID`, `OrderID`, `Quantity`, `UnitPrice`) VALUES
(85, 5, '33', 1, '16.00'),
(86, 18, '33', 1, '8.00'),
(87, 25, '33', 1, '9.00'),
(88, 29, '33', 1, '3.00'),
(89, 5, '34', 3, '16.00'),
(90, 4, '34', 1, '16.00'),
(91, 10, '35', 3, '20.00'),
(92, 11, '35', 3, '18.00'),
(93, 7, '35', 2, '17.00'),
(94, 12, '35', 1, '7.00'),
(95, 16, '35', 1, '9.00'),
(96, 24, '35', 2, '8.00'),
(97, 25, '35', 2, '9.00'),
(98, 28, '35', 3, '5.00'),
(99, 27, '35', 3, '5.00'),
(100, 5, '36', 1, '16.00'),
(101, 21, '36', 1, '6.00'),
(102, 31, '36', 1, '3.00'),
(103, 9, '37', 1, '15.00'),
(104, 11, '37', 1, '18.00'),
(105, 13, '37', 2, '9.00'),
(106, 19, '37', 1, '6.00'),
(107, 23, '37', 1, '10.00'),
(108, 25, '37', 1, '9.00'),
(109, 28, '37', 1, '5.00'),
(110, 27, '37', 1, '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `orderprogress`
--

CREATE TABLE `orderprogress` (
  `ProgressID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Progress` int(11) NOT NULL DEFAULT 1,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `PreparationStart` datetime DEFAULT NULL,
  `DeliveryStart` datetime DEFAULT NULL,
  `DateReceived` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderprogress`
--

INSERT INTO `orderprogress` (`ProgressID`, `OrderID`, `Progress`, `DateCreated`, `PreparationStart`, `DeliveryStart`, `DateReceived`) VALUES
(1, 33, 3, '2022-11-02 23:22:39', '2022-11-03 00:23:04', '2022-11-03 00:25:04', NULL),
(2, 34, 2, '2022-11-02 23:52:36', '2022-11-02 00:01:20', NULL, NULL),
(3, 35, 1, '2022-11-03 01:19:39', NULL, NULL, NULL),
(4, 36, 1, '2022-11-03 03:13:19', NULL, NULL, NULL),
(5, 37, 1, '2022-11-03 12:29:52', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(64) NOT NULL,
  `DateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `Progress` int(8) NOT NULL DEFAULT 1,
  `TotalSale` decimal(10,2) DEFAULT NULL,
  `CustomerID` int(11) NOT NULL,
  `Instructions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `DateCreated`, `Progress`, `TotalSale`, `CustomerID`, `Instructions`) VALUES
(33, '2022-11-02 23:22:39', 1, '36.00', 50, ''),
(34, '2022-11-02 23:52:36', 1, '64.00', 51, ''),
(35, '2022-11-03 01:19:39', 1, '228.00', 52, ''),
(36, '2022-11-03 03:13:19', 1, '25.00', 53, ''),
(37, '2022-11-03 12:29:52', 1, '86.00', 54, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuID`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`OrderItemID`);

--
-- Indexes for table `orderprogress`
--
ALTER TABLE `orderprogress`
  ADD PRIMARY KEY (`ProgressID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `orderprogress`
--
ALTER TABLE `orderprogress`
  MODIFY `ProgressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
