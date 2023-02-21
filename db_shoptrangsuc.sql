-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 25, 2022 lúc 07:41 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_shoptrangsuc`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_address` varchar(255) DEFAULT NULL,
  `admin_phone` int(11) DEFAULT NULL,
  `pos_id` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_address`, `admin_phone`, `pos_id`) VALUES
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Nam Định', 981736892, 1),
(7, 'Bùi Xuân Bách', 'bach', '21232f297a57a5a743894a0e4a801fc3', 'Nam ĐỊnh', 432423, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `ban_id` int(11) NOT NULL,
  `ban_image` varchar(255) NOT NULL,
  `ban_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `banners`
--

INSERT INTO `banners` (`ban_id`, `ban_image`, `ban_status`) VALUES
(1, 'uploads/banner.jpg', 1),
(2, 'uploads/banner-3.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) DEFAULT NULL,
  `cat_status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_image`, `cat_status`) VALUES
(20, 'Nhẫn', 'uploads/cat-2.jpg', 1),
(21, 'Dây chuyền', 'uploads/cat-1.jpg', 1),
(22, 'Bông tai', 'uploads/cat-3.jpg', 1),
(23, 'Đồng hồ', 'uploads/cat-4.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `com_content` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`com_id`, `cus_id`, `pro_id`, `com_content`, `date_created`) VALUES
(16, 1, 76, 'đẹp', '2022-06-21 19:51:08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_user` varchar(255) NOT NULL,
  `cus_password` varchar(255) NOT NULL,
  `cus_phone` int(11) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`cus_id`, `cus_name`, `cus_user`, `cus_password`, `cus_phone`, `cus_email`, `cus_address`, `date_created`) VALUES
(1, 'Bùi Xuân Bách', 'buixuanbach', '8dc01b0de0431cb7eced92277c1f04c7', 981736892, ' admin@gmail.com', 'Nam Định', '2021-12-12 14:56:55'),
(2, 'Khương Tiến Thảo', 'khuongtienthao', '0823fe22c8e6b63779bbbe9f43752156', 132142432, ' khuongtienthao@gmail.com', 'Nam Định', '2021-12-15 15:27:14'),
(3, 'Khương Tiến Thảo', 'thaond', '202cb962ac59075b964b07152d234b70', 969000625, ' thaokhuong48@gmail.com', 'Nghĩa Đồng-Nghĩa Hưng-Nam Định', '2021-12-16 22:18:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `order_phone` int(11) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_note` varchar(255) NOT NULL,
  `order_total` int(255) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `order_name`, `cus_id`, `order_phone`, `order_address`, `order_note`, `order_total`, `order_status`, `date_created`) VALUES
(9, 'Bùi Xuân Bách', 1, 981736892, 'Nam Định', 'a', 1326000, 3, '2022-06-15 21:21:16'),
(10, 'Bùi Xuân Bách', 1, 981736892, 'Nam Định', 'Mua hàng', 840000, 3, '2022-06-15 21:48:20'),
(11, 'Bùi Xuân Bách', 1, 981736892, 'Nam Định', 'abc', 279000, 2, '2022-06-15 21:53:28'),
(12, 'Bùi Xuân Bách', 1, 981736892, 'Nam Định', 'avc', 120000, 1, '2022-06-15 21:55:02'),
(13, 'Bùi Xuân Bách', 1, 981736892, 'Nam Định', 'bach', 548000, 1, '2022-06-17 15:36:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `o_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `o_quantity` int(11) NOT NULL,
  `o_price` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`o_id`, `order_id`, `pro_id`, `o_quantity`, `o_price`, `date_created`) VALUES
(19, 9, 61, 2, 105000, '2022-06-15 21:21:16'),
(20, 9, 77, 4, 279000, '2022-06-15 21:21:16'),
(21, 10, 70, 3, 280000, '2022-06-15 21:48:20'),
(22, 11, 72, 1, 279000, '2022-06-15 21:53:28'),
(23, 12, 60, 1, 120000, '2022-06-15 21:55:02'),
(24, 13, 71, 1, 329000, '2022-06-17 15:36:14'),
(25, 13, 79, 1, 219000, '2022-06-17 15:36:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `position`
--

CREATE TABLE `position` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `position`
--

INSERT INTO `position` (`pos_id`, `pos_name`, `date_created`) VALUES
(1, 'Quản lý', '2022-06-25 16:52:24'),
(2, 'Nhân viên', '2022-06-25 16:52:24'),
(3, 'Nhân viên kho', '2022-06-25 18:26:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `pro_size` varchar(50) NOT NULL,
  `pro_material` varchar(255) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_im_price` int(11) NOT NULL,
  `pro_quantity` int(11) NOT NULL,
  `pro_image` varchar(255) NOT NULL,
  `pro_view` int(11) NOT NULL,
  `pro_desc` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `cat_id`, `pro_size`, `pro_material`, `pro_price`, `pro_im_price`, `pro_quantity`, `pro_image`, `pro_view`, `pro_desc`, `date_created`) VALUES
(60, 'Bông Tai Tròn To Dự Tiệc Titan Ko Đen TT 4337', 22, ' 3.2cm', 'titan', 120000, 100000, 50, 'uploads/bongtai1.jpg', 4, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe . Màu sắc : vàng hồng . Kiểu dáng: sang trọng', '2022-06-24 16:06:45'),
(61, 'Bông Tai Nữ Cá Tính Kẹp Vành Titan Ko Đen TT 4335', 22, '  free size', 'titan', 105000, 100000, 39, 'uploads/bongtai2.jpg', 5, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\nMàu sắc: vàng\r\nKiểu dáng: xỏ lỗ kết hợp kẹp vành\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-24 14:51:50'),
(62, 'Bông Tai Khoen Tròn LV Titan Ko Đen TT 4327', 22, ' free size', 'titan', 105000, 100000, 40, 'uploads/bongtai3.jpg', 1, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\nMàu sắc: vàng, vàng hồng, bạc\r\nKiểu dáng: khoen tròn\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-24 16:44:53'),
(63, 'Bông Tai Khoen Tròn Chanel Titan Ko Đen TT 4326', 22, ' free size', 'titan', 105000, 0, 10, 'uploads/bongtai4.jpg', 0, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\n\r\nMàu sắc: vàng, vàng hồng, bạc\r\nKiểu dáng: khoen tròn\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-24 16:44:14'),
(64, 'Bông Tai Tòn Ten Titan Ko Đen TT 4318', 22, ' 8cm', 'titan', 155000, 0, 0, 'uploads/bongtai5.jpg', 0, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\n\r\nMàu sắc: vàng\r\nKiểu dáng: khuyên dài\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-16 21:05:24'),
(65, 'Bông Tai Khoen Rồng Cá Tính Dành Cho Nam Nữ Unisex Titan Ko Đen TT 4297 – 1 Cái', 22, '  free size', 'titan', 50000, 0, 0, 'uploads/bongtai6.jpg', 0, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\n\r\nMàu sắc: bạc, đen\r\nKiểu dáng: khoen tròn\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-16 21:05:39'),
(66, 'Bông Tai Khoen Tròn Cá Tính Titan Ko Đen TT 4287', 22, '  free size', 'titan', 105000, 0, 0, 'uploads/bongtai7.jpg', 0, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\nMàu sắc: vàng\r\nKiểu dáng: cá tính\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-16 21:05:55'),
(67, 'Bông Tai Ngọc Trai Titan Ko Đen TT 4283', 22, ' free size', 'titan', 95000, 0, 0, 'uploads/bongtai8.jpg', 0, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\n\r\nMàu sắc: vàng\r\nKiểu dáng: ngọc trai\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-16 21:06:14'),
(68, 'Bông Tai Tua Rua Chuỗi Dài Titan Ko Đen TT 4276', 22, ' free size', 'titan', 120000, 0, 0, 'uploads/bongtai9.jpg', 1, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\n\r\nMàu sắc: vàng hồng, vàng\r\nKiểu dáng: dáng dài\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-16 21:06:25'),
(69, 'Bông Tai Khoen Tròn To Đá Xanh Titan Ko Đen TT 4274', 22, '  free size', 'titan', 165000, 0, 0, 'uploads/bongtai10.jpg', 0, 'Chất liệu: titan không đen không dị ứng, hoàn toàn an toàn cho sức khỏe\r\n\r\nMàu sắc: vàng\r\nKiểu dáng: khoen tròn\r\nSử dụng: thích hợp đi chơi, đi làm, dự tiệc', '2022-06-16 21:06:37'),
(70, 'Nhẫn bạc nữ đẹp đính đá cao sang trọng NN0259', 20, ' size 6 ', 'bạc', 280000, 0, 0, 'uploads/nhan1.jpg', 12, 'Chất liệu bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\nBảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\nGiá trên là giá cho 1 chiếc \r\n\r\n Khắc tên + ngày tháng năm sinh và các kí tự đặc biệt như: trái tim, cỏ 4 lá,... miễn phí theo yêu cầu', '2022-06-16 21:06:54'),
(71, 'Nhẫn hình rắn cho nữ bằng bạc cá tính NN0329', 20, ' free size', 'bạc', 329000, 0, 0, 'uploads/nhan2.jpg', 2, 'Chất liệu bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Giao hàng toàn quốc và thanh toán khi nhận được hàng', '2022-06-16 21:07:16'),
(72, 'Nhẫn bạc nữ đeo ngón trỏ cá tính NN0313', 20, ' free size', 'bạc', 279000, 0, 0, 'uploads/nhan3.jpg', 1, 'hất liệu Bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Giao hàng toàn quốc và thanh toán khi nhận được hàng', '2022-06-16 21:07:30'),
(73, 'Nhẫn bạc nữ Hà Nội sang trọng NN0229', 20, ' free size', 'bạc', 280000, 0, 0, 'uploads/nhan4.jpg', 0, 'Chất liệu bạc cao cấp 925.Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Khắc tên + ngày tháng năm sinh và các kí tự đặc biệt như: trái tim, cỏ 4 lá,... miễn phí theo yêu cầu\r\n\r\n❄ Shop khắc tên trong lòng nhẫn nhé\r\n\r\n❄ Giao hàng toàn quốc và thanh toán khi nhận được hàng', '2022-06-16 21:08:13'),
(74, 'Nhẫn bạc nữ vương miện NN0320', 20, ' free size', 'bạc', 219000, 0, 0, 'uploads/nhan5.jpg', 0, 'Chất liệu bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Khắc tên + ngày tháng năm sinh và các kí tự đặc biệt như: trái tim, cỏ 4 lá,... miễn phí theo yêu cầu', '2022-06-15 20:38:22'),
(75, 'Nhẫn bạc nữ đính đá xanh dương bản to NN0328', 20, ' free size', 'bạc', 349000, 0, 0, 'uploads/nhan6.jpg', 0, 'Chất liệu bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Khắc tên + ngày tháng năm sinh và các kí tự đặc biệt như: trái tim, cỏ 4 lá,... miễn phí theo yêu cầu\r\n\r\n❄ Shop khắc tên trong lòng nhẫn nhé', '2022-06-15 20:40:15'),
(76, 'Nhẫn bạc nữ vô cực đơn giản NN0317', 20, ' free size', 'bạc', 199000, 0, 0, 'uploads/nhan7.jpg', 8, 'Chất liệu bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Giao hàng toàn quốc và thanh toán khi nhận được hàng', '2022-06-15 20:41:17'),
(77, 'Nhẫn bạc nữ khắc tên theo yêu cầu NN0331', 20, ' free size', 'bạc', 279000, 0, 0, 'uploads/nhan8.jpg', 2, 'Chất liệu Bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 chiếc \r\n\r\n❄ Giao hàng toàn quốc và thanh toán khi nhận được hàng', '2022-06-15 21:13:20'),
(78, 'Nhẫn tỳ hưu nữ bằng bạc theo mệnh NN0268', 20, ' free size', 'bạc', 199000, 0, 0, 'uploads/nhan10.jpg', 3, 'Nhẫn Tỳ hưu được làm từ chất liệu bạc cao cấp 925\r\nKhi đeo nhẫn lên nó mang lại tài lộc và may mắn.\r\nVới khả năng chiêu tài lộc \"chỉ ăn mà không nhả\" linh vật có thể đem đến tiền tài và phú quý.Giúp người làm ăn mua may bán đắt.\r\nNgăn ngừa tà ma, giúp gia chủ bình an và yên lành hơn trong cuộc sống\r\nBảo hành miễn phí trọn đời đánh bóng làm mới hoặc rơi đá\r\nKiểu dáng sang trọng', '2022-06-15 21:12:07'),
(79, 'Dây chuyền bạc nữ cỏ 4 lá may mắn DCN0284', 21, ' free size', 'bạc', 219000, 0, 0, 'uploads/daychuyen1.jpg', 5, 'Chất liệu bạc cao cấp 925. Độ trắng sáng cao, không lo bị đen, xỉn màu.\r\n\r\n Chất liệu bạc 925: 92,5% bạc nguyên chất phần còn lại là hợp chất làm tăng độ cứng và sáng bóng cho sản phẩm.\r\n\r\n❄ Bảo hành miễn phí trọn đời đánh bóng, làm mới hoặc gắn lại đá\r\n\r\n❄ Giá trên là giá cho 1 dây kèm mặt\r\n\r\n❄ Dây chuyền bạc nữ dài 45cm có thể cắt ngắn hoặc nối dài thêm tùy ý', '2022-06-16 23:30:20'),
(80, 'Casio LTP-V300L-4AUDF Nữ Quartz', 23, ' 34 mm', 'Dây Da', 1530000, 0, 0, 'uploads/dongho1.jpg', 1, 'Đồng hồ Casio LTP-V300L-4AUDF là mẫu đồng hồ mới được trình làng tại thị trường Việt Nam trong thời gian gần đây. Chiếc đồng hồ này nổi bật với phong cách thiết kế đậm chất thể thao. Trong những năm gần đây, nó nổi lên như một hiện tượng cuốn hút tất cả mọi đối tượng khách hàng', '2022-06-16 23:34:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_export`
--

CREATE TABLE `product_export` (
  `pro_ex_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `pro_ex_content` text NOT NULL,
  `pro_ex_note` text NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_ex_quantity` int(11) NOT NULL,
  `pro_price` int(11) NOT NULL,
  `pro_ex_status` tinyint(4) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_export`
--

INSERT INTO `product_export` (`pro_ex_id`, `admin_id`, `pro_ex_content`, `pro_ex_note`, `pro_id`, `pro_ex_quantity`, `pro_price`, `pro_ex_status`, `date_created`) VALUES
(1, 1, ' Bán hàng', 'a', 60, 10, 120000, 1, '2022-06-24'),
(2, 1, ' Bán hàng', 'aa', 60, 10, 120000, 1, '2022-06-24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_warehouse`
--

CREATE TABLE `product_warehouse` (
  `pro_ware_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `pro_ware_content` text NOT NULL,
  `pro_ware_note` text NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_ware_quantity` int(11) NOT NULL,
  `pro_im_price` int(11) NOT NULL,
  `pro_ware_status` tinyint(1) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_warehouse`
--

INSERT INTO `product_warehouse` (`pro_ware_id`, `admin_id`, `pro_ware_content`, `pro_ware_note`, `pro_id`, `pro_ware_quantity`, `pro_im_price`, `pro_ware_status`, `date_created`) VALUES
(1, 1, ' Nhập hàng', '1', 60, 10, 100000, 1, '2022-06-24'),
(2, 1, ' Nhập hàng', ' b', 60, 10, 100000, 1, '2022-06-24'),
(3, 1, ' Nhập hàng', 't', 60, 10, 100000, 1, '2022-06-24'),
(4, 1, ' Nhập hàng', 'Test', 60, 10, 100000, 1, '2022-06-24'),
(5, 1, ' Nhập hàng', 'aa', 60, 10, 100000, 1, '2022-06-24'),
(6, 1, ' Nhập hàng', 't', 62, 20, 100000, 1, '2022-06-25'),
(7, 1, ' Nhập hàng', 'test', 62, 10, 100000, 1, '2022-06-25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `shop_info`
--

CREATE TABLE `shop_info` (
  `in_name` varchar(255) NOT NULL,
  `in_address` varchar(255) NOT NULL,
  `in_email` varchar(255) NOT NULL,
  `in_phone` int(11) NOT NULL,
  `shop_open` time NOT NULL,
  `shop_close` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `shop_info`
--

INSERT INTO `shop_info` (`in_name`, `in_address`, `in_email`, `in_phone`, `shop_open`, `shop_close`) VALUES
('TB-Shop', 'Cầu Giấy, Hà Nội', 'buixuanbach102@gmail.com', 981736892, '10:00:00', '23:00:00'),
('TB-Shop', 'Cầu Giấy, Hà Nội', 'buixuanbach102@gmail.com', 981736892, '10:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statistical`
--

CREATE TABLE `statistical` (
  `statis_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `total` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `lk_admin_position` (`pos_id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`ban_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `lk_comment-customer` (`cus_id`),
  ADD KEY `lk_comment-product` (`pro_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `lk_orders-customer` (`cus_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `lk_orders_order-detail` (`order_id`),
  ADD KEY `lk_order_detail-product` (`pro_id`);

--
-- Chỉ mục cho bảng `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `lk_product-category` (`cat_id`);

--
-- Chỉ mục cho bảng `product_export`
--
ALTER TABLE `product_export`
  ADD PRIMARY KEY (`pro_ex_id`);

--
-- Chỉ mục cho bảng `product_warehouse`
--
ALTER TABLE `product_warehouse`
  ADD PRIMARY KEY (`pro_ware_id`),
  ADD KEY `lk_pro-warehouse_product` (`pro_id`),
  ADD KEY `lk_pro-warehouse_admin` (`admin_id`);

--
-- Chỉ mục cho bảng `statistical`
--
ALTER TABLE `statistical`
  ADD PRIMARY KEY (`statis_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `ban_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `position`
--
ALTER TABLE `position`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT cho bảng `product_export`
--
ALTER TABLE `product_export`
  MODIFY `pro_ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `product_warehouse`
--
ALTER TABLE `product_warehouse`
  MODIFY `pro_ware_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `statistical`
--
ALTER TABLE `statistical`
  MODIFY `statis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `lk_admin_position` FOREIGN KEY (`pos_id`) REFERENCES `position` (`pos_id`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `lk_comment-customer` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`),
  ADD CONSTRAINT `lk_comment-product` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `lk_orders-customer` FOREIGN KEY (`cus_id`) REFERENCES `customer` (`cus_id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `lk_order_detail-product` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`),
  ADD CONSTRAINT `lk_orders_order-detail` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `lk_product-category` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`);

--
-- Các ràng buộc cho bảng `product_warehouse`
--
ALTER TABLE `product_warehouse`
  ADD CONSTRAINT `lk_pro-warehouse_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `lk_pro-warehouse_product` FOREIGN KEY (`pro_id`) REFERENCES `product` (`pro_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
