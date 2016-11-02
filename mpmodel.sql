-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 02 nov 2016 om 11:37
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `mpmodel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mpmodel`
--

CREATE TABLE IF NOT EXISTS `mpmodel` (
`id` int(10) NOT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `mbsize` int(10) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `voorraad` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `mpmodel`
--

INSERT INTO `mpmodel` (`id`, `make`, `model`, `mbsize`, `price`, `voorraad`) VALUES
(1, 'apple', 'touch', 50000, '399.99', 499),
(2, 'samsung', 'hr 170', 40000, '199.99', 222),
(16, 'GET technologies .inc', 'HF 410', 4096, '129.95', 500),
(17, 'Far & Loud', 'XM 600', 8192, '224.95', 500),
(18, 'Innotivative', 'Z3', 512, '79.95', 500),
(19, 'Resistance S.A.', '3001', 4096, '124.95', 500),
(20, 'CBA', 'NXT volume', 2048, '158.05', 500);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `mpmodel`
--
ALTER TABLE `mpmodel`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `mpmodel`
--
ALTER TABLE `mpmodel`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
