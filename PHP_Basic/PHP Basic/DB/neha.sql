-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 04, 2020 at 05:30 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neha`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `alb_name` varchar(300) NOT NULL,
  `alb_desc` varchar(300) NOT NULL,
  `alb_pic` varchar(300) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `alb_name`, `alb_desc`, `alb_pic`, `user_id`) VALUES
(199, '  gdgdf', 'fdgdg', 'pos.jpg', 95),
(200, '   new', 'new album', 'hardwood.jpg', 95),
(211, 'neha', 'hfghfhg', 'admin.jpeg', 95),
(212, 'new', 'new album', 'admin.jpeg', 95),
(213, '  test', 'testing', 'laminate.jpg', 95),
(214, 'GHGF', 'HFGHFG', 'IMG-20181104-WA0001.jpg', 95),
(215, 'test', 'test', 'briyani.jpg', 95),
(216, 'testtest', 'gfdhgfjhgjhjhjhj', 'cakes.png', 95);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `con_name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `con_name`) VALUES
(1, 'India'),
(2, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gal_name` varchar(300) NOT NULL,
  `gal_desc` varchar(300) NOT NULL,
  `alb_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gal_name`, `gal_desc`, `alb_id`) VALUES
(167, 'kjhkgj', 'kjkgjkj', 199),
(168, 'bffg', 'fdgfdgf', 199),
(169, 'hjhjhj', 'hjhjhj', 199),
(198, 'kjkj', 'kjjj', 199),
(199, 'kjjj', '', 199),
(200, 'testing', '', 199),
(201, 'this  is my gallery', '', 199),
(202, 'AMAN GALLARY', '', 199),
(203, 'MY GALLARY', '', 211),
(204, 'hfghfhg', '', 211),
(205, 'ghgfhgjhgjghj', '', 216);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `img` varchar(300) NOT NULL,
  `gal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `img`, `gal_id`) VALUES
(461, 'pos.jpg', 168),
(462, 'linoleum.jpg', 168),
(463, 'gal5.jpg', 168),
(464, 'gal4.jpg', 168),
(466, 'welding.jpg', 169),
(467, 'gal6.jpg', 169),
(468, 'gal5.jpg', 169),
(469, 'gal4.jpg', 169),
(470, 'gal3.jpg', 169),
(471, 'gal2.jpg', 169),
(520, 'welding.jpg', 198),
(521, 'gal6.jpg', 198),
(522, 'gal5.jpg', 198),
(523, 'gal4.jpg', 198),
(524, 'welding.jpg', 199),
(525, 'gal6.jpg', 199),
(526, 'gal5.jpg', 199),
(527, 'gal4.jpg', 199),
(528, 'admin.jpeg', 200),
(529, 'carpet', 201),
(530, 'gal2.jpg', 201),
(531, 'gal3.jpg', 201),
(532, 'gal4.jpg', 201),
(533, 'gal5.jpg', 201),
(534, 'gal6.jpg', 201),
(535, 'hardwood.jpg', 201),
(536, 'Hardwood Floor Repair and Refinish.jpg', 201),
(537, 'laminate.jpg', 201),
(538, 'linoleum.jpg', 201),
(539, 'LVT (VINYL PLANK).jpg', 201),
(540, 'pos.jpg', 201),
(541, 'stock-photo-large-bathroom-with-tiles-and-window-nobody-inside-1178610079.jpg', 201),
(542, 'vct tiles.jpg', 201),
(543, 'IMG-20181104-WA0001.jpg', 202),
(544, 'IMG-20181104-WA0001.jpg', 203),
(545, 'ChickenKormaimg2.jpg', 204),
(546, 'ChickenKormaimg2 (1).jpg', 204),
(547, 'bannerimage.png', 205),
(548, 'banner-top.jpg', 205),
(549, 'bread.jpg', 205),
(550, 'briyani (1).jpg', 205),
(551, 'Buehner-Gourmet-Creations.webm', 205);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state_name` varchar(300) NOT NULL,
  `con_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`, `con_id`) VALUES
(1, 'Himachal pardesh', 1),
(2, 'delhi', 1),
(3, 'Chandigarh', 1),
(4, 'Washington', 2),
(5, 'Texas', 2),
(6, 'Louisiana', 2);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `value`) VALUES
(1, 'having'),
(2, 'a having a');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `hob` varchar(100) NOT NULL,
  `gen` varchar(100) NOT NULL,
  `img` varchar(500) NOT NULL,
  `user_type` varchar(300) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `pass`, `hob`, `gen`, `img`, `user_type`, `state_id`) VALUES
(95, 'neha', 'kumari', 'neha@gmail.com', '3fede54cd3cf786471ca20e4d40d9b8c', 'Dancing,Traveling', 'Female', 'IMG-20181104-WA0001.jpg', 'user', 1),
(96, 'testhfggh', 'test', 'tes@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'Dancing', 'Female', 'admin.jpeg', '', 4),
(97, 'admin', 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'Dancing', 'Male', 'admin.jpeg', 'admin', 2),
(98, 'TESTytyt', 'TESThytyty', 'TEST@GMAIL.COM', 'cc03e747a6afbbcbf8be7668acfebee5', 'Traveling', 'Male', 'admin.jpeg', 'user', 2),
(99, 'fgf', 'gfghfgh', 'hhhh@gmail.com', 'bd63e3e1e52833ca0450d44a0890dc46', 'Painting', 'Female', 'admin.jpeg', 'user', 5),
(100, 'hello', 'gfghfgh', 'hhh@gmail.com', 'bd63e3e1e52833ca0450d44a0890dc46', 'Traveling,Painting', 'Female', 'admin.jpeg', 'user', 6),
(101, 'damini', 'thakur', 'damini@gmail.com', 'a01673815951c320a4f3a85e99ad2157', 'Traveling,Painting', 'Female', 'linoleum.jpg', 'user', 2),
(102, 'neelam', 'sharma', 'neel@gmail.com', 'fd786a107e05f72c0fb8c3540bca4d40', 'Traveling', 'Female', 'carpet', 'user', 4),
(103, 'dinesh', 'thakur', 'din@gmail.com', '536464c6582fd9f32ce8ee25ccb973a6', 'Dancing,Traveling', 'Male', 'floor repair.jpg', 'user', 5),
(104, 'sahil', 'sir', 'sahil@gmail.com', 'bf4c0cdcde9fb35d3733a680cd50230f', 'Painting', 'Male', 'admin.jpeg', 'user', 6),
(105, 'monika', 'mahajan', 'moni@gmail.com', 'd3c849e5a3506313f8c071aa785c87fe', 'Dancing,Traveling', 'Female', 'stock-photo-large-bathroom-with-tiles-and-window-nobody-inside-1178610079.jpg', 'user', 5),
(106, 'razia', 'begum', 'raziz@gmail.com', '65ca27770cedc0adc95d9a48020b9f93', 'Dancing,Reading ', 'Female', 'linoleum.jpg', 'user', 2),
(107, 'gourav', 'devan', 'dev@gmail.com', '227edf7c86c02a44d17eec9aa5b30cd1', 'Dancing,Reading ', 'Male', 'no.jpeg', 'user', 1),
(108, 'webethics', 'ethics', 'web@gmail.com', 'b8b41c35259f3482a433eb5b5dcaafb0', 'Dancing', 'Male', 'admin.jpeg', 'user', 1),
(109, 'mouni', 'verma', 'mouni@gmail.com', 'd3c849e5a3506313f8c071aa785c87fe', 'Dancing,Traveling,Painting,Reading ', 'Female', 'LVT (VINYL PLANK).jpg', 'user', 3),
(110, 'nitish', 'kumar', 'miti@gmail.com', '01c2981206eb62012ac3e2099510aa72', 'Dancing,Traveling,Painting', 'Female', 'admin.jpeg', 'user', 2),
(111, 'rajesh', 'chauhan', 'raj@gmail.com', 'cac5ff630494aa784ce97b9fafac2500', 'Dancing,Traveling', 'Male', 'admin.jpeg', 'user', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `al_fk` (`user_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gal_ky` (`alb_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `img_ky` (`gal_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cn` (`con_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ur` (`state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `al_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `gal_ky` FOREIGN KEY (`alb_id`) REFERENCES `album` (`id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `img_ky` FOREIGN KEY (`gal_id`) REFERENCES `gallery` (`id`);

--
-- Constraints for table `state`
--
ALTER TABLE `state`
  ADD CONSTRAINT `fk_cn` FOREIGN KEY (`con_id`) REFERENCES `country` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_ur` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
