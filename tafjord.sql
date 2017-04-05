-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 05. Apr, 2017 21:16 PM
-- Server-versjon: 10.1.19-MariaDB
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
(2, 'Internett'),
(4, 'testing'),
(3, 'TV');

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
-- Triggere `inventory`
--
DELIMITER $$
CREATE TRIGGER `removeProFromStorage_Logg` BEFORE DELETE ON `inventory` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.fromStorageID, logg.userID, logg.productID, logg.quantity, logg.date) VALUES ('Sletting', 'Fjernet produkt fra', OLD.storageID, @sessionUserID, OLD.productID, OLD.quantity, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `logg`
--

CREATE TABLE `logg` (
  `loggID` int(11) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `storageID` int(11) UNSIGNED DEFAULT NULL,
  `fromStorageID` int(11) UNSIGNED DEFAULT NULL,
  `toStorageID` int(11) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `oldQuantity` int(11) DEFAULT NULL,
  `newQuantity` int(11) DEFAULT NULL,
  `differential` int(11) DEFAULT NULL,
  `userID` int(11) UNSIGNED DEFAULT NULL,
  `onUserID` int(11) UNSIGNED DEFAULT NULL,
  `productID` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `customerNr` int(11) DEFAULT NULL
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
  `categoryID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `media`
--

INSERT INTO `media` (`mediaID`, `mediaName`, `categoryID`) VALUES
(21, 'defaultUser.png', 4),
(22, 'Boston City Flow.jpg', 2),
(23, 'fugl.jpg', 2),
(25, 'Costa Rican Frog.jpg', 4);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `products`
--

CREATE TABLE `products` (
  `productID` int(11) UNSIGNED NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` decimal(25,2) DEFAULT NULL,
  `categoryID` int(11) UNSIGNED NOT NULL,
  `mediaID` int(11) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `macAdresse` varchar(8) DEFAULT 'FALSE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggere `products`
--
DELIMITER $$
CREATE TRIGGER `createProduct_Logg` AFTER INSERT ON `products` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.userID, logg.productID, logg.date) VALUES ('Opprettelse', 'Nytt produkt', @sessionUserID, NEW.productID, NOW());
END
$$
DELIMITER ;

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
(80, 27, 1),
(84, 27, 63);

--
-- Triggere `restrictions`
--
DELIMITER $$
CREATE TRIGGER `createRestriction_Logg` AFTER INSERT ON `restrictions` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.storageID, logg.userID, logg.onUserID, logg.date) VALUES ('Tilgang', 'Gav tilgang til', NEW.storageID, @sessionUserID, NEW.userID, NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `removeRestriction_Logg` BEFORE DELETE ON `restrictions` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.storageID, logg.userID, logg.onUserID, logg.date) VALUES ('Tilgang', 'Fjernet tilgang til', OLD.storageID, @sessionUserID, OLD.userID, NOW());
END
$$
DELIMITER ;

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
-- Triggere `returns`
--
DELIMITER $$
CREATE TRIGGER `newReturn_Logg` AFTER INSERT ON `returns` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.toStorageID, logg.quantity, logg.productID, logg.userID, logg.customerNr, logg.date) VALUES ('Retur', 'Tok inn produkt til', NEW.storageID, NEW.quantity, NEW.productID, NEW.userID, NEW.customerNr, NOW());
END
$$
DELIMITER ;

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
-- Triggere `sales`
--
DELIMITER $$
CREATE TRIGGER `newSale_Logg` AFTER INSERT ON `sales` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.fromStorageID, logg.quantity, logg.productID, logg.userID, logg.customerNr, logg.date) VALUES ('Uttak', 'Tok ut produkt fra', NEW.storageID, NEW.quantity, NEW.productID, NEW.userID, NEW.customerNr, NOW());
END
$$
DELIMITER ;

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
(1, 'Hovedlager'),
(63, 'Kundesenter');

--
-- Triggere `storage`
--
DELIMITER $$
CREATE TRIGGER `createStorage_Logg` AFTER INSERT ON `storage` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.storageID, logg.userID, logg.date) VALUES ('Opprettelse', 'Nytt lager', NEW.storageID, @sessionUserID, NOW());
END
$$
DELIMITER ;

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
  `mediaID` int(11) UNSIGNED DEFAULT NULL,
  `lastLogin` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`userID`, `name`, `username`, `password`, `userLevel`, `mediaID`, `lastLogin`, `email`) VALUES
(27, 'Roger Kolesth', 'rogkol', 'test123', 'Administrator', 21, '2017-04-05', 'roger.kolseth@gmail.com');

--
-- Triggere `users`
--
DELIMITER $$
CREATE TRIGGER `createUser_Logg` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    INSERT INTO logg (logg.type, logg.desc, logg.userID, logg.onUserID, logg.date) VALUES ('Opprettelse', 'Ny bruker', @sessionUserID, NEW.userID, NOW());
END
$$
DELIMITER ;

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
  ADD KEY `logg_ibfk_1` (`userID`),
  ADD KEY `logg_ibfk_2` (`storageID`),
  ADD KEY `logg_ibfk_3` (`fromStorageID`),
  ADD KEY `logg_ibfk_4` (`toStorageID`),
  ADD KEY `logg_ibfk_5` (`onUserID`),
  ADD KEY `logg_ibfk_6` (`productID`);

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
  ADD UNIQUE KEY `mediaName` (`mediaName`),
  ADD KEY `media_ibfk_2` (`categoryID`);

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
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `users_ibfk_2` (`mediaID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkOutID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT for table `logg`
--
ALTER TABLE `logg`
  MODIFY `loggID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `macadresse`
--
ALTER TABLE `macadresse`
  MODIFY `macAdresseID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `restrictions`
--
ALTER TABLE `restrictions`
  MODIFY `resID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `returnID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `storage`
--
ALTER TABLE `storage`
  MODIFY `storageID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
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
  ADD CONSTRAINT `logg_ibfk_2` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`),
  ADD CONSTRAINT `logg_ibfk_3` FOREIGN KEY (`fromStorageID`) REFERENCES `storage` (`storageID`),
  ADD CONSTRAINT `logg_ibfk_4` FOREIGN KEY (`toStorageID`) REFERENCES `storage` (`storageID`),
  ADD CONSTRAINT `logg_ibfk_5` FOREIGN KEY (`onUserID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `logg_ibfk_6` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Begrensninger for tabell `macadresse`
--
ALTER TABLE `macadresse`
  ADD CONSTRAINT `macadresse_ibfk_1` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`),
  ADD CONSTRAINT `macadresse_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`);

--
-- Begrensninger for tabell `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_ibfk_2` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`);

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
  ADD CONSTRAINT `returns_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `returns_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `returns_ibfk_3` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`);

--
-- Begrensninger for tabell `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `products` (`productID`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`storageID`) REFERENCES `storage` (`storageID`);

--
-- Begrensninger for tabell `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`mediaID`) REFERENCES `media` (`mediaID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
