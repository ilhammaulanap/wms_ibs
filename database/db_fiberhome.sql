-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Agu 2021 pada 05.52
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fiberhome`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inbound`
--

CREATE TABLE `tb_inbound` (
  `id` int(11) NOT NULL,
  `inbound_no` varchar(150) NOT NULL,
  `inbound_date` date NOT NULL,
  `id_stock_transfer` int(11) DEFAULT NULL,
  `po_no` varchar(150) NOT NULL,
  `shipment_no` varchar(150) NOT NULL,
  `truck_no` varchar(150) NOT NULL,
  `driver_name` varchar(150) NOT NULL,
  `driver_contact` varchar(20) NOT NULL,
  `id_mot` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `id_warehouse` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `photo_sj` text DEFAULT NULL,
  `photo_truck` text DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inbound`
--

INSERT INTO `tb_inbound` (`id`, `inbound_no`, `inbound_date`, `id_stock_transfer`, `po_no`, `shipment_no`, `truck_no`, `driver_name`, `driver_contact`, `id_mot`, `id_supplier`, `id_warehouse`, `id_user`, `photo_sj`, `photo_truck`, `lastupdate`, `deletedate`) VALUES
(2, '20210629In0001', '2021-06-29', NULL, '', '', 'B 1287 AM', 'Anton', '088876281980', 2, 1, 8, 1, 'Data_Material_Local_Dismantle_-_Metrotel.pdf', 'WhatsApp_Image_2021-06-29_at_13.22.52.jpeg', '2021-06-29 06:49:35', NULL),
(3, '20210629In0002', '2021-06-29', NULL, '', '', 'B 1287 AM', 'musksin', '088876281980', 1, 1, 8, 1, 'New_Material_Aviat_-_Metrotel.pdf', 'WhatsApp_Image_2021-06-29_at_13.22.521.jpeg', '2021-06-29 07:25:53', NULL),
(4, '20210708In0001', '2021-07-08', NULL, '', '', 'B 9838 BEH', 'Ady', '082218800964', 1, 1, 8, 2, 'Doc1.docx', '3.jpg', '2021-07-08 05:37:56', NULL),
(5, '20210708In0002', '2021-07-08', NULL, '', '', 'B 9889 FCC', 'SOHIRIN', '082218800964', 2, 1, 8, 2, '4.jpg', '5.jpg', '2021-07-08 05:52:28', NULL),
(6, '20210713In0001', '2021-07-13', NULL, '', '', 'armin', 'B 9815 UCX', '082218800964', 2, 1, 8, 2, '6.jpg', '7.jpg', '2021-07-13 05:42:24', NULL),
(8, '20210813ST0001', '2021-08-13', 2, '20210802ST0002', 'asdasd', '123', '123', '123', 2, 2, 9, 1, NULL, NULL, '2021-08-13 09:55:17', NULL),
(9, '20210813ST0002', '2021-08-13', 2, '20210802ST0002', 'asdasd', '123', '123', '123', 2, 2, 9, 1, '1.pdf', '1.pdf', '2021-08-13 09:56:13', NULL),
(10, '20210824/In/TBG/0001', '2021-08-24', NULL, 'PO_001', 'SJ_001', 'B 12398 ', 'ANDI WIJATA', '01231231823', 3, 2, 8, 2, NULL, NULL, '2021-08-24 07:30:17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_inbound_product`
--

CREATE TABLE `tb_inbound_product` (
  `id` int(11) NOT NULL,
  `id_inbound` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `lot_number` varchar(150) DEFAULT NULL,
  `qty_product` int(11) NOT NULL,
  `id_locator` int(11) DEFAULT NULL,
  `id_product_status` int(11) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_inbound_product`
--

INSERT INTO `tb_inbound_product` (`id`, `id_inbound`, `id_product`, `lot_number`, `qty_product`, `id_locator`, `id_product_status`, `photo`, `deletedate`) VALUES
(5, 2, 5, '29062021', 157, 1, 3, NULL, NULL),
(6, 2, 6, '29062021', 65, 1, 3, NULL, NULL),
(7, 2, 7, '29062021', 32, 1, 3, NULL, NULL),
(8, 2, 8, '29062021', 79, 1, 3, NULL, NULL),
(9, 2, 9, '29062021', 108, 1, 3, NULL, NULL),
(10, 2, 10, '29062021', 650, 1, 3, NULL, NULL),
(11, 2, 11, '29062021', 20, 1, 3, NULL, NULL),
(12, 2, 12, '29062021', 4, 1, 3, NULL, NULL),
(13, 2, 13, '29062021', 304, 1, 1, NULL, NULL),
(14, 2, 14, '29062021', 289, 1, 1, NULL, NULL),
(15, 2, 15, '29062021', 802, 1, 1, NULL, NULL),
(16, 2, 16, '29062021', 606, 1, 1, NULL, NULL),
(17, 2, 17, '29062021', 975, 1, 1, NULL, NULL),
(18, 2, 18, '29062021', 3255, 1, 1, NULL, NULL),
(19, 2, 19, '29062021', 67, 1, 1, NULL, NULL),
(20, 2, 20, '29062021', 109, 1, 1, NULL, NULL),
(21, 2, 21, '29062021', 283, 1, 1, NULL, NULL),
(22, 2, 22, '29062021', 279, 1, 1, NULL, NULL),
(23, 2, 23, '29062021', 323, 1, 1, NULL, NULL),
(24, 2, 24, '29062021', 360, 1, 1, NULL, NULL),
(25, 2, 25, '29062021', 244, 1, 3, NULL, NULL),
(26, 2, 26, '29062021', 68, 1, 1, NULL, NULL),
(27, 2, 27, '29062021', 2785, 1, 1, NULL, NULL),
(28, 2, 28, '29062021', 1361, 1, 1, NULL, NULL),
(29, 2, 29, '29062021', 107, 1, 1, NULL, NULL),
(30, 2, 30, '29062021', 30, 1, 1, NULL, NULL),
(31, 2, 31, '29062021', 30, 1, 1, NULL, NULL),
(32, 2, 32, '29062021', 30, 1, 1, NULL, NULL),
(33, 2, 33, '29062021', 6152, 1, 1, NULL, NULL),
(34, 2, 34, '29062021', 356, 1, 1, NULL, NULL),
(35, 2, 35, '29062021', 445, 1, 1, NULL, NULL),
(36, 2, 36, '29062021', 200, 1, 1, NULL, NULL),
(37, 2, 37, '29062021', 300, 1, 1, NULL, NULL),
(38, 2, 38, '29062021', 96, 1, 1, NULL, NULL),
(39, 2, 39, '29062021', 93, 1, 3, NULL, NULL),
(40, 2, 40, '29062021', 18, 1, 3, NULL, NULL),
(41, 2, 41, '29062021', 4, 1, 3, NULL, NULL),
(42, 2, 42, '29062021', 75, 1, 3, NULL, NULL),
(43, 2, 43, '29062021', 63, 1, 3, NULL, NULL),
(44, 2, 44, '29062021', 20, 1, 3, NULL, NULL),
(45, 2, 45, '29062021', 4, 1, 3, NULL, NULL),
(46, 2, 46, '29062021', 136, 1, 3, NULL, NULL),
(47, 2, 47, '29062021', 72, 1, 3, NULL, NULL),
(48, 2, 48, '29062021', 122, 1, 1, NULL, NULL),
(49, 2, 49, '29062021', 118, 1, 1, NULL, NULL),
(50, 2, 50, '29062021', 10, 1, 1, NULL, NULL),
(51, 2, 51, '29062021', 35, 1, 1, NULL, NULL),
(52, 2, 52, '29062021', 11660, 1, 1, NULL, NULL),
(53, 2, 53, '29062021', 5414, 1, 1, NULL, NULL),
(54, 3, 54, '29062021', 11, 2, 1, NULL, NULL),
(55, 3, 55, '29062021', 11, 2, 1, NULL, NULL),
(56, 3, 56, '29062021', 15, 2, 1, NULL, NULL),
(57, 3, 57, '29062021', 15, 2, 1, NULL, NULL),
(58, 3, 58, '29062021', 36, 2, 1, NULL, NULL),
(59, 3, 59, '29062021', 36, 2, 1, NULL, NULL),
(60, 3, 60, '29062021', 28, 2, 1, NULL, NULL),
(61, 3, 61, '29062021', 10, 2, 1, NULL, NULL),
(62, 3, 62, '29062021', 8, 2, 1, NULL, NULL),
(63, 3, 63, '29062021', 10, 2, 1, NULL, NULL),
(64, 3, 64, '29062021', 8, 2, 1, NULL, NULL),
(65, 3, 65, '29062021', 26, 2, 1, NULL, NULL),
(66, 3, 66, '29062021', 44, 2, 1, NULL, NULL),
(67, 3, 67, '29062021', 10, 2, 1, NULL, NULL),
(68, 3, 68, '29062021', 4, 2, 1, NULL, NULL),
(69, 3, 69, '29062021', 24, 2, 1, NULL, NULL),
(70, 3, 70, '29062021', 17, 2, 1, NULL, NULL),
(71, 3, 71, '29062021', 1, 2, 1, NULL, NULL),
(72, 3, 98, '29062021', 17, 2, 1, NULL, NULL),
(73, 3, 99, '29062021', 89, 2, 1, NULL, NULL),
(74, 3, 74, '29062021', 9, 2, 1, NULL, NULL),
(75, 3, 75, '29062021', 1, 2, 1, NULL, NULL),
(76, 3, 76, '29062021', 106, 2, 1, NULL, NULL),
(77, 3, 77, '29062021', 116, 2, 1, NULL, NULL),
(78, 3, 78, '29062021', 154, 2, 1, NULL, NULL),
(79, 3, 79, '29062021', 116, 2, 1, NULL, NULL),
(80, 3, 80, '29062021', 116, 2, 1, NULL, NULL),
(81, 3, 81, '29062021', 20, 2, 1, NULL, NULL),
(82, 3, 82, '29062021', 116, 2, 1, NULL, NULL),
(83, 3, 83, '29062021', 28, 2, 1, NULL, NULL),
(84, 3, 84, '29062021', 56, 2, 1, NULL, NULL),
(85, 3, 100, '29062021', 28, 2, 1, NULL, NULL),
(86, 3, 86, '29062021', 28, 2, 1, NULL, NULL),
(87, 3, 101, '29062021', 28, 2, 1, NULL, NULL),
(88, 3, 88, '29062021', 18, 2, 1, NULL, NULL),
(89, 3, 89, '29062021', 400, 2, 1, NULL, NULL),
(90, 3, 102, '29062021', 16, 2, 1, NULL, NULL),
(91, 3, 91, '29062021', 16, 2, 1, NULL, NULL),
(92, 3, 92, '29062021', 8, 2, 1, NULL, NULL),
(93, 3, 93, '29062021', 28, 2, 1, NULL, NULL),
(94, 4, 99, '1', 88, 1, 1, NULL, NULL),
(95, 4, 89, '1', 1000, 1, 1, NULL, NULL),
(96, 4, 90, '1', 40, 1, 1, NULL, NULL),
(97, 4, 91, '1', 40, 1, 1, NULL, NULL),
(98, 5, 103, '1', 12, 1, 1, NULL, NULL),
(99, 6, 104, '1', 18, 1, 1, NULL, NULL),
(100, 6, 105, '1', 90, 1, 1, NULL, NULL),
(101, 9, 6, '29062021', 25, 5, 3, NULL, NULL),
(102, 10, 8, '012938', 1, 2, 1, NULL, NULL),
(103, 10, 6, '123098', 4, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL,
  `aksi` text NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `lastupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`id`, `aksi`, `id_user`, `lastupdate`) VALUES
(1, 'Save Inbound, id inbound : 1', 1, '2021-06-08 06:04:45'),
(2, 'Save Inbound, id inbound : 2', 1, '2021-06-29 06:49:35'),
(3, 'Save Inbound, id inbound : 3', 1, '2021-06-29 07:25:53'),
(4, 'Save Inbound, id inbound : 4', 2, '2021-07-08 05:37:56'),
(5, 'Save Inbound, id inbound : 5', 2, '2021-07-08 05:52:28'),
(6, 'Save Inbound, id inbound : 6', 2, '2021-07-13 05:42:24'),
(7, 'Save Inbound, id inbound : 9', 1, '2021-08-13 09:56:13'),
(8, 'Save Inbound, id inbound : 10', 2, '2021-08-24 07:30:17');

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
(2, 'CDD', NULL),
(3, 'Pick UP', NULL),
(4, '20 Fit', NULL),
(5, 'Fuso', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_origin`
--

CREATE TABLE `tb_origin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `deletedate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outbound`
--

CREATE TABLE `tb_outbound` (
  `id` int(11) NOT NULL,
  `outbound_no` varchar(30) NOT NULL,
  `outbound_date` date NOT NULL,
  `po_no` varchar(25) DEFAULT NULL,
  `wu_no` varchar(25) DEFAULT NULL,
  `mr_no` varchar(100) NOT NULL COMMENT 'order number',
  `id_warehouse` int(11) DEFAULT NULL,
  `receiver_name` varchar(50) DEFAULT NULL,
  `site_id` varchar(15) DEFAULT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_wbs` varchar(25) DEFAULT NULL,
  `destination` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `truck_no` varchar(15) NOT NULL,
  `driver_name` varchar(30) NOT NULL,
  `driver_contact` varchar(15) NOT NULL,
  `id_mot` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status_outbound` int(11) DEFAULT 1 COMMENT '1 = on prepartion2 = ready to pick3 = delivered',
  `file_dn` text DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outbound`
--

INSERT INTO `tb_outbound` (`id`, `outbound_no`, `outbound_date`, `po_no`, `wu_no`, `mr_no`, `id_warehouse`, `receiver_name`, `site_id`, `site_name`, `site_wbs`, `destination`, `latitude`, `longitude`, `truck_no`, `driver_name`, `driver_contact`, `id_mot`, `id_user`, `status_outbound`, `file_dn`, `lastupdate`, `deletedate`) VALUES
(1, '20210824/Out/TBG/0001', '2021-08-24', NULL, NULL, 'ORDER_OUT_001', 8, 'ANDI WIAJAYA', NULL, 'NAME_OUT_001', NULL, 'Jalan Tebet Timur Dalam Raya, RT.13/RW.9, Tebet Timur, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.236322599999999', '106.8569653', '', '', '', NULL, 2, 1, NULL, '2021-08-24 09:07:35', NULL),
(2, '20210824/Out/TBG/0002', '2021-08-31', 'PO_OUT_002', 'WU_OUT_002', 'OUT_02', 8, 'ANDI', 'IT_OUT_002', 'NAME_OUT_002', 'WBS_002', 'Jl. Medan Merdeka Tim., RT.7/RW.1, Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.176650899999999', '106.8312336', '', '', '', NULL, 2, 1, NULL, '2021-08-24 09:13:43', NULL),
(3, '20210824/Out/TBG/0003', '2021-08-31', 'PO_OUT_002', 'WU_OUT_002', 'OUT_02', 8, 'ANDI', 'IT_OUT_002', 'NAME_OUT_002', 'WBS_002', 'Jl. Medan Merdeka Tim., RT.7/RW.1, Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Indonesia', '-6.176650899999999', '106.8312336', '123', '123', '123', 3, 2, 2, NULL, '2021-08-24 10:02:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outbound_product`
--

CREATE TABLE `tb_outbound_product` (
  `id` int(11) NOT NULL,
  `id_outbound` int(11) DEFAULT NULL,
  `id_inbound_product` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outbound_product`
--

INSERT INTO `tb_outbound_product` (`id`, `id_outbound`, `id_inbound_product`, `qty`, `deletedate`) VALUES
(1, 3, 5, 15, NULL),
(2, 3, 7, 5, NULL),
(3, 1, 5, 15, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_outbound_status`
--

CREATE TABLE `tb_outbound_status` (
  `id_outbound` int(11) NOT NULL DEFAULT 0,
  `id_status_outbound` int(11) NOT NULL DEFAULT 0,
  `status_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_outbound_status`
--

INSERT INTO `tb_outbound_status` (`id_outbound`, `id_status_outbound`, `status_date`) VALUES
(1, 1, '2021-06-08 14:10:00'),
(1, 3, '2021-06-08 14:10:00'),
(3, 2, '2021-08-24 15:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_warehouse` int(11) DEFAULT NULL,
  `id_uom` int(11) NOT NULL,
  `length` double NOT NULL,
  `width` double NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id`, `code`, `name`, `id_warehouse`, `id_uom`, `length`, `width`, `height`, `weight`, `deletedate`) VALUES
(5, '20210629001', 'RRU + 3pcs SFP Optical', NULL, 1, 1, 1, 1, 0, NULL),
(6, '20210629002', 'BBU main Device', NULL, 1, 1, 1, 1, 0, NULL),
(7, '20210629003', 'Modul PSU', NULL, 1, 1, 1, 1, 0, NULL),
(8, '20210629004', 'Rack Rectifier', NULL, 1, 1, 1, 1, 0, NULL),
(9, '20210629005', 'Battery Kwdick', NULL, 1, 1, 1, 1, 0, NULL),
(10, '20210629006', 'Battery 100ah', NULL, 1, 1, 1, 1, 0, NULL),
(11, '20210629007', 'Battery 180ah', NULL, 1, 1, 1, 1, 0, NULL),
(12, '20210629008', 'Battery 190ah', NULL, 1, 1, 1, 1, 0, NULL),
(13, '20210629009', 'Battery 200ah', NULL, 1, 1, 1, 1, 0, NULL),
(14, '20210629010', 'Jumper Battery', NULL, 1, 1, 1, 1, 0, NULL),
(15, '20210629011', 'DC Cable blue 25mm', NULL, 1, 1, 1, 1, 0, NULL),
(16, '20210629012', 'DC Cable black 25mm', NULL, 1, 1, 1, 1, 0, NULL),
(17, '20210629013', 'Grounding yellow green 16 mm (RRU)', NULL, 1, 1, 1, 1, 0, NULL),
(18, '20210629014', 'Cable power RRU 2x10/2x6 + Grounding', NULL, 1, 1, 1, 1, 0, NULL),
(19, '20210629015', 'Optical Cable RRU', NULL, 1, 1, 1, 1, 0, NULL),
(20, '20210629016', 'Cable Power Rak rectifier ( 4x10)', NULL, 1, 1, 1, 1, 0, NULL),
(21, '20210629017', 'Scun 10', NULL, 1, 1, 1, 1, 0, NULL),
(22, '20210629018', 'Scun 25', NULL, 1, 1, 1, 1, 0, NULL),
(23, '20210629019', 'Scun 16', NULL, 1, 1, 1, 1, 0, NULL),
(24, '20210629020', 'Conduit', NULL, 1, 1, 1, 1, 0, NULL),
(25, '20210629021', 'Sectoral Antenna+Bracket', NULL, 1, 1, 1, 1, 0, NULL),
(26, '20210629022', 'Jumper  antenna', NULL, 1, 1, 1, 1, 0, NULL),
(27, '20210629023', 'Rubber', NULL, 1, 1, 1, 1, 0, NULL),
(28, '20210629024', 'Aspalt', NULL, 1, 1, 1, 1, 0, NULL),
(29, '20210629025', 'Isloasi Black', NULL, 1, 1, 1, 1, 0, NULL),
(30, '20210629026', 'Isloasi Yellow', NULL, 1, 1, 1, 1, 0, NULL),
(31, '20210629027', 'Isloasi Red', NULL, 1, 1, 1, 1, 0, NULL),
(32, '20210629028', 'Isloasi Blue', NULL, 1, 1, 1, 1, 0, NULL),
(33, '20210629029', 'LAN cable', NULL, 1, 1, 1, 1, 0, NULL),
(34, '20210629030', 'Connector RJ45', NULL, 1, 1, 1, 1, 0, NULL),
(35, '20210629031', 'Grounding yellow green 25 mm', NULL, 1, 1, 1, 1, 0, NULL),
(36, '20210629032', 'DYNO BOLTS', NULL, 1, 1, 1, 1, 0, NULL),
(37, '20210629033', 'Clamps cable', NULL, 1, 1, 1, 1, 0, NULL),
(38, '20210629034', 'Connector Power RRU', NULL, 1, 1, 1, 1, 0, NULL),
(39, '20210629035', 'BPN+3SFP Oftical 1,4km', NULL, 1, 1, 1, 1, 0, NULL),
(40, '20210629036', 'CCE1B+1 SFP Optical 1,25km', NULL, 1, 1, 1, 1, 0, NULL),
(41, '20210629037', 'ANT MW 0,3m 6GHZ+ Braket', NULL, 1, 1, 1, 1, 0, NULL),
(42, '20210629038', 'ANT MW 0,6m 6GHZ+ Braket', NULL, 1, 1, 1, 1, 0, NULL),
(43, '20210629039', 'ANT MW 0,9m 6GHZ+ Braket', NULL, 1, 1, 1, 1, 0, NULL),
(44, '20210629040', 'ANT MW 1,2m 6GHZ+ Braket', NULL, 1, 1, 1, 1, 0, NULL),
(45, '20210629041', 'ANT MW 1,8m 6GHZ+ Braket', NULL, 1, 1, 1, 1, 0, NULL),
(46, '20210629042', 'ODU', NULL, 1, 1, 1, 1, 0, NULL),
(47, '20210629043', 'IDU', NULL, 1, 1, 1, 1, 0, NULL),
(48, '20210629044', 'Cable Ties 200mm', NULL, 1, 1, 1, 1, 0, NULL),
(49, '20210629045', 'Cable Ties 300mm', NULL, 1, 1, 1, 1, 0, NULL),
(50, '20210629046', 'Connector Coax IDU', NULL, 1, 1, 1, 1, 0, NULL),
(51, '20210629047', 'Connector Coax ODU', NULL, 1, 1, 1, 1, 0, NULL),
(52, '20210629048', 'Cable Coax', NULL, 1, 1, 1, 1, 0, NULL),
(53, '20210629049', 'Cabel Power DC 1.8MM', NULL, 1, 1, 1, 1, 0, NULL),
(54, '20210629050', 'WTM 4200 H', NULL, 1, 1, 1, 1, 0, NULL),
(55, '20210629051', 'WTM 4200 L', NULL, 1, 1, 1, 1, 0, NULL),
(56, '20210629052', 'WTM 4500 H', NULL, 1, 1, 1, 1, 0, NULL),
(57, '20210629053', 'WTM 4500 L', NULL, 1, 1, 1, 1, 0, NULL),
(58, '20210629054', 'WTM4100 H', NULL, 1, 1, 1, 1, 0, NULL),
(59, '20210629055', 'WTM4100 L', NULL, 1, 1, 1, 1, 0, NULL),
(60, '20210629056', 'ADAPTOR COAX', NULL, 1, 1, 1, 1, 0, NULL),
(61, '20210629057', 'MW WTC09-W59DAR-Q0SE', NULL, 1, 1, 1, 1, 0, NULL),
(62, '20210629058', 'MW WTC09-W59DAR-QFD', NULL, 1, 1, 1, 1, 0, NULL),
(63, '20210629059', 'MW WTC09-W59DAR-QOSA', NULL, 1, 1, 1, 1, 0, NULL),
(64, '20210629060', 'MW WTC12-W59DHR-CFD', NULL, 1, 1, 1, 1, 0, NULL),
(65, '20210629061', 'MW WTC12-W59DHR-COSA', NULL, 1, 1, 1, 1, 0, NULL),
(66, '20210629062', 'MW WTC12-W59DHR-COSD', NULL, 1, 1, 1, 1, 0, NULL),
(67, '20210629063', 'MW WTC12-W59DHR-COSE', NULL, 1, 1, 1, 1, 0, NULL),
(68, '20210629064', 'MW WTC18-W59DAR-COSA', NULL, 1, 1, 1, 1, 0, NULL),
(69, '20210629065', 'MW WTC18-W59DAR-COSD', NULL, 1, 1, 1, 1, 0, NULL),
(70, '20210629066', 'HYBRID CABLE ASSEMBLY TO HYBRID FIBER POWER CABEL ASSEMBLY 50M', NULL, 1, 1, 1, 1, 0, NULL),
(71, '20210629067', 'HYBRID CABLE ASSEMBLY TO HYBRID FIBER POWER CABEL ASSEMBLY 75M', NULL, 1, 1, 1, 1, 0, NULL),
(72, '20210629068', 'CABLE KIT,ETHERNET,CAT5E,SHIELDED,24AWG,INDOOR/OUTDOOR,INCLUDES 2XRJ45(M) CONNECTORS UN-INSTALLED 50', NULL, 1, 1, 1, 1, 0, NULL),
(73, '20210629069', 'CABLE KIT,ETHERNET,CAT5E,SHIELDED,24AWG,INDOOR/OUTDOOR,INCLUDES 2XRJ45(M) CONNECTORS UN-INSTALLED 75', NULL, 1, 1, 1, 1, 0, NULL),
(74, '20210629070', 'CABLE PWR 2CORE BLUE/GRAY 2X16 AWG 3WIRE 50M TERM WTM4K (C45593-A534-A050-81)', NULL, 1, 1, 1, 1, 0, NULL),
(75, '20210629071', 'CABLE PWR 2CORE BLUE/GRAY 2X16 AWG 3WIRE 75M TERM WTM4K (C45593-A534-A075-81)', NULL, 1, 1, 1, 1, 0, NULL),
(76, '20210629072', 'SFP OPT GIGE 1310NM SMF LC 10KM 0 TO 70C', NULL, 1, 1, 1, 1, 0, NULL),
(77, '20210629073', 'CABLE GLEN,CABLE RANGE 6-9M LONG BODY,EPDM,(PACK OF THREE)', NULL, 1, 1, 1, 1, 0, NULL),
(78, '20210629074', 'CABLE TIE,390MM(15.4\'\')LENGTH,7.6MM WIDHT,NYLON BLACK (KIT100PIECES)', NULL, 1, 1, 1, 1, 0, NULL),
(79, '20210629075', 'OUT DOOR 48 VDC/15A SLICON PROTECTOR WITH MOUNTING BRACKET(1101-1110-KT)', NULL, 1, 1, 1, 1, 0, NULL),
(80, '20210629076', 'CABLE PWR 2CORE BLUE/GRAY 2X16 AWG 3WIRE 2M TERM WTM4K (C45593-A534-A002-81)', NULL, 1, 1, 1, 1, 0, NULL),
(81, '20210629077', 'AOD RADIO XPIC  OUTDOOR CABLE ASSEMBLY TNC PLUG 25M (T30T30-L240-25MAVI)', NULL, 1, 1, 1, 1, 0, NULL),
(82, '20210629078', 'GROUNDING KIT,UNIVERSAL 1/4\" TO 58\" CABLE', NULL, 1, 1, 1, 1, 0, NULL),
(83, '20210629079', 'REMOTE MOUNT BRACKET ASSEMBLY FOR AOD RADIO', NULL, 1, 1, 1, 1, 0, NULL),
(84, '20210629080', 'AOD RADIO ODU600V2 6GHZ  WAVEGUIDE. UDR 70 FLANGE', NULL, 1, 1, 1, 1, 0, NULL),
(85, '20210629081', 'WAVEGUIDE TO COAX TRANSITION,UDR 70 TO N FAMALE 5.85-8.2 GHZ NO PLANTING ,PAINTED LIGHT GREY,FIXING ', NULL, 1, 1, 1, 1, 0, NULL),
(86, '20210629082', 'FLEXIBEL TWIST FOR WR 137,5,925-7.125GHZ.WITH INTERFACE TYPES PDR70 AND UDR70.900MM(FP5103963)', NULL, 1, 1, 1, 1, 0, NULL),
(87, '20210629083', 'HANGER,DUAL MOUNT HANGER KIT,FORFLEXIBLE  WAVEGUIDE,SIZE WG14/WR137/R70,POLE OR FLAT MOUNT 6GHZ(HK14', NULL, 1, 1, 1, 1, 0, NULL),
(88, '20210629084', 'WIFI DONGLE.USB-POWER (PAU05)', NULL, 1, 1, 1, 1, 0, NULL),
(89, '20210629085', 'LFD4-50A,low density foam coax cable corrugated copper,1/2 in,black pe jacket,per foot', NULL, 1, 1, 1, 1, 0, NULL),
(90, '20210629086', 'N male,ringflare,plated 1/2 in', NULL, 1, 1, 1, 1, 0, NULL),
(91, '20210629087', 'STD Grounding kit for 1/2 in Cor coax cbl and ew180/220', NULL, 1, 1, 1, 1, 0, NULL),
(92, '20210629088', 'MOUNTING ANTENNA FOR ANTENNA DIA.0,9-1,2M WITH BOOM3\"1M', NULL, 1, 1, 1, 1, 0, NULL),
(93, '20210629089', 'MOUNTING ANTENNA FOR ANTENNA DIA.0,9-1,2M WITH BOOM3\"75 CM', NULL, 1, 1, 1, 1, 0, NULL),
(94, '20210629090', 'CABLE KIT,ETHERNET,CAT5E,SHIELDED,24AWG,INDOOR/OUTDOOR,INCLUDES 2XRJ45(M) CONNECTORS UN-INSTALLED 50', NULL, 1, 1, 1, 1, 0, NULL),
(95, '20210629091', 'CABLE KIT,ETHERNET,CAT5E,SHIELDED,24AWG,INDOOR/OUTDOOR,INCLUDES 2XRJ45(M) CONNECTORS UN-INSTALLED 75', NULL, 1, 1, 1, 1, 0, NULL),
(96, '20210629092', 'WAVEGUIDE TO COAX TRANSITION,UDR 70 TO N FAMALE 5.85-8.2 GHZ NO PLANTING ,PAINTED LIGHT GREY,FIXING ', NULL, 1, 1, 1, 1, 0, NULL),
(97, '20210629093', 'HANGER,DUAL MOUNT HANGER KIT,FORFLEXIBLE  WAVEGUIDE,SIZE WG14/WR137/R70,POLE OR FLAT MOUNT 6GHZ(HK14', NULL, 1, 1, 1, 1, 0, NULL),
(98, '20210629094', 'CABLE KIT,ETHERNET,CAT5E,SHIELDED,24AWG,INDOOR/OUTDOOR,INCLUDES 2XRJ45(M) CONNECTORS UN-INSTALLED 50M (164),BLACK(CK-CAT5E-050)', NULL, 2, 1, 1, 1, 1, NULL),
(99, '20210629095', 'CABLE KIT,ETHERNET,CAT5E,SHIELDED,24AWG,INDOOR/OUTDOOR,INCLUDES 2XRJ45(M) CONNECTORS UN-INSTALLED 75M (246),BLACK(CK-CAT5E-075)', NULL, 2, 1, 1, 1, 1, NULL),
(100, '20210629096', 'WAVEGUIDE TO COAX TRANSITION,UDR 70 TO N FAMALE 5.85-8.2 GHZ NO PLANTING ,PAINTED LIGHT GREY,FIXING INCLUDED (CA14LN-N-G-FK)', NULL, 2, 1, 1, 1, 1, NULL),
(101, '20210629097', 'HANGER,DUAL MOUNT HANGER KIT,FORFLEXIBLE  WAVEGUIDE,SIZE WG14/WR137/R70,POLE OR FLAT MOUNT 6GHZ(HK14-DM)', NULL, 2, 1, 1, 1, 1, NULL),
(102, '20210629098', ' N male,ringflare,plated 1/2 in', NULL, 2, 1, 1, 1, 1, NULL),
(103, '20210708001', 'JUNIPE IP RAN', NULL, 2, -0.1, 1, 1, 1, NULL),
(104, '20210713001', '5GHz Rocket AC, Lite', NULL, 2, 1, 1, 1, 1, NULL),
(105, '20210713002', 'Rocket Dish 34dbi With Rocket Kit', NULL, 2, 1, 1, 1, 1, NULL),
(106, '20210813001', '123123123', NULL, 7, 12312, 123, 123, 123, NULL);

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
(1, 'Carton', 'Ctn', '2021-06-08'),
(2, 'Pieces', 'Pcs', NULL),
(3, 'Pack', 'Pack', NULL),
(4, 'Unit', 'Unit', NULL),
(5, 'Set', 'Set', NULL),
(6, 'Meter', 'M', NULL),
(7, 'Block', 'Block', NULL),
(8, '1', '1', NULL);

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
-- Struktur dari tabel `tb_stock_transfer`
--

CREATE TABLE `tb_stock_transfer` (
  `id` int(11) NOT NULL,
  `stock_transfer_no` varchar(25) NOT NULL,
  `stock_transfer_date` date NOT NULL,
  `id_wh_origin` int(11) DEFAULT NULL,
  `id_wh_destination` int(11) DEFAULT NULL,
  `stock_transfer_status` enum('ordered','in_transit','received') NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_stock_transfer`
--

INSERT INTO `tb_stock_transfer` (`id`, `stock_transfer_no`, `stock_transfer_date`, `id_wh_origin`, `id_wh_destination`, `stock_transfer_status`, `id_user`, `deletedate`) VALUES
(2, '20210802ST0002', '2021-08-02', 8, 9, 'received', 2, NULL),
(3, '20210802ST0003', '2021-08-02', 8, 10, 'in_transit', 1, NULL),
(4, '20210802ST0004', '2021-08-02', 8, 8, 'ordered', 1, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stock_transfer_detail`
--

CREATE TABLE `tb_stock_transfer_detail` (
  `id` int(11) NOT NULL,
  `id_stock_transfer` int(11) NOT NULL,
  `id_inbound_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `deletedate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_stock_transfer_detail`
--

INSERT INTO `tb_stock_transfer_detail` (`id`, `id_stock_transfer`, `id_inbound_product`, `qty`, `deletedate`) VALUES
(1, 2, 6, 25, NULL),
(2, 3, 6, 25, NULL),
(3, 4, 6, 5, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_stock_transfer_status`
--

CREATE TABLE `tb_stock_transfer_status` (
  `id_stock_transfer` int(11) NOT NULL,
  `stock_transfer_status` enum('ordered','in_transit','received') NOT NULL,
  `status_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_stock_transfer_status`
--

INSERT INTO `tb_stock_transfer_status` (`id_stock_transfer`, `stock_transfer_status`, `status_date`) VALUES
(2, 'in_transit', '2021-08-04 00:00:00'),
(3, 'in_transit', '2021-08-04 00:00:00');

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
(1, 'STI', NULL),
(2, 'PT. Primadaya Citra Mandiri', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_level` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `name`, `id_level`, `email`, `password`, `status`, `deletedate`) VALUES
(1, 'admin', 'Administrator', 1, 'denny@temans.co.id', '$2y$10$.G1lFx6AloHc/UWsyyzkt.nEIDEWGAoHsbRL/YK17b3Vj0aeWsF/y', '1', NULL),
(2, 'muksin', 'Muksin', 3, 'muksin@temans.co.id', '$2y$10$aA6yrnwJw7M4gm0qypSdXeDbh6X0AQ9jTZA9E4cIW7K7bozS9Ykya', '1', NULL);

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
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warehouse`
--

INSERT INTO `tb_warehouse` (`id`, `code`, `name`, `address`, `latitude`, `longitude`, `deletedate`) VALUES
(8, 'TBG', 'TBG', 'Jl. Sisingamangaraja XII Km. 10,8 Komplek Pergudangan Amplas Trade Center Blok F No. 5, Medan', -6.208713, 106.972272, NULL),
(9, 'MDN', 'MEDAN', 'Jalan Jl. Sisingamangaraja XII Km. 10,8 Komplek Pergudangan Amplas Trade Center Blok F No. 12B, Medan', 3.5361116, 98.7362158, NULL),
(10, 'NJT', 'NISSIN-JKT', 'Jl. Wahab Affan No.4, RT.002/RW.002, Medan Satria, Kecamatan Medan Satria, Kota Bks, Jawa Barat 17132', -6.2091859220935355, 106.97219625493464, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_warehouse_locator`
--

CREATE TABLE `tb_warehouse_locator` (
  `id` int(11) NOT NULL,
  `id_warehouse` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `deletedate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_warehouse_locator`
--

INSERT INTO `tb_warehouse_locator` (`id`, `id_warehouse`, `name`, `deletedate`) VALUES
(1, 8, 'A1', NULL),
(2, 8, 'A2', NULL),
(3, 8, 'A3', NULL),
(4, 8, 'A4', NULL),
(5, 9, 'AB1', NULL),
(6, 9, 'AB2', NULL),
(7, 10, 'B31', NULL),
(8, 10, 'A21', NULL);

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
(8, 2),
(9, 1),
(10, 1);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mot` (`id_mot`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_warehouse` (`id_warehouse`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_stock_transfer` (`id_stock_transfer`);

--
-- Indeks untuk tabel `tb_inbound_product`
--
ALTER TABLE `tb_inbound_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inbound` (`id_inbound`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_locator` (`id_locator`),
  ADD KEY `id_product_status` (`id_product_status`);

--
-- Indeks untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_warehouse` (`id_warehouse`),
  ADD KEY `id_mot` (`id_mot`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `status_outbound` (`status_outbound`);

--
-- Indeks untuk tabel `tb_outbound_product`
--
ALTER TABLE `tb_outbound_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_outbound` (`id_outbound`),
  ADD KEY `id_inbound_product` (`id_inbound_product`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_status_outbound`
--
ALTER TABLE `tb_status_outbound`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_stock_transfer`
--
ALTER TABLE `tb_stock_transfer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_transfer_no` (`stock_transfer_no`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_wh_destination` (`id_wh_destination`),
  ADD KEY `id_wh_origin` (`id_wh_origin`);

--
-- Indeks untuk tabel `tb_stock_transfer_detail`
--
ALTER TABLE `tb_stock_transfer_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_stock_transfer` (`id_stock_transfer`),
  ADD KEY `id_inbound_product` (`id_inbound_product`);

--
-- Indeks untuk tabel `tb_stock_transfer_status`
--
ALTER TABLE `tb_stock_transfer_status`
  ADD PRIMARY KEY (`id_stock_transfer`,`stock_transfer_status`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indeks untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_warehouse` (`id_warehouse`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_inbound`
--
ALTER TABLE `tb_inbound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_inbound_product`
--
ALTER TABLE `tb_inbound_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_mot`
--
ALTER TABLE `tb_mot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_outbound`
--
ALTER TABLE `tb_outbound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_outbound_product`
--
ALTER TABLE `tb_outbound_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `tb_product_status`
--
ALTER TABLE `tb_product_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_product_uom`
--
ALTER TABLE `tb_product_uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_status_outbound`
--
ALTER TABLE `tb_status_outbound`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_stock_transfer`
--
ALTER TABLE `tb_stock_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_stock_transfer_detail`
--
ALTER TABLE `tb_stock_transfer_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_user_level`
--
ALTER TABLE `tb_user_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse`
--
ALTER TABLE `tb_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_inbound`
--
ALTER TABLE `tb_inbound`
  ADD CONSTRAINT `tb_inbound_ibfk_1` FOREIGN KEY (`id_mot`) REFERENCES `tb_mot` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_inbound_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `tb_supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_inbound_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_inbound_ibfk_4` FOREIGN KEY (`id_warehouse`) REFERENCES `tb_warehouse` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_inbound_ibfk_5` FOREIGN KEY (`id_stock_transfer`) REFERENCES `tb_stock_transfer` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tb_inbound_product`
--
ALTER TABLE `tb_inbound_product`
  ADD CONSTRAINT `tb_inbound_product_ibfk_1` FOREIGN KEY (`id_inbound`) REFERENCES `tb_inbound` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_inbound_product_ibfk_2` FOREIGN KEY (`id_locator`) REFERENCES `tb_warehouse_locator` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_inbound_product_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `tb_product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_inbound_product_ibfk_4` FOREIGN KEY (`id_product_status`) REFERENCES `tb_product_status` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_outbound`
--
ALTER TABLE `tb_outbound`
  ADD CONSTRAINT `tb_outbound_ibfk_1` FOREIGN KEY (`id_mot`) REFERENCES `tb_mot` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_outbound_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_outbound_ibfk_3` FOREIGN KEY (`id_warehouse`) REFERENCES `tb_warehouse` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_outbound_ibfk_4` FOREIGN KEY (`status_outbound`) REFERENCES `tb_status_outbound` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_stock_transfer`
--
ALTER TABLE `tb_stock_transfer`
  ADD CONSTRAINT `tb_stock_transfer_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_stock_transfer_ibfk_2` FOREIGN KEY (`id_wh_destination`) REFERENCES `tb_warehouse` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_stock_transfer_ibfk_3` FOREIGN KEY (`id_wh_origin`) REFERENCES `tb_warehouse` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_stock_transfer_detail`
--
ALTER TABLE `tb_stock_transfer_detail`
  ADD CONSTRAINT `tb_stock_transfer_detail_ibfk_1` FOREIGN KEY (`id_stock_transfer`) REFERENCES `tb_stock_transfer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_stock_transfer_detail_ibfk_2` FOREIGN KEY (`id_inbound_product`) REFERENCES `tb_inbound_product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `tb_user_level` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_warehouse_locator`
--
ALTER TABLE `tb_warehouse_locator`
  ADD CONSTRAINT `tb_warehouse_locator_ibfk_1` FOREIGN KEY (`id_warehouse`) REFERENCES `tb_warehouse` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
