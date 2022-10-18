-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 03:48 PM
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
-- Database: `salesandinventory`
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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `branchId` varchar(4) NOT NULL,
  `branchName` varchar(59) NOT NULL,
  `branchAddress` varchar(59) NOT NULL,
  `branchContactNumber` varchar(12) NOT NULL,
  `auditTrailId` varchar(4) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`branchId`, `branchName`, `branchAddress`, `branchContactNumber`, `auditTrailId`, `active`) VALUES
('B1', 'Taguig Branch', 'McKinley Pkwy, Taguig, 1630 Metro Manila', '+63983555723', 'AT00', 1),
('B2', 'Quezon City Branch', 'North Avenue, corner Epifanio de los Santos Ave, Quezon Cit', '+63910555978', 'AT00', 1),
('B3', 'Mandaluyong Branch', 'EDSA, corner Doña Julia Vargas Ave, Ortigas Center, Mandalu', '+63909555196', 'AT00', 2),
('B4', 'San Fernando Branch', 'East Wing) and, Olongapo-Gapan Road, Lagundi, Mexico, San J', '+63283555472', 'AT00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `categoryId` int(254) NOT NULL,
  `categoryName` varchar(29) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`categoryId`, `categoryName`, `active`) VALUES
(1, 'PC Case', 1),
(2, 'Graphics Card', 1),
(3, 'Laptop', 1),
(4, 'Processors', 1),
(5, 'Peripherals', 1),
(6, 'Memory', 1),
(7, 'Audio', 1),
(8, 'Desktop', 1),
(9, 'Motherboard', 1),
(10, 'Monitor', 1);

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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblpermissions`
--

CREATE TABLE `tblpermissions` (
  `permissionId` int(254) NOT NULL,
  `permissionName` varchar(29) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `productId` varchar(20) NOT NULL,
  `productName` varchar(69) NOT NULL,
  `supplier` varchar(29) NOT NULL,
  `categoryId` int(254) NOT NULL,
  `price` varchar(10) NOT NULL,
  `markupPrice` varchar(10) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`productId`, `productName`, `supplier`, `categoryId`, `price`, `markupPrice`, `active`) VALUES
('P0001', 'Tecware Flatline Black TG mATX', 'S0001', 1, '2090.00', '2299.00', 1),
('P0002', 'Tecware Forge M Omni Matx Case Black White', 'S0001', 1, '3050.00', '3355.00', 1),
('P0003', 'Tecware Forge M2 Omni mATX Case Black ', 'S0001', 1, '2290.00', '2519.00', 1),
('P0004', 'Tecware Forge S Omni Black ATX TG 4*120mm', 'S0001', 1, '2990.00', '3289.00', 1),
('P0005', 'Tecware Forge L High-Airflow E-ATX', 'S0001', 1, '4600.00', '5060.00', 1),
('P0006', 'Tecware Phantom 87 Key RGB Mechanical Keyboard Red/Blue/Brown Switch', 'S0001', 5, '2280.00', '2508.00', 1),
('P0007', 'Tecware Spectre Pro, RGB Mechanical Keyboard, RGB LED (Outemu Brown)', 'S0001', 5, '2400.00', '2640.00', 1),
('P0008', 'Tecware B68 Wireless RGB 68-Key / 65% layout PBT Keycaps Mechanical G', 'S0001', 5, '2895.00', '3184.50', 2),
('P0009', 'Tecware B68+ RGB Backlit Wireless Mechanical Keyboard, 3 Mode, 68-Key', 'S0001', 5, '3000.00', '3300.00', 2),
('P0010', 'Tecware Veil 80 TKL Black 3 mode BT Wireless 75% Layout Mech Keyboard', 'S0001', 5, '5110.00', '5621.00', 1),
('P0011', 'Tecware Pulse Elite Wireless Gaming Mouse', 'S0001', 5, '1750.00', '1925.00', 1),
('P0012', 'Tecware EXO Wireless RGB Gaming Mouse ', 'S0001', 5, '1750.00', '1925.00', 2),
('P0013', 'Tecware Torque Pro RGB Gaming Mouse', 'S0001', 5, '1450.00', '1595.00', 1),
('P0014', 'Tecware IMPULSE PRO RGB Gaming Mouse', 'S0001', 5, '1300.00', '1430.00', 1),
('P0015', 'Tecware Q2 Gaming Headset', 'S0001', 7, '940.00', '1,034.00', 1),
('P0016', 'Tecware Q5 HD 7.1 Surround + Wide Band Mic RGB Premium Gaming Headset', 'S0001', 7, '1800.00', '1980.00', 2),
('P0017', 'Tecware Haste XL RGB Mousepad', 'S0001', 5, '1100.00', '1210.00', 1),
('P0018', 'Tecware Keyboard Wrist Pad Full 445x100x25mm', 'S0001', 5, '499.00', '548.90', 1),
('P0019', 'Tecware Alpha M mATX TG Chassis White ', 'S0001', 1, '2680.00', '2948.00', 1),
('P0020', 'Tecware Vega M Tempered Chassis', 'S0001', 1, '1669.00', '1835.90', 1),
('P0021', 'Asus B250 Mining Expert', 'S0002', 9, '1999.00', '2198.9', 1),
('P0022', 'Asus ROG STRIX B250F GAMING ', 'S0002', 9, '5499.00', '6048.90', 1),
('P0023', 'ASUS Maximus VI Hero', 'S0002', 9, '7988.00', '8786.80', 1),
('P0024', 'ASUS Prime H610M-E D4 Intel LGA 1700', 'S0002', 9, '5560.00', '6116.00', 1),
('P0025', 'Asus Prime Z690-A ATX LGA 1700 Motherboard', 'S0002', 9, '15450.00', '16995.00', 1),
('P0026', 'ASUS EX-B460M-V5 Intel B460 LGA 1200 mATX Motherboard', 'S0002', 9, '5150.00', '5665.00', 2),
('P0027', 'ASUS ZenBook 14 Ultra-Slim Laptop 14” FHD Display', 'S0002', 3, '53183.00', '58501.30', 1),
('P0028', 'ASUS VivoBook Pro 15 OLED Ultra Slim Laptop, 15.6” FHD OLED Display', 'S0002', 3, '49499.00', '54448.90', 1),
('P0029', 'ASUS TUF Gaming F17 Gaming Laptop, 17.3” 144Hz Full HD IPS-Type', 'S0002', 3, '59900.00', '65890.00', 1),
('P0030', 'ASUS ROG Strix G15 Advantage Edition Gaming Laptop, 15.6\" 300Hz FHD D', 'S0002', 3, '109900.00', '120890.00', 2),
('P0031', 'ASUS ROG G531GT-BI7N6 15.6\" FHD Gaming Laptop Computer', 'S0002', 3, '86000.00', '94600.00', 2),
('P0032', 'ROG Strix XG16AHP Portable 144Hz Gaming Monitor ', 'S0002', 10, '36000.00', '39600.00', 1),
('P0033', 'ASUS BE24EQK Business Monitor – 23.8 inch, Full HD, IPS, Frameless', 'S0002', 10, '22354.00', '24589.40', 1),
('P0034', 'TUF Gaming VG259QR Gaming Monitor – 24.5 inch Full HD (1920 x 1080), ', 'S0002', 10, '15495.00', '17044.50', 2),
('P0035', 'ASUS ROG SWIFT 360Hz PG259QNR eSports NVIDIA® G-SYNC', 'S0002', 10, '42320.00', '46552.00', 2),
('P0036', 'ASUS Dual Radeon™ RX 6600 8GB GDDR6', 'S0002', 2, '24995.00', '27494.50', 1),
('P0037', 'ASUS Dual Radeon™ RX 6700 XT 12GB GDDR6', 'S0002', 2, '48999.00', '53898.90', 2),
('P0038', 'ASUS TUF GAMING Radeon™ RX 6800 XT', 'S0002', 2, '88799.00', '97678.90', 1),
('P0039', 'ROG Strix GeForce RTX™ 3050 OC Edition 8GB GDDR6', 'S0002', 2, '25000.00', '27500.00', 1),
('P0040', 'ROG Strix GeForce RTX™ 3080 OC Edition 12GB', 'S0002', 2, '59060.00', '64966.00', 1),
('P0041', 'Intel® Core™ i7-12650HX Processor (24M Cache, up to 4.70 GHz)', 'S0002', 4, '19000.00', '20900.00', 1),
('P0042', 'Intel® Core™ i5-12500H Processor (18M Cache, up to 4.50 GHz)', 'S0002', 4, '13000.00', '14300.00', 1),
('P0043', 'Intel® Core™ i3-12100 Processor (12M Cache, up to 4.30 GHz)', 'S0002', 4, '6290.00', '6919.00', 2),
('P0044', 'AMD Ryzen™ 5 3600', 'S0002', 4, '10500.00', '11550.00', 1),
('P0045', 'AMD Ryzen™ 7 5700G', 'S0002', 4, '15700.00', '17270.00', 1),
('P0046', 'ASUS TUF Gaming K7 Optical-Mech Keyboard with IP56', 'S0002', 5, '7685.00', '8453.00', 2),
('P0047', 'ROG Strix Scope RX EVA Edition\r\n', 'S0002', 5, '5405.00', '5945.50', 2),
('P0048', 'ROG PBT Doubleshot Keycap Set for ROG RX Switches', 'S0002', 5, '2069.00', '2,275.9', 1),
('P0049', 'ROG Scabbard II EVA Edition', 'S0002', 5, '995.00', '1094.50', 1),
('P0050', 'ROG Sheath GUNDAM EDITION', 'S0002', 5, '1300.00', '1430.00', 1),
('P0051', 'AORUS GeForce RTX™ 3090 Ti XTREME WATERFORCE 24G', 'S0003', 2, '220000.00', '242000.00', 1),
('P0052', 'AORUS GeForce RTX™ 3080 XTREME WATERFORCE 10G (rev. 2.0)', 'S0003', 2, '31000.00', '34100.00', 1),
('P0053', 'AORUS GeForce RTX™ 3070 MASTER 8G (rev. 2.0)', 'S0003', 2, '23000.00', '25300.00', 2),
('P0054', 'AORUS GeForce RTX™ 3060 Ti MASTER 8G', 'S0003', 2, '20000.00', '22000.00', 2),
('P0055', 'AORUS GeForce® RTX 2080 SUPER™ WATERFORCE 8G', 'S0003', 2, '25000.00', '27500.00', 1),
('P0056', 'Radeon™ RX 6600 XT EAGLE 8G', 'S0003', 2, '27000.00', '29700.00', 1),
('P0057', 'Radeon™ RX 5600 XT WINDFORCE OC 6G', 'S0003', 2, '58000.00', '63800.00', 1),
('P0058', 'Radeon™ RX 5500 XT D6 8G (rev. 2.0)', 'S0003', 2, '24000.00', '26400.00', 1),
('P0059', 'Z690 AORUS XTREME WATERFORCE (rev. 1.0)', 'S0003', 9, '58000.00', '63800.00', 1),
('P0060', 'Z690 AORUS ELITE AX (rev. 1.x)', 'S0003', 9, '15000.00', '16500.00', 1),
('P0061', 'H610M S2 DDR4 (rev. 1.2)', 'S0003', 9, '5200.00', '5720.00', 2),
('P0062', 'Z690I AORUS ULTRA PLUS DDR4 (rev. 1.0)', 'S0003', 9, '15895.00', '17484.50', 1),
('P0063', 'B660M AORUS ELITE DDR4 (rev. 1.0)', 'S0003', 9, '7350.00', '8085.00', 2),
('P0064', 'Z690 AERO D (rev. 1.x)', 'S0003', 9, '16500.00', '18150.00', 1),
('P0065', 'B550M AORUS PRO AX (rev. 1.1)', 'S0003', 9, '7800.00', '8580.00', 2),
('P0066', 'X570SI AORUS PRO AX (rev. 1.1)', 'S0003', 9, '13800.00', '15180.00', 1),
('P0067', 'X570 AORUS XTREME (rev. 1.2)', 'S0003', 9, '48500.00', '53350.00', 2),
('P0068', 'AORUS C700 GLASS', 'S0003', 1, '24499.00', '26948.90', 1),
('P0069', 'AORUS C500 GLASS', 'S0003', 1, '7199.00', '7918.90', 2),
('P0070', 'AORUS C300 GLASS', 'S0003', 1, '7380.00', '8118.00', 2),
('P0071', 'AC300W (rev. 2.0)', 'S0003', 1, '7295.00', '8024.50', 1),
('P0072', 'AC300W Lite', 'S0003', 1, '6750.00', '7424.00', 2),
('P0073', 'XC700W ATX Full-tower PC Case \r\n', 'S0003', 1, '16000.00', '17600.00', 2),
('P0074', 'GIGABYTE Horus P2', 'S0003', 1, '18590.00', '20449.00', 1),
('P0075', 'AORUS RGB Memory DDR5 32GB (2x16GB) 6000MHz', 'S0003', 6, '15995.00', '17594.50', 1),
('P0076', 'AORUS RGB Memory 16GB (2x8GB) 3600MHz', 'S0003', 6, '6699.00', '7368.90', 1),
('P0077', 'DESIGNARE Memory 64GB (2x32GB) 3200MHz', 'S0003', 6, '24720.00', '27192.00', 1),
('P0078', 'GIGABYTE Memory 8GB (1x8GB) 2666MHz', 'S0003', 6, '2300.00', '2530.00', 2),
('P0079', 'AORUS Model X Gaming Desktop Computer', 'S0003', 8, '142974.00', '157271.40', 2),
('P0080', ' AORUS MODEL S Gaming PC Computer Desktop ', 'S0003', 8, '126500.00', '139150.00', 1),
('P0081', 'MSI Titan GT77 17.3\" UHD 120Hz Gaming Laptop', 'S0004', 3, '164970.00', '181467.00', 1),
('P0082', 'MSI Stealth GS77 17.3\" UHD 4K 120Hz Ultra Thin and Light Gaming Lapto', 'S0004', 3, '247900.00', '272690.00', 2),
('P0083', 'IMMERSE GV60 STREAMING MIC', 'S0004', 5, '2059.00', '2264.90', 1),
('P0084', 'MSI Immerse GH50 Wired Gaming Headset', 'S0004', 5, '3060.00', '3366.00', 1),
('P0085', 'MSI Gaming Vector GP66', 'S0004', 3, '89670.00', '98637.00', 1),
('P0086', ' MSI Raider GE76 12UHS-255 Gaming Laptop', 'S0004', 3, '135150.00', '148665.00', 2),
('P0087', 'MSI Clutch GM11 White Gaming Mouse - 5000 DPI', 'S0004', 5, '895.00', '984.50', 2),
('P0088', 'MSI DS502 Gaming Headset, Enhanced Virtual 7.1 Surround Sound', 'S0004', 7, '4350.00', '4785.00', 1),
('P0089', 'PERIPHERIQUE Gaming MSI IMMERSE GH10', 'S0004', 7, '3499.00', '3848.90', 1),
('P0090', 'MSI SPATIUM M480 PCIe 4.0 NVMe M.2 2TB Internal SSD', 'S0004', 6, '9550.00', '10505.00', 1),
('P0091', 'MSI SPATIUM M450 PCIe 4.0 NVMe M.2 1TB Internal Gaming SSD ', 'S0004', 6, '3599.00', '3958.90', 1),
('P0092', 'MSI SPATIUM M370 NVMe M.2 1TB Internal SSD', 'S0004', 6, '8743.83', '9618.20', 1),
('P0093', 'MSI Full HD 1920 x 1080 360Hz LED Backlit Gaming Monitor', 'S0004', 10, '23645.00', '26009.50', 2),
('P0094', 'MSI Agility GD20 Premium Gaming Mouse Pad', 'S0004', 5, '495.00', '544.50', 1),
('P0095', 'MSI MAG Z690 Tomahawk WiFi DDR4 Gaming Motherboard', 'S0004', 9, '15799.00', '17378.90', 1),
('P0096', 'MSI MPG Z690 Carbon WiFi Gaming Motherboard ', 'S0004', 9, '19200.00', '21120.00', 1),
('P0097', 'GALAX Gaming Headset (SNR-01)', 'S0005', 7, '3200.00', '3520.00', 2),
('P0098', 'GALAX GeForce® GTX 1660 Super X Edition (1-Click OC)', 'S0005', 2, '23999.00', '26398.00', 2),
('P0099', 'GALAX GeForce® GT 1030 DDR4 GALAX GeForce® GT 1030 DDR4', 'S0005', 2, '4869.0', '5355.9', 1),
('P0100', 'GALAX VI-01 Gaming Monitor Borderless 27 Inch / IPS / LED / HDR', 'S0005', 10, '18999.00', '20898.00', 1);

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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
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
  `total` int(29) NOT NULL
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
  `active` int(1) NOT NULL
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
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstockadjustmentitem`
--

CREATE TABLE `tblstockadjustmentitem` (
  `stockAdjustmentId` int(254) NOT NULL,
  `inventoryId` int(254) NOT NULL,
  `quantity` int(29) NOT NULL,
  `active` int(1) NOT NULL
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
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblstocktransferitem`
--

CREATE TABLE `tblstocktransferitem` (
  `stockTransferId` int(254) NOT NULL,
  `inventoryId` int(254) NOT NULL,
  `quantity` int(29) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `supplierId` varchar(254) NOT NULL,
  `supplierName` varchar(49) NOT NULL,
  `contactNumber` varchar(49) NOT NULL,
  `emailAddress` varchar(49) NOT NULL,
  `address` varchar(69) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsupplier`
--

INSERT INTO `tblsupplier` (`supplierId`, `supplierName`, `contactNumber`, `emailAddress`, `address`, `active`) VALUES
('S0001', 'Tecware', '+63 9215557167', 'tecware@gmail.com', '#22 Josefa Bldg. San Vicente Centro Urdaneta Pangasinan 2428 Urdaneta', 1),
('S0002', 'Asus', '+63 9195556353', 'asus@gmail.com', 'Hanston Building, Emerald Ave, Ortigas Center, Pasig, 1605 Metro Mani', 1),
('S0003', 'Gigabyte', '+63 8905550672', 'gigabyte@yahoo.com', '4448 Calatagan St, Makati, 1235 Metro Manila', 1),
('S0004', 'MSI ', '+63 9235557389', 'msi@yahoo.com', '4/F, The Annex, SM City North EDSA, 173, Sto. Cristo St, Quezon City,', 1),
('S0005', 'Galax', '+63 9857412568', 'galax@gmail.com', 'McKinley Pkwy, Taguig, 1630 Metro Manila', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltax`
--

CREATE TABLE `tbltax` (
  `taxId` int(254) NOT NULL,
  `amount` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userId` int(255) NOT NULL,
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

INSERT INTO `tblusers` (`userId`, `firstName`, `lastName`, `emailAddress`, `password`, `permission`, `branchId`, `active`) VALUES
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
  ADD PRIMARY KEY (`categoryId`);

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
  ADD PRIMARY KEY (`permissionId`);

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
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `tbltax`
--
ALTER TABLE `tbltax`
  ADD PRIMARY KEY (`taxId`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userId`,`branchId`,`permission`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `categoryId` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `permissionId` int(254) NOT NULL AUTO_INCREMENT;

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
  MODIFY `taxId` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userId` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
