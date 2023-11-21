-- Supprime les tables si elles existent
DROP TABLE IF EXISTS rediger;
DROP TABLE IF EXISTS consulter;
DROP TABLE IF EXISTS consultation;
DROP TABLE IF EXISTS bannir;
DROP TABLE IF EXISTS supprime;
DROP TABLE IF EXISTS discuter;
DROP TABLE IF EXISTS sujet;
DROP TABLE IF EXISTS posseder;
DROP TABLE IF EXISTS note;
DROP TABLE IF EXISTS concerne;
DROP TABLE IF EXISTS contribue;
DROP TABLE IF EXISTS theme;
DROP TABLE IF EXISTS loi;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS role;

-- Structure de la table Article
CREATE TABLE article (
  idArticle decimal(10,0) PRIMARY KEY,
  titre varchar(30) NOT NULL,
  contenu text NOT NULL,
  temps decimal(10,0) NOT NULL CHECK (temps > 0),
  datePub date NOT NULL
);

-- Structure de la table Loi
CREATE TABLE loi (
  codeLoi decimal(10,0) PRIMARY KEY,
  amende decimal(10,0) NOT NULL
);

-- Structure de la table Concerne
CREATE TABLE concerne (
  codeLoi decimal(10,0),
  idArticle decimal(10,0),
  PRIMARY KEY (codeLoi, idArticle),
  FOREIGN KEY (codeLoi) REFERENCES loi(codeLoi),
  FOREIGN KEY (idArticle) REFERENCES article(idArticle)
);

-- Structure de la table Role
CREATE TABLE role (
  roleUtil char(1) PRIMARY KEY CHECK (roleUtil IN ('U','R','M','A'))
);

-- Structure de la table Utilisateur
CREATE TABLE utilisateur (
  pseudo varchar(30) PRIMARY KEY,
  nom varchar(30) NOT NULL,
  prenom varchar(30) NOT NULL,
  mdp varchar(255) NOT NULL,
  mail varchar(30) NOT NULL,
  roleUtil char(1) NOT NULL,
  FOREIGN KEY (roleUtil) REFERENCES role(roleUtil)
);

-- Structure de la table Note
CREATE TABLE note (
  idArticle decimal(10,0) NOT NULL,
  pseudo varchar(30) NOT NULL,
  note numeric NOT NULL CHECK (note IN (1, -1)),
  PRIMARY KEY (idArticle, pseudo),
  FOREIGN KEY (idArticle) REFERENCES article(idArticle),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo)
);

-- Structure de la table Posseder
CREATE TABLE posseder (
  pseudo varchar(30),
  roleUtil char(1),
  PRIMARY KEY (pseudo, roleUtil),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo),
  FOREIGN KEY (roleUtil) REFERENCES role(roleUtil)
);

-- Structure de la table Theme
CREATE TABLE theme (
  theme varchar(30) PRIMARY KEY
);

-- Structure de la table Sujet
CREATE TABLE sujet (
  idArticle decimal(10,0),
  idTheme varchar(30),
  PRIMARY KEY (idArticle, idTheme),
  FOREIGN KEY (idArticle) REFERENCES article(idArticle),
  FOREIGN KEY (idTheme) REFERENCES theme(theme)
);

-- Structure de la table Contribue
CREATE TABLE contribue (
  idArticle decimal(10,0),
  pseudo varchar(30),
  PRIMARY KEY (idArticle, pseudo),
  FOREIGN KEY (idArticle) REFERENCES article(idArticle),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo)
);

-- Structure de la table Discuter
CREATE TABLE discuter (
  idMessage decimal(10,0) PRIMARY KEY,
  idArticle decimal(10,0) NOT NULL,
  pseudo varchar(30) NOT NULL,
  message text NOT NULL,
  datePublication date NOT NULL,
  FOREIGN KEY (idArticle) REFERENCES article(idArticle),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo)
);

-- Structure de la table Supprime
CREATE TABLE supprime (
  idArticle decimal(10,0),
  pseudo varchar(30),
  motif text NOT NULL,
  PRIMARY KEY (idArticle, pseudo),
  FOREIGN KEY (idArticle) REFERENCES article(idArticle),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo)
);

-- Structure de la table Bannir
CREATE TABLE bannir (
  pseudoUser varchar(30),
  pseudoModo varchar(30),
  motif text NOT NULL,
  PRIMARY KEY (pseudoUser, pseudoModo),
  FOREIGN KEY (pseudoUser) REFERENCES utilisateur(pseudo),
  FOREIGN KEY (pseudoModo) REFERENCES utilisateur(pseudo)
);

-- Structure de la table Consultation
CREATE TABLE consultation (
  id decimal(10,0) PRIMARY KEY,
  contenu text NOT NULL
);

-- Structure de la table Consulter
CREATE TABLE consulter (
  idConsultation decimal(10,0),
  pseudo varchar(30),
  motif text NOT NULL,
  PRIMARY KEY (idConsultation, pseudo),
  FOREIGN KEY (idConsultation) REFERENCES consultation(id),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo)
);

-- Structure de la table Rediger
CREATE TABLE rediger (
  idArticle decimal(10,0),
  pseudo varchar(30),
  PRIMARY KEY (pseudo, idArticle),
  FOREIGN KEY (idArticle) REFERENCES article(idArticle),
  FOREIGN KEY (pseudo) REFERENCES utilisateur(pseudo)
);
