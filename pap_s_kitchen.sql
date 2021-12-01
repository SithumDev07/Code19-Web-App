-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 10:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pap_s_kitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `name`, `photo`, `created_at`) VALUES
(7, 'SithumDev07', '$2y$10$381vGH6QeJJm6SmKrVwqaegK2V8zF1dLtN/.8y18X1ohatI.lueo.', 'Sithum Basnayake', '612ab1c826c941.41813831.png', '2021-08-26 01:27:14'),
(13, 'SithumAAA', '$2y$10$O2pWjDhJzg2eymxj5ViMueTvG1xHMlShq98SHv/m3qmSTbo.hXFFS', 'Random Wanderer', NULL, '2021-08-29 00:45:15'),
(14, 'burgerboi', '$2y$10$OG37lYqxf4VzPOEPnNOrMOii9qN.wdpf.OgHR23.280Bf2F93O18i', 'Sithum Burgers', NULL, '2021-11-26 07:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`customer_id`, `address`) VALUES
(7, 'No:5, School Lane, Gampaha'),
(14, 'Badulla');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

CREATE TABLE `customer_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `delivery_method` varchar(10) DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `special_notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`id`, `customer_id`, `date`, `time`, `status`, `delivery_method`, `total_amount`, `special_notes`) VALUES
(9, 7, '2021-05-28', '07:37', 'Processing', 'takeaway', '1200.00', NULL),
(10, 7, '2021-05-28', '07:37', 'active', 'takeaway', '1610.00', NULL),
(11, 7, '2021-06-28', '07:49', 'active', 'takeaway', '1860.00', NULL),
(12, 7, '2021-06-28', '07:49', 'active', 'takeaway', '1860.00', NULL),
(13, 7, '2021-06-28', '07:51', 'active', 'takeaway', '1860.00', NULL),
(14, 7, '2021-07-28', '07:51', 'active', 'takeaway', '1860.00', NULL),
(15, 7, '2021-08-28', '07:55', 'On Hold', 'takeaway', '1860.00', NULL),
(16, 7, '2021-08-28', '03:37', 'Cancelled', 'takeaway', '1710.00', 'Bad Weather'),
(20, 13, '2021-08-30', '06:16', 'Delivering', 'takeaway', '1170.00', NULL),
(21, 13, '2021-08-30', '03:26', 'Delivering', 'takeaway', '655.00', NULL),
(22, 13, '2021-08-30', '03:34', 'Delivering', 'takeaway', '655.00', NULL),
(23, 13, '2021-08-30', '12:30', 'Delivering', 'delivery', '635.00', NULL),
(24, 7, '2021-09-23', '07:01', 'Cancelled', 'takeaway', '375.00', 'Heavy Rain'),
(25, 14, '2021-11-29', '11:36', 'Delivering', 'delivery', '1390.00', NULL),
(26, 14, '2021-11-30', '04:31', 'Delivering', 'takeaway', '665.00', NULL),
(27, 14, '12/01/2021', '10:56', 'active', 'delivery', '475.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_phone`
--

CREATE TABLE `customer_phone` (
  `customer_id` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_phone`
--

INSERT INTO `customer_phone` (`customer_id`, `phone`) VALUES
(7, '0766108500'),
(14, '0785523652');

-- --------------------------------------------------------

--
-- Table structure for table `filling`
--

CREATE TABLE `filling` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filling`
--

INSERT INTO `filling` (`id`, `name`, `price`, `created_at`) VALUES
(1, 'Mirichi', '35.00', '2021-08-22 23:17:08'),
(2, 'BBQ Sauce Pack', '65.00', '2021-08-22 23:17:25'),
(3, 'Ookla Sauce', '55.00', '2021-08-23 02:21:03'),
(4, 'Dayya Sauce', '75.00', '2021-08-23 02:27:56'),
(5, 'BBQ Mongoose', '120.00', '2021-08-23 02:31:15'),
(6, 'Mozarella Chimps', '45.00', '2021-08-23 13:13:59'),
(7, 'Mageto Cream', '35.00', '2021-08-24 15:31:25'),
(8, 'Mochin Propala', '65.00', '2021-08-24 18:03:30'),
(9, 'Chimp Lasagnya', '75.00', '2021-08-24 23:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `filling_order`
--

CREATE TABLE `filling_order` (
  `order_id` int(11) NOT NULL,
  `filling_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filling_order`
--

INSERT INTO `filling_order` (`order_id`, `filling_id`, `quantity`) VALUES
(10, 1, 1),
(10, 2, 1),
(10, 8, 2),
(10, 9, 2),
(11, 1, 2),
(11, 2, 2),
(12, 1, 2),
(12, 2, 2),
(13, 1, 2),
(13, 2, 2),
(14, 1, 2),
(14, 2, 2),
(15, 1, 2),
(15, 2, 2),
(16, 1, 2),
(16, 2, 2),
(16, 6, 2),
(16, 7, 2),
(16, 9, 2),
(20, 1, 1),
(20, 2, 1),
(20, 3, 1),
(20, 4, 1),
(20, 5, 1),
(20, 6, 1),
(20, 7, 1),
(20, 8, 1),
(20, 9, 1),
(21, 3, 1),
(21, 5, 1),
(22, 3, 1),
(22, 5, 1),
(23, 3, 1),
(25, 3, 3),
(26, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `basic_price` decimal(10,2) NOT NULL,
  `prep_time` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `basic_price`, `prep_time`, `description`, `rating`, `photo`, `created_at`) VALUES
(1, 'Cheese Burger Haloween Special (XL)', '375.00', 16, 'Chor grilled chicken breast, melted cheddar, chicken boron, smashed avacado, salad and special peanuts.', 1.5, '61270424069603.52339847.png', '2021-08-22 01:36:02'),
(2, 'Gazoobo Submarine', '600.00', 13, 'Most iconic submarine you ever loved.', 4.8, '61270391a9dd09.97708788.png', '2021-08-22 13:22:27'),
(4, 'Maximus Cheesy Blaster Small', '480.00', 13, 'Maximus Cheesy Blaster Just Arrived', 3.5, '612685afb471c5.59557558.png', '2021-08-24 23:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `food_order`
--

CREATE TABLE `food_order` (
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_order`
--

INSERT INTO `food_order` (`order_id`, `food_id`, `quantity`) VALUES
(9, 2, 2),
(10, 1, 2),
(10, 4, 1),
(11, 2, 1),
(11, 4, 2),
(12, 2, 1),
(12, 4, 2),
(13, 2, 1),
(13, 4, 2),
(14, 2, 1),
(14, 4, 2),
(15, 2, 1),
(15, 4, 2),
(16, 2, 2),
(20, 2, 1),
(21, 4, 1),
(22, 4, 1),
(23, 4, 1),
(24, 1, 1),
(25, 1, 3),
(26, 2, 1),
(27, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `remaining_units` int(11) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`, `remaining_units`, `type`, `created_at`) VALUES
(1, 'All Purpose Flour', 23200, 'g', '2021-08-21 04:49:19'),
(2, 'Fresh Milk', 149867, 'ml', '2021-08-21 05:50:37'),
(12, 'Chilli Sauce', 0, 'pieces', '2021-08-21 23:03:10'),
(14, 'Sugar', 340, 'g', '2021-08-22 00:20:27'),
(15, 'Cheese', 9331, 'g', '2021-08-22 04:19:41'),
(17, 'Hellmanns Real Mayonnaise', 2750, 'ml', '2021-11-30 12:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_filling`
--

CREATE TABLE `ingredient_filling` (
  `ingredient_id` int(11) NOT NULL,
  `filling_id` int(11) NOT NULL,
  `no_of_units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient_filling`
--

INSERT INTO `ingredient_filling` (`ingredient_id`, `filling_id`, `no_of_units`) VALUES
(1, 6, 65),
(1, 9, 25),
(2, 3, 32),
(2, 5, 25),
(2, 7, 120),
(2, 8, 25),
(12, 1, 5),
(12, 2, 30),
(12, 4, 45),
(12, 9, 10),
(14, 1, 10),
(14, 2, 20),
(14, 3, 30),
(14, 4, 10),
(14, 5, 40),
(14, 7, 60),
(15, 3, 15),
(15, 5, 65),
(15, 6, 50),
(15, 8, 44),
(15, 9, 45);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_food`
--

CREATE TABLE `ingredient_food` (
  `ingredient_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `no_of_units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredient_food`
--

INSERT INTO `ingredient_food` (`ingredient_id`, `food_id`, `no_of_units`) VALUES
(1, 1, 200),
(1, 2, 200),
(1, 4, 200),
(2, 1, 50),
(2, 2, 60),
(2, 4, 35);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `card_number` varchar(12) NOT NULL,
  `card_type` varchar(30) NOT NULL,
  `name_upon_card` varchar(255) NOT NULL,
  `expire_date` varchar(5) NOT NULL,
  `cvc` int(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`id`, `customer_id`, `card_number`, `card_type`, `name_upon_card`, `expire_date`, `cvc`, `created_at`) VALUES
(2, 7, '343369851233', 'AMERICAN EXPRESS', 'DASHANTHA BAS', '24/03', 222, '2021-08-30 15:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `staff_member`
--

CREATE TABLE `staff_member` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `position` varchar(20) NOT NULL,
  `shift` varchar(5) NOT NULL,
  `personal_no` varchar(12) DEFAULT NULL,
  `LAN_no` varchar(10) DEFAULT NULL,
  `Salary` decimal(10,0) DEFAULT NULL,
  `paid` varchar(3) DEFAULT NULL,
  `pay_date` varchar(2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_member`
--

INSERT INTO `staff_member` (`id`, `user_name`, `name`, `password`, `email`, `address`, `DOB`, `position`, `shift`, `personal_no`, `LAN_no`, `Salary`, `paid`, `pay_date`, `photo`, `created_at`) VALUES
(5, 'SithumDev07', 'Sithum Basnayake', '$2y$10$iZEX8/6HhebpuHozU9onUerdnOPAIDgCf7Ni/e7R5LN2AoaLSCVFO', 'sithum@yahoo.com', 'Badulla Road, Bandarawela', '1994-06-22', 'Chef', 'Day', '94766108500', '9431225698', '76000', NULL, '18', '611ddc0ab7b373.73255449.jpeg', '2021-08-17 17:40:31'),
(6, 'sithumtech', 'Random Wanderer', '$2y$10$zINEDlPC4o0hdA5.miAVmuUqNQTTIJMLifI4W.SIrf4dI9SVc2KIu', 'sithum@gmail.com', 'Kolkata', '2005-08-18', 'Chef', 'Day', '94766108500', '9472659875', '131500', NULL, '30', '611c967ba72d52.50072731.jpg', '2021-08-18 05:11:23'),
(11, NULL, 'Umesh Heshan', NULL, 'umesh100@gmail.com', 'Piliyandala', '2002-07-17', 'Helper', 'Night', '0776332872', NULL, '45000', NULL, '19', '611df75286b9f1.58796697.jpg', '2021-08-19 06:16:50'),
(13, NULL, 'Chiran Jayith', NULL, 'chiran@gmail.com', 'Passara Road Kandy', '2002-10-25', 'Helper', 'Day', '0785678125', NULL, '35000', NULL, '30', '611e19ab4ff732.68589728.jpg', '2021-08-19 08:43:23'),
(15, 'Morichi', 'Morichi Django', '$2y$10$mG0lCqaM4dbhKezwUWxd0.ExImrl3GruiMAX2IeeWlnIluv/8zm4u', 'mori@django.com', 'Republic of Congo', '2002-07-17', 'Chef', 'Night', '94755698263', '9431222569', '78000', NULL, '28', '611e70191341c1.71835067.jpg', '2021-08-19 14:52:09'),
(17, NULL, 'Mayuko Inouie', NULL, 'mayuko@hotmail.com', 'Tokyo, Japan', '2005-08-09', 'Chef', 'Day', '0714569258', NULL, '180000', NULL, '22', '612051de8c1cd2.14950543.jpg', '2021-08-21 01:07:42'),
(18, NULL, 'Jhon Philips', NULL, NULL, 'Bangkok, Thailand', '2003-02-18', 'Helper', 'Night', '0704512369', NULL, '45000', NULL, '15', '612390089f71e2.62351617.jpg', '2021-08-23 12:09:44'),
(19, 'Naveen', 'Sithum Naveen', '$2y$10$PdK85WGKA130N2n6ML7CGu/w/Ta2HYKwRUpuvfOyx8JzUaiE.q4ym', 'na@gmail.com', 'Kel', '2005-11-29', 'Manager', 'Day', '94755555555', '9475820555', NULL, NULL, NULL, '61a46edbbfbf57.67088052.png', '2021-11-29 06:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `email`, `photo`, `created_at`) VALUES
(5, 'Highland Milk', 'Rolls Ground, Dalugama, Kelaniya', 'kelaniya@highlandmilk.com', '61203693391622.06189720.jpg', '2021-08-20 20:49:48'),
(11, 'Keels Super', 'Katugastota, Kandy', 'kelaniya@keels.com', '61208ed28404e3.84768050.jpg', '2021-08-21 05:27:46'),
(12, 'Vienna', 'NY, USA', 'vienna@koil.com', '612391dcc376f1.02744306.jpg', '2021-08-23 12:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_contact`
--

CREATE TABLE `supplier_contact` (
  `id` int(11) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_contact`
--

INSERT INTO `supplier_contact` (`id`, `contact_no`, `created_at`) VALUES
(5, '0312256988', '2021-08-21 05:24:38'),
(5, '0778406366', '2021-08-21 05:22:35'),
(11, '0714947910', '2021-08-21 05:27:46'),
(11, '0812236698', '2021-08-21 05:27:46'),
(12, '0552212458', '2021-08-23 12:18:02'),
(12, '0705645781', '2021-08-23 12:17:32');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_ingredient`
--

CREATE TABLE `supplier_ingredient` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `paid` varchar(3) NOT NULL,
  `quantity` int(11) NOT NULL,
  `MFD` varchar(10) NOT NULL,
  `EXP` varchar(10) NOT NULL,
  `purchase_date` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_ingredient`
--

INSERT INTO `supplier_ingredient` (`id`, `supplier_id`, `ingredient_id`, `cost`, `paid`, `quantity`, `MFD`, `EXP`, `purchase_date`, `created_at`) VALUES
(4, 11, 1, '60000.00', 'no', 15000, '2021-07-30', '2023-07-30', '2021-06-10', '2021-08-21 05:37:34'),
(5, 11, 1, '20000.00', 'no', 5000, '2021-08-03', '2023-08-03', '2021-08-21', '2021-08-21 05:49:30'),
(6, 5, 2, '10000.00', 'yes', 1500, '2021-07-30', '2023-07-30', '2021-04-07', '2021-08-21 05:51:19'),
(16, 5, 15, '45000.00', 'yes', 10000, '2021-08-03', '2021-10-19', '2021-08-22', '2021-08-22 04:19:41'),
(17, 12, 12, '5600.00', 'yes', 60, '2021-05-04', '2022-06-08', '2021-08-23', '2021-08-23 12:21:47'),
(19, 11, 17, '6000.00', 'yes', 2750, '2021-11-08', '2024-10-11', '2021-11-30', '2021-11-30 12:17:44'),
(20, 5, 2, '85000.00', 'yes', 150000, '2021-11-28', '2021-12-30', '2021-12-01', '2021-12-01 05:16:16'),
(21, 5, 15, '2500.00', 'yes', 9000, '2021-11-29', '2022-02-17', '2021-12-01', '2021-12-01 05:18:04'),
(22, 11, 1, '14000.00', 'yes', 20000, '2021-11-29', '2022-04-21', '2021-12-01', '2021-12-01 05:18:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`customer_id`,`address`);

--
-- Indexes for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CustomerID` (`customer_id`);

--
-- Indexes for table `customer_phone`
--
ALTER TABLE `customer_phone`
  ADD PRIMARY KEY (`customer_id`,`phone`);

--
-- Indexes for table `filling`
--
ALTER TABLE `filling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filling_order`
--
ALTER TABLE `filling_order`
  ADD PRIMARY KEY (`order_id`,`filling_id`),
  ADD KEY `FillingIdOrder` (`filling_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_order`
--
ALTER TABLE `food_order`
  ADD PRIMARY KEY (`order_id`,`food_id`),
  ADD KEY `FoodIdOrder` (`food_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredient_filling`
--
ALTER TABLE `ingredient_filling`
  ADD PRIMARY KEY (`ingredient_id`,`filling_id`),
  ADD KEY `FillingIdIngredient` (`filling_id`);

--
-- Indexes for table `ingredient_food`
--
ALTER TABLE `ingredient_food`
  ADD PRIMARY KEY (`ingredient_id`,`food_id`),
  ADD KEY `FoodIdIngredient` (`food_id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`id`,`customer_id`);

--
-- Indexes for table `staff_member`
--
ALTER TABLE `staff_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  ADD PRIMARY KEY (`id`,`contact_no`);

--
-- Indexes for table `supplier_ingredient`
--
ALTER TABLE `supplier_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `customer_order`
--
ALTER TABLE `customer_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `filling`
--
ALTER TABLE `filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_member`
--
ALTER TABLE `staff_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `supplier_ingredient`
--
ALTER TABLE `supplier_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `CustomerIDAddress` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `customer_order`
--
ALTER TABLE `customer_order`
  ADD CONSTRAINT `CustomerID` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `customer_phone`
--
ALTER TABLE `customer_phone`
  ADD CONSTRAINT `CustomerIDPhone` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `filling_order`
--
ALTER TABLE `filling_order`
  ADD CONSTRAINT `FillingIdOrder` FOREIGN KEY (`filling_id`) REFERENCES `filling` (`id`),
  ADD CONSTRAINT `OrderIdFilling` FOREIGN KEY (`order_id`) REFERENCES `customer_order` (`id`);

--
-- Constraints for table `food_order`
--
ALTER TABLE `food_order`
  ADD CONSTRAINT `FoodIdOrder` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`),
  ADD CONSTRAINT `OrderIdFood` FOREIGN KEY (`order_id`) REFERENCES `customer_order` (`id`);

--
-- Constraints for table `ingredient_filling`
--
ALTER TABLE `ingredient_filling`
  ADD CONSTRAINT `FillingIdIngredient` FOREIGN KEY (`filling_id`) REFERENCES `filling` (`id`),
  ADD CONSTRAINT `IngredientIdFilling` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Constraints for table `ingredient_food`
--
ALTER TABLE `ingredient_food`
  ADD CONSTRAINT `FoodIdIngredient` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`),
  ADD CONSTRAINT `IngredientIdFood` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Constraints for table `supplier_contact`
--
ALTER TABLE `supplier_contact`
  ADD CONSTRAINT `SupplierContactKey` FOREIGN KEY (`id`) REFERENCES `supplier` (`id`);

--
-- Constraints for table `supplier_ingredient`
--
ALTER TABLE `supplier_ingredient`
  ADD CONSTRAINT `IngredientKey` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`),
  ADD CONSTRAINT `SupplierIngredientKey` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
