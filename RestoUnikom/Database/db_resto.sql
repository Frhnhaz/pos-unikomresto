-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 05:08 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_resto`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bayar`
--

CREATE TABLE `tb_bayar` (
  `id_bayar` bigint(19) NOT NULL,
  `nominal_uang` bigint(19) DEFAULT NULL,
  `total_bayar` bigint(19) DEFAULT NULL,
  `waktu_bayar` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_bayar`
--

INSERT INTO `tb_bayar` (`id_bayar`, `nominal_uang`, `total_bayar`, `waktu_bayar`) VALUES
(2308111040685, 50000, 45000, '2023-08-11 06:56:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_menu`
--

CREATE TABLE `tb_kategori_menu` (
  `id_kat_menu` int(11) NOT NULL,
  `jenis_menu` int(1) DEFAULT NULL,
  `kategori_menu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori_menu`
--

INSERT INTO `tb_kategori_menu` (`id_kat_menu`, `jenis_menu`, `kategori_menu`) VALUES
(6, 1, 'Appetizer'),
(7, 1, 'Main Course'),
(8, 1, 'Dessert'),
(12, 1, 'Makanan Ringan'),
(13, 2, 'Minuman Dingin'),
(14, 2, 'Minuman Panas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_list_order`
--

CREATE TABLE `tb_list_order` (
  `id_list_order` int(11) NOT NULL,
  `menu` int(11) DEFAULT NULL,
  `kode_order` bigint(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` varchar(300) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_list_order`
--

INSERT INTO `tb_list_order` (`id_list_order`, `menu`, `kode_order`, `jumlah`, `catatan`, `status`) VALUES
(5, 26, 2308111040685, 3, '', 2),
(6, 28, 2308111722384, 1, '', 2),
(7, 28, 2308120805142, 50, 'Tidak pakai sambal', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `nama_menu` varchar(200) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `kategori` int(5) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id`, `foto`, `nama_menu`, `keterangan`, `kategori`, `harga`) VALUES
(26, '69543-nasigoreng.jpeg', 'Nasi Goreng', 'Nasi Goreng Biasa', 7, '15000'),
(27, '55536-nasi.jpeg', 'Nasi', 'Nasi', 7, '3000'),
(28, '65908-jusmangga.jpg', 'Jus Mangga', 'Jus Mangga', 13, '8000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` bigint(20) NOT NULL DEFAULT 0,
  `pelanggan` varchar(200) DEFAULT NULL,
  `meja` int(11) DEFAULT NULL,
  `pelayan` int(5) DEFAULT NULL,
  `waktu_order` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `pelanggan`, `meja`, `pelayan`, `waktu_order`) VALUES
(2308111040685, 'Budi', 1, 1, '2023-08-11 03:40:20'),
(2308111722384, 'Rudi', 2, 1, '2023-08-11 10:24:20'),
(2308120805142, 'Koko', 5, 1, '2023-08-12 01:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `level` int(1) NOT NULL DEFAULT 2,
  `nohp` varchar(50) DEFAULT NULL,
  `alamat` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `level`, `nohp`, `alamat`) VALUES
(1, 'Administrator', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '08273634723', 'jl.i'),
(2, 'Kasir', 'kasir@kasir.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '08273634723', NULL),
(3, 'Pelayan', 'pelayan@pelayan.com', '5f4dcc3b5aa765d61d8327deb882cf99', 3, '08273634723', NULL),
(4, 'Dapur', 'dapur@dapur.com', '5f4dcc3b5aa765d61d8327deb882cf99', 4, '08273634723', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bayar`
--
ALTER TABLE `tb_bayar`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  ADD PRIMARY KEY (`id_kat_menu`) USING BTREE;

--
-- Indexes for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD PRIMARY KEY (`id_list_order`),
  ADD KEY `menu` (`menu`),
  ADD KEY `order` (`kode_order`) USING BTREE;

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `FK_tb_menu_tb_kategori_menu` (`kategori`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`) USING BTREE,
  ADD KEY `pelayan` (`pelayan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori_menu`
--
ALTER TABLE `tb_kategori_menu`
  MODIFY `id_kat_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  MODIFY `id_list_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_menu`
--
ALTER TABLE `tb_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_list_order`
--
ALTER TABLE `tb_list_order`
  ADD CONSTRAINT `FK__tb_menu` FOREIGN KEY (`menu`) REFERENCES `tb_menu` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_tb_list_order_tb_order` FOREIGN KEY (`kode_order`) REFERENCES `tb_order` (`id_order`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD CONSTRAINT `FK_tb_menu_tb_kategori_menu` FOREIGN KEY (`kategori`) REFERENCES `tb_kategori_menu` (`id_kat_menu`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD CONSTRAINT `FK_tb_order_tb_user` FOREIGN KEY (`pelayan`) REFERENCES `tb_user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
