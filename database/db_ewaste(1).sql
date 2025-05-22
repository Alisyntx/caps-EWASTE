-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 07:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ewaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catalog`
--

CREATE TABLE `tbl_catalog` (
  `ctg_id` int(11) NOT NULL,
  `ctg_name` text NOT NULL,
  `ctg_datead` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_catalog`
--

INSERT INTO `tbl_catalog` (`ctg_id`, `ctg_name`, `ctg_datead`) VALUES
(7, 'Papers', '2024-10-07 20:29:30'),
(20, 'bags', '2024-10-12 22:21:45'),
(29, 'ballpens', '2024-11-08 17:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cty_id` int(11) NOT NULL,
  `cty_name` varchar(100) NOT NULL,
  `cty_desc` text NOT NULL,
  `cty_dateadd` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cty_id`, `cty_name`, `cty_desc`, `cty_dateadd`) VALUES
(41, 'Mobile Device\'s', '', '2024-09-17'),
(42, 'Computing Device\'s', '', '2024-09-17'),
(43, 'Audio-Visual Equipment', '', '2024-09-17'),
(44, 'battery', '', '2024-10-02'),
(51, 'accessories', '', '2024-11-29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cdtn`
--

CREATE TABLE `tbl_cdtn` (
  `cdtn_id` int(11) NOT NULL,
  `cdtn_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cdtn`
--

INSERT INTO `tbl_cdtn` (`cdtn_id`, `cdtn_type`) VALUES
(1, 'damage'),
(2, 'Slightly Damage'),
(3, 'Undamaged');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ewst`
--

CREATE TABLE `tbl_ewst` (
  `ewst_id` int(11) NOT NULL,
  `ewst_name` varchar(100) NOT NULL,
  `ewst_userfk` int(11) NOT NULL,
  `ewst_img` text NOT NULL,
  `ewst_ctyfk` int(11) NOT NULL,
  `ewst_gcon` int(100) NOT NULL,
  `ewst_pdam` int(100) NOT NULL,
  `ewst_fdam` int(100) NOT NULL,
  `ewst_recycle` int(200) NOT NULL,
  `ewst_dateadd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ewst`
--

INSERT INTO `tbl_ewst` (`ewst_id`, `ewst_name`, `ewst_userfk`, `ewst_img`, `ewst_ctyfk`, `ewst_gcon`, `ewst_pdam`, `ewst_fdam`, `ewst_recycle`, `ewst_dateadd`) VALUES
(92, 'Smart Phones', 0, 'IMG_66e987b01a4ba2.98233565.jpg', 41, 100, 50, 25, 2, '2024-09-17 10:17:27'),
(93, 'Laptop', 0, 'IMG_66e987c89c1c49.26649413.jpg', 42, 180, 80, 40, 2, '2024-09-17 10:21:00'),
(95, 'earphones', 0, 'IMG_66e98a73b748b6.36028701.png', 43, 60, 30, 10, 1, '2024-09-17 11:26:26'),
(96, 'Tablets', 0, 'IMG_66e98f29e9aee8.36207513.jpg', 41, 150, 80, 40, 2, '2024-09-17 22:16:09'),
(107, 'headphone', 0, 'IMG_672dd9a163c7f8.09610276.jpg', 43, 70, 50, 20, 2, '2024-11-08 17:28:01'),
(108, 'phone battery', 0, 'IMG_6730ab95ad6f39.86028808.jpg', 44, 100, 80, 50, 1, '2024-11-10 20:42:54'),
(109, 'Laptop Battery', 0, 'IMG_6745b831166585.33155588.jpg', 44, 100, 80, 50, 1, '2024-11-26 19:59:45'),
(110, 'Motherboard ', 0, 'IMG_6745b911b9df22.40540738.jpg', 42, 150, 85, 55, 2, '2024-11-26 20:03:29'),
(111, 'cable', 0, 'IMG_67490ed9886e59.81623225.jpg', 51, 50, 25, 15, 3, '2024-11-29 08:46:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pdonations`
--

CREATE TABLE `tbl_pdonations` (
  `pdn_id` int(11) NOT NULL,
  `pdn_user` int(11) NOT NULL,
  `pdn_ewst` int(11) NOT NULL,
  `pdn_status` int(11) NOT NULL,
  `pdn_cdtn_pts` int(11) NOT NULL,
  `pdn_cdtn` text NOT NULL,
  `pdn_ewst_name` text NOT NULL,
  `pdn_qty` int(11) NOT NULL,
  `pdn_ref` varchar(100) NOT NULL,
  `pdn_brand` varchar(200) NOT NULL,
  `pdn_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pdonations`
--

INSERT INTO `tbl_pdonations` (`pdn_id`, `pdn_user`, `pdn_ewst`, `pdn_status`, `pdn_cdtn_pts`, `pdn_cdtn`, `pdn_ewst_name`, `pdn_qty`, `pdn_ref`, `pdn_brand`, `pdn_dateAdd`) VALUES
(137, 34, 96, 1, 80, 'Partially Damaged', 'Tablets', 1, 'RECYCLE-20250114-3590', 'Iphone myshs', '2025-01-14 15:22:57'),
(140, 34, 107, 1, 50, 'Partially Damaged', 'headphone', 1, 'RECYCLE-20250114-4127', 'Huawei hw564', '2025-01-14 15:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_predeems`
--

CREATE TABLE `tbl_predeems` (
  `prd_id` int(11) NOT NULL,
  `prd_rwd_name` text NOT NULL,
  `prd_user` int(11) NOT NULL,
  `prd_rwd_id` int(11) NOT NULL,
  `prd_points` int(11) NOT NULL,
  `prd_status` int(11) NOT NULL,
  `prd_ref` varchar(200) NOT NULL,
  `prd_qty` int(11) NOT NULL,
  `prd_rwd_desc` text NOT NULL,
  `prd_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_predeems`
--

INSERT INTO `tbl_predeems` (`prd_id`, `prd_rwd_name`, `prd_user`, `prd_rwd_id`, `prd_points`, `prd_status`, `prd_ref`, `prd_qty`, `prd_rwd_desc`, `prd_dateAdd`) VALUES
(69, 'Yellow Pad', 34, 1, 10, 1, 'REDEEM-20250114-0873', 1, '1 Bundled', '2025-01-14 15:37:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rcnt_hry`
--

CREATE TABLE `tbl_rcnt_hry` (
  `hry_rcy_id` int(11) NOT NULL,
  `hry_rcy_item` text NOT NULL,
  `hry_brand` varchar(200) NOT NULL,
  `hry_rcy_cdtn` text NOT NULL,
  `hry_rcy_pts` int(11) NOT NULL,
  `hry_activity` text NOT NULL,
  `hry_user` text NOT NULL,
  `hry_user_id` int(11) NOT NULL,
  `hry_transac` text NOT NULL,
  `hry_decline_mess` text NOT NULL,
  `hry_refnum` varchar(200) NOT NULL,
  `hry_approvers` text NOT NULL,
  `hry_rcy_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rcnt_hry`
--

INSERT INTO `tbl_rcnt_hry` (`hry_rcy_id`, `hry_rcy_item`, `hry_brand`, `hry_rcy_cdtn`, `hry_rcy_pts`, `hry_activity`, `hry_user`, `hry_user_id`, `hry_transac`, `hry_decline_mess`, `hry_refnum`, `hry_approvers`, `hry_rcy_date`) VALUES
(174, 'Tablets', 'Ipad apple346', 'Fully Damage', 25, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-0243', '', '2025-01-10 16:52:04'),
(175, 'Tablets', 'Huawei honorXs', 'Partially Damaged', 80, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-0842', '', '2025-01-10 16:52:06'),
(176, 'Smart Phones', 'Samsung galaxy 10', 'Partially Damaged', 50, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-8752', '', '2025-01-10 16:52:08'),
(177, 'Smart Phones', 'Samsung galaxy s15', 'Fully Damage', 25, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-9085', '', '2025-01-10 16:52:10'),
(178, 'Yellow Pad', '', '', 10, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:37'),
(179, 'index card', '', '', 40, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:39'),
(180, 'Yellow Pad', '', '', 10, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:41'),
(181, 'Yellow Pad', '', '', 20, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:45'),
(182, 'Yellow Pad', '', '', 10, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:47'),
(183, 'index card', '', '', 40, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:49'),
(184, 'Yellow Pad', '', '', 10, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:50'),
(185, 'panda', '', '', 20, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:53'),
(186, 'Marker', '', '', 50, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 16:52:55'),
(187, 'headphone', 'Huawei buds653', 'Partially Damaged', 30, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-1516', '', '2025-01-10 16:57:39'),
(188, 'Laptop Battery', 'Dell latitude7600', 'Partially Damaged', 80, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-2466', '', '2025-01-10 16:57:44'),
(189, 'phone battery', 'Realme rmx087', 'Partially Damaged', 80, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-3899', '', '2025-01-10 16:57:46'),
(190, 'Laptop', 'Dell latitude e6440', 'Partially Damaged', 80, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-4561', '', '2025-01-10 16:57:48'),
(191, 'headphone', 'Huawei buds653', 'Partially Damaged', 30, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-5340', '', '2025-01-10 16:57:51'),
(192, 'Motherboard ', 'Dell latitude e6440', 'Partially Damaged', 80, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-9042', '', '2025-01-10 16:57:53'),
(193, 'earphones', 'Apple buds653', 'Partially Damaged', 30, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-9192', '', '2025-01-10 16:57:55'),
(194, 'Marker', '', '', 50, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 17:01:23'),
(195, 'index card', '', '', 40, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 17:01:25'),
(196, 'Marker', '', '', 50, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 17:01:27'),
(197, 'panda', '', '', 20, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '', '2025-01-10 17:01:29'),
(198, 'cable', 'Samsung fast2.4', 'Fully Damage', 15, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-3944', '', '2025-01-10 17:37:23'),
(199, 'cable', '', 'Partially Damaged', 25, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250110-6642', '', '2025-01-14 15:20:49'),
(200, 'Motherboard ', 'Dell xl3783', 'Partially Damaged', 85, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250114-3046', '', '2025-01-14 15:26:37'),
(201, 'Laptop', '', 'Partially Damaged', 85, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250114-6092', '', '2025-01-15 14:56:14'),
(202, 'cable', 'Samsung Galaxy45', 'Fully Damage', 15, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20250114-8264', 'Admin1', '2025-01-26 19:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rwd_items`
--

CREATE TABLE `tbl_rwd_items` (
  `rwd_id` int(11) NOT NULL,
  `rwd_img` text NOT NULL,
  `rwd_name` text NOT NULL,
  `rwd_ctg` int(11) NOT NULL,
  `rwd_points` int(11) NOT NULL,
  `rwd_redeemed` int(11) NOT NULL,
  `rwd_desc` text NOT NULL,
  `rwd_dateadd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rwd_items`
--

INSERT INTO `tbl_rwd_items` (`rwd_id`, `rwd_img`, `rwd_name`, `rwd_ctg`, `rwd_points`, `rwd_redeemed`, `rwd_desc`, `rwd_dateadd`) VALUES
(1, 'IMG_672dc45ea642f8.70884052.jpg', 'Yellow Pad', 7, 10, 5, '1 Bundled', '2024-10-07 20:33:46'),
(3, 'IMG_672caf6585a9f5.98727906.jpg', 'index card', 7, 40, 3, '2 bundled', '2024-10-11 20:20:00'),
(39, 'IMG_672caa0af239b0.24754996.jpg', 'Shoulder bag', 20, 600, 0, 'Gucci ', '2024-10-16 20:36:24'),
(40, 'IMG_672caaaca5cbc1.00241284.jpg', 'backpack', 20, 800, 0, 'janSport', '2024-10-16 20:58:31'),
(50, 'IMG_672dd9ca778647.44436066.jpg', 'panda', 29, 20, 2, '10 pcs', '2024-11-08 17:28:42'),
(53, 'IMG_6746fb49d94fd0.23253653.jpg', 'Marker', 29, 50, 3, '2 pcs', '2024-11-27 18:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rwd_storage`
--

CREATE TABLE `tbl_rwd_storage` (
  `rwd_stg_id` int(11) NOT NULL,
  `rwd_stg_user` text NOT NULL,
  `rwd_stg_username` text NOT NULL,
  `rwd_stg_item` text NOT NULL,
  `rwd_stg_trans` text NOT NULL,
  `rwd_stg_points` int(200) NOT NULL,
  `rwd_stg_refnum` varchar(200) NOT NULL,
  `rwd_stg_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rwd_storage`
--

INSERT INTO `tbl_rwd_storage` (`rwd_stg_id`, `rwd_stg_user`, `rwd_stg_username`, `rwd_stg_item`, `rwd_stg_trans`, `rwd_stg_points`, `rwd_stg_refnum`, `rwd_stg_dateAdd`) VALUES
(44, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241112-1441', '2024-11-12 21:14:17'),
(45, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20241112-1442', '2024-11-15 20:33:53'),
(46, 'Triple A Gwapo', 'Testing', 'Shoulder bag', 'Redeemed', 600, 'REDEEM-20241112-1443', '2024-11-15 20:55:43'),
(47, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241115-8228', '2024-11-15 21:24:40'),
(48, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20241116-7883', '2024-11-17 20:02:18'),
(49, 'Triple A Gwapo Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241120-7621', '2024-11-20 22:06:47'),
(50, 'Triple A Gwapo Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241116-7882', '2024-11-20 22:23:09'),
(51, 'Triple A Gwapo Gwapo', 'Testing', 'panda', 'Redeemed', 20, 'REDEEM-20241122-0029', '2024-11-23 17:46:41'),
(52, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241123-7906', '2024-11-26 13:03:09'),
(53, 'Mik Mikik', 'Miketest', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20241126-1502', '2024-11-26 19:44:57'),
(54, 'Hermy Espinida', 'Hermenia', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20241127-7685', '2024-11-27 20:08:49'),
(55, 'Aaron Dave Bantiling', 'Koricz', 'index card', 'Redeemed', 40, 'REDEEM-20241128-3153', '2024-11-28 21:43:41'),
(56, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241129-3011', '2024-11-29 08:54:57'),
(57, 'Triple A Gwapo', 'Testing', 'panda', 'Redeemed', 20, 'REDEEM-20241211-3212', '2025-01-03 11:37:58'),
(58, 'Triple A Gwapo', 'Testing', 'panda', 'Redeemed', 20, 'REDEEM-20250103-2406', '2025-01-03 19:07:20'),
(59, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20250107-9970', '2025-01-07 23:22:16'),
(60, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 80, 'REDEEM-20250108-4273', '2025-01-08 19:45:47'),
(61, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20250107-9966', '2025-01-10 16:52:37'),
(62, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20250107-9967', '2025-01-10 16:52:39'),
(63, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20250107-9968', '2025-01-10 16:52:41'),
(64, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 20, 'REDEEM-20250107-9969', '2025-01-10 16:52:45'),
(65, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20250110-9298', '2025-01-10 16:52:47'),
(66, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20250110-9299', '2025-01-10 16:52:49'),
(67, 'Triple A Gwapo', 'Testing', 'Yellow Pad', 'Redeemed', 10, 'REDEEM-20250110-9300', '2025-01-10 16:52:50'),
(68, 'Triple A Gwapo', 'Testing', 'panda', 'Redeemed', 20, 'REDEEM-20250110-9301', '2025-01-10 16:52:53'),
(69, 'Triple A Gwapo', 'Testing', 'Marker', 'Redeemed', 50, 'REDEEM-20250110-9302', '2025-01-10 16:52:55'),
(70, 'Triple A Gwapo', 'Testing', 'Marker', 'Redeemed', 50, 'REDEEM-20250110-5038', '2025-01-10 17:01:23'),
(71, 'Triple A Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20250110-5039', '2025-01-10 17:01:25'),
(72, 'Triple A Gwapo', 'Testing', 'Marker', 'Redeemed', 50, 'REDEEM-20250110-5040', '2025-01-10 17:01:27'),
(73, 'Triple A Gwapo', 'Testing', 'panda', 'Redeemed', 20, 'REDEEM-20250110-5041', '2025-01-10 17:01:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_storage`
--

CREATE TABLE `tbl_storage` (
  `stg_id` int(11) NOT NULL,
  `stg_user` text NOT NULL,
  `stg_usrname` text NOT NULL,
  `stg_item` text NOT NULL,
  `stg_brand` varchar(200) NOT NULL,
  `stg_condition` text NOT NULL,
  `stg_points` text NOT NULL,
  `stg_ewstId` int(11) NOT NULL,
  `stg_userId` int(11) NOT NULL,
  `stg_refnum` varchar(200) NOT NULL,
  `stg_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_storage`
--

INSERT INTO `tbl_storage` (`stg_id`, `stg_user`, `stg_usrname`, `stg_item`, `stg_brand`, `stg_condition`, `stg_points`, `stg_ewstId`, `stg_userId`, `stg_refnum`, `stg_dateAdd`) VALUES
(74, 'Triple A Gwapo', 'Testing', 'phone battery', '', '', '50', 108, 34, 'RECYCLE-20241112-7762', '2024-11-12 17:15:03'),
(75, 'Triple A Gwapo', 'Testing', 'Smart Phones', '', '', '25', 92, 34, 'RECYCLE-20241112-7030', '2024-11-12 17:20:10'),
(76, 'Triple A Gwapo', 'Testing', 'Tablets', '', '', '25', 96, 34, 'RECYCLE-20241112-6136', '2024-11-12 17:21:06'),
(77, 'Triple A Gwapo', 'Testing', 'headphone', '', '', '10', 107, 34, 'RECYCLE-20241112-3705', '2024-11-12 23:53:53'),
(78, 'Triple A Gwapo', 'Testing', 'phone battery', '', '', '50', 108, 34, 'RECYCLE-20241115-8350', '2024-11-15 21:18:24'),
(79, 'Triple A Gwapo', 'Testing', 'Smart Phones', '', '', '50', 92, 34, 'RECYCLE-20241115-3805', '2024-11-15 21:19:48'),
(80, 'Triple A Gwapo', 'Testing', 'earphones', '', '', '10', 95, 34, 'RECYCLE-20241115-5979', '2024-11-15 21:34:39'),
(81, 'Triple A Gwapo', 'Testing', 'earphones', '', '', '10', 95, 34, 'RECYCLE-20241115-0368', '2024-11-15 21:54:42'),
(82, 'Triple A Gwapo Gwapo', 'Testing', 'Tablets', '', '', '40', 96, 34, 'RECYCLE-20241116-9280', '2024-11-19 08:26:17'),
(83, 'Triple A Gwapo Gwapo', 'Testing', 'Laptop', '', '', '40', 93, 34, 'RECYCLE-20241116-9255', '2024-11-20 19:54:00'),
(84, 'Triple A Gwapo Gwapo', 'Testing', 'Smart Phones', '', '', '40', 92, 34, 'RECYCLE-20241116-6823', '2024-11-20 19:54:13'),
(85, 'Triple A Gwapo Gwapo', 'Testing', 'Smart Phones', '', '', '40', 92, 34, 'RECYCLE-20241116-0428', '2024-11-22 20:39:37'),
(86, 'Triple A Gwapo', 'Testing', 'headphone', '', '', '50', 107, 34, 'RECYCLE-20241123-7500', '2024-11-26 13:03:01'),
(87, 'Mik Mikik', 'Miketest', 'earphones', '', '', '10', 95, 61, 'RECYCLE-20241126-4729', '2024-11-26 19:44:34'),
(88, 'Mikaela Sarmento', 'Miketest', 'Tablets', '', '', '40', 96, 61, 'RECYCLE-20241126-1235', '2024-11-26 20:08:53'),
(89, 'Hermy Espinida', 'Hermenia', 'Smart Phones', '', '', '50', 92, 62, 'RECYCLE-20241127-1640', '2024-11-27 19:13:53'),
(90, 'Aaron Dave Bantiling', 'Koricz', 'phone battery', '', '', '100', 108, 64, 'RECYCLE-20241128-4551', '2024-11-28 21:42:23'),
(91, 'Aaron Dave Bantiling', 'Koricz', 'phone battery', '', '', '80', 108, 64, 'RECYCLE-20241128-1938', '2024-11-28 21:42:27'),
(92, 'Triple A Gwapo', 'Testing', 'headphone', '', '', '10', 107, 34, 'RECYCLE-20241129-6116', '2025-01-03 09:30:38'),
(93, 'Triple A Gwapo', 'Testing', 'earphones', '', '', '10', 95, 34, 'RECYCLE-20241129-3550', '2025-01-03 18:08:54'),
(94, 'Triple A Gwapo', 'Testing', 'earphones', '', '', '10', 95, 34, 'RECYCLE-20241129-4913', '2025-01-03 19:58:55'),
(95, 'Triple A Gwapo', 'Testing', 'Smart Phones', '', '', '50', 92, 34, 'RECYCLE-20250107-5619', '2025-01-07 23:18:51'),
(96, 'Triple A Gwapo', 'Testing', 'Tablets', '', '', '80', 96, 34, 'RECYCLE-20250108-5603', '2025-01-08 19:44:55'),
(97, 'Triple A Gwapo', 'Testing', 'Tablets', 'Samsung', '', '40', 96, 34, 'RECYCLE-20250108-7195', '2025-01-10 10:40:35'),
(98, 'Triple A Gwapo', 'Testing', 'Laptop Battery', 'Realme RMX3085', '', '80', 109, 34, 'RECYCLE-20250110-8417', '2025-01-10 11:15:34'),
(99, 'Triple A Gwapo', 'Testing', 'earphones', 'Aple apl564', '', '30', 95, 34, 'RECYCLE-20250110-4692', '2025-01-10 11:28:28'),
(100, 'Triple A Gwapo', 'Testing', 'Laptop Battery', 'Dell dlt789', '', '50', 109, 34, 'RECYCLE-20250110-5968', '2025-01-10 11:30:17'),
(101, 'Triple A Gwapo', 'Testing', 'Tablets', 'Ipad apple346', '', '25', 96, 34, 'RECYCLE-20250110-0243', '2025-01-10 16:52:04'),
(102, 'Triple A Gwapo', 'Testing', 'Tablets', 'Huawei honorXs', '', '80', 96, 34, 'RECYCLE-20250110-0842', '2025-01-10 16:52:06'),
(103, 'Triple A Gwapo', 'Testing', 'Smart Phones', 'Samsung galaxy 10', '', '50', 92, 34, 'RECYCLE-20250110-8752', '2025-01-10 16:52:08'),
(104, 'Triple A Gwapo', 'Testing', 'Smart Phones', 'Samsung galaxy s15', '', '25', 92, 34, 'RECYCLE-20250110-9085', '2025-01-10 16:52:10'),
(105, 'Triple A Gwapo', 'Testing', 'headphone', 'Huawei buds653', '', '30', 107, 34, 'RECYCLE-20250110-1516', '2025-01-10 16:57:39'),
(106, 'Triple A Gwapo', 'Testing', 'Laptop Battery', 'Dell latitude7600', '', '80', 109, 34, 'RECYCLE-20250110-2466', '2025-01-10 16:57:44'),
(107, 'Triple A Gwapo', 'Testing', 'phone battery', 'Realme rmx087', '', '80', 108, 34, 'RECYCLE-20250110-3899', '2025-01-10 16:57:46'),
(108, 'Triple A Gwapo', 'Testing', 'Laptop', 'Dell latitude e6440', '', '80', 93, 34, 'RECYCLE-20250110-4561', '2025-01-10 16:57:48'),
(109, 'Triple A Gwapo', 'Testing', 'headphone', 'Huawei buds653', '', '30', 107, 34, 'RECYCLE-20250110-5340', '2025-01-10 16:57:51'),
(110, 'Triple A Gwapo', 'Testing', 'Motherboard ', 'Dell latitude e6440', '', '80', 110, 34, 'RECYCLE-20250110-9042', '2025-01-10 16:57:53'),
(111, 'Triple A Gwapo', 'Testing', 'earphones', 'Apple buds653', '', '30', 95, 34, 'RECYCLE-20250110-9192', '2025-01-10 16:57:55'),
(112, 'Triple A Gwapo', 'Testing', 'cable', 'Samsung fast2.4', '', '15', 111, 34, 'RECYCLE-20250110-3944', '2025-01-10 17:37:23'),
(113, 'Triple A Gwapo', 'Testing', 'cable', '', '', '25', 111, 34, 'RECYCLE-20250110-6642', '2025-01-14 15:20:49'),
(114, 'Triple A Gwapo', 'Testing', 'Motherboard ', 'Dell xl3783', '', '85', 110, 34, 'RECYCLE-20250114-3046', '2025-01-14 15:26:37'),
(115, 'Triple A Gwapo', 'Testing', 'Laptop', '', '', '85', 93, 34, 'RECYCLE-20250114-6092', '2025-01-15 14:56:14'),
(116, 'Triple A Gwapo', 'Testing', 'cable', 'Samsung Galaxy45', '', '15', 111, 34, 'RECYCLE-20250114-8264', '2025-01-26 19:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_typ`
--

CREATE TABLE `tbl_typ` (
  `typ_id` int(11) NOT NULL,
  `typ_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_typ`
--

INSERT INTO `tbl_typ` (`typ_id`, `typ_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `usr_id` int(11) NOT NULL,
  `usr_typ` int(11) NOT NULL,
  `usr_fname` text NOT NULL,
  `usr_lname` text NOT NULL,
  `usr_usrname` varchar(100) NOT NULL,
  `usr_email` varchar(100) NOT NULL,
  `usr_idnum` varchar(200) NOT NULL,
  `usr_course` text NOT NULL,
  `usr_img` text NOT NULL,
  `usr_rwd` int(100) NOT NULL,
  `usr_total_rwd` int(100) NOT NULL,
  `usr_active` text NOT NULL,
  `usr_usrpass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usr_id`, `usr_typ`, `usr_fname`, `usr_lname`, `usr_usrname`, `usr_email`, `usr_idnum`, `usr_course`, `usr_img`, `usr_rwd`, `usr_total_rwd`, `usr_active`, `usr_usrpass`) VALUES
(2, 1, 'admin', 'george', 'ChmsuAdmin1', '', '0', '', '', 220, 220, 'Active', '$2y$10$plPk1gc2Yap72EFkpkKreeg71S0WmCETiBrklNM567jV7fumY7OiO'),
(26, 2, 'arone', 'Bantiling', '', 'alrea0015@gmail.com', '0', '', '', 55, 55, 'Active', '$2y$10$RcAsZU2w3ufW2bU57IfqIOXhyXfVre4xHjTEHuSvcgbZyP1Ik.8bO'),
(27, 2, 'Chester', 'Palesterio ', '', 'ches@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$Okqg08wTN.ru9fY0VKTsge.WZCGDiuIXwz2Viet7ntU4mIxF7aLGG'),
(29, 2, 'Jhave', 'Soriano', '', 'Soriano@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$Wu1YqiCrQaKGY3s6kcG0BeXW5tDtenGzjO3EMaPW/6taTNuPeAP62'),
(30, 2, 'Ms jay', 'Sym', 'seg', 'jay@gmail.com', '0', 'a', '', 10, 10, 'Active', '$2y$10$u721CSOhYncUmFtVBL9CdO3aRnq5RH9cs.jGBwTcOG.Txu5Sf7mOm'),
(31, 2, 'Yuan', 'cortex', '', 'cortex@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$3eqGet7jQmcSvFJfMseld.cifqKwNf4UVhKmX3S1DxE9cfSE1/ZWW'),
(33, 2, 'Piolo', 'pascal', 'Test', 'piolo@gmail.com', 'POP8980', 'Bs Information Technology', '', 500, 900, 'Active', '$2y$10$fOqldDfG/zXaixmmyxnlKOxGgvgCcOosYxtoQb9BgBX4FHhVnmnFu'),
(34, 2, 'Triple A', 'Gwapo', 'Testing', 'test@gmail.com', 'SAS0815', 'Bachelor Science in Information Technology', 'defaultProfile.jpg', 850, 3945, 'Active', '$2y$10$dt09o1lVoT8AdV7XEyUt8.RpaMSv.sG.DxpQtybCpc5JA5.ESrEw.'),
(35, 2, 'Ramises', 'qaaa', 'ramises', 'ram@gmail.com', 'RAM6708', 'Bs Information Technology', '', 800, 500, 'Active', '$2y$10$IlwJZDojn7oh/FUuwxX/peUobal80kAOjokAaPPrrObq8k4Srj7WW'),
(36, 2, 'Alfred', 'Mijares', 'AlfredM', 'mijares@gmail.com', '0', '', '', 40, 40, 'Active', '$2y$10$vb5QQlvAagKYe2NiVLgoV.EhLKbpfypo80j82sIQFAFbeznRtzZtq'),
(55, 2, 'Du ma gagi nako', 'Huhu', 'Test87', 'Test87', '', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$oXnMC4ffWc5ubiT2N.Yp5eqOiQ5zqc6rgNbkO.d3i3lslG35ChXUy'),
(56, 2, 'asbal', 'askal', 'Bruh', 'askal@gmail.com', 'askal7832', 'Bs Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$IyNfT6LZrzH26dsvUPacOeKzM5se5RzcaQmb7xl9UdyAP/Ib2Rxbu'),
(57, 2, 'tisoy', 'Ddd', 'BruhCode', 'bruh@gmail.com', '522', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 1000, 17, 'Active', '$2y$10$mPkep46NQJesPlRFgJLM7uT6Cs3WUN13Mnx/.6HfXW1A48sXkfbGi'),
(58, 2, 'Try1 Try1 Try1 Try1', 'Try1', 'Try1', 'Try1@gmail.com', 'Try1', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 1, 0, 'Active', '$2y$10$xoKuriwFTIK75.q0CNbJVu.a.OKQVV0naK6g6hN5ZtmKZNZOF3u.i'),
(59, 2, 'Ali', 'Husin', 'Alisynx', 'Alisynx@gmail.com', 'SAS000987', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 70, 150, 'Active', '$2y$10$ZcNsqYOsO9fUapuCQhBrXebWbfnkYNTafOnopdV8uD6lvg57yr5EC'),
(60, 2, 'Aljay Santoluma', 'Santoluma', 'Jays', 'Jay@gmail.com', 'ALJAY6930', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$h6ElrefxGEzayuKNGceb/O.KFRM7tS/W7K4vfD5YPqn5y4m40TDl.'),
(61, 2, 'Mikaela', 'Sarmento', 'Miketest', 'Mike@gmail.com', 'Test726392', 'Bachelor of Science in Information Systems', 'defaultProfile.jpg', 40, 50, 'Disable', '$2y$10$FDTjjZOd5ChUcZO4tbXDoufWvHu66ycWRljYGApPJzjo5VKTdUb/O'),
(62, 2, 'Hermy', 'Espinida', 'Hermenia', 'Hermy@gmail.com', 'HERM36389', 'Bachelor of Science in Computer Science', 'defaultProfile.jpg', 40, 50, 'Active', '$2y$10$miGm32KDqUeH7K.0TPgQceO8rJf25Oh40V.Le73JcVQqBTQRu5AZO'),
(65, 2, 'alfred', 'mijares ', 'alfredjr', 'alfredomijaresjr16@gmail.com', '5555555', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$9TppYzn3OljLdOlqKzwE3eMJ9g.6k.Gj43KHs9xIkdJG6l31YUAr2'),
(66, 2, 'Aljon', 'Santoluma ', 'Im_ali', 'santolumaaljon@gmail.com', 'SAS08150000', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$nI/SWquX8qSezGMAUaUugOd4kEv9uMU/BKNmy7pOIp/vgF77BTzHC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  ADD PRIMARY KEY (`ctg_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cty_id`);

--
-- Indexes for table `tbl_cdtn`
--
ALTER TABLE `tbl_cdtn`
  ADD PRIMARY KEY (`cdtn_id`);

--
-- Indexes for table `tbl_ewst`
--
ALTER TABLE `tbl_ewst`
  ADD PRIMARY KEY (`ewst_id`),
  ADD KEY `typ_ctyfk` (`ewst_ctyfk`),
  ADD KEY `ewst_userfk` (`ewst_userfk`);

--
-- Indexes for table `tbl_pdonations`
--
ALTER TABLE `tbl_pdonations`
  ADD PRIMARY KEY (`pdn_id`);

--
-- Indexes for table `tbl_predeems`
--
ALTER TABLE `tbl_predeems`
  ADD PRIMARY KEY (`prd_id`);

--
-- Indexes for table `tbl_rcnt_hry`
--
ALTER TABLE `tbl_rcnt_hry`
  ADD PRIMARY KEY (`hry_rcy_id`);

--
-- Indexes for table `tbl_rwd_items`
--
ALTER TABLE `tbl_rwd_items`
  ADD PRIMARY KEY (`rwd_id`),
  ADD KEY `rwd_ctg` (`rwd_ctg`);

--
-- Indexes for table `tbl_rwd_storage`
--
ALTER TABLE `tbl_rwd_storage`
  ADD PRIMARY KEY (`rwd_stg_id`);

--
-- Indexes for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  ADD PRIMARY KEY (`stg_id`);

--
-- Indexes for table `tbl_typ`
--
ALTER TABLE `tbl_typ`
  ADD PRIMARY KEY (`typ_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`usr_id`),
  ADD KEY `usr_typ` (`usr_typ`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_cdtn`
--
ALTER TABLE `tbl_cdtn`
  MODIFY `cdtn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ewst`
--
ALTER TABLE `tbl_ewst`
  MODIFY `ewst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_pdonations`
--
ALTER TABLE `tbl_pdonations`
  MODIFY `pdn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `tbl_predeems`
--
ALTER TABLE `tbl_predeems`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `tbl_rcnt_hry`
--
ALTER TABLE `tbl_rcnt_hry`
  MODIFY `hry_rcy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `tbl_rwd_items`
--
ALTER TABLE `tbl_rwd_items`
  MODIFY `rwd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_rwd_storage`
--
ALTER TABLE `tbl_rwd_storage`
  MODIFY `rwd_stg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  MODIFY `stg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `tbl_typ`
--
ALTER TABLE `tbl_typ`
  MODIFY `typ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ewst`
--
ALTER TABLE `tbl_ewst`
  ADD CONSTRAINT `tbl_ewst_ibfk_1` FOREIGN KEY (`ewst_ctyfk`) REFERENCES `tbl_category` (`cty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rwd_items`
--
ALTER TABLE `tbl_rwd_items`
  ADD CONSTRAINT `tbl_rwd_items_ibfk_1` FOREIGN KEY (`rwd_ctg`) REFERENCES `tbl_catalog` (`ctg_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`usr_typ`) REFERENCES `tbl_typ` (`typ_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
