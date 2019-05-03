-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th5 03, 2019 lúc 11:14 AM
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
-- Cấu trúc bảng cho bảng `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `joindate` date NOT NULL,
  `salary` double NOT NULL,
  `id_competence` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deltail` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `root` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `deltail`, `image`, `root`) VALUES
(1, 'Riêng Nữ', 'Phong cách thời trang tối giản\r\nNhiều sự lựa chọn\r\nGiá thành hợp lí', 'Resource/upload/girl.jpg', b'1'),
(2, 'Riêng Nam', 'Phong cách thời trang tối giản\r\nNhiều sự lựa chọn\r\nGiá thành hợp lí', 'Resource/upload/men.jpg', b'1'),
(3, 'Trẻ em', 'Phong cách thời trang tối giản\r\nNhiều sự lựa chọn\r\nGiá thành hợp lí', 'Resource/upload/child.jpg', b'1'),
(4, 'Phụ kiện', 'Phong cách thời trang tối giản\r\nNhiều sự lựa chọn\r\nGiá thành hợp lí', 'Resource/upload/phukien.jpg', b'1'),
(5, 'Áo khoát', '', '', b'0'),
(6, 'Áo thun', '', '', b'0'),
(7, 'Quần shot', '', '', b'0'),
(8, 'Kính', '', '', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories_child`
--

DROP TABLE IF EXISTS `categories_child`;
CREATE TABLE IF NOT EXISTS `categories_child` (
  `id_parent` int(11) NOT NULL,
  `id_child` int(11) NOT NULL,
  PRIMARY KEY (`id_parent`,`id_child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories_child`
--

INSERT INTO `categories_child` (`id_parent`, `id_child`) VALUES
(1, 6),
(2, 5),
(3, 7),
(4, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `config`
--

INSERT INTO `config` (`id`, `name`, `data`) VALUES
(4, 'categories', '[{\"id\":\"1\",\"name\":\"Ri\\u00eang N\\u1eef\",\"deltail\":\"Phong c\\u00e1ch th\\u1eddi trang t\\u1ed1i gi\\u1ea3n\\r\\nNhi\\u1ec1u s\\u1ef1 l\\u1ef1a ch\\u1ecdn\\r\\nGi\\u00e1 th\\u00e0nh h\\u1ee3p l\\u00ed\",\"image\":\"Resource\\/upload\\/girl.jpg\",\"child\":[{\"id\":\"6\",\"name\":\"\\u00c1o thun\",\"deltail\":\"\",\"image\":\"\"}]},{\"id\":\"2\",\"name\":\"Ri\\u00eang Nam\",\"deltail\":\"Phong c\\u00e1ch th\\u1eddi trang t\\u1ed1i gi\\u1ea3n\\r\\nNhi\\u1ec1u s\\u1ef1 l\\u1ef1a ch\\u1ecdn\\r\\nGi\\u00e1 th\\u00e0nh h\\u1ee3p l\\u00ed\",\"image\":\"Resource\\/upload\\/men.jpg\",\"child\":[{\"id\":\"5\",\"name\":\"\\u00c1o kho\\u00e1t\",\"deltail\":\"\",\"image\":\"\"}]},{\"id\":\"3\",\"name\":\"Tr\\u1ebb em\",\"deltail\":\"Phong c\\u00e1ch th\\u1eddi trang t\\u1ed1i gi\\u1ea3n\\r\\nNhi\\u1ec1u s\\u1ef1 l\\u1ef1a ch\\u1ecdn\\r\\nGi\\u00e1 th\\u00e0nh h\\u1ee3p l\\u00ed\",\"image\":\"Resource\\/upload\\/child.jpg\",\"child\":[{\"id\":\"7\",\"name\":\"Qu\\u1ea7n shot\",\"deltail\":\"\",\"image\":\"\",\"child\":[{\"id\":\"8\",\"name\":\"K\\u00ednh\",\"deltail\":\"\",\"image\":\"\"}]}]},{\"id\":\"4\",\"name\":\"Ph\\u1ee5 ki\\u1ec7n\",\"deltail\":\"Phong c\\u00e1ch th\\u1eddi trang t\\u1ed1i gi\\u1ea3n\\r\\nNhi\\u1ec1u s\\u1ef1 l\\u1ef1a ch\\u1ecdn\\r\\nGi\\u00e1 th\\u00e0nh h\\u1ee3p l\\u00ed\",\"image\":\"Resource\\/upload\\/phukien.jpg\"}]'),
(5, 'slides', '[\"Resource/upload/bn1.jpg\", \"Resource/upload/bn2.jpg\", \"Resource/upload/bn5.jpg\"]');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `indentity_card` bigint(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `email`, `fullname`, `phone`, `address`, `indentity_card`) VALUES
(3, 'admin', 'adadad', 'kakahuy99@gmail.com', 'Huy Nguyen', 1697777777, 'Ahihi, Lazaba, Kakaka', 123456789),
(4, 'admin2', 'adadad', 'admin@admin.com', 'Huy Nguyen', 1697777777, 'adasd, sad, á,d asd á,d', 2123456789),
(8, 'admin21', 'adadad', 'kakaka@gmail.com', 'Huy Nguyen', 1697777777, 'adasd, sad, á,d asd á,d', 123456789111),
(9, 'admin1', 'adadad', 'kakahuy102@live.com', 'Nguyễn Gia Huy', 1697775111, 'Abc, def, ghi', 202022912);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` text COLLATE utf8_unicode_ci NOT NULL,
  `product_star` tinyint(4) NOT NULL,
  `product_sale` int(11) NOT NULL,
  `product_view` int(11) NOT NULL,
  `product_num_sold_all` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_option`
--

DROP TABLE IF EXISTS `product_option`;
CREATE TABLE IF NOT EXISTS `product_option` (
  `product_id` int(11) NOT NULL,
  `product_option` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_num_current` int(11) NOT NULL,
  `product_num_sold` int(11) NOT NULL,
  `product_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_status_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`product_option`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_status`
--

DROP TABLE IF EXISTS `product_status`;
CREATE TABLE IF NOT EXISTS `product_status` (
  `product_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_status_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`product_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
