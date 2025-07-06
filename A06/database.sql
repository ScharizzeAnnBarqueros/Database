-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2025 at 03:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `addressID` int(11) NOT NULL,
  `cityID` int(11) NOT NULL,
  `provinceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `closefriends`
--

CREATE TABLE `closefriends` (
  `closeFriendID` int(1) NOT NULL,
  `ownerID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `fName` varchar(30) NOT NULL,
  `lName` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'closeFriend',
  `is_deleted` varchar(5) NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `closefriends`
--

INSERT INTO `closefriends` (`closeFriendID`, `ownerID`, `userID`, `fName`, `lName`, `status`, `is_deleted`) VALUES
(1, 0, 0, 'Joseph', 'Maliza', 'Close Friend', 'yes'),
(2, 0, 0, 'Zoey', 'Miller', 'Friend', 'yes'),
(3, 0, 0, 'Tin', 'Ingles', 'Friend', 'yes'),
(4, 0, 0, 'Valerie', '', 'Close Friend', 'yes'),
(5, 0, 0, 'Neil', 'Avellana', 'Friend', 'yes'),
(6, 0, 0, 'scha', 'barqueros', 'Close Friend', 'yes'),
(7, 0, 0, 'axl', 'malabanan', 'Friend', 'yes'),
(8, 0, 0, 'luka', 'floren', 'Friend', 'yes'),
(9, 0, 0, 'waffle', 'nei', 'Close Friend', 'yes'),
(10, 0, 0, 'oreo', '', ' Friend', 'no'),
(11, 0, 0, 'albert ', '', ' Friend', 'no'),
(12, NULL, NULL, '', '', '', 'yes'),
(13, NULL, NULL, 'bea', 'miller', 'Close Friend', 'yes'),
(14, NULL, NULL, 'bea', 'miller', 'Close Friend', 'yes'),
(15, NULL, NULL, 'bea', 'miller', 'Close Friend', 'yes'),
(16, NULL, NULL, 'bea', 'miller', 'Close Friend', 'no'),
(17, NULL, NULL, 'bea', 'miller', 'Close Friend', 'yes'),
(18, NULL, NULL, 'bea', 'miller', 'Friend', 'no'),
(19, NULL, NULL, 'scha', 'f', 'Close Friend', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(11) NOT NULL,
  `dateTime` varchar(20) NOT NULL,
  `content` varchar(20) NOT NULL,
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friendID` int(11) NOT NULL,
  `requesterID` int(11) NOT NULL,
  `requesteeID` int(11) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gcmember`
--

CREATE TABLE `gcmember` (
  `gcMemberID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `gcID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groupchat`
--

CREATE TABLE `groupchat` (
  `groupChatID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `gcID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` varchar(20) NOT NULL,
  `dateTime` varchar(20) NOT NULL DEFAULT current_timestamp(),
  `privacy` varchar(20) NOT NULL,
  `isDeleted` varchar(20) NOT NULL,
  `attachment` varchar(20) NOT NULL,
  `cityID` int(11) NOT NULL,
  `provinceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `provinceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `postID` int(10) NOT NULL,
  `kind` varchar(10) NOT NULL,
  `commentID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `userInfoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `addressID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `messageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityID`);

--
-- Indexes for table `closefriends`
--
ALTER TABLE `closefriends`
  ADD PRIMARY KEY (`closeFriendID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friendID`);

--
-- Indexes for table `gcmember`
--
ALTER TABLE `gcmember`
  ADD PRIMARY KEY (`gcMemberID`);

--
-- Indexes for table `groupchat`
--
ALTER TABLE `groupchat`
  ADD PRIMARY KEY (`groupChatID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`provinceID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`userInfoID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `closefriends`
--
ALTER TABLE `closefriends`
  MODIFY `closeFriendID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friendID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gcmember`
--
ALTER TABLE `gcmember`
  MODIFY `gcMemberID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groupchat`
--
ALTER TABLE `groupchat`
  MODIFY `groupChatID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `provinceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `userInfoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
