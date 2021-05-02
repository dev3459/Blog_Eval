-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 02 mai 2021 à 02:27
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `live_patterns`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_bin DEFAULT NULL,
  `user_fk` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `publish` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `content`, `user_fk`, `title`, `publish`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at consequat justo. Vivamus id nibh sed neque varius porta. Phasellus aliquet elit eu sem lacinia, non luctus quam consequat. Mauris maximus ex quis porttitor pellentesque. Integer augue ante, dictum in placerat et, semper sed augue. Proin scelerisque, magna vitae ultricies sagittis, odio odio tempor tellus, eu aliquet ex felis sed arcu. Maecenas feugiat velit nec tellus fringilla, eget placerat nisi maximus. In est est, fringilla in urna id, malesuada placerat tellus. Ut dignissim, nulla efficitur viverra rutrum, eros tortor ornare nisl, ac dignissim ante justo a lectus. Vivamus consectetur ex ligula, sit amet pretium leo convallis eget. Morbi tincidunt efficitur magna quis sodales. Nulla turpis nunc, rutrum ut tristique vel, semper finibus ex. Sed sapien augue, pulvinar in dui finibus, consequat tristique metus. Vestibulum at iaculis mi.', 1, 'Lorem ipsum dolor sit amet', '2021-05-02 02:25:47');

-- --------------------------------------------------------

--
-- Structure de la table `articlecomment`
--

CREATE TABLE `articlecomment` (
  `id` int(10) UNSIGNED NOT NULL,
  `article_fk` int(10) UNSIGNED NOT NULL,
  `user_fk` int(10) UNSIGNED NOT NULL,
  `comment_fk` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `articlecomment`
--

INSERT INTO `articlecomment` (`id`, `article_fk`, `user_fk`, `comment_fk`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `publish` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `publish`) VALUES
(1, 'Proin id lectus sem. Morbi nec mattis massa. Nulla a leo a justo lacinia iaculis. Nulla sagittis rutrum sem, at rutrum odio faucibus nec. Integer consectetur tincidunt ultricies. Aenean sem lorem, gravida ac lectus ut, consectetur tempor ipsum. Sed blandit mattis ipsum, ac tempus nunc pharetra sed. Cras pellentesque ligula nibh, in vestibulum mi auctor non. Mauris convallis a massa vel viverra. Duis sodales volutpat volutpat. Proin eu varius lectus, quis maximus dui.', '2021-05-02 02:26:17'),
(2, 'Nulla euismod libero eget rutrum vulputate. In bibendum porta risus, at vestibulum tellus egestas ut. Quisque quis malesuada ex, ac rutrum urna. Duis lobortis nunc tortor, vel vulputate nisi vehicula in. Morbi rutrum purus ac ligula posuere, at lobortis orci vestibulum. Vivamus in faucibus est, aliquet sagittis lorem. Vivamus finibus dui sit amet mi semper, nec fermentum ligula varius.', '2021-05-02 02:26:27');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `admin` int(10) UNSIGNED NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `admin`, `created`) VALUES
(1, 'admin', '$2y$10$aL9GFU3qiMwJjChG/8u99.cRIJktkeg6fplULPV31BrIeN3rKpDfa', 1, '2021-05-02 01:55:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk_article` (`user_fk`);

--
-- Index pour la table `articlecomment`
--
ALTER TABLE `articlecomment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_fk_artcom` (`article_fk`),
  ADD KEY `user_fk_artcom` (`user_fk`),
  ADD KEY `comment_fk_article` (`comment_fk`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `articlecomment`
--
ALTER TABLE `articlecomment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `user_fk_article` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articlecomment`
--
ALTER TABLE `articlecomment`
  ADD CONSTRAINT `article_fk_artcom` FOREIGN KEY (`article_fk`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_fk_article` FOREIGN KEY (`comment_fk`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk_artcom` FOREIGN KEY (`user_fk`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
