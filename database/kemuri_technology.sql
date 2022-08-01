-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2022 at 12:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kemuri_technology`
--

-- --------------------------------------------------------

--
-- Table structure for table `stock_list`
--

CREATE TABLE `stock_list` (
  `id` bigint(20) NOT NULL,
  `stock_date` date NOT NULL,
  `stock_name` varchar(255) NOT NULL,
  `stock_price` float(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_list`
--

INSERT INTO `stock_list` (`id`, `stock_date`, `stock_name`, `stock_price`) VALUES
(1, '2020-02-11', 'AAPL', 320.00),
(2, '2020-02-11', 'GOOGL', 1510.00),
(3, '2020-02-11', 'MSFT', 185.00),
(4, '2020-02-12', 'GOOGL', 1518.00),
(5, '2020-02-12', 'MSFT', 184.00),
(6, '2020-02-13', 'AAPL', 324.00),
(7, '2020-02-14', 'GOOGL', 1520.00),
(8, '2020-02-15', 'AAPL', 319.00),
(9, '2020-02-15', 'GOOGL', 1523.00),
(10, '2020-02-15', 'MSFT', 189.00),
(11, '2020-02-16', 'GOOGL', 1530.00),
(12, '2020-02-18', 'AAPL', 319.00),
(13, '2020-02-18', 'MSFT', 187.00),
(14, '2020-02-19', 'AAPL', 323.00),
(15, '2020-02-21', 'AAPL', 313.00),
(16, '2020-02-21', 'GOOGL', 1483.00),
(17, '2020-02-21', 'MSFT', 178.00),
(18, '2020-02-22', 'GOOGL', 1485.00),
(19, '2020-02-22', 'MSFT', 180.00),
(20, '2020-02-23', 'AAPL', 320.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stock_list`
--
ALTER TABLE `stock_list`
  ADD PRIMARY KEY (`id`,`stock_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stock_list`
--
ALTER TABLE `stock_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
