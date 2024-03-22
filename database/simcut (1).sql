-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 22 Mar 2024 pada 15.57
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simcut`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuti`
--

CREATE TABLE `cuti` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari` int NOT NULL,
  `alamat_cuti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_admin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `approve_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cuti`
--

INSERT INTO `cuti` (`id`, `nip`, `name`, `email`, `bagian`, `pangkat`, `jabatan`, `jenis_cuti`, `tgl_cuti`, `hari`, `alamat_cuti`, `status`, `status_admin`, `alasan`, `approve_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Tahunan', '2023-12-17 to 2023-12-22', 0, 'DS. Kaladawa', 'Batal', '', '-', '-', '2023-12-16 06:24:43', '2023-12-16 07:14:05', '2023-12-16 07:14:05'),
(2, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Sakit', '2023-12-17 to 2023-12-20', 0, 'DS. Kaladawa', 'Batal', '', '-', '-', '2023-12-16 07:28:59', '2023-12-16 07:31:34', '2023-12-16 07:31:34'),
(3, '13456789', 'Dimas', 'dimas@gmail.com', 'Keperawatan', 'Wijaya Kusuma Atas', 'Perawat', 'Cuti Tahunan', '2023-12-18 to 2023-12-22', 0, 'DS. Pacul', 'Ditolak', '', '-', '-', '2023-12-16 20:02:32', '2023-12-24 09:49:37', '2023-12-24 09:49:37'),
(4, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Tahunan', '2023-12-18 to 2023-12-23', 5, 'DS. Kaladawa', 'Batal', '', '-', '-', '2023-12-16 20:38:11', '2023-12-16 21:07:04', '2023-12-16 21:07:04'),
(5, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Sakit', '2023-12-18 to 2023-12-23', 6, 'DS. Kaladawa', 'Ditolak', '', '-', '-', '2023-12-16 20:41:42', '2023-12-16 21:53:50', '2023-12-16 21:53:50'),
(6, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Karena Alasan Penting', '2023-12-18 to 2023-12-20', 3, 'DS. Kaladawa', 'Batal', '', '-', '-', '2023-12-16 20:47:58', '2023-12-16 21:07:42', '2023-12-16 21:07:42'),
(7, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Sakit', '2023-12-18 to 2023-12-23', 6, 'DS. Kaladawa', 'Disetujui', '', '-', 'Mufasirin', '2023-12-16 21:12:56', '2023-12-16 21:53:19', NULL),
(8, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', 'Pelayanan Umum dan Kepegawaian', 'NOC', 'Staf IT', 'Cuti Tahunan', '2023-12-25', 1, 'DS. Kaladawa', 'Pending', 'Ditolak', '-', '-', '2023-12-24 07:32:42', '2023-12-24 09:50:49', '2023-12-24 09:50:49'),
(9, '21041048', 'Luluatun Khasanah', 'lulu@gmail.com', 'Keperawatan', '-', 'Perawat', 'Cuti Tahunan', '2023-12-24 to 2023-12-25', 2, 'DS. Pacul', 'Disetujui', 'Disetujui', '-', 'Dimas', '2023-12-24 09:58:23', '2023-12-24 10:04:54', NULL),
(10, '21041048', 'Luluatun Khasanah', 'lulu@gmail.com', 'Keperawatan', '-', 'Perawat', 'Cuti Tahunan', '2024-02-09', 1, 'DS. Pacul', 'Disetujui', 'Disetujui', '-', 'Dimas', '2024-02-09 08:48:44', '2024-02-09 08:52:11', NULL),
(11, '21041048', 'Luluatun Khasanah', 'lulu@gmail.com', 'Keperawatan', '-', 'Perawat', 'Cuti Tahunan', '2024-02-13', 1, 'DS. Kaladawa', 'Disetujui', 'Disetujui', '-', 'Dimas', '2024-02-09 20:05:32', '2024-03-02 06:48:50', NULL),
(12, '21041048', 'Luluatun Khasanah', 'lulu@gmail.com', 'Keperawatan', '-', 'Perawat', 'Cuti Tahunan', '2024-03-04', 1, 'DS. Kaladawa', 'Disetujui', 'Disetujui', '-', 'Dimas', '2024-03-02 06:50:10', '2024-03-02 06:51:00', NULL),
(13, '12345678', 'Retno Intan', 'retno@gmail.com', 'Sub Bagian Umum dan Kepegawaian', 'IIIC', 'Akunting', 'Cuti Tahunan', '2024-03-13', 1, 'DS. Pacul', 'Disetujui', 'Disetujui', '-', 'Ego Winasis', '2024-03-09 22:13:29', '2024-03-09 22:14:37', NULL),
(15, '12345678', 'Retno Intan', 'retno@gmail.com', 'Sub Bagian Umum dan Kepegawaian', 'IIIC', 'Akunting', 'Cuti Tahunan', '2024-03-20', 1, 'DS. Kaladawa', 'Ditolak', 'Ditolak', 'Lembur', '-', '2024-03-20 07:47:21', '2024-03-20 07:49:43', '2024-03-20 07:49:43'),
(16, '12345678', 'Retno Intan', 'retno@gmail.com', 'Sub Bagian Umum dan Kepegawaian', 'IIIC', 'Akunting', 'Cuti Tahunan', '2024-03-21', 1, 'DS. Kaladawa', 'Ditolak', 'Disetujui', 'pengen', '-', '2024-03-20 07:50:35', '2024-03-20 08:02:18', '2024-03-20 08:02:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2023_12_16_121646_create_cuti_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','kepala','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bagian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `pangkat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `ttd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'qrcode.png',
  `isActive` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nip`, `name`, `email`, `email_verified_at`, `password`, `role`, `bagian`, `pangkat`, `jabatan`, `image`, `ttd`, `isActive`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '12345678', 'Mufasirin', 'mufasirin@gmail.com', NULL, '$2y$12$dJMCGDsj0AD2iQmR8m4Ygunq5opvbRmn/VYbaitcRb90PbyrG1I0.', 'admin', 'Sub Bagian Perencanaan dan Keuangaan', 'SDM', 'Admin', '6577198cb6588.jpg', '65882f5b599b8.png', 1, 'M0mG569hsGkKOt3YN6qYBz1CYtHipGFNO0zIvmKUgEkGlwJ4L6zINLLr3AQ2', '2023-12-08 09:22:34', '2024-03-20 06:15:00', NULL),
(2, '21041003', 'Ego Winasis', 'egowinasis22@gmail.com', NULL, '$2y$12$jlvTkIZcjeNrQ2aG70R48uT18Ggye7w8yD1otDNVd0/IHJkig2cTi', 'kepala', 'Sub Bagian Umum dan Kepegawaian', 'IIIC', 'Kasubbag Umum dan Kepegawaian', '6579b6c24585c.jpg', '65882fe4df95e.png', 1, NULL, '2023-12-09 22:01:59', '2024-03-09 22:06:29', NULL),
(3, '13456789', 'Dimas', 'dimas@gmail.com', NULL, '$2y$12$bu.JlyI6ngTFt58z5Cy8G.uvQ7efw3ZK7NhnYwrQbtRIBjn4njEfe', 'kepala', 'Keperawatan', 'Wijaya Kusuma Atas', 'Perawat', 'user.png', '65886045b99d2.png', 1, NULL, '2023-12-16 10:33:08', '2023-12-24 09:45:58', NULL),
(4, '-', 'tri wahyudi', 'triwahyudiamungkas@gmail.com', NULL, '$2y$12$r3oz.YQByzhJBeLdoxTT.OnO3iUXx2BFyoDtLM50FsLMUmJfv7T92', 'user', '-', '-', '-', 'user.png', 'qrcode.png', 0, NULL, '2023-12-16 11:06:59', '2023-12-16 19:40:47', '2023-12-16 19:40:47'),
(5, '21041048', 'Luluatun Khasanah', 'lulu@gmail.com', NULL, '$2y$12$3oNtPGG2ZYE6ZQUJfmzuqOHXlYR3txkVoQIupa/4IY8Ywf0DOuJMO', 'user', 'Seksi Pelayanan Keperawatan', 'IIIC', 'Perawat', '6588623837df4.jpg', '658862383c2d2.png', 1, NULL, '2023-12-24 09:52:00', '2024-03-09 21:45:47', NULL),
(6, '12345678', 'Retno Intan', 'retno@gmail.com', NULL, '$2y$12$js519lY9xiE1En1Fl0CCO.OPfNGBoA60kpGNJH8OFnzdP.C5yxn4q', 'user', 'Sub Bagian Umum dan Kepegawaian', 'IIIC', 'Akunting', '65ed415ef1bfe.jpg', '65ed4150f198e.png', 1, NULL, '2024-03-09 22:07:50', '2024-03-09 22:13:03', NULL),
(7, '-', 'admin', 'admin@gmail.com', NULL, '$2y$12$6UJ65/zAB7yHte4VwwJ8zusq0gerskOpFtELfIEuaFdCbT/A1robW', 'user', '-', '-', '-', 'user.png', 'qrcode.png', 1, NULL, '2024-03-22 07:34:47', '2024-03-22 08:20:27', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
