-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 13 Mar 2024 pada 12.46
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kreazi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_setting`
--

CREATE TABLE `app_setting` (
  `id` int(11) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `expired_trial` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `app_setting`
--

INSERT INTO `app_setting` (`id`, `logo`, `expired_trial`, `create_date`, `modified_date`) VALUES
(1, '-', 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog`
--

CREATE TABLE `blog` (
  `article_id` int(11) NOT NULL,
  `title` longtext NOT NULL,
  `caption` longtext NOT NULL,
  `user` int(100) NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `blog`
--

INSERT INTO `blog` (`article_id`, `title`, `caption`, `user`, `status`, `create_date`, `modified_date`) VALUES
(1, 'ini title', 'ini text isi caption body article', 1, 1, '2024-01-23 13:22:27', '0000-00-00 00:00:00'),
(2, 'title 2', 'caption 2', 1, 1, '2024-01-23 13:22:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `ekspedisi_id` int(11) NOT NULL,
  `name` int(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `finance`
--

CREATE TABLE `finance` (
  `finance_id` int(100) NOT NULL,
  `user` int(100) NOT NULL,
  `kas` int(100) NOT NULL,
  `tipe` int(1) NOT NULL,
  `subtipe` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `image_banner`
--

CREATE TABLE `image_banner` (
  `id_image` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `image_banner`
--

INSERT INTO `image_banner` (`id_image`, `url`, `create_date`, `modified_date`) VALUES
(1, 'http://127.0.0.1:8000/uploads/home/1-imageBanner_1710327124.jpg', '2024-03-13 17:52:04', '2024-03-13 17:52:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `omnichanel`
--

CREATE TABLE `omnichanel` (
  `id_omnichanel` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `omnichanel`
--

INSERT INTO `omnichanel` (`id_omnichanel`, `logo`, `create_date`, `modified_date`) VALUES
(1, 'http://127.0.0.1:8000/uploads/home/1-omnichannel1710327975.jpg', '2024-03-13 18:06:15', '2024-03-13 18:06:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `order_id` int(100) NOT NULL,
  `cust_id` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `qty` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `ongkir` int(100) NOT NULL,
  `resi` varchar(100) NOT NULL DEFAULT '',
  `ekspedisi_id` int(11) NOT NULL DEFAULT 0,
  `status` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `detail_id` int(100) NOT NULL,
  `order_id` int(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `mitra_id` int(11) NOT NULL,
  `qty` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount` int(100) NOT NULL,
  `total` int(100) NOT NULL,
  `note` longtext DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_method`
--

CREATE TABLE `payment_method` (
  `id_payment` int(11) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `payment_method`
--

INSERT INTO `payment_method` (`id_payment`, `logo`, `create_date`, `modified_date`) VALUES
(1, 'http://127.0.0.1:8000/uploads/home/1-paymentMethod1710328062.jpg', '2024-03-13 18:07:42', '2024-03-13 18:07:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `is_dropship` int(11) DEFAULT 0,
  `dropship_id` int(11) NOT NULL DEFAULT 0,
  `mitra` int(11) NOT NULL DEFAULT 0,
  `customer` int(11) NOT NULL DEFAULT 0,
  `name` varchar(500) NOT NULL,
  `tipe` int(11) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `harga_jual` int(50) NOT NULL DEFAULT 0,
  `harga_beli` int(50) NOT NULL DEFAULT 0,
  `discount_jual` int(50) NOT NULL DEFAULT 0,
  `discount_beli` int(50) NOT NULL DEFAULT 0,
  `description` longtext DEFAULT NULL,
  `id_template` int(11) NOT NULL DEFAULT 0,
  `qty` int(100) NOT NULL DEFAULT 0,
  `status` varchar(50) NOT NULL DEFAULT 'Draft',
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`product_id`, `is_dropship`, `dropship_id`, `mitra`, `customer`, `name`, `tipe`, `ukuran`, `harga_jual`, `harga_beli`, `discount_jual`, `discount_beli`, `description`, `id_template`, `qty`, `status`, `create_date`, `modified_date`) VALUES
(7, 1, 0, 0, 0, 'Dropship 1', 2, 'A4', 0, 25000, 0, 0, NULL, 1, 0, 'Draft', '2024-03-09 13:02:03', '2024-03-09 13:58:44'),
(8, 0, 0, 7, 0, 'Dropship 1', 2, 'A4', 70000, 0, 0, 0, 'ini produk mitra 7 test', 1, 10, 'Active', '2024-03-09 14:52:37', '2024-03-09 14:59:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_home`
--

CREATE TABLE `product_home` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product_home`
--

INSERT INTO `product_home` (`id`, `id_product`, `create_date`, `modified_date`) VALUES
(1, 7, '2024-03-13 17:55:21', '2024-03-13 17:55:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `template`
--

CREATE TABLE `template` (
  `template_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tipe` int(11) NOT NULL,
  `template` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`template`)),
  `thumbnail` varchar(500) NOT NULL,
  `user` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `template`
--

INSERT INTO `template` (`template_id`, `name`, `tipe`, `template`, `thumbnail`, `user`, `status`, `create_date`, `modified_date`) VALUES
(1, 'Template 1', 2, '{ \"json 1\" : \"Json 1\", \"json 2\" : \"Json 2\"}', 'http://127.0.0.1:8000/uploads/template/Template-1_1709966837.jpg', 1, 'Active', '2024-03-09 13:47:17', '2024-03-09 13:47:17'),
(2, 'Template 2', 2, '{ \"json 1\" : \"Json 1\", \"json 2\" : \"Json 2\"}', 'http://127.0.0.1:8000/uploads/template/Template-2_1709968353.jpg', 1, 'Active', '2024-03-09 14:12:33', '2024-03-09 14:12:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `tipe_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tipe`
--

INSERT INTO `tipe` (`tipe_id`, `name`, `status`, `create_date`, `modified_date`) VALUES
(1, 'Baju', 'Draft', '2024-02-15 10:54:43', '2024-02-22 20:24:02'),
(2, 'Kaos', 'Active', '2024-02-15 11:22:09', '2024-02-15 11:22:09'),
(3, 'Kaos Berkerah', 'Active', '2024-02-15 11:23:09', '2024-02-15 11:23:09'),
(5, 'Jaket', 'Draft', '2024-03-09 11:50:56', '2024-03-09 11:50:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL,
  `role` varchar(1) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `subdomain` varchar(100) NOT NULL DEFAULT '',
  `main` varchar(11) NOT NULL DEFAULT '',
  `logoUrl` varchar(100) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(1) NOT NULL DEFAULT '',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `email`, `subdomain`, `main`, `logoUrl`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'admin', '$2y$12$OHi2aSV4HMm98WWuATtEi.3gRhiNHPDNns3MSVW3.Jcq7ZWR8I4Iy', '1', 'admin@kreaziku.id', 'www', '0', '', '12345678', '1', '2024-01-22 07:30:58', '2024-01-28 14:55:50'),
(2, 'test', '', '$2y$12$6NOGdAkaEjgaO3pwWt9TNO7gujoK.SPLd.h5.q5R1nagSP7R/y2zy', '2', 'test@test.co', '', '', '', '', '', '2024-01-28 14:06:43', '2024-01-28 14:06:43'),
(7, 'test', 'test', '$2y$12$MMcJMzpZrMTiXJuYKDOCkuocQesqrBXPIkhfOsozgC6OZDEGpumMa', '2', 'email@email.com', '', '', '', '08123456789', '', '2024-02-18 16:07:36', '2024-02-18 16:07:36');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `app_setting`
--
ALTER TABLE `app_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`article_id`);

--
-- Indeks untuk tabel `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`ekspedisi_id`);

--
-- Indeks untuk tabel `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`finance_id`);

--
-- Indeks untuk tabel `image_banner`
--
ALTER TABLE `image_banner`
  ADD PRIMARY KEY (`id_image`);

--
-- Indeks untuk tabel `omnichanel`
--
ALTER TABLE `omnichanel`
  ADD PRIMARY KEY (`id_omnichanel`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indeks untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `product_home`
--
ALTER TABLE `product_home`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`tipe_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `app_setting`
--
ALTER TABLE `app_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `blog`
--
ALTER TABLE `blog`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ekspedisi`
--
ALTER TABLE `ekspedisi`
  MODIFY `ekspedisi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `finance`
--
ALTER TABLE `finance`
  MODIFY `finance_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `image_banner`
--
ALTER TABLE `image_banner`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `omnichanel`
--
ALTER TABLE `omnichanel`
  MODIFY `id_omnichanel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `detail_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `product_home`
--
ALTER TABLE `product_home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `template`
--
ALTER TABLE `template`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `tipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
