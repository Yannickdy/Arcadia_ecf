-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 juil. 2024 à 19:16
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `animaux`
--

CREATE TABLE `animaux` (
  `id` int(11) NOT NULL,
  `image_a` blob NOT NULL,
  `nom_a` text NOT NULL,
  `race_a` text NOT NULL,
  `habitat_a` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `animaux`
--

INSERT INTO `animaux` (`id`, `image_a`, `nom_a`, `race_a`, `habitat_a`, `description`) VALUES
(25, 0x363639333061343463646264622e706e67, 'Marty', 'Lion', 'Prairie', 'ddd'),
(27, 0x363639336164306634333330382e706e67, 'timon', 'Lion', 'Savane', 'rggr<br />\r\ngr<br />\r\ngr<br />\r\ng<br />\r\nrg<br />\r\nr<br />\r\ng<br />\r\nhj<br />\r\nj,jhjq<br />\r\n<br />\r\nrgqq'),
(28, 0x363639336165353437633362382e706e67, 'timon', 'Lion', 'Savane', 'rggr<br />\r\ngr<br />\r\ngr<br />\r\ng<br />\r\nrg<br />\r\nr<br />\r\ng<br />\r\nhj<br />\r\nj,jhjq<br />\r\n<br />\r\nrgqq'),
(29, 0x363639343163613265636434322e706e67, 'Marty', 'Lion', 'Prairie', 'Salut maggle');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `email` text NOT NULL,
  `avis` text NOT NULL,
  `approuve` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `pseudo`, `email`, `avis`, `approuve`) VALUES
(1, 'Naymos', 'jane.smith@example.com', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut pharetra nisl augue, sed porttitor odio fermentum vitae. Maecenas ut luctus enim. Curabitur urna erat, cursus rhoncus purus quis, posuere placerat metus. Duis placerat ex sit amet felis eleifend, at ultrices purus molestie. Integer semper accumsan gravida. Proin fermentum mauris ex, et ornare elit viverra vel. Pellentesque pulvinar eget lectus eget lacinia. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam tincidunt massa ac hendrerit auctor. Quisque gravida ut felis et congue. Suspendisse potenti. Aenean et consectetur justo. Ut venenatis dolor sit amet commodo pharetra. Suspendisse eget nulla eu nibh ornare vehicula in vitae ex. Nulla vitae convallis nibh.', 1);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_demande` timestamp NOT NULL DEFAULT current_timestamp(),
  `traitee` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `titre`, `description`, `email`, `date_demande`, `traitee`) VALUES
(1, 'bonjour', 'yannickdorryhee', 'jane.smith@example.com', '2024-07-03 20:57:51', 0),
(2, 'bonjour', 'yannickdorryhee', 'jane.smith@example.com', '2024-07-03 20:57:53', 0);

-- --------------------------------------------------------

--
-- Structure de la table `info_veterinaire`
--

CREATE TABLE `info_veterinaire` (
  `id` int(11) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `etat_animal` varchar(255) NOT NULL,
  `nourriture` varchar(255) NOT NULL,
  `g_nourriture` float NOT NULL,
  `date_passage` datetime NOT NULL,
  `detail_animal` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `info_veterinaire`
--

INSERT INTO `info_veterinaire` (`id`, `animal_id`, `etat_animal`, `nourriture`, `g_nourriture`, `date_passage`, `detail_animal`) VALUES
(1, 25, 'topccc', 'top', 0, '1995-05-19 00:00:00', 'top');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `identifiant` text NOT NULL,
  `mdp` text NOT NULL,
  `role` text NOT NULL,
  `prenom` text NOT NULL,
  `nom` text NOT NULL,
  `mail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id`, `identifiant`, `mdp`, `role`, `prenom`, `nom`, `mail`) VALUES
(27, 'yves', '0a63b55ccc887cad85cb6b463fb861b4ea9f37b6', 'employe', 'yannick', 'dorryhee', 'yannickdorryhee@gmail.com'),
(28, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'admin', 'admin', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animaux`
--
ALTER TABLE `animaux`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `info_veterinaire`
--
ALTER TABLE `info_veterinaire`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `animal_id` (`animal_id`) USING BTREE;

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animaux`
--
ALTER TABLE `animaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `info_veterinaire`
--
ALTER TABLE `info_veterinaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `info_veterinaire`
--
ALTER TABLE `info_veterinaire`
  ADD CONSTRAINT `info_veterinaire_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animaux` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
