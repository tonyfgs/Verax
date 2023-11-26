<?php

namespace dal\gateways;
use dal\Connection;
use metier\Article;
use modele\ArticleManager;
use modele\IArticleDataManager;
use modele\SerialManager;
use PDO;

class ArticleGateway implements IArticleDataManager {

private $con;

public function __construct(Connection $con){
	$this->con = $con;
} 



public function insert(int $id,string $auteur, string $description,  string $titre, string $contenu, int $temps, string $imagePrincipale) : bool{
	$query = 'INSERT INTO article VALUES(:i, :a, :d,:t,:c,:te,CURRENT_DATE, :im)';
	return $this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT),
        ':a' => array($auteur, PDO::PARAM_STR) ,
        ':d' => array($description, PDO::PARAM_STR),
        ':t' => array($titre, PDO::PARAM_STR),
        ':c' => array($contenu, PDO::PARAM_STR),
        ':te' => array($temps, PDO::PARAM_INT),
        ':im' => array($imagePrincipale, PDO::PARAM_STR)));
}

public function findArticle(int $id) : array {
	$query = 'SELECT * FROM article WHERE idArticle = :i';
	$this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT)));
	$results = $this->con->getResults();
	if (count($results) == 0) return array();
	foreach ($results as $row) {
        $deserial = SerialManager::deserialiserContenus($row['contenu']);
		$tmp = new Article($row['idArticle'],$row['titre'],$row['description'], $row['temps'],$row['datePub'], $row['auteur'],$row['imagePrincipale']);
        $tmp->remplirArticle($deserial);
        $tab[] = $tmp;
	}
	return $tab;
}

public function delete(int $id) : bool {
	$query = 'DELETE FROM article WHERE idArticle = :i';
	return $this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT)));
}

public function update(int $id, string $titre, string $contenu, int $temps) : bool {
	$query = 'UPDATE article SET titre = :t, contenu = :c, temps = :te WHERE idArticle = :i';
	return $this->con->executeQuery($query, array(':i' => array($id, PDO::PARAM_INT), ':t' => array($titre,PDO::PARAM_STR), ':c' => array($contenu, PDO::PARAM_STR), ':te' => array($temps, PDO::PARAM_INT)));
}

public function selectAllArticle() : array {
    $query = 'SELECT * FROM Article';
	$this->con->executeQuery($query,array());
	$results = $this->con->getResults();
	if (count($results) == 0) return array();
    foreach ($results as $row) {
        $deserial = SerialManager::deserialiserContenus($row['contenu']);
        $tmp = new Article($row['idArticle'],$row['titre'],$row['description'], $row['temps'],$row['datePub'], $row['auteur'],$row['imagePrincipale']);
        $tmp->remplirArticle($deserial);
        $tab[] = $tmp;
    }
	return $tab;
}

    public function getAllArticles() : array {
        return $this->selectAllArticle();
    }

    public function getArticle(int $id) : Article {
        $articles = $this->findArticle($id);
        return $articles[0];
    }

	/*
		Cette méthode a vocation a être modifée avec le temps. 
		Pour l'instant, elle renvoie simplement un certains nombre d'articles sans prendre
		en compte leur date de parution. Le but est simplement d'implémenter la méthode pour répondre
		à la demande d'implémentation de l'interface. 
	*/
	public function getDerniersArticles(int $nbArticles) : array {
		
		$temp = array();

		for ($cpt = 0 ; $cpt <= $nbArticles; $cpt++) {
			
			if (isset($this -> getAllArticles()[$cpt])) {
				$temp[] = $this -> getAllArticles()[$cpt];
			}
		}

		return $temp;
	}


}

?>