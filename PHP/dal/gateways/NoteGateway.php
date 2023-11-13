<?php
namespace gateways;
require("Connection.php");
class NoteGateway
{
    private $con;

    public function __construct(Connection $con){
            $this->con = $con;
    }

    public  function insertNote($idArticle, $pseudo, $note) : bool{
        $query = 'INSERT INTO Note VALUES (:idArticle,:pseudo,:note)';
        $param = [ array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':note' => array($note, PDO::PARAM_STR)
        )
        ];
        return $this->con->executeQuery($query, $param);
    }


    public function deleteNote($idArticle, $pseudo) : bool {
        $query = 'DELETE FROM Note WHERE idArticle = :idArticle AND pseudo = :pseudo';
        $param = [ array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
        )
        ];
        return $this->con->executeQuery($query, $param);

    }
    public function getNoteByArticles($idArticle) : array{
        $query = 'SELECT sum(note) FROM Note WHERE idArticle = :idArticle';
        $param = [ array(':idArticle' => array($idArticle, PDO::PARAM_INT))];
        $this->con->executeQuery($query,$param);
        return $this->con->getResults();
    }

    public function getNoteByUser($pseudo) : array{
        $query = 'SELECT note FROM Note WHERE pseudo = :pseudo';
        $param = [ array(':pseudo' => array($pseudo, PDO::PARAM_STR))];
        $this->con->executeQuery($query,$param);
        return $this->con->getResults();
    }

    public function getNoteByUserOnArticle($pseudo, $idArticle) : int{
        $query = 'SELECT note FROM Note WHERE pseudo = :pseudo AND idArticle = :idArticle';
        $param = [ array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':idArticle' => array($idArticle, PDO::PARAM_INT)
        )];
        $this->con->executeQuery($query,$param);

        $results = $this->con->getResults();
        if (count($results) == 0) {
            return 0;
        }
        return $results;
    }

    public function updateNote($idArticle, $pseudo, $note) : bool{
        $query = 'UPDATE Note SET note = :note WHERE idArticle = :idArticle AND pseudo = :pseudo';
        $param = [ array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':note' => array($note, PDO::PARAM_STR)
        )
        ];
        return $this->con->executeQuery($query,$param);
    }

    public function getnBestNote($idArticle, $n) : array{
        $query = 'SELECT sum(Note.note) FROM Note WHERE Note.idArticle = :idArticle ORDER BY 1 DESC limit :nb';
        $param = [ array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':nb' => array($n, PDO::PARAM_INT)
        )
        ];
        return $this->con->executeQuery($query, $param);
    }

    public function getnWorstNote($idArticle, $n): array{
        $query = 'SELECT sum(Note.note) FROM Note WHERE Note.idArticle = :idArticle ORDER BY 1 limit :nb';
        $param = [ array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':nb' => array($n, PDO::PARAM_INT)
        )
        ];
        return $this->con->executeQuery($query, $param);
    }



}

?>

