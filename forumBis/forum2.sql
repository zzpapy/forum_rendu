-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 22 avr. 2020 à 14:50
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
-- Base de données : `forum2`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `groupe_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`groupe_id`, `membre_id`, `date`) VALUES
(3, 20, '2020-04-15 12:00:11'),
(3, 21, '2020-04-15 12:13:03');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(11) NOT NULL,
  `nom` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `membre_id` int(11) NOT NULL,
  `sujet_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(1000) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `nom`, `membre_id`, `sujet_id`, `date`, `photo`) VALUES
(3, 'toto', 18, NULL, '2020-04-15 12:00:11', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `groupe_sujet`
--

CREATE TABLE `groupe_sujet` (
  `sujet_id` int(11) NOT NULL,
  `groupe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(1000) COLLATE utf8_bin NOT NULL,
  `connected` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `date`, `password`, `connected`) VALUES
(18, 'zzpapy', NULL, '$2y$10$naNz6awItxS9j86Rtq4Yn.hwd4W4moMeoNUOtglvE5klpN2CJfOL.', 0),
(19, 'bob', NULL, '$2y$10$9jChav7LjXpZwpr0c6UkvOpmrOyoh.ZQ0n3nGHtrqCh1TBvsF4h3G', 0),
(20, 'test', NULL, '$2y$10$SbDEF0Z3X3Y5MkJ2d.uW3.0XTCOxmVqYAwrlSwq9sVqf3f/fwGxfG', 0),
(21, 'test1', NULL, '$2y$10$ID8Wo4O5SyYAe0G3Nn.T9O.WM3Vz.Lq3l9Or3RHL3yr7cGJ9dsX3m', 0),
(22, 'test2', NULL, '$2y$10$OipTQ5eXnG0pGfCLXwiXEOWUn50TuOwxr2v8YLxu2r696zwktAnoS', 0),
(23, 'time', '2020-04-05 17:15:16', '$2y$10$7ehDsjBAdNLdEFmZF0WtLusrt2ynrRxpXDrd94PlcdQxk4e//poZa', 0),
(24, 'bbbbb', '2020-04-06 17:27:42', '$2y$10$2N.9uv7sM/L5n0wtvRP1ROUKb08b5eKr/pmFaD130Z2tEPU7xBcxi', 0),
(25, 'nopass', '2020-04-07 11:04:22', '$2y$10$ck16UfaQ5vf/E3TI34D8POrfgMA23t/kiohI8xREqMzx9RGdnTDPS', 0),
(26, 'h', '2020-04-07 17:45:25', '$2y$10$QjZ3J6L1c74GD2Gd.Rxj3Oo1CeE.qLkQHG1owFqIHsOVYr.Au4a5S', 0);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL,
  `content` text COLLATE utf8_bin,
  `membre_id` int(11) NOT NULL,
  `sujet_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `photo` varchar(256) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `content`, `membre_id`, `sujet_id`, `date`, `photo`) VALUES
(445, 'essai message nouvelle version', 19, 108, '2020-04-04 08:55:19', 'public/images/acheter-un-chat.jpg'),
(447, 'essai message', 20, 113, '2020-04-04 10:26:34', '\r\n'),
(451, ',nkjnojinbgvtrcrtc', 20, 115, '2020-04-04 10:56:55', 'public/images/'),
(452, 'sgzegrzegzgtzrgzrtgzrgztgzegz', 21, 114, '2020-04-04 10:57:50', 'public/images/acheter-un-chat (1).jpg'),
(454, 'aaaaaaaaaaaaaaaaa', 20, 116, '2020-04-04 11:18:36', 'public/images/'),
(456, 'mess test1', 21, 117, '2020-04-04 11:20:02', 'public/images/'),
(457, 'mess bob', 19, 118, '2020-04-04 11:20:51', 'public/images/'),
(458, 'mess test', 20, 117, '2020-04-04 11:21:23', 'public/images/'),
(459, 'test de modif avec bob', 19, 119, '2020-04-04 11:22:38', 'public/images/'),
(460, 'test test', 20, 119, '2020-04-04 11:23:00', 'public/images/'),
(461, 'est ce que ça marche variment?', 22, 119, '2020-04-04 11:27:56', 'public/images/'),
(462, 'test photo', 19, 119, '2020-04-04 13:27:30', 'public/images/'),
(463, 're', 19, 119, '2020-04-04 13:30:35', 'public/images/'),
(464, 're', 19, 119, '2020-04-04 13:31:08', 'public/images/'),
(465, 'nb', 19, 120, '2020-04-04 13:34:19', NULL),
(466, 'in', 19, 120, '2020-04-04 13:34:28', 'public/images/388923_2019_Porsche_Cayenne.jpg'),
(467, '??????', 19, 123, '2020-04-04 13:35:46', NULL),
(468, 'ca marche?', 20, 123, '2020-04-04 13:36:20', 'public/images/acheter-un-chat.jpg'),
(469, 'donc je modifie', 18, 124, '2020-04-04 14:22:17', 'public/images/388923_2019_Porsche_Cayenne.jpg'),
(470, 'coucou', 18, 124, '2020-04-04 14:48:35', 'public/images/eduquer-un-chat-fb-59ad52663bd71.jpg'),
(473, 'b', 19, 128, '2020-04-05 15:09:32', NULL),
(474, 'n', 19, 128, '2020-04-05 15:09:38', NULL),
(475, 'v', 19, 128, '2020-04-05 15:09:49', NULL),
(476, 'j', 19, 128, '2020-04-05 15:10:22', NULL),
(477, 'b', 19, 128, '2020-04-05 15:12:24', NULL),
(478, 'test', 23, 128, '2020-04-05 18:42:37', NULL),
(479, 'test mess affich', 23, 128, '2020-04-05 18:42:48', NULL),
(480, 'test', 18, 128, '2020-04-06 08:48:34', 'public/images/acheter-un-chat.jpg'),
(481, 'retest', 18, 130, '2020-04-07 09:55:30', NULL),
(482, 'test', 18, 130, '2020-04-07 09:55:37', 'public/images/acheter-un-chat.jpg'),
(483, 'alert(&#34;toto)', 18, 130, '2020-04-07 09:56:09', NULL),
(484, 'alert(&#34;toto)', 20, 130, '2020-04-07 11:57:34', NULL),
(485, 'test', 18, 134, '2020-04-07 15:36:12', NULL),
(486, 'v', 26, 135, '2020-04-07 15:45:58', 'public/images/acheter-un-chat.jpg'),
(487, 'test', 20, 158, '2020-04-07 16:47:45', NULL),
(489, 'test', 20, 157, '2020-04-07 16:57:28', NULL),
(490, 'merde', 20, 157, '2020-04-07 16:58:22', NULL),
(491, 'test', 20, 156, '2020-04-07 16:58:40', NULL),
(494, 'un petite message essayé avec le palce holder .\r\npour voir ce que ça donne\r\n\r\n\r\n\r\non va voir....', 18, 156, '2020-04-08 14:38:13', NULL),
(497, 'jhbjhbjhbjjvbjbb', 18, 159, '2020-04-08 17:32:54', 'public/images/in cottura 2.jpg'),
(499, '<script>console.log(toto)</script>', 18, 159, '2020-04-09 07:05:44', NULL),
(504, 'test\r\n', 20, 159, '2020-04-09 09:48:07', NULL),
(507, 'uyyyubu', 18, 126, '2020-04-09 12:12:21', NULL),
(509, 'nouveau message pour voir ce que ça donne\r\n', 18, 164, '2020-04-09 13:53:06', 'public/images/388923_2019_Porsche_Cayenne.jpg'),
(510, 'nouveau message dans la nouvelle discussion', 18, 165, '2020-04-09 16:39:31', 'public/images/acheter-un-chat (1).jpg'),
(511, 'un autre message', 18, 165, '2020-04-09 16:40:50', NULL),
(512, 'ontest ', 18, 165, '2020-04-10 09:40:59', 'public/images/acheter-un-chat (1).jpg'),
(514, '', 18, 165, '2020-04-10 10:27:49', NULL),
(515, 'essai de message dans sujet sans groupe', 18, 185, '2020-04-10 15:01:58', 'public/images/acheter-un-chat (1).jpg'),
(516, 'test\r\n', 18, 182, '2020-04-10 16:03:05', NULL),
(517, 'messai de message dans groupe test 1', 18, 196, '2020-04-11 11:44:39', 'public/images/acheter-un-chat (1).jpg'),
(518, 'essai de message ds test 4 par zzpapy\r\n', 18, 199, '2020-04-11 12:44:58', 'public/images/388923_2019_Porsche_Cayenne.jpg'),
(519, 'ça à l&#39;aire de tourner', 18, 200, '2020-04-11 12:46:11', 'public/images/eduquer-un-chat-fb-59ad52663bd71.jpg'),
(520, '', 18, 200, '2020-04-11 15:58:26', NULL),
(521, 'test', 18, 242, '2020-04-14 06:48:47', 'public/images/acheter-un-chat (1).jpg'),
(522, 'test', 18, 217, '2020-04-14 07:39:18', NULL),
(523, 'deux', 18, 242, '2020-04-14 08:08:26', NULL),
(524, 'test bob\r\n', 18, 241, '2020-04-14 09:32:47', NULL),
(525, 'b', 18, 217, '2020-04-14 09:56:16', NULL),
(526, 'n', 18, 242, '2020-04-14 09:57:05', NULL),
(527, 'test heure', 18, 217, '2020-04-14 12:09:38', NULL),
(528, 'n', 18, 217, '2020-04-14 12:14:27', NULL),
(529, 'coucou', 18, 263, '2020-04-16 06:47:44', 'public/images/mau_egyptien_med-_res-___basic.png'),
(530, 'coucou ça va', 20, 261, '2020-04-16 07:08:43', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `signalement`
--

CREATE TABLE `signalement` (
  `id_signalement` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `signalement`
--

INSERT INTO `signalement` (`id_signalement`, `membre_id`, `message_id`, `date`) VALUES
(1, 20, 530, '2020-04-16 07:10:16');

-- --------------------------------------------------------

--
-- Structure de la table `submess`
--

CREATE TABLE `submess` (
  `id_submess` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `message_id` int(11) NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `submess`
--

INSERT INTO `submess` (`id_submess`, `content`, `message_id`, `membre_id`, `date`) VALUES
(8, 'test', 447, 20, '2020-04-04 08:34:04'),
(9, 'test', 447, 20, '2020-04-04 08:39:04'),
(11, 'a', 447, 20, '2020-04-04 08:54:59'),
(14, 'fezrggtrgertgterer', 451, 20, '2020-04-04 08:57:00'),
(19, 'test comment', 491, 18, '2020-04-08 11:50:57'),
(20, 'test', 494, 18, '2020-04-08 12:49:54'),
(24, 'test', 509, 18, '2020-04-09 11:57:40'),
(26, 'essayons un commentaire', 511, 18, '2020-04-09 14:41:53'),
(27, 'et ici', 510, 18, '2020-04-09 14:42:06'),
(28, 'ouhhhhh', 529, 18, '2020-04-16 06:48:42');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE `sujet` (
  `id_sujet` int(11) NOT NULL,
  `titre` text COLLATE utf8_bin NOT NULL,
  `membre_id` int(11) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `photo` varchar(256) COLLATE utf8_bin DEFAULT NULL,
  `close` int(11) NOT NULL DEFAULT '0',
  `groupe_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id_sujet`, `titre`, `membre_id`, `date`, `photo`, `close`, `groupe_id`) VALUES
(165, 'nouvelle discussion', 18, '2020-04-09 16:38:39', 'public/images/acheter-un-chat (1).jpg', 0, NULL),
(185, 'essai de discuss sans groupe', 18, '2020-04-10 15:01:34', NULL, 0, NULL),
(187, 'essai sujet test', 22, '2020-04-10 16:09:00', NULL, 0, 36),
(188, 'uihuihuhuihihi', 24, '2020-04-10 16:09:28', NULL, 0, 37),
(195, 'nuit', 18, '2020-04-10 17:09:15', NULL, 0, 4),
(196, 'test1', 18, '2020-04-11 08:41:07', NULL, 0, 5),
(197, 'test2', 18, '2020-04-11 09:09:10', NULL, 0, 6),
(198, 'test3', 18, '2020-04-11 11:40:40', NULL, 0, 7),
(199, 'test4', 20, '2020-04-11 12:33:05', NULL, 0, 8),
(200, 'nouvelle disussion sans groupe parés créa et affcih groupe discuss', 18, '2020-04-11 12:45:43', NULL, 0, NULL),
(201, 'test5', 18, '2020-04-13 12:43:53', NULL, 0, 9),
(202, 'test6', 20, '2020-04-13 13:08:32', NULL, 0, 10),
(203, 'titre seul', 18, '2020-04-13 13:29:04', NULL, 0, 11),
(204, 'flash', 19, '2020-04-13 13:39:14', NULL, 0, 12),
(205, 'c', 19, '2020-04-13 13:40:13', NULL, 0, NULL),
(206, 'c', 19, '2020-04-13 13:40:46', NULL, 0, 14),
(207, 'd', 20, '2020-04-13 13:48:09', NULL, 0, 15),
(208, 'n', 20, '2020-04-13 13:48:44', NULL, 0, 16),
(209, 'r', 20, '2020-04-13 13:50:08', NULL, 0, 17),
(210, 'n', 20, '2020-04-13 13:50:57', NULL, 0, 18),
(211, 'd', 20, '2020-04-13 13:51:28', NULL, 0, 19),
(212, 'd', 20, '2020-04-13 13:53:06', NULL, 0, 20),
(213, 'd', 20, '2020-04-13 13:53:53', NULL, 0, 21),
(214, 'n', 20, '2020-04-13 13:55:48', NULL, 0, 22),
(215, 'k', 20, '2020-04-13 13:57:14', NULL, 0, 23),
(216, ',', 20, '2020-04-13 13:58:22', NULL, 0, 24),
(217, 'jnknnnkn', 20, '2020-04-13 13:58:52', NULL, 0, NULL),
(218, 'kookkokok', 20, '2020-04-13 14:01:07', NULL, 0, 25),
(219, 'qaqqaqaqaqaqaq', 20, '2020-04-13 14:03:56', NULL, 0, 27),
(220, 'uniunuinuinunini', 20, '2020-04-13 14:04:30', NULL, 0, 28),
(221, 'j', 20, '2020-04-13 14:05:41', NULL, 0, 29),
(222, 'n', 20, '2020-04-13 14:06:19', NULL, 0, 30),
(223, 'j', 20, '2020-04-13 14:06:52', NULL, 0, 31),
(224, 'flash', 20, '2020-04-13 14:07:52', NULL, 0, 32),
(225, 'n', 20, '2020-04-13 14:09:48', NULL, 0, 33),
(226, 'bjbjb', 18, '2020-04-13 14:35:53', NULL, 0, 34),
(227, 'n', 20, '2020-04-13 14:50:06', NULL, 0, 35),
(228, 'd', 20, '2020-04-13 15:00:28', NULL, 0, 36),
(229, 'd', 20, '2020-04-13 15:00:57', NULL, 0, 37),
(230, ',', 20, '2020-04-13 15:03:47', NULL, 0, 38),
(231, 'b', 20, '2020-04-13 15:11:23', NULL, 0, 39),
(232, 'merde', 18, '2020-04-13 15:18:07', NULL, 0, 40),
(233, 'putain', 20, '2020-04-13 15:18:49', NULL, 0, 41),
(234, 'ooooooooooooo', 18, '2020-04-13 15:19:50', NULL, 0, 42),
(235, 'hhhhhhhhh', 18, '2020-04-13 15:20:30', NULL, 0, 43),
(236, 'hvhvhvhvhvhvhv', 18, '2020-04-13 15:24:17', NULL, 0, 44),
(237, 'test', 20, '2020-04-13 15:27:16', NULL, 0, 45),
(238, 'avec zzpapy', 20, '2020-04-13 15:38:41', NULL, 0, 46),
(239, 'avec test', 18, '2020-04-13 15:39:21', NULL, 0, 47),
(240, ' avec ZZpapy', 20, '2020-04-13 15:40:36', NULL, 0, 48),
(241, 'avec bob', 18, '2020-04-13 15:49:23', NULL, 0, 49),
(242, 'avec zzpapy et test', 19, '2020-04-13 15:50:16', NULL, 0, 50),
(243, 'heures', 18, '2020-04-14 12:15:09', NULL, 0, NULL),
(244, 'n', 18, '2020-04-14 12:18:36', NULL, 0, NULL),
(245, 'go', 18, '2020-04-14 15:00:13', NULL, 0, 51),
(246, 'n', 18, '2020-04-14 15:06:04', NULL, 0, 52),
(247, 'b', 18, '2020-04-14 15:09:16', NULL, 0, 54),
(248, 'b', 18, '2020-04-14 15:09:36', NULL, 0, 55),
(249, 'ftfttfftf', 20, '2020-04-14 15:09:58', NULL, 0, 56),
(250, 'test', 18, '2020-04-14 15:19:56', NULL, 0, 57),
(252, 'kjbhbbkbb', 18, '2020-04-14 15:41:14', 'public/images/acheter-un-chat (1).jpg', 0, NULL),
(253, 'uhhuhuhuhuhuh', 18, '2020-04-14 15:49:59', 'public/images/acheter-un-chat (1).jpg', 0, NULL),
(254, 'kjnkjnnkn', 18, '2020-04-14 15:57:07', 'public/images/', 0, 59),
(255, 'kjnkjnnkn', 18, '2020-04-14 15:57:26', 'public/images/', 0, 60),
(256, 'kjnkjnnkn', 18, '2020-04-14 15:57:36', 'public/images/', 0, 61),
(257, 'kjnkjnnkn', 18, '2020-04-14 15:58:00', 'public/images/', 0, 62),
(258, 'test', 18, '2020-04-14 16:03:26', 'public/images/acheter-un-chat (1).jpg', 0, 63),
(259, 'hbhbbbbi', 18, '2020-04-14 16:06:45', 'public/images/chat.jpeg', 0, 64),
(260, 'jhbjhbjbjbjbb', 18, '2020-04-14 16:07:18', 'public/images/acheter-un-chat (1).jpg', 0, 65),
(261, 'jkkhjhbkbkbk', 18, '2020-04-14 16:15:40', 'public/images/388923_2019_Porsche_Cayenne.jpg', 0, NULL),
(262, 'kjnkjnjknknknj', 18, '2020-04-15 11:47:03', 'public/images/chat.jpeg', 0, 66),
(263, 'test', 18, '2020-04-15 12:00:11', 'public/images/acheter-un-chat (1).jpg', 0, 3),
(264, 'heure', 20, '2020-04-17 06:55:32', NULL, 0, NULL),
(265, 'heure', 20, '2020-04-17 07:00:27', NULL, 0, NULL),
(266, 'c', 20, '2020-04-17 07:01:10', NULL, 0, NULL),
(267, 'n', 18, '2020-04-17 09:17:45', NULL, 0, NULL),
(268, 'jhbdfvjhdsfjhvjhdsbvjdbfvbdsfjbv', 18, '2020-04-17 10:24:33', NULL, 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`groupe_id`,`membre_id`),
  ADD KEY `appartient_membre0_FK` (`membre_id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`),
  ADD KEY `membre0_FK` (`membre_id`),
  ADD KEY `sujet0_FK` (`sujet_id`);

--
-- Index pour la table `groupe_sujet`
--
ALTER TABLE `groupe_sujet`
  ADD PRIMARY KEY (`sujet_id`,`groupe_id`),
  ADD KEY `groupe_sujet_groupe0_FK` (`groupe_id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_user` (`membre_id`),
  ADD KEY `id_sujet` (`sujet_id`);

--
-- Index pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD PRIMARY KEY (`id_signalement`) USING BTREE,
  ADD KEY `signalement_ibfk_1` (`membre_id`),
  ADD KEY `signalement_ibfk_2` (`message_id`);

--
-- Index pour la table `submess`
--
ALTER TABLE `submess`
  ADD PRIMARY KEY (`id_submess`),
  ADD KEY `id_user` (`membre_id`),
  ADD KEY `id_message` (`message_id`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id_sujet`),
  ADD KEY `id_user` (`membre_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT pour la table `signalement`
--
ALTER TABLE `signalement`
  MODIFY `id_signalement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `submess`
--
ALTER TABLE `submess`
  MODIFY `id_submess` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id_sujet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_groupe_FK` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appartient_membre0_FK` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `membre0_FK` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`),
  ADD CONSTRAINT `sujet0_FK` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id_sujet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe_sujet`
--
ALTER TABLE `groupe_sujet`
  ADD CONSTRAINT `groupe_sujet_groupe0_FK` FOREIGN KEY (`groupe_id`) REFERENCES `groupe` (`id_groupe`),
  ADD CONSTRAINT `groupe_sujet_sujet_FK` FOREIGN KEY (`sujet_id`) REFERENCES `sujet` (`id_sujet`);

--
-- Contraintes pour la table `signalement`
--
ALTER TABLE `signalement`
  ADD CONSTRAINT `signalement_ibfk_1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`) ON DELETE NO ACTION,
  ADD CONSTRAINT `signalement_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `message` (`id_message`) ON DELETE CASCADE;

--
-- Contraintes pour la table `submess`
--
ALTER TABLE `submess`
  ADD CONSTRAINT `id_message` FOREIGN KEY (`message_id`) REFERENCES `message` (`id_message`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id_membre`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
