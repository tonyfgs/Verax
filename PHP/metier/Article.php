<?php

namespace metier;

class Article {
    private $id;
    private $titre;
    private $contenu;
    private $temps;
    private $date;

    public function __construct( $id, $title, $content, $temps, $date ) {
        $this->id = $id;
        $this->titre = $title;
        $this->contenu = $content;
        $this->temps = $temps;
        $this->date = $date;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->titre;
    }

    public function getContent() {
        return $this->contenu;
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

    private function setContent( $content ) {
        $this->contenu = $content;
    }

    private function setTemps( $temps ) {
        $this->temps = $temps;
    }

    private function setDate( $date ) {
        $this->date = $date;
    }
}


















?>