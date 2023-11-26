<?php

    namespace modele;
    use metier\Article;

    interface IArticleDataManager {

        public function getAllArticles() : array;
        public function getArticle(int $id) : Article;
        public function getDerniersArticles(int $nbArticles);
    }

?>