<?php
require ('DAL/Connection.php');
class ArticleGateway {

private $con;

public function __construct(Connection $con){
	$this->con = $con;
} 



public function insert(int $id, string $titre, string $contenu, int $temps) : bool{
	$query = 'INSERT INTO article VALUES(:i,:t,:c,:te,CURRENT_DATE)';
	return $this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT), ':t' => array($titre, PDO::PARAM_STR), ':c' => array($contenu, PDO::PARAM_STR), ':te' => array($temps, PDO::PARAM_INT)));
}

public function findArticle(int $id) : array {
	$query = 'SELECT * FROM article WHERE idArticle = :i';
	$res = $this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT)));
	if (!$res) return [];
	return $this->con->getResults();
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
	$res = $this->con->executeQuery($query,array());
	if (!$res) return [];
    return $this->con->getResults();
}




}

?>