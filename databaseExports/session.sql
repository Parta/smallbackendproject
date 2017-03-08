-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2017 at 04:34 AM
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
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `access_tocken` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `access_tocken`) VALUES
(1, 'EAAGCZAm5wjRUBAGYQRw6Ey6gZCbYR9Ud0YQtvpKLRMkS8BayUgpX8wdGWluzmu3mU4YlW38OLqEoib1yJ7bkMIiv0bnrxVQTdaLiYYDnBNLoYNYgv4VBt4lAQbSDsyd8580M5ZBZAh6VterNd3UQvXpenszQ8V0ZD'),
(2, 'EAAGCZAm5wjRUBAGYQRw6Ey6gZCbYR9Ud0YQtvpKLRMkS8BayUgpX8wdGWluzmu3mU4YlW38OLqEoib1yJ7bkMIiv0bnrxVQTdaLiYYDnBNLoYNYgv4VBt4lAQbSDsyd8580M5ZBZAh6VterNd3UQvXpenszQ8V0ZD'),
(3, 'EAAGCZAm5wjRUBAGYQRw6Ey6gZCbYR9Ud0YQtvpKLRMkS8BayUgpX8wdGWluzmu3mU4YlW38OLqEoib1yJ7bkMIiv0bnrxVQTdaLiYYDnBNLoYNYgv4VBt4lAQbSDsyd8580M5ZBZAh6VterNd3UQvXpenszQ8V0ZD'),
(4, 'EAAGCZAm5wjRUBAGYQRw6Ey6gZCbYR9Ud0YQtvpKLRMkS8BayUgpX8wdGWluzmu3mU4YlW38OLqEoib1yJ7bkMIiv0bnrxVQTdaLiYYDnBNLoYNYgv4VBt4lAQbSDsyd8580M5ZBZAh6VterNd3UQvXpenszQ8V0ZD'),
(5, 'EAAGCZAm5wjRUBAGYQRw6Ey6gZCbYR9Ud0YQtvpKLRMkS8BayUgpX8wdGWluzmu3mU4YlW38OLqEoib1yJ7bkMIiv0bnrxVQTdaLiYYDnBNLoYNYgv4VBt4lAQbSDsyd8580M5ZBZAh6VterNd3UQvXpenszQ8V0ZD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
