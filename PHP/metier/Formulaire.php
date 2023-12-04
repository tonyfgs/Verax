<?php

namespace metier;

class Formulaire
{
    private $theme;
    private $datePublication;
    private $link;
    private $pseudo;
    public function __construct( $theme,  $datePublication,  $link, $pseudo){
     $this->theme = $theme;
     $this->datePublication = $datePublication;
     $this->link = $link;
    $this->pseudo = $pseudo;
    }

}