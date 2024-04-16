-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2022 at 08:58 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpeg`
--

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `rekap_hadir` int(11) NOT NULL,
  `rekap_izin` int(11) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `gaji_pokok` bigint(20) NOT NULL,
  `bonus_gaji` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `id_pegawai`, `rekap_hadir`, `rekap_izin`, `tanggal_terima`, `nama`, `jabatan`, `gaji_pokok`, `bonus_gaji`) VALUES
(8, 3, 1, 0, '2022-04-05', 'Riko Putra', 'Admin Manager', 1000000, 0),
(9, 2, 1, 2, '2022-05-07', 'Muhammad Rizaldi', 'Head Departement IT', 1000000, 400000),
(10, 3, 1, 0, '2022-05-13', 'Riko Putra', 'Admin Manager', 120000, 0),
(11, 2, 1, 2, '2022-05-13', 'Muhammad Rizaldi', 'Head Departement IT', 1000000, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `kehadiran`
--

CREATE TABLE `kehadiran` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `latitude` varchar(200) NOT NULL,
  `longitude` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kehadiran`
--

INSERT INTO `kehadiran` (`id`, `id_pegawai`, `nama`, `tanggal`, `latitude`, `longitude`) VALUES
(3, 2, 'Muhammad Rizaldi', '2022-04-20', '-5.1373', '119.4282'),
(4, 2, 'Muhammad Rizaldi', '2022-05-06', '-5.1373', '119.4282'),
(5, 3, 'Riko Putra', '2022-05-07', '-3.3166', '114.5901');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jenis_kelamin` enum('Laki Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `agama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `no_ktp` bigint(20) NOT NULL,
  `no_telpon` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `username`, `password`, `foto`, `nama`, `jenis_kelamin`, `alamat`, `agama`, `jabatan`, `no_ktp`, `no_telpon`) VALUES
(2, 'rizal', '$2y$10$SEYVQMsaBLH0OBUDmAVde.zscwNgeBiSaaz5N4R09PYoRtC/s0MTy', '625d67f46e4f3.jpg', 'Muhammad Rizaldi', 'Laki Laki', 'Jl.Cemara Raya No.24', 'Islam', 'Head Departement IT', 1277100276412, 6289987866651),
(3, 'riko', '$2y$10$x7EiE3I2sZYeVtFn5vw78OTCG2DOHYFfF9POvwTB0iQPN8cOBsn0C', '6275f095c6844.png', 'Riko Putra', 'Laki Laki', 'Jl.shghgs', 'Islam', 'Admin Manager', 120008723712321, 628999872732);

-- --------------------------------------------------------

--
-- Table structure for table `perizinan`
--

CREATE TABLE `perizinan` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `jumlah_izin` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perizinan`
--

INSERT INTO `perizinan` (`id`, `id_pegawai`, `nama`, `jabatan`, `keterangan`, `jumlah_izin`, `tanggal_mulai`, `tanggal_akhir`) VALUES
(1, 2, 'Muhammad Rizaldi', 'Head Departement IT', 'Izin Sakit', 3, '2022-04-20', '2022-04-22'),
(2, 2, 'Muhammad Rizaldi', 'Head Departement IT', 'Izin CUti', 17, '2022-03-14', '2022-03-31'),
(3, 2, 'Muhammad Rizaldi', 'Head Departement IT', 'Sakit Perut', 2, '2022-05-07', '2022-05-08');

-- --------------------------------------------------------

--
-- Table structure for table `super_user`
--

CREATE TABLE `super_user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('Admin','Notaris') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_user`
--

INSERT INTO `super_user` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$JWjEh8nTXVQnNlIdYT9mI.5MmF3w892ftnTyiojCkfTuzwvHErxQO', 'Admin'),
(3, 'notaris', '$2y$10$DipaPR3ih0ZBKbcoYKURBOiSzfjZHOlCsm1TOzIbgb1t9qYjE.4Ui', 'Notaris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `super_user`
--
ALTER TABLE `super_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kehadiran`
--
ALTER TABLE `kehadiran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `super_user`
--
ALTER TABLE `super_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kehadiran`
--
ALTER TABLE `kehadiran`
  ADD CONSTRAINT `kehadiran_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD CONSTRAINT `perizinan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
