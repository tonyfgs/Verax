<?php
namespace dal\gateways;
use dal\Connection;
use metier\Formulaire;
use PDO;
class FormulaireGateway
{
    private $con;

    public function __construct(Connection $con){
        $this->con = $con;
    }

    public function getAllForm() : array{
        $query = 'SELECT * FROM Contribution';
        $this->con->executeQuery($query);
        $results = $this->con->getResults();
        $tab = array();
        foreach ($results as $row){
            $tab[] = new Formulaire($row['pseudo'],$row['mail'],$row['mdp'],$row['nom'],$row['prenom'],$row['role']);
        }
        return $tab;
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

    public function insertFormMessage($pseudo, $mail, $nom, $prenom) : bool {
        $query = 'INSERT INTO contribue VALUES (:ps, :m, :n, :p)';
        return $this->con->executeQuery($query,  array(
            ':ps' => array($pseudo, PDO::PARAM_STR),
            ':m' => array($mail, PDO::PARAM_STR),
            ':n' => array($nom, PDO::PARAM_STR),
            ':p' => array($prenom, PDO::PARAM_STR)
        ));
    }


}