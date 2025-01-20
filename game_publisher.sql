-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2025 at 10:26 AM
-- Server version: 11.6.2-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `game_publisher`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `games_id` int(11) NOT NULL,
  `checkouts_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `jumlah`, `users_id`, `games_id`, `checkouts_id`) VALUES
(2, 1, 4, 2, NULL),
(4, 1, 11, 1, 6),
(9, 1, 3, 5, 22),
(10, 1, 3, 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` int(11) NOT NULL,
  `tanggal_checkout` date NOT NULL,
  `total_harga` double NOT NULL,
  `payments_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `tanggal_checkout`, `total_harga`, `payments_id`) VALUES
(6, '2025-01-17', 50000, 1),
(22, '2025-01-18', 157000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `nama_negara` varchar(255) NOT NULL,
  `regions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `nama_negara`, `regions_id`) VALUES
(1, 'Indonesia', 3),
(2, 'Malaysia', 1),
(3, 'Russia', 2),
(4, 'Japan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `nama_game` varchar(255) NOT NULL,
  `tanggal_rilis` date NOT NULL,
  `harga` double NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deskripsi` longtext DEFAULT NULL,
  `users_id` int(11) NOT NULL
) ;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `nama_game`, `tanggal_rilis`, `harga`, `status`, `deskripsi`, `users_id`) VALUES
(1, 'SAKA', '2025-01-05', 50000, 2, 'A game about analyzing someone\'s MBTI through a story telling.', 2),
(2, 'Omori', '2020-10-07', 100000, 1, 'Explore a strange world full of colorful friends and foes. When the time comes, the path you’ve chosen will determine your fate... and perhaps the fate of others as well.', 6),
(4, 'Whisper Beneath the Waves', '2025-01-14', 50000, 1, 'Game hasil MSIB batch 7 kelompoknya Chris.', 8),
(5, 'Underworld Quest: Secret of the Drought', '2025-01-09', 57000, 1, 'Apaja boleh', 9),
(6, 'TANKHEAD', '2025-01-30', 48000, 2, 'Gem apalagi niii', 10);

-- --------------------------------------------------------

--
-- Table structure for table `game_genres`
--

CREATE TABLE `game_genres` (
  `games_id` int(11) NOT NULL,
  `genres_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `game_genres`
--

INSERT INTO `game_genres` (`games_id`, `genres_id`) VALUES
(6, 1),
(2, 2),
(4, 2),
(1, 3),
(1, 4),
(5, 4),
(1, 5),
(2, 5),
(2, 6),
(5, 6),
(4, 7),
(5, 7),
(4, 8),
(6, 8),
(6, 9),
(4, 10),
(1, 11),
(4, 11),
(5, 11);

-- --------------------------------------------------------

--
-- Table structure for table `game_medias`
--

CREATE TABLE `game_medias` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `games_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `game_medias`
--

INSERT INTO `game_medias` (`id`, `nama`, `jenis`, `games_id`) VALUES
(10, '20250108214130_677e8e9a155bc.png', 'image', 1),
(12, '20250112173232_67839a4036f82.png', 'image', 2),
(13, '20250113160843_6784d81b49a96.png', 'image', 4),
(14, '20250113172858_6784eaea869d1.png', 'image', 5),
(16, '20250113173223_6784ebb7eb201.png', 'image', 6),
(17, '20250115165809_678786b1c9386.png', 'image', 1),
(18, '20250115165821_678786bd49cc7.png', 'image', 1),
(19, '20250115165952_67878718b8f8b.png', 'image', 1),
(20, '20250115170011_6787872b58bdc.png', 'image', 1),
(22, '20250116142023_6788b337bd74a.mp4', 'video', 1);

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `nama_genre` varchar(255) NOT NULL,
  `usia_minimal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `nama_genre`, `usia_minimal`) VALUES
(1, 'First-Person Shooter', 9),
(2, 'Adventure', 3),
(3, 'Visual Novel', 5),
(4, 'Casual', 3),
(5, 'Anime', 3),
(6, 'Horror', 13),
(7, 'Puzzle', 3),
(8, 'Action', 5),
(9, 'RPG', 5),
(10, 'Mystery', 0),
(11, 'Domestic Market', 0),
(12, 'Foreign Market', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `nama_bank`, `hp`) VALUES
(1, 'BRIVA', '4865420585'),
(2, 'GOPAY', '89756820585');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `nama_region` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `nama_region`) VALUES
(1, 'SEA'),
(2, 'Eastern Europe'),
(3, 'East Asia');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `nilai` int(11) NOT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `tanggal_ulasan` date NOT NULL,
  `games_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`nilai`, `deskripsi`, `tanggal_ulasan`, `games_id`, `users_id`) VALUES
(6, 'Oke', '2025-01-18', 2, 3),
(3, 'Meh', '2025-01-18', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 2,
  `status` int(11) NOT NULL DEFAULT 1,
  `password` char(255) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date NOT NULL,
  `countries_id` int(11) NOT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `role`, `status`, `password`, `hp`, `foto`, `tanggal_lahir`, `countries_id`) VALUES
(1, 'admin', 'admin@gmail.com', 0, 1, '$2y$12$6ASeB2gGeuYQsX1dlz75z.PwVE6PqOskkdXZvkmHYklIrM8vZ9Q46', '081234567890', NULL, '2000-01-01', 1),
(2, 'BARESCRIM', 'bara@gmail.com', 1, 1, '$2y$12$X7vgLdirffS58sX8ReV8QO1diRaVJUXMnjjB6sb3tMWvtyMcuHkum', '081234567890', '20250115145903_67876ac796ca3.png', '2000-01-01', 1),
(3, 'restu', 'restu@gmail.com', 2, 1, '$2y$12$w6GN/TwtH1DdrN9f2zzci.x28dcEiQgG23uMOWdo62OV5A9y/tOXW', '081234567890', NULL, '2000-01-01', 1),
(4, 'chris', 'chris@gmail.com', 2, 1, '$2y$12$SJJTE3fwdJWH/eNlHOCbC.3Z1em6lZzrgN2.jnqt2Nr89SK4Aka2a', '081234567890', NULL, '2000-01-01', 1),
(5, 'Mochi', 'mochi@gmail.com', 2, 0, '$2y$12$OoPzoH.qGO/n/4ry1/pyyeZHTAWNEdVNOm2A5WNu4DHXKJmj3UWRO', '1010101010', '20241210221720_67585b8084ea1.jpg', '2024-12-12', 4),
(6, 'OMOCAT', 'omocat@gmail.com', 1, 1, '$2y$12$gJzTN25SqMnRbFodWPcSAO3l6jKHZ1R6gGEri/FWjKVRZSIWqkcOm', '095236541255', '20250119141107_678ca58b90bd7.jpg', '2021-03-02', 2),
(7, 'Boris', 'boris@gmail.com', 2, 0, '$2y$12$AHq4CyhbON29MbOxwlIVFut3ecTUEcTStyFzC7NGa12rG7tNxEg0m', '696969696969', NULL, '1991-02-06', 3),
(8, 'ELEGI', 'elegi@gmail.com', 1, 1, '$2y$12$sWgEHbOQTneToTAi3oXo9uTwFC4Pq4G929T8lSJTvXc82C1l6OSiK', '095236541489', NULL, '2001-10-16', 1),
(9, '7PIECE', '7piece@gmail.com', 1, 1, '$2y$12$C9iMukJfcUZUQkZIlj3k0.Q4xwvDsqs7ysOCqe/07JbVpbkJpKc1m', '095236541299', NULL, '2021-02-02', 1),
(10, 'Alpha Channel Inc.', 'alphachannel@gmail.com', 1, 1, '$2y$12$gYSebUa5S/6gUG0b6LR4z.bRiEMXsJuyVZ3nhXmqJ/MFYIBRu4qle', '095236541200', NULL, '2018-02-07', 1),
(11, 'bocil 10 tahun', 'bocil10tahun@gmail.com', 2, 1, '$2y$12$9kpS5sR9L4E/oH.Id4Ozz.1T77nSraHD8W.tcGP7jTs3HcIG2JEDi', '1010101010', '20250115135855_67875caf897ae.jpg', '2015-01-01', 2),
(12, 'Soto4Game', 'soto4game@gmail.com', 1, 1, '$2y$12$YKUsYJ0ZItBe6V2lN1Xec.v983Twe1rFEXBEiQV6wzPB7MM70man6', '095236541254', NULL, '2020-01-20', 1),
(13, 'soto', 'soto@gmail.com', 2, 1, '$2y$12$GR0y.gM7CYQEH9hrQrefV.ZbmYMWcZabXhdC.h0JFVsNY.KuQ5YWK', '095236541252', NULL, '2007-06-21', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`,`users_id`,`games_id`),
  ADD KEY `carts_checkouts_fk` (`checkouts_id`),
  ADD KEY `carts_games_fk` (`games_id`),
  ADD KEY `carts_users_fk` (`users_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkouts_payments_fk` (`payments_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `countries_regions_fk` (`regions_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `games_users_fk` (`users_id`);

--
-- Indexes for table `game_genres`
--
ALTER TABLE `game_genres`
  ADD PRIMARY KEY (`games_id`,`genres_id`),
  ADD KEY `relation_6_genres_fk` (`genres_id`);

--
-- Indexes for table `game_medias`
--
ALTER TABLE `game_medias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_medias_games_fk` (`games_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`games_id`,`users_id`),
  ADD KEY `reviews_users_fk` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_countries_fk` (`countries_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game_medias`
--
ALTER TABLE `game_medias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_checkouts_fk` FOREIGN KEY (`checkouts_id`) REFERENCES `checkouts` (`id`),
  ADD CONSTRAINT `carts_games_fk` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `carts_users_fk` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `checkouts_payments_fk` FOREIGN KEY (`payments_id`) REFERENCES `payments` (`id`);

--
-- Constraints for table `countries`
--
ALTER TABLE `countries`
  ADD CONSTRAINT `countries_regions_fk` FOREIGN KEY (`regions_id`) REFERENCES `regions` (`id`);

--
-- Constraints for table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_users_fk` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `game_genres`
--
ALTER TABLE `game_genres`
  ADD CONSTRAINT `relation_6_games_fk` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `relation_6_genres_fk` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`id`);

--
-- Constraints for table `game_medias`
--
ALTER TABLE `game_medias`
  ADD CONSTRAINT `game_medias_games_fk` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_games_fk` FOREIGN KEY (`games_id`) REFERENCES `games` (`id`),
  ADD CONSTRAINT `reviews_users_fk` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_countries_fk` FOREIGN KEY (`countries_id`) REFERENCES `countries` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
