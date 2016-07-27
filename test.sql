-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 27, 2016 at 03:43 PM
-- Server version: 5.5.49-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_attending_record`
--

CREATE TABLE `class_attending_record` (
  `Class` text NOT NULL,
  `Account` text NOT NULL,
  `ClassNum` int(11) NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_attending_record`
--

INSERT INTO `class_attending_record` (`Class`, `Account`, `ClassNum`, `Time`) VALUES
('1606北大入門T\r\n', 'rogerfederer', 1, '2016-07-02 20:00:00'),
('1606北大初中R', 'novakdjokovic', 1, '2016-06-30 19:00:00'),
('1606北大入門T', 'rogerfederer', 2, '2016-07-09 20:00:00'),
('1606北大入門T', 'rogerfederer', 3, '2016-07-16 20:00:00'),
('1606北大初中R', 'novakdjokovic', 3, '2016-07-14 19:00:00'),
('1606北大初中R', 'novakdjokovic', 4, '2016-07-21 19:00:00'),
('1606北大初中R', 'wiserkuo@gmail.com', 1, '2016-06-30 19:00:00'),
('1606北大初中R', 'wiserkuo@gmail.com', 4, '2016-07-21 19:00:00'),
('1606北大初中R', 'wiserkuo@gmail.com', 3, '2016-07-14 19:00:00'),
('1606北大初中R', 'wiserkuo@gmail.com', 2, '2016-07-07 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `class_message`
--

CREATE TABLE `class_message` (
  `Class` text NOT NULL,
  `Account` text NOT NULL,
  `ClassNum` int(11) NOT NULL,
  `Message` text,
  `Suggest` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_message`
--

INSERT INTO `class_message` (`Class`, `Account`, `ClassNum`, `Message`, `Suggest`) VALUES
('1606北大初中R', 'wiserkuo@gmail.com', 3, 'Murray說做20\n3下就累了\n從球側邊挖一圈 像月亮一樣的軌跡 咬不到球的感覺 可能要多點推\n回球減慢球速 往兩側帶開角度', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_registered_list`
--

CREATE TABLE `class_registered_list` (
  `Class` text NOT NULL,
  `Account` text NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_registered_list`
--

INSERT INTO `class_registered_list` (`Class`, `Account`, `Status`) VALUES
('1606北大初中R', 'novakdjokovic', 1),
('1606北大入門T', 'rogerfederer', 1),
('1606北大入門T', 'rafanadal', 1),
('1606北大初中R', 'wiserkuo@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_teaching_material`
--

CREATE TABLE `class_teaching_material` (
  `Class` text NOT NULL,
  `Material` text NOT NULL,
  `Number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_teaching_material`
--

INSERT INTO `class_teaching_material` (`Class`, `Material`, `Number`) VALUES
('1606北大初中R', '坐姿擊球 重心壓低', 1),
('1606北大入門T', '折返跑1000趟', 1),
('1606北大初中R', '發球1000顆練習', 2),
('1606北大初中R', '8字繞錐  發球外旋', 3),
('1606北大初中R', '殺球1000顆練習', 4),
('1606北大初中R', '從林教練手上拿到一局', 5),
('1606北大入門T', '青蛙跳1000次', 2),
('1606北大入門T', '空揮1000次', 3),
('1606北大入門T', '仰臥起坐1000次', 4),
('1606北大入門T', '從張教練手上拿到1分', 5);

-- --------------------------------------------------------

--
-- Table structure for table `coach_list`
--

CREATE TABLE `coach_list` (
  `Account` text NOT NULL,
  `Name` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coach_list`
--

INSERT INTO `coach_list` (`Account`, `Name`, `Password`) VALUES
('ricklin@gmail.com', '林忠儀', '0987654321'),
('davidchang@gmail.com', '張志孝', '777777777');

-- --------------------------------------------------------

--
-- Table structure for table `current_class_list`
--

CREATE TABLE `current_class_list` (
  `Class` text NOT NULL,
  `Coach` text NOT NULL,
  `Level` text NOT NULL,
  `Court` text NOT NULL,
  `Time` text NOT NULL,
  `StartDate` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `current_class_list`
--

INSERT INTO `current_class_list` (`Class`, `Coach`, `Level`, `Court`, `Time`, `StartDate`) VALUES
('1606北大初中R', '林忠儀', '中級', '台北民生分校網球場', '06/30 起 每週四\r\n19:00~21:00', '6/30'),
('1606北大入門T', '張志孝', '入門', '台北民生分校網球場', '07/02 起 每週六\r\n20:00~22:00', '7/02');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `Account` text NOT NULL,
  `Password` text NOT NULL,
  `Name` text NOT NULL,
  `Level` float NOT NULL DEFAULT '1',
  `Region` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`Account`, `Password`, `Name`, `Level`, `Region`) VALUES
('novakdjokovic', 'isbetterthananyone', 'Novak Djokovic', 1, '台北市'),
('rafanadal', 'kingofclay', 'Rafa Nadal', 0, ''),
('rogerfederer', 'isthegreatest', 'Roger Federer', 0, ''),
('wiserkuo@gmail.com', 'EAAMficDJXaYBAMWZBm8UXaZA9pVLiBeYLZCNTlEOKo5iN013p6y3lfg6HYNC4DxrPaqTa2iW8MpBTVgsV6vAkF1BmAtzF4JDHB7pugYLtkbOfcZAOE1NTivbbcH12lMj7OZAoceiHVCGNYwKArhJUK0jx5ONA8cIZD', 'Wiser Wei-Che Kuo', 4.5, '三重區');

-- --------------------------------------------------------

--
-- Table structure for table `tennis`
--

CREATE TABLE `tennis` (
  `class` text NOT NULL,
  `court` text NOT NULL,
  `area` text NOT NULL,
  `coach` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tennis`
--

INSERT INTO `tennis` (`class`, `court`, `area`, `coach`) VALUES
('1604北大初級Z', '台北民生分校網球場', '台北市區', '林忠儀'),
('1604北大初級M', '台北民生分校網球場', '台北市區', '吳俊寬'),
('1604實踐初級B', '大直實踐分校網球場', '台北市區', '蕭安廷'),
('1604天母入門S', '天母分校網球場', '台北市區', '李宗凱'),
('1604板橋入門O', '板橋民生分校網球場', '台北市區', '張志孝'),
('1604大里入門B', '台中大里公五網球場', '大台中區', '李冠賢');

-- --------------------------------------------------------

--
-- Table structure for table `test_table`
--

CREATE TABLE `test_table` (
  `name` text NOT NULL,
  `age` int(11) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_table`
--

INSERT INTO `test_table` (`name`, `age`, `salary`) VALUES
('John', 20, 10000),
('Mary', 30, 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`Account`(50));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
