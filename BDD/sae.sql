-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 06 nov. 2023 à 12:43
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

--
-- Base de données : `sae`
--


DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS concerne;
DROP TABLE IF EXISTS contribue;
DROP TABLE IF EXISTS loi;
DROP TABLE IF EXISTS note;
DROP TABLE IF EXISTS posseder;
DROP TABLE IF EXISTS supprime;
DROP TABLE IF EXISTS role;
DROP TABLE IF EXISTS sujet;
DROP TABLE IF EXISTS theme;
DROP TABLE IF EXISTS discuter;
DROP TABLE IF EXISTS bannir;
DROP TABLE IF EXISTS consultation;
DROP TABLE IF EXISTS consulter;
DROP TABLE IF EXISTS rediger;

-- --------------------------------------------------------

--
-- Structure de la table `Article`
--

CREATE TABLE `article` (
  `idArticle` decimal(10,0),
  `titre` varchar(30) NOT NULL,
  `contenu` text NOT NULL,
  `temps` decimal(10,0) NOT NULL CHECK (`temps` > 0),
  `datePub` date NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Concerne`
--

CREATE TABLE `concerne` (
  `codeLoi` decimal(10,0) NOT NULL,
  `idArticle` decimal(10,0) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Contribue`
--

CREATE TABLE `contribue` (
  `idArticle` decimal(10,0) NOT NULL,
  `pseudo` varchar(30) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Loi`
--

CREATE TABLE `loi` (
  `codeLoi` decimal(10,0) NOT NULL,
  `amende` decimal(10,0) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Note`
--

CREATE TABLE `note` (
  `idArticle` decimal(10,0) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `note` numeric NOT NULL CHECK (`note` in (1,-1))
);

-- --------------------------------------------------------

--
-- Structure de la table `Posseder`
--

CREATE TABLE `posseder` (
  `pseudo` varchar(30) NOT NULL,
  `roleUtil` char(1) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Role`
--

CREATE TABLE `role` (
  `roleUtil` char(1) NOT NULL CHECK (`roleUtil` in ('U','R','M','A'))
);

-- --------------------------------------------------------

--
-- Structure de la table `Sujet`
--

CREATE TABLE `sujet` (
  `idArticle` decimal(10,0) NOT NULL,
  `idTheme` varchar(30) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Supprime`
--

CREATE TABLE `supprime` (
  `idArticle` decimal(10,0) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `motif` text NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Theme`
--

CREATE TABLE `theme` (
  `theme` varchar(30) NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `utilisateur` (
  `pseudo` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `roleUtil` char(1) NOT NULL REFERENCES Role
);

CREATE TABLE discuter (
  idMessage decimal(10,0) PRIMARY KEY,
  idArticle decimal(10,0) NOT NULL REFERENCES article,
  pseudo varchar(30) NOT NULL REFERENCES utilisateur,
  message TEXT NOT NULL,
  datePublication DATE NOT NULL
);

CREATE TABLE `bannir` (
  `pseudoUser` varchar(30) REFERENCES utilisateur,
  `pseudoModo` varchar(30) REFERENCES utilisateur,
  `motif` text NOT NULL,
  PRIMARY KEY(`pseudoUser`,`pseudoModo`)
);

CREATE TABLE `consultation` (
  id decimal(10,0) PRIMARY KEY,
  `contenu` text NOT NULL
);


CREATE TABLE `consulter` (
  `idConsultation` decimal(10,0) REFERENCES consultation,
  `pseudo` varchar(30) REFERENCES utilisateur,
  `motif` text NOT NULL,
  PRIMARY KEY(`idConsultation`, `pseudo`)
);

CREATE TABLE `rediger` (
  `idArticle` decimal(10,0) REFERENCES article,
  `pseudo` varchar(30) REFERENCES utilisateur,
  PRIMARY KEY(`pseudo`,`idArticle`)
);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `Concerne`
--
ALTER TABLE `concerne`
  ADD PRIMARY KEY (`codeLoi`,`idArticle`);

--
-- Index pour la table `Contribue`
--
ALTER TABLE `contribue`
  ADD PRIMARY KEY (`idArticle`,`pseudo`);

--
-- Index pour la table `Loi`
--
ALTER TABLE `loi`
  ADD PRIMARY KEY (`codeLoi`);

--
-- Index pour la table `Note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`idArticle`,`pseudo`);

--
-- Index pour la table `Posseder`
--
ALTER TABLE `posseder`
  ADD PRIMARY KEY (`pseudo`,`roleUtil`);

--
-- Index pour la table `Role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleUtil`);

--
-- Index pour la table `Sujet`
--
ALTER TABLE `sujet`
  ADD PRIMARY KEY (`idArticle`,`idTheme`);

--
-- Index pour la table `Supprime`
--
ALTER TABLE `supprime`
  ADD PRIMARY KEY (`idArticle`,`pseudo`);

--
-- Index pour la table `Theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`theme`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
