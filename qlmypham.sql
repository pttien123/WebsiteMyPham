-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 31, 2018 lúc 07:01 AM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlmypham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--
-- Tạo: Th8 26, 2018 lúc 07:30 PM
-- Cập nhật lần cuối: Th8 26, 2018 lúc 07:59 PM
-- Lần kiểm tra cuối: Th8 29, 2018 lúc 10:21 PM
--

CREATE TABLE `admin` (
  `Username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Ho` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Ten` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `NgayTao` date NOT NULL,
  `NgayCapNhat` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`Username`, `Ho`, `Ten`, `Email`, `Phone`, `Password`, `NgayTao`, `NgayCapNhat`) VALUES
('admin1', 'Phạm Thủy', 'Tiên', '123@mail.com', '0123213879', 'c67d0461869668e1de88db0d6c532d1b', '2018-08-24', '2018-08-25'),
('admin2', 'Nguyễn Thị Ánh', 'Hồng', 'hong123@gmail.com', '09876543210', 'd60c2eebce92f819d7906c4860af5d66', '2018-08-25', '2018-08-27'),
('admin3', 'admin3', 'admin3', 'admin3@a.com', 'admin3', 'xinchaoVN', '2018-08-25', '2018-08-27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmucsp`
--
-- Tạo: Th8 26, 2018 lúc 11:45 PM
-- Cập nhật lần cuối: Th8 26, 2018 lúc 11:46 PM
-- Lần kiểm tra cuối: Th8 31, 2018 lúc 04:33 AM
--

CREATE TABLE `catalog` (
  `MaDM` int(20) NOT NULL,
  `TenLoai` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `MaDM_Cha` int(20) NOT NULL DEFAULT '0',
  `ViTriHienThi` tinyint(10) NOT NULL DEFAULT '0',
  `MoTa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GhiChu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=24 ;

--
-- Đang đổ dữ liệu cho bảng `danhmucsp`
--

INSERT INTO `catalog` (`MaDM`, `TenLoai`, `MaDM_Cha`, `ViTriHienThi`, `MoTa`, `GhiChu`) VALUES
('1', 'Trang Điểm', '0', 0, 'Sản Phẩm Trang Điểm', NULL),
('2', 'Son môi', '1', 0, 'Sản Phẩm Trang Điểm', NULL),
('3', 'Kem nền', '1', 1, 'Sản Phẩm Trang Điểm', NULL),
('4', 'Chăm Sóc Da', '0', 1, 'Sản Phẩm Chăm Sóc Da', NULL),
('5', 'kem dưỡng da', '4', 0, '', NULL),
('6', 'Sữa rửa mặt', '4', 1, '', NULL),
('7', 'Dưỡng Tóc', '0', 2, 'Sản Phẩm Dưỡng Tóc', NULL),
('8', 'Dầu gội', '7', 0, 'Sản Phẩm Dưỡng Tóc', NULL),
('9', 'Dầu xả', '7', 1, 'Sản Phẩm Dưỡng Tóc', NULL),
('10', 'Nước Hoa', '0', 3, 'Nước Hoa', NULL),
('11', 'Nước Hoa nam', '10', 0, 'Nước Hoa', NULL),
('12', 'Nước Hoa nữ', '10', 1, 'Nước Hoa', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--
-- Tạo: Th8 27, 2018 lúc 12:15 AM
-- Cập nhật lần cuối: Th8 27, 2018 lúc 12:38 AM
-- Lần kiểm tra cuối: Th8 31, 2018 lúc 04:33 AM
--

CREATE TABLE `khachhang` (
  `id_KH` int(255) NOT NULL,
  `ho` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ten` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ngaysinh` date DEFAULT NULL,
  `diachi` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dienthoai` int(15) NOT NULL,
  `diemtichluy` int(50) NOT NULL DEFAULT '0',
  `NgayTao` date NOT NULL,
  `NgayCapNhat` date NOT NULL,
  `GhiChu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id_KH`, `ho`, `ten`, `email`, `password`, `ngaysinh`, `diachi`, `dienthoai`, `diemtichluy`, `NgayTao`, `NgayCapNhat`, `GhiChu`) VALUES
(1, 'Nguyễn Thị ', 'Ánh', 'anhhong97@gmail.com', 'ahxinhdep', '1997-12-13', '101 CMT8', 1202887536, 0, '2018-08-27', '0000-00-00', NULL),
(2, 'Phạm', 'Thủy', 'tientien97@gmail.com', 'tienxauxi', '1997-01-01', 'Số 72 Hàm tử, Quận 8, TP.HCM', 903663311, 0, '2018-08-20', '0000-00-00', NULL),
(3, 'Đoàn Quốc', 'Khánh', 'qk_quockhanh@gmail.com', '123456qk', '1988-11-09', '43 Phố Cháo, Hà Nội', 984523264, 0, '2018-08-20', '2018-08-20', NULL),
(4, 'Lê Bảo', 'Ngọc', 'ngoclaem@gmail.com', 'nn123456', '1990-05-26', 'Hải Phòng', 982735387, 0, '2015-10-04', '2015-10-04', NULL),
(5, 'Văn Bảo', 'Ngân', 'nganngocnghech@gmail.com', 'ngan1234', '1996-02-14', 'Bình Định', 987654321, 0, '2015-05-05', '2015-05-05', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--
-- Tạo: Th8 27, 2018 lúc 01:20 AM
-- Cập nhật lần cuối: Th8 27, 2018 lúc 01:47 AM
-- Lần kiểm tra cuối: Th8 31, 2018 lúc 04:33 AM
--

CREATE TABLE `product` (
  `id_sp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MaDM` int (20) NOT NULL,
  `MaNH` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tensp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dongia` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `giamgia` int(11) NOT NULL,
  `hinhanh` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ds_hinhanh` text COLLATE utf8_unicode_ci NOT NULL,
  `Ngaytao` date NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `maLo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `MoTa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GhiChu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `product` (`id_sp`, `MaDM`, `MaNH`, `tensp`, `dongia`, `content`, `giamgia`, `hinhanh`, `ds_hinhanh`, `Ngaytao`, `view`, `maLo`, `MoTa`, `GhiChu`) VALUES
('S01', '1', '3CE', 'Son 3CE Red Recipe Lip Color (3.5g)', '260.0000', 'Son 3CE Red Recipe Lip Color\r\nSau khi “gây bão” với 2 dòng son Mood Recipe và Lily Maymac, thì mới đây thương hiệu mỹ phẩm đình đám xứ Hàn 3CE lại vừa tiếp tục tung ra một dòng son đặc biệt dành riêng cho dịp Valentine 2017, khiến bất cứ tín đồ son môi nào cũng phải “ngất lịm” trước 5 tone son đỏ siêu rực rỡ và nổi bật.\r\n', 0, '', '', '2018-08-01', 0, 'L1', 'Mang thiết kế của thỏi son vuông truyền thống với lớp vỏ đỏ bắt mắt, thể hiện màu sắc trùng khớp với màu son bên trong. Vỏ son được làm bằng chất liệu nhựa lì, nắp đậy chắc chắn và cầm rất vừa tay.', NULL),
('S02', '1', 'BBA', 'Son Bbia Last Velvet (5g)', '160.0000', 'Son Bbia Last Velvet Lip Tint là bộ sưu tập mới toanh của Bbia tiếp nối thành công của những dòng son trước, với thiết kế nhỏ gọn đơn giản, trẻ trung, tuy không bắt mắt lắm nhưng bù lại màu son thì đẹp tuyệt vời miễn chê luôn nhé các nàng.\r\n\r\nKết cấu của Bbia Last Velvet Lip Tint có phần đặc hơn son tint và lỏng hơn so với son kem một tẹo nhưng khi thoa lên môi thì các phân tử nhỏ liên kết chặt chẽ và tiệp ngay vào môi như son tint giúp che đi những khuyết điểm của môi, cho bờ môi cảm giác tươi tắn khỏe mạnh.\r\n\r\nChất son mướt mịn, lên màu cực kì chuẩn, chỉ cần một lần thoa là lên màu rõ và sống động, dễ dàng dàn trải đều trên bờ môi và nhanh chóng khô đi tạo thành một lớp son lì siêu mịn có thể giữ màu bền lâu suốt nhiều giờ liền, không gây cảm giác dày hay bóng môi như một số dòng son kem khác.', 0, '', '', '2018-04-04', 0, 'L1', NULL, NULL),
('SRM01', '6', 'NT', 'Rửa Mặt Trị Mụn Neutrogena', '185.0000', 'Neutrogena visibly clear visibly clear gel nettoyant pamplemousse rose\r\n\r\nSữa rửa mặt Neutrogena với các hạt tẩy da chết nhẹ nhàng làm sạch mà không gây khô da.\r\n* Thành phần chiết xuất từ Bưởi và Hoa hồng với khả năng làm da sáng hơn mỗi ngày, giảm vết thâm mụn và các khuyết điểm khác trên da.\r\n* Axit Salicylic với đặc tính chống khuẩn, làm sạch chất bã nhờn và các chất cặn bã.\r\n* Các hạt micro hỗ trợ tẩy da chết một cách nhẹ nhàng, không gây tổn thường cho da, loại bỏ tình trạng bít lỗ chân lông gây mụn.\r\nSũa rửa mặt Neutrogena Visibly Clear giúp giảm mụn đầu đen hiệu quả. Đặc biệt ngăn ngừa mụn trước khi chúng hình thành, thu nhỏ lỗ chân lông và mang đến làn da tươi mới, mịn màng', 0, '', '', '2018-02-20', 0, 'L1', NULL, NULL),
('DT01', 'DT', '8', 'Dầu Gội Hoa Trà Kurobara (500ml)', '175.0000', 'Kurobara là thương hiệu chăm sóc sắc đẹp không chỉ được yêu thích tại Nhật Bản mà đã có mặt tại nhiều nước châu Á.\r\n\r\nDầu Gội Hoa Trà Kurobara Tsubaki Oil Hair Shampoo với thành phần chính là tinh dầu ép từ những cánh hoa trà Nhật bản tăng cường khả năng chống oxy hóa kết hợp với nhiều dưỡng chất giúp dễ dàng thâm nhập vào từng sợi tóc để nuôi dưỡng và ngăn chặn thiệt hại cho tóc. \r\nSản phẩm không gây gàu, ngứa và giúp tóc bạn mượt mà,đen láy,bóng mượt.\r\nĐặc biệt hương thơm hoa trà vô cùng độc đáo, nhẹ nhàng tạo cảm giác thư giãn cho da đầu.', 0, '', '', '2018-08-28', 0, 'L2', NULL, NULL),
('NCT1', 'NH01', '10', 'Nước Hoa Bleu De Chanel ', '2.0000', 'Thiết kế\r\nSản phẩm sở hữu một thiết kế nam tính, lịch lãm. Thân chai được thiết kế nguyên khối góc cạnh toát lên vẻ sang trọng ngay trong lần đầu nhìn thấy. Tone màu xanh đen như tôn lên sự tinh tế, thể hiện đẳng cấp quý ông mạnh mẽ, quyền lực. Nắp đen ton-sur-ton khắc tên logo đã giúp cho khách hàng cảm nhận được vẻ nam tính của sản phẩm dù là chỉ nhìn bên ngoài. Điểm cộng lớn nhất đó là vòi xịt được thiết kế rất thông minh. Giúp cho bạn dễ dàng điều chỉnh lượng nước hoa cần thiết và cho tia nước hoa phun đều. \r\n\r\nMùi hương\r\nKhi nói đến một mùi hương nam tính thì gợi ý đầu tiên là Bleu De Chanel Parfum. Vậy có gì khiến cho một chai nước hoa được “sủng ái” đến thế? Đầu tiên là ở sự đẳng cấp, vẻ đẹp hoàn mỹ đến từ ngoại hình và tinh tế đến từ mùi hương. Chính điều ấy đã biết sản phẩm trở thành một “tượng đài” của mùi hương lịch lãm dành cho nam. Kế đến là sự nam tính, hiếm có dòng nước hoa nào mang mùi hương nam tính nhưng lại không bị gắt như thế. Thật không có gì đáng ngạc nhiên nếu bất cứ cô gái nào cũng muốn người yêu mình mang một mùi hương tuyệt vời như thế này khi đi cùng.', 0, '', '', '2018-08-26', 0, 'L2', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Username`);

--
-- Chỉ mục cho bảng `danhmucsp`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`MaDM`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id_KH`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_sp`);
ALTER TABLE `product` ADD FULLTEXT KEY `tensp` (`tensp`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `id_KH` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
