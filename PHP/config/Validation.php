<?php

namespace Config;

/**
 * Classe qui permet la vérification et le nettoyage des données rentrées par l'utilisateur
 */
class Validation
{

    public static function nettoyerString(string $str): ?string
    {
        return filter_var($str, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_NULL_ON_FAILURE);
    }

    public static function validerIntPositif($int)
    {
        return filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
    }

}
?>
