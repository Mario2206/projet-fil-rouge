-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 02 déc. 2020 à 22:38
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sondage-amis`
--
CREATE DATABASE IF NOT EXISTS `sondage-amis` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sondage-amis`;

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `answer` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `questionId` int(11) NOT NULL,
  `answerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`answer`, `questionId`, `answerId`) VALUES
('Il est rouge', 1, 1),
('Il est bleu', 1, 2),
('Un super hÃ©ros ', 2, 3),
('Un super mÃ©chant', 2, 4),
('Oui', 3, 5),
('Non', 3, 6),
('Un burger', 4, 7),
('Des frites', 4, 8);

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `idUser` int(11) NOT NULL,
  `idFriend` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`idUser`, `idFriend`, `accepted`) VALUES
(2, 1, 1),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `poll`
--

CREATE TABLE `poll` (
  `idUser` int(11) NOT NULL,
  `pollName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `availableAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unAvailableAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idPoll` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `poll`
--

INSERT INTO `poll` (`idUser`, `pollName`, `description`, `createdAt`, `availableAt`, `unAvailableAt`, `idPoll`) VALUES
(1, 'Les hÃ©ros marvels', 'Un petit sondage sur les hÃ©ros marvels ! ', '2020-12-02 22:30:07', '2020-12-02 00:00:00', '2020-12-09 00:00:00', 1),
(2, 'Les mathÃ©matiques', 'J\'ai besoin de votre avis !', '2020-12-02 22:35:08', '2020-12-02 00:00:00', '2020-12-18 00:00:00', 2),
(2, 'Mon repas', 'Un peu d\'aide pour mon repas', '2020-12-02 22:36:15', '2020-12-02 00:00:00', '2020-12-16 00:00:00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `question` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idPoll` int(11) NOT NULL,
  `questionOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`question`, `idQuestion`, `idPoll`, `questionOrder`) VALUES
('A quoi ressemble spiderman ?', 1, 1, 0),
('Qui est captain America ?', 2, 1, 1),
('Vous aimez les maths ?', 3, 2, 0),
('Demain je mange quoi ?', 4, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tchatmessages`
--

CREATE TABLE `tchatmessages` (
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  `idPoll` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tchatmessages`
--

INSERT INTO `tchatmessages` (`message`, `createdAt`, `idUser`, `idPoll`, `idMessage`) VALUES
('Merci d\'avoir rÃ©pondu !', '2020-12-02 22:34:13', 1, 1, 1),
('Merci !', '2020-12-02 22:36:30', 1, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user-answers`
--

CREATE TABLE `user-answers` (
  `idUser` int(11) NOT NULL,
  `idAnswer` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user-answers`
--

INSERT INTO `user-answers` (`idUser`, `idAnswer`, `idQuestion`) VALUES
(2, 2, 1),
(2, 3, 2),
(1, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `firstName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `idUser`, `username`) VALUES
('MarioMars', 'DuPon', 'mario@mail.com', '$2y$10$UgD4prFjyuDHJp2hm8AjheU/.j.jKbQo9IYh.d4G/xPoTykFGX0YW', 1, 'Mario2206'),
('LeÃ¯la', 'Mirtille', 'derf@mail.com', '$2y$10$wU11d7lkgPWldP8UPwK8QOauMdawXh09Hpr1HMPL/DcOV/UA.wl92', 2, 'Derf2505');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answerId`);

--
-- Index pour la table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`idPoll`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idQuestion`);

--
-- Index pour la table `tchatmessages`
--
ALTER TABLE `tchatmessages`
  ADD PRIMARY KEY (`idMessage`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `answerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `poll`
--
ALTER TABLE `poll`
  MODIFY `idPoll` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tchatmessages`
--
ALTER TABLE `tchatmessages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
