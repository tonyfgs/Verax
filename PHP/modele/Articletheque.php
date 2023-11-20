<?php 

use Metier\Article;

class Articletheque {

    private $lArticles;
    private $dataManager;

    public function __construct(IArticleDataManager $dtManager) {

        $this -> dataManager = $dtManager;
        $this-> lArticles = $this -> dataManager -> getAllArticles();
    }

    public function getArticle (int $id) : Article {
        
        $temp = NULL;

        foreach ($this -> lArticles as $article) {
            if ($article -> getId() == $id) {
                $temp = $article;
            }
        }

        return $temp;
    }

    public function getAllArticles() : array {
        return $this -> lArticles;
    }
}
?>