<?php
namespace dal\gateways;
use dal\Connection;
use PDO;
class NoteGateway
{
    private $con;

    public function __construct(Connection $con){
            $this->con = $con;
    }

    public  function insertNote($idArticle, $pseudo, $note) : bool{
        $query = 'INSERT INTO Note VALUES (:idArticle,:pseudo,:note)';
        $param = array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':note' => array($note, PDO::PARAM_STR)
        );
        return $this->con->executeQuery($query, $param);
    }


    public function deleteNote($idArticle, $pseudo) : bool {
        $query = 'DELETE FROM Note WHERE idArticle = :idArticle AND pseudo = :pseudo';
        $param = array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
        );
        return $this->con->executeQuery($query, $param);

    }
    public function getNoteByArticles($idArticle): int
    {
        $query = 'SELECT SUM(note) AS total FROM Note WHERE idArticle = :idArticle';
        $param = array(':idArticle' => array($idArticle, PDO::PARAM_INT));

        $this->con->executeQuery($query, $param);
        $results = $this->con->getResults();

        if (empty($results) OR $results[0]['total'] == null) {
            // Ajustement : Utilisation de empty() pour vérifier si le tableau est vide.
            return 0;
        }

        // Ajustement : Utilisation de $row['total'] au lieu de $row['sum(note)']
        $note = $results[0]['total'];

        // Debug : Affichage de la valeur de $note
        // Retour de la note convertie en entier
        return $note;
    }

    public function getNoteByUser($pseudo) : array{
        $query = 'SELECT note FROM Note WHERE pseudo = :pseudo';
        $param = array(':pseudo' => array($pseudo, PDO::PARAM_STR));
        $this->con->executeQuery($query,$param);
        return $this->con->getResults();
    }

    public function getNoteByUserOnArticle($pseudo, $idArticle) : int{
        $query = 'SELECT note FROM Note WHERE pseudo = :p AND idArticle = :i';
        $this->con->executeQuery($query,array(
            ':p' => array($pseudo, PDO::PARAM_STR),
            ':i' => array($idArticle, PDO::PARAM_INT)
        ));

        $results = $this->con->getResults();
        if (count($results) == 0) {
            return 0;
        }
        foreach ($results as $row){
            $note = $row['note'];
        }
        return $note;
    }

    public function updateNote($idArticle, $pseudo, $note) : bool{
        $query = 'UPDATE Note SET note = :note WHERE idArticle = :idArticle AND pseudo = :pseudo';
        $param = array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':note' => array($note, PDO::PARAM_STR)
        );
        return $this->con->executeQuery($query,$param);
    }

    public function getnBestNote($idArticle, $n) : array{
        $query = 'SELECT sum(Note.note) FROM Note WHERE Note.idArticle = :idArticle ORDER BY 1 DESC limit :nb';
        $param = array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':nb' => array($n, PDO::PARAM_INT)
        );
        return $this->con->executeQuery($query, $param);
    }

    public function getnWorstNote($idArticle, $n): array{
        $query = 'SELECT sum(Note.note) FROM Note WHERE Note.idArticle = :idArticle ORDER BY 1 limit :nb';
        $param = array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':nb' => array($n, PDO::PARAM_INT)
        );
        return $this->con->executeQuery($query, $param);
    }



}

?>

