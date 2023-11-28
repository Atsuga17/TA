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
  `ADMIN_ID` varchar(12) NOT NULL,
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
  `MANAGER_ID` varchar(12) NOT NULL,
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
  `PAYMENT_METHOD_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order`
--
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_method`
--

CREATE TABLE `payment_method` (
  `PAYMENT_METHOD_ID` int(11) NOT NULL,
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
  ADD KEY `FK_RELATIONSHIP_2` (`USER_ID`),
  ADD KEY `FK_RELATIONSHIP_9` (`PAYMENT_METHOD_ID`);

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
  ADD PRIMARY KEY (`PAYMENT_METHOD_ID`),
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
  MODIFY `PAYMENT_METHOD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `FK_RELATIONSHIP_9` FOREIGN KEY (`PAYMENT_METHOD_ID`) REFERENCES `payment_method` (`PAYMENT_METHOD_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
