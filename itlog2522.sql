-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 06:46 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaudittrail`
--

CREATE TABLE `tblaudittrail` (
  `auditTrailId` int(254) NOT NULL,
  `creatorId` int(254) NOT NULL,
  `lastEditorId` int(254) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `id` varchar(10) NOT NULL,
  `name` varchar(59) NOT NULL,
  `branchaddress` varchar(59) NOT NULL,
  `contactnumber` varchar(12) NOT NULL,
  `audit` varchar(4) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`id`, `name`, `branchaddress`, `contactnumber`, `audit`, `active`) VALUES
('B-0000001', 'Taguig Branch', 'McKinley Pkwy, Taguig, 1630 Metro Manila', '+63983555723', 'AT00', 1),
('B-0000002', 'Quezon City Branch', 'North Avenue, corner Epifanio de los Santos Ave, Quezon Cit', '+63910555978', 'AT00', 1),
('B-0000003', 'Mandaluyong Branch', 'EDSA, corner Doña Julia Vargas Ave, Ortigas Center, Mandalu', '+63909555196', 'AT00', 1),
('B-0000004', 'San Fernando Branch', 'East Wing) and, Olongapo-Gapan Road, Lagundi, Mexico, San J', '+63283555472', 'AT00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` varchar(25) NOT NULL,
  `name` varchar(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `name`, `active`) VALUES
('C-0000001', 'PC Case', 2),
('C-0000002', 'Graphics Card', 2),
('C-0000003', 'Laptop', 2),
('C-0000004', 'Processors', 2),
('C-0000005', 'Peripherals', 1),
('C-0000006', 'Memory', 1),
('C-0000007', 'Audio', 1),
('C-0000008', 'Desktop', 1),
('C-0000009', 'Motherboard', 1),
('C-0000010', 'Monitor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliveryorder`
--

CREATE TABLE `tbldeliveryorder` (
  `id` varchar(20) NOT NULL,
  `supplierid` varchar(20) NOT NULL,
  `total` double NOT NULL,
  `branchid` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditid` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldeliveryorder`
--

INSERT INTO `tbldeliveryorder` (`id`, `supplierid`, `total`, `branchid`, `userid`, `date`, `time`, `auditid`, `active`) VALUES
('DO-0000001', 'S-0000003', 40000, 'B-0000004', 'U-0000001', '2022-10-03', '16:30:35', 'A-0000001', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliveryorderitem`
--

CREATE TABLE `tbldeliveryorderitem` (
  `id` varchar(20) NOT NULL,
  `doid` varchar(20) NOT NULL,
  `poid` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL,
  `productid` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbldeliveryorderitem`
--

INSERT INTO `tbldeliveryorderitem` (`id`, `doid`, `poid`, `branchid`, `productid`, `price`, `quantity`, `total`, `paid`) VALUES
('DI-0000001', 'DO-0000001', 'PO-0000002', 'B-0000004', 'P-0000054', 20000, 2, 40000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `id` varchar(12) NOT NULL,
  `productid` varchar(12) NOT NULL,
  `supplierid` varchar(20) NOT NULL,
  `branchid` varchar(12) NOT NULL,
  `quantity` int(29) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblinventory`
--

INSERT INTO `tblinventory` (`id`, `productid`, `supplierid`, `branchid`, `quantity`) VALUES
('I-0000001', 'P-0000001', 'S-0000001', 'B-0000001', 0),
('I-0000002', 'P-0000002', 'S-0000001', 'B-0000001', 0),
('I-0000003', 'P-0000003', 'S-0000001', 'B-0000001', 0),
('I-0000004', 'P-0000004', 'S-0000001', 'B-0000002', 51),
('I-0000005', 'P-0000025', 'S-0000002', 'B-0000003', 0),
('I-0000006', 'P-0000029', 'S-0000002', 'B-0000003', 0),
('I-0000007', 'P-0000030', 'S-0000002', 'B-0000004', 23),
('I-0000008', 'P-0000043', 'S-0000002', 'B-0000004', 64),
('I-0000009', 'P-0000044', 'S-0000002', 'B-0000004', 0),
('I-0000010', 'P-0000049', 'S-0000002', 'B-0000004', 87),
('I-0000011', 'P-0000056', 'S-0000003', 'B-0000001', 0),
('I-0000012', 'P-0000060', 'S-0000003', 'B-0000002', 34),
('I-0000013', 'P-0000064', 'S-0000003', 'B-0000003', -1),
('I-0000014', 'P-0000068', 'S-0000003', 'B-0000004', 47),
('I-0000015', 'P-0000073', 'S-0000003', 'B-0000004', 0),
('I-0000016', 'P-0000081', 'S-0000004', 'B-0000001', 0),
('I-0000017', 'P-0000085', 'S-0000004', 'B-0000003', 0),
('I-0000018', 'P-0000089', 'S-0000004', 'B-0000003', -11),
('I-0000019', 'P-0000092', 'S-0000004', 'B-0000004', 0),
('I-0000020', 'P-0000098', 'S-0000005', 'B-0000002', 78),
('I-0000021', 'P-0000005', 'S-0000001', 'B-0000001', 3),
('I-0000022', 'P-0000006', 'S-0000001', 'B-0000003', -1),
('I-0000023', 'P-0000007', 'S-0000001', 'B-0000001', 25),
('I-0000024', 'P-0000008', 'S-0000001', 'B-0000002', 34),
('I-0000025', 'P-0000009', 'S-0000001', 'B-0000004', 18),
('I-0000026', 'P-0000010', 'S-0000001', 'B-0000002', 48),
('I-0000027', 'P-0000011', 'S-0000001', 'B-0000001', 69),
('I-0000028', 'P-0000012', 'S-0000001', 'B-0000002', 71),
('I-0000029', 'P-0000013', 'S-0000001', 'B-0000003', -1),
('I-0000030', 'P-0000014', 'S-0000001', 'B-0000003', -1),
('I-0000031', 'P-0000015', 'S-0000001', 'B-0000003', -1),
('I-0000032', 'P-0000016', 'S-0000001', 'B-0000004', 55),
('I-0000033', 'P-0000017', 'S-0000001', 'B-0000001', 5),
('I-0000034', 'P-0000018', 'S-0000001', 'B-0000002', 88),
('I-0000035', 'P-0000019', 'S-0000001', 'B-0000004', 25),
('I-0000036', 'P-0000020', 'S-0000001', 'B-0000003', -1),
('I-0000037', 'P-0000021', 'S-0000002', 'B-0000003', 99),
('I-0000038', 'P-0000022', 'S-0000002', 'B-0000002', 62),
('I-0000039', 'P-0000023', 'S-0000002', 'B-0000001', 11),
('I-0000040', 'P-0000024', 'S-0000002', 'B-0000002', 47),
('I-0000041', 'P-0000026', 'S-0000002', 'B-0000004', 92),
('I-0000042', 'P-0000027', 'S-0000002', 'B-0000002', 50),
('I-0000043', 'P-0000028', 'S-0000002', 'B-0000003', -1),
('I-0000044', 'P-0000031', 'S-0000002', 'B-0000003', -1),
('I-0000045', 'P-0000032', 'S-0000002', 'B-0000004', 12),
('I-0000046', 'P-0000033', 'S-0000002', 'B-0000001', 81),
('I-0000047', 'P-0000034', 'S-0000002', 'B-0000002', 25),
('I-0000048', 'P-0000035', 'S-0000002', 'B-0000003', 38),
('I-0000049', 'P-0000036', 'S-0000002', 'B-0000001', 40),
('I-0000050', 'P-0000037', 'S-0000002', 'B-0000002', 86),
('I-0000051', 'P-0000038', 'S-0000002', 'B-0000004', 612),
('I-0000052', 'P-0000039', 'S-0000002', 'B-0000001', 125),
('I-0000053', 'P-0000040', 'S-0000002', 'B-0000002', 4),
('I-0000054', 'P-0000041', 'S-0000002', 'B-0000003', 39),
('I-0000055', 'P-0000042', 'S-0000002', 'B-0000003', 297),
('I-0000056', 'P-0000045', 'S-0000002', 'B-0000004', 42),
('I-0000057', 'P-0000046', 'S-0000002', 'B-0000001', 78),
('I-0000058', 'P-0000047', 'S-0000002', 'B-0000002', 81),
('I-0000059', 'P-0000048', 'S-0000002', 'B-0000003', 821),
('I-0000060', 'P-0000050', 'S-0000002', 'B-0000004', 100),
('I-0000061', 'P-0000051', 'S-0000003', 'B-0000003', 95),
('I-0000062', 'P-0000052', 'S-0000003', 'B-0000001', 68),
('I-0000063', 'P-0000053', 'S-0000003', 'B-0000004', 354),
('I-0000064', 'P-0000054', 'S-0000003', 'B-0000001', 71),
('I-0000065', 'P-0000055', 'S-0000003', 'B-0000002', 84),
('I-0000066', 'P-0000057', 'S-0000003', 'B-0000004', 38),
('I-0000067', 'P-0000058', 'S-0000003', 'B-0000004', 44),
('I-0000068', 'P-0000059', 'S-0000003', 'B-0000003', 479),
('I-0000069', 'P-0000061', 'S-0000003', 'B-0000001', 711),
('I-0000070', 'P-0000062', 'S-0000003', 'B-0000002', 943),
('I-0000071', 'P-0000063', 'S-0000003', 'B-0000003', 65),
('I-0000072', 'P-0000065', 'S-0000003', 'B-0000003', 37),
('I-0000073', 'P-0000066', 'S-0000003', 'B-0000004', 66),
('I-0000074', 'P-0000067', 'S-0000003', 'B-0000001', 20),
('I-0000075', 'P-0000069', 'S-0000003', 'B-0000002', 82),
('I-0000076', 'P-0000070', 'S-0000003', 'B-0000001', 749),
('I-0000077', 'P-0000071', 'S-0000003', 'B-0000004', 95),
('I-0000078', 'P-0000072', 'S-0000003', 'B-0000003', 71),
('I-0000079', 'P-0000074', 'S-0000003', 'B-0000002', 11),
('I-0000080', 'P-0000075', 'S-0000003', 'B-0000002', 33),
('I-0000081', 'P-0000076', 'S-0000003', 'B-0000003', 68),
('I-0000082', 'P-0000077', 'S-0000003', 'B-0000004', 54),
('I-0000083', 'P-0000078', 'S-0000003', 'B-0000002', 82),
('I-0000084', 'P-0000079', 'S-0000003', 'B-0000001', 46),
('I-0000085', 'P-0000080', 'S-0000003', 'B-0000003', 151),
('I-0000086', 'P-0000082', 'S-0000004', 'B-0000001', 38),
('I-0000087', 'P-0000083', 'S-0000004', 'B-0000004', 74),
('I-0000088', 'P-0000084', 'S-0000004', 'B-0000002', 21),
('I-0000089', 'P-0000086', 'S-0000004', 'B-0000003', 940),
('I-0000090', 'P-0000087', 'S-0000004', 'B-0000001', 30),
('I-0000091', 'P-0000088', 'S-0000004', 'B-0000003', 62),
('I-0000092', 'P-0000090', 'S-0000004', 'B-0000004', 74),
('I-0000093', 'P-0000091', 'S-0000004', 'B-0000004', 2),
('I-0000094', 'P-0000093', 'S-0000004', 'B-0000002', 555),
('I-0000095', 'P-0000094', 'S-0000004', 'B-0000001', 55),
('I-0000096', 'P-0000095', 'S-0000004', 'B-0000003', 88),
('I-0000097', 'P-0000096', 'S-0000005', 'B-0000003', 547),
('I-0000098', 'P-0000097', 'S-0000005', 'B-0000004', 23),
('I-0000099', 'P-0000099', 'S-0000005', 'B-0000002', 61),
('I-0000100', 'P-0000100', 'S-0000005', 'B-0000001', 20),
('I-0000101', 'P-0000063', 'S-0000003', 'B-0000002', 2),
('I-0000102', 'P-0000082', 'S-0000004', 'B-0000004', 2),
('I-0000103', 'P-0000094', 'S-0000004', 'B-0000004', 10),
('I-0000104', 'P-0000059', 'S-0000003', 'B-0000004', 2),
('I-0000105', 'P-0000054', 'S-0000003', 'B-0000004', 1),
('I-0000106', 'P-0000001', 'S-0000001', 'B-0000002', 0),
('I-0000107', 'P-0000030', 'S-0000002', 'B-0000001', 5),
('I-0000108', 'P-0000023', 'S-0000002', 'B-0000002', 22),
('I-0000109', 'P-0000081', 'S-0000004', 'B-0000002', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblinventoryadjustment`
--

CREATE TABLE `tblinventoryadjustment` (
  `id` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `auditid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblinventoryadjustment`
--

INSERT INTO `tblinventoryadjustment` (`id`, `branchid`, `date`, `auditid`) VALUES
('IA-0000001', 'B-0000002', '2022-10-05', 'A-0000001'),
('IA-0000002', 'B-0000002', '2022-10-05', 'A-0000001'),
('IA-0000003', 'B-0000004', '2022-10-18', 'U-0000010');

-- --------------------------------------------------------

--
-- Table structure for table `tblinventoryadjustmentitem`
--

CREATE TABLE `tblinventoryadjustmentitem` (
  `id` varchar(20) NOT NULL,
  `invadjid` varchar(20) NOT NULL,
  `inventoryid` varchar(20) NOT NULL,
  `productid` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblinventoryadjustmentitem`
--

INSERT INTO `tblinventoryadjustmentitem` (`id`, `invadjid`, `inventoryid`, `productid`, `quantity`) VALUES
('II-0000001', 'IA-0000001', 'I-0000004', 'P-0000004', -3),
('II-0000002', 'IA-0000002', 'I-0000004', 'P-0000004', 3),
('II-0000003', 'IA-0000003', 'I-0000007', 'P-0000030', -5);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayableitem`
--

CREATE TABLE `tblpayableitem` (
  `id` varchar(20) NOT NULL,
  `payableid` varchar(20) NOT NULL,
  `doid` varchar(20) NOT NULL,
  `supplierid` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL,
  `productid` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(20) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpayableitem`
--

INSERT INTO `tblpayableitem` (`id`, `payableid`, `doid`, `supplierid`, `branchid`, `productid`, `price`, `quantity`, `total`) VALUES
('PA-0000001', '', 'DO-0000002', 'S-0000003', 'B-0000002', 'P-0000063', 7350, 3, 14700),
('PA-0000002', '', 'DO-0000015', 'S-0000004', 'B-0000004', 'P-0000082', 247900, 2, 495800),
('PA-0000003', '', 'DO-0000015', 'S-0000004', 'B-0000004', 'P-0000094', 495, 10, 4950);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayables`
--

CREATE TABLE `tblpayables` (
  `id` varchar(20) NOT NULL,
  `total` double NOT NULL,
  `userid` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpayables`
--

INSERT INTO `tblpayables` (`id`, `total`, `userid`, `date`, `active`) VALUES
('PY-0000001', 14700, 'U-0000001', '2022-10-01', 1),
('PY-0000002', 500750, 'U-0000001', '2022-10-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpermissions`
--

CREATE TABLE `tblpermissions` (
  `id` int(254) NOT NULL,
  `name` varchar(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` varchar(20) NOT NULL,
  `name` varchar(69) NOT NULL,
  `supplier` varchar(29) NOT NULL,
  `category` varchar(15) NOT NULL,
  `price` decimal(20,0) NOT NULL,
  `markupPrice` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `supplier`, `category`, `price`, `markupPrice`, `active`) VALUES
('P-0000001', 'Tecware Flatline Black TG mATX', 'S-0000001', 'C-0000001', '2090', '2299.00', 1),
('P-0000002', 'Tecware Forge M Omni Matx Case Black White', 'S-0000001', 'C-0000001', '3050', '3355.00', 1),
('P-0000003', 'Tecware Forge M2 Omni mATX Case Black ', 'S-0000001', 'C-0000001', '2290', '2519.00', 1),
('P-0000004', 'Tecware Forge S Omni Black ATX TG 4*120mm', 'S-0000001', 'C-0000001', '2990', '3289.00', 1),
('P-0000005', 'Tecware Forge L High-Airflow E-ATX', 'S-0000001', 'C-0000001', '4600', '5060.00', 1),
('P-0000006', 'Tecware Phantom 87 Key RGB Mechanical Keyboard Red/Blue/Brown Switch', 'S-0000001', 'C-0000005', '2280', '2508.00', 1),
('P-0000007', 'Tecware Spectre Pro, RGB Mechanical Keyboard, RGB LED (Outemu Brown)', 'S-0000001', 'C-0000005', '2400', '2640.00', 1),
('P-0000008', 'Tecware B68 Wireless RGB 68-Key / 65% layout PBT Keycaps Mechanical G', 'S-0000001', 'C-0000005', '2895', '3184.50', 2),
('P-0000009', 'Tecware B68+ RGB Backlit Wireless Mechanical Keyboard, 3 Mode, 68-Key', 'S-0000001', 'C-0000005', '3000', '3300.00', 2),
('P-0000010', 'Tecware Veil 80 TKL Black 3 mode BT Wireless 75% Layout Mech Keyboard', 'S-0000001', 'C-0000005', '5110', '5621.00', 1),
('P-0000011', 'Tecware Pulse Elite Wireless Gaming Mouse', 'S-0000001', 'C-0000005', '1750', '1925.00', 1),
('P-0000012', 'Tecware EXO Wireless RGB Gaming Mouse ', 'S-0000001', 'C-0000005', '1750', '1925.00', 2),
('P-0000013', 'Tecware Torque Pro RGB Gaming Mouse', 'S-0000001', 'C-0000005', '1450', '1595.00', 1),
('P-0000014', 'Tecware IMPULSE PRO RGB Gaming Mouse', 'S-0000001', 'C-0000005', '1300', '1430.00', 1),
('P-0000015', 'Tecware Q2 Gaming Headset', 'S-0000001', 'C-0000007', '940', '1,034.00', 1),
('P-0000016', 'Tecware Q5 HD 7.1 Surround + Wide Band Mic RGB Premium Gaming Headset', 'S-0000001', 'C-0000007', '1800', '1980.00', 2),
('P-0000017', 'Tecware Haste XL RGB Mousepad', 'S-0000001', 'C-0000005', '1100', '1210.00', 1),
('P-0000018', 'Tecware Keyboard Wrist Pad Full 445x100x25mm', 'S-0000001', 'C-0000005', '499', '548.90', 1),
('P-0000019', 'Tecware Alpha M mATX TG Chassis White ', 'S-0000001', 'C-0000001', '2680', '2948.00', 1),
('P-0000020', 'Tecware Vega M Tempered Chassis', 'S-0000001', 'C-0000001', '1669', '1835.90', 1),
('P-0000023', 'ASUS Maximus VI Hero', 'S-0000002', 'C-0000009', '7988', '8786.80', 2),
('P-0000024', 'ASUS Prime H610M-E D4 Intel LGA 1700', 'S-0000002', 'C-0000009', '5560', '6116.00', 2),
('P-0000025', 'Asus Prime Z690-A ATX LGA 1700 Motherboard', 'S-0000002', 'C-0000009', '15450', '16995.00', 2),
('P-0000026', 'ASUS EX-B460M-V5 Intel B460 LGA 1200 mATX Motherboard', 'S-0000002', 'C-0000009', '5150', '5665.00', 2),
('P-0000027', 'ASUS ZenBook 14 Ultra-Slim Laptop 14” FHD Display', 'S-0000002', 'C-0000003', '53183', '58501.30', 1),
('P-0000028', 'ASUS VivoBook Pro 15 OLED Ultra Slim Laptop, 15.6” FHD OLED Display', 'S-0000002', 'C-0000003', '49499', '54448.90', 1),
('P-0000029', 'ASUS TUF Gaming F17 Gaming Laptop, 17.3” 144Hz Full HD IPS-Type', 'S-0000002', 'C-0000003', '59900', '65890.00', 1),
('P-0000030', 'ASUS ROG Strix G15 Advantage Edition Gaming Laptop, 15.6\" 300Hz FHD D', 'S-0000002', 'C-0000003', '109900', '120890.00', 2),
('P-0000031', 'ASUS ROG G531GT-BI7N6 15.6\" FHD Gaming Laptop Computer', 'S-0000002', 'C-0000003', '86000', '94600.00', 2),
('P-0000032', 'ROG Strix XG16AHP Portable 144Hz Gaming Monitor ', 'S-0000002', 'C-0000010', '36000', '39600.00', 1),
('P-0000033', 'ASUS BE24EQK Business Monitor – 23.8 inch, Full HD, IPS, Frameless', 'S-0000002', 'C-0000010', '22354', '24589.40', 1),
('P-0000034', 'TUF Gaming VG259QR Gaming Monitor – 24.5 inch Full HD (1920 x 1080), ', 'S-0000002', 'C-0000010', '15495', '17044.50', 2),
('P-0000035', 'ASUS ROG SWIFT 360Hz PG259QNR eSports NVIDIA® G-SYNC', 'S-0000002', 'C-0000010', '42320', '46552.00', 2),
('P-0000036', 'ASUS Dual Radeon™ RX 6600 8GB GDDR6', 'S-0000002', 'C-0000002', '24995', '27494.50', 1),
('P-0000037', 'ASUS Dual Radeon™ RX 6700 XT 12GB GDDR6', 'S-0000002', 'C-0000002', '48999', '53898.90', 2),
('P-0000038', 'ASUS TUF GAMING Radeon™ RX 6800 XT', 'S-0000002', 'C-0000002', '88799', '97678.90', 1),
('P-0000039', 'ROG Strix GeForce RTX™ 3050 OC Edition 8GB GDDR6', 'S-0000002', 'C-0000002', '25000', '27500.00', 1),
('P-0000040', 'ROG Strix GeForce RTX™ 3080 OC Edition 12GB', 'S-0000002', 'C-0000002', '59060', '64966.00', 1),
('P-0000041', 'Intel® Core™ i7-12650HX Processor (24M Cache, up to 4.70 GHz)', 'S-0000002', 'C-0000004', '19000', '20900.00', 1),
('P-0000042', 'Intel® Core™ i5-12500H Processor (18M Cache, up to 4.50 GHz)', 'S-0000002', 'C-0000004', '13000', '14300.00', 1),
('P-0000043', 'Intel® Core™ i3-12100 Processor (12M Cache, up to 4.30 GHz)', 'S-0000002', 'C-0000004', '6290', '6919.00', 2),
('P-0000044', 'AMD Ryzen™ 5 3600', 'S-0000002', 'C-0000004', '10500', '11550.00', 1),
('P-0000045', 'AMD Ryzen™ 7 5700G', 'S-0000002', 'C-0000004', '15700', '17270.00', 1),
('P-0000046', 'ASUS TUF Gaming K7 Optical-Mech Keyboard with IP56', 'S-0000002', 'C-0000005', '7685', '8453.00', 2),
('P-0000047', 'ROG Strix Scope RX EVA Edition\r\n', 'S-0000002', 'C-0000005', '5405', '5945.50', 2),
('P-0000048', 'ROG PBT Doubleshot Keycap Set for ROG RX Switches', 'S-0000002', 'C-0000005', '2069', '2,275.9', 1),
('P-0000049', 'ROG Scabbard II EVA Edition', 'S-0000002', 'C-0000005', '995', '1094.50', 1),
('P-0000050', 'ROG Sheath GUNDAM EDITION', 'S-0000002', 'C-0000005', '1300', '1430.00', 1),
('P-0000051', 'AORUS GeForce RTX™ 3090 Ti XTREME WATERFORCE 24G', 'S-0000003', 'C-0000002', '220000', '242000.00', 1),
('P-0000052', 'AORUS GeForce RTX™ 3080 XTREME WATERFORCE 10G (rev. 2.0)', 'S-0000003', 'C-0000002', '31000', '34100.00', 1),
('P-0000053', 'AORUS GeForce RTX™ 3070 MASTER 8G (rev. 2.0)', 'S-0000003', 'C-0000002', '23000', '25300.00', 2),
('P-0000054', 'AORUS GeForce RTX™ 3060 Ti MASTER 8G', 'S-0000003', 'C-0000002', '20000', '22000.00', 2),
('P-0000055', 'AORUS GeForce® RTX 2080 SUPER™ WATERFORCE 8G', 'S-0000003', 'C-0000002', '25000', '27500.00', 1),
('P-0000056', 'Radeon™ RX 6600 XT EAGLE 8G', 'S-0000003', 'C-0000002', '27000', '29700.00', 1),
('P-0000057', 'Radeon™ RX 5600 XT WINDFORCE OC 6G', 'S-0000003', 'C-0000002', '58000', '63800.00', 1),
('P-0000058', 'Radeon™ RX 5500 XT D6 8G (rev. 2.0)', 'S-0000003', 'C-0000002', '24000', '26400.00', 1),
('P-0000059', 'Z690 AORUS XTREME WATERFORCE (rev. 1.0)', 'S-0000003', 'C-0000009', '58000', '63800.00', 1),
('P-0000060', 'Z690 AORUS ELITE AX (rev. 1.x)', 'S-0000003', 'C-0000009', '15000', '16500.00', 1),
('P-0000061', 'H610M S2 DDR4 (rev. 1.2)', 'S-0000003', 'C-0000009', '5200', '5720.00', 2),
('P-0000062', 'Z690I AORUS ULTRA PLUS DDR4 (rev. 1.0)', 'S-0000003', 'C-0000009', '15895', '17484.50', 1),
('P-0000063', 'B660M AORUS ELITE DDR4 (rev. 1.0)', 'S-0000003', 'C-0000009', '7350', '8085.00', 2),
('P-0000064', 'Z690 AERO D (rev. 1.x)', 'S-0000003', 'C-0000009', '16500', '18150.00', 1),
('P-0000065', 'B550M AORUS PRO AX (rev. 1.1)', 'S-0000003', 'C-0000009', '7800', '8580.00', 2),
('P-0000066', 'X570SI AORUS PRO AX (rev. 1.1)', 'S-0000003', 'C-0000009', '13800', '15180.00', 1),
('P-0000067', 'X570 AORUS XTREME (rev. 1.2)', 'S-0000003', 'C-0000009', '48500', '53350.00', 2),
('P-0000068', 'AORUS C700 GLASS', 'S-0000003', 'C-0000001', '24499', '26948.90', 1),
('P-0000069', 'AORUS C500 GLASS', 'S-0000003', 'C-0000001', '7199', '7918.90', 2),
('P-0000070', 'AORUS C300 GLASS', 'S-0000003', 'C-0000001', '7380', '8118.00', 2),
('P-0000071', 'AC300W (rev. 2.0)', 'S-0000003', 'C-0000001', '7295', '8024.50', 1),
('P-0000072', 'AC300W Lite', 'S-0000003', 'C-0000001', '6750', '7424.00', 2),
('P-0000073', 'XC700W ATX Full-tower PC Case \r\n', 'S-0000003', 'C-0000001', '16000', '17600.00', 2),
('P-0000074', 'GIGABYTE Horus P2', 'S-0000003', 'C-0000001', '18590', '20449.00', 1),
('P-0000075', 'AORUS RGB Memory DDR5 32GB (2x16GB) 6000MHz', 'S-0000003', 'C-0000006', '15995', '17594.50', 1),
('P-0000076', 'AORUS RGB Memory 16GB (2x8GB) 3600MHz', 'S-0000003', 'C-0000006', '6699', '7368.90', 1),
('P-0000077', 'DESIGNARE Memory 64GB (2x32GB) 3200MHz', 'S-0000003', 'C-0000006', '24720', '27192.00', 1),
('P-0000078', 'GIGABYTE Memory 8GB (1x8GB) 2666MHz', 'S-0000003', 'C-0000006', '2300', '2530.00', 2),
('P-0000079', 'AORUS Model X Gaming Desktop Computer', 'S-0000003', 'C-0000008', '142974', '157271.40', 2),
('P-0000080', ' AORUS MODEL S Gaming PC Computer Desktop ', 'S-0000003', 'C-0000008', '126500', '139150.00', 1),
('P-0000081', 'MSI Titan GT77 17.3\" UHD 120Hz Gaming Laptop', 'S-0000004', 'C-0000003', '164970', '181467.00', 1),
('P-0000082', 'MSI Stealth GS77 17.3\" UHD 4K 120Hz Ultra Thin and Light Gaming Lapto', 'S-0000004', 'C-0000003', '247900', '272690.00', 2),
('P-0000083', 'IMMERSE GV60 STREAMING MIC', 'S-0000004', 'C-0000005', '2059', '2264.90', 1),
('P-0000084', 'MSI Immerse GH50 Wired Gaming Headset', 'S-0000004', 'C-0000005', '3060', '3366.00', 1),
('P-0000085', 'MSI Gaming Vector GP66', 'S-0000004', 'C-0000003', '89670', '98637.00', 1),
('P-0000086', ' MSI Raider GE76 12UHS-255 Gaming Laptop', 'S-0000004', 'C-0000003', '135150', '148665.00', 2),
('P-0000087', 'MSI Clutch GM11 White Gaming Mouse - 5000 DPI', 'S-0000004', 'C-0000005', '895', '984.50', 2),
('P-0000088', 'MSI DS502 Gaming Headset, Enhanced Virtual 7.1 Surround Sound', 'S-0000004', 'C-0000007', '4350', '4785.00', 1),
('P-0000089', 'PERIPHERIQUE Gaming MSI IMMERSE GH10', 'S-0000004', 'C-0000007', '3499', '3848.90', 1),
('P-0000090', 'MSI SPATIUM M480 PCIe 4.0 NVMe M.2 2TB Internal SSD', 'S-0000004', 'C-0000006', '9550', '10505.00', 1),
('P-0000091', 'MSI SPATIUM M450 PCIe 4.0 NVMe M.2 1TB Internal Gaming SSD ', 'S-0000004', 'C-0000006', '3599', '3958.90', 1),
('P-0000092', 'MSI SPATIUM M370 NVMe M.2 1TB Internal SSD', 'S-0000004', 'C-0000006', '8744', '9618.20', 1),
('P-0000093', 'MSI Full HD 1920 x 1080 360Hz LED Backlit Gaming Monitor', 'S-0000004', 'C-0000010', '23645', '26009.50', 2),
('P-0000094', 'MSI Agility GD20 Premium Gaming Mouse Pad', 'S-0000004', 'C-0000005', '495', '544.50', 1),
('P-0000095', 'MSI MAG Z690 Tomahawk WiFi DDR4 Gaming Motherboard', 'S-0000004', 'C-0000009', '15799', '17378.90', 1),
('P-0000096', 'MSI MPG Z690 Carbon WiFi Gaming Motherboard ', 'S-0000004', 'C-0000009', '19200', '21120.00', 1),
('P-0000097', 'GALAX Gaming Headset (SNR-01)', 'S-0000005', 'C-0000007', '3200', '3520.00', 2),
('P-0000098', 'GALAX GeForce® GTX 1660 Super X Edition (1-Click OC)', 'S-0000005', 'C-0000002', '23999', '26398.00', 2),
('P-0000099', 'GALAX GeForce® GT 1030 DDR4 GALAX GeForce® GT 1030 DDR4', 'S-0000005', 'C-0000002', '4869', '5355.9', 1),
('P-0000100', 'GALAX VI-01 Gaming Monitor Borderless 27 Inch / IPS / LED / HDR', 'S-0000005', 'C-0000010', '18999', '20898.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchaseorder`
--

CREATE TABLE `tblpurchaseorder` (
  `id` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL,
  `supplierid` varchar(20) NOT NULL,
  `total` double NOT NULL,
  `userid` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpurchaseorder`
--

INSERT INTO `tblpurchaseorder` (`id`, `branchid`, `supplierid`, `total`, `userid`, `date`, `time`) VALUES
('PO-0000001', 'B-0000004', 'S-0000003', 174000, 'U-0000001', '2022-10-03', '16:03:27'),
('PO-0000002', 'B-0000004', 'S-0000003', 60000, 'U-0000001', '2022-10-03', '16:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchaseorderitem`
--

CREATE TABLE `tblpurchaseorderitem` (
  `id` varchar(20) NOT NULL,
  `poid` varchar(20) NOT NULL,
  `productid` varchar(20) NOT NULL,
  `branchid` varchar(20) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `poquantity` int(10) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblpurchaseorderitem`
--

INSERT INTO `tblpurchaseorderitem` (`id`, `poid`, `productid`, `branchid`, `price`, `quantity`, `poquantity`, `total`) VALUES
('PI-0000001', 'PO-0000002', 'P-0000054', 'B-0000001', 20000, 1, 0, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tblsales`
--

CREATE TABLE `tblsales` (
  `id` varchar(10) NOT NULL,
  `total` int(29) NOT NULL,
  `taxid` int(254) NOT NULL,
  `vat` int(50) NOT NULL,
  `vattablesale` int(50) NOT NULL,
  `pending` int(1) NOT NULL,
  `userid` varchar(10) NOT NULL,
  `branchid` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsales`
--

INSERT INTO `tblsales` (`id`, `total`, `taxid`, `vat`, `vattablesale`, `pending`, `userid`, `branchid`, `active`, `date`) VALUES
('S-0000001', 16775, 1, 16775, 14762, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000002', 32890, 1, 3947, 28943, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000003', 0, 1, 0, 0, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000004', 13156, 1, 1579, 11577, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000005', 3355, 1, 403, 2952, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000006', 2299, 1, 276, 2023, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000007', 16500, 1, 1980, 14520, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000008', 3355, 1, 403, 2952, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000009', 2519, 1, 302, 2217, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000010', 0, 1, 39534, 289916, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000011', 52796, 1, 6336, 46460, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000012', 5475, 1, 657, 4818, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000013', 16500, 1, 1980, 14520, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000014', 217162, 1, 1511, 11084, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000015', 73635, 1, 6534, 47916, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000016', 6897, 1, 828, 6069, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000017', 22990, 1, 2759, 20231, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000018', 330880, 1, 10692, 78408, 1, 'U-0000001', 'B-0000001', 1, '2022-10-03'),
('S-0000019', 512545, 1, 17820, 130680, 1, 'U-0000001', 'B-0000001', 1, '2022-10-12'),
('S-0000020', 34595, 1, 4151, 30444, 1, 'U-0000007', 'B-0000001', 1, '2022-10-18'),
('S-0000021', 27676, 1, 3321, 24355, 1, 'U-0000007', 'B-0000004', 1, '2022-10-18'),
('S-0000022', 604450, 1, 72534, 531916, 1, 'U-0000007', 'B-0000004', 1, '2022-10-18'),
('S-0000023', 120890, 1, 14507, 106383, 1, 'U-0000007', 'B-0000004', 1, '2022-10-18'),
('S-0000024', 120890, 1, 14507, 106383, 1, 'U-0000007', 'B-0000004', 1, '2022-10-18'),
('S-0000025', 1208900, 1, 145068, 1063832, 1, 'U-0000007', 'B-0000004', 1, '2022-10-18'),
('S-0000026', 20757, 1, 2491, 18266, 1, 'U-0000007', 'B-0000004', 1, '2022-10-18'),
('S-0000027', 8497500, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000028', 5445000, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000029', 22708510, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000030', 3009600, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000031', 3828000, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000032', 5005000, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000033', 3300, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000034', 1468720, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000035', 294024060, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24'),
('S-0000036', 737880000, 1, 0, 0, 1, 'U-0000005', 'B-0000003', 1, '2022-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `tblsalesitem`
--

CREATE TABLE `tblsalesitem` (
  `id` varchar(10) NOT NULL,
  `salesid` varchar(10) NOT NULL,
  `productid` varchar(10) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(10) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsalesitem`
--

INSERT INTO `tblsalesitem` (`id`, `salesid`, `productid`, `price`, `quantity`, `total`) VALUES
('SI-0000001', 'S-0000001', 'P-0000001', 2299, 1, 0),
('SI-0000002', 'S-0000001', 'P-0000002', 3355, 5, 16775),
('SI-0000003', 'S-0000002', 'P-0000001', 2299, 2, 0),
('SI-0000004', 'S-0000002', 'P-0000004', 3289, 10, 32890),
('SI-0000006', 'S-0000004', 'P-0000004', 3289, 4, 13156),
('SI-0000007', 'S-0000005', 'P-0000002', 3355, 1, 3355),
('SI-0000008', 'S-0000006', 'P-0000001', 2299, 1, 2299),
('SI-0000009', 'S-0000007', 'P-0000060', 16500, 1, 16500),
('SI-0000010', 'S-0000008', 'P-0000002', 3355, 1, 3355),
('SI-0000011', 'S-0000009', 'P-0000003', 2519, 1, 2519),
('SI-0000012', 'S-0000010', 'P-0000029', 65890, 5, 329450),
('SI-0000013', 'S-0000011', 'P-0000098', 26398, 2, 52796),
('SI-0000014', 'S-0000012', 'P-0000049', 1095, 5, 5475),
('SI-0000015', 'S-0000013', 'P-0000060', 16500, 1, 16500),
('SI-0000016', 'S-0000014', 'P-0000001', 2299, 3, 6897),
('SI-0000017', 'S-0000014', 'P-0000029', 65890, 3, 197670),
('SI-0000018', 'S-0000014', 'P-0000003', 2519, 5, 12595),
('SI-0000019', 'S-0000015', 'P-0000025', 16995, 1, 16995),
('SI-0000020', 'S-0000015', 'P-0000049', 1095, 2, 2190),
('SI-0000021', 'S-0000015', 'P-0000064', 18150, 3, 54450),
('SI-0000022', 'S-0000016', 'P-0000001', 2299, 3, 6897),
('SI-0000023', 'S-0000017', 'P-0000001', 2299, 10, 22990),
('SI-0000024', 'S-0000018', 'P-0000030', 120890, 2, 241780),
('SI-0000025', 'S-0000018', 'P-0000056', 29700, 3, 89100),
('SI-0000026', 'S-0000019', 'P-0000029', 65890, 5, 329450),
('SI-0000027', 'S-0000019', 'P-0000043', 6919, 5, 34595),
('SI-0000028', 'S-0000019', 'P-0000056', 29700, 5, 148500),
('SI-0000029', 'S-0000020', 'P-0000043', 6919, 5, 34595),
('SI-0000030', 'S-0000021', 'P-0000043', 6919, 4, 27676),
('SI-0000031', 'S-0000022', 'P-0000030', 120890, 5, 604450),
('SI-0000032', 'S-0000023', 'P-0000030', 120890, 1, 120890),
('SI-0000033', 'S-0000024', 'P-0000030', 120890, 1, 120890),
('SI-0000034', 'S-0000025', 'P-0000030', 120890, 10, 1208900),
('SI-0000035', 'S-0000026', 'P-0000043', 6919, 3, 20757),
('SI-0000036', 'S-0000027', 'I-0000005', 1699500, 5, 8497500),
('SI-0000037', 'S-0000028', 'I-0000013', 1815000, 3, 5445000),
('SI-0000038', 'S-0000029', 'I-0000018', 384890, 59, 22708510),
('SI-0000039', 'S-0000030', 'I-0000022', 250800, 12, 3009600),
('SI-0000040', 'S-0000031', 'I-0000029', 159500, 24, 3828000),
('SI-0000041', 'S-0000032', 'I-0000030', 143000, 35, 5005000),
('SI-0000042', 'S-0000033', 'I-0000031', 100, 33, 3300),
('SI-0000043', 'S-0000034', 'I-0000036', 183590, 8, 1468720),
('SI-0000044', 'S-0000035', 'I-0000043', 5444890, 54, 294024060),
('SI-0000045', 'S-0000036', 'I-0000044', 9460000, 78, 737880000);

-- --------------------------------------------------------

--
-- Table structure for table `tblsalesreturn`
--

CREATE TABLE `tblsalesreturn` (
  `id` varchar(20) NOT NULL,
  `salesid` varchar(20) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `userid` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsalesreturn`
--

INSERT INTO `tblsalesreturn` (`id`, `salesid`, `date`, `userid`) VALUES
('SR-0000001', 'S-0000002', '2022-10-12', 0),
('SR-0000002', 'S-0000004', '2022-10-12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsalesreturnitem`
--

CREATE TABLE `tblsalesreturnitem` (
  `id` varchar(20) NOT NULL,
  `salesitemid` varchar(20) NOT NULL,
  `price` decimal(30,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `totalprice` decimal(30,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsalesreturnitem`
--

INSERT INTO `tblsalesreturnitem` (`id`, `salesitemid`, `price`, `quantity`, `totalprice`) VALUES
('SRI-0000001', 'SI-0000003', '0', 2, '0'),
('SRI-0000002', 'SI-0000006', '0', 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblstocktransfer`
--

CREATE TABLE `tblstocktransfer` (
  `id` varchar(20) NOT NULL,
  `source` varchar(20) NOT NULL,
  `destination` varchar(20) NOT NULL,
  `userid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstocktransfer`
--

INSERT INTO `tblstocktransfer` (`id`, `source`, `destination`, `userid`) VALUES
('ST-0000001', 'B-0000001', 'B-0000002', 'A-0000001'),
('ST-0000002', 'B-0000001', 'B-0000002', 'A-0000001'),
('ST-0000003', 'B-0000001', 'B-0000002', 'A-0000001'),
('ST-0000004', 'B-0000001', 'B-0000002', 'A-0000001'),
('ST-0000005', 'B-0000004', 'B-0000001', 'U-0000010'),
('ST-0000006', 'B-0000004', 'B-0000001', 'U-0000010'),
('ST-0000007', 'B-0000004', 'B-0000002', 'U-0000007'),
('ST-0000008', 'B-0000004', 'B-0000002', 'U-0000007'),
('ST-0000009', 'B-0000001', 'B-0000002', 'U-0000001'),
('ST-0000010', 'B-0000001', 'B-0000002', 'U-0000001');

-- --------------------------------------------------------

--
-- Table structure for table `tblstocktransferitem`
--

CREATE TABLE `tblstocktransferitem` (
  `id` varchar(20) NOT NULL,
  `inventoryid` varchar(20) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstocktransferitem`
--

INSERT INTO `tblstocktransferitem` (`id`, `inventoryid`, `quantity`) VALUES
('0000001', 'I-0000001', 5),
('0000002', 'I-0000001', 2),
('0000003', 'I-0000001', 2),
('0000004', 'I-0000007', 0),
('0000005', 'I-0000007', 5),
('0000006', 'I-0000001', 3),
('0000007', 'I-0000039', 22),
('0000008', 'I-0000001', 1),
('0000009', 'I-0000016', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `id` varchar(254) NOT NULL,
  `name` varchar(49) NOT NULL,
  `contactNumber` varchar(49) NOT NULL,
  `emailAddress` varchar(49) NOT NULL,
  `address` varchar(69) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`id`, `name`, `contactNumber`, `emailAddress`, `address`, `active`) VALUES
('S-0000001', 'Tecware', '+63 9215557167', 'tecware@gmail.com', '#22 Josefa Bldg. San Vicente Centro Urdaneta Pangasinan 2428 Urdaneta', 2),
('S-0000002', 'Asus', '+63 9195556353', 'asus@gmail.com', 'Hanston Building, Emerald Ave, Ortigas Center, Pasig, 1605 Metro Mani', 2),
('S-0000003', 'Gigabyte', '+63 8905550672', 'gigabyte@yahoo.com', '4448 Calatagan St, Makati, 1235 Metro Manila', 1),
('S-0000004', 'MSI ', '+63 9235557389', 'msi@yahoo.com', '4/F, The Annex, SM City North EDSA, 173, Sto. Cristo St, Quezon City,', 1),
('S-0000005', 'Galax', '+63 9857412568', 'galax@gmail.com', 'McKinley Pkwy, Taguig, 1630 Metro Manila', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltax`
--

CREATE TABLE `tbltax` (
  `tax` int(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbltax`
--

INSERT INTO `tbltax` (`tax`) VALUES
(12);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `permission` int(1) NOT NULL,
  `branchid` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `firstname`, `lastname`, `email`, `password`, `permission`, `branchid`, `active`) VALUES
('U-0000001', 'Jose', 'Itlog', 'josedelacruz@gmail.com', 'josed', 1, 'B-0000001', 1),
('U-0000002', 'Joze', 'Dela Cruz', 'josedelacruz@gmail.com', 'rtalman', 1, 'B-0000001', 1),
('U-0000003', 'Alex', 'Balmores', 'alexb@gmail.com', 'alexbalmores', 1, 'B-0000003', 1),
('U-0000004', 'Xiao', 'Cute', 'xiaocute@gmail.com', 'XiaoCute', 2, 'B-0000004', 1),
('U-0000005', 'Xiao', 'Cute', 'xiaocute@gmail.com', 'XiaoCute', 2, 'B-0000003', 1),
('U-0000006', 'Xiu', 'Mei', 'xiumei@gmail.com', 'XiuMei', 1, 'B-0000001', 1),
('U-0000007', 'Xin', 'Mei', 'xinmei@gmail.com', 'XinMei', 2, 'B-0000004', 1),
('U-0000008', 'Takao', 'Matakao', 'takao@gmail.com', 'TakaoMatakao', 3, 'B-0000001', 1),
('U-0000009', 'Bebang', 'Makulit', 'bebang@gmail.com', 'BebangMakulit', 3, 'B-0000002', 1),
('U-0000010', 'Puchoy', 'Pogi', 'chuypo@gmail.com', 'PuchoyPogi', 3, 'B-0000004', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldeliveryorder`
--
ALTER TABLE `tbldeliveryorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldeliveryorderitem`
--
ALTER TABLE `tbldeliveryorderitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinventoryadjustment`
--
ALTER TABLE `tblinventoryadjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblinventoryadjustmentitem`
--
ALTER TABLE `tblinventoryadjustmentitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayableitem`
--
ALTER TABLE `tblpayableitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpayables`
--
ALTER TABLE `tblpayables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpermissions`
--
ALTER TABLE `tblpermissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpurchaseorder`
--
ALTER TABLE `tblpurchaseorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpurchaseorderitem`
--
ALTER TABLE `tblpurchaseorderitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsales`
--
ALTER TABLE `tblsales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsalesitem`
--
ALTER TABLE `tblsalesitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsalesreturn`
--
ALTER TABLE `tblsalesreturn`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsalesreturnitem`
--
ALTER TABLE `tblsalesreturnitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstocktransfer`
--
ALTER TABLE `tblstocktransfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstocktransferitem`
--
ALTER TABLE `tblstocktransferitem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltax`
--
ALTER TABLE `tbltax`
  ADD PRIMARY KEY (`tax`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`(10));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpermissions`
--
ALTER TABLE `tblpermissions`
  MODIFY `id` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltax`
--
ALTER TABLE `tbltax`
  MODIFY `tax` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
