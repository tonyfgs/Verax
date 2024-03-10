<?php

namespace modele;

use modele\IArticleDataManager;
use metier\Article;
use modele\ContenuParagraphe;


    class stubArticles implements IArticleDataManager {

        private $lArticles;

        public function __construct() {

            // echo "Passage dans le constructeur de stub Article <br>";

            $this -> chargerArticles();
        }        

        public function chargerArticles() {
            
            $temp = array();

            // echo "debut de charger article <br>";

            // ------ Creation de l'article 1 ------------
            $temp[] = new Article(1, "Thinkerview", "Thinkerview est une chaîne youtube d'interview-débat, 
            lancée en 2013 qui produit de longs entretiens entre un animateur en voix off 
            et ses invités. Les émissions sont toujours
            diffusées en direct, puis republiées sans montage. ", 3, date("d-m-Y"), "Siwa", 
            "assets/img/mainThinkerview.webp");

           //  echo "passage après le constructeur de l'article <br>";

            $temp[0] -> remplirArticle($this -> chargerContenuParagraphe()['article1']);

            // echo "fin creation article 1 <br>";

            // ----------- Creation de l'article 2 -------------
                                   
            $temp[] = new Article(2, "Guerre en Ukraine : Les troupes ukrainiennes reprennent-elles du terrain ?", 
                                "Les troupes ukrainiennes reprennent-elles du territoire ? Doit-on s'attendre 
                                à des pénuries de produits alimentaires, de médicaments ou encore de composants
                                 électroniques ? L'augmentation des prix du gaz vont-ils autant toucher les usines
                                  que les particuliers ? Telles sont les questions courantes que l'on se pose, et au sujet desquelles
                                  les journalistes de la rédaction de franceinfo ont décidé de déméler le vrai du faux.", 
                                  7, date("d-m-Y"), "Siwa", 
                                  "https://images.ladepeche.fr/api/v1/images/view/64e31dd60f90f526a4234177/large/image.jpg?v=1");
            
            
            $temp[1] -> remplirArticle($this -> chargerContenuParagraphe()['article2']);

            // ---------- Création de l'article 3 --------------------------

            $temp[] = new Article(3, "Tempête en Guyane ! ", "Fake news : aucune tempête ne menace la Guyane aujourd'hui !", 2, date("d-m-Y"), "Siwa",
             "https://static1.mclcm.net/iod/images/v2/69/photo/405283/658x370_100_300_000000x30x0.jpg?ts=20231030183145");
            
            $temp[2] ->remplirArticle($this -> chargerContenuParagraphe()['article3']);
            // =======================================
            
            $temp[] = new Article(4, "Titre du quatrième Article", "Contenu du quatrième article...\n\n\n seconde ligne...", 100, date("d-m-Y"), "Siwa", "assets/img/mainThinkerview.webp");
            
             
             //$temp[2] ->remplirArticle($this -> chargerContenuParagraphe()['article2']);
             $temp[3] ->remplirArticle($this -> chargerContenuParagraphe()['article2']);

             


             //echo "Temporaire..." : $this -> chargerContenuParagraphe()['article1'].

            $this -> lArticles = $temp;

            // echo "fin de charger articles <br>";
        }

        public function chargerContenuParagraphe() : array {

            $temp = array();

            // --------- Contenu Article 1 --------------
            
            $temp['article1'][] = new contenuParagraphe(1, "Le mystérieux cygne noir.", 
                "Sous les traits d’un mystérieux cygne noir, un objet vidéo non identifié plane dans la galaxie 
                médiatique. Ambiance Star Wars. Après une musique lancinante, sur fond noir et fumée grisâtre,
                 un invité apparaît, et la voix d’un intervieweur-mystère situé hors champ l’invite à se
                  présenter « succinctement ». C’est ainsi qu’on entre dans le monde de ThinkerView, 
                  chaîne qui a commencé à diffuser en janvier 2013 sur YouTube. Ici, pas de publicité,
                   pas de montage, pas d’effets de lumière. Le calme, peut-être pour annoncer la tempête.");


            $temp['article1'][] = new contenuMedia(0, "Des sujets majeurs abordés", "https://www.systext.org/sites/default/files/styles/large/public/Ill_Thinkerview_Janv2022.png?itok=JvlFQmCH");

            $temp['article1'][] = new contenuParagraphe(2, "Penser, réfléchir et s'exprimer librement.",
                "Dernier carton en date : un entretien de deux heures avec Juan Branco, l’avocat du gilet 
                jaune Maxime Nicolle et « conseiller juridique » de Wikileaks. Quelques jours avant lui,
                 c’était au tour de François Boulo, autre avocat inscrit au barreau de Rouen et l’un des
                  porte-parole des « gilets jaunes ». « Ici, les gens ont vraiment le temps de développer 
                  leurs idées, confie Boulo. Il faut pouvoir écouter une pensée complète, sans être interrompu.
                   » Aux yeux de ce fils d’une famille de droite populaire (paysans et commerçants), ThinkerView 
                   a réalisé ce dont Pierre Bourdieu avait rêvé. S’il s’abreuve à cette source depuis « un an ou 
                   deux », en réalité, ce n’est pas lui qui l’a trouvée, mais l’inverse. Magie des algorithmes.");

            $temp['article1'][] = new contenuMedia(1, "De prestigieux et fascinants invités", "https://i.ytimg.com/vi/_D-AnsdbnRI/maxresdefault.jpg");
            
            $temp['article1'][] = new contenuParagraphe(3, "Une alternative dans un monde aux informations formatées", 
                "\"Nous faisons des interviews aux perspectives alternatives dans un monde aux informations formatées\",
                 explique le site Thinkerview. La marque a adopté un cygne noir comme logo, un clin d'œil à la théorie 
                 du cygne noir (expliquée dans cet article de Challenges), soit un événement qui a peu de 
                 chances de se produire mais qui, s'il se produit, a des conséquences considérables.

                Les invités viennent d'horizons divers avec une petite préférence pour les 
                intellectuels iconoclastes et les contestataires de tous bords, de l'ancien 
                ministre grec Yanis Varoufakis à l'historien et essayiste Emmanuel Todd, en
                 passant par les journalistes Natacha Polony et Laurent Obertone ou encore 
                 la coqueluche des \"gilets jaunes\" Etienne Chouard. \"On est au milieu de 
                 toutes les communautés qui s'écharpent sur internet, de l'extrême droite à
                  l'extrême gauche, explique Sky. On cherche à créer un terrain neutre pour 
                  que tout le monde puisse échanger.");

            $temp['article1'][] = ContenuMedia::newVideo(1, "Prendre le temps d'écouter les experts dans leurs domaines.",
                 "https://www.youtube.com/embed/1tTksQL2kqs");

            // --------- Contenu Article 2 ------------------

            $temp['article2'][] = new contenuParagraphe(1, "Oui les Ukrainiens reprennent du terrain", 
                                    "Timéo demande à Eric Biegala, grand reporter à la rédaction internationale de Radio France,
                                     s'il est vrai \"que les Ukrainiens ont repris du territoire\" face aux Russes. Selon Eric
                                      Biegala, il n'y a aucun doute là-dessus, oui les Ukrainiens reprennent bien du terrain comme
                                       l'indique \"la quantité astronomique d'images, prises dans les endroits qui ont été reconquis, 
                                       par les gens sur place, les soldats et surtout les journalistes.\" Volodymyr Zelensky
                                        lui-même était à Izioum, ville reprise aux Russes et Eric Biegala explique qu'il y a 
                                        aussi \"des photos et images d'armes et blindés laissés sur place par les soldats russes,
                                         partis en panique de la ville\". 
                                    Néanmoins Eric Biegala tient à rappeler l'importance d'être très vigilant sur les
                                     informations et images qui circulent en temps de guerre, selon lui \"à la guerre, 
                                     tout le monde ment et il faut partir de ce principe-là et tout vérifier.\"
                                    Parmi les façons de vérifier l'information en temps de guerre, Eric Biegala explique 
                                    qu'il y a des gens spécialisés dans la géolocalisation d'images. Vous pouvez aussi
                                     utiliser Google Images ou son équivalent russe Yandex pour faire une recherche 
                                     d'images inversées, c'est-à-dire vérifier l'origine d'une photo ou d'une vidéo en 
                                     l'entrant sur l'un de ces moteurs de recherche.");
            
            $temp['article2'][] = new contenuMedia(1, "Des violents affrontements", "https://images.ladepeche.fr/api/v1/images/view/655a496a7097bc144658af8c/large/image.jpg?v=1");
           
           $temp['article2'][] = new ContenuParagraphe(2, "Non les rayons ne seront pas vides cet hiver", 
                                    "Lorenzo se demande s'il est vrai \"qu'il y aura une pénurie de produits étrangers cet hiver\"
                                     et c'est Sophie Auvigne, journaliste au service économie de franceinfo qui lui répond.
                                    Elle met l'accent sur le principe de \"souveraineté française pour l'alimentation et pour les médicame
                                    nt\", car quand la France ne reçoit plus certains produits de l'étranger, quelque soit la raison
                                    , il faut savoir si elle est capable de compenser par sa propre production. En l'occurence, po
                                    ur certains produits, la France n'en est pas capable et elle se repose principalement sur les impo
                                    rtations venant de l'étranger et c'est pourquoi, lorsqu'un pays ne peut plus nous fournir, cela cré
                                    é un manque en France.
                                    Sophie Auvigne donne l'exemple de la moutarde et de l'huile qui manquent dans les rayons des supermarché
                                    s français et \"qu'on n'est pas près de combler\". Elle explique que cela est dû au fait que \"le grand
                                     fournisseur de graines (pour fabriquer de la moutarde), le Canada, a connu une terrible sécheresse qui
                                      a mis à mal sa récolte et l'autre producteur, la Russie, est frappée par un embargo commercial pour son
                                       invasion de l'Ukraine, donc on n'achète plus les produits russes.\"
                                    Mais Sophie Auvigne rappelle qu'on est encore loin d'une pénurie alimentaire comme le prouve nos rayons
                                     encore pleins. Néanmoins elle se montre plus inquiète concernant les médicaments, \"car on s'est 
                                     rendus compte que 80% des molécules étaient fabriquées hors d'Europe\", mais aussi \"les composants 
                                     électroniques qui manquent aujourd'hui et qu'on retrouve un peu partout autour de nous, dans nos vo
                                     itures, nos téléphones ou encore dans les jouets.\"");

            $temp['article2'][] = new contenuMedia(2, "Une carte en perpétuelle évolution", 
                                    "https://ds1.static.rtbf.be/image/media/object/default/16x9/1920x1080/4/e/6/4e67668ff30a378cbf0a9172f92712a7.jpg");

            $temp['article2'][] = new ContenuParagraphe(3, "Le gaz va augmenter en 2023, mais l'Etat va continuer à aider", 
                                "Isra se demande s'il est vrai \"que le gaz va être plus cher cet hiver\". Grégoire Lecalot
                                , journaliste au service eco de franceinfo, explique que le gaz va bien augmenter, mais pas c
                                ette année où il est protégé par le bouclier tarifaire mise en place par le gouvernement depui
                                s novembre 2021. Mais à partir de janvier 2023, le gouvernement a déjà annoncé que les facture
                                s de gaz \"vont augmenter de 15%\", ça représente \"25 euros en plus à payer chaque mois pour le gaz\"
                                 précise Grégoire Lecalot qui ajoute que le gouvernement a quand même prévu \"des chèques é
                                 nergies aux foyers les plus modestes de 100 ou 200 euros selon ce qu'on gagne.\"");


            // ------ Contenu de l'article 3 ---------

            $temp['article3'][] = new ContenuParagraphe(1, "Une certaine \"tempête Jinette\" en Guyane", 
                            "Ne vous laissez pas convaincre par les nuages et les pluies au-dessus de l'île de Cayenne ce matin. 
                            Les informations annonçant l'arrivée de la \"tempête Jinette\" en Guyane les 24 et 25 novembre so
                            nt fausses. Contacté ce matin, Météo France Guyane le confirme. Un simple tour sur leur site perm
                            et de s'en rendre compte. D'ailleurs, aucune alerte météo n'est prévue pour la journée, pour l'ins
                            tant. La vigilance étant au vert.                        
                            \"Le format du document ne correspond même pas\", précise Météo France. On remarque également de
                            s incohérences factuelles dans les dates inscrites, le document étant daté, en haut à droite, 
                            au 25 novembre.");

            $temp['article3'][] = new contenuMedia(1, "Pour aujourd'hui, la vigilance est au vert en Guyane. ", 
                        "https://medias.franceantilles.fr/api/v1/images/view/6560a041c9b8a232734f9fda/width_1000/image.jpg");


            $temp['article3'][] = new ContenuParagraphe(2, "De simples petites averses en prévision !", 
                            "Les quelques averses qui passent actuellement au-dessus de l'île de Cayenne et des savanes ne sont que passagères.
                            Contrairement à ce qu'annonce le faux document, les populations n'ont donc pas besoin de se préparer à événement météorologique.
                            Les vagues maximales de 10 m annoncées, tout comme les rafales de 100 km/h à 120 km/h ne correspondent absolument pas aux prévisions réelles.
                            Les creux prévus ce jour avoisinent plutôt les 1,40 m... rien d'anormal");

            $temp['article3'][] = new contenuMedia(2, "Le faux document en question. Diffusé depuis hier soir.", 
                    "https://medias.franceantilles.fr/api/v1/images/view/6560b08a04eeb6664b7f5488/width_1000/image.jpg");

            return $temp;
        }

        public function getArticle(int $id) : Article {
            return $this -> lArticles[0]; 
        }

        public function getAllArticles() : array {
            return $this -> lArticles;
        }

        public function getDerniersArticles(int $nbArticles) : array {
		
            $temp = array();
    
            for ($cpt = 0 ; $cpt < $nbArticles; $cpt++) {
                
                if (isset($this -> getAllArticles()[$cpt])) {
                    $temp[] = $this -> getAllArticles()[$cpt];
                }
            }
    
            return $temp;
        }

    }
?>