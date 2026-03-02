-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2025 at 03:21 PM
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
-- Database: `reusemart_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat_pembeli`
--

CREATE TABLE `alamat_pembeli` (
  `id_alamat_pembeli` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `jalan` varchar(255) NOT NULL,
  `kelurahan` varchar(255) NOT NULL,
  `kecamatan` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kode_pos` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alamat_pembeli`
--

INSERT INTO `alamat_pembeli` (`id_alamat_pembeli`, `id_pembeli`, `jalan`, `kelurahan`, `kecamatan`, `kota`, `provinsi`, `kode_pos`, `detail`) VALUES
(1, 11, 'Jl. Mawar No. 10', 'Caturtunggal', 'Depok', 'Sleman', 'DI Yogyakarta', '55281', 'Rumah pribadi, gerbang hijau'),
(2, 11, 'Jl. Anggrek No. 2', 'Seturan', 'Depok', 'Sleman', 'DI Yogyakarta', '55281', 'Alamat kantor, dekat warung Padang'),
(3, 12, 'Jl. Kenanga No. 5', 'Condongcatur', 'Depok', 'Sleman', 'DI Yogyakarta', '55283', 'Kos mahasiswa, lantai 2'),
(4, 13, 'Jl. Melati No. 12', 'Sinduadi', 'Mlati', 'Sleman', 'DI Yogyakarta', '55284', 'Dekat warung Bu Tini'),
(5, 13, 'Jl. Pandanaran No. 17', 'Sariharjo', 'Ngaglik', 'Sleman', 'DI Yogyakarta', '55581', 'Rumah orang tua'),
(6, 13, 'Jl. Nangka No. 4', 'Sendangadi', 'Mlati', 'Sleman', 'DI Yogyakarta', '55285', 'Alamat kantor'),
(7, 14, 'Jl. Flamboyan No. 23', 'Maguwoharjo', 'Depok', 'Sleman', 'DI Yogyakarta', '55282', 'Rumah sudut, pagar putih'),
(8, 15, 'Jl. Anggrek No. 3', 'Banguntapan', 'Banguntapan', 'Bantul', 'DI Yogyakarta', '55198', 'Samping masjid Nurul Huda'),
(9, 16, 'Jl. Dahlia No. 8', 'Wirobrajan', 'Wirobrajan', 'Yogyakarta', 'DI Yogyakarta', '55252', 'Ruko lantai 1'),
(10, 16, 'Jl. Kusuma No. 88', 'Tegalrejo', 'Tegalrejo', 'Yogyakarta', 'DI Yogyakarta', '55244', 'Alamat tempat usaha'),
(11, 17, 'Jl. Cempaka No. 15', 'Tamanan', 'Banguntapan', 'Bantul', 'DI Yogyakarta', '55191', 'Belakang alfamart'),
(12, 18, 'Jl. Teratai No. 7', 'Kalitirto', 'Berbah', 'Sleman', 'DI Yogyakarta', '55573', 'Rumah keluarga besar'),
(13, 19, 'Jl. Angsana No. 9', 'Wedomartani', 'Ngemplak', 'Sleman', 'DI Yogyakarta', '55584', 'Sebelah minimarket'),
(14, 20, 'Jl. Kamboja No. 14', 'Rejowinangun', 'Kotagede', 'Yogyakarta', 'DI Yogyakarta', '55171', 'Dekat taman kota');

-- --------------------------------------------------------

--
-- Table structure for table `badge`
--

CREATE TABLE `badge` (
  `id_badge` int(11) NOT NULL,
  `id_penitip` int(11) NOT NULL,
  `nama_badge` varchar(255) NOT NULL,
  `periode_pemberian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `badge`
--

INSERT INTO `badge` (`id_badge`, `id_penitip`, `nama_badge`, `periode_pemberian`) VALUES
(2, 1, 'Top Seller', '2025-04-01'),
(3, 2, 'Top Seller', '2025-05-01'),
(4, 3, 'Top Seller', '2025-06-01'),
(5, 4, 'Top Seller', '2025-07-01'),
(6, 5, 'Top Seller', '2025-08-01'),
(7, 6, 'Top Seller', '2025-09-01'),
(8, 7, 'Top Seller', '2025-10-01'),
(9, 8, 'Top Seller', '2025-11-01'),
(10, 9, 'Top Seller', '2025-12-01'),
(11, 10, 'Top Seller', '2026-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `barang_titipan`
--

CREATE TABLE `barang_titipan` (
  `id_barang` int(11) NOT NULL,
  `id_penitip` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_qc_pegawai` int(11) NOT NULL,
  `id_hunter` int(11) DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `tanggal_masuk` datetime NOT NULL,
  `tanggal_akhir` datetime NOT NULL,
  `tanggal_keluar` datetime DEFAULT NULL,
  `status_perpanjangan` tinyint(1) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_jual` float NOT NULL,
  `deskripsi` text NOT NULL,
  `status_barang` varchar(255) NOT NULL,
  `garansi` tinyint(1) NOT NULL,
  `tanggal_garansi` date DEFAULT NULL,
  `barang_hunter` tinyint(1) NOT NULL,
  `berat` float NOT NULL,
  `id_nota` int(11) DEFAULT NULL,
  `notifikasi_h3_terkirim` tinyint(1) NOT NULL DEFAULT 0,
  `notifikasi_hari_h_terkirim` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_titipan`
--

INSERT INTO `barang_titipan` (`id_barang`, `id_penitip`, `id_pegawai`, `id_qc_pegawai`, `id_hunter`, `id_kategori`, `tanggal_masuk`, `tanggal_akhir`, `tanggal_keluar`, `status_perpanjangan`, `nama_barang`, `harga_jual`, `deskripsi`, `status_barang`, `garansi`, `tanggal_garansi`, `barang_hunter`, `berat`, `id_nota`, `notifikasi_h3_terkirim`, `notifikasi_hari_h_terkirim`) VALUES
(21, 1, 6, 12, NULL, 3, '2025-03-01 10:00:00', '2025-03-31 10:00:00', '2025-03-31 10:00:00', 0, 'Rak Buku Jati', 300000, 'Rak kayu tinggi 180cm, masih kuat', 'Didonasikan', 0, NULL, 0, 12, 92, 0, 0),
(22, 2, 6, 7, NULL, 4, '2025-03-05 12:30:00', '2025-04-04 12:30:00', NULL, 1, 'Kalkulator Scientific', 80000, 'Masih berfungsi normal, Casio FX-991ES', 'barang untuk donasi', 0, NULL, 0, 0.2, 96, 0, 0),
(23, 3, 6, 7, NULL, 1, '2025-03-10 09:00:00', '2025-04-09 09:00:00', '2025-03-15 18:01:31', 0, 'Bluetooth Speaker JBL', 450000, 'Suara jernih, baterai awet', 'Terjual', 1, '2025-08-01', 0, 0.6, 103, 0, 0),
(24, 4, 7, 6, NULL, 2, '2025-03-12 15:00:00', '2025-05-11 15:00:00', NULL, 1, 'Jaket Kulit Hitam', 350000, 'Masih bagus, ukuran L', 'barang untuk donasi', 0, NULL, 0, 1, 109, 0, 0),
(25, 5, 6, 12, NULL, 5, '2025-02-20 14:00:00', '2025-03-22 14:00:00', '2025-04-05 14:00:00', 1, 'Skateboard Anak', 250000, 'Kondisi layak, hanya baret sedikit', 'Didonasikan', 0, NULL, 0, 3, 115, 0, 0),
(26, 6, 7, 12, 8, 1, '2025-02-25 09:30:00', '2025-03-27 09:30:00', '2025-03-24 18:02:48', 1, 'Kamera Canon EOS M3', 2800000, 'Dengan lensa kit, charger ori', 'Terjual', 1, '2025-07-01', 1, 1.2, 122, 0, 0),
(27, 7, 6, 7, 8, 6, '2025-03-28 10:00:00', '2025-04-27 10:00:00', NULL, 0, 'Baby Stroller Pliko', 700000, 'Bisa rebahan, warna merah', 'barang untuk donasi', 0, NULL, 1, 8.5, 130, 0, 0),
(28, 8, 7, 12, 14, 1, '2025-04-01 08:00:00', '2025-05-01 08:00:00', '2025-04-04 18:03:47', 0, 'Headset Logitech G331', 600000, 'Kondisi mulus, mic normal', 'Terjual', 1, '2025-10-01', 1, 0.25, 137, 0, 0),
(29, 9, 6, 7, NULL, 8, '2025-04-02 14:00:00', '2025-05-02 14:00:00', NULL, 0, 'Tenda Camping 2 Orang', 450000, 'Anti air, baru 1x pakai', 'barang untuk donasi', 0, NULL, 0, 5, 142, 0, 0),
(30, 10, 7, 12, 8, 2, '2025-03-15 13:00:00', '2025-04-14 13:00:00', '2025-04-14 13:00:00', 0, 'Sepatu Boots Pria', 320000, 'Kulit sintetis, ukuran 43', 'Didonasikan', 0, NULL, 1, 0.9, 147, 0, 0),
(31, 2, 12, 6, NULL, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2025-03-15 09:00:00', 0, 'Jaket Olahraga Bekas', 150000, 'Masih layak pakai, ukuran L', 'Didonasikan', 0, NULL, 0, 0.9, NULL, 0, 0),
(32, 5, 6, 12, NULL, 6, '2025-01-18 08:30:00', '2025-02-17 08:30:00', '2025-02-20 13:30:00', 0, 'Stroller Bekas', 300000, 'Stroller roda 4, kondisi bekas tapi kokoh', 'Didonasikan', 0, NULL, 0, 7.5, 114, 0, 0),
(33, 3, 6, 7, NULL, 10, '2025-01-25 14:00:00', '2025-02-24 14:00:00', '2025-02-28 15:00:00', 0, 'Paket Kosmetik', 200000, 'Kosmetik wanita lengkap, belum kedaluwarsa', 'Didonasikan', 0, NULL, 0, 1.2, 101, 0, 0),
(34, 6, 12, 7, NULL, 3, '2025-01-10 09:00:00', '2025-02-09 09:00:00', '2025-02-25 10:00:00', 0, 'Setrika Listrik', 175000, 'Masih berfungsi, kabel agak lusuh', 'Didonasikan', 0, NULL, 0, 1.5, 121, 0, 0),
(35, 8, 7, 6, NULL, 5, '2025-01-05 11:45:00', '2025-02-04 11:45:00', '2025-02-10 11:00:00', 0, 'Boneka Anak', 80000, 'Boneka teddy bear, masih bersih', 'Didonasikan', 0, NULL, 0, 0.6, 135, 0, 0),
(36, 4, 7, 6, NULL, 4, '2025-01-15 13:00:00', '2025-02-14 13:00:00', '2025-02-20 16:30:00', 0, 'Buku Pelajaran SMP', 50000, 'Buku Matematika dan IPA kelas 8', 'Didonasikan', 0, NULL, 0, 1.1, 107, 0, 0),
(37, 7, 7, 12, NULL, 1, '2025-01-12 10:10:00', '2025-02-11 10:10:00', '2025-02-15 09:45:00', 0, 'Speaker Bluetooth Bekas', 225000, 'Masih bisa nyala, suara sedikit pecah', 'Didonasikan', 0, NULL, 0, 0.8, 128, 0, 0),
(38, 2, 6, 12, NULL, 1, '2025-03-18 10:00:00', '2025-05-17 10:00:00', '2025-05-01 18:04:40', 1, 'Tablet Samsung Tab A7', 500000, 'Kondisi sangat baik, layar mulus', 'Terjual', 1, '2025-09-01', 0, 0.45, 97, 0, 0),
(39, 3, 7, 6, 14, 7, '2025-03-22 11:00:00', '2025-04-21 11:00:00', '2025-03-25 18:08:02', 0, 'Sepeda Lipat 16 Inci', 2000000, 'Bekas tapi masih jalan normal', 'Terjual', 0, NULL, 1, 9, 104, 0, 0),
(40, 5, 6, 12, 8, 1, '2025-03-25 14:30:00', '2025-04-24 14:30:00', '2025-04-22 18:08:53', 0, 'Smartwatch Amazfit', 350000, 'Fullset, pemakaian wajar', 'Terjual', 1, '2025-08-30', 1, 0.2, 117, 0, 0),
(41, 6, 6, 7, NULL, 3, '2025-03-27 09:00:00', '2025-04-26 09:00:00', '2025-04-16 18:09:54', 0, 'Blender Philips HR2102', 250000, 'Motor kuat, mata pisau tajam', 'Terjual', 0, NULL, 0, 3.5, 124, 0, 0),
(42, 7, 12, 7, NULL, 4, '2025-03-29 15:30:00', '2025-04-28 15:30:00', '2025-04-19 18:10:29', 0, 'Set Buku Pelajaran SD', 150000, 'Buku lengkap semua mapel kelas 1-6', 'Terjual', 0, NULL, 0, 2, 131, 0, 0),
(43, 1, 6, 12, NULL, 1, '2025-05-04 03:03:00', '2025-06-03 03:03:00', NULL, 0, 'Kamera DSLR Canon EOS 3000D', 5000000, 'Kamera DSLR Canon dengan lensa kit EF-S 18-55mm f/3.5-5.6 III', 'Tersedia', 1, '2025-12-31', 0, 1.5, 93, 0, 0),
(44, 2, 6, 12, NULL, 1, '2025-05-01 06:06:27', '2025-05-31 06:06:27', NULL, 0, 'Laptop Dell Inspiron 14', 7000000, 'Laptop Dell Inspiron dengan prosesor Intel Core i5 dan 8GB RAM', 'Tersedia', 0, NULL, 0, 2, 98, 0, 0),
(45, 3, 7, 6, NULL, 1, '2025-05-02 06:06:27', '2025-06-01 06:06:27', NULL, 0, 'Tablet Samsung Galaxy Tab S6', 4500000, 'Tablet Samsung Galaxy Tab S6, layar 10.5 inci, RAM 6GB', 'Tersedia', 0, NULL, 0, 0.7, 105, 0, 0),
(46, 4, 12, 6, NULL, 4, '2025-05-04 06:06:27', '2025-06-03 06:06:27', NULL, 0, 'Meja Kantor Ergonomis', 1500000, 'Meja kantor ergonomis dengan laci untuk penyimpanan', 'Tersedia', 0, NULL, 0, 15, 110, 0, 0),
(47, 5, 6, 12, NULL, 1, '2025-05-02 06:06:27', '2025-06-01 06:06:27', NULL, 0, 'Printer HP LaserJet Pro', 2200000, 'Printer HP LaserJet Pro dengan kecepatan cetak 22 ppm', 'Tersedia', 1, '2025-09-10', 0, 10, 118, 0, 0),
(48, 6, 6, 7, NULL, 5, '2025-05-03 06:06:27', '2025-06-02 06:06:27', NULL, 0, 'Puzzle 1000 Potong', 150000, 'Puzzle 1000 potong dengan gambar pemandangan alam', 'Tersedia', 0, NULL, 0, 0.5, 125, 0, 0),
(49, 7, 6, 7, NULL, 7, '2025-05-07 06:06:27', '2025-06-06 06:06:27', NULL, 0, 'Skateboard Element', 1200000, 'Skateboard merek Element, ukuran standar dengan desain keren', 'Tersedia', 0, NULL, 0, 2, 132, 0, 0),
(50, 8, 7, 6, NULL, 10, '2025-05-04 06:06:27', '2025-06-03 06:06:27', NULL, 0, 'Lipstick Matte Revlon', 200000, 'Lipstick matte dari Revlon dengan warna natural dan tahan lama', 'Tersedia', 0, NULL, 0, 0.2, 138, 0, 0),
(51, 9, 7, 6, NULL, 9, '2025-05-04 06:06:27', '2025-06-03 06:06:27', NULL, 0, 'Alat Pembuat Kopi', 350000, 'Alat pembuat kopi otomatis dengan fungsi penggilingan biji kopi', 'Tersedia', 0, NULL, 0, 1.5, 143, 0, 0),
(52, 10, 7, 6, NULL, 1, '2025-05-04 06:06:27', '2025-06-03 06:06:27', NULL, 0, 'GoPro HERO 8', 1500000, 'Kamera aksi GoPro HERO 8, dilengkapi dengan aksesori tambahan dan case pelindung', 'Tersedia', 1, '2026-03-15', 0, 0.3, 148, 0, 0),
(73, 1, 6, 7, NULL, 1, '2025-05-01 10:00:00', '2025-05-31 10:00:00', NULL, 0, 'Headphone Sony WH-1000XM3', 850000, 'Noise cancelling, kondisi 90%', 'Tersedia', 1, '2025-08-16', 0, 0.7, 94, 0, 0),
(74, 2, 6, 7, NULL, 1, '2025-05-01 14:30:00', '2025-05-31 14:30:00', NULL, 0, 'Kamera Canon EOS 550D', 1500000, 'Dengan lensa kit, masih bagus', 'Tersedia', 1, '2026-01-08', 0, 1.2, 99, 0, 0),
(75, 3, 12, 6, NULL, 2, '2025-05-02 09:45:00', '2025-06-01 09:45:00', NULL, 0, 'Jaket Kulit Hitam Pria', 250000, 'Ukuran L, masih kinclong', 'Tersedia', 0, NULL, 0, 0.9, 105, 0, 0),
(76, 4, 6, 7, NULL, 2, '2025-05-02 15:15:00', '2025-06-01 15:15:00', NULL, 0, 'Tas Ransel Herschel', 180000, 'Asli, warna navy, muat laptop', 'Tersedia', 0, NULL, 0, 1.2, 111, 0, 0),
(77, 5, 12, 6, NULL, 3, '2025-05-03 08:30:00', '2025-06-02 08:30:00', NULL, 0, 'Meja Belajar Kayu', 300000, 'Ukuran 100x60cm, masih kokoh', 'Tersedia', 0, NULL, 0, 1.9, 119, 0, 0),
(78, 6, 6, 12, NULL, 3, '2025-05-03 17:00:00', '2025-06-02 17:00:00', NULL, 0, 'Lampu Hias Vintage', 95000, 'Lampu klasik cocok dekorasi', 'Tersedia', 0, NULL, 0, 1.3, 126, 0, 0),
(79, 7, 6, 7, NULL, 4, '2025-05-04 13:25:00', '2025-06-03 13:25:00', NULL, 0, 'Komik Naruto Vol. 1', 25000, 'Edisi pertama, koleksi', 'Tersedia', 0, NULL, 0, 0.7, 133, 0, 0),
(80, 8, 6, 7, NULL, 4, '2025-05-04 09:00:00', '2025-06-03 09:00:00', NULL, 0, 'Set Alat Tulis Premium', 45000, 'Isi lengkap, cocok anak sekolah', 'Tersedia', 0, NULL, 0, 0.5, 139, 0, 0),
(81, 9, 6, 7, NULL, 5, '2025-05-05 11:45:00', '2025-06-04 11:45:00', NULL, 0, 'Gitar Akustik Yamaha', 550000, 'Suara jernih, senar baru diganti', 'Tersedia', 0, NULL, 0, 1.4, 144, 0, 0),
(82, 10, 7, 6, NULL, 5, '2025-05-05 18:10:00', '2025-06-04 18:10:00', NULL, 0, 'Figur Iron Man Original', 200000, 'Kondisi mulus, kolektor item', 'Tersedia', 0, NULL, 0, 0.8, 149, 0, 0),
(83, 1, 6, 7, NULL, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 0, 'Stroller Bayi Pliko', 700000, 'Lipatan mudah, roda kuat', 'barang untuk donasi', 0, NULL, 0, 2.6, NULL, 0, 0),
(84, 2, 6, 7, NULL, 6, '2025-05-06 16:45:00', '2025-06-05 16:45:00', NULL, 0, 'Mainan Edukatif Kayu', 65000, 'Melatih motorik anak', 'Tersedia', 0, NULL, 0, 0.3, 100, 0, 0),
(85, 3, 7, 6, NULL, 7, '2025-05-07 08:10:00', '2025-06-06 08:10:00', NULL, 0, 'Helm INK Solid Hitam', 220000, 'Ukuran L, masih kuat', 'Tersedia', 0, NULL, 0, 1.5, 106, 0, 0),
(86, 4, 6, 7, NULL, 7, '2025-05-07 13:35:00', '2025-06-06 13:35:00', NULL, 0, 'Velg Motor Ring 17', 500000, 'Untuk bebek/sport, mulus', 'Tersedia', 0, NULL, 0, 1.9, 112, 0, 0),
(87, 5, 7, 6, NULL, 8, '2025-05-08 11:30:00', '2025-06-07 11:30:00', NULL, 0, 'Set BBQ Portable', 350000, 'Untuk outdoor 4 orang', 'Tersedia', 0, NULL, 0, 5, 120, 0, 0),
(88, 6, 6, 7, NULL, 8, '2025-05-08 17:50:00', '2025-06-07 17:50:00', NULL, 0, 'Tenda Gunung', 450000, 'Anti air, cocok mendaki', 'Tersedia', 0, NULL, 0, 2.4, 127, 0, 0),
(89, 7, 12, 6, NULL, 9, '2025-05-09 14:05:00', '2025-06-08 14:05:00', NULL, 0, 'Kursi Kantor Bekas', 150000, 'Masih empuk dan bisa diatur', 'Tersedia', 0, NULL, 0, 1.8, 134, 0, 0),
(90, 8, 12, 6, NULL, 9, '2025-05-09 09:40:00', '2025-06-08 09:40:00', NULL, 0, 'Rak Arsip Besi', 200000, 'Tingkat 5, warna abu', 'Tersedia', 0, NULL, 0, 0.9, 140, 0, 0),
(91, 9, 7, 6, NULL, 10, '2025-05-10 10:10:00', '2025-06-09 10:10:00', NULL, 0, 'Hair Dryer Philips', 125000, 'Masih berfungsi baik', 'Tersedia', 0, NULL, 0, 0.3, 145, 0, 0),
(92, 10, 12, 6, NULL, 10, '2025-05-10 16:30:00', '2025-06-09 16:30:00', NULL, 0, 'Cermin Rias LED', 95000, 'Ada lampu ring putih', 'Tersedia', 0, NULL, 0, 0.8, 150, 0, 0),
(103, 1, 6, 12, NULL, 1, '2025-03-01 10:00:00', '2025-03-31 10:00:00', NULL, 0, 'TV LED Samsung 32 inch', 1300000, 'Layar masih jernih, ada remote', 'barang untuk donasi', 0, NULL, 0, 6, 92, 0, 0),
(104, 2, 6, 7, NULL, 3, '2025-03-01 11:00:00', '2025-03-31 11:00:00', NULL, 0, 'Meja Belajar Kayu', 350000, 'Kayu solid, ukuran sedang', 'barang untuk donasi', 0, NULL, 0, 8, 95, 0, 0),
(105, 3, 7, 12, 14, 5, '2025-03-02 09:00:00', '2025-04-01 09:00:00', NULL, 0, 'Playstation 2', 500000, 'Lengkap dengan 2 stik', 'barang untuk donasi', 0, NULL, 1, 3.2, 102, 0, 0),
(106, 4, 7, 12, 14, 2, '2025-02-28 14:00:00', '2025-03-30 14:00:00', NULL, 0, 'Sepatu Sekolah Hitam', 120000, 'Ukuran 39, masih bagus', 'barang untuk donasi', 0, NULL, 1, 1.1, 108, 0, 0),
(107, 5, 6, 12, NULL, 3, '2025-03-01 12:00:00', '2025-03-31 12:00:00', NULL, 0, 'Kasur Lipat Anak', 200000, 'Masih empuk dan bersih', 'barang untuk donasi', 0, NULL, 0, 4, 116, 0, 0),
(108, 6, 6, 12, NULL, 10, '2025-03-01 13:30:00', '2025-03-31 13:30:00', NULL, 0, 'Hair Dryer Philips', 250000, 'Masih berfungsi normal', 'barang untuk donasi', 0, NULL, 0, 0.7, 123, 0, 0),
(109, 7, 12, 6, NULL, 9, '2025-03-02 09:00:00', '2025-04-01 09:00:00', '2025-05-13 15:47:00', 0, 'Mesin Cuci Mini', 900000, '2 tabung, kapasitas 5 kg', 'Didonasikan', 0, NULL, 0, 12, 129, 0, 0),
(110, 8, 12, 6, NULL, 1, '2025-03-02 08:45:00', '2025-04-01 08:45:00', NULL, 0, 'Smartphone Xiaomi 5A', 600000, 'Kondisi normal, minus baterai cepat habis', 'barang untuk donasi', 0, NULL, 0, 0.3, 136, 0, 0),
(111, 9, 12, 7, NULL, 9, '2025-02-27 10:00:00', '2025-03-29 10:00:00', NULL, 0, 'Mesin Ketik Manual', 280000, 'Vintage, masih bisa dipakai', 'barang untuk donasi', 0, NULL, 0, 6.5, 141, 0, 0),
(112, 10, 12, 7, NULL, 8, '2025-03-01 09:00:00', '2025-03-31 09:00:00', NULL, 0, 'Tenda Camping Bekas', 450000, 'Kapasitas 4 orang', 'barang untuk donasi', 0, NULL, 0, 5.8, 146, 0, 0),
(113, 4, 6, 12, NULL, 9, '2025-05-24 10:44:00', '2025-06-23 10:44:00', NULL, 0, 'Mesin Fotokopi Canon IR 2525', 5500000, 'Mesin fotokopi Canon iR 2525 dengan fitur print, scan, dan copy. Kecepatan cetak hingga 25 lembar/menit. Cocok untuk usaha fotokopi kecil atau kantor. Sudah termasuk tray dan toner. Kondisi 90%, normal digunakan.', 'Tersedia', 0, NULL, 0, 3, 113, 0, 0),
(115, 6, 6, 7, NULL, 3, '2025-05-30 10:57:55', '2025-06-29 10:57:55', NULL, 0, 'Kompor Gas Modern Hemat Energi', 1250000, 'Kompor gas modern ini dirancang dengan teknologi hemat energi yang memberikan pembakaran optimal dan penggunaan bahan bakar yang efisien. Dilengkapi dengan pengatur api yang mudah digunakan dan bahan berkualitas tinggi, kompor ini memastikan memasak menjadi lebih cepat dan aman. Cocok untuk dapur rumah tangga maupun keperluan memasak profesional.', 'Tersedia', 1, NULL, 0, 1.2, 159, 0, 0),
(116, 8, 6, 12, NULL, 2, '2025-05-30 11:17:00', '2025-06-29 11:17:00', NULL, 0, 'Syal Rajut', 250000, 'Terbuat dari bahan berkualitas tinggi yang nyaman di kulit, syal ini cocok digunakan di musim dingin maupun sebagai aksesori gaya sehari-hari. Tersedia dalam berbagai warna dan motif, cocok untuk pria dan wanita yang ingin tampil modis dan tetap hangat.', 'Tersedia', 0, NULL, 0, 0.1, 160, 0, 0),
(117, 8, 6, 12, NULL, 2, '2025-05-30 12:04:37', '2025-06-29 12:04:37', NULL, 0, 'Topi Fashion Unisex', 500000, 'Topi bergaya kasual ini terbuat dari bahan ringan dan nyaman, cocok untuk berbagai aktivitas, mulai dari jalan-jalan santai hingga acara outdoor. Desain unisex yang simpel namun stylish membuatnya mudah dipadukan dengan berbagai outfit. Dilengkapi dengan tali pengatur di belakang untuk menyesuaikan ukuran kepala', 'Tersedia', 0, NULL, 0, 0.3, 160, 0, 0),
(118, 6, 6, 7, 8, 2, '2025-05-31 07:27:00', '2025-06-30 07:27:00', NULL, 0, 'Jam Tangan Casio', 784000, 'Jam tangan Casio original dengan desain klasik dan bodi ramping, cocok untuk penggunaan sehari-hari maupun acara formal. Dilengkapi fitur seperti kalender otomatis, alarm, stopwatch, dan tahan air. Tali berbahan stainless steel yang nyaman dipakai dan awet. Cocok untuk Anda yang menginginkan jam tangan fungsional dengan tampilan elegan. Kondisi barang: preloved / second, masih sangat baik, semua fitur berfungsi normal.', 'Tersedia', 0, NULL, 1, 0.3, 158, 0, 0),
(119, 6, 6, 7, NULL, 2, '2025-05-30 08:40:00', '2025-06-29 08:40:00', NULL, 0, 'Sweter Rajut Uniqlo', 568000, 'Sweter rajut original dari Uniqlo, terbuat dari bahan katun lembut dan breathable, ideal untuk cuaca dingin atau ruang ber-AC. Model regular fit, cocok untuk pria maupun wanita. Warna netral yang mudah dipadukan dengan berbagai outfit. Kondisi barang: preloved / second, sangat terawat, tanpa noda atau kerusakan.', 'Tersedia', 0, NULL, 0, 0.4, 157, 0, 0),
(120, 5, 6, 7, NULL, 1, '2025-05-31 14:14:00', '2025-06-30 14:14:00', NULL, 0, 'Konsol Game Sony PlayStation 4 Slim', 1250000, 'Konsol PlayStation 4 Slim original dengan kapasitas 500GB, performa mulus dan responsif untuk pengalaman gaming terbaik. Kondisi barang preloved, sangat terawat, lengkap dengan 1 controller dan kabel asli bawaan. Cocok untuk kamu yang ingin bermain game populer seperti FIFA, GTA V, atau God of War tanpa harus beli baru. Semua fungsi berjalan normal.', 'Tersedia', 1, '2026-09-30', 0, 0.7, 161, 0, 0),
(121, 5, 6, 7, 14, 1, '2025-05-31 14:14:00', '2025-06-30 14:14:00', NULL, 0, 'Microwave Sharp 20 Liter', 2250000, 'Microwave Sharp kapasitas 20 liter dengan desain minimalis dan mudah digunakan. Dilengkapi dengan pengaturan waktu dan tingkat panas yang dapat disesuaikan sesuai kebutuhan memasak, memanaskan, atau mencairkan makanan. Konsumsi listrik rendah, cocok untuk penggunaan harian di rumah atau kantor. Kondisi barang: preloved, masih sangat bagus dan berfungsi normal. Interior bersih, tombol responsif, dan pintu tertutup rapat tanpa cacat.', 'Tersedia', 1, '2026-09-22', 1, 2.3, 161, 0, 0),
(122, 5, 6, 7, NULL, 2, '2025-05-31 14:14:00', '2025-06-30 14:14:00', NULL, 0, 'Sweter Rajut Anak', 999000, 'Sweter rajut anak dengan bahan lembut dan hangat, cocok untuk cuaca dingin atau musim hujan. Desain simpel dengan warna netral, mudah dipadukan dengan berbagai outfit. Tersedia dalam ukuran untuk anak usia 2–4 tahun. Model kerah bulat dan lengan panjang, nyaman dipakai untuk aktivitas harian maupun bepergian. Kondisi barang preloved, sangat terawat, tanpa sobekan atau noda.', 'Tersedia', 0, NULL, 0, 0.1, 161, 0, 0),
(123, 9, 6, 7, NULL, 5, '2025-05-31 16:00:00', '2025-06-30 16:00:00', NULL, 0, 'Keyboard Yamaha PSR-F51', 5000000, 'Keyboard Yamaha PSR-F51 adalah keyboard digital 61 tuts yang dirancang khusus untuk pemula. Dilengkapi dengan 120 suara instrumen dan 114 iringan ritme dari berbagai genre, keyboard ini sangat mudah digunakan dengan panel kontrol yang sederhana.\r\nKondisi: Preloved, masih sangat bagus, semua tombol berfungsi normal. Sudah termasuk adaptor bawaan.', 'Tersedia', 0, NULL, 0, 3.2, 162, 0, 0),
(124, 9, 6, 7, NULL, 3, '2025-05-31 16:00:00', '2025-06-30 16:00:00', NULL, 0, 'Vacuum Cleaner Panasonic 1600W', 3250000, 'Vacuum cleaner Panasonic dengan daya hisap kuat 1600 watt, cocok untuk membersihkan lantai, karpet, dan sudut ruangan secara menyeluruh. Didesain ringkas dan ringan, mudah dibawa serta disimpan. Dilengkapi dengan filter debu dan tabung debu berkapasitas besar yang mudah dilepas pasang. Kabel otomatis dan kepala penyedot fleksibel memudahkan penggunaan sehari-hari.\r\nKondisi: Preloved, masih sangat bagus dan berfungsi normal. Cocok untuk rumah tangga maupun kantor.', 'Tersedia', 0, NULL, 0, 1.2, 162, 0, 0),
(125, 11, 6, 12, NULL, 7, '2025-06-02 15:30:00', '2025-07-02 15:30:00', NULL, 0, 'Sarung Tangan Motor Anti Slip', 55000, 'Nikmati pengalaman berkendara yang lebih aman dan nyaman dengan sarung tangan motor berkualitas tinggi. Didesain dengan bahan anti slip dan sirkulasi udara baik, cocok untuk perjalanan harian maupun touring jauh. Melindungi tangan dari panas, debu, dan angin!', 'Tersedia', 0, NULL, 0, 0.2, 163, 0, 0),
(126, 11, 6, 12, NULL, 6, '2025-06-02 15:30:00', '2025-07-02 15:30:00', NULL, 0, 'Botol Susu Bayi Anti Kolik', 45000, 'Botol susu bayi dirancang khusus dengan sistem anti kolik untuk mengurangi masuknya udara ke perut bayi. Terbuat dari bahan bebas BPA, ringan, dan mudah dibersihkan. Cocok untuk bayi baru lahir hingga 12 bulan. Hadir dengan dot silikon lembut menyerupai payudara ibu.', 'Tersedia', 0, NULL, 0, 0.1, 163, 0, 0),
(127, 7, 6, 7, NULL, 2, '2025-06-03 14:29:00', '2025-07-03 14:29:00', NULL, 0, 'Mesin Fotokopi Canon IR 2525', 3400000, 'bagus sekali', 'Tersedia', 1, NULL, 0, 0.2, 164, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_keranjang`
--

CREATE TABLE `detail_keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_keranjang`
--

INSERT INTO `detail_keranjang` (`id_keranjang`, `id_barang`) VALUES
(1, 22),
(2, 24),
(3, 27),
(4, 29),
(5, 22),
(7, 24),
(8, 29),
(9, 22),
(1, 22),
(2, 24),
(3, 27),
(4, 29),
(5, 22),
(7, 24),
(8, 29),
(9, 22),
(9, 27),
(9, 28),
(2, 29),
(1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `sub_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_transaksi`, `id_barang`, `sub_total`) VALUES
(11, 24, 240000),
(11, 22, 80000),
(12, 22, 80000),
(12, 29, 100000),
(13, 23, 450000),
(13, 22, 50000),
(14, 27, 150000),
(14, 22, 300000),
(15, 24, 200000),
(16, 27, 360000),
(17, 28, 400000),
(17, 22, 10000),
(18, 22, 80000),
(18, 29, 70000),
(20, 24, 295000),
(19, 23, 350000),
(21, 31, 280000),
(21, 35, 30000),
(22, 34, 250000),
(23, 35, 150000),
(23, 34, 30000),
(24, 33, 350000),
(24, 35, 170000),
(25, 32, 470000),
(26, 31, 280000),
(26, 35, 110000),
(27, 34, 225000),
(28, 33, 350000),
(38, 23, 450000),
(39, 26, 2800000),
(40, 28, 600000),
(41, 38, 500000),
(42, 39, 2000000),
(43, 40, 350000),
(44, 41, 250000),
(45, 42, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `diskusi_produk`
--

CREATE TABLE `diskusi_produk` (
  `id_diskusi` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `pertanyaan` longtext NOT NULL,
  `jawaban` longtext NOT NULL,
  `tanggal_tanya` datetime NOT NULL,
  `tanggal_jawab` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diskusi_produk`
--

INSERT INTO `diskusi_produk` (`id_diskusi`, `id_pembeli`, `id_pegawai`, `id_barang`, `pertanyaan`, `jawaban`, `tanggal_tanya`, `tanggal_jawab`) VALUES
(1, 11, 4, 22, 'Apakah kalkulator ini bisa dipakai untuk ujian nasional?', 'Ya, model ini diperbolehkan untuk ujian nasional karena tidak bisa menyimpan data.', '2025-04-01 10:00:00', '2025-04-01 12:15:00'),
(2, 12, 4, 23, 'Berapa lama baterai speakernya bisa bertahan?', 'Bisa tahan sekitar 8 jam dalam kondisi penuh.', '2025-04-02 09:30:00', '2025-04-02 11:00:00'),
(3, 13, 6, 24, 'Ukuran jaket kulitnya berapa ya?', 'Ukuran L kak, cocok untuk tinggi badan 165-175 cm.', '2025-04-03 14:00:00', '2025-04-03 14:20:00'),
(4, 14, 6, 27, 'Apakah stroller bisa dilipat dan masuk bagasi mobil?', 'Bisa kak, model ini lipatannya compact dan ringan.', '2025-04-04 08:30:00', '2025-04-04 09:00:00'),
(5, 16, 7, 29, 'Berapa dimensi tenda ini dan apakah anti air?', 'Untuk 2 orang, 200x150cm dan sudah waterproof.', '2025-04-05 13:15:00', '2025-04-05 15:00:00'),
(6, 17, 4, 28, 'Apakah headset ini support PS4?', 'Ya, masih kompatibel dengan port audio PS4.', '2025-04-06 16:10:00', '2025-04-06 17:00:00'),
(7, 18, 4, 23, 'Speaker-nya masih bisa connect Bluetooth dengan iPhone?', 'Bisa kak, support semua versi iOS terbaru.', '2025-04-07 10:00:00', '2025-04-07 11:10:00'),
(8, 19, 6, 24, 'Apakah jaket bisa dicuci mesin?', 'Sebaiknya dicuci tangan untuk menjaga kualitas kulit.', '2025-04-08 12:30:00', '2025-04-08 13:10:00'),
(9, 20, 6, 22, 'Masih lengkap dengan box dan buku petunjuk?', 'Ya, masih lengkap seperti baru.', '2025-04-09 08:00:00', '2025-04-09 08:45:00'),
(10, 11, 7, 27, 'Bannya kempes tidak ya kak?', 'Tidak, bannya sudah dicek dan aman dipakai langsung.', '2025-04-10 09:50:00', '2025-04-10 10:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id_request` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `tanggal_donasi` date NOT NULL,
  `penerima` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id_request`, `id_barang`, `tanggal_donasi`, `penerima`) VALUES
(12, 21, '2025-04-12', 'Jason Wiranata'),
(14, 25, '2025-04-12', 'Cheryl Alexandra'),
(17, 30, '2025-04-12', 'Nathaniel Raka'),
(21, 31, '2025-04-12', 'Kenzo Mahendra'),
(22, 32, '2025-04-12', 'Shania Marlina'),
(23, 33, '2025-04-12', 'Darren Alvaro'),
(24, 34, '2025-04-12', 'Bianca Clarissa'),
(25, 35, '2025-04-12', 'Zivanna Naomi'),
(26, 36, '2025-04-12', 'Leonardo Elvan'),
(27, 37, '2025-04-12', 'Keisha Ardelia'),
(29, 109, '2025-05-13', 'Joko Susanto');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_barang`
--

CREATE TABLE `foto_barang` (
  `id_foto` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `urutan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto_barang`
--

INSERT INTO `foto_barang` (`id_foto`, `id_barang`, `nama_file`, `urutan`) VALUES
(1, 21, 'rak_buku.jpg', 1),
(2, 22, 'kalkulator.jpg', 1),
(3, 23, 'speaker.jpg', 1),
(4, 24, 'jaket_kulit.jpg', 1),
(5, 25, 'skateboard.jpg', 1),
(6, 26, 'kamera.jpg', 1),
(7, 27, 'stroller.jpg', 1),
(8, 28, 'headset.jpg', 1),
(9, 29, 'tenda.jpg', 1),
(10, 30, 'sepatu.jpg', 1),
(11, 31, 'jaket_olahraga.jpg', 1),
(12, 32, 'stroller_bekas.jpg', 1),
(13, 33, 'kosmetik.jpg', 1),
(14, 34, 'setrika.jpg', 1),
(15, 35, 'boneka.jpg', 1),
(16, 36, 'buku_smp.jpg', 1),
(17, 37, 'bt_speaker.jpg', 1),
(18, 38, 'tablet.jpg', 1),
(19, 39, 'sepeda.jpg', 1),
(20, 40, 'smartwatch.jpg', 1),
(21, 41, 'blender.jpg', 1),
(22, 42, 'bukusd.jpg', 1),
(23, 43, 'kamera1.jpg', 1),
(24, 44, 'laptop1.jpg', 1),
(25, 45, 'tablet1.jpg', 1),
(26, 46, 'meja1.jpg', 1),
(27, 47, 'printer1.jpg', 1),
(28, 48, 'puzzle1.jpg', 1),
(29, 49, 'skateboard1.jpg', 1),
(30, 50, 'lipstick1.jpg', 1),
(31, 51, 'kopi1.jpg', 1),
(32, 52, 'gopro1.jpg', 1),
(33, 73, 'headphone.jpg', 1),
(34, 74, 'kameraC.jpg', 1),
(35, 75, 'jaketK.jpg', 1),
(36, 76, 'tasR.jpg', 1),
(37, 77, 'mejaB.jpg', 1),
(38, 78, 'lampu.jpg', 1),
(39, 79, 'komik.jpg', 1),
(40, 80, 'alat.jpg', 1),
(41, 81, 'gitar.jpg', 1),
(42, 82, 'iron.jpg', 1),
(43, 83, 'strollerB.jpg', 1),
(44, 84, 'mainan.jpg', 1),
(45, 85, 'helm.jpg', 1),
(46, 86, 'velg.jpg', 1),
(47, 87, 'bbq.jpg', 1),
(48, 88, 'tendaC.jpg', 1),
(49, 89, 'kursiK.jpg', 1),
(50, 90, 'rak.jpg', 1),
(51, 91, 'hair.jpg', 1),
(52, 92, 'cerminR.jpg', 1),
(53, 103, 'tv1.jpg', 1),
(54, 104, 'meja1.jpg', 1),
(55, 105, 'ps2_1.jpg', 1),
(56, 106, 'sepatu1.jpg', 1),
(57, 107, 'kasur1.jpg', 1),
(58, 108, 'hair1.jpg', 1),
(59, 109, 'cuci1.jpg', 1),
(60, 110, 'hp1.jpg', 1),
(61, 111, 'ketik1.jpg', 1),
(62, 112, 'tendaB.jpg', 1),
(64, 21, 'rak_buku2.jpg', 2),
(65, 22, 'kalkulator2.jpg', 2),
(66, 23, 'speaker2.jpg', 2),
(67, 24, 'jaket_kulit2.jpg', 2),
(68, 25, 'skateboard2.jpg', 2),
(69, 26, 'kamera2.jpg', 2),
(70, 27, 'stroller2.jpg', 2),
(71, 28, 'headset2.jpg', 2),
(72, 29, 'tenda2.jpg', 2),
(73, 30, 'sepatu2.jpg', 2),
(74, 31, 'jaket_olahraga2.jpg', 2),
(75, 32, 'stroller_bekas2.jpg', 2),
(76, 33, 'kosmetik2.jpg', 2),
(77, 34, 'setrika2.jpg', 2),
(78, 35, 'boneka2.jpg', 2),
(79, 36, 'buku_smp2.jpg', 2),
(80, 37, 'bt_speaker2.jpg', 2),
(81, 38, 'tablet2.jpg', 2),
(82, 39, 'sepeda2.jpg', 2),
(83, 40, 'smartwatch2.jpg', 2),
(84, 41, 'blender2.jpg', 2),
(85, 42, 'bukusd2.jpg', 2),
(86, 43, 'kamera2.jpg', 2),
(87, 44, 'laptop2.jpg', 2),
(88, 45, 'tablet2.jpg', 2),
(89, 46, 'meja2.jpg', 2),
(90, 47, 'printer2.jpg', 2),
(91, 48, 'puzzle2.jpg', 2),
(92, 49, 'skateboard2.jpg', 2),
(93, 50, 'lipstick2.jpg', 2),
(94, 51, 'kopi2.jpg', 2),
(95, 52, 'gopro2.jpg', 2),
(96, 73, 'headphone2.jpg', 2),
(97, 74, 'kameraC2.jpg', 2),
(98, 75, 'jaketK2.jpg', 2),
(99, 76, 'tasR2.jpg', 2),
(100, 77, 'mejaB2.jpg', 2),
(101, 78, 'lampu2.jpg', 2),
(102, 79, 'komik2.jpg', 2),
(103, 80, 'alat2.jpg', 2),
(104, 81, 'gitar2.jpg', 2),
(105, 82, 'iron2.jpg', 2),
(106, 83, 'strollerB2.jpg', 2),
(107, 84, 'mainan2.jpg', 2),
(108, 85, 'helm2.jpg', 2),
(109, 86, 'velg2.jpg', 2),
(110, 87, 'bbq2.jpg', 2),
(111, 88, 'tendaC2.jpg', 2),
(112, 89, 'kursiK2.jpg', 2),
(113, 90, 'rak2.jpg', 2),
(114, 91, 'hair2.jpg', 2),
(115, 92, 'cerminR2.jpg', 2),
(116, 103, 'tv2.jpg', 2),
(117, 104, 'meja2.jpg', 2),
(118, 105, 'ps2_2.jpg', 2),
(119, 106, 'sepatu2.jpg', 2),
(120, 107, 'kasur2.jpg', 2),
(121, 108, 'hair2.jpg', 2),
(122, 109, 'cuci2.jpg', 2),
(123, 110, 'hp2.jpg', 2),
(124, 111, 'ketik2.jpg', 2),
(125, 112, 'tendaB2.jpg', 2),
(131, 115, '1748577475_0.jpg', 1),
(132, 115, '1748577475_1.jpg', 2),
(133, 116, '1748578679_0.jpg', 1),
(134, 116, '1748578679_1.jpg', 2),
(135, 117, '1748581477_0.jpg', 1),
(136, 117, '1748581477_1.jpg', 2),
(141, 113, '1748646799_0.jpg', 1),
(142, 113, '1748646799_1.jpg', 3),
(143, 118, '1748651242_0.jpg', 1),
(144, 118, '1748651242_1.jpg', 2),
(145, 119, '1748654242_0.jpg', 1),
(146, 119, '1748654242_1.jpg', 2),
(147, 120, '1748676137_0.jpg', 1),
(148, 120, '1748676137_1.jpg', 2),
(149, 121, '1748676763_0.jpg', 1),
(150, 121, '1748676763_1.jpg', 2),
(151, 122, '1748680071_0.jpg', 1),
(152, 122, '1748680071_1.jpg', 2),
(153, 123, '1748682296_0.jpg', 1),
(154, 123, '1748682296_1.jpg', 2),
(155, 124, '1748682380_0.jpg', 1),
(156, 124, '1748682380_1.jpg', 2),
(157, 124, '1748682380_2.jpg', 3),
(158, 125, '1748853188_0.png', 1),
(159, 125, '1748853188_1.png', 2),
(160, 126, '1748853258_0.png', 1),
(161, 126, '1748853258_1.png', 2),
(162, 127, '1748935833_0.png', 1),
(163, 127, '1748935833_1.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Owner'),
(2, 'Kepala Gudang'),
(3, 'Customer Service'),
(4, 'Admin'),
(5, 'Kurir'),
(6, 'Pegawai Gudang'),
(7, 'Hunter');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Elektronik & Gadget'),
(2, 'Pakaian & Aksesori'),
(3, 'Perabotan Rumah Tangga'),
(4, 'Buku, Alat Tulis, & Peralatan Sekolah'),
(5, 'Hobi, Mainan, & Koleksi'),
(6, 'Perlengkapan Bayi & Anak'),
(7, 'Otomotif & Aksesori'),
(8, 'Perlengkapan Taman & Outdoor'),
(9, 'Peralatan Kantor & Industri'),
(10, 'Kosmetik & Perawatan Diri');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `id_pembeli`) VALUES
(1, 11),
(10, 11),
(2, 12),
(3, 13),
(4, 14),
(5, 16),
(6, 17),
(7, 18),
(8, 19),
(9, 20);

-- --------------------------------------------------------

--
-- Table structure for table `komisi`
--

CREATE TABLE `komisi` (
  `id_komisi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_penitip` int(11) NOT NULL,
  `komisi` int(11) NOT NULL,
  `komisi_penitip` int(11) NOT NULL,
  `komisi_hunter` int(11) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komisi`
--

INSERT INTO `komisi` (`id_komisi`, `id_barang`, `id_transaksi`, `id_penitip`, `komisi`, `komisi_penitip`, `komisi_hunter`, `id_pegawai`) VALUES
(1, 23, 38, 3, 81000, 9000, 0, NULL),
(2, 26, 39, 6, 700000, 0, 140000, 8),
(3, 28, 40, 8, 78000, 12000, 30000, 14),
(4, 38, 41, 2, 150000, 0, 0, NULL),
(5, 39, 42, 3, 260000, 40000, 100000, 14),
(6, 40, 43, 5, 52500, 0, 17500, 8),
(7, 41, 44, 6, 50000, 0, 0, NULL),
(8, 42, 45, 7, 30000, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `id_merchandise` int(11) NOT NULL,
  `nama_merchandise` varchar(255) NOT NULL,
  `jumlah_poin` int(11) NOT NULL,
  `banyak_merchandise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`id_merchandise`, `nama_merchandise`, `jumlah_poin`, `banyak_merchandise`) VALUES
(1, 'Ballpoin', 100, 50),
(2, 'Stiker', 100, 100),
(3, 'Mug', 250, 30),
(4, 'Topi', 250, 30),
(5, 'Tumblr', 500, 20),
(6, 'T-shirt', 500, 25),
(7, 'Jam Dinding', 500, 15),
(8, 'Tas Travel', 1000, 10),
(9, 'Payung', 1000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_07_115825_create_personal_access_tokens_table', 1),
(5, '2025_06_02_155410_add_fcm_token_to_penitip_table', 2),
(6, '2025_06_03_154646_add_notification_flags_to_barang_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nota_penitipan`
--

CREATE TABLE `nota_penitipan` (
  `id_nota` int(11) NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `tanggal_penitipan` datetime NOT NULL,
  `masa_berakhir` date NOT NULL,
  `id_penitip` int(11) NOT NULL,
  `id_qc_pegawai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nota_penitipan`
--

INSERT INTO `nota_penitipan` (`id_nota`, `no_nota`, `tanggal_penitipan`, `masa_berakhir`, `id_penitip`, `id_qc_pegawai`) VALUES
(92, '25.03.011', '2025-03-01 10:14:41', '2025-03-31', 1, 12),
(93, '25.05.032', '2025-05-01 10:35:21', '2025-05-31', 1, 12),
(94, '25.05.031', '2025-05-01 14:12:43', '2025-05-31', 1, 7),
(95, '25.03.012', '2025-03-01 11:17:33', '2025-03-31', 2, 7),
(96, '25.03.019', '2025-03-05 15:49:34', '2025-04-04', 2, 7),
(97, '25.03.023', '2025-03-18 17:15:14', '2025-04-17', 2, 12),
(98, '25.05.034', '2025-05-01 10:47:29', '2025-05-31', 2, 12),
(99, '25.05.033', '2025-05-01 14:11:44', '2025-05-31', 2, 7),
(100, '25.05.050', '2025-05-06 10:36:11', '2025-06-05', 2, 7),
(101, '25.01.006', '2025-01-25 12:25:45', '2025-02-24', 3, 7),
(102, '25.03.016', '2025-03-02 12:20:13', '2025-04-01', 3, 12),
(103, '25.03.020', '2025-03-10 16:23:51', '2025-04-09', 3, 7),
(104, '25.03.024', '2025-03-22 16:58:35', '2025-04-21', 3, 6),
(105, '25.05.035', '2025-05-02 17:41:24', '2025-06-01', 3, 6),
(106, '25.05.051', '2025-05-07 09:31:16', '2025-06-06', 3, 6),
(107, '25.01.004', '2025-01-15 16:32:07', '2025-02-14', 4, 6),
(108, '25.02.010', '2025-02-28 16:06:48', '2025-03-30', 4, 12),
(109, '25.03.021', '2025-03-12 12:57:38', '2025-04-11', 4, 6),
(110, '25.05.036', '2025-05-02 08:27:47', '2025-06-01', 4, 6),
(111, '25.05.037', '2025-05-02 15:26:04', '2025-06-01', 4, 7),
(112, '25.05.052', '2025-05-07 13:46:56', '2025-06-06', 4, 7),
(113, '25.05.059', '2025-05-24 14:36:30', '2025-06-23', 4, 12),
(114, '25.01.005', '2025-01-18 13:41:42', '2025-02-17', 5, 12),
(115, '25.02.007', '2025-02-20 16:38:59', '2025-03-22', 5, 12),
(116, '25.03.013', '2025-03-01 14:09:50', '2025-03-31', 5, 12),
(117, '25.03.025', '2025-03-25 12:52:15', '2025-04-24', 5, 12),
(118, '25.05.038', '2025-05-02 13:51:46', '2025-06-01', 5, 12),
(119, '25.05.039', '2025-05-03 12:42:05', '2025-06-02', 5, 6),
(120, '25.05.053', '2025-05-08 13:55:07', '2025-06-07', 5, 6),
(121, '25.01.002', '2025-01-10 13:29:21', '2025-02-09', 6, 7),
(122, '25.02.008', '2025-02-25 17:41:25', '2025-03-27', 6, 12),
(123, '25.03.014', '2025-03-01 09:59:01', '2025-03-31', 6, 12),
(124, '25.03.026', '2025-03-27 08:50:52', '2025-04-26', 6, 7),
(125, '25.05.040', '2025-05-03 16:17:17', '2025-06-02', 6, 7),
(126, '25.05.041', '2025-05-03 16:53:50', '2025-06-02', 6, 12),
(127, '25.05.054', '2025-05-08 17:37:20', '2025-06-07', 6, 7),
(128, '25.01.003', '2025-01-12 09:25:10', '2025-02-11', 7, 12),
(129, '25.03.017', '2025-03-02 16:13:49', '2025-04-01', 7, 6),
(130, '25.03.027', '2025-03-28 14:53:36', '2025-04-27', 7, 7),
(131, '25.03.028', '2025-03-29 17:46:36', '2025-04-28', 7, 7),
(132, '25.05.042', '2025-05-03 16:12:09', '2025-06-02', 7, 7),
(133, '25.05.043', '2025-05-04 09:41:00', '2025-06-03', 7, 7),
(134, '25.05.055', '2025-05-09 11:48:34', '2025-06-08', 7, 6),
(135, '25.01.001', '2025-01-05 11:59:52', '2025-02-04', 8, 6),
(136, '25.03.018', '2025-03-02 16:33:35', '2025-04-01', 8, 6),
(137, '25.04.029', '2025-04-01 08:48:23', '2025-05-01', 8, 12),
(138, '25.05.044', '2025-05-04 16:21:08', '2025-06-03', 8, 6),
(139, '25.05.045', '2025-05-04 17:20:32', '2025-06-03', 8, 7),
(140, '25.05.056', '2025-05-09 09:39:18', '2025-06-08', 8, 6),
(141, '25.02.009', '2025-02-27 08:14:54', '2025-03-29', 9, 7),
(142, '25.04.030', '2025-04-02 14:16:37', '2025-05-02', 9, 7),
(143, '25.05.046', '2025-05-04 08:38:21', '2025-06-03', 9, 6),
(144, '25.05.048', '2025-05-05 12:21:56', '2025-06-04', 9, 7),
(145, '25.05.057', '2025-05-10 17:54:36', '2025-06-09', 9, 6),
(146, '25.03.015', '2025-03-01 14:27:14', '2025-03-31', 10, 7),
(147, '25.03.022', '2025-03-15 10:32:21', '2025-04-14', 10, 12),
(148, '25.05.047', '2025-05-04 11:20:03', '2025-06-03', 10, 6),
(149, '25.05.049', '2025-05-05 17:03:15', '2025-06-04', 10, 6),
(150, '25.05.058', '2025-05-10 13:16:08', '2025-06-09', 10, 6),
(157, '25.05.060', '2025-05-30 08:40:00', '2025-06-29', 6, 7),
(158, '25.05.061', '2025-05-30 10:53:00', '2025-06-29', 6, 7),
(159, '25.05.062', '2025-05-30 11:06:00', '2025-06-29', 6, 7),
(160, '25.05.063', '2025-05-30 11:15:00', '2025-06-29', 8, 12),
(161, '25.05.064', '2025-05-31 14:14:00', '2025-06-30', 5, 7),
(162, '25.05.065', '2025-05-31 16:00:00', '2025-06-30', 9, 7),
(163, '25.06.066', '2025-06-02 15:30:00', '2025-07-02', 11, 12),
(164, '25.06.067', '2025-06-03 14:29:00', '2025-07-03', 7, 7);

-- --------------------------------------------------------

--
-- Table structure for table `organisasi`
--

CREATE TABLE `organisasi` (
  `id_organisasi` int(11) NOT NULL,
  `nama_organisasi` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisasi`
--

INSERT INTO `organisasi` (`id_organisasi`, `nama_organisasi`, `alamat`, `password`, `status_aktif`, `email`) VALUES
(11, 'Panti Asuhan Pelita Hati', 'Jl. Merpati No. 10, Sleman, Yogyakarta', 'pelita123', 1, ''),
(12, 'Panti Jompo Kasih Ibu', 'Jl. Anggrek No. 5, Bantul, Yogyakarta', 'kasihibu123', 1, ''),
(13, 'Yayasan Harapan Bangsa', 'Jl. Diponegoro No. 15, Kota Yogyakarta', 'harapan123', 1, ''),
(14, 'Panti Asuhan Bina Remaja', 'Jl. Wonosari Km 7, Yogyakarta', 'bina123', 1, ''),
(15, 'Yayasan Sejahtera Bersama', 'Jl. Kaliurang Km 9, Yogyakarta', 'sejahtera123', 1, ''),
(16, 'Panti Wreda Bhakti Luhur', 'Jl. Godean No. 20, Sleman, Yogyakarta', 'luhur123', 1, ''),
(17, 'Komunitas Pemuda Mandiri', 'Jl. Parangtritis Km 4, Bantul, Yogyakarta', 'mandiri123', 1, ''),
(18, 'Yayasan Anak Bangsa', 'Jl. Solo Km 12, Kalasan, Sleman', 'anakbangsa123', 1, ''),
(19, 'Panti Sosial Bina Karya', 'Jl. Palagan Tentara Pelajar, Yogyakarta', 'binakarya123', 1, ''),
(20, 'Yayasan Cinta Sesama', 'Jl. Imogiri Timur Km 6, Bantul', 'cinta123', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `notelp` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `fcm_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `id_jabatan`, `nama_pegawai`, `email`, `notelp`, `tanggal_lahir`, `username`, `password`, `status_aktif`, `fcm_token`) VALUES
(1, 1, 'Raka Pratama', 'raka@reusmart.com', '081234567890', '1990-01-01', 'raka', 'password123', 1, NULL),
(2, 2, 'Rani Astuti', 'rani@reusmart.com', '081234567891', '1985-03-12', 'rani', 'password123', 1, NULL),
(3, 3, 'Dina Rahmawati', 'dina@reusmart.com', '081234567892', '1992-07-15', 'dina', 'password123', 1, NULL),
(4, 4, 'Andri Setiawan', 'andri@reusmart.com', '081234567893', '1991-11-21', 'andri', 'password123', 1, NULL),
(5, 5, 'Cahyono', 'cahyono@reusmart.com', '081234567894', '1988-06-06', 'cahyono', 'password123', 1, NULL),
(6, 6, 'Bayu Prasetyo', 'bayu@reusmart.com', '081234567895', '1995-02-14', 'bayu', 'password123', 1, NULL),
(7, 6, 'Sinta Dewi', 'sinta@reusmart.com', '081234567896', '1993-04-28', 'sinta', 'password123', 1, NULL),
(8, 7, 'Tono Wahyudi', 'tono@reusmart.com', '081234567897', '1990-10-10', 'tono', 'password123', 1, NULL),
(9, 5, 'Surya Kurniawan', 'surya@reusmart.com', '081234567898', '1994-09-05', 'surya', 'password123', 1, NULL),
(10, 4, 'Nina Fitriani', 'nina@reusmart.com', '081234567899', '1989-12-31', 'nina', 'password123', 1, NULL),
(12, 6, 'Oka Oki', 'okaoki@reusemart.com', '085752145677', '2005-11-12', 'okaoki', 'okaoki123', 1, NULL),
(14, 7, 'Junaedi', 'junaedi@reusmart.com', '085752145678', '1996-03-27', 'junaedi', 'password123', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_transaksi` int(11) NOT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `status_verifikasi` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembeli`, `id_pegawai`, `id_transaksi`, `bukti_transfer`, `status_verifikasi`) VALUES
(27, 11, 3, 11, 'bukti_transfer_1.jpg', 1),
(28, 13, 6, 13, 'bukti_transfer_2.jpg', 1),
(29, 16, 3, 15, 'bukti_transfer_3.jpg', 1),
(30, 18, 6, 17, 'bukti_transfer_4.jpg', 1),
(31, 11, 3, 19, 'bukti_transfer_5.jpg', 1),
(32, 14, 6, 21, 'bukti_transfer_6.jpg', 1),
(33, 13, 3, 23, 'bukti_transfer_7.jpg', 1),
(34, 14, 6, 24, 'bukti_transfer_8.jpg', 1),
(35, 16, 3, 25, 'bukti_transfer_9.jpg', 1),
(36, 18, 6, 27, 'bukti_transfer_10.jpg', 1),
(37, 20, 3, 28, 'bukti_transfer_11.jpg', 1),
(38, 14, 3, 14, 'bukti_transfer_12.jpg', 0),
(39, 20, 6, 18, 'bukti_transfer_13.jpg', 0),
(41, 11, 3, 38, 'bukti_transfer_14', 1),
(42, 12, 6, 39, 'bukti_transfer_15', 1),
(43, 13, 3, 40, 'bukti_transfer_16', 1),
(44, 14, 6, 41, 'bukti_transfer_17', 1),
(45, 16, 3, 42, 'bukti_transfer_18', 1),
(46, 17, 6, 43, 'bukti_transfer_19', 1),
(47, 18, 3, 44, 'bukti_transfer_20', 1),
(48, 20, 6, 45, 'bukti_transfer_21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `poin` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `notelp` varchar(255) NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `fcm_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `username`, `password`, `poin`, `email`, `notelp`, `nama_pembeli`, `status_aktif`, `fcm_token`) VALUES
(11, 'dindz_01', 'password1', 600, 'dindz01@mail.com', '081234567891', 'Aulia Dindasari', 1, NULL),
(12, 'el_dann', 'password2', 450, 'eldann@mail.com', '082345678912', 'Rizky Eldani', 1, NULL),
(13, 'juannoob', 'password3', 500, 'juannoob@mail.com', '083456789123', 'Juanri Setiawan', 1, NULL),
(14, 'dinadan', 'password4', 750, 'dinadan@mail.com', '084567891234', 'Nadinda Elvira', 1, NULL),
(15, 'eldankun', 'password5', 210, 'eldankun@mail.com', '085678912345', 'M. Eldan Harits', 0, NULL),
(16, 'juanxox', 'password6', 900, 'juanxox@mail.com', '086789123456', 'Ferdian Juandaru', 1, NULL),
(17, 'dnd_rahma', 'password7', 300, 'dndrahma@mail.com', '087891234567', 'Dindara Rahmawati', 1, NULL),
(18, 'eldysky', 'password8', 400, 'eldysky@mail.com', '088912345678', 'Eldyana Putri', 1, NULL),
(19, 'juanez', 'password9', 200, 'juanez@mail.com', '089123456789', 'Juandy Erlangga', 0, NULL),
(20, 'ddinrose', 'password10', 1000, 'ddinrose@mail.com', '080234567890', 'Roselinda Dinar', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_jadwal` int(11) NOT NULL,
  `status_pengiriman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pegawai`, `id_jadwal`, `status_pengiriman`) VALUES
(27, 5, 14, 'Diterima'),
(28, NULL, 15, 'Dibatalkan'),
(29, 9, 16, 'Sampai'),
(30, NULL, 17, 'Diterima'),
(31, 5, 18, 'Disiapkan'),
(32, 9, 19, 'Diantar'),
(33, NULL, 20, 'Diterima'),
(34, 5, 21, 'Diterima'),
(35, NULL, 22, 'Dibatalkan'),
(36, NULL, 23, 'Diterima'),
(37, 9, 24, 'Sampai'),
(38, 5, 25, 'Disiapkan'),
(39, NULL, 26, 'Diterima'),
(41, NULL, 29, 'Diterima'),
(42, NULL, 30, 'Diterima'),
(43, NULL, 31, 'Diterima'),
(44, NULL, 32, 'Diterima'),
(45, NULL, 33, 'Diterima'),
(46, NULL, 34, 'Diterima'),
(47, NULL, 35, 'Diterima'),
(48, NULL, 36, 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `penitip`
--

CREATE TABLE `penitip` (
  `id_penitip` int(11) NOT NULL,
  `no_ktp` varchar(255) NOT NULL,
  `nama_penitip` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `poin` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `saldo_penitip` float NOT NULL,
  `status_aktif` tinyint(1) NOT NULL,
  `foto_ktp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penitip`
--

INSERT INTO `penitip` (`id_penitip`, `no_ktp`, `nama_penitip`, `username`, `password`, `poin`, `alamat`, `email`, `fcm_token`, `saldo_penitip`, `status_aktif`, `foto_ktp`) VALUES
(1, '9201010101010001', 'Yohanis Mabel', 'yohanis', 'pass123', 120, 'Asrama Papua, Caturtunggal, Depok, Sleman', 'yohanis@mail.com', 'e7lLwoiaRcWpVr-FNXZWgk:APA91bF7Ub_gFRbm5WstXjsJYMVkzsGXL9QLv9TCF6o9puHF_Rr6ZljkHLNopafSZNrc_O8jWfZzn0m2halDosHRfj-_4u0OI5olpIMY5FU2t1sK0CvY7EM', 250000, 1, ''),
(2, '9201010101010002', 'Maria Toding', 'mariat', 'pass123', 90, 'Jl. Kaliurang Km 7, Sleman', 'mariat@mail.com', 'e0wTrv3XSYa718c4-lPM8V:APA91bFqbvN1IKwciFKSKBaMB2z3t9-LaKDw-zs78E5gAHU1wlBhWU4vuQieUfuRAovlXtExUOdSuusJ8BjL0fx1QQfytWToi3XOITZ7rIjiQaOBwmDZcjo', 150000, 1, ''),
(3, '9201010101010003', 'Benyamin Wambrauw', 'beny', 'pass123', 75, 'Babarsari, Sleman, DI Yogyakarta', 'beny@mail.com', NULL, 100000, 1, ''),
(4, '3404010101010004', 'Galuh Prakoso', 'galuh', 'pass123', 210, 'Ngaglik, Sleman, DI Yogyakarta', 'galuh@mail.com', NULL, 380000, 1, ''),
(5, '3404010101010005', 'Sekar Ayu', 'sekar', 'pass123', 180, 'Godean, Sleman, DI Yogyakarta', 'sekar@mail.com', NULL, 295000, 1, ''),
(6, '3404010101010006', 'Bambang Cahyono', 'bambang', 'pass123', 105, 'Seturan, Depok, Sleman', 'bambang@mail.com', NULL, 175000, 1, ''),
(7, '3404010101010007', 'Widya Kurniawati', 'widya', 'pass123', 510, 'Jl. Palagan Km 8, Sleman', 'widya@mail.com', 'e0wTrv3XSYa718c4-lPM8V:APA91bFqbvN1IKwciFKSKBaMB2z3t9-LaKDw-zs78E5gAHU1wlBhWU4vuQieUfuRAovlXtExUOdSuusJ8BjL0fx1QQfytWToi3XOITZ7rIjiQaOBwmDZcjo', 90000, 1, ''),
(8, '3275010101010008', 'Deni Iskandar', 'deni', 'pass123', 240, 'Jl. Gejayan, Sleman, DI Yogyakarta', 'deni@mail.com', NULL, 410000, 1, ''),
(9, '3275010101010009', 'Ratih Nuraini', 'ratih', 'pass123', 85, 'Jl. Monjali, Sleman, DI Yogyakarta', 'ratih@mail.com', NULL, 130000, 1, ''),
(10, '3275010101010010', 'Anton Siregar', 'anton', 'pass123', 150, 'Jl. Laksda Adisucipto, Sleman, DI Yogyakarta', 'anton@mail.com', NULL, 200000, 0, ''),
(11, '3407011005920666', 'Marsella Adinda', 'oadinda', 'oadinda123', 0, 'Bantul, Yogyakarta', 'oadinda3004@gmail.com', NULL, 0, 1, 'ktp/2aTzvzT9bnlaTwiEr4GNonUY2e2We4GfrIEigqQQ.png');

-- --------------------------------------------------------

--
-- Table structure for table `penjadwalan`
--

CREATE TABLE `penjadwalan` (
  `id_jadwal` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jenis_jadwal` varchar(255) NOT NULL,
  `tanggal_jadwal` datetime DEFAULT NULL,
  `status_jadwal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjadwalan`
--

INSERT INTO `penjadwalan` (`id_jadwal`, `id_transaksi`, `jenis_jadwal`, `tanggal_jadwal`, `status_jadwal`) VALUES
(14, 11, 'Pengiriman', '2025-04-03 10:00:00', 'Dijadwalkan'),
(15, 13, 'Diambil', '2025-04-05 14:30:00', 'Dijadwalkan'),
(16, 15, 'Pengiriman', '2025-04-07 13:30:00', 'Dijadwalkan'),
(17, 17, 'Diambil', '2025-04-09 11:00:00', 'Dijadwalkan'),
(18, 19, 'Pengiriman', NULL, 'Diproses'),
(19, 21, 'Pengiriman', '2025-04-13 10:00:00', 'Dijadwalkan'),
(20, 22, 'Diambil', '2025-04-13 13:30:00', 'Dijadwalkan'),
(21, 23, 'Pengiriman', '2025-04-14 11:00:00', 'Dijadwalkan'),
(22, 24, 'Diambil', NULL, 'Diproses'),
(23, 25, 'Pengiriman', '2025-04-16 09:00:00', 'Dijadwalkan'),
(24, 26, 'Diambil', '2025-04-17 14:00:00', 'Dijadwalkan'),
(25, 27, 'Pengiriman', NULL, 'Diproses'),
(26, 28, 'Diambil', '2025-04-19 15:30:00', 'Dijadwalkan'),
(29, 38, 'Diambil', '2025-03-15 18:01:31', 'Dijadwalkan'),
(30, 39, 'Diambil', '2025-03-24 18:02:48', 'Dijadwalkan'),
(31, 40, 'Diambil', '2025-04-04 18:03:47', 'Dijadwalkan'),
(32, 41, 'Diambil', '2025-05-01 18:04:40', 'Dijadwalkan'),
(33, 42, 'Diambil', '2025-03-25 18:08:02', 'Dijadwalkan'),
(34, 43, 'Diambil', '2025-04-22 18:08:53', 'Dijadwalkan'),
(35, 44, 'Diambil', '2025-04-16 18:09:54', 'Dijadwalkan'),
(36, 45, 'Diambil', '2025-04-19 18:10:29', 'Dijadwalkan');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Penitip', 11, 'ReUseMart', 'b9424005af3db8975f73ad120aa1e3dc7c7185a9e68524c88272a943b029811e', '[\"*\"]', NULL, NULL, '2025-06-02 14:46:05', '2025-06-02 14:46:05'),
(2, 'App\\Models\\Penitip', 11, 'ReUseMart', 'c5eec96fa4c407fbfc01a43f63e25be3ccd59e40d88876beccc26c10936a05ba', '[\"*\"]', NULL, NULL, '2025-06-02 16:03:13', '2025-06-02 16:03:13'),
(3, 'App\\Models\\Penitip', 2, 'ReUseMart', '9ff6ba83e128aca75e947d43cc8a40e707ed1ea2580c66e3a5597818598ce004', '[\"*\"]', NULL, NULL, '2025-06-02 16:05:00', '2025-06-02 16:05:00'),
(4, 'App\\Models\\Penitip', 2, 'ReUseMart', '92cf26609997acdcf643f7dce4ea4924670f03675c51260587843dd288496e3d', '[\"*\"]', NULL, NULL, '2025-06-02 17:00:38', '2025-06-02 17:00:38'),
(5, 'App\\Models\\Penitip', 2, 'ReUseMart', '73ad203ca2b0d8d8338dab6e66890b4aa51ab6ab2187901fac047944df8189c0', '[\"*\"]', NULL, NULL, '2025-06-02 18:31:21', '2025-06-02 18:31:21'),
(6, 'App\\Models\\Penitip', 11, 'ReUseMart', 'dae27f9d04221aac5a7dc76e70f3145010e28476bf919395168404882afeacf6', '[\"*\"]', NULL, NULL, '2025-06-02 18:31:40', '2025-06-02 18:31:40'),
(7, 'App\\Models\\Penitip', 2, 'ReUseMart', '88367b354be1d07a1c482987c32e09eedf478efe9f82b545f37f10e14cc55f38', '[\"*\"]', NULL, NULL, '2025-06-02 18:34:26', '2025-06-02 18:34:26'),
(8, 'App\\Models\\Penitip', 1, 'ReUseMart', '84faff7497984d079d82369a65cd8ffe09b024019a3349d6774b8369e21888fc', '[\"*\"]', NULL, NULL, '2025-06-02 22:30:42', '2025-06-02 22:30:42'),
(9, 'App\\Models\\Penitip', 1, 'ReUseMart', 'b1e9d8b7a319b8c955e72078d9a5946a07264f52426803b0e829ba9acd463fa5', '[\"*\"]', NULL, NULL, '2025-06-03 02:10:33', '2025-06-03 02:10:33'),
(10, 'App\\Models\\Penitip', 1, 'ReUseMart', '44718e3920d45b281b711ebf5cc9fbfaf02b2513df2fdb62c141e41673ca767b', '[\"*\"]', NULL, NULL, '2025-06-03 02:21:54', '2025-06-03 02:21:54'),
(11, 'App\\Models\\Penitip', 1, 'ReUseMart', '351267c22236e68946228d85df56239fb290ddef775064ec17254e6982b3f869', '[\"*\"]', NULL, NULL, '2025-06-03 03:30:59', '2025-06-03 03:30:59'),
(12, 'App\\Models\\Penitip', 1, 'ReUseMart', '27f011c150916188ccd9a48e8614aa8b2d56539c272ff590e7ad1490fa306b07', '[\"*\"]', NULL, NULL, '2025-06-03 05:23:30', '2025-06-03 05:23:30'),
(13, 'App\\Models\\Penitip', 1, 'ReUseMart', '30e8d31213f90c6e90bc729988f4e9976e379d38d00b3b6342aa25a3b5669df9', '[\"*\"]', NULL, NULL, '2025-06-03 05:25:46', '2025-06-03 05:25:46'),
(14, 'App\\Models\\Penitip', 1, 'ReUseMart', 'a55ea363633f2041893073d7e502739803ffd8eb0c99e7d67c74839098a29316', '[\"*\"]', '2025-06-03 05:26:45', NULL, '2025-06-03 05:26:44', '2025-06-03 05:26:45'),
(15, 'App\\Models\\Penitip', 2, 'ReUseMart', '92be33564f82e672debf455a71049c5ec8457c4a35f32c836390ef90dd464e4c', '[\"*\"]', '2025-06-03 06:41:27', NULL, '2025-06-03 06:41:26', '2025-06-03 06:41:27'),
(16, 'App\\Models\\Penitip', 1, 'ReUseMart', 'aafc07d6ac456b1a1b729d2381ff3975abe58654d94db6dbc8fb233e91099619', '[\"*\"]', '2025-06-03 06:43:06', NULL, '2025-06-03 06:43:05', '2025-06-03 06:43:06'),
(17, 'App\\Models\\Penitip', 1, 'ReUseMart', 'aee1385451b4b36b66480128ee221657e4bcd59eb89b9376d8aa5af52956bf57', '[\"*\"]', '2025-06-03 07:18:31', NULL, '2025-06-03 07:18:29', '2025-06-03 07:18:31'),
(18, 'App\\Models\\Penitip', 7, 'ReUseMart', '818726439a889f47c6518bb49b8673fff9b15fd188d7ed103161e29d3082f47e', '[\"*\"]', '2025-06-03 08:34:32', NULL, '2025-06-03 08:34:31', '2025-06-03 08:34:32'),
(19, 'App\\Models\\Penitip', 7, 'ReUseMart', '63541af738663ad71a933252dc6ac3497b3b34262287a8622f023fa0f35c8532', '[\"*\"]', '2025-06-03 09:17:06', NULL, '2025-06-03 09:17:06', '2025-06-03 09:17:06'),
(20, 'App\\Models\\Penitip', 1, 'ReUseMart', 'cfa5adc980cfd9c5f2813f8baa03e2225468791c83605ef380e32a53838cf6ef', '[\"*\"]', '2025-06-03 09:24:13', NULL, '2025-06-03 09:24:12', '2025-06-03 09:24:13'),
(21, 'App\\Models\\Penitip', 1, 'ReUseMart', '124b064158370336c415285382e1df0b2e823241111585e8121ff23993cf3fee', '[\"*\"]', '2025-06-03 09:25:18', NULL, '2025-06-03 09:25:17', '2025-06-03 09:25:18'),
(22, 'App\\Models\\Penitip', 7, 'ReUseMart', '9107a728489be2bc8da595ffa196e207c17e04d250f0d3b4670925f185b8f31c', '[\"*\"]', '2025-06-03 09:26:21', NULL, '2025-06-03 09:26:21', '2025-06-03 09:26:21'),
(23, 'App\\Models\\Penitip', 1, 'ReUseMart', '7f60684df583f7d65d2e0d0a3fafcb98c88e02e7515e9dba6fc4b4b6e16c9308', '[\"*\"]', '2025-06-03 09:38:09', NULL, '2025-06-03 09:38:09', '2025-06-03 09:38:09'),
(24, 'App\\Models\\Penitip', 7, 'ReUseMart', 'b6c050aff81da97bd837d63d2594bdd60e1d761fdaa125ab72a160d4a4c02e80', '[\"*\"]', '2025-06-03 09:41:52', NULL, '2025-06-03 09:41:52', '2025-06-03 09:41:52'),
(25, 'App\\Models\\Penitip', 1, 'ReUseMart', '07c82350e870555d0860a40901208617868bf3bc124b8386ce1155a4ccc5ffdf', '[\"*\"]', '2025-06-03 10:11:17', NULL, '2025-06-03 10:11:17', '2025-06-03 10:11:17'),
(26, 'App\\Models\\Penitip', 7, 'ReUseMart', '1501ceb5c901c8c7f3cca59452b1490b55e309300dcfe45dc786956fbafc180a', '[\"*\"]', '2025-06-03 10:18:39', NULL, '2025-06-03 10:18:39', '2025-06-03 10:18:39'),
(27, 'App\\Models\\Penitip', 1, 'ReUseMart', '0016042ce10d8903b412ce9ff15ece6b2d0d175aad097716e97779cf89fe5d7c', '[\"*\"]', '2025-06-07 06:51:37', NULL, '2025-06-07 06:51:36', '2025-06-07 06:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id_rating` int(11) NOT NULL,
  `id_penitip` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id_rating`, `id_penitip`, `id_barang`, `id_pembeli`, `rating`) VALUES
(1, 8, 28, 18, 2),
(2, 4, 24, 11, 4),
(3, 4, 24, 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `request_donasi`
--

CREATE TABLE `request_donasi` (
  `id_request` int(11) NOT NULL,
  `id_organisasi` int(11) NOT NULL,
  `barang_dibutuhkan` varchar(255) NOT NULL,
  `status_request` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_donasi`
--

INSERT INTO `request_donasi` (`id_request`, `id_organisasi`, `barang_dibutuhkan`, `status_request`) VALUES
(11, 11, 'Pakaian anak-anak', 'Menunggu'),
(12, 11, 'Rak Buku Jati', 'Diterima'),
(13, 12, 'Alat bantu jalan', 'Menunggu'),
(14, 13, 'Skateboard Anak', 'Diterima'),
(15, 14, 'Pakaian remaja perempuan', 'Menunggu'),
(16, 15, 'Mainan edukatif', 'Ditolak'),
(17, 16, 'Sembako dan vitamin', 'Menunggu'),
(18, 17, 'Sepatu Boots Pria', 'Diterima'),
(19, 18, 'Peralatan kebersihan', 'Menunggu'),
(20, 20, 'Perlengkapan mandi', 'Menunggu'),
(21, 12, 'Jaket Olahraga Bekas', 'Diterima'),
(22, 14, 'Stroller Bekas', 'Diterima'),
(23, 16, 'Paket Kosmetik', 'Diterima'),
(24, 15, 'Setrika Listrik', 'Diterima'),
(25, 13, 'Boneka Anak', 'Diterima'),
(26, 18, 'Buku Pelajaran SMP', 'Diterima'),
(27, 17, 'Speaker Bluetooth Bekas', 'Diterima'),
(28, 16, 'Meja Belajar Anak', 'Menunggu'),
(29, 17, 'Mesin Cuci Mini', 'Diterima');

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `id_reward` int(11) NOT NULL,
  `id_merchandise` int(11) DEFAULT NULL,
  `id_pembeli` int(11) NOT NULL,
  `jenis_reward` varchar(255) NOT NULL,
  `jumlah_tukar_poin` int(11) NOT NULL,
  `tanggal_klaim` date NOT NULL,
  `tanggal_ambil` date DEFAULT NULL,
  `status_penukaran` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`id_reward`, `id_merchandise`, `id_pembeli`, `jenis_reward`, `jumlah_tukar_poin`, `tanggal_klaim`, `tanggal_ambil`, `status_penukaran`) VALUES
(1, 6, 11, 'Merchandise', 500, '2025-04-11', NULL, 0),
(2, NULL, 11, 'Diskon', 100, '2025-04-12', NULL, 0),
(3, 3, 12, 'Merchandise', 250, '2025-04-11', '2025-06-03', 1),
(4, NULL, 12, 'Diskon', 200, '2025-04-12', NULL, 1),
(5, 7, 13, 'Merchandise', 500, '2025-04-11', '2025-06-03', 1),
(6, 4, 14, 'Merchandise', 250, '2025-04-11', '2025-06-05', 1),
(7, NULL, 14, 'Diskon', 500, '2025-04-12', NULL, 0),
(8, 5, 16, 'Merchandise', 500, '2025-04-11', '2025-06-05', 1),
(9, NULL, 16, 'Diskon', 400, '2025-04-12', NULL, 1),
(10, 2, 17, 'Merchandise', 100, '2025-04-13', '2025-06-06', 1),
(11, 1, 20, 'Merchandise', 100, '2025-06-06', NULL, 0),
(12, 4, 20, 'Merchandise', 250, '2025-06-06', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0gn1NICjjvh66c2FoqNcQjgpKvHkvMfAoI5PGUhL', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWnZxbE5BUkZyWjFKTWNsZFBmWmRSbVl6NUQwaVVBc0ZLbjVjdFA1OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2ZpbGUvcGVtYmVsaSI7fXM6NTQ6ImxvZ2luX3BlbWJlbGlfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNzt9', 1749302072),
('1mVgAgTiOL3UEjqI7TyD45UV9asUhD1bRFRqhtt3', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibnh5M29XNE1EN3E5Q0V2b3lJUTFuNGlrTnU4elhNdnA1RnRDZk5ociI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQvb3duZXIiO31zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcHJvZmlsZS9wZW1iZWxpIjt9czo1NDoibG9naW5fcGVnYXdhaV81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1749302483),
('XcvnSWiiUMQ5xdbGFVxU2IJqnKLYLVa8rL8Cdyli', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia09NRVo3VUxIa282bnNBeEF2VjJLaFNCcHhsQ1RMS25Bd1JhQzNzYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlL3BlbWJlbGkiO31zOjU0OiJsb2dpbl9wZWdhd2FpXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1749302082);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `total_pembayaran` float NOT NULL,
  `status_transaksi` varchar(255) NOT NULL,
  `jenis_pengiriman` varchar(255) NOT NULL,
  `nomor_transaksi` varchar(255) DEFAULT NULL,
  `poin_didapat` int(11) NOT NULL,
  `id_alamat` int(11) DEFAULT NULL,
  `poin_digunakan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pembeli`, `tanggal_transaksi`, `total_pembayaran`, `status_transaksi`, `jenis_pengiriman`, `nomor_transaksi`, `poin_didapat`, `id_alamat`, `poin_digunakan`) VALUES
(11, 11, '2025-04-01 00:00:00', 430000, 'Lunas', '', '25.04.01', 43, 1, 0),
(12, 12, '2025-04-02 00:00:00', 80000, 'Menunggu Pembayaran', '', '25.04.02', 0, 3, 0),
(13, 13, '2025-04-03 00:00:00', 450000, 'Lunas', '', '25.04.03', 45, 4, 0),
(14, 14, '2025-04-04 00:00:00', 80000, 'Dibatalkan', '', '25.04.04', 0, 7, 0),
(15, 16, '2025-04-05 00:00:00', 350000, 'Lunas', '', '25.04.05', 35, 9, 0),
(16, 17, '2025-04-06 00:00:00', 700000, 'Menunggu Pembayaran', '', '25.04.06', 0, 11, 0),
(17, 18, '2025-04-07 00:00:00', 680000, 'Lunas', '', '25.04.07', 68, 12, 0),
(18, 20, '2025-04-08 00:00:00', 80000, 'Dibatalkan', '', '25.04.08', 0, 14, 0),
(19, 11, '2025-04-09 00:00:00', 450000, 'Lunas', '', '25.04.09', 45, 1, 0),
(20, 14, '2025-04-10 00:00:00', 350000, 'Menunggu Pembayaran', '', '25.04.010', 0, 7, 0),
(21, 11, '2025-04-11 00:00:00', 230000, 'Lunas', '', '25.04.011', 23, 1, 0),
(22, 12, '2025-04-12 00:00:00', 175000, 'Lunas', '', '25.04.012', 18, 3, 0),
(23, 13, '2025-04-13 00:00:00', 255000, 'Lunas', '', '25.04.013', 26, 4, 0),
(24, 14, '2025-04-14 00:00:00', 280000, 'Lunas', '', '25.04.014', 28, 7, 0),
(25, 16, '2025-04-15 00:00:00', 300000, 'Lunas', '', '25.04.015', 30, 9, 0),
(26, 17, '2025-04-16 00:00:00', 230000, 'Lunas', '', '25.04.016', 23, 11, 0),
(27, 18, '2025-04-17 00:00:00', 225000, 'Lunas', '', '25.04.017', 22, 12, 0),
(28, 20, '2025-04-18 00:00:00', 350000, 'Lunas', '', '25.04.018', 35, 14, 0),
(38, 11, '2025-03-13 18:01:31', 450000, 'Transaksi Selesai', 'Ambil Sendiri', '25.03.21', 45, 1, 0),
(39, 12, '2025-03-22 18:02:48', 2800000, 'Transaksi Selesai', 'Ambil Sendiri', '25.03.22', 280, 3, 0),
(40, 13, '2025-04-02 18:03:47', 600000, 'Transaksi Selesai', 'Ambil Sendiri', '25.04.23', 60, 4, 0),
(41, 14, '2025-04-29 18:04:40', 500000, 'Transaksi Selesai', 'Ambil Sendiri', '25.04.24', 50, 7, 0),
(42, 16, '2025-03-23 18:08:02', 2000000, 'Transaksi Selesai', 'Ambil Sendiri', '25.03.25', 200, 9, 0),
(43, 17, '2025-04-20 18:08:53', 350000, 'Transaksi Selesai', 'Ambil Sendiri', '25.04.26', 35, 11, 0),
(44, 18, '2025-04-14 18:09:54', 250000, 'Transaksi Selesai', 'Ambil Sendiri', '25.04.27', 25, 12, 0),
(45, 20, '2025-04-17 18:10:29', 150000, 'Transaksi Selesai', 'Ambil Sendiri', '25.04.28', 15, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alamat_pembeli`
--
ALTER TABLE `alamat_pembeli`
  ADD PRIMARY KEY (`id_alamat_pembeli`),
  ADD KEY `fk_alamat_pembeli` (`id_pembeli`);

--
-- Indexes for table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id_badge`),
  ADD KEY `fk_badge_penitip` (`id_penitip`);

--
-- Indexes for table `barang_titipan`
--
ALTER TABLE `barang_titipan`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_barang_penitip` (`id_penitip`),
  ADD KEY `fk_barang_pegawai` (`id_pegawai`),
  ADD KEY `fk_barang_kategori` (`id_kategori`),
  ADD KEY `fk_barang_hunter` (`id_hunter`),
  ADD KEY `fk_barang_qc` (`id_qc_pegawai`),
  ADD KEY `fk_nota_penitipan` (`id_nota`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  ADD KEY `fk_detail_keranjang` (`id_keranjang`),
  ADD KEY `fk_detail_barang` (`id_barang`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `fk_detailTrans_barang` (`id_barang`),
  ADD KEY `fk_detailTrans_transaksi` (`id_transaksi`);

--
-- Indexes for table `diskusi_produk`
--
ALTER TABLE `diskusi_produk`
  ADD PRIMARY KEY (`id_diskusi`),
  ADD KEY `fk_diskusi_pembeli` (`id_pembeli`),
  ADD KEY `fk_diskusi_pegawai` (`id_pegawai`),
  ADD KEY `fk_diskusi_barang` (`id_barang`);

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD KEY `fk_donasi_request` (`id_request`),
  ADD KEY `fk_donasi_barang` (`id_barang`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `foto_barang`
--
ALTER TABLE `foto_barang`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_foto_barang` (`id_barang`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_keranjang_pembeli` (`id_pembeli`);

--
-- Indexes for table `komisi`
--
ALTER TABLE `komisi`
  ADD PRIMARY KEY (`id_komisi`),
  ADD KEY `fk_komisi_pegawai` (`id_pegawai`),
  ADD KEY `fk_komisi_penitip` (`id_penitip`),
  ADD KEY `fk_komisi_transaksi` (`id_transaksi`),
  ADD KEY `fk_komisi_barang` (`id_barang`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`id_merchandise`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nota_penitipan`
--
ALTER TABLE `nota_penitipan`
  ADD PRIMARY KEY (`id_nota`),
  ADD UNIQUE KEY `no_nota` (`no_nota`),
  ADD KEY `fk_penitip` (`id_penitip`),
  ADD KEY `fk_qc` (`id_qc_pegawai`);

--
-- Indexes for table `organisasi`
--
ALTER TABLE `organisasi`
  ADD PRIMARY KEY (`id_organisasi`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `fk_jabatan_pegawai` (`id_jabatan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_pembayaran_pembeli` (`id_pembeli`),
  ADD KEY `fk_pembayaran_pegawai` (`id_pegawai`),
  ADD KEY `fk_pembayaran_transaksi` (`id_transaksi`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `fk_pengiriman_pegawai` (`id_pegawai`),
  ADD KEY `fk_pengiriman_jadwal` (`id_jadwal`);

--
-- Indexes for table `penitip`
--
ALTER TABLE `penitip`
  ADD PRIMARY KEY (`id_penitip`);

--
-- Indexes for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_jadwal_transaksi` (`id_transaksi`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `fk_rating_penitip` (`id_penitip`),
  ADD KEY `fk_rating_barang` (`id_barang`),
  ADD KEY `fk_rating_pembeli` (`id_pembeli`);

--
-- Indexes for table `request_donasi`
--
ALTER TABLE `request_donasi`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `fk_request_organisasi` (`id_organisasi`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id_reward`),
  ADD KEY `fk_merchandise_reward` (`id_merchandise`),
  ADD KEY `fk_merchandise_pembeli` (`id_pembeli`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_pembeli` (`id_pembeli`),
  ADD KEY `fk_transaksi_alamat` (`id_alamat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alamat_pembeli`
--
ALTER TABLE `alamat_pembeli`
  MODIFY `id_alamat_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `badge`
--
ALTER TABLE `badge`
  MODIFY `id_badge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `barang_titipan`
--
ALTER TABLE `barang_titipan`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `diskusi_produk`
--
ALTER TABLE `diskusi_produk`
  MODIFY `id_diskusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_barang`
--
ALTER TABLE `foto_barang`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `komisi`
--
ALTER TABLE `komisi`
  MODIFY `id_komisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `id_merchandise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nota_penitipan`
--
ALTER TABLE `nota_penitipan`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `organisasi`
--
ALTER TABLE `organisasi`
  MODIFY `id_organisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `penitip`
--
ALTER TABLE `penitip`
  MODIFY `id_penitip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request_donasi`
--
ALTER TABLE `request_donasi`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat_pembeli`
--
ALTER TABLE `alamat_pembeli`
  ADD CONSTRAINT `fk_alamat_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `badge`
--
ALTER TABLE `badge`
  ADD CONSTRAINT `fk_badge_penitip` FOREIGN KEY (`id_penitip`) REFERENCES `penitip` (`id_penitip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_titipan`
--
ALTER TABLE `barang_titipan`
  ADD CONSTRAINT `fk_barang_hunter` FOREIGN KEY (`id_hunter`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_barang_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_barang_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_barang_penitip` FOREIGN KEY (`id_penitip`) REFERENCES `penitip` (`id_penitip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_barang_qc` FOREIGN KEY (`id_qc_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nota_penitipan` FOREIGN KEY (`id_nota`) REFERENCES `nota_penitipan` (`id_nota`);

--
-- Constraints for table `detail_keranjang`
--
ALTER TABLE `detail_keranjang`
  ADD CONSTRAINT `fk_detail_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detail_keranjang` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id_keranjang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `fk_detailTrans_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_detailTrans_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `diskusi_produk`
--
ALTER TABLE `diskusi_produk`
  ADD CONSTRAINT `fk_diskusi_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diskusi_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_diskusi_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donasi`
--
ALTER TABLE `donasi`
  ADD CONSTRAINT `fk_donasi_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_donasi_request` FOREIGN KEY (`id_request`) REFERENCES `request_donasi` (`id_request`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_barang`
--
ALTER TABLE `foto_barang`
  ADD CONSTRAINT `fk_foto_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `fk_keranjang_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komisi`
--
ALTER TABLE `komisi`
  ADD CONSTRAINT `fk_komisi_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_komisi_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_komisi_penitip` FOREIGN KEY (`id_penitip`) REFERENCES `penitip` (`id_penitip`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_komisi_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nota_penitipan`
--
ALTER TABLE `nota_penitipan`
  ADD CONSTRAINT `fk_penitip` FOREIGN KEY (`id_penitip`) REFERENCES `penitip` (`id_penitip`),
  ADD CONSTRAINT `fk_qc` FOREIGN KEY (`id_qc_pegawai`) REFERENCES `pegawai` (`id_pegawai`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_jabatan_pegawai` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pembayaran_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD CONSTRAINT `fk_pengiriman_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `penjadwalan` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengiriman_pegawai` FOREIGN KEY (`Id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjadwalan`
--
ALTER TABLE `penjadwalan`
  ADD CONSTRAINT `fk_jadwal_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fk_rating_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang_titipan` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rating_penitip` FOREIGN KEY (`id_penitip`) REFERENCES `penitip` (`id_penitip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request_donasi`
--
ALTER TABLE `request_donasi`
  ADD CONSTRAINT `fk_request_organisasi` FOREIGN KEY (`id_organisasi`) REFERENCES `organisasi` (`id_organisasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reward`
--
ALTER TABLE `reward`
  ADD CONSTRAINT `fk_merchandise_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_merchandise_reward` FOREIGN KEY (`id_merchandise`) REFERENCES `merchandise` (`id_merchandise`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_alamat` FOREIGN KEY (`id_alamat`) REFERENCES `alamat_pembeli` (`id_alamat_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_transaksi_pembeli` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
