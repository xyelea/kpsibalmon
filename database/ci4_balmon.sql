-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2020 pada 09.41
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_balmon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Bus', 'Active'),
(2, 'Mini Bus', 'Active');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kendaraan`
--

CREATE TABLE `kendaraan` (
  `kendaraan_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kendaraan_name` varchar(100) NOT NULL,
  `no_plat` varchar(100) NOT NULL,
  `kendaraan_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `kendaraan_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kendaraan`
--

INSERT INTO `kendaraan` (`kendaraan_id`, `category_id`, `kendaraan_name`, `no_plat`, `kendaraan_status`, `kendaraan_image`) VALUES
(1, 1, 'Fuso', 'BG1223GH', 'Active', '1604026199_c2683b348f77145e4361.jpg'),
(2, 2, 'Avanza', 'BD222HG', 'Active', '1604026233_d13dbf61d747872709a1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-10-18-073759', 'App\\Database\\Migrations\\Categories', 'default', 'App', 1603986193, 1),
(2, '2020-10-18-073938', 'App\\Database\\Migrations\\Kendaraan', 'default', 'App', 1603986193, 1),
(3, '2020-10-18-074144', 'App\\Database\\Migrations\\Servis', 'default', 'App', 1603986264, 2),
(4, '2020-10-18-074359', 'App\\Database\\Migrations\\Users', 'default', 'App', 1603986265, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `service`
--

CREATE TABLE `service` (
  `svc_id` bigint(20) UNSIGNED NOT NULL,
  `kendaraan_id` bigint(20) UNSIGNED DEFAULT NULL,
  `no_plat` varchar(100) NOT NULL,
  `svc_price` int(11) NOT NULL,
  `svc_date` date NOT NULL,
  `svc_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `service`
--

INSERT INTO `service` (`svc_id`, `kendaraan_id`, `no_plat`, `svc_price`, `svc_date`, `svc_desc`) VALUES
(1, 1, 'BG1223GH', 200000, '2019-02-03', 'Servis Ban Mobil'),
(2, 1, 'BG1223GH', 200000, '2019-02-03', 'Servis Ban Mobil'),
(3, 1, 'BG1223GH', 200000, '2020-02-03', 'Servis Mesin Mobil'),
(4, 2, 'BD222HG', 300000, '2020-03-04', 'Ganti Oli');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `level` enum('Admin','User') NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `status`, `level`) VALUES
(1, 'admin', 'Admin', 'admin@example.com', '$2y$10$sOKww3LkoNzBtuW5SKxcJOVcY5eN3L1UsTMZpzgWLDd5MfiZ2mmNe', 'Active', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`kendaraan_id`),
  ADD KEY `kendaraan_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`svc_id`),
  ADD KEY `service_kendaraan_id_foreign` (`kendaraan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `kendaraan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `service`
--
ALTER TABLE `service`
  MODIFY `svc_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`kendaraan_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
