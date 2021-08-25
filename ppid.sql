-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Agu 2021 pada 06.45
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ppid`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(100) NOT NULL,
  `instansi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `level`, `instansi`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Diskominfo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansi`
--

CREATE TABLE `instansi` (
  `id` int(11) NOT NULL,
  `nama_instansi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `instansi`
--

INSERT INTO `instansi` (`id`, `nama_instansi`) VALUES
(1, 'Disnaker (Dinas Tenaga Kerjaa)'),
(2, 'Dispu (Dinas Pekerja Umum)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pem`
--

CREATE TABLE `kategori_pem` (
  `id` int(11) NOT NULL,
  `katpem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_pem`
--

INSERT INTO `kategori_pem` (`id`, `katpem`) VALUES
(1, 'Perorangan'),
(2, 'Instansi'),
(3, 'Mahasiswa'),
(4, 'Organisasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_informasi`
--

CREATE TABLE `pengajuan_informasi` (
  `id` int(11) NOT NULL,
  `user_id` int(200) NOT NULL,
  `katpem` int(11) NOT NULL,
  `info` text NOT NULL,
  `tujuan` text NOT NULL,
  `tujuan_ins` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_pengajuan` datetime NOT NULL,
  `updated_pengajuan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajuan_informasi`
--

INSERT INTO `pengajuan_informasi` (`id`, `user_id`, `katpem`, `info`, `tujuan`, `tujuan_ins`, `id_petugas`, `status`, `feedback`, `created_pengajuan`, `updated_pengajuan`) VALUES
(17, 30, 3, 'minta info program disnaker', 'untuk nyari tau loker', 1, 32, 'ditolak', 'informasi yang diminta sama dengan permintaan orang lain, anda bisa melihat dan mendownload di tampilan publik.', '2021-08-23 13:56:16', '2021-08-23 17:27:04'),
(18, 30, 3, 'minta profil disnaker', 'untuk menyelesaikan laporan kkp', 2, 32, 'dikirim', '20210824173054738-1898-1-PB.pdf', '2021-08-23 18:57:57', '2021-08-24 18:01:04'),
(19, 30, 2, 'meminta profile instansi', 'untuk membuat artikel', 2, 32, 'dikirim', '20210825054645Panduan_Format_KKP_BS_NEW_2018.pdf', '2021-08-25 05:35:38', '2021-08-25 05:58:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_instansi`
--

CREATE TABLE `pengajuan_instansi` (
  `id` int(11) NOT NULL,
  `id_pengajuan_informasi` int(11) NOT NULL,
  `id_petugas_diskominfo` int(11) NOT NULL,
  `id_petugas_instansi` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `feedback` text DEFAULT NULL,
  `ukuran_file` int(255) DEFAULT NULL,
  `type_file` varchar(100) DEFAULT NULL,
  `created_pengajuan_instansi` datetime NOT NULL,
  `updated_pengajuan_instansi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajuan_instansi`
--

INSERT INTO `pengajuan_instansi` (`id`, `id_pengajuan_informasi`, `id_petugas_diskominfo`, `id_petugas_instansi`, `status`, `feedback`, `ukuran_file`, `type_file`, `created_pengajuan_instansi`, `updated_pengajuan_instansi`) VALUES
(2, 18, 32, 31, 'dikirim', '20210824173054738-1898-1-PB.pdf', 193, '.pdf', '2021-08-24 04:22:50', '2021-08-24 17:30:54'),
(3, 19, 32, 31, 'dikirim', '20210825054645Panduan_Format_KKP_BS_NEW_2018.pdf', 882, '.pdf', '2021-08-25 05:45:11', '2021-08-25 05:46:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `id_instansi` int(11) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role`, `id_instansi`, `is_active`, `date_created`) VALUES
(17, 'Admin1', 'admin@gmail.com', 'logo.png', '$2y$10$PnpLtV5gf6M8L0bpMV10f.YYTAqTgF6CQ55Cit418nPb7ONb3YRtG', 1, NULL, 1, 1623830646),
(30, 'aan abdul rohman', 'aanabdulrohman3@gmail.com', 'new.png', '$2y$10$jh/CDhSLiY6FArl8eWZegOLDtSgk6tY/e.rsgMZWgFX38kE2mruKW', 2, NULL, 1, 1624258447),
(31, 'instansi', 'admininstansi@gmail.com', 'new.png', '$2y$10$i/IHF6Iz3JXmHYoTd.mbKe8vuluKf7ucrtIqdF1/JFq97XVeXpd96', 3, 2, 1, 1624415392),
(32, 'Admin diskominfo', 'admindiskominfo@gmail.com', 'new.png', '$2y$10$avOMknRWS5sw1c82Vk9t9eQqOhV2bDAE.vpz4XyZdToytsX5Fwuce', 4, NULL, 1, 1624416823),
(34, 'rengginang', 'rengginangwalet@gmail.com', 'new.png', '$2y$10$njKAqAHdRihQ9CuuCzuff.qO/QwiPo8V.sbCnN.4qYoX/IHOBzQGq', 2, NULL, 1, 1625045388);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(8, 1, 4),
(9, 3, 4),
(11, 4, 9),
(13, 1, 9),
(14, 1, 5),
(15, 4, 5),
(16, 2, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'menu'),
(4, 'instansi'),
(5, 'diskominfo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `user_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `user_role`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'instansi'),
(4, 'diskominfo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user/profile', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(12, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(13, 2, 'Rubah Password', 'user/ubahpassword', 'fas fa-fw fa-key', 1),
(15, 4, 'Dashboard instansi', 'instansi', 'fas fa-fw fa-user-tie', 1),
(16, 5, 'Dashboard diskominfo', 'diskominfo', 'fas fa-fw fa-user-tie', 1),
(17, 2, 'Dashboard User', 'user', 'fas fa-fw fa-user-tie', 1),
(18, 5, 'Disposisi', 'diskominfo/disposisi', 'fas fa-fw fa-key', 1),
(19, 4, 'Input Data', 'instansi/inputdata', 'fas fa-fw fa-key', 1),
(20, 2, 'Permohonan', 'user/permohonan', 'fas fa-fw fa-user-tie', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(200) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(14, 'aanabdulrohman3@gmail.com', 'NeoRojmZl0Fz2aKTcFw1OaZXMwQfVn/CO4SPTORK28U=', 1624262083),
(15, 'aanabdulrohman3@gmail.com', 'vzUmG12cnzDOKeZMubdXEH+htzND31d7lX07KVHIp5s=', 1624262788),
(16, 'aanabdulrohman3@gmail.com', 'G0VDspkaIrrwTYZO7gA8ZmFJQmK6wEQaVvhLcXATitI=', 1624262904),
(17, 'rengginangwalet@gmail.com', 'RigNQe2dJWNlY4c7DMzb4ikCt4LksjFOV/nierEbwCY=', 1624415392),
(18, 'admindiskominfo@gmail.com', 'EGYuoJ4qrU63MxQBkOjzSD081oEEwbAqUQrA6dI8PKM=', 1624416823),
(19, 'rengginangwalet@gmail.com', 'msIVqFhY4MR/G8SsINpZNYAY6tgtMOGWJ/upXorWyV8=', 1625045388);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_pem`
--
ALTER TABLE `kategori_pem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_informasi`
--
ALTER TABLE `pengajuan_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengajuan_instansi`
--
ALTER TABLE `pengajuan_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `instansi`
--
ALTER TABLE `instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_pem`
--
ALTER TABLE `kategori_pem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_informasi`
--
ALTER TABLE `pengajuan_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_instansi`
--
ALTER TABLE `pengajuan_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
