-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2020 pada 13.09
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_pemrograman_web_2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `kode_bk` varchar(6) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `jumlah_bk` int(11) NOT NULL,
  `tanggal_bk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `kode_bk`, `buku_id`, `jumlah_bk`, `tanggal_bk`) VALUES
(1, 'BK0001', 1, 25, '2020-05-08'),
(3, 'BK0002', 6, 5, '2020-05-10');

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_bk` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `buku` SET `buku`.`stok` = `buku`.`stok` - NEW.jumlah_bk WHERE `buku`.`id` = NEW.buku_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_bk_2` BEFORE UPDATE ON `barang_keluar` FOR EACH ROW UPDATE `buku` SET `buku`.`stok` = `buku`.`stok` - NEW.jumlah_bk WHERE `buku`.`id` = NEW.buku_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `kode_bm` varchar(6) NOT NULL,
  `buku_id` int(11) NOT NULL,
  `jumlah_bm` int(11) NOT NULL,
  `tanggal_bm` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `kode_bm`, `buku_id`, `jumlah_bm`, `tanggal_bm`) VALUES
(3, 'BM0001', 5, 25, '2020-05-08'),
(4, 'BM0002', 1, 5, '2020-05-08'),
(6, 'BM0003', 6, 15, '2020-05-09');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_bm` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `buku` SET `buku`.`stok` = `buku`.`stok` + NEW.jumlah_bm WHERE `buku`.`id` = NEW.buku_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_bm_2` BEFORE UPDATE ON `barang_masuk` FOR EACH ROW UPDATE `buku` SET `buku`.`stok` = `buku`.`stok` + NEW.jumlah_bm WHERE `buku`.`id` = NEW.buku_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(5) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `id_pengarang` int(11) NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `tebal_halaman` int(11) NOT NULL,
  `cetakan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `judul`, `id_pengarang`, `id_penerbit`, `tebal_halaman`, `cetakan`, `harga`, `stok`, `deskripsi`) VALUES
(1, 'B0001', 'The Power of Habit (kekuatan kebiasaan)', 50, 1, 371, '2019', 98000, 200, 'Jika seseorang bertanya pada anda, apa yang anda lakukan pertama kali setelah bangun tidur? Jawaban anda mungkin akan beragam. Misalnya, saat bangun tidur anda bergegas pergi ke kamar mandi, mungkin orang lain akan pergi menuju dapur dan membuka kulkas untuk menenguk segelas air atau mungkin bergegas keluar dari rumah dan melakukan lari pagi. kebiasaan tersebut nampaknya terdengar sangat umum, namun dapat memberikan pengaruh yang besar bagi siapapun, terutama terhadap diri anda sendiri.'),
(3, 'B0002', 'Sebuah Seni Untuk Bersikap Bodo Amat', 1, 1, 246, 'Cetakan III: Mei, 2018', 67000, 130, 'Kunci dari seni pertama adalah masa bodoh terhadap segala halangan dan perjuangan dalam mencapai sesuatu yang kita inginkan. Seharusnya kita hadapi dan nikmati saja karena dalam mengejar suatu pencapaian, pasti ada saja rintangan yang muncul. Seni kedua, temukan hal-hal penting dan berarti untuk diprioritaskan sehingga kamu bisa lebih mudah untuk masa bodoh pada hal-hal sepele. Adapun seni ketiga mempertegas seni sebelumnya, yakni kita mulai dapat memilah mana yang lebih penting saat beranjak dewasa. Walaupun hal penting itu tampaknya sederhana, tetapi kita bisa tetap bahagia dengan kesederhanaan itu.'),
(5, 'B0003', 'Filosofi Teras', 50, 1, 344, '2019', 90000, 175, 'Saat menyebut filsafat Yunani kuno, nama yang langsung terbit adalah Sokrates, Aristoteles dan Plato. Zeno rasanya terdengar asing. Filsafat juga identik dengan perenungan yang serba berat, abstrak, dan mengawang-awang.\r\n\r\nBicara filsafat, biasanya membicarakan konsep-konsep abstrak seperti eksistensialisme, nihilisme, strukturalisme hingga post-strukturalisme. Menyembuhkan depresi dan stres dianggap bukan ranah filsafat.'),
(6, 'B0004', 'Naruto Shippuden Vol.100', 51, 1, 50, '2020', 12000, 60, 'Komik Naruto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id` int(11) NOT NULL,
  `penerbit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id`, `penerbit`) VALUES
(1, 'Kepustaan Populer Gramedia-Jakarta & New York Times'),
(2, 'HarperOne');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengarang`
--

CREATE TABLE `pengarang` (
  `id` int(11) NOT NULL,
  `pengarang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengarang`
--

INSERT INTO `pengarang` (`id`, `pengarang`) VALUES
(1, 'Charles Duhigg'),
(49, 'Mark Manson'),
(50, 'Henry Manampiring'),
(51, 'Tegar Pratama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'tegar', '$2y$10$QWPz2.Y53/sr6EgZMmUWkuTmqRvTjNzag8sPR3/3fyreKgmKmBwRC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users_groups`
--

INSERT INTO `users_groups` (`id`, `id_user`, `id_group`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_id` (`buku_id`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penerbit` (`id_penerbit`),
  ADD KEY `id_pengarang` (`id_pengarang`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`);

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`);

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id`);

--
-- Ketidakleluasaan untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
