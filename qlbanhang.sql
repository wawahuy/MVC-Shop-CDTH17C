-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th5 07, 2019 lúc 03:32 PM
-- Phiên bản máy phục vụ: 5.7.24
-- Phiên bản PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlbanhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `categorie_image` text COLLATE utf8_unicode_ci NOT NULL,
  `categorie_deltail` text COLLATE utf8_unicode_ci NOT NULL,
  `categorie_parent` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`categorie_id`),
  KEY `employee_id` (`employee_id`) USING BTREE,
  KEY `categorie_parent` (`categorie_parent`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categorie_id`, `categorie_name`, `categorie_image`, `categorie_deltail`, `categorie_parent`, `employee_id`) VALUES
(20, 'Riêng nữ 2', 'upload/bn1.jpg', 'Phong cách thời trang tối giản\r\nNhiều sự lựa chọn\r\nGiá thành hợp lí', NULL, 1),
(22, 'Riêng nữ - Child', 'a', 'a', 20, 1),
(23, 'Riêng nam', 'upload/bn2.jpg', 'Phong cách thời trang tối giản\r\nNhiều sự lựa chọn\r\nGiá thành hợp lí', NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` text COLLATE utf8_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_parent` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`),
  UNIQUE KEY `member_id` (`member_id`),
  UNIQUE KEY `comment_parent` (`comment_parent`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `config_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `employee_pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `employee_fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `employee_phone` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `employee_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `employee_birth` date NOT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_user`, `employee_pass`, `employee_fullname`, `employee_phone`, `employee_email`, `employee_birth`) VALUES
(1, 'admin', 'admin123', 'Nguyễn Gia Huy', '857350574', 'kakahuy99@gmail.com', '2019-05-01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_user` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `member_pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `member_fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `member_phone` int(11) NOT NULL,
  `member_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `member_birth` date NOT NULL,
  `member_sex` tinyint(1) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `member_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `member_id` (`member_id`),
  KEY `employee_id` (`employee_id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_elements`
--

DROP TABLE IF EXISTS `order_elements`;
CREATE TABLE IF NOT EXISTS `order_elements` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_ele_price` decimal(10,0) NOT NULL,
  `order_ele_num` int(11) NOT NULL,
  `order_ele_options` int(11) NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `policy`
--

DROP TABLE IF EXISTS `policy`;
CREATE TABLE IF NOT EXISTS `policy` (
  `policy_id` int(11) NOT NULL AUTO_INCREMENT,
  `policy_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `policy_symbol` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `policy_parent` int(11) NOT NULL,
  `policy_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`policy_id`),
  KEY `policy_parent` (`policy_parent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `policy_member`
--

DROP TABLE IF EXISTS `policy_member`;
CREATE TABLE IF NOT EXISTS `policy_member` (
  `employee_id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  PRIMARY KEY (`employee_id`,`policy_id`),
  KEY `policy_id` (`policy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_view` int(11) NOT NULL DEFAULT '0',
  `product_star` tinyint(4) NOT NULL,
  `product_deltail` text COLLATE utf8_unicode_ci NOT NULL,
  `produtc_day` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_options` text COLLATE utf8_unicode_ci NOT NULL,
  `product_num_remai` int(11) NOT NULL,
  `product_num_sold` int(11) NOT NULL DEFAULT '0',
  `product_price` decimal(10,0) NOT NULL,
  `product_sale` tinyint(4) NOT NULL DEFAULT '0',
  `product_image` text COLLATE utf8_unicode_ci NOT NULL,
  `product_status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `employee_id` (`employee_id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_view`, `product_star`, `product_deltail`, `produtc_day`, `product_options`, `product_num_remai`, `product_num_sold`, `product_price`, `product_sale`, `product_image`, `product_status`, `employee_id`, `categorie_id`) VALUES
(1, 'Áo Test', 0, 4, 'Test', '2019-05-07 22:31:23', '{\"Size\": \"X\", \"XL\"}', 200, 0, '90000', 0, '[\"upload/ao-so-mi-hong.jpg\"]', 'Hoạt Động', 1, 20);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_2` FOREIGN KEY (`categorie_parent`) REFERENCES `categories` (`categorie_id`),
  ADD CONSTRAINT `categories_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_parent`) REFERENCES `comments` (`comment_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`contact_id`);

--
-- Các ràng buộc cho bảng `order_elements`
--
ALTER TABLE `order_elements`
  ADD CONSTRAINT `order_elements_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_elements_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `policy`
--
ALTER TABLE `policy`
  ADD CONSTRAINT `policy_ibfk_1` FOREIGN KEY (`policy_parent`) REFERENCES `policy` (`policy_id`);

--
-- Các ràng buộc cho bảng `policy_member`
--
ALTER TABLE `policy_member`
  ADD CONSTRAINT `policy_member_ibfk_1` FOREIGN KEY (`policy_id`) REFERENCES `policy` (`policy_id`),
  ADD CONSTRAINT `policy_member_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
