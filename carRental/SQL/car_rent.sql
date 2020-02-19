-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2020 at 12:35 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `userAdmin` varchar(255) NOT NULL,
  `passAdmin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userAdmin`, `passAdmin`) VALUES
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'admin2', 'c84258e9c39059a89ab77d846ddab909');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnika` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `grad` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `nivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnika`, `ime`, `prezime`, `email`, `telefon`, `username`, `password`, `grad`, `adresa`, `nivo`) VALUES
(53, 'Pera', 'Peric', 'pera@gmail.com', '0603332221', 'perakg', '2b23d854e6d793e047f8c2e7b294d22d', 'Kragujevac', 'Beogradska 11', 0),
(55, 'Marko', 'Markovic', 'markokg@gmail.com', '0603332225', 'markokg', 'ef2d84b874abfcc8ab1367886f9b1759', 'Kragujevac', 'Kraljevacka 22', 0),
(56, 'Ivan', 'Ivanovic', 'ivankg@gmail.com', '0695558889', 'ivankg', '30196c8e6db92c4b3dbb0f65399429eb', 'Kragujevac', 'Kraljice Marije 11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacije`
--

CREATE TABLE `rezervacije` (
  `id_rezervacije` int(11) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `id_vozila` int(11) NOT NULL,
  `tip` varchar(255) NOT NULL,
  `proizvodjac` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `gorivo` varchar(255) NOT NULL,
  `od_datuma` date NOT NULL,
  `do_datuma` date NOT NULL,
  `datum_rezervacije` date NOT NULL,
  `ukupna_cena` decimal(10,2) NOT NULL,
  `potvrda` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rezervacije`
--

INSERT INTO `rezervacije` (`id_rezervacije`, `ime`, `prezime`, `username`, `email`, `telefon`, `id_vozila`, `tip`, `proizvodjac`, `model`, `gorivo`, `od_datuma`, `do_datuma`, `datum_rezervacije`, `ukupna_cena`, `potvrda`) VALUES
(264, 'Ivan', 'Ivanovic', 'ivankg', 'ivankg@gmail.com', '0695558889', 0, 'Putnicko', 'Peugeot ', '208', 'Diesel', '2020-02-24', '2020-02-29', '2020-02-18', '200.00', 1),
(265, 'Ivan', 'Ivanovic', 'ivankg', 'ivankg@gmail.com', '0695558889', 0, 'Putnicko', 'Ford', 'Fiesta', 'Diesel', '2020-02-24', '2020-02-29', '2020-02-18', '250.00', 0),
(266, 'Ivan', 'Ivanovic', 'ivankg', 'ivankg@gmail.com', '0695558889', 0, 'Putnicko', 'Ford', 'Kuga', 'Diesel', '2020-03-02', '2020-03-06', '2020-02-18', '280.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vozila`
--

CREATE TABLE `vozila` (
  `id_vozila` int(11) NOT NULL,
  `tip_vozila` varchar(255) NOT NULL,
  `proizvodjac` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `gorivo` varchar(255) NOT NULL,
  `slika` varchar(255) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vozila`
--

INSERT INTO `vozila` (`id_vozila`, `tip_vozila`, `proizvodjac`, `model`, `gorivo`, `slika`, `cena`, `opis`) VALUES
(2, 'Putnicko', 'Fiat', '500 L', 'Diesel', '500l.png', '60.00', 'Fiat 500L , Diesel, 1900 ccm JTD, full Paket opreme'),
(3, 'Putnicko', 'Peugeot ', '208', 'Diesel', '208.png', '40.00', 'Peugeot, 208 , diesel, 1500 ccm , full paket opreme'),
(4, 'Putnicko', 'Peugeot', '308', 'Diesel', '308.png', '50.00', 'Peugeot, 308, Diesel, 1600 ccm, full paket opreme'),
(5, 'Putnicko', 'Opel', 'Corsa E', 'Diesel', 'corsa.png', '50.00', 'Opel, Corsa E, 1300 ccm DCI, Full palet opreme'),
(6, 'Putnicko', 'Ford', 'Fiesta', 'Diesel', 'fiesta.png', '50.00', 'Ford , Fiesta , 1400 ccm , Full paket opreme'),
(7, 'Putnicko', 'Ford', 'Kuga', 'Diesel', 'kuga.png', '70.00', 'Ford , Kuga , 2000 ccm , Ful paket opreme'),
(8, 'Putnicko', 'Opel', 'Mokka', 'Diesel', 'moka.png', '70.00', 'Opel , Mokka , 1700 ccm , Ful paket opreme'),
(23, 'Putnicko', 'Fiat', 'Punto - Evo', 'Diesel', 'puntoEvo.png', '40.00', 'Putnicko vozila , Fiat , Punto - EVO, 1300ccm Diesel Mjet , Full paket opreme');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnika`);

--
-- Indexes for table `rezervacije`
--
ALTER TABLE `rezervacije`
  ADD PRIMARY KEY (`id_rezervacije`);

--
-- Indexes for table `vozila`
--
ALTER TABLE `vozila`
  ADD PRIMARY KEY (`id_vozila`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `rezervacije`
--
ALTER TABLE `rezervacije`
  MODIFY `id_rezervacije` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `vozila`
--
ALTER TABLE `vozila`
  MODIFY `id_vozila` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
