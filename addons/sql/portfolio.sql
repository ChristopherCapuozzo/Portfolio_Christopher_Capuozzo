-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 04 avr. 2022 à 08:20
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `portfolio`
--

-- --------------------------------------------------------

--
-- Structure de la table `projets`
--

DROP TABLE IF EXISTS `projets`;
CREATE TABLE IF NOT EXISTS `projets` (
  `id_projet` int(11) NOT NULL AUTO_INCREMENT,
  `nom_projet` text NOT NULL,
  `url_projet` blob NOT NULL,
  PRIMARY KEY (`id_projet`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id_projet`, `nom_projet`, `url_projet`) VALUES
(1, 'Jadoo', 0x68747470733a2f2f6368726973746f70686572636170756f7a7a6f2e6769746875622e696f2f4a61646f6f2f),
(2, 'Ushikuu', 0x68747470733a2f2f6769746875622e636f6d2f4368726973746f70686572436170756f7a7a6f2f557368696b7575),
(3, 'Voyager Au Japon', 0x68747470733a2f2f6769746875622e636f6d2f4368726973746f70686572436170756f7a7a6f2f566f796167657241754a61706f6e),
(4, 'La Taverne Noble', 0x68747470733a2f2f6769746875622e636f6d2f4368726973746f70686572436170756f7a7a6f2f4c6154617665726e654e6f626c65);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `date-naissance` date NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_users`, `nom`, `prenom`, `email`, `password`, `date-naissance`) VALUES
(1, 'Capuozzo', 'Christopher', 'capuozzo.contact.pro@gmail.com', 'Maman3830', '2000-09-08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
