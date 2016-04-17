-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 17 Avril 2016 à 14:46
-- Version du serveur :  10.1.10-MariaDB
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zecollection`
--

-- --------------------------------------------------------

--
-- Structure de la table `consoles`
--
DROP TABLE IF EXISTS `consoles`;
CREATE TABLE `consoles` (
  `console_id` int(11) NOT NULL,
  `console_name` varchar(20) NOT NULL,
  `console_brand` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consoles`
--

INSERT INTO `consoles` (`console_id`, `console_name`, `console_brand`, `user_id`) VALUES
(1, 'Mega Drive', 'SEGA', 3),
(2, 'Playstation 2', 'SONY', 3);

-- --------------------------------------------------------

--
-- Structure de la table `games`
--
DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
  `game_id` int(11) NOT NULL,
  `bar_code` varchar(20) DEFAULT NULL,
  `game_name` varchar(50) NOT NULL,
  `VERSION` varchar(40) DEFAULT NULL,
  `editor` varchar(30) DEFAULT NULL,
  `developer` varchar(30) DEFAULT NULL,
  `release_year` int(4) DEFAULT NULL,
  `console_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `games`
--

INSERT INTO `games` (`game_id`, `bar_code`, `game_name`, `VERSION`, `editor`, `developer`, `release_year`, `console_id`) VALUES
(2, '010086010152', 'Castle of Illusion Starring Mickey Mouse', 'Genesis', 'Sega', 'Sega', 1990, 1),
(3, NULL, 'Ecco the Dolphin', NULL, 'Sega', 'Novotrade International', 1992, 1),
(4, NULL, 'Okami', NULL, NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Structure de la table `items`
--
DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `boite` tinyint(1) NOT NULL,
  `calpin` tinyint(1) NOT NULL,
  `jeux` tinyint(1) NOT NULL,
  `price` float DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`item_id`, `user_id`, `game_id`, `boite`, `calpin`, `jeux`, `price`, `notes`) VALUES
(1, 3, 2, 1, 1, 1, NULL, 'Bon état'),
(2, 3, 3, 0, 0, 1, 2.99, NULL),
(3, 3, 4, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `owner`
--
DROP TABLE IF EXISTS `owner`;
CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `owner_label` varchar(120) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `owner`
--

INSERT INTO `owner` (`owner_id`, `owner_label`, `user_id`) VALUES
(1, 'Quentin', 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `PASSWORD` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `PASSWORD`) VALUES
(1, 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(3, 'firebones', 'c600599a70d2d79353a6e8d20ba8bbc1802f765f');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`console_id`),
  ADD UNIQUE KEY `console_name` (`console_name`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`game_id`),
  ADD UNIQUE KEY `bar_code` (`bar_code`),
  ADD KEY `console_id` (`console_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Index pour la table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `console_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `consoles`
--
ALTER TABLE `consoles`
  ADD CONSTRAINT `consoles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `games`
--
ALTER TABLE `games`
  ADD CONSTRAINT `games_ibfk_1` FOREIGN KEY (`console_id`) REFERENCES `consoles` (`console_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `games` (`game_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
