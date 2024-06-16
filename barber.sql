-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2024 pada 11.15
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `barber`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_barber`
--

CREATE TABLE `admin_barber` (
  `barber_id_user` int(3) NOT NULL,
  `barber_username` varchar(20) NOT NULL,
  `barber_password` varchar(20) NOT NULL,
  `barber_nama` varchar(50) NOT NULL,
  `barber_no_handphone` varchar(15) NOT NULL,
  `barber_email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin_barber`
--

INSERT INTO `admin_barber` (`barber_id_user`, `barber_username`, `barber_password`, `barber_nama`, `barber_no_handphone`, `barber_email`) VALUES
(1, 'admin', '123', 'admin', '08123456789', 'admin@gmail.com'),
(9, 'admin9', '123', 'rian', '132454657', 'admin9@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar_barber`
--

CREATE TABLE `bayar_barber` (
  `barber_id_bayar` int(11) NOT NULL,
  `barber_id_booking` int(11) NOT NULL,
  `barber_bukti` text NOT NULL,
  `barber_tanggal_upload` date NOT NULL DEFAULT current_timestamp(),
  `barber_konfirmasi` varchar(50) NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bayar_barber`
--

INSERT INTO `bayar_barber` (`barber_id_bayar`, `barber_id_booking`, `barber_bukti`, `barber_tanggal_upload`, `barber_konfirmasi`) VALUES
(64, 153, '666dabd4e3dd6.png', '2024-06-15', 'Terkonfirmasi'),
(65, 154, '666dae340abc1.png', '2024-06-15', 'Sudah Bayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_barber`
--

CREATE TABLE `booking_barber` (
  `barber_id_booking` int(11) NOT NULL,
  `barber_id_user` int(11) NOT NULL,
  `barber_id_layanan` int(11) NOT NULL,
  `barber_tanggal_pesan` date NOT NULL DEFAULT current_timestamp(),
  `barber_lama_booking` int(11) NOT NULL,
  `barber_jam_mulai` datetime NOT NULL,
  `barber_jam_habis` datetime NOT NULL,
  `barber_harga` int(11) NOT NULL,
  `barber_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `booking_barber`
--

INSERT INTO `booking_barber` (`barber_id_booking`, `barber_id_user`, `barber_id_layanan`, `barber_tanggal_pesan`, `barber_lama_booking`, `barber_jam_mulai`, `barber_jam_habis`, `barber_harga`, `barber_total`) VALUES
(153, 102, 31, '2024-06-15', 2, '2024-06-15 21:48:00', '2024-06-15 23:48:00', 50000, 100000),
(154, 103, 35, '2024-06-15', 1, '2024-06-15 22:07:00', '2024-06-15 23:07:00', 35000, 35000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan_barber`
--

CREATE TABLE `layanan_barber` (
  `barber_id_layanan` int(11) NOT NULL,
  `barber_nama` varchar(35) NOT NULL,
  `barber_keterangan` text NOT NULL,
  `barber_harga` int(11) NOT NULL,
  `barber_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `layanan_barber`
--

INSERT INTO `layanan_barber` (`barber_id_layanan`, `barber_nama`, `barber_keterangan`, `barber_harga`, `barber_foto`) VALUES
(31, 'Hair Coloring', '', 50000, '666078a1a996a.jpg'),
(32, 'Beard Grooming', '', 25000, '666078d11dcfc.jpg'),
(35, 'Hair Cut', '', 35000, '6660791829166.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_barber`
--

CREATE TABLE `user_barber` (
  `barber_id_user` int(11) NOT NULL,
  `barber_email` varchar(50) NOT NULL,
  `barber_password` varchar(32) NOT NULL,
  `barber_no_handphone` varchar(20) NOT NULL,
  `barber_jenis_kelamin` varchar(10) NOT NULL,
  `barber_nama_lengkap` varchar(60) NOT NULL,
  `barber_alamat` text NOT NULL,
  `barber_foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_barber`
--

INSERT INTO `user_barber` (`barber_id_user`, `barber_email`, `barber_password`, `barber_no_handphone`, `barber_jenis_kelamin`, `barber_nama_lengkap`, `barber_alamat`, `barber_foto`) VALUES
(103, 'wyldan@gmail.com', '789', '0857654321', 'Laki-Laki', 'Wyldan Saharaputra', 'Kulon Progo', '666da951738c6.jpg'),
(102, 'zuma@gmail.com', '123', '08134567890', 'Laki-Laki', 'Muhammad Haizuma', 'Batang', '666da926d8f6b.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_barber`
--
ALTER TABLE `admin_barber`
  ADD PRIMARY KEY (`barber_id_user`);

--
-- Indeks untuk tabel `bayar_barber`
--
ALTER TABLE `bayar_barber`
  ADD PRIMARY KEY (`barber_id_bayar`);

--
-- Indeks untuk tabel `booking_barber`
--
ALTER TABLE `booking_barber`
  ADD PRIMARY KEY (`barber_id_booking`);

--
-- Indeks untuk tabel `layanan_barber`
--
ALTER TABLE `layanan_barber`
  ADD PRIMARY KEY (`barber_id_layanan`);

--
-- Indeks untuk tabel `user_barber`
--
ALTER TABLE `user_barber`
  ADD PRIMARY KEY (`barber_id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_barber`
--
ALTER TABLE `admin_barber`
  MODIFY `barber_id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `bayar_barber`
--
ALTER TABLE `bayar_barber`
  MODIFY `barber_id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `booking_barber`
--
ALTER TABLE `booking_barber`
  MODIFY `barber_id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT untuk tabel `layanan_barber`
--
ALTER TABLE `layanan_barber`
  MODIFY `barber_id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `user_barber`
--
ALTER TABLE `user_barber`
  MODIFY `barber_id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
