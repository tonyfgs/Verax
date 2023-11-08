<?php

namespace Metier;

class Note
{
    private $idUserNote;

    private $note;

    private $idArticleNoter;

    public function __construct($idUserNote, $note, $idArticleNoter){
        $this->idArticleNoter = $idArticleNoter;
        $this->idUserNote = $this->idUserNote;
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getIdUserNote()
    {
        return $this->idUserNote;
    }

    /**
     * @param mixed $idUserNote
     */
    public function setIdUserNote($idUserNote)
    {
        $this->idUserNote = $idUserNote;
    }

    /**
    * @return mixed
    */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        if(note != 1 AND $note != -1){
            $this->note = 0;
        }
        else $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getIdArticleNoter()
    {
        return $this->idArticleNoter;
    }

    /**
     * @param mixed $idArticleNoter
     */
    public function setIdArticleNoter($idArticleNoter)
    {
        $this->idArticleNoter = $idArticleNoter;
    }

}