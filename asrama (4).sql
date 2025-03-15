-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Des 2024 pada 18.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(12) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `password_admin` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `jenis_kelamin`, `password_admin`) VALUES
(1, 'admin1', 'L', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `isi_berita` varchar(5000) NOT NULL,
  `tanggal_berita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul_berita`, `isi_berita`, `tanggal_berita`) VALUES
(1, 'Idul Fitri 1445 H: Momen Kebahagiaan dan Silaturahmi', 'Idul Fitri 1445 H yang jatuh pada bulan April 2024 diprediksi menjadi salah satu perayaan besar di Indonesia. Hari raya ini dirayakan oleh umat Muslim setelah menjalani ibadah puasa selama satu bulan penuh di bulan Ramadan.\r\n\r\nTradisi mudik kembali menjadi sorotan. Jutaan orang melakukan perjalanan ke kampung halaman untuk bersilaturahmi dengan keluarga besar. Pemerintah telah mempersiapkan berbagai infrastruktur untuk mendukung kelancaran arus mudik, termasuk penambahan jalur tol dan peningkatan layanan transportasi umum.\r\n\r\nSelain mudik, tradisi unik seperti saling memaafkan, berbagi hidangan khas lebaran, dan memberikan amplop berisi uang kepada anak-anak turut mewarnai perayaan. Hidangan khas seperti ketupat, opor ayam, dan rendang menjadi simbol kebersamaan.\r\n\r\nPerayaan Idul Fitri juga memberikan dampak positif bagi perekonomian. Sektor ritel dan pariwisata mengalami lonjakan pendapatan selama musim libur lebaran. Pasar tradisional dan pusat perbelanjaan ramai dikunjungi pembeli yang mempersiapkan kebutuhan lebaran.\r\n\r\nNamun, di balik kemeriahan, Idul Fitri juga menjadi momen introspeksi. Umat Muslim diingatkan untuk menjaga kesucian hati dan hubungan baik dengan sesama manusia, sebagaimana esensi dari ibadah puasa yang telah dijalani.', '2024-12-20'),
(2, 'Hari Kemerdekaan Indonesia ke-79', 'Tanggal 17 Agustus 2024 akan menjadi peringatan Hari Kemerdekaan Indonesia yang ke-79. Perayaan ini menjadi pengingat perjuangan para pahlawan dalam merebut kemerdekaan dari penjajah.\r\n\r\nSeperti tahun-tahun sebelumnya, upacara bendera akan digelar di Istana Merdeka, Jakarta. Presiden dan pejabat tinggi negara akan menghadiri acara tersebut, bersama dengan masyarakat dari berbagai lapisan.\r\n\r\nDi berbagai daerah, lomba-lomba tradisional seperti panjat pinang, balap karung, dan tarik tambang diadakan untuk memeriahkan suasana. Kegiatan ini tidak hanya menjadi hiburan, tetapi juga mempererat rasa persatuan.\r\n\r\nMomentum kemerdekaan juga dimanfaatkan untuk menanamkan rasa nasionalisme di kalangan generasi muda. Sekolah-sekolah menggelar kegiatan seperti lomba pidato, pembuatan poster, dan seminar sejarah perjuangan bangsa.\r\n\r\nNamun, Hari Kemerdekaan juga menjadi pengingat akan tantangan yang masih dihadapi bangsa. Pembangunan infrastruktur, pendidikan, dan kesejahteraan masyarakat terus menjadi prioritas agar cita-cita kemerdekaan dapat terwujud sepenuhnya.\r\n', '2024-12-20'),
(3, 'Hari Pendidikan Nasional 2024: Mengukir Masa Depan Bangsa', 'Hari Pendidikan Nasional (Hardiknas) yang diperingati setiap tanggal 2 Mei menjadi momen penting untuk merefleksikan kemajuan dunia pendidikan di Indonesia. Tahun 2024, peringatan ini mengangkat tema \"Pendidikan Inklusif untuk Semua.\"\r\n\r\nDi berbagai daerah, sekolah-sekolah menggelar upacara bendera untuk mengenang jasa Ki Hajar Dewantara sebagai Bapak Pendidikan Nasional. Selain itu, kegiatan seperti seminar, lomba pidato, dan workshop tentang inovasi pendidikan turut memeriahkan peringatan ini.\r\n\r\nPemerintah juga meluncurkan beberapa program baru untuk meningkatkan akses pendidikan di daerah terpencil. Program digitalisasi sekolah menjadi salah satu sorotan, dengan distribusi perangkat teknologi untuk mendukung proses belajar-mengajar.\r\n\r\nNamun, tantangan di dunia pendidikan masih menjadi pekerjaan rumah. Masalah seperti kesenjangan kualitas pendidikan antara kota dan desa, serta aksesibilitas pendidikan bagi anak-anak berkebutuhan khusus, menjadi isu yang terus dibahas.\r\n\r\nHari Pendidikan Nasional menjadi pengingat bahwa pendidikan adalah kunci untuk membangun bangsa yang maju. Semua pihak, mulai dari pemerintah, pendidik, hingga masyarakat, diharapkan dapat berperan aktif dalam menciptakan sistem pendidikan yang lebih baik.\r\n\r\n', '2024-12-20'),
(4, 'Hari Pahlawan 2024: Menghargai Jasa Pahlawan Bangsa', 'Hari Pahlawan yang jatuh pada tanggal 10 November selalu menjadi momen penting bagi bangsa Indonesia. Tahun 2024, tema peringatan ini adalah “Bersama Melanjutkan Perjuangan.”\r\n\r\nDi berbagai daerah, masyarakat mengadakan upacara penghormatan di makam pahlawan. Tradisi ini menjadi simbol penghargaan atas jasa para pahlawan yang telah berjuang untuk kemerdekaan Indonesia.\r\n\r\nSekolah dan universitas turut memeriahkan peringatan Hari Pahlawan dengan menggelar lomba-lomba bertema perjuangan, seperti drama sejarah, poster, dan esai. Kegiatan ini bertujuan untuk menanamkan rasa cinta tanah air pada generasi muda.\r\n\r\nMedia massa juga berperan penting dalam mengingatkan masyarakat akan pentingnya Hari Pahlawan. Dokumenter, film sejarah, dan artikel tentang perjuangan para pahlawan sering dipublikasikan menjelang peringatan ini.\r\n\r\nHari Pahlawan tidak hanya tentang mengenang masa lalu, tetapi juga memotivasi masyarakat untuk berkontribusi bagi bangsa. Nilai-nilai kepahlawanan, seperti keberanian, kejujuran, dan pengorbanan, diharapkan dapat terus hidup dalam kehidupan sehari-hari.', '2024-12-20'),
(5, 'Maulid Nabi Muhammad SAW 2024: Mengenang Keteladanan Sang Nabi', 'Maulid Nabi Muhammad SAW yang jatuh pada 15 Rabiul Awal 1446 H atau 25 September 2024 dirayakan dengan penuh khidmat oleh umat Muslim di seluruh dunia. Peringatan ini menjadi momen untuk mengenang keteladanan Nabi Muhammad SAW.\r\n\r\nDi Indonesia, perayaan Maulid Nabi diwarnai dengan pengajian, zikir, dan sholawat di masjid-masjid. Banyak daerah yang juga menggelar tradisi khas, seperti Grebeg Maulid di Yogyakarta dan Sekaten di Surakarta.\r\n\r\nSelain itu, Maulid Nabi menjadi ajang untuk mempererat hubungan sosial. Kegiatan berbagi makanan dan bantuan kepada yang membutuhkan menjadi bagian dari perayaan ini, sesuai dengan nilai-nilai kebaikan yang diajarkan Nabi Muhammad SAW.\r\n\r\nPemerintah dan organisasi Islam turut mengadakan acara besar, seperti tabligh akbar dan seminar keislaman, yang dihadiri oleh ulama-ulama terkemuka. Acara ini bertujuan untuk memperkuat pemahaman umat tentang ajaran Islam.\r\n\r\nMaulid Nabi bukan hanya sekadar tradisi, tetapi juga momen untuk merefleksikan nilai-nilai luhur Nabi Muhammad SAW. Umat Muslim diingatkan untuk terus meneladani sifat-sifat seperti kejujuran, kesabaran, dan kasih sayang dalam kehidupan sehari-hari.\r\n\r\n', '2024-12-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen_pengajar`
--

CREATE TABLE `dosen_pengajar` (
  `NIP` varchar(50) NOT NULL,
  `nama_dosen` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen_pengajar`
--

INSERT INTO `dosen_pengajar` (`NIP`, `nama_dosen`, `alamat`, `jenis_kelamin`) VALUES
('123', 'samsul', 'blitar', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstrakulikuler`
--

CREATE TABLE `ekstrakulikuler` (
  `id_ekstrakulikuler` varchar(10) NOT NULL,
  `nama_ekstrakulikuler` varchar(100) NOT NULL,
  `jadwal_ekstrakulikuler` varchar(100) DEFAULT NULL,
  `materi` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `dosen_NIP` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ekstrakulikuler`
--

INSERT INTO `ekstrakulikuler` (`id_ekstrakulikuler`, `nama_ekstrakulikuler`, `jadwal_ekstrakulikuler`, `materi`, `status`, `dosen_NIP`) VALUES
('1', 'bahasa arab', 'rabu 19.30', '', '', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekstrakulikuler_fasilitas`
--

CREATE TABLE `ekstrakulikuler_fasilitas` (
  `id_ekstrakulikuler` varchar(10) NOT NULL,
  `id_fasilitas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` varchar(10) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `jumlah_fasilitas` int(11) NOT NULL,
  `id_gedung` int(11) NOT NULL,
  `aturan_penggunaan` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `nama_fasilitas`, `jumlah_fasilitas`, `id_gedung`, `aturan_penggunaan`) VALUES
('1', 'sound', 12, 1, 'dikembalikan'),
('2', 'meja', 2, 1, 'dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gedung`
--

CREATE TABLE `gedung` (
  `id_gedung` int(10) NOT NULL,
  `nama_gedung` varchar(50) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `jumlah_lantai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gedung`
--

INSERT INTO `gedung` (`id_gedung`, `nama_gedung`, `jumlah_kamar`, `jumlah_lantai`) VALUES
(1, 'gedung A', 50, 4),
(2, 'gedung B', 50, 4),
(3, 'gedung C', 50, 4),
(4, 'gedung D', 50, 4),
(5, 'gedung E', 50, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kamar`
--

CREATE TABLE `kamar` (
  `no_kamar` varchar(10) NOT NULL,
  `lantai` int(11) NOT NULL,
  `status_kamar` enum('Tersedia','Penuh','Kosong') NOT NULL,
  `id_gedung` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kamar`
--

INSERT INTO `kamar` (`no_kamar`, `lantai`, `status_kamar`, `id_gedung`) VALUES
('001', 1, 'Tersedia', 1),
('002', 1, 'Tersedia', 1),
('003', 1, '', 1),
('004', 1, 'Tersedia', 1),
('005', 1, 'Tersedia', 1),
('006', 1, 'Kosong', 1),
('007', 1, 'Kosong', 1),
('008', 1, 'Tersedia', 1),
('009', 1, 'Kosong', 1),
('010', 1, 'Kosong', 1),
('011', 2, 'Kosong', 1),
('012', 2, 'Kosong', 1),
('013', 2, 'Kosong', 1),
('014', 2, 'Kosong', 1),
('015', 2, 'Kosong', 1),
('016', 2, 'Kosong', 1),
('017', 2, 'Kosong', 1),
('018', 2, 'Kosong', 1),
('019', 2, 'Kosong', 1),
('020', 2, 'Kosong', 1),
('021', 3, 'Kosong', 1),
('022', 3, 'Kosong', 1),
('023', 3, 'Kosong', 1),
('024', 3, 'Kosong', 1),
('025', 3, 'Kosong', 1),
('026', 3, 'Kosong', 1),
('027', 3, 'Kosong', 1),
('028', 3, 'Kosong', 1),
('029', 3, 'Kosong', 1),
('030', 3, 'Kosong', 1),
('031', 4, 'Kosong', 1),
('032', 4, 'Kosong', 1),
('033', 4, 'Kosong', 1),
('034', 4, 'Kosong', 1),
('035', 4, 'Kosong', 1),
('036', 4, 'Kosong', 1),
('037', 4, 'Kosong', 1),
('038', 4, 'Kosong', 1),
('039', 4, 'Kosong', 1),
('040', 4, 'Kosong', 1),
('041', 5, 'Kosong', 1),
('042', 5, 'Kosong', 1),
('043', 5, 'Kosong', 1),
('044', 5, 'Kosong', 1),
('045', 5, 'Kosong', 1),
('046', 5, 'Kosong', 1),
('047', 5, 'Kosong', 1),
('048', 5, 'Kosong', 1),
('049', 5, 'Kosong', 1),
('050', 5, 'Kosong', 1),
('051', 1, 'Kosong', 2),
('052', 1, 'Kosong', 2),
('053', 1, 'Kosong', 2),
('054', 1, 'Kosong', 2),
('055', 1, 'Kosong', 2),
('056', 1, 'Kosong', 2),
('057', 1, 'Kosong', 2),
('058', 1, 'Kosong', 2),
('059', 1, 'Kosong', 2),
('060', 1, 'Kosong', 2),
('061', 2, 'Kosong', 2),
('062', 2, 'Kosong', 2),
('063', 2, 'Kosong', 2),
('064', 2, 'Kosong', 2),
('065', 2, 'Kosong', 2),
('066', 2, 'Kosong', 2),
('067', 2, 'Kosong', 2),
('068', 2, 'Kosong', 2),
('069', 2, 'Kosong', 2),
('070', 2, 'Kosong', 2),
('071', 3, 'Kosong', 2),
('072', 3, 'Kosong', 2),
('073', 3, 'Kosong', 2),
('074', 3, 'Kosong', 2),
('075', 3, 'Kosong', 2),
('076', 3, 'Kosong', 2),
('077', 3, 'Kosong', 2),
('078', 3, 'Kosong', 2),
('079', 3, 'Kosong', 2),
('080', 3, 'Kosong', 2),
('081', 4, 'Kosong', 2),
('082', 4, 'Kosong', 2),
('083', 4, 'Kosong', 2),
('084', 4, 'Kosong', 2),
('085', 4, 'Kosong', 2),
('086', 4, 'Kosong', 2),
('087', 4, 'Kosong', 2),
('088', 4, 'Kosong', 2),
('089', 4, 'Kosong', 2),
('090', 4, 'Kosong', 2),
('091', 5, 'Kosong', 2),
('092', 5, 'Kosong', 2),
('093', 5, 'Kosong', 2),
('094', 5, 'Kosong', 2),
('095', 5, 'Kosong', 2),
('096', 5, 'Kosong', 2),
('097', 5, 'Kosong', 2),
('098', 5, 'Kosong', 2),
('099', 5, 'Kosong', 2),
('100', 5, 'Kosong', 2),
('101', 1, 'Kosong', 3),
('102', 1, 'Kosong', 3),
('103', 1, 'Kosong', 3),
('104', 1, 'Kosong', 3),
('105', 1, 'Kosong', 3),
('106', 1, 'Kosong', 3),
('107', 1, 'Kosong', 3),
('108', 1, 'Kosong', 3),
('109', 1, 'Kosong', 3),
('110', 1, 'Kosong', 3),
('111', 2, 'Kosong', 3),
('112', 2, 'Kosong', 3),
('113', 2, 'Kosong', 3),
('114', 2, 'Kosong', 3),
('115', 2, 'Kosong', 3),
('116', 2, 'Kosong', 3),
('117', 2, 'Kosong', 3),
('118', 2, 'Kosong', 3),
('119', 2, 'Kosong', 3),
('120', 2, 'Kosong', 3),
('121', 3, 'Kosong', 3),
('122', 3, 'Kosong', 3),
('123', 3, 'Kosong', 3),
('124', 3, 'Kosong', 3),
('125', 3, 'Kosong', 3),
('126', 3, 'Kosong', 3),
('127', 3, 'Kosong', 3),
('128', 3, 'Kosong', 3),
('129', 3, 'Kosong', 3),
('130', 3, 'Kosong', 3),
('131', 4, 'Kosong', 3),
('132', 4, 'Kosong', 3),
('133', 4, 'Kosong', 3),
('134', 4, 'Kosong', 3),
('135', 4, 'Kosong', 3),
('136', 4, 'Kosong', 3),
('137', 4, 'Kosong', 3),
('138', 4, 'Kosong', 3),
('139', 4, 'Kosong', 3),
('140', 4, 'Kosong', 3),
('141', 5, 'Kosong', 3),
('142', 5, 'Kosong', 3),
('143', 5, 'Kosong', 3),
('144', 5, 'Kosong', 3),
('145', 5, 'Kosong', 3),
('146', 5, 'Kosong', 3),
('147', 5, 'Kosong', 3),
('148', 5, 'Kosong', 3),
('149', 5, 'Kosong', 3),
('150', 5, 'Kosong', 3),
('151', 1, 'Kosong', 4),
('152', 1, 'Kosong', 4),
('153', 1, 'Kosong', 4),
('154', 1, 'Kosong', 4),
('155', 1, 'Kosong', 4),
('156', 1, 'Kosong', 4),
('157', 1, 'Kosong', 4),
('158', 1, 'Kosong', 4),
('159', 1, 'Kosong', 4),
('160', 1, 'Kosong', 4),
('161', 2, 'Kosong', 4),
('162', 2, 'Kosong', 4),
('163', 2, 'Kosong', 4),
('164', 2, 'Kosong', 4),
('165', 2, 'Kosong', 4),
('166', 2, 'Kosong', 4),
('167', 2, 'Kosong', 4),
('168', 2, 'Kosong', 4),
('169', 2, 'Kosong', 4),
('170', 2, 'Kosong', 4),
('171', 3, 'Kosong', 4),
('172', 3, 'Kosong', 4),
('173', 3, 'Kosong', 4),
('174', 3, 'Kosong', 4),
('175', 3, 'Kosong', 4),
('176', 3, 'Kosong', 4),
('177', 3, 'Kosong', 4),
('178', 3, 'Kosong', 4),
('179', 3, 'Kosong', 4),
('180', 3, 'Kosong', 4),
('181', 4, 'Kosong', 4),
('182', 4, 'Kosong', 4),
('183', 4, 'Kosong', 4),
('184', 4, 'Kosong', 4),
('185', 4, 'Kosong', 4),
('186', 4, 'Kosong', 4),
('187', 4, 'Kosong', 4),
('188', 4, 'Kosong', 4),
('189', 4, 'Kosong', 4),
('190', 4, 'Kosong', 4),
('191', 5, 'Kosong', 4),
('192', 5, 'Kosong', 4),
('193', 5, 'Kosong', 4),
('194', 5, 'Kosong', 4),
('195', 5, 'Kosong', 4),
('196', 5, 'Kosong', 4),
('197', 5, 'Kosong', 4),
('198', 5, 'Kosong', 4),
('199', 5, 'Kosong', 4),
('200', 5, 'Kosong', 4),
('201', 1, 'Kosong', 5),
('202', 1, 'Kosong', 5),
('203', 1, 'Kosong', 5),
('204', 1, 'Kosong', 5),
('205', 1, 'Kosong', 5),
('206', 1, 'Kosong', 5),
('207', 1, 'Kosong', 5),
('208', 1, 'Kosong', 5),
('209', 1, 'Kosong', 5),
('210', 1, 'Kosong', 5),
('211', 2, 'Kosong', 5),
('212', 2, 'Kosong', 5),
('213', 2, 'Kosong', 5),
('214', 2, 'Kosong', 5),
('215', 2, 'Kosong', 5),
('216', 2, 'Kosong', 5),
('217', 2, 'Kosong', 5),
('218', 2, 'Kosong', 5),
('219', 2, 'Kosong', 5),
('220', 2, 'Kosong', 5),
('221', 3, 'Kosong', 5),
('222', 3, 'Kosong', 5),
('223', 3, 'Kosong', 5),
('224', 3, 'Kosong', 5),
('225', 3, 'Kosong', 5),
('226', 3, 'Kosong', 5),
('227', 3, 'Kosong', 5),
('228', 3, 'Kosong', 5),
('229', 3, 'Kosong', 5),
('230', 3, 'Kosong', 5),
('231', 4, 'Kosong', 5),
('232', 4, 'Kosong', 5),
('233', 4, 'Kosong', 5),
('234', 4, 'Kosong', 5),
('235', 4, 'Kosong', 5),
('236', 4, 'Kosong', 5),
('237', 4, 'Kosong', 5),
('238', 4, 'Kosong', 5),
('239', 4, 'Kosong', 5),
('240', 4, 'Kosong', 5),
('241', 5, 'Kosong', 5),
('242', 5, 'Kosong', 5),
('243', 5, 'Kosong', 5),
('244', 5, 'Kosong', 5),
('245', 5, 'Kosong', 5),
('246', 5, 'Kosong', 5),
('247', 5, 'Kosong', 5),
('248', 5, 'Kosong', 5),
('249', 5, 'Kosong', 5),
('250', 5, 'Kosong', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `isi_komentar` varchar(1000) NOT NULL,
  `id_berita` int(11) NOT NULL,
  `nim_warga` varchar(50) NOT NULL,
  `nama_warga` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `isi_komentar`, `id_berita`, `nim_warga`, `nama_warga`, `tanggal`) VALUES
(17, 'Selamat Hari Raya Idul Fitri', 1, '230411100040', 'ALDI', '2024-12-22 19:08:52'),
(21, 'minal aidzin', 1, '230411100112', 'fariel', '2024-12-22 22:58:13'),
(42, 'Selamat HUT RI ke 79', 2, '230411100112', 'fariel', '2024-12-23 00:17:38'),
(43, 'Selamat Hari Pahlawan', 4, '230411100040', 'ALDI', '2024-12-23 00:18:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar_warga`
--

CREATE TABLE `komentar_warga` (
  `nim_warga` varchar(50) NOT NULL,
  `id_komentar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(15) NOT NULL,
  `nim_warga` varchar(50) DEFAULT NULL,
  `nominal` int(12) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `bukti_pembayaran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nim_warga`, `nominal`, `tanggal_pembayaran`, `metode_pembayaran`, `bukti_pembayaran`) VALUES
('', '222', 900000, '2024-12-02', 'BRI', 'bukti_pembayaran/222_1733152830.jpeg'),
('1', '230411100040', 100000, '2024-11-24', 'bank', ''),
('10', '12', 900000, '2024-12-02', 'BCA', ''),
('12', '333', 900000, '2024-12-02', 'BRI', 'bukti_pembayaran/BRI_333_1733153541.png'),
('13', '230411100112', 900000, '2024-12-13', 'pengurus 1', 'bukti_pembayaran/pengurus_1_230411100112_1734877896.jpeg'),
('2', '23000000012', 10000000, '2024-11-24', 'Transfer Bank', ''),
('3', '230411100041', 10000000, '2024-11-24', 'E-Wallet', ''),
('4', '230411100175', 10000000, '2024-11-28', 'Transfer Bank', ''),
('5', '230411100045', 10000000, '2024-11-29', 'E-Wallet', ''),
('6', '123', 10000000, '2024-12-01', 'Transfer Bank', ''),
('7', '23041110000', 10000000, '2024-12-01', 'Kartu Kredit', ''),
('8', '230411100049', 10000000, '2024-12-02', 'Transfer Bank', ''),
('9', '23', 900000, '2024-12-02', 'Kartu Kredit', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `nim_pendaftaran` varchar(50) NOT NULL,
  `nama_pendaftaran` varchar(100) NOT NULL,
  `password_pendaftaran` varchar(250) NOT NULL,
  `jurusan_pendaftaran` varchar(50) NOT NULL,
  `alamat_pendaftaran` text NOT NULL,
  `jenis_kelamin_pendaftaran` enum('Laki-laki','Perempuan','','') NOT NULL,
  `nomor_handphone_pendaftaran` varchar(13) NOT NULL,
  `no_kamar` varchar(10) NOT NULL,
  `nim_pengurus_pendaftaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`nim_pendaftaran`, `nama_pendaftaran`, `password_pendaftaran`, `jurusan_pendaftaran`, `alamat_pendaftaran`, `jenis_kelamin_pendaftaran`, `nomor_handphone_pendaftaran`, `no_kamar`, `nim_pengurus_pendaftaran`) VALUES
('123', 'udin', '202cb962ac59075b964b07152d234b70', 'S1 Psikologi', 'kamal', 'Laki-laki', '0881036126290', '', ''),
('230411100049', 'M ALDI RAHMANDIKA', '202cb962ac59075b964b07152d234b70', 'S1 Teknik Informatika', 'telang', 'Laki-laki', '0881036126290', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `nim_pengurus` varchar(50) NOT NULL,
  `password_pengurus` varchar(250) NOT NULL,
  `nama_pengurus` varchar(100) NOT NULL,
  `jurusan_pengurus` varchar(50) DEFAULT NULL,
  `nomor_handphone_pengurus` varchar(13) NOT NULL,
  `jenis_kelamin_pengurus` enum('L','P') NOT NULL,
  `alamat_pengurus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`nim_pengurus`, `password_pengurus`, `nama_pengurus`, `jurusan_pengurus`, `nomor_handphone_pengurus`, `jenis_kelamin_pengurus`, `alamat_pengurus`) VALUES
('230000000', '202cb962ac59075b964b07152d234b70', 'pengurus 1', 'opsional', '1', 'L', 'surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warga_asrama`
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
-- Dumping data untuk tabel `warga_asrama`
--

INSERT INTO `warga_asrama` (`nim_warga`, `nama_warga`, `jurusan_warga`, `alamat_warga`, `password_warga`, `jenis_kelamin_warga`, `nomor_handphone_warga`, `no_kamar`, `nim_pengurus`) VALUES
('01', 'aldi', 'S1 Teknik Informatika', 'telang', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0832193076651', '003', '230000000'),
('111', 'aldi', 'S1 Teknik Mesin', 'a', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '005', '230000000'),
('12', 'M ALDI RAHMANDIKA', 'S1 Psikologi', 'v', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '005', '230000000'),
('123', 'ppp', 'S1 Ilmu Hukum', 'blitar', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0832193076651', '008', '230000000'),
('222', 'udin', 'S1 Teknik Industri', 'kamal', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '001', '230000000'),
('23', 'fathan', 'S1 Teknik Informatika', 'telang', 'c20ad4d76fe97759aa27a0c99bff6710', 'Laki-laki', '0812', '002', '230000000'),
('23000000012', 'fathan', 'S1 Teknik Informatika', 'lumajang', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0832193076651', '004', '230000000'),
('23041110000', 'aldi', 'S1 Ilmu Komunikasi', 'blitar', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0832193076651', '003', '230000000'),
('230411100040', 'ALDI', 'S1 Teknik Informatika', 'telang', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '002', '230000000'),
('230411100041', 'rohman', 'S1 Sastra Inggris', 'surabaya', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '002', '230000000'),
('230411100042', 'RAFI ARIFUDIN', 'S1 Psikologi', 'blitar', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '002', '230000000'),
('230411100045', 'info', 'S1 Sosiologi', 'blitar', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '002', '230000000'),
('230411100049', 'M ALDI RAHMANDIKAa', 'S1 Teknik Mekatronika', 'blitar', '123', 'Laki-laki', '0832193076651', '003', '230000000'),
('230411100112', 'fariel', 'S1 Teknik Informatika', 'sidoarjo', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '08819798395', '003', '230000000'),
('230411100175', 'dio', 'S1 Teknik Informatika', 'sumenep', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '08978767677', '004', '230000000'),
('333', 'info', 'S1 Teknik Mekatronika', 'blitar', '202cb962ac59075b964b07152d234b70', 'Laki-laki', '0881036126290', '003', '230000000');

--
-- Trigger `warga_asrama`
--
DELIMITER $$
CREATE TRIGGER `update_status_kamar_insert` AFTER INSERT ON `warga_asrama` FOR EACH ROW BEGIN
    DECLARE jumlah INT;
    
    -- Hitung jumlah penghuni kamar
    SELECT COUNT(*) INTO jumlah FROM warga_asrama WHERE no_kamar = NEW.no_kamar;

    -- Update status kamar berdasarkan jumlah penghuni
    IF jumlah = 0 THEN
        UPDATE kamar SET status_kamar = 'Kosong' WHERE no_kamar = NEW.no_kamar;
    ELSEIF jumlah > 0 AND jumlah < 6 THEN
        UPDATE kamar SET status_kamar = 'Tersedia' WHERE no_kamar = NEW.no_kamar;
    ELSE
        UPDATE kamar SET status_kamar = 'Penuh' WHERE no_kamar = NEW.no_kamar;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_status_kamar_update` AFTER UPDATE ON `warga_asrama` FOR EACH ROW BEGIN
     DECLARE jumlah_lama INT;
    DECLARE jumlah_baru INT;

    -- Jika no_kamar berubah, perbarui status untuk kamar lama dan baru
    IF NEW.no_kamar != OLD.no_kamar THEN
        -- Hitung jumlah penghuni di kamar lama
        SELECT COUNT(*) INTO jumlah_lama FROM warga_asrama WHERE no_kamar = OLD.no_kamar;
        IF jumlah_lama = 0 THEN
            UPDATE kamar SET status_kamar = 'Kosong' WHERE no_kamar = OLD.no_kamar;
        ELSEIF jumlah_lama > 0 AND jumlah_lama < 6 THEN
            UPDATE kamar SET status_kamar = 'Tersedia' WHERE no_kamar = OLD.no_kamar;
        ELSE
            UPDATE kamar SET status_kamar = 'Penuh' WHERE no_kamar = OLD.no_kamar;
        END IF;

        -- Hitung jumlah penghuni di kamar baru
        SELECT COUNT(*) INTO jumlah_baru FROM warga_asrama WHERE no_kamar = NEW.no_kamar;
        IF jumlah_baru = 0 THEN
            UPDATE kamar SET status_kamar = 'Kosong' WHERE no_kamar = NEW.no_kamar;
        ELSEIF jumlah_baru > 0 AND jumlah_baru < 6 THEN
            UPDATE kamar SET status_kamar = 'Tersedia' WHERE no_kamar = NEW.no_kamar;
        ELSE
            UPDATE kamar SET status_kamar = 'Penuh' WHERE no_kamar = NEW.no_kamar;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `warga_ekstrakulikuler`
--

CREATE TABLE `warga_ekstrakulikuler` (
  `nim_warga` varchar(50) NOT NULL,
  `id_ekstrakulikuler` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `warga_ekstrakulikuler`
--

INSERT INTO `warga_ekstrakulikuler` (`nim_warga`, `id_ekstrakulikuler`) VALUES
('230411100040', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `dosen_pengajar`
--
ALTER TABLE `dosen_pengajar`
  ADD PRIMARY KEY (`NIP`);

--
-- Indeks untuk tabel `ekstrakulikuler`
--
ALTER TABLE `ekstrakulikuler`
  ADD PRIMARY KEY (`id_ekstrakulikuler`),
  ADD KEY `dosen_NIP` (`dosen_NIP`);

--
-- Indeks untuk tabel `ekstrakulikuler_fasilitas`
--
ALTER TABLE `ekstrakulikuler_fasilitas`
  ADD PRIMARY KEY (`id_ekstrakulikuler`,`id_fasilitas`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indeks untuk tabel `gedung`
--
ALTER TABLE `gedung`
  ADD PRIMARY KEY (`id_gedung`);

--
-- Indeks untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`no_kamar`),
  ADD KEY `id_gedung` (`id_gedung`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_berita` (`id_berita`),
  ADD KEY `nim_warga` (`nim_warga`);

--
-- Indeks untuk tabel `komentar_warga`
--
ALTER TABLE `komentar_warga`
  ADD PRIMARY KEY (`nim_warga`,`id_komentar`),
  ADD KEY `id_komentar` (`id_komentar`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nim_warga` (`nim_warga`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`nim_pendaftaran`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`nim_pengurus`);

--
-- Indeks untuk tabel `warga_asrama`
--
ALTER TABLE `warga_asrama`
  ADD PRIMARY KEY (`nim_warga`),
  ADD KEY `no_kamar` (`no_kamar`),
  ADD KEY `nim_pengurus` (`nim_pengurus`);

--
-- Indeks untuk tabel `warga_ekstrakulikuler`
--
ALTER TABLE `warga_ekstrakulikuler`
  ADD PRIMARY KEY (`nim_warga`,`id_ekstrakulikuler`),
  ADD KEY `id_ekstrakulikuler` (`id_ekstrakulikuler`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `gedung`
--
ALTER TABLE `gedung`
  MODIFY `id_gedung` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ekstrakulikuler`
--
ALTER TABLE `ekstrakulikuler`
  ADD CONSTRAINT `ekstrakulikuler_ibfk_1` FOREIGN KEY (`dosen_NIP`) REFERENCES `dosen_pengajar` (`NIP`);

--
-- Ketidakleluasaan untuk tabel `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`id_gedung`) REFERENCES `gedung` (`id_gedung`);

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_berita`) REFERENCES `berita` (`id_berita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `komentar_warga`
--
ALTER TABLE `komentar_warga`
  ADD CONSTRAINT `komentar_warga_ibfk_1` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_warga_ibfk_2` FOREIGN KEY (`id_komentar`) REFERENCES `komentar` (`id_komentar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`);

--
-- Ketidakleluasaan untuk tabel `warga_asrama`
--
ALTER TABLE `warga_asrama`
  ADD CONSTRAINT `warga_asrama_ibfk_1` FOREIGN KEY (`no_kamar`) REFERENCES `kamar` (`no_kamar`),
  ADD CONSTRAINT `warga_asrama_ibfk_2` FOREIGN KEY (`nim_pengurus`) REFERENCES `pengurus` (`nim_pengurus`);

--
-- Ketidakleluasaan untuk tabel `warga_ekstrakulikuler`
--
ALTER TABLE `warga_ekstrakulikuler`
  ADD CONSTRAINT `warga_ekstrakulikuler_ibfk_1` FOREIGN KEY (`nim_warga`) REFERENCES `warga_asrama` (`nim_warga`),
  ADD CONSTRAINT `warga_ekstrakulikuler_ibfk_2` FOREIGN KEY (`id_ekstrakulikuler`) REFERENCES `ekstrakulikuler` (`id_ekstrakulikuler`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
