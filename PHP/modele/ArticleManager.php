<?php

namespace modele;

use metier\Article;
use modele\IArticleDataManager;
use modele\StubArticles;

    class ArticleManager {

        private IArticleDataManager $dataManager;
        private $articletheque;

        public function __construct() {
            $this -> dataManager = new stubArticles();
            $this -> articletheque = new Articletheque($this -> dataManager);
        }

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
            return $this -> dataManager -> getDerniersArticles($nbArticles);
        }
    }
?>