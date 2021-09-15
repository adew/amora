-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2018 at 01:54 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengarsipan_surat`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `laporanSuratMasuk` (`start` VARCHAR(10), `endd` VARCHAR(10), `disposisi` INT(1))  BEGIN

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

--
-- Dumping data for table `disposisi_surat_masuk`
--

INSERT INTO `disposisi_surat_masuk` (`id`, `tgl_disposisi`, `keterangan`, `id_surat_masuk`, `id_petugas`, `dibuat_pada`) VALUES
(1, '2018-02-14', 'test', 23, 1, 1518588750),
(2, '2018-02-14', 'test test', 24, 1, 1518589226);

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
(3, 'Perjalanan Dinas!');

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
  `alamat` tinytext,
  `telp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `nama_petugas`, `jenis_kelamin`, `tgl_lahir`, `alamat`, `telp`) VALUES
(1, '127.0.0.1', 'dandyalfaz', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', '', '', NULL, NULL, NULL, 1268889823, 1532865213, 1, 'Dandy Alfaz Ramadhan', '', '', NULL, NULL),
(5, '127.0.0.1', 'rizanauval', '$2y$08$pz1rOHBYTSjQs13CWe9yh.zMFmRadfow1ncAN2Mi6pzDieOOo3E2.', NULL, 'user1@example.com', NULL, NULL, NULL, NULL, 1518441330, 1518584406, 1, 'Riza Nauval', 'L', '01/01/2000', 'Kec. Arcamanik, Kota Bandung', 'dandyalfaz'),
(6, '127.0.0.1', 'jajang123', '$2y$08$K031finiFzK9n8f6ZXJULOjojQK80L54rHMXqE7F4FrLjn2wKIHeK', NULL, 'user2@example.com', NULL, NULL, NULL, NULL, 1518588653, NULL, 1, 'Jajang', 'L', '02/14/2018', 'Kec.Darmaraja', '0');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id_surat_keluar` int(10) NOT NULL,
  `no_surat` varchar(15) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `perihal` varchar(100) DEFAULT NULL,
  `pengirim` varchar(45) DEFAULT NULL,
  `kepada` varchar(30) DEFAULT NULL,
  `id_jenis_surat` int(5) DEFAULT NULL,
  `sifat_surat` enum('Rahasia','Penting','Segera','Biasa') DEFAULT NULL,
  `id_petugas` int(11) UNSIGNED DEFAULT NULL,
  `deskripsi` longtext,
  `dibuat_pada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id_surat_keluar`, `no_surat`, `tgl_surat`, `perihal`, `pengirim`, `kepada`, `id_jenis_surat`, `sifat_surat`, `id_petugas`, `deskripsi`, `dibuat_pada`) VALUES
(7, '999', '2018-02-14', 'Test', 'A', 'B', 2, 'Rahasia', 1, 'lorem ipsum', 1518574758),
(8, '111', '2018-02-14', 'Test 2', 'C', 'De', 1, 'Rahasia', 1, 'lorem ipsum', 1518574858),
(9, '123', '2018-02-14', 'Test 3', 'E', 'F', 3, 'Rahasia', 1, 'test test test', 1518574896),
(11, '8', '2018-02-14', 'yyyy', 'K', 'L', 3, 'Rahasia', 1, 'G', 1518588317),
(12, '99', '2018-02-14', 'A', 'B', 'C', 3, 'Rahasia', 1, 'D', 1518589290);

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id_surat_masuk` int(11) NOT NULL,
  `no_surat` varchar(13) DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `perihal` varchar(100) DEFAULT NULL,
  `id_jenis_surat` int(5) DEFAULT NULL,
  `pengirim` varchar(30) DEFAULT NULL,
  `ditujukan` varchar(30) DEFAULT NULL,
  `deskripsi` mediumtext,
  `id_petugas` int(11) UNSIGNED DEFAULT NULL,
  `sifat_surat` enum('Rahasia','Penting','Segera','Biasa') DEFAULT NULL,
  `status_disposisi` enum('Sudah Disposisi','Belum Disposisi') DEFAULT NULL,
  `dibuat_pada` int(11) NOT NULL,
  `berkas_surat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id_surat_masuk`, `no_surat`, `tgl_surat`, `perihal`, `id_jenis_surat`, `pengirim`, `ditujukan`, `deskripsi`, `id_petugas`, `sifat_surat`, `status_disposisi`, `dibuat_pada`, `berkas_surat`) VALUES
(21, '123', '2018-02-14', 'Test 1', 3, 'A', 'B', 'lorem ipsum', 1, 'Rahasia', 'Belum Disposisi', 1518575656, ''),
(22, '90', '2018-02-14', 'Test', 3, 'N', 'M', 'lorem ipsum', 1, 'Rahasia', 'Belum Disposisi', 1518587623, ''),
(23, '1111', '2018-02-14', 'A', 3, 'B', 'C', 'D', 1, 'Penting', 'Sudah Disposisi', 1518588730, '1266385572001993.jpg'),
(24, '212', '2018-02-14', 'Ujikom', 2, 'Sekolah', 'Siswa', 'Ujikom', 1, 'Penting', 'Sudah Disposisi', 1518589137, '4794168875039523.jpg');

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
(6, 6, 2);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_disposisi_surat_masuk`
-- (See below for the actual view)
--
CREATE TABLE `v_disposisi_surat_masuk` (
`id` int(11)
,`no_surat` varchar(13)
,`tgl_surat` date
,`tgl_disposisi` date
,`perihal` varchar(100)
,`dari` varchar(30)
,`kepada` varchar(30)
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
,`jenis_kelamin` char(1)
,`tgl_lahir` varchar(15)
,`alamat` tinytext
,`email` varchar(254)
,`telp` varchar(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_surat_keluar`
-- (See below for the actual view)
--
CREATE TABLE `v_surat_keluar` (
`id` int(10)
,`no_surat` varchar(15)
,`tgl_surat` date
,`perihal` varchar(100)
,`pengirim` varchar(45)
,`kepada` varchar(30)
,`jenis_surat` varchar(40)
,`sifat_surat` enum('Rahasia','Penting','Segera','Biasa')
,`petugas` varchar(100)
,`deskripsi` longtext
,`dibuat_pada` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_surat_masuk`
-- (See below for the actual view)
--
CREATE TABLE `v_surat_masuk` (
`id` int(11)
,`no_surat` varchar(13)
,`tgl_surat` date
,`perihal` varchar(100)
,`jenis_surat` varchar(40)
,`pengirim` varchar(30)
,`ditujukan` varchar(30)
,`deskripsi` mediumtext
,`username` varchar(100)
,`berkas_surat` varchar(20)
,`sifat_surat` enum('Rahasia','Penting','Segera','Biasa')
,`status_disposisi` enum('Sudah Disposisi','Belum Disposisi')
,`dibuat_pada` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_disposisi_surat_masuk`
--
DROP TABLE IF EXISTS `v_disposisi_surat_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_disposisi_surat_masuk`  AS  select `disposisi_surat_masuk`.`id` AS `id`,`surat_masuk`.`no_surat` AS `no_surat`,`surat_masuk`.`tgl_surat` AS `tgl_surat`,`disposisi_surat_masuk`.`tgl_disposisi` AS `tgl_disposisi`,`surat_masuk`.`perihal` AS `perihal`,`surat_masuk`.`pengirim` AS `dari`,`surat_masuk`.`ditujukan` AS `kepada`,`disposisi_surat_masuk`.`keterangan` AS `keterangan`,`petugas`.`username` AS `username`,`disposisi_surat_masuk`.`dibuat_pada` AS `dibuat_pada` from ((`disposisi_surat_masuk` join `surat_masuk`) join `petugas`) where ((`disposisi_surat_masuk`.`id_surat_masuk` = `surat_masuk`.`id_surat_masuk`) and (`disposisi_surat_masuk`.`id_petugas` = `petugas`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_petugas`
--
DROP TABLE IF EXISTS `v_petugas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_petugas`  AS  select `petugas`.`id` AS `id`,`petugas`.`nama_petugas` AS `nama_petugas`,`petugas`.`username` AS `username`,`petugas`.`jenis_kelamin` AS `jenis_kelamin`,`petugas`.`tgl_lahir` AS `tgl_lahir`,`petugas`.`alamat` AS `alamat`,`petugas`.`email` AS `email`,`petugas`.`telp` AS `telp` from (`petugas` join `users_groups` on((`petugas`.`id` = `users_groups`.`user_id`))) where (`users_groups`.`group_id` = 2) ;

-- --------------------------------------------------------

--
-- Structure for view `v_surat_keluar`
--
DROP TABLE IF EXISTS `v_surat_keluar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_surat_keluar`  AS  select `surat_keluar`.`id_surat_keluar` AS `id`,`surat_keluar`.`no_surat` AS `no_surat`,`surat_keluar`.`tgl_surat` AS `tgl_surat`,`surat_keluar`.`perihal` AS `perihal`,`surat_keluar`.`pengirim` AS `pengirim`,`surat_keluar`.`kepada` AS `kepada`,`jenis_surat`.`jenis_surat` AS `jenis_surat`,`surat_keluar`.`sifat_surat` AS `sifat_surat`,`petugas`.`username` AS `petugas`,`surat_keluar`.`deskripsi` AS `deskripsi`,`surat_keluar`.`dibuat_pada` AS `dibuat_pada` from ((`surat_keluar` join `jenis_surat`) join `petugas`) where ((`surat_keluar`.`id_jenis_surat` = `jenis_surat`.`id_jenis_surat`) and (`surat_keluar`.`id_petugas` = `petugas`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_surat_masuk`
--
DROP TABLE IF EXISTS `v_surat_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_surat_masuk`  AS  select `surat_masuk`.`id_surat_masuk` AS `id`,`surat_masuk`.`no_surat` AS `no_surat`,`surat_masuk`.`tgl_surat` AS `tgl_surat`,`surat_masuk`.`perihal` AS `perihal`,`jenis_surat`.`jenis_surat` AS `jenis_surat`,`surat_masuk`.`pengirim` AS `pengirim`,`surat_masuk`.`ditujukan` AS `ditujukan`,`surat_masuk`.`deskripsi` AS `deskripsi`,`petugas`.`username` AS `username`,`surat_masuk`.`berkas_surat` AS `berkas_surat`,`surat_masuk`.`sifat_surat` AS `sifat_surat`,`surat_masuk`.`status_disposisi` AS `status_disposisi`,`surat_masuk`.`dibuat_pada` AS `dibuat_pada` from ((`surat_masuk` join `jenis_surat`) join `petugas`) where ((`surat_masuk`.`id_jenis_surat` = `jenis_surat`.`id_jenis_surat`) and (`surat_masuk`.`id_petugas` = `petugas`.`id`)) ;

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
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
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
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id_surat_keluar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id_surat_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
