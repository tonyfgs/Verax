<?php

/**
 * Classe qui permet la verification et le nettoyage des données rentrées par l'utilisateur
 */
class Validation {

    public static function nettoyerString(?string $str) : ?string{
        return filter_var($str, FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
    }

    public static function validerIntPossitif($int)
    {
        return filter_var($int, FILTER_VALIDATE_INT, array("min_range"=>1));
    }

}
?>