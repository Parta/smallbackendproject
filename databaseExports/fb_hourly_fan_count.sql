-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2017 at 04:33 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fb_graph`
--

-- --------------------------------------------------------

--
-- Table structure for table `fb_hourly_fan_count`
--

CREATE TABLE `fb_hourly_fan_count` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fan_count` varchar(20) NOT NULL,
  `fb_page_id` varchar(20) NOT NULL,
  `fb_page_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fb_hourly_fan_count`
--

INSERT INTO `fb_hourly_fan_count` (`id`, `date`, `fan_count`, `fb_page_id`, `fb_page_name`) VALUES
(1, '2017-03-06 20:24:06', '103485055', '40796308305', 'CocaCola'),
(2, '2017-03-06 20:25:52', '103485052', '40796308305', 'CocaCola'),
(3, '2017-03-06 20:29:28', '103485046', '40796308305', 'CocaCola'),
(4, '2017-03-06 20:32:01', '103485044', '40796308305', 'CocaCola'),
(5, '2017-03-06 20:45:18', '103485080', '40796308305', 'CocaCola'),
(6, '2017-03-06 20:49:52', '103485063', '40796308305', 'CocaCola'),
(7, '2017-03-06 21:00:25', '103485054', '40796308305', 'CocaCola'),
(8, '2017-03-06 21:01:09', '103485058', '40796308305', 'CocaCola'),
(9, '2017-03-06 21:01:35', '103485059', '40796308305', 'CocaCola'),
(10, '2017-03-06 21:01:51', '103485061', '40796308305', 'CocaCola'),
(11, '2017-03-06 21:04:04', '103485063', '40796308305', 'CocaCola'),
(12, '2017-03-06 21:04:55', '103485065', '40796308305', 'CocaCola'),
(13, '2017-03-06 21:07:14', '103485062', '40796308305', 'CocaCola'),
(14, '2017-03-06 21:09:09', '103485051', '40796308305', 'CocaCola'),
(15, '2017-03-06 21:20:29', '103485076', '40796308305', 'CocaCola');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fb_hourly_fan_count`
--
ALTER TABLE `fb_hourly_fan_count`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fb_hourly_fan_count`
--
ALTER TABLE `fb_hourly_fan_count`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
