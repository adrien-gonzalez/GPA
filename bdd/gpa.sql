-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 05 août 2020 à 13:42
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

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

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'adrien', '$2y$12$8Ok1z6zguNRVq/K0ZzhmzOIpFFoTpA7zPraVeGNcNEhmCY4KP8fgG');

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
  `date_validite` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `id_utilisateur`, `type_attestation`, `region`, `descriptif`, `tel`, `prix`, `document`, `disponibilite`, `statut`, `verif`, `date_annonce`, `date_validite`) VALUES
(23, 1, 'Commissionnaire', 'Provence-Alpes-Côte d\'Azur', 'Bonjour, je suis Adrien, j\'ai 20 ans et je propose mes services en tant que commissionnaire, pour plus d\'informations, contactez-moi.\n', '0678343361', 50, '8f8dd749f51e721c376bbeee7376947b5fa4963f.pdf', 'Sous 3 mois', 'Associé', 1, '2020-07-30', '2020-07-08'),
(36, 1, 'Marchandises + 3.5T', 'Provence-Alpes-Côte d\'Azur', 'Bonjour, j\'offre mes services en tant que transports de marchandises de plus de 3.5 Tonnes, je travail dans le transports de marchandises depuis 2 ans et demi et j\'ai toujours eu de bon retour.', '0678343361', 250, 'df155d7172ba70442ddeec75e50c0dc149c62d33.pdf', 'Disponible', 'Salarié', 0, '2020-07-30', '2020-07-15'),
(70, 21, 'Voyageurs', 'Hauts-de-France', 'TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest', '0678343361', 150, '5a1661bc1254f83ca7ec0006c888b4adac8c0d80', 'Disponible', 'Associé', 1, '2020-08-05', '2020-08-04');

--
-- Déclencheurs `annonce`
--
DROP TRIGGER IF EXISTS `delete avantage`;
DELIMITER $$
CREATE TRIGGER `delete avantage` AFTER DELETE ON `annonce` FOR EACH ROW DELETE FROM avantage WHERE id_annonce = old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `avantage`
--

DROP TABLE IF EXISTS `avantage`;
CREATE TABLE IF NOT EXISTS `avantage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `date_avantage` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avantage`
--

INSERT INTO `avantage` (`id`, `id_annonce`, `id_service`, `date_avantage`) VALUES
(13, 70, 4, '2020-08-04'),
(10, 35, 5, '2020-07-10');

--
-- Déclencheurs `avantage`
--
DROP TRIGGER IF EXISTS `delete favoris`;
DELIMITER $$
CREATE TRIGGER `delete favoris` AFTER DELETE ON `avantage` FOR EACH ROW DELETE FROM favoris WHERE id_annonce = old.id
$$
DELIMITER ;

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ban`
--

INSERT INTO `ban` (`id`, `id_utilisateur`, `date_ban`) VALUES
(19, 21, '2020-08-05');

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contrat`
--

INSERT INTO `contrat` (`id`, `id_user`) VALUES
(1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `id_utilisateur`, `id_utilisateur_prive`, `message`, `date_message`) VALUES
(63, 21, 1, 'Salut', '2020-06-04 16:00:00'),
(75, 1, 21, 'ok', '2020-06-15 13:19:12'),
(54, 20, 1, 'ça va ?', '2020-06-04 16:00:00'),
(80, 1, 20, 'cc', '2020-06-15 16:07:23'),
(48, 20, 1, 'Salut', '2020-06-04 15:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `recuperation`
--

DROP TABLE IF EXISTS `recuperation`;
CREATE TABLE IF NOT EXISTS `recuperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `recuperation`
--

INSERT INTO `recuperation` (`id`, `mail`, `code`) VALUES
(1, 'adrien1361@gmail.com', 'QhNb3BMgXM'),
(2, 'adrien1361@gmail.com', 'A0GwzWZCq4'),
(3, 'adrien1361@gmail.com', 'dT0BZJ3xpM'),
(4, 'adrien1361@gmail.com', 'ZkGC1bJKab'),
(5, 'adrien1361@gmail.com', 'm8AetKwUp1');

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produit` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `duree` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `id_produit`, `nom`, `description`, `prix`, `categorie`, `duree`) VALUES
(4, 'prod_Hddvz5OFD0MWZ8', 'Mise en avant (7 jours)', 'Met en tête de liste votre annonce pendant 7 jours\n', 5, 'Annonce', 7),
(5, 'prod_He4aq7bmW5AQhS', 'Mise en avant (30 jours)', 'Met en tête de liste votre annonce pendant 30 jours.', 10, 'Annonce', 30),
(6, 'prod_HeOl743151EB7A', 'Mise en avant (60 jours)', 'Met en tête de liste votre annonce pendant 60 jours.', 15, 'Annonce', 60),
(7, 'prod_Hlaz3nPaAFiZJP', 'Contrat', 'Créer un contrat', 228, 'Contrat', 0);

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

INSERT INTO `utilisateurs` (`id`, `genre`, `nom`, `prenom`, `adresse`, `email`, `naissance`, `login`, `password`, `profil`, `date`) VALUES
(1, 'Homme', 'Gonzalez', 'Adrien', '430 Avenue de Lattre de Tassigny', 'adrien.gonzalez@laplateforme.io', '1999-06-02', 'Firefou', '$2y$12$JMV0HTgmddRLvgJR/AQpfes08GNs.vRI6F0R54wC3Ekaguo3egCYa', 'd5cc247032e98f31d13852291867a9eb634e6b7e.jpg', '2020-06-02'),
(21, 'Homme', 'Dupont', 'Monsieur', '430 Avenue de Lattre de Tassigny', 'adrien1362@live.fr', '2002-05-02', 'Dupont', '$2y$12$h16.bpWoWCkkgn1UU.Sd4eAO9xNN5so2ihRDyYYp7ZG8slJwtKIMK', '3680f8980da863ad4384a39770fbf9008e24e2d1.jpg', '2020-06-14'),
(20, 'Homme', 'Gonzalez', 'Alexandre', '430 Avenue de Lattre de Tassigny', 'adrien1361@gmail.com', '2002-05-02', 'Walken99', '$2y$12$41am7/4vx6vyO9eikvYuce.04K4AReQRShmNrwrIuNcjJiFvYHh7e', 'f9625301b5151cef4bc5c259cb19565243f9644a.jpg', '2020-06-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
