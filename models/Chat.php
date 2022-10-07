<?php
class Chat{
    private $id;
    private $title;
    private $message;
    private $assessor;
    private $supervisor;
    private $timestamp;

    function __construct( $id, $title, $message, $assessor, $supervisor, $timestamp ){
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
        $this->assessor = $assessor;
        $this->supervisor = $supervisor;
        $this->timestamp = $timestamp;
    }

    function getId(){return $this->id;}
    function getTitle(){return $this->title;}
    function getMessage(){return $this->message;}
    function getAssessor(){return $this->assessor;}
    function getSupervisor(){return $this->supervisor;}
    function getTimestamp(){return $this->timestamp;}

    function setId($id){$this->id = $id;}
    function setTitle($title){$this->title = $title;}
    function setMessage($message){$this->message = $message;}
    function setAssessor($assessor){$this->assessor = $assessor;}
    function setSupervisor($supervisor){$this->supervisor = $supervisor;}
    function setTimestamp($timestamp){$this->timestamp = $timestamp;}
}
?>