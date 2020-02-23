-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 09. Jan 2020 um 16:48
-- Server-Version: 10.4.10-MariaDB
-- PHP-Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `datenarchiv_pape`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `datei`
--

CREATE TABLE `datei` (
  `datei_index` int(10) NOT NULL,
  `KategorieNR` int(10) NOT NULL,
  `Dateiname` varchar(30) NOT NULL,
  `Dateityp_index` int(10) NOT NULL,
  `Eingang` varchar(255) NOT NULL,
  `Verfasser` varchar(30) NOT NULL,
  `Dateipfad` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `datei`
--

INSERT INTO `datei` (`datei_index`, `KategorieNR`, `Dateiname`, `Dateityp_index`, `Eingang`, `Verfasser`, `Dateipfad`, `Status`) VALUES
(112, 1, 'Test', 1, '09-01-2020  09:57', 'Admin12345', 'datei_5e16eb0f58d6c.pdf', '1'),
(116, 2, 'ichBIMShallo', 1, '09-01-2020  10:42', 'Admin12345', 'datei_5e16f5999dbf6.pdf', '2'),
(120, 3, 'TestKauf', 1, '09-01-2020  10:57', 'Admin12345', 'datei_5e16f8ecd470d.pdf', '1'),
(121, 4, 'BoxDich', 2, '09-01-2020  10:58', 'Admin12345', 'datei_5e16f93a8ffe5.jpeg', '2');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `dateityp`
--

CREATE TABLE `dateityp` (
  `Dateityp_index` int(10) NOT NULL,
  `Dateityp` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `dateityp`
--

INSERT INTO `dateityp` (`Dateityp_index`, `Dateityp`) VALUES
(1, 'PDF'),
(2, 'JPEG');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kategorien`
--

CREATE TABLE `kategorien` (
  `KategorieNR` int(10) NOT NULL,
  `Kategorie` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `kategorien`
--

INSERT INTO `kategorien` (`KategorieNR`, `Kategorie`) VALUES
(1, 'Rechnung'),
(2, 'Mahnung'),
(3, 'Kostenvoranschlag'),
(4, 'Auftrag');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `status`
--

CREATE TABLE `status` (
  `Statusnr` int(10) NOT NULL,
  `Status` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `status`
--

INSERT INTO `status` (`Statusnr`, `Status`) VALUES
(1, 'Offen'),
(2, 'Erledigt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `MitarbeiterNR` int(11) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Vorname` text NOT NULL,
  `Nachname` text NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Passwort` varchar(25) NOT NULL,
  `Mail` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`MitarbeiterNR`, `Username`, `Vorname`, `Nachname`, `Adresse`, `Passwort`, `Mail`) VALUES
(1, 'Admin12345', 'Christian', 'Pape', '', '12345', 'test@test.de'),
(11, 'Chris', 'Christian', 'Pape', '', 'bla', 'chris@chris.de'),
(19, 'Bla', 'Lucky', 'Chris', 'TestStraße 3', 'dada', 'da@da.de');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `datei`
--
ALTER TABLE `datei`
  ADD PRIMARY KEY (`datei_index`),
  ADD KEY `Dateityp_index` (`Dateityp_index`),
  ADD KEY `KategorieNR` (`KategorieNR`),
  ADD KEY `Verfasser` (`Verfasser`),
  ADD KEY `Status` (`Status`(250));

--
-- Indizes für die Tabelle `dateityp`
--
ALTER TABLE `dateityp`
  ADD PRIMARY KEY (`Dateityp_index`);

--
-- Indizes für die Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  ADD PRIMARY KEY (`KategorieNR`);

--
-- Indizes für die Tabelle `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Statusnr`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`MitarbeiterNR`),
  ADD UNIQUE KEY `unique_username` (`Username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `datei`
--
ALTER TABLE `datei`
  MODIFY `datei_index` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT für Tabelle `dateityp`
--
ALTER TABLE `dateityp`
  MODIFY `Dateityp_index` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `kategorien`
--
ALTER TABLE `kategorien`
  MODIFY `KategorieNR` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `status`
--
ALTER TABLE `status`
  MODIFY `Statusnr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `MitarbeiterNR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
