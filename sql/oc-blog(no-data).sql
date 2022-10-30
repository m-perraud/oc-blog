-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 30 oct. 2022 à 12:57
-- Version du serveur :  5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `oc-blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentUsername` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `commentMail` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `commentText` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `commentDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentStatus` tinyint(1) NOT NULL DEFAULT '0',
  `postId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`postId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postTitle` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `postChapo` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `postText` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `postDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `postAuthor` int(11) NOT NULL,
  `postImage` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`postAuthor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userMail` varchar(250) COLLATE utf8mb4_bin NOT NULL,
  `adminLogin` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `adminPW` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `adminStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userMail` (`userMail`),
  UNIQUE KEY `adminLogin` (`adminLogin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin ROW_FORMAT=DYNAMIC;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`postAuthor`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
