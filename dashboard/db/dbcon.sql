-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 09:57 PM
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
-- Database: `per year database table`
--

-- --------------------------------------------------------

--
-- Table structure for table `2024-2025`
--

CREATE TABLE `2024-2025` (
  `ID` int(11) NOT NULL,
  `Alumni_ID_Number` varchar(20) NOT NULL,
  `Student_Number` varchar(20) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Middle_Name` varchar(50) DEFAULT NULL,
  `Course` varchar(100) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Section` varchar(50) NOT NULL,
  `Year_Graduated` year(4) NOT NULL,
  `Contact_Number` varchar(15) NOT NULL,
  `Personal_Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `2024-2025`
--
DELIMITER $$
CREATE TRIGGER `after_insert_2024_2025` AFTER INSERT ON `2024-2025` FOR EACH ROW BEGIN
    -- Insert a new record into 2024_2025_WS with the new Alumni_ID_Number and default Working_Status as NULL
    INSERT INTO `2024_2025_WS` (`Alumni_ID_Number`, `Working_Status`)
    VALUES (NEW.`Alumni_ID_Number`, NULL);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_alumni_id` BEFORE INSERT ON `2024-2025` FOR EACH ROW BEGIN
  -- Find the maximum existing Alumni_ID_Number and increment it
  DECLARE max_id INT;
  SELECT COALESCE(MAX(CAST(`Alumni_ID_Number` AS UNSIGNED)), 0) INTO max_id FROM `2024_2025`;
  SET NEW.`Alumni_ID_Number` = LPAD(max_id + 1, 5, '0');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `2024-2025_ws`
--

CREATE TABLE `2024-2025_ws` (
  `ID` int(11) NOT NULL,
  `Alumni_ID_Number` varchar(20) DEFAULT NULL,
  `Working_Status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `2024-2025`
--
ALTER TABLE `2024-2025`
  ADD PRIMARY KEY (`Alumni_ID_Number`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `2024-2025_ws`
--
ALTER TABLE `2024-2025_ws`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Alumni_ID_Number` (`Alumni_ID_Number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `2024-2025`
--
ALTER TABLE `2024-2025`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `2024-2025_ws`
--
ALTER TABLE `2024-2025_ws`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `2024-2025_ws`
--
ALTER TABLE `2024-2025_ws`
  ADD CONSTRAINT `2024-2025_ws_ibfk_1` FOREIGN KEY (`Alumni_ID_Number`) REFERENCES `2024-2025` (`Alumni_ID_Number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
