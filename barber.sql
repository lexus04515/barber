-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2024 pada 11.34
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(8, 'admin2', '123', 'admin2', '08888888888', 'admin2@gmail.com');

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
(55, 123, '64522a4de1d9a.png', '2023-05-03', 'Terkonfirmasi'),
(56, 127, '652df538ee439.png', '2023-10-17', 'Terkonfirmasi'),
(57, 128, '652df606de5e8.png', '2023-10-17', 'Terkonfirmasi'),
(58, 129, '66602d738d977.jpeg', '2024-06-05', 'Terkonfirmasi');

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
(123, 98, 23, '2023-05-03', 2, '2023-05-03 16:23:00', '2023-05-03 18:23:00', 30000, 60000),
(124, 0, 0, '2023-10-17', 0, '0000-00-00 00:00:00', '1970-01-01 01:00:00', 0, 0),
(125, 0, 0, '2023-10-17', 0, '0000-00-00 00:00:00', '1970-01-01 01:00:00', 0, 0),
(126, 98, 0, '2023-10-17', 0, '0000-00-00 00:00:00', '1970-01-01 01:00:00', 30000, 30000),
(127, 98, 24, '2023-10-17', 2, '2023-10-17 09:43:00', '2023-10-17 11:43:00', 20000, 40000),
(128, 98, 25, '2023-10-17', 2, '2023-10-17 09:48:00', '2023-10-17 11:48:00', 30000, 60000),
(129, 100, 24, '2024-06-05', 19, '2024-06-28 16:17:00', '2024-06-29 11:17:00', 20000, 380000);

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
(23, 'Bronze2', 'ini lapangan Dewa', 10000, 'footbal.jpg'),
(24, 'Silver', 'Ini Lapangan Emas', 20000, 'badmintoon.jpg'),
(25, 'Gold', 'Ini Lapangan Silver', 30000, 'basket.jpg'),
(26, 'Diamond', 'Ini Lapangan Golf4', 40000, 'futsal.jpg'),
(27, '', '', 0, '652df02080f44.png'),
(29, 'test', '', 123, '652df064de52f.png'),
(30, 'haircut', '', 40, '66602e5e310ce.jpeg');

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
(98, 'geraldshrn@gmail.com', 'm212279', '082197252774', 'Laki-laki', 'Gerald Sharon Ratu', 'Bekasi', '645229918b946.jpg'),
(100, 'zuma@gmail.com', '123', '123', 'Laki-Laki', 'zuma', 'sleman', '66602cada78ff.jpeg');

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
  MODIFY `barber_id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `bayar_barber`
--
ALTER TABLE `bayar_barber`
  MODIFY `barber_id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `booking_barber`
--
ALTER TABLE `booking_barber`
  MODIFY `barber_id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT untuk tabel `layanan_barber`
--
ALTER TABLE `layanan_barber`
  MODIFY `barber_id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `user_barber`
--
ALTER TABLE `user_barber`
  MODIFY `barber_id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
