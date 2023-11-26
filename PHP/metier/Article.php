<?php

    namespace metier;

    use dal\Connection;
    use dal\gateways\NoteGateway;
    use modele;

    class Article {
        private $id;
        private $titre;
        private $description;
        private $temps;
        private $date;
        private $auteur;
        private $imagePrincipale;

        private $note;
        private $lContenus;

        public function __construct( $id, $title, $description, $temps, $date, $auteur, $imagePrincipale) {
            global $dsn, $login,$mdp;
            $this->id = $id;
            $this->titre = $title;
            $this->description = $description;
            $this->temps = $temps;
            $this->date = $date;
            $this -> lContenus = array();
            $this -> auteur = $auteur;
            $this -> imagePrincipale = $imagePrincipale;
            $gw = new NoteGateway(new Connection($dsn, $login,$mdp));
            $this->note = $gw->getNoteByArticles($id);
        }

        public function remplirArticle($lContenus) {
            foreach ($lContenus as $contenu) {
                $this -> lContenus[] = $contenu; 
            }
        }

        public function getContenus() : array {
            return $this -> lContenus;
        }

        public function getId() {
            return $this->id;
        }

        public function getImagePrincipale() {
            return $this -> imagePrincipale;
        }

        public function getAuteur() {
            return $this -> auteur;
        }

        public function getTitre() {
            return $this->titre;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getTemps() {
            return $this->temps;
        }

        public function getDate() {
            return $this->date;
        }

        private function setId( $id ) {
            $this->id = $id;
        }

        private function setTitle( $title ) {
            $this->titre = $title;
        }

        private function setDescription( $content ) {
            $this->description = $content;
        }

        private function setTemps( $temps ) {
            $this->temps = $temps;
        }

        private function setDate( $date ) {
            $this->date = $date;
        }

        public function getNote()
        {
            return $this->note;
        }
    }
?>