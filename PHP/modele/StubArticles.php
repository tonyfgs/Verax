<?php

namespace modele;

use modele\IArticleDataManager;
use metier\Article;
use modele\ContenuParagraphe;


    class stubArticles implements IArticleDataManager {

        private $lArticles;

        public function __construct() {
            $this -> chargerArticles();
        }        

        public function chargerArticles() {
            
            $temp = array();
            $temp[] = new Article(1, 
                "Thinkerview", 
                "Thinkerview est une chaîne youtube d'interview-débat, lancée en 2013 qui produit de
                    longs entretiens entre un animateur en voix off et ses invités. Les émissions sont toujours
                    diffusées en direct, puis republiées sans montage. ",
                 3,
                date("d-m-Y"),
                "Siwa");
            
            
            
            
            $temp[] = new Article(2, "Titre du second Article", "Contenu du second article...\n seconde ligne...", 20, date("d-m-Y"), "Siwa");
            $temp[] = new Article(3, "Titre du troisième Article", "Contenu du troisième article...\n seconde ligne... \n troisième ligne ", 7, date("d-m-Y"), "Siwa");
            $temp[] = new Article(4, "Titre du quatrième Article", "Contenu du quatrième article...\n\n\n seconde ligne...", 100, date("d-m-Y"), "Siwa");
            
             $temp[1] -> remplirArticle($this -> chargerContenuParagraphe()['article2']);
             $temp[2] ->remplirArticle($this -> chargerContenuParagraphe()['article2']);
             $temp[3] ->remplirArticle($this -> chargerContenuParagraphe()['article2']);

             $temp[0] -> remplirArticle($this -> chargerContenuParagraphe()['article1']);

             //echo "Temporaire..." : $this -> chargerContenuParagraphe()['article1'].

            $this -> lArticles = $temp;
        }

        public function chargerContenuParagraphe() : array {

            $temp = array();

            $temp['article2'][] = new contenuParagraphe(1, "Premier paragraphe", "Contenu du premier article et tout et tout....");
            $temp['article2'][] = new contenuParagraphe(2, "Titre du second paragraphe", "Contenu du second paragraphe....");
            
            $temp['article1'][] = new contenuParagraphe(3, "Le mystérieux cygne noir.", 
                "Sous les traits d’un mystérieux cygne noir, un objet vidéo non identifié plane dans la galaxie 
                médiatique. Ambiance Star Wars. Après une musique lancinante, sur fond noir et fumée grisâtre,
                 un invité apparaît, et la voix d’un intervieweur-mystère situé hors champ l’invite à se
                  présenter « succinctement ». C’est ainsi qu’on entre dans le monde de ThinkerView, 
                  chaîne qui a commencé à diffuser en janvier 2013 sur YouTube. Ici, pas de publicité,
                   pas de montage, pas d’effets de lumière. Le calme, peut-être pour annoncer la tempête.");
            
            return $temp;
        }

        public function getArticle(int $id) : Article {
            return $this -> lArticles[0]; 
        }

        public function getAllArticles() : array {
            return $this -> lArticles;
        }

    }
?>