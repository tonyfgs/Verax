<?php
namespace dal\gateways;
use metier\Utilisateur;
use dal\Connection;
use PDO;

class UtilisateurGateway {
    private $con;

    public function __construct(Connection $con) {
        $this->con = $con;
    }

    public function findAllUser() : array {
        $query = 'SELECT * FROM utilisateur';
        $res = $this->con->executeQuery($query);
        $results = $this->con->getResults();
        $tab = array();
        foreach ($results as $row) {
            $tab[] = new Utilisateur($row['pseudo'], $row['mail'], $row['mdp'], $row['nom'], $row['prenom'], $row['roleUtil']);
        }
        return $tab;
    }

    public function findUserByPseudo(string $pseudo) : array {
        $query = 'SELECT * FROM utilisateur WHERE pseudo = :p';
        $res = $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
        $results = $this->con->getResults();
        if (count($results) == 0) return array();
        $tab = array();
        foreach ($results as $row){
            $tab[] = new Utilisateur($row['pseudo'],$row['mail'],$row['mdp'],$row['nom'],$row['prenom'],$row['roleUtil']);
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
        return $results[0]['roleUtil'];
    }

    public function insert(string $pseudo, string $nom, string $prenom, string $mdp, string $mail, string $role) : bool {
        $query = 'INSERT INTO utilisateur VALUES(:ps,:n,:pr,:mdp,:mail,:r)';
        $encrypt = password_hash($mdp, PASSWORD_DEFAULT);
        return $this->con->executeQuery($query,array(':ps' => array($pseudo,PDO::PARAM_STR), ':n' => array($nom, PDO::PARAM_STR), ':pr' => array($prenom, PDO::PARAM_STR), ':mdp' => array($encrypt, PDO::PARAM_STR), ':mail' => array($mail, PDO::PARAM_STR), ':r' => array($role,PDO::PARAM_STR)));
    }

    public function update(string $pseudo, string $prenom, string $nom, string $mdp, string $mail, string $role) : bool {
        $query = 'UPDATE utilisateur SET nom = :n, prenom = :pr, mdp = :mdp, mail = :mail, roleUtil = :r WHERE pseudo = :ps';
        return $this->con->executeQuery($query,array(':ps' => array($pseudo,PDO::PARAM_STR), ':n' => array($nom, PDO::PARAM_STR), ':pr' => array($prenom, PDO::PARAM_STR), ':mdp' => array($mdp, PDO::PARAM_STR), ':mail' => array($mail, PDO::PARAM_STR), ':r' => array($role,PDO::PARAM_STR)));
    }

    public function delete(string $pseudo) : bool {
        $query = 'DELETE FROM utilisateur WHERE pseudo = :p';
        return $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
    }

    public function isBan(string $pseudo) : bool{
        $query = "SELECT * FROM Bannir WHERE pseudoUser = :p";
        $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
        $results = $this->con->getResults();
        if (empty($results)) return false;
        return true;
    }

    public function banAnUser(string $pseudoBan, string $pseudoBanner, string $motif) : bool {
        $query = "INSERT INTO Bannir VALUES (:pban, :pbanner, :m)";
        return $this->con->executeQuery($query,array(':pban' => array($pseudoBan,PDO::PARAM_STR), ':pbanner' => array($pseudoBanner,PDO::PARAM_STR), ':m' => array($motif,PDO::PARAM_STR)));
    }

    public function unBanAnUser(string $pseudo) : bool{
        $query = "DELETE FROM Bannir WHERE pseudoUser = :p";
        return $this->con->executeQuery($query,array(':p' => array($pseudo,PDO::PARAM_STR)));
    }

    
}

?>