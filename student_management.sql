-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 22, 2017 at 08:34 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1495450974),
('m130524_201442_init', 1495450978);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `code` varchar(6) DEFAULT '',
  `age` int(11) NOT NULL DEFAULT '0',
  `maths_marks` int(11) NOT NULL,
  `science_marks` int(11) NOT NULL,
  `english_marks` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `percentage` varchar(30) NOT NULL,
  `rank` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `code`, `age`, `maths_marks`, `science_marks`, `english_marks`, `total_marks`, `percentage`, `rank`, `created_on`) VALUES
(1, 'yatin.mistry', 'ea27aab65da10ce16136808db72d32aa', 'Yatin Mistry', 'yatinmistry5130@gmail.com', 'WE32MN', 0, 0, 0, 0, 0, '0.00', 0, '2017-05-22 14:40:34'),
(2, 'rahul.patel', '2acb7811397a5c3bea8cba57b0388b79', 'Rahul Patel', 'rahul.patel@gmail.com', 'FCV4RS', 0, 0, 0, 0, 0, '0.00', 0, '2017-05-22 14:40:34'),
(3, 'niral.patel', 'ea27aab65da10ce16136808db72d32aa', 'Niral Patel', 'niral.patel@gmail.com', '', 10, 90, 50, 60, 200, '66.67', 3, '2017-05-22 14:53:31'),
(4, NULL, 'd41d8cd98f00b204e9800998ecf8427e', 'Nitesh Morajkar', NULL, '', 15, 70, 66, 71, 207, '69.00', 2, '2017-05-22 14:53:31'),
(5, NULL, 'd41d8cd98f00b204e9800998ecf8427e', 'Neeraj Bankey', NULL, '', 16, 60, 65, 70, 195, '65.00', 4, '2017-05-22 14:53:31'),
(6, 'pratik.lad', '', 'Pratik Lad', NULL, '', 16, 88, 75, 69, 232, '77.33', 1, '2017-05-22 14:51:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
