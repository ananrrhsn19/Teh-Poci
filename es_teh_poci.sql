-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2025 at 02:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `es_teh_poci`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `kategori` enum('Es Teh','Non-Teh') DEFAULT NULL,
  `nama_minuman` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `tersedia` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `kategori`, `nama_minuman`, `deskripsi`, `harga`, `tersedia`) VALUES
(11, 'Es Teh', 'Es Teh Original', 'Teh melati khas Poci, dingin dan segar.', 5000, 1),
(12, 'Es Teh', 'Es Teh Tarik', 'Teh dicampur susu kental manis, ditarik untuk tekstur lembut.', 7000, 1),
(13, 'Es Teh', 'Teh Lemon / Lemon Tea', 'Teh dengan perasan lemon segar.', 8000, 1),
(14, 'Es Teh', 'Teh Leci / Lychee Tea', 'Teh dengan sirup dan potongan buah leci.', 8500, 1),
(15, 'Es Teh', 'Teh Stroberi / Strawberry Tea', 'Teh rasa stroberi, manis dan segar.', 8500, 1),
(16, 'Es Teh', 'Teh Mangga / Mango Tea', 'Teh rasa mangga, manis dengan aroma tropis.', 8500, 1),
(17, 'Es Teh', 'Teh Yakult / Teh Probiotik', 'Kombinasi teh dan minuman probiotik.', 9000, 1),
(18, 'Es Teh', 'Teh Susu Regal', 'Teh susu dengan tambahan biskuit Regal.', 9500, 1),
(19, 'Es Teh', 'Teh Susu Cokelat', 'Perpaduan teh, susu, dan cokelat.', 9000, 1),
(20, 'Es Teh', 'Teh Susu Pandan', 'Teh susu dengan rasa pandan yang wangi.', 9000, 1),
(21, 'Non-Teh', 'Jeruk Peras Dingin', 'Minuman jeruk asli, segar.', 7500, 1),
(22, 'Non-Teh', 'Kopi Susu / Kopi Poci', 'Kopi khas dengan tambahan susu kental.', 8000, 1),
(23, 'Non-Teh', 'Cincau Susu', 'Cincau hitam dengan susu manis dan es.', 8500, 1),
(24, 'Non-Teh', 'Cokelat Dingin', 'Minuman cokelat yang manis dan creamy.', 8500, 1),
(25, NULL, 'Topping Cincau', 'Topping cincau hitam lembut.', 2000, 1),
(26, NULL, 'Topping Nata de Coco', 'Topping nata de coco kenyal.', 2000, 1),
(27, NULL, 'Topping Boba Hitam', 'Topping boba manis dan kenyal.', 2500, 1),
(28, NULL, 'Topping Jelly Mangga', 'Topping jelly rasa mangga.', 2000, 1),
(29, NULL, 'Topping Keju Parut', 'Topping keju parut untuk rasa gurih.', 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu Verifikasi','Diverifikasi','Ditolak') DEFAULT 'Menunggu Verifikasi',
  `tanggal_bayar` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status` enum('Diproses','Diterima','Selesai') DEFAULT 'Diproses',
  `tanggal` date DEFAULT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `user_id`, `menu_id`, `jumlah`, `catatan`, `total_harga`, `metode_pembayaran`, `status`, `tanggal`, `bukti_bayar`) VALUES
(1, 9, 23, 1, NULL, 8500, 'Dana', 'Diproses', '2025-06-13', '1749772561_tugas 1.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` enum('admin','pelanggan') NOT NULL DEFAULT 'pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`) VALUES
(8, 'Admin Utama', 'admin1', 'admin123', 'admin'),
(9, 'Pelanggan Satu', 'user1', 'user123', 'pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_ibfk_1` (`pesanan_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
