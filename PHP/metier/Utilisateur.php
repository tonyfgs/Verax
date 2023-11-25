<?php

namespace metier;

use dal\Connection;
use dal\gateways\UtilisateurGateway;

class Utilisateur {
    private $pseudo;
    private $mail;

    private $mdp;
    private $nom;
    private $prenom;
    private $role;

    private $ban;


    public function __construct($pseudo, $mail, $mdp, $nom, $prenom, $role) {
        global $dsn, $login, $mdp;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->role = $role;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $this->ban = $gw->isBan($pseudo);
    }
    public function getpseudo() {
        return $this->pseudo;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getMdp() {
        return $this->mdp;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getRole() {
        return $this->role;
    }

    public function getBan(): bool
    {
        return $this->ban;
    }

    public function setBan(bool $ban): void
    {
        $this->ban = $ban;
    }
}




?>