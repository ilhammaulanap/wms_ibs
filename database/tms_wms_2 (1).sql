-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Apr 2021 pada 09.38
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
  `shipment_no` varchar(150) NOT NULL,
  `truck_no` varchar(150) NOT NULL,
  `driver_name` varchar(150) NOT NULL,
  `driver_contact` varchar(20) NOT NULL,
  `id_mot` int(11) NOT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_warehouse` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `photo_sj` text DEFAULT NULL,
  `photo_truck` text DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inbound`
--

INSERT INTO `tb_inbound` (`id`, `inbound_no`, `inbound_date`, `po_no`, `shipment_no`, `truck_no`, `driver_name`, `driver_contact`, `id_mot`, `id_supplier`, `id_warehouse`, `id_user`, `photo_sj`, `photo_truck`, `lastupdate`, `deletedate`) VALUES
(1, '20210302In0001', '2021-03-02', 'PO-001', 'SHIPMENT-001', 'B 1234 G', 'RUDI SANJANAN', '0123123', 1, 1, 1, 1, 'bayar_spamexperts.jpeg', 'temans-logo42.png', '2021-03-02 07:45:50', NULL),
(2, '20210302In0002', '2021-03-02', 'PO-002', 'SJ-003', 'B 123', 'UDIN', '1230128312', 1, 1, 1, 1, '7a37c3a8-e882-4a7c-a1f7-58e47fc80623.jpg', NULL, '2021-03-02 12:23:51', NULL),
(5, '20210408In0001', '2021-04-01', 'MR-0005', '20210326Out0004', '', '', '', 0, NULL, 1, 1, NULL, NULL, '2021-04-08 10:59:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inbound_product`
--

CREATE TABLE `tb_inbound_product` (
  `id` int(11) NOT NULL,
  `id_inbound` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `qty_product` int(11) NOT NULL,
  `id_locator` int(11) NOT NULL,
  `id_product_status` int(11) NOT NULL,
  `photo` text DEFAULT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inbound_product`
--

INSERT INTO `tb_inbound_product` (`id`, `id_inbound`, `id_product`, `qty_product`, `id_locator`, `id_product_status`, `photo`, `deletedate`) VALUES
(1, 1, 2, 2, 3, 2, NULL, NULL),
(2, 2, 2, 4, 4, 1, '16146842317a37c3a8-e882-4a7c-a1f7-58e47fc80623.jpg', NULL),
(3, 2, 1, 5, 3, 1, '1614684231bpk_ram_laptop_bu_runny_1.png', NULL),
(4, 2, 2, 6, 5, 1, '1614684232bayar_spamexperts.jpeg', NULL),
(11, 5, 2, 2, 5, 1, '1614684232bayar_spamexperts.jpeg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`id`, `aksi`, `id_user`, `lastupdate`) VALUES
(1, 'Save Inbound, id inbound : 1', 1, '2021-03-02 03:37:44'),
(2, 'Update Inbound, id inbound : 1', 1, '2021-03-02 07:27:54'),
(3, 'Update Inbound, id inbound : 1', 1, '2021-03-02 07:28:07'),
(4, 'Update Inbound, id inbound : 1', 1, '2021-03-02 07:45:50'),
(5, 'Save Inbound, id inbound : 2', 1, '2021-03-02 12:23:51'),
(6, 'Save Inbound, id inbound : 3', 1, '2021-03-02 12:24:41'),
(7, 'Save Inbound, id inbound : 4', 1, '2021-03-02 12:25:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mot`
--

CREATE TABLE `tb_mot` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_mot`
--

INSERT INTO `tb_mot` (`id`, `name`, `deletedate`) VALUES
(1, '40 FEET', NULL),
(2, 'CDD', NULL);

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
-- Struktur dari tabel `tb_outbound`
--

CREATE TABLE `tb_outbound` (
  `id` int(11) NOT NULL,
  `outbound_no` varchar(30) NOT NULL,
  `outbound_date` date NOT NULL,
  `mr_no` varchar(100) NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `destination` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `truck_no` varchar(15) NOT NULL,
  `driver_name` varchar(30) NOT NULL,
  `driver_contact` varchar(15) NOT NULL,
  `id_mot` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status_outbound` int(11) NOT NULL DEFAULT 1 COMMENT '1 = on prepartion\r\n2 = ready to pick\r\n3 = delivered',
  `lastupdate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outbound`
--

INSERT INTO `tb_outbound` (`id`, `outbound_no`, `outbound_date`, `mr_no`, `id_warehouse`, `site_name`, `destination`, `latitude`, `longitude`, `truck_no`, `driver_name`, `driver_contact`, `id_mot`, `id_user`, `status_outbound`, `lastupdate`, `deletedate`) VALUES
(2, '20210326Out0002', '2021-03-26', 'MR_001', 1, 'Bukit Duri', 'Jalan Bukit Duri Tanjakan No.79, RT.1/RW.9, Bukit Duri, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.222678699999999', '106.8589676', '123', '123', '4444444', 1, 1, 3, '2021-04-08 10:03:05', NULL),
(3, '20210326Out0003', '2021-03-29', 'MR_002', 1, 'TEBET TIMUR', 'Jalan Tebet Timur Dalam Raya No.6, RT.13/RW.5, Tebet Timur, Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.2321195', '106.8537053', '', '', '', 0, 1, 1, '2021-04-08 09:07:48', NULL),
(4, '20210326Out0004', '2021-03-26', 'MR-0005', 1, 'KOTA TUA', 'Kota Tua, Mangga Besar, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.137644799999999', '106.8171245', '', '', '', 0, 1, 4, '2021-04-08 10:59:51', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outbound_product`
--

CREATE TABLE `tb_outbound_product` (
  `id` int(11) NOT NULL,
  `id_outbound` int(11) NOT NULL,
  `id_inbound_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outbound_product`
--

INSERT INTO `tb_outbound_product` (`id`, `id_outbound`, `id_inbound_product`, `qty`, `deletedate`) VALUES
(1, 2, 3, 5, NULL),
(2, 2, 1, 2, NULL),
(3, 3, 4, 2, NULL),
(4, 4, 4, 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outbound_status`
--

CREATE TABLE `tb_outbound_status` (
  `id_outbound` int(11) NOT NULL,
  `id_status_outbound` int(11) NOT NULL,
  `status_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outbound_status`
--

INSERT INTO `tb_outbound_status` (`id_outbound`, `id_status_outbound`, `status_date`) VALUES
(2, 2, '2021-03-31 15:04:00'),
(2, 3, '2021-04-01 09:41:00'),
(4, 4, '2021-04-01 14:38:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_warehouse` int(11) DEFAULT NULL,
  `id_uom` int(11) NOT NULL,
  `length` double NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id`, `code`, `name`, `id_warehouse`, `id_uom`, `length`, `width`, `height`, `deletedate`) VALUES
(1, '20201203001', 'ABC', 1, 1, 1, 3, 4, NULL),
(2, '20201203002', 'BCD', 1, 4, 0, 0, 0, NULL),
(3, '20210301001', '123', 2, 1, 0, 0, 0, NULL),
(4, '', 'asdas', NULL, 5, 1, 3, 4, '2021-04-15'),
(5, '', 'dasd', NULL, 6, 1, 4, 5, '2021-04-15'),
(6, '20210415001', 'asdas', NULL, 5, 1, 3, 4, NULL),
(7, '20210415002', 'dasd', NULL, 6, 1, 4, 5, NULL);

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
(3, 'Dismantle', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product_uom`
--

CREATE TABLE `tb_product_uom` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `symbol` varchar(15) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product_uom`
--

INSERT INTO `tb_product_uom` (`id`, `name`, `symbol`, `deletedate`) VALUES
(1, 'Meter', 'm', NULL),
(4, 'Unit', 'unit', NULL),
(5, 'km', 'Kilometer', NULL),
(6, 'mm', 'Milimeter', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_status_outbound`
--

CREATE TABLE `tb_status_outbound` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_status_outbound`
--

INSERT INTO `tb_status_outbound` (`id`, `name`) VALUES
(1, 'On Preparation'),
(2, 'Ready to Pick Up'),
(3, 'Delivered'),
(4, 'Back to Stock');

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
(1, 'PT. A', NULL),
(2, 'Supplier A', NULL),
(3, 'PT A', NULL),
(4, 'CV B', NULL);

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
(6, 'customer', 'Customer', 2, 'customer@customer.com', '$2y$10$oJxAD1J93JTPbO0i3fFciOfZaSkULOiaEfIIQeU5IcW/jEpIN.6RC', '1', NULL),
(7, 'andi', 'Andi', 1, 'andi@gmail.com', '$2y$10$op71pkreYP0POe0bwFquCug6MmXDa5EaN4YqVLdItgUjiY66HZl52', '1', NULL),
(8, 'budi', 'Budi', 1, 'budi@gmail.com', '$2y$10$nCAvw/ldt5YXm0LBkGvhDeOWa1DgQoDA4ZTX2TzG2TaJikeAj6AOO', '1', NULL),
(9, 'jackie', 'Jackie', 1, 'jackie@gmail.com', '$2y$10$Cj.bFnkaxyLLHiwkaWtVMe2j7pZH0kdbog7iCJGOt6EPrh1lFQOEu', '1', NULL),
(10, 'dwi', 'Dwi', 1, 'dwi@gmail.com', '$2y$10$aYJODYbN6AJw2EptBTB6SOC15xxVFIKMwkkdDExbpjbQcvNCO9rK.', '1', NULL);

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
(3, '12312', '3123123', 12312, 3123123, '2021-02-18'),
(4, 'WH A', 'ALAMAT WH A', 1, 2, NULL),
(5, 'WH B', 'ALAMAT WH B', 1.2, 3.3, NULL),
(6, 'WH C', 'ALAMAT WH C', 3.1, 1.2, NULL),
(7, 'WH D', 'ALAMAT WH D', 4.5, 5.3, NULL);

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
(6, 1, 'B3', NULL),
(8, 1, 'D1', NULL),
(9, 1, 'D3', NULL),
(10, 1, 'D', NULL),
(11, 1, 'E1', NULL);

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
-- Indeks untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mot`
--
ALTER TABLE `tb_mot`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_origin`
--
ALTER TABLE `tb_origin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_outbound`
--
ALTER TABLE `tb_outbound`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_outbound_product`
--
ALTER TABLE `tb_outbound_product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_outbound_status`
--
ALTER TABLE `tb_outbound_status`
  ADD PRIMARY KEY (`id_outbound`,`id_status_outbound`);

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
-- Indeks untuk tabel `tb_status_outbound`
--
ALTER TABLE `tb_status_outbound`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_inbound_product`
--
ALTER TABLE `tb_inbound_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_mot`
--
ALTER TABLE `tb_mot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_origin`
--
ALTER TABLE `tb_origin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_outbound`
--
ALTER TABLE `tb_outbound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_outbound_product`
--
ALTER TABLE `tb_outbound_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_product_status`
--
ALTER TABLE `tb_product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_product_uom`
--
ALTER TABLE `tb_product_uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_status_outbound`
--
ALTER TABLE `tb_status_outbound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_user_level`
--
ALTER TABLE `tb_user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
