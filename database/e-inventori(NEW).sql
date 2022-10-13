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
  `gol` int(1) unsigned zerofill NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_bid`),
  UNIQUE KEY `kd_bid` (`kd_bid`,`gol`),
  KEY `FK_e_bidang_e_golongan` (`gol`),
  CONSTRAINT `FK_e_bidang_e_golongan` FOREIGN KEY (`gol`) REFERENCES `e_golongan` (`kd_gol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_detail_faktur
CREATE TABLE IF NOT EXISTS `e_detail_faktur` (
  `id_detail_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `id_faktur` int(11) NOT NULL,
  `id_inventori` int(11) NOT NULL,
  `status_penerimaan` enum('Y','N') DEFAULT NULL,
  `catatan_penerimaan` varchar(250) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_faktur
CREATE TABLE IF NOT EXISTS `e_faktur` (
  `id_faktur` int(11) NOT NULL AUTO_INCREMENT,
  `kode_faktur` varchar(20) DEFAULT NULL,
  `nim_mahasiswa` varchar(20) DEFAULT NULL,
  `nip_pegawai` varchar(20) DEFAULT NULL,
  `nama_peminjam` varchar(20) DEFAULT NULL,
  `wa_peminjam` varchar(20) DEFAULT NULL,
  `catatan_faktur` varchar(250) NOT NULL,
  `peminjam` enum('pegawai','mahasiswa') DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_golongan
CREATE TABLE IF NOT EXISTS `e_golongan` (
  `id_gol` int(11) NOT NULL AUTO_INCREMENT,
  `kd_gol` int(1) unsigned zerofill NOT NULL,
  `ur_gol` varchar(250) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_gol`),
  UNIQUE KEY `kd_gol` (`kd_gol`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_inventori
CREATE TABLE IF NOT EXISTS `e_inventori` (
  `id_inventori` int(11) NOT NULL AUTO_INCREMENT,
  `kode_unit` varchar(20) DEFAULT NULL,
  `kode_sub_unit` varchar(20) DEFAULT NULL,
  `kode_sumber_dana` varchar(20) DEFAULT NULL,
  `gol` int(1) unsigned zerofill NOT NULL,
  `bid` int(2) unsigned zerofill NOT NULL,
  `kel` int(2) unsigned zerofill NOT NULL,
  `skel` int(2) unsigned zerofill NOT NULL,
  `sskel` int(3) unsigned zerofill NOT NULL,
  `kode_inventori` varchar(50) NOT NULL,
  `no_inventori` int(4) unsigned zerofill NOT NULL,
  `kode_satker` varchar(250) DEFAULT NULL,
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
  KEY `FK_e_inventori_e_golongan` (`gol`),
  KEY `FK_e_inventori_e_bidang` (`bid`),
  KEY `FK_e_inventori_e_kelompok` (`kel`),
  KEY `FK_e_inventori_e_sub_kelompok` (`skel`),
  KEY `FK_e_inventori_e_sub_sub_kelompok` (`sskel`),
  CONSTRAINT `FK_e_inventori_e_bidang` FOREIGN KEY (`bid`) REFERENCES `e_bidang` (`kd_bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_golongan` FOREIGN KEY (`gol`) REFERENCES `e_golongan` (`kd_gol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_kelompok` FOREIGN KEY (`kel`) REFERENCES `e_kelompok` (`kd_kel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_sub_kelompok` FOREIGN KEY (`skel`) REFERENCES `e_sub_kelompok` (`kd_skel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_sub_sub_kelompok` FOREIGN KEY (`sskel`) REFERENCES `e_sub_sub_kelompok` (`kd_sskel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_sub_unit` FOREIGN KEY (`kode_sub_unit`) REFERENCES `e_sub_unit` (`kode_sub_unit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_sumber_dana` FOREIGN KEY (`kode_sumber_dana`) REFERENCES `e_sumber_dana` (`kode_sumber_dana`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `FK_e_inventori_e_unit` FOREIGN KEY (`kode_unit`) REFERENCES `e_unit` (`kode_unit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_kelompok
CREATE TABLE IF NOT EXISTS `e_kelompok` (
  `id_kel` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kel` int(2) unsigned zerofill NOT NULL,
  `ur_kel` varchar(250) NOT NULL,
  `bid` int(2) unsigned zerofill NOT NULL,
  `gol` int(1) unsigned zerofill NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kel`),
  UNIQUE KEY `kd_kel` (`kd_kel`,`bid`,`gol`),
  KEY `FK_e_kelompok_e_golongan` (`gol`),
  KEY `FK_e_kelompok_e_bidang` (`bid`),
  CONSTRAINT `FK_e_kelompok_e_bidang` FOREIGN KEY (`bid`) REFERENCES `e_bidang` (`kd_bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_kelompok_e_golongan` FOREIGN KEY (`gol`) REFERENCES `e_golongan` (`kd_gol`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1187 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_sub_kelompok
CREATE TABLE IF NOT EXISTS `e_sub_kelompok` (
  `id_skel` int(11) NOT NULL AUTO_INCREMENT,
  `kd_skel` int(2) unsigned zerofill NOT NULL,
  `ur_skel` varchar(250) NOT NULL,
  `kel` int(2) unsigned zerofill NOT NULL,
  `bid` int(2) unsigned zerofill NOT NULL,
  `gol` int(1) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_skel`),
  UNIQUE KEY `kd_skel` (`kd_skel`,`gol`,`bid`,`kel`),
  KEY `FK_e_sub_kelompok_e_kelompok` (`kel`),
  KEY `FK_e_sub_kelompok_e_bidang` (`bid`),
  KEY `FK_e_sub_kelompok_e_golongan` (`gol`),
  CONSTRAINT `FK_e_sub_kelompok_e_bidang` FOREIGN KEY (`bid`) REFERENCES `e_bidang` (`kd_bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_sub_kelompok_e_golongan` FOREIGN KEY (`gol`) REFERENCES `e_golongan` (`kd_gol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_sub_kelompok_e_kelompok` FOREIGN KEY (`kel`) REFERENCES `e_kelompok` (`kd_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1668 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_sub_sub_kelompok
CREATE TABLE IF NOT EXISTS `e_sub_sub_kelompok` (
  `id_ssub_kel` int(11) NOT NULL AUTO_INCREMENT,
  `kd_sskel` int(3) unsigned zerofill NOT NULL,
  `ur_sskel` varchar(250) NOT NULL,
  `skel` int(2) unsigned zerofill NOT NULL,
  `kel` int(2) unsigned zerofill NOT NULL,
  `bid` int(2) unsigned zerofill NOT NULL,
  `gol` int(1) unsigned NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ssub_kel`),
  UNIQUE KEY `kd_sskel` (`kd_sskel`,`skel`,`kel`,`bid`,`gol`),
  KEY `FK_e_ssub_kelompok_e_kelompok` (`skel`),
  KEY `FK_e_sub_sub_kelompok_e_kelompok` (`kel`),
  KEY `FK_e_sub_sub_kelompok_e_bidang` (`bid`),
  KEY `FK_e_sub_sub_kelompok_e_golongan` (`gol`),
  CONSTRAINT `FK_e_ssub_kelompok_e_kelompok` FOREIGN KEY (`skel`) REFERENCES `e_sub_kelompok` (`kd_skel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_sub_sub_kelompok_e_bidang` FOREIGN KEY (`bid`) REFERENCES `e_bidang` (`kd_bid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_sub_sub_kelompok_e_golongan` FOREIGN KEY (`gol`) REFERENCES `e_golongan` (`kd_gol`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_e_sub_sub_kelompok_e_kelompok` FOREIGN KEY (`kel`) REFERENCES `e_kelompok` (`kd_kel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11374 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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

-- Data exporting was unselected.

-- Dumping structure for table e-inventori.e_ticketing
CREATE TABLE IF NOT EXISTS `e_ticketing` (
  `id_ticket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(50) NOT NULL,
  `foto_laporan` varchar(250) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `id_sub_unit` int(11) DEFAULT NULL,
  `detail_lokasi` varchar(250) NOT NULL,
  `keterangan_laporan` varchar(250) NOT NULL,
  `status_laporan` enum('pending','accept','process','finish') NOT NULL DEFAULT 'pending',
  `dibuat_pada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ditanggapi_oleh` int(11) DEFAULT NULL,
  `tanggapan_laporan` varchar(250) DEFAULT NULL,
  `ditanggapi_pada` datetime DEFAULT NULL,
  `diperbaiki_oleh` varchar(150) DEFAULT NULL,
  `diselesaikan_pada` datetime DEFAULT NULL,
  `estimasi_selesai` datetime DEFAULT NULL,
  PRIMARY KEY (`id_ticket`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for view e-inventori.v_bidang
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_bidang` (
	`id_bid` INT(11) NOT NULL,
	`kd_bid` INT(2) UNSIGNED ZEROFILL NOT NULL,
	`ur_bid` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`gol` INT(1) UNSIGNED ZEROFILL NOT NULL,
	`created_by` INT(11) NOT NULL,
	`created_time` DATETIME NOT NULL,
	`updated_by` INT(11) NULL,
	`updated_time` DATETIME NULL,
	`kd_gol` INT(1) UNSIGNED ZEROFILL NULL,
	`ur_gol` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

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
	`id_detail_faktur` INT(11) NOT NULL,
	`sub_unit_pindah` INT(11) NULL,
	`status_penerimaan` ENUM('Y','N') NULL COLLATE 'latin1_swedish_ci',
	`catatan_penerimaan` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`keterangan_mutasi` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view e-inventori.v_faktur
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_faktur` (
	`id_faktur` INT(11) NOT NULL,
	`kode_faktur` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nim_mahasiswa` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nip_pegawai` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`nama_peminjam` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
	`peminjam` ENUM('pegawai','mahasiswa') NULL COLLATE 'latin1_swedish_ci',
	`catatan_faktur` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`kategori_faktur` ENUM('mutasi','out') NOT NULL COLLATE 'latin1_swedish_ci',
	`wa_peminjam` VARCHAR(20) NULL COLLATE 'latin1_swedish_ci',
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
	`kode_satker` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
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
	`id_unit` INT(11) NOT NULL,
	`id_sub_unit` INT(11) NULL,
	`detail_lokasi` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`keterangan_laporan` VARCHAR(250) NOT NULL COLLATE 'latin1_swedish_ci',
	`status_laporan` ENUM('pending','accept','process','finish') NOT NULL COLLATE 'latin1_swedish_ci',
	`dibuat_pada` DATETIME NOT NULL,
	`ditanggapi_oleh` INT(11) NULL,
	`tanggapan_laporan` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`ditanggapi_pada` DATETIME NULL,
	`diselesaikan_pada` DATETIME NULL,
	`estimasi_selesai` DATETIME NULL,
	`diperbaiki_oleh` VARCHAR(250) NULL COLLATE 'latin1_swedish_ci',
	`id_perbaiki` INT(11) NULL,
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

-- Dumping structure for view e-inventori.v_bidang
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_bidang`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_bidang` AS select `b`.`id_bid` AS `id_bid`,`b`.`kd_bid` AS `kd_bid`,`b`.`ur_bid` AS `ur_bid`,`b`.`gol` AS `gol`,`b`.`created_by` AS `created_by`,`b`.`created_time` AS `created_time`,`b`.`updated_by` AS `updated_by`,`b`.`updated_time` AS `updated_time`,`g`.`kd_gol` AS `kd_gol`,`g`.`ur_gol` AS `ur_gol` from (`e_bidang` `b` left join `e_golongan` `g` on((`b`.`gol` = `g`.`kd_gol`)));

-- Dumping structure for view e-inventori.v_detail_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_detail_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_inventori` AS select `ei`.`id_inventori` AS `id_inventori`,`ei`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit`,`ei`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`ei`.`kode_inventori` AS `kode_inventori`,`ei`.`nama_inventori` AS `nama_inventori`,`ei`.`harga_barang` AS `harga_barang`,`ei`.`kategori_inventori` AS `kategori_inventori`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`status_keluar` AS `status_keluar`,`f`.`status_pengembalian` AS `status_pengembalian`,`f`.`status_approval` AS `status_approval`,`ei`.`created_by` AS `created_by`,`ei`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`df`.`id_faktur` AS `id_faktur`,`ua`.`nama_unit` AS `nama_unit_awal`,`ua`.`kode_unit` AS `kode_unit_awal`,`df`.`unit_awal` AS `unit_awal`,`sua`.`nama_sub_unit` AS `nama_sub_unit_awal`,`sua`.`kode_sub_unit` AS `kode_sub_unit_awal`,`df`.`sub_unit_awal` AS `sub_unit_awal`,`up`.`nama_unit` AS `nama_unit_pindah`,`up`.`kode_unit` AS `kode_unit_pindah`,`df`.`unit_pindah` AS `unit_pindah`,`sup`.`nama_sub_unit` AS `nama_sub_unit_pindah`,`sup`.`kode_sub_unit` AS `kode_sub_unit_pindah`,`df`.`id_detail_faktur` AS `id_detail_faktur`,`df`.`sub_unit_pindah` AS `sub_unit_pindah`,`df`.`status_penerimaan` AS `status_penerimaan`,`df`.`catatan_penerimaan` AS `catatan_penerimaan`,`df`.`keterangan_mutasi` AS `keterangan_mutasi` from ((((((((`e_detail_faktur` `df` join `e_inventori` `ei` on((`df`.`id_inventori` = `ei`.`id_inventori`))) join `e_faktur` `f` on((`f`.`id_faktur` = `df`.`id_faktur`))) left join `e_unit` `u` on((`u`.`kode_unit` = `ei`.`kode_unit`))) left join `e_sub_unit` `su` on(((`su`.`kode_sub_unit` = `ei`.`kode_sub_unit`) and (`su`.`unit` = `u`.`id_unit`)))) left join `e_unit` `ua` on((`df`.`unit_awal` = `ua`.`id_unit`))) left join `e_sub_unit` `sua` on(((`df`.`sub_unit_awal` = `sua`.`id_sub_unit`) and (`sua`.`unit` = `ua`.`id_unit`)))) left join `e_unit` `up` on((`df`.`unit_pindah` = `up`.`id_unit`))) left join `e_sub_unit` `sup` on(((`df`.`sub_unit_pindah` = `sup`.`id_sub_unit`) and (`sup`.`unit` = `up`.`id_unit`))));

-- Dumping structure for view e-inventori.v_faktur
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_faktur`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_faktur` AS select `f`.`id_faktur` AS `id_faktur`,`f`.`kode_faktur` AS `kode_faktur`,`f`.`nim_mahasiswa` AS `nim_mahasiswa`,`f`.`nip_pegawai` AS `nip_pegawai`,`f`.`nama_peminjam` AS `nama_peminjam`,`f`.`peminjam` AS `peminjam`,`f`.`catatan_faktur` AS `catatan_faktur`,`f`.`kategori_faktur` AS `kategori_faktur`,`f`.`wa_peminjam` AS `wa_peminjam`,`f`.`status_keluar` AS `status_keluar`,`f`.`status_pengembalian` AS `status_pengembalian`,`f`.`status_approval` AS `status_approval`,`f`.`durasi` AS `durasi`,`f`.`created_by` AS `created_by`,`f`.`created_time` AS `created_time`,`f`.`updated_by` AS `updated_by`,`f`.`updated_time` AS `updated_time`,`f`.`approval_time` AS `approval_time`,`f`.`dikembalikan_oleh` AS `dikembalikan_oleh`,`f`.`tgl_pengembalian` AS `tgl_pengembalian`,`f`.`qrcode_faktur` AS `qrcode_faktur`,`f`.`barcode_faktur` AS `barcode_faktur`,`p`.`nama_lengkap` AS `pembuat_faktur`,`p2`.`nama_lengkap` AS `pengaprove_faktur`,`p3`.`nama_lengkap` AS `pengembali_faktur` from ((((`e_faktur` `f` join `e_detail_faktur` `df` on((`f`.`id_faktur` = `df`.`id_faktur`))) join `e_pengguna` `p` on((`p`.`id_pengguna` = `f`.`created_by`))) left join `e_pengguna` `p2` on((`p2`.`id_pengguna` = `f`.`approval_by`))) left join `e_pengguna` `p3` on((`p3`.`id_pengguna` = `f`.`dikembalikan_oleh`))) group by `df`.`id_faktur`;

-- Dumping structure for view e-inventori.v_inventori
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_inventori`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_inventori` AS select `i`.`id_inventori` AS `id_inventori`,`u`.`id_unit` AS `id_unit`,`i`.`kode_unit` AS `kode_unit`,`u`.`nama_unit` AS `nama_unit`,`su`.`id_sub_unit` AS `id_sub_unit`,`i`.`kode_sub_unit` AS `kode_sub_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`su`.`keterangan_sub_unit` AS `keterangan_sub_unit`,`es`.`kode_sumber_dana` AS `kode_sumber_dana`,`es`.`keterangan_sumber_dana` AS `keterangan_sumber_dana`,`i`.`foto_inventori` AS `foto_inventori`,`i`.`kode_satker` AS `kode_satker`,`i`.`kode_inventori` AS `kode_inventori`,`i`.`nama_inventori` AS `nama_inventori`,`i`.`harga_barang` AS `harga_barang`,`i`.`kategori_inventori` AS `kategori_inventori`,`i`.`qrcode` AS `qrcode`,`i`.`barcode` AS `barcode`,`i`.`created_by` AS `created_by`,`i`.`created_time` AS `created_time`,`i`.`updated_by` AS `updated_by`,`i`.`updated_time` AS `updated_time`,`i`.`status_inventori` AS `status_inventori`,`ki`.`nama_kategori` AS `nama_kategori` from ((((`e_inventori` `i` join `e_unit` `u` on((`i`.`kode_unit` = `u`.`kode_unit`))) join `e_sub_unit` `su` on(((`i`.`kode_sub_unit` = `su`.`kode_sub_unit`) and (`su`.`unit` = `u`.`id_unit`)))) join `e_kategori_inventori` `ki` on((`i`.`kategori_inventori` = `ki`.`id_kategori`))) left join `e_sumber_dana` `es` on((`i`.`kode_sumber_dana` = `es`.`kode_sumber_dana`)));

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
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_ticketing` AS select `t`.`id_ticket` AS `id_ticket`,`t`.`nama_lengkap` AS `nama_lengkap`,`t`.`foto_laporan` AS `foto_laporan`,`t`.`id_unit` AS `id_unit`,`t`.`id_sub_unit` AS `id_sub_unit`,`t`.`detail_lokasi` AS `detail_lokasi`,`t`.`keterangan_laporan` AS `keterangan_laporan`,`t`.`status_laporan` AS `status_laporan`,`t`.`dibuat_pada` AS `dibuat_pada`,`t`.`ditanggapi_oleh` AS `ditanggapi_oleh`,`t`.`tanggapan_laporan` AS `tanggapan_laporan`,`t`.`ditanggapi_pada` AS `ditanggapi_pada`,`t`.`diselesaikan_pada` AS `diselesaikan_pada`,`t`.`estimasi_selesai` AS `estimasi_selesai`,(case when (`p2`.`nama_lengkap` is not null) then `p2`.`nama_lengkap` else `t`.`diperbaiki_oleh` end) AS `diperbaiki_oleh`,`p2`.`id_pengguna` AS `id_perbaiki`,`u`.`nama_unit` AS `nama_unit`,`su`.`nama_sub_unit` AS `nama_sub_unit`,`p`.`nama_lengkap` AS `nama_penanggap` from ((((`e_ticketing` `t` left join `e_pengguna` `p` on((`t`.`ditanggapi_oleh` = `p`.`id_pengguna`))) left join `e_unit` `u` on((`t`.`id_unit` = `u`.`id_unit`))) left join `e_sub_unit` `su` on(((`t`.`id_sub_unit` = `su`.`id_sub_unit`) and (`u`.`id_unit` = `su`.`unit`)))) left join `e_pengguna` `p2` on((`p2`.`id_pengguna` = `t`.`diperbaiki_oleh`)));

-- Dumping structure for view e-inventori.v_unit
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_unit`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_unit` AS select `u`.`id_unit` AS `id_unit`,`u`.`nama_unit` AS `nama_unit`,`u`.`alamat_unit` AS `alamat_unit`,`u`.`kode_unit` AS `kode_unit`,`u`.`created_time` AS `created_time`,`u`.`created_by` AS `created_by`,`u`.`updated_by` AS `updated_by`,`u`.`updated_time` AS `updated_time`,count(`i`.`id_inventori`) AS `jmlInventori` from (`e_unit` `u` left join `e_inventori` `i` on((`u`.`kode_unit` = `i`.`kode_unit`))) group by `u`.`kode_unit`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
