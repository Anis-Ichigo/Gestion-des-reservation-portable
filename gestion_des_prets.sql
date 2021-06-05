-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 05 juin 2021 à 13:44
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_des_prets`
--

-- --------------------------------------------------------

--
-- Structure de la table `calendrier`
--

DROP TABLE IF EXISTS `calendrier`;
CREATE TABLE IF NOT EXISTS `calendrier` (
  `IdentifiantCal` int(10) NOT NULL AUTO_INCREMENT,
  `JourCal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `HoraireCal` time DEFAULT NULL,
  `EtatCal` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdentifiantCal`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `calendrier`
--

INSERT INTO `calendrier` (`IdentifiantCal`, `JourCal`, `HoraireCal`, `EtatCal`) VALUES
(1, 'Lundi', '08:00:00', 'Indisponible'),
(2, 'Lundi', '08:15:00', 'Disponible'),
(3, 'Lundi', '08:30:00', 'Disponible'),
(4, 'Lundi', '08:45:00', 'Indisponible'),
(5, 'Lundi', '09:00:00', 'Disponible'),
(6, 'Lundi', '09:15:00', 'Disponible'),
(7, 'Lundi', '09:30:00', 'Disponible'),
(8, 'Lundi', '09:45:00', 'Disponible'),
(9, 'Lundi', '10:00:00', 'Indisponible'),
(10, 'Lundi', '10:15:00', 'Disponible'),
(11, 'Lundi', '10:30:00', 'Disponible'),
(12, 'Lundi', '10:45:00', 'Indisponible'),
(13, 'Lundi', '11:00:00', 'Disponible'),
(14, 'Lundi', '11:15:00', 'Disponible'),
(15, 'Lundi', '11:30:00', 'Indisponible'),
(16, 'Lundi', '11:45:00', 'Disponible'),
(17, 'Lundi', '12:00:00', 'Disponible'),
(18, 'Lundi', '12:15:00', 'Disponible'),
(19, 'Lundi', '12:30:00', 'Disponible'),
(20, 'Lundi', '14:00:00', 'Indisponible'),
(21, 'Lundi', '14:15:00', 'Disponible'),
(22, 'Lundi', '14:30:00', 'Disponible'),
(23, 'Lundi', '14:45:00', 'Disponible'),
(24, 'Lundi', '15:00:00', 'Disponible'),
(25, 'Lundi', '15:15:00', 'Disponible'),
(26, 'Lundi', '15:30:00', 'Disponible'),
(27, 'Lundi', '15:45:00', 'Disponible'),
(28, 'Lundi', '16:00:00', 'Disponible'),
(29, 'Lundi', '16:15:00', 'Disponible'),
(30, 'Lundi', '16:30:00', 'Disponible'),
(31, 'Lundi', '16:45:00', 'Disponible'),
(32, 'Lundi', '17:00:00', 'Indisponible'),
(33, 'Mardi', '08:00:00', 'Disponible'),
(34, 'Mardi', '08:15:00', 'Disponible'),
(35, 'Mardi', '08:30:00', 'Indisponible'),
(36, 'Mardi', '08:45:00', 'Indisponible'),
(37, 'Mardi', '09:00:00', 'Indisponible'),
(38, 'Mardi', '09:15:00', 'Disponible'),
(39, 'Mardi', '09:30:00', 'Disponible'),
(40, 'Mardi', '09:45:00', 'Disponible'),
(41, 'Mardi', '10:00:00', 'Indisponible'),
(42, 'Mardi', '10:15:00', 'Disponible'),
(43, 'Mardi', '10:30:00', 'Disponible'),
(44, 'Mardi', '10:45:00', 'Disponible'),
(45, 'Mardi', '11:00:00', 'Disponible'),
(46, 'Mardi', '11:15:00', 'Disponible'),
(47, 'Mardi', '11:30:00', 'Disponible'),
(48, 'Mardi', '11:45:00', 'Disponible'),
(49, 'Mardi', '12:00:00', 'Disponible'),
(50, 'Mardi', '12:15:00', 'Disponible'),
(51, 'Mardi', '12:30:00', 'Disponible'),
(52, 'Mardi', '14:00:00', 'Disponible'),
(53, 'Mardi', '14:15:00', 'Disponible'),
(54, 'Mardi', '14:30:00', 'Indisponible'),
(55, 'Mardi', '14:45:00', 'Disponible'),
(56, 'Mardi', '15:00:00', 'Disponible'),
(57, 'Mardi', '15:15:00', 'Disponible'),
(58, 'Mardi', '15:30:00', 'Disponible'),
(59, 'Mardi', '15:45:00', 'Disponible'),
(60, 'Mardi', '16:00:00', 'Disponible'),
(61, 'Mardi', '16:15:00', 'Disponible'),
(62, 'Mardi', '16:30:00', 'Disponible'),
(63, 'Mardi', '16:45:00', 'Disponible'),
(64, 'Mardi', '17:00:00', 'Disponible'),
(65, 'Mercredi', '08:00:00', 'Disponible'),
(66, 'Mercredi', '08:15:00', 'Disponible'),
(67, 'Mercredi', '08:30:00', 'Indisponible'),
(68, 'Mercredi', '08:45:00', 'Disponible'),
(69, 'Mercredi', '09:00:00', 'Disponible'),
(70, 'Mercredi', '09:15:00', 'Disponible'),
(71, 'Mercredi', '09:30:00', 'Indisponible'),
(72, 'Mercredi', '09:45:00', 'Disponible'),
(73, 'Mercredi', '10:00:00', 'Disponible'),
(74, 'Mercredi', '10:15:00', 'Disponible'),
(75, 'Mercredi', '10:30:00', 'Disponible'),
(76, 'Mercredi', '10:45:00', 'Disponible'),
(77, 'Mercredi', '11:00:00', 'Disponible'),
(78, 'Mercredi', '11:15:00', 'Disponible'),
(79, 'Mercredi', '11:30:00', 'Disponible'),
(80, 'Mercredi', '11:45:00', 'Disponible'),
(81, 'Mercredi', '12:00:00', 'Disponible'),
(82, 'Mercredi', '12:15:00', 'Disponible'),
(83, 'Mercredi', '12:30:00', 'Disponible'),
(84, 'Mercredi', '14:00:00', 'Disponible'),
(85, 'Mercredi', '14:15:00', 'Disponible'),
(86, 'Mercredi', '14:30:00', 'Disponible'),
(87, 'Mercredi', '14:45:00', 'Disponible'),
(88, 'Mercredi', '15:00:00', 'Disponible'),
(89, 'Mercredi', '15:15:00', 'Disponible'),
(90, 'Mercredi', '15:30:00', 'Disponible'),
(91, 'Mercredi', '15:45:00', 'Disponible'),
(92, 'Mercredi', '16:00:00', 'Disponible'),
(93, 'Mercredi', '16:15:00', 'Disponible'),
(94, 'Mercredi', '16:30:00', 'Disponible'),
(95, 'Mercredi', '16:45:00', 'Disponible'),
(96, 'Mercredi', '17:00:00', 'Disponible'),
(97, 'Jeudi', '08:00:00', 'Disponible'),
(98, 'Jeudi', '08:15:00', 'Disponible'),
(99, 'Jeudi', '08:30:00', 'Disponible'),
(100, 'Jeudi', '08:45:00', 'Disponible'),
(101, 'Jeudi', '09:00:00', 'Indisponible'),
(102, 'Jeudi', '09:15:00', 'Disponible'),
(103, 'Jeudi', '09:30:00', 'Disponible'),
(104, 'Jeudi', '09:45:00', 'Disponible'),
(105, 'Jeudi', '10:00:00', 'Disponible'),
(106, 'Jeudi', '10:15:00', 'Disponible'),
(107, 'Jeudi', '10:30:00', 'Disponible'),
(108, 'Jeudi', '10:45:00', 'Disponible'),
(109, 'Jeudi', '11:00:00', 'Disponible'),
(110, 'Jeudi', '11:15:00', 'Disponible'),
(111, 'Jeudi', '11:30:00', 'Disponible'),
(112, 'Jeudi', '11:45:00', 'Disponible'),
(113, 'Jeudi', '12:00:00', 'Disponible'),
(114, 'Jeudi', '12:15:00', 'Disponible'),
(115, 'Jeudi', '12:30:00', 'Disponible'),
(116, 'Jeudi', '14:00:00', 'Disponible'),
(117, 'Jeudi', '14:15:00', 'Disponible'),
(118, 'Jeudi', '14:30:00', 'Disponible'),
(119, 'Jeudi', '14:45:00', 'Disponible'),
(120, 'Jeudi', '15:00:00', 'Disponible'),
(121, 'Jeudi', '15:15:00', 'Disponible'),
(122, 'Jeudi', '15:30:00', 'Disponible'),
(123, 'Jeudi', '15:45:00', 'Disponible'),
(124, 'Jeudi', '16:00:00', 'Disponible'),
(125, 'Jeudi', '16:15:00', 'Disponible'),
(126, 'Jeudi', '16:30:00', 'Disponible'),
(127, 'Jeudi', '16:45:00', 'Disponible'),
(128, 'Jeudi', '17:00:00', 'Disponible'),
(129, 'Vendredi', '08:00:00', 'Disponible'),
(130, 'Vendredi', '08:15:00', 'Disponible'),
(131, 'Vendredi', '08:30:00', 'Disponible'),
(132, 'Vendredi', '08:45:00', 'Disponible'),
(133, 'Vendredi', '09:00:00', 'Disponible'),
(134, 'Vendredi', '09:15:00', 'Disponible'),
(135, 'Vendredi', '09:30:00', 'Disponible'),
(136, 'Vendredi', '09:45:00', 'Disponible'),
(137, 'Vendredi', '10:00:00', 'Disponible'),
(138, 'Vendredi', '10:15:00', 'Disponible'),
(139, 'Vendredi', '10:30:00', 'Disponible'),
(140, 'Vendredi', '10:45:00', 'Disponible'),
(141, 'Vendredi', '11:00:00', 'Disponible'),
(142, 'Vendredi', '11:15:00', 'Disponible'),
(143, 'Vendredi', '11:30:00', 'Disponible'),
(144, 'Vendredi', '11:45:00', 'Disponible'),
(145, 'Vendredi', '12:00:00', 'Disponible'),
(146, 'Vendredi', '12:15:00', 'Disponible'),
(147, 'Vendredi', '12:30:00', 'Disponible'),
(148, 'Vendredi', '14:00:00', 'Disponible'),
(149, 'Vendredi', '14:15:00', 'Disponible'),
(150, 'Vendredi', '14:30:00', 'Disponible'),
(151, 'Vendredi', '14:45:00', 'Disponible'),
(152, 'Vendredi', '15:00:00', 'Disponible'),
(153, 'Vendredi', '15:15:00', 'Disponible'),
(154, 'Vendredi', '15:30:00', 'Disponible'),
(155, 'Vendredi', '15:45:00', 'Disponible'),
(156, 'Vendredi', '16:00:00', 'Disponible'),
(157, 'Vendredi', '16:15:00', 'Disponible'),
(158, 'Vendredi', '16:30:00', 'Disponible'),
(159, 'Vendredi', '16:45:00', 'Disponible'),
(160, 'Vendredi', '17:00:00', 'Disponible');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `IdentifiantE` int(11) NOT NULL AUTO_INCREMENT,
  `DateEmprunt` date DEFAULT NULL,
  `DateRetour` date DEFAULT NULL,
  `DateProlongation` date DEFAULT NULL,
  `Motif` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdentifiantM` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IdentifiantPe` int(11) DEFAULT NULL,
  `IdentifiantCal` int(10) NOT NULL,
  PRIMARY KEY (`IdentifiantE`),
  KEY `IdentifiantM` (`IdentifiantM`),
  KEY `IdentifiantPe` (`IdentifiantPe`),
  KEY `IdentifiantCal` (`IdentifiantCal`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`IdentifiantE`, `DateEmprunt`, `DateRetour`, `DateProlongation`, `Motif`, `IdentifiantM`, `IdentifiantPe`, `IdentifiantCal`) VALUES
(1, '2021-02-12', '2021-05-24', '2021-06-29', 'Acquisition', 'N122342546567', 22508753, 15),
(2, '2021-11-08', '2021-06-14', NULL, 'Acquisition', 'N635215328745', 45628764, 45),
(3, '2021-10-05', '2021-07-16', NULL, 'Acquisition', 'N785326914503', 75664889, 30),
(4, '2021-09-13', '2021-06-24', NULL, 'Acquisition', 'N585214637916', 35741568, 10),
(5, '2021-05-15', '2021-07-25', NULL, 'Acquisition', 'N230285049374', 85413601, 69),
(6, '2021-06-02', '2021-06-30', NULL, 'Acquisition', 'N952145236874', 22508753, 57),
(7, '2021-02-12', '2021-05-24', NULL, '', 'N122342546567', 22508753, 15),
(8, '2021-02-12', '2021-05-24', NULL, 'Retour', 'N122342546567', 22508753, 101),
(9, '2021-02-12', '2021-05-24', NULL, 'Retour', 'N122342546567', 22508753, 9),
(10, '2021-06-04', '2022-10-10', NULL, 'Acquisition', 'N122342546567', 85413601, 36),
(11, '2021-04-06', '2022-06-05', NULL, 'Acquisition', 'N230285049374', 22508753, 36),
(12, '2021-07-06', '1970-01-01', NULL, 'Acquisition', 'N963701365874', 22508753, 12),
(13, '2021-09-06', '1970-01-01', NULL, 'Acquisition', 'N148695207869', 22508753, 71),
(14, '2021-08-06', '1970-01-01', NULL, 'Acquisition', 'N785326914503', 22508753, 37),
(15, '2021-06-08', '1970-01-01', NULL, 'Acquisition', 'N585214637916', 22508753, 41),
(16, '2021-06-07', '2025-06-18', NULL, 'Acquisition', 'N148695207869', 22508753, 20);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `IdentifiantM` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateAchat` date DEFAULT NULL,
  `EtatM` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CategorieM` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StatutM` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdentifiantM`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`IdentifiantM`, `DateAchat`, `EtatM`, `CategorieM`, `StatutM`) VALUES
('N122342546567', '2021-02-12', 'Non Dispo', 'Ordinateur', 'Existant'),
('N952145236874', '2021-01-18', 'Non Dispo', 'Tablette', 'Existant'),
('N635215328745', '2021-06-02', 'Non Dispo', 'Ordinateur', 'Existant'),
('N382596325852', '2021-02-20', 'Dispo', 'Ordinateur', 'Supprimé'),
('N785326914503', '2021-01-21', 'Non Dispo', 'Tablette', 'Existant'),
('N230285049374', '2021-04-12', 'Non Dispo', 'Ordinateur', 'Existant'),
('N963701365874', '2021-03-17', 'Non Dispo', 'Ordinateur', 'Existant'),
('N585214637916', '2021-09-25', 'Dispo', 'Clé 4G', 'Existant'),
('N148695207869', '2021-11-10', 'Non Dispo', 'Ordinateur', 'Existant');

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

DROP TABLE IF EXISTS `parametres`;
CREATE TABLE IF NOT EXISTS `parametres` (
  `IdentifiantPa` int(11) NOT NULL AUTO_INCREMENT,
  `Bureau` varchar(50) NOT NULL,
  PRIMARY KEY (`IdentifiantPa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `IdentifiantPe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NomPe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PrenomPe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `EmailPe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mot_de_passePe` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AdressePe` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TelPe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Statut` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Secretariat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Formation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RolePe` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`IdentifiantPe`)
) ENGINE=MyISAM AUTO_INCREMENT=85413602 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`IdentifiantPe`, `NomPe`, `PrenomPe`, `EmailPe`, `Mot_de_passePe`, `AdressePe`, `TelPe`, `Statut`, `Secretariat`, `Formation`, `RolePe`) VALUES
('22508753', 'Dumas', 'Thomas', 'AAA.AAA@etud.ut-capitole.fr', '', '105 Boulevard d\'Arcole 31000 Toulouse', '0625987415', 'Etudiant', NULL, 'M2 MIAGE ISIAD', 'Emprunteur'),
('45628764', 'Martin', 'Axel', 'BBB.BBB@etud.ut-capitole.fr', '', '46 Rue des Blanchers 31000 Toulouse', '0698714115', 'Etudiant', NULL, 'M2 MIAGE ISIAD', 'Emprunteur'),
('75664889', 'Coralie', 'Gardet', 'CCC.CCC@etud.ut-capitole.fr', '', '18 Rue Molière 31000 Toulouse', '0684391709', 'Etudiant', NULL, 'M2 MIAGE IPM', 'Emprunteur'),
('35741568', 'Vincent', 'Mallet', 'DDD.DDD@etud.ut-capitole.fr', '', '50 Rue Dayde 31000 Toulouse', '0608496503', 'Etudiant', NULL, 'M2 MIAGE ISIAD', 'Vacataire'),
('85413601', 'Alice', 'Bassot', 'EEE.EEE@etud.ut-capitole.fr', '', '7 Rue du Luan 31000 Toulouse', '0634895147', NULL, NULL, NULL, 'Responsable'),
('$mail', '$nom', '$prenom', '$mail', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', NULL, '$tel', '$statut', NULL, '$formation', NULL),
('', 'der', 'a', '', '9cf95dacd226dcf43da376cdb6cbba7035218921', NULL, '0123456789', 'Etudiant', NULL, 'L3 MIASHS TI', NULL),
('a@gmail.com', 'der', 'a', 'a@gmail.com', '9cf95dacd226dcf43da376cdb6cbba7035218921', NULL, '0123456789', 'Etudiant', NULL, 'L3 MIASHS TI', NULL),
('test@test.com', 'test', 'test', 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', NULL, '0123456789', 'Personnel Administratif', NULL, 'L3 MIASHS TI', NULL),
('a@a.com', 'Antoine', 'test', 'a@a.com', '5a9cf67e86ca9737d77fe30e613f70ea1ef9e6b2', NULL, '0123456789', 'Etudiant', NULL, 'L3 MIASHS TI', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `probleme`
--

DROP TABLE IF EXISTS `probleme`;
CREATE TABLE IF NOT EXISTS `probleme` (
  `IdentifiantP` int(11) NOT NULL AUTO_INCREMENT,
  `NomP` text COLLATE utf8mb4_unicode_ci,
  `DateProbleme` date DEFAULT NULL,
  `DateResolution` date DEFAULT NULL,
  `Resolution` text COLLATE utf8mb4_unicode_ci,
  `Description` text COLLATE utf8mb4_unicode_ci,
  `IdentifiantPe` int(11) NOT NULL,
  `IdentifiantM` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`IdentifiantP`),
  KEY `IdentifiantPe` (`IdentifiantPe`),
  KEY `IdentifiantM` (`IdentifiantM`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `probleme`
--

INSERT INTO `probleme` (`IdentifiantP`, `NomP`, `DateProbleme`, `DateResolution`, `Resolution`, `Description`, `IdentifiantPe`, `IdentifiantM`) VALUES
(1, 'Panne', '2021-05-19', '2021-05-31', 'Problème résolu', 'Ordinateur en panne.', 22508753, 'N122342546567'),
(2, 'Autre panne', '2021-05-05', '2021-05-28', 'Non résolu', 'panne', 45628764, 'N635215328745'),
(3, 'Panne', NULL, NULL, '', 'Ordi en panne', 85413601, 'N230285049374'),
(4, 'Test Ordi N122', '2021-06-01', NULL, 'Non résolu', 'pb sur Ordi N122', 1, 'N122342546567'),
(5, 'test', '2021-06-01', NULL, 'Non résolu', 'test N122', 22508753, 'N122342546567');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
