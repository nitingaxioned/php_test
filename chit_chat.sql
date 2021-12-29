-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2021 at 02:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chit_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `mesage` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fromUserId` int(11) NOT NULL,
  `toUserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `mesage`, `date`, `fromUserId`, `toUserId`) VALUES
(104, 'hello', '2021-12-29 16:30:43', 101, 102),
(105, 'Bro', '2021-12-29 17:54:37', 101, 102),
(106, 'hey WatsUp ??', '2021-12-29 17:57:08', 102, 101),
(107, 'hey WatsUp ??', '2021-12-29 18:03:27', 102, 101),
(108, 'allright.', '2021-12-29 18:09:43', 101, 102),
(109, 'getting ready for college', '2021-12-29 18:10:37', 101, 102),
(110, 'and what are u doing', '2021-12-29 18:10:56', 101, 102),
(111, 'i wass wating for my cab going for lunch with my babe.......... : )', '2021-12-29 18:12:03', 102, 101),
(117, 'hello', '2021-12-29 18:50:15', 101, 100),
(118, 'hey Al;;;', '2021-12-29 18:50:49', 102, 100);

-- --------------------------------------------------------

--
-- Stand-in structure for view `msgs`
-- (See below for the actual view)
--
CREATE TABLE `msgs` (
`id` int(11)
,`mesage` text
,`date` datetime
,`fromUserId` int(11)
,`toUserId` int(11)
,`fromUser` varchar(25)
,`toUser` varchar(25)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `password`) VALUES
(100, '', '', '', ''),
(101, 'Alfa', '7896541236', 'alfa@xyz.com', '$2y$10$lWcCAZVJ0AtQ.w4FzH7q4uL8Ozuuur5Yr7MxWjB0ygPTdOdXdunqm'),
(102, 'beta', '9874563217', 'beta@xyz.com', '$2y$10$dOGE.9eiWhuv7BjNi/9ZHOdnJx.1MOapA6IwWMe2xUhgguSks/LHS');

-- --------------------------------------------------------

--
-- Structure for view `msgs`
--
DROP TABLE IF EXISTS `msgs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `msgs`  AS SELECT `messages`.`id` AS `id`, `messages`.`mesage` AS `mesage`, `messages`.`date` AS `date`, `messages`.`fromUserId` AS `fromUserId`, `messages`.`toUserId` AS `toUserId`, `users`.`name` AS `fromUser`, `u`.`name` AS `toUser` FROM ((`messages` join `users` on(`messages`.`fromUserId` = `users`.`id`)) join `users` `u` on(`messages`.`toUserId` = `u`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `toUserId` (`toUserId`),
  ADD KEY `fromUserId` (`fromUserId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`toUserId`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`fromUserId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
