<?php

    interface IArticleDataManager {

        public function getAllArticles();
        public function getArticle(int $id);
    }

?>