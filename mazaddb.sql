-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2024 at 09:26 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mazaddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

DROP TABLE IF EXISTS `administrators`;
CREATE TABLE IF NOT EXISTS `administrators` (
  `administrator_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each administrator.',
  `administrator_name` varchar(60) NOT NULL COMMENT 'Name chosen for the administrator.',
  `administrator_password` varchar(30) NOT NULL COMMENT 'Password for the administrator account.',
  PRIMARY KEY (`administrator_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`administrator_id`, `administrator_name`, `administrator_password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `bidders`
--

DROP TABLE IF EXISTS `bidders`;
CREATE TABLE IF NOT EXISTS `bidders` (
  `bidder_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each bidder\r\n',
  `bidder_name` varchar(60) NOT NULL COMMENT 'Name of the bidder\r\n',
  `bidder_email` varchar(50) NOT NULL COMMENT 'Email address of the bidder\r\n',
  `bidder_password` varchar(30) NOT NULL COMMENT 'Password for the bidder to authenticate into the system\r\n',
  `bidder_security_question` varchar(150) NOT NULL COMMENT 'Security question as an additional authentication factor\r\n',
  `bidder_security_answer` varchar(200) NOT NULL COMMENT 'Security answer as authentication factor for the security question\r\n',
  `bidder_resident_id_number` varchar(50) NOT NULL COMMENT 'Bidder resident id number for identity and security purposes\r\n',
  `bidder_resident_card_image` varchar(50) NOT NULL COMMENT 'Bidder resident card image file location on the server\r\n',
  `bidder_status` tinyint(1) NOT NULL COMMENT 'Bidder status whether approved by an administrator or not.\r\n',
  `administrator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`bidder_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bidders`
--

INSERT INTO `bidders` (`bidder_id`, `bidder_name`, `bidder_email`, `bidder_password`, `bidder_security_question`, `bidder_security_answer`, `bidder_resident_id_number`, `bidder_resident_card_image`, `bidder_status`, `administrator_id`) VALUES
(1, 'kahlid', 'kahlid@123', '123', 'Who is your favorite person?', 'kahlid', '1111', 'Bidding_2.png', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each bid.',
  `bid_price` double(20,2) NOT NULL COMMENT 'Price that bidder has set for the respective bid.',
  `bid_date` date NOT NULL COMMENT 'Date of bid.',
  `bidder_id` int(11) NOT NULL COMMENT 'Bidder id of the bidder that has bid on specified product.',
  `product_id` int(11) NOT NULL COMMENT 'Product id for which bidder with specified bidder id has bid on.',
  PRIMARY KEY (`bid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each product.\r\n',
  `product_name` varchar(30) NOT NULL COMMENT 'Name chosen for the product.\r\n',
  `product_minimum_bidding_price` double(25,2) NOT NULL COMMENT 'Setting the minimum bidding price.\r\n',
  `product_description` varchar(200) NOT NULL COMMENT 'Description for the product.\r\n',
  `product_start_date` date NOT NULL COMMENT 'Date when the product lasted.\r\n',
  `product_last_date` date NOT NULL COMMENT 'Date when the auction end.\r\n',
  `product_status` tinyint(1) NOT NULL COMMENT 'product status whether active or closed',
  `seller_id` int(11) NOT NULL COMMENT 'Seller id of the seller that has product on specified product.\r\n',
  `product_type_id` int(11) NOT NULL COMMENT 'Product type ID of the product type that has product on specified product.',
  `product_image` varchar(50) NOT NULL COMMENT 'product image file location on the server.',
  `bidder_id` int(11) NOT NULL COMMENT 'Bidder id of the winning bidder.\r\n',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_minimum_bidding_price`, `product_description`, `product_start_date`, `product_last_date`, `product_status`, `seller_id`, `product_type_id`, `product_image`, `bidder_id`) VALUES
(1, 'blue tshirt', 5.00, 'large blue t', '2024-05-20', '2024-05-23', 1, 5, 1, 'image path', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
CREATE TABLE IF NOT EXISTS `product_type` (
  `product_type` varchar(30) NOT NULL COMMENT 'type of product',
  `product_type_id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier for each product type',
  PRIMARY KEY (`product_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type`, `product_type_id`) VALUES
('clothes', 1),
('mobiles', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each\r\nseller.',
  `seller_name` varchar(60) NOT NULL COMMENT 'Name chosen by the seller.',
  `seller_email` varchar(50) NOT NULL COMMENT 'Email address of the seller.',
  `seller_phone` varchar(8) NOT NULL COMMENT 'Phone number of the seller.',
  `seller_password` varchar(30) NOT NULL COMMENT 'Password for the seller to authenticate into the system.',
  `seller_security_question` varchar(150) NOT NULL COMMENT 'Security question as an additional authentication factor.',
  `seller_security_answer` varchar(200) NOT NULL COMMENT 'Security answer as authentication factor for the security question.',
  `seller_resident_id_number` varchar(100) NOT NULL COMMENT 'seller resident id number for identity and security purposes.',
  `seller_resident_card_image` varchar(50) NOT NULL COMMENT 'seller resident card image file location on the server.',
  `seller_status` tinyint(1) NOT NULL COMMENT 'Seller status whether approved by an administrator or not.',
  `administrator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `seller_name`, `seller_email`, `seller_phone`, `seller_password`, `seller_security_question`, `seller_security_answer`, `seller_resident_id_number`, `seller_resident_card_image`, `seller_status`, `administrator_id`) VALUES
(5, 'edgar', 'fa@123', '111', '111', 'Who is your favorite person?', 'fa', '1234', '', 1, 1),
(4, 'ali', 'ali@123', '95400', '121', 'Who is your favorite person?', 'ali', '121', 'Bidding-1.png', 1, 1),
(3, 'salim', 'Salim@12', '94332', '', 'Who is your favorite person?', 'ali', '1423', 'bidders.png', 0, NULL),
(6, 'ka', 'ka@12345', '12345', '12345', 'Who is your favorite person?', 'kakaka', '12345', '', 0, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
