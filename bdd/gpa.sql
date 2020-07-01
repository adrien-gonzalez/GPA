-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 01 juil. 2020 à 18:56
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

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
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT DELAYED INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'Stéphanie', '$2y$12$XK620QC.2Gba6zlnR/dDbuujbAKEwYm2sDa60e6gyh6/hlHbczija');

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
  `disponibilite` varchar(30) NOT NULL,
  `statut` varchar(10) NOT NULL,
  `verif` int(11) NOT NULL DEFAULT '0',
  `date_annonce` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT DELAYED INTO `annonce` (`id`, `id_utilisateur`, `type_attestation`, `region`, `descriptif`, `tel`, `prix`, `document`, `disponibilite`, `statut`, `verif`, `date_annonce`) VALUES
(24, 20, 'Marchandises - 3.5T', 'Auvergne-Rhône-Alpes', 'TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest', '0678956365', 100, 'ae9d10f5617c3480a37b07629d2a2f114cc1bb48.pdf', 'Disponible', 'Salarié', 1, '2020-07-01'),
(23, 1, 'Commissionnaire', 'Provence-Alpes-Côte d\'Azur', 'Bonjour, je suis Adrien, j\'ai 20 ans et je propose mes services en tant que commissionnaire, pour plus d\'informations, contactez-moi.\n', '0678343361', 50, '8f8dd749f51e721c376bbeee7376947b5fa4963f.pdf', 'Sous 3 mois', 'Associé', 1, '2020-06-24'),
(35, 1, 'Voyageurs', 'Auvergne-Rhône-Alpes', 'Bonjour, je propose mes services de transports de voyageurs, je suis donc disponible pour toutes question concernant mes parcours / expériences, contactez moi.', '0678343361', 100, '2a583c14ba53ded99f7f1aeffd040297534a9a2e.pdf', 'Disponible', 'Externe', 0, '2020-07-01'),
(36, 1, 'Marchandises + 3.5T', 'Provence-Alpes-Côte d\'Azur', 'Bonjour, j\'offre mes services en tant que transports de marchandises de plus de 3.5 Tonnes, je travail dans le transports de marchandises depuis 2 ans et demi et j\'ai toujours eu de bon retour.', '0678343361', 250, 'df155d7172ba70442ddeec75e50c0dc149c62d33.pdf', 'Disponible', 'Salarié', 1, '2020-07-01');

-- --------------------------------------------------------

--
-- Structure de la table `ban`
--

DROP TABLE IF EXISTS `ban`;
CREATE TABLE IF NOT EXISTS `ban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `date_ban` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ban`
--

INSERT DELAYED INTO `ban` (`id`, `id_utilisateur`, `date_ban`) VALUES
(16, 21, '2020-07-01');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `favoris`
--

INSERT DELAYED INTO `favoris` (`id`, `id_annonce`, `id_utilisateur`) VALUES
(103, 24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `id_utilisateur_prive` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_message` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT DELAYED INTO `message` (`id`, `id_utilisateur`, `id_utilisateur_prive`, `message`, `date_message`) VALUES
(63, 21, 1, 'Salut', '2020-06-04 16:00:00'),
(75, 1, 21, 'ok', '2020-06-15 13:19:12'),
(54, 20, 1, 'ça va ?', '2020-06-04 16:00:00'),
(80, 1, 20, 'cc', '2020-06-15 16:07:23'),
(48, 20, 1, 'Salut', '2020-06-04 15:00:00');

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
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT DELAYED INTO `utilisateurs` (`id`, `genre`, `nom`, `prenom`, `adresse`, `email`, `naissance`, `login`, `password`, `profil`, `date`) VALUES
(1, 'Homme', 'Gonzalez', 'Adrien', '430 Avenue de Lattre de Tassigny', 'adrien.gonzalez@laplateforme.io', '1999-06-02', 'Firefou', '$2y$12$NwQdt4coiy2LwTyb1ygUj.IYA/BfxVmqpDbk9Sboz7qxzJ3zBb.f6', 'profil_defaut.png', '2020-06-02'),
(21, 'Homme', 'Dupont', 'Monsieur', '430 Avenue de Lattre de Tassigny', 'adrien1362@live.fr', '2002-05-02', 'Dupont', '$2y$12$h16.bpWoWCkkgn1UU.Sd4eAO9xNN5so2ihRDyYYp7ZG8slJwtKIMK', 'profil_defaut.png', '2020-06-14'),
(20, 'Homme', 'Gonzalez', 'Alexandre', '430 Avenue de Lattre de Tassigny', 'adrien1361@gmail.com', '2002-05-02', 'Walken99', '$2y$12$41am7/4vx6vyO9eikvYuce.04K4AReQRShmNrwrIuNcjJiFvYHh7e', 'f9625301b5151cef4bc5c259cb19565243f9644a.jpg', '2020-06-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
