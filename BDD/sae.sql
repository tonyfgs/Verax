

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
                                         `idArticle` decimal(10,0) NOT NULL,
    `auteur` varchar(30) DEFAULT NULL,
    `description` text,
    `titre` varchar(30) NOT NULL,
    `contenu` text NOT NULL,
    `temps` decimal(10,0) NOT NULL,
    `datePub` date NOT NULL,
    `imagePrincipale` text,
    PRIMARY KEY (`idArticle`)
    ) ;

DROP TABLE IF EXISTS `bannir`;
CREATE TABLE IF NOT EXISTS `bannir` (
    `pseudoUser` varchar(30) NOT NULL,
    `pseudoModo` varchar(30) NOT NULL,
    `motif` text NOT NULL,
    PRIMARY KEY (`pseudoUser`,`pseudoModo`)
    );

DROP TABLE IF EXISTS `concerne`;
CREATE TABLE IF NOT EXISTS `concerne` (
                                          `codeLoi` decimal(10,0) DEFAULT NULL,
    `idArticle` decimal(10,0) DEFAULT NULL
    );

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
                                              `id` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) DEFAULT NULL,
    `type` text NOT NULL,
    `contenu` text NOT NULL,
    PRIMARY KEY (`id`)
    );


DROP TABLE IF EXISTS `consulter`;
CREATE TABLE IF NOT EXISTS `consulter` (
                                           `idConsultation` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) NOT NULL,
    `motif` text NOT NULL,
    PRIMARY KEY (`idConsultation`,`pseudo`)
    );


DROP TABLE IF EXISTS `contribue`;
CREATE TABLE IF NOT EXISTS `contribue` (
                                           `id` int NOT NULL AUTO_INCREMENT,
                                           `theme` varchar(30) NOT NULL,
    `datePublication` date NOT NULL,
    `link` varchar(256) NOT NULL,
    `pseudo` varchar(256) NOT NULL,
    PRIMARY KEY (`id`)
    );


DROP TABLE IF EXISTS `discuter`;
CREATE TABLE IF NOT EXISTS `discuter` (
                                          `idMessage` decimal(10,0) NOT NULL,
    `idArticle` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) NOT NULL,
    `message` text NOT NULL,
    `datePublication` date NOT NULL,
    PRIMARY KEY (`idMessage`)
    );

DROP TABLE IF EXISTS `loi`;
CREATE TABLE IF NOT EXISTS `loi` (
                                     `codeLoi` decimal(10,0) NOT NULL,
    `amende` decimal(10,0) NOT NULL,
    PRIMARY KEY (`codeLoi`)
    );


DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
                                      `idArticle` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) NOT NULL,
    `note` int NOT NULL,
    PRIMARY KEY (`idArticle`,`pseudo`)
    );


INSERT INTO `note` (`idArticle`, `pseudo`, `note`) VALUES
                                                       ('1', 'admin', -1),
                                                       ('3', 'admin', 1);


DROP TABLE IF EXISTS `posseder`;
CREATE TABLE IF NOT EXISTS `posseder` (
    `pseudo` varchar(30) NOT NULL,
    `roleUtil` char(1) NOT NULL,
    PRIMARY KEY (`pseudo`,`roleUtil`)
    );


DROP TABLE IF EXISTS `rediger`;
CREATE TABLE IF NOT EXISTS `rediger` (
                                         `idArticle` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) NOT NULL,
    PRIMARY KEY (`pseudo`,`idArticle`)
    );


DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
    `roleUtil` char(1) NOT NULL,
    PRIMARY KEY (`roleUtil`)
    ) ;

DROP TABLE IF EXISTS `signalement`;
CREATE TABLE IF NOT EXISTS `signalement` (
                                             `id` int NOT NULL AUTO_INCREMENT,
                                             `dateSignalement` date NOT NULL,
                                             `motif` text NOT NULL,
                                             `idArticle` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) NOT NULL,
    PRIMARY KEY (`id`)
    );


DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
                                       `idArticle` decimal(10,0) NOT NULL,
    `idTheme` varchar(30) NOT NULL,
    PRIMARY KEY (`idArticle`,`idTheme`)
    );


DROP TABLE IF EXISTS `supprime`;
CREATE TABLE IF NOT EXISTS `supprime` (
                                          `idArticle` decimal(10,0) NOT NULL,
    `pseudo` varchar(30) NOT NULL,
    `motif` text NOT NULL,
    PRIMARY KEY (`idArticle`,`pseudo`)
    );

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
    `theme` varchar(30) NOT NULL,
    PRIMARY KEY (`theme`)
    );

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
    `pseudo` varchar(30) NOT NULL,
    `nom` varchar(30) NOT NULL,
    `prenom` varchar(30) NOT NULL,
    `mdp` varchar(255) NOT NULL,
    `mail` varchar(30) NOT NULL,
    `roleUtil` char(1) NOT NULL,
    PRIMARY KEY (`pseudo`)
    );
