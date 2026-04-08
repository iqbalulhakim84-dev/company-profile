-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2025 at 06:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl_lpkii`
--

-- --------------------------------------------------------

--
-- Table structure for table `ajuan_sertifikat`
--

CREATE TABLE `ajuan_sertifikat` (
  `id_ajuan` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `program` enum('privat','reguler_materi','reguler_paket') DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `status` enum('Proses','Selesai','Ditolak') DEFAULT 'Proses',
  `tanggal_pengajuan` datetime NOT NULL DEFAULT current_timestamp(),
  `approved_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id_alumni` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `no_induk` varchar(225) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `program` enum('privat','reguler_materi','reguler_paket') DEFAULT NULL,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `no_sertifikat` int(11) DEFAULT NULL,
  `no_ujian` int(11) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `tanggal_lulus` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id_alumni`, `id_peserta`, `no_induk`, `nama_lengkap`, `tanggal_lahir`, `program`, `nama_jurusan`, `id_jurusan`, `no_sertifikat`, `no_ujian`, `tanggal_daftar`, `tanggal_lulus`) VALUES
(20, NULL, '04244047', 'Isnaeni Nurrohmah', '2000-12-30', 'reguler_paket', '', 22, 8619, 43252, NULL, '2025-04-12'),
(21, NULL, '4243920', 'Rizki Gilang Ramadan', '1999-12-29', '', '', 25, 8546, 43132, NULL, '2024-08-19'),
(22, NULL, '04233799', 'Asti Astuti Indah Cahyani', '1998-08-04', 'reguler_paket', '', 20, 8530, 43003, NULL, '2023-09-26'),
(26, NULL, '4244010', 'Siti Refa Nurjanah', '2002-12-15', 'reguler_paket', '', 22, 8638, 43213, '0000-00-00', '2025-08-27'),
(27, NULL, '04233693', 'Febri Moch Ridwan', '1997-03-09', 'reguler_paket', '', 21, 8495, 42937, '0000-00-00', '2023-08-03'),
(28, NULL, '04254103', 'Frem Harly Setiady', '2004-05-02', 'reguler_paket', '', 29, 8639, 43313, NULL, '2025-07-08'),
(29, NULL, '04223678', 'Evangelista Amabelle Kardin', '2009-06-03', 'reguler_paket', '', 23, 8487, 42923, NULL, '2023-06-10'),
(30, NULL, '04233720', 'Abyan Dzakwan', '2004-01-11', 'reguler_paket', '', 20, 8510, 42964, NULL, '2023-08-30'),
(32, NULL, '04233792', 'Dian Nofiana', '2004-10-11', 'reguler_paket', '', 20, 8535, 40322, NULL, '2023-10-02'),
(33, NULL, '04233732', 'Clara Talitha', '2005-02-02', 'reguler_paket', '', 20, 8505, 42973, NULL, '2023-06-27'),
(34, NULL, '04233651', 'Ignasius Rahandity', '2002-06-11', '', '', 0, 8508, 42925, '0000-00-00', '2023-08-30'),
(35, NULL, '04233724', 'Erlangga Putra Kosasih', '2005-04-15', 'reguler_paket', '', 21, 8467, 42968, '0000-00-00', '2024-01-20'),
(36, NULL, '04254079', 'Muhammad Yudho Pratomo', '1999-09-28', 'reguler_paket', '', 21, 8635, 43265, NULL, '2025-08-14'),
(37, NULL, '4233799', 'Yolla Vivi Oktaviani', '2000-10-16', '', '', 20, 8474, 43050, '0000-00-00', '2024-02-05'),
(38, NULL, '04233706', 'Bagas Satria Putra', '2005-06-04', 'reguler_paket', '', 20, 8496, 42950, NULL, '2023-08-03'),
(39, NULL, '04243940', 'Ridwan Maulana Iskandar', '2006-02-18', 'reguler_paket', '', 21, 8601, 43210, '0000-00-00', '2024-12-31'),
(40, NULL, '04182116', 'Asep Ridwan Natapriatna', '2000-07-12', '', 'Instalia Jaringan Komputer', 0, 8556, 42286, NULL, '2024-08-20'),
(41, NULL, '04243983', 'Ananda Eliana Putri ', '2010-08-19', '', 'Program Profesional', 0, 8609, 43186, NULL, '2025-03-10'),
(42, NULL, '04243954', 'Rahel Sipahutar', '1997-10-07', 'reguler_paket', '', 20, 8603, 43162, '0000-00-00', '2025-01-20'),
(43, NULL, '4243977', 'RIzki Hardiansyah Nugraha', '2005-08-13', 'reguler_paket', '', 21, 8583, 43188, NULL, '2024-11-25'),
(44, NULL, '094233830', 'Leny Rusliani', '1998-07-01', '', '', 0, 8518, 43078, '0000-00-00', '2024-05-03'),
(45, NULL, '4243930', 'Vilia Almaida Hanifa', '2000-06-16', 'reguler_paket', '', 20, 8584, 43168, NULL, '2024-11-25'),
(46, NULL, '04233802', 'Nisrina Ashriyah', '1999-11-01', '', '', 0, 8468, 43029, NULL, '2024-01-20'),
(47, NULL, '04233758', 'Naida Nurfadilah', '2004-06-22', '', '', 0, 8534, 42987, '0000-00-00', '2024-07-23'),
(49, NULL, '04243917', 'Marjo', '1985-08-09', 'reguler_paket', '', 21, 8640, 43011, '0000-00-00', '2025-09-22'),
(50, NULL, '04223689', 'Alfanni Nabila Nurdini', '2001-05-18', 'reguler_paket', '', 20, 8481, 42934, NULL, '2023-05-24'),
(51, NULL, '04233747', 'Ahmad Mukhlas Pauzi', '2005-08-13', '', 'Program Profesional', 0, 8459, 42976, '0000-00-00', '2024-01-03'),
(52, NULL, '04233709', 'Alivia Azzahra Juanda', '2003-09-15', 'reguler_paket', '', 20, 8537, 402953, NULL, '2023-10-14'),
(53, NULL, '4233745', 'Syifa Agnia Jaediwa', '2004-08-01', '', '', 21, 8456, 42974, '0000-00-00', '2023-12-04'),
(54, NULL, '04254116', 'Farha Nabila Dekha', '2005-09-03', 'reguler_paket', '', 21, 8649, 43321, NULL, '2025-09-19'),
(55, NULL, '04244001', 'Vania Nayunda Hernindya', '2000-02-14', 'reguler_paket', '', 18, 8597, 43208, '0000-00-00', '2024-12-31'),
(56, NULL, '4254083', 'Muh. Asyroful Anggoro Putra', '2002-02-05', 'reguler_paket', '', 20, 8644, 43267, NULL, '2025-09-20'),
(57, NULL, '04233792', 'Mahasti Zafira Wiandita', '1998-03-16', '', '', 0, 8472, 42971, NULL, '2024-02-05'),
(58, NULL, '4244009', 'Siti Alya Nurfazrin', '1998-05-15', 'reguler_paket', '', 18, 8569, 43212, '0000-00-00', '2024-10-07'),
(59, NULL, '4233847', 'Risa', '1995-02-10', '', '', 18, 8500, 43034, NULL, '2024-04-17'),
(60, NULL, '4243881', 'Rival Rinaldi', '1997-11-03', '', '', 18, 8516, 43094, '0000-00-00', '2024-05-24'),
(61, NULL, '04258610', 'Joshua Fernando Miracle Hadijaya', '2001-11-01', 'reguler_materi', '', 6, 8609, 43186, NULL, '2025-03-10'),
(62, NULL, '4213640', 'Hurul Aini Rahayu', '2003-04-12', 'reguler_paket', '', 18, 6474, 42888, NULL, '2023-05-02'),
(63, NULL, '4244051', 'Siti Solihat', '2004-09-03', 'reguler_paket', '', 21, 8626, 43256, NULL, '2025-05-05'),
(64, NULL, '04233754', 'Amanda Azzahra', '2005-08-16', '', '', 0, 8516, 42995, '0000-00-00', '2023-09-09'),
(66, NULL, '04244016', 'Noor Tasya Shinta', '2006-02-18', 'reguler_paket', '', 20, 8613, 43219, '0000-00-00', '2025-03-10'),
(67, NULL, '4243988', 'Syech Abdurrahman', '2006-02-02', 'reguler_paket', '', 21, 8595, 43201, NULL, '2024-12-31'),
(68, NULL, '04243952', 'Christine Nurmelia Aritonang', '2005-10-23', 'reguler_paket', '', 20, 8605, 43195, '0000-00-00', '2025-01-20'),
(69, NULL, '04233836', 'Ira Siti Nurfitriani', '2002-01-07', '', '', 0, 8502, 43027, '0000-00-00', '2024-04-17'),
(70, NULL, '04233864', 'Riezky Ardyansyah Pratama', '2004-05-12', '', '', 0, 8477, 43028, NULL, '2024-02-05'),
(71, NULL, '04233688', 'Diana Tendora Juniani', '2004-06-17', 'reguler_paket', '', 20, 8482, 42932, '0000-00-00', '2023-06-10'),
(72, NULL, '4243923', 'Sukma Ayu Wulandari', '2003-04-10', '', '', 18, 8539, 43075, NULL, '2024-07-23'),
(73, NULL, '4233805', 'Aden Ahmad Suardi', '2001-10-27', 'reguler_paket', '', 24, 8491, 43055, NULL, '2024-03-28'),
(74, NULL, '04233759', 'Armelia Cantika Putri Kirana', '2005-06-09', '', 'Program Profesional', 0, 8521, 52988, NULL, '2024-06-04'),
(75, NULL, '4233817', 'Yasmien Muallifa', '2004-12-19', '', '', 21, 8557, 43063, NULL, '2024-09-23'),
(76, NULL, '04233760', 'Anisah Shofya Rahmawati', '2004-08-01', 'reguler_paket', '', 18, 8532, 42997, NULL, '2023-10-02'),
(77, NULL, '04233712', 'Andrian Maulana Putra', '2003-06-14', '', 'Program Profesional', 0, 8458, 42956, NULL, '2024-01-03'),
(78, NULL, '040233705', 'Deni Ahmad Naufal', '1997-07-06', '', 'Program Profesional', 0, 8504, 42949, '0000-00-00', '2023-08-30'),
(79, NULL, '04233854', 'Fachrighani Al Manfaluty', '1997-08-10', '', 'Microsoft Office Plus', 0, 8463, 43039, '0000-00-00', '2024-01-11'),
(80, NULL, '04233694', 'Agni Fauziah', '1995-06-04', '', 'Program Profesional', 0, 8491, 42938, NULL, '2023-06-15'),
(81, NULL, '04233608', 'Nopia Sapitri', '2005-10-31', '', '', 0, 8510, 42942, '0000-00-00', '2023-09-09'),
(82, NULL, '4243980', 'Talitha Najwa Maulida', '2003-04-27', 'reguler_paket', '', 20, 8591, 43183, NULL, '2024-12-31'),
(83, NULL, '04233777', 'Muhammad Mi\'raj Restu Nugraha', '2002-09-21', '', '', 0, 8517, 42996, '0000-00-00', '2023-09-09'),
(84, NULL, '4243993', 'Wafda Amelnintya Sujiantari', '2001-01-08', 'reguler_paket', '', 20, 8576, 43196, '0000-00-00', '2024-10-30'),
(86, NULL, '04223661', 'Diani Putri Ayu', '2005-10-18', '', 'Microsoft Office Plus', 0, 8492, 42908, '0000-00-00', '2023-06-15'),
(88, NULL, '4243863', 'Salsabila Arie Sophia', '2002-03-02', '', '', 20, 8486, 43088, '0000-00-00', '2024-03-05'),
(89, NULL, '04243910', 'Dewi Cahyati', '1999-11-09', 'reguler_paket', '', 20, 8517, 43130, '0000-00-00', '2024-05-30'),
(90, NULL, '04243955', 'Amelia Hendi', '2006-08-21', '', 'Program Profesional', 0, 8576, 43163, '0000-00-00', '2024-10-30'),
(91, NULL, '04243882', 'Isna Nurjanah', '1999-08-26', '', '', 0, 8511, 43097, '0000-00-00', '2024-05-24'),
(92, NULL, '04233843', 'Fajrul Ashfiya Rizkiawan', '2002-12-19', 'reguler_paket', '', 21, 8528, 43032, '0000-00-00', '2024-06-24'),
(93, NULL, '4248614', 'Zalfa Nurul Imma', '2006-02-18', 'reguler_paket', '', 21, 8614, 43137, '0000-00-00', '2025-03-10'),
(94, NULL, '04233729', 'Carlos Damelo Silalahi', '2004-12-25', '', 'Microsoft Office Plus', 0, 8498, 42989, '0000-00-00', '2023-08-08'),
(95, NULL, '04223635', 'Muh. Fathurrahman', '2002-03-20', 'reguler_paket', '', 20, 8585, 42735, '0000-00-00', '2024-12-03'),
(96, NULL, '4254074', 'Sherly Nurdena Putri', '2006-05-11', 'reguler_paket', '', 28, 8647, 432777, NULL, '2025-09-18'),
(97, NULL, '04243886', 'Atika Amaria', '2005-12-01', '', 'Microsoft Office Plus', 0, 8509, 43101, '0000-00-00', '2024-05-03'),
(98, NULL, '04233751', 'Bunga Dwi Lestari', '2005-02-20', '', 'Program Profesional', 0, 8475, 42980, '0000-00-00', '2024-02-05'),
(99, NULL, '4223680', 'Rosita', '1999-09-18', 'reguler_paket', '', 21, 8483, 42924, '0000-00-00', '2023-06-10'),
(100, NULL, '04233707', 'Nanda Rizki Amalia', '2001-01-31', 'reguler_paket', '', 20, 8533, 42951, '0000-00-00', '2023-10-02'),
(101, NULL, '4233867', 'Ummu Salamah', '2004-07-22', '', '', 21, 8531, 43080, '0000-00-00', '2024-06-24'),
(102, NULL, '04223686', 'Fadly Ridzki Kurniawan', '1997-06-26', 'reguler_paket', '', 20, 8479, 42930, '0000-00-00', '2023-05-24'),
(103, NULL, '42223609', 'Syafiq Adwinandan', '2004-12-03', '', '', 33, 8378, 42859, '0000-00-00', '2023-08-15'),
(104, NULL, '4243866', 'Tania Shabila', '1996-02-03', '', '', 20, 3488, 42987, '0000-00-00', '2024-03-05'),
(106, NULL, '04248612', 'Ira Maudina', '2003-05-07', 'reguler_paket', '', 20, 8009, 43186, NULL, '2025-03-10'),
(107, NULL, '04223673', 'Penty Marliantin Nurhasanah', '2002-01-25', 'reguler_paket', '', 18, 6478, 42919, NULL, '2023-05-02'),
(108, NULL, '04243802', 'Afrina Ansyarulani Tuhu', '2001-04-28', '', '', 0, 8542, 43108, NULL, '2024-08-19'),
(109, NULL, '04243915', 'Ayu Mustika Lestari', '2002-05-10', 'reguler_paket', '', 20, 8532, 43127, NULL, '2024-07-23'),
(110, NULL, '4233733', 'Sandra Oktaviani', '2000-10-09', '', '', 18, 8512, 42992, NULL, '2023-09-09'),
(111, NULL, '04233824', 'Pratama Putra Wijaya', '2000-04-10', '', '', 0, 8483, 43072, NULL, '2024-03-05'),
(112, NULL, '4243963', 'Tifani Ayu Ramadhani', '2005-10-26', 'reguler_paket', '', 21, 8580, 43171, NULL, '2024-10-30'),
(113, NULL, '04243936', 'Moch Azka Maulana Akbar ', '2005-09-26', 'reguler_paket', '', 25, 8571, 43146, NULL, '2024-10-30'),
(115, NULL, '04243794', 'Neng Adila Saskia Mutiara', '2006-12-18', '', '', 0, 8503, 43064, NULL, '2024-05-03'),
(116, NULL, '4233791', 'Yuyun Windarsih', '1989-04-28', 'reguler_paket', '', 18, 8534, 43021, NULL, '2023-10-02'),
(117, NULL, '04243887', 'Asty Fauziah Hermawati', '2004-09-02', 'reguler_paket', '', 20, 8536, 43102, NULL, '2024-07-23'),
(118, NULL, '42233701', 'Rosshinta Nurjanah', '1990-07-29', 'reguler_paket', '', 33, 8522, 42943, NULL, '2023-09-26'),
(120, NULL, '4223500', 'Senja Ananda Budiman', '2002-03-15', 'reguler_paket', '', 18, 8414, 42809, NULL, '2022-07-11'),
(121, NULL, '04254121', 'Hanif Firman Alamsyah', '2002-01-24', 'reguler_paket', '', 24, 8643, 43326, NULL, '2025-09-20'),
(122, NULL, '4243924', 'Sherlin Cyndina', '2001-04-07', '', '', 20, 8547, 43135, NULL, '2024-08-19'),
(123, NULL, '4243957', 'Riska Fitriah', '2005-02-17', 'reguler_paket', '', 21, 8590, 43165, NULL, '2024-12-26'),
(124, NULL, '04243970', 'Geby Tesalonika', '2000-09-02', '', '', 0, 8554, 43207, NULL, '2024-08-20'),
(125, NULL, '04243972', 'Dyangga Priambudi', '1997-06-19', '', 'Microsoft Office Plus', 0, 8565, 43175, NULL, '2024-09-27'),
(127, NULL, '4243012', 'Yonan Maulana', '1998-07-04', 'reguler_paket', '', 24, 8579, 43215, NULL, '2024-10-30'),
(128, NULL, '4233728', 'Tarisa', '2003-12-02', 'reguler_paket', '', 20, 8527, 42970, NULL, '2023-09-26'),
(129, NULL, '04243888', 'Nasywa Azzahra Khairiyah', '2006-02-19', '', '', 0, 8541, 43103, NULL, '2024-08-19'),
(130, NULL, '4233723', 'Yuni Ambarwati', '1999-06-28', 'reguler_paket', '', 20, 8507, 42967, NULL, '2023-08-30'),
(131, NULL, '04243981', 'Dylveka Desta Kusmaulya', '2004-12-10', '', 'Program Profesional', 0, 8588, 43184, NULL, '2024-12-26'),
(132, NULL, '04244043', 'Azka Utami Azizah', '2002-12-16', '', 'Microsoft Office Plus', 0, 8622, 43248, NULL, '2025-05-05'),
(133, NULL, '04244017', 'Aulia Putri Nugraha', '2006-01-27', 'reguler_paket', '', 20, 8606, 43219, NULL, '2025-01-20'),
(134, NULL, '04244035', 'Ina Zaelani ', '2005-06-24', '', '', 0, 8620, 53238, NULL, '2024-02-05'),
(135, NULL, '04254097', 'Nabiel Rahmahadiastajati Lazuardi', '1999-11-12', 'reguler_materi', '', 2, 8637, 43301, NULL, '2025-08-15'),
(136, NULL, '04243985', 'Fadhitya Ragasta', '1996-09-10', 'reguler_paket', '', 34, 8581, 43189, NULL, '2024-10-25'),
(137, NULL, '04233821', 'Novi Fitriyani', '2003-11-25', '', '', 0, 8515, 43069, NULL, '2024-05-24'),
(138, NULL, '4233721', 'Zidan Aulia Utama', '2005-06-23', 'reguler_paket', '', 18, 8536, 402972, NULL, '2023-10-14'),
(139, NULL, '04243944', 'Evita Elfriyani Tarigan', '2010-10-21', 'reguler_paket', '', 21, 8596, 43155, NULL, '2024-12-31'),
(140, NULL, '4233820', 'Shinta Febianti Triana', '1980-02-08', '', '', 24, 8493, 43068, NULL, '2024-03-28'),
(141, NULL, '04233691', 'Nazwa Fatia Ivanka', '2004-10-16', '', '', 0, 8490, 42935, NULL, '2023-06-15'),
(142, NULL, '04233785', 'Dwi Putra Wahyu Kusuma', '1990-11-10', '', 'Microsoft Office Plus', 0, 8524, 43020, NULL, '2023-09-26'),
(143, NULL, '04233746', 'Ahmad Naufal Yusatama', '1999-04-17', '', 'Microsoft Office Plus', 0, 8461, 42975, NULL, '2024-01-03'),
(144, NULL, '04233786', 'Edo Pranata', '1997-01-14', '', 'Microsoft Office Plus', 0, 8525, 43018, NULL, '2023-09-26'),
(145, NULL, '4233807', 'Moch. Alief Mahardhika S', '2002-04-11', '', '', 21, 8543, 43056, NULL, '2024-08-19'),
(146, NULL, '04233722', 'Cici Pitri Yani', '2004-11-16', 'reguler_paket', '', 20, 8498, 42966, NULL, '2024-04-17'),
(147, NULL, '04243895', 'Faishal Saefulloh', '1999-03-31', '', '', 0, 8518, 43111, NULL, '2024-05-30'),
(148, NULL, '4244053', 'Shiddiq Permana Ramadhan', '2006-09-30', 'reguler_paket', '', 18, 8621, 43239, NULL, '2025-05-05'),
(149, NULL, '04233789', 'Abdul Somad', '1994-08-30', '', 'Microsoft Office Plus', 0, 8531, 43019, NULL, '2023-02-10'),
(151, NULL, '04233855', 'Muhammad Rivaldi', '2002-08-14', '', '', 0, 8479, 43040, NULL, '2024-03-05'),
(152, NULL, '4243885', 'Ruby Khairul Iman', '2002-01-16', '', '', 25, 2550, 43139, NULL, '2024-08-19'),
(153, NULL, '4243942', 'Syifa Azaria Maulida', '2001-04-27', 'reguler_paket', '', 20, 8057, 43153, NULL, '2024-10-07'),
(154, NULL, '4233806', 'Melani Sinaga', '1998-02-16', '', '', 18, 8509, 43112, NULL, '2024-05-03'),
(155, NULL, '04223717', 'Amaliya', '2003-04-16', '', 'Program Profesional', 0, 8453, 42961, NULL, '2023-12-04'),
(156, NULL, '4244007', 'Sandi Nugraha', '1997-07-09', 'reguler_paket', '', 21, 8608, 43211, NULL, '2025-02-03'),
(157, NULL, '04243381', 'Febby Afriani', '1998-04-23', 'reguler_paket', '', 21, 8556, 43117, NULL, '2024-09-23'),
(158, NULL, '04243943', 'Hasanah Aulya', '2006-05-08', 'reguler_paket', '', 21, 8577, 43134, NULL, '2024-12-15'),
(159, NULL, '04233754', 'Indah Purnama Sari', '2004-04-19', '', '', 0, 8510, 42983, NULL, '2024-05-03'),
(160, NULL, '04243865', 'Redy Oktory', '2000-10-11', '', '', 0, 8485, 43096, NULL, '2024-03-05'),
(161, NULL, '4233850', 'Sarah Maria Rosina Belwawin', '2006-08-08', '', '', 21, 8519, 43046, NULL, '2024-06-04'),
(162, NULL, '4233801', 'Mila Amelia', '2000-06-27', '', '', 20, 8522, 43051, NULL, '2024-06-04'),
(163, NULL, '04233748', 'Helan Ahmad Fahrozan', '2004-08-22', '', '', 0, 8469, 43029, NULL, '2024-01-20'),
(164, NULL, '4243020', 'Zahra Meyla Putri', '2005-05-25', 'reguler_paket', '', 21, 8633, 43222, NULL, '2025-07-02'),
(165, NULL, '4233696', 'Siti Nurlela Astuti', '2004-05-24', '', '', 20, 8497, 42940, NULL, '2023-08-08'),
(166, NULL, '04243897', 'Jesica Sinaga', '2003-08-13', '', '', 0, 8530, 43113, NULL, '2024-06-24'),
(167, NULL, '04243928', 'Dio Valka Ramadhan', '2003-10-28', '', 'Program Profesional', 0, 8631, 43229, NULL, '2025-07-02'),
(168, NULL, '04233719', 'Nofita Kristiana ', '2004-11-19', '', '', 0, 8528, 42963, NULL, '2023-09-26'),
(169, NULL, '4233810', 'Sindi Nabila', '2004-09-02', '', '', 20, 8513, 43058, NULL, '2024-05-24'),
(170, NULL, '4233856', 'Rizky Khairunisa', '2005-05-08', '', '', 20, 8478, 43041, NULL, '2024-02-05'),
(171, NULL, '4233783', 'Syifa Nur Aulia', '2005-08-08', 'reguler_paket', '', 18, 8536, 402972, NULL, '2023-10-14'),
(172, NULL, '04244030', 'Adila Putry Rahayu', '2006-07-15', '', 'Program Profesional', 0, 8615, 43234, NULL, '2025-04-12'),
(173, NULL, '4233713', 'Yustiana Sri Damayanti', '2005-06-13', 'reguler_paket', '', 22, 8540, 42954, NULL, '2023-11-15'),
(174, NULL, '04233731', 'Anggitha Primada Kurniawan', '2005-05-07', '', 'Microsoft Office Plus', 0, 8503, 42991, NULL, '2023-08-30'),
(175, NULL, '04233766', 'Fitri Desianty', '2003-12-05', '', '', 0, 8462, 43001, NULL, '2024-01-11'),
(176, NULL, '04223633', 'Mughni Naufal Aqil', '2003-11-26', 'reguler_paket', '', 20, 8468, 42881, NULL, '2023-02-22'),
(177, NULL, '04233868', 'Ratu Evita Nova Damayanti', '2004-10-01', '', '', 0, 8525, 43081, NULL, '2024-06-24'),
(178, NULL, '4233767', 'Riska Robani Oktaviana', '2003-10-29', '', '', 20, 8460, 43002, NULL, '2024-01-03'),
(179, NULL, '04233735', 'Nabyla Desvia Asmara', '2004-12-04', '', '', 0, 8514, 42993, NULL, '2023-09-09'),
(180, NULL, '04233749', 'Dewi Wahyuni', '2003-01-18', '', 'Program Profesional', 0, 8454, 42978, NULL, '2023-12-04'),
(182, NULL, '4244021', 'Siska Meydianti', '1998-05-05', 'reguler_paket', '', 18, 8607, 43223, NULL, '2025-01-20'),
(183, NULL, '4242891', 'Windya Ayu Nurhaliza', '1998-06-15', 'reguler_paket', '', 18, 8569, 43107, NULL, '2024-10-07'),
(184, NULL, '04233763', 'Putri Awalia', '2004-10-10', '', '', 0, 8490, 43000, NULL, '2024-03-28'),
(185, NULL, '04233778', 'Giska Erfyanti', '2004-12-01', '', '', 0, 8519, 43014, NULL, '2023-09-09'),
(186, NULL, '04232750', 'Rahma Futri S Wiguna', '2004-07-27', '', '', 0, 8480, 42979, NULL, '2024-03-05'),
(187, NULL, '4233699', 'Vira Alfianti Ningtyas, SH', '2000-07-14', 'reguler_paket', '', 18, 8488, 42947, NULL, '2023-06-10'),
(188, NULL, '04233736', 'Aulia Datya Ryzky Valiza', '2005-06-01', 'reguler_paket', '', 20, 8514, 42993, NULL, '2023-09-09'),
(189, NULL, '04243959', 'Fina Mega Widianti', '2006-06-16', 'reguler_paket', '', 20, 8586, 43167, NULL, '2024-12-03'),
(190, NULL, '04243951', 'Karina Rizki Sukma Purnamasari', '2001-04-05', '', '', 0, 8561, 43160, NULL, '2024-09-23'),
(191, NULL, '4243956', 'Melinda Dwi Sabrina', '2004-09-24', 'reguler_paket', '', 21, 8589, 43164, NULL, '2024-12-26'),
(192, NULL, '04254087', 'Raisah Cantik Jelita', '2009-05-26', 'reguler_paket', '', 24, 8643, 43291, NULL, '2025-09-22'),
(194, NULL, '0424335', 'Muhammad Lutfi Dzulfiqar', '2003-12-07', 'reguler_paket', '', 25, 8572, 43147, NULL, '2024-10-30'),
(195, NULL, '4243929', 'Shandy Haris Syahputra ', '2003-08-01', '', '', 21, 8554, 43140, NULL, '2024-08-20'),
(196, NULL, '04233692', 'Charen Riyan Putri', '2000-11-14', '', 'Microsoft Office Plus', 0, 8493, 42936, NULL, '2023-06-24'),
(197, NULL, '04245874', 'Aprilina Anazmi', '2003-04-18', '', 'Microsoft Office Plus', 0, 8494, 43087, NULL, '2024-03-28'),
(198, NULL, '4243930', 'Miftah Syauqi ', '2004-11-11', 'reguler_paket', '', 21, 8573, 43141, NULL, '2024-10-30'),
(199, NULL, '4223669', 'Tiara Rosalia', '2001-12-21', '', '', 18, 8506, 42915, NULL, '2023-08-14'),
(200, NULL, '420307', 'Siti Zahra Revana Silki', '2006-04-17', '', '', 20, 8549, 43148, NULL, '2024-08-19'),
(201, NULL, '04233784', 'Dewi Puspita Maharani', '2002-06-16', 'reguler_paket', '', 20, 8485, 43794, NULL, '2024-03-05'),
(202, NULL, '04248611', 'Muhammad Al Ghifari Junaedi', '2006-03-30', 'reguler_paket', '', 25, 8609, 43186, NULL, '2025-03-10'),
(203, NULL, '04243986', 'Jossua Silaban ', '2006-01-30', '', '', 0, 8540, 43121, NULL, '2024-07-23'),
(204, NULL, '4233798', 'Salsabila Anggita Rani', '2005-03-29', '', '', 21, 8465, 43049, NULL, '2024-01-11'),
(205, NULL, '4233775', 'Widya Melani ', '2005-07-27', '', '', 20, 8466, 43008, NULL, '2024-01-20'),
(206, NULL, '04233650', 'Farah Andina', '2005-06-03', 'reguler_paket', '', 20, 8523, 42897, NULL, '2023-09-26'),
(207, NULL, '4243922', 'Siti Anjani', '2001-01-11', '', '', 20, 8538, 43134, NULL, '2024-07-23'),
(208, NULL, '4243989', 'Virgilia ', '2006-03-11', 'reguler_paket', '', 20, 8582, 43192, NULL, '2024-11-25'),
(209, NULL, '4233704', 'Rifal Riansyah', '2005-05-05', '', '', 20, 8502, 429446, NULL, '2023-08-21'),
(210, NULL, '4243994', 'Tifany Alizza Putri S', '2015-02-16', 'reguler_paket', '', 18, 8570, 43197, NULL, '2024-10-07'),
(211, NULL, '04244006', 'Abu Dzar Al Ghifari ', '2000-08-06', 'reguler_paket', '', 20, 8601, 43210, NULL, '2024-12-31'),
(212, NULL, '04233811', 'Andra Fauzi Aulia ', '2003-02-13', '', 'Microsoft Office Plus', 0, 8482, 43059, NULL, '2024-03-05'),
(213, NULL, '04233823', 'Muhammad Zulfan Maulana', '2004-07-01', '', '', 0, 8492, 43071, NULL, '2024-03-28'),
(214, NULL, '04223608', 'Fajri Juan Al Fiqri Rusdiansyah', '2004-06-19', 'reguler_paket', '', 33, 6474, 42856, NULL, '2023-04-03'),
(215, NULL, '04233727', 'Muhammad Idris Purnama Setiawan', '2008-05-22', '', '', 0, 8531, 42969, NULL, '2023-09-26'),
(216, NULL, '04233873', 'Dini', '2002-08-08', '', 'Microsoft Office Plus', 0, 8506, 43086, NULL, '2024-05-03'),
(217, NULL, '423700', 'Riki Muhammad Firdaus', '2000-04-14', 'reguler_paket', '', 18, 8489, 42950, NULL, '2023-06-10'),
(218, NULL, '04244013', 'Ricky Saputra', '2004-05-06', 'reguler_paket', '', 21, 8604, 43216, NULL, '2025-02-03'),
(219, NULL, '04243984', 'Ardi Febriansyah Nugraha ', '2005-02-03', '', 'Program Profesional', 0, 8598, 43187, NULL, '2024-12-31'),
(220, NULL, '04243879', 'Adi Luthfiyanto Budiman', '2003-03-15', '', 'Microsoft Office Plus', 0, 8523, 43092, NULL, '2024-06-24'),
(221, NULL, '042223648', 'Maulana ', '2002-05-21', '', '', 0, 8377, 42858, NULL, '2024-05-08'),
(222, NULL, '04233756', 'Gina Sintia Sari', '2005-06-22', 'reguler_paket', '', 21, 8455, 42985, NULL, '2023-12-04'),
(223, NULL, '04233770', 'Henti Ratna Sari ', '1997-09-27', '', '', 0, 4529, 43004, NULL, '2023-09-26'),
(224, NULL, '04233781', 'Ai Ripa', '2000-10-01', '', 'Microsoft Office Plus', 0, 8518, 43016, NULL, '2023-09-08'),
(225, NULL, '04243899', 'Aura Aulia Putri S', '2001-10-22', '', 'Program Profesional', 0, 8526, 43115, NULL, '2024-06-24'),
(226, NULL, '04243974', 'Alif', '2005-08-06', '', 'Program Profesional', 0, 8587, 43177, NULL, '2024-12-15'),
(227, NULL, '4243999', 'Wynne Ayu Aulia ', '2005-12-20', 'reguler_paket', '', 21, 8593, 43202, NULL, '2024-12-31'),
(228, NULL, '04223682', 'Boris Pramono', '1983-01-17', 'reguler_paket', '', 24, 6477, 42926, NULL, '2023-05-02'),
(231, NULL, '4244042', 'Septiana', '1995-09-30', 'reguler_paket', '', 21, 8628, 43247, NULL, '2025-06-04'),
(232, NULL, '4243914', 'Sofia Citra Farhanah', '2001-08-24', '', '', 27, 8544, 43126, NULL, '2024-08-19'),
(233, NULL, '04243903', 'Repa Septian Setiawan', '2004-09-01', '', '', 0, 8495, 43106, NULL, '2024-03-28'),
(234, NULL, '4233850', 'Syerlina Yulia Putri ', '2001-06-20', '', '', 25, 8471, 45025, NULL, '2024-01-20'),
(235, NULL, '04233878', 'Fadli Muhammad Miraj', '2002-09-02', 'reguler_paket', '', 25, 8512, 43091, NULL, '2024-05-24'),
(236, NULL, '04233780', 'Alfi Hidayati ', '1998-06-04', '', 'Microsoft Office Plus', 0, 8521, 43017, NULL, '2023-09-09'),
(237, NULL, '4233695', 'Yasykur Ari Ritawan', '1999-08-05', '', '', 18, 8555, 42939, NULL, '2024-08-20'),
(238, NULL, '04233835', 'Ira Siti Nurniani', '2002-01-07', '', '', 0, 8496, 43026, NULL, '2024-04-17'),
(239, NULL, '4233670', 'Rifa Khalia Sonjaya', '2009-12-31', '', '', 18, 8500, 42916, NULL, '2023-08-21'),
(243, NULL, '04233714', 'Annisa Rahma Anggreani ', '2004-07-03', NULL, 'Program Profesional', NULL, 8481, 42958, NULL, '2024-03-05'),
(244, NULL, '04243925', 'Berlianti Sefiana ', '2000-10-29', NULL, 'Program Profesional', NULL, 8560, 43144, NULL, '2024-09-23'),
(245, NULL, '04243913', 'La Winka Putriana', '1999-09-17', NULL, 'Program Profesional', NULL, 8506, 43125, NULL, '2024-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_materi_privat`
--

CREATE TABLE `daftar_materi_privat` (
  `id_daftar_materi_privat` int(11) NOT NULL,
  `nama_materi` varchar(100) NOT NULL,
  `durasi` varchar(20) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_materi_privat`
--

INSERT INTO `daftar_materi_privat` (`id_daftar_materi_privat`, `nama_materi`, `durasi`, `harga`) VALUES
(3, 'Microsoft Word', '6', '1200000'),
(4, 'Microsoft Excel', '8', '1600000'),
(5, 'Microsoft Powerpoint', '2', '400000'),
(6, 'Microsoft Access', '6', '1200000'),
(7, 'DEA/MYOB', '4', '800000'),
(8, 'Photoshop', '6', '1200000'),
(9, 'Pagemaker', '4', '800000'),
(11, 'Visio Technical', '2', '400000'),
(12, 'Corel Draw', '6', '1200000'),
(13, 'AutoCAD 2D', '6', '1600000'),
(14, 'AutoCAD 3D', '6', '1600000'),
(15, '3D Studio Max', '6', '1800000'),
(16, 'Mech Desktop', '10', '1800000'),
(17, 'Solid Work', '10', '1800000'),
(18, 'Swish/Flash MX', '10', '1800000'),
(19, 'FireWork', '10', '1800000'),
(20, 'C++', '10', '1600000'),
(21, 'Java', '10', '1600000'),
(22, 'Visual Basic Net', '12', '1600000'),
(23, 'SQL/Server', '10', '1600000'),
(24, 'C#', '10', '1600000'),
(25, 'MySQL', '10', '1800000'),
(26, 'HTML', '10', '1600000'),
(27, 'CSS', '10', '1800000'),
(28, 'PHP', '10', '1600000'),
(29, 'Java Script', '10', '1600000'),
(30, 'Python', '20', '3500000'),
(31, 'Jquery', '10', '1600000'),
(32, 'Akuntansi', '15', '3000000'),
(33, 'Administrasi Perkantoran', '15', '2500000'),
(34, 'Bahasa Inggris', '15', '2500000'),
(37, 'Linux', '12', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_materi_reguler`
--

CREATE TABLE `daftar_materi_reguler` (
  `id_daftar_materi_reguler` int(11) NOT NULL,
  `nama_materi` varchar(50) NOT NULL,
  `durasi` int(11) NOT NULL,
  `harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_materi_reguler`
--

INSERT INTO `daftar_materi_reguler` (`id_daftar_materi_reguler`, `nama_materi`, `durasi`, `harga`) VALUES
(1, 'Microsoft Words', 6, '550000'),
(2, 'Microsoft Excel', 8, '800000'),
(3, 'Microsoft PowerPoint', 2, '150000'),
(4, 'Microsoft Access', 6, '600000'),
(5, 'DEA/MYOB', 4, '450000'),
(6, 'PhotoShop', 6, '750000'),
(7, 'PageMaker', 4, '550000'),
(8, 'Visio Technical', 2, '150000'),
(9, 'Corel Draw', 6, '750000'),
(10, 'AutoCAD 2D', 6, '1200000'),
(11, 'AutoCAD 3D', 6, '1250000'),
(12, 'C++', 10, '1250000'),
(13, 'Java', 10, '1250000'),
(14, 'Visual Basic Net', 12, '1500000'),
(15, 'SQL/Server', 10, '1450000'),
(16, 'C#', 10, '1250000'),
(17, 'My SQL', 10, '1450000'),
(18, 'HTML', 10, '1250000'),
(19, 'CSS', 10, '1250000'),
(20, 'PHP', 10, '1250000'),
(21, 'Java Script', 10, '1250000');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `nama_galeri` varchar(100) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `tipe` enum('foto','video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `nama_galeri`, `gambar`, `video`, `tipe`) VALUES
(23, 'LPKII', '20250702_143049_1756435182.webp', NULL, 'foto'),
(24, 'Gedung LPKII', 'gedung_lpkii_1756435243.webp', NULL, 'foto'),
(25, 'Lahan Parkir', '20250702_143206_1756435275.webp', NULL, 'foto'),
(26, 'Ruang Tunggu', 'tunggu1_1756435312.webp', NULL, 'foto'),
(27, 'Administrasi', 'administrasi1_1756435364.webp', NULL, 'foto'),
(28, 'Toilet', 'toilet_1756435393.webp', NULL, 'foto'),
(29, 'Mushola', 'mushola_1756435412.webp', NULL, 'foto'),
(30, 'Lab Komputer', 'lab_1756435445.webp', NULL, 'foto'),
(31, 'Kegiatan Belajar', 'belajar1_1756435477.webp', NULL, 'foto'),
(32, 'Kegiatan Belajar', 'belajar2_1756435503.webp', NULL, 'foto'),
(33, 'Kegiatan Belajar', 'belajar3_1756435549.webp', NULL, 'foto'),
(34, 'Kegiatan Belajar', 'belajar4_1756435570.webp', NULL, 'foto'),
(36, 'Kegiatan Belajar', 'IMG-20250904-WA0014_1756978881.webp', NULL, 'foto'),
(37, 'Kegiatan Belajar', 'IMG-20250904-WA0015_1756978899.webp', NULL, 'foto'),
(38, 'Kegiatan Belajar', 'IMG-20250904-WA0016_1756978916.webp', NULL, 'foto'),
(39, 'Kegiatan Belajar', 'IMG-20250904-WA0018_1756978932.webp', NULL, 'foto'),
(71, 'Kegiatan Belajar', NULL, '68e1e8c4358e7.mp4', 'video');

-- --------------------------------------------------------

--
-- Table structure for table `instruktur`
--

CREATE TABLE `instruktur` (
  `id_instruktur` int(11) NOT NULL,
  `nama_instruktur` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instruktur`
--

INSERT INTO `instruktur` (`id_instruktur`, `nama_instruktur`) VALUES
(6, 'Deni Koswara Kondita'),
(7, 'Resa Zulfikar Adiyasa'),
(10, 'Arif Fathurahman');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `nama_materi` varchar(100) NOT NULL,
  `punya_ujian` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `nama_materi`, `punya_ujian`) VALUES
(17, 'Microsoft Word', 1),
(18, 'Microsoft Excel', 1),
(19, 'Microsoft Windows', 0),
(20, 'Microsoft Powerpoint', 1),
(21, 'Microsoft Access', 1),
(22, 'Internet', 0),
(23, 'MYOB/DEA', 1),
(24, 'Visio Technical', 1),
(26, 'CorelDraw', 1),
(27, 'AutoCAD 2D', 1),
(28, 'AutoCAD 3D', 1),
(29, 'PhotoShop', 1),
(30, 'InDesign/Publisher', 1),
(34, 'SketchUp', 1),
(35, 'C++', 1),
(36, 'Java', 1),
(37, 'Visual Basic Net', 1),
(38, 'SQL Server', 1),
(39, 'PHP', 1),
(40, 'MySQL', 1),
(41, 'HTML', 1),
(42, 'CSS', 1),
(43, 'Java Script', 1),
(44, 'Jquery', 1),
(45, 'Bootstrap', 1),
(46, 'CMS Wordpress', 1),
(47, 'Web Hosting', 1),
(48, 'Pengenalan Sistem Komputer', 1),
(49, 'Pengenalan Hardware Komputer', 1),
(50, 'Multimedia', 1),
(51, 'Perakitan PC', 1),
(52, 'BIOS', 1),
(53, 'Instalasi OS', 1),
(54, 'Maintenance', 1),
(55, 'Troubleshooting', 1),
(56, 'Pengenalan Jaringan Komputer', 1),
(57, 'Standar Komunikasi Data', 1),
(58, 'IP Address', 1),
(59, 'Implementasi Jaringan Komputer', 1),
(60, 'Routing & Switching Basic', 1),
(61, 'Mikrotik Router Basic', 1),
(62, 'Instalasi & Konfigurasi Windows Server', 1),
(63, 'Instalasi Linux', 1),
(64, 'Perintah Dasar Linux', 1),
(65, 'Administrasi User', 1),
(66, 'Setting Jaringan Linux', 1),
(67, 'Layanan Server', 1),
(68, 'PageMaker', 1),
(70, 'Java/C++', 1),
(71, 'InDesign/Publisher/PageMaker', 1),
(73, 'Python', 1);

-- --------------------------------------------------------

--
-- Table structure for table `materi_paket`
--

CREATE TABLE `materi_paket` (
  `id_materi_paket` int(11) NOT NULL,
  `id_paket_kursus` int(11) NOT NULL,
  `id_materi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi_paket`
--

INSERT INTO `materi_paket` (`id_materi_paket`, `id_paket_kursus`, `id_materi`) VALUES
(18, 18, 17),
(19, 18, 18),
(17, 18, 19),
(20, 18, 20),
(21, 18, 21),
(22, 18, 22),
(165, 18, 52),
(26, 19, 18),
(23, 19, 19),
(27, 19, 21),
(28, 19, 23),
(31, 20, 17),
(32, 20, 18),
(33, 20, 20),
(34, 20, 21),
(36, 20, 22),
(35, 20, 23),
(38, 21, 17),
(39, 21, 18),
(37, 21, 19),
(40, 21, 20),
(41, 21, 21),
(46, 21, 22),
(42, 21, 24),
(44, 21, 26),
(45, 21, 29),
(43, 21, 68),
(48, 22, 17),
(51, 22, 18),
(47, 22, 19),
(50, 22, 20),
(52, 22, 21),
(58, 22, 22),
(53, 22, 23),
(54, 22, 24),
(56, 22, 26),
(57, 22, 29),
(55, 22, 68),
(60, 23, 26),
(61, 23, 29),
(59, 23, 30),
(62, 24, 26),
(64, 24, 27),
(63, 24, 29),
(66, 25, 26),
(158, 25, 27),
(159, 25, 28),
(67, 25, 29),
(153, 25, 71),
(74, 27, 35),
(75, 27, 36),
(79, 28, 35),
(80, 28, 37),
(81, 28, 38),
(82, 29, 21),
(83, 29, 39),
(152, 29, 70),
(89, 30, 21),
(86, 30, 35),
(94, 30, 36),
(87, 30, 37),
(88, 30, 38),
(95, 30, 38),
(93, 30, 39),
(90, 30, 40),
(91, 30, 41),
(92, 30, 42),
(99, 31, 39),
(103, 31, 40),
(96, 31, 41),
(97, 31, 42),
(98, 31, 43),
(113, 32, 39),
(112, 32, 40),
(107, 32, 41),
(161, 32, 42),
(109, 32, 43),
(110, 32, 44),
(111, 32, 45),
(114, 32, 46),
(115, 32, 47),
(126, 33, 21),
(127, 33, 36),
(128, 33, 37),
(123, 33, 39),
(122, 33, 40),
(117, 33, 41),
(118, 33, 42),
(119, 33, 43),
(120, 33, 44),
(121, 33, 45),
(124, 33, 46),
(125, 33, 47),
(156, 34, 27),
(157, 34, 28),
(150, 34, 34),
(162, 35, 27),
(163, 35, 28),
(129, 37, 48),
(130, 37, 49),
(131, 37, 50),
(132, 37, 51),
(133, 37, 52),
(134, 37, 53),
(135, 37, 54),
(136, 37, 55),
(140, 38, 22),
(137, 38, 56),
(138, 38, 57),
(139, 38, 58),
(141, 38, 59),
(142, 38, 60),
(143, 38, 61),
(144, 38, 62),
(145, 39, 63),
(146, 39, 64),
(147, 39, 65),
(148, 39, 66),
(149, 39, 67);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_ujian`
--

CREATE TABLE `nilai_ujian` (
  `id_nilai` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_peserta` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `id_instruktur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paket_kursus`
--

CREATE TABLE `paket_kursus` (
  `id_paket_kursus` int(11) NOT NULL,
  `kode` varchar(7) NOT NULL,
  `nama_paket` varchar(255) NOT NULL,
  `jp` varchar(10) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `kode_jurusan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket_kursus`
--

INSERT INTO `paket_kursus` (`id_paket_kursus`, `kode`, `nama_paket`, `jp`, `harga`, `kode_jurusan`) VALUES
(18, 'A02', 'Microsoft Office', '48', '1900000', 'A'),
(19, 'A03', 'Komputer Akuntansi', '48', '1900000', 'A'),
(20, 'A05', 'Komputer Administrasi Kantor', '60', '2300000', 'A'),
(21, 'A06-1', 'Program Profesional 1', '96', '2700000', 'A'),
(22, 'A06-2', 'Program Profesional 2', '104', '2900000', 'A'),
(23, 'D01', 'Desain Publisher', '42', '1900000', 'B'),
(24, 'D02', 'Desain Grafis & CAD', '42', '2000000', 'B'),
(25, 'D03', 'Desain Publisher & CAD', '66', '2900000', 'B'),
(27, 'P02', 'Desktop Programming 1', '36', '2300000', 'C'),
(28, 'P03', 'Desktop Programming 2', '48', '2500000', 'C'),
(29, 'P04', 'Desktop Programming 3', '48', '2500000', 'C'),
(30, 'P05', 'Desktop Programming 4', '48', '3700000', 'C'),
(31, 'P10', 'WEB Programming 1', '50', '3000000', 'C'),
(32, 'P11', 'WEB Programming 2', '64', '4300000', 'C'),
(33, 'P12', 'Desktop & Web Programming', '100', '5000000', 'C'),
(34, 'D04', 'Desain Rancang', '40', '3300000', 'B'),
(35, 'D07', 'AutoCAD', '32', '2700000', 'B'),
(37, 'H01', 'Teknisi Hardware Komputer', '30', '4000000', 'D'),
(38, 'H04', 'Instalasi Jaringan Komputer', '32', '4500000', 'D'),
(39, 'H05', 'Instalasi Jaringan Linux', '30', '3800000', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id_pendaftar` int(11) NOT NULL,
  `nama_lengkap` varchar(32) DEFAULT NULL,
  `nisn` varchar(20) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat_sekarang` text DEFAULT NULL,
  `kode_pos` int(5) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `agama` enum('Islam','Protestan','Katolik','Hindu','Buddha','Konghucu') DEFAULT NULL,
  `pendidikan_terakhir` varchar(30) DEFAULT NULL,
  `lulusan_tahun` int(11) DEFAULT NULL,
  `nama_perusahaan` varchar(50) DEFAULT NULL,
  `alamat_perusahaan` text DEFAULT NULL,
  `kode_pos_perusahaan` int(5) DEFAULT NULL,
  `no_telp_perusahaan` varchar(13) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `nama_orangtua` varchar(50) DEFAULT NULL,
  `alamat_orangtua` text DEFAULT NULL,
  `kode_pos_orangtua` int(5) DEFAULT NULL,
  `no_telp_orangtua` varchar(13) DEFAULT NULL,
  `program` enum('privat','reguler_materi','reguler_paket') DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `tgl` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `id_pendaftar` int(11) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp` varchar(15) NOT NULL,
  `program` enum('privat','reguler_materi','reguler_paket') DEFAULT NULL,
  `status_peserta` enum('Aktif','Lulus','Mengundurkan diri') DEFAULT 'Aktif',
  `tanggal_daftar` date DEFAULT curdate(),
  `tanggal_lulus` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `nama_promo` varchar(100) NOT NULL,
  `gambar_promo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`id_promo`, `nama_promo`, `gambar_promo`) VALUES
(20, 'Promo September', 'IMG-20250904-WA0013_1756978543.webp'),
(21, 'Promo Spesial', 'IMG-20250904-WA0017_1757057662.webp');

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `tgl_ujian` date NOT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `id_peserta` int(11) NOT NULL,
  `no_pc` varchar(5) NOT NULL,
  `ket` enum('Ujian Pertama','Remedial','Latihan','') NOT NULL,
  `program` enum('privat','reguler_materi','reguler_paket') DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Petugas','Instruktur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `password`, `role`) VALUES
(23, 'LKP LPKII', 'lpkii', 'lpkiibbkn@gmail.com', '$2y$10$nJh0MbcANmkXPSvAXfqcCejJlFE30rEGODxN4sxnBlqyhnBNn35BG', 'Admin'),
(26, 'ABDUL FARID HAERUL UMAM', 'Abdul ajah', 'abdulfard367@gmail.com', '$2y$10$Y6MQmvgn9E4hV3JUils35ey6yiRIv8GZi23V/YpU3TRKuPjPXSCgy', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ajuan_sertifikat`
--
ALTER TABLE `ajuan_sertifikat`
  ADD PRIMARY KEY (`id_ajuan`),
  ADD KEY `ajuan_sertifikat_ibfk_1` (`id_peserta`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id_alumni`);

--
-- Indexes for table `daftar_materi_privat`
--
ALTER TABLE `daftar_materi_privat`
  ADD PRIMARY KEY (`id_daftar_materi_privat`);

--
-- Indexes for table `daftar_materi_reguler`
--
ALTER TABLE `daftar_materi_reguler`
  ADD PRIMARY KEY (`id_daftar_materi_reguler`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indexes for table `instruktur`
--
ALTER TABLE `instruktur`
  ADD PRIMARY KEY (`id_instruktur`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `materi_paket`
--
ALTER TABLE `materi_paket`
  ADD PRIMARY KEY (`id_materi_paket`),
  ADD KEY `nama_paket` (`id_paket_kursus`,`id_materi`),
  ADD KEY `id_daftar_materi` (`id_materi`),
  ADD KEY `id_paket_kursus` (`id_paket_kursus`);

--
-- Indexes for table `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_ujian` (`id_ujian`,`id_instruktur`),
  ADD KEY `nilai_ujian_ibfk_1` (`id_instruktur`),
  ADD KEY `id_peserta` (`id_peserta`);

--
-- Indexes for table `paket_kursus`
--
ALTER TABLE `paket_kursus`
  ADD PRIMARY KEY (`id_paket_kursus`),
  ADD KEY `nama_paket` (`nama_paket`);

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id_pendaftar`),
  ADD KEY `program` (`program`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD KEY `id_pendaftar` (`id_pendaftar`),
  ADD KEY `program` (`program`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `materi_ujian` (`id_materi`,`id_peserta`),
  ADD KEY `id_materi` (`id_materi`),
  ADD KEY `id_daftar_materi` (`id_materi`),
  ADD KEY `id_materi_2` (`id_materi`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `program` (`program`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ajuan_sertifikat`
--
ALTER TABLE `ajuan_sertifikat`
  MODIFY `id_ajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id_alumni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `daftar_materi_privat`
--
ALTER TABLE `daftar_materi_privat`
  MODIFY `id_daftar_materi_privat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `daftar_materi_reguler`
--
ALTER TABLE `daftar_materi_reguler`
  MODIFY `id_daftar_materi_reguler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `instruktur`
--
ALTER TABLE `instruktur`
  MODIFY `id_instruktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `materi_paket`
--
ALTER TABLE `materi_paket`
  MODIFY `id_materi_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `paket_kursus`
--
ALTER TABLE `paket_kursus`
  MODIFY `id_paket_kursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id_pendaftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ajuan_sertifikat`
--
ALTER TABLE `ajuan_sertifikat`
  ADD CONSTRAINT `ajuan_sertifikat_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materi_paket`
--
ALTER TABLE `materi_paket`
  ADD CONSTRAINT `materi_paket_ibfk_1` FOREIGN KEY (`id_materi`) REFERENCES `materi` (`id_materi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materi_paket_ibfk_2` FOREIGN KEY (`id_paket_kursus`) REFERENCES `paket_kursus` (`id_paket_kursus`);

--
-- Constraints for table `nilai_ujian`
--
ALTER TABLE `nilai_ujian`
  ADD CONSTRAINT `nilai_ujian_ibfk_1` FOREIGN KEY (`id_instruktur`) REFERENCES `instruktur` (`id_instruktur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ujian_ibfk_2` FOREIGN KEY (`id_ujian`) REFERENCES `ujian` (`id_ujian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ujian_ibfk_3` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar` (`id_pendaftar`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ujian_ibfk_3` FOREIGN KEY (`program`) REFERENCES `peserta` (`program`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ujian_ibfk_4` FOREIGN KEY (`id_jurusan`) REFERENCES `peserta` (`id_jurusan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
