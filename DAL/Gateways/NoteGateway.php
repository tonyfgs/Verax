<?php

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


    public function deleteNote($idArticle, $pseudo, $note) : bool {
        $query = 'DELETE FROM Note WHERE idArticle = :idArticle AND pseudo = :pseudo';
        $param = [ array(
            ':idArticle' => array($idArticle, PDO::PARAM_INT),
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':note' => array($note, PDO::PARAM_STR)
        )
        ];
        return $this->con->executeQuery($query, $param);

    }
    public function getNoteByArticles($idArticle) : array{
        $query = 'SELECT note FROM Note WHERE idArticle = :idArticle';
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



}

?>

