<?php
class Task{
    private $id;
    private $name;
    private $description;
    private $status;
    private $student;
    private $supervisor;
    private $timestamp;

    function __construct($id=null, $taskName, $taskDescription, $status, $student, $supervisor, $timestamp=null){
        $this->id = $id;
        $this->name = $taskName;
        $this->description = $taskDescription;
        $this->status = $status;
        $this->student = $student;
        $this->supervisor = $supervisor;;
        $this->timestamp = $timestamp;
    }

    function getId(){return $this->id;}
    function getName(){return $this->name;}
    function getDescription(){return $this->description;}
    function getStatus(){return $this->status;}
    function getStudent(){return $this->student;}
    function getSupervisor(){return $this->supervisor;}
    function getTimestamp(){return $this->timestamp;}
    
    function setId($id){$this->id = $id;}
    function setName($name){$this->name = $name;}
    function setDescription($description){$this->description = $description;}
    function setStatus($student){$this->status = $student;}
    function setStudent($student){$this->student = $student;}
    function setSupervisor($supervisor){$this->supervisor = $supervisor;}
    function setTimestamp($timestamp){$this->timestamp = $timestamp;}
}
?>