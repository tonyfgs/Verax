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
    public function getTheme()
    {
        return $this->theme;
    }

    public function getDatePublication()
    {
        return $this->datePublication;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

}