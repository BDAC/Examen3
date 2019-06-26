-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 26 juin 2019 à 16:29
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `immobilier-dav`
--
CREATE DATABASE IF NOT EXISTS `immobilier-dav` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `immobilier-dav`;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `titre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cp` int(11) NOT NULL,
  `surface` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(20, 'Maison à la montagne', '78, Rue du Parc', 'Chambery', 73000, 40, 112000, 'logement_20.jpg', 'Vente', '40 m2 de séduction, 2 chambres, une cuisine séparée et un beau salon n\'attendent que vous! A vous de la faire évoluer. Surprenante par son volume, sa situation privilégiée vous offre une détente assurée.'),
(21, 'Appartement 2p, refait a neuf', '12, Route de la Faluère', 'Paris', 75012, 36, 400000, 'logement_21.jpg', 'Vente', 'Ledru Rollin, proche Bastille et Gare de Lyon, appartement 2 pièces, refait à neuf Au 4e étage sans ascenseur d\'un immeuble ancien et propre, sur cour, clair et calme, Composé d\'une entrée-séjour avec cuisine ouverte équipée, salle de douche, wc, vasque, une grande chambre.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
