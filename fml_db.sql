-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 18, 2024 at 05:11 PM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `FML_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `email` varchar(255) NOT NULL,
  `expertise` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`email`, `expertise`, `company`) VALUES
('b@g.com', 'Investment', 'Microsoft'),
('e@m.com', 'Investment', 'SpaceX'),
('mk12@gmail.com', 'Mortgage', 'ATB'),
('t123@gmail.com', 'Insurance', 'RBC');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `aid` int(11) NOT NULL,
  `advEmail` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`aid`, `advEmail`, `userEmail`, `date`, `time`) VALUES
(1, 'mk12@gmail.com', 'test123@gmail.com', '2024-02-18', '16:00:00.527000'),
(3, 't123@gmail.com', 'test123@gmail.com', '2024-02-18', '23:00:21.627000'),
(4, 'mk12@gmail.com', 'test123@gmail.com', '2024-02-19', '22:19:06.000000'),
(5, 'mk12@gmail.com', 'test123@gmail.com', '2024-02-19', '15:30:00.000000'),
(6, 'b@g.com', 'pg@1.com', '2024-02-20', '00:23:00.000000'),
(7, 'b@g.com', 'pg@1.com', '2024-02-19', '09:30:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `advEmail` varchar(255) NOT NULL,
  `dateA` date NOT NULL,
  `timeA` time(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`advEmail`, `dateA`, `timeA`) VALUES
('b@g.com', '2024-02-19', '09:30:00.0000'),
('b@g.com', '2024-02-20', '00:23:00.0000'),
('mk12@gmail.com', '2024-02-19', '15:30:00.0000'),
('mk12@gmail.com', '2024-02-20', '12:30:00.0000');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `name` varchar(255) NOT NULL,
  `adv_email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`name`, `adv_email`, `type`) VALUES
('Insurance 101', 't123@gmail.com', 'Insurance'),
('Microsoft Secrets', 'b@g.com', 'Investment'),
('Mortgages 101', 'mk12@gmail.com', 'Mortgage'),
('Mortgages 102', 'mk12@gmail.com', 'Mortgage');

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `gid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `setDate` date NOT NULL,
  `deadlineDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `email` varchar(255) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Person`
--

INSERT INTO `Person` (`email`, `Fname`, `LastName`, `password`, `type`, `phone`) VALUES
('b@g.com', 'Bill', 'Gates', '123', 'advisor', 123),
('e@m.com', 'Elon', '', '11', 'advisor', 122333),
('jr@1.com', 'Jack', 'Ryan', '123', 'user', 1234455678),
('mk12@gmail.com', 'Saad', 'A', '123', 'advisor', 1232342334),
('pg@1.com', 'peter', 'g', 'qwe', 'user', 123555),
('t123@gmail.com', 'Test', 'Advisor', '123', 'advisor', 1234445478),
('test123@gmail.com', 'Test', 'Person', '123', 'user', 403123333);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` int(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tid`, `email`, `type`, `value`, `month`, `date`) VALUES
(1, 'test123@gmail.com', 'Food', 20, 'February', '2024-02-21'),
(2, 'test123@gmail.com', 'Bills', 500, 'February', '2024-02-23'),
(3, 'test123@gmail.com', 'Subscriptions', 250, 'February', '2024-02-18'),
(4, 'test123@gmail.com', 'Food', 1000, 'January', '2024-01-19'),
(5, 'pg@1.com', 'Subscriptions', 55, 'February', '2024-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(255) NOT NULL,
  `income` int(255) NOT NULL,
  `courseName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `income`, `courseName`) VALUES
('jr@1.com', 1, 'Microsoft Secrets'),
('pg@1.com', 123, 'Microsoft Secrets'),
('test123@gmail.com', 50000, 'Microsoft Secrets');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `fa1` (`advEmail`),
  ADD KEY `fa2` (`userEmail`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`advEmail`,`dateA`,`timeA`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`name`),
  ADD KEY `fc` (`adv_email`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`gid`),
  ADD KEY `fg` (`email`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `ft` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advisor`
--
ALTER TABLE `advisor`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`email`) REFERENCES `Person` (`email`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fa1` FOREIGN KEY (`advEmail`) REFERENCES `advisor` (`email`),
  ADD CONSTRAINT `fa2` FOREIGN KEY (`userEmail`) REFERENCES `user` (`email`);

--
-- Constraints for table `availability`
--
ALTER TABLE `availability`
  ADD CONSTRAINT `fa` FOREIGN KEY (`advEmail`) REFERENCES `advisor` (`email`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fc` FOREIGN KEY (`adv_email`) REFERENCES `advisor` (`email`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `fg` FOREIGN KEY (`email`) REFERENCES `user` (`email`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `ft` FOREIGN KEY (`email`) REFERENCES `user` (`email`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `ff` FOREIGN KEY (`email`) REFERENCES `Person` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
