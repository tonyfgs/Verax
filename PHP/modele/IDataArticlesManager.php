<?php

    namespace modele;

    interface IArticleDataManager {

        public function getAllArticles();
        public function getArticle(int $id);
    }

?>