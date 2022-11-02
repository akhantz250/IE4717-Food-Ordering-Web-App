-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 02, 2022 at 10:17 AM
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
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `OrderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
