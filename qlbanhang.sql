-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 04, 2019 lúc 01:50 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.2

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

CREATE TABLE `admin` (
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `joindate` date NOT NULL,
  `salary` double NOT NULL,
  `id_competence` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `deltail` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(10000) COLLATE utf8_unicode_ci NOT NULL,
  `root` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `categories_child` (
  `id_parent` int(11) NOT NULL,
  `id_child` int(11) NOT NULL
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

CREATE TABLE `competence` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `indentity_card` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `email`, `fullname`, `phone`, `address`, `indentity_card`) VALUES
(3, 'admin', 'adadad', 'kakahuy99@gmail.com', 'Huy Nguyen', 1697777777, 'Ahihi, Lazaba, Kakaka', 123456789);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `star` tinyint(4) NOT NULL,
  `sale` int(11) NOT NULL,
  `note` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `view` int(11) NOT NULL,
  `num_current` int(11) NOT NULL,
  `num_sold` int(11) NOT NULL,
  `image` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `deltail` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `json_option` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `star`, `sale`, `note`, `view`, `num_current`, `num_sold`, `image`, `deltail`, `price`, `categories_id`, `json_option`) VALUES
(1, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(2, 'Fake 2', 4, 0, 'New', 2000, 1300, 211, '[\"Resource/upload/ao-tre-vai-phoi-mau.jpg\"]', 'Fake deltail!', 200000, 5, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(3, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(4, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(5, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(6, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(7, 'Fake 2', 4, 0, 'New', 2000, 1300, 211, '[\"Resource/upload/ao-tre-vai-phoi-mau.jpg\"]', 'Fake deltail!', 200000, 5, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(8, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(9, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(10, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(11, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(12, 'Fake 2', 4, 0, 'New', 2000, 1300, 211, '[\"Resource/upload/ao-tre-vai-phoi-mau.jpg\"]', 'Fake deltail!', 200000, 5, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(13, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(14, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(15, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(16, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(17, 'Fake 2', 4, 0, 'New', 2000, 1300, 211, '[\"Resource/upload/ao-tre-vai-phoi-mau.jpg\"]', 'Fake deltail!', 200000, 5, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(18, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(19, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(20, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(21, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(22, 'Fake 2', 4, 0, 'New', 2000, 1300, 211, '[\"Resource/upload/ao-tre-vai-phoi-mau.jpg\"]', 'Fake deltail!', 200000, 5, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(23, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(24, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }'),
(25, 'Fake', 4, 20, 'New', 1000, 100, 21, '[\"Resource/upload/ao-so-mi-hong.jpg\"]', 'Fake deltail!', 300000, 6, '{\r\n    \"Phân loại\": [\"A\", \"B\"],\r\n    \"Kích thước\": [\"X\", \"XL\"]\r\n    }');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories_child`
--
ALTER TABLE `categories_child`
  ADD PRIMARY KEY (`id_parent`,`id_child`);

--
-- Chỉ mục cho bảng `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
