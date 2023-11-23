-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2023 at 12:22 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mockup`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `Book_ID` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `AuthorName` varchar(255) NOT NULL,
  `Genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`Book_ID`, `ISBN`, `Name`, `AuthorName`, `Genre`) VALUES
(1, '9780132350884', 'Clean Code', 'Robert C. Martin', 'Software Development'),
(2, '9781449331818', 'Eloquent JavaScript', 'Marijn Haverbeke', 'Programming'),
(3, '9781593275846', 'Automate the Boring Stuff with Python', 'Al Sweigart', 'Programming'),
(4, '9780135957059', 'Designing Data-Intensive Applications', 'Martin Kleppman', 'Database Systems'),
(5, '9780321125217', 'The Pragmatic Programmer', 'Andrew Hunt, David Thomas', 'Software Development'),
(6, '9780596007126', 'Head First Design Patterns', 'Eric Freeman, Elisabeth Robson', 'Software Design'),
(7, '9780201616224', 'Refactoring', 'Martin Fowler', 'Software Development'),
(8, '9780596000400', 'Programming Pearls', 'Jon Bentley', 'Programming'),
(9, '9780465097609', 'The Mythical Man-Month', 'Frederick P. Brooks Jr.', 'Software Engineering'),
(10, '9780321856715', 'Introduction to the Theory of Computation', 'Michael Sipser', 'Computer Science'),
(11, '9780061120084', 'To Kill a Mockingbird', 'Harper Lee', 'Fiction'),
(12, '9781400032716', 'The Catcher in the Rye', 'J.D. Salinger', 'Fiction'),
(13, '9780140283334', '1984', 'George Orwell', 'Fiction'),
(14, '9780062315007', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Fiction'),
(15, '9780544003415', 'The Hobbit', 'J.R.R. Tolkien', 'Fantasy'),
(16, '9999999999999', 'Mein Kampf', 'Adolf Hitler', 'Autobiography'),
(17, '9999999999999', 'Little Red Book', 'Mao Zedong', 'Propaganda'),
(18, '9999999999999', 'Little Red Book', 'Mao Zedong', 'Propaganda'),
(19, '9999999999999', 'Stalin\'s', 'Stalin', 'Autobiography'),
(20, '9999999999999', 'Death', 'Death', 'Autobiography');

-- --------------------------------------------------------

--
-- Table structure for table `bookreservation`
--

CREATE TABLE `bookreservation` (
  `R_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `B_ID` int(11) NOT NULL,
  `BorrowDate` datetime NOT NULL,
  `ReturnDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `libtable`
--

CREATE TABLE `libtable` (
  `TableNo` int(11) NOT NULL,
  `NoPeople` int(11) NOT NULL,
  `Location` varchar(20) NOT NULL,
  `BookedFlag` tinyint(1) NOT NULL,
  `Availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `libtable`
--

INSERT INTO `libtable` (`TableNo`, `NoPeople`, `Location`, `BookedFlag`, `Availability`) VALUES
(1, 4, 'Area A', 0, 1),
(2, 2, 'Area B', 0, 1),
(3, 6, 'Area C', 0, 1),
(4, 3, 'Area D', 0, 1),
(5, 5, 'Area E', 0, 1),
(6, 4, 'Area F', 0, 1),
(7, 2, 'Area G', 0, 1),
(8, 6, 'Area H', 0, 1),
(9, 3, 'Area I', 0, 1),
(10, 5, 'Area J', 0, 1),
(11, 4, 'Area K', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Login_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Member_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tablereservation`
--

CREATE TABLE `tablereservation` (
  `R_ID` int(11) NOT NULL,
  `U_ID` int(11) NOT NULL,
  `TableNo` int(11) NOT NULL,
  `ReservationDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_ID` int(11) NOT NULL,
  `User_FName` varchar(50) NOT NULL,
  `User_LName` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `User_DOB` date NOT NULL,
  `User_Blacklist` tinyint(1) NOT NULL,
  `Member_Flag` tinyint(1) NOT NULL,
  `Member_Type` int(11) DEFAULT NULL,
  `Member_Faculty` varchar(20) DEFAULT NULL,
  `Member_Year` year(4) DEFAULT NULL,
  `General_Flag` tinyint(1) NOT NULL,
  `Admin_Flag` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_ID`);

--
-- Indexes for table `bookreservation`
--
ALTER TABLE `bookreservation`
  ADD PRIMARY KEY (`R_ID`),
  ADD KEY `U_ID` (`U_ID`),
  ADD KEY `ISBN` (`B_ID`);

--
-- Indexes for table `libtable`
--
ALTER TABLE `libtable`
  ADD PRIMARY KEY (`TableNo`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Login_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_ID`),
  ADD KEY `U_ID` (`U_ID`);

--
-- Indexes for table `tablereservation`
--
ALTER TABLE `tablereservation`
  ADD PRIMARY KEY (`R_ID`),
  ADD KEY `U_ID` (`U_ID`),
  ADD KEY `TableNo` (`TableNo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_ID`),
  ADD KEY `Username` (`Username`),
  ADD KEY `Student_Faculty` (`Member_Faculty`),
  ADD KEY `Member_Type` (`Member_Type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `Book_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bookreservation`
--
ALTER TABLE `bookreservation`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `libtable`
--
ALTER TABLE `libtable`
  MODIFY `TableNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `Login_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Member_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tablereservation`
--
ALTER TABLE `tablereservation`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookreservation`
--
ALTER TABLE `bookreservation`
  ADD CONSTRAINT `bookreservation_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookreservation_ibfk_2` FOREIGN KEY (`B_ID`) REFERENCES `book` (`Book_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tablereservation`
--
ALTER TABLE `tablereservation`
  ADD CONSTRAINT `tablereservation_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tablereservation_ibfk_2` FOREIGN KEY (`TableNo`) REFERENCES `libtable` (`TableNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
