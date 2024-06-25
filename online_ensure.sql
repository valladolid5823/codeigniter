-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 05:37 PM
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
-- Database: `online_ensure`
--

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE IF NOT EXISTS `payrolls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_rep_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `bonus` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `sales_rep_id`, `from_date`, `to_date`, `bonus`) VALUES
(28, 1, '2024-06-25', '2024-06-25', 100),
(29, 1, '2024-06-27', '2024-06-29', 100),
(30, 2, '2024-06-25', '2024-06-25', 100),
(31, 1, '2024-06-25', '2024-06-29', 100),
(32, 3, '2024-06-01', '2024-06-29', 200),
(33, 3, '2024-06-01', '2024-06-29', 200);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_clients`
--

CREATE TABLE IF NOT EXISTS `payroll_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `commission` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll_clients`
--

INSERT INTO `payroll_clients` (`id`, `payroll_id`, `client_name`, `commission`) VALUES
(26, 28, 'asdas', 1000),
(27, 29, 'asdasd', 1000),
(28, 30, 'Client 1', 1000),
(29, 30, 'Client 2', 2000),
(30, 31, 'Client 1', 1000),
(31, 31, 'Client 2', 2000),
(32, 32, 'Client 1', 1000),
(33, 33, 'asdasd', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `sales_representatives`
--

CREATE TABLE IF NOT EXISTS `sales_representatives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `commission_percentage` float NOT NULL,
  `tax_rate` float NOT NULL,
  `bonuses` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales_representatives`
--

INSERT INTO `sales_representatives` (`id`, `name`, `commission_percentage`, `tax_rate`, `bonuses`) VALUES
(1, 'Juan Tamad', 10, 20, 30),
(2, 'John Sena', 30, 20, 10),
(3, 'Suman Makapal', 60, 20, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$OXw5Jg4ELazlKF64Tv8o9OoUapUYOc9QR4mj6FJrgP2BNkHpeCoQ.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
