-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 19, 2024 at 07:05 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `administrator_id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each administrator.',
  `administrator_name` varchar(60) NOT NULL COMMENT 'Name chosen for the administrator.',
  `administrator_password` varchar(30) NOT NULL COMMENT 'Password for the administrator account.',
  PRIMARY KEY (`administrator_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bidders`
--

DROP TABLE IF EXISTS `bidders`;
CREATE TABLE IF NOT EXISTS `bidders` (
  `bidder_id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each bidder\r\n',
  `bidder_name` varchar(60) NOT NULL COMMENT 'Name of the bidder\r\n',
  `bidder_email` varchar(50) NOT NULL COMMENT 'Email address of the bidder\r\n',
  `bidder_password` varchar(30) NOT NULL COMMENT 'Password for the bidder to authenticate into the system\r\n',
  `bidder_security_question` varchar(150) NOT NULL COMMENT 'Security question as an additional authentication factor\r\n',
  `bidder_security_answer` varchar(200) NOT NULL COMMENT 'Security answer as authentication factor for the security question\r\n',
  `bidder_resident_id_number` varchar(50) NOT NULL COMMENT 'Bidder resident id number for identity and security purposes\r\n',
  `bidder_resident_card_image` varchar(50) NOT NULL COMMENT 'Bidder resident card image file location on the server\r\n',
  `bidder_status` tinyint(1) NOT NULL COMMENT 'Bidder status whether approved by an administrator or not.\r\n',
  PRIMARY KEY (`bidder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bids`
--

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids` (
  `bid_id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each bid.',
  `bid_price` double(20,2) NOT NULL COMMENT 'Price that bidder has set for the respective bid.',
  `bid_date` date NOT NULL COMMENT 'Date of bid.',
  `bidder_id` int NOT NULL COMMENT 'Bidder id of the bidder that has bid on specified product.',
  `product_id` int NOT NULL COMMENT 'Product id for which bidder with specified bidder id has bid on.',
  PRIMARY KEY (`bid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each product.\r\n',
  `product_name` varchar(30) NOT NULL COMMENT 'Name chosen for the product.\r\n',
  `product_minimum_bidding_price` double(25,2) NOT NULL COMMENT 'Setting the minimum bidding price.\r\n',
  `product_description` varchar(200) NOT NULL COMMENT 'Description for the product.\r\n',
  `product_start_date` date NOT NULL COMMENT 'Date when the product lasted.\r\n',
  `product_last_date` date NOT NULL COMMENT 'Date when the auction end.\r\n',
  `product_status` tinyint(1) NOT NULL COMMENT 'product status whether approved by an administrator or not.\r\n',
  `seller_id` int NOT NULL COMMENT 'Seller id of the seller that has product on specified product.\r\n',
  `product_type_id` int NOT NULL COMMENT 'Product type ID of the product type that has product on specified product.',
  `product _image` varchar(50) NOT NULL COMMENT 'product image file location on the server.\r\n',
  `bidder_id` int NOT NULL COMMENT 'Bidder id of the winning bidder.\r\n',
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `seller_id` int NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier for each\r\nseller.',
  `seller_name` varchar(60) NOT NULL COMMENT 'Name chosen by the seller.',
  `seller_email` varchar(50) NOT NULL COMMENT 'Email address of the seller.',
  `seller_phone` varchar(8) NOT NULL COMMENT 'Phone number of the seller.',
  `seller_password` varchar(30) NOT NULL COMMENT 'Password for the seller to authenticate into the system.',
  `seller_security_question` varchar(150) NOT NULL COMMENT 'Security question as an additional authentication factor.',
  `seller_security_answer` varchar(200) NOT NULL COMMENT 'Security answer as authentication factor for the security question.',
  `seller_resident_id_number` varchar(100) NOT NULL COMMENT 'seller resident id number for identity and security purposes.',
  `seller_resident_card_image` varchar(50) NOT NULL COMMENT 'seller resident card image file location on the server.',
  `seller_status` tinyint(1) NOT NULL COMMENT 'Seller status whether approved by an administrator or not.',
  PRIMARY KEY (`seller_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
