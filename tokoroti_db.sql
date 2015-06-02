-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 03 Jul 2013 pada 15.59
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `tokoroti_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbadmin`
--

CREATE TABLE IF NOT EXISTS `tbadmin` (
  `KdAdmin` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`KdAdmin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbadmin`
--

INSERT INTO `tbadmin` (`KdAdmin`, `username`, `pass`, `fullname`) VALUES
(1, 'admin', '8c4799117527c7b40de8bf2f65257936', 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbbank`
--

CREATE TABLE IF NOT EXISTS `tbbank` (
  `IdBank` int(11) NOT NULL AUTO_INCREMENT,
  `Bank_Nm` varchar(45) NOT NULL,
  `Bank_Logo` varchar(100) NOT NULL,
  `no_rekening` varchar(15) NOT NULL,
  `nama_pemilik` varchar(40) NOT NULL,
  PRIMARY KEY (`IdBank`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tbbank`
--

INSERT INTO `tbbank` (`IdBank`, `Bank_Nm`, `Bank_Logo`, `no_rekening`, `nama_pemilik`) VALUES
(1, 'Mandiri', '/upload/bank/8254cab4df915f02fbf255268e57723f.jpg', '07102938437', 'Basuki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbmember`
--

CREATE TABLE IF NOT EXISTS `tbmember` (
  `KdMember` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `fullname` varchar(45) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `alamat` text,
  PRIMARY KEY (`KdMember`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tbmember`
--

INSERT INTO `tbmember` (`KdMember`, `username`, `pass`, `email`, `fullname`, `telepon`, `alamat`) VALUES
(1, 'Koko', '8c4799117527c7b40de8bf2f65257936', 'joko.purwanto18@gmail.com', 'Joko Purwanto', '085268690818', 'Jalan Haji Agus Salim'),
(2, 'Yudhi', 'c232864d5de2064450915c0b9e4cc0b5', 'yudi', 'Yudhi', '0993712929', 'Klaten');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tborder`
--

CREATE TABLE IF NOT EXISTS `tborder` (
  `KdOrder` bigint(150) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `TbMember_KdMember` int(11) NOT NULL,
  `nama_penerima` varchar(45) DEFAULT NULL,
  `email_penerima` varchar(45) DEFAULT NULL,
  `alamat_penerima` varchar(45) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `tanggal_order` date DEFAULT NULL,
  `tgl_ambil` date NOT NULL,
  `konfirmasi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`KdOrder`),
  KEY `fk_TbOrder_TbMember_idx` (`TbMember_KdMember`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tborder`
--

INSERT INTO `tborder` (`KdOrder`, `session_id`, `TbMember_KdMember`, `nama_penerima`, `email_penerima`, `alamat_penerima`, `telepon`, `tanggal_order`, `tgl_ambil`, `konfirmasi`) VALUES
(201306230001, 'f626b59ea14260c02f49a9d52a87cfe6', 1, 'Joko Purwanto', 'joko.purwanto18@gmail.com', 'Jalan Haji Agus Salim', '085268690818', '2013-06-23', '0000-00-00', 'belum'),
(201306230002, '33bed281984843a0a5f9073a59264ab5', 1, 'Joko Purwanto', 'joko.purwanto18@gmail.com', 'Jalan Haji Agus Salim', '085268690818', '2013-06-23', '0000-00-00', 'belum'),
(201306230003, '9b83b77dfb0107d2aff3bd8c05ae421b', 1, 'Joko Purwanto', 'joko.purwanto18@gmail.com', 'Jalan Haji Agus Salim', '085268690818', '2013-06-23', '0000-00-00', 'belum'),
(201307030001, 'fb873e17649efc438a4dc780d1c8ce2d', 1, 'Joko Purwanto', 'joko.purwanto18@gmail.com', 'Jalan Haji Agus Salim', '085268690818', '2013-07-03', '0000-00-00', 'belum'),
(201307030002, 'fb873e17649efc438a4dc780d1c8ce2d', 1, 'Joko Purwanto', 'joko.purwanto18@gmail.com', 'Jalan Haji Agus Salim', '085268690818', '2013-07-03', '0000-00-00', 'belum'),
(201307030003, '25e349999d4ace9dd66bd5f62dcc27d0', 1, 'Joko Purwanto', 'joko.purwanto18@gmail.com', 'Jalan Haji Agus Salim', '085268690818', '2013-07-03', '0000-00-00', 'belum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tborder_detail`
--

CREATE TABLE IF NOT EXISTS `tborder_detail` (
  `TbOrder_KdOrder` bigint(150) NOT NULL,
  `TbProduk_KdProduk` int(11) NOT NULL,
  `jumlah_detail` int(11) DEFAULT NULL,
  `harga_detail` int(11) DEFAULT NULL,
  KEY `fk_TbOrder_detail_TbOrder1_idx` (`TbOrder_KdOrder`),
  KEY `fk_TbOrder_detail_TbProduk1_idx` (`TbProduk_KdProduk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tborder_detail`
--

INSERT INTO `tborder_detail` (`TbOrder_KdOrder`, `TbProduk_KdProduk`, `jumlah_detail`, `harga_detail`) VALUES
(201306230001, 1, 20, 1500),
(201306230001, 2, 2, 64000),
(201306230002, 1, 20, 1500),
(201306230002, 3, 2, 36000),
(201306230003, 1, 20, 1500),
(201306230003, 2, 2, 64000),
(201307030001, 2, 2, 64000),
(201307030002, 1, 10, 1500),
(201307030002, 3, 2, 36000),
(201307030003, 1, 10, 1500),
(201307030003, 4, 5, 38000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbproduk`
--

CREATE TABLE IF NOT EXISTS `tbproduk` (
  `KdProduk` int(11) NOT NULL AUTO_INCREMENT,
  `Produk` varchar(45) DEFAULT NULL,
  `harga_per_item` int(10) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `stok` int(5) DEFAULT NULL,
  `beli` int(3) DEFAULT NULL,
  PRIMARY KEY (`KdProduk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data untuk tabel `tbproduk`
--

INSERT INTO `tbproduk` (`KdProduk`, `Produk`, `harga_per_item`, `image`, `stok`, `beli`) VALUES
(1, 'Bakpia', 1500, '/upload/produk/91ef1d7da4367ed78692bd956f4e49d7.jpg', 980, 322),
(2, 'Brownies', 64000, '/upload/produk/6804a7b79a5233062399d38e94871cd7.jpg', 10, 6),
(3, 'Cake Gula Palem', 36000, '/upload/produk/c161997205f8e3044dff0fa6cb8b0b85.jpg', 6, 10),
(4, 'Cake Kombinasi', 38000, '/upload/produk/d1e93c7a7d884d76e169e5f9438bbf8b.png', 5, 11),
(5, 'Cake Marmer', 30000, '/upload/produk/6081d5ba7514a9bdcdd76be865e29ce5.png', 5, 0),
(6, 'Cake Pandan', 32000, '/upload/produk/ad6218ec6940ad701bd3f795f0de7b4e.png', 5, 0),
(7, 'Karamel', 36000, '/upload/produk/d6bf7693ab3d5cec7e52f58ec03d6b07.png', 5, 0),
(8, 'Kenari Kismis', 36000, '/upload/produk/b0752fb9c969d3d327659024d0363135.png', 5, 0),
(9, 'Krumpul 5 Rasa', 15000, '/upload/produk/251c9840bd248e8a9d4c2bccf93dd0a6.png', 5, 0),
(10, 'Krumpul 1 Rasa', 20000, '/upload/produk/a8f743a28eedad385e4c7c3685b8ace8.png', 5, 0),
(11, 'Mandarin Pelangi', 68000, '/upload/produk/e8e26fc03c9857886be8cdb05c1c53da.png', 5, 0),
(12, 'Mandarin', 51000, '/upload/produk/ea1dfa1fd409ce3e82c1026dba16b6a7.png', 5, 0),
(13, 'Pisang Keju', 40000, '/upload/produk/83f7bd40f8cc21b9211766aba28a06e6.png', 5, 0),
(14, 'Roti Gulung', 30000, '/upload/produk/744905866a89327020b0e2053975e206.png', 5, 0),
(15, 'Tart Black Forest Oven', 38000, '/upload/produk/a392f2848810792712b5145620a8b7e2.png', 5, 0),
(16, 'Tart Pernikahan', 300000, '/upload/produk/649f669fde429c98fa7b5e6ad935897e.png', 5, 0),
(17, 'Tart Ulang Tahun Black Forest', 225000, '/upload/produk/b3cdc52334c33b0c400189f794acc907.png', 5, 0);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tborder`
--
ALTER TABLE `tborder`
  ADD CONSTRAINT `fk_TbOrder_TbMember` FOREIGN KEY (`TbMember_KdMember`) REFERENCES `tbmember` (`KdMember`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tborder_detail`
--
ALTER TABLE `tborder_detail`
  ADD CONSTRAINT `fk_TbOrder_detail_TbOrder1` FOREIGN KEY (`TbOrder_KdOrder`) REFERENCES `tborder` (`KdOrder`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_TbOrder_detail_TbProduk1` FOREIGN KEY (`TbProduk_KdProduk`) REFERENCES `tbproduk` (`KdProduk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
