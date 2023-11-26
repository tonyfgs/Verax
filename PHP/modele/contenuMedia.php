<?php 

    namespace modele;

    class contenuMedia extends Contenu {

        private $titre;
        private $lien;

        public function __construct(int $id, ?string $titre, string $lien) {
            parent::__construct($id);
            $this -> titre = $titre; 
            $this -> lien = $lien;

            $this -> setTypeContenu("image");
        }

        static public function newVideo(int $id, ?string $titre, string $lien) : contenuMedia {
            $temp = new contenuMedia($id, $titre, $lien);
            $temp -> setTypeContenu("video");
            return $temp;
        }

        public function getTitre() : String {
            return $this -> titre;
        }

        public function getLien() : String {
            return $this -> lien;
        }

        public function setContenu(String $texte) {
            $this -> lien = $texte;
        }

        public function setTitre(String $titre) {
            $this -> titre = $titre;
        }

        public function getContenu() : array {
            $temp = array();
            $temp['titre'] = $this -> titre;
            $temp['contenu'] = $this -> lien;
            
            return $temp;
        }

        public function __sleep() {
            return ['id', 'typeContenu', 'titre', 'lien'];
        }
    }
?>