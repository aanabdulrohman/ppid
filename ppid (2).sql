-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jul 2021 pada 07.51
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.7

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
-- Struktur dari tabel `data_instansi`
--

CREATE TABLE `data_instansi` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `katpem` text NOT NULL,
  `info` varchar(255) NOT NULL,
  `tujuan` int(200) NOT NULL,
  `tujuan_ins` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_instansi`
--

INSERT INTO `data_instansi` (`id`, `user_id`, `katpem`, `info`, `tujuan`, `tujuan_ins`) VALUES
(17, '', '', '', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_dispu`
--

CREATE TABLE `db_dispu` (
  `id` int(200) NOT NULL,
  `user_id` int(100) NOT NULL,
  `katpem` varchar(200) NOT NULL,
  `info` varchar(100) NOT NULL,
  `tujuan` varchar(200) NOT NULL,
  `tujuan_ins` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `db_dispu`
--

INSERT INTO `db_dispu` (`id`, `user_id`, `katpem`, `info`, `tujuan`, `tujuan_ins`) VALUES
(20, 34, '4', 'mau minta info program disnaker', 'mau nyari tau loker', 1),
(21, 30, '1', 'profil dispu', 'pengen tau aja', 2);

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
(1, 'Disnaker (Dinas Tenaga Kerja)'),
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
  `katpem` text NOT NULL,
  `info` text NOT NULL,
  `tujuan` text NOT NULL,
  `tujuan_ins` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengajuan_informasi`
--

INSERT INTO `pengajuan_informasi` (`id`, `user_id`, `katpem`, `info`, `tujuan`, `tujuan_ins`) VALUES
(10, 30, '1', 'profil dispu', 'pengen tau aja', '2'),
(17, 34, '4', 'mau minta info program disnaker', 'mau nyari tau loker', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_instansi` int(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_instansi`, `name`, `email`, `image`, `password`, `role`, `is_active`, `date_created`) VALUES
(17, 0, 'Admin1', 'admin@gmail.com', 'logo.png', '$2y$10$PnpLtV5gf6M8L0bpMV10f.YYTAqTgF6CQ55Cit418nPb7ONb3YRtG', 1, 1, 1623830646),
(30, 0, 'aan abdul rohman', 'aanabdulrohman3@gmail.com', 'new.png', '$2y$10$jh/CDhSLiY6FArl8eWZegOLDtSgk6tY/e.rsgMZWgFX38kE2mruKW', 2, 1, 1624258447),
(31, 1, 'Disnaker (Dinas Tenaga Kerja)', 'admindisnaker@gmail.com', 'new.png', '$2y$10$i/IHF6Iz3JXmHYoTd.mbKe8vuluKf7ucrtIqdF1/JFq97XVeXpd96', 3, 1, 1624415392),
(32, 0, 'Admin diskominfo', 'admindiskominfo@gmail.com', 'new.png', '$2y$10$avOMknRWS5sw1c82Vk9t9eQqOhV2bDAE.vpz4XyZdToytsX5Fwuce', 4, 1, 1624416823),
(34, 0, 'rengginang', 'rengginangwalet@gmail.com', 'new.png', '$2y$10$njKAqAHdRihQ9CuuCzuff.qO/QwiPo8V.sbCnN.4qYoX/IHOBzQGq', 2, 1, 1625045388),
(35, 2, 'Dispu (Dinas Pekerja Umum)', 'admindispu@gmail.com', 'new.png', '$2y$10$lwo7qg9UcADhoaZcSJ5PLujzpFkYKyYO9D2N.dl1bUNEo2GRQ9eTC', 3, 1, 1625719204);

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
(3, 2, 2),
(4, 1, 3),
(8, 1, 4),
(9, 3, 4),
(11, 4, 9),
(13, 1, 9),
(14, 1, 5),
(15, 4, 5),
(16, 2, 10),
(17, 1, 2);

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
(20, 2, 'Permohonan', 'user/permohonan', 'fas fa-fw fa-user-tie', 1),
(21, 2, 'Informasi Anda', 'user/informasi', 'fas fa-fw fa-user-tie', 1);

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
(19, 'rengginangwalet@gmail.com', 'msIVqFhY4MR/G8SsINpZNYAY6tgtMOGWJ/upXorWyV8=', 1625045388),
(20, 'admindispu@gmail.com', 'F5qH/ZK2kB9zHk/4TJO0zd44XMPOEE5WqLpFm+crR4Y=', 1625719204);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_instansi`
--
ALTER TABLE `data_instansi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `db_dispu`
--
ALTER TABLE `db_dispu`
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
-- AUTO_INCREMENT untuk tabel `data_instansi`
--
ALTER TABLE `data_instansi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `db_dispu`
--
ALTER TABLE `db_dispu`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
