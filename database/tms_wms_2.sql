-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Feb 2021 pada 17.28
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms_wms_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_destination`
--

CREATE TABLE `tb_destination` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_destination`
--

INSERT INTO `tb_destination` (`id`, `name`, `deletedate`) VALUES
(1, 'Site A', '2021-02-18'),
(2, 'Site B', '2021-02-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inbound`
--

CREATE TABLE `tb_inbound` (
  `id` int(11) NOT NULL,
  `inbound_no` varchar(150) NOT NULL,
  `inbound_date` date NOT NULL,
  `po_no` varchar(150) NOT NULL,
  `truck_no` varchar(150) NOT NULL,
  `driver_name` varchar(150) NOT NULL,
  `id_origin` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_warehouse` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `confirm_date` date DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inbound`
--

INSERT INTO `tb_inbound` (`id`, `inbound_no`, `inbound_date`, `po_no`, `truck_no`, `driver_name`, `id_origin`, `id_supplier`, `id_warehouse`, `id_user`, `confirm_date`, `lastupdate`, `deletedate`) VALUES
(3, '20210218In0003', '2021-02-01', 'PO_001', 'BG_009', 'ANDI', 1, 1, 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inbound_product`
--

CREATE TABLE `tb_inbound_product` (
  `id` int(11) NOT NULL,
  `id_inbound` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty_product` int(11) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inbound_product`
--

INSERT INTO `tb_inbound_product` (`id`, `id_inbound`, `id_product`, `qty_product`, `deletedate`) VALUES
(1, 3, 1, 5, NULL),
(2, 3, 2, 5, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_origin`
--

CREATE TABLE `tb_origin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deletedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_origin`
--

INSERT INTO `tb_origin` (`id`, `name`, `deletedate`) VALUES
(1, 'KUPANG', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  `id_uom` int(11) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id`, `code`, `name`, `id_warehouse`, `id_uom`, `deletedate`) VALUES
(1, '20201203001', 'ABC', 1, 1, NULL),
(2, '20201203002', 'BCD', 1, 4, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product_status`
--

CREATE TABLE `tb_product_status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product_status`
--

INSERT INTO `tb_product_status` (`id`, `name`, `deletedate`) VALUES
(1, 'Good', NULL),
(2, 'Damage', NULL),
(3, 'Good Dismantle', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product_uom`
--

CREATE TABLE `tb_product_uom` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product_uom`
--

INSERT INTO `tb_product_uom` (`id`, `name`, `deletedate`) VALUES
(1, 'Meter', NULL),
(2, 'Meter', '2020-11-27'),
(3, 'Meter', '2020-11-27'),
(4, 'Unit', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id`, `name`, `deletedate`) VALUES
(1, 'PT. A', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_level` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `name`, `id_level`, `email`, `password`, `status`, `deletedate`) VALUES
(1, 'admin', 'Administrator', 1, 'admin@admin.com', '$2y$10$F68bkTtLl5ms1PXcJXQeJ.9OKLGCwfdzP2kxaFoTKTAmEGCZB85DO', '1', NULL),
(2, 'user', 'Denny1', 3, '', '$2y$10$X/mA7KItYqq0jqHDiK78QOjjitWBVcF7mcJXu9304VhZOPXcxsnrG', '1', '2020-11-27'),
(3, 'testing', '123', 3, '', '$2y$10$ny8LPALsktm8CSNWbbEmZesnjS1gO/BhSxoSszrzZYNjg.id5Tx.u', '1', '2020-11-27'),
(5, 'user', 'User', 3, 'user@user.com', '$2y$10$5PZocIRtRdapCvtvnLFdueEZe8dAPtEs.cwb70bdKbtICYk2Fbk9y', '1', NULL),
(6, 'customer', 'Customer', 2, 'customer@customer.com', '$2y$10$oJxAD1J93JTPbO0i3fFciOfZaSkULOiaEfIIQeU5IcW/jEpIN.6RC', '1', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_level`
--

CREATE TABLE `tb_user_level` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_level`
--

INSERT INTO `tb_user_level` (`id`, `name`, `deletedate`) VALUES
(1, 'Administrator', NULL),
(2, 'Customer', NULL),
(3, 'PIC Gudang', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warehouse`
--

CREATE TABLE `tb_warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warehouse`
--

INSERT INTO `tb_warehouse` (`id`, `name`, `address`, `latitude`, `longitude`, `deletedate`) VALUES
(1, 'Warehouse Pier', 'Jalan contoh ', 1.4, 5.666, NULL),
(2, 'B', 'B', 1, 2, '2021-02-18'),
(3, '12312', '3123123', 12312, 3123123, '2021-02-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warehouse_locator`
--

CREATE TABLE `tb_warehouse_locator` (
  `id` int(11) NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warehouse_locator`
--

INSERT INTO `tb_warehouse_locator` (`id`, `id_warehouse`, `name`, `deletedate`) VALUES
(2, 1, 'A1', NULL),
(3, 1, 'A2', NULL),
(4, 1, 'A3', NULL),
(5, 1, 'B1', NULL),
(6, 1, 'B3', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warehouse_user`
--

CREATE TABLE `tb_warehouse_user` (
  `id_warehouse` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warehouse_user`
--

INSERT INTO `tb_warehouse_user` (`id_warehouse`, `id_user`) VALUES
(1, 1),
(1, 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_destination`
--
ALTER TABLE `tb_destination`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_inbound`
--
ALTER TABLE `tb_inbound`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_inbound_product`
--
ALTER TABLE `tb_inbound_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_origin`
--
ALTER TABLE `tb_origin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_warehouse` (`id_warehouse`),
  ADD KEY `id_uom` (`id_uom`);

--
-- Indeks untuk tabel `tb_product_status`
--
ALTER TABLE `tb_product_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_product_uom`
--
ALTER TABLE `tb_product_uom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indeks untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username_2` (`username`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `tb_user_level`
--
ALTER TABLE `tb_user_level`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_warehouse` (`id_warehouse`);

--
-- Indeks untuk tabel `tb_warehouse_user`
--
ALTER TABLE `tb_warehouse_user`
  ADD PRIMARY KEY (`id_warehouse`,`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_destination`
--
ALTER TABLE `tb_destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_inbound`
--
ALTER TABLE `tb_inbound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_inbound_product`
--
ALTER TABLE `tb_inbound_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_origin`
--
ALTER TABLE `tb_origin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_product_status`
--
ALTER TABLE `tb_product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_product_uom`
--
ALTER TABLE `tb_product_uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_user_level`
--
ALTER TABLE `tb_user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_user_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  ADD CONSTRAINT `tb_warehouse_locator_ibfk_1` FOREIGN KEY (`id_warehouse`) REFERENCES `tb_warehouse` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
