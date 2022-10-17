<?php
class Chat{
    private $id;
    private $assessor;
    private $supervisor;


    function __construct( $id, $assessor, $supervisor){
        $this->id = $id;
        $this->assessor = $assessor;
        $this->supervisor = $supervisor;
    }

    function getId(){return $this->id;}
    function getAssessor(){return $this->assessor;}
    function getSupervisor(){return $this->supervisor;}

    function setId($id){$this->id = $id;}
    function setAssessor($assessor){$this->assessor = $assessor;}
    function setSupervisor($supervisor){$this->supervisor = $supervisor;}
}
?>