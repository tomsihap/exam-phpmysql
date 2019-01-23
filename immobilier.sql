-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 23 jan. 2019 à 09:19
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `immobilier`
--
CREATE DATABASE IF NOT EXISTS `immobilier` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `immobilier`;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id_logement` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `surface` int(11) UNSIGNED NOT NULL,
  `prix` int(11) UNSIGNED NOT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `type` enum('location','vente') NOT NULL,
  `description` text,
  PRIMARY KEY (`id_logement`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(1, 'Bel appartement à Bellecour', '3 place Bellecour', 'Lyon', '69002', 125, 1285000, 'logement_1.jpg', 'vente', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque a elementum justo. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum sit amet velit lacinia sapien facilisis blandit non in orci. Vestibulum at ipsum sit amet elit ultrices tristique facilisis id tellus. Sed at elit dolor. Nam quis sem sed purus laoreet feugiat gravida vel magna. Suspendisse bibendum nunc et euismod commodo. Nunc euismod arcu quis ex luctus porttitor vitae et eros. Mauris sit amet rutrum nunc, vel semper urna. Nunc eget bibendum nisi, et porta orci. Nulla consequat libero sapien, a venenatis nunc rutrum id. Duis non quam sed sapien pulvinar tempus'),
(2, 'Joli appartement à louer place de la République', '3 place de la République', 'Nancy', '57000', 58, 650, 'logement_2.jpg', 'location', 'Nam ex massa, scelerisque non augue non, finibus tristique dui. Suspendisse sollicitudin sit amet odio ullamcorper sodales. Proin massa velit, tristique porttitor elit eget, egestas pellentesque turpis. Vestibulum condimentum porta quam non eleifend. Praesent laoreet ut urna eget vulputate. Donec sodales leo vel lectus pretium, id feugiat nunc viverra. Integer dictum vitae purus non sagittis. Vestibulum congue mauris neque. Cras id ex placerat, consequat orci et, tincidunt nisl. Duis ultrices, orci non blandit condimentum, magna orci venenatis diam, eu bibendum dui dui ut eros.'),
(3, 'Charmante chambre sous les combles quartier Lumière', '45 avenue des frères Lumière', 'Lyon', '69008', 88, 780, 'logement_3.jpg', 'location', 'Integer vehicula gravida efficitur. Curabitur mollis ultricies varius. Maecenas iaculis eget odio ut consectetur. Proin dui felis, consectetur ut efficitur ut, placerat lacinia risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse metus nibh, bibendum placerat orci eu, placerat tempor mauris. Morbi et lacus ac turpis auctor feugiat.'),
(4, 'Agréable pièce à vivre dans un lieu inconnu', '14 chemin de traverse', 'Poudlard', '89000', 845, 684500, 'logement_4.jpg', 'vente', 'Fusce ultricies dui sapien, nec lacinia orci malesuada sit amet. In elementum lobortis dolor, sit amet sagittis nulla condimentum eu. Vestibulum quis sapien at neque tristique interdum. Phasellus ut eros diam. Pellentesque porta magna convallis eros commodo, eu blandit eros egestas. Pellentesque nec lectus sit amet risus imperdiet luctus. Donec consequat porta libero eget volutpat. Nulla vitae quam ornare, molestie felis vitae, blandit dolor. Etiam blandit, justo sit amet pulvinar vehicula, lorem velit pellentesque magna, a suscipit odio justo id lectus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean hendrerit quam at nisi bibendum, id auctor nisi ultricies. Donec ex neque, porttitor dignissim lectus a, pellentesque sagittis neque. Vivamus tincidunt laoreet quam.\r\n\r\n'),
(5, 'Joli bien proche commerces', '57 avenue des lilas', 'Nancy', '57000', 58, 850, 'logement_5.jpg', 'location', 'Ut eu venenatis sem. Donec erat dolor, maximus vitae euismod non, tristique eget tellus. Praesent at libero hendrerit, consectetur dolor a, tempus metus. Integer ac tempus felis. Duis id elit volutpat, dapibus magna sed, finibus ipsum. Integer eu augue non justo porttitor aliquam. Nunc sed felis nulla. In ex lorem, cursus ac rhoncus vel, aliquet ut purus. Suspendisse id metus semper nunc scelerisque commodo nec quis ipsum. Donec venenatis lectus sit amet velit tristique, ut rutrum mauris porttitor. Integer ac magna non massa consequat malesuada. Ut eu libero eget elit fringilla vehicula. Pellentesque accumsan sapien in aliquet commodo. Sed eu ipsum nec magna maximus sagittis at quis libero. Ut lacinia varius aliquet. Aenean blandit felis eget ex tempor, eget convallis mi pretium.\r\n\r\n');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
