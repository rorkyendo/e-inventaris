-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 07, 2021 at 07:00 PM
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
-- Table structure for table `e_detail_faktur`
--

CREATE TABLE `e_detail_faktur` (
  `id_detail_faktur` int(11) NOT NULL,
  `id_faktur` int(11) NOT NULL,
  `id_inventori` int(11) NOT NULL,
  `jumlah_inventori` int(11) NOT NULL,
  `harga_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_detail_faktur`
--

INSERT INTO `e_detail_faktur` (`id_detail_faktur`, `id_faktur`, `id_inventori`, `jumlah_inventori`, `harga_barang`) VALUES
(25, 20, 10, 200, 20000),
(27, 19, 10, 10, 100000),
(28, 21, 10, 100, 1000),
(29, 21, 12, 100, 1000);

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

-- --------------------------------------------------------

--
-- Table structure for table `e_hak_akses`
--

CREATE TABLE `e_hak_akses` (
  `id_hak_akses` int(11) NOT NULL,
  `nama_hak_akses` varchar(225) NOT NULL,
  `modul_akses` text NOT NULL,
  `parent_modul_akses` text DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_hak_akses`
--

INSERT INTO `e_hak_akses` (`id_hak_akses`, `nama_hak_akses`, `modul_akses`, `parent_modul_akses`, `created_time`) VALUES
(1, 'superuser', '{\n    \"modul\": [\n        \"pengguna\",\n        \"createPengguna\",\n        \"updatePengguna\",\n        \"deletePengguna\",\n        \"hakAkses\",\n        \"createHakAkses\",\n        \"updateHakAkses\",\n        \"deleteHakAkses\",\n        \"daftarUnit\",\n        \"tambahUnit\",\n        \"updateUnit\",\n        \"deleteUnit\",\n        \"daftarSubUnit\",\n        \"tambahSubUnit\",\n        \"updateSubUnit\",\n        \"deleteSubUnit\",\n        \"listInventori\",\n        \"createInventori\",\n        \"updateInventori\",\n        \"deleteInventori\",\n        \"kategori\",\n        \"createKategori\",\n        \"updateKategori\",\n        \"deleteKategori\",\n        \"satuan\",\n        \"createSatuan\",\n        \"updateSatuan\",\n        \"deleteSatuan\",\n        \"inventoriMasuk\",\n        \"createInventoriMasuk\",\n        \"updateInventoriMasuk\",\n        \"deleteInventoriMasuk\",\n        \"approveInventoriMasuk\",\n        \"inventoriKeluar\",\n        \"createInventoriKeluar\",\n        \"updateInventoriKeluar\",\n        \"deleteInventoriKeluar\",\n        \"approveInventoriKeluar\",\n        \"detailInventori\",\n        \"detailInventoriMasuk\",\n        \"detailInventoriKeluar\",\n        \"rejectInventoriMasuk\",\n        \"rejectInventoriKeluar\",\n        \"scanInventori\",\n        \"scanFaktur\",\n        \"identitasAplikasi\",\n        \"daftarModul\"\n    ]\n}', '{\n    \"parent_modul\": [\n        \"Dashboard\",\n        \"MasterData\",\n        \"Inventori\",\n        \"Scan\",\n        \"Pengaturan\"\n    ]\n}', '2021-06-10 09:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `e_identitas`
--

CREATE TABLE `e_identitas` (
  `id_profile` int(11) NOT NULL,
  `apps_name` varchar(225) NOT NULL,
  `apps_version` varchar(225) NOT NULL,
  `apps_code` varchar(5) DEFAULT NULL,
  `agency` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `telephon` varchar(225) DEFAULT NULL,
  `fax` varchar(225) DEFAULT NULL,
  `website` varchar(225) DEFAULT NULL,
  `header` varchar(225) DEFAULT NULL,
  `footer` varchar(225) DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `logo` varchar(225) DEFAULT 'NULL',
  `icon` varchar(225) DEFAULT NULL,
  `sidebar_login` varchar(225) DEFAULT NULL,
  `about_us` text DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `e_identitas`
--

INSERT INTO `e_identitas` (`id_profile`, `apps_name`, `apps_version`, `apps_code`, `agency`, `address`, `city`, `telephon`, `fax`, `website`, `header`, `footer`, `keyword`, `logo`, `icon`, `sidebar_login`, `about_us`, `email`) VALUES
(1, 'eInventaris', '1.0', 'eis', '| V1.0', '', '', '', '', '', '', '', '', 'assets/img/Logo_FasilkomTI_USU_Baru.png', 'assets/img/favicon.ico', 'assets/img/sidebar.jpg', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_inventori`
--

CREATE TABLE `e_inventori` (
  `id_inventori` int(11) NOT NULL,
  `kode_unit` varchar(20) DEFAULT NULL,
  `kode_sub_unit` varchar(20) DEFAULT NULL,
  `kode_inventori` varchar(50) NOT NULL,
  `nama_inventori` varchar(250) NOT NULL,
  `satuan_inventori` int(11) NOT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `kategori_inventori` int(11) NOT NULL,
  `jumlah_inventori` int(11) DEFAULT NULL,
  `qrcode` varchar(250) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_inventori`
--

INSERT INTO `e_inventori` (`id_inventori`, `kode_unit`, `kode_sub_unit`, `kode_inventori`, `nama_inventori`, `satuan_inventori`, `harga_barang`, `kategori_inventori`, `jumlah_inventori`, `qrcode`, `barcode`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
(10, 'GF1', 'RA1', 'KRS', 'Kursi', 1, 1000, 3, 200, 'assets/img/qrbarang/GF1RA1KRS.png', NULL, 1, '2021-10-02 10:57:25', 1, '2021-10-04 13:14:40'),
(12, 'GF2', 'RA1', 'KRS', 'Kursi', 1, 1000, 3, 1100, 'assets/img/qrbarang/GF2RA1KRS.png', NULL, 1, '2021-10-04 13:11:14', 1, '2021-10-04 13:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `e_kategori_inventori`
--

CREATE TABLE `e_kategori_inventori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_kategori_inventori`
--

INSERT INTO `e_kategori_inventori` (`id_kategori`, `nama_kategori`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
(1, 'Barang Non Produksi', 1, '2021-06-11 08:59:20', 1, '2021-06-11 09:02:18'),
(2, 'Barang Produksi', 1, '2021-06-11 15:06:23', NULL, NULL),
(3, 'Fasilitas Kampus', 1, '2021-10-02 08:55:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_modul`
--

CREATE TABLE `e_modul` (
  `id_modul` int(11) NOT NULL,
  `controller_modul` varchar(225) NOT NULL,
  `nama_modul` varchar(225) NOT NULL,
  `link_modul` varchar(225) NOT NULL,
  `type_modul` varchar(20) NOT NULL,
  `class_parent_modul` varchar(225) DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `tampil_sidebar` enum('Y','N') NOT NULL,
  `child_module` enum('Y','N') NOT NULL DEFAULT 'N',
  `induk_child_modul` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_modul`
--

INSERT INTO `e_modul` (`id_modul`, `controller_modul`, `nama_modul`, `link_modul`, `type_modul`, `class_parent_modul`, `created_time`, `tampil_sidebar`, `child_module`, `induk_child_modul`) VALUES
(1, 'pengguna', 'Daftar Pengguna', 'panel/masterdata/pengguna', 'R', 'MasterData', '2021-06-10 07:59:17', 'Y', 'N', NULL),
(2, 'createPengguna', 'Tambah Pengguna', 'panel/masterdata/createPengguna', 'C', 'MasterData', '2021-06-10 08:00:06', 'N', 'N', NULL),
(3, 'updatePengguna', 'Update Pengguna', 'panel/masterdata/updatePengguna', 'U', 'MasterData', '2021-06-10 08:00:37', 'N', 'N', NULL),
(4, 'deletePengguna', 'Delete Pengguna', 'panel/masterdata/deletePengguna', 'D', 'MasterData', '2021-06-10 08:01:06', 'N', 'N', NULL),
(5, 'hakAkses', 'Daftar Hak Akses', 'panel/masterdata/hakAkses', 'R', 'MasterData', '2021-06-10 08:01:37', 'Y', 'N', NULL),
(6, 'createHakAkses', 'Tambah Hak Akses', 'panel/masterdata/createHakAkses', 'C', 'MasterData', '2021-06-10 08:02:11', 'N', 'N', NULL),
(7, 'updateHakAkses', 'Update Hak Akses', 'panel/masterdata/updateHakAkses', 'U', 'MasterData', '2021-06-10 08:02:33', 'N', 'N', NULL),
(8, 'deleteHakAkses', 'Delete Hak Akses', 'panel/masterdata/deleteHakAkses', 'D', 'MasterData', '2021-06-10 08:02:57', 'N', 'N', NULL),
(9, 'listInventori', 'Daftar Inventori', 'panel/inventori/listInventori', 'R', 'Inventori', '2021-06-10 08:03:50', 'Y', 'N', NULL),
(10, 'createInventori', 'Tambah Inventori', 'panel/inventori/createInventori', 'C', 'Inventori', '2021-06-10 08:04:10', 'N', 'N', NULL),
(11, 'updateInventori', 'Update Inventori', 'panel/inventori/updateInventori', 'U', 'Inventori', '2021-06-10 08:04:31', 'N', 'N', NULL),
(12, 'deleteInventori', 'Delete Inventori', 'panel/inventori/deleteInventori', 'D', 'Inventori', '2021-06-10 08:04:56', 'N', 'N', NULL),
(13, 'kategori', 'Daftar Kategori Inventori', 'panel/inventori/kategori', 'R', 'Inventori', '2021-06-10 08:05:36', 'Y', 'N', NULL),
(14, 'createKategori', 'Tambah Kategori Inventori', 'panel/inventori/createKategori', 'C', 'Inventori', '2021-06-10 08:06:02', 'N', 'N', NULL),
(15, 'updateKategori', 'Update Kategori', 'panel/inventori/updateKategori', 'U', 'Inventori', '2021-06-10 08:06:21', 'N', 'N', NULL),
(16, 'deleteKategori', 'Delete Kategori Inventori', 'panel/inventori/deleteKategori', 'D', 'Inventori', '2021-06-10 08:06:40', 'N', 'N', NULL),
(17, 'satuan', 'Daftar Satuan Inventori', 'panel/inventori/satuan', 'R', 'Inventori', '2021-06-10 08:07:01', 'Y', 'N', NULL),
(18, 'createSatuan', 'Tambah Satuan Inventori', 'panel/inventori/satuan', 'C', 'Inventori', '2021-06-10 08:07:21', 'N', 'N', NULL),
(19, 'updateSatuan', 'Update Satuan Inventori', 'panel/inventori/updateSatuan', 'U', 'Inventori', '2021-06-10 08:07:38', 'N', 'N', NULL),
(20, 'deleteSatuan', 'Delete Satuan Inventori', 'panel/inventori/deleteSatuan', 'D', 'Inventori', '2021-06-10 08:17:24', 'N', 'N', NULL),
(21, 'inventoriMasuk', 'Daftar Inventori Masuk', 'panel/inventori/inventoriMasuk', 'R', 'Inventori', '2021-06-10 08:18:01', 'Y', 'N', NULL),
(22, 'createInventoriMasuk', 'Tambah Inventori Masuk', 'panel/inventori/createInventoriMasuk', 'C', 'Inventori', '2021-06-10 08:29:24', 'N', 'N', NULL),
(23, 'updateInventoriMasuk', 'Update Inventori Masuk', 'panel/inventori/updateInventoriMasuk', 'U', 'Inventori', '2021-06-10 08:29:50', 'N', 'N', NULL),
(24, 'deleteInventoriMasuk', 'Delete Inventori Masuk', 'panel/inventori/deleteInventoriMasuk', 'D', 'Inventori', '2021-06-10 08:30:09', 'N', 'N', NULL),
(25, 'approveInventoriMasuk', 'Approve Inventori Masuk', 'panel/inventori/approveInventoriMasuk', 'U', 'Inventori', '2021-06-10 08:30:49', 'N', 'N', NULL),
(26, 'inventoriKeluar', 'Daftar Inventori Keluar', 'panel/inventori/inventoriKeluar', 'R', 'Inventori', '2021-06-10 08:31:16', 'Y', 'N', NULL),
(27, 'createInventoriKeluar', 'Tambah Inventori Keluar', 'panel/inventori/createInventoriKeluar', 'C', 'Inventori', '2021-06-10 08:31:38', 'N', 'N', NULL),
(28, 'updateInventoriKeluar', 'Update Inventori Keluar', 'panel/inventori/updateInventoriKeluar', 'U', 'Inventori', '2021-06-10 08:31:58', 'N', 'N', NULL),
(29, 'deleteInventoriKeluar', 'Delete Inventori Keluar', 'panel/inventori/deleteInventoriKeluar', 'D', 'Inventori', '2021-06-10 08:32:20', 'N', 'N', NULL),
(30, 'approveInventoriKeluar', 'Approve Inventori Keluar', 'panel/inventori/approveInventoriKeluar', 'U', 'Inventori', '2021-06-10 08:32:46', 'N', 'N', NULL),
(31, 'identitasAplikasi', 'Identitas Aplikasi', 'panel/pengaturan/identitasAplikasi', 'U', 'Pengaturan', '2021-06-10 08:33:19', 'Y', 'N', NULL),
(32, 'daftarModul', 'Daftar Modul', 'panel/pengaturan/daftarModul', 'R', 'Pengaturan', '2021-06-10 08:33:43', 'Y', 'N', NULL),
(33, 'detailInventori', 'Detail inventori', 'panel/inventori/detailInventori', 'R', 'Inventori', '2021-06-11 23:51:22', 'N', 'N', NULL),
(34, 'detailInventoriMasuk', 'Detail Inventori Masuk', 'panel/inventori/detailInventoriMasuk', 'R', 'Inventori', '2021-06-12 11:24:29', 'N', 'N', NULL),
(35, 'detailInventoriKeluar', 'Detail Inventori Keluar', 'panel/inventori/detailInventoriKeluar', 'R', 'Inventori', '2021-06-12 11:24:57', 'N', 'N', NULL),
(36, 'rejectInventoriMasuk', 'Reject Inventori Masuk', 'panel/inventori/rejectInventoriKeluar', 'U', 'Inventori', '2021-06-12 11:49:06', 'N', 'N', NULL),
(37, 'rejectInventoriKeluar', 'Reject Inventori Keluar', 'panel/inventori/rejectInventoriKeluar', 'U', 'Inventori', '2021-06-12 11:49:32', 'N', 'N', NULL),
(38, 'daftarUnit', 'Daftar Unit', 'panel/masterData/daftarUnit', 'R', 'MasterData', '2021-10-01 14:10:07', 'Y', 'N', NULL),
(39, 'tambahUnit', 'Tambah Unit', 'panel/masterData/tambahUnit', 'C', 'MasterData', '2021-10-01 14:10:32', 'N', 'N', NULL),
(40, 'updateUnit', 'Update Unit', 'panel/masterData/updateUnit', 'U', 'MasterData', '2021-10-01 14:10:49', 'N', 'N', NULL),
(41, 'deleteUnit', 'Delete Unit', 'panel/masterData/deleteUnit', 'D', 'MasterData', '2021-10-01 14:11:05', 'N', 'N', NULL),
(42, 'daftarSubUnit', 'Daftar Sub Unit', 'panel/masterData/daftarSubUnit', 'R', 'MasterData', '2021-10-01 14:37:35', 'Y', 'N', NULL),
(43, 'tambahSubUnit', 'Tambah Sub Unit', 'panel/masterData/tambahSubUnit', 'C', 'MasterData', '2021-10-01 14:38:05', 'N', 'N', NULL),
(44, 'updateSubUnit', 'Update Sub Unit', 'panel/masterData/updateSubUnit', 'U', 'MasterData', '2021-10-01 14:38:36', 'N', 'N', NULL),
(45, 'deleteSubUnit', 'Delete Sub Unit', 'panel/masterData/deleteSubUnit', 'D', 'MasterData', '2021-10-01 14:39:07', 'N', 'N', NULL),
(46, 'scanInventori', 'Scan Inventori', 'panel/scan/scanInventori', 'R', 'Scan', '2021-10-05 08:21:18', 'Y', 'N', NULL),
(47, 'scanFaktur', 'Scan Faktur', 'panel/scan/scanFaktur', 'R', 'Scan', '2021-10-05 08:21:37', 'Y', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_parent_modul`
--

CREATE TABLE `e_parent_modul` (
  `id_parent_modul` int(11) NOT NULL,
  `class` varchar(225) DEFAULT NULL,
  `nama_parent_modul` varchar(225) NOT NULL,
  `urutan` int(11) NOT NULL,
  `icon` varchar(225) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `child_module` enum('Y','N') NOT NULL,
  `link` varchar(225) NOT NULL,
  `tampil_sidebar_parent` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_parent_modul`
--

INSERT INTO `e_parent_modul` (`id_parent_modul`, `class`, `nama_parent_modul`, `urutan`, `icon`, `created_time`, `child_module`, `link`, `tampil_sidebar_parent`) VALUES
(1, 'Dashboard', 'Dashboard', 1, 'fa fa-dashboard', '2021-06-10 07:57:29', 'N', 'panel/dashboard', 'Y'),
(2, 'MasterData', 'Master Data', 2, 'fa fa-desktop', '2021-06-10 07:57:59', 'Y', '#', 'Y'),
(3, 'Inventori', 'Inventori', 3, 'fa fa-list', '2021-06-10 07:58:18', 'Y', '#', 'Y'),
(4, 'Pengaturan', 'Pengaturan', 5, 'fa fa-cog', '2021-06-10 07:58:35', 'Y', '#', 'Y'),
(5, 'Scan', 'Scan', 4, 'fa fa-qrcode', '2021-10-05 08:20:41', 'Y', '#', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `e_pengguna`
--

CREATE TABLE `e_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hak_akses` varchar(250) NOT NULL,
  `nama_lengkap` varchar(250) NOT NULL,
  `foto_pengguna` varchar(250) DEFAULT NULL,
  `no_wa` varchar(20) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `sub_unit` int(11) DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_pengguna`
--

INSERT INTO `e_pengguna` (`id_pengguna`, `username`, `password`, `email`, `hak_akses`, `nama_lengkap`, `foto_pengguna`, `no_wa`, `unit`, `sub_unit`, `jenkel`, `tgl_lahir`, `alamat`, `last_login`, `last_logout`, `created_time`, `created_by`, `updated_time`, `updated_by`) VALUES
(1, 'superuser', '72d8f949d00e431239b993f14b70d80d5313efc9', 'test@mail.com', 'superuser', 'superuser', '', NULL, NULL, NULL, 'L', NULL, NULL, '2021-10-07 23:52:12', '2021-10-01 15:12:28', '2021-06-10 09:32:44', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_satuan_inventori`
--

CREATE TABLE `e_satuan_inventori` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(250) NOT NULL,
  `singkatan_satuan` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_satuan_inventori`
--

INSERT INTO `e_satuan_inventori` (`id_satuan`, `nama_satuan`, `singkatan_satuan`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
(1, 'Pieces', 'Pcs', 1, '2021-06-11 09:16:36', 1, '2021-10-02 08:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `e_sub_unit`
--

CREATE TABLE `e_sub_unit` (
  `id_sub_unit` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `nama_sub_unit` varchar(250) NOT NULL,
  `kode_sub_unit` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_sub_unit`
--

INSERT INTO `e_sub_unit` (`id_sub_unit`, `unit`, `nama_sub_unit`, `kode_sub_unit`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
(1, 2, 'Ruang A1', 'RA1', 1, '2021-10-02 08:30:46', NULL, NULL),
(2, 3, 'Ruang A1', 'RA1', 1, '2021-10-02 08:31:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `e_unit`
--

CREATE TABLE `e_unit` (
  `id_unit` int(11) NOT NULL,
  `nama_unit` varchar(250) NOT NULL,
  `alamat_unit` text DEFAULT NULL,
  `kode_unit` varchar(20) NOT NULL,
  `created_time` int(11) NOT NULL,
  `created_by` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_unit`
--

INSERT INTO `e_unit` (`id_unit`, `nama_unit`, `alamat_unit`, `kode_unit`, `created_time`, `created_by`, `updated_by`, `updated_time`) VALUES
(2, 'Gedung Fakultas 1', 'Jalanin aja dulu', 'GF1', 0, '0000-00-00 00:00:00', NULL, NULL),
(3, 'Gedung Fakultas 2', 'Jalan doang gk ngapa2in', 'GF2', 0, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_inventori`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_inventori` (
`id_inventori` int(11)
,`kode_unit` varchar(20)
,`kode_sub_unit` varchar(20)
,`kode_inventori` varchar(50)
,`nama_inventori` varchar(250)
,`satuan_inventori` int(11)
,`harga_barang` int(11)
,`kategori_inventori` int(11)
,`jumlah_inventori` int(11)
,`kategori_faktur` enum('in','out')
,`status_keluar` enum('pinjam','rusak')
,`created_by` int(11)
,`created_time` datetime
,`updated_by` int(11)
,`updated_time` datetime
,`id_faktur` int(11)
,`jumlah_inventori_faktur` int(11)
,`singkatan_satuan` varchar(20)
,`harga_barang_faktur` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_faktur`
-- (See below for the actual view)
--
CREATE TABLE `v_faktur` (
`id_faktur` int(11)
,`kode_faktur` varchar(20)
,`catatan_faktur` varchar(250)
,`kategori_faktur` enum('in','out')
,`status_keluar` enum('pinjam','rusak')
,`status_approval` enum('pending','accept','reject')
,`created_by` int(11)
,`created_time` datetime
,`updated_by` int(11)
,`updated_time` datetime
,`approval_time` datetime
,`qrcode_faktur` varchar(250)
,`barcode_faktur` varchar(255)
,`total_belanja` decimal(42,0)
,`pembuat_faktur` varchar(250)
,`pengaprove_faktur` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_inventori`
-- (See below for the actual view)
--
CREATE TABLE `v_inventori` (
`id_inventori` int(11)
,`kode_unit` varchar(20)
,`nama_unit` varchar(250)
,`kode_sub_unit` varchar(20)
,`nama_sub_unit` varchar(250)
,`kode_inventori` varchar(50)
,`nama_inventori` varchar(250)
,`satuan_inventori` int(11)
,`harga_barang` int(11)
,`kategori_inventori` int(11)
,`jumlah_inventori` int(11)
,`qrcode` varchar(250)
,`barcode` varchar(255)
,`created_by` int(11)
,`created_time` datetime
,`updated_by` int(11)
,`updated_time` datetime
,`nama_kategori` varchar(250)
,`nama_satuan` varchar(250)
,`singkatan_satuan` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pengguna`
-- (See below for the actual view)
--
CREATE TABLE `v_pengguna` (
`id_pengguna` int(11)
,`username` varchar(250)
,`password` varchar(250)
,`email` varchar(250)
,`hak_akses` varchar(250)
,`nama_lengkap` varchar(250)
,`foto_pengguna` varchar(250)
,`no_wa` varchar(20)
,`unit` int(11)
,`sub_unit` int(11)
,`jenkel` enum('L','P')
,`tgl_lahir` date
,`alamat` varchar(250)
,`last_login` datetime
,`last_logout` datetime
,`created_time` datetime
,`created_by` int(11)
,`updated_time` datetime
,`updated_by` int(11)
,`nama_unit` varchar(250)
,`nama_sub_unit` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sub_unit`
-- (See below for the actual view)
--
CREATE TABLE `v_sub_unit` (
`id_sub_unit` int(11)
,`unit` int(11)
,`nama_sub_unit` varchar(250)
,`kode_sub_unit` varchar(20)
,`created_by` int(11)
,`created_time` datetime
,`updated_by` int(11)
,`updated_time` datetime
,`kode_unit` varchar(20)
,`nama_unit` varchar(250)
);

-- --------------------------------------------------------

--
-- Structure for view `v_detail_inventori`
--
DROP TABLE IF EXISTS `v_detail_inventori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_inventori`  AS SELECT `ei`.`id_inventori` AS `id_inventori`, `ei`.`kode_unit` AS `kode_unit`, `ei`.`kode_sub_unit` AS `kode_sub_unit`, `ei`.`kode_inventori` AS `kode_inventori`, `ei`.`nama_inventori` AS `nama_inventori`, `ei`.`satuan_inventori` AS `satuan_inventori`, `ei`.`harga_barang` AS `harga_barang`, `ei`.`kategori_inventori` AS `kategori_inventori`, `ei`.`jumlah_inventori` AS `jumlah_inventori`, `f`.`kategori_faktur` AS `kategori_faktur`, `f`.`status_keluar` AS `status_keluar`, `ei`.`created_by` AS `created_by`, `ei`.`created_time` AS `created_time`, `ei`.`updated_by` AS `updated_by`, `ei`.`updated_time` AS `updated_time`, `df`.`id_faktur` AS `id_faktur`, `df`.`jumlah_inventori` AS `jumlah_inventori_faktur`, `s`.`singkatan_satuan` AS `singkatan_satuan`, `df`.`harga_barang` AS `harga_barang_faktur` FROM (((`e_detail_faktur` `df` join `e_inventori` `ei` on(`df`.`id_inventori` = `ei`.`id_inventori`)) join `e_satuan_inventori` `s` on(`s`.`id_satuan` = `ei`.`satuan_inventori`)) join `e_faktur` `f` on(`f`.`id_faktur` = `df`.`id_faktur`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_faktur`
--
DROP TABLE IF EXISTS `v_faktur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_faktur`  AS SELECT `f`.`id_faktur` AS `id_faktur`, `f`.`kode_faktur` AS `kode_faktur`, `f`.`catatan_faktur` AS `catatan_faktur`, `f`.`kategori_faktur` AS `kategori_faktur`, `f`.`status_keluar` AS `status_keluar`, `f`.`status_approval` AS `status_approval`, `f`.`created_by` AS `created_by`, `f`.`created_time` AS `created_time`, `f`.`updated_by` AS `updated_by`, `f`.`updated_time` AS `updated_time`, `f`.`approval_time` AS `approval_time`, `f`.`qrcode_faktur` AS `qrcode_faktur`, `f`.`barcode_faktur` AS `barcode_faktur`, sum(`df`.`harga_barang` * `df`.`jumlah_inventori`) AS `total_belanja`, `p`.`nama_lengkap` AS `pembuat_faktur`, `p2`.`nama_lengkap` AS `pengaprove_faktur` FROM (((`e_faktur` `f` join `e_detail_faktur` `df` on(`f`.`id_faktur` = `df`.`id_faktur`)) join `e_pengguna` `p` on(`p`.`id_pengguna` = `f`.`created_by`)) left join `e_pengguna` `p2` on(`p2`.`id_pengguna` = `f`.`approval_by`)) GROUP BY `df`.`id_faktur` ;

-- --------------------------------------------------------

--
-- Structure for view `v_inventori`
--
DROP TABLE IF EXISTS `v_inventori`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventori`  AS SELECT `i`.`id_inventori` AS `id_inventori`, `i`.`kode_unit` AS `kode_unit`, `u`.`nama_unit` AS `nama_unit`, `i`.`kode_sub_unit` AS `kode_sub_unit`, `su`.`nama_sub_unit` AS `nama_sub_unit`, `i`.`kode_inventori` AS `kode_inventori`, `i`.`nama_inventori` AS `nama_inventori`, `i`.`satuan_inventori` AS `satuan_inventori`, `i`.`harga_barang` AS `harga_barang`, `i`.`kategori_inventori` AS `kategori_inventori`, `i`.`jumlah_inventori` AS `jumlah_inventori`, `i`.`qrcode` AS `qrcode`, `i`.`barcode` AS `barcode`, `i`.`created_by` AS `created_by`, `i`.`created_time` AS `created_time`, `i`.`updated_by` AS `updated_by`, `i`.`updated_time` AS `updated_time`, `ki`.`nama_kategori` AS `nama_kategori`, `si`.`nama_satuan` AS `nama_satuan`, `si`.`singkatan_satuan` AS `singkatan_satuan` FROM ((((`e_inventori` `i` join `e_unit` `u` on(`i`.`kode_unit` = `u`.`kode_unit`)) join `e_sub_unit` `su` on(`i`.`kode_sub_unit` = `su`.`kode_sub_unit` and `su`.`unit` = `u`.`id_unit`)) join `e_kategori_inventori` `ki` on(`i`.`kategori_inventori` = `ki`.`id_kategori`)) join `e_satuan_inventori` `si` on(`i`.`satuan_inventori` = `si`.`id_satuan`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pengguna`
--
DROP TABLE IF EXISTS `v_pengguna`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengguna`  AS SELECT `p`.`id_pengguna` AS `id_pengguna`, `p`.`username` AS `username`, `p`.`password` AS `password`, `p`.`email` AS `email`, `p`.`hak_akses` AS `hak_akses`, `p`.`nama_lengkap` AS `nama_lengkap`, `p`.`foto_pengguna` AS `foto_pengguna`, `p`.`no_wa` AS `no_wa`, `p`.`unit` AS `unit`, `p`.`sub_unit` AS `sub_unit`, `p`.`jenkel` AS `jenkel`, `p`.`tgl_lahir` AS `tgl_lahir`, `p`.`alamat` AS `alamat`, `p`.`last_login` AS `last_login`, `p`.`last_logout` AS `last_logout`, `p`.`created_time` AS `created_time`, `p`.`created_by` AS `created_by`, `p`.`updated_time` AS `updated_time`, `p`.`updated_by` AS `updated_by`, `u`.`nama_unit` AS `nama_unit`, `su`.`nama_sub_unit` AS `nama_sub_unit` FROM ((`e_pengguna` `p` left join `e_unit` `u` on(`p`.`unit` = `u`.`id_unit`)) left join `e_sub_unit` `su` on(`p`.`sub_unit` = `su`.`id_sub_unit`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_sub_unit`
--
DROP TABLE IF EXISTS `v_sub_unit`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sub_unit`  AS SELECT `su`.`id_sub_unit` AS `id_sub_unit`, `su`.`unit` AS `unit`, `su`.`nama_sub_unit` AS `nama_sub_unit`, `su`.`kode_sub_unit` AS `kode_sub_unit`, `su`.`created_by` AS `created_by`, `su`.`created_time` AS `created_time`, `su`.`updated_by` AS `updated_by`, `su`.`updated_time` AS `updated_time`, `u`.`kode_unit` AS `kode_unit`, `u`.`nama_unit` AS `nama_unit` FROM (`e_sub_unit` `su` join `e_unit` `u` on(`su`.`unit` = `u`.`id_unit`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `e_detail_faktur`
--
ALTER TABLE `e_detail_faktur`
  ADD PRIMARY KEY (`id_detail_faktur`),
  ADD KEY `FK_detail_faktur_id_faktur` (`id_faktur`),
  ADD KEY `FK_detail_faktur_id_inventori` (`id_inventori`);

--
-- Indexes for table `e_faktur`
--
ALTER TABLE `e_faktur`
  ADD PRIMARY KEY (`id_faktur`),
  ADD KEY `FK_faktur_created` (`created_by`),
  ADD KEY `FK_faktur_updated` (`updated_by`),
  ADD KEY `FK_e_faktur_e_pengguna` (`approval_by`);

--
-- Indexes for table `e_hak_akses`
--
ALTER TABLE `e_hak_akses`
  ADD PRIMARY KEY (`id_hak_akses`),
  ADD UNIQUE KEY `nama_hak_akses` (`nama_hak_akses`);

--
-- Indexes for table `e_identitas`
--
ALTER TABLE `e_identitas`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `e_inventori`
--
ALTER TABLE `e_inventori`
  ADD PRIMARY KEY (`id_inventori`),
  ADD KEY `FK_e_inventori_e_unit` (`kode_unit`),
  ADD KEY `FK_e_inventori_e_sub_unit` (`kode_sub_unit`);

--
-- Indexes for table `e_kategori_inventori`
--
ALTER TABLE `e_kategori_inventori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `FK_created_kategori` (`created_by`),
  ADD KEY `FK_updated_kategori` (`updated_by`);

--
-- Indexes for table `e_modul`
--
ALTER TABLE `e_modul`
  ADD PRIMARY KEY (`id_modul`),
  ADD UNIQUE KEY `controller_modul` (`controller_modul`),
  ADD KEY `class_parent_modul` (`class_parent_modul`),
  ADD KEY `induk_child_modul` (`induk_child_modul`);

--
-- Indexes for table `e_parent_modul`
--
ALTER TABLE `e_parent_modul`
  ADD PRIMARY KEY (`id_parent_modul`),
  ADD UNIQUE KEY `class` (`class`);

--
-- Indexes for table `e_pengguna`
--
ALTER TABLE `e_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `FK_hak_akses` (`hak_akses`);

--
-- Indexes for table `e_satuan_inventori`
--
ALTER TABLE `e_satuan_inventori`
  ADD PRIMARY KEY (`id_satuan`),
  ADD KEY `FK_created_satuan` (`created_by`),
  ADD KEY `FK_updated_satuan` (`updated_by`);

--
-- Indexes for table `e_sub_unit`
--
ALTER TABLE `e_sub_unit`
  ADD PRIMARY KEY (`id_sub_unit`),
  ADD UNIQUE KEY `kode_sub_unit` (`kode_sub_unit`,`unit`),
  ADD KEY `FK_e_sub_unit_e_unit` (`unit`);

--
-- Indexes for table `e_unit`
--
ALTER TABLE `e_unit`
  ADD PRIMARY KEY (`id_unit`),
  ADD UNIQUE KEY `kode_unit` (`kode_unit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `e_detail_faktur`
--
ALTER TABLE `e_detail_faktur`
  MODIFY `id_detail_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `e_faktur`
--
ALTER TABLE `e_faktur`
  MODIFY `id_faktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `e_hak_akses`
--
ALTER TABLE `e_hak_akses`
  MODIFY `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e_identitas`
--
ALTER TABLE `e_identitas`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e_inventori`
--
ALTER TABLE `e_inventori`
  MODIFY `id_inventori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `e_kategori_inventori`
--
ALTER TABLE `e_kategori_inventori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `e_modul`
--
ALTER TABLE `e_modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `e_parent_modul`
--
ALTER TABLE `e_parent_modul`
  MODIFY `id_parent_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `e_pengguna`
--
ALTER TABLE `e_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e_satuan_inventori`
--
ALTER TABLE `e_satuan_inventori`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `e_sub_unit`
--
ALTER TABLE `e_sub_unit`
  MODIFY `id_sub_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `e_unit`
--
ALTER TABLE `e_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `e_detail_faktur`
--
ALTER TABLE `e_detail_faktur`
  ADD CONSTRAINT `FK_detail_faktur_id_faktur` FOREIGN KEY (`id_faktur`) REFERENCES `e_faktur` (`id_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detail_faktur_id_inventori` FOREIGN KEY (`id_inventori`) REFERENCES `e_inventori` (`id_inventori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `e_faktur`
--
ALTER TABLE `e_faktur`
  ADD CONSTRAINT `FK_e_faktur_e_pengguna` FOREIGN KEY (`approval_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_faktur_created` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_faktur_updated` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `e_inventori`
--
ALTER TABLE `e_inventori`
  ADD CONSTRAINT `FK_e_inventori_e_sub_unit` FOREIGN KEY (`kode_sub_unit`) REFERENCES `e_sub_unit` (`kode_sub_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_e_inventori_e_unit` FOREIGN KEY (`kode_unit`) REFERENCES `e_unit` (`kode_unit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `e_kategori_inventori`
--
ALTER TABLE `e_kategori_inventori`
  ADD CONSTRAINT `FK_created_kategori` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_updated_kategori` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `e_modul`
--
ALTER TABLE `e_modul`
  ADD CONSTRAINT `class_parent_modul` FOREIGN KEY (`class_parent_modul`) REFERENCES `e_parent_modul` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `induk_child_modul` FOREIGN KEY (`induk_child_modul`) REFERENCES `e_modul` (`controller_modul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `e_pengguna`
--
ALTER TABLE `e_pengguna`
  ADD CONSTRAINT `FK_hak_akses` FOREIGN KEY (`hak_akses`) REFERENCES `e_hak_akses` (`nama_hak_akses`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `e_satuan_inventori`
--
ALTER TABLE `e_satuan_inventori`
  ADD CONSTRAINT `FK_created_satuan` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_updated_satuan` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `e_sub_unit`
--
ALTER TABLE `e_sub_unit`
  ADD CONSTRAINT `FK_e_sub_unit_e_unit` FOREIGN KEY (`unit`) REFERENCES `e_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
