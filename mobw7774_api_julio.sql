-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Jul 2024 pada 01.37
-- Versi server: 10.3.39-MariaDB-cll-lve
-- Versi PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobw7774_api_julio`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `janji`
--

CREATE TABLE `janji` (
  `id` int(11) NOT NULL,
  `mekanik` varchar(255) DEFAULT NULL,
  `pengecetan` varchar(255) DEFAULT NULL,
  `hari` varchar(255) DEFAULT NULL,
  `jam` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `manfaat` text DEFAULT NULL,
  `garansi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `janji`
--

INSERT INTO `janji` (`id`, `mekanik`, `pengecetan`, `hari`, `jam`, `jenis`, `manfaat`, `garansi`, `created_at`) VALUES
(21, 'Rizal Aditya Nugrah', 'Full Body', 'Senin - Rabu', '09.00 - 11.00', 'full service', 'mencegah terjadi nya turun mesin', '6 bulan', '2024-07-11 17:48:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `manfaat` text NOT NULL,
  `garansi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`id`, `jenis`, `manfaat`, `garansi`) VALUES
(1, 'full service', 'mencegah terjadi nya turun mesin', '6 bulan'),
(2, 'service rutin', 'mencegah terjadi nya kerusakan yang parah', '1 bulan'),
(3, 'ganti oli', 'menghindari karat pada mesin motor Anda', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(1, 'julio', 'julio', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `warna`
--

CREATE TABLE `warna` (
  `id` int(11) NOT NULL,
  `mekanik` varchar(100) DEFAULT NULL,
  `pengecetan` varchar(50) DEFAULT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `jam` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `warna`
--

INSERT INTO `warna` (`id`, `mekanik`, `pengecetan`, `hari`, `jam`) VALUES
(1, 'Rizal Aditya Nugrah', 'Full Body', 'Senin - Rabu', '09.00 - 11.00'),
(2, 'Mulyadi Saputra', 'Full Carbon', 'Selasa - Kamis', '09.00 - 11.00'),
(3, 'Rinald Alfarizi', 'Body depan', 'Kamis - Sabtu', '13.00 - 16.00'),
(4, 'Wisnu Alkasiri', 'Body Belakang', 'Senin - Jumat', '08.00 - 16.00'),
(5, 'Yudha Julio junaidi', 'Body samping', 'Kamis - Sabtu', '10.00 - 14.00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `janji`
--
ALTER TABLE `janji`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `warna`
--
ALTER TABLE `warna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `janji`
--
ALTER TABLE `janji`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `warna`
--
ALTER TABLE `warna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
