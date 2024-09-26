-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2024 at 01:29 PM
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
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `crt_id` int(11) NOT NULL,
  `crt_usr_id` int(50) NOT NULL,
  `crt_name` text NOT NULL,
  `crt_points` int(50) NOT NULL,
  `crt_dateadd` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catalog`
--

CREATE TABLE `tbl_catalog` (
  `ctg_id` int(11) NOT NULL,
  `ctg_name` text NOT NULL,
  `ctg_datead` datetime NOT NULL DEFAULT current_timestamp(),
  `ctg_points` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_catalog`
--

INSERT INTO `tbl_catalog` (`ctg_id`, `ctg_name`, `ctg_datead`, `ctg_points`) VALUES
(1, 'pencil/paper', '2024-05-03 19:35:36', 20),
(2, 'bondpaper (20pcs)', '2024-05-03 19:36:28', 10),
(3, 'ballpen (red/blue)', '2024-05-03 19:36:51', 25),
(4, 'bondpaper (1bundle)', '2024-05-21 15:56:16', 40),
(5, 'marker (2pcs)', '2024-05-22 13:04:56', 20),
(6, 'folders', '2024-05-22 14:45:37', 20);

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
(43, 'Audio-Visual Equipment', '', '2024-09-17');

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
  `download` int(200) NOT NULL,
  `ewst_dateadd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ewst`
--

INSERT INTO `tbl_ewst` (`ewst_id`, `ewst_name`, `ewst_userfk`, `ewst_img`, `ewst_ctyfk`, `ewst_gcon`, `ewst_pdam`, `ewst_fdam`, `download`, `ewst_dateadd`) VALUES
(92, 'Smart Phone', 0, 'IMG_66e987b01a4ba2.98233565.jpg', 41, 100, 50, 20, 0, '2024-09-17 10:17:27'),
(93, 'Laptops', 0, 'IMG_66e987c89c1c49.26649413.jpg', 42, 180, 80, 40, 0, '2024-09-17 10:21:00'),
(95, 'earphones', 0, 'IMG_66e98a73b748b6.36028701.png', 43, 60, 30, 10, 0, '2024-09-17 11:26:26'),
(96, 'Tablet', 0, 'IMG_66e98f29e9aee8.36207513.jpg', 41, 150, 80, 40, 0, '2024-09-17 22:16:09');

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
  `pdn_dateAdd` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pdonations`
--

INSERT INTO `tbl_pdonations` (`pdn_id`, `pdn_user`, `pdn_ewst`, `pdn_status`, `pdn_cdtn_pts`, `pdn_cdtn`, `pdn_ewst_name`, `pdn_qty`, `pdn_dateAdd`) VALUES
(11, 34, 92, 1, 200, 'Good Condition', '', 0, '2024-09-24 22:20:02'),
(12, 34, 92, 1, 50, 'Partially Damaged', '', 0, '2024-09-24 22:21:25'),
(13, 34, 92, 1, 20, 'Fully Damage', 'Smart Phone', 0, '2024-09-25 21:17:32'),
(14, 34, 92, 1, 20, 'Fully Damage', 'Smart Phone', 1, '2024-09-25 22:01:28'),
(15, 34, 92, 1, 20, 'Fully Damage', 'Smart Phone', 1, '2024-09-25 22:04:09'),
(16, 34, 96, 1, 80, 'Fully Damage', 'Tablet', 2, '2024-09-25 22:06:53'),
(17, 34, 92, 1, 20, 'Fully Damage', 'Smart Phone', 1, '2024-09-25 22:18:45');

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

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`rqs_id`, `rqs_usrId`, `rqs_ctgFk`, `rqs_stats`, `rqs_dateAdd`) VALUES
(39, 26, 2, 1, '2024-05-22 14:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rewards`
--

CREATE TABLE `tbl_rewards` (
  `rwd_id` int(11) NOT NULL,
  `rwd_typ` text NOT NULL,
  `rwd_dateadd` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `usr_rwd` int(100) NOT NULL,
  `usr_total_rwd` int(100) NOT NULL,
  `usr_usrpass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`usr_id`, `usr_typ`, `usr_fname`, `usr_lname`, `usr_usrname`, `usr_email`, `usr_rwd`, `usr_total_rwd`, `usr_usrpass`) VALUES
(2, 1, 'admin', 'george', 'ChmsuAdmin1', '', 220, 220, '$2y$10$plPk1gc2Yap72EFkpkKreeg71S0WmCETiBrklNM567jV7fumY7OiO'),
(25, 2, 'Alitest', 'Testing ', '', 'santolumaaljon@gmail.com', 570, 570, '$2y$10$SPsMOQnxTG1xT6.D7/4k4Oz8ZxgUXJA8OtFBS/skthb6b9CWS.06a'),
(26, 2, 'arone', 'Bantiling', '', 'alrea0015@gmail.com', 55, 55, '$2y$10$RcAsZU2w3ufW2bU57IfqIOXhyXfVre4xHjTEHuSvcgbZyP1Ik.8bO'),
(27, 2, 'Chester', 'Palesterio ', '', 'ches@gmail.com', 0, 0, '$2y$10$Okqg08wTN.ru9fY0VKTsge.WZCGDiuIXwz2Viet7ntU4mIxF7aLGG'),
(28, 2, 'Jessamine ', 'Lacoste', '', 'santolumaaljon@gmail.com', 0, 0, '$2y$10$8p/KsF2wj1TpPKY9dZaQi..6NOn2ym8keb0RVTGkoz6asfMIutnsS'),
(29, 2, 'Jhave', 'Soriano', '', 'Soriano@gmail.com', 0, 0, '$2y$10$Wu1YqiCrQaKGY3s6kcG0BeXW5tDtenGzjO3EMaPW/6taTNuPeAP62'),
(30, 2, 'Ms jay', 'Sy', '', 'jay@gmail.com', 10, 10, '$2y$10$u721CSOhYncUmFtVBL9CdO3aRnq5RH9cs.jGBwTcOG.Txu5Sf7mOm'),
(31, 2, 'Yuan', 'cortex', '', 'cortex@gmail.com', 0, 0, '$2y$10$3eqGet7jQmcSvFJfMseld.cifqKwNf4UVhKmX3S1DxE9cfSE1/ZWW'),
(33, 2, '', '', 'Test', 'Test', 0, 0, '$2y$10$fOqldDfG/zXaixmmyxnlKOxGgvgCcOosYxtoQb9BgBX4FHhVnmnFu'),
(34, 2, 'Aljon', 'Santoluma', 'Testing', 'test@gmail.com', 40, 0, '$2y$10$dt09o1lVoT8AdV7XEyUt8.RpaMSv.sG.DxpQtybCpc5JA5.ESrEw.'),
(35, 2, '', '', 'F', 'V', 0, 0, '$2y$10$IlwJZDojn7oh/FUuwxX/peUobal80kAOjokAaPPrrObq8k4Srj7WW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`crt_id`);

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
-- Indexes for table `tbl_rcnt_dnt`
--
ALTER TABLE `tbl_rcnt_dnt`
  ADD PRIMARY KEY (`rcntdnt_id`),
  ADD KEY `rcntdnt_user` (`rcntdnt_user`),
  ADD KEY `rcntdnt_ewst` (`rcntdnt_ewst`);

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
-- Indexes for table `tbl_rewards`
--
ALTER TABLE `tbl_rewards`
  ADD PRIMARY KEY (`rwd_id`);

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
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `crt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_catalog`
--
ALTER TABLE `tbl_catalog`
  MODIFY `ctg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbl_cdtn`
--
ALTER TABLE `tbl_cdtn`
  MODIFY `cdtn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_ewst`
--
ALTER TABLE `tbl_ewst`
  MODIFY `ewst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tbl_pdonations`
--
ALTER TABLE `tbl_pdonations`
  MODIFY `pdn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_rcnt_dnt`
--
ALTER TABLE `tbl_rcnt_dnt`
  MODIFY `rcntdnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `tbl_rewards`
--
ALTER TABLE `tbl_rewards`
  MODIFY `rwd_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_typ`
--
ALTER TABLE `tbl_typ`
  MODIFY `typ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`usr_typ`) REFERENCES `tbl_typ` (`typ_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
