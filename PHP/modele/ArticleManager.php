<?php

namespace modele;

use dal\gateways\ArticleGateway;
use metier\Article;
use modele\IArticleDataManager;
use modele\StubArticles;

    class ArticleManager {

        private IArticleDataManager $dataManager;
        private $articletheque;

        public function __construct(IArticleDataManager $imgr) {

            // echo "Passage dans constructeur d'article manager <br>";

            $this -> dataManager = $imgr;
            $this -> articletheque = new Articletheque($this -> dataManager);
        }

        /*
        public static function newArticleManager(IArticleDataManager $mgr){
            $tmp = new ArticleManager();
            $tmp->dataManager = $mgr;
            $tmp->articletheque = new Articletheque($mgr);
        }
        */

        public function getArticle(int $id) : ?Article {

            //return $this -> articletheque -> getArticle($id);
            $temp = array();

            foreach($this -> articletheque -> getAllArticles() as $a) {
                if ($a -> getId() == $id) {
                    $temp[] = $a;
                }
            }
            
            return $temp[0];
        }

        public function getDerniersArticles(int $nbArticles) : array {
            
            return $this -> articletheque -> getDerniersArticles($nbArticles);
            //return $this -> dataManager -> getDerniersArticles($nbArticles);
        }
            
    }
?>