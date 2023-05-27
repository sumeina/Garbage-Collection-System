-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2016 at 04:45 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `token`, `status`) VALUES
(23, 'Deepak', 'deepak.suhawal@gmail.com', '00124578', '092c1caafc3ff7d1de61a110a5b46462f1d01644f212fc214a18d2528067308b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Table structure for table `gabbage_type`
--

CREATE TABLE IF NOT EXISTS `garbage_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `chargespm` text NOT NULL, --charge-per-month--
  `chargespd` varchar(500) NOT NULL, --charge-per-day--
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `gabbage_type`
--

INSERT INTO `garbage_type` (`id`, `name`, `chargespm`, `chargespd`) VALUES
(1, 'Non-Hazardous', '3000', '100'),
(8, 'Hazardous', '9000', '300'),
(9, 'Bio-Waste', '6000', '200');

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `chargespm` text NOT NULL, --charge-per-month--
  `chargespd` varchar(500) NOT NULL, --charge-per-day--
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `gabbage_type`
--

INSERT INTO `garbage_type` (`id`, `name`, `chargespm`, `chargespd`) VALUES
(1, 'Non-Hazardous', '3000', '100'),
(8, 'Hazardous', '9000', '300'),
(9, 'Bio-Waste', '6000', '200');

-- --------------------------------------------------------

--
--
CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(500) NOT NULL,
  `pay_type` varchar(500) NOT NULL,
  `client_type` varchar(500) NOT NULL,
  `garbage_type` varchar(500) NOT NULL,
  `location` text NOT NULL,
  `weight` int NOT NULL,
  `contact` varchar(500) NOT NULL,
  `status` varchar(500) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `names`, `pay_type`, `client_type`, `garbage_type`, `location`,`weight`, `contact`, `status`, `date`) VALUES
(25, 'Sumina', 'percollection', 'individual', 'Bio', 'Kalanki', '10', '9075846954', 'Approved', '2023-02-12'),
(26, '29949299', '8b1753bd5706fff3c62c790e4707f441', 'Balaju', '20', 'Landless', '0725545465', 'Degrdable', 'May 28, 2015'),
(29, 'Ram', 'monthly', 'individual', 'Hazardous', 'Sitapaila', '30','01246565', 'pending', '2021-06-23'),
(30, 'Shyam', 'monthly', 'company', 'Non Hazardous', 'Samakhusi','40', '1244545', 'pending', '2021-06-24');