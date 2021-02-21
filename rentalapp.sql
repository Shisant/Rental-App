-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 01:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentalapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profession` varchar(100) NOT NULL,
  `current_address` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `house_type` varchar(100) NOT NULL,
  `bolcony` varchar(100) NOT NULL,
  `storeroom` varchar(100) NOT NULL,
  `furnished` varchar(5) NOT NULL,
  `twowheeler` varchar(100) NOT NULL,
  `fourwheeler` varchar(100) NOT NULL,
  `discription` varchar(100) NOT NULL,
  `bachelor` varchar(100) NOT NULL,
  `family` varchar(100) NOT NULL,
  `married` varchar(100) NOT NULL,
  `boys` varchar(100) NOT NULL,
  `girls` varchar(100) NOT NULL,
  `smoking` varchar(100) NOT NULL,
  `alcohol` varchar(100) NOT NULL,
  `nonveg` varchar(1000) NOT NULL,
  `other_restriction` varchar(100) NOT NULL,
  `flat` varchar(100) NOT NULL,
  `colony` varchar(100) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `rent` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `image` longblob NOT NULL,
  `image2` longblob NOT NULL,
  `image3` longblob NOT NULL,
  `image4` longblob NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `verify` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `successful`
--

CREATE TABLE `successful` (
  `visit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `house_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(7, 'a@a.com', '$2y$10$wKw2eBQYysvD4hjEDP8exOk1BWlyiWOXizx0BgkoK206r/sR1r5SC', '2019-06-23 00:28:45'),
(8, 'shisantchhetri90@gmail.com', '$2y$10$yv470d8oqVlj0wToJUmvYuDAKwV2.V.jB9ckyjojKS3vDcFcHr3C.', '2019-06-28 03:06:15'),
(9, 'Shisant@gmail.com', '$2y$10$O.imJtdpb7Q7gIdsb/3g4uDUxRcKhMUmli5B/op8JqGBMYJONHvMe', '2019-06-28 03:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `address` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `first_name`, `last_name`, `username`, `password`, `address`, `state`, `mobile`) VALUES
(7, 'Shisant', 'GC', 'a@a.com', '$2y$10$00ubj4vaUdeNUwir2kG9gOkjvZ1XfBWCPMJEma5ipv/Grh3SBsxga', 'lalitpur', 'state 2', '9847858122'),
(8, 'Sumant', 'Shrestha', 'shisantchhetri90@gmail.com', '$2y$10$CLlIRRT6Xs7WSKFXhyL28eIgntnYzwweXvjqXQ9e7wJTSe0wYAfda', 'pokhara', 'state', '9847800122'),
(9, 'raja', 'ok', 'Shisant@gmail.com', '$2y$10$eFm2TPnKi2DGXiwxv7R10uTFOGImDCr9OH/zmJDQ84/wFsy57qqyy', 'kathmandu', 'state', '1212345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `successful`
--
ALTER TABLE `successful`
  ADD PRIMARY KEY (`visit_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `property_foreign_key` (`house_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `successful`
--
ALTER TABLE `successful`
  MODIFY `visit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `houses`
--
ALTER TABLE `houses`
  ADD CONSTRAINT `houses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `successful`
--
ALTER TABLE `successful`
  ADD CONSTRAINT `property_foreign_key` FOREIGN KEY (`house_id`) REFERENCES `houses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
