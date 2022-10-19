-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 20, 2021 at 07:12 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpproject01`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `BookId` int(200) NOT NULL AUTO_INCREMENT,
  `Naslov` varchar(100) NOT NULL,
  `Avtor` varchar(100) NOT NULL,
  `Zalozba` varchar(100) NOT NULL,
  `ISBN` bigint(255) NOT NULL,
  `Lastnik` int(11) DEFAULT NULL,
  PRIMARY KEY (`BookId`),
  KEY `UsersId` (`Lastnik`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookId`, `Naslov`, `Avtor`, `Zalozba`, `ISBN`, `Lastnik`) VALUES
(1, 'The way of kings', 'Brandon Sanderson', 'Tor Books', 9780765376671, 10),
(2, 'Mistborn', 'Brandon Sanderson', 'Tor Books', 9780765377135, 5),
(3, 'Silmarillion', 'Tolkien', 'HarperCollins Publishers', 9780007523221, 4),
(4, 'Oathbringer', 'Brandon Sanderson', 'Tor Books', 9780765326379, 2),
(5, 'Words of radiance', 'Brandon Sanderson', 'Tor Books', 123123, 2),
(6, 'rhythm of war', 'Brandon Sanderson', 'Tor Books', 123523324, 10),
(7, 'Lord of the rings', 'Tolkien', 'Tolkien estate', 123123, 3),
(8, 'Assassin\'s apprentice', 'Robin Hobb', 'Imaginary Books', 31231, 6),
(11, 'Bible', 'Many People', 'If_Only_I_Knew', 1, 10),
(17, 'Prince of Thorns', 'Mark Lawrence', 'Tor Books', 234234, 10),
(16, 'Holy Sister', 'Mark Lawrence', 'Tor Books', 234234, 10),
(15, 'Grey Sister', 'Mark Lawrence', 'Tor Books', 234234, 10),
(18, 'Red Sister', 'Mark Lawrence', 'Ace Books', 9780008152291, 11),
(20, 'test', 'test', 'test', 123, NULL),
(21, 'The Name of the Wind', 'Patrick Rothfuss', 'DAW', 9780756413712, 10),
(22, 'The Wise Man\'s Fear', 'Patrick Rothfuss', 'Victor Gollancz', 9780575081413, 10),
(23, 'Harry Potter', 'Rowling', 'LBLBLB', 12312312, 15),
(24, 'testz', 'asd', 'asdas', 123123, 10),
(25, 'dfsd', 'sdasd', 'wqdqwd', 123123, 14),
(27, 'Bible', 'asdasd', 'gdsg', 213123123, 17),
(28, 'harry potter and the philosopher\'s stone', 'J.K.Rowling', 'Bloomsbury Publishing PLC', 9781408855652, 9),
(29, 'Harry Potter and the Prisoner of Azkaban', 'J. K. Rowling', 'Bloomsbury Publishing PLC', 9781408845660, 9),
(30, 'Harry Potter and the Half-Blood Prince ', 'J.K.Rowling', 'Bloomsbury Publishing PLC', 9781408855706, 9),
(31, 'Grey Sister', 'Mark Lawrence', 'Bloomsbury Publishing PLC', 124312412421421, 18);

-- --------------------------------------------------------

--
-- Table structure for table `izposoje`
--

DROP TABLE IF EXISTS `izposoje`;
CREATE TABLE IF NOT EXISTS `izposoje` (
  `Id` int(100) NOT NULL AUTO_INCREMENT,
  `BookId` int(11) NOT NULL,
  `UsersId` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `BookId` (`BookId`),
  KEY `UsersId` (`UsersId`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

--
-- 
--



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersId` int(11) NOT NULL AUTO_INCREMENT,
  `usersName` varchar(128) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersUid` varchar(128) NOT NULL,
  `usersPwd` varchar(128) NOT NULL,
  PRIMARY KEY (`usersId`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersId`, `usersName`, `usersEmail`, `usersUid`, `usersPwd`) VALUES
(2, 'nana', 'nn@gmail.com', 'nana', '$2y$10$vglQCI0TA5ZU6C7rUpYkiOMdLp3ksVxozjVN3HQ24rze170fmuNBW'),
(3, 'ziva', 'frog@gmail.com', 'zivexx', '$2y$10$wqGjb1RXe7Ak9.tXj1B2j.qSTOJ/Tgbh85RbteE74OAVlhDaAhpcu'),
(4, 'darkokun', 'dardanini@gmail.com', 'darkokun', '$2y$10$OVlHsGOmQjaWT.5oD7BjOeV13CDEB/I2pE5DrY6sWxn6EWRyOrdt.'),
(5, 'Fitz', 'nighteyes@gmail.com', 'Boy', '$2y$10$nz.ZRiBLlaJy6..NMmVUV.KDxshoL25IzeO76Tp5315MZb7LMVH4C'),
(6, 'marko', 'mk@gmail.com', 'marko', '$2y$10$S23eBYUFqIxj.uvyiMY0Su3U2gkAYfgU5.16U1Dh9fxQ0QhtiBTrm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
