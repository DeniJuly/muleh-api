-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_muleh
CREATE DATABASE IF NOT EXISTS `db_muleh` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_muleh`;

-- Dumping structure for table db_muleh.tb_daerah
CREATE TABLE IF NOT EXISTS `tb_daerah` (
  `id_daerah` int(10) NOT NULL AUTO_INCREMENT,
  `nama_daerah` varchar(50) NOT NULL,
  PRIMARY KEY (`id_daerah`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_muleh.tb_daerah: ~6 rows (approximately)
/*!40000 ALTER TABLE `tb_daerah` DISABLE KEYS */;
INSERT INTO `tb_daerah` (`id_daerah`, `nama_daerah`) VALUES
	(1, 'Kelampok'),
	(2, 'Kertayasa'),
	(3, 'Mandiraja'),
	(4, 'Purwanegara'),
	(5, 'Gumiwang'),
	(6, 'Pucang'),
	(7, 'Banjarnegara');
/*!40000 ALTER TABLE `tb_daerah` ENABLE KEYS */;

-- Dumping structure for table db_muleh.tb_daerah_lintasan
CREATE TABLE IF NOT EXISTS `tb_daerah_lintasan` (
  `id_daerah_lintasan` int(10) NOT NULL AUTO_INCREMENT,
  `id_transportasi` int(10) NOT NULL,
  `asal` int(10) NOT NULL,
  `tujuan` int(10) NOT NULL,
  PRIMARY KEY (`id_daerah_lintasan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_muleh.tb_daerah_lintasan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_daerah_lintasan` DISABLE KEYS */;
INSERT INTO `tb_daerah_lintasan` (`id_daerah_lintasan`, `id_transportasi`, `asal`, `tujuan`) VALUES
	(7, 1, 6, 0);
/*!40000 ALTER TABLE `tb_daerah_lintasan` ENABLE KEYS */;

-- Dumping structure for table db_muleh.tb_foto_transportasi
CREATE TABLE IF NOT EXISTS `tb_foto_transportasi` (
  `id_foto_transportasi` int(10) NOT NULL AUTO_INCREMENT,
  `id_transportasi` int(10) NOT NULL,
  `foto_transportasi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_foto_transportasi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_muleh.tb_foto_transportasi: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_foto_transportasi` DISABLE KEYS */;
INSERT INTO `tb_foto_transportasi` (`id_foto_transportasi`, `id_transportasi`, `foto_transportasi`) VALUES
	(1, 1, 'img.png'),
	(2, 1, 'h.png');
/*!40000 ALTER TABLE `tb_foto_transportasi` ENABLE KEYS */;

-- Dumping structure for table db_muleh.tb_penumpang
CREATE TABLE IF NOT EXISTS `tb_penumpang` (
  `id_penumpang` int(10) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `nama_penumpang` varchar(50) NOT NULL,
  `nomor_penumpang` varchar(50) NOT NULL,
  `foto_penumpang` varchar(100) NOT NULL DEFAULT 'default.png',
  PRIMARY KEY (`id_penumpang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_muleh.tb_penumpang: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_penumpang` DISABLE KEYS */;
INSERT INTO `tb_penumpang` (`id_penumpang`, `id_user`, `nama_penumpang`, `nomor_penumpang`, `foto_penumpang`) VALUES
	(1, 2, 'Deni', '08', 'default.png');
/*!40000 ALTER TABLE `tb_penumpang` ENABLE KEYS */;

-- Dumping structure for table db_muleh.tb_transportasi
CREATE TABLE IF NOT EXISTS `tb_transportasi` (
  `id_transportasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `nama_transportasi` varchar(50) NOT NULL,
  `nomor_transportasi` varchar(12) NOT NULL,
  `foto_transportasi` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `status_transportasi` int(1) NOT NULL,
  PRIMARY KEY (`id_transportasi`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_muleh.tb_transportasi: ~0 rows (approximately)
/*!40000 ALTER TABLE `tb_transportasi` DISABLE KEYS */;
INSERT INTO `tb_transportasi` (`id_transportasi`, `id_user`, `nama_transportasi`, `nomor_transportasi`, `foto_transportasi`, `status_transportasi`) VALUES
	(1, 1, 'Deni Juli Setiawan', '085841996781', 'default.jpg', 1);
/*!40000 ALTER TABLE `tb_transportasi` ENABLE KEYS */;

-- Dumping structure for table db_muleh.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tgl_daftar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table db_muleh.tb_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id_user`, `email`, `password`, `tgl_daftar`) VALUES
	(1, 'den@gmail.com', '1372b0061ae39ad7deb93b9b7213face', '2020-01-26 21:18:29'),
	(2, 'sam@gmail.com', '1372b0061ae39ad7deb93b9b7213face', '2020-01-26 21:20:12');
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
