<?php

use Config\Validation;
use controleur\VisiteurControleur;

class Router
{
    public function route()
    {
        $action = Validation::nettoyerString($_REQUEST["action"]);
        $VisiteurControleur = new VisiteurControleur();

        switch ($action) {

            case 'afficherAccueil':
                $VisiteurControleur->afficherAccueil();
                break;

            case 'afficherEconomie':
                $VisiteurControleur->afficherEconomie();
                break;

            case 'afficherCulture':
                $VisiteurControleur->afficherCulture();
                break;

            case 'afficherPolitique':
                $VisiteurControleur->afficherPolitique();
                break;

            case 'afficherFaitsDivers':
                $VisiteurControleur->afficherFaitsDivers();
                break;

            case 'afficherConnexion':
                $VisiteurControleur->afficherConnexion();
                break;

            case 'afficherContact':
                $VisiteurControleur->afficherContact();
                break;
        }
    }
}
