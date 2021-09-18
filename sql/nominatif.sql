-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2021 at 11:55 PM
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
-- Database: `db_pengarsipan_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `nominatif`
--

CREATE TABLE `nominatif` (
  `id_nominatif` int(11) NOT NULL,
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

INSERT INTO `nominatif` (`id_nominatif`, `tahun`, `bulan`, `jenis`, `pelaku`, `jml_perkara_masuk`, `jml_perkara_putus`, `dibuat_pada`) VALUES
(1, 2021, 1, 'kejahatan', '1', 20, 22, 1631675244),
(2, 2021, 2, 'kejahatan', '1', 20, 22, 1631675244),
(3, 2021, 3, 'kejahatan', '1', 20, 22, 1631675244),
(4, 2021, 4, 'kejahatan', '2', 11, 6, 1631675244),
(5, 2021, 5, 'kejahatan', '3', 13, 8, 1631675244),
(6, 2021, 6, 'kejahatan', '1', 20, 22, 1631675244),
(7, 2021, 7, 'kejahatan', '2', 12, 7, 1631675244),
(8, 2021, 8, 'kejahatan', '1', 20, 22, 1631675244),
(9, 2021, 9, 'kejahatan', '1', 20, 22, 1631675244),
(10, 2021, 10, 'kejahatan', '1', 20, 22, 1631675244),
(11, 2021, 11, 'kejahatan', '1', 20, 22, 1631675244),
(12, 2021, 12, 'kejahatan', '1', 20, 22, 1631675244),
(13, 2021, 1, 'pelanggaran', '1', 20, 22, 1631675244),
(14, 2021, 2, 'pelanggaran', '1', 20, 22, 1631675244),
(15, 2021, 3, 'pelanggaran', '1', 20, 22, 1631675244),
(16, 2021, 4, 'pelanggaran', '2', 11, 6, 1631675244),
(17, 2021, 5, 'pelanggaran', '3', 13, 8, 1631675244),
(18, 2021, 6, 'pelanggaran', '1', 20, 22, 1631675244),
(19, 2021, 7, 'pelanggaran', '2', 12, 7, 1631675244),
(20, 2021, 8, 'pelanggaran', '1', 20, 22, 1631675244),
(21, 2021, 9, 'pelanggaran', '1', 20, 22, 1631675244),
(22, 2021, 10, 'pelanggaran', '1', 20, 22, 1631675244),
(23, 2021, 11, 'pelanggaran', '1', 20, 22, 1631675244),
(24, 2021, 12, 'pelanggaran', '1', 20, 22, 1631675244),
(25, 2020, 1, 'kejahatan', '1', 20, 22, 1631675244),
(26, 2020, 2, 'kejahatan', '1', 20, 22, 1631675244),
(27, 2020, 3, 'kejahatan', '1', 20, 22, 1631675244),
(28, 2020, 4, 'kejahatan', '2', 11, 6, 1631675244),
(29, 2020, 5, 'kejahatan', '3', 13, 8, 1631675244),
(30, 2020, 6, 'kejahatan', '1', 20, 22, 1631675244),
(31, 2020, 7, 'kejahatan', '2', 12, 7, 1631675244),
(32, 2020, 8, 'kejahatan', '1', 20, 22, 1631675244),
(33, 2020, 9, 'kejahatan', '1', 20, 22, 1631675244),
(34, 2020, 10, 'kejahatan', '1', 20, 22, 1631675244),
(35, 2020, 11, 'kejahatan', '1', 20, 22, 1631675244),
(36, 2020, 12, 'kejahatan', '1', 20, 22, 1631675244),
(37, 2020, 1, 'pelanggaran', '2', 20, 22, 1631675244),
(38, 2020, 2, 'pelanggaran', '1', 20, 22, 1631675244),
(39, 2020, 3, 'pelanggaran', '1', 20, 22, 1631675244),
(40, 2020, 4, 'pelanggaran', '2', 11, 6, 1631675244),
(41, 2020, 5, 'pelanggaran', '3', 13, 8, 1631675244),
(42, 2020, 6, 'pelanggaran', '1', 20, 22, 1631675244),
(43, 2020, 7, 'pelanggaran', '1', 12, 7, 1631675244),
(44, 2020, 8, 'pelanggaran', '3', 20, 22, 1631675244),
(45, 2020, 9, 'pelanggaran', '1', 20, 22, 1631675244),
(46, 2020, 10, 'pelanggaran', '1', 20, 22, 1631675244),
(47, 2020, 11, 'pelanggaran', '1', 20, 22, 1631675244),
(48, 2020, 12, 'pelanggaran', '1', 20, 22, 1631675244);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nominatif`
--
ALTER TABLE `nominatif`
  ADD PRIMARY KEY (`id_nominatif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nominatif`
--
ALTER TABLE `nominatif`
  MODIFY `id_nominatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
