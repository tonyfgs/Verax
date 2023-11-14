<?php
namespace dal\gateways;
require(__DIR__.'/../Connection.php');
require(__DIR__ . '/../../metier/Utilisateur.php');

class UtilisateurGateway {
    private $con;

    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function findUserByPseudo(string $pseudo) : array {
        $query = 'SELECT * FROM utilisateur WHERE pseudo = :p';
        $res = $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
        $results = $this->con->getResults();
        if (count($results) == 0) return array();
        Foreach ($results as $row) {
            $tab[] = new Utilisateur($row['pseudo'],$row['mail'],$row['mdp'],$row['nom'],$row['prenom'],$row['role']);
        }
        return $tab;
    }

    public function findPasswordByPseudo(string $pseudo) : string {
        $query = 'SELECT mdp FROM utilisateur WHERE pseudo = :p';
        $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
        $results = $this->con->getResults();
        if (count($results) == 0) return "";
        return $results[0]['mdp'];
    }

    public function findRoleByPseudo(string $pseudo) : string {
        $query = 'SELECT role FROM utilisateur WHERE pseudo = :p';
        $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
        $results = $this->con->getResults();
        if (count($results) == 0) return "";
        return $results[0]['role'];
    }

    public function insert(string $pseudo, string $nom, string $prenom, string $mdp, string $mail, string $role) : bool {
        $query = 'INSERT INTO utilisateur VALUES(:ps,:n,:pr,:mdp,:mail,:r)';
        $encrypt = password_hash($mdp, PASSWORD_DEFAULT);
        return $this->con->executeQuery($query,array(':ps' => array($pseudo,PDO::PARAM_STR), ':n' => array($nom, PDO::PARAM_STR), ':pr' => array($prenom, PDO::PARAM_STR), ':mdp' => array($encrypt, PDO::PARAM_STR), ':mail' => array($mail, PDO::PARAM_STR), ':r' => array($role,PDO::PARAM_STR)));
    }

    public function update(string $pseudo, string $prenom, string $nom, string $mdp, string $mail, string $role) : bool {
        $query = 'UPDATE utilisateur SET pseudo = :ps, nom = :n, prenom = :pr, mdp = :mdp, mail = :mail role = :r';
        return $this->con->executeQuery($query,array(':ps' => array($pseudo,PDO::PARAM_STR), ':n' => array($nom, PDO::PARAM_STR), ':pr' => array($prenom, PDO::PARAM_STR), ':mdp' => array($mdp, PDO::PARAM_STR), ':mail' => array($mail, PDO::PARAM_STR), ':r' => array($role,PDO::PARAM_STR)));
    }

    public function delete(string $pseudo) : bool {
        $query = 'DELETE FROM utilisateur WHERE pseudo = :p';
        return $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
    }
    
}

?>