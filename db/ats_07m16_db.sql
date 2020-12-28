-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 12 Mai 2016 à 23:28
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `ats_07m16_db`
--
CREATE DATABASE IF NOT EXISTS `ats_07m16_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ats_07m16_db`;

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE IF NOT EXISTS `abonnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(18) NOT NULL,
  `volume` varchar(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `type`, `volume`, `description`) VALUES
(1, 'Mensuel', '256/256', '120$ le mois'),
(2, 'Mensuel', '128/512', '220$ le mois');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse` varchar(128) NOT NULL COMMENT 'json format',
  `contact` varchar(128) NOT NULL COMMENT 'json format',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `adresse`, `contact`) VALUES
(1, 'Marcellin', '{province : Nord-Kivu,ville : Goma,adresse :Himbi II, du Lac, 260}', '{tel : 0993803355,email : marcwabo20@gmail.com}'),
(2, 'Justin', '{province : Nord-Kivu,ville : Goma,adresse :Himbi II, du Lac, 260}', '{tel : 0993803355,email : marcwabo20@gmail.com}'),
(3, 'Taimos', '{province : Nord-Kivu,ville : Goma,adresse :Himbi II, du Lac, 260}', '{tel : 0993803355,email : marcwabo20@gmail.com}'),
(4, 'HAD ONGD', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : hadongd@had.com}'),
(5, 'HAD ONGD', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : hadongd@had.com}'),
(6, 'COTEC', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : hadongd@had.com}'),
(7, 'HAD ONGD', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(8, 'ATOM System', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(9, 'Cyber Tropical', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(10, 'Cyber Tropical', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(11, 'Cyber Tropical', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(12, 'Cyber Tropical', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(13, 'Cyber Tropical', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(14, 'Cyber Tropical', '{province : Nord-Kivu,ville : Goma,adresse :Kyeshero, Av Mulu, 5}', '{tel : 09998881166,email : marcwabo20@gmail.com}'),
(15, 'IHUSI Hotel', '{province : Nord-Kivu,ville : Goma,adresse :Himbi II, du Lac, 260}', '{tel : 09998881166,email : ihusi@ihusi.org}');

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

CREATE TABLE IF NOT EXISTS `facturation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `abonnement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`client_id`,`abonnement_id`),
  KEY `fk_facturation_client` (`client_id`),
  KEY `fk_facturation_abonnement1` (`abonnement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `facturation`
--

INSERT INTO `facturation` (`id`, `date`, `client_id`, `abonnement_id`) VALUES
(1, '2016-05-11', 14, 2),
(2, '2016-05-12', 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE IF NOT EXISTS `rapport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `date` date NOT NULL,
  `abonnement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`abonnement_id`),
  KEY `fk_rapport_abonnement1` (`abonnement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `role` varchar(10) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(96) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `role`, `username`, `password`) VALUES
(1, 'Marcellin', 'su', 'marcw', 'fcacf366e100ec0f419f6a2c3999047df8328a4c'),
(2, 'Willy', 'Admin', 'will', 'fcacf366e100ec0f419f6a2c3999047df8328a4c'),
(3, 'Richie', 'Simple', 'rico', 'fcacf366e100ec0f419f6a2c3999047df8328a4c');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD CONSTRAINT `fk_facturation_abonnement1` FOREIGN KEY (`abonnement_id`) REFERENCES `abonnement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_facturation_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `fk_rapport_abonnement1` FOREIGN KEY (`abonnement_id`) REFERENCES `abonnement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
