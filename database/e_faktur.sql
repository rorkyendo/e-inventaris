-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2021 at 06:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-inventori`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_faktur`
--

CREATE TABLE `e_faktur` (
  `id_faktur` int(11) NOT NULL,
  `kode_faktur` varchar(20) DEFAULT NULL,
  `catatan_faktur` varchar(250) NOT NULL,
  `kategori_faktur` enum('in','out') NOT NULL,
  `status_keluar` enum('pinjam','rusak') DEFAULT NULL,
  `status_approval` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `approval_by` int(11) DEFAULT NULL,
  `approval_time` datetime DEFAULT NULL,
  `qrcode_faktur` varchar(250) DEFAULT NULL,
  `barcode_faktur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_faktur`
--

INSERT INTO `e_faktur` (`id_faktur`, `kode_faktur`, `catatan_faktur`, `kategori_faktur`, `status_keluar`, `status_approval`, `created_by`, `created_time`, `updated_by`, `updated_time`, `approval_by`, `approval_time`, `qrcode_faktur`, `barcode_faktur`) VALUES
(14, NULL, 'Faktur dari toko A', 'in', NULL, 'accept', 1, '2021-06-12 11:26:59', 1, '2021-06-12 12:02:18', 1, '2021-06-12 12:02:18', 'assets/img/qrfaktur/Faktur-14.png', NULL),
(16, NULL, 'Pemesanan Barang dari TOKO A', 'out', NULL, 'accept', 1, '2021-06-12 15:32:45', 1, '2021-06-12 15:40:52', 1, '2021-06-12 15:40:52', 'assets/img/qrfaktur/Faktur-16.png', NULL),
(17, NULL, 'Faktur Masuk dari Toko B', 'in', NULL, 'accept', 1, '2021-06-12 15:42:53', 1, '2021-06-12 15:43:11', 1, '2021-06-12 15:43:11', 'assets/img/qrfaktur/Faktur-17.png', NULL),
(18, NULL, 'Pemesanan Barang dari TOKO A', 'out', NULL, 'accept', 1, '2021-06-12 15:43:46', 1, '2021-06-12 15:44:54', 1, '2021-06-12 15:44:54', 'assets/img/qrfaktur/Faktur-18.png', NULL),
(19, 'A123', 'Penambahan Barang dari Supplier A', 'in', NULL, 'pending', 1, '2021-10-04 12:52:56', 1, '2021-10-04 15:58:32', NULL, NULL, 'assets/img/qrfaktur/Faktur-19.png', NULL),
(20, NULL, 'Testing', 'in', NULL, 'pending', 1, '2021-10-04 13:21:50', NULL, NULL, NULL, NULL, 'assets/img/qrfaktur/Faktur-20.png', NULL),
(21, 'A1234', 'Percobaan', 'in', NULL, 'accept', 1, '2021-10-04 16:01:13', 1, '2021-10-04 22:51:07', 1, '2021-10-04 22:51:07', 'assets/img/qrfaktur/Faktur-21.png', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_faktur`
--
ALTER TABLE `e_faktur`
  ADD PRIMARY KEY (`id_faktur`),
  ADD KEY `FK_faktur_created` (`created_by`),
  ADD KEY `FK_faktur_updated` (`updated_by`),
  ADD KEY `FK_e_faktur_e_pengguna` (`approval_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_faktur`
--
ALTER TABLE `e_faktur`
  MODIFY `id_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `e_faktur`
--
ALTER TABLE `e_faktur`
  ADD CONSTRAINT `FK_e_faktur_e_pengguna` FOREIGN KEY (`approval_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_faktur_created` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_faktur_updated` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
