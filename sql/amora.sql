-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 05:34 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amora`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `laporanSuratMasuk` (IN `start` VARCHAR(10), IN `endd` VARCHAR(10), IN `disposisi` INT(1))  BEGIN

	CASE disposisi
		WHEN 1 THEN
			SELECT no_surat, tgl_surat, pengirim, ditujukan, perihal, deskripsi FROM v_surat_masuk WHERE (tgl_surat BETWEEN start AND endd) AND status_disposisi = "Sudah Disposisi";
		WHEN 2 THEN
			SELECT no_surat, tgl_surat, pengirim, ditujukan, perihal, deskripsi FROM v_surat_masuk WHERE (tgl_surat BETWEEN start AND endd) AND status_disposisi = "Belum Disposisi"; 
		ELSE
			SELECT no_surat, tgl_surat, pengirim, ditujukan, perihal, deskripsi FROM v_surat_masuk WHERE (tgl_surat BETWEEN start AND endd);
    END CASE;

 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `disposisi_surat_masuk`
--

CREATE TABLE `disposisi_surat_masuk` (
  `id` int(11) NOT NULL,
  `tgl_disposisi` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `id_surat_masuk` int(11) NOT NULL,
  `id_petugas` int(11) UNSIGNED NOT NULL,
  `dibuat_pada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id_jenis_surat` int(5) NOT NULL,
  `jenis_surat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_surat`
--

INSERT INTO `jenis_surat` (`id_jenis_surat`, `jenis_surat`) VALUES
(1, 'Surat Perintah'),
(2, 'Surat Keterangan'),
(3, 'Perjalanan Dinas!'),
(4, 'Surat Banding');

-- --------------------------------------------------------

--
-- Table structure for table `konsep`
--

CREATE TABLE `konsep` (
  `id_konsep` int(11) NOT NULL,
  `no_reg` varchar(50) NOT NULL,
  `pangkat` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_register` date NOT NULL,
  `jenis_kesatuan` varchar(10) NOT NULL,
  `berkas_konsep` varchar(50) NOT NULL,
  `dibuat_pada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konsep`
--

INSERT INTO `konsep` (`id_konsep`, `no_reg`, `pangkat`, `nama`, `tgl_register`, `jenis_kesatuan`, `berkas_konsep`, `dibuat_pada`) VALUES
(7, '01-K/PM III-18/AD/VI/2021', 'Mayor/0293029392023', 'SETYA PRAHARA', '2021-07-16', 'ad', '01-KPM_III-18ADVI2021_642.docx', 1625926542),
(8, 'WERQ23432432', 'ADSFADSF', 'GAAGA AFAD', '2021-07-13', 'ad', 'WERQ23432432_021.docx', 1625926904),
(9, 'ADFASDFADSF', 'SDFDSFDS', 'DSFDSF', '2021-07-14', 'ad', 'ADFASDFADSF_108.docx', 1625926925),
(10, 'DSAFASD', 'DSF', 'ASDFDS', '2021-07-22', 'au', 'DSAFASD_950.docx', 1625926940),
(11, 'SADFADS DSFSDAF', 'BCXBBX', 'QQWRWQER', '2021-07-27', 'al', 'SADFADS_DSFSDAF_728.docx', 1625926964);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nominatif`
--

CREATE TABLE `nominatif` (
  `id` int(11) NOT NULL,
  `tahun` int(5) NOT NULL,
  `bulan` int(5) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `pelaku` varchar(50) NOT NULL,
  `jml_perkara_masuk` int(10) NOT NULL,
  `jml_perkara_putus` int(10) NOT NULL,
  `dibuat_pada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nominatif`
--

INSERT INTO `nominatif` (`id`, `tahun`, `bulan`, `jenis`, `pelaku`, `jml_perkara_masuk`, `jml_perkara_putus`, `dibuat_pada`) VALUES
(1, 2021, 1, 'kejahatan', '1', 9, 4, 1632529183),
(2, 2021, 2, 'kejahatan', '1', 9, 4, 1632529260),
(3, 2021, 3, 'kejahatan', '1', 5, 2, 1632529330),
(4, 2021, 4, 'kejahatan', '1', 9, 11, 1632529612),
(5, 2021, 5, 'kejahatan', '1', 2, 7, 1632529531),
(6, 2021, 6, 'kejahatan', '1', 12, 11, 1632529689),
(7, 2021, 7, 'kejahatan', '1', 7, 4, 1632530148),
(8, 2021, 8, 'kejahatan', '1', 8, 7, 1633051891),
(9, 2021, 9, 'kejahatan', '1', 4, 12, 1633067279),
(10, 2021, 10, 'kejahatan', '1', 0, 0, 1632530371),
(11, 2021, 11, 'kejahatan', '1', 0, 0, 1632530465),
(12, 2021, 12, 'kejahatan', '1', 0, 0, 1632530509),
(13, 2021, 1, 'pelanggaran', '1', 0, 0, 1632529223),
(14, 2021, 2, 'pelanggaran', '1', 0, 0, 1632529276),
(15, 2021, 3, 'pelanggaran', '1', 1, 1, 1632529347),
(16, 2021, 4, 'pelanggaran', '1', 3, 3, 1632529602),
(17, 2021, 5, 'pelanggaran', '1', 6, 6, 1632529505),
(18, 2021, 6, 'pelanggaran', '1', 7, 7, 1632529715),
(19, 2021, 7, 'pelanggaran', '2', 0, 0, 1632530175),
(20, 2021, 8, 'pelanggaran', '1', 3, 3, 1633051918),
(21, 2021, 9, 'pelanggaran', '1', 12, 12, 1633067267),
(22, 2021, 10, 'pelanggaran', '1', 0, 0, 1632530359),
(23, 2021, 11, 'pelanggaran', '1', 0, 0, 1632530456),
(24, 2021, 12, 'pelanggaran', '1', 0, 0, 1632530499),
(49, 2021, 6, 'kejahatan', '2', 1, 1, 1632530043),
(50, 2020, 1, 'kejahatan', '1', 25, 8, 1633053645),
(51, 2020, 2, 'kejahatan', '1', 9, 9, 1633049177),
(52, 2020, 1, 'kejahatan', '3', 1, 0, 1633049269),
(53, 2020, 3, 'kejahatan', '1', 6, 7, 1633050274),
(54, 2020, 2, 'kejahatan', '2', 1, 0, 1633050354),
(55, 2020, 4, 'kejahatan', '1', 4, 8, 1633050466),
(56, 2020, 4, 'kejahatan', '3', 0, 1, 1633050553),
(57, 2020, 5, 'kejahatan', '1', 10, 6, 1633050624),
(58, 2020, 5, 'kejahatan', '2', 0, 1, 1633050662),
(59, 2020, 6, 'kejahatan', '1', 11, 8, 1633050702),
(60, 2020, 7, 'kejahatan', '1', 8, 13, 1633050736),
(61, 2020, 8, 'kejahatan', '1', 11, 11, 1633050794),
(62, 2020, 9, 'kejahatan', '1', 16, 12, 1633050915),
(63, 2020, 10, 'kejahatan', '1', 3, 11, 1633050952),
(64, 2020, 11, 'kejahatan', '1', 4, 8, 1633051005),
(65, 2020, 12, 'kejahatan', '1', 5, 8, 1633051039),
(66, 2020, 2, 'pelanggaran', '1', 2, 2, 1633051186),
(67, 2020, 3, 'pelanggaran', '1', 5, 5, 1633051213),
(68, 2020, 5, 'pelanggaran', '1', 5, 5, 1633051253),
(69, 2020, 6, 'pelanggaran', '1', 28, 20, 1633051418),
(70, 2020, 7, 'pelanggaran', '1', 3, 11, 1633051456),
(71, 2020, 8, 'pelanggaran', '1', 40, 40, 1633051489),
(72, 2020, 9, 'pelanggaran', '1', 20, 20, 1633051526),
(73, 2020, 11, 'pelanggaran', '1', 10, 10, 1633051561),
(74, 2020, 12, 'pelanggaran', '1', 1, 1, 1633051602);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `jenis_kelamin` char(1) NOT NULL,
  `tgl_lahir` varchar(15) NOT NULL,
  `alamat` tinytext DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `nama_petugas`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `telp`) VALUES
(1, '127.0.0.1', 'jaya', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'dd@aada', '', NULL, NULL, 'j25dIkqA.n8vMtbkNZ6Eee', 1268889823, 1633308484, 1, 'Ade Widianto', '', '', NULL, NULL),
(5, '127.0.0.1', 'rizanauval', '$2y$08$pz1rOHBYTSjQs13CWe9yh.zMFmRadfow1ncAN2Mi6pzDieOOo3E2.', NULL, 'user1@example.com', NULL, NULL, NULL, NULL, 1518441330, 1518584406, 1, 'Riza Nauval', 'L', '01/01/2000', 'Kec. Arcamanik, Kota Bandung', 'dandyalfaz'),
(6, '127.0.0.1', 'user', '$2y$08$EZ/vJtWjaXGjYAzin8plJubjvlyw6f2G2BQNTUQpRyvdd6KyaNPPm', NULL, 'user2@example.com', NULL, NULL, NULL, NULL, 1518588653, 1625381220, 1, 'Jajang', 'L', '02/14/2018', 'Kec.Darmaraja', '0'),
(8, '::1', 'ade', '$2y$08$uYHpx83tOAf4j7/wd0PCwOt1W/4nyC7D06y5bskRQi69tDxOGGcam', NULL, 'qw@dee.com', NULL, NULL, NULL, NULL, 1625931882, NULL, 1, 'Ade Widianto', '', '', NULL, NULL),
(9, '::1', 'andra', '$2y$08$V133VdtmCw/KBiETRT1X7OJJHDvmqI5uqSgd/.V0PAPb.5/3xsQ0W', NULL, 'andra@gmail.com', NULL, NULL, NULL, '03Z9FJaG1tXVcdgaHsGb3e', 1632536370, 1632536465, 1, 'Andra Victor', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(10) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `tgl_pengiriman` date NOT NULL,
  `perihal` varchar(100) DEFAULT NULL,
  `pengirim` varchar(50) DEFAULT NULL,
  `kepada` varchar(50) DEFAULT NULL,
  `id_jenis_surat` int(5) DEFAULT NULL,
  `sifat_surat` enum('Rahasia','Penting','Segera','Biasa') DEFAULT NULL,
  `id_petugas` int(11) UNSIGNED DEFAULT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `dibuat_pada` int(11) NOT NULL,
  `berkas_surat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat_keluar`, `no_surat`, `tgl_surat`, `tgl_pengiriman`, `perihal`, `pengirim`, `kepada`, `id_jenis_surat`, `sifat_surat`, `id_petugas`, `deskripsi`, `dibuat_pada`, `berkas_surat`) VALUES
(22, 'NO SDFDS', '2021-10-04', '2021-10-05', 'HAL', NULL, 'OTMIL', 1, NULL, 1, 'SDFSDAF KET', 1633315684, 'Surat-02178.docx');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `no_surat` varchar(50) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `perihal` varchar(100) DEFAULT NULL,
  `id_jenis_surat` int(5) DEFAULT NULL,
  `pengirim` varchar(50) DEFAULT NULL,
  `ditujukan` varchar(50) DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `id_petugas` int(11) UNSIGNED DEFAULT NULL,
  `sifat_surat` enum('Rahasia','Penting','Segera','Biasa') DEFAULT NULL,
  `status_disposisi` enum('Sudah Disposisi','Belum Disposisi') DEFAULT NULL,
  `dibuat_pada` int(11) NOT NULL,
  `berkas_surat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `no_surat`, `tgl_surat`, `perihal`, `id_jenis_surat`, `pengirim`, `ditujukan`, `deskripsi`, `id_petugas`, `sifat_surat`, `status_disposisi`, `dibuat_pada`, `berkas_surat`) VALUES
(41, '10653/B/0/IX/2021', '2021-09-27', 'Pendampingan zona integritas ke satker di lingkungan Dirjenbadilmiltun	', 1, 'Mahkamah Agung RI Dirjen Badilmil dan Peradilan Ta', NULL, 'Terlaksana', 1, NULL, NULL, 1633044402, 'Surat-58234.pdf'),
(42, '10647/B/0/IX/2021	', '2021-09-24', 'Panggilan menghadap persidangan pengadilan militer a.n terdakwa Pratu Irman Ode, NRP. 31140362580894', 1, 'Odmil IV-19 Ambon	', NULL, 'Terlaksana 88', 1, NULL, NULL, 1633044584, 'Surat-75683.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(5, 5, 2),
(6, 6, 2),
(10, 8, 1),
(12, 9, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_disposisi_surat_masuk`
-- (See below for the actual view)
--
CREATE TABLE `v_disposisi_surat_masuk` (
`id` int(11)
,`no_surat` varchar(50)
,`tgl_surat` date
,`tgl_disposisi` date
,`perihal` varchar(100)
,`dari` varchar(50)
,`kepada` varchar(50)
,`keterangan` varchar(100)
,`username` varchar(100)
,`dibuat_pada` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_petugas`
-- (See below for the actual view)
--
CREATE TABLE `v_petugas` (
`id` int(11) unsigned
,`nama_petugas` varchar(35)
,`username` varchar(100)
,`email` varchar(254)
,`group_id` mediumint(8) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_surat_keluar`
-- (See below for the actual view)
--
CREATE TABLE `v_surat_keluar` (
`id` int(10)
,`no_surat` varchar(50)
,`tgl_surat` date
,`perihal` varchar(100)
,`tgl_pengiriman` date
,`pengirim` varchar(50)
,`kepada` varchar(50)
,`jenis_surat` varchar(40)
,`sifat_surat` enum('Rahasia','Penting','Segera','Biasa')
,`petugas` varchar(100)
,`deskripsi` longtext
,`berkas_surat` varchar(25)
,`dibuat_pada` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_surat_masuk`
-- (See below for the actual view)
--
CREATE TABLE `v_surat_masuk` (
`id` int(11)
,`no_surat` varchar(50)
,`tgl_surat` date
,`perihal` varchar(100)
,`jenis_surat` varchar(40)
,`pengirim` varchar(50)
,`ditujukan` varchar(50)
,`deskripsi` mediumtext
,`username` varchar(100)
,`berkas_surat` varchar(25)
,`sifat_surat` enum('Rahasia','Penting','Segera','Biasa')
,`status_disposisi` enum('Sudah Disposisi','Belum Disposisi')
,`dibuat_pada` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_disposisi_surat_masuk`
--
DROP TABLE IF EXISTS `v_disposisi_surat_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_disposisi_surat_masuk`  AS SELECT `disposisi_surat_masuk`.`id` AS `id`, `surat_masuk`.`no_surat` AS `no_surat`, `surat_masuk`.`tgl_surat` AS `tgl_surat`, `disposisi_surat_masuk`.`tgl_disposisi` AS `tgl_disposisi`, `surat_masuk`.`perihal` AS `perihal`, `surat_masuk`.`pengirim` AS `dari`, `surat_masuk`.`ditujukan` AS `kepada`, `disposisi_surat_masuk`.`keterangan` AS `keterangan`, `petugas`.`username` AS `username`, `disposisi_surat_masuk`.`dibuat_pada` AS `dibuat_pada` FROM ((`disposisi_surat_masuk` join `surat_masuk`) join `petugas`) WHERE `disposisi_surat_masuk`.`id_surat_masuk` = `surat_masuk`.`id_surat_masuk` AND `disposisi_surat_masuk`.`id_petugas` = `petugas`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_petugas`
--
DROP TABLE IF EXISTS `v_petugas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_petugas`  AS SELECT `petugas`.`id` AS `id`, `petugas`.`nama_petugas` AS `nama_petugas`, `petugas`.`username` AS `username`, `petugas`.`email` AS `email`, `users_groups`.`group_id` AS `group_id` FROM (`petugas` join `users_groups` on(`petugas`.`id` = `users_groups`.`user_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_surat_keluar`
--
DROP TABLE IF EXISTS `v_surat_keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_surat_keluar`  AS SELECT `surat_keluar`.`id_surat_keluar` AS `id`, `surat_keluar`.`no_surat` AS `no_surat`, `surat_keluar`.`tgl_surat` AS `tgl_surat`, `surat_keluar`.`perihal` AS `perihal`, `surat_keluar`.`tgl_pengiriman` AS `tgl_pengiriman`, `surat_keluar`.`pengirim` AS `pengirim`, `surat_keluar`.`kepada` AS `kepada`, `jenis_surat`.`jenis_surat` AS `jenis_surat`, `surat_keluar`.`sifat_surat` AS `sifat_surat`, `petugas`.`username` AS `petugas`, `surat_keluar`.`deskripsi` AS `deskripsi`, `surat_keluar`.`berkas_surat` AS `berkas_surat`, `surat_keluar`.`dibuat_pada` AS `dibuat_pada` FROM ((`surat_keluar` join `jenis_surat`) join `petugas`) WHERE `surat_keluar`.`id_jenis_surat` = `jenis_surat`.`id_jenis_surat` AND `surat_keluar`.`id_petugas` = `petugas`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_surat_masuk`
--
DROP TABLE IF EXISTS `v_surat_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_surat_masuk`  AS SELECT `surat_masuk`.`id_surat_masuk` AS `id`, `surat_masuk`.`no_surat` AS `no_surat`, `surat_masuk`.`tgl_surat` AS `tgl_surat`, `surat_masuk`.`perihal` AS `perihal`, `jenis_surat`.`jenis_surat` AS `jenis_surat`, `surat_masuk`.`pengirim` AS `pengirim`, `surat_masuk`.`ditujukan` AS `ditujukan`, `surat_masuk`.`deskripsi` AS `deskripsi`, `petugas`.`username` AS `username`, `surat_masuk`.`berkas_surat` AS `berkas_surat`, `surat_masuk`.`sifat_surat` AS `sifat_surat`, `surat_masuk`.`status_disposisi` AS `status_disposisi`, `surat_masuk`.`dibuat_pada` AS `dibuat_pada` FROM ((`surat_masuk` join `jenis_surat`) join `petugas`) WHERE `surat_masuk`.`id_jenis_surat` = `jenis_surat`.`id_jenis_surat` AND `surat_masuk`.`id_petugas` = `petugas`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi_surat_masuk`
--
ALTER TABLE `disposisi_surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_disposisi_surat_masuk_petugas1` (`id_petugas`),
  ADD KEY `fk_disposisi_surat_masuk_surat_masuk1` (`id_surat_masuk`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_surat`
--
ALTER TABLE `jenis_surat`
  ADD PRIMARY KEY (`id_jenis_surat`);

--
-- Indexes for table `konsep`
--
ALTER TABLE `konsep`
  ADD PRIMARY KEY (`id_konsep`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominatif`
--
ALTER TABLE `nominatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id_surat_keluar`),
  ADD KEY `fk_surat_keluar__jenis_surat1` (`id_jenis_surat`),
  ADD KEY `fk_surat_keluar_petugas1` (`id_petugas`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id_surat_masuk`),
  ADD KEY `fk_surat_masuk_jenis_surat1` (`id_jenis_surat`),
  ADD KEY `fk_surat_masuk_petugas1` (`id_petugas`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi_surat_masuk`
--
ALTER TABLE `disposisi_surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `konsep`
--
ALTER TABLE `konsep`
  MODIFY `id_konsep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nominatif`
--
ALTER TABLE `nominatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `disposisi_surat_masuk`
--
ALTER TABLE `disposisi_surat_masuk`
  ADD CONSTRAINT `fk_disposisi_surat_masuk_petugas1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_disposisi_surat_masuk_surat_masuk1` FOREIGN KEY (`id_surat_masuk`) REFERENCES `surat_masuk` (`id_surat_masuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `fk_surat_keluar__jenis_surat1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `jenis_surat` (`id_jenis_surat`),
  ADD CONSTRAINT `fk_surat_keluar_petugas1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `fk_surat_masuk_jenis_surat1` FOREIGN KEY (`id_jenis_surat`) REFERENCES `jenis_surat` (`id_jenis_surat`),
  ADD CONSTRAINT `fk_surat_masuk_petugas1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
