-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2022 at 11:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tablesalesreturnitem`
--

CREATE TABLE `tablesalesreturnitem` (
  `salesReturnId` int(254) NOT NULL,
  `salesItemId` int(254) NOT NULL,
  `inventoryId` int(254) NOT NULL,
  `quantity` int(29) NOT NULL,
  `total` int(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `branchId` varchar(10) NOT NULL,
  `name` varchar(59) NOT NULL,
  `branchAddress` varchar(59) NOT NULL,
  `branchContactNumber` varchar(12) NOT NULL,
  `auditTrailId` varchar(4) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`branchId`, `name`, `branchAddress`, `branchContactNumber`, `auditTrailId`, `active`) VALUES
('B-0000001', 'Taguig Branch', 'McKinley Pkwy, Taguig, 1630 Metro Manila', '+63983555723', 'AT00', 1),
('B-0000002', 'Quezon City Branch', 'North Avenue, corner Epifanio de los Santos Ave, Quezon Cit', '+63910555978', 'AT00', 1),
('B-0000003', 'Mandaluyong Branch', 'EDSA, corner Doña Julia Vargas Ave, Ortigas Center, Mandalu', '+63909555196', 'AT00', 2),
('B-0000004', 'San Fernando Branch', 'East Wing) and, Olongapo-Gapan Road, Lagundi, Mexico, San J', '+63283555472', 'AT00', 2);

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
('C-0000001', 'PC Case', 1),
('C-0000002', 'Graphics Card', 1),
('C-0000003', 'Laptop', 1),
('C-0000004', 'Processors', 1),
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
  `deliveryReceiptId` int(254) NOT NULL,
  `total` double NOT NULL,
  `userId` int(254) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliveryorderitem`
--

CREATE TABLE `tbldeliveryorderitem` (
  `deliveryOrderItemId` int(11) NOT NULL,
  `pendingOrderId` int(254) NOT NULL,
  `deliveryReceiptId` int(254) NOT NULL,
  `purchaseOrderId` int(254) NOT NULL,
  `productId` int(254) NOT NULL,
  `total` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `float` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblinventory`
--

CREATE TABLE `tblinventory` (
  `inventoryId` int(254) NOT NULL,
  `productId` int(254) NOT NULL,
  `branchId` int(254) NOT NULL,
  `markupPrice` double NOT NULL,
  `stockStatus` varchar(29) NOT NULL,
  `quantity` int(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayableitems`
--

CREATE TABLE `tblpayableitems` (
  `payableItemId` int(254) NOT NULL,
  `payablesId` int(254) NOT NULL,
  `deliveryReceiptId` int(254) NOT NULL,
  `total` double NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblpayables`
--

CREATE TABLE `tblpayables` (
  `payablesId` int(254) NOT NULL,
  `total` double NOT NULL,
  `userId` int(254) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `productId` varchar(20) NOT NULL,
  `name` varchar(69) NOT NULL,
  `supplier` varchar(29) NOT NULL,
  `categoryId` varchar(15) NOT NULL,
  `price` varchar(10) NOT NULL,
  `markupPrice` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`productId`, `name`, `supplier`, `categoryId`, `price`, `markupPrice`, `active`) VALUES
('P-0000001', 'Tecware Flatline Black TG mATX', 'S-0000001', 'C-0000001', '2090.00', '2299.00', 1),
('P-0000002', 'Tecware Forge M Omni Matx Case Black White', 'S-0000001', 'C-0000001', '3050.00', '3355.00', 1),
('P-0000003', 'Tecware Forge M2 Omni mATX Case Black ', 'S-0000001', 'C-0000001', '2290.00', '2519.00', 1),
('P-0000004', 'Tecware Forge S Omni Black ATX TG 4*120mm', 'S-0000001', 'C-0000001', '2990.00', '3289.00', 1),
('P-0000005', 'Tecware Forge L High-Airflow E-ATX', 'S-0000001', 'C-0000001', '4600.00', '5060.00', 1),
('P-0000006', 'Tecware Phantom 87 Key RGB Mechanical Keyboard Red/Blue/Brown Switch', 'S-0000001', 'C-0000005', '2280.00', '2508.00', 1),
('P-0000007', 'Tecware Spectre Pro, RGB Mechanical Keyboard, RGB LED (Outemu Brown)', 'S-0000001', 'C-0000005', '2400.00', '2640.00', 1),
('P-0000008', 'Tecware B68 Wireless RGB 68-Key / 65% layout PBT Keycaps Mechanical G', 'S-0000001', 'C-0000005', '2895.00', '3184.50', 2),
('P-0000009', 'Tecware B68+ RGB Backlit Wireless Mechanical Keyboard, 3 Mode, 68-Key', 'S-0000001', 'C-0000005', '3000.00', '3300.00', 2),
('P-0000010', 'Tecware Veil 80 TKL Black 3 mode BT Wireless 75% Layout Mech Keyboard', 'S-0000001', 'C-0000005', '5110.00', '5621.00', 1),
('P-0000011', 'Tecware Pulse Elite Wireless Gaming Mouse', 'S-0000001', 'C-0000005', '1750.00', '1925.00', 1),
('P-0000012', 'Tecware EXO Wireless RGB Gaming Mouse ', 'S-0000001', 'C-0000005', '1750.00', '1925.00', 2),
('P-0000013', 'Tecware Torque Pro RGB Gaming Mouse', 'S-0000001', 'C-0000005', '1450.00', '1595.00', 1),
('P-0000014', 'Tecware IMPULSE PRO RGB Gaming Mouse', 'S-0000001', 'C-0000005', '1300.00', '1430.00', 1),
('P-0000015', 'Tecware Q2 Gaming Headset', 'S-0000001', 'C-0000007', '940.00', '1,034.00', 1),
('P-0000016', 'Tecware Q5 HD 7.1 Surround + Wide Band Mic RGB Premium Gaming Headset', 'S-0000001', 'C-0000007', '1800.00', '1980.00', 2),
('P-0000017', 'Tecware Haste XL RGB Mousepad', 'S-0000001', 'C-0000005', '1100.00', '1210.00', 1),
('P-0000018', 'Tecware Keyboard Wrist Pad Full 445x100x25mm', 'S-0000001', 'C-0000005', '499.00', '548.90', 1),
('P-0000019', 'Tecware Alpha M mATX TG Chassis White ', 'S-0000001', 'C-0000001', '2680.00', '2948.00', 1),
('P-0000020', 'Tecware Vega M Tempered Chassis', 'S-0000001', 'C-0000001', '1669.00', '1835.90', 1),
('P-0000021', 'Asus B250 Mining Expert', 'S-0000002', 'C-0000009', '1999.00', '2198.9', 1),
('P-0000022', 'Asus ROG STRIX B250F GAMING ', 'S-0000002', 'C-0000009', '5499.00', '6048.90', 1),
('P-0000023', 'ASUS Maximus VI Hero', 'S-0000002', 'C-0000009', '7988.00', '8786.80', 1),
('P-0000024', 'ASUS Prime H610M-E D4 Intel LGA 1700', 'S-0000002', 'C-0000009', '5560.00', '6116.00', 1),
('P-0000025', 'Asus Prime Z690-A ATX LGA 1700 Motherboard', 'S-0000002', 'C-0000009', '15450.00', '16995.00', 1),
('P-0000026', 'ASUS EX-B460M-V5 Intel B460 LGA 1200 mATX Motherboard', 'S-0000002', 'C-0000009', '5150.00', '5665.00', 2),
('P-0000027', 'ASUS ZenBook 14 Ultra-Slim Laptop 14” FHD Display', 'S-0000002', 'C-0000003', '53183.00', '58501.30', 1),
('P-0000028', 'ASUS VivoBook Pro 15 OLED Ultra Slim Laptop, 15.6” FHD OLED Display', 'S-0000002', 'C-0000003', '49499.00', '54448.90', 1),
('P-0000029', 'ASUS TUF Gaming F17 Gaming Laptop, 17.3” 144Hz Full HD IPS-Type', 'S-0000002', 'C-0000003', '59900.00', '65890.00', 1),
('P-0000030', 'ASUS ROG Strix G15 Advantage Edition Gaming Laptop, 15.6\" 300Hz FHD D', 'S-0000002', 'C-0000003', '109900.00', '120890.00', 2),
('P-0000031', 'ASUS ROG G531GT-BI7N6 15.6\" FHD Gaming Laptop Computer', 'S-0000002', 'C-0000003', '86000.00', '94600.00', 2),
('P-0000032', 'ROG Strix XG16AHP Portable 144Hz Gaming Monitor ', 'S-0000002', 'C-0000010', '36000.00', '39600.00', 1),
('P-0000033', 'ASUS BE24EQK Business Monitor – 23.8 inch, Full HD, IPS, Frameless', 'S-0000002', 'C-0000010', '22354.00', '24589.40', 1),
('P-0000034', 'TUF Gaming VG259QR Gaming Monitor – 24.5 inch Full HD (1920 x 1080), ', 'S-0000002', 'C-0000010', '15495.00', '17044.50', 2),
('P-0000035', 'ASUS ROG SWIFT 360Hz PG259QNR eSports NVIDIA® G-SYNC', 'S-0000002', 'C-0000010', '42320.00', '46552.00', 2),
('P-0000036', 'ASUS Dual Radeon™ RX 6600 8GB GDDR6', 'S-0000002', 'C-0000002', '24995.00', '27494.50', 1),
('P-0000037', 'ASUS Dual Radeon™ RX 6700 XT 12GB GDDR6', 'S-0000002', 'C-0000002', '48999.00', '53898.90', 2),
('P-0000038', 'ASUS TUF GAMING Radeon™ RX 6800 XT', 'S-0000002', 'C-0000002', '88799.00', '97678.90', 1),
('P-0000039', 'ROG Strix GeForce RTX™ 3050 OC Edition 8GB GDDR6', 'S-0000002', 'C-0000002', '25000.00', '27500.00', 1),
('P-0000040', 'ROG Strix GeForce RTX™ 3080 OC Edition 12GB', 'S-0000002', 'C-0000002', '59060.00', '64966.00', 1),
('P-0000041', 'Intel® Core™ i7-12650HX Processor (24M Cache, up to 4.70 GHz)', 'S-0000002', 'C-0000004', '19000.00', '20900.00', 1),
('P-0000042', 'Intel® Core™ i5-12500H Processor (18M Cache, up to 4.50 GHz)', 'S-0000002', 'C-0000004', '13000.00', '14300.00', 1),
('P-0000043', 'Intel® Core™ i3-12100 Processor (12M Cache, up to 4.30 GHz)', 'S-0000002', 'C-0000004', '6290.00', '6919.00', 2),
('P-0000044', 'AMD Ryzen™ 5 3600', 'S-0000002', 'C-0000004', '10500.00', '11550.00', 1),
('P-0000045', 'AMD Ryzen™ 7 5700G', 'S-0000002', 'C-0000004', '15700.00', '17270.00', 1),
('P-0000046', 'ASUS TUF Gaming K7 Optical-Mech Keyboard with IP56', 'S-0000002', 'C-0000005', '7685.00', '8453.00', 2),
('P-0000047', 'ROG Strix Scope RX EVA Edition\r\n', 'S-0000002', 'C-0000005', '5405.00', '5945.50', 2),
('P-0000048', 'ROG PBT Doubleshot Keycap Set for ROG RX Switches', 'S-0000002', 'C-0000005', '2069.00', '2,275.9', 1),
('P-0000049', 'ROG Scabbard II EVA Edition', 'S-0000002', 'C-0000005', '995.00', '1094.50', 1),
('P-0000050', 'ROG Sheath GUNDAM EDITION', 'S-0000002', 'C-0000005', '1300.00', '1430.00', 1),
('P-0000051', 'AORUS GeForce RTX™ 3090 Ti XTREME WATERFORCE 24G', 'S-0000003', 'C-0000002', '220000.00', '242000.00', 1),
('P-0000052', 'AORUS GeForce RTX™ 3080 XTREME WATERFORCE 10G (rev. 2.0)', 'S-0000003', 'C-0000002', '31000.00', '34100.00', 1),
('P-0000053', 'AORUS GeForce RTX™ 3070 MASTER 8G (rev. 2.0)', 'S-0000003', 'C-0000002', '23000.00', '25300.00', 2),
('P-0000054', 'AORUS GeForce RTX™ 3060 Ti MASTER 8G', 'S-0000003', 'C-0000002', '20000.00', '22000.00', 2),
('P-0000055', 'AORUS GeForce® RTX 2080 SUPER™ WATERFORCE 8G', 'S-0000003', 'C-0000002', '25000.00', '27500.00', 1),
('P-0000056', 'Radeon™ RX 6600 XT EAGLE 8G', 'S-0000003', 'C-0000002', '27000.00', '29700.00', 1),
('P-0000057', 'Radeon™ RX 5600 XT WINDFORCE OC 6G', 'S-0000003', 'C-0000002', '58000.00', '63800.00', 1),
('P-0000058', 'Radeon™ RX 5500 XT D6 8G (rev. 2.0)', 'S-0000003', 'C-0000002', '24000.00', '26400.00', 1),
('P-0000059', 'Z690 AORUS XTREME WATERFORCE (rev. 1.0)', 'S-0000003', 'C-0000009', '58000.00', '63800.00', 1),
('P-0000060', 'Z690 AORUS ELITE AX (rev. 1.x)', 'S-0000003', 'C-0000009', '15000.00', '16500.00', 1),
('P-0000061', 'H610M S2 DDR4 (rev. 1.2)', 'S-0000003', 'C-0000009', '5200.00', '5720.00', 2),
('P-0000062', 'Z690I AORUS ULTRA PLUS DDR4 (rev. 1.0)', 'S-0000003', 'C-0000009', '15895.00', '17484.50', 1),
('P-0000063', 'B660M AORUS ELITE DDR4 (rev. 1.0)', 'S-0000003', 'C-0000009', '7350.00', '8085.00', 2),
('P-0000064', 'Z690 AERO D (rev. 1.x)', 'S-0000003', 'C-0000009', '16500.00', '18150.00', 1),
('P-0000065', 'B550M AORUS PRO AX (rev. 1.1)', 'S-0000003', 'C-0000009', '7800.00', '8580.00', 2),
('P-0000066', 'X570SI AORUS PRO AX (rev. 1.1)', 'S-0000003', 'C-0000009', '13800.00', '15180.00', 1),
('P-0000067', 'X570 AORUS XTREME (rev. 1.2)', 'S-0000003', 'C-0000009', '48500.00', '53350.00', 2),
('P-0000068', 'AORUS C700 GLASS', 'S-0000003', 'C-0000001', '24499.00', '26948.90', 1),
('P-0000069', 'AORUS C500 GLASS', 'S-0000003', 'C-0000001', '7199.00', '7918.90', 2),
('P-0000070', 'AORUS C300 GLASS', 'S-0000003', 'C-0000001', '7380.00', '8118.00', 2),
('P-0000071', 'AC300W (rev. 2.0)', 'S-0000003', 'C-0000001', '7295.00', '8024.50', 1),
('P-0000072', 'AC300W Lite', 'S-0000003', 'C-0000001', '6750.00', '7424.00', 2),
('P-0000073', 'XC700W ATX Full-tower PC Case \r\n', 'S-0000003', 'C-0000001', '16000.00', '17600.00', 2),
('P-0000074', 'GIGABYTE Horus P2', 'S-0000003', 'C-0000001', '18590.00', '20449.00', 1),
('P-0000075', 'AORUS RGB Memory DDR5 32GB (2x16GB) 6000MHz', 'S-0000003', 'C-0000006', '15995.00', '17594.50', 1),
('P-0000076', 'AORUS RGB Memory 16GB (2x8GB) 3600MHz', 'S-0000003', 'C-0000006', '6699.00', '7368.90', 1),
('P-0000077', 'DESIGNARE Memory 64GB (2x32GB) 3200MHz', 'S-0000003', 'C-0000006', '24720.00', '27192.00', 1),
('P-0000078', 'GIGABYTE Memory 8GB (1x8GB) 2666MHz', 'S-0000003', 'C-0000006', '2300.00', '2530.00', 2),
('P-0000079', 'AORUS Model X Gaming Desktop Computer', 'S-0000003', 'C-0000008', '142974.00', '157271.40', 2),
('P-0000080', ' AORUS MODEL S Gaming PC Computer Desktop ', 'S-0000003', 'C-0000008', '126500.00', '139150.00', 1),
('P-0000081', 'MSI Titan GT77 17.3\" UHD 120Hz Gaming Laptop', 'S-0000004', 'C-0000003', '164970.00', '181467.00', 1),
('P-0000082', 'MSI Stealth GS77 17.3\" UHD 4K 120Hz Ultra Thin and Light Gaming Lapto', 'S-0000004', 'C-0000003', '247900.00', '272690.00', 2),
('P-0000083', 'IMMERSE GV60 STREAMING MIC', 'S-0000004', 'C-0000005', '2059.00', '2264.90', 1),
('P-0000084', 'MSI Immerse GH50 Wired Gaming Headset', 'S-0000004', 'C-0000005', '3060.00', '3366.00', 1),
('P-0000085', 'MSI Gaming Vector GP66', 'S-0000004', 'C-0000003', '89670.00', '98637.00', 1),
('P-0000086', ' MSI Raider GE76 12UHS-255 Gaming Laptop', 'S-0000004', 'C-0000003', '135150.00', '148665.00', 2),
('P-0000087', 'MSI Clutch GM11 White Gaming Mouse - 5000 DPI', 'S-0000004', 'C-0000005', '895.00', '984.50', 2),
('P-0000088', 'MSI DS502 Gaming Headset, Enhanced Virtual 7.1 Surround Sound', 'S-0000004', 'C-0000007', '4350.00', '4785.00', 1),
('P-0000089', 'PERIPHERIQUE Gaming MSI IMMERSE GH10', 'S-0000004', 'C-0000007', '3499.00', '3848.90', 1),
('P-0000090', 'MSI SPATIUM M480 PCIe 4.0 NVMe M.2 2TB Internal SSD', 'S-0000004', 'C-0000006', '9550.00', '10505.00', 1),
('P-0000091', 'MSI SPATIUM M450 PCIe 4.0 NVMe M.2 1TB Internal Gaming SSD ', 'S-0000004', 'C-0000006', '3599.00', '3958.90', 1),
('P-0000092', 'MSI SPATIUM M370 NVMe M.2 1TB Internal SSD', 'S-0000004', 'C-0000006', '8743.83', '9618.20', 1),
('P-0000093', 'MSI Full HD 1920 x 1080 360Hz LED Backlit Gaming Monitor', 'S-0000004', 'C-0000010', '23645.00', '26009.50', 2),
('P-0000094', 'MSI Agility GD20 Premium Gaming Mouse Pad', 'S-0000004', 'C-0000005', '495.00', '544.50', 1),
('P-0000095', 'MSI MAG Z690 Tomahawk WiFi DDR4 Gaming Motherboard', 'S-0000004', 'C-0000009', '15799.00', '17378.90', 1),
('P-0000096', 'MSI MPG Z690 Carbon WiFi Gaming Motherboard ', 'S-0000004', 'C-0000009', '19200.00', '21120.00', 1),
('P-0000097', 'GALAX Gaming Headset (SNR-01)', 'S-0000005', 'C-0000007', '3200.00', '3520.00', 2),
('P-0000098', 'GALAX GeForce® GTX 1660 Super X Edition (1-Click OC)', 'S-0000005', 'C-0000002', '23999.00', '26398.00', 2),
('P-0000099', 'GALAX GeForce® GT 1030 DDR4 GALAX GeForce® GT 1030 DDR4', 'S-0000005', 'C-0000002', '4869.0', '5355.9', 1),
('P-0000100', 'GALAX VI-01 Gaming Monitor Borderless 27 Inch / IPS / LED / HDR', 'S-0000005', 'C-0000010', '18999.00', '20898.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchaseorder`
--

CREATE TABLE `tblpurchaseorder` (
  `purchaseOrderId` int(254) NOT NULL,
  `supplierId` int(254) NOT NULL,
  `total` double NOT NULL,
  `userId` int(254) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblpurchaseorderitem`
--

CREATE TABLE `tblpurchaseorderitem` (
  `pendingOrderId` int(254) NOT NULL,
  `purchaseOrderId` int(254) NOT NULL,
  `productId` int(254) NOT NULL,
  `total` double NOT NULL,
  `quantity` double NOT NULL,
  `floats` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblsales`
--

CREATE TABLE `tblsales` (
  `salesId` varchar(2) NOT NULL,
  `total` int(29) NOT NULL,
  `taxId` int(254) NOT NULL,
  `pending` int(1) NOT NULL,
  `userId` int(2) NOT NULL,
  `branchId` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblsalesitem`
--

CREATE TABLE `tblsalesitem` (
  `salesItemId` int(254) NOT NULL,
  `productId` int(254) NOT NULL,
  `salesId` varchar(2) NOT NULL,
  `quantity` int(29) NOT NULL,
  `total` int(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblsalesreturn`
--

CREATE TABLE `tblsalesreturn` (
  `salesReturnId` int(254) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstockadjustment`
--

CREATE TABLE `tblstockadjustment` (
  `stockTransferId` int(254) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstockadjustmentitem`
--

CREATE TABLE `tblstockadjustmentitem` (
  `stockAdjustmentId` int(254) NOT NULL,
  `inventoryId` int(254) NOT NULL,
  `quantity` int(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstocktransfer`
--

CREATE TABLE `tblstocktransfer` (
  `stockTransferId` int(254) NOT NULL,
  `branchIdFrom` int(254) NOT NULL,
  `branchIdTo` int(254) NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `auditTrailId` int(254) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstocktransferitem`
--

CREATE TABLE `tblstocktransferitem` (
  `stockTransferId` int(254) NOT NULL,
  `inventoryId` int(254) NOT NULL,
  `quantity` int(29) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('S-0000001\r\n', 'Tecware', '+63 9215557167', 'tecware@gmail.com', '#22 Josefa Bldg. San Vicente Centro Urdaneta Pangasinan 2428 Urdaneta', 1),
('S-0000002', 'Asus', '+63 9195556353', 'asus@gmail.com', 'Hanston Building, Emerald Ave, Ortigas Center, Pasig, 1605 Metro Mani', 1),
('S-0000003', 'Gigabyte', '+63 8905550672', 'gigabyte@yahoo.com', '4448 Calatagan St, Makati, 1235 Metro Manila', 1),
('S-0000004', 'MSI ', '+63 9235557389', 'msi@yahoo.com', '4/F, The Annex, SM City North EDSA, 173, Sto. Cristo St, Quezon City,', 1),
('S-0000005', 'Galax', '+63 9857412568', 'galax@gmail.com', 'McKinley Pkwy, Taguig, 1630 Metro Manila', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltax`
--

CREATE TABLE `tbltax` (
  `id` int(254) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(255) NOT NULL,
  `firstName` varchar(99) NOT NULL,
  `lastName` varchar(99) NOT NULL,
  `emailAddress` varchar(99) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` int(1) NOT NULL,
  `branchId` varchar(2) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `firstName`, `lastName`, `emailAddress`, `password`, `permission`, `branchId`, `active`) VALUES
(1, 'Jeremy', 'Langcay', 'langcayjeremy@gmail.com', 'jeremy', 1, '1', 1),
(2, 'Richmonde', 'Toledo', 'richtoledo@gmail.com', 'richmonde', 2, '2', 2),
(3, 'Aleck', 'Valdez', 'aleckvaldez@gmail.com', 'aleck', 1, '1', 1),
(4, 'Ray Allen', 'Santos', 'raysantos@gmail.com', 'allen', 2, '2', 1),
(5, 'Kim Joshua', 'Quiambao', 'kimquiambao@gmail.com', 'josh', 3, '4', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`branchId`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldeliveryorder`
--
ALTER TABLE `tbldeliveryorder`
  ADD PRIMARY KEY (`deliveryReceiptId`);

--
-- Indexes for table `tblinventory`
--
ALTER TABLE `tblinventory`
  ADD PRIMARY KEY (`inventoryId`);

--
-- Indexes for table `tblpayableitems`
--
ALTER TABLE `tblpayableitems`
  ADD PRIMARY KEY (`payableItemId`);

--
-- Indexes for table `tblpermissions`
--
ALTER TABLE `tblpermissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `tblpurchaseorder`
--
ALTER TABLE `tblpurchaseorder`
  ADD PRIMARY KEY (`purchaseOrderId`);

--
-- Indexes for table `tblsales`
--
ALTER TABLE `tblsales`
  ADD PRIMARY KEY (`salesId`);

--
-- Indexes for table `tblsalesitem`
--
ALTER TABLE `tblsalesitem`
  ADD PRIMARY KEY (`salesItemId`);

--
-- Indexes for table `tblsalesreturn`
--
ALTER TABLE `tblsalesreturn`
  ADD PRIMARY KEY (`salesReturnId`);

--
-- Indexes for table `tblstockadjustment`
--
ALTER TABLE `tblstockadjustment`
  ADD PRIMARY KEY (`stockTransferId`);

--
-- Indexes for table `tblstocktransferitem`
--
ALTER TABLE `tblstocktransferitem`
  ADD PRIMARY KEY (`stockTransferId`);

--
-- Indexes for table `tblsupplier`
--
ALTER TABLE `tblsupplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltax`
--
ALTER TABLE `tbltax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`,`branchId`,`permission`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbldeliveryorder`
--
ALTER TABLE `tbldeliveryorder`
  MODIFY `deliveryReceiptId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinventory`
--
ALTER TABLE `tblinventory`
  MODIFY `inventoryId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpayableitems`
--
ALTER TABLE `tblpayableitems`
  MODIFY `payableItemId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpermissions`
--
ALTER TABLE `tblpermissions`
  MODIFY `id` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpurchaseorder`
--
ALTER TABLE `tblpurchaseorder`
  MODIFY `purchaseOrderId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsalesitem`
--
ALTER TABLE `tblsalesitem`
  MODIFY `salesItemId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsalesreturn`
--
ALTER TABLE `tblsalesreturn`
  MODIFY `salesReturnId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstockadjustment`
--
ALTER TABLE `tblstockadjustment`
  MODIFY `stockTransferId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstocktransferitem`
--
ALTER TABLE `tblstocktransferitem`
  MODIFY `stockTransferId` int(254) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltax`
--
ALTER TABLE `tbltax`
  MODIFY `id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
