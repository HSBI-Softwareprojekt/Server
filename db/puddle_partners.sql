-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Mai 2024 um 16:45
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `puddle_partners`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `level`
--

CREATE TABLE `level` (
  `user_id` bigint(255) NOT NULL COMMENT 'Benutzer ID',
  `level` int(11) NOT NULL COMMENT 'Level',
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Erstellzeit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `scoreboard`
--

CREATE TABLE `scoreboard` (
  `id` bigint(255) NOT NULL COMMENT 'Scoreboard ID',
  `player_1` bigint(255) NOT NULL COMMENT 'Benutzer ID',
  `player_2` bigint(255) NOT NULL COMMENT 'Benutzer ID',
  `level` int(11) NOT NULL COMMENT 'Spiel Level',
  `time` time NOT NULL COMMENT 'Spielzeit',
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Erstellzeit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(255) NOT NULL COMMENT 'Benutzer ID',
  `mail` varchar(255) NOT NULL COMMENT 'E-Mail',
  `username` varchar(255) NOT NULL COMMENT 'Benutzername',
  `password` text NOT NULL COMMENT 'Passwort',
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Erstellzeit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`user_id`,`level`);

--
-- Indizes für die Tabelle `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `scoreboard`
--
ALTER TABLE `scoreboard`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT 'Scoreboard ID';

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT COMMENT 'Benutzer ID';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
