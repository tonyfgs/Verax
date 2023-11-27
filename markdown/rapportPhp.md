# Rendue de la partie SAE - Rapport

[...retour au sommaire](../README.md)

---

La date de rendu de la partie PHP de la SAE ayant été atteinte, ce petit rapport a simplement vocation à faire un tour général de ce qui a pu être fait par notre groupe.

C'est ainsi l'occasion de revenir sur les différentes modalités de notation énoncées dans le premier PDF de cours et, au besoin, de préciser certains éléments/fonctionnements dans notre code.

# Attendus minimaux

### PDO et pattern Gateway 

Dans le cadre de notre projet, nous avons directement intégré la classe de connexion fournie dans le cours, qui intègre bien de son côté PDO. 

A l'aide de cette classe de connexion, nous avons été en mesure de construire différentes Gateways, pour interagir avec notre base de données. 

**Exemple de Gateways du projet :**

* [Gateway utilisateur](../PHP/dal/gateways/UtilisateurGateway.php)
* [Gateway Article](../PHP/dal/gateways/ArticleGateway.php)
* [Gateway formulaire](../PHP/dal/gateways/FormulaireGateway.php)
* [Gateway notes](../PHP/dal/gateways/NoteGateway.php)


### Implémentation MVC et 2 contrôleurs

Nous avons bien pris soin de séparer la partie vue, des contrôleurs et du modèle.

Notre partie PHP est donc constituée d'un dossier `Vue` contenant toutes les vues, ainsi qu'un dossier `controleur` rassemblant tous les contrôleurs du projet. 

En plus de cela, un dossier `metier` rassemble des classes métiers, mais il a vocation, dans les jours à venir, à être déplacé dans le dossier `modele`.

En ce qui concerne nos contrôleurs, la grande majorité a déjà été commencée, et d'autres sont particulièrement complets. 

**Trois contrôleurs du projet bien aboutis :**
* [Contrôleur des visiteurs](../PHP/controleur/VisiteurControleur.php)
* [Contrôleur des admins](../PHP/controleur/AdminControleur.php)
* [Contrôleur des utilisateurs](../PHP/controleur/UtilisateurControleur.php)

### Pattern Frontcontroleur sans routage

Nous possédons bien un Frontcontroleur, n'implémentant pas de routage. 

Le voici : [Front contrôleur](../PHP/controleur/FrontControler.php)

### Autoloader simple sans namespace 
Nous utilisations Autoloader directement avec composer. 

Il a été configuré ici : [composer.json](../PHP/composer.json)

### Validation des entrées 

Nous avons construit une classe validation, permettant de mettre au propre les données reçues, et appelée dans l'ensemble du projet lorsqu'il est question de traiter des données récupérées. 

Elle est à retrouver ici : [Validation](../PHP/config/Validation.php). 

### Vues dont vue d'erreur 

Comme dit précédemment, nous avons de multiples vues au sein du projet.

Nous avons par exemple, entre autre, une vue d'accueil, affichant certains des articles du site dans un caroussel : [accueil](../PHP/Vue/accueil.html). 

Nous avons aussi une vue permettant d'afficher de manière propre et élégante les données des différents articles : [Vue des articles](../PHP/Vue/Article.html). 

Une autre vue intéressante est par exemple celle nous permettant de se connecter : [Vue de connexion](../PHP/Vue/connexion.html). 

Et pour finir, notre projet possède aussi une vue réservée aux erreurs : [Vue d'erreur](../PHP/Vue/error.html). 

### Partie administration ou équivalent 


# Attendus

### Au dessus +

### Vues complètes bien segmentées et utilisation de bootstrap


### Utilisation de namespace PSR4 
Notre projet est entièrement couvert par des namespaces. 

Toutes les informations sont à retrouver ici : [composer.json](../PHP/composer.json)

### Moteur TWIG pour les vues 

La très grande majorité de nos vues utiles twig pour afficher les données issues du modèle. La [vue d'accueil](../PHP/Vue/accueil.html) et [d'article](../PHP/Vue/Article.html) en sont de bons exemples. 

### Pattern Frontcontroleur avec routage 

Malheureusement, par faute de temps, nous n'avons pas été en mesure d'intégrer du routage dans notre front contrôleur. 
# Au delà

### Utilisation de stubs

Notre équipe ayant rencontré pendant quelques temps des soucis pour accéder à la base de données, nous avons pris la décision de créer un stub pour tout de même pouvoir charger sur les vues des données liées aux articles. 

Une interface [IArticleDataManager](../PHP/modele/IArticleDataManager.php) permet ainsi de soit venir brancher notre Gateway classique à notre [manager d'articles](../PHP/modele/ArticleManager.php), soit de venir y brancher notre [stub d'articles](../PHP/modele/StubArticles.php). 


### Serialisation / Deserialisation de contenu

Nous avons pris la décision de stocker directement le contenu de nos articles dans la table Article associée en base de données. 

Le but étant d'éviter de trop compléxifier la base de données en rajoutant une table Contenu, d'autant plus car nos différents types de contenu (paragraphes, vidéos, images) sont en mesure d'évoluer, et en plus de cela d'autres risques d'arriver et cela aurait demandé des modifications trop fréquentes de la base de données. 

Dans ce sens, notre table Article en BDD contient simplement une colonne TEXT `contenu` stockant tout les blocs de contenus de l'article. 

Nous avons donc un processus de serialisation des différents contenus de nos articles avant de les insérer en BDD (de manière à n'avoir qu'un string en BDD), puis un processus de deserialisation vient remettre sous forme d'objets nos différents contenus, à partir du string stocké en BDD. 