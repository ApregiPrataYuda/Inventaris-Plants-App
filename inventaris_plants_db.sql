-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 12 Bulan Mei 2025 pada 04.03
-- Versi server: 8.0.30
-- Versi PHP: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_plants_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `locations`
--

CREATE TABLE `locations` (
  `id_locations` bigint NOT NULL,
  `name_locations` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description_locations` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `locations`
--

INSERT INTO `locations` (`id_locations`, `name_locations`, `description_locations`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Taman Fakultas Teknik', 'Taman di depan Fakultas Teknik yang sering digunakan mahasiswa untuk berdiskusi.', '2025-05-11 07:57:22', '2025-05-11 07:57:22', NULL),
(2, 'Taman Perpustakaan Pusat', 'Taman kecil di samping perpustakaan pusat, cocok untuk membaca di luar ruangan.', '2025-05-11 07:57:22', '2025-05-11 07:57:22', NULL),
(3, 'Taman Rektorat', 'Taman utama di depan gedung Rektorat sebagai wajah utama kampus.', '2025-05-11 07:57:22', '2025-05-11 07:57:22', NULL),
(4, 'Taman Belakang Asrama', 'Taman di area belakang asrama mahasiswa sebagai tempat relaksasi.', '2025-05-11 07:57:22', '2025-05-11 07:57:22', NULL),
(5, 'Taman Agro Edu', 'Taman edukasi tanaman kampus yang ditujukan untuk praktikum dan pengenalan flora.', '2025-05-11 07:57:22', '2025-05-11 07:57:22', NULL),
(7, 'asaszxzzx', 'asaszxzx', '2025-05-11 02:25:28', '2025-05-11 02:25:38', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_user`
--

CREATE TABLE `ms_user` (
  `id_user` int NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `ms_user`
--

INSERT INTO `ms_user` (`id_user`, `fullname`, `username`, `image`, `password`, `role_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Riski Rht', 'Admin', 'default.jpg', '$2y$12$E27ZbxA157/iPHPOqMO4QuKNOHYxETU1nzOoeSgrwx/YD2VWcGSY2', 1, 1, '2025-05-06 14:03:43', '2025-05-12 10:59:25', NULL),
(2, 'mark zukerberg', 'User', 'default.jpg', '$2y$12$E27ZbxA157/iPHPOqMO4QuKNOHYxETU1nzOoeSgrwx/YD2VWcGSY2', 2, 1, '2025-05-06 14:03:43', '2025-05-10 17:02:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `plants`
--

CREATE TABLE `plants` (
  `id_plants` bigint NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `code_plants` varchar(123) DEFAULT NULL,
  `image` varchar(122) DEFAULT NULL,
  `scientific_name` varchar(150) DEFAULT NULL,
  `category_id` bigint DEFAULT NULL,
  `location_id` bigint DEFAULT NULL,
  `status` enum('healthy','damaged','needs_attention') DEFAULT 'healthy',
  `planting_date` date DEFAULT NULL,
  `notes` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `plants`
--

INSERT INTO `plants` (`id_plants`, `name`, `code_plants`, `image`, `scientific_name`, `category_id`, `location_id`, `status`, `planting_date`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Tanaman Kupu-kupu', 'PLANT-USAKTI-0002', 'cBHb1TPAAj5cMPZnwDb2I7zuaSKiPgbYFlG1vCZ0.jpg', 'Tanaman Kupu-kupu', 9, 4, 'needs_attention', '2025-05-11', 'khkhk', '2025-05-11 08:11:18', '2025-05-11 20:54:18', NULL),
(11, 'Bunga Anthurium (Indoor)', 'PLANT-USAKTI-0003', 'lzhpfeNjUmnCfT0RKmUrAcatFugKBXCw650yuh8M.jpg', 'Bunga Anthurium (Indoor)', 7, 1, 'damaged', '2025-05-12', 'dsdsd', '2025-05-11 10:16:02', '2025-05-11 20:55:20', NULL),
(12, 'Bunga Melati', 'PLANT-USAKTI-0004', 'default.jpg', 'Bunga Melati', 7, 1, 'needs_attention', '2025-05-11', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,', '2025-05-11 10:16:27', '2025-05-11 20:53:55', NULL),
(13, 'Cocor Bebek (Indoor)', 'PLANT-USAKTI-0005', 'default.jpg', 'Cocor Bebek (Indoor)', 10, 4, 'damaged', '2025-05-12', 'tanaman rusak', '2025-05-11 18:31:49', '2025-05-11 20:55:38', NULL),
(14, 'Tanaman Lavender', 'PLANT-USAKTI-0006', 'default.jpg', 'Tanaman Lavender', 7, 2, 'healthy', '2025-05-12', 'dadad', '2025-05-11 20:17:44', '2025-05-11 20:54:57', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `plant_care_logs`
--

CREATE TABLE `plant_care_logs` (
  `id` bigint NOT NULL,
  `id_plants` bigint NOT NULL,
  `care_type` varchar(100) NOT NULL,
  `description` text,
  `care_date` date NOT NULL,
  `performed_by` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `plant_categories`
--

CREATE TABLE `plant_categories` (
  `id_category` bigint NOT NULL,
  `name_category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `plant_categories`
--

INSERT INTO `plant_categories` (`id_category`, `name_category`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'Tanaman Hias Daun', 'Tanaman yang ditanam untuk keindahan daunnya seperti puring, aglaonema, dan caladium.', '2025-05-11 07:03:23', '2025-05-11 07:03:23', NULL),
(8, 'Tanaman Bunga', 'Tanaman berbunga seperti mawar, melati, kenanga, dan bougenville yang memperindah taman.', '2025-05-11 07:03:23', '2025-05-11 07:03:23', NULL),
(9, 'Tanaman Peneduh', 'Tanaman berukuran besar seperti pohon ketapang atau tabebuya yang digunakan sebagai peneduh taman.', '2025-05-11 07:03:23', '2025-05-11 07:03:23', NULL),
(10, 'Tanaman Merambat', 'Tanaman yang tumbuh merambat seperti morning glory dan bunga air mata pengantin.', '2025-05-11 07:03:23', '2025-05-11 07:03:23', NULL),
(11, 'Tanaman Aromatiks', 'Tanaman dengan aroma khas seperti lavender, rosemary, atau mint.', '2025-05-11 07:03:23', '2025-05-11 10:22:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id_locations`);

--
-- Indeks untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id_plants`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indeks untuk tabel `plant_care_logs`
--
ALTER TABLE `plant_care_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_plants` (`id_plants`);

--
-- Indeks untuk tabel `plant_categories`
--
ALTER TABLE `plant_categories`
  ADD PRIMARY KEY (`id_category`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `locations`
--
ALTER TABLE `locations`
  MODIFY `id_locations` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `plants`
--
ALTER TABLE `plants`
  MODIFY `id_plants` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `plant_care_logs`
--
ALTER TABLE `plant_care_logs`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `plant_categories`
--
ALTER TABLE `plant_categories`
  MODIFY `id_category` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `plant_categories` (`id_category`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `plants_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id_locations`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `plant_care_logs`
--
ALTER TABLE `plant_care_logs`
  ADD CONSTRAINT `plant_care_logs_ibfk_1` FOREIGN KEY (`id_plants`) REFERENCES `plants` (`id_plants`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
