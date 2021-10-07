-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2021 at 10:17 AM
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
-- Structure for view `v_inventori`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventori`  AS SELECT `i`.`id_inventori` AS `id_inventori`, `i`.`kode_unit` AS `kode_unit`, `u`.`nama_unit` AS `nama_unit`, `i`.`kode_sub_unit` AS `kode_sub_unit`, `su`.`nama_sub_unit` AS `nama_sub_unit`, `i`.`kode_inventori` AS `kode_inventori`, `i`.`nama_inventori` AS `nama_inventori`, `i`.`satuan_inventori` AS `satuan_inventori`, `i`.`harga_barang` AS `harga_barang`, `i`.`kategori_inventori` AS `kategori_inventori`, `i`.`jumlah_inventori` AS `jumlah_inventori`, `i`.`qrcode` AS `qrcode`, `i`.`barcode` AS `barcode`, `i`.`created_by` AS `created_by`, `i`.`created_time` AS `created_time`, `i`.`updated_by` AS `updated_by`, `i`.`updated_time` AS `updated_time`, `ki`.`nama_kategori` AS `nama_kategori`, `si`.`nama_satuan` AS `nama_satuan`, `si`.`singkatan_satuan` AS `singkatan_satuan` FROM ((((`e_inventori` `i` join `e_unit` `u` on(`i`.`kode_unit` = `u`.`kode_unit`)) join `e_sub_unit` `su` on(`i`.`kode_sub_unit` = `su`.`kode_sub_unit` and `su`.`unit` = `u`.`id_unit`)) join `e_kategori_inventori` `ki` on(`i`.`kategori_inventori` = `ki`.`id_kategori`)) join `e_satuan_inventori` `si` on(`i`.`satuan_inventori` = `si`.`id_satuan`)) ;

--
-- VIEW `v_inventori`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
