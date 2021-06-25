-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2020 at 03:57 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(55) DEFAULT NULL,
  `lastname` varchar(55) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` text,
  `mobile` varchar(20) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `password`, `address`, `mobile`, `company`, `time_Stamp`) VALUES
(1, 'Sachin', 'Arayans', 'admin@example.com', '$2y$10$clVQ0MX5ikqJ85mNrjBDZuC.d6sSCA4Jo2um.bImKn7B6nVwBkwiy', '123,new colony mod,gurgaon 122001', '+0000000000000', 'Sant Developer', '2020-09-24 10:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `parcel_weight` varchar(100) NOT NULL,
  `parcel_length` varchar(100) DEFAULT NULL,
  `parcel_width` varchar(100) DEFAULT NULL,
  `parcel_height` varchar(100) DEFAULT NULL,
  `parcel_content` varchar(100) DEFAULT NULL,
  `parcel_value` varchar(100) DEFAULT NULL,
  `sender_name` varchar(100) DEFAULT NULL,
  `sender_company` varchar(255) DEFAULT NULL,
  `sender_address1` text,
  `sender_address2` text,
  `sender_state` varchar(100) DEFAULT NULL,
  `sender_city` varchar(100) DEFAULT NULL,
  `sender_pincode` varchar(100) DEFAULT NULL,
  `sender_country` varchar(100) DEFAULT NULL,
  `sender_mobile` varchar(100) DEFAULT NULL,
  `sender_alt_mobile` varchar(100) DEFAULT NULL,
  `sender_email` varchar(100) DEFAULT NULL,
  `sender_gst` varchar(100) DEFAULT NULL,
  `recepient_name` varchar(100) DEFAULT NULL,
  `recepient_company` varchar(100) DEFAULT NULL,
  `recepient_address1` varchar(100) DEFAULT NULL,
  `recepient_address2` varchar(100) DEFAULT NULL,
  `recepient_state` varchar(100) DEFAULT NULL,
  `recepient_city` varchar(100) DEFAULT NULL,
  `recepient_pincode` varchar(100) DEFAULT NULL,
  `recepient_country` varchar(100) DEFAULT NULL,
  `recepient_mobile` varchar(100) DEFAULT NULL,
  `recepient_alt_mobile` varchar(100) DEFAULT NULL,
  `recepient_email` varchar(100) DEFAULT NULL,
  `recepient_gst` varchar(100) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_by` int(11) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `parcel_category` varchar(100) DEFAULT NULL,
  `parcel_quantity` varchar(100) DEFAULT NULL,
  `parcel_amount` varchar(100) DEFAULT NULL,
  `parcel_gst` varchar(100) DEFAULT NULL,
  `parcel_price` varchar(100) DEFAULT NULL,
  `payment_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `parcel_weight`, `parcel_length`, `parcel_width`, `parcel_height`, `parcel_content`, `parcel_value`, `sender_name`, `sender_company`, `sender_address1`, `sender_address2`, `sender_state`, `sender_city`, `sender_pincode`, `sender_country`, `sender_mobile`, `sender_alt_mobile`, `sender_email`, `sender_gst`, `recepient_name`, `recepient_company`, `recepient_address1`, `recepient_address2`, `recepient_state`, `recepient_city`, `recepient_pincode`, `recepient_country`, `recepient_mobile`, `recepient_alt_mobile`, `recepient_email`, `recepient_gst`, `time_stamp`, `order_by`, `status`, `parcel_category`, `parcel_quantity`, `parcel_amount`, `parcel_gst`, `parcel_price`, `payment_status`) VALUES
(32, '0.5 ', ' 1 ', ' 1 ', ' 1 ', ' shoes ', '1200', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', '2020-10-01 11:34:18', 1, 'saved', 'gift', '2', '50', NULL, NULL, NULL),
(33, '0.5 ', ' 1 ', ' 1 ', ' 1 ', ' shoes ', '  ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', ' v ', '2020-09-25 14:20:45', 0, ' Pending', NULL, NULL, NULL, NULL, NULL, NULL),
(34, '0.5', '1', '1', '2', 'Shoes etc', '250', 'vvv', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gmail.com', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gm.com', 'v', '2020-09-28 13:56:34', 1, 'saved', 'Gift', '', NULL, NULL, NULL, NULL),
(35, '0.5', '1', '1', '2', 'Shoes etc', '250', 'vvv', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gmail.com', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gm.com', 'v', '2020-09-28 13:57:08', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(36, '0.5', '1', '1', '2', 'Shoes etc', '250', 'vvv', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gmail.com', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gm.com', 'v', '2020-09-28 16:51:18', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(37, '0.5', '1', '1', '2', 'Shoes etc', '250', 'vvv', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gmail.com', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gm.com', 'v', '2020-09-29 13:57:19', 1, 'saved', 'Gift', '2', '500.00', NULL, NULL, NULL),
(38, '0.5', '1', '1', '2', 'Shoes etc', '250', 'vvv', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gmail.com', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v@gm.com', 'v', '2020-09-28 18:31:40', 1, 'pending', 'Gift', '2', NULL, NULL, NULL, NULL),
(39, '1.0', '3', '3', '3', 'Books, Laptop, and nothing', '2000', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's@snder.gmail.com', '', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@recepitn.gmail.com', '', '2020-09-29 14:38:56', 1, 'pending', 'Gift', '3', '1200.00', NULL, NULL, NULL),
(40, '7', '12', '12', '12', 'Gift', '2000', 'Sachin', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's@gmail.com', '123', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmail.com', '987', '2020-10-03 13:26:01', 1, 'in transit', 'Gift', '5', '250', NULL, NULL, NULL),
(41, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:02:53', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(42, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:03:43', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(43, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:04:42', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(44, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:05:02', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(45, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:05:35', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(46, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:05:47', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(47, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:06:49', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(48, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:07:11', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(49, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:07:42', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(50, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:08:11', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(51, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:08:15', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(52, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:08:27', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(53, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:08:31', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(54, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:08:53', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(55, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:08:55', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(56, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:10:05', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(57, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:10:44', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(58, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:24:37', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(59, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:25:11', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(60, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:26:23', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(61, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:28:58', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(62, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:29:20', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(63, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:31:12', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(64, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:32:30', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(65, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:33:01', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(66, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:33:22', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(67, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:34:25', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(68, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:34:51', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(69, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:35:01', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(70, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:35:10', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(71, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:37:04', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(72, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:38:06', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(73, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:42:31', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(74, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:44:56', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(75, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:46:37', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(76, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:47:34', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(77, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:48:31', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(78, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:48:44', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(79, '0.5', '1', '1', '1', 'books', '1000', 'scn@gmial.com', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '12345', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmai.com', '9876', '2020-10-03 18:49:02', 1, 'saved', 'Gift', '2', NULL, NULL, NULL, NULL),
(80, '0.3', '1', '1', '1', 'page', '20', 'sss', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'sachinarayans@gmail.com', '123', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmail.com', '987', '2020-10-03 19:11:41', 1, 'pending', 'Clothings', '3', '354', '18', '100', 'paid online'),
(81, '0.4', '1', '1', '1', 'grocery', '120', 's', 's', 's', 'ss', 's', 's', 's', 's', 's', 's', 'scn.arn@gmail.com', '123', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r', 'r@gmail.com', '987', '2020-10-03 19:15:32', 1, 'pending', 'grocery', '5', '590', '90', '500', 'COD'),
(82, '11', '1', '1', '1', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'scn.arn@gmail.com', 'a', 'a', 'aaa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'r@gmai.com', 'a', '2020-10-04 07:38:12', 1, 'saved', 'aa', '2', '236', '36', '200', NULL),
(83, '150', '1', '1', '1', 'aa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'scn.arn@gmail.com', 'a', 'a', 'aaa', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'r@gmai.com', 'a', '2020-10-04 07:39:24', 1, 'saved', 'aa', '2', '236', '36', '200', NULL),
(84, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:41:07', 1, 'saved', 'Gift', '2', '236', '36', '200', NULL),
(85, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:44:33', 1, 'saved', 'Gift', '2', '236', '36', '200', NULL),
(86, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:46:13', 1, 'saved', 'Gift', '2', '0', '0', '0', NULL),
(87, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:48:37', 1, 'saved', 'Gift', '2', '0', '0', '0', NULL),
(88, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:49:21', 1, 'saved', 'Gift', '2', '0', '0', '0', NULL),
(89, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:50:28', 1, 'saved', 'Gift', '2', '', '0', '0', NULL),
(90, '112', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:51:07', 1, 'saved', 'Gift', '2', '', '0', '0', NULL),
(91, '10', '1', '1', '1', '123564', '31', '2', '1', '32', '3221', '32', '32', '32', '32', '32', '3', 'scn@gmail.com', '', '123', '321', '321', '3221', '3221', '3221', '3221', '32', '321', '321', 'r@gmail.com', '', '2020-10-04 07:53:37', 1, 'saved', 'Gift', '2', '236', '36', '200', NULL),
(92, '1', '1', '1', '1', 'books', '1200', 's', 's', 's', 's', 's', 's', 's', 's', 's', 's', 'scn@gmail.com', '', 'r', 'r', 'r', 'r', 'rr', 'r', 'r', 'r', 'r', 'r', 'r@gmail.com', '', '2020-10-04 09:26:35', 1, 'pending', 'Gift', '5', '472', '72', '400', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `razorpay_payment_id` text NOT NULL,
  `razorpay_order_id` text NOT NULL,
  `razorpay_signature` text NOT NULL,
  `signature_verified` varchar(255) DEFAULT NULL,
  `courier_order_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `razorpay_payment_id`, `razorpay_order_id`, `razorpay_signature`, `signature_verified`, `courier_order_id`, `user_id`, `time_stamp`) VALUES
(1, 'pay_FiY5Bhx1YsiNTY', 'order_FiY4H4yWdPahwS', 'ebbefe53b8ddc85874ed7dfd08cf1042a7d376516432a457ff9a7d6de62a2942', '1', '38', 1, '2020-09-29 13:21:32'),
(2, 'pay_FiY8mX7WcJJSYU', 'order_FiY7cZXTIBLhjk', '578e2cc726e82ad7fcc8e351a1d0b70b2e60af636448c2fb8389ec3803eeb636', '1', '38', 1, '2020-09-29 13:21:32'),
(3, 'pay_Fisw5Jy8yAsPom', 'order_FisvfHSwUwTyCC', '4f4a9b915740186c5e77eb698344d3b73b1f0823d34349b5f4f88471303ff6b5', '1', '39', 1, '2020-09-29 14:52:12'),
(4, 'pay_FiszbIxo0BhaHw', 'order_FiszDm9WWJhgmd', '717992cb2fc6501563d4133d0fb0a16915b850030c5a7e868c42a80e15c413eb', '1', '40', 1, '2020-09-29 14:55:32'),
(5, 'pay_FkXUZoddITKx0V', 'order_FkXTc9FArbblyK', 'dcf517328a0581da4880d0d067deccb2b6861121af7943c66b5359b104dc9b1d', '1', '80', 1, '2020-10-03 19:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Company` varchar(255) DEFAULT NULL,
  `Address` text,
  `Mobile` varchar(20) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_partener` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Email`, `Password`, `Name`, `Company`, `Address`, `Mobile`, `time_stamp`, `is_partener`) VALUES
(1, 'sachinarayans@gmail.com', '$2y$10$KEqx9iOx8H/maMtvM/0k0OT0znXLjhSgdLalh9GhXOEQLBmR5CBiG', 'Sachin Thakur', 'SCN', 'Basai Road', '09810932480', '2020-10-03 17:50:00', 'false'),
(2, 'scn@gmail.com ', ' $2y$10$V7vjSpR6.0lphQlYWVJjNu6BU/BHVFd1/wln63tEwfbI/vlE.9DXW ', 'Annu', NULL, NULL, ' 54654', '2020-10-02 19:16:25', 'true'),
(6, 'nvn@gmail.com', '$2y$10$MU6pFvS36xZRrGGn7g5ko.5vEtA//fEr.RskAMSbsSnKLX9QraBwq', 'Naveen', NULL, NULL, '65465', '2020-10-02 15:10:11', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
