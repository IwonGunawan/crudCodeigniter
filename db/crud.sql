-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2020 at 09:02 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_uuid` char(36) NOT NULL,
  `student_name` varchar(225) NOT NULL,
  `student_class` varchar(225) NOT NULL,
  `student_gender` char(1) NOT NULL COMMENT '0=male, 1= female',
  `student_address` text NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0:not deleted, 1:deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_uuid` char(36) NOT NULL,
  `users_name` varchar(225) NOT NULL,
  `users_email` varchar(225) NOT NULL,
  `users_password` varchar(225) NOT NULL,
  `users_level` char(1) NOT NULL COMMENT '0=admin,',
  `users_status` char(1) NOT NULL COMMENT '0=active, 1=non active',
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(225) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(225) DEFAULT NULL,
  `deleted` char(1) NOT NULL DEFAULT '0' COMMENT '0=not deleted, 1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_uuid`, `users_name`, `users_email`, `users_password`, `users_level`, `users_status`, `created_date`, `created_by`, `modified_date`, `modified_by`, `deleted`) VALUES
(1, '152d48e7-a68f-3620-94fb-e78e639f1bad', 'Iwon Gunawan', 'admin@gmail.com', '$2y$10$zoOglWgt8hMkUM2T8evfleqSygHjLIU.OWi3Nti9haiCOD.8MrL4W', '0', '0', '2018-07-25 06:38:19', 'iwon', NULL, '0', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `usersId` (`users_id`),
  ADD KEY `users_id` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
