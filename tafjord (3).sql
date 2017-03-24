-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 24. Mar, 2017 13:05 p.m.
-- Server-versjon: 5.5.54
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tafjord`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) UNSIGNED NOT NULL,
  `categoryName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`) VALUES
(1, 'Internett');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `checkout`
--

CREATE TABLE `checkout` (
  `checkOutID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL,
  `macAdresseID` int(11) UNSIGNED NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `inventory`
--

CREATE TABLE `inventory` (
  `inventoryID` int(11) UNSIGNED NOT NULL,
  `storageID` int(11) UNSIGNED NOT NULL,
  `productID` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `inventory`
--

INSERT INTO `inventory` (`inventoryID`, `storageID`, `productID`, `quantity`) VALUES
(1, 1, 1, 12),
(2, 1, 2, 6),
(3, 2, 1, 0),
(4, 1, 11, 5),
(5, 1, 12, 0),
(6, 1, 13, 8),
(7, 1, 14, 9),
(61, 2, 2, 2),
(71, 6, 12, 27),
(72, 6, 2, 25);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `logg`
--

CREATE TABLE `logg` (
  `loggID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL,
  `inventoryID` int(11) UNSIGNED NOT NULL,
  `incidentDesc` text,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `macadresse`
--

CREATE TABLE `macadresse` (
  `macAdresseID` int(11) UNSIGNED NOT NULL,
  `storageID` int(11) UNSIGNED NOT NULL,
  `productID` int(11) UNSIGNED NOT NULL,
  `macAdresse` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `media`
--

CREATE TABLE `media` (
  `mediaID` int(11) UNSIGNED NOT NULL,
  `mediaName` varchar(255) NOT NULL,
  `fileType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `media`
--

INSERT INTO `media` (`mediaID`, `mediaName`, `fileType`) VALUES
(1, 'FMGbilde', 'jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `products`
--

CREATE TABLE `products` (
  `productID` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `buyPrice` decimal(25,2) DEFAULT NULL,
  `salePrice` decimal(25,2) NOT NULL,
  `categoryID` int(11) UNSIGNED NOT NULL,
  `mediaID` int(11) UNSIGNED NOT NULL,
  `productNumber` varchar(15) DEFAULT NULL,
  `date` datetime NOT NULL,
  `macAdresse` varchar(8) DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `products`
--

INSERT INTO `products` (`productID`, `productName`, `buyPrice`, `salePrice`, `categoryID`, `mediaID`, `productNumber`, `date`, `macAdresse`) VALUES
(1, 'FMG', '999.00', '1499.00', 1, 1, 'DIV-1499', '2017-03-06 00:00:00', 'FALSE'),
(2, 'Dekoder', '599.00', '799.00', 1, 1, 'DIV-1330', '2017-03-08 00:00:00', 'FALSE'),
(11, 'Testprodukt1', '111.00', '222.00', 1, 1, 'test1', '2017-03-07 00:00:00', 'FALSE'),
(12, 'Testprodukt2', '111.00', '222.00', 1, 1, 'test2', '2017-02-21 00:00:00', 'FALSE'),
(13, 'Testprodukt3', '111.00', '222.00', 1, 1, 'test3', '2017-02-21 00:00:00', 'FALSE'),
(14, 'Testprodukt4', '111.00', '222.00', 1, 1, 'test4', '2017-02-21 00:00:00', 'FALSE'),
(15, 'Testprodukt5', '111.00', '222.00', 1, 1, 'Test5', '2017-02-21 00:00:00', 'FALSE'),
(16, 'Testprodukt6', '111.00', '222.00', 1, 1, 'Test6', '2017-02-21 00:00:00', 'FALSE'),
(17, 'Testprodukt7', '111.00', '222.00', 1, 1, 'test7', '2017-02-21 00:00:00', 'FALSE'),
(18, 'Testprodukt8', '111.00', '222.00', 1, 1, 'test8', '2017-02-21 00:00:00', 'FALSE');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `restrictions`
--

CREATE TABLE `restrictions` (
  `resID` int(11) UNSIGNED NOT NULL,
  `userID` int(11) UNSIGNED NOT NULL,
  `storageID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `restrictions`
--

INSERT INTO `restrictions` (`resID`, `userID`, `storageID`) VALUES
(7, 1, 2),
(36, 1, 1),
(37, 1, 6),
(38, 10, 2),
(39, 10, 1),
(40, 10, 6);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `returns`
--

CREATE TABLE `returns` (
  `returnID` int(11) UNSIGNED NOT NULL,
  `productID` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `customerNr` int(11) NOT NULL,
  `comment` text,
  `userID` int(11) UNSIGNED NOT NULL,
  `storageID` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dataark for tabell `returns`
--

INSERT INTO `returns` (`returnID`, `productID`, `date`, `customerNr`, `comment`, `userID`, `storageID`, `quantity`) VALUES
(2, 2, '2017-03-23', 123456, 'sadsadsad', 1, 1, 5),
(3, 2, '2017-03-23', 123, 'asdsad', 1, 2, 5),
(4, 11, '2017-03-23', 3234234, 'test', 1, 6, 15),
(5, 12, '2017-03-23', 3234234, 'test', 1, 6, 15),
(6, 13, '2017-03-23', 213213, 'asdsadsa', 1, 1, 10),
(7, 14, '2017-03-23', 213213, 'asdsadsa', 1, 1, 10),
(8, 1, '2017-03-23', 2, 'asd', 1, 1, 2),
(9, 11, '2017-03-24', 7474657, 'asdsad', 1, 1, 2),
(10, 2, '2017-03-24', 1234567, 'hmm', 1, 1, 3),
(11, 2, '2017-03-24', 1234567, 'testing', 7, 2, 5),
(12, 2, '2017-03-24', 21321321, 'asdasdsa', 7, 6, 12),
(13, 2, '2017-03-24', 123213, 'asdsadsadsadsa', 7, 6, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `sales`
--

CREATE TABLE `sales` (
  `salesID` int(11) UNSIGNED NOT NULL,
  `productID` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `customerNr` int(11) NOT NULL,
  `comment` text,
  `userID` int(11) UNSIGNED NOT NULL,
  `storageID` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `sales`
--

INSERT INTO `sales` (`salesID`, `productID`, `date`, `customerNr`, `comment`, `userID`, `storageID`, `quantity`) VALUES
(25, 2, '2017-03-24', 123, 'add', 1, 1, 12),
(26, 2, '2017-03-24', 123, 'asd', 6, 1, 2),
(27, 2, '2017-03-24', 233, 'asdasd', 1, 1, 1),
(28, 2, '2017-03-24', 1234567, 'Testing', 7, 2, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `storage`
--

CREATE TABLE `storage` (
  `storageID` int(11) UNSIGNED NOT NULL,
  `storageName` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `storage`
--

INSERT INTO `storage` (`storageID`, `storageName`) VALUES
(2, 'Hovedlager'),
(1, 'Kundesenter'),
(6, 'Testlager');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `userID` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `userLevel` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT 'tafjord.jpg',
  `lastLogin` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`userID`, `name`, `username`, `password`, `userLevel`, `image`, `lastLogin`, `email`) VALUES
(1, 'Roger Kolseth', 'rogkol', 'Test123', 'Administrator', 'tafjord.jpg', NULL, 'roger.kolseth@tafjord.no'),
(10, 'Test', 'Test', 'Test', 'User', 'tafjord.jpg', NULL, 'Test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`),
  ADD UNIQUE KEY `categoryName` (`categoryName`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkOutID`),
  ADD KEY `macAdresseID` (`macAdresseID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryID`),
  ADD KEY `storageID` (`storageID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `logg`
--
ALTER TABLE `logg`
  ADD PRIMARY KEY (`loggID`),
  ADD KEY `inventoryID` (`inventoryID`),
  ADD KEY `logg_ibfk_1` (`userID`);

--
-- Indexes for table `macadresse`
--
ALTER TABLE `macadresse`
  ADD PRIMARY KEY (`macAdresseID`),
  ADD UNIQUE KEY `macAdresse` (`macAdresse`),
  ADD KEY `storageID` (`storageID`),
  ADD KEY `productID` (`productID`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaID`),
  ADD UNIQUE KEY `mediaName` (`mediaName`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productID`),
  ADD UNIQUE KEY `productName` (`productName`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `mediaID` (`mediaID`);

--
-- Indexes for table `restrictions`
--
ALTER TABLE `restrictions`
  ADD PRIMARY KEY (`resID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `storageID` (`storageID`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`returnID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `returns_ibfk_3` (`storageID`),
  ADD KEY `returns_ibfk_2` (`userID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `sales_ibfk_3` (`storageID`),
  ADD KEY `sales_ibfk_2` (`userID`);

--
-- Indexes for table `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`storageID`),
  ADD UNIQUE KEY `storageName` (`storageName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkOutID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `logg`
--
ALTER TABLE `logg`
  MODIFY `loggID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `macadresse`
--
ALTER TABLE `macadresse`
  MODIFY `macAdresseID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `restrictions`
--
ALTER TABLE `restrictions`
  MODIFY `resID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `returnID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `storageID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`macAdresseID`) REFERENCES `macadresse` (`macAdresseID`),
  ADD CONSTRAINT `checkout_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Begrensninger for tabell `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Begrensninger for tabell `logg`
--
ALTER TABLE `logg`
  ADD CONSTRAINT `logg_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `logg_ibfk_2` FOREIGN KEY (`inventoryID`) REFERENCES `inventory` (`inventoryID`);

--
-- Begrensninger for tabell `macadresse`
--
ALTER TABLE `macadresse`
  ADD CONSTRAINT `macadresse_ibfk_1` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`),
  ADD CONSTRAINT `macadresse_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Begrensninger for tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`mediaID`) REFERENCES `media` (`mediaID`);

--
-- Begrensninger for tabell `restrictions`
--
ALTER TABLE `restrictions`
  ADD CONSTRAINT `restrictions_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `restrictions_ibfk_2` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`);

--
-- Begrensninger for tabell `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `returns_ibfk_3` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`);

--
-- Begrensninger for tabell `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
