-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 02:51 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uoh`
--

-- --------------------------------------------------------

--
-- Table structure for table `19mcme25`
--

CREATE TABLE `19mcme25` (
  `BOOK_TITLE` varchar(100) DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `19mcme25`
--

INSERT INTO `19mcme25` (`BOOK_TITLE`, `ISSUE_DATE`) VALUES
('Berlin Alexanderplatz', '2021-11-27'),
('Dead Souls', '2021-11-27'),
('Fairy tales', '2021-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `19mcme26`
--

CREATE TABLE `19mcme26` (
  `BOOK_TITLE` varchar(100) DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `19mcme26`
--

INSERT INTO `19mcme26` (`BOOK_TITLE`, `ISSUE_DATE`) VALUES
('Berlin Alexanderplatz', '2021-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `berlin alexanderplatz`
--

CREATE TABLE `berlin alexanderplatz` (
  `STUDENT_ID` varchar(15) DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `berlin alexanderplatz`
--

INSERT INTO `berlin alexanderplatz` (`STUDENT_ID`, `ISSUE_DATE`) VALUES
('19mcme26', '2021-11-27'),
('19mcme25', '2021-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `AUTHOR` varchar(100) DEFAULT NULL,
  `COUNTRY` varchar(50) DEFAULT NULL,
  `LANGUAGE` varchar(50) DEFAULT NULL,
  `PAGES` int(11) DEFAULT NULL,
  `TITLE` varchar(100) NOT NULL,
  `YEAR` int(11) DEFAULT NULL,
  `COPIES` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`AUTHOR`, `COUNTRY`, `LANGUAGE`, `PAGES`, `TITLE`, `YEAR`, `COPIES`) VALUES
('Alfred Doblin', 'Germany', 'German', 600, 'Berlin Alexanderplatz', 1929, 3),
('Nikolai Gogol', 'Russia', 'Russian', 432, 'Dead Souls', 1842, 4),
('Hans Christian Andersen', 'Denmark', 'Danish', 784, 'Fairy tales', 1837, 4),
('Charles Dickens', 'United Kingdom', 'English', 194, 'Great Expectations', 1861, 5),
('Ralph Ellison', 'United States', 'English', 581, 'Invisible Man', 1952, 5),
('Louis-Ferdinand Celine', 'France', 'French', 505, 'Journey to the End of the Night', 1932, 5),
('Honore de Balzac', 'France', 'French', 443, 'Le Pere Goriot', 1835, 5),
('Joseph Conrad', 'United Kingdom', 'English', 320, 'Nostromo', 1904, 5),
('Jane Austen', 'United Kingdom', 'English', 226, 'Pride and Prejudice', 1813, 5),
('Anton Chekhov', 'Russia', 'Russian', 194, 'Stories', 1886, 5),
('Geoffrey Chaucer', 'England', 'English', 544, 'The Canterbury Tales', 1450, 5),
('Giovanni Boccaccio', 'Italy', 'Italian', 1024, 'The Decameron', 1351, 5),
('Dante Alighieri', 'Italy', 'Italian', 928, 'The Divine Comedy', 1315, 5),
('Fyodor Dostoevsky', 'Russia', 'Russian', 656, 'The Idiot', 1869, 5),
('Albert Camus', 'Algeria', 'French', 185, 'The Stranger', 1942, 5);

-- --------------------------------------------------------

--
-- Table structure for table `dead souls`
--

CREATE TABLE `dead souls` (
  `STUDENT_ID` varchar(15) DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dead souls`
--

INSERT INTO `dead souls` (`STUDENT_ID`, `ISSUE_DATE`) VALUES
('19mcme25', '2021-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `fairy tales`
--

CREATE TABLE `fairy tales` (
  `STUDENT_ID` varchar(15) DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fairy tales`
--

INSERT INTO `fairy tales` (`STUDENT_ID`, `ISSUE_DATE`) VALUES
('19mcme25', '2021-11-27');

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `NAME` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`NAME`) VALUES
('MH-A'),
('MH-B'),
('MH-C');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_students`
--

CREATE TABLE `hostel_students` (
  `ID` varchar(15) NOT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `DATE_ALLOTED` date DEFAULT NULL,
  `HOSTEL` varchar(15) DEFAULT NULL,
  `ROOM` int(11) DEFAULT NULL,
  `PASSWORD` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostel_students`
--

INSERT INTO `hostel_students` (`ID`, `NAME`, `DATE_ALLOTED`, `HOSTEL`, `ROOM`, `PASSWORD`) VALUES
('19mcme25', 'Sagar', '2021-12-02', 'MH-B', 1, 'b4078c14fbcb7b3ef69a5f915a753d5b'),
('admin', NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `invisible man`
--

CREATE TABLE `invisible man` (
  `STUDENT_ID` varchar(15) DEFAULT NULL,
  `ISSUE_DATE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mh-a`
--

CREATE TABLE `mh-a` (
  `ROOM_NUMBER` int(11) NOT NULL,
  `ALLOCATED_TO` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mh-b`
--

CREATE TABLE `mh-b` (
  `ROOM_NUMBER` int(11) NOT NULL,
  `ALLOCATED_TO` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mh-b`
--

INSERT INTO `mh-b` (`ROOM_NUMBER`, `ALLOCATED_TO`) VALUES
(2, NULL),
(1, '19mcme25');

-- --------------------------------------------------------

--
-- Table structure for table `mh-c`
--

CREATE TABLE `mh-c` (
  `ROOM_NUMBER` int(11) NOT NULL,
  `ALLOCATED_TO` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` varchar(15) NOT NULL,
  `PASSWORD` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `PASSWORD`) VALUES
('19mcme25', 'b4078c14fbcb7b3ef69a5f915a753d5b'),
('19mcme26', 'b4078c14fbcb7b3ef69a5f915a753d5b'),
('admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `TITLE` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(200) DEFAULT NULL,
  `COURSE_CODE` varchar(15) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`TITLE`, `DESCRIPTION`, `COURSE_CODE`, `URL`) VALUES
('lecture 1.1', 'Intro to English Part.', 'IMTech', 'https://www.youtube.com/embed/trPcv6BnH0I'),
('lecture 1.2', 'Intro to English Vocabulary', 'IMTech', 'https://www.youtube.com/embed/3Cj4aMVqtrE');

-- --------------------------------------------------------

--
-- Table structure for table `video_classes`
--

CREATE TABLE `video_classes` (
  `ID` varchar(15) NOT NULL,
  `PASSWORD` varchar(40) DEFAULT NULL,
  `PROGRAM_CODE` varchar(15) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_classes`
--

INSERT INTO `video_classes` (`ID`, `PASSWORD`, `PROGRAM_CODE`, `NAME`) VALUES
('19mcme25', 'b4078c14fbcb7b3ef69a5f915a753d5b', 'IMTech', 'Sagar'),
('admin', '210cf7aa5e2682c9c9d4511f88fe2789', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `19mcme25`
--
ALTER TABLE `19mcme25`
  ADD UNIQUE KEY `BOOK_TITLE` (`BOOK_TITLE`);

--
-- Indexes for table `19mcme26`
--
ALTER TABLE `19mcme26`
  ADD UNIQUE KEY `BOOK_TITLE` (`BOOK_TITLE`);

--
-- Indexes for table `berlin alexanderplatz`
--
ALTER TABLE `berlin alexanderplatz`
  ADD UNIQUE KEY `STUDENT_ID` (`STUDENT_ID`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`TITLE`);

--
-- Indexes for table `dead souls`
--
ALTER TABLE `dead souls`
  ADD UNIQUE KEY `STUDENT_ID` (`STUDENT_ID`);

--
-- Indexes for table `fairy tales`
--
ALTER TABLE `fairy tales`
  ADD UNIQUE KEY `STUDENT_ID` (`STUDENT_ID`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`NAME`);

--
-- Indexes for table `hostel_students`
--
ALTER TABLE `hostel_students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `invisible man`
--
ALTER TABLE `invisible man`
  ADD UNIQUE KEY `STUDENT_ID` (`STUDENT_ID`);

--
-- Indexes for table `mh-a`
--
ALTER TABLE `mh-a`
  ADD PRIMARY KEY (`ROOM_NUMBER`),
  ADD KEY `ALLOCATED_TO` (`ALLOCATED_TO`);

--
-- Indexes for table `mh-b`
--
ALTER TABLE `mh-b`
  ADD PRIMARY KEY (`ROOM_NUMBER`),
  ADD KEY `ALLOCATED_TO` (`ALLOCATED_TO`);

--
-- Indexes for table `mh-c`
--
ALTER TABLE `mh-c`
  ADD PRIMARY KEY (`ROOM_NUMBER`),
  ADD KEY `ALLOCATED_TO` (`ALLOCATED_TO`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`TITLE`);

--
-- Indexes for table `video_classes`
--
ALTER TABLE `video_classes`
  ADD PRIMARY KEY (`ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `19mcme25`
--
ALTER TABLE `19mcme25`
  ADD CONSTRAINT `19mcme25_ibfk_1` FOREIGN KEY (`BOOK_TITLE`) REFERENCES `books` (`TITLE`);

--
-- Constraints for table `19mcme26`
--
ALTER TABLE `19mcme26`
  ADD CONSTRAINT `19mcme26_ibfk_1` FOREIGN KEY (`BOOK_TITLE`) REFERENCES `books` (`TITLE`);

--
-- Constraints for table `berlin alexanderplatz`
--
ALTER TABLE `berlin alexanderplatz`
  ADD CONSTRAINT `berlin alexanderplatz_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `students` (`ID`);

--
-- Constraints for table `dead souls`
--
ALTER TABLE `dead souls`
  ADD CONSTRAINT `dead souls_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `students` (`ID`);

--
-- Constraints for table `fairy tales`
--
ALTER TABLE `fairy tales`
  ADD CONSTRAINT `fairy tales_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `students` (`ID`);

--
-- Constraints for table `invisible man`
--
ALTER TABLE `invisible man`
  ADD CONSTRAINT `invisible man_ibfk_1` FOREIGN KEY (`STUDENT_ID`) REFERENCES `students` (`ID`);

--
-- Constraints for table `mh-a`
--
ALTER TABLE `mh-a`
  ADD CONSTRAINT `mh-a_ibfk_1` FOREIGN KEY (`ALLOCATED_TO`) REFERENCES `hostel_students` (`ID`);

--
-- Constraints for table `mh-b`
--
ALTER TABLE `mh-b`
  ADD CONSTRAINT `mh-b_ibfk_1` FOREIGN KEY (`ALLOCATED_TO`) REFERENCES `hostel_students` (`ID`);

--
-- Constraints for table `mh-c`
--
ALTER TABLE `mh-c`
  ADD CONSTRAINT `mh-c_ibfk_1` FOREIGN KEY (`ALLOCATED_TO`) REFERENCES `hostel_students` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
