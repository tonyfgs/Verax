<?php

namespace metier;

class Chat
{


    private $message;

    private $idRedact;

    private $dateMessage;

    public function __construct($message, $idRedact, $dateMessage){
        $this->message = $message;
        $this->idRedact = $idRedact;
        $this->dateMessage = $dateMessage;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getIdRedact()
    {
        return $this->idRedact;
    }

    /**
     * @param mixed $idRedact
     */
    public function setIdRedact($idRedact)
    {
        $this->idRedact = $idRedact;
    }

    /**
     * @return mixed
     */
    public function getDateMessage()
    {
        return $this->dateMessage;
    }

    /**
     * @param mixed $dateMessage
     */
    public function setDateMessage($dateMessage)
    {
        $this->dateMessage = $dateMessage;
    }
}
?>