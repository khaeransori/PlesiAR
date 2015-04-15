-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2014 at 02:13 PM
-- Server version: 5.5.27-log
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anshori_plesiar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(254) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `pass` char(32) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `image` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `pass`, `nama`, `image`) VALUES
(1, 'budi', '00dfc53ee86af02e742515cdcf075ed3', 'Budi Setyawan', '48ed33c0c0db70e92cb3b9abc3661b89.jpg'),
(5, 'khaer', '9d279ec8dadff908e61347ce60a5a4cc', 'khaer', '5e0517635c700112562d339b9e9499c1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `poi`
--

CREATE TABLE IF NOT EXISTS `poi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `name` varchar(254) NOT NULL,
  `description` text NOT NULL,
  `image` text,
  `status` enum('visible','hidden') NOT NULL DEFAULT 'hidden',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `latitude`, `longitude`, `name`, `description`, `image`, `status`) VALUES
(8, '-6.96666670', '110.41666670', 'Qonita Batik', 'test1', 'cbd74311e2386d094ec373de98672359.jpg', 'visible'),
(9, '-7.05298870', '110.43805150', 'Gies Batik', 'Asem kuwalik id kro name', '0652f645f16be29de4e8dd65fd67c6ed.jpg', 'visible'),
(11, '-6.87868208', '109.67516318', 'Museum Batik Pekalongan', 'Perkaya wawasan anda tentang kebudayaan batik. Berkunjunglah sekarang.', '65541ed7cb36be64553329df08f1cb5d.JPG', 'visible'),
(12, '-7.05298870', '110.43805150', 'labse', 'Tempat nongkrong kita semua', '39a5eed892e4556492c1dec46f5e5a06.jpg', 'hidden'),
(13, '-7.05298870', '110.43805150', 'labse', 'Tempat nongkrong kita semua', 'dcbce50fb3e91710ba5b9cede32d5ec7.jpg', 'hidden'),
(15, '-7.05298870', '110.43805150', 'nasa', 'Wakomting kece kesukaan cewek2 angkatan', 'cc21948906ca495bff8736ba9149fc47.jpg', 'hidden'),
(16, '-7.05298870', '110.43805150', 'mas budi', 'Asdasdasd', 'e7cfaa81a152b877587f07a6c758d509.jpg', 'hidden'),
(17, '-6.88907698', '109.67384994', 'Kampung Batik Kauman', 'Pengalaman baru berbelanja batik, lengkap dengan kunjungan workshop dan praktik membatik.\r\nDatang dan rasakan sendiri kentalnya nuansa kebudayaan batik di  kampung ini,\r\ndan dapatkan aneka batik yang menarik dan eksklusif.', 'd80e1beaf600c31a262c4202ae508f06.jpg', 'visible'),
(18, '-7.04929814', '110.43812007', 'Rektorat', 'Rektorat Undip', '7ffd1cfe3889b36fbd865b069495019f.jpg', 'visible'),
(19, '-7.05298100', '110.43806570', '', '', '19bcbb6d6c4f614fc34889a7b71731cf.jpg', 'hidden'),
(20, '-7.05295830', '110.43804960', 'caterin', 'Ratu atut wannabe', '28b3bdc1038a60ae60b27fe3fff90b5f.jpg', 'visible'),
(21, '-7.05295830', '110.43804960', 'jati', 'Developer andal', '75a94e445423c2440060ef52dcf1d171.jpg', 'hidden'),
(22, '-7.05294820', '110.43804990', 'mas rizwan', 'Wanted', '0b23b9282f8f8173288ba33f7049ebf4.jpg', 'hidden'),
(23, '-7.05294820', '110.43804990', 'labse', 'Asdasdasd', '2e75ae7a53c16bbd1fae7aa303eca07f.jpg', 'hidden'),
(24, '-7.05294820', '110.43804990', 'digcggdiry', 'F8yf7yf8g8yyHoih', 'e03f51ef13c2ddb62eb6f428930fa124.jpg', 'hidden'),
(25, '-7.05179360', '110.43843490', 'Yogi', 'Kahim siskom', '20993bfd8b3a76e23bc4168c98d69d0d.jpg', 'hidden'),
(26, '-7.05294820', '110.43804990', 'hrheuwjwh', 'Hrjejehwi2', '985f54d801af5e2efd6b6934e148d2c5.jpg', 'hidden'),
(27, '-7.05294820', '110.43804990', 'hiitditcu', 'Ciigcihvigcitf', 'a3b7d452f8ef8e0d8c7d626ac70b4d8c.jpg', 'hidden'),
(28, '-7.05294820', '110.43804990', 'hrhejeje', 'Urueueue', '999661465538f18fb21d123e7f16aa1c.jpg', 'hidden'),
(29, '-7.05294820', '110.43804990', 'yrheheje', 'Ueu33uee', '2d8ed907e0fe9122f7094ba21d44adc4.jpg', 'hidden'),
(30, '-7.05063910', '110.43881990', 'hfjdjejee', 'Hruei2hehe', 'ad6a6ca99ef672110b73f2f074f79a8e.jpg', 'hidden'),
(31, '-7.05294820', '110.43804990', 'kantor siskom', 'Kantor jurusan siskom', 'f43f7ec843e126671fc2273f5bc103cf.jpg', 'visible');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
