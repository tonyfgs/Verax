# Rendue de la partie SAE - Rapport

[...retour au sommaire](../README.md)

---

La date de rendu de la partie PHP de la SAE ayant été atteinte, ce petit rapport a simplement vocation à faire un tour général de ce qui a pu être fait par notre groupe.

C'est ainsi l'occasion de revenir sur les différentes modalités de notation énoncées dans le premier PDF de cours et, au besoin, de préciser certains éléments/fonctionnements dans notre code.

# Attendus minimaux

### PDO et pattern Gateway 

Dans le cadre de notre projet, nous avons directement intégré la classe de connexion fournie dans le cours, qui intègre bien de son côté PDO. 

A l'aide de cette classe de connexion, nous avons été en mesure de construire différentes Gateways, pour intéragir avec notre base de données. 

**Exemple de Gateways du projet :**

* [Gateway utilisateur](../PHP/dal/gateways/UtilisateurGateway.php)
* [Gateway Article](../PHP/dal/gateways/ArticleGateway.php)
* [Gateway formulaire](../PHP/dal/gateways/FormulaireGateway.php)
* [Gateway notes](../PHP/dal/gateways/NoteGateway.php)


### Implémentation MVC et 2 contrôleurs

Nous avons bien pris soin de séparer la partie vue, des contrôleurs et du modèle.

Notre partie PHP est donc constituée d'un dossier `Vue` contenant toutes les vues, ainsi qu'un dossier `controleur` rassemblant tous les contrôleurs du projet. 

En plus de cela, un dossier `metier` rassemble des classes métiers, mais il a vocation, dans les jours à venir, à être déplace dans le dossier `modele`.

En ce qui concerne nos contrôleurs, la grande majorité a déjà été commencée, et d'autres sont particulièrement complets. 

**Trois contrôleurs du projet bien aboutis :**
* [Contrôleur des visiteurs](../PHP/controleur/VisiteurControleur.php)
* [Contrôleur des admins](../PHP/controleur/AdminControleur.php)
* [Contrôleur des utlisateurs](../PHP/controleur/UtilisateurControleur.php)

### Pattern Frontcontroleur sans routage

### Autoloader simple sans namespace 

### Validation des entrées 

### Vues dont vue d'erreur 

### Partie administration ou équivalent 


# Attendus

### Au dessus +

### Vues complètes bien segmentées et utilisation de bootstrap 


### Utilisation de namespace PSR4 

### Moteur TWIG pour les vues 

### Pattern Frontcontroleur avec routage 


# Au delà