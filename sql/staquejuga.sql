-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 19 Octobre 2014 à 22:35
-- Version du serveur :  5.6.20-log
-- Version de PHP :  5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `staquejuga`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`id_answer` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `content` text NOT NULL,
  `vote` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id_answer`, `id_question`, `id_user`, `content`, `vote`, `dateCreated`, `dateModified`) VALUES
(1, 1, 1, 'je te répond.', 1, '2014-10-18 22:04:36', '2014-10-18 22:04:36'),
(2, 1, 2, 'je te répond.', 0, '2014-10-18 22:04:36', '2014-10-18 22:04:36');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id_comment` int(11) NOT NULL,
  `id_rubric` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_comment` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE IF NOT EXISTS `links` (
`id_link` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `link` varchar(250) NOT NULL
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
`id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id_question`, `id_user`, `title`, `content`, `dateCreated`, `dateModified`) VALUES
(1, 1, 'c''est qu''est ce que c''est du php Guillaume ?', 'je suis rien que du texte', '2014-10-18 19:16:24', '2014-10-18 19:16:24'),
(2, 1, 'comment on fait un fichier css ?', 'je suis rien que du texte', '2014-10-19 01:16:26', '2014-10-19 01:16:26'),
(3, 2, 'cool une autre question', 'je suis rien que du texte', '2014-10-19 15:12:00', '2014-10-19 15:12:00');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id_tag` int(11) NOT NULL,
  `tag_name` varchar(250) NOT NULL
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
`id_relation` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tags_relation`
--

INSERT INTO `tags_relation` (`id_relation`, `id_question`, `id_tag`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id_user` int(11) NOT NULL,
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
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `user_pseudo`, `email`, `status`, `country`, `language`, `job`, `password`, `salt`, `token`, `score`, `img_profile`, `dateCreated`, `dateModified`) VALUES
(1, 'julien', 'juliendb', 'julien@gmail.com', 0, NULL, NULL, NULL, '', '', '', 50, NULL, '2014-10-18 19:13:03', '2014-10-18 19:13:03'),
(2, 'babar', 'babar', 'babar@gmail.com', 1, NULL, NULL, NULL, '', '', '', 5, NULL, '2014-10-18 19:42:15', '2014-10-18 19:42:15');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
`id_vote` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `vote_type` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`id_answer`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id_comment`);

--
-- Index pour la table `links`
--
ALTER TABLE `links`
 ADD PRIMARY KEY (`id_link`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id_question`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id_tag`);

--
-- Index pour la table `tags_relation`
--
ALTER TABLE `tags_relation`
 ADD PRIMARY KEY (`id_relation`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`id_vote`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
MODIFY `id_answer` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
MODIFY `id_link` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id_tag` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `tags_relation`
--
ALTER TABLE `tags_relation`
MODIFY `id_relation` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
