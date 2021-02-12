-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 09:17 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandetb`
--

CREATE TABLE `commandetb` (
  `ID_cmd` int(11) NOT NULL,
  `numero_cmd` int(11) NOT NULL,
  `date_cmd` varchar(25) DEFAULT NULL,
  `ID_f` int(11) NOT NULL,
  `ID_marche` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commandetb`
--

INSERT INTO `commandetb` (`ID_cmd`, `numero_cmd`, `date_cmd`, `ID_f`, `ID_marche`) VALUES
(6, 1, '2021-01-30 12:46:46', 1, 1),
(7, 1, '2021-01-30 12:46:56', 2, 1),
(8, 1, '2021-01-30 12:47:02', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurtb`
--

CREATE TABLE `fournisseurtb` (
  `ID_f` int(11) NOT NULL,
  `nomF` varchar(50) DEFAULT NULL,
  `adrF` varchar(255) DEFAULT NULL,
  `telF` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fournisseurtb`
--

INSERT INTO `fournisseurtb` (`ID_f`, `nomF`, `adrF`, `telF`) VALUES
(1, 'soc 1', '18 rue taroudante hay takna', '0668938675'),
(2, 'soc2', '18 rue taroudante hay takna', '0668938675'),
(3, 'soc3', '18 rue taroudante hay takna', '0668938675'),
(4, 'Hicham Boulban', '18 rue taroudante hay takna', '0668938675');

-- --------------------------------------------------------

--
-- Table structure for table `lignecommandetb`
--

CREATE TABLE `lignecommandetb` (
  `ID_cmd` int(11) NOT NULL,
  `ref_produit` int(11) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lignecommandetb`
--

INSERT INTO `lignecommandetb` (`ID_cmd`, `ref_produit`, `qte`) VALUES
(6, 1, 5),
(6, 2, 8),
(7, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `marchetb`
--

CREATE TABLE `marchetb` (
  `ID_marche` int(11) NOT NULL,
  `objet_marche` varchar(500) DEFAULT NULL,
  `mode_lancement` varchar(25) DEFAULT NULL,
  `date_lancement` varchar(25) NOT NULL,
  `heure_lancement` varchar(25) NOT NULL,
  `date_limite` varchar(25) NOT NULL,
  `heure_limite` varchar(25) NOT NULL,
  `date_ouverture` varchar(25) NOT NULL,
  `heure_ouverture` varchar(25) NOT NULL,
  `date_depot` varchar(25) NOT NULL,
  `heure_depot` varchar(25) NOT NULL,
  `date_reciption` varchar(25) NOT NULL,
  `heure_reciption` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marchetb`
--

INSERT INTO `marchetb` (`ID_marche`, `objet_marche`, `mode_lancement`, `date_lancement`, `heure_lancement`, `date_limite`, `heure_limite`, `date_ouverture`, `heure_ouverture`, `date_depot`, `heure_depot`, `date_reciption`, `heure_reciption`) VALUES
(1, 'marcher numero1', 'objetma', '9/21/2020', '09:53', '9/21/2020', '09:53', '9/21/2020', '09:53', '9/21/2020', '09:53', '9/21/2020', '09:53');

-- --------------------------------------------------------

--
-- Table structure for table `produittb`
--

CREATE TABLE `produittb` (
  `ref_produit` int(11) NOT NULL,
  `designation_produit` varchar(500) DEFAULT NULL,
  `pu` float DEFAULT NULL,
  `ID_u` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produittb`
--

INSERT INTO `produittb` (`ref_produit`, `designation_produit`, `pu`, `ID_u`) VALUES
(1, 'Livraison et changement des poignes des portes', 8000, 1),
(2, 'aaaaaa', 5.5, 1),
(3, 'bbbbb', 5.5, 1),
(4, 'qqqqq', 5.5, 1),
(5, 'wwwwwwwww', 5.5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reuniontb`
--

CREATE TABLE `reuniontb` (
  `ID_r` int(11) NOT NULL,
  `presedent` varchar(25) DEFAULT NULL,
  `membre1` varchar(25) DEFAULT NULL,
  `membre2` varchar(25) DEFAULT NULL,
  `date_reunion` varchar(25) NOT NULL,
  `heure_reunion` varchar(25) NOT NULL,
  `ID_marcher` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reuniontb`
--

INSERT INTO `reuniontb` (`ID_r`, `presedent`, `membre1`, `membre2`, `date_reunion`, `heure_reunion`, `ID_marcher`) VALUES
(1, 'Yassine Hnini', 'Elhoucine Addi', 'Hicham Boullban', '14/10/2020', '9:57', 1),
(2, 'Yassine Hnini', 'Elhoucine Addi', 'Khalid88', '10/07/2020', '8:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `unitetb`
--

CREATE TABLE `unitetb` (
  `ID_u` int(11) NOT NULL,
  `unite` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unitetb`
--

INSERT INTO `unitetb` (`ID_u`, `unite`) VALUES
(1, 'u');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userEmail` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userEmail`, `password`) VALUES
(1, 'hicham.boulban@gmail.com', '0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commandetb`
--
ALTER TABLE `commandetb`
  ADD PRIMARY KEY (`ID_cmd`),
  ADD KEY `societe_fk` (`ID_f`),
  ADD KEY `marche_fk` (`ID_marche`);

--
-- Indexes for table `fournisseurtb`
--
ALTER TABLE `fournisseurtb`
  ADD PRIMARY KEY (`ID_f`);

--
-- Indexes for table `lignecommandetb`
--
ALTER TABLE `lignecommandetb`
  ADD PRIMARY KEY (`ID_cmd`,`ref_produit`),
  ADD KEY `cons_produittb` (`ref_produit`);

--
-- Indexes for table `marchetb`
--
ALTER TABLE `marchetb`
  ADD PRIMARY KEY (`ID_marche`);

--
-- Indexes for table `produittb`
--
ALTER TABLE `produittb`
  ADD PRIMARY KEY (`ref_produit`),
  ADD KEY `produittb_ibfk_1` (`ID_u`);

--
-- Indexes for table `reuniontb`
--
ALTER TABLE `reuniontb`
  ADD PRIMARY KEY (`ID_r`),
  ADD KEY `marcher1_fk` (`ID_marcher`);

--
-- Indexes for table `unitetb`
--
ALTER TABLE `unitetb`
  ADD PRIMARY KEY (`ID_u`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandetb`
--
ALTER TABLE `commandetb`
  MODIFY `ID_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fournisseurtb`
--
ALTER TABLE `fournisseurtb`
  MODIFY `ID_f` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `marchetb`
--
ALTER TABLE `marchetb`
  MODIFY `ID_marche` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produittb`
--
ALTER TABLE `produittb`
  MODIFY `ref_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reuniontb`
--
ALTER TABLE `reuniontb`
  MODIFY `ID_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unitetb`
--
ALTER TABLE `unitetb`
  MODIFY `ID_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandetb`
--
ALTER TABLE `commandetb`
  ADD CONSTRAINT `marche_fk` FOREIGN KEY (`ID_marche`) REFERENCES `marchetb` (`ID_marche`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `societe_fk` FOREIGN KEY (`ID_f`) REFERENCES `fournisseurtb` (`ID_f`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lignecommandetb`
--
ALTER TABLE `lignecommandetb`
  ADD CONSTRAINT `cons_commandetb` FOREIGN KEY (`ID_cmd`) REFERENCES `commandetb` (`ID_cmd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cons_produittb` FOREIGN KEY (`ref_produit`) REFERENCES `produittb` (`ref_produit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produittb`
--
ALTER TABLE `produittb`
  ADD CONSTRAINT `produittb_ibfk_1` FOREIGN KEY (`ID_u`) REFERENCES `unitetb` (`ID_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reuniontb`
--
ALTER TABLE `reuniontb`
  ADD CONSTRAINT `marcher1_fk` FOREIGN KEY (`ID_marcher`) REFERENCES `marchetb` (`ID_marche`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
