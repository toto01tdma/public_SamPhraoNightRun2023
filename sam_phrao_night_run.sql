-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 07:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sam_phrao_night_run`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `name`, `level`) VALUES
(1, 'super_admin12345', '$2y$10$q1.jfoC3bua7tWFMXoufeumV5AsHm3u8G4WQ60XiiFo/5FwjyuL/C', 'super_admin', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contestants`
--

CREATE TABLE `contestants` (
  `c_id` int(11) NOT NULL COMMENT 'รหัสผู้เข้าแข่งขัน',
  `cg_id` int(11) NOT NULL COMMENT 'รหัสกลุ่มผู้เข้าแข่งขัน',
  `status_approve` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'สถานะการอนุมัติ',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ชื่อ-สกุล',
  `id_card` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'รหัสบัตรประจำตัวประชาชน',
  `birth_day` date NOT NULL COMMENT 'วันเกิด',
  `age` int(11) NOT NULL COMMENT 'อายุ',
  `gender` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'เพศ',
  `nationality` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'สัญชาติ',
  `club` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'ชมรม',
  `phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `size` varchar(5) NOT NULL COMMENT 'ขนาดไซส์เสื้อผ้า',
  `type_sirt` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'แบบเสื้อ',
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ประเภทการแข่งขัน',
  `delivery` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'เลือกจัดส่งหรือไม่',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ที่อยู่จัดส่ง',
  `sub_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ขนาดอายุ',
  `price` double NOT NULL COMMENT 'ค่าชำระ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contestants_group`
--

CREATE TABLE `contestants_group` (
  `cg_id` int(11) NOT NULL COMMENT 'รหัสกลุ่มผู้เข้าแข่งขัน',
  `status_approve` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'สถานะการอนุมัติ',
  `date_register` datetime NOT NULL COMMENT 'วันที่ลงทะเบียน',
  `total` double NOT NULL COMMENT 'ค่าชำระเท่าไหร่',
  `overdue_payment` double NOT NULL COMMENT 'ค้างชำระอีกกี่บาท',
  `cause` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'สาเหตุที่ไม่ผ่านการอนุมัติ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message_report_problem`
--

CREATE TABLE `message_report_problem` (
  `id_mes` int(11) NOT NULL,
  `head_mes` varchar(100) NOT NULL,
  `content_mes` varchar(255) NOT NULL,
  `status_read` varchar(5) DEFAULT NULL,
  `date_report` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message_report_problem`
--

INSERT INTO `message_report_problem` (`id_mes`, `head_mes`, `content_mes`, `status_read`, `date_report`) VALUES
(3, 'รับสมัครเพิ่มไหมคับ', 'อยากสมัครคับ', 'true', '2023-02-01 17:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `slips`
--

CREATE TABLE `slips` (
  `slip_id` int(11) NOT NULL COMMENT 'รหัสสลิป',
  `cg_id` int(11) NOT NULL,
  `slip_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `upload_date` datetime NOT NULL COMMENT 'เวลาในการอัพสลิป'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `contestants`
--
ALTER TABLE `contestants`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `cg_id` (`cg_id`);

--
-- Indexes for table `contestants_group`
--
ALTER TABLE `contestants_group`
  ADD PRIMARY KEY (`cg_id`);

--
-- Indexes for table `message_report_problem`
--
ALTER TABLE `message_report_problem`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `slips`
--
ALTER TABLE `slips`
  ADD KEY `cg_id` (`cg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contestants`
--
ALTER TABLE `contestants`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสผู้เข้าแข่งขัน', AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `message_report_problem`
--
ALTER TABLE `message_report_problem`
  MODIFY `id_mes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contestants`
--
ALTER TABLE `contestants`
  ADD CONSTRAINT `contestants_ibfk_1` FOREIGN KEY (`cg_id`) REFERENCES `contestants_group` (`cg_id`);

--
-- Constraints for table `slips`
--
ALTER TABLE `slips`
  ADD CONSTRAINT `slips_ibfk_1` FOREIGN KEY (`cg_id`) REFERENCES `contestants_group` (`cg_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
