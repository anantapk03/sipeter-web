-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2024 pada 15.51
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipeter-web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `access_features`
--

CREATE TABLE `access_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idDivisi` bigint(20) UNSIGNED NOT NULL,
  `idUser` bigint(20) UNSIGNED NOT NULL,
  `isLeader` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `access_features`
--

INSERT INTO `access_features` (`id`, `idDivisi`, `idUser`, `isLeader`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, NULL, NULL),
(2, 1, 1, 0, '2024-09-22 02:17:35', '2024-09-22 02:17:47'),
(3, 3, 1, 0, '2024-09-22 02:20:26', '2024-09-22 02:20:26'),
(4, 2, 1, 0, '2024-09-25 06:40:56', '2024-09-25 06:40:56'),
(5, 4, 1, 0, '2024-09-29 07:13:17', '2024-09-29 07:13:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `category_p2`
--

CREATE TABLE `category_p2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaCategory` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `category_p2`
--

INSERT INTO `category_p2` (`id`, `namaCategory`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Menular', 'Kategori Program Pengendalian Penyakit Menular', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 'Tidak Menular', 'Kategori Program Pengendalian Penyakit Tidak Menular', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ukbm`
--

CREATE TABLE `data_ukbm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idDesa` bigint(20) UNSIGNED NOT NULL,
  `idJenisUkbm` bigint(20) UNSIGNED NOT NULL,
  `namaUkbm` varchar(255) NOT NULL,
  `alamatUkbm` varchar(255) NOT NULL,
  `sumberPembiayaan` varchar(255) NOT NULL,
  `kegiatanUkbm` varchar(255) NOT NULL,
  `jumlahKader` int(11) NOT NULL,
  `jumlahKaderDilatih` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_ukbm`
--

INSERT INTO `data_ukbm` (`id`, `idDesa`, `idJenisUkbm`, `namaUkbm`, `alamatUkbm`, `sumberPembiayaan`, `kegiatanUkbm`, `jumlahKader`, `jumlahKaderDilatih`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Posyandu', 'Indramayu', 'Dana Desa', 'Pemeriksaan balita', 5, 10, 'active', '2024-10-07 13:07:23', '2024-10-07 13:07:23'),
(2, 2, 2, 'Polindes', 'Indramayu', 'Dana Desa', 'Pemeriksaan Masyarakat', 5, 10, 'active', '2024-10-07 13:07:23', '2024-10-07 13:07:23'),
(3, 3, 5, 'Pos Obat Desa', 'Indramayu', 'Dana Desa', 'Pengambilan Obat', 5, 10, 'active', '2024-10-07 13:07:23', '2024-10-07 13:07:23'),
(4, 4, 3, 'PosKesDes', 'Indramayu', 'Dana Desa', 'Pemeriksaan Masyarakat', 5, 10, 'active', '2024-10-07 13:07:23', '2024-10-07 13:07:23'),
(5, 5, 4, 'Dana Sehat', 'Indramayu', 'Dana Desa', 'Edukasi Kesehatan', 5, 10, 'active', '2024-10-07 13:07:23', '2024-10-07 13:07:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaDivisi` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id`, `namaDivisi`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'promosi-kesehatan', 'Divisi yang bertugas untuk mempromosikan kesehatan masyarakat.', 1, '2024-09-22 02:14:14', '2024-09-22 02:14:14'),
(2, 'kesehatan-lingkungan', 'Divisi yang fokus pada kesehatan lingkungan seperti sanitasi dan air bersih.', 1, '2024-09-22 02:14:14', '2024-09-22 02:14:14'),
(3, 'kesehatan-ibu-anak-gizi', 'Divisi yang menangani kesehatan ibu, anak, dan gizi masyarakat.', 1, '2024-09-22 02:14:14', '2024-09-22 02:14:14'),
(4, 'pencegahan-dan-pengendalian-penyakit', 'Divisi yang bertugas mencegah dan mengendalikan penyakit menular.', 1, '2024-09-22 02:14:14', '2024-09-22 02:14:14'),
(5, 'admin', 'Divisi administratif untuk mendukung operasional seluruh program.', 1, '2024-09-22 02:14:14', '2024-09-22 02:14:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jenis_imunisasi_baduta`
--

CREATE TABLE `jenis_imunisasi_baduta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaImunisasi` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_imunisasi_baduta`
--

INSERT INTO `jenis_imunisasi_baduta` (`id`, `namaImunisasi`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'DPT-HB-Hib4', 'DPT-HB-Hib4', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 'Campak 2', 'Campak 2', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_imunisasi_bayi`
--

CREATE TABLE `jenis_imunisasi_bayi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaImunisasi` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_imunisasi_bayi`
--

INSERT INTO `jenis_imunisasi_bayi` (`id`, `namaImunisasi`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'HBO<24 Jam', 'HBO<24 Jam', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(2, 'HBO 1-7 hari', 'HBO 1-7 hari', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(3, 'BCG', 'BCG', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(4, 'Polio 1', 'Polio 1', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(5, 'DPT-HB-Hib1', 'DPT-HB-Hib1', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(6, 'Polio 2', 'Polio 2', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(7, 'DPT-HB-Hib2', 'DPT-HB-Hib2', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(8, 'Polio 3', 'Polio 3', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(9, 'DPT-HB-Hib3', 'DPT-HB-Hib3', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(10, 'Polio 4', 'Polio 4', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(11, 'IPV', 'IPV', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(12, 'Campak / MR', 'Campak / MR', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06'),
(13, 'Imunisasi Dasar Lengkap', 'Imunisasi Dasar Lengkap', 1, '2024-10-06 23:42:06', '2024-10-06 23:42:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_imunisasi_wus`
--

CREATE TABLE `jenis_imunisasi_wus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaImunisasi` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_imunisasi_wus`
--

INSERT INTO `jenis_imunisasi_wus` (`id`, `namaImunisasi`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Tetanus Disease 1', 'Tetanus Disease 1', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 'Tetanus Disease 2', 'Tetanus Disease 2', 1, '2024-08-23 06:49:48', '2024-08-23 06:49:48'),
(3, 'Tetatus Disease 3', 'Tetatus Disease 3', 1, '2024-08-24 06:49:48', '2024-08-24 06:49:48'),
(4, 'Tetanus Disease 4', 'Tetanus Disease 4', 1, '2024-08-25 06:49:48', '2024-08-25 06:49:48'),
(5, 'Tetanus Disease 5', 'Tetanus Disease 5', 1, '2024-08-26 06:49:48', '2024-08-26 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_ukbm`
--

CREATE TABLE `jenis_ukbm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenisUkbm` varchar(50) NOT NULL,
  `bulanan` int(11) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahunan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_ukbm`
--

INSERT INTO `jenis_ukbm` (`id`, `jenisUkbm`, `bulanan`, `triwulan`, `semester`, `tahunan`, `created_at`, `updated_at`) VALUES
(1, 'Posyandu', 5, 10, 15, 20, '2024-10-07 06:22:38', '2024-10-07 06:22:38'),
(2, 'Polindes', 5, 10, 15, 20, '2024-10-07 06:22:38', '2024-10-07 06:22:38'),
(3, 'Poskesdes', 5, 10, 15, 20, '2024-10-07 06:22:38', '2024-10-07 06:22:38'),
(4, 'Pos Obat Desa', 5, 10, 15, 20, '2024-10-07 06:22:38', '2024-10-07 06:22:38'),
(5, 'Dana Sehat', 5, 10, 15, 20, '2024-10-07 06:22:38', '2024-10-07 06:22:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_kesling`
--

CREATE TABLE `kegiatan_kesling` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `bulanan` int(11) NOT NULL,
  `triwulan` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahunan` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_kesling`
--

INSERT INTO `kegiatan_kesling` (`id`, `kegiatan`, `deskripsi`, `bulanan`, `triwulan`, `semester`, `tahunan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'jumlah sarana air minum yang memiliki resiko tingkat rendah', 'Pemantauan jumlah sarana air minum', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 00:34:19'),
(2, 'jumlah sarana air minum yang memiliki resiko tingkat sedang', 'Pemantauan jumlah sarana air minum', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(3, 'jumlah sarana air minum yang memiliki resiko tingkat tinggi', 'Pemantauan jumlah sarana air minum', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(4, 'jumlah sarana air minum yang memiliki resiko tingkat amat tinggi', 'Pemantauan jumlah sarana air minum', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(5, 'jumlah tempat pengelolaan makanan (TPM) yang memenuhi syarat', 'Pemantauan jumlah tempat pengelola makanan', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(6, 'jumlah tempat pengelolaan makanan (TPM) yang memenuhi tidak syarat', 'Pemantauan jumlah tempat pengelola makanan', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(7, 'jumlah tempat tempat umum (TTU) yang memenuhi syarat', 'Pemantauan jumlah tempat tempat umum', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(8, 'jumlah tempat tempat umum (TTU) yang memenuhi tidak syarat', 'Pemantauan jumlah tempat tempat umum', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(9, 'jumlah rumah yang memenuhi syarat kesehatan', 'Pemantauan jumlah rumah yang sehat', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29'),
(10, 'jumlah rumah yang memenuhi tidak syarat kesehatan', 'Pemantauan jumlah rumah yang sehat', 2, 4, 8, 16, 'active', '2024-10-07 04:20:29', '2024-10-07 04:20:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_program_kesehatan_sekolahs`
--

CREATE TABLE `kegiatan_program_kesehatan_sekolahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaKegiatan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `targetBulanan` int(11) DEFAULT NULL,
  `targetTriwulan` int(11) DEFAULT NULL,
  `targetSemester` int(11) DEFAULT NULL,
  `targetTahunan` int(11) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_program_kesehatan_sekolahs`
--

INSERT INTO `kegiatan_program_kesehatan_sekolahs` (`id`, `namaKegiatan`, `deskripsi`, `targetBulanan`, `targetTriwulan`, `targetSemester`, `targetTahunan`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Jumlah sekolah yang mendapatkan penjaringan kesehatan', 'Jumlah sekolah yang mendapatkan penjaringan kesehatan', 10, 20, 30, 50, 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 'Jumlah peserta didik yang mendapatkan penjaringan kesehatan', 'Jumlah peserta didik yang mendapatkan penjaringan kesehatan', 10, 20, 30, 50, 1, '2024-08-23 06:49:48', '2024-08-23 06:49:48'),
(3, 'Jumlah anak pendidikan dasar (kelas 1-9) yang mendapatkan pelayanan kesehatan sesuat standar', 'Jumlah anak pendidikan dasar (kelas 1-9) yang mendapatkan pelayanan kesehatan sesuat standar', 10, 20, 30, 50, 1, '2024-08-24 06:49:48', '2024-08-24 06:49:48'),
(4, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Hipertensi', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Hipertensi', 10, 20, 30, 50, 1, '2024-08-25 06:49:48', '2024-08-25 06:49:48'),
(5, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Anemia Klinis', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Anemia Klinis', 10, 20, 30, 50, 1, '2024-08-26 06:49:48', '2024-08-26 06:49:48'),
(6, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Kurus dan sangat kurus', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Kurus dan sangat kurus', 10, 20, 30, 50, 1, '2024-08-27 06:49:48', '2024-08-27 06:49:48'),
(7, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Gemuk dan sangat gemuk', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Gemuk dan sangat gemuk', 10, 20, 30, 50, 1, '2024-08-28 06:49:48', '2024-08-28 06:49:48'),
(8, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Karies', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Karies', 10, 20, 30, 50, 1, '2024-08-29 06:49:48', '2024-08-29 06:49:48'),
(9, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Gangguan Pengelihatan', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Gangguan Pengelihatan', 10, 20, 30, 50, 1, '2024-08-30 06:49:48', '2024-08-30 06:49:48'),
(10, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Gangguan Pendengaran', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan Gangguan Pendengaran', 10, 20, 30, 50, 1, '2024-08-31 06:49:48', '2024-08-31 06:49:48'),
(11, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan dugaan IMS', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan dugaan IMS', 10, 20, 30, 50, 1, '2024-09-01 06:49:48', '2024-09-01 06:49:48'),
(12, 'Jumlah kasus yang ditemukan pada penjaringan kesehatan dugaan mengalami kekerasan seksual', 'Jumlah kasus yang ditemukan pada penjaringan kesehatan dugaan mengalami kekerasan seksual', 10, 20, 30, 50, 1, '2024-09-02 06:49:48', '2024-09-02 06:49:48'),
(13, 'Jumlah peserta didik yang mendapatkan rujukan ke puskesmas', 'Jumlah peserta didik yang mendapatkan rujukan ke puskesmas', 10, 20, 30, 50, 1, '2024-09-03 06:49:48', '2024-09-03 06:49:48'),
(14, 'Jumlah peserta didik yang mendapatkan pelayanan kesehatan peduli remaja (PKPR)', 'Jumlah peserta didik yang mendapatkan pelayanan kesehatan peduli remaja (PKPR)', 10, 20, 30, 50, 1, '2024-09-04 06:49:48', '2024-09-04 06:49:48'),
(15, 'Jumlah remaja putri yang telah mendapat tablet tambah darah dalam bulan ini (TTD)', 'Jumlah remaja putri yang telah mendapat tablet tambah darah dalam bulan ini (TTD)', 10, 20, 30, 50, 1, '2024-09-05 06:49:48', '2024-09-05 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_program_kia_gizis`
--

CREATE TABLE `kegiatan_program_kia_gizis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idProgramKiaGizi` bigint(20) UNSIGNED NOT NULL,
  `namaKegiatan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `targetJumlahSetiapDesa` int(11) NOT NULL,
  `targetJumlahDesaMelaksanakan` int(11) NOT NULL,
  `targetBulanan` int(11) NOT NULL,
  `targetTriwulan` int(11) NOT NULL,
  `targetSemester` int(11) NOT NULL,
  `targetTahunan` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_program_kia_gizis`
--

INSERT INTO `kegiatan_program_kia_gizis` (`id`, `idProgramKiaGizi`, `namaKegiatan`, `deskripsi`, `targetJumlahSetiapDesa`, `targetJumlahDesaMelaksanakan`, `targetBulanan`, `targetTriwulan`, `targetSemester`, `targetTahunan`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jumlah ibu hamil terdaftar bulan ini', 'Jumlah ibu hamil terdaftar bulan ini', 30, 5, 50, 100, 150, 200, 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 1, 'Jumlah ibu hamil dapat tablet tambah darah minimal 90 tablet', 'Jumlah ibu hamil dapat tablet tambah darah minimal 90 tablet', 30, 5, 50, 100, 150, 200, 1, '2024-08-23 06:49:48', '2024-08-23 06:49:48'),
(3, 1, 'Jumlah ibu hamil anemia', 'Jumlah ibu hamil anemia', 30, 5, 50, 100, 150, 200, 1, '2024-08-24 06:49:48', '2024-08-24 06:49:48'),
(4, 1, 'Jumlah ibu hamil kurang energi kronis (KEK)', 'Jumlah ibu hamil kurang energi kronis (KEK)', 30, 5, 50, 100, 150, 200, 1, '2024-08-25 06:49:48', '2024-08-25 06:49:48'),
(5, 1, 'Jumlah ibu hamil KEK dapat PMT ibu bumil', 'Jumlah ibu hamil KEK dapat PMT ibu bumil', 30, 5, 50, 100, 150, 200, 1, '2024-08-26 06:49:48', '2024-08-26 06:49:48'),
(6, 1, 'Jumlah ibu nifas dapat vitamin A dosis tinggi (2 kapsul)', 'Jumlah ibu nifas dapat vitamin A dosis tinggi (2 kapsul)', 30, 5, 50, 100, 150, 200, 1, '2024-08-27 06:49:48', '2024-08-27 06:49:48'),
(7, 1, 'Jumlah bayi mendapat ASI eksklusif', 'Jumlah bayi mendapat ASI eksklusif', 30, 5, 50, 100, 150, 200, 1, '2024-08-28 06:49:48', '2024-08-28 06:49:48'),
(8, 1, 'Jumlah Bayi dengan Berat Badan Lahir Rendah (BBLR)', 'Jumlah Bayi dengan Berat Badan Lahir Rendah (BBLR)', 30, 5, 50, 100, 150, 200, 1, '2024-08-29 06:49:48', '2024-08-29 06:49:48'),
(9, 1, 'Jumlah bayi 6-11 bulaln mendapat Vit. A (100.000 IU)', 'Jumlah bayi 6-11 bulaln mendapat Vit. A (100.000 IU)', 30, 5, 50, 100, 150, 200, 1, '2024-08-30 06:49:48', '2024-08-30 06:49:48'),
(10, 1, 'Jumlah Balita (terdaftar bulan ini)', 'Jumlah Balita (terdaftar bulan ini)', 30, 5, 50, 100, 150, 200, 1, '2024-08-31 06:49:48', '2024-08-31 06:49:48'),
(11, 1, 'Jumlah anak balita dapat Vitamin A dosis tinggi (200.000 IU)', 'Jumlah anak balita dapat Vitamin A dosis tinggi (200.000 IU)', 30, 5, 50, 100, 150, 200, 1, '2024-09-01 06:49:48', '2024-09-01 06:49:48'),
(12, 1, 'Jumlah balita punya buku KIA (terdaftar bulan ini)', 'Jumlah balita punya buku KIA (terdaftar bulan ini)', 30, 5, 50, 100, 150, 200, 1, '2024-09-02 06:49:48', '2024-09-02 06:49:48'),
(13, 1, 'Jumlah balita ditimbang (D)', 'Jumlah balita ditimbang (D)', 30, 5, 50, 100, 150, 200, 1, '2024-09-03 06:49:48', '2024-09-03 06:49:48'),
(14, 1, 'Jumlah balita ditimbang yang naik berat badannya (N)', 'Jumlah balita ditimbang yang naik berat badannya (N)', 30, 5, 50, 100, 150, 200, 1, '2024-09-04 06:49:48', '2024-09-04 06:49:48'),
(15, 1, 'Jumlah balita ditimbang yang tidak naik berat badannya (T)', 'Jumlah balita ditimbang yang tidak naik berat badannya (T)', 30, 5, 50, 100, 150, 200, 1, '2024-09-05 06:49:48', '2024-09-05 06:49:48'),
(16, 1, 'Jumlah balita ditimbang yang tidak nai berat badannya 2 kali berturu-turu  (2T)', 'Jumlah balita ditimbang yang tidak nai berat badannya 2 kali berturu-turu  (2T)', 30, 5, 50, 100, 150, 200, 1, '2024-09-06 06:49:48', '2024-09-06 06:49:48'),
(17, 1, 'Jumlah Balita di bawah garis merah (BGM)', 'Jumlah Balita di bawah garis merah (BGM)', 30, 5, 50, 100, 150, 200, 1, '2024-09-07 06:49:48', '2024-09-07 06:49:48'),
(18, 1, 'Jumlah balita kurus', 'Jumlah balita kurus', 30, 5, 50, 100, 150, 200, 1, '2024-09-08 06:49:48', '2024-09-08 06:49:48'),
(19, 1, 'Jumlah Balita kurus mendapat makanan tambahan (PMT)', 'Jumlah Balita kurus mendapat makanan tambahan (PMT)', 30, 5, 50, 100, 150, 200, 1, '2024-09-09 06:49:48', '2024-09-09 06:49:48'),
(20, 1, 'Jumlah kasus Balita gizi buruk', 'Jumlah kasus Balita gizi buruk', 30, 5, 50, 100, 150, 200, 1, '2024-09-10 06:49:48', '2024-09-10 06:49:48'),
(21, 2, 'Jumlah kunjungan K4 Ibu Hamil', 'Jumlah kunjungan K4 Ibu Hamil', 30, 5, 50, 100, 150, 200, 1, '2024-09-11 06:49:48', '2024-09-11 06:49:48'),
(22, 2, 'Jumlah ibu  hamil dengan malaria', 'Jumlah ibu  hamil dengan malaria', 30, 5, 50, 100, 150, 200, 1, '2024-09-12 06:49:48', '2024-09-12 06:49:48'),
(23, 2, 'Jumlah ibu hamil dengan TB', 'Jumlah ibu hamil dengan TB', 30, 5, 50, 100, 150, 200, 1, '2024-09-13 06:49:48', '2024-09-13 06:49:48'),
(24, 2, 'Jumlah ibu hamil dengan sifilis positif (Laboratorium)', 'Jumlah ibu hamil dengan sifilis positif (Laboratorium)', 30, 5, 50, 100, 150, 200, 1, '2024-09-14 06:49:48', '2024-09-14 06:49:48'),
(25, 2, 'Jumlah ibu hamil dengan HIV Positif', 'Jumlah ibu hamil dengan HIV Positif', 30, 5, 50, 100, 150, 200, 1, '2024-09-15 06:49:48', '2024-09-15 06:49:48'),
(26, 2, 'Jumlah ibu hamil dengan Hepatitis B', 'Jumlah ibu hamil dengan Hepatitis B', 30, 5, 50, 100, 150, 200, 1, '2024-09-16 06:49:48', '2024-09-16 06:49:48'),
(27, 2, 'Jumlah ibu hamil, ibu bersalin, dan ibu nifas dengan komplikasi (perdarahan, infeksi, abortus, keracunan kehamilan, partus lama) yang dirujuk ke RS', 'Jumlah ibu hamil, ibu bersalin, dan ibu nifas dengan komplikasi (perdarahan, infeksi, abortus, keracunan kehamilan, partus lama) yang dirujuk ke RS', 30, 5, 50, 100, 150, 200, 1, '2024-09-17 06:49:48', '2024-09-17 06:49:48'),
(28, 2, 'Jumlah ibu hamil yang mengikuti kelas ibu hamil', 'Jumlah ibu hamil yang mengikuti kelas ibu hamil', 30, 5, 50, 100, 150, 200, 1, '2024-09-18 06:49:48', '2024-09-18 06:49:48'),
(29, 2, 'Jumlah ibu bersalin di fasilitas pelayanan kesehatan', 'Jumlah ibu bersalin di fasilitas pelayanan kesehatan', 30, 5, 50, 100, 150, 200, 1, '2024-09-19 06:49:48', '2024-09-19 06:49:48'),
(30, 2, 'Jumlah ibu nifas yang mendapat pelayanan nifas lengkap (KF4)', 'Jumlah ibu nifas yang mendapat pelayanan nifas lengkap (KF4)', 30, 5, 50, 100, 150, 200, 1, '2024-09-20 06:49:48', '2024-09-20 06:49:48'),
(31, 2, 'Jumlah peserta KB Pasca persalinan (Per metode kontrasepsi) MKJP (Metode Kontrasepsi Jangka Panjang)', 'Jumlah peserta KB Pasca persalinan (Per metode kontrasepsi) MKJP (Metode Kontrasepsi Jangka Panjang)', 30, 5, 50, 100, 150, 200, 1, '2024-09-21 06:49:48', '2024-09-21 06:49:48'),
(32, 2, 'Jumlah peserta KB Pasca persalinan (Per metode kontrasepsi) Non MKJP', 'Jumlah peserta KB Pasca persalinan (Per metode kontrasepsi) Non MKJP', 30, 5, 50, 100, 150, 200, 1, '2024-09-22 06:49:48', '2024-09-22 06:49:48'),
(33, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang dilakukan seleksi', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang dilakukan seleksi', 30, 5, 50, 100, 150, 200, 1, '2024-09-23 06:49:48', '2024-09-23 06:49:48'),
(34, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang tidak dilakukan seleksi', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang tidak dilakukan seleksi', 30, 5, 50, 100, 150, 200, 1, '2024-09-24 06:49:48', '2024-09-24 06:49:48'),
(35, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi', 30, 5, 50, 100, 150, 200, 1, '2024-09-25 06:49:48', '2024-09-25 06:49:48'),
(36, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah O (Rh+)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah O (Rh+)', 30, 5, 50, 100, 150, 200, 1, '2024-09-26 06:49:48', '2024-09-26 06:49:48'),
(37, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah O (Rh-)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah O (Rh-)', 30, 5, 50, 100, 150, 200, 1, '2024-09-27 06:49:48', '2024-09-27 06:49:48'),
(38, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah A (Rh+)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah A (Rh+)', 30, 5, 50, 100, 150, 200, 1, '2024-09-28 06:49:48', '2024-09-28 06:49:48'),
(39, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah A (Rh-)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah A (Rh-)', 30, 5, 50, 100, 150, 200, 1, '2024-09-29 06:49:48', '2024-09-29 06:49:48'),
(40, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah B (Rh+)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah B (Rh+)', 30, 5, 50, 100, 150, 200, 1, '2024-09-30 06:49:48', '2024-09-30 06:49:48'),
(41, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah B (Rh-)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah B (Rh-)', 30, 5, 50, 100, 150, 200, 1, '2024-10-01 06:49:48', '2024-10-01 06:49:48'),
(42, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah AB (Rh+)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah AB (Rh+)', 30, 5, 50, 100, 150, 200, 1, '2024-10-02 06:49:48', '2024-10-02 06:49:48'),
(43, 2, 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah AB (Rh-)', 'Calon pendonor darah pendamping ibu hamil - Jumlah calon pendonor yang lolos seleksi dengan golongan darah AB (Rh-)', 30, 5, 50, 100, 150, 200, 1, '2024-10-03 06:49:48', '2024-10-03 06:49:48'),
(44, 3, 'Jumlah kunjungan Neonatal Pertama (KN1)', 'Jumlah kunjungan Neonatal Pertama (KN1)', 30, 5, 50, 100, 150, 200, 1, '2024-10-04 06:49:48', '2024-10-04 06:49:48'),
(45, 3, 'Jumlah Kunjungan Neonatal Lengkap (KN Lengkap)', 'Jumlah Kunjungan Neonatal Lengkap (KN Lengkap)', 30, 5, 50, 100, 150, 200, 1, '2024-10-05 06:49:48', '2024-10-05 06:49:48'),
(46, 3, 'Jumlah neonatus yang mendapat pelayanan skrining hipertiroid kongenital (SHK)', 'Jumlah neonatus yang mendapat pelayanan skrining hipertiroid kongenital (SHK)', 30, 5, 50, 100, 150, 200, 1, '2024-10-06 06:49:48', '2024-10-06 06:49:48'),
(47, 3, 'Jumlah kasus korban kekerasan anak dan perempuan > 18 tahun yang mendapat pelayanan kesehatan (pelayanan medis, visum, pelayanan konseling)', 'Jumlah kasus korban kekerasan anak dan perempuan > 18 tahun yang mendapat pelayanan kesehatan (pelayanan medis, visum, pelayanan konseling)', 30, 5, 50, 100, 150, 200, 1, '2024-10-07 06:49:48', '2024-10-07 06:49:48'),
(48, 4, 'Jumlah lansia (>= 60 tahun) yang mendapatkan pelayanan kesehatan (baru pertama kali tahun ini)', 'Jumlah lansia (>= 60 tahun) yang mendapatkan pelayanan kesehatan (baru pertama kali tahun ini)', 30, 5, 50, 100, 150, 200, 1, '2024-10-08 06:49:48', '2024-10-08 06:49:48'),
(49, 4, 'Jumlah lansia (>= 60 tahun) yang diskrining kesehatannya', 'Jumlah lansia (>= 60 tahun) yang diskrining kesehatannya', 30, 5, 50, 100, 150, 200, 1, '2024-10-09 06:49:48', '2024-10-09 06:49:48'),
(50, 4, 'Jumlah lansia (>= 60 tahun) dengan tingkat kemandirian A', 'Jumlah lansia (>= 60 tahun) dengan tingkat kemandirian A', 30, 5, 50, 100, 150, 200, 1, '2024-10-10 06:49:48', '2024-10-10 06:49:48'),
(51, 4, 'Jumlah lansia(>= 60 tahun ) dengan Tingkat Kemandirian B', 'Jumlah lansia(>= 60 tahun ) dengan Tingkat Kemandirian B', 30, 5, 50, 100, 150, 200, 1, '2024-10-11 06:49:48', '2024-10-11 06:49:48'),
(52, 4, 'Jumlah lansia(>= 60 tahun ) dengan Tingkat Kemandirian C', 'Jumlah lansia(>= 60 tahun ) dengan Tingkat Kemandirian C', 30, 5, 50, 100, 150, 200, 1, '2024-10-12 06:49:48', '2024-10-12 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_program_pengendalian_penyakit`
--

CREATE TABLE `kegiatan_program_pengendalian_penyakit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idProgram` bigint(20) UNSIGNED NOT NULL,
  `namaKegiatan` varchar(255) NOT NULL,
  `targetJumlah` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_program_pengendalian_penyakit`
--

INSERT INTO `kegiatan_program_pengendalian_penyakit` (`id`, `idProgram`, `namaKegiatan`, `targetJumlah`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jumlah suspek malaria ditemukan', 50, 'Jumlah suspek malaria ditemukan', 1, '2024-08-22 06:49:48', '2024-08-23 06:49:48'),
(2, 1, 'Jumlah suspek malaria diperiksa mikroskopis/RDT', 50, 'Jumlah suspek malaria diperiksa mikroskopis/RDT', 1, '2024-08-23 06:49:48', '2024-08-24 06:49:48'),
(3, 1, 'Jumlah malaria positif (sama dengan jumlah malaria positif pada laporan Bulanan Data Kesakitan)', 50, 'Jumlah malaria positif (sama dengan jumlah malaria positif pada laporan Bulanan Data Kesakitan)', 1, '2024-08-24 06:49:48', '2024-08-25 06:49:48'),
(4, 1, 'Jumlah malaria positif Plasmmodium falsiparum', 50, 'Jumlah malaria positif Plasmmodium falsiparum', 1, '2024-08-25 06:49:48', '2024-08-26 06:49:48'),
(5, 1, 'Jjumlah malaria Positif Indigenous', 50, 'Jjumlah malaria Positif Indigenous', 1, '2024-08-26 06:49:48', '2024-08-27 06:49:48'),
(6, 1, 'Jumlah malaria positif import', 50, 'Jumlah malaria positif import', 1, '2024-08-27 06:49:48', '2024-08-28 06:49:48'),
(7, 1, 'Jumlah malaria positif diobati standar', 50, 'Jumlah malaria positif diobati standar', 1, '2024-08-28 06:49:48', '2024-08-29 06:49:48'),
(8, 1, 'Jumlah kelambu berinsektisida yang dibagikan', 50, 'Jumlah kelambu berinsektisida yang dibagikan', 1, '2024-08-29 06:49:48', '2024-08-30 06:49:48'),
(9, 2, 'Jumlah kelurahan/desa beresiko penularan DBD (ada kelompok cluster/cluster dalam 3 tahun terakhir)', 50, 'Jumlah kelurahan/desa beresiko penularan DBD (ada kelompok cluster/cluster dalam 3 tahun terakhir)', 1, '2024-08-30 06:49:48', '2024-08-31 06:49:48'),
(10, 2, 'Jumlah kelurahan/desa berisiko penularan DBD diperiksa jentik', 50, 'Jumlah kelurahan/desa berisiko penularan DBD diperiksa jentik', 1, '2024-08-31 06:49:48', '2024-09-01 06:49:48'),
(11, 2, 'Jumlah kelurahan/desa berisiko penuldaran DBD bebas jentik (ada jentik <5 rmh/bangunan)', 50, 'Jumlah kelurahan/desa berisiko penuldaran DBD bebas jentik (ada jentik <5 rmh/bangunan)', 1, '2024-09-01 06:49:48', '2024-09-02 06:49:48'),
(12, 2, 'Jumlah fogging focus', 50, 'Jumlah fogging focus', 1, '2024-09-02 06:49:48', '2024-09-03 06:49:48'),
(13, 2, 'Jumlah kelurahan/desa yang dilakukan larvasidasi', 50, 'Jumlah kelurahan/desa yang dilakukan larvasidasi', 1, '2024-09-03 06:49:48', '2024-09-04 06:49:48'),
(14, 2, 'Jumlah kelurahan/desa yang dilakukan PSN 3M Plus', 50, 'Jumlah kelurahan/desa yang dilakukan PSN 3M Plus', 1, '2024-09-04 06:49:48', '2024-09-05 06:49:48'),
(15, 2, 'Jumlah sekolah diperiksa jentik ', 50, 'Jumlah sekolah diperiksa jentik ', 1, '2024-09-05 06:49:48', '2024-09-06 06:49:48'),
(16, 2, 'Jumlah sekolah diperiksa dan bebas dari jentik', 50, 'Jumlah sekolah diperiksa dan bebas dari jentik', 1, '2024-09-06 06:49:48', '2024-09-07 06:49:48'),
(17, 2, 'Jumlah RS/Puskesmas/klinik diperiksa jentik', 50, 'Jumlah RS/Puskesmas/klinik diperiksa jentik', 1, '2024-09-07 06:49:48', '2024-09-08 06:49:48'),
(18, 2, 'Jumlah sekolah diperiksa dan bebas dari jentik', 50, 'Jumlah sekolah diperiksa dan bebas dari jentik', 1, '2024-09-08 06:49:48', '2024-09-09 06:49:48'),
(19, 2, 'Jumlah tempat-tempat umum lainnya diperiksa jentik', 50, 'Jumlah tempat-tempat umum lainnya diperiksa jentik', 1, '2024-09-09 06:49:48', '2024-09-10 06:49:48'),
(20, 2, 'Jumlah tempat-tempat umum lainnya diperiksa dan bebas jentik ', 50, 'Jumlah tempat-tempat umum lainnya diperiksa dan bebas jentik ', 1, '2024-09-10 06:49:48', '2024-09-11 06:49:48'),
(21, 3, 'Jumlah anak balita (1-4 tahun) yang diperiksa cacing pada tinjanya', 50, 'Jumlah anak balita (1-4 tahun) yang diperiksa cacing pada tinjanya', 1, '2024-09-11 06:49:48', '2024-09-12 06:49:48'),
(22, 3, 'Jumlah anak prasekolah (5-6 tahun) yang diperiksa cacing pada tinjanya', 50, 'Jumlah anak prasekolah (5-6 tahun) yang diperiksa cacing pada tinjanya', 1, '2024-09-12 06:49:48', '2024-09-13 06:49:48'),
(23, 3, 'Jumlah anak sekolah (7-12 tahun) yang diperiksa cacing pada tinjanya', 50, 'Jumlah anak sekolah (7-12 tahun) yang diperiksa cacing pada tinjanya', 1, '2024-09-13 06:49:48', '2024-09-14 06:49:48'),
(24, 3, 'Jumlah anak balita (1-4 tahun) yang ditemukan positif telur cacing pada pemeriksaan tinjanya', 50, 'Jumlah anak balita (1-4 tahun) yang ditemukan positif telur cacing pada pemeriksaan tinjanya', 1, '2024-09-14 06:49:48', '2024-09-15 06:49:48'),
(25, 3, 'Jumlah anak prasekolah (5-6 tahun) yang ditemukan positif telur cacing pada pemeriksaan tinjanya', 50, 'Jumlah anak prasekolah (5-6 tahun) yang ditemukan positif telur cacing pada pemeriksaan tinjanya', 1, '2024-09-15 06:49:48', '2024-09-16 06:49:48'),
(26, 3, 'Jumlah anak (7-12 tahun) yang ditemukan positif telur cacing pada pemeriksaan tinjanya', 50, 'Jumlah anak (7-12 tahun) yang ditemukan positif telur cacing pada pemeriksaan tinjanya', 1, '2024-09-16 06:49:48', '2024-09-17 06:49:48'),
(27, 3, 'Jumlah anak balita (1-4 tahun) yang minum obat cacing (Albendazole)', 50, 'Jumlah anak balita (1-4 tahun) yang minum obat cacing (Albendazole)', 1, '2024-09-17 06:49:48', '2024-09-18 06:49:48'),
(28, 3, 'Jumlah anak prasekolah (5-6 tahun) yang minum obat cacing (Albendazole)', 50, 'Jumlah anak prasekolah (5-6 tahun) yang minum obat cacing (Albendazole)', 1, '2024-09-18 06:49:48', '2024-09-19 06:49:48'),
(29, 3, 'Jumlah anak prasekolah (7-12 tahun) yang minum obat cacing (Albendazole)', 50, 'Jumlah anak prasekolah (7-12 tahun) yang minum obat cacing (Albendazole)', 1, '2024-09-19 06:49:48', '2024-09-20 06:49:48'),
(30, 3, 'Jumlah SD/MI yang anak didiknya mendapat obat cacing (Albendazole) I', 50, 'Jumlah SD/MI yang anak didiknya mendapat obat cacing (Albendazole) I', 1, '2024-09-20 06:49:48', '2024-09-21 06:49:48'),
(31, 3, 'Jumlah SD/MI yang anak didiknya mendapat obat cacing (Albendazole) II tahun ini', 50, 'Jumlah SD/MI yang anak didiknya mendapat obat cacing (Albendazole) II tahun ini', 1, '2024-09-21 06:49:48', '2024-09-22 06:49:48'),
(32, 3, 'Jumlah ibu hamil dites cacing tinjanya', 50, 'Jumlah ibu hamil dites cacing tinjanya', 1, '2024-09-22 06:49:48', '2024-09-23 06:49:48'),
(33, 3, 'Jumlah ibu hamil cacingan ditangani (mendapat albendazole) (baru/pulang)', 50, 'Jumlah ibu hamil cacingan ditangani (mendapat albendazole) (baru/pulang)', 1, '2024-09-23 06:49:48', '2024-09-24 06:49:48'),
(34, 4, 'Jumlah Kasus Gigitan Hewan Penular Rabies (GHPR) pada anak laki-laki (umur <15 tahun)', 50, 'Jumlah Kasus Gigitan Hewan Penular Rabies (GHPR) pada anak laki-laki (umur <15 tahun)', 1, '2024-09-24 06:49:48', '2024-09-25 06:49:48'),
(35, 4, 'Jumlah kasus GHPR pada laki-laki dewasa (Umur > 15 tahun)', 50, 'Jumlah kasus GHPR pada laki-laki dewasa (Umur > 15 tahun)', 1, '2024-09-25 06:49:48', '2024-09-26 06:49:48'),
(36, 4, 'Jumlah kasus GHPR pada anak perempuan (umur < 15 tahun)', 50, 'Jumlah kasus GHPR pada anak perempuan (umur < 15 tahun)', 1, '2024-09-26 06:49:48', '2024-09-27 06:49:48'),
(37, 4, 'Jumlah kasus GHPR pada anak perempuan (umur > 15 tahun)', 50, 'Jumlah kasus GHPR pada anak perempuan (umur > 15 tahun)', 1, '2024-09-27 06:49:48', '2024-09-28 06:49:48'),
(38, 4, 'Jumlah kasus GHPR pada perempuan dewasa (umur > 15 tahun)', 50, 'Jumlah kasus GHPR pada perempuan dewasa (umur > 15 tahun)', 1, '2024-09-28 06:49:48', '2024-09-29 06:49:48'),
(39, 4, 'Jumlah kasus GHPR yang mendapatkan Vaksin Anti Rabies (VAR)/SAR', 50, 'Jumlah kasus GHPR yang mendapatkan Vaksin Anti Rabies (VAR)/SAR', 1, '2024-09-29 06:49:48', '2024-09-30 06:49:48'),
(40, 4, 'Jumlah kasus Rabies (Kasus Lyssa) yang mendapatkan VAR/SAR secara lengkap', 50, 'Jumlah kasus Rabies (Kasus Lyssa) yang mendapatkan VAR/SAR secara lengkap', 1, '2024-09-30 06:49:48', '2024-10-01 06:49:48'),
(41, 4, 'Jumlah kasus Rabies (Kasus Lyssa) yang tidak mendapatkan VAR/SAR secara lengkap', 50, 'Jumlah kasus Rabies (Kasus Lyssa) yang tidak mendapatkan VAR/SAR secara lengkap', 1, '2024-10-01 06:49:48', '2024-10-02 06:49:48'),
(42, 5, 'Jumlah penderita diare pada bayi dapat oralit', 50, 'Jumlah penderita diare pada bayi dapat oralit', 1, '2024-10-02 06:49:48', '2024-10-03 06:49:48'),
(43, 5, 'Jumlah penderita diare pada bayi dapat Zink ', 50, 'Jumlah penderita diare pada bayi dapat Zink ', 1, '2024-10-03 06:49:48', '2024-10-04 06:49:48'),
(44, 5, 'Jumlah penderita diare pada bayi dapat oralit dan zink', 50, 'Jumlah penderita diare pada bayi dapat oralit dan zink', 1, '2024-10-04 06:49:48', '2024-10-05 06:49:48'),
(45, 5, 'Jumlah penderita diare pada bayi dapat infus', 50, 'Jumlah penderita diare pada bayi dapat infus', 1, '2024-10-05 06:49:48', '2024-10-06 06:49:48'),
(46, 5, 'Jumlah penderita diare pada anak balita dapat oralit', 50, 'Jumlah penderita diare pada anak balita dapat oralit', 1, '2024-10-06 06:49:48', '2024-10-07 06:49:48'),
(47, 5, 'Jumlah penderita diare pada anak balita Zink', 50, 'Jumlah penderita diare pada anak balita Zink', 1, '2024-10-07 06:49:48', '2024-10-08 06:49:48'),
(48, 5, 'Jumlah penderita diare pada anak balita dapat Oralit dan Zink', 50, 'Jumlah penderita diare pada anak balita dapat Oralit dan Zink', 1, '2024-10-08 06:49:48', '2024-10-09 06:49:48'),
(49, 5, 'Jumlah penderita diare pada anak balita dapat infus', 50, 'Jumlah penderita diare pada anak balita dapat infus', 1, '2024-10-09 06:49:48', '2024-10-10 06:49:48'),
(50, 5, 'Jumlah penderita diare umur >= 5 tahun dapat oralit', 50, 'Jumlah penderita diare umur >= 5 tahun dapat oralit', 1, '2024-10-10 06:49:48', '2024-10-11 06:49:48'),
(51, 5, 'Jumlah penderita diare umur >= 5 tahun dapat infus', 50, 'Jumlah penderita diare umur >= 5 tahun dapat infus', 1, '2024-10-11 06:49:48', '2024-10-12 06:49:48'),
(52, 6, 'Jumlah kasus supek hepatitis yang dirujuk', 50, 'Jumlah kasus supek hepatitis yang dirujuk', 1, '2024-10-12 06:49:48', '2024-10-13 06:49:48'),
(53, 7, 'Jumlah pasien tuberculosis paru terkonfirmasi bateriologis (BTA/ biakan/test cepat) baru diobati', 50, 'Jumlah pasien tuberculosis paru terkonfirmasi bateriologis (BTA/ biakan/test cepat) baru diobati', 1, '2024-10-13 06:49:48', '2024-10-14 06:49:48'),
(54, 7, 'Jumlah pasien tuberculosis selain paru (klinis paru, BTA negatif, rontgen positif) yang diobati', 50, 'Jumlah pasien tuberculosis selain paru (klinis paru, BTA negatif, rontgen positif) yang diobati', 1, '2024-10-14 06:49:48', '2024-10-15 06:49:48'),
(55, 7, 'Jumlah pasien tuberculosis anak (0-14 tahun) yang diobati', 50, 'Jumlah pasien tuberculosis anak (0-14 tahun) yang diobati', 1, '2024-10-15 06:49:48', '2024-10-16 06:49:48'),
(56, 7, 'Jumlah pasien tuberculosis yang diobati bulan ini', 50, 'Jumlah pasien tuberculosis yang diobati bulan ini', 1, '2024-10-16 06:49:48', '2024-10-17 06:49:48'),
(57, 7, 'Jumlah pasien tuberculosis paru bakteriologis yang sembuh', 50, 'Jumlah pasien tuberculosis paru bakteriologis yang sembuh', 1, '2024-10-17 06:49:48', '2024-10-18 06:49:48'),
(58, 7, 'Jumlah pasien tuberculosis paru terkonfirmasi bateriologis yang mendapat pengobatan lengkap', 50, 'Jumlah pasien tuberculosis paru terkonfirmasi bateriologis yang mendapat pengobatan lengkap', 1, '2024-10-18 06:49:48', '2024-10-19 06:49:48'),
(59, 7, 'Jumlah pasien tuberculosis (paru BTA negatif, rontgen positif) baru yang mendapat pengobatan lengkap)', 50, 'Jumlah pasien tuberculosis (paru BTA negatif, rontgen positif) baru yang mendapat pengobatan lengkap)', 1, '2024-10-19 06:49:48', '2024-10-20 06:49:48'),
(60, 7, 'Jumlah pasien tuberculosis kambuh', 50, 'Jumlah pasien tuberculosis kambuh', 1, '2024-10-20 06:49:48', '2024-10-21 06:49:48'),
(61, 8, 'Jumlah penderita kusta tipe PB dan MB', 50, 'Jumlah penderita kusta tipe PB dan MB', 1, '2024-10-21 06:49:48', '2024-10-22 06:49:48'),
(62, 8, 'Jumlah penderita kusta (MB dan PB) baru dengan cacat tingkat 0', 50, 'Jumlah penderita kusta (MB dan PB) baru dengan cacat tingkat 0', 1, '2024-10-22 06:49:48', '2024-10-23 06:49:48'),
(63, 8, 'Jumlah penderita kusta (MB dan PB) baru dengan cacat tingkat 2 ', 50, 'Jumlah penderita kusta (MB dan PB) baru dengan cacat tingkat 2 ', 1, '2024-10-23 06:49:48', '2024-10-24 06:49:48'),
(64, 8, 'Jumlah penderita kusta baru anak', 50, 'Jumlah penderita kusta baru anak', 1, '2024-10-24 06:49:48', '2024-10-25 06:49:48'),
(65, 8, 'Jumlah kasus indeks (MB dan PB) yang kontaknya dilakukan pemeriksaan kusta', 50, 'Jumlah kasus indeks (MB dan PB) yang kontaknya dilakukan pemeriksaan kusta', 1, '2024-10-25 06:49:48', '2024-10-26 06:49:48'),
(66, 8, 'Jumlah pederita kusta (PB dan MB) masih dalam pengobatan MDT', 50, 'Jumlah pederita kusta (PB dan MB) masih dalam pengobatan MDT', 1, '2024-10-26 06:49:48', '2024-10-27 06:49:48'),
(67, 8, 'Jumlah penderita kusta (PB) dinyatakan default', 50, 'Jumlah penderita kusta (PB) dinyatakan default', 1, '2024-10-27 06:49:48', '2024-10-28 06:49:48'),
(68, 9, 'Jumlah penderita frambusia suspek', 50, 'Jumlah penderita frambusia suspek', 1, '2024-10-28 06:49:48', '2024-10-29 06:49:48'),
(69, 9, 'Jumlah penderita frambusia suspek diperiksa serologi (oemeriksaan cepat/RDT)', 50, 'Jumlah penderita frambusia suspek diperiksa serologi (oemeriksaan cepat/RDT)', 1, '2024-10-29 06:49:48', '2024-10-30 06:49:48'),
(70, 9, 'Jumlah penderita frambusia konfirmasi (RDT +)', 50, 'Jumlah penderita frambusia konfirmasi (RDT +)', 1, '2024-10-30 06:49:48', '2024-10-31 06:49:48'),
(71, 9, 'Jumlah SD/MI dilakukan pemeriksaan frambusia', 50, 'Jumlah SD/MI dilakukan pemeriksaan frambusia', 1, '2024-10-31 06:49:48', '2024-11-01 06:49:48'),
(72, 10, 'Jumlah orang dites HIV', 50, 'Jumlah orang dites HIV', 1, '2024-11-01 06:49:48', '2024-11-02 06:49:48'),
(73, 10, 'Jumlah orang dengan HIV positif', 50, 'Jumlah orang dengan HIV positif', 1, '2024-11-02 06:49:48', '2024-11-03 06:49:48'),
(74, 10, 'Jumlah ibu hamil dites HIV ', 50, 'Jumlah ibu hamil dites HIV ', 1, '2024-11-03 06:49:48', '2024-11-04 06:49:48'),
(75, 10, 'Jumlah ibu hamil dengan HIV positif', 50, 'Jumlah ibu hamil dengan HIV positif', 1, '2024-11-04 06:49:48', '2024-11-05 06:49:48'),
(76, 11, 'Jumlah pasien yang dites sifilis ', 50, 'Jumlah pasien yang dites sifilis ', 1, '2024-11-05 06:49:48', '2024-11-06 06:49:48'),
(77, 11, 'Jumlah pasien positif sifilis ', 50, 'Jumlah pasien positif sifilis ', 1, '2024-11-06 06:49:48', '2024-11-07 06:49:48'),
(78, 11, 'Jumlah pasien sifilis yang diobati', 50, 'Jumlah pasien sifilis yang diobati', 1, '2024-11-07 06:49:48', '2024-11-08 06:49:48'),
(79, 11, 'Jumlah ibu hamil yang dites sifilis', 50, 'Jumlah ibu hamil yang dites sifilis', 1, '2024-11-08 06:49:48', '2024-11-09 06:49:48'),
(80, 11, 'Jumlah ibu hamil positif sifilis', 50, 'Jumlah ibu hamil positif sifilis', 1, '2024-11-09 06:49:48', '2024-11-10 06:49:48'),
(81, 11, 'Jumlah ibu hamil sifilis yang diobati', 50, 'Jumlah ibu hamil sifilis yang diobati', 1, '2024-11-10 06:49:48', '2024-11-11 06:49:48'),
(82, 12, 'Jumlah kunjungan Balita batuk atau kesukaran bernapas', 50, 'Jumlah kunjungan Balita batuk atau kesukaran bernapas', 1, '2024-11-11 06:49:48', '2024-11-12 06:49:48'),
(83, 12, 'Jumlah balita batuk atau kesukaran bernafas yang dihitung napas atau dilihat ada tidaknya tarikan dinding dada kedalam', 50, 'Jumlah balita batuk atau kesukaran bernafas yang dihitung napas atau dilihat ada tidaknya tarikan dinding dada kedalam', 1, '2024-11-12 06:49:48', '2024-11-13 06:49:48'),
(84, 13, 'Jumlah perempuan 30-50 tahun yang diperiksa IVA-SADANIS (Pemeriksaan payudara klinis)', 50, 'Jumlah perempuan 30-50 tahun yang diperiksa IVA-SADANIS (Pemeriksaan payudara klinis)', 1, '2024-11-13 06:49:48', '2024-11-14 06:49:48'),
(85, 13, 'Persentase cakupan perempuan 30-50 tahun yang dperiksa IVA-SADANIS', 50, 'Persentase cakupan perempuan 30-50 tahun yang dperiksa IVA-SADANIS', 1, '2024-11-14 06:49:48', '2024-11-15 06:49:48'),
(86, 13, 'Jumlah Perempuan usia 30-50 tahun dengan IVA Positif', 50, 'Jumlah Perempuan usia 30-50 tahun dengan IVA Positif', 1, '2024-11-15 06:49:48', '2024-11-16 06:49:48'),
(87, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan dicurigai kanker serviks', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan dicurigai kanker serviks', 1, '2024-11-16 06:49:48', '2024-11-17 06:49:48'),
(88, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan kelainan ginekologi lain', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan kelainan ginekologi lain', 1, '2024-11-17 06:49:48', '2024-11-18 06:49:48'),
(89, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan pap smear positif', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan pap smear positif', 1, '2024-11-18 06:49:48', '2024-11-19 06:49:48'),
(90, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan IVA positif yang sudah dikrioterapi', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan IVA positif yang sudah dikrioterapi', 1, '2024-11-19 06:49:48', '2024-11-20 06:49:48'),
(91, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan benjolan payudara', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan benjolan payudara', 1, '2024-11-20 06:49:48', '2024-11-21 06:49:48'),
(92, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan dicurigai kanker payudara', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan dicurigai kanker payudara', 1, '2024-11-21 06:49:48', '2024-11-22 06:49:48'),
(93, 13, 'Jumlah Perempuan Usia 30-50 tahun dengan kelainan payudara lainnya', 50, 'Jumlah Perempuan Usia 30-50 tahun dengan kelainan payudara lainnya', 1, '2024-11-22 06:49:48', '2024-11-23 06:49:48'),
(94, 14, 'Jumlah penduduk berusia 15-59 tahun melakukan pemeriksaan Posbindu PTM', 50, 'Jumlah penduduk berusia 15-59 tahun melakukan pemeriksaan Posbindu PTM', 1, '2024-11-23 06:49:48', '2024-11-24 06:49:48'),
(95, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Merokok', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Merokok', 1, '2024-11-24 06:49:48', '2024-11-25 06:49:48'),
(96, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Kurang mengkonsumsi buah dan sayur', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Kurang mengkonsumsi buah dan sayur', 1, '2024-11-25 06:49:48', '2024-11-26 06:49:48'),
(97, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Kurang melakukan aktivitas fisik', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Kurang melakukan aktivitas fisik', 1, '2024-11-26 06:49:48', '2024-11-27 06:49:48'),
(98, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan mengkonsumsi alcohol', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan mengkonsumsi alcohol', 1, '2024-11-27 06:49:48', '2024-11-28 06:49:48'),
(99, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Obesitas', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Obesitas', 1, '2024-11-28 06:49:48', '2024-11-29 06:49:48'),
(100, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Obesitas Sentral', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Obesitas Sentral', 1, '2024-11-29 06:49:48', '2024-11-30 06:49:48'),
(101, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan menderita tekanan darah tinggi', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan menderita tekanan darah tinggi', 1, '2024-11-30 06:49:48', '2024-12-01 06:49:48'),
(102, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Hiperglikemia', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Hiperglikemia', 1, '2024-12-01 06:49:48', '2024-12-02 06:49:48'),
(103, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Hiperkolesterolemia', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Hiperkolesterolemia', 1, '2024-12-02 06:49:48', '2024-12-03 06:49:48'),
(104, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Gangguan pengelihatan', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Gangguan pengelihatan', 1, '2024-12-03 06:49:48', '2024-12-04 06:49:48'),
(105, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Gangguan Pendengaran', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan Gangguan Pendengaran', 1, '2024-12-04 06:49:48', '2024-12-05 06:49:48'),
(106, 14, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan gangguan emosi mental', 50, 'Jumlah penduduk berusia >= 15 tahun melakukan pemeriksaan di Posbindu PTM dengan masalah kesehatan gangguan emosi mental', 1, '2024-12-05 06:49:48', '2024-12-06 06:49:48'),
(107, 14, 'Gangguan PTM dengan penyakit penyerta lain diabetes melitus dengan TB', 50, 'Gangguan PTM dengan penyakit penyerta lain diabetes melitus dengan TB', 1, '2024-12-06 06:49:48', '2024-12-07 06:49:48'),
(108, 14, 'Gangguan PTM dengan penyakit penyerta lain diabetes melitus gestasional', 50, 'Gangguan PTM dengan penyakit penyerta lain diabetes melitus gestasional', 1, '2024-12-07 06:49:48', '2024-12-08 06:49:48'),
(109, 14, 'Jumlah penduduk mengikuti konseling kesehatan mengikuti konseling diet', 50, 'Jumlah penduduk mengikuti konseling kesehatan mengikuti konseling diet', 1, '2024-12-08 06:49:48', '2024-12-09 06:49:48'),
(110, 14, 'Jumlah penduduk mengikuti konseling kesehatan mengikut konseling berhenti merokok', 50, 'Jumlah penduduk mengikuti konseling kesehatan mengikut konseling berhenti merokok', 1, '2024-12-09 06:49:48', '2024-12-10 06:49:48'),
(111, 14, 'Jumlah penduduk mengikuti konseling kesehatan mengikuti konseling IVA-SADANIS', 50, 'Jumlah penduduk mengikuti konseling kesehatan mengikuti konseling IVA-SADANIS', 1, '2024-12-10 06:49:48', '2024-12-11 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_program_promkes`
--

CREATE TABLE `kegiatan_program_promkes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idProgram` bigint(20) UNSIGNED NOT NULL,
  `namaKegiatan` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `targetBulanan` int(11) NOT NULL DEFAULT 0,
  `targetTriwulan` int(11) NOT NULL DEFAULT 0,
  `targetSemester` int(11) NOT NULL DEFAULT 0,
  `targetTahunan` int(11) NOT NULL DEFAULT 0,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_program_promkes`
--

INSERT INTO `kegiatan_program_promkes` (`id`, `idProgram`, `namaKegiatan`, `deskripsi`, `targetBulanan`, `targetTriwulan`, `targetSemester`, `targetTahunan`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 1, 'Seminar Penyakit Menular', 'edukasi tentang penyakit menular', 1, 3, 9, 18, 1, '2024-10-07 06:05:23', '2024-10-07 06:05:23'),
(2, 2, 'BBD', 'Kegiatan bersih bersin desa', 1, 3, 9, 18, 1, '2024-10-07 06:05:23', '2024-10-07 06:05:23'),
(3, 3, 'Seminar Pubertas', 'Edukasi Seks sejak dini', 0, 1, 2, 4, 1, '2024-10-07 06:05:23', '2024-10-07 06:05:23'),
(4, 4, 'Promosi Kesehatan', 'Melakukan promosi keshatan', 1, 3, 9, 18, 1, '2024-10-07 06:05:23', '2024-10-07 06:05:23'),
(5, 5, 'Seminar Dampak Narkoba', 'Edukasi terkait dampak dari narkoba', 0, 1, 2, 4, 1, '2024-10-07 06:05:23', '2024-10-07 06:05:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kegiatan_promosi_kesehatan_umum_desa`
--

CREATE TABLE `kegiatan_promosi_kesehatan_umum_desa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaKegiatan` varchar(255) NOT NULL,
  `deskripsiKegiatan` text NOT NULL,
  `targetBulanan` int(11) NOT NULL,
  `targetTriwulan` int(11) NOT NULL,
  `targetSemester` int(11) NOT NULL,
  `targetTahunan` int(11) NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kegiatan_promosi_kesehatan_umum_desa`
--

INSERT INTO `kegiatan_promosi_kesehatan_umum_desa` (`id`, `namaKegiatan`, `deskripsiKegiatan`, `targetBulanan`, `targetTriwulan`, `targetSemester`, `targetTahunan`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Jumlah kegiatan advokasi tingkat desa/kelurhan dan kecamatan bidang kesehatan', 'cek jumlah kegiatan', 10, 10, 10, 10, 1, '2024-10-07 06:08:09', '2024-10-07 06:08:09'),
(2, 'Jumlah kegiatan penggalangan kemitraan dengan dunia usaha dan lintas sektor tingkat desa/kelurahan dan kecamatan bidang kesehatan', 'cek jumlah kegiatan', 10, 10, 10, 10, 1, '2024-10-07 06:08:09', '2024-10-07 06:08:09'),
(3, 'Jumlah kegiatan pembinaan UKBM atau kelompok masyarakat', 'cek jumlah kegiatan', 10, 10, 10, 10, 1, '2024-10-07 06:08:09', '2024-10-07 06:08:09'),
(4, 'Jumlah kegiatan penyuluhan kelompok', 'cek jumlah kegiatan', 10, 10, 10, 10, 1, '2024-10-07 06:08:09', '2024-10-07 06:08:09'),
(5, 'Jumlah kunjungan rumah', 'cek jumlah kegiatan', 10, 10, 10, 10, 1, '2024-10-07 06:08:09', '2024-10-07 06:08:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_siswas`
--

CREATE TABLE `kelas_siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaKelas` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_imunisasi_baduta`
--

CREATE TABLE `laporan_imunisasi_baduta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idSasaranImunisasi` bigint(20) UNSIGNED NOT NULL,
  `idJenisImunisasi` bigint(20) UNSIGNED NOT NULL,
  `jumlah_laki` int(11) NOT NULL,
  `jumlah_perempuan` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_imunisasi_bayi`
--

CREATE TABLE `laporan_imunisasi_bayi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idJenisImunisasi` bigint(20) UNSIGNED NOT NULL,
  `idSasaran` bigint(20) UNSIGNED NOT NULL,
  `jumlah_laki` int(11) NOT NULL,
  `jumlah_perempuan` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_imunisasi_wus`
--

CREATE TABLE `laporan_imunisasi_wus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idSasaran` bigint(20) UNSIGNED NOT NULL,
  `idJenis` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_17_134214_create_wilayah_kerja', 1),
(6, '2024_07_17_134402_create_kegiatan_promosi_kesehatan_umum_desa', 1),
(7, '2024_07_17_135435_create_jenis_ukbm', 1),
(8, '2024_07_17_140028_create_data_ukbm', 1),
(9, '2024_07_22_134957_create_pencatatan_kegiatan_promkes_desa', 1),
(10, '2024_07_29_024744_create_pencatatan_data_ukbm', 1),
(11, '2024_08_05_064536_create_kegiatan_kesling', 1),
(12, '2024_08_05_150857_create_program_divisi_promkes_table', 1),
(13, '2024_08_06_075454_create_kegiatan_program_promkes_table', 1),
(14, '2024_08_06_094141_create_pencatatan_data_kesling', 1),
(15, '2024_08_07_060018_create_pencatatan_kegiatan_program_promkes_table', 1),
(16, '2024_08_16_040806_create_program_kia_gizis_table', 1),
(17, '2024_08_16_064224_create_kegiatan_program_kia_gizis_table', 1),
(18, '2024_08_18_034521_create_pencatatan_kegiatan_program_kia_gizis_table', 1),
(19, '2024_08_21_032211_create_kegiatan_program_kesehatan_sekolahs_table', 1),
(20, '2024_08_21_074137_create_kelas_siswas_table', 1),
(21, '2024_08_23_093603_create_pencatatan_kegiatan_program_kesehatan_sekolahs_table', 1),
(22, '2024_08_29_011905_create_jenis_imunisasi_wus', 1),
(23, '2024_08_29_012234_create_sasaran_imunisasi_wus', 1),
(24, '2024_08_29_012540_create_laporan_imunisasi_wus', 1),
(25, '2024_08_30_064522_create_sasaran_imunisasi_bayi_table', 1),
(26, '2024_09_01_061810_create_jenis_imunisasi_bayi_table', 1),
(27, '2024_09_06_074624_create_laporan_imunisasi_bayi_table', 1),
(28, '2024_09_08_061621_create_sasaran_imunisasi_baduta_table', 1),
(29, '2024_09_08_130836_create_jenis_imunisasi_baduta_table', 1),
(30, '2024_09_08_135807_create_laporan_imunisasi_baduta_table', 1),
(31, '2024_09_11_125748_create_category_p2_table', 1),
(32, '2024_09_13_063951_create_program_pengendalian_penyakit_table', 1),
(33, '2024_09_13_081711_create_kegiatan_program_pengendalian_penyakit_table', 1),
(34, '2024_09_13_095548_create_pencatatan_program_pengendalian_penyakit_table', 1),
(35, '2024_09_21_064657_create_divisi_table', 1),
(36, '2024_09_21_065045_create_access_features_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_data_kesling`
--

CREATE TABLE `pencatatan_data_kesling` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKegiatanKesling` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pencatatan_data_kesling`
--

INSERT INTO `pencatatan_data_kesling` (`id`, `idKegiatanKesling`, `jumlah`, `deskripsi`, `bulan`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'telah dilakukan pemantauan sarana air minum dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03'),
(2, 2, 4, 'telah dilakukan pemantauan sarana air minum dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03'),
(3, 3, 2, 'telah dilakukan pemantauan sarana air minum dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03'),
(4, 4, 4, 'telah dilakukan pemantauan sarana air minum dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03'),
(5, 5, 2, 'telah dilakukan pemantauan tempat pengelolaan makanan dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03'),
(6, 6, 3, 'telah dilakukan pemantauan tempat pengelolaan makanan dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03'),
(7, 7, 1, 'telah dilakukan pemantauan tempat pengelolaan makanan dengan hasil tertera', '10', 2024, '2024-10-07 13:17:03', '2024-10-07 13:17:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_data_ukbm`
--

CREATE TABLE `pencatatan_data_ukbm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idDataUkbm` bigint(20) UNSIGNED NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pencatatan_data_ukbm`
--

INSERT INTO `pencatatan_data_ukbm` (`id`, `idDataUkbm`, `bulan`, `tahun`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, '10', 2024, 'telah dilakukan pencatatan data ukbm dengan data terlampir', '2024-10-07 13:10:58', '2024-10-07 13:10:58'),
(2, 2, '10', 2024, 'telah dilakukan pencatatan data ukbm dengan data terlampir', '2024-10-07 13:10:58', '2024-10-07 13:10:58'),
(3, 3, '10', 2024, 'telah dilakukan pencatatan data ukbm dengan data terlampir', '2024-10-07 13:10:58', '2024-10-07 13:10:58'),
(4, 4, '10', 2024, 'telah dilakukan pencatatan data ukbm dengan data terlampir', '2024-10-07 13:10:58', '2024-10-07 13:10:58'),
(5, 5, '10', 2024, 'telah dilakukan pencatatan data ukbm dengan data terlampir', '2024-10-07 13:10:58', '2024-10-07 13:10:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_kegiatan_program_kesehatan_sekolahs`
--

CREATE TABLE `pencatatan_kegiatan_program_kesehatan_sekolahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKegiatanProgramKesehatanSekolah` bigint(20) UNSIGNED NOT NULL,
  `idKelasSiswa` bigint(20) UNSIGNED NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_kegiatan_program_kia_gizis`
--

CREATE TABLE `pencatatan_kegiatan_program_kia_gizis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKegiatanProgramKiaGizi` bigint(20) UNSIGNED NOT NULL,
  `idDesa` bigint(20) UNSIGNED NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_kegiatan_program_promkes`
--

CREATE TABLE `pencatatan_kegiatan_program_promkes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKegiatanProgramPromkes` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_kegiatan_promkes_desa`
--

CREATE TABLE `pencatatan_kegiatan_promkes_desa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKegiatanPromKesDesa` bigint(20) UNSIGNED NOT NULL,
  `idDesa` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pencatatan_kegiatan_promkes_desa`
--

INSERT INTO `pencatatan_kegiatan_promkes_desa` (`id`, `idKegiatanPromKesDesa`, `idDesa`, `jumlah`, `bulan`, `tahun`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, '10', 2024, 'Terdapat kegiatan tersebut dengan jumlah terlampir', '2024-10-07 06:14:45', '2024-10-07 06:14:45'),
(2, 2, 2, 2, '10', 2024, 'Terdapat kegiatan tersebut dengan jumlah terlampir', '2024-10-07 06:14:45', '2024-10-07 06:14:45'),
(3, 3, 3, 2, '10', 2024, 'Terdapat kegiatan tersebut dengan jumlah terlampir', '2024-10-07 06:14:45', '2024-10-07 06:14:45'),
(4, 4, 4, 2, '10', 2024, 'Terdapat kegiatan tersebut dengan jumlah terlampir', '2024-10-07 06:14:45', '2024-10-07 06:14:45'),
(5, 5, 5, 2, '10', 2024, 'Terdapat kegiatan tersebut dengan jumlah terlampir', '2024-10-07 06:14:45', '2024-10-07 06:14:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pencatatan_program_pengendalian_penyakit`
--

CREATE TABLE `pencatatan_program_pengendalian_penyakit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKegiatan` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_divisi_promkes`
--

CREATE TABLE `program_divisi_promkes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaProgram` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_divisi_promkes`
--

INSERT INTO `program_divisi_promkes` (`id`, `namaProgram`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Promosi Kesehatan Penyakit Menular', 'Promosi Kesehatan Penyakit Menular', 0, '2024-10-07 06:04:11', '2024-10-07 06:14:12'),
(2, 'Promosi Kesehatan Lingkungan', 'Promosi Kesehatan Lingkungan', 1, '2024-10-07 06:04:11', '2024-10-07 06:04:11'),
(3, 'Promosi Kesehatan KIA, termasuk remaja', 'Promosi Kesehatan KIA, termasuk remaja', 1, '2024-10-07 06:04:11', '2024-10-07 06:04:11'),
(4, 'Promosi Kesehatan', 'Promosi Kesehatan', 1, '2024-10-07 06:04:11', '2024-10-07 06:04:11'),
(5, 'Promosi Kesehatan Jiwa dan Napza', 'Promosi Kesehatan Jiwa dan Napza', 1, '2024-10-07 06:04:11', '2024-10-07 06:04:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_kia_gizis`
--

CREATE TABLE `program_kia_gizis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaProgram` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_kia_gizis`
--

INSERT INTO `program_kia_gizis` (`id`, `namaProgram`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 'Program Gizi', 'Program Gizi', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 'Program Kesehatan Ibu', 'Program Kesehatan Ibu', 1, '2024-08-23 06:49:48', '2024-08-23 06:49:48'),
(3, 'Program Kesehatan Anak', 'Program Kesehatan Anak', 1, '2024-08-24 06:49:48', '2024-08-24 06:49:48'),
(4, 'Program Kesehatan Lansia', 'Program Kesehatan Lansia', 1, '2024-08-25 06:49:48', '2024-08-25 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program_pengendalian_penyakit`
--

CREATE TABLE `program_pengendalian_penyakit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idCategory` bigint(20) UNSIGNED NOT NULL,
  `namaProgram` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `program_pengendalian_penyakit`
--

INSERT INTO `program_pengendalian_penyakit` (`id`, `idCategory`, `namaProgram`, `deskripsi`, `isActive`, `created_at`, `updated_at`) VALUES
(1, 1, 'Malaria', 'Malaria', 1, '2024-08-22 06:49:48', '2024-08-22 06:49:48'),
(2, 1, 'DBD (Demam Berdarah Dengue)', 'DBD (Demam Berdarah Dengue)', 1, '2024-08-23 06:49:48', '2024-08-23 06:49:48'),
(3, 1, 'Kecacingan', 'Kecacingan', 1, '2024-08-24 06:49:48', '2024-08-24 06:49:48'),
(4, 1, 'Rabies', 'Rabies', 1, '2024-08-25 06:49:48', '2024-08-25 06:49:48'),
(5, 1, 'Diare', 'Diare', 1, '2024-08-26 06:49:48', '2024-08-26 06:49:48'),
(6, 1, 'Hepatitis', 'Hepatitis', 1, '2024-08-27 06:49:48', '2024-08-27 06:49:48'),
(7, 1, 'TB Paru', 'TB Paru', 1, '2024-08-28 06:49:48', '2024-08-28 06:49:48'),
(8, 1, 'Kusta', 'Kusta', 1, '2024-08-29 06:49:48', '2024-08-29 06:49:48'),
(9, 1, 'Frambusia', 'Frambusia', 1, '2024-08-30 06:49:48', '2024-08-30 06:49:48'),
(10, 1, 'HIV-AIDS', 'HIV-AIDS', 1, '2024-08-31 06:49:48', '2024-08-31 06:49:48'),
(11, 1, 'Penyakit Kelamin', 'Penyakit Kelamin', 1, '2024-09-01 06:49:48', '2024-09-01 06:49:48'),
(12, 1, 'ISPA', 'ISPA', 1, '2024-09-02 06:49:48', '2024-09-02 06:49:48'),
(13, 2, 'Deteksi Dini Kanker Leher Rahim dan Payudara', 'Deteksi Dini Kanker Leher Rahim dan Payudara', 1, '2024-09-03 06:49:48', '2024-09-03 06:49:48'),
(14, 2, 'Pemeriksaan Faktor Resiko (PTM)', 'Pemeriksaan Faktor Resiko (PTM)', 1, '2024-09-04 06:49:48', '2024-09-04 06:49:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sasaran_imunisasi_baduta`
--

CREATE TABLE `sasaran_imunisasi_baduta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idDesa` bigint(20) UNSIGNED NOT NULL,
  `sasaran_laki` int(11) NOT NULL,
  `sasaran_perempuan` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sasaran_imunisasi_bayi`
--

CREATE TABLE `sasaran_imunisasi_bayi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idDesa` bigint(20) UNSIGNED NOT NULL,
  `jumlah_sasaran_bayi_laki` int(11) NOT NULL,
  `jumlah_sasaran_bayi_perempuan` int(11) NOT NULL,
  `jumlah_surviving_infant_laki` int(11) NOT NULL,
  `jumlah_surviving_infant_perempuan` int(11) NOT NULL,
  `bulan` enum('1','2','3','4','5','6','7','8','9','10','11','12') NOT NULL,
  `tahun` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sasaran_imunisasi_wus`
--

CREATE TABLE `sasaran_imunisasi_wus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idDesa` bigint(20) UNSIGNED NOT NULL,
  `jumlahSasaran` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nip` varchar(18) NOT NULL,
  `password` varchar(255) NOT NULL,
  `imageUrl` varchar(255) NOT NULL,
  `level` enum('Admin','Kepala Puskesmas','Petugas UKM') NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `nip`, `password`, `imageUrl`, `level`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fathur', 'AdminFathur', '001122334455667788', '$2y$12$2BAMnlPaV99IkZm2v1xIcO/OFwIvWeXCOdABOunXgIQRAIFUsOWQ6', 'profile.png', 'Admin', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wilayah_kerja`
--

CREATE TABLE `wilayah_kerja` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaDesa` varchar(255) NOT NULL,
  `lat` double(8,2) NOT NULL,
  `lon` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `wilayah_kerja`
--

INSERT INTO `wilayah_kerja` (`id`, `namaDesa`, `lat`, `lon`, `created_at`, `updated_at`) VALUES
(1, 'cantigi kulon', -633.00, 108.00, '2024-07-10 06:12:14', '2024-07-10 06:12:14'),
(2, 'cantigi wetan', -634.00, 108.00, '2024-07-10 06:12:14', '2024-07-10 06:12:14'),
(3, 'cangkring', -631.00, 108.00, '2024-07-10 06:12:14', '2024-07-10 06:12:14'),
(4, 'lamarantarung', -634.00, 108.00, '2024-07-10 06:12:14', '2024-07-10 06:12:14'),
(5, 'penyangkringan kidul', -635.00, 108.00, '2024-07-10 06:12:14', '2024-07-10 06:12:14'),
(6, 'penyangkringan lor', -633.00, 108.00, '2024-07-10 06:12:14', '2024-07-10 06:12:14');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `access_features`
--
ALTER TABLE `access_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_features_iddivisi_foreign` (`idDivisi`),
  ADD KEY `access_features_iduser_foreign` (`idUser`);

--
-- Indeks untuk tabel `category_p2`
--
ALTER TABLE `category_p2`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_ukbm`
--
ALTER TABLE `data_ukbm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_ukbm_iddesa_foreign` (`idDesa`),
  ADD KEY `data_ukbm_idjenisukbm_foreign` (`idJenisUkbm`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_imunisasi_baduta`
--
ALTER TABLE `jenis_imunisasi_baduta`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_imunisasi_bayi`
--
ALTER TABLE `jenis_imunisasi_bayi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_imunisasi_wus`
--
ALTER TABLE `jenis_imunisasi_wus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_ukbm`
--
ALTER TABLE `jenis_ukbm`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan_kesling`
--
ALTER TABLE `kegiatan_kesling`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan_program_kesehatan_sekolahs`
--
ALTER TABLE `kegiatan_program_kesehatan_sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kegiatan_program_kia_gizis`
--
ALTER TABLE `kegiatan_program_kia_gizis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_program_kia_gizis_idprogramkiagizi_foreign` (`idProgramKiaGizi`);

--
-- Indeks untuk tabel `kegiatan_program_pengendalian_penyakit`
--
ALTER TABLE `kegiatan_program_pengendalian_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_program_pengendalian_penyakit_idprogram_foreign` (`idProgram`);

--
-- Indeks untuk tabel `kegiatan_program_promkes`
--
ALTER TABLE `kegiatan_program_promkes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kegiatan_program_promkes_idprogram_foreign` (`idProgram`);

--
-- Indeks untuk tabel `kegiatan_promosi_kesehatan_umum_desa`
--
ALTER TABLE `kegiatan_promosi_kesehatan_umum_desa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas_siswas`
--
ALTER TABLE `kelas_siswas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporan_imunisasi_baduta`
--
ALTER TABLE `laporan_imunisasi_baduta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_imunisasi_baduta_idsasaranimunisasi_foreign` (`idSasaranImunisasi`),
  ADD KEY `laporan_imunisasi_baduta_idjenisimunisasi_foreign` (`idJenisImunisasi`);

--
-- Indeks untuk tabel `laporan_imunisasi_bayi`
--
ALTER TABLE `laporan_imunisasi_bayi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_imunisasi_bayi_idjenisimunisasi_foreign` (`idJenisImunisasi`),
  ADD KEY `laporan_imunisasi_bayi_idsasaran_foreign` (`idSasaran`);

--
-- Indeks untuk tabel `laporan_imunisasi_wus`
--
ALTER TABLE `laporan_imunisasi_wus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporan_imunisasi_wus_idsasaran_foreign` (`idSasaran`),
  ADD KEY `laporan_imunisasi_wus_idjenis_foreign` (`idJenis`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pencatatan_data_kesling`
--
ALTER TABLE `pencatatan_data_kesling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_data_kesling_idkegiatankesling_foreign` (`idKegiatanKesling`);

--
-- Indeks untuk tabel `pencatatan_data_ukbm`
--
ALTER TABLE `pencatatan_data_ukbm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_data_ukbm_iddataukbm_foreign` (`idDataUkbm`);

--
-- Indeks untuk tabel `pencatatan_kegiatan_program_kesehatan_sekolahs`
--
ALTER TABLE `pencatatan_kegiatan_program_kesehatan_sekolahs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pencatatan_kegiatan_program_kia_gizis`
--
ALTER TABLE `pencatatan_kegiatan_program_kia_gizis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pencatatan_kegiatan_program_promkes`
--
ALTER TABLE `pencatatan_kegiatan_program_promkes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kegiatan_program` (`idKegiatanProgramPromkes`);

--
-- Indeks untuk tabel `pencatatan_kegiatan_promkes_desa`
--
ALTER TABLE `pencatatan_kegiatan_promkes_desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_kegiatan_promkes_desa_idkegiatanpromkesdesa_foreign` (`idKegiatanPromKesDesa`),
  ADD KEY `pencatatan_kegiatan_promkes_desa_iddesa_foreign` (`idDesa`);

--
-- Indeks untuk tabel `pencatatan_program_pengendalian_penyakit`
--
ALTER TABLE `pencatatan_program_pengendalian_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pencatatan_program_pengendalian_penyakit_idkegiatan_foreign` (`idKegiatan`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `program_divisi_promkes`
--
ALTER TABLE `program_divisi_promkes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `program_kia_gizis`
--
ALTER TABLE `program_kia_gizis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `program_pengendalian_penyakit`
--
ALTER TABLE `program_pengendalian_penyakit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_pengendalian_penyakit_idcategory_foreign` (`idCategory`);

--
-- Indeks untuk tabel `sasaran_imunisasi_baduta`
--
ALTER TABLE `sasaran_imunisasi_baduta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sasaran_imunisasi_baduta_iddesa_foreign` (`idDesa`);

--
-- Indeks untuk tabel `sasaran_imunisasi_bayi`
--
ALTER TABLE `sasaran_imunisasi_bayi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sasaran_imunisasi_bayi_iddesa_foreign` (`idDesa`);

--
-- Indeks untuk tabel `sasaran_imunisasi_wus`
--
ALTER TABLE `sasaran_imunisasi_wus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sasaran_imunisasi_wus_iddesa_foreign` (`idDesa`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- Indeks untuk tabel `wilayah_kerja`
--
ALTER TABLE `wilayah_kerja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `access_features`
--
ALTER TABLE `access_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `category_p2`
--
ALTER TABLE `category_p2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_ukbm`
--
ALTER TABLE `data_ukbm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_imunisasi_baduta`
--
ALTER TABLE `jenis_imunisasi_baduta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenis_imunisasi_bayi`
--
ALTER TABLE `jenis_imunisasi_bayi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `jenis_imunisasi_wus`
--
ALTER TABLE `jenis_imunisasi_wus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jenis_ukbm`
--
ALTER TABLE `jenis_ukbm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_kesling`
--
ALTER TABLE `kegiatan_kesling`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_program_kesehatan_sekolahs`
--
ALTER TABLE `kegiatan_program_kesehatan_sekolahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_program_kia_gizis`
--
ALTER TABLE `kegiatan_program_kia_gizis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_program_pengendalian_penyakit`
--
ALTER TABLE `kegiatan_program_pengendalian_penyakit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_program_promkes`
--
ALTER TABLE `kegiatan_program_promkes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kegiatan_promosi_kesehatan_umum_desa`
--
ALTER TABLE `kegiatan_promosi_kesehatan_umum_desa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `kelas_siswas`
--
ALTER TABLE `kelas_siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_imunisasi_baduta`
--
ALTER TABLE `laporan_imunisasi_baduta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_imunisasi_bayi`
--
ALTER TABLE `laporan_imunisasi_bayi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `laporan_imunisasi_wus`
--
ALTER TABLE `laporan_imunisasi_wus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_data_kesling`
--
ALTER TABLE `pencatatan_data_kesling`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_data_ukbm`
--
ALTER TABLE `pencatatan_data_ukbm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_kegiatan_program_kesehatan_sekolahs`
--
ALTER TABLE `pencatatan_kegiatan_program_kesehatan_sekolahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_kegiatan_program_kia_gizis`
--
ALTER TABLE `pencatatan_kegiatan_program_kia_gizis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_kegiatan_program_promkes`
--
ALTER TABLE `pencatatan_kegiatan_program_promkes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_kegiatan_promkes_desa`
--
ALTER TABLE `pencatatan_kegiatan_promkes_desa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pencatatan_program_pengendalian_penyakit`
--
ALTER TABLE `pencatatan_program_pengendalian_penyakit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `program_divisi_promkes`
--
ALTER TABLE `program_divisi_promkes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `program_kia_gizis`
--
ALTER TABLE `program_kia_gizis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `program_pengendalian_penyakit`
--
ALTER TABLE `program_pengendalian_penyakit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `sasaran_imunisasi_baduta`
--
ALTER TABLE `sasaran_imunisasi_baduta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sasaran_imunisasi_bayi`
--
ALTER TABLE `sasaran_imunisasi_bayi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sasaran_imunisasi_wus`
--
ALTER TABLE `sasaran_imunisasi_wus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wilayah_kerja`
--
ALTER TABLE `wilayah_kerja`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `access_features`
--
ALTER TABLE `access_features`
  ADD CONSTRAINT `access_features_iddivisi_foreign` FOREIGN KEY (`idDivisi`) REFERENCES `divisi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `access_features_iduser_foreign` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_ukbm`
--
ALTER TABLE `data_ukbm`
  ADD CONSTRAINT `data_ukbm_iddesa_foreign` FOREIGN KEY (`idDesa`) REFERENCES `wilayah_kerja` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `data_ukbm_idjenisukbm_foreign` FOREIGN KEY (`idJenisUkbm`) REFERENCES `jenis_ukbm` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan_program_kia_gizis`
--
ALTER TABLE `kegiatan_program_kia_gizis`
  ADD CONSTRAINT `kegiatan_program_kia_gizis_idprogramkiagizi_foreign` FOREIGN KEY (`idProgramKiaGizi`) REFERENCES `program_kia_gizis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan_program_pengendalian_penyakit`
--
ALTER TABLE `kegiatan_program_pengendalian_penyakit`
  ADD CONSTRAINT `kegiatan_program_pengendalian_penyakit_idprogram_foreign` FOREIGN KEY (`idProgram`) REFERENCES `program_pengendalian_penyakit` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kegiatan_program_promkes`
--
ALTER TABLE `kegiatan_program_promkes`
  ADD CONSTRAINT `kegiatan_program_promkes_idprogram_foreign` FOREIGN KEY (`idProgram`) REFERENCES `program_divisi_promkes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_imunisasi_baduta`
--
ALTER TABLE `laporan_imunisasi_baduta`
  ADD CONSTRAINT `laporan_imunisasi_baduta_idjenisimunisasi_foreign` FOREIGN KEY (`idJenisImunisasi`) REFERENCES `jenis_imunisasi_baduta` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_imunisasi_baduta_idsasaranimunisasi_foreign` FOREIGN KEY (`idSasaranImunisasi`) REFERENCES `sasaran_imunisasi_baduta` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_imunisasi_bayi`
--
ALTER TABLE `laporan_imunisasi_bayi`
  ADD CONSTRAINT `laporan_imunisasi_bayi_idjenisimunisasi_foreign` FOREIGN KEY (`idJenisImunisasi`) REFERENCES `jenis_imunisasi_bayi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_imunisasi_bayi_idsasaran_foreign` FOREIGN KEY (`idSasaran`) REFERENCES `sasaran_imunisasi_bayi` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `laporan_imunisasi_wus`
--
ALTER TABLE `laporan_imunisasi_wus`
  ADD CONSTRAINT `laporan_imunisasi_wus_idjenis_foreign` FOREIGN KEY (`idJenis`) REFERENCES `jenis_imunisasi_wus` (`id`),
  ADD CONSTRAINT `laporan_imunisasi_wus_idsasaran_foreign` FOREIGN KEY (`idSasaran`) REFERENCES `sasaran_imunisasi_wus` (`id`);

--
-- Ketidakleluasaan untuk tabel `pencatatan_data_kesling`
--
ALTER TABLE `pencatatan_data_kesling`
  ADD CONSTRAINT `pencatatan_data_kesling_idkegiatankesling_foreign` FOREIGN KEY (`idKegiatanKesling`) REFERENCES `kegiatan_kesling` (`id`);

--
-- Ketidakleluasaan untuk tabel `pencatatan_data_ukbm`
--
ALTER TABLE `pencatatan_data_ukbm`
  ADD CONSTRAINT `pencatatan_data_ukbm_iddataukbm_foreign` FOREIGN KEY (`idDataUkbm`) REFERENCES `data_ukbm` (`id`);

--
-- Ketidakleluasaan untuk tabel `pencatatan_kegiatan_program_promkes`
--
ALTER TABLE `pencatatan_kegiatan_program_promkes`
  ADD CONSTRAINT `fk_kegiatan_program` FOREIGN KEY (`idKegiatanProgramPromkes`) REFERENCES `kegiatan_program_promkes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pencatatan_kegiatan_promkes_desa`
--
ALTER TABLE `pencatatan_kegiatan_promkes_desa`
  ADD CONSTRAINT `pencatatan_kegiatan_promkes_desa_iddesa_foreign` FOREIGN KEY (`idDesa`) REFERENCES `wilayah_kerja` (`id`),
  ADD CONSTRAINT `pencatatan_kegiatan_promkes_desa_idkegiatanpromkesdesa_foreign` FOREIGN KEY (`idKegiatanPromKesDesa`) REFERENCES `kegiatan_promosi_kesehatan_umum_desa` (`id`);

--
-- Ketidakleluasaan untuk tabel `pencatatan_program_pengendalian_penyakit`
--
ALTER TABLE `pencatatan_program_pengendalian_penyakit`
  ADD CONSTRAINT `pencatatan_program_pengendalian_penyakit_idkegiatan_foreign` FOREIGN KEY (`idKegiatan`) REFERENCES `kegiatan_program_pengendalian_penyakit` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `program_pengendalian_penyakit`
--
ALTER TABLE `program_pengendalian_penyakit`
  ADD CONSTRAINT `program_pengendalian_penyakit_idcategory_foreign` FOREIGN KEY (`idCategory`) REFERENCES `category_p2` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sasaran_imunisasi_baduta`
--
ALTER TABLE `sasaran_imunisasi_baduta`
  ADD CONSTRAINT `sasaran_imunisasi_baduta_iddesa_foreign` FOREIGN KEY (`idDesa`) REFERENCES `wilayah_kerja` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sasaran_imunisasi_bayi`
--
ALTER TABLE `sasaran_imunisasi_bayi`
  ADD CONSTRAINT `sasaran_imunisasi_bayi_iddesa_foreign` FOREIGN KEY (`idDesa`) REFERENCES `wilayah_kerja` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sasaran_imunisasi_wus`
--
ALTER TABLE `sasaran_imunisasi_wus`
  ADD CONSTRAINT `sasaran_imunisasi_wus_iddesa_foreign` FOREIGN KEY (`idDesa`) REFERENCES `wilayah_kerja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
