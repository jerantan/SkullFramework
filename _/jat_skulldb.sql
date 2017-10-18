-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2017 at 12:20 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jat_skulldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL,
  `table_name` varchar(50) NOT NULL,
  `field_name` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field`
--

INSERT INTO `field` (`id`, `table_name`, `field_name`, `active`) VALUES
(1, 'user', 'name', 1),
(2, 'user', 'username', 0),
(3, 'user', 'level', 1),
(4, 'user', 'active', 1),
(5, 'user', 'added', 0),
(6, 'user', 'updated', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `added` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `level`, `active`, `added`, `updated`) VALUES
(1, 'Jeran Tan', 'adminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'Admin', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Jemphol Tan', 'pippip', 'a85f52964ed80bb56dac3321466663f2', 'Asst. Admin', 1, '0000-00-00 00:00:00', '2017-10-08 04:29:38'),
(3, 'Joshua Tan', 'wangwang', '89823788b6530348e0eac4c15d124271', 'Asst. Admin', 1, '2017-10-08 10:49:23', '0000-00-00 00:00:00'),
(4, 'Peter Asilum', 'pakners', '2978d823f7f2291cee0a5d88cfff9f03', 'Asst. Admin', 1, '2017-10-15 11:19:42', '0000-00-00 00:00:00'),
(5, 'James Taghoy', 'jmoyjmoy', 'efb86dc1ddd66154e0543b7940a1e3ac', 'Asst. Admin', 1, '2017-10-15 11:21:44', '0000-00-00 00:00:00'),
(6, 'Johannes Tan', 'ogingoging', 'da9c88ac26c90948b2dfdc1094396c65', 'Asst. Admin', 1, '2017-10-16 16:58:53', '0000-00-00 00:00:00'),
(7, 'Andresa Tan', 'mamamama', '877dba90e1752571ffa32de87602981e', 'Asst. Admin', 1, '2017-10-16 17:01:31', '0000-00-00 00:00:00'),
(8, 'Raul Tan', 'papapapa', 'b7626fe60f276ad29fbeefca8cb99336', 'Asst. Admin', 1, '2017-10-16 17:05:15', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
