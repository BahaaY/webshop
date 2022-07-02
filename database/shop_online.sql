-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220503.92457c1607
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 04:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `ID` int(255) NOT NULL,
  `user_id` int(15) NOT NULL,
  `product_id` int(15) NOT NULL,
  `product` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `ID` int(11) NOT NULL,
  `id_product` int(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `product` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`ID`, `id_product`, `img`, `product`) VALUES
(728, 98, 'home_furniture-1656087470_98.jpg', 'product_laptop_tablet_computer'),
(741, 80, 'background_image-1656250007_80.jpg', 'product_land'),
(742, 80, 'background_image_main-1656250007_80.jpg', 'product_land'),
(743, 80, 'background_image_main_2-1656250007_80.jpg', 'product_land'),
(744, 100, 'home_furniture-1656250323_100.jpg', 'product_laptop_tablet_computer');

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`ID`, `name`, `type`) VALUES
(1, 'BMW', 'car'),
(2, 'Mercedes', 'car'),
(3, 'Honda', 'car'),
(4, 'Toyota', 'car'),
(7, 'Audi', 'car'),
(8, 'Renault', 'car'),
(9, 'Lexus', 'car'),
(10, 'Jaguar', 'car'),
(11, 'Chevrolet', 'car'),
(12, 'Aston Martin', 'car'),
(13, 'Mini', 'car'),
(14, 'Jeep', 'car'),
(15, 'Land Rover', 'car'),
(16, 'Maserati', 'car'),
(17, 'Infiniti', 'car'),
(18, 'Mazda', 'car'),
(19, 'Lamborghini', 'car'),
(20, 'Bentley', 'car'),
(21, 'Volkswagen', 'car'),
(22, 'Porsche', 'car'),
(23, 'Mitsubishi', 'car');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `make` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`ID`, `name`, `make`) VALUES
(1, 'X1', 'BMW'),
(2, 'X2', 'BMW'),
(3, 'X3', 'BMW'),
(4, 'X4', 'BMW'),
(5, 'X5', 'BMW'),
(6, 'X6', 'BMW'),
(7, '1 Series', 'BMW'),
(8, '2 Series', 'BMW'),
(9, '3 Series', 'BMW'),
(10, '4 Series', 'BMW'),
(11, '5 Series', 'BMW'),
(12, '6 Series', 'BMW'),
(13, '7 Series', 'BMW'),
(14, '8 Series', 'BMW'),
(15, 'M2', 'BMW'),
(16, 'M3', 'BMW'),
(17, 'M4', 'BMW'),
(18, 'M5', 'BMW'),
(21, 'M6', 'BMW'),
(22, 'GLE-Class', 'Mercedes'),
(23, 'GLC-Class', 'Mercedes'),
(24, 'GLS-Class', 'Mercedes'),
(25, 'CLA-Class', 'Mercedes'),
(26, 'CLK-Class', 'Mercedes'),
(27, 'CLS-Class', 'Mercedes'),
(28, 'GLB-Class', 'Mercedes'),
(29, 'A-Class', 'Mercedes'),
(30, 'B-Class', 'Mercedes'),
(31, 'Sl-Class', 'Mercedes'),
(32, 'SlC-Class', 'Mercedes'),
(33, 'C-Class', 'Mercedes'),
(34, 'SLS AMG', 'Mercedes'),
(35, 'E-Class', 'Mercedes'),
(36, 'G-Class', 'Mercedes'),
(37, 'R-Class', 'Mercedes'),
(38, 'S-Class', 'Mercedes'),
(39, '200 Series', 'Mercedes'),
(40, 'AMG GT', 'Mercedes'),
(41, 'GLC Coupe', 'Mercedes'),
(42, 'GLE Coupe', 'Mercedes'),
(43, 'Fit', 'Honda'),
(44, 'City', 'Honda'),
(45, 'Civic', 'Honda'),
(46, 'CR-V', 'Honda'),
(47, 'Accord', 'Honda'),
(48, 'Amaze', 'Honda'),
(49, 'WR-V', 'Honda'),
(50, 'HR-V', 'Honda'),
(51, 'Civic type R', 'Honda'),
(52, 'BR-V', 'Honda'),
(53, 'Brio', 'Honda'),
(54, 'Mobilio', 'Honda'),
(55, 'Accord Hybrid', 'Honda'),
(56, 'Pilot', 'Honda'),
(57, 'Freed', 'Honda'),
(58, 'Avancier', 'Honda'),
(59, 'Camry', 'Toyota'),
(60, 'Rav4', 'Toyota'),
(61, 'Prius', 'Toyota'),
(62, 'Fortuner', 'Toyota'),
(63, 'Corolla', 'Toyota'),
(64, 'Supra', 'Toyota'),
(65, 'C-HR', 'Toyota'),
(66, 'Hilux', 'Toyota'),
(67, 'Yaris', 'Toyota'),
(68, 'Cross', 'Toyota'),
(69, 'Land Cruiser', 'Toyota'),
(70, 'Avalon', 'Toyota'),
(71, 'Tacoma', 'Toyota'),
(72, 'Tundra', 'Toyota'),
(73, 'A1', 'Audi'),
(74, 'A2', 'Audi'),
(75, 'A3', 'Audi'),
(76, 'A4', 'Audi'),
(77, 'A5', 'Audi'),
(78, 'A6', 'Audi'),
(79, 'A7', 'Audi'),
(80, 'A8', 'Audi'),
(81, 'Q2', 'Audi'),
(82, 'Q3', 'Audi'),
(83, 'Q5', 'Audi'),
(84, 'Q7', 'Audi'),
(85, 'Q8', 'Audi'),
(86, 'R8', 'Audi'),
(87, 'R8 42', 'Audi'),
(88, 'R8 4S', 'Audi'),
(89, 'R8 GT', 'Audi'),
(90, 'RS 4', 'Audi'),
(91, 'RS 4 B7', 'Audi'),
(92, 'RS 6', 'Audi'),
(93, 'RS 5', 'Audi'),
(94, 'S1', 'Audi'),
(95, 'S2', 'Audi'),
(96, 'S3', 'Audi'),
(97, 'S4', 'Audi'),
(98, 'S5', 'Audi'),
(99, 'S6', 'Audi'),
(100, 'S7', 'Audi'),
(101, 'S8', 'Audi'),
(102, 'TT', 'Audi'),
(103, '5', 'Renault'),
(104, '9', 'Renault'),
(105, '11', 'Renault'),
(106, '12', 'Renault'),
(107, '12', 'Renault'),
(108, '18', 'Renault'),
(109, '19', 'Renault'),
(110, 'Alaskan', 'Renault'),
(111, 'Arkana', 'Renault'),
(112, 'Captur', 'Renault'),
(113, 'Clio', 'Renault'),
(114, 'Dacia', 'Renault'),
(115, 'Dokker', 'Renault'),
(116, 'Duster', 'Renault'),
(117, 'Kadjar', 'Renault'),
(118, 'Kangoo', 'Renault'),
(119, 'Laguna', 'Renault'),
(120, 'Master', 'Renault'),
(121, 'Megane', 'Renault'),
(122, 'Optima', 'Renault'),
(123, 'Rapid', 'Renault'),
(124, 'Safrane', 'Renault'),
(125, 'Scenic', 'Renault'),
(126, 'Symbol', 'Renault'),
(127, 'CT 200h', 'Lexus'),
(128, 'ES-Series', 'Lexus'),
(129, 'GS F', 'Lexus'),
(130, 'GS-Series', 'Lexus'),
(131, 'GS-Series', 'Lexus'),
(132, 'HS 250h', 'Lexus'),
(133, 'IS-Series', 'Lexus'),
(134, 'LC 500', 'Lexus'),
(135, 'LS-Series', 'Lexus'),
(136, 'RC 200t', 'Lexus'),
(137, 'RC 300', 'Lexus'),
(138, 'RC 350', 'Lexus'),
(139, 'RC F', 'Lexus'),
(140, 'UX 200', 'Lexus'),
(141, 'E-Pace', 'Jaguar'),
(142, 'F-Pace', 'Jaguar'),
(143, 'F-Type', 'Jaguar'),
(144, 'I-Type', 'Jaguar'),
(146, 'I-Pace', 'Jaguar'),
(147, 'S-Type', 'Jaguar'),
(148, 'Super v8', 'Jaguar'),
(149, 'Vanden Plas', 'Jaguar'),
(150, 'X-Type', 'Jaguar'),
(151, 'XE', 'Jaguar'),
(152, 'XJ', 'Jaguar'),
(153, 'XJ6', 'Jaguar'),
(154, 'XJS', 'Jaguar'),
(155, 'Astro', 'Chevrolet'),
(156, 'Avalanche', 'Chevrolet'),
(157, 'Aveo', 'Chevrolet'),
(158, 'Beat', 'Chevrolet'),
(160, 'Blazer', 'Chevrolet'),
(161, 'Bolt', 'Chevrolet'),
(162, 'Blazer', 'Chevrolet'),
(163, 'Camaro', 'Chevrolet'),
(164, 'Caprice', 'Chevrolet'),
(165, 'Captiva', 'Chevrolet'),
(166, 'Cavalier', 'Chevrolet'),
(167, 'Cabalt', 'Chevrolet'),
(168, 'Corvette', 'Chevrolet'),
(169, 'Cruze', 'Chevrolet'),
(170, 'Epica', 'Chevrolet'),
(171, 'Cherokee', 'Jeep'),
(172, 'Cammander', 'Jeep'),
(173, 'Compass', 'Jeep'),
(174, 'Grand cherokee', 'Jeep'),
(176, 'Liberty', 'Jeep'),
(177, 'New compass', 'Jeep'),
(178, 'Patriot', 'Jeep'),
(179, 'Renegade', 'Jeep'),
(180, 'Wrangler', 'Jeep'),
(181, 'Defender', 'Land Rover'),
(182, 'Discovery', 'Land Rover'),
(183, 'Evoque', 'Land Rover'),
(184, 'Freelander', 'Land Rover'),
(185, 'LR2', 'Land Rover'),
(186, 'LR3', 'Land Rover'),
(187, 'LR4', 'Land Rover'),
(188, 'Range rover', 'Land Rover'),
(189, 'Velar', 'Land Rover'),
(190, 'Vogue', 'Land Rover'),
(191, 'Coupe', 'Maserati'),
(192, 'Ghibli', 'Maserati'),
(193, 'GranCabrio', 'Maserati'),
(194, 'Levante', 'Maserati'),
(195, 'Spider', 'Maserati'),
(196, 'Quattroporte', 'Maserati'),
(197, 'EX', 'Infiniti'),
(198, 'FX-Series', 'Infiniti'),
(199, 'G-Series', 'Infiniti'),
(200, 'I-Series', 'Infiniti'),
(201, 'J30', 'Infiniti'),
(202, 'JX-Series', 'Infiniti'),
(203, 'M-Series', 'Infiniti'),
(204, 'Q-Series', 'Infiniti'),
(205, 'QX-Series', 'Infiniti'),
(206, '2', 'Mazda'),
(207, '3', 'Mazda'),
(208, '6', 'Mazda'),
(209, '121', 'Mazda'),
(210, '323', 'Mazda'),
(211, '626', 'Mazda'),
(212, '929', 'Mazda'),
(213, 'B2200', 'Mazda'),
(214, 'B2300', 'Mazda'),
(215, 'B2600', 'Mazda'),
(216, 'B3000', 'Mazda'),
(217, 'B4000', 'Mazda'),
(218, 'CX-3', 'Mazda'),
(219, 'CX-30', 'Mazda'),
(220, 'CX-5', 'Mazda'),
(221, 'CX-7', 'Mazda'),
(222, 'CX-9', 'Mazda'),
(223, 'Navajo', 'Mazda'),
(224, 'Protege', 'Mazda'),
(225, 'RX-7', 'Mazda'),
(226, 'RX-8', 'Mazda'),
(227, 'Tribute', 'Mazda'),
(228, 'MX-6', 'Mazda'),
(229, 'MX-5', 'Mazda'),
(230, 'Aventador', 'Lamborghini'),
(231, 'Gallardo', 'Lamborghini'),
(232, 'Huracan', 'Lamborghini'),
(233, 'Urus', 'Lamborghini'),
(234, 'Murcielago', 'Lamborghini'),
(235, 'Arnage', 'Bentley'),
(236, 'Azure', 'Bentley'),
(237, 'Bentayga', 'Bentley'),
(238, 'Brooklands', 'Bentley'),
(239, 'Continental', 'Bentley'),
(240, 'Eight', 'Bentley'),
(241, 'Mulsanne', 'Bentley'),
(242, 'RT turbo R', 'Bentley'),
(243, 'Turbo R', 'Bentley'),
(244, 'Arteone', 'Volkswagen'),
(245, 'Atlas', 'Volkswagen'),
(246, 'Beetle', 'Volkswagen'),
(247, 'Cabrio', 'Volkswagen'),
(248, 'Caddy', 'Volkswagen'),
(249, 'Caravelle', 'Volkswagen'),
(250, 'CC', 'Volkswagen'),
(251, 'Carrado', 'Volkswagen'),
(252, 'Eurovan', 'Volkswagen'),
(253, 'Fox', 'Volkswagen'),
(254, 'Gold', 'Volkswagen'),
(255, 'GTI', 'Volkswagen'),
(256, 'Jetta', 'Volkswagen'),
(257, 'Passat', 'Volkswagen'),
(258, 'Polo', 'Volkswagen'),
(259, '718 Boxster', 'Porsche'),
(260, '718 Cayman', 'Porsche'),
(261, '718 Spyder', 'Porsche'),
(262, '911', 'Porsche'),
(263, '918 Spyder', 'Porsche'),
(264, '928', 'Porsche'),
(265, '968', 'Porsche'),
(266, 'Carrera GT', 'Porsche'),
(267, 'Cayenne', 'Porsche'),
(268, 'Cayman', 'Porsche'),
(269, 'Macan', 'Porsche'),
(270, 'Panamera', 'Porsche'),
(271, 'Taycan', 'Porsche'),
(272, 'Colt', 'Mitsubishi'),
(273, 'Diamonte', 'Mitsubishi'),
(274, 'Eclipse', 'Mitsubishi'),
(275, 'Endeavor', 'Mitsubishi'),
(276, 'Evolution', 'Mitsubishi'),
(277, 'Galant', 'Mitsubishi'),
(278, 'Grandis', 'Mitsubishi'),
(279, 'L200', 'Mitsubishi'),
(280, 'Lancer', 'Mitsubishi'),
(281, 'Magna', 'Mitsubishi'),
(282, 'Mirage', 'Mitsubishi'),
(283, 'Montero', 'Mitsubishi'),
(284, 'Nativa', 'Mitsubishi'),
(285, 'Pajero', 'Mitsubishi'),
(286, 'Cygnet', 'Aston Martin'),
(287, 'DB AR1', 'Aston Martin'),
(288, 'DB11', 'Aston Martin'),
(289, 'DB2', 'Aston Martin'),
(290, 'DB4', 'Aston Martin'),
(291, 'DB5', 'Aston Martin'),
(292, 'DB6', 'Aston Martin'),
(293, 'DB7', 'Aston Martin'),
(294, 'DB9', 'Aston Martin'),
(295, 'DBS', 'Aston Martin'),
(296, 'DBX', 'Aston Martin'),
(297, 'One-77', 'Aston Martin'),
(298, 'Rapide', 'Aston Martin'),
(299, 'V8', 'Aston Martin'),
(300, 'V12', 'Aston Martin'),
(301, 'Vanquish', 'Aston Martin'),
(302, 'Vantage', 'Aston Martin'),
(303, 'Virage', 'Aston Martin'),
(304, 'Vulcan', 'Aston Martin'),
(305, 'Clubman', 'Mini'),
(306, 'Cooper', 'Mini'),
(307, 'Cooper S', 'Mini'),
(308, 'Coupe', 'Mini'),
(309, 'E Countryman', 'Mini'),
(310, 'Countryman', 'Mini'),
(311, 'Paceman', 'Mini'),
(312, 'SE Countryman', 'Mini'),
(313, 'SE Hardster', 'Mini'),
(314, 'Se Hardtop', 'Mini');

-- --------------------------------------------------------

--
-- Table structure for table `product_apartment`
--

CREATE TABLE `product_apartment` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `price_lb` int(20) NOT NULL,
  `price_usd` int(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `bedroom_nb` varchar(30) NOT NULL,
  `bethroom_nb` varchar(30) NOT NULL,
  `floor_nb` varchar(30) NOT NULL,
  `cond` varchar(50) NOT NULL,
  `size` int(6) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_electronic_home`
--

CREATE TABLE `product_electronic_home` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `price_lb` int(20) NOT NULL,
  `price_usd` int(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `cond` varchar(30) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_home_furniture`
--

CREATE TABLE `product_home_furniture` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `price_lb` int(20) NOT NULL,
  `price_usd` int(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `cond` varchar(30) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_land`
--

CREATE TABLE `product_land` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `price_lb` int(20) NOT NULL,
  `price_usd` int(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(30) NOT NULL,
  `size` int(6) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_land`
--

INSERT INTO `product_land` (`ID`, `unique_id`, `price_lb`, `price_usd`, `title`, `description`, `type`, `size`, `location`) VALUES
(80, 1215009111, 72000000, 72000000, 'Big land', 'nice', 'Industrial', 200, 'Bourjein, El choud, Lebanon');

-- --------------------------------------------------------

--
-- Table structure for table `product_laptop_tablet_computer`
--

CREATE TABLE `product_laptop_tablet_computer` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `price_lb` int(20) NOT NULL,
  `price_usd` int(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(50) NOT NULL,
  `cond` varchar(30) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_laptop_tablet_computer`
--

INSERT INTO `product_laptop_tablet_computer` (`ID`, `unique_id`, `price_lb`, `price_usd`, `title`, `description`, `type`, `cond`, `location`) VALUES
(98, 1215009111, 72000000, 3000, 'Bmw M3', 'full option', 'Razer', 'New', 'Bourjein, El choud, Lebanon'),
(100, 1215009111, 72000000, 3000, 'Bmw M3', 'full option', 'Samsung', 'New', 'Bourjein, El choud, Lebanon');

-- --------------------------------------------------------

--
-- Table structure for table `product_vehicle_motorcycle`
--

CREATE TABLE `product_vehicle_motorcycle` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `price_lb` varchar(20) NOT NULL,
  `price_usd` varchar(20) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `make` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `cond` varchar(30) NOT NULL,
  `year` int(4) NOT NULL,
  `kilometere` varchar(30) NOT NULL,
  `trans` varchar(20) NOT NULL,
  `color` varchar(50) NOT NULL,
  `body` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(8) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `verify_code` varchar(255) NOT NULL,
  `verify` int(1) NOT NULL DEFAULT 0,
  `blocked` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `unique_id`, `first_name`, `last_name`, `username`, `email`, `password`, `phone`, `birthdate`, `gender`, `verify_code`, `verify`, `blocked`) VALUES
(39, 274895780, 'Bahaa', 'Yassine', 'bahaa_y', 'bahaayassin92@gmail.com', '$2y$10$xJScNVG8kOu9jzI3hMNUpessbrdnfimLaBvxShWNG3fD21rDH8eWu', 71683784, '2001-07-10', 'Male', '452d62e06924aced229bd4334c50c5c9', 1, 0),
(41, 1215009111, 'Bahaa', 'Yassine', 'bahaa_yy', 'bahaayassine3@gmail.com', '$2y$10$blY9/iG2iBDEyBigN0wY9u5kGnCgSYerhLMvQf7kg5jdj7WJKd4Z2', 71683783, '2002-07-10', 'Male', '12c0b27e7b45f1b05638eb602a1721d1', 1, 0),
(44, 1927846109, 'Unknown', 'Unknown', 'Unknown', 'admin@gmail.com', '$2y$10$vMfAArh/SbI0Wc1xWVK.juL1G4.A9CfBYFLVlSdDsdvfD7Vq38pi2', 0, '0000-00-00', 'Unknown', '0', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_apartment`
--
ALTER TABLE `product_apartment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_electronic_home`
--
ALTER TABLE `product_electronic_home`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_home_furniture`
--
ALTER TABLE `product_home_furniture`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_land`
--
ALTER TABLE `product_land`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_laptop_tablet_computer`
--
ALTER TABLE `product_laptop_tablet_computer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_vehicle_motorcycle`
--
ALTER TABLE `product_vehicle_motorcycle`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=745;

--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `product_apartment`
--
ALTER TABLE `product_apartment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_electronic_home`
--
ALTER TABLE `product_electronic_home`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_home_furniture`
--
ALTER TABLE `product_home_furniture`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_land`
--
ALTER TABLE `product_land`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `product_laptop_tablet_computer`
--
ALTER TABLE `product_laptop_tablet_computer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product_vehicle_motorcycle`
--
ALTER TABLE `product_vehicle_motorcycle`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



