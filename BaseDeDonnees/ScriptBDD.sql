-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Jeu 29 Janvier 2015 à 12:35
-- Version du serveur: 5.6.14
-- Version de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `twitter`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE IF NOT EXISTS `abonne` (
  `idUtilisateur` int(11) NOT NULL,
  `idUtilisateurSuivi` int(11) NOT NULL,
  PRIMARY KEY (`idUtilisateur`,`idUtilisateurSuivi`),
  KEY `FK_abonne_idUtilisateur_1` (`idUtilisateurSuivi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `abonne`
--

INSERT INTO `abonne` (`idUtilisateur`, `idUtilisateurSuivi`) VALUES
(41, 39),
(43, 39),
(39, 40),
(44, 40),
(43, 41),
(39, 43),
(44, 43),
(43, 44);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `idMessage` int(11) NOT NULL AUTO_INCREMENT,
  `Messages` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `DateCreation` datetime NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idMessage`),
  KEY `FK_Message_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`idMessage`, `Messages`, `DateCreation`, `idUtilisateur`) VALUES
(100, 'Bonjour, \r\nVoici mon 1er message !', '2015-01-29 12:26:00', 44),
(101, 'Et maintenant voici mon 2eme message', '2015-01-29 12:26:00', 44),
(102, 'TrÃ¨s bien ! Ã§a marche !', '2015-01-29 12:27:00', 39),
(103, 'Comment allez vous aujourdâ€™hui ?', '2015-01-29 12:28:00', 39),
(104, 'Qui veux aller Ã  la piscine avec moi ?', '2015-01-29 12:28:00', 40),
(105, 'J''irais tout seul ! dans ce cas !', '2015-01-29 12:29:00', 40),
(106, 'En se rÃ©veillant un matin aprÃ¨s des rÃªves \r\nagitÃ©s, Gregor Samsa se retrouva, dans son lit, \r\nmÃ©tamorphosÃ© en un monstrueux insecte. Il Ã©tait \r\n14', '2015-01-29 12:30:00', 40),
(107, 'Sympa le rÃ©seau !  je vais ajouter des amis =)', '2015-01-29 12:31:00', 41),
(108, 'guerryd je vais te suivre !', '2015-01-29 12:31:00', 41),
(109, 'et si je met du code ??\r\n<script>alert(''coucou'')</script>\r\n', '2015-01-29 12:32:00', 43),
(110, 'select * from utilisateur;', '2015-01-29 12:33:00', 43),
(111, '<a>https://www.google.fr/</a> ', '2015-01-29 12:34:00', 43);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Prenom` varchar(25) NOT NULL,
  `Login` varchar(25) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Sexe` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUtilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `Nom`, `Prenom`, `Login`, `Password`, `Sexe`) VALUES
(39, 'Guerry', 'David', 'guerryd', '8cb2237d0679ca88db6464eac60da96345513964', 1),
(40, 'Mady', 'Antoine', 'madyA', '8cb2237d0679ca88db6464eac60da96345513964', 1),
(41, 'Helias', 'Maxime', 'heliasM', '8cb2237d0679ca88db6464eac60da96345513964', 1),
(42, 'Plaire', 'Martine', 'plaireM', '8cb2237d0679ca88db6464eac60da96345513964', 0),
(43, 'Bouchar', 'Sylvie', 'boucharS', '8cb2237d0679ca88db6464eac60da96345513964', 0),
(44, 'Clerc', 'Suzanne', 'clercS', '8cb2237d0679ca88db6464eac60da96345513964', 0);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD CONSTRAINT `FK_abonne_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_abonne_idUtilisateur_1` FOREIGN KEY (`idUtilisateurSuivi`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_Message_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
