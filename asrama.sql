-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 03:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asrama`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `password_admin` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `jenis_kelamin`, `password_admin`) VALUES
(1, 'admin1', 'L', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` varchar(5000) NOT NULL,
  `tanggal_berita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dosen_pengajar`
--

CREATE TABLE `dosen_pengajar` (
  `NIP` varchar(50) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakulikuler`
--

CREATE TABLE `ekstrakulikuler` (
  `id_ekstrakulikuler` varchar(10) NOT NULL,
  `nama_ekstrakulikuler` varchar(100) NOT NULL,
  `jadwal_ekstrakulikuler` date DEFAULT NULL,
  `dosen_NIP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ekstrakulikuler_fasilitas`
--

CREATE TABLE `ekstrakulikuler_fasilitas` (
  `id_ekstrakulikuler` varchar(10) NOT NULL,
  `id_fasilitas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` varchar(10) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `jumlah_fasilitas` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `aturan_penggunaan` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gedung`
--

CREATE TABLE `gedung` (
  `id_gedung` int(10) NOT NULL,
  `nama_gedung` varchar(50) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `jumlah_lantai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gedung`
--

INSERT INTO `gedung` (`id_gedung`, `nama_gedung`, `jumlah_kamar`, `jumlah_lantai`) VALUES
(1, 'gedung A', 50, 4);

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `no_kamar` varchar(10) NOT NULL,
  `lantai` int(11) NOT NULL,
  `status_kamar` enum('Tersedia','Penuh','Kosong') NOT NULL,
  `id_gedung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`no_kamar`, `lantai`, `status_kamar`, `id_gedung`) VALUES
('201', 2, 'Tersedia', 1),
('202', 2, 'Tersedia', 1);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `isi_komentar` varchar(1000) NOT NULL,
  `id_berita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentar_warga`
--

CREATE TABLE `komentar_warga` (
  `nim_warga` varchar(50) NOT NULL,
  `id_komentar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(15) NOT NULL,
  `nim_warga` varchar(50) DEFAULT NULL,
  `nominal` int(12) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `nim_pengurus` varchar(50) NOT NULL,
  `password_pengurus` varchar(20) NOT NULL,
  `nama_pengurus` varchar(100) NOT NULL,
  `jurusan_pengurus` varchar(50) DEFAULT NULL,
  `nomor_handphone_pengurus` varchar(13) NOT NULL,
  `jenis_kelamin_pengurus` enum('L','P') NOT NULL,
  `alamat_pengurus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`nim_pengurus`, `password_pengurus`, `nama_pengurus`, `jurusan_pengurus`, `nomor_handphone_pengurus`, `jenis_kelamin_pengurus`, `alamat_pengurus`) VALUES
('230000000', '123', 'pengurus 1', 'opsional', '1', 'L', 'surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `warga_asrama`
--

CREATE TABLE `warga_asrama` (
  `nim_warga` varchar(50) NOT NULL,
  `nama_warga` varchar(100) NOT NULL,
  `jurusan_warga` varchar(50) NOT NULL,
  `alamat_warga` text DEFAULT NULL,
  `password_warga` varchar(100) NOT NULL,
  `jenis_kelamin_warga` enum('Laki-laki','Perempuan') NOT NULL,
  `nomor_handphone_warga` varchar(13) NOT NULL,
  `no_kamar` varchar(10) DEFAULT NULL,
  `nim_pengurus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warga_asrama`
--

INSERT INTO `warga_asrama` (`nim_warga`, `nama_warga`, `jurusan_warga`, `alamat_warga`, `password_warga`, `jenis_kelamin_warga`, `nomor_handphone_warga`, `no_kamar`, `nim_pengurus`) VALUES
('23000000012', 'fathan', 'S1 Teknik Informatika', 'lumajang', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0832193076651', '201', '230000000'),
('230411100040', 'M. Aldi Rahmandika', 'S1 Teknik Informatika', 'Blitar', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '201', '230000000');

--
-- Triggers `warga_asrama`
--
DELIMITER $$
CREATE TRIGGER `update_status_kamar_insert` AFTER INSERT ON `warga_asrama` FOR EACH ROW BEGIN
    DECLARE jumlah INT;
    
    -- Hitung jumlah penghuni kamar
    SELECT COUNT(*) INTO jumlah FROM warga_asrama WHERE no_kamar = NEW.no_kamar;
    
    -- Update status kamar jika jumlah mencapai 6
    IF jumlah >= 6 THEN
        UPDATE kamar SET status_kamar = 'Penuh' WHERE no_kamar = NEW.no_kamar;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_status_kamar_update` AFTER UPDATE ON `warga_asrama` FOR EACH ROW BEGIN
    DECLARE jumlah INT;
    
    -- Jika kamar berubah (perhatikan perbedaan dengan trigger insert)
    IF NEW.no_kamar != OLD.no_kamar THEN
        -- Hitung jumlah penghuni di kamar baru
        SELECT COUNT(*) INTO jumlah FROM warga_asrama WHERE no_kamar = NEW.no_kamar;
        
        -- Update status kamar jika jumlah penghuni mencapai 6
        IF jumlah >= 6 THEN
            UPDATE kamar SET status_kamar = 'Penuh' WHERE no_kamar = NEW.no_kamar;
        END IF;
    END IF;
    
    -- Jika penghuni keluar dan kamar menjadi kosong, update menjadi tersedia
    IF OLD.no_kamar != NEW.no_kamar THEN
        SELECT COUNT(*) INTO jumlah FROM warga_asrama WHERE no_kamar = OLD.no_kamar;
        IF jumlah = 0 THEN
            UPDATE kamar SET status_kamar = 'Tersisa' WHERE no_kamar = OLD.no_kamar;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `warga_ekstrakulikuler`
--

CREATE TABLE `warga_ekstrakulikuler` (
  `nim_warga` varchar(50) NOT NULL,
  `id_ekstrakulikuler` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `dosen_pengajar`
--
ALTER TABLE `dosen_pengajar`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `ekstrakulikuler`
--
ALTER TABLE `ekstrakulikuler`
  ADD PRIMARY KEY (`id_ekstrakulikuler`),
  ADD KEY `dosen_NIP` (`dosen_NIP`);

--
-- Indexes for table `ekstrakulikuler_fasilitas`
--
ALTER TABLE `ekstrakulikuler_fasilitas`
  ADD PRIMARY KEY (`id_ekstrakulikuler`,`id_fasilitas`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id_gedung`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`no_kamar`),
  ADD KEY `id_gedung` (`id_gedung`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_berita` (`id_berita`);

--
-- Indexes for table `komentar_warga`
--
ALTER TABLE `komentar_warga`
  ADD PRIMARY KEY (`nim_warga`,`id_komentar`),
  ADD KEY `id_komentar` (`id_komentar`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nim_warga` (`nim_warga`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`nim_pengurus`);

--
-- Indexes for table `warga_asrama`
--
ALTER TABLE `warga_asrama`
  ADD PRIMARY KEY (`nim_warga`),
  ADD KEY `no_kamar` (`no_kamar`),
  ADD KEY `nim_pengurus` (`nim_pengurus`);

--
-- Indexes for table `warga_ekstrakulikuler`
--
ALTER TABLE `warga_ekstrakulikuler`
  ADD PRIMARY KEY (`nim_warga`,`id_ekstrakulikuler`),
  ADD KEY `id_ekstrakulikuler` (`id_ekstrakulikuler`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id_gedung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ekstrakulikuler`
--
ALTER TABLE `ekstrakulikuler`
  ADD CONSTRAINT `ekstrakulikuler_ibfk_1` FOREIGN KEY (`dosen_NIP`) REFERENCES `dosen_pengajar` (`NIP`);

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id_gedung`);

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`);

--
-- Constraints for table `komentar_warga`
--
ALTER TABLE `komentar_warga`
  ADD CONSTRAINT `komentar_warga_ibfk_1` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_warga_ibfk_2` FOREIGN KEY (`id_komentar`) REFERENCES `komentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`);

--
-- Constraints for table `warga_asrama`
--
ALTER TABLE `warga_asrama`
  ADD CONSTRAINT `warga_asrama_ibfk_1` FOREIGN KEY (`no_kamar`) REFERENCES `kamar` (`no_kamar`),
  ADD CONSTRAINT `warga_asrama_ibfk_2` FOREIGN KEY (`nim_pengurus`) REFERENCES `pengurus` (`nim_pengurus`);

--
-- Constraints for table `warga_ekstrakulikuler`
--
ALTER TABLE `warga_ekstrakulikuler`
  ADD CONSTRAINT `warga_ekstrakulikuler_ibfk_1` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`),
  ADD CONSTRAINT `warga_ekstrakulikuler_ibfk_2` FOREIGN KEY (`id_ekstrakulikuler`) REFERENCES `ekstrakulikuler` (`id_ekstrakulikuler`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
