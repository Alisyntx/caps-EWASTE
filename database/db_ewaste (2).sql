-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 01:13 PM
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
(44, 'battery', '', '2024-10-02');

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
(92, 'Smart Phones', 0, 'IMG_66e987b01a4ba2.98233565.jpg', 41, 100, 50, 25, 7, '2024-09-17 10:17:27'),
(93, 'Laptop', 0, 'IMG_66e987c89c1c49.26649413.jpg', 42, 180, 80, 40, 7, '2024-09-17 10:21:00'),
(95, 'earphones', 0, 'IMG_66e98a73b748b6.36028701.png', 43, 60, 30, 10, 8, '2024-09-17 11:26:26'),
(96, 'Tablets', 0, 'IMG_66e98f29e9aee8.36207513.jpg', 41, 150, 80, 40, 13, '2024-09-17 22:16:09'),
(107, 'headphone', 0, 'IMG_672dd9a163c7f8.09610276.jpg', 43, 200, 100, 50, 6, '2024-11-08 17:28:01'),
(108, 'phone battery', 0, 'IMG_6730ab95ad6f39.86028808.jpg', 44, 100, 80, 50, 8, '2024-11-10 20:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_graphdata`
--

CREATE TABLE `tbl_graphdata` (
  `grp_id` int(11) NOT NULL,
  `grp_item` text NOT NULL,
  `grp_used` int(11) NOT NULL,
  `grp_dateadd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_graphdata`
--

INSERT INTO `tbl_graphdata` (`grp_id`, `grp_item`, `grp_used`, `grp_dateadd`) VALUES
(2, 'laptop', 2, '2024-11-12 00:00:00'),
(3, 'mobile', 4, '2024-11-12 00:00:00');

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
  `pdn_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pdonations`
--

INSERT INTO `tbl_pdonations` (`pdn_id`, `pdn_user`, `pdn_ewst`, `pdn_status`, `pdn_cdtn_pts`, `pdn_cdtn`, `pdn_ewst_name`, `pdn_qty`, `pdn_ref`, `pdn_dateAdd`) VALUES
(100, 34, 92, 1, 40, 'Fully Damage', 'Smart Phones', 1, 'RECYCLE-20241116-0428', '2024-11-16 21:33:40');

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
(40, 'panda', 34, 50, 20, 1, 'REDEEM-20241122-0029', 1, '10 pcs', '2024-11-22 09:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rcnt_dnt`
--

CREATE TABLE `tbl_rcnt_dnt` (
  `rcntdnt_id` int(11) NOT NULL,
  `rcntdnt_user` int(11) NOT NULL,
  `rcntdnt_ewst` int(11) NOT NULL,
  `rcntdnt_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rcnt_hry`
--

CREATE TABLE `tbl_rcnt_hry` (
  `hry_rcy_id` int(11) NOT NULL,
  `hry_rcy_item` text NOT NULL,
  `hry_rcy_cdtn` text NOT NULL,
  `hry_rcy_pts` int(11) NOT NULL,
  `hry_activity` text NOT NULL,
  `hry_user` text NOT NULL,
  `hry_user_id` int(11) NOT NULL,
  `hry_transac` text NOT NULL,
  `hry_decline_mess` text NOT NULL,
  `hry_refnum` varchar(200) NOT NULL,
  `hry_rcy_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rcnt_hry`
--

INSERT INTO `tbl_rcnt_hry` (`hry_rcy_id`, `hry_rcy_item`, `hry_rcy_cdtn`, `hry_rcy_pts`, `hry_activity`, `hry_user`, `hry_user_id`, `hry_transac`, `hry_decline_mess`, `hry_refnum`, `hry_rcy_date`) VALUES
(102, 'phone battery', 'Fully Damage', 50, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', '0', '2024-08-12 17:13:17'),
(103, 'phone battery', 'Fully Damage', 50, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', '0', '2024-09-12 17:14:31'),
(104, 'phone battery', 'Fully Damage', 50, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', '0', '2024-10-12 17:15:03'),
(105, 'Smart Phones', 'Fully Damage', 25, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', '0', '2024-11-12 17:20:10'),
(106, 'Tablets', 'Fully Damage', 25, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20241112-6136', '2024-11-12 17:21:06'),
(107, 'index card', '', 40, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-09-12 19:31:43'),
(108, 'panda', '', 20, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-11-12 21:02:22'),
(109, 'index card', '', 40, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-10-12 21:14:17'),
(110, 'Yellow Pad', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-12 23:24:11'),
(111, 'earphones', '', 0, 'Recycle Declined', 'Triple A Gwapo', 34, '', 'wrong item', '', '2024-11-12 23:25:46'),
(112, 'headphone', 'Fully Damage', 10, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20241112-3705', '2024-11-12 23:53:53'),
(113, 'Smart Phones', 'Fully Damage', 25, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', '0', '2024-11-12 17:20:10'),
(114, 'Yellow Pad', '', 10, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-11-15 20:33:53'),
(115, 'Shoulder bag', '', 600, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-11-15 20:55:43'),
(116, 'phone battery', 'Fully Damage', 50, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20241115-8350', '2024-11-15 21:18:24'),
(117, 'Smart Phones', 'Partially Damaged', 50, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20241115-3805', '2024-11-15 21:19:48'),
(118, 'index card', '', 40, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-11-15 21:24:40'),
(119, 'earphones', 'Fully Damage', 10, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20241115-5979', '2024-11-15 21:34:39'),
(120, 'earphones', 'Fully Damage', 10, 'Recycle Accepted', 'Triple A Gwapo', 34, 'Recycled', '', 'RECYCLE-20241115-0368', '2024-11-15 21:54:42'),
(121, 'panda', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-15 22:17:04'),
(122, 'panda', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-15 22:19:15'),
(123, 'panda', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-15 22:20:16'),
(124, 'Yellow Pad', '', 10, 'Redeem Accepted', 'Triple A Gwapo', 34, 'Redeemed', '', '', '2024-11-17 20:02:18'),
(125, 'Tablets', 'Fully Damage', 40, 'Recycle Accepted', 'Triple A Gwapo Gwapo', 34, 'Recycled', '', 'RECYCLE-20241116-9280', '2024-11-19 08:26:17'),
(126, 'Laptop', 'Fully Damage', 40, 'Recycle Accepted', 'Triple A Gwapo Gwapo', 34, 'Recycled', '', 'RECYCLE-20241116-9255', '2024-11-20 19:54:00'),
(127, 'Smart Phones', 'Fully Damage', 40, 'Recycle Accepted', 'Triple A Gwapo Gwapo', 34, 'Recycled', '', 'RECYCLE-20241116-6823', '2024-11-20 19:54:13'),
(128, 'index card', '', 40, 'Redeem Accepted', 'Triple A Gwapo Gwapo', 34, 'Redeemed', '', '', '2024-11-20 22:06:47'),
(129, 'index card', '', 40, 'Redeem Accepted', 'Triple A Gwapo Gwapo', 34, 'Redeemed', '', '', '2024-11-20 22:23:09'),
(130, 'index card', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-20 22:24:23'),
(131, 'index card', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-20 22:31:44'),
(132, 'index card', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-20 22:34:37'),
(133, 'Yellow Pad', '', 0, 'Redeem Declined', '0', 34, 'Declined', '', '', '2024-11-20 22:38:48'),
(134, 'Tablets', '', 0, 'Recycle Declined', 'Triple A Gwapo Gwapo', 34, '', '', '', '2024-11-20 22:39:22'),
(135, 'Tablets', '', 0, 'Recycle Declined', 'Triple A Gwapo Gwapo', 34, '', '', '', '2024-11-20 22:40:55'),
(136, 'Tablets', '', 0, 'Recycle Declined', 'Triple A Gwapo Gwapo', 34, '', '', '', '2024-11-20 22:42:17'),
(137, 'Tablets', '', 0, 'Recycle Declined', 'Triple A Gwapo Gwapo', 34, '', 'wrong shit', '', '2024-11-20 22:42:58'),
(138, 'Tablets', '', 0, 'Recycle Declined', 'Triple A Gwapo Gwapo', 34, '', 'There is a problem with this transaction.', '', '2024-11-20 22:47:26'),
(139, 'index card', '', 0, 'Redeem Declined', '0', 34, 'Declined', 'There is a problem with this transaction.', '', '2024-11-20 22:48:10'),
(140, 'Laptop', '', 0, 'Recycle Declined', 'Triple A Gwapo Gwapo', 34, '', 'There is a problem with this transaction.', '', '2024-11-22 09:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rdm_cty`
--

CREATE TABLE `tbl_rdm_cty` (
  `rdm_cty_id` int(11) NOT NULL,
  `rdm_cty_name` int(11) NOT NULL,
  `rdm_cty_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recyclable`
--

CREATE TABLE `tbl_recyclable` (
  `rcyc_id` int(11) NOT NULL,
  `rcyc_name` text NOT NULL,
  `rcyc_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `rqs_id` int(11) NOT NULL,
  `rqs_usrId` int(11) NOT NULL,
  `rqs_ctgFk` int(11) NOT NULL,
  `rqs_stats` int(11) NOT NULL,
  `rqs_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'IMG_672dc45ea642f8.70884052.jpg', 'Yellow Pad', 7, 10, 6, '1 Bundled', '2024-10-07 20:33:46'),
(3, 'IMG_672caf6585a9f5.98727906.jpg', 'index card', 7, 40, 11, '2 bundled', '2024-10-11 20:20:00'),
(39, 'IMG_672caa0af239b0.24754996.jpg', 'Shoulder bag', 20, 600, 1, 'Gucci ', '2024-10-16 20:36:24'),
(40, 'IMG_672caaaca5cbc1.00241284.jpg', 'backpack', 20, 800, 2, 'janSport', '2024-10-16 20:58:31'),
(50, 'IMG_672dd9ca778647.44436066.jpg', 'panda', 29, 20, 4, '10 pcs', '2024-11-08 17:28:42');

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
(50, 'Triple A Gwapo Gwapo', 'Testing', 'index card', 'Redeemed', 40, 'REDEEM-20241116-7882', '2024-11-20 22:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_storage`
--

CREATE TABLE `tbl_storage` (
  `stg_id` int(11) NOT NULL,
  `stg_user` text NOT NULL,
  `stg_usrname` text NOT NULL,
  `stg_item` text NOT NULL,
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

INSERT INTO `tbl_storage` (`stg_id`, `stg_user`, `stg_usrname`, `stg_item`, `stg_condition`, `stg_points`, `stg_ewstId`, `stg_userId`, `stg_refnum`, `stg_dateAdd`) VALUES
(74, 'Triple A Gwapo', 'Testing', 'phone battery', '', '50', 108, 34, 'RECYCLE-20241112-7762', '2024-11-12 17:15:03'),
(75, 'Triple A Gwapo', 'Testing', 'Smart Phones', '', '25', 92, 34, 'RECYCLE-20241112-7030', '2024-11-12 17:20:10'),
(76, 'Triple A Gwapo', 'Testing', 'Tablets', '', '25', 96, 34, 'RECYCLE-20241112-6136', '2024-11-12 17:21:06'),
(77, 'Triple A Gwapo', 'Testing', 'headphone', '', '10', 107, 34, 'RECYCLE-20241112-3705', '2024-11-12 23:53:53'),
(78, 'Triple A Gwapo', 'Testing', 'phone battery', '', '50', 108, 34, 'RECYCLE-20241115-8350', '2024-11-15 21:18:24'),
(79, 'Triple A Gwapo', 'Testing', 'Smart Phones', '', '50', 92, 34, 'RECYCLE-20241115-3805', '2024-11-15 21:19:48'),
(80, 'Triple A Gwapo', 'Testing', 'earphones', '', '10', 95, 34, 'RECYCLE-20241115-5979', '2024-11-15 21:34:39'),
(81, 'Triple A Gwapo', 'Testing', 'earphones', '', '10', 95, 34, 'RECYCLE-20241115-0368', '2024-11-15 21:54:42'),
(82, 'Triple A Gwapo Gwapo', 'Testing', 'Tablets', '', '40', 96, 34, 'RECYCLE-20241116-9280', '2024-11-19 08:26:17'),
(83, 'Triple A Gwapo Gwapo', 'Testing', 'Laptop', '', '40', 93, 34, 'RECYCLE-20241116-9255', '2024-11-20 19:54:00'),
(84, 'Triple A Gwapo Gwapo', 'Testing', 'Smart Phones', '', '40', 92, 34, 'RECYCLE-20241116-6823', '2024-11-20 19:54:13');

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
(25, 2, 'Alitest', 'Testing ', '', 'santolumaaljon@gmail.com', '0', '', '', 570, 570, 'Active', '$2y$10$SPsMOQnxTG1xT6.D7/4k4Oz8ZxgUXJA8OtFBS/skthb6b9CWS.06a'),
(26, 2, 'arone', 'Bantiling', '', 'alrea0015@gmail.com', '0', '', '', 55, 55, 'Active', '$2y$10$RcAsZU2w3ufW2bU57IfqIOXhyXfVre4xHjTEHuSvcgbZyP1Ik.8bO'),
(27, 2, 'Chester', 'Palesterio ', '', 'ches@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$Okqg08wTN.ru9fY0VKTsge.WZCGDiuIXwz2Viet7ntU4mIxF7aLGG'),
(28, 2, 'Jessamine ', 'Lacoste', '', 'santolumaaljon@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$8p/KsF2wj1TpPKY9dZaQi..6NOn2ym8keb0RVTGkoz6asfMIutnsS'),
(29, 2, 'Jhave', 'Soriano', '', 'Soriano@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$Wu1YqiCrQaKGY3s6kcG0BeXW5tDtenGzjO3EMaPW/6taTNuPeAP62'),
(30, 2, 'Ms jay', 'Sym', 'seg', 'jay@gmail.com', '0', 'a', '', 10, 10, 'Active', '$2y$10$u721CSOhYncUmFtVBL9CdO3aRnq5RH9cs.jGBwTcOG.Txu5Sf7mOm'),
(31, 2, 'Yuan', 'cortex', '', 'cortex@gmail.com', '0', '', '', 0, 0, 'Active', '$2y$10$3eqGet7jQmcSvFJfMseld.cifqKwNf4UVhKmX3S1DxE9cfSE1/ZWW'),
(33, 2, 'Piolo', 'pascal', 'Test', 'piolo@gmail.com', 'POP8980', 'Bs Information Technology', '', 500, 900, 'Active', '$2y$10$fOqldDfG/zXaixmmyxnlKOxGgvgCcOosYxtoQb9BgBX4FHhVnmnFu'),
(34, 2, 'Triple A Gwapo', 'Gwapo', 'Testing', 'test@gmail.com', 'SAS0815', 'Bachelor Science in Information Technology', 'defaultProfile.jpg', 255, 2680, 'Active', '$2y$10$dt09o1lVoT8AdV7XEyUt8.RpaMSv.sG.DxpQtybCpc5JA5.ESrEw.'),
(35, 2, 'Ramises', 'qaaa', 'ramises', 'ram@gmail.com', 'RAM6708', 'Bs Information Technology', '', 800, 500, 'Disable', '$2y$10$IlwJZDojn7oh/FUuwxX/peUobal80kAOjokAaPPrrObq8k4Srj7WW'),
(36, 2, 'Alfred', 'Mijares', 'AlfredM', 'mijares@gmail.com', '0', '', '', 40, 40, 'Active', '$2y$10$vb5QQlvAagKYe2NiVLgoV.EhLKbpfypo80j82sIQFAFbeznRtzZtq'),
(55, 2, 'Du ma gagi nako', 'Huhu', 'Test87', 'Test87', '', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$oXnMC4ffWc5ubiT2N.Yp5eqOiQ5zqc6rgNbkO.d3i3lslG35ChXUy'),
(56, 2, 'asbal', 'askal', 'Bruh', 'askal@gmail.com', 'askal7832', 'Bs Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$IyNfT6LZrzH26dsvUPacOeKzM5se5RzcaQmb7xl9UdyAP/Ib2Rxbu'),
(57, 2, 'tisoy', 'Ddd', 'BruhCode', 'bruh@gmail.com', '522', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 1000, 0, 'Disable', '$2y$10$mPkep46NQJesPlRFgJLM7uT6Cs3WUN13Mnx/.6HfXW1A48sXkfbGi'),
(58, 2, 'Try1 Try1 Try1 Try1', 'Try1', 'Try1', 'Try1@gmail.com', 'Try1', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$xoKuriwFTIK75.q0CNbJVu.a.OKQVV0naK6g6hN5ZtmKZNZOF3u.i'),
(59, 2, 'Ali', 'Husin', 'Alisynx', 'Alisynx@gmail.com', 'SAS000987', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 70, 150, 'Active', '$2y$10$ZcNsqYOsO9fUapuCQhBrXebWbfnkYNTafOnopdV8uD6lvg57yr5EC'),
(60, 2, 'Aljay Santoluma', 'Santoluma', 'Jays', 'Jay@gmail.com', 'ALJAY6930', 'Bachelor of Science in Information Technology', 'defaultProfile.jpg', 0, 0, 'Active', '$2y$10$h6ElrefxGEzayuKNGceb/O.KFRM7tS/W7K4vfD5YPqn5y4m40TDl.');

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
-- Indexes for table `tbl_graphdata`
--
ALTER TABLE `tbl_graphdata`
  ADD PRIMARY KEY (`grp_id`);

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
-- Indexes for table `tbl_rcnt_dnt`
--
ALTER TABLE `tbl_rcnt_dnt`
  ADD PRIMARY KEY (`rcntdnt_id`),
  ADD KEY `rcntdnt_user` (`rcntdnt_user`),
  ADD KEY `rcntdnt_ewst` (`rcntdnt_ewst`);

--
-- Indexes for table `tbl_rcnt_hry`
--
ALTER TABLE `tbl_rcnt_hry`
  ADD PRIMARY KEY (`hry_rcy_id`);

--
-- Indexes for table `tbl_rdm_cty`
--
ALTER TABLE `tbl_rdm_cty`
  ADD PRIMARY KEY (`rdm_cty_id`);

--
-- Indexes for table `tbl_recyclable`
--
ALTER TABLE `tbl_recyclable`
  ADD PRIMARY KEY (`rcyc_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`rqs_id`),
  ADD KEY `rqs_ctgFk` (`rqs_ctgFk`),
  ADD KEY `rqs_usrId` (`rqs_usrId`);

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
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_cdtn`
--
ALTER TABLE `tbl_cdtn`
  MODIFY `cdtn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ewst`
--
ALTER TABLE `tbl_ewst`
  MODIFY `ewst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_graphdata`
--
ALTER TABLE `tbl_graphdata`
  MODIFY `grp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_pdonations`
--
ALTER TABLE `tbl_pdonations`
  MODIFY `pdn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbl_predeems`
--
ALTER TABLE `tbl_predeems`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_rcnt_dnt`
--
ALTER TABLE `tbl_rcnt_dnt`
  MODIFY `rcntdnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_rcnt_hry`
--
ALTER TABLE `tbl_rcnt_hry`
  MODIFY `hry_rcy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `tbl_rdm_cty`
--
ALTER TABLE `tbl_rdm_cty`
  MODIFY `rdm_cty_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_recyclable`
--
ALTER TABLE `tbl_recyclable`
  MODIFY `rcyc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `rqs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tbl_rwd_items`
--
ALTER TABLE `tbl_rwd_items`
  MODIFY `rwd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_rwd_storage`
--
ALTER TABLE `tbl_rwd_storage`
  MODIFY `rwd_stg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tbl_storage`
--
ALTER TABLE `tbl_storage`
  MODIFY `stg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_typ`
--
ALTER TABLE `tbl_typ`
  MODIFY `typ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ewst`
--
ALTER TABLE `tbl_ewst`
  ADD CONSTRAINT `tbl_ewst_ibfk_1` FOREIGN KEY (`ewst_ctyfk`) REFERENCES `tbl_category` (`cty_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_rcnt_dnt`
--
ALTER TABLE `tbl_rcnt_dnt`
  ADD CONSTRAINT `tbl_rcnt_dnt_ibfk_1` FOREIGN KEY (`rcntdnt_user`) REFERENCES `tbl_user` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_rcnt_dnt_ibfk_2` FOREIGN KEY (`rcntdnt_ewst`) REFERENCES `tbl_ewst` (`ewst_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD CONSTRAINT `tbl_request_ibfk_1` FOREIGN KEY (`rqs_ctgFk`) REFERENCES `tbl_catalog` (`ctg_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_request_ibfk_2` FOREIGN KEY (`rqs_usrId`) REFERENCES `tbl_user` (`usr_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
