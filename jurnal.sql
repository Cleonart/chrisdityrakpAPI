-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 10:53 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurnal`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel_daftar`
--

CREATE TABLE `artikel_daftar` (
  `artikel_id` int(10) NOT NULL,
  `artikel_judul` varchar(200) NOT NULL,
  `artikel_abstrak` varchar(200) NOT NULL,
  `artikel_halaman` varchar(100) NOT NULL,
  `artikel_keyword` varchar(100) DEFAULT NULL,
  `artikel_filepath` varchar(100) NOT NULL,
  `artikel_jurnal_id` int(20) NOT NULL,
  `jurnal_edisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `artikel_penulis`
--

CREATE TABLE `artikel_penulis` (
  `artikel_id` int(15) NOT NULL,
  `id_artikel_penulis` int(10) NOT NULL,
  `nama_artikel_penulis` varchar(50) NOT NULL,
  `status_artikel_penulis` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `fakultas_id` int(10) NOT NULL,
  `fakultas_nama` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`fakultas_id`, `fakultas_nama`) VALUES
(1, 'Universitas'),
(2, 'Teknik'),
(3, 'Keperawatan'),
(4, 'Ekonomi'),
(5, 'Hukum'),
(6, 'Pertanian'),
(7, 'Pariwisata'),
(8, 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `jurnal_id` int(10) NOT NULL,
  `jurnal_nama` varchar(20) NOT NULL,
  `jurnal_institusi` varchar(20) NOT NULL,
  `institusi_id` int(11) NOT NULL,
  `jurnal_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_edisi`
--

CREATE TABLE `jurnal_edisi` (
  `jurnal_id` int(10) NOT NULL,
  `jurnal_edisi_id` int(10) NOT NULL,
  `jurnal_edisi_volume` int(10) NOT NULL,
  `jurnal_edisi_nomor` int(10) NOT NULL,
  `jurnal_edisi_tahun` year(4) NOT NULL,
  `jurnal_edisi_publish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `pengguna_id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pengguna_nama` varchar(50) NOT NULL,
  `pengguna_sandi` varchar(50) NOT NULL,
  `pengguna_institusi` int(11) NOT NULL,
  `pengguna_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`pengguna_id`, `username`, `pengguna_nama`, `pengguna_sandi`, `pengguna_institusi`, `pengguna_status`) VALUES
(1111, 'jbs', 'Junaidy Budi Sanger', '21232f297a57a5a743894a0e4a801fc3', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel_daftar`
--
ALTER TABLE `artikel_daftar`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `artikel_penulis`
--
ALTER TABLE `artikel_penulis`
  ADD PRIMARY KEY (`id_artikel_penulis`);

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`fakultas_id`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`jurnal_id`);

--
-- Indexes for table `jurnal_edisi`
--
ALTER TABLE `jurnal_edisi`
  ADD PRIMARY KEY (`jurnal_edisi_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `pengguna_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102001;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
