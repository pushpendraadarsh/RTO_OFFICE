-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 06:34 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rtoproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `dealerclientdata`
--

CREATE TABLE `dealerclientdata` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(100) NOT NULL,
  `certificateno` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `mobno` varchar(11) NOT NULL,
  `address` text NOT NULL,
  `vehicalregistrationno` varchar(55) NOT NULL,
  `chasisno` text NOT NULL,
  `engineno` text NOT NULL,
  `rotorsealno` text NOT NULL,
  `model` text NOT NULL,
  `approvalno` text NOT NULL,
  `speed` text NOT NULL,
  `vehicalmanufactureyear` text NOT NULL,
  `vehicalcategory` text NOT NULL,
  `modelno` text NOT NULL,
  `serialno` text NOT NULL,
  `invoiceno` text NOT NULL,
  `invoicedate` text NOT NULL,
  `rtostate` text NOT NULL,
  `rto` text NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealerdemographicdata`
--

CREATE TABLE `dealerdemographicdata` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `img` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `position` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dealerdemographicdata`
--

INSERT INTO `dealerdemographicdata` (`id`, `dealer_id`, `password`, `firstName`, `lastName`, `img`, `email`, `address`, `status`, `position`) VALUES
(2, 'admin', '12345', 'Administration', '', '', 'admin@auto.com', '', 'active', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `dealerfinancialdata`
--

CREATE TABLE `dealerfinancialdata` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(60) NOT NULL,
  `quantity` varchar(10) NOT NULL,
  `method` varchar(20) NOT NULL,
  `datetime` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dealerclientdata`
--
ALTER TABLE `dealerclientdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealerdemographicdata`
--
ALTER TABLE `dealerdemographicdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealerfinancialdata`
--
ALTER TABLE `dealerfinancialdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dealerclientdata`
--
ALTER TABLE `dealerclientdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1268;

--
-- AUTO_INCREMENT for table `dealerdemographicdata`
--
ALTER TABLE `dealerdemographicdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `dealerfinancialdata`
--
ALTER TABLE `dealerfinancialdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
