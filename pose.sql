-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2025 at 09:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `robot_actions`
--

-- --------------------------------------------------------

--
-- Table structure for table `pose`
--

CREATE TABLE `pose` (
  `id` int(11) NOT NULL,
  `servo1` int(11) NOT NULL,
  `servo2` int(11) NOT NULL,
  `servo3` int(11) NOT NULL,
  `servo4` int(11) NOT NULL,
  `servo5` int(11) NOT NULL,
  `servo6` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pose`
--

INSERT INTO `pose` (`id`, `servo1`, `servo2`, `servo3`, `servo4`, `servo5`, `servo6`) VALUES
(1, 126, 140, 68, 115, 166, 117),
(2, 105, 105, 90, 90, 110, 111),
(5, 75, 75, 112, 119, 115, 112),
(9, 180, 180, 180, 180, 180, 180),
(10, 66, 64, 40, 24, 115, 170);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pose`
--
ALTER TABLE `pose`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pose`
--
ALTER TABLE `pose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
