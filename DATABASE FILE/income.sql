-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 01, 2024 at 06:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dailyexpense`
--

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `income` int NOT NULL,
  `incomedate` varchar(15) NOT NULL,
  `incomecategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`income_id`, `user_id`, `income`, `incomedate`, `incomecategory`) VALUES
(5, '7', 900, '2022-01-24', 'Operating Income'),
(6, '7', 1000, '2022-02-24', 'Operating Income'),
(9, '7', 1100, '2022-05-24', 'Non-Operating Income'),
(11, '7', 500, '2022-07-24', 'Operating Income'),
(12, '7', 1500, '2022-08-24', 'Operating Income'),
(13, '7', 400, '2022-10-24', 'Non-Operating Income'),
(14, '7', 1600, '2022-10-24', 'Non-Operating Income'),
(16, '7', 500, '2022-12-24', 'Non-Operating Income'),
(17, '7', 1000, '2023-01-24', 'Operating Income'),
(18, '7', 1200, '2023-02-24', 'Operating Income'),
(19, '7', 500, '2023-03-24', 'Non-Operating Income'),
(20, '7', 1500, '2024-01-01', 'Non-Operating Income'),
(21, '7', 1200, '2024-01-01', 'Operating Income'),
(23, '7', 1300, '2024-01-01', 'Non-Operating Income'),
(24, '7', 1400, '2024-01-02', 'Operating Income');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
