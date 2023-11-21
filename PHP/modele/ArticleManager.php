<?php

namespace modele;

use metier\Article;
use modele\stubArticles;

    class ArticleManager {

        private $dataManager;
        private $articletheque;

        public function __construct() {
            $this -> dataManager = new stubArticles();
            $this -> articletheque = new Articletheque($this -> dataManager);
        }

        public function getArticle(int $id) : Article {

            return $this -> articletheque -> getArticle($id);
        }
    }
?>