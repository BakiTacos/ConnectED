-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Des 2025 pada 08.42
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
-- Database: `connected_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `psychologist_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `hope` text NOT NULL,
  `media` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `psychologist_id`, `booking_date`, `booking_time`, `method`, `type`, `topic`, `description`, `hope`, `media`, `status`, `created_at`, `updated_at`) VALUES
(6, 2, 5, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'saya suka sama seseorang tapi kehalang profesionalitas', 'bisa tersadarkan', NULL, 'Pending', '2025-12-18 21:43:03', '2025-12-18 21:43:03'),
(7, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'saadasdasdadsaadsadadads', 'asdadsasdadadasdad', NULL, 'Completed', '2025-12-18 22:08:36', '2025-12-19 00:45:24'),
(8, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Akademik', 'dasdasdasdadasdasdadadsadadadsasdasdadas', 'asdasdasda', NULL, 'Completed', '2025-12-18 22:13:24', '2025-12-19 01:13:56'),
(9, 2, 4, '2025-12-23', '15:00 - 16:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'asdadadadawvdbfsdgsd gdvfsgfbfrsdvfdwdsvfdf', 'adgbbf vn hsrhtgsv', NULL, 'Rescheduled', '2025-12-18 22:18:56', '2025-12-19 01:37:31'),
(10, 2, 4, '2025-12-20', '14:00 - 15:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'awdasdawdasdawddadasdawdadsfwreegrfdverg', 'wdasdadasd', NULL, 'Pending', '2025-12-18 22:22:35', '2025-12-18 22:22:35'),
(11, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Akademik', 'asdasdawdasdawdasdawdasdqwdadasdawdasdad', 'adsadasda', NULL, 'Pending', '2025-12-18 22:24:55', '2025-12-18 22:24:55'),
(12, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Akademik', 'asdasdadasdadasdsadasdasdsasd', 'asdasdadadada', NULL, 'Pending', '2025-12-18 22:28:12', '2025-12-18 22:28:12'),
(13, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Narasumber', 'Akademik', 'asdasdadsadasdwadasadawda', 'awdasdawd', NULL, 'Pending', '2025-12-18 22:31:21', '2025-12-18 22:31:21'),
(14, 2, 4, '2025-12-20', '13:00 - 14:00', 'Offline', 'Individual', 'Akademik', 'asdadasdadawdqeweqweqeqweqwewq', 'feefewfwfwf', NULL, 'Accepted', '2025-12-18 22:37:40', '2025-12-19 00:36:34'),
(15, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Akademik', 'asdadasdadadasdsadadsasdad', 'asdasdasdad', NULL, 'Accepted', '2025-12-18 22:43:44', '2025-12-19 00:06:13'),
(16, 2, 5, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Akademik', 'asdasdqwdawdwqdadwadasdawdawds', 'awdasdawdasdawdasdadwdasdadwd', NULL, 'Pending', '2025-12-18 22:44:11', '2025-12-18 22:44:11'),
(17, 2, 5, '2025-12-20', '10:00 - 11:00', 'Offline', 'Individual', 'Akademik', 'adasdasdasdsasadasdasdasdasdadad', 'asdasdasdasdadad', 'Tatap Muka', 'Pending', '2025-12-18 22:50:45', '2025-12-18 22:50:45'),
(18, 2, 4, '2025-12-20', '10:00 - 11:00', 'Offline', 'Kelompok', 'Pribadi & Emosi', 'asdsadasdadassdadsadwqeqqweqwerertttertetr', 'qwetyjuttgghgfbngf', 'Tatap Muka', 'Accepted', '2025-12-18 22:51:06', '2025-12-18 22:51:32'),
(19, 2, 7, '2025-12-20', '10:00 - 11:00', 'Offline', 'Narasumber', 'Karir', 'adasdadadwdasdawdasdwdawdawd', 'asdawdasdawdas', 'Tatap Muka', 'Pending', '2025-12-18 22:53:51', '2025-12-18 22:53:51'),
(20, 2, 4, '2025-12-21', '10:00 - 11:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'saya kemaren ketabrak sama kucing yang lagi naik motor', 'semoga dia jadian sama saya', 'Tatap Muka', 'Pending', '2025-12-20 08:13:53', '2025-12-20 08:13:53'),
(21, 2, 7, '2025-12-21', '10:00 - 11:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'asdadsadsadasdassdasdassdasdasdadadsadas', 'aasdasdasdassad', 'Tatap Muka', 'Pending', '2025-12-20 08:15:09', '2025-12-20 08:15:09'),
(22, 2, 4, '2025-12-21', '13:00 - 14:00', 'Offline', 'Individual', 'Pribadi & Emosi', 'asdadmakdamldjnsdkadnjkasdanjdaksdkjnadkl', 'sdadaodjnasmldasdaksdanjsdaokd', 'Tatap Muka', 'Pending', '2025-12-20 09:14:35', '2025-12-20 09:14:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `counselings`
--

CREATE TABLE `counselings` (
  `id` bigint(20) NOT NULL,
  `booking_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `psychologist_id` bigint(20) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hero_slides`
--

CREATE TABLE `hero_slides` (
  `slide_id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cta_text` varchar(50) DEFAULT 'Mulai Konsultasi',
  `cta_link` varchar(255) DEFAULT '#',
  `sort_order` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hero_slides`
--

INSERT INTO `hero_slides` (`slide_id`, `image_url`, `title`, `description`, `cta_text`, `cta_link`, `sort_order`) VALUES
(1, 'https://github.com/BakiTacos/image-host/raw/main/ConnectED/hero-carousel/hero-1.png?raw=true', 'Bicara adalah Langkah Pertama untuk Menemukan Jalan Keluar', 'Mulailah langkahmu bersama ConnectED, kami hadir untuk menangani masalah kamu.', 'Mulai Konsultasi', 'booking.php', 1),
(2, 'https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80&fm=webp', 'Kesehatan Mental Anda Adalah Prioritas Utama Kami', 'Temukan ketenangan dan solusi profesional bersama psikolog terbaik kami.', 'Jadwalkan Sesi', 'booking.php', 2),
(3, 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80&fm=webp', 'Ruang Aman untuk Bercerita Tanpa Penghakiman', 'Kami mendengarkan, memahami, dan membantu anda pulih kembali.', 'Hubungi Kami', 'booking.php', 3),
(4, 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/hero-carousel/hero-1.png?raw=true', 'Bicara adalah Langkah Pertama untuk Menemukan Jalan Keluar', 'Mulailah langkahmu bersama ConnectED, kami hadir untuk menangani masalah kamu.', 'Mulai Konsultasi', 'booking.php', 1);

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
(1, '2025_12_19_080717_add_phone_fields_to_users_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `psychologists`
--

CREATE TABLE `psychologists` (
  `psy_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `role` varchar(50) DEFAULT 'Psikolog UMN',
  `image_url` varchar(255) NOT NULL,
  `specialties` varchar(255) NOT NULL,
  `available_days` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `psychologists`
--

INSERT INTO `psychologists` (`psy_id`, `name`, `title`, `role`, `image_url`, `specialties`, `available_days`) VALUES
(1, 'Yanuar Lurisa Aldio', 'S.PSI', 'Psikolog UMN', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/yanuar.jpg?raw=true', 'Depression,Burnout,Insomnia,PTSD', 'Monday,Wednesday,Thursday,Friday,Saturday'),
(2, 'Ignatia Ria Natalia', 'M.PSI', 'Psikolog UMN', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/ignatia.jpg?raw=true', 'Family Issue,Toxic Relationship,Anxiety', 'Monday,Tuesday,Wednesday,Thursday,Friday'),
(3, 'Fiona Valentina Damanik', 'M.PSI', 'Psikolog UMN', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/fiona.jpg?raw=true', 'Family Issue,Toxic Relationship,Anxiety', 'Tuesday,Wednesday,Thursday,Friday,Saturday'),
(4, 'Sonny Tirta Luzanil', 'M.PSI, Psikolog', 'Psikolog UMN', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/counselor-pic/sonny.jpg?raw=true', 'Career,Burnout,Self-Development', 'Monday,Wednesday,Thursday,Friday,Saturday');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminars`
--

CREATE TABLE `seminars` (
  `seminar_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seminars`
--

INSERT INTO `seminars` (`seminar_id`, `title`, `image_url`) VALUES
(7, 'Seminar 1', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/seminar-thumb/thumb-1.png?raw=true'),
(8, 'Seminar 2', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/seminar-thumb/thumb-2.png?raw=true'),
(9, 'Seminar 3', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/seminar-thumb/thumb-3.png?raw=true');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`service_id`, `title`, `description`, `image_url`, `price`, `created_at`) VALUES
(1, 'Individual', 'Konseling yang akan dilakukan antara individu dan psikolog langsung, dengan tatap muka maupun online.', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/services-thumb/individual.png?raw=true', 0.00, '2025-12-07 12:57:04'),
(2, 'Kelompok', 'Konseling yang akan dilakukan secara kelompok dengan psikolog langsung, tatap muka maupun online.', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/services-thumb/kelompok.png?raw=true', 0.00, '2025-12-07 12:57:04'),
(3, 'Request Narasumber', 'Mahasiswa dapat request untuk menjadikan Psikolog untuk menjadi narasumber project maupun acara-acara seminar.', 'https://github.com/BakiTacos/image-host/blob/main/ConnectED/services-thumb/narasumber.png?raw=true', 0.00, '2025-12-07 12:57:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `review_id` int(11) NOT NULL,
  `initials` varchar(5) NOT NULL,
  `service_type` varchar(50) DEFAULT 'e-Counseling',
  `review_text` text NOT NULL,
  `review_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `testimonials`
--

INSERT INTO `testimonials` (`review_id`, `initials`, `service_type`, `review_text`, `review_date`) VALUES
(1, 'MJ', 'e-Counseling', 'Awalnya ragu buat cerita soal burnout. Tapi ternyata psikolognya suportif dan nggak nge-judge.', '21 November 2025'),
(2, 'AL', 'e-Counseling', 'Jujurly, sempet burnout parah gara-gara skripsi. Untung nyoba counseling, psikolognya keren abis.', '30 Oktober 2025'),
(3, 'KV', 'e-Counseling', 'Vibe sesi nyaman banget, bener-bener safe space buat cerita masalah yang complicated. Konselornya baik banget.', '08 November 2025'),
(4, 'JM', 'e-Counseling', 'Awalnya ragu buat cerita soal burnout. Tapi ternyata psikolognya suportif dan nggak nge-judge.', '21 November 2025'),
(5, 'SA', 'e-Counseling', 'Jujurly, sempet burnout parah gara-gara skripsi. Untung nyoba counseling, psikolognya keren abis.', '30 Oktober 2025'),
(6, 'KV', 'e-Counseling', 'Vibe sesi nyaman banget, bener-bener safe space buat cerita masalah yang complicated. Konselornya baik banget.', '08 November 2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','psychologist','admin') DEFAULT 'student',
  `avatar_image` varchar(255) DEFAULT 'default_avatar.jpg',
  `education` varchar(50) DEFAULT 'S1/D4',
  `study_program` varchar(100) DEFAULT 'Sistem Informasi',
  `batch_year` varchar(10) DEFAULT '2024',
  `whatsapp` varchar(20) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `phone`, `phone_number`, `nim`, `password`, `role`, `avatar_image`, `education`, `study_program`, `batch_year`, `whatsapp`, `guardian_name`, `guardian_phone`, `created_at`, `updated_at`) VALUES
(2, 'Michael', 'michael@student.umn.ac.id', '089697580793', NULL, '00000282620', '$2y$12$ikboKv2s/FoWFBBeSHTrA.mKXwNHqeejQadepr/F1Pp5iNLx4JSRO', 'student', 'http://127.0.0.1:8000/uploads/avatars/1766077009.jfif', 'S1/D4', 'Sistem Informasi', '2025', '089697580793', 'Budi (0812345678)', '012345678913', NULL, NULL),
(3, 'Admin Utama', 'admin@umn.ac.id', NULL, NULL, NULL, '$2y$12$3o1M5N/ta7F72K/Vf7pjwuynPGUiiyP4ci2JrkjqE0ZxgPmePbxMq', 'admin', 'default_avatar.jpg', 'S1/D4', 'Sistem Informasi', '2024', NULL, NULL, NULL, NULL, NULL),
(4, 'Yanuar Lurisa Aldio', 'yanuar@umn.ac.id', NULL, NULL, NULL, '$2y$12$JhPfDj1xZBgatFufXhwmGuDcsyoWzSbrjMa7Iwl1qE8tLnX8VjR36', 'psychologist', 'default_avatar.jpg', 'S1/D4', 'Sistem Informasi', '2024', NULL, NULL, NULL, NULL, NULL),
(5, 'Fiona', 'fiona@umn.ac.id', NULL, NULL, NULL, '$2y$12$3FyKg8SPmQ41rYcHv8qncehctX4mZjxBMx9pqDhfiazi4YN26eySO', 'psychologist', 'default_avatar.jpg', 'S1/D4', 'Sistem Informasi', '2024', NULL, NULL, NULL, NULL, NULL),
(6, 'Sonny', 'sonny@umn.ac.id', NULL, NULL, NULL, '$2y$12$dgnQ17qhINggg0WcgZB8mOeZugxCB33MBvC.80u3EBtENqNfnBpIy', 'psychologist', 'default_avatar.jpg', 'S1/D4', 'Sistem Informasi', '2024', NULL, NULL, NULL, NULL, NULL),
(7, 'Ria', 'ria@umn.ac.id', NULL, NULL, NULL, '$2y$12$t3dhGwhuUyE1qDNVrhYg6u3AH3fC5jmtw8x9ERnLLXVkqRTya6FiG', 'psychologist', 'default_avatar.jpg', 'S1/D4', 'Sistem Informasi', '2024', NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indeks untuk tabel `counselings`
--
ALTER TABLE `counselings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hero_slides`
--
ALTER TABLE `hero_slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `psychologists`
--
ALTER TABLE `psychologists`
  ADD PRIMARY KEY (`psy_id`);

--
-- Indeks untuk tabel `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`seminar_id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`review_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `counselings`
--
ALTER TABLE `counselings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hero_slides`
--
ALTER TABLE `hero_slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `psychologists`
--
ALTER TABLE `psychologists`
  MODIFY `psy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `seminars`
--
ALTER TABLE `seminars`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
