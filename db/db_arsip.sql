-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 11:31 PM
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
-- Database: `db_arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', '1471275613_Screen Shot 2019-10-11 at 16.26.42.png');

-- --------------------------------------------------------

--
-- Table structure for table `arsip`
--

CREATE TABLE `arsip` (
  `arsip_id` int(11) NOT NULL,
  `arsip_waktu_upload` datetime NOT NULL,
  `arsip_petugas` int(11) NOT NULL,
  `arsip_kode` varchar(255) NOT NULL,
  `arsip_nama` varchar(255) NOT NULL,
  `arsip_jenis` varchar(255) NOT NULL,
  `arsip_kategori` int(11) NOT NULL,
  `arsip_keterangan` text NOT NULL,
  `arsip_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `arsip`
--

INSERT INTO `arsip` (`arsip_id`, `arsip_waktu_upload`, `arsip_petugas`, `arsip_kode`, `arsip_nama`, `arsip_jenis`, `arsip_kategori`, `arsip_keterangan`, `arsip_file`) VALUES
(8, '2019-10-12 17:05:22', 10, 'MN-006', 'SPK Kontrak Jembatan', 'pdf', 6, 'Surat SPK Kontrak Jembatan Layang', '106615077_sample-link_1.pdf'),
(9, '2019-10-12 17:06:55', 10, 'MN-008', 'Contoh Curiculum Vitae Untuk Lamaran Kerja', 'pdf', 10, 'Contoh Curiculum Vitae Untuk Lamaran Kerja untuk pegawai baru', '927990343_pdf-sample(1).pdf'),
(10, '2019-10-12 17:07:30', 11, 'MN-009', 'Surat Cuti Sakit Pegawai', 'pdf', 7, 'Contoh Surat Cuti Sakit Pegawai baru', '2071946811_PEMBUATAN FILE PDF_FNH_tamim (1).pdf'),
(11, '2021-11-11 22:24:34', 10, 'ARS1', 'Surat Lampiran Skripsi', 'pdf', 8, 'Surat Lampiran Skripsi', '1492354991_Contoh Surat Lampiran Skripsi.pdf'),
(13, '2024-07-08 03:04:01', 10, '04.01.01.05', 'arsip kegiatan', 'pdf', 11, 'Arsip 2024', '1019872630_arsip_kegiatan (1).pdf'),
(15, '2024-07-10 20:12:54', 10, '04.02.01.02', 'arsip kegiatan', 'pdf', 11, 'arsip 2024', '233007229_arsip_kegiatan2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `arsip_kegiatan`
--

CREATE TABLE `arsip_kegiatan` (
  `id_arsip_kegiatan` int(11) NOT NULL,
  `no_reg` varchar(100) DEFAULT NULL,
  `id_kegiatan` int(11) DEFAULT NULL,
  `no_box` varchar(50) DEFAULT NULL,
  `nama_sub_kegiatan` varchar(100) DEFAULT NULL,
  `nama_pekerjaan` varchar(100) DEFAULT NULL,
  `alamat_pekerjaan` varchar(255) DEFAULT NULL,
  `cara_pembayaran` varchar(50) DEFAULT NULL,
  `no_kontrak` varchar(100) DEFAULT NULL,
  `tgl_kontrak` date DEFAULT NULL,
  `no_basthp` varchar(50) DEFAULT NULL,
  `nilai_kontrak` varchar(50) DEFAULT NULL,
  `lama_pekerjaan` varchar(50) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `id_penyedia` int(11) DEFAULT NULL,
  `nilai_realisasi` decimal(15,2) DEFAULT NULL,
  `ppn` decimal(15,2) DEFAULT NULL,
  `pph_21` decimal(15,2) DEFAULT NULL,
  `pph_22` decimal(15,2) DEFAULT NULL,
  `pph_23` decimal(15,2) DEFAULT NULL,
  `pph_4_2` decimal(15,2) DEFAULT NULL,
  `denda_keterlambatan` decimal(15,2) DEFAULT NULL,
  `no_spp` varchar(50) DEFAULT NULL,
  `tgl_spp` date DEFAULT NULL,
  `no_spm` varchar(50) DEFAULT NULL,
  `tgl_spm` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arsip_kegiatan`
--

INSERT INTO `arsip_kegiatan` (`id_arsip_kegiatan`, `no_reg`, `id_kegiatan`, `no_box`, `nama_sub_kegiatan`, `nama_pekerjaan`, `alamat_pekerjaan`, `cara_pembayaran`, `no_kontrak`, `tgl_kontrak`, `no_basthp`, `nilai_kontrak`, `lama_pekerjaan`, `tgl_mulai`, `tgl_selesai`, `id_penyedia`, `nilai_realisasi`, `ppn`, `pph_21`, `pph_22`, `pph_23`, `pph_4_2`, `denda_keterlambatan`, `no_spp`, `tgl_spp`, `no_spm`, `tgl_spm`, `keterangan`, `tgl_input`) VALUES
(25, '1', 16, '1', 'KOORDINASI DAN PELAKSANAAN SISTEM INFORMASI KEPAGAWAIAN', 'PEMBAYARAN BULAN 5 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.001A/SEK-PERKIM-1/2022', '2024-03-01', '600/BASTP.01.03/SEK-PERKIM.1/2022', '68629000', '12 BULAN', '2024-03-01', '2025-07-11', 4, 6239000.00, 0.00, 311950.00, 0.00, 0.00, 0.00, 0.00, '931/000375/SPP-LS/DPRKP/2024', '2024-06-21', '931/000375/SPM-LS/DPRKP/2024', '2024-06-21', '', '2024-07-09 06:42:36'),
(26, '2', 16, '1', 'PENINGKATAN SARANA DAN PRASARANA DISIPLIN PEGAWAI', 'PEMBAYARAN BULAN 3 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.031/SEK-PERKIM.1/2022', '2024-01-03', '600/BASTP.03.2/SEK-PERKIM,1/2022', '49912000', '8 BULAN', '2024-01-03', '2024-10-31', 5, 6239000.00, 311950.00, 0.00, 0.00, 0.00, 0.00, 0.00, '931/000354/SPP-LS/DPRKP/2024', '2024-06-17', '931/000354/SPM-LS/DPRKP/2024', '2024-06-17', '', '2024-07-09 04:42:00'),
(27, '3', 16, '1', 'PENINGKATAN SARANA DAN PRASARANA DISIPLIN PEGAWAI', 'PEMBAYARAN BULAN 4 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.031/SEK-PERKIM.1/2022', '2024-01-03', '600/BASTP.04.2/SEK-PERKIM.1/2022', '49912000', '8 BULAN', '2024-02-28', '2024-10-31', 5, 6239000.00, 0.00, 311950.00, 0.00, 0.00, 0.00, 0.00, '931/000599/SPP-LS/DPRKP/2024', '2024-07-17', '931/000599/SP-LS/DPRKP/2024', '2024-07-18', '', '2024-07-09 04:43:12'),
(28, '4', 16, '1', 'KOORDINASI DAN PELAKSANAAN SISTEM INFORMASI KEPAGAWAIAN', 'PEMBAYARAN BULAN 3 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.001A/SEK-PERKIM-1/2022', '2024-03-01', '600/BASTP.01.02/SEK-PERKIM.1/2022', '68629000', '12 BULAN', '2024-01-03', '2024-11-30', 4, 6239000.00, 0.00, 311950.00, 0.00, 0.00, 0.00, 0.00, '931/000094/SPP-LS/DPRKP/2024', '2024-04-11', '931/000094/SPM-LS/DPRKP/2024', '0224-04-11', '', '2024-07-10 15:39:35'),
(29, '5', 16, '1', 'KOORDINASI DAN PELAKSANAAN SISTEM INFORMASI KEPAGAWAIAN', 'PEMBAYARAN BULAN 6 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.001A/SEK-PERKIM-1/2022', '2024-01-03', '600/BASTP.01.06/SEK-PERKIM,1/2022', '68629000', '12 BULAN', '2024-01-03', '2024-11-30', 4, 6239000.00, 0.00, 311950.00, 0.00, 0.00, 0.00, 0.00, '931/000602/SPP-LS/DPRKP/2024', '2024-07-18', '931/000602/SPM-LS/DPRKP/2024', '2024-07-18', '', '2024-07-09 05:10:32'),
(31, '7', 16, '1', 'KOORDINASI DAN PELAKSANAAN SISTEM INFORMASI KEPAGAWAIAN', 'PEMBAYARAN BULAN 1 & 2 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN ', 'PROVINSI BANTEN', 'transfer', '600/SPK.001A/SEK-PERKIM-1/2022', '2024-01-03', '600/BASTP.01.01/SEK-PERKIM,1/2022', '68629000', '12 BULAN', '2024-01-03', '2024-11-30', 4, 12478000.00, 0.00, 623900.00, 0.00, 0.00, 0.00, 0.00, '931/000093/SPP-LS/DPRKP/2024', '2024-05-28', '931/000093/SPM-LS/DPRKP/2024', '2024-03-28', '', '2024-07-09 06:24:09'),
(33, '9', 16, '1', 'PENINGKATAN SARANA DAN PRASARANA DISIPLIN PEGAWAI', 'PEMBAYARAN BULAN 5 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.031/SEK-PERKIM.1/2022', '2024-03-01', '600/BASTP.05.2/SEK-PERKIM.1/2022', '49912000', '8 BULAN', '2024-03-01', '2024-10-31', 5, 6239000.00, 0.00, 311950.00, 0.00, 0.00, 0.00, 0.00, '931/001146/SPP-LS/DPRKP/2024', '2024-08-25', '931/001146/SPM-LS/DPRKP/2024', '2024-08-25', '', '2024-07-09 06:30:46'),
(34, '10', 16, '1', 'KOORDINASI DAN PELAKSANAAN SISTEM INFORMASI KEPAGAWAIAN', 'PEMBAYARAN BULAN 7 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/SPK.001A/SEK-PERKIM-1/2022', '2024-01-03', '600/BASTP.01.07/SEK-PERKIM.1/2022', '68629000', '12 BULAN', '2024-01-03', '2024-11-30', 4, 6239000.00, 311950.00, 0.00, 0.00, 0.00, 0.00, 0.00, '931/001145/SPP-LS/DPRKP/2024', '2024-04-20', '931/001145/SPM-LS/DPRKP/2024', '2024-08-24', '', '2024-07-09 06:33:17'),
(35, '1', 16, '1', 'KOORDINASI DAN PELAKSANAAN SISTEM INFORMASI KEPAGAWAIAN', 'PEMBAYARAN BULAN 5 PEK B.JASA KONSULTASI BERORIENTASI LAYANAN-JASA STUDI PENELITIAN DAN BANTUAN TEKN', 'PROVINSI BANTEN', 'transfer', '600/BASTP.01.03/SEK-PERKIM.1/202', '2024-07-17', 'sfd', '222222', '1 bulan', '2024-07-11', '2024-07-26', 3, 234244.00, 0.00, 211331.00, 0.00, 0.00, 0.00, 0.00, '931/000375/SPP-LS/DPRKP/2022', '2024-07-25', '931/000354/SPM-LS/DPRKP/2024', '2024-07-18', '', '2024-07-10 13:04:58'),
(36, 'NOREG240001', 16, '2', 'PENYELENGGARAAN PENATAAN BANGUNAN ', 'PENYELENGGARAAN PENATAAN BANGUNAN ', 'Serang', 'TRANSFER', '600/SPK.54.02/ PERKIM-4/2022 ', '2024-07-10', '027/BASTP10/INFRAS/DPRKP/ 2024', '123', '5 Bulan', '2024-02-12', '2024-02-21', 3, 123.00, 123.00, 123.00, 123.00, 123.00, 123.00, 200000.00, 'ASHD/123213/2025', '2024-02-12', '931/000886/SPP-LS/DPRKP/2022', '2024-07-10', 'CEK INSERT', '2024-07-10 15:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL,
  `kategori_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`, `kategori_keterangan`) VALUES
(1, 'Tidak berkategori', 'Semua yang tidak memiliki kategori'),
(3, 'Surat Keputusan', 'Format arsip untuk surat keputusan\r\n'),
(4, 'Surat Izin Pelaksanaan', 'Contoh format surat izin pelaksaan pekerjaan'),
(5, 'Surat Perintah Kerja Proyek jalan', 'Contoh format surat perintah untuk pekerjaan proyek jalan'),
(6, 'Surat Perintah Kerja Proyek Jembatan', 'Contoh format untuk surat perintah kerja proyek jembatan'),
(7, 'Surat Kesehatan Pegawai', 'Surat kesehatan untuk pegawai'),
(11, 'ARSIP 2024', 'Kegiatan Arsip 2024');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `kode_kegiatan` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kode_kegiatan`, `nama_kegiatan`) VALUES
(16, 'KG240001', 'ADMINISTRASI KEPAGAWAIAN PERANGKAT DAERAH'),
(17, 'KG240002', 'pembangunan');

-- --------------------------------------------------------

--
-- Table structure for table `penyedia`
--

CREATE TABLE `penyedia` (
  `id_penyedia` int(11) NOT NULL,
  `kode_penyedia` varchar(50) DEFAULT NULL,
  `nama_penyedia` varchar(100) DEFAULT NULL,
  `nama_direktur` varchar(100) NOT NULL,
  `alamat_penyedia` varchar(255) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `no_rek_bank` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyedia`
--

INSERT INTO `penyedia` (`id_penyedia`, `kode_penyedia`, `nama_penyedia`, `nama_direktur`, `alamat_penyedia`, `npwp`, `nama_bank`, `no_rek_bank`) VALUES
(3, 'PY240001', 'MOH. PITRA RACHMATULLOH, SH ', 'MOH. PITRA RACHMATULLOH, SH AJKSDHSA', 'Serang', '90.631.227.7-401.000', 'BANTEN, CABANG PALIMA', '0886066309'),
(4, 'PY240002', 'YUNIAR RASMAWAN,SP', 'YUNIAR RASMAWAN,SP', 'TAMAN GRAHA ASRI BLOK I2 NO.2 RT/RW.07/19 SERANG\r\n', '34.657.354.6-401.000', 'BANTEN, CABANG KHUSUS SERANG', '0806354686'),
(5, 'PY240003', 'FUJI YUNITA SARI,S.AP', 'FUJI YUNITA SARI,S.AP', 'KP. SALABENTAR RT.004 RW.006 CILAJA MAJASARI KAB. PANDEGLANG\r\n', '85.6000.139.1-419.000', 'BANTEN, CABANG PANDEGLANG', '0836055641');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `petugas_id` int(11) NOT NULL,
  `petugas_nama` varchar(255) NOT NULL,
  `petugas_username` varchar(255) NOT NULL,
  `petugas_password` varchar(255) NOT NULL,
  `petugas_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`petugas_id`, `petugas_nama`, `petugas_username`, `petugas_password`, `petugas_foto`) VALUES
(10, 'M BAGAS PARMANA', 'bagas', '202cb962ac59075b964b07152d234b70', ''),
(11, 'raya', 'raya', '202cb962ac59075b964b07152d234b70', '');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `riwayat_id` int(11) NOT NULL,
  `riwayat_waktu` datetime NOT NULL,
  `riwayat_user` int(11) NOT NULL,
  `riwayat_arsip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`riwayat_id`, `riwayat_waktu`, `riwayat_user`, `riwayat_arsip`) VALUES
(1, '2019-10-11 15:32:29', 8, 3),
(2, '2019-10-12 17:09:31', 8, 10),
(3, '2019-10-12 17:09:45', 8, 9),
(4, '2019-10-12 17:09:50', 8, 8),
(5, '2019-10-12 17:09:53', 8, 3),
(6, '2019-10-12 17:10:07', 9, 10),
(7, '2019-10-12 17:10:16', 9, 9),
(8, '2019-10-12 17:10:19', 9, 8),
(9, '2019-10-12 17:10:22', 9, 6),
(10, '2019-10-12 17:10:26', 9, 2),
(11, '2021-11-11 22:25:05', 13, 11),
(12, '2024-07-03 12:37:32', 16, 12),
(13, '2024-07-10 20:14:28', 1, 15),
(17, '2024-07-10 21:43:30', 16, 14),
(18, '2024-07-10 21:43:39', 16, 13),
(19, '2024-07-11 00:10:29', 1, 13),
(20, '2024-07-11 00:13:51', 1, 15),
(21, '2024-07-11 00:14:36', 17, 15),
(22, '2024-07-11 00:16:59', 17, 15),
(23, '2024-07-11 00:17:18', 1, 15),
(24, '2024-07-11 00:17:46', 1, 15),
(25, '2024-07-11 00:18:49', 1, 13),
(26, '2024-07-11 00:19:44', 1, 15),
(27, '2024-07-11 00:21:10', 1, 13),
(28, '2024-07-11 00:21:25', 1, 15),
(29, '2024-07-11 00:25:01', 1, 15),
(30, '2024-07-11 00:26:46', 1, 15),
(31, '2024-07-11 00:28:58', 1, 15),
(32, '2024-07-11 00:30:35', 1, 15),
(33, '2024-07-11 00:33:18', 1, 15),
(34, '2024-07-11 00:34:46', 1, 15),
(35, '2024-07-11 00:49:51', 1, 15),
(36, '2024-07-11 00:53:33', 1, 15),
(37, '2024-07-11 00:54:14', 1, 15),
(38, '2024-07-11 00:58:33', 1, 15),
(39, '2024-07-11 01:01:37', 1, 15),
(40, '2024-07-11 01:03:10', 1, 15),
(41, '2024-07-11 01:03:27', 1, 15),
(42, '2024-07-11 01:04:15', 1, 15),
(43, '2024-07-11 01:09:10', 1, 15),
(44, '2024-07-11 01:09:30', 1, 15),
(45, '2024-07-11 01:10:17', 1, 14),
(46, '2024-07-11 01:10:29', 1, 15),
(47, '2024-07-11 01:10:33', 1, 13),
(48, '2024-07-11 01:13:05', 17, 15),
(49, '2024-07-11 02:29:46', 1, 15),
(50, '2024-07-11 02:37:02', 10, 15);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_preview`
--

CREATE TABLE `riwayat_preview` (
  `riwayat_preview_id` int(11) NOT NULL,
  `riwayat_preview_waktu` datetime NOT NULL,
  `riwayat_user` int(11) NOT NULL,
  `riwayat_arsip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_preview`
--

INSERT INTO `riwayat_preview` (`riwayat_preview_id`, `riwayat_preview_waktu`, `riwayat_user`, `riwayat_arsip`) VALUES
(1, '2024-07-03 14:27:32', 1, 12),
(2, '2024-07-03 14:27:49', 1, 12),
(5, '2024-07-03 14:39:56', 1, 12),
(6, '2024-07-03 14:40:11', 1, 12),
(9, '2024-07-03 15:40:24', 15, 12),
(10, '2024-07-03 15:41:20', 15, 10),
(11, '2024-07-03 15:41:36', 15, 12),
(12, '2024-07-03 15:41:48', 15, 3),
(13, '2024-07-03 15:42:21', 15, 9),
(14, '2024-07-03 16:10:23', 15, 8),
(16, '2024-07-03 16:39:58', 8, 12),
(17, '2024-07-03 16:57:03', 8, 12),
(18, '2024-07-03 17:04:13', 16, 12),
(25, '2024-07-10 23:35:36', 1, 15),
(26, '2024-07-10 23:40:23', 10, 15),
(27, '2024-07-10 23:41:23', 10, 13),
(28, '2024-07-10 23:43:31', 10, 14),
(29, '2024-07-10 23:44:23', 1, 13),
(30, '2024-07-10 23:45:25', 1, 13),
(31, '2024-07-10 23:45:34', 1, 14),
(32, '2024-07-11 00:25:24', 1, 13),
(33, '2024-07-11 00:29:37', 1, 13),
(34, '2024-07-11 01:00:24', 1, 14),
(35, '2024-07-11 02:30:41', 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(16, 'bagas', 'bagas', '202cb962ac59075b964b07152d234b70', ''),
(17, 'nazil', 'nazil', '202cb962ac59075b964b07152d234b70', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`arsip_id`);

--
-- Indexes for table `arsip_kegiatan`
--
ALTER TABLE `arsip_kegiatan`
  ADD PRIMARY KEY (`id_arsip_kegiatan`) USING BTREE,
  ADD KEY `id_kegiatan` (`id_kegiatan`),
  ADD KEY `id_penyedia` (`id_penyedia`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `penyedia`
--
ALTER TABLE `penyedia`
  ADD PRIMARY KEY (`id_penyedia`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`petugas_id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`riwayat_id`);

--
-- Indexes for table `riwayat_preview`
--
ALTER TABLE `riwayat_preview`
  ADD PRIMARY KEY (`riwayat_preview_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arsip`
--
ALTER TABLE `arsip`
  MODIFY `arsip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `arsip_kegiatan`
--
ALTER TABLE `arsip_kegiatan`
  MODIFY `id_arsip_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penyedia`
--
ALTER TABLE `penyedia`
  MODIFY `id_penyedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `petugas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `riwayat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `riwayat_preview`
--
ALTER TABLE `riwayat_preview`
  MODIFY `riwayat_preview_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arsip_kegiatan`
--
ALTER TABLE `arsip_kegiatan`
  ADD CONSTRAINT `arsip_kegiatan_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `arsip_kegiatan_ibfk_2` FOREIGN KEY (`id_penyedia`) REFERENCES `penyedia` (`id_penyedia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
