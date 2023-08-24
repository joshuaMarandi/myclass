-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2022 at 02:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beginner_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(1024) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post`, `image`, `date`) VALUES
(1, 2, 'this is my first post', '', '2022-06-05 08:08:48'),
(2, 2, 'this is a post with an image', 'uploads/pexels-hitesh-choudhary-879109.jpg', '2022-06-05 08:10:16'),
(3, 2, 'another post with out image', '', '2022-06-05 08:27:33'),
(4, 2, 'a post with image', 'uploads/452748.jpg', '2022-06-05 08:28:50'),
(5, 3, 'this is a post from john', '', '2022-06-05 08:37:59'),
(9, 2, 'uyfvhkbhjkb\r\n\r\n<script>alert(\'hacked\')</script>\r\ndfqfffaefv\r\n\r\n\r\n\r\nqfqdfdfdfqd', '', '2022-06-05 09:08:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date`, `image`) VALUES
(2, 'eathorne', 'email@email.com', 'password', '2022-06-05 07:59:14', 'uploads/452771.jpg'),
(3, 'john', 'john@email.com', 'password', '2022-06-05 08:37:32', 'uploads/791a047636136702e25ba1096b11cfe7.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `username` (`username`),
  ADD KEY `date` (`date`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
