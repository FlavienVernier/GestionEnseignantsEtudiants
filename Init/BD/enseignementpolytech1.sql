-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mar. 08 sep. 2020 à 15:54
-- Version du serveur :  5.7.28
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
-- Base de données :  `enseignementpolytech1`
--

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `idcours` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('CM','TD','TP') NOT NULL,
  `datecours` datetime NOT NULL,
  `duree` float NOT NULL,
  `idmodule` int(11) DEFAULT NULL,
  `idenseignant` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcours`),
  KEY `foreign_key_idmodule` (`idmodule`),
  KEY `foreign_key_enseignant` (`idenseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `idenseignant` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `type` enum('permanant','vacataire') NOT NULL,
  `service` int(11) NOT NULL,
  `heuresup` enum('oui','non') NOT NULL,
  PRIMARY KEY (`idenseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `idetudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `promo` int(11) NOT NULL,
  `filiere` varchar(15) NOT NULL,
  `groupetd` varchar(15) NOT NULL,
  `groupetp` varchar(15) NOT NULL,
  PRIMARY KEY (`idetudiant`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `fichesabsences`
--

DROP TABLE IF EXISTS `fichesabsences`;
CREATE TABLE IF NOT EXISTS `fichesabsences` (
  `idfiche` int(11) NOT NULL AUTO_INCREMENT,
  `dateday` datetime NOT NULL,
  `filiere` enum('EBE','IAI','IDU','ITII','ITII-CM','ITII-MP','MM') NOT NULL,
  `promo` int(11) NOT NULL,
  `iddescours` text NOT NULL,
  PRIMARY KEY (`idfiche`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Structure de la table `justification`
--

DROP TABLE IF EXISTS `justification`;
CREATE TABLE IF NOT EXISTS `justification` (
  `idtemps` int(11) NOT NULL AUTO_INCREMENT,
  `datedebut` int(11) NOT NULL,
  `datefin` int(11) NOT NULL,
  `justification` varchar(200) NOT NULL,
  `idetudiant` int(11) NOT NULL,
  PRIMARY KEY (`idtemps`),
  KEY `foreignkeyetudiant` (`idetudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `module`
--

DROP TABLE IF EXISTS `module`;
CREATE TABLE IF NOT EXISTS `module` (
  `Idmodule` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `semestre` int(11) NOT NULL,
  `heurescm` int(11) NOT NULL,
  `heurestd` int(11) NOT NULL,
  `heurestp` int(11) NOT NULL,
  `idenseignant` int(11) DEFAULT NULL,
  PRIMARY KEY (`Idmodule`),
  KEY `foreign_key_enseignant` (`idenseignant`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

DROP TABLE IF EXISTS `presence`;
CREATE TABLE IF NOT EXISTS `presence` (
  `idetudiant` int(11) NOT NULL,
  `idcours` int(11) NOT NULL,
  `presence` enum('present','absent') DEFAULT NULL,
  `justificatif` enum('oui','non') NOT NULL DEFAULT 'non',
  KEY `foreign_key_etudiant` (`idetudiant`),
  KEY `foreign_key_cours` (`idcours`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`idmodule`) REFERENCES `module` (`Idmodule`),
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`idenseignant`) REFERENCES `enseignant` (`idenseignant`);

--
-- Contraintes pour la table `justification`
--
ALTER TABLE `justification`
  ADD CONSTRAINT `justification_ibfk_1` FOREIGN KEY (`idetudiant`) REFERENCES `etudiant` (`idetudiant`);

--
-- Contraintes pour la table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`idenseignant`) REFERENCES `enseignant` (`idenseignant`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`idetudiant`) REFERENCES `etudiant` (`idetudiant`),
  ADD CONSTRAINT `presence_ibfk_2` FOREIGN KEY (`idcours`) REFERENCES `cours` (`idcours`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
