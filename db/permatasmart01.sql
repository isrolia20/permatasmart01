-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2022 pada 08.09
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `permatasmart01`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `privilege` enum('super','administrator','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `name`, `address`, `phone_number`, `privilege`) VALUES
(5, 1, 'Admin Lukman', 'adminadmin', '085123123123', 'super');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`) VALUES
(1, '1', '1'),
(2, 'Eum id laudantium t', 'Iusto proident at q'),
(3, 'Veritatis quis fugia', 'Laudantium in dolor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `package_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `features`
--

INSERT INTO `features` (`id`, `package_id`, `name`) VALUES
(8, '2', '2'),
(9, '1', '1, 2, 3'),
(11, '3', '3'),
(13, '4', '7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `leasons`
--

CREATE TABLE `leasons` (
  `id` int(11) NOT NULL,
  `package_id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pukul` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `leasons`
--

INSERT INTO `leasons` (`id`, `package_id`, `name`, `pukul`) VALUES
(9, '1', 'Senin, Selasa, Rabu', '19:00 - 20:00'),
(10, '2', 'Selasa, Rabu, Kamis', '19:00 - 20:00'),
(11, '3', 'Kamis, Jumat, Sabtu', '19:00 - 20:00'),
(12, '4', 'Kamis, Jumat, Sabtu', '19:00 - 20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `packages`
--

CREATE TABLE `packages` (
  `id` varchar(10) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text NOT NULL,
  `duration` int(11) NOT NULL,
  `level` enum('sd','smp','sma') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `packages`
--

INSERT INTO `packages` (`id`, `admin_id`, `name`, `slug`, `price`, `description`, `duration`, `level`) VALUES
('1', 5, 'Paket Hemat 1', 'paket-hemat-1', 300000, 'Materi SD : IPA, IPS, PPkn, Matematika', 4000, 'sd'),
('2', 5, 'Paket Hemat 2', 'paket-hemat-2', 450000, 'Materi SD : PPkn, Matematika, Bhs Inggris, Bhs Indonesia', 4000, 'sd'),
('3', 5, 'Paket Hemat 3', 'paket-hemat-3', 560000, 'Materi SD : PPkn, Matematika, Bhs Inggris, Bhs Indonesia', 20000, 'sd'),
('4', 5, 'Paket Hemat 1', 'paket-hemat-1', 600000, 'Mtk, IPA, IPS, Bhs Indo, Bhs Inggris', 2000, 'smp');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `transaction_id` varchar(15) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `review` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `schedule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `sex` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `parent` varchar(255) NOT NULL,
  `phone_number_parent` varchar(15) NOT NULL,
  `bio` text NOT NULL,
  `school` varchar(255) NOT NULL,
  `level` enum('sd','smp','sma') NOT NULL,
  `class` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `address`, `sex`, `phone_number`, `parent`, `phone_number_parent`, `bio`, `school`, `level`, `class`) VALUES
(25, 46, 'Hilel Kidd', 'Nemo amet itaque of', 'perempuan', '+1 (504) 555-34', 'Dolor natus quidem i', '+1 (617) 872-87', 'Autem laboris labori', 'Nam anim temporibus ', 'sd', 'Incid'),
(26, 47, 'Ila Dennis', 'Aut in veniam enim ', 'perempuan', '+1 (411) 449-63', 'Itaque nulla consequ', '+1 (495) 121-48', 'Sit repellendus De', 'SMP A', 'smp', '5'),
(27, 48, 'Dwi Bagus', 'Kp. Krajan RT03/RW01', 'laki-laki', '089112122122', 'Yani', 'Uhtea', 'Yuks', 'SD bws', 'sd', '2'),
(28, 57, 'inzaghi', 'JL Waru', 'laki-laki', '089112122122', 'Toni', '083811910100', 'Pesepak Bola', 'SD Mojopahit', 'sd', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` varchar(15) NOT NULL,
  `student_id` int(11) NOT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `package_id` varchar(10) NOT NULL,
  `status` enum('pending','verified','not_verified','block') NOT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `schedule` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `student_id`, `tutor_id`, `package_id`, `status`, `is_active`, `receipt`, `discount`, `total`, `schedule`, `created_at`, `updated_at`) VALUES
('2022060508', 27, 6, '3', 'verified', 'active', '1654580694751.jpg', NULL, 560000, '0000-00-00', '2022-06-07 05:46:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tutors`
--

CREATE TABLE `tutors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leason_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `sex` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `bio` text NOT NULL,
  `profession` varchar(255) NOT NULL,
  `level` enum('sd','smp','sma') NOT NULL,
  `schedule` varchar(100) NOT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `is_available` enum('available','not_available') NOT NULL,
  `file_pdf` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tutors`
--

INSERT INTO `tutors` (`id`, `user_id`, `leason_id`, `schedule_id`, `name`, `address`, `sex`, `phone_number`, `bio`, `profession`, `level`, `schedule`, `is_active`, `is_available`, `file_pdf`) VALUES
(2, 45, NULL, NULL, 'Dean Cannon', 'Odio est aut sapien', 'laki-laki', '+1 (651) 499-52', 'Dolor et sint ab par', 'Et natus ratione rat', 'sd', 'Quisquam sed tempor ', 'inactive', 'available', NULL),
(4, 50, NULL, NULL, 'Dino Pandu Satrio', 'Jl dharma putra no 14', 'laki-laki', '087177177177', 'Seorang Ayah', 'Guru Honorer', 'sd', '09.00', 'inactive', 'available', NULL),
(6, 56, NULL, NULL, 'Agya', 'Jl Karuwa', 'perempuan', '089112122122', 'Suka mengajar', 'Guru Honorer', 'sd', 'Malam', 'active', 'available', 'SKL_Prayud_25_Oktober_20212.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` enum('active','inactive') NOT NULL,
  `role` enum('admin','student','tutor') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `email_verified_at`, `avatar`, `is_active`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@admin.com', '$2y$10$aQpgOL6uzwqGtRhMeKQMhusRV1q03kMDXL7M2zRmpbeh9rJUV6u62', NULL, '1641714068608.jpg', 'active', 'admin', NULL, NULL, '2022-01-09 07:41:08'),
(2, 'tutor@tutor.com]', '$2y$10$aQpgOL6uzwqGtRhMeKQMhusRV1q03kMDXL7M2zRmpbeh9rJUV6u62', NULL, NULL, 'active', 'tutor', NULL, NULL, NULL),
(3, 'student@student.com', '$2y$10$NSNClUZnwEGB3TPq0yZdFuwWrySKYEvlPHlj3PnswfWOOMo6Y4zuq', NULL, NULL, 'active', 'student', NULL, NULL, NULL),
(45, 'hykoko@mailinator.com', '$2y$10$aQpgOL6uzwqGtRhMeKQMhusRV1q03kMDXL7M2zRmpbeh9rJUV6u62', NULL, NULL, 'active', 'tutor', NULL, NULL, NULL),
(46, 'student2@student.com', '$2y$10$haP5.uKVwmsyrI74a0W7SOze6uXM8ctaYtVEnGaEDMFs7uMpCJPTW', NULL, NULL, 'active', 'student', NULL, NULL, NULL),
(47, 'student3@student.com', '$2y$10$SUGQkftdnMzXYn8dp1D2yOckaSuRqciGfI1JMtXiv/ayn0of3PT0m', NULL, NULL, 'active', 'student', NULL, NULL, NULL),
(48, 'syahdiakbar@gmail.com', '$2y$10$eB2UfSLsioiaKy6TZCobkeAyqCnH1eFUwTZnRX6g3EvK1Jl6zUpGW', NULL, '1641714068608.jpg', 'active', 'student', NULL, NULL, NULL),
(50, 'dino@gmail.com', '$2y$10$7WFqoSxAoFgLxe2.oci6ZeEPvadvUlnh3FUeDS1N9TL1oHcUWQrMa', NULL, 'IMG-20181123-WA0027.jpg', 'active', 'tutor', NULL, NULL, NULL),
(56, 'ageng@gmail.com', '$2y$10$1ElWDC2GiVthgiJTW7x3.uTp3gZCizXgbN5nvWBMOSBJF15weqzbW', NULL, NULL, 'active', 'tutor', NULL, NULL, NULL),
(57, 'inzaghi@gmail.com', '$2y$10$ESpAgY1acSFKBR1kZUyaye40JIekvBuriGJKal4MByFin5rwuXAj6', NULL, NULL, 'active', 'student', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indeks untuk tabel `leasons`
--
ALTER TABLE `leasons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indeks untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`transaction_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indeks untuk tabel `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`package_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indeks untuk tabel `tutors`
--
ALTER TABLE `tutors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`leason_id`),
  ADD KEY `leason_id` (`leason_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `leasons`
--
ALTER TABLE `leasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `tutors`
--
ALTER TABLE `tutors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `features_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `leasons`
--
ALTER TABLE `leasons`
  ADD CONSTRAINT `leasons_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`);

--
-- Ketidakleluasaan untuk tabel `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Ketidakleluasaan untuk tabel `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`tutor_id`) REFERENCES `tutors` (`id`);

--
-- Ketidakleluasaan untuk tabel `tutors`
--
ALTER TABLE `tutors`
  ADD CONSTRAINT `tutors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tutors_ibfk_4` FOREIGN KEY (`leason_id`) REFERENCES `leasons` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
