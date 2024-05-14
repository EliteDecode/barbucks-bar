-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 09:13 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barbucks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `AdminId` varchar(255) NOT NULL,
  `Pwd` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Role` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Verified` tinyint(1) NOT NULL,
  `Main` tinyint(4) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Fullname`, `AdminId`, `Pwd`, `Phone`, `Role`, `Gender`, `Verified`, `Main`, `DateReg`) VALUES
(1, 'Elite Biigie', 'admin', 'admin', '0901029021', 'all', 'male', 1, 1, '2023-08-02 08:11:11'),
(2, 'Gospel Jonathan', 'sirelite11@gmail.com', '1234', '09010707383', 'barrol', 'male', 1, 0, '2023-08-02 07:53:59'),
(3, 'John Doe', 'Johndoe@gmail.com', '1234', '07030548630', 'bottle_service', 'female', 1, 0, '2023-08-02 08:42:24'),
(4, 'Blek Sandy', 'bleksandy@gail.com', '1234', '07030548630', 'liquor_room', 'male', 1, 0, '2023-08-02 08:43:02'),
(5, 'Ahmed John', 'ahmed@gail.com', '1234', '09010707383', 'inventory', 'male', 1, 0, '2023-08-02 08:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `beers`
--

CREATE TABLE `beers` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Price_per_can` varchar(255) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beers`
--

INSERT INTO `beers` (`id`, `Product`, `Price_per_can`, `Price_of_drink`, `DateReg`) VALUES
(3, 'Formular', '2', '5', '2023-02-04 10:17:35'),
(4, 'Ultra Beer', '2.40', '7', '2023-02-04 10:24:10'),
(5, 'Heinken', '2.7', '7', '2023-02-04 10:24:56'),
(6, 'Corona', '2.40', '7', '2023-02-04 10:25:51'),
(7, 'Budlight', '1.9', '5', '2023-02-04 10:26:13'),
(8, 'Stella', '2.25', '7', '2023-02-04 10:27:11'),
(9, 'Budweiser', '1.9', '5', '2023-02-04 10:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL,
  `Total` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` (`id`, `Total`) VALUES
(1, 'Budweiser'),
(2, '1.9'),
(3, '0'),
(4, '5'),
(5, '0'),
(6, '0'),
(7, '0');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Quantity` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `Price_per_can` varchar(255) NOT NULL,
  `Empty` tinyint(4) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `Product`, `Type`, `Quantity`, `Category`, `Price_of_drink`, `Price_per_can`, `Empty`, `DateReg`) VALUES
(43, 'Jose Cuervo', '40', '39751', 'Liquor', '100', '2.25', 0, '2023-08-15 15:01:46'),
(44, 'Jose silver', '26', '27957', 'Liquor', '100', '1.9', 0, '2023-08-15 15:01:46'),
(45, 'Smirnoff', '26', '39878', 'Liquor', '100', '1.9', 0, '2023-07-31 18:03:44'),
(46, 'Canadian Club', '26', '40073', 'Liquor', '100', '1.9', 0, '2023-08-15 09:28:50'),
(48, 'Ciroc', '40', '18786', 'Liquor', '100', '1.9', 0, '2023-08-07 23:02:11'),
(49, 'Grey Goose', '26', '38906', 'Liquor', '100', '1.9', 0, '2023-08-01 21:46:05'),
(50, 'Grey Goose', '40', '29637', 'Liquor', '10', '1.3', 0, '2023-08-01 21:46:27'),
(51, 'Captain Morgan', '40', '39984', 'Liquor', '10', '1.3', 0, '2023-08-05 20:57:09'),
(52, 'Don Julio', '40', '39902', 'Liquor', '10', '1.3', 0, '2023-08-15 14:43:08'),
(53, 'Don Julio 1942', '40', '39622', 'Liquor', '10', '1.3', 0, '2023-07-31 18:05:33'),
(54, 'Hennessy', '40', '40004', 'Liquor', '10', '1.3', 0, '2023-08-15 09:05:46'),
(55, 'Hennessy', '26', '39810', 'Liquor', '10', '1.3', 0, '2023-08-01 21:45:21'),
(56, 'Hennessy VSOP', '26', '39582', 'Liquor', '10', '1.3', 0, '2023-08-15 09:05:46'),
(57, 'Hennessy VSOP', '40', '31649', 'Liquor', '10', '1.3', 0, '2023-08-07 23:24:21'),
(58, 'Hennessy XO', '40', '39209', 'Liquor', '10', '1.3', 0, '2023-08-15 09:05:46'),
(59, 'Jack Daniels', '40', '38564', 'Liquor', '10', '1.3', 0, '2023-08-05 20:57:09'),
(60, 'Vodka', '40', '39810', 'Liquor', '10', '1.3', 0, '2023-08-07 23:07:23'),
(61, 'Budweiser', 'null', '79029', 'Beer', '10', '1.3', 0, '2023-08-14 23:34:35'),
(62, 'Budlight', '40', '39951', 'Beer', '10', '1.3', 0, '2023-07-24 19:04:50'),
(63, 'Blue', '40', '39982', 'Beer', '10', '1.3', 0, '2023-07-24 18:57:12'),
(64, 'Coors', '40', '39981', 'Beer', '10', '1.3', 0, '2023-03-11 18:31:49'),
(65, 'Ultra Beer', '40', '39970', 'Beer', '10', '1.3', 0, '2023-03-11 18:31:49'),
(66, 'Stella', '40', '39974', 'Beer', '10', '1.3', 0, '2023-03-11 18:31:49'),
(67, 'Corona', '40', '39974', 'Beer', '10', '1.3', 0, '2023-03-11 18:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `liquors`
--

CREATE TABLE `liquors` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Price_per_can` varchar(255) NOT NULL,
  `Weight_of_bottle` varchar(100) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liquors`
--

INSERT INTO `liquors` (`id`, `Product`, `Price_per_can`, `Weight_of_bottle`, `Price_of_drink`, `DateReg`) VALUES
(4, 'Vodka (Smirnoffs)', '1.3', '0', '7.25', '2023-02-04 10:34:18'),
(5, 'Rum ( Captain Morgan)', '1.18', '0', '7.25', '2023-02-04 10:35:25'),
(6, 'Tequila ( Jose Cuervo)', '1.60', '0', '7.25', '2023-02-04 10:35:48'),
(7, 'Jagermeister', '1.55', '0', '10', '2023-02-04 10:36:13'),
(8, 'Hennessy', '2.90', '0', '9.5', '2023-02-04 10:36:30'),
(9, 'Gin', '1.3', '0', '7.25', '2023-02-04 10:36:48'),
(10, 'Yellow', '0.83', '0', '7.25', '2023-02-04 10:37:06'),
(11, 'Blue', '0.83', '0', '7.25', '2023-02-04 10:37:25'),
(12, 'Red', '0.92', '0', '7.25', '2023-02-04 10:37:45'),
(13, 'Fireball', '0.84', '0', '7.25', '2023-02-04 10:38:03'),
(14, 'Ciroc', '1.88', '0', '7.25', '2023-02-04 10:38:29'),
(15, 'Vodka', '1.9', '0', '7.25', '2023-08-05 20:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `night_bottle_service`
--

CREATE TABLE `night_bottle_service` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `Bottles_sold` varchar(255) NOT NULL,
  `Bottles_sold_deal` varchar(255) NOT NULL,
  `Price_of_drink_deal` varchar(255) NOT NULL,
  `Total_profit` varchar(255) NOT NULL,
  `Profit_attendant` varchar(255) NOT NULL,
  `Profit_company` varchar(255) NOT NULL,
  `BarID` varchar(255) NOT NULL,
  `Bar` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `night_bottle_service`
--

INSERT INTO `night_bottle_service` (`id`, `Product`, `Type`, `Price_of_drink`, `Bottles_sold`, `Bottles_sold_deal`, `Price_of_drink_deal`, `Total_profit`, `Profit_attendant`, `Profit_company`, `BarID`, `Bar`, `DateReg`) VALUES
(521, 'Ciroc', '40', '100', '100', '100', '122', '22200', '2886', '19314', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(522, 'Jose Cuervo', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(524, 'Captain Morgan', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(525, 'Don Julio', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(526, 'Hennessy', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(527, 'Hennessy VSOP', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(528, 'Jack Daniels', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(529, 'Grey Goose', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(530, 'Hennessy XO', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(531, 'Grey Goose', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(532, 'Vodka', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(533, 'Hennessy', '26', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(534, 'Hennessy VSOP', '26', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(535, 'Canadian Club', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(536, 'Don Julio 1942', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(537, 'Smirnoff', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(538, 'Budweiser', 'null', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(539, 'Budlight', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(540, 'Blue', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(541, 'Coors', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(542, 'Ultra Beer', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(543, 'Stella', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(544, 'Corona', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(545, 'Jose silver', '26', '100', '200', '0', '0', '20000', '2600', '17400', 'Jenny123', 'bar1', '2023-08-07 23:00:00'),
(546, 'Hennessy VSOP', '40', '10', '100', '0', '0', '1000', '130', '870', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(547, 'Vodka', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(548, 'Jose silver', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(549, 'Ciroc', '40', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(550, 'Jose Cuervo', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(551, 'Captain Morgan', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(552, 'Don Julio', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(553, 'Hennessy', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(554, 'Jack Daniels', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(555, 'Grey Goose', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(556, 'Hennessy XO', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(557, 'Grey Goose', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(558, 'Hennessy', '26', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(559, 'Hennessy VSOP', '26', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(560, 'Canadian Club', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(561, 'Don Julio 1942', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(562, 'Smirnoff', '26', '100', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(563, 'Budweiser', 'null', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(564, 'Budlight', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(565, 'Blue', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(566, 'Coors', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(567, 'Ultra Beer', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(568, 'Stella', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00'),
(569, 'Corona', '40', '10', '0', '0', '0', '0', '0', '0', 'Jenny123', '<br />\n<b>Notice</b>:  Undefined variable: bar in <b>C:\\xampp\\htdocs\\barbucks\\night_bottle_service.php</b> on line <b>292</b><br />\n', '2023-08-07 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `presales_bottle_service`
--

CREATE TABLE `presales_bottle_service` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `Bottles_sold` varchar(255) NOT NULL,
  `Bottles_sold_deal` varchar(255) NOT NULL,
  `Price_of_drink_deal` varchar(255) NOT NULL,
  `Total_profit` varchar(255) NOT NULL,
  `Profit_attendant` varchar(255) NOT NULL,
  `Profit_company` varchar(255) NOT NULL,
  `BarID` varchar(255) NOT NULL,
  `Bar` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `saved_data`
--

CREATE TABLE `saved_data` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Price_per_can` varchar(255) NOT NULL,
  `Quantity_Before` varchar(255) NOT NULL,
  `Quantity_After` varchar(255) NOT NULL,
  `Bottles_sold` varchar(255) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `Gross_sale` varchar(255) NOT NULL,
  `Cog_used` varchar(255) NOT NULL,
  `Profit` varchar(255) NOT NULL,
  `Total_profit` varchar(255) NOT NULL,
  `BarID` varchar(255) NOT NULL,
  `Bar` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_data`
--

INSERT INTO `saved_data` (`id`, `Product`, `Price_per_can`, `Quantity_Before`, `Quantity_After`, `Bottles_sold`, `Price_of_drink`, `Gross_sale`, `Cog_used`, `Profit`, `Total_profit`, `BarID`, `Bar`, `DateReg`) VALUES
(473, 'Budweiser', '1.3', '100', '65', '35', '10', '350', '45.5', '304.50', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00'),
(474, 'Budlight', '1.3', '0', '0', '0', '10', '0', '0', '0', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00'),
(475, 'Blue', '1.3', '0', '0', '0', '10', '0', '0', '0', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00'),
(476, 'Coors', '1.3', '0', '0', '0', '10', '0', '0', '0', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00'),
(477, 'Ultra Beer', '1.3', '0', '0', '0', '10', '0', '0', '0', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00'),
(478, 'Stella', '1.3', '0', '0', '0', '10', '0', '0', '0', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00'),
(479, 'Corona', '1.3', '0', '0', '0', '10', '0', '0', '0', '304.50', 'Harris200', 'bar2', '2023-08-14 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `saved_data_liquor`
--

CREATE TABLE `saved_data_liquor` (
  `id` int(11) NOT NULL,
  `Product` varchar(255) NOT NULL,
  `Price_per_can` varchar(255) NOT NULL,
  `Bottles_sold` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Quantity_before` varchar(255) NOT NULL,
  `Quantity_after` varchar(255) NOT NULL,
  `Quantity_before_ounce` varchar(255) NOT NULL,
  `Quantity_after_ounce` varchar(255) NOT NULL,
  `Quantity_last_bottle` varchar(255) NOT NULL,
  `Quantity_last_bottle_ounce` varchar(255) NOT NULL,
  `Total_quantity` varchar(255) NOT NULL,
  `Price_of_drink` varchar(255) NOT NULL,
  `Gross_sale` varchar(255) NOT NULL,
  `Cog_used` varchar(255) NOT NULL,
  `Profit` varchar(255) NOT NULL,
  `Total_profit` varchar(255) NOT NULL,
  `BarID` varchar(255) NOT NULL,
  `Bar` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_data_liquor`
--

INSERT INTO `saved_data_liquor` (`id`, `Product`, `Price_per_can`, `Bottles_sold`, `Category`, `Quantity_before`, `Quantity_after`, `Quantity_before_ounce`, `Quantity_after_ounce`, `Quantity_last_bottle`, `Quantity_last_bottle_ounce`, `Total_quantity`, `Price_of_drink`, `Gross_sale`, `Cog_used`, `Profit`, `Total_profit`, `BarID`, `Bar`, `DateReg`) VALUES
(531, 'Jose Cuervo', '2.25', '200', '40', '2000', '10', '50', '0.25', '90', '2.25', '249.75', '100', '624.375', '14.0484375', '610.33', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(532, 'Jose silver', '1.9', '500', '26', '2345', '566', '90.192307692308', '21.769230769231', '345', '13.269230769231', '568.42307692308', '100', '2186.242603550296', '41.538609467455615', '2144.70', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(533, 'Smirnoff', '1.9', '0', '26', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(534, 'Canadian Club', '1.9', '0', '26', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(535, 'Ciroc', '1.9', '0', '40', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(536, 'Grey Goose', '1.9', '0', '26', '0', '0', '0', '0', '0', '0', '0', '100', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(537, 'Grey Goose', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(538, 'Captain Morgan', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(539, 'Don Julio', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(540, 'Don Julio 1942', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(541, 'Hennessy', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(542, 'Hennessy', '1.3', '0', '26', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(543, 'Hennessy VSOP', '1.3', '0', '26', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(544, 'Hennessy VSOP', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(545, 'Hennessy XO', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(546, 'Jack Daniels', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(547, 'Vodka', '1.3', '0', '40', '0', '0', '0', '0', '0', '0', '0', '10', '0', '0', '0', '2755.03', 'Harris200', 'bar1', '2023-08-14 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `saved_data_shooters`
--

CREATE TABLE `saved_data_shooters` (
  `id` int(11) NOT NULL,
  `P1_Product` varchar(255) NOT NULL,
  `P1_Category` varchar(255) NOT NULL,
  `P1_Quantity_Before` varchar(255) NOT NULL,
  `P1_Quantity_After` varchar(255) NOT NULL,
  `P1_Quantity` varchar(255) NOT NULL,
  `P2_Product` varchar(255) NOT NULL,
  `P2_Category` varchar(255) NOT NULL,
  `P2_Quantity_Before` varchar(255) NOT NULL,
  `P2_Quantity_After` varchar(255) NOT NULL,
  `P2_Quantity` varchar(255) NOT NULL,
  `P3_Product` varchar(255) NOT NULL,
  `P3_Category` varchar(255) NOT NULL,
  `P3_Quantity_Before` varchar(255) NOT NULL,
  `P3_Quantity_After` varchar(255) NOT NULL,
  `P3_Quantity` varchar(255) NOT NULL,
  `P1_Quantity_Ounce` varchar(255) NOT NULL,
  `P2_Quantity_Ounce` varchar(255) NOT NULL,
  `P3_Quantity_Ounce` varchar(255) NOT NULL,
  `Total_Quantity` varchar(255) NOT NULL,
  `Total_Quantity_Ounce` varchar(255) NOT NULL,
  `Tube_Type` varchar(255) NOT NULL,
  `Tube_Price` varchar(255) NOT NULL,
  `Total_Tubes` varchar(255) NOT NULL,
  `Profit` varchar(255) NOT NULL,
  `Total_Profit` varchar(255) NOT NULL,
  `BarId` varchar(255) NOT NULL,
  `Bar` varchar(255) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saved_data_shooters`
--

INSERT INTO `saved_data_shooters` (`id`, `P1_Product`, `P1_Category`, `P1_Quantity_Before`, `P1_Quantity_After`, `P1_Quantity`, `P2_Product`, `P2_Category`, `P2_Quantity_Before`, `P2_Quantity_After`, `P2_Quantity`, `P3_Product`, `P3_Category`, `P3_Quantity_Before`, `P3_Quantity_After`, `P3_Quantity`, `P1_Quantity_Ounce`, `P2_Quantity_Ounce`, `P3_Quantity_Ounce`, `Total_Quantity`, `Total_Quantity_Ounce`, `Tube_Type`, `Tube_Price`, `Total_Tubes`, `Profit`, `Total_Profit`, `BarId`, `Bar`, `DateReg`) VALUES
(51, 'Hennessy XO', '40', '23', '2', '21', 'Hennessy VSOP', '26', '12', '3', '9', 'Hennessy VSOP', '26', '3', '2', '1', '0.525', '1', '0.038461538461538', '31', '1.5634615384615', '1', '3', '', '0', '\n                                    \n                                    \n                                    \n                                    \n                                    \n                                    0', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(52, 'Don Julio', '40', '234', '0', '234', 'Hennessy', '40', '123', '0', '123', 'Canadian Club', '26', '200', '0', '200', '5.85', '1', '7.6923076923077', '557', '14.542307692308', '0.5', '3', '', '3546', '\n                                    \n                                    \n                                    \n                                    \n                                    \n                                    0', 'Harris200', 'bar1', '2023-08-14 23:00:00'),
(53, 'Don Julio', '40', '2000', '700', '1300', 'Hennessy VSOP', '26', '2910', '4', '2906', 'Don Julio', '40', '123', '8', '115', '32.5', '1', '2.875', '4321', '36.375', '0.5', '3', '8642', '25926', '25926.00', 'Harris200', 'bar1', '2023-08-14 23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `BarId` varchar(255) NOT NULL,
  `Pwd` varchar(255) NOT NULL,
  `Online` tinyint(4) NOT NULL,
  `Offline` tinyint(4) NOT NULL,
  `DateReg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Firstname`, `Lastname`, `BarId`, `Pwd`, `Online`, `Offline`, `DateReg`) VALUES
(1, 'Jenny Jois', 'Jolin', 'Jenny123', '12345', 0, 0, '2023-02-17 16:24:40'),
(3, 'John', 'Harris', 'Harris200', '1234', 0, 0, '2023-02-17 22:28:42'),
(4, 'Camela', 'Kiotazi', 'Kiotazi200', '1234', 0, 0, '2023-02-17 22:28:42'),
(7, 'Elite', 'Jonas', 'Jonas2000', '1234', 0, 0, '2023-02-17 23:37:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beers`
--
ALTER TABLE `beers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo`
--
ALTER TABLE `demo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liquors`
--
ALTER TABLE `liquors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `night_bottle_service`
--
ALTER TABLE `night_bottle_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presales_bottle_service`
--
ALTER TABLE `presales_bottle_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_data`
--
ALTER TABLE `saved_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_data_liquor`
--
ALTER TABLE `saved_data_liquor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `saved_data_shooters`
--
ALTER TABLE `saved_data_shooters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `beers`
--
ALTER TABLE `beers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `demo`
--
ALTER TABLE `demo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `liquors`
--
ALTER TABLE `liquors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `night_bottle_service`
--
ALTER TABLE `night_bottle_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

--
-- AUTO_INCREMENT for table `presales_bottle_service`
--
ALTER TABLE `presales_bottle_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `saved_data`
--
ALTER TABLE `saved_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=480;

--
-- AUTO_INCREMENT for table `saved_data_liquor`
--
ALTER TABLE `saved_data_liquor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT for table `saved_data_shooters`
--
ALTER TABLE `saved_data_shooters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
