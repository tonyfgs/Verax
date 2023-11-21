<?php

namespace metier;

class Formulaire
{
    private $titre;
    private $contenue;
    private $contributeur;
    public function __construct($titre, $contenue, $contributeur){
     $this->contenue = $contenue;
     $this->contributeur = $contributeur;
     $this->titre = $titre;
    }

}