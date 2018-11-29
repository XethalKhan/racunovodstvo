-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 05:32 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `acc`.* TO 'admin'@'localhost' WITH GRANT OPTION;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acc`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(30) DEFAULT NULL COMMENT 'Identification number of assignment',
  `d_acc` int(30) DEFAULT NULL COMMENT 'Debit side account',
  `p_acc` int(30) DEFAULT NULL COMMENT 'Credit side account',
  `acc_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Account name',
  `d_amount` double DEFAULT NULL COMMENT 'Debit side amount',
  `p_amount` double DEFAULT NULL COMMENT 'Credit side amount'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table of all asignments';

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`id`, `d_acc`, `p_acc`, `acc_name`, `d_amount`, `p_amount`) VALUES
(1, 101, NULL, 'Materijal', 100000, NULL),
(1, NULL, 433, 'Dobavljaci', NULL, 100000),
(2, 241, NULL, 'Tekuci racun', 500000, NULL),
(2, NULL, 414, 'Dugorocni krediti u zemlji', NULL, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `completed`
--

CREATE TABLE `completed` (
  `ids` int(30) NOT NULL COMMENT 'Identification number of student',
  `ida` int(30) NOT NULL COMMENT 'Identification number of assignment',
  `row` int(30) NOT NULL COMMENT 'Row number in task',
  `d_acc` int(30) DEFAULT NULL COMMENT 'Debit side account',
  `p_acc` int(30) DEFAULT NULL COMMENT 'Credit side account',
  `acc_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Account name',
  `d_amount` double DEFAULT NULL COMMENT 'Debit side amount',
  `p_amount` double DEFAULT NULL COMMENT 'Credit side amount'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='All assignments completed by students';

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(30) NOT NULL COMMENT 'Identification number of grade',
  `ids` int(30) NOT NULL COMMENT 'Identification number of student',
  `idp` int(30) NOT NULL COMMENT 'Identification number of profesor',
  `ida` int(30) NOT NULL COMMENT 'Identification number of assignment',
  `grade` int(30) NOT NULL COMMENT 'Grade'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table of grades';

-- --------------------------------------------------------

--
-- Table structure for table `grp`
--

CREATE TABLE `grp` (
  `id` int(30) NOT NULL COMMENT 'Identification number of group',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of group',
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description of group'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table of user groups';

--
-- Dumping data for table `grp`
--

INSERT INTO `grp` (`id`, `name`, `description`) VALUES
(1, 'Studenti', 'Studenti mogu resavati zadatke'),
(2, 'Profesori', 'Profesori mogu kreirati i ocenjivati zadatke');

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE `text` (
  `id` int(30) NOT NULL COMMENT 'Identification number of the assignment',
  `text` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Text of the assignment'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table of assignments text';

--
-- Dumping data for table `text`
--

INSERT INTO `text` (`id`, `text`) VALUES
(1, 'Kupljeno je od dobavljaca na kredit materijala u vrednosti od 100.000'),
(2, 'Uzet je dugorocni kredit u iznosu od 500.000 dinara');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(30) NOT NULL COMMENT 'Identification number of user',
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User name',
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'User password',
  `grp` int(30) NOT NULL COMMENT 'User group'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table of users';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `grp`) VALUES
(1, 'student1', '5e5545d38a68148a2d5bd5ec9a89e327', 1),
(2, 'prof1', '4f5fdb3de5aa701eae2961743a00c01c', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD KEY `IX01_ASSIGNMENT` (`id`);

--
-- Indexes for table `completed`
--
ALTER TABLE `completed`
  ADD KEY `IX01_COMPLETED_IDS` (`ids`),
  ADD KEY `IX02_COMPLETED_IDA` (`ida`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grp`
--
ALTER TABLE `grp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `text`
--
ALTER TABLE `text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IX01_USER_GROUP` (`grp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT COMMENT 'Identification number of grade', AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
