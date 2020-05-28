-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 28 mai 2020 à 11:43
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gpa`
--
CREATE DATABASE IF NOT EXISTS `gpa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gpa`;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `type_attestation` varchar(20) NOT NULL,
  `region` varchar(50) NOT NULL,
  `descriptif` text NOT NULL,
  `tel` varchar(10) NOT NULL,
  `prix` int(11) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT DELAYED INTO `annonce` (`id`, `id_utilisateur`, `type_attestation`, `region`, `descriptif`, `tel`, `prix`, `document`) VALUES
(24, 20, 'Marchandises - 3.5T', 'Auvergne-Rhône-Alpes', 'TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest', '0678956365', 100, '63732073b7bfbb86d924c5bdeff37ef9cb54d9c3.pdf'),
(23, 1, 'Commissionnaire', 'Provence-Alpes-Côte d\'Azur', 'Bonjour, je suis Adrien, j\'ai 20 ans et je propose mes services en tant que commissionnaire, pour plus d\'informations, contactez-moi.\n', '0678343361', 50, '8f8dd749f51e721c376bbeee7376947b5fa4963f.pdf'),
(25, 1, 'Voyageurs', 'Bretagne', 'Je propose mes services de transports de voyageurs, veuillez me contacter pour plus de détail, merci.', '0678956536', 50, '0e090bd242d1f56de0ce3f3c429e408de46b3f7c.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(5) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `naissance` varchar(10) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT DELAYED INTO `utilisateurs` (`id`, `genre`, `nom`, `prenom`, `adresse`, `email`, `naissance`, `login`, `password`, `profil`) VALUES
(1, 'Homme', 'Gonzalez', 'Adrien', '430 Avenue de Lattre de Tassigny', 'adrien.gonzalez@laplateforme.io', '1999-06-02', 'Firefou', '$2y$12$NwQdt4coiy2LwTyb1ygUj.IYA/BfxVmqpDbk9Sboz7qxzJ3zBb.f6', 'profil_defaut.png'),
(20, 'Homme', 'Gonzalez', 'Alexandre', '430 Avenue de Lattre de Tassigny', 'adrien1361@gmail.com', '2002-05-02', 'Walken99', '$2y$12$41am7/4vx6vyO9eikvYuce.04K4AReQRShmNrwrIuNcjJiFvYHh7e', 'f9625301b5151cef4bc5c259cb19565243f9644a.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
