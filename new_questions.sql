-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: ubuntumagento.ccjeej6mzuvj.us-east-2.rds.amazonaws.com:3306
-- Generation Time: Aug 08, 2018 at 12:47 PM
-- Server version: 5.6.39-log
-- PHP Version: 5.6.36-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clindb`
--

-- --------------------------------------------------------

--
-- Table structure for table `new_questions`
--

CREATE TABLE `new_questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text,
  `addtime` timestamp NOT NULL,
  `ans_time` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_questions`
--

INSERT INTO `new_questions` (`question_id`, `user_id`, `question`, `answer`, `addtime`, `ans_time`, `status`) VALUES
(69, 2, 'this is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis is answerthis', NULL, '2018-08-08 16:27:37', NULL, '1'),
(77, 2, 'asdasdada adasd', NULL, '2018-08-08 17:24:07', NULL, '1'),
(78, 2, 'asdasdada adasd', NULL, '2018-08-08 17:24:57', NULL, '1'),
(79, 2, 'this is answerthis is answerthis is answerthis is ansthis is answerthis is answerthis is answerthis is ansthis is answerthis is answerthis is answerthis is ansthis is answerthis is answerthis is answe', NULL, '2018-08-08 17:34:03', NULL, '1'),
(80, 2, 'asdasdada adasd ', NULL, '2018-08-08 17:35:48', NULL, '1'),
(81, 2, 'this is answerthis is answerthis is answerthis is ansthis is answerthis is answerthis is answerthis is ansthis is answerthis is answerthis is answerthis is ansthis is answerthis is answerthis is answe', NULL, '2018-08-08 17:41:41', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `new_questions`
--
ALTER TABLE `new_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `new_questions`
--
ALTER TABLE `new_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
