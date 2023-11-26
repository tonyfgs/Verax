<?php

namespace dal\gateways;
use dal\Connection;
use PDO;
/* on part du principe qu une table chat existe est quelle contient les attributs suivants :
idMessage (un identifiant unique pour chaque message)
pseudo (le pseudo de l'utilisateur qui a envoyé le message)
content (le contenu du message)
timestamp (la date et l'heure à laquelle le message a été envoyé)
*/

class ChatGateway
{
    private $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }

    public function insertMessage($pseudo, $content) : bool {
        $query = 'INSERT INTO ChatMessages (pseudo, content, timestamp) VALUES (:pseudo, :content, NOW())';
        $param = [ array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
            ':content' => array($content, PDO::PARAM_STR)
        )
        ];
        return $this->con->executeQuery($query, $param);
    }

    public function getLastNMessages($limit = 10) : array {
        $query = 'SELECT * FROM ChatMessages ORDER BY timestamp DESC LIMIT :limit';
        $param = [
            array(':limit' => array($limit, PDO::PARAM_INT))
        ];
        $this->con->executeQuery($query, $param);
        return $this->con->getResults();
    }

    public function getMessagesByUser($pseudo) : array {
        $query = 'SELECT * FROM ChatMessages WHERE pseudo = :pseudo ORDER BY timestamp DESC';
        $param = [
            array(':pseudo' => array($pseudo, PDO::PARAM_STR))
        ];
        $this->con->executeQuery($query, $param);
        return $this->con->getResults();
    }

    public function replyTo($fromPseudo, $toPseudo, $content) : bool {
        $messageContent = "@" . $toPseudo . " " . $content;
        $query = 'INSERT INTO ChatMessages (pseudo, content, timestamp) VALUES (:pseudo, :content, NOW())';
        $param = [  array(
            ':pseudo' => array($fromPseudo, PDO::PARAM_STR),
            ':content' => array($messageContent, PDO::PARAM_STR)
        )
        ];
        return $this->con->executeQuery($query, $param);
    }

    public function findAllMessageForAnArticle($idArticle) : array {
        $query = 'SELECT pseudoRedac, CONVERT(datePublication, char), message FROM Article, Loguer, Utilisateur WHERE Article.idArticle = Loguer.idArticle AND Loguer.pseudo = Utilisateur.pseudo AND Article.idArticle = :id ORDER BY messagePublication DESC';
        if ($this->con->executeQuery($query,array( ':id' => array($idArticle, PDO::PARAM_INT) ))){
            return $this->con->getResults();
        }
        return [];

    }



}