-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 21 déc. 2020 à 18:11
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
-- Base de données : `fil-rouge`
--
CREATE DATABASE IF NOT EXISTS `fil-rouge` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fil-rouge`;

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE `answers` (
  `answer` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `questionId` int(11) NOT NULL,
  `answerId` int(11) NOT NULL,
  `isCorrect` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`answer`, `questionId`, `answerId`, `isCorrect`) VALUES
('Il est rouge', 1, 1, 1),
('Il est bleu', 1, 2, 0),
('Un super hÃ©ros ', 2, 3, 1),
('Un super mÃ©chant', 2, 4, 0),
('Oui', 3, 5, 0),
('Non', 3, 6, 0),
('Un burger', 4, 7, 0),
('Des frites', 4, 8, 0),
('Réponse 1', 5, 9, 0),
('Réponse 2', 5, 10, 0),
('Réponse 1', 6, 11, 0),
('Réponse 2', 6, 12, 0),
('hukh', 8, 15, 0),
('Réponse 1', 9, 16, 0),
('rep', 10, 17, 0),
('aze', 10, 18, 0),
('Réponse 1', 11, 19, 1),
('Réponse 3', 11, 20, NULL),
('Réponse 1', 12, 21, 1),
('123456789', 12, 22, NULL),
('Réponse 1', 13, 23, 1),
('Réponse 2', 13, 24, NULL),
('Réponse 1', 14, 25, 1),
('Réponse 2', 14, 26, NULL),
('Réponse 1', 15, 27, 1),
('Réponse 2', 15, 28, NULL),
('Réponse 1', 16, 29, 1),
('Réponse 2', 16, 30, NULL),
('Réponse 1', 17, 31, NULL),
('Réponse 2', 17, 32, NULL),
('Un jour', 21, 33, 0),
('Jamais', 21, 34, 0);

-- --------------------------------------------------------

--
-- Structure de la table `bets`
--

CREATE TABLE `bets` (
  `idOwner` int(11) NOT NULL,
  `betName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `availableAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unAvailableAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idBet` int(11) NOT NULL,
  `betCategory` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `bets`
--

INSERT INTO `bets` (`idOwner`, `betName`, `description`, `createdAt`, `availableAt`, `unAvailableAt`, `idBet`, `betCategory`) VALUES
(1, 'Les hÃ©ros marvels', 'Un petit sondage sur les hÃ©ros marvels ! ', '2020-12-02 22:30:07', '2020-12-21 00:00:00', '2020-12-21 16:31:33', 1, 1),
(2, 'Les mathÃ©matiques', 'J\'ai besoin de votre avis !', '2020-12-02 22:35:08', '2020-12-02 00:00:00', '2020-12-21 12:56:20', 2, 1),
(2, 'Mon repas', 'Un peu d\'aide pour mon repas', '2020-12-02 22:36:15', '2020-12-21 00:00:00', '2020-12-07 00:00:00', 3, 1),
(1, 'khuk', 'kuhkuhkhu', '2020-12-20 20:18:32', '2020-12-20 00:00:00', '2020-12-20 20:20:13', 11, 1),
(1, 'Le nouveau pari de la mort', 'dqzdzqdzqd', '2020-12-20 20:22:24', '2020-12-20 00:00:00', '2020-12-27 00:00:00', 12, 3),
(2, 'Le test final', 'Une petite description du pari !', '2020-12-21 17:53:14', '2020-12-21 00:00:00', '2020-12-21 17:54:05', 13, 7),
(2, 'Un autre test final', 'Un autre test final', '2020-12-21 17:56:37', '2020-12-21 00:00:00', '2020-12-21 17:57:03', 14, 3),
(2, 'Un petit pari sympa', 'Une petite description sympa', '2020-12-21 17:58:25', '2020-12-21 00:00:00', '2020-12-21 17:58:54', 15, 2),
(1, 'Un nouveau pari sur le sport', 'Un petit pari sur le sport', '2020-12-21 18:03:43', '2020-12-21 00:00:00', '2021-01-10 00:00:00', 16, 1),
(1, 'Superman', 'Une date de sortie ?', '2020-12-21 18:08:35', '2020-12-21 00:00:00', '2020-12-31 00:00:00', 17, 4),
(1, 'Superman', 'Une date de sortie ?', '2020-12-21 18:09:30', '2020-12-21 00:00:00', '2020-12-31 00:00:00', 18, 4),
(1, 'Superman', 'Une date de sortie ?', '2020-12-21 18:10:16', '2020-12-21 00:00:00', '2020-12-31 00:00:00', 19, 4),
(1, 'Superman', 'Une date de sortie ?', '2020-12-21 18:10:23', '2020-12-21 00:00:00', '2020-12-31 00:00:00', 20, 4);

-- --------------------------------------------------------

--
-- Structure de la table `bet_categories`
--

CREATE TABLE `bet_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `miniature` varchar(255) DEFAULT NULL,
  `code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bet_categories`
--

INSERT INTO `bet_categories` (`id`, `name`, `miniature`, `code`) VALUES
(1, 'Sport', 'example-miniature.jpg', 'sport'),
(2, 'Jeux vidéo', 'example-miniature.jpg', 'jeux-video'),
(3, 'Informatique', 'example-miniature.jpg', 'informatique'),
(4, 'Films', 'example-miniature.jpg', 'films'),
(5, 'Séries', 'example-miniature.jpg', 'series'),
(6, 'Marques', 'example-miniature.jpg', 'marques'),
(7, 'Emissions TV', 'example-miniature.jpg', 'emission-tv');

-- --------------------------------------------------------

--
-- Structure de la table `bet_participation`
--

CREATE TABLE `bet_participation` (
  `idUser` int(11) NOT NULL,
  `idBet` int(11) NOT NULL,
  `idParticipation` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `pass` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bet_participation`
--

INSERT INTO `bet_participation` (`idUser`, `idBet`, `idParticipation`, `payment`, `pass`) VALUES
(1, 3, 1, 10, 1),
(1, 13, 2, 20, 1),
(1, 14, 3, 10, 1),
(1, 15, 4, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `idUser` int(11) NOT NULL,
  `idFriend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`idUser`, `idFriend`) VALUES
(1, 5),
(5, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE `questions` (
  `question` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idBet` int(11) NOT NULL,
  `questionOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`question`, `idQuestion`, `idBet`, `questionOrder`) VALUES
('A quoi ressemble spiderman ?', 1, 1, 0),
('Qui est captain America ?', 2, 1, 1),
('Vous aimez les maths ?', 3, 2, 0),
('Demain je mange quoi ?', 4, 3, 0),
('Question 1 ?', 5, 6, 0),
('Question 1 ?', 6, 7, 0),
('kuhk', 8, 11, 0),
('Question 1 ?', 9, 12, 0),
('Question 2 ?', 10, 12, 1),
('Question 1 ?', 11, 13, 0),
('Question 2 ?', 12, 13, 1),
('Question 1 ?', 13, 14, 0),
('Question 2 ?', 14, 14, 1),
('Question 1 ?', 15, 15, 0),
('Question 2 ?', 16, 15, 1),
('Question 1 ?', 17, 16, 0),
('Il sort quand ?', 18, 17, 0),
('Il sort quand ?', 19, 18, 0),
('Il sort quand ?', 20, 19, 0),
('Il sort quand ?', 21, 20, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tchatmessages`
--

CREATE TABLE `tchatmessages` (
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  `idUser` int(11) NOT NULL,
  `idFriend` int(11) NOT NULL,
  `idMessage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tchatmessages`
--

INSERT INTO `tchatmessages` (`message`, `createdAt`, `idUser`, `idFriend`, `idMessage`) VALUES
('Merci d\'avoir répondu !', '2020-12-02 22:34:13', 1, 2, 1),
('Merci !', '2020-12-02 22:36:30', 2, 1, 2),
('bonjour', '2020-12-21 12:21:47', 1, 2, 3),
('salut', '2020-12-21 12:23:21', 1, 2, 4),
('ça va ?', '2020-12-21 12:23:50', 2, 1, 5),
('Salut', '2020-12-21 12:23:58', 2, 1, 6),
('Comment tu vs ?', '2020-12-21 12:24:08', 1, 2, 7),
('dzqd', '2020-12-21 12:25:37', 1, 2, 8),
('fesfes', '2020-12-21 12:25:59', 1, 2, 9),
('dqzd', '2020-12-21 12:26:31', 1, 2, 10),
('dzqd', '2020-12-21 12:26:35', 1, 2, 11),
('Salut', '2020-12-21 12:28:23', 2, 1, 12),
('salut', '2020-12-21 13:29:38', 1, 5, 13),
('trkl ?', '2020-12-21 13:29:45', 5, 1, 14),
('dé', '2020-12-21 17:59:22', 1, 2, 15);

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
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`firstName`, `lastName`, `email`, `password`, `idUser`, `username`, `points`) VALUES
('MarioMars', 'DuPon', 'mario@mail.com', '$2y$10$UgD4prFjyuDHJp2hm8AjheU/.j.jKbQo9IYh.d4G/xPoTykFGX0YW', 1, 'Mario2206', 384),
('Leïa', 'Mirtille', 'derf@mail.com', '$2y$10$wU11d7lkgPWldP8UPwK8QOauMdawXh09Hpr1HMPL/DcOV/UA.wl92', 2, 'Derf2505', 470),
('toto', 'mars', 'toto@mail.com', '$2y$10$Dtr8jcr2XfvkkjgTqK0LoeR/Se6ynbTq1GwLnT9NSpyJK1bMKeZYW', 5, 'toto1510', 490);

-- --------------------------------------------------------

--
-- Structure de la table `user_answers`
--

CREATE TABLE `user_answers` (
  `idUser` int(11) NOT NULL,
  `idAnswer` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_answers`
--

INSERT INTO `user_answers` (`idUser`, `idAnswer`, `idQuestion`) VALUES
(1, 7, 4),
(1, 19, 11),
(1, 21, 12),
(1, 23, 13),
(1, 25, 14),
(1, 27, 15),
(1, 29, 16);

-- --------------------------------------------------------

--
-- Structure de la table `user_payment`
--

CREATE TABLE `user_payment` (
  `paymentId` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idParticipation` int(11) NOT NULL,
  `payment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user_payment`
--

INSERT INTO `user_payment` (`paymentId`, `idUser`, `idParticipation`, `payment`) VALUES
(1, 5, 2, 10),
(2, 2, 1, 20),
(3, 2, 1, 10),
(4, 1, 3, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answerId`);

--
-- Index pour la table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`idBet`),
  ADD KEY `bet` (`betCategory`);

--
-- Index pour la table `bet_categories`
--
ALTER TABLE `bet_categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bet_participation`
--
ALTER TABLE `bet_participation`
  ADD PRIMARY KEY (`idParticipation`);

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
-- Index pour la table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
  MODIFY `answerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `bets`
--
ALTER TABLE `bets`
  MODIFY `idBet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `bet_categories`
--
ALTER TABLE `bet_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `bet_participation`
--
ALTER TABLE `bet_participation`
  MODIFY `idParticipation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
  MODIFY `idQuestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `tchatmessages`
--
ALTER TABLE `tchatmessages`
  MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bets`
--
ALTER TABLE `bets`
  ADD CONSTRAINT `bets_ibfk_1` FOREIGN KEY (`betCategory`) REFERENCES `bet_categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
