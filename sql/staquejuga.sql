-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 24 Octobre 2014 à 13:37
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `staquejuga`
--
CREATE DATABASE IF NOT EXISTS `staquejuga` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `staquejuga`;

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `vote` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id_answer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id_answer`, `id_question`, `id_user`, `content`, `vote`, `dateCreated`, `dateModified`) VALUES
(1, 1, 1, 'je te répond.', 1, '2014-10-18 22:04:36', '2014-10-18 22:04:36'),
(2, 1, 2, 'je te répond.', 0, '2014-10-18 22:04:36', '2014-10-18 22:04:36'),
(3, 1, 1, 'Vide, quantum, inquam, fallare, Torquate.\nOratio me istius philosophi non offendit; nam et complectitur verbis.', 0, '2014-10-21 17:03:52', '2014-10-21 17:03:52'),
(4, 1, 1, '		gogo gadjet		', 0, '2014-10-21 17:11:37', '2014-10-21 17:11:37'),
(5, 4, 4, 'reponse de la question hello world				', 0, '2014-10-22 11:23:20', '2014-10-22 11:23:20');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_rubric` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_comment` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_rubric`, `id_user`, `type_comment`, `content`, `dateCreated`, `dateModified`) VALUES
(1, 1, 3, '''question''', '', '2014-10-21 16:19:17', '2014-10-21 16:19:17'),
(2, 1, 3, '''question''', '', '2014-10-21 16:19:25', '2014-10-21 16:19:25'),
(3, 1, 3, '''question''', '', '2014-10-21 16:20:30', '2014-10-21 16:20:30'),
(4, 1, 3, '''question''', '', '2014-10-21 16:24:42', '2014-10-21 16:24:42'),
(5, 1, 3, 'question', '	blalbldodododododododododod			', '2014-10-21 16:24:51', '2014-10-21 16:24:51'),
(6, 1, 3, 'question', '', '2014-10-21 16:33:25', '2014-10-21 16:33:25'),
(7, 1, 3, 'question', '		hello you		', '2014-10-21 16:33:35', '2014-10-21 16:33:35'),
(8, 1, 3, 'question', '		hello you		', '2014-10-21 16:36:55', '2014-10-21 16:36:55'),
(9, 1, 3, 'question', '', '2014-10-21 16:36:58', '2014-10-21 16:36:58'),
(10, 1, 3, 'question', '', '2014-10-21 16:38:53', '2014-10-21 16:38:53'),
(11, 1, 3, 'question', '', '2014-10-21 16:39:24', '2014-10-21 16:39:24'),
(12, 1, 3, 'question', '', '2014-10-21 16:39:25', '2014-10-21 16:39:25'),
(13, 1, 3, 'question', '', '2014-10-21 16:39:26', '2014-10-21 16:39:26'),
(14, 1, 3, 'question', '', '2014-10-21 16:39:27', '2014-10-21 16:39:27'),
(15, 1, 3, 'question', '', '2014-10-21 16:39:27', '2014-10-21 16:39:27'),
(16, 1, 3, 'question', '', '2014-10-21 16:39:27', '2014-10-21 16:39:27'),
(17, 1, 3, 'question', '', '2014-10-21 16:39:28', '2014-10-21 16:39:28'),
(18, 1, 3, 'question', '', '2014-10-21 16:39:29', '2014-10-21 16:39:29'),
(19, 1, 3, 'question', '', '2014-10-21 16:39:30', '2014-10-21 16:39:30'),
(20, 1, 3, 'question', '', '2014-10-21 16:39:36', '2014-10-21 16:39:36'),
(21, 1, 1, 'question', '', '2014-10-21 16:39:43', '2014-10-21 16:39:43'),
(22, 1, 1, 'question', '', '2014-10-21 16:39:46', '2014-10-21 16:39:46'),
(23, 1, 1, 'question', '', '2014-10-21 16:39:46', '2014-10-21 16:39:46'),
(24, 1, 1, 'question', '', '2014-10-21 16:39:47', '2014-10-21 16:39:47'),
(25, 1, 1, 'question', '', '2014-10-21 16:39:47', '2014-10-21 16:39:47'),
(26, 1, 1, 'question', '', '2014-10-21 16:39:47', '2014-10-21 16:39:47'),
(27, 1, 1, 'question', '', '2014-10-21 16:40:36', '2014-10-21 16:40:36'),
(28, 1, 1, 'question', '', '2014-10-21 16:40:41', '2014-10-21 16:40:41'),
(29, 1, 1, 'question', '', '2014-10-21 16:40:44', '2014-10-21 16:40:44'),
(30, 1, 1, 'question', '', '2014-10-21 16:40:49', '2014-10-21 16:40:49'),
(31, 1, 1, 'question', '', '2014-10-21 16:42:01', '2014-10-21 16:42:01'),
(32, 1, 1, 'question', '', '2014-10-21 16:42:03', '2014-10-21 16:42:03'),
(33, 1, 3, 'question', '', '2014-10-21 16:46:32', '2014-10-21 16:46:32'),
(34, 1, 1, 'question', '', '2014-10-21 17:03:02', '2014-10-21 17:03:02'),
(35, 1, 1, 'question', '', '2014-10-21 17:03:21', '2014-10-21 17:03:21'),
(36, 1, 1, 'question', '', '2014-10-21 17:08:28', '2014-10-21 17:08:28'),
(37, 1, 1, 'answer', '', '2014-10-21 17:08:37', '2014-10-21 17:08:37'),
(38, 1, 1, 'answer', '', '2014-10-21 17:20:22', '2014-10-21 17:20:22'),
(39, 1, 1, 'answer', '', '2014-10-21 17:20:25', '2014-10-21 17:20:25'),
(40, 1, 4, 'question', 'coooool ça marche', '2014-10-22 09:45:20', '2014-10-22 09:45:20');

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id_link` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `link` varchar(250) NOT NULL,
  PRIMARY KEY (`id_link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `links`
--

INSERT INTO `links` (`id_link`, `id_user`, `link`) VALUES
(1, 1, 'http://php.net/'),
(2, 1, 'http://www.scriptspot.com/');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id_question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id_question`, `id_user`, `title`, `content`, `dateCreated`, `dateModified`) VALUES
(1, 1, 'php ou non php ? Je me pose la question', 'Tantum autem cuique tribuendum, primum quantum ipse efficere possis, deinde etiam quantum ille quem diligas atque adiuves, sustinere. Non enim neque tu possis, quamvis excellas, omnes tuos ad honores amplissimos perducere, ut Scipio P. Rupilium potuit consulem efficere, fratrem eius L. non potuit. Quod si etiam possis quidvis deferre ad alterum, videndum est tamen, quid ille possit sustinere.								', '2014-10-18 19:16:24', '2014-10-22 10:59:22'),
(2, 1, 'comment on fait un fichier css ?', 'je suis rien que du texte', '2014-10-19 07:16:26', '2014-10-21 10:16:26'),
(3, 2, 'cool une autre question', 'je suis rien que du texte', '2014-10-19 15:12:00', '2014-10-19 15:12:00'),
(4, 4, 'hello world', 'blablabla', '2014-10-22 11:07:10', '2014-10-22 11:07:10'),
(5, 4, 'Question lalalalala barrée', '<h1><em><strong><del>LALALALALALALALALALALALALA</del></strong></em></h1>\r\n', '2014-10-23 15:10:18', '2014-10-23 15:10:18');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(250) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id_tag`, `tag_name`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'JS'),
(4, 'PHP'),
(5, 'JQuery');

-- --------------------------------------------------------

--
-- Structure de la table `tags_relation`
--

CREATE TABLE IF NOT EXISTS `tags_relation` (
  `id_relation` int(11) NOT NULL AUTO_INCREMENT,
  `id_question` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  PRIMARY KEY (`id_relation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tags_relation`
--

INSERT INTO `tags_relation` (`id_relation`, `id_question`, `id_tag`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 5),
(4, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(250) DEFAULT NULL,
  `user_pseudo` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `language` varchar(250) DEFAULT NULL,
  `job` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `salt` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  `score` int(11) NOT NULL,
  `img_profile` varchar(250) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `user_pseudo`, `email`, `status`, `country`, `language`, `job`, `password`, `salt`, `token`, `score`, `img_profile`, `dateCreated`, `dateModified`) VALUES
(1, 'bobette', 'juliendb', 'julien@gmail.com', 0, '', '', '', '', '', '', 50, 'uploads/thumbs/default.jpg', '2014-10-18 19:13:03', '2014-10-21 13:03:13'),
(2, 'babar', 'babar', 'babar@gmail.com', 1, NULL, NULL, NULL, '', '', '', 5, 'uploads/thumbs/default.jpg', '2014-10-18 19:42:15', '2014-10-18 19:42:15'),
(3, 'fouli', 'KnakiSteak', 'bob@gmail.com', 1, 'terre', 'esperento', '', '1234567', 'za8dWVKYCis8y0RS7RsHuLgmIfhKyAC1wEc3h9ltyGNWnGodPJ', 'sJHZr7RJLqCuo2BvqpJaI4YOXXyhn1enSsTg68J5ZpMTABjAIn', 5, 'uploads/thumbs/default.jpg', '2014-10-21 11:34:16', '2014-10-21 12:59:59'),
(4, 'gagalala', 'GaeleTest', 'gaga@gmail.com', 0, 'france', 'français', 'colleur de gomettes', 'f24b260f2d19628aa5c102024229443529b52d1bea656fd24ad92a8bee85afc6e3c6cd6842d8926fc6030dbc4def445285022181790f34d8223401839d185528', 'x7eIPJ5BBErbqsPTJNBFR1gS83yzOal4vWlbawu2qeu6v3m7GA', 's58TrReBJpJXrav8oR7e70YRafIWPIb5rafj6ZISchlny6psgl', 5, 'uploads/thumbs/default.jpg', '2014-10-22 09:44:51', '2014-10-22 09:46:17'),
(5, NULL, 'blabalaa', 'blabalaa@gmail.com', 1, NULL, NULL, NULL, 'd380edc8cd523979a5adfe417b02a94b26f9a5de5f28d8c3f832acd21a27b772e0fc0f450f63b8d7b1ecd88bac412c27e3d77646ebd8f1d78d781a72e9adf4f7', 'J28bkn3hL2W0SYxp1i1Pt8WE0XiVP1LIMK5G7r4xbpbJDrv7va', 'wdRJLIE8ix9ROK5P1UKuMYn6A8DMGai8cIhGzmZjBFjDJsrSoY', 5, 'uploads/thumbs/default.jpg', '2014-10-24 13:14:16', '2014-10-24 13:14:16');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id_vote` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `vote_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_vote`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id_vote`, `id_user`, `id_answer`, `vote_type`) VALUES
(1, 5, 4, 1),
(2, 5, 3, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
