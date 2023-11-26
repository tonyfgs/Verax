-- Drop tables if they exist
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

-- Table structure for article
CREATE TABLE article (
                         idArticle DECIMAL(10,0) PRIMARY KEY,
                         auteur VARCHAR(30),
                         description VARCHAR(30),
                         titre VARCHAR(30) NOT NULL,
                         contenu TEXT NOT NULL,
                         temps DECIMAL(10,0) NOT NULL CHECK (temps > 0),
                         datePub DATE NOT NULL
);

-- Table structure for loi
CREATE TABLE loi (
                     codeLoi DECIMAL(10,0) PRIMARY KEY,
                     amende DECIMAL(10,0) NOT NULL
);

-- Table structure for concerne
CREATE TABLE concerne (
                          codeLoi DECIMAL(10,0) REFERENCES loi,
                          idArticle DECIMAL(10,0) REFERENCES article
);

-- Table structure for role
CREATE TABLE role (
    roleUtil CHAR(1) PRIMARY KEY CHECK (roleUtil IN ('U','R','M','A'))
);

-- Table structure for utilisateur
CREATE TABLE utilisateur (
                             pseudo VARCHAR(30) PRIMARY KEY,
                             nom VARCHAR(30) NOT NULL,
                             prenom VARCHAR(30) NOT NULL,
                             mdp VARCHAR(255) NOT NULL,
                             mail VARCHAR(30) NOT NULL,
                             roleUtil CHAR(1) NOT NULL REFERENCES role
);

-- Table structure for note
CREATE TABLE note (
                      idArticle DECIMAL(10,0) NOT NULL REFERENCES article,
                      pseudo VARCHAR(30) NOT NULL REFERENCES utilisateur,
                      note NUMERIC NOT NULL CHECK (note IN (1,-1)),
                      PRIMARY KEY(idArticle,pseudo)
);

-- Table structure for posseder
CREATE TABLE posseder (
                          pseudo VARCHAR(30) REFERENCES utilisateur,
                          roleUtil CHAR(1) REFERENCES role,
                          PRIMARY KEY (pseudo,roleUtil)
);

-- Table structure for theme
CREATE TABLE theme (
    theme VARCHAR(30) PRIMARY KEY
);

-- Table structure for sujet
CREATE TABLE sujet (
                       idArticle DECIMAL(10,0) REFERENCES article,
                       idTheme VARCHAR(30) REFERENCES theme,
                       PRIMARY KEY(idArticle,idTheme)
);

-- Table structure for contribue
CREATE TABLE contribue (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(10) NOT NULL,
    mail VARCHAR(256) NOT NULL,
    nom VARCHAR(256) NOT NULL,
    prenom VARCHAR(256) NOT NULL
);

-- Table structure for discuter
CREATE TABLE discuter (
                          idMessage DECIMAL(10,0) PRIMARY KEY,
                          idArticle DECIMAL(10,0) NOT NULL REFERENCES article,
                          pseudo VARCHAR(30) NOT NULL REFERENCES utilisateur,
                          message TEXT NOT NULL,
                          datePublication DATE NOT NULL
);

-- Table structure for supprime
CREATE TABLE supprime (
                          idArticle DECIMAL(10,0) REFERENCES article,
                          pseudo VARCHAR(30) REFERENCES utilisateur,
                          motif TEXT NOT NULL,
                          PRIMARY KEY(idArticle,pseudo)
);

-- Table structure for bannir
CREATE TABLE bannir (
                        pseudoUser VARCHAR(30) REFERENCES utilisateur,
                        pseudoModo VARCHAR(30) REFERENCES utilisateur,
                        motif TEXT NOT NULL,
                        PRIMARY KEY(pseudoUser,pseudoModo)
);

-- Table structure for consultation
CREATE TABLE consultation (
                              id DECIMAL(10,0) PRIMARY KEY,
                              pseudo VARCHAR(30) REFERENCES utilisateur,
                              type TEXT NOT NULL,
                              contenu TEXT NOT NULL
);

-- Table structure for consulter
CREATE TABLE consulter (
                           idConsultation DECIMAL(10,0) REFERENCES consultation,
                           pseudo VARCHAR(30) REFERENCES utilisateur,
                           motif TEXT NOT NULL,
                           PRIMARY KEY(idConsultation, pseudo)
);

-- Table structure for rediger
CREATE TABLE rediger (
                         idArticle DECIMAL(10,0) REFERENCES article,
                         pseudo VARCHAR(30) REFERENCES utilisateur,
                         PRIMARY KEY(pseudo,idArticle)
);