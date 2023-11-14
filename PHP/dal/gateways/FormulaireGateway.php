<?php
namespace dal\gateways;
class FormulaireGateway
{
    private $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }

    public function getAllForm() : array{
        $query = 'SELECT * FROM Contribution';
        $this->con->executeQuery($query);
        return $this->con->getResults();
    }

    public function getAllFormByUser($pseudo) : array{
        $query = 'SELECT * FROM Contribution WHERE idContributeur = :pseudo';
        $param = [ array(
            ':pseudo' => array($pseudo, PDO::PARAM_STR),
        )
        ];
        $this->con->executeQuery($query, $param);
        return $this->con->getResults();
    }

    public function getFormById($idForm) : array{
        $query = 'SELECT * FROM Contribution WHERE id = :idForm';
        $param = [ array(
            ':pseudo' => array($idForm, PDO::PARAM_INT),
        )
        ];
        $this->con->executeQuery($query, $param);
        return $this->con->getResults();
    }

    public function getAllFormByType($type) : array{
        $query = 'SELECT * FROM Contribution WHERE type = :type';
        $param = [ array(
            ':pseudo' => array($type, PDO::PARAM_STR),
        )
        ];
        $this->con->executeQuery($query, $param);
        return $this->con->getResults();
    }

}