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

-- Dumping structure for table e-inventori.e_bidang
CREATE TABLE IF NOT EXISTS `e_bidang` (
  `id_bid` int(11) NOT NULL AUTO_INCREMENT,
  `kd_bid` int(2) unsigned zerofill NOT NULL,
  `ur_bid` varchar(250) NOT NULL,
  `gol` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_bid`),
  UNIQUE KEY `kd_bid` (`kd_bid`),
  KEY `FK_e_bidang_e_golongan` (`gol`),
  CONSTRAINT `FK_e_bidang_e_golongan` FOREIGN KEY (`gol`) REFERENCES `e_golongan` (`kd_gol`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_bidang: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_bidang` DISABLE KEYS */;
INSERT INTO `e_bidang` (`id_bid`, `kd_bid`, `ur_bid`, `gol`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 01, 'TANAH', '1', 1, '2021-11-02 20:59:46', NULL, NULL),
	(2, 02, 'BANGUNAN', '1', 1, '2021-11-02 21:34:04', NULL, NULL);
/*!40000 ALTER TABLE `e_bidang` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_detail_faktur
CREATE TABLE IF NOT EXISTS `e_detail_faktur` (
  `id_detail_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `id_faktur` int(11) NOT NULL,
  `id_inventori` int(11) NOT NULL,
  `keterangan_mutasi` varchar(250) DEFAULT NULL,
  `unit_awal` int(11) DEFAULT NULL,
  `sub_unit_awal` int(11) DEFAULT NULL,
  `unit_pindah` int(11) DEFAULT NULL,
  `sub_unit_pindah` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_detail_faktur`),
  KEY `FK_detail_faktur_id_faktur` (`id_faktur`),
  KEY `FK_detail_faktur_id_inventori` (`id_inventori`),
  CONSTRAINT `FK_detail_faktur_id_faktur` FOREIGN KEY (`id_faktur`) REFERENCES `e_faktur` (`id_faktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_detail_faktur_id_inventori` FOREIGN KEY (`id_inventori`) REFERENCES `e_inventori` (`id_inventori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_detail_faktur: ~2 rows (approximately)
/*!40000 ALTER TABLE `e_detail_faktur` DISABLE KEYS */;
INSERT INTO `e_detail_faktur` (`id_detail_faktur`, `id_faktur`, `id_inventori`, `keterangan_mutasi`, `unit_awal`, `sub_unit_awal`, `unit_pindah`, `sub_unit_pindah`) VALUES
	(9, 33, 16, NULL, NULL, NULL, NULL, NULL),
	(13, 34, 16, NULL, 2, 3, 2, 1);
/*!40000 ALTER TABLE `e_detail_faktur` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_faktur
CREATE TABLE IF NOT EXISTS `e_faktur` (
  `id_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `kode_faktur` varchar(20) DEFAULT NULL,
  `nim_mahasiswa` varchar(20) DEFAULT NULL,
  `catatan_faktur` varchar(250) NOT NULL,
  `kategori_faktur` enum('mutasi','out') NOT NULL,
  `status_keluar` enum('pinjam','rusak') DEFAULT NULL,
  `status_pengembalian` enum('belum','sudah') DEFAULT 'belum',
  `status_approval` enum('pending','accept','reject') NOT NULL DEFAULT 'pending',
  `durasi` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_faktur: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_faktur` DISABLE KEYS */;
INSERT INTO `e_faktur` (`id_faktur`, `kode_faktur`, `nim_mahasiswa`, `catatan_faktur`, `kategori_faktur`, `status_keluar`, `status_pengembalian`, `status_approval`, `durasi`, `created_by`, `created_time`, `updated_by`, `updated_time`, `approval_by`, `approval_time`, `dikembalikan_oleh`, `tgl_pengembalian`, `qrcode_faktur`, `barcode_faktur`) VALUES
	(33, 'A1234', '171402030', 'Testing', 'out', 'pinjam', 'belum', 'pending', 30, 1, '2021-10-21 06:28:21', NULL, NULL, NULL, NULL, NULL, NULL, 'assets/img/qrfaktur/Faktur-33.png', 'assets/img/barcodefaktur/33.png'),
	(34, 'M123', NULL, 'Test Mutasis', 'mutasi', NULL, 'belum', 'accept', NULL, 1, '2021-10-21 09:24:29', 1, '2021-10-22 10:18:18', 1, '2021-10-23 08:30:49', NULL, NULL, 'assets/img/qrfaktur/Faktur-34.png', 'assets/img/barcodefaktur/34.png');
/*!40000 ALTER TABLE `e_faktur` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_golongan
CREATE TABLE IF NOT EXISTS `e_golongan` (
  `id_gol` int(11) NOT NULL AUTO_INCREMENT,
  `kd_gol` varchar(50) NOT NULL,
  `ur_gol` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_gol`),
  UNIQUE KEY `kd_gol` (`kd_gol`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_golongan: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_golongan` DISABLE KEYS */;
INSERT INTO `e_golongan` (`id_gol`, `kd_gol`, `ur_gol`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, '1', 'TANAH', 1, '2021-11-02 20:59:29', NULL, NULL);
/*!40000 ALTER TABLE `e_golongan` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_hak_akses
CREATE TABLE IF NOT EXISTS `e_hak_akses` (
  `id_hak_akses` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hak_akses` varchar(225) NOT NULL,
  `modul_akses` text NOT NULL,
  `parent_modul_akses` text,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_hak_akses`),
  UNIQUE KEY `nama_hak_akses` (`nama_hak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_hak_akses: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_hak_akses` DISABLE KEYS */;
INSERT INTO `e_hak_akses` (`id_hak_akses`, `nama_hak_akses`, `modul_akses`, `parent_modul_akses`, `created_time`) VALUES
	(1, 'superuser', '{\n    "modul": [\n        "pengguna",\n        "createPengguna",\n        "updatePengguna",\n        "deletePengguna",\n        "hakAkses",\n        "createHakAkses",\n        "updateHakAkses",\n        "deleteHakAkses",\n        "daftarUnit",\n        "tambahUnit",\n        "updateUnit",\n        "deleteUnit",\n        "daftarSubUnit",\n        "tambahSubUnit",\n        "updateSubUnit",\n        "deleteSubUnit",\n        "daftarSumberDana",\n        "tambahSumberDana",\n        "updateSumberDana",\n        "deleteSumberDana",\n        "listInventori",\n        "createInventori",\n        "updateInventori",\n        "deleteInventori",\n        "kategori",\n        "createKategori",\n        "updateKategori",\n        "deleteKategori",\n        "inventoriKeluar",\n        "createInventoriKeluar",\n        "updateInventoriKeluar",\n        "deleteInventoriKeluar",\n        "approveInventoriKeluar",\n        "detailInventori",\n        "detailInventoriKeluar",\n        "rejectInventoriKeluar",\n        "laporanInventori",\n        "daftarMutasi",\n        "tambahMutasi",\n        "updateMutasi",\n        "deleteMutasi",\n        "approveMutasi",\n        "rejectMutasi",\n        "detailMutasi",\n        "laporanMutasi",\n        "scanInventori",\n        "scanFaktur",\n        "scanBarcodeInventori",\n        "scanBarcodeFaktur",\n        "daftarTiket",\n        "detailTiket",\n        "tanggapanTiket",\n        "hapusTiket",\n        "identitasAplikasi",\n        "daftarModul"\n    ]\n}', '{\n    "parent_modul": [\n        "Dashboard",\n        "MasterData",\n        "Inventori",\n        "Scan",\n        "Tiket",\n        "Pengaturan"\n    ]\n}', '2021-06-10 09:21:01'),
	(2, 'staff', '{\n    "modul": [\n        "daftarUnit",\n        "tambahUnit",\n        "updateUnit",\n        "deleteUnit",\n        "daftarSubUnit",\n        "tambahSubUnit",\n        "updateSubUnit",\n        "deleteSubUnit",\n        "daftarSumberDana",\n        "tambahSumberDana",\n        "updateSumberDana",\n        "deleteSumberDana",\n        "listInventori",\n        "createInventori",\n        "updateInventori",\n        "deleteInventori",\n        "kategori",\n        "createKategori",\n        "updateKategori",\n        "deleteKategori",\n        "inventoriKeluar",\n        "createInventoriKeluar",\n        "updateInventoriKeluar",\n        "deleteInventoriKeluar",\n        "approveInventoriKeluar",\n        "detailInventori",\n        "detailInventoriKeluar",\n        "rejectInventoriKeluar",\n        "laporanInventori",\n        "daftarMutasi",\n        "tambahMutasi",\n        "updateMutasi",\n        "deleteMutasi",\n        "approveMutasi",\n        "rejectMutasi",\n        "detailMutasi",\n        "laporanMutasi",\n        "scanInventori",\n        "scanFaktur",\n        "scanBarcodeInventori",\n        "scanBarcodeFaktur",\n        "daftarTiket",\n        "detailTiket",\n        "tanggapanTiket",\n        "hapusTiket"\n    ]\n}', '{\n    "parent_modul": [\n        "Dashboard",\n        "MasterData",\n        "Inventori",\n        "Scan",\n        "Tiket"\n    ]\n}', '2021-10-14 07:18:58');
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
  `foto_inventori` varchar(250) DEFAULT NULL,
  `keterangan_inventori` varchar(250) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `kategori_inventori` int(11) NOT NULL,
  `qrcode` varchar(250) DEFAULT NULL,
  `barcode` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `status_inventori` enum('Tersedia','Rusak','Dipinjam') NOT NULL DEFAULT 'Tersedia',
  PRIMARY KEY (`id_inventori`),
  UNIQUE KEY `kode_inventori` (`kode_inventori`),
  KEY `FK_e_inventori_e_unit` (`kode_unit`),
  KEY `FK_e_inventori_e_sub_unit` (`kode_sub_unit`),
  KEY `FK_e_inventori_e_sumber_dana` (`kode_sumber_dana`),
  CONSTRAINT `FK_e_inventori_e_sub_unit` FOREIGN KEY (`kode_sub_unit`) REFERENCES `e_sub_unit` (`kode_sub_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_sumber_dana` FOREIGN KEY (`kode_sumber_dana`) REFERENCES `e_sumber_dana` (`kode_sumber_dana`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_unit` FOREIGN KEY (`kode_unit`) REFERENCES `e_unit` (`kode_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_inventori: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_inventori` DISABLE KEYS */;
INSERT INTO `e_inventori` (`id_inventori`, `kode_unit`, `kode_sub_unit`, `kode_sumber_dana`, `kode_inventori`, `nama_inventori`, `foto_inventori`, `keterangan_inventori`, `harga_barang`, `kategori_inventori`, `qrcode`, `barcode`, `created_by`, `created_time`, `updated_by`, `updated_time`, `status_inventori`) VALUES
	(16, 'GF1', 'RA1', 'APBN', '3.03.01.03.001.0001', 'Kursi 0001', 'assets/img/fotoInventori/no-image-icon-234851.png', NULL, 25000, 3, 'assets/img/qrbarang/3.03.01.03.001.0001.png', 'assets/img/barcodebarang/3.03.01.03.001.0001.png', 1, '2021-10-20 08:34:05', 1, '2021-10-23 08:30:50', 'Dipinjam');
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

-- Dumping structure for table e-inventori.e_kelompok
CREATE TABLE IF NOT EXISTS `e_kelompok` (
  `id_kel` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kel` int(2) unsigned zerofill NOT NULL,
  `ur_kel` varchar(250) NOT NULL,
  `bid` int(2) unsigned zerofill NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kel`),
  UNIQUE KEY `kd_kel` (`kd_kel`),
  KEY `FK_e_kelompok_e_bidang` (`bid`),
  CONSTRAINT `FK_e_kelompok_e_bidang` FOREIGN KEY (`bid`) REFERENCES `e_bidang` (`kd_bid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_kelompok: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_kelompok` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_kelompok` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_modul: ~54 rows (approximately)
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
	(26, 'inventoriKeluar', 'Daftar Inventori Keluar', 'panel/inventori/inventoriKeluar', 'R', 'Inventori', '2021-06-10 08:31:16', 'Y', 'N', NULL),
	(27, 'createInventoriKeluar', 'Tambah Inventori Keluar', 'panel/inventori/createInventoriKeluar', 'C', 'Inventori', '2021-06-10 08:31:38', 'N', 'N', NULL),
	(28, 'updateInventoriKeluar', 'Update Inventori Keluar', 'panel/inventori/updateInventoriKeluar', 'U', 'Inventori', '2021-06-10 08:31:58', 'N', 'N', NULL),
	(29, 'deleteInventoriKeluar', 'Delete Inventori Keluar', 'panel/inventori/deleteInventoriKeluar', 'D', 'Inventori', '2021-06-10 08:32:20', 'N', 'N', NULL),
	(30, 'approveInventoriKeluar', 'Approve Inventori Keluar', 'panel/inventori/approveInventoriKeluar', 'U', 'Inventori', '2021-06-10 08:32:46', 'N', 'N', NULL),
	(31, 'identitasAplikasi', 'Identitas Aplikasi', 'panel/pengaturan/identitasAplikasi', 'U', 'Pengaturan', '2021-06-10 08:33:19', 'Y', 'N', NULL),
	(32, 'daftarModul', 'Daftar Modul', 'panel/pengaturan/daftarModul', 'R', 'Pengaturan', '2021-06-10 08:33:43', 'Y', 'N', NULL),
	(33, 'detailInventori', 'Detail inventori', 'panel/inventori/detailInventori', 'R', 'Inventori', '2021-06-11 23:51:22', 'N', 'N', NULL),
	(35, 'detailInventoriKeluar', 'Detail Inventori Keluar', 'panel/inventori/detailInventoriKeluar', 'R', 'Inventori', '2021-06-12 11:24:57', 'N', 'N', NULL),
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
	(58, 'hapusTiket', 'Hapus Tiket', 'panel/tiket/hapusTiket', 'D', 'Tiket', '2021-10-13 22:14:54', 'N', 'N', NULL),
	(59, 'daftarMutasi', 'Daftar Mutasi Barang', 'panel/inventori/daftarMutasi', 'R', 'Inventori', '2021-10-19 19:53:03', 'Y', 'N', NULL),
	(60, 'tambahMutasi', 'Tambah Mutasi Barang', 'panel/inventori/tambahMutasi', 'C', 'Inventori', '2021-10-19 19:53:45', 'N', 'N', NULL),
	(61, 'updateMutasi', 'Update Mutasi Barang', 'panel/inventori/updateMutasi', 'U', 'Inventori', '2021-10-19 19:54:08', 'N', 'N', NULL),
	(62, 'deleteMutasi', 'Delete Mutasi Barang', 'panel/inventori/deleteMutasi', 'D', 'Inventori', '2021-10-19 19:54:41', 'N', 'N', NULL),
	(63, 'approveMutasi', 'Approve Mutasi Barang', 'panel/inventori/approveMutasi', 'U', 'Inventori', '2021-10-19 19:55:12', 'N', 'N', NULL),
	(64, 'rejectMutasi', 'Reject Mutasi Barang', 'panel/inventori/rejectInventori', 'U', 'Inventori', '2021-10-21 00:12:37', 'N', 'N', NULL),
	(65, 'detailMutasi', 'Detail Mutasi Barang', 'panel/inventori/detailMutasi', 'R', 'Inventori', '2021-10-21 00:13:08', 'N', 'N', NULL),
	(66, 'laporanMutasi', 'Laporan Mutasi Barang', 'panel/inventori/laporanMutasi', 'R', 'Inventori', '2021-10-23 08:32:25', 'Y', 'N', NULL),
	(67, 'daftarGolongan', 'Daftar Golongan', 'panel/masterData/daftarGolongan', 'R', 'MasterData', '2021-11-02 21:47:33', 'Y', 'N', NULL),
	(68, 'createGolongan', 'Tambah Golongan', 'panel/masterData/createGolongan', 'C', 'MasterData', '2021-11-02 21:47:52', 'N', 'N', NULL),
	(69, 'updateGolongan', 'Update Golongan', 'panel/masterData/updateGolongan', 'U', 'MasterData', '2021-11-02 21:48:11', 'N', 'N', NULL),
	(70, 'deleteGolongan', 'Delete Golongan', 'panel/masterData/deleteGolongan', 'D', 'MasterData', '2021-11-02 21:48:28', 'N', 'N', NULL),
	(71, 'daftarBidang', 'Daftar Bidang', 'panel/masterData/daftarBidang', 'R', 'MasterData', '2021-11-02 21:48:50', 'Y', 'N', NULL),
	(72, 'createBidang', 'Tambah Bidang', 'panel/masterData/createBidang', 'C', 'MasterData', '2021-11-02 21:49:10', 'N', 'N', NULL),
	(73, 'updateBidang', 'Update Bidang', 'panel/masterData/updateBidang', 'U', 'MasterData', '2021-11-02 21:49:26', 'N', 'N', NULL),
	(74, 'deleteBidang', 'Delete Bidang', 'panel/masterData/deleteBidang', 'D', 'MasterData', '2021-11-02 21:49:40', 'N', 'N', NULL),
	(75, 'daftarKelompok', 'Daftar Kelompok', 'panel/masterData/daftarKelompok', 'R', 'MasterData', '2021-11-02 21:50:12', 'Y', 'N', NULL),
	(76, 'createKelompok', 'Tambah Kelompok', 'panel/masterData/createKelompok', 'C', 'MasterData', '2021-11-02 21:50:37', 'N', 'N', NULL),
	(77, 'updateKelompok', 'Update Kelompok', 'panel/masterData/updateKelompok', 'U', 'MasterData', '2021-11-02 21:50:56', 'N', 'N', NULL),
	(78, 'deleteKelompok', 'Delete Kelompok', 'panel/masterData/deleteKelompok', 'D', 'MasterData', '2021-11-02 21:51:16', 'N', 'N', NULL),
	(79, 'daftarSubKelompok', 'Daftar Sub Kelompok', 'panel/masterData/daftarSubKelompok', 'R', 'MasterData', '2021-11-02 21:51:38', 'Y', 'N', NULL),
	(80, 'createSubKelompok', 'Tambah Sub Kelompok', 'panel/masterData/createSubKelompok', 'C', 'MasterData', '2021-11-02 21:51:59', 'N', 'N', NULL),
	(81, 'updateSubKelompok', 'Update Sub Kelompok', 'panel/masterData/updateSubKelompok', 'U', 'MasterData', '2021-11-02 21:52:23', 'N', 'N', NULL),
	(82, 'deleteSubKelompok', 'Delete Sub Kelompok', 'panel/masterData/deleteSubKelompok', 'D', 'MasterData', '2021-11-02 21:52:44', 'N', 'N', NULL),
	(83, 'daftarSubSubKelompok', 'Daftar Sub-sub Kelompok', 'panel/masterData/daftarSubSubKelompok', 'R', 'MasterData', '2021-11-02 21:53:16', 'Y', 'N', NULL),
	(84, 'createSubSubKelompok', 'Tambah Sub-sub Kelompok', 'panel/masterData/createSubSubKelompok', 'C', 'MasterData', '2021-11-02 21:53:43', 'N', 'N', NULL),
	(85, 'updateSubSubKelompok', 'Update Sub-sub Kelompok', 'panel/masterData/updateSubSubKelompok', 'U', 'MasterData', '2021-11-02 21:54:05', 'N', 'N', NULL),
	(86, 'deleteSubSubKelompok', 'Delet Sub-sub Kelompok', 'panel/masterData/deleteSubSubKelompok', 'D', 'MasterData', '2021-11-02 21:54:26', 'N', 'N', NULL);
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

-- Dumping data for table e-inventori.e_parent_modul: ~6 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_pengguna: ~1 rows (approximately)
/*!40000 ALTER TABLE `e_pengguna` DISABLE KEYS */;
INSERT INTO `e_pengguna` (`id_pengguna`, `username`, `password`, `email`, `hak_akses`, `nama_lengkap`, `foto_pengguna`, `no_wa`, `unit`, `sub_unit`, `jenkel`, `tgl_lahir`, `alamat`, `last_login`, `last_logout`, `created_time`, `created_by`, `updated_time`, `updated_by`) VALUES
	(1, 'superuser', '72d8f949d00e431239b993f14b70d80d5313efc9', 'test@mail.com', 'superuser', 'superuser', '', NULL, NULL, NULL, 'L', NULL, NULL, '2021-11-01 14:28:59', '2021-10-15 13:58:38', '2021-06-10 09:32:44', NULL, NULL, NULL),
	(2, 'rorkyendo', '72d8f949d00e431239b993f14b70d80d5313efc9', 'taufiqrorkyendo@gmail.com', 'staff', 'Taufiq Rorkyendo', NULL, '082276648478', 2, 0, 'L', NULL, NULL, NULL, NULL, '2021-10-14 07:19:32', NULL, NULL, NULL);
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

-- Dumping structure for table e-inventori.e_sub_kelompok
CREATE TABLE IF NOT EXISTS `e_sub_kelompok` (
  `id_sub_kel` int(11) NOT NULL AUTO_INCREMENT,
  `kd_skel` int(2) unsigned zerofill NOT NULL,
  `ur_skel` varchar(250) NOT NULL,
  `kel` int(2) unsigned zerofill NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sub_kel`),
  UNIQUE KEY `kd_skel` (`kd_skel`),
  KEY `FK_e_sub_kelompok_e_kelompok` (`kel`),
  CONSTRAINT `FK_e_sub_kelompok_e_kelompok` FOREIGN KEY (`kel`) REFERENCES `e_kelompok` (`kd_kel`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_sub_kelompok: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_sub_kelompok` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_sub_kelompok` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_sub_sub_kelompok
CREATE TABLE IF NOT EXISTS `e_sub_sub_kelompok` (
  `id_ssub_kel` int(11) NOT NULL AUTO_INCREMENT,
  `kd_sskel` int(3) unsigned zerofill NOT NULL,
  `ur_sskel` varchar(250) NOT NULL,
  `skel` int(2) unsigned zerofill NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ssub_kel`),
  UNIQUE KEY `kd_sskel` (`kd_sskel`),
  KEY `FK_e_ssub_kelompok_e_kelompok` (`skel`),
  CONSTRAINT `FK_e_ssub_kelompok_e_kelompok` FOREIGN KEY (`skel`) REFERENCES `e_sub_kelompok` (`kd_skel`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_sub_sub_kelompok: ~0 rows (approximately)
/*!40000 ALTER TABLE `e_sub_sub_kelompok` DISABLE KEYS */;
/*!40000 ALTER TABLE `e_sub_sub_kelompok` ENABLE KEYS */;

-- Dumping structure for table e-inventori.e_sub_unit
CREATE TABLE IF NOT EXISTS `e_sub_unit` (
  `id_sub_unit` int(11) NOT NULL AUTO_INCREMENT,
  `unit` int(11) NOT NULL,
  `nama_sub_unit` varchar(250) NOT NULL,
  `keterangan_sub_unit` varchar(250) DEFAULT NULL,
  `kode_sub_unit` varchar(20) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_sub_unit`),
  UNIQUE KEY `kode_sub_unit` (`kode_sub_unit`,`unit`),
  KEY `FK_e_sub_unit_e_unit` (`unit`),
  CONSTRAINT `FK_e_sub_unit_e_unit` FOREIGN KEY (`unit`) REFERENCES `e_unit` (`id_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_sub_unit: ~3 rows (approximately)
/*!40000 ALTER TABLE `e_sub_unit` DISABLE KEYS */;
INSERT INTO `e_sub_unit` (`id_sub_unit`, `unit`, `nama_sub_unit`, `keterangan_sub_unit`, `kode_sub_unit`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(1, 2, 'Ruang A1', NULL, 'RA1', 1, '2021-10-02 08:30:46', NULL, NULL),
	(2, 3, 'Ruang A1', NULL, 'RA1', 1, '2021-10-02 08:31:27', NULL, NULL),
	(3, 2, 'Ruang A2', NULL, 'RA2', 1, '2021-10-15 14:39:10', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_sumber_dana: ~3 rows (approximately)
/*!40000 ALTER TABLE `e_sumber_dana` DISABLE KEYS */;
INSERT INTO `e_sumber_dana` (`id_sumber_dana`, `kode_sumber_dana`, `keterangan_sumber_dana`, `created_by`, `created_time`, `updated_by`, `updated_time`) VALUES
	(2, 'APBN', 'Sumber Dana APBN', 1, '2021-10-19 20:06:25', NULL, NULL),
	(3, 'NON-PNBP', 'Sumber Dana NON-PNBP', 1, '2021-10-19 20:06:51', NULL, NULL),
	(4, 'Sumbangan Alumni', 'Sumber Dana Sumbangan Alumni', 1, '2021-10-19 20:07:21', NULL, NULL),
	(5, 'Sumbangan Lainnya', 'Sumber Dana Sumbangan Lainnya', 1, '2021-10-19 20:07:41', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table e-inventori.e_ticketing: ~3 rows (approximately)
/*!40000 ALTER TABLE `e_ticketing` DISABLE KEYS */;
INSERT INTO `e_ticketing` (`id_ticket`, `nama_lengkap`, `foto_laporan`, `id_unit`, `id_sub_unit`, `detail_lokasi`, `keterangan_laporan`, `status_laporan`, `dibuat_pada`, `ditanggapi_oleh`, `tanggapan_laporan`, `ditanggapi_pada`) VALUES
	(1, 'Taufiq Rorkyendo', 'assets/img/fotoLaporan/ESP32-Pinout.jpg', 2, 1, 'Dekat Pojok ruang 1', 'Barangnya rusak parah', 'Y', '2021-10-13 18:54:18', 1, 'Oke akan segera kami proses, terimakasih atas laporannya', '2021-10-13 23:12:35'),
	(3, 'Taufiq Rorkyendo', 'assets/img/fotoLaporan/SS_Presentase.png', 2, 1, 'Dekat pojok ruang A1', 'Barang tercecer', 'N', '2021-10-14 07:28:59', NULL, NULL, NULL),
	(4, 'Taufiq Rorkyendo', 'assets/img/fotoLaporan/sidebar.jpg', 2, 1, 'Dipojok ruang 1', 'AC Rusak', 'Y', '2021-10-14 13:43:24', 1, 'ok segera di proses', '2021-10-14 13:44:41'),
	(5, 'Taufiq Rorkyendo', 'assets/img/fotoLaporan/7c81df264ec4e98b.png', 2, 1, 'Dipojok ruang 1', 'Ada barang yang rusak', 'Y', '2021-10-15 14:02:47', 1, 'Oke segera di proses', '2021-10-15 14:04:28');
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
	`nama_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_sub_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_sub_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_inventori` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_inventori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`harga_barang` INT(11) NULL,
	`kategori_inventori` INT(11) NOT NULL,
	`kategori_faktur` ENUM('mutasi','out') NOT NULL COLLATE 'latin1_swedish_ci',
	`status_keluar` ENUM('pinjam','rusak') NULL COLLATE 'latin1_swedish_ci',
	`status_pengembalian` ENUM('belum','sudah') NULL COLLATE 'latin1_swedish_ci',
	`status_approval` ENUM('pending','accept','reject') NOT NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`id_faktur` INT(11) NOT NULL,
	`nama_unit_awal` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_unit_awal` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`unit_awal` INT(11) NULL,
	`nama_sub_unit_awal` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_sub_unit_awal` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`sub_unit_awal` INT(11) NULL,
	`nama_unit_pindah` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_unit_pindah` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`unit_pindah` INT(11) NULL,
	`nama_sub_unit_pindah` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_sub_unit_pindah` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`sub_unit_pindah` INT(11) NULL,
	`keterangan_mutasi` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_faktur
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_faktur` (
	`id_faktur` INT(11) NOT NULL,
	`kode_faktur` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nim_mahasiswa` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`catatan_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kategori_faktur` ENUM('mutasi','out') NOT NULL COLLATE 'latin1_swedish_ci',
	`status_keluar` ENUM('pinjam','rusak') NULL COLLATE 'latin1_swedish_ci',
	`status_pengembalian` ENUM('belum','sudah') NULL COLLATE 'latin1_swedish_ci',
	`status_approval` ENUM('pending','accept','reject') NOT NULL COLLATE 'latin1_swedish_ci',
	`durasi` INT(11) NULL,
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`approval_time` DATETIME NULL,
	`dikembalikan_oleh` INT(11) NULL,
	`tgl_pengembalian` DATETIME NULL,
	`qrcode_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`barcode_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`pembuat_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`pengaprove_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`pengembali_faktur` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_inventori
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_inventori` (
	`id_inventori` INT(11) NOT NULL,
	`id_unit` INT(11) NOT NULL,
	`kode_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`id_sub_unit` INT(11) NOT NULL,
	`kode_sub_unit` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_sub_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan_sub_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_sumber_dana` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`keterangan_sumber_dana` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`foto_inventori` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`kode_inventori` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_inventori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`harga_barang` INT(11) NULL,
	`kategori_inventori` INT(11) NOT NULL,
	`qrcode` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`barcode` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`status_inventori` ENUM('Tersedia','Rusak','Dipinjam') NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_kategori` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci'
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
	`keterangan_sub_unit` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`kode_unit` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`nama_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`jmlInventori` BIGINT(21) NOT NULL
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

-- Dumping structure for view e-inventori.v_unit
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_unit` (
	`id_unit` INT(11) NOT NULL,
	`nama_unit` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`alamat_unit` TEXT NULL COLLATE 'latin1_swedish_ci',
	`kode_unit` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`created_time` INT(11) NOT NULL,
	`created_by` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`jmlInventori` BIGINT(21) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_detail_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_detail_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_inventori` AS select `ei`.`id_inventori` AS `id_inventori`,`ei`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit`,`ei`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`ei`.`kode_inventori` AS `kode_inventori`,`ei`.`nama_inventori` AS `nama_inventori`,`ei`.`harga_barang` AS `harga_barang`,`ei`.`kategori_inventori` AS `kategori_inventori`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`status_keluar` AS `status_keluar`,`f`.`status_pengembalian` AS `status_pengembalian`,`f`.`status_approval` AS `status_approval`,`ei`.`created_by` AS `created_by`,`ei`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`df`.`id_faktur` AS `id_faktur`,`ua`.`nama_unit` AS `nama_unit_awal`,`ua`.`kode_unit` AS `kode_unit_awal`,`df`.`unit_awal` AS `unit_awal`,`sua`.`nama_sub_unit` AS `nama_sub_unit_awal`,`sua`.`kode_sub_unit` AS `kode_sub_unit_awal`,`df`.`sub_unit_awal` AS `sub_unit_awal`,`up`.`nama_unit` AS `nama_unit_pindah`,`up`.`kode_unit` AS `kode_unit_pindah`,`df`.`unit_pindah` AS `unit_pindah`,`sup`.`nama_sub_unit` AS `nama_sub_unit_pindah`,`sup`.`kode_sub_unit` AS `kode_sub_unit_pindah`,`df`.`sub_unit_pindah` AS `sub_unit_pindah`,`df`.`keterangan_mutasi` AS `keterangan_mutasi` from ((((((((`e_detail_faktur` `df` join `e_inventori` `ei` on((`df`.`id_inventori` = `ei`.`id_inventori`))) join `e_faktur` `f` on((`f`.`id_faktur` = `df`.`id_faktur`))) left join `e_unit` `u` on((`u`.`kode_unit` = `ei`.`kode_unit`))) left join `e_sub_unit` `su` on(((`su`.`kode_sub_unit` = `ei`.`kode_sub_unit`) and (`su`.`unit` = `u`.`id_unit`)))) left join `e_unit` `ua` on((`df`.`unit_awal` = `ua`.`id_unit`))) left join `e_sub_unit` `sua` on(((`df`.`sub_unit_awal` = `sua`.`id_sub_unit`) and (`sua`.`unit` = `ua`.`id_unit`)))) left join `e_unit` `up` on((`df`.`unit_pindah` = `up`.`id_unit`))) left join `e_sub_unit` `sup` on(((`df`.`sub_unit_pindah` = `sup`.`id_sub_unit`) and (`sup`.`unit` = `up`.`id_unit`))));

-- Dumping structure for view e-inventori.v_faktur
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_faktur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_faktur` AS select `f`.`id_faktur` AS `id_faktur`,`f`.`kode_faktur` AS `kode_faktur`,`f`.`nim_mahasiswa` AS `nim_mahasiswa`,`f`.`catatan_faktur` AS `catatan_faktur`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`status_keluar` AS `status_keluar`,`f`.`status_pengembalian` AS `status_pengembalian`,`f`.`status_approval` AS `status_approval`,`f`.`durasi` AS `durasi`,`f`.`created_by` AS `created_by`,`f`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`f`.`approval_time` AS `approval_time`,`f`.`dikembalikan_oleh` AS `dikembalikan_oleh`,`f`.`tgl_pengembalian` AS `tgl_pengembalian`,`f`.`qrcode_faktur` AS `qrcode_faktur`,`f`.`barcode_faktur` AS `barcode_faktur`,`p`.`nama_lengkap` AS `pembuat_faktur`,`p2`.`nama_lengkap` AS `pengaprove_faktur`,`p3`.`nama_lengkap` AS `pengembali_faktur` from ((((`e_faktur` `f` join `e_detail_faktur` `df` on((`f`.`id_faktur` = `df`.`id_faktur`))) join `e_pengguna` `p` on((`p`.`id_pengguna` = `f`.`created_by`))) left join `e_pengguna` `p2` on((`p2`.`id_pengguna` = `f`.`approval_by`))) left join `e_pengguna` `p3` on((`p3`.`id_pengguna` = `f`.`dikembalikan_oleh`))) group by `df`.`id_faktur`;

-- Dumping structure for view e-inventori.v_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventori` AS select `i`.`id_inventori` AS `id_inventori`,`u`.`id_unit` AS `id_unit`,`i`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit`,`su`.`id_sub_unit` AS `id_sub_unit`,`i`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`su`.`keterangan_sub_unit` AS `keterangan_sub_unit`,`es`.`kode_sumber_dana` AS `kode_sumber_dana`,`es`.`keterangan_sumber_dana` AS `keterangan_sumber_dana`,`i`.`foto_inventori` AS `foto_inventori`,`i`.`kode_inventori` AS `kode_inventori`,`i`.`nama_inventori` AS `nama_inventori`,`i`.`harga_barang` AS `harga_barang`,`i`.`kategori_inventori` AS `kategori_inventori`,`i`.`qrcode` AS `qrcode`,`i`.`barcode` AS `barcode`,`i`.`created_by` AS `created_by`,`i`.`created_time` AS `created_time`,`i`.`updated_by` AS `updated_by`,`i`.`updated_time` AS `updated_time`,`i`.`status_inventori` AS `status_inventori`,`ki`.`nama_kategori` AS `nama_kategori` from ((((`e_inventori` `i` join `e_unit` `u` on((`i`.`kode_unit` = `u`.`kode_unit`))) join `e_sub_unit` `su` on(((`i`.`kode_sub_unit` = `su`.`kode_sub_unit`) and (`su`.`unit` = `u`.`id_unit`)))) join `e_kategori_inventori` `ki` on((`i`.`kategori_inventori` = `ki`.`id_kategori`))) left join `e_sumber_dana` `es` on((`i`.`kode_sumber_dana` = `es`.`kode_sumber_dana`)));

-- Dumping structure for view e-inventori.v_pengguna
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_pengguna`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pengguna` AS select `p`.`id_pengguna` AS `id_pengguna`,`p`.`username` AS `username`,`p`.`password` AS `password`,`p`.`email` AS `email`,`p`.`hak_akses` AS `hak_akses`,`p`.`nama_lengkap` AS `nama_lengkap`,`p`.`foto_pengguna` AS `foto_pengguna`,`p`.`no_wa` AS `no_wa`,`p`.`unit` AS `unit`,`p`.`sub_unit` AS `sub_unit`,`p`.`jenkel` AS `jenkel`,`p`.`tgl_lahir` AS `tgl_lahir`,`p`.`alamat` AS `alamat`,`p`.`last_login` AS `last_login`,`p`.`last_logout` AS `last_logout`,`p`.`created_time` AS `created_time`,`p`.`created_by` AS `created_by`,`p`.`updated_time` AS `updated_time`,`p`.`updated_by` AS `updated_by`,`u`.`nama_unit` AS `nama_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit` from ((`e_pengguna` `p` left join `e_unit` `u` on((`p`.`unit` = `u`.`id_unit`))) left join `e_sub_unit` `su` on((`p`.`sub_unit` = `su`.`id_sub_unit`)));

-- Dumping structure for view e-inventori.v_sub_unit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_sub_unit`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sub_unit` AS select `su`.`id_sub_unit` AS `id_sub_unit`,`su`.`unit` AS `unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`su`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`keterangan_sub_unit` AS `keterangan_sub_unit`,`su`.`created_by` AS `created_by`,`su`.`created_time` AS `created_time`,`su`.`updated_by` AS `updated_by`,`su`.`updated_time` AS `updated_time`,`u`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit`,count(`i`.`id_inventori`) AS `jmlInventori` from ((`e_sub_unit` `su` join `e_unit` `u` on((`su`.`unit` = `u`.`id_unit`))) left join `e_inventori` `i` on(((`i`.`kode_sub_unit` = `su`.`kode_sub_unit`) and (`i`.`kode_unit` = `u`.`kode_unit`)))) group by `su`.`unit`,`su`.`id_sub_unit`;

-- Dumping structure for view e-inventori.v_ticketing
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_ticketing`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticketing` AS select `t`.`id_ticket` AS `id_ticket`,`t`.`nama_lengkap` AS `nama_lengkap`,`t`.`foto_laporan` AS `foto_laporan`,`t`.`id_unit` AS `id_unit`,`t`.`id_sub_unit` AS `id_sub_unit`,`t`.`detail_lokasi` AS `detail_lokasi`,`t`.`keterangan_laporan` AS `keterangan_laporan`,`t`.`status_laporan` AS `status_laporan`,`t`.`dibuat_pada` AS `dibuat_pada`,`t`.`ditanggapi_oleh` AS `ditanggapi_oleh`,`t`.`tanggapan_laporan` AS `tanggapan_laporan`,`t`.`ditanggapi_pada` AS `ditanggapi_pada`,`u`.`nama_unit` AS `nama_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`p`.`nama_lengkap` AS `nama_penanggap` from (((`e_ticketing` `t` left join `e_pengguna` `p` on((`t`.`ditanggapi_oleh` = `p`.`id_pengguna`))) left join `e_unit` `u` on((`t`.`id_unit` = `u`.`id_unit`))) left join `e_sub_unit` `su` on(((`t`.`id_sub_unit` = `su`.`id_sub_unit`) and (`u`.`id_unit` = `su`.`unit`))));

-- Dumping structure for view e-inventori.v_unit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_unit`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_unit` AS select `u`.`id_unit` AS `id_unit`,`u`.`nama_unit` AS `nama_unit`,`u`.`alamat_unit` AS `alamat_unit`,`u`.`kode_unit` AS `kode_unit`,`u`.`created_time` AS `created_time`,`u`.`created_by` AS `created_by`,`u`.`updated_by` AS `updated_by`,`u`.`updated_time` AS `updated_time`,count(`i`.`id_inventori`) AS `jmlInventori` from (`e_unit` `u` left join `e_inventori` `i` on((`u`.`kode_unit` = `i`.`kode_unit`))) group by `u`.`kode_unit`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
