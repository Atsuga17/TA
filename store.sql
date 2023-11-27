-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2023 pada 07.37
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(8) NOT NULL,
  `ADMIN_NAME` varchar(50) NOT NULL,
  `ADMIN_EMAIL` varchar(255) NOT NULL,
  `ADMIN_ADDRESS` varchar(255) NOT NULL,
  `ADMIN_PHONE` text NOT NULL,
  `ADMIN_PASSWORD` text NOT NULL,
  `ADMIN_PASS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_EMAIL`, `ADMIN_ADDRESS`, `ADMIN_PHONE`, `ADMIN_PASSWORD`, `ADMIN_PASS`) VALUES
('atsuga17', 'Moh Kurnia Agusta', 'kurniaagusta50@gmail.com', 'Jotosanur', '089530456940', '565d29a25fb743299f5cc556cde40c4227943d0b5c895abdb4998cd48062e24a', '73bf498624a0011d6e08f0403ad0d0234e174e215e886bdae4bfbbfc80090be2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `BRAND_ID` varchar(8) NOT NULL,
  `BRAND_NAME` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`BRAND_ID`, `BRAND_NAME`) VALUES
('B0003', 'Hot Wheels'),
('B0004', 'DC'),
('B0005', 'Lego'),
('B0006', 'Barbie'),
('B0007', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `CART_ID` int(11) NOT NULL,
  `USER_ID` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart_detail`
--

CREATE TABLE `cart_detail` (
  `CART_DETAIL_ID` int(11) NOT NULL,
  `PRODUCT_ID` varchar(8) DEFAULT NULL,
  `CART_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `manager`
--

CREATE TABLE `manager` (
  `MANAGER_ID` varchar(8) NOT NULL,
  `MANAGER_NAME` varchar(50) NOT NULL,
  `MANAGER_EMAIL` varchar(255) NOT NULL,
  `MANAGER_ADDRESS` varchar(255) NOT NULL,
  `MANAGER_PHONE` text NOT NULL,
  `MANAGER_PASSWORD` text NOT NULL,
  `MANAGER_PASS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `manager`
--

INSERT INTO `manager` (`MANAGER_ID`, `MANAGER_NAME`, `MANAGER_EMAIL`, `MANAGER_ADDRESS`, `MANAGER_PHONE`, `MANAGER_PASSWORD`, `MANAGER_PASS`) VALUES
('atsuga17', 'Moh Kurnia Agusta', 'kurniaagusta50@gmail.com', 'Jotosanur', '089530456940', '565d29a25fb743299f5cc556cde40c4227943d0b5c895abdb4998cd48062e24a', '012715bb3a6f17e520b3b4b0cd7c7eaee6de733383278cc0844343c6f57d6e48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `ORDER_ID` int(11) NOT NULL,
  `USER_ID` varchar(12) DEFAULT NULL,
  `ORDER_TIME` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `TOTAL` bigint(20) NOT NULL,
  `PAYMENT_STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `PAYMENT_METHOD` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`ORDER_ID`, `USER_ID`, `ORDER_TIME`, `TOTAL`, `PAYMENT_STATUS`, `PAYMENT_METHOD`) VALUES
(38, 'agusta17', '2023-11-25 04:12:44', 3541245, 0, NULL),
(40, 'agusta17', '2023-11-25 04:30:53', 64000, 1, NULL),
(41, 'petarunx17', '2023-11-25 04:27:28', 249000, 1, NULL),
(42, 'petarunx17', '2023-11-25 04:21:42', 358000, 0, NULL),
(43, 'petarunx17', '2023-11-25 04:27:59', 219000, 0, NULL),
(44, 'agusta17', '2023-11-25 04:30:20', 3413245, 0, NULL),
(45, 'agusta17', '2023-11-25 04:31:11', 241000, 1, NULL),
(47, 'agusta17', '2023-11-25 04:32:02', 58000, 0, NULL),
(48, 'agusta17', '2023-11-25 04:32:34', 115000, 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `ORDER_DETAIL_ID` int(11) NOT NULL,
  `ORDER_ID` int(11) DEFAULT NULL,
  `PRODUCT_ID` varchar(8) DEFAULT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`ORDER_DETAIL_ID`, `ORDER_ID`, `PRODUCT_ID`, `QTY`) VALUES
(108, 38, 'P0001', 2),
(109, 38, 'P0005', 2),
(110, 38, 'P0010', 1),
(116, 40, 'P0004', 1),
(117, 40, 'P0007', 1),
(118, 40, 'P0009', 1),
(119, 41, 'P0001', 1),
(120, 41, 'P0004', 1),
(121, 41, 'P0008', 1),
(122, 41, 'P0010', 1),
(123, 42, 'P0003', 1),
(124, 42, 'P0006', 1),
(125, 42, 'P0008', 1),
(126, 42, 'P0009', 1),
(127, 43, 'P0007', 1),
(128, 43, 'P0008', 1),
(129, 43, 'P0010', 1),
(130, 44, 'P0001', 1),
(131, 44, 'P0004', 1),
(132, 44, 'P0006', 1),
(134, 45, 'P0002', 1),
(135, 45, 'P0003', 1),
(136, 45, 'P0009', 1),
(138, 47, 'P0002', 1),
(139, 47, 'P0006', 1),
(140, 48, 'P0002', 1),
(141, 48, 'P0010', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_method`
--

CREATE TABLE `payment_method` (
  `PAYMENT_ID` int(11) NOT NULL,
  `USER_ID` varchar(12) NOT NULL,
  `BANK_NAME` varchar(100) NOT NULL,
  `NOMOR_REKENING` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `PRODUCT_ID` varchar(8) NOT NULL,
  `BRAND_ID` varchar(8) DEFAULT NULL,
  `PRODUCT_NAME` varchar(50) NOT NULL,
  `PRODUCT_IMG` varchar(225) NOT NULL,
  `PRODUCT_STOCK` int(11) NOT NULL,
  `PRODUCT_PRICE` bigint(20) NOT NULL,
  `PRODUCT_DESC` text NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UPDATED_AT` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`PRODUCT_ID`, `BRAND_ID`, `PRODUCT_NAME`, `PRODUCT_IMG`, `PRODUCT_STOCK`, `PRODUCT_PRICE`, `PRODUCT_DESC`, `CREATED_AT`, `UPDATED_AT`) VALUES
('P0001', 'B0003', 'a', 'default.jpeg', 7, 30000, 'sip', '2023-11-25 04:31:46', NULL),
('P0002', 'B0004', 'BH', 'default.jpeg', 11, 26000, 'sip', '2023-11-25 04:35:54', NULL),
('P0003', 'B0005', 'CD', 'default.jpeg', 9, 189000, 'sip', '2023-11-25 04:30:25', NULL),
('P0004', 'B0006', 'D', 'default.jpeg', 95, 19000, 'sip', '2023-11-25 04:31:22', NULL),
('P0005', 'B0003', 'EP', 'default.jpeg', 74, 30000, 'sip', '2023-11-25 04:35:18', NULL),
('P0006', 'B0004', 'F', 'default.jpeg', 77, 32000, 'sip', '2023-11-25 04:31:54', NULL),
('P0007', 'B0005', 'SJ', 'default.jpeg', 10, 19000, 'sip', '2023-11-25 04:36:02', NULL),
('P0008', 'B0005', 'Q', 'default.jpeg', 20, 111000, 'sip', '2023-11-25 04:27:50', NULL),
('P0009', 'B0006', 'R', 'default.jpeg', 440, 26000, '2', '2023-11-25 04:30:28', NULL),
('P0010', 'B0004', 'PC', 'default.jpeg', 63, 89000, 'sip', '2023-11-25 04:35:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `USER_ID` varchar(12) NOT NULL,
  `USER_EMAIL` varchar(255) NOT NULL,
  `USER_NAME` varchar(50) NOT NULL,
  `USER_ADDRESS` varchar(255) NOT NULL,
  `USER_PHONE` text NOT NULL,
  `USER_PASSWORD` text NOT NULL,
  `USER_PASS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`USER_ID`, `USER_EMAIL`, `USER_NAME`, `USER_ADDRESS`, `USER_PHONE`, `USER_PASSWORD`, `USER_PASS`) VALUES
('agusta17', '220411100144@student.trunojoyo.ac.id', 'agusta', 'mars', '089530456949', '565d29a25fb743299f5cc556cde40c4227943d0b5c895abdb4998cd48062e24a', NULL),
('atsuga17', 'kurniaagusta50@gmail.com', 'Moh Kurnia Agusta', 'Jotosanur', '089530456940', '565d29a25fb743299f5cc556cde40c4227943d0b5c895abdb4998cd48062e24a', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'),
('petarunx17', 'kurniaagusta0@gmail.com', 'kuda lumping aseli ponorogo', 'ponorogo', '2147483647', '565d29a25fb743299f5cc556cde40c4227943d0b5c895abdb4998cd48062e24a', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BRAND_ID`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CART_ID`),
  ADD KEY `FK_RELATIONSHIP_6` (`USER_ID`);

--
-- Indeks untuk tabel `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`CART_DETAIL_ID`),
  ADD KEY `FK_RELATIONSHIP_8` (`PRODUCT_ID`),
  ADD KEY `FK_RELATIONSHIP_7` (`CART_ID`);

--
-- Indeks untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`MANAGER_ID`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ORDER_ID`),
  ADD KEY `FK_RELATIONSHIP_2` (`USER_ID`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`ORDER_DETAIL_ID`),
  ADD KEY `FK_RELATIONSHIP_4` (`PRODUCT_ID`),
  ADD KEY `FK_RELATIONSHIP_3` (`ORDER_ID`);

--
-- Indeks untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`PAYMENT_ID`),
  ADD KEY `user memiliki metode pembayaran` (`USER_ID`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PRODUCT_ID`),
  ADD KEY `FK_RELATIONSHIP_5` (`BRAND_ID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `CART_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `CART_DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `ORDER_DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `PAYMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_RELATIONSHIP_6` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `FK_RELATIONSHIP_7` FOREIGN KEY (`CART_ID`) REFERENCES `cart` (`CART_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATIONSHIP_8` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ORDER_ID`) REFERENCES `order` (`ORDER_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `user memiliki metode pembayaran` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`USER_ID`);

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`BRAND_ID`) REFERENCES `brand` (`BRAND_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
