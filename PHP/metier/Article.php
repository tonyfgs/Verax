<?php

    namespace metier;

    use modele;

    class Article {
        private $id;
        private $titre;
        private $description;
        private $temps;
        private $date;
        private $auteur;
        
        private $lContenus;

        public function __construct( $id, $title, $description, $temps, $date, $auteur) {
            $this->id = $id;
            $this->titre = $title;
            $this->description = $description;
            $this->temps = $temps;
            $this->date = $date;
            $this -> lContenus = array();
            $this -> auteur = $auteur;
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

        public function getAuteur() {
            return $this -> auteur;
        }

        public function getTitle() {
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
    }
?>