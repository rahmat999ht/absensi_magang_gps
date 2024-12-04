-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2020 at 07:38 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tmp_tgl_lahir` varchar(255) NOT NULL,
  `jenkel` ENUM('Laki-laki', 'Perempuan') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_tel` varchar(18) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mahasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_mahasiswa
INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `username`, `password`, `nama`, `tmp_tgl_lahir`, `jenkel`, `agama`, `alamat`, `no_tel`, `foto`) VALUES
(220001, 'Abdul', MD5('Abdul'), 'Abdul Muhlisin Sudirman', 'Klaten / 19-09-1994', 'Laki-laki', 'Islam', 'China', '0895635721923', '21092020072509employee1.png'),
(220002, 'sarah', MD5('sarah'), 'Sarah Mutia', 'Cianjur / 10-12-1992', 'Perempuan', 'Islam', '', '08128384848', '10092020025112employee3.png'),
(220003, 'bagas', MD5('bagas'), 'Bagas A', 'Jakarta / 10-01-1990', 'Laki-laki', 'Islam', 'Jakarta', '0895628383333', '10092020024120employee3.png'),
(220004, 'user', MD5('user'), 'Budi Sanjaya', 'Bekasi / 10-12-1980', 'Laki-laki', 'Kristen', '', '0895254859994', '10092020023942employee1.png'),
(220005, 'andi', MD5('andi'), 'Andi Wijaya', 'Surabaya / 15-03-1995', 'Laki-laki', 'Islam', 'Surabaya', '08123456789', '15032020employee2.png'),
(220006, 'dewi', MD5('dewi'), 'Dewi Indah', 'Bandung / 22-07-1993', 'Perempuan', 'Islam', 'Bandung', '08987654321', '22072020employee4.png'),
(220007, 'rudi', MD5('rudi'), 'Rudi Hartono', 'Jakarta / 10-11-1991', 'Laki-laki', 'Kristen', 'Jakarta', '0812345678', '10112020employee1.png'),
(220008, 'maya', MD5('maya'), 'Maya Sari', 'Yogyakarta / 05-05-1996', 'Perempuan', 'Islam', 'Yogyakarta', '08567890123', '05052020employee3.png');


-- --------------------------------------------------------
-- Table structure for table `tb_kelompok`
--
CREATE TABLE `tb_kelompok` (
  `id_kelompok` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) NOT NULL,
  `nama_kantor` varchar(255) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lon` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kelompok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data untuk tabel `tb_kelompok`
INSERT INTO `tb_kelompok` (`id_kelompok`, `nama_kelompok`, `nama_kantor`, `lat`, `lon`) VALUES
(1, 'Kelompok A', 'Undipa Makassar', '-5.14019102382134', '119.48309162523255'),
(2, 'Kelompok B', 'Cabang Gowa', '-5.140270', '119.483110'); 

-- --------------------------------------------------------
-- Table structure for table `tb_mahasiswa_kelompok`
--
CREATE TABLE `tb_mahasiswa_kelompok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX (`id_mahasiswa`),
  INDEX (`id_kelompok`),
  CONSTRAINT `fk_mahasiswa_kelompok_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`) 
    ON DELETE CASCADE,
  CONSTRAINT `fk_mahasiswa_kelompok_kelompok` FOREIGN KEY (`id_kelompok`) 
    REFERENCES `tb_kelompok` (`id_kelompok`) 
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data untuk tabel `tb_mahasiswa_kelompok`
INSERT INTO `tb_mahasiswa_kelompok` (`id_mahasiswa`, `id_kelompok`) VALUES
-- Kelompok A (4 mahasiswa)
(220001, 1),
(220002, 1),
(220003, 1),
(220004, 1),

-- Kelompok B (4 mahasiswa)
(220005, 2),
(220006, 2),
(220007, 2),
(220008, 2);

-- --------------------------------------------------------
-- Table structure for table `tb_absensi`
--
CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) NOT NULL,
  `tgl_masuk` varchar(255) NOT NULL,
  `tgl_keluar` varchar(255),
  `jam_masuk` varchar(255) NOT NULL,
  `jam_keluar` varchar(255),
  `long` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_id_mahasiswa` (`id_mahasiswa`),  -- Ganti INDEX dengan KEY
  KEY `idx_id_kelompok` (`id_kelompok`),  -- Ganti INDEX dengan KEY
  CONSTRAINT `fk_tb_absensi_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_tb_absensi_kelompok` FOREIGN KEY (`id_kelompok`) 
    REFERENCES `tb_kelompok` (`id_kelompok`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Insert data ke tb_absensi
INSERT INTO `tb_absensi` (`nama_kelompok`, `tgl_masuk`, `tgl_keluar`, `jam_masuk`, `jam_keluar`, `long`, `lat`, `id_mahasiswa`, `id_kelompok`) VALUES
('Kelompok A', '2024-12-01', '2024-12-01', '08:00:00', '17:00:00', '-5.140265', '119.483102', 220001, 1),
('Kelompok A', '2024-12-01', '2024-12-01', '08:15:00', '17:15:00', '-5.140266', '119.483103', 220002, 1),
('Kelompok A', '2024-12-01', '2024-12-01', '08:30:00', '17:30:00', '-5.140267', '119.483104', 220003, 1),
('Kelompok A', '2024-12-01', '2024-12-01', '08:45:00', '17:45:00', '-5.140268', '119.483105', 220004, 1),
('Kelompok A', '2024-12-02', '2024-12-02', '08:00:00', '17:00:00', '-5.140265', '119.483102', 220001, 1),
('Kelompok A', '2024-12-02', '2024-12-02', '08:15:00', '17:15:00', '-5.140266', '119.483103', 220002, 1),
('Kelompok A', '2024-12-02', '2024-12-02', '08:30:00', '17:30:00', '-5.140267', '119.483104', 220003, 1),
('Kelompok A', '2024-12-02', '2024-12-02', '08:45:00', '17:45:00', '-5.140268', '119.483105', 220004, 1),
('Kelompok B', '2024-12-01', '2024-12-01', '08:00:00', '17:00:00', '-5.140265', '119.483102', 220005, 2),
('Kelompok B', '2024-12-01', '2024-12-01', '08:15:00', '17:15:00', '-5.140266', '119.483103', 220006, 2),
('Kelompok B', '2024-12-01', '2024-12-01', '08:30:00', '17:30:00', '-5.140267', '119.483104', 220007, 2),
('Kelompok B', '2024-12-01', '2024-12-01', '08:45:00', '17:45:00', '-5.140268', '119.483105', 220008, 2),
('Kelompok B', '2024-12-02', '2024-12-02', '08:00:00', '17:00:00', '-5.140265', '119.483102', 220005, 2),
('Kelompok B', '2024-12-02', '2024-12-02', '08:15:00', '17:15:00', '-5.140266', '119.483103', 220006, 2),
('Kelompok B', '2024-12-02', '2024-12-02', '08:30:00', '17:30:00', '-5.140267', '119.483104', 220007, 2),
('Kelompok B', '2024-12-02', '2024-12-02', '08:45:00', '17:45:00', '-5.140268', '119.483105', 220008, 2),
('Kelompok A', '2024-12-03', '2024-12-03', '08:00:00', '17:00:00', '-5.140265', '119.483102', 220001, 1),
('Kelompok A', '2024-12-03', '2024-12-03', '08:15:00', '17:15:00', '-5.140266', '119.483103', 220002, 1),
('Kelompok A', '2024-12-03', '2024-12-03', '08:30:00', '17:30:00', '-5.140267', '119.483104', 220003, 1),
('Kelompok A', '2024-12-03', '2024-12-03', '08:45:00', '17:45:00', '-5.140268', '119.483105', 220004, 1);

-- --------------------------------------------------------
-- Table structure for table `tb_izin`
--
CREATE TABLE `tb_izin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `keterangan` ENUM('Sakit', 'Izin', 'Keperluan keluarga') NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL, -- Menambahkan field id_kelompok
  PRIMARY KEY (`id`),
  INDEX (`id_mahasiswa`),
  INDEX (`id_kelompok`), -- Index untuk id_kelompok
  CONSTRAINT `fk_tb_izin_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`)
    ON DELETE CASCADE,
  CONSTRAINT `fk_tb_izin_kelompok` FOREIGN KEY (`id_kelompok`) 
    REFERENCES `tb_kelompok` (`id_kelompok`) -- Foreign key untuk id_kelompok
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_izin
INSERT INTO `tb_izin` (`id`, `id_mahasiswa`, `id_kelompok`, `nama`, `keterangan`, `alasan`, `waktu`) VALUES
(16, 220004, 1, 'Budi Sanjaya', 'Sakit', 'Saya Sakit Pak', '2020-09-10 07:52:25'),
(17, 220002, 1, 'Sarah Mutia', 'Izin', 'Saya harus pergi', '2020-09-10 07:54:45'),
(18, 220001, 1, 'Abdul Muhlisin Sudirman', 'Izin', 'Keperluan keluarga', '2020-09-20 13:31:05'),
-- Tambahan data izin untuk mahasiswa baru
(19, 220005, 2, 'Andi Wijaya', 'Izin', 'Keperluan Pribadi', '2020-09-22 09:00:00'),
(20, 220006, 2, 'Dewi Indah', 'Sakit', 'Demam', '2020-09-23 08:30:00'),
(21, 220007, 2, 'Rudi Hartono', 'Keperluan keluarga', 'Keluarga Ada Acara', '2020-09-24 10:00:00'),
(22, 220008, 2, 'Maya Sari', 'Izin', 'Konsultasi Dokter', '2020-09-25 11:00:00');

-- --------------------------------------------------------
-- Table structure for table `tb_pembimbing`
--
CREATE TABLE `tb_pembimbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_pembimbing
INSERT INTO `tb_pembimbing` (`id`, `username`, `password`) VALUES
(2, 'pembimbing', 'pembimbing'),
(5, 'pembimbing2', 'pembimbing2');

CREATE TABLE `tb_kelompok_pembimbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kelompok` int(11) NOT NULL,
  `id_pembimbing` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX (`id_kelompok`),
  INDEX (`id_pembimbing`),
  CONSTRAINT `fk_kelompok_pembimbing_kelompok` FOREIGN KEY (`id_kelompok`) 
    REFERENCES `tb_kelompok` (`id_kelompok`) 
    ON DELETE CASCADE,
  CONSTRAINT `fk_kelompok_pembimbing_pembimbing` FOREIGN KEY (`id_pembimbing`) 
    REFERENCES `tb_pembimbing` (`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Kelompok A dengan pembimbing 1
INSERT INTO `tb_kelompok_pembimbing` (`id_kelompok`, `id_pembimbing`) VALUES
(1, 2);

-- Kelompok B dengan pembimbing 2
INSERT INTO `tb_kelompok_pembimbing` (`id_kelompok`, `id_pembimbing`) VALUES
(2, 5);


-- --------------------------------------------------------
-- Table structure for table `tb_dokumentasi`
--
CREATE TABLE `tb_dokumentasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `asal_kampus` varchar(255) NOT NULL,
  `bidang_penempatan` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX (`id_mahasiswa`),
  CONSTRAINT `fk_tb_dokumentasi_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_dokumentasi
INSERT INTO `tb_dokumentasi` (`id`, `id_mahasiswa`, `nama`, `asal_kampus`, `bidang_penempatan`, `nama_kegiatan`, `waktu`) VALUES
(51, 220001, 'Abdul Muhlisin Sudirman', 'STMIK Indonesia', 'IT Programmer', 'Buat Aplikasi', '2020-09-20'),
-- Tambahan data dokumentasi untuk mahasiswa baru
(52, 220005, 'Andi Wijaya', 'Universitas Surabaya', 'Network Administrator', 'Konfigurasi Jaringan', '2020-09-22'),
(53, 220006, 'Dewi Indah', 'Institut Teknologi Bandung', 'Data Analyst', 'Analisis Data Proyek', '2020-09-23'),
(54, 220007, 'Rudi Hartono', 'Universitas Indonesia', 'Software Developer', 'Pengembangan Aplikasi Mobile', '2020-09-24'),
(55, 220008, 'Maya Sari', 'Universitas Gadjah Mada', 'UI/UX Designer', 'Desain Antarmuka Aplikasi', '2020-09-25'),
(56, 220001, 'Aulia Rahman', 'Universitas Hasanuddin', 'Cyber Security', 'Monitoring Keamanan Jaringan', '2020-09-26'),
(57, 220002, 'Fikri Hidayat', 'Universitas Negeri Malang', 'IT Support', 'Instalasi Perangkat Lunak', '2020-09-27'),
(58, 220003, 'Lina Marliani', 'Universitas Padjajaran', 'Database Administrator', 'Optimasi Database', '2020-09-28'),
(59, 220004, 'Bayu Nugroho', 'Universitas Diponegoro', 'Software Tester', 'Pengujian Perangkat Lunak', '2020-09-29'),
(60, 220005, 'Rina Sari', 'Universitas Sebelas Maret', 'System Analyst', 'Analisis Kebutuhan Sistem', '2020-09-30'),
(61, 220006, 'Indah Pratiwi', 'Universitas Brawijaya', 'Web Developer', 'Pengembangan Website E-Commerce', '2020-10-01'),
(62, 220007, 'Budi Rahardjo', 'Universitas Sumatera Utara', 'DevOps Engineer', 'Implementasi CI/CD', '2020-10-02'),
(63, 220008, 'Siti Nurhaliza', 'Universitas Andalas', 'Product Manager', 'Perencanaan Produk Digital', '2020-10-03'),
(64, 220001, 'Zainudin Ali', 'Universitas Udayana', 'Game Developer', 'Pengembangan Game Edukasi', '2020-10-04'),
(65, 220002, 'Mega Dwi', 'Universitas Airlangga', 'Mobile Developer', 'Aplikasi Mobile E-Commerce', '2020-10-05'),
(66, 220003, 'Ratna Dewi', 'Universitas Muhammadiyah Yogyakarta', 'Data Scientist', 'Analisis Data Penjualan', '2020-10-06'),
(67, 220004, 'Rizky Pratama', 'Institut Pertanian Bogor', 'Cloud Engineer', 'Migrasi Data ke Cloud', '2020-10-07'),
(68, 220005, 'Rian Setiawan', 'Universitas Jenderal Soedirman', 'Technical Writer', 'Pembuatan Dokumentasi Teknis', '2020-10-08'),
(69, 220006, 'Dewi Safitri', 'Universitas Trisakti', 'Network Engineer', 'Peningkatan Infrastruktur Jaringan', '2020-10-09'),
(70, 220007, 'Andika Arsyad', 'Universitas Syiah Kuala', 'Blockchain Developer', 'Pengembangan Aplikasi Blockchain', '2020-10-10'),
(71, 220008, 'Agus Prayogo', 'Universitas Sam Ratulangi', 'Full Stack Developer', 'Proyek Aplikasi Web', '2020-10-11'),
(72, 220001, 'Sari Rahmadani', 'Universitas Negeri Jakarta', 'Quality Assurance', 'Pengujian Sistem CRM', '2020-10-12'),
(73, 220002, 'Dedi Saputra', 'Universitas Pendidikan Indonesia', 'Digital Marketing', 'Strategi Pemasaran Online', '2020-10-13'),
(74, 220003, 'Anita Puspita', 'Universitas Mercu Buana', 'Business Analyst', 'Analisis Model Bisnis', '2020-10-14'),
(75, 220004, 'Rio Pratama', 'Universitas Kristen Satya Wacana', 'IoT Developer', 'Integrasi IoT pada Rumah Pintar', '2020-10-15');



-- Commit transaksi
COMMIT;