-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 22 avr. 2020 à 14:08
-- Version du serveur :  5.7.24
-- Version de PHP : 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum_vir`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `user_id`, `post_id`, `creationdate`) VALUES
(1, '<p>test</p>\r\n<p>&nbsp;</p>', 1, 35, '2020-04-22 11:16:00'),
(2, '<p>re</p>', 1, 35, '2020-04-22 11:16:37'),
(3, 'n nj j j j', 1, 39, '2020-04-22 13:51:00'),
(4, 'kjhjhk jhbhkb k', 1, 39, '2020-04-22 13:59:43'),
(5, 'comment\r\n', 4, 41, '2020-04-22 16:00:33'),
(6, 'jnjnjn\r\n', 4, 39, '2020-04-22 16:06:47');

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id_post`, `content`, `user_id`, `topic_id`, `creationdate`) VALUES
(3, 'test', 1, 9, '2020-04-17 14:02:18'),
(8, 'essai message supp', 4, 9, '2020-04-18 12:04:16'),
(9, 'un autre', 4, 9, '2020-04-18 12:04:26'),
(30, 'hvhvvhvh', 4, 10, '2020-04-20 14:03:49'),
(33, 'message pour &nbsp;', 1, 13, '2020-04-22 08:55:27'),
(34, '<p>test</p>', 1, 14, '2020-04-22 11:11:39'),
(35, '<p>re</p>', 1, 15, '2020-04-22 11:12:00'),
(36, '<p>test</p>', 1, 15, '2020-04-22 11:14:17'),
(37, '<p>jhbjhbjhbjbb</p>', 1, 10, '2020-04-22 11:28:14'),
(38, '<p>bim</p>', 1, 16, '2020-04-22 11:43:56'),
(39, 'tutututut', 1, 17, '2020-04-22 11:44:10'),
(40, 'test', 1, 17, '2020-04-22 13:45:04'),
(41, 'kjknbibibibi', 1, 17, '2020-04-22 14:03:22'),
(42, 'essai message\r\n', 4, 17, '2020-04-22 16:00:17');

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE `signalement` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE `topic` (
  `id_topic` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `creationdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `closed` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `topic`
--

INSERT INTO `topic` (`id_topic`, `title`, `creationdate`, `user_id`, `closed`) VALUES
(9, 'test', '2020-04-17 14:02:18', 1, 0),
(10, 'sujet 2', '2020-04-17 14:06:03', 1, 0),
(13, 'Sujet après affich topic', '2020-04-17 17:29:17', 1, 0),
(14, 'test js', '2020-04-22 11:11:39', 1, 0),
(15, 're', '2020-04-22 11:12:00', 1, 0),
(16, 'bim', '2020-04-22 11:43:56', 1, 0),
(17, 'bim', '2020-04-22 11:44:10', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `registerdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `roles` json DEFAULT NULL,
  `avatar` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `connected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `registerdate`, `roles`, `avatar`, `connected`) VALUES
(1, 'zzpapy', 'gregory.pace@hotmail.fr', '$argon2i$v=19$m=1024,t=2,p=2$MU8vbEtqek1oWUR6OGwyZw$nCWN7R8B2/8YVwMrqQ6X97qrCAntQHtP6+tCl2ruFNc', '2020-04-15 13:40:25', '[\"ROLE_USER\", \"ROLE_ADMIN\"]', 'public/img/acheter-un-chat (1).jpg', 1),
(2, 'test', 'toto@hotmail.fr', '$argon2i$v=19$m=1024,t=2,p=2$a1pkZE1GT0pWaVhJS1NFOQ$ySTQ6oWB4WCFa2QT64BBlwjIOF+ELzjLAVjFcQqPrX0', '2020-04-17 10:47:38', '[\"ROLE_USER\"]', 'public/img/mau_egyptien_med-_res-___basic.png', 1),
(4, 'hjbhubjb', 'toto@toto.com', '$argon2i$v=19$m=1024,t=2,p=2$eVJGemw3QndoWkxFejIxNw$6GEfhWyYnqOlTSFqcMC5vzxJJtTvEpeuVBhYDuyil5E', '2020-04-18 11:17:19', '[\"ROLE_USER\"]', 'public/img/acheter-un-chat (1).jpg', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `user_id_FK` (`user_id`),
  ADD KEY `post_id_FK` (`post_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `usert_ibfk_1` (`user_id`),
  ADD KEY `topic_ibfk_2` (`topic_id`);

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD KEY `user_FK` (`user_id`),
  ADD KEY `post_FK` (`post_id`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id_topic`),
  ADD KEY `FK_topic_user` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
  MODIFY `id_topic` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `post_id_FK` FOREIGN KEY (`post_id`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usert_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD CONSTRAINT `post_FK` FOREIGN KEY (`post_id`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
