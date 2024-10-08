-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 08 oct. 2024 à 13:56
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `code_postal` varchar(20) NOT NULL,
  `numero_carte` varchar(20) NOT NULL,
  `date_expiration` varchar(10) NOT NULL,
  `cvv` varchar(5) NOT NULL,
  `date_paiement` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id`, `nom`, `email`, `adresse`, `ville`, `code_postal`, `numero_carte`, `date_expiration`, `cvv`, `date_paiement`) VALUES
(1, 'jean dupont', 'jean.dupont@example.com', '123 Rue de Paris', 'paris', '75001', '4111 1111 1111 1111', '12/25', '123', '2024-10-08 12:24:31');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `image`) VALUES
(1, 'Body bébé en coton bio', 'Un body doux et confortable en coton biologique pour garder votre bébé au chaud. Conçu avec des boutons-pression pour un habillage facile, ce body est parfait pour les peaux sensibles de bébé.', 12.99, 'body bébé en coton bio.jpg'),
(2, 'Poussette légère et compacte', 'Une poussette ultra-légère avec un pliage compact pour faciliter les déplacements. Elle est équipée d\'un siège confortable, d\'une capote de protection contre le soleil et d\'un panier de rangement spacieux.', 179.99, '01127152-1poussette.jpg'),
(3, 'Doudou lapin en velours', 'Un doudou doux en forme de lapin, parfait pour rassurer bébé lors de la sieste. Ce compagnon câlin est fabriqué en velours doux et dispose de petites oreilles faciles à attraper pour les petites mains.', 9.99, 'Doudou lapin en velours.png'),
(4, 'Chauffe-biberon portable', 'Ce chauffe-biberon portable permet de chauffer les biberons en toute simplicité, même en déplacement. Fonctionne sur prise secteur ou avec un adaptateur voiture pour une utilisation pratique en voyage.', 34.99, 'Chauffe-biberon portable.jpg'),
(5, 'Tapis Bébé', ' Un tapis doux et coloré pour le confort de votre bébé, idéal pour jouer et se reposer.', 29.99, 'tapis bébé.jpg'),
(6, 'Veilleuse Lumineuse et Musicale LED Rechargeable', 'Veilleuse LED avec musique douce et recharge USB, parfaite pour apaiser votre bébé pendant la nuit.jpg', 24.99, 'veilleuse lumineuse et musical led rechargable.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
