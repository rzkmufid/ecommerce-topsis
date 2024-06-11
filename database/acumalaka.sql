-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2023 at 11:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acumalaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `halaman` int(11) NOT NULL,
  `tanggalTerbit` date NOT NULL,
  `berat` double NOT NULL,
  `panjang` double NOT NULL,
  `lebar` double NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(50) NOT NULL,
  `gambarBuku` text NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `kategori`, `penerbit`, `pengarang`, `halaman`, `tanggalTerbit`, `berat`, `panjang`, `lebar`, `deskripsi`, `harga`, `gambarBuku`, `stok`) VALUES
(9, 'Berani tidak disukai', 'Self Improvement', 'Gramedia Pustaka Utama', 'Ichiro Kishimi dan Fumitake Koga', 350, '2019-10-07', 0.15, 18, 15, 'membaca buku ini bisa mengubah hidup anda. jutaan orang sudah menarik manfaat\r\ndarinya. sekarang giliran anda. \r\nBerani Tidak Disukai, yang sudah terjual lebih dari 3,5 juta eksemplar, \r\nmengungkap rahasia mengeluarkan kekuatan terpendam yang memungkinkan Anda\r\n meraih kebahagiaan yang hakiki dan menjadi sosok yang Anda idam-idamkan.\r\n Apakah kebahagiaan adalah sesuatu yang Anda pilih? Berani Tidak Disukai\r\n menyajikan jawabannya secara sederhana dan langsung. Berdasarkan teori\r\n Alfred Adler, satu dari tiga psikolog terkemuka abad kesembilan belas selain\r\n Freud dan Jung, buku ini mengikuti percakapan yang menggugah antara seorang \r\nfilsuf dan seorang pemuda. Dalam lima percakapan yang terjalin, sang filsuf\r\n membantu muridnya memahami bagaimana masing-masing dari kita mampu menentukan\r\n arah hidup kita, bebas dari belenggu trauma masa lalu dan beban ekspektasi\r\n orang lain. Buku yang kaya kebijaksanaan ini akan memandu Anda memahami\r\n konsep memaafkan diri sendiri, mencintai diri, dan menyingkirkan hal-hal\r\n yang tidak penting dari pikiran. Cara pikir yang membebaskan ini memungkinkan \r\nAnda membangun keberanian untuk mengubah dan mengabaikan batasan yang mungkin\r\n Anda berlakukan bagi diri Anda.', 45000, 'Berani tidak disukai.jpg', 121),
(11, 'Start With Why', 'Self Improvement', 'Gramedia Pustaka Utama', 'Simon Sinek', 374, '2019-06-26', 0.16, 18, 15, 'Bagaimana para pemimpin besar, seperti Steve Jobs dan Bill Gates, memimpin, menginspirasi, dan mengubah hidup jutaan orang? Buku inilah jawabannya. Start with Why menggunakan contoh dunia nyata untuk menguraikan konsep Lingkaran Emas yang merangkum pentingnya mengidentifikasi tujuan keberadaan organisasi sebelum hal lainnya, kemudian mengambil tindakan untuk membuat visi menjadi kenyataan. Asal mula perusahaan harus menjadi alasannya. Begitu juga dengan kehidupan pribadi kita. Setiap orang atau organisasi dapat menjelaskan apa yang mereka lakukan; beberapa dapat menjelaskan bagaimana mereka berbeda atau lebih baik; tetapi sangat sedikit yang bisa mengartikulasikan mengapa. MENGAPA bukan tentang uang atau keuntungan, melainkan tentang hasil. MENGAPA adalah hal yang menginspirasi kita dan orangorang di sekitar kita. Dengan menggunakan kisah Martin Luther King, Jr., Steve Jobs, hingga Wright Brothers, Simon Sinek menunjukkan bahwa para pemimpin yang menginspirasi berpikir, bertindak, dan berkomunikasi dengan cara yang sama—dan itu sangat berlawanan dari apa yang dilakukan kebanyakan orang', 93500, 'start with why.jpg', 225),
(12, 'How To Win and Influence People - Dale Carnegie', 'Self Improvement', 'Gramedia Pustaka Utama', 'Dale Carnegie', 332, '2019-09-01', 0.16, 18, 15, 'Terkadang kita merasa sulit untuk beradaptasi di lingkungan baru atau bertemu dengan orang baru. Tak jarang, kita merasa overthinking akan pemikiran orang-orang terhadap kita. Padahal, kesan pertama itu penting, lho!\r\nNah, buku dari Dale Carnegie ini wajib banget kamu baca yang ingin lebih percaya diri ketika berkenalan dengan orang baru.', 93500, 'how to win.jpeg', 98);

-- --------------------------------------------------------

--
-- Table structure for table `detailpayment`
--

CREATE TABLE `detailpayment` (
  `idDetailPayment` int(11) NOT NULL,
  `idPayment` int(11) NOT NULL,
  `idBuku` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `jumlah` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailpayment`
--

INSERT INTO `detailpayment` (`idDetailPayment`, `idPayment`, `idBuku`, `idUser`, `jumlah`) VALUES
(2068, 2055, 9, 4, 3),
(2069, 2055, 11, 4, 1),
(2070, 2056, 9, 6, 1),
(2071, 2056, 11, 6, 1),
(2072, 2057, 9, 4, 3),
(2073, 2057, 11, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `idPayment` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`idPayment`, `date`) VALUES
(2055, '2023-01-09 04:04:59'),
(2056, '2023-01-09 04:50:55'),
(2057, '2023-01-19 09:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idPelanggan` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL,
  `namaDepan` varchar(25) NOT NULL,
  `namaBelakang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idPelanggan`, `username`, `password`, `level`, `namaDepan`, `namaBelakang`) VALUES
(4, 'user', 'pass', 'user', 'Rizki ', 'Mufid'),
(5, 'admin', 'admin', 'admin', 'admin', 'admin'),
(6, 'beniadam', '123', 'user', 'beni', 'adam');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `nomorTransaksi` int(11) NOT NULL,
  `idPelanggan` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nomorTransaksi`,`idPelanggan`,`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `detailpayment`
--
ALTER TABLE `detailpayment`
  MODIFY `idDetailPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2074;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `idPayment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2058;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `idPelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `nomorTransaksi` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
