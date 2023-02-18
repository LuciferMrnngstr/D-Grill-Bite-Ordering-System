-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2023 at 10:59 AM
-- Server version: 10.5.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u524944378_meraki`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_on`
--

CREATE TABLE `add_on` (
  `add_on_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `add_on_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_on`
--

INSERT INTO `add_on` (`add_on_id`, `food_id`, `add_on_name`) VALUES
(1, 2, 'With Boiled Egg'),
(2, 2, 'Without Boiled Egg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_num` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `contact_num`) VALUES
(1, 'admin@gmail.com', 'adminnnn', 'Mary Jane', 'P.', 'Dagohoy', '09123456789');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `food_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `food_product_id`, `quantity`, `sub_total`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 5, 125, '2023-02-17 07:28:03', '2023-02-17 07:28:03'),
(7, 1, 2, 2, 50, '2023-02-17 07:28:44', '2023-02-17 07:28:44'),
(8, NULL, 1, 1, 20, '2023-02-17 07:55:14', '2023-02-17 07:55:14'),
(9, NULL, 2, 1, 25, '2023-02-17 08:36:06', '2023-02-17 08:36:06'),
(10, 19, 2, 1, 25, '2023-02-17 08:43:07', '2023-02-17 08:43:07'),
(11, 19, 1, 1, 20, '2023-02-17 08:43:33', '2023-02-17 08:43:33'),
(12, NULL, 2, 1, 25, '2023-02-17 08:44:40', '2023-02-17 08:44:40'),
(13, NULL, 2, 1, 25, '2023-02-18 09:18:26', '2023-02-18 09:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `cust_type` varchar(15) NOT NULL,
  `department` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `contact_no`, `cust_type`, `department`, `created_at`) VALUES
(1, 'customer1@wmsu.edu.ph', 'customerr', 'Ahmad Rhidzkhan', 'Ahmad', 'Daud', '09972517522', 'Student', 'CCS', '2023-02-01 23:12:54'),
(2, 'customer2@wmsu.edu.ph', 'customerr', 'Faseeh', 'Rojas', 'Lines', '09123456789', 'Student', 'CSM', '2023-02-01 23:12:54'),
(19, 'customer5@wmsu.edu.ph', 'customerr', 'kurapika', NULL, 'zoldics', '09123456789', 'Student', 'CCS', '2023-02-17 08:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `food_product`
--

CREATE TABLE `food_product` (
  `food_product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` mediumtext NOT NULL,
  `img` varchar(100) NOT NULL,
  `rates` float NOT NULL,
  `likes` int(11) NOT NULL,
  `sold` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_product`
--

INSERT INTO `food_product` (`food_product_id`, `name`, `price`, `description`, `img`, `rates`, `likes`, `sold`, `created_at`, `updated_at`) VALUES
(1, 'Tortang Talong', '20.00', 'Fried eggplant coated with egg.', 'tortang-talong', 8.2, 56, 28, '2023-01-30 03:05:08', '2023-01-30 03:05:08'),
(2, 'Adobong Atay', '25.00', 'Chicken liver adobo with hot boiled egg', 'adobong-atay', 9.2, 78, 38, '2023-01-30 03:05:08', '2023-01-30 03:05:08'),
(3, 'Adobong Atay', '25.00', 'Chicken liver adobo with hot boiled egg', 'adobong-atay', 9.2, 78, 38, '2023-01-30 03:05:08', '2023-01-30 03:05:08'),
(4, 'Tortang Talong', '20.00', 'Fried eggplant coated with egg.', 'tortang-talong', 8.2, 56, 28, '2023-01-30 03:05:08', '2023-01-30 03:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `for_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cart_id`, `total_price`, `for_date`, `created_at`, `updated_at`) VALUES
(45, 6, 125, '2023-02-17 07:28:10', '2023-02-17 07:28:10', '2023-02-17 07:28:10'),
(46, 6, 125, '2023-02-17 07:28:48', '2023-02-17 07:28:48', '2023-02-17 07:28:48'),
(47, 7, 175, '2023-02-17 07:28:48', '2023-02-17 07:28:48', '2023-02-17 07:28:48'),
(48, 8, 20, '2023-02-17 07:56:07', '2023-02-17 07:56:07', '2023-02-17 07:56:07'),
(49, 8, 20, '2023-02-17 07:56:10', '2023-02-17 07:56:10', '2023-02-17 07:56:10'),
(50, 8, 20, '2023-02-17 08:35:28', '2023-02-17 08:35:28', '2023-02-17 08:35:28'),
(51, 8, 20, '2023-02-17 08:45:17', '2023-02-17 08:45:17', '2023-02-17 08:45:17'),
(52, 9, 45, '2023-02-17 08:45:17', '2023-02-17 08:45:17', '2023-02-17 08:45:17'),
(53, 12, 70, '2023-02-17 08:45:17', '2023-02-17 08:45:17', '2023-02-17 08:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_num` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `contact_num`, `created_at`, `updated_at`) VALUES
(1, 'vendor1@gmail.com', 'vendorrr', 'Faseeh', 'Q.', 'Aukasa', '09123456789', '2023-02-16 11:24:17', '2023-02-16 11:24:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_on`
--
ALTER TABLE `add_on`
  ADD PRIMARY KEY (`add_on_id`),
  ADD KEY `food_id` (`food_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `food_product_id` (`food_product_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `food_product`
--
ALTER TABLE `food_product`
  ADD PRIMARY KEY (`food_product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_on`
--
ALTER TABLE `add_on`
  MODIFY `add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `food_product`
--
ALTER TABLE `food_product`
  MODIFY `food_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_on`
--
ALTER TABLE `add_on`
  ADD CONSTRAINT `add_on_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_product_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`food_product_id`) REFERENCES `food_product` (`food_product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`cart_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
