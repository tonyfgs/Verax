<?php

	namespace dal\gateways;
	use dal\Connection;
	use metier\Article;
	use pdo;
use PDOException;

	class ArticleGateway {

	private $con;

	public function __construct(Connection $con){
		$this->con = $con;
	} 



	// public function insert(int $id, string $titre, string $contenu, int $temps, string $description) : bool {

	// 	$query = 'INSERT INTO article VALUES(:i, :a, :d, :t, :c, :te, :da)';	

	// 	return $this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT),
	// 		':t' => array($titre, PDO::PARAM_STR),
	// 		'd' => array($description, PDO::PARAM_STR),
	// 		':a' => array($description, PDO::PARAM_STR),
	// 		':c' => array($contenu, PDO::PARAM_STR),
	// 		':te' => array($temps, PDO::PARAM_INT),
	// 		'da' => array($id, PDO::PARAM_STR),
	// 	));
	// }

	public function insert(int $id, string $titre, string $contenu, int $temps, string $description) : bool {
		$query = 'INSERT INTO article (idArticle, auteur, description, titre, contenu, temps, datePub) VALUES (:i, :a, :d, :t, :c, :te, CURRENT_DATE)';
	
		try {
			return $this->con->executeQuery($query, array(
				':i' => array($id, PDO::PARAM_INT),
				':t' => array($titre, PDO::PARAM_STR),
				':d' => array($description, PDO::PARAM_STR),
				':a' => array("Auteur inconnu", PDO::PARAM_STR),  // Assuming auteur is a foreign key with a default value of NULL
				':c' => array($contenu, PDO::PARAM_STR),
				':te' => array($temps, PDO::PARAM_INT),
			));
		} catch (PDOException $e) {
			echo "Erreur PDO : ".$e -> getMessage();
		}
	}
	


	// public function findArticle(int $id) : array {
	// 	$query = 'SELECT * FROM article WHERE idArticle = :i';
	// 	$this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT)));
	// 	$results = $this->con->getResults();
	// 	if (count($results) == 0) return array();
	// 	foreach ($results as $row) {
	// 		$tab[] = new Article($row['idArticle'],$row['titre'],$row['contenu'],$row['temps'],$row['datePub']);
	// 	}
	// 	return $tab;
	// }

	// public function delete(int $id) : bool {
	// 	$query = 'DELETE FROM article WHERE idArticle = :i';
	// 	return $this->con->executeQuery($query,array(':i' => array($id,PDO::PARAM_INT)));
	// }

	// public function update(int $id, string $titre, string $contenu, int $temps) : bool {
	// 	$query = 'UPDATE article SET titre = :t, contenu = :c, temps = :te WHERE idArticle = :i';
	// 	return $this->con->executeQuery($query, array(':i' => array($id, PDO::PARAM_INT), ':t' => array($titre,PDO::PARAM_STR), ':c' => array($contenu, PDO::PARAM_STR), ':te' => array($temps, PDO::PARAM_INT)));
	// }

	// public function selectAllArticle() : array {
	// 	$query = 'SELECT * FROM Article';
	// 	$this->con->executeQuery($query,array());
	// 	$results = $this->con->getResults();
	// 	if (count($results) == 0) return array();
	// 	foreach ($results as $row) {
	// 		$tab[] = new Article($row['idArticle'],$row['titre'],$row['contenu'],$row['temps'],$row['datePub']);
	// 	}
	// 	return $tab;
	// }
}
?>