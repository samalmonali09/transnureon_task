-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2018 at 08:42 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `friendreq`
--

CREATE TABLE `friendreq` (
  `id` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendreq`
--

INSERT INTO `friendreq` (`id`, `fromId`, `toId`, `status`) VALUES
(1, 1, 3, 0),
(2, 4, 1, 0),
(3, 4, 3, 0),
(4, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reqId` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `reqId`) VALUES
(1, 'mona', 'm@gmail.com', '$2y$10$Y6YHgji1X7OvzDOTDxTcjenfA6pVxZZkhWQDxFBwBXcExNp9rHJIq', '1,3'),
(2, 'monahh', 'mk@gmail.com', '$2y$10$6c3neNJz0q5nQqsa5qijkOcKeBPSJHWHzBnpwqfB4URoQWvR1TbiG', '2'),
(3, 'monafe', 'h@gmail.com', '$2y$10$nDHfBMNDZE8eatUkxtOySO3LTk7LpQzFf7RNuBzwEvMcRT7v3/9EK', '0'),
(4, 'sdgsh', 'k@gmail.com', '$2y$10$pW44UGggk1C7Mb1MPrenNeYvsuUc2AmNeBrgkWgJfdUfxD2wx8/x.', '4,1,3,2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friendreq`
--
ALTER TABLE `friendreq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friendreq`
--
ALTER TABLE `friendreq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
