<?php

class Utilisateur {
    private $pseudo;
    private $mail;

    private $mdp;
    private $nom;
    private $prenom;

    public function __construct($pseudo, $mail, $mdp, $nom, $prenom) {
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->mdp = $mdp;
        $this->nom = $nom;
        $this->prenom = $prenom;
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
}




?>