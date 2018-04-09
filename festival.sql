-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 09 Octobre 2017 à 14:51
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribution`
--

CREATE TABLE IF NOT EXISTS `attribution` (
  `idCentre` char(8) NOT NULL,
  `idEquipe` char(4) NOT NULL,
  `nombreChambres` int(11) NOT NULL,
  PRIMARY KEY (`idCentre`,`idEquipe`),
  KEY `fk2_Attribution` (`idEquipe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `attribution`
--

INSERT INTO `attribution` (`idCentre`, `idEquipe`, `nombreChambres`) VALUES
('0350123A', 'g004', 13),
('0350123A', 'g005', 8),
('0350123A', 'g009', 18),
('0350123A', 'g008', 7),
('0350785N', 'g001', 11),
('0350785N', 'g002', 9),
('0350785N', 'g007', 15),
('0350785N', 'g012', 4),
('0351234W', 'g011', 3),
('0351234W', 'g006', 10),
('0351234W', 'g015', 12),
('0351234W', 'g016', 22),
('0350124B', 'g014', 21),
('0350124B', 'g003', 16),
('0350124B', 'g013', 17),
('0350124B', 'g010', 12);

-- --------------------------------------------------------

--
-- Structure de la table `centre`
--

CREATE TABLE IF NOT EXISTS `centre` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `adresseRue` varchar(45) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(35) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `adresseElectronique` varchar(70) DEFAULT NULL,
  `type` tinyint(4) NOT NULL,
  `civiliteResponsable` varchar(12) NOT NULL,
  `nomResponsable` varchar(25) NOT NULL,
  `prenomResponsable` varchar(25) DEFAULT NULL,
  `nombreChambresOffertes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `centre`
--

INSERT INTO `centre` (`id`, `nom`, `adresseRue`, `codePostal`, `ville`, `tel`, `adresseElectronique`, `type`, `civiliteResponsable`, `nomResponsable`, `prenomResponsable`, `nombreChambresOffertes`) VALUES
('0350123A', 'Centre Sportif de Metz', '3, avenue des corsaires', '57000', 'Metz', '0299561459', NULL, 1, 'Mme', 'Lefort', 'Anne', 58),
('0350785N', 'Centre Sportif de Nancy', '2 avenue Aristide Briand BP 6', '54000', 'Nancy', '0299206990', NULL, 1, 'M.', 'Dupont', 'Alain', 50),
('0351234W', 'Centre Sportif de Epinal', '2 rue Rabelais', '88000', 'Epinal', '0299117474', NULL, 1, 'M.', 'Durand', 'Pierre', 60),
('0350124B', 'Centre Sportif de Bar-le-duc', '37 avenue du R.P. Umbricht BP 108', '55000', 'Barleduc', '0299000000', NULL, 0, 'M.', 'Guenroc', 'Guy', 200);

-- --------------------------------------------------------

--
-- Structure de la table `equipe`
--

CREATE TABLE IF NOT EXISTS `equipe` (
  `id` char(4) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `identiteResponsable` varchar(40) DEFAULT NULL,
  `adressePostale` varchar(120) DEFAULT NULL,
  `nombrePersonnes` int(11) NOT NULL,
  `nomPays` varchar(40) NOT NULL,
  `hebergement` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `equipe`
--

INSERT INTO `equipe` (`id`, `nom`, `identiteResponsable`, `adressePostale`, `nombrePersonnes`, `nomPays`, `hebergement`) VALUES
('g001', 'Manchester City Football', NULL, NULL, 22, 'Angleterre', 'O'),
('g002', 'Olympique Lyonnais Football', NULL, NULL, 22, 'France', 'O'),
('g003', 'Athletico Madrid Football', NULL, NULL, 22, 'Espagne', 'O'),
('g004', 'Juventus de Turin Football', NULL, NULL, 22, 'Italie', 'O'),
('g005', 'Anderlecht Football', NULL, NULL, 22, 'Belgique', 'O'),
('g006', 'FC Porto Football', NULL, NULL, 22, 'Portugal', 'O'),
('g007', 'Manchester United Football', NULL, NULL, 22, 'Angleterre', 'O'),
('g008', 'Celtic FC Football', NULL, NULL, 22, 'Ecosse', 'O'),
('g009', 'FC Barcelone Football', NULL, NULL, 22, 'Espagne', 'O'),
('g010', 'Paris Saint Germain Football', NULL, NULL, 22, 'France', 'O'),
('g011', 'Cleveland Basketball', NULL, NULL, 30, 'Etats-Unis', 'O'),
('g012', 'Nanterre Basketball', NULL, NULL, 22, 'France', 'O'),
('g013', 'FC Barcelone Basketball', NULL, NULL, 13, 'Espagne', 'O'),
('g014', 'Paris Levallois Basketball', NULL, NULL, 26, 'France', 'O'),
('g015', 'Giants New York FootballAmericain', NULL, NULL, 8, 'Etats-Unis', 'O'),
('g016', 'Flash Courneuve FootballAmericain', NULL, NULL, 40, 'France', 'O');


--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `attribution`
--
ALTER TABLE `attribution`
  ADD CONSTRAINT `fk1_Attribution` FOREIGN KEY (`idCentre`) REFERENCES `centre` (`id`),
  ADD CONSTRAINT `fk2_Attribution` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
