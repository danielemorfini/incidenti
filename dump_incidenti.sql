-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 17, 2022 alle 18:03
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `incidenti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `mezzo`
--

CREATE TABLE `mezzo` (
  `id` int(11) NOT NULL,
  `targa` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `mezzo`
--

INSERT INTO `mezzo` (`id`, `targa`) VALUES
(1, 'AA111AA'),
(2, 'BB222BB'),
(3, 'CC333CC'),
(4, 'DD444DD'),
(5, 'EE555EE'),
(6, 'FF666FF'),
(7, 'GG777GG'),
(8, 'HH888HH'),
(9, 'II999II'),
(10, 'JJ000JJ'),
(11, 'KK111KK'),
(12, 'LL222LL'),
(13, 'MM333MM'),
(14, 'NN444NN'),
(15, 'OO555OO'),
(16, 'PP666PP'),
(17, 'QQ777QQ'),
(18, 'RR888RR'),
(19, 'SS999SS'),
(20, 'TT000TT'),
(21, 'UU111UU'),
(22, 'VV222VV'),
(23, 'WW333WW'),
(24, 'X444XX'),
(25, 'Y555YY'),
(26, 'ZZ666ZZ');

-- --------------------------------------------------------

--
-- Struttura della tabella `sinistro`
--

CREATE TABLE `sinistro` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `luogo` varchar(30) NOT NULL,
  `codice` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `sinistro`
--

INSERT INTO `sinistro` (`id`, `data`, `luogo`, `codice`) VALUES
(32, '2022-05-16 00:00:00', 'AA', 'AA11'),
(33, '2022-05-16 00:00:00', 'BB', 'BB22'),
(34, '2022-05-16 00:00:00', 'CC', 'CC33'),
(35, '2022-05-16 00:00:00', 'EE', 'EE55'),
(36, '2022-05-16 00:00:00', 'FF', 'FF66'),
(40, '2022-05-17 00:00:00', 'JJ', 'JJ00'),
(41, '2022-05-17 00:00:00', 'YY', 'YY55'),
(43, '2022-05-17 00:00:00', 'KK', 'KK11'),
(44, '2022-05-17 00:00:00', 'K1', 'alfa1'),
(45, '2022-05-17 00:00:00', 'k2', 'alpha2'),
(46, '2022-05-17 00:00:00', 'k3', 'alfa3'),
(47, '2022-05-17 00:00:00', 'OO', 'OO55'),
(48, '2022-05-17 00:00:00', 'PP', 'PP66');

-- --------------------------------------------------------

--
-- Struttura della tabella `veicolo_coinvolto`
--

CREATE TABLE `veicolo_coinvolto` (
  `id` int(11) NOT NULL,
  `id_mezzo` int(11) NOT NULL,
  `id_sinistro` int(11) NOT NULL,
  `importo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `veicolo_coinvolto`
--

INSERT INTO `veicolo_coinvolto` (`id`, `id_mezzo`, `id_sinistro`, `importo`) VALUES
(15, 1, 32, 11),
(16, 2, 33, 22),
(17, 4, 34, 33),
(18, 3, 34, 33),
(19, 5, 35, 55),
(20, 6, 36, 66),
(21, 10, 40, 1),
(22, 12, 43, 21),
(23, 11, 43, 11),
(24, 13, 43, 2),
(25, 11, 44, 3),
(26, 11, 45, 6),
(27, 15, 47, 5),
(28, 16, 48, 66),
(29, 17, 48, 67),
(30, 18, 48, 68);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `mezzo`
--
ALTER TABLE `mezzo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `sinistro`
--
ALTER TABLE `sinistro`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `veicolo_coinvolto`
--
ALTER TABLE `veicolo_coinvolto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_mezzo` (`id_mezzo`),
  ADD KEY `id_sinistro` (`id_sinistro`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `mezzo`
--
ALTER TABLE `mezzo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `sinistro`
--
ALTER TABLE `sinistro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT per la tabella `veicolo_coinvolto`
--
ALTER TABLE `veicolo_coinvolto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `veicolo_coinvolto`
--
ALTER TABLE `veicolo_coinvolto`
  ADD CONSTRAINT `veicolo_coinvolto_ibfk_1` FOREIGN KEY (`id_mezzo`) REFERENCES `mezzo` (`id`),
  ADD CONSTRAINT `veicolo_coinvolto_ibfk_2` FOREIGN KEY (`id_sinistro`) REFERENCES `sinistro` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
