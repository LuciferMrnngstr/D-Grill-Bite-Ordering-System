-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2023 at 05:48 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `food_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `customer_id`, `food_id`, `status`, `created_at`, `updated_at`) VALUES
(127, 22, 1, 'pending', '2023-02-26 13:29:36', '2023-02-26 13:29:36'),
(128, 22, 1, 'pending', '2023-02-26 13:29:36', '2023-02-26 13:29:36'),
(129, 22, 2, 'pending', '2023-02-26 13:29:41', '2023-02-26 13:29:41'),
(130, 22, 2, 'pending', '2023-02-26 13:29:41', '2023-02-26 13:29:41'),
(131, 22, 2, 'pending', '2023-02-26 13:29:41', '2023-02-26 13:29:41'),
(172, 1, 1, 'pending', '2023-03-06 00:14:50', '2023-03-06 00:14:50'),
(175, 1, 3, 'pending', '2023-03-12 02:30:00', '2023-03-12 02:30:00'),
(176, 1, 3, 'pending', '2023-03-12 02:30:01', '2023-03-12 02:30:01'),
(177, 1, 3, 'pending', '2023-03-12 02:30:01', '2023-03-12 02:30:01'),
(178, 1, 3, 'pending', '2023-03-12 02:30:01', '2023-03-12 02:30:01'),
(179, 1, 3, 'pending', '2023-03-12 02:30:01', '2023-03-12 02:30:01'),
(180, 1, 1, 'pending', '2023-03-12 02:30:09', '2023-03-12 02:30:09'),
(181, 1, 1, 'pending', '2023-03-12 02:30:09', '2023-03-12 02:30:09'),
(183, 1, 1, 'pending', '2023-03-12 02:30:09', '2023-03-12 02:30:09');

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
(22, 'customer2@wmsu.edu.ph', 'customerr', 'Faseeh', 'B.', 'Aukasa', '09972517522', 'Student', 'CCS', '2023-02-21 01:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `food_product`
--

CREATE TABLE `food_product` (
  `food_id` int(11) NOT NULL,
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

INSERT INTO `food_product` (`food_id`, `name`, `price`, `description`, `img`, `rates`, `likes`, `sold`, `created_at`, `updated_at`) VALUES
(1, 'Tortang Talong', '20.00', 'Fried eggplant coated with egg.', 'tortang-talong', 8.2, 56, 28, '2023-01-30 03:05:08', '2023-01-30 03:05:08'),
(2, 'Adobong Atay', '25.00', 'Chicken liver adobo with hot boiled egg', 'adobong-atay', 9.2, 78, 38, '2023-01-30 03:05:08', '2023-01-30 03:05:08'),
(3, 'Coke Mismo', '25.00', 'Cold bottle coke', 'coke-mismo', 7.5, 55, 40, '2023-01-30 03:05:08', '2023-03-01 00:56:04'),
(4, 'Fried Egg', '12.00', 'Fresh fried egg', 'fried-egg', 5.6, 35, 20, '2023-01-30 03:05:08', '2023-03-01 01:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `quantity`, `grand_total`, `status`, `created_at`, `updated_at`) VALUES
(32, 1, 5, '86.00', 'released', '2023-03-01 06:19:28', '2023-03-01 06:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `customer_id`, `food_id`, `created_at`, `updated_at`) VALUES
(72, 32, 1, 3, '2023-03-01 06:19:28', '2023-03-01 06:19:28'),
(73, 32, 1, 3, '2023-03-01 06:19:28', '2023-03-01 06:19:28'),
(74, 32, 1, 4, '2023-03-01 06:19:28', '2023-03-01 06:19:28'),
(75, 32, 1, 4, '2023-03-01 06:19:28', '2023-03-01 06:19:28'),
(76, 32, 1, 4, '2023-03-01 06:19:28', '2023-03-01 06:19:28');

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
  ADD KEY `food_product_id` (`food_id`);

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
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `food_id` (`food_id`);

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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `food_product`
--
ALTER TABLE `food_product`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

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
  ADD CONSTRAINT `add_on_ibfk_1` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `order_item_ibfk_3` FOREIGN KEY (`food_id`) REFERENCES `food_product` (`food_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
