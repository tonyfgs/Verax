<?php 
    namespace modele;
    
    use Metier\Article;
    use modele\IArticleDataManager;

    class Articletheque {

        private $lArticles;
        private $dataManager;

        public function __construct(IArticleDataManager $dtManager) {

            $this -> dataManager = $dtManager;
            $this-> lArticles = $this -> dataManager -> getAllArticles();
        }

        public function getArticle (int $id) : Article {
            
            // $temp = NULL;

            // foreach ($this -> lArticles as $article) {
            //     if ($article -> getId() == $id) {
            //         $temp = $article;
            //     }
            // }

            $temp = $this -> lArticles[0];

            return $temp;
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