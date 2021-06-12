-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table e-inventori.e_detail_faktur
CREATE TABLE IF NOT EXISTS `e_detail_faktur` (
  `id_detail_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `id_faktur` int(11) NOT NULL,
  `id_inventori` int(11) NOT NULL,
  `jumlah_inventori` int(11) NOT NULL,
  `harga_pokok` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_faktur`),
  KEY `FK_detail_faktur_id_faktur` (`id_faktur`),
  KEY `FK_detail_faktur_id_inventori` (`id_inventori`),
  CONSTRAINT `FK_detail_faktur_id_faktur` FOREIGN KEY (`id_faktur`) REFERENCES `e_faktur` (`id_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_faktur_id_inventori` FOREIGN KEY (`id_inventori`) REFERENCES `e_inventori` (`id_inventori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_detail_faktur: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_detail_faktur` DISABLE KEYS */;
INSERT INTO `e_detail_faktur` (`id_detail_faktur`, `id_faktur`, `id_inventori`, `jumlah_inventori`, `harga_pokok`) VALUES
	(14, 14, 8, 100, 10000),
	(15, 14, 9, 10, 20000);
/*!40000 ALTER TABLE `e_detail_faktur` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_faktur
CREATE TABLE IF NOT EXISTS `e_faktur` (
  `id_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `catatan_faktur` varchar(250) NOT NULL,
  `kategori_faktur` enum('in','out') NOT NULL,
  `status_approval` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `approval_by` int(11) DEFAULT NULL,
  `approval_time` datetime DEFAULT NULL,
  `qrcode_faktur` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_faktur`),
  KEY `FK_faktur_created` (`created_by`),
  KEY `FK_faktur_updated` (`updated_by`),
  KEY `FK_e_faktur_e_pengguna` (`approval_by`),
  CONSTRAINT `FK_e_faktur_e_pengguna` FOREIGN KEY (`approval_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_faktur_created` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_faktur_updated` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_faktur: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_faktur` DISABLE KEYS */;
INSERT INTO `e_faktur` (`id_faktur`, `catatan_faktur`, `kategori_faktur`, `status_approval`, `created_by`, `created_time`, `updated_by`, `updated_time`, `approval_by`, `approval_time`, `qrcode_faktur`) VALUES
	(14, 'Faktur dari toko A', 'in', 'accept', 1, '2021-06-12 11:26:59', 1, '2021-06-12 12:02:18', 1, '2021-06-12 12:02:18', 'assets/img/qrfaktur/Faktur-14.png');
/*!40000 ALTER TABLE `e_faktur` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_hak_akses
CREATE TABLE IF NOT EXISTS `e_hak_akses` (
  `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hak_akses` varchar(225) NOT NULL,
  `modul_akses` text NOT NULL,
  `parent_modul_akses` text,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_hak_akses`),
  UNIQUE KEY `nama_hak_akses` (`nama_hak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_hak_akses: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_hak_akses` DISABLE KEYS */;
INSERT INTO `e_hak_akses` (`id_hak_akses`, `nama_hak_akses`, `modul_akses`, `parent_modul_akses`, `created_time`) VALUES
	(1, 'superuser', '{\n    "modul": [\n        "pengguna",\n        "createPengguna",\n        "updatePengguna",\n        "deletePengguna",\n        "hakAkses",\n        "createHakAkses",\n        "updateHakAkses",\n        "deleteHakAkses",\n        "listInventori",\n        "createInventori",\n        "updateInventori",\n        "deleteInventori",\n        "kategori",\n        "createKategori",\n        "updateKategori",\n        "deleteKategori",\n        "satuan",\n        "createSatuan",\n        "updateSatuan",\n        "deleteSatuan",\n        "logistikMasuk",\n        "createLogistikMasuk",\n        "updateLogistikMasuk",\n        "deleteLogistikMasuk",\n        "approveLogistikMasuk",\n        "logistikKeluar",\n        "createLogistikKeluar",\n        "updateLogistikKeluar",\n        "deleteLogistikKeluar",\n        "approveLogistikKeluar",\n        "detailInventori",\n        "detailLogistikMasuk",\n        "detailLogistikKeluar",\n        "rejectLogistkMasuk",\n        "rejectLogistikKeluar",\n        "identitasAplikasi",\n        "daftarModul"\n    ]\n}', '{\n    "parent_modul": [\n        "Dashboard",\n        "MasterData",\n        "Inventori",\n        "Pengaturan"\n    ]\n}', '2021-06-10 09:21:01');
/*!40000 ALTER TABLE `e_hak_akses` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_identitas
CREATE TABLE IF NOT EXISTS `e_identitas` (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
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
  `keyword` text,
  `logo` varchar(225) DEFAULT 'NULL',
  `icon` varchar(225) DEFAULT NULL,
  `sidebar_login` varchar(225) DEFAULT NULL,
  `about_us` text,
  `email` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_profile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table e-inventori.e_identitas: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_identitas` DISABLE KEYS */;
INSERT INTO `e_identitas` (`id_profile`, `apps_name`, `apps_version`, `apps_code`, `agency`, `address`, `city`, `telephon`, `fax`, `website`, `header`, `footer`, `keyword`, `logo`, `icon`, `sidebar_login`, `about_us`, `email`) VALUES
	(1, 'e-inventaris', '1.0', 'eis', '| EIS', '', '', '', '', '', '', '', '', 'assets/img/logotubes.png', 'assets/img/logotubes.ico', 'assets/img/Jenis-Gudang-Harmony.jpg', '', NULL);
/*!40000 ALTER TABLE `e_identitas` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_inventori
CREATE TABLE IF NOT EXISTS `e_inventori` (
  `id_inventori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_inventori` varchar(250) NOT NULL,
  `satuan_inventori` int(11) NOT NULL,
  `harga_pokok` int(11) DEFAULT NULL,
  `harga_jual` int(11) NOT NULL,
  `kategori_inventori` int(11) NOT NULL,
  `jumlah_inventori` int(11) DEFAULT NULL,
  `qrcode` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_inventori`),
  KEY `FK_inventori_created` (`created_by`),
  KEY `FK_inventori_updated` (`updated_by`),
  CONSTRAINT `FK_inventori_created` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_inventori_updated` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_inventori: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_inventori` DISABLE KEYS */;
INSERT INTO `e_inventori` (`id_inventori`, `nama_inventori`, `satuan_inventori`, `harga_pokok`, `harga_jual`, `kategori_inventori`, `jumlah_inventori`, `qrcode`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(8, 'Gula', 1, 10000, 12000, 2, 100, 'assets/img/qrbarang/Gula.png', 1, '2021-06-12 00:15:34', NULL, NULL),
	(9, 'Jahe', 1, 20000, 8000, 2, 10, 'assets/img/qrbarang/Jahe.png', 1, '2021-06-12 10:07:25', NULL, NULL);
/*!40000 ALTER TABLE `e_inventori` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_kategori_inventori
CREATE TABLE IF NOT EXISTS `e_kategori_inventori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kategori`),
  KEY `FK_created_kategori` (`created_by`),
  KEY `FK_updated_kategori` (`updated_by`),
  CONSTRAINT `FK_created_kategori` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_updated_kategori` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_kategori_inventori: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_kategori_inventori` DISABLE KEYS */;
INSERT INTO `e_kategori_inventori` (`id_kategori`, `nama_kategori`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 'Barang Non Produksi', 1, '2021-06-11 08:59:20', 1, '2021-06-11 09:02:18'),
	(2, 'Barang Produksi', 1, '2021-06-11 15:06:23', NULL, NULL);
/*!40000 ALTER TABLE `e_kategori_inventori` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_modul
CREATE TABLE IF NOT EXISTS `e_modul` (
  `id_modul` int(11) NOT NULL AUTO_INCREMENT,
  `controller_modul` varchar(225) NOT NULL,
  `nama_modul` varchar(225) NOT NULL,
  `link_modul` varchar(225) NOT NULL,
  `type_modul` varchar(20) NOT NULL,
  `class_parent_modul` varchar(225) DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tampil_sidebar` enum('Y','N') NOT NULL,
  `child_module` enum('Y','N') NOT NULL DEFAULT 'N',
  `induk_child_modul` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_modul`),
  UNIQUE KEY `controller_modul` (`controller_modul`),
  KEY `class_parent_modul` (`class_parent_modul`),
  KEY `induk_child_modul` (`induk_child_modul`),
  CONSTRAINT `class_parent_modul` FOREIGN KEY (`class_parent_modul`) REFERENCES `e_parent_modul` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `induk_child_modul` FOREIGN KEY (`induk_child_modul`) REFERENCES `e_modul` (`controller_modul`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_modul: ~34 rows (approximately)
/*!40000 ALTER TABLE `e_modul` DISABLE KEYS */;
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
	(21, 'logistikMasuk', 'Daftar Logistik Masuk', 'panel/inventori/logistikMasuk', 'R', 'Inventori', '2021-06-10 08:18:01', 'Y', 'N', NULL),
	(22, 'createLogistikMasuk', 'Tambah Logistik Masuk', 'panel/inventori/createLogistikMasuk', 'C', 'Inventori', '2021-06-10 08:29:24', 'N', 'N', NULL),
	(23, 'updateLogistikMasuk', 'Update Logistik Masuk', 'panel/inventori/updateLogistikMasuk', 'U', 'Inventori', '2021-06-10 08:29:50', 'N', 'N', NULL),
	(24, 'deleteLogistikMasuk', 'Delete Logistik Masuk', 'panel/inventori/deleteLogistikMasuk', 'D', 'Inventori', '2021-06-10 08:30:09', 'N', 'N', NULL),
	(25, 'approveLogistikMasuk', 'Approve Logistik Masuk', 'panel/inventori/approveLogistikMasuk', 'U', 'Inventori', '2021-06-10 08:30:49', 'N', 'N', NULL),
	(26, 'logistikKeluar', 'Daftar Logistik Keluar', 'panel/inventori/logistikKeluar', 'R', 'Inventori', '2021-06-10 08:31:16', 'Y', 'N', NULL),
	(27, 'createLogistikKeluar', 'Tambah Logistik Keluar', 'panel/inventori/createLogistikKeluar', 'C', 'Inventori', '2021-06-10 08:31:38', 'N', 'N', NULL),
	(28, 'updateLogistikKeluar', 'Update Logistik Keluar', 'panel/inventori/updateLogistikKeluar', 'U', 'Inventori', '2021-06-10 08:31:58', 'N', 'N', NULL),
	(29, 'deleteLogistikKeluar', 'Delete Logistik Keluar', 'panel/inventori/deleteLogistikKeluar', 'D', 'Inventori', '2021-06-10 08:32:20', 'N', 'N', NULL),
	(30, 'approveLogistikKeluar', 'Approve Logistik Keluar', 'panel/inventori/approveLogistikKeluar', 'U', 'Inventori', '2021-06-10 08:32:46', 'N', 'N', NULL),
	(31, 'identitasAplikasi', 'Identitas Aplikasi', 'panel/pengaturan/identitasAplikasi', 'U', 'Pengaturan', '2021-06-10 08:33:19', 'Y', 'N', NULL),
	(32, 'daftarModul', 'Daftar Modul', 'panel/pengaturan/daftarModul', 'R', 'Pengaturan', '2021-06-10 08:33:43', 'Y', 'N', NULL),
	(33, 'detailInventori', 'Detail inventori', 'panel/inventori/detailInventori', 'R', 'Inventori', '2021-06-11 23:51:22', 'N', 'N', NULL),
	(34, 'detailLogistikMasuk', 'Detail Logistik Masuk', 'panel/inventori/detailLogistikMasuk', 'R', 'Inventori', '2021-06-12 11:24:29', 'N', 'N', NULL),
	(35, 'detailLogistikKeluar', 'Detail Logistik Keluar', 'panel/inventori/detailLogistikKeluar', 'R', 'Inventori', '2021-06-12 11:24:57', 'N', 'N', NULL),
	(36, 'rejectLogistkMasuk', 'Reject Logistik Masuk', 'panel/inventori/rejectLogistikKeluar', 'U', 'Inventori', '2021-06-12 11:49:06', 'N', 'N', NULL),
	(37, 'rejectLogistikKeluar', 'Reject Logistik Keluar', 'panel/inventori/rejectLogistikKeluar', 'U', 'Inventori', '2021-06-12 11:49:32', 'N', 'N', NULL);
/*!40000 ALTER TABLE `e_modul` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_parent_modul
CREATE TABLE IF NOT EXISTS `e_parent_modul` (
  `id_parent_modul` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(225) DEFAULT NULL,
  `nama_parent_modul` varchar(225) NOT NULL,
  `urutan` int(11) NOT NULL,
  `icon` varchar(225) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `child_module` enum('Y','N') NOT NULL,
  `link` varchar(225) NOT NULL,
  `tampil_sidebar_parent` enum('Y','N') NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_parent_modul`),
  UNIQUE KEY `class` (`class`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_parent_modul: ~4 rows (approximately)
/*!40000 ALTER TABLE `e_parent_modul` DISABLE KEYS */;
INSERT INTO `e_parent_modul` (`id_parent_modul`, `class`, `nama_parent_modul`, `urutan`, `icon`, `created_time`, `child_module`, `link`, `tampil_sidebar_parent`) VALUES
	(1, 'Dashboard', 'Dashboard', 1, 'fa fa-dashboard', '2021-06-10 07:57:29', 'N', 'panel/dashboard', 'Y'),
	(2, 'MasterData', 'Master Data', 2, 'fa fa-desktop', '2021-06-10 07:57:59', 'Y', '#', 'Y'),
	(3, 'Inventori', 'Inventori', 3, 'fa fa-list', '2021-06-10 07:58:18', 'Y', '#', 'Y'),
	(4, 'Pengaturan', 'Pengaturan', 4, 'fa fa-cog', '2021-06-10 07:58:35', 'Y', '#', 'Y');
/*!40000 ALTER TABLE `e_parent_modul` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_pengguna
CREATE TABLE IF NOT EXISTS `e_pengguna` (
  `id_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `hak_akses` varchar(250) NOT NULL,
  `nama_lengkap` varchar(250) NOT NULL,
  `foto_pengguna` varchar(250) DEFAULT NULL,
  `jenkel` enum('L','P') DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_hak_akses` (`hak_akses`),
  CONSTRAINT `FK_hak_akses` FOREIGN KEY (`hak_akses`) REFERENCES `e_hak_akses` (`nama_hak_akses`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_pengguna: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_pengguna` DISABLE KEYS */;
INSERT INTO `e_pengguna` (`id_pengguna`, `username`, `password`, `email`, `hak_akses`, `nama_lengkap`, `foto_pengguna`, `jenkel`, `tgl_lahir`, `alamat`, `last_login`, `last_logout`, `created_time`, `created_by`, `updated_time`, `updated_by`) VALUES
	(1, 'superuser', '72d8f949d00e431239b993f14b70d80d5313efc9', 'test@mail.com', 'superuser', 'superuser', 'assets/img/pengguna/logo_disdik.png', 'L', NULL, NULL, '2021-06-12 08:59:41', '2021-06-12 00:23:59', '2021-06-10 09:32:44', NULL, NULL, NULL);
/*!40000 ALTER TABLE `e_pengguna` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_satuan_inventori
CREATE TABLE IF NOT EXISTS `e_satuan_inventori` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(250) NOT NULL,
  `singkatan_satuan` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_satuan`),
  KEY `FK_created_satuan` (`created_by`),
  KEY `FK_updated_satuan` (`updated_by`),
  CONSTRAINT `FK_created_satuan` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_updated_satuan` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_satuan_inventori: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_satuan_inventori` DISABLE KEYS */;
INSERT INTO `e_satuan_inventori` (`id_satuan`, `nama_satuan`, `singkatan_satuan`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 'Kilogram', 'Kg', 1, '2021-06-11 09:16:36', NULL, NULL);
/*!40000 ALTER TABLE `e_satuan_inventori` ENABLE KEYS */;

-- Dumping structure for view e-inventori.v_detail_inventori
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_detail_inventori` (
	`id_inventori` INT(11) NOT NULL,
	`nama_inventori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`satuan_inventori` INT(11) NOT NULL,
	`harga_pokok` INT(11) NULL,
	`harga_jual` INT(11) NOT NULL,
	`kategori_inventori` INT(11) NOT NULL,
	`jumlah_inventori` INT(11) NULL,
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`id_faktur` INT(11) NOT NULL,
	`jumlah_inventori_faktur` INT(11) NOT NULL,
	`singkatan_satuan` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`harga_pokok_faktur` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_faktur
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_faktur` (
	`id_faktur` INT(11) NOT NULL,
	`catatan_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kategori_faktur` ENUM('in','out') NOT NULL COLLATE 'latin1_swedish_ci',
	`status_approval` ENUM('pending','accept','reject') NOT NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`approval_time` DATETIME NULL,
	`qrcode_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`total_belanja` DECIMAL(42,0) NULL,
	`pembuat_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`pengaprove_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_inventori
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_inventori` (
	`qrcode` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`id_inventori` INT(11) NOT NULL,
	`nama_inventori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`satuan_inventori` INT(11) NOT NULL,
	`harga_pokok` INT(11) NULL,
	`harga_jual` INT(11) NOT NULL,
	`kategori_inventori` INT(11) NOT NULL,
	`jumlah_inventori` INT(11) NULL,
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`nama_kategori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_satuan` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`singkatan_satuan` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_detail_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_detail_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_inventori` AS select `ei`.`id_inventori` AS `id_inventori`,`ei`.`nama_inventori` AS `nama_inventori`,`ei`.`satuan_inventori` AS `satuan_inventori`,`ei`.`harga_pokok` AS `harga_pokok`,`ei`.`harga_jual` AS `harga_jual`,`ei`.`kategori_inventori` AS `kategori_inventori`,`ei`.`jumlah_inventori` AS `jumlah_inventori`,`ei`.`created_by` AS `created_by`,`ei`.`created_time` AS `created_time`,`ei`.`updated_by` AS `updated_by`,`ei`.`updated_time` AS `updated_time`,`df`.`id_faktur` AS `id_faktur`,`df`.`jumlah_inventori` AS `jumlah_inventori_faktur`,`s`.`singkatan_satuan` AS `singkatan_satuan`,`df`.`harga_pokok` AS `harga_pokok_faktur` from (((`e_detail_faktur` `df` join `e_inventori` `ei` on((`df`.`id_inventori` = `ei`.`id_inventori`))) join `e_satuan_inventori` `s` on((`s`.`id_satuan` = `ei`.`satuan_inventori`))) join `e_faktur` `f` on((`f`.`id_faktur` = `df`.`id_faktur`)));

-- Dumping structure for view e-inventori.v_faktur
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_faktur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_faktur` AS select `f`.`id_faktur` AS `id_faktur`,`f`.`catatan_faktur` AS `catatan_faktur`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`status_approval` AS `status_approval`,`f`.`created_by` AS `created_by`,`f`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`f`.`approval_time` AS `approval_time`,`f`.`qrcode_faktur` AS `qrcode_faktur`,sum((`df`.`harga_pokok` * `df`.`jumlah_inventori`)) AS `total_belanja`,`p`.`nama_lengkap` AS `pembuat_faktur`,`p2`.`nama_lengkap` AS `pengaprove_faktur` from (((`e_faktur` `f` join `e_detail_faktur` `df` on((`f`.`id_faktur` = `df`.`id_faktur`))) join `e_pengguna` `p` on((`p`.`id_pengguna` = `f`.`created_by`))) left join `e_pengguna` `p2` on((`p2`.`id_pengguna` = `f`.`approval_by`))) group by `df`.`id_faktur`;

-- Dumping structure for view e-inventori.v_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventori` AS select `ei`.`qrcode` AS `qrcode`,`ei`.`id_inventori` AS `id_inventori`,`ei`.`nama_inventori` AS `nama_inventori`,`ei`.`satuan_inventori` AS `satuan_inventori`,`ei`.`harga_pokok` AS `harga_pokok`,`ei`.`harga_jual` AS `harga_jual`,`ei`.`kategori_inventori` AS `kategori_inventori`,`ei`.`jumlah_inventori` AS `jumlah_inventori`,`ei`.`created_by` AS `created_by`,`ei`.`created_time` AS `created_time`,`ei`.`updated_by` AS `updated_by`,`ei`.`updated_time` AS `updated_time`,`eki`.`nama_kategori` AS `nama_kategori`,`esi`.`nama_satuan` AS `nama_satuan`,`esi`.`singkatan_satuan` AS `singkatan_satuan` from ((`e_inventori` `ei` join `e_kategori_inventori` `eki` on((`ei`.`kategori_inventori` = `eki`.`id_kategori`))) join `e_satuan_inventori` `esi` on((`ei`.`satuan_inventori` = `esi`.`id_satuan`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
