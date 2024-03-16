<?php 

    namespace modele;

    class SerialManager {

        static public function serialiserContenus($contenus) : ?string {

            $temp = serialize($contenus);
            return $temp;
        }

        static public function deserialiserContenus(string $contenus) : array {


            $temp = array();
            $temp = unserialize($contenus);
            return $temp;
        }
    }