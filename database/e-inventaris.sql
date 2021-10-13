-- --------------------------------------------------------
-- Host:                         127.0.0.1
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
  `harga_barang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_faktur`),
  KEY `FK_detail_faktur_id_faktur` (`id_faktur`),
  KEY `FK_detail_faktur_id_inventori` (`id_inventori`),
  CONSTRAINT `FK_detail_faktur_id_faktur` FOREIGN KEY (`id_faktur`) REFERENCES `e_faktur` (`id_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_faktur_id_inventori` FOREIGN KEY (`id_inventori`) REFERENCES `e_inventori` (`id_inventori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_detail_faktur: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_detail_faktur` DISABLE KEYS */;
INSERT INTO `e_detail_faktur` (`id_detail_faktur`, `id_faktur`, `id_inventori`, `jumlah_inventori`, `harga_barang`) VALUES
	(1, 27, 14, 100, NULL),
	(2, 28, 14, 100, 25000);
/*!40000 ALTER TABLE `e_detail_faktur` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_faktur
CREATE TABLE IF NOT EXISTS `e_faktur` (
  `id_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `kode_faktur` varchar(20) DEFAULT NULL,
  `catatan_faktur` varchar(250) NOT NULL,
  `kategori_faktur` enum('in','out') NOT NULL,
  `status_keluar` enum('pinjam','rusak') DEFAULT NULL,
  `status_pengembalian` enum('belum','sudah') DEFAULT 'belum',
  `status_approval` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `approval_by` int(11) DEFAULT NULL,
  `approval_time` datetime DEFAULT NULL,
  `dikembalikan_oleh` int(11) DEFAULT NULL,
  `tgl_pengembalian` datetime DEFAULT NULL,
  `qrcode_faktur` varchar(250) DEFAULT NULL,
  `barcode_faktur` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_faktur`),
  KEY `FK_faktur_created` (`created_by`),
  KEY `FK_faktur_updated` (`updated_by`),
  KEY `FK_e_faktur_e_pengguna` (`approval_by`),
  CONSTRAINT `FK_e_faktur_e_pengguna` FOREIGN KEY (`approval_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_faktur_created` FOREIGN KEY (`created_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `FK_faktur_updated` FOREIGN KEY (`updated_by`) REFERENCES `e_pengguna` (`id_pengguna`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_faktur: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_faktur` DISABLE KEYS */;
INSERT INTO `e_faktur` (`id_faktur`, `kode_faktur`, `catatan_faktur`, `kategori_faktur`, `status_keluar`, `status_pengembalian`, `status_approval`, `created_by`, `created_time`, `updated_by`, `updated_time`, `approval_by`, `approval_time`, `dikembalikan_oleh`, `tgl_pengembalian`, `qrcode_faktur`, `barcode_faktur`) VALUES
	(27, 'A123', 'Peminjaman Untuk Acara PEMA', 'out', 'pinjam', 'sudah', 'accept', 1, '2021-10-12 10:11:56', 1, '2021-10-12 13:08:37', 1, '2021-10-12 13:08:37', 1, '2021-10-12 22:27:44', 'assets/img/qrfaktur/Faktur-27.png', 'assets/img/barcodefaktur/27'),
	(28, 'A123', 'Penambahan inventori', 'in', NULL, 'belum', 'pending', 1, '2021-10-12 10:35:21', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/img/qrfaktur/Faktur-28.png', 'assets/img/barcodefaktur/28');
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
	(1, 'superuser', '{\n    "modul": [\n        "pengguna",\n        "createPengguna",\n        "updatePengguna",\n        "deletePengguna",\n        "hakAkses",\n        "createHakAkses",\n        "updateHakAkses",\n        "deleteHakAkses",\n        "daftarUnit",\n        "tambahUnit",\n        "updateUnit",\n        "deleteUnit",\n        "daftarSubUnit",\n        "tambahSubUnit",\n        "updateSubUnit",\n        "deleteSubUnit",\n        "daftarSumberDana",\n        "tambahSumberDana",\n        "updateSumberDana",\n        "deleteSumberDana",\n        "listInventori",\n        "createInventori",\n        "updateInventori",\n        "deleteInventori",\n        "kategori",\n        "createKategori",\n        "updateKategori",\n        "deleteKategori",\n        "satuan",\n        "createSatuan",\n        "updateSatuan",\n        "deleteSatuan",\n        "inventoriMasuk",\n        "createInventoriMasuk",\n        "updateInventoriMasuk",\n        "deleteInventoriMasuk",\n        "approveInventoriMasuk",\n        "inventoriKeluar",\n        "createInventoriKeluar",\n        "updateInventoriKeluar",\n        "deleteInventoriKeluar",\n        "approveInventoriKeluar",\n        "detailInventori",\n        "detailInventoriMasuk",\n        "detailInventoriKeluar",\n        "rejectInventoriMasuk",\n        "rejectInventoriKeluar",\n        "laporanInventori",\n        "scanInventori",\n        "scanFaktur",\n        "scanBarcodeInventori",\n        "scanBarcodeFaktur",\n        "daftarTiket",\n        "detailTiket",\n        "tanggapanTiket",\n        "hapusTiket",\n        "identitasAplikasi",\n        "daftarModul"\n    ]\n}', '{\n    "parent_modul": [\n        "Dashboard",\n        "MasterData",\n        "Inventori",\n        "Scan",\n        "Tiket",\n        "Pengaturan"\n    ]\n}', '2021-06-10 09:21:01');
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
	(1, 'eInventaris', '1.0', 'eis', '| V1.0', '', '', '', '', '', '', '', '', 'assets/img/Logo_FasilkomTI_USU_Baru.png', 'assets/img/favicon.ico', 'assets/img/sidebar.jpg', '', NULL);
/*!40000 ALTER TABLE `e_identitas` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_inventori
CREATE TABLE IF NOT EXISTS `e_inventori` (
  `id_inventori` int(11) NOT NULL AUTO_INCREMENT,
  `kode_unit` varchar(20) DEFAULT NULL,
  `kode_sub_unit` varchar(20) DEFAULT NULL,
  `kode_sumber_dana` varchar(20) DEFAULT NULL,
  `kode_inventori` varchar(50) NOT NULL,
  `nama_inventori` varchar(250) NOT NULL,
  `satuan_inventori` int(11) NOT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `kategori_inventori` int(11) NOT NULL,
  `jumlah_inventori` int(11) DEFAULT NULL,
  `qrcode` varchar(250) DEFAULT NULL,
  `barcode` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_inventori`),
  KEY `FK_e_inventori_e_unit` (`kode_unit`),
  KEY `FK_e_inventori_e_sub_unit` (`kode_sub_unit`),
  KEY `FK_e_inventori_e_sumber_dana` (`kode_sumber_dana`),
  CONSTRAINT `FK_e_inventori_e_sub_unit` FOREIGN KEY (`kode_sub_unit`) REFERENCES `e_sub_unit` (`kode_sub_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_sumber_dana` FOREIGN KEY (`kode_sumber_dana`) REFERENCES `e_sumber_dana` (`kode_sumber_dana`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_unit` FOREIGN KEY (`kode_unit`) REFERENCES `e_unit` (`kode_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_inventori: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_inventori` DISABLE KEYS */;
INSERT INTO `e_inventori` (`id_inventori`, `kode_unit`, `kode_sub_unit`, `kode_sumber_dana`, `kode_inventori`, `nama_inventori`, `satuan_inventori`, `harga_barang`, `kategori_inventori`, `jumlah_inventori`, `qrcode`, `barcode`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(14, 'GF1', 'RA1', 'SA', 'KRS', 'Kursi', 1, NULL, 3, 1000, 'assets/img/qrbarang/GF1RA1KRS.png', 'assets/img/barcodebarang/GF1RA1KRS.png', 1, '2021-10-12 10:07:48', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_kategori_inventori: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_kategori_inventori` DISABLE KEYS */;
INSERT INTO `e_kategori_inventori` (`id_kategori`, `nama_kategori`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 'Barang Non Produksi', 1, '2021-06-11 08:59:20', 1, '2021-06-11 09:02:18'),
	(2, 'Barang Produksi', 1, '2021-06-11 15:06:23', NULL, NULL),
	(3, 'Fasilitas Kampus', 1, '2021-10-02 08:55:34', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_modul: ~46 rows (approximately)
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
	(47, 'scanFaktur', 'Scan Faktur', 'panel/scan/scanFaktur', 'R', 'Scan', '2021-10-05 08:21:37', 'Y', 'N', NULL),
	(48, 'scanBarcodeInventori', 'Scan Barcode Inventori', 'panel/scan/scanBarcodeInventori', 'R', 'Scan', '2021-10-09 12:31:28', 'Y', 'N', NULL),
	(49, 'scanBarcodeFaktur', 'Scan Barcode Faktur', 'panel/scan/scanBarcodeFaktur', 'R', 'Scan', '2021-10-09 12:31:53', 'Y', 'N', NULL),
	(50, 'daftarSumberDana', 'Daftar Sumber Dana', 'panel/masterData/daftarSumberDana', 'R', 'MasterData', '2021-10-09 23:42:05', 'Y', 'N', NULL),
	(51, 'tambahSumberDana', 'Tambah Sumber Dana', 'panel/masterData/tambahSumberDana', 'C', 'MasterData', '2021-10-09 23:42:34', 'N', 'N', NULL),
	(52, 'updateSumberDana', 'Update Sumber Dana', 'panel/masterData/updateSumberDana', 'U', 'MasterData', '2021-10-09 23:42:57', 'N', 'N', NULL),
	(53, 'deleteSumberDana', 'Delete Sumber Dana', 'panel/masterData/deleteSumberDana', 'D', 'MasterData', '2021-10-09 23:43:25', 'N', 'N', NULL),
	(54, 'laporanInventori', 'Laporan Inventori', 'panel/inventori/laporanInventori', 'R', 'Inventori', '2021-10-12 22:31:48', 'Y', 'N', NULL),
	(55, 'daftarTiket', 'Daftar Tiket', 'panel/tiket/daftarTiket', 'R', 'Tiket', '2021-10-13 19:37:10', 'Y', 'N', NULL),
	(56, 'detailTiket', 'DetailTiket', 'panel/tiket/detailTiket', 'R', 'Tiket', '2021-10-13 19:39:46', 'N', 'N', NULL),
	(57, 'tanggapanTiket', 'Tanggapan Tiket', 'panel/tiket/tanggapanTiket', 'U', 'Tiket', '2021-10-13 19:38:03', 'N', 'N', NULL),
	(58, 'hapusTiket', 'Hapus Tiket', 'panel/tiker/hapusTiket', 'D', 'Tiket', '2021-10-13 22:14:54', 'N', 'N', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_parent_modul: ~4 rows (approximately)
/*!40000 ALTER TABLE `e_parent_modul` DISABLE KEYS */;
INSERT INTO `e_parent_modul` (`id_parent_modul`, `class`, `nama_parent_modul`, `urutan`, `icon`, `created_time`, `child_module`, `link`, `tampil_sidebar_parent`) VALUES
	(1, 'Dashboard', 'Dashboard', 1, 'fa fa-dashboard', '2021-06-10 07:57:29', 'N', 'panel/dashboard', 'Y'),
	(2, 'MasterData', 'Master Data', 2, 'fa fa-desktop', '2021-06-10 07:57:59', 'Y', '#', 'Y'),
	(3, 'Inventori', 'Inventori', 3, 'fa fa-list', '2021-06-10 07:58:18', 'Y', '#', 'Y'),
	(4, 'Pengaturan', 'Pengaturan', 6, 'fa fa-cog', '2021-06-10 07:58:35', 'Y', '#', 'Y'),
	(5, 'Scan', 'Scan', 4, 'fa fa-qrcode', '2021-10-05 08:20:41', 'Y', '#', 'Y'),
	(6, 'Tiket', 'Tiket', 5, 'fa fa-envelope', '2021-10-13 19:35:31', 'Y', '#', 'Y');
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
  `no_wa` varchar(20) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `sub_unit` int(11) DEFAULT NULL,
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
INSERT INTO `e_pengguna` (`id_pengguna`, `username`, `password`, `email`, `hak_akses`, `nama_lengkap`, `foto_pengguna`, `no_wa`, `unit`, `sub_unit`, `jenkel`, `tgl_lahir`, `alamat`, `last_login`, `last_logout`, `created_time`, `created_by`, `updated_time`, `updated_by`) VALUES
	(1, 'superuser', '72d8f949d00e431239b993f14b70d80d5313efc9', 'test@mail.com', 'superuser', 'superuser', '', NULL, NULL, NULL, 'L', NULL, NULL, '2021-10-13 19:36:02', '2021-10-08 11:09:05', '2021-06-10 09:32:44', NULL, NULL, NULL);
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
	(1, 'Pieces', 'Pcs', 1, '2021-06-11 09:16:36', 1, '2021-10-02 08:46:44');
/*!40000 ALTER TABLE `e_satuan_inventori` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_sub_unit
CREATE TABLE IF NOT EXISTS `e_sub_unit` (
  `id_sub_unit` int(11) NOT NULL AUTO_INCREMENT,
  `unit` int(11) NOT NULL,
  `nama_sub_unit` varchar(250) NOT NULL,
  `kode_sub_unit` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sub_unit`),
  UNIQUE KEY `kode_sub_unit` (`kode_sub_unit`,`unit`),
  KEY `FK_e_sub_unit_e_unit` (`unit`),
  CONSTRAINT `FK_e_sub_unit_e_unit` FOREIGN KEY (`unit`) REFERENCES `e_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_sub_unit: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_sub_unit` DISABLE KEYS */;
INSERT INTO `e_sub_unit` (`id_sub_unit`, `unit`, `nama_sub_unit`, `kode_sub_unit`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 2, 'Ruang A1', 'RA1', 1, '2021-10-02 08:30:46', NULL, NULL),
	(2, 3, 'Ruang A1', 'RA1', 1, '2021-10-02 08:31:27', NULL, NULL);
/*!40000 ALTER TABLE `e_sub_unit` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_sumber_dana
CREATE TABLE IF NOT EXISTS `e_sumber_dana` (
  `id_sumber_dana` int(11) NOT NULL AUTO_INCREMENT,
  `kode_sumber_dana` varchar(50) NOT NULL,
  `keterangan_sumber_dana` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sumber_dana`),
  UNIQUE KEY `kode_sumber_dana` (`kode_sumber_dana`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_sumber_dana: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_sumber_dana` DISABLE KEYS */;
INSERT INTO `e_sumber_dana` (`id_sumber_dana`, `kode_sumber_dana`, `keterangan_sumber_dana`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 'SA', 'Sumbangan Alumnni', 1, '2021-10-10 00:08:44', NULL, NULL);
/*!40000 ALTER TABLE `e_sumber_dana` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_ticketing
CREATE TABLE IF NOT EXISTS `e_ticketing` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `foto_laporan` varchar(250) NOT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_sub_unit` int(11) DEFAULT NULL,
  `detail_lokasi` varchar(250) NOT NULL,
  `keterangan_laporan` varchar(250) NOT NULL,
  `status_laporan` enum('Y','N') NOT NULL DEFAULT 'N',
  `dibuat_pada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ditanggapi_oleh` int(11) DEFAULT NULL,
  `tanggapan_laporan` varchar(250) DEFAULT NULL,
  `ditanggapi_pada` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_ticketing: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_ticketing` DISABLE KEYS */;
INSERT INTO `e_ticketing` (`id_ticket`, `nama_lengkap`, `foto_laporan`, `id_unit`, `id_sub_unit`, `detail_lokasi`, `keterangan_laporan`, `status_laporan`, `dibuat_pada`, `ditanggapi_oleh`, `tanggapan_laporan`, `ditanggapi_pada`) VALUES
	(1, 'Taufiq Rorkyendo', 'assets/img/fotoLaporan/ESP32-Pinout.jpg', 2, 1, 'Dekat Pojok ruang 1', 'Barangnya rusak parah', 'Y', '2021-10-13 18:54:18', 1, 'Oke akan segera kami proses, terimakasih atas laporannya', '2021-10-13 23:12:35');
/*!40000 ALTER TABLE `e_ticketing` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_unit
CREATE TABLE IF NOT EXISTS `e_unit` (
  `id_unit` int(11) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(250) NOT NULL,
  `alamat_unit` text,
  `kode_unit` varchar(20) NOT NULL,
  `created_time` int(11) NOT NULL,
  `created_by` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_unit`),
  UNIQUE KEY `kode_unit` (`kode_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_unit: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_unit` DISABLE KEYS */;
INSERT INTO `e_unit` (`id_unit`, `nama_unit`, `alamat_unit`, `kode_unit`, `created_time`, `created_by`, `updated_by`, `updated_time`) VALUES
	(2, 'Gedung Fakultas 1', 'Jalanin aja dulu', 'GF1', 0, '0000-00-00 00:00:00', NULL, NULL),
	(3, 'Gedung Fakultas 2', 'Jalan doang gk ngapa2in', 'GF2', 0, '0000-00-00 00:00:00', NULL, NULL);
/*!40000 ALTER TABLE `e_unit` ENABLE KEYS */;

-- Dumping structure for view e-inventori.v_detail_inventori
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_detail_inventori` (
	`id_inventori` INT(11) NOT NULL,
	`kode_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`kode_sub_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`kode_inventori` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_inventori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`satuan_inventori` INT(11) NOT NULL,
	`harga_barang` INT(11) NULL,
	`kategori_inventori` INT(11) NOT NULL,
	`jumlah_inventori` INT(11) NULL,
	`kategori_faktur` ENUM('in','out') NOT NULL COLLATE 'latin1_swedish_ci',
	`status_keluar` ENUM('pinjam','rusak') NULL COLLATE 'latin1_swedish_ci',
	`status_pengembalian` ENUM('belum','sudah') NULL COLLATE 'latin1_swedish_ci',
	`status_approval` ENUM('pending','accept','reject') NOT NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`id_faktur` INT(11) NOT NULL,
	`jumlah_inventori_faktur` INT(11) NOT NULL,
	`singkatan_satuan` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`harga_barang_faktur` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_faktur
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_faktur` (
	`id_faktur` INT(11) NOT NULL,
	`kode_faktur` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`catatan_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kategori_faktur` ENUM('in','out') NOT NULL COLLATE 'latin1_swedish_ci',
	`status_keluar` ENUM('pinjam','rusak') NULL COLLATE 'latin1_swedish_ci',
	`status_pengembalian` ENUM('belum','sudah') NULL COLLATE 'latin1_swedish_ci',
	`status_approval` ENUM('pending','accept','reject') NOT NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`approval_time` DATETIME NULL,
	`dikembalikan_oleh` INT(11) NULL,
	`tgl_pengembalian` DATETIME NULL,
	`qrcode_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`barcode_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`total_belanja` DECIMAL(42,0) NULL,
	`pembuat_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`pengaprove_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`pengembali_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_inventori
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_inventori` (
	`id_inventori` INT(11) NOT NULL,
	`kode_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kode_sub_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_sub_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kode_sumber_dana` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`keterangan_sumber_dana` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_inventori` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_inventori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`satuan_inventori` INT(11) NOT NULL,
	`harga_barang` INT(11) NULL,
	`kategori_inventori` INT(11) NOT NULL,
	`jumlah_inventori` INT(11) NULL,
	`qrcode` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`barcode` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`nama_kategori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_satuan` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`singkatan_satuan` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_pengguna
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_pengguna` (
	`id_pengguna` INT(11) NOT NULL,
	`username` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`password` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`hak_akses` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_lengkap` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`foto_pengguna` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`no_wa` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`unit` INT(11) NULL,
	`sub_unit` INT(11) NULL,
	`jenkel` ENUM('L','P') NULL COLLATE 'latin1_swedish_ci',
	`tgl_lahir` DATE NULL,
	`alamat` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`last_login` DATETIME NULL,
	`last_logout` DATETIME NULL,
	`created_time` DATETIME NOT NULL,
	`created_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`updated_by` INT(11) NULL,
	`nama_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`nama_sub_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_sub_unit
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_sub_unit` (
	`id_sub_unit` INT(11) NOT NULL,
	`unit` INT(11) NOT NULL,
	`nama_sub_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kode_sub_unit` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`kode_unit` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_ticketing
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_ticketing` (
	`id_ticket` INT(11) NOT NULL,
	`nama_lengkap` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`foto_laporan` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_unit` INT(11) NULL,
	`id_sub_unit` INT(11) NULL,
	`detail_lokasi` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan_laporan` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`status_laporan` ENUM('Y','N') NOT NULL COLLATE 'latin1_swedish_ci',
	`dibuat_pada` DATETIME NOT NULL,
	`ditanggapi_oleh` INT(11) NULL,
	`tanggapan_laporan` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`ditanggapi_pada` DATETIME NULL,
	`nama_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`nama_sub_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`nama_penanggap` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_detail_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_detail_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_inventori` AS select `ei`.`id_inventori` AS `id_inventori`,`ei`.`kode_unit` AS `kode_unit`,`ei`.`kode_sub_unit` AS `kode_sub_unit`,`ei`.`kode_inventori` AS `kode_inventori`,`ei`.`nama_inventori` AS `nama_inventori`,`ei`.`satuan_inventori` AS `satuan_inventori`,`ei`.`harga_barang` AS `harga_barang`,`ei`.`kategori_inventori` AS `kategori_inventori`,`ei`.`jumlah_inventori` AS `jumlah_inventori`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`status_keluar` AS `status_keluar`,`f`.`status_pengembalian` AS `status_pengembalian`,`f`.`status_approval` AS `status_approval`,`ei`.`created_by` AS `created_by`,`ei`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`df`.`id_faktur` AS `id_faktur`,`df`.`jumlah_inventori` AS `jumlah_inventori_faktur`,`s`.`singkatan_satuan` AS `singkatan_satuan`,`df`.`harga_barang` AS `harga_barang_faktur` from (((`e_detail_faktur` `df` join `e_inventori` `ei` on((`df`.`id_inventori` = `ei`.`id_inventori`))) join `e_satuan_inventori` `s` on((`s`.`id_satuan` = `ei`.`satuan_inventori`))) join `e_faktur` `f` on((`f`.`id_faktur` = `df`.`id_faktur`)));

-- Dumping structure for view e-inventori.v_faktur
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_faktur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_faktur` AS select `f`.`id_faktur` AS `id_faktur`,`f`.`kode_faktur` AS `kode_faktur`,`f`.`catatan_faktur` AS `catatan_faktur`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`status_keluar` AS `status_keluar`,`f`.`status_pengembalian` AS `status_pengembalian`,`f`.`status_approval` AS `status_approval`,`f`.`created_by` AS `created_by`,`f`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`f`.`approval_time` AS `approval_time`,`f`.`dikembalikan_oleh` AS `dikembalikan_oleh`,`f`.`tgl_pengembalian` AS `tgl_pengembalian`,`f`.`qrcode_faktur` AS `qrcode_faktur`,`f`.`barcode_faktur` AS `barcode_faktur`,sum((`df`.`harga_barang` * `df`.`jumlah_inventori`)) AS `total_belanja`,`p`.`nama_lengkap` AS `pembuat_faktur`,`p2`.`nama_lengkap` AS `pengaprove_faktur`,`p3`.`nama_lengkap` AS `pengembali_faktur` from ((((`e_faktur` `f` join `e_detail_faktur` `df` on((`f`.`id_faktur` = `df`.`id_faktur`))) join `e_pengguna` `p` on((`p`.`id_pengguna` = `f`.`created_by`))) left join `e_pengguna` `p2` on((`p2`.`id_pengguna` = `f`.`approval_by`))) left join `e_pengguna` `p3` on((`p3`.`id_pengguna` = `f`.`dikembalikan_oleh`))) group by `df`.`id_faktur`;

-- Dumping structure for view e-inventori.v_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventori` AS select `i`.`id_inventori` AS `id_inventori`,`i`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit`,`i`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`es`.`kode_sumber_dana` AS `kode_sumber_dana`,`es`.`keterangan_sumber_dana` AS `keterangan_sumber_dana`,`i`.`kode_inventori` AS `kode_inventori`,`i`.`nama_inventori` AS `nama_inventori`,`i`.`satuan_inventori` AS `satuan_inventori`,`i`.`harga_barang` AS `harga_barang`,`i`.`kategori_inventori` AS `kategori_inventori`,`i`.`jumlah_inventori` AS `jumlah_inventori`,`i`.`qrcode` AS `qrcode`,`i`.`barcode` AS `barcode`,`i`.`created_by` AS `created_by`,`i`.`created_time` AS `created_time`,`i`.`updated_by` AS `updated_by`,`i`.`updated_time` AS `updated_time`,`ki`.`nama_kategori` AS `nama_kategori`,`si`.`nama_satuan` AS `nama_satuan`,`si`.`singkatan_satuan` AS `singkatan_satuan` from (((((`e_inventori` `i` join `e_unit` `u` on((`i`.`kode_unit` = `u`.`kode_unit`))) join `e_sub_unit` `su` on(((`i`.`kode_sub_unit` = `su`.`kode_sub_unit`) and (`su`.`unit` = `u`.`id_unit`)))) join `e_kategori_inventori` `ki` on((`i`.`kategori_inventori` = `ki`.`id_kategori`))) join `e_satuan_inventori` `si` on((`i`.`satuan_inventori` = `si`.`id_satuan`))) left join `e_sumber_dana` `es` on((`i`.`kode_sumber_dana` = `es`.`kode_sumber_dana`)));

-- Dumping structure for view e-inventori.v_pengguna
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_pengguna`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengguna` AS select `p`.`id_pengguna` AS `id_pengguna`,`p`.`username` AS `username`,`p`.`password` AS `password`,`p`.`email` AS `email`,`p`.`hak_akses` AS `hak_akses`,`p`.`nama_lengkap` AS `nama_lengkap`,`p`.`foto_pengguna` AS `foto_pengguna`,`p`.`no_wa` AS `no_wa`,`p`.`unit` AS `unit`,`p`.`sub_unit` AS `sub_unit`,`p`.`jenkel` AS `jenkel`,`p`.`tgl_lahir` AS `tgl_lahir`,`p`.`alamat` AS `alamat`,`p`.`last_login` AS `last_login`,`p`.`last_logout` AS `last_logout`,`p`.`created_time` AS `created_time`,`p`.`created_by` AS `created_by`,`p`.`updated_time` AS `updated_time`,`p`.`updated_by` AS `updated_by`,`u`.`nama_unit` AS `nama_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit` from ((`e_pengguna` `p` left join `e_unit` `u` on((`p`.`unit` = `u`.`id_unit`))) left join `e_sub_unit` `su` on((`p`.`sub_unit` = `su`.`id_sub_unit`)));

-- Dumping structure for view e-inventori.v_sub_unit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_sub_unit`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sub_unit` AS select `su`.`id_sub_unit` AS `id_sub_unit`,`su`.`unit` AS `unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`su`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`created_by` AS `created_by`,`su`.`created_time` AS `created_time`,`su`.`updated_by` AS `updated_by`,`su`.`updated_time` AS `updated_time`,`u`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit` from (`e_sub_unit` `su` join `e_unit` `u` on((`su`.`unit` = `u`.`id_unit`)));

-- Dumping structure for view e-inventori.v_ticketing
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_ticketing`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticketing` AS select `t`.`id_ticket` AS `id_ticket`,`t`.`nama_lengkap` AS `nama_lengkap`,`t`.`foto_laporan` AS `foto_laporan`,`t`.`id_unit` AS `id_unit`,`t`.`id_sub_unit` AS `id_sub_unit`,`t`.`detail_lokasi` AS `detail_lokasi`,`t`.`keterangan_laporan` AS `keterangan_laporan`,`t`.`status_laporan` AS `status_laporan`,`t`.`dibuat_pada` AS `dibuat_pada`,`t`.`ditanggapi_oleh` AS `ditanggapi_oleh`,`t`.`tanggapan_laporan` AS `tanggapan_laporan`,`t`.`ditanggapi_pada` AS `ditanggapi_pada`,`u`.`nama_unit` AS `nama_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`p`.`nama_lengkap` AS `nama_penanggap` from (((`e_ticketing` `t` left join `e_pengguna` `p` on((`t`.`ditanggapi_oleh` = `p`.`id_pengguna`))) left join `e_unit` `u` on((`t`.`id_unit` = `u`.`id_unit`))) left join `e_sub_unit` `su` on(((`t`.`id_sub_unit` = `su`.`id_sub_unit`) and (`u`.`id_unit` = `su`.`unit`))));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
