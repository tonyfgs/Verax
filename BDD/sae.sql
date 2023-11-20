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
  `idArticle` decimal(10,0) PRIMARY KEY,
  `titre` varchar(30) NOT NULL,
  `contenu` text NOT NULL,
  `temps` decimal(10,0) NOT NULL CHECK (`temps` > 0),
  `datePub` date NOT NULL
);

-- --------------------------------------------------------

--
-- Structure de la table `Concerne`
--

CREATE TABLE `loi` (
  `codeLoi` decimal(10,0) PRIMARY KEY,
  `amende` decimal(10,0) NOT NULL
);


CREATE TABLE `concerne` (
  `codeLoi` decimal(10,0) REFERENCES loi,
  `idArticle` decimal(10,0) REFERENCES article
);



CREATE TABLE `role` (
  `roleUtil` char(1) PRIMARY KEY CHECK (`roleUtil` in ('U','R','M','A'))
);


CREATE TABLE `utilisateur` (
  `pseudo` varchar(30) PRIMARY KEY,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(30) NOT NULL,
  `roleUtil` char(1) NOT NULL REFERENCES Role
);

CREATE TABLE `note` (
  `idArticle` decimal(10,0) NOT NULL REFERENCES article,
  `pseudo` varchar(30) NOT NULL REFERENCES utilisateur,
  `note` numeric NOT NULL CHECK (`note` in (1,-1)),
  PRIMARY KEY(`idArticle`,`pseudo`)
);

CREATE TABLE `posseder` (
  `pseudo` varchar(30) REFERENCES utilisateur,
  `roleUtil` char(1) REFERENCES role,
  PRIMARY KEY (`pseudo`,`roleUtil`)
);




-- --------------------------------------------------------

--
-- Structure de la table `Sujet`



CREATE TABLE `theme` (
  `theme` varchar(30) PRIMARY KEY
);

CREATE TABLE `sujet` (
  `idArticle` decimal(10,0) REFERENCES article,
  `idTheme` varchar(30) REFERENCES theme,
  PRIMARY KEY(`idArticle`,`idTheme`)
);


-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `contribue` (
  `idArticle` decimal(10,0) REFERENCES article,
  `pseudo` varchar(30) REFERENCES utilisateur,
  PRIMARY KEY(`idArticle`,`pseudo`)
);

CREATE TABLE discuter (
  idMessage decimal(10,0) PRIMARY KEY,
  idArticle decimal(10,0) NOT NULL REFERENCES article,
  pseudo varchar(30) NOT NULL REFERENCES utilisateur,
  message TEXT NOT NULL,
  datePublication DATE NOT NULL
);

CREATE TABLE `supprime` (
  `idArticle` decimal(10,0) REFERENCES article,
  `pseudo` varchar(30) REFERENCES utilisateur,
  `motif` text NOT NULL,
  PRIMARY KEY(`idArticle`,`pseudo`)
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
