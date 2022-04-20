-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2022 at 10:08 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faculty_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `cno` int(12) NOT NULL,
  `pno` int(12) NOT NULL,
  `date` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `company_f` varchar(255) NOT NULL,
  `enddt` varchar(20) NOT NULL,
  `length` varchar(20) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fdps`
--

CREATE TABLE `fdps` (
  `fno` int(25) NOT NULL,
  `pno` int(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `org_by` varchar(25) NOT NULL,
  `org_by_f` varchar(255) NOT NULL,
  `spon_by` varchar(25) NOT NULL,
  `spon_by_f` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hackathons`
--

CREATE TABLE `hackathons` (
  `hno` int(12) NOT NULL,
  `pno` int(12) NOT NULL,
  `date` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `org_by` varchar(10) NOT NULL,
  `org_by_f` varchar(255) DEFAULT NULL,
  `spon_by` varchar(10) NOT NULL,
  `spon_by_f` varchar(255) DEFAULT NULL,
  `members` varchar(255) NOT NULL,
  `startdt` date NOT NULL,
  `enddt` date NOT NULL,
  `duration` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `its`
--

CREATE TABLE `its` (
  `ino` int(255) NOT NULL,
  `pno` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ind_name` varchar(255) NOT NULL,
  `training_field` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `startdt` varchar(255) NOT NULL,
  `enddt` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `jno` int(25) NOT NULL,
  `pno` int(25) NOT NULL,
  `date` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `auth_pos` varchar(25) NOT NULL,
  `coauth` varchar(255) NOT NULL,
  `jname` varchar(255) NOT NULL,
  `vol_no` varchar(25) NOT NULL,
  `issue_no` varchar(25) NOT NULL,
  `page_no` varchar(25) NOT NULL,
  `do_issue` varchar(25) NOT NULL,
  `imp_factor` varchar(25) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `pub_url` varchar(255) NOT NULL,
  `indexing` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `pno` int(255) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `prno` int(12) NOT NULL,
  `pno` int(12) NOT NULL,
  `date` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `members` varchar(255) NOT NULL,
  `spon_by` varchar(10) NOT NULL,
  `spon_by_f` varchar(255) NOT NULL,
  `cost` int(25) NOT NULL,
  `startdt` varchar(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `enddt` varchar(25) DEFAULT current_timestamp(),
  `duration` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `seminars`
--

CREATE TABLE `seminars` (
  `sno` int(255) NOT NULL,
  `pno` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `org_by` varchar(255) NOT NULL,
  `org_by_f` varchar(255) NOT NULL,
  `spon_by` varchar(255) NOT NULL,
  `spon_by_f` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_design` varchar(255) NOT NULL,
  `res_insti` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sitedata`
--

CREATE TABLE `sitedata` (
  `totalposts` int(255) NOT NULL,
  `totalusers` int(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `clgid` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `journals` int(255) NOT NULL DEFAULT 0,
  `seminars` int(255) NOT NULL DEFAULT 0,
  `workshops` int(255) NOT NULL DEFAULT 0,
  `courses` int(255) NOT NULL DEFAULT 0,
  `projects` int(255) NOT NULL DEFAULT 0,
  `it` int(255) NOT NULL DEFAULT 0,
  `hackathons` int(255) NOT NULL DEFAULT 0,
  `fdp` int(255) NOT NULL DEFAULT 0,
  `dp` varchar(255) NOT NULL,
  `superuser` tinyint(1) NOT NULL,
  `lastupdated` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `display` varchar(255) NOT NULL DEFAULT 'assets/user/display/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uno`, `name`, `clgid`, `pass`, `dept`, `designation`, `email`, `phone`, `journals`, `seminars`, `workshops`, `courses`, `projects`, `it`, `hackathons`, `fdp`, `dp`, `superuser`, `lastupdated`, `display`) VALUES
(32, 'Tony Stark', 'ironman@a.com', '56bd7107802ebe56c6918992f0608ec6', 'Electrical & Electronics Engineering', 'Professor', 'ironman@a.com', '1234567890', -6, 1, -1, 0, -1, 8, 9, 2, 'assets/user/images/Tony_Stark.jpg', 1, '2022-03-18 04:33:45', 'assets/user/display/antelope.jfif'),
(33, 'Hulk', 'hulk@a.com', '56bd7107802ebe56c6918992f0608ec6', 'Bio Medical Engineering', 'Assistant Professor', 'hulk@a.com', '1234567891', 1, 0, 1, 0, 0, 0, 0, 0, 'assets/user/images/markruffalo-theavengers-thehulk-2000x1270-1.jpg', 0, '2022-03-18 04:37:30', 'assets/user/display/default.jpg'),
(34, 'Captain', 'capt123', '56bd7107802ebe56c6918992f0608ec6', 'Bio Medical Engineering', 'Professor & HOD', 'captain@a.com', '1234567891', 0, 0, 0, 0, 0, 0, 1, 0, 'assets/user/images/2300cb1f2391388a28c83b171e8c25e3.jpg', 0, '2022-03-18 04:44:57', 'assets/user/display/default.jpg'),
(37, 'Dr.Strange', 'dr@a.com', '56bd7107802ebe56c6918992f0608ec6', 'Mechatronics Engineering', 'Assistant Professor', 'dr@a.com', '1234567898', 0, 0, 0, 0, 0, 0, 0, 0, '../assets/user/images/eins.jpg', 0, '2022-04-19 16:42:35', 'assets/user/display/default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `wno` int(25) NOT NULL,
  `pno` int(255) NOT NULL,
  `date` varchar(25) NOT NULL,
  `title` varchar(255) NOT NULL,
  `org_by` varchar(25) NOT NULL,
  `org_by_f` varchar(255) NOT NULL,
  `spon_by` varchar(25) NOT NULL,
  `spon_by_f` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `duration` varchar(25) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `res_name` varchar(255) NOT NULL,
  `res_design` varchar(255) NOT NULL,
  `res_insti` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `uid` varchar(25) NOT NULL,
  `uclgid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cno`);

--
-- Indexes for table `fdps`
--
ALTER TABLE `fdps`
  ADD PRIMARY KEY (`fno`);

--
-- Indexes for table `hackathons`
--
ALTER TABLE `hackathons`
  ADD PRIMARY KEY (`hno`);

--
-- Indexes for table `its`
--
ALTER TABLE `its`
  ADD PRIMARY KEY (`ino`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`jno`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`pno`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`prno`);

--
-- Indexes for table `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uno`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`wno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `cno` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fdps`
--
ALTER TABLE `fdps`
  MODIFY `fno` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hackathons`
--
ALTER TABLE `hackathons`
  MODIFY `hno` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `its`
--
ALTER TABLE `its`
  MODIFY `ino` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `jno` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `pno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `prno` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seminars`
--
ALTER TABLE `seminars`
  MODIFY `sno` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `wno` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
