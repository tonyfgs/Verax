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

    public function getAllReporting(){
        $query = 'SELECT * FROM signalement';
        $res = $this->con->executeQuery($query);
        $results = $this->con->getResults();
        $tab = array();
        var_dump($tab);
    }

    public function insertReporting($motif){
        $query = 'INSERT INTO signalement VALUES (:m,:a,:p)';
        $this->con->executeQuery($query,  array(
            ':m' => array($motif, PDO::PARAM_STR),
            ':p' => array($_SESSION['pseudo'], PDO::PARAM_STR),
            ':a' => array($preno, PDO::PARAM_STR)

        ));
    }
}