-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2017 at 02:52 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pagination`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `firstname`, `lastname`, `username`) VALUES
(1, 'neovic', 'devierte', 'nurhodelta'),
(2, 'julyn', 'divinagracia', 'julyn'),
(3, 'lee', 'ann', 'lee09'),
(4, 'tintin', 'demapanag', 'tin45'),
(5, 'dee', 'tolentino', 'deedee'),
(6, 'jaira', 'jacinto', 'jjacinto'),
(7, 'tetai', 'devi', 'tdevi'),
(8, 'tintin', 'hermosa', 'tinhermosa'),
(9, 'piolo', 'pascual', 'ppascual'),
(10, 'lee', 'bagun', 'faker'),
(11, 'barny', 'dino', 'bdino'),
(12, 'wqeqweq', 'werew', 'weqweqw'),
(13, 'weqwe', 'weqwe', 'weqwe'),
(14, 'wqeqweq', 'weqwe', 'weqweqw'),
(15, 'wewqeq', 'wewqeqweqw', 'wewqeqweq'),
(16, 'weqwe', 'wewqeqw', 'wewqeqw'),
(17, 'wewqeq', 'wewqeqweq', 'weqweqweqw'),
(18, 'weqw', 'wewqeqw', 'wqeqwe'),
(19, 'weqweq', 'wewqeqweqw', 'wewqewqeqw'),
(20, 'qweqw', 'weqw', 'weqw'),
(21, 'w', 'weqw', 'qweqweqw'),
(22, 'weqw', 'weqweqw', 'wqeqweqw'),
(23, 'weqweq', 'wqeqweqw', 'weqweqw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
