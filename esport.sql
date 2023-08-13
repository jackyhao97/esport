-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2023 pada 11.03
-- Versi server: 10.4.8-MariaDB
-- Versi PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esport`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_account`
--

CREATE TABLE `tb_account` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipe` int(11) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `path` varchar(100) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `is_verified` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_account`
--

INSERT INTO `tb_account` (`id`, `nama`, `username`, `password`, `email`, `tipe`, `nomor`, `path`, `is_active`, `created_on`, `modified_on`, `is_verified`) VALUES
(6, 'hoges', 'hoges', '0192023a7bbd73250516f069df18b500', 'hoges@gmail.com', 2, '081272727272', 'user.png', 1, '2023-03-27 16:12:59', '2023-05-12 20:16:29', 1),
(7, 'jeffry', 'jeffry', '0192023a7bbd73250516f069df18b500', 'jeffry@gmail.com', 2, '08124545454', 'user.png', 1, '2023-04-01 16:07:08', '2023-05-12 20:15:41', 1),
(14, 'admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@gmail.com', 1, '08124545454', 'user.png', 1, '2023-04-01 16:07:08', '2023-05-12 20:15:41', 1),
(15, 'eo', 'eo', '0192023a7bbd73250516f069df18b500', 'eo@gmail.com', 3, '08124545454', 'user.png', 1, '2023-04-01 16:07:08', '2023-05-12 20:15:41', 1),
(20, 'eoo', 'eoo', '0192023a7bbd73250516f069df18b500', 'eoo@gmail.com', 3, '081245456565', '', 1, '2023-08-03 20:48:02', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_event`
--

CREATE TABLE `tb_event` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tipe` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `prize_pool` int(11) NOT NULL,
  `max_slot` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `genre_game` varchar(255) NOT NULL,
  `lokasi` text NOT NULL,
  `history` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `tgl_event_awal` date NOT NULL,
  `tgl_event_akhir` date NOT NULL,
  `is_verified` int(1) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_event`
--

INSERT INTO `tb_event` (`id`, `nama`, `tipe`, `jenis`, `prize_pool`, `max_slot`, `genre`, `genre_game`, `lokasi`, `history`, `path`, `tgl_event_awal`, `tgl_event_akhir`, `is_verified`, `is_active`, `created_on`, `created_by`) VALUES
(11, 'Mobile Legends City League Indonesia (MCL ID) Season 12', 1, 2, 100000000, 20, '1,0,0,0,0', 'moba', 'Jl Ringroad No 10 Medan', 1, 'EVENT_323_1682390132.jpg', '2023-03-15', '2023-04-15', 1, 1, '2023-04-25 04:35:32', 7),
(12, 'Valorant Major Series Season 3', 1, 2, 100000000, 30, '0,1,0,0,0', 'fps', 'Jl Sunggal No 14A Medan', 1, 'EVENT_701_1682398877.jpg', '2023-03-15', '2023-04-15', 1, 1, '2023-04-25 07:01:17', 7),
(13, 'Dunia Games League (DGL) PUBGM 2023', 1, 2, 200000000, 50, '0,1,0,0,0', 'battle-royale', 'Jl Sunggal No 14A Medan', 1, 'EVENT_273_1682399065.jpg', '2023-03-15', '2023-04-15', 1, 1, '2023-04-25 07:04:25', 7),
(14, 'Tekken Indonesia Master (TIM) 2023 Fall', 1, 2, 50000000, 15, '0,0,0,1,0', 'fighting', 'Jl Sekip No 30B Medan', 1, 'EVENT_602_1682399113.jpg', '2023-03-15', '2023-04-15', 1, 1, '2023-04-25 07:05:13', 7),
(15, 'Dota2 Tournament League Medan', 1, 2, 125000000, 30, '1,0,0,0,0', 'moba', 'Jl Guru Patimpus No 213 Medan', 1, 'EVENT_165_1682399158.jpg', '2023-03-15', '2023-04-15', 1, 1, '2023-04-25 07:05:58', 7),
(16, 'Medan Minor League Of Legends 2023 Summer', 1, 2, 65000000, 25, '1,0,0,0,0', 'moba', 'Jl Ringroad Gagak Hitam No 10 Medan', 1, 'EVENT_904_1682399205.jpg', '2023-03-15', '2023-04-15', 1, 1, '2023-04-25 07:06:45', 7),
(23, 'Gelar Talkshow & Event Berhadiah! Nimo TV Siap Siarkan MPL ID S8', 2, 2, 0, 0, '1,0,0,0,0', 'talkshow', 'Jl. Cut Mutia No.1, Madras Hulu, Kec. Medan Polonia, Kota Medan, Sumatera Utara 20212', 1, 'EVENT_759_1683898702.jpg', '2023-06-03', '2023-06-03', 1, 1, '2023-05-12 15:38:22', 7),
(25, 'Valorant Major Series Season 2', 1, 2, 100000000, 10, '', 'fps', 'Jl. Cut Mutia No.1, Madras Hulu, Kec. Medan Polonia, Kota Medan, Sumatera Utara 20212', 1, 'EVENT_617_1683899804.jpg', '2023-05-12', '2023-05-13', 1, 1, '2023-05-12 15:56:44', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_genre`
--

CREATE TABLE `tb_genre` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_genre`
--

INSERT INTO `tb_genre` (`id`, `genre`, `deskripsi`, `is_active`) VALUES
(1, 'moba', 'Moba', 1),
(2, 'fps', 'FPS', 1),
(3, 'battle-royale', 'Battle Royale', 1),
(4, 'fighting', 'Fighting', 1),
(5, 'talkshow', 'Talkshow', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_harga_paket`
--

CREATE TABLE `tb_harga_paket` (
  `id` int(11) NOT NULL,
  `post_eo_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `dekorasi_a` int(11) NOT NULL,
  `event_a` int(11) NOT NULL,
  `panggung_a` int(11) NOT NULL,
  `total_a` int(11) NOT NULL,
  `dekorasi_b` int(11) NOT NULL,
  `event_b` int(11) NOT NULL,
  `panggung_b` int(11) NOT NULL,
  `total_b` int(11) NOT NULL,
  `is_paket_a` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_harga_paket`
--

INSERT INTO `tb_harga_paket` (`id`, `post_eo_id`, `is_active`, `created_on`, `created_by`, `dekorasi_a`, `event_a`, `panggung_a`, `total_a`, `dekorasi_b`, `event_b`, `panggung_b`, `total_b`, `is_paket_a`) VALUES
(1, 2, 1, '2023-04-21 00:00:00', 6, 1750000, 2500000, 3000000, 7250000, 0, 0, 0, 0, 1),
(3, 2, 1, '2023-05-01 00:00:00', 6, 0, 0, 0, 0, 1250000, 1500000, 2000000, 4750000, 0),
(8, 4, 1, '2023-05-01 07:37:43', 7, 1250000, 1500000, 2000000, 4750000, 0, 0, 0, 0, 1),
(9, 4, 1, '2023-05-01 07:37:43', 7, 0, 0, 0, 0, 1750000, 2500000, 3000000, 7250000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_history_bobot`
--

CREATE TABLE `tb_history_bobot` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `bobot` decimal(4,4) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_history_bobot`
--

INSERT INTO `tb_history_bobot` (`id`, `event_id`, `bobot`, `created_on`, `created_by`) VALUES
(1837, 25, '0.9999', '2023-07-22 07:08:24', 7),
(1838, 23, '0.0000', '2023-07-22 07:08:24', 7),
(1839, 16, '0.0000', '2023-07-22 07:08:24', 7),
(1840, 15, '0.0000', '2023-07-22 07:08:24', 7),
(1841, 14, '0.0000', '2023-07-22 07:08:24', 7),
(1842, 13, '0.0000', '2023-07-22 07:08:24', 7),
(1843, 12, '0.8000', '2023-07-22 07:08:24', 7),
(1844, 11, '0.1491', '2023-07-22 07:08:24', 7),
(1909, 25, '0.0000', '2023-07-22 12:15:49', 6),
(1910, 23, '0.0000', '2023-07-22 12:15:49', 6),
(1911, 16, '0.3780', '2023-07-22 12:15:49', 6),
(1912, 15, '0.9999', '2023-07-22 12:15:49', 6),
(1913, 14, '0.0000', '2023-07-22 12:15:49', 6),
(1914, 13, '0.2041', '2023-07-22 12:15:49', 6),
(1915, 12, '0.0000', '2023-07-22 12:15:49', 6),
(1916, 11, '0.1667', '2023-07-22 12:15:49', 6),
(1957, 25, '0.9999', '2023-08-03 20:54:00', 14),
(1958, 23, '0.0000', '2023-08-03 20:54:00', 14),
(1959, 16, '0.0000', '2023-08-03 20:54:00', 14),
(1960, 15, '0.0000', '2023-08-03 20:54:00', 14),
(1961, 14, '0.0000', '2023-08-03 20:54:00', 14),
(1962, 13, '0.0000', '2023-08-03 20:54:00', 14),
(1963, 12, '0.8000', '2023-08-03 20:54:00', 14),
(1964, 11, '0.1491', '2023-08-03 20:54:00', 14),
(1965, 25, '0.0000', '2023-08-03 20:54:17', 20),
(1966, 23, '0.0000', '2023-08-03 20:54:17', 20),
(1967, 16, '0.9999', '2023-08-03 20:54:17', 20),
(1968, 15, '0.3780', '2023-08-03 20:54:17', 20),
(1969, 14, '0.1543', '2023-08-03 20:54:17', 20),
(1970, 13, '0.3086', '2023-08-03 20:54:17', 20),
(1971, 12, '0.0000', '2023-08-03 20:54:17', 20),
(1972, 11, '0.2520', '2023-08-03 20:54:17', 20),
(1973, 25, '0.0000', '2023-08-03 20:54:28', 15),
(1974, 23, '0.0000', '2023-08-03 20:54:28', 15),
(1975, 16, '0.1543', '2023-08-03 20:54:28', 15),
(1976, 15, '0.0000', '2023-08-03 20:54:28', 15),
(1977, 14, '0.9999', '2023-08-03 20:54:28', 15),
(1978, 13, '0.1667', '2023-08-03 20:54:28', 15),
(1979, 12, '0.0000', '2023-08-03 20:54:28', 15),
(1980, 11, '0.1361', '2023-08-03 20:54:28', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_history_eo`
--

CREATE TABLE `tb_history_eo` (
  `id` int(11) NOT NULL,
  `harga_paket_id` int(11) NOT NULL,
  `post_eo_id` int(11) NOT NULL,
  `history` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `custom` text NOT NULL,
  `is_paket_a` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_history_eo`
--

INSERT INTO `tb_history_eo` (`id`, `harga_paket_id`, `post_eo_id`, `history`, `created_by`, `created_on`, `custom`, `is_paket_a`) VALUES
(1, 1, 2, 4, 6, '2023-04-21 00:00:00', '', 0),
(3, 1, 4, 4, 7, '2023-05-01 07:12:01', '', 0),
(28, 0, 4, 4, 7, '2023-07-09 05:35:06', 'testing', 0),
(29, 0, 2, 4, 6, '2023-07-10 15:51:20', 'testing', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_history_event`
--

CREATE TABLE `tb_history_event` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `history` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_history_event`
--

INSERT INTO `tb_history_event` (`id`, `event_id`, `history`, `created_by`, `created_on`, `nama`, `email`, `nohp`) VALUES
(6, 25, 3, 7, '2023-05-21 10:06:21', '', '', ''),
(7, 12, 3, 6, '2023-05-21 11:04:56', '', '', ''),
(9, 11, 3, 7, '2023-05-31 16:10:13', 'jeffry', 'jeffry@gmail.com', '081272728383'),
(10, 11, 3, 6, '2023-05-31 16:11:45', 'hoges', 'hoges@gmail.com', '081272373782'),
(12, 12, 3, 7, '2023-06-14 10:59:56', 'jeffry', 'jeffry@gmail.com', '081237377373');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_event`
--

CREATE TABLE `tb_jenis_event` (
  `id` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_event`
--

INSERT INTO `tb_jenis_event` (`id`, `jenis`, `is_active`) VALUES
(1, 'online', 1),
(2, 'offline', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_post_eo`
--

CREATE TABLE `tb_post_eo` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_eo` varchar(255) NOT NULL,
  `is_custom` int(1) NOT NULL,
  `path` varchar(250) NOT NULL,
  `history` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_post_eo`
--

INSERT INTO `tb_post_eo` (`id`, `nama`, `jenis_eo`, `is_custom`, `path`, `history`, `is_active`, `created_on`, `created_by`) VALUES
(2, 'First Organizer EO', '1', 1, 'EO_198_1680705453.PNG', 2, 1, '2023-04-05 16:37:33', 15),
(4, 'One Up Event Organizer', '1', 1, 'EO_663_1682919463.PNG', 2, 1, '2023-05-01 07:37:43', 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sample`
--

CREATE TABLE `tb_sample` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sample`
--

INSERT INTO `tb_sample` (`id`, `genre`, `tag`, `is_active`) VALUES
(1, '1,1,1,0,0', 'moba,fps,battle-royale', 1),
(2, '1,1,0,0,1', 'moba,fps,talkshow', 1),
(3, '1,1,1,1,1', 'moba,fps,battle-royale,fighting,talkshow', 1),
(4, '0,0,1,1,1', 'battle-royele,fighting,talkshow', 1),
(5, '0,1,0,1,0', 'fps,fighting', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe_event`
--

CREATE TABLE `tb_tipe_event` (
  `id` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tipe_event`
--

INSERT INTO `tb_tipe_event` (`id`, `tipe`, `deskripsi`, `is_active`) VALUES
(1, 'tournament', 'Tournament', 1),
(2, 'talkshow', 'Talkshow', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tipe_user`
--

CREATE TABLE `tb_tipe_user` (
  `id` int(11) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tipe_user`
--

INSERT INTO `tb_tipe_user` (`id`, `tipe`, `deskripsi`, `is_active`) VALUES
(1, 'admin', 'Admin', 1),
(2, 'user', 'User', 1),
(3, 'event-organizer', 'Event Organizer', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_account`
--
ALTER TABLE `tb_account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_event`
--
ALTER TABLE `tb_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_genre`
--
ALTER TABLE `tb_genre`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_harga_paket`
--
ALTER TABLE `tb_harga_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_history_bobot`
--
ALTER TABLE `tb_history_bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_history_eo`
--
ALTER TABLE `tb_history_eo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_history_event`
--
ALTER TABLE `tb_history_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jenis_event`
--
ALTER TABLE `tb_jenis_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_post_eo`
--
ALTER TABLE `tb_post_eo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_sample`
--
ALTER TABLE `tb_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tipe_event`
--
ALTER TABLE `tb_tipe_event`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_tipe_user`
--
ALTER TABLE `tb_tipe_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_account`
--
ALTER TABLE `tb_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_event`
--
ALTER TABLE `tb_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `tb_genre`
--
ALTER TABLE `tb_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_harga_paket`
--
ALTER TABLE `tb_harga_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_history_bobot`
--
ALTER TABLE `tb_history_bobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1981;

--
-- AUTO_INCREMENT untuk tabel `tb_history_eo`
--
ALTER TABLE `tb_history_eo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tb_history_event`
--
ALTER TABLE `tb_history_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_event`
--
ALTER TABLE `tb_jenis_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_post_eo`
--
ALTER TABLE `tb_post_eo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_sample`
--
ALTER TABLE `tb_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_tipe_event`
--
ALTER TABLE `tb_tipe_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_tipe_user`
--
ALTER TABLE `tb_tipe_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
