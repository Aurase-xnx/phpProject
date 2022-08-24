-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 mai 2022 à 12:36
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `samplitek`
--

-- --------------------------------------------------------

--
-- Structure de la table `samples`
--

DROP TABLE IF EXISTS `samples`;
CREATE TABLE IF NOT EXISTS `samples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sampleName` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `creatorID` int(255) NOT NULL,
  `bpm` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `creatorID` (`creatorID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `samples`
--

INSERT INTO `samples` (`id`, `sampleName`, `genre`, `instrument`, `creatorID`, `bpm`) VALUES
(3, 'z', 'z', 'z', 10, 123);

-- --------------------------------------------------------

--
-- Structure de la table `songs`
--

DROP TABLE IF EXISTS `songs`;
CREATE TABLE IF NOT EXISTS `songs` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `songName` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `bpm` int(255) NOT NULL,
  `creatorID` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `creatorID` (`creatorID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `songs`
--

INSERT INTO `songs` (`id`, `songName`, `genre`, `bpm`, `creatorID`) VALUES
(2, 'La truelle de ma tante', 'BoumBoum', 175, 14);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) DEFAULT 'John',
  `lastName` varchar(255) DEFAULT 'Doe',
  `rights` enum('1','2','3') NOT NULL DEFAULT '1',
  `active` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstName`, `lastName`, `rights`, `active`) VALUES
(9, 'Hal', '2000@hal.net', '3109328f5e8d26ecfb0267ee264894d15967a6ea', 'John', 'Doe', '2', '1'),
(10, 'Admin', 'root@samplitek.net', '3844ace49162de4df4b17d7d3a5e5388e2f51990', 'John', 'Doe', '3', '1'),
(12, 'Bobo', 'bobo@baba.bibi', 'b736efda7342c257b42af16d6f7b8da01d5aa165', 'John', 'Doe', '1', '1'),
(13, 'Matteo', 'm@a.com', '7a85f4764bbd6daf1c3545efbbf0f279a6dc0beb', 'Matteo', 'Alcantarini', '1', '1'),
(14, 'Monkey', 'monkey@banana.net', 'fc6fae10db2bd0b625077d7c6d1b9a96925fd2b7', 'John', 'Doe', '1', '1'),
(15, 'Toto', 'toto@toto.com', '0b9c2625dc21ef05f6ad4ddf47c5f203837aa32c', 'John', 'Doe', '1', '1');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `samples`
--
ALTER TABLE `samples`
  ADD CONSTRAINT `samples_ibfk_1` FOREIGN KEY (`creatorID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`creatorID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
