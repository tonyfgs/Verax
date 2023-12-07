<?php

namespace dal\gateways;
use dal\Connection;
use PDO;
class SignalementGateway
{
    private $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }

    public function getAllReporting(): array{
        $query = 'SELECT * FROM signalement';
        $res = $this->con->executeQuery($query);
        return $results = $this->con->getResults();
    }

    public function insertReporting($motif,$idArticle): bool{
        $query = 'INSERT INTO signalement (dateSignalement,motif, idArticle, pseudo) VALUES (CURRENT_DATE,:m,:a,:p)';
        return $this->con->executeQuery($query,  array(
            ':m' => array($motif, PDO::PARAM_STR),
            ':a' => array($idArticle, PDO::PARAM_INT),
            ':p' => array($_SESSION['pseudo'], PDO::PARAM_STR)
        ));
    }
}