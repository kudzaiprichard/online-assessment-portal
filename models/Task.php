<?php
class Task{
    private $id;
    private $name;
    private $description;
    private $status;
    private $studentComment;
    private $supervisorComment;
    private $student;
    private $supervisor;
    private $timestamp;
    private $rating;

    function __construct($id, $taskName, $taskDescription, $status, $studentComment, $supervisorComment ,$student, $supervisor, $timestamp, $rating){
        $this->id = $id;
        $this->name = $taskName;
        $this->description = $taskDescription;
        $this->status = $status;
        $this->studentComment = $studentComment;
        $this->supervisorComment = $supervisorComment;
        $this->student = $student;
        $this->supervisor = $supervisor;;
        $this->timestamp = $timestamp;
        $this->rating = $rating;

    }

    function getId(){return $this->id;}
    function getName(){return $this->name;}
    function getDescription(){return $this->description;}
    function getStatus(){return $this->status;}
    function getStudent(){return $this->student;}
    function getSupervisor(){return $this->supervisor;}
    function getTimestamp(){return $this->timestamp;}
    function getStudentComment(){return $this->studentComment;}
    function getSupervisorComment(){return $this->supervisorComment;}
    function getRating(){return $this->rating;}
    
    function setId($id){$this->id = $id;}
    function setName($name){$this->name = $name;}
    function setDescription($description){$this->description = $description;}
    function setStatus($student){$this->status = $student;}
    function setStudent($student){$this->student = $student;}
    function setSupervisor($supervisor){$this->supervisor = $supervisor;}
    function setTimestamp($timestamp){$this->timestamp = $timestamp;}
    function setStudentComment($studentComment){$this->studentComment = $studentComment;}
    function setSupervisorComment($supervisorComment){$this->supervisorComment = $supervisorComment;}
    function setRating($rating){$this->rating = $this->rating= $rating;}
    
}
?>