-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 05:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_hp`
--

CREATE TABLE `data_hp` (
  `id_hp` int(4) NOT NULL,
  `nama_hp` varchar(20) NOT NULL,
  `harga_hp` int(100) NOT NULL,
  `ram_hp` varchar(5) NOT NULL,
  `memori_hp` varchar(5) NOT NULL,
  `processor_hp` varchar(8) NOT NULL,
  `kamera_hp` varchar(10) NOT NULL,
  `harga_angka` int(10) NOT NULL,
  `ram_angka` int(10) NOT NULL,
  `memori_angka` int(10) NOT NULL,
  `procesor_angka` int(10) NOT NULL,
  `kamera_angka` int(10) NOT NULL,
  `image` text NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_hp`
--

INSERT INTO `data_hp` (`id_hp`, `nama_hp`, `harga_hp`, `ram_hp`, `memori_hp`, `processor_hp`, `kamera_hp`, `harga_angka`, `ram_angka`, `memori_angka`, `procesor_angka`, `kamera_angka`, `image`, `stock`) VALUES
(1, 'Oppo A18', 1599000, '4', '128', 'Octacore', '15', 2, 2, 4, 5, 1, 'Oppo A18.jpg', 89),
(2, 'Oppo A78 4G', 3399000, '8', '256', 'Octacore', '50', 3, 4, 5, 5, 3, 'Oppo A78 4G.jpg', 28),
(3, 'Oppo A79 5G', 3799000, '8', '256', 'Quadcore', '50', 3, 4, 5, 3, 3, 'Oppo A79 5G.jpg', 18),
(4, 'Vivo Y100 5G', 389900, '8', '128', 'Quadcore', '50', 1, 4, 4, 3, 3, 'Vivo Y100 5G.jpg', 30),
(5, 'Vivo Y36 4G', 2999000, '8', '256', 'Octacore', '50', 2, 4, 5, 5, 3, 'Vivo Y36 4G.jpg', 40),
(6, 'Vivo V30 5G', 5999000, '8', '256', 'Quadcore', '100', 5, 4, 5, 3, 5, 'Vivo V30 5G.jpg', 50),
(7, 'Samsung A25 5G', 3999000, '8', '128', 'Octacore', '50', 3, 4, 4, 5, 3, 'Samsung A25 5G.png', 59),
(8, 'Samsung A34 5G', 4999000, '8', '256', 'Octacore', '48', 4, 4, 5, 5, 3, 'Samsung A34 5G.jpg', 70),
(9, 'Samsung A53 5G', 5999000, '8', '256', 'Octacore', '64', 5, 4, 5, 5, 5, 'Samsung A53 5G.jpg', 80),
(10, 'Realme C67', 2999000, '8', '256', 'Quadcore', '108', 2, 4, 5, 3, 5, 'Realme C67.jpg', 89),
(11, 'Realme C51', 1399000, '4', '64', 'Octacore', '50', 2, 2, 3, 5, 3, 'Realme C51.jpg', 70),
(12, 'Realme C53', 1999000, '6', '128', 'Octacore', '50', 2, 3, 4, 5, 3, 'Realme C53.jpg', 60),
(13, 'Redmi 12', 2999000, '8', '256', 'Octacore', '50', 2, 4, 5, 5, 3, 'Redmi 12.jpg', 50),
(14, 'Redmi Note 12 Pro 4G', 3899000, '8', '256', 'Octacore', '108', 3, 4, 5, 5, 5, 'Redmi Note 12 Pro 4G.jpg', 38),
(15, 'Infinix Hot 30I', 1599000, '8', '128', 'Octacore', '50', 2, 4, 4, 5, 3, 'Infinix Hot 30I.jpg', 90),
(16, 'Xiaomi 14 Pro', 12999000, '64', '1024', 'Quadcore', '764', 5, 5, 5, 3, 5, 'Black-8589.jpg', 198),
(17, 'NOKIA', 2400000, '2', '16', 'Dualcore', '14', 2, 1, 1, 1, 1, '1200px-NokiaC3.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `detailpayment`
--

CREATE TABLE `detailpayment` (
  `idDetailPayment` int(11) NOT NULL,
  `idPayment` int(11) NOT NULL,
  `id_hp` int(4) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpayment`
--

INSERT INTO `detailpayment` (`idDetailPayment`, `idPayment`, `id_hp`, `id_pelanggan`, `jumlah`) VALUES
(2076, 2060, 10, 5, 1),
(2077, 2061, 14, 5, 1),
(2078, 2062, 1, 12, 1),
(2079, 2062, 16, 12, 2),
(2080, 2062, 7, 12, 1),
(2081, 2063, 3, 12, 2),
(2082, 2063, 14, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `idPayment` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idPayment`, `date`) VALUES
(2060, '2024-06-11 05:48:57'),
(2061, '2024-06-11 10:48:50'),
(2062, '2024-06-11 12:40:48'),
(2063, '2024-06-11 09:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idPelanggan` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` enum('user','admin','superadmin') NOT NULL,
  `nama` varchar(25) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idPelanggan`, `username`, `password`, `level`, `nama`, `email`) VALUES
(5, 'superadmin', 'adminsuper', 'superadmin', 'Admin1', 'admin1@company.com'),
(6, 'user', '123', 'user', 'Beni', 'kusumo@gmail.com'),
(10, 'geroox', '123', 'admin', 'Rizki Mufid', 'rzkmlaksd@gmail.com'),
(12, 'mahmud', 'maimunah', 'user', 'Naufal Farhan Azizi', 'mahmud@jir.com'),
(13, 'user', 'user', 'user', 'user', 'user@user.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_hp`
--
ALTER TABLE `data_hp`
  ADD PRIMARY KEY (`id_hp`);

--
-- Indexes for table `detailpayment`
--
ALTER TABLE `detailpayment`
  ADD PRIMARY KEY (`idDetailPayment`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idPayment`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idPelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_hp`
--
ALTER TABLE `data_hp`
  MODIFY `id_hp` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detailpayment`
--
ALTER TABLE `detailpayment`
  MODIFY `idDetailPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2083;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2064;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idPelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
