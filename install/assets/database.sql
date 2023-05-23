#
# TABLE STRUCTURE FOR: akun
#

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `no_reff` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_reff` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `keterangan` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `aktiva` int(1) NOT NULL DEFAULT '0',
  `pasiva` int(1) NOT NULL DEFAULT '0',
  `kewajiban` int(1) NOT NULL DEFAULT '0',
  `urutan` int(4) NOT NULL DEFAULT '0',
  `kunci` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no_reff`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (102, 1, 'Persediaan', 'Persediaan Barang', 2, 0, 0, 4, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (110, 1, 'Bank', 'Kas di Bank', 1, 0, 0, 2, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (111, 1, 'Kas', 'Kas', 1, 0, 0, 1, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (112, 1, 'Piutang', 'Piutang Usaha', 1, 0, 0, 3, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (113, 1, 'Perlengkapan', 'Perlengkapan Perusahaan', 0, 1, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (121, 1, 'Peralatan', 'Peralatan Perusahaan', 0, 1, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (122, 1, 'Akumulasi Peralatan', 'Akumulasi Penyusutan Peralatan', 0, 1, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (211, 1, 'Utang Usaha', 'Utang Usaha', 0, 0, 1, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (212, 1, 'Utang Gaji', 'Utang Gaji', 0, 0, 1, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (213, 1, 'Utang pajak', 'Utang pajak', 2, 0, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (311, 1, 'Modal', 'Modal', 4, 0, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (312, 1, 'Prive', 'Prive', 2, 2, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (400, 1, 'Pendapatan', 'Pendapatan', 0, 0, 0, 0, 1);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (401, 1, 'Retur Penjualan', 'Retur Penjualan', 2, 1, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (402, 1, 'Potongan Penjualan', 'Potongan Penjualan', 2, 1, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (411, 1, 'Pendapatan jasa/usaha\r\n			', 'Pendapatan jasa/usaha\r\n			', 0, 0, 0, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (412, 1, 'Pendapatan lain-lain', 'Pendapatan lain-lain', 0, 0, 0, 0, 1);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (511, 1, 'Beban Gaji', 'Beban Gaji', 2, 2, 1, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (512, 1, 'Beban Sewa', 'Beban Sewa', 2, 2, 1, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (513, 1, 'Beban Penyusutan Peralatan', 'Beban Penyusutan Peralatan', 2, 0, 1, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (514, 1, 'Beban Lat', 'Beban air, listrik, dan telepon', 2, 0, 1, 0, 0);
INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `aktiva`, `pasiva`, `kewajiban`, `urutan`, `kunci`) VALUES (515, 1, 'Beban Perlengkapan', 'Beban Perlengkapan', 2, 0, 1, 0, 0);


#
# TABLE STRUCTURE FOR: bahan
#

DROP TABLE IF EXISTS `bahan`;

CREATE TABLE `bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `harga_modal` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  `harga` int(11) NOT NULL DEFAULT '0',
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `status_stok` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `kunci` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `pub` int(11) NOT NULL DEFAULT '0',
  `type_harga` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (1, 1, 'NONE', 0, 0, 0, 0, 'N', 1, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (2, 3, 'VINYL RITRAMA', 14500, 0, 0, 5, 'N', 0, 1, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (3, 3, 'FLEXI CHINA 280Gr', 8000, 0, 0, 5, 'N', 0, 1, 1, 5);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (4, 3, 'FLEXI KOREA 440Gr', 10000, 0, 0, 5, 'N', 0, 1, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (5, 2, 'BACKLITE JERMAN 550Gr', 21000, 0, 0, 5, 'N', 0, 1, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (6, 3, 'VINYL CINA ', 12000, 50000, 60000, 5, 'N', 0, 1, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (7, 4, 'PVC', 3000, 0, 0, 1, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (8, 9, 'Desain', 15000, 15000, 20000, 1, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (9, 2, 'Roll Up Baner 60x160', 200000, 0, 0, 1, 'N', 0, 1, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (10, 2, 'X-Banner', 50000, 0, 0, 1, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (11, 4, 'ART PAPER 150', 4000, 0, 0, 4, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (12, 4, 'ART CARTON 260', 5000, 0, 0, 4, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (13, 5, 'HVS 80 Offset', 360000, 500000, 650000, 6, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (14, 4, 'PIN 5.5 CM', 1000, 0, 0, 1, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (15, 4, 'PIN 4.4 CM', 1000, 0, 0, 1, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (16, 4, 'HVS 70', 300, 0, 0, 4, 'N', 0, 0, 1, 1);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (18, 10, 'Sampoerna MIld 12 Batang', 22000, 0, 0, 8, 'N', 0, 0, 1, 2);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (19, 10, 'Sampoerna Mild 16 Batang', 30000, 0, 0, 8, 'N', 0, 0, 1, 2);
INSERT INTO `bahan` (`id`, `id_jenis`, `title`, `harga_modal`, `harga_jual`, `harga`, `id_satuan`, `status_stok`, `kunci`, `status`, `pub`, `type_harga`) VALUES (20, 10, 'Surya 16', 25000, 0, 0, 8, 'N', 0, 0, 1, 2);


#
# TABLE STRUCTURE FOR: bayar_invoice_detail
#

DROP TABLE IF EXISTS `bayar_invoice_detail`;

CREATE TABLE `bayar_invoice_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jam_bayar` time DEFAULT NULL,
  `jml_bayar` int(11) DEFAULT NULL,
  `jdiskon` int(11) NOT NULL DEFAULT '0',
  `kunci` int(11) NOT NULL DEFAULT '0',
  `id_bayar` int(11) DEFAULT NULL,
  `id_sub_bayar` int(11) NOT NULL DEFAULT '0',
  `lampiran` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `rekap` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `setor` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tgl_setor` datetime DEFAULT NULL,
  `hapus` int(11) NOT NULL DEFAULT '0',
  `urutan` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: bayar_pembelian
#

DROP TABLE IF EXISTS `bayar_pembelian`;

CREATE TABLE `bayar_pembelian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pembelian` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jml_bayar` int(11) DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `id_sub_bayar` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `setor` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tgl_setor` datetime DEFAULT NULL,
  `jurnal` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  `lampiran` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: bayar_pengeluaran
#

DROP TABLE IF EXISTS `bayar_pengeluaran`;

CREATE TABLE `bayar_pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jml_bayar` int(11) DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `id_sub_bayar` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `setor` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tgl_setor` datetime DEFAULT NULL,
  `jurnal` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  `lampiran` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: bayar_piutang
#

DROP TABLE IF EXISTS `bayar_piutang`;

CREATE TABLE `bayar_piutang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `jml_bayar` int(11) DEFAULT NULL,
  `id_bayar` int(11) DEFAULT NULL,
  `id_sub_bayar` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `setor` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `tgl_setor` datetime DEFAULT NULL,
  `jenis` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jurnal` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  `lampiran` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: device
#

DROP TABLE IF EXISTS `device`;

CREATE TABLE `device` (
  `token` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `device` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `device_status` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `expired` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `messages` int(11) NOT NULL,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `package` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `quota` int(11) NOT NULL,
  PRIMARY KEY (`token`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `device` (`token`, `device`, `device_status`, `expired`, `messages`, `name`, `package`, `quota`) VALUES ('R2BjvYUUQgs64@W2oR@t', '0895326083254', 'connect', '7 June 2023', 42, 'invoice_send', 'Free', 958);


#
# TABLE STRUCTURE FOR: hak_akses
#

DROP TABLE IF EXISTS `hak_akses`;

CREATE TABLE `hak_akses` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id_level`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES (1, 0, 'Administrator', 'admin', 'Y', 0);
INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES (2, 0, 'Owner', 'owner', 'Y', 0);
INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES (3, 0, 'Kasir', 'kasir', 'Y', 0);
INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES (4, 0, 'Keuangan', 'keu', 'Y', 0);
INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES (5, 0, 'Desain', 'desain', 'Y', 1);
INSERT INTO `hak_akses` (`id_level`, `id_parent`, `nama`, `level`, `publish`, `status`) VALUES (6, 0, 'Operator', 'operator', 'Y', 0);


#
# TABLE STRUCTURE FOR: harga
#

DROP TABLE IF EXISTS `harga`;

CREATE TABLE `harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: harga_member
#

DROP TABLE IF EXISTS `harga_member`;

CREATE TABLE `harga_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `id_bahan` int(11) NOT NULL DEFAULT '0',
  `id_member` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `harga_member` (`id`, `id_satuan`, `id_bahan`, `id_member`, `harga_jual`) VALUES (1, 2, 2, 1, 20000);
INSERT INTO `harga_member` (`id`, `id_satuan`, `id_bahan`, `id_member`, `harga_jual`) VALUES (2, 2, 2, 2, 19500);
INSERT INTO `harga_member` (`id`, `id_satuan`, `id_bahan`, `id_member`, `harga_jual`) VALUES (3, 2, 2, 3, 18000);


#
# TABLE STRUCTURE FOR: harga_range_member
#

DROP TABLE IF EXISTS `harga_range_member`;

CREATE TABLE `harga_range_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) NOT NULL DEFAULT '0',
  `id_bahan` int(11) NOT NULL DEFAULT '0',
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `jumlah_minimal` int(11) NOT NULL DEFAULT '0',
  `jumlah_maksimal` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diskon` int(2) NOT NULL DEFAULT '0',
  `pub` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (1, 1, 3, 5, 1, 20, 25000, '2023-05-06 14:52:23', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (2, 1, 3, 5, 21, 50, 24500, '2023-05-06 14:52:38', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (3, 1, 3, 5, 51, 100, 24000, '2023-05-06 14:52:58', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (4, 1, 3, 5, 101, 1000, 23500, '2023-05-06 14:53:12', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (5, 3, 3, 5, 1, 20, 24800, '2023-05-06 14:53:36', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (6, 3, 3, 5, 21, 50, 24300, '2023-05-06 14:53:51', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (7, 3, 3, 5, 51, 100, 23800, '2023-05-06 14:54:13', 0, 0);
INSERT INTO `harga_range_member` (`id`, `id_member`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (8, 3, 3, 5, 101, 1000, 23200, '2023-05-06 14:54:32', 0, 0);


#
# TABLE STRUCTURE FOR: harga_satuan
#

DROP TABLE IF EXISTS `harga_satuan`;

CREATE TABLE `harga_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `id_bahan` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `harga_satuan` (`id`, `id_satuan`, `id_bahan`, `harga_jual`) VALUES (2, 8, 18, 30000);
INSERT INTO `harga_satuan` (`id`, `id_satuan`, `id_bahan`, `harga_jual`) VALUES (3, 8, 19, 30000);
INSERT INTO `harga_satuan` (`id`, `id_satuan`, `id_bahan`, `harga_jual`) VALUES (4, 8, 20, 25000);
INSERT INTO `harga_satuan` (`id`, `id_satuan`, `id_bahan`, `harga_jual`) VALUES (5, 9, 18, 350000);
INSERT INTO `harga_satuan` (`id`, `id_satuan`, `id_bahan`, `harga_jual`) VALUES (1, 2, 2, 20000);


#
# TABLE STRUCTURE FOR: history_stok
#

DROP TABLE IF EXISTS `history_stok`;

CREATE TABLE `history_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan` int(11) NOT NULL,
  `tb` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `create_date` date DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: info
#

DROP TABLE IF EXISTS `info`;

CREATE TABLE `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `perusahaan` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `keywords` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `phone` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `fb` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tw` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ig` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `logo` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `logo_bw` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `favicon` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `stamp_l` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `stamp_b` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `warna_lunas` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `warna_blunas` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tema` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ket` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `footer_invoice` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `demo` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `api_key` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `version` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `user_name` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `user_pass` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `info` (`id`, `title`, `perusahaan`, `deskripsi`, `keywords`, `email`, `phone`, `fb`, `tw`, `ig`, `logo`, `logo_bw`, `favicon`, `stamp_l`, `stamp_b`, `warna_lunas`, `warna_blunas`, `tema`, `ket`, `footer_invoice`, `demo`, `api_key`, `version`, `user_name`, `user_pass`) VALUES (1, 'Aplikasi Kasir Percetakan & Retail', 'BONE KASIR', 'PHA+SmwuIEtIIEFiZHVsIEZhdGFoIEhhc2FuPGJyPjwvcD4=', 'Serang', 'pospercetakan@gmail.com', '089611274798', '-', 'R2BjvYUUQgs64@W2oR@t', '-', 'bon_app.png', 'logo_bw.png', 'bone.png', 'STAM_LUNAS.png', 'belum_lunas.png', '#1ABC9C', '#444444', '#8E44AD', 'PHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiPkFwbGlrYXNpIEthc2lyIFBlcmNldGFrYW4gJmFtcDsgUmV0YWlsPGJyPkRlZmF1bHQgTG9naW4gQWRtaW48YnI+ZW1haWwgOiBhZG1pbkBteS5pZDxicj5wYXNzIDogMTIzNDU8YnI+PC9wPg==', 'PHA+TWVudW5kYSBudW5kYSBwZW1iYXlhcmFuIGh1dGFuZyBvbGVoIG9yYW5nIG1hbXB1PGJyPm1lcnVwYWthbiBzdWF0dSBrZWR6YWxpbWFuIHwgSC5ULiBBYnUgRGF1ZCB8PC9wPg==', 'N', '12345z', '1.3.5', 'xposappx', '');


#
# TABLE STRUCTURE FOR: invoice
#

DROP TABLE IF EXISTS `invoice`;

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(11) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `total_bayar` int(11) NOT NULL DEFAULT '0',
  `potongan_harga` int(11) NOT NULL DEFAULT '0',
  `pajak` float NOT NULL DEFAULT '0',
  `pos` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `lunas` int(11) NOT NULL DEFAULT '0',
  `tgl_trx` date DEFAULT NULL,
  `jam_order` time NOT NULL,
  `tgl_ambil` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_marketing` int(11) DEFAULT NULL,
  `id_desain` int(11) NOT NULL DEFAULT '0',
  `tgl_update` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('baru','simpan','edit','pending','batal') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'baru',
  `oto` int(11) NOT NULL DEFAULT '0',
  `history` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `data_json` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `id_konsumen` int(11) DEFAULT NULL,
  `cetak` int(11) NOT NULL DEFAULT '0',
  `sesi_cart` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: invoice_detail
#

DROP TABLE IF EXISTS `invoice_detail`;

CREATE TABLE `invoice_detail` (
  `id_rincianinvoice` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) DEFAULT NULL,
  `id_produk` int(11) NOT NULL DEFAULT '0',
  `jenis_cetakan` int(11) DEFAULT '0',
  `status_hitung` int(11) NOT NULL DEFAULT '0',
  `type_harga` int(11) NOT NULL DEFAULT '0',
  `id_mesin` int(11) NOT NULL DEFAULT '1',
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `detail` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `jumlah` int(11) DEFAULT '0',
  `harga` int(11) DEFAULT '0',
  `diskon` int(11) NOT NULL DEFAULT '0',
  `satuan` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `ukuran` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tot_ukuran` float DEFAULT '0',
  `hpp` int(11) NOT NULL DEFAULT '0',
  `uk_real` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '0',
  `id_bahan` int(11) DEFAULT '0',
  `catatan` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `ambil` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  `rak` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `id_operator` int(11) DEFAULT '0',
  `id_pengirim` int(11) DEFAULT '0',
  `id_gudang` int(11) DEFAULT '0',
  `jumlah_kirim` int(11) DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `kunci` int(11) NOT NULL DEFAULT '0',
  `token` varchar(6) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rincianinvoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: jenis_akun
#

DROP TABLE IF EXISTS `jenis_akun`;

CREATE TABLE `jenis_akun` (
  `id_jenis_akun` int(11) NOT NULL,
  `nama_jenis_akun` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jenis_akun`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: jenis_bayar
#

DROP TABLE IF EXISTS `jenis_bayar`;

CREATE TABLE `jenis_bayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_akun` int(11) NOT NULL DEFAULT '0',
  `nama_bayar` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `publish` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `kunci` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `jenis_bayar` (`id`, `id_akun`, `nama_bayar`, `publish`, `kunci`) VALUES (1, 111, 'Tunai', 'Y', 0);
INSERT INTO `jenis_bayar` (`id`, `id_akun`, `nama_bayar`, `publish`, `kunci`) VALUES (2, 110, 'Transfer', 'Y', 0);
INSERT INTO `jenis_bayar` (`id`, `id_akun`, `nama_bayar`, `publish`, `kunci`) VALUES (3, 211, 'Tempo', 'Y', 1);


#
# TABLE STRUCTURE FOR: jenis_cetakan
#

DROP TABLE IF EXISTS `jenis_cetakan`;

CREATE TABLE `jenis_cetakan` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_cetakan` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `kunci` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `id_akun` int(11) NOT NULL DEFAULT '0',
  `pub` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (1, '-', 1, 0, 0, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (2, 'Indoor', 0, 1, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (3, 'Outdoor', 0, 1, 400, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (4, 'Digital', 0, 0, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (5, 'Offset', 0, 0, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (6, 'Konveksi', 0, 0, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (7, 'Sablon', 0, 0, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (8, 'Merchandise', 0, 0, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (9, 'Desain', 0, 0, 411, 'Y');
INSERT INTO `jenis_cetakan` (`id_jenis`, `jenis_cetakan`, `kunci`, `status`, `id_akun`, `pub`) VALUES (10, 'Rokok', 0, 0, 400, 'Y');


#
# TABLE STRUCTURE FOR: jenis_kas
#

DROP TABLE IF EXISTS `jenis_kas`;

CREATE TABLE `jenis_kas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `kunci` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `aktiva` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `jenis_kas` (`id`, `title`, `id_akun`, `kunci`, `status`, `aktiva`) VALUES (1, 'Kas Kecil', 111, 0, 0, 'N');
INSERT INTO `jenis_kas` (`id`, `title`, `id_akun`, `kunci`, `status`, `aktiva`) VALUES (2, 'Kas Penjualan', 411, 0, 0, 'N');
INSERT INTO `jenis_kas` (`id`, `title`, `id_akun`, `kunci`, `status`, `aktiva`) VALUES (3, 'Kas Bank Umum', 110, 0, 0, 'N');
INSERT INTO `jenis_kas` (`id`, `title`, `id_akun`, `kunci`, `status`, `aktiva`) VALUES (4, 'Hutang Usaha', 211, 1, 0, 'N');
INSERT INTO `jenis_kas` (`id`, `title`, `id_akun`, `kunci`, `status`, `aktiva`) VALUES (5, 'Piutang Usaha', 112, 1, 0, 'N');


#
# TABLE STRUCTURE FOR: jenis_lembaga
#

DROP TABLE IF EXISTS `jenis_lembaga`;

CREATE TABLE `jenis_lembaga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pub` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (1, 'Personal', 0);
INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (2, 'Perusahaan Swasta', 0);
INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (3, 'Perusahaan BUMN', 0);
INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (4, 'Lembaga Pendidikan', 0);
INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (5, 'Hotel', 0);
INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (6, 'Instansi Pemerintahan', 0);
INSERT INTO `jenis_lembaga` (`id`, `title`, `pub`) VALUES (7, 'Lainya', 0);


#
# TABLE STRUCTURE FOR: jenis_pengeluaran
#

DROP TABLE IF EXISTS `jenis_pengeluaran`;

CREATE TABLE `jenis_pengeluaran` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `kunci` int(11) NOT NULL DEFAULT '0',
  `id_akun` int(11) NOT NULL DEFAULT '0',
  `pub` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jenis`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (1, '-', 1, 0, 'Y', 0);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (2, 'Persediaan Bahan Pin', 0, 102, 'Y', 0);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (3, 'Prive Owner', 0, 312, 'Y', 1);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (4, 'Jasa Pengiriman', 0, 514, 'Y', 0);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (5, 'Persediaan Bahan Flexi', 0, 102, 'Y', 0);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (6, 'Persediaan Bahan Digital', 0, 102, 'Y', 0);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (7, 'Persediaan Bahan Merchandise', 0, 102, 'Y', 0);
INSERT INTO `jenis_pengeluaran` (`id_jenis`, `title`, `kunci`, `id_akun`, `pub`, `status`) VALUES (8, 'Token Listrik', 0, 514, 'Y', 0);


#
# TABLE STRUCTURE FOR: jurnal_transaksi
#

DROP TABLE IF EXISTS `jurnal_transaksi`;

CREATE TABLE `jurnal_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `no_reff` int(11) NOT NULL,
  `reff` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jenis_saldo` enum('debit','kredit') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `saldo` int(11) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: kas_masuk
#

DROP TABLE IF EXISTS `kas_masuk`;

CREATE TABLE `kas_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_generate` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_jenis` int(11) DEFAULT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_bayar` int(11) NOT NULL DEFAULT '0',
  `id_sub_bayar` int(11) NOT NULL DEFAULT '0',
  `no_reff` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `catatan` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pemasukan` int(11) NOT NULL DEFAULT '0',
  `pengeluaran` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: kasbon
#

DROP TABLE IF EXISTS `kasbon`;

CREATE TABLE `kasbon` (
  `id_kasbon` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_kasbon` date DEFAULT NULL,
  `jenis_kasbon` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `pinjam` int(11) NOT NULL DEFAULT '0',
  `bayar` int(11) NOT NULL DEFAULT '0',
  `catatan` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `status_bayar` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kasbon`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: konsumen
#

DROP TABLE IF EXISTS `konsumen`;

CREATE TABLE `konsumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `kode_unik` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `panggilan` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jenis` int(11) NOT NULL DEFAULT '1',
  `jenis_member` int(2) NOT NULL DEFAULT '1',
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `no_hp` varchar(17) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `last_update` datetime DEFAULT CURRENT_TIMESTAMP,
  `referal` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `perusahaan` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `alamat_lembaga` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(17) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tampil` int(1) NOT NULL DEFAULT '0',
  `kunci` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `hapus` int(11) NOT NULL DEFAULT '0',
  `history` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `max_utang` int(11) DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `konsumen` (`id`, `id_member`, `kode_unik`, `panggilan`, `jenis`, `jenis_member`, `nama`, `no_hp`, `tgl_daftar`, `last_update`, `referal`, `alamat`, `perusahaan`, `alamat_lembaga`, `no_telp`, `email`, `tampil`, `kunci`, `status`, `hapus`, `history`, `max_utang`) VALUES (1, 'P000001', 'Axzerf', NULL, 1, 1, 'Default', '-', '2020-12-07', '2023-05-04 18:26:02', '-', '-', '-', '', '', '', 0, 1, 0, 0, NULL, 0);
INSERT INTO `konsumen` (`id`, `id_member`, `kode_unik`, `panggilan`, `jenis`, `jenis_member`, `nama`, `no_hp`, `tgl_daftar`, `last_update`, `referal`, `alamat`, `perusahaan`, `alamat_lembaga`, `no_telp`, `email`, `tampil`, `kunci`, `status`, `hapus`, `history`, `max_utang`) VALUES (2, 'P000002', 'KCEME', 'Mas', 1, 1, 'Ibnu', '089611274798', '2021-02-02', '2023-05-04 18:26:02', 'wa', 'serang', 'Personal', '', '', '', 0, 0, 0, 0, '{\"nama\":\"Ibnu\",\"panggilan\":\"Mas\",\"no_hp\":\"089611274798\",\"jenis\":\"1\",\"jenis_member\":\"1\",\"alamat\":\"serang\",\"perusahaan\":\"Personal\",\"alamat_lembaga\":\"\",\"no_telp\":\"\",\"referal\":\"wa\",\"tampil\":\"0\",\"status\":\"0\",\"max_utang\":\"0\",\"tgl_edit\":\"2023-05-07 14:52:16\"},{\"nama\":\"Ibnu\",\"panggilan\":\"Mas\",\"no_hp\":\"\",\"jenis\":\"1\",\"jenis_member\":\"1\",\"alamat\":\"serang\",\"perusahaan\":\"Personal\",\"alamat_lembaga\":\"\",\"no_telp\":\"\",\"referal\":\"wa\",\"tampil\":\"0\",\"status\":\"0\",\"max_utang\":\"0\",\"tgl_edit\":\"2023-05-07 14:52:23\"},{\"nama\":\"Ibnu\",\"panggilan\":\"Mas\",\"no_hp\":\"081311110498\",\"jenis\":\"1\",\"jenis_member\":\"1\",\"alamat\":\"serang\",\"perusahaan\":\"Personal\",\"alamat_lembaga\":\"\",\"no_telp\":\"\",\"referal\":\"wa\",\"tampil\":\"0\",\"status\":\"0\",\"max_utang\":\"0\",\"tgl_edit\":\"2023-05-07 14:54:49\"},{\"nama\":\"Ibnu\",\"panggilan\":\"Mas\",\"no_hp\":\"089611274798\",\"jenis\":\"1\",\"jenis_member\":\"1\",\"alamat\":\"serang\",\"perusahaan\":\"Personal\",\"alamat_lembaga\":\"\",\"no_telp\":\"\",\"referal\":\"wa\",\"tampil\":\"0\",\"status\":\"0\",\"max_utang\":\"0\",\"tgl_edit\":\"2023-05-07 14:56:20\"},{\"nama\":\"Ibnu\",\"panggilan\":\"Mas\",\"no_hp\":\"089611274798\",\"jenis\":\"1\",\"jenis_member\":\"1\",\"alamat\":\"serang\",\"perusahaan\":\"Personal\",\"alamat_lembaga\":\"\",\"no_telp\":\"\",\"referal\":\"wa\",\"tampil\":\"0\",\"status\":\"0\",\"max_utang\":\"0\",\"tgl_edit\":\"2023-05-07 15:09:06\"}', 0);


#
# TABLE STRUCTURE FOR: laporan_penerimaan
#

DROP TABLE IF EXISTS `laporan_penerimaan`;

CREATE TABLE `laporan_penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_penerima` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_verifikasi` date DEFAULT NULL,
  `tanggal_setor` date DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: laporan_stok
#

DROP TABLE IF EXISTS `laporan_stok`;

CREATE TABLE `laporan_stok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: member
#

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nominal_belanja` int(11) NOT NULL DEFAULT '0',
  `nominal_upgrade` int(11) NOT NULL DEFAULT '0',
  `potongan_diskon` int(2) NOT NULL DEFAULT '0',
  `potongan_harga` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `member` (`id`, `title`, `nominal_belanja`, `nominal_upgrade`, `potongan_diskon`, `potongan_harga`, `status`) VALUES (1, 'Member Regular', 0, 0, 5, 0, 1);
INSERT INTO `member` (`id`, `title`, `nominal_belanja`, `nominal_upgrade`, `potongan_diskon`, `potongan_harga`, `status`) VALUES (2, 'Member Gold', 0, 0, 10, 0, 1);
INSERT INTO `member` (`id`, `title`, `nominal_belanja`, `nominal_upgrade`, `potongan_diskon`, `potongan_harga`, `status`) VALUES (3, 'Member Silver', 0, 0, 15, 0, 1);
INSERT INTO `member` (`id`, `title`, `nominal_belanja`, `nominal_upgrade`, `potongan_diskon`, `potongan_harga`, `status`) VALUES (4, 'Member Platinum', 0, 0, 5, 0, 1);


#
# TABLE STRUCTURE FOR: menuadmin
#

DROP TABLE IF EXISTS `menuadmin`;

CREATE TABLE `menuadmin` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `idparent` int(11) NOT NULL DEFAULT '0',
  `id_level` tinytext CHARACTER SET latin1 COLLATE latin1_general_ci,
  `nama_menu` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `link` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `target` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '_self',
  `link_on` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `treeview` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'treeview',
  `classes` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `classicon` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `icon` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `level` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `urutan` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmenu`)
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (154, 116, '1,2', 'Satuan', 'produk/satuan', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 5);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (148, 116, '1,2', 'Kategori', 'produk/jenis', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 4);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (24, 112, '1', 'Menu Admin', 'main/menuadmin', '_self', 'N', '', '', 'N', '', 'Y', 'admin', 48);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (33, 112, '1,2', 'Pengguna', 'user', '_self', 'Y', 'treeview', 'menu5', 'N', '', 'Y', 'admin', 42);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (109, 116, '1,2', 'Produk', 'produk/data', '_self', 'N', '', 'menu5', 'N', 'file-text', 'Y', '', 6);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (112, 0, '1,2', 'Pengaturan', '#pengaturan', '_self', 'Y', 'treeview', 'icon-settings', 'Y', 'fa-cog', 'Y', '', 41);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (116, 0, '1,2,4', 'Produk', '#master', '_self', 'Y', 'treeview', 'icon-newspaper-o', 'Y', 'fa-file', 'Y', '', 3);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (199, 0, '1,2', 'Pembukuan', '#', '_self', 'Y', 'treeview', NULL, 'Y', 'fa-address-book', 'Y', NULL, 15);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (139, 112, '1,2', 'Aplikasi', 'main/info', '_self', 'N', '', '', 'Y', '', 'Y', NULL, 45);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (141, 0, '1,2,3,4,5,6', 'Profile', 'user/profil', '_self', 'N', '', 'icon-user', 'Y', 'fa-user', 'Y', NULL, 39);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (153, 196, '1,2,3', 'Harga Produk', 'produk/bahan', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 9);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (147, 0, '1,3', 'Data Transaksi', 'penjualan/order', '_self', 'N', '', 'icon-chart', 'Y', 'fa-cart-plus', 'Y', NULL, 1);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (155, 0, '1,2,3,4,5,6', 'Laporan', 'pembukuan', '_self', 'Y', 'treeview', NULL, 'Y', 'fa-book', 'Y', NULL, 24);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (156, 155, '1,2,3,4', 'Rincian Penjualan', 'pembukuan/omset', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 27);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (157, 155, '1,2,3,4', 'Pengeluaran', 'pengeluaran/data', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 33);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (180, 155, '1,2,3,4', 'Omset Penjualan', 'laporan/penjualan', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 25);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (159, 155, '1,2,3,4', 'Rincian Pendapatan', 'pembukuan/uang_masuk', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 26);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (160, 155, '1,2,3,4', 'Piutang Penjualan', 'pembukuan/piutang', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 28);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (162, 0, '1,2,3,4,5,6', 'Grafik', 'grafik', '_self', 'N', '', NULL, 'Y', 'fa-bar-chart', 'Y', NULL, 35);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (185, 112, '1,2', 'Folder', 'main/folder', '_self', 'N', '', NULL, 'Y', 'fa-folder-open', 'Y', NULL, 47);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (165, 0, '1', 'Backup Database', 'backupdata/database', '_self', 'N', '', NULL, 'Y', 'fa-database', 'Y', NULL, 58);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (166, 0, '1,2,3,4', 'Pelanggan', '#', '_self', 'Y', 'treeview', NULL, 'Y', 'fa-user-circle-o', 'Y', NULL, 36);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (167, 0, '1,2,3,4,6', 'Dokumentasi', 'dokumentasi/page', '_blank', 'N', '', NULL, 'Y', 'fa-file-text', 'Y', NULL, 60);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (168, 0, '1', 'Cek Update', 'updateversi', '_self', 'N', 'a', NULL, 'Y', 'fa-cloud-download', 'Y', NULL, 57);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (170, 112, '1,2,4', 'Jenis Pembayaran', 'pembayaran/jenis', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 43);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (171, 0, '1,2,3,4', 'Keuangan', '#', '_self', 'N', 'treeview', NULL, 'Y', 'fa-credit-card', 'Y', NULL, 21);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (174, 171, '1,2,3,4', 'Kas', 'kas/data', '_self', 'N', '', NULL, 'Y', 'fa-file-pdf-o', 'Y', NULL, 22);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (175, 112, '1,2,3,4', 'Printer', 'main/printer', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 46);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (176, 0, '1', 'History User', 'history', '_self', 'N', '', NULL, 'Y', 'fa-history', 'Y', NULL, 59);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (177, 112, '1,2', 'Rekening Bank', 'pembayaran/rekening', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 44);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (178, 171, '1,2,4', 'Mutasi Kas', 'kas/mutasi', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 23);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (179, 116, '1,2,3,4', 'Supplier', 'supplier/data', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 7);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (181, 199, '1,2,4', 'Jenis Transaksi Akun', 'kas/pengeluaran', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 20);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (182, 199, '1,2,3,4', 'Laba Rugi', 'pembukuan/laba-rugi', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 18);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (183, 0, '1,2', 'Master Data', '#', '_self', 'N', 'header', NULL, 'Y', '', 'Y', NULL, 2);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (184, 0, '1', 'backup & update', '#', '_self', 'N', 'header', NULL, 'Y', '', 'Y', NULL, 56);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (186, 155, '1,2,3,4', 'Log Transaksi', 'aktifitas/transaksi', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 34);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (187, 0, '1,2,3,4,5,6', 'Akun Demo', 'home/account', '_self', 'N', 'a', NULL, 'Y', 'fa-user-circle-o', 'N', NULL, 50);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (188, 0, '1,2,3,4,5,6', 'Dashboard', 'home', '_self', 'N', '', NULL, 'Y', 'fa-dashboard', 'Y', NULL, 0);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (189, 112, '1', 'Reset & Input Sample', 'rollback/resetdata', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 49);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (190, 155, '1,2,3,4,5', 'Desain', 'laporan/desain', '_self', 'N', '', NULL, 'Y', 'fa-desktop', 'Y', NULL, 30);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (191, 155, '1,2,4', 'PPN', 'laporan/ppn', '_self', 'N', '', NULL, 'Y', '', 'N', NULL, 31);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (193, 155, '1,5,6', 'List Pekerjaan', 'laporan/operator', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 29);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (194, 196, '1,2', 'Data Stok', 'stok/data', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 10);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (195, 196, '1,2', 'History stok', 'stok/history', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 13);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (198, 199, '1,2', 'Neraca', 'pembukuan/neraca', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 17);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (196, 0, '1,2', 'Stok Barang', '#', '_self', 'Y', 'treeview', NULL, 'Y', 'fa-book', 'Y', NULL, 8);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (197, 196, '1,2', 'Stok Keluar', 'stok/keluar', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 12);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (200, 155, '1,2', 'Pembelian', 'pembelian/data', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 32);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (201, 196, '1,2', 'Stok Masuk', 'stok/masuk', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 11);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (202, 199, '1,2', 'Neraca Saldo', 'pembukuan/neraca_saldo', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 19);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (203, 199, '1,2', 'Jurnal Umum', 'jurnal', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 16);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (204, 196, '1,2', 'Harga Range', 'produk/harga_range', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 14);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (205, 166, '1,2,4', 'Jenis Member', 'konsumen/member', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 38);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (206, 166, '1,2,3,4', 'Data pelanggan', 'konsumen', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 37);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (207, 0, '1', 'Whatsapp', '#', '_self', 'N', 'treeview', NULL, 'Y', 'fa-whatsapp', 'Y', NULL, 51);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (208, 207, '1', 'Device', 'whatsapp', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 52);
INSERT INTO `menuadmin` (`idmenu`, `idparent`, `id_level`, `nama_menu`, `link`, `target`, `link_on`, `treeview`, `classes`, `classicon`, `icon`, `aktif`, `level`, `urutan`) VALUES (209, 207, '1', 'Template Pesan', 'whatsapp/template', '_self', 'N', '', NULL, 'Y', '', 'Y', NULL, 53);


#
# TABLE STRUCTURE FOR: mesin
#

DROP TABLE IF EXISTS `mesin`;

CREATE TABLE `mesin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_mesin` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pemilik` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `publish` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: migrations
#

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `migrations` (`version`) VALUES ('1');
INSERT INTO `migrations` (`version`) VALUES ('1');
INSERT INTO `migrations` (`version`) VALUES ('1');


#
# TABLE STRUCTURE FOR: pembelian
#

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL AUTO_INCREMENT,
  `id_bayar` int(11) NOT NULL DEFAULT '0',
  `id_kas` int(11) NOT NULL DEFAULT '0',
  `tgl_pembelian` date DEFAULT NULL,
  `tgl_rekap` date DEFAULT NULL,
  `tgl_jatuhtempo` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `pos` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `rekap` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `stok` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `lunas` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  PRIMARY KEY (`id_pembelian`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: pembelian_detail
#

DROP TABLE IF EXISTS `pembelian_detail`;

CREATE TABLE `pembelian_detail` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` int(11) NOT NULL DEFAULT '0',
  `id_pembelian` int(11) DEFAULT NULL,
  `id_biaya` int(11) DEFAULT '0',
  `id_supplier` int(11) DEFAULT '1',
  `no_invo` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jumlah` float DEFAULT '0',
  `harga` int(11) DEFAULT '0',
  `satuan` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_pemesan` int(11) DEFAULT '0',
  `no_order` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: pengaturan_kertas
#

DROP TABLE IF EXISTS `pengaturan_kertas`;

CREATE TABLE `pengaturan_kertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `modul` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ukuran` enum('A3','A4','A5','A6') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'A4',
  `posisi` enum('potrait','landscape') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'potrait',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: pengeluaran
#

DROP TABLE IF EXISTS `pengeluaran`;

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `id_bayar` int(11) NOT NULL DEFAULT '0',
  `id_kas` int(11) NOT NULL DEFAULT '0',
  `tgl_pengeluaran` date DEFAULT NULL,
  `tgl_rekap` date DEFAULT NULL,
  `tgl_jatuhtempo` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `pos` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `rekap` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `lunas` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'N',
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: pengeluaran_detail
#

DROP TABLE IF EXISTS `pengeluaran_detail`;

CREATE TABLE `pengeluaran_detail` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengeluaran` int(11) DEFAULT NULL,
  `id_biaya` int(11) DEFAULT '0',
  `id_supplier` int(11) DEFAULT '1',
  `no_invo` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jumlah` float DEFAULT '0',
  `harga` int(11) DEFAULT '0',
  `satuan` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `id_pemesan` int(11) DEFAULT '0',
  `no_order` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: printer
#

DROP TABLE IF EXISTS `printer`;

CREATE TABLE `printer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ukuran_kertas` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ukuran_font` decimal(10,0) NOT NULL,
  `posisi` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `max_item` int(11) NOT NULL DEFAULT '0',
  `shared_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `slug` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pub` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `printer` (`id`, `name`, `ukuran_kertas`, `ukuran_font`, `posisi`, `max_item`, `shared_name`, `slug`, `pub`) VALUES (1, 'Inject/PDF', 'A5', '10', 'landscape', 12, 'AdobePDF', 'in', 0);
INSERT INTO `printer` (`id`, `name`, `ukuran_kertas`, `ukuran_font`, `posisi`, `max_item`, `shared_name`, `slug`, `pub`) VALUES (2, 'Thermal 85mm', '85', '10', 'potrait', 12, 'POS80 Printer', 'th', 0);
INSERT INTO `printer` (`id`, `name`, `ukuran_kertas`, `ukuran_font`, `posisi`, `max_item`, `shared_name`, `slug`, `pub`) VALUES (3, 'Thermal 58mm', '58', '0', 'potrait', 12, 'POS80 Printer', 'th58', 0);
INSERT INTO `printer` (`id`, `name`, `ukuran_kertas`, `ukuran_font`, `posisi`, `max_item`, `shared_name`, `slug`, `pub`) VALUES (4, 'Direct Thermal 58mm', '58', '10', 'potrait', 12, 'EPSON L120 Series', 'direct58', 1);
INSERT INTO `printer` (`id`, `name`, `ukuran_kertas`, `ukuran_font`, `posisi`, `max_item`, `shared_name`, `slug`, `pub`) VALUES (5, 'Direct Thermal 85mm', '85', '10', 'potrait', 12, 'EPSON L120 Series', 'direct85', 0);


#
# TABLE STRUCTURE FOR: produk
#

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) DEFAULT '0',
  `id_bahan` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '0',
  `barcode` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `harga_beli` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  `harga_grosir` int(11) NOT NULL DEFAULT '0',
  `diskon` int(11) NOT NULL DEFAULT '0',
  `ukuran` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '1',
  `pub` int(11) NOT NULL DEFAULT '1',
  `kunci` int(11) NOT NULL DEFAULT '0',
  `lock_harga` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (1, 1, '1', '0', '-', 0, 0, 0, 0, NULL, 0, 1, 1, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (2, 4, '16,11,12', '8265854397434', 'Print A3+', 0, 0, 0, 0, 'A3+', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (3, 9, '8', '5740240467186', 'Desain', 0, 0, 0, 0, '-', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (4, 3, '3,4,5', '1544358514177', 'SPANDUK', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (6, 3, '3,4', '3277642155639', 'X BANNER', 0, 0, 0, 0, '60x160cm', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (7, 3, '4', '9377984626466', 'ROLL BANNER', 0, 0, 0, 0, '60x160cm', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (8, 3, '2,3', '9899580373781', 'umbul - umbul', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (9, 3, '3,4', '1897548643969', 'baliho', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (10, 3, '3', '7792950395494', 'banner', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (11, 4, '12', '7029651846148', 'Poster', 0, 0, 0, 0, 'A3+', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (12, 13, '24', '0', 'Jasa', 0, 0, 0, 0, '-', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (13, 8, '7', '9725138235505', 'PIN', 0, 0, 0, 0, '4.4cm', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (14, 3, '6', '7983035157380', 'Stiker', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (15, 5, '11', '5654086457695', 'Brosur Offset', 0, 0, 0, 0, 'A4', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (16, 5, '13', '4117487511190', 'Note Book', 0, 0, 0, 0, '10x14cm', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (17, 4, '7', '7847932039218', 'ID CARD', 0, 0, 0, 0, '8.7x5.7cm', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (18, 3, '5', '0369522625803', 'Neon Box', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (19, 5, '12', '7537907236032', 'paper bag', 0, 0, 0, 0, '30x40cm', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (20, 5, '16', '9884264119371', 'Amplop', 0, 0, 0, 0, '22x10cm', 100, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (21, 2, '6', '8742353829174', 'Print Indoor', 0, 0, 0, 0, '1x1m', 1, 1, 0, 'N');
INSERT INTO `produk` (`id`, `id_jenis`, `id_bahan`, `barcode`, `title`, `harga_beli`, `harga_jual`, `harga_grosir`, `diskon`, `ukuran`, `jumlah`, `pub`, `kunci`, `lock_harga`) VALUES (22, 10, '20,18,19', '7265301310327', 'Rokok', 0, 0, 0, 0, '1', 1, 1, 0, 'N');


#
# TABLE STRUCTURE FOR: range_harga
#

DROP TABLE IF EXISTS `range_harga`;

CREATE TABLE `range_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` int(11) NOT NULL DEFAULT '0',
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `jumlah_minimal` int(11) NOT NULL DEFAULT '0',
  `jumlah_maksimal` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `diskon` int(2) NOT NULL DEFAULT '0',
  `pub` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `range_harga` (`id`, `id_bahan`, `id_satuan`, `jumlah_minimal`, `jumlah_maksimal`, `harga_jual`, `create_date`, `diskon`, `pub`) VALUES (1, 2, 2, 1, 5, 20000, '2023-05-15 01:49:30', 0, 0);


#
# TABLE STRUCTURE FOR: referal
#

DROP TABLE IF EXISTS `referal`;

CREATE TABLE `referal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `slug` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pub` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: rekening_bank
#

DROP TABLE IF EXISTS `rekening_bank`;

CREATE TABLE `rekening_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_akun` int(11) DEFAULT '3',
  `nama_bank` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `inisial` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `nomor_rekening` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pemilik` varchar(40) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `footer_invoice` int(11) NOT NULL DEFAULT '0',
  `publish` varchar(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `rekening_bank` (`id`, `id_akun`, `nama_bank`, `inisial`, `nomor_rekening`, `pemilik`, `footer_invoice`, `publish`) VALUES (1, 3, 'Bank Nasional Indonesia', 'BNI', '123 456 789', 'Ibnu', 1, 'Y');


#
# TABLE STRUCTURE FOR: satu_harga
#

DROP TABLE IF EXISTS `satu_harga`;

CREATE TABLE `satu_harga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` int(11) NOT NULL DEFAULT '0',
  `id_satuan` int(11) NOT NULL DEFAULT '0',
  `harga_pokok` int(11) NOT NULL DEFAULT '0',
  `persen` int(1) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `satu_harga` (`id`, `id_bahan`, `id_satuan`, `harga_pokok`, `persen`, `harga_jual`) VALUES (1, 16, 4, 300, 10, 330);
INSERT INTO `satu_harga` (`id`, `id_bahan`, `id_satuan`, `harga_pokok`, `persen`, `harga_jual`) VALUES (2, 8, 1, 15000, 60, 24000);


#
# TABLE STRUCTURE FOR: satuan
#

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_satuan` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jumlah` int(11) NOT NULL DEFAULT '0',
  `pub` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (1, 'PCS', 'Pieces', 1, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (2, 'BOX', 'Box', 1, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (3, 'LSN', 'Lusin', 12, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (4, 'LBR', 'Lembar', 1, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (5, 'MTR', 'Meter', 1, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (6, 'RIM', 'Rim', 500, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (7, 'ROLL', 'Roll', 210, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (8, 'Bungkus', 'Bungkus', 1, 0);
INSERT INTO `satuan` (`id`, `satuan`, `nama_satuan`, `jumlah`, `pub`) VALUES (9, 'Slop', 'Slop', 1, 0);


#
# TABLE STRUCTURE FOR: shared_folder
#

DROP TABLE IF EXISTS `shared_folder`;

CREATE TABLE `shared_folder` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `isi` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `shared_folder` (`id`, `nama`, `isi`) VALUES (1, 'computer_name', 'data');
INSERT INTO `shared_folder` (`id`, `nama`, `isi`) VALUES (2, 'folder_af', 'A-F');
INSERT INTO `shared_folder` (`id`, `nama`, `isi`) VALUES (3, 'folder_gm', 'G-M');
INSERT INTO `shared_folder` (`id`, `nama`, `isi`) VALUES (4, 'folder_ns', 'N-S');
INSERT INTO `shared_folder` (`id`, `nama`, `isi`) VALUES (5, 'folder_tz', 'T-Z');


#
# TABLE STRUCTURE FOR: stok_keluar
#

DROP TABLE IF EXISTS `stok_keluar`;

CREATE TABLE `stok_keluar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_invoice` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `jumlah` float NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `ket` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: stok_masuk
#

DROP TABLE IF EXISTS `stok_masuk`;

CREATE TABLE `stok_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` int(11) NOT NULL,
  `jumlah` float NOT NULL DEFAULT '0',
  `harga_beli` int(11) NOT NULL DEFAULT '0',
  `harga_jual` int(11) NOT NULL DEFAULT '0',
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ket` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `stat` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: supplier
#

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `jenis_usaha` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pemilik` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jabatan` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `alamat` varchar(150) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `telp` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `nomor_rekening` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_terdaftar` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'Y',
  `kunci` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_supplier`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `supplier` (`id_supplier`, `nama_perusahaan`, `jenis_usaha`, `pemilik`, `jabatan`, `alamat`, `telp`, `email`, `nomor_rekening`, `tgl_terdaftar`, `publish`, `kunci`) VALUES (1, 'UMUM', '-', '-', '-', '-', '-', '-', '-', '2023-05-04 18:26:04', 'Y', 1);


#
# TABLE STRUCTURE FOR: surat_jalan
#

DROP TABLE IF EXISTS `surat_jalan`;

CREATE TABLE `surat_jalan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `nama_pengirim` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `jml` int(11) NOT NULL,
  `alamat_kirim` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `catatan` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `tanggal` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

#
# TABLE STRUCTURE FOR: tb_users
#

DROP TABLE IF EXISTS `tb_users`;

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `idmenu` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `id_level` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '2',
  `idlevel` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '1,2,3,4',
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `alamat` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `no_hp` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `level` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `aktif` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `hak_akses` int(11) NOT NULL DEFAULT '0',
  `type_akses` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `id_session` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `sesi_login` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `logo` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `verify` int(11) NOT NULL DEFAULT '0',
  `app_secret` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `last_invoice` int(11) NOT NULL DEFAULT '0',
  `last_idp` int(11) DEFAULT '0',
  `last_idbeli` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `password`, `nama_lengkap`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `app_secret`, `last_invoice`, `last_idp`, `last_idbeli`) VALUES (2, 1, '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212', '3', '1,2,3,4', '$2y$10$Eo3PgiWHX8AQ5fK6acN3C.5TVqWWlhYrZ4pQ0Sl4UwhBJR5/LfldS', 'Kasir', '2020-08-28', 'Banten', 'kasir@my.id', '0899828282', '/upload/images/user/favicon.png', 'kasir', 'Y', 0, '6,7,8,9', 'ca43-608e-5c5b-7b50-2085', '6bs4vjpj45s4aodsa8cktr82t3vvtqde', NULL, 1, 'Kasir', 0, 0, 0);
INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `password`, `nama_lengkap`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `app_secret`, `last_invoice`, `last_idp`, `last_idbeli`) VALUES (1, 0, '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212', '1', '1,2,3,4,5,6', '$2y$10$1uve0JgR9cIO69Kps.iaYeAvsQ6SRzFq36SuYEULpbudMGduEX14C', 'Admin App', '2021-04-22', NULL, 'admin@my.id', '089611274798', NULL, 'admin', 'Y', 1, '1,2,4,5,6,7,8,9,10', '2R86je3fod', '6cc409a5ff5b84849290ea1c323aca2e06528fcf', NULL, 1, 'owner', 0, 0, 0);
INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `password`, `nama_lengkap`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `app_secret`, `last_invoice`, `last_idp`, `last_idbeli`) VALUES (14, 1, '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212', '1', '1,2,3,4,5,6', '$2y$10$vh5RmL9b8UPTizfJg1uaQerBMLHadif8hcWgztcfJ10rpG.5Ol/cC', 'Owner', '2022-01-12', 'Serang', 'owner@my.id', '089611274798', NULL, 'admin', 'Y', 0, '1,2,4,5,6,7,8,9,10,11,12', NULL, '1biqjdjk9dl4ho48iilbmgdqja477udc', NULL, 0, 'Owner', 0, 0, 0);
INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `password`, `nama_lengkap`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `app_secret`, `last_invoice`, `last_idp`, `last_idbeli`) VALUES (17, 1, '188,155,193,190,162,141', '5', '1,2,3,4,5,6', '$2y$10$7O4jrA5ZKFcqSMAzHxtPsegitqoxsKXMN9PZb.WwypbGqf24IqirG', 'Mzie', '2023-02-01', 'Serang', 'desain@my.id', '089611274798', NULL, 'desain', 'Y', 0, '6,7,8,9', NULL, 'dc92feba3ba954776489bffe1932dd97fcfc726d', NULL, 0, 'desainer', 0, 0, 0);
INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `password`, `nama_lengkap`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `app_secret`, `last_invoice`, `last_idp`, `last_idbeli`) VALUES (18, 1, '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212', '4', '1,2,3,4,5,6', '$2y$10$.w7kkfLFpDX5nG0Efh8YG.Y8NftAn1h4hIz03ZyhBsFjGJS0gRBqi', 'Ririn', '2023-05-02', 'Serang', 'keuangan@my.id', '089611274798', NULL, 'keu', 'Y', 0, '7,8,9,10', NULL, 'duk8rb5ri6ngsmvi1s4477hafenc1ot9', NULL, 0, 'Keuangan', 0, 0, 0);
INSERT INTO `tb_users` (`id_user`, `parent`, `idmenu`, `id_level`, `idlevel`, `password`, `nama_lengkap`, `tgl_daftar`, `alamat`, `email`, `no_hp`, `foto`, `level`, `aktif`, `hak_akses`, `type_akses`, `id_session`, `sesi_login`, `logo`, `verify`, `app_secret`, `last_invoice`, `last_idp`, `last_idbeli`) VALUES (19, 1, '24,33,109,112,116,139,141,147,148,153,154,155,156,157,159,160,162,165,166,167,168,170,171,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,193,194,195,196,197,198,199,200,201,202,203,204,205,206,207,208,209,210,211,212', '6', '1,2,3,4,5,6', '$2y$10$q36dZVaEuNsdUxkWfmdbdemx/pnkMdcSMDorSVdft1e2/KbxnM.OW', 'Depi', '2023-05-01', 'Serang', 'operator@my.id', '089611274798', NULL, 'operator', 'Y', 0, '8,9', NULL, 'vnigrnp6h5qcb1vp9af1vlrdoasa2nkh', NULL, 0, 'Operator Mesin', 0, 0, 0);


#
# TABLE STRUCTURE FOR: template_pesan
#

DROP TABLE IF EXISTS `template_pesan`;

CREATE TABLE `template_pesan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `status` varchar(1) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '0',
  `create_date` datetime NOT NULL,
  `active` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT 'Y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `template_pesan` (`id`, `title`, `deskripsi`, `status`, `create_date`, `active`) VALUES (1, 'Invoice Link', '#Nomor Order : TRX-00069 Untuk melihat invoice klik link berikut : http://localhost/pos_app/e-invoice/{token}', '1', '2023-05-07 10:09:05', 'Y');
INSERT INTO `template_pesan` (`id`, `title`, `deskripsi`, `status`, `create_date`, `active`) VALUES (2, 'Invoice Order', '{selamat},\r\n\r\nAlhamdulillah cetakan anda invoice {invoice} tanggal {tgl} *Sudah Selesai, Silahkan bisa segera di ambil*\r\nUntuk konfirmasi pesanan bisa langsung ke wa front office {fo} wa.me/{hp}\r\nhttps://pospercetakan.my.id Buka jam 08 pagi dan tutup jam 10 malam.', '2', '2023-05-07 10:09:05', 'Y');
INSERT INTO `template_pesan` (`id`, `title`, `deskripsi`, `status`, `create_date`, `active`) VALUES (3, 'Kirim Pesan Piutang', '{selamat}, \r\nAlhamdulillah pesanan anda invoice {invoice} tanggal {tgl} *Sudah Selesai, Silahkan bisa segera di ambil* Untuk konfirmasi pesanan bisa langsung ke wa front office {fo} https://wa.me/{hp}\r\nTotal Order : {total}\r\nTotal Bayar : {bayar}\r\nPiutang : {piutang}', '3', '2023-05-07 10:09:05', 'N');
INSERT INTO `template_pesan` (`id`, `title`, `deskripsi`, `status`, `create_date`, `active`) VALUES (4, 'Order Selesai', '{selamat}, Alhamdulillah cetakan anda invoice {invoice} tanggal {tgl} *Sudah Selesai, Silahkan bisa segera di ambil* Untuk konfirmasi pesanan bisa langsung ke wa front office {fo} https://wa.me/{hp} Percetakan sayuti.com Buka jam 08 pagi dan tutup jam 10 malam.', '4', '2023-05-07 10:09:05', 'Y');


#
# TABLE STRUCTURE FOR: themes
#

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `folder` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `pub` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `themes` (`id`, `title`, `folder`, `pub`) VALUES (1, 'dashboard', 'dashboard', 0);


#
# TABLE STRUCTURE FOR: type_akses
#

DROP TABLE IF EXISTS `type_akses`;

CREATE TABLE `type_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `title` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `slug` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `pub` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (1, 0, 'Edit Order', 'edit', 1, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (2, 0, 'Hapus Pembayaran', 'hapus', 1, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (3, 0, 'Edit Order Lunas', 'lunas', 1, 1);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (4, 0, 'Pending Order', 'pending', 1, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (5, 0, 'Batal Order', 'batal', 1, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (6, 0, 'Buat Order', 'add', 0, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (7, 0, 'Create Data', 'create', 0, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (8, 0, 'Read Data', 'read', 0, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (9, 0, 'Update Data', 'update', 0, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (10, 0, 'Delete Data', 'delete', 0, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (11, 0, 'Reset Database', 'reset', 0, 0);
INSERT INTO `type_akses` (`id`, `id_parent`, `title`, `slug`, `status`, `pub`) VALUES (12, 0, 'Rollback Data', 'rollback', 0, 0);


#
# TABLE STRUCTURE FOR: user_agent
#

DROP TABLE IF EXISTS `user_agent`;

CREATE TABLE `user_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `os` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `browser` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `counter` int(11) NOT NULL DEFAULT '1',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

