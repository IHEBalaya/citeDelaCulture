-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2019 at 12:00 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `article`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `titre_article` varchar(255) DEFAULT NULL,
  `type_article` varchar(255) DEFAULT NULL,
  `description_article` text,
  `contenu_article` text,
  `date_publication` date DEFAULT NULL,
  `image_article` varchar(255) DEFAULT NULL,
  `journaliste` int(11) DEFAULT NULL,
  `statut_article` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `titre_article`, `type_article`, `description_article`, `contenu_article`, `date_publication`, `image_article`, `journaliste`, `statut_article`) VALUES
(106, 'Article de l\'admin', 'Musique', 'Description de l\'article de l\'admin', '<p>Contenu de l&#39;article de l&#39;admin</p>', '2019-02-27', '290d9e091657acee1fa7196e16bd816c.jpeg', 6, 'supprimé'),
(107, 'Article de Emir', 'Sculpture', 'Desc', '<p>Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu Contenu</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '2019-02-27', '03cc7ccd40027c7c09a5e95ee99f0b4b.jpeg', 3, 'supprimé'),
(108, 'Article test', 'Cinéma', 'Hello', '<p>Hello</p>', '2019-02-27', '7a546cde63e18249d8fccd6b42737bae.jpeg', 2, 'publié'),
(109, 'article', 'Musique', 'article', '<p>article</p>', '2019-02-27', '3826af921009e8f3b595029facf40792.jpeg', 2, 'supprimé'),
(110, 'hahahaha', 'Art', 'article', '<p>article</p>', '2019-03-11', NULL, 3, 'publié'),
(111, 'zeaezaeza', 'Peinture', 'azezaea		ezaeaeazezzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ezaeaeazezzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', '2019-04-07', 'img050.jpg', 6, 'publié'),
(112, 'aaaa', 'Culture', 'aaaa	', 'aaaaaaaaaaa', NULL, 'Waterfall-Landscape.jpg', 5, 'non_publié'),
(113, 'Emir', 'Culture', 'EMi44', 'EMIR', '2019-04-10', 'Uncharted-4-06.jpg', 6, 'publié'),
(114, 'Titre', 'Art', 'aaaaa', 'Art', NULL, 'Waterfall-Landscape.jpg', 5, 'non_publié'),
(115, 'Titre', 'Art', 'aaaaa', 'Art', NULL, 'Waterfall-Landscape.jpg', 5, 'non_publié'),
(116, 'aaaaa', 'Musée', 'aaaaa	', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa55555', '2019-04-15', 'Waterfall-Landscape.jpg', 6, 'supprimé'),
(117, 'oui test', 'Musique', 'test', 'test5', NULL, 'Waterfall-Landscape.jpg', 6, 'supprimé'),
(118, 'lola', 'Culture', 'lola', 'lola', '2019-04-15', 'SIC PARVIS MAGNA.jpg', 6, 'publié'),
(119, 'aaaa', 'Musique', 'Aaaaaaaaaaaa', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaaAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAaaa', '2019-04-16', 'nature_waterfall_summer_lake_trees_90400_1920x1080.jpg', 6, 'publié'),
(120, 'lol', 'Cinema', 'aaaa', 'aaaaa', NULL, '187324_1467641880.0757.jpg', 6, 'non_publié'),
(121, 'lol', 'Cinema', 'aaaa', 'aaaaa', NULL, '187324_1467641880.0757.jpg', 6, 'supprimé'),
(122, 'lol', 'Cinema', 'aaaa', 'aaaaa', NULL, '187324_1467641880.0757.jpg', 6, 'supprimé'),
(123, 'lol', 'Cinema', 'aaaa', 'aaaaa', NULL, '187324_1467641880.0757.jpg', 6, 'supprimé');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire_article`
--

CREATE TABLE `commentaire_article` (
  `id_commentaire` int(11) NOT NULL,
  `id_article` int(11) DEFAULT NULL,
  `commentateur` int(11) DEFAULT NULL,
  `contenu_commentaire` varchar(255) DEFAULT NULL,
  `date_commentaire` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commentaire_article`
--

INSERT INTO `commentaire_article` (`id_commentaire`, `id_article`, `commentateur`, `contenu_commentaire`, `date_commentaire`) VALUES
(29, 111, 6, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2019-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `id_discussion` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `id_sujet` int(11) NOT NULL,
  `commentateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discussion`
--

INSERT INTO `discussion` (`id_discussion`, `commentaire`, `id_sujet`, `commentateur`) VALUES
(9, 'waaaaaaaaaaa', 4, 6),
(10, 'salut', 4, 6),
(11, 'waaaaaaaaa', 4, 5),
(12, 'lol\n', 5, 5),
(13, 'ooo$\n\n', 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(2, 'Karim', 'karim', 'karim@karim.fr', 'karim@karim.fr', 1, NULL, '$2y$13$obhvG8TpH7SVuwr70YPymOcw0xbeD9HYoYPRb.hlVWUgcKlFRUJNC', '2019-02-27 15:05:26', '8d_2y1RX9FnA6FEFa8IO5uVyjDMju_3mZBU-M46IjfA', NULL, 'a:0:{}'),
(3, 'Emir', 'emir', 'Emir@Emir.em', 'emir@emir.em', 1, NULL, '$2y$13$hBfCKrRdFwhk45K5PG0gH.792JekHhl43SP1PXfuEoFToZK4FkUG2', '2019-02-27 15:04:49', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_JOURNALISTE\";}'),
(4, 'Lamjed', 'Lamjed', 'Lamjed@a.a', 'Lamjed@a.a', 1, NULL, '$2y$13$obhvG8TpH7SVuwr70YPymOcw0xbeD9HYoYPRb.hlVWUgcKlFRUJNC', '2019-02-26 16:24:28', NULL, NULL, 'a:0:{}'),
(5, 'Lotfi', 'Lotfi', 'lotfi@lotfi.fr', 'lotfi@lotfi.fr', 1, NULL, '$2y$13$obhvG8TpH7SVuwr70YPymOcw0xbeD9HYoYPRb.hlVWUgcKlFRUJNC', '2019-02-27 03:39:49', NULL, NULL, 'a:0:{}'),
(6, 'Admin', 'admin', 'admin@admin.tn', 'admin@admin.tn', 1, NULL, '$2y$13$6WRXnSQmiDJuDWhgRApVMuhXGuX2MXTYdCZxQZOFXN9h4SB7leW.e', '2019-02-27 15:05:52', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id_personne` int(11) NOT NULL,
  `nom_personne` varchar(255) DEFAULT NULL,
  `prenom_personne` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reaction`
--

CREATE TABLE `reaction` (
  `id_reaction` int(11) NOT NULL,
  `reaction` text,
  `reacteur` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reaction`
--

INSERT INTO `reaction` (`id_reaction`, `reaction`, `reacteur`, `id_article`) VALUES
(27, '1', 6, 107),
(28, 'positive', 6, 106),
(29, '1', 3, 106),
(30, '0', 2, 106),
(31, 'positive', 6, 110),
(32, 'positive', 6, 111),
(33, 'positive', 6, 108);

-- --------------------------------------------------------

--
-- Table structure for table `sujet`
--

CREATE TABLE `sujet` (
  `id_sujet` int(11) NOT NULL,
  `titre_sujet` varchar(250) NOT NULL,
  `createur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sujet`
--

INSERT INTO `sujet` (`id_sujet`, `titre_sujet`, `createur`) VALUES
(4, 'zaefsdaaaa', 6),
(5, 'aaaaazzzzaaa999999', 6),
(6, 'Sujet 12', 6),
(7, 'yoooooo', 6),
(9, 'aaaa', 6),
(10, 'lolo', 6),
(11, 'lol', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `article_ibfk_1` (`journaliste`);

--
-- Indexes for table `commentaire_article`
--
ALTER TABLE `commentaire_article`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `FK_71F29C35DCA7A716` (`id_article`),
  ADD KEY `FK_71F29C355F61D8B4` (`commentateur`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`id_discussion`),
  ADD KEY `id_sujet` (`id_sujet`),
  ADD KEY `commentateur` (`commentateur`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- Indexes for table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id_personne`);

--
-- Indexes for table `reaction`
--
ALTER TABLE `reaction`
  ADD PRIMARY KEY (`id_reaction`),
  ADD KEY `FK_A4D707F7DCA7A716` (`id_article`),
  ADD KEY `FK_A4D707F79E15807` (`reacteur`);

--
-- Indexes for table `sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`id_sujet`),
  ADD KEY `sujet_ibfk_1` (`createur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `commentaire_article`
--
ALTER TABLE `commentaire_article`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `id_discussion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id_personne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reaction`
--
ALTER TABLE `reaction`
  MODIFY `id_reaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sujet`
--
ALTER TABLE `sujet`
  MODIFY `id_sujet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`journaliste`) REFERENCES `fos_user` (`id`);

--
-- Constraints for table `commentaire_article`
--
ALTER TABLE `commentaire_article`
  ADD CONSTRAINT `FK_71F29C355F61D8B4` FOREIGN KEY (`commentateur`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_71F29C35DCA7A716` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`);

--
-- Constraints for table `discussion`
--
ALTER TABLE `discussion`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`id_sujet`) REFERENCES `sujet` (`id_sujet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `discussion_ibfk_2` FOREIGN KEY (`commentateur`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reaction`
--
ALTER TABLE `reaction`
  ADD CONSTRAINT `FK_A4D707F79E15807` FOREIGN KEY (`reacteur`) REFERENCES `fos_user` (`id`),
  ADD CONSTRAINT `FK_A4D707F7DCA7A716` FOREIGN KEY (`id_article`) REFERENCES `article` (`id_article`);

--
-- Constraints for table `sujet`
--
ALTER TABLE `sujet`
  ADD CONSTRAINT `sujet_ibfk_1` FOREIGN KEY (`createur`) REFERENCES `fos_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
