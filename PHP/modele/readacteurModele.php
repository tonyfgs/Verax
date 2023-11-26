<?php

namespace modele;

class readacteurModele
{
    public function deconnexion()
    {
        session_destroy();
    }

    public function soumettreArticle() : bool
    {
        global $dsn, $login, $mdp;
        $gw = new ArticleGateway(new Connection($dsn, $login, $mdp));
        //associe le createur de la liste à son login s'il est connecté, sinon visiteur le remplacera
        if(isset($_SESSION["login"])){
            $createur=$_SESSION["login"];
        }else{
            return false;
        }
        if ( isset( $_GET['submit'] ) ) {
            $titre = $_GET['titre'];
            $contenu = $_GET['contenu'];
            $duree = $_GET['duree'];
            $id = uniqid();

            $article=new Article($id, $titre, $contenu, $duree, $createur);
            //ajouter createur dans bdd ??
            return $gw->insert($article);
        }
        return false;
    }
}